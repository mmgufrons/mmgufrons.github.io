<?php 
$page_title = "Blueprint Juni #4 | SIMASRIM Operations";
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
        <h2 class="display-5 fw-bold mb-2 text-white">Campaign Juni - Pekan #4</h2>
        <p class="text-white-50 mb-0">Periode: 22 - 27 Juni 2026. Fokus: Rilis 3PL, Tutorial YT, Skema TJS, & Tiket Liburan.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="alert alert-info border-info border-opacity-25 shadow-sm rounded-4 p-3 mb-4">
            <h6 class="fw-bold mb-1"><i class="fas fa-users text-info me-2"></i> KATEGORI GRUP BARU</h6>
            <p class="small mb-0">Mulai pekan ini, <strong>Grup 3 (Jaringan TJS / Downline)</strong> sudah aktif. Pastikan menggunakan tab materi yang sesuai dengan target blast masing-masing.</p>
        </div>

        <div class="step-card" style="border-left-color: #2563eb;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #2563eb; color: #fff;">Senin, 22 Juni - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Rilis & Reminder ID Express</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabSenin" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#senin-g1" type="button" role="tab">Grup 1 (VIP/Remind)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#senin-g2" type="button" role="tab">Grup 2 (Baru/Rilis)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#senin-g3" type="button" role="tab">Grup 3 (TJS/Rilis Bertahap)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="senin-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🔵 <span class="wa-bold">PENGINGAT AWAL PEKAN: Masih Sering Kena Ongkir Mahal Buat Paket Kecil?</span><br><br>
                            Halo Kak! Awal pekan waktunya gasspol kiriman. Mimin cuma mau ngingetin, kalau Kakak punya paket fashion, kosmetik, atau dokumen di bawah 500 gram (0.5 Kg), jangan lupa pilih <span class="wa-bold">ID Express LITE</span> ya!<br><br>
                            Hitungannya setengah kilo, jadi ongkir lebih hemat dan margin Kakak makin tebal. Yuk, langsung klik cetak resi di dashboard sekarang! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_senin_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_senin_g1" class="raw-wa-text">🔵 *PENGINGAT AWAL PEKAN: Masih Sering Kena Ongkir Mahal Buat Paket Kecil?*

Halo Kak! Awal pekan waktunya gasspol kiriman. Mimin cuma mau ngingetin, kalau Kakak punya paket fashion, kosmetik, atau dokumen di bawah 500 gram (0.5 Kg), jangan lupa pilih *ID Express LITE* ya!

Hitungannya setengah kilo, jadi ongkir lebih hemat dan margin Kakak makin tebal. Yuk, langsung klik cetak resi di dashboard sekarang! 🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="senin-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎉 <span class="wa-bold">KABAR GEMBIRA! ID Express Resmi Hadir di SIMASRIM!</span> 🔵<br><br>
                            Halo Agen SIMASRIM! Makin banyak pilihan kurir, makin mudah jualan Kakak! Mulai hari ini, ekspedisi <span class="wa-bold">ID Express</span> resmi bisa digunakan di aplikasi SIMASRIM.<br><br>
                            Spesialnya ID Express ini punya layanan <span class="wa-bold">LITE</span> yang ongkirnya dihitung per setengah kilo (0.5 kg). Cocok banget buat Kakak yang jualan barang-barang ringan biar pembeli gak kabur gara-gara ongkir mahal.<br><br>
                            Yuk cobain cetak resi ID Express pertama Kakak hari ini! Kurir siap meluncur jemput ke toko. 📦💨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_senin_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_senin_g2" class="raw-wa-text">🎉 *KABAR GEMBIRA! ID Express Resmi Hadir di SIMASRIM!* 🔵

Halo Agen SIMASRIM! Makin banyak pilihan kurir, makin mudah jualan Kakak! Mulai hari ini, ekspedisi *ID Express* resmi bisa digunakan di aplikasi SIMASRIM.

Spesialnya ID Express ini punya layanan *LITE* yang ongkirnya dihitung per setengah kilo (0.5 kg). Cocok banget buat Kakak yang jualan barang-barang ringan biar pembeli gak kabur gara-gara ongkir mahal.

