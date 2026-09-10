/**
 * charts.js — Campaign SIMASRIM
 * Chart.js charts: Leads per Brand, Donut Tipe, PIC Garap, per Area, per Tahap
 */

const CampaignCharts = {

    _instances: {},

    // ── Destroy + re-create safely ─────────────────────────────
    _destroy(id) {
        if (this._instances[id]) {
            this._instances[id].destroy();
            delete this._instances[id];
        }
    },

    _palette: [
        '#7335B7','#F3700D','#22c55e','#3b82f6','#f59e0b',
        '#ef4444','#8b5cf6','#06b6d4','#ec4899','#84cc16',
        '#f97316','#14b8a6','#a855f7','#6366f1','#eab308'
    ],

    // ── Bar: Leads per Brand (stacked Hot/Warm/Cold) ───────────
    renderByBrand(canvasId, leads) {
        this._destroy(canvasId);
        const canvas = document.getElementById(canvasId);
        if (!canvas || leads.length === 0) return;

        // Dikelompokkan case/spasi-insensitive ("sapx" & "SAPX" jadi 1 bar, bukan 2
        // bar terpisah dengan hitungan yang sama-sama kepotong).
        const brandGroups = LeadsFilter.groupByField(leads, 'brand');
        const brands = [...brandGroups.values()].map(g => g.label).sort((a, b) => String(a).localeCompare(String(b), 'id'));
        const tipeCounts = (brandLabel, tipe) => {
            const group = brandGroups.get(LeadsFilter.normKey(brandLabel));
            return group ? group.items.filter(l => (l.tipe_leads || 'New') === tipe).length : 0;
        };

        const data = {
            labels: brands,
            datasets: [
                { label: '🔴 Hot',       data: brands.map(b => tipeCounts(b, 'Hot')),
                  backgroundColor: 'rgba(239,68,68,0.85)',   borderRadius: 4 },
                { label: '🟡 Warm',      data: brands.map(b => tipeCounts(b, 'Warm')),
                  backgroundColor: 'rgba(245,158,11,0.85)',  borderRadius: 4 },
                { label: '🔵 Cold',      data: brands.map(b => tipeCounts(b, 'Cold') + tipeCounts(b, 'Cold / Dead')),
                  backgroundColor: 'rgba(59,130,246,0.85)',  borderRadius: 4 },
                { label: '🆕 New',       data: brands.map(b => tipeCounts(b, 'New')),
                  backgroundColor: 'rgba(115,53,183,0.75)',  borderRadius: 4 },
            ]
        };

        this._instances[canvasId] = new Chart(canvas, {
            type: 'bar',
            data,
            plugins: [ChartDataLabels],
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { 
                    legend: { position: 'bottom', labels: { font: { family: "'Plus Jakarta Sans'" }, padding: 12, boxWidth: 12 } }, 
                    tooltip: { mode: 'index', intersect: false },
                    datalabels: {
                        anchor: 'end', align: 'top', color: '#7b6f8f',
                        font: { family: "'Plus Jakarta Sans'", size: 10, weight: 'bold' },
                        formatter: (val) => val > 0 ? val : ''
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { family: "'Plus Jakarta Sans'", size: 11 } } },
                    y: { beginAtZero: true, ticks: { font: { family: "'Plus Jakarta Sans'", size: 11 } }, grid: { color: 'rgba(0,0,0,0.04)' }, grace: '10%' }
                }
            }
        });
    },

    // ── Doughnut: Tipe Leads overall ───────────────────────────
    renderTipeDonut(canvasId, leads) {
        this._destroy(canvasId);
        const canvas = document.getElementById(canvasId);
        if (!canvas || leads.length === 0) return;

        const tipes = ['Hot', 'Warm', 'Cold', 'Cold / Dead', 'New'];
        const counts = tipes.map(t => leads.filter(l => (l.tipe_leads || 'New') === t).length);
        const colors = ['#ef4444', '#f59e0b', '#3b82f6', '#6b7280', '#7335B7'];

        this._instances[canvasId] = new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels: tipes,
                datasets: [{ data: counts, backgroundColor: colors, borderWidth: 2, borderColor: '#fff', hoverOffset: 6 }]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '65%',
                plugins: {
                    legend: { position: 'bottom', labels: { font: { family: "'Plus Jakarta Sans'" }, padding: 10, boxWidth: 12 } },
                    tooltip: { callbacks: { label: (ctx) => ` ${ctx.label}: ${ctx.raw} leads` } },
                    datalabels: {
                        color: '#fff',
                        font: { family: "'Plus Jakarta Sans'", size: 11, weight: 'bold' },
                        formatter: (val, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => { sum += data; });
                            if (val > 0) return Math.round((val * 100) / sum) + "%";
                            return '';
                        }
                    }
                }
            }
        });
    },

    // ── Horizontal Bar: Leads per PIC Garap ─────────────────────
    renderByPIC(canvasId, leads) {
        this._destroy(canvasId);
        const canvas = document.getElementById(canvasId);
        if (!canvas || leads.length === 0) return;

        // Dikelompokkan case/spasi-insensitive supaya "Budi" & "budi" tidak jadi 2 baris.
        const picGroups = LeadsFilter.groupByField(leads, 'pic_garap');
        const pics = [...picGroups.values()].map(g => g.label).sort((a, b) => String(a).localeCompare(String(b), 'id'));
        if (pics.length === 0) return;

        const groupItems = p => picGroups.get(LeadsFilter.normKey(p))?.items || [];
        const countHot  = p => groupItems(p).filter(l => l.tipe_leads === 'Hot').length;
        const countWarm = p => groupItems(p).filter(l => l.tipe_leads === 'Warm').length;
        const countRest = p => groupItems(p).filter(l => l.tipe_leads !== 'Hot' && l.tipe_leads !== 'Warm').length;

        this._instances[canvasId] = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: pics,
                datasets: [
                    { label: 'Hot',  data: pics.map(countHot),  backgroundColor: 'rgba(239,68,68,0.85)',  borderRadius: 4 },
                    { label: 'Warm', data: pics.map(countWarm), backgroundColor: 'rgba(245,158,11,0.85)', borderRadius: 4 },
                    { label: 'Other',data: pics.map(countRest), backgroundColor: 'rgba(115,53,183,0.5)',  borderRadius: 4 },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                responsive: true, maintainAspectRatio: false,
                plugins: { 
                    legend: { position: 'bottom', labels: { font: { family: "'Plus Jakarta Sans'" }, padding: 10, boxWidth: 12 } }, 
                    tooltip: { mode: 'index' },
                    datalabels: {
                        color: '#fff',
                        font: { family: "'Plus Jakarta Sans'", size: 9, weight: 'bold' },
                        formatter: (val) => val > 0 ? val : ''
                    }
                },
                scales: {
                    x: { stacked: true, beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { family: "'Plus Jakarta Sans'", size: 10 } } },
                    y: { stacked: true, grid: { display: false }, ticks: { font: { family: "'Plus Jakarta Sans'", size: 11 } } }
                }
            }
        });
    },

    // ── Horizontal Bar: Top 8 Area ──────────────────────────────
    renderByArea(canvasId, leads) {
        this._destroy(canvasId);
        const canvas = document.getElementById(canvasId);
        if (!canvas || leads.length === 0) return;

        // Dikelompokkan case/spasi-insensitive supaya "Jakarta" & "jakarta" tidak
        // kepotong jadi 2 entri terpisah (bisa juga bikin area top-8 asli tergeser
        // keluar dari daftar gara-gara count-nya pecah).
        const areaGroups = LeadsFilter.groupByField(leads, 'area');
        const sorted = [...areaGroups.values()]
            .map(g => [g.label, g.items.length])
            .sort((a, b) => b[1] - a[1])
            .slice(0, 8);
        if (sorted.length === 0) return;

        this._instances[canvasId] = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: sorted.map(x => x[0]),
                datasets: [{
                    label: 'Leads',
                    data: sorted.map(x => x[1]),
                    backgroundColor: sorted.map((_, i) => this._palette[i % this._palette.length]),
                    borderRadius: 6,
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y', responsive: true, maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false },
                    datalabels: {
                        anchor: 'end', align: 'right', color: '#7b6f8f',
                        font: { family: "'Plus Jakarta Sans'", size: 10, weight: 'bold' }
                    }
                },
                scales: {
                    x: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { family: "'Plus Jakarta Sans'", size: 10 } }, grace: '10%' },
                    y: { grid: { display: false }, ticks: { font: { family: "'Plus Jakarta Sans'", size: 11 } } }
                }
            }
        });
    },

    // ── Doughnut: Distribusi Tahap Campaign ─────────────────────
    renderByTahap(canvasId, leads) {
        this._destroy(canvasId);
        const canvas = document.getElementById(canvasId);
        if (!canvas || leads.length === 0) return;

        const tahapCnt = { 'PESAN 1':0, 'PESAN 2':0, 'PESAN 3':0, 'FOLLOW UP':0, 'CLOSING':0, 'Belum':0 };
        leads.forEach(l => {
            const t = l.tahap || '';
            if (tahapCnt.hasOwnProperty(t)) tahapCnt[t]++;
            else if (!t) tahapCnt['Belum']++;
            else tahapCnt[t] = (tahapCnt[t] || 0) + 1;
        });

        const entries = Object.entries(tahapCnt).filter(([, v]) => v > 0);

        this._instances[canvasId] = new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels: entries.map(x => x[0]),
                datasets: [{ data: entries.map(x => x[1]), backgroundColor: entries.map((_, i) => this._palette[i % this._palette.length]), borderWidth: 2, borderColor: '#fff', hoverOffset: 5 }]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '60%',
                plugins: {
                    legend: { position: 'bottom', labels: { font: { family: "'Plus Jakarta Sans'" }, padding: 8, boxWidth: 12 } },
                    datalabels: {
                        color: '#fff',
                        font: { family: "'Plus Jakarta Sans'", size: 10, weight: 'bold' },
                        formatter: (val) => val > 0 ? val : ''
                    }
                }
            }
        });
    },

    // ── Line: Tren leads masuk (created_at) & closing (updated_at+CLOSING) ──
    // per hari, 14 hari terakhir. Dashboard sebelumnya murni snapshot — ini
    // satu-satunya elemen waktu, jadi rentang tetap 14 hari (bukan mengikuti
    // filter tanggal dashboard) supaya selalu ada tren yang kelihatan.
    renderTrend(canvasId, leads) {
        this._destroy(canvasId);
        const canvas = document.getElementById(canvasId);
        if (!canvas || leads.length === 0) return;

        const DAYS = 14;
        const labels = [];
        const dayKeys = [];
        const today = new Date();
        for (let i = DAYS - 1; i >= 0; i--) {
            const d = new Date(today);
            d.setDate(d.getDate() - i);
            const key = d.toISOString().split('T')[0];
            dayKeys.push(key);
            labels.push(`${String(d.getDate()).padStart(2, '0')}/${String(d.getMonth() + 1).padStart(2, '0')}`);
        }

        const newByDay = dayKeys.map(k => leads.filter(l => l.created_at === k).length);
        const closingByDay = dayKeys.map(k =>
            leads.filter(l => l.updated_at === k && String(l.tahap || '').toUpperCase() === 'CLOSING').length
        );

        this._instances[canvasId] = new Chart(canvas, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    { label: 'Leads Baru', data: newByDay, borderColor: '#7335B7', backgroundColor: 'rgba(115,53,183,0.12)', fill: true, tension: 0.3, pointRadius: 3 },
                    { label: 'Closing', data: closingByDay, borderColor: '#22c55e', backgroundColor: 'rgba(34,197,94,0.12)', fill: true, tension: 0.3, pointRadius: 3 },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { font: { family: "'Plus Jakarta Sans'" }, padding: 10, boxWidth: 12 } },
                    tooltip: { mode: 'index', intersect: false },
                    datalabels: { display: false },
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { family: "'Plus Jakarta Sans'", size: 10 } } },
                    y: { beginAtZero: true, ticks: { precision: 0, font: { family: "'Plus Jakarta Sans'", size: 10 } }, grid: { color: 'rgba(0,0,0,0.04)' } }
                }
            }
        });
    },

    // ── Horizontal Bar: Funnel Tahap Campaign (kumulatif) ────────────────
    // tahap cuma nyimpen posisi TERAKHIR tiap lead (bukan histori), jadi funnel
    // ini dihitung kumulatif berdasar urutan TAHAP_OPTIONS: leads di tahap N
    // dianggap sudah "melewati" semua tahap sebelum N. Ini pendekatan standar
    // funnel untuk data snapshot (bukan event-log), dan tetap actionable untuk
    // lihat di mana drop-off paling besar terjadi.
    renderFunnel(canvasId, leads) {
        this._destroy(canvasId);
        const canvas = document.getElementById(canvasId);
        if (!canvas || leads.length === 0) return;
        if (typeof TAHAP_OPTIONS === 'undefined') return;

        const stages = TAHAP_OPTIONS;
        const ordinal = (t) => stages.indexOf(t);
        const counts = stages.map((_, idx) => leads.filter(l => ordinal(l.tahap) >= idx).length);
        if (counts[0] === 0) return;

        this._instances[canvasId] = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: stages,
                datasets: [{
                    label: 'Leads',
                    data: counts,
                    backgroundColor: stages.map((_, i) => this._palette[i % this._palette.length]),
                    borderRadius: 6,
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y', responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: (ctx) => {
                                const pct = counts[0] > 0 ? Math.round((ctx.raw / counts[0]) * 100) : 0;
                                return ` ${ctx.raw} leads (${pct}% dari total masuk pesan)`;
                            }
                        }
                    },
                    datalabels: {
                        anchor: 'end', align: 'right', color: '#7b6f8f',
                        font: { family: "'Plus Jakarta Sans'", size: 10, weight: 'bold' },
                        formatter: (val) => val > 0 ? val : ''
                    }
                },
                scales: {
                    x: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { family: "'Plus Jakarta Sans'", size: 10 } }, grace: '10%' },
                    y: { grid: { display: false }, ticks: { font: { family: "'Plus Jakarta Sans'", size: 11 } } }
                }
            }
        });
    },

    // ── Render semua chart ──────────────────────────────────────
    renderAll(leads, mode) {
        setTimeout(() => {
            this.renderByBrand('chart-by-brand', leads);
            this.renderTipeDonut('chart-tipe-donut', leads);
            this.renderByPIC('chart-by-pic', leads);
            this.renderByArea('chart-by-area', leads);
            this.renderByTahap('chart-by-tahap', leads);
            this.renderTrend('chart-trend', leads);
            this.renderFunnel('chart-funnel-tahap', leads);
        }, 80);
    },

    // ── Populate brand filter ────────────────────────────────────
    populateBrandFilter(leads) {
        const sel = document.getElementById('chart-brand-filter');
        if (!sel) return;
        // Dedup case/spasi-insensitive ("sapx" & "SAPX" jadi 1 opsi, bukan 2).
        const brands = [...LeadsFilter.groupByField(leads, 'brand').values()]
            .map(g => g.label)
            .sort((a, b) => String(a).localeCompare(String(b), 'id'));
        sel.innerHTML = '<option value="all">Semua Brand</option>' +
            brands.map(b => `<option value="${b}">${b}</option>`).join('');
        sel.onchange = () => {
            const filtered = sel.value === 'all' ? leads : leads.filter(l => LeadsFilter.normKey(l.brand) === LeadsFilter.normKey(sel.value));
            this.renderByBrand('chart-by-brand', filtered);
        };
    },

    destroyAll() {
        Object.keys(this._instances).forEach(id => this._destroy(id));
    }
};
