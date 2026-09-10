<?php 
$page_title = "Blueprint Juni #3 | SIMASRIM Operations";
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
        <h2 class="display-5 fw-bold mb-2 text-white">Campaign Juni - Pekan #3</h2>
        <p class="text-white-50 mb-0">Periode: 15 - 20 Juni 2026. Fokus: Info SIMASRIM Rewards, Timbangan Kargo, & Alternatif Solusi 3PL.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6f42c1; color: #fff;">Senin, 15 Juni - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Sosialisasi Skema Aturan SIMASRIM Rewards</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabSenin" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#senin-g1" type="button" role="tab">Grup 1 (Agen/VIP)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#senin-g2" type="button" role="tab">Grup 2 (Pasif/Baru)</button>
                </li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="senin-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎁 <span class="wa-bold">ATURAN RESMI PROGRAM SIMASRIM REWARDS SUDAH BERJALAN! 🚀</span><br><br>
                            Halo Juragan SIMASRIM! 👋 Udah siap kejatuhan hadiah melimpah dari tumpukan resi harian Kakak? Biar jalannya bisnis makin mantap, Mimin mau kasih tahu skema resmi pengumpulan koin reward (<span class="wa-bold">SIMKoin</span>) Kakak yang sebenarnya sudah dihitung otomatis sejak 1 Juni kemarin:<br><br>
                            📦 <span class="wa-bold">Transaksi Jalan, Koin Numpuk:</span> Tiap paket pengiriman yang berstatus Sukses (Final Delivered) otomatis dikonversi jadi SIMKoin tanpa batas maksimal transaksi bulanan.<br>
                            🗓️ <span class="wa-bold">Masa Reset 1 Tahun:</span> Akumulasi SIMKoin Kakak berlaku aktif selama maksimal 1 tahun penuh sebelum memasuki periode reset berkala, jadi waktu kumpulinnya aman banget!<br>
                            ⚡ <span class="wa-bold">Akses Verifikasi Awal (1 Juli):</span> Tautan menu detail jumlah koin dan katalog penukaran hadiah resmi rilis di aplikasi pada 1 Juli 2026. <span class="wa-bold">CATATAN PENTING!</span> Saat menunya rilis nanti, Kakak wajib mengakses dashboard program via web minimal 1x untuk Verifikasi Awal. Setelah verifikasi awal selesai, jumlah koin seterusnya akan terlihat real-time di aplikasi Kakak (kecuali proses penukaran hadiah yang tetap wajib diakses melalui dashboard web).<br><br>
                            💥 <span class="wa-bold">Bocoran Kategori Hadiah:</span> Mulai dari Voucher Belanja, Smartphone, Logam Mulia, Motor, PS5, hingga Paket Umroh!<br><br>
                            Yuk, gasspol terus kiriman paketnya dari sekarang, jangan sampai nyesel pas nanti jadwalnya bisa cek ternyata jumlah koin Kakak kalah banyak sama toko sebelah! 🤑🏁
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_senin_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_senin_g1" class="raw-wa-text">🎁 *ATURAN RESMI PROGRAM SIMASRIM REWARDS SUDAH BERJALAN!* 🚀

Halo Juragan SIMASRIM! 👋 Udah siap kejatuhan hadiah melimpah dari tumpukan resi harian Kakak? Biar jalannya bisnis makin mantap, Mimin mau kasih tahu skema resmi pengumpulan koin reward (*SIMKoin*) Kakak yang sebenarnya sudah dihitung otomatis sejak 1 Juni kemarin:

📦 *Transaksi Jalan, Koin Numpuk:* Tiap paket pengiriman yang berstatus Sukses (Final Delivered) otomatis dikonversi jadi SIMKoin tanpa batas maksimal transaksi bulanan.
🗓️ *Masa Reset 1 Tahun:* Akumulasi SIMKoin Kakak berlaku aktif selama maksimal 1 tahun penuh sebelum memasuki periode reset berkala, jadi waktu kumpulinnya aman banget!
⚡ *Akses Verifikasi Awal (1 Juli):* Tautan menu detail jumlah koin dan katalog penukaran hadiah resmi rilis di aplikasi pada 1 Juli 2026. *CATATAN PENTING!* Saat menunya rilis nanti, Kakak wajib mengakses dashboard program via web minimal 1x untuk Verifikasi Awal. Setelah verifikasi awal selesai, jumlah koin seterusnya akan terlihat real-time di aplikasi Kakak (kecuali proses penukaran hadiah yang tetap wajib diakses melalui dashboard web).

