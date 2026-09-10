<?php 
$page_title = "Blueprint Agustus #1 | SIMASRIM Operations";
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
        <h2 class="display-5 fw-bold mb-2 text-white">Campaign Agustus - Pekan #1</h2>
        <p class="text-white-50 mb-0">Periode: 3 - 8 Agustus 2026. Fokus: Promo SAPX Cashback 1%, Comeback JNE, & Akselerasi 3PL Underutilized.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="alert alert-info border-info border-opacity-25 shadow-sm rounded-4 p-3 mb-4">
            <h6 class="fw-bold mb-1"><i class="fas fa-bullhorn text-info me-2"></i> STRATEGI PEKAN INI</h6>
            <p class="small mb-0">
            Mulai 1 Agustus, SAPX memberikan Cashback 1% (Apple to Apple dengan Lion Parcel). Pengumuman aktifnya kembali JNE dimajukan ke <strong>Selasa pukul 14.00 WIB</strong>, kemudian hari Kamis difokuskan untuk edukasi penggunaan ekspedisi spesialis seperti Anteraja dan ID Express.
            </p>
        </div>

        <div class="step-card" style="border-left-color: #0d6efd;">
            <div class="step-header">
                <div>
                    <span class="badge bg-primary mb-1">Senin, 3 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Rilis Promo SAPX Cashback 1%</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_senin', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                🔥 <span class="wa-bold">AWAL BULAN MAKIN CUAN: PROMO EKSTRA CASHBACK 1% DARI SAPX!</span> 🔥<br><br>
                Halo Kakak Agen SIMASRIM! 👋<br>
                Mulai 1 Agustus 2026, khusus buat Kakak yang kirim paket pakai <span class="wa-bold">SAPX</span>, ada bonus <span class="wa-bold">Ekstra Cashback Saldo 1%</span> yang otomatis menumpuk di akun Kakak untuk setiap paket yang berstatus <b>Delivered</b>!<br><br>
                <span class="wa-bold">Kenapa harus pakai SAPX?</span><br>
                Selain tarifnya kompetitif, SAPX ini jagonya nembus titik-titik pelosok nusantara! Di beberapa wilayah terpencil yang kurir lain gak sanggup pickup/antar, SAPX tetap bisa melayani dengan prima.<br><br>
                Promo ini berlaku di luar koin Rewards lho! Udah dapet diskon ongkir, dapet koin hadiah, dapet cashback saldo pula. Yuk, cobain kirim paket pakai SAPX hari ini! 📦🚀
            </div>
            <pre id="raw_senin" class="raw-wa-text">🔥 *AWAL BULAN MAKIN CUAN: PROMO EKSTRA CASHBACK 1% DARI SAPX!* 🔥

Halo Kakak Agen SIMASRIM! 👋
Mulai 1 Agustus 2026, khusus buat Kakak yang kirim paket pakai *SAPX*, ada bonus *Ekstra Cashback Saldo 1%* yang otomatis menumpuk di akun Kakak untuk setiap paket yang berstatus Delivered!

*Kenapa harus pakai SAPX?*
Selain tarifnya kompetitif, SAPX ini jagonya nembus titik-titik pelosok nusantara! Di beberapa wilayah terpencil yang kurir lain gak sanggup pickup/antar, SAPX tetap bisa melayani dengan prima.

