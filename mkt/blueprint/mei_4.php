<?php 
$page_title = "Active Blueprint Mei 2026 #4 | SIMASRIM CS";
$footer_desc = "Dokumen Internal Terbatas - Divisi Customer Service & Marketing.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>

<style>
    .step-card {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.08);
        border-left: 5px solid var(--primary);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .step-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    }
    .step-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }
    .chat-bubble {
        background: #f8f9fa;
        border-radius: 0 12px 12px 12px;
        padding: 1.2rem;
        border: 1px solid #e9ecef;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        line-height: 1.6;
        font-size: 0.95rem;
    }
    .wa-bold { font-weight: 700; color: #000; }
    .wa-italic { font-style: italic; }
    .raw-wa-text { display: none !important; }
    .btn-copy {
        background: white;
        border: 1px solid #ced4da;
        color: #495057;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-copy:hover {
        background: #e9ecef;
        color: #212529;
    }
    .btn-copy.copied {
        background: var(--wa-green, #25D366);
        border-color: var(--wa-green, #25D366);
        color: white;
    }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25"><i class="fa-solid fa-calendar-week me-2"></i>Active Blueprint</span>
        <h2 class="display-5 fw-bold mb-2">Pekan "Transisi & Layanan Prima"</h2>
        <p class="text-white-50 mb-0">Periode: 25 - 30 Mei 2026<br>Fokus Utama: Info Transisi JNE, Penanganan SPX, Libur Paxel, Video Panduan, & Push Akhir Bulan.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">
        
        <div class="text-center mb-5">
            <h3 class="fw-bold text-dark"><i class="fas fa-bullhorn me-2 text-primary"></i>Channel Pengumuman (Umum)</h3>
            <p class="text-muted">Broadcast ke seluruh channel info utama (Senin - Kamis).<br><strong class="text-danger">Catatan:</strong> Rabu, 27 Mei libur Idul Adha (jadwal ditiadakan).</p>
        </div>

        <!-- SENIN -->
        <div class="step-card" style="border-left-color: #0d6efd;">
            <div class="step-header">
                <div>
                    <span class="badge bg-primary mb-1">Senin, 25 Mei - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Informasi Transisi JNE (Sangat Penting)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_senin', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                📢 <strong>INFO PENTING: Pembaruan Layanan Kurir SIMASRIM</strong> 📢<br><br>
                Halo Sahabat SIMASRIM,<br><br>
                Untuk meningkatkan kualitas integrasi sistem dan standardisasi operasional, saat ini layanan pengiriman melalui ekspedisi JNE sedang memasuki tahap evaluasi dan penyelarasan berkala antara pihak SIMASRIM dan manajemen JNE.<br><br>
                Sehubungan dengan proses tersebut, <strong>menu pengiriman via JNE akan dinonaktifkan untuk sementara waktu.</strong><br><br>
                Jangan khawatir, seluruh proses operasional SIMASRIM tetap berjalan normal! Kakak tetap dapat menikmati layanan pengiriman terbaik, aman, dan hemat melalui berbagai mitra ekspedisi andalan lainnya (SAPX, J&T, SPX, J&T Cargo, Lion Parcel, Paxel, ID Express, Anteraja) yang tersedia di aplikasi.<br><br>
                Kami akan segera memberikan information lebih lanjut setelah proses penyelarasan ini selesai. Terima kasih atas pengertian dan dukungan setia Kakak kepada SIMASRIM. 🙏
            </div>
            <pre id="raw_senin" class="raw-wa-text">📢 *INFO PENTING: Pembaruan Layanan Kurir SIMASRIM* 📢

Halo Sahabat SIMASRIM,

Untuk meningkatkan kualitas integrasi sistem dan standardisasi operasional, saat ini layanan pengiriman melalui ekspedisi JNE sedang memasuki tahap evaluasi dan penyelarasan berkala antara pihak SIMASRIM dan manajemen JNE.

Sehubungan dengan proses tersebut, *menu pengiriman via JNE akan dinonaktifkan untuk sementara waktu.*

Jangan khawatir, seluruh proses operasional SIMASRIM tetap berjalan normal! Kakak tetap dapat menikmati layanan pengiriman terbaik, aman, dan hemat melalui berbagai mitra ekspedisi andalan lainnya (SAPX, J&T, SPX, J&T Cargo, Lion Parcel, Paxel, ID Express, Anteraja) yang tersedia di aplikasi.

Kami akan segera memberikan informasi lebih lanjut setelah proses penyelarasan ini selesai. Terima kasih atas pengertian dan dukungan setia Kakak kepada SIMASRIM. 🙏</pre>
            
            <div class="mt-3 p-3 bg-light border rounded">
                <strong class="text-danger d-block mb-1"><i class="fas fa-exclamation-triangle"></i> TIPS CS (Jika ada yang komplain personal soal JNE):</strong>
                <p class="small text-muted mb-0">"Saat ini dari pihak JNE memang sedang ada agenda bersih-bersih administrasi dan reviu kerja sama dengan seluruh mitra platform digitalnya, Kak. Jadi bukan karena kendala di sistem SIMASRIM-nya ya. Sembari menunggu proses evaluasi mereka selesai, silakan gunakan ekspedisi alternatif yang promo dan performanya tidak kalah bagus!"</p>
            </div>
        </div>

        <!-- SELASA -->
        <div class="step-card" style="border-left-color: #EE4D2D;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #EE4D2D;">Selasa, 26 Mei - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Prosedur Komplain SPX & Info Libur Paxel</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_selasa', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                Halo Kak! 👋<br><br>
                Terima kasih telah mempercayakan pengiriman paket Kakak melalui aplikasi kami. Kami informasikan bahwa saat ini layanan ekspedisi <strong>SPX Express</strong> sedang dalam pantauan ketat tim kami guna memastikan kelancaran operasional pengiriman Kakak (termasuk untuk transaksi COD).<br><br>
                💡 <strong>PENGUMUMAN PENTING (SPX):</strong><br>
                Apabila Kakak mengalami KENDALA apapun terkait pengiriman menggunakan SPX (seperti paket telat di-pickup, status resi tidak jalan, paket rusak/hilang, atau kendala retur), Kakak <strong>TIDAK PERLU menghubungi pihak SPX secara langsung.</strong><br><br>
                Silakan <strong>LANGSUNG LAPORKAN ke Customer Service (CS) kami</strong> dengan format:<br>
                - Nomor Resi: <br>
                - Kendala yang dialami:<br>
                - (Lampirkan foto/video jika barang rusak)<br><br>
                Tim CS kami yang akan langsung mengurus dan mengeskalasikan masalah tersebut ke pihak pusat SPX Express agar segera diselesaikan.<br><br>
                📦 <strong>INFO TAMBAHAN (LIBUR PAXEL BESOK):</strong><br>
                Sekedar mengingatkan, sehubungan dengan libur nasional Idul Adha, layanan ekspedisi <strong>Paxel akan libur operasional besok (Rabu, 27 Mei)</strong>. Bagi Kakak yang memiliki kiriman paket sameday atau cold chain via Paxel, mohon disesuaikan kembali jadwalnya ya. Hari Kamis operasional Paxel sudah kembali normal.<br><br>
                Terima kasih atas pengertiannya dan sukses selalu untuk usahanya! 🙏
            </div>
            <pre id="raw_selasa" class="raw-wa-text">Halo Kak! 👋

Terima kasih telah mempercayakan pengiriman paket Kakak melalui aplikasi kami. Kami informasikan bahwa saat ini layanan ekspedisi *SPX Express* sedang dalam pantauan ketat tim kami guna memastikan kelancaran operasional pengiriman Kakak (termasuk untuk transaksi COD).

💡 *PENGUMUMAN PENTING (SPX):*
Apabila Kakak mengalami KENDALA apapun terkait pengiriman menggunakan SPX (seperti paket telat di-pickup, status resi tidak jalan, paket rusak/hilang, atau kendala retur), Kakak *TIDAK PERLU menghubungi pihak SPX secara langsung.*

Silakan *LANGSUNG LAPORKAN ke Customer Service (CS) kami* dengan format:
- Nomor Resi: 
- Kendala yang dialami:
- (Lampirkan foto/video jika barang rusak)

Tim CS kami yang akan langsung mengurus dan mengeskalasikan masalah tersebut ke pihak pusat SPX Express agar segera diselesaikan.

📦 *INFO TAMBAHAN (LIBUR PAXEL BESOK):*
Sekedar mengingatkan, sehubungan dengan libur nasional Idul Adha, layanan ekspedisi *Paxel akan libur operasional besok (Rabu, 27 Mei)*. Bagi Kakak yang memiliki kiriman paket sameday atau cold chain via Paxel, mohon disesuaikan kembali jadwalnya ya. Hari Kamis operasional Paxel sudah kembali normal.

Terima kasih atas pengertiannya dan sukses selalu untuk usahanya! 🙏</pre>
        </div>

        <!-- RABU -->
        <div class="step-card" style="border-left-color: #6c757d;">
            <div class="step-header">
                <div>
                    <span class="badge mb-1" style="background: #6c757d;">Rabu, 27 Mei</span>
                    <h5 class="fw-bold mb-0 text-dark">Libur Idul Adha</h5>
                </div>
            </div>
            <div class="p-3 bg-light border rounded text-center">
                <p class="text-muted mb-0"><i class="fas fa-bed me-2"></i> Jadwal broadcast ditiadakan. Selamat Hari Raya Idul Adha 1447 H.</p>
            </div>
        </div>

        <!-- KAMIS -->
        <div class="step-card" style="border-left-color: #ffc107;">
            <div class="step-header">
                <div>
                    <span class="badge bg-warning text-dark mb-1">Kamis, 28 Mei - 10:00 WIB</span>
                    <h5 class="fw-bold mb-0 text-dark">Info Video Panduan YouTube & Libur Paxel</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_kamis', this)"><i class="far fa-copy"></i> Salin Teks WA</button>
            </div>
            
            <div class="chat-bubble">
                🎥 <strong>BELAJAR MAKIN GAMPANG DENGAN VIDEO PANDUAN!</strong> 🎥<br><br>
                Halo Kak! Gimana liburannya kemaren?<br>
                Buat Kakak yang masih bingung cara transaksi di aplikasi, sekarang nggak perlu repot lagi! Tim SIMASRIM udah nyiapin <strong>Video Panduan Lengkap (Tahap 1)</strong> yang ngebahas cara Pengiriman, transaksi PPOB, beli Tiket, sampai panduan mesin EDC.<br><br>
                Kakak bisa langsung cek videonya di website simasrim.com atau meluncur ke Channel YouTube kita di: <a href="https://www.youtube.com/@SIMASRIM-app" target="_blank" class="fw-bold text-primary text-decoration-none">https://www.youtube.com/@SIMASRIM-app</a>. Jangan lupa di-<i>subscribe</i> biar nggak ketinggalan update panduan berikutnya ya!<br><br>
                📦 <strong>INFO TAMBAHAN (PAXEL):</strong><br>
                Sekedar mengingatkan, layanan <strong>Paxel</strong> kemaren ikut libur Idul Adha (27 Mei), dan hari ini (28 Mei) operasionalnya sudah <strong>KEMBALI NORMAL</strong>. Yuk langsung gaskeun lagi kiriman <i>sameday</i> dan <i>cold chain</i> Kakak! 🚀
            </div>
            <pre id="raw_kamis" class="raw-wa-text">🎥 *BELAJAR MAKIN GAMPANG DENGAN VIDEO PANDUAN!* 🎥

Halo Kak! Gimana liburannya kemaren?
Buat Kakak yang masih bingung cara transaksi di aplikasi, sekarang nggak perlu repot lagi! Tim SIMASRIM udah nyiapin *Video Panduan Lengkap (Tahap 1)* yang ngebahas cara Pengiriman, transaksi PPOB, beli Tiket, sampai panduan mesin EDC.

Kakak bisa langsung cek videonya di website simasrim.com atau meluncur ke Channel YouTube kita di: https://www.youtube.com/@SIMASRIM-app. Jangan lupa di-_subscribe_ biar nggak ketinggalan update panduan berikutnya ya!

📦 *INFO TAMBAHAN (PAXEL):*
Sekedar mengingatkan, layanan *Paxel* kemaren ikut libur Idul Adha (27 Mei), dan hari ini (28 Mei) operasionalnya sudah *KEMBALI NORMAL*. Yuk langsung gaskeun lagi kiriman _sameday_ dan _cold chain_ Kakak! 🚀</pre>
        </div>


        <div class="text-center mt-5 mb-4">
            <h3 class="fw-bold text-dark"><i class="fas fa-users me-2 text-success"></i>Broadcast Grup Spesifik</h3>
            <p class="text-muted">Kirimkan ke masing-masing grup pada hari Jumat & Sabtu.</p>
        </div>

        <!-- JUMAT -->
        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #198754; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-success mb-1">Jumat, 29 Mei - 10:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 1 (VIP)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_jumat_1', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Halo Juragan! ☕ Gimana rekap omzet abis liburan nih? Bentar lagi tutup buku bulan Mei lho. Pastikan semua agen di bawah Bapak/Ibu udah dikasih info ya soal transisi JNE, biar kiriman mereka tetep lancar pakai ekspedisi lain. Sekalian arahin mereka buat nonton Video Panduan di YouTube SIMASRIM biar agen-agennya makin mandiri dan pinter jualannya. Sukses kejar target akhir bulan, Juragan! 💪
                    </div>
                    <pre id="raw_jumat_1" class="raw-wa-text">Halo Juragan! ☕ Gimana rekap omzet abis liburan nih? Bentar lagi tutup buku bulan Mei lho. Pastikan semua agen di bawah Bapak/Ibu udah dikasih info ya soal transisi JNE, biar kiriman mereka tetep lancar pakai ekspedisi lain. Sekalian arahin mereka buat nonton Video Panduan di YouTube SIMASRIM biar agen-agennya makin mandiri dan pinter jualannya. Sukses kejar target akhir bulan, Juragan! 💪</pre>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #0dcaf0; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-info text-dark mb-1">Jumat, 29 Mei - 14:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 2 (Standar)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_jumat_2', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Siang Kak! 👋 Menjelang akhir pekan dan akhir bulan nih, jangan sampai kendor semangatnya! Pastikan Kakak udah manfaatin kurir alternatif lain ya buat gantiin JNE sementara. Udah pada cek Video Panduan di YouTube SIMASRIM belum? Lumayan lho buat nambah ilmu cara transaksi PPOB sama Tiket biar loketnya makin rame. Gaspol cuan akhir bulannya Kak! 🚀
                    </div>
                    <pre id="raw_jumat_2" class="raw-wa-text">Siang Kak! 👋 Menjelang akhir pekan dan akhir bulan nih, jangan sampai kendor semangatnya! Pastikan Kakak udah manfaatin kurir alternatif lain ya buat gantiin JNE sementara. Udah pada cek Video Panduan di YouTube SIMASRIM belum? Lumayan lho buat nambah ilmu cara transaksi PPOB sama Tiket biar loketnya makin rame. Gaspol cuan akhir bulannya Kak! 🚀</pre>
                </div>
            </div>
        </div>

        <!-- SABTU -->
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #198754; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-success mb-1">Sabtu, 30 Mei - 10:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 1 (VIP)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_sabtu_1', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Selamat pagi Juragan! Happy Weekend! 🎉<br><br>
                        Hari terakhir di bulan Mei nih. Yuk kita maksimalkan <b>push</b> ke agen-agen yang transaksinya masih nanggung. Kalau ada yang komplain soal SPX, arahin buat langsung lapor ke CS aja ya biar kita yang bantu urus ke pusat. Sambil santai, boleh tuh di-share link YouTube SIMASRIM ke grup agen Bapak/Ibu. Mari tutup bulan ini dengan omzet maksimal!
                    </div>
                    <pre id="raw_sabtu_1" class="raw-wa-text">Selamat pagi Juragan! Happy Weekend! 🎉

Hari terakhir di bulan Mei nih. Yuk kita maksimalkan *push* ke agen-agen yang transaksinya masih nanggung. Kalau ada yang komplain soal SPX, arahin buat langsung lapor ke CS aja ya biar kita yang bantu urus ke pusat. Sambil santai, boleh tuh di-share link YouTube SIMASRIM ke grup agen Bapak/Ibu. Mari tutup bulan ini dengan omzet maksimal!</pre>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="step-card h-100" style="border-left-color: #0dcaf0; margin-bottom: 0;">
                    <div class="step-header">
                        <div>
                            <span class="badge bg-info text-dark mb-1">Sabtu, 30 Mei - 14:00 WIB</span>
                            <h5 class="fw-bold mb-0 text-dark">Grup 2 (Standar)</h5>
                        </div>
                        <button class="btn-copy btn-sm" onclick="copyWaText('raw_sabtu_2', this)">Salin</button>
                    </div>
                    <div class="chat-bubble" style="font-size: 0.85rem;">
                        Happy Weekend Kak! 👋 Hari libur loket tetep buka kan?<br><br>
                        Mumpung akhir bulan, yuk <b>closing</b> dengan orderan yang banyak! Inget ya Kak, kalau ada kendala sama SPX, nggak perlu pusing nelpon mereka, langsung lapor CS SIMASRIM aja biar kita yang urus. Semangat <b>closing</b> akhir bulan, semoga target cuannya tembus ya Kak! 📦✨
                    </div>
                    <pre id="raw_sabtu_2" class="raw-wa-text">Happy Weekend Kak! 👋 Hari libur loket tetep buka kan?

Mumpung akhir bulan, yuk *closing* dengan orderan yang banyak! Inget ya Kak, kalau ada kendala sama SPX, nggak perlu pusing nelpon mereka, langsung lapor CS SIMASRIM aja biar kita yang urus. Semangat *closing* akhir bulan, semoga target cuannya tembus ya Kak! 📦✨</pre>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>