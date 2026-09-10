<?php 
$page_title = "Active Blueprint Mei 2026 #2 | SIMASRIM CS";
$footer_desc = "Dokumen Internal Terbatas - Divisi Customer Service & Marketing.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>

<style>
    .step-card {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.08);
        border-left: 5px solid var(--primary);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .step-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    }
    .step-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }
    .chat-bubble {
        background: #f8f9fa;
        border-radius: 0 12px 12px 12px;
        padding: 1.2rem;
        border: 1px solid #e9ecef;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        line-height: 1.6;
        font-size: 0.95rem;
    }
    .wa-bold { font-weight: 700; color: #000; }
    .wa-italic { font-style: italic; }
    .raw-wa-text { display: none !important; }
    .btn-copy {
        background: white;
        border: 1px solid #ced4da;
        color: #495057;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-copy:hover {
        background: #e9ecef;
        color: #212529;
    }
    .btn-copy.copied {
        background: var(--wa-green, #25D366);
        border-color: var(--wa-green, #25D366);
        color: white;
    }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25"><i class="fa-solid fa-calendar-week me-2"></i>Active Blueprint</span>
        <h2 class="display-5 fw-bold mb-2">Pekan "Ekspansi Layanan & Hype Loyalitas"</h2>
        <p class="text-white-50 mb-0">Periode: 11 - 16 Mei 2026<br>Fokus Utama: Teaser Ultimate PPOB, Spill Kurir Baru & Kargo COD, serta Soft Hype Program Rewards.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">
        
        <div class="text-center mb-5">
            <h3 class="fw-bold text-dark"><i class="fas fa-bullhorn me-2 text-primary"></i>Channel Pengumuman (Umum)</h3>
            <p class="text-muted">Broadcast ke seluruh channel info utama (Senin - Rabu).<br><strong class="text-danger">Catatan:</strong> Kamis, 14 Mei libur (Kenaikan Yesus Kristus), jadwal blast ditiadakan.</p>
        </div>

        <div class="step-card">
            <div class="step-header">
                <div>
                    <span class="badge bg-danger mb-1">Senin, 11 Mei - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Spill PPOB Makin Lengkap</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_senin', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                🔥 <strong>PPOB SIMASRIM MAKIN LENGKAP & MANTAP MINGGU INI!</strong> 🔥<br><br>
                Pagi Agen! Setelah kemarin pembayaran angsuran bertahap meluncur, persiapan yuk karena mulai minggu ini layanan PPOB kita bakal makin <strong>Ultimate</strong> lho!<br><br>
                Pelan-pelan kita bakal tambahin fitur biar Kakak makin bisa melayani:<br>
                ✅ Bayar PDAM (Nasional) makin lengkap<br>
                ✅ Token & Tagihan PLN yang lebih rapi<br>
                ✅ Pulsa & Paket Data terlengkap<br>
                ✅ Voucher Game kesayangan pelanggan<br><br>
                Makin banyak variasi layanan, makin betah pelanggan datang ke loket Kakak. Pastikan saldo SIMASRIM Kakak selalu aman biar nggak ketinggalan momen rilisnya! 🚀
            </div>
            <pre id="raw_senin" class="raw-wa-text">🔥 *PPOB SIMASRIM MAKIN LENGKAP & MANTAP MINGGU INI!* 🔥

Pagi Agen! Setelah kemarin pembayaran angsuran bertahap meluncur, persiapan yuk karena mulai minggu ini layanan PPOB kita bakal makin *Ultimate* lho!

Pelan-pelan kita bakal tambahin fitur biar Kakak makin bisa melayani:
✅ Bayar PDAM (Nasional) makin lengkap
✅ Token & Tagihan PLN yang lebih rapi
✅ Pulsa & Paket Data terlengkap
✅ Voucher Game kesayangan pelanggan

Makin banyak variasi layanan, makin betah pelanggan datang ke loket Kakak. Pastikan saldo SIMASRIM Kakak selalu aman biar nggak ketinggalan momen rilisnya! 🚀</pre>
        </div>

        <div class="step-card" style="border-left-color: #fd7e14;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #fd7e14;">Selasa, 12 Mei - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Diversifikasi Kurir & Multi-Teaser</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                🚚 <strong>JANGAN CUMA JNE, PAKAI KURIR LAIN BIAR MAKIN CUAN!</strong> 🚚<br><br>
                Siang Kak! Udah coba kirim pakai ekspedisi andalan kita lainnya belum? Ada <strong>SAPX, J&T Express, SPX, J&T Cargo, Lion Parcel, hingga Paxel</strong> yang siap melayani paket pelanggan Kakak.<br><br>
                🤫 <strong>Bocoran Rahasia buat Kakak:</strong><br>
                1. Sebentar lagi bakal rilis <strong>Satu Ekspedisi Reguler baru</strong> yang super kompetitif jangkauannya!<br>
                2. Fitur <strong>COD untuk pengiriman barang besar (Kargo)</strong> juga lagi disiapin sistemnya lho.<br>
                3. Satu lagi <strong>Partner Logistik Nasional</strong> juga lagi tahap proses integrasi!<br><br>
                Pantau terus aplikasinya ya, jangan sampai ketinggalan fitur-fitur "Pecah Telur" ini! ✨
            </div>
            <pre id="raw_selasa" class="raw-wa-text">🚚 *JANGAN CUMA JNE, PAKAI KURIR LAIN BIAR MAKIN CUAN!* 🚚

Siang Kak! Udah coba kirim pakai ekspedisi andalan kita lainnya belum? Ada *SAPX, J&T Express, SPX, J&T Cargo, Lion Parcel, hingga Paxel* yang siap melayani paket pelanggan Kakak.

🤫 *Bocoran Rahasia buat Kakak:*
1. Sebentar lagi bakal rilis *Satu Ekspedisi Reguler baru* yang super kompetitif jangkauannya!
2. Fitur *COD untuk pengiriman barang besar (Kargo)* juga lagi disiapin sistemnya lho.
3. Satu lagi *Partner Logistik Nasional* juga lagi tahap proses integrasi!

Pantau terus aplikasinya ya, jangan sampai ketinggalan fitur-fitur "Pecah Telur" ini! ✨</pre>
        </div>

        <div class="step-card" style="border-left-color: #6f42c1;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6f42c1;">Rabu, 13 Mei - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Soft Spill Program Loyalitas</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_rabu', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                🎁 <strong>TRANSAKSI MAKIN BANYAK, BISA DITUKAR HADIAH?</strong> 🎁<br><br>
                Halo Agen! Siapkan loket Kakak buat kejutan luar biasa tak lama lagi ya!<br><br>
                SIMASRIM lagi meracik program loyalitas super spesial. Ke depannya, transaksi yang Kakak lakukan bakal dikonversi jadi semacam "Angka Loyalitas". Kumpulin terus, dan nanti bisa ditukar sama hadiah-hadiah mantap!<br><br>
                Mulai dari perlengkapan operasional loket, Gadget impian, Logam Mulia, sampai hadiah Liburan/Spiritual juga lagi kita siapin lho. Makin sering kirim paket berhasil dari sekarang, Kakak bakal makin terbiasa ngejar targetnya nanti. Gasspoll terus transaksinya! 💸✨
            </div>
            <pre id="raw_rabu" class="raw-wa-text">🎁 *TRANSAKSI MAKIN BANYAK, BISA DITUKAR HADIAH?* 🎁

Halo Agen! Siapkan loket Kakak buat kejutan luar biasa tak lama lagi ya!

SIMASRIM lagi meracik program loyalitas super spesial. Ke depannya, transaksi yang Kakak lakukan bakal dikonversi jadi semacam "Angka Loyalitas". Kumpulin terus, dan nanti bisa ditukar sama hadiah-hadiah mantap!

Mulai dari perlengkapan operasional loket, Gadget impian, Logam Mulia, sampai hadiah Liburan/Spiritual juga lagi kita siapin lho. Makin sering kirim paket berhasil dari sekarang, Kakak bakal makin terbiasa ngejar targetnya nanti. Gasspoll terus transaksinya! 💸✨</pre>
        </div>

        <div class="text-center mt-5 mb-4">
            <h3 class="fw-bold text-dark"><i class="fas fa-users me-2 text-success"></i>Broadcast Grup Spesifik</h3>
            <p class="text-muted">Kirimkan instruksi ke grup koordinator pada hari Jumat & Sabtu.</p>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #198754; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-success mb-1">Jumat, 15 Mei - 10:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 1 (VIP)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_jumat_1', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Halo Juragan! ☕ Setelah libur kemarin, yuk gas lagi! Info penting: Fitur-fitur PPOB komplit minggu ini bakal siap <i>live</i>. Pastikan jaringan agen di bawah Bapak/Ibu sudah siap saldo. Oh ya, ingatkan juga agennya buat naikin volume kiriman, soalnya tak lama lagi kita rilis program loyalitas berhadiah keren! Biar jaringan makin semangat! 💪
                    </div>
                    <pre id="raw_jumat_1" class="raw-wa-text">Halo Juragan! ☕ Setelah libur kemarin, yuk gas lagi! Info penting: Fitur-fitur PPOB komplit minggu ini bakal siap _live_. Pastikan jaringan agen di bawah Bapak/Ibu sudah siap saldo. Oh ya, ingatkan juga agennya buat naikin volume kiriman, soalnya tak lama lagi kita rilis program loyalitas berhadiah keren! Biar jaringan makin semangat! 💪</pre>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #0dcaf0; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-info text-dark mb-1">Jumat, 15 Mei - 14:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 2 (Standar)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_jumat_2', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Siang Kak! 👋 Semangat terus ya jaga loketnya! Udah infoin tetangga belum kalau minggu ini layanan bayar-bayar di loket Kakak bakal makin komplit? Mulai dari PDAM sampai Voucher Game bakal ada. Siapin saldonya dari sekarang ya Kak biar nanti pas rilis bisa langsung sikat orderan! 🚀
                    </div>
                    <pre id="raw_jumat_2" class="raw-wa-text">Siang Kak! 👋 Semangat terus ya jaga loketnya! Udah infoin tetangga belum kalau minggu ini layanan bayar-bayar di loket Kakak bakal makin komplit? Mulai dari PDAM sampai Voucher Game bakal ada. Siapin saldonya dari sekarang ya Kak biar nanti pas rilis bisa langsung sikat orderan! 🚀</pre>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #198754; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-success mb-1">Sabtu, 16 Mei - 10:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 1 (VIP)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_sabtu_1', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Selamat pagi Juragan! Happy Weekend! 🎉<br><br>
                        Sambil santai, yuk evaluasi sedikit transaksi ekspedisi jaringan minggu ini. Edukasi jaringan Bapak/Ibu buat pakai ekspedisi variatif ya (SAPX, J&T, SPX, dll). Soalnya bentar lagi rilis Kargo bisa COD dan Kurir baru. Makin paham sistem, makin gampang narik omzet! Sukses terus Gan!
                    </div>
                    <pre id="raw_sabtu_1" class="raw-wa-text">Selamat pagi Juragan! Happy Weekend! 🎉

Sambil santai, yuk evaluasi sedikit transaksi ekspedisi jaringan minggu ini. Edukasi jaringan Bapak/Ibu buat pakai ekspedisi variatif ya (SAPX, J&T, SPX, dll). Soalnya bentar lagi rilis Kargo bisa COD dan Kurir baru. Makin paham sistem, makin gampang narik omzet! Sukses terus Gan!</pre>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #0dcaf0; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-info text-dark mb-1">Sabtu, 16 Mei - 14:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 2 (Standar)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_sabtu_2', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Happy Weekend Kak! 👋 Cuaca santai gini enaknya ngapain nih?<br><br>
                        Biar makin semangat, Mimin mau ngingetin kalau bentar lagi bakal ada program spesial berhadiah buat agen yang rajin transaksi lho! Jadi yuk kumpulkan orderan sebanyak-banyaknya dari sekarang biar terbiasa! Gaspol cuan akhir pekannya Kak! 📦✨
                    </div>
                    <pre id="raw_sabtu_2" class="raw-wa-text">Happy Weekend Kak! 👋 Cuaca santai gini enaknya ngapain nih?

Biar makin semangat, Mimin mau ngingetin kalau bentar lagi bakal ada program spesial berhadiah buat agen yang rajin transaksi lho! Jadi yuk kumpulkan orderan sebanyak-banyaknya dari sekarang biar terbiasa! Gaspol cuan akhir pekannya Kak! 📦✨</pre>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>