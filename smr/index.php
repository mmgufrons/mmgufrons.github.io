<?php
// ============================================================
// PORTOFOLIO DEMO — data selalu dibaca dari file dummy lokal.
// Versi asli mengambil data lewat cURL dari Firebase RTDB;
// di versi porto ini panggilan live SENGAJA DIHILANGKAN TOTAL
// dan diganti fallback lokal yang dipaksa aktif, memakai data fiktif.
// ============================================================
$local_path = __DIR__ . '/data/smr_data.json';
$json_data = file_exists($local_path) ? file_get_contents($local_path) : '{}';
$data = json_decode($json_data, true);

if (!$data) {
    die("Gagal memuat data dummy SMR (data/smr_data.json).");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Informasi - SIMASRIM</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>

    <style>
        html, body {
            width: 100%;
        }
        
        body {
            background: linear-gradient(135deg, #1d1033 0%, #0d081a 100%);
            min-height: 100vh;
            color: white;
            position: relative;
        }

        /* Background Blob Decoration */
        .bg-blob {
            position: absolute;
            filter: blur(70px);
            opacity: 0.6;
            z-index: -1;
            border-radius: 50%;
        }

        .link-button {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Bouncy transition */
            background: rgba(255, 255, 255, 0.12); /* Jauh lebih terlihat */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.25); /* Border terlihat jelas */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); 
            position: relative;
            overflow: hidden;
        }

        .link-button:hover {
            transform: translateY(-5px) scale(1.02);
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5); 
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
        }
        
        .link-button:active {
            transform: translateY(2px) scale(0.97);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.1s ease;
        }

        /* Spesial untuk tombol Highlight / Pembelian */
        .btn-highlight {
            background: linear-gradient(135deg, rgba(147, 51, 234, 0.6), rgba(79, 70, 229, 0.6));
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .btn-highlight:hover {
            background: linear-gradient(135deg, rgba(147, 51, 234, 0.8), rgba(79, 70, 229, 0.8));
            box-shadow: 0 8px 32px rgba(147, 51, 234, 0.5);
            border-color: rgba(255, 255, 255, 0.6);
        }

        /* Spesial untuk tombol WhatsApp */
        .btn-whatsapp {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.6), rgba(21, 128, 61, 0.7));
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .btn-whatsapp:hover {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.8), rgba(21, 128, 61, 0.9));
            box-shadow: 0 8px 32px rgba(34, 197, 94, 0.5);
            border-color: rgba(255, 255, 255, 0.6);
        }
        
        .social-icon {
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            color: rgba(255, 255, 255, 0.7);
        }
        .social-icon:hover {
            transform: scale(1.3) translateY(-3px);
            color: rgba(255, 255, 255, 1);
            filter: drop-shadow(0 4px 10px rgba(255,255,255,0.5));
        }

        /* Toast Animation */
        #toast {
            visibility: hidden;
            opacity: 0;
            transform: translate(-50%, 20px);
            transition: all 0.3s ease;
        }
        #toast.show {
            visibility: visible;
            opacity: 1;
            transform: translate(-50%, 0);
        }
    </style>
