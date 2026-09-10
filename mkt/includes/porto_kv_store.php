<?php
// ============================================================
// PORTOFOLIO DEMO — includes/porto_kv_store.php
// Helper generik pengganti proxy Firebase RTDB asli. Dipakai oleh
// beberapa file *firebase_proxy.php / api_firebase.php di berbagai
// modul (masing-masing modul punya file store + seed sendiri, agar
// datanya tetap terisolasi seperti proyek Firebase terpisah aslinya).
// Tidak pernah melakukan HTTP request ke server manapun.
// ============================================================

function porto_kv_path_parts($path) {
    return array_values(array_filter(explode('/', trim((string)$path, '/')), fn($p) => $p !== ''));
}

function porto_kv_load($storeFile, $seedFile) {
    $file = file_exists($storeFile) ? $storeFile : $seedFile;
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : [];
}

function porto_kv_save($storeFile, $tree) {
    @file_put_contents($storeFile, json_encode($tree, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}

function porto_kv_get($tree, $path) {
    $parts = porto_kv_path_parts($path);
    $cur = $tree;
    foreach ($parts as $p) {
        if (!is_array($cur) || !array_key_exists($p, $cur)) return null;
        $cur = $cur[$p];
    }
    return $cur;
}

function porto_kv_set(&$tree, $path, $value) {
    $parts = porto_kv_path_parts($path);
    if (empty($parts)) {
        $tree = $value;
        return;
    }
    $cur = &$tree;
    foreach (array_slice($parts, 0, -1) as $p) {
        if (!isset($cur[$p]) || !is_array($cur[$p])) $cur[$p] = [];
        $cur = &$cur[$p];
    }
    $last = end($parts);
    if ($value === null) {
        unset($cur[$last]);
    } else {
        $cur[$last] = $value;
    }
}

// Menangani satu request proxy generik: baca query 'path' + method HTTP,
// baca/tulis ke $storeFile (di-seed dari $seedFile bila belum ada), lalu echo JSON.
// Meniru perilaku Firebase REST API (.json?auth=...) secukupnya untuk kebutuhan demo.
function porto_kv_handle_request($storeFile, $seedFile) {
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(204);
        exit;
    }

    $path = isset($_GET['path']) ? trim($_GET['path'], '/') : '';
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    $tree = porto_kv_load($storeFile, $seedFile);

    if ($method === 'GET') {
        echo json_encode(porto_kv_get($tree, $path));
        exit;
    }

    $body = json_decode(file_get_contents('php://input'), true);

    if ($method === 'PUT' || $method === 'POST') {
        porto_kv_set($tree, $path, $body);
        porto_kv_save($storeFile, $tree);
        echo json_encode($body);
        exit;
    }

    if ($method === 'PATCH') {
        $existing = porto_kv_get($tree, $path);
        if (!is_array($existing)) $existing = [];
        if (is_array($body)) {
            foreach ($body as $k => $v) $existing[$k] = $v;
        }
        porto_kv_set($tree, $path, $existing);
        porto_kv_save($storeFile, $tree);
        echo json_encode($existing);
        exit;
    }

    if ($method === 'DELETE') {
        porto_kv_set($tree, $path, null);
        porto_kv_save($storeFile, $tree);
        echo json_encode(null);
        exit;
    }

    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
