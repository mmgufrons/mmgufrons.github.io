<?php 
$page_title = "SOP Update Prompt AI | SIMASRIM CS";
$footer_desc = "Dokumen Internal Terbatas - Divisi Customer Service & AI Management.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>


<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--ai-blue);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25 shadow-sm"><i class="fa-solid fa-robot me-2"></i>AI Management</span>
        <h2 class="display-5 fw-bold mb-2">SOP Update Prompt AI Internal</h2>
        <p class="text-white-50 mb-0">Panduan untuk melakukan pembaruan instruksi (Prompt) pada sistem AI CS SIMASRIM.<br>Sistem ini resmi menggantikan platform BalesOtomatis.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">

        <div class="login-box shadow-sm border-0">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-sign-in-alt me-2 text-primary"></i>Akses Portal AI (EDC SIMASRIM)</h5>
            <p class="text-muted small mb-3">Untuk melakukan pembaruan, silakan akses portal manajemen AI kita melalui link <a href="https://edc.smsrm.com/" target="_blank" class="fw-bold text-decoration-none">https://edc.smsrm.com/</a> menggunakan kredensial khusus tim CS di bawah ini:</p>
            
            <div class="d-flex flex-wrap gap-3 align-items-center mt-3">
                <div>
                    <span class="text-muted small d-block mb-1">Username:</span>
                    <span class="credential-badge">prompter</span>
                </div>
                <div>
                    <span class="text-muted small d-block mb-1">Password:</span>
                    <span class="credential-badge">prompter@123</span>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm rounded-4 mb-5 step-card">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <span class="badge bg-success mb-2 shadow-sm"><i class="fas fa-pen-to-square me-1"></i> Langkah Eksekusi</span>
                <h4 class="fw-bold text-dark mb-1">Cara Update Prompt AI</h4>
                <p class="text-muted small">Ikuti urutan ini dengan teliti agar tidak merusak logika AI yang sedang berjalan.</p>
            </div>
            <div class="card-body p-4">
                <ol class="text-dark mb-0 fs-6" style="line-height: 1.8;">
                    <li class="mb-3"><strong>Pilih AI Target:</strong> Setelah berhasil login, cari list AI khusus CS yang prompt-nya ingin di-update, lalu <strong>klik icon Edit (pensil)</strong> pada AI tersebut.</li>
                    
                    <li class="mb-3">
                        <strong>Edit Main Prompt Body</strong>
                        <p class="mb-1 text-sm text-muted">Hanya boleh melakukan penambahan/pengubahan di kolom<code> Main Prompt Body</code>. Dilarang menyentuh kolom atau pengaturan lain.</p>
                    </li>
                    
                    <li class="mb-3"><strong>Simpan Perubahan:</strong> Jika instruksi atau informasi sudah selesai ditambahkan/diperbarui, scroll ke bawah dan klik tombol biru <strong>"Simpan Prompt"</strong>.</li>
                    
                    <li><strong>Selesai:</strong> Sistem AI CS SIMASRIM akan otomatis melakukan pembaruan di latar belakang.</li>
                </ol>
            </div>
        </div>

        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark">Anatomi Prompt AI (Wajib Dibaca)</h3>
            <p class="text-muted small">Di dalam kolom<code> Main Prompt Body</code>, terdapat bagian yang merupakan "Otak Sistem" dan bagian "Pengetahuan". Perhatikan pembagian zona di bawah ini saat melakukan edit.</p>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="zone-card zone-red shadow-sm">
                    <h5 class="fw-bold text-danger mb-3"><i class="fas fa-ban me-2"></i>ZONA MERAH (Dilarang Edit)</h5>
                    <p class="small text-muted mb-3">Area ini berisi instruksi teknis, pemanggilan API, dan aturan <i>Handover</i>. Jika diubah, bot bisa error atau gagal merespons.</p>
                    <ul class="small mb-0 ps-3 text-dark" style="line-height: 1.6;">
                        <li class="mb-2"><span class="zone-code">FUNGSI KHUSUS: CEK RESI</span> & <span class="zone-code">CEK TARIF</span> (Dilarang menyentuh script template hasil dan parameter tool-nya).</li>
                        <li class="mb-2"><span class="zone-code">ATURAN HANDOVER & PERGANTIAN SESI</span> (Script operan ke Live Agent).</li>
                        <li class="mb-2"><span class="zone-code">BATASAN TEGAS (ANTI SPAM)</span>.</li>
                        <li class="mb-2"><span class="zone-code">LOGIKA PERAN</span> & <span class="zone-code">METODE STARS</span>.</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="zone-card zone-green shadow-sm">
                    <h5 class="fw-bold text-success mb-3"><i class="fas fa-check-circle me-2"></i>ZONA HIJAU (Aman Di-update)</h5>
                    <p class="small text-muted mb-3">Area ini adalah "Buku Pintar" si AI. Tim CS <strong>diwajibkan</strong> mengupdate area ini jika ada perubahan informasi perusahaan.</p>
                    <ul class="small mb-0 ps-3 text-dark" style="line-height: 1.6;">
                        <li class="mb-2"><span class="zone-code">BAGIAN 1: SCRIPT PENANGANAN MASALAH</span> (Boleh tambah/ubah cara AI menjawab komplain).</li>
                        <li class="mb-2"><span class="zone-code">BAGIAN 2: DETAIL INSTRUKSI KERJA EKSPEDISI</span> (Update SLA kurir, batas waktu pickup, aturan klaim).</li>
                        <li class="mb-2"><span class="zone-code">BAGIAN 3: PENGETAHUAN PRODUK LAINNYA</span> (Update harga SQRIS, Mesin EDC, Tiket, Poin, dll).</li>
                        <li class="mb-2"><span class="zone-code">Catatan Libur Lebaran/Nasional</span> (Update tanggal operasional).</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="py-5 bg-light-soft border-top">
    <div class="container py-4 followup-container">
        <h3 class="fw-bold text-center mb-5 text-primary"><i class="fas fa-exclamation-triangle me-2 text-warning"></i> Batasan Wewenang Tambahan</h3>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg-white p-4 rounded-4 border shadow-sm text-center">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">🚧</div>
                    <h5 class="fw-bold text-dark">Fitur Lanjutan Dikelola Pusat</h5>
                    <p class="text-muted mb-0">Untuk saat ini, wewenang tim CS dibatasi hanya pada <strong>Update Prompt (ZONA HIJAU)</strong>. Kebutuhan untuk <strong>Menambah AI Baru</strong>, <strong>Integrasi Database</strong>, atau merombak alur teknis (ZONA MERAH) masih dikelola langsung oleh Tim Manajemen Pusat. Silakan eskalasikan ke pusat jika ada kebutuhan tersebut.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>