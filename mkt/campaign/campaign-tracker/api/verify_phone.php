<?php
/**
 * verify_phone.php — Campaign SIMASRIM
 * ============================================================
 * PORTOFOLIO DEMO — versi asli men-spawn proses Node.js/Puppeteer
 * untuk membuka tiap link Google Maps dan mengambil nomor telepon,
 * lalu menyimpan progres ke Firebase RTDB (dengan secret asli). Di
 * versi porto ini SELURUH eksekusi proses & panggilan live
 * DIHILANGKAN TOTAL — endpoint hanya mensimulasikan job yang
 * langsung "selesai" dengan nomor dummy, supaya alur UI tetap bisa
 * didemokan.
 * ============================================================
 */

session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../../../includes/porto_kv_store.php';

// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;

define('MAX_ITEMS', 15);

$input = json_decode(file_get_contents('php://input'), true) ?: [];
$items = $input['items'] ?? [];

if (!is_array($items) || count($items) === 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Tidak ada lokasi yang dipilih untuk diverifikasi.']);
    exit;
}
if (count($items) > MAX_ITEMS) {
    http_response_code(400);
    echo json_encode(['error' => 'Maksimal ' . MAX_ITEMS . ' lokasi per sekali verifikasi.']);
    exit;
}

$storeFile = __DIR__ . '/data/campaign_store.json';
$seedFile  = __DIR__ . '/data/campaign_seed.json';
$tree = porto_kv_load($storeFile, $seedFile);

$verifyJobId = 'verify_' . date('Ymd_His') . '_' . substr(md5(uniqid('', true)), 0, 6);
$results = [];
$n = 1;
foreach ($items as $it) {
    $placeKey = (string)($it['placeKey'] ?? ('place_' . $n));
    $results[$placeKey] = ['phone' => '628110000' . str_pad((string)$n, 3, '0', STR_PAD_LEFT)];
    $n++;
}

porto_kv_set($tree, "scrape_jobs/$verifyJobId", [
    'status' => 'done',
    'combo' => 'Verifikasi ' . count($items) . ' nomor (demo)',
    'message' => 'Simulasi verifikasi selesai (demo, tanpa scraping asli).',
    'found' => count($results),
    'target' => count($items),
    'pid' => 0,
    'created_at' => round(microtime(true) * 1000),
]);
porto_kv_set($tree, "scrape_verify_result/$verifyJobId", $results);
porto_kv_save($storeFile, $tree);

echo json_encode(['verify_job_id' => $verifyJobId]);
