<?php 
$page_title = "SOP Aktivasi QRIS SoundBox | SIMASRIM Operations";
$footer_desc = "Dokumen Internal Terbatas - Divisi Admin Operasional & Tech Support.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>

<style>
    /* UI/UX Link Clickable Upgrade */
    .inline-link-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f3effa;
        color: #7335B7 !important;
        border: 1px solid rgba(115, 53, 183, 0.2);
        padding: 3px 10px;
        border-radius: 6px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 2px 4px rgba(115, 53, 183, 0.04);
    }
    .inline-link-btn:hover {
        background: #7335B7;
        color: #ffffff !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(115, 53, 183, 0.2);
        border-color: #7335B7;
    }
    
    .inline-link-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .inline-link-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(0,0,0,0.15);
        filter: brightness(1.1);
    }

    /* Base Styling */
    .sop-section-title { font-size: 1.15rem; font-weight: 700; color: var(--primary); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 10px; }
    .sop-meta-box { background: #fffdf5; border-left: 4px solid #ffc107; border-radius: 0 12px 12px 0; padding: 1rem; margin-bottom: 2rem; border: 1px solid rgba(0,0,0,0.05); border-left-width: 4px; }
    .flow-badge { width: 30px; height: 30px; border-radius: 50%; background: var(--primary); color: white; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; }
    .critical-indicator { background: #fff5f5; border: 1px dashed #e3342f; color: #cc1f1a; border-radius: 8px; padding: 10px 15px; font-size: 0.85rem; }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm"><i class="fas fa-headset me-2"></i>SOP Admin Internal</span>
        <h2 class="display-5 fw-bold mb-2">Alur Proses Aktivasi QRIS SoundBox</h2>
        <p class="text-white-50 mb-0">Standard Operating Procedure penanganan registrasi merchant, validasi data, hingga penyiapan hardware.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">

        <div class="sop-meta-box">
            <h6 class="fw-bold text-dark mb-2"><i class="fas fa-shield-alt text-warning me-2"></i>Pemicu Alur Kerja (Prerequisite):</h6>
            <p class="small text-muted mb-0">
                Alur ini wajib dieksekusi <strong>setelah Merchant melakukan pengisian data lengkap di 
                <a href="https://sqris.id/form/" target="_blank" class="inline-link-btn">
                    Form Registrasi <i class="fas fa-external-link-alt" style="font-size: 0.75rem;"></i>
                </a> 
                resmi serta melakukan transfer dana</strong> ke Rekening BCA <code>0954475898</code> a.n. <strong>SOLUSI MITRA APLIKASI</strong> dan status pembayaran telah diverifikasi oleh tim Finance.
            </p>
        </div>

        <div class="step-card">
            <div class="sop-section-title">
                <span class="flow-badge">A</span> Tahap Verifikasi & Pendaftaran (SMA ke Duwit)
            </div>
            
            <p class="small text-muted mb-3">Langkah awal pengecekan kelayakan berkas fisik data merchant pada sistem utama:</p>
            
            <div class="bg-light border rounded-3 p-3 mb-3">
                <ol class="small text-dark mb-0 ps-3">
                    <li class="mb-3">
                        <strong>Cek Antrean Masuk:</strong> Tarik data berkas merchant yang masuk melalui spreadsheet database eksternal di:
                        <div class="mt-2">
                            <a href="#" target="_blank" class="inline-link-btn">
                                <i class="fas fa-file-excel text-success"></i> Data Form Pendaftaran Sheet <i class="fas fa-external-link-alt" style="font-size: 0.75rem;"></i>
                            </a>
                        </div>
                    </li>
                    <li class="mb-3">
                        <strong>Input ke Form Duwit:</strong> Isikan seluruh data berkas ke dalam form pendaftaran mitra Duwit sesuai klasifikasi pilihan tipe di bawah ini:
                        <div class="mt-2 d-flex flex-wrap gap-2">
                            <a href="https://dash-stg.duwit.id/webapp?token=DUMMY-TOKEN-GANTI-SENDIRI" target="_blank" class="inline-link-badge bg-primary text-white">
                                <i class="fas fa-qrcode"></i> Form Pendaftaran Statis <i class="fas fa-external-link-alt" style="font-size: 0.75rem;"></i>
                            </a>
                            <a href="https://dash-stg.duwit.id/webapp?token=DUMMY-TOKEN-GANTI-SENDIRI" target="_blank" class="inline-link-badge bg-info text-dark">
                                <i class="fas fa-bolt"></i> Form Pendaftaran Dinamis <i class="fas fa-external-link-alt" style="font-size: 0.75rem;"></i>
                            </a>
                        </div>
                    </li>
                    <li><strong>Konfirmasi Log:</strong> Laporkan berkas secara berkala melalui grup koordinasi internal Duwit untuk percepatan antrean.</li>
                </ol>
            </div>

            <div class="critical-indicator mb-3">
                <strong class="d-block mb-1"><i class="fas fa-exclamation-triangle me-1"></i> (Tentatif) Validasi Kunci Kelayakan Berkas:</strong>
                <ul class="mb-0 ps-3 small">
                    <li><strong>Rekening:</strong> Wajib divalidasi manual dan <strong>HARUS SESUAI</strong> dengan identitas pemilik/penanggung jawab.</li>
                    <li><strong>Nama Merchant:</strong> Tidak boleh murni menggunakan nama orang pribadi. Wajib menyertakan identitas fisik usaha penjualan (Contoh: <i>Warung Berkah, Kiocell, Toko Utama, dsb</i>).</li>
                    <li><strong>NIK:</strong> Wajib dipastikan sesuai dengan foto KTP asli, hilangkan seluruh typo penulisan angka.</li>
                    <li><strong>Kode Pos:</strong> Pastikan terisi valid; jika terindikasi salah/tidak terindeks, tim Duwit akan melakukan penyesuaian otomatis.</li>
                </ul>
            </div>

            <div class="bg-light border rounded-3 p-3">
                <strong class="small text-dark d-block mb-1"><i class="fas fa-clock me-1 text-primary"></i> SLA & Manajemen Waktu Kritis PTEN:</strong>
                <p class="small text-muted mb-2">
                    Pantau berkala perubahan status pengajuan di menu <strong>Merchant Request</strong> pada panel utama:
                    <a href="https://dash-stg.duwit.id/" target="_blank" class="inline-link-btn mx-1">
                        <i class="fas fa-desktop"></i> Portal Dashboard Duwit <i class="fas fa-external-link-alt" style="font-size: 0.75rem;"></i>
                    </a>. 
                    Jika seluruh data dinyatakan valid, status otomatis berubah menjadi <code>"KYC_FINISHED"</code>.
                </p>
                <div class="p-2 bg-white rounded border border-danger border-opacity-25 small text-danger">
                    ⚠️ <strong>Batas Waktu Bulky:</strong> Verifikasi data ke PTEN dilakukan secara masif tiap <strong>jam 3 sore</strong>. Mengingat PTEN <b>tutup jam 5 sore</b>, tim wajib memastikan data terkirim sebelum batas waktu agar mendapat respon di hari yang sama. Status akhir yang sukses ditandai dengan perubahan status menjadi <code>"Pre Approve"</code> (Merchant siap bertransaksi).
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #fd7e14;">
            <div class="sop-section-title text-warning" style="color: #fd7e14 !important;">
                <span class="flow-badge bg-warning">B</span> Tahap Aktivasi Perangkat SoundBox (Terminal ID)
            </div>
            
            <p class="small text-muted mb-3">Langkah sinkronisasi antara merchant data dan ID fisik perangkat keras (hardware):</p>
            
            <div class="bg-light border rounded-3 p-3 mb-3">
                <div class="mb-2 pb-2 border-bottom">
                    <strong class="small text-dark d-block">1. Registrasi Serial Perangkat:</strong>
                    <span class="small text-muted">Masuk ke menu utama <strong>Terminals</strong> > Sub Menu <strong>Terminal Paid</strong>. Cari data merchant yang berstatus <code>"Pre Approve"</code>, lalu klik tombol <strong>Aksi</strong>.</span>
                </div>
                <div class="mb-2 pb-2 border-bottom">
                    <strong class="small text-dark d-block">2. Input ID Fisik:</strong>
                    <span class="small text-muted">Masukkan <strong>Nomor Terminal ID</strong> perangkat fisik yang akan dikirim (cek label barcode yang tertempel di Box perangkat).</span>
                </div>
                <div>
                    <strong class="small text-dark d-block">3. Pengalihan Antrean Antarmuka:</strong>
                    <span class="small text-muted">Klik tombol <strong>Ubah Status</strong>, alihkan antrean data menuju status <code>"Menunggu QC"</code>.</span>
                </div>
            </div>

            <div class="p-3 border rounded-3 bg-white mb-3 shadow-sm">
                <strong class="small text-dark d-block mb-2"><i class="fas fa-check-double text-success me-1"></i> Protokol Uji Kelayakan Perangkat (Quality Check):</strong>
                <ol class="small text-muted mb-0 ps-3">
                    <li class="mb-1">Masuk menu <strong>Terminal QC</strong> > klik tombol <strong>Aksi</strong> pada data antrean merchant.</li>
                    <li class="mb-1">Jalankan pengujian menggunakan <strong>Check Device QC Tools</strong> untuk memverifikasi fungsionalitas Modul Koneksi, Kualitas Output Suara (Speaker), dan <strong>Cetak Fisik Banner QRIS (Khusus untuk varian Soundbox Statis)</strong>.</li>
                    <li class="mb-1">Jika lulus uji QC, masukkan nomor resi ekspedisi pengiriman fisik dan ubah status antrean menjadi <code>"Pengiriman"</code>.</li>
                    <li>Klik opsi tombol <code>"Force Active"</code> (Aktifkan Paksa) untuk menyalakan otorisasi sistem terminal. Perangkat otomatis masuk ke list <strong>Terminal Collection / List</strong> dan siap dikirim kurir.</li>
                </ol>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #20c997;">
            <div class="sop-section-title text-success" style="color: #20c997 !important;">
                <span class="flow-badge bg-success">C</span> Tahap Pemantauan & Rekonsiliasi Finansial
            </div>
            
            <p class="small text-muted mb-3">Rutinitas pasca-aktivasi untuk mitigasi risiko kegagalan sistem:</p>
            
            <div class="bg-light border rounded-3 p-3">
                <strong class="small text-dark d-block mb-1"><i class="fas fa-search-dollar me-1 text-success"></i> Pengawasan Keterlambatan Settlement Harian:</strong>
                <p class="small text-muted mb-2">Buka menu monitoring <strong>Finance</strong> > pilih sub menu <strong>Terminal Rent</strong>. Perhatikan parameter variabel kolom <code>"Days"</code> yang mengindikasikan jumlah hari kegagalan sistem dalam melakukan pencairan dana (settlement).</p>
                <div class="p-2 bg-white rounded border border-warning small text-dark">
                    📌 <strong>Batasan Toleransi Batas Atas:</strong> Jika nilai indikator <code>Days</code> telah mencapai <b>Maksimal 7 hari</b>, Admin wajib segera mengeluarkan nota laporan eskalasi dan menghubungi tim Sales/CS terkait untuk melakukan panggilan konfirmasi serta pengecekan langsung ke lokasi merchant bersangkutan.
                </div>
            </div>
        </div>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>