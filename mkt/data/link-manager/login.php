<?php
session_start();

// Cek apakah sudah login
if (isset($_SESSION['dashboard_logged_in']) && $_SESSION['dashboard_logged_in'] === true) {
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    // PORTOFOLIO DEMO: password asli dihapus, diganti password demo publik.
    $correct_password = 'demo123';
    
    if ($password === $correct_password) {
        $_SESSION['dashboard_logged_in'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = 'Password salah. Akses ditolak.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SMSRM Link Manager</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            z-index: 10;
        }
        .login-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .login-card h2 {
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
            background: linear-gradient(to right, #ff903b, #f3700d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .login-card p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(0, 0, 0, 0.2);
            color: white;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        .form-group input:focus {
            border-color: var(--accent);
            background: rgba(0, 0, 0, 0.4);
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-login:hover {
            background: var(--accent-hover);
        }
        .error-msg {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="background-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>
    
    <div class="login-container">
        <div class="login-card">
            <h2>SMSRM Link Manager</h2>
            <p>CS & Ops CMS Dashboard</p>
            <div class="error-msg" style="background:#eef2ff;color:#3730a3;"><i class="ph-bold ph-info"></i> Mode Demo Portofolio — password: <b>demo123</b></div>
            <?php if ($error): ?>
                <div class="error-msg"><i class="ph-bold ph-warning-circle"></i> <?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="password">Password Akses</label>
                    <input type="password" id="password" name="password" required autofocus placeholder="Masukkan password CS...">
                </div>
                <button type="submit" class="btn-login"><i class="ph-bold ph-lock-key"></i> Buka Akses</button>
            </form>
        </div>
    </div>
</body>
</html>
