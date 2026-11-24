<?php
// ============================================================
// PORTOFOLIO DEMO — data selalu dibaca dari file dummy lokal.
// Versi asli mengambil data lewat cURL dari Firebase RTDB;
// di versi porto ini panggilan live SENGAJA DIHILANGKAN TOTAL
// dan diganti fallback lokal yang dipaksa aktif, memakai data fiktif.
// ============================================================
$local_path = __DIR__ . '/data/sta_data.json';
$json_data = file_exists($local_path) ? file_get_contents($local_path) : '{}';
$data = json_decode($json_data, true);

if (!$data) {
    die("Gagal memuat data dummy STA (data/sta_data.json).");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albani Store | Link Bio</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <style>
        :root {
            --primary-color: #129649;   /* Hijau Albani sesuai logo (garis & cincin logo) */
            --hijau-teks: #0a6630;      /* Hijau yang sama, digelapkan supaya teks lolos AAA (7:1) */
            --hijau-tekan: #08552a;
            --secondary-color: #FFFFFF;
            --text-color: #1f2937;
            --teks-redup: #4b5563;      /* 7.5:1 di atas putih */
            --link-color: #F8F8F8;
            --light-green-bg: #e8f5e9;
            --radius: 12px;
            --gerak-cepat: 120ms;
            --gerak-normal: 200ms;
            --ease-keluar: cubic-bezier(0.16, 1, 0.3, 1);
        }

        * { box-sizing: border-box; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 1rem;
            line-height: 1.5;
            background-color: var(--secondary-color);
            color: var(--text-color);
            margin: 0;
            padding: 24px 16px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            min-height: 100svh;
            background-image:
                radial-gradient(circle at top left, var(--light-green-bg) 1px, transparent 1px),
                radial-gradient(circle at bottom right, var(--light-green-bg) 1px, transparent 1px);
            background-size: 32px 32px;
            background-position: 0 0, 16px 16px;
            background-attachment: fixed;
        }

        .container {
            width: 100%;
            max-width: 448px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.96);
            padding: 32px 24px;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .logo {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            margin-bottom: 8px;
            object-fit: cover;
            border: 4px solid var(--primary-color);
        }

        h1 {
            color: var(--hijau-teks);
            font-size: clamp(1.5rem, 1.25rem + 1vw, 1.75rem);
            line-height: 1.25;
            margin: 8px 0;
        }

        .subtitle {
            font-size: 1rem;
            color: var(--teks-redup);
            margin: 0 0 16px;
        }

        .usp-text {
            font-size: 1rem;
            color: var(--text-color);
            background-color: var(--light-green-bg);
            padding: 8px 16px;
            border-radius: 24px;
            margin: 0 0 24px;
            display: inline-block;
            font-weight: 600;
        }

        .link-button {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 56px;
            background-color: var(--link-color);
            color: var(--text-color);
            text-decoration: none;
            padding: 16px 24px;
            margin: 8px 0;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 1rem;
            border: 2px solid var(--primary-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: background-color var(--gerak-normal) var(--ease-keluar), transform var(--gerak-cepat) var(--ease-keluar);
            -webkit-tap-highlight-color: transparent;
        }
        .link-button:active { transform: scale(0.97); }
        .link-button:focus-visible { outline: 3px solid var(--hijau-teks); outline-offset: 4px; }

        .main-link {
            background-color: var(--hijau-teks);
            border-color: var(--hijau-teks);
            color: var(--secondary-color);
            margin-bottom: 16px;
        }

        @media (hover: hover) and (pointer: fine) {
            .link-button:hover { background-color: #e5e7eb; }
            .main-link:hover { background-color: var(--hijau-tekan); }
        }

        .category-label {
            font-size: 0.8125rem;
            text-align: left;
            margin: 24px 0 8px 4px;
            color: var(--hijau-teks);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        @media (prefers-reduced-motion: reduce) {
            .link-button { transition: background-color 1ms; }
            .link-button:active { transform: none; }
        }
    </style>
</head>
<body>

<div class="container">
    <img src="logo.png" alt="Logo Albani Store" class="logo">
    
    <h1><?php echo htmlspecialchars($data['title'] ?? 'ALBANI STORE'); ?></h1>
    <p class="subtitle"><?php echo htmlspecialchars($data['subtitle'] ?? ''); ?></p>
    
    <p class="usp-text"><?php echo htmlspecialchars($data['uspText'] ?? ''); ?></p>

    <?php if (!empty($data['mainLink']['url']) && !empty($data['mainLink']['text'])): ?>
    <?php $u = $data['mainLink']['url']; ?>
    <a href="<?php echo htmlspecialchars($u); ?>"<?php if (preg_match('#^https?://#', $u)) echo ' target="_blank" rel="noopener"'; ?> class="link-button main-link">
        <?php echo htmlspecialchars($data['mainLink']['text']); ?>
    </a>
    <?php endif; ?>

    <?php foreach ($data['categories'] as $cat): ?>
        <?php if (!empty($cat['label'])): ?>
            <div class="category-label"><?php echo htmlspecialchars($cat['label']); ?></div>
        <?php endif; ?>
        
        <?php foreach ($cat['links'] as $link): ?>
            <?php if (!empty($link['text'])): ?>
            <a href="<?php echo htmlspecialchars($link['url']); ?>"<?php if (preg_match('#^https?://#', $link['url'])) echo ' target="_blank" rel="noopener"'; ?> class="link-button">
                <?php echo htmlspecialchars($link['text']); ?>
            </a>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>

</div>

</body>
</html>
