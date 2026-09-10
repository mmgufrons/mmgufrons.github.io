<?php 
$page_title = "Infrastruktur B2B & Solusi Kemitraan | SIMASRIM";
include 'header.php'; 
?>

<style>
    /* CORE PRESENTATION SYSTEM UI */
    .hero-presentation { min-height: 100vh; display: flex; align-items: center; position: relative; padding-top: 80px; background: radial-gradient(circle at top right, #2c1449, #130826, #090314); color: white; overflow: hidden; }
    .hero-blob-presentation { position: absolute; width: 700px; height: 700px; background: var(--primary); filter: blur(180px); opacity: 0.3; border-radius: 50%; top: -10%; right: -10%; z-index: 0; }
    
    .solution-card { border-radius: 20px; padding: 2rem; border: 1px solid rgba(115, 53, 183, 0.1); background: #fff; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); height: 100%; position: relative; display: flex; flex-direction: column; justify-content: space-between; }
    .solution-card:hover { transform: translateY(-8px); border-color: var(--primary); box-shadow: 0 20px 40px rgba(115, 53, 183, 0.12); }
    
    .icon-wrapper-api { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 16px; font-size: 1.8rem; background-color: rgba(115, 53, 183, 0.08) !important; color: #7335B7 !important; margin-bottom: 1.5rem; transition: 0.3s; }
    .icon-wrapper-box { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 16px; font-size: 1.8rem; background-color: rgba(243, 112, 13, 0.08) !important; color: #F3700D !important; margin-bottom: 1.5rem; transition: 0.3s; }
    .solution-card:hover .icon-wrapper-api { transform: scale(1.1) rotate(5deg); background-color: #7335B7 !important; color: #fff !important; }
    .solution-card:hover .icon-wrapper-box { transform: scale(1.1) rotate(-5deg); background-color: #F3700D !important; color: #fff !important; }

    .hook-badge-trial { background: linear-gradient(135deg, #F3700D, #ff8c32); color: white; padding: 0.8rem; border-radius: 12px; font-size: 0.85rem; font-weight: 700; text-align: center; margin-top: 1rem; border: 1px solid rgba(243, 112, 13, 0.2); }
    
    /* Interactive Flow Diagram (Alur Menyambung) */
    .presentation-diagram { background: #ffffff; border-radius: 32px; padding: 3rem 2rem; border: 1px solid #eef0f5; box-shadow: 0 15px 40px rgba(0,0,0,0.02); }
    .flow-step-box { background: #fdfcff; border: 1px solid #f1eff5; border-radius: 20px; padding: 1.8rem; transition: 0.3s ease; height: 100%; box-shadow: 0 4px 10px rgba(0,0,0,0.01); position: relative; }
    .flow-step-box:hover { transform: scale(1.03); border-color: var(--accent); box-shadow: 0 15px 30px rgba(243, 112, 13, 0.08); z-index: 5; }
    
    .step-connector { position: absolute; top: 50%; right: -25px; transform: translateY(-50%); width: 40px; height: 40px; background: white; border: 1px solid #eef0f5; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 10; box-shadow: 0 5px 15px rgba(0,0,0,0.05); color: var(--primary); }

    /* Feature Presentation Grid */
    .feature-display-box { background: #fff; border-radius: 20px; padding: 2rem; border: 1px solid rgba(0,0,0,0.03); transition: 0.3s; height: 100%; }
    .feature-display-box:hover { background: var(--bg-soft-purple); border-color: rgba(115, 53, 183, 0.2); }
    
    /* Data Account Requirement Component */
    .requirement-panel { background: #0f0a1c; color: white; border-radius: 28px; padding: 3rem; border: 1px solid rgba(255, 255, 255, 0.05); position: relative; overflow: hidden; }
    .req-list-item { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.05); padding: 1.2rem; border-radius: 14px; font-weight: 600; display: flex; align-items: center; gap: 12px; transition: 0.3s; }
    .req-list-item:hover { background: rgba(243, 112, 13, 0.1); border-color: var(--accent); transform: translateX(5px); }
</style>

<section class="hero-presentation">
    <div class="hero-blob-presentation"></div>
    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-7 text-center text-lg-start mx-auto mx-lg-0 mb-5 mb-lg-0">
                <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-25 rounded-pill px-4 py-2 fw-bold mb-3 shadow-sm" data-aos="fade-down">
                    <i class="fas fa-shield-alt text-success me-1"></i> <b>ENTERPRISE SOLUTIONS v.2606</b>
                </span>
                <h1 class="display-4 fw-bold mb-4 text-white" data-aos="fade-up" data-aos-delay="100">
                    Infrastruktur Logistik & Pembayaran <br><span style="color:var(--accent);">Skala Enterprise</span>
                </h1>
                <p class="lead text-white-50 mb-5 pe-lg-5" data-aos="fade-up" data-aos-delay="200" style="font-size: 1.1rem;">
                    Satu ekosistem terpadu untuk percepatan bisnis melalui otomatisasi teknologi. Menyediakan gerbang integrasi digital yang kokoh serta paket model bisnis fisik siap pakai guna memperluas jangkauan pasar secara instan.
                </p>
                <div data-aos="fade-up" data-aos-delay="300">
                    <a href="#core-solutions" class="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-bold me-3" style="box-shadow: 0 10px 20px rgba(115, 53, 183, 0.4);">Eksplorasi Solusi</a>
                    <a href="#architecture" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill fw-bold">Lihat Arsitektur</a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block" data-aos="zoom-in" data-aos-delay="400">
                <div class="p-4 rounded-4 border border-white border-opacity-10 shadow-lg" style="background: rgba(15, 10, 28, 0.7); backdrop-filter: blur(15px);">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-white border-opacity-10 pb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="spinner-grow spinner-grow-sm text-success" role="status" aria-hidden="true"></span>
                            <span class="text-white fw-bold small tracking-wide">SIMASRIM ENGINE ACTIVE</span>
                        </div>
                        <i class="fas fa-server text-white-50"></i>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-white-50 d-block mb-1">API Endpoint Status</small>
                        <div class="d-flex align-items-center gap-2">
                            <div class="progress flex-grow-1 bg-dark" style="height: 6px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;"></div>
                            </div>
                            <small class="text-success fw-bold">99.9% SLA</small>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <small class="text-white-50 d-block mb-1">Encrypted Connections</small>
                        <div class="d-flex align-items-center gap-2">
                            <div class="progress flex-grow-1 bg-dark" style="height: 6px;">
                                <div class="progress-bar bg-accent" role="progressbar" style="width: 100%;"></div>
                            </div>
                            <small class="text-white fw-bold">Secured</small>
                        </div>
                    </div>

                    <div class="bg-black bg-opacity-50 p-3 rounded-3 border border-white border-opacity-10">
                        <code class="text-success small d-block" style="font-family: monospace;">
                            > System Initialized...<br>
                            > Loaded Modules: [Logistics, PPOB, Ticket, POS]<br>
                            > Waiting for Client Handshake...
                        </code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="core-solutions" class="py-5 bg-light border-bottom">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase ls-2">Pilihan Solusi Strategis</h6>
            <h2 class="fw-bold">Pilar Akselerasi Bisnis SIMASRIM</h2>
            <p class="text-muted max-w-2xl mx-auto">Dirancang secara spesifik untuk memfasilitasi kebutuhan integrasi teknologi digital maupun pemberdayaan jaringan bisnis fisik.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-6 col-md-12" data-aos="fade-right" data-aos-delay="100">
                <div class="solution-card">
                    <div>
                        <div class="icon-wrapper-api"><i class="fas fa-code"></i></div>
                        <h4 class="fw-bold text-dark mb-2">Jalur Integrasi API</h4>
                        <p class="text-muted small mb-4">Solusi otomatisasi penuh yang menghubungkan layanan Logistik Multi-Kurir dan Produk Digital (PPOB) ke dalam infrastruktur aplikasi internal mitra. Ideal untuk Startup, Aplikasi EWA, E-Commerce, dan Platform Digital.</p>
                        
                        <div class="bg-light p-3 rounded-3 border mb-4">
                            <b class="text-dark d-block small mb-2"><i class="fas fa-network-wired text-primary me-2"></i> Kapabilitas Sistem:</b>
                            <ul class="small text-muted ps-3 mb-0">
                                <li class="mb-1">Koneksi tunggal ke ekspedisi nasional terkemuka.</li>
                                <li class="mb-1">Skema komersial: <b>Markup (PPOB)</b> & <b>Diskon Flat (Logistik)</b>.</li>
                                <li class="mb-0">Pemantauan transaksi terpusat via utilitas App Partner.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-auto pt-3">
                        <a href="https://simasrim.com/b2b/api.php" target="_blank" class="btn btn-primary w-100 py-2 rounded-pill fw-bold"><i class="fas fa-external-link-alt me-2"></i> Ajukan Integrasi API</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12" data-aos="fade-left" data-aos-delay="200">
                <div class="solution-card" style="border-color: rgba(243, 112, 13, 0.2);">
                    <div>
                        <div class="icon-wrapper-box"><i class="fas fa-box-open"></i></div>
                        <h4 class="fw-bold text-dark mb-2">Jalur "Bisnis Dalam Kotak"</h4>
                        <p class="text-muted small mb-4">Paket lengkap pendirian unit usaha keagenan logistik dan gerbang pembayaran. Dioptimalkan guna memperkuat lini pendapatan Koperasi, BUMDes, serta Jaringan Toko Retail Fisik.</p>
                        
                        <div class="bg-light p-3 rounded-3 border mb-3">
                            <b class="text-dark d-block small mb-2"><i class="fas fa-store text-accent me-2"></i> Fasilitas Ekosistem Keagenan:</b>
                            <ul class="small text-muted ps-3 mb-0">
                                <li class="mb-1">Operasional praktis, dikelola oleh internal organisasi.</li>
                                <li class="mb-1">Cross-Selling: Layanan pengiriman paket & loket tagihan.</li>
                                <li class="mb-0">Opsi penunjang: Banner/Spanduk, Timbangan, & Mesin EDC.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-auto pt-2">
                        <div class="hook-badge-trial mb-3">
                            <i class="fas fa-gift me-1"></i> Gratis Saldo Awal Rp 10.000 untuk Free Trial
                        </div>
                        <a href="https://simasrim.com/kemitraan/form.php" target="_blank" class="btn btn-warning w-100 py-2 rounded-pill fw-bold text-white" style="background-color:#F3700D; border-color:#F3700D;"><i class="fas fa-external-link-alt me-2"></i> Registrasi Kemitraan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="architecture" class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase ls-2">Transparansi Prosedur</h6>
            <h2 class="fw-bold">Arsitektur Tahapan Kerja</h2>
            <p class="text-muted max-w-2xl mx-auto">Standardisasi proses akuisisi demi menjamin keamanan hukum, kecepatan implementasi sistem, dan kelancaran operasional mitra.</p>
        </div>

        <div class="presentation-diagram shadow-sm" data-aos="zoom-in">
            <div class="row g-0 align-items-stretch">
                <div class="col-lg-3 position-relative mb-4 mb-lg-0 p-2">
                    <div class="flow-step-box text-center">
                        <span class="badge bg-primary text-white font-monospace rounded-pill px-3 py-1 mb-3">Fase 01</span>
                        <i class="fas fa-filter text-accent fs-3 mb-3 d-inline-block"></i>
                        <h5 class="fw-bold text-dark mb-2">Kualifikasi</h5>
                        <p class="text-muted small mb-0">Pengisian data profil awal guna pemetaan komparasi komersial.</p>
                    </div>
                    <div class="step-connector d-none d-lg-flex"><i class="fas fa-chevron-right"></i></div>
                </div>
                
                <div class="col-lg-3 position-relative mb-4 mb-lg-0 p-2">
                    <div class="flow-step-box text-center">
                        <span class="badge bg-primary text-white font-monospace rounded-pill px-3 py-1 mb-3">Fase 02</span>
                        <i class="fas fa-chalkboard-teacher text-info fs-3 mb-3 d-inline-block"></i>
                        <h5 class="fw-bold text-dark mb-2">Edukasi Solusi</h5>
                        <p class="text-muted small mb-0">Pemaparan profil teknis atau pengiriman proposal bisnis & margin.</p>
                    </div>
                    <div class="step-connector d-none d-lg-flex"><i class="fas fa-chevron-right"></i></div>
                </div>
                
                <div class="col-lg-3 position-relative mb-4 mb-lg-0 p-2">
                    <div class="flow-step-box text-center">
                        <span class="badge bg-primary text-white font-monospace rounded-pill px-3 py-1 mb-3">Fase 03</span>
                        <i class="fas fa-file-contract text-warning fs-3 mb-3 d-inline-block"></i>
                        <h5 class="fw-bold text-dark mb-2">Perjanjian (PKS)</h5>
                        <p class="text-muted small mb-0">Pengikatan hukum formal yang mengatur SLA dan aturan operasional.</p>
                    </div>
                    <div class="step-connector d-none d-lg-flex" style="color: #20c997;"><i class="fas fa-chevron-right"></i></div>
                </div>
                
                <div class="col-lg-3 p-2">
                    <div class="flow-step-box text-center" style="border-color: #20c997; background: #f4fdfa;">
                        <span class="badge bg-success text-white font-monospace rounded-pill px-3 py-1 mb-3">Fase 04</span>
                        <i class="fas fa-rocket text-success fs-3 mb-3 d-inline-block"></i>
                        <h5 class="fw-bold text-dark mb-2">Go-Live Sistem</h5>
                        <p class="text-muted small mb-0">Penyerahan kredensial produksi dan eksekusi transaksi pertama.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: var(--bg-soft-purple);">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase ls-2">Teknologi Tingkat Tinggi</h6>
            <h2 class="fw-bold">Keunggulan Ekosistem Teknologi SIMASRIM</h2>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-display-box">
                    <div class="text-primary mb-3"><i class="fas fa-shipping-fast fs-3"></i></div>
                    <h5 class="fw-bold text-dark">Logistics Multi-Kurir</h5>
                    <p class="text-muted small mb-0">Akses langsung ke berbagai pilihan perusahaan ekspedisi terbaik Indonesia untuk pengiriman paket reguler, kargo, sameday, maupun <i>cash-on-delivery</i> (COD).</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-display-box">
                    <div class="text-primary mb-3"><i class="fas fa-coins fs-3"></i></div>
                    <h5 class="fw-bold text-dark">Sistem Komisi Real-time</h5>
                    <p class="text-muted small mb-0">Pencairan dana COD dieksekusi tiap pekan, dengan sistem pembagian diskon dan komisi yang tercatat otomatis secara <i>real-time</i> pada setiap transaksi sukses.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-display-box">
                    <div class="text-primary mb-3"><i class="fas fa-server fs-3"></i></div>
                    <h5 class="fw-bold text-dark">Stabilitas Server Teruji</h5>
                    <p class="text-muted small mb-0">Jaminan ketersediaan infrastruktur jaringan backend terpusat yang dipantau penuh guna meminimalisir hambatan pemrosesan data transaksi harian.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="requirement-panel shadow-lg" data-aos="zoom-in">
            <div class="position-absolute end-0 bottom-0 p-4 d-none d-lg-block" style="opacity: 0.15; z-index: 0;">
                <i class="fas fa-id-card text-white" style="font-size: 15rem; transform: rotate(-10deg) translate(30px, 30px);"></i>
            </div>
            
            <div class="position-relative z-1">
                <div class="row align-items-center">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <span class="badge bg-warning text-dark font-monospace rounded-pill px-3 py-1 mb-3 fw-bold"><b>PRASYARAT GO-LIVE</b></span>
                        <h3 class="fw-bold text-white mb-3">Persyaratan Data Pembukaan Akun Resmi</h3>
                        <p class="text-white-50 small mb-0">Guna memfasilitasi kelancaran proses pembuatan akun induk korporasi/koperasi serta injeksi saldo uji coba pada Fase Go-Live, empat poin data utama ini wajib dipenuhi oleh pihak manajemen mitra.</p>
                    </div>
                    <div class="col-lg-7">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="req-list-item text-white">
                                    <div class="bg-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:35px; height:35px;"><i class="fas fa-user-tie fs-6 text-white"></i></div>
                                    <span>Nama Lengkap PIC / Institusi</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="req-list-item text-white">
                                    <div class="bg-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:35px; height:35px;"><i class="fab fa-whatsapp fs-5 text-white"></i></div>
                                    <span>Nomor Handphone Terintegrasi WA</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="req-list-item text-white">
                                    <div class="bg-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:35px; height:35px;"><i class="fas fa-map-marked-alt fs-6 text-white"></i></div>
                                    <span>Alamat Lengkap Hub / Lokasi Toko</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="req-list-item text-white">
                                    <div class="bg-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:35px; height:35px;"><i class="fas fa-envelope fs-6 text-white"></i></div>
                                    <span>Alamat Email Utama Perusahaan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>