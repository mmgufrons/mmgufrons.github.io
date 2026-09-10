<?php
// Izinkan CORS dari domain yang sama
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

// Buat folder jika belum ada (meskipun sudah kita mkdir, untuk berjaga-jaga)
$targetDir = "../uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Cek apakah ada file yang dikirim
if (isset($_FILES["file"])) {
    $file = $_FILES["file"];
    
    // Cek error upload
    if ($file["error"] !== UPLOAD_ERR_OK) {
        echo json_encode(["success" => false, "message" => "Gagal upload. Error code: " . $file["error"]]);
        exit;
    }

    // Bersihkan nama file dari karakter aneh
    $originalName = basename($file["name"]);
    $cleanName = preg_replace("/[^a-zA-Z0-9.\-_]/", "", $originalName);
    
    // Tambahkan timestamp agar nama unik
    $fileName = time() . "_" . $cleanName;
    $targetFilePath = $targetDir . $fileName;
    
    if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
        // URL server (HTTP_HOST). Jika pakai HTTPS, ubah 'http://' jadi 'https://'
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $domain = $_SERVER['HTTP_HOST'];
        
        // Asumsi path XAMPP default adalah /smsrm/sma/api/upload.php
        $requestUri = $_SERVER['REQUEST_URI']; 
        $baseUri = str_replace("api/upload.php", "", $requestUri);
        
        $fileUrl = $protocol . $domain . $baseUri . "uploads/" . $fileName;
        
        echo json_encode([
            "success" => true,
            "url" => $fileUrl,
            "name" => $originalName,
            "type" => $file["type"]
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal memindahkan file ke folder uploads."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Tidak ada file yang dikirim (Pastikan key 'file' di FormData)."]);
}
?>
