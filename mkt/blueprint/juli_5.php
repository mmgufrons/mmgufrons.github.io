<?php 
$page_title = "Blueprint Juli #5 | SIMASRIM Operations";
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
        <h2 class="display-5 fw-bold mb-2 text-white">Campaign Juli - Pekan #5</h2>
        <p class="text-white-50 mb-0">Periode: 27 Juli - 1 Agustus 2026. Fokus: SOP Kelancaran Pickup, Keamanan Nilai Paket, & Update Sistem Seamless.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="step-card" style="border-left-color: #dc3545;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #dc3545; color: #fff;">Senin, 27 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Edukasi Kelancaran Operasional (Branding & Kayu)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_senin', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                🚨 <span class="wa-bold">PENGUMUMAN PENTING: INFO KELANCARAN OPERASIONAL LOKET!</span> 🚨<br><br>
                Halo Kakak Agen SIMASRIM! 👋<br>
                Biar kurir yang jemput paket ke toko Kakak makin lancar dan nggak ada miskomunikasi di lapangan, yuk perhatikan 2 SOP penting ini:<br><br>
                1️⃣ <span class="wa-bold">Tata Letak Spanduk:</span> Pastikan spanduk/logo multi-ekspedisi yang besar dipasang <span class="wa-bold">di dalam area toko saja</span> ya Kak. Untuk di luar toko, cukup gunakan spanduk versi teks standar. Ini sangat membantu menjaga psikologis dan kelancaran kurir (terutama JNE & J&T Cargo) saat merapat ke lokasi Kakak.<br><br>
                2️⃣ <span class="wa-bold">Packing Kayu JNE & J&T Cargo:</span> Saat ini fitur centang otomatis Packing Kayu sedang di-<i>maintenance</i>. Jika ada kiriman pecah belah via 2 kurir tersebut, Kakak <span class="wa-bold">wajib menyiapkan dan memaku kayunya sendiri</span>. Jangan lupa, <span class="wa-bold">berat kayunya wajib ditambahkan ke total berat paket</span> saat input di sistem ya biar nggak kena selisih ongkir!<br><br>
                Mari jaga kelancaran operasional loket kita bersama! 🙏📦
            </div>
            <pre id="raw_senin" class="raw-wa-text">🚨 *PENGUMUMAN PENTING: INFO KELANCARAN OPERASIONAL LOKET!* 🚨

Halo Kakak Agen SIMASRIM! 👋
Biar kurir yang jemput paket ke toko Kakak makin lancar dan nggak ada miskomunikasi di lapangan, yuk perhatikan 2 SOP penting ini:

1️⃣ *Tata Letak Spanduk:* Pastikan spanduk/logo multi-ekspedisi yang besar dipasang *di dalam area toko saja* ya Kak. Untuk di luar toko, cukup gunakan spanduk versi teks standar. Ini sangat membantu menjaga psikologis dan kelancaran kurir (terutama JNE & J&T Cargo) saat merapat ke lokasi Kakak.

2️⃣ *Packing Kayu JNE & J&T Cargo:* Saat ini fitur centang otomatis Packing Kayu sedang di-_maintenance_. Jika ada kiriman pecah belah via 2 kurir tersebut, Kakak *wajib menyiapkan dan memaku kayunya sendiri*. Jangan lupa, *berat kayunya wajib ditambahkan ke total berat paket* saat input di sistem ya biar nggak kena selisih ongkir!

