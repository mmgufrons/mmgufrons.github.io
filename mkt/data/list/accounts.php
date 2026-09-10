<?php
require_once 'config.php';

if (!$is_logged_in) {
    header("Location: index.php");
    exit;
}

// Handle CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db_data = getDB();
    try {
        if (isset($_POST['add'])) {
            $db_data['accounts'][] = [
                'id' => generateId(),
                'kategori' => $_POST['kategori'],
                'platform' => $_POST['platform'],
                'email' => $_POST['email'],
                'account_key' => $_POST['account_key'],
                'keterangan' => $_POST['keterangan']
            ];
            saveDB($db_data);
            addLog("Menambahkan Akun: " . $_POST['platform']);
            header("Location: accounts.php"); exit;
        }
        if (isset($_POST['edit'])) {
            foreach ($db_data['accounts'] as &$a) {
                if ($a['id'] == $_POST['id']) {
                    $a['kategori'] = $_POST['kategori'];
                    $a['platform'] = $_POST['platform'];
                    $a['email'] = $_POST['email'];
                    $a['account_key'] = $_POST['account_key'];
                    $a['keterangan'] = $_POST['keterangan'];
                    break;
                }
            }
            saveDB($db_data);
            addLog("Mengubah Akun: " . $_POST['platform']);
            header("Location: accounts.php"); exit;
        }
        if (isset($_POST['delete'])) {
            $db_data['accounts'] = array_filter($db_data['accounts'], function($a) {
                return $a['id'] != $_POST['id'];
            });
            $db_data['accounts'] = array_values($db_data['accounts']);
            saveDB($db_data);
            addLog("Menghapus Akun ID: " . $_POST['id']);
            header("Location: accounts.php"); exit;
        }
        if (isset($_POST['edit_category'])) {
            $old_cat = strtoupper(trim($_POST['old_category']));
            $new_cat = strtoupper(trim($_POST['new_category']));
            $bg_color = $_POST['bg_color'];
            $text_color = $_POST['text_color'];

            // Update all accounts in this category
            if ($old_cat !== $new_cat) {
                foreach ($db_data['accounts'] as &$a) {
                    if (strtoupper(trim($a['kategori'])) === $old_cat) {
                        $a['kategori'] = $new_cat;
                    }
                }
            }

            // Update category metadata
            if (!isset($db_data['category_meta'])) $db_data['category_meta'] = [];
            $db_data['category_meta'][$new_cat] = [
                'bg' => $bg_color,
                'color' => $text_color
            ];

            saveDB($db_data);
            addLog("Mengubah Kategori: $old_cat -> $new_cat");
            header("Location: accounts.php"); exit;
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo '<div style="max-width:900px;margin:40px auto;padding:24px;background:#fff3f3;border:1px solid #f5c2c2;border-radius:16px;font-family:sans-serif;">';
        echo '<h3 style="color:#c0392b;margin-top:0;">⚠️ Gagal Menyimpan Data</h3>';
        echo '<p>Perubahan tidak tersimpan karena masalah koneksi ke database. Coba lagi beberapa saat.</p>';
        echo '<pre style="white-space:pre-wrap;background:#fff;padding:12px;border-radius:8px;font-size:13px;">' . htmlspecialchars($e->getMessage()) . '</pre>';
        echo '<a href="accounts.php" style="display:inline-block;margin-top:8px;color:#7335B7;font-weight:600;">&larr; Kembali ke Manajemen Akun</a>';
        echo '</div>';
        exit;
    }
}

$db_data = getDB();
$accounts = $db_data['accounts'];
usort($accounts, function($a, $b) {
    return strcasecmp($a['platform'], $b['platform']);
});

$categories = array_unique(array_column($accounts, 'kategori'));
$categories = array_filter($categories, function($c) { return $c !== ''; });
sort($categories);

$platforms = array_unique(array_column($accounts, 'platform'));
$platforms = array_filter($platforms, function($p) { return $p !== ''; });
sort($platforms);

