/**
 * leadgen.js — Campaign SIMASRIM
 * Tab "Cari Leads Baru":
 *  - Fase A: trigger scraping cepat (list-only) via scrape_trigger.php, polling progress
 *    DAN hasil live selama proses jalan (node scrape_jobs/<id> & scrape_staging/<id>),
 *    baris-baris muncul satu-satu di tabel review begitu ditemukan.
 *  - Tabel review adalah GABUNGAN semua pencarian yang belum diimpor/dibuang — mulai
 *    pencarian baru TIDAK menghapus hasil pencarian sebelumnya yang belum diproses, dan
 *    kalau tab ini dibuka ulang (reload/kunjungan baru), leads lama yang masih menunggu
 *    tetap dimuat dari database.
 *  - Fase B (opsional): tombol "Cek Nomor" per baris atau "Verifikasi yang Dicentang" untuk
 *    baris yang belum ada nomor telepon, lewat verify_phone.php. Klik berkali-kali (per baris
 *    maupun borongan) semuanya masuk 1 ANTREAN client-side dan diproses bergiliran otomatis
 *    (maks 15 lokasi per kiriman ke server) — tidak perlu nunggu manual/dapat error "coba lagi".
 *
 * Setiap baris diidentifikasi dengan kunci gabungan "<jobId>::<placeKey>" supaya baris dari
 * pencarian berbeda-beda bisa hidup berdampingan di tabel yang sama.
 */

let leadgenPollTimer = null;
let leadgenCurrentJobId = null;
let leadgenCurrentVerifyJobId = null;
let leadgenStagingData = {};   // compositeKey ("<jobId>::<placeKey>") -> {..., _job_id, _place_key}
let leadgenRenderedKeys = new Set();

// ── Antrean Fase B (verifikasi nomor) ───────────────────────────────────
let leadgenVerifyQueue = [];   // [{compositeKey, jobId, placeKey, link}]
let leadgenVerifyActive = false;

function compositeKey(jobId, placeKey) { return `${jobId}::${placeKey}`; }