💥 *Bocoran Kategori Hadiah:* Mulai dari Voucher Belanja, Smartphone, Logam Mulia, Motor, PS5, hingga Paket Umroh!

Yuk, gasspol terus kiriman paketnya dari sekarang, jangan sampai nyesel pas nanti jadwalnya bisa cek ternyata jumlah koin Kakak kalah banyak sama toko sebelah! 🤑🏁</pre>
                </div>
                
                <div class="tab-pane fade" id="senin-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎁 <span class="wa-bold">DIAM-DIAM KUMPUL REWARD! Kirim Paket Pertama Kakak & Tabung SIMKoin-nya! 🚀</span><br><br>
                            Halo Kakak Mitra SIMASRIM! 👋 Tau gak sih? Mulai tanggal 1 Juni kemarin, sistem SIMASRIM diam-diam udah mulai menghitung setiap resi sukses Kakak (Final Delivered) menjadi koin hadiah bernama <span class="wa-bold">SIMKoin</span> lewat program <span class="wa-bold">SIMASRIM Rewards!</span><br><br>
                            Nanti pada tanggal 1 Juli 2026, menu katalog penukaran hadiah dan jumlah koin resmi dimunculkan di sistem. Saat rilis nanti, Kakak cukup akses dashboard web-nya sekali untuk proses verifikasi awal, setelahnya jumlah koin otomatis terhitung dan terpampang langsung di aplikasi Kakak sehari-hari.<br><br>
                            Koin ini punya masa aktif panjang maksimal 1 tahun sebelum di-reset berkala, jadi Kakak gak perlu khawatir kehabisan waktu. Hadiahnya super lengkap: Voucher Belanja, Gadget, Emas Batangan, PS5, sampai Paket Umroh!<br><br>
                            Yuk, jangan biarkan akun Kakak kosong melompong. Dorong terus kiriman paket Kakak minggu ini, nanti pas jadwal fiturnya dibuka Kakak bakal kaget sendiri kalau ternyata tabungan koinnya udah banyak banget buat ditukar hadiah! 😱📦
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_senin_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_senin_g2" class="raw-wa-text">🎁 *DIAM-DIAM KUMPUL REWARD! Kirim Paket Pertama Kakak & Tabung SIMKoin-nya!* 🚀

Halo Kakak Mitra SIMASRIM! 👋 Tau gak sih? Mulai tanggal 1 Juni kemarin, sistem SIMASRIM diam-diam udah mulai menghitung setiap resi sukses Kakak (Final Delivered) menjadi koin hadiah bernama *SIMKoin* lewat program *SIMASRIM Rewards!*

Nanti pada tanggal 1 Juli 2026, menu katalog penukaran hadiah dan jumlah koin resmi dimunculkan di sistem. Saat rilis nanti, Kakak cukup akses dashboard web-nya sekali untuk proses verifikasi awal, setelahnya jumlah koin otomatis terhitung dan terpampang langsung di aplikasi Kakak sehari-hari.

Koin ini punya masa aktif panjang maksimal 1 tahun sebelum di-reset berkala, jadi Kakak gak perlu khawatir kehabisan waktu. Hadiahnya super lengkap: Voucher Belanja, Gadget, Emas Batangan, PS5, sampai Paket Umroh!

