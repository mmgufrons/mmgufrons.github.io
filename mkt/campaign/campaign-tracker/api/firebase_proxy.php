<?php
/**
 * firebase_proxy.php — Campaign SIMASRIM
 * ============================================================
 * PORTOFOLIO DEMO — versi asli adalah proxy cURL ke Firebase
 * Realtime Database (project campaign-smsrm) dengan secret asli.
 * Di versi porto ini SELURUH panggilan live DIHILANGKAN TOTAL,
 * diganti baca/tulis ke file JSON dummy lokal (api/data/campaign_store.json,
 * di-seed dari api/data/campaign_seed.json — leads WA & Email fiktif).
 * ============================================================
 */

session_start();
require_once __DIR__ . '/../../../includes/porto_kv_store.php';

// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;

porto_kv_handle_request(__DIR__ . '/data/campaign_store.json', __DIR__ . '/data/campaign_seed.json');
