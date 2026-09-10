<?php 
$page_title = "SOP Pendaftaran Agen EDC | SIMASRIM Data";
$footer_desc = "Dokumen Internal Terbatas - Divisi Data & IT.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
require_once __DIR__ . '/../includes/firebase.php';

// Setup Data Dinamis Firebase
$fallback_marketing_kit = [
    "X-Banner EDC" => "https://www.canva.com/design/DAG1qcadvPM/0n7VEz7oh5Rcw90cQU60iQ/edit",
    "Spanduk 2x1 M" => "https://www.canva.com/design/DAGzyZPoop8/pqa42vO38tiLfnuiupbTLw/edit",
    "Spanduk 3x1 M" => "https://www.canva.com/design/DAG1phnvTeU/y7ODED4jLeRtP0XX2j6dVw/edit"
];

$marketing_kits = firebase_get('/marketing_kit');
if (!$marketing_kits) {
    $marketing_kits = $fallback_marketing_kit;
    firebase_put('/marketing_kit', $marketing_kits);
}
?>


<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: #28a745;"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-success rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25 shadow-sm"><i class="fas fa-credit-card me-2"></i>Akuisisi Merchant</span>
        <h2 class="display-5 fw-bold mb-2">SOP Akuisisi & Aktivasi EDC KB</h2>
        <p class="text-white-50 mb-0">Instruksi kerja pendaftaran agen EDC, validasi dokumen, dan pemrosesan via eForm Arranet.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">

        <div class="alert alert-warning border-warning shadow-sm rounded-4 p-4 mb-5" role="alert">
            <div class="d-flex gap-3">
                <i class="fas fa-code-branch fs-2 text-warning mt-1"></i>
                <div class="w-100">
                    <h5 class="fw-bold text-dark mb-2">Pembaruan Alur Aktivasi EDC Arranet (Per 24.02.26)</h5>
                    <p class="small text-dark mb-3">Sistem registrasi saat ini <strong>diprioritaskan langsung melalui Partner Arranet</strong>. Flow pembuatan rekening ke KB Bekasi ditiadakan agar SLA aktivasi jauh lebih cepat.</p>
                    
                    <a class="btn btn-sm btn-outline-dark fw-bold" data-bs-toggle="collapse" href="#alurLama" role="button" aria-expanded="false" aria-controls="alurLama">
                        <i class="fas fa-history me-1"></i> Lihat Catatan Alur Lama (Versi KB Bekasi)
                    </a>
                    
                    <div class="collapse mt-3" id="alurLama">
                        <div class="card card-body bg-white border-warning border-opacity-50 small text-muted">
                            <strong class="text-dark mb-2">Catatan Historis - Alur Versi KB Bekasi (Sebelumnya):</strong>
                            <ol class="mb-0 ps-3">
                                <li>Request di edc.smsrm.com</li>
                                <li>Konfirmasi manual ke KB Bekasi</li>
                                <li>Proses Pembuatan Rekening</li>
                                <li>FU Kelengkapan Rekening + TID/MID ke KB Bekasi</li>
                                <li>Isi Form HP</li>
                                <li>Konfirmasi SPV</li>
                                <li>Konfirmasi ke Grup Arranet</li>
                                <li>Status Aktif</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid var(--primary);">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark mb-0"><span class="badge bg-primary me-2">Tahap 1</span>Pengisian Form Registrasi Awal</h5>
            </div>
            <p class="text-muted small mb-3">Tim Sales/CS mengarahkan Calon Agen untuk mengisi form pendaftaran pembukaan rekening di <a href="https://www.simasrim.com/edc/registrasi.php" target="_blank" class="fw-bold text-decoration-none">simasrim.com/edc/registrasi.php</a>. Data lengkap yang dibutuhkan dari form tersebut adalah:</p>
            
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="data-list-box">
                        <h6>Data Diri & Identitas</h6>
                        <ul>
                            <li>Nama Lengkap & Nama Alias</li>
                            <li>Nama Ibu Kandung</li>
                            <li>Jenis Kelamin & Agama</li>
                            <li>Jenis & No Identitas (KTP)</li>
                            <li>Tempat & Tanggal Lahir</li>
                            <li>Status Penduduk & Kewarganegaraan</li>
                            <li>Status Perkawinan & Pendidikan</li>
                            <li>No HP / WA & Email</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="data-list-box">
                        <h6>Alamat & Pekerjaan</h6>
                        <ul>
                            <li>Alamat KTP & Kode Pos KTP</li>
                            <li>Status Tempat Tinggal</li>
                            <li>Alamat Korespondensi</li>
                            <li>Nama Kantor & Bidang Usaha</li>
                            <li>Jabatan & Alamat Kantor</li>
                            <li>Pendapatan & Pengeluaran</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="data-list-box">
                        <h6>Darurat & Lampiran</h6>
                        <ul>
                            <li>Nama Darurat</li>
                            <li>Hubungan Darurat</li>
                            <li>HP & Alamat Darurat</li>
                            <li class="fw-bold text-primary mt-2">Lampiran Dasar:</li>
                            <li>Foto KTP & Foto TTD</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid var(--wa-green);">
            <div class="step-header border-bottom border-light pb-3 mb-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark"><span class="badge bg-success me-2">Tahap 2</span>Follow Up Kelengkapan Data ke Agen</h5>
                <button class="btn btn-sm btn-outline-success" onclick="copyWaText('raw_user', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            <p class="text-muted small mb-3">Setelah agen selesai mengisi form web (Tahap 1), segera hubungi agen via WA untuk meminta dokumen personal tambahan (Non-Bank) yang wajib diinput ke sistem Arranet nantinya.</p>
            
            <div class="chat-bubble shadow-sm" style="background: #E4EFE7; border: 1px solid #c3e6cb;">
                <span class="wa-bold">Halo Kak [Nama Agen], pendaftaran awal EDC KB Bank Kakak sudah kami terima!</span> 💳<br><br>
                Agar mesin EDC bisa segera diproses aktivasinya, mohon bantuannya untuk mengirimkan beberapa dokumen tambahan berikut ke chat ini ya Kak:<br><br>
                1. No. KK & Foto KK<br>
                2. Foto Selfie<br>
                3. Foto Toko / Tempat Usaha<br><br>
                Ditunggu kelengkapannya ya Kak, terima kasih atas kerjasamanya! 🙏
            </div>
            <pre id="raw_user" class="raw-wa-text">*Halo Kak [Nama Agen], pendaftaran awal EDC KB Bank Kakak sudah kami terima!* 💳