Yuk, jangan biarkan akun Kakak kosong melompong. Dorong terus kiriman paket Kakak minggu ini, nanti pas jadwal fiturnya dibuka Kakak bakal kaget sendiri kalau ternyata tabungan koinnya udah banyak banget buat ditukar hadiah! 😱📦</pre>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #008639;">
            <div class="step-header">
                <div>
                    <span class="badge bg-success mb-1">Senin, 15 Juni - 14:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">SOP Validasi Alat Ukur / Timbangan Outlet</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                🚨 <span class="wa-bold">PEMBERITAHUAN ATURAN OPERASIONAL OUTLET WAJIB VALID!</span> 🚨<br><br>
                Halo Kakak Pengelola Outlet SIMASRIM! 👋 Guna menjaga kenyamanan transaksi, kelancaran proses serah terima ke kurir pickup, dan mencegah selisih biaya (discrepancy) tagihan ongkir di kemudian hari, manajemen mewajibkan seluruh outlet memiliki <span class="wa-bold">Timbangan Digital & Alat Ukur (Meteran) yang valid</span> di gerai masing-masing.<br><br>
                Aturan ini wajib diterapkan secara berkala, terutama saat memproses kiriman paket komoditas berat/besar lewat <span class="wa-bold">J&T Cargo</span> serta beberapa ekspedisi reguler lain yang menerapkan kebijakan pengecekan ketat terkait verifikasi Massa (Berat Aktual) & Volumetrik Paket.<br><br>
                💡 <span class="wa-bold">Panduan Tim CS Outlet:</span><br>
                1. Selalu ukur panjang x lebar x tinggi paket menggunakan meteran secara fisik dan teliti.<br>
                2. Input data dimensi dan massa yang valid pada sistem sebelum cetak resi agar total biaya pengiriman transparan dan bebas dari penalti selisih berat dari pusat ekspedisi.<br><br>
                Yuk, standarisasi gerak operasional outlet Kakak demi menjaga kualitas performa keagenan kita bersama! 📐⚖️
            </div>
            <pre id="raw_selasa" class="raw-wa-text">🚨 *PEMBERITAHUAN ATURAN OPERASIONAL OUTLET WAJIB VALID!* 🚨

Halo Kakak Pengelola Outlet SIMASRIM! 👋 Guna menjaga kenyamanan transaksi, kelancaran proses serah terima ke kurir pickup, dan mencegah selisih biaya (discrepancy) tagihan ongkir di kemudian hari, manajemen mewajibkan seluruh outlet memiliki *Timbangan Digital & Alat Ukur (Meteran) yang valid* di gerai masing-masing.

Aturan ini wajib diterapkan secara berkala, terutama saat memproses kiriman paket komoditas berat/besar lewat *J&T Cargo* serta beberapa ekspedisi reguler lain yang menerapkan kebijakan pengecekan ketat terkait verifikasi Massa (Berat Aktual) & Volumetrik Paket.

💡 *Panduan Tim CS Outlet:*
1. Selalu ukur panjang x lebar x tinggi paket menggunakan meteran secara fisik dan teliti.
2. Input data dimensi dan massa yang valid pada sistem sebelum cetak resi agar total biaya pengiriman transparan dan bebas dari penalti selisih berat dari pusat ekspedisi.

Yuk, standarisasi gerak operasional outlet Kakak demi menjaga kualitas performa keagenan kita bersama! 📐⚖️</pre>
        </div>

        <div class="step-card" style="border-left-color: #FF0000;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #FF0000; color:#fff;">Rabu, 17 Juni - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Reminder Fitur Alternatif: ID Express Terintegrasi</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_rabu', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                🔵 <span class="wa-bold">Optimalkan Pengiriman Ringan Anda dengan ID Express!</span> 📦<br><br>
                Halo Juragan Olshop! Mimin mau ingetin lagi nih, buat Kakak yang punya banyak kiriman paket kecil, kosmetik, fashion, atau aksesoris dengan berat di bawah 500 gram (0.5 Kg), manfaatkan opsi <span class="wa-bold">ID Express</span> di dashboard SIMASRIM ya!<br><br>
                ID Express punya layanan khusus <span class="wa-bold">LITE (Setengah Kilo)</span> yang bikin ongkir jauh lebih hemat dan kompetitif buat narik minat pembeli Kakak. Kurir resmi tetap merapat jemput paket langsung ke depan pintu toko tanpa minimal kuota paket.<br><br>
                Yuk, buka dashboard-mu hari ini dan ganti alternatif pengiriman paket ringannya ke ID Express biar bisnis makin jalan dan untung terus! 🚀💸
            </div>
            <pre id="raw_rabu" class="raw-wa-text">🔵 *Optimalkan Pengiriman Ringan Anda dengan ID Express!* 📦

