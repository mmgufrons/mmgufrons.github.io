<?php 
$page_title = "Blueprint Juli #1 | SIMASRIM Operations";
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
        <h2 class="display-5 fw-bold mb-2 text-white">Campaign Transisi Juni-Juli #1</h2>
        <p class="text-white-50 mb-0">Periode: 29 Juni - 4 Juli 2026. Fokus: Mega Release Anteraja, Rewards Live, Referral Brand Besar, & Lion Interpack.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6f42c1; color: #fff;">Senin, 29 Juni - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Push B2B Referral (Brand Besar)</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabSenin" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#senin-g1" type="button" role="tab">Grup 1 (Agen VIP/Aktif)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#senin-g2" type="button" role="tab">Grup 2 (Seller/Baru)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#senin-g3" type="button" role="tab">Grup 3 (Jaringan TJS)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="senin-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🤝 <span class="wa-bold">PUNYA KENALAN OWNER BRAND BESAR? JADIKAN MESIN PASSIVE INCOME KAKAK!</span> 🚀<br><br>
                            Halo Juragan SIMASRIM! 👋<br>
                            Kakak punya koneksi, teman, atau kenalan yang kerja sebagai pengambil keputusan logistik di perusahaan besar, pabrik, atau brand terkenal?<br><br>
                            Jangan disia-siakan! Ajak perusahaan atau brand tersebut bergabung ke SIMASRIM lewat link Referral (TJS) milik Kakak. <br><br>
                            Begitu mereka mendaftar dan mulai memproses pengiriman massal mereka setiap harinya, Kakak otomatis akan mendapatkan <span class="wa-bold">komisi pasif seumur hidup</span> dari setiap resi yang mereka cetak! Transparan, tanpa modal, tanpa perlu ngurusin operasional paketnya. Yuk, tebar link referral Kakak sekarang! 💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_senin_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_senin_g1" class="raw-wa-text">🤝 *PUNYA KENALAN OWNER BRAND BESAR? JADIKAN MESIN PASSIVE INCOME KAKAK!* 🚀

Halo Juragan SIMASRIM! 👋
Kakak punya koneksi, teman, atau kenalan yang kerja sebagai pengambil keputusan logistik di perusahaan besar, pabrik, atau brand terkenal?

Jangan disia-siakan! Ajak perusahaan atau brand tersebut bergabung ke SIMASRIM lewat link Referral (TJS) milik Kakak. 

Begitu mereka mendaftar dan mulai memproses pengiriman massal mereka setiap harinya, Kakak otomatis akan mendapatkan *komisi pasif seumur hidup* dari setiap resi yang mereka cetak! Transparan, tanpa modal, tanpa perlu ngurusin operasional paketnya. Yuk, tebar link referral Kakak sekarang! 💸</pre>
                </div>
                
                <div class="tab-pane fade" id="senin-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🤝 <span class="wa-bold">TAWARIN SUPPLIER KAKAK PAKAI SIMASRIM, DAPET KOMISI PASIF OTOMATIS!</span> 🚀<br><br>
                            Halo Kakak Seller! 👋<br>
                            Pasti Kakak punya Supplier atau Pabrik tempat Kakak ambil stok barang dagangan, kan? Gimana kalau Kakak ajak mereka pakai layanan SIMASRIM juga?<br><br>
                            Cukup kasih link Referral (TJS) dari aplikasi SIMASRIM Kakak ke Supplier tersebut. Kalau mereka daftar dan mulai kirim ribuan paket mereka tiap harinya, Kakak otomatis dapat <span class="wa-bold">komisi pasif terus-menerus!</span><br><br>
                            Gak perlu repot packing, biar tim ekspedisi yang urus, tapi cuan komisinya ngalir terus ke saldo Kakak. Yuk, ajak kenalan bisnis Kakak sekarang! 📦💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_senin_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_senin_g2" class="raw-wa-text">🤝 *TAWARIN SUPPLIER KAKAK PAKAI SIMASRIM, DAPET KOMISI PASIF OTOMATIS!* 🚀

Halo Kakak Seller! 👋
Pasti Kakak punya Supplier atau Pabrik tempat Kakak ambil stok barang dagangan, kan? Gimana kalau Kakak ajak mereka pakai layanan SIMASRIM juga?

Cukup kasih link Referral (TJS) dari aplikasi SIMASRIM Kakak ke Supplier tersebut. Kalau mereka daftar dan mulai kirim ribuan paket mereka tiap harinya, Kakak otomatis dapat *komisi pasif terus-menerus!*

