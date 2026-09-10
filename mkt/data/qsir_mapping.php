<?php 
session_start();
// Proteksi halaman internal - global auth
// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;

$page_title = "Mapping Network QSIR | SIMASRIM Internal";
$footer_desc = "Dokumen Terbatas - Peta Jaringan Infrastruktur Logistik Nasional SIMASRIM.";
$base_path = '../';
include '../includes/header.php'; 
?>

<style>
    body { background-color: #f0f2f5 !important; }
    .zone-card { background: white; border-radius: 20px; border: 1px solid rgba(115, 53, 183, 0.1); box-shadow: 0 4px 15px rgba(0,0,0,0.02); margin-bottom: 25px; overflow: hidden; transition: 0.3s; }
    .zone-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(115, 53, 183, 0.1); }
    .zone-header { padding: 15px 20px; color: white; font-weight: 700; display: flex; justify-content: space-between; align-items: center; }
    
    .hub-item { padding: 15px 20px; border-bottom: 1px dashed #eee; transition: 0.2s; }
    .hub-item:last-child { border-bottom: none; }
    .hub-item:hover { background-color: var(--bg-soft-purple); }
    
    .bg-core { background: linear-gradient(135deg, #7335B7, #4a1580); }
    .bg-sumatera { background: linear-gradient(135deg, #0d6efd, #0a4baf); }
    .bg-jawatimur { background: linear-gradient(135deg, #20c997, #138563); }
    
    .badge-code { font-family: 'Courier New', Courier, monospace; font-weight: 700; font-size: 0.9rem; padding: 6px 12px; border-radius: 6px; }
</style>

<section class="hero-section text-center">
    <div class="container text-center">
        <h1 class="display-5 fw-bold text-white mb-2" data-aos="fade-up">Mapping Network QSIR</h1>
        <p class="text-white-50 mb-0" data-aos="fade-up" data-aos-delay="100">Infrastruktur Jaringan Logistik & Konseptual Pemetaan Area Kerja SIMASRIM.</p>
    </div>
</section>

<div class="container py-5">
    <div class="row mb-4" data-aos="fade-up">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">Status Sebaran Jaringan (9 Titik)</h4>
                <p class="text-muted small">Konsolidasi 4 Zona Strategis Nasional Fulfillment & Pickup.</p>
            </div>
            <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#updateKapasitasModal">
                <i class="fas fa-file-invoice me-2"></i> Update Kapasitas Gudang
            </button>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
        <p class="text-muted mb-0">Total <strong class="text-dark">3 Zona Aktif</strong> tersebar di seluruh Indonesia dengan sistem terintegrasi.</p>
        <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" onclick="alert('Fitur Tambah Area/Hub sedang dalam pengembangan.')"><i class="fas fa-plus me-1"></i> Tambah Area / Hub</button>
    </div>

    <div class="row g-4">
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="zone-card h-100">
                <div class="zone-header bg-core d-flex justify-content-between align-items-center">
                    <div>
                        <span><i class="fas fa-server me-2"></i> ZONA PUSAT & JABODETABEK</span>
                        <span class="badge bg-white text-dark rounded-pill ms-2">2 Hubs</span>
                    </div>
                    <button class="btn btn-sm btn-light p-1" style="line-height:1; opacity:0.8;" onclick="alert('Fitur Edit Zona sedang dalam pengembangan.')" title="Edit Zona"><i class="fas fa-edit text-dark"></i></button>
                </div>
                <div class="hub-list">
                    <div class="hub-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-code bg-primary text-white">BGR-1</span>
                            <small class="text-success fw-bold"><i class="fas fa-circle-check me-1"></i> HQ Control</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Bogor (Hub Pusat)</h6>
                        <p class="text-muted small mb-1">Jl. Raya Pemda Karadenan. Akses tol langsung, Jawa Barat coverage.</p>
                    </div>
                    <div class="hub-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-code bg-light text-dark border">BKS-1</span>
                            <small class="text-muted small">PIC: Pak Andi</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Bekasi (Tambun Selatan)</h6>
                        <p class="text-muted small mb-0">Jantung pergudangan & konsolidasi seller Jabodetabek Timur.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="zone-card h-100">
                <div class="zone-header bg-sumatera d-flex justify-content-between align-items-center">
                    <div>
                        <span><i class="fas fa-map-marked-alt me-2"></i> ZONA SUMATERA</span>
                        <span class="badge bg-white text-dark rounded-pill ms-2">4 Hubs</span>
                    </div>
                    <button class="btn btn-sm btn-light p-1" style="line-height:1; opacity:0.8;" onclick="alert('Fitur Edit Zona sedang dalam pengembangan.')" title="Edit Zona"><i class="fas fa-edit text-dark"></i></button>
                </div>
                <div class="hub-list">
                    <div class="hub-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-code bg-light text-dark border">PLM-1</span>
                            <small class="text-muted small">PIC: Pak Ayyub/Anggun</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Palembang (Alang-Alang Lebar)</h6>
                        <p class="text-muted small mb-0">Pilar utama pergerakan kargo Sumatera Selatan.</p>
                    </div>
                    <div class="hub-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-code bg-light text-dark border">MES-1</span>
                            <small class="text-muted small">PIC: Bu Erly</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Medan Amplas</h6>
                        <p class="text-muted small mb-0">Gerbang masuk distribusi Medan bagian Selatan.</p>
                    </div>
                    <div class="hub-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-code bg-light text-dark border">MES-2</span>
                            <small class="text-muted small">PIC: Dalco Instan</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Medan Helvetia</h6>
                        <p class="text-muted small mb-0">Jalur protokol Gatot Subroto, ideal akses truk B2B.</p>
                    </div>
                    <div class="hub-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-code bg-light text-dark border">MES-3</span>
                            <small class="text-muted small">PIC: M Yusuf Saputra</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Medan Tembung</h6>
                        <p class="text-muted small mb-0">Penetrasi area padat penduduk & klaster UMKM Timur.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="zone-card h-100">
                <div class="zone-header bg-jawatimur d-flex justify-content-between align-items-center">
                    <div>
                        <span><i class="fas fa-boxes me-2"></i> ZONA JAWA TIMUR & BALI</span>
                        <span class="badge bg-white text-dark rounded-pill ms-2">3 Hubs</span>
                    </div>
                    <button class="btn btn-sm btn-light p-1" style="line-height:1; opacity:0.8;" onclick="alert('Fitur Edit Zona sedang dalam pengembangan.')" title="Edit Zona"><i class="fas fa-edit text-dark"></i></button>
                </div>
                <div class="hub-list">
                    <div class="hub-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-code bg-light text-dark border">SUB-1</span>
                            <small class="text-muted small">PIC: Pak Eko</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Surabaya (Tambaksari)</h6>
                        <p class="text-muted small mb-0">Pusat kota, dekat pelabuhan utama untuk rute transit.</p>
                    </div>
                    <div class="hub-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-code bg-light text-dark border">SUB-2</span>
                            <small class="text-muted small">PIC: Pak Eko</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Sidoarjo (Area Industri)</h6>
                        <p class="text-muted small mb-0">Kawasan industri, optimalisasi rute Bali & Timur Indonesia.</p>
                    </div>
                    <div class="hub-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-code bg-light text-dark border">MXG-1</span>
                            <small class="text-muted small">PIC: Pak Febi</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Malang (Blimbing)</h6>
                        <p class="text-muted small mb-0">Lokasi strategis utara Malang, fokus Corporate & Ritel lokal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Kapasitas -->
<div class="modal fade" id="updateKapasitasModal" tabindex="-1" aria-labelledby="updateKapasitasModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
      <div class="modal-header bg-primary text-white border-0 py-3">
        <h5 class="modal-title fw-bold" id="updateKapasitasModalLabel"><i class="fas fa-warehouse me-2"></i> Update Kapasitas Gudang</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="kapasitasForm">
          <div class="mb-3">
            <label for="hubSelect" class="form-label fw-bold">Pilih Hub / Gudang</label>
            <select class="form-select" id="hubSelect" required>
              <option value="" selected disabled>-- Pilih Gudang --</option>
              <optgroup label="Zona Pusat">
                  <option value="BGR-1">BGR-1 (Bogor)</option>
                  <option value="BKS-1">BKS-1 (Bekasi)</option>
              </optgroup>
              <optgroup label="Zona Sumatera">
                  <option value="PLM-1">PLM-1 (Palembang)</option>
                  <option value="MES-1">MES-1 (Medan Amplas)</option>
                  <option value="MES-2">MES-2 (Medan Helvetia)</option>
                  <option value="MES-3">MES-3 (Medan Tembung)</option>
              </optgroup>
              <optgroup label="Zona Jawa Timur">
                  <option value="SUB-1">SUB-1 (Surabaya)</option>
                  <option value="SUB-2">SUB-2 (Sidoarjo)</option>
                  <option value="MXG-1">MXG-1 (Malang)</option>
              </optgroup>
            </select>
          </div>
          <div class="mb-3">
            <label for="kapasitasVal" class="form-label fw-bold">Kapasitas Baru (m²)</label>
            <input type="number" class="form-control" id="kapasitasVal" placeholder="Misal: 500" required>
          </div>
          <div class="mb-4">
            <label for="picVal" class="form-label fw-bold">Penanggung Jawab (PIC)</label>
            <input type="text" class="form-control" id="picVal" placeholder="Nama PIC Gudang" required>
          </div>
          <div class="d-grid gap-2">
            <button type="button" class="btn btn-primary rounded-pill fw-bold py-2" onclick="alert('Fitur Update Kapasitas Gudang akan segera tersedia dan terintegrasi dengan Firebase!');" data-bs-dismiss="modal">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>