<?php
$page_title = "Dashboard Transaksi | SIMASRIM Data";
$footer_desc = "Dokumen Internal Terbatas - Divisi Data & IT.";
$base_path = '../../';
include __DIR__ . '/../../includes/header.php';

// Shutdown handler: kalau ada fatal error PHP (mis. vendor/ belum ke-upload, class tidak ketemu,
// versi PHP tidak cocok) yang TIDAK BISA ditangkap try/catch biasa, tampilkan pesannya di halaman
// alih-alih membiarkan halaman blank putih tanpa penjelasan.
register_shutdown_function(function () {
    $err = error_get_last();
    if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        echo '<div style="max-width:900px;margin:40px auto;padding:24px;background:#fff3f3;border:1px solid #f5c2c2;border-radius:16px;font-family:sans-serif;">';
        echo '<h3 style="color:#c0392b;margin-top:0;">⚠️ Terjadi Error Fatal di Server</h3>';
        echo '<p>Halaman gagal dimuat karena error PHP berikut — kirim pesan ini untuk diperbaiki:</p>';
        echo '<pre style="white-space:pre-wrap;background:#fff;padding:12px;border-radius:8px;font-size:13px;">' . htmlspecialchars($err['message'] . ' in ' . $err['file'] . ':' . $err['line']) . '</pre>';
        echo '</div>';
    }
});

$filter = [
    'kategori' => trim($_GET['kategori'] ?? ''),
    'status_group' => trim($_GET['status_group'] ?? ''),
    'ekspedisi' => trim($_GET['ekspedisi'] ?? ''),
    'tanggal_mulai' => trim($_GET['tanggal_mulai'] ?? ''),
    'tanggal_akhir' => trim($_GET['tanggal_akhir'] ?? ''),
];
$hasFilter = array_filter($filter) !== [];

$summary = [];
$error = null;
$filterDurationSec = null;
try {
    require_once __DIR__ . '/logic.php';

    if ($hasFilter) {
        $t0 = microtime(true);
        set_time_limit(280);
        $all = trx_fb_get('/transaksi', 240) ?: [];
        $summary = trx_compute_aggregates($all, $filter);
        $filterDurationSec = round(microtime(true) - $t0, 1);
    } else {
        $summary = trx_fb_get('/transaksi_summary') ?: [];
    }
} catch (\Throwable $e) {
    $error = $e->getMessage();
}

// Daftar ekspedisi untuk dropdown filter — ambil dari summary (tidak perlu fetch lagi).
$ekspedisiOptions = array_column($summary['per_ekspedisi'] ?? [], 'label');
sort($ekspedisiOptions);

$totalOmset = $summary['total_omset'] ?? 0;
$totalKomisi = $summary['total_komisi'] ?? 0;
$totalResi = $summary['total_resi'] ?? 0;
$rataRata = $summary['rata_rata_ongkir'] ?? 0;
$userAktif = $summary['user_aktif'] ?? 0;
$codCair = $summary['cod_sudah_cair'] ?? 0;
$codBelum = $summary['cod_belum_cair'] ?? 0;
?>

<section class="hero-section text-center">
    <div class="container position-relative z-1">
        <span class="badge bg-info text-dark rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase"><i class="fa-solid fa-chart-line me-2"></i>Dashboard Internal</span>
        <h2 class="display-5 fw-bold mb-2">Dashboard Monitor Transaksi SIMASRIM</h2>
        <p class="text-white-50 mb-0">Data langsung dari Firebase, ter-update tiap kali proses upload dijalankan.<br>
        <?= $hasFilter ? 'Laporan terfilter (dihitung ulang saat ini, ' . $filterDurationSec . ' detik).' : 'Ringkasan umum, terakhir update: ' . htmlspecialchars($summary['updated_at'] ?? '-') ?>
        </p>
    </div>
</section>

