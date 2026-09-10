/**
 * parser.js — PPOB SIMASRIM Dashboard
 * Parsing file Excel/CSV (pakai SheetJS) untuk 3 jenis data:
 *   1. Data Master User
 *   2. Data Transaksi PPOB
 *   3. Data Logistik (opsional)
 *
 * Output: JSON siap simpan ke Firebase dengan relasi EMAIL sebagai FK.
 */

class PPOBParser {

    // ================================================================
    // HELPER: Bersihkan email untuk dijadikan key Firebase
    // Firebase key tidak boleh mengandung . # $ [ ]
    // ================================================================
    static sanitizeEmail(email) {
        if (!email) return null;
        return String(email).trim().toLowerCase().replace(/\./g, ',').replace(/[#$\[\]]/g, '_');
    }

    // ================================================================
    // HELPER: Konversi angka/string ke format Rupiah
    // ================================================================
    static toNum(val) {
        if (val === null || val === undefined || val === '') return 0;
        if (typeof val === 'number') return val;
        // Hapus karakter non-numerik kecuali minus & titik desimal
        const cleaned = String(val).replace(/[Rp\s.,]/g, '').replace(/[^\d-]/g, '');
        return parseFloat(cleaned) || 0;
    }

    // ================================================================
    // HELPER: Format tanggal (Excel serial / string) → ISO string
    // ================================================================
    static parseDate(val) {
        if (!val) return null;
        // Excel serial number
        if (typeof val === 'number') {
            const d = new Date((val - 25569) * 86400 * 1000);
            return d.toISOString().split('T')[0];
        }
        const s = String(val).trim();
        // Coba parse langsung
        const d1 = new Date(s);
        if (!isNaN(d1)) return d1.toISOString().split('T')[0];
        // Format DD/MM/YYYY
        const match = s.match(/^(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{2,4})$/);
        if (match) {
            let [, dd, mm, yyyy] = match;
            if (yyyy.length === 2) yyyy = '20' + yyyy;
            const d2 = new Date(`${yyyy}-${mm.padStart(2,'0')}-${dd.padStart(2,'0')}`);
            if (!isNaN(d2)) return d2.toISOString().split('T')[0];
        }
        return null;
    }

    // ================================================================
    // HELPER: Sanitize kode transaksi untuk jadi Firebase key
    // ================================================================
    static sanitizeKey(str) {
        if (!str) return null;
        return String(str).trim()
            .replace(/[.#$\[\]/]/g, '_')
            .replace(/\s+/g, '_')
            .substring(0, 200); // Firebase max key length
    }

    // ================================================================
    // HELPER: Baca workbook dari File object
    // ================================================================
    static readWorkbook(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                try {
                    const wb = XLSX.read(new Uint8Array(e.target.result), {
                        type: 'array',
                        cellDates: false,
                        cellNF: true,
                        raw: true
                    });
                    resolve(wb);
                } catch (err) {
                    reject(err);
                }
            };
            reader.onerror = reject;
            reader.readAsArrayBuffer(file);
        });
    }

    // ================================================================
    // HELPER: Sheet ke JSON — coba beberapa header-row
    // ================================================================
    static sheetToJson(sheet) {
        // Coba dari baris 1 dulu, lalu 2 (untuk file dengan baris judul)
        let rows = XLSX.utils.sheet_to_json(sheet, { defval: '' });
        if (rows.length === 0) {
            rows = XLSX.utils.sheet_to_json(sheet, { defval: '', range: 1 });
        }
        return rows;
    }

    // ================================================================
    // KOLOM HELPER: Cari nilai dari beberapa kemungkinan nama kolom
    // ================================================================
    static col(row, ...keys) {
        for (const k of keys) {
            if (row[k] !== undefined && row[k] !== '') return row[k];
        }
        return '';
    }

    // ================================================================
    // 1. PARSE DATA MASTER USER
    //    Kolom kunci: EMAIL, ID USER, NAMA USER, NO WA, KATEGORI USER, ORIGIN
    //    Output: { users: { sanitized_email: { ... } } }
    // ================================================================
    static async parseMasterUser(file, onProgress) {
        onProgress(10, 'Membaca file Master User...');
        const wb = await this.readWorkbook(file);
        const sheet = wb.Sheets[wb.SheetNames[0]];
        const rows = this.sheetToJson(sheet);

        onProgress(50, `Memproses ${rows.length} baris Master User...`);

        const users = {};
        let skipped = 0;

        for (const row of rows) {
            const email = this.col(row,
                'EMAIL', 'Email', 'email',
                'ALAMAT EMAIL', 'Alamat Email'
            );
            if (!email || !String(email).includes('@')) { skipped++; continue; }

            const key = this.sanitizeEmail(email);
            if (!key) { skipped++; continue; }

            const noWa = this.col(row,
                'NO WA', 'No WA', 'NOMOR WA', 'No WhatsApp', 'NO HP', 'HP', 'Phone',
                'NO TELEPON', 'No Telepon', 'TELEPON'
            );

            users[key] = {
                email: String(email).trim().toLowerCase(),
                id_user: String(this.col(row, 'ID USER', 'Id User', 'ID', 'User ID', 'id_user') || '').trim(),
                nama: String(this.col(row, 'NAMA USER', 'Nama User', 'NAMA', 'Nama', 'Name', 'nama_user') || '').trim(),
                no_wa: String(noWa || '').trim().replace(/\D/g, ''),
                kategori: String(this.col(row, 'KATEGORI USER', 'Kategori User', 'KATEGORI', 'Kategori', 'kategori_user', 'TYPE', 'Type') || '').trim(),
                origin: String(this.col(row, 'ORIGIN', 'Origin', 'ASAL', 'Kota', 'KOTA', 'Daerah') || '').trim(),
                updated_at: new Date().toISOString()
            };
        }

        onProgress(100, 'Master User selesai diproses.');
        return { users, meta: { total: rows.length, imported: Object.keys(users).length, skipped } };
    }

    // ================================================================
    // 2. PARSE DATA TRANSAKSI PPOB
    //    Kolom kunci: EMAIL, KODE TRANSAKSI, TANGGAL BELI, KATEGORI,
    //                 NAMA PRODUK, TAGIHAN USER, CASHBACK USER, BAYAR MITRA, STATUS
    //    Kalkulasi: PROFIT = (TAGIHAN USER - CASHBACK USER) - BAYAR MITRA
    //    Output: { ppob_transactions: { kode_trx: { ...data, profit } } }
    // ================================================================
    static async parsePPOB(file, onProgress) {
        onProgress(10, 'Membaca file Transaksi PPOB...');
        const wb = await this.readWorkbook(file);
        const sheet = wb.Sheets[wb.SheetNames[0]];
        const rows = this.sheetToJson(sheet);

        onProgress(40, `Memproses ${rows.length} transaksi PPOB...`);

        const ppob_transactions = {};
        let skipped = 0;
        let totalProfit = 0;

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            if (i % 100 === 0) {
                const pct = 40 + Math.round((i / rows.length) * 50);
                onProgress(pct, `Memproses baris ${i + 1} / ${rows.length}...`);
            }

            const kodeTrx = this.col(row,
                'KODE TRANSAKSI', 'Kode Transaksi', 'KODE TRX', 'Kode Trx',
                'TRANSACTION CODE', 'TRX ID', 'ID TRANSAKSI', 'id_transaksi',
                'No Transaksi', 'NO TRANSAKSI', 'ORDER ID', 'Order ID'
            );
            if (!kodeTrx) { skipped++; continue; }

            const key = this.sanitizeKey(String(kodeTrx));
            if (!key) { skipped++; continue; }

            const email = String(this.col(row,
                'EMAIL', 'Email', 'email', 'ALAMAT EMAIL'
            ) || '').trim().toLowerCase();

            // Nilai numerik
            const tagihanUser   = this.toNum(this.col(row, 'TAGIHAN USER', 'Tagihan User', 'TAGIHAN', 'Tagihan', 'HARGA JUAL', 'Harga Jual', 'AMOUNT', 'Amount'));
            const cashbackUser  = this.toNum(this.col(row, 'CASHBACK USER', 'Cashback User', 'CASHBACK', 'Cashback', 'DISKON', 'Diskon'));
            const bayarMitra    = this.toNum(this.col(row, 'BAYAR MITRA', 'Bayar Mitra', 'HARGA BELI', 'Harga Beli', 'MODAL', 'Modal', 'COST', 'Cost'));

            // *** RUMUS PROFIT SIMASRIM ***
            const profit = (tagihanUser - cashbackUser) - bayarMitra;
            totalProfit += profit;

            const tanggalBeli = this.parseDate(this.col(row,
                'TANGGAL BELI', 'Tanggal Beli', 'TANGGAL', 'Tanggal', 'TANGGAL TRANSAKSI',
                'TGL TRANSAKSI', 'Date', 'DATE', 'Tgl'
            ));

            ppob_transactions[key] = {
                kode_transaksi: String(kodeTrx).trim(),
                email: email,
                email_key: this.sanitizeEmail(email) || '',
                tanggal_beli: tanggalBeli,
                kategori: String(this.col(row, 'KATEGORI', 'Kategori', 'CATEGORY', 'Category', 'JENIS', 'Jenis', 'TYPE', 'Type') || '').trim().toUpperCase(),
                nama_produk: String(this.col(row, 'NAMA PRODUK', 'Nama Produk', 'PRODUK', 'Produk', 'PRODUCT', 'Product', 'Item') || '').trim(),
                tagihan_user: tagihanUser,
                cashback_user: cashbackUser,
                bayar_mitra: bayarMitra,
                profit: profit,
                status: String(this.col(row, 'STATUS', 'Status', 'STATUS TRANSAKSI', 'Kondisi') || '').trim().toUpperCase(),
                uploaded_at: new Date().toISOString()
            };
        }

        onProgress(100, 'PPOB selesai diproses.');
        return {
            ppob_transactions,
            meta: {
                total: rows.length,
                imported: Object.keys(ppob_transactions).length,
                skipped,
                total_profit: totalProfit
            }
        };
    }

