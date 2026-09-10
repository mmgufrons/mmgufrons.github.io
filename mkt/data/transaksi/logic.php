<?php
// data/transaksi/logic.php
// Port dari script Python Google Colab (lihat sop/transaksi.php versi lama) ke PHP.

// Cek file penting dulu sebelum di-require — kalau langsung require_once dan filenya tidak ada,
// PHP fatal error "Failed opening required" TIDAK BISA ditangkap try/catch dan bikin halaman blank
// putih total (kalau display_errors mati di server). Dengan cek manual begini, errornya jadi pesan
// yang jelas dan bisa ditangkap oleh try/catch di halaman pemanggil (dashboard.php, import.php, dst).
$trxAutoload = __DIR__ . '/../../vendor/autoload.php';
if (!file_exists($trxAutoload)) {
    throw new \RuntimeException(
        "File vendor/autoload.php tidak ditemukan di server ini. " .
        "Folder vendor/ (hasil composer install) belum ter-upload dengan benar — " .
        "pastikan extract file ZIP update di root folder project, bukan di subfolder."
    );
}
require_once $trxAutoload;
require_once __DIR__ . '/../../includes/firebase_transaksi.php';

$GLOBALS['TRX_KAMUS_DARURAT'] = [
    'LBJ' => 'LABUAN BAJO',
    'MKW' => 'MANOKWARI',
    'TIM' => 'TIMIKA',
    'BTH' => 'BATAM',
];

// Cari koordinat [lat,lng] untuk nama kota — exact match dulu ke city_coords.php,
// kalau tidak ada fallback ke pusat provinsi (province_coords.php) via substring match.
function trx_city_to_coords(string $kota): ?array {
    static $cityCoords = null;
    static $provinceCoords = null;
    if ($cityCoords === null) $cityCoords = require __DIR__ . '/city_coords.php';
    if ($provinceCoords === null) $provinceCoords = require __DIR__ . '/province_coords.php';

    $kotaUp = strtoupper(trim($kota));
    if (isset($cityCoords[$kotaUp])) return $cityCoords[$kotaUp];

    foreach ($provinceCoords as $prov => $coord) {
        if (strpos($kotaUp, $prov) !== false) return $coord;
    }
    return null;
}

function trx_clean_id($x) {
    if ($x === null) return '';
    $s = trim((string)$x);
    if (substr($s, -2) === '.0') $s = substr($s, 0, -2);
    return $s;
}

// Terima berbagai format tanggal (Excel serial number, string) -> Y-m-d atau null.
function trx_parse_date($val) {
    if ($val === null || $val === '' || strtoupper(trim((string)$val)) === 'NULL') return null;
    if (is_numeric($val)) {
        try {
            $dt = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($val);
            return $dt->format('Y-m-d');
        } catch (\Throwable $e) {
            return null;
        }
    }
    $ts = strtotime((string)$val);
    if ($ts === false) return null;
    return date('Y-m-d', $ts);
}

