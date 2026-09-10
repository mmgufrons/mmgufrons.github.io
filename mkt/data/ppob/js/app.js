/**
 * app.js — PPOB SIMASRIM Dashboard (Orchestrator)
 * Mengatur: Login, Navigasi Tab, Upload Flow, Dashboard Render, CRM Modal
 */

// ================================================================
// KONFIGURASI GLOBAL
// ================================================================
const APP_CONFIG = {
    LOGIN_PASSWORD: 'simasrim2025', // Ganti password di sini
    DB_PATHS: {
        users:           'users',
        ppob:            'ppob_transactions',
        logistics:       'logistics',
        analytics_cache: 'analytics_cache'
    }
};

// ================================================================
// STATE APLIKASI
// ================================================================
const AppState = {
    users:        {},   // { email_key: { ... } }
    transactions: [],   // array flat semua transaksi PPOB
    logistics:    {},   // { resi_key: { ... } }
    segmented:    [],   // hasil CRMEngine.segment()
    trendData:    [],
    topKategori:  [],
    topProduk:    [],
    summary:      {},
    filterStatus: 'all',
    filterSearch: '',
    filterSegmen: 'all',
    loaded:       false
};

// ================================================================
// UTILITY: Toast Notification
// ================================================================
function showToast(msg, type = 'info') {
    const icons = { success: 'bx-check-circle', error: 'bx-error', info: 'bx-info-circle' };
    const container = document.getElementById('toast-container');
    if (!container) return;
    const el = document.createElement('div');
    el.className = `toast ${type}`;
    el.innerHTML = `<i class='bx ${icons[type] || icons.info}'></i><span class="toast-msg">${msg}</span>`;
    container.appendChild(el);
    setTimeout(() => {
        el.style.animation = 'slideOut 0.3s ease forwards';
        setTimeout(() => el.remove(), 350);
    }, 3500);
}

// ================================================================
// UTILITY: Format Rupiah (tampilan)
// ================================================================
function fmt(num) { return PPOBParser.formatRupiah(num); }

// ================================================================
// UTILITY: Format angka singkat (1jt, 500rb)
// ================================================================
function fmtShort(num) {
    if (num >= 1_000_000_000) return 'Rp ' + (num / 1_000_000_000).toFixed(1) + 'M';
    if (num >= 1_000_000)     return 'Rp ' + (num / 1_000_000).toFixed(1) + 'jt';
    if (num >= 1_000)         return 'Rp ' + (num / 1_000).toFixed(0) + 'rb';
    return fmt(num);
}

// ================================================================
// NAVIGASI TAB
// ================================================================
function initNavigation() {
    document.querySelectorAll('.nav-links li[data-target]').forEach(li => {
        li.addEventListener('click', (e) => {
            e.preventDefault();
            const target = li.dataset.target;
            switchTab(target);
        });
    });
}

function switchTab(tabId) {
    document.querySelectorAll('.nav-links li').forEach(li => li.classList.remove('active'));
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));

    const navItem = document.querySelector(`.nav-links li[data-target="${tabId}"]`);
    const tabPane = document.getElementById(tabId);
    if (navItem) navItem.classList.add('active');
    if (tabPane) tabPane.classList.add('active');

    const titles = {
        'dashboard': 'Dashboard Analytics',
        'upload':    'Upload Data',
        'crm':       'CRM & Segmentasi User',
        'transaksi': 'Data Transaksi PPOB',
        'tutorial':  'Tutorial Penggunaan'
    };
    const el = document.getElementById('page-title');
    if (el) el.textContent = titles[tabId] || tabId;
}

// ================================================================
// LOGIN
// ================================================================
function initLogin() {
    // Login screen removed in favor of global MKT Hub login
    loadAllData();
}

// ================================================================
// LOAD DATA DARI FIREBASE
// ================================================================
async function loadAllData() {
    try {
        updateDbStatus('loading');
        const [usersRaw, ppobRaw, logisticsRaw] = await Promise.all([
            FirebaseAPI.get(APP_CONFIG.DB_PATHS.users).catch(() => null),
            FirebaseAPI.get(APP_CONFIG.DB_PATHS.ppob).catch(() => null),
            FirebaseAPI.get(APP_CONFIG.DB_PATHS.logistics).catch(() => null)
        ]);

        AppState.users     = usersRaw || {};
        AppState.logistics = logisticsRaw || {};
        AppState.transactions = ppobRaw
            ? Object.values(ppobRaw).filter(t => t && typeof t === 'object')
            : [];

        AppState.loaded = true;
        processAndRender();
        updateDbStatus('ok');

        // Jika Firebase masih kosong → tampilkan saran demo
        if (AppState.transactions.length === 0 && Object.keys(AppState.users).length === 0) {
            showEmptyFirebaseBanner();
        }
    } catch (err) {
        console.error('Load Error:', err);
        showToast('Gagal memuat data dari Firebase. Cek koneksi.', 'error');
        updateDbStatus('error');
    }
}