    // ================================================================
    // 3. PARSE DATA LOGISTIK (Opsional)
    //    Kolom kunci: ID USER, NAMA USER, AWB / RESI
    //    Output: { logistics: { resi_key: { ... } } }
    // ================================================================
    static async parseLogistik(file, onProgress) {
        onProgress(10, 'Membaca file Logistik...');
        const wb = await this.readWorkbook(file);
        const sheet = wb.Sheets[wb.SheetNames[0]];
        const rows = this.sheetToJson(sheet);

        onProgress(50, `Memproses ${rows.length} resi logistik...`);

        const logistics = {};
        let skipped = 0;

        for (const row of rows) {
            const resi = this.col(row,
                'AWB', 'RESI', 'AWB / RESI', 'Resi', 'No Resi', 'NO RESI',
                'Tracking Number', 'TRACKING', 'AWB NUMBER'
            );
            if (!resi) { skipped++; continue; }

            const key = this.sanitizeKey(String(resi));
            if (!key) { skipped++; continue; }

            const idUser   = String(this.col(row, 'ID USER', 'Id User', 'ID', 'User ID') || '').trim();
            const namaUser = String(this.col(row, 'NAMA USER', 'Nama User', 'NAMA', 'Nama', 'Name') || '').trim();
            const email    = String(this.col(row, 'EMAIL', 'Email', 'email') || '').trim().toLowerCase();

            logistics[key] = {
                resi: String(resi).trim(),
                id_user: idUser,
                nama_user: namaUser,
                email: email,
                email_key: this.sanitizeEmail(email) || '',
                ekspedisi: String(this.col(row, 'EKSPEDISI', 'Ekspedisi', 'KURIR', 'Kurir', 'Courier', 'COURIER') || '').trim().toUpperCase(),
                status: String(this.col(row, 'STATUS', 'Status') || '').trim(),
                tanggal: this.parseDate(this.col(row, 'TANGGAL', 'Tanggal', 'TGL', 'DATE', 'Date')),
                uploaded_at: new Date().toISOString()
            };
        }

        onProgress(100, 'Logistik selesai diproses.');
        return { logistics, meta: { total: rows.length, imported: Object.keys(logistics).length, skipped } };
    }

    // ================================================================
    // UTIL: Format Rupiah
    // ================================================================
    static formatRupiah(num) {
        if (isNaN(num)) return 'Rp 0';
        return 'Rp ' + Math.round(num).toLocaleString('id-ID');
    }
}
