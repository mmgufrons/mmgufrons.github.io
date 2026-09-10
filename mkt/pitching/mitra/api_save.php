<?php
// ============================================================
// SECURITY: Endpoint ini hanya bisa diakses setelah login
// ============================================================
session_start();
// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;
// ============================================================

header('Content-Type: application/json');

$action = $_GET['action'] ?? 'save_tracker';

// ============================================================
// ROUTING
// ============================================================

// --- Route: Tracker Data (existing functionality) ---
if ($action === 'save_tracker' || !isset($_GET['action'])) {
    $file = dirname(__FILE__) . '/json/tracker_data.json';
    $data = file_get_contents('php://input');

    if ($data) {
        $decoded = json_decode($data);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Format data tidak valid (bukan JSON)']);
            exit;
        }
        if (!write_json_file($file, $data)) exit;
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tidak ada data yang dikirim']);
    }
    exit;
}

// --- Route: Save Prosedur ---
if ($action === 'save_prosedur') {
    $file = dirname(__FILE__) . '/json/prosedur_links.json';
    $data = file_get_contents('php://input');
    if ($data) {
        $decoded = json_decode($data);
        if (json_last_error() === JSON_ERROR_NONE) {
            if (!write_json_file($file, $data)) exit;
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Format JSON tidak valid']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tidak ada data']);
    }
    exit;
}

// --- Route: Get Mitra Info ---
if ($action === 'get_mitra_info') {
    $file = dirname(__FILE__) . '/json/info_mitra_data.json';
    if (!file_exists($file)) {
        echo json_encode(['status' => 'error', 'message' => 'File data mitra tidak ditemukan']);
        exit;
    }
    $data = file_get_contents($file);
    echo $data;
    exit;
}

// --- Route: Save Mitra Info (update satu mitra) ---
if ($action === 'save_mitra_info') {
    $file = dirname(__FILE__) . '/json/info_mitra_data.json';
    $input = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE || !isset($input['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak valid atau ID mitra tidak ada']);
        exit;
    }

    $all = json_decode(file_get_contents($file), true);
    $found = false;
    foreach ($all as &$mitra) {
        if ($mitra['id'] === $input['id']) {
            // Update field-field yang boleh diubah
            $editable = ['label','status','status_color','pic','catatan_khusus','catatan_type','next_fu_date','next_fu_note','fu_by'];
            foreach ($editable as $f) {
                if (isset($input[$f])) $mitra[$f] = $input[$f];
            }
            $found = true;
            break;
        }
    }
    unset($mitra);

    if (!$found) {
        echo json_encode(['status' => 'error', 'message' => 'Mitra tidak ditemukan']);
        exit;
    }

    $out = json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (!write_json_file($file, $out)) exit;
    echo json_encode(['status' => 'success']);
    exit;
}

// --- Route: Add History Entry ---
if ($action === 'add_history') {
    $file = dirname(__FILE__) . '/json/info_mitra_data.json';
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['mitra_id'], $input['date'], $input['content'])) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
        exit;
    }

    $all = json_decode(file_get_contents($file), true);
    $found = false;
    foreach ($all as &$mitra) {
        if ($mitra['id'] === $input['mitra_id']) {
            $new_entry = [
                'id' => 'h_' . $input['mitra_id'] . '_' . time(),
                'date' => $input['date'],
                'content' => $input['content']
            ];
            array_unshift($mitra['history'], $new_entry); // Tambah di atas
            $found = true;
            break;
        }
    }
    unset($mitra);

    if (!$found) {
        echo json_encode(['status' => 'error', 'message' => 'Mitra tidak ditemukan']);
        exit;
    }

    $out = json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (!write_json_file($file, $out)) exit;
    echo json_encode(['status' => 'success']);
    exit;
}

// --- Route: Delete History Entry ---
if ($action === 'delete_history') {
    $file = dirname(__FILE__) . '/json/info_mitra_data.json';
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['mitra_id'], $input['history_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
        exit;
    }

    $all = json_decode(file_get_contents($file), true);
    $found = false;
    foreach ($all as &$mitra) {
        if ($mitra['id'] === $input['mitra_id']) {
            $mitra['history'] = array_values(array_filter(
                $mitra['history'],
                fn($h) => $h['id'] !== $input['history_id']
            ));
            $found = true;
            break;
        }
    }
    unset($mitra);

    if (!$found) {
        echo json_encode(['status' => 'error', 'message' => 'Mitra tidak ditemukan']);
        exit;
    }

    $out = json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (!write_json_file($file, $out)) exit;
    echo json_encode(['status' => 'success']);
    exit;
}

