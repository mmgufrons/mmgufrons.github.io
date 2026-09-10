<?php
session_start();
require_once __DIR__ . '/../includes/firebase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;
    $input = json_decode(file_get_contents('php://input'), true);
    $item_key = $input['item_key'] ?? '';
    $done = !empty($input['done']);
    if ($item_key === '') {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "item_key wajib diisi"]);
        exit;
    }
    firebase_put('/edc_todo/' . $item_key, $done);
    echo json_encode(["status" => "success"]);
    exit;
}

$page_title = "To Do EDC | SIMASRIM Data";
$footer_desc = "Dokumen Internal Terbatas - Divisi Data & IT.";
$base_path = '../';
include __DIR__ . '/../includes/header.php';

$todo_status = firebase_get('/edc_todo') ?: [];

$todo_groups = [
    "Trial APK + EDC" => [
        "trial_create_resi"   => "Create resi — sudah berjalan normal",
        "trial_detail_resi"   => "Detail resi — masih ada bug, perlu diperbaiki",
        "trial_cetak_resi"    => "Cetak resi kertas — belum tersedia",
    ],
    "Marketing Kit Agen EDC SIMASRIM_3" => [
        "mk_video_tutor"      => "Video Tutor Lanjutan",
        "mk_stiker_qr"        => "Box stiker QR upgrade (bahan tebal) — vendor Camel",
        "mk_brosur"           => "Brosur (opsional — referensi alat promosi Fastpay)",
        "mk_sales_story"      => "Konten Story Sales/Reseller (segmen Millenial/Boomer)",
    ],
    "Campaign EDC User Aktif" => [
        "campaign_cicilan"    => "Privilege cicilan tanpa terasa potong untuk user aktif",
    ],
];

$todo_links = [
    "mk_brosur" => "https://www.fastpay.co.id/blog/alat-promosi-fastpay",
    "campaign_cicilan" => "https://www.canva.com/design/DAG1EkkKqbA/9_cmICCQ3n6h5G6ltBuFng/edit",
];
?>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: #fd7e14;"></div>

    <div class="container position-relative z-1">
        <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25 shadow-sm"><i class="fas fa-list-check me-2"></i>Tracker Internal</span>
        <h2 class="display-5 fw-bold mb-2">To Do EDC</h2>
        <p class="text-white-50 mb-0">Daftar pekerjaan yang tertunda seputar EDC — status tersimpan bersama, terlihat oleh semua tim.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">

        <?php foreach ($todo_groups as $group_name => $items): ?>
        <div class="step-card bg-white p-4 rounded-4 mb-4" style="border-left: 5px solid var(--primary);">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-layer-group me-2 text-primary"></i><?= htmlspecialchars($group_name) ?></h5>
            <div class="d-flex flex-column gap-2">
                <?php foreach ($items as $key => $label): $checked = !empty($todo_status[$key]); ?>
                <label class="d-flex align-items-start gap-2 p-2 rounded todo-item" style="cursor: pointer;">
                    <input type="checkbox" class="form-check-input mt-1 todo-checkbox" data-key="<?= htmlspecialchars($key) ?>" <?= $checked ? 'checked' : '' ?>>
                    <span class="small <?= $checked ? 'text-muted text-decoration-line-through' : 'text-dark' ?>" data-label-for="<?= htmlspecialchars($key) ?>">
                        <?= htmlspecialchars($label) ?>
                        <?php if (isset($todo_links[$key])): ?>
                            — <a href="<?= htmlspecialchars($todo_links[$key]) ?>" target="_blank" class="text-decoration-none">Lihat referensi <i class="fas fa-external-link-alt fa-xs"></i></a>
                        <?php endif; ?>
                    </span>
                </label>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</section>

<script>
document.querySelectorAll('.todo-checkbox').forEach(function (cb) {
    cb.addEventListener('change', function () {
        const key = this.dataset.key;
        const done = this.checked;
        const label = document.querySelector('[data-label-for="' + key + '"]');
        if (label) label.classList.toggle('text-decoration-line-through', done);
        if (label) label.classList.toggle('text-muted', done);
        if (label) label.classList.toggle('text-dark', !done);

        fetch(window.location.pathname, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ item_key: key, done: done })
        }).catch(function (err) {
            console.error('Gagal menyimpan status To Do', err);
        });
    });
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
