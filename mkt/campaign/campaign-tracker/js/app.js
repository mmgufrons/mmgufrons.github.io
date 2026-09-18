/**
 * app.js — Campaign SIMASRIM (Orchestrator)
 * Mengatur: Login, Navigasi, Mode (WA/Email), Upload Wizard, Dashboard & CRM Table
 */

// ================================================================
// KONFIGURASI GLOBAL
// ================================================================
const APP_CONFIG = {
    LOGIN_PASSWORD: 'demo123', // PORTOFOLIO DEMO: password asli dihapus
    DB_PATHS: {
        wa:    'master_leads/whatsapp',
        email: 'master_leads/email'
    }
};

// ================================================================
// STATE APLIKASI
// ================================================================
const AppState = {
    mode: 'wa', // 'wa' | 'email'
    leads_wa: {},
    leads_email: {},
    _filteredLeads: [], // Cache untuk pagination
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
// MODE SWITCHER (WA / Email)
// ================================================================
function initModeSwitcher() {
    document.querySelectorAll('.mode-tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const mode = btn.dataset.mode;
            setMode(mode);
        });
    });
}

function setMode(mode) {
    if (AppState.mode === mode) return;
    AppState.mode = mode;

    // Update Sidebar Tabs
    document.querySelectorAll('.mode-tab-btn').forEach(b => b.classList.remove('active'));
    const activeBtn = document.querySelector(`.mode-tab-btn[data-mode="${mode}"]`);
    if (activeBtn) activeBtn.classList.add('active');

    // Update Topbar Badge
    const tb = document.getElementById('mode-badge-topbar');
    if (tb) {
        tb.className = `mode-badge ${mode}`;
        tb.innerHTML = mode === 'wa' ? `<i class='bx bxl-whatsapp'></i> WhatsApp Mode` : `<i class='bx bx-envelope'></i> Email Mode`;
    }

    // Update Table Title
    const tt = document.getElementById('leads-table-title');
    if (tt) {
        tt.innerHTML = mode === 'wa' ? `📋 Master Leads — WhatsApp` : `📋 Master Leads — Email`;
    }

    // Reset filters
    const searchEl = document.getElementById('filter-search');
    if (searchEl) searchEl.value = '';

    // Re-render Data
    CRMTracker.deselectAll();
    CRMTracker.buildHeader(mode);
    updateFilterOptions();
    renderDashboard();
    renderLeadsTable();
    updateBadges();
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
    
    // Smooth fade in
    if (tabPane) {
        tabPane.style.animation = 'none';
        tabPane.offsetHeight; // trigger reflow
        tabPane.style.animation = 'fadeSlideUp 0.3s var(--t-slow) forwards';
    }

    const titles = {
        'dashboard':  'Dashboard Campaign',
        'leads':      'Master Leads CRM',
        'upload':     'Upload & Cleansing',
        'broadcast':  'WA Broadcast',
        'leadgen':    'Cari Leads Baru',
        'tutorial':   'Panduan Penggunaan'
    };
    const el = document.getElementById('page-title');
    if (el) el.textContent = titles[tabId] || tabId;
}

// ================================================================
// LOGIN — Disabled: Auth handled by PHP session (mkt/login.php)
// ================================================================
function initLogin() {
    // Auth sudah dihandle server-side, langsung tampilkan app dan load data
    const overlay = document.getElementById('login-screen');
    const appCont = document.getElementById('main-app');
    if (overlay) overlay.style.display = 'none';
    if (appCont) appCont.style.display = 'flex';
    loadAllData();
}

// ================================================================
// LOAD DATA DARI FIREBASE
// ================================================================
function updateDbStatus(state) {
    const el = document.getElementById('db-status');
    if (!el) return;
    const map = {
        ok:      { text: 'Database Terhubung', cls: 'success' },
        loading: { text: 'Memuat Data...', cls: 'loading' },
        error:   { text: 'Koneksi Gagal', cls: 'danger' }
    };
    const s = map[state] || map.ok;
    el.className = `badge-status ${s.cls}`;
    el.innerHTML = `<span class="dot"></span>${s.text}`;
}

function renderSkeletons() {
    const tableBody = document.getElementById('leads-tbody');
    if (tableBody) {
        let sk = '';
        for(let i=0; i<8; i++) {
            sk += `<tr>
                <td><div class="skeleton" style="width:20px;height:20px;"></div></td>
                <td><div class="skeleton" style="width:20px;height:20px;"></div></td>
                <td><div class="skeleton" style="width:80px;height:20px;"></div></td>
                <td><div class="skeleton" style="width:120px;height:20px;"></div></td>
                <td><div class="skeleton" style="width:100px;height:20px;"></div></td>
                <td colspan="10"><div class="skeleton" style="width:100%;height:20px;"></div></td>
            </tr>`;
        }
        tableBody.innerHTML = sk;
    }

    ['card-total','card-hot','card-warm','card-cold','card-noresponse','card-sent'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.innerHTML = `<div class="skeleton" style="width:50%;height:25px;margin-top:5px;"></div>`;
    });
}

async function loadAllData() {
    try {
        // Kalau sebelumnya sempat klik "Muat Demo", flag ini bikin SEMUA simpan
        // (edit inline, bulk, cari&ganti massal, tambah manual) diam-diam jadi
        // "lokal saja" tanpa pernah kirim ke Firebase — walau toast-nya beda teks
        // ("Demo Mode: Tersimpan secara lokal"), gampang tidak disadari. Begitu
        // data ASLI dimuat (fungsi ini), sesi demo dianggap berakhir.
        sessionStorage.removeItem('campaign_demo');

        updateDbStatus('loading');
        renderSkeletons();
        const [waRaw, emailRaw] = await Promise.all([
            FirebaseAPI.get(APP_CONFIG.DB_PATHS.wa).catch(() => null),
            FirebaseAPI.get(APP_CONFIG.DB_PATHS.email).catch(() => null)
        ]);

        AppState.leads_wa    = waRaw || {};
        AppState.leads_email = emailRaw || {};

        // PENTING: data dari Firebase tidak menyimpan key node di dalam value-nya
        // (lihat LeadsCleaner.toFirebaseObject yang sengaja memisahkan _key dari data).
        // Object.values() di renderLeadsTable/renderDashboard akan kehilangan key ini,
        // jadi harus disuntikkan balik ke tiap object di sini supaya checkbox/edit/hapus/
        // broadcast/copy per baris bisa membedakan satu leads dengan leads lainnya.
        Object.keys(AppState.leads_wa).forEach(k => { AppState.leads_wa[k]._key = k; });
        Object.keys(AppState.leads_email).forEach(k => { AppState.leads_email[k]._key = k; });

        updateDbStatus('ok');
        
        // Cek Firebase kosong -> otomatis muat data demo untuk portofolio publik
        const isEmpty = Object.keys(AppState.leads_wa).length === 0 && Object.keys(AppState.leads_email).length === 0;
        if (isEmpty) {
            loadDemoData();
            return;
        }

        CRMTracker.buildHeader(AppState.mode);
        updateBadges();
        updateFilterOptions();
        renderDashboard();
        renderLeadsTable();

    } catch (err) {
        console.warn('Load Firebase Error (falling back to demo data):', err);
        loadDemoData();
    }
}

