/**
 * filter.js — Campaign SIMASRIM
 * Multi-filter kombinasi logic untuk Master Leads table + lookup Kota/Kab -> Provinsi
 * (dipakai Master Leads maupun leadgen supaya 1 sumber kebenaran, bukan hardcode berulang).
 */

// ================================================================
// Sentinel dipakai bareng di seluruh app (filter dropdown, Cari & Ganti Massal)
// buat merujuk "field ini kosong/belum diisi" tanpa bentrok sama nilai asli manapun.
// ================================================================
const LEADS_EMPTY_SENTINEL = '__EMPTY__';

const LeadsFilter = {

    // ================================================================
    // Terapkan semua filter aktif ke array leads
    // filters: { search, area, brand, produk, provinsi, pic, tipe, tahap, dateFrom, dateTo }
    // Nilai filter === LEADS_EMPTY_SENTINEL berarti "cari yang field-nya kosong".
    // dateFrom/dateTo (format YYYY-MM-DD) menyaring berdasar l.updated_at — dipakai
    // filter Dashboard (Master Leads tidak pakai ini, cuma filter kategori).
    // ================================================================
    apply(leads, filters) {
        let result = leads;

        const { search, area, brand, produk, provinsi, pic, tipe, tahap, dateFrom, dateTo } = filters;
        // Case-insensitive + trim — supaya "Bandung" dan "bandung " (variasi kapitalisasi/
        // spasi hasil edit manual) dianggap grup yang sama, bukan leads jadi "hilang" dari
        // hasil filter gara-gara perbedaan sepele yang tidak terlihat mata.
        const norm = (s) => String(s || '').toLowerCase().trim();
        const matchField = (val, field) => val === LEADS_EMPTY_SENTINEL ? !field : norm(field) === norm(val);

        if (search) {
            const q = search.toLowerCase();
            result = result.filter(l => {
                // Lead sekarang bisa punya WA & Email sekaligus (lihat Perbaikan 5) — cek
                // phone/email/contact_display SATU-SATU, bukan digabung lewat `||` (itu bikin
                // pencarian lewat kontak kedua tidak pernah ketemu kalau kontak utama juga terisi,
                // apapun mode-nya karena `contact_display` sama dengan salah satu dari phone/email).
                const contactPhone   = (l.phone || '').toLowerCase();
                const contactEmail   = (l.email || '').toLowerCase();
                const contactDisplay = (l.contact_display || '').toLowerCase();
                const nama    = (l.nama_agen || '').toLowerCase();
                const brd     = (l.brand || '').toLowerCase();
                const prod    = (l.produk || '').toLowerCase();
                const ar      = (l.area || '').toLowerCase();
                const prov    = (l.provinsi || '').toLowerCase();
                const picg    = (l.pic_garap || '').toLowerCase();
                const picc    = (l.pic_campaign || '').toLowerCase();
                const ket     = (l.keterangan || '').toLowerCase();
                return contactPhone.includes(q) || contactEmail.includes(q) || contactDisplay.includes(q)
                    || nama.includes(q) || brd.includes(q) || prod.includes(q)
                    || ar.includes(q) || prov.includes(q) || picg.includes(q) || picc.includes(q) || ket.includes(q);
            });
        }

        if (area)     result = result.filter(l => matchField(area, l.area));
        if (brand)    result = result.filter(l => matchField(brand, l.brand));
        if (produk)   result = result.filter(l => matchField(produk, l.produk));
        if (provinsi) result = result.filter(l => matchField(provinsi, l.provinsi));
        if (pic)      result = result.filter(l => matchField(pic, l.pic_garap));
        if (tipe)  result = result.filter(l => matchField(tipe, l.tipe_leads));
        if (tahap) result = result.filter(l => matchField(tahap, l.tahap));
        if (dateFrom) result = result.filter(l => l.updated_at && l.updated_at >= dateFrom);
        if (dateTo)   result = result.filter(l => l.updated_at && l.updated_at <= dateTo);

        return result;
    },

    // ================================================================
    // Normalisasi value kategorikal (case/spasi-insensitive) — dipakai bareng
    // buat dedup dropdown maupun grouping/agregasi (chart, leaderboard), supaya
    // "sapx" dan "SAPX" konsisten dianggap 1 grup di SELURUH aplikasi, bukan cuma
    // pas filter-matching (itu sudah dibenahi sebelumnya di apply()/matchField).
    // ================================================================
    normKey(v) {
        return String(v || '').toLowerCase().trim();
    },

    // Kelompokkan leads berdasar field kategorikal (brand/area/pic_garap/dst),
    // case/spasi-insensitive — key Map = versi ternormalisasi, tapi tiap grup
    // menyimpan `label` (nilai ASLI kemunculan pertama) buat ditampilkan ke user.
    groupByField(leads, field) {
        const map = new Map(); // normKey -> { label, items: [] }
        leads.forEach(l => {
            const raw = l[field];
            if (!raw) return;
            const key = this.normKey(raw);
            if (!map.has(key)) map.set(key, { label: raw, items: [] });
            map.get(key).items.push(l);
        });
        return map;
    },

    // ================================================================
    // Build unique values untuk dropdown filter dari dataset, plus flag apakah
    // ada leads dengan field itu kosong (buat opsi "(Kosong)" di dropdown).
    // ================================================================
    buildOptions(leads) {
        // Dedup case/spasi-insensitive ("sapx" & "SAPX" jadi 1 opsi, bukan 2) —
        // reuse groupByField, ambil label representatif tiap grup.
        const uniq = (field) => [...this.groupByField(leads, field).values()]
            .map(g => g.label)
            .sort((a, b) => String(a).localeCompare(String(b), 'id'));
        const hasEmpty = (field) => leads.some(l => !l[field]);
        return {
            areas: uniq('area'), areasHasEmpty: hasEmpty('area'),
            brands: uniq('brand'), brandsHasEmpty: hasEmpty('brand'),
            produks: uniq('produk'), produksHasEmpty: hasEmpty('produk'),
            provinsis: uniq('provinsi'), provinsisHasEmpty: hasEmpty('provinsi'),
            pics: uniq('pic_garap'), picsHasEmpty: hasEmpty('pic_garap'),
            tahaps: uniq('tahap'), tahapsHasEmpty: hasEmpty('tahap'),
        };
    },

    // ================================================================
    // Populate select element dengan options. hasEmpty=true nambah opsi
    // "(Kosong)" di paling atas (pakai LEADS_EMPTY_SENTINEL sebagai value).
    // ================================================================
    populateSelect(selectEl, values, allLabel = 'Semua', hasEmpty = false) {
        const current = selectEl.value;
        selectEl.innerHTML = `<option value="">${allLabel}</option>` +
            (hasEmpty ? `<option value="${LEADS_EMPTY_SENTINEL}">(Kosong / belum diisi)</option>` : '');
        for (const v of values) {
            const opt = document.createElement('option');
            opt.value = opt.textContent = v;
            selectEl.appendChild(opt);
        }
        if (current === LEADS_EMPTY_SENTINEL || values.includes(current)) selectEl.value = current;
    },

    // ================================================================
    // Lookup Kota/Kab (Sub Area) -> Provinsi (Area Utama). Dipakai Master
    // Leads (rapikan data) maupun leadgen (auto-isi Area Utama pas ngetik Kota).
    // null kalau tidak dikenali — sengaja tidak menebak.
    // ================================================================
    lookupProvince(subArea) {
        const raw = String(subArea || '').trim();
        if (!raw) return null;
        const key = raw.toLowerCase().replace(/^(kab\.?|kabupaten|kota)\s+/i, '').trim();
        if (INFORMAL_REGION_NAMES.includes(raw.toLowerCase())) return raw;
        if (CITY_TO_PROVINCE[key]) return CITY_TO_PROVINCE[key];
        if (CITY_TO_PROVINCE[raw.toLowerCase()]) return CITY_TO_PROVINCE[raw.toLowerCase()];
        if (PROVINCE_NAME_ALIASES[raw.toLowerCase()]) return PROVINCE_NAME_ALIASES[raw.toLowerCase()];
        return null;
    },
};


