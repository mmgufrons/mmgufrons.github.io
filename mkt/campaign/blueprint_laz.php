<?php

$page_title = "Blueprint Campaign LAZ Nasional | SIMASRIM Operations";

$footer_desc = "Dokumen Internal Rahasia - Divisi Campaign & Business Development.";

$base_path = '../';

include __DIR__ . '/../includes/header.php';

// Data target 3 Gelombang — dipakai ulang untuk tabel peta target (Bagian 1)
// dan tabel import ke Campaign Tracker (Bagian 5), biar tidak dobel-tulis.
// PORTOFOLIO DEMO: seluruh nama lembaga, PIC, nomor WA & email prospek riil DIHAPUS TOTAL,
// diganti data fiktif — daftar ini contoh, bukan daftar prospek B2B sungguhan.
$laz_targets = [
    // Gelombang 1 — Bogor & Jabodetabek (Quick Win)
    ['wave' => 1, 'nama' => 'Yayasan Amal Contoh A (Bogor)', 'pic' => 'Demo', 'kanal' => 'wa', 'kontak' => '6280000000000', 'angle' => 'Sudah ada kontak langsung PIC Program — pintu masuk paling matang.', 'surat_link' => '#'],
    ['wave' => 1, 'nama' => 'Yayasan Amal Contoh B (Bogor)', 'pic' => '', 'kanal' => 'wa', 'kontak' => '', 'angle' => 'Yayasan Provinsi berpusat di Bogor, fokus UMKM binaan lokal.', 'surat_link' => '#'],
    ['wave' => 1, 'nama' => 'Yayasan Amal Contoh C (Cibinong/Bogor)', 'pic' => '', 'kanal' => 'wa', 'kontak' => '', 'angle' => 'Aktif program kemandirian ekonomi & UMKM Bogor.', 'surat_link' => '#'],
    ['wave' => 1, 'nama' => 'Yayasan Amal Contoh D (Bogor)', 'pic' => '', 'kanal' => 'wa', 'kontak' => '6280000000000', 'angle' => 'Basis jamaah & UMKM binaan cukup kuat di Bogor.', 'surat_link' => '#'],
    ['wave' => 1, 'nama' => 'Yayasan Amal Contoh E (Depok/Jabar)', 'pic' => '', 'kanal' => 'wa', 'kontak' => '6280000000000', 'angle' => 'Fokus melahirkan Wirausaha Baru (WUB) dari kalangan dhuafa.', 'surat_link' => '#'],
    ['wave' => 1, 'nama' => 'Yayasan Amal Contoh F (Jawa Barat)', 'pic' => '', 'kanal' => 'wa', 'kontak' => '6280000000000', 'angle' => 'Program Inovasi Pemberdayaan Ekonomi berbasis Jawa Barat/Bandung.', 'surat_link' => '#'],
    // Gelombang 2 — Nasional berbasis Ormas/Yayasan (Email Resmi)
    ['wave' => 2, 'nama' => 'Yayasan Peduli Contoh G', 'pic' => '', 'kanal' => 'email', 'kontak' => 'demo@contoh-yayasan-g.id', 'angle' => 'Kemasan murah-mudah-bisa dijalankan Ibu Rumah Tangga/Pemuda dari rumah.', 'surat_link' => '#'],
    ['wave' => 2, 'nama' => 'Yayasan Rumah Contoh H', 'pic' => '', 'kanal' => 'email', 'kontak' => 'demo@contoh-yayasan-h.id', 'angle' => 'Kemasan murah-mudah-bisa dijalankan Ibu Rumah Tangga/Pemuda dari rumah.', 'surat_link' => '#'],
    ['wave' => 2, 'nama' => 'Inisiatif Contoh I', 'pic' => '', 'kanal' => 'email', 'kontak' => 'demo@contoh-yayasan-i.id', 'angle' => 'Program unggulan Lapak Berdaya & Ekonomi Mandiri.', 'surat_link' => '#'],
    ['wave' => 2, 'nama' => 'Yayasan Contoh J', 'pic' => '', 'kanal' => 'email', 'kontak' => 'demo@contoh-yayasan-j.id', 'angle' => 'Program Keluarga Mandiri — Pemberdayaan Ekonomi Dhuafa.', 'surat_link' => '#'],
    ['wave' => 2, 'nama' => 'Yayasan Mandiri Contoh K', 'pic' => '', 'kanal' => 'email', 'kontak' => 'demo@contoh-yayasan-k.id', 'angle' => 'Kemandirian ekonomi keluarga yatim/dhuafa via unit usaha mandiri.', 'surat_link' => '#'],
    ['wave' => 2, 'nama' => 'Yayasan Contoh L', 'pic' => '', 'kanal' => 'email', 'kontak' => '', 'angle' => 'Kuat di program pengembangan ekonomi desa & dai pemberdaya.', 'surat_link' => '#'],
    ['wave' => 2, 'nama' => 'Yayasan & Panti Contoh M', 'pic' => '', 'kanal' => 'email', 'kontak' => 'demo@contoh-yayasan-m.id', 'angle' => 'Pembekalan & modal usaha bagi alumni panti/anak binaan usia produktif.', 'surat_link' => '#'],
    ['wave' => 2, 'nama' => 'Yayasan Contoh N', 'pic' => '', 'kanal' => 'email', 'kontak' => 'demo@contoh-yayasan-n.id', 'angle' => 'Jaringan komunitas, sering disuntik program ekonomi kemasyarakatan.', 'surat_link' => '#'],
    // Gelombang 3 — Korporasi & Perbankan
    ['wave' => 3, 'nama' => 'Yayasan Korporasi Contoh O', 'pic' => '', 'kanal' => 'email', 'kontak' => 'demo@contoh-korporasi-o.id', 'angle' => 'Tekankan Transparansi Dashboard Laporan & Kepastian Cashflow Penerima Manfaat.', 'surat_link' => '#'],
    ['wave' => 3, 'nama' => 'Yayasan Korporasi Contoh P', 'pic' => '', 'kanal' => 'email', 'kontak' => '', 'angle' => 'Tekankan Transparansi Dashboard Laporan & Kepastian Cashflow Penerima Manfaat.', 'surat_link' => '#'],
    ['wave' => 3, 'nama' => 'Yayasan Korporasi Contoh Q (Bank Demo)', 'pic' => '', 'kanal' => 'email', 'kontak' => 'demo@contoh-korporasi-q.id', 'angle' => 'Tekankan Transparansi Dashboard Laporan & Kepastian Cashflow Penerima Manfaat.', 'surat_link' => '#'],
    ['wave' => 3, 'nama' => 'Yayasan Korporasi Contoh R', 'pic' => '', 'kanal' => 'email', 'kontak' => 'demo@contoh-korporasi-r.id', 'angle' => 'Tekankan Transparansi Dashboard Laporan & Kepastian Cashflow Penerima Manfaat.', 'surat_link' => '#'],
];
$wave_labels = [1 => 'Gelombang 1 — Bogor & Jabar', 2 => 'Gelombang 2 — Nasional Ormas/Yayasan', 3 => 'Gelombang 3 — Korporasi & Perbankan'];
$wave_badge  = [1 => 'success', 2 => 'primary', 3 => 'danger'];
$executive_summary_link = '#';
?>

