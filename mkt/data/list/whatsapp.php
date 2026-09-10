<?php
require_once 'config.php';

if (!$is_logged_in) {
    header("Location: index.php");
    exit;
}

// Handle CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db_data = getDB();
    if (isset($_POST['add'])) {
        $db_data['whatsapp_numbers'][] = [
            'id' => generateId(),
            'kategori' => $_POST['kategori'],
            'status' => $_POST['status'],
            'pic' => $_POST['pic'],
            'nama' => $_POST['nama'],
            'email' => $_POST['email'],
            'provider' => $_POST['provider'],
            'nomor' => $_POST['nomor'],
            'slot_wa' => $_POST['slot_wa'],
            'devices' => $_POST['devices'],
            'slot_kartu' => $_POST['slot_kartu'],
            'pulsa' => $_POST['pulsa'],
            'kuota' => $_POST['kuota'],
            'aktif' => $_POST['aktif'],
            'brand' => $_POST['brand'],
            'area' => $_POST['area'],
            'keterangan' => $_POST['keterangan']
        ];
        saveDB($db_data);
        addLog("Menambahkan WA: " . $_POST['nomor']);
        header("Location: whatsapp.php"); exit;
    }
    if (isset($_POST['edit'])) {
        foreach ($db_data['whatsapp_numbers'] as &$wa) {
            if ($wa['id'] == $_POST['id']) {
                $wa['kategori'] = $_POST['kategori'];
                $wa['status'] = $_POST['status'];
                $wa['pic'] = $_POST['pic'];
                $wa['nama'] = $_POST['nama'];
                $wa['email'] = $_POST['email'];
                $wa['provider'] = $_POST['provider'];
                $wa['nomor'] = $_POST['nomor'];
                $wa['slot_wa'] = $_POST['slot_wa'];
                $wa['devices'] = $_POST['devices'];
                $wa['slot_kartu'] = $_POST['slot_kartu'];
                $wa['pulsa'] = $_POST['pulsa'];
                $wa['kuota'] = $_POST['kuota'];
                $wa['aktif'] = $_POST['aktif'];
                $wa['brand'] = $_POST['brand'];
                $wa['area'] = $_POST['area'];
                $wa['keterangan'] = $_POST['keterangan'];
                break;
            }
        }
        saveDB($db_data);
        addLog("Mengubah WA: " . $_POST['nomor']);
        header("Location: whatsapp.php"); exit;
    }
    if (isset($_POST['delete'])) {
        $db_data['whatsapp_numbers'] = array_filter($db_data['whatsapp_numbers'], function($wa) {
            return $wa['id'] != $_POST['id'];
        });
        $db_data['whatsapp_numbers'] = array_values($db_data['whatsapp_numbers']);
        saveDB($db_data);
        addLog("Menghapus WA ID: " . $_POST['id']);
        header("Location: whatsapp.php"); exit;
    }
}

$db_data = getDB();
$numbers = $db_data['whatsapp_numbers'];

// Ambil list Kategori dari Akun dan WA
$catAcc = array_column($db_data['accounts'], 'kategori');
$catWa = array_column($numbers, 'kategori');
$categories = array_unique(array_merge($catAcc, $catWa));
$categories = array_filter($categories, function($c) { return !empty($c); });
sort($categories);

usort($numbers, function($a, $b) {
    $cmp = strcasecmp($a['nama'], $b['nama']);
    return $cmp === 0 ? strcasecmp($a['nomor'], $b['nomor']) : $cmp;
});

// Get distinct PIC for the datalist dropdown
$pics = array_unique(array_column($numbers, 'pic'));
$pics = array_filter($pics, function($c) { return $c !== ''; });
sort($pics);

// Brands Datalist
$brands = array_unique(array_column($numbers, 'brand'));
$brands = array_filter($brands, function($c) { return $c !== ''; });
sort($brands);

// Devices Datalist
$devices_list = array_unique(array_column($numbers, 'devices'));
$devices_list = array_filter($devices_list, function($c) { return $c !== ''; });
sort($devices_list);

function getStatusBadge($status) {
    switch (strtolower($status)) {
        case 'aktif': return '<span class="badge bg-success shadow-sm">Aktif</span>';
        case 'mati/banned': return '<span class="badge bg-danger shadow-sm">Banned</span>';
        case 'limit': return '<span class="badge bg-secondary shadow-sm">Limit</span>';
        case 'warning': return '<span class="badge bg-warning text-dark shadow-sm">Warning</span>';
        default: return '<span class="badge bg-light text-dark border">'.htmlspecialchars($status).'</span>';
    }
}

