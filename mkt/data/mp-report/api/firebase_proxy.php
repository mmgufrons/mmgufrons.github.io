<?php
// firebase_proxy.php — MP Report (Data Live Marketplace Toko Albani)
// ============================================================
// PORTOFOLIO DEMO — versi asli proxy cURL ke Firebase Realtime
// Database (project albani-store) dengan secret asli. Di versi
// porto ini SELURUH panggilan live DIHILANGKAN TOTAL, diganti
// baca/tulis ke file JSON dummy lokal (api/data/mp_report_store.json,
// di-seed dari api/data/mp_report_seed.json — data penjualan fiktif).
// ============================================================
require_once __DIR__ . '/../../../includes/porto_kv_store.php';
porto_kv_handle_request(__DIR__ . '/data/mp_report_store.json', __DIR__ . '/data/mp_report_seed.json');