Halo Juragan Olshop! Mimin mau ingetin lagi nih, buat Kakak yang punya banyak kiriman paket kecil, kosmetik, fashion, atau aksesoris dengan berat di bawah 500 gram (0.5 Kg), manfaatkan opsi *ID Express* di dashboard SIMASRIM ya!

ID Express punya layanan khusus *LITE (Setengah Kilo)* yang bikin ongkir jauh lebih hemat dan kompetitif buat narik minat pembeli Kakak. Kurir resmi tetap merapat jemput paket langsung ke depan pintu toko tanpa minimal kuota paket.

Yuk, buka dashboard-mu hari ini dan ganti alternatif pengiriman paket ringannya ke ID Express biar bisnis makin jalan dan untung terus! 🚀💸</pre>
        </div>

        <div class="step-card" style="border-left-color: #ED0978;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #ED0978; color:#fff;">Kamis, 18 Juni - 11:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Reminder Fitur Alternatif: Jalur Cepat Anteraja</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                ⚡ <span class="wa-bold">Kirim Paket Tanpa Ribet via Layanan Anteraja!</span> 🔴<br><br>
                Halo Kak! Mau proses kiriman paket dengan rute jemputan yang terjadwal dan kurir yang sigap? Jangan lupa kalau opsi <span class="wa-bold">Anteraja</span> selalu siap sedia di dashboard SIMASRIM Kakak!<br><br>
                Kurir SATRIA Anteraja area lokal siap meluncur ke lokasi toko/rumah Kakak untuk pickup barang harian secara terjadwal. Status pelacakan resinya juga real-time dan terintegrasi akurat di sistem. Sangat andal buat menjaga kepuasan pelanggan toko Kakak.<br><br>
                Yuk, input pesanan Kakak hari ini dan pilih Anteraja sebagai partner pengiriman prioritas harian Kakak! 📦🏁
            </div>
            <pre id="raw_kamis" class="raw-wa-text">⚡ *Kirim Paket Tanpa Ribet via Layanan Anteraja!* 🔴

Halo Kak! Mau proses kiriman paket dengan rute jemputan yang terjadwal dan kurir yang sigap? Jangan lupa kalau opsi *Anteraja* selalu siap sedia di dashboard SIMASRIM Kakak!

Kurir SATRIA Anteraja area lokal siap meluncur ke lokasi toko/rumah Kakak untuk pickup barang harian secara terjadwal. Status pelacakan resinya juga real-time dan terintegrasi akurat di sistem. Sangat andal buat menjaga kepuasan pelanggan toko Kakak.

