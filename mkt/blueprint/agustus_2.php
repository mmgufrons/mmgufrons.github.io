<?php
$page_title = "Blueprint Agustus #2 | SIMASRIM Operations";
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
    .attachment-box { background: rgba(35, 131, 226, 0.05); border: 1px dashed #3b82f6; border-radius: 8px; padding: 10px; margin-top: 10px; font-size: 0.8rem; color: #3b82f6; display: flex; align-items: center; gap: 10px; }
</style>

<section class="hero-section text-center" style="background: linear-gradient(135deg, #1f0d3d, #0f0c29); padding-top: 120px; padding-bottom: 60px;">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--primary);"></div>
    <div class="container position-relative z-1">
        <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm border border-warning">Active Blueprint</span>
        <h2 class="display-5 fw-bold mb-2 text-white">Campaign Agustus - Pekan #2</h2>
        <p class="text-white-50 mb-0">Periode: 10 - 15 Agustus 2026. Fokus: Fitur Resi Banyak, Edukasi Dokumen Panduan, Spill Hadiah Koin, & Multikurir (Grup 3).</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <!-- SENIN: RESI BANYAK -->
        <div class="step-card" style="border-left-color: #0d6efd;">
            <div class="step-header">
                <div>
                    <span class="badge bg-primary mb-1">Senin, 10 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Edukasi Fitur Input Resi Banyak</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_senin', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>

            <div class="chat-bubble">
                📦 <span class="wa-bold">ORDERAN NUMPUK? GAK PERLU KETIK SATU-SATU KAK!</span> 📦<br><br>
                Halo Kak! Awal minggu paketan lagi banyak-banyaknya? Jangan buang waktu buat ketik resi manual satu per satu!<br><br>
                Gunakan fitur <span class="wa-bold">Resi Banyak</span> (Sidebar > Resi Banyak) di SIMASRIM. Tinggal masukkan data secara massal, semua resi langsung terbuat otomatis dalam hitungan detik. Singkat, padat, dan anti typo!<br><br>
                Yuk, maksimalkan kecepatan layanan loket Kakak hari ini biar pelanggan makin puas! 🚀
            </div>
            <pre id="raw_senin" class="raw-wa-text">📦 *ORDERAN NUMPUK? GAK PERLU KETIK SATU-SATU KAK!* 📦

Halo Kak! Awal minggu paketan lagi banyak-banyaknya? Jangan buang waktu buat ketik resi manual satu per satu!

Gunakan fitur *Resi Banyak* (Sidebar > Resi Banyak) di SIMASRIM. Tinggal masukkan data secara massal, semua resi langsung terbuat otomatis dalam hitungan detik. Singkat, padat, dan anti typo!

Yuk, maksimalkan kecepatan layanan loket Kakak hari ini biar pelanggan makin puas! 🚀</pre>
        </div>

        <!-- SELASA: DOKUMEN PANDUAN -->
        <div class="step-card" style="border-left-color: #198754;">
            <div class="step-header">
                <div>
                    <span class="badge bg-success mb-1">Selasa, 11 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Edukasi Menu Dokumen Panduan Aplikasi</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>

            <div class="chat-bubble">
                📚 <span class="wa-bold">BINGUNG CARA PAKAI APLIKASI? CEK PANDUAN LENGKAPNYA DI SINI!</span> 📚<br><br>
                Halo Kak! Mau tahu rahasia cara menggunakan fitur-fitur canggih SIMASRIM?<br><br>
                Semua panduannya udah Mimin siapin lengkap lho, bahkan ada panduan videonya juga biar Kakak makin gampang paham! Langsung aja buka menu:<br>
                👉 <span class="wa-bold">Sidebar Menu > Dokumen Panduan > Dokumen Aplikasi</span><br><br>
                Mulai dari cara cetak resi sampai tips kelola loket ada semua di situ. Yuk pelajari fiturnya dan maksimalkan cuan Kakak! 💡
            </div>
            <pre id="raw_selasa" class="raw-wa-text">📚 *BINGUNG CARA PAKAI APLIKASI? CEK PANDUAN LENGKAPNYA DI SINI!* 📚

Halo Kak! Mau tahu rahasia cara menggunakan fitur-fitur canggih SIMASRIM?

Semua panduannya udah Mimin siapin lengkap lho, bahkan ada panduan videonya juga biar Kakak makin gampang paham! Langsung aja buka menu:
👉 *Sidebar Menu > Dokumen Panduan > Dokumen Aplikasi*