Agar mesin EDC bisa segera diproses aktivasinya, mohon bantuannya untuk mengirimkan beberapa dokumen tambahan berikut ke chat ini ya Kak:

1. No. KK & Foto KK
2. Foto Selfie
3. Foto Toko / Tempat Usaha

Ditunggu kelengkapannya ya Kak, terima kasih atas kerjasamanya! 🙏</pre>
        </div>

        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid var(--accent);">
            <div class="step-header border-bottom border-light pb-3 mb-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark"><span class="badge text-dark me-2" style="background: var(--accent); color: white !important;">Tahap 3</span>Follow Up Rekening ke Tim Arranet</h5>
                <button class="btn btn-sm btn-outline-dark" onclick="copyWaText('raw_arranet', this)" style="border-color: var(--accent); color: var(--accent);"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            <p class="text-muted small mb-3">Karena proses pembukaan rekening sekarang dibantu oleh pihak Arranet, kita harus <em>follow up</em> ke tim mereka untuk mendapatkan data Bank agar bisa kita input ke aplikasi eForm.</p>
            
            <div class="chat-bubble shadow-sm" style="background: #fff8e6; border: 1px solid #ffe8a1;">
                <span class="wa-bold">Halo Tim Arranet,</span><br><br>
                Izin follow up untuk progress pembukaan rekening KB Bank atas nama agen berikut:<br>
                - Nama: [Nama Agen]<br>
                - No KTP: [No KTP]<br><br>
                Apakah untuk kelengkapan:<br>
                1. Foto Buku Tabungan beserta Tanda Tangan<br>
                2. Foto saat Pembukaan Rekening<br>
                3. TID / MID<br>
                Sudah tersedia/ready Tim? Agar bisa segera kami proses input ke eForm Mobile. Terima kasih! 🙏
            </div>
            <pre id="raw_arranet" class="raw-wa-text">*Halo Tim Arranet,*

Izin follow up untuk progress pembukaan rekening KB Bank atas nama agen berikut:
- Nama: [Nama Agen]
- No KTP: [No KTP]