function initLeadgen() {
    const startBtn = document.getElementById('leadgen-start-btn');
    if (!startBtn) return;

    // Muat leads yang belum diimpor dari sesi/pencarian sebelumnya begitu tab dibuka
    loadAllPendingLeadgenStaging();

    startBtn.addEventListener('click', async () => {
        const keyword = document.getElementById('leadgen-keyword').value.trim();
        const kota = document.getElementById('leadgen-kota').value.trim();
        const brandInput = document.getElementById('leadgen-brand').value.trim();
        const brand = brandInput || keyword; // default: ikut kata kunci kalau dikosongkan
        const provinsiInput = document.getElementById('leadgen-provinsi').value.trim();
        const provinsi = provinsiInput || LeadsFilter.lookupProvince(kota) || '';

        if (keyword.length < 2 || kota.length < 2) {
            showToast('Isi Kata Kunci dan Kota dulu (minimal 2 karakter).', 'error');
            return;
        }

        startBtn.disabled = true;
        startBtn.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Memulai...`;
        document.getElementById('leadgen-info-box').style.display = 'none';

        try {
            const res = await fetch('api/scrape_trigger.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ keyword, kota, brand, provinsi })
            });
            const data = await res.json();
            if (!res.ok) {
                showToast(data.error || 'Gagal memulai pencarian.', 'error');
                startBtn.disabled = false;
                startBtn.innerHTML = `<i class='bx bx-search-alt'></i> Mulai Cari Leads`;
                return;
            }

            leadgenCurrentJobId = data.job_id;
            document.getElementById('leadgen-progress-wrap').style.display = 'block';
            document.getElementById('leadgen-progress-msg').textContent = `Mencari "${keyword} ${kota}"...`;
            document.getElementById('leadgen-progress-pct').textContent = '';
            document.getElementById('leadgen-progress-fill').style.width = '8%';
            setLeadgenCancelVisible(true);

            // Tabel review tetap tampil (kalau sudah ada isi dari sebelumnya, TIDAK dikosongkan)
            document.getElementById('leadgen-review-toolbar').style.display = 'flex';
            document.getElementById('leadgen-table-wrap').style.display = 'block';

            pollLeadgenJob(leadgenCurrentJobId, startBtn);
        } catch (err) {
            console.error(err);
            showToast('Gagal menghubungi server untuk memulai pencarian.', 'error');
            startBtn.disabled = false;
            startBtn.innerHTML = `<i class='bx bx-search-alt'></i> Mulai Cari Leads`;
        }
    });

    // Kata Kunci mengisi placeholder Brand secara live (bukan menimpa isian manual user)
    document.getElementById('leadgen-keyword')?.addEventListener('input', (e) => {
        const brandField = document.getElementById('leadgen-brand');
        if (brandField) brandField.placeholder = e.target.value ? `Otomatis: "${e.target.value}"` : 'Otomatis ikut Kata Kunci, bisa diedit';
    });

    // Kota mengisi placeholder Area Utama (Provinsi) secara live via lookup — kalau
    // dikenali (bukan menimpa isian manual user, cuma placeholder-nya)
    document.getElementById('leadgen-kota')?.addEventListener('input', (e) => {
        const provinsiField = document.getElementById('leadgen-provinsi');
        if (!provinsiField) return;
        const guess = LeadsFilter.lookupProvince(e.target.value.trim());
        provinsiField.placeholder = guess ? `Otomatis: "${guess}"` : 'Otomatis dari Kota, bisa diedit';
    });

    document.getElementById('leadgen-select-all-chk')?.addEventListener('change', (e) => {
        document.querySelectorAll('#leadgen-tbody .leadgen-row-chk').forEach(cb => { cb.checked = e.target.checked; });
    });
    document.getElementById('leadgen-select-all-btn')?.addEventListener('click', () => {
        const chk = document.getElementById('leadgen-select-all-chk');
        chk.checked = true;
        document.querySelectorAll('#leadgen-tbody .leadgen-row-chk').forEach(cb => { cb.checked = true; });
    });

    document.getElementById('leadgen-import-btn')?.addEventListener('click', importLeadgenSelected);
    document.getElementById('leadgen-discard-btn')?.addEventListener('click', discardLeadgenSelected);
    document.getElementById('leadgen-verify-selected-btn')?.addEventListener('click', verifySelectedLeadgen);
    document.getElementById('leadgen-cancel-btn')?.addEventListener('click', () => cancelLeadgenJob(startBtn));
    document.getElementById('leadgen-cancel-btn-toolbar')?.addEventListener('click', () => cancelLeadgenJob(startBtn));

    // Delegasi klik tombol "Cek Nomor" per baris (baris dibuat dinamis)
    document.getElementById('leadgen-tbody')?.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-action="verify-one"]');
        if (btn) enqueueLeadgenVerify([{ compositeKey: btn.dataset.key }]);
    });
}

// ── Muat semua leads pending (belum diimpor/dibuang) dari SELURUH pencarian ─
async function loadAllPendingLeadgenStaging() {
    try {
        const allStaging = await FirebaseAPI.get('scrape_staging');
        if (!allStaging) return;

        const tbody = document.getElementById('leadgen-tbody');
        let addedCount = 0;
        Object.keys(allStaging).forEach(jobId => {
            const entries = allStaging[jobId] || {};
            Object.keys(entries).forEach(placeKey => {
                const ck = compositeKey(jobId, placeKey);
                if (leadgenRenderedKeys.has(ck)) return;
                const d = { ...entries[placeKey], _job_id: jobId, _place_key: placeKey };
                leadgenStagingData[ck] = d;
                leadgenRenderedKeys.add(ck);
                tbody.insertAdjacentHTML('beforeend', buildLeadgenRowHtml(ck, d));
                addedCount++;
            });
        });

        if (addedCount > 0) {
            document.getElementById('leadgen-review-toolbar').style.display = 'flex';
            document.getElementById('leadgen-table-wrap').style.display = 'block';
            document.getElementById('leadgen-info-box').style.display = 'flex';
            updateLeadgenReviewCount();
        }
    } catch (err) {
        console.error('Gagal memuat leads pending:', err);
    }
}

function updateLeadgenReviewCount() {
    document.getElementById('leadgen-review-count').textContent = `${leadgenRenderedKeys.size} leads menunggu diproses`;
}

// Kedua tombol "Batalkan Pencarian" (dekat progress bar & di toolbar review) selalu
// disinkronkan bareng — tampil/sembunyi sama-sama, karena keduanya membatalkan proses
// aktif yang sama (cuma 1 proses Puppeteer yang mungkin jalan lewat scrape_lock).
function setLeadgenCancelVisible(show) {
    const wrap = document.getElementById('leadgen-progress-wrap');
    [document.getElementById('leadgen-cancel-btn'), document.getElementById('leadgen-cancel-btn-toolbar')].forEach(btn => {
        if (btn) btn.style.display = show ? '' : 'none';
    });
    if (wrap) wrap.style.display = show ? 'block' : 'none';
    if (!show) {
        // Reset teks progress supaya tidak "nyangkut" nampilin pesan lama kalau nanti
        // wrap ditampilkan lagi untuk proses baru.
        const msg = document.getElementById('leadgen-progress-msg');
        const pct = document.getElementById('leadgen-progress-pct');
        const fill = document.getElementById('leadgen-progress-fill');
        if (msg) msg.textContent = 'Menyiapkan...';
        if (pct) pct.textContent = '';
        if (fill) fill.style.width = '0%';
    }
}

// Membatalkan proses milik tab/sesi ini SAJA (Fase A "collect" atau Fase B "verify" —
// mana yang lagi aktif di tab ini) via cancel_job.php, dikirim dengan job_id spesifik
// supaya tidak sampai membatalkan proses milik user lain yang kebetulan jalan bareng
// (sejak scrape_locks jadi multi-slot). Lalu bersihkan antrean Fase B lokal juga supaya
// baris yang masih menunggu giliran tidak macet di status "Menunggu antrean...".
async function cancelLeadgenJob(startBtn) {
    const btns = [document.getElementById('leadgen-cancel-btn'), document.getElementById('leadgen-cancel-btn-toolbar')];
    btns.forEach(btn => { if (btn) { btn.disabled = true; btn.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Membatalkan...`; } });

    const jobId = leadgenCurrentVerifyJobId || leadgenCurrentJobId;

    try {
        const res = await fetch('api/cancel_job.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ job_id: jobId })
        });
        const data = await res.json();
        if (!res.ok) throw new Error(data.error || 'Gagal membatalkan.');

        clearInterval(leadgenPollTimer);
        if (startBtn) {
            startBtn.disabled = false;
            startBtn.innerHTML = `<i class='bx bx-search-alt'></i> Mulai Cari Leads`;
        }

        // Kosongkan antrean Fase B lokal & render ulang baris yang tadinya menunggu/diproses
        // balik ke tombol "Cek Nomor" biasa (tidak macet di status loading).
        const queuedKeys = leadgenVerifyQueue.map(q => q.compositeKey);
        leadgenVerifyQueue = [];
        leadgenVerifyActive = false;
        updateLeadgenQueueStatus();
        queuedKeys.forEach(ck => {
            const d = leadgenStagingData[ck];
            const tr = document.querySelector(`#leadgen-tbody tr[data-key="${ck}"]`);
            if (tr && d) tr.outerHTML = buildLeadgenRowHtml(ck, d, tr.querySelector('.leadgen-row-chk')?.checked ?? true);
        });

        setLeadgenCancelVisible(false); // ini juga yang mereset teks "Memverifikasi..."/dll biar tidak nyangkut
        showToast('Pencarian/verifikasi dibatalkan.', 'success');
    } catch (err) {
        console.error(err);
        showToast('Gagal membatalkan proses. Cek koneksi.', 'error');
    } finally {
        btns.forEach(btn => { if (btn) { btn.disabled = false; btn.innerHTML = `<i class='bx bx-x-circle'></i> Batalkan Pencarian`; } });
    }
}

