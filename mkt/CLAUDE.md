# mkt

Proyek ini dibuat & dikelola lewat **Proyek Manager** (http://localhost:7777).

## Ringkasan
- Jenis: PHP
- Alamat: http://localhost:8092

## Catatan
- `source/mkt` (di repo `off`) adalah **satu-satunya acuan aktif** untuk project `mkt`. Salinan lama
  (`mkt_old`, `smsrm/mkt`, `smsrm/mkt-26-08-06`) sudah dipindah ke `source/_arsip/` (31 Agustus 2026)
  supaya tidak bikin bingung — jangan dipakai sebagai rujukan, isinya basi.
- `mitra/info.php` membaca data dari Firebase path `b2b_info_mitra_data` (project `simasrim-b2b-os`),
  BUKAN dari file lokal `pitching/mitra/json/info_mitra_data.json` — file JSON itu cuma seed/backup
  statis. Kalau ada teks yang perlu diedit di halaman itu (mis. referensi nama personal), edit-nya
  harus lewat Firebase langsung, bukan cuma file lokal.

Tambahkan konteks proyek di sini (arsitektur, keputusan penting, hal yang perlu diingat Claude) agar sesi berikutnya lebih paham proyek ini.