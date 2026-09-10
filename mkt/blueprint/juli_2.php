<?php 
$page_title = "Blueprint Juli #2 | SIMASRIM Operations";
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
        <h2 class="display-5 fw-bold mb-2 text-white">Campaign Juli - Pekan #2</h2>
        <p class="text-white-50 mb-0">Periode: 6 - 11 Juli 2026. Fokus: Edukasi SOP J&T Express, Push 4 Ekspedisi, & Akselerasi Alat Payment.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="alert alert-danger border-danger border-opacity-25 shadow-sm rounded-4 p-3 mb-4">
            <h6 class="fw-bold mb-1"><i class="fas fa-exclamation-triangle text-danger me-2"></i> PEMBERITAHUAN JADWAL PADAT</h6>
            <p class="small mb-0">Pekan ini memiliki volume informasi operasional yang tinggi. Jadwal blast diatur menjadi <strong>2x sehari (Pagi & Siang)</strong> dari Senin s/d Kamis agar informasi bisa tersampaikan maksimal tanpa <i>spamming</i>.</p>
        </div>

        <div class="step-card" style="border-left-color: #dc3545;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #dc3545; color: #fff;">Senin, 6 Juli - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Pengingat SOP Detail Kiriman J&T Express</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_senin_pagi', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            
            <div class="chat-bubble">
                🚨 <span class="wa-bold">PENGINGAT PENTING: TULIS ISI PAKET J&T EXPRESS DENGAN DETAIL!</span> 🚨<br><br>
                Halo Kakak Agen SIMASRIM! 👋<br>
                Sekadar mengingatkan kembali, saat memproses resi J&T Express, mohon <span class="wa-bold">TIDAK</span> menuliskan kata umum seperti "Dokumen" atau "Doc" pada kolom isi barang ya Kak!<br><br>
                Harap tuliskan jenis dokumennya secara spesifik. Contoh: "Surat Jalan", "Sertifikat Tanah", "Ijazah", atau "BPKB".<br><br>
                <span class="wa-bold">Kenapa harus detail?</span> Agar tim ekspedisi bisa memberikan prioritas penanganan sesuai tingkat berharganya dokumen tersebut jika terjadi kendala di lapangan. Yuk biasakan input data lebih akurat! 🙏📦
            </div>
            <pre id="raw_senin_pagi" class="raw-wa-text">🚨 *PENGINGAT PENTING: TULIS ISI PAKET J&T EXPRESS DENGAN DETAIL!* 🚨

Halo Kakak Agen SIMASRIM! 👋
Sekadar mengingatkan kembali, saat memproses resi J&T Express, mohon *TIDAK* menuliskan kata umum seperti "Dokumen" atau "Doc" pada kolom isi barang ya Kak!

Harap tuliskan jenis dokumennya secara spesifik. Contoh: "Surat Jalan", "Sertifikat Tanah", "Ijazah", atau "BPKB".

*Kenapa harus detail?* Agar tim ekspedisi bisa memberikan prioritas penanganan sesuai tingkat berharganya dokumen tersebut jika terjadi kendala di lapangan. Yuk biasakan input data lebih akurat! 🙏📦</pre>
        </div>

        <div class="step-card" style="border-left-color: #dc3545;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #dc3545; color: #fff;">Senin, 6 Juli - 14:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Warning J&T (EZ vs DOC/Asuransi)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_senin_siang', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            
            <div class="chat-bubble">
                ⚠️ <span class="wa-bold">PERINGATAN FATAL: JANGAN ASAL PILIH LAYANAN UNTUK DOKUMEN BERHARGA!</span> ⚠️<br><br>
                Halo Kak! Menyambung info pagi tadi soal pengiriman J&T Express, tolong perhatikan betul pemilihan layanannya ya!<br><br>
                Jangan pernah mengirimkan berkas sangat berharga menggunakan layanan J&T EZ reguler tanpa asuransi! <span class="wa-bold">Maksimal ganti rugi layanan EZ jika paket hilang HANYA Rp 100.000.</span><br><br>
                Untuk dokumen penting, <span class="wa-bold">WAJIB</span> arahkan pelanggan/seller menggunakan layanan khusus <span class="wa-bold">J&T DOC</span> atau tambahkan <span class="wa-bold">ASURANSI</span> pengiriman agar nilainya ter-cover penuh. Mari lindungi paket pelanggan dengan edukasi yang tepat! 🛡️📜
            </div>
            <pre id="raw_senin_siang" class="raw-wa-text">⚠️ *PERINGATAN FATAL: JANGAN ASAL PILIH LAYANAN UNTUK DOKUMEN BERHARGA!* ⚠️

