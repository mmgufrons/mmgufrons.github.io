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
    
    <link rel="icon" href="<?= isset($base_url) ? $base_url : '' ?>favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #7335B7;
            --primary-dark: #5A2A8F;
            --accent: #F3700D;
            --secondary: #8091C9;
            --dark-bg: #0f0c29;
            --bg-soft-purple: #f3effa;
            --text-main: #1e1e2f;
        }

        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        .btn-primary { background-color: var(--primary) !important; border-color: var(--primary) !important; color: white !important; }

        body { font-family: 'Plus Jakarta Sans', sans-serif; color: var(--text-main); background-color: #f8f9fa; overflow-x: hidden; }
        
        .navbar-glass { padding: 1rem 0; background: transparent; transition: all 0.3s ease-in-out; position: fixed; top: 0; width: 100%; z-index: 1050; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .navbar-glass.scrolled { background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(20px); padding: 0.8rem 0; box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05); border-bottom: 1px solid rgba(0,0,0,0.05); }
        .navbar-glass .nav-logo-text { color: white; transition: 0.3s; }
        .navbar-glass.scrolled .nav-logo-text { color: var(--primary) !important; }
        
        .navbar-nav .nav-link { color: rgba(255,255,255,0.8); font-weight: 500; font-size: 0.95rem; padding: 0.5rem 1rem; border-radius: 8px; transition: 0.3s; }
        .navbar-glass.scrolled .navbar-nav .nav-link { color: var(--text-main); }
        .navbar-nav .nav-link.active { color: white; background: rgba(255,255,255,0.15); font-weight: 600; }
        .navbar-glass.scrolled .navbar-nav .nav-link.active { color: var(--primary); background: var(--bg-soft-purple); }

        .hero-section { position: relative; padding: 150px 0 80px; background: radial-gradient(circle at top right, #3A1B5E, #1F0D3D, #0f0c29); color: white; overflow: hidden; }
        .hero-blob { position: absolute; width: 600px; height: 600px; background: var(--accent); filter: blur(180px); opacity: 0.2; border-radius: 50%; z-index: 0; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-glass">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
        <span class="fs-4 fw-bold nav-logo-text" id="logoText">SIMASRIM<span style="color:var(--accent);">.</span></span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon" style="filter: brightness(0) invert(1);"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="mainNav">
        <ul class="navbar-nav gap-2 align-items-center mt-3 mt-lg-0">
            <li class="nav-item"><a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">B2B Core Hub</a></li>
            <li class="nav-item"><a class="nav-link <?= ($current_page == 'prosedur.php') ? 'active' : '' ?>" href="prosedur.php">Prosedur Akuisisi</a></li>
            <li class="nav-item"><a class="nav-link" href="../../partner/b2b.php">Progress Tracker</a></li>
            <li class="nav-item ms-lg-2"><a class="btn btn-primary btn-sm px-3 rounded-pill shadow-sm" href="../../index.php"><i class="fas fa-arrow-left me-1"></i> Back to MKT Hub</a></li>
        </ul>
    </div>
  </div>
</nav>