Promo ini berlaku di luar koin Rewards lho! Udah dapet diskon ongkir, dapet koin hadiah, dapet cashback saldo pula. Yuk, cobain kirim paket pakai SAPX hari ini! 📦🚀</pre>
        </div>

        <div class="step-card" style="border-left-color: #198754;">
            <div class="step-header">
                <div>
                    <span class="badge bg-success mb-1">Selasa, 4 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Edukasi: Cetak Resi Ekspedisi Lain Itu SAMA!</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa_pagi', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                💡 <span class="wa-bold">RAHASIA BIKIN PELANGGAN BETAH: JANGAN TAKUT COBA KURIR BARU!</span> 💡<br><br>
                Halo Kak! Selama ini masih ragu mau coba ekspedisi lain karena takut cara cetak resinya beda dan bikin bingung?<br><br>
                Faktanya: Proses cetak resi kurir lain di aplikasi SIMASRIM (seperti SAPX, Anteraja, ID Express, Paxel, Lion Parcel) itu <span class="wa-bold">SAMA PERSIS</span> alurnya kayak cetak resi kurir utama Kakak lho!<br><br>
                Gak ada yang beda, gak perlu belajar ulang! Tinggal pilih logo ekspedisinya, isi alamat, klik simpan, langsung jadi! Kurir akan otomatis dapat notifikasi buat jemput ke toko Kakak.<br><br>
                Sayang banget kalau pelanggan mau pakai kurir lain tapi Kakak tolak karena takut ribet. Yuk, aktifkan semua pilihan ekspedisi hari ini biar cuan makin deras! 📦💸
            </div>
            <pre id="raw_selasa_pagi" class="raw-wa-text">💡 *RAHASIA BIKIN PELANGGAN BETAH: JANGAN TAKUT COBA KURIR BARU!* 💡

Halo Kak! Selama ini masih ragu mau coba ekspedisi lain karena takut cara cetak resinya beda dan bikin bingung?

Faktanya: Proses cetak resi kurir lain di aplikasi SIMASRIM (seperti SAPX, Anteraja, ID Express, Paxel, Lion Parcel) itu *SAMA PERSIS* alurnya kayak cetak resi kurir utama Kakak lho!

Gak ada yang beda, gak perlu belajar ulang! Tinggal pilih logo ekspedisinya, isi alamat, klik simpan, langsung jadi! Kurir akan otomatis dapat notifikasi buat jemput ke toko Kakak.

Sayang banget kalau pelanggan mau pakai kurir lain tapi Kakak tolak karena takut ribet. Yuk, aktifkan semua pilihan ekspedisi hari ini biar cuan makin deras! 📦💸</pre>
        </div>

        <div class="step-card" style="border-left-color: #E8232A;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #E8232A; color: #fff;">Selasa, 4 Agustus - 14:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Mega Rilis: JNE Aktif Kembali!</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabSelasaSiang" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#selasa-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#selasa-g2" type="button" role="tab">Grup 2 (Agen Baru)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#selasa-g3" type="button" role="tab">Grup 3 (Seller)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="selasa-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📢 <span class="wa-bold">[KABAR GEMBIRA] JNE RESMI AKTIF KEMBALI! WAKTUNYA GENJOT TONASE!</span> 🚚<br><br>
                            Halo Juragan! Kabar bahagia yang paling ditunggu akhirnya tiba! Layanan <span class="wa-bold">JNE resmi diaktifkan kembali</span> di aplikasi SIMASRIM untuk seluruh jaringan agen di bawah Kakak.<br><br>
                            Sesuai regulasi, rute layanan JNE yang kembali dibuka ini berlaku khusus untuk jalur <span class="wa-bold">Non-COD Layanan Pickup Only</span>.<br><br>
                            Segera informasikan ke seluruh jaringan TJS Kakak atau bahkan Agen Kakak sendiri untuk kembali menawarkan opsi JNE ke pelanggan setia mereka. Kurir resmi JNE siap meluncur ke depan gerai tanpa minimal kiriman. Mari kita genjot omzet bersama! 🎉📦
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_selasa_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_selasa_g1" class="raw-wa-text">📢 *[KABAR GEMBIRA] JNE RESMI AKTIF KEMBALI! WAKTUNYA GENJOT TONASE!* 🚚

Halo Juragan! Kabar bahagia yang paling ditunggu akhirnya tiba! Layanan *JNE resmi diaktifkan kembali* di aplikasi SIMASRIM untuk seluruh jaringan agen di bawah Kakak.

Sesuai regulasi, rute layanan JNE yang kembali dibuka ini berlaku khusus untuk jalur *Non-COD Layanan Pickup Only*.

