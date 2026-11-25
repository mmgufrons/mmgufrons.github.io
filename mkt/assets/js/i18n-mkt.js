/* ============================================================
   i18n-mkt.js — penerjemah frasa ID → EN untuk halaman mkt/
   Kenapa frasa, bukan data-i18n: banyak teks dibuat oleh JS saat jalan
   (tabel, kartu, notifikasi). Penerjemah ini mencocokkan teks utuh per
   simpul, ikut mengamati teks yang muncul belakangan (MutationObserver),
   dan mengembalikan teks asli saat bahasa kembali ke ID.
   Muat SETELAH ../assets/js/i18n.js. Nama orang, merek, alamat, kode: dibiarkan.
   ============================================================ */
(function () {
  'use strict';
  const P = {
    'Dokumen & SOP': 'Documents & SOPs',
    'SOP Prompt AI': 'AI Prompt SOP',
    'SOP Active Blueprint': 'Active Blueprint SOP',
    'SOP Komplain & Klaim': 'Complaints & Claims SOP',
    'Pendaftaran EDC': 'EDC Registration',
    'Aktivasi QRIS SoundBox': 'QRIS SoundBox Activation',
    'Pitching Mitra': 'Partner Pitch',
    'Pitching B2B': 'B2B Pitch',
    'Campaign B2B': 'B2B Campaign',
    'Campaign LAZ': 'LAZ Campaign',
    'Contoh Blueprint': 'Sample Blueprint',
    'Instruksi Multi-Kurir': 'Multi-Courier Instructions',
    'SOP Canvassing': 'Canvassing SOP',
    'Dokumen kerja yang saya susun': 'Working documents I wrote',
    'SOP, pitching, dan rencana campaign. Dokumen asli berbahasa Indonesia.': 'SOPs, pitch decks, and campaign plans. The original documents are in Indonesian.',
    'SOP Update Prompt AI Internal': 'Internal AI Prompt Update SOP',
    'SOP Pembuatan Active Blueprint': 'Active Blueprint Creation SOP',
    'Penanganan Komplain & Klaim': 'Complaint & Claim Handling',
    'SOP Akuisisi & Aktivasi EDC KB': 'KB EDC Acquisition & Activation SOP',
    'Alur Proses Aktivasi QRIS SoundBox': 'QRIS SoundBox Activation Flow',
    'Simbiosis Mutualisme Area Terpusat': 'Mutually Beneficial Area Hub',
    'Pilar Akselerasi Bisnis SIMASRIM': 'SIMASRIM Business Acceleration Pillars',
    'Blueprint Campaign B2B Institusional': 'Institutional B2B Campaign Blueprint',
    'Blueprint Campaign LAZ Nasional': 'National LAZ Campaign Blueprint',
    'Campaign Juni - Pekan #2': 'June Campaign - Week #2',
    'Instruksi Kerja (Work Instructions)': 'Work Instructions',
    'SOP Canvassing Mitra Area': 'Area Partner Canvassing SOP',
    'Dari Blast WA ke Kunjungan Langsung': 'From WA Blasts to In-Person Visits',
    'Pintu Masuk': 'Entry',
    '7 Modul Portofolio': '7 Portfolio Modules',
    'Beranda MKT': 'MKT Home',
    'Portofolio Utama': 'Main Portfolio',
    'Portofolio Demo': 'Portfolio Demo',
    // Umum / navigasi
    'Bahasa / Language': 'Language / Bahasa', 'Nama': 'Name', 'Hapus baris': 'Delete row',
    'Admin Only': 'Admin Only', '— PT Solusi Mitra Aplikasi.': '— PT Solusi Mitra Aplikasi.',
    'Marketing OS Hub — Bagian dari Portofolio Digital Maulana Gufron.': 'Marketing OS Hub — Part of Maulana Gufron\'s Digital Portfolio.',
    'Legal Document Management System — Bagian dari Portofolio Digital Maulana Gufron.': 'Legal Document Management System — Part of Maulana Gufron\'s Digital Portfolio.',
    'Data JSON lama terdeteksi!': 'Legacy JSON data detected!',
    'Klik tombol untuk mengembalikan dan memindahkan data lokal ke Firebase.': 'Click the button to restore and move local data to Firebase.',
    'Sinkronisasi ke Firebase': 'Sync to Firebase', 'Tutup': 'Close', 'Simpan': 'Save', 'Batal': 'Cancel',
    'Hapus': 'Delete', 'Tambah': 'Add', 'Aktif': 'Active', 'Nonaktif': 'Inactive', 'Kembali': 'Back',
    'Lanjutkan': 'Continue', 'Terapkan': 'Apply', 'Aksi': 'Actions', 'Keterangan': 'Description',
    'Berhasil disimpan.': 'Saved successfully.', 'Memproses...': 'Processing...', 'Memproses file...': 'Processing file...',
    'Navigasi': 'Navigation', 'Detail': 'Details', 'Aset': 'Assets', 'Jabatan': 'Position', 'Kota': 'City',
    'Kota...': 'City...', 'Brand...': 'Brand...', 'Pilih semua': 'Select all', 'Pilih Semua': 'Select All',
    'Kosongkan pilihan': 'Clear selection', 'Buka': 'Open', 'Lewati': 'Skip', 'Hentikan': 'Stop',
    'Simpan Perubahan': 'Save Changes', 'Refresh Data': 'Refresh Data',

    // Mitra / Tracker
    'MXG-2 (Belum kerjasama)': 'MXG-2 (Not yet partnered)', 'Area Demo Selatan': 'Demo Area South',
    'Area Demo Utara': 'Demo Area North', 'Area Demo Timur': 'Demo Area East', 'Aktivasi': 'Activation',
    '1. Presentasi Web Mitra': '1. Partner Web Presentation', '2. Pembuatan Grup WA': '2. WA Group Setup',
    '3-5. PROSES LEGALITAS (Paralel)': '3-5. LEGAL PROCESS (Parallel)',
    '3a. Kirim Draft Dokumen + Minta Data Verifikasi': '3a. Send Draft Documents + Request Verification Data',
    'Paralel': 'Parallel', '3b. Proses Review / Revisi (jika ada)': '3b. Review / Revision (if any)',
    '3c. Final: NDA ✔': '3c. Final: NDA ✔', '4c. Final: Surat Penunjukan ✔': '4c. Final: Appointment Letter ✔',
    '5c. Final: Adendum Skema ✔': '5c. Final: Scheme Addendum ✔', '6a. Minta Data Akun Utama': '6a. Request Main Account Data',
    '6b. Akun Utama Dibuat ✔': '6b. Main Account Created ✔', '7. Dashboard Rekonsiliasi (Looker) ✔': '7. Reconciliation Dashboard (Looker) ✔',
    '8. DISTRIBUSI AMUNISI MARKETING': '8. MARKETING KIT DISTRIBUTION', '1.A. Data Campaign by Brand': '1.A. Campaign Data by Brand',
    '1.B. Data Campaign by Area': '1.B. Campaign Data by Area', '2. Panduan Dasar + Monthly Plan': '2. Basic Guide + Monthly Plan',
    '3. Flyer (A4 Siap Cetak)': '3. Flyer (Print-ready A4)', '4. Template Story (9:16)': '4. Story Template (9:16)',
    '5. Materi Presentasi (PLG)': '5. Presentation Deck (PLG)', '6. SOP Juklak Sosmed': '6. Social Media SOP',
    '7. Penawaran Banner / X-Banner': '7. Banner / X-Banner Offer', '9. Monthly Strategy Plan (dalam Panduan Dasar)': '9. Monthly Strategy Plan (in Basic Guide)',
    '10. Operasional Berjalan ✔': '10. Operations Running ✔', 'Gabung & Kirim WA': 'Combine & Send WA',
    'Kelola Database Aset': 'Manage Asset Database', 'Kelola Database Aset:': 'Manage Asset Database:',
    'Tambah Aset / Link Baru': 'Add New Asset / Link', 'Daftar Aset Tersimpan': 'Saved Assets',
    'Kelola Link Referral Area': 'Manage Area Referral Links', 'Tambah Link Referral Baru': 'Add New Referral Link',
    'Daftar Link Saat Ini': 'Current Links', '— Pilih item yang akan dikirim sekaligus': '— Pick the items to send together',
    'Centang': 'Tick', 'item yang mau dikirim bersamaan → Preview pesan gabungan akan muncul di bawah → Salin & kirim ke grup WA mitra.': 'the items to send together → a combined message preview appears below → copy & send it to the partner WA group.',
    'PREVIEW PESAN WA GABUNGAN': 'COMBINED WA MESSAGE PREVIEW', 'Salin Pesan': 'Copy Message', 'Buka WA': 'Open WA',
    'Sistem Pemantauan Progres Aktivasi Master Mitra Area secara Real-Time.': 'Real-time activation progress monitoring for Master Area Partners.',
    'Edit Nama': 'Edit Name', 'Hapus Mitra': 'Delete Partner', 'Catatan status/PIC...': 'Status/PIC notes...',
    'Buka Dokumen/Link': 'Open Document/Link', 'Kirim Follow Up WA': 'Send WA Follow-up',
    'Nama Dokumen (Contoh: Surat NDA)': 'Document name (e.g. NDA Letter)', 'Label (Mis: JKT)': 'Label (e.g. JKT)',
    'https://link-dokumen...': 'https://document-link...',

    // Partner B2B
    'Pantau progress akuisisi klien B2B (Inbound & Outbound) secara Real-Time.': 'Track B2B client acquisition progress (Inbound & Outbound) in real time.',
    'Semua Kategori': 'All Categories', 'Ekonomi Pemberdayaan': 'Empowerment Economy', 'Integrasi API': 'API Integration',
    'Ritel & Logistik': 'Retail & Logistics', 'APLIKASI/PLATFORM': 'APP/PLATFORM', 'Aplikasi Mitra Digital (DEMO)': 'Digital Partner App (DEMO)',
    'PROGRESS AKUISISI': 'ACQUISITION PROGRESS', 'Fase 1: Kualifikasi (Profiling)': 'Phase 1: Qualification (Profiling)',
    'Fase 2: Pitching & Edukasi': 'Phase 2: Pitching & Education', 'Fase 3: Legalitas & Pricing': 'Phase 3: Legal & Pricing',
    'Fase 4: Go-Live Sistem': 'Phase 4: System Go-Live', 'RITEL': 'RETAIL', 'Toko Elektronik Makmur Jaya (DEMO)': 'Makmur Jaya Electronics Store (DEMO)',
    'LEMBAGA SOSIAL': 'SOCIAL INSTITUTION', 'Yayasan Amal Contoh (DEMO)': 'Sample Charity Foundation (DEMO)',
    'KOPERASI': 'COOPERATIVE', 'Koperasi Sejahtera Bersama (DEMO)': 'Sejahtera Bersama Cooperative (DEMO)',
    'Nama Tipe Jalur (Bebas)': 'Channel Type Name (Free text)', 'Kelola Kontak PIC:': 'Manage PIC Contacts:',
    'Tambah Kontak Baru': 'Add New Contact', 'Daftar Kontak Tersimpan': 'Saved Contacts', 'Catatan Detail:': 'Detailed Notes:',
    'Untuk konteks bisnis, SOP, model kerja sama, atau catatan panjang lain (bukan link dokumen — link dokumen taruh di "Kelola Database Aset"). Mendukung baris baru biasa.': 'For business context, SOPs, partnership models or other long notes (not document links — put those in "Manage Asset Database"). Line breaks are supported.',
    'Geser ke Atas': 'Move Up', 'Geser ke Bawah': 'Move Down', 'Edit Data': 'Edit Data', 'Hapus Data': 'Delete Data',
    'Catatan cepat operasional...': 'Quick operational note...', 'Follow Up via WA': 'Follow Up via WA',
    'Contoh: PT Solusi Retail / Koperasi Makmur': 'e.g. PT Solusi Retail / Koperasi Makmur', 'Contoh: Kemitraan Sponsorship': 'e.g. Sponsorship Partnership',
    'Contoh: Logistik, Payment, Asuransi, Pak Enang...': 'e.g. Logistics, Payment, Insurance, Mr. Enang...',
    'Contoh: Target selesai bulan depan...': 'e.g. Target done next month...', 'Nama Dokumen (Contoh: SPK)': 'Document name (e.g. Work Order)',
    'Tulis catatan detail di sini...': 'Write detailed notes here...',

    // Legal
    'Surat Penunjukan': 'Appointment Letter', 'Adendum': 'Addendum', 'Akta Pendirian': 'Deed of Establishment',
    'Akta Perubahan Terakhir': 'Latest Deed of Amendment', 'PT Contoh Mitra Sejahtera': 'PT Contoh Mitra Sejahtera',
    'Contoh Brand A': 'Sample Brand A', 'Contoh Brand B': 'Sample Brand B', 'Contoh Brand C': 'Sample Brand C',
    'Koperasi Contoh Makmur': 'Koperasi Contoh Makmur', 'Kategori Dokumen': 'Document Category', 'Kerjasama Mitra': 'Partner Agreements',
    'Dokumen Internal Perusahaan': 'Internal Company Documents', 'Jenis Dokumen': 'Document Type', 'Brand / Kategori': 'Brand / Category',
    'Nomor Surat (Internal)': 'Letter Number (Internal)', 'Nomor Surat (Mitra)': 'Letter Number (Partner)',
    'Opsional (Wajib jika Jenis Dokumen adalah PKS).': 'Optional (required if the Document Type is a Partnership Agreement).',
    'Nama Mitra / Perusahaan': 'Partner / Company Name', 'Tanggal Mulai / Terbit': 'Start / Issue Date', 'Tanggal Berakhir': 'End Date',
    'Tidak ada masa berlaku (permanen)': 'No expiry (permanent)', 'Arah Dokumen': 'Document Direction', 'Pilih arah...': 'Choose direction...',
    'Inbound (Masuk)': 'Inbound', 'Outbound (Keluar)': 'Outbound', 'Status Saat Ini': 'Current Status', 'Pilih status...': 'Choose status...',
    'No. WhatsApp PIC Mitra': 'Partner PIC WhatsApp No.', 'Link Google Drive Dokumen': 'Document Google Drive Link', 'Simpan Dokumen': 'Save Document',
    'Cari mitra atau nomor...': 'Search partner or number...', 'Semua Brand...': 'All Brands...', 'Edit Dokumen': 'Edit Document',
    'Follow Up WA PIC': 'Follow Up PIC via WA', 'Pilih atau ketik jenis...': 'Choose or type a type...', 'Pilih atau ketik brand...': 'Choose or type a brand...',
    'Contoh: 019/SMA-PKS/VII/2026': 'e.g. 019/SMA-PKS/VII/2026', 'Masukkan jika ada...': 'Enter if any...',
    'Nama entitas perusahaan mitra...': 'Partner company legal name...', 'Contoh: 628123456789': 'e.g. 628123456789',

    // Kirim WA
    'Kirim WA': 'Send WA', 'Kirim pesan personal ke banyak nomor dari daftar Excel': 'Send personal messages to many numbers from an Excel list',
    '✓ tersimpan otomatis': '✓ saved automatically', 'Daftar Kontak': 'Contact List', 'Tulis Pesan': 'Write Message', 'Kirim': 'Send',
    '💾 Data offline (JSON)': '💾 Offline data (JSON)',
    'Kumpulan kontak, grup, dan template kamu bisa juga disimpan sebagai satu file JSON di komputer kamu — file itu bisa dibuka & diedit langsung pakai teks editor biasa, lalu dimuat lagi ke halaman ini kapan saja (misal untuk pindah ke komputer lain).': 'Your contacts, groups and templates can also be saved as one JSON file on your computer — open & edit it in any text editor, then load it back here any time (e.g. to move to another computer).',
    '⬇ Unduh data sebagai JSON': '⬇ Download data as JSON', '⬆ Muat data dari file JSON': '⬆ Load data from a JSON file',
    'Lihat format JSON (untuk edit manual)': 'View JSON format (for manual editing)', '📄 Unggah File': '📄 Upload File', '✍️ Input Manual': '✍️ Manual Input',
    'Unggah file Excel': 'Upload an Excel file',
    'File berisi kolom nomor WhatsApp dan nama (boleh ada kolom lain untuk personalisasi pesan, misalnya Produk atau Kota). Format .xlsx, .xls, atau .csv.': 'The file contains WhatsApp number and name columns (other columns for personalisation, e.g. Product or City, are fine). Format .xlsx, .xls or .csv.',
    'Klik untuk pilih file, atau seret ke sini': 'Click to choose a file, or drag it here', 'Baris pertama akan dianggap sebagai judul kolom': 'The first row is treated as column headers',
    'Cocokkan kolom': 'Match columns', 'Beri tahu mana kolom nomor WA dan nama kontak. Kolom lainnya bisa dipakai sebagai isian personalisasi pesan.': 'Tell us which columns hold the WA number and contact name. Other columns can be used to personalise the message.',
    'Kolom Nomor WhatsApp': 'WhatsApp Number Column', 'Kolom Nama': 'Name Column', 'Simpan daftar ini': 'Save this list',
    'Tambah kontak satu per satu': 'Add contacts one by one', 'Kontak yang kamu tambahkan di sini langsung masuk ke': 'Contacts you add here go straight into your',
    'kumpulan kontak': 'contact pool', 'kamu — tidak perlu dimasukkan ke grup/daftar tertentu dulu. Grup bisa kamu buat belakangan dengan memilih kontak dari kumpulan ini.': '— no need to put them in a group first. You can create groups later by picking contacts from this pool.',
    'Kolom tambahan (opsional, berlaku untuk semua kontak di kumpulan)': 'Extra columns (optional, applies to every contact in the pool)', 'Terapkan kolom': 'Apply columns',
    'Nama kontak': 'Contact name', 'Nomor WhatsApp': 'WhatsApp number', '+ Tambah ke kumpulan kontak': '+ Add to contact pool', 'Kumpulan kontak': 'Contact pool',
    'Semua kontak yang kamu tambahkan manual ada di sini, di luar grup manapun. Centang beberapa atau semuanya, beri nama grup, lalu buat grup baru untuk dipakai mengirim pesan di tab Kirim.': 'Every contact you add manually lives here, outside any group. Tick some or all, name a group, then create it to use in the Send tab.',
    'Belum ada kontak di kumpulan. Tambahkan lewat form di atas.': 'No contacts in the pool yet. Add some with the form above.', 'Buat grup dari kontak terpilih': 'Create group from selected contacts',
    'Daftar kontak tersimpan': 'Saved contact lists', 'Daftar ini tersimpan di browser kamu dan bisa dipakai lagi kapan saja dengan pesan yang berbeda.': 'These lists are stored in your browser and can be reused any time with a different message.',
    'Belum ada daftar kontak tersimpan. Unggah file Excel di atas untuk mulai.': 'No saved contact lists yet. Upload an Excel file above to start.', 'Tulis pesan': 'Write message',
    'Gunakan placeholder untuk personalisasi otomatis per kontak.': 'Use placeholders to personalise each contact automatically.', 'Pilih atau unggah daftar kontak dulu di tab': 'Pick or upload a contact list first in the',
    'supaya placeholder-nya muncul di sini.': 'tab so its placeholders appear here.', 'Isi pesan': 'Message',
    'Pesan di atas langsung bisa dipakai di tab Kirim, tanpa harus disimpan sebagai template. Simpan sebagai template hanya kalau kamu mau memakainya lagi lain kali.': 'The message above is ready to use in the Send tab without saving it as a template. Save a template only if you want to reuse it later.',
    'Simpan sebagai template (opsional)': 'Save as template (optional)', 'Lampiran (opsional)': 'Attachment (optional)',
    'Tambahkan gambar, dokumen, audio, atau video untuk dikirim bersama pesan. WhatsApp tidak mengizinkan lampiran ditempel otomatis lewat link, jadi lampiran ini akan disiapkan untuk kamu unduh dan seret ke chat saat mengirim — lihat detailnya di tab Kirim.': 'Add an image, document, audio or video to send with the message. WhatsApp does not allow attachments via links, so it will be prepared for you to download and drag into the chat when sending — see the Send tab.',
    'Gambar, video, audio, atau dokumen — maksimal sekitar 3.5MB agar bisa tersimpan': 'Image, video, audio or document — up to about 3.5MB so it can be stored',
    'Template tersimpan': 'Saved templates', 'Belum ada template pesan tersimpan.': 'No saved message templates yet.', 'Kirim ke': 'Send to',
    'dan login (scan QR) sekali di tab terpisah, biarkan tetap terbuka. Setelah itu, setiap kontak yang kamu kirim dari sini akan': 'and log in (scan the QR) once in a separate tab and keep it open. After that, every contact you send to from here will',
    'memakai tab WhatsApp Web yang sama': 'reuse the same WhatsApp Web tab', '— chat-nya berganti otomatis, tanpa membuka tab baru terus-menerus.': '— the chat switches automatically, without opening new tabs.',
    '📎 Ada lampiran di pesan ini. WhatsApp tidak bisa menerima file lewat link secara otomatis —': '📎 This message has an attachment. WhatsApp cannot receive files via links automatically —',
    'unduh file di bawah lalu seret (drag & drop) ke kotak chat WhatsApp': 'download the file below and drag & drop it into the WhatsApp chat', 'setelah teks pesan terbuka, sebelum menekan kirim.': 'after the message text opens, before pressing send.',
    '🔁 Kirim otomatis, satu tab': '🔁 Auto send, one tab',
    'Klik mulai. Tiap beberapa detik, tab WhatsApp Web yang sama otomatis pindah ke chat kontak berikutnya dengan pesan sudah terisi. Kamu tinggal duduk di tab WhatsApp dan tekan Enter tiap kali chat berganti.': 'Click start. Every few seconds the same WhatsApp Web tab moves to the next contact with the message filled in. Just stay on the WhatsApp tab and press Enter each time the chat changes.',
    'Jeda antar kontak:': 'Delay between contacts:', '4 detik': '4 seconds', '6 detik': '6 seconds', '10 detik': '10 seconds', '15 detik': '15 seconds',
    'Mulai Kirim Otomatis': 'Start Auto Send', '➡️ Mode berurutan (manual)': '➡️ Step-by-step mode (manual)',
    'Satu kontak ditampilkan bergantian. Klik "Kirim & Lanjut" saat kamu siap — chat tetap terbuka di tab WhatsApp Web yang sama, tidak berpindah tab baru.': 'One contact is shown at a time. Click "Send & Next" when ready — the chat stays in the same WhatsApp Web tab.',
    'Mulai Mode Berurutan': 'Start Step-by-step Mode', 'Pastikan tab': 'Make sure the',
    'sudah terbuka dan sudah login sebelum mulai. Kalau muncul peringatan "pop-up diblokir" saat pertama kali, klik ikon di address bar dan pilih': 'tab is open and logged in before starting. If a "pop-up blocked" warning appears the first time, click the icon in the address bar and choose',
    'izinkan pop-up': 'allow pop-ups', 'untuk situs ini.': 'for this site.', 'Nama Kontak': 'Contact Name', 'Pratinjau pesan…': 'Message preview…',
    'Kirim & Lanjut →': 'Send & Next →',
    'Hanya kontak yang dicentang yang akan dikirimi pesan — baik lewat Kirim Otomatis, Mode Berurutan, maupun tombol Kirim satuan di bawah. Tidak perlu mengirim ke seluruh daftar.': 'Only ticked contacts receive the message — via Auto Send, Step-by-step Mode or the single Send buttons below. You don\'t have to send to the whole list.',
    'Kontak & grup tersimpan di browser ini saja. Template pesan tersinkron ke server SIMASRIM, bisa dipakai bersama anggota tim lain.': 'Contacts & groups are stored in this browser only. Message templates sync to the SIMASRIM server and can be shared with teammates.',
    'Kontak & grup tersimpan di browser ini (localStorage). Template pesan tersinkron ke server, bisa dipakai anggota tim lain juga.': 'Contacts & groups are stored in this browser (localStorage). Message templates sync to the server and can be shared with teammates.',
    'Nama daftar, contoh: Pelanggan Juli': 'List name, e.g. July Customers', 'Contoh: Produk, Kota (pisahkan koma)': 'e.g. Product, City (comma-separated)',
    'Contoh: Budi Santoso': 'e.g. Budi Santoso', 'Contoh: 0812xxxxxxx': 'e.g. 0812xxxxxxx', 'Nama grup, contoh: Pelanggan Juli': 'Group name, e.g. July Customers',
    'Contoh: Halo {{Nama}}, terima kasih sudah belanja di toko kami. Pesanan {{Produk}} kamu sedang diproses ya!': 'e.g. Hi {{Nama}}, thanks for shopping with us. Your {{Produk}} order is being processed!',
    'Nama template, contoh: Konfirmasi Pesanan': 'Template name, e.g. Order Confirmation', 'Cari nama atau nomor…': 'Search name or number…',

    // PPOB
    'Semua Waktu': 'All Time', '7 Hari Terakhir': 'Last 7 Days', '30 Hari Terakhir': 'Last 30 Days', '90 Hari Terakhir': 'Last 90 Days',
    'Database Terhubung': 'Database Connected', 'Semua Segmen': 'All Segments', 'GAGAL': 'FAILED', 'NAMA USER': 'USER NAME',
    'KATEGORI USER': 'USER CATEGORY', 'KODE TRANSAKSI': 'TRANSACTION CODE', 'TANGGAL BELI': 'PURCHASE DATE', 'KATEGORI': 'CATEGORY',
    'NAMA PRODUK': 'PRODUCT NAME', 'TAGIHAN USER': 'USER BILL', 'BAYAR MITRA': 'PARTNER PAYMENT', '💡 Rumus Profit SIMASRIM:': '💡 SIMASRIM Profit Formula:',
    'PROFIT = (TAGIHAN USER − CASHBACK USER) − BAYAR MITRA': 'PROFIT = (USER BILL − USER CASHBACK) − PARTNER PAYMENT', 'EKSPEDISI': 'COURIER',
    'Nama User': 'User Name', 'Filter Periode': 'Period Filter', 'Refresh dari Firebase': 'Refresh from Firebase',
    '🔍 Cari nama atau email...': '🔍 Search name or email...', '🔍 Cari kode/produk/email...': '🔍 Search code/product/email...',

    // MP Report
    'Kabel Charging USB-C': 'USB-C Charging Cable', 'Riwayat Mutasi Saldo (Shopee Bobcare)': 'Balance History (Shopee Bobcare)',
    'Tanggal Transaksi': 'Transaction Date', 'Penarikan komisi ke rekening (demo)': 'Commission withdrawal to bank (demo)',
    'Setor saldo tambahan (demo)': 'Extra balance top-up (demo)', 'Komisi penjualan masuk (demo)': 'Sales commission received (demo)',
    'Edit Data Penjualan': 'Edit Sales Data', 'Ubah rincian pesanan secara langsung.': 'Edit order details directly.', 'Tanggal Order': 'Order Date',
    'Nama Produk': 'Product Name', 'Harga Jual (Rp)': 'Selling Price (Rp)', 'Biaya Admin (Rp)': 'Admin Fee (Rp)', 'Pendapatan Bersih (Rp)': 'Net Income (Rp)',
    'Edit Data Mutasi': 'Edit Balance Entry', 'Ubah rincian riwayat mutasi saldo.': 'Edit balance history details.', 'Peringatan Data Duplikat': 'Duplicate Data Warning',
    'Terdapat data yang sudah ada di database dari file Excel ini.': 'Some data in this Excel file already exists in the database.', 'Ada': 'There are',
    'pesanan yang duplikat / sudah ada.': 'duplicate / existing orders.', 'Timpa data lama dengan yang baru, atau tetap gunakan data lama?': 'Overwrite the old data with the new, or keep the old data?',
    'Gunakan Data Lama': 'Keep Old Data', 'Timpa Data (Update)': 'Overwrite (Update)', 'Dari Tanggal': 'From Date', 'Sampai Tanggal': 'To Date',
    'Cari Produk...': 'Search Product...', 'Edit Pesanan': 'Edit Order', 'Edit Mutasi': 'Edit Entry',

    // Campaign Tracker — filter & dashboard
    'Semua Brand': 'All Brands', 'Koperasi': 'Cooperative', 'Semua Produk': 'All Products', 'Semua Area Utama': 'All Main Areas',
    'Semua Sub Area': 'All Sub Areas', 'Semua PIC': 'All PICs', 'Siap closing': 'Ready to close', 'Sedang dijajaki': 'Being explored',
    'Tidak merespon': 'No response', 'Menunggu follow-up': 'Awaiting follow-up', 'Tahap 1+': 'Stage 1+',
    'Hot/Warm, belum closing, >=3 hari tanpa update': 'Hot/Warm, not closed, >=3 days without update', 'Leads di-update hari ini': 'Leads updated today',
    'Distribusi Tipe Leads per Brand': 'Lead Type Distribution per Brand', 'Hot / Warm / Cold per Brand': 'Hot / Warm / Cold per Brand',
    'Komposisi keseluruhan': 'Overall composition', 'Progress per PIC Garap': 'Progress per Handling PIC', 'Jumlah leads per eksekutor': 'Leads per executor',
    'Distribusi per Area': 'Distribution per Area', 'Top 8 kota/area': 'Top 8 cities/areas', 'Tahap Campaign': 'Campaign Stage',
    'Progress per tahapan pesan': 'Progress per message stage', 'Funnel Tahap Campaign': 'Campaign Stage Funnel',
    'Berapa leads yang bertahan sampai tahap tertentu': 'How many leads reach each stage', '🔔 Perlu Follow-Up': '🔔 Needs Follow-Up',
    'Leads Hot/Warm yang butuh perhatian — klik baris utk langsung edit': 'Hot/Warm leads needing attention — click a row to edit',
    '🔴 Wajib FU': '🔴 Must Follow Up', '🏆 Leaderboard PIC Garap': '🏆 Handling PIC Leaderboard', 'Ranking closing terbanyak': 'Ranked by most closings',
    '(Kosong / belum diisi)': '(Empty / not filled)', 'Semua Tipe': 'All Types', 'Semua Tahap': 'All Stages', 'PESAN 1': 'MESSAGE 1',
    'PESAN 2': 'MESSAGE 2', 'PESAN 3': 'MESSAGE 3', 'baris dipilih': 'rows selected', 'Edit massal:': 'Bulk edit:', 'Area Utama:': 'Main Area:',
    'Produk:': 'Product:', 'PIC Garap:': 'Handling PIC:', 'Nomor WA CS Dipakai:': 'CS WA Number Used:', 'Aksi Lanjutan:': 'Next Action:',
    '+ Tgl Kirim:': '+ Send Date:', 'Tahap:': 'Stage:', 'Pilih tahap...': 'Choose stage...', 'Tipe:': 'Type:', 'Pilih tipe...': 'Choose type...',
    'Copy Kontak': 'Copy Contacts', 'Pilih Semua Hasil Filter': 'Select All Filtered', 'Copy Kontak (Terfilter)': 'Copy Contacts (Filtered)',
    'Cari & Ganti Massal': 'Bulk Find & Replace', 'Produk': 'Product', 'Nama Agen/Toko': 'Agent/Store Name', 'Nomor WA': 'WA Number',
    'Area Utama': 'Main Area', 'Alamat': 'Address', 'PIC Garap': 'Handling PIC', 'Nomor WA CS Dipakai': 'CS WA Number Used', 'Tahap': 'Stage',
    'Tgl Kirim': 'Send Date', 'Respon': 'Response', 'Aksi Lanjutan': 'Next Action', 'Tipe Leads': 'Lead Type',
    // Contoh respon demo
    'Mau info lebih lanjut': 'Wants more info', 'Kirim brosur': 'Send brochure', 'Sudah punya toko': 'Already has a store',
    'Daftar sekarang, mau gabung': 'Signing up now, wants to join', 'Proses pendaftaran': 'Process registration', 'Tidak tertarik': 'Not interested',
    'Sudah mitra kompetitor': 'Already a competitor\'s partner', 'Gimana cara daftarnya?': 'How do I sign up?', 'Jelaskan prosedur': 'Explain the procedure',
    'Iya siap gabung bulan depan': 'Yes, ready to join next month', 'Reminder H-7': 'Reminder D-7', 'Deal verbal': 'Verbal deal', 'Blokir aja': 'Just block',
    'Brosurnya dikirim ke sini ya': 'Please send the brochure here', 'Kirim email brosur': 'Email the brochure', 'Punya 3 cabang': 'Has 3 branches',
    'Apa itu program SIMASRIM?': 'What is the SIMASRIM program?', 'Kirim penjelasan': 'Send an explanation', 'Mau daftar, hubungi besok ya': 'Wants to sign up, call tomorrow',
    'Call besok jam 10': 'Call tomorrow at 10', 'Owner langsung': 'Owner directly', 'Deal! Transfer sekarang': 'Deal! Transferring now',
    'Konfirmasi admin': 'Admin confirmation', 'Closing berhasil': 'Closed successfully', 'Bisa dijelasin keuntungannya?': 'Can you explain the benefits?',
    'Tertarik tapi minta demo': 'Interested but wants a demo', 'Oke, mau coba dulu': 'OK, wants to try first', 'Tolak aja': 'Just decline',
    'Gimana cara bayarnya?': 'How do I pay?', 'Jelaskan metode pembayaran': 'Explain payment methods', 'Harga promo berapa?': 'What is the promo price?',
    'Kirim penawaran': 'Send an offer', 'Siap gabung, langsung proses': 'Ready to join, process now', 'Admin processing': 'Admin processing',
    'Referral dari mitra lain': 'Referred by another partner',
    // Upload wizard
    'Segmentasi Data': 'Data Segmentation', 'Isi informasi kampanye sebelum upload': 'Fill in campaign info before uploading', 'Jenis Upload:': 'Upload Type:',
    'Upload Data Segar': 'Upload Fresh Data', '1 file = 1 kombinasi Area/Brand/PIC (hasil scraping/list baru)': '1 file = 1 Area/Brand/PIC combination (new scrape/list)',
    'Migrasi Data Lama': 'Migrate Legacy Data', 'File Excel banyak sheet, Area/Brand beda-beda per sheet/baris': 'Multi-sheet Excel file, Area/Brand differs per sheet/row',
    'Sub Area / Kota': 'Sub Area / City', '(Provinsi, opsional)': '(Province, optional)', '(opsional, bisa diisi nanti)': '(optional, can be filled later)', '(opsional)': '(optional)',
    'Area & Brand/Kategori otomatis dideteksi per sheet (dari kolom Brand kalau ada, atau nama sheet) — akan ditampilkan untuk direview di langkah berikutnya sebelum diproses. Brand yang tidak cocok salah satu kategori resmi masuk antrean review manual, tidak otomatis dibuat baru. PIC Campaign/PIC Garap/Produk/Provinsi di atas berlaku sebagai default untuk SEMUA sheet dalam file ini.': 'Area & Brand/Category are detected per sheet (from the Brand column if present, or the sheet name) and shown for review in the next step before processing. Brands that match no official category go to a manual review queue and are never created automatically. Campaign PIC/Handling PIC/Product/Province above are the default for ALL sheets in this file.',
    'Tipe Data yang Diupload:': 'Data Type to Upload:', 'Data WhatsApp': 'WhatsApp Data', 'Ekstrak nomor 08.../+62...': 'Extract numbers 08.../+62...',
    'Data Email': 'Email Data', 'Ekstrak format *@*.*': 'Extract *@*.* format', 'Lanjut ke Upload': 'Continue to Upload', 'Upload File Data Mentah': 'Upload Raw Data File',
    'Format bebas — kolom acak hasil scraping Google Maps / Website diterima': 'Any format — random columns from Google Maps / website scrapes accepted',
    'Klik atau Drag & Drop File': 'Click or Drag & Drop a File', 'Format: .xlsx, .xls, atau .csv · Kolom bebas/acak tidak masalah': 'Format: .xlsx, .xls or .csv · Free/random columns are fine',
    'Kolom Acak OK': 'Random Columns OK', 'Nama Toko/Agen': 'Store/Agent Name', 'Alamat/Kota': 'Address/City', 'Nomor WA / Email': 'WA Number / Email',
    'Proses & Analisis': 'Process & Analyse', 'Pilih Sheet yang Dimigrasikan': 'Choose Sheets to Migrate',
    'Sheet yang kelihatan seperti daftar leads otomatis tercentang — cek lagi sebelum lanjut, dan sesuaikan Brand/Area default kalau perlu': 'Sheets that look like lead lists are ticked automatically — double-check before continuing and adjust the default Brand/Area if needed',
    'Proses Sheet Terpilih': 'Process Selected Sheets', 'Review Brand Tidak Dikenali': 'Review Unrecognised Brands',
    'Nilai Brand ini tidak cocok kategori resmi manapun — pilih pemetaannya secara manual, tidak dibuat kategori baru otomatis': 'These Brand values match no official category — map them manually; no new category is created automatically',
    'Terapkan & Lanjut': 'Apply & Continue', 'Preview Hasil Cleansing': 'Cleansing Result Preview', 'Review data sebelum commit ke Firebase': 'Review data before committing to Firebase',
    'Skip Semua Duplikat (default)': 'Skip All Duplicates (default)', 'Timpa Semua': 'Overwrite All', 'Preview 10 baris pertama data bersih:': 'Preview of the first 10 clean rows:',
    'Mengunggah ke Firebase...': 'Uploading to Firebase...', 'Commit ke Firebase': 'Commit to Firebase', 'Coba dengan Data Demo': 'Try with Demo Data',
    'Muat data contoh leads untuk melihat semua fitur CRM bekerja secara langsung.': 'Load sample leads to see every CRM feature working live.', 'Muat Demo': 'Load Demo',
    '✅ Kontak Aktif Saat Ini': '✅ Current Active Contacts', '💾 Simpan sebagai Grup Permanen': '💾 Save as Permanent Group',
    // Cari leads
    'Cari Leads B2B Baru Otomatis': 'Find New B2B Leads Automatically',
    'Cari target apapun dari Google Maps (Masjid, DKM, Koperasi, Yayasan, dll), hasilnya bisa direview sebelum masuk Master Leads': 'Search any target on Google Maps (mosques, cooperatives, foundations, etc.); review the results before they enter Master Leads',
    'Kata Kunci': 'Keyword', 'Kota / Wilayah': 'City / Region', '(Provinsi)': '(Province)', 'Mulai Cari Leads': 'Start Lead Search',
    'Scroll sampai mentok, biasanya hitungan detik · hasil muncul langsung selagi diproses': 'Scrolls to the end, usually seconds · results appear while processing',
    'Menyiapkan...': 'Preparing...', 'Batalkan Pencarian': 'Cancel Search',
    'Nomor telepon tidak selalu tampil di hasil pencarian cepat ini. Baris yang belum ada nomornya bisa dicek satu-satu lewat tombol': 'Phone numbers don\'t always appear in this quick search. Rows without a number can be checked one by one with the',
    '"Cek Nomor"': '"Check Number"', ', atau centang beberapa lalu klik': 'button, or tick several and click', '"Verifikasi Nomor yang Dicentang"': '"Verify Ticked Numbers"',
    'di toolbar tabel.': 'in the table toolbar.', '📋 Review Hasil Pencarian': '📋 Review Search Results', 'Verifikasi Nomor yang Dicentang': 'Verify Ticked Numbers',
    'Import ke Master Leads': 'Import to Master Leads', 'Buang yang Dicentang': 'Discard Ticked',
    // Modal & form
    'Konfirmasi Hapus': 'Confirm Delete', 'Tindakan ini tidak bisa dibatalkan': 'This action cannot be undone',
    'Data yang dihapus dari Firebase tidak dapat dipulihkan.': 'Data deleted from Firebase cannot be recovered.', 'Ya, Hapus': 'Yes, Delete',
    'Tambah Lead Manual': 'Add Lead Manually', 'Data akan langsung disinkronisasi ke Firebase': 'Data will sync to Firebase immediately', 'Tipe Lead': 'Lead Type',
    'Email (opsional)': 'Email (optional)', 'Nomor WA CS yang Dipakai': 'CS WA Number Used', '(Kota/Kab)': '(City/Regency)', 'Simpan Lead': 'Save Lead',
    'Ubah data lengkap satu baris ini': 'Edit the full data of this row', 'Kontak Aktif Dipakai': 'Active Contact Used', '– Belum ada –': '– None yet –',
    'Tanggal Kirim tetap dikelola lewat klik langsung di kolom tabel (bisa tambah lebih dari satu tanggal).': 'Send Dates are still managed by clicking the table column (more than one date allowed).',
    'Kemungkinan Lead yang Sama Ditemukan': 'Possible Duplicate Lead Found',
    'Nama & area cocok persis dengan lead yang sudah ada di tree satunya (WA/Email) — mau digabung jadi 1 kontak WA+Email, atau tetap dibuat lead terpisah?': 'Name & area exactly match an existing lead in the other list (WA/Email) — merge into one WA+Email contact, or keep a separate lead?',
    'Export untuk Handover Mitra Area': 'Export for Area Partner Handover',
    'Pilih satu Area Utama — leads di area itu langsung diexport CSV untuk diserahkan ke Mitra Area yang mengelola wilayah tersebut.': 'Choose one Main Area — its leads are exported to CSV for the Area Partner managing that region.',
    'Area Utama (Provinsi)': 'Main Area (Province)', 'Hanya tahap CLOSING (rekomendasi — sudah siap dilanjutkan mitra)': 'CLOSING stage only (recommended — ready for the partner)',
    'Ubah nilai 1 field untuk SEMUA leads yang cocok sekaligus — tidak perlu centang satu-satu atau ganti halaman.': 'Change one field for ALL matching leads at once — no ticking or paging needed.',
    'Sub Area (Kota/Kab)': 'Sub Area (City/Regency)', 'Dari nilai': 'From value', 'Ke nilai': 'To value', 'Export data hasil filter ini ke CSV': 'Export the filtered data to CSV',
    '🔍 Cari...': '🔍 Search...', 'Ketik brand...': 'Type a brand...', 'Ketik provinsi...': 'Type a province...', 'Ketik area...': 'Type an area...',
    'Ketik produk...': 'Type a product...', 'Ketik nama...': 'Type a name...', 'Contoh: 628123...': 'e.g. 628123...', 'Ketik aksi...': 'Type an action...',
    'Tambahkan tanggal ini ke riwayat Tgl Kirim (bukan menimpa, cuma menambah)': 'Add this date to the Send Date history (adds, never overwrites)',
    'Buka tab WA Broadcast dengan kontak baris terpilih': 'Open the WA Broadcast tab with the selected rows', 'Copy kontak baris terpilih, siap paste ke BCC': 'Copy selected contacts, ready to paste into BCC',
    'Pilih semua baris terlihat (1 halaman)': 'Select all visible rows (1 page)', 'Pilih SEMUA hasil filter, termasuk yang di halaman lain': 'Select ALL filtered results, including other pages',
    'Copy kontak semua hasil filter, siap paste ke BCC': 'Copy all filtered contacts, ready to paste into BCC',
    'Ganti nilai suatu field untuk banyak leads sekaligus, tanpa perlu centang satu-satu': 'Replace a field value for many leads at once, without ticking each one',
    'Hot/Warm, sudah >= 7 hari tanpa update — wajib segera di-follow-up': 'Hot/Warm, >= 7 days without update — follow up now',
    'Buka WhatsApp': 'Open WhatsApp', 'Salin WA': 'Copy WA', 'Edit baris ini (semua kolom, termasuk Nomor WA/Email)': 'Edit this row (all columns, including WA Number/Email)',
    'Copy baris ini (semua kolom, siap paste 1 baris utuh ke Excel)': 'Copy this row (all columns, ready to paste as one Excel row)', 'Hapus leads ini': 'Delete this lead',
    'Contoh: Bogor, Depok, Bekasi...': 'e.g. Bogor, Depok, Bekasi...', 'Otomatis dari Sub Area kalau dikenali': 'Filled from Sub Area when recognised',
    'Contoh: Wahana, Koperasi...': 'e.g. Wahana, Koperasi...', 'Nama pemilik data...': 'Data owner name...', 'Nama eksekutor lapangan...': 'Field executor name...',
    'Contoh: SIMASRIM': 'e.g. SIMASRIM', 'Nama pemilik data (berlaku utk semua sheet)...': 'Data owner name (applies to all sheets)...',
    'Otomatis dari Sub Area per sheet kalau dikenali': 'Filled from each sheet\'s Sub Area when recognised', 'Contoh: Masjid Besar, DKM, Koperasi...': 'e.g. Grand Mosque, DKM, Cooperative...',
    'Contoh: Bogor, Jakarta Selatan...': 'e.g. Bogor, South Jakarta...', 'Otomatis ikut Kata Kunci, bisa diedit': 'Follows the Keyword, editable',
    'Otomatis dari Kota, bisa diedit': 'Filled from City, editable', 'Contoh: 08123... / budi@email.com': 'e.g. 08123... / budi@email.com',
    'Kontak tambahan, biar lead ini bisa dihubungi lewat WA & Email': 'Extra contact so this lead can be reached via WA & Email',
    'Nomor/akun WA CS mana yang dipakai chat ke lead ini, mis. CS 1 - 08123...': 'Which CS WA number/account chats with this lead, e.g. CS 1 - 08123...',
    'Contoh: Toko Berkah': 'e.g. Toko Berkah', 'Nama eksekutor...': 'Executor name...', 'Contoh: 628123... / budi@email.com': 'e.g. 628123... / budi@email.com',
    'Contoh: Jawa Barat': 'e.g. West Java', 'Alamat lengkap toko/agen...': 'Full store/agent address...', 'Balasan terakhir dari leads...': 'Latest reply from the lead...',
    'Rencana follow-up berikutnya...': 'Next follow-up plan...', 'Catatan tambahan...': 'Additional notes...', 'Nilai baru...': 'New value...',
    // Panduan (judul & ringkasan; isi panjang tetap ID bila belum ada)
    'Panduan Penggunaan': 'User Guide', 'Pelajari cara menggunakan Smart Leads Cleanser & Master Tracking Campaign': 'Learn how to use the Smart Leads Cleanser & Master Campaign Tracking',
    '🧭 Alur Penggunaan': '🧭 Workflow', '🛰️ Cari Leads Baru': '🛰️ Find New Leads', '📋 Spreadsheet & Copy BCC': '📋 Spreadsheet & BCC Copy',
    '0. Alur Penggunaan Campaign Tracker (Mulai dari Sini)': '0. Campaign Tracker Workflow (Start Here)',
    'Kalau baru pertama kali buka halaman ini, ikuti urutan sederhana ini dari atas ke bawah — semua menu (Dashboard, Master Leads, Upload & Cleansing, WA Broadcast) saling terhubung dalam satu alur kerja yang sama.': 'If this is your first visit, follow these steps top to bottom — every menu (Dashboard, Master Leads, Upload & Cleansing, WA Broadcast) connects in one workflow.',
    'Masukkan data leads dulu': 'Add lead data first', '— ada 3 cara, pilih salah satu (atau kombinasi):': '— there are 3 ways, pick one (or combine):',
    '• Punya file Excel/CSV berisi banyak leads sekaligus? Buka menu': '• Have an Excel/CSV file with many leads? Open the', ', sistem akan otomatis membersihkan & merapikan datanya.': 'menu; the system cleans & tidies the data automatically.',
    '• Cuma mau tambah 1-2 leads saja? Buka menu': '• Only adding 1-2 leads? Open the', ', klik tombol': 'menu, click the', 'di pojok kanan bawah untuk input manual.': 'button at the bottom right for manual input.',
    '• Mau cari leads B2B baru (Masjid, DKM, Koperasi, atau target lain) tanpa cari manual? Buka menu': '• Want new B2B leads (mosques, cooperatives, etc.) without searching manually? Open the',
    'Cari Leads Baru': 'Find New Leads', ', sistem otomatis mencarikan dari Google Maps.': 'menu; the system searches Google Maps for you.',
    'Cek & kelola datanya di Master Leads': 'Check & manage the data in Master Leads',
    '— semua leads yang sudah masuk (dari cara manapun di langkah 1) muncul di sini. Bisa diedit, difilter, diberi status/tahap, atau dihapus dari sini.': '— every lead added (by any method in step 1) appears here. Edit, filter, set status/stage or delete from here.',
    'Pantau performa lewat Dashboard': 'Track performance in the Dashboard', '— begitu ada data, angka dan grafik di menu': '— once there is data, the numbers and charts in the',
    'otomatis terisi: total leads, Hot/Warm/Cold, notifikasi 🔔 Perlu Follow-Up, sampai leaderboard tim.': 'menu fill automatically: total leads, Hot/Warm/Cold, 🔔 Needs Follow-Up alerts and the team leaderboard.',
    'Follow-up leads via WhatsApp': 'Follow up leads via WhatsApp', '— kalau mau mengirim pesan WA ke banyak leads sekaligus, balik ke': '— to message many leads at once, go back to',
    ', centang leads yang mau dihubungi, klik': ', tick the leads to contact, click', '— otomatis pindah ke menu': '— you move to the',
    'dengan kontak sudah terisi, tinggal tulis pesan dan kirim.': 'menu with contacts filled in; just write and send.', 'Ulangi terus': 'Keep repeating',
    '— tiap kali ada respon dari leads, balik ke Master Leads untuk update Tahap/Respon/Tipe Leads-nya (klik langsung di kolomnya), sampai leads-nya closing.': '— whenever a lead replies, go back to Master Leads to update its Stage/Response/Lead Type (click the column) until it closes.',
    'Singkatnya:': 'In short:', '/ tombol': '/ the button', '= pintu masuk data →': '= data entry →', '= pusat kerja sehari-hari →': '= daily workspace →', '= laporan →': '= reports →',
    '= alat kirim pesan massal. Kelima menu ini bukan halaman terpisah-pisah, tapi satu alur yang saling mengisi.': '= bulk messaging. These five menus form one connected workflow.',
    '2. Upload Wizard (Pembersihan Data)': '2. Upload Wizard (Data Cleansing)', '4. WA Broadcast (Kirim WA Massal)': '4. WA Broadcast (Bulk WA)',
    '5. Cari Leads Baru (Automation Scraping B2B)': '5. Find New Leads (B2B Scraping Automation)', '6. Spreadsheet Mode & Copy untuk BCC': '6. Spreadsheet Mode & BCC Copy',
    'Edit Langsung per Kolom': 'Inline Edit per Column', 'Edit 1 Baris Penuh (pop-up)': 'Edit a Full Row (pop-up)', 'Filter Lanjutan': 'Advanced Filters',
    'Tindakan Massal': 'Bulk Actions', 'Sort Kolom & Pilih Rentang Sel': 'Column Sort & Cell Range Selection', 'Tambah Manual': 'Add Manually',
    'Filter Dashboard': 'Dashboard Filters', 'Notifikasi leads': 'Lead alerts', 'Aktivitas Hari Ini': 'Today\'s Activity', 'Leaderboard PIC Garap': 'Handling PIC Leaderboard',
    'Ranking PIC dengan closing terbanyak.': 'PICs ranked by most closings.', 'Jumlah leads yang di-update hari ini — indikator seberapa aktif tim bekerja.': 'Leads updated today — a sign of how active the team is.',
    'Fase A — Kumpulan Cepat (otomatis)': 'Phase A — Quick Collection (automatic)', 'Fase B — Cek Nomor (opsional, manual)': 'Phase B — Number Check (optional, manual)',
    'Data yang belum diimpor TIDAK akan hilang': 'Data not yet imported will NOT be lost', 'Ulangi kata kunci+kota yang sama = bukan lanjut, tapi cari dari awal lagi.': 'Repeating the same keyword+city restarts the search instead of continuing.',
    'Pilih & copy rentang sel (ala Google Sheets)': 'Select & copy a cell range (like Google Sheets)', 'Tombol "Copy Kontak (Terfilter)"': '"Copy Contacts (Filtered)" button',
    'Tombol "Copy Kontak" di panel biru (bulk-bar)': '"Copy Contacts" button in the blue bulk bar', 'Tombol copy per baris': 'Per-row copy button',
    'Kenapa cuma satu tab WhatsApp Web yang kebuka terus?': 'Why does only one WhatsApp Web tab stay open?',
    'Halaman utama untuk mengelola leads yang telah dibersihkan. Kamu bisa melihat leads WhatsApp dan Email secara terpisah lewat tombol mode di sidebar.': 'The main page for managing cleaned leads. View WhatsApp and Email leads separately with the mode button in the sidebar.',
    'Klik kolom manapun (Tahap, Respon, dll) untuk mengubah data itu saja secara langsung.': 'Click any column (Stage, Response, etc.) to edit just that value.',
    'Ketik "deal", "closing", atau "mou" pada kolom Respon — sistem otomatis ubah tahap/tipe leads jadi Hot/Closing.': 'Type "deal", "closing" or "mou" in the Response column — the stage/lead type switches to Hot/Closing automatically.',
    'Gunakan tombol': 'Use the', 'di pojok kanan bawah untuk memasukkan lead baru satu per satu.': 'button at the bottom right to add new leads one by one.',
    'Ringkasan statistik performa campaign — grafik dan kartu otomatis menyesuaikan data terbaru, mencakup sebaran area, tahapan (funnel), dan distribusi tipe leads (Hot/Warm/Cold).': 'Campaign performance summary — charts and cards follow the latest data, covering area spread, stages (funnel) and lead type distribution (Hot/Warm/Cold).',
    'Mengirim pesan WhatsApp personal ke banyak kontak sekaligus, langsung dari leads di Master Leads — tanpa export/import manual.': 'Send personal WhatsApp messages to many contacts at once, straight from Master Leads — no manual export/import.',
    'Tabel Master Leads bisa dipakai mirip spreadsheet untuk menyalin data. Ada 4 cara copy berbeda untuk kebutuhan berbeda:': 'The Master Leads table works like a spreadsheet for copying data. There are 4 copy methods for different needs:',
    'Dipakai untuk mengunggah file CSV/XLSX mentah dan membersihkannya secara otomatis agar formatnya seragam. Ada 2 jenis upload, dipilih di Langkah 1:': 'Upload raw CSV/XLSX files and clean them automatically into a consistent format. There are 2 upload types, chosen in Step 1:',
    'Pilih jenis data (WhatsApp/Email) dan jenis upload (Data Segar/Migrasi Data Lama).': 'Choose the data type (WhatsApp/Email) and upload type (Fresh Data/Legacy Migration).',
    'Data Segar:': 'Fresh Data:', 'Migrasi Data Lama:': 'Legacy Migration:', 'isi Brand/Area/PIC Campaign lalu unggah file → langsung ke preview.': 'fill in Brand/Area/Campaign PIC then upload → straight to preview.',
    'Wilayah dipecah 2 tingkat:': 'Regions have 2 levels:', '(provinsi) dan': '(province) and', 'Klik': 'Click', 'untuk menyimpan hasil pembersihan ke Master Leads.': 'to save the cleaned data to Master Leads.',
    'Mencari data leads B2B baru secara otomatis dari Google Maps — bisa cari target apapun (Masjid, DKM, Yayasan, Koperasi, atau institusi lain), tidak perlu lagi copy-paste manual satu-satu. Prosesnya dibagi 2 fase supaya cepat sekaligus rendah risiko diblokir.': 'Find new B2B leads automatically from Google Maps — any target (mosques, foundations, cooperatives or other institutions), no more manual copy-paste. The process runs in 2 phases to be fast and low-risk of being blocked.',
    // Panduan — kalimat panjang (dipecah sesuai simpul teks di HTML)
    'Klik ikon pensil hijau di kolom "Aksi" untuk buka form edit lengkap satu baris sekaligus — termasuk Nomor WA/Email-nya. Klik langsung pada nomor/email di tabel tetap berfungsi seperti biasa untuk buka WA/email atau menyalin (copy), tidak berubah.': 'Click the green pencil icon in the "Actions" column to open the full edit form for that row — including its WA Number/Email. Clicking a number/email in the table still opens WA/email or copies it, as before.',
    '(kota/kab) — biar bisa lihat performa per-provinsi maupun per-kota. Area Utama otomatis ke-isi dari Sub Area kalau dikenali (lihat saran di kolom "Ketik..."), tapi tetap bisa diedit manual. Alamat detail tetap ada terpisah, dikelola lewat form edit 1 baris.': '(city/regency) — so you can see performance per province and per city. Main Area fills from Sub Area when recognised (see the suggestions in the "Type..." field) but stays editable. The detailed address is kept separately in the row edit form.',
    'Gunakan filter bar di atas tabel untuk menyaring data berdasarkan Area Utama, Sub Area, brand,': 'Use the filter bar above the table to filter by Main Area, Sub Area, brand,',
    ', tipe leads, tahap, dll. Tiap dropdown yang datanya ada yang kosong otomatis punya opsi': ', lead type, stage, etc. Every dropdown with empty values gets an',
    '— pilih itu buat lihat leads yang field-nya belum diisi.': 'option — choose it to see leads whose field is still empty.',
    'Centang beberapa baris lalu gunakan panel ungu yang muncul untuk mengubah Brand/Produk/Area Utama/Sub Area/PIC Campaign/PIC Garap/Aksi Lanjutan/Tahap/Tipe, menambah Tanggal Kirim, atau menghapus sekaligus. Tombol': 'Tick several rows and use the purple panel to change Brand/Product/Main Area/Sub Area/Campaign PIC/Handling PIC/Next Action/Stage/Type, add a Send Date, or delete them at once. The',
    '"Pilih Semua Hasil Filter"': '"Select All Filtered"',
    'di toolbar mencentang SEMUA leads hasil filter (bukan cuma 50 baris di halaman aktif) supaya tindakan massal bisa kena leads di halaman lain juga.': 'button in the toolbar ticks ALL filtered leads (not just the 50 rows on this page) so bulk actions reach other pages too.',
    'Tombol di toolbar tabel — ganti nilai 1 field (Brand/Produk/Area Utama/Sub Area/PIC/Aksi Lanjutan/Tahap/Tipe Leads) untuk SEMUA leads yang cocok sekaligus, termasuk yang field-nya masih kosong (pilih "(Kosong)" di dropdown "Dari nilai"). Tidak perlu centang satu-satu atau ganti halaman — cocok untuk beres-beres data dalam jumlah besar. (Tanggal Kirim tidak ada di sini karena riwayatnya nambah, bukan mengganti — pakai bulk-bar "+ Tgl Kirim".)': 'A table toolbar button — replace one field (Brand/Product/Main Area/Sub Area/PIC/Next Action/Stage/Lead Type) for ALL matching leads at once, including empty ones (choose "(Empty)" in "From value"). No ticking or paging — ideal for large clean-ups. (Send Date is not here because its history adds rather than replaces — use the "+ Send Date" bulk bar.)',
    'Field untuk membedakan leads berdasarkan produk/program (misal "SIMASRIM" dan produk lain ke depannya) — terpisah dari Brand (yang dipakai untuk nama mitra/ekspedisi/institusi). Isian bebas dengan saran otomatis dari nilai yang sudah pernah dipakai.': 'A field to tell leads apart by product/program (e.g. "SIMASRIM" and future products) — separate from Brand (used for partner/courier/institution names). Free text with suggestions from values used before.',
    'Klik judul kolom manapun (yang ada ikon panah) untuk urutkan tabel naik/turun. Fitur ini sekarang berfungsi normal (sempat ada bug halus yang bikin klik sort tidak ngefek — sudah diperbaiki).': 'Click any column header (with an arrow icon) to sort ascending/descending. This now works normally (a subtle bug that made sorting do nothing has been fixed).',
    'Untuk 1 file = 1 kombinasi Sub Area/Brand/PIC tetap (misal hasil scraping baru atau list dari 1 kota tertentu). Alur seperti biasa: isi Sub Area/Brand/PIC Campaign, unggah, preview, commit. Area Utama (provinsi) otomatis ke-isi dari Sub Area kalau dikenali.': 'For 1 file = 1 fixed Sub Area/Brand/PIC combination (e.g. a new scrape or a list from one city). Usual flow: fill Sub Area/Brand/Campaign PIC, upload, preview, commit. Main Area (province) fills from Sub Area when recognised.',
    'Untuk file Excel lama berisi banyak sheet sekaligus, dengan Brand/Area yang beda-beda per sheet atau per baris (misal rekap campaign lama per-wilayah/per-brand). Sistem baca SEMUA sheet, tampilkan checklist untuk dipilih & disesuaikan sebelum diproses.': 'For old multi-sheet Excel files whose Brand/Area differs per sheet or row (e.g. old campaign recaps per region/brand). The system reads ALL sheets and shows a checklist to pick & adjust before processing.',
    '(sheet yang mirip daftar leads otomatis tercentang, sheet kosong/rekap otomatis tidak tercentang) — cek & sesuaikan Brand/Area default per sheet kalau perlu, lalu klik "Proses Sheet Terpilih".': '(sheets that look like lead lists are ticked, empty/recap sheets are not) — check & adjust the default Brand/Area per sheet if needed, then click "Process Selected Sheets".',
    'Kalau ada nilai Brand yang tidak cocok kategori resmi manapun, muncul langkah': 'If a Brand value matches no official category, the step',
    '— pilih mau dipetakan ke kategori resmi yang mana, atau ketik kategori baru manual (sistem tidak pernah membuat kategori baru sendiri tanpa persetujuan).': 'appears — map it to an official category or type a new one manually (the system never creates categories without approval).',
    'Sistem otomatis membersihkan nomor (awalan 0/62/+62 → 62), mendeteksi duplikat, dan (khusus Migrasi Data Lama) sheet "Copy of X" otomatis dianggap versi terbaru & menimpa data "X" aslinya kalau nomor WA-nya sama.': 'The system cleans numbers (prefix 0/62/+62 → 62), detects duplicates and (Legacy Migration only) treats a "Copy of X" sheet as the newest version, overwriting "X" when the WA number matches.',
    'Filter bar di atas kartu ringkasan — saring berdasar Brand, Produk, Area Utama, Sub Area, PIC Garap, dan rentang tanggal (dari–sampai, berdasar tanggal update terakhir). Semua kartu & grafik di bawahnya otomatis mengikuti hasil filter, jadi bisa lihat misal "performa brand JNE di Jawa Barat bulan ini" tanpa harus hitung manual. Klik ikon refresh buat reset ke data penuh lagi.': 'A filter bar above the summary cards — filter by Brand, Product, Main Area, Sub Area, Handling PIC and date range (from–to, by last update). Every card & chart below follows the filter, so you can see e.g. "JNE brand performance in West Java this month" without manual counting. Click the refresh icon to reset.',
    '(Cold tidak pernah masuk sini) yang belum closing dan sudah lama tidak di-update:': '(Cold never appears here) that have not closed and have not been updated for a while:',
    '(>=3 hari, mulai perlu perhatian) dan': '(>=3 days, needs attention) and',
    '(>=7 hari, harus segera digarap). Muncul sebagai kartu angka, badge merah di menu "Dashboard" (kelihatan dari tab manapun), badge per baris di Master Leads, dan panel daftar lengkap — klik baris di panel buat langsung buka form edit lead itu.': '(>=7 days, handle now). Shown as a number card, a red badge on the "Dashboard" menu (visible from any tab), a per-row badge in Master Leads and a full list panel — click a row to open that lead\'s edit form.',
    '(mode WA), centang leads yang mau di-broadcast, lalu klik tombol': '(WA mode), tick the leads to broadcast, then click the',
    'di panel biru yang muncul di atas tabel.': 'button in the blue panel above the table.',
    'Kamu otomatis dibawa ke tab': 'You are taken to the',
    'dengan kontak sudah terisi. (Tidak sempat centang leads dulu? Bisa juga unggah file Excel/CSV atau input manual langsung di tab ini.)': 'tab with contacts filled in. (Didn\'t tick leads first? You can also upload an Excel/CSV file or enter contacts manually in this tab.)',
    'Buka tab': 'Open the', ', ketik isi pesannya. Pakai placeholder seperti': 'tab and type the message. Use placeholders such as',
    'supaya pesan otomatis dipersonalisasi per kontak.': 'so each message is personalised per contact.',
    ', lalu pilih mode Kirim Otomatis (berjeda tiap beberapa detik) atau Mode Berurutan (manual, kontak demi kontak).': ', then choose Auto Send (a few seconds apart) or Step-by-step Mode (manual, contact by contact).',
    'Ini memang disengaja, bukan bug — supaya rapi dan gampang dipantau, setiap kirim ke kontak berikutnya sistem akan': 'This is intentional, not a bug — to stay tidy and easy to watch, each send to the next contact will',
    'memakai tab web.whatsapp.com yang sama': 'reuse the same web.whatsapp.com tab',
    'yang sudah kamu buka & login sebelumnya (tidak numpuk tab baru). Pastikan sudah login (scan QR) di tab web.whatsapp.com dulu sebelum mulai kirim.': 'you opened & logged into earlier (no pile of new tabs). Make sure you are logged in (QR scanned) on web.whatsapp.com before sending.',
    'Scroll 1 halaman daftar hasil sampai benar-benar mentok (persis seperti SOP manual/ekstensi "Instant Data Scraper"), lalu semua nama/alamat langsung tersimpan — biasanya cuma hitungan detik. Tanpa buka satu-satu, jadi jauh lebih cepat & aman.': 'Scrolls one results list all the way down (just like the manual SOP / "Instant Data Scraper" extension), then saves every name/address — usually within seconds. No opening each place, so it is much faster & safer.',
    'Nomor telepon tidak selalu tampil di daftar cepat. Untuk baris yang belum ada nomornya, klik "Cek Nomor" (1 lokasi) atau centang beberapa lalu "Verifikasi yang Dicentang" — baru di fase ini sistem buka halaman detail lokasinya.': 'Phone numbers don\'t always appear in the quick list. For rows without a number, click "Check Number" (1 place) or tick several and use "Verify Ticked" — only in this phase does the system open each place\'s detail page.',
    ', ketik': 'and type a', '(misal "Masjid Besar", "DKM", atau "Koperasi" — bebas, ada saran tapi boleh ketik apa saja) dan': '(e.g. "Grand Mosque", "DKM" or "Cooperative" — anything, suggestions are offered) and a',
    '(misal "Bandung"). Isian': '(e.g. "Bandung"). The',
    'otomatis ikut Kata Kunci (bisa diedit manual kalau mau beda, misal cari "JNE" tapi mau brand-nya "Ekspedisi"). Isian': 'field follows the Keyword (edit it if you want something else, e.g. search "JNE" but brand it "Courier"). The',
    'otomatis terisi provinsi dari Kota yang diketik kalau dikenali (bisa diedit juga). Klik': 'field fills with the province of the typed City when recognised (also editable). Click',
    '"Mulai Cari Leads"': '"Start Lead Search"',
    'Tunggu Fase A jalan (biasanya hitungan detik) — baris-baris hasil': 'Wait for Phase A (usually seconds) — result rows',
    'langsung muncul satu-satu di tabel review': 'appear one by one in the review table',
    'selagi diproses, tidak perlu nunggu sampai benar-benar selesai baru kelihatan.': 'while processing; no need to wait until it finishes.',
    'Cek tabel review: kolom': 'Check the review table: the', 'Nama, Nomor WA, Alamat, Area': 'Name, WA Number, Address, Area',
    '. Baris yang': 'columns. Rows that', 'sudah': 'already', 'ada nomornya bisa langsung diedit kalau perlu. Baris yang': 'have a number can be edited if needed. Rows that',
    'belum': 'do not yet', 'ada nomornya punya tombol': 'have a number get a',
    '— klik untuk buka 1 halaman detail lokasi itu saja dan ambil nomornya (kalau ada). Bisa juga centang beberapa baris tanpa nomor lalu klik': 'button — click to open just that place\'s detail page and grab its number (if any). You can also tick several rows without numbers and click',
    'Centang leads yang valid & sudah ada nomornya, klik': 'Tick valid leads that have a number, click', '"Import ke Master Leads"': '"Import to Master Leads"',
    '— leads itu langsung muncul di tab Master Leads (brand sesuai isian Brand/Kategori tadi, status masih kosong/belum dihubungi), siap di-follow-up seperti leads lainnya (termasuk lewat WA Broadcast). Baris tanpa nomor otomatis dilewati saat impor.': '— they appear in Master Leads right away (brand from the Brand/Category field, status empty/not contacted), ready for follow-up like any lead (including WA Broadcast). Rows without a number are skipped on import.',
    'Leads yang salah/tidak relevan tinggal dicentang lalu klik': 'Wrong or irrelevant leads: tick them and click', '"Buang yang Dicentang"': '"Discard Ticked"',
    '— tidak akan masuk Master Leads.': '— they won\'t enter Master Leads.',
    'Klik "Cek Nomor" sebanyak apapun, atau centang semua lalu "Verifikasi yang Dicentang" — semuanya otomatis masuk 1 antrean': 'Click "Check Number" as often as you like, or tick all and "Verify Ticked" — everything joins one queue',
    'dan diproses bergiliran di belakang layar (maksimal 15 lokasi tiap kali kirim ke server, otomatis lanjut ke kelompok berikutnya tanpa perlu klik ulang). Baris yang masih menunggu giliran akan menampilkan "Menunggu antrean...". Kalau baris yang masih menunggu itu dibuang lewat': 'and is processed in turn in the background (up to 15 places per server request, continuing to the next batch automatically). Waiting rows show "Waiting in queue...". If a waiting row is discarded via',
    ', otomatis batal dari antrean juga — aman, tidak perlu khawatir data nyasar.': ', it leaves the queue too — safe, no stray data.',
    'walau kamu ganti kata kunci dan cari lagi, atau tutup lalu buka ulang halaman ini — tabel review adalah gabungan dari SEMUA pencarian yang belum diimpor/dibuang, bukan cuma pencarian terakhir. Tapi supaya rapi, tetap disarankan impor atau buang dulu hasil yang sudah ada sebelum menumpuk terlalu banyak.': 'even if you change the keyword and search again, or close and reopen this page — the review table combines ALL searches not yet imported/discarded. To stay tidy, import or discard results before they pile up.',
    'Google Maps punya batas jumlah hasil per satu pencarian (jadi bukan "halaman berikutnya" yang bisa dilanjutkan) — kalau kombinasi yang sama dicari lagi, sistem cuma akan ketemu tempat yang itu-itu saja (otomatis di-skip karena sudah pernah tersimpan). Supaya cakupan lebih luas,': 'Google Maps limits results per search (there is no "next page" to continue) — searching the same combination again only finds the same places (skipped because they are saved). For wider coverage,',
    'gonta-ganti kombinasi': 'vary the combination of',
    'kata kunci dan kota — misal Jakarta sengaja dipecah jadi 5 pilihan (Pusat/Utara/Barat/Selatan/Timur) supaya tidak mentok di satu wilayah yang sama terus.': 'keywords and cities — e.g. Jakarta is split into 5 options (Central/North/West/South/East) so you don\'t keep hitting the same area.',
    'Server cuma bisa memproses': 'The server can only process', '1 hal dalam satu waktu': '1 job at a time',
    '(Fase A ATAU Fase B, punya siapapun — supaya server tidak berat). Untuk Fase A ("Mulai Cari Leads"), kalau lagi dipakai rekan kerja lain, tunggu dulu baru mulai pencarian baru. Untuk Fase B (Cek Nomor / Verifikasi), tidak perlu tunggu manual — antreannya otomatis menunggu giliran sendiri kalau kebetulan Fase A sedang berjalan. Lagi terlanjur nunggu kelamaan atau salah klik? Klik': '(Phase A OR Phase B, from anyone — to keep the server light). For Phase A ("Start Lead Search"), if a teammate is using it, wait before starting a new search. For Phase B (Check Number / Verify), no manual waiting — the queue waits its turn if Phase A is running. Waited too long or clicked by mistake? Click',
    '"Batalkan Pencarian"': '"Cancel Search"',
    'di bawah progress bar — proses aktif (siapapun pemiliknya) langsung dihentikan dan giliran berikutnya bisa langsung jalan, tidak perlu nunggu 10 menit. Kalau Fase A gagal terus-menerus (kemungkinan tampilan Google Maps berubah), gunakan cara manual di SOP lama sebagai cadangan.': 'under the progress bar — the active job (whoever owns it) stops and the next one can run immediately, no 10-minute wait. If Phase A keeps failing (Google Maps may have changed), use the manual method in the old SOP as a fallback.',
    'Klik satu sel lalu': 'Click a cell then', 'geser (drag)': 'drag', 'sambil tetap ditekan, atau klik sel pertama lalu': 'while holding, or click the first cell then',
    'Shift+klik': 'Shift+click',
    'sel terakhir — bisa satu kolom penuh, satu baris, atau kotak beberapa kolom×baris. Area terpilih akan jadi ungu, lalu tekan': 'the last cell — a whole column, a row, or a block of columns×rows. The selection turns purple; then press',
    '(Cmd+C di Mac) untuk menyalin, rapi per kolom kalau ditempel ke Excel/Sheets. Klik satu kali saja tanpa geser tetap berfungsi seperti biasa untuk': '(Cmd+C on Mac) to copy, neatly by column when pasted into Excel/Sheets. A single click without dragging still works as usual for',
    'mengedit isi sel': 'editing the cell', '. Klik di sel lain (atau di luar tabel) otomatis membatalkan pilihan rentang yang ungu tadi.': '. Clicking another cell (or outside the table) clears the purple selection.',
    'Di pojok kanan atas tabel. Menyalin kontak dari': 'At the top right of the table. Copies contacts from', 'semua baris hasil filter saat ini': 'all currently filtered rows',
    '(termasuk halaman lain kalau datanya di-paging), dipisah tanda titik-koma (': '(including other pages), separated by semicolons (',
    ') — siap tempel ke kolom BCC email.': ') — ready to paste into an email BCC field.',
    'Muncul setelah kamu': 'Appears after you', 'centang': 'tick', 'beberapa baris. Menyalin kontak': 'several rows. Copies contacts',
    'hanya dari baris yang dicentang': 'only from ticked rows', ', bukan semua hasil filter.': ', not all filtered results.',
    'Ikon copy ungu di kolom paling kanan "Aksi" tiap baris, di sebelah ikon hapus. Menyalin': 'The purple copy icon in the rightmost "Actions" column, next to the delete icon. Copies',
    'satu baris itu saja secara utuh': 'just that one full row', '(semua kolom), siap ditempel jadi satu baris di Excel/Sheets.': '(all columns), ready to paste as one row in Excel/Sheets.',
    'Cara 2, 3, dan 4 otomatis menyesuaikan mode aktif: mode': 'Methods 2, 3 and 4 follow the active mode:', 'menyalin nomor WA, mode': 'mode copies WA numbers,',
    'menyalin alamat email.': 'mode copies email addresses.', 'Menunggu antrean...': 'Waiting in queue...',
    'memuat data tersimpan…': 'loading saved data…',
  };

  // Pola untuk teks berangka yang dibuat JS
  const R = [
    [/^(\d+) leads$/, '$1 leads'], [/^(\d+) hari$/, '$1 days'], [/^(\d+) user$/, '$1 users'], [/^(\d+) transaksi$/, '$1 transactions'],
    [/^([\d.,-]+%) vs bulan lalu$/, '$1 vs last month'], [/^(\d+)% dari total leads$/, '$1% of total leads'],
    [/^Menampilkan (\S+) dari (\d+)$/, 'Showing $1 of $2'], [/^(\d+) dari (\d+) dipilih$/, '$1 of $2 selected'],
    [/^(\d+) dari (\d+) terkirim$/, '$1 of $2 sent'], [/^(\d+) dipilih$/, '$1 selected'], [/^Kontak (\d+) dari (\d+)$/, 'Contact $1 of $2'],
    [/^(\d+) closing dari (\d+) Hot\/Warm digarap$/, '$1 closings from $2 Hot/Warm handled'], [/^Selanjutnya: (.+)$/, 'Next: $1'],
    [/^Kontak \((\d+)\)$/, 'Contacts ($1)'], [/^(\d+) data duplikat ditemukan:$/, '$1 duplicates found:'],
    [/^(.+) · PIC: (.+)$/, (m, a, b) => (P[a] || a) + ' · PIC: ' + b],
    [/\bMei\b/g, 'May'], [/\bAgu\b/g, 'Aug'], [/\bOkt\b/g, 'Oct'], [/\bDes\b/g, 'Dec'],
  ];
  const BULAN = /\b(Mei|Agu|Okt|Des)\b/;

  function tr(s) {
    const t = s.trim().replace(/\s+/g, ' ');
    if (!t) return null;
    if (P[t] !== undefined) return s.replace(s.trim(), P[t]);
    for (const [re, to] of R) {
      if (re.global) continue;
      if (re.test(t)) return s.replace(s.trim(), t.replace(re, to));
    }
    // Tanggal pendek (mis. "01 Agu 2026", "Mei 26")
    if (BULAN.test(t) && /^[\d\s]*(Mei|Agu|Okt|Des)[\d\s]*$/.test(t)) {
      let o = t; R.filter(r => r[0].global).forEach(([re, to]) => { o = o.replace(re, to); });
      return s.replace(s.trim(), o);
    }
    return null;
  }

  const asli = new WeakMap();       // simpul teks → teks ID asli
  const tulisan = new WeakMap();    // simpul teks → nilai terakhir yang DITULIS penerjemah (pengamat berjalan belakangan, jadi perubahan sendiri harus dikenali)
  const asliAttr = new WeakMap();   // elemen → {attr: nilai asli}
  const ATTR = ['placeholder', 'title', 'aria-label'];
  let lang = 'id', mengubah = false;

  function lewati(el) { return !el || el.closest('script,style,[data-i18n],[translate="no"],code,pre'); }

  function terapkanSimpul(n) {
    if (lewati(n.parentElement)) return;
    if (lang === 'en') {
      const sumber = asli.has(n) ? asli.get(n) : n.nodeValue;
      const hasil = tr(sumber);
      if (hasil !== null) { if (!asli.has(n)) asli.set(n, sumber); if (n.nodeValue !== hasil) n.nodeValue = hasil; tulisan.set(n, hasil); }
    } else if (asli.has(n)) { n.nodeValue = asli.get(n); asli.delete(n); tulisan.delete(n); }
  }

  function terapkanAttr(el) {
    if (lewati(el)) return;
    ATTR.forEach(a => {
      if (!el.hasAttribute(a) || el.hasAttribute('data-i18n-' + a)) return;
      const simpan = asliAttr.get(el) || {};
      if (lang === 'en') {
        const sumber = simpan[a] !== undefined ? simpan[a] : el.getAttribute(a);
        const hasil = tr(sumber);
        if (hasil !== null) { simpan[a] = sumber; asliAttr.set(el, simpan); el.setAttribute(a, hasil); }
      } else if (simpan[a] !== undefined) { el.setAttribute(a, simpan[a]); delete simpan[a]; }
    });
  }

  function jalankan(akar) {
    mengubah = true;
    const tw = document.createTreeWalker(akar, NodeFilter.SHOW_TEXT);
    let n; while ((n = tw.nextNode())) terapkanSimpul(n);
    if (akar.querySelectorAll) { if (akar.nodeType === 1) terapkanAttr(akar); akar.querySelectorAll('[placeholder],[title],[aria-label]').forEach(terapkanAttr); }
    mengubah = false;
  }

  new MutationObserver(ms => {
    if (mengubah || lang !== 'en') return;
    ms.forEach(m => {
      if (m.type === 'characterData') { if (tulisan.get(m.target) === m.target.nodeValue) return; mengubah = true; asli.delete(m.target); terapkanSimpul(m.target); mengubah = false; }
      m.addedNodes && m.addedNodes.forEach(x => { if (x.nodeType === 3) { mengubah = true; terapkanSimpul(x); mengubah = false; } else if (x.nodeType === 1) jalankan(x); });
    });
  }).observe(document.documentElement, { childList: true, subtree: true, characterData: true });

  function set(l) { lang = l === 'en' ? 'en' : 'id'; if (document.body) jalankan(document.body); }
  window.addEventListener('languageChanged', e => set(e.detail && e.detail.lang));
  const awal = () => set(window.getSavedLanguage ? window.getSavedLanguage() : document.documentElement.lang);
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', awal); else awal();
})();
