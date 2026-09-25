# AGENTS.md — Context & Blueprint Proyek (Untuk Semua AI Assistant)

> 🤖 **Panduan untuk AI (Antigravity, Claude, ChatGPT, Cursor, Gemini, dll.)**:  
> Baca file ini sebelum menulis atau memodifikasi kode. File ini merangkum **inti, perjalanan, dan posisi saat ini** dari portofolio Maulana Gufron agar kamu bisa langsung "satu frekuensi" (*vibe coding*) tanpa asumsi keliru.

---

## 👤 1. Profil Pemilik & Filosofi Vibe Coding
- **Owner:** Maulana Gufron — *Business & AI Operations Specialist + Creative Designer*.
- **Gaya Kerja:** **Vibe Coder**. Cepat, pragmatis, visual-first, mengutamakan estetika premium & fungsi nyata, anti-birokrasi kode yang berbelit-belit.
- **Standar Estetika:** Kontras tinggi (*WCAG AAA*), warna curated (*Obsidian Dark* `#09090b`, *Deep Violet* `#140927`, *Accent Orange* `#F3700D`), micro-animations halus, dan zero-glitch visual.

---

## 🏛️ 2. Inti Proyek & Arsitektur
- **Repositori:** `mmgufrons/mmgufrons.github.io` (GitHub Pages).
- **URL Publik:** [https://mmgufrons.github.io/](https://mmgufrons.github.io/)
- **Konsep:** **Unified Portfolio Hub** dengan 2 Pilar Utama:
  1. 💼 **Business & AI Operations:**
     - `mkt/`: **Marketing Operations Suite (MKT.OS)** berisi 7 modul (Admin Panel, B2B Partner Board, Mitra Tracker, Campaign Leads Tracker, PPOB Dashboard, MP Report, dan Legal LDMS).
     - `sma/`: **SMA Enterprise Workstation** (Internal ERP, tugas harian, pesan tim).
     - `cekongkir/`: Kalkulator multi-ekspedisi SiCek.
     - `apidocs/`, `lpqris/`, `panduan/`: Modul pendukung kemitraan & SOP.
  2. 🎨 **Creative & Visual Design:**
     - `desain/`: Katalog galeri desain klasik & 12 studi kasus detail (*portfolio-single-\*.html*).

---

## 🔄 3. Perjalanan & Evolusi Penting
1. **Migrasi Serverless (PHP ➔ Static HTML):**
   - Proyek ini awalnya berjalan di lokal LAMP/XAMPP (`.php`).
   - Telah dimigrasikan menjadi file statis interaktif agar dapat di-host langsung di GitHub Pages.
   - **Aturan:** Jangan menambahkan backend PHP aktif atau dependensi server yang memutus akses GitHub Pages. Gunakan `localStorage` dan data dummy interaktif.
2. **Penghapusan Password Barrier:**
   - Dibuat terbuka untuk publik/rekruter tanpa perlu login password.
3. **Engine Bilingual Mandiri (`assets/js/i18n.js`):**
   - Mesin alih bahasa client-side berbasis atribut `data-i18n="key"` tanpa page reload.
   - Memiliki kamus simetris 100% ID ⇄ EN. Jika menambahkan teks baru, selalu daftarkan kuncinya di `assets/js/i18n.js`.
4. **Resolusi Masalah Kontras & Framework Clash:**
   - Halaman MKT menggabungkan Bootstrap 5 dan Tailwind.
   - **PERINGATAN KERAS:** Jangan pernah menggunakan kombinasi class `bg-white text-white` atau utilitas opacity Tailwind di halaman Bootstrap, karena Bootstrap memaksa `background-color: #fff !important` dan `color: #fff !important` yang menyebabkan **teks putih di atas tombol putih**.
   - Gunakan warna solid (`#140927`) atau inline style tegas untuk tombol navigasi.
5. **Navigasi Bersih (Anti-Redundant):**
   - Sidebar MKT hanya memiliki satu tombol kembali ke Portofolio Utama di bagian bawah (tombol hijau emerald `.btn-bottom-porto`).
   - Header atas sidebar khusus untuk branding dan tombol alih bahasa `[ ID | EN ]`.

---

## 📍 4. Posisi Saat Ini & Pedoman Kerja
- **Status Git:** Branch `main` tersinkronisasi langsung dengan GitHub Pages.
- **Workflow:** Perubahan dilakukan di lokal, diuji integritasnya, lalu di-commit dan di-push ke remote.
- **Catatan Tertunda (Backlog):** Penyisiran penyempurnaan copy bilingual (ID ⇄ EN) yang lebih mendalam pada teks-teks submodul spesifik akan dilakukan nanti setelah pengembangan ide baru selesai.

---
*Gunakan panduan ini sebagai pegangan utama saat berkolaborasi membangun fitur atau ide baru.*
