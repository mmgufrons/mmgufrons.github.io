<?php
$page_title = "Blueprint Agustus #4 | SIMASRIM Operations";
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
        <h2 class="display-5 fw-bold mb-2 text-white">Campaign Agustus - Pekan #4</h2>
        <p class="text-white-50 mb-0">Periode: 24 - 29 Agustus 2026. Fokus: Rilis 4 Ekspedisi Baru, Fitur Tambahan Drop-Off, Isu Biaya Admin Marketplace, CS Care, & Panduan Aplikasi.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <!-- SENIN: RILIS EKSPEDISI BARU MULTI-SPESIALISASI (UMUM) -->
        <div class="step-card" style="border-left-color: #198754;">
            <div class="step-header">
                <div>
                    <span class="badge bg-success mb-1">Senin, 24 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Rilis 4 Ekspedisi Baru Multi-Spesialisasi</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_senin', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>

            <div class="chat-bubble">
                🚀 <span class="wa-bold">KABAR GEMBIRA! SIMASRIM KEDATANGAN 4 EKSPEDISI BARU SEKALIGUS!</span> 🚀<br><br>
                Halo Kak! Biar pilihan pengiriman loket & toko online Kakak makin lengkap, SIMASRIM resmi menghadirkan 4 mitra ekspedisi baru ke dalam sistem!<br><br>
                Sekarang Kakak sudah bisa cetak resi untuk:<br>
                📦 <span class="wa-bold">Ninja Express:</span> Spesialis pengiriman retail harian & jangkauan luas.<br>
                📦 <span class="wa-bold">TIKI:</span> Pelopor ekspedisi legendaris dengan jaringan luas & opsi layanan lengkap (ONS/Reguler).<br>
                📦 <span class="wa-bold">NCS:</span> Ahlinya kirim dokumen penting, pengiriman korporat, & barang sensitif.<br>
                📦 <span class="wa-bold">RPX:</span> Solusi logistik cepat, layanan premium, & penanganan kargo.<br><br>
                Makin banyak pilihan kurir, makin gampang penuhi kebutuhan pelanggan tanpa perlu pindah aplikasi! Yuk coba tes input resinya sekarang! 🔥✨
            </div>
            <pre id="raw_senin" class="raw-wa-text">🚀 *KABAR GEMBIRA! SIMASRIM KEDATANGAN 4 EKSPEDISI BARU SEKALIGUS!* 🚀

Halo Kak! Biar pilihan pengiriman loket & toko online Kakak makin lengkap, SIMASRIM resmi menghadirkan 4 mitra ekspedisi baru ke dalam sistem!

Sekarang Kakak sudah bisa cetak resi untuk:
📦 *Ninja Express:* Spesialis pengiriman retail harian & jangkauan luas.
📦 *TIKI:* Pelopor ekspedisi legendaris dengan jaringan luas & opsi layanan lengkap (ONS/Reguler).
📦 *NCS:* Ahlinya kirim dokumen penting, pengiriman korporat, & barang sensitif.
📦 *RPX:* Solusi logistik cepat, layanan premium, & penanganan kargo.

Makin banyak pilihan kurir, makin gampang penuhi kebutuhan pelanggan tanpa perlu pindah aplikasi! Yuk coba tes input resinya sekarang! 🔥✨</pre>
        </div>

        <!-- RABU: UPDATE FITUR TAMBAHAN DROP-OFF (UMUM) -->
        <div class="step-card" style="border-left-color: #0dcaf0;">
            <div class="step-header">
                <div>
                    <span class="badge bg-info text-dark mb-1">Rabu, 26 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Update Fitur Ekspedisi Tambahan Drop-Off</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_rabu', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>

            <div class="chat-bubble">
                📍 <span class="wa-bold">KIRIM PAKET MAKIN FLEKSIBEL: LAYANAN DROP-OFF MAKIN LENGKAP!</span> 📍<br><br>
                Halo Kak! Sering keburu-buru atau kebetulan lagi lewat dekat gerai ekspedisi? Sekarang kirim paket via SIMASRIM makin praktis!<br><br>
                Selain layanan Pickup gratis ke lokasi, kini ada <span class="wa-bold">tambahan ekspedisi baru</span> yang resmi mendukung fitur <span class="wa-bold">Drop-Off</span> di sistem SIMASRIM:<br>
                ✅ <span class="wa-bold">JNE</span><br>
                ✅ <span class="wa-bold">J&T Cargo</span><br>
                ✅ <span class="wa-bold">TIKI</span><br>
                ✅ <span class="wa-bold">RPX</span><br><br>
                Melengkapi daftar ekspedisi yang sudah bisa Drop-Off sebelumnya, kini Kakak makin bebas pilih mau ditunggu kurir jemput atau titip langsung ke gerai terdekat. Yuk manfaatkan fiturnya hari ini! 🚚⚡
            </div>
            <pre id="raw_rabu" class="raw-wa-text">📍 *KIRIM PAKET MAKIN FLEKSIBEL: LAYANAN DROP-OFF MAKIN LENGKAP!* 📍

