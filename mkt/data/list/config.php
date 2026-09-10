<?php
// Sesi tahan lama (30 hari, mirip "tetap login" Google) — cookie tidak mati saat browser ditutup
$mkt_session_lifetime = 60 * 60 * 24 * 30;
ini_set('session.gc_maxlifetime', $mkt_session_lifetime);
session_set_cookie_params([
    'lifetime' => $mkt_session_lifetime,
    'path' => '/',
    'domain' => '',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();
date_default_timezone_set('Asia/Jakarta');

// Shutdown handler: kalau ada fatal error PHP yang tidak tertangkap try/catch (mis. koneksi
// Firebase gagal total), tampilkan pesannya di halaman alih-alih blank putih tanpa penjelasan.
register_shutdown_function(function () {
    $err = error_get_last();
    if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        echo '<div style="max-width:900px;margin:40px auto;padding:24px;background:#fff3f3;border:1px solid #f5c2c2;border-radius:16px;font-family:sans-serif;">';
        echo '<h3 style="color:#c0392b;margin-top:0;">⚠️ Terjadi Error Fatal di Server</h3>';
        echo '<p>Halaman gagal dimuat karena error berikut — silakan coba lagi atau laporkan pesan ini:</p>';
        echo '<pre style="white-space:pre-wrap;background:#fff;padding:12px;border-radius:8px;font-size:13px;">' . htmlspecialchars($err['message'] . ' in ' . $err['file'] . ':' . $err['line']) . '</pre>';
        echo '<a href="index.php" style="display:inline-block;margin-top:8px;color:#7335B7;font-weight:600;">&larr; Kembali ke Dashboard Akun</a>';
        echo '</div>';
    }
});

// ============================================================
// PORTOFOLIO DEMO — Firebase Configuration DIGANTI DUMMY TOTAL.
// Versi asli cURL ke Firebase RTDB (project marketing-os-2) dengan
// secret asli. Di versi porto ini SELURUH panggilan live
// DIHILANGKAN TOTAL, diganti baca/tulis ke file JSON dummy lokal
// (data/list_store.json, di-seed dari data/list_seed.json).
// ============================================================
$firebase_secret = 'DUMMY-SECRET-GANTI-SENDIRI';
$firebase_url = 'https://demo-project-default-rtdb.firebaseio.com/data.json';

define('LIST_STORE_FILE', __DIR__ . '/data/list_store.json');
define('LIST_SEED_FILE', __DIR__ . '/data/list_seed.json');

function getDB() {
    $initial = ['accounts' => [], 'whatsapp_numbers' => [], 'logs' => [], 'category_meta' => []];
    $file = file_exists(LIST_STORE_FILE) ? LIST_STORE_FILE : LIST_SEED_FILE;
    $data = file_exists($file) ? json_decode(file_get_contents($file), true) : null;
    if (!is_array($data)) $data = $initial;

    $data['accounts'] = isset($data['accounts']) ? (is_array($data['accounts']) ? $data['accounts'] : []) : [];
    $data['whatsapp_numbers'] = isset($data['whatsapp_numbers']) ? (is_array($data['whatsapp_numbers']) ? $data['whatsapp_numbers'] : []) : [];
    $data['logs'] = isset($data['logs']) ? (is_array($data['logs']) ? $data['logs'] : []) : [];
    $data['category_meta'] = isset($data['category_meta']) ? (is_array($data['category_meta']) ? $data['category_meta'] : []) : [];

    $data['accounts'] = array_values($data['accounts']);
    $data['whatsapp_numbers'] = array_values($data['whatsapp_numbers']);
    $data['logs'] = array_values($data['logs']);

    // Normalisasi Kategori Akun (Trim & Uppercase)
    foreach ($data['accounts'] as &$acc) {
        if (isset($acc['kategori'])) {
            $acc['kategori'] = strtoupper(trim($acc['kategori']));
        }
    }

    return $data;
}

function saveDB($data) {
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($json === false) {
        throw new Exception("Gagal memformat data ke JSON.");
    }
    if (@file_put_contents(LIST_STORE_FILE, $json) === false) {
        throw new Exception("Gagal menyimpan data demo (cek permission folder data/).");
    }
}

function addLog($action) {
    $db = getDB();
    $log = [
        'id' => uniqid(),
        'action' => $action,
        'created_at' => date('Y-m-d H:i:s')
    ];
    // Prepend log
    array_unshift($db['logs'], $log);
    // Keep only last 100 logs
    if (count($db['logs']) > 100) {
        $db['logs'] = array_slice($db['logs'], 0, 100);
    }
    saveDB($db);
}

// Generate fallback ID
function generateId() {
    return uniqid('', true);
}

// Removed local login credentials and handlers

$is_logged_in = isset($_SESSION['login_simasrim']) && $_SESSION['login_simasrim'] === true;

// --- SESSION TIMEOUT: 30 Hari (sliding, mirip Google) — selaras dengan includes/header.php ---
if ($is_logged_in) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $mkt_session_lifetime) {
        session_unset();
        session_destroy();
        header("Location: ../../login.php?reason=timeout");
        exit;
    }
    $_SESSION['last_activity'] = time();
}



