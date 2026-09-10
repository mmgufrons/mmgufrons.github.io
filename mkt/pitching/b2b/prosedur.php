<?php 
$page_title = "Prosedur & Alur Akuisisi B2B | SIMASRIM";
include 'header.php'; 
?>

<style>
    /* TIMELINE UI B2B ENTERPRISE */
    .timeline-container { position: relative; padding: 2rem 0; }
    .timeline-container::before { content: ''; position: absolute; left: 50%; width: 2px; height: 100%; background: #e9ecef; transform: translateX(-50%); }
    
    .timeline-item { margin-bottom: 4rem; position: relative; width: 100%; }
    .timeline-icon { position: absolute; left: 50%; transform: translateX(-50%); width: 55px; height: 55px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 2; border: 4px solid #f8f9fa; box-shadow: 0 0 20px rgba(115, 53, 183, 0.2); font-size: 1.2rem; transition: 0.3s; }
    .timeline-item:hover .timeline-icon { transform: translateX(-50%) scale(1.1); background: var(--accent); }
    
    .timeline-content { width: 45%; padding: 2.5rem; background: white; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(115, 53, 183, 0.06); transition: 0.3s; }
    .timeline-content:hover { transform: translateY(-5px); border-color: var(--primary); box-shadow: 0 20px 40px rgba(115, 53, 183, 0.1); }
    
    .timeline-item:nth-child(even) .timeline-content { margin-left: auto; }
    .timeline-item:nth-child(odd) .timeline-content { text-align: right; }

    .step-badge { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; background: var(--bg-soft-purple); color: var(--primary); padding: 6px 15px; border-radius: 50px; margin-bottom: 15px; display: inline-block; letter-spacing: 1px; }
    
    .split-box { background: #fdfcff; border: 1px solid #f1eff5; border-radius: 16px; padding: 20px; text-align: left !important; margin-top: 15px; transition: 0.2s; }
    .split-box:hover { background: white; border-color: var(--primary); box-shadow: 0 5px 15px rgba(115, 53, 183, 0.05); }
    
    .badge-api { background: #e0f2fe; color: #0284c7; font-size: 0.7rem; padding: 4px 10px; border-radius: 6px; font-weight: 800; margin-bottom: 10px; display: inline-block; border: 1px solid #bae6fd; }
    .badge-kotak { background: #fef08a; color: #a16207; font-size: 0.7rem; padding: 4px 10px; border-radius: 6px; font-weight: 800; margin-bottom: 10px; display: inline-block; border: 1px solid #fde047; }
    .badge-wl { background: #fae8ff; color: #a21caf; font-size: 0.7rem; padding: 4px 10px; border-radius: 6px; font-weight: 800; margin-bottom: 10px; display: inline-block; border: 1px solid #f5d0fe; }

    /* Custom Tombol Link Internal */
    .btn-link-internal { font-size: 0.8rem; border-radius: 8px; font-weight: 700; transition: 0.3s; text-decoration: none; display: inline-block; text-align: center; padding: 6px 14px; margin-top: 5px; margin-right: 5px; }
    .btn-link-api { border: 1px solid #0284c7; color: #0284c7; background: white; }
    .btn-link-api:hover { background: #0284c7; color: white; }
    .btn-link-wl { border: 1px solid #a16207; color: #a16207; background: white; }
    .btn-link-wl:hover { background: #a16207; color: white; }
    .btn-link-whitelabel { border: 1px solid #a21caf; color: #a21caf; background: white; }
    .btn-link-whitelabel:hover { background: #a21caf; color: white; }
    .btn-link-disabled { border: 1px solid #cbd5e1; color: #94a3b8; background: #f8f9fa; cursor: not-allowed; }

    @media (max-width: 991.98px) {
        .timeline-container::before { left: 30px; }
        .timeline-icon { left: 30px; transform: none; }
        .timeline-content { width: calc(100% - 60px); margin-left: 60px !important; text-align: left !important; }
    }
</style>

<section class="hero-section text-center" style="padding: 150px 0 80px; background: radial-gradient(circle at top right, #2c1449, #130826, #090314);">
    <div class="container position-relative z-1 mt-4">
        <span class="badge bg-white text-primary rounded-pill px-4 py-2 fw-bold mb-3 shadow-sm" data-aos="fade-down"><b>SOP INTERNAL & MITRA v.2606</b></span>
        <h1 class="display-4 fw-bold mb-3 text-white" data-aos="fade-up" data-aos-delay="100">Prosedur & Alur Kemitraan</h1>
        <p class="lead text-white-50 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200" style="font-size: 1.1rem;">Transparansi standardisasi operasional baku pembukaan akses ekosistem digital <b>SIMASRIM</b> untuk akselerasi performa bisnis mitra skala luas.</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <a href="#" target="_blank" class="btn btn-outline-primary rounded-pill px-4">
                <i class="fas fa-book me-2"></i> Dokumen Master: Alur B2B API & White Label (Lengkap)
            </a>
            <a href="#" target="_blank" class="btn btn-outline-secondary rounded-pill px-4 ms-2">
                <i class="fas fa-file-alt me-2"></i> Form Pendaftaran B2B (Umum)
            </a>
        </div>
        <div class="timeline-container">

            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon"><i class="fas fa-filter"></i></div>
                <div class="timeline-content">
                    <span class="step-badge">Fase 01</span>
                    <h4 class="fw-bold text-dark">Kualifikasi Awal (Profiling)</h4>
                    <p class="text-muted small">Proses pemetaan profil usaha guna penyelarasan tipe solusi tanpa membebani administrasi legal yang rumit di tahap awal.</p>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <div class="split-box h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <span class="badge-api">JALUR INTEGRASI API</span>
                                    <p class="small text-muted mb-3">Fokus segmen Startup, Aplikasi Kasbon/EWA (seperti Aggre Capital), Jaringan E-Commerce, dan Platform Digital. Registrasi dilakukan melalui portal resmi.</p>
                                </div>
                                <a href="https://simasrim.com/b2b/api.php" target="_blank" class="btn-link-internal btn-link-api"><i class="fas fa-external-link-alt me-1"></i> Buka Link Form API</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="split-box h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <span class="badge-kotak">BISNIS DALAM KOTAK</span>
                                    <p class="small text-muted mb-2">Fokus pemberdayaan Koperasi (Kopkar, Kopma, Kopdes), BUMDes, serta Jaringan Toko Retail Fisik.</p>
                                    <div class="p-2 rounded bg-warning bg-opacity-10 border border-warning border-opacity-25 small text-dark mb-3" style="font-size:0.75rem;">
                                        <b>Hook Utama:</b> <i>"Gratis Saldo Awal Rp 10.000 untuk Free Trial. Didampingi sampai sukses."</i>
                                    </div>
                                </div>
                                <a href="https://simasrim.com/kemitraan/form.php" target="_blank" class="btn-link-internal btn-link-wl"><i class="fas fa-external-link-alt me-1"></i> Buka Link Form Kemitraan</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="split-box h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <span class="badge-wl">WHITE LABEL</span>
                                    <p class="small text-muted mb-2">Fokus mitra yang ingin sistem SIMASRIM dijalankan atas nama/merek mereka sendiri (Full — merek & UI sepenuhnya mitra, atau Half — sebagian ber-merek mitra). Registrasi lewat form khusus White Label.</p>
                                </div>
                                <a href="https://www.simasrim.com/b2b/form-wl.php?lang=id" target="_blank" class="btn-link-internal btn-link-whitelabel"><i class="fas fa-external-link-alt me-1"></i> Buka Link Form White Label</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="timeline-content">
                    <span class="step-badge">Fase 02</span>
                    <h4 class="fw-bold text-dark">Pitching & Edukasi Solusi</h4>
                    <p class="text-muted small">Pemaparan visual demonstrasi kapabilitas sistem untuk menyamakan visi teknis maupun komersial.</p>
                    
                    <div class="split-box">
                        <span class="badge-api">SINKRONISASI TEKNIS API</span>
                        <p class="small text-muted mb-0">Pengiriman berkas <i>Product Profile</i> khusus integrasi, dilanjutkan dengan diskusi daring mengenai pemetaan <i>endpoint</i>, fungsionalitas lingkungan <i>sandbox</i>, dan arsitektur pengujian.</p>
                    </div>
                    
                    <div class="split-box mt-3">
                        <span class="badge-kotak">EDUKASI STRATEGIS BISNIS KOTAK</span>
                        <p class="small text-muted mb-2">Pengiriman lembar proposal ringkas (What, Why, How) yang berfokus pada kemudahan operasional staf internal serta diversifikasi pendapatan (Kirim Paket + Loket Pembayaran PDAM/Cicilan).</p>
                        <p class="small text-muted mb-0"><i>Opsi Tambahan: Penyelarasan Paket Layanan Fisik berupa Spanduk, Timbangan Digital, hingga penyediaan Mesin EDC TopWise T1/T3.</i></p>
                    </div>

                    <div class="split-box mt-3">
                        <span class="badge-wl">EDUKASI WHITE LABEL</span>
                        <p class="small text-muted mb-2">Demo tampilan hasil white-label (nama/merek, warna, logo mitra) — bedakan dulu skala kebutuhan mitra: <b>Full</b> (rebrand penuh: app/portal, domain, materi promosi atas nama mitra) atau <b>Half</b> (sebagian ber-merek mitra, backend & sebagian UI tetap SIMASRIM).</p>
                        <p class="small text-muted mb-0"><i>Diskusikan juga skema revenue share/komisi di tahap ini — beda dari Bisnis Dalam Kotak yang pakai margin tetap.</i></p>
                    </div>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon"><i class="fas fa-file-contract"></i></div>
                <div class="timeline-content">
                    <span class="step-badge">Fase 03</span>
                    <h4 class="fw-bold text-dark">Verifikasi, Legalitas & Perhitungan Harga</h4>
                    <p class="text-muted small">Tahap penetapan skema komersial dan pemenuhan mandatori administrasi khusus sesuai klasifikasi jalur kemitraan.</p>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="split-box border-primary">
                                <span class="badge-api">JALUR INTEGRASI API (MANDATORI LEGAL & PRICING)</span>
                                <p class="small text-muted mb-3">Wajib mengumpulkan berkas KYB (NIB, NPWP Badan, KTP PIC, Rekening Bank). Tarif logistik bersifat <b>Bebas Platform Fee (0)</b> dengan skema formula baku:</p>
                                <b class="small text-dark d-block bg-white p-2 border rounded text-center mb-3">Ongkir Publish - Diskon 25% + PPN 1,2% After Diskon</b>
                                <div class="d-inline-block bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded px-2 py-1 mb-3 small" style="font-size: 0.7rem;">
                                    <i class="fas fa-info-circle me-1"></i> <b>Catatan Setup IT:</b> Parameter level akun di sistem menggunakan kode klasifikasi <b>"TJS", dan akun hanya bisa akses melalui App Partner</b>.
                                </div>
                                
                                <div class="p-3 bg-light rounded-3 border mb-3">
                                    <small class="text-dark d-block fw-bold mb-1"><i class="fas fa-gavel me-1 text-primary"></i> Fokus Klausul Perjanjian PKS API:</small>
                                    <small class="text-muted d-block font-monospace" style="font-size:0.75rem;">• Jaminan SLA Server Uptime & Perlindungan Data (UU PDP)</small>
                                    <small class="text-muted d-block font-monospace" style="font-size:0.75rem;">• Prosedur Rekonsiliasi Transaksi Bulanan</small>
                                    <small class="text-muted d-block font-monospace text-danger" style="font-size:0.75rem;">• BEBAS DARI KLAUSUL DENDA / PENALTI INTEGRASI API</small>
                                </div>

                                <div class="d-flex flex-wrap gap-1">
                                    <a href="#" target="_blank" class="btn-link-internal btn-link-api"><i class="fas fa-external-link-alt me-1"></i> Unduh Template NDA API</a>
                                    <a href="#" class="btn-link-internal btn-link-disabled" onclick="return false;"><i class="fas fa-lock me-1"></i> Template PKS API</a>
                                    <a href="https://www.canva.com/design/DAHLsWmqFrc/I-0OSPU8NCnOmr3kvibebQ/edit" target="_blank" class="btn-link-internal btn-link-api"><i class="fas fa-external-link-alt me-1"></i> Materi Standar Presentasi</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="split-box border-warning" style="background:#fffdf6;">
                                <span class="badge-kotak">JALUR BISNIS DALAM KOTAK (INSTANT ACCESS)</span>
                                <p class="small text-muted mb-2"><b>Tanpa Beban Administrasi Rumit:</b> Jalur ini dikonfigurasi super praktis. Mitra pendaftar <b>TIDAK PERLU proses pengikatan NDA maupun Perjanjian Kerja Sama (PKS) formal</b>.</p>
                                <p class="small text-muted mb-0">Pembukaan akses gerai langsung diproses instan layaknya pendaftaran <i>user</i> standar umum. Penawaran menggunakan skema berjenjang (Bronze, Silver, Gold) atau pembagian margin tetap senilai 25% dari keuntungan harian langsung mengikat pada sistem saldo/top-up deposit.</p>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="split-box" style="border-color:#a21caf;background:#fdf7ff;">
                                <span class="badge-wl">JALUR WHITE LABEL (MANDATORI LEGAL)</span>
                                <p class="small text-muted mb-2">Wajib NDA White Label sebelum pembahasan skema rebrand & revenue share lebih detail — beda dari NDA API karena mencakup ketentuan penggunaan merek/identitas mitra.</p>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="#" target="_blank" class="btn-link-internal btn-link-whitelabel"><i class="fas fa-external-link-alt me-1"></i> Unduh Template NDA White Label</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon" style="background: #20c997; border-color: #e6f9f4;"><i class="fas fa-rocket"></i></div>
                <div class="timeline-content" style="border-color: #20c997;">
                    <span class="step-badge" style="background: #20c997; color: white;">Fase 04</span>
                    <h4 class="fw-bold text-dark">Onboarding & Aktivasi Sistem (Go-Live)</h4>
                    <p class="text-muted small">Tahap krusial penyerahan akses produksi agar sistem langsung menghasilkan transaksi aktif sejak hari pertama operasional.</p>
                    
                    <div class="split-box">
                        <span class="badge-api">ONBOARDING TEKNIS JALUR API</span>
                        <p class="small text-muted mb-0">Penyerahan kode akses <i>Production API Key</i>, pembagian berkas koleksi Postman, serta pembentukan saluran komunikasi tim penunjang (Grup WA IT Support).</p>
                    </div>

                    <div class="split-box mt-3">
                        <span class="badge-kotak">AKTIVASI JALUR BISNIS KOTAK</span>
                        <p class="small text-muted mb-0">Pembuatan akun gerai induk pada platform SIMASRIM, <b>Eksekusi Injeksi Saldo Gratis Rp 10.000</b> sebagai aktivasi uji coba, pelatihan singkat penggunaan menu transaksi, serta distribusi fisik spanduk promosi.</p>
                    </div>

                    <div class="split-box mt-3">
                        <span class="badge-wl">ONBOARDING JALUR WHITE LABEL</span>
                        <p class="small text-muted mb-0">Setup identitas mitra (logo, warna, nama merek) ke sistem — Full: domain/app custom disiapkan; Half: sebagian tampilan ber-merek mitra. Pelatihan tim mitra untuk operasional harian atas nama merek mereka sendiri.</p>
                    </div>

                    <div class="mt-3 p-3 bg-light rounded-3 text-start border">
                        <small class="text-muted d-block"><b>Output Akhir:</b> Penuntasan transaksi pertama (*First Order*) berhasil dilakukan. Manajemen operasional mitra resmi dialihkan secara penuh kepada tim <i>Account Manager</i> untuk pemeliharaan kontinuitas bisnis.</small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-5 bg-white border-top">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-5" data-aos="fade-right">
                <span class="badge bg-primary text-white rounded-pill px-3 py-2 mb-3 shadow-sm"><b>KOMITMEN JANGKA PANJANG</b></span>
                <h2 class="fw-bold mb-4">Dukungan Ekosistem Berkelanjutan</h2>
                <p class="text-muted">Implementasi sistem hanyalah langkah awal. Ekosistem SIMASRIM berkomitmen penuh memastikan seluruh infrastruktur teknologi yang diserahkan tetap berjalan stabil, aman, dan terus dikembangkan guna mendukung penuh perluasan volume bisnis mitra secara berkelanjutan.</p>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="p-4 border rounded-4 bg-light">
                            <i class="fas fa-tools text-primary fs-3 mb-3"></i>
                            <h6 class="fw-bold">Technical Maintenance</h6>
                            <p class="small text-muted mb-0">Pembaruan fitur berkala dan pemantauan performa backend sistem secara rutin.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-4 border rounded-4 bg-light">
                            <i class="fas fa-chart-line text-primary fs-3 mb-3"></i>
                            <h6 class="fw-bold">Data-Driven Growth</h6>
                            <p class="small text-muted mb-0">Analisis metrik transaksi berkala untuk rekomendasi optimalisasi profit.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-4 border rounded-4 bg-light">
                            <i class="fas fa-headset text-primary fs-3 mb-3"></i>
                            <h6 class="fw-bold">Priority AM Support</h6>
                            <p class="small text-muted mb-0">Saluran koordinasi prioritas bersama Account Manager khusus mitigasi kendala harian.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-4 border rounded-4 bg-light">
                            <i class="fas fa-shadow-virus text-primary fs-3 mb-3"></i>
                            <h6 class="fw-bold">Security Compliance</h6>
                            <p class="small text-muted mb-0">Proteksi data transaksi harian terenkripsi sesuai standar regulasi industri tinggi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>