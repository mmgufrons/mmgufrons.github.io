<?php 
$page_title = "Program Kompensasi Lion Parcel | SIMASRIM Operations";
$footer_desc = "Dokumen Internal Terbatas - Divisi Marketing & Customer Retention.";
$base_path = '../../';
include __DIR__ . '/../../includes/header.php'; 
?>

<style>
    /* Custom Styling untuk Program Khusus */
    .program-card {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .step-card {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.08);
        border-left: 5px solid #dc3545; /* Identitas Merah Lion Parcel */
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
        padding: 1.5rem;
        border: 1px solid #e9ecef;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        line-height: 1.6;
        font-size: 0.95rem;
    }
    .wa-bold { font-weight: 700; color: #000; }
    .wa-italic { font-style: italic; }
    .raw-wa-text { display: none !important; }
    
    /* Highlight Badge */
    .badge-lion { background-color: #dc3545; color: white; font-weight: 700; }
    .badge-strategy { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
</style>

<section class="hero-section text-center">
    <div class="hero-blob" style="top: -20%; right: -10%;"></div>
    <div class="hero-blob" style="bottom: 10%; left: -10%; background: var(--accent);"></div>
    
    <div class="container position-relative z-1">
        <span class="badge bg-white text-danger rounded-pill px-3 py-2 fw-bold mb-3 ls-2 text-uppercase shadow-sm"><i class="fas fa-gift me-2"></i>Marketing Campaign</span>
        <h2 class="display-5 fw-bold mb-2">Kompensasi Ekstra Cuan Lion Parcel</h2>
        <p class="text-white-50 mb-0">Portal Panduan Internal, Strategi Komunikasi Insentif Agen, dan Media Kit Siap Pakai.</p>
    </div>
</section>

<section class="py-5 position-relative z-2 mt-4">
    <div class="container followup-container">

        <div class="program-card border-start border-4 border-warning bg-light bg-opacity-50">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="badge badge-strategy px-3 py-2 rounded-pill"><i class="fas fa-brain me-1"></i> Analisa & Keuntungan Strategis</span>
            </div>
            <h5 class="fw-bold text-dark mb-2">Mengapa Menggunakan Angle "Kompensasi Cashback"?</h5>
            <p class="small text-muted mb-3">
                Kita secara ketat <strong>TIDAK MENGGUNAKAN</strong> istilah potongan harga atau diskon tambahan dalam kampanye umum ini guna melindungi stabilitas harga pasar ekspedisi. Dengan membingkainya sebagai <strong>"Apresiasi Kompensasi"</strong> atas pemeliharaan sistem beberapa ekspedisi sebelumnya, tim CS memiliki alasan logis (<i>leverage</i>) untuk memindahkan trafik harian pengguna SIMASRIM secara masif menuju <strong>Lion Parcel</strong>.
            </p>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded-3 border small h-100">
                        <strong class="text-dark d-block mb-1"><i class="fas fa-lock text-success me-1"></i> Retensi & Kunci Saldo</strong>
                        Insentif akumulasi 1% dicairkan dalam bentuk Saldo/Poin SIMASRIM pada bulan berikutnya (H+1). Hal ini secara tidak langsung memaksa pengguna melakukan transaksi berkelanjutan (<i>repeat order</i>) pada bulan baru.
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded-3 border small h-100">
                        <strong class="text-dark d-block mb-1"><i class="fas fa-chart-line text-primary me-1"></i> Perlindungan Cashflow</strong>
                        Sistem melakukan rekapulasi (<i>rekonsiliasi</i>) omset hanya pada paket berstatus <strong>Delivered</strong> di akhir bulan kalender, sehingga <i>cashflow</i> internal perusahaan tetap aman terkendali di awal pekan.
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5 mb-4">
            <h3 class="fw-bold text-dark"><i class="fas fa-copy text-primary me-2"></i>Media Kit & Teks Blast</h3>
            <p class="text-muted">Gunakan tombol salin di bawah ini untuk kebutuhan sebaran massal via WA Blast atau Notifikasi Aplikasi.</p>
        </div>

        <div class="step-card">
            <div class="step-header">
                <div>
                    <span class="badge badge-lion mb-1">WA Blast / Notifikasi Apps</span>
                    <h5 class="fw-bold mb-0 text-dark">Template Sebaran Campaign Pengguna SIMASRIM</h5>
                </div>
                <button class="btn-copy" onclick="copyWaText('raw_wa_lion', this)"><i class="far fa-copy"></i> Salin Teks Campaign</button>
            </div>
            
            <div class="chat-bubble">
                🚨 <strong>KOMPENSASI SPESIAL UNTUK MITRA SIMASRIM!</strong> 🚨<br><br>
                Halo Kak! 👋<br>
                Menyadari adanya penyesuaian sistem dan optimalisasi jaringan ekspedisi di SIMASRIM beberapa waktu terakhir, kami ingin memastikan kenyamanan bisnis Kakak tetap menjadi prioritas utama.<br><br>
                Sebagai wujud kompensasi dan apresiasi, nikmati program:<br>
                ✨ <strong>BOOST EKSTRA CASHBACK 1% LION PARCEL</strong> ✨<br><br>
                Kini, setiap paket yang Kakak kirim menggunakan armada Lion Parcel (REGPACK, JAGOPACK, ONEPACK, dll) akan dihitung sebagai tabungan ekstra cuan!<br><br>
                📜 <strong>Syarat & Ketentuan Berlaku:</strong><br>
                1. Program berlaku untuk seluruh Pengguna Spesial aktif SIMASRIM.<br>
                2. Ekstra Cashback 1% dihitung dari "Total Akumulasi Transaksi Ongkir Lion Parcel" milik Kakak dalam 1 bulan kalender (dimulai dari 18 Mei 2026).<br>
                3. Transaksi yang dihitung adalah paket dengan status "Berhasil Terkirim / Delivered" (bukan retur/batal).<br>
                4. Cashback ini bersifat "Tumpukan/Add-on" (Kakak tetap mendapatkan diskon kurir langsung di awal transaksi seperti biasa).<br>
                5. Saldo Cashback akan dicairkan ke dalam bentuk Poin SIMASRIM paling lambat setiap tanggal 7 di bulan berikutnya, dan bisa langsung digunakan untuk transaksi lagi!<br><br>
                Jangan sampai kelewatan! Yuk, alihkan semua paketan toko Kakak pakai Lion Parcel di SIMASRIM dan kumpulkan saldo gratisnya tiap akhir bulan. 🚀
            </div>
            <pre id="raw_wa_lion" class="raw-wa-text">🚨 *KOMPENSASI SPESIAL UNTUK MITRA SIMASRIM!* 🚨

Halo Kak! 👋 
Menyadari adanya penyesuaian sistem dan optimalisasi jaringan ekspedisi di SIMASRIM beberapa waktu terakhir, kami ingin memastikan kenyamanan bisnis Kakak tetap menjadi prioritas utama. 

Sebagai wujud kompensasi dan apresiasi, nikmati program:
✨ *BOOST EKSTRA CASHBACK 1% LION PARCEL* ✨

Kini, setiap paket yang Kakak kirim menggunakan armada Lion Parcel (REGPACK, JAGOPACK, ONEPACK, dll) akan dihitung sebagai tabungan ekstra cuan!

📜 *Syarat & Ketentuan Berlaku:*
1. Program berlaku untuk seluruh Pengguna Spesial aktif SIMASRIM.
2. Ekstra Cashback 1% dihitung dari "Total Akumulasi Transaksi Ongkir Lion Parcel" milik Kakak dalam 1 bulan kalender (dimulai dari 18 Mei 2026).
3. Transaksi yang dihitung adalah paket dengan status "Berhasil Terkirim / Delivered" (bukan retur/batal).
4. Cashback ini bersifat "Tumpukan/Add-on" (Kakak tetap mendapatkan diskon kurir langsung di awal transaksi seperti biasa).
5. Saldo Cashback akan dicairkan ke dalam bentuk Poin SIMASRIM paling lambat setiap tanggal 7 di bulan berikutnya, dan bisa langsung digunakan untuk transaksi lagi!

Jangan sampai kelewatan! Yuk, alihkan semua paketan toko Kakak pakai Lion Parcel di SIMASRIM dan kumpulkan saldo gratisnya tiap akhir bulan. 🚀</pre>
        </div>

    </div>
</section>

<script>
    function copyWaText(elementId, btnElement) {
        var textToCopy = document.getElementById(elementId).innerText;
        var tempTextArea = document.createElement("textarea");
        tempTextArea.value = textToCopy;
        document.body.appendChild(tempTextArea);
        tempTextArea.select();
        document.execCommand("copy");
        document.body.removeChild(tempTextArea);
        
        var originalText = btnElement.innerHTML;
        btnElement.innerHTML = '<i class="fas fa-check"></i> Disalin!';
        btnElement.classList.add('copied');
        
        setTimeout(function() {
            btnElement.innerHTML = originalText;
            btnElement.classList.remove('copied');
        }, 2000);
    }
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>