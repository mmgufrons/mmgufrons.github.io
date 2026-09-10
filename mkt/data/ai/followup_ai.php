<?php 
$page_title = "SOP CS AI Automation | SIMASRIM";
$footer_desc = "Dokumen Internal Terbatas - Divisi IT & Customer Service.";
$base_path = '../../'; include '../../includes/header.php'; 
?>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25"><i class="fas fa-microchip me-2"></i>Sistem IT Terintegrasi</span>
        <h2 class="display-5 fw-bold mb-2">Automated Onboarding & Recall (AI)</h2>
        <p class="text-white-50 mb-0">Blueprint alur percakapan AI untuk meminimalisir beban CS Manual. <br>Script di bawah ini siap disalin untuk dipasang ke dalam <i>knowledge base / auto-responder</i> bot kita.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">
        
        <div class="step-card" style="border-left-color: #6c757d;">
            <div class="step-header">
                <div>
                    <span class="badge bg-secondary mb-1">Pre-Condition (Aksi User)</span>
                    <h5 class="fw-bold mb-0 text-dark">Trigger: User Klik Link WA Pasca Daftar</h5>
                </div>
            </div>
            <p class="text-muted small mb-3">Sistem aplikasi/web langsung mengarahkan user menekan tombol WA yang berisi format pesan berikut agar AI kita bisa merespons.</p>
            <div class="chat-bubble user-bubble">
                Halo Admin SIMASRIM, <br>
                Saya <b>[Nama User]</b> dengan ID <b>[ID User]</b> ingin mengaktifkan akun dan meminta panduan.
            </div>
        </div>

        <div class="step-card" style="border-left-color: var(--ai-blue);">
            <div class="step-header">
                <div>
                    <span class="badge bg-primary mb-1">AI Action: H+0 (Detik yang sama)</span>
                    <h5 class="fw-bold mb-0 text-dark">Step 1: AI Greeting & Kirim Panduan</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw1', this)"><i class="far fa-copy"></i> Salin Script AI</button>
            </div>
            
            <div class="chat-bubble">
                <span class="wa-bold">Halo Kak [Nama User], selamat datang di SIMASRIM!</span> 🤖👋<br><br>
                Sistem kami mendeteksi akun Kakak (ID: [ID User]) sudah <span class="wa-bold">aktif</span> dan siap digunakan untuk cuan hari ini! 🚀<br>
                Sebagai langkah awal, berikut adalah <span class="wa-bold">Panduan Lengkap</span> cara pakai aplikasi untuk kirim paket dan jualan produk digital:<br><br>
                🔗 <span class="wa-italic">https://docs.simasrim.com/53b8f03d-66ee-46a8-94fc-ac7338e03948/</span><br><br>
                Silakan pelajari panduannya ya Kak. Ketik <span class="wa-bold">"INFO TOP UP"</span> jika Kakak sudah siap mengisi saldo perdana, atau ketik <span class="wa-bold">"BANTUAN CS"</span> jika ingin berbicara dengan tim kami.
            </div>
            <pre id="raw1" class="raw-wa-text">*Halo Kak [Nama User], selamat datang di SIMASRIM!* 🤖👋

Sistem kami mendeteksi akun Kakak (ID: [ID User]) sudah *aktif* dan siap digunakan untuk cuan hari ini! 🚀
Sebagai langkah awal, berikut adalah *Panduan Lengkap* cara pakai aplikasi untuk kirim paket dan jualan produk digital:

🔗 _https://docs.simasrim.com/53b8f03d-66ee-46a8-94fc-ac7338e03948/_

