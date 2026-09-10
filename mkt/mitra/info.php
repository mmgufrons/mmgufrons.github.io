<?php
$page_title = "Pusat Referensi Mitra | SIMASRIM";
$footer_desc = "Database lengkap riwayat kontak, jadwal FU, kendala, dan strategi per Mitra Area.";
$base_path = '../'; include '../includes/header.php';
?>
<style>
        :root {
            --primary: #7335B7;
            --primary-dark: #5A2A8F;
            --primary-soft: #f3effa;
            --accent: #F3700D;
            --wa-green: #25D366;
            --text-main: #1e1e2f;
            --text-muted: #64748b;
            --border-light: rgba(115, 53, 183, 0.12);
            --shadow-sm: 0 4px 15px rgba(0,0,0,0.04);
            --shadow-md: 0 8px 25px rgba(115,53,183,0.12);
        }
        body { background: #f0f2f5; font-family: 'Plus Jakarta Sans', sans-serif; color: var(--text-main); }

        /* ---- HERO ---- */
        .hero-ref { 
            background: radial-gradient(circle at top right, #3A1B5E, #1F0D3D, #0f0c29);
            padding: 80px 0 40px; color: white; 
        }

        /* ---- SIDEBAR ---- */
        .sidebar-card { 
            border-radius: 16px; border: 1px solid var(--border-light); 
            background: white; box-shadow: var(--shadow-sm);
        }
        .mitra-nav-btn {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px; border-radius: 10px; border: none;
            background: transparent; color: var(--text-main);
            font-weight: 600; font-size: 0.88rem; width: 100%;
            text-align: left; transition: all 0.2s; cursor: pointer;
            position: relative;
        }
        .mitra-nav-btn:hover { background: var(--primary-soft); color: var(--primary); }
        .mitra-nav-btn.active { background: var(--primary); color: white; box-shadow: 0 4px 12px rgba(115,53,183,0.3); }
        .mitra-nav-btn .fu-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: #dc3545; margin-left: auto; flex-shrink: 0;
            animation: pulse 1.5s infinite;
        }
        .mitra-nav-btn .fu-dot.warning { background: #ffc107; }
        .mitra-nav-btn .fu-dot.ok { background: #20c997; animation: none; }
        @keyframes pulse { 0%,100%{ opacity:1; } 50%{ opacity:0.4; } }

        /* ---- MAIN CARD ---- */
        .mitra-card { background: white; border-radius: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); }

        /* ---- FU BOX ---- */
        .fu-box {
            border-radius: 14px; padding: 18px 20px; margin-bottom: 20px;
            display: flex; align-items: flex-start; gap: 15px;
            border: 1.5px solid transparent;
        }
        .fu-box.fu-danger { background: #fff5f5; border-color: #f5c2c7; }
        .fu-box.fu-warning { background: #fffbf0; border-color: #fde68a; }
        .fu-box.fu-ok { background: #f0faf6; border-color: #a7f3d0; }
        .fu-icon { font-size: 1.8rem; flex-shrink: 0; }
        .fu-box.fu-danger .fu-icon { color: #dc3545; }
        .fu-box.fu-warning .fu-icon { color: #f59e0b; }
        .fu-box.fu-ok .fu-icon { color: #10b981; }
        .fu-label { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6; }
        .fu-date { font-size: 1.1rem; font-weight: 700; margin: 2px 0; }
        .fu-note { font-size: 0.85rem; color: var(--text-muted); line-height: 1.5; }
        .fu-by-badge { font-size: 0.75rem; background: rgba(0,0,0,0.06); padding: 3px 10px; border-radius: 20px; font-weight: 600; display: inline-block; margin-top: 6px; }

        /* ---- HISTORY ITEMS ---- */
        .history-item { 
            border-left: 3px solid var(--primary); 
            padding: 12px 15px; margin-bottom: 12px;
            background: #f8f9fa; border-radius: 0 10px 10px 0;
            position: relative; transition: 0.2s;
        }
        .history-item:hover { background: var(--primary-soft); }
        .history-date-label { font-size: 0.75rem; color: var(--text-muted); font-weight: 700; margin-bottom: 4px; display: block; }
        .history-item .btn-delete-history {
            position: absolute; top: 8px; right: 10px;
            background: none; border: none; color: #ccc; font-size: 0.85rem;
            cursor: pointer; padding: 2px 6px; border-radius: 6px; transition: 0.2s; display: none;
        }
        .history-item:hover .btn-delete-history { display: block; }
        .history-item .btn-delete-history:hover { color: #dc3545; background: #fff0f0; }

        /* ---- FU HISTORY ITEMS ---- */
        .fu-hist-item {
            background: #fff; border: 1px solid #e9ecef; border-radius: 12px;
            padding: 14px 16px; margin-bottom: 10px; position: relative; transition: 0.2s;
        }
        .fu-hist-item:hover { border-color: var(--primary); }
        .fu-hist-date { font-size: 0.75rem; font-weight: 700; color: var(--primary); margin-bottom: 5px; }
        .fu-hist-summary { font-size: 0.85rem; color: var(--text-main); margin-bottom: 4px; }
        .fu-hist-response { font-size: 0.82rem; color: var(--text-muted); font-style: italic; }
        .fu-hist-item .btn-delete-fu {
            position: absolute; top: 8px; right: 10px;
            background: none; border: none; color: #ccc;
            cursor: pointer; padding: 2px 6px; border-radius: 6px; transition: 0.2s; display: none;
        }
        .fu-hist-item:hover .btn-delete-fu { display: block; }
        .fu-hist-item .btn-delete-fu:hover { color: #dc3545; background: #fff0f0; }

        /* ---- EDIT FORMS ---- */
        .edit-form-section { 
            background: var(--primary-soft); border-radius: 14px; 
            padding: 20px; margin-bottom: 20px; display: none;
            border: 1.5px solid rgba(115,53,183,0.2);
        }
        .edit-form-section.show { display: block; }
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .section-title { font-weight: 700; font-size: 0.95rem; color: var(--primary); }
        .btn-toggle-edit { 
            background: none; border: 1.5px solid var(--primary); color: var(--primary);
            border-radius: 8px; padding: 4px 14px; font-size: 0.8rem; font-weight: 700;
            cursor: pointer; transition: 0.2s;
        }
        .btn-toggle-edit:hover, .btn-toggle-edit.active { background: var(--primary); color: white; }

        /* ---- BUTTONS ---- */
        .btn-primary-custom { background: var(--primary); border: none; color: white; border-radius: 10px; padding: 8px 20px; font-weight: 700; font-size: 0.85rem; transition: 0.2s; cursor: pointer; }
        .btn-primary-custom:hover { background: var(--primary-dark); }
        .btn-danger-custom { background: #dc3545; border: none; color: white; border-radius: 10px; padding: 8px 20px; font-weight: 700; font-size: 0.85rem; transition: 0.2s; cursor: pointer; }
        .btn-secondary-custom { background: #6c757d; border: none; color: white; border-radius: 10px; padding: 8px 16px; font-weight: 600; font-size: 0.85rem; cursor: pointer; }

        /* ---- MODAL ---- */
        .modal-confirm .modal-content { border-radius: 20px; border: none; }
        .modal-confirm .modal-header { background: var(--primary); color: white; border-radius: 20px 20px 0 0; }
        .modal-confirm .modal-header.danger { background: #dc3545; }
        .modal-confirm .modal-footer { border-top: 1px solid #f0f0f0; }

        /* ---- PRINT ZONE ---- */
        @media print {
            .no-print, nav, .sidebar-card, .hero-ref, .btn-toggle-edit, 
            .btn-delete-history, .btn-delete-fu, .edit-form-section { display: none !important; }
            .mitra-card { box-shadow: none; border: none; }
            body { background: white; }
        }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 767px) {
            .hero-ref { padding: 60px 0 30px; }
            .mitra-card { border-radius: 14px; }
        }

        /* ---- SECTION DIVIDER ---- */
        .section-divider { border: none; border-top: 2px dashed #e9ecef; margin: 24px 0; }

        /* ---- TABS ---- */
        .detail-tabs .nav-link { color: var(--text-muted); font-weight: 600; font-size: 0.85rem; padding: 8px 16px; border-radius: 8px; border: none; }
        .detail-tabs .nav-link.active { background: var(--primary); color: white; }
        .detail-tabs .nav-link:hover:not(.active) { background: var(--primary-soft); color: var(--primary); }
    </style>

<!-- HERO -->
<section class="hero-section no-print">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3" data-aos="fade-up">
            <div>
                <h1 class="fw-bold mb-2 text-white"><i class="fas fa-database me-2" style="color:#F3700D;"></i>Pusat Referensi Mitra Area</h1>
                <p class="mb-0 text-white-50">Database lengkap: riwayat kontak, jadwal FU, kendala, dan strategi per Area — editable oleh tim CS tanpa coding.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold" onclick="openAddMitraModal()">
                    <i class="fas fa-plus me-1"></i> Tambah Area
                </button>
                <a href="tracker.php" class="btn btn-outline-light btn-sm rounded-pill px-3">
                    <i class="fas fa-arrow-left me-1"></i> Tracker
                </a>
            </div>
        </div>
    </div>
</section>

<!-- MAIN LAYOUT -->
<div class="container py-4 pb-5">
    <div class="row g-4">
        <!-- SIDEBAR -->
        <div class="col-md-3">
            <div class="sidebar-card p-3 sticky-top" style="top: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-muted mb-0" style="font-size:0.75rem;letter-spacing:1px;">PILIH AREA</h6>
                    <span id="sidebarCount" class="badge" style="background:var(--primary-soft);color:var(--primary);font-size:0.7rem;">...</span>
                </div>
                <div id="sidebarNav"></div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="col-md-9">
            <!-- Loading State -->
            <div id="loadingState" class="text-center py-5">
                <div class="spinner-border" style="color:var(--primary);" role="status"></div>
                <p class="mt-3 text-muted">Memuat data referensi...</p>
            </div>
            <!-- Content Area -->
            <div id="contentArea" style="display:none;"></div>
        </div>
    </div>
</div>

<!-- ========== MODALS ========== -->

<!-- Modal: Konfirmasi Save -->
<div class="modal fade modal-confirm" id="modalSave" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-save me-2"></i>Konfirmasi Simpan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalSaveBody">Yakin menyimpan perubahan?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" id="btnConfirmSave" style="background:var(--primary);border-color:var(--primary);">
                    <i class="fas fa-check me-1"></i> Ya, Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Konfirmasi Delete -->
<div class="modal fade modal-confirm" id="modalDelete" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header danger" style="background:#dc3545;">
                <h5 class="modal-title text-white"><i class="fas fa-trash me-2"></i>Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalDeleteBody">Yakin menghapus item ini? Aksi tidak dapat dibatalkan.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger" id="btnConfirmDelete"><i class="fas fa-trash me-1"></i> Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Tambah Mitra Baru -->
<div class="modal fade modal-confirm" id="modalAddMitra" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Area Mitra Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold small">ID Unik Area <span class="text-danger">*</span></label>
                        <input type="text" id="newMitraId" class="form-control" placeholder="cth: sby2, jkt, bdo">
                        <div class="form-text">Huruf kecil, tanpa spasi</div>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold small">Label Area <span class="text-danger">*</span></label>
                        <input type="text" id="newMitraLabel" class="form-control" placeholder="cth: Surabaya 2 (SBY2)">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Nama PIC</label>
                        <input type="text" id="newMitraPic" class="form-control" placeholder="Nama lengkap PIC">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Status</label>
                        <select id="newMitraStatus" class="form-select">
                            <option value="Administrasi">Administrasi</option>
                            <option value="Persiapan Canvassing">Persiapan Canvassing</option>
                            <option value="Operasional Aktif">Operasional Aktif</option>
                            <option value="Migrasi & Akselerasi">Migrasi & Akselerasi</option>
                            <option value="B2B Canvassing">B2B Canvassing</option>
                            <option value="Baru">Baru</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold small">Tanggal FU Terdekat</label>
                        <input type="date" id="newMitraFuDate" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold small">Catatan FU</label>
                        <textarea id="newMitraFuNote" class="form-control" rows="2" placeholder="Apa yang perlu di-FU..."></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold small">Catatan Khusus</label>
                        <textarea id="newMitraCatatan" class="form-control" rows="2" placeholder="Informasi penting tentang mitra ini..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" onclick="submitNewMitra()" style="background:var(--primary);border-color:var(--primary);">
                    <i class="fas fa-plus me-1"></i> Tambah Area
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Hapus Mitra -->
<div class="modal fade modal-confirm" id="modalDeleteMitra" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background:#dc3545;">
                <h5 class="modal-title text-white"><i class="fas fa-exclamation-triangle me-2"></i>Hapus Area Mitra</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="deleteMitraWarning" class="text-danger fw-bold mb-3"></p>
                <p class="text-muted small">Ketik nama area di bawah untuk konfirmasi:</p>
                <input type="text" id="deleteMitraConfirmInput" class="form-control" placeholder="Ketik label area...">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger" id="btnConfirmDeleteMitra" disabled>Hapus Area</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Generate Prompt AI -->
<div class="modal fade modal-confirm" id="modalGeneratePrompt" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:20px;">
            <div class="modal-header" style="background:linear-gradient(135deg,#7335B7,#5A2A8F);border-radius:20px 20px 0 0;">
                <div>
                    <h5 class="modal-title text-white mb-0"><i class="fas fa-robot me-2"></i>Generate Prompt AI</h5>
                    <div class="text-white-50 small" id="promptMitraLabel">— Mitra Area</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex gap-2 mb-3 flex-wrap">
                    <button class="btn btn-sm rounded-pill fw-bold px-3" id="ptypeSenin" onclick="selectPromptType('senin')" style="background:#7335B7;color:white;border:none;">📅 Senin — Kendala</button>
                    <button class="btn btn-sm rounded-pill fw-bold px-3" id="ptypeJumat" onclick="selectPromptType('jumat')" style="background:#e9ecef;color:#333;border:none;">🔥 Jumat — Motivasi</button>
                    <button class="btn btn-sm rounded-pill fw-bold px-3" id="ptypeReeng" onclick="selectPromptType('reengagement')" style="background:#e9ecef;color:#333;border:none;">🔔 Re-engagement</button>
                </div>
                <div style="background:#f3effa;border-radius:10px;padding:10px 14px;font-size:0.82rem;color:#5A2A8F;margin-bottom:14px;">
                    <i class="fas fa-info-circle me-1"></i> Salin prompt ini → paste ke
                    <a href="https://gemini.google.com" target="_blank" class="fw-bold text-decoration-none">Google Gemini</a>
                    → hasilnya template WA siap kirim ke grup mitra.
                </div>
                <textarea id="generatedPromptText" class="form-control" rows="14" style="font-family:monospace;font-size:0.8rem;background:#0f0c29;color:#e8e8f0;border:1px solid rgba(115,53,183,0.3);border-radius:12px;resize:none;line-height:1.7;" readonly></textarea>
            </div>
            <div class="modal-footer" style="border-top:1px solid #f0f0f0;">
                <a href="https://gemini.google.com" target="_blank" class="btn btn-sm rounded-pill px-3 fw-bold" style="background:#4285f4;color:white;border:none;">
                    <i class="fas fa-external-link-alt me-1"></i>Buka Gemini
                </a>
                <button class="btn btn-sm rounded-pill px-4 fw-bold" id="btnCopyGeneratedPrompt" onclick="copyGeneratedPrompt()" style="background:#7335B7;color:white;border:none;">
                    <i class="fas fa-copy me-1"></i>Salin Prompt
                </button>
                <button class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index:9999">
    <div id="toastMsg" class="toast align-items-center text-white border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body" id="toastBody"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
// ======================================================
// STATE
// ======================================================
let allMitras = [];
let activeMitraId = null;
let pendingAction = null;

// ======================================================
// INIT
// ======================================================
document.addEventListener('DOMContentLoaded', () => {
    loadData();
});

function loadData() {
    // Akan dimuat oleh Firebase di bagian bawah script
    document.getElementById('loadingState').innerHTML = '<div class="spinner-border text-primary" role="status"></div><div class="mt-2 text-primary fw-bold">Sinkronisasi Firebase...</div>';
}

// ======================================================
// SIDEBAR
// ======================================================
function renderSidebar() {
    const nav = document.getElementById('sidebarNav');
    document.getElementById('sidebarCount').textContent = allMitras.length + ' area';
    nav.innerHTML = allMitras.map(m => {
        const fuStatus = getFuStatus(m.next_fu_date);
        const dotClass = fuStatus === 'danger' ? '' : fuStatus === 'warning' ? 'warning' : 'ok';
        return `<button class="mitra-nav-btn mb-1" id="nav-${m.id}" onclick="switchMitra('${m.id}')">
            <i class="fas fa-map-marker-alt" style="color:var(--primary);width:14px;"></i>
            <span style="flex:1;">${m.label}</span>
            <span class="fu-dot ${dotClass}" title="Jadwal FU: ${m.next_fu_date || 'Belum diset'}"></span>
        </button>`;
    }).join('');
}

function switchMitra(id) {
    activeMitraId = id;
    // Update nav active state
    document.querySelectorAll('.mitra-nav-btn').forEach(b => b.classList.remove('active'));
    const btn = document.getElementById('nav-' + id);
    if (btn) btn.classList.add('active');
    // Render content
    const mitra = allMitras.find(m => m.id === id);
    if (mitra) renderMitraContent(mitra);
}

// ======================================================
// FU STATUS HELPER
// ======================================================
function getFuStatus(dateStr) {
    if (!dateStr) return 'ok';
    const today = new Date(); today.setHours(0,0,0,0);
    const fu = new Date(dateStr); fu.setHours(0,0,0,0);
    const diff = Math.ceil((fu - today) / (1000 * 60 * 60 * 24));
    if (diff < 0) return 'danger';
    if (diff <= 3) return 'warning';
    return 'ok';
}

function formatDate(dateStr) {
    if (!dateStr) return '-';
    const d = new Date(dateStr);
    return d.toLocaleDateString('id-ID', { weekday:'long', day:'numeric', month:'long', year:'numeric' });
}

function fuDaysText(dateStr) {
    if (!dateStr) return '';
    const today = new Date(); today.setHours(0,0,0,0);
    const fu = new Date(dateStr); fu.setHours(0,0,0,0);
    const diff = Math.ceil((fu - today) / (1000 * 60 * 60 * 24));
    if (diff < 0) return `<span class="badge bg-danger ms-2">${Math.abs(diff)} hari lewat!</span>`;
    if (diff === 0) return `<span class="badge bg-warning text-dark ms-2">Hari ini!</span>`;
    if (diff <= 3) return `<span class="badge bg-warning text-dark ms-2">${diff} hari lagi</span>`;
    return `<span class="badge bg-success ms-2">${diff} hari lagi</span>`;
}

// ======================================================
// RENDER MITRA CONTENT
// ======================================================
function renderMitraContent(m) {
    const fuStatus = getFuStatus(m.next_fu_date);
    const fuBoxClass = 'fu-' + fuStatus;
    const fuIcon = fuStatus === 'danger' ? 'fa-fire' : fuStatus === 'warning' ? 'fa-bell' : 'fa-calendar-check';
    const fuLabel = fuStatus === 'danger' ? '⚠️ FU TERLAMBAT!' : fuStatus === 'warning' ? '🔔 Segera FU' : '📅 Jadwal FU Berikutnya';

    const badgeColors = { success:'#198754', primary:'#7335B7', warning:'#f59e0b', secondary:'#6c757d', danger:'#dc3545' };
    const badgeBg = badgeColors[m.status_color] || '#6c757d';

    const historyHTML = (m.history || []).map(h => `
        <div class="history-item" id="hist-${h.id}">
            <button class="btn-delete-history no-print" onclick="confirmDeleteHistory('${m.id}','${h.id}')" title="Hapus riwayat ini">
                <i class="fas fa-times"></i>
            </button>
            <span class="history-date-label"><i class="fas fa-calendar-alt me-1"></i>${h.date}</span>
            <div style="font-size:0.88rem;line-height:1.6;">${h.content}</div>
        </div>
    `).join('') || '<p class="text-muted small">Belum ada riwayat.</p>';

    const fuHistHTML = (m.fu_history || []).map(f => `
        <div class="fu-hist-item" id="fuhist-${f.id}">
            <button class="btn-delete-fu no-print" onclick="confirmDeleteFuLog('${m.id}','${f.id}')" title="Hapus log FU ini">
                <i class="fas fa-times"></i>
            </button>
            <div class="fu-hist-date"><i class="fas fa-phone-alt me-1"></i>${formatDate(f.date)} — oleh <strong>${f.done_by || '-'}</strong></div>
            <div class="fu-hist-summary">${f.summary || ''}</div>
            ${f.response ? `<div class="fu-hist-response mt-1"><i class="fas fa-reply me-1"></i>${f.response}</div>` : ''}
        </div>
    `).join('') || '<p class="text-muted small">Belum ada log FU.</p>';

    const alertBgMap = { info:'#f0f8ff', warning:'#fffbf0', danger:'#fff5f5' };
    const alertBorderMap = { info:'#bfdfff', warning:'#fde68a', danger:'#f5c2c7' };
    const alertIconMap = { info:'fa-info-circle text-primary', warning:'fa-exclamation-triangle text-warning', danger:'fa-times-circle text-danger' };

    document.getElementById('contentArea').innerHTML = `
        <div class="mitra-card p-4">
            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                <div>
                    <h3 class="fw-bold mb-1">${m.label}</h3>
                    <span class="badge rounded-pill px-3 py-2" style="background:${badgeBg};font-size:0.82rem;">${m.status}</span>
                    <span class="ms-2 text-muted small"><i class="fas fa-user me-1"></i>${m.pic}</span>
                </div>
                <div class="d-flex gap-2 flex-wrap no-print">
                    <button class="btn btn-sm rounded-pill px-3 fw-bold" style="background:linear-gradient(135deg,#7335B7,#5A2A8F);color:white;border:none;" onclick="openGeneratePrompt('${m.id}')">
                        <i class="fas fa-robot me-1"></i>Generate Prompt AI
                    </button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill" onclick="printMitra()" title="Print/Ekspor">
                        <i class="fas fa-print me-1"></i>Print
                    </button>
                    <button class="btn btn-sm btn-outline-danger rounded-pill" onclick="confirmDeleteMitra('${m.id}','${m.label}')">
                        <i class="fas fa-trash me-1"></i>Hapus Area
                    </button>
                </div>
            </div>

            <!-- STATUS ONBOARDING WIDGET (P4) -->
            <div id="fb-widget-${m.id}" class="mb-4" style="display:none; padding:15px; background:#f8f9fa; border:1px solid #e9ecef; border-radius:12px;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold small text-muted"><i class="fas fa-tasks me-2"></i>Status Onboarding (Live Tracker)</span>
                    <span class="fw-bold small" id="fb-pct-${m.id}" style="color:var(--primary); font-size:1rem;">0%</span>
                </div>
                <div class="progress" style="height: 8px; border-radius: 4px; background: #e2e8f0;">
                    <div id="fb-bar-${m.id}" class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;"></div>
                </div>
            </div>

            <!-- FU BOX -->
            <div class="fu-box ${fuBoxClass}" id="fuBox-${m.id}">
                <div class="fu-icon"><i class="fas ${fuIcon}"></i></div>
                <div style="flex:1;">
                    <div class="fu-label">${fuLabel}</div>
                    <div class="fu-date">${formatDate(m.next_fu_date)} ${fuDaysText(m.next_fu_date)}</div>
                    <div class="fu-note">${m.next_fu_note || 'Belum ada catatan FU.'}</div>
                    <span class="fu-by-badge"><i class="fas fa-user-tie me-1"></i>Dikerjakan oleh: ${m.fu_by || '-'}</span>
                </div>
                <button class="btn-toggle-edit no-print" onclick="toggleSection('editFu')" id="btnEditFu">
                    <i class="fas fa-edit me-1"></i>Edit FU
                </button>
            </div>

            <!-- EDIT FU FORM -->
            <div class="edit-form-section no-print" id="editFu">
                <div class="section-header">
                    <span class="section-title"><i class="fas fa-calendar-edit me-2"></i>Edit Jadwal Follow Up</span>
                    <button class="btn-toggle-edit active" onclick="toggleSection('editFu')">✕ Tutup</button>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold small">Tanggal FU</label>
                        <input type="date" id="fuDate_${m.id}" class="form-control" value="${m.next_fu_date || ''}">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold small">Dikerjakan Oleh</label>
                        <input type="text" id="fuBy_${m.id}" class="form-control" value="${m.fu_by || ''}" placeholder="Dinda/Winda/Raka...">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold small">Catatan Agenda FU</label>
                        <textarea id="fuNote_${m.id}" class="form-control" rows="3">${m.next_fu_note || ''}</textarea>
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn-primary-custom" onclick="confirmSaveFu('${m.id}')"><i class="fas fa-save me-1"></i>Simpan FU</button>
                </div>
            </div>

            <!-- CATATAN KHUSUS -->
            <div style="background:${alertBgMap[m.catatan_type]||alertBgMap.info}; border:1px solid ${alertBorderMap[m.catatan_type]||alertBorderMap.info}; border-radius:12px; padding:16px 18px; margin-bottom:20px;">
                <div class="d-flex justify-content-between align-items-start">
                    <div><i class="fas ${alertIconMap[m.catatan_type]||alertIconMap.info} me-2"></i><strong>Catatan Penting:</strong> <span id="catatanText_${m.id}">${m.catatan_khusus || '-'}</span></div>
                    <button class="btn-toggle-edit no-print ms-3" onclick="toggleSection('editInfo')" id="btnEditInfo" style="white-space:nowrap;flex-shrink:0;">
                        <i class="fas fa-edit me-1"></i>Edit Info
                    </button>
                </div>
            </div>

            <!-- EDIT INFO UMUM FORM -->
            <div class="edit-form-section no-print" id="editInfo">
                <div class="section-header">
                    <span class="section-title"><i class="fas fa-edit me-2"></i>Edit Info Umum Mitra</span>
                    <button class="btn-toggle-edit active" onclick="toggleSection('editInfo')">✕ Tutup</button>
                </div>
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold small">Label Area</label>
                        <input type="text" id="infoLabel_${m.id}" class="form-control" value="${escapeHtmlVal(m.label)}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold small">Warna Badge Status</label>
                        <select id="infoStatusColor_${m.id}" class="form-select">
                            ${['success','primary','warning','secondary','danger'].map(c=>`<option value="${c}" ${m.status_color===c?'selected':''}>${c.charAt(0).toUpperCase()+c.slice(1)}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Status</label>
                        <input type="text" id="infoStatus_${m.id}" class="form-control" value="${escapeHtmlVal(m.status)}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Nama PIC</label>
                        <input type="text" id="infoPic_${m.id}" class="form-control" value="${escapeHtmlVal(m.pic)}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold small">Tipe Alert Catatan</label>
                        <select id="infoCatatanType_${m.id}" class="form-select">
                            <option value="info" ${m.catatan_type==='info'?'selected':''}>Info (Biru)</option>
                            <option value="warning" ${m.catatan_type==='warning'?'selected':''}>Warning (Kuning)</option>
                            <option value="danger" ${m.catatan_type==='danger'?'selected':''}>Danger (Merah)</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold small">Catatan Khusus</label>
                        <textarea id="infoCatatan_${m.id}" class="form-control" rows="3">${escapeHtmlVal(m.catatan_khusus)}</textarea>
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn-primary-custom" onclick="confirmSaveInfo('${m.id}')"><i class="fas fa-save me-1"></i>Simpan Perubahan</button>
                </div>
            </div>

            <hr class="section-divider">

            <!-- DETAIL TABS -->
            <ul class="nav detail-tabs mb-3 no-print" id="detailTabs-${m.id}">
                <li class="nav-item"><button class="nav-link active" onclick="switchTab('riwayat','${m.id}',this)"><i class="fas fa-history me-1"></i>Riwayat Chat</button></li>
                <li class="nav-item"><button class="nav-link" onclick="switchTab('fulog','${m.id}',this)"><i class="fas fa-phone-alt me-1"></i>Log FU</button></li>
            </ul>

            <!-- TAB: Riwayat Chat -->
            <div id="tab-riwayat-${m.id}">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="font-size:1rem;"><i class="fas fa-history me-2" style="color:var(--primary);"></i>Riwayat Detail & Konteks</h5>
                    <button class="btn-toggle-edit no-print" onclick="toggleSection('addHistory')">
                        <i class="fas fa-plus me-1"></i>Tambah Riwayat
                    </button>
                </div>

                <!-- ADD HISTORY FORM -->
                <div class="edit-form-section no-print" id="addHistory">
                    <div class="section-header">
                        <span class="section-title"><i class="fas fa-plus me-2"></i>Tambah Entri Riwayat Baru</span>
                        <button class="btn-toggle-edit active" onclick="toggleSection('addHistory')">✕ Tutup</button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Tanggal</label>
                            <input type="text" id="histDate_${m.id}" class="form-control" placeholder="cth: 8 Juli 2026">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small">Isi Riwayat</label>
                            <textarea id="histContent_${m.id}" class="form-control" rows="4" placeholder="Tulis ringkasan kejadian / konten penting dari chat..."></textarea>
                            <div class="form-text">Boleh gunakan tag HTML sederhana: &lt;strong&gt;, &lt;em&gt;, &lt;code&gt;, &lt;br&gt;</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn-primary-custom" onclick="submitAddHistory('${m.id}')"><i class="fas fa-plus me-1"></i>Tambah Riwayat</button>
                    </div>
                </div>

                <div id="historyList-${m.id}">${historyHTML}</div>
            </div>

            <!-- TAB: Log FU -->
            <div id="tab-fulog-${m.id}" style="display:none;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="font-size:1rem;"><i class="fas fa-phone-alt me-2" style="color:var(--primary);"></i>Log Follow Up</h5>
                    <button class="btn-toggle-edit no-print" onclick="toggleSection('addFuLog')">
                        <i class="fas fa-plus me-1"></i>Log FU Selesai
                    </button>
                </div>

                <!-- ADD FU LOG FORM -->
                <div class="edit-form-section no-print" id="addFuLog">
                    <div class="section-header">
                        <span class="section-title"><i class="fas fa-phone-alt me-2"></i>Catat FU yang Sudah Dilakukan</span>
                        <button class="btn-toggle-edit active" onclick="toggleSection('addFuLog')">✕ Tutup</button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Tanggal FU</label>
                            <input type="date" id="fuLogDate_${m.id}" class="form-control" value="${new Date().toISOString().split('T')[0]}">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-bold small">Dilakukan Oleh</label>
                            <input type="text" id="fuLogBy_${m.id}" class="form-control" placeholder="Dinda/Winda/Raka">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small">Ringkasan Aksi FU</label>
                            <textarea id="fuLogSummary_${m.id}" class="form-control" rows="2" placeholder="Apa yang dilakukan saat FU (kirim pesan, telepon, dll)..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small">Respon Mitra</label>
                            <textarea id="fuLogResponse_${m.id}" class="form-control" rows="2" placeholder="Apa respon dari mitra? (Bisa kosong jika belum dibalas)"></textarea>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn-primary-custom" onclick="submitAddFuLog('${m.id}')"><i class="fas fa-check me-1"></i>Simpan Log FU</button>
                    </div>
                </div>

                <div id="fuHistList-${m.id}">${fuHistHTML}</div>
            </div>

        </div>
    `;
}

// ======================================================
// TAB SWITCHING
// ======================================================
function switchTab(tab, mitraId, el) {
    document.getElementById('tab-riwayat-' + mitraId).style.display = tab === 'riwayat' ? 'block' : 'none';
    document.getElementById('tab-fulog-' + mitraId).style.display = tab === 'fulog' ? 'block' : 'none';
    document.querySelectorAll(`#detailTabs-${mitraId} .nav-link`).forEach(b => b.classList.remove('active'));
    el.classList.add('active');
}

// ======================================================
// TOGGLE EDIT SECTIONS
// ======================================================
function toggleSection(sectionId) {
    const el = document.getElementById(sectionId);
    if (!el) return;
    el.classList.toggle('show');
}

// ======================================================
// SAVE: FU SCHEDULE
// ======================================================
function confirmSaveFu(mitraId) {
    const date = document.getElementById('fuDate_' + mitraId)?.value || '';
    const note = document.getElementById('fuNote_' + mitraId)?.value || '';
    const by = document.getElementById('fuBy_' + mitraId)?.value || '';

    document.getElementById('modalSaveBody').innerHTML = `
        Simpan jadwal FU untuk <strong>${allMitras.find(m=>m.id===mitraId)?.label}</strong>?<br>
        <small class="text-muted">Tanggal: ${formatDate(date)} | Oleh: ${by}</small>
    `;
    pendingAction = () => saveFuSchedule(mitraId, date, note, by);
    document.getElementById('btnConfirmSave').onclick = () => { pendingAction(); bootstrap.Modal.getInstance(document.getElementById('modalSave')).hide(); };
    new bootstrap.Modal(document.getElementById('modalSave')).show();
}

function saveFuSchedule(mitraId, date, note, by) {
    const payload = { id: mitraId, next_fu_date: date, next_fu_note: note, fu_by: by };
    apiPost('save_mitra_info', payload, () => {
        // Update local state
        const m = allMitras.find(x => x.id === mitraId);
        if (m) { m.next_fu_date = date; m.next_fu_note = note; m.fu_by = by; }
        renderSidebar();
        switchMitra(mitraId);
        showToast('Jadwal FU berhasil disimpan!', 'success');
    });
}

// ======================================================
// SAVE: INFO UMUM
// ======================================================
function confirmSaveInfo(mitraId) {
    const mitra = allMitras.find(m => m.id === mitraId);
    document.getElementById('modalSaveBody').innerHTML = `Simpan perubahan info umum untuk <strong>${mitra?.label}</strong>?`;
    pendingAction = () => saveInfoUmum(mitraId);
    document.getElementById('btnConfirmSave').onclick = () => { pendingAction(); bootstrap.Modal.getInstance(document.getElementById('modalSave')).hide(); };
    new bootstrap.Modal(document.getElementById('modalSave')).show();
}

function saveInfoUmum(mitraId) {
    const payload = {
        id: mitraId,
        label: document.getElementById('infoLabel_' + mitraId)?.value || '',
        status: document.getElementById('infoStatus_' + mitraId)?.value || '',
        status_color: document.getElementById('infoStatusColor_' + mitraId)?.value || 'secondary',
        pic: document.getElementById('infoPic_' + mitraId)?.value || '',
        catatan_type: document.getElementById('infoCatatanType_' + mitraId)?.value || 'info',
        catatan_khusus: document.getElementById('infoCatatan_' + mitraId)?.value || ''
    };
    apiPost('save_mitra_info', payload, () => {
        const m = allMitras.find(x => x.id === mitraId);
        if (m) Object.assign(m, payload);
        renderSidebar();
        switchMitra(mitraId);
        showToast('Info umum berhasil disimpan!', 'success');
    });
}

// ======================================================
// ADD HISTORY
// ======================================================
function submitAddHistory(mitraId) {
    const date = document.getElementById('histDate_' + mitraId)?.value || '';
    const content = document.getElementById('histContent_' + mitraId)?.value || '';
    if (!date || !content) { showToast('Tanggal dan isi riwayat wajib diisi!', 'danger'); return; }

    apiPost('add_history', { mitra_id: mitraId, date, content }, (res) => {
        showToast('Riwayat berhasil ditambahkan!', 'success');
    });
}

// ======================================================
// DELETE HISTORY
// ======================================================
function confirmDeleteHistory(mitraId, histId) {
    document.getElementById('modalDeleteBody').innerHTML = 'Yakin hapus entri riwayat ini? <strong>Aksi tidak dapat dibatalkan.</strong>';
    pendingAction = () => deleteHistory(mitraId, histId);
    document.getElementById('btnConfirmDelete').onclick = () => { pendingAction(); bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide(); };
    new bootstrap.Modal(document.getElementById('modalDelete')).show();
}

function deleteHistory(mitraId, histId) {
    apiPost('delete_history', { mitra_id: mitraId, history_id: histId }, () => {
        showToast('Riwayat berhasil dihapus.', 'warning');
    });
}

// ======================================================
// ADD FU LOG
// ======================================================
function submitAddFuLog(mitraId) {
    const date = document.getElementById('fuLogDate_' + mitraId)?.value || '';
    const done_by = document.getElementById('fuLogBy_' + mitraId)?.value || '';
    const summary = document.getElementById('fuLogSummary_' + mitraId)?.value || '';
    const response = document.getElementById('fuLogResponse_' + mitraId)?.value || '';
    if (!date || !summary) { showToast('Tanggal dan ringkasan FU wajib diisi!', 'danger'); return; }

    apiPost('add_fu_log', { mitra_id: mitraId, date, done_by, summary, response }, () => {
        setTimeout(() => {
            const tabBtn = document.querySelector(`#detailTabs-${mitraId} .nav-link:nth-child(2)`) || 
                           document.querySelectorAll(`#detailTabs-${mitraId} button`)[1];
            if (tabBtn) switchTab('fulog', mitraId, tabBtn);
        }, 100);
        showToast('Log FU berhasil disimpan!', 'success');
    });
}

// ======================================================
// DELETE FU LOG
// ======================================================
function confirmDeleteFuLog(mitraId, fuId) {
    document.getElementById('modalDeleteBody').innerHTML = 'Yakin hapus log FU ini? <strong>Aksi tidak dapat dibatalkan.</strong>';
    pendingAction = () => deleteFuLog(mitraId, fuId);
    document.getElementById('btnConfirmDelete').onclick = () => { pendingAction(); bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide(); };
    new bootstrap.Modal(document.getElementById('modalDelete')).show();
}

function deleteFuLog(mitraId, fuId) {
    apiPost('delete_fu_log', { mitra_id: mitraId, fu_id: fuId }, () => {
        showToast('Log FU berhasil dihapus.', 'warning');
    });
}

// ======================================================
// ADD NEW MITRA
// ======================================================
function openAddMitraModal() {
    new bootstrap.Modal(document.getElementById('modalAddMitra')).show();
}

function submitNewMitra() {
    const id = document.getElementById('newMitraId').value.trim().toLowerCase().replace(/\s+/g, '_');
    const label = document.getElementById('newMitraLabel').value.trim();
    if (!id || !label) { showToast('ID dan Label wajib diisi!', 'danger'); return; }

    const payload = {
        id,
        label,
        pic: document.getElementById('newMitraPic').value.trim(),
        status: document.getElementById('newMitraStatus').value,
        next_fu_date: document.getElementById('newMitraFuDate').value,
        next_fu_note: document.getElementById('newMitraFuNote').value.trim(),
        catatan_khusus: document.getElementById('newMitraCatatan').value.trim()
    };

    apiPost('add_mitra', payload, (res) => {
        bootstrap.Modal.getInstance(document.getElementById('modalAddMitra')).hide();
        activeMitraId = id; // Set active so firebase onValue will select it
        showToast('Area mitra baru berhasil ditambahkan!', 'success');
    });
}

// ======================================================
// DELETE MITRA
// ======================================================
let deleteMitraTarget = null;
function confirmDeleteMitra(mitraId, mitraLabel) {
    deleteMitraTarget = { id: mitraId, label: mitraLabel };
    document.getElementById('deleteMitraWarning').textContent = `Hapus area "${mitraLabel}" beserta SEMUA riwayat dan log FU-nya?`;
    document.getElementById('deleteMitraConfirmInput').value = '';
    document.getElementById('btnConfirmDeleteMitra').disabled = true;

    document.getElementById('deleteMitraConfirmInput').oninput = function() {
        document.getElementById('btnConfirmDeleteMitra').disabled = this.value.trim() !== mitraLabel;
    };
    document.getElementById('btnConfirmDeleteMitra').onclick = () => {
        apiPost('delete_mitra', { mitra_id: mitraId }, () => {
            bootstrap.Modal.getInstance(document.getElementById('modalDeleteMitra')).hide();
            if (allMitras.length > 1) {
                const other = allMitras.find(m => m.id !== mitraId);
                activeMitraId = other ? other.id : null;
            } else {
                activeMitraId = null;
                document.getElementById('contentArea').innerHTML = '<div class="alert alert-info">Belum ada area mitra.</div>';
            }
            showToast('Area mitra berhasil dihapus.', 'warning');
        });
    };
    new bootstrap.Modal(document.getElementById('modalDeleteMitra')).show();
}

// ======================================================
// PRINT
// ======================================================
function printMitra() {
    window.print();
}

// ======================================================
// API HELPER
// ======================================================
function apiPost(action, payload, onSuccess) {
    if (!window.infoRef || !window.firebaseSet) {
        showToast('Firebase belum siap, tunggu sebentar.', 'danger');
        return;
    }
    
    // Deep clone data untuk mutasi lokal lalu push ke Firebase
    let newData = JSON.parse(JSON.stringify(allMitras));
    
    if (action === 'save_mitra_info') {
        const m = newData.find(x => x.id === payload.id);
        if(m) Object.assign(m, payload);
    } else if (action === 'save_fu') {
        const m = newData.find(x => x.id === payload.id);
        if(m) { m.next_fu_date = payload.next_fu_date; m.next_fu_note = payload.next_fu_note; m.fu_by = payload.fu_by; }
    } else if (action === 'add_history') {
        const m = newData.find(x => x.id === payload.mitra_id);
        if(m) {
            if(!m.history) m.history = [];
            m.history.push({ id: 'hist_' + Date.now(), date: payload.date, content: payload.content });
            m.history.sort((a,b) => new Date(b.date) - new Date(a.date));
        }
    } else if (action === 'delete_history') {
        const m = newData.find(x => x.id === payload.mitra_id);
        if(m && m.history) m.history = m.history.filter(h => h.id !== payload.history_id);
    } else if (action === 'add_fu_log') {
        const m = newData.find(x => x.id === payload.mitra_id);
        if(m) {
            if(!m.fu_history) m.fu_history = [];
            m.fu_history.push({ id: 'fu_' + Date.now(), date: payload.date, done_by: payload.done_by, summary: payload.summary, response: payload.response });
            m.fu_history.sort((a,b) => new Date(b.date) - new Date(a.date));
        }
    } else if (action === 'delete_fu_log') {
        const m = newData.find(x => x.id === payload.mitra_id);
        if(m && m.fu_history) m.fu_history = m.fu_history.filter(f => f.id !== payload.fu_id);
    } else if (action === 'add_mitra') {
        newData.push({
            id: payload.id, label: payload.label, pic: payload.pic,
            status: payload.status, status_color: 'primary',
            catatan_khusus: payload.catatan_khusus, catatan_type: 'info',
            next_fu_date: payload.next_fu_date, next_fu_note: payload.next_fu_note,
            fu_by: '', fu_history: [], history: []
        });
    } else if (action === 'delete_mitra') {
        newData = newData.filter(x => x.id !== payload.mitra_id);
    }
    
    window.firebaseSet(window.infoRef, newData).then(() => {
        if(onSuccess) onSuccess({status: 'success'});
    }).catch(err => {
        showToast('Gagal simpan ke Firebase: ' + err.message, 'danger');
    });
}

// ======================================================
// TOAST
// ======================================================
function showToast(msg, type = 'success') {
    const toast = document.getElementById('toastMsg');
    const body = document.getElementById('toastBody');
    const bgMap = { success: '#198754', warning: '#f59e0b', danger: '#dc3545', info: '#0dcaf0' };
    toast.style.background = bgMap[type] || bgMap.success;
    body.textContent = msg;
    new bootstrap.Toast(toast, { delay: 3500 }).show();
}

// ======================================================
// UTILS
// ======================================================
function escapeHtmlVal(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
}

// ======================================================
// GENERATE PROMPT AI
// ======================================================
let currentPromptMitraId = null;
let currentPromptType = 'senin';

function openGeneratePrompt(mitraId) {
    currentPromptMitraId = mitraId;
    const m = allMitras.find(x => x.id === mitraId);
    if (!m) return;
    document.getElementById('promptMitraLabel').textContent = '— ' + m.label;
    // Reset to Senin tab
    selectPromptType('senin');
    new bootstrap.Modal(document.getElementById('modalGeneratePrompt')).show();
}

function selectPromptType(type) {
    currentPromptType = type;
    const tabs = { senin: 'ptypeSenin', jumat: 'ptypeJumat', reengagement: 'ptypeReeng' };
    Object.entries(tabs).forEach(([k, id]) => {
        const btn = document.getElementById(id);
        if (btn) {
            btn.style.background = (k === type) ? '#7335B7' : '#e9ecef';
            btn.style.color = (k === type) ? 'white' : '#333';
        }
    });
    if (currentPromptMitraId) {
        const m = allMitras.find(x => x.id === currentPromptMitraId);
        if (m) document.getElementById('generatedPromptText').value = buildPrompt(m, type);
    }
}

function buildPrompt(m, type) {
    // Strip HTML and decode entities
    const strip = s => (s || '')
        .replace(/<[^>]*>/g, '')
        .replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>')
        .replace(/&quot;/g, '"').replace(/&#39;/g, "'").trim();

    // Last 2 history entries
    const hist = (m.history || []).slice(0, 2)
        .map(h => `  [${h.date}]\n  ${strip(h.content)}`)
        .join('\n\n') || '  (Belum ada riwayat tercatat)';

    // Last FU log
    const fu0 = (m.fu_history || [])[0];
    const lastFU = fu0
        ? `  [${fu0.date}] oleh ${fu0.done_by || '-'}\n  Aksi: ${strip(fu0.summary)}${fu0.response ? '\n  Respon mitra: ' + strip(fu0.response) : ''}`
        : '  (Belum ada log FU)';

    // Clean agenda
    const agenda = strip(m.next_fu_note || '')
        .replace(/\[SENIN\]|\[JUMAT\]|\[SEGERA\]|\[PRIORITAS SEGERA\]/g, '')
        .replace(/\s+/g, ' ').trim();

    // Prompt type config
    const typeConfigs = {
        senin: {
            label: 'SENIN PAGI — Kendala & Progres',
            instruction: [
                'TUJUAN: Tanyakan kendala aktif, tawarkan solusi konkret, minta update progres.',
                'Jangan terkesan menagih — posisikan sebagai mitra akselerasi, bukan penagih tugas.',
                '',
                'STANDAR KUALITAS WAJIB:',
                '- BAHASA: Kasual tapi profesional. Seperti teman bisnis, bukan surat resmi.',
                '  Hindari: "Dengan hormat", "Bersama ini kami", "Mohon kiranya berkenan", dsb.',
                '- PANJANG: MAKSIMAL 5-7 kalimat. Jika lebih, potong yang tidak perlu.',
                '- FORMAT OUTPUT: WAJIB dalam bentuk codeblock (```) agar simbol WhatsApp seperti * (bold) tidak rusak saat di-copy.',
                '  Langsung berikan codeblock-nya saja tanpa intro "Berikut template..." atau penutup apapun.',
                '- BOLD (*): Gunakan hanya untuk 1-2 kata kunci penting. Jangan bold seluruh kalimat.',
                '- BULLET (•): Hanya jika ada 3+ item yang perlu disebutkan. Tidak untuk kalimat biasa.',
                '- SAPAAN: Gunakan nama panggilan pendek saja, bukan nama lengkap.',
                '- PENUTUP: 1 kalimat CTA yang spesifik dan bisa langsung dieksekusi mitra.',
            ].join('\n')
        },
        jumat: {
            label: 'JUMAT — Motivasi Mingguan',
            instruction: [
                'TUJUAN: Berikan motivasi, apresiasi progres, ingatkan potensi yang belum dioptimalkan.',
                '',
                'STANDAR KUALITAS WAJIB:',
                '- BAHASA: Hangat dan semangat. Seperti rekan bisnis yang peduli, bukan atasan menagih.',
                '  Hindari bahasa kantor/formal. Boleh pakai emoji 1-2 yang sesuai.',
                '- PANJANG: MAKSIMAL 5 kalimat, energik dan padat. Bukan ceramah motivasi.',
                '- FORMAT OUTPUT: WAJIB dalam bentuk codeblock (```) agar simbol WhatsApp seperti * (bold) tidak rusak saat di-copy.',
                '  Langsung berikan codeblock-nya saja tanpa intro atau penjelasan apapun dari AI.',
                '- BOLD (*): Highlight 1-2 pencapaian atau angka kunci saja.',
                '- PENUTUP: Kalimat semangat yang spesifik untuk pekan depan, bukan generik.',
            ].join('\n')
        },
        reengagement: {
            label: 'RE-ENGAGEMENT — Mitra Tidak Responsif',
            instruction: [
                'TUJUAN: Buka dialog kembali dengan empati, tanpa menekan atau menagih.',
                'Tawarkan bantuan konkret atau alternatif agar progres bisa lanjut.',
                '',
                'STANDAR KUALITAS WAJIB:',
                '- BAHASA: Ringan, hangat, sama sekali tidak formal. Seperti teman yang check-in.',
                '- PANJANG: MAKSIMAL 4-5 kalimat. Pendek = lebih mudah direspons mitra.',
                '- FORMAT OUTPUT: WAJIB dalam bentuk codeblock (```) agar simbol WhatsApp tidak rusak saat di-copy.',
                '  Langsung berikan codeblock-nya saja. Tanpa intro, penjelasan, atau penutup dari AI.',
                '- PENUTUP: Pertanyaan ringan yang mudah dijawab ya/tidak atau pilihan sederhana.',
                '  Contoh baik: "Bisa share kendala terbesar saat ini?" bukan "Mohon berkenan memberikan info..."',
            ].join('\n')
        }
    };

    const cfg = typeConfigs[type] || typeConfigs.senin;
    const picName = (m.pic || '').split('(')[0].replace(/Pak |Bu |Mas |Mbak /i, '').trim();

    return `=== KONTEKS MITRA UNTUK AI ===
Area Mitra  : ${m.label}
PIC / Mitra : ${m.pic}
Status      : ${m.status}
Catatan     : ${strip(m.catatan_khusus) || '-'}
Jadwal FU   : ${m.next_fu_date || '-'}
Agenda FU   : ${agenda || '-'}

--- Riwayat 2 Entri Terbaru ---
${hist}

--- Log FU Terakhir ---
${lastFU}

=== INSTRUKSI UNTUK AI ===
Buatkan template pesan WhatsApp untuk sesi: ${cfg.label}

${cfg.instruction}

Panggil penerima dengan nama sapaan pendek: "${picName}".
INGAT: Output harus langsung teks pesannya — tanpa intro, tanpa penutup penjelasan dari AI.`;
}

function copyGeneratedPrompt() {
    const ta = document.getElementById('generatedPromptText');
    ta.select();
    navigator.clipboard.writeText(ta.value).then(() => {
        const btn = document.getElementById('btnCopyGeneratedPrompt');
        btn.innerHTML = '<i class="fas fa-check me-1"></i>Tersalin!';
        btn.style.background = '#198754';
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-copy me-1"></i>Salin Prompt';
            btn.style.background = '#7335B7';
        }, 2500);
    });
}
</script>

<!-- PORTOFOLIO DEMO: Firebase SDK modular asli diganti mock lokal (localStorage), tidak connect ke server manapun -->
<script type="module">
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
    window.firebaseSet = set;
    window.infoRef = ref(db, 'b2b_info_mitra_data');
    
    // 1) INIT B2B_INFO_MITRA_DATA
    let isInitialLoad = true;
    onValue(window.infoRef, (snapshot) => {
        if (snapshot.exists()) {
            allMitras = snapshot.val();
            // Data bisa berupa dict atau array jika keys berurutan, pastikan array:
            if (!Array.isArray(allMitras)) {
                allMitras = Object.values(allMitras);
            }
            
            renderSidebar();
            if (isInitialLoad) {
                if (allMitras.length > 0) switchMitra(allMitras[0].id);
                document.getElementById('loadingState').style.display = 'none';
                document.getElementById('contentArea').style.display = 'block';
                isInitialLoad = false;
            } else if (!isInitialLoad && activeMitraId) {
                switchMitra(activeMitraId);
            }
        } else {
            // Seed awal dari JSON lokal jika Firebase masih kosong
            fetch('../pitching/mitra/api_save.php?action=get_mitra_info')
                .then(r => r.json())
                .then(data => {
                    set(window.infoRef, data);
                });
        }
    });

    // 2) TRACKER WIDGET LOGIC
    // Fetch mapping (PORTOFOLIO DEMO: file dummy lokal)
    fetch('json/tracker_info_mapping.json')
        .then(res => res.json())
        .then(mapping => {
            const trackerRef = ref(db, 'mitra_tracker');
            onValue(trackerRef, (snapshot) => {
                if(!snapshot.exists()) return;
                const data = snapshot.val();
                
                // Iterasi info_to_tracker
                for (const [infoId, trackerId] of Object.entries(mapping.info_to_tracker)) {
                    if (data[trackerId]) {
                        const progress = data[trackerId].progress || {};
                        let checked = 0;
                        let total = mapping.counted_keys.length;
                        
                        mapping.counted_keys.forEach(key => {
                            if (progress[key] === true) checked++;
                        });
                        
                        const pct = Math.round((checked / total) * 100) || 0;
                        
                        const widget = document.getElementById(`fb-widget-${infoId}`);
                        const bar = document.getElementById(`fb-bar-${infoId}`);
                        const text = document.getElementById(`fb-pct-${infoId}`);
                        
                        if (widget && bar && text) {
                            widget.style.display = 'block';
                            bar.style.width = pct + '%';
                            text.textContent = pct + '%';
                            
                            if (pct === 100) {
                                bar.classList.replace('bg-primary', 'bg-success');
                                text.style.color = '#198754';
                            } else {
                                bar.classList.replace('bg-success', 'bg-primary');
                                text.style.color = 'var(--primary)';
                            }
                        }
                    }
                }
            });
        })
        .catch(err => console.error("Gagal load mapping tracker:", err));
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>