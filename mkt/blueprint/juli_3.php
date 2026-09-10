<?php 
$page_title = "Blueprint Juli #3 | SIMASRIM Operations";
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
        <h2 class="display-5 fw-bold mb-2 text-white">Campaign Juli - Pekan #3</h2>
        <p class="text-white-50 mb-0">Periode: 13 - 18 Juli 2026. Tema: Isu Kritis Lapangan (Tarif Kargo, Penipuan COD/APK, Overload Gudang).</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="alert alert-danger border-danger border-opacity-25 shadow-sm rounded-4 p-3 mb-4">
            <h6 class="fw-bold mb-1"><i class="fas fa-fire text-danger me-2"></i> ANGLE PEKAN INI: SOLUSI ATAS KRISIS</h6>
            <p class="small mb-0">Pekan ini kita memanfaatkan FUD (Fear, Uncertainty, Doubt) berita logistik nasional. Kita angkat masalahnya (Kargo Mahal, Penipuan, Resi Stuck), lalu posisikan SIMASRIM sebagai Solusi Mutlaknya.</p>
        </div>

        <div class="step-card" style="border-left-color: #ea4c89;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #ea4c89; color: #fff;">Senin, 13 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Solusi Isu Kenaikan Kargo Udara</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_senin', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                ✈️ <span class="wa-bold">TARIF KARGO UDARA LAGI NAIK GILA-GILAAN? TENANG KAK!</span> ✈️<br><br>
                Halo Kak! Belakangan ini lagi heboh berita tarif kargo udara ekspedisi dan biaya tambahan (surcharge) yang naik drastis. Bikin margin jualan makin tipis, kan?<br><br>
                Gak perlu panik! Di SIMASRIM, Kakak punya 2 solusi cerdas buat ngakalin ongkir:<br><br>
                1️⃣ <span class="wa-bold">Pindah ke Kargo Darat/Laut:</span> Gunakan layanan <span class="wa-bold">J&T Cargo</span> atau <span class="wa-bold">SAPX Kargo</span> di aplikasi kami. Tarifnya jauh lebih merakyat dan super stabil untuk barang berat.<br>
                2️⃣ <span class="wa-bold">Tetap Udara Pakai Lion Parcel:</span> Kalau terpaksa butuh cepat via udara, pakai Lion Parcel aja! Karena SIMASRIM ngasih <span class="wa-bold">Ekstra Cashback 1%</span> yang bantu nutupin margin ongkir Kakak.<br><br>
                Siasati biaya ongkir dengan pintar. Yuk cetak resinya di SIMASRIM sekarang biar untung tetap terjaga! 📦💸
            </div>
            <pre id="raw_senin" class="raw-wa-text">✈️ *TARIF KARGO UDARA LAGI NAIK GILA-GILAAN? TENANG KAK!* ✈️

Halo Kak! Belakangan ini lagi heboh berita tarif kargo udara ekspedisi dan biaya tambahan (surcharge) yang naik drastis. Bikin margin jualan makin tipis, kan?

Gak perlu panik! Di SIMASRIM, Kakak punya 2 solusi cerdas buat ngakalin ongkir:

1️⃣ *Pindah ke Kargo Darat/Laut:* Gunakan layanan *J&T Cargo* atau *SAPX Kargo* di aplikasi kami. Tarifnya jauh lebih merakyat dan super stabil untuk barang berat.
2️⃣ *Tetap Udara Pakai Lion Parcel:* Kalau terpaksa butuh cepat via udara, pakai Lion Parcel aja! Karena SIMASRIM ngasih *Ekstra Cashback 1%* yang bantu nutupin margin ongkir Kakak.

