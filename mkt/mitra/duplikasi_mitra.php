<?php 
$page_title = "SOP Duplikasi Area Mitra | SIMASRIM Data";
$footer_desc = "Dokumen Internal Terbatas - Divisi Data & IT.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25" style="background-color: #2c3e50;"><i class="fa-solid fa-cogs me-2"></i>System Setup</span>
        <h2 class="display-5 fw-bold mb-2">SOP Ekspansi Area Baru</h2>
        <p class="text-white-50 mb-0">Panduan teknis langkah-demi-langkah melakukan instalasi sistem pelaporan terotomatisasi (Spreadsheet Auto-Sync & Looker Studio) untuk perwakilan Mitra Area yang baru.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">
        
        <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <span class="badge bg-success mb-2"><i class="fas fa-table me-1"></i> Langkah 1</span>
                <h4 class="fw-bold text-dark mb-1">Instalasi Spreadsheet Area (Auto-Sync)</h4>
                <p class="text-muted small">Menduplikasi file dan menyambungkan "Pipa Data" dari Database Pusat khusus untuk AGEN ID area tersebut.</p>
            </div>
            <div class="card-body p-4">
                <ol class="text-dark mb-0 fs-6" style="line-height: 1.8;">
                    <li class="mb-3">Buka Spreadsheet Template pada tautan berikut: <br><a href="#" target="_blank" class="fw-bold"><i class="fas fa-external-link-alt me-1"></i> Master Sheet Template</a></li>
                    
                    <li class="mb-3">Klik menu <b>File</b> > <b>Make a copy (Buat salinan)</b>. Ubah nama file sesuai area baru, misalnya: <code>[AREA] Rekon SIMASRIM - Malang</code>.</li>
                    
                    <li class="mb-3">
                        <b>Penyambungan Jalur Data:</b> <br>
                        Buka tab <code>DB_USER</code>, <code>DB_TOPUP</code>, dan <code>DB_TRANSAKSI</code>. Pastikan baris ke-1 (Header) tetap ada, namun <b>isi datanya dikosongkan (Clear)</b>.
                    </li>
                    <li class="mb-3">
                        Ganti sel <b>A1</b> pada masing-masing tab dengan rumus <code>QUERY</code> + <code>IMPORTRANGE</code> yang mengarah ke URL Database Master Pusat. <br>
                        <div class="alert alert-warning py-2 mt-2 mb-0 border-0" style="font-size: 0.9rem;">
                            <b><i class="fas fa-exclamation-triangle me-1"></i> SANGAT PENTING:</b> Pastikan parameter filter tidak hilang! Gunakan filter <code>WHERE Col2 = [AGEN ID]</code> untuk tab <b>DB_USER</b>, dan <code>WHERE Col6 = [AGEN ID]</code> untuk tab <b>DB_TOPUP</b> serta <b>DB_TRANSAKSI</b>.
                        </div>
                        <i>(Jangan lupa klik tombol "Allow Access" jika muncul error <code>#REF!</code> setelah rumus dimasukkan).</i>
                    </li>
                    <li class="mb-3">
                        <b>TRICK ANTI-BUG (Standar Looker):</b> Karena data baru ini masih kosong, Looker tidak akan bisa mengenali format tanggal nantinya. <br>
                        Buka tab <code>REKON_MILESTONE</code>, buat 1 baris <b>Data Dummy (Palsu)</b>. Ketik manual ID User apa saja, lalu set status KYC = <i>VERIFIED</i>, M2 = <i>OK</i>, M3 = <i>OK</i> sampai kolom <code>BONUS CAIR</code> muncul angka <b>10000</b> dan kolom <code>TGL LOLOS</code> terisi tanggal. (Data dummy ini WAJIB di-undo (Ctrl + Z) di Langkah 4 agar tidak merusak rumus).
                    </li>
                </ol>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <span class="badge bg-primary mb-2"><i class="fas fa-chart-bar me-1"></i> Langkah 2</span>
                <h4 class="fw-bold text-dark mb-1">Kloning Dashboard (Looker Studio)</h4>
                <p class="text-muted small">Menyambungkan visualisasi dashboard lama dengan database area yang baru disinkronisasi.</p>
            </div>
            <div class="card-body p-4">
                <ol class="text-dark mb-0 fs-6" style="line-height: 1.8;">
                    <li class="mb-3">Buka Dashboard Template pada tautan berikut: <br><a href="#" target="_blank" class="fw-bold"><i class="fas fa-external-link-alt me-1"></i> Master Looker Template</a></li>
                    
                    <li class="mb-3">Klik ikon <b>Titik Tiga</b> (More options) di pojok kanan atas layar > Pilih <b>Make a copy (Buat salinan)</b>.</li>
                    
                    <li class="mb-3">
                        Di bagian <i>"New Data Source"</i>, klik dropdown, scroll ke bawah dan pilih <b>Create data source (Buat sumber data)</b>.
                    </li>

                    <li class="mb-3">Pilih konektor <b>Google Sheets</b>. Cari dan pilih Spreadsheet Area baru yang sudah diisi Data Dummy di Langkah 1.</li>

                    <li class="mb-3">Pilih tab <b>REKON_MILESTONE</b>, pastikan centang opsi <i>"Use first row as headers"</i>, lalu klik <b>CONNECT (HUBUNGKAN)</b> > <b>Add to report</b> > <b>Copy Report</b>.</li>
                </ol>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up" data-aos-delay="150">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <span class="badge bg-danger mb-2"><i class="fas fa-wrench me-1"></i> Langkah 3</span>
                <h4 class="fw-bold text-dark mb-1">Standarisasi Parameter (Troubleshooting)</h4>
                <p class="text-muted small">Wajib dicek agar grafik tidak error (merah). Saat duplikasi, Looker seringkali menghilangkan Custom Field & Filter.</p>
            </div>
            <div class="card-body p-4">
                <ol class="text-dark mb-0 fs-6" style="line-height: 1.8;">
                    <li class="mb-4">
                        <b>Reset Agregasi & Format Data (Menu: Resource > Manage added data sources > Edit):</b><br>
                        - Pastikan <code>TGL LOLOS</code> bertipe <b>Date</b>.<br>
                        - Pastikan <code>BONUS CAIR</code> bertipe <b>Number</b>, dan ubah <i>Default Aggregation</i>-nya menjadi <b>None</b> (Wajib, agar rumus Funnel berfungsi!).<br>
                        - <i>Troubleshooting:</i> Jika <code>TGL DAFTAR</code> error "Can't convert to date", buat Calculated Field baru bernama <b>TGL DAFTAR FIX</b> dengan rumus: <code>PARSE_DATE("%Y-%m-%d", SUBSTR(TGL DAFTAR, 1, 10))</code>
                    </li>
                    <li class="mb-4">
                        <b>Buat Ulang Field "Progres Mitra Area":</b> Saat duplikasi, rumus ini biasanya hilang/kembali ke format KYC. Di panel Data (kanan), klik <b>+ Add a field</b>. Beri nama <code>Progres Mitra Area</code> dan masukkan rumus ini (gunakan <i>backtick</i> pada nama kolom):
                        <pre class="bg-light p-3 rounded-3 mt-2 border text-dark" style="font-size: 0.85rem; overflow-x: auto;">CASE 
  WHEN `BONUS CAIR` = 10000 THEN "4. Bonus Cair"
  WHEN `M3: TRANS 100K` = "OK" THEN "3. Transaksi OK"
  WHEN `M2: TOPUP 50K` = "OK" THEN "2. Top Up OK"
  WHEN `STATUS KYC` = "VERIFIED" THEN "1. KYC Verified"
  ELSE "0. Baru Daftar"
END</pre>
                    </li>
                    <li class="mb-4">
                        <b>Buat Ulang Filter "User Lolos":</b> Saat duplikasi, filter juga biasanya terhapus. Buat filter baru dengan aturan:<br>
                        <code>Include</code> > <code>BONUS CAIR</code> > <code>Equal to (=)</code> > <code>10000</code>.
                    </li>
                    <li class="mb-3">
                        <b>Standarisasi Konfigurasi Tiap Chart:</b> Klik setiap grafik/scorecard di dashboard, lalu pastikan pengaturan di panel <i>Setup</i> (sebelah kanan) sesuai dengan standar berikut ini:
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-hover fs-7 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20%;">Komponen</th>
                                        <th style="width: 20%;">Dimension (X-Axis)</th>
                                        <th style="width: 20%;">Metric (Y-Axis)</th>
                                        <th style="width: 40%;">Sort / Filter / Date Range</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Filter Kalender (Date Range)</td>
                                        <td><code>TGL LOLOS</code></td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Scorecard (Total Dana)</td>
                                        <td>-</td>
                                        <td><code>BONUS CAIR</code><br><span class="text-muted small">(Sum)</span></td>
                                        <td>
                                            <b>Date Range:</b> <code>TGL LOLOS</code><br>
                                            <b>Filter:</b> -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Scorecard (User Valid)</td>
                                        <td>-</td>
                                        <td><code>ID USER</code><br><span class="text-muted small">(Count Distinct)</span></td>
                                        <td>
                                            <b>Date Range:</b> <code>TGL LOLOS</code><br>
                                            <b>Filter:</b> Gunakan Filter "User Lolos" <i>(Bonus Cair = 10000)</i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Milestone Funnel (Bar Chart)</td>
                                        <td><code>Progres Mitra Area</code><br><span class="text-muted small">(Calculated Field)</span></td>
                                        <td><code>ID USER</code><br><span class="text-muted small">(Count Distinct)</span></td>
                                        <td>
                                            <b>Date Range:</b> <code>TGL LOLOS</code><br>
                                            <b>Sort:</b> <code>Progres Mitra Area</code> (Ascending)<br>
                                            <b>Filter:</b> - <i>(Kosongkan agar terlihat semua)</i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Tabel Top 10 User</td>
                                        <td><code>ID USER</code><br><code>TGL DAFTAR</code><br><code>TGL LOLOS</code></td>
                                        <td>-</td>
                                        <td>
                                            <b>Date Range:</b> <code>TGL LOLOS</code><br>
                                            <b>Sort:</b> <code>TGL LOLOS</code> (Descending)<br>
                                            <b>Filter:</b> Gunakan Filter "User Lolos" <i>(Bonus Cair = 10000)</i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Grafik Tren Harian</td>
                                        <td><code>TGL LOLOS</code></td>
                                        <td><code>ID USER</code><br><span class="text-muted small">(Count Distinct)</span></td>
                                        <td>
                                            <b>Date Range:</b> <code>TGL LOLOS</code><br>
                                            <b>Sort:</b> <code>TGL LOLOS</code> (Ascending)
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ol>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <span class="badge bg-warning text-dark mb-2"><i class="fas fa-share-nodes me-1"></i> Langkah 4</span>
                <h4 class="fw-bold text-dark mb-1">Finishing & Keamanan</h4>
                <p class="text-muted small">Merapikan nama, menghapus dummy, dan membagikan akses.</p>
            </div>
            <div class="card-body p-4">
                <ol class="text-dark mb-0 fs-6" style="line-height: 1.8;">
                    <li class="mb-3">Ubah nama Laporan Looker Studio di pojok kiri atas (Misal: <code>DASHBOARD REKON - MALANG</code>).</li>
                    <li class="mb-3">Klik teks judul di dalam dashboard dan ubah menjadi nama wilayah yang baru.</li>
                    <li class="mb-3">Klik tombol <b>Share (Bagikan)</b> di pojok kanan atas. Masukkan email resmi perwakilan Pihak Kedua, atur hak aksesnya sebagai <b>Viewer (Pelihat)</b>.<br>
                        <b>MANDATORY INVITE:</b> Wajib juga melakukan invite ke email operasional pusat berikut:
                        <ul class="mt-1">
                            <li><code>demo.viewer@contoh-perusahaan.demo</code> (Viewer)</li>
                            <li><code>marketing.demo@contoh-perusahaan.demo</code> (Editor)</li>
                            <li><code>marketing.demo@contoh-perusahaan.demo</code> (Editor)</li>
                        </ul>
                    </li>
                    <li class="mb-3 text-danger fw-bold">
                        <i class="fas fa-undo-alt me-1"></i> TAHAP AKHIR: Buka kembali Spreadsheet Area (Tab <code>REKON_MILESTONE</code>), lalu lakukan UNDO (Ctrl + Z) pada baris Data Dummy yang kamu buat di Langkah 1 agar baris tersebut kosong kembali tanpa merusak rumus, dan tidak terhitung sebagai tagihan.
                    </li>
                </ol>
            </div>
        </div>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>