Silakan pelajari panduannya ya Kak. Ketik *"INFO TOP UP"* jika Kakak sudah siap mengisi saldo perdana, atau ketik *"BANTUAN CS"* jika ingin berbicara dengan tim kami.</pre>
        </div>

        <div class="step-card" style="border-left-color: var(--accent);">
            <div class="step-header">
                <div>
                    <span class="badge bg-warning text-dark mb-1">AI Recall: H+1 (Jika Saldo = Rp0)</span>
                    <h5 class="fw-bold mb-0 text-dark">Step 2: Automated Recall (Push Top Up)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw2', this)"><i class="far fa-copy"></i> Salin Script AI</button>
            </div>
            <p class="text-muted small mb-3"><i>Cronjob sistem akan mengecek jika saldo user masih Rp0 setelah 24 jam. Jika iya, AI akan mengirim pesan ini secara otomatis:</i></p>
            <div class="chat-bubble">
                <span class="wa-bold">Halo Kak [Nama User], belum sempat cek aplikasinya ya?</span> 👀<br><br>
                Biar langsung bisa gas transaksi kirim paket atau jualan pulsa, yuk isi saldo pertamanya.<br>
                Bisa via transfer bank, VA, atau QRIS, <span class="wa-bold">dimulai dari 10rb aja</span> lho Kak. 💸<br><br>
                Saldo Kakak aman 100% dan bisa langsung ditarik/dipakai transaksi detik itu juga. Ketik <span class="wa-bold">"CARA TOP UP"</span> untuk melihat instruksinya.
            </div>
            <pre id="raw2" class="raw-wa-text">*Halo Kak [Nama User], belum sempat cek aplikasinya ya?* 👀

Biar langsung bisa gas transaksi kirim paket atau jualan pulsa, yuk isi saldo pertamanya.
Bisa via transfer bank, VA, atau QRIS, *dimulai dari 10rb aja* lho Kak. 💸

Saldo Kakak aman 100% dan bisa langsung ditarik/dipakai transaksi detik itu juga. Ketik *"CARA TOP UP"* untuk melihat instruksinya.</pre>
        </div>

        <div class="step-card" style="border-left-color: #17a2b8;">
            <div class="step-header">
                <div>
                    <span class="badge bg-info text-dark mb-1">AI Recall: H+2 (Saldo > 0, Trx = 0)</span>
                    <h5 class="fw-bold mb-0 text-dark">Step 3: Arahkan Transaksi (Pecah Telur)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw3', this)"><i class="far fa-copy"></i> Salin Script AI</button>
            </div>
            <p class="text-muted small mb-3"><i>Trigger sistem: User sudah top-up tapi belum melakukan transaksi pertama.</i></p>
            <div class="chat-bubble">
                <span class="wa-bold">Wah, saldo sebesar [Nominal Saldo] sudah masuk ya Kak! Mantap.</span> 🔥<br><br>
                Biar makin paham untungnya, yuk coba transaksi pertama. Kakak bisa coba kirim paket ke alamat terdekat (kurir bisa di-pickup ke rumah lho) atau coba isi pulsa ke nomor sendiri dulu.<br><br>
                Ingat ya Kak, setiap kirim paket ada <span class="wa-bold">Diskon Ongkir s/d 25%</span> yang langsung masuk ke saldo Kakak! Ketik <span class="wa-bold">"CARA KIRIM"</span> atau <span class="wa-bold">"CARA PULSA"</span> untuk melihat panduan instannya. 📦
            </div>
            <pre id="raw3" class="raw-wa-text">*Wah, saldo sebesar [Nominal Saldo] sudah masuk ya Kak! Mantap.* 🔥

Biar makin paham untungnya, yuk coba transaksi pertama. Kakak bisa coba kirim paket ke alamat terdekat (kurir bisa di-pickup ke rumah lho) atau coba isi pulsa ke nomor sendiri dulu.

