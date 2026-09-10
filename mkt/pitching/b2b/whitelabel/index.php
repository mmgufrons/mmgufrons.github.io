<?php 
$page_title = "Exclusive White Label Partnership | SIMASRIM";
$base_url = '../'; // Ini yang bikin favicon & aset narik dari folder luar dengan benar
include '../header.php'; 
?>

<style>
    /* PREMIUM DARK PURPLE THEME UNTUK WHITE LABEL (PRESENTATION MODE) */
    body { background-color: #080410 !important; color: #fff; }
    
    /* FIX HEADER: OVERRIDE AGAR TETAP GELAP SAAT SCROLL */
    .navbar-glass.scrolled { background: rgba(8, 4, 16, 0.98) !important; border-bottom: 1px solid rgba(115, 53, 183, 0.2); }
    .navbar-glass.scrolled .nav-logo-text { color: #fff !important; }
    .navbar-glass.scrolled .nav-link { color: rgba(255,255,255,0.7) !important; }
    .navbar-glass.scrolled .nav-link:hover { color: #fff !important; background: rgba(115, 53, 183, 0.2) !important; }
    .navbar-glass.scrolled .nav-link.active { color: #fff !important; background: #7335B7 !important; }

    .hero-wl { position: relative; padding: 180px 0 100px; background: #080410; overflow: hidden; border-bottom: 1px solid rgba(115, 53, 183, 0.1); }
    .hero-glow { position: absolute; width: 800px; height: 800px; background: radial-gradient(circle, rgba(115, 53, 183, 0.25) 0%, rgba(8, 4, 16, 0) 70%); top: -20%; left: 50%; transform: translateX(-50%); z-index: 0; }
    
    .wl-card { background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; padding: 2.5rem; transition: 0.4s ease; height: 100%; backdrop-filter: blur(10px); }
    .wl-card:hover { transform: translateY(-10px); border-color: #7335B7; box-shadow: 0 20px 40px rgba(115, 53, 183, 0.15); background: rgba(115, 53, 183, 0.05); }
    
    .icon-vip { width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border-radius: 20px; font-size: 2rem; background: rgba(115, 53, 183, 0.15); color: #9d4edd; margin-bottom: 1.5rem; border: 1px solid rgba(115, 53, 183, 0.3); transition: 0.3s; }
    .wl-card:hover .icon-vip { background: #7335B7; color: #fff; transform: scale(1.1) rotate(5deg); }

    .matrix-box { background: rgba(0, 0, 0, 0.3); border: 1px solid rgba(115, 53, 183, 0.15); border-radius: 20px; padding: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
</style>

<section class="hero-wl text-center">
    <div class="hero-glow"></div>
    <div class="container position-relative z-1">
        <span class="badge rounded-pill px-4 py-2 fw-bold mb-4" style="background: rgba(115, 53, 183, 0.2); color: #d8b4fe; border: 1px solid rgba(115, 53, 183, 0.4); letter-spacing: 1px;">
            <i class="fas fa-gem me-2"></i> VIP ENTERPRISE INFRASTRUCTURE
        </span>
        <h1 class="display-3 fw-bold mb-4 text-white" data-aos="fade-up">
            Brand Perusahaan Anda, <br><span style="color: #9d4edd;">Mesin Logistik Kami.</span>
        </h1>
        <p class="lead text-white-50 max-w-2xl mx-auto mb-0" data-aos="fade-up" data-aos-delay="100">
            Lompatan ekspansi tanpa batas. Miliki ekosistem aplikasi logistik dan pembayaran digital dengan <b>identitas brand Anda sendiri</b> tanpa perlu memikirkan riset, pengembangan, maupun beban <i>maintenance</i> IT server.
        </p>
    </div>
</section>

<section class="py-5" style="background: #0a0614;">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="fw-bold text-uppercase ls-2" style="color: #9d4edd;">Keunggulan Strategis</h6>
            <h2 class="fw-bold text-white">Dominasi Pasar dengan Skema White Label</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="wl-card">
                    <div class="icon-vip"><i class="fas fa-paint-brush"></i></div>
                    <h4 class="fw-bold text-white mb-3">100% Brand Ownership</h4>
                    <p class="text-white-50 small mb-0">Aplikasi Android (APK) dan Web Dashboard operasional dikompilasi secara eksklusif menggunakan nama, logo, dan identitas visual korporasi Anda. Ekosistem keagenan hanya akan mengenal identitas bisnis Anda.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="wl-card">
                    <div class="icon-vip"><i class="fas fa-server"></i></div>
                    <h4 class="fw-bold text-white mb-3">Zero IT Maintenance</h4>
                    <p class="text-white-50 small mb-0">Fokuskan sumber daya Anda murni pada ekspansi pasar. Seluruh beban operasional server infrastruktur, mitigasi sistem, dan interkoneksi ke ekspedisi nasional mutlak kami kelola di <i>backend</i> SIMASRIM.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="wl-card">
                    <div class="icon-vip"><i class="fas fa-hand-holding-usd"></i></div>
                    <h4 class="fw-bold text-white mb-3">Enterprise Profit Sharing</h4>
                    <p class="text-white-50 small mb-0">Atur mandiri keuntungan bisnis Anda. Dapatkan margin optimal dari setiap cetak resi logistik maupun transaksi PPOB agen di bawah jaringan Anda dengan skema pembagian komisi yang transparan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: #080410;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <span class="badge bg-white text-dark rounded-pill px-3 py-1 fw-bold mb-3">SYARAT & KETENTUAN</span>
                <h2 class="fw-bold text-white mb-4">Arsitektur Hukum <br>dan <span style="color: #9d4edd;">Kendali Sistem</span></h2>
                <p class="text-white-50 mb-4">Mengingat skala dan kompleksitasnya, kemitraan White Label menuntut komitmen serius dari kedua belah pihak. Berikut adalah kerangka dasar kerja sama sebelum melangkah ke tahap pengikatan Perjanjian Kerja Sama (PKS).</p>
                
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div style="color: #9d4edd; margin-top: 2px;"><i class="fas fa-check-circle fs-5"></i></div>
                    <div>
                        <h6 class="fw-bold text-white mb-1">Setup Fee & Lisensi Aplikasi</h6>
                        <p class="text-white-50 small mb-0">Skema ini mewajibkan adanya biaya lisensi awal (<i>Setup Fee</i>) yang ditujukan untuk kompilasi APK khusus, perakitan <i>server</i> terdedikasi, serta modifikasi <i>Web Dashboard</i>.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div style="color: #9d4edd; margin-top: 2px;"><i class="fas fa-lock fs-5"></i></div>
                    <div>
                        <h6 class="fw-bold text-white mb-1">Kontrol Mutlak Arus Transaksi (Backend)</h6>
                        <p class="text-white-50 small mb-0">Demi mitigasi risiko keamanan tingkat tinggi, SIMASRIM memegang kendali absolut atas seluruh perputaran dana dan rute koneksi (API) ekspedisi pada <i>server backend</i>.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-3">
                    <div style="color: #9d4edd; margin-top: 2px;"><i class="fas fa-folder-open fs-5"></i></div>
                    <div>
                        <h6 class="fw-bold text-white mb-1">Dukungan Standardisasi Sales Kit</h6>
                        <p class="text-white-50 small mb-0">Pusat akan mensuplai mitra dengan <i>Partner Deck</i> (materi presentasi netral) untuk mempermudah proses pemasaran dan rekrutmen gerai agen baru di lapangan.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="matrix-box">
                    <h5 class="fw-bold text-white mb-4 text-center border-bottom border-secondary pb-3">Matriks Komparasi Sistem</h5>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-white-50 small">Aplikasi Android (APK)</span>
                        <span class="text-white fw-bold small bg-primary bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-check text-info me-1"></i> Custom Brand</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-white-50 small">Web Dashboard Admin</span>
                        <span class="text-white fw-bold small bg-primary bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-check text-info me-1"></i> Custom Domain</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-white-50 small">Koneksi Ekspedisi & PPOB</span>
                        <span class="text-white fw-bold small bg-primary bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-check text-info me-1"></i> Pre-Integrated</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-white-50 small">Sistem User (Hak Akses)</span>
                        <span class="text-white fw-bold small"><i class="fas fa-users text-warning me-1"></i> Multi-User (Agen)</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-white-50 small">Biaya Pemeliharaan Sistem</span>
                        <span class="text-white fw-bold small"><i class="fas fa-percentage text-warning me-1"></i> Platform Fee (via User)</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-white-50 small">Infrastruktur Server</span>
                        <span class="text-white fw-bold small"><i class="fas fa-lock text-success me-1"></i> Dikelola SIMASRIM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-4 text-center" style="background: #05020a; border-top: 1px solid rgba(115, 53, 183, 0.1);">
    <div class="container">
        <p class="text-white-50 small mb-0">
            Pemaparan ini bersifat internal dan ditujukan khusus bagi sesi diskusi komersial (<i>Pitching</i>) bersama representatif manajemen SIMASRIM.
        </p>
    </div>
</section>

<?php include '../footer.php'; ?>