function renderHead($title) {
    echo '
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>'.$title.' | SIMASRIM Account</title>
    
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #7335B7;
            --primary-dark: #5A2A8F;
            --accent: #F3700D;
            --bg-soft-purple: #f3effa;
            --text-main: #1e1e2f;
            --bs-primary: #7335B7;
            --bs-primary-rgb: 115, 53, 183;
        }

        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        
        /* Ultra-smooth Apple-level Micro-interactions */
        .btn { 
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.25s ease !important; 
            will-change: transform, box-shadow;
        }
        .btn:active { transform: scale(0.97) !important; }
        .btn-primary { 
            background-color: var(--primary) !important; 
            border-color: var(--primary) !important; 
            color: white !important; 
            box-shadow: 0 4px 12px rgba(115, 53, 183, 0.2) !important; 
        }
        .btn-primary:hover { 
            background-color: var(--primary-dark) !important; 
            box-shadow: 0 8px 24px rgba(115, 53, 183, 0.35) !important; 
            transform: translateY(-1.5px); 
        }

        body { font-family: "Plus Jakarta Sans", sans-serif; color: var(--text-main); background-color: #f8f9fa; overflow-x: hidden; padding-top: 80px; }
        
        .navbar-glass { 
            padding: 0.8rem 0; 
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(24px); 
            -webkit-backdrop-filter: blur(24px);
            position: fixed; 
            top: 0; width: 100%; z-index: 1050; 
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03); 
            border-bottom: 1px solid rgba(0,0,0,0.05); 
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); 
        }
        .navbar-glass .nav-logo-text { color: var(--primary); transition: color 0.3s ease; }
        
        .navbar-nav .nav-link { 
            color: var(--text-main); font-weight: 500; font-size: 0.95rem; padding: 0.5rem 1rem; border-radius: 8px; 
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1); position: relative; 
        }
        .navbar-nav .nav-link:hover { color: var(--primary); background: rgba(115, 53, 183, 0.04); }
        .navbar-nav .nav-link.active { color: var(--primary); background: var(--bg-soft-purple); font-weight: 600; }
        
        .card-glass { 
            background: #ffffff; 
            border: 1px solid rgba(0,0,0,0.04); 
            border-radius: 16px; 
            box-shadow: 0 8px 24px rgba(0,0,0,0.02); 
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1); 
            will-change: transform, box-shadow;
        }
        .card-glass:hover { 
            box-shadow: 0 16px 40px rgba(115, 53, 183, 0.06); 
            transform: translateY(-2px); 
        }
        
        /* Table interactions */
        .table-hover tbody tr { transition: background-color 0.2s ease; cursor: pointer; }
        .table-hover tbody tr:hover { background-color: rgba(115, 53, 183, 0.04) !important; }
        
        /* Dropzone interactions */
        #dropzone { 
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); 
            will-change: transform;
        }
        #dropzone:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 12px 30px rgba(115, 53, 183, 0.08); 
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
    ';
}