Halo Kak! Sering keburu-buru atau kebetulan lagi lewat dekat gerai ekspedisi? Sekarang kirim paket via SIMASRIM makin praktis!

Selain layanan Pickup gratis ke lokasi, kini ada *tambahan ekspedisi baru* yang resmi mendukung fitur *Drop-Off* di sistem SIMASRIM:
✅ *JNE*
✅ *J&T Cargo*
✅ *TIKI*
✅ *RPX*

Melengkapi daftar ekspedisi yang sudah bisa Drop-Off sebelumnya, kini Kakak makin bebas pilih mau ditunggu kurir jemput atau titip langsung ke gerai terdekat. Yuk manfaatkan fiturnya hari ini! 🚚⚡</pre>
        </div>

        <!-- KAMIS: ISU HANGAT LOGISTIK / KENAIKAN BIAYA ADMIN MARKETPLACE -->
        <div class="step-card" style="border-left-color: #ffc107;">
            <div class="step-header">
                <div>
                    <span class="badge bg-warning text-dark mb-1">Kamis, 27 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Isu Logistik: Kenaikan Biaya Layanan Marketplace</h5>
                </div>
            </div>

            <ul class="nav nav-tabs mb-3" id="tabKamis" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#kamis-g1" type="button" role="tab">Grup 1 (Agen Utama / User Lama)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#kamis-g2" type="button" role="tab">Grup 2 (Agen / Seller Baru)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#kamis-g3" type="button" role="tab">Grup 3 (Jaringan / Downline)</button></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="kamis-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            💡 <span class="wa-bold">BIAYA ADMIN MARKETPLACE NAIK? BANTU SELLER SEKITAR KAKAK!</span> 💡<br><br>
                            Halo Juragan! Berita kenaikan biaya admin/layanan marketplace lagi ramai bikin seller pusing karena margin jualan makin mepet.<br><br>
                            Ini kesempatan emas Kakak! Ajak seller-seller di wilayah Kakak buat beralih terima pesanan langsung (via WhatsApp/FB/IG) dan cetak resi lewat akun SIMASRIM. Bantu mereka amankan margin keuntungan toko, sekaligus kembangkan komisi jaringan transaksi Kakak! 💸🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_kamis_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_kamis_g1" class="raw-wa-text">💡 *BIAYA ADMIN MARKETPLACE NAIK? BANTU SELLER SEKITAR KAKAK!* 💡

Halo Juragan! Berita kenaikan biaya admin/layanan marketplace lagi ramai bikin seller pusing karena margin jualan makin mepet.

Ini kesempatan emas Kakak! Ajak seller-seller di wilayah Kakak buat beralih terima pesanan langsung (via WhatsApp/FB/IG) dan cetak resi lewat akun SIMASRIM. Bantu mereka amankan margin keuntungan toko, sekaligus kembangkan komisi jaringan transaksi Kakak! 💸🚀</pre>
                </div>

                <div class="tab-pane fade" id="kamis-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🛍️ <span class="wa-bold">AMANKAN MARGIN! SOLUSI BIAYA ADMIN MARKETPLACE MAKIN MAHAL</span> 🛍️<br><br>
                            Halo Kak! Biaya layanan e-commerce makin hari makin tinggi dan potong margin untung jualan Kakak?<br><br>
                            Saatnya dorong transaksi langsung (Direct Selling via WA/Medsos)! Manfaatkan sistem Multi-Kurir SIMASRIM buat kirim paket pelanggan Kakak. Ongkir tetap kompetitif, bebas biaya admin tinggi, plus diskon resi langsung masuk kantong sendiri! 📈🔥
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_kamis_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_kamis_g2" class="raw-wa-text">🛍️ *AMANKAN MARGIN! SOLUSI BIAYA ADMIN MARKETPLACE MAKIN MAHAL* 🛍️

Halo Kak! Biaya layanan e-commerce makin hari makin tinggi dan potong margin untung jualan Kakak?

Saatnya dorong transaksi langsung (Direct Selling via WA/Medsos)! Manfaatkan sistem Multi-Kurir SIMASRIM buat kirim paket pelanggan Kakak. Ongkir tetap kompetitif, bebas biaya admin tinggi, plus diskon resi langsung masuk kantong sendiri! 📈🔥</pre>
                </div>

                <div class="tab-pane fade" id="kamis-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">JANGAN MAU MARGIN TERGERUS BIAYA ADMIN!</span> 📦<br><br>
                            Halo Kak! Isu kenaikan potongan biaya admin marketplace bikin hasil jualan makin tipis?<br><br>
                            Yuk maksimalkan transaksi mandiri! Pakai fitur cetak resi pengiriman SIMASRIM untuk setiap orderan langsung dari pembeli Kakak. Margin utuh, pengiriman tetap terpercaya dengan banyak pilihan ekspedisi! 🚀✨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_kamis_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_kamis_g3" class="raw-wa-text">📦 *JANGAN MAU MARGIN TERGERUS BIAYA ADMIN!* 📦