Gak perlu repot packing, biar tim ekspedisi yang urus, tapi cuan komisinya ngalir terus ke saldo Kakak. Yuk, ajak kenalan bisnis Kakak sekarang! 📦💸</pre>
                </div>

                <div class="tab-pane fade" id="senin-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🤝 <span class="wa-bold">BANGUN ASET BISNISMU SENDIRI! Ajak Teman Jualan Pakai SIMASRIM!</span> 🚀<br><br>
                            Halo Kak! 👋 Selain jualan online, Kakak juga bisa lho dapat penghasilan tambahan tanpa batas lewat SIMASRIM.<br><br>
                            Caranya sangat mudah! Buka menu <span class="wa-bold">Jaringanmu</span> di aplikasi, lalu bagikan Link Pendaftaran Referral Kakak ke teman-teman sesama seller atau pebisnis.<br><br>
                            Setiap kali teman Kakak mengirimkan paket, Kakak otomatis mendapatkan bagi hasil dari selisih diskon ongkirnya! Makin banyak teman yang diajak, makin tebal komisi pasif Kakak. Yuk tebar link-nya hari ini! 🌐💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_senin_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_senin_g3" class="raw-wa-text">🤝 *BANGUN ASET BISNISMU SENDIRI! Ajak Teman Jualan Pakai SIMASRIM!* 🚀

Halo Kak! 👋 Selain jualan online, Kakak juga bisa lho dapat penghasilan tambahan tanpa batas lewat SIMASRIM.

Caranya sangat mudah! Buka menu *Jaringanmu* di aplikasi, lalu bagikan Link Pendaftaran Referral Kakak ke teman-teman sesama seller atau pebisnis.

Setiap kali teman Kakak mengirimkan paket, Kakak otomatis mendapatkan bagi hasil dari selisih diskon ongkirnya! Makin banyak teman yang diajak, makin tebal komisi pasif Kakak. Yuk tebar link-nya hari ini! 🌐💸</pre>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #E8232A;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #E8232A; color: #fff;">Selasa, 30 Juni - 13:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Edukasi Keamanan Lion Parcel Interpack</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                ✈️ <span class="wa-bold">KIRIM PAKET KE LUAR NEGERI AMAN & LEGAL? PAKE LION PARCEL INTERPACK!</span> 🌍<br><br>
                Halo Kak! Banyak pelanggan yang mau kirim paket ke luar negeri tapi takut ketahan di Bea Cukai karena masalah keamanan barang?<br><br>
                Gak perlu khawatir! SIMASRIM menghadirkan <span class="wa-bold">Lion Parcel Interpack</span>. Layanan internasional ini menerapkan SOP keselamatan penerbangan yang sangat ketat. Kami memastikan paket diseleksi dari benda-benda <span class="wa-bold">Dangerous Goods</span> (seperti gas mudah terbakar/flammable gas, benda beracun/toxic, zat korosif, dll) sebelum diterbangkan.<br><br>
                Regulasi ketat ini adalah <span class="wa-bold">jaminan profesionalisme kami</span> agar paket pelanggan Kakak bisa melintasi batas negara dengan selamat dan sesuai hukum internasional. Yuk, bantu produk lokal Go-Global dengan tenang bersama SIMASRIM! 📦🌏
            </div>
            <pre id="raw_selasa" class="raw-wa-text">✈️ *KIRIM PAKET KE LUAR NEGERI AMAN & LEGAL? PAKE LION PARCEL INTERPACK!* 🌍

Halo Kak! Banyak pelanggan yang mau kirim paket ke luar negeri tapi takut ketahan di Bea Cukai karena masalah keamanan barang?

Gak perlu khawatir! SIMASRIM menghadirkan *Lion Parcel Interpack*. Layanan internasional ini menerapkan SOP keselamatan penerbangan yang sangat ketat. Kami memastikan paket diseleksi dari benda-benda *Dangerous Goods* (seperti gas mudah terbakar/flammable gas, benda beracun/toxic, zat korosif, dll) sebelum diterbangkan.

