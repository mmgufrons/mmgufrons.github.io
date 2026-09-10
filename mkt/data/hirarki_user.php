<?php 
$page_title = "Hierarki User | SIMASRIM Operations";
$footer_desc = "Dokumen Internal Terbatas - Divisi Data & Management.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>


<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--primary-dark);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm"><i class="fas fa-sitemap me-2"></i>Data Master</span>
        <h2 class="display-5 fw-bold mb-2">Hierarki & Kategori User</h2>
        <p class="text-white-50 mb-0">Pemetaan level pengguna SIMASRIM, hak akses, dan batas margin diskon operasional.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">

        <div class="alert bg-white border shadow-sm rounded-4 p-4 mb-5" style="border-left: 5px solid var(--accent) !important;">
            <h6 class="fw-bold text-dark mb-3"><i class="fas fa-exclamation-circle text-warning me-2"></i>Aturan Global Sistem User:</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100 border">
                        <i class="fas fa-mobile-alt text-primary mb-2 fs-5"></i> <i class="fas fa-laptop text-primary mb-2 fs-5 ms-2"></i>
                        <p class="small text-dark mb-0"><strong>Hak Akses Platform:</strong> Semua kategori user dapat diatur aksesnya secara kustom oleh pusat (Hanya Aplikasi APK, Hanya Web, atau Keduanya).</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100 border">
                        <i class="fas fa-code-branch text-danger mb-2 fs-5"></i>
                        <p class="small text-dark mb-0"><strong>Kustomisasi B2B:</strong> Khusus untuk user B2B (API/White Label), setiap permintaan penambahan atau revisi fitur berbayar dikenakan <b>Charge Development</b>.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tree-container">
            
            <div class="node-card" style="border-left: 4px solid #6c757d;">
                <div class="node-title">
                    <i class="fas fa-crown text-secondary"></i> Agen / TMS
                    <span class="badge badge-disc">Diskon &lt; 30%</span>
                    <span class="badge badge-closed"><i class="fas fa-lock me-1"></i> Pendaftaran Ditutup</span>
                </div>
                <p class="text-muted small mb-0 mt-2">User perintis (agen-agen pengiriman awal yang bergabung dengan SIMASRIM). Pendaftaran reguler ditutup, namun bisa dibuka kembali melalui jalur ketentuan khusus manajemen.</p>
            </div>

            <div class="node-card" style="border-left: 4px solid var(--primary);">
                <div class="node-title">
                    <i class="fas fa-store text-primary"></i> Seller
                </div>
                <p class="text-muted small mb-0 mt-1">Kategori utama pengguna reguler dan mitra bisnis saat ini.</p>
            </div>

            <div class="children-container">
                <div class="node-connector"></div>

                <div class="node-card">
                    <div class="node-title">
                        Seller di bawah Agen
                        <span class="badge badge-disc">Diskon &lt; 30%</span>
                        <span class="badge badge-closed"><i class="fas fa-lock me-1"></i> Ditutup</span>
                    </div>
                    <p class="text-muted small mb-0 mt-1">Mengikuti ketentuan dan hak akses yang sama dengan Agen Induknya.</p>
                </div>

                <div class="node-connector" style="top: 7.5rem;"></div>

                <div class="node-card" style="border-left: 3px solid var(--accent);">
                    <div class="node-title">
                        <i class="fas fa-network-wired text-accent"></i> Tebar Jaringan SIMASRIM (TJS)
                        <span class="badge badge-disc text-dark border-dark" style="background: #f8f9fa;">Diskon &lt; 25%</span>
                    </div>
                    <p class="text-muted small mb-0 mt-1">Grup jaringan mitra dengan spesifikasi bisnis lebih bervariasi.</p>
                </div>

                <div class="children-container">
                    
                    <div class="node-connector" style="top: 2rem;"></div>
                    <div class="node-card" style="border-left: 3px solid var(--ai-blue);">
                        <div class="node-title">
                            <i class="fas fa-building text-primary"></i> B2B (Business to Business)
                            <span class="badge badge-b2b">Wajib PKS</span>
                            <span class="badge bg-danger">Non-COD Only</span>
                        </div>
                        <p class="text-muted small mb-0 mt-1">Segmen korporasi/sistem terintegrasi. Penambahan fitur bersifat <b>berbayar</b>.</p>
                    </div>

                    <div class="children-container">
                        
                        <div class="node-connector" style="top: 2rem;"></div>
                        <div class="node-card">
                            <div class="node-title">
                                <i class="fas fa-code text-dark"></i> API Integration
                                <span class="badge bg-light text-dark border">Tanpa Biaya Layanan</span>
                                <span class="badge bg-light text-dark border">1 User</span>
                            </div>
                            <div class="mt-3 ps-3 border-start border-2 border-primary">
                                <div class="mb-2">
                                    <strong class="small text-dark d-block">1. Kiosbank</strong>
                                    <span class="text-muted small">Fokus pada sistem Top Up Saldo.</span>
                                </div>
                                <div>
                                    <strong class="small text-dark d-block">2. Aksara</strong>
                                    <span class="text-muted small">Sistem Invoice + Diskon 27% + Memiliki Dashboard Khusus.</span>
                                </div>
                            </div>
                        </div>

                        <div class="node-connector" style="top: 11.5rem;"></div>
                        <div class="node-card">
                            <div class="node-title">
                                <i class="fas fa-copy text-dark"></i> White Label
                                <span class="badge bg-light text-dark border">Multi User</span>
                            </div>
                            <div class="mt-3 d-flex flex-wrap gap-2">
                                <span class="badge bg-light border text-dark py-2 px-3"><i class="fas fa-mobile-alt text-primary me-2"></i>Bumdes (APK + Web)</span>
                                <span class="badge bg-light border text-dark py-2 px-3"><i class="fas fa-mobile-alt text-primary me-2"></i>UTM (APK + Web)</span>
                                <span class="badge bg-light border text-dark py-2 px-3"><i class="fas fa-mobile-alt text-primary me-2"></i>Kiocell (APK + Web)</span>
                            </div>
                        </div>

                    </div> <div class="node-connector" style="top: 31rem;"></div>
                    <div class="node-card mt-4" style="border-left: 3px solid var(--success);">
                        <div class="node-title">
                            <i class="fas fa-store-alt text-success"></i> Retail
                            <span class="badge badge-disc border-success text-success bg-white">Diskon &lt; 25% + (Ekstra 2%)</span>
                        </div>
                        <p class="text-muted small mb-0 mt-1">Jika User Retail mengatur/memberikan diskon <b>maksimal (25%)</b> kepada jaringannya, maka ia akan tetap mendapatkan <b>tambahan margin 2%</b>. Jika tidak di-set maksimal, margin tambahan 2% ini <b>tidak akan didapatkan</b>.</p>
                    </div>

                    <div class="children-container pb-2">
                        <div class="node-connector" style="top: 2rem;"></div>
                        <div class="node-card">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fas fa-user text-muted"></i> <strong class="small text-dark">Direct User</strong>
                            </div>
                            <p class="text-muted small mb-0">Pengguna reguler yang mendaftar secara langsung tanpa melalui jaringan.</p>
                        </div>

                        <div class="node-connector" style="top: 7rem;"></div>
                        <div class="node-card">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fas fa-map-marker-alt text-danger"></i> <strong class="small text-dark">Mitra Area</strong>
                                <span class="badge bg-warning text-dark border border-warning">Sistem Penunjukan</span>
                            </div>
                            <p class="text-muted small mb-0">Mitra perwakilan daerah yang ditunjuk oleh pusat. <b>Tidak bisa</b> membuat jaringan/referral di bawahnya.</p>
                        </div>
                    </div> </div> </div> </div>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>