Halo Kak! Isu kenaikan potongan biaya admin marketplace bikin hasil jualan makin tipis?

Yuk maksimalkan transaksi mandiri! Pakai fitur cetak resi pengiriman SIMASRIM untuk setiap orderan langsung dari pembeli Kakak. Margin utuh, pengiriman tetap terpercaya dengan banyak pilihan ekspedisi! 🚀✨</pre>
                </div>
            </div>
        </div>

        <!-- JUMAT: REMIND CENTER & BANTUAN TRANSAKSI (CS CARE) -->
        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6f42c1; color: #fff;">Jumat, 28 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Remind Center & Layanan Pengawalan CS Transaksi</h5>
                </div>
            </div>

            <ul class="nav nav-tabs mb-3" id="tabJumat" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#jumat-g1" type="button" role="tab">Grup 1 (Agen Utama / User Lama)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#jumat-g2" type="button" role="tab">Grup 2 (Agen / Seller Baru)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#jumat-g3" type="button" role="tab">Grup 3 (Jaringan / Downline)</button></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="jumat-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🛡️ <span class="wa-bold">KAWAL TRANSAKSI JARINGAN KAKAK DENGAN BANTUAN CS PUSAT!</span> 🛡️<br><br>
                            Halo Juragan! Biar downline dan jaringan Kakak makin tenang bertransaksi, pastikan mereka tahu ke mana harus melapor jika ada kendala.<br><br>
                            Arahkan jaringan Kakak untuk menghubungi CS Bantuan Resmi di <span class="wa-bold">+6280000000000</span> untuk penanganan pengiriman (stuck/retur), PPOB, maupun tiket. Operasional lancar, jaringan makin loyal! 🤝✨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g1" class="raw-wa-text">🛡️ *KAWAL TRANSAKSI JARINGAN KAKAK DENGAN BANTUAN CS PUSAT!* 🛡️

Halo Juragan! Biar downline dan jaringan Kakak makin tenang bertransaksi, pastikan mereka tahu ke mana harus melapor jika ada kendala.

Arahkan jaringan Kakak untuk menghubungi CS Bantuan Resmi di *+6280000000000* untuk penanganan pengiriman (stuck/retur), PPOB, maupun tiket. Operasional lancar, jaringan makin loyal! 🤝✨</pre>
                </div>

                <div class="tab-pane fade" id="jumat-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎧 <span class="wa-bold">ADA KENDALA TRANSAKSI? TIM CS SIAP BANTU SAMPAI TUNTAS!</span> 🎧<br><br>
                            Halo Kak! Mengalami resi stuck, kendala pengiriman paket, gangguan saldo PPOB, atau pemesanan tiket?<br><br>
                            Jangan khawatir! Tim CS SIMASRIM siap mengawal transaksi Kakak sampai selesai. Simpan nomor CS Bantuan Resmi kami di WhatsApp: <span class="wa-bold">+6280000000000</span>. Transaksi aman, usaha makin tenang! 📲💚
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g2" class="raw-wa-text">🎧 *ADA KENDALA TRANSAKSI? TIM CS SIAP BANTU SAMPAI TUNTAS!* 🎧

Halo Kak! Mengalami resi stuck, kendala pengiriman paket, gangguan saldo PPOB, atau pemesanan tiket?

Jangan khawatir! Tim CS SIMASRIM siap mengawal transaksi Kakak sampai selesai. Simpan nomor CS Bantuan Resmi kami di WhatsApp: *+6280000000000*. Transaksi aman, usaha makin tenang! 📲💚</pre>
                </div>

                <div class="tab-pane fade" id="jumat-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            💬 <span class="wa-bold">PUSAT BANTUAN CS SIMASRIM READY BUAT KAKAK!</span> 💬<br><br>
                            Halo Kak! Biar transaksi harian Kakak makin nyaman tanpa rasa khawatir, ingat selalu kontak bantuan resmi SIMASRIM ya.<br><br>
                            Jika ada kendala paket, PPOB, atau layanan lainnya, segera hubungi CS Pusat via WhatsApp di <span class="wa-bold">+6280000000000</span>. Kami siap bantu kelancaran operasional Kakak! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g3" class="raw-wa-text">💬 *PUSAT BANTUAN CS SIMASRIM READY BUAT KAKAK!* 💬

