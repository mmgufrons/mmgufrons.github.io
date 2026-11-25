/* Menu samping MKT — SATU-SATUNYA sumber isi menu untuk semua halaman .html di mkt/.
   Cara pakai di halaman:  <div id="sidebar" class="sidebar"></div>
                           <script src="(relatif)/assets/js/mkt-sidebar.js"></script>
   Dijalankan langsung (bukan menunggu DOMContentLoaded) supaya menu sudah ada
   sebelum i18n.js menerjemahkan atribut data-i18n. Gaya: assets/css/mkt-sidebar.css */
(function () {
  var src = document.currentScript && document.currentScript.src;
  if (!src) return;
  var root = src.replace(/assets\/js\/mkt-sidebar\.js.*$/, ''); // URL folder mkt/

  var bagian = [
    { label: 'Pintu Masuk', key: 'adm.nav.entry', item: [
      ['index.html', 'fa-home', 'Beranda MKT', 'adm.nav.home']
    ]},
    { label: '7 Modul Portofolio', key: 'adm.nav.modules', item: [
      ['admin_panel.html', 'fa-cogs', '1. Admin Panel', 'adm.nav.m1'],
      ['partner/b2b.html', 'fa-handshake', '2. Partner B2B', 'adm.nav.m2'],
      ['mitra/tracker.html', 'fa-route', '3. Mitra Tracker', 'adm.nav.m3'],
      ['campaign/campaign-tracker/index.html', 'fa-bullhorn', '4. Campaign Tracker', 'adm.nav.m4'],
      ['data/ppob/index.html', 'fa-bolt', '5. PPOB Dashboard', 'adm.nav.m5'],
      ['data/mp-report/index.html', 'fa-store', '6. MP Report', 'adm.nav.m6'],
      ['tools/legal/index.html', 'fa-file-contract', '7. Legal Tools', 'adm.nav.m7']
    ]},
    { label: 'Dokumen & SOP', key: 'mkt.nav.sop', item: [
      ['sop/ai.html', 'fa-robot', 'SOP Prompt AI', 'mkt.nav.sop.ai'],
      ['sop/blueprint.html', 'fa-map', 'SOP Active Blueprint', 'mkt.nav.sop.blueprint'],
      ['sop/klaim_logbook.html', 'fa-clipboard-check', 'SOP Komplain & Klaim', 'mkt.nav.sop.klaim'],
      ['hardware/edc.html', 'fa-cash-register', 'Pendaftaran EDC', 'mkt.nav.sop.edc'],
      ['hardware/sqris_activation.html', 'fa-qrcode', 'Aktivasi QRIS SoundBox', 'mkt.nav.sop.qris'],
      ['pitching/mitra/index.html', 'fa-network-wired', 'Pitching Mitra', 'mkt.nav.sop.pitchmitra'],
      ['pitching/b2b/index.html', 'fa-building', 'Pitching B2B', 'mkt.nav.sop.pitchb2b'],
      ['campaign/b2b_juni.html', 'fa-bullseye', 'Campaign B2B', 'mkt.nav.sop.campb2b'],
      ['campaign/blueprint_laz.html', 'fa-hand-holding-heart', 'Campaign LAZ', 'mkt.nav.sop.camplaz'],
      ['blueprint/juni_2.html', 'fa-calendar-alt', 'Contoh Blueprint', 'mkt.nav.sop.contoh'],
      ['partner/work_instructions.html', 'fa-truck', 'Instruksi Multi-Kurir', 'mkt.nav.sop.kurir'],
      ['mitra/sop_canvassing.html', 'fa-walking', 'SOP Canvassing', 'mkt.nav.sop.canvass']
    ]}
  ];

  var kini = location.pathname.replace(/\/$/, '/index.html');
  function esc(t) { return t.replace(/&/g, '&amp;').replace(/</g, '&lt;'); }

  var h = '<div class="sb-kepala">' +
    '<div class="sb-lang"><div class="lang-switch" role="group" aria-label="Bahasa / Language">' +
    '<button type="button" class="lang-btn" data-lang-btn="id" onclick="setLanguage(\'id\')">ID</button>' +
    '<span class="lang-sep" aria-hidden="true">|</span>' +
    '<button type="button" class="lang-btn" data-lang-btn="en" onclick="setLanguage(\'en\')">EN</button>' +
    '</div></div>' +
    '<a href="' + root + 'index.html" class="sb-logo"><span class="sidebar-merek">MKT<span class="titik">.</span>OS</span></a>' +
    '<p class="sb-tagline" data-i18n="mkt.sub.demo.badge">Portofolio Demo</p></div>' +
    '<nav class="sb-isi" aria-label="Menu MKT">';

  bagian.forEach(function (b, i) {
    if (i) h += '<hr class="nav-divider">';
    h += '<p class="nav-section-label" data-i18n="' + b.key + '">' + esc(b.label) + '</p>';
    b.item.forEach(function (it) {
      var url = root + it[0];
      var aktif = new URL(url, location.href).pathname === kini;
      h += '<a href="' + url + '" class="nav-item-link' + (aktif ? ' active" aria-current="page' : '') + '">' +
        '<span class="icon"><i class="fas ' + it[1] + '" aria-hidden="true"></i></span> ' +
        '<span data-i18n="' + it[3] + '">' + esc(it[2]) + '</span></a>';
    });
  });

  h += '</nav><hr class="nav-divider mt-auto">' +
    '<a href="' + root + '../index.html" class="nav-item-link btn-bottom-porto">' +
    '<span class="icon"><i class="fas fa-arrow-circle-left" aria-hidden="true"></i></span> ' +
    '<span data-i18n="common.back.hub">Portofolio Utama</span></a>';

  var el = document.getElementById('sidebar');
  if (el) el.innerHTML = h;
})();
