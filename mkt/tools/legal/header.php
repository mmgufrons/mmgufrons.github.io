<?php require_once 'auth.php'; require_login(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legal Document Management System</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: '#7335B7',
                        primaryDark: '#5A2A8F',
                        accent: '#F3700D',
                        secondary: '#8091C9',
                        darkBg: '#0f0c29',
                        bgSoftPurple: '#f3effa',
                        textMain: '#1e1e2f',
                        wa: '#25D366'
                    },
                    animation: {
                        'pulse-fast': 'pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- PORTOFOLIO DEMO: Firebase compat SDK asli dihapus (tidak dipakai, lihat footer.php) -->
    
    <style>
        body { background-color: #f8f9fa; color: var(--textMain); overflow-x: hidden; }
        
        /* Navbar Glass (B2B Style) */
        .navbar-glass { 
            padding: 1rem 0; 
            background: transparent; 
            transition: all 0.3s ease-in-out; 
            position: fixed; top: 0; width: 100%; z-index: 1050; 
            border-bottom: 1px solid rgba(255,255,255,0.1); 
        }
        .navbar-glass.scrolled { 
            background: rgba(255, 255, 255, 0.98); 
            backdrop-filter: blur(20px); 
            padding: 0.8rem 0; 
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05); 
            border-bottom: 1px solid rgba(0,0,0,0.05); 
        }
        
        /* Navbar Text Colors */
        .nav-logo-text, .nav-link-item { color: rgba(255,255,255,0.9); transition: 0.3s; }
        .navbar-glass.scrolled .nav-logo-text { color: #7335B7 !important; }
        .navbar-glass.scrolled .nav-link-item { color: #1e1e2f; }
        
        .nav-link-item:hover { color: white; background: rgba(255,255,255,0.15); }
        .navbar-glass.scrolled .nav-link-item:hover { color: #7335B7; background: #f3effa; }
        
        .nav-link-active { color: white; background: rgba(255,255,255,0.15); font-weight: 600; }
        .navbar-glass.scrolled .nav-link-active { color: #7335B7; background: #f3effa; }
        
        /* Hero Section (B2B Style) */
        .hero-section { 
            position: relative; 
            padding: 120px 0 60px; 
            background: radial-gradient(circle at top right, #3A1B5E, #1F0D3D, #0f0c29); 
            color: white; 
            overflow: hidden; 
        }
        .hero-blob { 
            position: absolute; 
            width: 600px; height: 600px; 
            background: #F3700D; 
            filter: blur(180px); 
            opacity: 0.2; 
            border-radius: 50%; 
            z-index: 0;
            top: -100px;
            right: -100px;
        }
        
        /* Hide scrollbar for clean look */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c5a6e6; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #7335B7; }
    </style>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav id="mainNav" class="navbar-glass">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Logo & Brand -->
                <a href="index.php" class="flex items-center gap-2">
                    <span class="text-2xl font-bold nav-logo-text tracking-wide">LDMS<span class="text-accent">.</span></span>
                </a>
                
                <!-- Menu -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-2">
                        <a href="index.php" class="nav-link-item px-3 py-2 rounded-lg text-sm font-medium <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'nav-link-active' : '' ?>">
                            Dashboard
                        </a>
                        <a href="input.php" class="nav-link-item px-3 py-2 rounded-lg text-sm font-medium <?= basename($_SERVER['PHP_SELF']) == 'input.php' ? 'nav-link-active' : '' ?>">
                            Input Data
                        </a>
                        <a href="guidelines.php" class="nav-link-item px-3 py-2 rounded-lg text-sm font-medium <?= basename($_SERVER['PHP_SELF']) == 'guidelines.php' ? 'nav-link-active' : '' ?>">
                            Guidelines
                        </a>
                        <a href="logout.php" class="ml-4 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white px-4 py-1.5 rounded-full text-sm font-medium transition shadow-sm bg-white/10">
                            <i class="fa-solid fa-sign-out-alt"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="nav-logo-text focus:outline-none">
                        <i class="fa-solid fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-xl border-t border-gray-100 absolute w-full top-full left-0">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="index.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:bg-purple-50">Dashboard</a>
                <a href="input.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:bg-purple-50">Input Data</a>
                <a href="guidelines.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:bg-purple-50">Guidelines</a>
                <a href="logout.php" class="block px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-red-50">Logout</a>
            </div>
        </div>
    </nav>
    
    <script>
        // Toggle mobile menu
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        
        // Scroll effect for Navbar
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.getElementById('mainNav').classList.add('scrolled');
            } else {
                document.getElementById('mainNav').classList.remove('scrolled');
            }
        });

        // Ensure scrolled state on load if already scrolled
        if (window.scrollY > 50) {
            document.getElementById('mainNav').classList.add('scrolled');
        }
    </script>
    
    <main class="flex-grow w-full relative z-10">
