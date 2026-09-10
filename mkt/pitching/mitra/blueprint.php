<?php 
$page_title = "Blueprint: SIMASRIM Dual-Track Partnership";
$footer_desc = "Dokumen Internal Terbatas. Referensi PKS B2B & QSIR.";
include 'header.php'; 
?>

<style>
    /* FIX STICKY ISSUE: Bypass body overflow-x hidden yang mematikan efek sticky */
    html, body {
        overflow-x: clip !important;
    }

    /* KOMPONEN SPESIFIK KHUSUS HALAMAN BLUEPRINT */
    .bento-card { border-radius: 20px; padding: 2rem; height: 100%; transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); border: 1px solid rgba(0,0,0,0.06); background: #fff; box-shadow: 0 4px 20px rgba(0,0,0,0.02); }
    .bento-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(115, 53, 183, 0.1); border-color: rgba(115, 53, 183, 0.3); }
    
    .section-padding { padding: 90px 0; }
    .bg-light-soft { background-color: #fcfaff; }
    
    /* DETAIL LIST STYLING (Track 1 & Track 2) */
    .detail-list { border-left: 2px dashed var(--secondary); margin-left: 1rem; padding-left: 2rem; }
    .detail-item { position: relative; margin-bottom: 2rem; transition: 0.3s; padding: 1.5rem; border-radius: 16px; background: transparent; border: 1px solid transparent; }
    .detail-item:hover { background: white; border-color: rgba(115, 53, 183, 0.1); box-shadow: 0 10px 30px rgba(0,0,0,0.03); transform: translateX(5px); }
    .detail-item::before { content: ''; position: absolute; left: -2.35rem; top: 1.8rem; width: 14px; height: 14px; border-radius: 50%; background: var(--primary); border: 3px solid white; box-shadow: 0 0 0 2px var(--primary); transition: 0.3s; }
    .detail-item:hover::before { background: var(--accent); box-shadow: 0 0 0 2px var(--accent); transform: scale(1.2); }
    
    /* RANGE SLIDER KUSTOM (Untuk Kalkulator) */
    input[type=range] { -webkit-appearance: none; width: 100%; background: transparent; }
    input[type=range]::-webkit-slider-thumb { -webkit-appearance: none; height: 26px; width: 26px; border-radius: 50%; background: var(--accent); cursor: pointer; margin-top: -9px; box-shadow: 0 0 15px rgba(243, 112, 13, 0.4); transition: 0.2s; border: 3px solid white; }
    input[type=range]::-webkit-slider-thumb:hover { transform: scale(1.2); }
    input[type=range]::-webkit-slider-runnable-track { width: 100%; height: 8px; cursor: pointer; background: #e2e8f0; border-radius: 5px; }
    
    /* SYNERGY CARDS */
    .synergy-card { border: 1px solid transparent; transition: 0.3s; border-radius: 20px; padding: 2rem 1.5rem; height: 100%; background: white; }
    .synergy-card:hover { border-color: var(--primary); box-shadow: 0 15px 35px rgba(115, 53, 183, 0.1); transform: translateY(-10px); }
</style>

<section class="hero-section d-flex align-items-center position-relative text-center" style="background: radial-gradient(circle at top right, #3A1B5E, #1F0D3D, #0f0c29); padding: 180px 0 100px;">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-white text-primary rounded-pill px-4 py-2 fw-bold mb-3 text-uppercase ls-2 shadow-sm" data-aos="fade-down">Dokumen Teknis B2B</span>
        <h1 class="display-4 fw-bold mb-4 lh-sm text-white" data-aos="fade-up" data-aos-delay="100">
            SIMASRIM Dual-Track Partnership
        </h1>
        <h3 class="h5 fw-normal text-white-50 mb-5 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200" style="line-height: 1.6;">
            "Transformasi Mitra menjadi Pusat Keuntungan Ritel & Infrastruktur Hub Logistik Area secara bersamaan."
        </h3>
        
        <div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="300">
            <div class="col-lg-8">
                <div class="bg-white bg-opacity-10 backdrop-blur p-4 rounded-4 border border-white border-opacity-25 text-start shadow-lg">
                    <h5 class="text-white fw-bold border-bottom border-white border-opacity-25 pb-2 mb-3"><i class="fas fa-eye me-2 text-accent"></i> Visi Kemitraan</h5>
                    <p class="text-white-50 mb-0" style="line-height: 1.8;">
                        SIMASRIM tidak hanya menyewakan perangkat lunak (<i>software</i>), melainkan membangun ekosistem bisnis mandiri bagi para Leader di daerah. Melalui konsep <b>Dual-Track</b>, Mitra memiliki dua mesin profit sekaligus: <b>Jaringan Agen SIMASRIM</b> dan <b>Infrastruktur Operasional (QSIR)</b>.
                    </p>
                </div>
            </div>
        </div>
        
        <div data-aos="fade-up" data-aos-delay="400">
            <a href="#kalkulator" class="btn btn-accent rounded-pill px-4 py-3 fw-bold me-2 shadow-sm" style="background: var(--accent); color: white; border: none;"><i class="fas fa-calculator me-2"></i> Simulasi Profit</a>
            <a href="diskon.php" class="btn btn-outline-light rounded-pill px-4 py-3 fw-bold">Lihat Skema Diskon <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<section class="py-5 bg-white border-bottom">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase ls-2">Landasan Ekosistem</h6>
            <h2 class="fw-bold text-dark">Sinergi: Kenapa Harus Dual-Track?</h2>
            <p class="text-muted max-w-2xl mx-auto">Dengan menjalankan kedua rute ini, Mitra langsung memonopoli 3 titik keuntungan maksimal dalam rantai pasok logistik dan digital:</p>
        </div>
        
        <div class="row justify-content-center g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center synergy-card">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 80px; height: 80px; font-size: 2rem; background: rgba(115, 53, 183, 0.1); color: var(--primary);">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h5 class="fw-bold">1. Profit Pendaftaran</h5>
                    <p class="text-muted small mb-0">Pendapatan insentif tunai (<i>Acquisition Fee</i>) langsung di awal saat Anda merekrut dan memvalidasi agen/merchant baru di wilayah operasional Anda.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center synergy-card">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 80px; height: 80px; font-size: 2rem; background: rgba(243, 112, 13, 0.1); color: var(--accent);">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h5 class="fw-bold">2. Profit Transaksi Jaringan</h5>
                    <p class="text-muted small mb-0"><i>Passive income</i> berkelanjutan (<b>Override Fee & Selisih Margin</b>) yang mengalir setiap kali jaringan di bawah Anda bertransaksi Logistik, PPOB, atau Tiket.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center synergy-card">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 80px; height: 80px; font-size: 2rem; background: rgba(32, 201, 151, 0.1); color: var(--success);">
                        <i class="fas fa-truck-loading"></i>
                    </div>
                    <h5 class="fw-bold">3. Profit Pergerakan Barang</h5>
                    <p class="text-muted small mb-0">Biaya penanganan (<i>Handling Fee</i>) operasional saat barang fisik dari jaringan agen dititipkan dan diproses melalui fasilitas Hub QSIR milik Mitra.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light-soft">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                <div class="sticky-lg-top" style="top: 120px; z-index: 10;">
                    <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold mb-3 fs-6">TRACK 1</span>
                    <h2 class="fw-bold text-dark mb-3">B2B Sales Partnership<br><span class="text-primary fs-4">(Mesin Pertumbuhan)</span></h2>
                    <p class="text-muted mb-4 text-justify" style="font-size: 1.05rem;">
                        Fokus pada eskalasi akuisisi dan perluasan jangkauan pengguna (merchant/agen) di wilayah kekuasaan Mitra.
                    </p>
                    
                    <div class="bg-white p-4 rounded-4 shadow-sm border mb-4">
                        <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-bullseye text-accent me-2"></i> Fokus Utama</h6>
                        <ul class="list-unstyled mb-0 text-muted" style="font-size: 0.95rem;">
                            <li class="mb-3"><b>Peran Mitra:</b> Menjadi <i>Sales Acquisition Leader</i> yang memimpin rekrutmen pengguna baru di areanya.</li>
                            <li><b>Target Pangsa:</b> Pengguna perorangan, agen pengiriman, toko kelontong, atau UMKM yang ingin membuka lini bisnis ekspedisi dan digital.</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7" data-aos="fade-left">
                <div class="detail-list">
                    <div class="detail-item shadow-sm">
                        <h5 class="fw-bold text-dark">1. Skema Komisi: Logistik (Multi-Kurir)</h5>
                        <p class="text-muted mb-0">Mendapatkan <i>Override Fee</i> maksimal <b>1% - 2%</b>. Tambahan keuntungan didapat dari selisih diskon: Mitra dapat memberikan diskon ke user di bawah batas maksimal (contoh: SPX Pickup maks 25%, jika user hanya diberi 10%, maka selisihnya otomatis menjadi profit Mitra).</p>
                    </div>
                    <div class="detail-item shadow-sm">
                        <h5 class="fw-bold text-dark">2. Skema Komisi: PPOB & Tiket Travel</h5>
                        <p class="text-muted mb-0"><b>PPOB:</b> Mitra memiliki wewenang penuh menentukan persentase komisi (<i>markup</i>) sub-user. Selisih margin menjadi hak Mitra. <b>Travel:</b> Mitra mendapatkan Harga Modal Netto (NTA). Keuntungan murni diperoleh dari Biaya Admin yang diatur secara mandiri.</p>
                    </div>
                    <div class="detail-item shadow-sm">
                        <h5 class="fw-bold text-dark">3. Fee Akuisisi Registrasi</h5>
                        <p class="text-muted mb-0">Insentif maksimal <b>Rp 10.000</b> per akun valid jika agen binaan berhasil menyelesaikan 3 milestone: Registrasi (KYC) <b>-></b> Deposit (min. Rp 50.000) <b>-></b> Transaksi (min. Rp 100.000).</p>
                    </div>
                    <div class="detail-item shadow-sm">
                        <h5 class="fw-bold text-dark">4. Full Support Edukasi & CS Pusat</h5>
                        <p class="text-muted mb-0">Mitra cukup fokus pada perluasan jaringan. Setelah agen baru berhasil mendaftar, proses <b>edukasi, panduan aplikasi, hingga penanganan komplain</b> akan di-<i>handle</i> secara langsung oleh Tim Customer Service SIMASRIM Pusat.</p>
                    </div>
                    <div class="detail-item shadow-sm">
                        <h5 class="fw-bold text-dark">5. Fasilitas POS Material & Branding</h5>
                        <p class="text-muted mb-0">Untuk mendukung visibilitas <i>offline</i>, SIMASRIM menyediakan <b>Standardisasi POS Material</b> (desain spanduk outlet resmi, <i>x-banner</i>, hingga stiker) yang siap cetak agar <i>branding</i> di setiap agen jaringan Mitra tetap profesional.</p>
                    </div>
                    <div class="detail-item" style="background: rgba(220, 53, 69, 0.05); border-color: rgba(220, 53, 69, 0.2);">
                        <h5 class="fw-bold text-danger"><i class="fas fa-gavel me-2"></i> Tata Kelola & Disclaimer Hukum</h5>
                        <p class="text-muted mb-0">Sistem jaringan bersifat <b>Flat</b> (tidak berjenjang / bukan MLM). Mitra bertindak sebagai <b>Mitra Mandiri (Independent Contractor)</b>. SIMASRIM tidak bertanggung jawab atas pembagian komisi internal atau sengketa antara Mitra dengan tim sales di bawahnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row flex-lg-row-reverse">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-left">
                <div class="sticky-lg-top" style="top: 120px; z-index: 10;">
                    <span class="badge bg-accent rounded-pill px-3 py-2 fw-bold mb-3 fs-6">TRACK 2</span>
                    <h2 class="fw-bold text-dark mb-3">QSIR - Micro Hub Area<br><span class="text-accent fs-4">(Mesin Operasional)</span></h2>
                    <p class="text-muted mb-4 text-justify" style="font-size: 1.05rem;">
                        Transformasi lokasi fisik menjadi infrastruktur logistik terpusat. Eksklusif untuk Mitra yang memiliki kapasitas infrastruktur memadai.
                    </p>
                    
                    <div class="bg-light-soft p-4 rounded-4 shadow-sm border mb-4">
                        <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-sitemap text-primary me-2"></i> Fokus Operasional</h6>
                        <ul class="list-unstyled mb-0 text-muted" style="font-size: 0.95rem;">
                            <li class="mb-3"><b>Peran Mitra:</b> Menjadi Drop Point Resmi dan Micro Hub di titik koordinat yang telah disetujui pusat.</li>
                            <li class="mb-2"><b>Tugas 1:</b> Menerima titipan paket dari agen-agen kecil di area sekitar (Drop Point).</li>
                            <li><b>Tugas 2:</b> Melakukan penjemputan (Pickup) paket dari jaringan untuk efisiensi penyerahan ke kurir pusat.</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7" data-aos="fade-right">
                <div class="detail-list" style="border-left-color: var(--accent);">
                    <div class="detail-item shadow-sm">
                        <h5 class="fw-bold text-dark">Skema Profit: Ganda (Network + Operational)</h5>
                        <p class="text-muted mb-0">Jika paket berasal dari agen binaannya sendiri, Mitra mendapat <b>Network Fee</b> (Override). Ditambah <b>Operational Fee (Handling Fee) senilai Rp 300 per resi</b> yang akan otomatis cair ke saldo saat status paket menjadi <i>Delivered</i> (Berlaku untuk transaksi COD maupun Non-COD).</p>
                    </div>
                    <div class="detail-item shadow-sm">
                        <h5 class="fw-bold text-dark">Alur Operasional Otomatis & Notifikasi</h5>
                        <p class="text-muted mb-0"><b>Routing Cerdas:</b> User SIMASRIM di wilayah Mitra akan secara otomatis melihat pilihan <i>pickup</i> di QSir Hub tanpa perlu input manual.<br><b>Dashboard Real-time:</b> Mitra akan menerima notifikasi <i>pickup</i> di akunnya dan dapat memantau jumlah paket harian melalui Dashboard khusus yang terintegrasi dengan Looker Studio.</p>
                    </div>
                    <div class="detail-item shadow-sm" style="background: rgba(32, 201, 151, 0.05); border-color: rgba(32, 201, 151, 0.2);">
                        <h5 class="fw-bold text-success"><i class="fas fa-chess-knight me-2"></i> Keuntungan Strategis Jangka Panjang</h5>
                        <p class="text-muted mb-0">Lokasi fisik Perwakilan Area menjadi sentra lalu lintas barang yang lebih ramai (meningkatkan <i>cross-selling</i> layanan lain seperti Mini ATM), memperkuat <b>trust</b> dari UMKM setempat, dan secara drastis mempercepat SLA <i>pickup</i> kurir utama (JNE, SPX, dll).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="kalkulator" class="section-padding text-white position-relative" style="background: linear-gradient(135deg, var(--primary-dark), #1a0b2e);">
    <div class="container position-relative z-1">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-accent fw-bold text-uppercase ls-2">Alat Proyeksi Bisnis</h6>
            <h2 class="fw-bold display-6">Simulasi <i>Passive Income</i> (Track 1)</h2>
            <p class="text-white-50 max-w-2xl mx-auto" style="font-size: 1.1rem;">Kalkulator ini mengestimasikan potensi profit bulanan murni dari <i>Override Fee</i> Logistik, berdasarkan skala jaringan yang berhasil Mitra bangun.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="zoom-in">
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-lg text-dark">
                    <div class="mb-4">
                        <label class="fw-bold text-muted mb-3 d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-users text-primary me-2"></i> Jumlah Jaringan Aktif</span>
                            <span class="badge fs-5 px-3 py-2 rounded-pill" style="background: white; border: 2px solid var(--primary); color: var(--primary);">
                                <span id="agenVal">50</span> Agen
                            </span>
                        </label>
                        <input type="range" id="agenCount" min="10" max="1000" value="50" step="10">
                    </div>
                    
                    <div class="mb-5">
                        <label class="fw-bold text-muted mb-3 d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-box text-accent me-2"></i> Rata-rata Paket per Agen / Hari</span>
                            <span class="badge fs-5 px-3 py-2 rounded-pill" style="background: white; border: 2px solid var(--accent); color: var(--accent);">
                                <span id="paketVal">10</span> Paket
                            </span>
                        </label>
                        <input type="range" id="paketCount" min="1" max="100" value="10" step="1">
                    </div>
                    
                    <div class="text-center p-4 rounded-4" style="background: linear-gradient(145deg, var(--bg-soft-purple), #ffffff); border: 2px dashed var(--primary);">
                        <p class="text-muted fw-bold text-uppercase mb-2" style="letter-spacing: 1.5px; font-size: 0.85rem;">Estimasi Total Profit Bulanan</p>
                        <h1 id="totalCuan" class="display-4 fw-bold text-primary mb-3">Rp 0</h1>
                        
                        <div class="text-start bg-light p-3 rounded-3 border small">
                            <p class="text-muted mb-2">
                                <i><b>Formula Dasar:</b> (Total Agen) × (Paket/Hari) × (Asumsi Fee Rp 300*) × 30 Hari.</i>
                            </p>
                            <p class="text-danger mb-0 fw-bold">
                                <i class="fas fa-info-circle me-1"></i> Kalkulasi ini HANYA DARI LOGISTIK. Belum mencakup tambahan profit masif dari Fee Akuisisi (Rp 10rb/user), Markup Margin PPOB & Tiket, maupun Fee Operasional QSIR Hub!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light-soft border-top">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase ls-2">Teritorial</h6>
            <h2 class="fw-bold text-dark">Pemetaan & Pengendalian Area</h2>
            <p class="text-muted">Distribusi wewenang operasional antara SIMASRIM Pusat (HQ) dan Mitra Perwakilan Area.</p>
        </div>
        
        <div class="row justify-content-center mb-4" data-aos="fade-up">
            <div class="col-lg-8">
                <div class="bento-card bg-white p-4 text-center border-primary shadow-lg" style="border-width: 3px;">
                    <div class="d-inline-flex justify-content-center align-items-center rounded-circle bg-primary text-white mb-3 shadow" style="width: 80px; height: 80px; font-size: 2rem;">🏢</div>
                    <h3 class="fw-bold mb-2 text-primary">SIMASRIM HEADQUARTERS</h3>
                    <span class="badge bg-dark text-white px-3 py-2 mb-3 fs-6">Kendali Pusat (HQ)</span>
                    <p class="text-dark mb-0 fs-5">
                        <b>Cakupan Wilayah:</b> Bogor Raya, Jabodetabek (Non-Bekasi), dan seluruh wilayah administratif di Indonesia yang <b>belum dialokasikan</b> kepada Mitra Perwakilan Area.
                    </p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center g-4 mt-2">
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="bento-card bg-white p-4 text-center">
                    <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; background: rgba(115, 53, 183, 0.1); color: var(--primary);">📍</div>
                    <h5 class="fw-bold mb-1">Surabaya</h5>
                    <span class="badge bg-light text-dark border mb-2">Kode: SUB</span>
                    <p class="small text-muted mb-0">Pak Eko & Mas Krisna</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="bento-card bg-white p-4 text-center">
                    <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; background: rgba(243, 112, 13, 0.1); color: var(--accent);">📍</div>
                    <h5 class="fw-bold mb-1">Bekasi</h5>
                    <span class="badge bg-light text-dark border mb-2">Kode: BKS</span>
                    <p class="small text-muted mb-0">Pak Andi</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="bento-card bg-white p-4 text-center">
                    <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; background: rgba(32, 201, 151, 0.1); color: var(--success);">📍</div>
                    <h5 class="fw-bold mb-1">Palembang</h5>
                    <span class="badge bg-light text-dark border mb-2">Kode: PLM</span>
                    <p class="small text-muted mb-0">Pak Ahmad & Pak Ayyub</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="400">
                <div class="bento-card bg-white p-4 text-center">
                    <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; background: rgba(13, 110, 253, 0.1); color: #0d6efd;">📍</div>
                    <h5 class="fw-bold mb-1">Medan</h5>
                    <span class="badge bg-light text-dark border mb-2">Kode: MES</span>
                    <p class="small text-muted mb-0">Bu Erly, Bu Darneli, Pak Yusuf, Pak Khoir</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="400">
                <div class="bento-card bg-white p-4 text-center">
                    <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; background: rgba(13, 110, 253, 0.1); color: #0d6efd;">📍</div>
                    <h5 class="fw-bold mb-1">Malang</h5>
                    <span class="badge bg-light text-dark border mb-2">Kode: MXG</span>
                    <p class="small text-muted mb-0">Pak Febi</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="500">
                <div class="bento-card bg-white p-4 text-center">
                    <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; background: rgba(115, 53, 183, 0.1); color: var(--primary);">📍</div>
                    <h5 class="fw-bold mb-1">Kediri</h5>
                    <span class="badge bg-light text-dark border mb-2">Kode: KDR</span>
                    <p class="small text-muted mb-0">Pak Izoel</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        const agenCount = document.getElementById('agenCount');
        const paketCount = document.getElementById('paketCount');
        const agenVal = document.getElementById('agenVal');
        const paketVal = document.getElementById('paketVal');
        const totalCuan = document.getElementById('totalCuan');

        function calculateCuan() {
            if(!agenCount || !paketCount) return;
            const agen = parseInt(agenCount.value);
            const paket = parseInt(paketCount.value);
            // Angka pengali sudah diganti menjadi 300
            const total = agen * paket * 300 * 30; 
            
            agenVal.innerText = agen;
            paketVal.innerText = paket;
            totalCuan.innerText = "Rp " + total.toLocaleString('id-ID');
        }

        if(agenCount && paketCount) {
            agenCount.addEventListener('input', calculateCuan);
            paketCount.addEventListener('input', calculateCuan);
            calculateCuan(); // init run agar langsung muncul angkanya saat halaman dimuat
        }
    });
</script>

<?php include 'footer.php'; ?>