Siasati biaya ongkir dengan pintar. Yuk cetak resinya di SIMASRIM sekarang biar untung tetap terjaga! 📦💸</pre>
        </div>

        <div class="step-card" style="border-left-color: #198754;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #198754; color: #fff;">Selasa, 14 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Edukasi Penipuan Bukti Transfer (COD & Offline)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                🚨 <span class="wa-bold">MARAK PENIPUAN BUKTI TRANSFER PALSU! WASPADA KAK!</span> 🚨<br><br>
                Halo Kak! Lagi banyak modus penipuan bukti transfer editan nih. Entah itu pembeli COD yang ngasih bukti palsu ke kurir, oknum ngaku kurir via WA, atau orang yang bayar pulsa di toko tapi struknya bodong.<br><br>
                Biar Kakak aman 100%, ikuti solusi dari SIMASRIM ini:<br><br>
                📦 <span class="wa-bold">Buat Kiriman COD:</span> Jangan pernah percaya bukti transfer via WA dari siapapun! Dana COD Kakak dijamin <span class="wa-bold">penuh oleh sistem SIMASRIM</span>. Selama status resi "Delivered", dana PASTI masuk ke saldo aplikasi. Pantau transparan cuma dari dashboard Kakak!<br>
                💳 <span class="wa-bold">Buat Pembayaran di Toko (PPOB):</span> Jangan cuma lihat HP pelanggan! Pasang <span class="wa-bold">SQRIS Soundbox</span> di meja Kakak. Mesin bakal ngeluarin suara <i>"Pembayaran Berhasil"</i> kalau uang beneran masuk. Anti tipu-tipu!<br><br>
                Jualan tenang, uang aman. Yuk tingkatkan kewaspadaan dan manfaatkan fitur SIMASRIM! 🛡️💸
            </div>
            <pre id="raw_selasa" class="raw-wa-text">🚨 *MARAK PENIPUAN BUKTI TRANSFER PALSU! WASPADA KAK!* 🚨

Halo Kak! Lagi banyak modus penipuan bukti transfer editan nih. Entah itu pembeli COD yang ngasih bukti palsu ke kurir, oknum ngaku kurir via WA, atau orang yang bayar pulsa di toko tapi struknya bodong.

Biar Kakak aman 100%, ikuti solusi dari SIMASRIM ini:

📦 *Buat Kiriman COD:* Jangan pernah percaya bukti transfer via WA dari siapapun! Dana COD Kakak dijamin *penuh oleh sistem SIMASRIM*. Selama status resi "Delivered", dana PASTI masuk ke saldo aplikasi. Pantau transparan cuma dari dashboard Kakak!
💳 *Buat Pembayaran di Toko (PPOB):* Jangan cuma lihat HP pelanggan! Pasang *SQRIS Soundbox* di meja Kakak. Mesin bakal ngeluarin suara _"Pembayaran Berhasil"_ kalau uang beneran masuk. Anti tipu-tipu!

Jualan tenang, uang aman. Yuk tingkatkan kewaspadaan dan manfaatkan fitur SIMASRIM! 🛡️💸</pre>
        </div>

        <div class="step-card" style="border-left-color: #ffc107;">
            <div class="step-header">
                <div>
                    <span class="badge bg-warning text-dark mb-1">Rabu, 15 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Solusi Paket Tertahan / Resi Lemot</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabRabu" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#rabu-g1" type="button" role="tab">Grup 1 (Agen VIP)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#rabu-g2" type="button" role="tab">Grup 2 (Umum/Campur)</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#rabu-g3" type="button" role="tab">Grup 3 (Seller TJS)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="rabu-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">GUDANG KURIR LAGI OVERLOAD? SELAMATKAN PELANGGAN KAKAK!</span> ⚠️<br><br>
                            Halo Juragan Agen! Musim ramai gini biasanya banyak gudang transit ekspedisi yang <i>stuck</i> (tertahan), bikin resi lemot dan pelanggan marah-marah.<br><br>
                            Sebagai Agen SIMASRIM yang cerdas, yuk ajak dan edukasi seller langganan Kakak! Arahkan mereka untuk <span class="wa-bold">pindah ekspedisi</span> lewat loket Kakak. Kalau kurir A lagi numpuk, langsung <i>switch</i> cetak resi pakai kurir B (misal: Anteraja atau ID Express) yang lagi lancar di kota Kakak.<br><br>
                            Fleksibilitas multi-kurir ini yang bikin toko Kakak jadi idola para seller. Ayo tawarkan solusi ini hari ini juga! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_rabu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_rabu_g1" class="raw-wa-text">📦 *GUDANG KURIR LAGI OVERLOAD? SELAMATKAN PELANGGAN KAKAK!* ⚠️

Halo Juragan Agen! Musim ramai gini biasanya banyak gudang transit ekspedisi yang _stuck_ (tertahan), bikin resi lemot dan pelanggan marah-marah.

Sebagai Agen SIMASRIM yang cerdas, yuk ajak dan edukasi seller langganan Kakak! Arahkan mereka untuk *pindah ekspedisi* lewat loket Kakak. Kalau kurir A lagi numpuk, langsung _switch_ cetak resi pakai kurir B (misal: Anteraja atau ID Express) yang lagi lancar di kota Kakak.