Mulai dari cara cetak resi sampai tips kelola loket ada semua di situ. Yuk pelajari fiturnya dan maksimalkan cuan Kakak! 💡</pre>
        </div>

        <!-- RABU: REWARD SPILL HADIAH -->
        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6f42c1; color: #fff;">Rabu, 12 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Spill Hadiah: Katalog SIMASRIM Rewards</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_rabu', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>

            <div class="chat-bubble">
                🎁 <span class="wa-bold">SAYANG BANGET! KOIN UDAH BANYAK TAPI BELUM DIKLAIM?</span> 🎁<br><br>
                Halo Kak! Coba cek saldo SIMKoin Kakak sekarang. Banyak banget agen yang diam-diam udah bisa klaim hadiah tapi belum ditukar nih!<br><br>
                Mau langsung ditukar voucher belanja, gadget keren, motor impian, atau sengaja mau ditabung buat ngejar <span class="wa-bold">Paket Umroh 9 Hari</span>? Bebas! Semua bisa Kakak atur.<br><br>
                Ayo semangat terus cetak resinya, dan jangan lupa buka menu <span class="wa-bold">"Lihat Rewards" di Dashboard > "Tukar Hadiah"</span> buat intip barang incaran Kakak! 🤑✨
            </div>
            <pre id="raw_rabu" class="raw-wa-text">🎁 *SAYANG BANGET! KOIN UDAH BANYAK TAPI BELUM DIKLAIM?* 🎁

Halo Kak! Coba cek saldo SIMKoin Kakak sekarang. Banyak banget agen yang diam-diam udah bisa klaim hadiah tapi belum ditukar nih!

Mau langsung ditukar voucher belanja, gadget keren, motor impian, atau sengaja mau ditabung buat ngejar *Paket Umroh 9 Hari*? Bebas! Semua bisa Kakak atur.