Mari jaga kelancaran operasional loket kita bersama! 🙏📦</pre>
        </div>

        <div class="step-card" style="border-left-color: #198754;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #198754; color: #fff;">Selasa, 28 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Investasi Keamanan: Deklarasi Harga & Asuransi</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabSelasa" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#selasa-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#selasa-g2" type="button" role="tab">Grup 2 (Agen/Loket)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#selasa-g3" type="button" role="tab">Grup 3 (Seller)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="selasa-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🛡️ <span class="wa-bold">EDUKASI JARINGAN KAKAK: SEDIA PAYUNG SEBELUM HUJAN!</span> 🛡️<br><br>
                            Halo Juragan! Yuk ingatkan agen dan jaringan di bawah Kakak soal keamanan paket Non-COD yang nilainya mahal.<br><br>
                            Beri tahu mereka: <span class="wa-bold">Naikkan nilai deklarasi barang secara manual</span> (di bawah Rp 5 Juta) saat input resi di sistem! Meski tanpa asuransi, menaikkan nilai barang bikin ekspedisi lebih <i>aware</i> saat <i>handling</i> paketnya.<br><br>
                            Namun untuk paket yang benar-benar berisiko, wajib edukasi jaringan Kakak untuk <span class="wa-bold">centang ASURANSI</span>. Investasi beberapa ribu rupiah jauh lebih baik daripada harus ganti rugi jutaan rupiah ke pelanggan. Bisnis aman, hati tenang! 💸✨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_selasa_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_selasa_g1" class="raw-wa-text">🛡️ *EDUKASI JARINGAN KAKAK: SEDIA PAYUNG SEBELUM HUJAN!* 🛡️

Halo Juragan! Yuk ingatkan agen dan jaringan di bawah Kakak soal keamanan paket Non-COD yang nilainya mahal.

Beri tahu mereka: *Naikkan nilai deklarasi barang secara manual* (di bawah Rp 5 Juta) saat input resi di sistem! Meski tanpa asuransi, menaikkan nilai barang bikin ekspedisi lebih _aware_ saat handling paketnya.

Namun untuk paket yang benar-benar berisiko, wajib edukasi jaringan Kakak untuk *centang ASURANSI*. Investasi beberapa ribu rupiah jauh lebih baik daripada harus ganti rugi jutaan rupiah ke pelanggan. Bisnis aman, hati tenang! 💸✨</pre>
                </div>
                
                <div class="tab-pane fade" id="selasa-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🛡️ <span class="wa-bold">SEDIA PAYUNG SEBELUM HUJAN: AMANKAN PAKET PELANGGAN KAKAK!</span> 🛡️<br><br>
                            Halo Kakak! Sering terima paketan Non-COD yang dibungkus rapat dan katanya isinya mahal?<br><br>
                            Biar Kakak gak was-was, pastikan Kakak <span class="wa-bold">menaikkan nilai deklarasi barangnya secara manual</span> (di bawah Rp 5 Juta) saat input resi di sistem! Menaikkan nilai ini bikin tim ekspedisi lebih hati-hati <i>handling</i> paketnya.<br><br>
                            Dan kalau isinya memang sangat berharga, tawarkan pelanggan untuk <span class="wa-bold">centang ASURANSI</span>. Edukasi mereka: investasi beberapa ribu rupiah sangat sepadan daripada nombok jutaan kalau paket hilang/rusak. Loket Kakak aman, pelanggan pun tenang! 📦✨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_selasa_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_selasa_g2" class="raw-wa-text">🛡️ *SEDIA PAYUNG SEBELUM HUJAN: AMANKAN PAKET PELANGGAN KAKAK!* 🛡️

Halo Kakak! Sering terima paketan Non-COD yang dibungkus rapat dan katanya isinya mahal?

Biar Kakak gak was-was, pastikan Kakak *menaikkan nilai deklarasi barangnya secara manual* (di bawah Rp 5 Juta) saat input resi di sistem! Menaikkan nilai ini bikin tim ekspedisi lebih hati-hati handling paketnya.

Dan kalau isinya memang sangat berharga, tawarkan pelanggan untuk *centang ASURANSI*. Edukasi mereka: investasi beberapa ribu rupiah sangat sepadan daripada nombok jutaan kalau paket hilang/rusak. Loket Kakak aman, pelanggan pun tenang! 📦✨</pre>
                </div>

                <div class="tab-pane fade" id="selasa-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🛡️ <span class="wa-bold">JAGA ASET JUALAN KAKAK: PASTIKAN DEKLARASI HARGA SESUAI!</span> 🛡️<br><br>
                            Halo Kakak! Jualan produk berharga lumayan tinggi via Non-COD?<br><br>
                            Biar pengirimannya aman, pastikan Kakak <span class="wa-bold">menaikkan nilai deklarasi barang secara manual</span> (di bawah Rp 5 Juta) saat cetak resi di aplikasi SIMASRIM! Walau tanpa asuransi, nilai deklarasi yang sesuai bikin pihak ekspedisi lebih <i>aware</i> mengawal paket Kakak.<br><br>
                            Tapi buat barang yang sangat rawan/mahal, jangan ambil risiko! Langsung aja <span class="wa-bold">centang ASURANSI</span>. Sisihkan sedikit keuntungan demi ketenangan pikiran. Paket aman, bisnis jalan terus! 💸✨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_selasa_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_selasa_g3" class="raw-wa-text">🛡️ *JAGA ASET JUALAN KAKAK: PASTIKAN DEKLARASI HARGA SESUAI!* 🛡️

