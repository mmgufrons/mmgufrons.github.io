<?php
// data/transaksi/seed.php
// Jalankan SEKALI SAJA secara manual (via browser) untuk isi data awal:
// - CSV snapshot Juli -> /transaksi
// - Sheet USER_MASTER & ORIGIN dari workbook besar -> /user_master, /origin_master
// Aman dijalankan ulang (upsert by key), tapi tidak perlu diulang kalau sudah sukses.

session_start();
set_time_limit(0);
ini_set('memory_limit', '1024M');
require_once __DIR__ . '/logic.php';

// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;

header('Content-Type: text/plain; charset=utf-8');

function out($msg) {
    echo $msg . "\n";
    @ob_flush();
    @flush();
}

function trx_col(array $row, array $idx, string $name) {
    return isset($idx[$name]) ? ($row[$idx[$name]] ?? null) : null;
}

$csvPath = __DIR__ . '/../../source/SIMASRIM_DATABASE_FINAL_JULI_26.csv';
$userCenterPath = __DIR__ . "/../../source/SIMASRIM's USER CENTER.xlsx";
$step = $_GET['step'] ?? 'all';

if (!is_file($csvPath) && ($step === 'all' || $step === 'transaksi')) {
    out("File tidak ditemukan: $csvPath");
    exit;
}

// ---- STEP 1: USER_MASTER & ORIGIN ----
if ($step === 'all' || $step === 'master') {
    if (!is_file($userCenterPath)) {
        out("File tidak ditemukan: $userCenterPath — lewati step master.");
    } else {
        out("Membaca sheet USER_MASTER & ORIGIN dari workbook besar (skip DATABASE_MASTER)...");
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($userCenterPath);
        $reader->setLoadSheetsOnly(['USER_MASTER', 'ORIGIN']);
        $spreadsheet = $reader->load($userCenterPath);

        $userSheet = $spreadsheet->getSheetByName('USER_MASTER');
        if ($userSheet) {
            $rows = $userSheet->toArray(null, true, false, false);
            $header = array_map(function ($h) { return strtoupper(trim((string)$h)); }, $rows[0]);
            $idx = array_flip($header);
            $updates = [];
            $n = 0;
            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                $id = trx_clean_id(trx_col($row, $idx, 'ID USER'));
                if ($id === '') continue;
                $key = trx_sanitize_key($id);
                if ($key === null) continue;
                $updates['user_master/' . $key] = [
                    'ID USER' => $id,
                    'ORIGIN' => trx_col($row, $idx, 'ORIGIN'),
                    'DOMISILI USER' => trx_col($row, $idx, 'DOMISILI USER'),
                ];
                $n++;
                if (count($updates) >= 1000) { trx_fb_patch_root($updates); $updates = []; }
            }
            if ($updates) trx_fb_patch_root($updates);
            out("USER_MASTER: $n baris di-upsert.");
        } else {
            out("Sheet USER_MASTER tidak ditemukan.");
        }

        $originSheet = $spreadsheet->getSheetByName('ORIGIN');
        if ($originSheet) {
            $rows = $originSheet->toArray(null, true, false, false);
            $header = array_map(function ($h) { return strtoupper(trim((string)$h)); }, $rows[0]);
            $idx = array_flip($header);
            $updates = [];
            $n = 0;
            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                $kode = strtoupper(trim((string)trx_col($row, $idx, 'KODE')));
                if ($kode === '') continue;
                $key = trx_sanitize_key($kode);
                if ($key === null) continue;
                $updates['origin_master/' . $key] = [
                    'KODE' => $kode,
                    'ORIGIN' => trx_col($row, $idx, 'ORIGIN'),
                ];
                $n++;
                if (count($updates) >= 1000) { trx_fb_patch_root($updates); $updates = []; }
            }
            if ($updates) trx_fb_patch_root($updates);
            out("ORIGIN: $n baris di-upsert.");
        } else {
            out("Sheet ORIGIN tidak ditemukan.");
        }
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
    }
}

// ---- STEP 2: CSV transaksi (140rb baris) ----
if ($step === 'all' || $step === 'transaksi') {
    out("Membaca CSV master ($csvPath)...");
    $fh = fopen($csvPath, 'r');
    $header = fgetcsv($fh);
    $header = array_map(function ($h) { return trim((string)$h); }, $header);
    $idx = array_flip($header);

    $updates = [];
    $total = 0;
    $batch = 0;
    while (($row = fgetcsv($fh)) !== false) {
        $awb = trx_clean_id($row[$idx['AWB / RESI']] ?? null);
        if ($awb === '') continue;
        $key = trx_sanitize_key($awb);
        if ($key === null) continue;

        $rec = [];
        foreach ($idx as $col => $i) {
            $rec[$col] = $row[$i] ?? null;
        }
        $rec['AWB_RESI'] = $awb;
        unset($rec['AWB / RESI']);
        unset($rec['TANGGAL_DASHBOARD']);

        $updates['transaksi/' . $key] = $rec;
        $total++;

        if (count($updates) >= 2000) {
            trx_fb_patch_root($updates);
            $updates = [];
            $batch++;
            out("Batch $batch selesai — total $total baris ter-upsert...");
        }
    }
    if ($updates) {
        trx_fb_patch_root($updates);
        out("Batch terakhir selesai — total $total baris ter-upsert.");
    }
    fclose($fh);
    out("SELESAI seed transaksi. Total: $total baris.");
}

// ---- STEP 3: rebuild summary ----
if ($step === 'all' || $step === 'summary') {
    out("Menghitung ulang /transaksi_summary (ini bisa berat karena fetch semua data)...");
    trx_rebuild_summary();
    out("Summary selesai dihitung ulang.");
}

out("SELESAI. Silakan buka dashboard.php.");