// ── Fase A: polling status job + hasil live ─────────────────────────────
function pollLeadgenJob(jobId, startBtn) {
    clearInterval(leadgenPollTimer);
    leadgenPollTimer = setInterval(async () => {
        try {
            const [job, staging] = await Promise.all([
                FirebaseAPI.get(`scrape_jobs/${jobId}`),
                FirebaseAPI.get(`scrape_staging/${jobId}`)
            ]);

            if (staging) renderLeadgenLive(jobId, staging);

            if (!job) return;

            const pct = job.target ? Math.min(100, Math.round(((job.found || 0) / job.target) * 100)) : null;
            document.getElementById('leadgen-progress-msg').textContent = job.message || '...';
            document.getElementById('leadgen-progress-pct').textContent = pct === null ? '' : pct + '%';
            document.getElementById('leadgen-progress-fill').style.width = (pct === null ? 15 : pct) + '%';
            updateLeadgenReviewCount();

            if (job.status === 'done') {
                clearInterval(leadgenPollTimer);
                leadgenCurrentJobId = null;
                startBtn.disabled = false;
                startBtn.innerHTML = `<i class='bx bx-search-alt'></i> Mulai Cari Leads`;
                document.getElementById('leadgen-progress-fill').style.width = '100%';
                setLeadgenCancelVisible(false);
                showToast(job.message || 'Pencarian selesai!', 'success');
                if (leadgenRenderedKeys.size > 0) document.getElementById('leadgen-info-box').style.display = 'flex';
            } else if (job.status === 'error' || job.status === 'cancelled') {
                clearInterval(leadgenPollTimer);
                leadgenCurrentJobId = null;
                startBtn.disabled = false;
                startBtn.innerHTML = `<i class='bx bx-search-alt'></i> Mulai Cari Leads`;
                setLeadgenCancelVisible(false);
                showToast(job.message || 'Pencarian gagal.', 'error');
            }
        } catch (err) {
            console.error('Polling error:', err);
        }
    }, 2000);
}

