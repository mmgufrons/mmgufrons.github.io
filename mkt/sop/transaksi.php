<?php 
$page_title = "SOP Update Laporan Bulanan | SIMASRIM Data";
$footer_desc = "Dokumen Internal Terbatas - Divisi Data & IT.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25"><i class="fa-solid fa-database me-2"></i>Data & Analytics</span>
        <h2 class="display-5 fw-bold mb-2">SOP Alur Update Laporan Bulanan</h2>
        <p class="text-white-50 mb-0">Cukup upload file dari IT ke Dashboard Data Transaksi, sistem otomatis mengolah & menampilkan datanya.<br>Ikuti langkah-langkah singkat di bawah ini.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">
        
        <!-- FASE 1: UPLOAD DATA -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <span class="badge bg-primary mb-2"><i class="fas fa-file-import me-1"></i> Tools Transaksi Otomatis</span>
                <h4 class="fw-bold text-dark mb-1">FASE 1: Upload File dari IT</h4>
                <p class="text-muted small">Tidak perlu lagi paste manual ke Google Sheets atau susun ulang kolom — tools baca kolom langsung berdasarkan nama header.</p>
            </div>
            <div class="card-body p-4">
                <ol class="text-dark mb-3 fs-6" style="line-height: 1.8;">
                    <li class="mb-3">Buka <a href="<?= $base_path ?>data/transaksi/index.php" target="_blank">Tools Transaksi Otomatis</a>.</li>
                    <li class="mb-3"><strong>Upload semua file mentah dari IT sekaligus</strong> (Wajib, rutin tiap bulan) — persis file mentah folder "SALES [Bulan]" yang biasa didapat dari IT, semua ekspedisi & <b>COD/Non-COD boleh dicampur</b> dalam 1 kali pilih, tidak perlu diedit dulu. Tools baca kolom otomatis by nama.</li>
                    <li class="mb-3"><strong>(Opsional) Upload Data Agen/User Baru</strong> — kalau bulan ini ada agen baru gabung, upload file dari tim IT (format USER ID, NAMA, TGL GABUNG, ORIGIN, PHONE, EMAIL, ROLE, AGEN ID). Ini cuma melengkapi data agen, bukan data resi.</li>
                    <li class="mb-3"><strong>(Opsional, jarang) Upload File Master Transaksi Siap Pakai</strong> — hanya kalau kebetulan sudah tersedia data resi+ID USER+KOMISI lengkap dari proses lain. Bukan langkah wajib bulanan.</li>
                    <li class="mb-3">Klik <strong>Proses & Simpan</strong>. Tools otomatis menggabungkan semua file, mencocokkan ke data resi yang sudah ada (by AWB), menghitung <b>Komisi Agen otomatis untuk transaksi COD</b> (= Tagihan User − Ongkir), lalu menghitung ulang status pengiriman, status pencairan COD, kelompok layanan, dan kota tujuan — persis logika yang dulu dijalankan manual di Google Colab.</li>
                </ol>
                <div class="alert alert-warning small mb-2"><i class="fas fa-triangle-exclamation me-1"></i> Resi dengan AWB benar-benar baru tetap tersimpan (status/kurir/ongkir kebaca dari file mentah), tapi <code>ID USER</code>/<code>NAMA USER</code> kosong sampai dilengkapi manual (jarang terjadi karena biasanya AWB sudah dikenal dari bulan sebelumnya). Komisi Agen untuk transaksi <b>Non-COD</b> juga tetap manual — file mentahnya tidak punya kolom pembanding untuk dihitung otomatis.</div>
                <div class="alert alert-info small mb-0"><i class="fas fa-circle-info me-1"></i> Data bulan yang sudah pernah diproses aman di-upload ulang (update by AWB, tidak dobel), tapi tidak akan mengubah angka dashboard karena datanya sudah sama.</div>
            </div>
        </div>

        <!-- FASE 2: DASHBOARD -->
        <div class="card border-0 shadow-sm rounded-4 mb-4" style="border-left: 5px solid #17a2b8 !important;">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <span class="badge bg-info text-dark mb-2"><i class="fas fa-chart-line me-1"></i> Dashboard Internal</span>
                <h4 class="fw-bold text-dark mb-1">FASE 2: Cek Dashboard</h4>
                <p class="text-muted small mb-0">Dashboard ter-update otomatis begitu proses upload selesai — tidak perlu upload manual ke tempat lain.</p>
            </div>
            <div class="card-body p-4">
                <ol class="text-dark mb-0 fs-6" style="line-height: 1.8;">
                    <li class="mb-2">Buka <a href="<?= $base_path ?>data/transaksi/dashboard.php" target="_blank">Dashboard Transaksi</a> untuk lihat ringkasan omset, komisi, status COD, trend harian, breakdown per ekspedisi & kota tujuan.</li>
                    <li class="mb-2">Pakai fitur <strong>Cari 1 Resi (by AWB)</strong> di dashboard untuk cek detail 1 transaksi tertentu.</li>
                    <li>Selesai — laporan bulanan siap dibagikan ke tim management.</li>
                </ol>
            </div>
        </div>

        <!-- End of SOP Steps -->

    </div>
</section>

<a href="https://wa.me/?text=Halo%20Tim%20Management%2C%20Lapor%21%20Data%20Dashboard%20SIMASRIM%20untuk%20bulan%20ini%20sudah%20berhasil%20di-update%20dan%20siap%20dianalisis.%20%F0%9F%93%8A%E2%9C%85" target="_blank" class="fab-report" title="Lapor Update Selesai">
    <i class="fab fa-whatsapp fs-4" style="color: var(--wa-green);"></i> <span class="d-none d-md-inline">Lapor Update Selesai</span>
</a>

<?php include __DIR__ . '/../includes/footer.php'; ?>