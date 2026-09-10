<?php
// ============================================================
// PORTOFOLIO DEMO — partner/api.php
// Versi asli proxy cURL ke Firebase RTDB (project simasrim-b2b-os,
// node b2b_tracker) dengan secret asli. Di versi porto ini SELURUH
// panggilan live DIHILANGKAN TOTAL — pakai store lokal yang sama
// dengan api_firebase.php (data/b2b_tracker_store.json).
// ============================================================
require_once __DIR__ . '/../includes/porto_kv_store.php';

header('Content-Type: application/json');

$storeFile = __DIR__ . '/data/b2b_tracker_store.json';
$seedFile  = __DIR__ . '/data/b2b_tracker_seed.json';

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';
$path = isset($_GET['path']) ? $_GET['path'] : '';

$tree = porto_kv_load($storeFile, $seedFile);

if ($method === 'GET' && $action === 'get_b2b') {
    $data = porto_kv_get($tree, 'b2b_tracker');
    if ($data === null) $data = new stdClass();
    echo json_encode(['status' => 'success', 'data' => $data]);
    exit;
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if ($action === 'push') {
        $key = '-M' . base_convert((string)(microtime(true) * 1000), 10, 36) . substr(md5(uniqid('', true)), 0, 6);
        porto_kv_set($tree, "b2b_tracker/$key", $input);
        porto_kv_save($storeFile, $tree);
        echo json_encode(['status' => 'success', 'result' => ['name' => $key]]);
        exit;
    }
    if ($action === 'update') {
        $clean_path = $path;
        if (strpos($clean_path, 'b2b_tracker') !== 0) {
            $clean_path = 'b2b_tracker/' . ltrim($clean_path, '/');
        }
        $existing = porto_kv_get($tree, $clean_path);
        if (!is_array($existing)) $existing = [];
        if (is_array($input)) {
            foreach ($input as $k => $v) $existing[$k] = $v;
        }
        porto_kv_set($tree, $clean_path, $existing);
        porto_kv_save($storeFile, $tree);
        echo json_encode(['status' => 'success', 'result' => $existing]);
        exit;
    }
    if ($action === 'remove') {
        $clean_path = $path;
        if (strpos($clean_path, 'b2b_tracker') !== 0) {
            $clean_path = 'b2b_tracker/' . ltrim($clean_path, '/');
        }
        porto_kv_set($tree, $clean_path, null);
        porto_kv_save($storeFile, $tree);
        echo json_encode(['status' => 'success', 'result' => null]);
        exit;
    }
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action or method']);