function renderLeadgenLive(jobId, staging) {
    const tbody = document.getElementById('leadgen-tbody');
    Object.keys(staging).forEach(placeKey => {
        const ck = compositeKey(jobId, placeKey);
        if (leadgenRenderedKeys.has(ck)) return; // sudah ada di tabel, jangan dobel
        const d = { ...staging[placeKey], _job_id: jobId, _place_key: placeKey };
        leadgenStagingData[ck] = d;
        leadgenRenderedKeys.add(ck);
        tbody.insertAdjacentHTML('beforeend', buildLeadgenRowHtml(ck, d));
    });
}

function buildLeadgenRowHtml(ck, d, checked = true) {
    const hasPhone = !!d.phone;
    const isQueued = leadgenVerifyQueue.some(q => q.compositeKey === ck);
    let phoneCell;
    if (hasPhone) {
        phoneCell = `<input type="text" class="form-input leadgen-phone-input" value="${escapeLeadgenHtml(d.phone)}" style="font-family:monospace;font-size:0.8rem;min-width:130px;">`;
    } else if (d.verify_checked) {
        phoneCell = `<span style="color:var(--text-muted);font-size:0.76rem;">Tidak ditemukan</span>`;
    } else if (isQueued) {
        phoneCell = `<button type="button" class="btn btn-ghost btn-sm" disabled data-action="verify-one" data-key="${ck}"><i class='bx bx-time-five'></i> Menunggu antrean...</button>`;
    } else {
        phoneCell = `<button type="button" class="btn btn-ghost btn-sm" data-action="verify-one" data-key="${ck}" title="Cek nomor lokasi ini (masuk antrean otomatis)"><i class='bx bx-phone-call'></i> Cek Nomor</button>`;
    }

    return `<tr data-key="${ck}">
        <td class="col-check"><input type="checkbox" class="leadgen-row-chk" ${checked ? 'checked' : ''}></td>
        <td>${escapeLeadgenHtml(d.nama_agen || '-')}</td>
        <td>${phoneCell}</td>
        <td style="max-width:220px;font-size:0.78rem;color:var(--text-muted);">${escapeLeadgenHtml(d.alamat || d.kategori || '-') || '-'}</td>
        <td>${escapeLeadgenHtml(d.provinsi || '-')}</td>
        <td>${escapeLeadgenHtml(d.area || '-')}</td>
    </tr>`;
}

function escapeLeadgenHtml(s) {
    return String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
}

// ── Fase B: antrean verifikasi nomor (per-baris / borongan, diproses otomatis) ──
async function triggerLeadgenVerify(items) {
    const res = await fetch('api/verify_phone.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ items })
    });
    const data = await res.json();
    if (!res.ok) throw new Error(data.error || 'Gagal memulai verifikasi.');
    return data.verify_job_id;
}