Regulasi ketat ini adalah *jaminan profesionalisme kami* agar paket pelanggan Kakak bisa melintasi batas negara dengan selamat dan sesuai hukum internasional. Yuk, bantu produk lokal Go-Global dengan tenang bersama SIMASRIM! 📦🌏</pre>
        </div>

        <div class="step-card" style="border-left-color: #198754;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #198754; color: #fff;">Rabu, 1 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">MEGA RELEASE: Anteraja Full & Dashboard Rewards Live!</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabRabu" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#rabu-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#rabu-g2" type="button" role="tab">Grup 2 (Baru)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#rabu-g3" type="button" role="tab">Grup 3 (Downline)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="rabu-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎉 <span class="wa-bold">MEGA RELEASE 1 JULI! Anteraja 100% Stabil & Dashboard Rewards Resmi DIBUKA!</span> 🚀<br><br>
                            Selamat pagi, Juragan Agen SIMASRIM! 👋 Hari ini kami membawa 2 kabar gembira sekaligus untuk Kakak:<br><br>
                            1️⃣ <span class="wa-bold">Anteraja Full Release:</span> Layanan pickup Anteraja kini resmi rilis penuh! Integrasi manifes jauh lebih stabil, minim kendala, dan siap hajar tonase besar.<br>
                            2️⃣ <span class="wa-bold">Dashboard Rewards LIVE:</span> Koin dari hasil kiriman Kakak selama bulan Juni KINI SUDAH BISA DILIHAT & DITUKAR! 🤑<br><br>
                            Silakan buka aplikasi/web SIMASRIM sekarang juga, masuk ke menu Rewards untuk melihat tumpukan <span class="wa-bold">SIMKoin</span> Kakak! Segera tukarkan dengan Voucher, Logam Mulia, atau tabung terus untuk Umroh! Yuk cetak resi Anteraja Kakak hari ini biar poin makin meledak! 📦🔥
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_rabu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_rabu_g1" class="raw-wa-text">🎉 *MEGA RELEASE 1 JULI! Anteraja 100% Stabil & Dashboard Rewards Resmi DIBUKA!* 🚀

Selamat pagi, Juragan Agen SIMASRIM! 👋 Hari ini kami membawa 2 kabar gembira sekaligus untuk Kakak:

1️⃣ *Anteraja Full Release:* Layanan pickup Anteraja kini resmi rilis penuh! Integrasi manifes jauh lebih stabil, minim kendala, dan siap hajar tonase besar.
2️⃣ *Dashboard Rewards LIVE:* Koin dari hasil kiriman Kakak selama bulan Juni KINI SUDAH BISA DILIHAT & DITUKAR! 🤑

Silakan buka aplikasi/web SIMASRIM sekarang juga, masuk ke menu Rewards untuk melihat tumpukan *SIMKoin* Kakak! Segera tukarkan dengan Voucher, Logam Mulia, atau tabung terus untuk Umroh! Yuk cetak resi Anteraja Kakak hari ini biar poin makin meledak! 📦🔥</pre>
                </div>
                
                <div class="tab-pane fade" id="rabu-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎉 <span class="wa-bold">KABAR GEMBIRA! Anteraja Full Rilis & Fitur Tukar Koin Sudah Aktif!</span> 🚀<br><br>
                            Halo Kakak Agen SIMASRIM! 👋 Awal bulan ini, kami persembahkan update terbesar untuk bisnis Kakak:<br><br>
                            1️⃣ <span class="wa-bold">Layanan Anteraja</span> kini sudah beroperasi secara penuh (Full Release)! Proses pickup dijamin makin lancar dan sistem makin mantap untuk pelanggan Kakak.<br>
                            2️⃣ <span class="wa-bold">SIMASRIM Rewards Resmi Dibuka!</span> Penasaran dengan koin hadiah Kakak dari transaksi bulan kemarin? Buka dashboard Kakak sekarang, cek menu Rewards, dan lihat tabungan koin Kakak! 🤑<br><br>
                            Makin sering kirim paket pakai Anteraja, makin cepat koin ngumpul buat ditukar hadiah keren. Cek aplikasinya sekarang Kak! 📦✨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_rabu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_rabu_g2" class="raw-wa-text">🎉 *KABAR GEMBIRA! Anteraja Full Rilis & Fitur Tukar Koin Sudah Aktif!* 🚀

Halo Kakak Agen SIMASRIM! 👋 Awal bulan ini, kami persembahkan update terbesar untuk bisnis Kakak:

1️⃣ *Layanan Anteraja* kini sudah beroperasi secara penuh (Full Release)! Proses pickup dijamin makin lancar dan sistem makin mantap untuk pelanggan Kakak.
2️⃣ *SIMASRIM Rewards Resmi Dibuka!* Penasaran dengan koin hadiah Kakak dari transaksi bulan kemarin? Buka dashboard Kakak sekarang, cek menu Rewards, dan lihat tabungan koin Kakak! 🤑