Ingat ya Kak, setiap kirim paket ada *Diskon Ongkir s/d 25%* yang langsung masuk ke saldo Kakak! Ketik *"CARA KIRIM"* atau *"CARA PULSA"* untuk melihat panduan instannya. 📦</pre>
        </div>

        <div class="step-card" style="border-left-color: var(--wa-green);">
            <div class="step-header">
                <div>
                    <span class="badge bg-success mb-1">AI Action (Trx Pertama Sukses)</span>
                    <h5 class="fw-bold mb-0 text-dark">Step 4: Auto-Invite Komunitas</h5>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn-copy" onclick="copyWaText('raw4', this)"><i class="far fa-copy"></i> Salin Script AI</button>
                </div>
            </div>
            
            <div class="chat-bubble mb-4">
                <span class="wa-bold">Selamat Kak [Nama User] atas transaksi sukses pertamanya!</span> 🎉<br><br>
                Sebagai apresiasi, kami mengundang Kakak untuk bergabung ke <span class="wa-bold">SIMASRIM Community</span>. Di sana Kakak bisa diskusi langsung dengan mitra lainnya, dapat info promo, dan tips bisnis harian.<br><br>
                Klik link ini untuk bergabung ke Grup [Kategori Grup] ya:<br>
                👉 <span class="wa-italic">https://chat.whatsapp.com/HVwa1exnJuvGAuaIHMDfJC</span>
            </div>
            <pre id="raw4" class="raw-wa-text">*Selamat Kak [Nama User] atas transaksi sukses pertamanya!* 🎉

Sebagai apresiasi, kami mengundang Kakak untuk bergabung ke *SIMASRIM Community*. Di sana Kakak bisa diskusi langsung dengan mitra lainnya, dapat info promo, dan tips bisnis harian.

Klik link ini untuk bergabung ke Grup [Kategori Grup] ya:
👉 _https://chat.whatsapp.com/HVwa1exnJuvGAuaIHMDfJC_</pre>

        </div>

    </div>
</section>