Halo Kak! Menyambung info pagi tadi soal pengiriman J&T Express, tolong perhatikan betul pemilihan layanannya ya!

Jangan pernah mengirimkan berkas sangat berharga menggunakan layanan J&T EZ reguler tanpa asuransi! *Maksimal ganti rugi layanan EZ jika paket hilang HANYA Rp 100.000.*

Untuk dokumen penting, *WAJIB* arahkan pelanggan/seller menggunakan layanan khusus *J&T DOC* atau tambahkan *ASURANSI* pengiriman agar nilainya ter-cover penuh. Mari lindungi paket pelanggan dengan edukasi yang tepat! 🛡️📜</pre>
        </div>

        <div class="step-card" style="border-left-color: #2563eb;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #2563eb; color: #fff;">Selasa, 7 Juli - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Push Layanan ID Express (LITE)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa_pagi', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            
            <div class="chat-bubble">
                🔵 <span class="wa-bold">PAKET KECIL NUMPUK? ID EXPRESS LITE BIKIN MARGIN MAKIN GENDUT!</span> 🔵<br><br>
                Halo Kak! Tau gak rahasia agen dan seller pintar ngakalin margin keuntungan? Kalau ada kiriman paket kecil di bawah 500 gram (seperti aksesoris, kosmetik, atau dokumen ringan), mereka selalu pakai layanan <span class="wa-bold">ID Express LITE</span>!<br><br>
                Karena hitungannya cuma <span class="wa-bold">Setengah Kilo</span>, sisa biaya ongkirnya bisa Kakak atur jadi margin tambahan agen, atau dijadikan promo subsidi ongkir buat narik lebih banyak pembeli. Pintar kan?<br><br>
                Coba cek tumpukan paket Kakak hari ini, pilih yang ringan-ringan, dan cetak resinya pakai ID Express sekarang! 📦💨
            </div>
            <pre id="raw_selasa_pagi" class="raw-wa-text">🔵 *PAKET KECIL NUMPUK? ID EXPRESS LITE BIKIN MARGIN MAKIN GENDUT!* 🔵

Halo Kak! Tau gak rahasia agen dan seller pintar ngakalin margin keuntungan? Kalau ada kiriman paket kecil di bawah 500 gram (seperti aksesoris, kosmetik, atau dokumen ringan), mereka selalu pakai layanan *ID Express LITE*!

Karena hitungannya cuma *Setengah Kilo*, sisa biaya ongkirnya bisa Kakak atur jadi margin tambahan agen, atau dijadikan promo subsidi ongkir buat narik lebih banyak pembeli. Pintar kan?

Coba cek tumpukan paket Kakak hari ini, pilih yang ringan-ringan, dan cetak resinya pakai ID Express sekarang! 📦💨</pre>
        </div>

        <div class="step-card" style="border-left-color: #198754;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #198754; color: #fff;">Selasa, 7 Juli - 14:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Akselerasi Payment: Mesin EDC</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa_siang', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            
            <div class="chat-bubble">
                💳 <span class="wa-bold">LOKET KAKAK MAKIN PROFESIONAL DENGAN MESIN EDC SIMASRIM!</span> 💳<br><br>
                Halo Kak! Sering ada pelanggan mau kirim paket atau bayar tagihan tapi nanyain: <i>"Bisa gesek debit gak?"</i><br><br>
                Jangan biarkan mereka lari ke toko sebelah! SIMASRIM menyediakan solusi Mesin EDC yang bisa disesuaikan dengan kebutuhan loket Kakak:<br>
                ✅ <span class="wa-bold">EDC Mini ATM (Bank):</span> Bisa tarik tunai dan transfer, fitur komplit!<br>
                ✅ <span class="wa-bold">EDC Non-Bank:</span> Tanpa birokrasi bank yang ribet, biaya murah, khusus untuk terima pembayaran (gesek/tap).<br><br>
                Fasilitasi pelanggan Kakak biar makin nyaman transaksi. Cek info lengkap dan perbandingannya di: <a href="https://www.simasrim.com/edc" target="_blank" class="fw-bold text-decoration-none">www.simasrim.com/edc</a>. Minat? Balas chat ini ya! 🚀
            </div>
            <pre id="raw_selasa_siang" class="raw-wa-text">💳 *LOKET KAKAK MAKIN PROFESIONAL DENGAN MESIN EDC SIMASRIM!* 💳

