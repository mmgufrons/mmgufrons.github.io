# PT SMA Enterprise OS — Versi Demo Portofolio

Ini adalah **versi demo portofolio** dari ERP internal PT SMA — data dummy, kredensial sudah
diganti placeholder, dan sistem ini **tidak pernah terhubung ke Firebase live manapun**.

## Apa yang Didummy-kan

- `firebase_config.php` — `FIREBASE_URL` & `FIREBASE_SECRET` asli sudah diganti total dengan
  placeholder (`DUMMY-SECRET-GANTI-SENDIRI` + domain contoh).
- Seluruh SDK Firebase (app/database/auth compat) diganti `js/firebase-mock.js` — sebuah shim
  ringan yang meniru API `firebase.database()` / `firebase.auth()` secukupnya untuk menjalankan
  aplikasi ini, tapi membaca/menulis ke `localStorage` browser (di-seed dari
  `data/dummy-seed.json`), bukan ke server manapun.
- Semua data karyawan, tugas, catatan, chat tim, dsb adalah **data fiktif** (nama, email, dan UID
  contoh) — tidak ada satu pun data karyawan/pelanggan asli PT SMA yang ikut disalin.
- Direktori "Tools" internal (`js/views/tools.js`) yang aslinya berisi puluhan link dokumen
  Google/Canva internal — termasuk sebuah **token JWT live** ke dashboard payment gateway yang
  sempat ketemu hardcode di sana — sudah **dihapus total** dan diganti daftar contoh generik.

## Login Demo

Login pakai email demo apa saja (lihat hint di halaman login), password bebas — sistem akan
otomatis mencocokkan ke salah satu user dummy di `data/dummy-seed.json`. Contoh:

- `dimas@contoh-perusahaan.demo` — role SuperAdmin
- `bagas@contoh-perusahaan.demo` — role Staff (CS)

Perubahan data (tugas, catatan, chat, dsb) tersimpan di `localStorage` browser masing-masing
pengunjung — reset otomatis jika `localStorage` dikosongkan atau dibuka via mode incognito.

## Gaya tampilan (Tailwind lokal)
Tailwind **tidak** lagi diambil dari CDN. `assets/css/tailwind.css` adalah hasil kompilasi Tailwind v3.4.17
dari kelas yang dipakai di `index.html`, `offline.html`, dan `js/` (hover hanya untuk mouse/trackpad).
Bila menambah kelas Tailwind baru di `js/`, bangun ulang (konfigurasi ada di `off/sources/porto-bahan/sma-tailwind/`):

```
npx -y tailwindcss@3.4.17 -c tailwind.config.js -i in.css -o out.css --minify
```
lalu salin `out.css` ke `assets/css/tailwind.css`. Berkas ini dimuat paling akhir di `<head>` (setelah app.css),
sama seperti CDN dulu, supaya kelas utilitas menang.