Fleksibilitas multi-kurir ini yang bikin toko Kakak jadi idola para seller. Ayo tawarkan solusi ini hari ini juga! 🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="rabu-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">PAKET SERING NYANGKUT DI GUDANG? JANGAN CUMA BERGANTUNG 1 KURIR KAK!</span> ⚠️<br><br>
                            Halo Kak! Keluhan paling sering bulan ini adalah paket nyangkut di gudang sortir dan resi telat *update*. Bikin pelanggan rewel kan?<br><br>
                            Untung Kakak pakai SIMASRIM! Kakak punya kendali penuh buat <span class="wa-bold">bebas pilih/ganti ekspedisi</span>. Kalau lihat kurir A lagi *overload* di kota Kakak, langsung aja ganti cetak resinya pakai kurir B (contoh: Anteraja, Paxel, ID Express).<br><br>
                            Anti pusing, anti komplain pelanggan! Yuk cetak resi paket Kakak sekarang dengan kurir yang paling lancar! 🚀💨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_rabu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_rabu_g2" class="raw-wa-text">📦 *PAKET SERING NYANGKUT DI GUDANG? JANGAN CUMA BERGANTUNG 1 KURIR KAK!* ⚠️

Halo Kak! Keluhan paling sering bulan ini adalah paket nyangkut di gudang sortir dan resi telat update. Bikin pelanggan rewel kan?

Untung Kakak pakai SIMASRIM! Kakak punya kendali penuh buat *bebas pilih/ganti ekspedisi*. Kalau lihat kurir A lagi overload di kota Kakak, langsung aja ganti cetak resinya pakai kurir B (contoh: Anteraja, Paxel, ID Express).

Anti pusing, anti komplain pelanggan! Yuk cetak resi paket Kakak sekarang dengan kurir yang paling lancar! 🚀💨</pre>
                </div>

                <div class="tab-pane fade" id="rabu-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">RESI LEMOT UPDATE BIKIN PEMBELI REWEL? GANTI KURIR SEKARANG KAK!</span> ⚠️<br><br>
                            Halo Kakak Seller jagoan! Orderan lagi ramai tapi ekspedisi langganan malah *overload* dan paket tertahan di gudang?<br><br>
                            Jangan biarkan rating toko turun! Langsung aja <i>switch</i> (ganti) pilihan kurir Kakak di aplikasi SIMASRIM. Cobain pakai <span class="wa-bold">Anteraja</span> atau <span class="wa-bold">ID Express</span> yang rute pickup-nya lagi ngebut dan resinya <i>real-time</i>.<br><br>
                            Jualan tenang, pembeli senang. Yuk cetak resinya sekarang dan biarkan kurir andalan yang jemput ke rumah Kakak! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_rabu_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_rabu_g3" class="raw-wa-text">📦 *RESI LEMOT UPDATE BIKIN PEMBELI REWEL? GANTI KURIR SEKARANG KAK!* ⚠️

Halo Kakak Seller jagoan! Orderan lagi ramai tapi ekspedisi langganan malah overload dan paket tertahan di gudang?

Jangan biarkan rating toko turun! Langsung aja _switch_ (ganti) pilihan kurir Kakak di aplikasi SIMASRIM. Cobain pakai *Anteraja* atau *ID Express* yang rute pickup-nya lagi ngebut dan resinya _real-time_.

Jualan tenang, pembeli senang. Yuk cetak resinya sekarang dan biarkan kurir andalan yang jemput ke rumah Kakak! 🚀</pre>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #dc3545;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #dc3545; color: #fff;">Kamis, 16 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Edukasi Keamanan Siber (Phishing APK)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                🚨 <span class="wa-bold">AWAS FILE .APK! JANGAN ASAL KLIK LINK "CEK RESI" DARI WA!</span> 🚨<br><br>
                Halo Kak! Saat ini sedang ramai modus penipuan siber (phishing) di mana ada oknum pura-pura jadi kurir mengirimkan file bernama "Cek Resi.apk" atau "Foto Paket.apk" ke WhatsApp Kakak.<br><br>
                Mohon diperhatikan:<br>
                🛡️ Kurir partner SIMASRIM <span class="wa-bold">TIDAK PERNAH</span> meminta Kakak menginstal aplikasi di luar PlayStore/AppStore.<br>
                🛡️ <span class="wa-bold">WAJIB HATI-HATI!</span> Untuk melacak status paket dan melihat pencairan dana COD secara aman, pastikan Kakak hanya memantaunya langsung melalui Dashboard/Aplikasi resmi SIMASRIM.<br><br>
                Jika mendapat file aneh, langsung hapus dan blokir nomornya. Jaga keamanan data Kakak agar saldo dan cuan tetap aman! 🙏🔐
            </div>
            <pre id="raw_kamis" class="raw-wa-text">🚨 *AWAS FILE .APK! JANGAN ASAL KLIK LINK "CEK RESI" DARI WA!* 🚨

