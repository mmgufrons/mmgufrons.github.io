<?php
// =============================================
// BACKEND PHP - PROSES FORM KE WHATSAPP
// =============================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function cleanInput($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    function redirectToWhatsApp($data) {
        // PORTOFOLIO DEMO: nomor WA asli dihapus, diganti nomor dummy.
        $phone = "6280000000000";
        $message = "Halo, saya ingin daftar QRIS Statis2Dinamis!\n\n";
        $message .= "📋 *DATA PENDAFTARAN*\n";
        $message .= "Nama: " . $data['nama'] . "\n";
        $message .= "Email: " . $data['email'] . "\n";
        $message .= "WhatsApp: " . $data['whatsapp'] . "\n\n";
        $message .= "Saya ingin konversi QRIS statis ke dinamis.\n";
        $message .= "Mohon info lengkapnya ya!";
        $encodedMessage = urlencode($message);
        return "https://wa.me/{$phone}?text={$encodedMessage}";
    }

    try {
        $requiredFields = ['nama', 'email', 'whatsapp'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Field $field harus diisi");
            }
        }
        
        $nama = cleanInput($_POST['nama']);
        $email = cleanInput($_POST['email']);
        $whatsapp = cleanInput($_POST['whatsapp']);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Format email tidak valid");
        }
        
        if (!preg_match('/^[0-9]{10,13}$/', $whatsapp)) {
            throw new Exception("Format nomor WhatsApp tidak valid (contoh: 081234567890)");
        }
        
        $whatsappData = [
            'nama' => $nama,
            'email' => $email,
            'whatsapp' => $whatsapp
        ];
        
        header("Location: " . redirectToWhatsApp($whatsappData));
        exit;
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRIS Statis2Dinamis - Solusi Pembayaran QRIS Anti Salah Ketik</title>
    
    <!-- Meta Tags -->
    <meta property="og:title" content="Jasa Pembuatan QRIS statis menjadi Dinamis dan Online" />
    <meta property="og:description" content="Ubah QRIS Statismua menjadi Dinamis dan Online!" />
    <meta property="og:image" content="https://lpqris.smsrm.com/qrisstatis2dinamis.jpg" />
    <meta property="og:url" content="https://lpqris.smsrm.com/" />
    <meta property="og:type" content="website" />

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="favicon.svg">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                            950: '#2e1065',
                        },
                        slate: {
                            850: '#151e2e',
                            900: '#0F172A',
                            950: '#020617',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'border-glow': 'borderGlow 3s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        },
                        borderGlow: {
                            '0%, 100%': { borderColor: 'rgba(124, 58, 237, 0.3)', boxShadow: '0 0 15px rgba(124, 58, 237, 0.2)' },
                            '50%': { borderColor: 'rgba(124, 58, 237, 0.8)', boxShadow: '0 0 25px rgba(124, 58, 237, 0.5)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Lucide Icons & QR Code Generator -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <style>
        ::selection {
            background-color: #7c3aed;
            color: #ffffff;
        }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        .dark .glass-nav {
            background: rgba(15, 23, 42, 0.8);
            border-bottom: 1px solid rgba(30, 41, 59, 0.8);
        }

        .hero-gradient {
            background: radial-gradient(circle at top right, rgba(124, 58, 237, 0.1), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(16, 185, 129, 0.05), transparent 40%);
        }
        
        .dark .hero-gradient {
            background: radial-gradient(circle at top right, rgba(124, 58, 237, 0.15), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(16, 185, 129, 0.1), transparent 40%);
        }

        .text-gradient {
            background: linear-gradient(135deg, #7c3aed 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .dark .text-gradient {
            background: linear-gradient(135deg, #a78bfa 0%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .mockup-frame {
            position: relative;
            border-radius: 24px;
            padding: 8px;
            background: linear-gradient(145deg, #ffffff, #f3f4f6);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255,255,255,0.4);
        }
        
        .dark .mockup-frame {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        
        .mockup-frame img {
            border-radius: 16px;
        }

        .qr-placeholder {
            transition: all 0.5s ease;
        }
        .qr-generating {
            animation: pulse 1s infinite;
            filter: blur(4px) scale(0.95);
        }

        .tilt-card {
            transform-style: preserve-3d;
            transform: perspective(1000px);
            transition: transform 0.2s ease-out;
        }
        .tilt-card-inner {
            transform: translateZ(30px);
        }
        
        .badge-interactive {
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
        }
        .badge-interactive:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 antialiased selection:bg-brand-500 selection:text-white transition-colors duration-300">

    <script>
        // Use user's preference or default to light mode explicitly as requested by user.
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else if (!('theme' in localStorage)) {
            // Defaulting to light mode per user request
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Navigation Bar -->
    <nav class="fixed w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center cursor-pointer" onclick="window.scrollTo(0,0)">
                    <img src="favicon.svg" alt="Logo" class="w-10 h-10 mr-2 rounded-xl shadow-sm">
                    <span class="font-bold text-xl tracking-tight text-slate-900 dark:text-white">QRIS Statis2Dinamis</span>
                </div>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#demo" class="text-slate-600 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 font-medium transition-colors">Demo</a>
                    <a href="#features" class="text-slate-600 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 font-medium transition-colors">Fitur</a>
                    <a href="#pricing" class="text-slate-600 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 font-medium transition-colors">Harga</a>

                    <!-- Theme Toggle -->
                    <button id="theme-toggle" class="p-2 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors" aria-label="Toggle Dark Mode">
                        <i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i>
                        <i data-lucide="moon" class="w-5 h-5 block dark:hidden"></i>
                    </button>

                    <!-- CTA -->
                    <a href="#form" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-brand-600 hover:bg-brand-700 hover:shadow-lg hover:shadow-brand-500/30 dark:hover:shadow-brand-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                        Daftar Sekarang
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center space-x-4">
                    <button id="theme-toggle-mobile" class="p-2 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                        <i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i>
                        <i data-lucide="moon" class="w-5 h-5 block dark:hidden"></i>
                    </button>
                    <button id="mobile-menu-btn" class="text-slate-600 dark:text-slate-300 hover:text-brand-600">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white/95 dark:bg-slate-900/95 backdrop-blur-lg border-t border-slate-200 dark:border-slate-800 transition-all shadow-lg">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="#demo" class="block px-3 py-2 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-md">Demo</a>
                <a href="#features" class="block px-3 py-2 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-md">Fitur</a>
                <a href="#pricing" class="block px-3 py-2 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-md">Harga</a>
                <a href="#form" class="block w-full text-center px-4 py-3 mt-4 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-brand-600 hover:bg-brand-700">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        
        <!-- Hero Section (Full Height) -->
        <section class="relative min-h-screen flex items-center pt-24 pb-12 lg:pt-32 lg:pb-16 overflow-hidden hero-gradient">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
                <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                    
                    <!-- Hero Text -->
                    <div class="lg:col-span-6 text-center lg:text-left mb-16 lg:mb-0">
                        <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-brand-50 dark:bg-brand-500/10 border border-brand-200 dark:border-brand-500/20 text-brand-700 dark:text-brand-300 text-sm font-semibold mb-6 shadow-sm hover:shadow-md transition-shadow cursor-default">
                            <span class="flex h-2.5 w-2.5 relative mr-2">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-500 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-brand-600"></span>
                            </span>
                            💰 0% MDR | ⚡ Notifikasi Instant | 🔒 Bebas Pajak
                        </div>
                        
                        <h1 class="text-5xl sm:text-6xl font-extrabold tracking-tight mb-6 text-slate-900 dark:text-white leading-tight">
                            Stop Loss Akibat <br/>
                            <span class="text-gradient">Salah Ketik Nominal</span> QRIS!
                        </h1>
                        
                        <p class="text-lg text-slate-600 dark:text-slate-400 mb-8 max-w-2xl mx-auto lg:mx-0">
                            Ubah QRIS Statis Anda menjadi QRIS Statis2Dinamis. Customer tinggal scan, nominal otomatis terkunci 100% akurat. Hemat biaya per-transaksi, tanpa pusing urus refund.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="#form" class="inline-flex items-center justify-center px-8 py-4 border border-transparent rounded-xl shadow-lg shadow-brand-500/30 dark:shadow-brand-500/20 text-base font-medium text-white bg-brand-600 hover:bg-brand-700 hover:shadow-brand-500/50 transition-all duration-300 transform hover:-translate-y-1">
                                Konversi Sekarang
                                <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                            </a>
                            <a href="#demo" class="inline-flex items-center justify-center px-8 py-4 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm text-base font-medium text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all duration-300 transform hover:-translate-y-1">
                                Lihat Demo Interaktif
                            </a>
                        </div>
                        
                        <div class="mt-8 flex items-center justify-center lg:justify-start space-x-5 text-sm text-slate-500 dark:text-slate-400 font-medium">
                            <div class="flex items-center">
                                <div class="bg-emerald-100 dark:bg-emerald-900/30 p-1 rounded-full mr-2">
                                    <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                                </div>
                                Bebas Admin
                            </div>
                            <div class="flex items-center">
                                <div class="bg-emerald-100 dark:bg-emerald-900/30 p-1 rounded-full mr-2">
                                    <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                                </div>
                                Bebas Pajak
                            </div>
                            <div class="flex items-center">
                                <div class="bg-emerald-100 dark:bg-emerald-900/30 p-1 rounded-full mr-2">
                                    <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                                </div>
                                Flat 1 Tahun
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hero Image / Graphic -->
                    <div class="lg:col-span-6 relative mt-12 lg:mt-0 z-20">
                        <div class="absolute inset-0 bg-gradient-to-tr from-brand-400/20 to-emerald-400/20 rounded-[40px] blur-3xl transform rotate-6 scale-110 -z-10"></div>
                        
                        <!-- Main Frame Container -->
                        <div class="relative animate-float-slow w-full max-w-lg mx-auto">
                            
                            <div class="mockup-frame z-10 bg-white dark:bg-slate-800">
                                <img src="qrisstatis2dinamis.jpg" onerror="this.src='https://lpqris.smsrm.com/qrisstatis2dinamis.jpg'" alt="Ilustrasi QRIS Statis2Dinamis" class="w-full shadow-lg rounded-2xl">
                            </div>
                            
                            <!-- Floating Badge 1 (Outside the image) -->
                            <div class="absolute -bottom-6 -left-2 sm:-left-6 z-30 badge-interactive bg-white dark:bg-slate-800 rounded-2xl p-4 shadow-xl border border-slate-100 dark:border-slate-700 flex items-center space-x-4 animate-float">
                                <div class="bg-emerald-100 dark:bg-emerald-900/40 p-3 rounded-full">
                                    <i data-lucide="shield-check" class="w-6 h-6 text-emerald-600 dark:text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Pembayaran Berhasil</p>
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">Rp 250.000</p>
                                </div>
                            </div>
                            
                            <!-- Floating Badge 2 (Outside the image) -->
                            <div class="absolute -top-6 -right-2 sm:-right-6 z-30 badge-interactive bg-white dark:bg-slate-800 rounded-2xl p-4 shadow-xl border border-slate-100 dark:border-slate-700 flex items-center space-x-3 animate-float" style="animation-delay: 1.5s;">
                                <div class="bg-brand-100 dark:bg-brand-900/40 p-2 rounded-full">
                                    <i data-lucide="zap" class="w-5 h-5 text-brand-600 dark:text-brand-400"></i>
                                </div>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">0% MDR</p>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- Logos Section -->
        <section class="hidden py-12 bg-white dark:bg-slate-950 border-y border-slate-100 dark:border-slate-800 relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-8">Dipercaya oleh berbagai BRAND</p>
                <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-80">
                    <img src="logo/albanistore.png" alt="Albani Store" class="h-10 md:h-12 object-contain filter grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300 cursor-pointer">
                    <img src="logo/fjk.png" alt="FJK" class="h-10 md:h-12 object-contain filter grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300 cursor-pointer">
                    <img src="logo/ordermudah.png" alt="Order Mudah" class="h-10 md:h-12 object-contain filter grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300 cursor-pointer">
                    <img src="logo/safarme.png" alt="Safar Me" class="h-10 md:h-12 object-contain filter grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300 cursor-pointer">
                    <img src="logo/solusimitraaplikasi.webp" alt="Solusi Mitra Aplikasi" class="h-10 md:h-12 object-contain filter grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300 cursor-pointer">
                </div>
            </div>
        </section>

        <!-- Interactive Demo Section -->
        <section id="demo" class="py-24 bg-slate-50 dark:bg-slate-900 relative overflow-hidden">
            <!-- Background Shape -->
            <div class="absolute -right-64 top-20 w-[500px] h-[500px] bg-brand-100/50 dark:bg-brand-900/20 rounded-full blur-3xl -z-10"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-brand-600 dark:text-brand-400 font-semibold tracking-wide uppercase text-sm mb-3">Simulasi Interaktif</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                        Lihat Bagaimana Sistem Bekerja
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-slate-500 dark:text-slate-400 mx-auto">
                        Coba ketik nominal di bawah ini dan perhatikan bagaimana QR Code secara otomatis di-generate unik dan terupdate secara real-time.
                    </p>
                </div>

                <!-- The Demo Panels (Scaled Down 90%) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center max-w-5xl mx-auto transform scale-90 origin-top">
                    <!-- Merchant Side -->
                    <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-200 dark:border-slate-700 shadow-xl shadow-slate-200/50 dark:shadow-none tilt-card" id="merchantCard">
                        <div class="tilt-card-inner">
                            <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-100 dark:border-slate-700">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 rounded-2xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                                        <i data-lucide="store" class="w-6 h-6 text-brand-600 dark:text-brand-400"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">Layar Kasir Merchant</h3>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Aplikasi POS Anda</p>
                                    </div>
                                </div>
                                <div class="bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-xs font-bold px-3 py-1 rounded-full">
                                    ONLINE
                                </div>
                            </div>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Input Total Belanja Customer</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-transform group-hover:scale-110">
                                            <span class="text-slate-400 dark:text-slate-500 font-bold text-lg">Rp</span>
                                        </div>
                                        <input type="text" id="demoInput" class="block w-full pl-12 pr-4 py-5 border-2 border-slate-200 dark:border-slate-600 rounded-2xl focus:ring-0 focus:border-brand-500 dark:focus:border-brand-500 bg-slate-50 dark:bg-slate-900 hover:bg-white dark:hover:bg-slate-800 text-slate-900 dark:text-white text-2xl font-bold transition-all shadow-inner" placeholder="0" value="">
                                    </div>
                                </div>
                                
                                <button id="simulateBtn" class="w-full flex items-center justify-center px-4 py-5 border border-transparent rounded-2xl shadow-lg shadow-brand-500/20 text-lg font-bold text-white bg-slate-900 dark:bg-brand-600 hover:bg-brand-600 dark:hover:bg-brand-700 transition-all transform hover:-translate-y-1">
                                    <i data-lucide="refresh-cw" class="w-5 h-5 mr-2"></i> Update Layar Pelanggan
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Side -->
                    <div class="flex justify-center tilt-card" id="customerCard">
                        <div class="tilt-card-inner relative bg-white dark:bg-slate-800 rounded-[40px] p-6 border-[12px] border-slate-800 dark:border-slate-950 shadow-2xl w-full max-w-sm ring-4 ring-slate-100 dark:ring-slate-700">
                            <!-- Notch -->
                            <div class="absolute top-0 inset-x-0 h-6 flex justify-center">
                                <div class="w-1/3 h-5 bg-slate-800 dark:bg-slate-950 rounded-b-2xl"></div>
                            </div>
                            
                            <div class="text-center mt-8">
                                <div class="inline-block bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-300 text-xs font-bold px-3 py-1 rounded-full mb-4">
                                    LAYAR PELANGGAN
                                </div>
                                <h3 class="text-sm font-semibold text-slate-500 dark:text-slate-400 mb-1">Scan untuk Membayar</h3>
                                <p class="text-3xl font-extrabold text-slate-900 dark:text-white mb-8 tracking-tight" id="demoAmount">Rp 0</p>
                                
                                <div class="bg-white dark:bg-slate-100 p-6 rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.08)] inline-block relative border border-slate-100 dark:border-slate-300 group">
                                    <div id="qrOverlay" class="absolute inset-0 bg-white/90 backdrop-blur-sm flex items-center justify-center rounded-3xl transition-all duration-300 opacity-0 z-10 pointer-events-none">
                                        <div class="animate-spin rounded-full h-10 w-10 border-4 border-slate-200 border-t-brand-600"></div>
                                    </div>
                                    
                                    <div class="w-48 h-48 bg-white rounded-2xl flex items-center justify-center qr-placeholder relative transition-colors" id="qrContainer">
                                        <!-- Default QR Placeholder -->
                                        <div id="defaultQr">
                                            <i data-lucide="qr-code" class="w-32 h-32 text-slate-400"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-10 pt-6 border-t border-slate-100 dark:border-slate-700 text-left">
                                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2">Simulasikan Bayar Dari Bank:</label>
                                    <div class="flex space-x-3 mb-4">
                                        <select id="bankSelect" class="flex-1 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-200 text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block p-2.5 outline-none transition-colors">
                                            <option value="BCA">BCA</option>
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="BNI">BNI</option>
                                            <option value="BRI">BRI</option>
                                        </select>
                                    </div>
                                    <button id="payBtn" disabled class="w-full flex items-center justify-center px-4 py-3 border border-transparent rounded-xl shadow-lg shadow-emerald-500/20 text-sm font-bold text-white bg-slate-300 dark:bg-slate-700 cursor-not-allowed transition-all">
                                        <i data-lucide="scan" class="w-4 h-4 mr-2"></i> Scan & Bayar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Comparison -->
        <section id="features" class="py-24 bg-white dark:bg-slate-950 border-t border-slate-100 dark:border-slate-800 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-brand-600 dark:text-brand-400 font-semibold tracking-wide uppercase text-sm mb-3">Keunggulan</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                        Tinggalkan Cara Lama yang Berisiko
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-100 dark:border-slate-800 shadow-lg shadow-slate-100/50 dark:shadow-none hover:-translate-y-2 hover:shadow-xl hover:border-brand-200 dark:hover:border-brand-500 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-2xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center mb-6 group-hover:bg-brand-600 transition-colors">
                            <i data-lucide="shield-alert" class="w-7 h-7 text-brand-600 dark:text-brand-400 group-hover:text-white transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Zero Error / Anti Salah</h3>
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Customer tidak perlu lagi ketik nominal. Murni merchant yang tentukan, menghapus 100% risiko salah ketik.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-100 dark:border-slate-800 shadow-lg shadow-slate-100/50 dark:shadow-none hover:-translate-y-2 hover:shadow-xl hover:border-emerald-200 dark:hover:border-emerald-500 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center mb-6 group-hover:bg-emerald-500 transition-colors">
                            <i data-lucide="banknote" class="w-7 h-7 text-emerald-600 dark:text-emerald-400 group-hover:text-white transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">100% Bebas Biaya Transaksi</h3>
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">0% MDR. Tidak ada potongan persentase per transaksi. Transaksi 100 ribu, masuk bersih 100 ribu.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-100 dark:border-slate-800 shadow-lg shadow-slate-100/50 dark:shadow-none hover:-translate-y-2 hover:shadow-xl hover:border-blue-200 dark:hover:border-blue-500 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-2xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors">
                            <i data-lucide="zap" class="w-7 h-7 text-blue-600 dark:text-blue-400 group-hover:text-white transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Notifikasi Instant</h3>
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Hitungan detik setelah customer bayar, notifikasi langsung muncul. Tidak perlu refresh atau cek mutasi manual.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section id="pricing" class="py-24 bg-slate-900 relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute inset-0 z-0">
                <div class="absolute -top-40 right-1/4 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl mix-blend-screen"></div>
                <div class="absolute bottom-10 left-1/4 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl mix-blend-screen"></div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16">
                    <h2 class="text-brand-400 font-semibold tracking-wide uppercase text-sm mb-3">Investasi Pintar</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                        Satu Harga, Akses Penuh
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-slate-400 mx-auto">
                        Tidak ada biaya tersembunyi. Bebas pajak. Bayar sekali untuk setahun.
                    </p>
                </div>

                <div class="max-w-lg mx-auto relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-brand-500 to-emerald-500 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-500"></div>
                    
                    <div class="relative bg-slate-800 rounded-3xl p-8 sm:p-12 border border-slate-700 shadow-2xl overflow-hidden">
                        <!-- Top Banner -->
                        <div class="absolute top-0 right-0 bg-gradient-to-r from-brand-500 to-brand-600 text-white text-xs font-bold px-4 py-1.5 rounded-bl-xl shadow-lg">
                            BEST DEAL
                        </div>

                        <div class="text-center border-b border-slate-700 pb-8">
                            <h3 class="text-2xl font-bold text-white mb-4 uppercase tracking-wider">Lisensi Premium</h3>
                            
                            <p class="text-slate-400 text-sm mb-2">Harga Normal Rp 50.000/bulan (Rp 600.000/tahun)</p>
                            <div class="flex justify-center items-center space-x-3 mb-2">
                                <span class="bg-red-500/10 text-red-400 text-sm font-semibold px-2.5 py-0.5 rounded border border-red-500/20">Hemat Rp 500.000</span>
                                <span class="text-slate-500 line-through text-xl font-medium">Rp 600.000</span>
                            </div>
                            
                            <div class="flex justify-center items-baseline text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-emerald-400">
                                Rp 100<span class="text-4xl font-bold">.000</span>
                            </div>
                            <p class="text-slate-400 mt-3 font-semibold text-lg">/ tahun <span class="text-emerald-400 text-sm ml-2 bg-emerald-400/10 px-2 py-1 rounded-md">Bebas Pajak</span></p>
                        </div>

                        <ul class="mt-8 space-y-5">
                            <li class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-500/30">
                                    <i data-lucide="check" class="h-4 w-4 text-emerald-400"></i>
                                </div>
                                <p class="ml-4 text-base font-medium text-slate-300"><strong class="text-white">Generate QRIS Dinamis</strong> Unlimited</p>
                            </li>
                            <li class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-500/30">
                                    <i data-lucide="check" class="h-4 w-4 text-emerald-400"></i>
                                </div>
                                <p class="ml-4 text-base font-medium text-slate-300"><strong class="text-white">Semua Fitur Premium</strong> Terbuka</p>
                            </li>
                            <li class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-500/30">
                                    <i data-lucide="check" class="h-4 w-4 text-emerald-400"></i>
                                </div>
                                <p class="ml-4 text-base font-medium text-slate-300"><strong class="text-white">Priority Support</strong> WhatsApp</p>
                            </li>
                            <li class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center border border-emerald-500/30">
                                    <i data-lucide="check" class="h-4 w-4 text-emerald-400"></i>
                                </div>
                                <p class="ml-4 text-base font-medium text-slate-300"><strong class="text-white">Update Fitur Gratis</strong> Selamanya</p>
                            </li>
                        </ul>

                        <div class="mt-10">
                            <a href="http://lynk.id/albanistudio/8vxl6zmkxqwz/checkout" class="block w-full py-4 px-6 border border-transparent rounded-xl text-center text-lg font-bold text-slate-900 bg-gradient-to-r from-emerald-400 to-brand-400 hover:from-emerald-300 hover:to-brand-300 shadow-[0_0_20px_rgba(52,211,153,0.4)] transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02]">
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Section -->
        <section id="form" class="py-24 bg-white dark:bg-slate-950 relative overflow-hidden">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="bg-white dark:bg-slate-900 rounded-[40px] shadow-[0_0_50px_rgba(0,0,0,0.05)] border border-slate-100 dark:border-slate-800 overflow-hidden relative">
                    
                    <!-- Decorative header bar -->
                    <div class="h-3 w-full bg-gradient-to-r from-brand-500 via-emerald-500 to-blue-500"></div>
                    
                    <div class="px-6 py-12 sm:p-16">
                        <div class="text-center mb-10">
                            <div class="w-16 h-16 bg-brand-50 dark:bg-brand-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="message-square-text" class="w-8 h-8 text-brand-600 dark:text-brand-400"></i>
                            </div>
                            <h2 class="text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">Daftar Sekarang</h2>
                            <p class="mt-3 text-lg text-slate-500 dark:text-slate-400">Isi data Anda dan tim kami akan segera menghubungi via WhatsApp.</p>
                        </div>
                        
                        <?php if (isset($error)): ?>
                            <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 mb-8 rounded-r-xl shadow-sm">
                                <div class="flex items-center">
                                    <i data-lucide="alert-circle" class="h-5 w-5 text-red-500 mr-3"></i>
                                    <p class="text-sm font-semibold text-red-700 dark:text-red-300"><?php echo $error; ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form method="POST" class="space-y-6">
                            <div>
                                <label for="nama" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap / Nama Toko <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-xl shadow-sm group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-transform group-focus-within:scale-110 group-focus-within:text-brand-500 text-slate-400">
                                        <i data-lucide="user" class="h-5 w-5"></i>
                                    </div>
                                    <input type="text" name="nama" id="nama" required value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>" class="block w-full pl-12 pr-4 py-4 border-2 border-slate-200 dark:border-slate-700 rounded-xl focus:ring-0 focus:border-brand-500 dark:focus:border-brand-500 bg-slate-50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-900 text-slate-900 dark:text-white text-base font-medium transition-colors" placeholder="Budi Santoso">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Alamat Email <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-xl shadow-sm group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-transform group-focus-within:scale-110 group-focus-within:text-brand-500 text-slate-400">
                                        <i data-lucide="mail" class="h-5 w-5"></i>
                                    </div>
                                    <input type="email" name="email" id="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" class="block w-full pl-12 pr-4 py-4 border-2 border-slate-200 dark:border-slate-700 rounded-xl focus:ring-0 focus:border-brand-500 dark:focus:border-brand-500 bg-slate-50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-900 text-slate-900 dark:text-white text-base font-medium transition-colors" placeholder="budi@example.com">
                                </div>
                            </div>

                            <div>
                                <label for="whatsapp" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nomor WhatsApp Aktif <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-xl shadow-sm group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-transform group-focus-within:scale-110 group-focus-within:text-brand-500 text-slate-400">
                                        <i data-lucide="phone" class="h-5 w-5"></i>
                                    </div>
                                    <input type="tel" name="whatsapp" id="whatsapp" required value="<?php echo isset($_POST['whatsapp']) ? htmlspecialchars($_POST['whatsapp']) : ''; ?>" class="block w-full pl-12 pr-4 py-4 border-2 border-slate-200 dark:border-slate-700 rounded-xl focus:ring-0 focus:border-brand-500 dark:focus:border-brand-500 bg-slate-50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-900 text-slate-900 dark:text-white text-base font-medium transition-colors" placeholder="081234567890">
                                </div>
                                <p class="mt-3 text-sm text-slate-500 dark:text-slate-400 flex items-center"><i data-lucide="info" class="w-4 h-4 mr-1"></i> Pastikan nomor aktif agar kami dapat mengirimkan detail aktivasi.</p>
                            </div>

                            <div class="pt-4">
                                <button type="submit" id="submitFormBtn" class="w-full flex justify-center items-center py-4 px-4 border border-transparent rounded-xl shadow-lg shadow-emerald-500/30 text-lg font-bold text-white bg-emerald-600 hover:bg-emerald-700 transition-all duration-300 transform hover:-translate-y-1">
                                    <i data-lucide="send" class="w-5 h-5 mr-2"></i>
                                    Daftar & Lanjut ke WhatsApp
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center mb-4 md:mb-0">
                <img src="favicon.svg" alt="Logo" class="w-8 h-8 mr-3 opacity-80 rounded-md">
                <span class="font-bold text-white text-xl tracking-tight">QRIS Statis2Dinamis</span>
            </div>
            <div class="text-sm text-center md:text-right">
                <p>&copy; <?php echo date('Y'); ?> QRIS Statis2Dinamis. All rights reserved.</p>
                <p class="mt-1">Solusi pembayaran QRIS modern untuk UMKM Indonesia.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Action Button -->
    <a href="https://wa.me/6280000000000?text=Halo,%20saya%20ingin%20tanya%20tentang%20QRIS%20Statis2Dinamis" 
       target="_blank" 
       rel="noopener noreferrer"
       class="fixed bottom-6 right-6 w-14 h-14 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-[0_10px_20px_rgba(16,185,129,0.3)] hover:shadow-[0_10px_25px_rgba(16,185,129,0.5)] hover:bg-emerald-600 hover:scale-110 transition-all duration-300 z-50 group">
        <i data-lucide="message-circle" class="w-7 h-7"></i>
        <!-- Tooltip -->
        <span class="absolute right-16 top-1/2 -translate-y-1/2 bg-slate-900 text-white text-sm font-semibold px-4 py-2 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none shadow-lg">
            Tanya CS Kami
            <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-2 h-2 bg-slate-900 transform rotate-45"></div>
        </span>
    </a>

    <!-- Initialization Scripts -->
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Theme Toggle Logic
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');

        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        themeToggleBtn.addEventListener('click', toggleTheme);
        themeToggleMobileBtn.addEventListener('click', toggleTheme);

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu on link click
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Form Submit Loading State
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submitFormBtn');
        
        if(form && submitBtn) {
            form.addEventListener('submit', (e) => {
                submitBtn.innerHTML = '<div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></div> Memproses...';
                submitBtn.classList.add('opacity-80', 'cursor-not-allowed');
            });
        }

        // --- Interactive Demo Logic (Typing Effect & State Simulation) ---
        const demoInput = document.getElementById('demoInput');
        const demoAmount = document.getElementById('demoAmount');
        const simulateBtn = document.getElementById('simulateBtn');
        const qrOverlay = document.getElementById('qrOverlay');
        const qrContainer = document.getElementById('qrContainer');
        
        let qrcode = null;

        // Fungsi Terbilang (Mengubah angka jadi kata)
        function terbilang(angka) {
            const huruf = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
            let temp = "";
            if (angka < 12) { temp = " " + huruf[angka]; }
            else if (angka < 20) { temp = terbilang(angka - 10) + " belas"; }
            else if (angka < 100) { temp = terbilang(Math.floor(angka / 10)) + " puluh" + terbilang(angka % 10); }
            else if (angka < 200) { temp = " seratus" + terbilang(angka - 100); }
            else if (angka < 1000) { temp = terbilang(Math.floor(angka / 100)) + " ratus" + terbilang(angka % 100); }
            else if (angka < 2000) { temp = " seribu" + terbilang(angka - 1000); }
            else if (angka < 1000000) { temp = terbilang(Math.floor(angka / 1000)) + " ribu" + terbilang(angka % 1000); }
            else if (angka < 1000000000) { temp = terbilang(Math.floor(angka / 1000000)) + " juta" + terbilang(angka % 1000000); }
            return temp.trim();
        }

        // Format Rupiah function
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(number);
        };

        // Auto format input as currency while typing
        demoInput.addEventListener('input', function(e) {
            let value = this.value.replace(/[^0-9]/g, '');
            if(value === '') {
                this.value = '';
                return;
            }
            this.value = formatRupiah(value).replace('Rp', '').trim();
        });

        // Simulate QR Generation
        simulateBtn.addEventListener('click', () => {
            let value = demoInput.value.replace(/[^0-9]/g, '');
            if(value === '' || value === '0') {
                demoAmount.textContent = "Rp 0";
                return;
            }

            // UI Feedback
            simulateBtn.innerHTML = '<div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></div> Updating...';
            simulateBtn.disabled = true;
            qrOverlay.classList.remove('opacity-0');
            qrContainer.classList.add('qr-generating');

            // Simulate Network Delay (800ms)
            setTimeout(() => {
                demoAmount.textContent = formatRupiah(value);
                
                // Real Dynamic QR Code Generation using qrcode.js
                qrContainer.innerHTML = "";
                qrcode = new QRCode(qrContainer, {
                    text: "QRIS_" + value + "_" + Math.random().toString(36).substring(7),
                    width: 192,
                    height: 192,
                    colorDark : "#1e293b",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
                
                // Add padding to QR generated canvas/img to match design
                setTimeout(() => {
                    const qrImg = qrContainer.querySelector('img');
                    if(qrImg) {
                        qrImg.classList.add('rounded-lg', 'p-2');
                    }
                }, 50);

                // Enable Pay Button on Customer Screen
                const payBtn = document.getElementById('payBtn');
                if(payBtn) {
                    payBtn.disabled = false;
                    payBtn.classList.remove('bg-slate-300', 'dark:bg-slate-700', 'cursor-not-allowed');
                    payBtn.classList.add('bg-emerald-600', 'hover:bg-emerald-700', 'cursor-pointer');
                }

                // Reset UI
                simulateBtn.innerHTML = '<i data-lucide="check" class="w-5 h-5 mr-2"></i> Tersinkronisasi';
                simulateBtn.classList.replace('bg-slate-900', 'bg-emerald-600');
                simulateBtn.classList.replace('dark:bg-brand-600', 'dark:bg-emerald-600');
                
                qrOverlay.classList.add('opacity-0');
                qrContainer.classList.remove('qr-generating');
                lucide.createIcons();

                // Revert button text after 2 seconds
                setTimeout(() => {
                    simulateBtn.innerHTML = '<i data-lucide="refresh-cw" class="w-5 h-5 mr-2"></i> Update Layar Pelanggan';
                    simulateBtn.classList.replace('bg-emerald-600', 'bg-slate-900');
                    simulateBtn.classList.replace('dark:bg-emerald-600', 'dark:bg-brand-600');
                    simulateBtn.disabled = false;
                    lucide.createIcons();
                }, 2000);

            }, 800);
        });

        // Trigger simulate on Enter key
        demoInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                simulateBtn.click();
            }
        });

        // Load voices dynamically (browser might take a moment to load them)
        let availableVoices = [];
        window.speechSynthesis.onvoiceschanged = () => {
            availableVoices = window.speechSynthesis.getVoices();
        };

        // Customer Pay Button Logic (Web Speech API & Toast)
        const payBtn = document.getElementById('payBtn');
        const bankSelect = document.getElementById('bankSelect');
        if(payBtn) {
            payBtn.addEventListener('click', () => {
                let value = demoInput.value.replace(/[^0-9]/g, '');
                if(!value || value === '0') return;

                const bank = bankSelect.value;
                const terbilangText = terbilang(parseInt(value));
                const textToSpeak = `Telah diterima ${terbilangText} rupiah, dari bank ${bank}`;

                // UI Feedback on Pay Button
                payBtn.innerHTML = '<div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div> Memproses...';
                
                setTimeout(() => {
                    // 1. Play EDC Beep Sound (Web Audio API)
                    try {
                        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                        const oscillator = audioCtx.createOscillator();
                        const gainNode = audioCtx.createGain();
                        oscillator.type = 'sine';
                        oscillator.frequency.setValueAtTime(880, audioCtx.currentTime); // High pitch beep
                        gainNode.gain.setValueAtTime(0.1, audioCtx.currentTime);
                        oscillator.connect(gainNode);
                        gainNode.connect(audioCtx.destination);
                        oscillator.start();
                        setTimeout(() => oscillator.stop(), 150);
                    } catch(e) { console.log("Audio API not supported"); }

                    // 2. Speak with natural voice setting
                    if ('speechSynthesis' in window) {
                        const utterance = new SpeechSynthesisUtterance(textToSpeak);
                        utterance.lang = 'id-ID';
                        // Try to find a premium or Google native voice if available, else fallback to standard id-ID
                        if(availableVoices.length === 0) availableVoices = window.speechSynthesis.getVoices();
                        const idVoice = availableVoices.find(v => v.lang.includes('id') && (v.name.includes('Google') || v.name.includes('Premium'))) 
                                     || availableVoices.find(v => v.lang.includes('id'));
                        
                        if (idVoice) utterance.voice = idVoice;
                        
                        // Tweak pitch and rate to sound less robotic
                        utterance.rate = 0.95; 
                        utterance.pitch = 1.05; 
                        
                        window.speechSynthesis.speak(utterance);
                    }

                    // 3. Floating Toast Notification
                    const toast = document.createElement('div');
                    toast.className = 'fixed bottom-5 right-5 md:bottom-10 md:right-10 bg-white dark:bg-slate-800 border border-emerald-500/30 shadow-[0_10px_40px_-10px_rgba(16,185,129,0.3)] rounded-2xl p-4 flex items-center space-x-4 transform transition-all duration-500 translate-y-20 opacity-0 z-[100]';
                    toast.innerHTML = `
                        <div class="bg-emerald-500/10 p-2.5 rounded-full">
                            <i data-lucide="check-circle" class="w-6 h-6 text-emerald-500"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 dark:text-white">Pembayaran Berhasil!</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">${formatRupiah(value)} dari ${bank}</p>
                        </div>
                    `;
                    document.body.appendChild(toast);
                    lucide.createIcons();

                    // Animate toast in
                    setTimeout(() => {
                        toast.classList.remove('translate-y-20', 'opacity-0');
                    }, 50);

                    // Success UI on button
                    payBtn.innerHTML = '<i data-lucide="check-circle" class="w-4 h-4 mr-2"></i> Pembayaran Berhasil';
                    lucide.createIcons();
                    
                    // Reset everything after 4 seconds
                    setTimeout(() => {
                        // Animate toast out
                        toast.classList.add('translate-y-20', 'opacity-0');
                        setTimeout(() => toast.remove(), 500);

                        // Reset UI
                        payBtn.innerHTML = '<i data-lucide="scan" class="w-4 h-4 mr-2"></i> Scan & Bayar';
                        payBtn.disabled = true;
                        payBtn.classList.add('bg-slate-300', 'dark:bg-slate-700', 'cursor-not-allowed');
                        payBtn.classList.remove('bg-emerald-600', 'hover:bg-emerald-700', 'cursor-pointer');
                        
                        demoInput.value = '';
                        demoAmount.textContent = "Rp 0";
                        qrContainer.innerHTML = '<div id="defaultQr"><i data-lucide="qr-code" class="w-32 h-32 text-slate-400"></i></div>';
                        lucide.createIcons();
                    }, 4000);
                }, 800);
            });
        }

        // 3D Tilt Effect on Cards
        const tiltCards = document.querySelectorAll('.tilt-card');
        tiltCards.forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = ((y - centerY) / centerY) * -3;
                const rotateY = ((x - centerX) / centerX) * 3;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
                card.style.transition = 'transform 0.5s ease';
            });
            
            card.addEventListener('mouseenter', () => {
                card.style.transition = 'none';
            });
        });
    </script>
</body>
</html>