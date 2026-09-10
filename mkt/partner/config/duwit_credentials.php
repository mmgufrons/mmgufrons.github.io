<?php
/**
 * PORTOFOLIO DEMO — Kredensial API Duwit (Soundbox-QRIS), DUMMY TOTAL.
 * File asli berisi secret key, partner ID, merchant ID, dan RSA private
 * key SUNGGUHAN untuk integrasi payment gateway — SEMUA sudah diganti
 * placeholder di versi porto ini. File ini juga tidak pernah di-include
 * oleh halaman manapun di versi demo (tidak ada integrasi live).
 */

if (!defined('MKT_INTERNAL_INCLUDE')) {
    http_response_code(403);
    exit;
}

define('DUWIT_BASE_URL', 'https://snap-stg.example.com');
define('DUWIT_SECRET_KEY', 'DUMMY-SECRET-GANTI-SENDIRI');
define('DUWIT_PARTNER_ID', 'DUMMY-PARTNER-ID');
define('DUWIT_MERCHANT_ID', 'DUMMY-MERCHANT-ID');
define('DUWIT_PRIVATE_KEY', <<<'PEM'
-----BEGIN RSA PRIVATE KEY-----
DUMMY-KEY-GANTI-SENDIRI-TIDAK-ADA-KUNCI-ASLI-DI-FILE-INI
-----END RSA PRIVATE KEY-----
PEM);
