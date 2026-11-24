// QRIS Statis2Dinamis (demo porto): tema, menu HP, simulasi QR, dan formulir.
(function () {
    'use strict';
    var IKON = window.LQ_IKON || {};
    var akar = document.documentElement;
    var gerakDikurangi = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function isiTombol(tombol, ikon, teks) {
        tombol.innerHTML = (ikon || '') + ' <span>' + teks + '</span>';
    }
    var PUTAR = '<span class="lq-putar" aria-hidden="true"></span>';

    // ---------- Tema ----------
    document.querySelectorAll('[data-ganti-tema]').forEach(function (b) {
        b.addEventListener('click', function () {
            akar.classList.toggle('dark');
            try { localStorage.setItem('theme', akar.classList.contains('dark') ? 'dark' : 'light'); } catch (e) {}
        });
    });

    // ---------- Menu HP ----------
    var menuBtn = document.getElementById('mobile-menu-btn');
    var menu = document.getElementById('mobile-menu');
    function aturMenu(buka) {
        menu.hidden = !buka;
        menuBtn.setAttribute('aria-expanded', String(buka));
        menuBtn.setAttribute('aria-label', buka ? 'Tutup menu' : 'Buka menu');
        menuBtn.innerHTML = (buka ? IKON.x : IKON.menu).replace('lq-ikon ', 'lq-ikon lq-ikon--24 ');
    }
    menuBtn.addEventListener('click', function () { aturMenu(menu.hidden); });
    menu.querySelectorAll('a').forEach(function (a) { a.addEventListener('click', function () { aturMenu(false); }); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !menu.hidden) { aturMenu(false); menuBtn.focus(); } });

    // ---------- Formulir: tanda sedang diproses ----------
    var form = document.getElementById('formDaftar');
    var kirimBtn = document.getElementById('submitFormBtn');
    if (form && kirimBtn) {
        form.addEventListener('submit', function () {
            isiTombol(kirimBtn, PUTAR, 'Memproses...');
            kirimBtn.setAttribute('aria-busy', 'true');
        });
    }

    // ---------- Simulasi ----------
    var input = document.getElementById('demoInput');
    var nominal = document.getElementById('demoAmount');
    var simBtn = document.getElementById('simulateBtn');
    var tutup = document.getElementById('qrOverlay');
    var qr = document.getElementById('qrContainer');
    var payBtn = document.getElementById('payBtn');
    var bank = document.getElementById('bankSelect');

    function terbilang(n) {
        var h = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
        var t = '';
        if (n < 12) t = ' ' + h[n];
        else if (n < 20) t = terbilang(n - 10) + ' belas';
        else if (n < 100) t = terbilang(Math.floor(n / 10)) + ' puluh' + terbilang(n % 10);
        else if (n < 200) t = ' seratus' + terbilang(n - 100);
        else if (n < 1000) t = terbilang(Math.floor(n / 100)) + ' ratus' + terbilang(n % 100);
        else if (n < 2000) t = ' seribu' + terbilang(n - 1000);
        else if (n < 1000000) t = terbilang(Math.floor(n / 1000)) + ' ribu' + terbilang(n % 1000);
        else if (n < 1000000000) t = terbilang(Math.floor(n / 1000000)) + ' juta' + terbilang(n % 1000000);
        return t.trim();
    }
    function rupiah(n) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(n);
    }
    function angka() { return input.value.replace(/[^0-9]/g, ''); }

    input.addEventListener('input', function () {
        var v = angka();
        this.value = v === '' ? '' : rupiah(v).replace('Rp', '').trim();
    });
    input.addEventListener('keydown', function (e) { if (e.key === 'Enter') { e.preventDefault(); simBtn.click(); } });

    function qrKosong() {
        qr.innerHTML = IKON['qr-code'];
        qr.setAttribute('aria-label', 'Contoh kode QR');
    }

    simBtn.addEventListener('click', function () {
        var v = angka();
        if (v === '' || v === '0') { nominal.textContent = 'Rp 0'; input.focus(); return; }

        isiTombol(simBtn, PUTAR, 'Updating...');
        simBtn.disabled = true;
        tutup.classList.add('is-aktif');
        qr.classList.add('is-membuat');

        // Jeda 800 ms meniru waktu tunggu server agar alurnya terasa nyata
        setTimeout(function () {
            nominal.textContent = rupiah(v);
            qr.innerHTML = '';
            if (window.QRCode) {
                new QRCode(qr, {
                    text: 'QRIS_' + v + '_' + Math.random().toString(36).substring(7),
                    width: 192, height: 192, colorDark: '#1e293b', colorLight: '#ffffff',
                    correctLevel: QRCode.CorrectLevel.H
                });
                qr.setAttribute('aria-label', 'Kode QR untuk ' + rupiah(v));
            } else {
                qrKosong();
            }
            payBtn.disabled = false;

            isiTombol(simBtn, IKON.check, 'Tersinkronisasi');
            simBtn.classList.add('lq-tombol--ok');
            tutup.classList.remove('is-aktif');
            qr.classList.remove('is-membuat');

            setTimeout(function () {
                isiTombol(simBtn, IKON['refresh-cw'], 'Update Layar Pelanggan');
                simBtn.classList.remove('lq-tombol--ok');
                simBtn.disabled = false;
            }, 2000);
        }, 800);
    });

    var suara = [];
    if ('speechSynthesis' in window) {
        window.speechSynthesis.onvoiceschanged = function () { suara = window.speechSynthesis.getVoices(); };
    }

    function bunyiBip() {
        try {
            var ctx = new (window.AudioContext || window.webkitAudioContext)();
            var osc = ctx.createOscillator();
            var g = ctx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(880, ctx.currentTime);
            g.gain.setValueAtTime(0.1, ctx.currentTime);
            osc.connect(g); g.connect(ctx.destination);
            osc.start();
            setTimeout(function () { osc.stop(); }, 150);
        } catch (e) { /* peramban tanpa Web Audio: lewati bunyi */ }
    }

    function ucapkan(teks) {
        if (!('speechSynthesis' in window)) return;
        var u = new SpeechSynthesisUtterance(teks);
        u.lang = 'id-ID';
        if (!suara.length) suara = window.speechSynthesis.getVoices();
        var id = suara.find(function (s) { return s.lang.indexOf('id') > -1 && (s.name.indexOf('Google') > -1 || s.name.indexOf('Premium') > -1); })
            || suara.find(function (s) { return s.lang.indexOf('id') > -1; });
        if (id) u.voice = id;
        u.rate = 0.95; u.pitch = 1.05;
        window.speechSynthesis.speak(u);
    }

    payBtn.addEventListener('click', function () {
        var v = angka();
        if (!v || v === '0') return;
        var namaBank = bank.value;
        isiTombol(payBtn, PUTAR, 'Memproses...');
        payBtn.disabled = true;
        payBtn.classList.add('lq-tombol--ok');

        setTimeout(function () {
            bunyiBip();
            ucapkan('Telah diterima ' + terbilang(parseInt(v, 10)) + ' rupiah, dari bank ' + namaBank);

            var toast = document.createElement('div');
            toast.className = 'lq-toast';
            toast.setAttribute('role', 'status');
            toast.innerHTML = '<span class="lq-bulat lq-bulat--hijau">' + IKON['check-circle'].replace('lq-ikon ', 'lq-ikon lq-ikon--24 ') + '</span>'
                + '<div><h4>Pembayaran Berhasil!</h4><p></p></div>';
            toast.querySelector('p').textContent = rupiah(v) + ' dari ' + namaBank;
            document.body.appendChild(toast);
            requestAnimationFrame(function () { requestAnimationFrame(function () { toast.classList.add('is-tampil'); }); });

            isiTombol(payBtn, IKON['check-circle'], 'Pembayaran Berhasil');

            setTimeout(function () {
                toast.classList.add('is-keluar');
                toast.classList.remove('is-tampil');
                setTimeout(function () { toast.remove(); }, 400);

                isiTombol(payBtn, IKON.scan, 'Scan &amp; Bayar');
                payBtn.classList.remove('lq-tombol--ok');
                input.value = '';
                nominal.textContent = 'Rp 0';
                qrKosong();
            }, 4000);
        }, 800);
    });

    // ---------- Kemiringan 3D: hanya tetikus, tidak saat gerak dikurangi ----------
    if (!gerakDikurangi && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        document.querySelectorAll('.lq-miring').forEach(function (kartu) {
            kartu.addEventListener('mousemove', function (e) {
                var r = kartu.getBoundingClientRect();
                var rx = ((e.clientY - r.top - r.height / 2) / (r.height / 2)) * -3;
                var ry = ((e.clientX - r.left - r.width / 2) / (r.width / 2)) * 3;
                kartu.style.transform = 'perspective(1000px) rotateX(' + rx + 'deg) rotateY(' + ry + 'deg)';
            });
            kartu.addEventListener('mouseenter', function () { kartu.classList.add('is-ikut'); });
            kartu.addEventListener('mouseleave', function () {
                kartu.classList.remove('is-ikut');
                kartu.style.transform = '';
            });
        });
    }
})();
