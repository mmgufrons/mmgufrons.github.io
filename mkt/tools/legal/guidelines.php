<?php 
$page_title = "S.O.P & Guidelines LDMS | SIMASRIM";
$base_path = "../../";
include '../../includes/header.php';
?>

<!-- Hero Section with B2B Style -->
<div class="relative bg-gradient-to-tr from-[#3A1B5E] via-[#1F0D3D] to-[#0f0c29] text-white pt-20 pb-16 overflow-hidden">
    <div class="absolute w-[600px] h-[600px] bg-[#F3700D] blur-[180px] opacity-20 rounded-full top-[-100px] right-[-100px] z-0"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="text-4xl font-extrabold mb-4" data-aos="fade-up">S.O.P & Guidelines <span class="text-[#F3700D]">LDMS.</span></h1>
        <p class="text-lg text-purple-200 mb-8 max-w-2xl" data-aos="fade-up" data-aos-delay="100">
            Panduan dasar untuk standarisasi penyusunan dokumen hukum B2B. 
            Sudut pandang PT Solusi Mitra Aplikasi berfokus sebagai <strong>"Aggregator & Provider"</strong>.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20 pb-12">
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden flex flex-col md:flex-row min-h-[500px]" data-aos="fade-up" data-aos-delay="200">
        
        <!-- Sidebar Navigation -->
        <div class="w-full md:w-1/3 lg:w-1/4 bg-gray-50 border-r border-gray-100 p-6">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4 px-3">Daftar Panduan</h3>
            <nav class="space-y-2" id="guideline-tabs">
                <button data-target="tab-a" class="tab-btn w-full flex items-center gap-3 px-4 py-3 text-left rounded-xl font-semibold text-sm transition-all bg-white text-[#7335B7] shadow-sm border border-gray-200">
                    <i class="fa-solid fa-user-tie w-5 text-center"></i> Legal Standing
                </button>
                <button data-target="tab-b" class="tab-btn w-full flex items-center gap-3 px-4 py-3 text-left rounded-xl font-medium text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-all border border-transparent">
                    <i class="fa-solid fa-arrow-down-1-9 w-5 text-center"></i> Nomor Dokumen
                </button>
                <button data-target="tab-c" class="tab-btn w-full flex items-center gap-3 px-4 py-3 text-left rounded-xl font-medium text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-all border border-transparent">
                    <i class="fa-solid fa-stamp w-5 text-center"></i> Meterai & TTD
                </button>
                <button data-target="tab-d" class="tab-btn w-full flex items-center gap-3 px-4 py-3 text-left rounded-xl font-medium text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-all border border-transparent">
                    <i class="fa-solid fa-file-contract w-5 text-center"></i> Adendum
                </button>
                <button data-target="tab-e" class="tab-btn w-full flex items-center gap-3 px-4 py-3 text-left rounded-xl font-medium text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-all border border-transparent">
                    <i class="fa-solid fa-shield-halved w-5 text-center"></i> Limitation of Liability
                </button>
            </nav>
        </div>
        
        <!-- Content Area -->
        <div class="w-full md:w-2/3 lg:w-3/4 p-8 lg:p-12 bg-white relative">
            
            <!-- Content A -->
            <div id="tab-a" class="tab-content block animate-fadeIn">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center text-2xl shadow-sm mb-6">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 mb-4">Validitas Penandatangan</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Sangat penting untuk memastikan bahwa pihak yang menandatangani dokumen memiliki kedudukan hukum (legal standing) yang sah untuk mewakili perusahaannya. Pastikan nama pihak yang menandatangani perjanjian sesuai dengan identitas KTP dan tercantum di Akta Perusahaan (misalnya Direktur Utama atau Direktur).
                </p>
                <div class="bg-blue-50 border-l-4 border-blue-500 p-5 rounded-r-xl shadow-sm">
                    <h4 class="font-bold text-blue-900 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation"></i> Pengecualian Kasus
                    </h4>
                    <p class="text-sm text-blue-800 leading-relaxed">
                        Jika pihak yang berhadapan adalah perwakilan area, manajer cabang, atau pihak lain yang namanya tidak ada di dalam Akta Perusahaan, maka mereka <strong>WAJIB</strong> melampirkan Surat Kuasa Resmi. Alternatif lainnya adalah menambahkan kolom <em>"Mengetahui"</em> di halaman tanda tangan untuk ditandatangani oleh Direksi yang berwenang.
                    </p>
                </div>
            </div>

            <!-- Content B -->
            <div id="tab-b" class="tab-content hidden animate-fadeIn">
                <div class="w-14 h-14 rounded-2xl bg-orange-50 text-[#F3700D] border border-orange-100 flex items-center justify-center text-2xl shadow-sm mb-6">
                    <i class="fa-solid fa-arrow-down-1-9"></i>
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 mb-4">Aturan Jumlah Nomor Surat</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Sistem penomoran sangat bergantung pada jenis dokumen (bilateral atau sepihak). Ikuti standarisasi berikut untuk menghindari dokumen yang tidak tercatat secara administratif di kedua belah pihak.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="border border-gray-200 rounded-xl p-5 hover:border-[#F3700D] transition-colors">
                        <div class="text-green-500 mb-3"><i class="fa-solid fa-handshake text-3xl"></i></div>
                        <h4 class="font-bold text-gray-800 mb-2">PKS Utama (Bilateral)</h4>
                        <p class="text-sm text-gray-600">
                            WAJIB mencantumkan <strong>2 (dua)</strong> nomor surat di bagian atas dokumen. Satu baris untuk Nomor Surat Pihak Pertama (Kita), dan satu baris untuk Nomor Surat Pihak Kedua (Mitra).
                        </p>
                    </div>
                    <div class="border border-gray-200 rounded-xl p-5 hover:border-[#F3700D] transition-colors">
                        <div class="text-blue-500 mb-3"><i class="fa-solid fa-file-signature text-3xl"></i></div>
                        <h4 class="font-bold text-gray-800 mb-2">NDA / Penunjukan (Sepihak)</h4>
                        <p class="text-sm text-gray-600">
                            Cukup menggunakan <strong>1 (satu)</strong> nomor surat resmi. Biasanya menggunakan nomor surat dari pihak yang menerbitkan / merancang dokumen tersebut.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Content C -->
            <div id="tab-c" class="tab-content hidden animate-fadeIn">
                <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 border border-green-100 flex items-center justify-center text-2xl shadow-sm mb-6">
                    <i class="fa-solid fa-stamp"></i>
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 mb-4">Aturan Meterai & Tanda Tangan</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Validitas dokumen di mata hukum Indonesia membutuhkan pembubuhan meterai dan stempel perusahaan yang tepat. Berikut adalah prosedurnya:
                </p>
                
                <ul class="space-y-4 mb-6">
                    <li class="flex gap-4">
                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600 shrink-0">1</div>
                        <div>
                            <strong class="block text-gray-800">Dokumen Fisik (Wet Signature)</strong>
                            <span class="text-sm text-gray-600">Pastikan goresan tanda tangan menyentuh atau menimpa sebagian dari meterai fisik Rp10.000. Tanda tangan yang melayang dan tidak menyentuh meterai berisiko tidak sah secara hukum.</span>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600 shrink-0">2</div>
                        <div>
                            <strong class="block text-gray-800">Dokumen Digital (E-Sign)</strong>
                            <span class="text-sm text-gray-600">Pengesahan secara digital harus menggunakan <strong>e-Meterai resmi dari Peruri</strong> atau menggunakan platform Tanda Tangan Elektronik (TTE) yang tersertifikasi di bawah Kominfo (contoh: PrivyID).</span>
                        </div>
                    </li>
                </ul>
                
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-sm shadow-sm flex items-start gap-3">
                    <i class="fa-solid fa-circle-info text-[#7335B7] mt-1 text-lg"></i> 
                    <div>
                        <strong class="block text-gray-800 mb-1">Posisi Stempel Perusahaan</strong>
                        <span class="text-gray-600">Cap atau stempel perusahaan selalu diletakkan di sisi <strong>kiri</strong> tanda tangan dan harus mengenai (menimpa) sedikit bagian dari tanda tangan tersebut.</span>
                    </div>
                </div>
            </div>

            <!-- Content D -->
            <div id="tab-d" class="tab-content hidden animate-fadeIn">
                <div class="w-14 h-14 rounded-2xl bg-purple-50 text-[#7335B7] border border-purple-100 flex items-center justify-center text-2xl shadow-sm mb-6">
                    <i class="fa-solid fa-file-contract"></i>
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 mb-4">Penggunaan Klausul Dinamis (Adendum)</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Untuk menjaga kebersihan dan kestabilan Perjanjian Kerja Sama (PKS) Utama, PKS hanya boleh berisi kerangka kerja fundamental (payung hukum, hak, kewajiban pokok, hukum yang berlaku).
                </p>
                
                <div class="bg-gradient-to-r from-purple-50 to-white border border-purple-100 p-6 rounded-xl shadow-sm mb-6">
                    <h4 class="font-bold text-[#7335B7] mb-3">Apa yang wajib masuk Adendum?</h4>
                    <p class="text-sm text-gray-600 leading-relaxed mb-4">
                        Semua komponen bisnis yang nilainya dapat berubah-ubah (fluktuatif) di tengah masa kerja sama <strong>TIDAK BOLEH</strong> dimasukkan ke pasal PKS Utama, melainkan dilampirkan sebagai Adendum terpisah.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-white border border-purple-200 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">Skema Komisi & Cashback</span>
                        <span class="bg-white border border-purple-200 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">Handling Fee</span>
                        <span class="bg-white border border-purple-200 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">Plafon Kredit Layanan</span>
                        <span class="bg-white border border-purple-200 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">Detail Parameter API Tech</span>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-sm">
                    <strong>Format Penomoran:</strong> Nomor surat Adendum harus menggunakan nomor surat PKS Utama namun ditambahkan suffix berurut. Contoh: Jika PKS adalah <code>015/PKS/2026</code>, maka adendum pertamanya adalah <code>015/PKS/2026-A1</code>.
                </div>
            </div>

            <!-- Content E -->
            <div id="tab-e" class="tab-content hidden animate-fadeIn">
                <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-600 border border-red-100 flex items-center justify-center text-2xl shadow-sm mb-6">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 mb-4">Angle Aggregator & Limitation of Liability</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Model bisnis kita menempatkan kita sebagai <strong>Aggregator/Provider</strong> yang menjembatani layanan dari berbagai 3PL/Vendor ekspedisi dengan klien akhir (melalui API atau sistem). Karena kita bergantung pada pihak ketiga, tim Legal <strong>wajib</strong> membuat tameng perlindungan.
                </p>
                
                <div class="space-y-4">
                    <div class="border border-gray-100 p-5 rounded-xl flex gap-4 hover:bg-gray-50 transition">
                        <div class="text-red-500 mt-1"><i class="fa-solid fa-triangle-exclamation text-xl"></i></div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">Batasan Ganti Rugi (Max Liability)</h4>
                            <p class="text-sm text-gray-500">Kita tidak menanggung 100% kerugian klien jika kerusakan/kehilangan murni diakibatkan oleh operasional pihak ketiga (misal: kurir vendor). Buat klausul yang membatasi tanggung jawab maksimal kita hanya sebesar biaya penanganan (handling fee) atau sesuai SLA vendor pusat.</p>
                        </div>
                    </div>
                    <div class="border border-gray-100 p-5 rounded-xl flex gap-4 hover:bg-gray-50 transition">
                        <div class="text-orange-500 mt-1"><i class="fa-solid fa-bolt text-xl"></i></div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">Klausul Force Majeure & API Down</h4>
                            <p class="text-sm text-gray-500">Perjelas definisi Force Majeure. Jika API vendor pusat mengalami <em>down-time</em> sehingga transaksi klien gagal, ini dikategorikan di luar kendali kita dan membebaskan kita dari tuntutan hukum klien.</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
    .animate-fadeIn {
        animation: fadeIn 0.4s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active styling from all tabs
                tabs.forEach(t => {
                    t.className = "tab-btn w-full flex items-center gap-3 px-4 py-3 text-left rounded-xl font-medium text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-all border border-transparent";
                });
                
                // Add active styling to clicked tab
                tab.className = "tab-btn w-full flex items-center gap-3 px-4 py-3 text-left rounded-xl font-semibold text-sm transition-all bg-white text-[#7335B7] shadow-sm border border-gray-200";

                // Hide all contents
                contents.forEach(c => {
                    c.classList.add('hidden');
                    c.classList.remove('block');
                });

                // Show target content
                const targetId = tab.getAttribute('data-target');
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    targetElement.classList.remove('hidden');
                    targetElement.classList.add('block');
                }
            });
        });
    });
</script>

<?php include '../../includes/footer.php'; ?>
