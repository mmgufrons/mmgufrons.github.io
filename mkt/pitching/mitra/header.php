<?php
session_start();

// --- LOGIKA LOGIN: pakai sesi MKT Hub bersama (login_simasrim), tanpa password terpisah ---
$current_page = basename($_SERVER['PHP_SELF']);
// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= isset($page_title) ? $page_title : 'Portal B2B | SIMASRIM'; ?></title>
    
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* BRAND GUIDELINES & COLOR PALETTE */
        :root {
            --primary: #7335B7;
            --primary-dark: #5A2A8F;
            --accent: #F3700D;
            --secondary: #8091C9;
            --dark-bg: #0f0c29;
            --wa-green: #25D366;
            --wa-bg: #E4EFE7;
            --ai-blue: #0d6efd;
            --bg-soft-purple: #f3effa;
            --text-main: #1e1e2f;
            --text-light: #64748b;
            --success: #20c997;
        }

        /* OVERRIDE BOOTSTRAP PRIMARY COLOR (Biar Biru Default jadi Ungu SIMASRIM) */
        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        .border-primary { border-color: var(--primary) !important; }
        .btn-primary { background-color: var(--primary) !important; border-color: var(--primary) !important; color: white !important; }
        .btn-primary:hover { background-color: var(--primary-dark) !important; border-color: var(--primary-dark) !important; }

        body { font-family: 'Plus Jakarta Sans', sans-serif; color: var(--text-main); background-color: #f8f9fa; overflow-x: hidden; letter-spacing: -0.01em; }
        a { text-decoration: none; transition: 0.3s; }

        /* NAVBAR GLASS EFFECT & MENU STYLING */
        .navbar-glass { padding: 1rem 0; background: transparent; transition: all 0.3s ease-in-out; position: fixed; top: 0; width: 100%; z-index: 1050; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .navbar-glass .nav-logo-text { color: white; transition: 0.3s; }
        .navbar-glass.scrolled { background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(20px); padding: 0.8rem 0; box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05); border-bottom: 1px solid rgba(0,0,0,0.05); }
        .navbar-glass.scrolled .nav-logo-text { color: var(--primary) !important; }
        
        /* Menu Navigasi */
        .navbar-nav .nav-link { color: rgba(255,255,255,0.8); font-weight: 500; font-size: 0.95rem; padding: 0.5rem 1rem; border-radius: 8px; transition: 0.3s; }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { color: white; background: rgba(255,255,255,0.15); font-weight: 600; }
        
        /* Menu Navigasi Saat Di-Scroll (Mode Terang) */
        .navbar-glass.scrolled .navbar-nav .nav-link { color: var(--text-main); }
        .navbar-glass.scrolled .navbar-nav .nav-link:hover, .navbar-glass.scrolled .navbar-nav .nav-link.active { color: var(--primary); background: var(--bg-soft-purple); }
        
        /* Dropdown Styling */
        .dropdown-menu { border: none; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; }
        .dropdown-item { padding: 10px 20px; font-weight: 500; font-size: 0.9rem; color: var(--text-main); transition: 0.2s; }
        .dropdown-item:hover { background-color: var(--bg-soft-purple); color: var(--primary); }
        
        /* Hamburger Menu Icon Fix */
        .navbar-toggler { border: none; outline: none; box-shadow: none !important; }
        .navbar-toggler-icon { filter: brightness(0) invert(1); transition: 0.3s; }
        .navbar-glass.scrolled .navbar-toggler-icon { filter: none; }

        /* UI GLOBAL (Disatukan agar halaman turunan langsung rapi) */
        .hero-section { position: relative; padding: 150px 0 80px; background: radial-gradient(circle at top right, #3A1B5E, #1F0D3D, #0f0c29); color: white; overflow: hidden; width: 100%; }
        /* OPTIMIZATION: Removed filter: blur(180px) which causes extreme GPU stuttering. Using radial-gradient instead. */
        .hero-blob { position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, var(--accent) 0%, transparent 60%); opacity: 0.15; border-radius: 50%; z-index: 0; transform: translate3d(0,0,0); }
        
        .followup-container { max-width: 800px; margin: 0 auto; }
        .step-card { background: #fff; border-radius: 20px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border-left: 5px solid var(--primary); position: relative; }
        .step-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px dashed #eee; padding-bottom: 0.5rem; }
        .chat-bubble { background: var(--wa-bg); border-radius: 0 15px 15px 15px; padding: 1.2rem; position: relative; font-size: 0.95rem; line-height: 1.6; color: #111; margin-bottom: 1rem; }
        .chat-bubble.user-bubble { background: #fff; border: 1px solid #ddd; border-radius: 15px 15px 0 15px; text-align: right; }
        .wa-bold { font-weight: 700; }
        .wa-italic { font-style: italic; }
        .raw-wa-text { display: none; }
        
        .btn-copy { background: white; color: var(--primary); border: 1px solid var(--primary); border-radius: 8px; padding: 0.4rem 1rem; font-weight: 600; font-size: 0.85rem; transition: 0.2s; display: inline-flex; align-items: center; gap: 5px; cursor: pointer; }
        .btn-copy:hover { background: var(--bg-soft-purple); }
        .btn-copy.copied { background: var(--wa-green); color: white; border-color: var(--wa-green); }
        
        .btn-report { background: linear-gradient(135deg, #128C7E, #25D366); color: white; border: none; border-radius: 50px; padding: 10px 25px; font-weight: bold; box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3); transition: 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-report:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4); color: white; }
        
        .fab-report { position: fixed; bottom: 30px; right: 30px; z-index: 1000; background: var(--text-main); color: white; padding: 12px 20px; border-radius: 50px; font-weight: bold; text-decoration: none; box-shadow: 0 10px 25px rgba(0,0,0,0.2); transition: 0.3s; display: flex; align-items: center; gap: 10px; border: 2px solid rgba(255,255,255,0.1); }
        .fab-report:hover { transform: scale(1.05); color: var(--accent); }

        .info-card { background: #fff; border-radius: 20px; padding: 2rem; height: 100%; border: 1px solid rgba(115, 53, 183, 0.08); box-shadow: 0 10px 30px rgba(0,0,0,0.02); transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); }
        .info-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(115, 53, 183, 0.1); border-color: rgba(115, 53, 183, 0.3); }
        .info-icon { width: 65px; height: 65px; display: flex; align-items: center; justify-content: center; border-radius: 18px; font-size: 1.8rem; margin-bottom: 1.5rem; }
        .icon-primary-soft { background-color: var(--bg-soft-purple); color: var(--primary); }
        .icon-accent-soft { background-color: rgba(243, 112, 13, 0.1); color: var(--accent); }
        
        .nav-pills .nav-link { border-radius: 50px; padding: 10px 25px; color: var(--text-main); font-weight: 600; margin-right: 10px; margin-bottom: 10px; border: 1px solid #dee2e6; background: white; transition: 0.3s; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
        .nav-pills .nav-link.active { background-color: var(--primary); color: white; border-color: var(--primary); box-shadow: 0 8px 20px rgba(115, 53, 183, 0.3); transform: translateY(-2px); }
        .nav-pills .nav-link:hover:not(.active) { background-color: var(--bg-soft-purple); border-color: var(--primary); color: var(--primary); transform: translateY(-2px); }
        
        .table-custom { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.02); margin-bottom: 0; }
        .table-custom thead th { background-color: var(--primary); color: white; font-weight: 600; border: none; padding: 18px 15px; text-align: center; vertical-align: middle; letter-spacing: 0.5px; }
        .table-custom tbody td { padding: 15px; vertical-align: middle; text-align: center; border-bottom: 1px dashed #eee; transition: 0.2s; }
        .table-custom tbody tr:hover td { background-color: var(--bg-soft-purple); }
        .badge-override { background: linear-gradient(135deg, var(--accent), #ff903b); color: white; font-size: 0.95rem; padding: 8px 15px; border-radius: 8px; box-shadow: 0 4px 10px rgba(243, 112, 13, 0.3); }
        .tier-box { background: #fff; border: 1px solid #e9ecef; border-radius: 8px; padding: 6px 12px; display: inline-block; font-size: 0.9rem; font-weight: 700; color: var(--text-main); margin: 2px; box-shadow: 0 2px 5px rgba(0,0,0,0.02); transition: 0.3s; }
        .table-custom tbody tr:hover .tier-box { border-color: var(--primary); color: var(--primary); }

        /* --- TWEAK ESTETIKA & UX TAMBAHAN --- */
        
        /* 1. Fix Menu Mobile (Biar teks ga nabrak latar belakang Hero) */
        @media (max-width: 991.98px) {
            .navbar-collapse { 
                background: rgba(255, 255, 255, 0.98); 
                backdrop-filter: blur(10px); 
                padding: 1rem; 
                border-radius: 15px; 
                margin-top: 15px; 
                box-shadow: 0 10px 40px rgba(0,0,0,0.15); 
                border: 1px solid rgba(115, 53, 183, 0.1);
            }
            .navbar-nav .nav-link { color: var(--text-main) !important; font-weight: 600; }
            .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { 
                color: var(--primary) !important; 
                background: var(--bg-soft-purple) !important; 
            }
            .dropdown-menu { background: transparent; box-shadow: none; padding-left: 1rem; }
        }

        /* 2. Fix Judul Tabel Biar Gak Turun/Mleyot */
        .table-custom head th, .table-custom thead th { white-space: nowrap; }

        /* 3. Fix Footer ngasih ruang buat tombol melayang (FAB) */
        footer { padding-bottom: 90px !important; }

        /* --- FIX ANTI BOCOR KANAN-KIRI (MOBILE) --- */
        html, body { max-width: 100vw; overflow-x: hidden !important; }
        .navbar-glass { left: 0; right: 0; max-width: 100vw; }
        .chat-bubble, .wa-italic { word-wrap: break-word !important; word-break: break-word !important; overflow-wrap: break-word !important; white-space: normal; }
    </style>
</head>
<body>

<?php 
    $current_page = basename($_SERVER['PHP_SELF']); 
?>

<nav class="navbar navbar-expand-lg fixed-top navbar-glass">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
        <span class="fs-4 fw-bold nav-logo-text" id="logoText">SIMASRIM<span class="text-accent">.</span></span>
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse justify-content-end" id="mainNav">
        <ul class="navbar-nav gap-2 align-items-center mt-3 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">
                    <i class="fas fa-network-wired d-lg-none me-2"></i>QSIR Super Hub
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'blueprint.php') ? 'active' : '' ?>" href="blueprint.php">
                    <i class="fas fa-file-signature d-lg-none me-2"></i>Blueprint Mitra
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'diskon.php') ? 'active' : '' ?>" href="diskon.php">
                    <i class="fas fa-percentage d-lg-none me-2"></i>Skema Diskon
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'prosedur.php') ? 'active' : '' ?>" href="prosedur.php">
                    <i class="fas fa-tasks d-lg-none me-2"></i>Prosedur
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../mitra/tracker.php">
                    <i class="fas fa-chart-line d-lg-none me-2"></i>Tracker
                </a>
            </li>
            <li class="nav-item ms-lg-2">
                <a class="btn btn-primary btn-sm px-3 rounded-pill shadow-sm" href="../../index.php">
                    <i class="fas fa-arrow-left me-1"></i> Back to MKT Hub
                </a>
            </li>
        </ul>
    </div>
  </div>
</nav>