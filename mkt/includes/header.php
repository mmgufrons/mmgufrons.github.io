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
// Auto-detect base_path if not set
if (!isset($base_path)) {
    $script_dir = realpath(dirname($_SERVER['SCRIPT_FILENAME']));
    $mkt_dir = realpath(__DIR__ . '/..');
    
    if ($script_dir && $mkt_dir && strpos($script_dir, $mkt_dir) === 0) {
        $rel = trim(substr($script_dir, strlen($mkt_dir)), DIRECTORY_SEPARATOR);
        $depth = $rel === '' ? 0 : substr_count($rel, DIRECTORY_SEPARATOR) + 1;
        $base_path = str_repeat('../', $depth);
    } else {
        // Fallback based on URI
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
        if (strpos($uri, '/mkt/partner/') !== false || strpos($uri, '/mkt/mitra/') !== false) {
            $base_path = '../';
        } else {
            $base_path = '';
        }
    }
}

// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;

// --- SESSION TIMEOUT: 30 Hari (sliding, mirip Google) ---
$timeout = $mkt_session_lifetime;
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    session_unset();
    session_destroy();
    header("Location: " . $base_path . "login.php?reason=timeout");
    exit;
}
$_SESSION['last_activity'] = time();

// Ambil nama file untuk active state
$current_page = basename($_SERVER['PHP_SELF']);