Yuk cobain cetak resi ID Express pertama Kakak hari ini! Kurir siap meluncur jemput ke toko. 📦💨</pre>
                </div>

                <div class="tab-pane fade" id="senin-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎉 <span class="wa-bold">INFO UPDATE: ID Express Rilis Bertahap Buat Kakak!</span> 🔵<br><br>
                            Halo Kak! Ada kabar baik nih, layanan pengiriman <span class="wa-bold">ID Express</span> sudah mulai dirilis bertahap untuk Kakak di SIMASRIM.<br><br>
                            Gak perlu pusing ongkir mahal buat barang ringan, karena ID Express punya hitungan <span class="wa-bold">LITE (0.5 Kg)</span>! Yuk cek dashboard Kakak sekarang, kalau logonya udah muncul, langsung cobain cetak resi pertamanya! 📦💨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_senin_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_senin_g3" class="raw-wa-text">🎉 *INFO UPDATE: ID Express Rilis Bertahap Buat Kakak!* 🔵

Halo Kak! Ada kabar baik nih, layanan pengiriman *ID Express* sudah mulai dirilis bertahap untuk Kakak di SIMASRIM.

Gak perlu pusing ongkir mahal buat barang ringan, karena ID Express punya hitungan *LITE (0.5 Kg)*! Yuk cek dashboard Kakak sekarang, kalau logonya udah muncul, langsung cobain cetak resi pertamanya! 📦💨</pre>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #E8232A;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #E8232A; color: #fff;">Selasa, 23 Juni - 13:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Rilis & Reminder Anteraja</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabSelasa" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#selasa-g1" type="button" role="tab">Grup 1 (VIP/Remind)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#selasa-g2" type="button" role="tab">Grup 2 (Baru/Rilis)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#selasa-g3" type="button" role="tab">Grup 3 (TJS/Rilis Bertahap)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="selasa-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🔴 <span class="wa-bold">PENGINGAT: Butuh Pickup Cepat & Tepat Waktu? Anteraja Solusinya!</span> ⚡<br><br>
                            Halo Kak! Jangan lupa, kalau butuh rute jemputan yang terjadwal dan kurir SATRIA yang sigap, opsi <span class="wa-bold">Anteraja</span> selalu standby di aplikasi SIMASRIM Kakak.<br><br>
                            Update resi real-time, pengiriman aman, pembeli tenang. Gass input orderannya dan pilih Anteraja untuk prioritas hari ini! 📦
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_selasa_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_selasa_g1" class="raw-wa-text">🔴 *PENGINGAT: Butuh Pickup Cepat & Tepat Waktu? Anteraja Solusinya!* ⚡

Halo Kak! Jangan lupa, kalau butuh rute jemputan yang terjadwal dan kurir SATRIA yang sigap, opsi *Anteraja* selalu standby di aplikasi SIMASRIM Kakak.

Update resi real-time, pengiriman aman, pembeli tenang. Gass input orderannya dan pilih Anteraja untuk prioritas hari ini! 📦</pre>
                </div>
                
                <div class="tab-pane fade" id="selasa-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎉 <span class="wa-bold">KABAR GEMBIRA! Anteraja Resmi Hadir Melengkapi Pilihan Ekspedisi Kakak!</span> 🔴<br><br>
                            Halo Agen SIMASRIM! Satu lagi kurir favorit pelanggan hadir di SIMASRIM. Sekarang Kakak bisa langsung cetak resi dan nikmati layanan pickup gratis dari <span class="wa-bold">Anteraja</span>!<br><br>
                            Kurir SATRIA yang ramah siap jemput paket ke depan toko Kakak. Proses gampang, jualan makin kencang. Yuk aktifin dan tes cetak resi Anteraja hari ini! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_selasa_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_selasa_g2" class="raw-wa-text">🎉 *KABAR GEMBIRA! Anteraja Resmi Hadir Melengkapi Pilihan Ekspedisi Kakak!* 🔴

Halo Agen SIMASRIM! Satu lagi kurir favorit pelanggan hadir di SIMASRIM. Sekarang Kakak bisa langsung cetak resi dan nikmati layanan pickup gratis dari *Anteraja*!

Kurir SATRIA yang ramah siap jemput paket ke depan toko Kakak. Proses gampang, jualan makin kencang. Yuk aktifin dan tes cetak resi Anteraja hari ini! 🚀</pre>
                </div>

                <div class="tab-pane fade" id="selasa-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎉 <span class="wa-bold">INFO UPDATE: Anteraja Makin Meluas ke Kakak!</span> 🔴<br><br>
                            Halo Kak! Mau pickup cepat dan tepat waktu? Sekarang layanan <span class="wa-bold">Anteraja</span> sedang dirilis bertahap ke seluruh akun di Kakak!<br><br>
                            Kurir SATRIA yang andal siap menjemput paket langsung ke lokasi tanpa minimal order. Yuk buka aplikasi SIMASRIM Kakak, cek menu ekspedisinya, dan gass input resi Anteraja hari ini! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_selasa_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_selasa_g3" class="raw-wa-text">🎉 *INFO UPDATE: Anteraja Makin Meluas ke Kakak!* 🔴