// ================================================================
// RENDER DASHBOARD
// ================================================================
function renderDashboard() {
    const leadsObj = AppState.mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
    const allLeads = Object.values(leadsObj);

    // Union global WA+Email (dedup by _key) — dipakai KHUSUS utk metrik yang memang
    // properti tiap lead, bukan properti "tab mode yang lagi dibuka" (mis. Kontak
    // Lengkap WA+Email, badge FU sidebar) — supaya angkanya TIDAK berubah cuma
    // karena toggle mode WA/Email (sebelumnya bug: dihitung dari 1 tree saja).
    const globalLeadsMap = new Map();
    Object.values(AppState.leads_wa).forEach(l => { if (l._key) globalLeadsMap.set(l._key, l); });
    Object.values(AppState.leads_email).forEach(l => { if (l._key) globalLeadsMap.set(l._key, l); });
    const globalLeads = [...globalLeadsMap.values()];

    // Populate opsi filter dashboard dari SELURUH data (bukan hasil filter sendiri,
    // supaya opsi tidak menyusut begitu 1 filter dipilih)
    const dashOpts = LeadsFilter.buildOptions(allLeads);
    LeadsFilter.populateSelect(document.getElementById('dash-filter-brand'), dashOpts.brands, 'Semua Brand');
    LeadsFilter.populateSelect(document.getElementById('dash-filter-produk'), dashOpts.produks, 'Semua Produk');
    LeadsFilter.populateSelect(document.getElementById('dash-filter-provinsi'), dashOpts.provinsis, 'Semua Area Utama');
    LeadsFilter.populateSelect(document.getElementById('dash-filter-area'), dashOpts.areas, 'Semua Sub Area');
    LeadsFilter.populateSelect(document.getElementById('dash-filter-pic'), dashOpts.pics, 'Semua PIC');

    const leads = LeadsFilter.apply(allLeads, {
        brand:    document.getElementById('dash-filter-brand')?.value || '',
        produk:   document.getElementById('dash-filter-produk')?.value || '',
        provinsi: document.getElementById('dash-filter-provinsi')?.value || '',
        area:     document.getElementById('dash-filter-area')?.value || '',
        pic:      document.getElementById('dash-filter-pic')?.value || '',
        dateFrom: document.getElementById('dash-filter-date-from')?.value || '',
        dateTo:   document.getElementById('dash-filter-date-to')?.value || '',
    });

    // Hitung stat (All brand)
    let hot = 0, warm = 0, cold = 0, nores = 0, sent = 0, fuNeeded = 0, activeToday = 0;
    const today = new Date().toISOString().split('T')[0];
    // Per-PIC: total leads Hot/Warm/Closing yang digarap + berapa yang closing —
    // dipakai leaderboard rasio konversi (bukan cuma volume closing mentah),
    // supaya PIC dengan leads sedikit tapi closing tinggi tidak kalah kelihatan
    // dibanding PIC dengan leads banyak tapi closing-nya rendah.
    const picStats = {};
    const fuLeads = [];
    leads.forEach(l => {
        const t = (l.tipe_leads || 'New');
        if (t === 'Hot') hot++;
        if (t === 'Warm') warm++;
        if (t === 'Cold' || t === 'Cold / Dead') cold++;

        if (!l.respon && l.tahap) nores++;
        if (l.tahap) sent++;
        const fuStatus = typeof getFollowUpStatus === 'function' ? getFollowUpStatus(l) : null;
        if (fuStatus) { fuNeeded++; fuLeads.push({ lead: l, status: fuStatus }); }
        if (l.updated_at === today) activeToday++;

        const isClosing = String(l.tahap || '').toUpperCase() === 'CLOSING';
        if (l.pic_garap && (t === 'Hot' || t === 'Warm' || isClosing)) {
            // Key dinormalisasi (case/spasi-insensitive) supaya "Budi" & "budi" tidak
            // dihitung sebagai 2 PIC berbeda di leaderboard — label tampilan tetap
            // pakai penulisan ASLI kemunculan pertama (`label`).
            const picKey = LeadsFilter.normKey(l.pic_garap);
            const s = picStats[picKey] || (picStats[picKey] = { label: l.pic_garap, handled: 0, closing: 0 });
            s.handled++;
            if (isClosing) s.closing++;
        }
    });

    document.getElementById('card-total').textContent = leads.length.toLocaleString('id-ID');
    document.getElementById('card-total-sub').textContent = `${AppState.mode.toUpperCase()} Mode`;
    document.getElementById('card-hot').textContent   = hot.toLocaleString('id-ID');
    document.getElementById('card-warm').textContent  = warm.toLocaleString('id-ID');
    document.getElementById('card-cold').textContent  = cold.toLocaleString('id-ID');
    document.getElementById('card-noresponse').textContent = nores.toLocaleString('id-ID');
    document.getElementById('card-sent').textContent  = sent.toLocaleString('id-ID');
    const cardFuNeeded = document.getElementById('card-fu-needed');
    if (cardFuNeeded) cardFuNeeded.textContent = fuNeeded.toLocaleString('id-ID');
    const cardActiveToday = document.getElementById('card-active-today');
    if (cardActiveToday) cardActiveToday.textContent = activeToday.toLocaleString('id-ID');
    const cardDualContact = document.getElementById('card-dual-contact');
    if (cardDualContact) {
        // Global (union WA+Email) — angkanya harus SAMA terlepas mode WA/Email yang
        // sedang aktif, karena ini properti tiap lead, bukan properti tab tampilan.
        const dualContact = globalLeads.reduce((n, l) => n + (l.phone && l.email ? 1 : 0), 0);
        cardDualContact.textContent = dualContact.toLocaleString('id-ID');
        const pct = globalLeads.length > 0 ? Math.round((dualContact / globalLeads.length) * 100) : 0;
        const cardDualContactSub = document.getElementById('card-dual-contact-sub');
        if (cardDualContactSub) cardDualContactSub.textContent = `${pct}% dari total leads`;
    }

    // Panel "Perlu Follow-Up" — Wajib FU dulu, baru Danger; dalam tiap grup yang
    // paling lama tidak di-update duluan. Klik baris langsung buka edit lead.
    const fuListEl = document.getElementById('followup-list');
    if (fuListEl) {
        const rank = { wajib: 0, danger: 1 };
        const sorted = [...fuLeads].sort((a, b) => {
            if (rank[a.status] !== rank[b.status]) return rank[a.status] - rank[b.status];
            return daysSinceUpdate(b.lead) - daysSinceUpdate(a.lead);
        }).slice(0, 15);
        fuListEl.innerHTML = sorted.length ? sorted.map(({ lead: l, status }) => {
            const badge = status === 'wajib' ? '🔴 Wajib FU' : '🟠 Danger';
            const days = daysSinceUpdate(l);
            return `
            <div class="leaderboard-row" data-action="open-fu-lead" data-key="${l._key}" style="cursor:pointer;">
                <span class="leaderboard-rank" style="font-size:0.7rem;">${badge}</span>
                <span class="leaderboard-name">${(l.nama_agen || l._key || '-')}</span>
                <span style="font-size:0.76rem;color:var(--text-muted);flex:1;">${l.brand || '-'} ${l.pic_garap ? '· PIC: ' + l.pic_garap : ''}</span>
                <span class="leaderboard-count">${days} hari</span>
            </div>`;
        }).join('') : `<div class="leaderboard-empty">Tidak ada leads yang perlu di-follow-up saat ini. 🎉</div>`;
    }

    // Leaderboard PIC Garap — ranking berdasar RASIO KONVERSI (closing / leads
    // Hot+Warm+Closing yang digarap), bukan cuma volume closing mentah. PIC dengan
    // leads sedikit tapi closing-nya tinggi sekarang bisa kelihatan menonjol,
    // tidak keok oleh PIC yang cuma menang jumlah leads.
    const leaderboardEl = document.getElementById('leaderboard-pic-garap');
    if (leaderboardEl) {
        const ranked = Object.values(picStats)
            .map(s => ({ pic: s.label, ...s, rate: s.handled > 0 ? s.closing / s.handled : 0 }))
            .sort((a, b) => b.rate - a.rate || b.closing - a.closing)
            .slice(0, 5);
        leaderboardEl.innerHTML = ranked.length ? ranked.map((r, i) => `
            <div class="leaderboard-row">
                <span class="leaderboard-rank">#${i + 1}</span>
                <span class="leaderboard-name">${r.pic}</span>
                <span style="font-size:0.76rem;color:var(--text-muted);flex:1;">${r.closing} closing dari ${r.handled} Hot/Warm digarap</span>
                <span class="leaderboard-count">${Math.round(r.rate * 100)}%</span>
            </div>`).join('') : `<div class="leaderboard-empty">Belum ada leads Hot/Warm yang digarap.</div>`;
    }

    // Badge sidebar — dihitung dari SELURUH data (union WA+Email, bukan cuma tree
    // mode aktif — sebelumnya bug: allLeads di sini cuma 1 tree walau labelnya
    // "global"), penanda yang benar-benar konsisten dilihat dari tab/mode manapun.
    const badgeDash = document.getElementById('badge-dashboard');
    if (badgeDash) {
        const globalFuCount = globalLeads.reduce((n, l) => n + (typeof getFollowUpStatus === 'function' && getFollowUpStatus(l) ? 1 : 0), 0);
        badgeDash.textContent = globalFuCount;
        badgeDash.style.display = globalFuCount > 0 ? '' : 'none';
    }

    // Update charts
    CampaignCharts.renderAll(leads, AppState.mode);
    CampaignCharts.populateBrandFilter(leads);

    // Simpan hasil filter dashboard saat ini supaya tombol "Export CSV" di
    // filter bar bisa export persis apa yang sedang dilihat di dashboard.
    AppState._dashboardFilteredLeads = leads;
}

// ================================================================
// RENDER TABEL CRM
// ================================================================
function updateBadges() {
    // Badge ikut mode aktif (bukan total gabungan WA+Email lagi) — supaya angkanya
    // langsung relevan dengan tabel yang sedang dilihat user.
    const leadsObj = AppState.mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
    const count = Object.keys(leadsObj).length;

    const badge = document.getElementById('badge-leads');
    if (badge) badge.textContent = count.toLocaleString('id-ID');
}

function updateFilterOptions() {
    const leadsObj = AppState.mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
    const leads = Object.values(leadsObj);
    const opts = LeadsFilter.buildOptions(leads);

    LeadsFilter.populateSelect(document.getElementById('filter-provinsi'), opts.provinsis, 'Semua Area Utama', opts.provinsisHasEmpty);
    LeadsFilter.populateSelect(document.getElementById('filter-area'), opts.areas, 'Semua Sub Area', opts.areasHasEmpty);
    LeadsFilter.populateSelect(document.getElementById('filter-brand'), opts.brands, 'Semua Brand', opts.brandsHasEmpty);
    LeadsFilter.populateSelect(document.getElementById('filter-produk'), opts.produks, 'Semua Produk', opts.produksHasEmpty);
    LeadsFilter.populateSelect(document.getElementById('filter-pic'), opts.pics, 'Semua PIC', opts.picsHasEmpty);
    LeadsFilter.populateSelect(document.getElementById('filter-tahap'), opts.tahaps, 'Semua Tahap', opts.tahapsHasEmpty);

    // Saran otomatis field Produk/Provinsi (freeform) di form tambah/edit — gabungan dari kedua mode (WA+Email)
    const allLeads = [...Object.values(AppState.leads_wa || {}), ...Object.values(AppState.leads_email || {})];
    const fillDatalist = (id, field) => {
        const vals = [...new Set(allLeads.map(l => l[field]).filter(Boolean))].sort();
        const dl = document.getElementById(id);
        if (dl) dl.innerHTML = vals.map(v => `<option value="${String(v).replace(/"/g, '&quot;')}">`).join('');
    };
    fillDatalist('produk-suggestions', 'produk');
    fillDatalist('provinsi-suggestions', 'provinsi');
}

function renderLeadsTable() {
    const leadsObj = AppState.mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
    const leads = Object.values(leadsObj);

    // Dapatkan filter values
    const filters = {
        search:   (document.getElementById('filter-search')?.value || '').trim(),
        area:     document.getElementById('filter-area')?.value || '',
        brand:    document.getElementById('filter-brand')?.value || '',
        produk:   document.getElementById('filter-produk')?.value || '',
        provinsi: document.getElementById('filter-provinsi')?.value || '',
        pic:      document.getElementById('filter-pic')?.value || '',
        tipe:     document.getElementById('filter-tipe')?.value || '',
        tahap:    document.getElementById('filter-tahap')?.value || ''
    };

    const filtered = LeadsFilter.apply(leads, filters);
    AppState._filteredLeads = filtered;
    
    CRMTracker.render(filtered, AppState.mode);
}

function initFilters() {
    ['filter-search', 'filter-area', 'filter-brand', 'filter-produk', 'filter-provinsi', 'filter-pic', 'filter-tipe', 'filter-tahap'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener(el.tagName === 'INPUT' ? 'input' : 'change', () => {
                renderLeadsTable();
            });
        }
    });

    document.getElementById('btn-reset-filter')?.addEventListener('click', () => {
        ['filter-search', 'filter-area', 'filter-brand', 'filter-produk', 'filter-provinsi', 'filter-pic', 'filter-tipe', 'filter-tahap'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.value = '';
        });
        renderLeadsTable();
    });

    document.getElementById('btn-export-csv')?.addEventListener('click', () => {
        CRMTracker.exportCSV(AppState._filteredLeads, AppState.mode);
    });

    document.getElementById('btn-copy-contact-filtered')?.addEventListener('click', () => {
        CRMTracker.copyContacts(AppState._filteredLeads, AppState.mode, 'terfilter');
    });

    // Refresh btn topbar
    document.getElementById('btn-refresh')?.addEventListener('click', () => {
        showToast('Memuat ulang data...', 'info');
        loadAllData();
    });
}