Apakah untuk kelengkapan:
1. Foto Buku Tabungan beserta Tanda Tangan
2. Foto saat Pembukaan Rekening
3. TID / MID
Sudah tersedia/ready Tim? Agar bisa segera kami proses input ke eForm Mobile. Terima kasih! 🙏</pre>
        </div>

        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid #17a2b8;">
            <h5 class="fw-bold text-dark mb-3"><span class="badge bg-info text-dark me-2">Tahap 4</span>Input Data ke eForm Mobile</h5>
            <p class="text-muted small mb-3">Setelah seluruh data dari Agen (Tahap 2) dan data Rekening dari Arranet (Tahap 3) terkumpul lengkap, saatnya memproses pendaftaran ke sistem.</p>
            
            <ol class="text-dark small mb-0 bg-light p-3 rounded border" style="line-height: 1.8;">
                <li class="mb-2">Buka aplikasi <strong>eForm Arranet (Mobile APK)</strong>.</li>
                <li class="mb-2">Klik menu <strong>Registrasi Merchant</strong>.</li>
                <li class="mb-2">Pada pilihan Bank (Merchant), pastikan memilih <strong>BANK KB BUKOPIN</strong>.</li>
                <li class="mb-2">Pilih <strong>Jenis Usaha</strong> yang sesuai.</li>
                <li class="mb-2">Isi seluruh formulir pendaftaran dengan data yang sudah dikumpulkan, lalu klik <strong>Submit</strong>.</li>
            </ol>
        </div>

        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid var(--ai-blue);">
            <h5 class="fw-bold text-dark mb-3"><span class="badge bg-primary me-2">Tahap 5</span>Approval Sales Lead & Notifikasi Grup</h5>
            <p class="text-muted small mb-3">Setelah di-submit via APK, berikan info ke Grup Internal bahwa ada pengajuan baru yang butuh di-<em>Approve</em> oleh Sales Lead melalui portal web.</p>

            <div class="row g-3 mb-3">
                <div class="col-md-12">
                    <div class="p-3 border rounded" style="background: #f4f8ff; border-color: #cce0ff !important;">
                        <span class="d-block small text-muted mb-1">Link Portal Approval:</span>
                        <a href="https://kapas.arranetpay.com/" target="_blank" class="fw-bold text-primary fs-5 text-decoration-none"><i class="fas fa-external-link-alt me-2"></i>kapas.arranetpay.com</a>
                        
                        <div class="d-flex flex-wrap gap-4 mt-3 pt-3 border-top border-primary border-opacity-25">
                            <div>
                                <span class="d-block small text-muted">Username:</span>
                                <code class="fs-6 text-dark fw-bold">marketing.demo@contoh-perusahaan.demo</code>
                            </div>
                            <div>
                                <span class="d-block small text-muted">Password:</span>
                                <code class="fs-6 text-dark fw-bold">demo123!</code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ol class="text-dark small mb-3" style="line-height: 1.8;">
                <li class="mb-1">Login ke dashboard menggunakan kredensial di atas.</li>
                <li class="mb-1">Di sidebar kiri, klik menu <strong>Agen</strong>, lalu pilih sub-menu <strong>Permintaan Pembukaan Agen</strong>.</li>
                <li class="mb-1">Cari nama agen yang baru didaftarkan.</li>
                <li class="mb-1">Klik tombol <strong>Action</strong> (ikon dropdown warna biru) di sebelah kiri data agen.</li>
                <li class="mb-1">Pilih opsi <strong>Disetujui</strong> untuk meneruskan permintaan aktivasi ke pusat Arranet.</li>
            </ol>
            
            <p class="text-danger small fw-bold mb-0"><i class="fas fa-info-circle me-1"></i> Catatan Penting: <span class="text-dark fw-normal">Sesuai flow Arranet terbaru, kita <strong>sudah tidak perlu lagi submit form fisik</strong> atau me-report foto dokumen kelengkapan ke grup. Tugas CS/Sales selesai sampai tahap Follow Up dan Approval ini.</span></p>
        </div>

        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid #6c757d;">
            <h5 class="fw-bold text-dark mb-3"><span class="badge bg-secondary me-2">Tahap 6</span>Distribusi Standard Starter Kit</h5>
            <p class="text-muted small mb-3">Setelah aktivasi disetujui, agen akan dikirimkan perangkat EDC siap pakai dengan kelengkapan:</p>
            
            <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light border text-dark"><i class="fas fa-check text-success me-1"></i> Unit EDC</span>
                <span class="badge bg-light border text-dark"><i class="fas fa-check text-success me-1"></i> Charger</span>
                <span class="badge bg-light border text-dark"><i class="fas fa-check text-success me-1"></i> Simcard Aktif</span>
                <span class="badge bg-light border text-dark"><i class="fas fa-check text-success me-1"></i> Spanduk</span>
                <span class="badge bg-light border text-dark"><i class="fas fa-check text-success me-1"></i> Kertas Thermal 5 Roll</span>
                <span class="badge bg-light border text-dark"><i class="fas fa-check text-success me-1"></i> Panduan Penggunaan</span>
            </div>
        </div>

        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid #8e44ad;">
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-light pb-3">
                <h5 class="fw-bold text-dark mb-0"><i class="fas fa-palette me-2" style="color: #8e44ad;"></i>Marketing Kit (Bahan Promosi EDC)</h5>
            </div>
            <p class="text-muted small mb-3">Akses <em>master design</em> (Canva) untuk kebutuhan promosi Agen EDC KB Bukopin. Silakan klik tautan di bawah ini untuk melihat atau mencetak desain:</p>
            
            <div class="row g-3">
                <?php foreach ($marketing_kits as $key => $kit): 
                    if (is_array($kit)) {
                        $title = $kit['title'] ?? 'Marketing Kit';
                        $desc = $kit['desc'] ?? 'Bahan Promosi EDC';
                        $icon = $kit['icon'] ?? 'fa-image';
                        $url = $kit['url'] ?? '#';
                    } else {
                        $title = $key;
                        $url = $kit;
                        $desc = 'Format Custom';
                        $icon = 'fa-image';
                        
                        if (stripos($title, 'banner') !== false) {
                            $icon = 'fa-portrait';
                            $desc = 'Format Standing Banner';
                        } elseif (stripos($title, '2x1') !== false) {
                            $icon = 'fa-image';
                            $desc = 'Format Lanskap (Medium)';
                        } elseif (stripos($title, '3x1') !== false) {
                            $icon = 'fa-images';
                            $desc = 'Format Lanskap (Besar)';
                        }
                    }
                ?>
                <div class="col-md-4">
                    <a href="<?= htmlspecialchars($url) ?>" target="_blank" class="text-decoration-none d-block">
                        <div class="p-4 border rounded-3 text-center shadow-sm" style="background: #fbf9ff; border-color: #e8dff5 !important; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 20px rgba(142,68,173,0.15) !important';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075) !important';">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background: rgba(142,68,173,0.1); color: #8e44ad;">
                                    <i class="fas <?= htmlspecialchars($icon) ?> fs-3"></i>
                                </div>
                            </div>
                            <h6 class="fw-bold text-dark mb-1"><?= htmlspecialchars($title) ?></h6>
                            <p class="small text-muted mb-0"><?= htmlspecialchars($desc) ?></p>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid #fd7e14;">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-bullseye me-2" style="color: #fd7e14;"></i>Diferensiasi & Positioning EDC SIMASRIM</h5>
            <p class="text-muted small mb-3">EDC SIMASRIM (KB Bukopin) punya nilai jual berbeda dari EDC lain (mis. Fastpay) yang perlu ditekankan saat pitching ke calon agen:</p>
            <ul class="text-dark small mb-0" style="line-height: 1.9;">
                <li>Fitur <strong>pengiriman multikurir</strong> & fitur <em>garibet</em> (gabung ribet/multi-layanan) yang tidak dimiliki EDC kompetitor.</li>
                <li>Tetap tawarkan ke user yang sudah punya EDC lain (di luar user hasil UTM Campaign) — user pemilik EDC biasanya terbuka untuk pegang lebih dari 1 mesin.</li>
                <li>Value prop utama: <strong>cukup 1x login</strong> sudah bisa akses semua layanan logistik, sekaligus bisa jadi agen berbagai jenis EDC — tanpa perlu daftar terpisah ke masing-masing penyedia seperti biasanya.</li>
            </ul>
        </div>

        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid #20c997;">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-file-signature me-2" style="color: #20c997;"></i>Skema Sewa EDC — RTS & MSN (Tanpa Modal Awal)</h5>
            <p class="text-muted small mb-3">Untuk EDC JNE yang tidak mau dimodalin di awal, tersedia skema sewa sebagai alternatif:</p>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="data-list-box">
                        <h6>RTS (Bukan Hak Milik)</h6>
                        <ul>
                            <li>Masa sewa 3 tahun</li>
                            <li>Biaya Rp 300.000</li>
                            <li>Tidak perlu buka rekening KB</li>
                            <li>Tidak perlu eForm Arranet</li>
                            <li>Tetap wajib Form Farhan (keperluan asuransi)</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="data-list-box">
                        <h6>MSN (Non Mini ATM)</h6>
                        <ul>
                            <li>Skema sewa, bukan kepemilikan unit</li>
                            <li>Cocok untuk kebutuhan non-mini ATM</li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="text-dark small mb-0" style="line-height: 1.8;"><strong>Catatan tambahan skema RTS:</strong> bisa memanfaatkan promo KB (informasikan ke user), dan KB juga bisa membantu mempromosikan SIMASRIM. Lengkapi S&K Pembelian untuk keperluan klaim asuransi. Tersedia juga skema <strong>reseller</strong> — user bisa daftar jadi reseller, sebarkan, dan dapat bagian Rp 300.000+ per referral.</p>
        </div>

        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid #0dcaf0;">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-road me-2" style="color: #0dcaf0;"></i>Fitur & Rencana Pengembangan EDC</h5>
            <ul class="text-dark small mb-0" style="line-height: 1.9;">
                <li><strong>Tearing biaya admin</strong> berbasis nominal penarikan (contoh: Rp 500rb → Rp 1rb, Rp 1jt → Rp 2rb), mengikuti ketentuan masing-masing merchant.</li>
                <li>Rencana fitur <strong>QRIS Transfer eWallet → Rekening Penampung</strong> — use case: ojol yang mau tarik saldo cash saat saldo hanya Rp 80rb.</li>
                <li>Sediakan menu panduan EDC di dalam produk (kalau belum memungkinkan, sementara pakai banner yang bisa diklik).</li>
                <li>Lakukan test EDC secara berkala (termasuk internal tim) untuk mengecek pengalaman pengguna & menemukan poin upgrade.</li>
                <li><strong>Rencana Pengembangan V2 (App EDC):</strong> input kota/alamat (pickup, pengirim, penerima) dikunci dari daftar pilihan yang tersedia, tidak bisa input bebas — mencegah kesalahan input. Nilai barang punya 2 jenis, tanpa perlu upload foto/video. Tampilan resi menampilkan harga asli barang termasuk nilai asuransinya.</li>
            </ul>
        </div>

        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid var(--primary);">
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-light pb-3">
                <h5 class="fw-bold text-dark mb-0"><i class="fas fa-shield-halved me-2" style="color: var(--primary);"></i>BCA Insurance — Branding & Skema MPAR</h5>
            </div>

            <h6 class="fw-bold text-dark mb-2">Branding & White Label</h6>
            <ul class="text-dark small mb-3" style="line-height: 1.8;">
                <li>Branding wajib mencantumkan nama BCA Insurance. Format yang disepakati: <strong>"SIMASRIM Insurance powered by BCA Insurance"</strong>.</li>
                <li>Seluruh materi marketing/campaign wajib melalui persetujuan tertulis dari kedua belah pihak sebelum dipublikasikan.</li>
            </ul>

            <h6 class="fw-bold text-dark mb-2">Mekanisme MPAR (Movable Property All Risk)</h6>
            <ul class="text-dark small mb-3" style="line-height: 1.8;">
                <li><strong>Aktivasi Polis:</strong> polis aktif setelah user menerima barang/EDC (bukan saat pengiriman).</li>
                <li><strong>Rekap & Penagihan:</strong> rekap data polis dikirim tiap 2 minggu ke BCA Insurance dalam format Excel — di-generate otomatis dari dashboard PT SMA/SIMASRIM (bisa download per periode/batch dengan checklist data yang diperlukan). Setelah rekap diterima, BCA Insurance menerbitkan sertifikat polis + tagihan bulanan. Biaya 1% dari harga barang.</li>
                <li><strong>Data wajib per rekap:</strong> Nama, Jenis Kelamin, NIK, Tanggal Lahir, Tempat Lahir (data personal) — dikirim via WhatsApp & Email ke PT SMA (PT SMA yang mengurus). Nomor polis sama (Master), yang berbeda adalah sertifikatnya.</li>
                <li><strong>Skema Fee & Komisi:</strong> fee-based income sebesar 0,2% (bukan 0,1%), dengan pembagian komisi 25% untuk SIMASRIM (atau sesuai kesepakatan).</li>
            </ul>

            <h6 class="fw-bold text-dark mb-2">Cakupan & Rencana Perluasan</h6>
            <ul class="text-dark small mb-0" style="line-height: 1.8;">
                <li><strong>Soundbox:</strong> selain kerusakan barang, bisa juga mencakup kegagalan transaksi.</li>
                <li>Bisa menjual asuransi selama barang masih baru dengan skema fee based (PKS terpisah) — proses manual dulu via Dashboard, baru dikembangkan ke API. Produk lain yang cocok juga bisa dijajaki.</li>
                <li>Cari peluang produk asuransi lain secara bertahap (1 per 1, tidak langsung semua sekaligus) — misalnya menambahkan menu Asuransi BCA di bawah form pembayaran produk lain (contoh: PBB), dengan form yang disesuaikan kebutuhan data tiap produk.</li>
                <li>Peluang lain: asuransi perjalanan (tiket/travel) via BCA, dan asuransi pengiriman termasuk emas (case by case, dengan limit) — rate dikirim PT SMA dari Pasarpolis, lalu dihitung oleh BCA Insurance.</li>
            </ul>
        </div>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>