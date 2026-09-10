<?php 
$page_title = "Prosedur & Onboarding Master Mitra Area | SIMASRIM";
$footer_desc = "Alur Standar Operasional Aktivasi Wilayah Baru - SIMASRIM.";
include 'header.php'; 
?>

<style>
    /* TIMELINE UI */
    .timeline-container { position: relative; padding: 2rem 0; }
    .timeline-container::before { content: ''; position: absolute; left: 50%; width: 2px; height: 100%; background: #e9ecef; transform: translateX(-50%); }
    
    .timeline-item { margin-bottom: 4rem; position: relative; width: 100%; }
    .timeline-icon { position: absolute; left: 50%; transform: translateX(-50%); width: 50px; height: 50px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 2; border: 4px solid #f8f9fa; box-shadow: 0 0 15px rgba(115, 53, 183, 0.2); }
    
    .timeline-content { width: 45%; padding: 2rem; background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); transition: 0.3s; }
    .timeline-content:hover { transform: translateY(-5px); border-color: var(--primary); box-shadow: 0 15px 40px rgba(115, 53, 183, 0.1); }
    
    /* Selang-seling Kanan Kiri */
    .timeline-item:nth-child(even) .timeline-content { margin-left: auto; text-align: left; }
    .timeline-item:nth-child(odd) .timeline-content { text-align: right; margin-right: auto; }

    /* Fix tombol di item ganjil agar merapat ke kanan */
    .timeline-item:nth-child(odd) .btn-wrapper { justify-content: flex-end; }

    /* Override untuk kotak Amunisi agar di tengah */
    .timeline-content.center-block { margin: 0 auto !important; text-align: left !important; width: 85%; }

    .step-badge { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; background: var(--bg-soft-purple); color: var(--primary); padding: 5px 12px; border-radius: 50px; margin-bottom: 10px; display: inline-block; }
    
    .btn-resource { background: #f8f9fa; color: var(--text-main); border: 1px solid #dee2e6; border-radius: 10px; padding: 10px 15px; font-size: 0.85rem; display: flex; align-items: center; gap: 10px; transition: 0.2s; margin-top: 10px; text-decoration: none; width: fit-content; }
    .btn-resource:hover { background: var(--bg-soft-purple); border-color: var(--primary); color: var(--primary); }

    /* CSS Khusus Amunisi Grid */
    .amunisi-btn { width: 100%; justify-content: flex-start; }

    @media (max-width: 991.98px) {
        .timeline-container::before { left: 30px; }
        .timeline-icon { left: 30px; transform: none; }
        .timeline-content { width: calc(100% - 60px) !important; margin-left: 60px !important; text-align: left !important; }
        .btn-wrapper { justify-content: flex-start !important; }
    }
</style>

<section class="hero-section text-center" style="background: radial-gradient(circle at top right, #3A1B5E, #1F0D3D, #0f0c29); padding: 160px 0 80px;">
    <div class="container position-relative z-1">
        <h1 class="display-4 fw-bold mb-3 text-white">Roadmap Aktivasi Area</h1>
        <p class="lead text-white-50 max-w-2xl mx-auto">Panduan langkah-demi-langkah bagi Master Mitra Area mulai dari tahap kesepakatan hingga operasional resmi.</p>
    </div>
</section>

<section class="py-5 bg-light-soft">
    <div class="container py-5">
        <div class="timeline-container">
            
            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon"><i class="fas fa-desktop"></i></div>
                <div class="timeline-content">
                    <span class="step-badge">Tahap 1</span>
                    <h4 class="fw-bold">Presentasi & Eksplorasi</h4>
                    <p class="text-muted small mb-3">Penyampaian Blueprint Ekosistem dan Skema Profit kepada calon Master Area untuk menyelaraskan visi bisnis ke depan.</p>
                    <div class="d-flex btn-wrapper">
                        <a href="https://contoh-eksternal.example.com/" target="_blank" class="btn-resource"><i class="fas fa-globe text-primary"></i> Web Presentasi Awal</a>
                    </div>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon" style="background: #25D366;"><i class="fab fa-whatsapp"></i></div>
                <div class="timeline-content">
                    <span class="step-badge" style="background: rgba(37, 211, 102, 0.1); color: #25D366;">Tahap 2</span>
                    <h4 class="fw-bold">Grup Koordinasi Khusus</h4>
                    <p class="text-muted small mb-0">Pembentukan Grup WA Area sebagai pusat komunikasi intensif, pengiriman berkas, dan dukungan operasional harian.</p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon" style="background: #0d6efd;"><i class="fas fa-file-signature"></i></div>
                <div class="timeline-content">
                    <span class="step-badge" style="background: rgba(13, 110, 253, 0.1); color: #0d6efd;">Tahap 3</span>
                    <h4 class="fw-bold">Legalitas & Set-up Sistem</h4>
                    <p class="text-muted small">Penandatanganan dokumen legal secara paralel dengan aktivasi akun dan pembuatan Dashboard Rekonsiliasi (Looker).</p>
                    <div class="d-flex flex-column gap-1 mt-3 btn-wrapper align-items-end">
                        <a href="#" target="_blank" class="btn-resource m-0"><i class="fas fa-file-contract text-primary mt-1"></i> Base Dokumen NDA</a>
                        <a href="#" target="_blank" class="btn-resource m-0"><i class="fas fa-file-signature text-primary mt-1"></i> Base Surat Penunjukan</a>
                        <a href="#" target="_blank" class="btn-resource m-0"><i class="fas fa-file-alt text-primary mt-1"></i> Base Adendum PKS</a>
                        <a href="https://mkt.smsrm.com/sop/duplikasi_mitra.php" target="_blank" class="btn-resource m-0 mt-2"><i class="fas fa-chart-pie text-info mt-1"></i> SOP Duplikasi Dashboard</a>
                    </div>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon" style="background: var(--accent);"><i class="fas fa-rocket"></i></div>
                <div class="timeline-content center-block">
                    <span class="step-badge" style="background: rgba(243, 112, 13, 0.1); color: var(--accent);">Tahap 4</span>
                    <h4 class="fw-bold">Pusat Amunisi Marketing & Training</h4>
                    <p class="text-muted small mb-4">Pengiriman <i>Marketing Kit</i> dan aset promosi agar Mitra siap melakukan kanvasing lapangan dan penetrasi digital:</p>
                    
                    <div class="row g-3">
                        <?php
                        $json_path = __DIR__ . '/json/prosedur_links.json';
                        $prosedur_data = json_decode(file_get_contents($json_path), true);
                        if (!$prosedur_data) {
                            $prosedur_data = ['data_panduan'=>[], 'aset_visual'=>[], 'banner'=>[]];
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="p-3 bg-light border rounded-3 h-100" id="render_panduan">
                                <h6 class="fw-bold text-primary mb-3"><i class="fas fa-database me-2"></i>Data & Panduan Target</h6>
                                <?php foreach($prosedur_data['data_panduan'] as $item): ?>
                                <a href="<?= htmlspecialchars($item['url']) ?>" target="_blank" class="btn-resource amunisi-btn mb-2">
                                    <i class="<?= htmlspecialchars($item['icon']) ?> <?= htmlspecialchars($item['color']) ?> mt-1"></i> <?= htmlspecialchars($item['title']) ?>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light border rounded-3 h-100" id="render_aset_banner">
                                <h6 class="fw-bold text-accent mb-3"><i class="fas fa-paint-brush me-2"></i>Aset Visual & Branding</h6>
                                <?php foreach($prosedur_data['aset_visual'] as $item): ?>
                                <a href="<?= htmlspecialchars($item['url']) ?>" target="_blank" class="btn-resource amunisi-btn mb-2">
                                    <i class="<?= htmlspecialchars($item['icon']) ?> <?= htmlspecialchars($item['color']) ?> mt-1"></i> <?= htmlspecialchars($item['title']) ?>
                                </a>
                                <?php endforeach; ?>
                                
                                <h6 class="fw-bold text-dark mb-2 mt-3" style="font-size: 0.85rem;">7. Standar POS Material Banner:</h6>
                                <?php foreach($prosedur_data['banner'] as $item): ?>
                                <a href="<?= htmlspecialchars($item['url']) ?>" target="_blank" class="btn-resource amunisi-btn mb-1">
                                    <i class="<?= htmlspecialchars($item['icon']) ?> <?= htmlspecialchars($item['color']) ?> mt-1"></i> <?= htmlspecialchars($item['title']) ?>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 text-end border-top pt-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalAdminProsedur" class="btn btn-sm btn-outline-secondary fw-bold shadow-sm" title="Halaman khusus admin untuk mengubah daftar link amunisi marketing di atas.">
                            <i class="fas fa-cog me-1"></i>Kelola Link Amunisi (Admin)
                        </a>
                    </div>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon" style="background: #6f42c1;"><i class="fas fa-chess"></i></div>
                <div class="timeline-content">
                    <span class="step-badge" style="background: rgba(111, 66, 193, 0.1); color: #6f42c1;">Tahap 5</span>
                    <h4 class="fw-bold">Monthly Strategy Plan</h4>
                    <p class="text-muted small mb-0">Penyusunan target dan strategi pergerakan bulanan agar Pusat dapat memonitor dan memberikan dukungan penuh. <br><i>(Template tergabung dalam Dokumen Panduan Dasar)</i></p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon" style="background: #20c997;"><i class="fas fa-check-double"></i></div>
                <div class="timeline-content">
                    <span class="step-badge" style="background: rgba(32, 201, 151, 0.1); color: #20c997;">Final</span>
                    <h4 class="fw-bold">Operasional Berjalan</h4>
                    <p class="text-muted small mb-0">Administrasi disetujui, akun aktif, amunisi siap, dan jadwal rekonsiliasi ditetapkan. Master Area resmi beroperasi penuh di wilayahnya.</p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon" style="background: #e83e8c;"><i class="fas fa-calendar-alt"></i></div>
                <div class="timeline-content">
                    <span class="step-badge">Maintenance</span>
                    <h4 class="fw-bold">Monthly Strategy Meeting</h4>
                    <p class="text-muted small">Meeting rutin 1 bulan sekali bersama keseluruhan area untuk evaluasi kinerja area, bedah kendala, dan sinkronisasi target bulan berikutnya.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Admin Prosedur Modal -->
<div class="modal fade" id="modalAdminProsedur" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--primary);">
                <h5 class="modal-title text-white"><i class="fas fa-cog me-2"></i>Kelola Link Amunisi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="alert alert-info small">
                    <i class="fas fa-info-circle me-1"></i> <strong>Cara Pengisian:</strong> 
                    Isi kolom judul, link URL, nama ikon FontAwesome (misal: <code>fas fa-file</code>), dan warna (misal: <code>text-primary</code>).
                </div>
                
                <h6 class="fw-bold text-primary mb-2 mt-4">Data & Panduan Target</h6>
                <div id="form_panduan" class="mb-2"></div>
                <button type="button" class="btn btn-sm btn-outline-primary mb-4" onclick="addRow('form_panduan')"><i class="fas fa-plus me-1"></i>Tambah Panduan</button>

                <h6 class="fw-bold text-accent mb-2">Aset Visual & Branding</h6>
                <div id="form_aset" class="mb-2"></div>
                <button type="button" class="btn btn-sm btn-outline-accent mb-4" onclick="addRow('form_aset')"><i class="fas fa-plus me-1"></i>Tambah Aset</button>

                <h6 class="fw-bold text-dark mb-2">Standar POS Material Banner</h6>
                <div id="form_banner" class="mb-2"></div>
                <button type="button" class="btn btn-sm btn-outline-dark mb-2" onclick="addRow('form_banner')"><i class="fas fa-plus me-1"></i>Tambah Banner</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveProsedur()"><i class="fas fa-save me-1"></i>Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- PORTOFOLIO DEMO: Firebase SDK modular asli diganti mock lokal (localStorage), tidak connect ke server manapun -->
<script type="module">
import { initializeApp, getDatabase, ref, set, onValue, getAuth, signInAnonymously } from "../../mitra/js/firebase-modular-mock.js";

const firebaseConfig = {
    apiKey: "DUMMY-SECRET-GANTI-SENDIRI",
    authDomain: "demo-project.firebaseapp.com",
    databaseURL: "https://demo-project-default-rtdb.firebaseio.com",
    projectId: "demo-project",
    storageBucket: "demo-project.firebasestorage.app"
};
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
signInAnonymously(auth).catch(err => console.error("Auth failed", err));

const db = getDatabase(app);
const prosedurRef = ref(db, 'b2b_prosedur_links');

let currentProsedurData = <?= json_encode($prosedur_data) ?>;

function renderUIButtons(data) {
    // Render Panduan
    let htmlPanduan = '<h6 class="fw-bold text-primary mb-3"><i class="fas fa-database me-2"></i>Data & Panduan Target</h6>';
    if(data.data_panduan) {
        data.data_panduan.forEach(item => {
            htmlPanduan += `<a href="${item.url}" target="_blank" class="btn-resource amunisi-btn mb-2">
                <i class="${item.icon} ${item.color} mt-1"></i> ${item.title}
            </a>`;
        });
    }
    document.getElementById('render_panduan').innerHTML = htmlPanduan;
    
    // Render Aset & Banner
    let htmlAsetBanner = '<h6 class="fw-bold text-accent mb-3"><i class="fas fa-paint-brush me-2"></i>Aset Visual & Branding</h6>';
    if(data.aset_visual) {
        data.aset_visual.forEach(item => {
            htmlAsetBanner += `<a href="${item.url}" target="_blank" class="btn-resource amunisi-btn mb-2">
                <i class="${item.icon} ${item.color} mt-1"></i> ${item.title}
            </a>`;
        });
    }
    htmlAsetBanner += '<h6 class="fw-bold text-dark mb-2 mt-3" style="font-size: 0.85rem;">7. Standar POS Material Banner:</h6>';
    if(data.banner) {
        data.banner.forEach(item => {
            htmlAsetBanner += `<a href="${item.url}" target="_blank" class="btn-resource amunisi-btn mb-1">
                <i class="${item.icon} ${item.color} mt-1"></i> ${item.title}
            </a>`;
        });
    }
    document.getElementById('render_aset_banner').innerHTML = htmlAsetBanner;
}

// LISTEN DATA FIREBASE
onValue(prosedurRef, (snapshot) => {
    if (snapshot.exists()) {
        const data = snapshot.val();
        currentProsedurData = data;
        
        // Update Modal Form
        renderList('form_panduan', data.data_panduan || []);
        renderList('form_aset', data.aset_visual || []);
        renderList('form_banner', data.banner || []);
        
        // Update Buttons UI
        renderUIButtons(data);
    } else {
        // Jika kosong di firebase, push local data ke firebase sebagai seed awal
        set(prosedurRef, currentProsedurData);
    }
});

// FORM LOGIC
window.renderList = function(containerId, items) {
    const container = document.getElementById(containerId);
    container.innerHTML = '';
    if (items && items.length > 0) {
        items.forEach(item => window.addRow(containerId, item));
    }
}

window.addRow = function(containerId, item = {title:'', url:'', icon:'', color:''}) {
    const icons = [
        {val: 'fas fa-file', label: '📄 File/Doc'},
        {val: 'fas fa-table', label: '📊 Tabel/Sheet'},
        {val: 'fas fa-map-marked-alt', label: '🗺️ Peta/Area'},
        {val: 'fas fa-hashtag', label: '📱 Sosmed'},
        {val: 'fas fa-image', label: '🖼️ Gambar/Flyer'},
        {val: 'fas fa-mobile-alt', label: '📲 HP/Story'},
        {val: 'fas fa-chalkboard-teacher', label: '👨‍🏫 Presentasi'},
        {val: 'fas fa-scroll', label: '📜 Spanduk'},
        {val: 'fas fa-pager', label: '📟 X-Banner'},
        {val: 'fas fa-link', label: '🔗 Link Web'}
    ];
    if(item.icon && !icons.find(i => i.val === item.icon)) icons.push({val: item.icon, label: item.icon});
    let iconOpts = icons.map(i => `<option value="${i.val}" ${(item.icon === i.val) ? 'selected' : ''}>${i.label}</option>`).join('');

    const colors = [
        {val: 'text-primary', label: '🟣 Ungu (Utama)', hex: '#7335B7'},
        {val: 'text-accent', label: '🟠 Oranye (Aksen)', hex: '#F3700D'},
        {val: 'text-success', label: '🟢 Hijau', hex: '#20c997'},
        {val: 'text-danger', label: '🔴 Merah', hex: '#dc3545'},
        {val: 'text-info', label: '🔵 Biru Muda', hex: '#0dcaf0'},
        {val: 'text-warning', label: '🟡 Kuning', hex: '#ffc107'},
        {val: 'text-dark', label: '⚫ Hitam', hex: '#212529'}
    ];
    if(item.color && !colors.find(c => c.val === item.color)) colors.push({val: item.color, label: item.color, hex: '#000'});
    let colorOpts = colors.map(c => `<option value="${c.val}" ${(item.color === c.val) ? 'selected' : ''} style="color:${c.hex}; font-weight:bold;">${c.label}</option>`).join('');

    const container = document.getElementById(containerId);
    const div = document.createElement('div');
    div.className = 'row mb-2 g-2 align-items-center form-row';
    div.innerHTML = `
        <div class="col-4"><input type="text" class="form-control form-control-sm i-title" placeholder="Judul" value="${(item.title||'').replace(/"/g, '&quot;')}"></div>
        <div class="col-3"><input type="text" class="form-control form-control-sm i-url" placeholder="URL Link" value="${(item.url||'').replace(/"/g, '&quot;')}"></div>
        <div class="col-2"><select class="form-select form-select-sm i-icon"><option value="">-- Icon --</option>${iconOpts}</select></div>
        <div class="col-2"><select class="form-select form-select-sm i-color"><option value="">-- Warna --</option>${colorOpts}</select></div>
        <div class="col-1 text-end"><button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.parentElement.remove()"><i class="fas fa-trash"></i></button></div>
    `;
    container.appendChild(div);
}

window.getRows = function(containerId) {
    return Array.from(document.getElementById(containerId).querySelectorAll('.form-row')).map(row => ({
        title: row.querySelector('.i-title').value,
        url: row.querySelector('.i-url').value,
        icon: row.querySelector('.i-icon').value,
        color: row.querySelector('.i-color').value
    }));
}

document.addEventListener('DOMContentLoaded', function() {
    // Render from PHP fallback first to avoid empty modal
    window.renderList('form_panduan', currentProsedurData.data_panduan || []);
    window.renderList('form_aset', currentProsedurData.aset_visual || []);
    window.renderList('form_banner', currentProsedurData.banner || []);
});

window.saveProsedur = function() {
    const btn = document.querySelector('button[onclick="saveProsedur()"]');
    const oldText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
    btn.disabled = true;

    const data = {
        data_panduan: window.getRows('form_panduan'),
        aset_visual: window.getRows('form_aset'),
        banner: window.getRows('form_banner')
    };
    
    set(prosedurRef, data).then(() => {
        bootstrap.Modal.getInstance(document.getElementById('modalAdminProsedur')).hide();
        btn.innerHTML = oldText;
        btn.disabled = false;
        // Notifikasi Toast jika ada, jika tidak alert biasa
        alert('Data berhasil disimpan ke Firebase!');
    }).catch((err) => {
        alert('Gagal menyimpan: ' + err.message);
        btn.innerHTML = oldText;
        btn.disabled = false;
    });
}
</script>

<?php include 'footer.php'; ?>