Ayo semangat terus cetak resinya, dan jangan lupa buka menu *"Lihat Rewards" di Dashboard > "Tukar Hadiah"* buat intip barang incaran Kakak! 🤑✨</pre>
        </div>

        <!-- KAMIS: JNE HANDOVER -->
        <div class="step-card" style="border-left-color: #E8232A;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #E8232A; color: #fff;">Kamis, 13 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Reminder Wajib Handover JNE</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis', this)"><i class="far fa-copy"></i> Salin Pesan (UMUM)</button>
            </div>
            <div class="chat-bubble">
                📋 <span class="wa-bold">PENGINGAT PENTING: JANGAN LUPA HANDOVER JNE YA KAK!</span> 📋<br><br>
                Halo Kakak Agen & Seller! Sekadar mengingatkan kembali, khusus untuk pengiriman <span class="wa-bold">JNE</span>, proses serah terima paket ke kurirnya WAJIB melalui sistem Handover ya.<br><br>
                Caranya gak ada yang berubah kok, tetap sama: Buka <span class="wa-bold">Sidebar Menu > Handover > JNE > Tambah Handover</span>. (Atau bisa klik link ini: https://app.simasrim.com/agen/handover_all).<br><br>
                Biar paket aman, terdata rapi di sistem pusat, dan gak menggantung, pastikan kurir menerima bukti Handover-nya! Terima kasih atas kerjasamanya Kak! 🚚🤝
            </div>
            <pre id="raw_kamis" class="raw-wa-text">📋 *PENGINGAT PENTING: JANGAN LUPA HANDOVER JNE YA KAK!* 📋

Halo Kakak Agen & Seller! Sekadar mengingatkan kembali, khusus untuk pengiriman *JNE*, proses serah terima paket ke kurirnya WAJIB melalui sistem Handover ya.

Caranya gak ada yang berubah kok, tetap sama: Buka *Sidebar Menu > Handover > JNE > Tambah Handover*. (Atau bisa klik link ini: https://app.simasrim.com/agen/handover_all).

Biar paket aman, terdata rapi di sistem pusat, dan gak menggantung, pastikan kurir menerima bukti Handover-nya! Terima kasih atas kerjasamanya Kak! 🚚🤝</pre>
        </div>

        <!-- JUMAT: WEEKEND PUSH (MULTIKURIR GRUP 3) -->
        <div class="step-card" style="border-left-color: #20c997;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #20c997; color: #fff;">Jumat, 14 Agustus - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Push & Edukasi Multikurir (G3)</h5>
                </div>
            </div>

            <ul class="nav nav-tabs mb-3" id="tabJumat" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#jumat-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#jumat-g2" type="button" role="tab">Grup 2 (Baru)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#jumat-g3" type="button" role="tab">Grup 3 (TJS / Seller)</button></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="jumat-g1" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🎯 <span class="wa-bold">Jumat Berkah! Pantau Downline dan Amankan Tonase Kak!</span><br><br>
                            Halo Juragan! Biar Jumatnya makin berkah, jangan lupa kawal agen-agen di bawah jaringan TJS Kakak buat sapu bersih paketan hari ini! <br><br>
                            Arahkan mereka untuk pakai fitur Resi Banyak kalau paketnya lagi banyak. Makin cepat pelayanan mereka, makin tebal komisi Kakak. Gas terus cetak resinya! 🎁🚀
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g1', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g1" class="raw-wa-text">🎯 *Jumat Berkah! Pantau Downline dan Amankan Tonase Kak!*

Halo Juragan! Biar Jumatnya makin berkah, jangan lupa kawal agen-agen di bawah jaringan TJS Kakak buat sapu bersih paketan hari ini!

Arahkan mereka untuk pakai fitur Resi Banyak kalau paketnya lagi banyak. Makin cepat pelayanan mereka, makin tebal komisi Kakak. Gas terus cetak resinya! 🎁🚀</pre>
                </div>

                <div class="tab-pane fade" id="jumat-g2" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            📦 <span class="wa-bold">Jumat Produktif! Yuk Sikat Semua Orderan COD Kakak!</span><br><br>
                            Halo Kak, jangan libur dulu! Biasanya orderan COD numpuk nih menjelang akhir pekan. Langsung aja input resi COD-nya pakai aplikasi SIMASRIM!<br><br>
                            Sistem COD kita aman, dana cair lancar setelah paket Delivered. Plus tiap resi sukses = nambah Koin Hadiah Kakak. Yuk pecah telor cetak resinya sekarang! 💸
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g2', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g2" class="raw-wa-text">📦 *Jumat Produktif! Yuk Sikat Semua Orderan COD Kakak!*

Halo Kak, jangan libur dulu! Biasanya orderan COD numpuk nih menjelang akhir pekan. Langsung aja input resi COD-nya pakai aplikasi SIMASRIM!

Sistem COD kita aman, dana cair lancar setelah paket Delivered. Plus tiap resi sukses = nambah Koin Hadiah Kakak. Yuk pecah telor cetak resinya sekarang! 💸</pre>
                </div>

                <div class="tab-pane fade" id="jumat-g3" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="chat-bubble w-100 me-3">
                            🚚 <span class="wa-bold">RAHASIA BISNIS: JANGAN CUMA BERGANTUNG 1 KURIR KAK!</span> 🚚<br><br>
                            Halo Kakak Seller! Sering kirim pakai JNE aja kan? Tapi tau gak, di SIMASRIM Kakak juga punya "Senjata Rahasia" buat narik banyak pelanggan lho!<br><br>
                            Ada <span class="wa-bold">SAPX & Lion Parcel</span> buat kargo andalan, <span class="wa-bold">Anteraja</span> buat pickup super cepat, sampai <span class="wa-bold">ID Express Lite</span> buat barang ringan di bawah 500gr.<br><br>
                            Jangan takut ribet, karena cara pakainya <span class="wa-bold">SAMA GAMPANGNYA</span> kayak cetak resi JNE. Yuk cobain variasi kurir lainnya hari ini biar pelanggan Kakak makin senang banyak pilihan! 📦✨
                        </div>
                        <button class="btn-copy" onclick="copyWaText('raw_jumat_g3', this)"><i class="far fa-copy"></i> Salin</button>
                    </div>
                    <pre id="raw_jumat_g3" class="raw-wa-text">🚚 *RAHASIA BISNIS: JANGAN CUMA BERGANTUNG 1 KURIR KAK!* 🚚

Halo Kakak Seller! Sering kirim pakai JNE aja kan? Tapi tau gak, di SIMASRIM Kakak juga punya "Senjata Rahasia" buat narik banyak pelanggan lho!

Ada *SAPX & Lion Parcel* buat kargo andalan, *Anteraja* buat pickup super cepat, sampai *ID Express Lite* buat barang ringan di bawah 500gr.

Jangan takut ribet, karena cara pakainya *SAMA GAMPANGNYA* kayak cetak resi JNE. Yuk cobain variasi kurir lainnya hari ini biar pelanggan Kakak makin senang banyak pilihan! 📦✨</pre>
                </div>
            </div>
        </div>

        <!-- SABTU: WEEKEND GAMIFICATION -->
        <div class="step-card" style="border-left-color: #f8c146;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #f8c146; color:#000;">Sabtu, 15 Agustus - 09:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Weekend Closing (Rewards & Recall)</h5>
                </div>
            </div>

            <ul class="nav nav-tabs mb-3" id="tabSabtu" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sabtu-g1" type="button" role="tab">Grup 1 (VIP)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g2" type="button" role="tab">Grup 2 (Baru)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sabtu-g3" type="button" role="tab">Grup 3 (TJS / Seller)</button></li>
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
