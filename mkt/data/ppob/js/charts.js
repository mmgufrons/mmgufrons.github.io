/**
 * charts.js — PPOB SIMASRIM Dashboard
 * Menggunakan Chart.js untuk semua visualisasi data.
 * Tema: Ungu (#7335B7) & Oranye (#F3700D)
 */

class DashboardCharts {

    static PALETTE = {
        purple:   '#7335B7',
        purpleAlt:'#9B59D9',
        orange:   '#F3700D',
        orangeAlt:'#FF9A45',
        green:    '#22c55e',
        blue:     '#3b82f6',
        pink:     '#ec4899',
        teal:     '#14b8a6',
        red:      '#ef4444',
        yellow:   '#f59e0b',
    };

    static COLOR_POOL = [
        '#7335B7','#F3700D','#22c55e','#3b82f6','#ec4899',
        '#14b8a6','#f59e0b','#ef4444','#8b5cf6','#06b6d4',
        '#84cc16','#f97316','#a855f7','#10b981','#6366f1'
    ];

    static instances = {};

    // ================================================================
    // DESTROY & RECREATE helper (cegah chart duplikat)
    // ================================================================
    static create(canvasId, config) {
        if (this.instances[canvasId]) {
            this.instances[canvasId].destroy();
        }
        const canvas = document.getElementById(canvasId);
        if (!canvas) return null;
        const chart = new Chart(canvas.getContext('2d'), config);
        this.instances[canvasId] = chart;
        return chart;
    }

