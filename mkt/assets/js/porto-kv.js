/**
 * PORTOFOLIO DEMO — porto-kv.js
 * Pengganti berkas api/*.php di browser, karena GitHub Pages tidak bisa
 * menjalankan PHP. Panggilan fetch ke proxy Firebase/API demo dijawab di sini:
 * data awal dibaca dari berkas seed JSON, perubahan disimpan di localStorage
 * pengunjung (hanya di browser mereka, tidak pernah dikirim ke server mana pun).
 * Wajib dimuat SEBELUM skrip yang memanggil api/*.php.
 */
(function () {
  'use strict';

  // Toko data per modul (tetap terpisah, seperti proyek Firebase aslinya)
  var STORES = [
    { re: /data\/ppob\/api\//, name: 'ppob', seed: 'ppob_seed.json' },
    { re: /mp-report\/api\//, name: 'mp_report', seed: 'mp_report_seed.json' },
    { re: /campaign-tracker\/api\//, name: 'campaign', seed: 'campaign_seed.json' }
  ];
  var memori = {};      // cadangan bila localStorage diblokir
  var muatan = {};      // janji memuat seed per toko
  var asliFetch = window.fetch.bind(window);

  function cariToko(url) {
    for (var i = 0; i < STORES.length; i++) {
      if (STORES[i].re.test(url)) return STORES[i];
    }
    // URL relatif "api/..." dari halaman modul itu sendiri
    var lokasi = location.pathname;
    for (var j = 0; j < STORES.length; j++) {
      if (STORES[j].re.test(lokasi.replace(/[^/]*$/, '') + 'api/')) return STORES[j];
    }
    return null;
  }

  function bacaLokal(nama) {
    try { var s = localStorage.getItem('porto-kv:' + nama); if (s) return JSON.parse(s); } catch (e) {}
    return memori[nama];
  }
  function simpanLokal(nama, pohon) {
    memori[nama] = pohon;
    try { localStorage.setItem('porto-kv:' + nama, JSON.stringify(pohon)); } catch (e) {}
  }

  function ambilPohon(toko, urlApi) {
    var ada = bacaLokal(toko.name);
    if (ada !== undefined) return Promise.resolve(ada);
    if (!muatan[toko.name]) {
      var seedUrl = urlApi.replace(/[^/?]*\.php.*$/, '') + 'data/' + toko.seed;
      muatan[toko.name] = asliFetch(seedUrl)
        .then(function (r) { return r.ok ? r.json() : {}; })
        .catch(function () { return {}; })
        .then(function (p) { p = p && typeof p === 'object' ? p : {}; simpanLokal(toko.name, p); return p; });
    }
    return muatan[toko.name];
  }

  function bagian(path) { return String(path || '').split('/').filter(Boolean); }
  function dapat(pohon, path) {
    var cur = pohon, p = bagian(path);
    for (var i = 0; i < p.length; i++) {
      if (cur === null || typeof cur !== 'object' || !(p[i] in cur)) return null;
      cur = cur[p[i]];
    }
    return cur === undefined ? null : cur;
  }
  function atur(pohon, path, nilai) {
    var p = bagian(path);
    if (!p.length) return nilai;
    var cur = pohon;
    for (var i = 0; i < p.length - 1; i++) {
      if (cur[p[i]] === null || typeof cur[p[i]] !== 'object') cur[p[i]] = {};
      cur = cur[p[i]];
    }
    if (nilai === null) delete cur[p[p.length - 1]]; else cur[p[p.length - 1]] = nilai;
    return pohon;
  }

  function jawab(data, status) {
    return new Response(JSON.stringify(data), {
      status: status || 200,
      headers: { 'Content-Type': 'application/json; charset=utf-8' }
    });
  }
  function idTugas(awalan) {
    var d = new Date(), z = function (n) { return String(n).padStart(2, '0'); };
    return awalan + '_' + d.getFullYear() + z(d.getMonth() + 1) + z(d.getDate()) + '_' +
      z(d.getHours()) + z(d.getMinutes()) + z(d.getSeconds()) + '_' + Math.random().toString(16).slice(2, 8);
  }
  function badan(init) {
    try { return init && init.body ? JSON.parse(init.body) : null; } catch (e) { return null; }
  }

  function tangani(url, init, toko) {
    var metode = String((init && init.method) || 'GET').toUpperCase();
    var u = new URL(url, location.href);
    return ambilPohon(toko, u.href).then(function (pohon) {
      var isi = badan(init) || {};

      if (/firebase_proxy\.php$/.test(u.pathname)) {
        var path = u.searchParams.get('path') || '';
        if (metode === 'GET') return jawab(dapat(pohon, path));
        if (metode === 'PUT' || metode === 'POST') { pohon = atur(pohon, path, isi); simpanLokal(toko.name, pohon); return jawab(isi); }
        if (metode === 'PATCH') {
          var lama = dapat(pohon, path);
          lama = lama && typeof lama === 'object' ? lama : {};
          Object.keys(isi).forEach(function (k) { lama[k] = isi[k]; });
          pohon = atur(pohon, path, lama); simpanLokal(toko.name, pohon); return jawab(lama);
        }
        if (metode === 'DELETE') { pohon = atur(pohon, path, null); simpanLokal(toko.name, pohon); return jawab(null); }
        return jawab({ error: 'Method not allowed' }, 405);
      }

      // Simulasi pencarian lokasi (tanpa scraping asli)
      if (/scrape_trigger\.php$/.test(u.pathname)) {
        var kata = String(isi.keyword || 'Koperasi').trim(), kota = String(isi.city || 'Kota Contoh').trim();
        var id = idTugas('collect'), hasil = {};
        for (var i = 1; i <= 4; i++) {
          hasil['place_' + i] = { nama: kata + ' Contoh ' + i + ' (' + kota + ')', alamat: 'Jl. Contoh No. ' + i + ', ' + kota,
            link: 'https://www.google.com/maps/place/contoh-dummy-' + i, phone: null };
        }
        atur(pohon, 'scrape_jobs/' + id, { status: 'done', combo: kata + ' @ ' + kota, message: 'Simulasi selesai (demo, tanpa scraping asli).',
          found: 4, target: 4, pid: 0, created_at: Date.now() });
        atur(pohon, 'scrape_staging/' + id, hasil);
        simpanLokal(toko.name, pohon);
        return jawab({ job_id: id });
      }
      if (/cancel_job\.php$/.test(u.pathname)) {
        if (!isi.job_id) return jawab({ error: 'job_id wajib dikirim untuk membatalkan proses tertentu.' }, 400);
        atur(pohon, 'scrape_jobs/' + isi.job_id, { status: 'cancelled', message: 'Dibatalkan oleh user (demo).' });
        atur(pohon, 'scrape_locks/' + isi.job_id, null);
        simpanLokal(toko.name, pohon);
        return jawab({ ok: true, job_id: isi.job_id });
      }
      if (/verify_phone\.php$/.test(u.pathname)) {
        var items = Array.isArray(isi.items) ? isi.items : [];
        if (!items.length) return jawab({ error: 'Tidak ada lokasi yang dipilih untuk diverifikasi.' }, 400);
        if (items.length > 15) return jawab({ error: 'Maksimal 15 lokasi per sekali verifikasi.' }, 400);
        var vid = idTugas('verify'), res = {};
        items.forEach(function (it, n) { res[String(it.placeKey || ('place_' + (n + 1)))] = { phone: '628110000' + String(n + 1).padStart(3, '0') }; });
        atur(pohon, 'scrape_jobs/' + vid, { status: 'done', combo: 'Verifikasi ' + items.length + ' nomor (demo)',
          message: 'Simulasi verifikasi selesai (demo, tanpa scraping asli).', found: items.length, target: items.length, pid: 0, created_at: Date.now() });
        atur(pohon, 'scrape_verify_result/' + vid, res);
        simpanLokal(toko.name, pohon);
        return jawab({ verify_job_id: vid });
      }
      return jawab({ error: 'Tidak tersedia di versi demo' }, 404);
    });
  }

  window.fetch = function (input, init) {
    var url = typeof input === 'string' ? input : (input && input.url) || '';
    if (/\/?api\/[^?]*\.php(\?|$)/.test(url)) {
      var toko = cariToko(new URL(url, location.href).pathname);
      if (toko) return tangani(url, init, toko);
    }
    return asliFetch(input, init);
  };

  // Tombol "kembalikan data contoh" bisa memanggil ini
  window.portoKvReset = function () {
    STORES.forEach(function (t) { delete memori[t.name]; try { localStorage.removeItem('porto-kv:' + t.name); } catch (e) {} });
  };
})();
