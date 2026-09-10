<?php 
$page_title = "Instruksi Kerja Multi-Kurir | SIMASRIM Operations";
$footer_desc = "Dokumen Internal Terbatas - Divisi Operasional & Customer Service.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>

<style>
    /* =========================
       LAYOUT
    ========================= */
    .followup-container {
        max-width: 1800px;
        margin: auto;
    }
    @media(min-width:1600px) {
        .followup-container {
            max-width: 1920px;
        }
    }

    /* =========================
       HERO
    ========================= */
    .hero-section {
        position: relative;
        overflow: hidden;
    }
    .hero-section .container {
        max-width: 1400px;
    }

    /* =========================
       SIDEBAR
    ========================= */
    .wi-sidebar {
        position: sticky;
        top: 100px;
    }
    .wi-nav {
        gap: 10px;
    }
    .wi-nav .nav-link {
        border-radius: 16px;
        font-weight: 700;
        color: #6c757d;
        padding: 16px 18px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.05);
        transition: .3s;
        display: flex;
        align-items: center;
    }
    .wi-nav .nav-link:hover {
        transform: translateX(4px);
        background: #fafafa;
    }
    .wi-nav .nav-link.active {
        background: var(--primary);
        color: #fff;
        border-color: var(--primary);
        box-shadow: 0 10px 30px rgba(var(--primary-rgb),.25);
    }

    /* =========================
       CONTENT WRAPPER
    ========================= */
    .wi-content {
        min-height: 800px;
    }
    .tab-pane-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f3f5;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* =========================
       CARD
    ========================= */
    .wi-card {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        height: 100%;
        border: 1px solid rgba(0,0,0,.05);
        box-shadow: 0 5px 15px rgba(0,0,0,.03);
        position: relative;
        overflow: hidden;
        transition: .3s;
    }
    .wi-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(0,0,0,.08);
    }
    .wi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
    }

    /* Courier Brand Colors */
    .wi-sapx::before { background: #6f42c1; }
    .wi-jne::before { background: #004085; }
    .wi-jnt::before { background: #dc3545; }
    .wi-jnt-cargo::before { background: #008639; }
    .wi-lion::before { background: #fd7e14; }
    .wi-paxel::before { background: #20c997; }
    .wi-id::before { background: #0dcaf0; }
    .wi-anteraja::before { background: #d63384; }
    .wi-spx::before { background: #f24e1e; }
    .wi-general::before { background: #343a40; }

    /* Badge & List Typography */
    .brand-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
        margin-right: 4px;
    }
    .b-sapx { background: #f3e5f5; color: #6f42c1; }
    .b-jne { background: #e6f0fa; color: #004085; }
    .b-jnt { background: #fce4e4; color: #dc3545; }
    .b-jnt-cargo { background: #e6f3eb; color: #008639; }
    .b-lion { background: #fff4e6; color: #fd7e14; }
    .b-paxel { background: #e0f8e9; color: #198754; }
    .b-id { background: #e0f9ff; color: #08a0c2; }
    .b-anteraja { background: #fce8f0; color: #d63384; }
    .b-spx { background: #feede8; color: #f24e1e; }

    .wi-list {
        padding-left: 1.2rem;
        margin: 0;
        font-size: 0.95rem;
        color: #495057;
        line-height: 1.8;
    }
    .wi-list li { margin-bottom: 10px; }
    .wi-list li:last-child { margin-bottom: 0; }

    /* =========================
       DESKTOP CARD GRID
    ========================= */
    @media(min-width:1400px){
        #content-layanan .col-md-6 { width: 33.333%; }
        #content-dilarang .badge.bg-danger.text-danger { color: #dc3545 !important; }
        #content-pickup .col-md-6 { width: 33.333%; }
        #content-hold .col-md-6 { width: 33.333%; }
        #content-klaim .col-md-6 { width: 33.333%; }
        #content-asuransi .col-md-6 { width: 33.333%; }
        #content-packing .col-md-6 { width: 33.333%; }
        #content-batal .col-md-6 { width: 50%; }
        #content-dilarang .col-md-6 { width: 33.333%; }
    }

    /* =========================
       TABLET & MOBILE
    ========================= */
    @media(max-width:991.98px){
        .wi-sidebar { position: relative; top: auto; }
        .wi-nav {
            flex-direction: row !important;
            flex-wrap: nowrap;
            overflow-x: auto;
            scrollbar-width: none;
            padding-bottom: 10px;
            -webkit-overflow-scrolling: touch;
        }
        .wi-nav::-webkit-scrollbar { display: none; }
        .wi-nav .nav-link { white-space: nowrap; margin-bottom: 0; }
    }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--accent);"></div>
    <div class="container position-relative z-1">
        <span class="badge bg-white text-primary rounded-pill px-4 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm"><i class="fas fa-book-open me-2"></i>SOP Referensi</span>
        <h2 class="display-5 fw-bold mb-2">Instruksi Kerja (Work Instructions)</h2>
        <p class="text-white-50 mb-0">Komparasi Regulasi Layanan, SLA, Pick-Up, dan Asuransi Multi-Kurir SIMASRIM.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-3">
    <div class="container-fluid followup-container px-3 px-xl-5">
        <div class="row g-4">
            
            <div class="col-xxl-2 col-xl-3 col-lg-3">
                <div class="wi-sidebar">
                    <div class="nav flex-column wi-nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active text-start shadow-sm" id="tab-layanan" data-bs-toggle="pill" data-bs-target="#content-layanan" type="button" role="tab"><i class="fas fa-boxes me-3 fs-5"></i>1. Jenis Layanan</button>
                        <button class="nav-link text-start shadow-sm" id="tab-pickup" data-bs-toggle="pill" data-bs-target="#content-pickup" type="button" role="tab"><i class="fas fa-truck-pickup me-3 fs-5"></i>2. Waktu Pick Up</button>
                        <button class="nav-link text-start shadow-sm" id="tab-hold" data-bs-toggle="pill" data-bs-target="#content-hold" type="button" role="tab"><i class="fas fa-history me-3 fs-5"></i>3. Masa Tahan Paket</button>
                        <button class="nav-link text-start shadow-sm" id="tab-klaim" data-bs-toggle="pill" data-bs-target="#content-klaim" type="button" role="tab"><i class="fas fa-file-signature me-3 fs-5"></i>4. Klaim & SLA</button>
                        <button class="nav-link text-start shadow-sm" id="tab-asuransi" data-bs-toggle="pill" data-bs-target="#content-asuransi" type="button" role="tab"><i class="fas fa-shield-alt me-3 fs-5"></i>5. Asuransi</button>
                        <button class="nav-link text-start shadow-sm" id="tab-dilarang" data-bs-toggle="pill" data-bs-target="#content-dilarang" type="button" role="tab"><i class="fas fa-ban me-3 fs-5"></i>6. Barang Dilarang</button>
                        <button class="nav-link text-start shadow-sm" id="tab-packing" data-bs-toggle="pill" data-bs-target="#content-packing" type="button" role="tab"><i class="fas fa-box me-3 fs-5"></i>7. Standar Packing</button>
                        <button class="nav-link text-start shadow-sm" id="tab-batal" data-bs-toggle="pill" data-bs-target="#content-batal" type="button" role="tab"><i class="fas fa-exclamation-triangle me-3 fs-5"></i>8. Batal & X-Ray</button>
                    </div>
                </div>
            </div>

            <div class="col-xxl-10 col-xl-9 col-lg-9">
                <div class="wi-content">
                    <div class="tab-content bg-transparent border-0 p-0" id="v-pills-tabContent">
                        
                        <div class="tab-pane fade show active" id="content-layanan" role="tabpanel">
                            <div class="tab-pane-title"><i class="fas fa-boxes text-primary"></i> 1. Jenis Layanan Ekspedisi</div>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="wi-card wi-sapx">
                                        <span class="brand-badge b-sapx">SAPX</span>
                                        <ul class="wi-list">
                                            <li><strong>Same Day (SDS):</strong> Khusus wilayah Jakarta–Jakarta.</li>
                                            <li><strong>One Day (ODS):</strong> Estimasi 1–2 hari. Jika terlambat, tidak ada garansi.</li>
                                            <li><strong>Reguler:</strong> Dalam kota (1–2 hari), kabupaten (2–5 hari), terpencil (2–7 hari).</li>
                                            <li><strong>Satria Cargo:</strong> Kargo minimal 5 kg.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jne">
                                        <span class="brand-badge b-jne">JNE</span>
                                        <ul class="wi-list">
                                            <li><strong>YES:</strong> Estimasi esok tiba. Jika telat, otomatis downgrade ke Reguler.</li>
                                            <li><strong>REG:</strong> Estimasi tiba 3–5 hari.</li>
                                            <li><strong>JTR (Cargo):</strong> Minimal pengiriman 10 kg.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jnt">
                                        <span class="brand-badge b-jnt">J&T Express</span> <span class="brand-badge b-jnt-cargo">J&T Cargo</span>
                                        <ul class="wi-list">
                                            <li><strong>EZ:</strong> Reguler, 2–7 hari, maks 50 kg.</li>
                                            <li><strong>ECO:</strong> Ekonomis, 7–17 hari (khusus luar pulau).</li>
                                            <li><strong>JND:</strong> Super (1-3 hari), maks 20kg (Jawa, Bali, Sumatra, Sulawesi, Batam).</li>
                                            <li><strong>DOC:</strong> Khusus dokumen, 0,5 – 3 kg.</li>
                                            <li><strong>HBO:</strong> Khusus kiriman 3–10 kg.</li>
                                            <li><strong>JSD:</strong> Super (1-3 hari), dalam 1 kota maks 5kg.</li>
                                            <li><strong>J&T Cargo:</strong> Spesialis barang besar mulai 10 kg.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-lion">
                                        <span class="brand-badge b-lion">Lion Parcel</span>
                                        <ul class="wi-list">
                                            <li><strong>BOSSPACK:</strong> Prioritas (1-2 hari). Booking setelah jam 17:00, SLA otomatis +1 hari.</li>
                                            <li><strong>REGPACK:</strong> Reguler (2-3 hari) seluruh Indonesia.</li>
                                            <li><strong>JAGOPACK:</strong> Ekonomis (2-7 hari).</li>
                                            <li><strong>BIGPACK:</strong> Khusus paket besar/volumetrik (6-9 hari).</li>
                                            <li><strong>INTERPACK:</strong> Internasional (3-7 hari).</li>
                                            <li><span class="text-muted"><i>Catatan SLA: Hari Minggu dan Tanggal Merah tidak dihitung.</i></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-paxel">
                                        <span class="brand-badge b-paxel">Paxel</span>
                                        <ul class="wi-list">
                                            <li><strong>Sameday:</strong> Durasi 6-14 jam.</li>
                                            <li><strong>Next Day:</strong> Durasi maksimal H+1.</li>
                                            <li><strong>Regular:</strong> Durasi 2-3 hari.</li>
                                            <li><strong>Paxel Instant:</strong> Dalam Kota (maks 40 KM, 20 Kg), tiba 2-4 jam. Tidak ada auto-refund jika telat.</li>
                                            <li><strong>Paxel Big:</strong> Paket berat 6-25kg.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-id">
                                        <span class="brand-badge b-id">ID Express</span>
                                        <ul class="wi-list">
                                            <li><strong>LITE:</strong> Paket kecil di bawah 0,51 kg (510 gram).</li>
                                            <li><strong>REGULAR:</strong> Kecepatan 2–10 hari.</li>
                                            <li><strong>CARGO:</strong> Berat di atas 10 kg.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-spx">
                                        <span class="brand-badge b-spx">SPX (Shopee Xpress)</span>
                                        <ul class="wi-list">
                                            <li><strong>Standard:</strong> Layanan pengiriman reguler.</li>
                                            <li><strong>Sameday:</strong> Pengiriman di hari yang sama.</li>
                                            <li><strong>Instant:</strong> Pengiriman instan.</li>
                                            <li><strong>Hemat:</strong> Pengiriman ekonomis.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-anteraja">
                                        <span class="brand-badge b-anteraja">Anteraja</span>
                                        <ul class="wi-list">
                                            <li><strong>Reguler, Next Day, Same Day:</strong> Layanan operasional menyesuaikan fitur di SIMASRIM.</li>
                                            <li><span class="text-muted"><i>Catatan API: Tracking Real-time, Harga setelah diskon.</i></span></li>
                                            <li><span class="text-muted"><i>Catatan Finance: Minimum tagihan Rp 1.000.000 (jika di bawah, otomatis skema Pre-Paid).</i></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="content-pickup" role="tabpanel">
                            <div class="tab-pane-title"><i class="fas fa-truck-pickup text-primary"></i> 2. Waktu Permintaan Pick Up</div>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="wi-card wi-sapx">
                                        <span class="brand-badge b-sapx">SAPX</span>
                                        <ul class="wi-list">
                                            <li><strong>Senin–Jumat:</strong> Maksimal pukul 15.00 WIB.</li>
                                            <li><strong>Sabtu:</strong> Maksimal pukul 12.00 WIB.</li>
                                            <li><strong>Minggu/Libur:</strong> Tidak ada layanan pick up.</li>
                                            <li><strong>Same Day (SDS):</strong> Maksimal pukul 09.00 WIB.</li>
                                            <li><strong>One Day (ODS):</strong> Maksimal pukul 12.00 WIB.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jne">
                                        <span class="brand-badge b-jne">JNE</span>
                                        <ul class="wi-list">
                                            <li><strong>Reguler:</strong> Permintaan maksimal pukul 14.00 WIB.</li>
                                            <li><strong>YES:</strong> Permintaan maksimal pukul 12.00 WIB.</li>
                                            <li><span class="text-muted"><i>Catatan: Lewat batas jam akan diproses esok hari.</i></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-lion">
                                        <span class="brand-badge b-lion">Lion Parcel</span>
                                        <ul class="wi-list">
                                            <li><strong>Setiap Hari:</strong> Batas request pick up pukul 16.00 WIB untuk diproses di hari yang sama.</li>
                                            <li><span class="text-muted"><i>Catatan: Lewat pukul 16.00 WIB diproses esok hari. Armada menyesuaikan kondisi lapangan.</i></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jnt">
                                        <span class="brand-badge b-jnt">J&T Express</span>
                                        <ul class="wi-list">
                                            <li><strong>Minimal Paket:</strong> Tidak ada minimal paket untuk pick up.</li>
                                            <li><strong>SLA Pickup:</strong> Maksimal 1 x 24 jam sejak order dibuat.</li>
                                            <li><strong>Cut Off Reguler:</strong> Pukul 16.00 WIB (EZ, ECO, DOC, HBO).</li>
                                            <li><strong>Cut Off Super:</strong> Pukul 12.00 WIB (SUPER JSD).</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-paxel">
                                        <span class="brand-badge b-paxel">Paxel</span>
                                        <ul class="wi-list">
                                            <li><strong>Sameday:</strong> Request maksimal pukul 12.00 WIB.</li>
                                            <li><strong>PaxelBig:</strong> Request maksimal pukul 14.00 WIB (Dalam Kota) atau 12.00 WIB (Luar Kota).</li>
                                            <li><strong>SLA Tunggu:</strong> Waktu tunggu kurir maksimal 7 menit. Jika paket belum siap, re-attempt 2x sebelum dibatalkan.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-id">
                                        <span class="brand-badge b-id">ID Express</span>
                                        <ul class="wi-list">
                                            <li><strong>Sesi Pick Up:</strong> Batas request terbagi 2 sesi yaitu 13.00 WIB dan 18.00 WIB.</li>
                                            <li><strong>Batas Berat:</strong> Maksimal berat paket reguler 50 kg.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-anteraja">
                                        <span class="brand-badge b-anteraja">Anteraja</span>
                                        <ul class="wi-list">
                                            <li><strong>Cut Off Time (COT):</strong> Pick up hari yang sama maksimal 14.00 WIB, selebihnya H+1 atau H+2.</li>
                                            <li><strong>Sistem Pick Up:</strong> Tersedia 3x percobaan (hari ini, esok, lusa). AWB wajib tertempel jelas.</li>
                                            <li><strong>Penyesuaian Dimensi:</strong> Jika aktual berbeda, disesuaikan dengan konfirmasi shipper. Jika ditolak, pick up batal.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-general">
                                        <span class="brand-badge b-spx">SPX</span> <span class="brand-badge b-jnt-cargo">J&T Cargo</span>
                                        <ul class="wi-list">
                                            <li><strong>Permintaan Pick Up:</strong> Maksimal pukul 12.00 WIB atau menyesuaikan jam operasional outlet lokal.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="content-hold" role="tabpanel">
                            <div class="tab-pane-title"><i class="fas fa-history text-primary"></i> 3. Masa Tahan Barang (Undelivered)</div>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="wi-card wi-sapx">
                                        <span class="brand-badge b-sapx">SAPX</span>
                                        <ul class="wi-list">
                                            <li><strong>Percobaan:</strong> Pengiriman dilakukan maksimal 3x pengantaran.</li>
                                            <li><strong>Masa Tahan:</strong> 3–7 hari (Jika ditolak penerima, ditahan sejak hari ke-1).</li>
                                            <li><strong>Status Retur:</strong> Jika masa tahan habis tanpa instruksi, otomatis retur.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jne">
                                        <span class="brand-badge b-jne">JNE</span>
                                        <ul class="wi-list">
                                            <li><strong>Percobaan:</strong> Pengiriman dilakukan 2–3x pengantaran.</li>
                                            <li><strong>Masa Tahan:</strong> 7 hari (dihitung sejak percobaan pertama).</li>
                                            <li><strong>Status Retur:</strong> Jika masa tahan habis, menjadi wewenang cabang dan dapat dimusnahkan.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-lion">
                                        <span class="brand-badge b-lion">Lion Parcel</span>
                                        <ul class="wi-list">
                                            <li><strong>Percobaan:</strong> Minimal 2x, maksimal 3x.</li>
                                            <li><strong>Masa Tahan:</strong> Jika gagal, status Hold At Location (HAL) ditahan 7x24 jam.</li>
                                            <li><strong>Status Retur:</strong> Lewat 7 hari tanpa respon otomatis retur (RTS).</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jnt">
                                        <span class="brand-badge b-jnt">J&T Express</span> <span class="brand-badge b-jnt-cargo">J&T Cargo</span>
                                        <ul class="wi-list">
                                            <li><strong>J&T Express:</strong> Masa tahan 2 hari. Lewat dari itu barang jadi wewenang J&T dan tidak dapat diretur.</li>
                                            <li><strong>J&T Cargo:</strong> Masa tahan gagal kirim 3 hari sebelum diretur.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-paxel">
                                        <span class="brand-badge b-paxel">Paxel</span>
                                        <ul class="wi-list">
                                            <li><strong>Percobaan:</strong> Maksimal 3x pengantaran.</li>
                                            <li><strong>Status Retur:</strong> Jika tetap gagal, paket langsung dikembalikan (retur) tanpa masa tahan tambahan.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-anteraja">
                                        <span class="brand-badge b-anteraja">Anteraja</span>
                                        <ul class="wi-list">
                                            <li><strong>Percobaan:</strong> Total 3x percobaan pengantaran (wajib respon).</li>
                                            <li><strong>Masa Tahan:</strong> Hold 3x24 Jam setelah percobaan pertama.</li>
                                            <li><strong>Status Retur:</strong> Auto Return bila ditolak penerima atau alamat tidak dikenal (kecuali ada validasi jelas/WA).</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-general">
                                        <span class="brand-badge b-spx">SPX</span> <span class="brand-badge b-id">ID Express</span>
                                        <ul class="wi-list">
                                            <li><strong>Percobaan:</strong> Maksimal 3x pengantaran.</li>
                                            <li><strong>Status Retur:</strong> Jika penerima menolak, otomatis langsung retur ke pengirim.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="content-klaim" role="tabpanel">
                            <div class="tab-pane-title"><i class="fas fa-file-signature text-primary"></i> 4. Klaim & Service Level Agreement</div>
                            
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <div class="wi-card wi-sapx">
                                        <span class="brand-badge b-sapx">SAPX</span>
                                        <ul class="wi-list">
                                            <li><strong>Klaim Hilang:</strong> Diajukan maksimal 2 hari sejak dinyatakan hilang/diterima.</li>
                                            <li><strong>Klaim Rusak:</strong> Diajukan maksimal 7 hari sejak dinyatakan rusak/diterima.</li>
                                            <li><strong>SLA Pencairan:</strong> 14 hari kerja.</li>
                                            <li><strong>SLA Return:</strong> Jabodetabek (14 hr), Jawa–Bali (24 hr), Sumatra/Kalimantan/Nusa (35-45 hr), Indonesia Timur/Sulawesi (45-50 hr).</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-lion">
                                        <span class="brand-badge b-lion">Lion Parcel</span>
                                        <ul class="wi-list">
                                            <li><strong>Klaim Rusak:</strong> Maksimal 7 Hari Kalender sejak POD. Syarat: Video Unboxing.</li>
                                            <li><strong>Klaim Hilang:</strong> Maksimal 30 Hari sejak Booking BKD. Syarat: Invoice Pembelian.</li>
                                            <li><strong>SLA Investigasi:</strong> Maksimal 14 hari kerja.</li>
                                            <li><span class="text-muted"><i>Catatan: Nilai barang wajib diisi saat pengiriman walau tanpa asuransi.</i></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jne">
                                        <span class="brand-badge b-jne">JNE</span>
                                        <ul class="wi-list">
                                            <li><strong>Klaim Hilang:</strong> Maksimal pengajuan 7 hari.</li>
                                            <li><strong>Klaim Rusak:</strong> Maksimal pengajuan 3 hari.</li>
                                            <li><strong>Masa Sanggah:</strong> Non-COD maksimal 7 hari sejak estimasi, COD maksimal 3 hari sejak POD.</li>
                                            <li><strong>SLA Investigasi:</strong> 14 hari.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jnt">
                                        <span class="brand-badge b-jnt">J&T Express</span> <span class="brand-badge b-jnt-cargo">J&T Cargo</span>
                                        <ul class="wi-list">
                                            <li><strong>Klaim Rusak:</strong> Maksimal 3 hari kerja setelah paket diterima.</li>
                                            <li><strong>Klaim Hilang:</strong> Maksimal 30 hari (J&T Express) atau 7 Hari (J&T Cargo) sejak dinyatakan hilang.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-paxel">
                                        <span class="brand-badge b-paxel">Paxel</span>
                                        <ul class="wi-list">
                                            <li><strong>Batas Lapor:</strong> Maksimal 3 Hari Kalender sejak POD.</li>
                                            <li><strong>Syarat Wajib:</strong> Video packing/unboxing dari awal s/d akhir TANPA JEDA.</li>
                                            <li><strong>Pengecualian:</strong> SLA garansi gugur jika gagal X-ray atau alamat salah.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-anteraja">
                                        <span class="brand-badge b-anteraja">Anteraja</span>
                                        <ul class="wi-list">
                                            <li><strong>Batas Komplain:</strong> H+1 s/d H+3 (maksimal H+14). Lewat H+21 otomatis ditolak.</li>
                                            <li><strong>Klaim Kehilangan:</strong> Berlaku jika paket stuck 14 hari kerja (SLA 7 hari). Ganti rugi diambil nominal terkecil dari 10x ongkir atau harga barang.</li>
                                            <li><strong>Klaim Kerusakan:</strong> Investigasi maksimal 7x24 jam kerja. Makanan dapat diklaim sesuai T&C.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-spx">
                                        <span class="brand-badge b-spx">SPX</span> <span class="brand-badge b-id">ID Express</span>
                                        <ul class="wi-list">
                                            <li><strong>SPX:</strong> Rusak (maks 2 hari), Hilang (maks 7 hari). Klaim ditolak tanpa video unboxing. SLA 14 hari.</li>
                                            <li><strong>ID Express:</strong> Lapor maksimal 7 hari setelah berstatus terkirim/hilang.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="content-asuransi" role="tabpanel">
                            <div class="tab-pane-title"><i class="fas fa-shield-alt text-primary"></i> 5. Asuransi & Penggantian (Ganti Rugi)</div>
                            
                            <div class="p-4 bg-danger bg-opacity-10 border border-danger border-opacity-25 rounded-4 mb-4 shadow-sm">
                                <strong class="text-danger d-block mb-1 fs-5"><i class="fas fa-exclamation-triangle me-2"></i> ATURAN UMUM NON-ASURANSI</strong>
                                <p class="text-dark mb-0">Jika barang tidak diasuransikan, seluruh ekspedisi menerapkan batas ganti rugi maksimal: <strong>10x Ongkos Kirim ATAU Rp 1.000.000 ATAU Nilai Barang</strong> (Dipilih nominal yang paling kecil).</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="wi-card wi-sapx">
                                        <span class="brand-badge b-sapx">SAPX</span>
                                        <ul class="wi-list">
                                            <li><strong>Kewajiban:</strong> Barang dengan nilai lebih dari 10x ongkir wajib diasuransikan.</li>
                                            <li><strong>Premi Asuransi:</strong> 0,3% dari nilai barang ditambah Rp 2.000 per paket.</li>
                                            <li><strong>Pengecualian:</strong> Elektronik & Akrilik tidak dapat diklaim ganti rugi meskipun diasuransikan.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jnt">
                                        <span class="brand-badge b-jnt">J&T Express</span>
                                        <ul class="wi-list">
                                            <li><strong>Kewajiban:</strong> Barang > Rp 1 Juta wajib asuransi (Premi 0,2%). Maksimal ganti Rp 20 Juta. Wajib Nota Asli.</li>
                                            <li><strong>Khusus Dokumen (DOC):</strong> Jika DOC Non-Asuransi, penggantian maksimal Rp 250.000. DOC EZ Non-Asuransi maksimal Rp 100.000.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-lion">
                                        <span class="brand-badge b-lion">Lion Parcel</span>
                                        <ul class="wi-list">
                                            <li><strong>Non-Asuransi:</strong> Maksimal 10x Ongkir atau Rp 2 Juta (diambil nominal terkecil).</li>
                                            <li><strong>Premi Asuransi:</strong> 0,27% dari Declare Value.</li>
                                            <li><strong>Syarat Ketat:</strong> Jika Declare Komoditi tidak sesuai isi aktual paket, klaim otomatis ditolak.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jne">
                                        <span class="brand-badge b-jne">JNE</span>
                                        <ul class="wi-list">
                                            <li><strong>Syarat Packing:</strong> Tanpa packing kayu JNE, tidak ada ganti rugi kerusakan.</li>
                                            <li><strong>Penggantian Asuransi:</strong> Jika diasuransikan, diganti penuh senilai harga invoice barang.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-paxel">
                                        <span class="brand-badge b-paxel">Paxel</span>
                                        <ul class="wi-list">
                                            <li><strong>Asuransi Dasar:</strong> Gratis asuransi dasar untuk ganti rugi maksimal hingga Rp 1 Juta.</li>
                                            <li><strong>Premi Asuransi:</strong> Asuransi tambahan 0,2% dari harga barang. Ganti rugi mencapai maksimal Rp 50 Juta.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-general">
                                        <span class="brand-badge b-id">ID Express</span> <span class="brand-badge b-jnt-cargo">J&T Cargo</span>
                                        <ul class="wi-list">
                                            <li><strong>Premi Standar:</strong> Umumnya dikenakan 0,2% dari nilai invoice.</li>
                                            <li><strong>Khusus ID Express:</strong> Dokumen non-asuransi maksimal penggantian hanya Rp 100.000.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-anteraja">
                                        <span class="brand-badge b-anteraja">Anteraja</span>
                                        <ul class="wi-list">
                                            <li><strong>Non-Asuransi:</strong> Penggantian diambil dari nominal terkecil antara 10x ongkir atau harga barang aktual.</li>
                                            <li><strong>Barang Berharga:</strong> Logam mulia, perhiasan, dll. tunduk pada T&C khusus perusahaan.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="content-dilarang" role="tabpanel">
                            <div class="tab-pane-title"><i class="fas fa-ban text-danger"></i> 6. Barang yang Dilarang Dikirim</div>
                            
                            <div class="wi-card border-danger mb-4 shadow-sm">
                                <strong class="text-danger d-block mb-3 fs-5"><i class="fas fa-minus-circle me-2"></i> Larangan Universal (Seluruh Ekspedisi):</strong>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2">Senjata & Narkotika</span>
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2">Bahan Meledak/Terbakar</span>
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2">Kimia Beracun & Radioaktif</span>
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2">Uang Tunai / Logam Mulia</span>
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2">Hewan / Tanaman Langka</span>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="wi-card wi-sapx">
                                        <span class="brand-badge b-sapx">SAPX</span> <span class="brand-badge b-spx">SPX</span>
                                        <ul class="wi-list">
                                            <li><strong>Produk Digital:</strong> Dilarang keras produk digital seperti Netflix, Spotify, Akun Google, Voucher Game.</li>
                                            <li><strong>Kemasan Kosong:</strong> Dilarang mengirimkan kardus kosong (tanpa pelindung atau barang).</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-lion">
                                        <span class="brand-badge b-lion">Lion Parcel</span>
                                        <ul class="wi-list">
                                            <li><strong>Kesesuaian Isi:</strong> Paket yang isinya tidak sesuai STT atau barang busuk/berubah kimiawi akan ditolak.</li>
                                            <li><strong>Pengecualian Karantina:</strong> Hewan/Tanaman diperbolehkan asalkan melampirkan form surat karantina resmi.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-paxel">
                                        <span class="brand-badge b-paxel">Paxel</span>
                                        <ul class="wi-list">
                                            <li><strong>Bahan Berbahaya:</strong> Aerosol, parfum, dan alkohol tidak diperbolehkan.</li>
                                            <li><strong>Larangan Udara:</strong> Zat cair, madu murni, aki, dan powerbank.</li>
                                            <li><strong>Makanan:</strong> Makanan menyengat (seperti durian) dan makanan hewan dilarang.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jnt-cargo">
                                        <span class="brand-badge b-jnt-cargo">J&T Cargo & Umum</span>
                                        <ul class="wi-list">
                                            <li><strong>Aturan Baterai Udara:</strong> Baterai (Powerbank, Aki, Baterai Koin) dilarang dikirim ke destinasi luar pulau via jalur udara.</li>
                                            <li><strong>Sepeda Listrik:</strong> Hanya diperbolehkan dikirim melalui layanan J&T Cargo.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="content-packing" role="tabpanel">
                            <div class="tab-pane-title"><i class="fas fa-box text-primary"></i> 7. Standar Pengemasan (Packing)</div>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="wi-card wi-sapx">
                                        <span class="brand-badge b-sapx">SAPX</span>
                                        <ul class="wi-list">
                                            <li><strong>Standar Dasar:</strong> Wajib Bubble Wrap minimal 3 lapis, sekat kardus, dan stiker Fragile.</li>
                                            <li><strong>Packing Kayu:</strong> Wajib untuk barang besar, fragile, cairan, dan elektronik.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jne">
                                        <span class="brand-badge b-jne">JNE</span>
                                        <ul class="wi-list">
                                            <li><strong>Packing Kayu:</strong> Cairan & Elektronik wajib menggunakan packing kayu JNE (Dihitung 2x berat aktual).</li>
                                            <li><strong>Pengecualian:</strong> Jika dipacking sendiri (tanpa kayu JNE), kerusakan tidak akan diganti.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-lion">
                                        <span class="brand-badge b-lion">Lion Parcel</span>
                                        <ul class="wi-list">
                                            <li><strong>Fasilitas Lion:</strong> Lion tidak menyediakan layanan packing kayu. Seller wajib membuat kayu sendiri sebelum pickup.</li>
                                            <li><strong>Repacking:</strong> Jika berat/dimensi berbeda, kurir Lion akan repacking dan menerbitkan tagihan STT baru otomatis.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jnt">
                                        <span class="brand-badge b-jnt">J&T Express</span>
                                        <ul class="wi-list">
                                            <li><strong>Labeling:</strong> Resi termal ukuran 10x10cm wajib standar J&T. Khusus dokumen disarankan amplop tebal & dilakban H-Taping.</li>
                                            <li><strong>Toleransi Berat & Dimensi:</strong> Berat 1,30 Kg otomatis dibulatkan 2 Kg. Dimensi di atas 150cm dikenakan tambahan biaya 50%.</li>
                                            <li><strong>Packing Kayu J&T:</strong> Dikenakan biaya tambahan 30% dari berat aktual (Minimal 3 Kg).</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-paxel">
                                        <span class="brand-badge b-paxel">Paxel</span>
                                        <ul class="wi-list">
                                            <li><strong>Akurasi Dimensi:</strong> Dimensi diinput SESUDAH packing. Jika aktual lebih besar, otomatis terbit denda tagihan.</li>
                                            <li><strong>Cold Chain:</strong> Wajib kedap air dan memiliki ketahanan suhu minimal 14 jam.</li>
                                            <li><strong>Fragile:</strong> Box wajib penuh tanpa ada ruang hampa untuk mencegah goncangan paket.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-id">
                                        <span class="brand-badge b-id">ID Express</span>
                                        <ul class="wi-list">
                                            <li><strong>Standar Cairan:</strong> Wajib 4 lapis (Wadah primer, penyerap, sekunder, luar). Disegel H-Taping rapat.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-anteraja">
                                        <span class="brand-badge b-anteraja">Anteraja</span>
                                        <ul class="wi-list">
                                            <li><strong>Pemisahan Isi:</strong> Makanan padat/cair wajib dipisah bungkusnya dari non-makanan. Benda tajam wajib dibox dan dilabeli.</li>
                                            <li><strong>Fragile / Kayu:</strong> Wajib info sebelum pickup. Tidak ada layanan penambahan packing dari Anteraja (kecuali repacking saat rusak).</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="content-batal" role="tabpanel">
                            <div class="tab-pane-title"><i class="fas fa-exclamation-triangle text-primary"></i> 8. Batal Kirim, Misroute, dan Gagal X-Ray</div>
                            
                            <div class="p-4 bg-warning bg-opacity-10 border border-warning border-opacity-50 rounded-4 mb-4 shadow-sm">
                                <strong class="text-dark d-block mb-2 fs-5"><i class="fas fa-info-circle text-warning me-2"></i> Aturan Universal Pembatalan:</strong>
                                <p class="text-dark mb-0">Pembatalan yang "Bebas Ongkir/Void" HANYA BERLAKU JIKA PAKET BELUM DIPICKUP. Jika kurir sudah menjemput atau masuk proses tahap sorting/terbang, pembatalan akan menjadi <strong>RETUR dan ongkir TETAP DITAGIHKAN</strong>.</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="wi-card wi-jne">
                                        <span class="brand-badge b-jne">JNE</span>
                                        <ul class="wi-list">
                                            <li><strong>Batal:</strong> Jika sudah Hand Over gudang, harus request ke IT JNE. Bebas ongkir berlaku jika status dikonfirmasi "Return".</li>
                                            <li><strong>Misroute:</strong> Jika alamat salah dan diteruskan/diretur, biayanya akan otomatis terpotong dari poin agen.</li>
                                            <li><strong>Gagal X-Ray:</strong> Akan dilanjut via jalur darat. Jika diretur sebelum sampai, ongkir digratiskan (wajib ada bukti).</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-sapx">
                                        <span class="brand-badge b-sapx">SAPX</span>
                                        <ul class="wi-list">
                                            <li><strong>Misroute:</strong> Jika alamat salah kemudian diretur/diteruskan, ongkir tetap ditagihkan penuh sesuai tujuan akhir.</li>
                                            <li><strong>Gagal X-Ray:</strong> Status akan di-update menjadi RTS karena penolakan bandara, dan mengikuti skema retur berbayar.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-jnt">
                                        <span class="brand-badge b-jnt">J&T Express</span>
                                        <ul class="wi-list">
                                            <li><strong>Batal:</strong> Jika resi sudah ter-track di sistem, ongkir tetap ditagihkan walau paket dibatalkan (Banding finance belum tentu disetujui).</li>
                                            <li><strong>Misroute:</strong> Diteruskan ke alamat benar gratis. Namun diretur karena alamat bodong akan ditagihkan ongkir retur.</li>
                                            <li><strong>Gagal X-Ray:</strong> Tetap ditagihkan. Hanya jika terbukti murni kesalahan operasional J&T, tagihan bisa ditarik kembali.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wi-card wi-paxel">
                                        <span class="brand-badge b-paxel">Paxel</span>
                                        <ul class="wi-list">
                                            <li><strong>Gagal Pick Up:</strong> Jika kurir sudah re-attempt 2x tapi paket belum siap, order dibatalkan otomatis oleh sistem.</li>
                                            <li><strong>Gagal X-Ray:</strong> Termasuk dalam klausul Force Majeure. Jika paket ditolak maskapai, SLA garansi otomatis tidak berlaku.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div></div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>