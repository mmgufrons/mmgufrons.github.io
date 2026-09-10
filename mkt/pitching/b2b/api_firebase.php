<?php
// ============================================================
// PORTOFOLIO DEMO — pitching/b2b/api_firebase.php
// Versi asli proxy cURL ke Firebase RTDB (project simasrim-b2b-os,
// node b2b_tracker) dengan secret asli — identik dengan
// partner/api_firebase.php (dua entry point untuk data yang sama).
// Di versi porto ini SELURUH panggilan live DIHILANGKAN TOTAL,
// dan diarahkan ke store lokal yang SAMA dengan partner/ agar
// datanya tetap konsisten (data/b2b_tracker_store.json).
// ============================================================
session_start();
require_once __DIR__ . '/../../includes/porto_kv_store.php';

// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;

$action = $_GET['action'] ?? '';
$path = $_GET['path'] ?? 'b2b_tracker';
if (strpos($path, 'b2b_tracker') !== 0) {
    $path = 'b2b_tracker';
}

header('Content-Type: application/json');

$storeFile = __DIR__ . '/../../partner/data/b2b_tracker_store.json';
$seedFile  = __DIR__ . '/../../partner/data/b2b_tracker_seed.json';
$tree = porto_kv_load($storeFile, $seedFile);

if ($action === 'read') {
    echo json_encode(porto_kv_get($tree, $path));
} elseif ($action === 'push') {
    $data = json_decode(file_get_contents('php://input'), true);
    $key = '-M' . base_convert((string)(microtime(true) * 1000), 10, 36) . substr(md5(uniqid('', true)), 0, 6);
    porto_kv_set($tree, "$path/$key", $data);
    porto_kv_save($storeFile, $tree);
    echo json_encode(['name' => $key]);
} elseif ($action === 'update') {
    $data = json_decode(file_get_contents('php://input'), true);
    $existing = porto_kv_get($tree, $path);
    if (!is_array($existing)) $existing = [];
    if (is_array($data)) {
        foreach ($data as $k => $v) $existing[$k] = $v;
    }
    porto_kv_set($tree, $path, $existing);
    porto_kv_save($storeFile, $tree);
    echo json_encode($existing);
} elseif ($action === 'remove') {
    porto_kv_set($tree, $path, null);
    porto_kv_save($storeFile, $tree);
    echo json_encode(null);
} else {
    echo json_encode(['error' => 'Invalid action']);
}
