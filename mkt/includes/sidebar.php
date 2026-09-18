<?php
// ============================================================
// MKT HUB — includes/sidebar.php (Versi Portofolio Resmi)
// Hanya menampilkan 7 Modul Resmi Portofolio + Tombol Hub Utama
// ============================================================

$current_dir = basename(dirname($_SERVER['PHP_SELF']));
$current_page = basename($_SERVER['PHP_SELF']);
$base_path = isset($base_path) ? $base_path : '';
?>

<div id="sidebar" class="sidebar">
    <!-- Brand & Tombol Hub Utama -->
    <div class="px-5 pt-6 pb-4">
        <a href="<?= $base_path ?>../index.html" class="inline-flex items-center gap-2 mb-3 text-xs font-semibold text-white/70 hover:text-white bg-white/10 px-3 py-1.5 rounded-lg transition" style="text-decoration:none;">
            <i class="fas fa-arrow-left text-[10px]"></i> Portofolio Utama
        </a>
        <a href="<?= $base_path ?>index.php" class="block" style="text-decoration:none;">
            <span class="text-xl font-extrabold text-white tracking-wide">MKT<span style="color:#F3700D;">.</span>OS</span>
        </a>
        <span class="inline-block mt-1 text-xs font-medium text-white/50 bg-white/5 px-2.5 py-0.5 rounded-full">Portofolio Showcase (7 Modul)</span>
    </div>

    <div class="flex-grow-1" style="display: block;">
        <!-- Dashboard Utama -->
        <p class="nav-section-label">Pintu Masuk</p>
        <a href="<?= $base_path ?>index.html" class="nav-item <?= ($current_page == 'index.php' || $current_page == 'index.html') && $current_dir == 'mkt' ? 'active' : '' ?>">
            <span class="icon"><i class="fas fa-home"></i></span> Beranda MKT
        </a>

        <!-- 7 Modul Resmi Portofolio -->
        <hr class="nav-divider">
        <p class="nav-section-label">7 Modul Portofolio</p>

        <a href="<?= $base_path ?>admin_panel.html" class="nav-item <?= $current_page == 'admin_panel.php' || $current_page == 'admin_panel.html' ? 'active' : '' ?>">
            <span class="icon"><i class="fas fa-cogs"></i></span> 1. Admin Panel
        </a>

        <a href="<?= $base_path ?>partner/b2b.html" class="nav-item <?= ($current_page == 'b2b.php' || $current_page == 'b2b.html') && $current_dir == 'partner' ? 'active' : '' ?>">
            <span class="icon"><i class="fas fa-handshake"></i></span> 2. Partner B2B
        </a>

        <a href="<?= $base_path ?>mitra/tracker.html" class="nav-item <?= ($current_page == 'tracker.php' || $current_page == 'tracker.html') && $current_dir == 'mitra' ? 'active' : '' ?>">
            <span class="icon"><i class="fas fa-route"></i></span> 3. Mitra Tracker
        </a>

        <a href="<?= $base_path ?>campaign/campaign-tracker/index.html" class="nav-item <?= $current_dir == 'campaign-tracker' ? 'active' : '' ?>">
            <span class="icon"><i class="fas fa-bullhorn"></i></span> 4. Campaign Tracker
        </a>

        <a href="<?= $base_path ?>data/ppob/index.html" class="nav-item <?= $current_dir == 'ppob' ? 'active' : '' ?>">
            <span class="icon"><i class="fas fa-bolt"></i></span> 5. PPOB Dashboard
        </a>

        <a href="<?= $base_path ?>data/mp-report/index.html" class="nav-item <?= $current_dir == 'mp-report' ? 'active' : '' ?>">
            <span class="icon"><i class="fas fa-store"></i></span> 6. MP Report
        </a>

        <a href="<?= $base_path ?>tools/legal/index.html" class="nav-item <?= $current_dir == 'legal' ? 'active' : '' ?>">
            <span class="icon"><i class="fas fa-file-contract"></i></span> 7. Legal Tools
        </a>
    </div>

    <!-- Back to Hub Footer -->
    <hr class="nav-divider mt-auto">
    <a href="<?= $base_path ?>../index.html" class="nav-item mb-4" style="color:#7ee0c1;background:rgba(126,224,193,0.08);">
        <span class="icon"><i class="fas fa-arrow-circle-left"></i></span> Portofolio Utama
    </a>
</div>