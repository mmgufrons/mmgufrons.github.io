<?php
// ============================================================
// PORTOFOLIO DEMO — login.php
// File ini TIDAK ADA di source asli (login sungguhan di-host
// terpisah di luar folder mkt/ dan tidak ikut disalin). Dibuatkan
// khusus untuk versi porto supaya demo bisa dijalankan mandiri,
// dengan password DEMO publik (bukan kredensial asli siapa pun).
// ============================================================
session_start();

$demo_password = 'demo123';
$error = '';

if (isset($_SESSION['login_simasrim']) && $_SESSION['login_simasrim'] === true) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['password'] ?? '') === $demo_password) {
        $_SESSION['login_simasrim'] = true;
        $_SESSION['last_activity'] = time();
        header('Location: index.php');
        exit;
    }
    $error = 'Password salah.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login (Demo) | SIMASRIM Marketing OS</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  :root{--g-cepat:120ms;--g-normal:200ms;--ease-keluar:cubic-bezier(0.16,1,0.3,1)}
  *{box-sizing:border-box}
  body{font-family:"Inter",sans-serif;background:#0f0c29;background:linear-gradient(135deg,#3A1B5E,#0f0c29);min-height:100vh;min-height:100svh;display:flex;align-items:center;justify-content:center;margin:0;padding:16px;color:#1a1a1a;font-size:1rem;line-height:1.5}
  .card{background:#fff;border-radius:16px;padding:clamp(1.5rem,5vw,2rem);width:100%;max-width:384px;border:1px solid rgba(0,0,0,.08)}
  h1{font-size:clamp(1.25rem,1.1rem + .6vw,1.5rem);margin:0 0 4px;line-height:1.25}
  p.sub{color:#4a4a4a;font-size:.875rem;margin:0 0 24px}
  .hint{background:#eef2ff;border:1px solid #c7d2fe;color:#312e81;padding:8px 16px;border-radius:8px;font-size:.875rem;margin-bottom:24px}
  label{display:block;font-size:.875rem;font-weight:600;margin-bottom:8px}
  input{width:100%;min-height:48px;padding:8px 16px;border-radius:8px;border:1px solid #767676;font-size:1rem;margin-bottom:16px;font-family:inherit}
  input:focus-visible{outline:3px solid #5A2A8F;outline-offset:2px;border-color:#5A2A8F}
  button{width:100%;min-height:48px;padding:8px 16px;border:none;border-radius:8px;background:#5A2A8F;color:#fff;font-weight:700;font-size:1rem;font-family:inherit;cursor:pointer;transition:transform var(--g-cepat) var(--ease-keluar),background-color var(--g-normal) var(--ease-keluar)}
  button:active{transform:scale(.97)}
  button:focus-visible{outline:3px solid #312e81;outline-offset:2px}
  @media (hover:hover) and (pointer:fine){button:hover{background:#4a2277}}
  .err{color:#991b1b;background:#fef2f2;border:1px solid #fecaca;padding:8px 16px;border-radius:8px;font-size:.875rem;margin-bottom:16px}
  @media (prefers-reduced-motion:reduce){button{transition:none}button:active{transform:none}}
</style>
</head>
<body>
  <div class="card">
    <h1>SIMASRIM Marketing OS</h1>
    <p class="sub">Mode Demo Portofolio</p>
    <div class="hint">Ini bukan sistem produksi. Password demo: <b>demo123</b></div>
    <?php if ($error): ?><div class="err" role="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
      <label for="pw">Password</label>
      <input type="password" id="pw" name="password" autocomplete="current-password" placeholder="Masukkan password demo" autofocus required>
      <button type="submit">Masuk</button>
    </form>
  </div>
</body>
</html>
