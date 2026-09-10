<?php 
$page_title = "SOP Penanganan Kendala SAPX | SIMASRIM CS";
$footer_desc = "Dokumen Internal Terbatas - Divisi Customer Service & Support.";
$base_path = '../';
include __DIR__ . '/../includes/header.php'; 
?>


<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--secondary);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase border border-white border-opacity-25 shadow-sm"><i class="fa-solid fa-headset me-2"></i>Customer Service</span>
        <h2 class="display-5 fw-bold mb-2">SOP Eskalasi & Kendala SAPX</h2>
        <p class="text-white-50 mb-0">Panduan khusus untuk penanganan komplain pengiriman SAPX via Kanal Digital Care Resmi.<br>Digunakan selama masa evaluasi limit omset berjalan.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">

        <div class="contact-box shadow-sm border-0">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-address-book me-2 text-danger"></i>Kanal Resmi Digital Care SAPX</h5>
            <p class="text-muted small mb-3">Sesuai kebijakan terbaru SAPX, eskalasi kendala paket saat ini <strong>TIDAK BISA</strong> dipantau via dashboard SIMASRIM dan tidak melalui grup WA Dedicated. Seluruh komplain harus diajukan manual oleh CS SIMASRIM ke kanal berikut:</p>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent px-2"><i class="fab fa-whatsapp text-success me-2"></i><strong>WhatsApp:</strong> <a href="https://wa.me/6280000000000" target="_blank">0800-0000-0000</a></li>
                        <li class="list-group-item bg-transparent px-2"><i class="fas fa-envelope text-primary me-2"></i><strong>Email:</strong> <a href="mailto:customercare@sap-express.co.id">customercare@sap-express.co.id</a></li>
                        <li class="list-group-item bg-transparent px-2"><i class="fas fa-globe text-info me-2"></i><strong>Live Chat:</strong> <a href="https://www.sapx.id" target="_blank">www.sapx.id</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent px-2"><i class="fab fa-facebook text-primary me-2"></i><strong>Facebook:</strong> <a href="https://www.facebook.com/SAPExpressOfficial" target="_blank">SAP Express Official</a></li>
                        <li class="list-group-item bg-transparent px-2"><i class="fab fa-instagram text-danger me-2"></i><strong>Instagram:</strong> <a href="https://instagram.com/sapx_express" target="_blank">@sapx_express</a></li>
                        <li class="list-group-item bg-transparent px-2"><i class="fas fa-store text-warning me-2"></i><strong>Lapak Satria:</strong> <a href="https://www.lapaksatria.id" target="_blank">www.lapaksatria.id</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="step-card shadow-sm">
            <div class="step-header">
                <div>
                    <span class="badge bg-danger mb-1 shadow-sm">Tahap 1: Lapor ke Pusat SAPX</span>
                    <h5 class="fw-bold mb-0 text-dark">Template Chat CS ke WA SAPX</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw1', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            <p class="text-muted small mb-3">Gunakan template ini untuk melaporkan komplain (seperti paket telat, rusak, atau belum di-pickup) ke WA Official SAPX <a href="https://wa.me/6280000000000" target="_blank" class="fw-bold text-success text-decoration-none">0800-0000-0000</a>.</p>
            
            <div class="chat-bubble">
                <span class="wa-bold">Halo Tim Customer Care SAPX,</span><br><br>
                Saya [Nama CS] dari tim Support <span class="wa-bold">SIMASRIM</span>. Izin memohon bantuan untuk eskalasi/pengecekan kendala paket dengan rincian berikut:<br><br>
                <span class="wa-bold">No. Resi (AWB):</span> [Isi Resi SAPX]<br>
                <span class="wa-bold">Nama Penerima:</span> [Isi Nama]<br>
                <span class="wa-bold">Kendala:</span> [Contoh: Paket belum di pick-up padahal sudah request / Paket tertahan di Hub / Paket rusak]<br><br>
                Mohon dibantu pengecekan dan tindak lanjutnya ya Tim. Terima kasih banyak. 🙏
            </div>
            <pre id="raw1" class="raw-wa-text">*Halo Tim Customer Care SAPX,*

Saya [Nama CS] dari tim Support *SIMASRIM*. Izin memohon bantuan untuk eskalasi/pengecekan kendala paket dengan rincian berikut:

*No. Resi (AWB):* [Isi Resi SAPX]
*Nama Penerima:* [Isi Nama]
*Kendala:* [Contoh: Paket belum di pick-up padahal sudah request / Paket tertahan di Hub / Paket rusak]

Mohon dibantu pengecekan dan tindak lanjutnya ya Tim. Terima kasih banyak. 🙏</pre>
        </div>

        <div class="step-card shadow-sm" style="border-left-color: var(--accent);">
            <div class="step-header">
                <div>
                    <span class="badge bg-warning text-dark mb-1 shadow-sm">Tahap 2: Update ke User SIMASRIM</span>
                    <h5 class="fw-bold mb-0 text-dark">Template Balasan ke User (Holding Message)</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw2', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            <p class="text-muted small mb-3">Gunakan pesan ini untuk menenangkan User SIMASRIM selama kita menunggu balasan dari pihak SAPX.</p>
            
            <div class="chat-bubble">
                <span class="wa-bold">Halo Kak [Nama User]!</span> Laporan kendala paket SAPX Kakak dengan resi <span class="wa-italic">[Nomor Resi]</span> sudah kami terima dengan baik ya. 📝<br><br>
                Saat ini tim CS SIMASRIM sedang mengawal dan menge-push langsung kasus ini ke <span class="wa-bold">Pusat Resolusi SAPX Express</span> agar segera ditindaklanjuti oleh kurir di lapangan.<br><br>
                Mengingat proses pengecekan dari pihak SAPX membutuhkan waktu, mohon kesediaannya menunggu ya Kak. Kami akan segera beri <span class="wa-italic">update</span> kalau sudah ada jawaban resmi dari pihak ekspedisi. Terima kasih atas kesabarannya! 🙏✨
            </div>
            <pre id="raw2" class="raw-wa-text">*Halo Kak [Nama User]!* Laporan kendala paket SAPX Kakak dengan resi _[Nomor Resi]_ sudah kami terima dengan baik ya. 📝

