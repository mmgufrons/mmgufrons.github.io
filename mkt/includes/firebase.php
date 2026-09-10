<?php
// includes/firebase.php
// ============================================================
// PORTOFOLIO DEMO — versi asli melakukan cURL langsung ke Firebase
// Realtime Database (dengan FIREBASE_URL + FIREBASE_SECRET asli).
// Di versi porto ini, SELURUH panggilan live DIHILANGKAN TOTAL dan
// diganti baca/tulis ke satu file JSON dummy lokal
// (includes/data/porto_firebase_store.json), supaya semua halaman
// yang memanggil firebase_get()/firebase_put()/dst tetap berjalan
// tanpa pernah menghubungi server manapun.
// ============================================================
define('FIREBASE_URL', 'https://demo-project-default-rtdb.firebaseio.com');
define('FIREBASE_SECRET', 'DUMMY-SECRET-GANTI-SENDIRI');

define('PORTO_FIREBASE_STORE', __DIR__ . '/data/porto_firebase_store.json');
define('PORTO_FIREBASE_SEED', __DIR__ . '/data/porto_firebase_seed.json');

function _porto_fb_load_store() {
    $file = file_exists(PORTO_FIREBASE_STORE) ? PORTO_FIREBASE_STORE : PORTO_FIREBASE_SEED;
    if (!file_exists($file)) return [];
    $raw = file_get_contents($file);
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

function _porto_fb_save_store($tree) {
    @file_put_contents(PORTO_FIREBASE_STORE, json_encode($tree, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}

function _porto_fb_path_parts($path) {
    return array_values(array_filter(explode('/', trim($path, '/')), fn($p) => $p !== ''));
}

function _porto_fb_get(&$tree, $path) {
    $parts = _porto_fb_path_parts($path);
    $cur = $tree;
    foreach ($parts as $p) {
        if (!is_array($cur) || !array_key_exists($p, $cur)) return null;
        $cur = $cur[$p];
    }
    return $cur;
}

function _porto_fb_set(&$tree, $path, $value) {
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

function firebase_request($path, $method = 'GET', $data = null) {
    // Method di sini dipertahankan agar signature kompatibel dengan caller lama,
    // tapi tidak pernah benar-benar melakukan HTTP request.
    $tree = _porto_fb_load_store();

    if ($method === 'GET') {
        return _porto_fb_get($tree, $path);
    }

    if ($method === 'PUT') {
        _porto_fb_set($tree, $path, $data);
        _porto_fb_save_store($tree);
        return $data;
    }

    if ($method === 'PATCH') {
        $existing = _porto_fb_get($tree, $path);
        if (!is_array($existing)) $existing = [];
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $existing[$k] = $v;
            }
        }
        _porto_fb_set($tree, $path, $existing);
        _porto_fb_save_store($tree);
        return $existing;
    }

    if ($method === 'DELETE') {
        _porto_fb_set($tree, $path, null);
        _porto_fb_save_store($tree);
        return null;
    }

    return null;
}

function firebase_get($path) {
    return firebase_request($path, 'GET');
}

function firebase_put($path, $data) {
    return firebase_request($path, 'PUT', $data);
}

function firebase_patch($path, $data) {
    return firebase_request($path, 'PATCH', $data);
}

function firebase_delete($path) {
    return firebase_request($path, 'DELETE');
}