Yuk, input pesanan Kakak hari ini dan pilih Anteraja sebagai partner pengiriman prioritas harian Kakak! 📦🏁</pre>
        </div>

        <div class="step-card" style="border-left-color: #FF1B1A;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #FF1B1A; color:#fff;">Jumat, 19 Juni - 13:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Edukasi Regulasi Surcharge & Karantina Lion Parcel</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_jumat', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                🦁 <span class="wa-bold">PANDUAN BIREKSTRASIONAL: Pahami Aturan Surcharge & Karantina Lion Parcel</span> 📦<br><br>
                Halo Kak! Biar mutasi saldo tetap aman dan tidak kaget saat menerima tagihan ongkir akhir, yuk pahami struktur biaya tambahan (<span class="wa-bold">Surcharge</span>) resmi dari Lion Parcel untuk kiriman non-standar berikut:<br><br>
                ⚖️ <span class="wa-bold">Rincian Heavy Weight Surcharge (Beban Berat Ekstrem):</span><br>
                Secara resmi, Lion Parcel menetapkan persentase biaya tambahan terbesar berdasarkan berat paket tunggal dalam 1 koli (bukan forward rate area terpencil), dengan skema regulasi aslinya:<br>
                - Berat <span class="wa-bold">71 kg – 100 kg:</span> Surcharge tambahan <span class="wa-bold">50%</span> dari ongkir dasar.<br>
                - Berat <span class="wa-bold">101 kg – 150 kg:</span> Surcharge tambahan <span class="wa-bold">100%</span> dari ongkir dasar.<br>
                - Berat <span class="wa-bold">di atas 150 kg:</span> Dikenakan surcharge maksimal hingga <span class="wa-bold">200%</span> dari ongkir asli paket tunggal!<br><br>
                🔍 <span class="wa-bold">Struktur Total Biaya Akhir (Harga Jual):</span><br>
                Total biaya merupakan akumulasi dari: <span class="wa-bold">Publish Rate</span> (Tarif dasar kota utama) + <span class="wa-bold">Forward Rate</span> (Biaya wilayah terusan kecamatan terpencil dinamis berdasarkan jarak geografis hub transit, bukan persentase) + <span class="wa-bold">Shipping Surcharge</span> (Kondisi khusus komoditas/berat ekstrem).<br><br>
                🌱 <span class="wa-bold">Kebijakan Karantina Tanaman & Komoditas Khusus:</span><br>
                Untuk pengiriman produk tanaman, herbal hidup, atau bahan organik wajib melalui karantina bandara. Aturan lengkap mengenai cara packing safety, tipe barang yang disaring, dokumen surat izin, & rincian biaya wajib diakses langsung melalui link resmi: <a href="https://lionparcel.com/info-seller/karantina-tanaman-ekspedisi" target="_blank" class="fw-bold text-decoration-none">lionparcel.com/info-seller/karantina-tanaman-ekspedisi</a><br><br>
                💡 <span class="wa-bold">Tips Cerdas CS CS Outlet:</span><br>
                Gunakan fitur resmi Cek Tarif di aplikasi, masukkan berat + dimensi dus secara presisi untuk memunculkan kalkulasi kalkulator transparan. Daripada mengirim 1 paket besar ekstrem yang memicu heavy weight surcharge, disarankan memecah kiriman menjadi beberapa dus kecil agar ongkir jauh lebih hemat! 🛠️
            </div>
            <pre id="raw_jumat" class="raw-wa-text">🦁 *PANDUAN BIREKSTRASIONAL: Pahami Aturan Surcharge & Karantina Lion Parcel* 📦

Halo Kak! Biar mutasi saldo tetap aman dan tidak kaget saat menerima tagihan ongkir akhir, yuk pahami struktur biaya tambahan (*Surcharge*) resmi dari Lion Parcel untuk kiriman non-standar berikut:

⚖️ *Rincian Heavy Weight Surcharge (Beban Berat Ekstrem):*
Secara resmi, Lion Parcel menetapkan persentase biaya tambahan terbesar berdasarkan berat paket tunggal dalam 1 koli (bukan forward rate area terpencil), dengan skema regulasi aslinya:
- Berat *71 kg – 100 kg:* Surcharge tambahan *50%* dari ongkir dasar.
- Berat *101 kg – 150 kg:* Surcharge tambahan *100%* dari ongkir dasar.
- Berat *di atas 150 kg:* Dikenakan surcharge maksimal hingga *200%* dari ongkir asli paket tunggal!

🔍 *Struktur Total Biaya Akhir (Harga Jual):*
Total biaya merupakan akumulasi dari: *Publish Rate* (Tarif dasar kota utama) + *Forward Rate* (Biaya wilayah terusan kecamatan terpencil dinamis berdasarkan jarak geografis hub transit, bukan persentase) + *Shipping Surcharge* (Kondisi khusus komoditas/berat ekstrem).

🌱 *Kebijakan Karantina Tanaman & Komoditas Khusus:*
Untuk pengiriman produk tanaman, herbal hidup, atau bahan organik wajib melalui karantina bandara. Aturan lengkap mengenai cara packing safety, tipe barang yang disaring, dokumen surat izin, & rincian biaya wajib diakses langsung melalui link resmi: lionparcel.com/info-seller/karantina-tanaman-ekspedisi

