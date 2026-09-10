/**
 * cleaner.js — Campaign SIMASRIM
 * Smart Regex Engine: Parse file mentah (CSV/XLSX), ekstrak nomor WA atau email,
 * sanitasi key, smart column guesser, deduplication check.
 */

class LeadsCleaner {

    // ================================================================
    // Master list Brand/Kategori resmi — hasil ekstraksi nyata dari semua
    // sheet /reference-sheets/ (13 brand ekspedisi bersih dari kolom Brand
    // Non-JNE + JNE dari nama file + 5 kode UTM + 3 kategori Seller dari
    // nama sheet + 3 institusi B2B dari nama sheet). Dipakai mode "Migrasi
    // Data Lama" supaya tidak auto-create brand baru sembarangan.
    // ================================================================
    static OFFICIAL_BRANDS = [
        'J&T Express', 'Lion Parcel', 'J&T Cargo', 'Wahana', 'Tiki', 'Ninja Xpress',
        'Pos Indonesia', 'SAPX', 'SiCepat Ekspress', 'Agen BJB Bisa', 'BRILINK',
        'BNI Agen46', 'Mandiri Agen', 'JNE',
        'UTM 1', 'UTM 2', 'UTM 3', 'UTM 4', 'UTM 5',
        'Konter', 'Fotokopi', 'Warung',
        'Koperasi', 'Kampus/LPTK', 'Perusahaan',
    ];

    static normalizeBrandKey(s) {
        return String(s || '').toLowerCase().replace(/[^a-z0-9]/g, '');
    }

    // Cocokkan teks brand mentah ke salah satu OFFICIAL_BRANDS (exact match
    // setelah normalize, lalu fallback substring). null kalau tidak cocok
    // sama sekali — baris itu HARUS masuk review queue, tidak auto-create.
    static matchOfficialBrand(raw) {
        const key = this.normalizeBrandKey(raw);
        if (!key) return null;
        for (const b of this.OFFICIAL_BRANDS) {
            if (this.normalizeBrandKey(b) === key) return b;
        }
        for (const b of this.OFFICIAL_BRANDS) {
            const bKey = this.normalizeBrandKey(b);
            if (bKey.length >= 4 && (key.includes(bKey) || bKey.includes(key))) return b;
        }
        return null;
    }

    // ================================================================
    // Konversi nomor HP ke format 628... (Primary Key Firebase WA)
    // ================================================================
    static normalizePhone(raw) {
        if (!raw && raw !== 0) return null;
        let s = String(raw).trim().replace(/[\s\-().+]/g, '');
        // Buang karakter non-digit
        s = s.replace(/\D/g, '');
        if (!s || s.length < 8) return null;

        if (s.startsWith('62')) {
            // sudah 62... pastikan panjang 10-15 digit total
            if (s.length < 10 || s.length > 16) return null;
            return s;
        }
        if (s.startsWith('08')) {
            s = '62' + s.slice(1);
            if (s.length < 10 || s.length > 16) return null;
            return s;
        }
        if (s.startsWith('8') && s.length >= 9) {
            s = '62' + s;
            if (s.length > 16) return null;
            return s;
        }
        // Bukan format HP Indonesia yang valid
        return null;
    }

    // ================================================================
    // Scan SEMUA sel dalam satu baris, cari nomor HP pertama yang valid
    // ================================================================
    static extractPhoneFromRow(row) {
        for (const val of Object.values(row)) {
            const phone = this.normalizePhone(val);
            if (phone) return phone;
        }
        return null;
    }

    // ================================================================
    // Scan semua sel dalam baris, cari email pertama yang valid
    // ================================================================
    static extractEmailFromRow(row) {
        const emailRegex = /[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}/;
        for (const val of Object.values(row)) {
            const s = String(val || '').trim();
            const match = s.match(emailRegex);
            if (match) return match[0].toLowerCase();
        }
        return null;
    }