Halo Kak! Sering ada pelanggan mau kirim paket atau bayar tagihan tapi nanyain: _"Bisa gesek debit gak?"_

Jangan biarkan mereka lari ke toko sebelah! SIMASRIM menyediakan solusi Mesin EDC yang bisa disesuaikan dengan kebutuhan loket Kakak:
✅ *EDC Mini ATM (Bank):* Bisa tarik tunai dan transfer, fitur komplit!
✅ *EDC Non-Bank:* Tanpa birokrasi bank yang ribet, biaya murah, khusus untuk terima pembayaran (gesek/tap).

Fasilitasi pelanggan Kakak biar makin nyaman transaksi. Cek info lengkap dan perbandingannya di: www.simasrim.com/edc. Minat? Balas chat ini ya! 🚀</pre>
        </div>

        <div class="step-card" style="border-left-color: #E8232A;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #E8232A; color: #fff;">Rabu, 8 Juli - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Push Layanan Anteraja (SLA Tepat Waktu)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_rabu_pagi', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            
            <div class="chat-bubble">
                🔴 <span class="wa-bold">TAWARKAN ANTERAJA KE PELANGGAN, NIKMATI PICKUP TEPAT WAKTU!</span> ⚡<br><br>
                Halo Kakak Agen & Seller SIMASRIM!<br><br>
                Punya pelanggan walk-in yang butuh paketnya cepat jalan? Atau pembeli online yang rewel nanyain resi? <br><br>
                Yuk, proaktif tawarkan layanan <span class="wa-bold">Anteraja</span> ke mereka! Kurir SATRIA Anteraja terkenal tanggap menjemput paket secara terjadwal langsung ke loket/toko Kakak. Pembaruan tracking resinya juga sangat mulus alias <i>real-time</i>.<br><br>
                Dengan merekomendasikan Anteraja, pelanggan puas, operasional Kakak pun aman tanpa repot. Gass cetak resi Anteraja hari ini! 📦🔥
            </div>
            <pre id="raw_rabu_pagi" class="raw-wa-text">🔴 *TAWARKAN ANTERAJA KE PELANGGAN, NIKMATI PICKUP TEPAT WAKTU!* ⚡

Halo Kakak Agen & Seller SIMASRIM!

Punya pelanggan walk-in yang butuh paketnya cepat jalan? Atau pembeli online yang rewel nanyain resi? 

Yuk, proaktif tawarkan layanan *Anteraja* ke mereka! Kurir SATRIA Anteraja terkenal tanggap menjemput paket secara terjadwal langsung ke loket/toko Kakak. Pembaruan tracking resinya juga sangat mulus alias _real-time_.

Dengan merekomendasikan Anteraja, pelanggan puas, operasional Kakak pun aman tanpa repot. Gass cetak resi Anteraja hari ini! 📦🔥</pre>
        </div>

        <div class="step-card" style="border-left-color: #ffc107;">
            <div class="step-header">
                <div>
                    <span class="badge bg-warning text-dark mb-1">Rabu, 8 Juli - 14:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Akselerasi Payment: SQRIS Soundbox</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_rabu_siang', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            
            <div class="chat-bubble">
                🔊 <span class="wa-bold">CEGAH BUKTI TRANSFER PALSU! PAKAI QRIS YANG BISA BUNYI SENDIRI!</span> 🔊<br><br>
                Halo Kak! Masih sering repot bolak-balik buka HP buat ngecek mutasi tiap kali ada pelanggan yang bayar pakai QRIS? Atau was-was kena tipu struk editan?<br><br>
                Yuk pasang <span class="wa-bold">SQRIS Soundbox</span> di loket Kakak. Tiap kali pelanggan scan dan berhasil bayar, mesinnya bakal teriak ngeluarin suara otomatis (misal: <i>"Pembayaran QRIS lima puluh ribu rupiah berhasil"</i>).<br><br>
                Anti repot, anti tipu-tipu! Terima beres, Kakak tinggal duduk manis dengar mesinnya teriak cuan.<br>
                👉 Info detail & pendaftaran: <a href="https://sqris.id/?ref=8726" target="_blank" class="fw-bold text-decoration-none">sqris.id/?ref=8726</a><br><br>
                Balas "MAU SOUNDBOX" untuk dibantu prosesnya oleh Admin ya Kak! 🚀
            </div>
            <pre id="raw_rabu_siang" class="raw-wa-text">🔊 *CEGAH BUKTI TRANSFER PALSU! PAKAI QRIS YANG BISA BUNYI SENDIRI!* 🔊

