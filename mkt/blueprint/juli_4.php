<?php 
$page_title = "Blueprint Juli #4 | SIMASRIM Operations";
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
    <div class="container position-relative z-1">
        <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm border border-warning">Active Blueprint</span>
        <h2 class="display-5 fw-bold mb-2 text-white">Campaign Juli - Pekan #4</h2>
        <p class="text-white-50 mb-0">Periode: 20 - 25 Juli 2026. Fokus: Stabilitas Kargo (SAPX/Lion), Hardware (EDC/Soundbox), Spesialisasi 3PL, & Akselerasi PPOB.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="step-card" style="border-left-color: #7b2cbf;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #7b2cbf; color: #fff;">Senin, 20 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Stabilitas Kargo: SAPX (Darat) & Lion (Udara)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_senin', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            <div class="chat-bubble">
                🚛 <span class="wa-bold">KARGO UDARA LAGI FLUKTUATIF? SAPX KARGO SOLUSI STABILNYA!</span> 🚛<br><br>
                Halo Kak! Lagi heboh tarif kargo udara naik turun, bikin margin jualan jadi gak pasti kan?<br><br>
                Tenang Kak, di SIMASRIM Kakak punya solusi biar bisnis tetap jalan. Untuk barang berat dan besar, pakai <span class="wa-bold">SAPX Kargo</span>! Tarifnya darat-nya jauh lebih stabil dan ramah di kantong, jadi margin Kakak tetap terjaga.<br><br>
                Kalau tetap butuh jalur udara, manfaatkan <span class="wa-bold">Lion Parcel</span> di aplikasi kita. Selain cepat, ada <span class="wa-bold">Ekstra Cashback 1%</span> yang bantu nutupin selisih ongkir Kakak. Yuk, pilih kurir yang paling pas buat beban paket Kakak hari ini! 📦💸
            </div>
            <pre id="raw_senin" class="raw-wa-text">🚛 *KARGO UDARA LAGI FLUKTUATIF? SAPX KARGO SOLUSI STABILNYA!* 🚛

Halo Kak! Lagi heboh tarif kargo udara naik turun, bikin margin jualan makin tipis, kan?

Tenang Kak, di SIMASRIM Kakak punya solusi biar bisnis tetap jalan. Untuk barang berat dan besar, pakai *SAPX Kargo*! Tarifnya jauh lebih merakyat dan super stabil untuk barang berat.

Kalau tetap butuh jalur udara, manfaatkan *Lion Parcel* di aplikasi kita. Selain cepat, ada *Ekstra Cashback 1%* yang bantu nutupin margin ongkir Kakak. Yuk, pilih kurir yang paling pas buat beban paket Kakak hari ini! 📦💸</pre>
        </div>

        <div class="step-card" style="border-left-color: #198754;">
            <div class="step-header">
                <div>
                    <span class="badge bg-success mb-1">Selasa, 21 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Profesional Outlet (EDC & Soundbox)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            <div class="chat-bubble">
                💳 <span class="wa-bold">Bikin Loket Kakak Makin Profesional & Anti Penipuan!</span> 🔊<br><br>
                Halo Kak! Mau loket Kakak kelihatan lebih canggih dan bikin pelanggan makin percaya?<br><br>
                Lengkapi loket Kakak dengan:<br>
                1. <span class="wa-bold">Mesin EDC SIMASRIM:</span> Tersedia pilihan Mini ATM (Bank) untuk tarik tunai/transfer atau EDC Non-Bank untuk terima pembayaran kartu debit. Profesional banget di mata pelanggan!<br>
                2. <span class="wa-bold">SQRIS Soundbox:</span> Gak perlu ribet cek HP tiap ada QRIS masuk. Mesin bakal bunyi otomatis kalau pembayaran sukses. Anti bukti transfer palsu!<br><br>
                Cek detail fiturnya di www.simasrim.com/edc & www.sqris.id/?ref=8726. Balas "MAU ALAT" buat info pembelian! 🚀
            </div>
            <pre id="raw_selasa" class="raw-wa-text">💳 *Bikin Loket Kakak Makin Profesional & Anti Penipuan!* 🔊

Halo Kak! Mau loket Kakak kelihatan lebih canggih dan bikin pelanggan makin percaya?

Lengkapi loket Kakak dengan:
1. *Mesin EDC SIMASRIM:* Tersedia pilihan Mini ATM (Bank) untuk tarik tunai/transfer atau EDC Non-Bank untuk terima pembayaran kartu debit. Profesional banget di mata pelanggan!
2. *SQRIS Soundbox:* Gak perlu ribet cek HP tiap ada QRIS masuk. Mesin bakal bunyi otomatis kalau pembayaran sukses. Anti bukti transfer palsu!

