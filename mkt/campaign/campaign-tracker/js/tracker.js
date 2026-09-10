/**
 * tracker.js — Campaign SIMASRIM
 * CRM Table (inline editable, Excel-like), Smart Triggers, Bulk Edit,
 * Pagination, Sorting, Export CSV, WA/Email quick links
 */

// ================================================================
// SMART TRIGGERS — Keyword → Tipe Leads
// ================================================================
const SMART_TRIGGERS = [
    {
        keywords: ['tidak', 'tolak', 'blokir', 'tutup', 'batal', 'dead', 'buang', 'hapus', 'stop',
                   'ga mau', 'gak mau', 'nggak', 'ngga', 'enggak', 'ogah'],
        result: 'Cold / Dead', color: 'dead'
    },
    {
        keywords: ['tanya', 'brosur', 'apa', 'gimana', 'bagaimana', 'info', 'jelasin',
                   'cerita', 'cara', 'berapa', 'harga', 'detail', 'kirim', 'share'],
        result: 'Warm', color: 'warm'
    },
    {
        keywords: ['daftar', 'mau', 'minat', 'bisa', 'oke', 'siap', 'deal', 'setuju',
                   'lanjut', 'ya', 'iya', 'mau dong', 'cobain', 'ikut', 'gabung'],
        result: 'Hot', color: 'hot'
    }
];