// ================================================================
// FILTER DASHBOARD — sama seperti Master Leads, tapi terpisah (2 tab beda
// kebutuhan): brand/produk/wilayah/PIC + rentang tanggal, mempengaruhi
// summary cards, leaderboard, dan seluruh chart di Dashboard.
// ================================================================
function initDashboardFilters() {
    const ids = ['dash-filter-brand', 'dash-filter-produk', 'dash-filter-provinsi', 'dash-filter-area',
                 'dash-filter-pic', 'dash-filter-date-from', 'dash-filter-date-to'];
    ids.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener(el.tagName === 'INPUT' ? 'input' : 'change', () => renderDashboard());
    });

    document.getElementById('btn-reset-dash-filter')?.addEventListener('click', () => {
        ids.forEach(id => { const el = document.getElementById(id); if (el) el.value = ''; });
        renderDashboard();
    });

    // Export CSV dari hasil filter Dashboard saat ini (bukan seluruh data) —
    // reuse CRMTracker.exportCSV yang sama dipakai Master Leads, supaya format
    // kolomnya konsisten (termasuk kolom kontak tambahan dari Perbaikan 5).
    document.getElementById('btn-export-dashboard')?.addEventListener('click', () => {
        CRMTracker.exportCSV(AppState._dashboardFilteredLeads || [], AppState.mode);
    });

    // Klik baris di panel "Perlu Follow-Up" langsung buka modal edit lead itu.
    // Delegasi di parent stabil karena isi panel di-render ulang (innerHTML) tiap kali.
    document.getElementById('followup-list')?.addEventListener('click', (e) => {
        const row = e.target.closest('[data-action="open-fu-lead"]');
        if (row && typeof window.openEditLeadModal === 'function') window.openEditLeadModal(row.dataset.key);
    });
}

// ================================================================
// INIT BULK ACTIONS
// ================================================================
function initBulkActions() {
    document.getElementById('btn-select-all-vis')?.addEventListener('click', () => {
        CRMTracker.selectAllVisible();
    });
    document.getElementById('btn-select-all-filtered')?.addEventListener('click', () => {
        CRMTracker.selectAllFiltered(AppState._filteredLeads || []);
    });
    document.getElementById('btn-deselect')?.addEventListener('click', () => {
        CRMTracker.deselectAll();
    });

    // Bulk edit Brand
    document.getElementById('btn-bulk-brand')?.addEventListener('click', () => {
        const val = document.getElementById('bulk-brand')?.value.trim();
        if (val) CRMTracker.bulkUpdate('brand', val, AppState.mode);
    });

    // Bulk edit Area Utama (Provinsi)
    document.getElementById('btn-bulk-provinsi')?.addEventListener('click', () => {
        const val = document.getElementById('bulk-provinsi')?.value.trim();
        if (val) CRMTracker.bulkUpdate('provinsi', val, AppState.mode);
    });

    // Bulk edit Sub Area
    document.getElementById('btn-bulk-area')?.addEventListener('click', () => {
        const val = document.getElementById('bulk-area')?.value.trim();
        if (val) CRMTracker.bulkUpdate('area', val, AppState.mode);
    });

    // Bulk edit Produk
    document.getElementById('btn-bulk-produk')?.addEventListener('click', () => {
        const val = document.getElementById('bulk-produk')?.value.trim();
        if (val) CRMTracker.bulkUpdate('produk', val, AppState.mode);
    });

    // Bulk edit PIC Campaign
    document.getElementById('btn-bulk-pic-campaign')?.addEventListener('click', () => {
        const val = document.getElementById('bulk-pic-campaign')?.value.trim();
        if (val) CRMTracker.bulkUpdate('pic_campaign', val, AppState.mode);
    });

    // Bulk edit PIC Garap
    document.getElementById('btn-bulk-pic')?.addEventListener('click', () => {
        const val = document.getElementById('bulk-pic-garap')?.value;
        if (val) CRMTracker.bulkUpdate('pic_garap', val, AppState.mode);
    });

    // Bulk edit Nomor WA CS Dipakai
    document.getElementById('btn-bulk-nomor-wa-terpakai')?.addEventListener('click', () => {
        const val = document.getElementById('bulk-nomor-wa-terpakai')?.value.trim();
        if (val) CRMTracker.bulkUpdate('nomor_wa_terpakai', val, AppState.mode);
    });

    // Bulk edit Aksi Lanjutan
    document.getElementById('btn-bulk-aksi')?.addEventListener('click', () => {
        const val = document.getElementById('bulk-aksi-lanjutan')?.value.trim();
        if (val) CRMTracker.bulkUpdate('aksi_lanjutan', val, AppState.mode);
    });

    // Bulk tambah Tanggal Kirim (menambah ke riwayat, bukan menimpa)
    document.getElementById('btn-bulk-tgl-kirim')?.addEventListener('click', () => {
        const val = document.getElementById('bulk-tgl-kirim')?.value;
        if (val) CRMTracker.bulkAppendDate(val, AppState.mode);
    });

    // Bulk edit Tahap
    document.getElementById('btn-bulk-tahap')?.addEventListener('click', () => {
        const val = document.getElementById('bulk-tahap')?.value;
        if (val) CRMTracker.bulkUpdate('tahap', val, AppState.mode);
    });

    // Bulk edit Tipe
    document.getElementById('btn-bulk-tipe')?.addEventListener('click', () => {
        const val = document.getElementById('bulk-tipe')?.value;
        if (val) CRMTracker.bulkUpdate('tipe_leads', val, AppState.mode);
    });

    // Bulk Delete
    document.getElementById('btn-bulk-delete')?.addEventListener('click', () => {
        const c = CRMTracker._selectedKeys.size;
        if (c > 0) openDeleteModal([...CRMTracker._selectedKeys]);
    });

    // Copy kontak baris terpilih (untuk BCC)
    document.getElementById('btn-copy-contact-selected')?.addEventListener('click', () => {
        const leads = getSelectedLeadObjects();
        CRMTracker.copyContacts(leads, AppState.mode, 'terpilih');
    });

    // Broadcast WA: bawa nomor WA dari baris terpilih ke tab "WA Broadcast"
    document.getElementById('btn-broadcast-wa-selected')?.addEventListener('click', () => {
        if (AppState.mode !== 'wa') {
            showToast('Broadcast WA hanya untuk mode WhatsApp. Ganti mode dulu di sidebar.', 'error');
            return;
        }
        const leads = getSelectedLeadObjects();
        const rows = leads
            .map(l => ({ Nama: l.nama_agen || '(tanpa nama)', 'Nomor WA': l.phone || l.contact_display || '' }))
            .filter(r => r['Nomor WA']);
        if (window.WABroadcast) {
            window.WABroadcast.loadFromLeads(rows, 'Broadcast Leads Terpilih');
        }
        switchTab('broadcast');
    });
}

// Ambil objek lead lengkap dari _selectedKeys (Set of key) sesuai mode aktif
function getSelectedLeadObjects() {
    const leadsObj = AppState.mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
    return [...CRMTracker._selectedKeys].map(key => leadsObj[key]).filter(Boolean);
}

// ================================================================
// DELETE MODAL
// ================================================================
let keysToDelete = [];
function openDeleteModal(keys) {
    keysToDelete = keys;
    const msg = keys.length > 1 
        ? `Anda yakin ingin menghapus <strong>${keys.length} leads</strong> terpilih secara permanen?`
        : `Anda yakin ingin menghapus leads ini secara permanen?`;
    document.getElementById('delete-modal-msg').innerHTML = msg;
    document.getElementById('delete-modal').classList.remove('hidden');
}

function closeDeleteModal() {
    keysToDelete = [];
    document.getElementById('delete-modal').classList.add('hidden');
}

document.getElementById('btn-confirm-delete')?.addEventListener('click', async () => {
    if (keysToDelete.length === 0) return;
    
    // Set selected keys to exactly keysToDelete so bulkDelete uses it
    CRMTracker._selectedKeys.clear();
    keysToDelete.forEach(k => CRMTracker._selectedKeys.add(k));
    
    await CRMTracker.bulkDelete(AppState.mode);
    closeDeleteModal();
});

// ================================================================
// UPLOAD WIZARD
// ================================================================
let uploadState = {
    file: null,
    mode: 'wa',
    parsed: null, // { clean, rejected, total }
    superMode: 'fresh', // 'fresh' | 'migrate'
    wb: null,             // workbook (mode migrate)
    sheetPreviews: [],    // [{sheetName, headerRowIdx, headers, colMap, sheetDefaults, rowCount, looksLikeLeads}]
    migrationRows: [],    // gabungan semua baris terpilih (clean + yang perlu review brand), urut sesuai urutan sheet
    crossMerges: [],      // [{ mode, targetKey, contactField, contactValue }] — keputusan "Gabung" dari cross-match
                           // review, dieksekusi bareng commit final (bukan langsung saat modal ditutup) supaya
                           // konsisten dengan wizard: TIDAK ADA yang benar-benar ke-tulis ke Firebase sebelum
                           // tombol "Commit ke Firebase" di step 3 diklik.
};