Halo Kakak! Jualan produk berharga lumayan tinggi via Non-COD?

Biar pengirimannya aman, pastikan Kakak *menaikkan nilai deklarasi barang secara manual* (di bawah Rp 5 Juta) saat cetak resi di aplikasi SIMASRIM! Walau tanpa asuransi, nilai deklarasi yang sesuai bikin pihak ekspedisi lebih _aware_ mengawal paket Kakak.

Tapi buat barang yang sangat rawan/mahal, jangan ambil risiko! Langsung aja *centang ASURANSI*. Sisihkan sedikit keuntungan demi ketenangan pikiran. Paket aman, bisnis jalan terus! 💸✨</pre>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #2563eb;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #2563eb; color: #fff;">Rabu, 29 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Bongkar Rahasia: Resi Kurir Lain Sama Gampangnya!</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_rabu', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                💡 <span class="wa-bold">BONGKAR RAHASIA: TERNYATA CETAK RESI EKSPEDISI LAIN ITU GAMPANG BANGET!</span> 💡<br><br>
                Halo Kak! Selama ini masih ragu mau coba ekspedisi lain karena takut cara cetak resinya beda dan ribet?<br><br>
                Kemarin ada salah satu Agen SIMASRIM yang cerita ke Mimin, dia baru sadar ternyata proses cetak resi kurir lain (seperti SAPX, Anteraja, ID Express, dll) itu <span class="wa-bold">SAMA PERSIS</span> alurnya kayak cetak resi JNE lho! Gak ada yang beda, gak perlu belajar ulang! Tinggal pilih logo ekspedisinya, isi alamat, klik, langsung jadi!<br><br>
                Sayang banget kan kalau pelanggan mau pakai kurir lain tapi Kakak tolak karena takut ribet. Yuk, mulai hari ini manfaatkan SEMUA pilihan ekspedisi di SIMASRIM biar pelanggan makin betah! 🚀📦
            </div>
            <pre id="raw_rabu" class="raw-wa-text">💡 *BONGKAR RAHASIA: TERNYATA CETAK RESI EKSPEDISI LAIN ITU GAMPANG BANGET!* 💡

Halo Kak! Selama ini masih ragu mau coba ekspedisi lain karena takut cara cetak resinya beda dan ribet?

Kemarin ada salah satu Agen SIMASRIM yang cerita ke Mimin, dia baru sadar ternyata proses cetak resi kurir lain (seperti SAPX, Anteraja, ID Express, dll) itu *SAMA PERSIS* alurnya kayak cetak resi JNE lho! Gak ada yang beda, gak perlu belajar ulang! Tinggal pilih logo ekspedisinya, isi alamat, klik, langsung jadi!

