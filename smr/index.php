<?php
// ============================================================
// PORTOFOLIO DEMO — data selalu dibaca dari file dummy lokal.
// Versi asli mengambil data lewat cURL dari Firebase RTDB;
// di versi porto ini panggilan live SENGAJA DIHILANGKAN TOTAL
// dan diganti fallback lokal yang dipaksa aktif, memakai data fiktif.
// ============================================================
$local_path = __DIR__ . '/data/smr_data.json';
$json_data = file_exists($local_path) ? file_get_contents($local_path) : '{}';
$data = json_decode($json_data, true);

if (!$data) {
    die("Gagal memuat data dummy SMR (data/smr_data.json).");
}

function e($s) { return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8'); }

// Tautan ke domain lain dibuka di tab baru; tautan contoh "#" tetap di halaman ini.
function atribut_keluar($url) {
    return preg_match('#^https?://#i', $url) ? ' target="_blank" rel="noopener"' : '';
}

$ikon_tautan = [
    'highlight' => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.92 20.16,13.19L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/></svg>',
    'whatsapp' => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 6.46 17.5 2 12.04 2M12.05 19.83C10.58 19.83 9.16 19.44 7.93 18.71L7.65 18.54L4.54 19.36L5.38 16.32L5.19 16.04C4.38 14.78 3.93 13.31 3.93 11.91C3.93 7.45 7.56 3.82 12.05 3.82C16.54 3.82 20.17 7.45 20.17 11.91C20.17 16.37 16.54 20 12.05 20M16.53 14.59C16.28 14.47 15.06 13.87 14.84 13.79C14.62 13.71 14.46 13.67 14.29 13.91C14.13 14.16 13.66 14.71 13.52 14.88C13.37 15.04 13.23 15.06 12.98 14.94C12.73 14.82 11.93 14.56 10.97 13.71C10.22 13.05 9.71 12.22 9.56 11.97C9.42 11.72 9.55 11.59 9.67 11.47C9.78 11.36 9.91 11.21 10.03 11.07C10.16 10.93 10.2 10.83 10.28 10.66C10.37 10.49 10.32 10.35 10.26 10.23C10.2 10.11 9.7 8.87 9.5 8.35C9.29 7.85 9.09 7.92 8.94 7.91C8.8 7.91 8.64 7.91 8.47 7.91C8.31 7.91 8.04 7.97 7.81 8.22C7.58 8.47 6.94 9.07 6.94 10.29C6.94 11.5 7.84 12.68 7.96 12.84C8.09 13 9.7 15.48 12.16 16.54C12.75 16.79 13.21 16.94 13.57 17.06C14.16 17.25 14.69 17.21 15.11 17.14C15.58 17.06 16.53 16.55 16.73 15.97C16.94 15.39 16.94 14.89 16.88 14.77C16.82 14.66 16.65 14.59 16.41 14.47"/></svg>',
    'pembelian' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>',
];
$panah = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
$kelas_tipe = ['highlight' => ' smr-tautan--sorot', 'whatsapp' => ' smr-tautan--wa'];

$ikon_sosial = [
    'instagram' => '<path d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"/>',
    'tiktok' => '<path d="M21,7V9a1,1,0,0,1-1,1,8,8,0,0,1-4-1.08V15.5A6.5,6.5,0,1,1,6.53,9.72a1,1,0,0,1,1.47.9v2.52a.92.92,0,0,1-.28.62,2.49,2.49,0,0,0,2,4.23A2.61,2.61,0,0,0,12,15.35V3a1,1,0,0,1,1-1h2.11a1,1,0,0,1,1,.83A4,4,0,0,0,20,6,1,1,0,0,1,21,7Z"/>',
    'linkedin' => '<path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>',
    'youtube' => '<path d="M21.582,6.186c-0.23-0.86-0.908-1.538-1.768-1.768C18.254,4,12,4,12,4s-6.254,0-7.814,0.418 c-0.86,0.23-1.538,0.908-1.768,1.768C2,7.746,2,12,2,12s0,4.254,0.418,5.814c0.23,0.86,0.908,1.538,1.768,1.768 C5.746,20,12,20,12,20s6.254,0,7.814-0.418c0.86-0.23,1.538-0.908,1.768-1.768C22,16.254,22,12,22,12S22,7.746,21.582,6.186z M10,15.464V8.536L16,12L10,15.464z"/>',
    'facebook' => '<path d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"/>',
    'twitter' => '<path d="M18.9 2H22L15.3 9.7L23.2 22H17L12.1 14.5L6.6 22H3.5L10.6 13.8L3.2 2H9.6L14.1 8.9L18.9 2ZM17.8 20.3H19.5L8.5 3.5H6.7L17.8 20.3Z"/>',
];
// Ikon bola dunia (garis) untuk situs web atau platform yang tidak dikenal
$ikon_web = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>';
$nama_sosial = ['instagram' => 'Instagram', 'tiktok' => 'TikTok', 'linkedin' => 'LinkedIn', 'youtube' => 'YouTube', 'facebook' => 'Facebook', 'twitter' => 'X (Twitter)', 'website' => 'Situs web'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#1d1033">
    <title>Pusat Informasi - SIMASRIM</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="smr-latar" aria-hidden="true">
        <div class="smr-bulatan smr-bulatan--1"></div>
        <div class="smr-bulatan smr-bulatan--2"></div>
    </div>

    <button type="button" id="shareButton" class="smr-bagikan" aria-label="Bagikan halaman ini" title="Bagikan halaman ini">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
    </button>

    <div class="smr-halaman">
        <header class="smr-kepala">
            <h1 class="smr-judul">Pusat Informasi SIMASRIM</h1>
            <a class="smr-logo" href="https://www.simasrim.com" target="_blank" rel="noopener">
                <img src="https://www.simasrim.com/images/logo.png" alt="Logo SIMASRIM" width="192" height="64">
            </a>
            <p class="smr-slogan">Solusi Pengiriman &amp; Layanan Digital Terintegrasi</p>
        </header>

        <main class="smr-isi">
            <nav aria-label="Tautan penting">
                <ul class="smr-daftar">
<?php foreach ($data['links'] as $link):
    $tipe = $link['type'] ?? 'default';
    $kelas = 'smr-tautan' . ($kelas_tipe[$tipe] ?? '');
?>
                    <li><a href="<?php echo e($link['url']); ?>"<?php echo atribut_keluar($link['url']); ?> class="<?php echo $kelas; ?>">
                        <?php if (isset($ikon_tautan[$tipe])): ?><span class="smr-tautan__ikon"><?php echo $ikon_tautan[$tipe]; ?></span><?php endif; ?>
                        <span class="smr-tautan__teks"><?php echo e($link['text']); ?></span>
                        <?php if ($tipe === 'daftar'): ?><span class="smr-tautan__panah"><?php echo $panah; ?></span><?php endif; ?>
                    </a></li>
<?php endforeach; ?>
                </ul>
            </nav>
        </main>

        <footer class="smr-kaki">
            <p class="smr-kaki__label">Temukan kami di media sosial</p>
            <ul class="smr-sosial">
<?php foreach (($data['socials'] ?? []) as $soc):
    if (empty($soc['url']) || empty($soc['platform'])) continue;
    $p = strtolower($soc['platform']);
    $ikon = isset($ikon_sosial[$p]) ? '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">' . $ikon_sosial[$p] . '</svg>' : $ikon_web;
    $nama = $nama_sosial[$p] ?? ucfirst($p);
?>
                <li><a href="<?php echo e($soc['url']); ?>"<?php echo atribut_keluar($soc['url']); ?> aria-label="<?php echo e($nama); ?>" title="<?php echo e($nama); ?>"><?php echo $ikon; ?></a></li>
<?php endforeach; ?>
            </ul>
            <p class="smr-hak">&copy; 2026 PT Solusi Mitra Aplikasi.</p>
        </footer>
    </div>

    <div id="toast" class="smr-toast" role="status" aria-live="polite">
        <svg viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
        <span id="toastText"></span>
    </div>

    <script>
        const shareButton = document.getElementById('shareButton');
        const toast = document.getElementById('toast');
        const toastText = document.getElementById('toastText');
        let toastTimer;

        shareButton.addEventListener('click', async () => {
            const url = window.location.href;
            if (navigator.share) {
                try {
                    await navigator.share({ title: 'Pusat Informasi - SIMASRIM', text: 'Akses semua link penting SIMASRIM di sini!', url });
                    return;
                } catch (err) {
                    // Pengguna menutup lembar bagikan: jangan dianggap gagal
                    if (err && err.name === 'AbortError') return;
                }
            }
            copyLink(url);
        });

        async function copyLink(text) {
            try {
                await navigator.clipboard.writeText(text);
                showToast('Link berhasil disalin!');
            } catch (err) {
                // Cadangan untuk peramban lama / halaman bukan https
                const ta = document.createElement('textarea');
                ta.value = text;
                ta.setAttribute('readonly', '');
                ta.style.position = 'fixed';
                ta.style.opacity = '0';
                document.body.appendChild(ta);
                ta.select();
                const ok = document.execCommand('copy');
                document.body.removeChild(ta);
                showToast(ok ? 'Link berhasil disalin!' : 'Gagal menyalin. Salin dari bilah alamat.');
            }
        }

        function showToast(msg) {
            toastText.textContent = msg;
            toast.classList.add('tampil');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => toast.classList.remove('tampil'), 2500);
        }
    </script>
</body>
</html>
