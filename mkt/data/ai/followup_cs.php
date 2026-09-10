<?php 
$page_title = "SOP Follow Up CS | SIMASRIM";
$footer_desc = "Dokumen Internal Terbatas - Divisi Customer Service & Retensi.";
$base_path = '../../'; include '../../includes/header.php'; 
?>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25"><i class="fa-regular fa-message me-2"></i>Internal Customer Service</span>
        <h2 class="display-5 fw-bold mb-2">SOP Follow-Up User Baru dibawah Mitra</h2>
        <p class="text-white-50 mb-0">Semua <b>copywriting</b> di bawah ini sudah disetting format WA otomatis (Tinggal klik Salin & Paste!).</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">
        
        <div class="step-card">
            <div class="step-header">
                <div>
                    <span class="badge bg-danger mb-1">H+0 (Segera setelah Sales input)</span>
                    <h5 class="fw-bold mb-0 text-dark">Step 1 & 2: Greeting & Kirim Panduan</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw1', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            
            <div class="chat-bubble">
                <span class="wa-bold">Halo Kak [Nama User], selamat siang!</span> 👋<br><br>
                Saya <span class="wa-bold">[Nama CS]</span> dari tim <span class="wa-bold">SIMASRIM</span>. Senang sekali Kakak sudah bergabung melalui rekan kami Kak <span class="wa-bold">[Nama Sales]</span>.<br><br>
                Akun SIMASRIM Kakak sudah <span class="wa-bold">aktif</span> dan siap digunakan untuk cuan hari ini! 🚀<br>
                Sebagai langkah awal, berikut saya lampirkan <span class="wa-bold">Panduan Lengkap</span> cara pakai aplikasi untuk kirim paket dan jualan produk digital:<br><br>
                🔗 <span class="wa-italic">https://docs.simasrim.com/53b8f03d-66ee-46a8-94fc-ac7338e03948/</span><br><br>
                Jika ada kendala saat login atau bingung cara pakainya, langsung tanya saya di sini ya Kak. Saya siap bantu!
            </div>
            <pre id="raw1" class="raw-wa-text">*Halo Kak [Nama User], selamat siang!* 👋

Saya *[Nama CS]* dari tim *SIMASRIM*. Senang sekali Kakak sudah bergabung melalui rekan kami Kak *[Nama Sales]*.

Akun SIMASRIM Kakak sudah *aktif* dan siap digunakan untuk cuan hari ini! 🚀
Sebagai langkah awal, berikut saya lampirkan *Panduan Lengkap* cara pakai aplikasi untuk kirim paket dan jualan produk digital:

🔗 _https://docs.simasrim.com/53b8f03d-66ee-46a8-94fc-ac7338e03948/_

Jika ada kendala saat login atau bingung cara pakainya, langsung tanya saya di sini ya Kak. Saya siap bantu!</pre>
        </div>

        <div class="step-card" style="border-left-color: var(--accent);">
            <div class="step-header">
                <div>
                    <span class="badge bg-warning text-dark mb-1">H+1 (Jika belum isi saldo)</span>
                    <h5 class="fw-bold mb-0 text-dark">Step 3: Arahkan Top Up (Deposit)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw2', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            
            <div class="chat-bubble">
                <span class="wa-bold">Halo Kak [Nama User], sudah coba buka aplikasinya?</span> 👀<br><br>
                Biar langsung bisa gas transaksi kirim paket atau jualan pulsa, yuk isi saldo pertamanya.<br>
                Bisa via transfer bank, VA, atau QRIS, <span class="wa-bold">dimulai dari 10rb aja</span> kok Kak. 💸<br><br>
                Saldo Kakak aman 100% dan bisa langsung dipakai transaksi detik itu juga. Mau saya pandu cara top-up nya Kak?
            </div>
            <pre id="raw2" class="raw-wa-text">*Halo Kak [Nama User], sudah coba buka aplikasinya?* 👀

Biar langsung bisa gas transaksi kirim paket atau jualan pulsa, yuk isi saldo pertamanya.
Bisa via transfer bank, VA, atau QRIS, *dimulai dari 10rb aja* kok Kak. 💸

