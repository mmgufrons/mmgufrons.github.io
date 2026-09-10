<?php

$page_title = "Campaign B2B Nempel App Play Store | SIMASRIM Operations";

$footer_desc = "Dokumen Internal - Divisi Campaign & Business Development.";

$base_path = '../';

include __DIR__ . '/../includes/header.php';

$kategori_target = [
    ['nama' => 'Cek Ongkir & Tracking Paket', 'alasan' => 'Pengguna sudah dalam mindset kirim barang — tinggal disambungkan ke eksekusi (pesan kurir), bukan cuma info ongkir.', 'keyword' => 'cek ongkir, cek resi, lacak paket, kalkulator ongkir', 'red_flag' => 'App resmi milik salah satu ekspedisi besar (JNE/JNT/dst) — mereka kompetitor, bukan target.'],
    ['nama' => 'POS/Kasir & Pembukuan UMKM', 'alasan' => 'Penggunanya pemilik toko/UMKM yang rutin kirim barang ke pembeli — potensi resi instan langsung dari app kasir.', 'keyword' => 'kasir toko, aplikasi kasir umkm, pembukuan usaha, buku kas', 'red_flag' => 'App sudah terintegrasi resmi dengan agregator ongkir besar (Komerce, Biteship, dll) — cek dulu apakah masih terbuka nambah mitra kurir baru.'],
    ['nama' => 'Marketplace/E-commerce Lokal', 'alasan' => 'Transaksi jual-beli lokal butuh pengiriman — peluang jadi opsi kurir bawaan platform.', 'keyword' => 'marketplace [nama kota], jual beli online lokal, lapak online daerah', 'red_flag' => 'Traffic/install sangat rendah (<1.000) — kemungkinan sudah tidak aktif dikembangkan, prioritas rendah.'],
    ['nama' => 'PPOB & Agen Pulsa/Token', 'alasan' => 'Basis pengguna agen yang sudah biasa jual jasa titipan — cocok ditawari nambah layanan kirim paket.', 'keyword' => 'ppob, agen pulsa token listrik, aplikasi agen pembayaran', 'red_flag' => 'App PPOB white-label besar yang sudah official partner banyak provider — biasanya sulit ditembus cold outreach, butuh jalur korporat.'],
    ['nama' => 'App Komunitas/Info Daerah', 'alasan' => 'Basis warga lokal terkonsentrasi — cocok untuk fitur tambahan kirim barang antar warga/UMKM setempat.', 'keyword' => 'info [nama kota], komunitas UMKM [daerah], warga [kota] app', 'red_flag' => 'App instansi pemerintah (bukan swasta) — proses kerja sama beda jalur, bukan skema B2B komersial biasa.'],
];