Halo Kak! Masih sering repot bolak-balik buka HP buat ngecek mutasi tiap kali ada pelanggan yang bayar pakai QRIS? Atau was-was kena tipu struk editan?

Yuk pasang *SQRIS Soundbox* di loket Kakak. Tiap kali pelanggan scan dan berhasil bayar, mesinnya bakal teriak ngeluarin suara otomatis (misal: _"Pembayaran QRIS lima puluh ribu rupiah berhasil"_).

Anti repot, anti tipu-tipu! Terima beres, Kakak tinggal duduk manis dengar mesinnya teriak cuan.
👉 Info detail & pendaftaran: sqris.id/?ref=8726

Balas "MAU SOUNDBOX" untuk dibantu prosesnya oleh Admin ya Kak! 🚀</pre>
        </div>

        <div class="step-card" style="border-left-color: #ea4c89;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #ea4c89; color: #fff;">Kamis, 9 Juli - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Push Layanan Lion Parcel (Udara & Cashback)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis_pagi', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            
            <div class="chat-bubble">
                🦁 <span class="wa-bold">KIRIM KELUAR PULAU? ATAU KIRIM KARGO BESAR? RAJANYA UDARA: LION PARCEL!</span> ✈️<br><br>
                Halo Kak! Punya paketan yang mesti nyebrang pulau? Atau malah punya paketan berat kargo yang bikin pusing mikirin ongkirnya?<br><br>
                Serahkan sama rajanya jalur udara: <span class="wa-bold">Lion Parcel</span> di SIMASRIM! Armada pesawatnya siap terbangin paket Kakak ke pelosok nusantara dengan aman. Tarif kargonya juga luar biasa kompetitif!<br><br>
                Plus, jangan lupa ada ekstra <span class="wa-bold">Cashback Saldo 1%</span> yang terus menumpuk di akun Kakak setiap kali paket Lion Parcel berstatus Delivered lho! Dobel untungnya kan? Yuk cetak resi Lion-mu pagi ini! 📦💰
            </div>
            <pre id="raw_kamis_pagi" class="raw-wa-text">🦁 *KIRIM KELUAR PULAU? ATAU KIRIM KARGO BESAR? RAJANYA UDARA: LION PARCEL!* ✈️

Halo Kak! Punya paketan yang mesti nyebrang pulau? Atau malah punya paketan berat kargo yang bikin pusing mikirin ongkirnya?

Serahkan sama rajanya jalur udara: *Lion Parcel* di SIMASRIM! Armada pesawatnya siap terbangin paket Kakak ke pelosok nusantara dengan aman. Tarif kargonya juga luar biasa kompetitif!