Saldo Kakak aman 100% dan bisa langsung dipakai transaksi detik itu juga. Mau saya pandu cara top-up nya Kak?</pre>
        </div>

        <div class="step-card" style="border-left-color: #17a2b8;">
            <div class="step-header">
                <div>
                    <span class="badge bg-info text-dark mb-1">H+2 (Jika ada saldo tapi diam)</span>
                    <h5 class="fw-bold mb-0 text-dark">Step 4: Arahkan Transaksi (Pecah Telur)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw3', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            
            <div class="chat-bubble">
                <span class="wa-bold">Wah, saldo sudah masuk ya Kak! Mantap.</span> 🔥<br><br>
                Biar makin paham untungnya, yuk coba transaksi pertama. Kakak bisa coba kirim paket (kurir bisa di-pickup ke rumah lho) atau coba isi pulsa ke nomor sendiri dulu.<br><br>
                Ingat ya Kak, setiap kirim paket ada <span class="wa-bold">Diskon Ongkir s/d 25%</span> yang langsung masuk ke saldo Kakak! Mau dicoba sekarang? 📦
            </div>
            <pre id="raw3" class="raw-wa-text">*Wah, saldo sudah masuk ya Kak! Mantap.* 🔥

Biar makin paham untungnya, yuk coba transaksi pertama. Kakak bisa coba kirim paket (kurir bisa di-pickup ke rumah lho) atau coba isi pulsa ke nomor sendiri dulu.

Ingat ya Kak, setiap kirim paket ada *Diskon Ongkir s/d 25%* yang langsung masuk ke saldo Kakak! Mau dicoba sekarang? 📦</pre>
        </div>

        <div class="step-card" style="border-left-color: var(--wa-green);">
            <div class="step-header">
                <div>
                    <span class="badge bg-success mb-1">H+3 (Setelah transaksi sukses)</span>
                    <h5 class="fw-bold mb-0 text-dark">Step 5: Masuk Komunitas & Lapor Marketing</h5>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn-copy" onclick="copyWaText('raw4', this)"><i class="far fa-copy"></i> Salin Pesan User</button>
                </div>
            </div>
            
            <div class="chat-bubble mb-4">
                <span class="wa-bold">Selamat Kak [Nama User] sudah berhasil transaksi pertamanya!</span> 🎉<br><br>
                Biar gak ketinggalan info promo dan tips bisnis harian dari pusat, saya undang Kakak masuk ke <span class="wa-bold">SIMASRIM Community</span> ya.<br><br>
                Berdasarkan status akun Kakak, Kakak akan saya masukkan ke grup <span class="wa-bold">[Owner / TJS / Partner]</span>. Di sana Kakak bisa diskusi langsung dengan mitra lainnya.<br><br>
                Klik link ini untuk bergabung ya:<br>
                👉 <span class="wa-italic">https://chat.whatsapp.com/HVwa1exnJuvGAuaIHMDfJC</span>
            </div>
            <pre id="raw4" class="raw-wa-text">*Selamat Kak [Nama User] sudah berhasil transaksi pertamanya!* 🎉

Biar gak ketinggalan info promo dan tips bisnis harian dari pusat, saya undang Kakak masuk ke *SIMASRIM Community* ya.

Berdasarkan status akun Kakak, Kakak akan saya masukkan ke grup *[Owner / TJS / Partner]*. Di sana Kakak bisa diskusi langsung dengan mitra lainnya.

