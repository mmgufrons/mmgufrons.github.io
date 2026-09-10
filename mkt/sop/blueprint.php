<?php
$page_title = "SOP Pembuatan Active Blueprint | SIMASRIM CS";
$footer_desc = "Dokumen Internal Terbatas - Divisi Customer Service & Marketing.";
$base_path = '../';
include __DIR__ . '/../includes/header.php';
?>

<style>
    .step-num { width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff; flex-shrink: 0; }
    .tool-tag { display: inline-flex; align-items: center; gap: 6px; background: #f1f3f5; border: 1px solid #e9ecef; color: #495057; font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 999px; }
    .prompt-box { background: #f8f9fa; border: 1px solid #e9ecef; border-left: 4px solid var(--primary); border-radius: 10px; padding: 1rem 1.2rem; font-size: 0.85rem; color: #333; line-height: 1.7; white-space: pre-wrap; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .raw-prompt-text { display: none !important; }
    .btn-copy-prompt { background: white; border: 1px solid #ced4da; color: #495057; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.8rem; font-weight: 600; transition: all 0.2s ease; cursor: pointer; white-space: nowrap; }
    .btn-copy-prompt:hover { background: #e9ecef; color: #212529; }
    .btn-copy-prompt.copied { background: var(--primary); border-color: var(--primary); color: white; }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--success);"></div>

    <div class="container position-relative z-1">
        <span class="badge bg-success rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25"><i class="fa-solid fa-file-code me-2"></i>SOP Management</span>
        <h2 class="display-5 fw-bold mb-2">SOP Pembuatan Active Blueprint</h2>
        <p class="text-white-50 mb-0">Alur kerja mingguan lengkap: dari riset ide dengan AI, generate kode dengan AI, hingga tayang di portal MKT.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">

        <div class="alert alert-info border-info border-opacity-25 shadow-sm rounded-4 p-4 mb-4">
            <div class="d-flex gap-3">
                <i class="fas fa-info-circle fs-2 text-info mt-1"></i>
                <div>
                    <h6 class="fw-bold text-dark mb-1">Gambaran Alur Mingguan</h6>
                    <p class="small text-dark mb-0">Setiap pekan, Active Blueprint dibuat lewat 2 alat AI yang berbeda perannya: <strong>AI chat</strong> (Gemini, ChatGPT, Claude, atau AI chat lain sesuai preferensi) dipakai dari awal sampai konsep itu berubah jadi teks kode PHP (Tahap 1-3, satu sesi chat yang sama), lalu <strong>AI coding tool</strong> (Antigravity atau Claude Code di VS Code) dipakai untuk menerapkan teks kode itu ke dalam project sekaligus mendaftarkannya ke Sidebar dan Dashboard (Tahap 4-5), sebelum diverifikasi manual (Tahap 6).</p>
                </div>
            </div>
        </div>

        <!-- TAHAP 1: IDE -->
        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid var(--primary); box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="step-num bg-primary">1</span>
                <h5 class="fw-bold text-dark mb-0">Susun Ide & Konsep Konten Pekan Ini</h5>
                <span class="tool-tag ms-2"><i class="fas fa-robot"></i> AI Chat (Gemini/ChatGPT/Claude, dll)</span>
            </div>
            <p class="text-muted small mb-3">Tujuan tahap ini bukan kode, tapi <strong>konsep</strong>: topik per hari (Senin-Sabtu), isu terkini dunia pengiriman/paket yang relevan, dan pesan utama tiap grup target (Agen Utama, Agen/Seller Baru, Jaringan/Downline).</p>
            <ol class="small text-dark mb-3 bg-light p-3 border rounded" style="line-height: 1.8;">
                <li class="mb-1">Buka AI chat pilihan (Gemini, ChatGPT, Claude, atau lainnya), lampirkan riwayat percakapan Blueprint pekan sebelumnya sebagai referensi gaya bahasa dan format hari.</li>
                <li class="mb-1">Kalau sesi chat sebelumnya sudah tidak tersedia/hilang, gunakan file referensi utama ini sebagai gantinya (berisi kumpulan riwayat Blueprint & pola percakapan): <a href="#" target="_blank" rel="noopener">Referensi Blueprint (Google Drive)</a>.</li>
                <li class="mb-1">Berikan arahan pekan yang dituju beserta rancangan topik kasar per hari.</li>
                <li class="mb-0">AI akan membalas draft konsep lengkap per hari — cek dan koreksi dulu isi informasinya (nomor CS, nama fitur, tanggal, dsb) sebelum lanjut ke Tahap 2.</li>
            </ol>
            <p class="small text-dark mb-2 fw-bold">Contoh Prompt (bisa langsung disalin dan disesuaikan):</p>
            <div class="d-flex justify-content-between align-items-start gap-2">
                <div class="prompt-box w-100">cek dan pelajari source yang saya lampirkan, saya berniat melanjutkan untuk pekan [NOMOR PEKAN & BULAN, contoh: 4 agustus], tapi cukup Blueprintnya saja tanpa perlu kode dulu. untuk topiknya adalah:
Senin: [topik 1, jelaskan detail spesifik]
Selasa: [topik 2]
Rabu: [topik 3]
Kamis: [topik 4 — kalau belum ada ide, tulis "isu apa yang lagi ramai di dunia pengiriman/paket minggu ini?" biar AI bantu cari sudut pandangnya]
Jumat: [topik 5]
Sabtu: [topik 6 — kalau belum ada ide, boleh diskusi dulu sebelum ditentukan]</div>
                <button class="btn-copy-prompt" onclick="copyPromptText('raw_prompt_ide', this)"><i class="far fa-copy"></i> Salin</button>
            </div>
            <pre id="raw_prompt_ide" class="raw-prompt-text">cek dan pelajari source yang saya lampirkan, saya berniat melanjutkan untuk pekan [NOMOR PEKAN & BULAN, contoh: 4 agustus], tapi cukup Blueprintnya saja tanpa perlu kode dulu. untuk topiknya adalah:
Senin: [topik 1, jelaskan detail spesifik]
Selasa: [topik 2]
Rabu: [topik 3]
Kamis: [topik 4 — kalau belum ada ide, tulis "isu apa yang lagi ramai di dunia pengiriman/paket minggu ini?" biar AI bantu cari sudut pandangnya]
Jumat: [topik 5]
Sabtu: [topik 6 — kalau belum ada ide, boleh diskusi dulu sebelum ditentukan]</pre>
            <p class="small text-muted mt-3 mb-0"><i class="fas fa-circle-info me-1"></i> Setelah AI membalas draft konsepnya, koreksi dulu bagian yang keliru atau kurang detail (misal jam operasional, nomor kontak, nama fitur) sebelum draft ini dibawa ke Tahap 2.</p>
        </div>

        <!-- TAHAP 2: VALIDASI -->
        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid #6c757d; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="step-num" style="background:#6c757d;">2</span>
                <h5 class="fw-bold text-dark mb-0">Validasi Draft Konsep</h5>
            </div>
            <p class="text-muted small mb-0">Sebelum konsep diubah jadi kode, pastikan semua informasi teknis sudah benar (tanggal periode, batas waktu/cut-off kurir, nomor CS, link aplikasi/fitur, dsb.). Kalau ragu, koordinasikan dulu dengan tim terkait. Draft yang salah di tahap ini akan ikut salah sampai ke halaman jadi.</p>
        </div>

        <!-- TAHAP 3: GENERATE KODE (masih AI chat yang sama) -->
        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid var(--accent); box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="step-num" style="background: var(--accent);">3</span>
                <h5 class="fw-bold text-dark mb-0">Minta Konsep Diubah Jadi Teks Kode PHP</h5>
                <span class="tool-tag ms-2"><i class="fas fa-robot"></i> AI Chat yang sama (sesi Tahap 1-2)</span>
            </div>
            <p class="text-muted small mb-3">Tahap ini masih di AI chat yang sama — <strong>belum</strong> pindah ke Antigravity atau VS Code. Tugas AI di sini hanya menghasilkan <strong>teks kode PHP</strong> (untuk nanti disalin), bukan membuat file sungguhan di project.</p>
            <ol class="small text-dark mb-3 bg-light p-3 border rounded" style="line-height: 1.8;">
                <li class="mb-1">Di chat yang sama, lampirkan isi file Blueprint pekan terakhir yang sudah tayang (contoh: <code>blueprint/agustus_3.php</code>) sebagai acuan format, class HTML, dan struktur kode.</li>
                <li class="mb-1">Minta AI mengubah draft konsep (dari Tahap 1-2 yang sudah divalidasi) menjadi kode PHP penuh, mengikuti format file acuan tadi.</li>
                <li class="mb-0">AI akan membalas dalam bentuk teks kode PHP lengkap di chat — salin teks ini, akan dipakai di Tahap 4.</li>
            </ol>
            <p class="small text-dark mb-2 fw-bold">Contoh Prompt (bisa langsung disalin dan disesuaikan):</p>
            <div class="d-flex justify-content-between align-items-start gap-2">
                <div class="prompt-box w-100">konsepnya sudah mantap, tolong ubah ke versi kode PHP penuh (tanpa ada yang keliru, tertinggal, atau terlewat) mengikuti standar format dari file blueprint/agustus_3.php ini sebagai acuan struktur, class HTML, dan style:
[tempel isi lengkap file blueprint/agustus_3.php di sini]</div>
                <button class="btn-copy-prompt" onclick="copyPromptText('raw_prompt_kode', this)"><i class="far fa-copy"></i> Salin</button>
            </div>
            <pre id="raw_prompt_kode" class="raw-prompt-text">konsepnya sudah mantap, tolong ubah ke versi kode PHP penuh (tanpa ada yang keliru, tertinggal, atau terlewat) mengikuti standar format dari file blueprint/agustus_3.php ini sebagai acuan struktur, class HTML, dan style:
[tempel isi lengkap file blueprint/agustus_3.php di sini]</pre>
            <p class="small text-muted mt-3 mb-0"><i class="fas fa-circle-info me-1"></i> Hasil balasan AI di tahap ini masih berupa teks — belum ada file baru di project. File baru baru benar-benar dibuat di Tahap 4, memakai AI coding tool.</p>
        </div>

        <!-- TIPS LANJUTAN: MENERUSKAN SESI CHAT -->
        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid #d63384; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="step-num" style="background:#d63384;"><i class="fas fa-comments"></i></span>
                <h5 class="fw-bold text-dark mb-0">Tips: Meneruskan Percakapan untuk Pekan Berikutnya</h5>
            </div>
            <p class="text-muted small mb-3">Untuk pekan-pekan selanjutnya, <strong>tidak perlu membuka sesi chat baru</strong> — baik di AI chat maupun di AI coding tool. Lanjutkan saja di sesi yang sama supaya konteks gaya bahasa, format, dan histori keputusan sebelumnya tetap terjaga (AI tidak perlu diajari ulang dari nol).</p>

            <p class="small text-dark mb-2 fw-bold">1. Contoh melanjutkan ke pekan baru:</p>
            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                <div class="prompt-box w-100">mantap bre, kita lanjut ke [Bulan] #[Nomor], kali ini topiknya:
- [poin topik 1]
- [poin topik 2]
- [poin topik 3, dst]</div>
                <button class="btn-copy-prompt" onclick="copyPromptText('raw_prompt_lanjut_pekan', this)"><i class="far fa-copy"></i> Salin</button>
            </div>
            <pre id="raw_prompt_lanjut_pekan" class="raw-prompt-text">mantap bre, kita lanjut ke [Bulan] #[Nomor], kali ini topiknya:
- [poin topik 1]
- [poin topik 2]
- [poin topik 3, dst]</pre>

            <p class="small text-dark mb-2 fw-bold">2. Kalau materinya sensitif/kompleks (SOP baru, aturan klaim, dsb) — minta AI diskusi dulu sebelum langsung bikin kode:</p>
            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                <div class="prompt-box w-100">biar makin mantep dan sesuai kita diskusi dulu ya, jangan langsung kamu buatin code, pasti ada yang perlu kamu konfirmasi atau berikan saran dulu dong tentunya?</div>
                <button class="btn-copy-prompt" onclick="copyPromptText('raw_prompt_diskusi_dulu', this)"><i class="far fa-copy"></i> Salin</button>
            </div>
            <pre id="raw_prompt_diskusi_dulu" class="raw-prompt-text">biar makin mantep dan sesuai kita diskusi dulu ya, jangan langsung kamu buatin code, pasti ada yang perlu kamu konfirmasi atau berikan saran dulu dong tentunya?</pre>

            <p class="small text-dark mb-2 fw-bold">3. Setelah arah bahasa/angle disepakati, konfirmasi baru minta full code:</p>
            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                <div class="prompt-box w-100">OKE, lanjut sesuai poin-poin yang sudah kita sepakati.</div>
                <button class="btn-copy-prompt" onclick="copyPromptText('raw_prompt_konfirmasi_oke', this)"><i class="far fa-copy"></i> Salin</button>
            </div>
            <pre id="raw_prompt_konfirmasi_oke" class="raw-prompt-text">OKE, lanjut sesuai poin-poin yang sudah kita sepakati.</pre>

            <p class="small text-dark mb-2 fw-bold">4. Kalau cuma perlu revisi kecil dari kode yang sudah jadi (tidak perlu full code ulang):</p>
            <div class="d-flex justify-content-between align-items-start gap-2">
                <div class="prompt-box w-100">jadinya seperti ini: [tempel kode yang sudah ada]
JANGAN RUBAH APA YANG SUDAH SAYA PERBAIKI! cukup [jelaskan perubahan spesifik yang diminta]. Infokan di bagian mana update-nya (tak perlu full code).</div>
                <button class="btn-copy-prompt" onclick="copyPromptText('raw_prompt_revisi_kecil', this)"><i class="far fa-copy"></i> Salin</button>
            </div>
            <pre id="raw_prompt_revisi_kecil" class="raw-prompt-text">jadinya seperti ini: [tempel kode yang sudah ada]
JANGAN RUBAH APA YANG SUDAH SAYA PERBAIKI! cukup [jelaskan perubahan spesifik yang diminta]. Infokan di bagian mana update-nya (tak perlu full code).</pre>
            <p class="small text-muted mt-3 mb-0"><i class="fas fa-circle-info me-1"></i> Pola yang sama juga berlaku di sesi AI Coding tool (Antigravity/Claude Code) untuk Tahap 4-6 di bawah — lanjutkan di sesi yang sama, jangan mulai obrolan baru tiap pekan.</p>
        </div>

        <!-- TAHAP 4: TERAPKAN KE PROJECT (ganti tool ke AI coding) -->
        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid var(--success); box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="step-num bg-success">4</span>
                <h5 class="fw-bold text-dark mb-0">Terapkan Kode ke File Baru di Folder <code>blueprint/</code></h5>
                <span class="tool-tag ms-2"><i class="fas fa-code"></i> Antigravity / Claude Code + VS Code</span>
            </div>
            <p class="text-muted small mb-3">Mulai dari sini, pindah ke AI coding tool (Antigravity, atau Claude Code di dalam VS Code) — karena tugasnya sekarang membuat dan mengedit file sungguhan di project, bukan sekadar membalas teks di chat. Nama file mengikuti pola <strong>[bulan]_[nomor].php</strong> tanpa awalan apa pun, contoh urutan yang sudah berjalan:</p>
            <div class="code-block mb-3">blueprint/apr_1.php  → blueprint/apr_4.php
blueprint/mei_1.php  → blueprint/mei_4.php
blueprint/juni_1.php → blueprint/juni_4.php
blueprint/juli_1.php → blueprint/juli_5.php
blueprint/agustus_1.php → blueprint/agustus_3.php → <span class="code-highlight">blueprint/agustus_4.php</span> (pekan baru)</div>

            <p class="small text-dark mb-2 fw-bold">Prompt untuk AI Coding Tool (Antigravity/Claude Code):</p>
            <div class="d-flex justify-content-between align-items-start gap-2">
                <div class="prompt-box w-100">Buatkan file baru di folder blueprint/ dengan nama agustus_4.php (ikuti pola penamaan [bulan]_[nomor].php yang sudah berjalan di project ini). Isi file dengan Full Code PHP berikut, salin persis tanpa ada yang terlewat atau berubah:

[tempel Full Code hasil Tahap 3 di sini]

Pastikan $base_path = '../'; sudah benar karena file ini berada satu folder di dalam blueprint/.</div>
                <button class="btn-copy-prompt" onclick="copyPromptText('raw_prompt_file_baru', this)"><i class="far fa-copy"></i> Salin</button>
            </div>
            <pre id="raw_prompt_file_baru" class="raw-prompt-text">Buatkan file baru di folder blueprint/ dengan nama agustus_4.php (ikuti pola penamaan [bulan]_[nomor].php yang sudah berjalan di project ini). Isi file dengan Full Code PHP berikut, salin persis tanpa ada yang terlewat atau berubah:

[tempel Full Code hasil Tahap 3 di sini]

Pastikan $base_path = '../'; sudah benar karena file ini berada satu folder di dalam blueprint/.</pre>
            <p class="text-muted small mt-3 mb-0"><i class="fas fa-circle-info me-1"></i> Kalau nilai <code>$base_path</code> salah, semua link CSS/gambar/menu di halaman akan patah — AI Coding tool akan menangani ini otomatis selama diminta eksplisit seperti prompt di atas.</p>
        </div>

        <!-- TAHAP 5: SIDEBAR + DASHBOARD (satu prompt gabungan, sesuai praktik nyata) -->
        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid #0dcaf0; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="step-num" style="background:#0dcaf0;">5</span>
                <h5 class="fw-bold text-dark mb-0">Daftarkan ke Sidebar & Update Dashboard</h5>
                <span class="tool-tag ms-2"><i class="fas fa-code"></i> Antigravity / Claude Code + VS Code</span>
            </div>
            <p class="text-muted small mb-3">Di praktiknya, update <code>includes/sidebar.php</code> dan <code>index.php</code> dikerjakan sekaligus lewat satu prompt yang sama ke AI Coding tool. Prompt ini menyebut anchor teknis sesuai struktur project <strong>saat ini</strong> — array <code>$blueprint_pages</code>, container menu <code>&lt;div id="menuBlueprint"&gt;</code>, class <code>nav-item</code> dengan pengecekan <code>$current_page</code>, dan kartu <code>dashboard-card border-primary</code> di dalam <code>&lt;div class="row mb-4"&gt;</code> — supaya AI langsung mengedit bagian yang tepat, bukan menebak-nebak struktur lama.</p>

            <p class="small text-dark mb-2 fw-bold">Prompt Contoh (sesuaikan bagian dalam kurung siku):</p>
            <div class="d-flex justify-content-between align-items-start gap-2">
                <div class="prompt-box w-100">Bertindaklah sebagai Senior Full-Stack Developer. Lakukan pembaruan rutin pada portal operasional SIMASRIM untuk Active Blueprint pekan terbaru. Ikuti struktur file yang SUDAH ADA di project ini, jangan asumsikan struktur dari luar.

Langkah pengerjaan:
1. Buka file `includes/sidebar.php`:
   - Tambahkan 'agustus_4.php' ke dalam array $blueprint_pages di bagian PHP paling atas file.
   - Di dalam `&lt;div id="menuBlueprint"&gt;`, tambahkan link baru (class `nav-item`, dengan pengecekan aktif `$current_page == 'agustus_4.php'`) untuk blueprint/agustus_4.php dengan teks 'Agustus #4' + label '(Terbaru)'. Pasang di posisi PALING ATAS daftar link, pakai style ikon aksen (warna solid, bukan redup).
   - Turunkan link 'agustus_3.php' yang sebelumnya berlabel '(Terbaru)' kembali ke styling standar (ikon redup/opacity rendah, tanpa label '(Terbaru)').
2. Buka file `index.php` (Dashboard):
   - Cari kartu dengan class `dashboard-card border-primary` di dalam `&lt;div class="row mb-4"&gt;` — itu kartu "Active Blueprint" paling atas.
   - Update href menuju blueprint/agustus_4.php.
   - Update judul (h5) menjadi 'Active Blueprint: Agustus #4'.
   - Update deskripsi (p) menjadi ringkasan 1 kalimat fokus topik-topik pekan ini.
   - Pastikan semua path pada href tetap menggunakan variabel <?= $base_path ?>.

Setelah selesai, tunjukkan diff/potongan kode yang berubah supaya bisa saya verifikasi.</div>
                <button class="btn-copy-prompt" onclick="copyPromptText('raw_prompt_sidebar_dashboard', this)"><i class="far fa-copy"></i> Salin</button>
            </div>
            <pre id="raw_prompt_sidebar_dashboard" class="raw-prompt-text">Bertindaklah sebagai Senior Full-Stack Developer. Lakukan pembaruan rutin pada portal operasional SIMASRIM untuk Active Blueprint pekan terbaru. Ikuti struktur file yang SUDAH ADA di project ini, jangan asumsikan struktur dari luar.

Langkah pengerjaan:
1. Buka file `includes/sidebar.php`:
   - Tambahkan 'agustus_4.php' ke dalam array $blueprint_pages di bagian PHP paling atas file.
   - Di dalam `&lt;div id="menuBlueprint"&gt;`, tambahkan link baru (class `nav-item`, dengan pengecekan aktif `$current_page == 'agustus_4.php'`) untuk blueprint/agustus_4.php dengan teks 'Agustus #4' + label '(Terbaru)'. Pasang di posisi PALING ATAS daftar link, pakai style ikon aksen (warna solid, bukan redup).
   - Turunkan link 'agustus_3.php' yang sebelumnya berlabel '(Terbaru)' kembali ke styling standar (ikon redup/opacity rendah, tanpa label '(Terbaru)').
2. Buka file `index.php` (Dashboard):
   - Cari kartu dengan class `dashboard-card border-primary` di dalam `&lt;div class="row mb-4"&gt;` — itu kartu "Active Blueprint" paling atas.
   - Update href menuju blueprint/agustus_4.php.
   - Update judul (h5) menjadi 'Active Blueprint: Agustus #4'.
   - Update deskripsi (p) menjadi ringkasan 1 kalimat fokus topik-topik pekan ini.
   - Pastikan semua path pada href tetap menggunakan variabel <?= $base_path ?>.

Setelah selesai, tunjukkan diff/potongan kode yang berubah supaya bisa saya verifikasi.</pre>
        </div>

        <!-- TAHAP 6: VERIFIKASI -->
        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid #dc3545; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="step-num bg-danger">6</span>
                <h5 class="fw-bold text-dark mb-0">Verifikasi Sebelum Broadcast Pertama</h5>
            </div>
            <p class="text-muted small mb-3">Sebagian verifikasi bisa dibantu AI Coding tool lewat prompt, tapi cek visual di browser tetap wajib dilakukan manual.</p>

            <p class="small text-dark mb-2 fw-bold">Prompt Opsional untuk Bantuan Cek Otomatis (AI Coding Tool):</p>
            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                <div class="prompt-box w-100">Tolong cek ulang perubahan yang barusan dibuat:
1. Di includes/sidebar.php — apakah array $blueprint_pages sudah berisi 'agustus_4.php', dan di dalam &lt;div id="menuBlueprint"&gt; apakah link 'agustus_4.php' sudah berlabel "(Terbaru)" dengan style aksen, sementara link 'agustus_3.php' sudah kembali ke style standar (tanpa label, tanpa dua-duanya aktif sekaligus)?
2. Di index.php — apakah kartu dashboard-card border-primary di dalam &lt;div class="row mb-4"&gt; sudah mengarah ke blueprint/agustus_4.php dengan judul dan deskripsi yang sesuai?
Tampilkan potongan kode yang relevan dari kedua file untuk saya cross-check.</div>
                <button class="btn-copy-prompt" onclick="copyPromptText('raw_prompt_verifikasi', this)"><i class="far fa-copy"></i> Salin</button>
            </div>
            <pre id="raw_prompt_verifikasi" class="raw-prompt-text">Tolong cek ulang perubahan yang barusan dibuat:
1. Di includes/sidebar.php — apakah array $blueprint_pages sudah berisi 'agustus_4.php', dan di dalam &lt;div id="menuBlueprint"&gt; apakah link 'agustus_4.php' sudah berlabel "(Terbaru)" dengan style aksen, sementara link 'agustus_3.php' sudah kembali ke style standar (tanpa label, tanpa dua-duanya aktif sekaligus)?
2. Di index.php — apakah kartu dashboard-card border-primary di dalam &lt;div class="row mb-4"&gt; sudah mengarah ke blueprint/agustus_4.php dengan judul dan deskripsi yang sesuai?
Tampilkan potongan kode yang relevan dari kedua file untuk saya cross-check.</pre>

            <p class="small text-dark mb-2 fw-bold">Checklist Manual (wajib dicek langsung di browser):</p>
            <ul class="small text-dark mb-0 px-3" style="line-height: 1.9;">
                <li>Buka halaman Blueprint baru langsung dari browser, pastikan tidak ada bagian yang rusak (gambar/CSS hilang biasanya tanda <code>$base_path</code> salah).</li>
                <li>Cek Sidebar: link "(Terbaru)" tampil di menu pekan baru, dan link pekan sebelumnya sudah kembali ke style standar (bukan dua-duanya menyala "Terbaru").</li>
                <li>Cek Dashboard: kartu paling atas sudah mengarah ke file pekan baru dengan judul dan deskripsi yang sesuai.</li>
                <li>Klik semua tombol "Salin Pesan" di setiap hari — pastikan teks yang tersalin sama persis dengan yang tampil di layar (isi <code>&lt;pre class="raw-wa-text"&gt;</code> wajib disamakan manual dengan isi <code>&lt;div class="chat-bubble"&gt;</code>, keduanya tidak otomatis sinkron).</li>
            </ul>
            <div class="mt-4 p-3 bg-success bg-opacity-10 rounded-3 border border-success border-opacity-25 text-success small fw-bold">
                <i class="fas fa-check-circle me-2"></i> Selesai! Blueprint pekan baru sudah live dan siap dipakai untuk broadcast.
            </div>
        </div>

    </div>
</section>

<script>
    function copyPromptText(id, btn) {
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