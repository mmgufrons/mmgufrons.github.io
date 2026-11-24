<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panduan Pengajuan EDC KB Bank | SIMASRIM</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='16' fill='%230b0d12'/%3E%3Ctext x='32' y='43' font-family='Arial, sans-serif' font-weight='700' font-size='26' fill='%236ea8fe' text-anchor='middle'%3EMG%3C/text%3E%3C/svg%3E">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Warna merek SIMASRIM dipertahankan; hanya digelapkan secukupnya demi kontras AAA (7:1) */
            --primary: #7335B7;
            --accent: #F3700D;
            --kb-yellow: #ffc107;
            --bg-soft: #f4f8ff;
            --ink: #212529;
            --muted: #495057;          /* 8.2:1 di putih (abu Bootstrap bawaan hanya 4.7:1) */
            --biru: #0b4ab0;           /* biru tombol Bootstrap, digelapkan: 8:1 */
            --hijau: #11613c;          /* hijau WhatsApp/sukses, digelapkan: 7.5:1 */
            --merah: #a52834;
            --s-4: 4px; --s-8: 8px; --s-16: 16px; --s-24: 24px; --s-32: 32px; --s-48: 48px; --s-64: 64px;
            --r-8: 8px; --r-16: 16px;
            --fs-13: 0.8125rem; --fs-14: 0.875rem; --fs-16: 1rem; --fs-18: 1.125rem;
            --gerak-cepat: 120ms; --gerak-normal: 200ms; --gerak-sedang: 320ms;
            --ease-keluar: cubic-bezier(0.16, 1, 0.3, 1);
            --bs-secondary-color: var(--muted);
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9fa; color: var(--ink); font-size: var(--fs-16); line-height: 1.6; }
        h1, h2, h3 { line-height: 1.25; }

        /* Kontras AAA untuk kelas Bootstrap yang dipakai */
        .text-muted { color: var(--muted) !important; }
        .text-danger { color: var(--merah) !important; }
        .text-success { color: var(--hijau) !important; }
        .btn-primary { --bs-btn-bg: var(--biru); --bs-btn-border-color: var(--biru); --bs-btn-hover-bg: #083a8c; --bs-btn-hover-border-color: #083a8c; --bs-btn-active-bg: #083a8c; }
        .btn-success { --bs-btn-bg: var(--hijau); --bs-btn-border-color: var(--hijau); --bs-btn-hover-bg: #0c4a2d; --bs-btn-hover-border-color: #0c4a2d; --bs-btn-active-bg: #0c4a2d; }
        .btn-outline-success { --bs-btn-color: var(--hijau); --bs-btn-border-color: var(--hijau); --bs-btn-hover-bg: var(--hijau); --bs-btn-hover-border-color: var(--hijau); --bs-btn-active-bg: var(--hijau); }
        /* Tombol: area sentuh 44px, umpan balik tekan, hover hanya untuk pointer presisi */
        .btn { min-height: 44px; display: inline-flex; align-items: center; justify-content: center; gap: var(--s-8);
               transition: color var(--gerak-normal) ease, background-color var(--gerak-normal) ease, border-color var(--gerak-normal) ease, transform var(--gerak-cepat) ease; }
        .btn:active { transform: scale(0.97); }
        .btn-sm { font-size: var(--fs-14); padding-left: var(--s-16); padding-right: var(--s-16); }
        a:focus-visible, .btn:focus-visible, .accordion-button:focus-visible { outline: 3px solid var(--biru); outline-offset: 2px; box-shadow: none; }

        /* Navbar */
        .navbar-public { background: #fff; padding: var(--s-8) 0; box-shadow: 0 2px 16px rgba(0,0,0,0.05); }
        .navbar-brand { font-weight: 800; color: var(--primary); font-size: 1.5rem; min-height: 44px; display: inline-flex; align-items: center; }
        .navbar-brand span { color: var(--accent); }

        /* Hero */
        .hero-public { background: linear-gradient(135deg, #1e1e2f, #3A1B5E); color: #fff; padding: var(--s-64) 0 var(--s-48); text-align: center; position: relative; overflow: hidden; }
        .hero-public::after { content: ''; position: absolute; width: 400px; height: 400px; background: var(--kb-yellow); filter: blur(150px); opacity: 0.15; border-radius: 50%; top: -96px; right: -96px; }
        .hero-public h1 { font-size: clamp(1.75rem, 1.2rem + 2.4vw, 2.5rem); }
        .hero-lead { max-width: 640px; font-size: var(--fs-18); color: rgba(255,255,255,0.85); }

        /* Kartu fitur */
        .feature-card { background: #fff; border-radius: var(--r-16); padding: var(--s-24); box-shadow: 0 4px 16px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06); height: 100%; text-align: center;
                        transition: transform var(--gerak-sedang) var(--ease-keluar), box-shadow var(--gerak-sedang) ease, border-color var(--gerak-normal) ease; }
        .feature-card h2 { font-size: var(--fs-18); margin-bottom: var(--s-8); }
        .feature-card p { font-size: var(--fs-14); line-height: 1.6; }
        .feature-icon { width: 56px; height: 56px; border-radius: 12px; background: var(--bg-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto var(--s-16); }
        .judul-bagian { font-size: clamp(1.5rem, 1.2rem + 1.2vw, 1.75rem); }

        /* Timeline */
        .timeline-container { position: relative; max-width: 800px; margin: 0 auto; padding: var(--s-16) 0; }
        .timeline-container::before { content: ''; position: absolute; top: 0; bottom: 0; left: 40px; width: 4px; background: #e9ecef; border-radius: 4px; }
        .timeline-step { position: relative; margin-bottom: var(--s-32); padding-left: calc(var(--s-64) + var(--s-24)); }
        .timeline-icon { position: absolute; left: 20px; top: 0; width: 44px; height: 44px; border-radius: 50%; background: #fff; border: 4px solid var(--primary); display: flex; align-items: center; justify-content: center; font-weight: bold; color: var(--primary); z-index: 2; box-shadow: 0 4px 8px rgba(115, 53, 183, 0.2); }
        .timeline-icon.selesai { background: var(--hijau); border-color: var(--hijau); color: #fff; }
        .step-card-public { background: #fff; border-radius: var(--r-16); padding: var(--s-24); box-shadow: 0 8px 32px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);
                            transition: transform var(--gerak-sedang) var(--ease-keluar), box-shadow var(--gerak-sedang) ease; }
        .step-card-public.selesai { border-color: var(--hijau); background: #fcfffd; }
        .step-card-public h3 { font-size: var(--fs-18); margin-bottom: var(--s-8); }
        @media (min-width: 768px) { .step-card-public h3 { font-size: 1.25rem; } }

        .doc-list { background: var(--bg-soft); border-left: 4px solid var(--biru); padding: var(--s-16); border-radius: var(--r-8); margin-top: var(--s-16); }
        .doc-list.hijau { border-left-color: var(--hijau); background: #eaf8f0; }
        .doc-list ul { margin-bottom: 0; padding-left: var(--s-24); }
        .doc-list li { margin-bottom: var(--s-8); font-size: var(--fs-16); }
        .doc-list li:last-child { margin-bottom: 0; }
        .isi-paket { padding: var(--s-16); margin-top: var(--s-16); border-radius: var(--r-8); border: 1px solid #dee2e6; background: #fff; }
        .isi-paket .badge { font-size: var(--fs-13); font-weight: 600; padding: var(--s-8); }

        .sla-badge { background: #fff3cd; color: #664d03; padding: var(--s-4) var(--s-16); border-radius: 50px; font-size: var(--fs-13); font-weight: 600; display: inline-block; margin-bottom: var(--s-16); }
        .sla-badge.selesai { background: #d1e7dd; color: #0f5132; }

        /* FAQ */
        .faq-wrap { max-width: 800px; }
        .accordion-button { min-height: 44px; font-size: var(--fs-16); }
        .accordion-button:not(.collapsed) { background-color: var(--bg-soft); color: var(--primary); box-shadow: none; font-weight: 600; }
        .accordion-button:focus { box-shadow: none; border-color: rgba(0,0,0,0.1); }
        .accordion-body { font-size: var(--fs-16); line-height: 1.6; }

        .bantuan { max-width: 480px; }
        .bantuan h2 { font-size: 1.25rem; }

        @media (hover: hover) and (pointer: fine) {
            .feature-card:hover { transform: translateY(-4px); box-shadow: 0 16px 32px rgba(115, 53, 183, 0.1); border-color: rgba(115, 53, 183, 0.2); }
            .step-card-public:hover { transform: translateY(-4px); box-shadow: 0 16px 32px rgba(0,0,0,0.06); }
        }
        @media (max-width: 767.98px) {
            .timeline-container::before { left: 20px; }
            .timeline-step { padding-left: calc(var(--s-48) + var(--s-8)); margin-bottom: var(--s-24); }
            .timeline-icon { left: 0; width: 44px; height: 44px; font-size: var(--fs-14); }
            .step-card-public { padding: var(--s-16); }
        }
        @media (prefers-reduced-motion: reduce) {
            .btn, .feature-card, .step-card-public { transition: none; }
            .btn, .feature-card, .step-card-public { transform: none !important; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-public sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand mb-0" href="#">SIMASRIM<span>.</span></a>
            <a href="https://wa.me/6280000000000" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success rounded-pill fw-bold px-3">
                <i class="fab fa-whatsapp me-1" aria-hidden="true"></i> Hubungi CS
            </a>
        </div>
    </nav>

    <section class="hero-public">
        <div class="container position-relative z-1">
            <span class="badge bg-warning text-dark rounded-pill px-3 py-2 mb-3 fw-bold"><i class="fas fa-star me-1" aria-hidden="true"></i> Program Merchant EDC</span>
            <h1 class="fw-bold mb-3">Alur Pengajuan Mesin EDC KB Bank</h1>
            <p class="hero-lead mx-auto mb-0">
                Dapatkan kemudahan menerima segala jenis transaksi perbankan di toko Kakak. Transparan, proses cepat, dan siap dukung kelancaran usaha.
            </p>
        </div>
    </section>

    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-bolt" aria-hidden="true"></i></div>
                        <h2 class="fw-bold text-dark">Proses Cepat</h2>
                        <p class="text-muted mb-0">Alur diprioritaskan melalui jalur cepat (Arranet) tanpa birokrasi berbelit.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-wallet" aria-hidden="true"></i></div>
                        <h2 class="fw-bold text-dark">Terima Semua Bank</h2>
                        <p class="text-muted mb-0">Mesin EDC siap digunakan untuk kartu debit/kredit dari bank manapun.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-box-open" aria-hidden="true"></i></div>
                        <h2 class="fw-bold text-dark">Starter Kit Lengkap</h2>
                        <p class="text-muted mb-0">Gratis kertas thermal, charger, spanduk toko, hingga panduan pemakaian.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark judul-bagian">Tahapan Proses Aktivasi</h2>
                <p class="text-muted">Ikuti 4 langkah sederhana berikut ini.</p>
            </div>

            <div class="timeline-container">
                <div class="timeline-step">
                    <div class="timeline-icon bg-primary text-white">1</div>
                    <div class="step-card-public">
                        <div class="sla-badge"><i class="far fa-clock me-1" aria-hidden="true"></i> Estimasi: 1 Hari</div>
                        <h3 class="fw-bold text-dark">Pengisian Formulir Pendaftaran</h3>
                        <p class="text-muted">Langkah pertama, Calon Agen wajib mengisi data diri dan informasi toko secara lengkap melalui formulir resmi.</p>
                        
                        <div class="doc-list">
                            <strong class="d-block mb-2 text-dark"><i class="fas fa-file-alt text-primary me-2" aria-hidden="true"></i>Dokumen dasar yang disiapkan:</strong>
                            <ul class="text-muted">
                                <li>KTP Asli (Difoto dengan jelas).</li>
                                <li>Foto Tanda Tangan di atas kertas putih.</li>
                                <li>Informasi detail usaha dan kontak darurat.</li>
                            </ul>
                        </div>
                        <div class="mt-4">
                            <a href="https://www.simasrim.com/edc/registrasi.php" target="_blank" rel="noopener" class="btn btn-primary fw-bold px-4 rounded-pill shadow-sm">Isi Formulir Sekarang <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon">2</div>
                    <div class="step-card-public">
                        <div class="sla-badge"><i class="far fa-clock me-1" aria-hidden="true"></i> Estimasi: 1 - 2 Hari</div>
                        <h3 class="fw-bold text-dark">Verifikasi Dokumen Tambahan</h3>
                        <p class="text-muted">Setelah formulir diterima, Tim Customer Service SIMASRIM akan menghubungi Calon Agen melalui WhatsApp resmi untuk meminta kelengkapan dokumen pendukung pembukaan rekening.</p>
                        
                        <div class="doc-list hijau">
                            <strong class="d-block mb-2 text-dark"><i class="fas fa-camera text-success me-2" aria-hidden="true"></i>Dokumen yang akan diminta oleh tim CS:</strong>
                            <ul class="text-muted">
                                <li>Foto Kartu Keluarga (KK) & Nomor KK.</li>
                                <li>Foto Selfie pemohon.</li>
                                <li>Foto Toko / Tempat Usaha tampak depan.</li>
                            </ul>
                        </div>
                        <p class="text-danger mt-3 mb-0"><i class="fas fa-shield-alt me-1" aria-hidden="true"></i> <b>Penting:</b> Pastikan pengiriman data hanya dilakukan ke nomor WhatsApp resmi SIMASRIM.</p>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon">3</div>
                    <div class="step-card-public">
                        <div class="sla-badge"><i class="far fa-clock me-1" aria-hidden="true"></i> Estimasi: 3 - 5 Hari Kerja</div>
                        <h3 class="fw-bold text-dark">Proses Pembuatan Rekening</h3>
                        <p class="text-muted">Proses berjalan otomatis! Tim verifikasi dan Partner Bank akan memproses pembukaan rekening KB Bank serta mendaftarkan ID Merchant ke pusat.</p>
                        <p class="text-muted mb-0">Jika terdapat data yang kurang jelas (misal: foto buram), tim akan menghubungi kembali untuk pembaruan data agar proses aktivasi tidak ditolak.</p>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon selesai">4</div>
                    <div class="step-card-public selesai">
                        <div class="sla-badge selesai"><i class="fas fa-check-circle me-1" aria-hidden="true"></i> Tahap Akhir</div>
                        <h3 class="fw-bold text-success">Pengiriman Mesin EDC & Starter Kit</h3>
                        <p class="text-muted">Selesai! Setelah pengajuan disetujui, perangkat EDC siap pakai akan langsung dikirimkan ke alamat toko.</p>
                        
                        <div class="isi-paket">
                            <strong class="d-block mb-2 text-dark">Isi Paket Starter Kit yang akan diterima:</strong>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-light text-dark border"><i class="fas fa-box text-success me-1" aria-hidden="true"></i> Unit Mesin EDC</span>
                                <span class="badge bg-light text-dark border"><i class="fas fa-plug text-success me-1" aria-hidden="true"></i> Charger</span>
                                <span class="badge bg-light text-dark border"><i class="fas fa-sim-card text-success me-1" aria-hidden="true"></i> Simcard Aktif</span>
                                <span class="badge bg-light text-dark border"><i class="fas fa-image text-success me-1" aria-hidden="true"></i> Spanduk Toko</span>
                                <span class="badge bg-light text-dark border"><i class="fas fa-scroll text-success me-1" aria-hidden="true"></i> Kertas Thermal</span>
                                <span class="badge bg-light text-dark border"><i class="fas fa-book-open text-success me-1" aria-hidden="true"></i> Panduan</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5 bg-white border-top">
        <div class="container faq-wrap">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark judul-bagian">Pertanyaan Umum (FAQ)</h2>
                <p class="text-muted">Hal yang sering ditanyakan seputar pengajuan EDC.</p>
            </div>
            
            <div class="accordion shadow-sm" id="faqAccordion">
                <div class="accordion-item border-0 border-bottom">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Apakah ada biaya pendaftaran atau biaya sewa bulanan?
                        </button>
                    </h3>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Biaya registrasi dan skema penggunaan mesin EDC akan diinformasikan secara transparan oleh tim Sales/CS kami pada saat Kakak dihubungi di Tahap 2. Tidak ada biaya tersembunyi.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 border-bottom">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Bagaimana jika saya tidak memiliki toko fisik (Usaha Rumahan)?
                        </button>
                    </h3>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Usaha rumahan tetap bisa mengajukan selama memiliki aktivitas penjualan yang jelas. Kakak cukup memfoto area usaha di rumah (seperti tumpukan barang dagangan atau spanduk kecil di depan rumah) sebagai bukti untuk lampiran foto toko.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Berapa lama proses dari isi form hingga EDC sampai di lokasi?
                        </button>
                    </h3>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Apabila seluruh dokumen (KTP, Foto Selfie, Foto KK, dll) jelas dan lolos verifikasi bank, estimasi total dari awal hingga status aktif adalah sekitar 5 hingga 7 hari kerja (tidak termasuk lama pengiriman ekspedisi ke lokasi Kakak).
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-light py-5 border-top text-center mt-auto">
        <div class="container">
            <div class="bantuan mb-4 d-inline-block p-4 rounded-4 bg-white shadow-sm border">
                <h2 class="fw-bold text-dark mb-2">Butuh Bantuan Pendaftaran?</h2>
                <p class="text-muted small mb-4">Tim dukungan SIMASRIM siap memandu Kakak langkah demi langkah.</p>
                <a href="https://wa.me/6280000000000" target="_blank" rel="noopener" class="btn btn-success fw-bold rounded-pill px-4 py-2 w-100">
                    <i class="fab fa-whatsapp me-2 fs-5 align-middle" aria-hidden="true"></i> Chat WA CS SIMASRIM
                </a>
            </div>
            <p class="text-muted small mb-0">&copy; <?= date('Y'); ?> <b>SIMASRIM</b>. PT Solusi Mitra Aplikasi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>