// Base path untuk assets — selalu dari root /mkt/
$_base = $base_path;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SIMASRIM Marketing & Operations Hub. Internal Portal for Blueprint, Campaigns, and SOPs.">
    <meta name="author" content="SIMASRIM">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#7335B7">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= isset($page_title) ? htmlspecialchars($page_title) : 'SIMASRIM | Marketing OS Hub'; ?>">
    <meta property="og:description" content="SIMASRIM Marketing & Operations Hub. Internal Portal for Blueprint, Campaigns, and SOPs.">
    <meta property="og:type" content="website">

    <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'SIMASRIM | Marketing OS Hub'; ?></title>

    <link rel="icon" href="<?= $_base ?>assets/img/favicon.ico" type="image/x-icon">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS (required by index.php, tracker, legal, etc.) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Tailwind CSS (untuk halaman Tailwind-based: LDMS, pitching, dll.) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: {
                preflight: false, // Disable Tailwind CSS reset — let Bootstrap handle it
            },
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        primary: '#7335B7',
                        primaryDark: '#5A2A8F',
                        accent: '#F3700D',
                        bglight: '#f8f9fc'
                    }
                }
            }
        }
    </script>

    <!-- Main MKT Hub CSS (dashboard-card, sidebar, section-title, icon-wrapper, etc.) -->
    <link rel="stylesheet" href="<?= $_base ?>assets/css/style.css">

    <!-- Inline overrides: sidebar ID + layout compatibility (Tailwind + Bootstrap coexist) -->
    <style>
        /* ── Sidebar (ID-based, untuk layout baru) ─────────────── */
        #sidebar {
            width: 280px; height: 100vh; position: fixed; left: 0; top: 0;
            background: linear-gradient(180deg, #3A1B5E, #1F0D3D);
            color: #fff; transition: 0.3s; z-index: 1040; overflow-y: auto;
            border-right: 1px solid rgba(255,255,255,0.05);
            display: flex; flex-direction: column;
        }
        #sidebar::-webkit-scrollbar { width: 6px; }
        #sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        /* Nav items in sidebar (delegated to style.css nav-link) */
        .nav-section-label {
            font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1.5px;
            color: rgba(255,255,255,0.4); font-weight: 700; margin: 0.8rem 1.5rem 0.3rem;
            display: block;
        }

        /* Dropdown submenus */
        .submenu {
            max-height: 0; overflow: hidden;
            transition: max-height 0.4s ease, padding 0.4s ease;
            background: rgba(0,0,0,0.2);
        }
        .submenu.open { max-height: 1200px; padding-bottom: 0.5rem; }

        /* Override Bootstrap / Tailwind Default Blue Focus & Links */
        :root {
            --bs-primary: #7335B7;
            --bs-primary-rgb: 115, 53, 183;
        }
        /* Scope link color to main content only — NOT sidebar */
        #mainContent a { color: var(--primary); text-decoration: none; transition: 0.3s; }
        #mainContent a:hover { color: var(--primary-dark); }
        /* Sidebar links must stay white/light */
        #sidebar a, #sidebar a:hover { color: rgba(255,255,255,0.75); text-decoration: none; }
        #sidebar .nav-item.active, #sidebar .nav-item.active a { color: #fff; }
        .form-control:focus, .form-select:focus, .btn:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 0.25rem rgba(115, 53, 183, 0.25) !important;
            outline: none !important;
        }
        .chevron { transition: transform 0.3s; }
        .chevron.open { transform: rotate(180deg); }
        .nav-divider { border-color: rgba(255,255,255,0.05); margin: 0.5rem 0; }

        /* ── Main Content Area ──────────────────────────────────── */
        #mainContent {
            margin-left: 280px; min-height: 100vh;
            display: flex; flex-direction: column; transition: 0.3s; position: relative;
        }

        /* ── Mobile Navbar ──────────────────────────────────────── */
        .mobile-navbar {
            display: none; background: white; padding: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 1035;
            align-items: center; justify-content: space-between;
        }
        .mobile-navbar .btn-menu { background: none; border: none; font-size: 1.25rem; color: #1e1e2f; cursor: pointer; }

        /* Overlay */
        .sidebar-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,0.5);
            z-index: 1039; display: none; backdrop-filter: blur(4px); opacity: 0; transition: opacity 0.3s;
        }
        .sidebar-overlay.show { display: block; opacity: 1; }

        @media (max-width: 991.98px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #mainContent { margin-left: 0; }
            .mobile-navbar { display: flex; }
        }

        /* ── Bootstrap + Tailwind compat ───────────────────────── */
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9fa; color: #1e1e2f; overflow-x: hidden; }
        a { text-decoration: none; }

        /* Tailwind flex utilities used in sidebar */
        .flex-1 { flex: 1 1 0%; }
        .w-full { width: 100%; }
        .text-left { text-align: left; }
        .text-xs { font-size: 0.75rem; }
        .ml-auto { margin-left: auto; }
        .mt-auto { margin-top: auto; }
        .block { display: block; }
        .inline-block { display: inline-block; }
        .tracking-wide { letter-spacing: 0.025em; }
        .tracking-tight { letter-spacing: -0.025em; }
        .font-extrabold { font-weight: 800; }
        .text-xl { font-size: 1.25rem; line-height: 1.75rem; }
        .text-sm { font-size: 0.875rem; }
        .opacity-50 { opacity: 0.5; }
        .text-white { color: #fff; }
        .rounded-full { border-radius: 9999px; }
        .px-2\.5 { padding-left: 0.625rem; padding-right: 0.625rem; }
        .py-0\.5 { padding-top: 0.125rem; padding-bottom: 0.125rem; }
        .px-5 { padding-left: 1.25rem; padding-right: 1.25rem; }
        .pt-6 { padding-top: 1.5rem; }
        .pb-4 { padding-bottom: 1rem; }
        .mt-1\.5 { margin-top: 0.375rem; }
        .bg-white\/5 { background-color: rgba(255,255,255,0.05); }
        .text-white\/40 { color: rgba(255,255,255,0.4); }
        .font-medium { font-weight: 500; }
    </style>
</head>
<body>

<?php include __DIR__ . '/sidebar.php'; ?>

<!-- Mobile Navbar -->
<div class="mobile-navbar">
    <div style="font-weight:800;font-size:1.25rem;letter-spacing:-0.025em;color:#7335B7;">SIMASRIM<span style="color:#F3700D;">.</span></div>
    <button class="btn-menu" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
</div>

<!-- Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<div id="mainContent">
    <!-- Page Content mulai dari sini, diakhiri oleh footer.php -->

<script>
    function toggleSubmenu(id) {
        var el = document.getElementById(id);
        var chevron = document.getElementById('chevron_' + id);
        if (el.classList.contains('open')) {
            el.classList.remove('open');
            if (chevron) chevron.classList.remove('open');
        } else {
            el.classList.add('open');
            if (chevron) chevron.classList.add('open');
        }
    }

    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
</script>