Segera informasikan ke seluruh jaringan TJS Kakak atau bahkan Agen Kakak sendiri untuk kembali menawarkan opsi JNE ke pelanggan setia mereka. Kurir resmi JNE siap meluncur ke depan gerai tanpa minimal kiriman. Mari kita genjot omzet bersama! 🎉📦</pre>
                </div>
                
                <div class="tab-pane fade" id="selasa-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📢 <span class="wa-bold">[KABAR GEMBIRA] LAYANAN JNE RESMI AKTIF KEMBALI!</span> 🚚<br><br>
                            Halo Kakak Agen SIMASRIM! 👋 Kabar bahagia yang paling ditunggu-tunggu akhirnya tiba! Layanan ekspedisi ikonik <span class="wa-bold">JNE resmi aktif kembali</span> di aplikasi SIMASRIM Kakak!<br><br>
                            Layanan JNE yang kembali dibuka ini berlaku khusus untuk jalur <span class="wa-bold">Non-COD Layanan Pickup Only</span>.<br><br>
                            Sekarang Kakak sudah bisa menawarkan kembali opsi pengiriman JNE ke pelanggan setia gerai Kakak. Paket seperti biasa akan langsung dijemput oleh kurir resmi JNE ke depan gerai. Yuk gasspol input orderan JNE Kakak hari ini! 🎉📦
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_selasa_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_selasa_g2" class="raw-wa-text">📢 *[KABAR GEMBIRA] LAYANAN JNE RESMI AKTIF KEMBALI!* 🚚

Halo Kakak Agen SIMASRIM! 👋 Kabar bahagia yang paling ditunggu-tunggu akhirnya tiba! Layanan ekspedisi ikonik *JNE resmi aktif kembali* di aplikasi SIMASRIM Kakak!

Layanan JNE yang kembali dibuka ini berlaku khusus untuk jalur *Non-COD Layanan Pickup Only*.

Sekarang Kakak sudah bisa menawarkan kembali opsi pengiriman JNE ke pelanggan setia gerai Kakak. Paket seperti biasa akan langsung dijemput oleh kurir resmi JNE ke depan gerai. Yuk gasspol input orderan JNE Kakak hari ini! 🎉📦</pre>
                </div>

                <div class="tab-pane fade" id="selasa-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📢 <span class="wa-bold">EKSPEDISI IDOLA PEMBELI TELAH KEMBALI: JNE IS BACK!</span> 🚚<br><br>
                            Halo Kakak Seller! Kabar baik buat toko Kakak yang pelanggannya sering nanyain JNE. Layanan <span class="wa-bold">JNE resmi aktif kembali</span> di aplikasi SIMASRIM!<br><br>
                            Kakak bisa langsung cetak resi JNE dan kurir akan langsung datang jemput paketnya ke rumah/toko Kakak.<br><br>
                            Yuk, buka lagi opsi pengiriman JNE di toko Kakak biar closingan makin banyak. Gass checkout orderannya hari ini! 🚀✨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_selasa_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_selasa_g3" class="raw-wa-text">📢 *EKSPEDISI IDOLA PEMBELI TELAH KEMBALI: JNE IS BACK!* 🚚

Halo Kakak Seller! Kabar baik buat toko Kakak yang pelanggannya sering nanyain JNE. Layanan *JNE resmi aktif kembali* di aplikasi SIMASRIM!

Kakak bisa langsung cetak resi JNE dan kurir akan langsung datang jemput paketnya ke rumah/toko Kakak.

