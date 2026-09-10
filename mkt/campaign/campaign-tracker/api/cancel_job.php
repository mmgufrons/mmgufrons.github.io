<?php
/**
 * cancel_job.php — Campaign SIMASRIM
 * ============================================================
 * PORTOFOLIO DEMO — versi asli mematikan proses Node.js/Puppeteer
 * di server (posix_kill) dan menghapus lock di Firebase RTDB (secret
 * asli). Di versi porto ini SELURUH eksekusi proses & panggilan live
 * DIHILANGKAN TOTAL. Karena scrape_trigger.php/verify_phone.php versi
 * demo langsung menyelesaikan job secara instan (tidak ada proses
 * background sungguhan), endpoint ini cukup menandai job sebagai
 * dibatalkan di store lokal.
 * ============================================================
 */

session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../../../includes/porto_kv_store.php';

// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;

$input = json_decode(file_get_contents('php://input'), true) ?: [];
$jobId = (string)($input['job_id'] ?? '');

if ($jobId === '') {
    http_response_code(400);
    echo json_encode(['error' => 'job_id wajib dikirim untuk membatalkan proses tertentu.']);
    exit;
}

$storeFile = __DIR__ . '/data/campaign_store.json';
$seedFile  = __DIR__ . '/data/campaign_seed.json';
$tree = porto_kv_load($storeFile, $seedFile);

porto_kv_set($tree, "scrape_jobs/$jobId", ['status' => 'cancelled', 'message' => 'Dibatalkan oleh user (demo).']);
porto_kv_set($tree, "scrape_locks/$jobId", null);
porto_kv_save($storeFile, $tree);

echo json_encode(['ok' => true, 'job_id' => $jobId]);
