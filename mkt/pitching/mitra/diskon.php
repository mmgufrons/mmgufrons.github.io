<?php 
$page_title = "Skema Diskon & Profit Mitra | SIMASRIM";
$footer_desc = "Dokumen B2B Internal. Skema pembagian (TJS & Reff) bersifat resmi berdasarkan rilis V.260316.";
include 'header.php'; 
?>

<style>
    /* CUSTOM UI - DISKON & MARGIN PREMIUM */
    .info-card { 
        background: #fff; 
        border-radius: 20px; 
        padding: 2.5rem; 
        height: 100%; 
        border: 1px solid rgba(115, 53, 183, 0.08); 
        box-shadow: 0 10px 30px rgba(0,0,0,0.02); 
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        position: relative;
        overflow: hidden;
    }
    .info-card:hover { 
        transform: translateY(-8px); 
        box-shadow: 0 20px 40px rgba(115, 53, 183, 0.12); 
        border-color: var(--primary); 
    }
    
    /* Style Navigasi Tab FontAwesome */
    .nav-pills .nav-link { 
        border-radius: 50px; 
        padding: 12px 25px; 
        color: var(--text-main); 
        font-weight: 600; 
        margin-right: 10px; 
        margin-bottom: 15px; 
        border: 1px solid #dee2e6; 
        background: white; 
        transition: 0.3s ease; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.02); 
    }
    .nav-pills .nav-link.active { 
        background-color: var(--primary); 
        color: white !important; 
        border-color: var(--primary); 
        box-shadow: 0 8px 20px rgba(115, 53, 183, 0.3); 
        transform: translateY(-3px); 
    }
    .nav-pills .nav-link.active i { color: white !important; }
    .nav-pills .nav-link:hover:not(.active) { 
        background-color: var(--bg-soft-purple); 
        border-color: var(--primary); 
        color: var(--primary); 
        transform: translateY(-3px); 
    }

    /* Tabel Custom (Lebih Premium) */
    .table-custom { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.03); margin-bottom: 0; border: 1px solid rgba(0,0,0,0.05); }
    .table-custom thead th { background-color: var(--primary); color: white; font-weight: 600; border: none; padding: 20px 15px; text-align: center; vertical-align: middle; letter-spacing: 0.5px; }
    .table-custom tbody td { padding: 18px 15px; vertical-align: middle; text-align: center; border-bottom: 1px dashed #eee; transition: 0.2s; }
    .table-custom tbody tr:hover td { background-color: var(--bg-soft-purple); }
    
    .badge-override { background: linear-gradient(135deg, var(--accent), #ff903b); color: white; font-size: 1rem; padding: 10px 18px; border-radius: 10px; box-shadow: 0 5px 15px rgba(243, 112, 13, 0.3); }
    .tier-box { background: #fff; border: 1px solid #e9ecef; border-radius: 10px; padding: 8px 15px; display: inline-block; font-size: 0.95rem; font-weight: 700; color: var(--text-main); margin: 2px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); transition: 0.3s; }
    .table-custom tbody tr:hover .tier-box { border-color: var(--primary); color: var(--primary); transform: scale(1.05); }
</style>

<section class="hero-section d-flex align-items-center position-relative overflow-hidden text-center" style="background: radial-gradient(circle at top right, #3A1B5E, #1F0D3D, #0f0c29); padding: 180px 0 80px;">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-white text-primary rounded-pill px-4 py-2 fw-bold mb-3 text-uppercase ls-2 shadow-sm" data-aos="fade-down">
            <i class="fas fa-bolt text-accent me-1"></i> Mekanisme Profit Margin
        </span>
        <h1 class="display-4 fw-bold mb-4 lh-sm text-white" data-aos="fade-up" data-aos-delay="100">
            Skema Diskon & Komisi Jaringan
        </h1>
        <p class="lead text-white-50 max-w-2xl mx-auto mb-0" data-aos="fade-up" data-aos-delay="200" style="line-height: 1.8;">
            Panduan lengkap pengaturan margin diskon untuk jaringan agen di bawah <b>Mitra</b>. Nikmati fleksibilitas pengaturan manual atau gunakan kecerdasan fitur <i>tiering otomatis</i> dari sistem kami.
        </p>
    </div>
</section>

<section class="py-5 position-relative z-2">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
                <div class="info-card">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 70px; height: 70px; font-size: 2rem; background: rgba(115, 53, 183, 0.1); color: var(--primary);">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">Komisi Override Pasti (Reff)</h4>
                    <p class="text-muted mb-0" style="line-height: 1.7;">
                        Sebagai Agen Pembawa Jaringan, <b>Mitra dijamin mendapat komisi tetap (1% - 2%)</b> dari setiap resi jaringan di bawahnya, BAGAIMANAPUN pengaturan diskon yang diterapkan. Meskipun Mitra memberikan diskon maksimal ke jaringan, jatah komisi <i>override</i> ini tidak akan pernah hilang.
                    </p>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
                <div class="info-card">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 70px; height: 70px; font-size: 2rem; background: rgba(243, 112, 13, 0.1); color: var(--accent);">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-4">2 Mode Pengaturan Diskon Jaringan</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-4 h-100 border border-secondary border-opacity-10">
                                <h6 class="fw-bold text-primary mb-3"><i class="fas fa-toggle-on me-2"></i>Mode Manual (Flat)</h6>
                                <p class="small text-muted mb-0">Mitra mengatur 1 nilai diskon tetap untuk agen. Jika batas maksimal diskon adalah 25% dan Mitra set 15%, maka selisih 10% menjadi <b>profit tambahan</b> Mitra.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-4 h-100 border border-secondary border-opacity-10">
                                <h6 class="fw-bold text-success mb-3"><i class="fas fa-robot me-2"></i>Tiering Otomatis</h6>
                                <p class="small text-muted mb-0">Diskon agen menyesuaikan jumlah paket mereka per bulan. Semakin rajin jaringan Mitra mengirim, diskonnya otomatis naik mendekati batas maksimal.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background-color: var(--bg-soft-purple);">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase ls-2">Transparansi Margin</h6>
            <h2 class="fw-bold text-dark display-6">Rincian Skema per Ekspedisi</h2>
            <p class="text-muted">Pilih layanan ekspedisi di bawah ini untuk melihat batas maksimal diskon jaringan dan Hak Komisi Mitra.</p>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5" id="pills-tab" role="tablist" data-aos="zoom-in">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-jne-tab" data-bs-toggle="pill" data-bs-target="#pills-jne" type="button" role="tab"><i class="fas fa-truck text-danger me-2"></i> JNE</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-sapx-tab" data-bs-toggle="pill" data-bs-target="#pills-sapx" type="button" role="tab"><i class="fas fa-box text-primary me-2"></i> SAPX</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-jnt-tab" data-bs-toggle="pill" data-bs-target="#pills-jnt" type="button" role="tab"><i class="fas fa-shipping-fast text-danger me-2"></i> J&T Express</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-spx-tab" data-bs-toggle="pill" data-bs-target="#pills-spx" type="button" role="tab"><i class="fas fa-box-open text-warning me-2"></i> SPX Express</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-jntcargo-tab" data-bs-toggle="pill" data-bs-target="#pills-jntcargo" type="button" role="tab"><i class="fas fa-truck-loading text-success me-2"></i> J&T Cargo</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-lion-tab" data-bs-toggle="pill" data-bs-target="#pills-lion" type="button" role="tab"><i class="fas fa-plane text-info me-2"></i> Lion Parcel</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-paxel-tab" data-bs-toggle="pill" data-bs-target="#pills-paxel" type="button" role="tab"><i class="fas fa-cube text-primary me-2"></i> Paxel</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-idexpress-tab" data-bs-toggle="pill" data-bs-target="#pills-idexpress" type="button" role="tab"><i class="fas fa-truck-moving text-danger me-2"></i> ID Express</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-anteraja-tab" data-bs-toggle="pill" data-bs-target="#pills-anteraja" type="button" role="tab"><i class="fas fa-shipping-fast text-success me-2"></i> Anteraja</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent" data-aos="fade-up" data-aos-delay="100">
            
            <div class="tab-pane fade show active" id="pills-jne" role="tabpanel" tabindex="0">
                <div class="table-responsive pb-2">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-start ps-5">Layanan JNE</th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Komisi Pasti Mitra<br><small class="fw-normal text-white-50">(Agen Pembawa / Reff)</small></th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Maks Diskon<br><small class="fw-normal text-white-50">Jaringan (TJS)</small></th>
                                <th colspan="3" class="border-bottom border-light border-opacity-25" style="background-color: #3A1B5E;">Simulasi Mode Tiering Otomatis<br><small class="fw-normal text-white-50">(Diskon Jaringan Berdasarkan Volume Paket)</small></th>
                            </tr>
                            <tr>
                                <th style="background-color: #3A1B5E;">1 - 100 Pkt</th>
                                <th style="background-color: #3A1B5E;">100 - 250 Pkt</th>
                                <th style="background-color: #3A1B5E;">> 250 Pkt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">REG / YES</td>
                                <td><span class="badge-override">2%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">18%</span></td>
                                <td><span class="tier-box">15.0%</span></td>
                                <td><span class="tier-box">17.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">18.0%</span></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">JTR (Cargo)</td>
                                <td><span class="badge-override">1%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">2%</span></td>
                                <td><span class="tier-box">1.0%</span></td>
                                <td><span class="tier-box">1.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">2.0%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-sapx" role="tabpanel" tabindex="0">
                <div class="table-responsive pb-2">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-start ps-5">Layanan SAPX</th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Komisi Pasti Mitra<br><small class="fw-normal text-white-50">(Agen Pembawa / Reff)</small></th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Maks Diskon<br><small class="fw-normal text-white-50">Jaringan (TJS)</small></th>
                                <th colspan="3" class="border-bottom border-light border-opacity-25" style="background-color: #3A1B5E;">Simulasi Mode Tiering Otomatis<br><small class="fw-normal text-white-50">(Diskon Jaringan Berdasarkan Volume Paket)</small></th>
                            </tr>
                            <tr>
                                <th style="background-color: #3A1B5E;">1 - 100 Pkt</th>
                                <th style="background-color: #3A1B5E;">100 - 250 Pkt</th>
                                <th style="background-color: #3A1B5E;">> 250 Pkt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">ODS & REG</td>
                                <td><span class="badge-override">2%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">25%</span></td>
                                <td><span class="tier-box">15.0%</span></td>
                                <td><span class="tier-box">20.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">25.0%</span></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">CARGO</td>
                                <td><span class="badge-override">2%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">20%</span></td>
                                <td><span class="tier-box">10.0%</span></td>
                                <td><span class="tier-box">15.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">20.0%</span></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">SATRIA</td>
                                <td><span class="badge-override">1%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">8%</span></td>
                                <td><span class="tier-box">4.0%</span></td>
                                <td><span class="tier-box">6.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">8.0%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-jnt" role="tabpanel" tabindex="0">
                <div class="table-responsive pb-2">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-start ps-5">Layanan J&T Express</th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Komisi Pasti Mitra<br><small class="fw-normal text-white-50">(Agen Pembawa / Reff)</small></th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Maks Diskon<br><small class="fw-normal text-white-50">Jaringan (TJS)</small></th>
                                <th colspan="3" class="border-bottom border-light border-opacity-25" style="background-color: #3A1B5E;">Simulasi Mode Tiering Otomatis<br><small class="fw-normal text-white-50">(Diskon Jaringan Berdasarkan Volume Paket)</small></th>
                            </tr>
                            <tr>
                                <th style="background-color: #3A1B5E;">1 - 100 Pkt</th>
                                <th style="background-color: #3A1B5E;">100 - 250 Pkt</th>
                                <th style="background-color: #3A1B5E;">> 250 Pkt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">EZ / ECO / SUPER</td>
                                <td><span class="badge-override">2%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">15%</span></td>
                                <td><span class="tier-box">10.0%</span></td>
                                <td><span class="tier-box">13.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">15.0%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="alert alert-info mt-4 border-0 rounded-4 shadow-sm text-dark bg-info bg-opacity-10"><i class="fas fa-info-circle text-info fs-5 me-2 align-middle"></i> Untuk seluruh layanan reguler J&T Express (EZ, ECO, SUPER JSD/JND), nilai diskon dan komisi <b>dipukul rata</b> untuk mempermudah perhitungan margin Mitra.</div>
            </div>

            <div class="tab-pane fade" id="pills-spx" role="tabpanel" tabindex="0">
                <div class="table-responsive pb-2">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-start ps-5">Layanan SPX Express</th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Komisi Pasti Mitra<br><small class="fw-normal text-white-50">(Agen Pembawa / Reff)</small></th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Maks Diskon<br><small class="fw-normal text-white-50">Jaringan (TJS)</small></th>
                                <th colspan="3" class="border-bottom border-light border-opacity-25" style="background-color: #3A1B5E;">Simulasi Mode Tiering Otomatis<br><small class="fw-normal text-white-50">(Diskon Jaringan Berdasarkan Volume Paket)</small></th>
                            </tr>
                            <tr>
                                <th style="background-color: #3A1B5E;">1 - 100 Pkt</th>
                                <th style="background-color: #3A1B5E;">100 - 250 Pkt</th>
                                <th style="background-color: #3A1B5E;">> 250 Pkt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">STANDARD / ECO</td>
                                <td><span class="badge-override">2%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">25%</span></td>
                                <td><span class="tier-box">15.0%</span></td>
                                <td><span class="tier-box">20.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">25.0%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-jntcargo" role="tabpanel" tabindex="0">
                <div class="table-responsive pb-2">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-start ps-5">Layanan J&T Cargo</th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Komisi Pasti Mitra<br><small class="fw-normal text-white-50">(Agen Pembawa / Reff)</small></th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Maks Diskon<br><small class="fw-normal text-white-50">Jaringan (TJS)</small></th>
                                <th colspan="3" class="border-bottom border-light border-opacity-25" style="background-color: #3A1B5E;">Simulasi Mode Tiering Otomatis<br><small class="fw-normal text-white-50">(Diskon Jaringan Berdasarkan Volume Paket)</small></th>
                            </tr>
                            <tr>
                                <th style="background-color: #3A1B5E;">1 - 100 Pkt</th>
                                <th style="background-color: #3A1B5E;">100 - 250 Pkt</th>
                                <th style="background-color: #3A1B5E;">> 250 Pkt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">FT (Fast Track)</td>
                                <td><span class="badge-override">2%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">18%</span></td>
                                <td><span class="tier-box">15.0%</span></td>
                                <td><span class="tier-box">17.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">18.0%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-lion" role="tabpanel" tabindex="0">
                <div class="table-responsive pb-2">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-start ps-5">Layanan Lion Parcel</th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Komisi Pasti Mitra<br><small class="fw-normal text-white-50">(Agen Pembawa / Reff)</small></th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Maks Diskon<br><small class="fw-normal text-white-50">Jaringan (TJS)</small></th>
                                <th colspan="3" class="border-bottom border-light border-opacity-25" style="background-color: #3A1B5E;">Simulasi Mode Tiering Otomatis<br><small class="fw-normal text-white-50">(Diskon Jaringan Berdasarkan Volume Paket)</small></th>
                            </tr>
                            <tr>
                                <th style="background-color: #3A1B5E;">1 - 100 Pkt</th>
                                <th style="background-color: #3A1B5E;">100 - 250 Pkt</th>
                                <th style="background-color: #3A1B5E;">> 250 Pkt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">BOSSPACK</td>
                                <td><span class="badge-override">2%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">10%</span></td>
                                <td><span class="tier-box">5.0%</span></td>
                                <td><span class="tier-box">7.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">10.0%</span></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">REGPACK</td>
                                <td><span class="badge-override">2%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">15%</span></td>
                                <td><span class="tier-box">7.0%</span></td>
                                <td><span class="tier-box">10.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">15.0%</span></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">JAGOPACK / BIGPACK / INTERPACK</td>
                                <td><span class="badge-override">1%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">3%</span></td>
                                <td><span class="tier-box">1.0%</span></td>
                                <td><span class="tier-box">2.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">3.0%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="tab-pane fade" id="pills-paxel" role="tabpanel" tabindex="0">
                <div class="table-responsive pb-2">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-start ps-5">Layanan Paxel</th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Komisi Pasti Mitra<br><small class="fw-normal text-white-50">(Agen Pembawa / Reff)</small></th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Maks Diskon<br><small class="fw-normal text-white-50">Jaringan (TJS)</small></th>
                                <th colspan="3" class="border-bottom border-light border-opacity-25" style="background-color: #3A1B5E;">Simulasi Mode Tiering Otomatis<br><small class="fw-normal text-white-50">(Diskon Jaringan Berdasarkan Volume Paket)</small></th>
                            </tr>
                            <tr>
                                <th style="background-color: #3A1B5E;">1 - 100 Pkt</th>
                                <th style="background-color: #3A1B5E;">100 - 250 Pkt</th>
                                <th style="background-color: #3A1B5E;">> 250 Pkt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">ALL</td>
                                <td><span class="badge-override">2%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">9%</span></td>
                                <td><span class="tier-box">5.0%</span></td>
                                <td><span class="tier-box">7.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">9.0%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-idexpress" role="tabpanel" tabindex="0">
                <div class="table-responsive pb-2">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-start ps-5">Layanan ID Express</th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Komisi Pasti Mitra<br><small class="fw-normal text-white-50">(Agen Pembawa / Reff)</small></th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Maks Diskon<br><small class="fw-normal text-white-50">Jaringan (TJS)</small></th>
                                <th colspan="3" class="border-bottom border-light border-opacity-25" style="background-color: #3A1B5E;">Simulasi Mode Tiering Otomatis<br><small class="fw-normal text-white-50">(Diskon Jaringan Berdasarkan Volume Paket)</small></th>
                            </tr>
                            <tr>
                                <th style="background-color: #3A1B5E;">1 - 100 Pkt</th>
                                <th style="background-color: #3A1B5E;">100 - 250 Pkt</th>
                                <th style="background-color: #3A1B5E;">> 250 Pkt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">STD</td>
                                <td><span class="badge-override">1%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">20%</span></td>
                                <td><span class="tier-box">10.0%</span></td>
                                <td><span class="tier-box">15.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">20.0%</span></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">IDLITE</td>
                                <td><span class="badge-override">1%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">8%</span></td>
                                <td><span class="tier-box">4.0%</span></td>
                                <td><span class="tier-box">6.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">8.0%</span></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">IDTRUCK</td>
                                <td><span class="badge-override">1%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">8%</span></td>
                                <td><span class="tier-box">4.0%</span></td>
                                <td><span class="tier-box">6.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">8.0%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-anteraja" role="tabpanel" tabindex="0">
                <div class="table-responsive pb-2">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-start ps-5">Layanan Anteraja</th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Komisi Pasti Mitra<br><small class="fw-normal text-white-50">(Agen Pembawa / Reff)</small></th>
                                <th rowspan="2" style="background-color: var(--primary-dark);">Maks Diskon<br><small class="fw-normal text-white-50">Jaringan (TJS)</small></th>
                                <th colspan="3" class="border-bottom border-light border-opacity-25" style="background-color: #3A1B5E;">Simulasi Mode Tiering Otomatis<br><small class="fw-normal text-white-50">(Diskon Jaringan Berdasarkan Volume Paket)</small></th>
                            </tr>
                            <tr>
                                <th style="background-color: #3A1B5E;">1 - 100 Pkt</th>
                                <th style="background-color: #3A1B5E;">100 - 250 Pkt</th>
                                <th style="background-color: #3A1B5E;">> 250 Pkt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">REG</td>
                                <td><span class="badge-override">2%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">10%</span></td>
                                <td><span class="tier-box">5.0%</span></td>
                                <td><span class="tier-box">7.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">10.0%</span></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">SAMEDAY</td>
                                <td><span class="badge-override">1%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">3%</span></td>
                                <td><span class="tier-box">1.0%</span></td>
                                <td><span class="tier-box">2.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">3.0%</span></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-5 fw-bold text-dark">NEXTDAY</td>
                                <td><span class="badge-override">1%</span></td>
                                <td><span class="fs-5 fw-bold text-primary">3%</span></td>
                                <td><span class="tier-box">1.0%</span></td>
                                <td><span class="tier-box">2.0%</span></td>
                                <td><span class="tier-box text-primary border-primary">3.0%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include 'footer.php'; ?>