Cek detail fiturnya di www.simasrim.com/edc & www.sqris.id/?ref=8726. Balas "MAU ALAT" buat info pembelian! 🚀</pre>
        </div>

        <div class="step-card" style="border-left-color: #fd7e14;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #fd7e14; color:#fff;">Rabu, 22 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Segmentasi Spesialisasi 3PL</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabRabu" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#rabu-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#rabu-g2" type="button" role="tab">Grup 2 (Baru)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#rabu-g3" type="button" role="tab">Grup 3 (Seller)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="rabu-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">Kawal Ekspedisi Andalan Jaringan/Pelanggan Kakak!</span><br><br>
                            Halo Juragan! Biar jaringan/pelanggan Kakak makin jago, ajak mereka pakai spesialisasi kurir yang pas:<br>
                            - <span class="wa-bold">Anteraja:</span> Pickup tercepat buat pelanggan yang buru-buru.<br>
                            - <span class="wa-bold">ID Express Lite:</span> Pilihan paling hemat buat paketan di bawah 500gr.<br>
                            - <span class="wa-bold">Paxel:</span> Solusi kiriman makanan beku/sameday.<br><br>
                            Edukasi agen Kakak buat pilih kurir sesuai kebutuhan, biar kepuasan pelanggan tetap terjaga! ✨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_rabu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_rabu_g1" class="raw-wa-text">📦 *Kawal Ekspedisi Andalan Jaringan/Pelanggan Kakak!*

Halo Juragan! Biar jaringan/pelanggan Kakak makin jago, ajak mereka pakai spesialisasi kurir yang pas:
- *Anteraja:* Pickup tercepat buat pelanggan yang buru-buru.
- *ID Express Lite:* Pilihan paling hemat buat paketan di bawah 500gr.
- *Paxel:* Solusi kiriman makanan beku/sameday.

Edukasi agen Kakak buat pilih kurir sesuai kebutuhan, biar kepuasan pelanggan tetap terjaga! ✨</pre>
                </div>
                
                <div class="tab-pane fade" id="rabu-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">Cari Kurir yang Pas? SIMASRIM Punya Banyak Pilihan!</span><br><br>
                            Halo Kak! Bingung mau pakai kurir apa? Tenang, di SIMASRIM Kakak bebas pilih:<br>
                            - Mau pickup super kilat? Pakai <span class="wa-bold">Anteraja</span>.<br>
                            - Mau kirim barang ringan biar ongkir murah? Pakai <span class="wa-bold">ID Express Lite</span>.<br>
                            - Mau kirim makanan biar gak basi? Pakai <span class="wa-bold">Paxel</span>.<br><br>
                            Pilih kurir sesuai kebutuhan jualan Kakak. Yuk buka dashboard dan pilih ekspedisi yang paling cocok! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_rabu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_rabu_g2" class="raw-wa-text">📦 *Cari Kurir yang Pas? SIMASRIM Punya Banyak Pilihan!*

Halo Kak! Bingung mau pakai kurir apa? Tenang, di SIMASRIM Kakak bebas pilih:
- Mau pickup super kilat? Pakai *Anteraja*.
- Mau kirim barang ringan biar ongkir murah? Pakai *ID Express Lite*.
- Mau kirim makanan biar gak basi? Pakai *Paxel*.

Pilih kurir sesuai kebutuhan jualan Kakak. Yuk buka dashboard dan pilih ekspedisi yang paling cocok! 🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="rabu-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">Spesialisasi Kurir = Kepuasan Pelanggan Kakak!</span><br><br>
                            Halo Kakak Seller! Jangan asal kirim, pakai ekspedisi yang pas buat jualan Kakak:<br>
                            - Kirim barang kecil? <span class="wa-bold">ID Express Lite</span> (cuma setengah kilo!).<br>
                            - Butuh pickup tepat waktu? <span class="wa-bold">Anteraja</span> jagonya.<br>
                            - Kirim makanan beku? <span class="wa-bold">Paxel</span> biar tetap segar.<br><br>
                            Yuk, pilih kurir yang tepat biar pelanggan makin setia belanja sama Kakak! ✨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_rabu_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_rabu_g3" class="raw-wa-text">📦 *Spesialisasi Kurir = Kepuasan Pelanggan Kakak!*

Halo Kakak Seller! Jangan asal kirim, pakai ekspedisi yang pas buat jualan Kakak:
- Kirim barang kecil? *ID Express Lite* (cuma setengah kilo!).
- Butuh pickup tepat waktu? *Anteraja* jagonya.
- Kirim makanan beku? *Paxel* biar tetap segar.

