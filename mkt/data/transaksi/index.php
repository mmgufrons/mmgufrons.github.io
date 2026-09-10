<?php
$page_title = "Update Transaksi Bulanan | SIMASRIM Data";
$footer_desc = "Dokumen Internal Terbatas - Divisi Data & IT.";
$base_path = '../../';
include __DIR__ . '/../../includes/header.php';
?>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="container position-relative z-1">
        <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25"><i class="fa-solid fa-file-import me-2"></i>Data & Analytics</span>
        <h2 class="display-5 fw-bold mb-2">Update Transaksi Bulanan (Otomatis)</h2>
        <p class="text-white-50 mb-0">Upload file dari IT, tools otomatis gabung, hitung status & komisi, lalu update dashboard.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form id="importForm">
                    <div class="mb-4">
                        <label class="fw-bold text-dark mb-2 d-block">1. File Mentah Ekspedisi dari IT <span class="badge bg-danger">Wajib, rutin tiap bulan</span></label>
                        <p class="text-muted small mb-1">Upload semua file sekaligus — SAPX, JNE, JNTX, dst, <b>COD dan Non-COD boleh dicampur</b> (tidak perlu dipisah, tools deteksi otomatis dari isi file). Ini persis file mentah yang biasa ditaruh di folder "SALES [Bulan]" — belum diproses Colab, tidak perlu diedit dulu.</p>
                        <ul class="text-muted small mb-2">
                            <li><b>Kolom terbaca otomatis:</b> AWB, kota asal/tujuan, status, layanan, tanggal.</li>
                            <li><b>Komisi Agen (khusus file COD)</b> dihitung otomatis = TAGIHAN USER − ONGKIR (dua kolom itu memang ada di file COD).</li>
                            <li><b>Komisi Agen file Non-COD</b> tidak ada sumber datanya di file mentah → tetap kosong/manual, tidak diotak-atik oleh tools.</li>
                            <li>Resi yang AWB-nya benar-benar baru akan tetap tersimpan (status/kurir/ongkir kebaca), tapi kolom <code>ID USER</code>/<code>NAMA USER</code> kosong sampai dilengkapi lewat slot #3 di bawah (kalau datanya sudah tersedia).</li>
                        </ul>
                        <input type="file" class="form-control" name="raw_files[]" id="rawFiles" accept=".xlsx,.xls" multiple required>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold text-dark mb-2 d-block">2. Data Agen/User Baru <span class="badge bg-info text-dark">Opsional, upload kalau ada agen baru</span></label>
                        <p class="text-muted small">Upload kalau bulan ini ada agen/user baru gabung — format sama seperti file dari tim IT (USER ID, NAMA, TGL GABUNG, ORIGIN, PHONE, EMAIL, ROLE, AGEN ID). Ini hanya melengkapi data agen (<code>/user_master</code>), <b>bukan</b> data resi.</p>
                        <input type="file" class="form-control" name="agen_file" id="agenFile" accept=".xlsx,.xls">
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold text-dark mb-2 d-block">3. File Master Transaksi Siap Pakai <span class="badge bg-secondary">Opsional, jarang dipakai</span></label>
                        <p class="text-muted small">HANYA kalau kebetulan sudah tersedia data resi lengkap dengan <code>ID USER</code> & <code>KOMISI AGEN</code> siap pakai dari proses lain (gaya sheet <code>DATABASE_MASTER</code> lama). <b>Bukan langkah wajib bulanan</b> — kosongkan kalau tidak ada.</p>
                        <input type="file" class="form-control" name="master_file" id="masterFile" accept=".xlsx,.xls">
                    </div>

                    <button type="submit" class="btn btn-primary px-4" id="btnProcess"><i class="fas fa-cogs me-2"></i>Proses & Simpan</button>
                    <a href="dashboard.php" class="btn btn-outline-secondary px-4 ms-2"><i class="fas fa-chart-line me-2"></i>Lihat Dashboard</a>
                </form>
            </div>
        </div>

        <div class="alert alert-info rounded-4 small">
            <i class="fas fa-circle-info me-2"></i>
            <b>Catatan testing:</b> data bulan yang sudah pernah diproses (sudah ada baseline-nya) aman di-upload ulang — sistem update by AWB, tidak akan dobel. Tapi karena angkanya sudah sama, dashboard tidak akan berubah. Kalau mau lihat efek nyata, pakai data bulan yang belum pernah diproses sebelumnya.
        </div>

        <div id="resultBox" class="d-none"></div>

    </div>
</section>

<script>
document.getElementById('importForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    const btn = document.getElementById('btnProcess');
    const box = document.getElementById('resultBox');
    box.classList.add('d-none');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses... (bisa beberapa menit untuk data besar)';

    const fd = new FormData();
    const rawFiles = document.getElementById('rawFiles').files;
    for (let i = 0; i < rawFiles.length; i++) fd.append('raw_files[]', rawFiles[i]);
    const agenFile = document.getElementById('agenFile').files[0];
    if (agenFile) fd.append('agen_file', agenFile);
    const masterFile = document.getElementById('masterFile').files[0];
    if (masterFile) fd.append('master_file', masterFile);

    try {
        const res = await fetch('import.php', { method: 'POST', body: fd });
        const data = await res.json();
        box.classList.remove('d-none');
        if (data.success) {
            let filesHtml = (data.files || []).map(f => `<li>${f.name} (${f.ekspedisi || '-'}) — ${f.rows} baris</li>`).join('');
            box.innerHTML = `
                <div class="alert alert-success rounded-4">
                    <h5 class="fw-bold"><i class="fas fa-check-circle me-2"></i>Berhasil Diproses</h5>
                    <p class="mb-1"><b>${data.rows_affected}</b> baris resi ter-update/ditambahkan. ${data.agen_updated ? `<b>${data.agen_updated}</b> data agen ter-update. ` : ''}${data.rows_failed ? `<span class="text-danger">${data.rows_failed} baris gagal parse.</span>` : ''}</p>
                    <ul class="mb-2">${filesHtml}</ul>
                    <a href="dashboard.php" class="btn btn-sm btn-success"><i class="fas fa-chart-line me-1"></i>Buka Dashboard</a>
                </div>`;
        } else {
            box.innerHTML = `<div class="alert alert-danger rounded-4"><b>Gagal:</b> ${data.error}</div>`;
        }
    } catch (err) {
        box.classList.remove('d-none');
        box.innerHTML = `<div class="alert alert-danger rounded-4"><b>Error:</b> ${err.message}</div>`;
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-cogs me-2"></i>Proses & Simpan';
    }
});
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
