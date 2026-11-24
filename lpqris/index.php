<?php
// =============================================
// BACKEND PHP - PROSES FORM KE WHATSAPP
// =============================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function cleanInput($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    function redirectToWhatsApp($data) {
        // PORTOFOLIO DEMO: nomor WA asli dihapus, diganti nomor dummy.
        $phone = "6280000000000";
        $message = "Halo, saya ingin daftar QRIS Statis2Dinamis!\n\n";
        $message .= "📋 *DATA PENDAFTARAN*\n";
        $message .= "Nama: " . $data['nama'] . "\n";
        $message .= "Email: " . $data['email'] . "\n";
        $message .= "WhatsApp: " . $data['whatsapp'] . "\n\n";
        $message .= "Saya ingin konversi QRIS statis ke dinamis.\n";
        $message .= "Mohon info lengkapnya ya!";
        $encodedMessage = urlencode($message);
        return "https://wa.me/{$phone}?text={$encodedMessage}";
    }

    try {
        $requiredFields = ['nama', 'email', 'whatsapp'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Field $field harus diisi");
            }
        }
        
        $nama = cleanInput($_POST['nama']);
        $email = cleanInput($_POST['email']);
        $whatsapp = cleanInput($_POST['whatsapp']);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Format email tidak valid");
        }
        
        if (!preg_match('/^[0-9]{10,13}$/', $whatsapp)) {
            throw new Exception("Format nomor WhatsApp tidak valid (contoh: 081234567890)");
        }
        
        $whatsappData = [
            'nama' => $nama,
            'email' => $email,
            'whatsapp' => $whatsapp
        ];
        
        header("Location: " . redirectToWhatsApp($whatsappData));
        exit;
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Ikon garis (bentuk Lucide, ISC) disimpan di sini supaya halaman tidak bergantung pada unpkg "@latest".
$ik = [
    'sun' => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2m-7.07-17.07 1.41 1.41m11.32 11.32 1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>',
    'moon' => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>',
    'menu' => '<path d="M4 6h16M4 12h16M4 18h16"/>',
    'x' => '<path d="M18 6 6 18M6 6l12 12"/>',
    'arrow-right' => '<path d="M5 12h14m-7-7 7 7-7 7"/>',
    'check' => '<path d="M20 6 9 17l-5-5"/>',
    'shield-check' => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
    'shield-alert' => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M12 8v4m0 4h.01"/>',
    'zap' => '<path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/>',
    'store' => '<path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4M2 7h20M22 7v3a2 2 0 0 1-2 2 2.7 2.7 0 0 1-2-1 2.7 2.7 0 0 1-2 1 2.7 2.7 0 0 1-2-1 2.7 2.7 0 0 1-2 1 2.7 2.7 0 0 1-2-1 2.7 2.7 0 0 1-2 1 2.7 2.7 0 0 1-2-1 2.7 2.7 0 0 1-2 1 2 2 0 0 1-2-2V7"/>',
    'refresh-cw' => '<path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/>',
    'qr-code' => '<rect width="5" height="5" x="3" y="3" rx="1"/><rect width="5" height="5" x="16" y="3" rx="1"/><rect width="5" height="5" x="3" y="16" rx="1"/><path d="M21 16h-3a2 2 0 0 0-2 2v3M21 21v.01M12 7v3a2 2 0 0 1-2 2H7M3 12h.01M12 3h.01M12 16v.01M16 12h1M21 12v.01M12 21v-1"/>',
    'scan' => '<path d="M3 7V5a2 2 0 0 1 2-2h2M17 3h2a2 2 0 0 1 2 2v2M21 17v2a2 2 0 0 1-2 2h-2M7 21H5a2 2 0 0 1-2-2v-2"/>',
    'banknote' => '<rect width="20" height="12" x="2" y="6" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/>',
    'message-square-text' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M13 8H7m10 4H7"/>',
    'alert-circle' => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/>',
    'user' => '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'mail' => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
    'phone' => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
    'info' => '<circle cx="12" cy="12" r="10"/><path d="M12 16v-4m0-4h.01"/>',
    'send' => '<path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>',
    'message-circle' => '<path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>',
    'check-circle' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/>',
];
function ikon($nama, $kelas = '') {
    global $ik;
    return '<svg class="lq-ikon ' . $kelas . '" viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . $ik[$nama] . '</svg>';
}
function nilai_lama($kolom) {
    return isset($_POST[$kolom]) ? htmlspecialchars($_POST[$kolom], ENT_QUOTES, 'UTF-8') : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>QRIS Statis2Dinamis - Solusi Pembayaran QRIS Anti Salah Ketik</title>
    <meta name="description" content="Ubah QRIS Statis menjadi Dinamis dan Online. Nominal terkunci otomatis, 0% MDR, notifikasi instan.">

    <meta property="og:title" content="Jasa Pembuatan QRIS statis menjadi Dinamis dan Online" />
    <meta property="og:description" content="Ubah QRIS Statismua menjadi Dinamis dan Online!" />
    <meta property="og:image" content="https://lpqris.smsrm.com/qrisstatis2dinamis.jpg" />
    <meta property="og:url" content="https://lpqris.smsrm.com/" />
    <meta property="og:type" content="website" />

    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <script>
        // Tema dipasang sebelum halaman tergambar supaya tidak berkedip. Bawaan: terang (permintaan klien).
        try { if (localStorage.getItem('theme') === 'dark') document.documentElement.classList.add('dark'); } catch (e) {}
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <nav class="lq-nav" aria-label="Navigasi utama">
        <div class="lq-wadah lq-nav__baris">
            <a href="#atas" class="lq-merek">
                <img src="favicon.svg" alt="" width="40" height="40">
                <span>QRIS Statis2Dinamis</span>
            </a>

            <div class="lq-nav__menu">
                <a href="#demo">Demo</a>
                <a href="#features">Fitur</a>
                <a href="#pricing">Harga</a>
                <button type="button" class="lq-ikon-tombol" data-ganti-tema aria-label="Ganti tema terang atau gelap">
                    <?= ikon('moon', 'lq-ikon-terang') ?><?= ikon('sun', 'lq-ikon-gelap') ?>
                </button>
                <a href="#form" class="lq-tombol lq-tombol--utama lq-tombol--pil">Daftar Sekarang</a>
            </div>

            <div class="lq-nav__alat lq-nav__hp">
                <button type="button" class="lq-ikon-tombol" data-ganti-tema aria-label="Ganti tema terang atau gelap">
                    <?= ikon('moon', 'lq-ikon-terang') ?><?= ikon('sun', 'lq-ikon-gelap') ?>
                </button>
                <button type="button" class="lq-ikon-tombol lq-ikon-tombol--polos" id="mobile-menu-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-menu">
                    <?= ikon('menu', 'lq-ikon--24') ?>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="lq-menu-hp" hidden>
            <a href="#demo">Demo</a>
            <a href="#features">Fitur</a>
            <a href="#pricing">Harga</a>
            <a href="#form" class="lq-tombol lq-tombol--utama lq-tombol--penuh">Daftar Sekarang</a>
        </div>
    </nav>

    <main id="atas">

        <section class="lq-hero">
            <div class="lq-wadah lq-hero__isi">
                <div class="lq-hero__teks">
                    <p class="lq-lencana">
                        <span class="lq-titik" aria-hidden="true"></span>
                        <span>💰 0% MDR | ⚡ Notifikasi Instant | 🔒 Bebas Pajak</span>
                    </p>

                    <h1>Stop Loss Akibat <br><span class="lq-gradasi">Salah Ketik Nominal</span> QRIS!</h1>

                    <p class="lq-hero__lead">
                        Ubah QRIS Statis Anda menjadi QRIS Statis2Dinamis. Customer tinggal scan, nominal otomatis terkunci 100% akurat. Hemat biaya per-transaksi, tanpa pusing urus refund.
                    </p>

                    <div class="lq-hero__aksi">
                        <a href="#form" class="lq-tombol lq-tombol--utama">Konversi Sekarang <?= ikon('arrow-right') ?></a>
                        <a href="#demo" class="lq-tombol lq-tombol--kedua">Lihat Demo Interaktif</a>
                    </div>

                    <ul class="lq-centang-baris">
                        <li><span class="lq-centang"><?= ikon('check', 'lq-ikon--16') ?></span>Bebas Admin</li>
                        <li><span class="lq-centang"><?= ikon('check', 'lq-ikon--16') ?></span>Bebas Pajak</li>
                        <li><span class="lq-centang"><?= ikon('check', 'lq-ikon--16') ?></span>Flat 1 Tahun</li>
                    </ul>
                </div>

                <div class="lq-hero__gambar">
                    <div class="lq-melayang">
                        <div class="lq-bingkai">
                            <img src="qrisstatis2dinamis.jpg" alt="Ilustrasi QRIS Statis2Dinamis" width="1500" height="1500">
                        </div>
                        <div class="lq-mengambang lq-mengambang--1 lq-melayang lq-melayang--cepat" aria-hidden="true">
                            <span class="lq-bulat lq-bulat--hijau"><?= ikon('shield-check', 'lq-ikon--24') ?></span>
                            <div><small>Pembayaran Berhasil</small><strong>Rp 250.000</strong></div>
                        </div>
                        <div class="lq-mengambang lq-mengambang--2 lq-melayang lq-melayang--cepat lq-melayang--tunda" aria-hidden="true">
                            <span class="lq-bulat lq-bulat--ungu"><?= ikon('zap') ?></span>
                            <strong>0% MDR</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Logo klien: disembunyikan sejak versi asli (belum ada izin tampil) -->
        <section hidden aria-label="Dipercaya oleh berbagai brand">
            <img src="logo/albanistore.png" alt="Albani Store">
            <img src="logo/fjk.png" alt="FJK">
            <img src="logo/ordermudah.png" alt="Order Mudah">
            <img src="logo/safarme.png" alt="Safar Me">
            <img src="logo/solusimitraaplikasi.webp" alt="Solusi Mitra Aplikasi">
        </section>

        <section id="demo" class="lq-bagian" aria-labelledby="judul-demo">
            <div class="lq-wadah">
                <div class="lq-kepala">
                    <p class="lq-overline">Simulasi Interaktif</p>
                    <h2 class="lq-judul" id="judul-demo">Lihat Bagaimana Sistem Bekerja</h2>
                    <p class="lq-sub">Coba ketik nominal di bawah ini dan perhatikan bagaimana QR Code secara otomatis di-generate unik dan terupdate secara real-time.</p>
                </div>

                <div class="lq-demo">
                    <div class="lq-kasir lq-miring">
                        <div class="lq-kasir__kepala">
                            <div class="lq-kasir__nama">
                                <span class="lq-kotak-ikon"><?= ikon('store', 'lq-ikon--24') ?></span>
                                <div>
                                    <h3>Layar Kasir Merchant</h3>
                                    <p>Aplikasi POS Anda</p>
                                </div>
                            </div>
                            <span class="lq-status">ONLINE</span>
                        </div>

                        <div class="lq-tumpuk">
                            <div>
                                <label for="demoInput" class="lq-label">Input Total Belanja Customer</label>
                                <div class="lq-medan">
                                    <span class="lq-medan__awal lq-medan__awal--rp" aria-hidden="true">Rp</span>
                                    <input type="text" id="demoInput" class="lq-isian lq-isian--nominal" inputmode="numeric" autocomplete="off" placeholder="0">
                                </div>
                            </div>
                            <button type="button" id="simulateBtn" class="lq-tombol lq-tombol--gelap lq-tombol--besar lq-tombol--penuh">
                                <?= ikon('refresh-cw') ?> <span>Update Layar Pelanggan</span>
                            </button>
                        </div>
                    </div>

                    <div class="lq-hp-wadah">
                        <div class="lq-hp lq-miring">
                            <span class="lq-hp__label">LAYAR PELANGGAN</span>
                            <h3>Scan untuk Membayar</h3>
                            <p class="lq-hp__nominal" id="demoAmount" aria-live="polite">Rp 0</p>

                            <div class="lq-qr-luar">
                                <div id="qrOverlay" class="lq-qr-tutup" aria-hidden="true"><span class="lq-putar"></span></div>
                                <div class="lq-qr" id="qrContainer" role="img" aria-label="Contoh kode QR">
                                    <?= ikon('qr-code') ?>
                                </div>
                            </div>

                            <div class="lq-hp__bayar">
                                <label for="bankSelect" class="lq-label">Simulasikan Bayar Dari Bank:</label>
                                <select id="bankSelect" class="lq-pilih">
                                    <option value="BCA">BCA</option>
                                    <option value="Mandiri">Mandiri</option>
                                    <option value="BNI">BNI</option>
                                    <option value="BRI">BRI</option>
                                </select>
                                <button type="button" id="payBtn" class="lq-tombol lq-tombol--hijau lq-tombol--penuh" disabled>
                                    <?= ikon('scan') ?> <span>Scan &amp; Bayar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="lq-bagian lq-bagian--putih" aria-labelledby="judul-fitur">
            <div class="lq-wadah">
                <div class="lq-kepala">
                    <p class="lq-overline">Keunggulan</p>
                    <h2 class="lq-judul" id="judul-fitur">Tinggalkan Cara Lama yang Berisiko</h2>
                </div>

                <div class="lq-grid-3">
                    <article class="lq-fitur">
                        <span class="lq-kotak-ikon"><?= ikon('shield-alert', 'lq-ikon--24') ?></span>
                        <h3>Zero Error / Anti Salah</h3>
                        <p>Customer tidak perlu lagi ketik nominal. Murni merchant yang tentukan, menghapus 100% risiko salah ketik.</p>
                    </article>
                    <article class="lq-fitur lq-fitur--hijau">
                        <span class="lq-kotak-ikon"><?= ikon('banknote', 'lq-ikon--24') ?></span>
                        <h3>100% Bebas Biaya Transaksi</h3>
                        <p>0% MDR. Tidak ada potongan persentase per transaksi. Transaksi 100 ribu, masuk bersih 100 ribu.</p>
                    </article>
                    <article class="lq-fitur lq-fitur--biru">
                        <span class="lq-kotak-ikon"><?= ikon('zap', 'lq-ikon--24') ?></span>
                        <h3>Notifikasi Instant</h3>
                        <p>Hitungan detik setelah customer bayar, notifikasi langsung muncul. Tidak perlu refresh atau cek mutasi manual.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="pricing" class="lq-bagian lq-harga" aria-labelledby="judul-harga">
            <span class="lq-harga__hias lq-harga__hias--1" aria-hidden="true"></span>
            <span class="lq-harga__hias lq-harga__hias--2" aria-hidden="true"></span>
            <div class="lq-wadah">
                <div class="lq-kepala">
                    <p class="lq-overline">Investasi Pintar</p>
                    <h2 class="lq-judul" id="judul-harga">Satu Harga, Akses Penuh</h2>
                    <p class="lq-sub">Tidak ada biaya tersembunyi. Bebas pajak. Bayar sekali untuk setahun.</p>
                </div>

                <div class="lq-paket">
                    <div class="lq-paket__isi">
                        <span class="lq-pita">BEST DEAL</span>
                        <div class="lq-paket__atas">
                            <h3>Lisensi Premium</h3>
                            <p class="lq-paket__normal">Harga Normal Rp 50.000/bulan (Rp 600.000/tahun)</p>
                            <div class="lq-paket__hemat">
                                <span>Hemat Rp 500.000</span>
                                <s>Rp 600.000</s>
                            </div>
                            <p class="lq-paket__harga">Rp 100<small>.000</small></p>
                            <p class="lq-paket__per">/ tahun <span>Bebas Pajak</span></p>
                        </div>

                        <ul class="lq-daftar-fitur">
                            <li><span class="lq-bulat"><?= ikon('check', 'lq-ikon--16') ?></span><p><strong>Generate QRIS Dinamis</strong> Unlimited</p></li>
                            <li><span class="lq-bulat"><?= ikon('check', 'lq-ikon--16') ?></span><p><strong>Semua Fitur Premium</strong> Terbuka</p></li>
                            <li><span class="lq-bulat"><?= ikon('check', 'lq-ikon--16') ?></span><p><strong>Priority Support</strong> WhatsApp</p></li>
                            <li><span class="lq-bulat"><?= ikon('check', 'lq-ikon--16') ?></span><p><strong>Update Fitur Gratis</strong> Selamanya</p></li>
                        </ul>

                        <a href="https://lynk.id/albanistudio/8vxl6zmkxqwz/checkout" target="_blank" rel="noopener" class="lq-tombol lq-tombol--beli lq-tombol--penuh">Beli Sekarang</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="form" class="lq-bagian lq-bagian--putih" aria-labelledby="judul-form">
            <div class="lq-wadah lq-form-wadah">
                <div class="lq-form-kartu">
                    <div class="lq-form-kartu__garis" aria-hidden="true"></div>
                    <div class="lq-form-kartu__isi">
                        <div class="lq-form-kepala">
                            <span class="lq-kotak-ikon"><?= ikon('message-square-text', 'lq-ikon--32') ?></span>
                            <h2 id="judul-form">Daftar Sekarang</h2>
                            <p>Isi data Anda dan tim kami akan segera menghubungi via WhatsApp.</p>
                        </div>

                        <?php if (isset($error)): ?>
                            <div class="lq-galat" role="alert">
                                <?= ikon('alert-circle') ?>
                                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                        <?php endif; ?>

                        <form method="POST" class="lq-form lq-tumpuk" id="formDaftar">
                            <div>
                                <label for="nama" class="lq-label">Nama Lengkap / Nama Toko <span class="lq-wajib" aria-hidden="true">*</span></label>
                                <div class="lq-medan">
                                    <span class="lq-medan__awal"><?= ikon('user') ?></span>
                                    <input type="text" name="nama" id="nama" required autocomplete="name" class="lq-isian" value="<?= nilai_lama('nama') ?>" placeholder="Budi Santoso">
                                </div>
                            </div>
                            <div>
                                <label for="email" class="lq-label">Alamat Email <span class="lq-wajib" aria-hidden="true">*</span></label>
                                <div class="lq-medan">
                                    <span class="lq-medan__awal"><?= ikon('mail') ?></span>
                                    <input type="email" name="email" id="email" required autocomplete="email" class="lq-isian" value="<?= nilai_lama('email') ?>" placeholder="budi@example.com">
                                </div>
                            </div>
                            <div>
                                <label for="whatsapp" class="lq-label">Nomor WhatsApp Aktif <span class="lq-wajib" aria-hidden="true">*</span></label>
                                <div class="lq-medan">
                                    <span class="lq-medan__awal"><?= ikon('phone') ?></span>
                                    <input type="tel" name="whatsapp" id="whatsapp" required inputmode="numeric" autocomplete="tel" class="lq-isian" value="<?= nilai_lama('whatsapp') ?>" placeholder="081234567890" aria-describedby="bantuan-wa">
                                </div>
                                <p class="lq-bantuan" id="bantuan-wa"><?= ikon('info', 'lq-ikon--16') ?> Pastikan nomor aktif agar kami dapat mengirimkan detail aktivasi.</p>
                            </div>
                            <button type="submit" id="submitFormBtn" class="lq-tombol lq-tombol--hijau lq-tombol--besar lq-tombol--penuh">
                                <?= ikon('send') ?> <span>Daftar &amp; Lanjut ke WhatsApp</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="lq-kaki">
        <div class="lq-wadah">
            <span class="lq-merek"><img src="favicon.svg" alt="" width="32" height="32"> QRIS Statis2Dinamis</span>
            <div>
                <p>&copy; <?= date('Y') ?> QRIS Statis2Dinamis. All rights reserved.</p>
                <p>Solusi pembayaran QRIS modern untuk UMKM Indonesia.</p>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6280000000000?text=Halo,%20saya%20ingin%20tanya%20tentang%20QRIS%20Statis2Dinamis" target="_blank" rel="noopener noreferrer" class="lq-wa" aria-label="Tanya CS Kami lewat WhatsApp">
        <?= ikon('message-circle', 'lq-ikon--24') ?>
        <span class="lq-wa__tip" aria-hidden="true">Tanya CS Kami</span>
    </a>

    <script>window.LQ_IKON = <?= json_encode(array_map(function ($n) { return ikon($n); }, ['check' => 'check', 'refresh-cw' => 'refresh-cw', 'scan' => 'scan', 'check-circle' => 'check-circle', 'qr-code' => 'qr-code', 'menu' => 'menu', 'x' => 'x', 'send' => 'send']), JSON_UNESCAPED_SLASHES) ?>;</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="assets/app.js"></script>
</body>
</html>