Yuk, pilih kurir yang tepat biar pelanggan makin setia belanja sama Kakak! ✨</pre>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6f42c1; color: #fff;">Kamis, 23 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Push PPOB & Tiket Akhir Bulan</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                💸 <span class="wa-bold">PANEN CUAN DARI TAGIHAN & TIKET DI AKHIR BULAN!</span> 💸<br><br>
                Halo Kak! Jangan cuma fokus kirim paket, manfaatkan juga fitur <span class="wa-bold">PPOB dan Tiket Perjalanan</span> di aplikasi SIMASRIM Kakak!<br><br>
                Akhir bulan gini pasti banyak warga yang bayar tagihan listrik, cicilan, atau pesen tiket liburan. Kakak bisa jadi loket resminya dan ambil komisi adminnya sendiri. Yuk, pasang status WA Kakak sekarang biar warga tahu loket Kakak melayani semua pembayaran tagihan! 🚀✨
            </div>
            <pre id="raw_kamis" class="raw-wa-text">💸 *PANEN CUAN DARI TAGIHAN & TIKET DI AKHIR BULAN!* 💸

Halo Kak! Jangan cuma fokus kirim paket, manfaatkan juga fitur *PPOB dan Tiket Perjalanan* di aplikasi SIMASRIM Kakak!

Akhir bulan gini pasti banyak warga yang bayar tagihan listrik, cicilan, atau pesen tiket liburan. Kakak bisa jadi loket resminya dan ambil komisi adminnya sendiri. Yuk, pasang status WA Kakak sekarang biar warga tahu loket Kakak melayani semua pembayaran tagihan! 🚀✨</pre>
        </div>

        <!-- MULAI INJEKSI WEEKEND CLOSING -->
        <div class="text-center mt-5 mb-4">
            <h3 class="fw-bold text-dark"><i class="fas fa-flag-checkered me-2 text-primary"></i>Weekend Closing & Recall</h3>
            <p class="text-muted">Broadcast untuk menjaga ritme transaksi di akhir pekan.</p>
        </div>

        <div class="step-card" style="border-left-color: #20c997;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #20c997; color: #fff;">Jumat, 24 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Jumat Berkah & CS Follow Up</h5>
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
                            Halo Juragan! Biar Jumatnya makin berkah, jangan lupa kawal agen-agen di bawah jaringan TJS Kakak buat sapu bersih paketan hari ini! Ingat, tiap resi mereka yang sukses adalah <span class="wa-bold">passive income</span> buat Kakak.<br><br>
                            Siapin juga loket PPOB Kakak buat nyambut pelanggan akhir pekan. Gas terus cetak resinya! 🎁🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g1" class="raw-wa-text">🎯 *Jumat Berkah! Pantau Downline dan Amankan Tonase Kak!*

Halo Juragan! Biar Jumatnya makin berkah, jangan lupa kawal agen-agen di bawah jaringan TJS Kakak buat sapu bersih paketan hari ini! Ingat, tiap resi mereka yang sukses adalah *passive income* buat Kakak.

Siapin juga loket PPOB Kakak buat nyambut pelanggan akhir pekan. Gas terus cetak resinya! 🎁🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="jumat-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">Jumat Produktif! Yuk Sikat Semua Orderan COD Kakak!</span><br><br>
                            Halo Kak, jangan libur dulu! Biasanya orderan COD numpuk nih menjelang akhir pekan. Langsung aja input resi COD-nya pakai aplikasi SIMASRIM!<br><br>
                            Sistem COD kita aman 100%, dana diproses pas paket Delivered. Plus tiap resi sukses = nambah Koin Hadiah Kakak. Yuk pecah telor cetak resinya sekarang! 💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g2" class="raw-wa-text">📦 *Jumat Produktif! Yuk Sikat Semua Orderan COD Kakak!*

Halo Kak, jangan libur dulu! Biasanya orderan COD numpuk nih menjelang akhir pekan. Langsung aja input resi COD-nya pakai aplikasi SIMASRIM!

