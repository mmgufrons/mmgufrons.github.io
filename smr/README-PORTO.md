# SMR — Pusat Informasi (Versi Demo Portofolio)

Versi demo dari halaman "Pusat Informasi" (link bio gaya Linktree) SIMASRIM.

## Apa yang Didummy-kan

Versi asli mengambil data lewat cURL langsung dari Firebase Realtime Database
(`smsrm-lm-default-rtdb`), dengan fallback ke file lokal kalau Firebase kosong. Di versi porto ini,
panggilan live **dihilangkan total** — `index.php` dipaksa selalu membaca dari file dummy lokal
`data/smr_data.json` (link, nomor WA, dan sosial media semuanya data contoh).