function escapeUploadHtml(s) {
    return String(s == null ? '' : s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
}

function initUploadWizard() {
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    const btnNext1 = document.getElementById('btn-step1-next');
    const btnProc2 = document.getElementById('btn-process-file');
    const btnBack2 = document.getElementById('btn-step2-back');
    const btnCommit = document.getElementById('btn-commit-firebase');
    const btnBack3 = document.getElementById('btn-step3-back');
    
    const s1 = document.getElementById('step-1');
    const s2 = document.getElementById('step-2');
    const s2b = document.getElementById('step-2b');
    const s2c = document.getElementById('step-2c');
    const s3 = document.getElementById('step-3');
    const btnStep2bBack = document.getElementById('btn-step2b-back');
    const btnStep2bNext = document.getElementById('btn-step2b-next');
    const btnStep2cBack = document.getElementById('btn-step2c-back');
    const btnStep2cNext = document.getElementById('btn-step2c-next');

    // --- Toggle Jenis Upload (Data Segar vs Migrasi Data Lama) ---
    document.querySelectorAll('input[name="upload-super-mode"]').forEach(r => {
        r.addEventListener('change', (e) => {
            uploadState.superMode = e.target.value;
            const isMigrate = uploadState.superMode === 'migrate';
            document.getElementById('seg-form-fresh').style.display = isMigrate ? 'none' : 'grid';
            document.getElementById('seg-form-migrate').style.display = isMigrate ? 'grid' : 'none';
            document.getElementById('choice-fresh').style.background = isMigrate ? 'var(--bg)' : 'var(--primary-light)';
            document.getElementById('choice-fresh').style.borderColor = isMigrate ? 'var(--border-solid)' : 'var(--primary)';
            document.getElementById('choice-migrate').style.background = isMigrate ? 'var(--primary-light)' : 'var(--bg)';
            document.getElementById('choice-migrate').style.borderColor = isMigrate ? 'var(--primary)' : 'var(--border-solid)';
        });
    });

    // --- STEP 1 ---
    btnNext1.addEventListener('click', () => {
        const isMigrate = uploadState.superMode === 'migrate';

        if (!isMigrate) {
            const area  = document.getElementById('seg-area').value.trim();
            const brand = document.getElementById('seg-brand').value.trim();
            const pic_c = document.getElementById('seg-pic-campaign').value.trim();
            if (!area || !brand || !pic_c) {
                showToast('Harap isi field wajib: Area, Brand, dan PIC Campaign!', 'error');
                return;
            }
        } else {
            const pic_c_migrate = document.getElementById('seg-pic-campaign-migrate').value.trim();
            if (!pic_c_migrate) {
                showToast('Harap isi field wajib: PIC Campaign!', 'error');
                return;
            }
            // Default global (berlaku semua sheet) — dipakai nanti saat commit per-sheet di btnStep2bNext.
            uploadState.migrateGlobalInfo = {
                pic_campaign: pic_c_migrate,
                pic_garap: document.getElementById('seg-pic-garap-migrate').value.trim(),
                produk: document.getElementById('seg-produk-migrate').value.trim(),
                provinsi: document.getElementById('seg-provinsi-migrate').value.trim()
            };
        }

        // Get upload mode
        const rMode = document.querySelector('input[name="upload-mode"]:checked');
        if (rMode) uploadState.mode = rMode.value;

        // Transition 1 -> 2
        s1.classList.remove('step-active'); s1.classList.add('step-done');
        document.getElementById('step1-num').classList.add('done');
        document.getElementById('step1-num').innerHTML = "<i class='bx bx-check'></i>";
        
        s2.style.opacity = '1'; s2.style.pointerEvents = 'auto';
        s2.classList.add('step-active');
        
        document.getElementById('step2-sub').innerHTML = 
            `Format: .csv / .xlsx · Kolom bebas · Mode: <strong>${uploadState.mode.toUpperCase()}</strong>`;
    });

    // Handle Upload Mode Radio UI
    document.querySelectorAll('.mode-choice').forEach(lbl => {
        lbl.addEventListener('click', () => {
            document.querySelectorAll('.mode-choice').forEach(l => {
                l.style.background = 'var(--bg)'; l.style.borderColor = 'var(--border-solid)';
            });
            const isWA = document.querySelector('input[name="upload-mode"]:checked').value === 'wa';
            lbl.style.background = isWA ? 'rgba(37,211,102,0.06)' : 'var(--email-light)';
            lbl.style.borderColor = isWA ? 'var(--wa-green)' : 'var(--email-blue)';
        });
    });

    // --- STEP 2 ---
    const showSelected = (f) => {
        uploadState.file = f;
        document.getElementById('file-name').textContent = f.name;
        document.getElementById('file-size').textContent = (f.size / 1024).toFixed(1) + ' KB';
        document.getElementById('file-selected-info').classList.add('show');
        dropZone.style.display = 'none';
        document.getElementById('step2-tips').style.display = 'none';
        btnProc2.disabled = false;
    };

    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('dragover'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault(); dropZone.classList.remove('dragover');
        if (e.dataTransfer.files[0]) showSelected(e.dataTransfer.files[0]);
    });
    fileInput.addEventListener('change', () => {
        if (fileInput.files[0]) showSelected(fileInput.files[0]);
    });

    btnBack2.addEventListener('click', () => {
        s2.classList.remove('step-active'); s2.style.opacity = '0.6'; s2.style.pointerEvents = 'none';
        s1.classList.remove('step-done'); s1.classList.add('step-active');
        document.getElementById('step1-num').classList.remove('done');
        document.getElementById('step1-num').innerHTML = "1";
    });

    // Reset wizard ke Step 1 bersih tanpa reload browser penuh — dipakai setelah commit
    // sukses (ganti location.reload() yang sebelumnya membuang mode/tab aktif user).
    function resetUploadWizardToStep1() {
        uploadState = { file: null, mode: 'wa', parsed: null, superMode: 'fresh', wb: null, sheetPreviews: [], migrationRows: [], crossMerges: [] };

        s1.classList.remove('step-done'); s1.classList.add('step-active');
        document.getElementById('step1-num').classList.remove('done');
        document.getElementById('step1-num').innerHTML = '1';

        s2.classList.remove('step-active'); s2.style.display = ''; s2.style.opacity = '0.6'; s2.style.pointerEvents = 'none';
        s2b.style.display = 'none'; s2b.classList.remove('step-active');
        s2c.style.display = 'none'; s2c.classList.remove('step-active');
        s3.style.display = 'none'; s3.classList.remove('step-active');

        fileInput.value = '';
        document.getElementById('file-selected-info').classList.remove('show');
        dropZone.style.display = '';
        document.getElementById('step2-tips').style.display = '';
        btnProc2.disabled = true;
        btnCommit.disabled = false;
        btnBack3.disabled = false;
        document.getElementById('upload-progress').style.display = 'none';

        ['seg-area', 'seg-provinsi', 'seg-brand', 'seg-pic-campaign', 'seg-pic-garap', 'seg-produk',
         'seg-pic-campaign-migrate', 'seg-pic-garap-migrate', 'seg-produk-migrate', 'seg-provinsi-migrate']
            .forEach(id => { const el = document.getElementById(id); if (el) el.value = ''; });

        document.querySelector('input[name="upload-super-mode"][value="fresh"]').checked = true;
        document.getElementById('seg-form-fresh').style.display = 'grid';
        document.getElementById('seg-form-migrate').style.display = 'none';
        document.getElementById('choice-fresh').style.background = 'var(--primary-light)';
        document.getElementById('choice-fresh').style.borderColor = 'var(--primary)';
        document.getElementById('choice-migrate').style.background = 'var(--bg)';
        document.getElementById('choice-migrate').style.borderColor = 'var(--border-solid)';

        document.querySelector('input[name="upload-mode"][value="wa"]').checked = true;
        document.getElementById('choice-wa').style.background = 'rgba(37,211,102,0.06)';
        document.getElementById('choice-wa').style.borderColor = 'var(--wa-green)';
        document.getElementById('choice-email').style.background = 'var(--bg)';
        document.getElementById('choice-email').style.borderColor = 'var(--border-solid)';
    }

    // Dipakai bareng oleh mode Upload Data Segar & Migrasi Data Lama — dedup terhadap
    // Firebase yang sudah ada, lalu pindah ke Step 3 (preview & commit), reuse penuh.
    function finalizeAndShowPreview(fromStepEl) {
        const existingObj = uploadState.mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        const existingKeys = Object.keys(existingObj);
        const { fresh, dupes } = LeadsCleaner.deduplicate(uploadState.parsed.clean, existingKeys);
        uploadState.dupes = dupes;
        uploadState.crossMerges = [];

        const proceedToStep3 = (finalFresh) => {
            uploadState.fresh = finalFresh;
            setTimeout(() => {
                fromStepEl.style.display = 'none';
                s3.style.display = 'block';
                s3.classList.add('step-active');
                renderPreviewPanel();
            }, 500);
        };

        // Cek kemungkinan lead yang sama sudah ada di tree SEBALIKNYA (WA<->Email) —
        // nama_agen+area cocok persis. Kalau ketemu, tawarkan gabung ke user dulu
        // sebelum lanjut ke preview commit (lihat modal #cross-match-modal).
        const otherTreeLeads = uploadState.mode === 'wa' ? AppState.leads_email : AppState.leads_wa;
        const crossMatches = LeadsCleaner.findCrossTreeMatches(fresh, otherTreeLeads);

        if (crossMatches.length === 0) {
            proceedToStep3(fresh);
            return;
        }
        showCrossMatchModal(crossMatches, fresh, proceedToStep3);
    }

    // Modal review kecocokan lintas-tree — user pilih per baris: Gabung (tambahkan
    // sebagai kontak kedua ke lead yang sudah ada, baris ini TIDAK jadi lead baru
    // terpisah) atau Biarkan Terpisah (lanjut seperti biasa, jadi lead baru sendiri).
    // Keputusan disimpan ke uploadState.crossMerges, dieksekusi bareng commit final.
    function showCrossMatchModal(matches, fresh, onDone) {
        const modal = document.getElementById('cross-match-modal');
        const listEl = document.getElementById('cross-match-list');
        const btnContinue = document.getElementById('btn-cross-match-continue');
        const contactLabel = uploadState.mode === 'wa' ? 'WA' : 'Email';
        const otherLabel = uploadState.mode === 'wa' ? 'Email' : 'WA';

        // Channel milik lead yang SUDAH ADA (matchedLead) — ini yang tahap/histori-nya
        // dipertahankan (tidak ditimpa), jadi otomatis jadi starting point "Kontak Aktif".
        const otherChannelKey = uploadState.mode === 'wa' ? 'email' : 'wa';

        listEl.innerHTML = matches.map((m, i) => {
            // Kalau baris baru ternyata bawa catatan tahap/tipe sendiri (mis. dari sheet
            // migrasi lama), itu TIDAK otomatis diterapkan ke lead yang digabung — kasih
            // tahu di sini supaya tidak hilang diam-diam, user bisa cek & edit manual.
            const rowHasTahapInfo = (m.row.tahap && m.row.tahap.trim()) || (m.row.tipe_leads && m.row.tipe_leads !== 'New');
            const tahapWarning = rowHasTahapInfo
                ? `<div style="font-size:0.74rem;color:var(--warning,#d97706);margin-top:6px;">⚠️ Data baru ini punya catatan tahap: '${escapeUploadHtml(m.row.tahap || m.row.tipe_leads)}' — TIDAK otomatis diterapkan (tahap dari kontak yang sudah ada tetap dipakai). Cek &amp; edit manual kalau perlu digabung juga.</div>`
                : '';
            return `
            <div style="border:1px solid var(--border-solid);border-radius:10px;padding:12px 14px;">
                <div style="font-weight:700;font-size:0.85rem;margin-bottom:4px;">${escapeUploadHtml(m.row.nama_agen)} <span style="font-weight:400;color:var(--text-muted);">— ${escapeUploadHtml(m.row.area)}</span></div>
                <div style="font-size:0.78rem;color:var(--text-muted);margin-bottom:8px;">
                    Baru (${contactLabel}): <strong>${escapeUploadHtml(m.row.contact_display)}</strong><br>
                    Sudah ada di tree ${otherLabel}: <strong>${escapeUploadHtml(m.matchedLead.contact_display || m.matchedKey)}</strong><br>
                    Kontak Aktif otomatis diset ke <strong>${otherLabel}</strong> (channel yang sudah ada duluan) — bisa diganti manual lewat Edit Lead nanti.
                </div>
                <label style="display:flex;align-items:center;gap:6px;font-size:0.8rem;cursor:pointer;">
                    <input type="checkbox" class="cross-match-chk" data-idx="${i}" checked>
                    Gabung sebagai kontak ${contactLabel} kedua di lead yang sudah ada (bukan bikin lead baru terpisah)
                </label>
                ${tahapWarning}
            </div>`;
        }).join('');

        modal.classList.remove('hidden');

        btnContinue.onclick = () => {
            const mergedRowKeys = new Set();
            matches.forEach((m, i) => {
                const chk = listEl.querySelector(`.cross-match-chk[data-idx="${i}"]`);
                if (chk && chk.checked) {
                    // Kontak Aktif: default ke channel yang SUDAH ADA (tahapnya dipertahankan).
                    // Channel yang baru digabung SENGAJA belum ikut tercentang — nunggu
                    // konfirmasi manual dulu (lihat Perbaikan 3: "jangan terlalu otomatis").
                    const existingActive = Array.isArray(m.matchedLead.kontak_aktif) ? m.matchedLead.kontak_aktif : [];
                    const newActive = existingActive.includes(otherChannelKey) ? existingActive : [...existingActive, otherChannelKey];

                    uploadState.crossMerges.push({
                        mode: uploadState.mode,
                        targetKey: m.matchedKey,
                        contactField: uploadState.mode === 'wa' ? 'phone' : 'email',
                        contactValue: m.row.contact_display,
                        kontakAktif: newActive,
                    });
                    mergedRowKeys.add(m.row._key);
                }
            });
            const finalFresh = fresh.filter(r => !mergedRowKeys.has(r._key));
            modal.classList.add('hidden');
            if (uploadState.crossMerges.length > 0) {
                showToast(`${uploadState.crossMerges.length} lead akan digabung ke kontak yang sudah ada (dieksekusi saat commit).`, 'info');
            }
            onDone(finalFresh);
        };
    }

    btnProc2.addEventListener('click', async () => {
        const pwrap = document.getElementById('parse-progress');
        const pfill = document.getElementById('parse-fill');
        const plbl  = document.getElementById('parse-pct');
        const ptxt  = document.getElementById('parse-label');

        btnProc2.disabled = true;
        btnBack2.disabled = true;
        pwrap.style.display = 'block';

        try {
            if (uploadState.superMode === 'migrate') {
                ptxt.textContent = 'Membaca semua sheet...'; pfill.style.width = '15%'; plbl.textContent = '15%';
                uploadState.wb = await LeadsCleaner.readWorkbookAllSheets(uploadState.file);
                uploadState.sheetPreviews = uploadState.wb.SheetNames.map(sn => LeadsCleaner.getSheetPreview(uploadState.wb, sn));

                pwrap.style.display = 'none';
                btnProc2.disabled = false;
                btnBack2.disabled = false;

                renderSheetChecklist();
                s2.style.display = 'none';
                s2b.style.display = 'block';
                s2b.classList.add('step-active');
                return;
            }

            const segArea = document.getElementById('seg-area').value.trim();
            const segProvinsiInput = document.getElementById('seg-provinsi').value.trim();
            const segInfo = {
                area: segArea,
                provinsi: segProvinsiInput || LeadsFilter.lookupProvince(segArea) || '',
                brand: document.getElementById('seg-brand').value.trim(),
                produk: document.getElementById('seg-produk').value.trim(),
                pic_campaign: document.getElementById('seg-pic-campaign').value.trim(),
                pic_garap: document.getElementById('seg-pic-garap').value.trim()
            };

            uploadState.parsed = await LeadsCleaner.processFile(uploadState.file, uploadState.mode, segInfo, (pct, txt) => {
                pfill.style.width = pct + '%'; plbl.textContent = pct + '%'; ptxt.textContent = txt;
            });

            finalizeAndShowPreview(s2);

        } catch (err) {
            showToast(err.message, 'error');
            pwrap.style.display = 'none';
            btnProc2.disabled = false;
            btnBack2.disabled = false;
        }
    });

    // --- STEP 2b: PILIH SHEET (mode Migrasi Data Lama) ---
    function renderSheetChecklist() {
        const wrap = document.getElementById('sheet-checklist-wrap');
        wrap.innerHTML = uploadState.sheetPreviews.map((p, i) => `
            <div style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-bottom:1px solid var(--border-solid);">
                <input type="checkbox" class="sheet-chk" data-idx="${i}" ${p.looksLikeLeads ? 'checked' : ''} style="flex-shrink:0;width:16px;height:16px;">
                <div style="flex:1;min-width:0;">
                    <div style="font-weight:700;font-size:0.82rem;">${escapeUploadHtml(p.sheetName)} <span style="font-weight:400;color:var(--text-muted);">(${p.rowCount} baris)</span></div>
                    <div style="font-size:0.7rem;color:var(--text-muted);">Kolom terdeteksi: ${[p.colMap.nameCol, p.colMap.brandCol, p.colMap.kotaCol, p.colMap.alamatCol].filter(Boolean).map(escapeUploadHtml).join(', ') || '(tidak terdeteksi — kemungkinan bukan sheet leads)'}</div>
                </div>
                <input type="text" class="form-input sheet-brand-default" data-idx="${i}" placeholder="Brand default" value="${escapeUploadHtml(p.sheetDefaults.brand || '')}" style="width:130px;font-size:0.76rem;padding:6px 8px;" ${p.colMap.brandCol ? 'disabled title="Sheet ini sudah punya kolom Brand sendiri per baris"' : ''}>
                <input type="text" class="form-input sheet-area-default" data-idx="${i}" placeholder="Area default" value="${escapeUploadHtml(p.sheetDefaults.area || '')}" style="width:110px;font-size:0.76rem;padding:6px 8px;" ${p.colMap.kotaCol ? 'disabled title="Sheet ini sudah punya kolom Kota sendiri per baris"' : ''}>
            </div>
        `).join('');
    }

    btnStep2bBack.addEventListener('click', () => {
        s2b.style.display = 'none'; s2b.classList.remove('step-active');
        s2.style.display = 'block';
    });

    btnStep2bNext.addEventListener('click', () => {
        const checked = [...document.querySelectorAll('.sheet-chk:checked')].map(cb => parseInt(cb.dataset.idx, 10));
        if (!checked.length) { showToast('Centang minimal 1 sheet untuk dimigrasikan.', 'error'); return; }

        const migrationRows = [];
        let totalRaw = 0;
        const rejectedAll = [];

        // Proses sesuai urutan sheet ASLI di file (bukan urutan klik) — supaya sheet
        // "Copy of X" yang letaknya setelah "X" di file otomatis menang saat ditimpa.
        checked.sort((a, b) => a - b).forEach(idx => {
            const p = uploadState.sheetPreviews[idx];
            const brandOverride = document.querySelector(`.sheet-brand-default[data-idx="${idx}"]`).value.trim();
            const areaOverride  = document.querySelector(`.sheet-area-default[data-idx="${idx}"]`).value.trim();
            const gInfo = uploadState.migrateGlobalInfo || {};
            const sheetDefaults = {
                brand: brandOverride || p.sheetDefaults.brand,
                area: areaOverride || p.sheetDefaults.area,
                pic_campaign: gInfo.pic_campaign || '',
                pic_garap: gInfo.pic_garap || '',
                produk: gInfo.produk || '',
                provinsi: gInfo.provinsi || LeadsFilter.lookupProvince(areaOverride || p.sheetDefaults.area) || ''
            };

            const { clean, ambiguousBrand, rejected, total } = LeadsCleaner.processMigrationSheet(uploadState.wb, p.sheetName, p.colMap, sheetDefaults, uploadState.mode);
            totalRaw += total;
            rejectedAll.push(...rejected);
            clean.forEach(r => migrationRows.push({ ...r, _needsBrandReview: false }));
            ambiguousBrand.forEach(r => migrationRows.push({ ...r, _needsBrandReview: true }));
        });

        uploadState.migrationRows = migrationRows;
        uploadState.migrationRejected = rejectedAll;
        uploadState.migrationTotal = totalRaw;

        const needsReview = migrationRows.some(r => r._needsBrandReview);
        s2b.style.display = 'none'; s2b.classList.remove('step-active');

        if (needsReview) {
            renderBrandReview();
            s2c.style.display = 'block'; s2c.classList.add('step-active');
        } else {
            finishMigrationRows();
        }
    });

    // --- STEP 2c: REVIEW BRAND TIDAK DIKENALI (mode Migrasi Data Lama, kalau ada) ---
    function renderBrandReview() {
        const wrap = document.getElementById('brand-review-wrap');
        const groups = {};
        uploadState.migrationRows.filter(r => r._needsBrandReview).forEach(r => {
            (groups[r._raw_brand] = groups[r._raw_brand] || []).push(r);
        });

        const optionsHtml = LeadsCleaner.OFFICIAL_BRANDS.map(b => `<option value="${escapeUploadHtml(b)}">${escapeUploadHtml(b)}</option>`).join('');

        wrap.innerHTML = Object.entries(groups).map(([raw, rows], i) => `
            <div style="display:flex;align-items:center;gap:12px;padding:12px;border:1px solid var(--border-solid);border-radius:var(--radius-md);margin-bottom:8px;">
                <div style="flex:1;">
                    <div style="font-weight:700;font-size:0.85rem;">"${escapeUploadHtml(raw)}"</div>
                    <div style="font-size:0.72rem;color:var(--text-muted);">${rows.length} baris terpengaruh</div>
                </div>
                <select class="form-input brand-review-select" data-raw="${escapeUploadHtml(raw)}" style="width:200px;">
                    <option value="">-- Pilih kategori resmi --</option>
                    ${optionsHtml}
                    <option value="__new__">+ Buat kategori baru...</option>
                </select>
                <input type="text" class="form-input brand-review-custom" data-raw="${escapeUploadHtml(raw)}" placeholder="Nama kategori baru" style="width:160px;display:none;">
            </div>
        `).join('');

        wrap.querySelectorAll('.brand-review-select').forEach(sel => {
            sel.addEventListener('change', () => {
                const customInput = wrap.querySelector(`.brand-review-custom[data-raw="${CSS.escape(sel.dataset.raw)}"]`);
                customInput.style.display = sel.value === '__new__' ? 'block' : 'none';
            });
        });
    }

    btnStep2cBack.addEventListener('click', () => {
        s2c.style.display = 'none'; s2c.classList.remove('step-active');
        s2b.style.display = 'block'; s2b.classList.add('step-active');
    });

    btnStep2cNext.addEventListener('click', () => {
        const resolutions = {};
        let missing = false;
        document.querySelectorAll('.brand-review-select').forEach(sel => {
            let val = sel.value;
            if (val === '__new__') {
                const custom = document.querySelector(`.brand-review-custom[data-raw="${CSS.escape(sel.dataset.raw)}"]`).value.trim();
                val = custom;
            }
            if (!val) { missing = true; return; }
            resolutions[sel.dataset.raw] = val;
        });

        if (missing) { showToast('Masih ada brand yang belum dipetakan — pilih kategori resmi atau ketik kategori baru untuk semuanya.', 'error'); return; }

        uploadState.migrationRows.forEach(r => {
            if (r._needsBrandReview) { r.brand = resolutions[r._raw_brand] || r.brand; r._needsBrandReview = false; }
        });

        s2c.style.display = 'none'; s2c.classList.remove('step-active');
        finishMigrationRows();
    });

    // Gabungkan seluruh baris (sudah bebas review) → collapse per nomor WA (yang
    // belakangan di urutan sheet menang, sesuai aturan "Copy of" menimpa versi asli)
    // → lanjut ke Step 3 preview & commit yang sama dengan mode Upload Data Segar.
    function finishMigrationRows() {
        const collapsed = new Map();
        uploadState.migrationRows.forEach(r => collapsed.set(r._key, r));
        uploadState.parsed = {
            clean: [...collapsed.values()],
            rejected: uploadState.migrationRejected || [],
            total: uploadState.migrationTotal || uploadState.migrationRows.length,
        };
        finalizeAndShowPreview(s2b);
    }

    // --- STEP 3 ---
    let overwriteDupes = false;

    btnBack3.addEventListener('click', () => {
        s3.style.display = 'none'; s3.classList.remove('step-active');
        if (uploadState.superMode === 'migrate' && uploadState.sheetPreviews.length) {
            renderSheetChecklist();
            s2b.style.display = 'block'; s2b.classList.add('step-active');
        } else {
            s2.style.display = 'block';
        }
        document.getElementById('parse-progress').style.display = 'none';
        btnProc2.disabled = false; btnBack2.disabled = false;
    });

    document.getElementById('btn-skip-dupes')?.addEventListener('click', (e) => {
        overwriteDupes = false;
        e.target.classList.replace('btn-ghost', 'btn-primary');
        document.getElementById('btn-overwrite-dupes').classList.replace('btn-primary', 'btn-ghost');
        document.getElementById('btn-overwrite-dupes').classList.replace('btn-accent', 'btn-ghost');
    });

    document.getElementById('btn-overwrite-dupes')?.addEventListener('click', (e) => {
        overwriteDupes = true;
        e.target.classList.replace('btn-ghost', 'btn-accent');
        document.getElementById('btn-skip-dupes').classList.replace('btn-primary', 'btn-ghost');
    });

    btnCommit.addEventListener('click', async () => {
        const uwrap = document.getElementById('upload-progress');
        const ufill = document.getElementById('upload-fill');
        const ulbl  = document.getElementById('upload-pct');
        const utxt  = document.getElementById('upload-label');

        btnCommit.disabled = true;
        btnBack3.disabled = true;
        uwrap.style.display = 'block';

        // SEMUA logic commit (termasuk pembentukan fbObj) dibungkus try/catch —
        // sebelumnya sebagian di luar try, jadi kalau ada yang throw di situ,
        // tombol macet permanen tanpa toast/error apa pun ("commit diam saja").
        try {
            // Guard: pastikan uploadState.fresh benar-benar array of object yang valid
            // sebelum diproses — mencegah exception generik kalau state wizard sempat
            // korup (mis. karena navigasi back-forward atau modal cross-match).
            if (!Array.isArray(uploadState.fresh) || uploadState.fresh.some(r => !r || typeof r !== 'object')) {
                throw new Error('Data preview bermasalah/korup. Silakan ulangi upload dari Step 1.');
            }

            const fbObj = LeadsCleaner.toFirebaseObject(uploadState.fresh, uploadState.mode, overwriteDupes, uploadState.dupes);
            const fbPath = uploadState.mode === 'wa' ? APP_CONFIG.DB_PATHS.wa : APP_CONFIG.DB_PATHS.email;
            const totalCommit = Object.keys(fbObj).length;
            const crossMerges = uploadState.crossMerges || [];
            const otherFbPath = uploadState.mode === 'wa' ? APP_CONFIG.DB_PATHS.email : APP_CONFIG.DB_PATHS.wa;

            if (totalCommit === 0 && crossMerges.length === 0) {
                showToast('Tidak ada data baru yang bisa diunggah.', 'warning');
                uwrap.style.display = 'none';
                btnCommit.disabled = false;
                btnBack3.disabled = false;
                return;
            }

            if (sessionStorage.getItem('campaign_demo') === 'ok') {
                const ext = uploadState.mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
                Object.assign(ext, fbObj);
                const otherExt = uploadState.mode === 'wa' ? AppState.leads_email : AppState.leads_wa;
                crossMerges.forEach(m => {
                    if (otherExt[m.targetKey]) {
                        otherExt[m.targetKey][m.contactField] = m.contactValue;
                        if (m.kontakAktif) otherExt[m.targetKey].kontak_aktif = m.kontakAktif;
                    }
                });

                ufill.style.width = '100%'; ulbl.textContent = '100%'; utxt.textContent = 'Selesai!';
                showToast(`✅ Demo Mode: ${totalCommit} leads ditambahkan lokal!` + (crossMerges.length ? ` + ${crossMerges.length} digabung ke kontak lama.` : ''), 'success');

                const banner = document.getElementById('demo-banner');
                if (banner) banner.style.display = 'none';

                const commitMode = uploadState.mode;
                setTimeout(async () => {
                    await loadAllData();
                    setMode(commitMode);
                    CRMTracker._sortField = 'updated_at';
                    CRMTracker._sortDir = 'desc';
                    renderLeadsTable();
                    updateBadges();
                    switchTab('leads');
                    resetUploadWizardToStep1();
                }, 1000);
                return;
            }

            utxt.textContent = 'Menghubungkan ke Firebase...';

            if (totalCommit > 0) {
                await FirebaseAPI.chunkedUpsert(fbPath, fbObj, 150, (done, total) => {
                    const pct = Math.round((done / total) * 100);
                    ufill.style.width = pct + '%';
                    ulbl.textContent = pct + '%';
                    utxt.textContent = `Mengunggah ${done} / ${total} leads...`;
                });
            }

            // Eksekusi keputusan "Gabung" dari cross-match review — tambahkan kontak
            // kedua ke lead yang SUDAH ADA di tree sebaliknya, satu per satu (bukan
            // bikin lead baru, cuma nambah 1 field ke node yang sudah ada). Validasi
            // ulang lead target masih ada di AppState saat commit (bukan cuma snapshot
            // lama saat review) — kalau sudah tidak ada, skip alih-alih menulis ke
            // key yang sudah "hantu" (mis. berubah karena lead itu sempat di-edit).
            const otherTreeLeads = uploadState.mode === 'wa' ? AppState.leads_email : AppState.leads_wa;
            const skippedMerges = [];
            if (crossMerges.length > 0) {
                utxt.textContent = `Menggabungkan ${crossMerges.length} kontak ke lead yang sudah ada...`;
                for (const m of crossMerges) {
                    if (!otherTreeLeads[m.targetKey]) { skippedMerges.push(m); continue; }
                    const patchBody = {
                        [m.contactField]: m.contactValue,
                        updated_at: new Date().toISOString().split('T')[0],
                    };
                    if (m.kontakAktif) patchBody.kontak_aktif = m.kontakAktif;
                    await FirebaseAPI.patch(`${otherFbPath}/${m.targetKey}`, patchBody);
                }
            }
            const mergedCount = crossMerges.length - skippedMerges.length;
            if (skippedMerges.length > 0) {
                console.warn('Cross-merge dilewati (lead target sudah tidak ada/berubah):', skippedMerges);
            }

            ufill.style.width = '100%'; ulbl.textContent = '100%'; utxt.textContent = 'Selesai!';
            showToast(`✅ ${totalCommit} leads berhasil masuk CRM!`
                + (mergedCount ? ` + ${mergedCount} digabung ke kontak lama.` : '')
                + (skippedMerges.length ? ` (${skippedMerges.length} gabungan dilewati krn lead target berubah)` : ''), 'success');

            // Hapus banner demo jika ada
            const banner = document.getElementById('demo-banner');
            if (banner) banner.style.display = 'none';

            // Refresh data & arahkan langsung ke Master Leads (mode & urutan yang sesuai
            // data baru) tanpa reload browser penuh — supaya konteks user tidak hilang.
            const commitMode = uploadState.mode;
            setTimeout(async () => {
                await loadAllData();
                setMode(commitMode);
                CRMTracker._sortField = 'updated_at';
                CRMTracker._sortDir = 'desc';
                renderLeadsTable();
                updateBadges();
                switchTab('leads');
                resetUploadWizardToStep1();
            }, 1000);

        } catch (err) {
            console.error('Commit upload error:', err);
            showToast('Gagal upload ke Firebase: ' + (err && err.message ? err.message : 'kesalahan tidak diketahui'), 'error');
            uwrap.style.display = 'none';
            btnCommit.disabled = false;
            btnBack3.disabled = false;
        }
    });

    function renderPreviewPanel() {
        const p = uploadState.parsed;
        const f = uploadState.fresh.length;
        const d = uploadState.dupes.length;
        const r = p.rejected.length;

        document.getElementById('preview-summary').innerHTML = `
            <div class="preview-stat">
                <div class="ps-num">${p.total}</div>
                <div class="ps-lbl">TOTAL BARIS</div>
            </div>
            <div class="preview-stat green">
                <div class="ps-num">${f}</div>
                <div class="ps-lbl">DATA BERSIH BARU</div>
            </div>
            <div class="preview-stat orange">
                <div class="ps-num">${d}</div>
                <div class="ps-lbl">DUPLIKAT (ADA DI DB)</div>
            </div>
            <div class="preview-stat red">
                <div class="ps-num">${r}</div>
                <div class="ps-lbl">DITOLAK / INVALID</div>
            </div>
        `;

        if (d > 0) {
            document.getElementById('dedup-controls').style.display = 'flex';
            document.getElementById('dedup-label').textContent = `${d} data duplikat ditemukan:`;
        } else {
            document.getElementById('dedup-controls').style.display = 'none';
        }

        btnCommit.disabled = (f === 0 && d === 0);
        btnCommit.innerHTML = `Commit ${f} Data Baru ke Firebase <i class='bx bx-cloud-upload'></i>`;

        // Render table
        const thead = document.getElementById('preview-thead');
        const tbody = document.getElementById('preview-tbody');
        const contactCol = uploadState.mode === 'wa' ? 'Nomor WA' : 'Email';
        
        thead.innerHTML = `
            <th>#</th>
            <th>Brand</th>
            <th>Produk</th>
            <th>Nama Agen/Toko</th>
            <th>${contactCol}</th>
            <th>Area</th>
            <th>PIC Campaign</th>
            <th>PIC Garap</th>
            <th>Status</th>
        `;

        // Ambil max 10 dari fresh + dupes
        const sample = [...uploadState.fresh, ...uploadState.dupes].slice(0, 10);
        const extKeys = new Set(uploadState.dupes.map(x => x._key));

        tbody.innerHTML = sample.map((l, i) => {
            const isDupe = extKeys.has(l._key);
            const stat = isDupe ? `<span style="color:var(--warning);font-weight:700;">Duplikat</span>` : `<span style="color:var(--success);font-weight:700;">Baru</span>`;
            return `
            <tr>
                <td>${i+1}</td>
                <td>${l.brand}</td>
                <td>${l.produk || '–'}</td>
                <td>${l.nama_agen || '–'}</td>
                <td><strong style="color:var(--primary);">${l.contact_display}</strong></td>
                <td>${l.area}</td>
                <td>${l.pic_campaign || '–'}</td>
                <td>${l.pic_garap || '–'}</td>
                <td>${stat}</td>
            </tr>`;
        }).join('');
    }
}