Saat ini tim CS SIMASRIM sedang mengawal dan menge-push langsung kasus ini ke *Pusat Resolusi SAPX Express* agar segera ditindaklanjuti oleh kurir di lapangan.

Mengingat proses pengecekan dari pihak SAPX membutuhkan waktu, mohon kesediaannya menunggu ya Kak. Kami akan segera beri _update_ kalau sudah ada jawaban resmi dari pihak ekspedisi. Terima kasih atas kesabarannya! 🙏✨</pre>
        </div>

        <div class="step-card shadow-sm" style="border-left-color: #17a2b8;">
            <div class="step-header">
                <div>
                    <span class="badge bg-info text-dark mb-1 shadow-sm">Tahap 3: Follow Up Lanjutan</span>
                    <h5 class="fw-bold mb-0 text-dark">Jika User Marah / Menagih Update Terus</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw3', this)"><i class="far fa-copy"></i> Salin Pesan</button>
            </div>
            <p class="text-muted small mb-3">Gunakan tameng ini jika SAPX lambat merespon dan user mulai komplain keras.</p>
            
            <div class="chat-bubble">
                Mohon maaf sekali atas ketidaknyamanannya Kak. Kami sangat mengerti kekhawatiran Kakak. 🥺<br><br>
                Sebagai informasi, tim SIMASRIM sudah meneruskan eskalasi ini berulang kali dengan status <span class="wa-bold text-danger">PRIORITAS</span> kepada pihak SAPX. Namun, saat ini antrean penanganan tiket di pusat SAPX sedang cukup padat.<br><br>
                Kami juga menyarankan Kakak selaku pengirim untuk ikut membantu mem-push laporannya melalui Live Chat di <a href="https://www.sapx.id" target="_blank">www.sapx.id</a> atau WhatsApp resmi mereka di <a href="https://wa.me/6280000000000" target="_blank" class="fw-bold text-success">0800-0000-0000</a> dengan menyebutkan nomor resinya agar penanganannya bisa ditekan dari dua arah. Kami akan tetap bantu pantau dari sini ya Kak! 🤝
            </div>
            <pre id="raw3" class="raw-wa-text">Mohon maaf sekali atas ketidaknyamanannya Kak. Kami sangat mengerti kekhawatiran Kakak. 🥺

Sebagai informasi, tim SIMASRIM sudah meneruskan eskalasi ini berulang kali dengan status *PRIORITAS* kepada pihak SAPX. Namun, saat ini antrean penanganan tiket di pusat SAPX sedang cukup padat.

Kami juga menyarankan Kakak selaku pengirim untuk ikut membantu mem-push laporannya melalui *Live Chat di www.sapx.id* atau WhatsApp resmi mereka di *0800-0000-0000* dengan menyebutkan nomor resinya agar penanganannya bisa ditekan dari dua arah. Kami akan tetap bantu pantau dari sini ya Kak! 🤝</pre>
        </div>

    </div>
</section>

<section class="py-5 bg-light-soft border-top">
    <div class="container py-4 followup-container">
        <h3 class="fw-bold text-center mb-5 text-primary"><i class="fas fa-exclamation-triangle me-2 text-warning"></i> Aturan Penting CS SIMASRIM</h3>
        
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 border shadow-sm h-100 text-center golden-rule-card">
                    <div class="icon-circle d-inline-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 text-danger mb-3" style="width: 50px; height: 50px; font-size: 1.2rem;">🚫</div>
                    <h5 class="fw-bold text-dark">Jangan Janjikan Waktu</h5>
                    <p class="small text-muted mb-0">Karena kita menggunakan kanal umum SAPX, waktu respon mereka tidak bisa diprediksi. Jangan pernah menjanjikan SLA pasti kepada user.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 border shadow-sm h-100 text-center golden-rule-card">
                    <div class="icon-circle d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning mb-3" style="width: 50px; height: 50px; font-size: 1.2rem;">⏱️</div>
                    <h5 class="fw-bold text-dark">Amankan Bukti Komplain</h5>
                    <p class="small text-muted mb-0">Pastikan meminta kelengkapan dari user sejak awal (Nomor Resi, Video Unboxing, Invoice harga) sebelum melapor ke WA SAPX agar proses tidak berbelit.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 border shadow-sm h-100 text-center golden-rule-card">
                    <div class="icon-circle d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success mb-3" style="width: 50px; height: 50px; font-size: 1.2rem;">📊</div>
                    <h5 class="fw-bold text-dark">Fase Evaluasi Sementara</h5>
                    <p class="small text-muted mb-0">SOP ini berlaku sementara hingga omset SAPX kita stabil dan akses Dedicated Team & Dashboard dibuka kembali oleh pusat SAPX.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>