💡 *Tips Cerdas CS CS Outlet:*
Gunakan fitur resmi Cek Tarif di aplikasi, masukkan berat + dimensi dus secara presisi untuk memunculkan kalkulasi kalkulator transparan. Daripada mengirim 1 paket besar ekstrem yang memicu heavy weight surcharge, disarankan memecah kiriman menjadi beberapa dus kecil agar ongkir jauh lebih hemat! 🛠️</pre>
        </div>

        <div class="step-card" style="border-left-color: #FEB31E;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #FEB31E; color:#fff;">Sabtu, 20 Juni - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Reminder Fitur Alternatif: Cold-Chain Paxel Sameday</h5>
                </div>
            </div>
            
            <ul class="nav nav-tabs mb-3" id="tabSabtu" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sabtu-g1" type="button" role="tab">Grup 1 (Aman Akhir Pekan)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g2" type="button" role="tab">Grup 2 (Pengiriman Food)</button>
                </li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="sabtu-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">KIRIMAN AKHIR PEKAN AMAN: Jaga Kepercayaan Pembeli via Paxel Sameday!</span> ❄️<br><br>
                            Halo Kak! Kiriman di hari Sabtu rawan tertahan di gudang transit karena libur operasional kurir biasa? Jangan ambil risiko pelanggan komplain paketnya telat sampai!<br><br>
                            Gunakan jalur alternatif <span class="wa-bold">Paxel Sameday</span> di aplikasi SIMASRIM Kakak. Layanan hari yang sama sampai ini sangat tangguh untuk rute antar kota besar, pengiriman dijemput cepat, aman, dan bergaransi. Yuk gass input resinya siang ini sebelum batas pickup berakhir! 🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g1" class="raw-wa-text">📦 *KIRIMAN AKHIR PEKAN AMAN: Jaga Kepercayaan Pembeli via Paxel Sameday!* ❄️

Halo Kak! Kiriman di hari Sabtu rawan tertahan di gudang transit karena libur operasional kurir biasa? Jangan ambil risiko pelanggan komplain paketnya telat sampai!

Gunakan jalur alternatif *Paxel Sameday* di aplikasi SIMASRIM Kakak. Layanan hari yang sama sampai ini sangat tangguh untuk rute antar kota besar, pengiriman dijemput cepat, aman, dan bergaransi. Yuk gass input resinya siang ini sebelum batas pickup berakhir! 🚀</pre>
                </div>
                
                <div class="tab-pane fade" id="sabtu-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">KIRIM MAKANAN/FROZEN FOOD? Paxel Sameday Solusi Andalannya!</span> ❄️<br><br>
                            Halo Kak! Punya pesanan jualan akhir pekan berupa produk makanan basah, kue, atau frozen food yang sensitif suhu dan wajib sampai hari ini juga? Jangan biarkan paket Kakak rusak di jalan!<br><br>
                            Yuk, manfaatkan layanan kurir khusus <span class="wa-bold">Paxel Sameday</span> lewat sistem SIMASRIM Kakak. Didukung infrastruktur pembeku (cold-chain) yang aman, paket makanan dijemput langsung ke rumah dan dikirim di hari yang sama. Yuk cetak resi Paxel pertama Kakak hari ini! 🏃‍♂️💨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_sabtu_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_sabtu_g2" class="raw-wa-text">📦 *KIRIM MAKANAN/FROZEN FOOD? Paxel Sameday Solusi Andalannya!* ❄️

Halo Kak! Punya pesanan jualan akhir pekan berupa produk makanan basah, kue, atau frozen food yang sensitif suhu dan wajib sampai hari ini juga? Jangan biarkan paket Kakak rusak di jalan!