Halo Kak! Mau pickup cepat dan tepat waktu? Sekarang layanan *Anteraja* sedang dirilis bertahap ke seluruh akun di Kakak!

Kurir SATRIA yang andal siap menjemput paket langsung ke lokasi tanpa minimal order. Yuk buka aplikasi SIMASRIM Kakak, cek menu ekspedisinya, dan gass input resi Anteraja hari ini! 🚀</pre>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #FF0000;">
            <div class="step-header">
                <div>
                    <span class="badge bg-danger mb-1">Rabu, 24 Juni - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Edukasi Visual (YouTube Tutorial)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_rabu', this)"><i class="far fa-copy"></i> Salin Pesan (ALL GRUP)</button>
            </div>
            
            <div class="chat-bubble">
                📺 <span class="wa-bold">BINGUNG CARA CAIRIN COD ATAU ATUR PIN PPOB? TONTON TUTORIALNYA!</span><br><br>
                Halo Kak! Sering kebingungan gimana caranya narik dana COD biar cepat cair, atau lupa cara atur PIN buat jualan pulsa/token (PPOB)?<br><br>
                Gak perlu pusing! Tim SIMASRIM sudah siapkan video tutorial step-by-step yang gampang banget diikuti. Langsung aja meluncur dan <span class="wa-bold">Subscribe</span> ke YouTube Resmi kami ya:<br><br>
                👉 <span class="wa-bold">Tonton di sini: https://www.youtube.com/@SIMASRIM-app</span><br><br>
                Biar Kakak makin mahir pakai aplikasinya dan cuannya makin lancar! Selamat menonton! 🍿💻
            </div>
            <pre id="raw_rabu" class="raw-wa-text">📺 *BINGUNG CARA CAIRIN COD ATAU ATUR PIN PPOB? TONTON TUTORIALNYA!*

Halo Kak! Sering kebingungan gimana caranya narik dana COD biar cepat cair, atau lupa cara atur PIN buat jualan pulsa/token (PPOB)?

Gak perlu pusing! Tim SIMASRIM sudah siapkan video tutorial step-by-step yang gampang banget diikuti. Langsung aja meluncur dan *Subscribe* ke YouTube Resmi kami ya:

👉 *Tonton di sini: https://www.youtube.com/@SIMASRIM-app*

Biar Kakak makin mahir pakai aplikasinya dan cuannya makin lancar! Selamat menonton! 🍿💻</pre>
        </div>

        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6f42c1; color:#fff;">Kamis, 25 Juni - 11:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Skema Diskon & Passive Income (TJS)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                🌐 <span class="wa-bold">PERLUAS JARINGANMU: Bangun Passive Income dari Agen TJS!</span> 💸<br><br>
                Halo Kak! Sebagai pengguna SIMASRIM, Kakak bisa dapat komisi pasif terus-menerus cuma dengan mendaftarkan jaringan toko/seller lain (Tingkat TJS/Reguler).<br><br>
                <span class="wa-bold">Bagaimana Caranya?</span><br>
                Buka menu <span class="wa-bold">Jaringanmu > Konfirmasi TJS > Salin Link Pendaftaran</span> (pojok kanan atas). Bagikan link tersebut! Begitu mereka daftar, mereka otomatis masuk Sub-Jaringan Kakak.<br><br>
                📈 <span class="wa-bold">Skema Komisi Otomatis (Tiering):</span><br>
                Kakak gak perlu repot atur diskon mereka. Sistem kami otomatis menaikkan diskon Seller tersebut (misal: 21% → 23% → maksimal 25%) berdasarkan volume pengiriman <span class="wa-bold">NON-COD</span> mereka.<br><br>
                <span class="wa-bold">Catatan Penting:</span> Pengiriman COD tidak dihitung ke tiering karena ongkir dibayar oleh penerima.<br><br>
                💰 <span class="wa-bold">Dari mana untungnya?</span><br>
                Selisih antara Diskon Akun Kakak dengan Diskon Jaringan TJS tersebut otomatis menjadi <span class="wa-bold">Komisi Keuntungan Pasif</span> yang langsung cair ke saldo Kakak tiap mereka kirim paket!<br><br>
                Tunggu apa lagi? Sebar link pendaftaran Kakak sekarang dan bangun aset digitalmu! 🚀
            </div>
            <pre id="raw_kamis" class="raw-wa-text">🌐 *PERLUAS JARINGANMU: Bangun Passive Income dari Agen TJS!* 💸

