<?php
session_start();

// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
function require_login() {
    $_SESSION['legal_logged_in'] = true;
}

// PORTOFOLIO DEMO: hash password asli dihapus, diganti hash dari password demo publik "demo123".
$expected_hash = hash('sha256', 'demo123');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $input_hash = hash('sha256', $_POST['password']);

    if ($input_hash === $expected_hash) {
        $_SESSION['legal_logged_in'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Password salah!";
    }
}
?>
