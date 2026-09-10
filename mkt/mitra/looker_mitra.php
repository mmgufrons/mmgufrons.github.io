<?php 
$page_title = "SOP Rekon Looker Mitra | SIMASRIM Data";
$footer_desc = "Dokumen Internal Terbatas - Divisi Data & IT.";
$base_path = '../';
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/firebase.php';

// Setup Data Dinamis Firebase
// 1. Spreadsheet Area
$fallback_spreadsheets = [
    "3252 - PLM (Pak Ayyub - Mas Fir)" => "#",
    "3259 - SUB (Pak Eko - Mas Krisna)" => "#",
    "3260 - BKS (Pak Andi)" => "#",
    "3277 - MES-1 (Bu Erly)" => "#",
    "3285 - MES-2 (Bu Darneli by Bu Erly)" => "#",
    "3286 - MES-3 (Pak Yusuf)" => "#",
    "3288 - MXG-1 (Pak Febi)" => "#",
    "3298 - MES-4 (Pak Khoir)" => "#"
];
$spreadsheets = firebase_get('/mitra_spreadsheets');
if (!$spreadsheets) {
    $spreadsheets = $fallback_spreadsheets;
    firebase_put('/mitra_spreadsheets', $spreadsheets);
}

// 2. Looker Studio Area
$fallback_lookers = [
    "3252 - PLM (Pak Ayyub - Mas Fir)" => "#",
    "3259 - SUB (Pak Eko - Mas Krisna)" => "#",
    "3260 - BKS (Pak Andi)" => "#",
    "3277 - MES-1 (Bu Erly)" => "#",
    "3285 - MES-2 (Bu Darneli by Bu Erly)" => "#",
    "3286 - MES-3 (Pak Yusuf)" => "#",
    "3288 - MXG-1 (Pak Febi)" => "#",
    "3298 - MES-4 (Pak Khoir)" => "#"
];
$lookers = firebase_get('/mitra_lookers');
if (!$lookers) {
    $lookers = $fallback_lookers;
    firebase_put('/mitra_lookers', $lookers);
}
?>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25"><i class="fa-solid fa-chart-pie me-2"></i>Kemitraan & Keuangan</span>
        <h2 class="display-5 fw-bold mb-2">SOP Rekon & Dashboard Mitra Area</h2>
        <p class="text-white-50 mb-0">Dokumen ini berisi panduan standar operasional untuk memproses data akuisisi user, validasi milestone, hingga pembayaran komisi Pihak Kedua (Mitra Area) melalui sistem Database Terpusat dan Looker Studio.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">
        
        <div class="alert alert-primary border-0 bg-opacity-10 shadow-sm rounded-4 mb-4 d-flex align-items-center" data-aos="fade-down">
            <i class="fas fa-user-circle fs-3 text-primary me-3"></i>
            <div>
                <h6 class="fw-bold text-primary mb-1">Akses Akun Terpusat</h6>
                <span class="small text-dark">Seluruh akses ke XLSX (Master Pusat & Area) serta Looker Studio dapat menggunakan email: <code>marketing.demo@contoh-perusahaan.demo</code></span>
            </div>
        </div>
        <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <span class="badge bg-warning text-dark mb-2"><i class="fas fa-database me-1"></i> Jadwal: Jumat Pagi</span>
                <h4 class="fw-bold text-dark mb-1">FASE 1: Update Centralized Database</h4>
                <p class="text-muted small">Fase ini adalah pintu utama data. Operator <b>HANYA</b> perlu melakukan input di Spreadsheet Master Pusat, data akan otomatis terdistribusi ke seluruh Mitra Area.</p>
            </div>
            <div class="card-body p-4">
                <ol class="text-dark mb-0 fs-6" style="line-height: 1.8;">
                    <li class="mb-3">
                        <strong>Request Data ke IT:</strong> Lakukan permintaan penarikan data ke tim IT sesuai <a href="#" target="_blank"><b>Format Standar</b></a>. 
                        <ul class="mt-1 mb-2">
                            <li><strong>Rentang Waktu:</strong> Infokan tanggal tarikan mulai dari <b>hari setelah data terakhir ditarik s/d kemarin jam 23.59</b>.</li>
                            <li><strong>Mitra Baru (Jika Ada):</strong> Wajib infokan <i>Agen ID</i> Mitra tersebut ke IT agar masuk dalam daftar tarikan. Agen ID dapat dicek pada menu "Daftar Mitra Area" di <a href="https://mitra.smsrm.com/tracker.php" target="_blank">Tracker Mitra</a>. (Abaikan jika tidak ada mitra baru).</li>
                        </ul>
                    </li>

                    <li class="mb-3"><strong>Terima Data IT:</strong> Pastikan 3 (tiga) file export gabungan (All Area) dari tim IT telah diterima, yaitu: <code>USER</code>, <code>TOPUP</code>, dan <code>TRANSAKSI</code>.
                        <div class="alert alert-info mt-2 py-2 px-3 small">
                            <i class="fas fa-info-circle me-1"></i> <strong>Cut-off & Jadwal:</strong> Secara baku menggunakan periode 2 pekan (dari hari Jumat dua pekan lalu hingga Kamis kemarin). Namun jika terlewat, gunakan kelonggaran rentang waktu seperti poin di atas. Pemantauan cukup dilakukan berkala (per dua pekan).
                        </div>
                    </li>
                    
                    <li class="mb-3"><strong>Buka Database Pusat:</strong> Buka Spreadsheet utama <a href="#"><b>[DATABASE] SIMASRIM All Area</b></a>.</li>
                    
                    <li class="mb-3"><strong>Input User Baru:</strong> Buka tab <code>ALL_USER</code>, lalu <b>copy-paste</b> ID, AGEN ID, dan Tgl Daftar baru dari file IT ke baris terbawah.</li>
                    
                    <li class="mb-3">
                        <strong>Append Transaksi (Wajib):</strong> Buka tab <code>ALL_TOPUP</code> dan <code>ALL_TRANSAKSI</code>. <br>
                        <span class="text-danger fw-bold"><i class="fas fa-exclamation-triangle"></i> JANGAN DITIMPA/DIHAPUS!</span> Tempelkan data transaksi baru di <b>baris paling bawah</b> (Kolom A s/d E) dari data periode sebelumnya. <i>(Catatan: Rumus jembatan VLOOKUP di Kolom F akan otomatis memetakan AGEN ID, kolom ini tidak perlu diapa-apakan dan <b>JANGAN</b> diisi manual).</i>
                    </li>
                </ol>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <span class="badge bg-primary mb-2"><i class="fas fa-user-check me-1"></i> Jadwal: Jumat Siang</span>
                <h4 class="fw-bold text-dark mb-1">FASE 2: Verifikasi KYC Manual (Per Area)</h4>
                <p class="text-muted small">Fase ini dijalankan oleh tim CS/Origin untuk memverifikasi keabsahan dokumen pengguna baru di masing-masing area.</p>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-info border-0 bg-opacity-10 mb-4 rounded-3">
                    <i class="fas fa-sync fa-spin me-2"></i><b>Info Sistem:</b> Data transaksi dan pendaftaran akan ditarik secara otomatis dari Master Pusat menggunakan sistem <code>IMPORTRANGE</code>.
                </div>
                <ol class="text-dark mb-0 fs-6" style="line-height: 1.8;">
                    <li class="mb-3">
                        <strong>Buka Spreadsheet Area:</strong> Akses Spreadsheet area terkait melalui daftar tautan cepat di bawah ini:
                        <div class="row g-2 mt-2 mb-2">
                            <?php foreach ($spreadsheets as $name => $url): ?>
                            <div class="col-md-6"><a href="<?= htmlspecialchars($url) ?>" target="_blank" class="btn btn-outline-success w-100 text-start text-truncate btn-sm"><i class="fas fa-file-excel me-2"></i><?= htmlspecialchars($name) ?></a></div>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    
                    <li class="mb-3"><strong>Tunggu Loading:</strong> Pastikan indikator <i>loading</i> (garis hijau) di pojok kanan atas telah selesai, menandakan penarikan data dari Master Pusat sudah 100%.</li>

                    <li class="mb-3"><strong>Buka Tab Rekap:</strong> Buka tab <code>REKON_MILESTONE</code>.</li>
                    
                    <li class="mb-3"><strong>Filter Status Kosong:</strong> Fokus hanya pada baris di kolom <code>STATUS KYC</code> yang masih kosong (user baru). User lama yang sudah berstatus <b>VERIFIED</b> tidak perlu disentuh.</li>
                    
                    <li class="mb-3"><strong>Validasi Dokumen:</strong> Cek kelengkapan identitas di sistem admin utama. Jika valid, klik kolom <code>STATUS KYC</code> dan pilih opsi dropdown <b>VERIFIED</b>.</li>
                </ol>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <span class="badge bg-success mb-2"><i class="fas fa-money-bill-wave me-1"></i> Jadwal: Senin Pagi</span>
                <h4 class="fw-bold text-dark mb-1">FASE 3: Rekonsiliasi & Pembayaran</h4>
                <p class="text-muted small">Fase final untuk memvalidasi angka yang akan dibayarkan kepada Pemilik Jaringan Mitra Area.</p>
            </div>
            <div class="card-body p-4">
                <ol class="text-dark mb-0 fs-6" style="line-height: 1.8;">
                    <li class="mb-3">
                        <strong>Buka Dashboard:</strong> Buka tautan Dashboard Looker Studio khusus area terkait di bawah ini. Pastikan status sinkronisasi data sudah terbaru:
                        <div class="row g-2 mt-2 mb-2">
                            <?php foreach ($lookers as $name => $url): ?>
                            <div class="col-md-6"><a href="<?= htmlspecialchars($url) ?>" target="_blank" class="btn btn-outline-info w-100 text-start text-truncate btn-sm text-dark"><i class="fas fa-chart-bar me-2"></i><?= htmlspecialchars($name) ?></a></div>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    
                    <li class="mb-3">
                        <strong>Set Filter Periode:</strong> Ubah rentang tanggal (Date Range Control) menjadi periode transaksi yang ditagihkan. <br>
                        <i>Pilih tanggal secara manual sesuai dengan <b>periode 2 pekan terakhir</b> (dari hari setelah pencairan sebelumnya, sampai hari terbaru data ditarik).</i>
                    </li>

                    <li class="mb-3"><strong>Audit & Anti-Fraud:</strong> Lakukan pengecekan pada tabel "Top 10 User Terbaru Lolos". Pastikan nama dan polanya natural (bukan pendaftaran fiktif massal). Jika aman, catat total tagihan di Scorecard <b>TOTAL DANA CAIR</b>.</li>

                    <li class="mb-3"><strong>Eksekusi Payout:</strong> Lakukan proses pencairan saldo sebesar nominal yang tertera ke Dompet Aplikasi milik Pemilik Jaringan/Mitra Area. Pencairan ini dilakukan melalui <b>Inject Saldo</b> menggunakan akun <i>SIMASRIM Campaign (Daftar)</i>, selayaknya prosedur yang dilakukan saat memberikan saldo Campaign.<br><span class="text-danger fw-bold">Wajib: Setelah proses transfer selesai, catat "TGL TRANSFER" pada file XLSX Data Transaksi Mitra Area di kolom yang bersangkutan.</span></li>

                    <li class="mb-3"><strong>Arsip Dokumen:</strong> Unduh halaman Dashboard tersebut dalam format <b>PDF</b> dan simpan di folder arsip Finance sebagai bukti potong bayar periode yang bersangkutan.</li>
                </ol>
            </div>
        </div>

        <div class="alert alert-danger bg-opacity-10 border-danger border-opacity-25 rounded-4 p-4 mt-5" role="alert" data-aos="zoom-in">
            <h5 class="fw-bold text-danger mb-3"><i class="fas fa-shield-alt me-2"></i>Kebijakan Keamanan Data (Sangat Penting)</h5>
            <ul class="mb-0 text-dark">
                <li class="mb-2"><strong>Sistem Terisolasi:</strong> Mitra Area (Pihak Kedua) <b>DILARANG KERAS</b> diberikan akses ke Spreadsheet Pusat maupun Spreadsheet Area. Pihak Kedua hanya diizinkan mengakses Looker Studio dengan hak akses sebagai <b>Viewer</b>.</li>
                <li><strong>No Format Changes:</strong> Dilarang mengubah format kolom atau rumus <code>IMPORTRANGE</code> di Spreadsheet tanpa konfirmasi kepada tim Data karena akan merusak arus distribusi data dan koneksi Looker Studio.</li>
            </ul>
        </div>

    </div>
</section>

<script>
    function copyText(btnElement, textToCopy) {
        var tempTextArea = document.createElement("textarea");
        tempTextArea.value = textToCopy;
        document.body.appendChild(tempTextArea);
        tempTextArea.select();
        document.execCommand("copy");
        document.body.removeChild(tempTextArea);
        
        var originalText = btnElement.innerHTML;
        btnElement.innerHTML = '<i class="fas fa-check"></i> Disalin!';
        btnElement.classList.add('btn-success');
        btnElement.classList.remove('btn-light');
        
        setTimeout(function() {
            btnElement.innerHTML = originalText;
            btnElement.classList.remove('btn-success');
            btnElement.classList.add('btn-light');
        }, 2000);
    }
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>