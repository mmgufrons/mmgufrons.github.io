class DashboardManager {
    constructor() {}

    renderCharts(data) {
        // Aggregate data
        const aggregated = this.aggregateData(data);
        
        this.renderSummaryCards(aggregated);
        this.renderTrendChart(aggregated.monthlyTrends);
        this.renderPlatformChart(aggregated.platformStats);
        this.renderProductChart(aggregated.productStats);
    }

    aggregateData(data) {
        let totalOmzet = 0;
        let totalProfit = 0;
        let totalPesanan = 0;
        let totalMutasi = 0;
        let totalAdminFee = 0;
        
        const platformStats = {
            shopee_albanistore: 0,
            shopee_bobcare: 0,
            soundbox: 0,
            tiktok_albanie: 0
        };

        const monthlyTrendsMap = {};
        const productStatsMap = {};

        // Process Penjualan
        if (data && data.penjualan) {
            for (const [platform, records] of Object.entries(data.penjualan)) {
                for (const [id, record] of Object.entries(records)) {
                    totalOmzet += (record.harga_jual || 0);
                    totalProfit += (record.pendapatan_bersih || 0);
                    totalAdminFee += (record.biaya_admin || 0);
                    totalPesanan++;
                    
                    platformStats[platform] += (record.pendapatan_bersih || 0);

                    // Monthly Trend
                    if(record.tanggal_order) {
                        const income = record.pendapatan_bersih || 0;
                        const dateObj = new Date(record.tanggal_order);
                        const monthKey = `${dateObj.getFullYear()}-${String(dateObj.getMonth() + 1).padStart(2, '0')}`;
                        
                        if (!monthlyTrendsMap[monthKey]) {
                            monthlyTrendsMap[monthKey] = { total: 0, platforms: {} };
                        }
                        if (!monthlyTrendsMap[monthKey].platforms[platform]) {
                            monthlyTrendsMap[monthKey].platforms[platform] = 0;
                        }
                        monthlyTrendsMap[monthKey].total += income;
                        monthlyTrendsMap[monthKey].platforms[platform] += income;
                    }

                    // Product Categories (Case-Insensitive Grouping)
                    const rawProductName = (record.nama_produk || record.type || 'Lainnya').trim();
                    const productNameLower = rawProductName.replace(/\s+/g, ' ').toLowerCase();
                    if (!productStatsMap[productNameLower]) {
                        productStatsMap[productNameLower] = { name: rawProductName, total: 0 };
                    }
                    productStatsMap[productNameLower].total += (record.pendapatan_bersih || 0);
                }
            }
        }

        // Process Mutasi
        if (data && data.mutasi_saldo && data.mutasi_saldo.bobcare) {
            for (const record of Object.values(data.mutasi_saldo.bobcare)) {
                totalMutasi += (record.nominal || 0);
            }
        }

        // Sort trend data
        const sortedMonths = Object.keys(monthlyTrendsMap).sort();
        const monthlyTrends = {
            labels: sortedMonths,
            data: sortedMonths.map(m => monthlyTrendsMap[m])
        };

        // Top 15 Products
        const sortedProducts = Object.values(productStatsMap)
            .sort((a, b) => b.total - a.total)
            .slice(0, 15);
            
        const productStats = {
            labels: sortedProducts.map(p => p.name),
            data: sortedProducts.map(p => p.total)
        };

        return {
            totalOmzet, totalProfit, totalPesanan, totalMutasi, totalAdminFee,
            platformStats, monthlyTrends, productStats
        };
    }

    renderSummaryCards(agg) {
        const formatRP = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(num);
        
        document.getElementById('total-omzet').innerText = formatRP(agg.totalOmzet);
        document.getElementById('total-profit').innerText = formatRP(agg.totalProfit);
        document.getElementById('total-mutasi').innerText = formatRP(agg.totalMutasi);
        document.getElementById('total-pesanan').innerText = agg.totalPesanan.toLocaleString('id-ID');
        if(document.getElementById('total-admin')) {
            document.getElementById('total-admin').innerText = formatRP(agg.totalAdminFee);
        }
    }

    renderTrendChart(monthlyTrends) {
        const container = document.getElementById('trendChart');
        container.innerHTML = '';
        if(monthlyTrends.data.length === 0) return;
        
        const maxVal = Math.max(...monthlyTrends.data.map(d => d.total), 1);
        const formatRP = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(num);
        const formatRPSimple = (num) => {
            if (num >= 1000000) return (num / 1000000).toFixed(1).replace('.0', '') + 'Jt';
            if (num >= 1000) return (num / 1000).toFixed(1).replace('.0', '') + 'Rb';
            return num.toString();
        };
        
        const chartWrapper = document.createElement('div');
        chartWrapper.className = 'apple-bar-chart';

        const platformColors = {
            shopee_albanistore: '#2ECC71',
            shopee_bobcare: '#3498db',
            soundbox: '#f39c12',
            tiktok_albanie: '#111111'
        };
        
        monthlyTrends.labels.forEach((label, i) => {
            const dataObj = monthlyTrends.data[i];
            const totalVal = dataObj.total;
            const pct = (totalVal / maxVal) * 100;
            
            const [y, m] = label.split('-');
            const dateStr = new Date(y, m - 1).toLocaleString('id-ID', { month: 'short', year: '2-digit' });

            let fillsHtml = '';
            for (const [plat, pVal] of Object.entries(dataObj.platforms)) {
                if (pVal > 0) {
                    const pPct = (pVal / totalVal) * 100;
                    fillsHtml += `<div style="height: ${pPct}%; width: 100%; background: ${platformColors[plat] || '#ccc'};"></div>`;
                }
            }
            
            chartWrapper.innerHTML += `
                <div class="bar-col">
                    <div class="bar-value-top">${formatRPSimple(totalVal)}</div>
                    <div class="bar-track">
                        <div class="bar-fill" style="height: ${pct}%; width: 100%; display: flex; flex-direction: column; justify-content: flex-end; border-radius: 8px; overflow: hidden;">
                            ${fillsHtml}
                        </div>
                    </div>
                    <div class="bar-label">${dateStr}</div>
                </div>
            `;
        });
        container.appendChild(chartWrapper);
    }

    renderPlatformChart(platformStats) {
        const container = document.getElementById('platformChart');
        container.innerHTML = '';
        
        const platforms = [
            { name: 'Shopee Albanistore', val: platformStats.shopee_albanistore, color: '#2ECC71' },
            { name: 'Shopee Bobcare', val: platformStats.shopee_bobcare, color: '#3498db' },
            { name: 'Soundbox', val: platformStats.soundbox, color: '#f39c12' },
            { name: 'TikTok', val: platformStats.tiktok_albanie, color: '#111111' }
        ];
        
        const total = platforms.reduce((s, p) => s + p.val, 0) || 1;
        const formatRP = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(num);
        
        const listWrapper = document.createElement('div');
        listWrapper.className = 'apple-list-chart';
        
        platforms.sort((a,b) => b.val - a.val).forEach(p => {
            const pct = (p.val / total) * 100;
            listWrapper.innerHTML += `
                <div class="list-item">
                    <div class="list-info">
                        <div style="display:flex; align-items:center;"><span class="dot" style="background:${p.color}"></span><span class="name">${p.name}</span></div>
                        <span class="val">${formatRP(p.val)}</span>
                    </div>
                    <div class="list-track">
                        <div class="list-fill" style="width: ${pct}%; background: ${p.color};"></div>
                    </div>
                </div>
            `;
        });
        container.appendChild(listWrapper);
    }

    renderProductChart(productStats) {
        const container = document.getElementById('productChart');
        container.innerHTML = '';
        if(productStats.data.length === 0) return;

        const maxVal = Math.max(...productStats.data, 1);
        const formatRP = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(num);
        
        const listWrapper = document.createElement('div');
        listWrapper.className = 'apple-list-chart';
        
        productStats.labels.forEach((label, i) => {
            const val = productStats.data[i];
            const pct = (val / maxVal) * 100;
            listWrapper.innerHTML += `
                <div class="list-item">
                    <div class="list-info">
                        <span class="name" title="${label}">${label.length > 40 ? label.substring(0,40)+'...' : label}</span>
                        <span class="val">${formatRP(val)}</span>
                    </div>
                    <div class="list-track">
                        <div class="list-fill" style="width: ${pct}%; background: var(--primary-dark);"></div>
                    </div>
                </div>
            `;
        });
        container.appendChild(listWrapper);
    }
}
