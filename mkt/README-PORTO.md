# MKT (Marketing OS) — Versi Demo Portofolio

Ini adalah **versi demo portofolio** dari SIMASRIM Marketing OS — data dummy, kredensial sudah
diganti placeholder, dan sistem ini **tidak pernah terhubung ke Firebase/server live manapun**.

## Apa yang Didummy-kan

- **Kredensial Firebase asli** (di `includes/firebase.php`, `includes/firebase_transaksi.php`, dan
  beberapa `api_firebase.php`/`firebase_proxy.php` lain) sudah diganti `DUMMY-SECRET-GANTI-SENDIRI`
  dan domain contoh. Semua fungsi `firebase_get()`/`firebase_put()`/dst kini membaca & menulis ke
  file JSON lokal di dalam folder `includes/data/`, `campaign/campaign-tracker/api/data/`,
  `data/ppob/api/data/`, `data/mp-report/api/data/`, `partner/data/`, dan sejenisnya — bukan ke
  server manapun.
- **Login** memakai password demo publik `demo123` (lihat `login.php` di root — file ini baru
  dibuat khusus untuk versi porto, karena login asli di-host terpisah di luar folder ini).
- **Firebase SDK di browser** (modular v9+ dan compat) yang dipakai beberapa halaman
  (`mitra/info.php`, `mitra/tracker.php`, `mitra/sop_canvassing.php`, `tools/legal/*`, dst) diganti
  file mock lokal (`js/firebase-modular-mock.js`) yang menyimpan perubahan ke `localStorage`
  browser — reset otomatis kalau `localStorage` dikosongkan/incognito.
- **Data mitra/campaign/prospek riil** (nomor WA, nama PIC, nama perusahaan mitra, link Google
  Docs/Sheets internal, bahkan kredensial payment gateway & token JWT yang sempat ketemu hardcode)
  sudah **dihapus total**, diganti data fiktif ("PT Contoh Mitra", "08xx-xxxx-xxxx (dummy)", dst).
- File catatan kerja internal murni (`HANDOVER-NOTES.md`, `CAMPAIGN_STATUS.md`, `AGENTS.md`) tidak
  ikut disalin ke porto — isinya konteks delegasi kerja, bukan bagian dari aplikasi.

## Catatan Skill: Internal vs Eksternal

Tools mitra/partnership di project ini (`mitra/`, `partner/`, `pitching/`) **sengaja dibangun dalam
dua versi** di server aslinya:

1. **Versi internal** — dipakai tim (CS/Sales/Marketing) untuk mengelola data mitra, tracker
   onboarding, dan dokumen kerja sama. **Inilah yang di-porto-kan di folder ini.**
2. **Versi eksternal/public-facing** (folder `smsrm/ext` di server asli) — halaman terpisah yang
   dibagikan ke calon mitra, dengan akses & tampilan yang disederhanakan untuk pihak luar, tidak
   membocorkan data mitra lain atau menu-menu internal.

Pemisahan ini sengaja dirancang sebagai bukti kemampuan memisahkan **akses internal vs eksternal**
dari satu sumber data yang sama — bukan sekadar dua halaman berbeda, tapi satu arsitektur data
dengan dua permukaan akses yang levelnya berbeda. Folder `ext` itu sendiri **tidak** ikut disalin ke
porto (di luar cakupan demo ini), tapi konsepnya dicatat di sini sebagai bagian dari showcase skill.

## Login Demo

Semua halaman yang butuh login memakai satu sesi bersama (`login_simasrim`), password: `demo123`.
Beberapa sub-modul (Legal Document Management, Link Manager) punya login terpisah — juga
`demo123`.
