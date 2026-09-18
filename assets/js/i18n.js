/* ============================================================
   PORTOFOLIO MAULANA GUFRON — i18n.js
   Sistem Alih Bahasa Klien-Side (ID ⇄ EN) Ringan, Modular & Menyeluruh
   ============================================================ */
(function() {
  'use strict';

  const DICTIONARY = {
    id: {
      // Common & Meta
      'lang.id': 'ID',
      'lang.en': 'EN',
      'back.hub': '← Portofolio Hub',
      'back.main': '← Portofolio Utama',
      'open.demo': 'Buka Aplikasi Demo',
      'open.module': 'Buka Modul ↗',
      'open.gallery': 'Buka Galeri Tema',
      'view.detail': 'Lihat Detail Karya',

      // Root Hub — Header
      'hub.badge': 'Hub Portofolio Terpadu',
      'hub.title': 'Portofolio — Maulana Gufron',
      'hub.desc': 'Eksplorasi rekam jejak digital saya: arsitektur sistem bisnis & AI operations di industri, serta portofolio kreatif & identitas visual brand.',
      'hub.tab.business': '💼 Business & AI Operations',
      'hub.tab.creative': '🎨 Creative & Visual Design',

      // Tab Business — Sections
      'sec.live.title': '🔗 Proyek Live',
      'sec.live.sub': 'ekosistem publik yang aktif beroperasi',
      'sec.docs.title': '🌐 Layanan & Dokumentasi Terintegrasi',
      'sec.docs.sub': 'subdomain & portal operasional',
      'sec.demo.title': '🧪 Purwarupa & Demo Interaktif',
      'sec.demo.sub': 'sistem internal operasional & UI',

      // Live Cards
      'card.simasrim.sub': 'Super App Logistik & Bisnis Digital',
      'card.sqris.sub': 'Bikin QRIS Gratis Soundbox',
      'card.order.sub': 'Platform E-Commerce Cepat',
      'card.solusi.sub': 'Integrated Digital Ecosystem',
      'card.panduan.sub': 'Panduan per peran: Agen, Seller, B2B, Mobile',
      'card.smr.sub': 'Direktori link resmi ekosistem SIMASRIM',
      'card.sta.sub': 'Etalase online & katalog produk',
      'card.apidocs.sub': 'Dokumentasi API untuk mitra B2B',
      'card.lpqris.sub': 'Konversi QRIS statis ke dinamis',
      'card.mp.sub': 'Dashboard performa live shopping',
      'card.edc.sub': 'Standar aktivasi mesin EDC Agen',

      // Demo Cards
      'card.sma.title': 'SMA Internal ERP',
      'card.sma.desc': 'Sistem operasional internal: koordinasi divisi, manajemen tugas harian, pesan tim, dan direktori tools.',
      'card.mkt.title': 'MKT Suite',
      'card.mkt.desc': 'Suite aplikasi marketing & kemitraan: CRM Campaign, tracker mitra B2B, legal dokumen, dan pelaporan.',
      'card.sicek.title': 'SiCek — Cek Ongkir',
      'card.sicek.desc': 'Purwarupa interaktif modul cek ongkir: Signature, Nova, dan Landing Page cekongkirmurah.',

      // Tab Creative — Sections
      'sec.design.title': '🎨 Portofolio Desain & Branding',
      'sec.design.sub': 'identitas visual UMKM, periklanan, dan creative production',
      'sec.awards.title': '🏆 Prestasi & Penghargaan Desain',
      'sec.awards.sub': 'kompetisi perancangan visual karya Maulana Gufron',
      'sec.academic.title': '🧠 Rekam Jejak Analitis & Keilmuan',
      'sec.academic.sub': 'pondasi pemikiran logis & problem-solving',

      // Design Projects
      'card.vilook.tag': 'Branding & Media',
      'card.vilook.desc': 'Perancangan strategi visual konten marketing dan video editing untuk brand positioning.',
      'card.rm.tag': 'Identitas Visual',
      'card.rm.desc': 'Desain logo, signage fisik, dan materi promosi kuliner terintegrasi.',
      'card.kasmaran.tag': 'Branding UMKM',
      'card.kasmaran.desc': 'Pengembangan identitas brand, tone periklanan, serta materi grafis media sosial.',
      'card.g19.tag': 'Fotografi & Media',
      'card.g19.desc': 'Arahan visual fotografi komersial, penyelarasan warna brand, dan layout visual.',
      'card.rk.tag': 'Packaging & Print',
      'card.rk.desc': 'Desain kemasan makanan, spanduk promosi, dan materi percetakan outlet gerobak.',
      'card.san.tag': 'Corporate Identity',
      'card.san.desc': 'Materi presentasi perusahaan, panduan identitas korporat, dan company profile.',
      'btn.classic.gallery': 'Buka Galeri Desain Lengkap (Versi Klasik) ↗',

      // Awards
      'award.nat.badge': 'Tingkat Nasional',
      'award.bogor.badge': 'Pelajar se-Bogor Raya',
      'award.poster1.title': 'Juara 1 Lomba Desain Poster — "New Normal di Masa Pandemi"',
      'award.poster1.date': 'Desember 2020 • HMJ FE Akuntansi Universitas Semarang',
      'award.poster1.desc': 'Juara pertama dalam kompetisi desain poster digital tingkat nasional pada perhelatan <b>"Ukir Kreasi Generasi Milenial di Era 4.0"</b>, merefleksikan keahlian komunikasi visual dan desain persuasi publik di masa adaptasi kebiasaan baru.',
      'award.poster2.title': 'Juara 1 Lomba Desain Poster — "Miskonsepsi Fisika"',
      'award.poster2.date': 'November 2016 • Science Creation Event MAN 2 Bogor',
      'award.poster2.desc': 'Juara pertama kompetisi kreativitas visual pembuatan poster ilmiah-edukatif tingkat pelajar, mengolah materi ilmiah abstrak menjadi infografis yang mudah dipahami, lugas, dan menarik secara visual.',
      'award.ol.title': 'Juara 1 Cepat Tepat Konservasi — Olimpiade Lingkungan (OL)',
      'award.ol.date': '2015 • Uni Konservasi Fauna (UKF) IPB University',
      'award.ol.desc': 'Juara pertama tingkat nasional dalam cabang kompetisi utama perhelatan akbar tahunan <b>Olimpiade Lingkungan (OL)</b> UKF IPB University, menguji ketangkasan pemecahan masalah ekologi, regulasi konservasi keanekaragaman hayati, serta penalaran ilmiah terstruktur.',

      // Contact Box
      'contact.title': 'Tertarik diskusi atau kolaborasi?',
      'contact.desc': 'Terbuka untuk peluang karir, perancangan produk digital, maupun konsultasi implementasi AI dan identitas desain visual.',
      'contact.wa': 'Chat via WhatsApp — 0815-4728-7125',

      // Footer
      'footer.brand.desc': 'Portofolio Terpadu: Business Development, AI-Assisted Operations, & Visual Communication Design.',
      'footer.btn.business': '⚡ Hub Bisnis & AI',
      'footer.btn.creative': '🎨 Galeri Desain',
      'footer.subportal.title': 'Eksplorasi Sub-Portal',
      'footer.contact.title': 'Saluran Komunikasi',
      'footer.copyright': '© 2026 Maulana Gufron. All Rights Reserved.',

      // MKT Suite (/mkt/index.html)
      'mkt.current': 'Marketing Operations Suite',
      'mkt.badge': 'Marketing Operations Suite',
      'mkt.title': 'MKT — Marketing OS',
      'mkt.desc': 'Pusat operasional tools tim Marketing & CS SIMASRIM — mulai dari kemitraan B2B, tracking campaign periklanan, hingga ringkasan performa transaksi dan legalitas kerja sama.',
      'mkt.card1.title': '1. Admin Panel',
      'mkt.card1.desc': 'Panel pengelolaan pengguna, sinkronisasi data ekosistem, serta pengaturan konfigurasi operasional tim.',
      'mkt.card2.title': '2. Partner B2B',
      'mkt.card2.desc': 'Tracker kerja sama korporat B2B — pipeline terstruktur dari tahap penjajakan, negosiasi, hingga onboarding mitra.',
      'mkt.card3.title': '3. Mitra Tracker',
      'mkt.card3.desc': 'Dashboard monitoring kanvassing mitra agen di lapangan dengan status verifikasi dan titik koordinat terintegrasi.',
      'mkt.card4.title': '4. Campaign Tracker',
      'mkt.card4.desc': 'Rekapitulasi dan evaluasi performa campaign digital marketing, atribusi konversi, serta analisa ROI promosi.',
      'mkt.card5.title': '5. PPOB Dashboard',
      'mkt.card5.desc': 'Pusat kendali transaksi PPOB (Payment Point Online Bank): pulsa, PLN, e-wallet, dan payment gateway.',
      'mkt.card6.title': '6. MP Report',
      'mkt.card6.desc': 'Dashboard analitik performa marketplace multi-channel dan live commerce (TikTok Shop, Shopee, Tokopedia).',
      'mkt.card7.title': '7. Legal Tools',
      'mkt.card7.desc': 'Manajemen repositori dokumen perjanjian kerja sama, SLA kemitraan, NDA, dan standardisasi kepatuhan legal.',
      'mkt.footer': 'Arsitektur modul & UI dirancang oleh Maulana Gufron • Bagian dari <a href="../index.html">Hub Portofolio Utama</a>.',

      // SMA ERP Workstation (/sma/index.html)
      'sma.login.title': 'PT SMA Enterprise ERP',
      'sma.login.subtitle': 'Pilih Peran Demo untuk Langsung Membuka Workstation:',
      'sma.login.admin.title': 'Demo Admin',
      'sma.login.admin.badge': 'SuperAdmin',
      'sma.login.admin.name': 'Dimas Pratama • Marketing Head',
      'sma.login.admin.desc': 'Akses penuh: C-Level, Analitik, Manajemen Tim & Delegasi',
      'sma.login.staff.title': 'Demo User / Staff',
      'sma.login.staff.badge': 'Staff CS',
      'sma.login.staff.name': 'Bagas Saputra • Customer Support',
      'sma.login.staff.desc': 'Akses operasional: Tugas Harian, Kalender, Notes & Chat',
      'sma.login.manual': 'Atau coba akun kustom / form manual',
      'sma.login.btn.form': 'Masuk dengan Form',
      'sma.login.back': 'Kembali ke Portofolio Utama',
      'sma.sidebar.back': 'Portofolio Utama',
      'sma.sidebar.role.label': 'Akun Demo:',
      'sma.sidebar.clevel': '👑 C-Level',
      'sma.sidebar.exec': 'Executive View',
      'sma.sidebar.analytics': 'Laporan Analytics',
      'sma.sidebar.workspace': 'Ruang Kerja',
      'sma.sidebar.today': 'Dasbor Hari Ini',
      'sma.sidebar.board': 'Board KanBan',
      'sma.sidebar.calendar': 'Kalender Kerja',
      'sma.sidebar.meeting': 'Agenda Meeting',
      'sma.sidebar.notes': 'Buku Catatan',
      'sma.sidebar.routines': 'Pengingat & Rutinitas',
      'sma.sidebar.tools': 'Tools & Layanan',
      'sma.sidebar.archive': 'Arsip Selesai',
      'sma.sidebar.audit': 'Audit Log Aktivitas',
      'sma.sidebar.guide': 'Panduan Penggunaan',
      'sma.sidebar.users': 'Kelola Pengguna',
      'sma.sidebar.settings': 'Pengaturan Akun',
      'sma.sidebar.logout': 'Keluar / Logout',
      'sma.sidebar.export': 'Ekspor Data',
      'sma.sidebar.weekly.done': 'Selesai Pekan Ini',
      'sma.topbar.delegate': 'BAGI TASK',
      'sma.topbar.newtask': 'INPUT BARU',
      'sma.topbar.today.title': 'Dasbor Hari Ini',
      'sma.topbar.workload.text': '0 / 8 Jam',

      // MKT Submodules Common & Specific
      'mkt.sub.back': 'Portofolio Utama',
      'mkt.sub.demo.badge': 'Portofolio Demo',
      'mkt.sub.nav.main': 'Menu Utama',
      'mkt.sub.nav.data': 'Data & Finansial',
      'mkt.sub.nav.tools': 'Tools & Operasional',
      'mkt.sub.btn.add': 'Tambah Klien Baru',
      'mkt.sub.filter.cat': 'Kategori:',
      'mkt.sub.filter.all': 'Semua Kategori',
      'mkt.sub.db.connected': 'Cloud Database Connected',
      'mkt.b2b.hero.title': 'B2B Partnership Board',
      'mkt.b2b.hero.desc': 'Pantau progress akuisisi klien B2B (Inbound & Outbound) secara Real-Time.',
      'mkt.b2b.filter.logistik': 'Filter: Partner Logistik',
      'mkt.b2b.list.title': 'Daftar Klien B2B Aktif',
      'mkt.b2b.tab.outbound': 'B2B Outbound (Kita Supply)',
      'mkt.b2b.tab.inbound': 'B2B Inbound (Kita Sourcing)',
      'mkt.mitra.hero.title': 'Tracker Aktivasi Mitra Area',
      'mkt.mitra.hero.desc': 'Pantau progres onboarding Master Mitra, PIC Area, dan checklist perizinan legal.',
      'mkt.mitra.btn.add': 'Tambah Mitra Area',
      'mkt.mitra.btn.ref': 'Link Referral',
      'mkt.campaign.hero.title': 'Marketing Campaign Tracker',
      'mkt.campaign.hero.desc': 'Monitoring efektivitas kampanye, alokasi anggaran, dan konversi multi-channel.',
      'mkt.ppob.hero.title': 'PPOB & Financial Dashboard',
      'mkt.ppob.hero.desc': 'Laporan transaksi pulsa, token listrik, tagihan, dan rekonsiliasi kasir.',
      'mkt.mp.hero.title': 'Marketplace Sales & Live Report',
      'mkt.mp.hero.desc': 'Ringkasan performa pesanan dan analitik live streaming e-commerce.',
      'mkt.legal.hero.title': 'Legal & Dokumen Kerjasama',
      'mkt.legal.hero.desc': 'Repositori surat penunjukan, NDA, kontrak mitra, dan standardisasi legalitas.',

      // Cek Ongkir (/cekongkir/index.html)
      'cek.title': 'Galeri Tema Cek Ongkir',
      'cek.badge': 'Purwarupa Desain Antarmuka',
      'cek.desc': 'Kompilasi eksplorasi purwarupa UI/UX modul Cek Ongkir & Tracking SiCek, mencakup varian Signature, Nova, dan implementasi Landing Page.',
      'cek.card.sig.desc': 'Identitas visual khas SiCek — beranda, cek ongkir, tracking, dan halaman transaksi berhasil.',
      'cek.card.nova.desc': 'Iterasi lanjutan dari Signature dengan penyegaran visual & interaksi.',
      'cek.card.landing.desc': 'Purwarupa landing page promosi dan edukasi fitur cek ongkir publik.',
      'cek.btn.home': 'Beranda',
      'cek.btn.rates': 'Cek Ongkir',
      'cek.btn.track': 'Tracking',
      'cek.btn.success': 'Transaksi Berhasil',

      // Panduan (/panduan/index.html)
      'guide.title': 'Dokumen Panduan SIMASRIM',
      'guide.badge': 'Pusat Dokumentasi Resmi',
      'guide.desc': 'Direktori panduan operasional, SOP ekosistem, dan instruksi kerja berdasarkan peran pengguna.',
      'guide.agent.title': 'Panduan Agen & Mitra',
      'guide.agent.desc': 'Instruksi kerja operasional gerai agen pengiriman dan loket pembayaran.',
      'guide.seller.title': 'Panduan Seller / Pengirim',
      'guide.seller.desc': 'Panduan pengemasan paket, pembuatan resi, dan penjemputan barang.',
      'guide.b2b.title': 'Panduan Klien Korporat B2B',
      'guide.b2b.desc': 'Integrasi API logistik, faktur tagihan bulanan, dan SLA layanan.',
      'guide.mobile.title': 'Panduan Aplikasi Mobile',
      'guide.mobile.desc': 'Navigasi fitur aplikasi Android/iOS bagi pengguna dan kurir.',

      // Desain Gallery (/desain/index.html)
      'desain.hub': 'Hub Utama',
      'desain.title': 'Galeri Desain Klasik (2018–2023)',
      'desain.wa': 'Chat WhatsApp',
      'desain.nav.home': 'Beranda',
      'desain.nav.porto': 'Portofolio',
      'desain.nav.skills': 'Keterampilan',
      'desain.nav.contact': 'Kontak',
      'desain.hero.sub': '"sebuah gambar bernilai seribu kata"'
    },

    en: {
      // Common & Meta
      'lang.id': 'ID',
      'lang.en': 'EN',
      'back.hub': '← Portfolio Hub',
      'back.main': '← Main Portfolio',
      'open.demo': 'Open Demo App',
      'open.module': 'Open Module ↗',
      'open.gallery': 'Open Theme Gallery',
      'view.detail': 'View Project Details',

      // Root Hub — Header
      'hub.badge': 'Integrated Portfolio Hub',
      'hub.title': 'Portfolio — Maulana Gufron',
      'hub.desc': 'Explore my digital track record: business systems architecture & AI operations in industry, alongside creative portfolios & visual brand identities.',
      'hub.tab.business': '💼 Business & AI Operations',
      'hub.tab.creative': '🎨 Creative & Visual Design',

      // Tab Business — Sections
      'sec.live.title': '🔗 Live Projects',
      'sec.live.sub': 'active publicly operating ecosystems',
      'sec.docs.title': '🌐 Integrated Services & Docs',
      'sec.docs.sub': 'operational subdomains & portals',
      'sec.demo.title': '🧪 Interactive Prototypes & Demos',
      'sec.demo.sub': 'internal operational systems & UI',

      // Live Cards
      'card.simasrim.sub': 'Logistics Super App & Digital Business',
      'card.sqris.sub': 'Free QRIS Soundbox Generator',
      'card.order.sub': 'Instant E-Commerce Platform',
      'card.solusi.sub': 'Integrated Digital Ecosystem',
      'card.panduan.sub': 'Role-based guides: Agent, Seller, B2B, Mobile',
      'card.smr.sub': 'Official links directory for SIMASRIM ecosystem',
      'card.sta.sub': 'Online storefront & product catalog',
      'card.apidocs.sub': 'API documentation for B2B partners',
      'card.lpqris.sub': 'Static to dynamic QRIS conversion',
      'card.mp.sub': 'Live shopping performance analytics',
      'card.edc.sub': 'Agent EDC machine activation standard',

      // Demo Cards
      'card.sma.title': 'SMA Internal ERP',
      'card.sma.desc': 'Internal operational OS: cross-division coordination, daily task management, team chat, and tools directory.',
      'card.mkt.title': 'MKT Suite',
      'card.mkt.desc': 'Marketing & partnership application suite: Campaign CRM, B2B partner tracker, legal docs, and reporting.',
      'card.sicek.title': 'SiCek — Shipping Rates',
      'card.sicek.desc': 'Interactive shipping fee calculator prototypes: Signature, Nova, and landing page variants.',

      // Tab Creative — Sections
      'sec.design.title': '🎨 Design & Branding Portfolio',
      'sec.design.sub': 'SME visual identities, advertising, and creative production',
      'sec.awards.title': '🏆 Design Awards & Achievements',
      'sec.awards.sub': 'visual design competitions won by Maulana Gufron',
      'sec.academic.title': '🧠 Analytical & Scientific Track Record',
      'sec.academic.sub': 'foundation of logical reasoning & problem-solving',

      // Design Projects
      'card.vilook.tag': 'Branding & Media',
      'card.vilook.desc': 'Visual marketing content strategy and video editing for strategic brand positioning.',
      'card.rm.tag': 'Visual Identity',
      'card.rm.desc': 'Logo design, physical signage, and integrated culinary promotional collateral.',
      'card.kasmaran.tag': 'SME Branding',
      'card.kasmaran.desc': 'Brand identity creation, advertising tone of voice, and social media creative assets.',
      'card.g19.tag': 'Photography & Media',
      'card.g19.desc': 'Commercial photography direction, brand color matching, and editorial layout.',
      'card.rk.tag': 'Packaging & Print',
      'card.rk.desc': 'Food packaging design, promotional banners, and cart outlet print materials.',
      'card.san.tag': 'Corporate Identity',
      'card.san.desc': 'Corporate presentations, comprehensive corporate identity guidelines, and company profile.',
      'btn.classic.gallery': 'Open Complete Design Gallery (Classic Version) ↗',

      // Awards
      'award.nat.badge': 'National Level',
      'award.bogor.badge': 'Greater Bogor Students',
      'award.poster1.title': '1st Place Poster Design — "New Normal in the Pandemic Era"',
      'award.poster1.date': 'December 2020 • HMJ FE Accounting Universitas Semarang',
      'award.poster1.desc': 'First prize winner in the national digital poster design competition during <b>"Millennial Generation Creation in Era 4.0"</b>, showcasing persuasive public communication and visual design during pandemic transition.',
      'award.poster2.title': '1st Place Poster Design — "Physics Misconceptions"',
      'award.poster2.date': 'November 2016 • Science Creation Event MAN 2 Bogor',
      'award.poster2.desc': 'First prize in student educational-scientific poster competition, distilling abstract physics concepts into clear, engaging, and visually compelling infographics.',
      'award.ol.title': '1st Place Conservation Quiz Bowl — Environmental Olympiad (OL)',
      'award.ol.date': '2015 • Fauna Conservation Union (UKF) IPB University',
      'award.ol.desc': 'National first place champion in the flagship quiz bowl of IPB University\'s annual <b>Environmental Olympiad (OL)</b>, testing ecological problem-solving, biodiversity conservation regulations, and structured scientific reasoning.',

      // Contact Box
      'contact.title': 'Interested in discussing or collaborating?',
      'contact.desc': 'Open for career opportunities, digital product architecture, and consultation on AI operations & visual brand identity.',
      'contact.wa': 'Chat via WhatsApp — +62 815-4728-7125',

      // Footer
      'footer.brand.desc': 'Integrated Portfolio: Business Development, AI-Assisted Operations, & Visual Communication Design.',
      'footer.btn.business': '⚡ Business & AI Hub',
      'footer.btn.creative': '🎨 Design Gallery',
      'footer.subportal.title': 'Explore Sub-Portals',
      'footer.contact.title': 'Communication Channels',
      'footer.copyright': '© 2026 Maulana Gufron. All Rights Reserved.',

      // MKT Suite (/mkt/index.html)
      'mkt.current': 'Marketing Operations Suite',
      'mkt.badge': 'Marketing Operations Suite',
      'mkt.title': 'MKT — Marketing OS',
      'mkt.desc': 'Central operations hub for SIMASRIM Marketing & CS teams — from B2B partnerships and ad campaign tracking to transaction summaries and legal agreements.',
      'mkt.card1.title': '1. Admin Panel',
      'mkt.card1.desc': 'User management panel, ecosystem data synchronization, and operational team configurations.',
      'mkt.card2.title': '2. Partner B2B',
      'mkt.card2.desc': 'B2B corporate partnership tracker — structured pipeline from prospecting and negotiation to onboarding.',
      'mkt.card3.title': '3. Mitra Tracker',
      'mkt.card3.desc': 'Field agency partner canvassing dashboard with verification status and geolocation tracking.',
      'mkt.card4.title': '4. Campaign Tracker',
      'mkt.card4.desc': 'Recap and performance evaluation for digital campaigns, conversion attribution, and promotional ROI analysis.',
      'mkt.card5.title': '5. PPOB Dashboard',
      'mkt.card5.desc': 'PPOB transaction command center: mobile top-ups, electricity, e-wallets, and payment gateways.',
      'mkt.card6.title': '6. MP Report',
      'mkt.card6.desc': 'Multi-channel marketplace and live commerce performance analytics (TikTok Shop, Shopee, Tokopedia).',
      'mkt.card7.title': '7. Legal Tools',
      'mkt.card7.desc': 'Repository management for partnership agreements, SLAs, NDAs, and regulatory compliance standards.',
      'mkt.footer': 'Module architecture & UI designed by Maulana Gufron • Part of the <a href="../index.html">Main Portfolio Hub</a>.',

      // SMA ERP Workstation (/sma/index.html)
      'sma.login.title': 'PT SMA Enterprise ERP',
      'sma.login.subtitle': 'Select Demo Role to Launch Workstation:',
      'sma.login.admin.title': 'Demo Admin',
      'sma.login.admin.badge': 'SuperAdmin',
      'sma.login.admin.name': 'Dimas Pratama • Marketing Head',
      'sma.login.admin.desc': 'Full access: C-Level, Analytics, Team Management & Delegation',
      'sma.login.staff.title': 'Demo User / Staff',
      'sma.login.staff.badge': 'Staff CS',
      'sma.login.staff.name': 'Bagas Saputra • Customer Support',
      'sma.login.staff.desc': 'Operational access: Daily Tasks, Calendar, Notes & Chat',
      'sma.login.manual': 'Or try custom account / manual form',
      'sma.login.btn.form': 'Log In with Form',
      'sma.login.back': 'Back to Main Portfolio',
      'sma.sidebar.back': 'Main Portfolio',
      'sma.sidebar.role.label': 'Demo Role:',
      'sma.sidebar.clevel': '👑 C-Level',
      'sma.sidebar.exec': 'Executive View',
      'sma.sidebar.analytics': 'Analytics Report',
      'sma.sidebar.workspace': 'Workspace',
      'sma.sidebar.today': 'Today\'s Dashboard',
      'sma.sidebar.board': 'Kanban Board',
      'sma.sidebar.calendar': 'Work Calendar',
      'sma.sidebar.meeting': 'Meeting Agenda',
      'sma.sidebar.notes': 'Notebook & Notes',
      'sma.sidebar.routines': 'Routines & Reminders',
      'sma.sidebar.tools': 'Tools & Services',
      'sma.sidebar.archive': 'Completed Archive',
      'sma.sidebar.audit': 'Activity Audit Log',
      'sma.sidebar.guide': 'User Guide',
      'sma.sidebar.users': 'User Management',
      'sma.sidebar.settings': 'Account Settings',
      'sma.sidebar.logout': 'Sign Out / Logout',
      'sma.sidebar.export': 'Export Data',
      'sma.sidebar.weekly.done': 'Done This Week',
      'sma.topbar.delegate': 'DELEGATE',
      'sma.topbar.newtask': 'NEW TASK',
      'sma.topbar.today.title': 'Today\'s Dashboard',
      'sma.topbar.workload.text': '0 / 8 Hours',

      // MKT Submodules Common & Specific
      'mkt.sub.back': 'Main Portfolio',
      'mkt.sub.demo.badge': 'Portfolio Demo',
      'mkt.sub.nav.main': 'Main Menu',
      'mkt.sub.nav.data': 'Data & Finance',
      'mkt.sub.nav.tools': 'Tools & Operations',
      'mkt.sub.btn.add': 'Add New Client',
      'mkt.sub.filter.cat': 'Category:',
      'mkt.sub.filter.all': 'All Categories',
      'mkt.sub.db.connected': 'Cloud Database Connected',
      'mkt.b2b.hero.title': 'B2B Partnership Board',
      'mkt.b2b.hero.desc': 'Track B2B client acquisition progress (Inbound & Outbound) in Real-Time.',
      'mkt.b2b.filter.logistik': 'Filter: Logistics Partner',
      'mkt.b2b.list.title': 'Active B2B Client Directory',
      'mkt.b2b.tab.outbound': 'B2B Outbound (We Supply)',
      'mkt.b2b.tab.inbound': 'B2B Inbound (We Source)',
      'mkt.mitra.hero.title': 'Area Partner Activation Tracker',
      'mkt.mitra.hero.desc': 'Monitor Master Partner onboarding progress, Area PICs, and legal compliance checklist.',
      'mkt.mitra.btn.add': 'Add Area Partner',
      'mkt.mitra.btn.ref': 'Referral Links',
      'mkt.campaign.hero.title': 'Marketing Campaign Tracker',
      'mkt.campaign.hero.desc': 'Monitor campaign effectiveness, budget allocation, and multi-channel conversions.',
      'mkt.ppob.hero.title': 'PPOB & Financial Dashboard',
      'mkt.ppob.hero.desc': 'Airtime, electricity token, utility bills, and cashier reconciliation reports.',
      'mkt.mp.hero.title': 'Marketplace Sales & Live Report',
      'mkt.mp.hero.desc': 'Order performance recap and e-commerce live streaming analytics.',
      'mkt.legal.hero.title': 'Legal & Partnership Documents',
      'mkt.legal.hero.desc': 'Repository of appointment letters, NDAs, partner contracts, and legal standards.',

      // Cek Ongkir (/cekongkir/index.html)
      'cek.title': 'Shipping Rate Theme Gallery',
      'cek.badge': 'UI/UX Design Prototypes',
      'cek.desc': 'Compilation of UI/UX prototype explorations for SiCek Shipping Rate & Tracking modules, featuring Signature, Nova, and Landing Page variants.',
      'cek.card.sig.desc': 'SiCek signature visual identity — home, shipping rates, tracking, and successful transaction screens.',
      'cek.card.nova.desc': 'Advanced iteration from Signature featuring refreshed visuals and micro-interactions.',
      'cek.card.landing.desc': 'Promotional landing page prototype educating users on public shipping rate tools.',
      'cek.btn.home': 'Home',
      'cek.btn.rates': 'Rates',
      'cek.btn.track': 'Tracking',
      'cek.btn.success': 'Success',

      // Panduan (/panduan/index.html)
      'guide.title': 'SIMASRIM Documentation & SOP Guides',
      'guide.badge': 'Official Documentation Center',
      'guide.desc': 'Operational guide directory, ecosystem SOPs, and work instructions categorized by user role.',
      'guide.agent.title': 'Agent & Partner Guide',
      'guide.agent.desc': 'Work instructions for shipping agency outlets and payment counters.',
      'guide.seller.title': 'Seller & Shipper Guide',
      'guide.seller.desc': 'Package packaging, waybill generation, and parcel pickup instructions.',
      'guide.b2b.title': 'B2B Corporate Client Guide',
      'guide.b2b.desc': 'Logistics API integration, monthly invoicing, and service level agreements.',
      'guide.mobile.title': 'Mobile App User Guide',
      'guide.mobile.desc': 'Android/iOS app feature navigation for consumers and couriers.',

      // Desain Gallery (/desain/index.html)
      'desain.hub': 'Main Hub',
      'desain.title': 'Classic Design Gallery (2018–2023)',
      'desain.wa': 'WhatsApp Chat',
      'desain.nav.home': 'Home',
      'desain.nav.porto': 'Portfolio',
      'desain.nav.skills': 'Skills',
      'desain.nav.contact': 'Contact',
      'desain.hero.sub': '"a picture is worth a thousand words"'
    }
  };

  const STORAGE_KEY = 'porto_user_lang_pref';

  function getSavedLanguage() {
    try {
      const saved = localStorage.getItem(STORAGE_KEY);
      if (saved === 'id' || saved === 'en') return saved;
    } catch(e) {}
    const browserLang = (navigator.language || navigator.userLanguage || '').toLowerCase();
    return browserLang.startsWith('en') ? 'en' : 'id';
  }

  function setLanguage(lang) {
    if (lang !== 'id' && lang !== 'en') lang = 'id';
    try {
      localStorage.setItem(STORAGE_KEY, lang);
    } catch(e) {}

    document.documentElement.lang = lang;
    const dict = DICTIONARY[lang] || DICTIONARY.id;

    // 1. Teks elemen [data-i18n]
    document.querySelectorAll('[data-i18n]').forEach(el => {
      const key = el.getAttribute('data-i18n');
      if (dict[key] !== undefined) {
        el.innerHTML = dict[key];
      }
    });

    // 2. Title atribut [data-i18n-title]
    document.querySelectorAll('[data-i18n-title]').forEach(el => {
      const key = el.getAttribute('data-i18n-title');
      if (dict[key] !== undefined) {
        el.setAttribute('title', dict[key]);
      }
    });

    // 3. Placeholder [data-i18n-placeholder]
    document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
      const key = el.getAttribute('data-i18n-placeholder');
      if (dict[key] !== undefined) {
        el.setAttribute('placeholder', dict[key]);
      }
    });

    // 4. Highlight tombol switcher
    document.querySelectorAll('.lang-btn').forEach(btn => {
      const btnLang = btn.getAttribute('data-lang-btn');
      if (btnLang === lang) {
        btn.classList.add('active');
      } else {
        btn.classList.remove('active');
      }
    });
  }

  window.setLanguage = setLanguage;
  window.getSavedLanguage = getSavedLanguage;

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      setLanguage(getSavedLanguage());
    });
  } else {
    setLanguage(getSavedLanguage());
  }
})();