function updateDbStatus(state) {
    const el = document.getElementById('db-status');
    if (!el) return;
    const map = {
        ok:      { text: 'Database Terhubung', cls: 'success' },
        loading: { text: 'Memuat Data...', cls: 'info' },
        error:   { text: 'Koneksi Gagal', cls: 'danger' }
    };
    const s = map[state] || map.ok;
    el.className = `badge-status ${s.cls}`;
    el.innerHTML = `<span class="dot"></span>${s.text}`;
}

// ================================================================
// BANNER: Firebase Kosong
// ================================================================
function showEmptyFirebaseBanner() {
    // Cek apakah banner sudah ada
    if (document.getElementById('demo-banner')) return;

    const dashboard = document.getElementById('dashboard');
    if (!dashboard) return;

    const banner = document.createElement('div');
    banner.id = 'demo-banner';
    banner.style.cssText = `
        background: linear-gradient(135deg, #1e1e2f 0%, #3A1B5E 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        color: white;
    `;
    banner.innerHTML = `
        <div style="font-size:3rem; flex-shrink:0;">🚀</div>
        <div style="flex:1;">
            <h2 style="font-size:1.1rem;font-weight:800;margin-bottom:6px;color:#fff;">
                Selamat Datang di SIMASRIM PPOB Dashboard!
            </h2>
            <p style="font-size:0.85rem;color:rgba(255,255,255,0.65);line-height:1.6;">
                Database Firebase masih kosong. Upload file data dari menu <strong style="color:#F3700D;">Upload Data</strong>,
                atau coba lihat demo dashboard dengan data contoh terlebih dahulu.
            </p>
        </div>
        <div style="display:flex;gap:10px;flex-shrink:0;">
            <button onclick="document.querySelector('[data-target=upload]').click()" 
                class="btn" style="background:var(--accent);color:#fff;box-shadow:0 4px 16px rgba(243,112,13,0.4);">
                <i class='bx bx-upload'></i> Upload Data
            </button>
            <button onclick="loadDemoData(); document.getElementById('demo-banner').remove();"
                class="btn btn-ghost" style="background:rgba(255,255,255,0.1);color:#fff;border-color:rgba(255,255,255,0.2);">
                <i class='bx bx-play-circle'></i> Lihat Demo
            </button>
        </div>
    `;

    // Sisipkan di awal section dashboard (sebelum summary-cards)
    const contentArea = dashboard.querySelector('.content-area');
    if (contentArea) {
        contentArea.insertBefore(banner, contentArea.firstChild);
    }
}

// ================================================================
// PROSES DATA & RENDER
// ================================================================
function processAndRender() {
    // Hitung agregasi
    AppState.summary     = CRMEngine.getSummary(AppState.transactions, AppState.users);
    AppState.trendData   = CRMEngine.getTrend(AppState.transactions, 'month');
    AppState.topKategori = CRMEngine.getTopKategori(AppState.transactions, 8);
    AppState.topProduk   = CRMEngine.getTopProduk(AppState.transactions, 10);
    AppState.segmented   = CRMEngine.segment(AppState.users, AppState.transactions, AppState.logistics);

    renderDashboard();
    renderCRMTable();
    renderTransaksiTable();
}