$respons_scenarios = [
    [
        'no' => 1, 'badge' => 'success', 'judul' => 'Tertarik & Langsung Minta Detail Skema',
        'kapan' => 'Developer merespons positif dan langsung nanya "gimana cara kerjanya" atau "kirim detail dong".',
        'wa_id' => 'resp1',
        'wa' => "Siap Kak! Jadi konsepnya simpel:\n\n1. Kita sematkan menu/tombol \"Kirim Paket\" di aplikasi {{Nama App}} — bisa via Nempel Menu/SSO (integrasi cepat, hitungan hari) atau API kalau mau native experience.\n2. Pengguna {{Nama App}} bisa langsung cek ongkir & pesan kurir (multi-kurir: SAPX, JNE, J&T, Lion Parcel, dll) dari dalam aplikasi.\n3. Tiap transaksi sukses, tim {{Nama App}} dapat sharing profit — komisinya kita bahas detail pas ngobrol, karena beda-beda tergantung jenis layanan.\n\nBoleh saya kirim ringkasan 1 halaman (proposal) biar Kakak lebih gampang bahas ini ke tim, atau langsung enakan kita ngobrol via call dulu?",
    ],
    [
        'no' => 2, 'badge' => 'primary', 'judul' => 'Tertarik, Minta Proposal/Dokumen Dulu',
        'kapan' => 'Developer tidak mau ngobrol langsung, minta bahan tertulis dulu untuk dibawa ke tim/atasan.',
        'wa_id' => 'resp2',
        'wa' => "Baik Kak, siap saya kirimkan. 📄\n\nSaya lampirkan Proposal Ringkas 1 Halaman ya — isinya gambaran kerja sama, pilihan integrasi (SSO vs API), dan skema sharing profit.\n\n{{Link Proposal}}\n\nKalau nanti sudah didiskusikan internal dan ada pertanyaan atau mau lanjut ngobrol, kabarin saya kapan saja ya Kak — saya standby.",
    ],
    [
        'no' => 3, 'badge' => 'primary', 'judul' => 'Minta Jadwal Call/Meeting Langsung',
        'kapan' => 'Developer to-the-point, mau langsung diskusi tanpa banyak basa-basi chat.',
        'wa_id' => 'resp3',
        'wa' => "Mantap Kak, lebih enak emang langsung diskusi. 🙌\n\nKira-kira Kakak available kapan minggu ini? Saya fleksibel — bisa Zoom/Google Meet atau kalau lokasi memungkinkan bisa ketemu langsung juga.\n\nBiar diskusinya efektif, boleh info juga sekalian siapa aja yang perlu ikut dari tim {{Nama App}} (developer/product/founder)?",
    ],
    [
        'no' => 4, 'badge' => 'info', 'judul' => 'Minta Dokumentasi Teknis/API Duluan',
        'kapan' => 'Respons dari tim IT/developer app kecil yang mikirnya teknis duluan sebelum bisnis.',
        'wa_id' => 'resp4',
        'wa' => "Noted Kak! Kalau dari sisi teknis, kita punya 2 opsi:\n\nOption A (API): Endpoint untuk Cek Ongkir, Create Order/Cetak Resi, Tracking, dan Webhook Status — bisa saya kirimkan dokumentasi ringkas & akses Sandbox buat tim IT Kakak coba-coba dulu.\n\nOption B (SSO/Webview): Kalau mau yang jauh lebih cepat tanpa perlu ngoding API sama sekali — cukup sematkan link/webview, jauh lebih ringan buat tim IT.\n\nMau saya kirim yang mana dulu, Kak — dokumentasi API-nya atau contoh implementasi SSO-nya?",
    ],
    [
        'no' => 5, 'badge' => 'warning', 'judul' => 'Nanya Harga/Komisi Duluan Sebelum Mau Lanjut',
        'kapan' => 'Developer defensif, tidak mau buang waktu ngobrol kalau angkanya kecil — perlu dijawab tanpa komit angka pasti dulu.',
        'wa_id' => 'resp5',
        'wa' => "Pertanyaan bagus Kak, wajar mau tau dulu gambaran angkanya. 😄\n\nSkema komisi kita hitung per transaksi sukses, dan besarannya bervariasi tergantung jenis layanan (pengiriman vs PPOB) serta volume transaksi dari {{Nama App}} — jadi bukan angka flat yang sama untuk semua partner.\n\nSupaya saya bisa kasih gambaran yang paling relevan buat {{Nama App}}, boleh saya tau dulu kira-kira berapa banyak pengguna aktif {{Nama App}} per bulan? Dari situ saya bisa hitungkan simulasi komisinya biar lebih konkret pas kita ngobrol.",
    ],
    [
        'no' => 6, 'badge' => 'warning', 'judul' => 'Skeptis / Nanya Legalitas & Kredibilitas',
        'kapan' => 'Developer belum pernah dengar SIMASRIM, wajar curiga — butuh social proof, bukan cuma klaim.',
        'wa_id' => 'resp6',
        'wa' => "Wajar banget Kak nanya itu, saya juga bakal hati-hati kalau di posisi Kakak. 👍\n\nSIMASRIM ini PT Solusi Mitra Aplikasi, sudah berjalan dan terintegrasi multi-kurir (SAPX, JNE, J&T, Lion Parcel, SPX, dll). Salah satu contoh partner yang sudah jalan dengan skema serupa (Nempel Menu/SSO) itu SAPX untuk layanan PPOB kami — jadi konsep integrasinya bukan wacana, sudah kebukti jalan.\n\nKalau Kakak mau, saya bisa kirim juga info perusahaan (NIB/legalitas) dan kontak referensi biar makin yakin. Ada yang mau ditanyakan lagi Kak soal ini?",
    ],
    [
        'no' => 7, 'badge' => 'secondary', 'judul' => 'Sudah Pakai Partner Ekspedisi/Integrasi Lain',
        'kapan' => 'App sudah punya integrasi kurir/ongkir — jangan berhenti, posisikan sebagai tambahan bukan pengganti.',
        'wa_id' => 'resp7',
        'wa' => "Oh oke Kak, noted ya. 👌\n\nGak masalah kalau {{Nama App}} sudah ada partner existing — SIMASRIM bisa posisinya jadi opsi tambahan (bukan gantikan yang sudah jalan), terutama buat kurir-kurir yang mungkin belum ter-cover sama partner Kakak saat ini (SAPX, Lion Parcel, dll), plus ada fitur PPOB juga kalau relevan buat pengguna {{Nama App}}.\n\nJadi pengguna Kakak makin banyak pilihan, dan {{Nama App}} dapat tambahan revenue stream dari opsi baru ini. Kalau tertarik eksplor, boleh saya kirim gambaran singkatnya Kak?",
    ],
    [
        'no' => 8, 'badge' => 'secondary', 'judul' => 'Menolak Halus ("Belum Prioritas Saat Ini")',
        'kapan' => 'Developer sopan tapi jelas bukan sekarang waktunya — soft close, jangan ngotot.',
        'wa_id' => 'resp8',
        'wa' => "Baik Kak, dimengerti banget — pasti timing dan prioritas masing-masing tim beda-beda. 🙏\n\nGapapa kalau belum sekarang, saya simpan dulu kontaknya ya. Kalau boleh, nanti saya kabari lagi dalam sebulan-dua bulan siapa tau timing-nya lebih pas. Kalau sebelum itu {{Nama App}} tertarik duluan, boleh banget langsung chat saya kapan saja Kak.\n\nTerima kasih waktunya, semoga {{Nama App}} makin berkembang! 🙌",
    ],
    [
        'no' => 9, 'badge' => 'danger', 'judul' => 'Menolak Tegas / Minta Stop Dihubungi',
        'kapan' => 'Respons keras/tidak nyaman — tutup dengan baik-baik, jangan dibalas lagi, catat status Cold/Dead.',
        'wa_id' => 'resp9',
        'wa' => "Baik Kak, mohon maaf mengganggu. Saya hormati keputusannya dan tidak akan menghubungi lagi.\n\nTerima kasih atas waktunya, sukses terus untuk {{Nama App}}! 🙏",
    ],
    [
        'no' => 10, 'badge' => 'dark', 'judul' => 'Follow-Up Hari 3 (Read/Belum Balas)',
        'kapan' => 'Chat sudah dibaca (centang biru) tapi belum ada balasan sampai hari ke-3 — jangan kirim pesan sama persis, kasih info tambahan.',
        'wa_id' => 'resp10',
        'wa' => "Halo Kak, izin follow-up ya (maaf kalau kepanjangan chat sebelumnya 😅).\n\nSekadar tambahan info: integrasi paling ringan (Nempel Menu/SSO) itu biasanya bisa live dalam hitungan hari, jadi kalau {{Nama App}} tertarik coba dulu tanpa komitmen besar, bisa banget mulai dari situ.\n\nKalau ada pertanyaan atau mau saya jelaskan lebih lanjut, saya standby ya Kak 🙌",
    ],
    [
        'no' => 11, 'badge' => 'dark', 'judul' => 'Follow-Up Hari 7 (Masih Belum Balas)',
        'kapan' => 'Sudah 7 hari tanpa respons — ini follow-up terakhir sebelum pindah status Cold, nada lebih santai/soft-close.',
        'wa_id' => 'resp11',
        'wa' => "Halo Kak, saya follow-up terakhir ya biar gak ganggu terus 😄\n\nKalau memang belum relevan buat {{Nama App}} saat ini gapapa banget Kak, saya paham. Kalau nanti suatu saat tertarik atau ada pertanyaan, tinggal japri saya aja kapan pun — saya senang bantu diskusi.\n\nTerima kasih banyak waktunya Kak! 🙏",
    ],
];
?>