<section class="py-4 position-relative z-2 mt-4">
    <div class="container-fluid px-4">

        <div class="d-flex justify-content-end mb-3">
            <a href="index.php" class="btn btn-primary btn-sm"><i class="fas fa-file-import me-1"></i>Upload Data Bulan Ini</a>
        </div>

        <!-- FILTER BAR -->
        <form method="get" class="card border-0 shadow-sm rounded-4 p-3 mb-4">
            <div class="row g-2 align-items-end">
                <div class="col-md-2">
                    <label class="small text-muted mb-1">Kategori</label>
                    <select name="kategori" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <option value="COD" <?= $filter['kategori'] === 'COD' ? 'selected' : '' ?>>COD</option>
                        <option value="NON COD" <?= $filter['kategori'] === 'NON COD' ? 'selected' : '' ?>>NON COD</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="small text-muted mb-1">Status</label>
                    <select name="status_group" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <?php foreach (['BERHASIL', 'PROSES', 'RETUR'] as $s): ?>
                        <option value="<?= $s ?>" <?= $filter['status_group'] === $s ? 'selected' : '' ?>><?= $s ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="small text-muted mb-1">Ekspedisi</label>
                    <select name="ekspedisi" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <?php foreach ($ekspedisiOptions as $eks): ?>
                        <option value="<?= htmlspecialchars($eks) ?>" <?= $filter['ekspedisi'] === $eks ? 'selected' : '' ?>><?= htmlspecialchars($eks) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="small text-muted mb-1">Dari Tanggal</label>
                    <input type="date" name="tanggal_mulai" class="form-control form-control-sm" value="<?= htmlspecialchars($filter['tanggal_mulai']) ?>">
                </div>
                <div class="col-md-2">
                    <label class="small text-muted mb-1">Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" class="form-control form-control-sm" value="<?= htmlspecialchars($filter['tanggal_akhir']) ?>">
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm flex-grow-1"><i class="fas fa-filter me-1"></i>Terapkan</button>
                    <?php if ($hasFilter): ?><a href="dashboard.php" class="btn btn-outline-secondary btn-sm"><i class="fas fa-xmark"></i></a><?php endif; ?>
                </div>
            </div>
            <?php if ($hasFilter): ?>
                <div class="small text-muted mt-2"><i class="fas fa-circle-info me-1"></i>Filter menghitung ulang dari seluruh data (bisa ~1 menit), tidak memakai cache ringkasan.</div>
            <?php endif; ?>
        </form>

    <?php if ($error): ?>
        <div class="alert alert-danger rounded-4"><b>Gagal ambil data:</b> <?= htmlspecialchars($error) ?></div>
    <?php elseif (empty($summary) || $totalResi === 0): ?>
        <div class="alert alert-warning rounded-4">Belum ada data (atau tidak ada yang cocok dengan filter). Silakan <a href="index.php">upload & proses</a> data transaksi terlebih dahulu.</div>
    <?php else: ?>

        <!-- STAT TILES -->
        <?php $codTotal = $codCair + $codBelum; $pctCair = $codTotal > 0 ? round($codCair / $codTotal * 100) : 0; ?>
        <style>
            .stat-tile { border-left: 4px solid var(--accent-color); }
            .stat-tile .stat-value { font-size: 1.3rem; font-weight: 800; white-space: nowrap; display: inline-block; line-height: 1.2; }
            .stat-tile .stat-value-wrap { overflow: hidden; }
            .stat-tile .stat-label { font-size: 0.78rem; color: #6c757d; font-weight: 600; text-transform: uppercase; letter-spacing: 0.03em; }
            .stat-tile .stat-subtext { font-size: 0.75rem; color: #6c757d; margin-top: 2px; }
            .stat-tile .mini-bar { height: 6px; border-radius: 4px; background: #f1c40f33; overflow: hidden; margin-top: 6px; }
            .stat-tile .mini-bar-fill { height: 100%; background: #28a745; border-radius: 4px; }
        </style>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 mb-4">
            <div class="col"><div class="card stat-tile border-0 shadow-sm rounded-4 p-3 h-100" style="--accent-color:#7335B7;">
                <div class="stat-label"><i class="fas fa-receipt me-1" style="color:#7335B7;"></i>Total Resi</div>
                <div class="stat-value-wrap"><span class="stat-value text-dark"><?= number_format($totalResi, 0, ',', '.') ?></span></div>
            </div></div>
            <div class="col"><div class="card stat-tile border-0 shadow-sm rounded-4 p-3 h-100" style="--accent-color:#F3700D;">
                <div class="stat-label"><i class="fas fa-sack-dollar me-1" style="color:#F3700D;"></i>Total Omset</div>
                <div class="stat-value-wrap"><span class="stat-value text-dark">Rp<?= number_format($totalOmset, 0, ',', '.') ?></span></div>
            </div></div>
            <div class="col"><div class="card stat-tile border-0 shadow-sm rounded-4 p-3 h-100" style="--accent-color:#6f42c1;">
                <div class="stat-label"><i class="fas fa-calculator me-1" style="color:#6f42c1;"></i>Rata-rata Ongkir</div>
                <div class="stat-value-wrap"><span class="stat-value text-dark">Rp<?= number_format($rataRata, 0, ',', '.') ?></span></div>
            </div></div>
            <div class="col"><div class="card stat-tile border-0 shadow-sm rounded-4 p-3 h-100" style="--accent-color:#28a745;">
                <div class="stat-label"><i class="fas fa-users me-1" style="color:#28a745;"></i>User Aktif</div>
                <div class="stat-value-wrap"><span class="stat-value text-dark"><?= number_format($userAktif) ?></span></div>
            </div></div>
            <div class="col"><div class="card stat-tile border-0 shadow-sm rounded-4 p-3 h-100" style="--accent-color:#ffc107;">
                <div class="stat-label"><i class="fas fa-money-bill-transfer me-1" style="color:#ffc107;"></i>COD Sudah Cair</div>
                <div class="stat-value-wrap"><span class="stat-value text-success"><?= $pctCair ?>%</span></div>
                <div class="stat-subtext"><?= number_format($codCair) ?> cair &middot; <?= number_format($codBelum) ?> belum (dari <?= number_format($codTotal) ?> resi COD)</div>
                <div class="mini-bar"><div class="mini-bar-fill" style="width: <?= $pctCair ?>%;"></div></div>
            </div></div>
        </div>
        <script>
            // Auto-fit ukuran font stat tile supaya angka selalu utuh terlihat & seragam skalanya antar tile.
            function fitStatValues() {
                document.querySelectorAll('.stat-value').forEach(el => {
                    let size = 20;
                    el.style.fontSize = size + 'px';
                    const wrap = el.parentElement;
                    while (el.scrollWidth > wrap.clientWidth && size > 12) {
                        size -= 1;
                        el.style.fontSize = size + 'px';
                    }
                });
            }
            window.addEventListener('load', fitStatValues);
            window.addEventListener('resize', fitStatValues);
        </script>

        <!-- TREND BULANAN -->
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3">Tren Pendapatan Bulanan: COD vs Non-COD</h6>
                    <div style="height: 340px;"><canvas id="chartBulanan"></canvas></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3">Volume Harian (Hari dalam Minggu)</h6>
                    <div style="height: 340px;"><canvas id="chartHariMinggu"></canvas></div>
                </div>
            </div>
        </div>

        <!-- MARKET SHARE & LAYANAN -->
        <?php
        $perEkspedisiList = $summary['per_ekspedisi'] ?? [];
        usort($perEkspedisiList, function ($a, $b) { return $b['omset'] <=> $a['omset']; });
        $totalEksOmset = array_sum(array_column($perEkspedisiList, 'omset'));

        $perServiceList = $summary['per_service'] ?? [];
        usort($perServiceList, function ($a, $b) { return $b['jumlah'] <=> $a['jumlah']; });
        $totalSvcJumlah = array_sum(array_column($perServiceList, 'jumlah'));
        ?>
        <style>
            .chip-list { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 12px; }
            .chip-list .chip { font-size: 0.78rem; padding: 4px 10px; border-radius: 999px; background: #f8f7fb; border: 1px solid #e9e5f2; white-space: nowrap; }
            .chip-list .chip b { color: #1e1e2f; }
        </style>
        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3">Market Share per Ekspedisi</h6>
                    <div style="height: 240px;"><canvas id="chartEkspedisi"></canvas></div>
                    <div class="chip-list">
                        <?php foreach ($perEkspedisiList as $e):
                            $pct = $totalEksOmset > 0 ? round($e['omset'] / $totalEksOmset * 100, 2) : 0;
                        ?>
                        <span class="chip"><b><?= htmlspecialchars($e['label']) ?></b> &middot; <?= number_format($e['jumlah']) ?> resi &middot; <?= $pct ?>%</span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3">Tipe Layanan Kurir</h6>
                    <div style="height: 240px;"><canvas id="chartService"></canvas></div>
                    <div class="chip-list">
                        <?php foreach ($perServiceList as $s):
                            $pct = $totalSvcJumlah > 0 ? round($s['jumlah'] / $totalSvcJumlah * 100, 2) : 0;
                        ?>
                        <span class="chip"><b><?= htmlspecialchars($s['label']) ?></b> &middot; <?= number_format($s['jumlah']) ?> resi &middot; <?= $pct ?>%</span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- PRESENTASE COD & PERFORMA -->
        <div class="row g-4 mb-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <h6 class="fw-bold mb-3">Presentase COD</h6>
                    <table class="table table-sm mb-0 align-middle">
                        <thead class="table-light"><tr><th>Kategori</th><th class="text-end">Total Ongkir</th><th class="text-end">Jumlah Resi</th><th class="text-end">% Kontribusi</th></tr></thead>
                        <tbody>
                        <?php
                        $perKategori = $summary['per_kategori'] ?? [];
                        $totalKategoriOmset = array_sum(array_column($perKategori, 'omset'));
                        usort($perKategori, function ($a, $b) { return $b['omset'] <=> $a['omset']; });
                        foreach ($perKategori as $k):
                            $pct = $totalKategoriOmset > 0 ? round($k['omset'] / $totalKategoriOmset * 100, 2) : 0;
                        ?>
                        <tr>
                            <td class="fw-semibold"><?= htmlspecialchars($k['label']) ?></td>
                            <td class="text-end">Rp<?= number_format($k['omset']) ?></td>
                            <td class="text-end"><?= number_format($k['jumlah']) ?></td>
                            <td class="text-end"><span class="badge rounded-pill bg-primary-subtle text-primary-emphasis" style="min-width: 4em;"><?= $pct ?>%</span></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <h6 class="fw-bold mb-3">Performa Pengiriman: COD vs Non-COD</h6>
                    <div style="height: 200px;"><canvas id="chartStatusKategori"></canvas></div>
                </div>
            </div>
        </div>

        <!-- RASIO KEBERHASILAN -->
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3">Rasio Keberhasilan per Ekspedisi</h6>
                    <div id="statusEkspedisiWrap"><canvas id="chartStatusEkspedisi"></canvas></div>
                </div>
            </div>
        </div>

        <!-- PETA -->
        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3">Peta Kota Asal <span class="text-muted small fw-normal">(titik approx pusat kota)</span></h6>
                    <div id="mapAsal" style="height: 340px; border-radius: 12px;"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3">Peta Kota Tujuan <span class="text-muted small fw-normal">(semua kota yang teridentifikasi, titik approx pusat kota)</span></h6>
                    <div id="mapTujuan" style="height: 340px; border-radius: 12px;"></div>
                </div>
            </div>
        </div>

        <!-- ANALISA WILAYAH -->
        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h6 class="fw-bold mb-0">Geografis & Analisa Risiko per Kota Asal</h6>
                        <span class="badge bg-light text-dark border small">Diurutkan: % Retur tertinggi</span>
                    </div>
                    <?php
                    $kotaAsalDetail = $summary['kota_asal_detail'] ?? [];
                    usort($kotaAsalDetail, function ($a, $b) { return $b['persen_retur'] <=> $a['persen_retur']; });
                    $top3Risk = array_slice(array_filter($kotaAsalDetail, function ($k) { return $k['persen_retur'] > 0; }), 0, 3);
                    ?>
                    <?php if ($top3Risk): ?>
                    <div class="d-flex gap-2 mb-3 flex-wrap">
                        <?php foreach ($top3Risk as $k): $d = trx_display_kota($k['label']); ?>
                        <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3" style="background: #fff5f5; border: 1px solid #ffdbdb;">
                            <i class="fas fa-triangle-exclamation text-danger"></i>
                            <div>
                                <div class="fw-bold small text-dark"><?= htmlspecialchars($d['text']) ?></div>
                                <div class="text-danger fw-bold" style="font-size: 0.9rem;"><?= $k['persen_retur'] ?>% retur</div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div style="max-height: 360px; overflow-y: auto;">
                    <table class="table table-sm table-hover mb-0 align-middle">
                        <thead class="table-light" style="position: sticky; top: 0; z-index: 1;"><tr><th>Kota Asal</th><th class="text-end">Jumlah</th><th class="text-end">Total Ongkir</th><th class="text-end">Rata-rata</th><th class="text-end">% Retur</th></tr></thead>
                        <tbody>
                        <?php foreach ($kotaAsalDetail as $k):
                            $badgeClass = $k['persen_retur'] > 2 ? 'bg-danger' : ($k['persen_retur'] > 0.5 ? 'bg-warning text-dark' : 'bg-success');
                            $d = trx_display_kota($k['label']);
                        ?>
                        <tr>
                            <td class="fw-semibold">
                                <?php if ($d['is_code']): ?>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis font-monospace" title="Kode area belum ada nama kota di data master ORIGIN"><?= htmlspecialchars($d['text']) ?></span>
                                <?php else: ?>
                                    <?= htmlspecialchars($d['text']) ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-end"><?= number_format($k['jumlah']) ?></td>
                            <td class="text-end fw-semibold">Rp<?= number_format($k['omset']) ?></td>
                            <td class="text-end text-muted">Rp<?= number_format($k['rata_rata']) ?></td>
                            <td class="text-end"><span class="badge rounded-pill <?= $badgeClass ?>" style="min-width: 3.5em;"><?= $k['persen_retur'] ?>%</span></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3">Analisa Wilayah Tujuan (Top 15)</h6>
                    <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-sm table-hover mb-0 align-middle">
                        <thead class="table-light" style="position: sticky; top: 0; z-index: 1;"><tr><th>Kota Tujuan</th><th class="text-end">Jumlah</th><th class="text-end">Total Ongkir</th></tr></thead>
                        <tbody>
                        <?php
                        $kotaTujuan = $summary['per_kota_tujuan'] ?? [];
                        usort($kotaTujuan, function ($a, $b) { return $b['omset'] <=> $a['omset']; });
                        foreach ($kotaTujuan as $k): ?>
                        <tr><td class="fw-semibold"><?= htmlspecialchars($k['label']) ?></td><td class="text-end"><?= number_format($k['jumlah']) ?></td><td class="text-end fw-semibold">Rp<?= number_format($k['omset']) ?></td></tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- LEADERBOARD -->
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <h6 class="fw-bold mb-3">Leaderboard & Loyalitas User (Top 100)</h6>
            <div style="max-height: 440px; overflow-y: auto;">
            <table class="table table-sm table-hover mb-0 align-middle">
                <thead class="table-light" style="position: sticky; top: 0; z-index: 1;"><tr><th>#</th><th>Nama</th><th>ID</th><th>Kota Asal</th><th>Kategori</th><th>Ekspedisi Dominan</th><th class="text-end">Total Ongkir</th><th class="text-end">Jumlah AWB</th></tr></thead>
                <tbody>
                <?php foreach (($summary['leaderboard_user'] ?? []) as $i => $u):
                    $rankBadge = $i === 0 ? 'bg-warning text-dark' : ($i === 1 ? 'bg-secondary' : ($i === 2 ? 'bg-danger-subtle text-danger-emphasis' : 'bg-light text-muted'));
                ?>
                <tr>
                    <td><span class="badge rounded-pill <?= $rankBadge ?>" style="min-width: 2em;"><?= $i + 1 ?></span></td>
                    <td class="fw-semibold"><?= htmlspecialchars($u['nama']) ?></td><td class="text-muted"><?= htmlspecialchars($u['id']) ?></td>
                    <td><?= htmlspecialchars($u['kota_asal']) ?></td><td><span class="badge bg-light text-dark border"><?= htmlspecialchars($u['kategori']) ?></span></td><td><?= htmlspecialchars($u['ekspedisi_dominan']) ?></td>
                    <td class="text-end fw-bold">Rp<?= number_format($u['total_ongkir']) ?></td><td class="text-end"><?= number_format($u['jumlah_awb']) ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>

        <!-- MATRIKS MULTIKURIR & RADAR NON-JNE -->
        <div class="row g-4 mb-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3">Matriks Penetrasi Multikurir per Agen (Top 100)</h6>
                    <div style="max-height: 440px; overflow: auto;">
                    <table class="table table-sm table-hover mb-0 align-middle">
                        <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                            <tr>
                                <th>Nama</th>
                                <?php foreach (($summary['matriks_kolom_ekspedisi'] ?? []) as $eks): ?><th class="text-end"><?= htmlspecialchars($eks) ?></th><?php endforeach; ?>
                                <th class="text-end">Lainnya</th><th class="text-end">Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach (($summary['matriks_user_ekspedisi'] ?? []) as $row): ?>
                        <tr>
                            <td class="fw-semibold"><?= htmlspecialchars($row['nama']) ?></td>
                            <?php foreach (($summary['matriks_kolom_ekspedisi'] ?? []) as $eks): ?><td class="text-end text-muted"><?= ($row['per_ekspedisi'][$eks] ?? 0) > 0 ? number_format($row['per_ekspedisi'][$eks]) : '–' ?></td><?php endforeach; ?>
                            <td class="text-end text-muted"><?= $row['lainnya'] > 0 ? number_format($row['lainnya']) : '–' ?></td>
                            <td class="text-end"><span class="badge bg-primary-subtle text-primary-emphasis"><?= number_format($row['grand_total']) ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3">Radar Deteksi Agen Non-JNE (Aktif)</h6>
                    <div style="max-height: 440px; overflow-y: auto;">
                    <table class="table table-sm table-hover mb-0 align-middle">
                        <thead class="table-light" style="position: sticky; top: 0; z-index: 1;"><tr><th>Nama</th><th>Ekspedisi</th><th class="text-end">Total Ongkir</th></tr></thead>
                        <tbody>
                        <?php foreach (($summary['radar_non_jne'] ?? []) as $r): ?>
                        <tr><td class="fw-semibold"><?= htmlspecialchars($r['nama']) ?></td><td><span class="badge bg-info-subtle text-info-emphasis"><?= htmlspecialchars($r['ekspedisi_dominan']) ?></span></td><td class="text-end fw-bold">Rp<?= number_format($r['total_ongkir']) ?></td></tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- LOG AKTIVITAS -->
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <h6 class="fw-bold mb-3">Log Aktivitas Transaksi Terakhir</h6>
            <div style="max-height: 320px; overflow-y: auto;">
            <table class="table table-sm table-hover mb-0 align-middle">
                <thead class="table-light" style="position: sticky; top: 0; z-index: 1;"><tr><th>AWB</th><th>Nama User</th><th>Ekspedisi</th><th>Tanggal</th></tr></thead>
                <tbody>
                <?php foreach (($summary['recent_activity'] ?? []) as $a): ?>
                <tr><td><?= htmlspecialchars($a['awb']) ?></td><td><?= htmlspecialchars($a['nama']) ?></td><td><?= htmlspecialchars($a['ekspedisi']) ?></td><td><?= htmlspecialchars($a['tanggal']) ?></td></tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>

    <?php endif; ?>
    </div>
</section>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script>
const summary = <?= json_encode($summary ?: new stdClass()) ?>;
Chart.register(ChartDataLabels);
Chart.defaults.set('plugins.datalabels', { display: false }); // default off, diaktifkan per-chart di bawah

function fmtRp(v) {
    if (Math.abs(v) >= 1e9) return 'Rp' + (v/1e9).toFixed(2) + 'M';
    if (Math.abs(v) >= 1e6) return 'Rp' + (v/1e6).toFixed(1) + 'jt';
    if (Math.abs(v) >= 1e3) return 'Rp' + (v/1e3).toFixed(0) + 'rb';
    return 'Rp' + v;
}

const commonPlugins = { legend: { position: 'top', labels: { boxWidth: 14, padding: 16, font: { size: 12, weight: '600' } } } };

if (summary && summary.total_resi) {
    new Chart(document.getElementById('chartBulanan'), {
        type: 'line',
        data: {
            labels: summary.per_bulan.map(r => r.bulan),
            datasets: [
                { label: 'Non-COD', data: summary.per_bulan.map(r => r.omset_noncod), borderColor: '#7335B7', backgroundColor: 'rgba(115,53,183,0.1)', fill: true, tension: 0.3, pointRadius: 4, pointBackgroundColor: '#7335B7',
                  datalabels: { align: 'top', anchor: 'end', color: '#7335B7' } },
                { label: 'COD', data: summary.per_bulan.map(r => r.omset_cod), borderColor: '#F3700D', backgroundColor: 'rgba(243,112,13,0.1)', fill: true, tension: 0.3, pointRadius: 4, pointBackgroundColor: '#F3700D',
                  datalabels: { align: 'bottom', anchor: 'start', color: '#F3700D' } },
            ]
        },
        options: {
            maintainAspectRatio: false,
            layout: { padding: { top: 28, bottom: 8 } },
            plugins: { ...commonPlugins, datalabels: { display: true, font: { size: 10, weight: 'bold' }, formatter: fmtRp, clip: false } }
        }
    });

    const hariOrder = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
    const hariData = [...summary.per_hari_minggu].sort((a,b) => hariOrder.indexOf(a.label) - hariOrder.indexOf(b.label));
    new Chart(document.getElementById('chartHariMinggu'), {
        type: 'bar',
        data: { labels: hariData.map(r => r.label), datasets: [{ label: 'Jumlah Resi', data: hariData.map(r => r.jumlah), backgroundColor: '#7335B7', borderRadius: 6 }] },
        options: {
            maintainAspectRatio: false,
            layout: { padding: { top: 24 } },
            plugins: { legend: { display: false }, datalabels: { display: true, anchor: 'end', align: 'top', color: '#333', font: { size: 10, weight: 'bold' }, formatter: v => v.toLocaleString() } }
        }
    });

    function donutPct(v, ctx) {
        const total = ctx.dataset.data.reduce((a,b)=>a+b,0);
        const pct = total > 0 ? (v/total*100) : 0;
        return pct >= 4 ? pct.toFixed(1) + '%' : '';
    }
    const eksSorted = [...summary.per_ekspedisi].sort((a,b) => b.omset - a.omset);
    new Chart(document.getElementById('chartEkspedisi'), {
        type: 'doughnut',
        data: { labels: eksSorted.map(r => r.label), datasets: [{ data: eksSorted.map(r => r.omset), backgroundColor: ['#7335B7','#F3700D','#17a2b8','#28a745','#ffc107','#dc3545','#6f42c1','#20c997','#adb5bd'] }] },
        options: { maintainAspectRatio: false, plugins: { ...commonPlugins, datalabels: { display: true, color: '#fff', font: { weight: 'bold', size: 11 }, formatter: donutPct } } }
    });

    const svcSorted = [...summary.per_service].sort((a,b) => b.jumlah - a.jumlah);
    new Chart(document.getElementById('chartService'), {
        type: 'doughnut',
        data: { labels: svcSorted.map(r => r.label), datasets: [{ data: svcSorted.map(r => r.jumlah), backgroundColor: ['#7335B7','#F3700D','#17a2b8','#28a745','#ffc107','#dc3545','#6f42c1','#20c997','#adb5bd'] }] },
        options: { maintainAspectRatio: false, plugins: { ...commonPlugins, datalabels: { display: true, color: '#fff', font: { weight: 'bold', size: 11 }, formatter: donutPct } } }
    });

    function stackedPct(rows) {
        return rows.map(r => {
            const total = (r.BERHASIL||0) + (r.PROSES||0) + (r.RETUR||0);
            return total > 0 ? { label: r.label, berhasil: r.BERHASIL/total*100, proses: r.PROSES/total*100, retur: r.RETUR/total*100 } : { label: r.label, berhasil: 0, proses: 0, retur: 0 };
        });
    }
    const stackedLabels = { display: true, color: '#fff', font: { size: 10, weight: 'bold' }, formatter: v => v >= 6 ? v.toFixed(0) + '%' : '' };
    const skData = stackedPct(summary.status_by_kategori);
    new Chart(document.getElementById('chartStatusKategori'), {
        type: 'bar',
        data: {
            labels: skData.map(r => r.label),
            datasets: [
                { label: 'Berhasil', data: skData.map(r => r.berhasil), backgroundColor: '#28a745' },
                { label: 'Proses', data: skData.map(r => r.proses), backgroundColor: '#ffc107' },
                { label: 'Retur', data: skData.map(r => r.retur), backgroundColor: '#dc3545' },
            ]
        },
        options: { maintainAspectRatio: false, indexAxis: 'y', scales: { x: { stacked: true, max: 100 }, y: { stacked: true } }, plugins: { ...commonPlugins, datalabels: stackedLabels } }
    });

    // Chart Rasio Keberhasilan per Ekspedisi: tinggi menyesuaikan jumlah baris ekspedisi supaya tiap bar tidak terlalu tipis.
    const seData = stackedPct(summary.status_by_ekspedisi).sort((a, b) => b.berhasil + b.proses + b.retur - (a.berhasil + a.proses + a.retur));
    const seHeight = Math.max(220, seData.length * 42);
    document.getElementById('statusEkspedisiWrap').style.height = seHeight + 'px';
    new Chart(document.getElementById('chartStatusEkspedisi'), {
        type: 'bar',
        data: {
            labels: seData.map(r => r.label),
            datasets: [
                { label: 'Berhasil', data: seData.map(r => r.berhasil), backgroundColor: '#28a745' },
                { label: 'Proses', data: seData.map(r => r.proses), backgroundColor: '#ffc107' },
                { label: 'Retur', data: seData.map(r => r.retur), backgroundColor: '#dc3545' },
            ]
        },
        options: {
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: { x: { stacked: true, max: 100 }, y: { stacked: true, ticks: { autoSkip: false } } },
            plugins: { ...commonPlugins, datalabels: stackedLabels },
            datasets: { bar: { barPercentage: 0.7, categoryPercentage: 0.8 } }
        }
    });

    function renderMap(elId, points) {
        const map = L.map(elId).setView([-2.5, 118], 4.3);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap' }).addTo(map);
        if (!points.length) return;
        const maxJumlah = Math.max(...points.map(p => p.jumlah), 1);
        points.forEach(p => {
            const r = 4 + (p.jumlah / maxJumlah) * 20;
            L.circleMarker([p.lat, p.lng], { radius: r, color: '#7335B7', fillColor: '#7335B7', fillOpacity: 0.5, weight: 1 })
                .bindTooltip(`${p.kota}: ${p.jumlah.toLocaleString()} resi, Rp${p.omset.toLocaleString()}`)
                .addTo(map);
        });
    }
    renderMap('mapAsal', summary.peta_kota_asal || []);
    renderMap('mapTujuan', summary.peta_kota_tujuan || []);
}
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
