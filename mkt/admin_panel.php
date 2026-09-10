<?php
session_start();
$page_title = "Admin Panel | SIMASRIM Operations";
$base_path = './';

// PORTOFOLIO DEMO: password asli dihapus, diganti password demo publik.
$admin_password = 'demo123';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error = "Password salah!";
    }
}

if (isset($_GET['logout'])) {
    unset($_SESSION['admin_logged_in']);
    header("Location: admin_panel.php");
    exit;
}

$logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<!-- SheetJS (XLSX) -->
<script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>

<div class="px-4 pt-5 pb-4 mb-4 shadow-sm" style="background: radial-gradient(circle at top right, #3A1B5E, #1F0D3D, #0f0c29); color: white; border-radius: 0 0 30px 30px; position: relative; overflow: hidden;">
    <div class="position-absolute" style="width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; top: -50px; right: -50px;"></div>
    <div class="position-relative z-1 pt-lg-3">
        <span class="badge bg-white bg-opacity-25 text-white rounded-pill px-3 py-2 mb-3"><i class="fas fa-cogs me-2 text-warning"></i>Admin Only</span>
        <h2 class="fw-bold mb-2">Admin Panel ⚙️</h2>
        <p class="text-white-50 mb-0">Manajemen Data Ekosistem dan Sinkronisasi Firebase.</p>
    </div>
</div>

<style>
#adminTabs .nav-link.active {
    background-color: var(--primary) !important;
    color: white !important;
}
</style>

<div class="container-fluid px-4 pb-5">