// ================================================================
// Data lookup Kota/Kab -> Provinsi, dibangun khusus utk nilai Sub Area yang
// ADA di data leads kita (bukan tabel 514 kabupaten Indonesia lengkap) — cukup
// cover data existing + kota-kota umum yang mungkin dicari lewat scraper nanti.
// ================================================================
const CITY_TO_PROVINCE = {
    "aceh": "Aceh",
    "banda aceh": "Aceh",
    "aceh singkil": "Aceh",
    "aceh tamiang": "Aceh",
    "aceh jaya": "Aceh",
    "aceh barat daya": "Aceh",
    "sabang": "Aceh",
    "langsa": "Aceh",
    "bireuen": "Aceh",
    "gayo lues": "Aceh",
    "pidie jaya": "Aceh",
    "bener meriah": "Aceh",
    "medan": "Sumatera Utara",
    "deli serdang": "Sumatera Utara",
    "binjai": "Sumatera Utara",
    "dairi": "Sumatera Utara",
    "batu bara": "Sumatera Utara",
    "padang sidempuan": "Sumatera Utara",
    "tapanuli utara": "Sumatera Utara",
    "labuhanbatu": "Sumatera Utara",
    "karo": "Sumatera Utara",
    "humbang hasundutan": "Sumatera Utara",
    "samosir": "Sumatera Utara",
    "nias": "Sumatera Utara",
    "toba": "Sumatera Utara",
    "padang lawas": "Sumatera Utara",
    "padang lawas utara": "Sumatera Utara",
    "mandailing natal": "Sumatera Utara",
    "sibolga": "Sumatera Utara",
    "pematangsiantar": "Sumatera Utara",
    "serdang bedagai": "Sumatera Utara",
    "labuhanbatu utara": "Sumatera Utara",
    "asahan": "Sumatera Utara",
    "sumut": "Sumatera Utara",
    "sumatra utara": "Sumatera Utara",
    "tapanuli tengah": "Sumatera Utara",
    "padang": "Sumatera Barat",
    "bukittinggi": "Sumatera Barat",
    "payakumbuh": "Sumatera Barat",
    "payakumbuah": "Sumatera Barat",
    "solok": "Sumatera Barat",
    "solok selatan": "Sumatera Barat",
    "tanah datar": "Sumatera Barat",
    "sijunjung": "Sumatera Barat",
    "agam": "Sumatera Barat",
    "pesisir selatan": "Sumatera Barat",
    "pasaman": "Sumatera Barat",
    "pasaman barat": "Sumatera Barat",
    "sumbar": "Sumatera Barat",
    "pekanbaru": "Riau",
    "kampar": "Riau",
    "bengkalis": "Riau",
    "indragiri hilir": "Riau",
    "indragiri hulu": "Riau",
    "rokan hilir": "Riau",
    "rokah hilir": "Riau",
    "kuantan singingi": "Riau",
    "siak": "Riau",
    "batam": "Kepulauan Riau",
    "tanjung pinang": "Kepulauan Riau",
    "karimun": "Kepulauan Riau",
    "bintan": "Kepulauan Riau",
    "natuna": "Kepulauan Riau",
    "lingga": "Kepulauan Riau",
    "kep. riau": "Kepulauan Riau",
    "jambi": "Jambi",
    "kota jambi": "Jambi",
    "muaro": "Jambi",
    "tanjab barat": "Jambi",
    "tebo": "Jambi",
    "bungo": "Jambi",
    "sungai penuh": "Jambi",
    "palembang": "Sumatera Selatan",
    "ogan komering ulu": "Sumatera Selatan",
    "ogan komering ilir": "Sumatera Selatan",
    "muara enim": "Sumatera Selatan",
    "banyuasin": "Sumatera Selatan",
    "musi rawas": "Sumatera Selatan",
    "musi rawas utara": "Sumatera Selatan",
    "musi banyuasin": "Sumatera Selatan",
    "lahat": "Sumatera Selatan",
    "empat lawang": "Sumatera Selatan",
    "prabumulih": "Sumatera Selatan",
    "penukal abab lematang ilir": "Sumatera Selatan",
    "penukai abab lematang ilir": "Sumatera Selatan",
    "ogan ilir": "Sumatera Selatan",
    "ogan komering ulu timur": "Sumatera Selatan",
    "ogan komering ulu selatan": "Sumatera Selatan",
    "sumsel": "Sumatera Selatan",
    "pagar alam": "Sumatera Selatan",
    "pangkal pinang": "Kepulauan Bangka Belitung",
    "bangka": "Kepulauan Bangka Belitung",
    "bangka selatan": "Kepulauan Bangka Belitung",
    "bangka barat": "Kepulauan Bangka Belitung",
    "bangka tengah": "Kepulauan Bangka Belitung",
    "belitung": "Kepulauan Bangka Belitung",
    "belitung timur": "Kepulauan Bangka Belitung",
    "bangka belitung": "Kepulauan Bangka Belitung",
    "bengkulu": "Bengkulu",
    "bengkulu selatan": "Bengkulu",
    "bengkulu utara": "Bengkulu",
    "bengkulu tengah": "Bengkulu",
    "kaur": "Bengkulu",
    "seluma": "Bengkulu",
    "rejang lebong": "Bengkulu",
    "bandar lampung": "Lampung",
    "lampung selatan": "Lampung",
    "lampung tengah": "Lampung",
    "lampung utara": "Lampung",
    "lampung barat": "Lampung",
    "way kanan": "Lampung",
    "pesisir barat": "Lampung",
    "pesawaran": "Lampung",
    "tanggamus": "Lampung",
    "kota metro": "Lampung",
    "pringsewu": "Lampung",
    "metro": "Lampung",
    "jakarta": "DKI Jakarta",
    "jakarta barat": "DKI Jakarta",
    "jakarta utara": "DKI Jakarta",
    "jakarta timur": "DKI Jakarta",
    "jakarta selatan": "DKI Jakarta",
    "jakarta pusat": "DKI Jakarta",
    "jakut": "DKI Jakarta",
    "jaksel": "DKI Jakarta",
    "jakbar": "DKI Jakarta",
    "jaktim": "DKI Jakarta",
    "jakpus": "DKI Jakarta",
    "kepulauan seribu": "DKI Jakarta",
    "jakarta selatan, dki jakarta": "DKI Jakarta",
    "bogor": "Jawa Barat",
    "bogor selatan": "Jawa Barat",
    "bogor barat": "Jawa Barat",
    "bandung": "Jawa Barat",
    "bandung raya": "Jawa Barat",
    "bekasi": "Jawa Barat",
    "cirebon": "Jawa Barat",
    "garut": "Jawa Barat",
    "sukabumi": "Jawa Barat",
    "cianjur": "Jawa Barat",
    "karawang": "Jawa Barat",
    "purwakarta": "Jawa Barat",
    "subang": "Jawa Barat",
    "tasikmalaya": "Jawa Barat",
    "tasik": "Jawa Barat",
    "ciamis": "Jawa Barat",
    "kuningan": "Jawa Barat",
    "indramayu": "Jawa Barat",
    "majalengka": "Jawa Barat",
    "sumedang": "Jawa Barat",
    "bandung barat": "Jawa Barat",
    "pangandaran": "Jawa Barat",
    "cimahi": "Jawa Barat",
    "depok": "Jawa Barat",
    "kab bogor": "Jawa Barat",
    "kab.garut": "Jawa Barat",
    "cikarang": "Jawa Barat",
    "semarang": "Jawa Tengah",
    "solo": "Jawa Tengah",
    "surakarta": "Jawa Tengah",
    "solo raya": "Jawa Tengah",
    "banyumas": "Jawa Tengah",
    "banyumas raya": "Jawa Tengah",
    "cilacap": "Jawa Tengah",
    "purbalingga": "Jawa Tengah",
    "banjarnegara": "Jawa Tengah",
    "kebumen": "Jawa Tengah",
    "wonosobo": "Jawa Tengah",
    "magelang": "Jawa Tengah",
    "temanggung": "Jawa Tengah",
    "kedu raya": "Jawa Tengah",
    "keduraya": "Jawa Tengah",
    "batang": "Jawa Tengah",
    "tegal": "Jawa Tengah",
    "brebes": "Jawa Tengah",
    "pekalongan": "Jawa Tengah",
    "pemalang": "Jawa Tengah",
    "kudus": "Jawa Tengah",
    "jepara": "Jawa Tengah",
    "pati": "Jawa Tengah",
    "rembang": "Jawa Tengah",
    "blora": "Jawa Tengah",
    "grobogan": "Jawa Tengah",
    "boyolali": "Jawa Tengah",
    "sragen": "Jawa Tengah",
    "wonogiri": "Jawa Tengah",
    "klaten": "Jawa Tengah",
    "karanganyar": "Jawa Tengah",
    "salatiga": "Jawa Tengah",
    "demak": "Jawa Tengah",
    "kendal": "Jawa Tengah",
    "purworejo": "Jawa Tengah",
    "tamanggung": "Jawa Tengah",
    "solo surakarta": "Jawa Tengah",
    "purwokerto": "Jawa Tengah",
    "yogyakarta": "DI Yogyakarta",
    "yogya": "DI Yogyakarta",
    "jogja": "DI Yogyakarta",
    "jogjakarta": "DI Yogyakarta",
    "yogya karta": "DI Yogyakarta",
    "sleman": "DI Yogyakarta",
    "bantul": "DI Yogyakarta",
    "gunungkidul": "DI Yogyakarta",
    "kulon progo": "DI Yogyakarta",
    "surabaya": "Jawa Timur",
    "malang": "Jawa Timur",
    "malang raya": "Jawa Timur",
    "kediri": "Jawa Timur",
    "madiun": "Jawa Timur",
    "jember": "Jawa Timur",
    "madura": "Jawa Timur",
    "sidoarjo": "Jawa Timur",
    "lamongan": "Jawa Timur",
    "tuban": "Jawa Timur",
    "gresik": "Jawa Timur",
    "banyuwangi": "Jawa Timur",
    "bojonegoro": "Jawa Timur",
    "ponorogo": "Jawa Timur",
    "pacitan": "Jawa Timur",
    "blitar": "Jawa Timur",
    "tulungagung": "Jawa Timur",
    "trenggalek": "Jawa Timur",
    "lumajang": "Jawa Timur",
    "probolinggo": "Jawa Timur",
    "nganjuk": "Jawa Timur",
    "magetan": "Jawa Timur",
    "kota batu": "Jawa Timur",
    "pasuruan": "Jawa Timur",
    "bangkalan": "Jawa Timur",
    "sumenep": "Jawa Timur",
    "pamekasan": "Jawa Timur",
    "sukoharjo": "Jawa Timur",
    "tangerang": "Banten",
    "tangerang selatan": "Banten",
    "tangsel": "Banten",
    "serang": "Banten",
    "cilegon": "Banten",
    "lebak": "Banten",
    "pandeglang": "Banten",
    "denpasar": "Bali",
    "badung": "Bali",
    "gianyar": "Bali",
    "tabanan": "Bali",
    "buleleng": "Bali",
    "karangasem": "Bali",
    "jembrana": "Bali",
    "bangli": "Bali",
    "mataram": "Nusa Tenggara Barat",
    "sumbawa": "Nusa Tenggara Barat",
    "bima": "Nusa Tenggara Barat",
    "ntb": "Nusa Tenggara Barat",
    "kupang": "Nusa Tenggara Timur",
    "sumba tengah": "Nusa Tenggara Timur",
    "sumba timur": "Nusa Tenggara Timur",
    "ende": "Nusa Tenggara Timur",
    "belu": "Nusa Tenggara Timur",
    "ngada": "Nusa Tenggara Timur",
    "manggarai": "Nusa Tenggara Timur",
    "manggarai timur": "Nusa Tenggara Timur",
    "timor tengah selatan": "Nusa Tenggara Timur",
    "sikka": "Nusa Tenggara Timur",
    "flores timur": "Nusa Tenggara Timur",
    "malaka": "Nusa Tenggara Timur",
    "ntt": "Nusa Tenggara Timur",
    "pontianak": "Kalimantan Barat",
    "singkawang": "Kalimantan Barat",
    "sambas": "Kalimantan Barat",
    "bengkayang": "Kalimantan Barat",
    "kubu raya": "Kalimantan Barat",
    "sanggau": "Kalimantan Barat",
    "ketapang": "Kalimantan Barat",
    "melawi": "Kalimantan Barat",
    "mempawah": "Kalimantan Barat",
    "kapuas hulu": "Kalimantan Barat",
    "kalbar": "Kalimantan Barat",
    "sintang": "Kalimantan Barat",
    "palangkaraya": "Kalimantan Tengah",
    "kapuas": "Kalimantan Tengah",
    "kotawaringin timur": "Kalimantan Tengah",
    "katingan": "Kalimantan Tengah",
    "murung raya": "Kalimantan Tengah",
    "seruyan": "Kalimantan Tengah",
    "pulang pisau": "Kalimantan Tengah",
    "barito kuala": "Kalimantan Tengah",
    "banjarmasin": "Kalimantan Selatan",
    "banjarbaru": "Kalimantan Selatan",
    "banjar": "Kalimantan Selatan",
    "tanah laut": "Kalimantan Selatan",
    "tabalong": "Kalimantan Selatan",
    "hulu sungai tengah": "Kalimantan Selatan",
    "hulu sungai utara": "Kalimantan Selatan",
    "hulu sungai selatan": "Kalimantan Selatan",
    "tanah bumbu": "Kalimantan Selatan",
    "kotabaru": "Kalimantan Selatan",
    "balikpapan": "Kalimantan Timur",
    "samarinda": "Kalimantan Timur",
    "bontang": "Kalimantan Timur",
    "kutai barat": "Kalimantan Timur",
    "kurai kartanegara": "Kalimantan Timur",
    "kutai kartanegara": "Kalimantan Timur",
    "berau": "Kalimantan Timur",
    "penajam paser utara": "Kalimantan Timur",
    "tanjung redeb berau": "Kalimantan Timur",
    "tarakan": "Kalimantan Utara",
    "malinau": "Kalimantan Utara",
    "bulungan": "Kalimantan Utara",
    "tana tidung": "Kalimantan Utara",
    "nunukan": "Kalimantan Utara",
    "manado": "Sulawesi Utara",
    "tomohon": "Sulawesi Utara",
    "kotamobagu": "Sulawesi Utara",
    "bolaang mongondow": "Sulawesi Utara",
    "minahasa": "Sulawesi Utara",
    "bolaang mongondow utara": "Sulawesi Utara",
    "gorontalo": "Gorontalo",
    "gorontalo utara": "Gorontalo",
    "bone bolango": "Gorontalo",
    "palu": "Sulawesi Tengah",
    "poso": "Sulawesi Tengah",
    "sigi": "Sulawesi Tengah",
    "banggai": "Sulawesi Tengah",
    "banggai laut": "Sulawesi Tengah",
    "tojo una una": "Sulawesi Tengah",
    "toli toli": "Sulawesi Tengah",
    "parigi moutong": "Sulawesi Tengah",
    "mamuju": "Sulawesi Barat",
    "mamuju tengah": "Sulawesi Barat",
    "polewali mandar": "Sulawesi Barat",
    "majene": "Sulawesi Barat",
    "mamasa": "Sulawesi Barat",
    "pasangkayu": "Sulawesi Barat",
    "makassar": "Sulawesi Selatan",
    "gowa": "Sulawesi Selatan",
    "maros": "Sulawesi Selatan",
    "bone": "Sulawesi Selatan",
    "soppeng": "Sulawesi Selatan",
    "wajo": "Sulawesi Selatan",
    "sinjai": "Sulawesi Selatan",
    "bantaeng": "Sulawesi Selatan",
    "jeneponto": "Sulawesi Selatan",
    "takalar": "Sulawesi Selatan",
    "bulukumba": "Sulawesi Selatan",
    "barru": "Sulawesi Selatan",
    "pinrang": "Sulawesi Selatan",
    "enrekang": "Sulawesi Selatan",
    "tana toraja": "Sulawesi Selatan",
    "toraja utara": "Sulawesi Selatan",
    "kepulauan selayar": "Sulawesi Selatan",
    "parepare": "Sulawesi Selatan",
    "kendari": "Sulawesi Tenggara",
    "kolaka": "Sulawesi Tenggara",
    "kolaka utara": "Sulawesi Tenggara",
    "kolaka timur": "Sulawesi Tenggara",
    "konawe": "Sulawesi Tenggara",
    "konawe selatan": "Sulawesi Tenggara",
    "bombana": "Sulawesi Tenggara",
    "buton": "Sulawesi Tenggara",
    "buton tengah": "Sulawesi Tenggara",
    "buton utara": "Sulawesi Tenggara",
    "wakatobi": "Sulawesi Tenggara",
    "muna": "Sulawesi Tenggara",
    "ambon": "Maluku",
    "buru": "Maluku",
    "buru selatan": "Maluku",
    "seram bagian barat": "Maluku",
    "seram bagian timur": "Maluku",
    "kepulauan aru": "Maluku",
    "maluku tengah": "Maluku",
    "maluku barat daya": "Maluku",
    "ternate": "Maluku Utara",
    "kepulauan sula": "Maluku Utara",
    "jayapura": "Papua",
    "mimika": "Papua",
    "merauke": "Papua",
    "nabire": "Papua",
    "sarmi": "Papua",
    "waropen": "Papua",
    "keerom": "Papua",
    "boven digoel": "Papua",
    "yahukimo": "Papua",
    "puncak jaya": "Papua",
    "asmat": "Papua",
    "supiori": "Papua",
    "kepulauan yapen": "Papua",
    "fakfak": "Papua",
    "manokwari": "Papua Barat",
    "manokwari selatan": "Papua Barat",
    "sorong selatan": "Papua Barat Daya",
    "sorong": "Papua Barat Daya",
    "paniai": "Papua Tengah",
    "tolikara": "Papua Pegunungan",
    "mappi": "Papua Selatan"
};

