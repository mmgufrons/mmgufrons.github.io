/* ============================================================
   PORTOFOLIO MAULANA GUFRON — i18n.js
   Sistem Alih Bahasa Klien-Side (ID ⇄ EN) Ringan & Modular
   ============================================================ */
(function() {
  'use strict';

  const DICTIONARY = {
    id: {
      // Common & Meta
      'lang.id': 'ID',
      'lang.en': 'EN',
      'back.hub': '← Portofolio Hub',
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
      'mkt.footer': 'Arsitektur modul & UI dirancang oleh Maulana Gufron • Bagian dari <a href="../index.html">Hub Portofolio Utama</a>.'
    },

    en: {
      // Common & Meta
      'lang.id': 'ID',
      'lang.en': 'EN',
      'back.hub': '← Portfolio Hub',
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
      'mkt.footer': 'Module architecture & UI designed by Maulana Gufron • Part of the <a href="../index.html">Main Portfolio Hub</a>.'
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