<?php if (!$logged_in): ?>
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-5">
                    <h4 class="text-center fw-bold mb-4" style="color: #5A2A8F;">Verifikasi Akses Admin</h4>
                    <div class="alert alert-info rounded-3 small"><i class="fas fa-circle-info me-2"></i>Mode Demo Portofolio — password: <b>demo123</b></div>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger rounded-3"><i class="fas fa-exclamation-circle me-2"></i><?= $error ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small">Kata Sandi Khusus Admin</label>
                            <input type="password" name="password" class="form-control form-control-lg bg-light" placeholder="Masukkan password..." required autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 rounded-3">Login Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    
    <div class="card border-0 shadow-lg rounded-4 mb-5 overflow-hidden" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
        <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0"><i class="fas fa-database me-2 text-primary"></i>Manajemen Data Firebase</h5>
            <div>
                <button class="btn btn-warning btn-sm me-2 fw-bold shadow-sm" onclick="syncLocal()" id="btnSyncLocal" style="color: #856404;">
                    <i class="fas fa-cloud-download-alt me-1"></i> Sync Data Awal (Dari File)
                </button>
                <a href="?logout=1" class="btn btn-outline-danger btn-sm fw-bold"><i class="fas fa-sign-out-alt me-1"></i>Keluar</a>
            </div>
        </div>
        <div class="card-body p-0">
            <ul class="nav nav-pills p-3 bg-light border-bottom gap-2" id="adminTabs">
                <li class="nav-item">
                    <a class="nav-link active fw-bold px-4 rounded-pill shadow-sm" data-bs-toggle="pill" href="#mitra"><i class="fas fa-users me-2"></i>Mitra Area</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold px-4 rounded-pill shadow-sm text-secondary" data-bs-toggle="pill" href="#marketing" onclick="this.classList.remove('text-secondary')"><i class="fas fa-bullhorn me-2"></i>Marketing Kit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold px-4 rounded-pill shadow-sm text-secondary" data-bs-toggle="pill" href="#coverage" onclick="this.classList.remove('text-secondary')"><i class="fas fa-map-marked-alt me-2"></i>Coverage Ekspedisi</a>
                </li>
            </ul>
            
            <div class="tab-content p-4 p-md-5">
                <!-- MITRA AREA TAB -->
                <div class="tab-pane fade show active" id="mitra">
                    <div class="alert border-0 rounded-3 small mb-4" style="background-color: var(--bg-soft-purple); color: var(--primary-dark); border-left: 4px solid var(--primary) !important;">
                        <i class="fas fa-info-circle me-2"></i><strong>Petunjuk:</strong> Jika tabel kosong, klik tombol <strong>Sync Data Awal</strong> di pojok kanan atas untuk memuat data bawaan sistem.
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3 text-success"><i class="fas fa-file-excel me-2"></i>Spreadsheets Mitra</h6>
                            <div class="table-responsive border rounded-4 shadow-sm">
                                <table class="table table-hover mb-0 align-middle" id="tableSpreadsheets">
                                    <thead class="table-light"><tr><th class="ps-4">Nama / Kategori</th><th>URL Link</th><th width="80" class="text-center">Aksi</th></tr></thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <button class="btn btn-sm btn-light border text-success mt-3 fw-bold rounded-pill px-3 shadow-sm" onclick="addRow('tableSpreadsheets')"><i class="fas fa-plus me-1"></i> Tambah Baris Baru</button>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3 text-info"><i class="fas fa-chart-pie me-2"></i>Looker Studio Mitra</h6>
                            <div class="table-responsive border rounded-4 shadow-sm">
                                <table class="table table-hover mb-0 align-middle" id="tableLookers">
                                    <thead class="table-light"><tr><th class="ps-4">Nama / Kategori</th><th>URL Link</th><th width="80" class="text-center">Aksi</th></tr></thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <button class="btn btn-sm btn-light border text-info mt-3 fw-bold rounded-pill px-3 shadow-sm" onclick="addRow('tableLookers')"><i class="fas fa-plus me-1"></i> Tambah Baris Baru</button>
                        </div>
                    </div>
                    <hr class="my-5 border-light">
                    <div class="text-end">
                        <button class="btn btn-primary fw-bold px-5 py-2 rounded-pill shadow-sm" id="btnSaveMitra" onclick="saveMitra()"><i class="fas fa-save me-2"></i>Simpan Perubahan Mitra</button>
                    </div>
                </div>
                
                <!-- MARKETING KIT TAB -->
                <div class="tab-pane fade" id="marketing">
                    <h6 class="fw-bold mb-3" style="color: #8e44ad;"><i class="fas fa-palette me-2"></i>Daftar Marketing Kit (EDC)</h6>
                    <div class="table-responsive border rounded-4 shadow-sm">
                        <table class="table table-hover mb-0 align-middle" id="tableMarketing">
                            <thead class="table-light"><tr><th class="ps-4">Nama Item (ex: X-Banner)</th><th>URL Canva / Drive</th><th width="80" class="text-center">Aksi</th></tr></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <button class="btn btn-sm btn-light border mt-3 fw-bold rounded-pill px-3 shadow-sm" style="color: #8e44ad;" onclick="addRow('tableMarketing')"><i class="fas fa-plus me-1"></i> Tambah Baris Baru</button>
                    
                    <hr class="my-5 border-light">
                    <div class="text-end">
                        <button class="btn btn-primary fw-bold px-5 py-2 rounded-pill shadow-sm" id="btnSaveMarketing" onclick="saveMarketing()"><i class="fas fa-save me-2"></i>Simpan Perubahan Marketing Kit</button>
                    </div>
                </div>
                
                <!-- COVERAGE TAB -->
                <div class="tab-pane fade" id="coverage">
                    <h6 class="fw-bold mb-3 text-warning text-darken-2"><i class="fas fa-map-marked-alt me-2"></i>Update Coverage Ekspedisi (Via Excel)</h6>
                    <div class="alert alert-warning border-warning border-opacity-50 bg-warning bg-opacity-10 rounded-4 p-4 mb-4">
                        <div class="d-flex">
                            <i class="fas fa-info-circle fs-3 me-3 text-warning mt-1"></i>
                            <div>
                                <h6 class="fw-bold text-dark">Cara Update Coverage:</h6>
                                <p class="small text-dark mb-0">Upload file Excel (.xlsx / .xls) data coverage baru. Sistem akan menggabungkan (merge) data secara otomatis berdasarkan Provinsi, Kota, dan Kecamatan. Jika kecamatan sudah ada, data baru akan menimpa (update).</p>
                                <p class="small text-danger mt-2 mb-0 fw-bold"><i class="fas fa-exclamation-triangle me-1"></i> Pastikan baris pertama adalah Header dan urutan kolom adalah: <strong>Provinsi, Kota, Kecamatan, Bits, Kategori.</strong></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card bg-light border-0 rounded-4 p-4 text-center mb-4 border" style="border: 2px dashed #dee2e6 !important;">
                        <i class="fas fa-file-excel fs-1 text-success mb-3"></i>
                        <h6 class="fw-bold">Pilih File Excel Coverage</h6>
                        <input type="file" id="excelCoverage" class="form-control form-control-lg mx-auto shadow-sm mt-3" accept=".xlsx, .xls" style="max-width: 500px;">
                    </div>
                    
                    <div class="text-center">
                        <button class="btn btn-warning fw-bold px-5 py-3 rounded-pill shadow-sm text-dark" id="btnUploadCoverage" onclick="uploadCoverage()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Mulai Upload & Merge Data
                        </button>
                    </div>
                    <div id="coverageResult" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Utilities for tables
        function createRowHtml(k = '', v = '') {
            return `<tr>
                <td><input type="text" class="form-control bg-light border-0" value="${k}" placeholder="Nama"></td>
                <td><input type="text" class="form-control bg-light border-0" value="${v}" placeholder="https://..."></td>
                <td class="text-center align-middle"><button class="btn btn-sm btn-outline-danger border-0" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></td>
            </tr>`;
        }
        
        function addRow(tableId) {
            document.querySelector(`#${tableId} tbody`).insertAdjacentHTML('beforeend', createRowHtml());
        }
        
        function extractTableData(tableId) {
            const data = {};
            document.querySelectorAll(`#${tableId} tbody tr`).forEach(tr => {
                const inputs = tr.querySelectorAll('input');
                const k = inputs[0].value.trim();
                const v = inputs[1].value.trim();
                if (k && v) data[k] = v;
            });
            return data;
        }

        // Sync Local Initial
        function syncLocal() {
            if(!confirm("Apakah kamu yakin ingin me-reset/sync data awal dari lokal (hardcoded) ke Firebase? Data yang ada di Firebase akan tertimpa!")) return;
            const btn = document.getElementById('btnSyncLocal');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Syncing...'; 
            btn.disabled = true;

            fetch('admin_api.php?action=sync_local', { method: 'POST' })
                .then(r => r.json())
                .then(res => {
                    if (res.status === 'success') {
                        alert(res.message);
                        loadMitra();
                        loadMarketing();
                    } else {
                        alert("Gagal melakukan sync!");
                    }
                })
                .catch(e => alert("Error: " + e.message))
                .finally(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
        }
        
        // Load Data Mitra
        function loadMitra() {
            fetch('admin_api.php?action=get_mitra')
                .then(r => r.json())
                .then(data => {
                    const tbodyS = document.querySelector('#tableSpreadsheets tbody');
                    tbodyS.innerHTML = '';
                    for (const [k, v] of Object.entries(data.spreadsheets || {})) {
                        tbodyS.insertAdjacentHTML('beforeend', createRowHtml(k, v));
                    }
                    if (Object.keys(data.spreadsheets || {}).length === 0) addRow('tableSpreadsheets');
                    
                    const tbodyL = document.querySelector('#tableLookers tbody');
                    tbodyL.innerHTML = '';
                    for (const [k, v] of Object.entries(data.lookers || {})) {
                        tbodyL.insertAdjacentHTML('beforeend', createRowHtml(k, v));
                    }
                    if (Object.keys(data.lookers || {}).length === 0) addRow('tableLookers');
                });
        }
        
        // Save Data Mitra
        function saveMitra() {
            const btn = document.getElementById('btnSaveMitra');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...'; 
            btn.disabled = true;
            
            const payload = {
                spreadsheets: extractTableData('tableSpreadsheets'),
                lookers: extractTableData('tableLookers')
            };
            
            fetch('admin_api.php?action=save_mitra', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(payload)
            }).then(r => r.json()).then(res => {
                if(res.status === 'success') alert('Berhasil menyimpan data Mitra!');
            }).finally(() => {
                btn.innerHTML = originalText; 
                btn.disabled = false;
            });
        }
        
        // Load Data Marketing
        function loadMarketing() {
            fetch('admin_api.php?action=get_marketing')
                .then(r => r.json())
                .then(data => {
                    const tbodyM = document.querySelector('#tableMarketing tbody');
                    tbodyM.innerHTML = '';
                    for (const [k, v] of Object.entries(data.marketing || {})) {
                        tbodyM.insertAdjacentHTML('beforeend', createRowHtml(k, v));
                    }
                    if (Object.keys(data.marketing || {}).length === 0) addRow('tableMarketing');
                });
        }
        
        // Save Marketing
        function saveMarketing() {
            const btn = document.getElementById('btnSaveMarketing');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...'; 
            btn.disabled = true;
            
            const payload = { marketing: extractTableData('tableMarketing') };
            
            fetch('admin_api.php?action=save_marketing', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(payload)
            }).then(r => r.json()).then(res => {
                if(res.status === 'success') alert('Berhasil menyimpan Marketing Kit!');
            }).finally(() => {
                btn.innerHTML = originalText; 
                btn.disabled = false;
            });
        }
        
        // Upload Coverage
        function uploadCoverage() {
            const fileInput = document.getElementById('excelCoverage');
            if (!fileInput.files.length) {
                alert('Pilih file Excel terlebih dahulu!');
                return;
            }
            
            const btn = document.getElementById('btnUploadCoverage');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Membaca Excel...'; 
            btn.disabled = true;
            
            const file = fileInput.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                try {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {type: 'array'});
                    const firstSheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[firstSheetName];
                    
                    // Convert to 2D array, header: 1 means array of arrays
                    const jsonArr = XLSX.utils.sheet_to_json(worksheet, {header: 1});
                    
                    // Hapus baris header (asumsi baris 1 adalah header)
                    if (jsonArr.length > 0 && isNaN(parseInt(jsonArr[0][3]))) { // cek apakah kolom ke-4 (bits) bukan angka, berarti header
                        jsonArr.shift();
                    }
                    
                    // Filter baris kosong
                    const validData = jsonArr.filter(row => row.length >= 5 && row[0] && row[1] && row[2]);
                    
                    if (validData.length === 0) {
                        throw new Error("Tidak ada data valid yang ditemukan. Pastikan format kolom sesuai.");
                    }
                    
                    btn.innerHTML = '<i class="fas fa-cloud-upload-alt me-2"></i>Uploading...';
                    
                    // Send to backend
                    fetch('admin_api.php?action=upload_coverage', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ data: validData })
                    }).then(r => r.json()).then(res => {
                        if(res.status === 'success') {
                            document.getElementById('coverageResult').innerHTML = `<div class="alert alert-success fw-bold"><i class="fas fa-check-circle me-2"></i>Berhasil! Total data coverage sekarang: ${res.total} baris.</div>`;
                            fileInput.value = '';
                        } else {
                            alert('Gagal upload: ' + (res.message || 'Error tidak diketahui'));
                        }
                    }).catch(e => {
                        alert('Terjadi kesalahan koneksi saat upload.');
                    }).finally(() => {
                        btn.innerHTML = originalText; 
                        btn.disabled = false;
                    });
                    
                } catch(err) {
                    btn.innerHTML = originalText; 
                    btn.disabled = false;
                    alert("Gagal membaca Excel: " + err.message);
                }
            };
            
            reader.readAsArrayBuffer(file);
        }
        
        // Initial load
        window.onload = () => {
            loadMitra();
            loadMarketing();
        };
    </script>
<?php endif; ?>

</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
