<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php renderHead('Dashboard'); ?>
</head>
<body>

<?php if (!$is_logged_in): ?>
    <?php renderLogin(isset($error) ? $error : null); ?>
<?php else: ?>

    <?php renderNavbar('dashboard'); ?>

    <main class="container py-5">
        <?php
            $db_data = getDB();
            $totalAccounts = count($db_data['accounts']);
            $totalWA = count($db_data['whatsapp_numbers']);
            $wa_aktif = 0;
            $wa_banned = 0;
            $warnings = [];

            foreach ($db_data['whatsapp_numbers'] as $wa) {
                if ($wa['status'] == 'Aktif') $wa_aktif++;
                if ($wa['status'] == 'Mati/Banned') $wa_banned++;

                // Peringatan Kuota (< 1000 MB)
                $kuotaClean = (int)preg_replace('/[^0-9]/', '', (string)$wa['kuota']);
                if ($kuotaClean > 0 && $kuotaClean <= 1000) {
                    $warnings[] = [
                        'type' => 'kuota',
                        'nomor' => $wa['nomor'],
                        'nama' => $wa['nama'],
                        'msg' => 'Sisa kuota menipis (' . number_format($kuotaClean, 0, ',', '.') . ' MB)'
                    ];
                }

                // Peringatan Masa Aktif (< 7 hari atau sudah lewat)
                if (!empty($wa['aktif'])) {
                    $aktifDate = strtotime($wa['aktif']);
                    if ($aktifDate !== false) {
                        $diffDays = ($aktifDate - time()) / (60 * 60 * 24);
                        if ($diffDays < 0) {
                            $warnings[] = [
                                'type' => 'expired',
                                'nomor' => $wa['nomor'],
                                'nama' => $wa['nama'],
                                'msg' => 'Masa aktif sudah lewat tanggal ' . date('d M Y', $aktifDate)
                            ];
                        } else if ($diffDays <= 7) {
                            $warnings[] = [
                                'type' => 'warning',
                                'nomor' => $wa['nomor'],
                                'nama' => $wa['nama'],
                                'msg' => 'Masa aktif segera habis dalam ' . floor($diffDays) . ' hari (' . date('d M Y', $aktifDate) . ')'
                            ];
                        }
                    }
                }
            }
        ?>
        <div class="d-flex align-items-center mb-4">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                <i class="fas fa-chart-pie fs-4"></i>
            </div>
            <h2 class="fw-bold mb-0 text-primary">Ringkasan Sistem</h2>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card card-glass h-100 border-0 p-4 position-relative overflow-hidden">
                    <div class="position-absolute" style="top: -20px; right: -20px; opacity: 0.05;">
                        <i class="fas fa-users" style="font-size: 100px;"></i>
                    </div>
                    <p class="text-muted mb-1 small fw-bold text-uppercase">Total Akun</p>
                    <h2 class="display-5 fw-bold text-primary mb-0"><?= $totalAccounts ?></h2>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card card-glass h-100 border-0 p-4 position-relative overflow-hidden">
                    <div class="position-absolute" style="top: -20px; right: -20px; opacity: 0.05;">
                        <i class="fas fa-mobile-alt" style="font-size: 100px;"></i>
                    </div>
                    <p class="text-muted mb-1 small fw-bold text-uppercase">Total Nomor WA</p>
                    <h2 class="display-5 fw-bold text-primary mb-0"><?= $totalWA ?></h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-glass h-100 border-0 p-4 position-relative overflow-hidden border-start border-success border-4">
                    <div class="position-absolute" style="top: -20px; right: -20px; opacity: 0.05; color: #198754;">
                        <i class="fas fa-check-circle" style="font-size: 100px;"></i>
                    </div>
                    <p class="text-muted mb-1 small fw-bold text-uppercase">WA Aktif</p>
                    <h2 class="display-5 fw-bold text-success mb-0"><?= $wa_aktif ?></h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-glass h-100 border-0 p-4 position-relative overflow-hidden border-start border-danger border-4">
                    <div class="position-absolute" style="top: -20px; right: -20px; opacity: 0.05; color: #dc3545;">
                        <i class="fas fa-times-circle" style="font-size: 100px;"></i>
                    </div>
                    <p class="text-muted mb-1 small fw-bold text-uppercase">WA Mati / Banned</p>
                    <h2 class="display-5 fw-bold text-danger mb-0"><?= $wa_banned ?></h2>
                </div>
            </div>
        </div>

        <?php if (count($warnings) > 0): ?>
        <div class="d-flex align-items-center mb-3">
            <i class="fas fa-exclamation-triangle text-warning me-2 fs-4"></i>
            <h4 class="fw-bold mb-0 text-dark">Peringatan Cerdas <span class="badge bg-danger rounded-pill fs-6 ms-2"><?= count($warnings) ?></span></h4>
        </div>
        <div class="card border-0 shadow-sm mb-5 rounded-4 overflow-hidden" style="border-left: 5px solid #ffc107 !important;">
            <div class="list-group list-group-flush">
                <?php foreach ($warnings as $w): ?>
                <div class="list-group-item p-3 bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <?php if ($w['type'] === 'kuota'): ?>
                            <i class="fas fa-sim-card text-warning me-2"></i>
                        <?php else: ?>
                            <i class="fas fa-calendar-times text-danger me-2"></i>
                        <?php endif; ?>
                        <span class="fw-bold"><?= htmlspecialchars($w['nomor']) ?> (<?= htmlspecialchars($w['nama']) ?>)</span>
                        <span class="ms-2 text-muted">- <?= $w['msg'] ?></span>
                    </div>
                    <a href="whatsapp.php?search=<?= urlencode($w['nomor']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill">Cek</a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="d-flex align-items-center mb-3">
            <i class="fas fa-history text-muted me-2"></i>
            <h4 class="fw-bold mb-0">Log Aktivitas Terakhir</h4>
        </div>
        <div class="card card-glass border-0 overflow-hidden">
            <ul class="list-group list-group-flush">
                <?php
                $logs = array_slice($db_data['logs'], 0, 5);
                if (count($logs) > 0) {
                    foreach ($logs as $log) {
                        echo '<li class="list-group-item p-3 d-flex justify-content-between align-items-center bg-transparent">';
                        echo '<div><i class="fas fa-info-circle text-primary me-2"></i><span class="fw-medium">'.htmlspecialchars($log['action']).'</span></div>';
                        echo '<span class="text-muted small">'.date('d M Y H:i', strtotime($log['created_at'])).'</span>';
                        echo '</li>';
                    }
                } else {
                    echo '<li class="list-group-item p-4 text-center text-muted bg-transparent">Belum ada aktivitas.</li>';
                }
                ?>
            </ul>
        </div>
    </main>

<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
