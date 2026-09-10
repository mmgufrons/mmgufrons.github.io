/**
 * crm.js — Mesin CRM & Segmentasi User SIMASRIM PPOB Dashboard
 * Mengelompokkan user berdasarkan riwayat transaksi dan menghasilkan:
 *   - Segmentasi: Champion, Active Micro, Cross-Sell Target, At Risk
 *   - Template WhatsApp per segmen
 *   - Data Leaderboard
 */

class CRMEngine {

    // ================================================================
    // THRESHOLDS — Bisa diubah tanpa modifikasi kode lain
    // ================================================================
    static THRESHOLD = {
        CHAMPION_TRX_MIN:    20,    // Minimum transaksi untuk Champion
        CHAMPION_VOLUME_MIN: 500000,// Minimum total volume (Rp) untuk Champion
        MICRO_TRX_MIN:       5,     // Minimum transaksi Active Micro
        MICRO_VOLUME_MAX:    100000,// Volume rata-rata per trx Active Micro
        AT_RISK_DAYS:        30,    // Hari tanpa transaksi = At Risk
    };

    // ================================================================
    // SEGMENTASI UTAMA
    // Input:
    //   users       — object { email_key: { nama, email, no_wa, kategori, origin } }
    //   transactions— array semua transaksi PPOB yang sudah di-flat
    //   logistics   — object { resi: { email_key, ... } } (opsional)
    // Output: array user dengan segmentasi
    // ================================================================
    static segment(users, transactions, logistics = {}) {
        // ── 1. Agregasi transaksi per email_key ──
        const txByUser = {};

        for (const trx of transactions) {
            const key = trx.email_key || '';
            if (!key) continue;
            if (!txByUser[key]) {
                txByUser[key] = {
                    count: 0,
                    volume: 0,        // total tagihan_user
                    profit: 0,
                    categories: {},   // { PULSA: 5, PLN: 2, ... }
                    dates: [],        // tanggal transaksi
                    lastDate: null
                };
            }
            const u = txByUser[key];
            u.count++;
            u.volume += (trx.tagihan_user || 0);
            u.profit += (trx.profit || 0);

            const cat = trx.kategori || 'LAIN';
            u.categories[cat] = (u.categories[cat] || 0) + 1;

            if (trx.tanggal_beli) {
                u.dates.push(trx.tanggal_beli);
                if (!u.lastDate || trx.tanggal_beli > u.lastDate) {
                    u.lastDate = trx.tanggal_beli;
                }
            }
        }

        // ── 2. User yang punya logistik ──
        const logisticUsers = new Set(
            Object.values(logistics)
                .filter(l => l.email_key)
                .map(l => l.email_key)
        );

        // ── 3. Segmentasi per user ──
        const today = new Date();
        const result = [];

        // Kumpulkan semua email_key yang perlu diproses (dari user master + yang ada di transaksi)
        const allKeys = new Set([
            ...Object.keys(users),
            ...Object.keys(txByUser)
        ]);

        for (const key of allKeys) {
            const profile = users[key] || {};
            const stats   = txByUser[key] || { count: 0, volume: 0, profit: 0, categories: {}, dates: [], lastDate: null };

            // Cari produk favorit
            const favProduk = Object.entries(stats.categories)
                .sort((a, b) => b[1] - a[1])
                .slice(0, 2)
                .map(e => e[0])
                .join(', ') || '–';

            // Hari sejak terakhir transaksi
            let daysSinceLast = 9999;
            if (stats.lastDate) {
                const last = new Date(stats.lastDate);
                daysSinceLast = Math.floor((today - last) / (1000 * 60 * 60 * 24));
            }

            const avgVolume = stats.count > 0 ? stats.volume / stats.count : 0;
            const hasLogistic = logisticUsers.has(key);
            const hasPPOB     = stats.count > 0;

            // ── Tentukan Segmen ──
            let segmen, segmenCode;

            if (stats.count >= this.THRESHOLD.CHAMPION_TRX_MIN &&
                stats.volume >= this.THRESHOLD.CHAMPION_VOLUME_MIN) {
                segmen = 'Champion / VIP 👑';
                segmenCode = 'champion';
            } else if (stats.count >= this.THRESHOLD.MICRO_TRX_MIN &&
                       avgVolume <= this.THRESHOLD.MICRO_VOLUME_MAX) {
                segmen = 'Active Micro ⚡';
                segmenCode = 'micro';
            } else if (stats.count > 0 && daysSinceLast >= this.THRESHOLD.AT_RISK_DAYS) {
                segmen = 'At Risk / Churn ⚠️';
                segmenCode = 'atrisk';
            } else if ((hasPPOB && !hasLogistic) || (!hasPPOB && hasLogistic)) {
                segmen = 'Cross-Sell Target 🎯';
                segmenCode = 'crosssell';
            } else if (stats.count > 0) {
                segmen = 'Active User ✅';
                segmenCode = 'active';
            } else {
                segmen = 'Inactive';
                segmenCode = 'inactive';
            }

            result.push({
                key,
                email:          profile.email || key.replace(/,/g, '.'),
                nama:           profile.nama || '(Tanpa Nama)',
                no_wa:          profile.no_wa || '',
                kategori:       profile.kategori || '',
                origin:         profile.origin || '',
                id_user:        profile.id_user || '',
                // Statistik
                total_trx:      stats.count,
                total_volume:   stats.volume,
                total_profit:   stats.profit,
                fav_kategori:   favProduk,
                last_trx_date:  stats.lastDate,
                days_since:     daysSinceLast === 9999 ? null : daysSinceLast,
                has_logistic:   hasLogistic,
                // Segmentasi
                segmen,
                segmen_code: segmenCode
            });
        }

        // ── 4. Sort: Champion dulu, lalu by total_trx ──
        const order = { champion: 0, micro: 1, crosssell: 2, active: 3, atrisk: 4, inactive: 5 };
        result.sort((a, b) => {
            const segDiff = (order[a.segmen_code] ?? 9) - (order[b.segmen_code] ?? 9);
            if (segDiff !== 0) return segDiff;
            return b.total_trx - a.total_trx;
        });

        return result;
    }