// ================================================================
// RENDER DASHBOARD
// ================================================================
function renderDashboard() {
    const s = AppState.summary;

    // Cards
    document.getElementById('card-total-trx').textContent    = s.totalTrx.toLocaleString('id-ID');
    document.getElementById('card-total-volume').textContent  = fmtShort(s.totalVolume);
    document.getElementById('card-total-profit').textContent  = fmtShort(s.totalProfit);
    document.getElementById('card-user-aktif').textContent    = s.totalUserAktif.toLocaleString('id-ID');

    // Trend sub info
    const trend = AppState.trendData;
    if (trend.length >= 2) {
        const last = trend[trend.length - 1];
        const prev = trend[trend.length - 2];
        const pct  = prev.count > 0 ? (((last.count - prev.count) / prev.count) * 100).toFixed(1) : 0;
        const trendEl = document.getElementById('card-trx-trend');
        if (trendEl) {
            trendEl.textContent = `${pct >= 0 ? '+' : ''}${pct}% vs bulan lalu`;
            trendEl.className   = `card-trend ${pct >= 0 ? 'up' : 'down'}`;
        }
    }

    // Charts
    setTimeout(() => {
        if (AppState.trendData.length > 0) {
            DashboardCharts.renderTrend('chart-trend', AppState.trendData);
            DashboardCharts.renderProfitBar('chart-profit', AppState.trendData);
        }
        if (AppState.topKategori.length > 0) {
            DashboardCharts.renderKategoriDoughnut('chart-kategori', AppState.topKategori);
        }
        if (AppState.topProduk.length > 0) {
            DashboardCharts.renderTopProdukBar('chart-produk', AppState.topProduk);
        }
        if (AppState.segmented.length > 0) {
            DashboardCharts.renderSegmenPie('chart-segmen', AppState.segmented);
        }
    }, 100);
}

// ================================================================
// RENDER TABEL CRM LEADERBOARD
// ================================================================
function renderCRMTable() {
    const tbody = document.getElementById('crm-tbody');
    if (!tbody) return;

    let data = AppState.segmented.filter(u => u.total_trx > 0 || u.has_logistic);

    // Filter segmen
    const segFilter = document.getElementById('filter-segmen')?.value || 'all';
    if (segFilter !== 'all') data = data.filter(u => u.segmen_code === segFilter);

    // Filter search
    const search = (document.getElementById('filter-crm-search')?.value || '').toLowerCase();
    if (search) data = data.filter(u =>
        u.nama.toLowerCase().includes(search) ||
        u.email.toLowerCase().includes(search)
    );

    if (data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="8"><div class="empty-state"><i class='bx bx-user-x'></i><h3>Tidak ada data user</h3><p>Upload Data Master User dan Transaksi PPOB terlebih dahulu</p></div></td></tr>`;
        return;
    }

    const rankClasses = ['gold', 'silver', 'bronze'];

    tbody.innerHTML = data.slice(0, 200).map((user, i) => {
        const rk   = rankClasses[i] || 'normal';
        const waOk = user.no_wa && user.no_wa.length >= 8;
        const segBadgeClass = { champion:'champion', micro:'micro', crosssell:'crosssell', atrisk:'atrisk', active:'micro', inactive:'atrisk' }[user.segmen_code] || 'micro';

        return `
        <tr data-key="${user.key}" class="crm-row">
            <td><span class="rank-badge ${rk}">${i + 1}</span></td>
            <td>
                <button class="user-name-link" onclick="openCRMModal('${user.key}')">
                    <i class='bx bx-user-circle'></i>${escHtml(user.nama)}
                </button>
            </td>
            <td style="color:var(--text-muted);font-size:0.8rem;">${escHtml(user.email)}</td>
            <td><span class="seg-badge ${segBadgeClass}">${user.segmen}</span></td>
            <td style="font-weight:700;text-align:right;">${user.total_trx.toLocaleString('id-ID')}</td>
            <td style="text-align:right;">${fmtShort(user.total_volume)}</td>
            <td style="text-align:right;font-weight:700;color:${user.total_profit >= 0 ? 'var(--success)' : 'var(--danger)'}">${fmtShort(user.total_profit)}</td>
            <td>
                ${waOk
                    ? `<button class="btn btn-wa btn-sm" onclick="openWA('${user.key}')"><i class='bx bxl-whatsapp'></i> Chat</button>`
                    : `<span style="color:var(--text-light);font-size:0.78rem;">No WA –</span>`
                }
            </td>
        </tr>`;
    }).join('');

    // Update counter
    const counterEl = document.getElementById('crm-count');
    if (counterEl) counterEl.textContent = `${data.length} user`;
}

// ================================================================
// RENDER TABEL TRANSAKSI
// ================================================================
function renderTransaksiTable(filterFn = null) {
    const tbody = document.getElementById('trx-tbody');
    if (!tbody) return;

    let data = [...AppState.transactions];

    // Search
    const search = (document.getElementById('filter-trx-search')?.value || '').toLowerCase();
    if (search) data = data.filter(t =>
        (t.nama_produk || '').toLowerCase().includes(search) ||
        (t.kategori || '').toLowerCase().includes(search) ||
        (t.kode_transaksi || '').toLowerCase().includes(search) ||
        (t.email || '').toLowerCase().includes(search)
    );

    // Kategori filter
    const katFilter = document.getElementById('filter-trx-kat')?.value || 'all';
    if (katFilter !== 'all') data = data.filter(t => t.kategori === katFilter);

    // Sort by date desc
    data.sort((a, b) => {
        if (!a.tanggal_beli && !b.tanggal_beli) return 0;
        if (!a.tanggal_beli) return 1;
        if (!b.tanggal_beli) return -1;
        return b.tanggal_beli.localeCompare(a.tanggal_beli);
    });

    if (data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="8"><div class="empty-state"><i class='bx bx-receipt'></i><h3>Tidak ada transaksi</h3><p>Upload file transaksi PPOB dari halaman Upload Data</p></div></td></tr>`;
        return;
    }

    tbody.innerHTML = data.slice(0, 500).map(t => {
        const profitColor = (t.profit || 0) >= 0 ? 'var(--success)' : 'var(--danger)';
        const statusColor = { 'SUCCESS': 'var(--success)', 'GAGAL': 'var(--danger)', 'PENDING': 'var(--warning)' }[t.status] || 'var(--text-muted)';

        return `
        <tr>
            <td style="font-size:0.78rem;color:var(--text-muted);">${t.tanggal_beli || '–'}</td>
            <td style="font-size:0.78rem;font-family:monospace;">${escHtml(t.kode_transaksi || '–')}</td>
            <td><span style="background:var(--primary-light);color:var(--primary);font-size:0.72rem;font-weight:700;padding:3px 8px;border-radius:20px;">${escHtml(t.kategori || '–')}</span></td>
            <td style="font-weight:600;">${escHtml(t.nama_produk || '–')}</td>
            <td style="text-align:right;">${fmt(t.tagihan_user || 0)}</td>
            <td style="text-align:right;color:var(--accent);">-${fmt(t.cashback_user || 0)}</td>
            <td style="text-align:right;font-weight:700;color:${profitColor};">${fmt(t.profit || 0)}</td>
            <td><span style="font-size:0.75rem;font-weight:700;color:${statusColor};">${escHtml(t.status || '–')}</span></td>
        </tr>`;
    }).join('');

    const cEl = document.getElementById('trx-count');
    if (cEl) cEl.textContent = `${data.length} transaksi`;

    // Isi dropdown kategori
    const katEl = document.getElementById('filter-trx-kat');
    if (katEl && katEl.options.length <= 1) {
        const cats = [...new Set(AppState.transactions.map(t => t.kategori).filter(Boolean))].sort();
        cats.forEach(c => {
            const opt = document.createElement('option');
            opt.value = c; opt.textContent = c;
            katEl.appendChild(opt);
        });
    }
}