</head>
<body class="antialiased relative selection:bg-accent selection:text-white">

    <!-- Background Ornaments Wrapper to prevent horizontal overflow without breaking mobile bounce -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="bg-blob w-72 h-72 bg-purple-600 top-[-5%] right-[-5%]"></div>
        <div class="bg-blob w-96 h-96 bg-indigo-900 bottom-[5%] left-[-10%]"></div>
    </div>
    
    <button id="shareButton" class="fixed top-5 right-5 z-20 p-3 bg-white/10 rounded-full backdrop-blur-md border border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300 hover:scale-110 active:scale-90 group" title="Bagikan halaman ini">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white group-hover:text-accent transition-colors"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
    </button>
    
    <div class="w-full max-w-[480px] mx-auto px-4 py-12 flex flex-col items-center justify-center min-h-screen relative z-10">

        <header class="text-center mb-10 w-full max-w-lg" data-aos="fade-down">
            <div class="relative inline-block mx-auto group">
                <div class="absolute inset-0 bg-primary blur-2xl opacity-40 group-hover:opacity-60 transition-opacity duration-500 rounded-full"></div>
                <a href="https://www.simasrim.com" target="_blank" class="relative z-10 block transition-transform duration-300 hover:scale-105">
                    <img src="https://www.simasrim.com/images/logo.png" alt="Logo Simasrim" class="w-48 h-auto mx-auto object-contain drop-shadow-xl">
                </a>
            </div>
            <p class="text-gray-300 text-sm mt-2 font-medium bg-white/5 inline-block px-4 py-1 rounded-full border border-white/10 backdrop-blur-sm">
                Solusi Pengiriman & Layanan Digital Terintegrasi
            </p>
        </header>

        <main class="w-full max-w-md space-y-4">
            
            <?php foreach ($data['links'] as $link): ?>
                
                <?php if ($link['type'] === 'highlight'): ?>
                    <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank" class="link-button btn-highlight group flex items-center w-full p-4 rounded-full shadow-xl relative overflow-hidden ring-2 ring-white/20 hover:ring-accent transition-all">
                        <span class="absolute inset-y-0 left-4 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.92 20.16,13.19L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z" /></svg>
                        </span>
                        <span class="flex-grow font-bold text-center tracking-wide text-white"><?php echo htmlspecialchars($link['text']); ?></span>
                    </a>
                <?php elseif ($link['type'] === 'whatsapp'): ?>
                    <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank" class="link-button btn-whatsapp group flex items-center w-full p-4 rounded-full shadow-xl relative overflow-hidden ring-2 ring-green-500/30 hover:ring-green-500 transition-all">
                        <span class="absolute inset-y-0 left-4 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 6.46 17.5 2 12.04 2M12.05 19.83C10.58 19.83 9.16 19.44 7.93 18.71L7.65 18.54L4.54 19.36L5.38 16.32L5.19 16.04C4.38 14.78 3.93 13.31 3.93 11.91C3.93 7.45 7.56 3.82 12.05 3.82C16.54 3.82 20.17 7.45 20.17 11.91C20.17 16.37 16.54 20 12.05 20M16.53 14.59C16.28 14.47 15.06 13.87 14.84 13.79C14.62 13.71 14.46 13.67 14.29 13.91C14.13 14.16 13.66 14.71 13.52 14.88C13.37 15.04 13.23 15.06 12.98 14.94C12.73 14.82 11.93 14.56 10.97 13.71C10.22 13.05 9.71 12.22 9.56 11.97C9.42 11.72 9.55 11.59 9.67 11.47C9.78 11.36 9.91 11.21 10.03 11.07C10.16 10.93 10.2 10.83 10.28 10.66C10.37 10.49 10.32 10.35 10.26 10.23C10.2 10.11 9.7 8.87 9.5 8.35C9.29 7.85 9.09 7.92 8.94 7.91C8.8 7.91 8.64 7.91 8.47 7.91C8.31 7.91 8.04 7.97 7.81 8.22C7.58 8.47 6.94 9.07 6.94 10.29C6.94 11.5 7.84 12.68 7.96 12.84C8.09 13 9.7 15.48 12.16 16.54C12.75 16.79 13.21 16.94 13.57 17.06C14.16 17.25 14.69 17.21 15.11 17.14C15.58 17.06 16.53 16.55 16.73 15.97C16.94 15.39 16.94 14.89 16.88 14.77C16.82 14.66 16.65 14.59 16.41 14.47" /></svg>
                        </span>
                        <span class="flex-grow font-bold text-center tracking-wide text-white"><?php echo htmlspecialchars($link['text']); ?></span>
                    </a>
                <?php elseif ($link['type'] === 'pembelian'): ?>
                    <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank" class="link-button group flex items-center w-full p-4 rounded-full shadow-lg relative overflow-hidden">
                        <div class="absolute left-0 w-1 h-full bg-accent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <span class="absolute inset-y-0 left-4 flex items-center justify-center text-white/50 group-hover:text-accent transition-colors">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        </span>
                        <span class="flex-grow font-semibold text-center tracking-wide group-hover:text-white transition-colors"><?php echo htmlspecialchars($link['text']); ?></span>
                    </a>
                <?php elseif ($link['type'] === 'daftar'): ?>
                    <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank" class="link-button group flex items-center w-full p-4 rounded-full shadow-lg relative overflow-hidden">
                        <div class="absolute left-0 w-1 h-full bg-accent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <span class="flex-grow font-semibold text-center tracking-wide group-hover:text-white transition-colors pl-6"><?php echo htmlspecialchars($link['text']); ?></span>
                        <i class="absolute right-6 opacity-50 group-hover:opacity-100 group-hover:text-accent transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </i>
                    </a>
                <?php else: ?>
                    <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank" class="link-button group flex items-center w-full p-4 rounded-full shadow-lg relative overflow-hidden">
                        <div class="absolute left-0 w-1 h-full <?php echo isset($link['hoverColor']) && $link['hoverColor'] ? htmlspecialchars($link['hoverColor']) : 'bg-accent'; ?> opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <span class="flex-grow font-semibold text-center tracking-wide group-hover:text-white transition-colors"><?php echo htmlspecialchars($link['text']); ?></span>
                    </a>
                <?php endif; ?>

            <?php endforeach; ?>

        </main>

        <footer class="mt-16 text-center w-full">
            <p class="font-medium mb-6 text-gray-400 text-sm tracking-wide uppercase">Temukan kami di media sosial</p>
            <div class="flex justify-center space-x-8">
                <?php
                if (!empty($data['socials'])) {
                    $icons = [
                        'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" /></svg>',
                        'tiktok' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M21,7V9a1,1,0,0,1-1,1,8,8,0,0,1-4-1.08V15.5A6.5,6.5,0,1,1,6.53,9.72a1,1,0,0,1,1.47.9v2.52a.92.92,0,0,1-.28.62,2.49,2.49,0,0,0,2,4.23A2.61,2.61,0,0,0,12,15.35V3a1,1,0,0,1,1-1h2.11a1,1,0,0,1,1,.83A4,4,0,0,0,20,6,1,1,0,0,1,21,7Z"/></svg>',
                        'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>',
                        'youtube' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M21.582,6.186c-0.23-0.86-0.908-1.538-1.768-1.768C18.254,4,12,4,12,4s-6.254,0-7.814,0.418 c-0.86,0.23-1.538,0.908-1.768,1.768C2,7.746,2,12,2,12s0,4.254,0.418,5.814c0.23,0.86,0.908,1.538,1.768,1.768 C5.746,20,12,20,12,20s6.254,0,7.814-0.418c0.86-0.23,1.538-0.908,1.768-1.768C22,16.254,22,12,22,12S22,7.746,21.582,6.186z M10,15.464V8.536L16,12L10,15.464z"/></svg>',
                        'facebook' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"/></svg>',
                        'twitter' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22L15.3 9.7L23.2 22H17L12.1 14.5L6.6 22H3.5L10.6 13.8L3.2 2H9.6L14.1 8.9L18.9 2ZM17.8 20.3H19.5L8.5 3.5H6.7L17.8 20.3Z"/></svg>',
                        'website' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>'
                    ];
                    
                    foreach ($data['socials'] as $soc) {
                        if (!empty($soc['url']) && !empty($soc['platform'])) {
                            $platform = strtolower($soc['platform']);
                            $icon = $icons[$platform] ?? $icons['website']; // Default to website globe
                            echo '<a href="' . htmlspecialchars($soc['url']) . '" target="_blank" class="social-icon">' . $icon . '</a>';
                        }
                    }
                }
                ?>
            </div>
            <p class="text-white/40 text-xs mt-8 font-light">&copy; 2026 PT Solusi Mitra Aplikasi.</p>
        </footer>
    </div>
    
    <div id="toast" class="fixed bottom-8 left-1/2 -translate-x-1/2 bg-gray-900 text-white px-6 py-3 rounded-full text-sm font-medium shadow-2xl border border-gray-700 flex items-center gap-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        Link berhasil disalin!
    </div>

    <script>
        const shareButton = document.getElementById('shareButton');
        const toast = document.getElementById('toast');

        shareButton.addEventListener('click', async () => {
            const shareData = {
                title: 'Pusat Informasi - SIMASRIM',
                text: 'Akses semua link penting SIMASRIM di sini!',
                url: window.location.href
            };

            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                } else {
                    fallbackCopyToClipboard(window.location.href);
                }
            } catch (err) {
                console.error("Share failed:", err);
                fallbackCopyToClipboard(window.location.href);
            }
        });

        function fallbackCopyToClipboard(text) {
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = "fixed";
            textArea.style.opacity = "0";

            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                document.execCommand('copy');
                showToast();
            } catch (err) {
                console.error('Fallback: Gagal menyalin link', err);
            }

            document.body.removeChild(textArea);
        }

        function showToast() {
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }
    </script>
</body>
</html>