Halo Kak! Sebagai pengguna SIMASRIM, Kakak bisa dapat komisi pasif terus-menerus cuma dengan mendaftarkan jaringan toko/seller lain (Tingkat TJS/Reguler).

*Bagaimana Caranya?*
Buka menu *Jaringanmu > Konfirmasi TJS > Salin Link Pendaftaran* (pojok kanan atas). Bagikan link tersebut! Begitu mereka daftar, mereka otomatis masuk Sub-Jaringan Kakak.

📈 *Skema Komisi Otomatis (Tiering):*
Kakak gak perlu repot atur diskon mereka. Sistem kami otomatis menaikkan diskon Seller tersebut (misal: 21% → 23% → maksimal 25%) berdasarkan volume pengiriman *NON-COD* mereka.

*Catatan Penting:* Pengiriman COD tidak dihitung ke tiering karena ongkir dibayar oleh penerima.

💰 *Dari mana untungnya?*
Selisih antara Diskon Akun Kakak dengan Diskon Jaringan TJS tersebut otomatis menjadi *Komisi Keuntungan Pasif* yang langsung cair ke saldo Kakak tiap mereka kirim paket!

Tunggu apa lagi? Sebar link pendaftaran Kakak sekarang dan bangun aset digitalmu! 🚀</pre>
        </div>

        <div class="step-card" style="border-left-color: #20c997;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #20c997; color: #fff;">Jumat, 26 Juni - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Momentum Libur Panjang (Tiket Pesawat & KAI)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_jumat', this)"><i class="far fa-copy"></i> Salin Pesan (ALL GRUP)</button>
            </div>
            
            <div class="chat-bubble">
                🏖️ <span class="wa-bold">SIAP-SIAP MUSIM LIBURAN! Panen Cuan dari Tiket Pesawat, Kereta & PELNI!</span> ✈️🚆🚢<br><br>
                Halo Kak! Wah, musim libur panjang sekolah dan cuti bersama udah makin dekat nih. Pasti banyak tetangga atau pelanggan Kakak yang lagi nyari tiket mudik atau jalan-jalan!<br><br>
                Ini PELUANG EMAS buat Kakak! Jangan cuma kirim paket, manfaatkan fitur <span class="wa-bold">TIKET PERJALANAN</span> di aplikasi SIMASRIM untuk jual tiket Pesawat, Kereta Api (KAI), dan Kapal PELNI.<br><br>
                Keuntungannya? Kakak dapat komisi dari admin tiket yang lumayan banget lho! Yuk, pasang status WA atau tempel info di depan toko kalau Kakak melayani penjualan tiket resmi. Cuan liburan menanti Kakak! 💸🤑
            </div>
            <pre id="raw_jumat" class="raw-wa-text">🏖️ *SIAP-SIAP MUSIM LIBURAN! Panen Cuan dari Tiket Pesawat, Kereta & PELNI!* ✈️🚆🚢

Halo Kak! Wah, musim libur panjang sekolah dan cuti bersama udah makin dekat nih. Pasti banyak tetangga atau pelanggan Kakak yang lagi nyari tiket mudik atau jalan-jalan!

Ini PELUANG EMAS buat Kakak! Jangan cuma kirim paket, manfaatkan fitur *TIKET PERJALANAN* di aplikasi SIMASRIM untuk jual tiket Pesawat, Kereta Api (KAI), dan Kapal PELNI.