function trx_hari_map($dow) {
    $map = [0 => 'Minggu', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'];
    return $map[$dow] ?? '';
}
function trx_bulan_map($m) {
    $map = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
    return $map[$m] ?? '';
}

function trx_status_group($status) {
    $s = strtolower((string)$status);
    if (strpos($s, 'delivered') !== false || strpos($s, 'sampai') !== false) return 'BERHASIL';
    if (strpos($s, 'return') !== false || strpos($s, 'retur') !== false || strpos($s, 'gagal') !== false || strpos($s, 'cancel') !== false) return 'RETUR';
    return 'PROSES';
}

function trx_service_group($service) {
    $s = strtoupper((string)$service);
    if (in_array($s, ['YES', 'CTCYES'], true)) return 'NEXT DAY';
    if (in_array($s, ['JTR', 'CARGO'], true)) return 'EKONOMI / JTR';
    return 'REGULER';
}

function trx_status_cair_cod($kategori, $statusPaid) {
    $kat = strtoupper((string)$kategori);
    $paid = strtolower((string)$statusPaid);
    if ($kat !== 'COD') return 'BUKAN COD';
    return $paid === 'done' ? 'SUDAH CAIR' : 'BELUM CAIR';
}

// Hitung ulang seluruh kolom turunan untuk 1 record master (dipanggil setelah field mentah di-overlay).
function trx_recompute(array $rec, array $originMap, array $originPrefixMap) {
    $kodeAsal = strtoupper(trim((string)($rec['KODE ASAL'] ?? '')));
    $rec['KOTA ASAL'] = $originMap[$kodeAsal] ?? ($rec['KOTA ASAL'] ?? $kodeAsal);

    $codeDest = strtoupper(trim((string)($rec['CODE DEST'] ?? '')));
    if (isset($originMap[$codeDest])) {
        $rec['KOTA TUJUAN'] = $originMap[$codeDest];
    } else {
        $prefix = substr($codeDest, 0, 3);
        $rec['KOTA TUJUAN'] = $originPrefixMap[$prefix] ?? ($GLOBALS['TRX_KAMUS_DARURAT'][$prefix] ?? $codeDest);
    }

    $rec['STATUS_GROUP'] = trx_status_group($rec['STATUS'] ?? '');
    $rec['SERVICE_GROUP'] = trx_service_group($rec['SERVICE'] ?? '');
    $rec['STATUS CAIR COD'] = trx_status_cair_cod($rec['KATEGORI'] ?? '', $rec['STATUS PAID'] ?? '');

    // AWB baru yang belum punya TANGGAL (order date) sama sekali — pakai TGL CREATE dari raw file sbg fallback.
    if (empty($rec['TANGGAL']) && !empty($rec['TGL CREATE'])) {
        $rec['TANGGAL'] = $rec['TGL CREATE'];
    }

    $tglObj = trx_parse_date($rec['TANGGAL'] ?? null);
    if ($tglObj) {
        $ts = strtotime($tglObj);
        $rec['TANGGAL'] = $tglObj;
        $rec['HARI'] = trx_hari_map((int)date('w', $ts));
        $rec['URUTAN_HARI'] = (int)date('N', $ts);
        $rec['BULAN'] = trx_bulan_map((int)date('n', $ts));
    }

    foreach (['POD DATE', 'TGL CREATE', 'TGL PAID'] as $f) {
        if (!empty($rec[$f])) {
            $d = trx_parse_date($rec[$f]);
            if ($d) $rec[$f] = $d;
        }
    }

    if (!isset($rec['DOMISILI USER']) || $rec['DOMISILI USER'] === '') {
        $rec['DOMISILI USER'] = $rec['KOTA ASAL'];
    }

    return $rec;
}

// Tebak nama ekspedisi dari nama file (mis. "Sales COD Bulan Juli 2026 SAPX.xlsx" -> "SAPX").
function trx_guess_ekspedisi(string $filename): string {
    $name = strtoupper(pathinfo($filename, PATHINFO_FILENAME));
    $name = preg_replace('/\bSALES\b|\bCOD\b|\bBULAN\b|\bNON\b/', ' ', $name);
    $name = preg_replace('/\b(JANUARI|FEBRUARI|MARET|APRIL|MEI|JUNI|JULI|AGUSTUS|SEPTEMBER|OKTOBER|NOVEMBER|DESEMBER)\b/', ' ', $name);
    $name = preg_replace('/\b20\d{2}\b/', ' ', $name); // tahun
    $name = trim(preg_replace('/\s+/', ' ', $name));
    return $name !== '' ? $name : 'LAINNYA';
}

// Baca satu file mentah ekspedisi (SALES JULI style) -> list keyed by AWB, berisi field siap di-overlay ke record master.
// $ekspedisi: nama ekspedisi hasil tebakan dari nama file (dipakai untuk AWB yang belum punya EKSPEDISI).
function trx_read_raw_file(string $path, string $ekspedisi = ''): array {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray(null, true, false, false);
    if (empty($rows)) return [];

    $header = array_map(function ($h) {
        return strtoupper(trim((string)$h));
    }, $rows[0]);
    $colIndex = array_flip($header);
    $isCod = isset($colIndex['STATUS PAID']);

    $get = function ($row, $name) use ($colIndex) {
        return isset($colIndex[$name]) ? ($row[$colIndex[$name]] ?? null) : null;
    };
    $num = function ($v) {
        if ($v === null || $v === '') return 0.0;
        return (float)str_replace(',', '', (string)$v);
    };

    $out = [];
    for ($i = 1; $i < count($rows); $i++) {
        $row = $rows[$i];
        $awb = trx_clean_id($get($row, 'CNOTE AWB'));
        if ($awb === '') continue;

        $rec = [
            'AWB_RESI' => $awb,
            'KODE ASAL' => strtoupper(trim((string)$get($row, 'ORIGIN'))),
            'CODE DEST' => strtoupper(trim((string)$get($row, 'DEST'))),
            'POD DATE' => trx_parse_date($get($row, 'POD DATE')),
            'TGL CREATE' => trx_parse_date($get($row, 'TGL CREATE')),
            'STATUS' => $get($row, 'STATUS'),
            'SERVICE' => $get($row, 'SERVICE'),
            'EKSPEDISI' => $ekspedisi,
            'KATEGORI' => $isCod ? 'COD' : 'NON COD',
        ];

        if ($isCod) {
            // Komisi agen otomatis untuk COD: selisih TAGIHAN USER - ONGKIR.
            $ongkir = $num($get($row, 'ONGKIR'));
            $tagihan = $num($get($row, 'TAGIHAN USER'));
            $rec['STATUS PAID'] = $get($row, 'STATUS PAID');
            $rec['TGL PAID'] = trx_parse_date($get($row, 'TGL PAID'));
            $rec['TOTAL ONGKIR'] = $tagihan;
            $rec['KOMISI AGEN'] = $tagihan - $ongkir;
        } else {
            // Non-COD: tidak ada kolom pembanding untuk komisi, tetap kosong/manual.
            $rec['TOTAL ONGKIR'] = $num($get($row, 'AMOUNT'));
        }

        $out[$awb] = $rec; // dedupe by AWB, keep last
    }
    return $out;
}

// Baca file "Data Agen/User Baru" (skema DATA TJS.xlsx: USER ID, NAMA, TGL GABUNG, ORIGIN, PHONE, EMAIL, ROLE, AGEN ID)
// -> list keyed by ID USER, untuk di-upsert ke /user_master.
function trx_read_user_file(string $path): array {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray(null, true, false, false);
    if (empty($rows)) return [];

    $header = array_map(function ($h) { return strtoupper(trim((string)$h)); }, $rows[0]);
    $idx = array_flip($header);
    $get = function ($row, $name) use ($idx) {
        return isset($idx[$name]) ? ($row[$idx[$name]] ?? null) : null;
    };

    $out = [];
    for ($i = 1; $i < count($rows); $i++) {
        $row = $rows[$i];
        $id = trx_clean_id($get($row, 'USER ID'));
        if ($id === '') continue;

        $out[$id] = [
            'ID USER' => $id,
            'NAMA' => $get($row, 'NAMA'),
            'TGL GABUNG' => trx_parse_date($get($row, 'TGL GABUNG')),
            'ORIGIN' => strtoupper(trim((string)$get($row, 'ORIGIN'))),
            'PHONE' => $get($row, 'PHONE'),
            'EMAIL' => $get($row, 'EMAIL'),
            'ROLE' => $get($row, 'ROLE'),
            'AGEN ID' => trx_clean_id($get($row, 'AGEN ID')),
        ];
    }
    return $out;
}

// Firebase key TIDAK BOLEH mengandung . # $ [ ] / — label asli (mis. "EKONOMI / JTR")
// bisa mengandung karakter itu, jadi map-by-label diubah jadi list of {label,...}.
// Rapikan nama kota untuk tampilan (bukan untuk key data): "CIKAMPEK,KARAWANG" -> "Cikampek · Karawang",
// dan deteksi kode origin mentah yang belum ke-mapping ke nama kota (mis. "TSM10100") supaya jujur ditandai,
// bukan ditampilkan seolah nama kota.
function trx_display_kota(string $label): array {
    $label = trim($label);
    if ($label === '' || $label === '-') return ['text' => '-', 'is_code' => false];
    if (preg_match('/^[A-Z]{2,5}\d{3,6}$/', $label)) {
        return ['text' => $label, 'is_code' => true];
    }
    $parts = array_map('trim', explode(',', $label));
    $parts = array_map(function ($p) { return mb_convert_case(mb_strtolower($p), MB_CASE_TITLE); }, $parts);
    return ['text' => implode(' · ', array_filter($parts)), 'is_code' => false];
}

function trx_map_to_list(array $map, string $labelField = 'jumlah'): array {
    $list = [];
    foreach ($map as $label => $val) {
        $row = is_array($val) ? $val : [$labelField => $val];
        $row['label'] = $label;
        $list[] = $row;
    }
    return $list;
}

// Terapkan filter (opsional) ke satu record sebelum dihitung ke summary. Dipakai oleh trx_rebuild_summary()
// dan filter_report.php supaya logikanya konsisten.
function trx_match_filter(array $rec, array $filter): bool {
    if (!empty($filter['kategori']) && strtoupper((string)($rec['KATEGORI'] ?? '')) !== strtoupper($filter['kategori'])) return false;
    if (!empty($filter['status_group']) && strtoupper((string)($rec['STATUS_GROUP'] ?? '')) !== strtoupper($filter['status_group'])) return false;
    if (!empty($filter['ekspedisi']) && strtoupper((string)($rec['EKSPEDISI'] ?? '')) !== strtoupper($filter['ekspedisi'])) return false;
    $tgl = $rec['TANGGAL'] ?? null;
    if (!empty($filter['tanggal_mulai']) && (!$tgl || $tgl < $filter['tanggal_mulai'])) return false;
    if (!empty($filter['tanggal_akhir']) && (!$tgl || $tgl > $filter['tanggal_akhir'])) return false;
    return true;
}

// Hitung agregat lengkap atas kumpulan record /transaksi. Dipakai baik untuk rebuild summary utama
// (semua data) maupun untuk laporan filter on-demand (subset data).
function trx_compute_aggregates(iterable $all, array $filter = []): array {
    $perHari = [];
    $perBulan = [];       // YYYY-MM => [omset_cod, omset_noncod, jumlah]
    $perHariMinggu = [];  // urutan_hari(1-7) => [label, jumlah]
    $perEkspedisi = [];
    $perService = [];
    $perServiceGroup = [];
    $perKategori = [];    // KATEGORI => [omset, jumlah]
    $perKotaTujuan = [];  // kota => [jumlah, omset]
    $perKotaAsal = [];    // kota => [jumlah, omset, retur]
    $statusByKategori = [];  // KATEGORI => [BERHASIL,PROSES,RETUR]
    $statusByEkspedisi = []; // EKSPEDISI => [BERHASIL,PROSES,RETUR]
    $userAgg = [];         // ID USER => [nama, kota_asal, kategori, ekspedisi_count, total_ongkir, jumlah]
    $recentActivity = [];  // dikumpulkan lalu diurutkan & dipotong di akhir

    $codCair = 0;
    $codBelum = 0;
    $totalOmset = 0;
    $totalKomisi = 0;
    $totalResi = 0;
    $userIdSet = [];

    foreach ($all as $rec) {
        if (!is_array($rec)) continue;
        if (!empty($filter) && !trx_match_filter($rec, $filter)) continue;

        $totalResi++;
        $ongkir = (float)($rec['TOTAL ONGKIR'] ?? 0);
        $komisi = (float)($rec['KOMISI AGEN'] ?? 0);
        $totalOmset += $ongkir;
        $totalKomisi += $komisi;

        $kategori = $rec['KATEGORI'] ?? '-';
        $ekspedisi = $rec['EKSPEDISI'] ?? '-';
        $statusGroup = $rec['STATUS_GROUP'] ?? '-';
        $tgl = $rec['TANGGAL'] ?? null;

        // per hari (kalender)
        if ($tgl) {
            if (!isset($perHari[$tgl])) $perHari[$tgl] = ['tanggal' => $tgl, 'jumlah' => 0, 'omset' => 0];
            $perHari[$tgl]['jumlah']++;
            $perHari[$tgl]['omset'] += $ongkir;

            // per bulan, COD vs Non-COD
            $bulanKey = substr($tgl, 0, 7); // YYYY-MM
            if (!isset($perBulan[$bulanKey])) $perBulan[$bulanKey] = ['bulan' => $bulanKey, 'omset_cod' => 0, 'omset_noncod' => 0, 'jumlah' => 0];
            $perBulan[$bulanKey]['jumlah']++;
            if (strtoupper($kategori) === 'COD') $perBulan[$bulanKey]['omset_cod'] += $ongkir;
            else $perBulan[$bulanKey]['omset_noncod'] += $ongkir;
        }

        // per hari-dalam-minggu
        $urutanHari = (int)($rec['URUTAN_HARI'] ?? 0);
        if ($urutanHari > 0) {
            if (!isset($perHariMinggu[$urutanHari])) $perHariMinggu[$urutanHari] = ['label' => $rec['HARI'] ?? '', 'urutan' => $urutanHari, 'jumlah' => 0];
            $perHariMinggu[$urutanHari]['jumlah']++;
        }

        // per ekspedisi
        if (!isset($perEkspedisi[$ekspedisi])) $perEkspedisi[$ekspedisi] = ['jumlah' => 0, 'omset' => 0];
        $perEkspedisi[$ekspedisi]['jumlah']++;
        $perEkspedisi[$ekspedisi]['omset'] += $ongkir;

        // per service & service group
        $svc = $rec['SERVICE'] ?? '-';
        $perService[$svc] = ($perService[$svc] ?? 0) + 1;
        $sg = $rec['SERVICE_GROUP'] ?? '-';
        $perServiceGroup[$sg] = ($perServiceGroup[$sg] ?? 0) + 1;

        // per kategori (COD/NON COD)
        if (!isset($perKategori[$kategori])) $perKategori[$kategori] = ['omset' => 0, 'jumlah' => 0];
        $perKategori[$kategori]['omset'] += $ongkir;
        $perKategori[$kategori]['jumlah']++;

        // kota tujuan
        $kotaTujuan = $rec['KOTA TUJUAN'] ?? '-';
        if (!isset($perKotaTujuan[$kotaTujuan])) $perKotaTujuan[$kotaTujuan] = ['jumlah' => 0, 'omset' => 0];
        $perKotaTujuan[$kotaTujuan]['jumlah']++;
        $perKotaTujuan[$kotaTujuan]['omset'] += $ongkir;

        // kota asal + retur
        $kotaAsal = $rec['KOTA ASAL'] ?? '-';
        if (!isset($perKotaAsal[$kotaAsal])) $perKotaAsal[$kotaAsal] = ['jumlah' => 0, 'omset' => 0, 'retur' => 0];
        $perKotaAsal[$kotaAsal]['jumlah']++;
        $perKotaAsal[$kotaAsal]['omset'] += $ongkir;
        if ($statusGroup === 'RETUR') $perKotaAsal[$kotaAsal]['retur']++;

        // status by kategori & by ekspedisi
        if (!isset($statusByKategori[$kategori])) $statusByKategori[$kategori] = ['BERHASIL' => 0, 'PROSES' => 0, 'RETUR' => 0];
        if (isset($statusByKategori[$kategori][$statusGroup])) $statusByKategori[$kategori][$statusGroup]++;
        if (!isset($statusByEkspedisi[$ekspedisi])) $statusByEkspedisi[$ekspedisi] = ['BERHASIL' => 0, 'PROSES' => 0, 'RETUR' => 0];
        if (isset($statusByEkspedisi[$ekspedisi][$statusGroup])) $statusByEkspedisi[$ekspedisi][$statusGroup]++;

        // cod cair
        $cair = $rec['STATUS CAIR COD'] ?? '';
        if ($cair === 'SUDAH CAIR') $codCair++;
        elseif ($cair === 'BELUM CAIR') $codBelum++;

        // per user (leaderboard, matriks multikurir, radar non-JNE)
        $idUser = trim((string)($rec['ID USER'] ?? ''));
        if ($idUser !== '') {
            $userIdSet[$idUser] = true;
            if (!isset($userAgg[$idUser])) {
                $userAgg[$idUser] = [
                    'id' => $idUser,
                    'nama' => $rec['NAMA USER'] ?? '-',
                    'kota_asal' => $kotaAsal,
                    'kategori' => $kategori,
                    'ekspedisi_count' => [],
                    'total_ongkir' => 0,
                    'jumlah' => 0,
                ];
            }
            $userAgg[$idUser]['total_ongkir'] += $ongkir;
            $userAgg[$idUser]['jumlah']++;
            $userAgg[$idUser]['ekspedisi_count'][$ekspedisi] = ($userAgg[$idUser]['ekspedisi_count'][$ekspedisi] ?? 0) + 1;
        }

        // log aktivitas terakhir (kumpulkan dulu, urutkan & potong di akhir)
        $tglAktivitas = $rec['TGL CREATE'] ?? $tgl;
        if ($tglAktivitas) {
            $recentActivity[] = [
                'awb' => $rec['AWB_RESI'] ?? '-',
                'nama' => $rec['NAMA USER'] ?? '-',
                'ekspedisi' => $ekspedisi,
                'tanggal' => $tglAktivitas,
            ];
        }
    }

    ksort($perHari);
    ksort($perBulan);
    ksort($perHariMinggu);
    arsort($perKotaTujuan);
    $perKotaTujuanTop = array_slice($perKotaTujuan, 0, 15, true);
    arsort($perKotaAsal);

    // % retur & rata-rata ongkir per kota asal
    $kotaAsalDetail = [];
    foreach ($perKotaAsal as $kota => $d) {
        $kotaAsalDetail[$kota] = [
            'jumlah' => $d['jumlah'],
            'omset' => $d['omset'],
            'rata_rata' => $d['jumlah'] > 0 ? round($d['omset'] / $d['jumlah']) : 0,
            'persen_retur' => $d['jumlah'] > 0 ? round($d['retur'] / $d['jumlah'] * 100, 2) : 0,
        ];
    }

    // Titik peta: semua kota asal (himpunannya kecil, ~38) + SEMUA kota tujuan yang berhasil dicocokkan
    // ke koordinat (bukan cuma top 15 — tabel "Analisa Wilayah Tujuan" tetap top 15, peta tampilkan semua yang bisa).
    $petaAsal = [];
    foreach ($perKotaAsal as $kota => $d) {
        $coord = trx_city_to_coords($kota);
        if ($coord) $petaAsal[] = ['kota' => $kota, 'lat' => $coord[0], 'lng' => $coord[1], 'jumlah' => $d['jumlah'], 'omset' => $d['omset']];
    }
    $petaTujuan = [];
    foreach ($perKotaTujuan as $kota => $d) {
        $coord = trx_city_to_coords($kota);
        if ($coord) $petaTujuan[] = ['kota' => $kota, 'lat' => $coord[0], 'lng' => $coord[1], 'jumlah' => $d['jumlah'], 'omset' => $d['omset']];
    }

    // Leaderboard: top 100 user by total ongkir
    $leaderboard = array_values($userAgg);
    usort($leaderboard, function ($a, $b) { return $b['total_ongkir'] <=> $a['total_ongkir']; });
    $leaderboard = array_slice($leaderboard, 0, 100);
    $leaderboardOut = array_map(function ($u) {
        arsort($u['ekspedisi_count']);
        $dominan = array_key_first($u['ekspedisi_count']) ?? '-';
        return [
            'id' => $u['id'], 'nama' => $u['nama'], 'kota_asal' => $u['kota_asal'], 'kategori' => $u['kategori'],
            'ekspedisi_dominan' => $dominan, 'total_ongkir' => $u['total_ongkir'], 'jumlah_awb' => $u['jumlah'],
        ];
    }, $leaderboard);

    // Matriks penetrasi multikurir: top 100 user by jumlah AWB, kolom dibatasi ke top 8 ekspedisi + LAINNYA
    $ekspedisiRanking = $perEkspedisi;
    uasort($ekspedisiRanking, function ($a, $b) { return $b['jumlah'] <=> $a['jumlah']; });
    $topEkspedisiCols = array_slice(array_keys($ekspedisiRanking), 0, 8);

    $matrixUsers = array_values($userAgg);
    usort($matrixUsers, function ($a, $b) { return $b['jumlah'] <=> $a['jumlah']; });
    $matrixUsers = array_slice($matrixUsers, 0, 100);
    $matriksUserEkspedisi = array_map(function ($u) use ($topEkspedisiCols) {
        $cols = [];
        $lainnya = 0;
        foreach ($u['ekspedisi_count'] as $eks => $cnt) {
            if (in_array($eks, $topEkspedisiCols, true)) $cols[$eks] = $cnt;
            else $lainnya += $cnt;
        }
        return ['id' => $u['id'], 'nama' => $u['nama'], 'per_ekspedisi' => $cols, 'lainnya' => $lainnya, 'grand_total' => $u['jumlah']];
    }, $matrixUsers);

    // Radar deteksi agen non-JNE aktif: user yang punya transaksi via ekspedisi selain JNE
    $radarNonJne = [];
    foreach ($userAgg as $u) {
        $nonJne = array_filter($u['ekspedisi_count'], function ($eks) { return strtoupper($eks) !== 'JNE'; }, ARRAY_FILTER_USE_KEY);
        if (empty($nonJne)) continue;
        arsort($nonJne);
        $radarNonJne[] = [
            'id' => $u['id'], 'nama' => $u['nama'], 'ekspedisi_dominan' => array_key_first($nonJne),
            'total_ongkir' => $u['total_ongkir'], 'jumlah_awb' => array_sum($nonJne),
        ];
    }
    usort($radarNonJne, function ($a, $b) { return $b['total_ongkir'] <=> $a['total_ongkir']; });
    $radarNonJne = array_slice($radarNonJne, 0, 100);

    // Log aktivitas terakhir: urutkan desc by tanggal, ambil 50 teratas
    usort($recentActivity, function ($a, $b) { return strcmp($b['tanggal'], $a['tanggal']); });
    $recentActivity = array_slice($recentActivity, 0, 50);

    // status_by_* jadi list
    $statusByKategoriList = [];
    foreach ($statusByKategori as $label => $d) { $d['label'] = $label; $d['total'] = array_sum(array_intersect_key($d, ['BERHASIL'=>0,'PROSES'=>0,'RETUR'=>0])); $statusByKategoriList[] = $d; }
    $statusByEkspedisiList = [];
    foreach ($statusByEkspedisi as $label => $d) { $d['label'] = $label; $d['total'] = array_sum(array_intersect_key($d, ['BERHASIL'=>0,'PROSES'=>0,'RETUR'=>0])); $statusByEkspedisiList[] = $d; }

    return [
        'updated_at' => date('Y-m-d H:i:s'),
        'total_resi' => $totalResi,
        'total_omset' => $totalOmset,
        'total_komisi' => $totalKomisi,
        'rata_rata_ongkir' => $totalResi > 0 ? round($totalOmset / $totalResi) : 0,
        'user_aktif' => count($userIdSet),
        'per_hari' => array_values($perHari),
        'per_bulan' => array_values($perBulan),
        'per_hari_minggu' => array_values($perHariMinggu),
        'per_ekspedisi' => trx_map_to_list($perEkspedisi),
        'per_service' => trx_map_to_list($perService),
        'per_service_group' => trx_map_to_list($perServiceGroup),
        'per_kategori' => trx_map_to_list($perKategori),
        'per_kota_tujuan' => trx_map_to_list($perKotaTujuanTop),
        'kota_asal_detail' => trx_map_to_list($kotaAsalDetail),
        'peta_kota_asal' => $petaAsal,
        'peta_kota_tujuan' => $petaTujuan,
        'status_by_kategori' => $statusByKategoriList,
        'status_by_ekspedisi' => $statusByEkspedisiList,
        'leaderboard_user' => $leaderboardOut,
        'matriks_user_ekspedisi' => $matriksUserEkspedisi,
        'matriks_kolom_ekspedisi' => $topEkspedisiCols,
        'radar_non_jne' => $radarNonJne,
        'recent_activity' => $recentActivity,
        'cod_sudah_cair' => $codCair,
        'cod_belum_cair' => $codBelum,
    ];
}

// Rebuild /transaksi_summary dengan fetch seluruh /transaksi. Dipanggil setelah import & seed selesai.
function trx_rebuild_summary(): array {
    $all = trx_fb_get('/transaksi', 240) ?: [];
    $summary = trx_compute_aggregates($all);
    trx_fb_put('/transaksi_summary', $summary);
    return $summary;
}