// ================================================================
// CRM MODAL
// ================================================================
function openCRMModal(key) {
    const user    = AppState.segmented.find(u => u.key === key);
    if (!user) return;

    const template = CRMEngine.generateWATemplate(user);
    const waUrl    = user.no_wa ? CRMEngine.buildWAUrl(user.no_wa, template) : null;

    const initial = (user.nama || 'U').charAt(0).toUpperCase();
    const segBadgeMap = { champion:'champion', micro:'micro', crosssell:'crosssell', atrisk:'atrisk', active:'micro', inactive:'atrisk' };
    const segClass = segBadgeMap[user.segmen_code] || 'micro';

    document.getElementById('modal-user-initial').textContent = initial;
    document.getElementById('modal-user-name').textContent    = user.nama || '(Tanpa Nama)';
    document.getElementById('modal-user-email').textContent   = user.email || '';
    document.getElementById('modal-segmen-badge').className   = `seg-badge ${segClass}`;
    document.getElementById('modal-segmen-badge').textContent = user.segmen;
    document.getElementById('modal-stat-trx').textContent     = user.total_trx.toLocaleString('id-ID');
    document.getElementById('modal-stat-volume').textContent  = fmtShort(user.total_volume);
    document.getElementById('modal-stat-profit').textContent  = fmtShort(user.total_profit);
    document.getElementById('modal-fav-produk').textContent   = user.fav_kategori || '–';
    document.getElementById('modal-origin').textContent       = user.origin || '–';
    document.getElementById('modal-kategori').textContent     = user.kategori || '–';
    document.getElementById('modal-last-trx').textContent     = user.last_trx_date || '–';
    document.getElementById('modal-wa-template').textContent  = template;

    const waBtn = document.getElementById('modal-wa-btn');
    if (waUrl) {
        waBtn.href = waUrl;
        waBtn.target = '_blank';
        waBtn.removeAttribute('disabled');
        waBtn.style.opacity = '1';
    } else {
        waBtn.href = '#';
        waBtn.setAttribute('disabled', 'disabled');
        waBtn.style.opacity = '0.4';
    }

    document.getElementById('crm-modal-overlay').classList.remove('hidden');
}

