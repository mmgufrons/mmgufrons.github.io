<?php 
$page_title = "SOP Komplain & Klaim | SIMASRIM Operations";
$footer_desc = "Dokumen Internal Terbatas - Divisi Customer Service & Finance.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>

<style>
    /* UI/UX Link Clickable */
    .inline-link-btn {
        display: inline-flex; align-items: center; gap: 6px; background: #f3effa; color: #7335B7 !important; border: 1px solid rgba(115, 53, 183, 0.2); padding: 8px 20px; border-radius: 8px; font-weight: 700; text-decoration: none; transition: all 0.2s ease-in-out; box-shadow: 0 4px 10px rgba(115, 53, 183, 0.05);
    }
    .inline-link-btn:hover { background: #7335B7; color: #ffffff !important; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(115, 53, 183, 0.25); border-color: #7335B7; }
    
    /* Base SOP Styling */
    .sop-section-title { font-size: 1.15rem; font-weight: 800; color: var(--text-main); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 10px; border-bottom: 2px solid #f8f9fa; padding-bottom: 10px; }
    .step-card { background: #ffffff; border: 1px solid rgba(0,0,0,0.08); border-radius: 16px; padding: 1.8rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .zone-box { border-left: 4px solid var(--primary); background: #fcfcfc; padding: 1.2rem 1.5rem; border-radius: 0 12px 12px 0; margin-bottom: 1rem; border-top: 1px solid #f1f1f1; border-right: 1px solid #f1f1f1; border-bottom: 1px solid #f1f1f1; }
    .zone-title { font-size: 0.95rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
    
    .critical-indicator { background: #fff5f5; border: 2px dashed #e3342f; color: #cc1f1a; border-radius: 12px; padding: 1.5rem; }
    
    /* Custom Table Status */
    .table-status th { background: var(--primary); color: white; border: none; padding: 15px; text-align: center; }
    .table-status td { padding: 12px 15px; vertical-align: middle; border-bottom: 1px solid #eee; font-size: 0.9rem; }
    .badge-status { padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.5px; display: inline-block; text-align: center; width: 100%; }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm"><i class="fas fa-file-signature me-2"></i>SOP Operasional</span>
        <h2 class="display-5 fw-bold mb-2">Penanganan Komplain & Klaim</h2>
        <p class="text-white-50 mb-0">Update Sistem: Dana Talangan (Bailout) & Monitoring Klaim Terpadu.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">

        <div class="text-center mb-5">
            <h5 class="fw-bold text-dark mb-3">Akses File Master Logbook:</h5>
            <a href="#" target="_blank" class="inline-link-btn fs-6">
                <i class="fas fa-file-excel text-success fs-4"></i> Buka Logbook Operasional & Klaim (Database Utama) <i class="fas fa-external-link-alt ms-2" style="font-size: 0.8rem;"></i>
            </a>
            <p class="small text-muted mt-3">Pastikan selalu melakukan input/update data HANYA pada link spreadsheet resmi di atas.</p>
        </div>

        <div class="step-card" style="border-top: 5px solid var(--accent);">
            <div class="sop-section-title"><i class="fas fa-bolt text-accent"></i> Konsep Sistem: Dana Talangan (Bailout)</div>
            <p class="text-muted small mb-4">Sistem ini dirancang agar User mendapatkan kepastian dana lebih cepat (Bailout SIMASRIM) begitu nominal disetujui, tanpa harus menunggu uang fisik turun dari Ekspedisi.</p>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100 border text-center shadow-sm">
                        <i class="fas fa-headset fs-3 text-info mb-2"></i>
                        <h6 class="fw-bold text-dark mb-1">Fokus Tim CS</h6>
                        <p class="small text-muted mb-0">Fokus pada validasi data & persetujuan nominal (ACC).</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100 border text-center shadow-sm">
                        <i class="fas fa-wallet fs-3 text-success mb-2"></i>
                        <h6 class="fw-bold text-dark mb-1">Fokus Tim Finance</h6>
                        <p class="small text-muted mb-0">Fokus pada pembayaran ke User (Talangan) & Penagihan ke Ekspedisi (Reimburse).</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-card">
            <div class="sop-section-title"><i class="fas fa-folder-open text-primary"></i> 1. Struktur File Kerja (Sheet Master)</div>
            <p class="small text-muted mb-3">Terdiri dari sheet berikut di dalam file "Logbook Operasional & Klaim | v260121":</p>
            <div class="table-responsive border rounded-3">
                <table class="table table-hover table-borderless align-middle mb-0 small">
                    <tbody>
                        <tr>
                            <td class="px-3 py-3 fw-bold text-dark border-bottom" width="35%"><i class="fas fa-database text-primary me-2"></i> DATABASE</td>
                            <td class="px-3 py-3 text-muted border-bottom">Satu-satunya tempat input data (A-Y). Semua jenis kasus (KLAIM/YES/XRAY/Non-Klaim) masuk di sini.</td>
                        </tr>
                        <tr>
                            <td class="px-3 py-3 fw-bold text-dark border-bottom"><i class="fas fa-desktop text-warning me-2"></i> DASHBOARD_KASUS</td>
                            <td class="px-3 py-3 text-muted border-bottom">Monitor kasus yang belum selesai ditangani CS (Pendingan).</td>
                        </tr>
                        <tr>
                            <td class="px-3 py-3 fw-bold text-dark border-bottom"><i class="fas fa-money-check-alt text-success me-2"></i> DASHBOARD_BAYAR</td>
                            <td class="px-3 py-3 text-muted border-bottom">Monitor kasus yang <strong>Wajib Dibayar Finance ke User</strong> (Antrian Transfer Talangan).</td>
                        </tr>
                        <tr>
                            <td class="px-3 py-3 fw-bold text-dark border-bottom"><i class="fas fa-search-dollar text-danger me-2"></i> MONITORING_KLAIM</td>
                            <td class="px-3 py-3 text-muted border-bottom">Monitor uang SIMASRIM yang nyangkut di Ekspedisi (Reimbursement).</td>
                        </tr>
                        <tr>
                            <td class="px-3 py-3 fw-bold text-dark"><i class="fas fa-archive text-secondary me-2"></i> REKAP_... (KLAIM/YES/XRAY)</td>
                            <td class="px-3 py-3 text-muted">Laporan Arsip Bulanan.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="step-card">
            <div class="sop-section-title"><i class="fas fa-keyboard text-primary"></i> 2. Tugas Harian (Input Database)</div>
            <p class="small text-muted mb-4">Setiap ada keluhan masuk, buka sheet <strong>DATABASE</strong>. Input data secara horizontal. Kolom dibagi menjadi 5 ZONA:</p>
            
            <div class="zone-box">
                <div class="zone-title">ZONA 1: IDENTITAS (Wajib Diisi Awal)</div>
                <ul class="small text-dark mb-0 ps-3">
                    <li class="mb-1"><strong>TANGGAL LAPORAN:</strong> Tanggal komplain masuk.</li>
                    <li class="mb-1"><strong>NO RESI / AWB:</strong> Pastikan tidak typo.</li>
                    <li class="mb-1"><strong>ID USER / AGEN:</strong> Pastikan sesuai.</li>
                    <li class="mb-1"><strong>EKSPEDISI:</strong> Pilih dari Dropdown.</li>
                    <li class="mb-1"><strong>JENIS LAYANAN:</strong> Pilih dari Dropdown.</li>
                    <li class="mb-1"><strong>KATEGORI KASUS:</strong>
                        <ul class="ps-3 mt-1 text-muted">
                            <li><strong>KLAIM</strong> 👉 Hilang/Rusak (Butuh ganti rugi uang).</li>
                            <li><strong>KLAIM YES</strong> 👉 Telat (Refund Ongkir).</li>
                            <li><strong>X-RAY...</strong> 👉 Gagal X-Ray.</li>
                            <li><strong>RETURN</strong> 👉 Paket Return.</li>
                            <li><strong>LAINNYA</strong> 👉 Kasus paket nyasar, status diam, dll (Tidak butuh ganti rugi uang).</li>
                        </ul>
                    </li>
                    <li class="mt-2"><strong>MASALAH:</strong> Ceritakan kronologi singkat.</li>
                </ul>
            </div>
            
            <div class="zone-box">
                <div class="zone-title">ZONA 2: STATUS & PROGRESS (Mainan CS)</div>
                <ul class="small text-dark mb-0 ps-3">
                    <li class="mb-1"><strong>UPDATE TERAKHIR:</strong> Isi progress harian (misal: "Sedang konfirmasi ke pusat").</li>
                    <li><strong>STATUS:</strong> Lihat Bab 3 untuk aturan Status Baru.</li>
                </ul>
            </div>

            <div class="zone-box">
                <div class="zone-title">ZONA 3: DETAIL KEUANGAN (Diisi Saat Mengajukan & ACC)</div>
                <ul class="small text-dark mb-0 ps-3">
                    <li class="mb-1"><strong>JENIS KLAIM:</strong> Pilih dari Dropdown.</li>
                    <li class="mb-1"><strong>TANGGAL TRANSAKSI:</strong> Isi Tanggal transaksi.</li>
                    <li class="mb-1"><strong>NILAI PENGAJUAN (L & M):</strong> Isi berapa yang kita minta ke Ekspedisi dan ke Asuransi PP.</li>
                    <li class="mb-1"><strong>NILAI CAIR / ACC (N & P):</strong> Isi nominal yang <strong>DISETUJUI</strong> oleh Ekspedisi/PP (Walaupun uang belum masuk ke kita). Ini jadi dasar Finance transfer ke User.</li>
                    <li><strong>TGL CAIR (O & Q):</strong> Isi nanti saat uang benar-benar masuk ke rekening SIMASRIM (Reimbursement).</li>
                </ul>
            </div>

            <div class="zone-box mb-0">
                <div class="zone-title">ZONA 4 & 5: PELENGKAP</div>
                <ul class="small text-dark mb-0 ps-3">
                    <li class="mb-1"><strong>YES/XRAY:</strong> Isi Ongkir Awal, Ongkir Seharusnya, Nominal Refund, & Link Bukti.</li>
                    <li><strong>PENYELESAIAN:</strong> Isi No Rekening User, Total Refund, & Tanggal Transfer oleh Finance.</li>
                </ul>
            </div>
        </div>

        <div class="step-card">
            <div class="sop-section-title"><i class="fas fa-traffic-light text-danger"></i> 3. Alur Status (The Game Changer) 🚦</div>
            <p class="small text-muted mb-3">CS tidak boleh asal pilih status. <strong>Status menentukan data muncul di dashboard mana.</strong></p>
            
            <div class="table-responsive rounded-3 border">
                <table class="table table-bordered table-status mb-0">
                    <thead>
                        <tr>
                            <th width="25%">STATUS</th>
                            <th width="40%">KONDISI PENGGUNAAN</th>
                            <th width="35%">EFEK DI SISTEM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge-status bg-primary text-white">PROSES</span></td>
                            <td class="text-muted">Kasus sedang ditangani / investigasi awal.</td>
                            <td class="text-dark fw-bold">Muncul di DASHBOARD_KASUS (Kuning/Merah).</td>
                        </tr>
                        <tr>
                            <td><span class="badge-status bg-warning text-dark">WAITING INFO</span></td>
                            <td class="text-muted">Menunggu foto/KTP/info dari User.</td>
                            <td class="text-dark fw-bold">Tetap di DASHBOARD_KASUS.</td>
                        </tr>
                        <tr>
                            <td><span class="badge-status bg-danger text-white">ACC NOMINAL / SIAP BAYAR</span></td>
                            <td class="text-muted"><strong>KHUSUS KASUS UANG.</strong> Ekspedisi/PP sudah info nominal ganti rugi. CS sudah info ke User.</td>
                            <td class="text-danger fw-bold">MUNCUL DI DASHBOARD_BAYAR. (Kode Keras buat Finance untuk transfer User).</td>
                        </tr>
                        <tr>
                            <td><span class="badge-status bg-info text-dark">SUDAH TRANSFER USER</span></td>
                            <td class="text-muted">Finance sudah transfer talangan ke User.</td>
                            <td class="text-dark fw-bold">Pindah ke MONITORING_KLAIM. (Tugas kita nagih ke Ekspedisi).</td>
                        </tr>
                        <tr>
                            <td><span class="badge-status" style="background: #e83e8c; color: white;">PARTIAL REIMBURSE</span></td>
                            <td class="text-muted">Uang baru masuk sebagian (Misal: Ekspedisi sudah bayar, PP belum).</td>
                            <td class="text-dark fw-bold">Tetap di MONITORING_KLAIM.</td>
                        </tr>
                        <tr>
                            <td><span class="badge-status bg-success text-white">FULL SETTLEMENT</span></td>
                            <td class="text-muted"><strong>KASUS LUNAS.</strong> Uang User beres, Uang Ekspedisi & PP sudah masuk semua ke SIMASRIM.</td>
                            <td class="text-dark fw-bold">Masuk ke REKAP_KLAIM (Arsip Selesai).</td>
                        </tr>
                        <tr>
                            <td><span class="badge-status bg-secondary text-white">DONE</span></td>
                            <td class="text-muted"><strong>KHUSUS KASUS NON-UANG.</strong> Masalah selesai tanpa ada transaksi uang (Paket ketemu/sampai).</td>
                            <td class="text-dark fw-bold">Masuk Arsip REKAP_KLAIM / Hilang dari Dashboard.</td>
                        </tr>
                        <tr>
                            <td><span class="badge-status bg-dark text-white">BATAL</span></td>
                            <td class="text-muted">Komplain ditolak / User menghilang.</td>
                            <td class="text-dark fw-bold">Masuk ke Sheet KLAIM_BATAL.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="step-card">
            <div class="sop-section-title"><i class="fas fa-sitemap text-primary"></i> 4. Panduan Khusus Per Jenis Kasus</div>
            
            <div class="mb-4">
                <span class="badge bg-danger mb-2 px-3 py-2 fs-6"><i class="fas fa-box-open me-1"></i> A. KASUS KLAIM REGULER (HILANG/RUSAK) - Pake Duit</span>
                <div class="bg-light p-3 rounded border">
                    <ul class="small text-dark mb-0 ps-3">
                        <li class="mb-2"><strong>Tahap Pengajuan:</strong> Isi Kolom L (Ajuan Ekspedisi) & M (Ajuan PP). Status: <code>PROSES</code>.</li>
                        <li class="mb-2"><strong>Tahap ACC (Penting!):</strong> Saat Ekspedisi/PP setuju nominal (via Email/WA).
                            <ul>
                                <li>Isi Kolom <strong>N</strong> (Nilai Cair Ekspedisi) & <strong>P</strong> (Nilai Cair PP).</li>
                                <li>Isi Kolom <strong>W</strong> (Total Refund ke User).</li>
                                <li>Ubah Status: <strong>ACC NOMINAL / SIAP BAYAR</strong>.</li>
                            </ul>
                        </li>
                        <li class="mb-2"><strong>Tahap Bayar User:</strong> Finance transfer ke User 👉 Isi Kolom <strong>X</strong> (Tgl Transfer) 👉 Ubah Status: <strong>SUDAH TRANSFER USER</strong>.</li>
                        <li><strong>Tahap Reimburse (Nagih):</strong>
                            <ul>
                                <li>Saat uang dari Ekspedisi masuk mutasi -> Isi Kolom <strong>O</strong> (Tgl Cair Ekspedisi).</li>
                                <li>Saat uang dari PP masuk mutasi -> Isi Kolom <strong>Q</strong> (Tgl Cair PP).</li>
                                <li>Jika sudah lunas semua -> Ubah Status: <strong>FULL SETTLEMENT</strong>.</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mb-4">
                <span class="badge bg-secondary mb-2 px-3 py-2 fs-6"><i class="fas fa-truck me-1"></i> B. KASUS KOMPLAIN BIASA (NYASAR/TELAT) - Tanpa Duit</span>
                <div class="bg-light p-3 rounded border">
                    <ul class="small text-dark mb-0 ps-3">
                        <li class="mb-2">Investigasi seperti biasa. Status: <code>PROSES</code>.</li>
                        <li>Jika paket akhirnya terkirim/ditemukan:
                            <ul>
                                <li>Isi Update Terakhir.</li>
                                <li>Langsung Ubah Status: <strong>DONE</strong>.</li>
                                <li class="text-danger"><strong>(Jangan pakai status ACC/TRANSFER karena tidak ada uang keluar).</strong></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                <span class="badge bg-warning text-dark mb-2 px-3 py-2 fs-6"><i class="fas fa-x-ray me-1"></i> C. KLAIM YES & X-RAY</span>
                <div class="bg-light p-3 rounded border">
                    <p class="small text-dark mb-0">Sama seperti Klaim Reguler, gunakan alur <strong>ACC NOMINAL</strong> jika butuh refund dana ke user.</p>
                </div>
            </div>
        </div>

        <div class="critical-indicator shadow-sm mt-5 border-3">
            <h4 class="fw-bold mb-4 text-center"><i class="fas fa-exclamation-triangle me-2"></i> ⚠️ ATURAN EMAS (GOLDEN RULES)</h4>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="bg-white p-3 rounded-3 h-100 border border-danger border-opacity-50 shadow-sm">
                        <strong class="text-danger d-block mb-2"><i class="fas fa-hand-paper me-1"></i> 1. JANGAN SALAH STATUS "ACC NOMINAL"!</strong>
                        <p class="small text-dark mb-0">Begitu status ini dipilih, Finance akan menganggap data valid dan <strong>langsung transfer uang</strong>. Jika salah input nominal, CS bertanggung jawab atas selisihnya.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white p-3 rounded-3 h-100 border border-danger border-opacity-50 shadow-sm">
                        <strong class="text-danger d-block mb-2"><i class="fas fa-balance-scale me-1"></i> 2. BEDAKAN "DONE" DAN "FULL SETTLEMENT"</strong>
                        <p class="small text-dark mb-1"><strong>DONE:</strong> Masalah kelar, gak ada urusan duit.</p>
                        <p class="small text-dark mb-0"><strong>FULL SETTLEMENT:</strong> Masalah kelar, urusan duit (hutang piutang) juga sudah lunas semua.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white p-3 rounded-3 h-100 border border-danger border-opacity-50 shadow-sm">
                        <strong class="text-danger d-block mb-2"><i class="fas fa-table me-1"></i> 3. KOLOM PERIODE (Y) JANGAN DIHAPUS</strong>
                        <p class="small text-dark mb-0">Itu rumus otomatis. Kalau error/hilang, segera lapor Marketing/IT.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white p-3 rounded-3 h-100 border border-danger border-opacity-50 shadow-sm">
                        <strong class="text-danger d-block mb-2"><i class="fas fa-eye me-1"></i> 4. CEK DASHBOARD PEMBAYARAN</strong>
                        <p class="small text-dark mb-0">CS wajib mengingatkan Finance jika ada list antrean di <strong>DASHBOARD_BAYAR</strong> yang belum ditransfer ke User.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>