function renderNavbar($active = 'dashboard') {
    echo '
    <nav class="navbar navbar-expand-lg fixed-top navbar-glass">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <span class="fs-4 fw-bold nav-logo-text">SIMASRIM<span style="color:var(--accent);">.</span> <span style="color: #2b2b2b;">Account</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="mainNav">
            <ul class="navbar-nav gap-2 align-items-center mt-3 mt-lg-0">
                <li class="nav-item"><a class="nav-link '.($active==='dashboard'?'active':'').'" href="index.php"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link '.($active==='accounts'?'active':'').'" href="accounts.php"><i class="fas fa-users me-1"></i> Akun</a></li>
                <li class="nav-item"><a class="nav-link '.($active==='whatsapp'?'active':'').'" href="whatsapp.php"><i class="fas fa-comment-dots me-1"></i> WhatsApp</a></li>
                <li class="nav-item"><a class="nav-link '.($active==='guide'?'active':'').'" href="guide.php"><i class="fas fa-book-open me-1"></i> Panduan</a></li>
                <li class="nav-item"><a class="nav-link '.($active==='import'?'active':'').'" href="import.php"><i class="fas fa-file-excel me-1"></i> Impor Excel</a></li>
                <li class="nav-item ms-lg-2"><a class="btn btn-sm px-3 rounded-pill" style="color: white; background: var(--primary); border: 1px solid var(--primary); font-weight: 600; box-shadow: 0 4px 10px rgba(115, 53, 183, 0.2); transition: 0.3s;" href="../../index.php" onmouseover="this.style.background=\'var(--accent)\'; this.style.borderColor=\'var(--accent)\'; this.style.transform=\'translateY(-2px)\'; this.style.boxShadow=\'0 6px 16px rgba(243,112,13,0.3)\';" onmouseout="this.style.background=\'var(--primary)\'; this.style.borderColor=\'var(--primary)\'; this.style.transform=\'none\'; this.style.boxShadow=\'0 4px 10px rgba(115,53,183,0.2)\';" onmousedown="this.style.transform=\'translateY(1px) scale(0.95)\'; this.style.boxShadow=\'0 1px 4px rgba(115,53,183,0.15)\';" onmouseup="this.style.transform=\'translateY(-2px)\'; this.style.boxShadow=\'0 6px 16px rgba(243,112,13,0.3)\';"><i class="fas fa-arrow-left me-1"></i> Back to MKT Hub</a></li>
            </ul>
        </div>
      </div>
    </nav>
    ';
}

// Helpers untuk Visual Badge Dinamis (Hashing Color)
function getDynamicBadge($str, $meta = []) {
    if (empty($str)) return '-';
    $bg = '';
    $color = '#1e293b';
    
    // Cek meta (untuk kategori custom color)
    if (isset($meta[$str])) {
        if (isset($meta[$str]['bg'])) $bg = $meta[$str]['bg'];
        if (isset($meta[$str]['color'])) $color = $meta[$str]['color'];
    }
    
    // Jika tidak ada di meta, buat warna otomatis (hash)
    if (empty($bg)) {
        $hash = crc32(strtolower($str));
        $bg = "hsl(" . (abs($hash) % 360) . ", 70%, 90%)";
    }
    
    return '<span class="badge" style="background-color: '.$bg.'; color: '.$color.'; border: 1px solid rgba(0,0,0,0.1);">'.htmlspecialchars($str).'</span>';
}

function renderLogin($error = null) {
    header("Location: ../../login.php");
    exit;
}
?>
