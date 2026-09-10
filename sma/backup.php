<?php
/**
 * SIMASRIM Marketing OS — Auto Daily Backup Script
 * 
 * Instructions for cPanel Cron Job (Run once a day at midnight):
 * 0 0 * * * /usr/local/bin/php /home/yourusername/public_html/mg/backup.php >/dev/null 2>&1
 */

// ============================================================
// LOAD KONFIGURASI DARI FILE TERPISAH (lebih aman)
// ============================================================
require_once __DIR__ . '/firebase_config.php';

// 1. Configuration
$firebase_url    = FIREBASE_URL;
$firebase_secret = FIREBASE_SECRET;
$backup_dir      = __DIR__ . '/backups/';
$days_to_keep    = 30;

// Ensure backup directory exists
if (!file_exists($backup_dir)) {
    mkdir($backup_dir, 0755, true);
}

// 2. Fetch Data using cURL
$url_with_auth = $firebase_url . '?auth=' . $firebase_secret;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_with_auth);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// 3. Handle Response
if ($http_code === 200 && $response) {
    // Validate JSON
    $decoded = json_decode($response);
    if (json_last_error() === JSON_ERROR_NONE) {
        $date = date('Y-m-d_H-i-s');
        $filename = $backup_dir . 'simasrim_backup_' . $date . '.json';
        
        // Save file
        if (file_put_contents($filename, $response)) {
            echo "Backup successful: $filename\n";
        } else {
            echo "Error: Failed to write backup file to disk.\n";
        }
    } else {
        echo "Error: Invalid JSON received from Firebase.\n";
    }
} else {
    echo "Error: Failed to fetch from Firebase. HTTP Code: $http_code. cURL Error: $error\n";
}

// 4. Cleanup old backups
$files = glob($backup_dir . 'simasrim_backup_*.json');
$now = time();

foreach ($files as $file) {
    if (is_file($file)) {
        if ($now - filemtime($file) >= 60 * 60 * 24 * $days_to_keep) {
            unlink($file);
            echo "Deleted old backup: $file\n";
        }
    }
}
?>
