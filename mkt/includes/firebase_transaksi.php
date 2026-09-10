<?php
// includes/firebase_transaksi.php
// ============================================================
// PORTOFOLIO DEMO — versi asli cURL ke Firebase RTDB terpisah
// khusus modul Transaksi Bulanan. Di versi porto ini SELURUH
// panggilan live DIHILANGKAN TOTAL, diganti baca/tulis ke file
// JSON dummy lokal (includes/data/porto_firebase_trx_store.json).
// ============================================================
define('FIREBASE_TRX_URL', 'https://demo-project-default-rtdb.firebaseio.com');
define('FIREBASE_TRX_SECRET', 'DUMMY-SECRET-GANTI-SENDIRI');

define('PORTO_TRX_STORE', __DIR__ . '/data/porto_firebase_trx_store.json');
define('PORTO_TRX_SEED', __DIR__ . '/data/porto_firebase_trx_seed.json');

if (!function_exists('_porto_fb_path_parts')) {
    function _porto_fb_path_parts($path) {
        return array_values(array_filter(explode('/', trim($path, '/')), fn($p) => $p !== ''));
    }
}

function _porto_trx_load_store() {
    $file = file_exists(PORTO_TRX_STORE) ? PORTO_TRX_STORE : PORTO_TRX_SEED;
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : [];
}

function _porto_trx_save_store($tree) {
    @file_put_contents(PORTO_TRX_STORE, json_encode($tree, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}

function _porto_trx_get(&$tree, $path) {
    $parts = _porto_fb_path_parts($path);
    $cur = $tree;
    foreach ($parts as $p) {
        if (!is_array($cur) || !array_key_exists($p, $cur)) return null;
        $cur = $cur[$p];
    }
    return $cur;
}

function _porto_trx_set(&$tree, $path, $value) {
    $parts = _porto_fb_path_parts($path);
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

function trx_firebase_request($path, $method = 'GET', $data = null, $timeout = 60) {
    $tree = _porto_trx_load_store();

    if ($method === 'GET') {
        return _porto_trx_get($tree, $path);
    }
    if ($method === 'PUT') {
        _porto_trx_set($tree, $path, $data);
        _porto_trx_save_store($tree);
        return $data;
    }
    if ($method === 'PATCH') {
        // Dukung multi-path update dalam satu request, seperti Firebase PATCH ke root.
        if ($path === '/' && is_array($data)) {
            foreach ($data as $subPath => $value) {
                _porto_trx_set($tree, $subPath, $value);
            }
        } else {
            $existing = _porto_trx_get($tree, $path);
            if (!is_array($existing)) $existing = [];
            if (is_array($data)) {
                foreach ($data as $k => $v) $existing[$k] = $v;
            }
            _porto_trx_set($tree, $path, $existing);
        }
        _porto_trx_save_store($tree);
        return $data;
    }

    return null;
}

function trx_fb_get($path, $timeout = 60) {
    return trx_firebase_request($path, 'GET', null, $timeout);
}

// Multi-path update dalam 1 request (upsert banyak record sekaligus).
// $updates: ['transaksi/AWB123' => [...], 'transaksi/AWB456' => [...]]
function trx_fb_patch_root($updates) {
    return trx_firebase_request('/', 'PATCH', $updates, 120);
}

function trx_fb_put($path, $data) {
    return trx_firebase_request($path, 'PUT', $data, 120);
}

// Firebase key tidak boleh mengandung . # $ [ ] / atau kosong.
function trx_sanitize_key($raw) {
    $key = trim((string)$raw);
    $key = str_replace(['.', '#', '$', '[', ']', '/'], '_', $key);
    return $key === '' ? null : $key;
}
