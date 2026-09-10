# STA — Link Bio Albani Store (Versi Demo Portofolio)

Versi demo dari halaman link bio "Albani Store".

## Apa yang Didummy-kan

Pola sama dengan `smr/`: versi asli cURL langsung ke Firebase Realtime Database
(`smsrm-lm-default-rtdb`) dengan fallback lokal. Di versi porto ini, panggilan live **dihilangkan
total** — `index.php` dipaksa selalu membaca dari file dummy lokal `data/sta_data.json` (judul,
kategori, dan link semuanya data contoh, bukan katalog produk asli).