Klik link ini untuk bergabung ya:
👉 _https://chat.whatsapp.com/HVwa1exnJuvGAuaIHMDfJC_</pre>

            <div class="p-3 bg-light rounded-3 text-center border mt-3">
                <p class="text-muted small mb-3"><i class="fas fa-info-circle"></i> Jika user sudah menyelesaikan transaksi pertama, segera laporkan ke <b>Grup WhatsApp Tim Marketing</b> agar bonus aktivasi Sales bisa direkap.</p>
                <a href="https://wa.me/?text=Halo%20Tim%20Marketing%2C%20Lapor%21%20%F0%9F%9A%80%0A%0AUser%20baru%20atas%20nama%20%2A%5BNama%20User%5D%2A%20%28ID%3A%20%2A%5BID%20User%5D%2A%29%20dari%20Sales%20%2A%5BNama%20Sales%5D%2A%20sudah%20berhasil%20melakukan%20%2ATransaksi%20Pertama%2A.%0A%0AMohon%20direkap%20untuk%20pencairan%20insentifnya%20ya%21%20Terima%20kasih." target="_blank" class="btn-report">
                    <i class="fab fa-whatsapp fs-5"></i> Kirim Laporan ke Grup Marketing
                </a>
            </div>
        </div>

    </div>
</section>