Sayang banget kan kalau pelanggan mau pakai kurir lain tapi Kakak tolak karena takut ribet. Yuk, mulai hari ini manfaatkan SEMUA pilihan ekspedisi di SIMASRIM biar pelanggan makin betah! 🚀📦</pre>
        </div>

        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6f42c1; color: #fff;">Kamis, 30 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Update Seamless: PPOB & Tiket Tanpa Password</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabKamis" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#kamis-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#kamis-g2" type="button" role="tab">Grup 2 (Agen)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#kamis-g3" type="button" role="tab">Grup 3 (Seller)</button></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="kamis-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            ⚡ <span class="wa-bold">TRANSAKSI MAKIN NGEBUT! PPOB & TIKET KINI BEBAS PASSWORD!</span> ⚡<br><br>
                            Halo Juragan! Kabar gembira buat jaringan dan loket pelanggan Kakak!<br><br>
                            Sekarang jualan pulsa, token listrik, bayar tagihan, sampai pesan tiket di SIMASRIM udah secepat kilat! Sistem sudah di-<i>update</i> menjadi lebih <i>seamless</i>: <span class="wa-bold">Bebas input password yang bikin ribet!</span><br><br>
                            Cukup pilih produk, klik beli, saldo kepotong otomatis, dan transaksi langsung beres! Yuk infokan kabar baik ini ke seluruh downline dan pelanggan Kakak biar mereka makin rajin pakai PPOB-nya! 💸🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_kamis_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_kamis_g1" class="raw-wa-text">⚡ *TRANSAKSI MAKIN NGEBUT! PPOB & TIKET KINI BEBAS PASSWORD!* ⚡

Halo Juragan! Kabar gembira buat jaringan dan loket pelanggan Kakak!

Sekarang jualan pulsa, token listrik, bayar tagihan, sampai pesan tiket di SIMASRIM udah secepat kilat! Sistem sudah di-_update_ menjadi lebih _seamless_: *Bebas input password yang bikin ribet!*

Cukup pilih produk, klik beli, saldo kepotong otomatis, dan transaksi langsung beres! Yuk infokan kabar baik ini ke seluruh downline dan pelanggan Kakak biar mereka makin rajin pakai PPOB-nya! 💸🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="kamis-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            ⚡ <span class="wa-bold">LAYANI PELANGGAN MAKIN NGEBUT! PPOB KINI BEBAS PASSWORD!</span> ⚡<br><br>
                            Halo Kakak! Paling males kan kalau pelanggan lagi antre beli token listrik atau pulsa, tapi kita harus ribet masukin password dulu?<br><br>
                            Kabar gembira! Sistem PPOB & Tiket SIMASRIM sekarang sudah <span class="wa-bold">TIDAK PERLU PASSWORD LAGI!</span><br><br>
                            Tinggal pilih produk, klik bayar, selesai! Transaksi secepat kilat, pelanggan gak perlu nunggu lama, antrean loket Kakak langsung teratasi. Yuk gas jualan pulsanya hari ini! 📱💨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_kamis_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_kamis_g2" class="raw-wa-text">⚡ *LAYANI PELANGGAN MAKIN NGEBUT! PPOB KINI BEBAS PASSWORD!* ⚡

Halo Kakak! Paling males kan kalau pelanggan lagi antre beli token listrik atau pulsa, tapi kita harus ribet masukin password dulu?

Kabar gembira! Sistem PPOB & Tiket SIMASRIM sekarang sudah *TIDAK PERLU PASSWORD LAGI!*

Tinggal pilih produk, klik bayar, selesai! Transaksi secepat kilat, pelanggan gak perlu nunggu lama, antrean loket Kakak langsung teratasi. Yuk gas jualan pulsanya hari ini! 📱💨</pre>
                </div>

                <div class="tab-pane fade" id="kamis-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            ⚡ <span class="wa-bold">BELI KEBUTUHAN SENDIRI SECEPAT KILAT! PPOB & TIKET BEBAS PASSWORD!</span> ⚡<br><br>
                            Halo Kakak! Lagi sibuk <i>packing</i> tiba-teman kuota abis atau listrik rumah bunyi?<br><br>
                            Gak usah repot pindah aplikasi! Langsung buka SIMASRIM, beli pulsa atau token sekarang <span class="wa-bold">TIDAK PERLU PASSWORD LAGI!</span> Prosesnya super <i>seamless</i>: pilih produk, klik, saldo terpotong, beres!<br><br>
                            Penuhi kebutuhan harian Kakak dengan cepat dan harga agen. Cobain fitur praktisnya sekarang Kak! 🛒📱
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_kamis_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_kamis_g3" class="raw-wa-text">⚡ *BELI KEBUTUHAN SENDIRI SECEPAT KILAT! PPOB & TIKET BEBAS PASSWORD!* ⚡

