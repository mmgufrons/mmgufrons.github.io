<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MKT — Marketing OS</title>
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='16' fill='%230b0d12'/%3E%3Ctext x='32' y='43' font-family='Arial, sans-serif' font-weight='700' font-size='26' fill='%236ea8fe' text-anchor='middle'%3EMG%3C/text%3E%3C/svg%3E">
<meta name="description" content="Suite tools marketing & CS PT SMA / SIMASRIM: campaign, mitra, B2B, PPOB, laporan, dan dokumen legal dalam satu tempat.">
<style>
  :root{
    --bg:#0b0d12; --panel:#12151c; --panel-2:#171b24; --border:#232838;
    --text:#eef1f8; --muted:#9aa3b8; --accent:#6ea8fe; --accent-2:#7ee0c1;
  }
  *{box-sizing:border-box;}
  body{margin:0;background:var(--bg);color:var(--text);font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Inter,Roboto,sans-serif;}
  header{padding:56px 24px 32px;text-align:center;background:radial-gradient(circle at top, rgba(110,168,254,0.12), transparent 60%);}
  header h1{margin:0 0 10px;font-size:clamp(28px,4vw,42px);}
  header p{margin:0 auto;max-width:640px;color:var(--muted);font-size:15px;line-height:1.6;}
  .badge{display:inline-block;background:rgba(126,224,193,0.12);color:var(--accent-2);border:1px solid rgba(126,224,193,0.3);padding:4px 12px;border-radius:99px;font-size:12px;font-weight:600;letter-spacing:.02em;margin-bottom:16px;}
  main{max-width:1180px;margin:0 auto;padding:0 24px 80px;}
  .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:18px;}
  .card{background:var(--panel);border:1px solid var(--border);border-radius:16px;overflow:hidden;display:flex;flex-direction:column;transition:transform .2s ease, border-color .2s ease;}
  .card:hover{transform:translateY(-4px);border-color:var(--accent);}
  .thumb{height:100px;display:flex;align-items:center;justify-content:center;font-size:34px;background:linear-gradient(135deg,#1a2036,#0b0d12);}
  .body{padding:16px 18px 18px;display:flex;flex-direction:column;gap:8px;flex:1;}
  .body h3{margin:0;font-size:16px;}
  .body p{margin:0;color:var(--muted);font-size:13px;line-height:1.5;flex:1;}
  .cta{margin-top:auto;display:inline-block;text-align:center;background:var(--accent);color:#081018;font-weight:700;font-size:13px;padding:9px 14px;border-radius:9px;text-decoration:none;}
  .cta:hover{opacity:.9;}
  footer{text-align:center;color:var(--muted);font-size:12px;padding:28px 24px 48px;}
  footer a{color:var(--accent);}
  .back-link{display:inline-flex;align-items:center;gap:6px;color:var(--muted);font-size:13px;text-decoration:none;padding:16px 24px 0;}
  .back-link:hover{color:var(--accent);}
</style>
</head>
<body>

<a class="back-link" href="../index.html">← Kembali ke Portofolio Utama</a>

<header>
  <div class="badge">Marketing OS</div>
  <h1>MKT — Marketing OS</h1>
  <p>Satu pintu masuk ke tools yang dipakai tim marketing & CS sehari-hari — mulai dari kerja sama
  mitra, tracking campaign, sampai laporan performa. Pilih modul di bawah untuk mulai menjelajahi.</p>
</header>

<main>
  <div class="grid">

    <div class="card">
      <div class="thumb">🛠️</div>
      <div class="body">
        <h3>Admin Panel</h3>
        <p>Panel pengelolaan pengguna & pengaturan operasional Marketing OS.</p>
        <a class="cta" href="admin_panel.php">Buka Admin Panel</a>
      </div>
    </div>

    <div class="card">
      <div class="thumb">🤝</div>
      <div class="body">
        <h3>Partner B2B</h3>
        <p>Tracker kerja sama B2B — progres prospek dari penjajakan sampai onboarding.</p>
        <a class="cta" href="partner/b2b.php">Buka Partner B2B</a>
      </div>
    </div>

    <div class="card">
      <div class="thumb">🧭</div>
      <div class="body">
        <h3>Mitra Tracker</h3>
        <p>Pantau progres dan status seluruh mitra kanvassing dalam satu papan kerja.</p>
        <a class="cta" href="mitra/tracker.php">Buka Mitra Tracker</a>
      </div>
    </div>

    <div class="card">
      <div class="thumb">📈</div>
      <div class="body">
        <h3>Campaign Tracker</h3>
        <p>Rekap dan pantau performa campaign marketing yang sedang berjalan.</p>
        <a class="cta" href="campaign/campaign-tracker/index.php">Buka Campaign Tracker</a>
      </div>
    </div>

    <div class="card">
      <div class="thumb">💳</div>
      <div class="body">
        <h3>PPOB Dashboard</h3>
        <p>Dashboard transaksi & performa layanan PPOB secara ringkas.</p>
        <a class="cta" href="data/ppob/index.php">Buka PPOB Dashboard</a>
      </div>
    </div>

    <div class="card">
      <div class="thumb">🛒</div>
      <div class="body">
        <h3>MP Report</h3>
        <p>Laporan performa marketplace & live shopping dalam satu tampilan.</p>
        <a class="cta" href="data/mp-report/index.php">Buka MP Report</a>
      </div>
    </div>

    <div class="card">
      <div class="thumb">📑</div>
      <div class="body">
        <h3>Legal Tools</h3>
        <p>Pengelolaan dokumen legal & kepatuhan kerja sama secara terpusat.</p>
        <a class="cta" href="tools/legal/index.php">Buka Legal Tools</a>
      </div>
    </div>

  </div>
</main>

<footer>
  Login dengan password demo publik saat diminta. Bagian dari <a href="../index.html">hub portofolio</a>.
</footer>

</body>
</html>