    // ================================================================
    // Sanitasi email → Firebase key (mengganti karakter terlarang)
    // @ → _at_   . → _dot_   # $ [ ] / → _
    // ================================================================
    static sanitizeEmailKey(email) {
        if (!email) return null;
        return email.toLowerCase()
            .replace(/@/g, '_at_')
            .replace(/\./g, '_dot_')
            .replace(/[#$\[\]/]/g, '_')
            .replace(/\s+/g, '_')
            .substring(0, 200);
    }

    // ================================================================
    // Reverse sanitize email key → email asli (untuk display).
    // CATATAN: sanitizeEmailKey() meng-encode `#`/`$`/`[`/`]`/`/`/spasi jadi `_`
    // yang SAMA — informasi karakter aslinya sudah hilang (lossy, banyak-ke-satu),
    // jadi tidak mungkin dibalik 100% simetris tanpa mengubah skema encoding (yang
    // akan merusak SEMUA key email yang sudah kepalang tersimpan di Firebase).
    // Hanya `_at_`→`@` dan `_dot_`→`.` yang aman dibalik (unik, tidak ambigu);
    // sisanya sengaja dibiarkan sebagai `_` apa adanya — kasus ini jarang terjadi
    // karena alamat email valid pada praktiknya nyaris tidak pernah memuat karakter
    // itu di luar `@`/`.`.
    // ================================================================
    static reverseEmailKey(key) {
        if (!key) return key;
        return key.replace(/_at_/g, '@').replace(/_dot_/g, '.');
    }

    // ================================================================
    // Smart Column Guesser: Nama & Alamat dari header/content
    // ================================================================
    static guessColumns(headers, sampleRows) {
        const NAME_KEYS   = ['nama', 'name', 'toko', 'agen', 'tempat', 'merchant',
                             'title', 'usaha', 'instansi', 'perusahaan', 'outlet', 'took'];
        const ADDR_KEYS   = ['alamat', 'address', 'lokasi', 'location', 'jalan', 'jl',
                             'kota', 'city', 'daerah', 'wilayah', 'kelurahan', 'kecamatan', 'addr'];

        let nameCol = null, addrCol = null;

        for (const h of headers) {
            const hl = h.toLowerCase().trim();
            if (!nameCol && NAME_KEYS.some(k => hl.includes(k))) nameCol = h;
            if (!addrCol && ADDR_KEYS.some(k => hl.includes(k))) addrCol = h;
        }

        // Fallback: kalau tidak ada header cocok, cari kolom terpanjang non-numeric
        if (!nameCol && sampleRows.length > 0) {
            let bestLen = 0;
            for (const h of headers) {
                const vals = sampleRows.map(r => String(r[h] || ''));
                const avgLen = vals.reduce((a, v) => a + v.length, 0) / (vals.length || 1);
                const isNum  = vals.every(v => /^\d+$/.test(v.replace(/\s/g, '')));
                if (!isNum && avgLen > bestLen && avgLen < 100) {
                    bestLen = avgLen; nameCol = h;
                }
            }
        }

        // Fallback utk Alamat: kalau tidak ada header yang cocok kata kunci ADDR_KEYS,
        // ambil kolom teks terpanjang KEDUA (di luar nameCol) — pola umum file leads:
        // kolom pertama nama toko/agen, kolom berikutnya sering berisi alamat/deskripsi
        // lokasi walau headernya dikasih nama bebas (mis. "Domisili", "Detail Lokasi").
        // Tanpa ini, alamat selalu kosong untuk file yang headernya tidak umum.
        if (!addrCol && sampleRows.length > 0) {
            const candidates = [];
            for (const h of headers) {
                if (h === nameCol) continue;
                const vals = sampleRows.map(r => String(r[h] || ''));
                const avgLen = vals.reduce((a, v) => a + v.length, 0) / (vals.length || 1);
                const isNum  = vals.every(v => /^\d+$/.test(v.replace(/\s/g, '')));
                if (!isNum && avgLen >= 15 && avgLen < 150) candidates.push({ h, avgLen });
            }
            if (candidates.length) {
                candidates.sort((a, b) => b.avgLen - a.avgLen);
                addrCol = candidates[0].h;
            }
        }

        return { nameCol, addrCol };
    }

    // ================================================================
    // Baca workbook SheetJS → array rows
    // ================================================================
    static readWorkbook(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                try {
                    const wb = XLSX.read(new Uint8Array(e.target.result), {
                        type: 'array', cellDates: false, cellNF: true, raw: true
                    });
                    let rows = XLSX.utils.sheet_to_json(wb.Sheets[wb.SheetNames[0]], { defval: '' });
                    if (rows.length === 0) {
                        rows = XLSX.utils.sheet_to_json(wb.Sheets[wb.SheetNames[0]], { defval: '', range: 1 });
                    }
                    resolve(rows);
                } catch (err) { reject(err); }
            };
            reader.onerror = reject;
            reader.readAsArrayBuffer(file);
        });
    }

    // ================================================================
    // MAIN: Proses file mentah → { clean[], rejected[], headers[] }
    // mode: 'wa' | 'email'
    // segmentInfo: { area, brand, pic_campaign, pic_garap }
    // onProgress: (pct, label) => void
    // ================================================================
    static async processFile(file, mode, segmentInfo, onProgress) {
        onProgress(5, 'Membaca file...');
        let rows;
        try {
            rows = await this.readWorkbook(file);
        } catch (e) {
            throw new Error('File tidak valid atau rusak. Coba format lain.');
        }

        if (rows.length === 0) throw new Error('File kosong atau tidak ada data.');
        onProgress(20, `Ditemukan ${rows.length} baris mentah...`);

        const headers = rows.length > 0 ? Object.keys(rows[0]) : [];
        const { nameCol, addrCol } = this.guessColumns(headers, rows.slice(0, 20));

        const clean    = [];
        const rejected = [];
        const now      = new Date().toISOString().split('T')[0];

        onProgress(30, 'Menerapkan Smart Regex Engine...');

        for (let i = 0; i < rows.length; i++) {
            if (i % 200 === 0) {
                const pct = 30 + Math.round((i / rows.length) * 55);
                onProgress(pct, `Memproses baris ${i + 1} / ${rows.length}...`);
            }
            const row = rows[i];

            let primaryKey, contactDisplay;
            // Kontak kedua (opsional) — kanal satunya, kalau baris ini kebetulan punya
            // WA dan Email dua-duanya (lihat Perbaikan 5: lead bisa "nyambung" keduanya
            // tanpa mengubah _key/tree utama yang tetap berbasis `mode`).
            let secondaryField = null, secondaryValue = null;

            if (mode === 'wa') {
                const phone = this.extractPhoneFromRow(row);
                if (!phone) { rejected.push({ row: i + 2, reason: 'Tidak ada nomor WA valid', data: row }); continue; }
                primaryKey     = phone;
                contactDisplay = phone;
                const email = this.extractEmailFromRow(row);
                if (email) { secondaryField = 'email'; secondaryValue = email; }
            } else {
                const email = this.extractEmailFromRow(row);
                if (!email) { rejected.push({ row: i + 2, reason: 'Tidak ada email valid', data: row }); continue; }
                primaryKey     = this.sanitizeEmailKey(email);
                contactDisplay = email;
                const phone = this.extractPhoneFromRow(row);
                if (phone) { secondaryField = 'phone'; secondaryValue = phone; }
            }

            const nama   = nameCol ? String(row[nameCol] || '').trim() : '';
            const alamat = addrCol ? String(row[addrCol] || '').trim() : '';

            const cleanRow = {
                _key:            primaryKey,
                contact_display: contactDisplay,
                nama_agen:       nama,
                area:            segmentInfo.area || '',
                provinsi:        segmentInfo.provinsi || '',
                alamat:          alamat,
                brand:           segmentInfo.brand || '',
                produk:          segmentInfo.produk || '',
                pic_campaign:    segmentInfo.pic_campaign || '',
                pic_garap:       segmentInfo.pic_garap || '',
                tahap:           '',
                tanggal_kirim:   [],
                respon:          '',
                aksi_lanjutan:   '',
                keterangan:      '',
                tipe_leads:      'New',
                created_at:      now,
                updated_at:      now,
            };
            if (secondaryField) cleanRow[secondaryField] = secondaryValue;
            clean.push(cleanRow);
        }

        onProgress(90, 'Finalisasi...');
        return { clean, rejected, headers, nameCol, addrCol, total: rows.length };
    }

    // ================================================================
    // Deteksi kandidat lead yang sama antara tree WA & Email — nama_agen +
    // area cocok persis (setelah dinormalisasi kapital/spasi), dipakai upload
    // wizard untuk MENAWARKAN penggabungan jadi kontak WA+Email (lihat
    // findCrossTreeMatches di bawah). HANYA mendeteksi & melaporkan kandidat,
    // TIDAK menggabungkan otomatis — keputusan gabung/pisah tetap di user,
    // karena kecocokan nama+area tetap bisa kebetulan 2 bisnis berbeda.
    // ================================================================
    static normalizeMatchText(s) {
        return String(s || '').trim().toLowerCase().replace(/\s+/g, ' ');
    }

    // freshRows: baris baru dari upload (mode tertentu, belum di-commit).
    // otherTreeLeads: object {key: leadData} dari tree SEBALIKNYA (kalau upload
    // mode WA, ini leads_email; kalau mode Email, ini leads_wa).
    // Return: [{ row, matchedKey, matchedLead }] — baris yg nama+area-nya cocok
    // persis dengan 1 lead di tree sebaliknya. Baris dengan nama_agen/area kosong
    // TIDAK pernah dicocokkan (terlalu longgar, risiko gabung salah terlalu tinggi).
    static findCrossTreeMatches(freshRows, otherTreeLeads) {
        const matches = [];
        const otherEntries = Object.entries(otherTreeLeads || {});
        for (const row of freshRows) {
            const rowNama = this.normalizeMatchText(row.nama_agen);
            const rowArea = this.normalizeMatchText(row.area);
            if (!rowNama || !rowArea) continue;
            const found = otherEntries.find(([, lead]) =>
                this.normalizeMatchText(lead.nama_agen) === rowNama &&
                this.normalizeMatchText(lead.area) === rowArea
            );
            if (found) matches.push({ row, matchedKey: found[0], matchedLead: found[1] });
        }
        return matches;
    }

    // ================================================================
    // Deduplication: cocokkan primary keys dengan existingKeys dari Firebase
    // ================================================================
    static deduplicate(cleanRows, existingKeys) {
        const existingSet = new Set(existingKeys);
        const fresh = [], dupes = [];
        for (const row of cleanRows) {
            if (existingSet.has(row._key)) {
                dupes.push(row);
            } else {
                fresh.push(row);
            }
        }
        return { fresh, dupes };
    }

    // ================================================================
    // Convert clean rows → Firebase object { key: data }
    // ================================================================
    static toFirebaseObject(rows, mode, includeDupes = false, dupeRows = []) {
        const target = includeDupes ? [...rows, ...dupeRows] : rows;
        const obj = {};
        for (const r of target) {
            const { _key, contact_display, ...data } = r;
            // Buang semua field metadata internal proses upload (mis. _source_sheet,
            // _needsBrandReview, _raw_brand) — cuma dipakai selama wizard, tidak boleh
            // ikut nempel permanen ke data produksi di Firebase.
            Object.keys(data).forEach(k => { if (k.startsWith('_')) delete data[k]; });
            if (mode === 'email') {
                data.email = contact_display;
            } else {
                data.phone = contact_display;
            }
            data.updated_at = new Date().toISOString().split('T')[0];
            obj[_key] = data;
        }
        return obj;
    }

    // ================================================================
    // MODE "MIGRASI DATA LAMA" — baca SEMUA sheet sekaligus (bukan cuma
    // sheet pertama), tiap sheet posisi header barisnya bisa beda-beda.
    // ================================================================
    static readWorkbookAllSheets(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                try {
                    const wb = XLSX.read(new Uint8Array(e.target.result), {
                        type: 'array', cellDates: false, cellNF: true, raw: true
                    });
                    resolve(wb);
                } catch (err) { reject(err); }
            };
            reader.onerror = reject;
            reader.readAsArrayBuffer(file);
        });
    }

    // Baris pertama (dalam 10 baris pertama) yang punya >=2 sel terisi
    // dianggap baris header — beberapa sheet lama headernya tidak selalu
    // di baris pertama (ada banner judul di atasnya).
    static detectHeaderRow(rowsArr) {
        for (let i = 0; i < Math.min(rowsArr.length, 10); i++) {
            const nonEmpty = (rowsArr[i] || []).filter(c => String(c).trim() !== '').length;
            if (nonEmpty >= 2) return i;
        }
        return 0;
    }

    static rowsArrayToObjects(rowsArr, headerRowIdx) {
        const headers = (rowsArr[headerRowIdx] || []).map((h, i) => String(h).trim() || `Column ${i + 1}`);
        const objects = [];
        for (let i = headerRowIdx + 1; i < rowsArr.length; i++) {
            const r = rowsArr[i];
            if (!r || r.every(c => String(c).trim() === '')) continue;
            const obj = {};
            headers.forEach((h, idx) => { obj[h] = r[idx] !== undefined ? r[idx] : ''; });
            objects.push(obj);
        }
        return { headers, objects };
    }

    // Smart guesser diperluas — bukan cuma Nama & Alamat seperti guessColumns(),
    // tapi juga Brand/Kota/Tahap/Tanggal Kirim/Respon/Aksi Lanjutan/Keterangan/
    // Tipe Leads/Email, supaya histori follow-up dari data lama tidak hilang.
    static guessExtendedColumns(headers) {
        const find = (keys) => headers.find(h => keys.some(k => h.toLowerCase().includes(k))) || null;
        return {
            nameCol:       find(['nama', 'agen', 'toko', 'institusi', 'perusahaan', 'universitas']),
            alamatCol:     find(['alamat', 'address', 'jalan']),
            kotaCol:       find(['kota', 'wilayah', 'daerah', 'city']),
            brandCol:      find(['brand']),
            emailCol:      find(['email']),
            tahapCol:      find(['tahap', 'status']),
            tglKirimCol:   find(['tanggal kirim', 'tanggal', 'follow-up', 'follow up']),
            responCol:     find(['respon', 'hasil']),
            aksiCol:       find(['aksi lanjutan', 'aksi']),
            keteranganCol: find(['keterangan', 'catatan']),
            tipeLeadsCol:  find(['tipe leads', 'hot lead']),
        };
    }

    // Tebak Brand/Area default dari NAMA SHEET (dipakai kalau sheet tidak
    // punya kolom Brand sama sekali, mis. file JNE per-wilayah atau file
    // Seller/B2B institusi yang brand/kategorinya cuma tersirat di nama sheet).
    static deriveDefaultsFromSheetName(sheetName) {
        // Pakai regex global di awal string (bukan sekali replace) supaya "Copy of Copy of X"
        // (ada sheet yang di-copy dua kali) tetap bersih jadi "X", bukan nyisa "Copy of X".
        let name = String(sheetName || '').trim();
        while (/^copy of\s+/i.test(name)) name = name.replace(/^copy of\s+/i, '').trim();
        const sellerPrefixes = ['Konter', 'Fotokopi', 'Warung'];
        for (const p of sellerPrefixes) {
            if (name.toLowerCase().startsWith(p.toLowerCase())) {
                return { brand: p, area: name.slice(p.length).trim() || null };
            }
        }
        if (/koperasi/i.test(name)) return { brand: 'Koperasi', area: null };
        if (/lptk|ppg|kampus|universit/i.test(name)) return { brand: 'Kampus/LPTK', area: null };
        if (/perusahaan/i.test(name)) return { brand: 'Perusahaan', area: null };
        // Sisanya (sheet per-wilayah file JNE/Non-JNE): nama sheet = area,
        // brand diambil dari kolom Brand kalau ada (di-resolve saat proses baris).
        return { brand: null, area: name };
    }

    // Analisis cepat 1 sheet untuk ditampilkan di checklist UI (tanpa proses
    // penuh) — dipakai supaya user bisa lihat & centang/uncheck sheet mana
    // yang mau dimigrasikan sebelum apapun diproses.
    static getSheetPreview(wb, sheetName) {
        const rowsArr = XLSX.utils.sheet_to_json(wb.Sheets[sheetName], { header: 1, defval: '', raw: true });
        const headerRowIdx = this.detectHeaderRow(rowsArr);
        const headers = (rowsArr[headerRowIdx] || []).map(h => String(h).trim());
        const colMap = this.guessExtendedColumns(headers);
        const sheetDefaults = this.deriveDefaultsFromSheetName(sheetName);
        const rowCount = Math.max(0, rowsArr.length - headerRowIdx - 1);
        const looksLikeLeads = !!(colMap.nameCol && rowCount > 0);
        return { sheetName, headerRowIdx, headers, colMap, sheetDefaults, rowCount, looksLikeLeads };
    }

    // Proses 1 sheet penuh → { clean[], ambiguousBrand[], rejected[] }.
    // clean = brand sudah cocok/ke-default salah satu OFFICIAL_BRANDS (atau
    // memang tidak ada info brand sama sekali). ambiguousBrand = ada teks
    // brand tapi tidak cocok satupun master list — HARUS direview manual,
    // tidak auto-commit (sesuai permintaan: jangan auto-create kategori baru).
    static processMigrationSheet(wb, sheetName, colMap, sheetDefaults, mode) {
        const rowsArr = XLSX.utils.sheet_to_json(wb.Sheets[sheetName], { header: 1, defval: '', raw: true });
        const headerRowIdx = this.detectHeaderRow(rowsArr);
        const { objects } = this.rowsArrayToObjects(rowsArr, headerRowIdx);

        const clean = [], ambiguousBrand = [], rejected = [];
        const now = new Date().toISOString().split('T')[0];

        objects.forEach((row, i) => {
            let contactKey, contactDisplay;
            // Kontak kedua (opsional) — kanal satunya, kalau baris ini kebetulan punya
            // WA dan Email dua-duanya (lihat Perbaikan 5).
            let secondaryField = null, secondaryValue = null;

            // CATATAN: kontak SEKUNDER (kanal tambahan) SENGAJA tidak lagi dideteksi
            // otomatis lewat pemindaian kolom bebas (extractPhoneFromRow/extractEmailFromRow
            // scan SEMUA kolom row tanpa mapping eksplisit) — dulu ini menyebabkan kolom
            // lain yang kebetulan berupa angka mirip nomor HP (ID, kode pos, no. invoice,
            // dst) salah kesimpan sebagai nomor WA milik lead Email (ditemukan: ~99% lead
            // Email hasil migrasi kena false-positive). Dual-contact yang SAH sekarang HANYA
            // terbentuk lewat fitur cross-merge (pencocokan nama+area antar tree, direview
            // manual user sebelum commit) — bukan tebakan dari kolom sembarang di sini.
            if (mode === 'email') {
                const emailRaw = colMap.emailCol ? String(row[colMap.emailCol] || '').trim() : '';
                const emailValidRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                const email = emailRaw && emailValidRegex.test(emailRaw)
                    ? emailRaw.toLowerCase()
                    : this.extractEmailFromRow(row);
                if (!email) { rejected.push({ sheet: sheetName, row: i, reason: 'Tidak ada email valid' }); return; }
                contactKey = this.sanitizeEmailKey(email);
                contactDisplay = email;
            } else {
                const phone = this.extractPhoneFromRow(row);
                if (!phone) { rejected.push({ sheet: sheetName, row: i, reason: 'Tidak ada nomor WA valid' }); return; }
                contactKey = phone;
                contactDisplay = phone;
                // Email sekunder cuma dipakai kalau memang ada kolom Email yang eksplisit
                // ter-mapping (colMap.emailCol) — bukan tebakan dari kolom bebas manapun.
                const email = colMap.emailCol ? String(row[colMap.emailCol] || '').trim().toLowerCase() : '';
                if (email && /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) { secondaryField = 'email'; secondaryValue = email; }
            }

            const rawBrand = colMap.brandCol ? String(row[colMap.brandCol] || '').trim() : '';
            const brandCandidate = rawBrand || sheetDefaults.brand || '';
            const matched = brandCandidate ? this.matchOfficialBrand(brandCandidate) : null;

            const nama    = colMap.nameCol       ? String(row[colMap.nameCol] || '').trim() : '';
            const alamat  = colMap.alamatCol     ? String(row[colMap.alamatCol] || '').trim() : '';
            const kota    = colMap.kotaCol       ? String(row[colMap.kotaCol] || '').trim() : (sheetDefaults.area || '');
            const tahap   = colMap.tahapCol      ? String(row[colMap.tahapCol] || '').trim() : '';
            const tglRaw  = colMap.tglKirimCol   ? String(row[colMap.tglKirimCol] || '').trim() : '';
            const tanggal_kirim = tglRaw ? tglRaw.split(',').map(s => s.trim()).filter(Boolean) : [];
            const respon  = colMap.responCol     ? String(row[colMap.responCol] || '').trim() : '';
            const aksi    = colMap.aksiCol       ? String(row[colMap.aksiCol] || '').trim() : '';
            const keterangan = colMap.keteranganCol ? String(row[colMap.keteranganCol] || '').trim() : '';
            const tipeRaw = colMap.tipeLeadsCol  ? String(row[colMap.tipeLeadsCol] || '').trim() : '';

            const record = {
                _key: contactKey,
                contact_display: contactDisplay,
                nama_agen: nama,
                area: kota,
                provinsi: sheetDefaults.provinsi || '',
                alamat: alamat,
                brand: matched || brandCandidate,
                produk: sheetDefaults.produk || '',
                pic_campaign: sheetDefaults.pic_campaign || '',
                pic_garap: sheetDefaults.pic_garap || '',
                tahap,
                tanggal_kirim,
                respon,
                aksi_lanjutan: aksi,
                keterangan,
                tipe_leads: tipeRaw || 'New',
                created_at: now,
                updated_at: now,
                _source_sheet: sheetName,
                ...(secondaryField ? { [secondaryField]: secondaryValue } : {}),
            };

            if (brandCandidate && !matched) {
                ambiguousBrand.push({ ...record, _raw_brand: brandCandidate });
            } else {
                clean.push(record);
            }
        });

        return { clean, ambiguousBrand, rejected, total: objects.length };
    }
}