$category_meta_json = json_encode(isset($db_data['category_meta']) ? $db_data['category_meta'] : []);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php renderHead('Manajemen Akun'); ?>
    <style>
        .hover-opacity:hover { opacity: 0.85; transition: opacity 0.2s; }
        table.dataTable td { white-space: nowrap; }
        /* Style for RowGroup headers */
        tr.dtrg-group th {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
            font-size: 1.1rem;
            padding: 12px 20px !important;
            border-bottom: 2px solid #cbd5e1 !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.4.0/css/rowGroup.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.bootstrap5.min.css">
</head>
<body>

<?php renderNavbar('accounts'); ?>

<main class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0"><i class="fas fa-users me-2"></i> Manajemen Akun</h2>
        <button class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fas fa-plus me-1"></i> Tambah Akun
        </button>
    </div>

    <div class="card card-glass border-0 overflow-hidden">
        <div class="card-body p-4">
            <div>
                <table id="accountsTable" class="table table-hover align-middle w-100" style="white-space: nowrap; width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary fw-bold text-center" style="width: 40px;">#</th>
                            <th class="text-secondary fw-bold">Kategori</th>
                            <th class="text-secondary fw-bold">Platform/Akun</th>
                            <th class="text-secondary fw-bold">Email/No HP/ID</th>
                            <th class="text-secondary fw-bold">Key/PW</th>
                            <th class="text-secondary fw-bold border-0">Keterangan</th>
                            <th class="text-secondary fw-bold border-0 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <?php $no = 1; foreach ($accounts as $row): ?>
                        <tr style="cursor: pointer;" onclick="editData(<?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>)">
                            <td class="text-center fw-bold text-muted"><?= $no++ ?></td>
                            <td><span class="badge bg-soft-purple text-primary"><?= htmlspecialchars($row['kategori']) ?></span></td>
                            <td class="fw-bold"><?= htmlspecialchars($row['platform']) ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span><?= htmlspecialchars($row['email']) ?></span>
                                    <button type="button" onclick="copyText(event, '<?= htmlspecialchars($row['email']) ?>')" class="btn btn-sm btn-link text-muted p-0" title="Copy"><i class="fas fa-copy"></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-muted" style="font-family: monospace;">••••••••</span>
                                    <button type="button" onclick="copyText(event, '<?= htmlspecialchars($row['account_key']) ?>')" class="btn btn-sm btn-link text-muted p-0" title="Copy Key"><i class="fas fa-copy"></i></button>
                                </div>
                            </td>
                            <td class="text-muted small text-truncate" style="max-width: 200px;" title="<?= htmlspecialchars($row['keterangan']) ?>"><?= htmlspecialchars($row['keterangan']) ?></td>
                            <td class="text-center" onclick="event.stopPropagation();">
                                <form method="POST" id="deleteForm_<?= $row['id'] ?>" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="button" onclick="confirmDelete('<?= $row['id'] ?>')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary">Tambah Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Kategori (Pilih atau Ketik Baru)</label>
                            <input list="kategori_list_add" name="kategori" class="form-control" placeholder="Cari atau buat kategori...">
                            <datalist id="kategori_list_add">
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Platform/Akun</label>
                            <input list="platform_list_add" name="platform" class="form-control" placeholder="Cari atau buat platform..." required>
                            <datalist id="platform_list_add">
                                <?php foreach($platforms as $plt): ?>
                                    <option value="<?= htmlspecialchars($plt) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Email/No HP/ID</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Key/PW</label>
                        <input type="text" name="account_key" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2"></textarea>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary w-100 rounded-pill fw-bold">Simpan Akun</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary">Edit Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Kategori (Pilih atau Ketik Baru)</label>
                            <input list="kategori_list" name="kategori" id="edit_kategori" class="form-control" placeholder="Cari atau buat kategori...">
                            <datalist id="kategori_list">
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Platform/Akun</label>
                            <input list="platform_list_add" name="platform" id="edit_platform" class="form-control" placeholder="Cari atau buat platform..." required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Email/No HP/ID</label>
                        <input type="text" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Key/PW</label>
                        <input type="text" name="account_key" id="edit_account_key" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">Keterangan</label>
                        <textarea name="keterangan" id="edit_keterangan" class="form-control" rows="2"></textarea>
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary w-100 rounded-pill fw-bold">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary">Edit Kategori (Massal)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="old_category" id="cat_old_name">
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Nama Kategori</label>
                        <input type="text" name="new_category" id="cat_new_name" class="form-control fw-bold" required>
                        <small class="text-muted">Mengubah nama ini akan mengubah nama kategori pada semua akun terkait.</small>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <label class="form-label text-muted small fw-bold">Warna Latar (Background)</label>
                            <input type="color" name="bg_color" id="cat_bg_color" class="form-control form-control-color w-100" title="Pilih warna latar">
                            
                            <div class="d-flex gap-1 mt-2 flex-wrap">
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #f8d7da;" onclick="document.getElementById('cat_bg_color').value='#f8d7da'"></button>
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #cce5ff;" onclick="document.getElementById('cat_bg_color').value='#cce5ff'"></button>
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #d4edda;" onclick="document.getElementById('cat_bg_color').value='#d4edda'"></button>
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #fff3cd;" onclick="document.getElementById('cat_bg_color').value='#fff3cd'"></button>
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #e2e3e5;" onclick="document.getElementById('cat_bg_color').value='#e2e3e5'"></button>
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #e0cff2;" onclick="document.getElementById('cat_bg_color').value='#e0cff2'"></button>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted small fw-bold">Warna Teks (Font)</label>
                            <input type="color" name="text_color" id="cat_text_color" class="form-control form-control-color w-100" title="Pilih warna teks">
                            
                            <div class="d-flex gap-1 mt-2 flex-wrap">
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #721c24;" onclick="document.getElementById('cat_text_color').value='#721c24'"></button>
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #004085;" onclick="document.getElementById('cat_text_color').value='#004085'"></button>
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #155724;" onclick="document.getElementById('cat_text_color').value='#155724'"></button>
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #856404;" onclick="document.getElementById('cat_text_color').value='#856404'"></button>
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #383d41;" onclick="document.getElementById('cat_text_color').value='#383d41'"></button>
                                <button type="button" class="btn btn-sm rounded-circle" style="width: 25px; height: 25px; background: #4a2377;" onclick="document.getElementById('cat_text_color').value='#4a2377'"></button>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" name="edit_category" class="btn btn-primary w-100 rounded-pill fw-bold">Simpan Kategori</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- DataTables RowGroup -->
<script src="https://cdn.datatables.net/rowgroup/1.4.0/js/dataTables.rowGroup.min.js"></script>
<!-- DataTables FixedHeader -->
<script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const categoryMeta = <?= $category_meta_json ?>;

    function getColor(str) {
        let hash = 0;
        for (let i = 0; i < str.length; i++) hash = str.charCodeAt(i) + ((hash << 5) - hash);
        return `hsl(${Math.abs(hash) % 360}, 70%, 90%)`;
    }

    $(document).ready(function() {
        var t = $('#accountsTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
            order: [[1, 'asc']],
            pageLength: -1,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            scrollX: true,
            fixedHeader: { headerOffset: 70 },
            search: {
                search: "<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
            },
            rowGroup: {
                dataSrc: 1,
                startRender: function (rows, group) {
                    let rawGroup = $('<div>').html(group).text().trim();
                    let bg = getColor(rawGroup);
                    let color = '#1e293b';
                    if (categoryMeta[rawGroup]) {
                        if (categoryMeta[rawGroup].bg) bg = categoryMeta[rawGroup].bg;
                        if (categoryMeta[rawGroup].color) color = categoryMeta[rawGroup].color;
                    }

                    return $('<tr/>').append(
                        $('<th/>')
                            .attr('colspan', 6)
                            .css({
                                'cursor': 'pointer',
                                'background-color': bg,
                                'color': color,
                                'font-size': '1.1rem',
                                'padding': '12px 20px',
                                'border-bottom': '2px solid rgba(0,0,0,0.1)'
                            })
                            .addClass('fw-bold text-uppercase hover-opacity')
                            .attr('title', 'Klik untuk edit nama/warna kategori')
                            .text(rawGroup + ' ')
                            .append('<i class="fas fa-edit ms-2 opacity-50"></i>')
                            .on('click', function() { editCategory(rawGroup); })
                    );
                }
            },
            columnDefs: [
                { targets: 1, visible: false },
                { orderable: false, targets: 6 }
            ]
        });
        
        t.on('order.dt search.dt', function () {
            let i = 1;
            t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    });

    function copyText(e, text) {
        if (e) e.stopPropagation();
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).catch(err => console.error("Clipboard API failed: ", err));
        } else {
            let tmp = document.createElement("textarea");
            tmp.value = text;
            tmp.style.position = "fixed";
            tmp.style.opacity = "0";
            document.body.appendChild(tmp);
            tmp.select();
            try { document.execCommand("copy"); } catch (err) { console.error("Fallback copy failed: ", err); }
            document.body.removeChild(tmp);
        }
        
        // Micro-interaction
        if (e && e.target) {
            let btn = e.target.closest('button');
            if (btn) {
                let icon = btn.querySelector('i');
                if (icon) {
                    icon.className = 'fas fa-check text-success';
                    setTimeout(() => icon.className = 'fas fa-copy', 1000);
                }
            }
        }
        
        // Toast Notification
        if (typeof Swal !== 'undefined') {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
            Toast.fire({
                icon: "success",
                title: "Tersalin ke clipboard"
            });
        }
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Data?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm_'+id).submit();
            }
        });
    }

    function editCategory(catName) {
        document.getElementById('cat_old_name').value = catName;
        document.getElementById('cat_new_name').value = catName;
        
        // Load existing colors if set
        if (categoryMeta[catName]) {
            document.getElementById('cat_bg_color').value = categoryMeta[catName].bg || '#ffffff';
            document.getElementById('cat_text_color').value = categoryMeta[catName].color || '#000000';
        } else {
            // Convert HSL to HEX for default is tricky, just default to white/black picker start
            document.getElementById('cat_bg_color').value = '#f1f5f9';
            document.getElementById('cat_text_color').value = '#1e293b';
        }
        
        var catModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        catModal.show();
    }

    function editData(data) {
        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_kategori').value = data.kategori;
        document.getElementById('edit_platform').value = data.platform;
        document.getElementById('edit_email').value = data.email;
        document.getElementById('edit_account_key').value = data.account_key;
        document.getElementById('edit_keterangan').value = data.keterangan;
        
        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    }
</script>
</body>
</html>
