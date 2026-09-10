<?php 
$page_title = "SOP Pickup & First Handle | SIMASRIM Operations";
$footer_desc = "Dokumen Internal Rahasia - Divisi Operasional & Customer Service.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>

<style>
    .step-card { background: #ffffff; border: 1px solid rgba(0,0,0,0.08); border-left: 5px solid var(--primary); border-radius: 16px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); transition: transform 0.3s ease; }
    .step-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.05); }
    .step-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; }
    
    .chat-bubble { background: #f8f9fa; border-radius: 0 12px 12px 12px; padding: 1.2rem; border: 1px solid #e9ecef; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.6; font-size: 0.95rem; margin-bottom: 1rem; }
    .chat-bubble.cs-reply { border-left: 5px solid #0dcaf0; }
    .wa-bold { font-weight: 700; color: #000; }
    .raw-wa-text { display: none !important; }
    .btn-copy { background: white; border: 1px solid #ced4da; color: #495057; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600; transition: all 0.2s ease; cursor: pointer; white-space: nowrap;}
    .btn-copy:hover { background: #e9ecef; color: #212529; }
    .btn-copy.copied { background: var(--primary); border-color: var(--primary); color: white; }
    
    .section-divider { display: flex; align-items: center; margin: 3rem 0 2rem; }
    .section-divider::before, .section-divider::after { content: ""; flex: 1; border-bottom: 2px dashed #ddd; }
    .section-divider span { padding: 0 15px; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 1px; }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--primary);"></div>
    <div class="container position-relative z-1">
        <span class="badge bg-success text-white rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm border border-success"><i class="fas fa-book me-2"></i>Standard Operating Procedure</span>
        <h2 class="display-5 fw-bold mb-2 text-white">SOP Pickup & First Handle Jaringan</h2>
        <p class="text-white-50 mb-0">Pipeline Drip Manual CS untuk Onboarding Agen Baru & Standarisasi Laporan Kendala Mitra Area.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-2">
    <div class="container followup-container">

        <div class="alert alert-info border-info border-opacity-25 shadow-sm rounded-4 p-4 mb-5 d-flex align-items-start gap-3">
            <i class="fas fa-cogs fs-2 text-info mt-1"></i>
            <div>
                <h5 class="fw-bold text-dark mb-1">Catatan Pengawalan Sistem IT (Sedang Berjalan)</h5>
                <p class="small text-muted mb-0">
                    Sistem <strong>Request Pickup / Drop Off In-App</strong> saat ini SEDANG DISIAPKAN oleh tim IT. Ke depannya, akan ada opsi otomatis di aplikasi di mana titik pickup berpindah ke <strong>QSir Hub</strong> terdekat (contoh: Malang). Sistem <i>Handover</i> (manifest serah terima) juga sudah termasuk dan dipisah per ekspedisi. <br>
                    <i>*SOP di halaman ini merupakan penanganan transisi (Manual by CS) sebelum sistem otomasi API In-App rilis sepenuhnya.</i>
                </p>
            </div>
        </div>

        <div class="section-divider"><span><i class="fas fa-headset me-2"></i>PIPELINE CS: ONBOARDING AGEN BARU</span></div>

        <div class="step-card" style="border-left-color: #20c997;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #20c997; color: #fff;">H+1 (Setelah Daftar)</span>
                    <h5 class="fw-bold mb-0 text-dark">First Handle: Welcome Message & Format Pickup</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_h1', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            <p class="small text-muted mb-3">Kirimkan pesan ini segera setelah agen baru di bawah jaringan Mitra Area selesai mendaftar dan akunnya aktif.</p>
            
            <div class="chat-bubble">
                Halo Kak! Selamat datang di Ekosistem SIMASRIM. 🚀<br>
                Akun Kakak sudah aktif dan siap digunakan untuk kirim paket dengan diskon maksimal!<br><br>
                Agar kurir bisa langsung meluncur ke lokasi Kakak untuk menjemput paket (Pick-up), mohon simpan dan gunakan format request berikut jika baru pertama kali kirim atau jika ada kendala pickup di lapangan:<br><br>
                📦 <span class="wa-bold">FORMAT REQUEST PICKUP SIMASRIM</span><br>
                - Nama Agen/Toko: <br>
                - ID Akun SIMASRIM: <br>
                - Ekspedisi (JNE/J&T/dll): <br>
                - Jumlah Paket: <br>
                - Alamat Detail (Patokan): <br>
                - Shareloc (Google Maps): <br><br>
                Kirimkan format ini ke CS kami setiap kali ada request khusus. Selamat bertransaksi dan cuan bareng SIMASRIM! 🔥
            </div>
            <pre id="raw_h1" class="raw-wa-text">Halo Kak! Selamat datang di Ekosistem SIMASRIM. 🚀
Akun Kakak sudah aktif dan siap digunakan untuk kirim paket dengan diskon maksimal!

Agar kurir bisa langsung meluncur ke lokasi Kakak untuk menjemput paket (Pick-up), mohon simpan dan gunakan format request berikut jika baru pertama kali kirim atau jika ada kendala pickup di lapangan:

📦 *FORMAT REQUEST PICKUP SIMASRIM*
- Nama Agen/Toko: 
- ID Akun SIMASRIM: 
- Ekspedisi (JNE/J&T/dll): 
- Jumlah Paket: 
- Alamat Detail (Patokan): 
- Shareloc (Google Maps): 

Kirimkan format ini ke CS kami setiap kali ada request khusus. Selamat bertransaksi dan cuan bareng SIMASRIM! 🔥</pre>
        </div>

        <div class="step-card" style="border-left-color: #fd7e14;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #fd7e14; color: #fff;">H+3 (Belum Transaksi)</span>
                    <h5 class="fw-bold mb-0 text-dark">Follow-Up: Edukasi Cetak Resi</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_h3', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            <p class="small text-muted mb-3">Kirimkan pesan ini jika dalam 3 hari setelah pendaftaran agen belum melakukan percobaan cetak resi pengiriman sama sekali.</p>
            
            <div class="chat-bubble">
                Halo Kak! 👋 Gimana kabarnya hari ini? Mimin perhatiin Kakak belum cobain cetak resi pengiriman nih di aplikasi SIMASRIM.<br><br>
                Apakah ada kendala saat masuk ke menu aplikasinya? Atau masih bingung cara atur alamat pickup-nya?<br><br>
                Jangan ragu buat tanya Mimin ya Kak! Ingat, semua paket yang Kakak proses lewat SIMASRIM <span class="wa-bold">bisa di-pickup GRATIS</span> langsung ke rumah/toko Kakak tanpa minimal paket lho. Yuk pecah telor resi pertamanya hari ini! 📦✨
            </div>
            <pre id="raw_h3" class="raw-wa-text">Halo Kak! 👋 Gimana kabarnya hari ini? Mimin perhatiin Kakak belum cobain cetak resi pengiriman nih di aplikasi SIMASRIM.

Apakah ada kendala saat masuk ke menu aplikasinya? Atau masih bingung cara atur alamat pickup-nya?

Jangan ragu buat tanya Mimin ya Kak! Ingat, semua paket yang Kakak proses lewat SIMASRIM *bisa di-pickup GRATIS* langsung ke rumah/toko Kakak tanpa minimal paket lho. Yuk pecah telor resi pertamanya hari ini! 📦✨</pre>
        </div>

        <div class="step-card" style="border-left-color: #0dcaf0;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #0dcaf0; color: #fff;">H+7 (Maintenance / Push)</span>
                    <h5 class="fw-bold mb-0 text-dark">Broadcast Promo & Pancingan Transaksi</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_h7', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            <p class="small text-muted mb-3">Kirimkan sebagai <i>trigger</i> transaksi dengan memberikan informasi menarik terkait komisi / diskon ekspedisi terbaru.</p>
            
            <div class="chat-bubble">
                🔥 <span class="wa-bold">KABAR GEMBIRA! DISKON EKSPEDISI MAKIN NAIK!</span> 🔥<br><br>
                Halo Kakak Agen SIMASRIM! Biar makin semangat jualannya, Mimin mau kasih info update ekspedisi nih.<br><br>
                Tahukah Kakak? Kirim paket berat pakai <span class="wa-bold">J&T Cargo</span> sekarang diskonnya makin mantap lho! Belum lagi ada kurir andalan seperti <span class="wa-bold">Anteraja</span> dan <span class="wa-bold">ID Express</span> yang siap jemput paket ringan Kakak dengan tarif kompetitif.<br><br>
                Makin banyak transaksi Non-COD yang Kakak input, makin besar peluang diskon Kakak naik ke Tier maksimal (Tiering). Yuk borong cetak resinya hari ini! 🚀💸
            </div>
            <pre id="raw_h7" class="raw-wa-text">🔥 *KABAR GEMBIRA! DISKON EKSPEDISI MAKIN NAIK!* 🔥

Halo Kakak Agen SIMASRIM! Biar makin semangat jualannya, Mimin mau kasih info update ekspedisi nih.

Tahukah Kakak? Kirim paket berat pakai *J&T Cargo* sekarang diskonnya makin mantap lho! Belum lagi ada kurir andalan seperti *Anteraja* dan *ID Express* yang siap jemput paket ringan Kakak dengan tarif kompetitif.

Makin banyak transaksi Non-COD yang Kakak input, makin besar peluang diskon Kakak naik ke Tier maksimal (Tiering). Yuk borong cetak resinya hari ini! 🚀💸</pre>
        </div>

        <div class="section-divider"><span><i class="fas fa-exclamation-circle me-2"></i>STANDAR PELAPORAN MITRA AREA</span></div>

        <div class="step-card" style="border-left-color: #dc3545;">
            <div class="step-header">
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Format Lapor Kendala Pickup (Untuk Mitra Area)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_lapor', this)"><i class="far fa-copy"></i> Salin Format</button>
            </div>
            <p class="small text-muted mb-3">Bagikan format baku ini ke dalam Grup Mitra Area. Jika ada jaringan agen mereka yang komplain paket belum dijemput, Mitra wajib menyetorkan laporan ke CS Pusat menggunakan format ini agar langsung diteruskan ke vendor ekspedisi.</p>
            
            <div class="chat-bubble border-danger bg-light">
                🚨 <span class="wa-bold">LAPORAN KENDALA PICKUP AGEN</span><br>
                - Asal Jaringan (Nama Mitra Area): <br>
                - Nomor Resi / Order ID: <br>
                - Ekspedisi: <br>
                - Waktu Request Awal: <br>
                - Detail Kendala: (Contoh: Kurir belum datang dari kemarin / Kurir tidak tahu lokasi patokan)<br>
                - Kontak Agen (No WA): 
            </div>
            <pre id="raw_lapor" class="raw-wa-text">🚨 *LAPORAN KENDALA PICKUP AGEN*
- Asal Jaringan (Nama Mitra Area): 
- Nomor Resi / Order ID: 
- Ekspedisi: 
- Waktu Request Awal: 
- Detail Kendala: (Contoh: Kurir belum datang dari kemarin / Kurir tidak tahu lokasi patokan)
- Kontak Agen (No WA): </pre>
        </div>

    </div>
</section>

<script>
    function copyWaText(id, btn) {
        let text = document.getElementById(id).textContent;
        let temp = document.createElement("textarea");
        temp.value = text;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        document.body.removeChild(temp);
        
        let originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Disalin!';
        btn.classList.add('bg-success', 'text-white', 'border-success');
        setTimeout(() => { 
            btn.innerHTML = originalText; 
            btn.classList.remove('bg-success', 'text-white', 'border-success'); 
        }, 2000);
    }
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>