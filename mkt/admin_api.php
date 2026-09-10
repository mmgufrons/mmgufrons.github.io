<?php
session_start();
require_once __DIR__ . '/includes/firebase.php';

// Cek autentikasi
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'get_mitra') {
        $spreadsheets = firebase_get('/mitra_spreadsheets') ?: [];
        $lookers = firebase_get('/mitra_lookers') ?: [];
        echo json_encode(["spreadsheets" => $spreadsheets, "lookers" => $lookers]);
    } elseif ($action === 'get_marketing') {
        $marketing = firebase_get('/marketing_kit') ?: [];
        echo json_encode(["marketing" => $marketing]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if ($action === 'save_mitra') {
        firebase_put('/mitra_spreadsheets', $input['spreadsheets']);
        firebase_put('/mitra_lookers', $input['lookers']);
        echo json_encode(["status" => "success"]);
    } elseif ($action === 'save_marketing') {
        firebase_put('/marketing_kit', $input['marketing']);
        echo json_encode(["status" => "success"]);
    } elseif ($action === 'upload_coverage') {
        // Upload Excel / Coverage Logic
        // Input: array of ["provinsi", "kota", "kecamatan", "bits", "kategori"]
        $new_data = $input['data'];
        
        $current_data = firebase_get('/coverage/raw_data') ?: [];
        
        // Merge logic: pastikan tidak duplikat
        // Key untuk identifikasi unik = provinsi + kota + kecamatan
        $map = [];
        foreach ($current_data as $row) {
            $key = $row[0] . "|" . $row[1] . "|" . $row[2]; // prov|kota|kec
            $map[$key] = $row;
        }
        
        // Update atau Add
        foreach ($new_data as $row) {
            $key = $row[0] . "|" . $row[1] . "|" . $row[2];
            $map[$key] = $row;
        }
        
        // Re-index array
        $merged_data = array_values($map);
        
        firebase_put('/coverage/raw_data', $merged_data);
        echo json_encode(["status" => "success", "total" => count($merged_data)]);
    } elseif ($action === 'sync_local') {
        // Sync Mitra Area
        // PORTOFOLIO DEMO: nama PIC & link spreadsheet/looker asli dihapus total, diganti data fiktif.
        $fallback_lookers = [
            "DEMO-1 - Kota Contoh A (PIC Demo)" => "#",
            "DEMO-2 - Kota Contoh B (PIC Demo)" => "#",
            "DEMO-3 - Kota Contoh C (PIC Demo)" => "#",
        ];
        $fallback_spreadsheets = [
            "DEMO-1 - Kota Contoh A (PIC Demo)" => "#",
            "DEMO-2 - Kota Contoh B (PIC Demo)" => "#",
            "DEMO-3 - Kota Contoh C (PIC Demo)" => "#",
        ];
        firebase_put('/mitra_lookers', $fallback_lookers);
        firebase_put('/mitra_spreadsheets', $fallback_spreadsheets);
        
        // Sync Marketing Kit
        $fallback_marketing_kit = [
            "X-Banner EDC" => "https://www.canva.com/design/DAG1qcadvPM/0n7VEz7oh5Rcw90cQU60iQ/edit",
            "Spanduk 2x1 M" => "https://www.canva.com/design/DAGzyZPoop8/pqa42vO38tiLfnuiupbTLw/edit",
            "Spanduk 3x1 M" => "https://www.canva.com/design/DAG1phnvTeU/y7ODED4jLeRtP0XX2j6dVw/edit"
        ];
        firebase_put('/marketing_kit', $fallback_marketing_kit);

        // Sync Coverage
        $coverage_file = __DIR__ . '/data/coverage.php';
        $coverage_content = file_get_contents($coverage_file);
        
        $exp_names = [];
        $raw_data = [];
        
        $exp_start = strpos($coverage_content, 'const LOCAL_EXP_NAMES = ');
        if ($exp_start !== false) {
            $exp_start += strlen('const LOCAL_EXP_NAMES = ');
            $exp_end = strpos($coverage_content, '];', $exp_start);
            if ($exp_end !== false) {
                $exp_json = substr($coverage_content, $exp_start, $exp_end - $exp_start + 1);
                $exp_names = json_decode($exp_json, true);
                if ($exp_names) firebase_put('/coverage/exp_names', $exp_names);
            }
        }
        
        $data_start = strpos($coverage_content, 'const LOCAL_RAW_DATA = ');
        if ($data_start !== false) {
            $data_start += strlen('const LOCAL_RAW_DATA = ');
            $data_end = strpos($coverage_content, '];', $data_start);
            if ($data_end !== false) {
                $data_json = substr($coverage_content, $data_start, $data_end - $data_start + 1);
                $raw_data = json_decode($data_json, true);
                if ($raw_data) firebase_put('/coverage/raw_data', $raw_data);
            }
        }
        
        echo json_encode(["status" => "success", "message" => "Data lokal berhasil disinkronisasi ke Firebase"]);
    }
}