function getProviderBadge($provider) {
    $p = strtolower(trim($provider));
    if (!$p) return '';
    $color = 'bg-secondary';
    if (strpos($p, 'telkomsel') !== false || strpos($p, 'simpati') !== false || strpos($p, 'as') !== false) $color = 'bg-danger';
    else if (strpos($p, 'indosat') !== false || strpos($p, 'im3') !== false) $color = 'bg-warning text-dark';
    else if (strpos($p, 'xl') !== false || strpos($p, 'axis') !== false) $color = 'bg-primary';
    else if (strpos($p, '3') !== false || strpos($p, 'tri') !== false) $color = 'bg-dark';
    else if (strpos($p, 'smartfren') !== false) $color = 'bg-danger bg-gradient';
    
    return "<span class='badge {$color}'>".htmlspecialchars($provider)."</span>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php renderHead('Tracking WhatsApp'); ?>
    <style>
        .dt-buttons .btn { border-radius: 20px; }
        table.dataTable td { white-space: nowrap; }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.bootstrap5.min.css">
</head>
<body>

<?php renderNavbar('whatsapp'); ?>

<main class="container-fluid py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0"><i class="fas fa-comment-dots me-2"></i> Tracking WhatsApp</h2>
        <button class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold" data-bs-toggle="modal" data-bs-target="#waModal" onclick="prepareAdd()">
            <i class="fas fa-plus me-1"></i> Tambah Nomor
        </button>
    </div>

    <div class="card card-glass border-0 overflow-hidden">
        <div class="card-body p-4">
            
            <!-- Filter Bar -->
            <div class="row g-2 mb-3">
                <div class="col-md-2">
                    <select id="filterKategori" class="form-select form-select-sm rounded-pill shadow-sm">
                        <option value="">Semua Kategori</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="filterStatus" class="form-select form-select-sm rounded-pill shadow-sm">
                        <option value="">Semua Status</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="filterPIC" class="form-select form-select-sm rounded-pill shadow-sm">
                        <option value="">Semua PIC</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="filterProvider" class="form-select form-select-sm rounded-pill shadow-sm">
                        <option value="">Semua Provider</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="filterBrand" class="form-select form-select-sm shadow-sm rounded-pill">
                        <option value="">Semua Brand</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="filterDevice" class="form-select form-select-sm shadow-sm rounded-pill">
                        <option value="">Semua Device</option>
                    </select>
                </div>
            </div>

            <div>
                <table id="waTable" class="table table-hover align-middle w-100" style="white-space: nowrap; width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary fw-bold text-center" style="width: 40px;">#</th>
                            <th class="text-secondary fw-bold">Kategori</th>
                            <th class="text-secondary fw-bold">Status</th>
                            <th class="text-secondary fw-bold">Nomor</th>
                            <th class="text-secondary fw-bold">PIC</th>
                            <th class="text-secondary fw-bold">Nama</th>
                            <th class="text-secondary fw-bold">Pulsa</th>
                            <th class="text-secondary fw-bold">Kuota</th>
                            <th class="text-secondary fw-bold">Provider</th>
                            <th class="text-secondary fw-bold">Brand</th>
                            <th class="text-secondary fw-bold">Area</th>
                            <th class="text-secondary fw-bold">Devices</th>
                            <th class="text-secondary fw-bold">Slot WA</th>
                            <th class="text-secondary fw-bold">Slot Kartu</th>
                            <th class="text-secondary fw-bold">Aktif (Tgl)</th>
                            <th class="text-secondary fw-bold">Keterangan</th>
                            <th class="text-secondary fw-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <?php 
                        $no = 1; 
                        foreach ($numbers as $row): 
                            $pulsaClean = (int)preg_replace('/[^0-9]/', '', (string)$row['pulsa']);
                            $pulsaFormatted = $pulsaClean > 0 ? 'Rp ' . number_format($pulsaClean, 0, ',', '.') : htmlspecialchars($row['pulsa']);
                            
                            // Format Tanggal
                            $aktifFormatted = htmlspecialchars($row['aktif']);
                            if (!empty($row['aktif'])) {
                                $time = strtotime($row['aktif']);
                                if ($time) $aktifFormatted = date('d M Y', $time);
                            }
                        ?>
                        <tr style="cursor: pointer;" class="hover-opacity" onclick="editData(<?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>)">
                            <td class="text-center fw-bold text-muted"><?= $no++ ?></td>
                            <td class="text-center"><?= getDynamicBadge($row['kategori'] ?? '', $db_data['category_meta'] ?? []) ?></td>
                            <td><?= getStatusBadge($row['status']) ?></td>
                            <td class="fw-bold text-primary">
                                <?= htmlspecialchars($row['nomor']) ?>
                                <button type="button" onclick="copyText(event, '<?= htmlspecialchars($row['nomor']) ?>')" class="btn btn-sm btn-link text-muted p-0 ms-1" title="Copy"><i class="fas fa-copy"></i></button>
                            </td>
                            <td class="text-center"><?= getDynamicBadge($row['pic']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><span class="badge bg-light text-dark border"><?= $pulsaFormatted ?></span></td>
                            <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($row['kuota']) ?></span></td>
                            <td class="text-center"><?= getProviderBadge($row['provider']) ?></td>
                            <td class="text-center"><?= getDynamicBadge($row['brand']) ?></td>
                            <td class="text-muted small"><?= htmlspecialchars($row['area']) ?></td>
                            <td class="text-muted small"><?= htmlspecialchars($row['devices']) ?></td>
                            <td class="text-center text-muted small"><?= htmlspecialchars($row['slot_wa']) ?></td>
                            <td class="text-center text-muted small"><?= htmlspecialchars($row['slot_kartu']) ?></td>
                            <td class="text-muted small"><?= $aktifFormatted ?></td>
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

<!-- Unified Modal for Add / Edit -->
<div class="modal fade" id="waModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary" id="modalTitle">Form WhatsApp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="waForm">
                    <input type="hidden" name="id" id="f_id">
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label text-muted small fw-bold">Nomor WA</label>
                            <input type="text" name="nomor" id="f_nomor" class="form-control fw-bold" required>
                        </div>
                        <div class="col-md-4"><label class="form-label text-muted small fw-bold">Kategori</label>
                            <input list="kategori_list" name="kategori" id="f_kategori" class="form-control" placeholder="Opsional...">
                            <datalist id="kategori_list">
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        <div class="col-md-4"><label class="form-label text-muted small fw-bold">Status</label>
                            <select name="status" id="f_status" class="form-select" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Mati/Banned">Mati/Banned</option>
                                <option value="Limit">Limit</option>
                                <option value="Warning">Warning</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label text-muted small fw-bold">PIC (Pilih atau Ketik Baru)</label>
                            <input list="pic_list" name="pic" id="f_pic" class="form-control" placeholder="Cth: Raka, Winda, Mba Sinta">
                            <datalist id="pic_list">
                                <?php foreach($pics as $pic): ?>
                                    <option value="<?= htmlspecialchars($pic) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        
                        <div class="col-md-4"><label class="form-label text-muted small fw-bold">Nama</label><input type="text" name="nama" id="f_nama" class="form-control"></div>
                        <div class="col-md-4"><label class="form-label text-muted small fw-bold">Email</label><input type="email" name="email" id="f_email" class="form-control"></div>
                        <div class="col-md-4">
                            <label class="form-label text-muted small fw-bold">Provider</label>
                            <select name="provider" id="f_provider" class="form-select">
                                <option value="">Pilih Provider...</option>
                                <option value="Telkomsel">Telkomsel</option>
                                <option value="Indosat">Indosat</option>
                                <option value="XL">XL</option>
                                <option value="3">3</option>
                                <option value="Axis">Axis</option>
                                <option value="Smartfren">Smartfren</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4"><label class="form-label text-primary small fw-bold">Sisa Pulsa (Rp)</label><input type="text" name="pulsa" id="f_pulsa" class="form-control border-primary"></div>
                        <div class="col-md-4">
                            <label class="form-label text-primary small fw-bold">Sisa Kuota</label>
                            <div class="input-group">
                                <input type="number" name="kuota" id="f_kuota" class="form-control border-primary" step="0.01">
                                <span class="input-group-text bg-primary text-white border-primary">MB</span>
                            </div>
                        </div>
                        <div class="col-md-4"><label class="form-label text-muted small fw-bold">Aktif (Tgl)</label><input type="date" name="aktif" id="f_aktif" class="form-control"></div>

                        <div class="col-md-3"><label class="form-label text-muted small fw-bold">Brand</label><input type="text" name="brand" id="f_brand" class="form-control"></div>
                        <div class="col-md-3"><label class="form-label text-muted small fw-bold">Area</label><input type="text" name="area" id="f_area" class="form-control"></div>
                        <div class="col-md-3">
                            <label class="form-label text-muted small fw-bold">Devices</label>
                            <input list="devices_list_data" name="devices" id="f_devices" class="form-control" placeholder="Cth: iPhone 12, Samsung">
                            <datalist id="devices_list_data">
                                <?php foreach($devices_list as $dev): ?>
                                    <option value="<?= htmlspecialchars($dev) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        
                        <div class="col-md-3"><label class="form-label text-muted small fw-bold">Slot WA / Kartu</label>
                            <div class="input-group">
                                <select name="slot_wa" id="f_slot_wa" class="form-select">
                                    <option value="">WA</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                </select>
                                <select name="slot_kartu" id="f_slot_kartu" class="form-select">
                                    <option value="">Kartu</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12"><label class="form-label text-muted small fw-bold">Keterangan</label><textarea name="keterangan" id="f_keterangan" class="form-control" rows="2"></textarea></div>
                    </div>
                    
                    <button type="submit" name="add" id="submitBtn" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow-sm">Simpan Data WA</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- DataTables FixedHeader -->
<script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var t = $('#waTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
            order: [[5, 'asc']], // Sort by Nama (index 5 because of Kategori)
            columnDefs: [{ searchable: false, orderable: false, targets: 0 }],
            pageLength: -1,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            scrollX: true,
            fixedHeader: { headerOffset: 70 },
            search: {
                search: "<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
            }
        });
        
        t.on('order.dt search.dt', function () {
            let i = 1;
            t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();

        // Initialize Filters (Strip HTML tags & Case Insensitive)
        function stripHtml(html) { return $('<div>').html(html).text().trim(); }
        
        function populateFilter(colIdx, selectId) {
            let uniqueVals = [];
            t.column(colIdx).data().each(function(d) {
                let txt = stripHtml(d);
                if (txt) {
                    let searchTxt = txt.toLowerCase();
                    if (!uniqueVals.find(v => v.toLowerCase() === searchTxt)) {
                        uniqueVals.push(txt);
                    }
                }
            });
            uniqueVals.sort().forEach(function(val) {
                $('#' + selectId).append('<option value="'+val+'">'+val+'</option>');
            });
        }
        
        populateFilter(1, 'filterKategori');
        populateFilter(2, 'filterStatus');
        populateFilter(4, 'filterPIC');
        populateFilter(8, 'filterProvider');
        populateFilter(9, 'filterBrand');
        populateFilter(11, 'filterDevice');

        $('#filterKategori').on('change', function() {
            t.column(1).search($(this).val() ? $(this).val() : '', false, false).draw();
        });
        $('#filterStatus').on('change', function() {
            t.column(2).search($(this).val() ? $(this).val() : '', false, false).draw();
        });
        $('#filterPIC').on('change', function() {
            t.column(4).search($(this).val() ? $(this).val() : '', false, false).draw();
        });
        $('#filterProvider').on('change', function() {
            t.column(8).search($(this).val() ? $(this).val() : '', false, false).draw();
        });
        $('#filterBrand').on('change', function() {
            t.column(9).search($(this).val() ? $(this).val() : '', false, false).draw();
        });
        $('#filterDevice').on('change', function() {
            t.column(11).search($(this).val() ? $(this).val() : '', false, false).draw();
        });
    });

    // SweetAlert Delete Confirm
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

    var waModal;
    document.addEventListener("DOMContentLoaded", function() {
        waModal = new bootstrap.Modal(document.getElementById('waModal'));
    });

    function prepareAdd() {
        document.getElementById('waForm').reset();
        document.getElementById('modalTitle').innerText = "Tambah WhatsApp Baru";
        document.getElementById('submitBtn').name = "add";
        document.getElementById('submitBtn').classList.replace("btn-success", "btn-primary");
        document.getElementById('f_id').value = '';
    }

    function editData(data) {
        document.getElementById('modalTitle').innerText = "Edit WhatsApp";
        document.getElementById('submitBtn').name = "edit";
        document.getElementById('submitBtn').classList.replace("btn-primary", "btn-success");
        
        ['id','kategori','status','pic','nama','email','provider','nomor','slot_wa','devices','slot_kartu','pulsa','kuota','aktif','brand','area','keterangan'].forEach(field => {
            if(document.getElementById('f_'+field)) {
                document.getElementById('f_'+field).value = data[field] || '';
            }
        });
        waModal.show();
    }
</script>
</body>
</html>