Halo Kakak! Lagi sibuk _packing_ tiba-teman kuota abis atau listrik rumah bunyi?

Gak usah repot pindah aplikasi! Langsung buka SIMASRIM, beli pulsa atau token sekarang *TIDAK PERLU PASSWORD LAGI!* Prosesnya super _seamless_: pilih produk, klik, saldo terpotong, beres!

Penuhi kebutuhan harian Kakak dengan cepat dan harga agen. Cobain fitur praktisnya sekarang Kak! 🛒📱</pre>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #fd7e14;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #fd7e14; color: #fff;">Jumat, 31 Juli - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Push: Peluang Tambahan via SIMASRIM Mall</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_jumat', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            
            <div class="chat-bubble">
                🛍️ <span class="wa-bold">AKHIR PEKAN BINGUNG MAU JUALAN APA? INTIP SIMASRIM MALL!</span> 🛍️<br><br>
                Halo Kak! Paket jualan lagi sepi menjelang akhir pekan? Jangan cuma diam nunggu orderan, yuk cari peluang baru!<br><br>
                Intip koleksi produk di <span class="wa-bold">mall.simasrim.com</span>! Kakak bisa nemuin barang-barang unik untuk dijual lagi ke pelanggan Kakak. Skemanya gampang banget:<br>
                1. Kakak tawarkan produknya & dapat pesanan.<br>
                2. Kakak order barangnya di SIMASRIM Mall.<br>
                3. <span class="wa-bold">Barang bahkan bisa dikirim langsung ke pelanggan Kakak</span> (Sistem Dropship).<br><br>
                Gak perlu pusing mikirin stok barang, cuan tambahan buat akhir pekan bisa jalan terus. Yuk cek katalognya sekarang! buat kebutuhan pribadi juga bisa banget lhoo~ 💸🚀
            </div>
            <pre id="raw_jumat" class="raw-wa-text">🛍️ *AKHIR PEKAN BINGUNG MAU JUALAN APA? INTIP SIMASRIM MALL!* 🛍️

Halo Kak! Paket jualan lagi sepi menjelang akhir pekan? Jangan cuma diam nunggu orderan, yuk cari peluang baru!

Intip koleksi produk di *mall.simasrim.com*! Kakak bisa nemuin barang-barang unik untuk dijual lagi ke pelanggan Kakak. Skemanya gampang banget:
1. Kakak tawarkan produknya & dapat pesanan.
2. Kakak order barangnya di SIMASRIM Mall.
3. *Barang bahkan bisa dikirim langsung ke pelanggan Kakak* (Sistem Dropship).

Gak perlu pusing mikirin stok barang, cuan tambahan buat akhir pekan bisa jalan terus. Yuk cek katalognya sekarang! buat kebutuhan pribadi juga bisa banget lhoo~ 💸🚀</pre>
        </div>

        <div class="text-center mt-5 mb-4">
            <h3 class="fw-bold text-dark"><i class="fas fa-flag-checkered me-2 text-primary"></i>Weekend Closing & Gamification</h3>
            <p class="text-muted">Targeted broadcast (3 Grup) untuk menjaga retensi di akhir bulan.</p>
        </div>

        <div class="step-card" style="border-left-color: #6c757d;">
            <div class="step-header">
                <div>
                    <span class="badge bg-secondary mb-1">Sabtu, 1 Agustus - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Closing (Rewards & Tiering)</h5>
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
                            🎯 <span class="wa-bold">Awal Bulan Telah Tiba! Pantau Jaringan dan Tabung SIMKoin-nya!</span><br><br>
                            Halo Kak! Happy weekend! Sambil santai di toko/rumah, yuk pantau transaksi jaringan TJS Kakak di dashboard.<br><br>
                            Pastikan downline Kakak tetap aktif kirim paket hari ini, karena setiap resi mereka adalah penghasilan tambahan buat Kakak. Jangan lupa juga tukarkan SIMKoin Kakak di menu Rewards ya! 🤑🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g1" class="raw-wa-text">🎯 *Awal Bulan Telah Tiba! Pantau Jaringan dan Tabung SIMKoin-nya!*

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