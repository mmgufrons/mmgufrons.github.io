# Panduan Lengkap Publikasi Portofolio ke GitHub Pages
**Nama Pemilik:** Maulana Gufron  
**Username GitHub:** `mmgufrons`  
**Target URL Portofolio:** `https://mmgufrons.github.io/`  

---

## Ringkasan Cepat
GitHub Pages adalah layanan hosting gratis resmi dari GitHub untuk menampilkan website portofolio langsung ke publik. Agar website Anda beralamat `https://mmgufrons.github.io/`, nama repositori GitHub Anda **harus persis**:
```
mmgufrons.github.io
```

---

## METODE 1: Upload Otomatis dengan Skrip (Paling Cepat & Mudah)
Jika Anda berada di komputer Windows ini, sudah disediakan file:
👉 **`deploy-github.bat`** di folder utama Anda.

### Langkah-langkahnya:
1. Buka browser, login ke akun GitHub Anda: **https://github.com**
2. Klik tanda **`+`** di pojok kanan atas → Pilih **New repository**.
3. Masukkan nama repository: `mmgufrons.github.io`
4. Pastikan pilih **Public**.
5. Centang **Add a README file** (atau biarkan kosong).
6. Klik tombol hijau **Create repository**.
7. Sekarang, kembali ke folder laptop Anda, **klik ganda (double-click)** file:
   `deploy-github.bat`
8. Masukkan Personal Access Token atau login ketika jendela browser GitHub muncul.
9. Selesai! Seluruh portofolio (500+ file desain, gambar, dan kode) akan terunggah otomatis dalam 10-20 detik.

---

## METODE 2: Upload Menggunakan GitHub Desktop (Tampilan Visual / Tanpa Koding)
Jika Anda lebih suka menggunakan aplikasi resmi berbasis visual:
1. Unduh & install **GitHub Desktop** di https://desktop.github.com
2. Login dengan akun `mmgufrons`.
3. Klik **File** → **Clone Repository** → Pilih `mmgufrons/mmgufrons.github.io`.
4. Buka folder hasil clone tersebut di Windows Explorer.
5. Ekstrak seluruh isi file `paket-portofolio-github-pages.zip` ke dalam folder tersebut (pastikan file `index.html` berada tepat di dalam folder utama, bukan di dalam sub-folder lagi).
6. Kembali ke aplikasi GitHub Desktop:
   - Anda akan melihat ratusan file baru terdeteksi.
   - Di pojok kiri bawah, pada kolom *Summary*, ketik: `Upload Portofolio Final Maulana Gufron`.
   - Klik tombol biru **Commit to main**.
   - Klik tombol **Push origin** di bar atas.
7. Selesai!

---

## METODE 3: Upload Manual via Git Bash / Terminal
Jika Anda terbiasa dengan terminal git:
```bash
# 1. Masuk ke folder portofolio yang sudah diekstrak
cd /path/ke/folder-portofolio

# 2. Inisialisasi git dan branch main
git init
git branch -M main

# 3. Hubungkan ke repositori GitHub Anda
git remote add origin https://github.com/mmgufrons/mmgufrons.github.io.git

# 4. Simpan dan kirim semua berkas
git add .
git commit -m "Publish initial portfolio"
git push -u origin main
```

---

## Verifikasi Pengaturan GitHub Pages di Browser
Setelah file terunggah, pastikan fitur GitHub Pages sudah aktif:
1. Buka halaman repositori Anda di: `https://github.com/mmgufrons/mmgufrons.github.io`
2. Klik tab **Settings** (ikon roda gigi di menu atas).
3. Di bilah sisi kiri, pilih menu **Pages**.
4. Di bagian **Build and deployment**:
   - **Source**: Pilih `Deploy from a branch`
   - **Branch**: Pilih `main` dan folder `/(root)`
   - Klik **Save**.
5. Tunggu 1 hingga 2 menit sampai muncul kotak notifikasi hijau:
   > *"Your site is live at https://mmgufrons.github.io/"*

---

## Cara Mencantumkan di CV / Resume yang Menarik HRD
Cantumkan link portofolio ini pada bagian kontak/header CV Anda:

```text
===============================================================
MAULANA GUFRON
Business Development • AI Operations • Creative & Visual Design
===============================================================
🌐 Portofolio Digital : https://mmgufrons.github.io/
📱 WhatsApp           : +62 821-1773-4556
✉️ Email              : mmgufron.s@gmail.com
💼 LinkedIn           : linkedin.com/in/maulanagufron
===============================================================
```

### Keunggulan Link Ini di Mata Recruiter:
- Menggunakan domain `github.io` menunjukkan pemahaman teknis & adaptasi digital modern.
- Menampilkan dua keahlian sekaligus: **Bisnis & Operasional AI** di Tab 1, serta **Karya Desain Grafis & Branding** di Tab 2.
- Seluruh karya dan gambar terload cepat dengan navigasi interaktif.
