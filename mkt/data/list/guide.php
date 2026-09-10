<?php
require_once 'config.php';
if (!$is_logged_in) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php renderHead('Panduan Penggunaan'); ?>
    <style>
        .icon-circle { width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .step-card { border-left: 4px solid var(--primary); transition: transform 0.2s; }
        .step-card:hover { transform: translateX(5px); }
    </style>
</head>
<body>
    <?= renderNavbar('guide') ?>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary mb-3"><i class="fas fa-book-open"></i> Pusat Bantuan & Panduan</h1>
            <p class="text-muted lead">Pelajari cara menggunakan sistem Manajemen Aset ini dengan mudah dan efisien.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion shadow-sm" id="guideAccordion" style="border-radius: 15px; overflow: hidden;">
                    
                    <!-- 1. Menambah Data -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#guide1">
                                <i class="fas fa-plus-circle text-primary me-3"></i> 1. Cara Menambah Data (Akun & WhatsApp)
                            </button>
                        </h2>
                        <div id="guide1" class="accordion-collapse collapse show" data-bs-parent="#guideAccordion">
                            <div class="accordion-body bg-light pt-4">
                                <p>Sistem ini menyediakan 2 cara untuk menambah data aset (Akun maupun WhatsApp):</p>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 shadow-sm step-card">
                                            <div class="card-body">
                                                <h6 class="fw-bold text-success"><i class="fas fa-file-excel me-2"></i> Cara Massal (Impor Excel)</h6>
                                                <ol class="small text-muted mb-0 ps-3">
                                                    <li class="mb-2">Buka menu <strong>Impor Excel</strong> di navigasi atas.</li>
                                                    <li class="mb-2">Unduh <a href="import.php" class="text-decoration-none">Template Excel</a> jika belum punya.</li>
                                                    <li class="mb-2">Isi data pada Sheet <strong>WhatsApp</strong> dan <strong>Akun</strong> sesuai format tabel.</li>
                                                    <li>Pilih file tersebut, klik <strong>Upload & Proses</strong>. Sistem cerdas kami akan mendeteksi dan menyimpan ribuan data dalam hitungan detik!</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 shadow-sm step-card" style="border-left-color: #ffc107;">
                                            <div class="card-body">
                                                <h6 class="fw-bold text-warning"><i class="fas fa-hand-pointer me-2"></i> Cara Manual (Satu per Satu)</h6>
                                                <ol class="small text-muted mb-0 ps-3">
                                                    <li class="mb-2">Buka menu <strong>Akun</strong> atau <strong>WhatsApp</strong>.</li>
                                                    <li class="mb-2">Klik tombol biru <strong>+ Tambah Data</strong> di pojok kanan atas tabel.</li>
                                                    <li class="mb-2">Sebuah formulir (Popup) akan muncul.</li>
                                                    <li>Isi data dengan lengkap, lalu klik <strong>Simpan</strong>.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Peringatan Cerdas -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#guide2">
                                <i class="fas fa-bell text-danger me-3"></i> 2. Membaca Peringatan Cerdas (Dashboard)
                            </button>
                        </h2>
                        <div id="guide2" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                            <div class="accordion-body bg-light">
                                <p>Di halaman <strong>Dashboard</strong>, sistem akan terus memantau seluruh nomor WhatsApp 24 jam nonstop. Sistem akan menampilkan 2 jenis peringatan:</p>
                                
                                <ul class="list-group list-group-flush rounded shadow-sm mb-3">
                                    <li class="list-group-item d-flex align-items-start p-3">
                                        <div class="icon-circle bg-danger bg-opacity-10 text-danger me-3"><i class="fas fa-calendar-times"></i></div>
                                        <div>
                                            <strong class="d-block mb-1">Peringatan Masa Aktif (H-7)</strong>
                                            <span class="text-muted small">Jika ada nomor WA yang masa aktifnya tersisa 7 hari (atau sudah kedaluwarsa), nomor tersebut akan masuk ke daftar ini. Segera lakukan pengisian ulang agar nomor tidak hangus.</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start p-3">
                                        <div class="icon-circle bg-warning bg-opacity-10 text-warning me-3"><i class="fas fa-sim-card"></i></div>
                                        <div>
                                            <strong class="d-block mb-1">Peringatan Kuota Sekarat (< 1000 MB)</strong>
                                            <span class="text-muted small">Jika ada kartu yang sisa kuotanya di bawah 1 GB (1000 MB), sistem akan menyalakan alarm peringatan agar bisa segera disiapkan pengisian paket data.</span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="alert alert-info border-0 d-flex align-items-center mb-0">
                                    <i class="fas fa-lightbulb fs-4 me-3 text-info"></i>
                                    <small><strong>Tips:</strong> Klik tombol <strong>"Cek"</strong> pada daftar peringatan untuk langsung melompat ke detail nomor tersebut di halaman WhatsApp!</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Pencarian & Filter -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#guide3">
                                <i class="fas fa-search text-success me-3"></i> 3. Mencari & Menyaring Data (Filter)
                            </button>
                        </h2>
                        <div id="guide3" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                            <div class="accordion-body bg-light">
                                <p>Sistem dilengkapi mesin pencarian *Real-Time*. Cukup ketik apapun di kotak <strong>"Search:"</strong> (bisa cari nama PIC, nomor WA, status, dll) dan tabel akan langsung menyaring data seketika.</p>
                                
                                <h6 class="fw-bold mt-4 mb-3">Gunakan Filter Khusus (Halaman WhatsApp)</h6>
                                <p class="text-muted small">Untuk mencari kriteria spesifik, gunakan 4 kotak *Dropdown* di atas tabel WhatsApp:</p>
                                <div class="row text-center g-3 mb-3">
                                    <div class="col-6 col-md-3">
                                        <div class="p-3 bg-white border rounded shadow-sm">
                                            <i class="fas fa-thermometer-half text-danger fs-4 mb-2"></i><br>
                                            <strong>Status</strong><br>
                                            <small class="text-muted">Cari yang "Mati" atau "Aktif"</small>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="p-3 bg-white border rounded shadow-sm">
                                            <i class="fas fa-user-circle text-primary fs-4 mb-2"></i><br>
                                            <strong>PIC</strong><br>
                                            <small class="text-muted">Lihat nomor pegangan CS tertentu</small>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="p-3 bg-white border rounded shadow-sm">
                                            <i class="fas fa-signal text-warning fs-4 mb-2"></i><br>
                                            <strong>Provider</strong><br>
                                            <small class="text-muted">Cari khusus Telkomsel, XL, dll</small>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="p-3 bg-white border rounded shadow-sm">
                                            <i class="fas fa-mobile-alt text-success fs-4 mb-2"></i><br>
                                            <strong>Brand / Devices</strong><br>
                                            <small class="text-muted">Cari berdasarkan letak HP/Perangkat</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Manajemen Akun -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#guide4">
                                <i class="fas fa-layer-group text-info me-3"></i> 4. Manajemen & Pengelompokan Kategori Akun
                            </button>
                        </h2>
                        <div id="guide4" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                            <div class="accordion-body bg-light">
                                <p>Halaman <strong>Akun</strong> menggunakan sistem tampilan *RowGroup* di mana data akun otomatis dikelompokkan berdasarkan <strong>Kategorinya</strong> (Misal: TIKTOK, INSTAGRAM).</p>
                                
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-body">
                                        <h6 class="fw-bold"><i class="fas fa-paint-brush text-primary me-2"></i> Cara Mengubah Nama & Mewarnai Kategori:</h6>
                                        <ol class="text-muted small mb-0">
                                            <li class="mb-2">Arahkan kursor ke judul/header Kategori di dalam tabel (contoh: baris lebar bertuliskan <strong>TIKTOK</strong>).</li>
                                            <li class="mb-2">Klik judul tersebut. Sebuah <strong>Popup Edit Kategori</strong> akan muncul.</li>
                                            <li class="mb-2">Di popup ini, ubah nama kategori sesuai kebutuhan. Sistem akan mengubah nama kategori pada seluruh akun di bawahnya secara otomatis.</li>
                                            <li>Tentukan pilihan <strong>Warna Latar</strong> dan <strong>Warna Teks</strong> (bisa dari pilihan standar, atau ikon warna untuk kode kustom).</li>
                                            <li>Klik <strong>Simpan</strong> untuk menerapkan gaya warna tersebut di dalam tabel.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