Halo Kak! Biar transaksi harian Kakak makin nyaman tanpa rasa khawatir, ingat selalu kontak bantuan resmi SIMASRIM ya.

Jika ada kendala paket, PPOB, atau layanan lainnya, segera hubungi CS Pusat via WhatsApp di *+6280000000000*. Kami siap bantu kelancaran operasional Kakak! 🚀</pre>
                </div>
            </div>
        </div>

        <!-- SABTU: EDUKASI KEMANDIRIAN (DOKUMEN PANDUAN) -->
        <div class="step-card" style="border-left-color: #f8c146;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #f8c146; color:#000;">Sabtu, 29 Agustus - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Edukasi Kemandirian System: Menu Dokumen Panduan</h5>
                </div>
            </div>

            <ul class="nav nav-tabs mb-3" id="tabSabtu" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sabtu-g1" type="button" role="tab">Grup 1 (Agen Utama / User Lama)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g2" type="button" role="tab">Grup 2 (Agen / Seller Baru)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g3" type="button" role="tab">Grup 3 (Jaringan / Downline)</button></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="sabtu-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📘 <span class="wa-bold">KURANGI TANYA-JAWAB BERULANG, ARAHKAN KE DOKUMEN PANDUAN!</span> 📘<br><br>
                            Halo Juragan! Capek balas pertanyaan teknis yang sama dari jaringan atau downline Kakak?<br><br>
                            Arahkan mereka untuk langsung cek menu <span class="wa-bold">Sidebar > Dokumen Panduan > Panduan Aplikasi</span> di akun SIMASRIM. Semua panduan penggunaan fitur dan petunjuk operasional sudah tersusun rapi. Jaringan mandiri, bisnis Kakak makin efisien! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g1" class="raw-wa-text">📘 *KURANGI TANYA-JAWAB BERULANG, ARAHKAN KE DOKUMEN PANDUAN!* 📘

Halo Juragan! Capek balas pertanyaan teknis yang sama dari jaringan atau downline Kakak?

Arahkan mereka untuk langsung cek menu *Sidebar > Dokumen Panduan > Panduan Aplikasi* di akun SIMASRIM. Semua panduan penggunaan fitur dan petunjuk operasional sudah tersusun rapi. Jaringan mandiri, bisnis Kakak makin efisien! 🚀</pre>
                </div>

                <div class="tab-pane fade" id="sabtu-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📖 <span class="wa-bold">BINGUNG CARA PAKAI FITUR APLIKASI? CEK PANDUAN LENGKAPNYA!</span> 📖<br><br>
                            Halo Kak! Masih ragu atau bingung dengan alur kerja fitur-fitur di aplikasi SIMASRIM?<br><br>
                            Gak perlu pusing! Kakak bisa pelajari tutorial lengkapnya kapan saja via menu: <span class="wa-bold">Sidebar > Dokumen Panduan > Panduan Aplikasi</span>. Langkah-langkahnya praktis dan mudah dipahami. Cek sekarang biar makin mahir! 💡✨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g2" class="raw-wa-text">📖 *BINGUNG CARA PAKAI FITUR APLIKASI? CEK PANDUAN LENGKAPNYA!* 📖

Halo Kak! Masih ragu atau bingung dengan alur kerja fitur-fitur di aplikasi SIMASRIM?

Gak perlu pusing! Kakak bisa pelajari tutorial lengkapnya kapan saja via menu: *Sidebar > Dokumen Panduan > Panduan Aplikasi*. Langkah-langkahnya praktis dan mudah dipahami. Cek sekarang biar makin mahir! 💡✨</pre>
                </div>

                <div class="tab-pane fade" id="sabtu-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📲 <span class="wa-bold">PELAJARI FITUR APLIKASI LEBIH EASY LEWAT MENU PANDUAN!</span> 📲<br><br>
                            Halo Kak! Mau tahu cara cepat cetak resi, cek tarif, atau manfaatkan fitur-fitur keren SIMASRIM?<br><br>
                            Yuk buka menu <span class="wa-bold">Sidebar > Dokumen Panduan > Panduan Aplikasi</span> di aplikasi Kakak. Pelajari petunjuknya agar transaksi harian Kakak makin lancar tanpa kendala! 📦🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g3" class="raw-wa-text">📲 *PELAJARI FITUR APLIKASI LEBIH EASY LEWAT MENU PANDUAN!* 📲

Halo Kak! Mau tahu cara cepat cetak resi, cek tarif, atau manfaatkan fitur-fitur keren SIMASRIM?

Yuk buka menu *Sidebar > Dokumen Panduan > Panduan Aplikasi* di aplikasi Kakak. Pelajari petunjuknya agar transaksi harian Kakak makin lancar tanpa kendala! 📦🚀</pre>
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