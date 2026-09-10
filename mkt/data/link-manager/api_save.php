<?php
// ============================================================
// PORTOFOLIO DEMO — api_save.php
// Versi asli meng-upload data ke Firebase RTDB (project smsrm-lm)
// pakai secret asli, termasuk endpoint 'migrate' yang mem-push
// seluruh file lokal ke server. Di versi porto ini SELURUH
// panggilan live DIHILANGKAN TOTAL — data disimpan ke file JSON
// lokal di folder data/ ini saja (persisten di server demo,
// tidak pernah keluar ke Firebase manapun).
// ============================================================
session_start();

// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;

header('Content-Type: application/json');

$target = $_GET['target'] ?? '';

$files = [
    'sta'    => __DIR__ . '/data/sta_data.json',
    'smr'    => __DIR__ . '/data/smr_data.json',
    'portal' => __DIR__ . '/data/portal_data.json',
];

if (!isset($files[$target])) {
    echo json_encode(['status' => 'error', 'message' => 'Target tidak valid']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data === null) {
        echo json_encode(['status' => 'error', 'message' => 'Format data tidak valid (bukan JSON)']);
        exit;
    }

    if (@file_put_contents($files[$target], json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)) !== false) {
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan (demo, lokal saja)']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan file lokal (cek permission folder data/)']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