<style>
    .step-card { background: #ffffff; border: 1px solid rgba(0,0,0,0.08); border-radius: 16px; padding: 1.8rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .section-title-b2b { font-size: 1.25rem; font-weight: 800; color: var(--primary); margin-bottom: 1.5rem; padding-bottom: 12px; border-bottom: 2px solid #f1f3f5; display: flex; align-items: center; gap: 10px; }

    .table-b2b { margin-bottom: 0; width: 100%; border-collapse: collapse; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
    .table-b2b th { background: var(--primary); color: white; border: none; padding: 15px; font-weight: 700; text-align: left; }
    .table-b2b td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #eee; font-size: 0.95rem; }
    .table-b2b tr:hover td { background: #f8f9fa; }

    .chat-bubble { background: #f8f9fa; border-radius: 0 12px 12px 12px; padding: 1.2rem; border: 1px solid #e9ecef; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.6; font-size: 0.95rem; margin-bottom: 1rem; }
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

    .btn-import { font-size: 0.8rem; padding: 0.35rem 0.7rem; border-radius: 6px; font-weight: 600; }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--primary);"></div>
    <div class="container position-relative z-1">
        <span class="badge bg-danger rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm border border-danger"><i class="fas fa-user-secret me-2"></i>Rahasia Internal</span>
        <h2 class="display-5 fw-bold mb-2 text-white">Blueprint Campaign LAZ Nasional</h2>
        <p class="text-white-50 mb-0">3 Gelombang Eksekusi Paralel — Lembaga Amil Zakat (LAZ) Lokal, Nasional & Korporasi.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="step-card" style="border-top: 5px solid var(--primary);">
            <div class="section-title-b2b"><i class="fas fa-map-marked-alt"></i> BAGIAN 1: Peta 3 Gelombang & Target</div>
            <p class="text-muted small mb-4">Jemput bola secara paralel ke jaringan LAZ (Lembaga Amil Zakat) — anggarannya ada, programnya riil.</p>

            <?php foreach ($wave_labels as $wave_num => $wave_label): ?>
            <h6 class="fw-bold text-dark mb-3 mt-4 border-bottom pb-2">
                <span class="badge bg-<?= $wave_badge[$wave_num] ?> me-2"><?= $wave_label ?></span>
            </h6>
            <div class="table-responsive mb-4">
                <table class="table-b2b">
                    <thead>
                        <tr>
                            <th width="28%">Nama LAZ</th>
                            <th width="14%">Kanal Masuk</th>
                            <th width="20%">Kontak</th>
                            <th width="38%">Angle Komunikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($laz_targets as $t): if ($t['wave'] !== $wave_num) continue; ?>
                        <tr>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($t['nama']) ?></td>
                            <td><?= $t['kanal'] === 'wa' ? '<span class="badge bg-success"><i class="fab fa-whatsapp"></i> WA</span>' : '<span class="badge bg-secondary"><i class="fas fa-envelope"></i> Email</span>' ?></td>
                            <td class="text-muted small"><?= $t['kontak'] ? htmlspecialchars(($t['pic'] ? $t['pic'] . ' - ' : '') . $t['kontak']) : '<span class="fst-italic">belum ada</span>' ?></td>
                            <td class="text-muted small"><?= htmlspecialchars($t['angle']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endforeach; ?>

            <div class="alert alert-secondary d-flex align-items-start gap-3 mt-4 mb-0">
                <i class="fas fa-history mt-1"></i>
                <div>
                    <strong class="d-block text-dark">Riwayat: BAZNAS Kota Bogor</strong>
                    <span class="text-muted small">PIC Subhan Murtadho ("Kang Nurdat") — +62 817-6330-039. Sempat dijajaki sebelumnya, bisa di-follow-up ulang kapan saja. Tidak termasuk 3 gelombang aktif di atas.</span>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #25D366; border-top: none;">
            <div class="section-title-b2b text-success"><i class="fab fa-whatsapp"></i> BAGIAN 2: Amunisi WA — Gelombang 1 (Bogor & Jabar)</div>
            <div class="alert alert-success bg-opacity-10 border-success border-opacity-25 py-2 px-3 mb-4 small">
                <i class="fas fa-info-circle me-1"></i> Variabel dinamis ditulis dalam <span class="variable-badge">{{...}}</span>. Draf ini dipakai untuk PIC yang sudah ada kontak langsungnya (mis. PIC Contoh (Yayasan Amal Contoh A)), lalu disesuaikan namanya untuk target Gelombang 1 lain.
            </div>

            <div class="mb-2">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-success fs-6">Draf Silaturahmi ke PIC Program LAZ</span>
                    <button class="btn-copy" onclick="copyText('wa_laz1', this)"><i class="far fa-copy"></i> Salin</button>
                </div>
                <p class="small text-muted fst-italic mb-2">Angle: bahasa santai, ramah, mengajak diskusi/ngopi tipis-tipis (bukan proposal formal langsung).</p>
                <div class="chat-bubble">
                    Assalamu'alaikum <strong>{{Nama PIC}}</strong>, salam kenal. Saya <strong>{{Nama Anda}}</strong> dari tim Partnership SIMASRIM (PT Solusi Mitra Aplikasi) Bogor. 🙌✨<br><br>
                    Mendapatkan kontak <strong>{{Nama PIC}}</strong> dari rekomendasi tim internal kami, izin silaturahmi Mas/Mba.<br><br>
                    Saat ini dari SIMASRIM sedang mengembangkan modul kolaborasi "Closed-Loop Social Fintech" & "Kios Usaha Mandiri" untuk mendukung program Pemberdayaan Ekonomi / Zakat Produktif bagi Mustahik & UMKM binaan <strong>{{Nama LAZ}}</strong>. Sistem ini menggabungkan penanganan bantuan nontunai anti-fraud dengan ekosistem bisnis harian (PPOB, Pengiriman Paket Multi-Kurir, dll.) agar penerima manfaat punya penghasilan harian yang berkelanjutan.<br><br>
                    Mengingat kantor kami sama-sama berbasis di Bogor, sekiranya ada waktu senggang, apakah dibolehkan kami silaturahmi/ngopi santai ke kantor <strong>{{Nama LAZ}}</strong> untuk diskusi tipis-tipis terkait potensi kolaborasi ini Mas/Mba?<br><br>
                    Terima kasih banyak, semoga sehat selalu! 🙏
                </div>
                <pre id="wa_laz1" class="raw-text">Assalamu'alaikum {{Nama PIC}}, salam kenal. Saya {{Nama Anda}} dari tim Partnership SIMASRIM (PT Solusi Mitra Aplikasi) Bogor. 🙌✨

Mendapatkan kontak {{Nama PIC}} dari rekomendasi tim internal kami, izin silaturahmi Mas/Mba.

Saat ini dari SIMASRIM sedang mengembangkan modul kolaborasi "Closed-Loop Social Fintech" & "Kios Usaha Mandiri" untuk mendukung program Pemberdayaan Ekonomi / Zakat Produktif bagi Mustahik & UMKM binaan {{Nama LAZ}}. Sistem ini menggabungkan penanganan bantuan nontunai anti-fraud dengan ekosistem bisnis harian (PPOB, Pengiriman Paket Multi-Kurir, dll.) agar penerima manfaat punya penghasilan harian yang berkelanjutan.

Mengingat kantor kami sama-sama berbasis di Bogor, sekiranya ada waktu senggang, apakah dibolehkan kami silaturahmi/ngopi santai ke kantor {{Nama LAZ}} untuk diskusi tipis-tipis terkait potensi kolaborasi ini Mas/Mba?

Terima kasih banyak, semoga sehat selalu! 🙏</pre>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #dc3545; border-top: none;">
            <div class="section-title-b2b text-danger"><i class="fas fa-envelope"></i> BAGIAN 3: Amunisi Email Formal — Gelombang 2 & 3</div>
            <p class="text-muted small mb-4">Dikirim ke alamat resmi LAZ (Divisi Program & Pemberdayaan). Untuk target Korporasi/Perbankan (Gelombang 3), tekankan poin "Transparansi Dashboard & Kepastian Cashflow".</p>

            <div class="mb-2">
                <h6 class="fw-bold text-dark"><span class="badge bg-danger me-2">Draf Utama</span>Penawaran Kolaborasi Strategis</h6>
                <div class="email-container shadow-sm">
                    <div class="email-header">
                        <div><strong class="text-danger">Subjek:</strong> Penawaran Kolaborasi Strategis: Digitalisasi Ekosistem ZIS & Modul Zakat Produktif (SIMASRIM x <span class="variable-badge">{{Nama LAZ}}</span>)</div>
                        <button class="btn-copy text-nowrap" onclick="copyText('email_laz1', this)"><i class="far fa-copy"></i> Salin Email</button>
                    </div>
                    <div class="email-body" id="email_laz1">Kepada Yth.
Tim Divisi Program & Pemberdayaan
{{Nama LAZ}}
Di Tempat

Assalamu'alaikum Warahmatullahi Wabarakatuh,

Semoga Bapak/Ibu beserta seluruh jajaran tim {{Nama LAZ}} senantiasa berada dalam keadaan sehat wal'afiat dan selalu dalam pelindungan Allah SWT dalam menjalankan amanah kebaikan.

Perkenalkan, kami dari PT Solusi Mitra Aplikasi (SIMASRIM), perusahaan penyedia ekosistem teknologi bisnis dan agregator layanan digital yang berbasis di Bogor.

Melalui email ini, kami bermaksud mengajukan Penawaran Kolaborasi Strategis dalam penataan program Pemberdayaan Ekonomi & Zakat Produktif berbasis teknologi "Closed-Loop Social Fintech".

Sebagai gambaran ringkas, platform Dual-Engine SIMASRIM menghadirkan dua pilar utama penunjang KPI Lembaga:
1. Zakat & Social App Engine: Sistem penyaluran bantuan/zakat produktif nontunai yang terkunci (Closed-Loop) ber-ID Mustahik. Bantuan hanya dapat dibelanjakan di Merchant/Toko Binaan resmi {{Nama LAZ}}, menjamin 100% Tepat Sasaran, Anti-Fraud, dan didukung Real-Time Audit Trail.
2. SIMASRIM Business Engine: Modul Usaha Mandiri (Pengiriman Paket Multi-Kurir J&T, SiCepat, Lion Parcel, SPX, PPOB, Tiketing) yang dapat dijalankan langsung oleh Mustahik/Ibu Rumah Tangga dari rumah guna menciptakan pendapatan harian berkelanjutan (Daily Recurring Income) hingga mencetak Muzakki baru.

Bersama email ini, kami lampirkan dokumen Surat Penawaran Resmi dan Executive Summary Proposal untuk ditinjau lebih lanjut oleh Tim Divisi Program.

Besar harapan kami untuk dapat dijadwalkan sesi diskusi/audiensi singkat (baik secara Online via Zoom maupun Kunjungan Offline) guna memaparkan skema kerja sama ini secara lebih rinci.

Atas perhatian, kesempatan, dan kerja sama Bapak/Ibu, kami ucapkan terima kasih. Semoga Allah SWT memudahkan setiap ikhtiar kebaikan kita.

Wassalamu'alaikum Warahmatullahi Wabarakatuh.

Hormat kami,
PT SOLUSI MITRA APLIKASI (SIMASRIM)

{{Nama Anda}}
Contact Person / Fast Response
WhatsApp / HP : {{Nomor HP Anda}}
Website        : www.solusimitraaplikasi.com / www.simasrim.com
Kantor Pusat   : Jl. Raya Pemda Karadenan, Pangkalan 4 No. 36, Kab. Bogor</div>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #6f42c1; border-top: none;">
            <div class="section-title-b2b" style="color:#6f42c1;"><i class="fas fa-file-contract"></i> BAGIAN 3B: Amunisi Dokumen (Surat & Proposal)</div>
            <div class="alert alert-info bg-opacity-10 border-info border-opacity-25 py-2 px-3 mb-4 small">
                <i class="fas fa-info-circle me-1"></i> Akses Google Drive disarankan pakai email <span class="variable-badge">@solusimitraaplikasi.com</span> (mis. marketing / info).
            </div>

            <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">Executive Summary Proposal (Umum — 1 Dokumen untuk Semua Target)</h6>
            <div class="p-3 bg-light border rounded mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <strong class="text-dark d-block">Executive Summary Proposal — SIMASRIM x LAZ</strong>
                    <span class="small text-muted">Ringkasan 1 halaman: masalah yang dijawab, solusi Dual-Engine SIMASRIM (Zakat & Social App Engine + Business Engine), skema kerja sama, kontak. Dipakai sama untuk semua target LAZ (tidak personalisasi nama lembaga).</span>
                </div>
                <a href="<?= htmlspecialchars($executive_summary_link, ENT_QUOTES) ?>" target="_blank" rel="noopener" class="btn btn-sm btn-primary" id="link-executive-summary"><i class="fas fa-file-pdf me-1"></i> Buka Proposal</a>
            </div>

            <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">Surat Penawaran Resmi (Per Lembaga)</h6>
            <div class="table-responsive">
                <table class="table-b2b">
                    <thead>
                        <tr>
                            <th width="60%">Nama LAZ</th>
                            <th width="40%">Link Surat Penawaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($laz_targets as $i => $t): ?>
                        <tr>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($t['nama']) ?></td>
                            <td>
                                <?php if (!empty($t['surat_link'])): ?>
                                <a href="<?= htmlspecialchars($t['surat_link'], ENT_QUOTES) ?>" target="_blank" rel="noopener" class="btn btn-sm btn-primary" id="surat-link-<?= $i ?>"><i class="fas fa-file-pdf me-1"></i> Buka Surat</a>
                                <?php else: ?>
                                <a href="#" class="btn btn-sm btn-secondary disabled" tabindex="-1" aria-disabled="true" id="surat-link-<?= $i ?>"><i class="fas fa-link me-1"></i> Link Surat — segera diisi</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="step-card" style="border-left-color: #ffc107; border-top: none;">
            <div class="section-title-b2b" style="color:#b8860b;"><i class="fas fa-route"></i> BAGIAN 4: Tahapan Eksekusi</div>
            <ol class="mb-0">
                <li class="mb-2"><strong>Hari ini (Gelombang 1):</strong> Kirim draf WA (Bagian 2) ke PIC yang sudah ada kontaknya (mis. PIC Contoh (Yayasan Amal Contoh A)). Begitu respons, jadwalkan sowan/ngopi langsung.</li>
                <li class="mb-2"><strong>Hari ini (Gelombang 2):</strong> Kirim email penawaran (Bagian 3) ke alamat resmi DT Peduli & Rumah Zakat, lalu follow-up via admin WA masing-masing untuk diarahkan ke Divisi Program.</li>
                <li class="mb-2"><strong>Pekan ini (Gelombang 3):</strong> Siapkan proposal formal B2B untuk Yayasan Korporasi Contoh O, P, dan Q — angle "Transparansi Dashboard & Kepastian Cashflow".</li>
                <li class="mb-0"><strong>Setiap target yang dikirim:</strong> tekan tombol "Import ke Tracker" di Bagian 5 agar leads-nya langsung tercatat dan bisa di-follow-up dari Campaign Tracker.</li>
            </ol>
        </div>

        <div class="section-divider"><span><i class="fas fa-chart-area me-2"></i>BAGIAN 5: Kirim ke Campaign Tracker</span></div>

        <div class="step-card" style="border-left-color: #0dcaf0; border-top: none;">
            <p class="text-muted small mb-4">Klik "Import" untuk mencatat target sebagai lead baru (kategori <span class="variable-badge">LAZ</span>) langsung ke <a href="<?= $base_path ?>campaign/campaign-tracker/index.php">Campaign Tracker</a> — tidak perlu input manual ulang.</p>
            <div class="table-responsive">
                <table class="table-b2b">
                    <thead>
                        <tr>
                            <th width="26%">Nama LAZ</th>
                            <th width="14%">Gelombang</th>
                            <th width="14%">Kanal</th>
                            <th width="26%">Kontak</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($laz_targets as $i => $t): ?>
                        <tr id="laz-row-<?= $i ?>">
                            <td class="fw-bold text-dark"><?= htmlspecialchars($t['nama']) ?></td>
                            <td><span class="badge bg-<?= $wave_badge[$t['wave']] ?>"><?= $wave_labels[$t['wave']] ?></span></td>
                            <td><?= $t['kanal'] === 'wa' ? 'WhatsApp' : 'Email' ?></td>
                            <td>
                                <input type="text" class="form-control form-control-sm" id="laz-kontak-<?= $i ?>"
                                    value="<?= htmlspecialchars($t['kontak'], ENT_QUOTES) ?>"
                                    placeholder="Isi nomor WA / email">
                            </td>
                            <td>
                                <button class="btn btn-outline-primary btn-import"
                                    data-nama="<?= htmlspecialchars($t['nama'], ENT_QUOTES) ?>"
                                    data-pic="<?= htmlspecialchars($t['pic'], ENT_QUOTES) ?>"
                                    data-kanal="<?= $t['kanal'] ?>"
                                    data-wave="<?= $t['wave'] ?>"
                                    onclick="importLazLead(this, <?= $i ?>)">
                                    <i class="fas fa-cloud-upload-alt"></i> Import
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

<script>
    const LAZ_PROXY_URL = 'campaign-tracker/api/firebase_proxy.php';

    function copyText(id, btn) {
        let text = document.getElementById(id).textContent || document.getElementById(id).innerText;
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

    function lazNormalizePhone(raw) {
        let digits = raw.replace(/\D/g, '');
        if (digits.startsWith('0')) digits = '62' + digits.slice(1);
        return digits || null;
    }

    function lazSanitizeEmailKey(email) {
        return email.toLowerCase().replace(/[^a-z0-9]/g, '_');
    }

    async function importLazLead(btn, idx) {
        const nama   = btn.dataset.nama;
        const pic    = btn.dataset.pic;
        const kanal  = btn.dataset.kanal;
        const wave   = btn.dataset.wave;
        const kontakInput = document.getElementById('laz-kontak-' + idx);
        const kontak = kontakInput.value.trim();

        if (!kontak) {
            alert('Isi kontak (nomor WA / email) dulu sebelum Import.');
            kontakInput.focus();
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';

        try {
            let _key, display;
            if (kanal === 'wa') {
                _key = lazNormalizePhone(kontak);
                if (!_key) throw new Error('Format kontak WA tidak valid');
                display = _key;
            } else {
                _key = lazSanitizeEmailKey(kontak);
                display = kontak.toLowerCase();
            }

            const newLead = {
                _key,
                contact_display: display,
                brand: 'LAZ',
                area: 'Nasional',
                produk: 'Gelombang ' + wave,
                nama_agen: nama,
                pic_garap: pic,
                tipe_leads: 'New',
                created_at: new Date().toISOString().split('T')[0],
                updated_at: new Date().toISOString().split('T')[0]
            };

            const basePath = kanal === 'wa' ? 'master_leads/whatsapp' : 'master_leads/email';
            const res = await fetch(`${LAZ_PROXY_URL}?path=${encodeURIComponent(basePath + '/' + _key)}`, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(newLead)
            });
            if (!res.ok) throw new Error('Gagal menyimpan ke Tracker (HTTP ' + res.status + ')');

            btn.innerHTML = '<i class="fas fa-check"></i> Tersimpan';
            btn.classList.remove('btn-outline-primary');
            btn.classList.add('btn-success', 'text-white');
        } catch (err) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-cloud-upload-alt"></i> Import';
            alert(err.message);
        }
    }
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
