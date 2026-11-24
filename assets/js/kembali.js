// Tombol "Kembali" pintar untuk elemen bertanda data-kembali.
// Kenapa: pengunjung bisa tiba di halaman karya/tool dari beberapa tempat (tab beranda, galeri,
// studi kasus Growth). Kembali ke halaman asalnya lebih wajar daripada selalu dilempar ke beranda.
// Bila pengunjung datang dari luar situs (Google, tautan langsung), href elemen dipakai sebagai
// induk cadangan, jadi tautan tetap berfungsi tanpa JavaScript.
(function () {
  function dariSitusIni() {
    try {
      var r = new URL(document.referrer);
      return r.origin === location.origin && r.href !== location.href;
    } catch (e) {
      return false;
    }
  }

  document.addEventListener('click', function (e) {
    var a = e.target.closest ? e.target.closest('[data-kembali]') : null;
    if (!a) return;
    // Biarkan buka-di-tab-baru (Ctrl/Cmd/Shift/klik tengah) berjalan normal.
    if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
    if (dariSitusIni() && history.length > 1) {
      e.preventDefault();
      history.back();
    }
  });
})();
