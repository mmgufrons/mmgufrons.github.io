<?php 
$page_title = "SOP Proactive CS Looker Studio | SIMASRIM Operations";
$footer_desc = "Dokumen Internal Terbatas - Divisi Customer Service & Tech Support.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>

<style>
    /* UI/UX Link Clickable */
    .inline-link-btn {
        display: inline-flex; align-items: center; gap: 8px; background: #7335B7; color: #ffffff !important; padding: 12px 24px; border-radius: 10px; font-weight: 700; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(115, 53, 183, 0.3);
    }
    .inline-link-btn:hover { background: #5A2A8F; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(115, 53, 183, 0.4); }
    
    /* Base SOP Styling */
    .sop-section-title { font-size: 1.15rem; font-weight: 800; color: var(--text-main); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 10px; border-bottom: 2px solid #f8f9fa; padding-bottom: 10px; }
    .step-card { background: #ffffff; border: 1px solid rgba(0,0,0,0.08); border-radius: 16px; padding: 1.8rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .status-alert { background: #fff5f5; border-left: 5px solid #e3342f; padding: 1rem; border-radius: 8px; font-size: 0.9rem; color: #cc1f1a; }
    .step-list { padding-left: 1.2rem; }
    .step-list li { margin-bottom: 0.5rem; color: #4a5568; }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--ai-blue);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm"><i class="fas fa-chart-line me-2"></i>SOP Operasional</span>
        <h2 class="display-5 fw-bold mb-2">Proactive CS Looker Dashboard</h2>
        <p class="text-white-50 mb-0">SOP Penanganan Paket Gantung & Monitoring Pencairan COD.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">

        <div class="text-center mb-5">
            <a href="#" target="_blank" class="inline-link-btn fs-5 shadow">
                <i class="fas fa-external-link-square-alt"></i> Buka Dashboard Operasional SIMASRIM
            </a>
            <p class="small text-muted mt-3">Klik tombol di atas untuk masuk ke Command Center CS.</p>
        </div>

        <div class="step-card">
            <div class="sop-section-title"><i class="fas fa-sun text-warning"></i> 1. Rutinitas Pagi (08.30 - 09.30)</div>
            <p class="small text-muted">CS wajib membuka Dashboard SIMASRIM dan melakukan pengecekan berurutan mulai dari <strong>Halaman 1 (Radar Paket Gantung)</strong>.</p>
        </div>

        <div class="step-card">
            <div class="sop-section-title"><i class="fas fa-satellite-dish text-primary"></i> 2. Monitoring Halaman 1: Radar Paket Gantung</div>
            <p class="small text-muted">Daftar "Pasien Kritis" yang perlu ditangani segera.</p>
            
            <div class="bg-light p-3 rounded mb-3 border">
                <strong>Cara Membaca:</strong>
                <ul class="small mt-2">
                    <li><span class="text-danger fw-bold">Baris Merah:</span> Layanan Next Day (YES) tertahan > 1 hari (Prioritas Utama).</li>
                    <li><span class="text-warning fw-bold">Baris Kuning:</span> Layanan Reguler tertahan > 2 hari.</li>
                </ul>
            </div>
            
            <strong class="text-dark small d-block mb-2">Tindakan CS:</strong>
            <ol class="small step-list">
                <li>Urutkan tabel berdasarkan Aging (Umur Paket) dari yang paling tua (descending).</li>
                <li>Pilih data baris teratas (paling lama gantung).</li>
                <li>Follow Up ke grup koordinasi ekspedisi/PIC kurir dengan nomor resi.</li>
                <li>Jika kategori Merah/Kuning, kirim pesan proaktif ke Agen:<br>
                <i class="text-muted">"Halo Kak, kami mendeteksi paket [Nomor Resi] terpantau masih tertahan. Tim SIMASRIM sudah membuat laporan komplain prioritas agar paket segera diantarkan hari ini."</i></li>
            </ol>
        </div>

        <div class="step-card">
            <div class="sop-section-title"><i class="fas fa-wallet text-success"></i> 3. Monitoring Halaman 2: Radar COD</div>
            <p class="small text-muted">Memantau uang COD yang nyangkut dan sudah melewati SLA (Delivered > 3 hari).</p>
            
            <strong class="text-dark small d-block mb-2">Tindakan CS:</strong>
            <ol class="small step-list">
                <li>Jika tabel tidak kosong: Segera periksa status POD.</li>
                <li>Jika sudah Delivered tapi status cair 'Belum Cair': Buat tiket ke ekspedisi untuk minta bukti bayar.</li>
                <li>Eskalasi resi yang bandel ke Finance Internal agar bisa ditagih paksa ke kurir.</li>
            </ol>
        </div>

        <div class="status-alert">
            <h6 class="fw-bold mb-2"><i class="fas fa-ban me-1"></i> PROTOKOL KOMUNIKASI (Proactive Care)</h6>
            <p class="mb-1 small"><strong>SOP ini melarang CS menunggu user komplain!</strong></p>
            <ul class="mb-0 small">
                <li><strong>Deteksi:</strong> Lihat masalah di dashboard.</li>
                <li><strong>Eskalasi:</strong> Buat tiket ke ekspedisi.</li>
                <li><strong>Update:</strong> Kabari agen jika masalah sudah diurus.</li>
                <li class="fw-bold text-dark">Larangan: Dilarang keras menunggu user bertanya "Paket saya dimana?". Jika sistem sudah memberi tanda merah/kuning, CS wajib bertindak.</li>
            </ul>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>