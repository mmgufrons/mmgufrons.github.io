<?php 
require_once 'auth.php'; 
if (isset($_SESSION['legal_logged_in']) && $_SESSION['legal_logged_in'] === true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Legal Document Management System</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: { primary: '#7335B7', accent: '#F3700D' }
                }
            }
        }
    </script>
    <style>
        body { 
            background: radial-gradient(circle at top right, #3A1B5E, #1F0D3D, #0f0c29); 
            color: white; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow: hidden;
        }
        .hero-blob { 
            position: absolute; 
            width: 600px; height: 600px; 
            background: #F3700D; 
            filter: blur(180px); 
            opacity: 0.2; 
            border-radius: 50%; 
            z-index: 0;
            top: -100px; right: -100px;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative">
    
    <div class="hero-blob"></div>
    
    <div class="glass-panel rounded-2xl p-8 w-full max-w-md text-white relative z-10">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold mb-2 tracking-wide">LDMS<span class="text-accent">.</span></h1>
            <p class="text-purple-200 text-sm">PT Solusi Mitra Aplikasi - Legal Portal</p>
        </div>

        <div class="bg-white/10 border border-white/20 text-purple-100 p-3 rounded-lg text-center mb-6 text-sm backdrop-blur-md">
            Mode Demo Portofolio — password: <b>demo123</b>
        </div>
        <?php if(isset($error)): ?>
            <div class="bg-red-500/20 border border-red-500/50 text-red-200 p-3 rounded-lg text-center mb-6 text-sm backdrop-blur-md">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-6">
                <label class="block text-xs font-bold uppercase tracking-wider text-purple-200 mb-2" for="password">Secret Code / Password</label>
                <input type="password" id="password" name="password" required 
                    class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent text-white placeholder-white/30 transition shadow-inner"
                    placeholder="Masukkan sandi rahasia...">
            </div>
            
            <button type="submit" 
                class="w-full bg-accent hover:bg-orange-500 text-white font-bold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-[1.02] shadow-lg shadow-orange-500/30">
                Masuk ke Sistem
            </button>
        </form>

        <div class="mt-10 text-center text-[10px] text-purple-200/50 uppercase tracking-widest">
            &copy; <?= date('Y') ?> SIMASRIM B2B Core.
        </div>
    </div>

</body>
</html>
