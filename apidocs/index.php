<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi API SIMASRIM</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- Tippy.js for Tooltips -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        .api-card {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .api-card i {
            margin-bottom: 0;
            font-size: 2.5rem;
        }
        .api-card .region-code {
            font-size: 1.1rem;
        }
        .disabled-card {
            filter: grayscale(100%);
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }
        .disabled-card .region-code {
            background: #94a3b8;
            -webkit-text-fill-color: #94a3b8;
        }
    </style>
</head>
<body>
    <!-- Abstract Background -->
    <div class="background-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <div class="container">
        <header style="position: relative;">
            <h1>Dokumentasi API SIMASRIM</h1>
            <p>Pusat Integrasi & Pengembangan</p>
        </header>

        <div class="dashboard-grid">
            <section class="category-section">
                <h2>Layanan API</h2>
                <div class="icon-grid">
                    <!-- 1. PPOB -->
                    <a href="https://documenter.getpostman.com/view/36962052/2sBY4HU49Z#cf30e1bd-8b3b-4626-b83d-0a3ae440957d" class="icon-card api-card" target="_blank">
                        <i class="ph-light ph-plug"></i>
                        <span class="region-code">PPOB</span>
                        <div class="tooltip-data" 
                            data-title="API PPOB" 
                            data-desc="Dokumentasi Teknis API PPOB SIMASRIM untuk Integrasi Sistem"></div>
                    </a>

                    <!-- 2. Tiket (Disabled) -->
                    <a href="#" class="icon-card api-card disabled-card">
                        <i class="ph-light ph-airplane-tilt"></i>
                        <span class="region-code">Tiket</span>
                        <div class="tooltip-data" 
                            data-title="API Tiket" 
                            data-desc="Segera Hadir / Coming Soon"></div>
                    </a>

                    <!-- 3. Umroh (Disabled) -->
                    <a href="#" class="icon-card api-card disabled-card">
                        <i class="ph-light ph-mosque"></i>
                        <span class="region-code">Umroh</span>
                        <div class="tooltip-data" 
                            data-title="API Umroh" 
                            data-desc="Segera Hadir / Coming Soon"></div>
                    </a>
                </div>
            </section>
        </div>

        <footer style="text-align: center; margin-top: 4rem; color: var(--text-muted); font-size: 0.9rem; padding-bottom: 2rem;">
            <i class="ph-bold ph-copyright"></i> 2026 <a href="https://simasrim.com" target="_blank" style="color: inherit; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='inherit'">simasrim.com</a>
        </footer>
    </div>

    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
</body>
</html>