function closeCRMModal() {
    document.getElementById('crm-modal-overlay').classList.add('hidden');
}

function openWA(key) {
    const user = AppState.segmented.find(u => u.key === key);
    if (!user || !user.no_wa) { showToast('Nomor WA tidak tersedia', 'error'); return; }
    const template = CRMEngine.generateWATemplate(user);
    const url = CRMEngine.buildWAUrl(user.no_wa, template);
    if (url) window.open(url, '_blank');
}

// ================================================================
// UPLOAD FLOW
// ================================================================
function initUpload() {
    const panels = ['master', 'ppob', 'logistik'];

    panels.forEach(panel => {
        const dropZone  = document.getElementById(`drop-${panel}`);
        const fileInput = document.getElementById(`file-${panel}`);
        const fileSel   = document.getElementById(`file-sel-${panel}`);
        const fileNameEl= document.getElementById(`fname-${panel}`);
        const btnUpload = document.getElementById(`btn-upload-${panel}`);
        const progWrap  = document.getElementById(`prog-${panel}`);
        const progFill  = document.getElementById(`pfill-${panel}`);
        const progLabel = document.getElementById(`plabel-${panel}`);

        if (!dropZone || !fileInput) return;

        dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('dragover'); });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            if (e.dataTransfer.files[0]) handleFileSelect(panel, e.dataTransfer.files[0]);
        });
        fileInput.addEventListener('change', () => {
            if (fileInput.files[0]) handleFileSelect(panel, fileInput.files[0]);
        });

        btnUpload?.addEventListener('click', () => doUpload(panel, progWrap, progFill, progLabel, btnUpload));
    });

    // Tab switching in upload
    document.querySelectorAll('.upload-tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.upload-tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.upload-panel').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            const target = document.getElementById(`panel-${btn.dataset.panel}`);
            if (target) target.classList.add('active');
        });
    });
}

function handleFileSelect(panel, file) {
    const fileSel   = document.getElementById(`file-sel-${panel}`);
    const fileNameEl= document.getElementById(`fname-${panel}`);
    const btnUpload = document.getElementById(`btn-upload-${panel}`);
    const dropZone  = document.getElementById(`drop-${panel}`);

    if (fileNameEl) fileNameEl.textContent = file.name;
    if (fileSel)    fileSel.classList.add('show');
    if (dropZone)   dropZone.style.display = 'none';
    if (btnUpload)  btnUpload.disabled = false;

    // Simpan file di element
    if (btnUpload) btnUpload._file = file;
}

