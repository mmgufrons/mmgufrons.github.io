<?php
/**
 * Matriks Partner Logistik lama sudah digabung ke partner/b2b.php (kategori "Logistik")
 * supaya data kontak & aset tidak dobel di 2 tempat. Redirect ke sana dengan filter
 * kategori otomatis, bukan dihapus, supaya link lama (bookmark/sidebar) tidak 404.
 */
header('Location: b2b.php?category=Logistik');
exit;