<section class="py-5 bg-white border-top">
    <div class="container followup-container">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark">FAQ Cheat Sheet (1-Click Copy)</h3>
            <p class="text-muted">Jawaban pamungkas format WA untuk pertanyaan yang sering muncul.</p>
        </div>
        
        <div class="table-responsive rounded-4 shadow-sm border">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th width="15%">Kategori</th>
                        <th width="30%">Pertanyaan User</th>
                        <th width="40%">Preview Jawaban</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-primary">Logistik</span></td>
                        <td class="fw-bold text-dark small">"Gimana cara kirim paketnya? Harus antar ke konter ya?"</td>
                        <td class="small text-muted">Tidak harus antar, Kak! Kakak bisa pilih menu V2 (Pickup)...</td>
                        <td class="text-center">
                            <button class="btn-copy btn-sm" onclick="copyWaText('faq1', this)">Salin</button>
                            <pre id="faq1" class="raw-wa-text">Tidak harus antar, Kak! Kakak bisa pilih menu *V2 (Pickup)* agar kurir jemput ke lokasi. Kalau mau antar sendiri, pilih menu *V1 (Drop Off)* di aplikasi ya Kak. 📦</pre>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge" style="background-color: #502883; color: white;">Diskon</span></td>
                        <td class="fw-bold text-dark small">"Dapat untung berapa kalau kirim paket lewat SIMASRIM?"</td>
                        <td class="small text-muted">Besar banget, Kak! Kakak bisa dapat Diskon Ongkir s/d 25%...</td>
                        <td class="text-center">
                            <button class="btn-copy btn-sm" onclick="copyWaText('faq2', this)">Salin</button>
                            <pre id="faq2" class="raw-wa-text">Besar banget, Kak! Kakak bisa dapat *Diskon Ongkir s/d 25%* (Tergantung Ekspedisi). Diskon langsung mengurangi tagihan, jadi uang yang diterima dari pembeli dan saldo yang terpotong akan selisih, nah selisih itu langsung jadi keuntungan Kakak. 💸</pre>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-warning text-dark">PPOB</span></td>
                        <td class="fw-bold text-dark small">"Harga pulsa dan token PLN-nya gimana? Murah gak?"</td>
                        <td class="small text-muted">Kita pakai Harga Agen (Net) yang kompetitif. Kelebihannya...</td>
                        <td class="text-center">
                            <button class="btn-copy btn-sm" onclick="copyWaText('faq3', this)">Salin</button>
                            <pre id="faq3" class="raw-wa-text">Kita pakai *Harga Agen (Net)* yang sangat kompetitif, Kak. Kelebihannya, Kakak *bebas atur sendiri* mau ambil untung berapa per transaksi lewat fitur _Markup/Admin Tambahan_ di dalam aplikasi. 📱</pre>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-info text-dark">Tiket</span></td>
                        <td class="fw-bold text-dark small">"Jual tiket pesawat ada komisinya gak?"</td>
                        <td class="small text-muted">Untuk tiket, saat ini Kakak dapat Harga NTA (Harga Dasar)...</td>
                        <td class="text-center">
                            <button class="btn-copy btn-sm" onclick="copyWaText('faq4', this)">Salin</button>
                            <pre id="faq4" class="raw-wa-text">Untuk tiket, saat ini Kakak dapat *Harga NTA* (Harga Dasar) dari maskapai/operator. Jadi, keuntungan Kakak diambil dari *Biaya Admin/Layanan* yang Kakak tentukan sendiri dan dibebankan ke pembeli. ✈️</pre>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-secondary">Hardware</span></td>
                        <td class="fw-bold text-dark small">"Saya mau punya mesin EDC tapi modal mepet, bisa gak?"</td>
                        <td class="small text-muted">Bisa banget! Kita ada program Cicilan EDC Android...</td>
                        <td class="text-center">
                            <button class="btn-copy btn-sm" onclick="copyWaText('faq5', this)">Salin</button>
                            <pre id="faq5" class="raw-wa-text">Bisa banget! Kita ada program *Cicilan EDC Android & SQRIS* dengan cicilan otomatis potongan per transaksi yang ringan, yang bikin cicilan ga berasa. Bisnis terlihat profesional, bayarnya pelan-pelan sambil jalan. 💳</pre>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-success">Keamanan</span></td>
                        <td class="fw-bold text-dark small">"Aman gak kalau saya deposit saldo di sini?"</td>
                        <td class="small text-muted">Sangat aman, Kak. SIMASRIM dikelola oleh PT Solusi...</td>
                        <td class="text-center">
                            <button class="btn-copy btn-sm" onclick="copyWaText('faq6', this)">Salin</button>
                            <pre id="faq6" class="raw-wa-text">Sangat aman, Kak. SIMASRIM dikelola oleh *PT Solusi Mitra Aplikasi* yang resmi dan berbadan hukum. Kami juga sudah bekerjasama resmi dengan berbagai mitra ekspedisi dan biller nasional yang terpercaya. 🔒</pre>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="py-5" style="background: var(--bg-soft-purple);">
    <div class="container py-4 followup-container">
        <h3 class="fw-bold text-center mb-5 text-primary"><i class="fas fa-lightbulb me-2 text-accent"></i> Golden Rules untuk CS</h3>
        
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 border shadow-sm h-100 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary mb-3" style="width: 50px; height: 50px; font-size: 1.2rem;">🎙️</div>
                    <h5 class="fw-bold text-dark">Gunakan Voice Note</h5>
                    <p class="small text-muted mb-0">Jika user terlihat bingung atau lambat merespon chat, CS bisa kirim <i>voice note</i> pendek agar terasa lebih personal dan ramah.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 border shadow-sm h-100 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary mb-3" style="width: 50px; height: 50px; font-size: 1.2rem;">🖥️</div>
                    <h5 class="fw-bold text-dark">Cek Dashboard</h5>
                    <p class="small text-muted mb-0">Sebelum mengirim chat Step 3 atau 4, CS <b>wajib</b> mengecek dashboard sistem apakah user sudah top-up/transaksi atau belum agar tidak salah <b>follow-up</b>.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 border shadow-sm h-100 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary mb-3" style="width: 50px; height: 50px; font-size: 1.2rem;">📢</div>
                    <h5 class="fw-bold text-dark">Lapor Marketing</h5>
                    <p class="small text-muted mb-0">Jika user sudah sukses transaksi pertama, segera lapor ke Grup Tim Marketing agar bonus aktivasi milik tim Sales bisa direkap dan dicairkan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<a href="https://wa.me/?text=Halo%20Tim%20Marketing%2C%20Lapor%21%20%F0%9F%9A%80%0A%0AUser%20baru%20atas%20nama%20%2A%5BNama%20User%5D%2A%20%28ID%3A%20%2A%5BID%20User%5D%2A%29%20dari%20Sales%20%2A%5BNama%20Sales%5D%2A%20sudah%20berhasil%20melakukan%20%2ATransaksi%20Pertama%2A.%0A%0AMohon%20direkap%20untuk%20pencairan%20insentifnya%20ya%21%20Terima%20kasih." target="_blank" class="fab-report" title="Lapor Transaksi ke Grup Marketing">
    <i class="fab fa-whatsapp fs-4" style="color: var(--wa-green);"></i> <span class="d-none d-md-inline">Lapor Transaksi</span>
</a>

<?php include 'footer.php'; ?>