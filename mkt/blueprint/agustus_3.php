<?php
$page_title = "Blueprint Agustus #3 | SIMASRIM Operations";
$footer_desc = "Dokumen Internal Rahasia - Divisi Campaign & Business Development.";
$base_path = '../';
include __DIR__ . '/../includes/header.php';
?>

<style>
    .step-card { background: #ffffff; border: 1px solid rgba(0,0,0,0.08); border-left: 5px solid var(--primary); border-radius: 16px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); transition: transform 0.3s ease; }
    .step-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.05); }
    .step-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; }

    .chat-bubble { background: #f8f9fa; border-radius: 0 12px 12px 12px; padding: 1.2rem; border: 1px solid #e9ecef; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.6; font-size: 0.95rem; margin-bottom: 1rem; }
    .chat-bubble.cs-reply { border-left: 5px solid #0dcaf0; }
    .wa-bold { font-weight: 700; color: #000; }
    .raw-wa-text { display: none !important; }
    .btn-copy { background: white; border: 1px solid #ced4da; color: #495057; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600; transition: all 0.2s ease; cursor: pointer; white-space: nowrap;}
    .btn-copy:hover { background: #e9ecef; color: #212529; }
    .btn-copy.copied { background: var(--primary); border-color: var(--primary); color: white; }

    .nav-tabs .nav-link { font-weight: 600; color: #6c757d; border: none; border-bottom: 3px solid transparent; padding: 10px 20px; }
    .nav-tabs .nav-link.active { color: var(--primary); border-bottom-color: var(--primary); background: transparent; }
</style>

<section class="hero-section text-center" style="background: linear-gradient(135deg, #1f0d3d, #0f0c29); padding-top: 120px; padding-bottom: 60px;">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--primary);"></div>
    <div class="container position-relative z-1">
        <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm border border-warning">Active Blueprint</span>
        <h2 class="display-5 fw-bold mb-2 text-white">Campaign Agustus - Pekan #3</h2>
        <p class="text-white-50 mb-0">Periode: 18 - 22 Agustus 2026 (Senin Libur Kemerdekaan). Fokus: Info Batas Waktu Pickup, Promo Cek Porsi Haji, Fitur Cicilan & SIMASRIM Mall.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="alert alert-danger border-danger border-opacity-25 shadow-sm rounded-4 p-3 mb-4">
            <h6 class="fw-bold mb-1"><i class="fas fa-flag text-danger me-2"></i> PERHATIAN JADWAL</h6>
            <p class="small mb-0">Hari Senin (17 Agustus) tidak ada broadcast operasional untuk menghormati Hari Kemerdekaan. Edukasi dimulai pada hari Selasa dengan sapaan Semarak Kemerdekaan.</p>
        </div>

        <!-- SELASA: INFO BATAS WAKTU PICKUP -->
        <div class="step-card" style="border-left-color: #198754;">
            <div class="step-header">
                <div>
                    <span class="badge bg-success mb-1">Selasa, 18 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Sapaan Kemerdekaan & Info Batas Waktu Pickup</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>

            <div class="chat-bubble">
                🇮🇩 <span class="wa-bold">MERDEKA DARI PAKET NYANGKUT! CEK JADWAL PICKUP INI KAK!</span> 🇮🇩<br><br>
                Halo Kak! Masih dalam suasana Semarak Kemerdekaan nih! Semoga semangat 17-annya nular ke orderan Kakak yang makin merdeka dari kata sepi ya! ✨<br><br>
                Biar paket pelanggan aman ter-pickup di hari yang sama, yuk catat <span class="wa-bold">Batas Waktu (Cut Off) Request Pick Up</span> berikut:<br><br>
                🚛 <span class="wa-bold">SAPX & J&T Cargo</span><br>
                - SAPX: Max 15.00 WIB (Sen-Jum), 12.00 WIB (Sabtu). Sameday max 09.00, One Day max 12.00.<br>
                - J&T Cargo: Max 12.00 WIB.<br><br>
                🚚 <span class="wa-bold">JNE & Lion Parcel</span><br>
                - JNE: Reguler max 14.00 WIB, YES max 12.00 WIB.<br>
                - Lion: Max 16.00 WIB setiap hari.<br><br>
                ⚡ <span class="wa-bold">J&T Express, ID Express, Anteraja, Paxel</span><br>
                - J&T: Reg/EZ/DOC max 16.00 WIB, Super max 12.00 WIB.<br>
                - ID Express: Sesi 13.00 & 18.00 WIB.<br>
                - Anteraja: Max 14.00 WIB.<br>
                - Paxel: Sameday max 12.00 WIB. (Waktu tunggu kurir max 7 menit).<br><br>
                Lewat dari jam di atas, paket otomatis diproses esok hari ya Kak. Yuk gas input resinya sekarang! 🚀
            </div>
            <pre id="raw_selasa" class="raw-wa-text">🇮🇩 *MERDEKA DARI PAKET NYANGKUT! CEK JADWAL PICKUP INI KAK!* 🇮🇩

Halo Kak! Masih dalam suasana Semarak Kemerdekaan nih! Semoga semangat 17-annya nular ke orderan Kakak yang makin merdeka dari kata sepi ya! ✨

Biar paket pelanggan aman ter-pickup di hari yang sama, yuk catat *Batas Waktu (Cut Off) Request Pick Up* berikut:

🚛 *SAPX & J&T Cargo*
- SAPX: Max 15.00 WIB (Sen-Jum), 12.00 WIB (Sabtu). Sameday max 09.00, One Day max 12.00.
- J&T Cargo: Max 12.00 WIB.

🚚 *JNE & Lion Parcel*
- JNE: Reguler max 14.00 WIB, YES max 12.00 WIB.
- Lion: Max 16.00 WIB setiap hari.

⚡ *J&T Express, ID Express, Anteraja, Paxel*
- J&T: Reg/EZ/DOC max 16.00 WIB, Super max 12.00 WIB.
- ID Express: Sesi 13.00 & 18.00 WIB.
- Anteraja: Max 14.00 WIB.
- Paxel: Sameday max 12.00 WIB. (Waktu tunggu kurir max 7 menit).

Lewat dari jam di atas, paket otomatis diproses esok hari ya Kak. Yuk gas input resinya sekarang! 🚀</pre>
        </div>

        <!-- RABU: APLIKASI CEK PORSI HAJI -->
        <div class="step-card" style="border-left-color: #0dcaf0;">
            <div class="step-header">
                <div>
                    <span class="badge bg-info text-dark mb-1">Rabu, 19 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Promosi Ekosistem: Aplikasi Cek Porsi Haji</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_rabu', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>

            <div class="chat-bubble">
                🕋 <span class="wa-bold">KABAR GEMBIRA! APLIKASI "CEK PORSI HAJI" KINI MAKIN LENGKAP!</span> 🕋<br><br>
                Halo Kak! Ada info spesial nih dari ekosistem SIMASRIM. Aplikasi kebanggaan kita, <span class="wa-bold">Cek Porsi Haji</span>, baru aja update besar-besaran!<br><br>
                ✨ <span class="wa-bold">Tampil dengan wajah baru & fitur melimpah!</span> ✨<br>
                Apa saja yang baru?<br>
                ✅ Desain UI/UX kekinian & jauh lebih nyaman digunakan<br>
                ✅ Al-Quran & Tafsir-nya interaktif<br>
                ✅ Jadwal & Pengingat (Reminder) Waktu Sholat dengan 20 metode perhitungan<br>
                ✅ Arah kiblat akurat sesuai lokasi Anda<br>
                ✅ Kalkulator Syariah: Hitung Zakat & Hitung Waris<br>
                ✅ Fitur Cek Porsi Haji & Panduan Ibadah Lengkap<br><br>
                Yuk, update & download aplikasinya sekarang untuk menikmati seluruh keunggulannya! Gratis lho!<br>
                👉 Klik di sini: https://play.google.com/store/apps/details?id=com.toyo.porsi&pcampaignid=web_share
            </div>
            <pre id="raw_rabu" class="raw-wa-text">🕋 *KABAR GEMBIRA! APLIKASI "CEK PORSI HAJI" KINI MAKIN LENGKAP!* 🕋

Halo Kak! Ada info spesial nih dari ekosistem SIMASRIM. Aplikasi kebanggaan kita, *Cek Porsi Haji*, baru aja update besar-besaran!

✨ *Tampil dengan wajah baru & fitur melimpah!* ✨
Apa saja yang baru?
✅ Desain UI/UX kekinian & jauh lebih nyaman digunakan
✅ Al-Quran & Tafsir-nya interaktif
✅ Jadwal & Pengingat (Reminder) Waktu Sholat dengan 20 metode perhitungan
✅ Arah kiblat akurat sesuai lokasi Anda
✅ Kalkulator Syariah: Hitung Zakat & Hitung Waris
✅ Fitur Cek Porsi Haji & Panduan Ibadah Lengkap

Yuk, update & download aplikasinya sekarang untuk menikmati seluruh keunggulannya! Gratis lho!
👉 Klik di sini: https://play.google.com/store/apps/details?id=com.toyo.porsi&pcampaignid=web_share</pre>
        </div>

        <!-- KAMIS: REMINDER REWARD KOIN -->
        <div class="step-card" style="border-left-color: #ffc107;">
            <div class="step-header">
                <div>
                    <span class="badge bg-warning text-dark mb-1">Kamis, 20 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Reminder Saldo SIMKoin Rewards</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>

            <div class="chat-bubble">
                🎁 <span class="wa-bold">MAKIN SERING KIRIM PAKET, MAKIN NUMPUK KOINNYA!</span> 🎁<br><br>
                Halo Kak! Sekadar mengingatkan nih, jangan sampai kelewatan klaim hadiah gratis dari SIMASRIM ya!<br><br>
                Setiap resi yang Kakak cetak dan berstatus <i>Final Delivered</i> akan otomatis berubah jadi koin. Coba deh intip saldo SIMKoin Kakak sekarang, siapa tahu udah cukup buat ditukar voucher saldo, gadget, atau ditabung buat umroh!<br><br>
                Segera cek katalog hadiahnya di 👉 https://rewards.simasrim.com/ atau klik menu <span class="wa-bold">"Lihat Rewards"</span> langsung di dashboard SIMASRIM Kakak. Terus semangat cetak resinya! 🚀
            </div>
            <pre id="raw_kamis" class="raw-wa-text">🎁 *MAKIN SERING KIRIM PAKET, MAKIN NUMPUK KOINNYA!* 🎁

Halo Kak! Sekadar mengingatkan nih, jangan sampai kelewatan klaim hadiah gratis dari SIMASRIM ya!

Setiap resi yang Kakak cetak dan berstatus _Final Delivered_ akan otomatis berubah jadi koin. Coba deh intip saldo SIMKoin Kakak sekarang, siapa tahu udah cukup buat ditukar voucher saldo, gadget, atau ditabung buat umroh!

Segera cek katalog hadiahnya di 👉 https://rewards.simasrim.com/ atau klik menu *"Lihat Rewards"* langsung di dashboard SIMASRIM Kakak. Terus semangat cetak resinya! 🚀</pre>
        </div>

        <!-- JUMAT: CICILAN & MALL (SPLIT GRUP) -->
        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6f42c1; color: #fff;">Jumat, 21 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Ekspansi Bisnis: Cicilan (G1) & SIMASRIM Mall (G2 & G3)</h5>
                </div>
            </div>

            <ul class="nav nav-tabs mb-3" id="tabJumat" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#jumat-g1" type="button" role="tab">Grup 1 (Agen VIP Terpilih)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#jumat-g2" type="button" role="tab">Grup 2 & 3 (Umum/Seller)</button></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="jumat-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            💳 <span class="wa-bold">BUTUH BARANG UNTUK OPERASIONAL? PAKAI FITUR CICILAN AJA KAK!</span> 💳<br><br>
                            Halo Kakak Agen Spesial! Tahukah Kakak kalau di SIMASRIM ada fasilitas cicilan khusus buat kebutuhan Kakak?<br><br>
                            Kalau Kakak butuh peralatan operasional loket, gadget, atau barang lainnya, Kakak bisa langsung cek di fitur <span class="wa-bold">Cicilan Produk</span>. Prosesnya mudah dan khusus dirancang untuk agen terpilih seperti Kakak.<br><br>
                            Cek limit dan barang yang tersedia sekarang di: 👉 https://app.simasrim.com/agen/cicilan_produk. Kembangkan loket Kakak tanpa pusing modal awal! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g1" class="raw-wa-text">💳 *BUTUH BARANG UNTUK OPERASIONAL? PAKAI FITUR CICILAN AJA KAK!* 💳

Halo Kakak Agen Spesial! Tahukah Kakak kalau di SIMASRIM ada fasilitas cicilan khusus buat kebutuhan Kakak?

Kalau Kakak butuh peralatan operasional loket, gadget, atau barang lainnya, Kakak bisa langsung cek di fitur *Cicilan Produk*. Prosesnya mudah dan khusus dirancang untuk agen terpilih seperti Kakak.

Cek limit dan barang yang tersedia sekarang di: 👉 https://app.simasrim.com/agen/cicilan_produk. Kembangkan loket Kakak tanpa pusing modal awal! 🚀</pre>
                </div>

                <div class="tab-pane fade" id="jumat-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🛍️ <span class="wa-bold">JUMAT BERKAH: MAU NAMBAH JUALAN TANPA STOK BARANG?</span> 🛍️<br><br>
                            Halo Kak! Orderan paket lagi santai menjelang <i>weekend</i>? Daripada diam aja, yuk manfaatkan <span class="wa-bold">SIMASRIM Mall</span>!<br><br>
                            Kakak bisa intip ribuan barang unik dengan harga grosir untuk dijual lagi. Ada pesanan? Tinggal order di Mall, dan barang bisa dikirim langsung ke alamat pelanggan Kakak (Sistem Dropship). Praktis banget kan?<br><br>
                            Gak butuh modal stok, cuan jualan jalan terus! Yuk eksplor barang dagangan baru Kakak di 👉 https://mall.simasrim.com/ hari ini! 💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g2" class="raw-wa-text">🛍️ *JUMAT BERKAH: MAU NAMBAH JUALAN TANPA STOK BARANG?* 🛍️

Halo Kak! Orderan paket lagi santai menjelang _weekend_? Daripada diam aja, yuk manfaatkan *SIMASRIM Mall*!

Kakak bisa intip ribuan barang unik dengan harga grosir untuk dijual lagi. Ada pesanan? Tinggal order di Mall, dan barang bisa dikirim langsung ke alamat pelanggan Kakak (Sistem Dropship). Praktis banget kan?

Gak butuh modal stok, cuan jualan jalan terus! Yuk eksplor barang dagangan baru Kakak di 👉 https://mall.simasrim.com/ hari ini! 💸</pre>
                </div>
            </div>
        </div>

        <!-- SABTU: WEEKEND GAMIFICATION (UNIQUE ANGLE) -->
        <div class="step-card" style="border-left-color: #f8c146;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #f8c146; color:#000;">Sabtu, 22 Agustus - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Push (Angle: Patahkan Mitos Weekend Sepi)</h5>
                </div>
            </div>

            <ul class="nav nav-tabs mb-3" id="tabSabtu" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sabtu-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g2" type="button" role="tab">Grup 2 (Baru)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g3" type="button" role="tab">Grup 3 (Downline)</button></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="sabtu-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎯 <span class="wa-bold">Patahkan Mitos Weekend Sepi Orderan Kak!</span><br><br>
                            Halo Juragan! Kata siapa hari Sabtu itu sepi? Justru ini momen emas buat <b>push</b> jaringan TJS Kakak.<br><br>
                            Orang-orang lagi santai di rumah, pasti butuh beli pulsa, token, atau <b>checkout</b> barang! Arahin downline Kakak buat sedia PPOB dan terus cetak resi pengiriman hari ini. Makin mereka sibuk, <b>passive income</b> Kakak makin meledak! 🔥🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g1" class="raw-wa-text">🎯 *Patahkan Mitos Weekend Sepi Orderan Kak!*

Halo Juragan! Kata siapa hari Sabtu itu sepi? Justru ini momen emas buat _push_ jaringan TJS Kakak.

Orang-orang lagi santai di rumah, pasti butuh beli pulsa, token, atau _checkout_ barang! Arahin downline Kakak buat sedia PPOB dan terus cetak resi pengiriman hari ini. Makin mereka sibuk, *passive income* Kakak makin meledak! 🔥🚀</pre>
                </div>

                <div class="tab-pane fade" id="sabtu-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">Weekend Rebahan? Mending Kumpulin Resi COD Kak!</span><br><br>
                            Halo Kak! Siapa bilang akhir pekan itu libur jualan? Justru pelanggan suka banget belanja santai di hari Sabtu.<br><br>
                            Ayo tangkap peluangnya! Kalau ada yang mau beli tapi malas transfer, tawarkan fitur <span class="wa-bold">COD SIMASRIM</span>. Pelanggan bisa bayar pas barang sampai, dan dana Kakak aman masuk saldo. Yuk patahkan mitos weekend sepi, cetak resi COD-nya sekarang! 💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g2" class="raw-wa-text">📦 *Weekend Rebahan? Mending Kumpulin Resi COD Kak!*

Halo Kak! Siapa bilang akhir pekan itu libur jualan? Justru pelanggan suka banget belanja santai di hari Sabtu.

Ayo tangkap peluangnya! Kalau ada yang mau beli tapi malas transfer, tawarkan fitur *COD SIMASRIM*. Pelanggan bisa bayar pas barang sampai, dan dana Kakak aman masuk saldo. Yuk patahkan mitos weekend sepi, cetak resi COD-nya sekarang! 💸</pre>
                </div>

                <div class="tab-pane fade" id="sabtu-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📈 <span class="wa-bold">Weekend Sepi? Waktunya Ngebut Diskon Ongkir Kak!</span> 🔥<br><br>
                            Halo Kak! Kalau dirasa orderan agak sepi, jangan dikasih kendor. Semua paket pengiriman <span class="wa-bold">NON-COD</span> yang Kakak input hari ini sangat berharga buat ningkatin level diskon (Tiering) lho!<br><br>
                            Makin banyak diinput, diskon ongkir Kakak otomatis makin besar buat transaksi ke depannya. Yuk patahkan mitos weekend sepi, gas input resinya di aplikasi SIMASRIM sekarang juga! 📦🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g3" class="raw-wa-text">📈 *Weekend Sepi? Waktunya Ngebut Diskon Ongkir Kak!* 🔥

Halo Kak! Kalau dirasa orderan agak sepi, jangan dikasih kendor. Semua paket pengiriman *NON-COD* yang Kakak input hari ini sangat berharga buat ningkatin level diskon (Tiering) lho!

Makin banyak diinput, diskon ongkir Kakak otomatis makin besar buat transaksi ke depannya. Yuk patahkan mitos weekend sepi, gas input resinya di aplikasi SIMASRIM sekarang juga! 📦🚀</pre>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    function copyWaText(id, btn) {
        let text = document.getElementById(id).textContent;
        let temp = document.createElement("textarea");
        temp.value = text;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        document.body.removeChild(temp);

        let originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Disalin!';
        btn.classList.add('copied');

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('copied');
        }, 2000);
    }
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