async function doUpload(panel, progWrap, progFill, progLabel, btnUpload) {
    const file = btnUpload?._file;
    if (!file) { showToast('Pilih file terlebih dahulu', 'error'); return; }

    if (progWrap)  progWrap.style.display = 'block';
    if (btnUpload) btnUpload.disabled = true;

    const onProgress = (pct, msg) => {
        if (progFill)  progFill.style.width  = pct + '%';
        if (progLabel) progLabel.textContent = msg;
    };

    try {
        let parsed;
        if (panel === 'master') {
            parsed = await PPOBParser.parseMasterUser(file, onProgress);
            onProgress(95, 'Mengunggah ke Firebase...');
            await FirebaseAPI.batchUpsert(APP_CONFIG.DB_PATHS.users, parsed.users);
            AppState.users = { ...AppState.users, ...parsed.users };
            showToast(`✅ ${parsed.meta.imported} user berhasil disinkronisasi!`, 'success');

        } else if (panel === 'ppob') {
            parsed = await PPOBParser.parsePPOB(file, onProgress);
            onProgress(95, 'Mengunggah ke Firebase...');
            await FirebaseAPI.batchUpsert(APP_CONFIG.DB_PATHS.ppob, parsed.ppob_transactions);
            // Merge ke state
            const newTrx = Object.values(parsed.ppob_transactions);
            const existingKeys = new Set(AppState.transactions.map(t => t.kode_transaksi));
            newTrx.forEach(t => {
                if (existingKeys.has(t.kode_transaksi)) {
                    const idx = AppState.transactions.findIndex(x => x.kode_transaksi === t.kode_transaksi);
                    if (idx !== -1) AppState.transactions[idx] = t;
                } else {
                    AppState.transactions.push(t);
                }
            });
            showToast(`✅ ${parsed.meta.imported} transaksi PPOB disinkronisasi! Profit total: ${fmt(parsed.meta.total_profit)}`, 'success');

        } else if (panel === 'logistik') {
            parsed = await PPOBParser.parseLogistik(file, onProgress);
            onProgress(95, 'Mengunggah ke Firebase...');
            await FirebaseAPI.batchUpsert(APP_CONFIG.DB_PATHS.logistics, parsed.logistics);
            AppState.logistics = { ...AppState.logistics, ...parsed.logistics };
            showToast(`✅ ${parsed.meta.imported} resi logistik disinkronisasi!`, 'success');
        }

        onProgress(100, 'Selesai!');
        processAndRender(); // Re-render dashboard

    } catch (err) {
        console.error('Upload error:', err);
        showToast('❌ Gagal memproses file: ' + err.message, 'error');
        onProgress(0, 'Gagal!');
    } finally {
        setTimeout(() => {
            if (progWrap) progWrap.style.display = 'none';
            if (btnUpload) btnUpload.disabled = false;
            // Reset file
            const dropZone  = document.getElementById(`drop-${panel}`);
            const fileSel   = document.getElementById(`file-sel-${panel}`);
            if (dropZone) dropZone.style.display = '';
            if (fileSel)  fileSel.classList.remove('show');
            if (btnUpload) btnUpload._file = null;
        }, 1500);
    }
}

// ================================================================
// UTILITY: Escape HTML
// ================================================================
function escHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

// ================================================================
// INIT FILTER LISTENERS
// ================================================================
function initFilters() {
    // CRM filters
    document.getElementById('filter-segmen')?.addEventListener('change', renderCRMTable);
    document.getElementById('filter-crm-search')?.addEventListener('input', renderCRMTable);

    // Transaksi filters
    document.getElementById('filter-trx-search')?.addEventListener('input', renderTransaksiTable);
    document.getElementById('filter-trx-kat')?.addEventListener('change', renderTransaksiTable);

    // Modal close
    document.getElementById('modal-close-btn')?.addEventListener('click', closeCRMModal);
    document.getElementById('crm-modal-overlay')?.addEventListener('click', (e) => {
        if (e.target === e.currentTarget) closeCRMModal();
    });

    // Refresh btn
    document.getElementById('btn-refresh')?.addEventListener('click', () => {
        showToast('Memuat ulang data dari Firebase...', 'info');
        loadAllData();
    });

    // Filter periode pada dashboard
    document.getElementById('filter-period')?.addEventListener('change', function() {
        applyPeriodFilter(this.value);
    });
}

function applyPeriodFilter(period) {
    if (!period || period === 'all') {
        AppState.trendData   = CRMEngine.getTrend(AppState.transactions, 'month');
        AppState.topKategori = CRMEngine.getTopKategori(AppState.transactions, 8);
        AppState.topProduk   = CRMEngine.getTopProduk(AppState.transactions, 10);
        AppState.summary     = CRMEngine.getSummary(AppState.transactions, AppState.users);
        renderDashboard();
        return;
    }
    const now = new Date();
    const cutoff = new Date();
    if (period === '7d')  cutoff.setDate(now.getDate() - 7);
    if (period === '30d') cutoff.setDate(now.getDate() - 30);
    if (period === '90d') cutoff.setDate(now.getDate() - 90);

    const filtered = AppState.transactions.filter(t => {
        if (!t.tanggal_beli) return false;
        return new Date(t.tanggal_beli) >= cutoff;
    });

    AppState.trendData   = CRMEngine.getTrend(filtered, period === '7d' ? 'day' : 'month');
    AppState.topKategori = CRMEngine.getTopKategori(filtered, 8);
    AppState.topProduk   = CRMEngine.getTopProduk(filtered, 10);
    AppState.summary     = CRMEngine.getSummary(filtered, AppState.users);
    renderDashboard();
}

// ================================================================
// MAIN INIT
// ================================================================
document.addEventListener('DOMContentLoaded', () => {
    initLogin();
    initNavigation();
    initUpload();
    initFilters();
});