Yuk, buka lagi opsi pengiriman JNE di toko Kakak biar closingan makin banyak. Gass checkout orderannya hari ini! 🚀✨</pre>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6f42c1; color: #fff;">Rabu, 5 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Apple to Apple: Spesialisasi Ekspedisi</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_rabu', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                ⚖️ <span class="wa-bold">BINGUNG PILIH KURIR BUAT PAKET BERAT? INI PERBANDINGANNYA KAK!</span> ⚖️<br><br>
                Halo Kak! Biar makin pinter ngarahin pelanggan, Mimin mau kasih perbandingan dua raja pengiriman yang lagi ngasih <span class="wa-bold">PROMO CASHBACK 1%</span> di SIMASRIM:<br><br>
                🚛 <span class="wa-bold">KARGO DARAT (SAPX):</span><br>
                Cocok buat kirim barang berat/besar yang nggak buru-buru. Harga sangat stabil, ekonomis, dan jago banget tembus ke daerah pelosok/kabupaten yang susah dijangkau.<br><br>
                ✈️ <span class="wa-bold">KARGO UDARA (Lion Parcel):</span><br>
                Cocok buat kiriman antarpulau yang butuh sampai lebih cepat. Disupport langsung armada pesawat Lion Group, bikin paket terbang mulus ke kota tujuan.<br><br>
                Sama-sama gampang cetak resinya, sama-sama di-pickup, dan <span class="wa-bold">sama-sama kasih Cashback 1% + SIMKoin!</span> Yuk pilih sesuai kebutuhan pelanggan Kakak hari ini! 🚀
            </div>
            <pre id="raw_rabu" class="raw-wa-text">⚖️ *BINGUNG PILIH KURIR BUAT PAKET BERAT? INI PERBANDINGANNYA KAK!* ⚖️

Halo Kak! Biar makin pinter ngarahin pelanggan, Mimin mau kasih perbandingan dua raja pengiriman yang lagi ngasih *PROMO CASHBACK 1%* di SIMASRIM:

🚛 *KARGO DARAT (SAPX):*
Cocok buat kirim barang berat/besar yang nggak buru-buru. Harga sangat stabil, ekonomis, dan jago banget tembus ke daerah pelosok/kabupaten yang susah dijangkau.

✈️ *KARGO UDARA (Lion Parcel):*
Cocok buat kiriman antarpulau yang butuh sampai lebih cepat. Disupport langsung armada pesawat Lion Group, bikin paket terbang mulus ke kota tujuan.

Sama-sama gampang cetak resinya, sama-sama di-pickup, dan *sama-sama kasih Cashback 1% + SIMKoin!* Yuk pilih sesuai kebutuhan pelanggan Kakak hari ini! 🚀</pre>
        </div>

        <div class="step-card" style="border-left-color: #ca8a04;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #ca8a04; color: #fff;">Kamis, 6 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Maksimalkan Spesialisasi Kurir (Anteraja & ID Express)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            <div class="chat-bubble">
                📦 <span class="wa-bold">JNE UDAH BALIK, TAPI JANGAN LUPA DUA JAGOAN INI YA KAK!</span> 📦<br><br>
                Halo Kak! Seneng banget kan JNE udah bisa di-pickup lagi? Tapi inget, di SIMASRIM Kakak punya banyak "senjata rahasia" buat narik pelanggan lho:<br><br>
                1️⃣ <span class="wa-bold">ID Express (Layanan LITE):</span> Pilihan terbaik untuk paket ringan hingga 500 gram dengan ongkir yang lebih hemat. Ongkir jauh lebih hemat, cocok banget buat seller aksesoris, fashion, atau kosmetik!<br>
                2️⃣ <span class="wa-bold">Anteraja (Layanan Reguler):</span> Butuh pickup super cepat dan tepat waktu? Kurir SATRIA Anteraja jagonya! Pelanggan yang butuh barangnya cepat jalan pasti puas banget.<br><br>
                Yuk edukasi pelanggan Kakak buat pakai kurir sesuai kebutuhan mereka. Tinggal klik di SIMASRIM, kurir langsung jemput! 🚀
            </div>
            <pre id="raw_kamis" class="raw-wa-text">📦 *JNE UDAH BALIK, TAPI JANGAN LUPA DUA JAGOAN INI YA KAK!* 📦

Halo Kak! Seneng banget kan JNE udah bisa di-pickup lagi? Tapi inget, di SIMASRIM Kakak punya banyak "senjata rahasia" buat narik pelanggan lho:

