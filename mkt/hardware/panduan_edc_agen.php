<?php
session_start();
// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panduan Pengajuan EDC KB Bank | SIMASRIM</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #7335B7;
            --accent: #F3700D;
            --kb-yellow: #ffc107;
            --kb-grey: #6c757d;
            --bg-soft: #f4f8ff;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9fa; color: #333; }
        
        /* Navbar */
        .navbar-public { background: white; padding: 15px 0; box-shadow: 0 2px 15px rgba(0,0,0,0.05); }
        .navbar-brand { font-weight: 800; color: var(--primary); font-size: 1.5rem; }
        .navbar-brand span { color: var(--accent); }
        
        /* Hero Section */
        .hero-public { background: linear-gradient(135deg, #1e1e2f, #3A1B5E); color: white; padding: 80px 0 60px; text-align: center; position: relative; overflow: hidden; }
        .hero-public::after { content: ''; position: absolute; width: 400px; height: 400px; background: var(--kb-yellow); filter: blur(150px); opacity: 0.15; border-radius: 50%; top: -100px; right: -100px; }
        
        /* Feature Cards */
        .feature-card { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.05); height: 100%; transition: 0.3s; text-align: center; }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(115, 53, 183, 0.1); border-color: rgba(115, 53, 183, 0.2); }
        .feature-icon { width: 60px; height: 60px; border-radius: 12px; background: var(--bg-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 15px; }
        
        /* Timeline */
        .timeline-container { position: relative; max-width: 800px; margin: 0 auto; padding: 20px 0; }
        .timeline-container::before { content: ''; position: absolute; top: 0; bottom: 0; left: 40px; width: 4px; background: #e9ecef; border-radius: 4px; }
        
        .timeline-step { position: relative; margin-bottom: 40px; padding-left: 90px; }
        .timeline-icon { position: absolute; left: 20px; top: 0; width: 45px; height: 45px; border-radius: 50%; background: white; border: 4px solid var(--primary); display: flex; align-items: center; justify-content: center; font-weight: bold; color: var(--primary); z-index: 2; box-shadow: 0 4px 10px rgba(115, 53, 183, 0.2); }
        
        .step-card-public { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); transition: 0.3s; }
        .step-card-public:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(0,0,0,0.06); }
        
        .doc-list { background: var(--bg-soft); border-left: 4px solid #0d6efd; padding: 15px; border-radius: 8px; margin-top: 15px; }
        .doc-list ul { margin-bottom: 0; padding-left: 20px; }
        .doc-list li { margin-bottom: 5px; font-size: 0.9rem; }
        
        .sla-badge { background: #fff3cd; color: #856404; padding: 5px 12px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; display: inline-block; margin-bottom: 15px; }
        
        /* Accordion FAQ */
        .accordion-button:not(.collapsed) { background-color: var(--bg-soft); color: var(--primary); box-shadow: none; font-weight: 600; }
        .accordion-button:focus { box-shadow: none; border-color: rgba(0,0,0,0.1); }
        
        @media (max-width: 768px) {
            .timeline-container::before { left: 20px; }
            .timeline-step { padding-left: 60px; }
            .timeline-icon { left: 0; width: 35px; height: 35px; font-size: 0.9rem; }
            .step-card-public { padding: 20px 15px; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-public sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand mb-0" href="#">SIMASRIM<span>.</span></a>
            <div class="d-flex gap-2 align-items-center">
                <a href="../index.php" class="btn btn-sm btn-outline-primary rounded-pill fw-bold px-3">
                    <i class="fas fa-arrow-left me-1"></i> MKT Hub
                </a>
                <a href="https://wa.me/6280000000000" target="_blank" class="btn btn-sm btn-outline-success rounded-pill fw-bold px-3">
                    <i class="fab fa-whatsapp me-1"></i> Hubungi CS
                </a>
            </div>
        </div>
    </nav>

    <section class="hero-public">
        <div class="container position-relative z-1">
            <span class="badge bg-warning text-dark rounded-pill px-3 py-2 mb-3 fw-bold"><i class="fas fa-star me-1"></i> Program Merchant EDC</span>
            <h1 class="fw-bold mb-3">Alur Pengajuan Mesin EDC KB Bank</h1>
            <p class="lead text-white-50 mx-auto" style="max-width: 650px; font-size: 1.1rem;">
                Dapatkan kemudahan menerima segala jenis transaksi perbankan di toko Kakak. Transparan, proses cepat, dan siap dukung kelancaran usaha.
            </p>
        </div>
    </section>

    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                        <h6 class="fw-bold text-dark">Proses Cepat</h6>
                        <p class="text-muted small mb-0">Alur diprioritaskan melalui jalur cepat (Arranet) tanpa birokrasi berbelit.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-wallet"></i></div>
                        <h6 class="fw-bold text-dark">Terima Semua Bank</h6>
                        <p class="text-muted small mb-0">Mesin EDC siap digunakan untuk kartu debit/kredit dari bank manapun.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-box-open"></i></div>
                        <h6 class="fw-bold text-dark">Starter Kit Lengkap</h6>
                        <p class="text-muted small mb-0">Gratis kertas thermal, charger, spanduk toko, hingga panduan pemakaian.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold text-dark">Tahapan Proses Aktivasi</h3>
                <p class="text-muted">Ikuti 4 langkah sederhana berikut ini.</p>
            </div>

            <div class="timeline-container">
                <div class="timeline-step">
                    <div class="timeline-icon bg-primary text-white">1</div>
                    <div class="step-card-public">
                        <div class="sla-badge"><i class="far fa-clock me-1"></i> Estimasi: 1 Hari</div>
                        <h4 class="fw-bold text-dark mb-2">Pengisian Formulir Pendaftaran</h4>
                        <p class="text-muted">Langkah pertama, Calon Agen wajib mengisi data diri dan informasi toko secara lengkap melalui formulir resmi.</p>
                        
                        <div class="doc-list border-primary bg-light">
                            <strong class="d-block mb-2 text-dark"><i class="fas fa-file-alt text-primary me-2"></i>Dokumen dasar yang disiapkan:</strong>
                            <ul class="text-muted">
                                <li>KTP Asli (Difoto dengan jelas).</li>
                                <li>Foto Tanda Tangan di atas kertas putih.</li>
                                <li>Informasi detail usaha dan kontak darurat.</li>
                            </ul>
                        </div>
                        <div class="mt-4">
                            <a href="https://www.simasrim.com/edc/registrasi.php" target="_blank" class="btn btn-primary fw-bold px-4 rounded-pill shadow-sm">Isi Formulir Sekarang <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon">2</div>
                    <div class="step-card-public">
                        <div class="sla-badge"><i class="far fa-clock me-1"></i> Estimasi: 1 - 2 Hari</div>
                        <h4 class="fw-bold text-dark mb-2">Verifikasi Dokumen Tambahan</h4>
                        <p class="text-muted">Setelah formulir diterima, Tim Customer Service SIMASRIM akan menghubungi Calon Agen melalui WhatsApp resmi untuk meminta kelengkapan dokumen pendukung pembukaan rekening.</p>
                        
                        <div class="doc-list" style="border-left-color: #198754; background: #eaf8f0;">
                            <strong class="d-block mb-2 text-dark"><i class="fas fa-camera text-success me-2"></i>Dokumen yang akan diminta oleh tim CS:</strong>
                            <ul class="text-muted">
                                <li>Foto Kartu Keluarga (KK) & Nomor KK.</li>
                                <li>Foto Selfie pemohon.</li>
                                <li>Foto Toko / Tempat Usaha tampak depan.</li>
                            </ul>
                        </div>
                        <p class="small text-danger mt-3 mb-0"><i class="fas fa-shield-alt me-1"></i> <b>Penting:</b> Pastikan pengiriman data hanya dilakukan ke nomor WhatsApp resmi SIMASRIM.</p>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon">3</div>
                    <div class="step-card-public">
                        <div class="sla-badge"><i class="far fa-clock me-1"></i> Estimasi: 3 - 5 Hari Kerja</div>
                        <h4 class="fw-bold text-dark mb-2">Proses Pembuatan Rekening</h4>
                        <p class="text-muted">Proses berjalan otomatis! Tim verifikasi dan Partner Bank akan memproses pembukaan rekening KB Bank serta mendaftarkan ID Merchant ke pusat.</p>
                        <p class="text-muted mb-0">Jika terdapat data yang kurang jelas (misal: foto buram), tim akan menghubungi kembali untuk pembaruan data agar proses aktivasi tidak ditolak.</p>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon bg-success text-white" style="border-color: var(--success);">4</div>
                    <div class="step-card-public border-success" style="background: #fcfffd;">
                        <div class="sla-badge" style="background: #d1e7dd; color: #0f5132;"><i class="fas fa-check-circle me-1"></i> Tahap Akhir</div>
                        <h4 class="fw-bold text-success mb-2">Pengiriman Mesin EDC & Starter Kit</h4>
                        <p class="text-muted">Selesai! Setelah pengajuan disetujui, perangkat EDC siap pakai akan langsung dikirimkan ke alamat toko.</p>
                        
                        <div class="p-3 mt-3 rounded border bg-white">
                            <strong class="d-block mb-2 text-dark">Isi Paket Starter Kit yang akan diterima:</strong>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-light text-dark border"><i class="fas fa-box text-success me-1"></i> Unit Mesin EDC</span>
                                <span class="badge bg-light text-dark border"><i class="fas fa-plug text-success me-1"></i> Charger</span>
                                <span class="badge bg-light text-dark border"><i class="fas fa-sim-card text-success me-1"></i> Simcard Aktif</span>
                                <span class="badge bg-light text-dark border"><i class="fas fa-image text-success me-1"></i> Spanduk Toko</span>
                                <span class="badge bg-light text-dark border"><i class="fas fa-scroll text-success me-1"></i> Kertas Thermal</span>
                                <span class="badge bg-light text-dark border"><i class="fas fa-book-open text-success me-1"></i> Panduan</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5 bg-white border-top">
        <div class="container" style="max-width: 800px;">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark">Pertanyaan Umum (FAQ)</h3>
                <p class="text-muted">Hal yang sering ditanyakan seputar pengajuan EDC.</p>
            </div>
            
            <div class="accordion shadow-sm" id="faqAccordion">
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Apakah ada biaya pendaftaran atau biaya sewa bulanan?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted small">
                            Biaya registrasi dan skema penggunaan mesin EDC akan diinformasikan secara transparan oleh tim Sales/CS kami pada saat Kakak dihubungi di Tahap 2. Tidak ada biaya tersembunyi.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Bagaimana jika saya tidak memiliki toko fisik (Usaha Rumahan)?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted small">
                            Usaha rumahan tetap bisa mengajukan selama memiliki aktivitas penjualan yang jelas. Kakak cukup memfoto area usaha di rumah (seperti tumpukan barang dagangan atau spanduk kecil di depan rumah) sebagai bukti untuk lampiran foto toko.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Berapa lama proses dari isi form hingga EDC sampai di lokasi?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted small">
                            Apabila seluruh dokumen (KTP, Foto Selfie, Foto KK, dll) jelas dan lolos verifikasi bank, estimasi total dari awal hingga status aktif adalah sekitar 5 hingga 7 hari kerja (tidak termasuk lama pengiriman ekspedisi ke lokasi Kakak).
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-light py-5 border-top text-center mt-auto">
        <div class="container">
            <div class="mb-4 d-inline-block p-4 rounded-4 bg-white shadow-sm border" style="max-width: 500px;">
                <h5 class="fw-bold text-dark mb-2">Butuh Bantuan Pendaftaran?</h5>
                <p class="text-muted small mb-4">Tim dukungan SIMASRIM siap memandu Kakak langkah demi langkah.</p>
                <a href="https://wa.me/6280000000000" target="_blank" class="btn btn-success fw-bold rounded-pill px-4 py-2 w-100">
                    <i class="fab fa-whatsapp me-2 fs-5 align-middle"></i> Chat WA CS SIMASRIM
                </a>
            </div>
            <p class="text-muted small mb-0">&copy; <?= date('Y'); ?> <b>SIMASRIM</b>. PT Solusi Mitra Aplikasi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>