Keuntungannya? Kakak dapat komisi dari admin tiket yang lumayan banget lho! Yuk, pasang status WA atau tempel info di depan toko kalau Kakak melayani penjualan tiket resmi. Cuan liburan menanti Kakak! 💸🤑</pre>
        </div>

        <div class="step-card" style="border-left-color: #f8c146;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #f8c146; color:#000;">Sabtu, 27 Juni - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Push & Gamifikasi Terarah</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabSabtu" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sabtu-g1" type="button" role="tab">Grup 1 (Mitra VIP)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g2" type="button" role="tab">Grup 2 (Agen Baru)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g3" type="button" role="tab">Grup 3 (Downline TJS)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="sabtu-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎯 <span class="wa-bold">Weekend Tetap Produktif! Pantau Jaringan dan Tabung SIMKoin-nya!</span><br><br>
                            Halo Kak! Biar liburannya tetap produktif, jangan lupa dorong agen-agen di bawah jaringan TJS Kakak buat terus aktif cetak resi ya! Ingat, tiap resi mereka adalah <span class="wa-bold">passive income</span> buat Kakak.<br><br>
                            Plus, jangan kasih kendor kiriman toko Kakak sendiri! Semua paket yang statusnya <span class="wa-bold">Final Delivered</span> otomatis jadi <span class="wa-bold">SIMKoin</span> lho. Kumpulin terus biar pas katalog hadiahnya rilis bulan depan, Kakak udah siap panen! 🎁🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g1" class="raw-wa-text">🎯 *Weekend Tetap Produktif! Pantau Jaringan dan Tabung SIMKoin-nya!*

Halo Kak! Biar liburannya tetap produktif, jangan lupa dorong agen-agen di bawah jaringan TJS Kakak buat terus aktif cetak resi ya! Ingat, tiap resi mereka adalah *passive income* buat Kakak.

Plus, jangan kasih kendor kiriman toko Kakak sendiri! Semua paket yang statusnya *Final Delivered* otomatis jadi *SIMKoin* lho. Kumpulin terus biar pas katalog hadiahnya rilis bulan depan, Kakak udah siap panen! 🎁🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="sabtu-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎁 <span class="wa-bold">Pecah Telor Weekend Ini Buat Kumpulin Koin Yuk Kak!</span><br><br>
                            Halo Kak, jangan biarkan akhir pekan sepi resi! Tiap paket yang Kakak kirim via SIMASRIM dan berstatus <span class="wa-bold">Final Delivered</span> udah diam-diam kami hitung jadi Koin Hadiah (SIMKoin) lho!<br><br>
                            Nanti pas fitur penukaran hadiahnya rilis bulan depan, Kakak bakal kaget kalau ternyata koinnya numpuk buat ditukar hadiah macam-macam! Yuk masukin orderan Kakak weekend ini biar tabungan koinnya mulai jalan! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g2" class="raw-wa-text">🎁 *Pecah Telor Weekend Ini Buat Kumpulin Koin Yuk Kak!*

Halo Kak, jangan biarkan akhir pekan sepi resi! Tiap paket yang Kakak kirim via SIMASRIM dan berstatus *Final Delivered* udah diam-diam kami hitung jadi Koin Hadiah (SIMKoin) lho!

Nanti pas fitur penukaran hadiahnya rilis bulan depan, Kakak bakal kaget kalau ternyata koinnya numpuk buat ditukar hadiah macam-macam! Yuk masukin orderan Kakak weekend ini biar tabungan koinnya mulai jalan! 🚀</pre>
                </div>

                <div class="tab-pane fade" id="sabtu-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📈 <span class="wa-bold">Weekend Waktunya Kejar Diskon Ongkir Kak!</span> 🔥<br><br>
                            Halo Kak, semangat akhir pekannya! Sambil packing orderan yang masuk, inget ya kalau makin banyak Kakak input paket pengiriman <span class="wa-bold">NON-COD</span> di SIMASRIM, diskon ongkir Kakak otomatis bakal makin naik (Tiering)!<br><br>
                            Yuk masukin semua orderan yang pembayarannya cash/transfer ke sistem sekarang. Kita gass diskon ongkirnya biar keuntungan toko Kakak makin tebal! 📦💸<br><br>
                            <i>(Pengiriman COD tidak dihitung untuk kenaikan level diskon ya Kak, karena biayanya dibayar penerima).</i>
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g3" class="raw-wa-text">📈 *Weekend Waktunya Kejar Diskon Ongkir Kak!* 🔥

Halo Kak, semangat akhir pekannya! Sambil packing orderan yang masuk, inget ya kalau makin banyak Kakak input paket pengiriman *NON-COD* di SIMASRIM, diskon ongkir Kakak otomatis bakal makin naik (Tiering)!

Yuk masukin semua orderan yang pembayarannya cash/transfer ke sistem sekarang. Kita gass diskon ongkirnya biar keuntungan toko Kakak makin tebal! 📦💸

_(Pengiriman COD tidak dihitung untuk kenaikan level diskon ya Kak, karena biayanya dibayar penerima)._</pre>
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