Plus, jangan lupa ada ekstra *Cashback Saldo 1%* yang terus menumpuk di akun Kakak setiap kali paket Lion Parcel berstatus Delivered lho! Dobel untungnya kan? Yuk cetak resi Lion-mu pagi ini! 📦💰</pre>
        </div>

        <div class="step-card" style="border-left-color: #ca8a04;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #ca8a04; color: #fff;">Kamis, 9 Juli - 14:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Push Layanan Paxel (Cold-Chain/Sameday)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis_siang', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            
            <div class="chat-bubble">
                ❄️ <span class="wa-bold">JUALAN FROZEN FOOD ATAU KUE BASAH? BIAR GAK BASI, KIRIM PAKE PAXEL KAK!</span> 🏍️<br><br>
                Halo Kak! Punya dagangan makanan beku (frozen food), daging, atau kue basah yang gampang basi kalau kelamaan di jalan?<br><br>
                Aman! Kakak tinggal buka SIMASRIM dan pilih kurir <span class="wa-bold">Paxel Sameday</span>. Paxel dilengkapi fasilitas <i>Cold-Chain</i> (pendingin) yang bikin suhu paket Kakak tetap terjaga kesegarannya sampai ke tangan pembeli di hari yang sama!<br><br>
                Kurir Hero Paxel siap meluncur ke lokasi buat jemput paketan lezat Kakak. Ayo gass input orderannya sebelum batas jam pickup habis sore ini! 🍗🚚
            </div>
            <pre id="raw_kamis_siang" class="raw-wa-text">❄️ *JUALAN FROZEN FOOD ATAU KUE BASAH? BIAR GAK BASI, KIRIM PAKE PAXEL KAK!* 🏍️

Halo Kak! Punya dagangan makanan beku (frozen food), daging, atau kue basah yang gampang basi kalau kelamaan di jalan?

Aman! Kakak tinggal buka SIMASRIM dan pilih kurir *Paxel Sameday*. Paxel dilengkapi fasilitas _Cold-Chain_ (pendingin) yang bikin suhu paket Kakak tetap terjaga kesegarannya sampai ke tangan pembeli di hari yang sama!

Kurir Hero Paxel siap meluncur ke lokasi buat jemput paketan lezat Kakak. Ayo gass input orderannya sebelum batas jam pickup habis sore ini! 🍗🚚</pre>
        </div><div class="text-center mt-5 mb-4">
            <h3 class="fw-bold text-dark"><i class="fas fa-flag-checkered me-2 text-primary"></i>Weekend Closing & Rewards Push</h3>
            <p class="text-muted">Targeted broadcast (3 Grup) untuk menjaga ritme transaksi di akhir pekan.</p>
        </div>

        <div class="step-card" style="border-left-color: #f8c146;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #f8c146; color:#000;">Jumat, 10 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Preparation</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabJumat" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#jumat-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#jumat-g2" type="button" role="tab">Grup 2 (Baru)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#jumat-g3" type="button" role="tab">Grup 3 (TJS)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="jumat-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎯 <span class="wa-bold">Jumat Berkah! Pantau Downline dan Amankan Tonase Kak!</span><br><br>
                            Halo Kak! Biar Jumatnya makin berkah, jangan lupa kawal agen-agen di bawah jaringan TJS Kakak buat sapu bersih paketan hari ini! Ingat, tiap resi mereka yang sukses adalah <span class="wa-bold">passive income</span> buat Kakak.<br><br>
                            Plus, jangan lupa tukarkan SIMKoin di menu Rewards Kakak! Atau mau ditabung buat umroh? Boleh banget! Gas terus cetak resinya! 🎁🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g1" class="raw-wa-text">🎯 *Jumat Berkah! Pantau Downline dan Amankan Tonase Kak!*

Halo Kak! Biar Jumatnya makin berkah, jangan lupa kawal agen-agen di bawah jaringan TJS Kakak buat sapu bersih paketan hari ini! Ingat, tiap resi mereka yang sukses adalah *passive income* buat Kakak.

Plus, jangan lupa tukarkan SIMKoin di menu Rewards Kakak! Atau mau ditabung buat umroh? Boleh banget! Gas terus cetak resinya! 🎁🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="jumat-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">Jumat Produktif! Yuk Sikat Semua Orderan COD Kakak!</span><br><br>
                            Halo Kak, jangan libur dulu! Biasannya orderan COD numpuk nih menjelang akhir pekan. Langsung aja input resi COD-nya pakai aplikasi SIMASRIM!<br><br>
                            Sistem COD kita transparan, dana langsung masuk antrean cair pas paket Delivered. Plus tiap resi sukses = nambah Koin Hadiah Kakak. Yuk cetak resinya sebelum jam pickup kelar! 💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g2" class="raw-wa-text">📦 *Jumat Produktif! Yuk Sikat Semua Orderan COD Kakak!*

