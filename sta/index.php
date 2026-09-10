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
            --primary-color: #129649; /* Hijau Albani sesuai logo */
            --secondary-color: #FFFFFF; /* Putih */
            --text-color: #333333; /* Abu Gelap */
            --link-color: #F8F8F8; /* Background Tombol default */
            --border-radius: 12px;
            --light-green-bg: #e8f5e9; /* Hijau Sangat Muda */
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            background-color: var(--secondary-color);
            color: var(--text-color);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            
            /* Ornamen Background CSS */
            background-image: 
                radial-gradient(circle at top left, var(--light-green-bg) 1px, transparent 1px),
                radial-gradient(circle at bottom right, var(--light-green-bg) 1px, transparent 1px);
            background-size: 30px 30px; 
            background-position: 0 0, 15px 15px; 
            background-attachment: fixed; 
        }

        .container {
            width: 100%;
            max-width: 450px; 
            text-align: center;
            background-color: rgba(255, 255, 255, 0.95); 
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
            object-fit: cover;
            border: 4px solid var(--primary-color);
        }

        h1 {
            color: var(--primary-color);
            font-size: 1.5em;
            margin: 5px 0 5px 0;
        }

        .subtitle {
            font-size: 1em;
            color: #666;
            margin-bottom: 20px;
        }
        
        .usp-text {
            font-size: 0.85em;
            color: var(--text-color);
            background-color: var(--light-green-bg); 
            padding: 5px 15px;
            border-radius: 20px;
            margin-bottom: 25px;
            display: inline-block;
            font-weight: 600;
        }

        .link-button {
            display: block;
            background-color: var(--link-color);
            color: var(--text-color);
            text-decoration: none;
            padding: 15px 20px;
            margin: 12px 0;
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: background-color 0.2s, transform 0.2s;
            border: 2px solid var(--primary-color);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 0.95em;
        }

        .link-button:hover {
            background-color: #e0e0e0; 
            transform: translateY(-2px);
        }
        
        .main-link {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .main-link:hover {
            background-color: #0c7336; 
        }

        .category-label {
            font-size: 0.8em;
            text-align: left;
            margin: 20px 0 5px 5px;
            color: var(--primary-color);
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
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
    <a href="<?php echo htmlspecialchars($data['mainLink']['url']); ?>" target="_blank" class="link-button main-link">
        <?php echo htmlspecialchars($data['mainLink']['text']); ?>
    </a>
    <?php endif; ?>

    <?php foreach ($data['categories'] as $cat): ?>
        <?php if (!empty($cat['label'])): ?>
            <div class="category-label"><?php echo htmlspecialchars($cat['label']); ?></div>
        <?php endif; ?>
        
        <?php foreach ($cat['links'] as $link): ?>
            <?php if (!empty($link['text'])): ?>
            <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank" class="link-button">
                <?php echo htmlspecialchars($link['text']); ?>
            </a>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>

</div>

</body>
</html>
