<?php 
$page_title = "SOP Tim Internal | Monitoring & FU Mitra Area";
$footer_desc = "Dokumen Internal Tim SIMASRIM – Prosedur Operasional Standar Follow-Up Mitra Area.";
$base_path = '../'; include __DIR__ . '/../includes/header.php'; 
?>

<style>
    /* ---- STEP CARDS ---- */
    .step-card {
        background: #ffffff; border: 1px solid rgba(0,0,0,0.08);
        border-left: 5px solid var(--primary); border-radius: 16px;
        padding: 1.5rem; margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02); transition: transform 0.3s ease;
    }
    .step-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.05); }
    .step-header { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 14px; flex-wrap: wrap; }
    .step-number { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 50%; background: var(--primary); color: white; font-weight: 800; font-size: 0.85rem; flex-shrink: 0; }

    /* ---- PROMPT BOX ---- */
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

    /* ---- ROLE CARDS ---- */
    .role-card {
        border-radius: 16px; padding: 20px; height: 100%;
        border: 1.5px solid transparent; background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04); transition: 0.2s;
    }
    .role-card:hover { border-color: var(--primary); transform: translateY(-4px); }
    .role-icon { width: 50px; height: 50px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 14px; }

    /* ---- BTN COPY ---- */
    .btn-copy {
        background: rgba(115,53,183,0.1); color: var(--primary); border: none;
        border-radius: 8px; padding: 6px 14px; font-size: 0.8rem; font-weight: 700;
        cursor: pointer; transition: 0.2s; white-space: nowrap;
    }
    .btn-copy:hover { background: var(--primary); color: white; }
    .btn-copy.copied { background: #198754; color: white; }

    /* ---- WORKFLOW TIMELINE ---- */
    .workflow-step {
        display: flex; gap: 16px; margin-bottom: 20px; align-items: flex-start;
    }
    .workflow-icon {
        width: 40px; height: 40px; border-radius: 50%; background: var(--primary);
        color: white; display: flex; align-items: center; justify-content: center;
        font-size: 1rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(115,53,183,0.3);
    }
    .workflow-connector {
        width: 2px; height: 24px; background: #e9ecef; margin-left: 19px; margin-bottom: 0;
    }
    .workflow-body { flex: 1; padding-top: 6px; }
    .workflow-title { font-weight: 700; font-size: 0.95rem; margin-bottom: 4px; }
    .workflow-desc { font-size: 0.85rem; color: #64748b; line-height: 1.5; }

    /* ---- INFO BADGE ---- */
    .info-ribbon { background: linear-gradient(135deg, #7335B7, #5A2A8F); color: white; border-radius: 14px; padding: 16px 20px; margin-bottom: 28px; }
</style>

<!-- HERO -->
<section class="hero-section">
    <div class="container" data-aos="fade-up">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-bold mb-3 small">
            <i class="fas fa-lock me-1"></i> Internal Tim SIMASRIM
        </span>
        <h1 class="display-5 fw-bold text-white mb-2">SOP Monitoring & Follow-Up Mitra Area</h1>
        <p class="text-white-50 mb-4">Panduan operasional mingguan untuk tim CS/FU. Baca sekali, jalankan rutin.</p>
        <div class="d-flex gap-2 flex-wrap">
            <a href="info.php" class="btn btn-light rounded-pill px-4 fw-bold">
                <i class="fas fa-database me-2"></i>Buka Ref. Mitra
            </a>
            <a href="tracker.php" class="btn btn-outline-light rounded-pill px-4">
                <i class="fas fa-chart-line me-2"></i>Buka Tracker
            </a>
        </div>
    </div>
</section>

<div class="container followup-container py-5">

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 1: PERAN TIM                        -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="text-center mb-4" data-aos="fade-up">
        <h5 class="fw-bold text-primary text-uppercase" style="letter-spacing:2px;font-size:0.75rem;">Pembagian Peran</h5>
        <h2 class="fw-bold">Siapa Mengerjakan Apa?</h2>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="role-card">
                <div class="role-icon" style="background:rgba(115,53,183,0.1);">
                    <i class="fas fa-comments" style="color:var(--primary);"></i>
                </div>
                <h5 class="fw-bold mb-1">Winda</h5>
                <span class="badge rounded-pill mb-3" style="background:rgba(115,53,183,0.1);color:var(--primary);font-size:0.72rem;">CS / Follow-Up Mitra</span>
                <ul class="list-unstyled text-muted small" style="line-height:2;">
                    <li><i class="fas fa-check-circle text-success me-2"></i><b>Senin pagi:</b> FU kendala & progres</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i><b>Jumat:</b> Motivasi + update data</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Gunakan Ref. Mitra + Gemini AI</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Log hasil FU ke sistem</li>
                </ul>
                <a href="info.php" class="btn btn-sm w-100 rounded-pill mt-2 fw-bold" style="background:var(--primary);color:white;border:none;">
                    <i class="fas fa-play me-1"></i> Mulai dari sini
                </a>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="role-card">
                <div class="role-icon" style="background:rgba(243,112,13,0.1);">
                    <i class="fas fa-paint-brush" style="color:#F3700D;"></i>
                </div>
                <h5 class="fw-bold mb-1">Dinda</h5>
                <span class="badge rounded-pill mb-3" style="background:rgba(243,112,13,0.1);color:#F3700D;font-size:0.72rem;">Administrasi & Kreatif</span>
                <ul class="list-unstyled text-muted small" style="line-height:2;">
                    <li><i class="fas fa-check-circle text-success me-2"></i>Siapkan NDA, Penunjukan, Adendum
                        (<a href="#" target="_blank" class="text-decoration-none">Template NDA Mitra Area</a>)</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Update info mitra di Ref. Mitra</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Kirim amunisi marketing (flyer, SOP)</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Update riwayat setelah meeting/chat</li>
                </ul>
                <a href="prosedur.php" class="btn btn-sm w-100 rounded-pill mt-2 fw-bold" style="background:#F3700D;color:white;border:none;">
                    <i class="fas fa-list me-1"></i> Lihat Amunisi
                </a>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="role-card">
                <div class="role-icon" style="background:rgba(32,201,151,0.1);">
                    <i class="fas fa-chart-bar" style="color:#20c997;"></i>
                </div>
                <h5 class="fw-bold mb-1">Raka</h5>
                <span class="badge rounded-pill mb-3" style="background:rgba(32,201,151,0.1);color:#20c997;font-size:0.72rem;">Data & Bantu CS</span>
                <ul class="list-unstyled text-muted small" style="line-height:2;">
                    <li><i class="fas fa-check-circle text-success me-2"></i>Pantau data Tracker tiap Senin</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Rekonsiliasi data 2x per bulan</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Support Winda jika ada pertanyaan data</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Laporan rekap ke Mba Sinta</li>
                </ul>
                <a href="tracker.php" class="btn btn-sm w-100 rounded-pill mt-2 fw-bold" style="background:#20c997;color:white;border:none;">
                    <i class="fas fa-chart-line me-1"></i> Buka Tracker
                </a>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 2: ALUR KERJA SENIN                 -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="info-ribbon d-flex align-items-center gap-3 mb-3" data-aos="fade-up">
        <i class="fas fa-calendar-week fa-2x opacity-75"></i>
        <div>
            <div class="fw-bold fs-5">⚙️ Alur Kerja Senin Pagi — Winda</div>
            <div class="small opacity-75">Kendala + Progres Ditanyakan | Estimasi waktu: 30–45 menit</div>
        </div>
    </div>

    <div class="step-card" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number">1</span>
                <div>
                    <h6 class="fw-bold mb-1">Buka Ref. Mitra & Tracker</h6>
                    <p class="text-muted small mb-0">Buka <a href="info.php" class="text-primary fw-bold">info.php</a> → pilih area mitra → perhatikan <b>kotak FU (merah/kuning = harus FU hari ini)</b>. Lalu cross-check dengan <a href="tracker.php" class="text-primary fw-bold">tracker.php</a> untuk lihat tahapan onboarding terakhir.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="step-card" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number">2</span>
                <div>
                    <h6 class="fw-bold mb-1">Identifikasi Konteks Terbaru</h6>
                    <p class="text-muted small mb-2">Di halaman mitra, baca <b>"Riwayat Detail"</b> (tab kiri) — fokus 2 entri teratas. Baca juga <b>"Catatan FU"</b> di kotak jadwal. Ini adalah bahan untuk generate pesan.</p>
                    <div style="background:#f8f9fa;border-radius:10px;padding:12px 14px;font-size:0.82rem;border-left:3px solid #ffc107;">
                        <b>🔑 Aturan Emas:</b> Jangan hanya tanya "gimana progresnya?" — bawa <b>solusi atau umpan</b> berdasarkan konteks terakhir.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="step-card" style="border-left-color:#F3700D;" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number" style="background:#F3700D;">3</span>
                <div style="flex:1;">
                    <h6 class="fw-bold mb-1">Generate Prompt AI → Kirim ke Gemini</h6>
                    <p class="text-muted small mb-2">Klik tombol <span class="badge" style="background:var(--primary);color:white;font-size:0.75rem;"><i class="fas fa-robot me-1"></i>Generate Prompt AI</span> di halaman mitra → pilih tipe Senin → salin prompt → paste ke Gemini → hasilnya template WA siap kirim.</p>
                    <a href="https://gemini.google.com" target="_blank" class="btn btn-sm rounded-pill px-3 fw-bold" style="background:#4285f4;color:white;border:none;font-size:0.78rem;">
                        <i class="fas fa-external-link-alt me-1"></i> Buka Google Gemini
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="step-card" style="border-left-color:#20c997;" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number" style="background:#20c997;">4</span>
                <div>
                    <h6 class="fw-bold mb-1">Kirim ke Grup WA + Log Hasilnya</h6>
                    <p class="text-muted small mb-0">Kirim pesan hasil AI ke grup WA mitra. Setelah terkirim, kembali ke <a href="info.php" class="text-primary fw-bold">Ref. Mitra</a> → tab <b>"Log FU"</b> → klik <b>"Log FU Selesai"</b> → isi tanggal, siapa yang FU, ringkasan aksi, dan respon mitra (jika langsung ada).</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 3: ALUR KERJA JUMAT                 -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="info-ribbon d-flex align-items-center gap-3 mt-4 mb-3" style="background:linear-gradient(135deg,#0f766e,#0e6960);" data-aos="fade-up">
        <i class="fas fa-fire fa-2x opacity-75"></i>
        <div>
            <div class="fw-bold fs-5">🔥 Alur Kerja Jumat — Winda</div>
            <div class="small opacity-75">Motivasi + 2x/bulan: sertakan rekap data dari Raka | Estimasi: 20 menit</div>
        </div>
    </div>

    <div class="step-card" style="border-left-color:#20c997;" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number" style="background:#20c997;">1</span>
                <div>
                    <h6 class="fw-bold mb-1">Cek Perkembangan Positif Minggu Ini</h6>
                    <p class="text-muted small mb-0">Buka Tracker → lihat ada mitra yang naik tahap? Ada yang baru top-up atau closing user baru? Data positif ini jadi bahan motivasi yang konkret. Kalau pekan ke-2 atau ke-4 bulan ini, minta <b>Raka kirim data rekonsiliasi</b> terlebih dahulu.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="step-card" style="border-left-color:#20c997;" data-aos="fade-up">
        <div class="step-header">
            <div class="d-flex gap-3 align-items-start">
                <span class="step-number" style="background:#20c997;">2</span>
                <div style="flex:1;">
                    <h6 class="fw-bold mb-1">Generate Prompt Jumat → Kirim & Log</h6>
                    <p class="text-muted small mb-2">Di <a href="info.php" class="text-primary fw-bold">Ref. Mitra</a> → klik <b>Generate Prompt AI</b> → pilih <b>Jumat (Motivasi)</b> → salin ke Gemini → kirim WA → log di sistem. Pesan Jumat lebih pendek dan energik.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 4: LIBRARY PROMPT AI                -->
    <!-- ═══════════════════════════════════════════ -->
    <hr class="my-5" style="border: 2px dashed #e9ecef;">
    <div class="text-center mb-4" data-aos="fade-up">
        <h5 class="fw-bold text-primary text-uppercase" style="letter-spacing:2px;font-size:0.75rem;">Referensi Prompt</h5>
        <h2 class="fw-bold">Library Prompt AI — Contoh & Referensi</h2>
        <p class="text-muted">Template prompt ini untuk referensi. Untuk penggunaan nyata, pakai tombol <strong>Generate Prompt AI</strong> di halaman masing-masing mitra (sudah auto-isi konteks).</p>
    </div>

    <!-- PROMPT 1: SENIN -->
    <div class="step-card" data-aos="fade-up">
        <div class="step-header">
            <div>
                <span class="badge bg-danger mb-1">Senin — Kendala & Progres</span>
                <h5 class="fw-bold mb-0">Prompt 1: FU Rutin Senin Pagi</h5>
            </div>
            <button class="btn-copy" onclick="copyPrompt('p1', this)"><i class="far fa-copy me-1"></i>Salin Prompt</button>
        </div>
        <p class="text-muted small">Gunakan saat: FU mingguan Senin, minta update kendala dan progres dari mitra.</p>
        <div class="prompt-box">
<span class="prompt-label">Prompt → Gemini</span>=== KONTEKS ===
Area: <span class="prompt-highlight">[Nama Area, cth: Medan 4 (MES-4)]</span>
PIC: <span class="prompt-highlight">[Nama PIC]</span>
Status: <span class="prompt-highlight">[Status saat ini, cth: Operasional Aktif]</span>
Catatan penting: <span class="prompt-highlight">[Salin dari kolom "Catatan Khusus" di Ref. Mitra]</span>
Riwayat terakhir: <span class="prompt-highlight">[Salin 1-2 entri riwayat terbaru]</span>

=== INSTRUKSI ===
<span class="prompt-instruction">Buatkan pesan WhatsApp untuk FU SENIN PAGI ke Mitra Area SIMASRIM ini.
Tujuan: Tanyakan kendala aktif, bawa solusi konkret, minta update progres.
Jangan terkesan menagih — posisikan kita sebagai mitra akselerasi mereka.
Tone: Santai tapi profesional (B2B level). Format: siap kirim WA (*bold* dan _italic_).
Panjang: 6-8 kalimat. Buka dengan sapaan hangat → isi solutif → tutup dengan pertanyaan/CTA spesifik.</span></div>
        <pre id="p1" class="d-none">=== KONTEKS ===
Area: [Nama Area, cth: Medan 4 (MES-4)]
PIC: [Nama PIC]
Status: [Status saat ini, cth: Operasional Aktif]
Catatan penting: [Salin dari kolom "Catatan Khusus" di Ref. Mitra]
Riwayat terakhir: [Salin 1-2 entri riwayat terbaru]

=== INSTRUKSI ===
Buatkan pesan WhatsApp untuk FU SENIN PAGI ke Mitra Area SIMASRIM ini.
Tujuan: Tanyakan kendala aktif, bawa solusi konkret, minta update progres.
Jangan terkesan menagih — posisikan kita sebagai mitra akselerasi mereka.
Tone: Santai tapi profesional (B2B level). Format: siap kirim WA (*bold* dan _italic_).
Panjang: 6-8 kalimat. Buka dengan sapaan hangat → isi solutif → tutup dengan pertanyaan/CTA spesifik.</pre>
        <a href="https://gemini.google.com" target="_blank" class="btn btn-sm rounded-pill px-3 mt-3 fw-bold" style="background:#4285f4;color:white;border:none;font-size:0.78rem;">
            <i class="fas fa-external-link-alt me-1"></i> Buka Gemini
        </a>
    </div>

    <!-- PROMPT 2: JUMAT -->
    <div class="step-card" style="border-left-color:#20c997;" data-aos="fade-up">
        <div class="step-header">
            <div>
                <span class="badge bg-success mb-1">Jumat — Motivasi</span>
                <h5 class="fw-bold mb-0">Prompt 2: Motivasi Mingguan Jumat</h5>
            </div>
            <button class="btn-copy" onclick="copyPrompt('p2', this)"><i class="far fa-copy me-1"></i>Salin Prompt</button>
        </div>
        <p class="text-muted small">Gunakan saat: FU Jumat, fokus menyemangati dan mengingatkan potensi yang belum dioptimalkan.</p>
        <div class="prompt-box">
<span class="prompt-label">Prompt → Gemini</span>=== KONTEKS ===
Area: <span class="prompt-highlight">[Nama Area]</span>
PIC: <span class="prompt-highlight">[Nama PIC]</span>
Sudah berjalan: <span class="prompt-highlight">[Berapa pekan / bulan sejak onboarding]</span>
Progress positif minggu ini: <span class="prompt-highlight">[cth: sudah ada 5 user terdaftar, baru closing 1 TJS baru, dsb.]</span>
Potensi yang belum dioptimalkan: <span class="prompt-highlight">[cth: rekrut nasional via TikTok, B2B ke instansi, dsb.]</span>

=== INSTRUKSI ===
<span class="prompt-instruction">Buatkan pesan WhatsApp MOTIVASI JUMAT untuk Mitra Area SIMASRIM ini.
Tone: Hangat, semangat, seperti rekan bisnis yang peduli — bukan seperti atasan menagih laporan.
Highlight progress positif yang sudah dicapai, lalu ingatkan potensi yang masih bisa dikejar.
Format: siap kirim WA (*bold* dan _italic_). Panjang: 5-6 kalimat, energik dan singkat.</span></div>
        <pre id="p2" class="d-none">=== KONTEKS ===
Area: [Nama Area]
PIC: [Nama PIC]
Sudah berjalan: [Berapa pekan / bulan sejak onboarding]
Progress positif minggu ini: [cth: sudah ada 5 user terdaftar, baru closing 1 TJS baru, dsb.]
Potensi yang belum dioptimalkan: [cth: rekrut nasional via TikTok, B2B ke instansi, dsb.]

=== INSTRUKSI ===
Buatkan pesan WhatsApp MOTIVASI JUMAT untuk Mitra Area SIMASRIM ini.
Tone: Hangat, semangat, seperti rekan bisnis yang peduli — bukan seperti atasan menagih laporan.
Highlight progress positif yang sudah dicapai, lalu ingatkan potensi yang masih bisa dikejar.
Format: siap kirim WA (*bold* dan _italic_). Panjang: 5-6 kalimat, energik dan singkat.</pre>
        <a href="https://gemini.google.com" target="_blank" class="btn btn-sm rounded-pill px-3 mt-3 fw-bold" style="background:#4285f4;color:white;border:none;font-size:0.78rem;">
            <i class="fas fa-external-link-alt me-1"></i> Buka Gemini
        </a>
    </div>

    <!-- PROMPT 3: RE-ENGAGEMENT -->
    <div class="step-card" style="border-left-color:#ffc107;" data-aos="fade-up">
        <div class="step-header">
            <div>
                <span class="badge bg-warning text-dark mb-1">Re-engagement — Mitra Tidak Responsif</span>
                <h5 class="fw-bold mb-0">Prompt 3: Mitra Sudah Lama Diam</h5>
            </div>
            <button class="btn-copy" onclick="copyPrompt('p3', this)"><i class="far fa-copy me-1"></i>Salin Prompt</button>
        </div>
        <p class="text-muted small">Gunakan saat: mitra tidak merespons selama lebih dari 2 pekan. Jangan langsung komplen, buka dialog dulu.</p>
        <div class="prompt-box">
<span class="prompt-label">Prompt → Gemini</span>=== KONTEKS ===
Area: <span class="prompt-highlight">[Nama Area]</span>
PIC: <span class="prompt-highlight">[Nama PIC]</span>
Tidak merespons sejak: <span class="prompt-highlight">[tanggal terakhir interaksi]</span>
Konteks interaksi terakhir: <span class="prompt-highlight">[apa yang terakhir dibahas / diminta]</span>
Status onboarding: <span class="prompt-highlight">[sudah di tahap mana, apa yang masih pending]</span>

=== INSTRUKSI ===
<span class="prompt-instruction">Buatkan pesan WhatsApp RE-ENGAGEMENT untuk mitra yang sudah lama tidak responsif.
Jangan terkesan menekan atau menagih. Buka dialog kembali dengan empati.
Tawarkan bantuan konkret atau alternatif agar progres bisa lanjut.
Tone: Ringan, hangat, tidak formal. Format: siap kirim WA (*bold* dan _italic_).
Panjang: 4-5 kalimat. Tutup dengan pertanyaan ringan yang mudah dijawab "ya/tidak".</span></div>
        <pre id="p3" class="d-none">=== KONTEKS ===
Area: [Nama Area]
PIC: [Nama PIC]
Tidak merespons sejak: [tanggal terakhir interaksi]
Konteks interaksi terakhir: [apa yang terakhir dibahas / diminta]
Status onboarding: [sudah di tahap mana, apa yang masih pending]

=== INSTRUKSI ===
Buatkan pesan WhatsApp RE-ENGAGEMENT untuk mitra yang sudah lama tidak responsif.
Jangan terkesan menekan atau menagih. Buka dialog kembali dengan empati.
Tawarkan bantuan konkret atau alternatif agar progres bisa lanjut.
Tone: Ringan, hangat, tidak formal. Format: siap kirim WA (*bold* dan _italic_).
Panjang: 4-5 kalimat. Tutup dengan pertanyaan ringan yang mudah dijawab "ya/tidak".</pre>
        <a href="https://gemini.google.com" target="_blank" class="btn btn-sm rounded-pill px-3 mt-3 fw-bold" style="background:#4285f4;color:white;border:none;font-size:0.78rem;">
            <i class="fas fa-external-link-alt me-1"></i> Buka Gemini
        </a>
    </div>

    <!-- CATATAN AKHIR -->
    <div class="text-center mt-5 pb-3" data-aos="fade-up">
        <div style="background:white;border-radius:16px;padding:24px;border:1px solid rgba(115,53,183,0.15);display:inline-block;max-width:600px;">
            <i class="fas fa-quote-left fa-2x mb-3" style="color:var(--primary);opacity:0.3;"></i>
            <p class="fw-bold mb-1" style="font-size:1.05rem;">"Kita adalah mitra akselerasi mereka, bukan sekadar penagih tugas."</p>
            <p class="text-muted small mb-0">— SOP Rutin SIMASRIM</p>
        </div>
    </div>

</div>

<script>
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

<?php include __DIR__ . '/../includes/footer.php'; ?>