Halo Kak, jangan libur dulu! Biasannya orderan COD numpuk nih menjelang akhir pekan. Langsung aja input resi COD-nya pakai aplikasi SIMASRIM!

Sistem COD kita transparan, dana langsung masuk antrean cair pas paket Delivered. Plus tiap resi sukses = nambah Koin Hadiah Kakak. Yuk cetak resinya sebelum jam pickup kelar! 💸</pre>
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

        <div class="step-card" style="border-left-color: #6c757d;">
            <div class="step-header">
                <div>
                    <span class="badge bg-secondary mb-1">Sabtu, 11 Juli - 09:00 WIB</span>
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
                            🎁 <span class="wa-bold">Weekend Tiba! Sudah Berapa Banyak Koin Hadiah Kakak Terkumpul?</span><br><br>
                            Halo Kak! Happy weekend! Sambil santai di toko/rumah, yuk buka menu SIMASRIM Rewards di dashboard Kakak!<br><br>
                            Setiap resi yang Final Delivered diam-diam terus menambah pundi koin Kakak. Jangan kasih celah kendor, terus proses resi pelanggan hari ini dan bersiap redeem voucher belanja sampai emas batangan! 🤑🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g1" class="raw-wa-text">🎁 *Weekend Tiba! Sudah Berapa Banyak Koin Hadiah Kakak Terkumpul?*

Halo Kak! Happy weekend! Sambil santai di toko/rumah, yuk buka menu SIMASRIM Rewards di dashboard Kakak!

Setiap resi yang Final Delivered diam-diam terus menambah pundi koin Kakak. Jangan kasih celah kendor, terus proses resi pelanggan hari ini dan bersiap redeem voucher belanja sampai emas batangan! 🤑🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="sabtu-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">Pecah Telor Weekend! Orderan Sabtu Jangan Disimpen Kak!</span><br><br>
                            Halo Kak! Pelanggan yang checkout hari Sabtu biasanya paling gak sabar nungguin resi. <br><br>
                            Biar toko Kakak dapat <i>rating</i> bagus, langsung aja cetak resinya pakai SIMASRIM. Kurir tetep jalan nge-pickup ke lokasi Kakak kok walaupun akhir pekan. Yuk cetak sekarang biar pembeli puas dan kasih bintang lima! ⭐⭐⭐⭐⭐
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g2" class="raw-wa-text">📦 *Pecah Telor Weekend! Orderan Sabtu Jangan Disimpen Kak!*

Halo Kak! Pelanggan yang checkout hari Sabtu biasanya paling gak sabar nungguin resi. 

Biar toko Kakak dapat _rating_ bagus, langsung aja cetak resinya pakai SIMASRIM. Kurir tetep jalan nge-pickup ke lokasi Kakak kok walaupun akhir pekan. Yuk cetak sekarang biar pembeli puas dan kasih bintang lima! ⭐⭐⭐⭐⭐</pre>
                </div>

                <div class="tab-pane fade" id="sabtu-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            💳 <span class="wa-bold">Weekend Rame Pembeli? Jangan Lupa Tawarkan PPOB Kak!</span> 🔥<br><br>
                            Halo Kak! Akhir pekan gini orang-orang suka males keluar rumah buat isi pulsa atau beli token listrik.<br><br>
                            Nah, Kakak bisa layanin mereka langsung dari HP pakai fitur <span class="wa-bold">PPOB SIMASRIM</span>! Sambil jualan produk, sambil narik cuan admin tagihan. Keuntungannya lumayan banget buat nambah jajan akhir pekan. Gass transaksiin sekarang Kak! 📱💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g3" class="raw-wa-text">💳 *Weekend Rame Pembeli? Jangan Lupa Tawarkan PPOB Kak!* 🔥

Halo Kak! Akhir pekan gini orang-orang suka males keluar rumah buat isi pulsa atau beli token listrik.

Nah, Kakak bisa layanin mereka langsung dari HP pakai fitur *PPOB SIMASRIM*! Sambil jualan produk, sambil narik cuan admin tagihan. Keuntungannya lumayan banget buat nambah jajan akhir pekan. Gass transaksiin sekarang Kak! 📱💸</pre>
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