function pollLeadgenVerify(verifyJobId, batch, onDone) {
    const timer = setInterval(async () => {
        try {
            const job = await FirebaseAPI.get(`scrape_jobs/${verifyJobId}`);
            if (!job) return;
            if (job.status === 'done' || job.status === 'error' || job.status === 'cancelled') {
                clearInterval(timer);
                if (job.status === 'error' || job.status === 'cancelled') {
                    if (job.status === 'error') showToast(job.message || 'Verifikasi gagal.', 'error');
                    onDone();
                    return;
                }

                // Ambil ulang tiap entry yang barusan diverifikasi (dari job aslinya masing-masing)
                const byJob = {};
                batch.forEach(it => { (byJob[it.jobId] = byJob[it.jobId] || []).push(it); });
                for (const jobId of Object.keys(byJob)) {
                    const fresh = await FirebaseAPI.get(`scrape_staging/${jobId}`) || {};
                    byJob[jobId].forEach(it => {
                        if (fresh[it.placeKey]) {
                            const d = { ...fresh[it.placeKey], _job_id: jobId, _place_key: it.placeKey };
                            leadgenStagingData[it.compositeKey] = d;
                            const tr = document.querySelector(`#leadgen-tbody tr[data-key="${it.compositeKey}"]`);
                            if (tr) tr.outerHTML = buildLeadgenRowHtml(it.compositeKey, d, tr.querySelector('.leadgen-row-chk')?.checked ?? true);
                        }
                    });
                }
                showToast(job.message || 'Verifikasi selesai.', 'success');
                onDone();
            }
        } catch (err) {
            console.error('Verify polling error:', err);
        }
    }, 2000);
}

function updateLeadgenQueueStatus() {
    const btn = document.getElementById('leadgen-verify-selected-btn');
    if (!btn) return;
    if (leadgenVerifyQueue.length > 0 || leadgenVerifyActive) {
        btn.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Memverifikasi... (${leadgenVerifyQueue.length} dalam antrean)`;
    } else {
        btn.innerHTML = `<i class='bx bx-phone-call'></i> Verifikasi Nomor yang Dicentang`;
    }
}

function enqueueLeadgenVerify(newItems) {
    newItems.forEach(({ compositeKey: ck }) => {
        if (leadgenVerifyQueue.some(q => q.compositeKey === ck)) return; // sudah antre
        const d = leadgenStagingData[ck];
        if (!d || !d.place_link) return;
        leadgenVerifyQueue.push({ compositeKey: ck, jobId: d._job_id, placeKey: d._place_key, link: d.place_link });
        const tr = document.querySelector(`#leadgen-tbody tr[data-key="${ck}"]`);
        if (tr) tr.outerHTML = buildLeadgenRowHtml(ck, d, tr.querySelector('.leadgen-row-chk')?.checked ?? true); // render ulang jadi status "Menunggu antrean..."
    });
    updateLeadgenQueueStatus();
    processLeadgenVerifyQueue();
}