Makin sering kirim paket pakai Anteraja, makin cepat koin ngumpul buat ditukar hadiah keren. Cek aplikasinya sekarang Kak! 📦✨</pre>
                </div>

                <div class="tab-pane fade" id="rabu-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎉 <span class="wa-bold">AWAL BULAN BANYAK KEJUTAN: Anteraja Makin Stabil & Koin Hadiah Bisa Dicek!</span> 🚀<br><br>
                            Halo Kak! Semangat pagi di tanggal 1 Juli! Biar makin semangat jualannya, mulai hari ini layanan <span class="wa-bold">Anteraja</span> di aplikasi SIMASRIM sudah Full Release dan siap bantu kurir jemput paketan Kakak dengan aman.<br><br>
                            Satu lagi! Sekarang Kakak sudah bisa buka Menu <span class="wa-bold">Rewards</span> di dalam aplikasi untuk mengecek tabungan <span class="wa-bold">SIMKoin</span> Kakak. Ingat, tiap resi yang sukses sampai, otomatis nambah koin! Yuk perbanyak kirimannya dan tukarkan hadiahnya! 🎁📦
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_rabu_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_rabu_g3" class="raw-wa-text">🎉 *AWAL BULAN BANYAK KEJUTAN: Anteraja Makin Stabil & Koin Hadiah Bisa Dicek!* 🚀

Halo Kak! Semangat pagi di tanggal 1 Juli! Biar makin semangat jualannya, mulai hari ini layanan *Anteraja* di aplikasi SIMASRIM sudah Full Release dan siap bantu kurir jemput paketan Kakak dengan aman.

Satu lagi! Sekarang Kakak sudah bisa buka Menu *Rewards* di dalam aplikasi untuk mengecek tabungan *SIMKoin* Kakak. Ingat, tiap resi yang sukses sampai, otomatis nambah koin! Yuk perbanyak kirimannya dan tukarkan hadiahnya! 🎁📦</pre>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #0dcaf0;">
            <div class="step-header">
                <div>
                    <span class="badge bg-info text-dark mb-1">Kamis, 2 Juli - 14:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Reminder: Cek Dashboard & Cetak Resi</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                💡 <span class="wa-bold">BELUM SEMPAT CEK KOIN HADIAH? YUK BUKA DASHBOARD SEKARANG!</span> 🎁<br><br>
                Halo Kak! Kemarin udah sempat buka menu Rewards di SIMASRIM belum? <br><br>
                Banyak agen dan seller yang kaget karena ternyata koin dari hasil kiriman paket mereka selama bulan lalu udah bisa ditukar dengan Voucher Belanja, lho!<br><br>
                Biar koin Kakak makin bertambah cepat, pastikan hari ini semua orderan dikirim menggunakan sistem SIMASRIM ya. Opsi <span class="wa-bold">Anteraja</span> juga lagi on-fire banget buat pickup cepat. Makin banyak resi = makin banyak koin. Sikat, Kak! 🚀✨
            </div>
            <pre id="raw_kamis" class="raw-wa-text">💡 *BELUM SEMPAT CEK KOIN HADIAH? YUK BUKA DASHBOARD SEKARANG!* 🎁

Halo Kak! Kemarin udah sempat buka menu Rewards di SIMASRIM belum? 

Banyak agen dan seller yang kaget karena ternyata koin dari hasil kiriman paket mereka selama bulan lalu udah bisa ditukar dengan Voucher Belanja, lho!