const PROVINCE_NAME_ALIASES = {
    "jawa barat": "Jawa Barat",
    "jawa tengah": "Jawa Tengah",
    "jawa timur": "Jawa Timur",
    "dki jakarta": "DKI Jakarta",
    "diy": "DI Yogyakarta",
    "di yogyakarta": "DI Yogyakarta",
    "banten": "Banten",
    "bali": "Bali",
    "ntb": "Nusa Tenggara Barat",
    "ntt": "Nusa Tenggara Timur",
    "sumatera utara": "Sumatera Utara",
    "sumatra utara": "Sumatera Utara",
    "sumut": "Sumatera Utara",
    "sumatera barat": "Sumatera Barat",
    "sumatra barat": "Sumatera Barat",
    "sumbar": "Sumatera Barat",
    "sumatera selatan": "Sumatera Selatan",
    "sumatra selatan": "Sumatera Selatan",
    "sumsel": "Sumatera Selatan",
    "riau": "Riau",
    "kepulauan riau": "Kepulauan Riau",
    "jambi": "Jambi",
    "bengkulu": "Bengkulu",
    "lampung": "Lampung",
    "aceh": "Aceh",
    "kepulauan bangka belitung": "Kepulauan Bangka Belitung",
    "bangka belitung": "Kepulauan Bangka Belitung",
    "kalimantan barat": "Kalimantan Barat",
    "kalbar": "Kalimantan Barat",
    "kalimantan tengah": "Kalimantan Tengah",
    "kalimantan selatan": "Kalimantan Selatan",
    "kalimantan timur": "Kalimantan Timur",
    "kalimantan utara": "Kalimantan Utara",
    "sulawesi utara": "Sulawesi Utara",
    "gorontalo": "Gorontalo",
    "sulawesi tengah": "Sulawesi Tengah",
    "sulawesi barat": "Sulawesi Barat",
    "sulawesi selatan": "Sulawesi Selatan",
    "sulawesi tenggara": "Sulawesi Tenggara",
    "maluku": "Maluku",
    "maluku utara": "Maluku Utara",
    "papua": "Papua",
    "papua barat": "Papua Barat",
    "papua barat daya": "Papua Barat Daya",
    "papua tengah": "Papua Tengah",
    "papua pengunungan": "Papua Pegunungan",
    "papua pegunungan": "Papua Pegunungan",
    "papua selatan": "Papua Selatan"
};

const INFORMAL_REGION_NAMES = [
    "aceh + riau",
    "kalimantan",
    "nursa",
    "papua + maluku",
    "sulawesi",
    "sulawesi timur",
    "sulawwesi",
    "sumatera",
    "sumut + sumbar"
];