1️⃣ *ID Express (Layanan LITE):* Pilihan terbaik untuk paket ringan hingga 500 gram dengan ongkir yang lebih hemat. Ongkir jauh lebih hemat, cocok banget buat seller aksesoris, fashion, atau kosmetik!
2️⃣ *Anteraja (Layanan Reguler):* Butuh pickup super cepat dan tepat waktu? Kurir SATRIA Anteraja jagonya! Pelanggan yang butuh barangnya cepat jalan pasti puas banget.

Yuk edukasi pelanggan Kakak buat pakai kurir sesuai kebutuhan mereka. Tinggal klik di SIMASRIM, kurir langsung jemput! 🚀</pre>
        </div>

        <div class="step-card" style="border-left-color: #20c997;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #20c997; color: #fff;">Jumat, 7 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Push & CS Pipeline</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabJumat" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#jumat-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#jumat-g2" type="button" role="tab">Grup 2 (Baru)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#jumat-g3" type="button" role="tab">Grup 3 (TJS)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="jumat-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎯 <span class="wa-bold">Jumat Berkah! Pantau Downline dan Amankan Tonase Kak!</span><br><br>
                            Halo Juragan! Biar Jumatnya makin berkah, jangan lupa kawal agen-agen di bawah jaringan TJS Kakak buat sapu bersih paketan hari ini! <br><br>
                            Mumpung JNE udah balik, Anteraja lagi ngebut, dan SAPX kasih Cashback 1%, edukasi mereka buat maksimalin pilihan kurir ini. Makin banyak mereka kirim, makin tebal komisi Kakak! 🎁🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g1" class="raw-wa-text">🎯 *Jumat Berkah! Pantau Downline dan Amankan Tonase Kak!*

Halo Juragan! Biar Jumatnya makin berkah, jangan lupa kawal agen-agen di bawah jaringan TJS Kakak buat sapu bersih paketan hari ini! 

Mumpung JNE udah balik, Anteraja lagi ngebut, dan SAPX kasih Cashback 1%, edukasi mereka buat maksimalin pilihan kurir ini. Makin banyak mereka kirim, makin tebal komisi Kakak! 🎁🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="jumat-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">Jumat Produktif! Yuk Sikat Semua Orderan COD Kakak!</span><br><br>
                            Halo Kak, jangan libur dulu! Biasanya orderan COD numpuk nih menjelang akhir pekan. Langsung aja input resi COD-nya pakai aplikasi SIMASRIM!<br><br>
                            Sistem COD kita aman 100%, dana cair lancar. Plus tiap resi sukses = nambah Koin Hadiah Kakak. Yuk pecah telor cetak resinya sekarang! 💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g2" class="raw-wa-text">📦 *Jumat Produktif! Yuk Sikat Semua Orderan COD Kakak!*

Halo Kak, jangan libur dulu! Biasanya orderan COD numpuk nih menjelang akhir pekan. Langsung aja input resi COD-nya pakai aplikasi SIMASRIM!

Sistem COD kita aman 100%, dana cair lancar. Plus tiap resi sukses = nambah Koin Hadiah Kakak. Yuk pecah telor cetak resinya sekarang! 💸</pre>
                </div>

                <div class="tab-pane fade" id="jumat-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📈 <span class="wa-bold">Jumat Berkah, Waktunya Kejar Diskon Ongkir Maksimal!</span> 🔥<br><br>
                            Halo Kak! Sambil <i>packing</i> pesanan hari Jumat ini, ingat ya kalau makin banyak Kakak input paket pengiriman <span class="wa-bold">NON-COD</span> di SIMASRIM, level diskon ongkir Kakak otomatis bakal makin naik (Tiering)!<br><br>
                            Yuk gass semua paket Non-COD hari ini. Diskon makin mantap, laba jualan makin gemuk! 📦💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g3" class="raw-wa-text">📈 *Jumat Berkah, Waktunya Kejar Diskon Ongkir Maksimal!* 🔥