// --- Route: Add FU Log ---
if ($action === 'add_fu_log') {
    $file = dirname(__FILE__) . '/json/info_mitra_data.json';
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['mitra_id'], $input['date'], $input['done_by'], $input['summary'])) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
        exit;
    }

    $all = json_decode(file_get_contents($file), true);
    $found = false;
    foreach ($all as &$mitra) {
        if ($mitra['id'] === $input['mitra_id']) {
            if (!isset($mitra['fu_history'])) $mitra['fu_history'] = [];
            $new_fu = [
                'id' => 'fu_' . $input['mitra_id'] . '_' . time(),
                'date' => $input['date'],
                'done_by' => $input['done_by'],
                'summary' => $input['summary'],
                'response' => $input['response'] ?? ''
            ];
            array_unshift($mitra['fu_history'], $new_fu);
            $found = true;
            break;
        }
    }
    unset($mitra);

    if (!$found) {
        echo json_encode(['status' => 'error', 'message' => 'Mitra tidak ditemukan']);
        exit;
    }

    $out = json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (!write_json_file($file, $out)) exit;
    echo json_encode(['status' => 'success']);
    exit;
}

// --- Route: Delete FU Log ---
if ($action === 'delete_fu_log') {
    $file = dirname(__FILE__) . '/json/info_mitra_data.json';
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['mitra_id'], $input['fu_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
        exit;
    }

    $all = json_decode(file_get_contents($file), true);
    $found = false;
    foreach ($all as &$mitra) {
        if ($mitra['id'] === $input['mitra_id']) {
            $mitra['fu_history'] = array_values(array_filter(
                $mitra['fu_history'] ?? [],
                fn($f) => $f['id'] !== $input['fu_id']
            ));
            $found = true;
            break;
        }
    }
    unset($mitra);

    if (!$found) {
        echo json_encode(['status' => 'error', 'message' => 'Mitra tidak ditemukan']);
        exit;
    }

    $out = json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (!write_json_file($file, $out)) exit;
    echo json_encode(['status' => 'success']);
    exit;
}

// --- Route: Add New Mitra ---
if ($action === 'add_mitra') {
    $file = dirname(__FILE__) . '/json/info_mitra_data.json';
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['id'], $input['label'])) {
        echo json_encode(['status' => 'error', 'message' => 'ID dan Label wajib diisi']);
        exit;
    }

    $all = json_decode(file_get_contents($file), true);

    // Cek duplikat ID
    foreach ($all as $m) {
        if ($m['id'] === $input['id']) {
            echo json_encode(['status' => 'error', 'message' => 'ID mitra sudah ada, gunakan ID lain']);
            exit;
        }
    }

    $new_mitra = [
        'id' => $input['id'],
        'label' => $input['label'],
        'status' => $input['status'] ?? 'Baru',
        'status_color' => $input['status_color'] ?? 'secondary',
        'pic' => $input['pic'] ?? '-',
        'catatan_khusus' => $input['catatan_khusus'] ?? '',
        'catatan_type' => 'info',
        'next_fu_date' => $input['next_fu_date'] ?? '',
        'next_fu_note' => $input['next_fu_note'] ?? '',
        'fu_by' => $input['fu_by'] ?? '',
        'fu_history' => [],
        'history' => []
    ];

    $all[] = $new_mitra;

    $out = json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (!write_json_file($file, $out)) exit;
    echo json_encode(['status' => 'success', 'mitra' => $new_mitra]);
    exit;
}

// --- Route: Delete Mitra ---
if ($action === 'delete_mitra') {
    $file = dirname(__FILE__) . '/json/info_mitra_data.json';
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['mitra_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'ID mitra tidak ada']);
        exit;
    }

    $all = json_decode(file_get_contents($file), true);
    $before = count($all);
    $all = array_values(array_filter($all, fn($m) => $m['id'] !== $input['mitra_id']));

    if (count($all) === $before) {
        echo json_encode(['status' => 'error', 'message' => 'Mitra tidak ditemukan']);
        exit;
    }

    $out = json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (!write_json_file($file, $out)) exit;
    echo json_encode(['status' => 'success']);
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Action tidak dikenali: ' . htmlspecialchars($action)]);

// ============================================================
// HELPER FUNCTIONS
// ============================================================
function write_json_file($file, $data) {
    if (file_exists($file)) {
        if (!is_writable($file)) {
            @chmod($file, 0666);
        }
        if (!is_writable($file)) {
            if (is_writable(dirname($file))) {
                @unlink($file);
            }
            if (file_exists($file) && !is_writable($file)) {
                echo json_encode(['status' => 'error', 'message' => 'File Read-Only. Ubah permission menjadi 666 via cPanel/FTP.']);
                return false;
            }
        }
    } else {
        if (!is_writable(dirname($file))) {
            echo json_encode(['status' => 'error', 'message' => 'Folder json/ Read-Only. Ubah permission menjadi 755 via cPanel/FTP.']);
            return false;
        }
    }

    if (file_put_contents($file, $data) !== false) {
        return true;
    } else {
        error_log("Gagal menulis ke: " . $file);
        echo json_encode(['status' => 'error', 'message' => 'Gagal tulis file. Cek permission server.']);
        return false;
    }
}
?>