Halo Kak! Saat ini sedang ramai modus penipuan siber (phishing) di mana ada oknum pura-pura jadi kurir mengirimkan file bernama "Cek Resi.apk" atau "Foto Paket.apk" ke WhatsApp Kakak.

Mohon diperhatikan:
🛡️ Kurir partner SIMASRIM *TIDAK PERNAH* meminta Kakak menginstal aplikasi di luar PlayStore/AppStore.
🛡️ *WAJIB HATI-HATI!* Untuk melacak status paket dan melihat pencairan dana COD secara aman, pastikan Kakak hanya memantaunya langsung melalui Dashboard/Aplikasi resmi SIMASRIM.

Jika mendapat file aneh, langsung hapus dan blokir nomornya. Jaga keamanan data Kakak agar saldo dan cuan tetap aman! 🙏🔐</pre>
        </div>

        <div class="step-card" style="border-left-color: #20c997;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #20c997; color: #fff;">Jumat, 17 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Push (Jumat Berkah)</h5>
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
                            Sistem COD kita aman 100%, dana cair pas paket Delivered. Plus tiap resi sukses = nambah Koin Hadiah Kakak. Yuk pecah telor cetak resinya sekarang! 💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g2" class="raw-wa-text">📦 *Jumat Produktif! Yuk Sikat Semua Orderan COD Kakak!*

Halo Kak, jangan libur dulu! Biasanya orderan COD numpuk nih menjelang akhir pekan. Langsung aja input resi COD-nya pakai aplikasi SIMASRIM!

Sistem COD kita aman 100%, dana cair pas paket Delivered. Plus tiap resi sukses = nambah Koin Hadiah Kakak. Yuk pecah telor cetak resinya sekarang! 💸</pre>
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
                    <span class="badge mb-1" style="background: #f8c146; color:#000;">Sabtu, 18 Juli - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Gamification & Recall</h5>
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
                            🎁 <span class="wa-bold">Kejar Koin Hadiah di Akhir Pekan! Jangan Kasih Kendor Kak!</span><br><br>
                            Halo Kak, jangan biarkan akhir pekan sepi resi! Semua paket yang Kakak kirim via SIMASRIM dan berstatus <span class="wa-bold">Final Delivered</span> bakal otomatis jadi Koin Hadiah (SIMKoin).<br><br>
                            Tukar koin Kakak dengan voucher belanja, gadget, atau kumpulin buat umroh! Yuk masukin orderan Kakak weekend ini biar hadiah impiannya makin dekat! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g2" class="raw-wa-text">🎁 *Kejar Koin Hadiah di Akhir Pekan! Jangan Kasih Kendor Kak!*

Halo Kak, jangan biarkan akhir pekan sepi resi! Semua paket yang Kakak kirim via SIMASRIM dan berstatus *Final Delivered* bakal otomatis jadi Koin Hadiah (SIMKoin).

Tukar koin Kakak dengan voucher belanja, gadget, atau kumpulin buat umroh! Yuk masukin orderan Kakak weekend ini biar hadiah impiannya makin dekat! 🚀</pre>
                </div>

                <div class="tab-pane fade" id="sabtu-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📈 <span class="wa-bold">Weekend Waktunya Kejar Diskon Ongkir Kak!</span> 🔥<br><br>
                            Halo Kak, semangat akhir pekannya! Sambil packing orderan yang masuk, inget ya kalau makin banyak Kakak input paket pengiriman <span class="wa-bold">NON-COD</span> di SIMASRIM, diskon ongkir Kakak otomatis bakal makin naik!<br><br>
                            Yuk masukin semua orderan hari ini ke sistem SIMASRIM. Kita gass diskon ongkirnya biar keuntungan toko Kakak makin tebal! 📦💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g3" class="raw-wa-text">📈 *Weekend Waktunya Kejar Diskon Ongkir Kak!* 🔥

Halo Kak, semangat akhir pekannya! Sambil packing orderan yang masuk, inget ya kalau makin banyak Kakak input paket pengiriman *NON-COD* di SIMASRIM, diskon ongkir Kakak otomatis bakal makin naik!

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