async function processLeadgenVerifyQueue() {
    if (leadgenVerifyActive || !leadgenVerifyQueue.length) return;
    leadgenVerifyActive = true;
    document.getElementById('leadgen-progress-msg').textContent = 'Memverifikasi nomor telepon...';
    document.getElementById('leadgen-progress-pct').textContent = '';
    setLeadgenCancelVisible(true);

    while (leadgenVerifyQueue.length) {
        const batch = leadgenVerifyQueue.slice(0, 15);
        updateLeadgenQueueStatus();
        // Tandai baris di batch ini "Mengecek..." (bukan cuma menunggu)
        batch.forEach(it => {
            const btn = document.querySelector(`#leadgen-tbody tr[data-key="${it.compositeKey}"] [data-action="verify-one"]`);
            if (btn) btn.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Mengecek...`;
        });

        try {
            const verifyJobId = await triggerLeadgenVerify(batch.map(b => ({ jobId: b.jobId, placeKey: b.placeKey, link: b.link })));
            leadgenCurrentVerifyJobId = verifyJobId;
            await new Promise(resolve => pollLeadgenVerify(verifyJobId, batch, resolve));
            leadgenCurrentVerifyJobId = null;
            leadgenVerifyQueue.splice(0, batch.length);
        } catch (err) {
            // Kemungkinan besar lock lagi dipakai proses lain (mis. Fase A sedang jalan) —
            // jangan buang antreannya, tunggu sebentar lalu coba batch yang sama lagi.
            console.warn('Verify batch tertunda:', err.message);
            await new Promise(r => setTimeout(r, 5000));
        }
        updateLeadgenQueueStatus();
    }

    leadgenVerifyActive = false;
    updateLeadgenQueueStatus();
    setLeadgenCancelVisible(false); // antrean habis (baik selesai normal maupun dibatalkan) — jangan biarkan progress bar "nyangkut"
}

async function verifySelectedLeadgen() {
    const checkedRows = [...document.querySelectorAll('#leadgen-tbody tr')].filter(tr => tr.querySelector('.leadgen-row-chk').checked);
    if (!checkedRows.length) { showToast('Centang baris yang mau diverifikasi dulu.', 'error'); return; }

    const eligible = [];
    let skippedHasPhone = 0;
    checkedRows.forEach(tr => {
        const ck = tr.dataset.key;
        const d = leadgenStagingData[ck];
        if (!d) return;
        if (d.phone) { skippedHasPhone++; return; }
        eligible.push({ compositeKey: ck });
    });

    if (!eligible.length) {
        showToast('Semua baris yang dicentang sudah punya nomor telepon — tidak ada yang perlu diverifikasi.', 'info');
        return;
    }

    enqueueLeadgenVerify(eligible);
    showToast(
        `${eligible.length} lokasi masuk antrean verifikasi` +
        (skippedHasPhone ? ` (${skippedHasPhone} dilewati karena sudah ada nomornya)` : '') +
        '.',
        'info'
    );
}

// ── Import / Buang ───────────────────────────────────────────────────────
async function importLeadgenSelected() {
    const rows = [...document.querySelectorAll('#leadgen-tbody tr')].filter(tr => tr.querySelector('.leadgen-row-chk').checked);
    if (!rows.length) { showToast('Centang minimal 1 leads untuk diimpor.', 'error'); return; }

    const importMap = {};
    const removeByJob = {}; // jobId -> { placeKey: null, ... }
    const today = new Date().toISOString().split('T')[0];
    let skippedNoPhone = 0, skippedInvalidPhone = 0, skippedExisting = 0;
    // Leads yang SUDAH ada di Master Leads (WA tree) — dipakai supaya import scraping
    // tidak menimpa lead yang sama (riwayat tahap/respon/PIC/kontak kedua bisa ke-reset
    // ke kosong kalau ditimpa mentah-mentah). Skip kalau sudah ada, sama seperti
    // perilaku dedupe default di wizard Upload & Cleansing.
    const existingWaLeads = (typeof AppState !== 'undefined' && AppState.leads_wa) ? AppState.leads_wa : {};

    rows.forEach(tr => {
        const ck = tr.dataset.key;
        const d = leadgenStagingData[ck];
        const phoneInput = tr.querySelector('.leadgen-phone-input');
        const editedPhoneRaw = phoneInput ? phoneInput.value.trim() : '';
        if (!d) return;
        if (!editedPhoneRaw) { skippedNoPhone++; return; }

        // Normalisasi ke format 628... — sama seperti semua jalur tambah-lead lain
        // (manual, upload, migrasi), supaya key-nya konsisten dan tidak dobel-tercatat
        // dengan format beda (0812... vs 628123...) untuk nomor yang sama.
        const editedPhone = (typeof LeadsCleaner !== 'undefined' && LeadsCleaner.normalizePhone)
            ? LeadsCleaner.normalizePhone(editedPhoneRaw)
            : editedPhoneRaw;
        if (!editedPhone) { skippedInvalidPhone++; return; }

        if (existingWaLeads[editedPhone]) {
            skippedExisting++;
            // Tetap tandai buang dari staging (sudah "diproses" — datanya sudah ada di
            // Master Leads, cuma tidak ditimpa), supaya baris ini tidak nyangkut terus
            // di tabel review.
            (removeByJob[d._job_id] = removeByJob[d._job_id] || {})[d._place_key] = null;
            return;
        }

        importMap[editedPhone] = {
            _key: editedPhone,
            phone: editedPhone,
            nama_agen: d.nama_agen || '',
            brand: d.brand || '',
            produk: '',
            provinsi: d.provinsi || '',
            area: d.area || '',
            pic_campaign: '',
            pic_garap: '',
            tahap: '',
            tanggal_kirim: [],
            respon: '',
            aksi_lanjutan: '',
            tipe_leads: 'New',
            keterangan: (d.alamat ? d.alamat + ' — ' : '') + 'Sumber: Scraping Otomatis ' + (d.sumber === 'kdkmp.bogorkab.go.id' ? 'KDKMP Bogor' : 'Google Maps'),
            created_at: today,
            updated_at: today
        };
        (removeByJob[d._job_id] = removeByJob[d._job_id] || {})[d._place_key] = null;
    });

    if (skippedExisting > 0) {
        showToast(`${skippedExisting} leads dilewati karena nomornya sudah ada di Master Leads (data lama tidak ditimpa).`, 'info');
    }

    if (!Object.keys(importMap).length) {
        if (!skippedExisting) {
            showToast('Tidak ada baris dengan nomor telepon valid untuk diimpor — cek nomornya dulu.', 'error');
        }
        // Kalau semuanya cuma dilewati krn sudah ada (skippedExisting>0), baris review
        // tetap perlu dibersihkan (removeByJob sudah terisi) — lanjut ke proses commit
        // di bawah kalau ada removeByJob, kalau kosong juga baru berhenti di sini.
        if (!Object.keys(removeByJob).length) return;
    }

    try {
        if (Object.keys(importMap).length) {
            await FirebaseAPI.batchUpsert('master_leads/whatsapp', importMap);
        }
        await Promise.all(Object.keys(removeByJob).map(jobId => FirebaseAPI.patch(`scrape_staging/${jobId}`, removeByJob[jobId])));
        const skipNotes = [];
        if (skippedNoPhone) skipNotes.push(`${skippedNoPhone} dilewati karena belum ada nomor`);
        if (skippedInvalidPhone) skipNotes.push(`${skippedInvalidPhone} dilewati karena format nomor tidak valid`);
        if (Object.keys(importMap).length) {
            showToast(`${Object.keys(importMap).length} leads berhasil diimpor ke Master Leads!` + (skipNotes.length ? ` (${skipNotes.join(', ')})` : ''), 'success');
        }

        // Hapus semua baris yang berhasil diimpor (ada di removeByJob) dari tabel
        rows.forEach(tr => {
            const ck = tr.dataset.key;
            const d = leadgenStagingData[ck];
            if (d && removeByJob[d._job_id] && d._place_key in removeByJob[d._job_id]) {
                tr.remove();
                leadgenRenderedKeys.delete(ck);
                delete leadgenStagingData[ck];
            }
        });
        updateLeadgenReviewCount();
        if (!leadgenRenderedKeys.size) {
            document.getElementById('leadgen-review-toolbar').style.display = 'none';
            document.getElementById('leadgen-table-wrap').style.display = 'none';
            document.getElementById('leadgen-info-box').style.display = 'none';
        }

        if (typeof loadAllData === 'function') loadAllData();
    } catch (err) {
        console.error(err);
        showToast('Gagal mengimpor ke Master Leads. Cek koneksi.', 'error');
    }
}

async function discardLeadgenSelected() {
    const rows = [...document.querySelectorAll('#leadgen-tbody tr')].filter(tr => tr.querySelector('.leadgen-row-chk').checked);
    if (!rows.length) { showToast('Centang minimal 1 baris untuk dibuang.', 'error'); return; }
    if (!confirm(`Buang ${rows.length} leads ini dari daftar review? (tidak akan masuk Master Leads)`)) return;

    const removeByJob = {};
    rows.forEach(tr => {
        const d = leadgenStagingData[tr.dataset.key];
        if (d) (removeByJob[d._job_id] = removeByJob[d._job_id] || {})[d._place_key] = null;
    });

    try {
        await Promise.all(Object.keys(removeByJob).map(jobId => FirebaseAPI.patch(`scrape_staging/${jobId}`, removeByJob[jobId])));

        // Baris yang dibuang tapi kebetulan masih menunggu/lagi diproses di antrean Fase B
        // ikut dibatalkan slotnya juga, supaya tidak mubazir diproses server untuk data
        // yang sudah tidak ada.
        const discardedKeys = new Set(rows.map(tr => tr.dataset.key));
        leadgenVerifyQueue = leadgenVerifyQueue.filter(q => !discardedKeys.has(q.compositeKey));
        updateLeadgenQueueStatus();

        rows.forEach(tr => {
            leadgenRenderedKeys.delete(tr.dataset.key);
            delete leadgenStagingData[tr.dataset.key];
            tr.remove();
        });
        showToast(`${rows.length} leads dibuang.`, 'success');
        updateLeadgenReviewCount();
        if (!leadgenRenderedKeys.size) {
            document.getElementById('leadgen-review-toolbar').style.display = 'none';
            document.getElementById('leadgen-table-wrap').style.display = 'none';
            document.getElementById('leadgen-info-box').style.display = 'none';
        }
    } catch (err) {
        console.error(err);
        showToast('Gagal membuang data. Cek koneksi.', 'error');
    }
}