Sistem COD kita aman 100%, dana diproses pas paket Delivered. Plus tiap resi sukses = nambah Koin Hadiah Kakak. Yuk pecah telor cetak resinya sekarang! 💸</pre>
                </div>

                <div class="tab-pane fade" id="jumat-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📈 <span class="wa-bold">Jumat Berkah, Waktunya Kejar Diskon Ongkir Maksimal!</span> 🔥<br><br>
                            Halo Kak! Sambil packing orderan yang masuk, ingat ya kalau makin banyak Kakak input paket pengiriman <span class="wa-bold">NON-COD</span> di SIMASRIM, level diskon ongkir Kakak otomatis bakal makin naik (Tiering)!<br><br>
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
                    <span class="badge bg-secondary mb-1">Sabtu, 25 Juli - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Closing (Rewards & Recall)</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabSabtu" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sabtu-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g2" type="button" role="tab">Grup 2 (Baru)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g3" type="button" role="tab">Grup 3 (Downline)</button></li>
            </ul>
            
            <div class="tab-content">
                <!-- MODIFIKASI: GRUP 1 (VIP) - Fokus bantu agen & SIMKoin dgn template forward -->
                <div class="tab-pane fade show active" id="sabtu-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🏆 <span class="wa-bold">Weekend Penentuan! Push Agen Kakak Biar SIMKoin Meluber!</span><br><br>
                            Halo Juragan! Weekend gini biasanya agen pada santai, yuk disenggol dikit biar tetap gas cetak resi. Ingat, tiap resi sukses dari jaringan TJS otomatis jadi tambahan <span class="wa-bold">SIMKoin</span> buat Kakak!<br><br>
                            <span class="text-muted fst-italic">💡 Tips: Kakak bisa forward pesan ini ke grup agen Kakak:</span><br>
                            <span class="wa-bold">"Halo tim! Weekend tetap semangat ya, yuk sikat semua paketan hari ini via SIMASRIM biar target kita tembus!"</span><br><br>
                            Kumpulin terus poinnya buat panen hadiah utama Kak! 🏆🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g1" class="raw-wa-text">🏆 *Weekend Penentuan! Push Agen Kakak Biar SIMKoin Meluber!*

Halo Juragan! Weekend gini biasanya agen pada santai, yuk disenggol dikit biar tetap gas cetak resi. Ingat, tiap resi sukses dari jaringan TJS otomatis jadi tambahan *SIMKoin* buat Kakak!

_💡 Tips: Kakak bisa forward pesan ini ke grup agen Kakak:_
*"Halo tim! Weekend tetap semangat ya, yuk sikat semua paketan hari ini via SIMASRIM biar target kita tembus!"*

Kumpulin terus poinnya buat panen hadiah utama Kak! 🏆🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="sabtu-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎁 <span class="wa-bold">Pecah Telor Weekend! Kumpulin Koin Rewards Yuk!</span><br><br>
                            Halo Kak, jangan biarkan akhir pekan sepi resi! Semua paket yang Kakak kirim via SIMASRIM dan berstatus <span class="wa-bold">Final Delivered</span> bakal otomatis jadi Koin Hadiah (SIMKoin).<br><br>
                            Yuk masukin orderan Kakak weekend ini biar tabungan koinnya makin banyak buat ditukar hadiah keren! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g2" class="raw-wa-text">🎁 *Pecah Telor Weekend! Kumpulin Koin Rewards Yuk!*

Halo Kak, jangan biarkan akhir pekan sepi resi! Semua paket yang Kakak kirim via SIMASRIM dan berstatus *Final Delivered* bakal otomatis jadi Koin Hadiah (SIMKoin).

Yuk masukin orderan Kakak weekend ini biar tabungan koinnya makin banyak buat ditukar hadiah keren! 🚀</pre>
                </div>

                <!-- MODIFIKASI: GRUP 3 (SELLER) - Fokus COD Aman di Akhir Pekan -->
                <div class="tab-pane fade" id="sabtu-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🛡️ <span class="wa-bold">Orderan COD Numpuk di Weekend? Aman & Cepat Cair Kak!</span><br><br>
                            Halo Kak! Orderan weekend emang gurih, tapi kadang was-was kalau pembeli lagi liburan. Tenang aja, kirim COD via SIMASRIM dijamin <span class="wa-bold">aman 100%!</span><br><br>
                            Dana otomatis diproses pencairannya begitu paket berstatus Final Delivered. Gak perlu repot nagih, sistem kita transparan. Yuk, hajar semua antrean packing COD hari ini, biar Senin tinggal panen saldo! 💸📦
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g3" class="raw-wa-text">🛡️ *Orderan COD Numpuk di Weekend? Aman & Cepat Cair Kak!*

Halo Kak! Orderan weekend emang gurih, tapi kadang was-was kalau pembeli lagi liburan. Tenang aja, kirim COD via SIMASRIM dijamin *aman 100%!*

Dana otomatis diproses pencairannya begitu paket berstatus Final Delivered. Gak perlu repot nagih, sistem kita transparan. Yuk, hajar semua antrean packing COD hari ini, biar Senin tinggal panen saldo! 💸📦</pre>
                </div>
            </div>
        </div>
        <!-- AKHIR INJEKSI WEEKEND CLOSING -->

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