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
  body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg,#3A1B5E,#0f0c29); min-height: 100vh; display:flex; align-items:center; justify-content:center; margin:0; color:#222; }
  .card { background:#fff; border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 380px; box-shadow: 0 20px 50px rgba(0,0,0,.3); }
  h1 { font-size: 1.25rem; margin: 0 0 .25rem; }
  p.sub { color:#777; font-size:.85rem; margin: 0 0 1.5rem; }
  .hint { background:#eef2ff; border:1px solid #c7d2fe; color:#3730a3; padding:.6rem .8rem; border-radius:8px; font-size:.8rem; margin-bottom:1.25rem; }
  input { width:100%; padding: .75rem 1rem; border-radius:8px; border:1px solid #ddd; font-size: .95rem; box-sizing:border-box; margin-bottom:1rem; }
  button { width:100%; padding:.75rem; border:none; border-radius:8px; background:#5A2A8F; color:#fff; font-weight:700; font-size:.95rem; cursor:pointer; }
  button:hover { background:#4a2277; }
  .err { color:#b91c1c; font-size:.85rem; margin-bottom:1rem; }
</style>
</head>
<body>
  <div class="card">
    <h1>SIMASRIM Marketing OS</h1>
    <p class="sub">Mode Demo Portofolio</p>
    <div class="hint">Ini bukan sistem produksi. Password demo: <b>demo123</b></div>
    <?php if ($error): ?><div class="err"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
      <input type="password" name="password" placeholder="Masukkan password demo" autofocus required>
      <button type="submit">Masuk</button>
    </form>
  </div>
</body>
</html>