Biar koin Kakak makin bertambah cepat, pastikan hari ini semua orderan dikirim menggunakan sistem SIMASRIM ya. Opsi *Anteraja* juga lagi on-fire banget buat pickup cepat. Makin banyak resi = makin banyak koin. Sikat, Kak! 🚀✨</pre>
        </div>

        <div class="text-center mt-5 mb-4">
            <h3 class="fw-bold text-dark"><i class="fas fa-rocket me-2 text-primary"></i>Weekend Push (Akhir Pekan)</h3>
            <p class="text-muted">Targeted broadcast untuk menjaga ritme transaksi di akhir pekan.</p>
        </div>

        <div class="step-card" style="border-left-color: #f8c146;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #f8c146; color:#000;">Jumat, 3 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Persiapan Weekend</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_jumat', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                📦 <span class="wa-bold">SIAP-SIAP WEEKEND, AMANKAN PENGIRIMAN PELANGGAN!</span> 🚀<br><br>
                Halo Kak! Besok udah weekend nih, biasanya banyak pembeli yang rewel minta barang cepet dikirim.<br><br>
                Jangan sampai pusing, langsung aja input semua orderan hari ini pakai aplikasi SIMASRIM! Mau reguler? Ada Anteraja, J&T, Lion, SAPX. Mau jualan aman ke luar negeri? Ada Lion Parcel Interpack!<br><br>
                Fokus jualan aja Kak, biar masalah kurir dan pickup jadi urusan SIMASRIM. Yuk cetak resinya sekarang sebelum jadwal pickup sore berakhir! 🏁
            </div>
            <pre id="raw_jumat" class="raw-wa-text">📦 *SIAP-SIAP WEEKEND, AMANKAN PENGIRIMAN PELANGGAN!* 🚀

Halo Kak! Besok udah weekend nih, biasanya banyak pembeli yang rewel minta barang cepet dikirim.

Jangan sampai pusing, langsung aja input semua orderan hari ini pakai aplikasi SIMASRIM! Mau reguler? Ada Anteraja, J&T, Lion, SAPX. Mau jualan aman ke luar negeri? Ada Lion Parcel Interpack!

Fokus jualan aja Kak, biar masalah kurir dan pickup jadi urusan SIMASRIM. Yuk cetak resinya sekarang sebelum jadwal pickup sore berakhir! 🏁</pre>
        </div>

        <div class="step-card" style="border-left-color: #6c757d;">
            <div class="step-header">
                <div>
                    <span class="badge bg-secondary mb-1">Sabtu, 4 Juli - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Closing Terarah</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabSabtu" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sabtu-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g2" type="button" role="tab">Grup 2 (Baru)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g3" type="button" role="tab">Grup 3 (Downline)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="sabtu-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎯 <span class="wa-bold">Weekend Tetap Produktif! Pantau Downline dan Amankan Koinnya!</span><br><br>
                            Halo Kak! Biar liburannya tetap produktif, jangan lupa dorong agen-agen di bawah jaringan TJS Kakak buat terus aktif cetak resi ya! Ingat, tiap resi mereka adalah <span class="wa-bold">passive income</span> buat Kakak.<br><br>
                            Plus, pantau terus menu Rewards di dashboard Kakak. Semua paket akhir pekan yang statusnya Delivered bakal nambah pundi-pundi SIMKoin. Selamat berakhir pekan dan salam omzet melimpah! 🎁🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g1" class="raw-wa-text">🎯 *Weekend Tetap Produktif! Pantau Downline dan Amankan Koinnya!*

Halo Kak! Biar liburannya tetap produktif, jangan lupa dorong agen-agen di bawah jaringan TJS Kakak buat terus aktif cetak resi ya! Ingat, tiap resi mereka adalah *passive income* buat Kakak.

Plus, pantau terus menu Rewards di dashboard Kakak. Semua paket akhir pekan yang statusnya Delivered bakal nambah pundi-pundi SIMKoin. Selamat berakhir pekan dan salam omzet melimpah! 🎁🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="sabtu-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎁 <span class="wa-bold">Pecah Telor Weekend Ini Biar Poin Rewards Kakak Nambah Cepat!</span><br><br>
                            Halo Kak, jangan biarkan akhir pekan sepi resi! Sekarang kan menu <span class="wa-bold">Rewards</span> sudah aktif, sayang banget kalau Kakak diam aja.<br><br>
                            Tiap paket yang Kakak kirim via SIMASRIM dan sukses terkirim akan langsung dihitung jadi Koin Hadiah. Yuk masukin orderan Kakak weekend ini biar hadiah impiannya cepet di-redeem! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g2" class="raw-wa-text">🎁 *Pecah Telor Weekend Ini Biar Poin Rewards Kakak Nambah Cepat!*

Halo Kak, jangan biarkan akhir pekan sepi resi! Sekarang kan menu *Rewards* sudah aktif, sayang banget kalau Kakak diam aja.

Tiap paket yang Kakak kirim via SIMASRIM dan sukses terkirim akan langsung dihitung jadi Koin Hadiah. Yuk masukin orderan Kakak weekend ini biar hadiah impiannya cepet di-redeem! 🚀</pre>
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