<?php 
$page_title = "Blueprint Campaign B2B Institusional | SIMASRIM Operations";
$footer_desc = "Dokumen Internal Rahasia - Divisi Campaign & Business Development.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>

<style>
    /* Styling Global Campaign B2B */
    .step-card { background: #ffffff; border: 1px solid rgba(0,0,0,0.08); border-radius: 16px; padding: 1.8rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .section-title-b2b { font-size: 1.25rem; font-weight: 800; color: var(--primary); margin-bottom: 1.5rem; padding-bottom: 12px; border-bottom: 2px solid #f1f3f5; display: flex; align-items: center; gap: 10px; }
    
    /* Table Compare */
    .table-b2b { margin-bottom: 0; width: 100%; border-collapse: collapse; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
    .table-b2b th { background: var(--primary); color: white; border: none; padding: 15px; font-weight: 700; text-align: left; }
    .table-b2b td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #eee; font-size: 0.95rem; }
    .table-b2b tr:hover td { background: #f8f9fa; }

    /* WA & Email UI */
    .chat-bubble { background: #f8f9fa; border-radius: 0 12px 12px 12px; padding: 1.2rem; border: 1px solid #e9ecef; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.6; font-size: 0.95rem; margin-bottom: 1rem; }
    .chat-bubble.cs-reply { border-left: 5px solid #0dcaf0; }
    .email-container { background: #fff; border: 1px solid #e9ecef; border-radius: 8px; overflow: hidden; margin-top: 15px; }
    .email-header { background: #f8f9fa; padding: 12px 15px; border-bottom: 1px solid #e9ecef; font-family: Arial, sans-serif; display: flex; justify-content: space-between; align-items: center;}
    .email-body { padding: 20px; font-family: 'Segoe UI', Arial, sans-serif; font-size: 0.95rem; line-height: 1.6; color: #333; white-space: pre-wrap; background: #fffcfc;}
    
    .raw-text { display: none !important; }
    .btn-copy { background: white; border: 1px solid #ced4da; color: #495057; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: 0.2s; white-space: nowrap;}
    .btn-copy:hover { background: #e9ecef; color: #212529; }
    .btn-copy.copied { background: var(--primary); border-color: var(--primary); color: white; }
    
    .variable-badge { background: #e9ecef; border: 1px solid #ced4da; padding: 2px 6px; border-radius: 4px; font-family: monospace; font-size: 0.85rem; color: #d63384; font-weight: bold; }
    .amunisi-box { background: #fff; border: 1px solid #e9ecef; border-left: 4px solid var(--accent); padding: 1.2rem; border-radius: 8px; height: 100%; box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
    /* Divider Styling (Bagian 5 & 8) */
    .section-divider { display: flex; align-items: center; text-align: center; margin: 3rem 0 2rem; }
    .section-divider::before, .section-divider::after { content: ''; flex: 1; border-bottom: 2px dashed #ced4da; }
    .section-divider span { padding: 0 15px; font-size: 1.15rem; font-weight: 800; color: var(--primary, #1f0d3d); text-transform: uppercase; letter-spacing: 0.5px; }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--primary);"></div>
    <div class="container position-relative z-1">
        <span class="badge bg-danger rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm border border-danger"><i class="fas fa-user-secret me-2"></i>Rahasia Internal</span>
        <h2 class="display-5 fw-bold mb-2 text-white">Blueprint Campaign B2B Institusional</h2>
        <p class="text-white-50 mb-0">Versi Final Enterprise · 15 Juni 2026 · Strategi Akuisisi Koperasi, BUMDes, dan LPTK.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="step-card" style="border-top: 5px solid var(--primary);">
            <div class="section-title-b2b"><i class="fas fa-sync-alt"></i> BAGIAN 1: Konsep & Pergeseran Strategi</div>
            
            <h6 class="fw-bold text-dark mb-3">Apa yang Berubah dari Sebelumnya?</h6>
            <div class="table-responsive mb-4">
                <table class="table-b2b">
                    <thead>
                        <tr>
                            <th width="20%">Aspek</th>
                            <th width="40%">Konsep Lama</th>
                            <th width="40%">Konsep Baru (FINAL)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold text-dark">Penawaran Utama</td>
                            <td class="text-muted">White Label (aplikasi sendiri atas nama koperasi)</td>
                            <td class="fw-bold text-success">Tambahan Lini Usaha Terintegrasi ("Bisnis dalam Kotak")</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-dark">Cara Pendekatan</td>
                            <td class="text-muted">Pancingan awal / pemanasan</td>
                            <td class="fw-bold text-success">Langsung bawa Proposal 1 Halaman + Drip Campaign</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-dark">Insentif Masuk</td>
                            <td class="text-muted">—</td>
                            <td class="fw-bold text-success">Free Trial Saldo Rp 10.000 + Dampingi sampai Sukses</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-dark">Alur CS Ops</td>
                            <td class="text-muted">Menunggu bola / pasif</td>
                            <td class="fw-bold text-success">Proaktif Onboarding (H+1) & Win-Back (H+30)</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h6 class="fw-bold text-dark mb-3 mt-5 border-bottom pb-2">Angle Komunikasi Per Segmen</h6>
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="p-3 bg-light border rounded">
                        <strong class="text-primary d-block mb-1">Koperasi (Kopkar, Kopma, KDMP, Kopdes):</strong>
                        <p class="small text-muted mb-2">Koperasi punya anggota tapi belum maksimal mengmonetisasi mereka. SIMASRIM mengubah kantor koperasi menjadi gerai layanan tanpa sewa tempat baru — anggota kirim paket dan bayar tagihan di koperasi sendiri, kas koperasi tambah tebal.</p>
                        <p class="small text-dark fw-bold mb-0"><i class="fas fa-quote-left text-primary opacity-50 me-1"></i> Contoh konkret wajib disebut: "OB atau staf kantor bisa input sendiri paket dari HP — tidak perlu staf IT."</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-light border rounded">
                        <strong class="text-success d-block mb-1">BUMDes / BUMK / BUMU:</strong>
                        <p class="small text-muted mb-0">Desa butuh layanan ekonomi baru yang didorong pemerintah. UMKM desa bisa kirim produk ke seluruh Indonesia, warga bayar listrik tidak perlu ke kota.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 bg-light border rounded">
                        <strong class="text-info d-block mb-1">LPTK Penyelenggara PPG:</strong>
                        <p class="small text-muted mb-0">Kampus rutin kirim dokumen/modul massal → biaya logistik besar. SIMASRIM memberi diskon ongkir resmi. Plus: jual ongkir ke mahasiswa/peserta PPG dengan harga normal → selisih jadi pendapatan kampus.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-top: 5px solid var(--accent);">
            <div class="section-title-b2b"><i class="fas fa-boxes"></i> BAGIAN 2: Amunisi</div>
            <p class="text-muted small mb-3">Berikut daftar lengkap amunisi untuk tim bisa bergerak:</p>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="amunisi-box">
                        <strong class="text-dark d-block mb-2"><i class="fas fa-palette text-accent me-2"></i> A. Aset Desain</strong>
                        <ul class="small text-muted mb-0 ps-3">
                            <li><strong>Proposal PDF 1 Halaman</strong></li>
                            <li><strong>Thumbnail WA Blast</strong> — visual pendukung pesan WA (opsional tapi sangat membantu open rate).</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="amunisi-box" style="border-left-color: var(--primary);">
                        <strong class="text-dark d-block mb-2"><i class="fas fa-keyboard text-primary me-2"></i> B. Aset Teks (Siap Pakai)</strong>
                        <ul class="small text-muted mb-0 ps-3">
                            <li>Template WA Blast — 5 kategori target (Drip Campaign)</li>
                            <li>Template Email — 3 kategori target</li>
                            <li>Objection Handling / Cheat Sheet</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="amunisi-box" style="border-left-color: var(--success);">
                        <strong class="text-dark d-block mb-2"><i class="fas fa-database text-success me-2"></i> C. Aset Data (Tim Ops)</strong>
                        <ul class="small text-muted mb-2 ps-3">
                            <li><strong>DB Koperasi:</strong> simkopdes.go.id, kdkmp.bogorkab.go.id, Google Maps</li>
                            <li><strong>DB LPTK PPG:</strong> ppg.kemendikdasmen.go.id/page/info-lptk</li>
                        </ul>
                        <span class="badge bg-light text-dark border w-100 text-start fw-normal">Kolom: Nama Institusi | PIC | WA | Email | Kota | Kategori | Status</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="amunisi-box" style="border-left-color: var(--info);">
                        <strong class="text-dark d-block mb-2"><i class="fas fa-server text-info me-2"></i> D. Infrastruktur Teknis</strong>
                        <ul class="small text-muted mb-0 ps-3">
                            <li><strong>Akun WA "SIMASRIM Daftar X":</strong> konfirmasi Tim (Raka).</li>
                            <li><strong>Ekstensi MergeMail Chrome:</strong> untuk email blast terpersonalisasi.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #25D366; border-top: none;">
            <div class="section-title-b2b text-success"><i class="fab fa-whatsapp"></i> BAGIAN 3: Pipeline WA Blast B2B (Drip Campaign)</div>
            <div class="alert alert-success bg-opacity-10 border-success border-opacity-25 py-2 px-3 mb-4 small">
                <i class="fas fa-info-circle me-1"></i> Variabel dinamis ditulis dalam <span class="variable-badge">{{...}}</span>. Gunakan delay 15-30 menit antar pesan.
            </div>

            <h5 class="fw-bold mb-3 border-bottom pb-2">HARI 1 - Penawaran Awal Berdasarkan Kategori</h5>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-success fs-6">Kategori 1: Kopkar & Kopma / KPRI</span>
                    <button class="btn-copy" onclick="copyText('wa1', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <p class="small text-muted fst-italic mb-2">Angle: Revenue baru untuk kas koperasi, kemudahan layanan untuk anggota, tidak perlu staf tambahan.</p>
                <div class="chat-bubble">
                    Selamat pagi, Pengurus <strong>{{Nama Koperasi}}</strong> di <strong>{{Kota}}</strong>. Salam kenal, saya Dinda dari PT Solusi Mitra Aplikasi (SIMASRIM). 😊<br><br>
                    Kami melihat <strong>{{Nama Koperasi}}</strong> punya ekosistem anggota yang solid. Izinkan kami menawarkan satu peluang yang bisa langsung menambah pendapatan kas koperasi tanpa perlu sewa tempat baru atau rekrut staf khusus.<br><br>
                    Program kami: <strong>"Tambahan Lini Usaha Ritel Logistik & Pembayaran Digital"</strong> — dengan bergabung, koperasi bisa langsung melayani:<br>
                    ✅ Pengiriman paket semua ekspedisi (Lion, J&T, SAPX, SPX, Paxel)<br>
                    ✅ Loket bayar tagihan (Listrik, PDAM, BPJS, Pulsa, Tiket)<br><br>
                    Sistemnya bisa dioperasikan dari HP atau komputer yang sudah ada. Bahkan bisa didelegasikan ke staf OB di sela waktu luang mereka — tidak menyita waktu staf inti koperasi sama sekali.<br><br>
                    <strong>Daftar 100% Gratis. Kami kasih Saldo Percobaan Rp 10.000 + dampingi sampai transaksi pertama berhasil.</strong><br><br>
                    Proposal singkat 1 halaman kami lampirkan di bawah ini. Apakah pengurus ada waktu sejenak pekan ini untuk diskusi singkat, atau kami bisa visit langsung ke kantor (khusus area Bogor/Jabodetabek)?<br><br>
                    Terima kasih banyak, salam sukses! 🙏<br>
                    👉 Info selengkapnya: http://dpj.smsrm.com/<br>
                    📎 <i>[Lampiran: Proposal_B2B_SIMASRIM.pdf]</i>
                </div>
                <pre id="wa1" class="raw-text">Selamat pagi, Pengurus {{Nama Koperasi}} di {{Kota}}. Salam kenal, saya Dinda dari PT Solusi Mitra Aplikasi (SIMASRIM). 😊

Kami melihat {{Nama Koperasi}} punya ekosistem anggota yang solid. Izinkan kami menawarkan satu peluang yang bisa langsung menambah pendapatan kas koperasi tanpa perlu sewa tempat baru atau rekrut staf khusus.

Program kami: *"Tambahan Lini Usaha Ritel Logistik & Pembayaran Digital"* — dengan bergabung, koperasi bisa langsung melayani:
✅ Pengiriman paket semua ekspedisi (Lion, J&T, SAPX, SPX, Paxel)
✅ Loket bayar tagihan (Listrik, PDAM, BPJS, Pulsa, Tiket)

Sistemnya bisa dioperasikan dari HP atau komputer yang sudah ada. Bahkan bisa didelegasikan ke staf OB di sela waktu luang mereka — tidak menyita waktu staf inti koperasi sama sekali.

*Daftar 100% Gratis. Kami kasih Saldo Percobaan Rp 10.000 + dampingi sampai transaksi pertama berhasil.*

Proposal singkat 1 halaman kami lampirkan di bawah ini. Apakah pengurus ada waktu sejenak pekan ini untuk diskusi singkat, atau kami bisa visit langsung ke kantor (khusus area Bogor/Jabodetabek)?

Terima kasih banyak, salam sukses! 🙏
👉 Info selengkapnya: http://dpj.smsrm.com/
📎 _[Lampiran: Proposal_B2B_SIMASRIM.pdf]_</pre>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-success fs-6">Kategori 2: KDMP / KMP</span>
                    <button class="btn-copy" onclick="copyText('wa2', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <p class="small text-muted fst-italic mb-2">Angle: Sinergi program pemerintah, digitalisasi koperasi desa, dukung kemandirian ekonomi.</p>
                <div class="chat-bubble">
                    Selamat pagi, Bapak/Ibu Pengurus <strong>{{Nama Koperasi}}</strong> di <strong>{{Kota}}</strong>. Salam kenal, saya Dinda dari PT Solusi Mitra Aplikasi (SIMASRIM). 🙏<br><br>
                    Kami mengapresiasi peran <strong>{{Nama Koperasi}}</strong> sebagai motor penggerak ekonomi masyarakat di wilayah Bapak/Ibu. Selaras dengan semangat penguatan ekonomi kerakyatan yang dicanangkan pemerintah, kami ingin memperkenalkan program yang dapat langsung memperkuat unit usaha koperasi tanpa mengganggu kegiatan simpan-pinjam yang sudah berjalan.<br><br>
                    Program kami: <strong>"Penambahan Unit Usaha Ritel Logistik & Loket Pembayaran Warga"</strong> — dirancang khusus agar koperasi bisa melayani:<br>
                    ✅ Pengiriman barang warga & UMKM ke seluruh Indonesia (kurir resmi pickup langsung ke lokasi)<br>
                    ✅ Loket pembayaran tagihan harian warga (Listrik, PDAM, BPJS, Pulsa)<br>
                    ✅ Seluruh margin keuntungan langsung masuk kas koperasi<br><br>
                    <strong>Bergabung 100% Gratis. Tidak ada investasi modal, tidak ada biaya franchise.</strong> Kami lampirkan proposal ringkas 1 halaman berikut sebagai bahan rapat pengurus.<br><br>
                    Apakah kami diperkenankan untuk koordinasi lanjutan via WA atau tatap muka langsung? Terima kasih banyak atas perhatiannya. 🙏<br>
                    👉 Info selengkapnya: http://dpj.smsrm.com/<br>
                    📎 <i>[Lampiran: Proposal_B2B_SIMASRIM.pdf]</i>
                </div>
                <pre id="wa2" class="raw-text">Selamat pagi, Bapak/Ibu Pengurus {{Nama Koperasi}} di {{Kota}}. Salam kenal, saya Dinda dari PT Solusi Mitra Aplikasi (SIMASRIM). 🙏

Kami mengapresiasi peran {{Nama Koperasi}} sebagai motor penggerak ekonomi masyarakat di wilayah Bapak/Ibu. Selaras dengan semangat penguatan ekonomi kerakyatan yang dicanangkan pemerintah, kami ingin memperkenalkan program yang dapat langsung memperkuat unit usaha koperasi tanpa mengganggu kegiatan simpan-pinjam yang sudah berjalan.

Program kami: *"Penambahan Unit Usaha Ritel Logistik & Loket Pembayaran Warga"* — dirancang khusus agar koperasi bisa melayani:
✅ Pengiriman barang warga & UMKM ke seluruh Indonesia (kurir resmi pickup langsung ke lokasi)
✅ Loket pembayaran tagihan harian warga (Listrik, PDAM, BPJS, Pulsa)
✅ Seluruh margin keuntungan langsung masuk kas koperasi

*Bergabung 100% Gratis. Tidak ada investasi modal, tidak ada biaya franchise.* Kami lampirkan proposal ringkas 1 halaman berikut sebagai bahan rapat pengurus.

Apakah kami diperkenankan untuk koordinasi lanjutan via WA atau tatap muka langsung? Terima kasih banyak atas perhatiannya. 🙏
👉 Info selengkapnya: http://dpj.smsrm.com/
📎 _[Lampiran: Proposal_B2B_SIMASRIM.pdf]_</pre>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-success fs-6">Kategori 3: Kopdes / Koperasi Mandiri</span>
                    <button class="btn-copy" onclick="copyText('wa3', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <p class="small text-muted fst-italic mb-2">Angle: Layanan baru untuk anggota desa, penguatan SHU, sistem mudah dioperasikan.</p>
                <div class="chat-bubble">
                    Selamat pagi, Bapak/Ibu Pengurus <strong>{{Nama Koperasi}}</strong> di <strong>{{Kota}}</strong>. Saya Dinda dari PT Solusi Mitra Aplikasi (SIMASRIM). 😊<br><br>
                    Kami ingin menawarkan peluang bagi <strong>{{Nama Koperasi}}</strong> untuk menambah unit bisnis baru yang bisa langsung memberikan manfaat nyata bagi seluruh anggota: <strong>Gerai Ritel Logistik & Pembayaran Tagihan</strong> berbasis digital.<br><br>
                    Dengan bergabung, kantor koperasi bisa sekaligus menjadi:<br>
                    ✅ Titik pengiriman paket resmi berbagai ekspedisi (anggota tidak perlu ke kota)<br>
                    ✅ Loket bayar tagihan rumah tangga (Listrik, PDAM, Pulsa, BPJS)<br>
                    ✅ Setiap transaksi menghasilkan margin keuntungan yang masuk ke SHU koperasi<br><br>
                    Sistemnya sangat mudah — cukup HP atau laptop yang sudah ada. Tim kami akan mendampingi staf Anda dari awal sampai benar-benar lancar, dan kami berikan <strong>Saldo Percobaan Gratis Rp 10.000</strong> untuk memulai tanpa risiko.<br><br>
                    Proposal singkat kami lampirkan berikut. Boleh kami jadwalkan obrolan singkat untuk menjelaskan lebih lanjut? Terima kasih! 🙏<br>
                    👉 Info selengkapnya: http://dpj.smsrm.com/<br>
                    📎 <i>[Lampiran: Proposal_B2B_SIMASRIM.pdf]</i>
                </div>
                <pre id="wa3" class="raw-text">Selamat pagi, Bapak/Ibu Pengurus {{Nama Koperasi}} di {{Kota}}. Saya Dinda dari PT Solusi Mitra Aplikasi (SIMASRIM). 😊

Kami ingin menawarkan peluang bagi {{Nama Koperasi}} untuk menambah unit bisnis baru yang bisa langsung memberikan manfaat nyata bagi seluruh anggota: *Gerai Ritel Logistik & Pembayaran Tagihan* berbasis digital.

Dengan bergabung, kantor koperasi bisa sekaligus menjadi:
✅ Titik pengiriman paket resmi berbagai ekspedisi (anggota tidak perlu ke kota)
✅ Loket bayar tagihan rumah tangga (Listrik, PDAM, Pulsa, BPJS)
✅ Setiap transaksi menghasilkan margin keuntungan yang masuk ke SHU koperasi

Sistemnya sangat mudah — cukup HP atau laptop yang sudah ada. Tim kami akan mendampingi staf Anda dari awal sampai benar-benar lancar, dan kami berikan *Saldo Percobaan Gratis Rp 10.000* untuk memulai tanpa risiko.

Proposal singkat kami lampirkan berikut. Boleh kami jadwalkan obrolan singkat untuk menjelaskan lebih lanjut? Terima kasih! 🙏
👉 Info selengkapnya: http://dpj.smsrm.com/
📎 _[Lampiran: Proposal_B2B_SIMASRIM.pdf]_</pre>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-success fs-6">Kategori 4: BUMDes / BUMK / BUMU</span>
                    <button class="btn-copy" onclick="copyText('wa4', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <p class="small text-muted fst-italic mb-2">Angle: Layanan yang belum pernah ada, dukung digitalisasi desa, UMKM desa bisa kirim nasional.</p>
                <div class="chat-bubble">
                    Selamat siang, Bapak/Ibu Direktur Pengelola <strong>{{Nama BUMDes}}</strong> <strong>{{Kota}}</strong>. Salam kenal, saya Dinda dari PT Solusi Mitra Aplikasi (SIMASRIM). 🙏<br><br>
                    Kami hadir untuk menawarkan satu peluang nyata bagi <strong>{{Nama BUMDes}}</strong>: menghadirkan <strong>layanan yang belum pernah ada sebelumnya di wilayah desa Anda</strong>, sekaligus mendukung target pemerintah dalam digitalisasi ekonomi pedesaan.<br><br>
                    Program kami: <strong>"Kemitraan Pusat Ritel Logistik & Loket Pembayaran Desa"</strong>:<br>
                    ✅ UMKM dan warga desa bisa kirim paket ke seluruh Indonesia — kurir resmi menjemput langsung ke desa<br>
                    ✅ Loket pembayaran tagihan digital (Token PLN, PDAM, BPJS, Pajak, Pulsa)<br>
                    ✅ Seluruh margin keuntungan masuk sebagai Pendapatan Asli Desa (PADes)<br>
                    ✅ Warga tidak perlu ke kota hanya untuk urusan pengiriman dan pembayaran<br><br>
                    <strong>Bergabung sepenuhnya gratis. Tidak ada investasi alat, tidak ada biaya bulanan.</strong> Sebagai gambaran awal, kami lampirkan proposal resmi 1 halaman berikut.<br><br>
                    Apakah unit usaha BUMDes terbuka untuk diskusi lanjutan via online atau kunjungan tim lapangan kami? Terima kasih banyak atas waktunya. 🙏<br>
                    👉 Info selengkapnya: http://dpj.smsrm.com/<br>
                    📎 <i>[Lampiran: Proposal_B2B_SIMASRIM.pdf]</i>
                </div>
                <pre id="wa4" class="raw-text">Selamat siang, Bapak/Ibu Direktur Pengelola {{Nama BUMDes}} {{Kota}}. Salam kenal, saya Dinda dari PT Solusi Mitra Aplikasi (SIMASRIM). 🙏

Kami hadir untuk menawarkan satu peluang nyata bagi {{Nama BUMDes}}: menghadirkan *layanan yang belum pernah ada sebelumnya di wilayah desa Anda*, sekaligus mendukung target pemerintah dalam digitalisasi ekonomi pedesaan.

Program kami: *"Kemitraan Pusat Ritel Logistik & Loket Pembayaran Desa"*:
✅ UMKM dan warga desa bisa kirim paket ke seluruh Indonesia — kurir resmi menjemput langsung ke desa
✅ Loket pembayaran tagihan digital (Token PLN, PDAM, BPJS, Pajak, Pulsa)
✅ Seluruh margin keuntungan masuk sebagai Pendapatan Asli Desa (PADes)
✅ Warga tidak perlu ke kota hanya untuk urusan pengiriman dan pembayaran

*Bergabung sepenuhnya gratis. Tidak ada investasi alat, tidak ada biaya bulanan.* Sebagai gambaran awal, kami lampirkan proposal resmi 1 halaman berikut.

Apakah unit usaha BUMDes terbuka untuk diskusi lanjutan via online atau kunjungan tim lapangan kami? Terima kasih banyak atas waktunya. 🙏
👉 Info selengkapnya: http://dpj.smsrm.com/
📎 _[Lampiran: Proposal_B2B_SIMASRIM.pdf]_</pre>
            </div>

            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-success fs-6">Kategori 5: LPTK Penyelenggara PPG</span>
                    <button class="btn-copy" onclick="copyText('wa5', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <p class="small text-muted fst-italic mb-2">Angle: Hemat biaya pengiriman modul + cuan dari selisih ongkir resmi vs harga peserta.</p>
                <div class="chat-bubble">
                    Selamat pagi, Tim Kerjasama/Humas <strong>{{Nama Universitas}}</strong>. Salam kenal, saya Dinda dari PT Solusi Mitra Aplikasi (SIMASRIM). 😊<br><br>
                    Kami mengetahui bahwa sebagai LPTK Penyelenggara Program Pendidikan Profesi Guru (PPG), lembaga Anda secara rutin menangani pengiriman modul, dokumen, dan berkas peserta dalam jumlah besar ke berbagai wilayah — yang tentu memakan anggaran logistik yang tidak sedikit setiap semesternya.<br><br>
                    Kami ingin menawarkan solusi yang bisa <strong>mengefisiensi biaya pengiriman sekaligus menjadi sumber pendapatan tambahan bagi kampus</strong>:<br><br>
                    ✅ Diskon ongkir resmi keagenan hingga 25% untuk semua pengiriman dokumen PPG<br>
                    ✅ Jika layanan dibuka untuk peserta/mahasiswa, selisih antara harga diskon dan harga normal menjadi margin pendapatan kampus<br>
                    ✅ Sistem pickup otomatis — kurir menjemput langsung ke sekretariat kampus, tanpa minimal kuota<br>
                    ✅ Dashboard terpusat untuk lacak semua resi pengiriman dalam satu layar<br><br>
                    <strong>Daftar 100% Gratis. Kami berikan Saldo Percobaan Rp 10.000 + pendampingan penuh sampai sistem berjalan lancar.</strong><br><br>
                    Proposal ringkas terlampir untuk bahan tinjauan institusi. Apakah kami bisa minta waktu 15 menit untuk diskusi singkat via WhatsApp/Zoom pekan ini? Terima kasih. 🙏<br>
                    👉 Info selengkapnya: http://dpj.smsrm.com/<br>
                    📎 <i>[Lampiran: Proposal_B2B_SIMASRIM.pdf]</i>
                </div>
                <pre id="wa5" class="raw-text">Selamat pagi, Tim Kerjasama/Humas {{Nama Universitas}}. Salam kenal, saya Dinda dari PT Solusi Mitra Aplikasi (SIMASRIM). 😊

Kami mengetahui bahwa sebagai LPTK Penyelenggara Program Pendidikan Profesi Guru (PPG), lembaga Anda secara rutin menangani pengiriman modul, dokumen, dan berkas peserta dalam jumlah besar ke berbagai wilayah — yang tentu memakan anggaran logistik yang tidak sedikit setiap semesternya.

Kami ingin menawarkan solusi yang bisa *mengefisiensi biaya pengiriman sekaligus menjadi sumber pendapatan tambahan bagi kampus*:

✅ Diskon ongkir resmi keagenan hingga 25% untuk semua pengiriman dokumen PPG
✅ Jika layanan dibuka untuk peserta/mahasiswa, selisih antara harga diskon dan harga normal menjadi margin pendapatan kampus
✅ Sistem pickup otomatis — kurir menjemput langsung ke sekretariat kampus, tanpa minimal kuota
✅ Dashboard terpusat untuk lacak semua resi pengiriman dalam satu layar

*Daftar 100% Gratis. Kami berikan Saldo Percobaan Rp 10.000 + pendampingan penuh sampai sistem berjalan lancar.*

Proposal ringkas terlampir untuk bahan tinjauan institusi. Apakah kami bisa minta waktu 15 menit untuk diskusi singkat via WhatsApp/Zoom pekan ini? Terima kasih. 🙏
👉 Info selengkapnya: http://dpj.smsrm.com/
📎 _[Lampiran: Proposal_B2B_SIMASRIM.pdf]_</pre>
            </div>

            <div class="mb-5 border-top pt-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-warning text-dark fs-6">HARI 3 - FOLLOW UP & SOCIAL PROOF (All B2B Target)</span>
                    <button class="btn-copy" onclick="copyText('wa_h3', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <div class="chat-bubble" id="wa_h3">
                    Halo Bapak/Ibu Pengurus <span class="wa-bold">{{Nama Institusi}}</span>, apa kabar hari ini? 😊<br><br>
                    Terkait proposal pembukaan unit usaha ritel logistik (Multi-Kurir & PPOB) yang Dinda infokan dua hari lalu, apakah sudah sempat ditinjau oleh jajaran pengurus?<br><br>
                    Sebagai informasi tambahan, sistem B2B SIMASRIM saat ini sudah diandalkan oleh berbagai instansi dan koperasi karena <span class="wa-bold">Sistem Keuangannya yang Transparan</span>. Tidak ada pencampuran dana, seluruh komisi transaksi masuk ke dashboard secara real-time dan bisa ditarik langsung ke rekening institusi kapan saja.<br><br>
                    Jika ada hal yang ingin ditanyakan seputar teknis pencairan komisi atau cara kerjanya, silakan balas pesan ini ya Pak/Bu. Dinda siap membantu menjelaskannya. 🙏
                </div>
                <pre id="wa_h3" class="raw-text">Halo Bapak/Ibu Pengurus *{{Nama Institusi}}*, apa kabar hari ini? 😊

Terkait proposal pembukaan unit usaha ritel logistik (Multi-Kurir & PPOB) yang Dinda infokan dua hari lalu, apakah sudah sempat ditinjau oleh jajaran pengurus?

Sebagai informasi tambahan, sistem B2B SIMASRIM saat ini sudah diandalkan oleh berbagai instansi dan koperasi karena *Sistem Keuangannya yang Transparan*. Tidak ada pencampuran dana, seluruh komisi transaksi masuk ke dashboard secara real-time dan bisa ditarik langsung ke rekening institusi kapan saja.

Jika ada hal yang ingin ditanyakan seputar teknis pencairan komisi atau cara kerjanya, silakan balas pesan ini ya Pak/Bu. Dinda siap membantu menjelaskannya. 🙏</pre>
            </div>

            <div class="mb-2 border-top pt-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-danger text-white fs-6">HARI 7 - URGENSI / FOMO (All B2B Target)</span>
                    <button class="btn-copy" onclick="copyText('wa_h7', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <div class="chat-bubble" id="wa_h7">
                    🚨 <span class="wa-bold">Pemberitahuan Terakhir Aktivasi Kemitraan SIMASRIM</span><br><br>
                    Yth. Pengelola <span class="wa-bold">{{Nama Institusi}}</span>,<br><br>
                    Mohon maaf mengganggu waktunya. Kami ingin menginformasikan bahwa kuota pendaftaran kemitraan institusi (B2B) dengan <span class="wa-bold">Fasilitas Gratis Saldo Modal Rp 10.000 + Pendampingan Tim IT Prioritas</span> untuk wilayah Anda akan kami tutup pendaftarannya pada sore hari ini pukul 15.00 WIB.<br><br>
                    Jangan lewatkan momentum emas ini untuk menghadirkan layanan logistik modern dan loket pembayaran mandiri di instansi Anda secara cuma-cuma.<br><br>
                    👉 Link Pendaftaran (Cukup 2 Menit): https://simasrim.com/kemitraan/form.php<br><br>
                    Jika pengurus belum bersedia mendaftar minggu ini, tidak apa-apa Bapak/Ibu. Silakan simpan kontak Dinda agar kelak jika institusi membutuhkan solusi logistik, bisa langsung menghubungi kami. Sukses selalu untuk {{Nama Institusi}}! 🤝
                </div>
                <pre id="wa_h7" class="raw-text">🚨 *Pemberitahuan Terakhir Aktivasi Kemitraan SIMASRIM*

Yth. Pengelola *{{Nama Institusi}}*,

Mohon maaf mengganggu waktunya. Kami ingin menginformasikan bahwa kuota pendaftaran kemitraan institusi (B2B) dengan *Fasilitas Gratis Saldo Modal Rp 10.000 + Pendampingan Tim IT Prioritas* untuk wilayah Anda akan kami tutup pendaftarannya pada sore hari ini pukul 15.00 WIB.

Jangan lewatkan momentum emas ini untuk menghadirkan layanan logistik modern dan loket pembayaran mandiri di instansi Anda secara cuma-cuma.

👉 Link Pendaftaran (Cukup 2 Menit): https://simasrim.com/kemitraan/form.php

Jika pengurus belum bersedia mendaftar minggu ini, tidak apa-apa Bapak/Ibu. Silakan simpan kontak Dinda agar kelak jika institusi membutuhkan solusi logistik, bisa langsung menghubungi kami. Sukses selalu untuk {{Nama Institusi}}! 🤝</pre>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #dc3545; border-top: none;">
            <div class="section-title-b2b text-danger"><i class="fas fa-envelope"></i> BAGIAN 4: Pipeline Email Blast B2B</div>
            <p class="text-muted small mb-4">Dikirim via MergeMail. Gunakan pendekatan formal corporate.</p>

            <h5 class="fw-bold mb-3 border-bottom pb-2">HARI 1 - Proposal Awal (Berdasarkan Kategori)</h5>

            <div class="mb-4">
                <h6 class="fw-bold text-dark"><span class="badge bg-danger me-2">Target 1</span>Jalur Koperasi (Kopkar / Kopma / KDMP / Kopdes)</h6>
                <div class="email-container shadow-sm">
                    <div class="email-header">
                        <div><strong class="text-danger">Subjek:</strong> Peluang Revenue Stream Baru untuk <span class="variable-badge">{{Nama Koperasi}}</span> — Tanpa Investasi Modal</div>
                        <button class="btn-copy text-nowrap ms-3" onclick="copyText('email1', this)"><i class="far fa-copy"></i> Salin Email</button>
                    </div>
                    <div class="email-body" id="email1">Yth. Dewan Pengurus {{Nama Koperasi}},

Dalam mengelola unit usaha koperasi, salah satu tantangan yang paling umum dihadapi pengurus adalah menemukan lini bisnis baru yang minim risiko namun mampu memberikan kontribusi nyata bagi kas organisasi — terutama tanpa harus menambah beban biaya sewa tempat atau merekrut staf baru.

PT Solusi Mitra Aplikasi (SIMASRIM) hadir dengan solusi yang langsung menjawab tantangan tersebut: **penambahan unit usaha ritel digital instan** yang cukup bermodalkan komputer dan internet yang sudah tersedia di kantor koperasi Anda.

Melalui kemitraan ini, {{Nama Koperasi}} dapat langsung mengoperasikan:
- Gerai pengiriman paket multi-kurir (SAPX, J&T, SPX, J&T Cargo, Paxel, Lion Parcel, Anteraja, ID Express, dll) dengan keuntungan margin resi hingga 25% per transaksi
- Loket pembayaran tagihan digital (PPOB: Listrik, PDAM, BPJS, Pulsa, Pajak, Tagihan Kendaraan) dengan biaya admin yang diatur secara mandiri oleh koperasi
- Loket pemesanan tiket resmi (Pesawat, Kereta KAI, Bus, Kapal Pelni)

Seluruh kemitraan ini bersifat **Zero Investment** — pendaftaran 100% gratis, tanpa biaya bulanan, tanpa franchise fee. Kami juga menyediakan program **Free Trial** berupa Bonus Saldo Awal Rp 10.000 yang didampingi langsung oleh tim operasional kami hingga transaksi pertama berhasil.

Terlampir kami sertakan **Proposal Resmi 1 Halaman** sebagai bahan peninjauan awal jajaran pengurus.

Apakah kami diperkenankan untuk meminta waktu diskusi singkat 15 menit via Zoom atau kunjungan langsung (untuk area Bogor & Jabodetabek) pekan ini?

Atas perhatian dan kerja samanya, kami ucapkan terima kasih.

Hormat kami,
**Raka — Business Support SIMASRIM**
PT Solusi Mitra Aplikasi
marketing.demo@contoh-perusahaan.demo | 0888-1726-053
📎 Lampiran: Proposal_B2B_SIMASRIM.pdf</div>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-dark"><span class="badge bg-danger me-2">Target 2</span>Jalur BUMDes / BUMK / BUMU</h6>
                <div class="email-container shadow-sm">
                    <div class="email-header">
                        <div><strong class="text-danger">Subjek:</strong> Ide Layanan Baru untuk <span class="variable-badge">{{Nama BUMDes}}</span>: Unit Usaha Logistik & Pembayaran Digital Desa</div>
                        <button class="btn-copy text-nowrap ms-3" onclick="copyText('email2', this)"><i class="far fa-copy"></i> Salin Email</button>
                    </div>
                    <div class="email-body" id="email2">Yth. Direktur Pengelola {{Nama BUMDes}},

Mendukung agenda pemerintah dalam memperkuat kemandirian ekonomi desa melalui digitalisasi unit usaha, kami dari PT Solusi Mitra Aplikasi (SIMASRIM) ingin memperkenalkan satu peluang yang dapat langsung menciptakan **layanan baru yang belum pernah ada sebelumnya** di wilayah desa Anda.

Program yang kami tawarkan: **Kemitraan Pusat Logistik Multi-Kurir & Loket Pembayaran Digital** — yang memungkinkan BUMDes untuk:
- Menjadi titik resmi pengiriman barang UMKM dan produk warga ke seluruh Indonesia, dengan sistem pickup kurir langsung ke desa (tanpa syarat minimal kuota paket harian)
- Mengelola loket pembayaran tagihan digital masyarakat (Token PLN, PDAM, BPJS, Pulsa, Pajak)
- Mendapatkan seluruh margin keuntungan resi dan biaya admin sebagai Pendapatan Asli Desa (PADes)

Kemitraan ini sepenuhnya **tanpa biaya pendaftaran, tanpa investasi perangkat**, dan tidak membutuhkan infrastruktur IT yang rumit. Guna memastikan kemudahan operasional, kami menyediakan **program Free Trial** beserta pendampingan intensif tim teknis kami hingga sistem berjalan lancar.

Terlampir kami sertakan **Proposal Resmi 1 Halaman** sebagai bahan tinjauan direksi dan rapat pengelola.

Kami terbuka untuk sesi diskusi singkat via Zoom maupun kunjungan lapangan tim kami ke BUMDes (khususnya wilayah Bogor dan sekitarnya). Apakah ada waktu yang bisa kami koordinasikan pekan ini?

Terima kasih atas perhatiannya.

Hormat kami,
**Raka — Business Support SIMASRIM**
PT Solusi Mitra Aplikasi
marketing.demo@contoh-perusahaan.demo | 0888-1726-053
📎 Lampiran: Proposal_B2B_SIMASRIM.pdf</div>
                </div>
            </div>

            <div class="mb-5">
                <h6 class="fw-bold text-dark"><span class="badge bg-danger me-2">Target 3</span>Jalur LPTK Penyelenggara PPG</h6>
                <div class="email-container shadow-sm">
                    <div class="email-header">
                        <div><strong class="text-danger">Subjek:</strong> Efisiensi Biaya Logistik & Potensi Margin Tambahan Pengiriman Dokumen PPG — <span class="variable-badge">{{Nama Universitas}}</span></div>
                        <button class="btn-copy text-nowrap ms-3" onclick="copyText('email3', this)"><i class="far fa-copy"></i> Salin Email</button>
                    </div>
                    <div class="email-body" id="email3">Yth. Tim Direktorat Kerjasama / Humas {{Nama Universitas}},

Kami memahami bahwa sebagai LPTK Penyelenggara Program Pendidikan Profesi Guru (PPG), salah satu pos pengeluaran operasional yang paling signifikan adalah biaya pengiriman dokumen fisik, modul pembelajaran, dan berkas kelulusan peserta PPG ke berbagai wilayah di seluruh Indonesia setiap semesternya.

PT Solusi Mitra Aplikasi (SIMASRIM) menawarkan solusi yang dapat **mengefisiensi anggaran logistik sekaligus membuka potensi pendapatan tambahan** bagi lembaga:

**Efisiensi Biaya:** Melalui akses resmi dashboard Multi-Kurir SIMASRIM, institusi langsung mendapatkan harga diskon keagenan logistik hingga 25% untuk seluruh pengiriman dokumen PPG — didukung kurir SAPX, J&T, SPX, J&T Cargo, Paxel, Lion Parcel, Anteraja, ID Express, dll.

**Potensi Pendapatan:** Jika layanan juga dibuka untuk peserta PPG atau mahasiswa umum, institusi dapat mengenakan harga ongkir standar kepada pengguna sementara menikmati harga diskon di sisi back-end — selisihnya menjadi margin pendapatan kampus.

**Sistem Pickup Otomatis:** Staf administrasi tidak perlu mengantar berkas ke gerai ekspedisi. Kurir resmi menjemput langsung ke sekretariat kampus, tanpa batas minimal kuota harian.

Seluruh kemitraan ini **100% Gratis** tanpa biaya keanggotaan. Kami menyediakan **Saldo Uji Coba Rp 10.000** dengan pendampingan penuh dari tim kami. Terlampir proposal resmi 1 halaman untuk bahan tinjauan institusi.

Apakah kami diperkenankan meminta waktu diskusi singkat 15 menit via Zoom atau kunjungan langsung (khusus area Bogor & Jabodetabek) pekan ini?

Terima kasih atas perhatian dan kerja samanya.

Hormat kami,
**Raka — Business Support SIMASRIM**
PT Solusi Mitra Aplikasi
marketing.demo@contoh-perusahaan.demo | 0888-1726-053
📎 Lampiran: Proposal_B2B_SIMASRIM.pdf</div>
                </div>
            </div>

            <div class="mb-5 border-top pt-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-info text-dark fs-6">HARI 3: ASSURANCE & SYSTEM DEMO (ALL TARGET)</span>
                    <button class="btn-copy" onclick="copyText('email_h3', this)"><i class="far fa-copy"></i> Salin Email</button>
                </div>
                <div class="email-container shadow-sm">
                    <div class="email-header">
                        <div><strong class="text-info text-dark">Subjek:</strong> Transparansi Keuangan & Jaminan Keamanan Sistem B2B SIMASRIM</div>
                    </div>
                    <div class="email-body" id="email_h3">Yth. Jajaran Manajemen {{Nama Institusi}},

Menyambung penawaran kemitraan strategis kami sebelumnya, kami memahami bahwa dalam penambahan unit bisnis digital, faktor keamanan dana dan kemudahan pelacakan transaksi adalah hal yang paling diawasi oleh institusi Anda.

Sistem Dashboard B2B SIMASRIM dirancang dengan standar enterprise:
- Auto-Reconciliation: Seluruh laporan transaksi, baik itu PPOB maupun resi kurir, tercatat secara presisi (real-time). Tim bendahara Anda dapat dengan mudah mengunduh laporan bulanan.
- Pemisahan Dana Aman: Saldo operasional dijamin keamanannya dan komisi penghasilan institusi dapat ditarik (*withdraw*) langsung ke rekening bank institusi tanpa potongan tersembunyi.
- Dukungan IT Khusus: Kami memberikan pendampingan grup WhatsApp khusus antara tim IT/Ops kami dengan staf operator Anda untuk menjamin kelancaran hari demi hari.

Apakah memungkinkan jika kita menjadwalkan sesi demonstrasi aplikasi singkat (online) agar kami bisa memperlihatkan betapa mudahnya sistem ini digunakan oleh staf Anda?

Hormat Kami,
Raka — Business Development SIMASRIM</div>
                </div>
            </div>

            <div class="mb-4 border-top pt-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-warning text-dark fs-6">HARI 7: MEETING INVITE & URGENCY (ALL TARGET)</span>
                    <button class="btn-copy" onclick="copyText('email_h7', this)"><i class="far fa-copy"></i> Salin Email</button>
                </div>
                <div class="email-container shadow-sm">
                    <div class="email-header">
                        <div><strong class="text-warning text-dark">Subjek:</strong> Konfirmasi Kuota Pendampingan B2B Prioritas <span class="variable-badge">{{Nama Institusi}}</span></div>
                    </div>
                    <div class="email-body" id="email_h7">Yth. Tim Manajemen {{Nama Institusi}},

Semoga email ini menemui Anda dalam keadaan baik dan sibuk dengan agenda positif institusi.

Terkait proposal pembukaan Unit Ritel Logistik dan PPOB (Zero Investment) yang kami ajukan, kami ingin menginformasikan bahwa kuota pendampingan prioritas IT dan alokasi Saldo Modal Awal Gratis untuk wilayah Anda akan difinalisasi pada akhir pekan ini.

Kami sangat berharap {{Nama Institusi}} dapat mengambil peran sebagai pionir layanan digital di wilayah Anda bersama SIMASRIM.

Untuk menghemat waktu pengurus, silakan melakukan registrasi awal mandiri (membutuhkan waktu 2 menit) melalui portal resmi kami: https://simasrim.com/kemitraan/form.php

Atau balas email ini untuk menentukan jadwal pertemuan online bersama tim Business Development kami. Terima kasih atas atensi dan waktunya.

Hormat Kami,
Raka — Business Development SIMASRIM</div>
                </div>
            </div>
        </div>

        <div class="section-divider"><span><i class="fas fa-headset me-2"></i>BAGIAN 5: PIPELINE CS (AKTIVASI & WIN-BACK)</span></div>

        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="mb-4">
                <strong class="text-dark d-block mb-1"><span class="badge" style="background:#6f42c1;">H+1 Setelah Daftar</span> - Pesan Onboarding & Test Drive</strong>
                <div class="d-flex justify-content-between align-items-start mt-2">
                    <div class="chat-bubble w-100 me-3">
                        Selamat datang <span class="wa-bold">Master Agen {{Nama Institusi}}</span>! 🎉<br><br>
                        Saya Winda dari Tim Ops SIMASRIM Pusat. Selamat, akun B2B institusi Bapak/Ibu sudah berstatus AKTIF dan siap digunakan untuk mencetak cuan! Saldo Uji Coba Rp 10.000 juga sudah kami top-up otomatis ke dashboard.<br><br>
                        Agar staf operasional/admin Bapak/Ibu bisa langsung beradaptasi, yuk kita tes mencetak resi pengiriman pertama atau tes transaksi PPOB hari ini! Buka dashboardnya di laptop/HP: dpj.smsrm.com<br><br>
                        Silakan simpan kontak Winda. Jika staf di lapangan bingung cara input paket, langsung chat ke sini agar Winda pandu pelan-pelan pakai panduan gambar. Sukses selalu untuk {{Nama Institusi}}! 🚀
                    </div>
                    <button class="btn-copy" onclick="copyText('cs_onboard', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <pre id="cs_onboard" class="raw-text">Selamat datang *Master Agen {{Nama Institusi}}*! 🎉

Saya Winda dari Tim Ops SIMASRIM Pusat. Selamat, akun B2B institusi Bapak/Ibu sudah berstatus AKTIF dan siap digunakan untuk mencetak cuan! Saldo Uji Coba Rp 10.000 juga sudah kami top-up otomatis ke dashboard.

Agar staf operasional/admin Bapak/Ibu bisa langsung beradaptasi, yuk kita tes mencetak resi pengiriman pertama atau tes transaksi PPOB hari ini! Buka dashboardnya di laptop/HP: dpj.smsrm.com

Silakan simpan kontak Winda. Jika staf di lapangan bingung cara input paket, langsung chat ke sini agar Winda pandu pelan-pelan pakai panduan gambar. Sukses selalu untuk {{Nama Institusi}}! 🚀</pre>
            </div>

            <div class="mb-0">
                <strong class="text-dark d-block mb-1"><span class="badge bg-secondary">H+30 Retensi</span> - Pesan Win-Back B2B Pasif</strong>
                <div class="d-flex justify-content-between align-items-start mt-2">
                    <div class="chat-bubble w-100 me-3">
                        Halo Bapak/Ibu Pengurus <span class="wa-bold">{{Nama Institusi}}</span>. Semoga operasional instansi berjalan lancar hari ini. 🙏<br><br>
                        Kami dari pengawasan pusat melihat bahwa dalam sebulan terakhir, akun B2B institusi Bapak/Ibu belum melakukan aktivitas transaksi pengiriman logistik maupun PPOB.<br><br>
                        Apakah staf pengelola mengalami kesulitan dalam memutar aplikasi kami? Atau apakah ada kendala/ketidaknyamanan terkait kurir penjemput kami di lapangan?<br><br>
                        Mohon berkenan memberikan masukannya kepada kami, agar kami bisa segera membantu menyelesaikan hambatannya, sehingga aliran komisi pendapatan untuk kas institusi Bapak/Ibu bisa kembali berjalan maksimal. Terima kasih banyak. 🤝
                    </div>
                    <button class="btn-copy" onclick="copyText('cs_winback', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <pre id="cs_winback" class="raw-text">Halo Bapak/Ibu Pengurus *{{Nama Institusi}}*. Semoga operasional instansi berjalan lancar hari ini. 🙏

Kami dari pengawasan pusat melihat bahwa dalam sebulan terakhir, akun B2B institusi Bapak/Ibu belum melakukan aktivitas transaksi pengiriman logistik maupun PPOB.

Apakah staf pengelola mengalami kesulitan dalam memutar aplikasi kami? Atau apakah ada kendala/ketidaknyamanan terkait kurir penjemput kami di lapangan?

Mohon berkenan memberikan masukannya kepada kami, agar kami bisa segera membantu menyelesaikan hambatannya, sehingga aliran komisi pendapatan untuk kas institusi Bapak/Ibu bisa kembali berjalan maksimal. Terima kasih banyak. 🤝</pre>
            </div>
        </div>

        <div class="accordion mb-5" id="accordionCadangan">
            <div class="accordion-item border border-dark border-opacity-25" style="border-radius: 16px; overflow: hidden;">
                <h2 class="accordion-header">
                    <button class="accordion-button bg-dark bg-opacity-10 text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePivot" style="font-size: 1.05rem;">
                        <i class="fas fa-random me-2"></i> BAGIAN 6: ALUR CADANGAN (PLAN B) - Pivot PPOB & Referral
                    </button>
                </h2>
                <div id="collapsePivot" class="accordion-collapse collapse" data-bs-parent="#accordionCadangan">
                    <div class="accordion-body bg-white p-4">
                        <div class="alert alert-secondary py-2 px-3 small mb-4">
                            <i class="fas fa-info-circle me-1"></i> <strong>SOP PIVOT B2B:</strong> Kirim draf ini JIKA institusi menolak mengaktifkan unit ekspedisi logistik (misal: "Kami tidak punya staf untuk ngurus lakban paket"). Kita belokkan fokus 100% ke PPOB & Referral.
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong class="text-dark">Draf Balasan Pivot (via WA/Email)</strong>
                            <button class="btn btn-sm btn-dark fw-bold" onclick="copyText('raw_b2b_pivot', this)">Salin Draf Pivot</button>
                        </div>
                        
                        <div class="chat-bubble border-dark bg-light">
                            Siap, kami sangat memahami jika manajemen <span class="wa-bold">{{Nama Institusi}}</span> saat ini belum siap menambah unit usaha operasional fisik seperti pengiriman paket logistik. 👍<br><br>
                            Namun kami memiliki <span class="wa-bold">Opsi Kedua yang 100% Bebas Operasional Fisik</span>, yaitu: memfungsikan akun SIMASRIM secara eksklusif hanya untuk fitur <span class="wa-bold">Loket PPOB & Titip Jaringan (Referral)</span>.<br><br>
                            Keuntungannya untuk institusi:<br>
                            - <span class="wa-bold">Loket Digital Warga/Anggota:</span> Institusi bisa melayani pembelian token listrik, pulsa, dan tagihan bulanan anggota. Anda mengatur margin keuntungan (admin) sendiri.<br>
                            - <span class="wa-bold">Program B2B Referral:</span> Cukup sebar link pendaftaran dari menu "Jaringan TJS" di aplikasi kepada instansi atau UMKM lain yang Bapak/Ibu kenal. Jika mereka menggunakan layanan logistik kami, institusi Anda akan terus mendapatkan komisi *passive income* seumur hidup dari transaksi mereka tanpa Anda harus mengurus 1 paket pun!<br><br>
                            Jika opsi tanpa ribet operasional fisik ini lebih masuk akal untuk dijalankan saat ini, silakan balas pesan ini agar kami bisa bantu aktivasi saldo modal awalnya. 💸
                        </div>
                        <pre id="raw_b2b_pivot" class="raw-text">Siap, kami sangat memahami jika manajemen *{{Nama Institusi}}* saat ini belum siap menambah unit usaha operasional fisik seperti pengiriman paket logistik. 👍

Namun kami memiliki *Opsi Kedua yang 100% Bebas Operasional Fisik*, yaitu: memfungsikan akun SIMASRIM secara eksklusif hanya untuk fitur *Loket PPOB & Titip Jaringan (Referral)*.

Keuntungannya untuk institusi:
- *Loket Digital Warga/Anggota:* Institusi bisa melayani pembelian token listrik, pulsa, dan tagihan bulanan anggota. Anda mengatur margin keuntungan (admin) sendiri.
- *Program B2B Referral:* Cukup sebar link pendaftaran dari menu "Jaringan TJS" di aplikasi kepada instansi atau UMKM lain yang Bapak/Ibu kenal. Jika mereka menggunakan layanan logistik kami, institusi Anda akan terus mendapatkan komisi passive income seumur hidup dari transaksi mereka tanpa Anda harus mengurus 1 paket pun!

Jika opsi tanpa ribet operasional fisik ini lebih masuk akal untuk dijalankan saat ini, silakan balas pesan ini agar kami bisa bantu aktivasi saldo modal awalnya. 💸</pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #17a2b8; border-top: none;">
            <div class="section-title-b2b text-info"><i class="fas fa-shield-alt"></i> BAGIAN 7: Objection Handling Komprehensif</div>
            <p class="text-muted small mb-4">Digunakan oleh standby CS saat membalas respons masuk. Template balasan WA bisa langsung dicopy-paste.</p>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light border rounded h-100">
                        <strong class="text-dark d-block mb-1">❓ Skenario A — Tidak Ada Staf Khusus / SDM Terbatas</strong>
                        <p class="small text-muted fst-italic mb-2">"Menarik, tapi kami tidak punya staf khusus. Staf kami sudah sibuk semua."</p>
                        <div class="chat-bubble cs-reply mb-0 w-100">
                            Jangan khawatir, Kak/Bapak/Ibu. SIMASRIM memang dirancang dengan prinsip "Mudah dan Murah" — tampilannya sangat sederhana dan menggunakan Bahasa Indonesia yang awam sekalipun langsung bisa mengerti.<br><br>
                            Di koperasi/instansi mitra kami, tugas penginputan paket bahkan biasa didelegasikan ke rekan OB di sela-sela waktu luang mereka — tidak mengganggu staf inti sama sekali.<br><br>
                            Plus, kami dampingi staf Anda dari nol sampai benar-benar lancar, gratis, sampai transaksi pertama berhasil. Mau coba dulu dengan saldo gratis Rp 10.000 dari kami? 🙏
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light border rounded h-100">
                        <strong class="text-dark d-block mb-1">❓ Skenario B — Harus Melalui RAT / Birokrasi Internal</strong>
                        <p class="small text-muted fst-italic mb-2">"Setiap keputusan penambahan unit bisnis harus melalui Rapat Anggota Tahunan (RAT) dulu."</p>
                        <div class="chat-bubble cs-reply mb-0 w-100">
                            Untuk poin itu Bapak/Ibu tidak perlu khawatir. Kemitraan SIMASRIM tidak memungut biaya pendaftaran, tidak ada investasi modal, dan tidak ada biaya bulanan sama sekali.<br><br>
                            Karena tidak ada dana kas koperasi yang dikeluarkan, program ini tidak termasuk dalam kategori keputusan pengeluaran anggaran yang perlu menunggu RAT. Sifatnya murni sebagai fasilitas pelengkap gratis untuk anggota.<br><br>
                            Pengurus bisa mengaktifkan akun Free Trial hari ini untuk mencoba dulu, nanti baru kita bawa hasil trial-nya ke pengurus lain sebagai bahan presentasi di rapat berikutnya. 😊
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light border rounded h-100">
                        <strong class="text-dark d-block mb-1">❓ Skenario C — Sudah Ada Mitra Kurir Sebelumnya</strong>
                        <p class="small text-muted fst-italic mb-2">"Kami sudah kerja sama resmi dengan POS Indonesia / kurir X. Apakah itu akan bermasalah?"</p>
                        <div class="chat-bubble cs-reply mb-0 w-100">
                            Sama sekali tidak bermasalah, Kak. Kemitraan SIMASRIM bersifat independen — tidak ada klausul eksklusivitas yang mengharuskan Kakak menutup kerja sama yang sudah berjalan sebelumnya.<br><br>
                            Justru sebaliknya: SIMASRIM melengkapi pilihan kurir yang tersedia. Jika anggota/nasabah Kakak butuh kurir swasta seperti Lion Parcel, J&T, atau SAPX yang belum tercover oleh mitra sebelumnya, SIMASRIM bisa langsung melayaninya dalam satu dashboard yang sama.<br><br>
                            Lebih banyak pilihan = lebih banyak transaksi = kas koperasi makin bertambah. 💪
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light border rounded h-100">
                        <strong class="text-dark d-block mb-1">❓ Skenario D — Khawatir Soal Tata Ruang & Spanduk</strong>
                        <p class="small text-muted fst-italic mb-2">"Tempat kami terbatas. Tidak mungkin pasang banyak spanduk dari berbagai ekspedisi di toko kami."</p>
                        <div class="chat-bubble cs-reply mb-0 w-100">
                            Poin yang sangat bagus! Dan kabar baiknya, SIMASRIM fokus sebagai "Tambahan Usaha Digital" — tidak ada kewajiban memasang spanduk dari masing-masing ekspedisi.<br><br>
                            Semua kurir (SAPX, J&T, SPX, J&T Cargo, Paxel, Lion Parcel, Anteraja, ID Express, dll) sudah menyatu dalam satu layar aplikasi. Tidak perlu renovasi tampilan toko sama sekali.<br><br>
                            Kalau suatu saat Kakak ingin ada penanda fisik agar anggota tahu ada layanan baru, kami punya opsi paket branding minimalis yang ukurannya bisa disesuaikan. Tapi itu opsional sepenuhnya — tidak wajib.
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light border rounded h-100">
                        <strong class="text-dark d-block mb-1">❓ Skenario E — Kapasitas SDM Desa Rendah (Gaptek)</strong>
                        <p class="small text-muted fst-italic mb-2">"Operator kami orang desa yang tidak terlalu paham teknologi. Takut salah input dan rugi."</p>
                        <div class="chat-bubble cs-reply mb-0 w-100">
                            Justru untuk kondisi itulah skema Free Trial kami hadir, Pak/Bu Direktur. Kami berikan Bonus Saldo Awal Rp 10.000 khusus sebagai "lapangan latihan" — jadi kalau ada kesalahan input di tahap awal pun, yang terpakai hanya saldo latihan, bukan uang BUMDes.<br><br>
                            Tim operasional kami akan mendampingi operator desa Anda pelan-pelan via chat + panduan bergambar, selangkah demi selangkah, sampai benar-benar mahir dan transaksi pertama berjalan aman. Sudah banyak mitra kami di desa yang awalnya gaptek, sekarang sudah lancar setiap hari. 🙏
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light border rounded h-100">
                        <strong class="text-dark d-block mb-1">❓ Skenario F — Meragukan Jangkauan Kurir ke Desa</strong>
                        <p class="small text-muted fst-italic mb-2">"Desa kami jauh dari jalan raya kota. Apa kurir benar-benar mau jemput ke sini?"</p>
                        <div class="chat-bubble cs-reply mb-0 w-100">
                            Ini pertanyaan yang paling sering ditanyakan, dan jawabannya: <strong>Ya, kurir pasti masuk dan jemput!</strong> Ini bukan janji lisan kami — ini sudah menjadi bagian dari sistem API yang terintegrasi langsung dengan manajemen pusat ekspedisi.<br><br>
                            Begitu resi dicetak di loket BUMDes, kurir resmi yang memegang rute wilayah desa Kakak otomatis menerima perintah penjemputan. Tidak ada batas minimal kuota — satu paket pun akan dijemput tanpa biaya tambahan.<br><br>
                            Ini justru yang menjadi nilai utama layanan kami: warga desa tidak perlu lagi ke kota hanya untuk kirim paket. 🚀
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light border rounded h-100">
                        <strong class="text-dark d-block mb-1">❓ Skenario G — Kekhawatiran Modal Mengendap</strong>
                        <p class="small text-muted fst-italic mb-2">"Apakah harus deposit dana besar di awal untuk memulai?"</p>
                        <div class="chat-bubble cs-reply mb-0 w-100">
                            Tidak ada kewajiban deposit besar, Bapak/Ibu. Saldo SIMASRIM bersifat sangat fleksibel — bisa diisi sesuai kebutuhan transaksi saat itu saja.<br><br>
                            Bahkan untuk memulai, kami yang menyediakan Saldo Awal Rp 10.000 secara gratis sebagai uji coba. Tidak perlu mengeluarkan sepeser pun di tahap awal. Setelah yakin dengan sistemnya, pengisian saldo berikutnya bisa disesuaikan murni dengan volume transaksi harian yang berjalan.
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light border rounded h-100">
                        <strong class="text-dark d-block mb-1">❓ Skenario H — Meragukan Legalitas SIMASRIM</strong>
                        <p class="small text-muted fst-italic mb-2">"Boleh minta profil perusahaan atau bukti kemitraan resmi terpercaya?"</p>
                        <div class="chat-bubble cs-reply mb-0 w-100">
                            Tentu, dengan senang hati! PT Solusi Mitra Aplikasi (SIMASRIM) adalah perusahaan teknologi logistik yang sudah beroperasi dan memiliki integrasi resmi API dengan ekspedisi-ekspedisi besar nasional.<br><br>
                            Beberapa tautan resmi yang bisa Bapak/Ibu tinjau:<br>
                            - Website resmi: simasrim.com<br>
                            - Dokumen Panduan: dpj.smsrm.com<br>
                            - Email resmi: marketing.demo@contoh-perusahaan.demo<br><br>
                            Jika dibutuhkan salinan dokumen legalitas perusahaan (SIUP, NIB, dll.), kami bisa kirimkan langsung melalui email resmi kami. Boleh dikonfirmasi alamat email yang dituju? 🙏
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-divider"><span><i class="fas fa-spider me-2"></i> BAGIAN 8: Panduan Scraping Data</span></div>
        <div class="step-card" style="border-top: 5px solid #6f42c1;">
        
        <div class="row g-4 mb-0">
            <div class="col-md-12">
                <div class="p-3 bg-light border rounded h-100 shadow-sm">
                    <strong class="text-dark d-block mb-1"><span class="badge me-2" style="background-color: #6f42c1;">1</span>LPTK Penyelenggara PPG</strong>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-secondary border border-secondary">Manual</span>
                        <a href="https://ppg.kemendikdasmen.go.id/page/info-lptk" target="_blank" class="small fw-bold text-decoration-none">https://ppg.kemendikdasmen.go.id/page/info-lptk</a>
                    </div>
                    <ol class="small text-muted mb-0 ps-3" style="line-height: 1.6;">
                        <li class="mb-1">Buka Halaman Web LPTK.</li>
                        <li class="mb-1">Klik pada nama <strong>Universitas</strong> yang dituju.</li>
                        <li class="mb-1">Cek halaman web resmi masing-masing universitas.</li>
                        <li>Cari dan catat data <strong>Kontak WA & Email</strong> yang tersedia.</li>
                    </ol>
                </div>
            </div>

            <div class="col-md-12">
                <div class="p-3 bg-light border rounded h-100 shadow-sm">
                    <strong class="text-dark d-block mb-1"><span class="badge me-2" style="background-color: #6f42c1;">2</span>Koperasi Merah Putih (KDMP) Kabupaten Bogor</strong>
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="badge bg-info text-dark border border-info">Web Scrap</span>
                        <a href="https://kdkmp.bogorkab.go.id/" target="_blank" class="small fw-bold text-decoration-none">https://kdkmp.bogorkab.go.id/</a>
                    </div>
                    <ol class="small text-muted mb-0 ps-3" style="line-height: 1.6;">
                        <li class="mb-1">Instal <a href="https://chromewebstore.google.com/detail/web-scraper-free-web-scra/jnhgnonknehpejjnehehllkliplmbmhn" target="_blank" class="fw-bold">Ekstensi Web Scraper Free</a> di Chrome.</li>
                        <li class="mb-1">Buka web, Scroll ke bagian Sebaran Koperasi Merah Putih Kabupaten Bogor, klik kecamatan (dari sini dilakukan per kecamatan dengan total 40 kecamatan).</li>
                        <li class="mb-1">Buka ekstensi web scraper, data muncul di Fase <strong>Data Setup</strong> lalu klik continue, pagination & scroll cukup continue.</li>
                        <li class="mb-1">Pada fase <strong>Follow Item Link</strong> klik Select Link dan klik pada nama desa lalu klik Done Selecting dan klik lagi Continue.</li>
                        <li class="mb-1">Di <strong>Item Page Data</strong> tunggu data gambaran di extract lalu jika sudah bisa klik X pada data-data yang tidak dibutuhkan semisal Logo, Simbol Sosmed, dsb. lalu klik Continue.</li>
                        <li class="mb-1">Pada fase <strong>Scrape</strong> klik tombol Scrape The Page dan biarkan berproses dengan sendirinya.</li>
                        <li>Setelah selesai data bisa di download dengan format xlsx atau csv.</li>
                    </ol>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light border rounded h-100 shadow-sm">
                    <strong class="text-dark d-block mb-1"><span class="badge me-2" style="background-color: #6f42c1;">3</span>Kopdes / simkopdes.go.id (tidak ada)</strong>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-success border border-success">Maps</span>
                    </div>
                    <p class="small text-muted mb-0">Pakai metode <a href="https://mkt.smsrm.com/campaign/scraping_data.php" target="_blank" class="fw-bold">Tutorial Scraping Data</a> dengan kata kunci <strong>Kopdes [Area]</strong>.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light border rounded h-100 shadow-sm">
                    <strong class="text-dark d-block mb-1"><span class="badge me-2" style="background-color: #6f42c1;">4</span>BUMDes</strong>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-success border border-success">Maps</span>
                    </div>
                    <p class="small text-muted mb-0">Pakai metode <a href="https://mkt.smsrm.com/campaign/scraping_data.php" target="_blank" class="fw-bold">Tutorial Scraping Data</a> dengan kata kunci <strong>Bumdes [Area]</strong>.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light border rounded h-100 shadow-sm">
                    <strong class="text-dark d-block mb-1"><span class="badge me-2" style="background-color: #6f42c1;">5</span>BUMK</strong>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-primary border border-primary">Google</span>
                    </div>
                    <ol class="small text-muted mb-0 ps-3" style="line-height: 1.6;">
                        <li class="mb-1">Buka Google Search.</li>
                        <li class="mb-1">Cari dengan kata kunci <strong>BUMK [Area]</strong>.</li>
                        <li class="mb-1">Buka website/tautan yang relevan dari hasil pencarian.</li>
                        <li>Cek halaman web tersebut untuk mencari <strong>Kontak WA & Email</strong>.</li>
                    </ol>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light border rounded h-100 shadow-sm">
                    <strong class="text-dark d-block mb-1"><span class="badge me-2" style="background-color: #6f42c1;">6</span>BUMU</strong>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-primary border border-primary">Google</span>
                    </div>
                    <ol class="small text-muted mb-0 ps-3" style="line-height: 1.6;">
                        <li class="mb-1">Buka Google Search.</li>
                        <li class="mb-1">Cari dengan kata kunci <strong>BUMU [Area/Tanpa]</strong>.</li>
                        <li class="mb-1">Buka website yang relevan dari hasil pencarian.</li>
                        <li>Cek seluruh halaman web untuk menemukan data <strong>Kontak WA & Email</strong>.</li>
                    </ol>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light border rounded h-100 shadow-sm">
                    <strong class="text-dark d-block mb-1"><span class="badge me-2" style="background-color: #6f42c1;">7</span>Kopkar</strong>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-primary border border-primary">Google</span> 
                        <span class="badge bg-success border border-success">Maps</span>
                    </div>
                    <ul class="small text-muted mb-0 ps-3" style="line-height: 1.6;">
                        <li class="mb-2"><strong>Google:</strong> Buka Google, Cari <strong>Kopkar [Area/Tanpa]</strong>, klik web relevan, lalu cari Kontak WA & Email.</li>
                        <li><strong>Maps:</strong> Ikuti <a href="https://mkt.smsrm.com/campaign/scraping_data.php" target="_blank" class="fw-bold">Tutorial Scraping Data</a> dengan kata kunci <strong>Kopkar [Area/Tanpa]</strong>.</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light border rounded h-100 shadow-sm">
                    <strong class="text-dark d-block mb-1"><span class="badge me-2" style="background-color: #6f42c1;">8</span>Kopma</strong>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-primary border border-primary">Google</span> 
                        <span class="badge bg-success border border-success">Maps</span>
                    </div>
                    <ul class="small text-muted mb-0 ps-3" style="line-height: 1.6;">
                        <li class="mb-2"><strong>Google:</strong> Buka Google, Cari <strong>Kopma [Area/Tanpa]</strong>, klik web relevan, lalu cari Kontak WA & Email.</li>
                        <li><strong>Maps:</strong> Ikuti <a href="https://mkt.smsrm.com/campaign/scraping_data.php" target="_blank" class="fw-bold">Tutorial Scraping Data</a> dengan kata kunci <strong>Kopma [Area/Tanpa]</strong>.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-4 p-3 bg-warning bg-opacity-10 border border-warning rounded">
            <strong class="text-dark d-block mb-1"><i class="fas fa-exclamation-circle text-warning me-1"></i> Catatan Khusus Maps:</strong>
            <p class="small text-muted mb-0">Untuk target bertanda <strong>[Area/Tanpa]</strong> pada metode Maps: Cukup menyesuaikan (zoom in/out) ukuran wilayah target secara langsung di peta Google Maps tanpa perlu menyebutkan nama area pada kata kuncinya.</p>
        </div>
        </div>


        <div class="step-card" style="border-left-color: #28a745; border-top: none;">
            <div class="section-title-b2b text-success"><i class="fas fa-file-contract"></i> BAGIAN 9: Alur Pendaftaran & Persyaratan Akun</div>
            <p class="text-muted small mb-4">Gunakan tautan pendaftaran dan kumpulkan formulir data sesuai jalur akuisisi prospek (KYC/KYB).</p>
            <div class="alert alert-secondary bg-light border shadow-sm mb-4">
                <div class="d-flex align-items-start gap-3">
                    <i class="fas fa-address-card fs-3 text-secondary mt-1"></i>
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Data Akun Standar (Wajib Semua Jalur)</h6>
                        <p class="small text-muted mb-0" style="line-height: 1.6;">Untuk pembuatan akun dasar, pastikan selalu melampirkan/meminta: <strong>Nama PIC/Pendaftar, No. HP (WA) Aktif, Email Utama, dan Alamat Hub/Instansi.</strong> <br><i>(Jika butuh data di luar ini, akan diminta menyusul).</i></p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 bg-white border border-2 border-success rounded-4 shadow-sm h-100 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h6 class="fw-bold text-success mb-0"><i class="fas fa-store me-2"></i>Jalur A: "Bisnis Dalam Kotak"</h6>
                            <span class="badge bg-success shadow-sm"><i class="fas fa-star text-warning me-1"></i> Campaign</span>
                        </div>
                        <p class="small text-muted mb-4 pb-3 border-bottom"><strong>Target:</strong> Koperasi (Kopkar, Kopma, Kopdes), BUMDes, Jaringan Toko Retail, LPTK.</p>
                        
                        <strong class="d-block text-dark small mb-2"><i class="fas fa-link text-primary me-1"></i> Tautan Pendaftaran:</strong>
                        <a href="https://simasrim.com/kemitraan/form.php" target="_blank" class="d-block mb-4 p-2 bg-light border border-secondary border-opacity-25 rounded text-center small fw-bold text-success text-decoration-none" style="transition: 0.2s;">simasrim.com/kemitraan/form.php</a>
                        
                        <strong class="d-block text-dark small mb-2"><i class="fas fa-folder-open text-warning me-1"></i> Data Legalitas Khusus (Fase 3):</strong>
                        <ul class="small text-muted ps-0 mb-0" style="list-style: none;">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Nama Lembaga / Koperasi / BUMDes</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Estimasi Jumlah Anggota (Captive Market)</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>KTP PIC yang ditunjuk</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>NPWP Lembaga & NIB/Surat Izin (Sesuai Skala)</li>
                            <li><i class="fas fa-check text-success me-2"></i>Rekening Bank Lembaga (Pencairan komisi)</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-4 bg-white border border-2 border-primary rounded-4 shadow-sm h-100 d-flex flex-column">
                        <div class="mb-3">
                            <h6 class="fw-bold text-primary mb-0"><i class="fas fa-code me-2"></i>Jalur B: Integrasi API</h6>
                        </div>
                        <p class="small text-muted mb-4 pb-3 border-bottom"><strong>Target:</strong> Startup, Aplikasi Kasbon/EWA, E-Commerce, Platform Digital.</p>
                        
                        <strong class="d-block text-dark small mb-2"><i class="fas fa-link text-primary me-1"></i> Tautan Pendaftaran:</strong>
                        <a href="https://simasrim.com/b2b/api.php" target="_blank" class="d-block mb-4 p-2 bg-light border border-secondary border-opacity-25 rounded text-center small fw-bold text-primary text-decoration-none" style="transition: 0.2s;">simasrim.com/b2b/api.php</a>
                        
                        <strong class="d-block text-dark small mb-2"><i class="fas fa-folder-open text-warning me-1"></i> Data Legalitas Khusus (Fase 3):</strong>
                        <ul class="small text-muted ps-0 mb-0" style="list-style: none;">
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Nama Aplikasi / Platform</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Layanan diminati (Logistik / PPOB / Keduanya)</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Penandatanganan NDA (Kerahasiaan Data)</li>
                            <li><i class="fas fa-check text-primary me-2"></i>Penandatanganan PKS (SLA Server & UU PDP)</li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="p-4 bg-dark border border-secondary rounded-4 shadow-sm d-flex align-items-center gap-4 flex-wrap flex-md-nowrap">
                        <div class="bg-black p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; flex-shrink: 0; border: 1px solid #444;">
                            <i class="fas fa-user-secret fs-3 text-warning"></i>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <h6 class="fw-bold text-warning mb-0">Jalur Khusus (Secret Menu): White Label</h6>
                                <span class="badge bg-danger">Strictly Confidential</span>
                            </div>
                            <p class="small text-white-50 mb-0" style="line-height: 1.6;">HANYA diberikan secara tertutup via <a href="https://simasrim.com/b2b/form-wl.php" target="_blank" class="text-info fw-bold text-decoration-none">simasrim.com/b2b/form-wl.php</a> jika klien memaksa pakai brand mereka sendiri & siap membayar <i>Setup Fee</i>/Lisensi. Wajib lolos <i>screening</i> ketat Tim Partnership pusat (NDA Wajib).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
    function copyText(id, btn) {
        let text = document.getElementById(id).textContent || document.getElementById(id).innerText;
        let temp = document.createElement("textarea");
        temp.value = text;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        document.body.removeChild(temp);
        
        let originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Disalin!';
        btn.classList.add('bg-success', 'text-white', 'border-success');
        setTimeout(() => { 
            btn.innerHTML = originalText; 
            btn.classList.remove('bg-success', 'text-white', 'border-success'); 
        }, 2000);
    }
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>