// ================================================================
// FAB & MANUAL INPUT
// ================================================================
function initManualInput() {
    const fab = document.getElementById('fab-add-lead');
    const modal = document.getElementById('manual-modal');
    const btnSave = document.getElementById('btn-save-manual');

    function updateManualContact2Label() {
        const mode = document.getElementById('manual-mode').value;
        const label1 = document.getElementById('manual-contact-label');
        const input1 = document.getElementById('manual-contact');
        const label2 = document.getElementById('manual-contact2-label');
        const input2 = document.getElementById('manual-contact2');
        if (mode === 'wa') {
            label1.innerHTML = 'Nomor WA <span style="color:var(--danger);">*</span>';
            input1.placeholder = 'Contoh: 08123...';
            label2.textContent = 'Email (opsional)';
            input2.placeholder = 'Kontak tambahan, biar lead ini bisa dihubungi lewat WA & Email';
        } else {
            label1.innerHTML = 'Email <span style="color:var(--danger);">*</span>';
            input1.placeholder = 'Contoh: budi@email.com';
            label2.textContent = 'Nomor WA (opsional)';
            input2.placeholder = 'Kontak tambahan, biar lead ini bisa dihubungi lewat WA & Email';
        }
    }

    window.closeManualModal = function() {
        modal.classList.add('hidden');
        document.getElementById('manual-contact').value = '';
        document.getElementById('manual-contact2').value = '';
        document.getElementById('manual-nomor-wa-terpakai').value = '';
        document.getElementById('manual-nama').value = '';
        document.getElementById('manual-area').value = '';
        document.getElementById('manual-brand').value = '';
        document.getElementById('manual-provinsi').value = '';
        document.getElementById('manual-produk').value = '';
        document.getElementById('manual-pic').value = '';
    };

    if (fab) {
        fab.addEventListener('click', () => {
            modal.classList.remove('hidden');
            document.getElementById('manual-mode').value = AppState.mode;
            updateManualContact2Label();
        });
    }

    document.getElementById('manual-mode')?.addEventListener('change', updateManualContact2Label);

    if (btnSave) {
        btnSave.addEventListener('click', async () => {
            const mode = document.getElementById('manual-mode').value;
            const contact = document.getElementById('manual-contact').value.trim();
            const contact2 = document.getElementById('manual-contact2').value.trim();
            const area = document.getElementById('manual-area').value.trim();
            const brand = document.getElementById('manual-brand').value.trim();
            if (!contact || !area || !brand) {
                showToast('Kontak, Area, dan Brand wajib diisi!', 'error');
                return;
            }

            btnSave.disabled = true;
            btnSave.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Menyimpan...`;

            try {
                // Parse and Clean
                const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                let _key = '', display = '';
                if (mode === 'wa') {
                    const cl = LeadsCleaner.normalizePhone(contact);
                    if (!cl) throw new Error('Format Nomor WA tidak valid (gunakan awalan 08 / 628)');
                    _key = cl; display = cl;
                } else {
                    const emailLower = contact.toLowerCase();
                    if (!emailRegex.test(emailLower)) throw new Error('Format Email tidak valid');
                    _key = LeadsCleaner.sanitizeEmailKey(emailLower);
                    display = emailLower;
                }

                // Kontak kedua (opsional) — biar lead ini bisa dihubungi lewat WA & Email
                // sekaligus, tanpa mengubah _key/tree utamanya (lihat Perbaikan 5 di plan).
                let secondaryField = null, secondaryValue = null;
                if (contact2) {
                    if (mode === 'wa') {
                        const emailLower2 = contact2.toLowerCase();
                        if (!emailRegex.test(emailLower2)) throw new Error('Format Email (kontak tambahan) tidak valid');
                        secondaryField = 'email'; secondaryValue = emailLower2;
                    } else {
                        const cl2 = LeadsCleaner.normalizePhone(contact2);
                        if (!cl2) throw new Error('Format Nomor WA (kontak tambahan) tidak valid (gunakan awalan 08 / 628)');
                        secondaryField = 'phone'; secondaryValue = cl2;
                    }
                }

                const provinsiInput = document.getElementById('manual-provinsi').value.trim();
                const newLead = {
                    _key,
                    contact_display: display,
                    brand, area,
                    provinsi: provinsiInput || LeadsFilter.lookupProvince(area) || '',
                    produk: document.getElementById('manual-produk').value.trim(),
                    nama_agen: document.getElementById('manual-nama').value.trim(),
                    pic_garap: document.getElementById('manual-pic').value.trim(),
                    nomor_wa_terpakai: document.getElementById('manual-nomor-wa-terpakai').value.trim(),
                    tipe_leads: 'New',
                    created_at: new Date().toISOString().split('T')[0],
                    updated_at: new Date().toISOString().split('T')[0]
                };
                if (secondaryField) newLead[secondaryField] = secondaryValue;

                if (sessionStorage.getItem('campaign_demo') === 'ok') {
                    const leads = mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
                    leads[_key] = newLead;
                    showToast('Demo Mode: Lead baru berhasil ditambahkan lokal!', 'success');
                    closeManualModal();
                    loadAllData();
                    return;
                }

                const basePath = mode === 'wa' ? APP_CONFIG.DB_PATHS.wa : APP_CONFIG.DB_PATHS.email;
                await FirebaseAPI.patch(`${basePath}/${_key}`, newLead);

                showToast('Lead baru berhasil ditambahkan!', 'success');
                closeManualModal();
                loadAllData(); // reload
            } catch (err) {
                showToast(err.message, 'error');
            } finally {
                btnSave.disabled = false;
                btnSave.innerHTML = `<i class='bx bx-save'></i> Simpan Lead`;
            }
        });
    }
}

// ================================================================
// EDIT LEAD MODAL (edit 1 baris penuh, termasuk Nomor WA / Email)
// ================================================================
function initEditLeadModal() {
    const modal = document.getElementById('edit-lead-modal');
    const btnSave = document.getElementById('btn-save-edit-lead');
    if (!modal || !btnSave) return;

    window.closeEditLeadModal = function() {
        modal.classList.add('hidden');
    };

    // Dipanggil dari tombol pensil di kolom Aksi (js/tracker.js, _bindEditable)
    window.openEditLeadModal = function(key) {
        const leadsObj = AppState.mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        const lead = leadsObj[key];
        if (!lead) { showToast('Data lead tidak ditemukan.', 'error'); return; }

        document.getElementById('edit-key').value = key;
        document.getElementById('edit-contact-label').textContent = AppState.mode === 'wa' ? 'Nomor WhatsApp' : 'Alamat Email';
        document.getElementById('edit-contact').value = AppState.mode === 'wa'
            ? (lead.phone || '')
            : (lead.email || LeadsCleaner.reverseEmailKey(lead._key) || '');
        // Kontak kedua (opsional) — kanal satunya, kalau lead ini sudah "nyambung" WA+Email
        document.getElementById('edit-contact2-label').textContent = AppState.mode === 'wa' ? 'Email (opsional)' : 'Nomor WA (opsional)';
        document.getElementById('edit-contact2').value = AppState.mode === 'wa' ? (lead.email || '') : (lead.phone || '');
        document.getElementById('edit-nomor-wa-terpakai').value = lead.nomor_wa_terpakai || '';
        // "Kontak Aktif" cuma relevan/ditampilkan kalau lead ini punya WA DAN Email
        // dua-duanya (dual-contact) — kalau cuma 1 channel, tidak ada pilihan sungguhan.
        const hasDualContact = !!(lead.phone && lead.email);
        const kontakAktifWrap = document.getElementById('edit-kontak-aktif-wrap');
        kontakAktifWrap.style.display = hasDualContact ? 'block' : 'none';
        const kontakAktif = Array.isArray(lead.kontak_aktif) ? lead.kontak_aktif : [];
        document.getElementById('edit-kontak-aktif-wa').checked = kontakAktif.includes('wa');
        document.getElementById('edit-kontak-aktif-email').checked = kontakAktif.includes('email');
        document.getElementById('edit-nama-agen').value    = lead.nama_agen || '';
        document.getElementById('edit-brand').value        = lead.brand || '';
        document.getElementById('edit-area').value         = lead.area || '';
        document.getElementById('edit-alamat').value       = lead.alamat || '';
        document.getElementById('edit-provinsi').value     = lead.provinsi || '';
        document.getElementById('edit-produk').value       = lead.produk || '';
        document.getElementById('edit-pic-campaign').value = lead.pic_campaign || '';
        document.getElementById('edit-pic-garap').value    = lead.pic_garap || '';
        document.getElementById('edit-tahap').value        = lead.tahap || '';
        document.getElementById('edit-tipe-leads').value   = lead.tipe_leads || 'New';
        document.getElementById('edit-respon').value       = lead.respon || '';
        document.getElementById('edit-aksi-lanjutan').value= lead.aksi_lanjutan || '';
        document.getElementById('edit-keterangan').value   = lead.keterangan || '';

        modal.classList.remove('hidden');
    };

    btnSave.addEventListener('click', async () => {
        const mode      = AppState.mode;
        const leadsObj  = mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        const oldKey    = document.getElementById('edit-key').value;
        const oldLead   = leadsObj[oldKey];
        if (!oldLead) { showToast('Data lead tidak ditemukan.', 'error'); closeEditLeadModal(); return; }

        const contactRaw = document.getElementById('edit-contact').value.trim();
        const contact2Raw = document.getElementById('edit-contact2').value.trim();
        const brand = document.getElementById('edit-brand').value.trim();
        const area  = document.getElementById('edit-area').value.trim();
        if (!contactRaw || !brand || !area) {
            showToast(`${mode === 'wa' ? 'Nomor WA' : 'Email'}, Brand, dan Area wajib diisi!`, 'error');
            return;
        }

        const emailValidRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        // Kontak (WA/Email) adalah key node Firebase-nya juga — kalau nomor/emailnya
        // diubah, key-nya ikut berubah (data dipindah ke key baru, key lama dihapus).
        let newKey, contactField;
        if (mode === 'wa') {
            const cleanPhone = LeadsCleaner.normalizePhone(contactRaw);
            if (!cleanPhone) { showToast('Format Nomor WA tidak valid (gunakan awalan 08 / 628).', 'error'); return; }
            newKey = cleanPhone;
            contactField = { phone: cleanPhone };
        } else {
            if (!emailValidRegex.test(contactRaw)) {
                showToast('Format Email tidak valid.', 'error');
                return;
            }
            const emailLower = contactRaw.toLowerCase();
            newKey = LeadsCleaner.sanitizeEmailKey(emailLower);
            contactField = { email: emailLower };
        }

        // Kontak kedua (opsional) — kanal satunya. Dikosongkan di form = dihapus dari lead ini.
        if (contact2Raw) {
            if (mode === 'wa') {
                if (!emailValidRegex.test(contact2Raw)) { showToast('Format Email (kontak tambahan) tidak valid.', 'error'); return; }
                contactField.email = contact2Raw.toLowerCase();
            } else {
                const cleanPhone2 = LeadsCleaner.normalizePhone(contact2Raw);
                if (!cleanPhone2) { showToast('Format Nomor WA (kontak tambahan) tidak valid (gunakan awalan 08 / 628).', 'error'); return; }
                contactField.phone = cleanPhone2;
            }
        } else {
            if (mode === 'wa') contactField.email = ''; else contactField.phone = '';
        }

        // Kontak Aktif — array channel ('wa'/'email') yang pernah/sedang dipakai tim
        // ngobrol ke lead ini, bisa dua-duanya sekaligus. Cuma disimpan kalau field-nya
        // memang kelihatan (dual-contact) — kalau lead cuma 1 channel, tidak relevan.
        const kontakAktifWrapVisible = document.getElementById('edit-kontak-aktif-wrap').style.display !== 'none';
        const kontakAktif = [];
        if (kontakAktifWrapVisible) {
            if (document.getElementById('edit-kontak-aktif-wa').checked) kontakAktif.push('wa');
            if (document.getElementById('edit-kontak-aktif-email').checked) kontakAktif.push('email');
        }

        const updatedLead = {
            ...oldLead,
            ...contactField,
            nama_agen:      document.getElementById('edit-nama-agen').value.trim(),
            brand,
            area,
            alamat:         document.getElementById('edit-alamat').value.trim(),
            provinsi:       document.getElementById('edit-provinsi').value.trim(),
            produk:         document.getElementById('edit-produk').value.trim(),
            pic_campaign:   document.getElementById('edit-pic-campaign').value.trim(),
            pic_garap:      document.getElementById('edit-pic-garap').value.trim(),
            tahap:          document.getElementById('edit-tahap').value,
            tipe_leads:     document.getElementById('edit-tipe-leads').value,
            respon:         document.getElementById('edit-respon').value.trim(),
            aksi_lanjutan:  document.getElementById('edit-aksi-lanjutan').value.trim(),
            keterangan:     document.getElementById('edit-keterangan').value.trim(),
            nomor_wa_terpakai: document.getElementById('edit-nomor-wa-terpakai').value.trim(),
            kontak_aktif:   kontakAktif,
            updated_at:     new Date().toISOString().split('T')[0],
            _key: newKey
        };

        const keyChanged = newKey !== oldKey;
        const originalBtnHtml = btnSave.innerHTML;
        btnSave.disabled = true;
        btnSave.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Menyimpan...`;

        try {
            const basePath = mode === 'wa' ? APP_CONFIG.DB_PATHS.wa : APP_CONFIG.DB_PATHS.email;

            if (sessionStorage.getItem('campaign_demo') === 'ok') {
                if (keyChanged) delete leadsObj[oldKey];
                leadsObj[newKey] = updatedLead;
            } else {
                await FirebaseAPI.patch(`${basePath}/${newKey}`, updatedLead);
                if (keyChanged) {
                    await FirebaseAPI.delete(`${basePath}/${oldKey}`);
                    delete leadsObj[oldKey];
                }
                leadsObj[newKey] = updatedLead;
            }

            // Selaraskan baris terpilih (checkbox) kalau key-nya berubah
            if (keyChanged && CRMTracker._selectedKeys.has(oldKey)) {
                CRMTracker._selectedKeys.delete(oldKey);
                CRMTracker._selectedKeys.add(newKey);
            }

            showToast('Lead berhasil diperbarui!', 'success');
            closeEditLeadModal();
            updateFilterOptions();
            renderLeadsTable();
            renderDashboard();
        } catch (err) {
            console.error('Edit lead error:', err);
            showToast('Gagal menyimpan perubahan. Cek koneksi.', 'error');
        } finally {
            btnSave.disabled = false;
            btnSave.innerHTML = originalBtnHtml;
        }
    });
}

// ================================================================
// CARI & GANTI MASSAL — ganti nilai 1 field untuk SEMUA leads yang cocok
// sekaligus (Brand/Area/Produk/PIC Campaign/PIC Garap), tidak dibatasi
// centang/halaman aktif seperti bulk-bar biasa. Reuse CRMTracker.bulkRenameField
// (js/tracker.js) yang cari key berdasar nilai lama, bukan dari _selectedKeys.
// ================================================================
const RENAME_MASSAL_LABELS = {
    brand: 'Brand', produk: 'Produk', provinsi: 'Area Utama', area: 'Sub Area',
    pic_campaign: 'PIC Campaign', pic_garap: 'PIC Garap', aksi_lanjutan: 'Aksi Lanjutan',
    tahap: 'Tahap', tipe_leads: 'Tipe Leads',
};
// Reuse sentinel yang sama dengan filter dropdown utama (js/filter.js) — 1 pola
// buat "field ini kosong" di seluruh app, bukan konstanta terpisah-pisah.
const RENAME_MASSAL_EMPTY = LEADS_EMPTY_SENTINEL;

function initRenameMassal() {
    const modal = document.getElementById('rename-massal-modal');
    const fieldSel = document.getElementById('rename-field');
    const fromSel = document.getElementById('rename-from');
    const toInput = document.getElementById('rename-to');
    const previewEl = document.getElementById('rename-preview-count');
    const btnApply = document.getElementById('btn-apply-rename-massal');
    if (!modal || !fieldSel || !fromSel || !toInput || !btnApply) return;

    window.closeRenameMassalModal = function() {
        modal.classList.add('hidden');
        document.getElementById('rename-progress').style.display = 'none';
    };

    function currentLeadsArray() {
        const leadsObj = AppState.mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        return Object.values(leadsObj);
    }

    function populateFromDropdown() {
        const field = fieldSel.value;
        const leads = currentLeadsArray();
        const values = [...new Set(leads.map(l => l[field] || ''))].sort();
        const hasEmpty = values.includes('');
        const named = values.filter(v => v !== '');
        fromSel.innerHTML =
            (hasEmpty ? `<option value="${RENAME_MASSAL_EMPTY}">(Kosong / belum diisi)</option>` : '') +
            named.map(v => `<option value="${String(v).replace(/"/g, '&quot;')}">${String(v).replace(/</g, '&lt;')}</option>`).join('');
        updatePreview();
    }

    function updatePreview() {
        const field = fieldSel.value;
        const rawFrom = fromSel.value;
        const oldValue = rawFrom === RENAME_MASSAL_EMPTY ? '' : rawFrom;
        const leads = currentLeadsArray();
        const count = leads.filter(l => (l[field] || '') === oldValue).length;
        const toVal = toInput.value.trim();
        previewEl.textContent = count > 0 ? `${count} leads akan diubah ${RENAME_MASSAL_LABELS[field]}-nya.` : 'Tidak ada leads yang cocok dengan nilai ini.';
        btnApply.disabled = !(count > 0 && toVal);
    }

    document.getElementById('btn-open-rename-massal')?.addEventListener('click', () => {
        modal.classList.remove('hidden');
        toInput.value = '';
        populateFromDropdown();
    });

    fieldSel.addEventListener('change', populateFromDropdown);
    fromSel.addEventListener('change', updatePreview);
    toInput.addEventListener('input', updatePreview);

    btnApply.addEventListener('click', async () => {
        const field = fieldSel.value;
        const rawFrom = fromSel.value;
        const oldValue = rawFrom === RENAME_MASSAL_EMPTY ? '' : rawFrom;
        const newValue = toInput.value.trim();
        if (!newValue) return;

        const originalBtnHtml = btnApply.innerHTML;
        btnApply.disabled = true;
        btnApply.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Memproses...`;
        const progressWrap = document.getElementById('rename-progress');
        const progressLbl = document.getElementById('rename-progress-label');
        const progressPct = document.getElementById('rename-progress-pct');
        const progressFill = document.getElementById('rename-progress-fill');
        progressWrap.style.display = 'block';
        progressLbl.textContent = 'Menyiapkan...';
        progressPct.textContent = '0%';
        progressFill.style.width = '0%';

        const result = await CRMTracker.bulkRenameField(field, oldValue, newValue, AppState.mode, (done, total) => {
            const pct = Math.round((done / total) * 100);
            progressLbl.textContent = `Memproses ${done} / ${total}...`;
            progressPct.textContent = pct + '%';
            progressFill.style.width = pct + '%';
        });

        showToast(`✓ ${result.ok} leads diperbarui${result.fail ? `, ${result.fail} gagal` : ''}.`, result.fail ? 'warning' : 'success');
        updateFilterOptions();
        closeRenameMassalModal();
        btnApply.disabled = false;
        btnApply.innerHTML = originalBtnHtml;
    });
}

// ================================================================
// EXPORT HANDOVER MITRA AREA — 1-klik export CSV per Area Utama,
// supaya leads yang sudah closing di suatu wilayah bisa diserahkan
// ke Mitra Area setempat tanpa perlu set beberapa filter manual dulu.
// ================================================================
function initHandoverExport() {
    const modal = document.getElementById('handover-modal');
    const provinsiSel = document.getElementById('handover-provinsi');
    const onlyClosingChk = document.getElementById('handover-only-closing');
    const previewEl = document.getElementById('handover-preview-count');
    const btnApply = document.getElementById('btn-apply-handover');
    if (!modal || !provinsiSel || !onlyClosingChk || !btnApply) return;

    window.closeHandoverModal = function() {
        modal.classList.add('hidden');
    };

    function currentLeadsArray() {
        const leadsObj = AppState.mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        return Object.values(leadsObj);
    }

    function scopedLeads() {
        const provinsi = provinsiSel.value;
        return currentLeadsArray().filter(l =>
            (l.provinsi || '') === provinsi && (!onlyClosingChk.checked || l.tahap === 'CLOSING'));
    }

    function updatePreview() {
        const count = scopedLeads().length;
        previewEl.textContent = count > 0
            ? `${count} leads siap diexport untuk area ini.`
            : 'Tidak ada leads yang cocok — coba matikan filter "hanya CLOSING".';
        btnApply.disabled = count === 0;
    }

    document.getElementById('btn-open-handover')?.addEventListener('click', () => {
        const provinsis = [...new Set(currentLeadsArray().map(l => l.provinsi).filter(Boolean))].sort();
        provinsiSel.innerHTML = provinsis.length
            ? provinsis.map(p => `<option value="${String(p).replace(/"/g, '&quot;')}">${String(p).replace(/</g, '&lt;')}</option>`).join('')
            : '<option value="">(Belum ada Area Utama terisi di data)</option>';
        modal.classList.remove('hidden');
        updatePreview();
    });

    provinsiSel.addEventListener('change', updatePreview);
    onlyClosingChk.addEventListener('change', updatePreview);

    btnApply.addEventListener('click', () => {
        const leads = scopedLeads();
        if (!leads.length) return;
        CRMTracker.exportCSV(leads, AppState.mode);
        closeHandoverModal();
    });
}

// ================================================================
// INIT
// ================================================================
document.addEventListener('DOMContentLoaded', () => {
    initLogin();
    initModeSwitcher();
    initNavigation();
    initUploadWizard();
    initFilters();
    initDashboardFilters();
    initBulkActions();
    initManualInput();
    initEditLeadModal();
    initRenameMassal();
    initHandoverExport();
    initLeadgen();
});