    // ================================================================
    // GENERATE TEMPLATE WHATSAPP
    // ================================================================
    static generateWATemplate(user) {
        const nama   = user.nama || 'Kakak';
        const jumlah = user.total_trx;
        const vol    = PPOBParser.formatRupiah(user.total_volume);
        const fav    = user.fav_kategori;

        switch (user.segmen_code) {
            case 'champion':
                return `Halo Kak ${nama}, luar biasa banget bulan ini transaksi PPOB-nya tembus ${jumlah} transaksi! 🎉 Ada kendala ngga kak sejauh ini? Sekalian mau info promo pengiriman paket nih buat yang udah sering transaksi kayak kakak... 📦`;

            case 'micro':
                return `Halo Kak ${nama}, jualan ${fav}-nya kenceng terus nih! 🔥 Btw, kakak tau ngga kalau top-up E-Wallet atau bayar PLN di SIMASRIM cuannya lebih gede lho, mau kita bantu aktifin/pandu supaya makin cuan? 💰`;

            case 'crosssell':
                if (user.has_logistic && user.total_trx === 0) {
                    return `Halo Kak ${nama}, seneng banget kakak udah pake layanan kirim paket di SIMASRIM! 📦 Oh ya kak, kakak tau ngga kalau kita juga punya layanan PPOB (Pulsa, Listrik, E-Wallet, dll) yang komisinya lumayan banget? Mau kita bantu aktifin?`;
                }
                return `Halo Kak ${nama}, lancar ya kak jualan PPOB-nya di SIMASRIM! 💪 Oh ya kak, kita perhatikan kakak belum pernah coba layanan kirim paketnya (Logistik) nih, padahal lagi ada diskon up to 30% lho! Ada yang bisa dibantu? 📦`;

            case 'atrisk':
                return `Halo Kak ${nama}, udah lama nih ngga keliatan transaksinya di SIMASRIM 😊 Apakah ada kendala di aplikasi atau layanan kami yang bisa kami bantu cek? Kita siap bantu kak, jangan sungkan ya! 🙏`;

            default:
                return `Halo Kak ${nama}! 👋 Terima kasih sudah bergabung di SIMASRIM. Ada yang bisa kami bantu atau informasikan? Kami selalu siap melayani! 😊`;
        }
    }