<section class="py-5 bg-white border-top">
    <div class="container followup-container">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark">AI Knowledge Base (Cheat Sheet)</h3>
            <p class="text-muted">Database jawaban untuk bot AI (Atau CS Manual jika AI di-<i>bypass</i>).</p>
        </div>
        
        <div class="table-responsive rounded-4 shadow-sm border">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="15%">Kategori</th>
                        <th width="30%">Keyword / Pertanyaan User</th>
                        <th width="40%">Respons Otomatis AI</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-primary">Logistik</span></td>
                        <td class="fw-bold text-dark small">"Kirim paket / Antar konter"</td>
                        <td class="small text-muted">Tidak harus antar, Kak! Kakak bisa pilih menu V2 (Pickup)...</td>
                        <td class="text-center">
                            <button class="btn-copy btn-sm" onclick="copyWaText('faq1', this)">Salin</button>
                            <pre id="faq1" class="raw-wa-text">Tidak harus antar, Kak! Kakak bisa pilih menu *V2 (Pickup)* agar kurir jemput ke lokasi. Kalau mau antar sendiri, pilih menu *V1 (Drop Off)* di aplikasi ya Kak. 📦</pre>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge" style="background-color: #502883; color: white;">Diskon</span></td>
                        <td class="fw-bold text-dark small">"Untung / Diskon paket"</td>
                        <td class="small text-muted">Besar banget, Kak! Kakak bisa dapat Diskon Ongkir s/d 25%...</td>
                        <td class="text-center">
                            <button class="btn-copy btn-sm" onclick="copyWaText('faq2', this)">Salin</button>
                            <pre id="faq2" class="raw-wa-text">Besar banget, Kak! Kakak bisa dapat *Diskon Ongkir s/d 25%* (Tergantung Ekspedisi). Diskon langsung mengurangi tagihan, jadi uang yang diterima dari pembeli dan saldo yang terpotong akan selisih, nah selisih itu langsung jadi keuntungan Kakak. 💸</pre>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-warning text-dark">PPOB</span></td>
                        <td class="fw-bold text-dark small">"Harga pulsa / Margin"</td>
                        <td class="small text-muted">Kita pakai Harga Agen (Net) yang kompetitif. Kelebihannya...</td>
                        <td class="text-center">
                            <button class="btn-copy btn-sm" onclick="copyWaText('faq3', this)">Salin</button>
                            <pre id="faq3" class="raw-wa-text">Kita pakai *Harga Agen (Net)* yang sangat kompetitif, Kak. Kelebihannya, Kakak *bebas atur sendiri* mau ambil untung berapa per transaksi lewat fitur _Markup/Admin Tambahan_ di dalam aplikasi. 📱</pre>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-info text-dark">Tiket</span></td>
                        <td class="fw-bold text-dark small">"Komisi tiket pesawat"</td>
                        <td class="small text-muted">Untuk tiket, saat ini Kakak dapat Harga NTA (Harga Dasar)...</td>
                        <td class="text-center">
                            <button class="btn-copy btn-sm" onclick="copyWaText('faq4', this)">Salin</button>
                            <pre id="faq4" class="raw-wa-text">Untuk tiket, saat ini Kakak dapat *Harga NTA* (Harga Dasar) dari maskapai/operator. Jadi, keuntungan Kakak diambil dari *Biaya Admin/Layanan* yang Kakak tentukan sendiri dan dibebankan ke pembeli. ✈️</pre>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-secondary">Hardware</span></td>
                        <td class="fw-bold text-dark small">"Harga EDC / Cicilan"</td>
                        <td class="small text-muted">Bisa banget! Kita ada program Cicilan EDC Android...</td>
                        <td class="text-center">
                            <button class="btn-copy btn-sm" onclick="copyWaText('faq5', this)">Salin</button>
                            <pre id="faq5" class="raw-wa-text">Bisa banget! Kita ada program *Cicilan EDC Android & SQRIS* dengan cicilan otomatis potongan per transaksi yang ringan, yang bikin cicilan ga berasa. Bisnis terlihat profesional, bayarnya pelan-pelan sambil jalan. 💳</pre>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-success">Keamanan</span></td>
                        <td class="fw-bold text-dark small">"Aman gak deposit / Legalitas"</td>
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
        <h3 class="fw-bold text-center mb-5 text-primary"><i class="fas fa-users-cog me-2 text-accent"></i> Peran CS Manual (Human Fallback)</h3>
        
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 border shadow-sm h-100 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 text-danger mb-3" style="width: 50px; height: 50px; font-size: 1.2rem;">🆘</div>
                    <h5 class="fw-bold text-dark">Keyword Intervensi</h5>
                    <p class="small text-muted mb-0">Jika user mengetik kata kunci <b>"Bantuan CS"</b>, <b>"Admin"</b>, atau <b>"Komplain"</b>, AI akan otomatis berhenti merespons dan menyerahkan chat ke layar CS Manual.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 border shadow-sm h-100 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary mb-3" style="width: 50px; height: 50px; font-size: 1.2rem;">🎙️</div>
                    <h5 class="fw-bold text-dark">Sentuhan Personal</h5>
                    <p class="small text-muted mb-0">CS wajib membalas menggunakan <i>Voice Note</i> atau menelepon langsung user yang ditransfer oleh AI untuk memberikan kenyamanan ekstra.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 border shadow-sm h-100 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success mb-3" style="width: 50px; height: 50px; font-size: 1.2rem;">📊</div>
                    <h5 class="fw-bold text-dark">Monitoring Laporan</h5>
                    <p class="small text-muted mb-0">Sistem akan secara otomatis me-rekap user yang berhasil transaksi, namun CS tetap memantau dasbor untuk melaporkan anomali ke tim Marketing.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<a href="https://wa.me/?text=Halo%20Tim%20Marketing%2C%20Sistem%20melaporkan%20pencapaian%20baru%21%20%F0%9F%9A%80%0A%0AUser%20atas%20nama%20%2A%5BNama%20User%5D%2A%20%28ID%3A%20%2A%5BID%20User%5D%2A%29%20dari%20Sales%20%2A%5BNama%20Sales%5D%2A%20sudah%20berhasil%20menyelesaikan%20%2ATransaksi%20Pertama%2A%20melalui%20panduan%20AI.%0A%0AMohon%20direkap%20untuk%20pencairan%20insentifnya%20ya%21" target="_blank" class="fab-report" title="Lapor Transaksi ke Grup Marketing">
    <i class="fab fa-whatsapp fs-4" style="color: var(--wa-green);"></i> <span class="d-none d-md-inline">Lapor Transaksi</span>
</a>

<?php include 'footer.php'; ?>