<style>
    .step-card { background: #ffffff; border: 1px solid rgba(0,0,0,0.08); border-radius: 16px; padding: 1.8rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .section-title-b2b { font-size: 1.25rem; font-weight: 800; color: var(--primary); margin-bottom: 1.5rem; padding-bottom: 12px; border-bottom: 2px solid #f1f3f5; display: flex; align-items: center; gap: 10px; }

    .table-b2b { margin-bottom: 0; width: 100%; border-collapse: collapse; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
    .table-b2b th { background: var(--primary); color: white; border: none; padding: 15px; font-weight: 700; text-align: left; }
    .table-b2b td { padding: 15px; vertical-align: top; border-bottom: 1px solid #eee; font-size: 0.9rem; }
    .table-b2b tr:hover td { background: #f8f9fa; }

    .chat-bubble { background: #f8f9fa; border-radius: 0 12px 12px 12px; padding: 1.2rem; border: 1px solid #e9ecef; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.6; font-size: 0.95rem; margin-bottom: 1rem; white-space: pre-wrap; }
    .email-container { background: #fff; border: 1px solid #e9ecef; border-radius: 8px; overflow: hidden; margin-top: 15px; }
    .email-header { background: #f8f9fa; padding: 12px 15px; border-bottom: 1px solid #e9ecef; font-family: Arial, sans-serif; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; }
    .email-body { padding: 20px; font-family: 'Segoe UI', Arial, sans-serif; font-size: 0.95rem; line-height: 1.6; color: #333; white-space: pre-wrap; background: #fffcfc; }

    .raw-text { display: none !important; }
    .btn-copy { background: white; border: 1px solid #ced4da; color: #495057; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: 0.2s; white-space: nowrap; }
    .btn-copy:hover { background: #e9ecef; color: #212529; }

    .variable-badge { background: #e9ecef; border: 1px solid #ced4da; padding: 2px 6px; border-radius: 4px; font-family: monospace; font-size: 0.85rem; color: #d63384; font-weight: bold; }
    .section-divider { display: flex; align-items: center; text-align: center; margin: 3rem 0 2rem; }
    .section-divider::before, .section-divider::after { content: ''; flex: 1; border-bottom: 2px dashed #ced4da; }
    .section-divider span { padding: 0 15px; font-size: 1.15rem; font-weight: 800; color: var(--primary, #1f0d3d); text-transform: uppercase; letter-spacing: 0.5px; }

    .scenario-card { border: 1px solid #eee; border-radius: 12px; padding: 1.2rem; margin-bottom: 1.2rem; }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--primary);"></div>
    <div class="container position-relative z-1">
        <span class="badge bg-success rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm border border-success"><i class="fab fa-google-play me-2"></i>B2B Integrasi Aplikasi</span>
        <h2 class="display-5 fw-bold mb-2 text-white">Nempel SIMASRIM ke Aplikasi Play Store Lain</h2>
        <p class="text-white-50 mb-0">Cari aplikasi (cek ongkir, POS/kasir UMKM, marketplace, PPOB) untuk ditawari integrasi Resi Instan/SSO dengan skema sharing profit.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="step-card" style="border-top: 5px solid var(--primary);">
            <div class="section-title-b2b"><i class="fas fa-bullseye"></i> BAGIAN 1: Kriteria & Kategori Target</div>
            <p class="text-muted small mb-4">Jangan cari app acak — fokus ke kategori yang penggunanya sudah punya kebutuhan kirim barang/bayar tagihan.</p>
            <div class="table-responsive">
                <table class="table-b2b">
                    <thead>
                        <tr><th width="20%">Kategori</th><th width="30%">Kenapa Relevan</th><th width="25%">Kata Kunci di Play Store</th><th width="25%">Red Flag (Hindari)</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kategori_target as $k): ?>
                        <tr>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($k['nama']) ?></td>
                            <td class="text-muted"><?= htmlspecialchars($k['alasan']) ?></td>
                            <td class="text-muted fst-italic"><?= htmlspecialchars($k['keyword']) ?></td>
                            <td class="text-danger small"><?= htmlspecialchars($k['red_flag']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #0dcaf0; border-top: none;">
            <div class="section-title-b2b" style="color:#0dcaf0;"><i class="fas fa-search"></i> BAGIAN 2: SOP Scouting & Ambil Kontak Developer</div>
            <ol class="mb-0">
                <li class="mb-2">Buka Play Store, cari pakai kata kunci sesuai kategori (Bagian 1).</li>
                <li class="mb-2">Buka listing aplikasi → scroll ke bagian <strong>"Tentang pengembang/developer"</strong> — Play Store selalu menyediakan info ini (nama developer, email, kadang website).</li>
                <li class="mb-2">Kalau email tidak tercantum langsung, cek link <strong>Website</strong> atau <strong>Kebijakan Privasi</strong> yang tercantum — biasanya ada halaman kontak/support di situ.</li>
                <li class="mb-2">Catat: Nama App, Nama Developer/PT, Kanal kontak (WA kalau ada, kalau tidak email), jumlah install & rating.</li>
                <li class="mb-0">Prioritaskan app dengan install &amp; rating lebih tinggi (sinyal traksi/masih aktif dikembangkan) — jangan buang waktu ke app yang sudah tidak di-update.</li>
            </ol>
        </div>

        <div class="step-card" style="border-left-color: #25D366; border-top: none;">
            <div class="section-title-b2b text-success"><i class="fab fa-whatsapp"></i> BAGIAN 3: Amunisi WA Outreach — Hari 1</div>
            <div class="alert alert-success bg-opacity-10 border-success border-opacity-25 py-2 px-3 mb-4 small">
                <i class="fas fa-info-circle me-1"></i> Variabel dinamis ditulis dalam <span class="variable-badge">{{...}}</span>.
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-success fs-6">Pesan Pembuka</span>
                    <button class="btn-copy" onclick="copyText('wa_open', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <div class="chat-bubble" id="wa_open">Halo Kak, perkenalkan saya {{Nama Anda}} dari SIMASRIM (PT Solusi Mitra Aplikasi). 👋

Saya lihat {{Nama App}} punya basis pengguna yang bagus di Play Store. Mau nanya santai — apakah tim {{Nama App}} terbuka untuk nambah fitur pengiriman paket & revenue stream baru di dalam aplikasi, tanpa perlu bangun sistem kurir dari nol?

Boleh saya jelaskan singkat konsepnya di sini Kak?</div>
                <pre id="wa_open-raw" class="raw-text">Halo Kak, perkenalkan saya {{Nama Anda}} dari SIMASRIM (PT Solusi Mitra Aplikasi). 👋

Saya lihat {{Nama App}} punya basis pengguna yang bagus di Play Store. Mau nanya santai — apakah tim {{Nama App}} terbuka untuk nambah fitur pengiriman paket & revenue stream baru di dalam aplikasi, tanpa perlu bangun sistem kurir dari nol?

Boleh saya jelaskan singkat konsepnya di sini Kak?</pre>
            </div>

            <p class="fw-bold text-dark mb-3 border-bottom pb-2">Cabang Respons Hari 1:</p>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-success">✅ Jika "Ya/Boleh"</span>
                    <button class="btn-copy" onclick="copyText('wa_branch1', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <div class="chat-bubble" id="wa_branch1">Siap Kak! Jadi konsepnya simpel: kita sematkan menu "Kirim Paket" di {{Nama App}} — pengguna bisa cek ongkir & pesan kurir multi-ekspedisi langsung dari dalam aplikasi. Integrasinya bisa 2 cara: cukup Nempel Menu/SSO (cepat, mirip skema yang sudah jalan di partner kami saat ini) atau via API kalau mau native experience.

Tiap transaksi sukses, tim {{Nama App}} dapat sharing profit. Boleh saya kirim ringkasan singkatnya Kak?</div>
                <pre id="wa_branch1-raw" class="raw-text">Siap Kak! Jadi konsepnya simpel: kita sematkan menu "Kirim Paket" di {{Nama App}} — pengguna bisa cek ongkir & pesan kurir multi-ekspedisi langsung dari dalam aplikasi. Integrasinya bisa 2 cara: cukup Nempel Menu/SSO (cepat, mirip skema yang sudah jalan di partner kami saat ini) atau via API kalau mau native experience.

Tiap transaksi sukses, tim {{Nama App}} dapat sharing profit. Boleh saya kirim ringkasan singkatnya Kak?</pre>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-primary">💬 Jika Nanya "Kerja Sama Seperti Apa?"</span>
                    <button class="btn-copy" onclick="copyText('wa_branch2', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <div class="chat-bubble" id="wa_branch2">Jadi gini Kak, pengguna {{Nama App}} nanti bisa langsung cek ongkir, pesan kurir (SAPX, JNE, J&T, Lion Parcel, dll), atau bayar tagihan PPOB dari dalam aplikasi Kakak — tanpa Kakak perlu urus operasional kurir sama sekali.

Setiap transaksi sukses, {{Nama App}} dapat bagian sharing profit. Integrasinya bisa super ringan (Nempel Menu/SSO) atau via API kalau mau lebih terintegrasi.

Ada waktu minggu ini buat ngobrol singkat via call, Kak?</div>
                <pre id="wa_branch2-raw" class="raw-text">Jadi gini Kak, pengguna {{Nama App}} nanti bisa langsung cek ongkir, pesan kurir (SAPX, JNE, J&T, Lion Parcel, dll), atau bayar tagihan PPOB dari dalam aplikasi Kakak — tanpa Kakak perlu urus operasional kurir sama sekali.

Setiap transaksi sukses, {{Nama App}} dapat bagian sharing profit. Integrasinya bisa super ringan (Nempel Menu/SSO) atau via API kalau mau lebih terintegrasi.

Ada waktu minggu ini buat ngobrol singkat via call, Kak?</pre>
            </div>

            <div class="mb-0">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-secondary">🤖 Jika Dibalas CS Generic/Auto-Reply</span>
                    <button class="btn-copy" onclick="copyText('wa_branch3', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <p class="small text-muted fst-italic mb-2">Khas app besar — chat masuk ke CS umum, bukan tim BD/developer. Minta diarahkan, jangan jelaskan detail ke CS.</p>
                <div class="chat-bubble" id="wa_branch3">Halo Kak, terima kasih responnya. Ini terkait penawaran kerja sama B2B (partnership/integrasi API) untuk tim Business Development / Product {{Nama App}}, bukan pertanyaan pengguna biasa.

Boleh dibantu arahkan ke kontak/email tim yang menangani kerja sama partner ya Kak? Terima kasih banyak 🙏</div>
                <pre id="wa_branch3-raw" class="raw-text">Halo Kak, terima kasih responnya. Ini terkait penawaran kerja sama B2B (partnership/integrasi API) untuk tim Business Development / Product {{Nama App}}, bukan pertanyaan pengguna biasa.

Boleh dibantu arahkan ke kontak/email tim yang menangani kerja sama partner ya Kak? Terima kasih banyak 🙏</pre>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #dc3545; border-top: none;">
            <div class="section-title-b2b text-danger"><i class="fas fa-envelope"></i> BAGIAN 4: Amunisi Email Outreach (Formal)</div>
            <p class="text-muted small mb-4">Dikirim ke email developer resmi. 2 varian subjek tergantung tipe target.</p>

            <div class="mb-4">
                <h6 class="fw-bold text-dark"><span class="badge bg-danger me-2">Varian A</span>Target App Kecil/Indie — Angle "Tanpa Modal Bangun Sistem"</h6>
                <div class="email-container shadow-sm">
                    <div class="email-header">
                        <div><strong class="text-danger">Subjek:</strong> Tambah Fitur Pengiriman & Revenue Baru di <span class="variable-badge">{{Nama App}}</span> Tanpa Modal Bangun Sistem</div>
                        <button class="btn-copy text-nowrap" onclick="copyText('email_a', this)"><i class="far fa-copy"></i> Salin Email</button>
                    </div>
                    <div class="email-body" id="email_a">Yth. Tim Developer {{Nama App}},

Kami dari SIMASRIM (PT Solusi Mitra Aplikasi) memperhatikan {{Nama App}} punya pengguna aktif yang terus tumbuh di Play Store.

Kami menawarkan kemitraan integrasi pengiriman paket multi-kurir (SAPX, JNE, J&T, Lion Parcel, SPX, dll) dan PPOB langsung di dalam aplikasi Anda — dengan skema Sharing Profit dari setiap transaksi sukses.

Integrasinya fleksibel:
1. SSO/Nempel Menu — tanpa perlu coding API rumit, cukup sematkan menu/webview, integrasi bisa selesai hitungan hari.
2. API — untuk pengalaman native penuh di dalam aplikasi Anda.

Operasional pengiriman (pickup, CS, tracking) ditangani penuh oleh tim SIMASRIM — tim Anda tidak perlu menambah beban kerja.

Apakah berkenan kami jadwalkan diskusi singkat via WhatsApp/Zoom pekan ini?

Hormat kami,
{{Nama Anda}}
Business Development — SIMASRIM
PT Solusi Mitra Aplikasi
✉️ marketing.demo@contoh-perusahaan.demo | 📱 {{Nomor HP Anda}}</div>
                </div>
            </div>

            <div class="mb-0">
                <h6 class="fw-bold text-dark"><span class="badge bg-dark me-2">Varian B</span>Target App Korporat/Tim Besar — Angle "Revenue Share Terukur & Dashboard Transparan"</h6>
                <div class="email-container shadow-sm">
                    <div class="email-header">
                        <div><strong class="text-danger">Subjek:</strong> Penawaran Kemitraan Integrasi API Multi-Kurir & PPOB — <span class="variable-badge">{{Nama App}}</span> x SIMASRIM</div>
                        <button class="btn-copy text-nowrap" onclick="copyText('email_b', this)"><i class="far fa-copy"></i> Salin Email</button>
                    </div>
                    <div class="email-body" id="email_b">Yth. Tim Partnership/Business Development {{Nama App}},

Kami dari PT Solusi Mitra Aplikasi (SIMASRIM), penyedia ekosistem layanan pengiriman multi-kurir dan PPOB, ingin mengajukan penawaran kemitraan integrasi untuk {{Nama App}}.

Skema kerja sama:
- Integrasi API RESTful (Cek Ongkir, Create Order, Tracking, Webhook Status) — dokumentasi & akses Sandbox tersedia untuk ditinjau tim teknis.
- Model Revenue Share transparan per transaksi, dengan Dashboard Partner untuk memantau performa transaksi & klaim bagi hasil secara real-time.
- Operasional lapangan (pickup, CS, penanganan komplain) ditangani penuh oleh tim SIMASRIM.

Kami terbuka untuk NDA lebih dulu apabila diperlukan sebelum berbagi detail teknis lebih lanjut.

Apakah dapat dijadwalkan sesi diskusi (call/meeting) dengan tim {{Nama App}} pekan ini?

Hormat kami,
{{Nama Anda}}
Business Development — SIMASRIM
PT Solusi Mitra Aplikasi
✉️ marketing.demo@contoh-perusahaan.demo | 📱 {{Nomor HP Anda}}</div>
                </div>
            </div>
        </div>

        <div class="section-divider"><span><i class="fas fa-route me-2"></i>BAGIAN 5: Playbook Respons Pasca-Outreach</span></div>

        <div class="step-card" style="border-left-color: #6f42c1; border-top: none;">
            <p class="text-muted small mb-4">11 skenario nyata yang bisa terjadi setelah outreach — tiap skenario punya naskah balasan sendiri, bukan variasi kata dari template yang sama.</p>
            <?php foreach ($respons_scenarios as $s): ?>
            <div class="scenario-card">
                <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap gap-2">
                    <div>
                        <span class="badge bg-<?= $s['badge'] ?> mb-1">Skenario <?= $s['no'] ?></span>
                        <h6 class="fw-bold text-dark mb-1"><?= htmlspecialchars($s['judul']) ?></h6>
                        <p class="text-muted small mb-0 fst-italic"><?= htmlspecialchars($s['kapan']) ?></p>
                    </div>
                    <button class="btn-copy" onclick="copyText('<?= $s['wa_id'] ?>', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <div class="chat-bubble" id="<?= $s['wa_id'] ?>"><?= nl2br(htmlspecialchars($s['wa'])) ?></div>
                <pre id="<?= $s['wa_id'] ?>-raw" class="raw-text"><?= htmlspecialchars($s['wa']) ?></pre>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="step-card" style="border-left-color: #ffc107; border-top: none;">
            <div class="section-title-b2b" style="color:#b8860b;"><i class="fas fa-clipboard-check"></i> BAGIAN 6: Amunisi Pendukung (Checklist)</div>
            <div class="table-responsive">
                <table class="table-b2b">
                    <thead><tr><th width="40%">Dokumen</th><th width="40%">Kegunaan</th><th width="20%">Link</th></tr></thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold text-dark">Proposal 1-Halaman B2B</td>
                            <td class="text-muted small">Ringkasan kerja sama, dikirim saat developer minta "info detail" (Skenario 2).</td>
                            <td><a href="#" class="btn btn-sm btn-secondary disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-link me-1"></i> Segera diisi</a></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-dark">Ringkasan Opsi SSO vs API</td>
                            <td class="text-muted small">Dikirim ke tim IT yang minta dokumentasi teknis (Skenario 4).</td>
                            <td><a href="#" class="btn btn-sm btn-secondary disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-link me-1"></i> Segera diisi</a></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-dark">Draf Skema Sharing Profit</td>
                            <td class="text-muted small">Dasar simulasi angka komisi saat diminta detail (Skenario 5).</td>
                            <td><a href="#" class="btn btn-sm btn-secondary disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-link me-1"></i> Segera diisi</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section-divider"><span><i class="fas fa-chart-area me-2"></i>BAGIAN 7: Input Lead ke Campaign Tracker</span></div>

        <div class="step-card" style="border-left-color: #0dcaf0; border-top: none;">
            <p class="text-muted small mb-4">Setiap aplikasi yang sudah dihubungi, catat sebagai lead di <a href="<?= $base_path ?>campaign/campaign-tracker/index.php">Campaign Tracker</a>.</p>
            <form id="app-lead-form" class="row g-3" onsubmit="return false;">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Nama Aplikasi</label>
                    <input type="text" class="form-control" id="lead-nama" placeholder="mis. Kasir Toko Pintar" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Kategori</label>
                    <select class="form-select" id="lead-kategori">
                        <?php foreach ($kategori_target as $k): ?>
                        <option value="<?= htmlspecialchars($k['nama']) ?>"><?= htmlspecialchars($k['nama']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Kanal</label>
                    <select class="form-select" id="lead-kanal">
                        <option value="wa">WhatsApp</option>
                        <option value="email">Email</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label small fw-bold">Kontak (No. WA / Email)</label>
                    <input type="text" class="form-control" id="lead-kontak" placeholder="628xxx atau nama@email.com" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">PIC / Nama Developer <span class="text-muted fw-normal">(opsional)</span></label>
                    <input type="text" class="form-control" id="lead-pic" placeholder="Nama developer/PT">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Catatan <span class="text-muted fw-normal">(opsional)</span></label>
                    <textarea class="form-control" id="lead-catatan" rows="2" placeholder="mis. install 10rb+, rating 4.5, sudah pakai kompetitor X"></textarea>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-primary" id="btn-save-lead"><i class="fas fa-cloud-upload-alt me-1"></i> Simpan sebagai Lead</button>
                    <span id="lead-save-status" class="ms-2 small"></span>
                </div>
            </form>
        </div>

    </div>
</section>

<script>
    const APP_LEAD_PROXY_URL = 'campaign-tracker/api/firebase_proxy.php';

    function copyText(id, btn) {
        let raw = document.getElementById(id + '-raw');
        let text = raw ? raw.textContent : (document.getElementById(id).textContent || document.getElementById(id).innerText);
        let temp = document.createElement("textarea");
        temp.value = text;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        document.body.removeChild(temp);

        let originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Disalin!';
        btn.classList.add('bg-success', 'text-white', 'border-success');
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('bg-success', 'text-white', 'border-success');
        }, 2000);
    }

    function appNormalizePhone(raw) {
        let digits = raw.replace(/\D/g, '');
        if (digits.startsWith('0')) digits = '62' + digits.slice(1);
        return digits || null;
    }

    function appSanitizeEmailKey(email) {
        return email.toLowerCase().replace(/[^a-z0-9]/g, '_');
    }

    document.getElementById('btn-save-lead').addEventListener('click', async () => {
        const btn = document.getElementById('btn-save-lead');
        const statusEl = document.getElementById('lead-save-status');
        const nama = document.getElementById('lead-nama').value.trim();
        const kategori = document.getElementById('lead-kategori').value;
        const kanal = document.getElementById('lead-kanal').value;
        const kontakRaw = document.getElementById('lead-kontak').value.trim();
        const pic = document.getElementById('lead-pic').value.trim();
        const catatan = document.getElementById('lead-catatan').value.trim();

        if (!nama || !kontakRaw) {
            statusEl.textContent = 'Isi Nama Aplikasi dan Kontak dulu.';
            statusEl.className = 'ms-2 small text-danger';
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';

        try {
            let _key, display;
            if (kanal === 'wa') {
                _key = appNormalizePhone(kontakRaw);
                if (!_key) throw new Error('Format nomor WA tidak valid');
                display = _key;
            } else {
                _key = appSanitizeEmailKey(kontakRaw);
                display = kontakRaw.toLowerCase();
            }

            const newLead = {
                _key,
                contact_display: display,
                brand: 'App Partner',
                area: 'Nasional',
                produk: kategori,
                nama_agen: nama,
                pic_garap: pic,
                keterangan: catatan,
                tipe_leads: 'New',
                created_at: new Date().toISOString().split('T')[0],
                updated_at: new Date().toISOString().split('T')[0]
            };

            const basePath = kanal === 'wa' ? 'master_leads/whatsapp' : 'master_leads/email';
            const res = await fetch(`${APP_LEAD_PROXY_URL}?path=${encodeURIComponent(basePath + '/' + _key)}`, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(newLead)
            });
            if (!res.ok) throw new Error('Gagal menyimpan ke Tracker (HTTP ' + res.status + ')');

            statusEl.textContent = 'Tersimpan ke Campaign Tracker!';
            statusEl.className = 'ms-2 small text-success';
            document.getElementById('app-lead-form').reset();
        } catch (err) {
            statusEl.textContent = err.message;
            statusEl.className = 'ms-2 small text-danger';
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-cloud-upload-alt me-1"></i> Simpan sebagai Lead';
        }
    });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