    // ================================================================
    // FORMAT NOMOR WA → URL wa.me
    // ================================================================
    static buildWAUrl(noWa, text) {
        let num = String(noWa || '').replace(/\D/g, '');
        if (!num) return null;
        if (num.startsWith('0')) num = '62' + num.substring(1);
        if (!num.startsWith('62')) num = '62' + num;
        const encoded = encodeURIComponent(text);
        return `https://wa.me/${num}?text=${encoded}`;
    }

    // ================================================================
    // SUMMARY STATS untuk Dashboard Cards
    // ================================================================
    static getSummary(transactions, users) {
        const totalTrx    = transactions.length;
        const totalVolume = transactions.reduce((s, t) => s + (t.tagihan_user || 0), 0);
        const totalProfit = transactions.reduce((s, t) => s + (t.profit || 0), 0);

        const activeEmailKeys = new Set(transactions.map(t => t.email_key).filter(Boolean));
        const totalUserAktif  = activeEmailKeys.size;

        return { totalTrx, totalVolume, totalProfit, totalUserAktif };
    }

    // ================================================================
    // TREND DATA — Hitung jumlah & volume per tanggal/bulan
    // ================================================================
    static getTrend(transactions, groupBy = 'month') {
        const map = {};
        for (const trx of transactions) {
            if (!trx.tanggal_beli) continue;
            const d   = new Date(trx.tanggal_beli);
            const key = groupBy === 'month'
                ? `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2,'0')}`
                : trx.tanggal_beli;

            if (!map[key]) map[key] = { count: 0, volume: 0, profit: 0 };
            map[key].count++;
            map[key].volume += (trx.tagihan_user || 0);
            map[key].profit += (trx.profit || 0);
        }
        // Urutkan berdasarkan tanggal
        return Object.entries(map)
            .sort((a, b) => a[0].localeCompare(b[0]))
            .map(([label, data]) => ({ label, ...data }));
    }

    // ================================================================
    // TOP KATEGORI — Hitung jumlah transaksi per kategori
    // ================================================================
    static getTopKategori(transactions, top = 10) {
        const map = {};
        for (const trx of transactions) {
            const k = trx.kategori || 'LAIN';
            if (!map[k]) map[k] = { count: 0, volume: 0, profit: 0 };
            map[k].count++;
            map[k].volume += (trx.tagihan_user || 0);
            map[k].profit += (trx.profit || 0);
        }
        return Object.entries(map)
            .sort((a, b) => b[1].count - a[1].count)
            .slice(0, top)
            .map(([kategori, data]) => ({ kategori, ...data }));
    }

    // ================================================================
    // TOP PRODUK — Hitung jumlah transaksi per produk
    // ================================================================
    static getTopProduk(transactions, top = 10) {
        const map = {};
        for (const trx of transactions) {
            const p = trx.nama_produk || 'Lainnya';
            if (!map[p]) map[p] = { count: 0, volume: 0, profit: 0 };
            map[p].count++;
            map[p].volume += (trx.tagihan_user || 0);
            map[p].profit += (trx.profit || 0);
        }
        return Object.entries(map)
            .sort((a, b) => b[1].count - a[1].count)
            .slice(0, top)
            .map(([produk, data]) => ({ produk, ...data }));
    }
}
