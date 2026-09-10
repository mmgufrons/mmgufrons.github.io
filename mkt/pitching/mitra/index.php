<?php 
$page_title = "Ekosistem SIMASRIM + QSIR Hub | SIMASRIM";
$footer_desc = "Dokumen Internal B2B SIMASRIM - Ekosistem SIMASRIM + QSIR Hub.";
include 'header.php'; 
?>

<style>
    /* CUSTOM UI - MODERN & B2B FOCUSED */
    
    /* Efek Foto Visualisasi (Mockup) */
    .preview-image-wrapper {
        position: relative;
        border-radius: 24px;
        padding: 12px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        transform: perspective(1000px) rotateY(-5deg);
        transition: 0.5s ease;
    }
    .preview-image-wrapper:hover {
        transform: perspective(1000px) rotateY(0deg) translateY(-10px);
    }
    .preview-image-wrapper img {
        border-radius: 16px;
        width: 100%;
        height: auto;
        object-fit: cover;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    }
    .preview-badge {
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, var(--accent), #ff903b);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        box-shadow: 0 10px 20px rgba(243, 112, 13, 0.3);
        white-space: nowrap;
        z-index: 2;
        border: 2px solid white;
    }

    /* Kartu Ekosistem (Palugada) */
    .ecosystem-card { 
        border-radius: 24px; 
        padding: 2.5rem 2rem; 
        border: 1px solid rgba(115, 53, 183, 0.08); 
        background: linear-gradient(145deg, #ffffff, #fcfaff); 
        box-shadow: 0 10px 30px rgba(0,0,0,0.02); 
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        height: 100%; 
        position: relative; 
        overflow: hidden; 
    }
    .ecosystem-card:hover { 
        transform: translateY(-10px); 
        border-color: var(--primary); 
        box-shadow: 0 20px 40px rgba(115, 53, 183, 0.12); 
    }
    .icon-box-large { 
        width: 70px; 
        height: 70px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        border-radius: 20px; 
        font-size: 2rem; 
        margin-bottom: 1.5rem; 
        transition: 0.3s;
    }
    .ecosystem-card:hover .icon-box-large {
        transform: scale(1.1) rotate(5deg);
    }
    
    /* ARSITEKTUR KOMPLEKS QSIR (INTERAKTIF) */
    .diagram-container {
        /* Fix loading lambat: Menggunakan murni CSS Gradient pengganti URL gambar luar */
        background: radial-gradient(circle at center, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 30px;
        padding: 3rem;
        position: relative;
        border: 1px solid #dee2e6;
        box-shadow: inset 0 0 50px rgba(0,0,0,0.02);
    }
    .diagram-top-bar {
        background: linear-gradient(90deg, #3A1B5E, var(--primary), #3A1B5E);
        color: white;
        padding: 15px;
        border-radius: 15px;
        font-weight: 700;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        box-shadow: 0 10px 20px rgba(115, 53, 183, 0.2);
        margin-bottom: 3rem;
    }
    .diagram-top-bar span { 
        background: rgba(255,255,255,0.1); 
        padding: 5px 12px; 
        border-radius: 8px; 
        font-size: 0.85rem; 
        transition: 0.3s ease;
        cursor: default;
    }
    .diagram-top-bar span:hover {
        background: var(--accent);
        transform: translateY(-3px);
    }
    
    /* Hover Effects for Diagram Elements */
    .interactive-box { transition: 0.3s ease; cursor: default; }
    .interactive-box:hover { transform: scale(1.05); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; border-color: var(--accent) !important; }
    
    .hub-core {
        background: white;
        border: 4px solid var(--accent);
        border-radius: 25px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 20px 40px rgba(243, 112, 13, 0.15);
        position: relative;
        z-index: 5;
        transition: 0.4s ease;
    }
    .hub-core:hover {
        transform: scale(1.03) translateY(-5px);
        box-shadow: 0 25px 50px rgba(115, 53, 183, 0.25);
    }
    
    .arrow-flow { color: var(--success); font-size: 1.5rem; animation: pulse 2s infinite; }
    @keyframes pulse { 0% { transform: scale(1); opacity: 0.7; } 50% { transform: scale(1.2); opacity: 1; } 100% { transform: scale(1); opacity: 0.7; } }
    
    /* FIX UKURAN LOGO EKSPEDISI BIAR RATA */
    .brand-logo { 
        height: 40px; 
        max-width: 100px; /* Batasan lebar agar tidak kepanjangan */
        object-fit: contain; 
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)); 
        transition: 0.3s ease; 
    }
    .brand-logo-large { 
        height: 70px; 
        max-width: 160px;
        object-fit: contain; 
        transition: 0.3s; 
    }
    
    .hover-scale:hover { transform: scale(1.15); filter: drop-shadow(0 5px 10px rgba(0,0,0,0.15)); }

    .badge-status-live { background: linear-gradient(135deg, #128C7E, #25D366); color: white; padding: 6px 14px; border-radius: 50px; font-size: 0.75rem; font-weight: bold; letter-spacing: 1px; }
    .badge-status-soon { background: linear-gradient(135deg, #6c757d, #495057); color: white; padding: 6px 14px; border-radius: 50px; font-size: 0.75rem; font-weight: bold; letter-spacing: 1px; }

    /* Custom Strength List */
    .strength-item {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 20px;
        transition: 0.3s;
    }
    .strength-item:hover {
        background: rgba(255,255,255,0.1);
        transform: translateX(10px);
        border-color: var(--accent);
    }
    .strength-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(243, 112, 13, 0.1);
        border-radius: 12px;
        margin-right: 20px;
    }
</style>

<section class="hero-section d-flex align-items-center">
    <div class="hero-blob" style="top: -10%; right: -5%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1 mt-4">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0">
                <span class="badge bg-white text-primary rounded-pill px-4 py-2 fw-bold mb-3 ls-2 shadow-sm" data-aos="fade-down">
                    <i class="fas fa-project-diagram me-2"></i> MASTER BLUEPRINT B2B
                </span>
                <h1 class="display-4 fw-bold mb-4 text-white lh-sm" data-aos="fade-up" data-aos-delay="100">
                    Pusat Ekosistem Terpadu<br><span class="text-accent">SIMASRIM + QSIR</span>
                </h1>
                <p class="lead text-white-50 mb-5 pe-lg-4" data-aos="fade-up" data-aos-delay="200" style="line-height: 1.8;">
                    Lebih dari sekadar kemitraan logistik. Konsep <b>QSIR Drop Point Center & Fulfillment</b> memosisikan Mitra sebagai jembatan utama antara ratusan agen ritel, pelaku UMKM, dan Gudang Ekspedisi Nasional.
                </p>
                <div data-aos="fade-up" data-aos-delay="300">
                    <a href="#skema-hub" class="btn btn-accent btn-lg px-4 py-3 rounded-pill fw-bold" style="background: var(--accent); color: white; border: none; box-shadow: 0 10px 20px rgba(243, 112, 13, 0.4);"><i class="fas fa-sitemap me-2"></i> Lihat Arsitektur Sistem</a>
                    <a href="blueprint.php" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill fw-bold ms-2">Skema Teknis</a>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="400">
                <div class="preview-image-wrapper mx-auto" style="max-width: 500px;">
                    <img src="images/preview.webp" alt="Visualisasi QSIR Center" loading="lazy">
                    <div class="preview-badge">
                        <i class="fas fa-pencil-ruler me-1"></i> Visualisasi Konsep QSIR Hub (Mockup)
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="skema-hub" class="py-5" style="background: var(--bg-soft-purple);">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase ls-2">Arsitektur Ekosistem</h6>
            <h2 class="fw-bold text-dark">Simbiosis Mutualisme Area Terpusat</h2>
            <p class="text-muted max-w-2xl mx-auto">Mitra tidak hanya mencari pelanggan ritel secara manual, melainkan bertindak sebagai <b>Konektor Pusat (Hub)</b> yang mengelola lalu lintas barang dan transaksi dari berbagai agen satelit.</p>
        </div>
        
        <div class="diagram-container shadow-sm" data-aos="zoom-in" data-aos-delay="100">
            <div class="diagram-top-bar">
                <span><i class="fas fa-credit-card text-accent"></i> MINI ATM</span>
                <span><i class="fas fa-cash-register text-accent"></i> POS/KASIR</span>
                <span><i class="fas fa-mobile-alt text-accent"></i> RESELLER APP</span>
                <span><i class="fas fa-bolt text-accent"></i> PPOB</span>
                <span><i class="fas fa-ticket-alt text-accent"></i> TIKETING</span>
                <span><i class="fas fa-box-open text-accent"></i> FULFILLMENT</span>
                <span><i class="fas fa-kaaba text-accent"></i> UMROH & HAJI</span>
                <span><i class="fas fa-globe text-accent"></i> DIGITAL PRODUK</span>
                <span><i class="fas fa-truck text-accent"></i> MULTI KURIR</span>
                <span><i class="fas fa-ellipsis-h text-accent"></i> LAYANAN LAIN YANG AKAN HADIR</span>
            </div>

            <div class="row align-items-center position-relative">
                <div class="col-lg-3 text-center mb-4 mb-lg-0 z-2">
                    <div class="interactive-box bg-white p-3 rounded-4 shadow-sm border mb-3">
                        <div class="d-flex flex-wrap justify-content-center gap-2 mb-2">
                            <i class="fas fa-user-tie text-secondary fs-4"></i>
                            <i class="fas fa-user-tie text-secondary fs-4"></i>
                            <i class="fas fa-user-tie text-secondary fs-4"></i>
                            <i class="fas fa-user-tie text-secondary fs-4"></i>
                            <i class="fas fa-user-tie text-secondary fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0">Ratusan Agen &<br>Satelit Lainnya</h6>
                    </div>
                    <i class="fas fa-long-arrow-alt-right arrow-flow d-none d-lg-block"></i>
                    <i class="fas fa-long-arrow-alt-down arrow-flow d-lg-none"></i>
                </div>

                <div class="col-lg-6 mb-4 mb-lg-0 z-3">
                    <div class="hub-core">
                        <span class="badge bg-dark mb-3 px-3 py-2 fs-6">MITRA DI SINI</span>
                        <h2 class="fw-bold text-primary mb-1">QSIR Drop Point Center</h2>
                        <h4 class="text-dark fw-bold mb-3">+ Pusat Fulfillment</h4>
                        <div class="d-inline-flex justify-content-center align-items-center mb-3" style="width: 80px; height: 80px; background: rgba(115, 53, 183, 0.1); border-radius: 20px;">
                            <i class="fas fa-warehouse text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <p class="small text-muted mb-3">Pusat Konsolidasi, Inbound, Outbound, & Penyimpanan Stok.</p>
                        <div class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-3 w-100 fs-6">
                            <i class="fas fa-check-circle me-1"></i> Fixed Handling Fee Rp 300/paket <span class="fw-normal">*</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 text-center z-2">
                    <i class="fas fa-long-arrow-alt-left arrow-flow d-none d-lg-block mb-3"></i>
                    <i class="fas fa-long-arrow-alt-up arrow-flow d-lg-none my-3"></i>
                    <div class="interactive-box bg-white p-4 rounded-4 shadow-sm border">
                        <img src="images/simasrim.png" alt="SIMASRIM APP" class="brand-logo hover-scale mb-2" onerror="this.src='https://via.placeholder.com/100x40?text=APP'">
                        <br>
                        <span class="small text-muted fw-bold">Super App System</span>
                    </div>
                </div>
            </div>

            <div class="row mt-5 pt-4 border-top border-2 border-dashed">
                <div class="col-12 text-center">
                    <i class="fas fa-long-arrow-alt-down arrow-flow mb-3"></i>
                    <h5 class="fw-bold text-dark mb-4">Integrasi Gudang Ekspedisi Nasional</h5>
                    
                    <div class="interactive-box d-flex flex-wrap justify-content-center align-items-center gap-4 bg-white p-4 rounded-4 shadow-sm border">
                        <img src="images/sicepat.png" alt="SiCepat Express" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=SiCepat+Express'">
                        <img src="images/idexpress.png" alt="ID Express" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=ID+Express'">
                        <img src="images/paxel.svg" alt="Paxel" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=Paxel'">
                        <img src="images/anteraja.webp" alt="Anteraja" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=Anteraja'">
                        <img src="images/j&t cargo.webp" alt="J&T Cargo" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=J%26T+Cargo'">
                        <img src="images/pos.webp" alt="POS Indonesia" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=POS'">
                        <img src="images/sapx.webp" alt="SAPX" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=SAPX'">
                        <img src="images/spx.webp" alt="SPX" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=SPX'">
                        <img src="images/jne.webp" alt="JNE" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=JNE'">
                        <img src="images/lion_parcel.webp" alt="Lion Parcel" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=Lion+Parcel'">
                        <img src="images/lex.webp" alt="LEX" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=LEX'">
                        <img src="images/j&t.svg" alt="J&T Express" class="brand-logo hover-scale" onerror="this.src='https://via.placeholder.com/80x40?text=J%26T'">
                    </div>
                </div>
            </div>
            <p class="text-center mt-3 mb-0" style="font-size: 0.8rem; color: #888;">
                <em>* Syarat dan Ketentuan (S&K) berlaku untuk pencairan Handling Fee operasional.</em>
            </p>
        </div>
    </div>
</section>

<section class="py-5 bg-white border-top">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-accent fw-bold text-uppercase ls-2">Satu Atap, Semua Ada</h6>
            <h2 class="fw-bold text-dark">Layanan "Palugada" Super Hub</h2>
            <p class="text-muted">Ekosistem komprehensif yang menjadikan titik Mitra sebagai penyedia layanan esensial masyarakat.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="ecosystem-card">
                    <div class="position-absolute top-0 end-0 m-4"><span class="badge-status-live">LIVE</span></div>
                    <div class="icon-box-large" style="background: #EAE2F3; color: var(--primary);"><i class="fas fa-shipping-fast"></i></div>
                    <h4 class="fw-bold text-dark">Logistik Multi-Kurir</h4>
                    <p class="text-muted small mb-0">Koneksi langsung ke puluhan ekspedisi nasional. Menerima resi cetak dari agen satelit dan menghasilkan <b>Override Fee</b> serta <b>Handling Fee Rp 300/paket*</b> bagi Mitra.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="ecosystem-card">
                    <div class="position-absolute top-0 end-0 m-4"><span class="badge-status-live">LIVE</span></div>
                    <div class="icon-box-large text-accent" style="background: rgba(243, 112, 13, 0.1);"><i class="fas fa-boxes"></i></div>
                    <h4 class="fw-bold text-dark">Fulfillment & WMS</h4>
                    <p class="text-muted small mb-0">Simbiosis mutualisme penyewaan <i>space</i> gudang Mitra. Sistem <b>WMS</b> akan mengarahkan stok barang dari <i>seller</i>/UMKM lokal untuk ditampung dan dikelola langsung di gudang Mitra.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="ecosystem-card">
                    <div class="position-absolute top-0 end-0 m-4"><span class="badge-status-live">LIVE</span></div>
                    <div class="icon-box-large text-success bg-success bg-opacity-10"><i class="fas fa-credit-card"></i></div>
                    <h4 class="fw-bold text-dark">Mini ATM (EDC)</h4>
                    <p class="text-muted small mb-0">Infrastruktur transaksi fisik bekerja sama dengan <b>KB Bank</b>. Membuka layanan tarik tunai, transfer, dan pembayaran debit langsung di <i>counter</i> QSIR Hub. <i>Tersedia opsi cicilan ringan untuk perangkat EDC.</i></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="ecosystem-card">
                    <div class="position-absolute top-0 end-0 m-4"><span class="badge-status-live">LIVE</span></div>
                    <div class="icon-box-large text-warning bg-warning bg-opacity-10"><i class="fas fa-mobile-screen-button"></i></div>
                    <h4 class="fw-bold text-dark">PPOB & Tiketing</h4>
                    <p class="text-muted small mb-0">Pusat pembayaran tagihan digital dan reservasi tiket perjalanan. Memberikan fleksibilitas bagi Mitra untuk mengatur margin (<b>Markup</b>) mandiri ke seluruh jaringan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="ecosystem-card border-secondary border-opacity-25" style="background: #fafafa;">
                    <div class="position-absolute top-0 end-0 m-4"><span class="badge-status-soon">SEGERA</span></div>
                    <div class="icon-box-large text-secondary bg-secondary bg-opacity-10"><i class="fas fa-kaaba"></i></div>
                    <h4 class="fw-bold text-dark">Umroh & Haji</h4>
                    <p class="text-muted small mb-0">Jangkau <i>market</i> premium. Sistem pendaftaran jamaah Umroh terintegrasi langsung dengan vendor resmi, mendatangkan komisi besar per <b>closing</b>.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="ecosystem-card border-secondary border-opacity-25" style="background: #fafafa;">
                    <div class="position-absolute top-0 end-0 m-4"><span class="badge-status-soon">SEGERA</span></div>
                    <div class="icon-box-large text-secondary bg-secondary bg-opacity-10"><i class="fas fa-cash-register"></i></div>
                    <h4 class="fw-bold text-dark">POS / Aplikasi Kasir</h4>
                    <p class="text-muted small mb-0">Infrastruktur <b>Reseller App</b> dan manajemen stok toko (POS) yang terhubung ke saldo utama, mempermudah digitalisasi warung/UMKM binaan Mitra.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 text-white" style="background: url('https://www.transparenttextures.com/patterns/cubes.png'), linear-gradient(135deg, var(--primary-dark), #1a0b2e);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                <div class="d-inline-flex align-items-center gap-2 badge bg-white bg-opacity-10 border border-white border-opacity-25 px-3 py-2 rounded-pill mb-3">
                    <i class="fas fa-bolt text-accent"></i> <span class="fw-bold">Kekuatan Utama</span>
                </div>
                <h2 class="display-6 fw-bold mb-4">Fondasi Kekuatan Jaringan</h2>
                <p class="text-white-50 mb-5" style="font-size: 1.1rem; line-height: 1.8;">
                    Infrastruktur fisik ini adalah <b>Kekuatan Utama (Our Strength)</b> yang membedakan Mitra Utama QSIR dengan agen biasa, memastikan Mitra siap mendominasi pasar:
                </p>
                <a href="blueprint.php" class="btn btn-accent btn-lg rounded-pill px-4 py-3 shadow border-0 fw-bold w-100 w-sm-auto mb-3" style="background: var(--accent); color: white;">
                    Lihat Blueprint & Skema B2B <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
            
            <div class="col-lg-6 offset-lg-1" data-aos="fade-left">
                <div class="d-flex flex-column gap-3">
                    <div class="strength-item d-flex align-items-center">
                        <div class="strength-icon">
                            <i class="fas fa-truck-moving text-accent" style="font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-white mb-1">Armada Pickup / Delivery</h5>
                            <p class="text-white-50 small mb-0">Kesiapan kendaraan operasional mandiri (motor bak/<i>blind van</i>) untuk optimalisasi penjemputan barang dari agen satelit ke titik konsolidasi pusat.</p>
                        </div>
                    </div>
                    <div class="strength-item d-flex align-items-center">
                        <div class="strength-icon">
                            <i class="fas fa-store text-accent" style="font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-white mb-1">Gedung / Kios Center</h5>
                            <p class="text-white-50 small mb-0">Kepemilikan titik lokasi fisik yang strategis sebagai <i>Drop Point Center</i>, fasilitas <i>Fulfillment</i>, serta operasional layanan pelanggan tatap muka.</p>
                        </div>
                    </div>
                    <div class="strength-item d-flex align-items-center">
                        <div class="strength-icon">
                            <i class="fas fa-user-tie text-accent" style="font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-white mb-1">SDM Berpengalaman</h5>
                            <p class="text-white-50 small mb-0">Dukungan sumber daya manusia dan tim yang mumpuni dalam hal operasional <i>handling</i> barang, administrasi, dan layanan masyarakat sekitar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="alert border-0 rounded-4 shadow-sm p-4" style="background: white; border-left: 5px solid var(--primary) !important;">
                    <div class="d-flex align-items-start">
                        <div class="text-primary me-4 mt-1" style="font-size: 2rem;">
                            <i class="fas fa-history"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-primary mb-2">Insight Operasional: Case QSir Surabaya</h5>
                            <p class="text-muted mb-3">
                                Surabaya sebagai <i>first mover</i> QSir Hub membuktikan bahwa inisiatif adalah kunci. 
                                <br><strong>Mekanisme Proactive Pickup:</strong> Awalnya tim harus jemput bola ke tiap <i>drop point</i> untuk edukasi, namun kini sudah stabil dengan mekanisme <i>pickup by QSir</i>.
                            </p>
                            <div class="bg-light p-3 rounded-3 border-start border-warning border-3">
                                <p class="text-dark small mb-0">
                                    <strong class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i> Note:</strong> 
                                    Pickup tidak selalu terjadwal otomatis (bukan sistem autokirim), melainkan ada inisiatif dari armada QSir dalam mengumpulkan paket. Hal ini krusial untuk dipahami Mitra baru sebagai standar layanan awal.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>