    // ================================================================
    // LINE CHART — Tren Transaksi per Bulan/Tanggal
    // ================================================================
    static renderTrend(canvasId, trendData) {
        const labels  = trendData.map(d => this.formatLabel(d.label));
        const counts  = trendData.map(d => d.count);
        const volumes = trendData.map(d => d.volume);
        const profits = trendData.map(d => d.profit);

        return this.create(canvasId, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Jumlah Transaksi',
                        data: counts,
                        borderColor: this.PALETTE.purple,
                        backgroundColor: this.hexToRgba(this.PALETTE.purple, 0.08),
                        borderWidth: 2.5,
                        pointBackgroundColor: this.PALETTE.purple,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'yCount'
                    },
                    {
                        label: 'Profit (Rp)',
                        data: profits,
                        borderColor: this.PALETTE.orange,
                        backgroundColor: this.hexToRgba(this.PALETTE.orange, 0.06),
                        borderWidth: 2.5,
                        pointBackgroundColor: this.PALETTE.orange,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'yRupiah'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { position: 'top', labels: { usePointStyle: true, font: { family: 'Plus Jakarta Sans', weight: '600', size: 12 } } },
                    tooltip: {
                        callbacks: {
                            label: ctx => {
                                const label = ctx.dataset.label || '';
                                if (label.includes('Profit') || label.includes('Volume')) {
                                    return ` ${label}: ${PPOBParser.formatRupiah(ctx.parsed.y)}`;
                                }
                                return ` ${label}: ${ctx.parsed.y.toLocaleString('id-ID')} transaksi`;
                            }
                        }
                    }
                },
                scales: {
                    yCount: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        grid: { color: 'rgba(0,0,0,0.04)' },
                        ticks: { font: { family: 'Plus Jakarta Sans', size: 11 } }
                    },
                    yRupiah: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 11 },
                            callback: v => 'Rp ' + (v >= 1000000 ? (v/1000000).toFixed(1)+'jt' : v >= 1000 ? (v/1000).toFixed(0)+'rb' : v)
                        }
                    },
                    x: { grid: { display: false }, ticks: { font: { family: 'Plus Jakarta Sans', size: 11 } } }
                }
            }
        });
    }

    // ================================================================
    // DOUGHNUT CHART — Top Kategori
    // ================================================================
    static renderKategoriDoughnut(canvasId, kategoriData) {
        const labels  = kategoriData.map(d => d.kategori);
        const counts  = kategoriData.map(d => d.count);
        const colors  = labels.map((_, i) => this.COLOR_POOL[i % this.COLOR_POOL.length]);

        return this.create(canvasId, {
            type: 'doughnut',
            data: {
                labels,
                datasets: [{
                    data: counts,
                    backgroundColor: colors.map(c => this.hexToRgba(c, 0.85)),
                    borderColor: colors,
                    borderWidth: 2,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            padding: 16,
                            font: { family: 'Plus Jakarta Sans', weight: '600', size: 11 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.label}: ${ctx.parsed.toLocaleString('id-ID')} transaksi`
                        }
                    }
                }
            }
        });
    }

    // ================================================================
    // HORIZONTAL BAR — Top Produk
    // ================================================================
    static renderTopProdukBar(canvasId, produkData) {
        const labels = produkData.map(d => this.truncate(d.produk, 28));
        const counts = produkData.map(d => d.count);

        return this.create(canvasId, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: counts,
                    backgroundColor: labels.map((_, i) =>
                        this.hexToRgba(this.COLOR_POOL[i % this.COLOR_POOL.length], 0.8)
                    ),
                    borderColor: labels.map((_, i) => this.COLOR_POOL[i % this.COLOR_POOL.length]),
                    borderWidth: 1.5,
                    borderRadius: 6
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.parsed.x.toLocaleString('id-ID')} transaksi`
                        }
                    }
                },
                scales: {
                    x: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { family: 'Plus Jakarta Sans', size: 11 } } },
                    y: { grid: { display: false }, ticks: { font: { family: 'Plus Jakarta Sans', size: 11 } } }
                }
            }
        });
    }

    // ================================================================
    // BAR CHART — Profit per Bulan
    // ================================================================
    static renderProfitBar(canvasId, trendData) {
        const labels  = trendData.map(d => this.formatLabel(d.label));
        const profits = trendData.map(d => d.profit);

        return this.create(canvasId, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Profit Bersih (Rp)',
                    data: profits,
                    backgroundColor: labels.map((_, i) =>
                        i % 2 === 0
                            ? this.hexToRgba(this.PALETTE.purple, 0.75)
                            : this.hexToRgba(this.PALETTE.orange, 0.75)
                    ),
                    borderColor: labels.map((_, i) =>
                        i % 2 === 0 ? this.PALETTE.purple : this.PALETTE.orange
                    ),
                    borderWidth: 1.5,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` Profit: ${PPOBParser.formatRupiah(ctx.parsed.y)}`
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { family: 'Plus Jakarta Sans', size: 11 } } },
                    y: {
                        grid: { color: 'rgba(0,0,0,0.04)' },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 11 },
                            callback: v => v >= 1000000 ? 'Rp' + (v/1000000).toFixed(1)+'jt' : 'Rp' + (v/1000).toFixed(0)+'rb'
                        }
                    }
                }
            }
        });
    }

    // ================================================================
    // SEGMENTASI PIE — Distribusi Segmen CRM
    // ================================================================
    static renderSegmenPie(canvasId, segmentedUsers) {
        const counts = { champion: 0, micro: 0, crosssell: 0, atrisk: 0, active: 0, inactive: 0 };
        for (const u of segmentedUsers) {
            if (counts.hasOwnProperty(u.segmen_code)) counts[u.segmen_code]++;
        }

        const labels = ['Champion/VIP', 'Active Micro', 'Cross-Sell', 'At Risk', 'Active', 'Inactive'];
        const data   = [counts.champion, counts.micro, counts.crosssell, counts.atrisk, counts.active, counts.inactive];
        const colors = [this.PALETTE.purple, this.PALETTE.blue, this.PALETTE.green, this.PALETTE.red, this.PALETTE.teal, '#9ca3af'];

        return this.create(canvasId, {
            type: 'pie',
            data: {
                labels,
                datasets: [{
                    data,
                    backgroundColor: colors.map(c => this.hexToRgba(c, 0.85)),
                    borderColor: colors,
                    borderWidth: 2,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            padding: 14,
                            font: { family: 'Plus Jakarta Sans', weight: '600', size: 11 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.label}: ${ctx.parsed} user`
                        }
                    }
                }
            }
        });
    }

    // ================================================================
    // HELPERS
    // ================================================================
    static hexToRgba(hex, alpha) {
        const r = parseInt(hex.slice(1,3), 16);
        const g = parseInt(hex.slice(3,5), 16);
        const b = parseInt(hex.slice(5,7), 16);
        return `rgba(${r},${g},${b},${alpha})`;
    }

    static formatLabel(label) {
        if (!label) return '';
        if (label.length === 7 && label.includes('-')) { // YYYY-MM
            const [y, m] = label.split('-');
            const bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];
            return `${bulan[parseInt(m) - 1]} ${y}`;
        }
        return label;
    }

    static truncate(str, n) {
        if (!str) return '';
        return str.length > n ? str.substring(0, n) + '…' : str;
    }

    static destroyAll() {
        for (const key of Object.keys(this.instances)) {
            if (this.instances[key]) this.instances[key].destroy();
        }
        this.instances = {};
    }
}
