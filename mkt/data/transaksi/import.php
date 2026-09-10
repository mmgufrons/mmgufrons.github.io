<?php
// data/transaksi/import.php
// Backend proses upload: gabung file mentah ekspedisi (+ opsional file master baru),
// merge ke Firebase /transaksi, recompute kolom turunan, tulis /transaksi_summary & /import_log.

session_start();
header('Content-Type: application/json');

// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

set_time_limit(300);
ini_set('memory_limit', '512M');

try {
    require_once __DIR__ . '/logic.php';
    // 1. Ambil origin_master untuk mapping kota (kecil, aman di-fetch penuh)
    $originRaw = trx_fb_get('/origin_master') ?: [];
    $originMap = [];
    $originPrefixMap = [];
    foreach ($originRaw as $kode => $row) {
        $kodeUp = strtoupper($kode);
        $originMap[$kodeUp] = $row['ORIGIN'] ?? $kodeUp;
        $prefix = substr($kodeUp, 0, 3);
        if (!isset($originPrefixMap[$prefix])) $originPrefixMap[$prefix] = $row['ORIGIN'] ?? $kodeUp;
    }

    // 2. Baca semua file mentah ekspedisi ter-upload
    $combined = []; // AWB(sanitized) => raw fields
    $failedRows = 0;
    $filesProcessed = [];

    if (!empty($_FILES['raw_files']['name'][0])) {
        $count = count($_FILES['raw_files']['name']);
        for ($i = 0; $i < $count; $i++) {
            if ($_FILES['raw_files']['error'][$i] !== UPLOAD_ERR_OK) continue;
            $tmpPath = $_FILES['raw_files']['tmp_name'][$i];
            $origName = $_FILES['raw_files']['name'][$i];
            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            if (!in_array($ext, ['xlsx', 'xls'], true)) continue;

            $ekspedisi = trx_guess_ekspedisi($origName);
            $rows = trx_read_raw_file($tmpPath, $ekspedisi);
            $filesProcessed[] = ['name' => $origName, 'ekspedisi' => $ekspedisi, 'rows' => count($rows)];
            foreach ($rows as $awb => $rec) {
                $key = trx_sanitize_key($awb);
                if ($key === null) { $failedRows++; continue; }
                $combined[$key] = $rec; // file terakhir menang kalau AWB sama antar file
            }
        }
    }

    // 2b. Baca file "Data Agen/User Baru" (opsional, skema DATA TJS.xlsx) -> upsert /user_master
    $agenUpdated = 0;
    if (!empty($_FILES['agen_file']['name']) && $_FILES['agen_file']['error'] === UPLOAD_ERR_OK) {
        $userRows = trx_read_user_file($_FILES['agen_file']['tmp_name']);
        $userUpdates = [];
        foreach ($userRows as $id => $rec) {
            $key = trx_sanitize_key($id);
            if ($key === null) continue;
            $existingUser = [];
            try { $existingUser = trx_fb_get('/user_master/' . $key) ?: []; } catch (\Throwable $e) {}
            $userUpdates['user_master/' . $key] = array_merge($existingUser, $rec);
            $agenUpdated++;
            if (count($userUpdates) >= 500) { trx_fb_patch_root($userUpdates); $userUpdates = []; }
        }
        if (!empty($userUpdates)) trx_fb_patch_root($userUpdates);
    }

    // 3. Baca file master transaksi (opsional, jarang dipakai — resi+ID USER+KOMISI siap pakai gaya DATABASE_MASTER)
    $masterNew = [];
    if (!empty($_FILES['master_file']['name']) && $_FILES['master_file']['error'] === UPLOAD_ERR_OK) {
        $tmpPath = $_FILES['master_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($tmpPath);
        $sheet = $spreadsheet->getSheetByName('DATABASE_MASTER') ?: $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, false, false);
        if (!empty($rows)) {
            $header = array_map(function ($h) { return strtoupper(trim((string)$h)); }, $rows[0]);
            $colIndex = array_flip($header);
            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                $awbCol = $colIndex['AWB / RESI'] ?? $colIndex['AWB/RESI'] ?? null;
                if ($awbCol === null) break;
                $awb = trx_clean_id($row[$awbCol] ?? null);
                if ($awb === '') continue;
                $key = trx_sanitize_key($awb);
                if ($key === null) continue;
                $rec = [];
                foreach ($colIndex as $colName => $idx) {
                    $rec[$colName] = $row[$idx] ?? null;
                }
                $rec['AWB_RESI'] = $awb;
                $masterNew[$key] = $rec;
            }
        }
    }

    if (empty($combined) && empty($masterNew) && $agenUpdated === 0) {
        echo json_encode(['success' => false, 'error' => 'Tidak ada data valid di file yang di-upload.']);
        exit;
    }

    if (empty($combined) && empty($masterNew)) {
        // Hanya update agen, tidak ada resi yang diproses — tidak perlu rebuild summary transaksi.
        echo json_encode([
            'success' => true,
            'rows_affected' => 0,
            'rows_failed' => 0,
            'agen_updated' => $agenUpdated,
            'files' => [],
        ]);
        exit;
    }

    // 4. Merge: ambil existing record per AWB dari Firebase, overlay master baru lalu raw file, recompute
    $allKeys = array_unique(array_merge(array_keys($masterNew), array_keys($combined)));
    $updates = [];
    $rowsAffected = 0;

    foreach ($allKeys as $key) {
        $existing = [];
        try {
            $existing = trx_fb_get('/transaksi/' . $key) ?: [];
        } catch (\Throwable $e) {
            $existing = [];
        }

        $rec = array_merge($existing, $masterNew[$key] ?? []);
        if (isset($combined[$key])) {
            $rec = array_merge($rec, $combined[$key]);
        }
        if (empty($rec['AWB_RESI'])) $rec['AWB_RESI'] = $key;

        $rec = trx_recompute($rec, $originMap, $originPrefixMap);
        $updates['transaksi/' . $key] = $rec;
        $rowsAffected++;

        // Kirim per-batch 500 record agar payload PATCH tidak terlalu besar
        if (count($updates) >= 500) {
            trx_fb_patch_root($updates);
            $updates = [];
        }
    }
    if (!empty($updates)) {
        trx_fb_patch_root($updates);
    }

    // 5. Rebuild summary agregat
    $summary = trx_rebuild_summary();

    // 6. Log
    $logId = (string)time() . '_' . substr(md5(uniqid()), 0, 6);
    trx_fb_put('/import_log/' . $logId, [
        'waktu' => date('Y-m-d H:i:s'),
        'user' => $_SESSION['login_simasrim'] ?? 'unknown',
        'files' => $filesProcessed,
        'master_uploaded' => !empty($masterNew),
        'agen_updated' => $agenUpdated,
        'rows_affected' => $rowsAffected,
        'rows_failed' => $failedRows,
    ]);

    echo json_encode([
        'success' => true,
        'rows_affected' => $rowsAffected,
        'rows_failed' => $failedRows,
        'agen_updated' => $agenUpdated,
        'files' => $filesProcessed,
        'summary' => $summary,
    ]);

} catch (\Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
