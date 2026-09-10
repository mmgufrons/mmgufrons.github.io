<?php 
$page_title = "Active Blueprint Mei 2026 #3 | SIMASRIM CS";
$footer_desc = "Dokumen Internal Terbatas - Divisi Customer Service & Marketing.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>

<style>
    .step-card {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.08);
        border-left: 5px solid var(--primary);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .step-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    }
    .step-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }
    .chat-bubble {
        background: #f8f9fa;
        border-radius: 0 12px 12px 12px;
        padding: 1.2rem;
        border: 1px solid #e9ecef;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        line-height: 1.6;
        font-size: 0.95rem;
    }
    .wa-bold { font-weight: 700; color: #000; }
    .wa-italic { font-style: italic; }
    .raw-wa-text { display: none !important; }
    .btn-copy {
        background: white;
        border: 1px solid #ced4da;
        color: #495057;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-copy:hover {
        background: #e9ecef;
        color: #212529;
    }
    .btn-copy.copied {
        background: var(--wa-green, #25D366);
        border-color: var(--wa-green, #25D366);
        color: white;
    }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25"><i class="fa-solid fa-calendar-week me-2"></i>Active Blueprint</span>
        <h2 class="display-5 fw-bold mb-2">Pekan "Ekspansi Kurir & PPOB Ultimate"</h2>
        <p class="text-white-50 mb-0">Periode: 18 - 23 Mei 2026<br>Fokus Utama: Launching ID Express & Anteraja, Push Layanan Non-Pengiriman, & Timeline SIMASRIM Rewards.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">
        
        <div class="text-center mb-5">
            <h3 class="fw-bold text-dark"><i class="fas fa-bullhorn me-2 text-primary"></i>Channel Pengumuman (Umum)</h3>
            <p class="text-muted">Broadcast ke seluruh channel info utama (Senin - Kamis).</p>
        </div>

        <div class="step-card">
            <div class="step-header">
                <div>
                    <span class="badge bg-danger mb-1">Senin, 18 Mei - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Launch Kurir Baru: ID Express & Anteraja</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_senin', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                🚀 <strong>DUA EKSPEDISI BARU RESMI MENGASPAL DI SIMASRIM!</strong> 🚀<br><br>
                Pagi Agen tangguh! Sesuai janji Mimin minggu lalu, hari ini kita resmi kedatangan DUA armada baru yang siap bantu meroketkan omzet loket Kakak!<br><br>
                ✅ <strong>ID EXPRESS:</strong> Solusi kirim paket dengan harga super hemat dan jangkauan luas. Cocok banget ditawarin ke <i>seller online</i>!<br>
                ✅ <strong>ANTERAJA:</strong> Jagoannya layanan reguler dan <i>next-day</i> yang sat-set sat-set langsung sampai!<br><br>
                Makin banyak pilihan, pelanggan makin seneng. Yuk langsung cobain buat resi pertamanya pakai dua ekspedisi ini. Kurir siap <i>pickup</i> langsung ke loket Kakak! 📦✨
            </div>
            <pre id="raw_senin" class="raw-wa-text">🚀 *DUA EKSPEDISI BARU RESMI MENGASPAL DI SIMASRIM!* 🚀

Pagi Agen tangguh! Sesuai janji Mimin minggu lalu, hari ini kita resmi kedatangan DUA armada baru yang siap bantu meroketkan omzet loket Kakak!

✅ *ID EXPRESS:* Solusi kirim paket dengan harga super hemat dan jangkauan luas. Cocok banget ditawarin ke _seller online_!
✅ *ANTERAJA:* Jagoannya layanan reguler dan _next-day_ yang sat-set sat-set langsung sampai!

Makin banyak pilihan, pelanggan makin seneng. Yuk langsung cobain buat resi pertamanya pakai dua ekspedisi ini. Kurir siap _pickup_ langsung ke loket Kakak! 📦✨</pre>
        </div>

        <div class="step-card" style="border-left-color: #dc3545;">
            <div class="step-header">
                <div>
                    <span class="badge bg-danger mb-1">Selasa, 19 Mei - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Pemberitahuan Penonaktifan JNE</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa_pagi', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                Halo Kak! 👋<br>
                <strong>Pemberitahuan informasi penting untuk kelancaran operasional pengiriman Kakak hari ini dan kedepan.</strong><br><br>
                Saat ini, layanan pengiriman <strong>JNE</strong> di aplikasi SIMASRIM sedang dinonaktifkan sementara waktu (hingga batas waktu yang belum bisa ditentukan). Hal ini dikarenakan adanya pemeliharaan dan pembaruan sistem integrasi (system upgrade) bersama, guna memastikan keamanan dan kenyamanan data transaksi seluruh pengguna kami ke depannya.<br><br>
                Namun Kakak tidak perlu khawatir! 🚀 Operasional pengiriman Kakak tetap bisa berjalan lancar jaya. Kakak bisa langsung mengalihkan pengiriman menggunakan layanan dari mitra ekspedisi andalan kami lainnya yang siap melakukan Pick-Up ke lokasi, seperti:<br>
                - ✅ J&T Express<br>
                - ✅ SAPX Express<br>
                - ✅ J&T Cargo<br>
                - ✅ SPX Express<br>
                - ✅ Lion Parcel<br>
                - ✅ Paxel<br>
                - ✅ ID Express<br>
                - ✅ Anteraja<br><br>
                <i>(Catatan: Untuk paket JNE yang sudah terlanjur diproses dan sedang dalam perjalanan, statusnya tetap aman dan akan tetap diantarkan ke penerima ya Kak).</i><br><br>
                Mohon maaf yang sebesar-besarnya atas ketidaknyamanan ini. Yuk, langsung cetak resi pakai ekspedisi alternatif yang tersedia! Jika ada kendala teknis lainnya, silakan balas pesan ini ya Kak, kami siap membantu. 🙏✨
            </div>
            <pre id="raw_selasa_pagi" class="raw-wa-text">Halo Kak! 👋
*Pemberitahuan informasi penting untuk kelancaran operasional pengiriman Kakak hari ini dan kedepan.*

Saat ini, layanan pengiriman *JNE* di aplikasi SIMASRIM sedang dinonaktifkan sementara waktu (hingga batas waktu yang belum bisa ditentukan). Hal ini dikarenakan adanya pemeliharaan dan pembaruan sistem integrasi (system upgrade) bersama, guna memastikan keamanan dan kenyamanan data transaksi seluruh pengguna kami ke depannya.

Namun Kakak tidak perlu khawatir! 🚀 Operasional pengiriman Kakak tetap bisa berjalan lancar jaya. Kakak bisa langsung mengalihkan pengiriman menggunakan layanan dari mitra ekspedisi andalan kami lainnya yang siap melakukan Pick-Up ke lokasi, seperti:
- ✅ J&T Express
- ✅ SAPX Express
- ✅ J&T Cargo
- ✅ SPX Express
- ✅ Lion Parcel
- ✅ Paxel
- ✅ ID Express
- ✅ Anteraja

_(Catatan: Untuk paket JNE yang sudah terlanjur diproses dan sedang dalam perjalanan, statusnya tetap aman dan akan tetap diantarkan ke penerima ya Kak)._

Mohon maaf yang sebesar-besarnya atas ketidaknyamanan ini. Yuk, langsung cetak resi pakai ekspedisi alternatif yang tersedia! Jika ada kendala teknis lainnya, silakan balas pesan ini ya Kak, kami siap membantu. 🙏✨</pre>
        </div>

        <div class="step-card" style="border-left-color: #fd7e14;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #fd7e14;">Selasa, 19 Mei - 14:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Push PPOB & Produk Digital</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa_siang', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                📱 <strong>LOKET KAKAK BUKAN CUMA BUAT KIRIM PAKET!</strong> 📱<br><br>
                Siang Kak! Sambil nunggu paketan dijemput kurir, jangan lupa maksimalkan layanan non-pengiriman di SIMASRIM ya. Sekarang sistem PPOB kita makin <strong>Lengkap, Rapih, dan Mantap!</strong><br><br>
                Sekarang Kakak bisa cuan dari:<br>
                💸 <strong>Bayar Angsuran/Cicilan:</strong> Makin lengkap opsinya.<br>
                📶 <strong>Pulsa & Paket Data:</strong> Harga agen yang super terjangkau.<br>
                🎮 <strong>Voucher Game:</strong> Top up game kesayangan pelanggan makin gampang.<br>
                💧⚡ <strong>PDAM & PLN:</strong> Jangkauan nasional, transaksi anti lemot!<br><br>
                Yuk pasang status WA sekarang, kasih tau tetangga kalau loket Kakak bisa ngelayanin semuanya! 💸
            </div>
            <pre id="raw_selasa_siang" class="raw-wa-text">📱 *LOKET KAKAK BUKAN CUMA BUAT KIRIM PAKET!* 📱

Siang Kak! Sambil nunggu paketan dijemput kurir, jangan lupa maksimalkan layanan non-pengiriman di SIMASRIM ya. Sekarang sistem PPOB kita makin *Lengkap, Rapih, dan Mantap!*

Sekarang Kakak bisa cuan dari:
💸 *Bayar Angsuran/Cicilan:* Makin lengkap opsinya.
📶 *Pulsa & Paket Data:* Harga agen yang super terjangkau.
🎮 *Voucher Game:* Top up game kesayangan pelanggan makin gampang.
💧⚡ *PDAM & PLN:* Jangkauan nasional, transaksi anti lemot!

Yuk pasang status WA sekarang, kasih tau tetangga kalau loket Kakak bisa ngelayanin semuanya! 💸</pre>
        </div>

        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6f42c1;">Rabu, 20 Mei - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Push Perlengkapan Loket & Mall</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_rabu', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                🛒 <strong>MODAL LOKET MAKIN KEREN, PELANGGAN MAKIN PERCAYA!</strong> 🛒<br><br>
                Halo Kak! Loket yang kelihatan profesional pasti bikin pelanggan makin yakin buat transaksi. Apalagi di SIMASRIM juga bisa transaksi Tiket dan PPOB.<br><br>
                Yuk <i>upgrade</i> fasilitas loket Kakak di <strong>mall.simasrim.com</strong>! Kita udah sediain:<br>
                ✅ Mesin EDC Android biar bayar-bayar gampang.<br>
                ✅ Soundbox QRIS biar pembayaran pakai Qris langsung bunyi.<br>
                ✅ Kopi Mardika buat nemenin jaga Loket.<br><br>
                Harganya spesial khusus Agen SIMASRIM lho. Langsung cek etalasenya sekarang ya! 🚀
            </div>
            <pre id="raw_rabu" class="raw-wa-text">🛒 *MODAL LOKET MAKIN KEREN, PELANGGAN MAKIN PERCAYA!* 🛒

Halo Kak! Loket yang kelihatan profesional pasti bikin pelanggan makin yakin buat transaksi. Apalagi di SIMASRIM juga bisa transaksi Tiket dan PPOB.

Yuk _upgrade_ fasilitas loket Kakak di *mall.simasrim.com*! Kita udah sediain:
✅ Mesin EDC Android biar bayar-bayar gampang.
✅ Soundbox QRIS biar pembayaran pakai Qris langsung bunyi.
✅ Kopi Mardika buat nemenin jaga Loket.

Harganya spesial khusus Agen SIMASRIM lho. Langsung cek etalasenya sekarang ya! 🚀</pre>
        </div>

        <div class="step-card" style="border-left-color: #dc3545;">
            <div class="step-header">
                <div>
                    <span class="badge bg-danger mb-1">Kamis, 21 Mei - 14:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Spill Konsep & Timeline Rewards</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                🪙 <strong>SIAP-SIAP PANEN KOIN DI SIMASRIM REWARDS!</strong> 🪙<br><br>
                Sore Agen! Makin nggak sabar kan nunggu program loyalitas kita rilis?<br>
                Nih Mimin kasih bocoran penting:<br><br>
                Gak lama lagi, setiap transaksi pengiriman (paket <i>delivered</i>) Kakak bakal mulai dihitung untuk dapet <strong>KOIN</strong>. Nantinya, Koin ini bisa ditukar ke Katalog Hadiah kita yang super mantap (Mulai dari perlengkapan loket, alat elektronik, sampai paket liburan!).<br><br>
                <b>Tampilan Koin dan Katalog Hadiahnya bakal rilis</b> di aplikasi ga lama setelah koin mulai dihitung. Jadi, mumpung masih ada waktu, yuk biasakan gaspol transaksi dari sekarang biar nanti pas sistemnya jalan, Kakak udah langsung jago ngumpulin Koinnya! 🔥
            </div>
            <pre id="raw_kamis" class="raw-wa-text">🪙 *SIAP-SIAP PANEN KOIN DI SIMASRIM REWARDS!* 🪙

Sore Agen! Makin nggak sabar kan nunggu program loyalitas kita rilis?
Nih Mimin kasih bocoran penting:

Gak lama lagi, setiap transaksi pengiriman (paket _delivered_) Kakak bakal mulai dihitung untuk dapet *KOIN*. Nantinya, Koin ini bisa ditukar ke Katalog Hadiah kita yang super mantap (Mulai dari perlengkapan loket, alat elektronik, sampai paket liburan!).

*Tampilan Koin dan Katalog Hadiahnya bakal rilis di aplikasi* ga lama setelah koin mulai dihitung. Jadi, mumpung masih ada waktu, yuk biasakan gaspol transaksi dari sekarang biar nanti pas sistemnya jalan, Kakak udah langsung jago ngumpulin Koinnya! 🔥</pre>
        </div>


        <div class="text-center mt-5 mb-4">
            <h3 class="fw-bold text-dark"><i class="fas fa-users me-2 text-success"></i>Broadcast Grup Spesifik</h3>
            <p class="text-muted">Kirimkan ke masing-masing grup pada hari Jumat & Sabtu.</p>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #198754; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-success mb-1">Jumat, 22 Mei - 10:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 1 (VIP)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_jumat_1', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Halo Juragan! ☕ Udah pada infoin jaringan agennya soal ID Express & Anteraja belum? Jangan lupa di-push juga transaksi PPOB-nya ya, layanannya udah makin komplit lho. Sebentar lagi hitungan "Koin" Rewards dimulai, pastikan agen-agen Bapak/Ibu performanya lagi bagus-bagusnya biar panen koinnya maksimal! 💪
                    </div>
                    <pre id="raw_jumat_1" class="raw-wa-text">Halo Juragan! ☕ Udah pada infoin jaringan agennya soal ID Express & Anteraja belum? Jangan lupa di-push juga transaksi PPOB-nya ya, layanannya udah makin komplit lho. Sebentar lagi hitungan "Koin" Rewards dimulai, pastikan agen-agen Bapak/Ibu performanya lagi bagus-bagusnya biar panen koinnya maksimal! 💪</pre>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #0dcaf0; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-info text-dark mb-1">Jumat, 22 Mei - 14:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 2 (Standar)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_jumat_2', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Siang Kak! 👋 Menjelang akhir pekan jangan kasih kendor! Udah ada ID Express sama Anteraja nih yang siap jemput paket Kakak. Sambil nunggu kurir, sikat juga transaksi PPOB-nya karena sekarang bayar angsuran, token, sampai voucher game makin mudah dan lengkap banget. Semangat cuannya Kak! 🚀
                    </div>
                    <pre id="raw_jumat_2" class="raw-wa-text">Siang Kak! 👋 Menjelang akhir pekan jangan kasih kendor! Udah ada ID Express sama Anteraja nih yang siap jemput paket Kakak. Sambil nunggu kurir, sikat juga transaksi PPOB-nya karena sekarang bayar angsuran, token, sampai voucher game makin mudah dan lengkap banget. Semangat cuannya Kak! 🚀</pre>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #198754; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-success mb-1">Sabtu, 23 Mei - 10:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 1 (VIP)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_sabtu_1', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Selamat pagi Juragan! Happy Weekend! 🎉<br><br>
                        Sambil santai, yuk pantau laporan transaksi ekspedisi baru kita minggu ini. Edukasi jaringan untuk terbiasa pakai fitur PPOB & Tiket selain kirim paket. Semakin banyak variasi transaksi, makin besar poin Koin Rewards yang bakal kita kumpulkan ga lama lagi. Sukses terus Gan!
                    </div>
                    <pre id="raw_sabtu_1" class="raw-wa-text">Selamat pagi Juragan! Happy Weekend! 🎉

Sambil santai, yuk pantau laporan transaksi ekspedisi baru kita minggu ini. Edukasi jaringan untuk terbiasa pakai fitur PPOB & Tiket selain kirim paket. Semakin banyak variasi transaksi, makin besar poin Koin Rewards yang bakal kita kumpulkan ga lama lagi. Sukses terus Gan!</pre>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #0dcaf0; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-info text-dark mb-1">Sabtu, 23 Mei - 14:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 2 (Standar)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_sabtu_2', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Happy Weekend Kak! 👋 Hari libur loket tetep buka kan?<br><br>
                        Pasang status WA yuk kasih tau kalau loket Kakak sekarang udah bisa kirim paket pakai ID Express & Anteraja. Jangan lupa tawarkan juga isi ulang Token Listrik & Voucher Game buat anak-anak tetangga yang lagi libur main. Gaspol cuan akhir pekannya Kak! 📦✨
                    </div>
                    <pre id="raw_sabtu_2" class="raw-wa-text">Happy Weekend Kak! 👋 Hari libur loket tetep buka kan?

Pasang status WA yuk kasih tau kalau loket Kakak sekarang udah bisa kirim paket pakai ID Express & Anteraja. Jangan lupa tawarkan juga isi ulang Token Listrik & Voucher Game buat anak-anak tetangga yang lagi libur main. Gaspol cuan akhir pekannya Kak! 📦✨</pre>
                </div>
            </div>
        </div>

        <div class="text-center mt-5 mb-4">
            <h3 class="fw-bold text-dark"><i class="fas fa-life-ring me-2 text-danger"></i>FAQ Cheat Sheet: Kendala JNE</h3>
            <p class="text-muted">Template jawaban khusus untuk tim CS jika Agen menanyakan hilang/tidak berfungsinya layanan JNE.</p>
        </div>

        <div class="row g-4">
            <div class="col-12">
                <div class="step-card" style="border-left-color: #dc3545; background: #fffcfc;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-danger mb-1"><i class="fas fa-exclamation-circle me-1"></i> Info Darurat CS</span>
                            <h5 class="fw-bold mb-0 text-dark">Template Balasan: JNE Offline / Integrasi Sistem</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_faq_jne', this)">Salin Jawaban</button>
                    </div>
                    <div class="chat-bubble" style="border-color: #f5c6cb; background: #fff;">
                        Halo Kak! 🙏 Mohon maaf atas ketidaknyamanannya. Saat ini layanan <strong>JNE</strong> sedang dalam tahap pemeliharaan dan peningkatan integrasi sistem dari pusat, sehingga sementara waktu belum bisa digunakan.<br><br>
                        Tapi jangan khawatir Kak! Sambil menunggu, Kakak bisa alihkan kiriman pelanggan menggunakan ekspedisi andalan kita lainnya yang nggak kalah cepat, seperti <strong>J&T Express, SAPX, SPX, Lion Parcel</strong>, atau yang baru rilis seperti <strong>ID Express dan Anteraja</strong>.<br><br>
                        Nanti kalau JNE sudah <i>ON</i> dan normal kembali, pasti langsung Mimin kabari secepatnya ya. Terima kasih atas pengertiannya Kak! ✨
                    </div>
                    <pre id="raw_faq_jne" class="raw-wa-text">Halo Kak! 🙏 Mohon maaf atas ketidaknyamanannya. Saat ini layanan *JNE* sedang dalam tahap pemeliharaan dan peningkatan integrasi sistem dari pusat, sehingga sementara waktu belum bisa digunakan.

Tapi jangan khawatir Kak! Sambil menunggu, Kakak bisa alihkan kiriman pelanggan menggunakan ekspedisi andalan kita lainnya yang nggak kalah cepat, seperti *J&T Express, SAPX, SPX, Lion Parcel*, atau yang baru rilis seperti *ID Express dan Anteraja*.

Nanti kalau JNE sudah _ON_ dan normal kembali, pasti langsung Mimin kabari secepatnya ya. Terima kasih atas pengertiannya Kak! ✨</pre>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>