Yuk, manfaatkan layanan kurir khusus *Paxel Sameday* lewat sistem SIMASRIM Kakak. Didukung infrastruktur pembeku (cold-chain) yang aman, paket makanan dijemput langsung ke rumah dan dikirim di hari yang sama. Yuk cetak resi Paxel pertama Kakak hari ini! 🏃‍♂️💨</pre>
                </div>
            </div>
        </div>

        <div class="accordion mb-4" id="accordionCadangan">
            <div class="accordion-item border border-danger border-opacity-25" style="border-radius: 16px; overflow: hidden;">
                <h2 class="accordion-header">
                    <button class="accordion-button bg-danger bg-opacity-10 text-danger fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseJne" style="font-size: 1.05rem;">
                        <i class="fas fa-exclamation-triangle me-2"></i> ZONA DATA CADANGAN: PENGUMUMAN JNE AKTIF KEMBALI (Non-COD Pickup Only)
                    </button>
                </h2>
                <div id="collapseJne" class="accordion-collapse collapse" data-bs-parent="#accordionCadangan">
                    <div class="accordion-body bg-white p-4">
                        <div class="alert alert-warning py-2 px-3 small mb-3"><i class="fas fa-info-circle me-1"></i> <strong>SOP BLAST JNE:</strong> Jangan di-share dulu. Gunakan draf internal bersih ini HANYA jika integrasi partner sudah kelar dan tombol JNE di dashboard dinyalakan oleh Pusat.</div>
                        
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="chat-bubble w-100 me-3">
                                📢 <span class="wa-bold">[KABAR GEMBIRA] LAYANAN JNE NON-COD PICKUP RESMI AKTIF KEMBALI!</span> 🚚<br><br>
                                Halo Kakak Agen SIMASRIM! 👋 Kabar bahagia yang paling ditunggu-tunggu akhirnya tiba! Mulai HARI INI, layanan pengiriman menggunakan ekspedisi ikonik <span class="wa-bold">JNE resmi diaktifkan kembali</span> di aplikasi SIMASRIM Kakak!<br><br>
                                Sesuai regulasi penyesuaian terbaru, rute layanan JNE yang kembali dibuka ini berlaku khusus untuk jalur <span class="wa-bold">Non-COD Layanan Pickup Only (Opsi Layanan REG dan YES)</span>.<br><br>
                                Sekarang Kakak sudah bisa menawarkan kembali opsi pengiriman JNE ke pelanggan setia gerai Kakak. Paket seperti biasa akan langsung dijemput oleh kurir resmi JNE ke depan gerai tanpa minimal kiriman. Yuk gasspol input orderan JNE Kakak hari ini, mari kita genjot tonase bersama! 🎉📦
                            </div>
                            <button class="btn-copy text-nowrap" onclick="copyWaText('raw_jne_cadangan', this)"><i class="far fa-copy"></i> Salin Draf JNE</button>
                        </div>
                        <pre id="raw_jne_cadangan" class="raw-wa-text">📢 *[KABAR GEMBIRA] LAYANAN JNE NON-COD PICKUP RESMI AKTIF KEMBALI!* 🚚

Halo Kakak Agen SIMASRIM! 👋 Kabar bahagia yang paling ditunggu-tunggu akhirnya tiba! Mulai HARI INI, layanan pengiriman menggunakan ekspedisi ikonik *JNE resmi diaktifkan kembali* di aplikasi SIMASRIM Kakak!

Sesuai regulasi penyesuaian terbaru, rute layanan JNE yang kembali dibuka ini berlaku khusus untuk jalur *Non-COD Layanan Pickup Only (Opsi Layanan REG dan YES)*.

Sekarang Kakak sudah bisa menawarkan kembali opsi pengiriman JNE ke pelanggan setia gerai Kakak. Paket seperti biasa akan langsung dijemput oleh kurir resmi JNE ke depan gerai tanpa minimal kiriman. Yuk gasspol input orderan JNE Kakak hari ini, mari kita genjot tonase bersama! 🎉📦</pre>
                    </div>
                </div>
            </div>
        </div>

        <p class="text-center small text-muted mt-5"><i>Dokumen ini bersifat internal dan rahasia. Digunakan oleh tim Marketing, Operasional, dan Magang PT Solusi Mitra Aplikasi.<br>Versi 1.0 · 12 Juni 2026</i></p>

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