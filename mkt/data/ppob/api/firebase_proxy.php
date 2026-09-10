<?php
// firebase_proxy.php — PPOB SIMASRIM Dashboard
// ============================================================
// PORTOFOLIO DEMO — versi asli proxy cURL ke Firebase Realtime
// Database (project ppob-smsrm-dashboard) dengan secret asli. Di
// versi porto ini SELURUH panggilan live DIHILANGKAN TOTAL, diganti
// baca/tulis ke file JSON dummy lokal (api/data/ppob_store.json,
// di-seed dari api/data/ppob_seed.json — data user/transaksi fiktif).
// ============================================================
require_once __DIR__ . '/../../../includes/porto_kv_store.php';
porto_kv_handle_request(__DIR__ . '/data/ppob_store.json', __DIR__ . '/data/ppob_seed.json');