// Escape HTML — WAJIB dipakai untuk semua field yang asalnya dari upload/migrasi/
// isian manual (nama_agen, brand, area, keterangan, respon, kontak, dll) sebelum
// masuk innerHTML, supaya teks semacam "<img src=x onerror=...>" tidak ke-eksekusi
// sebagai HTML/JS (stored XSS) buat semua orang yang buka tabel ini.
function escapeHtml(s) {
    return String(s == null ? '' : s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
}

const TAHAP_OPTIONS = ['PESAN 1', 'PESAN 2', 'PESAN 3', 'FOLLOW UP', 'CLOSING'];
const FU_DANGER_DAYS = 3;  // Hot/Warm, belum closing, >=3 hari tanpa update -> "Danger" (perhatian, belum wajib)
const FU_WAJIB_DAYS  = 7;  // >=7 hari -> "Wajib FU" (menang, bukan numpuk di atas Danger)

// ================================================================
// Status "Perlu Follow-Up" — cuma leads Hot/Warm yang belum closing dan
// sudah beberapa hari tanpa update. Cold sengaja tidak pernah masuk sini
// (dianggap sudah tidak prospektif, tidak perlu diingatkan terus-menerus).
// Return: null (tidak perlu FU) | 'danger' | 'wajib'
// ================================================================
function getFollowUpStatus(lead) {
    if (!lead || !lead.updated_at) return null;
    if (lead.tipe_leads !== 'Hot' && lead.tipe_leads !== 'Warm') return null;
    if (String(lead.tahap || '').toUpperCase() === 'CLOSING') return null;
    const updated = new Date(lead.updated_at);
    if (isNaN(updated.getTime())) return null;
    const days = Math.floor((Date.now() - updated.getTime()) / (1000 * 60 * 60 * 24));
    if (days >= FU_WAJIB_DAYS) return 'wajib';
    if (days >= FU_DANGER_DAYS) return 'danger';
    return null;
}

function daysSinceUpdate(lead) {
    const updated = new Date(lead.updated_at);
    if (isNaN(updated.getTime())) return 0;
    return Math.floor((Date.now() - updated.getTime()) / (1000 * 60 * 60 * 24));
}

// ================================================================
// Evaluate Smart Trigger berdasarkan teks respon
// Returns: string tipe_leads baru, atau null jika tidak ada match
// ================================================================
function evalSmartTrigger(respon) {
    if (!respon) return null;
    const lower = respon.toLowerCase();
    // Prioritas dari Hot → Warm → Dead (iterate terbalik dari array)
    for (let i = SMART_TRIGGERS.length - 1; i >= 0; i--) {
        const trigger = SMART_TRIGGERS[i];
        if (trigger.keywords.some(kw => lower.includes(kw))) {
            return trigger.result;
        }
    }
    return null;
}

// ================================================================
// Render badge Tipe Leads
// ================================================================
function renderTipeBadge(tipe) {
    const map = {
        'Hot':        { cls: 'leads-hot',  icon: '🔴' },
        'Warm':       { cls: 'leads-warm', icon: '🟡' },
        'Cold':       { cls: 'leads-cold', icon: '🔵' },
        'Cold / Dead':{ cls: 'leads-dead', icon: '⚫' },
        'New':        { cls: 'leads-new',  icon: '🆕' },
    };
    const t = map[tipe] || { cls: 'leads-new', icon: '–' };
    return `<span class="leads-badge ${t.cls}">${t.icon} ${escapeHtml(tipe || 'New')}</span>`;
}

// ================================================================
// Copy ke clipboard — tangguh terhadap koneksi HTTP biasa (non-HTTPS)
// ================================================================
// navigator.clipboard (Clipboard API modern) HANYA tersedia di "secure context"
// (HTTPS, atau http://localhost). Di http://<ip-lan>:port biasa, `navigator.clipboard`
// bisa jadi undefined — memanggil .writeText() langsung akan throw TypeError diam-diam
// (tidak ada notif error/success sama sekali, dan clipboard tidak berubah). Fungsi ini
// selalu coba cara modern dulu, lalu otomatis jatuh ke cara lama (execCommand) yang
// tidak butuh koneksi aman, supaya copy tetap jalan di kondisi apa pun.
function copyTextRobust(text) {
    if (navigator.clipboard && typeof navigator.clipboard.writeText === 'function') {
        return navigator.clipboard.writeText(text).catch(() => copyTextFallback(text));
    }
    return copyTextFallback(text);
}
function copyTextFallback(text) {
    return new Promise((resolve, reject) => {
        try {
            const ta = document.createElement('textarea');
            ta.value = text;
            ta.style.position = 'fixed';
            ta.style.left = '-9999px';
            ta.style.top = '0';
            document.body.appendChild(ta);
            ta.focus();
            ta.select();
            const ok = document.execCommand('copy');
            document.body.removeChild(ta);
            if (ok) resolve(); else reject(new Error('execCommand copy gagal'));
        } catch (e) { reject(e); }
    });
}

// ================================================================
// Render contact link (WA / Email)
// ================================================================
window.copyToClipboard = function(text) {
    copyTextRobust(text).then(() => {
        showToast('Tersalin!', 'success');
    }).catch(() => {
        showToast('Gagal menyalin. Coba salin manual (blok teks lalu Ctrl+C).', 'error');
    });
};
// Badge kecil "✓ Aktif" — muncul di sebelah channel (WA/Email) yang ada di
// lead.kontak_aktif (array, bisa muncul di WA saja/Email saja/dua-duanya).
function renderKontakAktifBadge(lead, channel) {
    if (!Array.isArray(lead.kontak_aktif) || !lead.kontak_aktif.includes(channel)) return '';
    return `<span style="font-size:0.62rem;font-weight:700;color:var(--success,#22c55e);margin-left:4px;" title="Channel ini aktif/pernah dipakai chat">✓ Aktif</span>`;
}

function renderContactLink(lead, mode) {
    if (mode === 'wa') {
        // Fallback ke contact_display CUMA kalau lead ini tidak punya field email —
        // kalau punya email, contact_display kemungkinan besar berisi email (lead ini
        // aslinya di-upload sbg mode email), jadi jangan sampai dirender jadi link WA.
        const phone = lead.phone || (!lead.email ? lead.contact_display : '') || '';
        const phoneEsc = escapeHtml(phone);
        const primary = `<span style="display:inline-flex;align-items:center;"><a href="https://wa.me/${phoneEsc}" target="_blank" class="contact-link wa" title="Buka WhatsApp">
            <i class='bx bxl-whatsapp'></i>${phoneEsc}
        </a><button class="copy-btn" onclick="copyToClipboard('${phoneEsc}')" title="Salin WA"><i class='bx bx-copy'></i></button>${renderKontakAktifBadge(lead, 'wa')}</span>`;
        return primary + renderSecondaryContact(lead.email, 'email', lead) + renderNomorWaTerpakai(lead);
    } else {
        const email = lead.email || (!lead.phone ? lead.contact_display : '') || LeadsCleaner.reverseEmailKey(lead._key) || '';
        const emailEsc = escapeHtml(email);
        const primary = `<span style="display:inline-flex;align-items:center;"><a href="mailto:${emailEsc}" class="contact-link email" title="Kirim Email">
            <i class='bx bx-envelope'></i>${emailEsc}
        </a><button class="copy-btn" onclick="copyToClipboard('${emailEsc}')" title="Salin Email"><i class='bx bx-copy'></i></button>${renderKontakAktifBadge(lead, 'email')}</span>`;
        return primary + renderSecondaryContact(lead.phone, 'phone', lead) + renderNomorWaTerpakai(lead);
    }
}

// Kontak kedua (opsional) — kanal satunya, kalau lead ini "nyambung" WA+Email
// sekaligus (lihat Perbaikan 5). Ditampilkan sebagai baris kecil di bawah kontak
// utama, TANPA menambah kolom baru ke tabel (biar tidak ganggu spreadsheet-mode/
// data-col indexing yang sudah ada).
function renderSecondaryContact(value, type, lead) {
    if (!value) return '';
    const esc = escapeHtml(value);
    const badge = renderKontakAktifBadge(lead, type === 'email' ? 'email' : 'wa');
    // Label kecil "+Email"/"+WA" di depan — supaya langsung jelas ini kontak channel
    // TAMBAHAN (bukan channel utama kolom), tanpa perlu hover ke tooltip dulu.
    const secLabelStyle = 'font-size:0.6rem;font-weight:700;color:var(--success,#22c55e);margin-right:3px;';
    if (type === 'email') {
        return `<div style="margin-top:2px;"><span style="${secLabelStyle}">+Email</span><a href="mailto:${esc}" class="contact-link email" style="font-size:0.72rem;opacity:0.8;" title="Kontak tambahan: Email">
            <i class='bx bx-envelope'></i>${esc}
        </a>${badge}</div>`;
    }
    return `<div style="margin-top:2px;"><span style="${secLabelStyle}">+WA</span><a href="https://wa.me/${esc}" target="_blank" class="contact-link wa" style="font-size:0.72rem;opacity:0.8;" title="Kontak tambahan: WhatsApp">
        <i class='bx bxl-whatsapp'></i>${esc}
    </a>${badge}</div>`;
}

// Catatan nomor/akun WA CS mana yang dipakai TIM buat chat ke lead ini (beda dari
// kontak WA milik LEAD sendiri) — relevan kalau tim punya >1 nomor WA CS, biar
// jelas & keinget CS mana yang pegang percakapan ini. Muncul cuma kalau diisi
// lewat form Tambah Lead Manual / Edit Lead.
function renderNomorWaTerpakai(lead) {
    if (!lead.nomor_wa_terpakai) return '';
    return `<div style="margin-top:2px;font-size:0.7rem;color:var(--text-muted);">📞 CS: ${escapeHtml(lead.nomor_wa_terpakai)}</div>`;
}

// ================================================================
// Render Tahap Badge
// ================================================================
function renderTahapBadge(tahap) {
    if (!tahap) return '<span style="color:var(--text-light);font-size:0.75rem;">–</span>';
    return `<span class="tahap-badge"><i class='bx bx-send'></i>${escapeHtml(tahap)}</span>`;
}

// ================================================================
// Format tanggal_kirim (array) → tampilan
// ================================================================
function formatTanggalKirim(arr) {
    if (!arr || arr.length === 0) return '<span style="color:var(--text-light);font-size:0.75rem;">–</span>';
    if (!Array.isArray(arr)) arr = [arr];
    return arr.map(d => `<span style="font-size:0.72rem;background:var(--primary-light);color:var(--primary);padding:1px 7px;border-radius:10px;display:inline-block;margin:1px;">${escapeHtml(d)}</span>`).join('');
}

// ================================================================
// CRM Tracker — Tabel Manager
// ================================================================
const CRMTracker = {

    PAGE_SIZE: 50,
    _currentPage: 1,
    _sortField: null,
    _sortDir: 'asc',
    _selectedKeys: new Set(),

    // ── Build table header ──────────────────────────────────────
    buildHeader(mode) {
        const thead = document.getElementById('leads-thead');
        if (!thead) return;
        const cols = this._getColumns(mode);
        thead.innerHTML = `<th class="col-check"><input type="checkbox" id="select-all-cb" class="row-checkbox" title="Pilih semua"></th>` +
            cols.map(c => `<th class="${c.sortable ? 'sortable' : ''}" data-field="${c.field || ''}">${c.label}${c.sortable ? '<i class="bx bx-sort-alt-2 sort-icon"></i>' : ''}</th>`).join('');

        // Sort click
        thead.querySelectorAll('th.sortable').forEach(th => {
            th.addEventListener('click', () => {
                const f = th.dataset.field;
                if (this._sortField === f) {
                    this._sortDir = this._sortDir === 'asc' ? 'desc' : 'asc';
                } else {
                    this._sortField = f; this._sortDir = 'asc';
                }
                thead.querySelectorAll('th').forEach(t => t.classList.remove('sort-asc', 'sort-desc'));
                th.classList.add(this._sortDir === 'asc' ? 'sort-asc' : 'sort-desc');
                this.rerenderCurrentPage();
            });
        });

        // Select all checkbox
        const selAll = document.getElementById('select-all-cb');
        if (selAll) {
            selAll.addEventListener('change', () => {
                const cbs = document.querySelectorAll('.row-cb');
                cbs.forEach(cb => { cb.checked = selAll.checked; });
                this._syncSelectedFromDOM();
                this._updateBulkBar();
            });
        }
    },

    _getColumns(mode) {
        const contactLabel = mode === 'wa' ? 'Nomor WA' : 'Email';
        return [
            { label: '#', field: null },
            { label: 'Brand', field: 'brand', sortable: true },
            { label: 'Produk', field: 'produk', sortable: true },
            { label: 'Nama Agen/Toko', field: 'nama_agen', sortable: true },
            { label: contactLabel, field: 'contact_display', sortable: true },
            { label: 'Area Utama', field: 'provinsi', sortable: true },
            { label: 'Sub Area', field: 'area', sortable: true },
            { label: 'Alamat', field: 'alamat' },
            { label: 'PIC Campaign', field: 'pic_campaign', sortable: true },
            { label: 'PIC Garap', field: 'pic_garap', sortable: true },
            { label: 'Nomor WA CS Dipakai', field: 'nomor_wa_terpakai', sortable: true },
            { label: 'Tahap', field: 'tahap', sortable: true },
            { label: 'Tgl Kirim', field: null },
            { label: 'Respon', field: 'respon', sortable: true },
            { label: 'Aksi Lanjutan', field: 'aksi_lanjutan' },
            { label: 'Tipe Leads', field: 'tipe_leads', sortable: true },
            { label: 'Keterangan', field: 'keterangan' },
            { label: 'Aksi', field: null },
        ];
    },

    // ── Sort data ────────────────────────────────────────────────
    sortData(leads) {
        if (!this._sortField) return leads;
        return [...leads].sort((a, b) => {
            const av = String(a[this._sortField] || '').toLowerCase();
            const bv = String(b[this._sortField] || '').toLowerCase();
            const cmp = av.localeCompare(bv, 'id');
            return this._sortDir === 'asc' ? cmp : -cmp;
        });
    },

    // ── Render tabel dengan pagination ──────────────────────────
    render(filteredLeads, mode) {
        this._currentPage = 1;
        this._render(filteredLeads, mode);
    },

    rerenderCurrentPage() {
        // PENTING: `AppState` di app.js dideklarasikan `const` di top-level — di browser,
        // const/let top-level TIDAK nempel ke `window` (beda dari `var`), jadi `window.AppState`
        // selalu undefined walau `AppState` polos tetap bisa diakses lintas file <script>.
        if (AppState._filteredLeads) {
            this._render(AppState._filteredLeads, AppState.mode);
        }
    },

    _render(leads, mode) {
        // Highlight/rentang Spreadsheet Mode dari render sebelumnya sudah tidak valid
        // begitu tabel di-render ulang (ganti halaman/sort/filter) — index row bisa
        // menunjuk lead yang berbeda sekarang. Bersihkan dulu supaya Ctrl+C tidak
        // salah sasaran diam-diam.
        this._clearRange();

        const sorted = this.sortData(leads);
        const total  = sorted.length;
        const pages  = Math.max(1, Math.ceil(total / this.PAGE_SIZE));
        if (this._currentPage > pages) this._currentPage = pages;

        const start = (this._currentPage - 1) * this.PAGE_SIZE;
        const page  = sorted.slice(start, start + this.PAGE_SIZE);

        const tbody = document.getElementById('leads-tbody');
        if (!tbody) return;

        if (total === 0) {
            tbody.innerHTML = `<tr><td colspan="19"><div class="empty-state"><i class='bx bx-search-alt'></i><h3>Tidak Ada Data</h3><p>Coba ubah filter atau reset.</p></div></td></tr>`;
            this._renderPagination(0, 0, 0);
            return;
        }

        tbody.innerHTML = page.map((lead, idx) => this._renderRow(lead, mode, start + idx)).join('');

        // Bind editable cells
        this._bindEditable(tbody, mode);

        // Spreadsheet Mode: drag/shift-klik pilih rentang sel, Ctrl+C copy sebagai TSV
        this._initSpreadsheetMode(tbody, mode);

        // Restore selection state
        tbody.querySelectorAll('.row-cb').forEach(cb => {
            cb.checked = this._selectedKeys.has(cb.dataset.key);
        });

        // Count label
        const countEl = document.getElementById('leads-count');
        if (countEl) countEl.textContent = `${total.toLocaleString('id-ID')} leads`;

        this._renderPagination(total, this._currentPage, pages);
        this._updateBulkBar();
    },

    _renderRow(lead, mode, idx) {
        const key         = lead._key || '';
        const contact     = renderContactLink(lead, mode);
        const tipeBadge   = renderTipeBadge(lead.tipe_leads);
        const tahapBadge  = renderTahapBadge(lead.tahap);
        const tglKirim    = formatTanggalKirim(lead.tanggal_kirim);
        const isSelected  = this._selectedKeys.has(key);
        const fuStatus    = getFollowUpStatus(lead);

        let alamat = lead.alamat || '–';
        let alamatHtml = `<td class="editable-cell" data-row="${idx}" data-col="7" data-field="alamat" data-key="${key}" data-type="text">`;
        if (alamat.length > 30) {
            alamatHtml += `<span data-tooltip="${escapeHtml(alamat)}">${escapeHtml(alamat.substring(0, 30))}...</span>`;
        } else {
            alamatHtml += escapeHtml(alamat);
        }
        alamatHtml += `</td>`;

        let ket = lead.keterangan || '–';
        let ketHtml = `<td class="editable-cell" data-row="${idx}" data-col="16" data-field="keterangan" data-key="${key}" data-type="text">`;
        if (ket.length > 25) {
            ketHtml += `<span data-tooltip="${escapeHtml(ket)}">${escapeHtml(ket.substring(0, 25))}...</span>`;
        } else {
            ketHtml += escapeHtml(ket);
        }
        ketHtml += `</td>`;

        let agen = lead.nama_agen || '–';
        let agenHtml = `<td class="editable-cell" data-row="${idx}" data-col="3" data-field="nama_agen" data-key="${key}" data-type="text">`;
        if (agen.length > 20) {
            agenHtml += `<span data-tooltip="${escapeHtml(agen)}">${escapeHtml(agen.substring(0, 20))}...</span>`;
        } else {
            agenHtml += escapeHtml(agen);
        }
        agenHtml += `</td>`;

        const fuBadge = fuStatus === 'wajib'
            ? ` <span class="sla-risk-badge fu-wajib" title="Hot/Warm, sudah >= ${FU_WAJIB_DAYS} hari tanpa update — wajib segera di-follow-up">🔴 Wajib FU</span>`
            : fuStatus === 'danger'
            ? ` <span class="sla-risk-badge fu-danger" title="Hot/Warm, sudah >= ${FU_DANGER_DAYS} hari tanpa update">🟠 Danger</span>`
            : '';

        return `<tr class="${isSelected ? 'selected' : ''}${fuStatus ? ' row-at-risk' : ''}" data-key="${key}">
            <td class="col-check"><input type="checkbox" class="row-checkbox row-cb" data-key="${key}" ${isSelected ? 'checked' : ''}></td>
            <td data-row="${idx}" data-col="0" style="color:var(--text-light);font-size:0.75rem;text-align:center;">${idx + 1}${fuBadge}</td>
            <td class="editable-cell" data-row="${idx}" data-col="1" data-field="brand" data-key="${key}" data-type="text">${escapeHtml(lead.brand) || '–'}</td>
            <td class="editable-cell" data-row="${idx}" data-col="2" data-field="produk" data-key="${key}" data-type="text">${escapeHtml(lead.produk) || '–'}</td>
            ${agenHtml}
            <td data-row="${idx}" data-col="4">${contact}</td>
            <td class="editable-cell" data-row="${idx}" data-col="5" data-field="provinsi" data-key="${key}" data-type="text">${escapeHtml(lead.provinsi) || '–'}</td>
            <td class="editable-cell" data-row="${idx}" data-col="6" data-field="area" data-key="${key}" data-type="text">${escapeHtml(lead.area) || '–'}</td>
            ${alamatHtml}
            <td class="editable-cell" data-row="${idx}" data-col="8" data-field="pic_campaign" data-key="${key}" data-type="text">${escapeHtml(lead.pic_campaign) || '–'}</td>
            <td class="editable-cell" data-row="${idx}" data-col="9" data-field="pic_garap" data-key="${key}" data-type="text">${escapeHtml(lead.pic_garap) || '–'}</td>
            <td class="editable-cell" data-row="${idx}" data-col="10" data-field="nomor_wa_terpakai" data-key="${key}" data-type="text">${escapeHtml(lead.nomor_wa_terpakai) || '–'}</td>
            <td class="editable-cell" data-row="${idx}" data-col="11" data-field="tahap" data-key="${key}" data-type="select" data-options='${JSON.stringify(TAHAP_OPTIONS)}'>${tahapBadge}</td>
            <td class="editable-cell" data-row="${idx}" data-col="12" data-field="tanggal_kirim" data-key="${key}" data-type="date">${tglKirim}</td>
            <td class="editable-cell" data-row="${idx}" data-col="13" data-field="respon" data-key="${key}" data-type="text">${escapeHtml(lead.respon) || '–'}</td>
            <td class="editable-cell" data-row="${idx}" data-col="14" data-field="aksi_lanjutan" data-key="${key}" data-type="text">${escapeHtml(lead.aksi_lanjutan) || '–'}</td>
            <td class="editable-cell" data-row="${idx}" data-col="15" data-field="tipe_leads" data-key="${key}" data-type="tipe">${tipeBadge}</td>
            ${ketHtml}
            <td data-row="${idx}" data-col="17">
                <button class="btn btn-xs btn-ghost" data-action="edit-row" data-key="${key}" title="Edit baris ini (semua kolom, termasuk Nomor WA/Email)" style="color:var(--success);border-color:var(--success);">
                    <i class='bx bx-edit-alt'></i>
                </button>
                <button class="btn btn-xs btn-ghost" data-action="copy-row" data-key="${key}" title="Copy baris ini (semua kolom, siap paste 1 baris utuh ke Excel)" style="color:var(--primary);border-color:var(--primary);">
                    <i class='bx bx-copy'></i>
                </button>
                <button class="btn btn-xs btn-danger" data-action="delete" data-key="${key}" title="Hapus leads ini">
                    <i class='bx bx-trash'></i>
                </button>
            </td>
        </tr>`;
    },

    // ── Bind editable cells ────────────────────────────────────
    _bindEditable(tbody, mode) {
        tbody.querySelectorAll('.editable-cell').forEach(cell => {
            cell.addEventListener('click', (e) => {
                if (cell.querySelector('input, select')) return; // already editing
                if (this._cellSelect.suppressNextClickEdit) {
                    // Klik ini bagian dari drag/shift-klik pilih-rentang (Spreadsheet Mode),
                    // bukan niat untuk edit — jangan buka mode edit.
                    this._cellSelect.suppressNextClickEdit = false;
                    return;
                }
                this._startEdit(cell, mode);
            });
        });

        tbody.querySelectorAll('[data-action="delete"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const key = btn.dataset.key;
                openDeleteModal([key]);
            });
        });

        tbody.querySelectorAll('[data-action="copy-row"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const leads = mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
                const lead = leads[btn.dataset.key];
                if (lead) this.copyFullRow(lead, mode);
            });
        });

        tbody.querySelectorAll('[data-action="edit-row"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (typeof window.openEditLeadModal === 'function') window.openEditLeadModal(btn.dataset.key);
            });
        });

        tbody.querySelectorAll('.row-cb').forEach(cb => {
            cb.addEventListener('change', () => {
                this._syncSelectedFromDOM();
                this._updateBulkBar();
            });
        });
    },

    _startEdit(cell, mode) {
        const field   = cell.dataset.field;
        const key     = cell.dataset.key;
        const type    = cell.dataset.type;
        const rawOrig = cell.innerHTML;

        // Find lead in AppState
        const leads = AppState.mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        const lead  = leads[key] || {};
        let currentVal = lead[field];

        if (type === 'select') {
            const options = JSON.parse(cell.dataset.options || '[]');
            const sel = document.createElement('select');
            sel.className = 'cell-select';
            sel.innerHTML = `<option value="">– Pilih –</option>` +
                options.map(o => `<option value="${o}" ${currentVal === o ? 'selected' : ''}>${o}</option>`).join('');
            // Custom option
            sel.innerHTML += `<option value="__custom__">📝 Ketik Manual...</option>`;
            cell.innerHTML = '';
            cell.appendChild(sel);
            sel.focus();
            sel.addEventListener('change', async () => {
                if (sel.value === '__custom__') {
                    const custom = prompt('Ketik tahap manual:');
                    if (custom) await this._commitEdit(key, field, custom.trim(), cell, mode);
                    else cell.innerHTML = rawOrig;
                } else {
                    await this._commitEdit(key, field, sel.value, cell, mode);
                }
            });
            sel.addEventListener('blur', () => { setTimeout(() => { if (cell.querySelector('select')) cell.innerHTML = rawOrig; }, 200); });

        } else if (type === 'date') {
            // Editor tanggal — bisa tambah DAN hapus (bukan cuma tambah kayak dulu),
            // cell tetap terbuka sampai user klik "Selesai"/Escape supaya bisa
            // tambah/hapus beberapa tanggal sekaligus tanpa buka-tutup cell berkali-kali.
            const arr = Array.isArray(currentVal) ? [...currentVal] : (currentVal ? [currentVal] : []);
            this._renderDateEditor(cell, arr, key, field, mode);

        } else if (type === 'tipe') {
            const TIPE_OPTIONS = ['Hot', 'Warm', 'Cold', 'Cold / Dead', 'New'];
            const sel = document.createElement('select');
            sel.className = 'cell-select';
            sel.innerHTML = TIPE_OPTIONS.map(o => `<option value="${o}" ${currentVal === o ? 'selected' : ''}>${o}</option>`).join('');
            cell.innerHTML = ''; cell.appendChild(sel); sel.focus();
            sel.addEventListener('change', async () => { await this._commitEdit(key, field, sel.value, cell, mode); });
            sel.addEventListener('blur', () => { setTimeout(() => { if (cell.querySelector('select')) cell.innerHTML = rawOrig; }, 200); });

        } else {
            // type === 'text'
            const input = document.createElement('input');
            input.type = 'text'; input.className = 'cell-input';
            input.value = (currentVal && currentVal !== '–') ? currentVal : '';
            cell.innerHTML = ''; cell.appendChild(input); input.focus(); input.select();
            
            let isCanceled = false;
            input.addEventListener('keydown', async (e) => {
                if (e.key === 'Enter')  { 
                    await this._commitEdit(key, field, input.value.trim(), cell, mode); 
                }
                if (e.key === 'Escape') { 
                    isCanceled = true; 
                    cell.innerHTML = rawOrig; 
                }
            });
            input.addEventListener('blur', async () => {
                // Auto-save on blur, tapi hanya jika tidak ESCAPE dan data ada perubahannya
                if (!isCanceled && input.value.trim() !== String(currentVal || '')) {
                    await this._commitEdit(key, field, input.value.trim(), cell, mode);
                } else if (!isCanceled && input.value.trim() === String(currentVal || '')) {
                    cell.innerHTML = rawOrig;
                }
            });
        }
    },

    // Editor Tanggal Kirim — chip per tanggal (bisa dihapus lewat "×") + input buat
    // nambah tanggal baru + tombol "Selesai" buat menutup. Beda dari editor lain,
    // cell ini SENGAJA tidak langsung tertutup tiap kali ada perubahan (lewat
    // customRerender di _commitEdit) supaya bisa tambah/hapus beberapa tanggal
    // berturut-turut tanpa buka-tutup cell berkali-kali. Tiap tambah/hapus langsung
    // ke-PATCH ke Firebase saat itu juga (auto-save per aksi, bukan ditunda sampai
    // "Selesai" diklik) — konsisten dengan cell lain yang juga auto-save.
    // PENTING: editor ini dibangun SEKALI dan dimutasi in-place (tambah/hapus chip
    // langsung ke DOM & array `arr` yang sama) — TIDAK PERNAH memanggil dirinya
    // sendiri ulang / `cell.innerHTML=''` lagi setelah render pertama. Versi lama
    // rebuild total tiap tambah/hapus tanggal, yang merobohkan input/wrap yang
    // sedang fokus → memicu event focusout pada elemen lama yang meng-closure
    // `arr` versi SEBELUM perubahan → race condition, tanggal baru bisa balik
    // kosong/tertimpa. Mutasi in-place menghilangkan race ini sepenuhnya.
    _renderDateEditor(cell, arr, key, field, mode) {
        cell.innerHTML = '';
        const wrap = document.createElement('div');
        wrap.style.cssText = 'display:flex;flex-direction:column;gap:4px;min-width:150px;';

        const chipsRow = document.createElement('div');
        chipsRow.style.cssText = 'display:flex;flex-wrap:wrap;gap:3px;';

        const addChip = (dateStr) => {
            const chip = document.createElement('span');
            chip.style.cssText = 'font-size:0.72rem;background:var(--primary-light);color:var(--primary);padding:1px 4px 1px 7px;border-radius:10px;display:inline-flex;align-items:center;gap:3px;';
            chip.textContent = dateStr;
            const rm = document.createElement('i');
            rm.className = 'bx bx-x';
            rm.style.cssText = 'cursor:pointer;font-size:0.9rem;';
            rm.title = 'Hapus tanggal ini';
            rm.addEventListener('click', async (e) => {
                e.stopPropagation();
                const idx = arr.indexOf(dateStr);
                if (idx === -1) return;
                arr.splice(idx, 1);
                chip.remove();
                await this._commitEdit(key, field, [...arr], cell, mode, () => {});
            });
            chip.appendChild(rm);
            chipsRow.appendChild(chip);
        };
        arr.forEach(addChip);
        wrap.appendChild(chipsRow);

        const addRow = document.createElement('div');
        addRow.style.cssText = 'display:flex;gap:4px;align-items:center;';
        const input = document.createElement('input');
        input.type = 'date'; input.className = 'cell-input';
        input.style.width = '124px';
        const doneBtn = document.createElement('button');
        doneBtn.type = 'button';
        doneBtn.textContent = '✓';
        doneBtn.title = 'Selesai';
        doneBtn.style.cssText = 'border:none;background:var(--success,#22c55e);color:#fff;border-radius:6px;width:22px;height:22px;cursor:pointer;flex-shrink:0;';
        addRow.appendChild(input);
        addRow.appendChild(doneBtn);
        wrap.appendChild(addRow);

        cell.appendChild(wrap);
        input.focus();

        input.addEventListener('keydown', async (e) => {
            if (e.key === 'Enter' && input.value) {
                const d = new Date(input.value);
                const fmt = `${String(d.getDate()).padStart(2,'0')}/${String(d.getMonth()+1).padStart(2,'0')}/${d.getFullYear()}`;
                if (!arr.includes(fmt)) {
                    arr.push(fmt);
                    addChip(fmt);
                    input.value = '';
                    await this._commitEdit(key, field, [...arr], cell, mode, () => {});
                } else {
                    input.value = '';
                }
            } else if (e.key === 'Escape') {
                cell.innerHTML = formatTanggalKirim(arr);
            }
        });
        doneBtn.addEventListener('click', () => { cell.innerHTML = formatTanggalKirim(arr); });
        // Blur ke luar seluruh cell (bukan cuma input) baru nutup — beri delay supaya
        // klik tombol × / Selesai di dalam cell yang sama tidak keburu nutup editor.
        // Listener ini cuma dipasang SEKALI (wrap tidak pernah dibangun ulang), jadi
        // tidak ada lagi listener lama menumpuk dengan closure `arr` yang basi.
        wrap.addEventListener('focusout', () => {
            setTimeout(() => {
                if (!cell.contains(document.activeElement)) cell.innerHTML = formatTanggalKirim(arr);
            }, 150);
        });
    },

    async _commitEdit(key, field, newVal, cell, mode, customRerender) {
        // Smart Trigger check
        let extraUpdate = {};
        if (field === 'respon') {
            const autoTipe = evalSmartTrigger(newVal);
            if (autoTipe) {
                extraUpdate.tipe_leads = autoTipe;
                // Update in AppState
                const leads = mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
                if (leads[key]) leads[key].tipe_leads = autoTipe;
            }
        }

        // Update local AppState
        const leads = mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        if (leads[key]) {
            leads[key][field] = newVal;
            leads[key].updated_at = new Date().toISOString().split('T')[0];
        }

        // Trigger Confetti if Closing
        if (field === 'tahap' && String(newVal).toUpperCase() === 'CLOSING') {
            if (typeof confetti === 'function') {
                confetti({
                    particleCount: 150,
                    spread: 70,
                    origin: { y: 0.6 },
                    colors: ['#7335B7', '#F3700D', '#25D366']
                });
            }
        }

        // Re-render cell — customRerender dipakai kalau cell perlu TETAP dalam mode
        // editor setelah commit (mis. editor Tanggal Kirim, biar bisa tambah/hapus
        // beberapa tanggal berturut-turut tanpa buka-tutup cell tiap kali).
        const lead = leads[key] || {};
        if (customRerender) {
            customRerender();
        } else if (field === 'tahap') { cell.innerHTML = renderTahapBadge(newVal); }
        else if (field === 'tipe_leads') { cell.innerHTML = renderTipeBadge(newVal); }
        else if (field === 'tanggal_kirim') { cell.innerHTML = formatTanggalKirim(newVal); }
        else {
            let html = escapeHtml(newVal) || '–';
            if (html.length > 25 && (field === 'keterangan' || field === 'nama_agen')) {
                html = `<span data-tooltip="${escapeHtml(newVal)}">${html.substring(0,25)}...</span>`;
            }
            cell.innerHTML = html;
        }

        // If tipe_leads changed via smart trigger → re-render that cell too
        if (extraUpdate.tipe_leads) {
            const tipeCell = document.querySelector(`tr[data-key="${key}"] [data-field="tipe_leads"]`);
            if (tipeCell) tipeCell.innerHTML = renderTipeBadge(extraUpdate.tipe_leads);
            showToast(`Smart Trigger: Tipe Leads → ${extraUpdate.tipe_leads}`, 'info');
        }

        // PATCH ke Firebase
        try {
            const basePath = `master_leads/${mode === 'wa' ? 'whatsapp' : 'email'}/${key}`;
            const patchData = { [field]: newVal, updated_at: new Date().toISOString().split('T')[0], ...extraUpdate };

            if (sessionStorage.getItem('campaign_demo') === 'ok') {
                showToast('Demo Mode: Tersimpan secara lokal ✓', 'success');
                return;
            }

            await FirebaseAPI.patch(basePath, patchData);
            showToast('Tersimpan ✓', 'success');
            // Field ini muncul di filter dropdown — refresh supaya nilai baru langsung
            // kedeteksi tanpa perlu reload manual (dropdown sebelumnya cuma terisi sekali
            // pas load awal, sudah diperbaiki).
            if (['brand', 'area', 'produk', 'pic_garap', 'tahap'].includes(field) && typeof updateFilterOptions === 'function') {
                updateFilterOptions();
            }
        } catch (err) {
            console.error('Patch error:', err);
            showToast('Gagal menyimpan. Cek koneksi.', 'error');
        }
    },

    // ── Bulk Operations ─────────────────────────────────────────
    _syncSelectedFromDOM() {
        this._selectedKeys.clear();
        document.querySelectorAll('.row-cb:checked').forEach(cb => {
            this._selectedKeys.add(cb.dataset.key);
        });
    },

    _updateBulkBar() {
        const bar = document.getElementById('bulk-bar');
        const cnt = document.getElementById('bulk-count');
        if (bar && cnt) {
            const n = this._selectedKeys.size;
            cnt.textContent = n;
            bar.classList.toggle('show', n > 0);
        }
    },

    async bulkUpdate(field, value, mode) {
        if (this._selectedKeys.size === 0) return;
        const keys  = [...this._selectedKeys];
        const leads = mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        const node  = mode === 'wa' ? 'whatsapp' : 'email';

        showToast(`Menerapkan ${field} ke ${keys.length} leads...`, 'info');

        // Batch PATCH per key (Firebase RTDB tidak support multi-path dalam satu request tanpa root)
        const patchData = { [field]: value, updated_at: new Date().toISOString().split('T')[0] };
        let ok = 0, fail = 0;
        const isDemo = sessionStorage.getItem('campaign_demo') === 'ok';
        
        for (const key of keys) {
            try {
                if (!isDemo) await FirebaseAPI.patch(`master_leads/${node}/${key}`, patchData);
                if (leads[key]) { leads[key][field] = value; leads[key].updated_at = patchData.updated_at; }
                ok++;
            } catch { fail++; }
        }

        if (ok > 0) showToast(`✓ ${ok} leads diperbarui.`, 'success');
        if (fail > 0) showToast(`${fail} leads gagal diperbarui.`, 'error');

        this._selectedKeys.clear();
        if (typeof updateFilterOptions === 'function') updateFilterOptions();
        renderLeadsTable();
        if (typeof renderDashboard === 'function') renderDashboard();
    },

    // Tambahkan 1 tanggal ke riwayat tanggal_kirim SEMUA leads yang dicentang —
    // MENAMBAH ke array yang sudah ada, bukan menimpa (beda dari bulkUpdate biasa
    // karena tanggal_kirim adalah array riwayat, bukan nilai tunggal).
    async bulkAppendDate(dateInputValue, mode) {
        if (this._selectedKeys.size === 0 || !dateInputValue) return;
        const d = new Date(dateInputValue);
        const fmt = `${String(d.getDate()).padStart(2, '0')}/${String(d.getMonth() + 1).padStart(2, '0')}/${d.getFullYear()}`;

        const keys  = [...this._selectedKeys];
        const leads = mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        const node  = mode === 'wa' ? 'whatsapp' : 'email';
        const isDemo = sessionStorage.getItem('campaign_demo') === 'ok';
        let ok = 0, fail = 0;

        for (const key of keys) {
            const arr = Array.isArray(leads[key]?.tanggal_kirim) ? [...leads[key].tanggal_kirim] : [];
            if (!arr.includes(fmt)) arr.push(fmt);
            const patchData = { tanggal_kirim: arr, updated_at: new Date().toISOString().split('T')[0] };
            try {
                if (!isDemo) await FirebaseAPI.patch(`master_leads/${node}/${key}`, patchData);
                if (leads[key]) { leads[key].tanggal_kirim = arr; leads[key].updated_at = patchData.updated_at; }
                ok++;
            } catch { fail++; }
        }

        if (ok > 0) showToast(`✓ Tanggal ${fmt} ditambahkan ke ${ok} leads.`, 'success');
        if (fail > 0) showToast(`${fail} leads gagal diperbarui.`, 'error');

        this._selectedKeys.clear();
        renderLeadsTable();
        if (typeof renderDashboard === 'function') renderDashboard();
    },

    // Ganti nilai 1 field untuk SEMUA leads yang field-nya persis = oldValue,
    // tidak bergantung pada centang/halaman aktif (beda dari bulkUpdate di atas
    // yang cuma jalan ke this._selectedKeys). oldValue === '' cocok juga untuk
    // leads yang field-nya kosong/belum pernah diisi (undefined/null/'').
    matchingKeysForRename(field, oldValue, mode) {
        const leads = mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        return Object.keys(leads).filter(k => (leads[k][field] || '') === oldValue);
    },

    async bulkRenameField(field, oldValue, newValue, mode, onProgress) {
        const keys  = this.matchingKeysForRename(field, oldValue, mode);
        if (!keys.length) return { ok: 0, fail: 0, total: 0 };

        const leads = mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        const node  = mode === 'wa' ? 'whatsapp' : 'email';
        const patchData = { [field]: newValue, updated_at: new Date().toISOString().split('T')[0] };
        const isDemo = sessionStorage.getItem('campaign_demo') === 'ok';
        let ok = 0, fail = 0;

        for (let i = 0; i < keys.length; i++) {
            const key = keys[i];
            try {
                if (!isDemo) await FirebaseAPI.patch(`master_leads/${node}/${key}`, patchData);
                if (leads[key]) { leads[key][field] = newValue; leads[key].updated_at = patchData.updated_at; }
                ok++;
            } catch { fail++; }
            // Update tiap iterasi (bukan tiap 20) — tiap PATCH sudah nunggu jaringan
            // (ada jeda alami), jadi progress bar kelihatan bergerak halus terus,
            // bukan macet lama baru "tiba-tiba" selesai.
            if (onProgress) onProgress(i + 1, keys.length);
        }

        if (typeof updateFilterOptions === 'function') updateFilterOptions();
        renderLeadsTable();
        if (typeof renderDashboard === 'function') renderDashboard();
        return { ok, fail, total: keys.length };
    },

    async bulkDelete(mode) {
        const keys  = [...this._selectedKeys];
        const leads = mode === 'wa' ? AppState.leads_wa : AppState.leads_email;
        const node  = mode === 'wa' ? 'whatsapp' : 'email';
        let ok = 0;
        const isDemo = sessionStorage.getItem('campaign_demo') === 'ok';

        for (const key of keys) {
            try {
                if (!isDemo) await FirebaseAPI.delete(`master_leads/${node}/${key}`);
                delete leads[key];
                ok++;
            } catch { /* skip */ }
        }
        showToast(`🗑️ ${ok} leads dihapus.`, 'success');
        this._selectedKeys.clear();
        if (typeof updateFilterOptions === 'function') updateFilterOptions();
        renderLeadsTable();
        if (typeof renderDashboard === 'function') renderDashboard();
        if (typeof updateBadges === 'function') updateBadges();
    },

    // ── Select visible rows ─────────────────────────────────────
    selectAllVisible() {
        document.querySelectorAll('.row-cb').forEach(cb => {
            cb.checked = true;
            this._selectedKeys.add(cb.dataset.key);
        });
        this._updateBulkBar();
    },

    // Pilih SEMUA leads hasil filter saat ini, bukan cuma yang lagi tampil di
    // 1 halaman (PAGE_SIZE=50) — supaya bulk edit/hapus bisa kena leads di
    // halaman lain juga tanpa harus gonta-ganti halaman & centang berulang.
    selectAllFiltered(leads) {
        this._selectedKeys.clear();
        leads.forEach(l => { if (l._key) this._selectedKeys.add(l._key); });
        document.querySelectorAll('.row-cb').forEach(cb => {
            cb.checked = this._selectedKeys.has(cb.dataset.key);
        });
        this._updateBulkBar();
        showToast(`${this._selectedKeys.size} leads dari seluruh hasil filter dipilih.`, 'info');
    },

    deselectAll() {
        this._selectedKeys.clear();
        document.querySelectorAll('.row-cb').forEach(cb => cb.checked = false);
        document.querySelectorAll('#leads-tbody tr').forEach(tr => tr.classList.remove('selected'));
        const selAll = document.getElementById('select-all-cb');
        if (selAll) selAll.checked = false;
        this._updateBulkBar();
    },

    // ── Pagination ───────────────────────────────────────────────
    _renderPagination(total, page, pages) {
        const info = document.getElementById('pagination-info');
        const ctrl = document.getElementById('pagination-controls');
        if (!info || !ctrl) return;

        const start = (page - 1) * this.PAGE_SIZE + 1;
        const end   = Math.min(page * this.PAGE_SIZE, total);
        info.textContent = total > 0 ? `Menampilkan ${start}–${end} dari ${total.toLocaleString('id-ID')}` : '';

        ctrl.innerHTML = '';
        if (pages <= 1) return;

        const mkBtn = (label, p, active = false, disabled = false) => {
            const b = document.createElement('button');
            b.className = `btn btn-sm ${active ? 'btn-primary' : 'btn-ghost'}`;
            b.textContent = label;
            b.disabled = disabled;
            if (!disabled) b.addEventListener('click', () => { this._currentPage = p; this.rerenderCurrentPage(); });
            return b;
        };

        ctrl.appendChild(mkBtn('‹', page - 1, false, page === 1));

        // Max 7 page buttons
        let ps = Math.max(1, page - 3), pe = Math.min(pages, ps + 6);
        ps = Math.max(1, pe - 6);
        for (let i = ps; i <= pe; i++) ctrl.appendChild(mkBtn(String(i), i, i === page));

        ctrl.appendChild(mkBtn('›', page + 1, false, page === pages));
    },

    // ── Spreadsheet Mode: drag/shift-klik pilih rentang sel, Ctrl+C copy TSV ──
    // Klik biasa TETAP masuk mode edit (perilaku lama, lihat _bindEditable/_startEdit) —
    // mousedown TIDAK langsung memulai pilih-rentang; baru dianggap "drag" kalau mouse
    // benar-benar berpindah ke sel lain sambil ditekan. Shift+klik langsung memilih rentang.
    // Kalau memang terjadi drag/shift-klik, klik yang menyertainya ditahan supaya TIDAK
    // ikut membuka mode edit (lihat suppressNextClickEdit, dipakai di _bindEditable).
    _cellSelect: {
        anchorRow: null, anchorCol: null, activeRow: null, activeCol: null,
        mouseDownCell: null, didDrag: false, suppressNextClickEdit: false
    },
    _spreadsheetModeBound: false,

    _initSpreadsheetMode(tbody, mode) {
        tbody.querySelectorAll('td[data-col]').forEach(td => {
            td.addEventListener('mousedown', (e) => {
                if (td.querySelector('input, select')) return; // sedang diedit, biarkan browser handle
                this._cellSelect.mouseDownCell = td;
                this._cellSelect.didDrag = false;
                if (e.shiftKey && this._cellSelect.activeRow !== null) {
                    this._extendRange(td);
                    this._cellSelect.suppressNextClickEdit = true;
                } else {
                    // Klik polos (tanpa shift) di sel manapun langsung membersihkan highlight
                    // rentang sebelumnya (kalau ada) — baru dianggap pilih-rentang baru kalau
                    // ternyata berkembang jadi drag (lihat mouseenter di bawah).
                    this._clearRange();
                }
            });
            td.addEventListener('mouseenter', () => {
                const down = this._cellSelect.mouseDownCell;
                if (down && down !== td) {
                    if (!this._cellSelect.didDrag) {
                        this._startRange(down); // tetapkan sel awal sebagai anchor
                        this._cellSelect.didDrag = true;
                        this._cellSelect.suppressNextClickEdit = true;
                    }
                    this._extendRange(td);
                }
            });
        });

        if (!this._spreadsheetModeBound) {
            this._spreadsheetModeBound = true;
            document.addEventListener('mouseup', () => { this._cellSelect.mouseDownCell = null; });
            // Klik di luar tabel leads (filter, sidebar, dst) juga membersihkan highlight rentang.
            document.addEventListener('mousedown', (e) => {
                if (!e.target.closest('#leads-table')) this._clearRange();
            });
            document.addEventListener('keydown', (e) => {
                const tag = (document.activeElement && document.activeElement.tagName) || '';
                if (tag === 'INPUT' || tag === 'SELECT' || tag === 'TEXTAREA') return; // jangan ganggu filter/edit
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'c') {
                    if (this._cellSelect.anchorRow !== null) { this.copySelectedRange(); e.preventDefault(); }
                    return;
                }
                if (this._cellSelect.activeRow === null) return;
                const arrowMap = { ArrowUp: [-1,0], ArrowDown: [1,0], ArrowLeft: [0,-1], ArrowRight: [0,1] };
                if (!arrowMap[e.key]) return;
                e.preventDefault();
                const [dr, dc] = arrowMap[e.key];
                const nextRow = this._cellSelect.activeRow + dr;
                const nextCol = Math.max(0, Math.min(17, this._cellSelect.activeCol + dc));
                const targetTd = document.querySelector(`td[data-row="${nextRow}"][data-col="${nextCol}"]`);
                if (!targetTd) return;
                if (e.shiftKey) { this._extendRange(targetTd); } else { this._startRange(targetTd); }
            });
        }
    },

    _clearRange() {
        this._cellSelect.anchorRow = null; this._cellSelect.anchorCol = null;
        this._cellSelect.activeRow = null; this._cellSelect.activeCol = null;
        const tbody = document.getElementById('leads-tbody');
        tbody?.querySelectorAll('td.cell-selected').forEach(td => td.classList.remove('cell-selected'));
    },
    _startRange(td) {
        const row = Number(td.dataset.row), col = Number(td.dataset.col);
        this._cellSelect.anchorRow = row; this._cellSelect.anchorCol = col;
        this._cellSelect.activeRow = row; this._cellSelect.activeCol = col;
        this._paintRange();
    },
    _extendRange(td) {
        this._cellSelect.activeRow = Number(td.dataset.row);
        this._cellSelect.activeCol = Number(td.dataset.col);
        this._paintRange();
    },
    _paintRange() {
        const tbody = document.getElementById('leads-tbody');
        if (!tbody) return;
        const { anchorRow, anchorCol, activeRow, activeCol } = this._cellSelect;
        const r0 = Math.min(anchorRow, activeRow), r1 = Math.max(anchorRow, activeRow);
        const c0 = Math.min(anchorCol, activeCol), c1 = Math.max(anchorCol, activeCol);
        tbody.querySelectorAll('td[data-col]').forEach(td => {
            const r = Number(td.dataset.row), c = Number(td.dataset.col);
            td.classList.toggle('cell-selected', r >= r0 && r <= r1 && c >= c0 && c <= c1);
        });
    },
    copySelectedRange() {
        const tbody = document.getElementById('leads-tbody');
        if (!tbody || this._cellSelect.anchorRow === null) {
            showToast('Klik sebuah sel dulu (lalu drag atau Shift+klik untuk pilih rentang) sebelum copy.', 'error');
            return;
        }
        const { anchorRow, anchorCol, activeRow, activeCol } = this._cellSelect;
        const r0 = Math.min(anchorRow, activeRow), r1 = Math.max(anchorRow, activeRow);
        const c0 = Math.min(anchorCol, activeCol), c1 = Math.max(anchorCol, activeCol);
        const lines = [];
        for (let r = r0; r <= r1; r++) {
            const cols = [];
            for (let c = c0; c <= c1; c++) {
                const td = tbody.querySelector(`td[data-row="${r}"][data-col="${c}"]`);
                cols.push(td ? td.innerText.trim().replace(/\s+/g, ' ') : '');
            }
            lines.push(cols.join('\t'));
        }
        copyTextRobust(lines.join('\n'))
            .then(() => showToast('Rentang sel disalin — siap paste ke Excel/Sheets.', 'success'))
            .catch(() => showToast('Gagal menyalin. Browser mungkin memblokir clipboard di koneksi non-HTTPS ini.', 'error'));
    },

    // ── Copy kontak / baris untuk kebutuhan BCC ─────────────────
    getContactValue(lead, mode) {
        return mode === 'wa'
            ? (lead.phone || lead.contact_display || '')
            : (lead.email || lead.contact_display || LeadsCleaner.reverseEmailKey(lead._key) || '');
    },
    copyContacts(leads, mode, label) {
        if (!leads.length) { showToast('Tidak ada kontak untuk disalin.', 'error'); return; }
        const contacts = leads.map(l => this.getContactValue(l, mode)).filter(Boolean);
        if (!contacts.length) { showToast('Tidak ada kontak yang valid untuk disalin.', 'error'); return; }
        copyTextRobust(contacts.join('; '))
            .then(() => showToast(`${contacts.length} kontak${label ? ' (' + label + ')' : ''} disalin — siap paste ke BCC.`, 'success'))
            .catch(() => showToast('Gagal menyalin. Browser mungkin memblokir clipboard di koneksi non-HTTPS ini.', 'error'));
    },
    copyFullRow(lead, mode) {
        const contact = this.getContactValue(lead, mode);
        const tgl = Array.isArray(lead.tanggal_kirim) ? lead.tanggal_kirim.join(' | ') : (lead.tanggal_kirim || '');
        const cols = [lead.brand, lead.produk, lead.nama_agen, contact, lead.provinsi, lead.area, lead.pic_campaign, lead.pic_garap,
                      lead.tahap, tgl, lead.respon, lead.aksi_lanjutan, lead.tipe_leads, lead.keterangan, lead.updated_at];
        copyTextRobust(cols.map(v => v || '').join('\t'))
            .then(() => showToast('Baris disalin — siap paste 1 baris utuh ke Excel/Sheets.', 'success'))
            .catch(() => showToast('Gagal menyalin. Browser mungkin memblokir clipboard di koneksi non-HTTPS ini.', 'error'));
    },

    // ── Export CSV ──────────────────────────────────────────────
    exportCSV(leads, mode) {
        if (leads.length === 0) { showToast('Tidak ada data untuk diexport.', 'error'); return; }
        const headers = ['No', 'Brand', 'Produk', 'Nama Agen', mode === 'wa' ? 'Nomor WA' : 'Email',
                         mode === 'wa' ? 'Email (Tambahan)' : 'Nomor WA (Tambahan)',
                         'Nomor WA CS Dipakai', 'Kontak Aktif',
                         'Area Utama', 'Sub Area', 'Alamat', 'PIC Campaign', 'PIC Garap', 'Tahap', 'Tgl Kirim',
                         'Respon', 'Aksi Lanjutan', 'Tipe Leads', 'Keterangan', 'Updated At'];
        const rows = leads.map((l, i) => {
            const contact = mode === 'wa' ? (l.phone || l.contact_display || '') : (l.email || LeadsCleaner.reverseEmailKey(l._key) || '');
            const contact2 = mode === 'wa' ? (l.email || '') : (l.phone || '');
            const kontakAktif = Array.isArray(l.kontak_aktif)
                ? l.kontak_aktif.map(c => c === 'wa' ? 'WA' : 'Email').join(', ')
                : '';
            const tgl = Array.isArray(l.tanggal_kirim) ? l.tanggal_kirim.join(' | ') : (l.tanggal_kirim || '');
            return [i + 1, l.brand, l.produk, l.nama_agen, contact, contact2, l.nomor_wa_terpakai, kontakAktif,
                    l.provinsi, l.area, l.alamat, l.pic_campaign, l.pic_garap,
                    l.tahap, tgl, l.respon, l.aksi_lanjutan, l.tipe_leads, l.keterangan, l.updated_at]
                   .map(v => `"${String(v || '').replace(/"/g, '""')}"`).join(',');
        });
        const csv  = [headers.join(','), ...rows].join('\n');
        const blob = new Blob(['\uFEFF' + csv], { type: 'text/csv;charset=utf-8;' }); // BOM for Excel
        const url  = URL.createObjectURL(blob);
        const a    = document.createElement('a'); a.href = url;
        a.download = `simasrim_campaign_${mode}_${new Date().toISOString().split('T')[0]}.csv`;
        a.click(); URL.revokeObjectURL(url);
        showToast('CSV berhasil didownload!', 'success');
    }
};