Halo Kak! Sambil _packing_ pesanan hari Jumat ini, ingat ya kalau makin banyak Kakak input paket pengiriman *NON-COD* di SIMASRIM, level diskon ongkir Kakak otomatis bakal makin naik (Tiering)!

Yuk gass semua paket Non-COD hari ini. Diskon makin mantap, laba jualan makin gemuk! 📦💸</pre>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #f8c146;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #f8c146; color:#000;">Sabtu, 8 Agustus - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Closing (Rewards & Recall)</h5>
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
                            🎯 <span class="wa-bold">Weekend Tetap Produktif! Amankan Passive Income Kak!</span><br><br>
                            Halo Kak! Happy weekend! Sambil santai di toko/rumah, yuk pantau transaksi jaringan TJS Kakak di dashboard.<br><br>
                            Pastikan downline Kakak tetap aktif kirim paket hari ini, karena setiap resi mereka adalah penghasilan tambahan buat Kakak. Jangan lupa juga tukarkan SIMKoin Kakak di menu Rewards ya! 🤑🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g1" class="raw-wa-text">🎯 *Weekend Tetap Produktif! Amankan Passive Income Kak!*

Halo Kak! Happy weekend! Sambil santai di toko/rumah, yuk pantau transaksi jaringan TJS Kakak di dashboard.

Pastikan downline Kakak tetap aktif kirim paket hari ini, karena setiap resi mereka adalah penghasilan tambahan buat Kakak. Jangan lupa juga tukarkan SIMKoin Kakak di menu Rewards ya! 🤑🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="sabtu-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎁 <span class="wa-bold">Pecah Telor Weekend! Kumpulin Koin Rewards Yuk!</span><br><br>
                            Halo Kak, jangan biarkan akhir pekan sepi resi! Semua paket yang Kakak kirim via SIMASRIM dan berstatus <span class="wa-bold">Final Delivered</span> bakal otomatis jadi Koin Hadiah (SIMKoin).<br><br>
                            Tukar koin Kakak dengan voucher belanja, gadget, atau kumpulin buat umroh! Yuk masukin orderan Kakak weekend ini biar hadiah impiannya makin dekat! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g2" class="raw-wa-text">🎁 *Pecah Telor Weekend! Kumpulin Koin Rewards Yuk!*

Halo Kak, jangan biarkan akhir pekan sepi resi! Semua paket yang Kakak kirim via SIMASRIM dan berstatus *Final Delivered* bakal otomatis jadi Koin Hadiah (SIMKoin).

Tukar koin Kakak dengan voucher belanja, gadget, atau kumpulin buat umroh! Yuk masukin orderan Kakak weekend ini biar hadiah impiannya makin dekat! 🚀</pre>
                </div>

                <div class="tab-pane fade" id="sabtu-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📈 <span class="wa-bold">Weekend Waktunya Kejar Diskon Ongkir Kak!</span> 🔥<br><br>
                            Halo Kak, semangat akhir pekannya! Sambil packing orderan yang masuk, inget ya kalau makin banyak Kakak input paket pengiriman <span class="wa-bold">NON-COD</span> di SIMASRIM, diskon ongkir Kakak otomatis bakal makin naik (Tiering)!<br><br>
                            Yuk masukin semua orderan hari ini ke sistem SIMASRIM. Kita gass diskon ongkirnya biar keuntungan toko Kakak makin tebal! 📦💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g3" class="raw-wa-text">📈 *Weekend Waktunya Kejar Diskon Ongkir Kak!* 🔥

Halo Kak, semangat akhir pekannya! Sambil packing orderan yang masuk, inget ya kalau makin banyak Kakak input paket pengiriman *NON-COD* di SIMASRIM, diskon ongkir Kakak otomatis bakal makin naik (Tiering)!

Yuk masukin semua orderan hari ini ke sistem SIMASRIM. Kita gass diskon ongkirnya biar keuntungan toko Kakak makin tebal! 📦💸</pre>
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