<?php
$page_title = "SOP Tim Internal | Canvassing Mitra Area";
$footer_desc = "Dokumen Internal Tim SIMASRIM – Prosedur Operasional Standar Canvassing Koperasi/Badan Usaha per Wilayah Mitra Area.";
$base_path = '../'; include __DIR__ . '/../includes/header.php';
?>

<style>
    .step-card {
        background: #ffffff; border: 1px solid rgba(0,0,0,0.08);
        border-left: 5px solid var(--primary); border-radius: 16px;
        padding: 1.5rem; margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02); transition: transform 0.3s ease;
    }
    .step-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.05); }
    .step-header { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 14px; flex-wrap: wrap; }
    .step-number { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 50%; background: var(--primary); color: white; font-weight: 800; font-size: 0.85rem; flex-shrink: 0; }

    .prompt-box {
        background: #0f0c29; color: #e8e8f0; border-radius: 12px;
        padding: 18px 20px; font-family: 'Courier New', monospace;
        font-size: 0.82rem; line-height: 1.7; white-space: pre-wrap;
        word-break: break-word; position: relative; margin-top: 12px;
        border: 1px solid rgba(115,53,183,0.3);
    }
    .prompt-box .prompt-label {
        position: absolute; top: -10px; left: 14px;
        background: var(--primary); color: white; font-size: 0.65rem;
        font-weight: 800; text-transform: uppercase; letter-spacing: 1px;
        padding: 2px 10px; border-radius: 20px;
    }
    .prompt-highlight { color: #F3700D; }
    .prompt-instruction { color: #a5f3fc; }

    .role-card {
        border-radius: 16px; padding: 20px; height: 100%;
        border: 1.5px solid transparent; background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04); transition: 0.2s;
    }
    .role-card:hover { border-color: var(--primary); transform: translateY(-4px); }
    .role-icon { width: 50px; height: 50px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 14px; }

    .btn-copy {
        background: rgba(115,53,183,0.1); color: var(--primary); border: none;
        border-radius: 8px; padding: 6px 14px; font-size: 0.8rem; font-weight: 700;
        cursor: pointer; transition: 0.2s; white-space: nowrap;
    }
    .btn-copy:hover { background: var(--primary); color: white; }
    .btn-copy.copied { background: #198754; color: white; }

    .info-ribbon { background: linear-gradient(135deg, #7335B7, #5A2A8F); color: white; border-radius: 14px; padding: 16px 20px; margin-bottom: 28px; }

    .area-card {
        background: white; border-radius: 16px; padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04); height: 100%;
        border-top: 4px solid var(--primary);
    }
    .area-card h6 { font-weight: 800; }
    .area-card .badge-status { font-size: 0.68rem; }
    .area-card .area-edit-btn { padding: 4px 8px; flex-shrink: 0; }
    .area-card .badge-status.filled { background: rgba(115,53,183,0.12); color: var(--primary); }
</style>

<!-- HERO -->
<section class="hero-section">
    <div class="container" data-aos="fade-up">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-bold mb-3 small">
            <i class="fas fa-lock me-1"></i> Internal Tim SIMASRIM
        </span>
        <h1 class="display-5 fw-bold text-white mb-2">SOP Canvassing Mitra Area</h1>
        <p class="text-white-50 mb-4">Panduan operasional kunjungan langsung (canvassing) ke Koperasi/Badan Usaha per wilayah Mitra Area.</p>
        <div class="d-flex gap-2 flex-wrap">
            <a href="sop_mitra_fu.php" class="btn btn-light rounded-pill px-4 fw-bold">
                <i class="fas fa-clipboard-check me-2"></i>SOP Follow-Up
            </a>
            <button type="button" id="btn-export-word" class="btn btn-outline-light rounded-pill px-4">
                <i class="fas fa-file-word me-2"></i>Unduh sebagai Word (untuk Mitra Area)
            </button>
        </div>
    </div>
</section>

<div class="container followup-container py-5">

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 1: ALUR KERJA CS BLAST → VISIT       -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="text-center mb-4" data-aos="fade-up">
        <h5 class="fw-bold text-primary text-uppercase" style="letter-spacing:2px;font-size:0.75rem;">Alur Kerja</h5>
        <h2 class="fw-bold">Dari Blast WA ke Kunjungan Langsung</h2>
        <p class="text-muted">Prinsip: hindari visit tanpa konteks. Tim internal membuka jalan lewat blast WA dulu, baru Mitra Area (partner wilayah) canvassing ke lokasi yang sudah "hangat".</p>
    </div>

    <div id="section-alur-export">

    <div class="step-card" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number">1</span>
                <div>
                    <h6 class="fw-bold mb-1">CS Pusat Blast WA ke Data Terbaru</h6>
                    <p class="text-muted small mb-0">CS pusat mengirim blast WA (materi & script lihat <a href="../campaign/materi_wa.php" class="text-primary fw-bold">Template WA</a> / <a href="../campaign/b2b_juni.php" class="text-primary fw-bold">Blueprint B2B</a>) ke data koperasi/badan usaha terbaru di wilayah masing-masing sebelum jadwal kunjungan Mitra Area.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="step-card" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number">2</span>
                <div>
                    <h6 class="fw-bold mb-1">Saring Respon → Prioritaskan yang "Hangat"</h6>
                    <p class="text-muted small mb-2">Pantau respon blast WA. Kelompokkan: <b>sudah balas positif/nanya lanjut</b> (prioritas visit tinggi), <b>read tapi tidak balas</b> (visit dengan pembuka soft), <b>belum terkirim/nomor mati</b> (skip, cari data pengganti).</p>
                    <div style="background:#f8f9fa;border-radius:10px;padding:12px 14px;font-size:0.82rem;border-left:3px solid #ffc107;">
                        <b>🔑 Aturan Emas:</b> Kalau data blast dari tim data/Raka sudah ada dan mayoritas koperasi/badan usaha sudah kenal SIMASRIM (dari campaign sebelumnya), Mitra Area boleh langsung datangi tanpa nunggu blast ulang.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="step-card" style="border-left-color:#F3700D;" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number" style="background:#F3700D;">3</span>
                <div>
                    <h6 class="fw-bold mb-1">Mitra Area Canvassing ke Lokasi</h6>
                    <p class="text-muted small mb-0">Kunjungan langsung dengan membawa konteks respon WA (lihat Section 3 untuk script canvassing di lokasi). Bawa amunisi fisik jika perlu (flyer/brosur) yang sudah disiapkan tim internal.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="step-card" style="border-left-color:#20c997;" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number" style="background:#20c997;">4</span>
                <div>
                    <h6 class="fw-bold mb-1">Laporkan Hasil Visit ke Tim Internal</h6>
                    <p class="text-muted small mb-0">Setelah kunjungan, Mitra Area melaporkan hasilnya ke tim internal (WA/telepon) — tim internal yang mencatat hasil visit ke sistem, lihat Section 4 untuk detail data yang perlu dilaporkan.</p>
                </div>
            </div>
        </div>
    </div>

    </div><!-- /section-alur-export -->

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 2: TARGET & CARA KERJA PER AREA      -->
    <!-- ═══════════════════════════════════════════ -->
    <hr class="my-5" style="border: 2px dashed #e9ecef;">
    <div class="text-center mb-4" data-aos="fade-up">
        <h5 class="fw-bold text-primary text-uppercase" style="letter-spacing:2px;font-size:0.75rem;">Per Wilayah</h5>
        <h2 class="fw-bold">Target & Cara Kerja — 6 Area Aktif</h2>
        <p class="text-muted">Klik <i class="fas fa-pen"></i> di tiap kartu untuk isi/update — tersimpan otomatis, langsung terlihat semua yang buka halaman ini (tidak perlu coding).</p>
    </div>

    <div class="row g-4 mb-5" id="canvassing-area-cards">
        <?php foreach (['Medan', 'Malang', 'Surabaya', 'Palembang', 'Kediri', 'Bekasi'] as $area_nama):
            $slug = strtolower($area_nama); ?>
        <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <div class="area-card" data-slug="<?= $slug ?>">
                <div class="d-flex justify-content-between align-items-start">
                    <h6><i class="fas fa-map-marker-alt text-primary me-2"></i><?= $area_nama ?></h6>
                    <button type="button" class="btn-copy area-edit-btn" title="Edit"><i class="fas fa-pen"></i></button>
                </div>
                <div class="area-card-view">
                    <span class="badge bg-secondary badge-status mb-2">Target belum diisi</span>
                    <p class="text-muted small mb-0">Lengkapi target koperasi/badan usaha dan cara kerja khusus area ini bersama tim Mitra Area <?= $area_nama ?>.</p>
                </div>
                <div class="area-card-edit d-none">
                    <textarea class="form-control form-control-sm area-edit-input" rows="4" placeholder="Target & cara kerja area <?= $area_nama ?>..."></textarea>
                    <div class="d-flex gap-2 mt-2">
                        <button type="button" class="btn btn-sm btn-primary area-save-btn">Simpan</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary area-cancel-btn">Batal</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 3: SCRIPT CANVASSING DI LOKASI       -->
    <!-- ═══════════════════════════════════════════ -->
    <hr class="my-5" style="border: 2px dashed #e9ecef;">
    <div class="text-center mb-4" data-aos="fade-up">
        <h5 class="fw-bold text-primary text-uppercase" style="letter-spacing:2px;font-size:0.75rem;">Referensi</h5>
        <h2 class="fw-bold">Script Canvassing — Kunjungan Langsung</h2>
        <p class="text-muted">Berbeda dari script WA: ini untuk percakapan tatap muka saat visit ke lokasi koperasi/badan usaha.</p>
    </div>

    <div id="section-script-export">

    <div class="step-card" data-aos="fade-up">
        <div class="step-header">
            <div>
                <span class="badge bg-danger mb-1">Kunjungan Pertama</span>
                <h5 class="fw-bold mb-0">Script 1: Pembuka Canvassing di Lokasi</h5>
            </div>
            <button class="btn-copy" onclick="copyPrompt('p1', this)"><i class="far fa-copy me-1"></i>Salin Script</button>
        </div>
        <p class="text-muted small">Gunakan saat: kunjungan pertama ke koperasi/badan usaha yang sudah di-blast WA sebelumnya oleh CS. Sesuaikan bagian bertanda [ ] dengan konteks lokasi.</p>
        <div class="prompt-box">
<span class="prompt-label">Script Kunjungan</span>"Selamat pagi/siang, Bapak/Ibu. Perkenalkan saya <span class="prompt-highlight">[Nama]</span> dari SIMASRIM, PT Solusi Mitra Aplikasi.

Sebelumnya mungkin sempat kami kirim info lewat WhatsApp ke nomor koperasi/badan usaha ini — apakah berkenan kalau saya jelaskan singkat di sini?

Kami membantu Koperasi/Badan Usaha kirim barang lebih murah lewat berbagai ekspedisi (multikurir) dalam satu aplikasi — tanpa perlu simpan ulang data pengirim tiap kali ganti kurir.

Sebelum saya lanjut — apakah Bapak/Ibu sebelumnya sudah pernah dengar atau pakai SIMASRIM?

[Jika belum kenal] — Boleh saya kenalkan dulu secara singkat...
[Jika sudah kenal/pernah dengar] — Baik, kalau begitu saya lanjut ke bagian yang mungkin belum diketahui...

Yang membedakan kami dari layanan sejenis: prosesnya lebih simpel karena tidak perlu input alamat pengirim berulang tiap tambah kurir baru.

Kira-kira, koperasi/badan usaha ini rutin kirim barang ke luar kota atau lebih sering terima kiriman?"

[Tutup dengan pertanyaan terbuka sesuai jawaban di atas — jangan langsung closing di kunjungan pertama, fokus buka dialog & pahami kebutuhan mereka.]</span></div>
        <pre id="p1" class="d-none">"Selamat pagi/siang, Bapak/Ibu. Perkenalkan saya [Nama] dari SIMASRIM, PT Solusi Mitra Aplikasi.

Sebelumnya mungkin sempat kami kirim info lewat WhatsApp ke nomor koperasi/badan usaha ini — apakah berkenan kalau saya jelaskan singkat di sini?

Kami membantu Koperasi/Badan Usaha kirim barang lebih murah lewat berbagai ekspedisi (multikurir) dalam satu aplikasi — tanpa perlu simpan ulang data pengirim tiap kali ganti kurir.

Sebelum saya lanjut — apakah Bapak/Ibu sebelumnya sudah pernah dengar atau pakai SIMASRIM?

[Jika belum kenal] — Boleh saya kenalkan dulu secara singkat...
[Jika sudah kenal/pernah dengar] — Baik, kalau begitu saya lanjut ke bagian yang mungkin belum diketahui...

Yang membedakan kami dari layanan sejenis: prosesnya lebih simpel karena tidak perlu input alamat pengirim berulang tiap tambah kurir baru.

Kira-kira, koperasi/badan usaha ini rutin kirim barang ke luar kota atau lebih sering terima kiriman?"

[Tutup dengan pertanyaan terbuka sesuai jawaban di atas — jangan langsung closing di kunjungan pertama, fokus buka dialog & pahami kebutuhan mereka.]</pre>
    </div>

    <div class="step-card" style="border-left-color:#ffc107;" data-aos="fade-up">
        <div class="step-header">
            <div>
                <span class="badge bg-warning text-dark mb-1">Kunjungan Lanjutan</span>
                <h5 class="fw-bold mb-0">Script 2: Follow-Up Setelah Kunjungan Pertama</h5>
            </div>
            <button class="btn-copy" onclick="copyPrompt('p2', this)"><i class="far fa-copy me-1"></i>Salin Script</button>
        </div>
        <p class="text-muted small">Gunakan saat: kunjungan kedua/lanjutan setelah pertemuan pertama menunjukkan minat.</p>
        <div class="prompt-box">
<span class="prompt-label">Script Kunjungan</span>"Selamat pagi/siang, Bapak/Ibu. Saya <span class="prompt-highlight">[Nama]</span> dari SIMASRIM — kembali lagi menindaklanjuti obrolan kita minggu lalu soal <span class="prompt-highlight">[topik yang dibahas kunjungan pertama]</span>.

Sebelumnya sempat ada pertanyaan soal <span class="prompt-highlight">[kendala/pertanyaan yang muncul]</span> — saya sudah bawa jawabannya: <span class="prompt-highlight">[jawaban konkret]</span>.

Kalau semua sudah jelas, mungkin bisa langsung kita coba mulai — prosesnya cukup [daftar akun/instalasi/demo singkat], tidak perlu waktu lama.

Apakah hari ini bisa langsung kita mulai, atau ada yang masih perlu didiskusikan dulu dengan pengurus lain?"

[Kalau masih ragu: tawarkan demo aplikasi langsung di tempat, atau jadwalkan kunjungan berikutnya dengan tanggal pasti — jangan biarkan tanpa tindak lanjut jelas.]</span></div>
        <pre id="p2" class="d-none">"Selamat pagi/siang, Bapak/Ibu. Saya [Nama] dari SIMASRIM — kembali lagi menindaklanjuti obrolan kita minggu lalu soal [topik yang dibahas kunjungan pertama].

Sebelumnya sempat ada pertanyaan soal [kendala/pertanyaan yang muncul] — saya sudah bawa jawabannya: [jawaban konkret].

Kalau semua sudah jelas, mungkin bisa langsung kita coba mulai — prosesnya cukup [daftar akun/instalasi/demo singkat], tidak perlu waktu lama.

Apakah hari ini bisa langsung kita mulai, atau ada yang masih perlu didiskusikan dulu dengan pengurus lain?"

[Kalau masih ragu: tawarkan demo aplikasi langsung di tempat, atau jadwalkan kunjungan berikutnya dengan tanggal pasti — jangan biarkan tanpa tindak lanjut jelas.]</pre>
    </div>

    </div><!-- /section-script-export -->

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 4: REPORTING HASIL VISIT             -->
    <!-- ═══════════════════════════════════════════ -->
    <hr class="my-5" style="border: 2px dashed #e9ecef;">
    <div class="text-center mb-4" data-aos="fade-up">
        <h5 class="fw-bold text-primary text-uppercase" style="letter-spacing:2px;font-size:0.75rem;">Reporting (Tim Internal)</h5>
        <h2 class="fw-bold">Catat Hasil Canvassing ke Campaign Tracker</h2>
        <p class="text-muted">Mitra Area melaporkan hasil visit ke tim internal — langkah di bawah dikerjakan oleh tim internal (Mitra Area tidak memiliki akses ke sistem ini).</p>
    </div>

    <div class="step-card" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number">1</span>
                <div>
                    <h6 class="fw-bold mb-1">Buka Campaign Tracker Segera Setelah Menerima Laporan</h6>
                    <p class="text-muted small mb-0">Buka <a href="../campaign/campaign-tracker/index.html" class="text-primary fw-bold">Campaign Tracker</a> → tab <b>Master Leads</b> → cari lead koperasi/badan usaha yang baru dikunjungi (cari nama atau nomor kontak), lalu klik untuk edit — lakukan di hari yang sama selagi detail masih segar.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="step-card" style="border-left-color:#F3700D;" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number" style="background:#F3700D;">2</span>
                <div>
                    <h6 class="fw-bold mb-1">Field yang Wajib Diupdate</h6>
                    <p class="text-muted small mb-0"><b>Tahap</b> (mis. FOLLOW UP / CLOSING sesuai hasil visit), <b>Respon</b> (tertarik/pending/tolak), <b>Aksi Lanjutan</b> (kunjungan ulang / kirim dokumen / tunggu keputusan), <b>Keterangan</b> (kendala/catatan penting dari kunjungan), dan <b>PIC Garap</b> (nama yang melakukan visit).</p>
                </div>
            </div>
        </div>
    </div>

    <div class="step-card" style="border-left-color:#20c997;" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number" style="background:#20c997;">3</span>
                <div>
                    <h6 class="fw-bold mb-1">Kalau Belum Ada Sebagai Lead</h6>
                    <p class="text-muted small mb-0">Kunjungan dadakan yang belum tercatat sebagai lead (belum pernah di-blast)? Tambahkan dulu lewat tab <b>Input Manual</b> di Campaign Tracker sebelum update hasil visit-nya.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="step-card" style="border-left-color:#0dcaf0;" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number" style="background:#0dcaf0;">4</span>
                <div>
                    <h6 class="fw-bold mb-1">Rekap Mingguan ke Tim Data</h6>
                    <p class="text-muted small mb-0">Tim Data merekap hasil canvassing tiap area setiap minggu dari tab Dashboard Campaign Tracker (filter Area + Tahap) untuk evaluasi.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CATATAN AKHIR -->
    <div class="text-center mt-5 pb-3" data-aos="fade-up">
        <div style="background:white;border-radius:16px;padding:24px;border:1px solid rgba(115,53,183,0.15);display:inline-block;max-width:600px;">
            <i class="fas fa-quote-left fa-2x mb-3" style="color:var(--primary);opacity:0.3;"></i>
            <p class="fw-bold mb-1" style="font-size:1.05rem;">"Blast membuka pintu, canvassing yang meyakinkan."</p>
            <p class="text-muted small mb-0">— SOP Canvassing SIMASRIM</p>
        </div>
    </div>

</div>

<script>
// Export SOP (alur singkat + script canvassing) sebagai file Word — supaya bisa
// diteruskan ke Mitra Area (partner eksternal, bukan tim internal) tanpa perlu
// akses ke website ini. Section 2 (kartu editable internal) dan Section 4
// (instruksi update sistem internal) sengaja tidak diikutkan.
document.getElementById('btn-export-word')?.addEventListener('click', () => {
    const alurHtml = document.getElementById('section-alur-export').innerHTML;
    const scriptHtml = document.getElementById('section-script-export').innerHTML;
    const preHtml = `<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
        <head><meta charset='utf-8'><title>SOP Canvassing Mitra Area</title></head>
        <body style="font-family:Calibri,Arial,sans-serif;">
        <h1>SOP Canvassing Mitra Area</h1>
        <h2>Alur Kerja</h2>${alurHtml}
        <h2>Script Canvassing — Kunjungan Langsung</h2>${scriptHtml}
        </body></html>`;
    const blob = new Blob(['﻿', preHtml], { type: 'application/msword' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'SOP-Canvassing-Mitra-Area.doc';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
});

function copyPrompt(id, btn) {
    const el = document.getElementById(id);
    navigator.clipboard.writeText(el.textContent.trim()).then(() => {
        btn.innerHTML = '<i class="fas fa-check me-1"></i>Tersalin!';
        btn.classList.add('copied');
        setTimeout(() => {
            btn.innerHTML = '<i class="far fa-copy me-1"></i>Salin Prompt';
            btn.classList.remove('copied');
        }, 2000);
    });
}
</script>

<!-- PORTOFOLIO DEMO: Firebase SDK modular asli diganti mock lokal (localStorage), tidak connect ke server manapun -->
<script type="module">
    // Kartu "Target & Cara Kerja per Area" editable tanpa coding — simulasi localStorage
    // (versi asli simpan ke Firebase project simasrim-b2b-os, node canvassing_area_target/<slug>).
    import { initializeApp, getDatabase, ref, onValue, set, getAuth, signInAnonymously } from "./js/firebase-modular-mock.js";

    const firebaseConfig = {
        apiKey: "DUMMY-SECRET-GANTI-SENDIRI",
        authDomain: "demo-project.firebaseapp.com",
        databaseURL: "https://demo-project-default-rtdb.firebaseio.com",
        projectId: "demo-project",
        storageBucket: "demo-project.firebasestorage.app",
        messagingSenderId: "000000000000",
        appId: "1:000000000000:web:0000000000000000000000",
        measurementId: "G-DUMMY000000"
    };
    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);
    signInAnonymously(auth).catch(err => console.error("Auth failed", err));
    const db = getDatabase(app);

    document.querySelectorAll('#canvassing-area-cards .area-card').forEach(card => {
        const slug = card.dataset.slug;
        const viewEl = card.querySelector('.area-card-view');
        const editEl = card.querySelector('.area-card-edit');
        const textarea = card.querySelector('.area-edit-input');
        const badge = viewEl.querySelector('.badge-status');
        const desc = viewEl.querySelector('p');
        const areaRef = ref(db, 'canvassing_area_target/' + slug);

        onValue(areaRef, (snap) => {
            const val = snap.val() || '';
            textarea.value = val;
            if (val.trim()) {
                badge.textContent = 'Terisi';
                badge.classList.add('filled');
                badge.classList.remove('bg-secondary');
                desc.textContent = val;
            } else {
                badge.textContent = 'Target belum diisi';
                badge.classList.remove('filled');
                badge.classList.add('bg-secondary');
                desc.textContent = 'Lengkapi target koperasi/badan usaha dan cara kerja khusus area ini.';
            }
        });

        card.querySelector('.area-edit-btn').addEventListener('click', () => {
            viewEl.classList.add('d-none');
            editEl.classList.remove('d-none');
            textarea.focus();
        });
        card.querySelector('.area-cancel-btn').addEventListener('click', () => {
            editEl.classList.add('d-none');
            viewEl.classList.remove('d-none');
        });
        card.querySelector('.area-save-btn').addEventListener('click', () => {
            set(areaRef, textarea.value.trim());
            editEl.classList.add('d-none');
            viewEl.classList.remove('d-none');
        });
    });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
