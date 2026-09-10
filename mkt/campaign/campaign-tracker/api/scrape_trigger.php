<?php
/**
 * scrape_trigger.php — Campaign SIMASRIM
 * ============================================================
 * PORTOFOLIO DEMO — versi asli men-spawn proses Node.js/Puppeteer
 * di server untuk scraping Google Maps, lalu menyimpan progres ke
 * Firebase RTDB (dengan secret asli). Di versi porto ini SELURUH
 * eksekusi proses & panggilan live DIHILANGKAN TOTAL. Endpoint ini
 * hanya mensimulasikan 1 job yang langsung selesai dengan beberapa
 * hasil dummy, supaya alur UI (trigger → polling status → tabel
 * hasil) tetap bisa didemokan tanpa server/browser automation asli.
 * ============================================================
 */

session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../../../includes/porto_kv_store.php';

// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;

$storeFile = __DIR__ . '/data/campaign_store.json';
$seedFile  = __DIR__ . '/data/campaign_seed.json';

$input   = json_decode(file_get_contents('php://input'), true) ?: [];
$keyword = trim((string)($input['keyword'] ?? 'Koperasi'));
$city    = trim((string)($input['city'] ?? 'Kota Contoh'));

$jobId = 'collect_' . date('Ymd_His') . '_' . substr(md5(uniqid('', true)), 0, 6);

// Hasil dummy — simulasi 4 lokasi ditemukan
$dummyResults = [];
for ($i = 1; $i <= 4; $i++) {
    $dummyResults["place_$i"] = [
        'nama' => "$keyword Contoh $i ($city)",
        'alamat' => "Jl. Contoh No. $i, $city",
        'link' => 'https://www.google.com/maps/place/contoh-dummy-' . $i,
        'phone' => null, // Sengaja kosong — diisi lewat verify_phone.php (simulasi juga)
    ];
}

$tree = porto_kv_load($storeFile, $seedFile);
porto_kv_set($tree, "scrape_jobs/$jobId", [
    'status' => 'done',
    'combo' => "$keyword @ $city",
    'message' => 'Simulasi selesai (demo, tanpa scraping asli).',
    'found' => count($dummyResults),
    'target' => count($dummyResults),
    'pid' => 0,
    'created_at' => round(microtime(true) * 1000),
]);
porto_kv_set($tree, "scrape_staging/$jobId", $dummyResults);
porto_kv_save($storeFile, $tree);

echo json_encode(['job_id' => $jobId]);
