<?php 
$page_title = "Dashboard LDMS | SIMASRIM";
$base_path = "../../";
include '../../includes/header.php';
?>

<!-- Hero Section with B2B Style -->
<div class="relative bg-gradient-to-tr from-[#3A1B5E] via-[#1F0D3D] to-[#0f0c29] text-white pt-20 pb-16 overflow-hidden">
    <div class="absolute w-[600px] h-[600px] bg-[#F3700D] blur-[180px] opacity-20 rounded-full top-[-100px] right-[-100px] z-0"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-4">
            <div>
                <h1 class="text-4xl font-extrabold mb-4" data-aos="fade-up">Dashboard <span class="text-[#F3700D]">LDMS.</span></h1>
                <p class="text-lg text-purple-200 max-w-2xl" data-aos="fade-up" data-aos-delay="100">Pusat monitoring dan manajemen dokumen legal perusahaan. Pantau status kontrak dan masa berlaku secara real-time.</p>
            </div>
            <button type="button" onclick="openAddModal()" class="bg-[#F3700D] hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg shadow-orange-500/30 transition transform hover:-translate-y-0.5 flex items-center gap-2 whitespace-nowrap" data-aos="fade-up" data-aos-delay="100">
                <i class="fa-solid fa-plus"></i> Tambah Dokumen
            </button>
        </div>

        <!-- Stats & Smart Numbering Widgets -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6" data-aos="fade-up" data-aos-delay="200">
            <div class="bg-white/10 backdrop-blur-md rounded-xl border border-white/20 p-5 shadow-xl">
                <h3 class="text-xs font-bold text-purple-200 uppercase tracking-wider mb-3">Total Dokumen</h3>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-white text-xl">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <div class="text-4xl font-extrabold text-white" id="totalDocs">0</div>
                </div>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md rounded-xl border border-white/20 shadow-xl p-5 col-span-1 md:col-span-3 relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-10">
                    <i class="fa-solid fa-list-ol text-8xl -mt-4 -mr-4 text-white"></i>
                </div>
                <h3 class="text-xs font-bold text-purple-200 uppercase tracking-wider mb-3"><i class="fa-solid fa-lightbulb text-[#F3700D] mr-1"></i> Smart Numbering Recommendation (<?= date('Y') ?>)</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="numberingWidget">
                    <!-- Injected via JS -->
                    <div class="animate-pulse bg-white/10 h-14 rounded-lg"></div>
                    <div class="animate-pulse bg-white/10 h-14 rounded-lg"></div>
                    <div class="animate-pulse bg-white/10 h-14 rounded-lg"></div>
                </div>
                <div class="mt-3 text-[11px] text-purple-200/70">
                    *Rekomendasi dihitung otomatis berdasarkan nomor dokumen terbesar yang diterbitkan pada tahun berjalan.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Table Card -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-20 pb-10">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden flex flex-col h-full" data-aos="fade-up" data-aos-delay="300">
        
        <!-- Filter Bar -->
        <div class="bg-gray-50 p-5 border-b border-gray-100 grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
            <div>
                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide">Pencarian / Mitra</label>
                <input type="text" id="searchFilter" class="w-full mt-1 px-4 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-[#7335B7] focus:border-[#7335B7] shadow-sm outline-none transition" placeholder="Cari mitra atau nomor...">
            </div>
            <div>
                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide">Jenis Dokumen</label>
                <select id="typeFilter" class="w-full mt-1 px-4 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-[#7335B7] focus:border-[#7335B7] shadow-sm outline-none transition">
                    <option value="">Semua Jenis</option>
                    <option value="PKS">PKS</option>
                    <option value="NDA">NDA</option>
                    <option value="Surat Penunjukan">Surat Penunjukan</option>
                    <option value="Adendum">Adendum</option>
                    <option value="Akta Pendirian">Akta Pendirian</option>
                    <option value="Akta Perubahan Terakhir">Akta Perubahan Terakhir</option>
                    <option value="NIB">NIB</option>
                    <option value="NPWP">NPWP</option>
                    <option value="SIUP">SIUP</option>
                </select>
            </div>
            <div>
                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide">Brand / Kategori</label>
                <input list="brandFilters" id="brandFilter" class="w-full mt-1 px-4 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-[#7335B7] focus:border-[#7335B7] shadow-sm outline-none transition" placeholder="Semua Brand...">
                <datalist id="brandFilters">
                    <option value="SIMASRIM">
                    <option value="QSir">
                    <option value="Logistik/3PL">
                </datalist>
            </div>
            <div>
                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide">Status</label>
                <select id="statusFilter" class="w-full mt-1 px-4 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-[#7335B7] focus:border-[#7335B7] shadow-sm outline-none transition">
                    <option value="">Semua Status</option>
                    <option value="Drafting">Drafting</option>
                    <option value="Reviewing">Reviewing</option>
                    <option value="Negotiation">Negotiation</option>
                    <option value="Approved">Approved</option>
                    <option value="Signed & Sealed">Signed & Sealed</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-white border-b-2 border-[#7335B7] text-gray-600 text-[11px] uppercase tracking-wider">
                        <th class="p-4 font-bold text-center w-10">No</th>
                        <th class="p-4 font-bold">Metadata Dokumen</th>
                        <th class="p-4 font-bold">Mitra & Brand</th>
                        <th class="p-4 font-bold">Masa Berlaku</th>
                        <th class="p-4 font-bold">Status</th>
                        <th class="p-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="docTableBody" class="text-sm divide-y divide-gray-100">
                    <tr>
                        <td colspan="6" class="p-16 text-center text-gray-400">
                            <i class="fa-solid fa-spinner fa-spin text-4xl mb-4 text-[#7335B7]"></i><br>
                            Sinkronisasi data Realtime Database...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .btn-outline-category {
        color: #7335B7;
        border: 1px solid #7335B7;
        background-color: #fff;
    }
    .btn-outline-category:hover {
        color: #fff;
        background-color: #7335B7;
        border-color: #7335B7;
    }
    .btn-check:checked + .btn-outline-category {
        color: #fff !important;
        background-color: #7335B7 !important;
        border-color: #7335B7 !important;
    }
</style>

<!-- Modal Tambah / Edit Dokumen -->
<div class="modal fade" id="docModal" tabindex="-1" aria-labelledby="docModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
      <div class="modal-header border-bottom-0 pb-0">
        <h5 class="modal-title fw-bold" id="docModalLabel"><i class="fa-solid fa-file-signature text-[#7335B7] me-2"></i><span id="docModalTitleText">Tambah Dokumen</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="docForm">
            <input type="hidden" id="modalEditId">

            <!-- Kategori Dokumen -->
            <div class="mb-3">
                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide d-block mb-2">Kategori Dokumen</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="modalCategory" id="catMitra" value="mitra" checked onchange="toggleCategoryFields()">
                    <label class="btn btn-outline-category" for="catMitra"><i class="fas fa-handshake me-1"></i> Kerjasama Mitra</label>

                    <input type="radio" class="btn-check" name="modalCategory" id="catInternal" value="internal" onchange="toggleCategoryFields()">
                    <label class="btn btn-outline-category" for="catInternal"><i class="fas fa-building me-1"></i> Dokumen Internal Perusahaan</label>
                </div>
            </div>

            <div class="row g-3">
                <!-- Jenis Dokumen -->
                <div class="col-md-6">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1 d-block">Jenis Dokumen <span class="text-danger">*</span></label>
                    <input list="jenisDocs" id="modalDocType" required class="form-control" placeholder="Pilih atau ketik jenis...">
                    <datalist id="jenisDocs">
                        <option value="PKS">
                        <option value="NDA">
                        <option value="Surat Penunjukan">
                        <option value="Adendum">
                        <option value="Akta Pendirian">
                        <option value="Akta Perubahan Terakhir">
                        <option value="NIB">
                        <option value="NPWP">
                        <option value="SIUP">
                    </datalist>
                </div>

                <!-- Brand / Kategori -->
                <div class="col-md-6">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1 d-block">Brand / Kategori <span class="text-danger">*</span></label>
                    <input list="brands" id="modalBrand" required class="form-control" placeholder="Pilih atau ketik brand...">
                    <datalist id="brands">
                        <option value="SIMASRIM">
                        <option value="QSir">
                        <option value="Logistik/3PL">
                        <option value="Produsen">
                        <option value="API Tech Integration">
                        <option value="Corporate Partner">
                        <option value="Internal/Vendor">
                    </datalist>
                </div>

                <!-- No Surat Kita -->
                <div class="col-md-6">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1 d-block">Nomor Surat (Internal) <span class="text-danger">*</span></label>
                    <input type="text" id="modalInternalNo" required class="form-control font-monospace" placeholder="Contoh: 019/SMA-PKS/VII/2026">
                </div>

                <!-- No Surat Mitra -->
                <div class="col-md-6" id="groupPartnerNo">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1 d-block">Nomor Surat (Mitra) <span id="mitraNoReq" class="text-danger d-none">*</span></label>
                    <input type="text" id="modalPartnerNo" class="form-control font-monospace" placeholder="Masukkan jika ada...">
                    <p class="text-[10px] text-gray-400 mt-1 fst-italic mb-0">Opsional (Wajib jika Jenis Dokumen adalah PKS).</p>
                </div>

                <!-- Nama Mitra / Keterangan Dokumen -->
                <div class="col-12">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1 d-block" id="labelPartnerName">Nama Mitra / Perusahaan <span class="text-danger">*</span></label>
                    <input type="text" id="modalPartnerName" required class="form-control" placeholder="Nama entitas perusahaan mitra...">
                </div>

                <!-- Tanggal Mulai -->
                <div class="col-md-6">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1 d-block">Tanggal Mulai / Terbit <span class="text-danger">*</span></label>
                    <input type="date" id="modalStartDate" required class="form-control">
                </div>

                <!-- Tanggal Berakhir -->
                <div class="col-md-6">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1 d-block">Tanggal Berakhir</label>
                    <input type="date" id="modalEndDate" class="form-control">
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" id="modalNoExpiry" onchange="toggleNoExpiry()">
                        <label class="form-check-label text-xs text-gray-500" for="modalNoExpiry">Tidak ada masa berlaku (permanen)</label>
                    </div>
                </div>

                <!-- Arah Dokumen -->
                <div class="col-md-6" id="groupDirection">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1 d-block">Arah Dokumen <span class="text-danger">*</span></label>
                    <select id="modalDirection" class="form-select">
                        <option value="" disabled selected>Pilih arah...</option>
                        <option value="Inbound">Inbound (Masuk)</option>
                        <option value="Outbound">Outbound (Keluar)</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1 d-block">Status Saat Ini <span class="text-danger">*</span></label>
                    <select id="modalStatus" required class="form-select">
                        <option value="" disabled selected>Pilih status...</option>
                        <option value="Drafting">Drafting</option>
                        <option value="Reviewing">Reviewing</option>
                        <option value="Negotiation">Negotiation</option>
                        <option value="Approved">Approved</option>
                        <option value="Signed & Sealed">Signed & Sealed</option>
                    </select>
                </div>

                <!-- Kontak PIC Mitra -->
                <div class="col-md-6" id="groupPicPhone">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1 d-block">No. WhatsApp PIC Mitra</label>
                    <input type="text" id="modalPicPhone" class="form-control font-monospace" placeholder="Contoh: 628123456789">
                </div>

                <!-- Link GDrive -->
                <div class="col-md-6">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1 d-block">Link Google Drive Dokumen</label>
                    <input type="url" id="modalGdriveLink" class="form-control" placeholder="#">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer border-top-0 pt-0">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        <button type="button" id="btnSubmitDoc" onclick="submitDocForm()" class="btn text-white fw-bold" style="background-color:#F3700D;"><i class="fa-solid fa-save me-1"></i> Simpan Dokumen</button>
      </div>
    </div>
  </div>
</div>

<!-- PORTOFOLIO DEMO: Firebase SDK modular asli diganti mock lokal (localStorage), tidak connect ke server manapun -->
<script type="module">
    import { initializeApp, getDatabase, ref, onValue, get, push, update, serverTimestamp, getAuth, signInAnonymously } from "./js/firebase-modular-mock.js";

    const firebaseConfig = {
        apiKey: "DUMMY-SECRET-GANTI-SENDIRI",
        authDomain: "demo-project.firebaseapp.com",
        databaseURL: "https://demo-project-default-rtdb.firebaseio.com",
        projectId: "demo-project",
        storageBucket: "demo-project.firebasestorage.app",
        messagingSenderId: "000000000000",
        appId: "1:000000000000:web:0000000000000000000000",
        measurementId: "G-DUMMY000000"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);
    signInAnonymously(auth).catch(err => console.error("Auth failed", err));
    
    const db = getDatabase(app);
    const docsRef = ref(db, 'documents');

    let allDocuments = [];
    const currentYear = new Date().getFullYear();

    function getRomanMonth(dateStr) {
        const date = new Date(dateStr || Date.now());
        const roman = ["I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII"];
        return roman[date.getMonth()];
    }

    function formatDate(dateStr) {
        if (!dateStr) return "-";
        const d = new Date(dateStr);
        return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
    }

    function getDaysRemaining(endDateStr) {
        if (!endDateStr) return 999;
        const end = new Date(endDateStr);
        const today = new Date();
        const diffTime = end - today;
        return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    }

    function getStatusColor(status) {
        switch(status) {
            case 'Drafting': return 'bg-gray-100 text-gray-600 border-gray-200';
            case 'Reviewing': return 'bg-blue-100 text-blue-700 border-blue-200';
            case 'Negotiation': return 'bg-yellow-100 text-yellow-700 border-yellow-200';
            case 'Approved': return 'bg-orange-100 text-orange-700 border-orange-200';
            case 'Signed & Sealed': return 'bg-green-100 text-green-700 border-green-200';
            default: return 'bg-gray-100 text-gray-600';
        }
    }

    onValue(docsRef, (snapshot) => {
        allDocuments = [];
        snapshot.forEach((child) => {
            allDocuments.push({ id: child.key, ...child.val() });
        });
        
        allDocuments.sort((a, b) => (b.created_at || 0) - (a.created_at || 0));
        renderTable();
        calculateSmartNumbering();
    }, (error) => {
        console.error("Error fetching documents:", error);
        document.getElementById('docTableBody').innerHTML = `
            <tr>
                <td colspan="6" class="p-16 text-center text-red-500">
                    <i class="fa-solid fa-triangle-exclamation text-4xl mb-4"></i><br>
                    Gagal memuat data. Periksa koneksi dan Firebase Security Rules.
                </td>
            </tr>`;
    });

    document.getElementById('searchFilter').addEventListener('input', renderTable);
    document.getElementById('typeFilter').addEventListener('change', renderTable);
    document.getElementById('brandFilter').addEventListener('input', renderTable);
    document.getElementById('statusFilter').addEventListener('change', renderTable);

    function calculateSmartNumbering() {
        const widget = document.getElementById('numberingWidget');
        const docsThisYear = allDocuments.filter(d => d.year === currentYear);
        
        let counters = { 'PKS': 0, 'NDA': 0, 'Surat Penunjukan': 0 };
        
        docsThisYear.forEach(d => {
            if(counters[d.type] !== undefined && d.internal_no) {
                const match = d.internal_no.match(/^(\d+)/);
                if(match) {
                    const num = parseInt(match[1]);
                    if(num > counters[d.type]) counters[d.type] = num;
                }
            }
        });

        const roman = getRomanMonth();
        let html = '';
        const types = [
            { type: 'PKS', code: 'SMA-PKS' },
            { type: 'NDA', code: 'SMA-NDA' },
            { type: 'Surat Penunjukan', code: 'SMA-PNJ' }
        ];

        types.forEach(t => {
            let nextNum = counters[t.type] + 1;
            let formattedNum = nextNum.toString().padStart(3, '0');
            let suggestNo = `${formattedNum}/${t.code}/${roman}/${currentYear}`;
            html += `
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 border border-white/10 shadow-inner">
                    <div class="text-[10px] uppercase text-purple-200 font-bold">${t.type}</div>
                    <div class="font-mono font-bold mt-1 text-sm text-white" title="Selanjutnya: ${suggestNo}">${suggestNo}</div>
                </div>
            `;
        });
        
        html += `
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 border border-white/10 shadow-inner">
                <div class="text-[10px] uppercase text-purple-200 font-bold">Adendum</div>
                <div class="font-mono font-bold mt-1 text-sm text-[#F3700D]">-A1 / -A2</div>
            </div>
        `;
        
        widget.innerHTML = html;
        document.getElementById('totalDocs').innerText = allDocuments.length;
    }

    function renderTable() {
        const search = document.getElementById('searchFilter').value.toLowerCase();
        const type = document.getElementById('typeFilter').value;
        const brand = document.getElementById('brandFilter').value.toLowerCase();
        const status = document.getElementById('statusFilter').value;

        const tbody = document.getElementById('docTableBody');
        tbody.innerHTML = '';

        const filtered = allDocuments.filter(d => {
            const matchSearch = d.partner_name?.toLowerCase().includes(search) || d.internal_no?.toLowerCase().includes(search);
            const matchType = type ? d.type === type : true;
            const matchBrand = brand ? d.brand?.toLowerCase().includes(brand) : true;
            const matchStatus = status ? d.status === status : true;
            return matchSearch && matchType && matchBrand && matchStatus;
        });

        if (filtered.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="p-10 text-center text-gray-500 bg-gray-50">Tidak ada dokumen yang ditemukan.</td></tr>`;
            return;
        }

        filtered.forEach((d, index) => {
            const daysRemaining = getDaysRemaining(d.end_date);
            const isExpiring = daysRemaining > 0 && daysRemaining <= 30;
            const isExpired = daysRemaining <= 0;
            
            const rowClass = isExpiring ? 'bg-red-50 hover:bg-red-100 transition' : 
                             isExpired ? 'bg-gray-50 text-gray-500' : 'hover:bg-purple-50/50 transition';

            const statusColor = getStatusColor(d.status);
            const dirIcon = d.direction === 'Inbound' ? '<i class="fa-solid fa-arrow-right-to-bracket text-blue-500 bg-blue-100 p-1 rounded-sm" title="Inbound"></i>' : '<i class="fa-solid fa-arrow-right-from-bracket text-orange-500 bg-orange-100 p-1 rounded-sm" title="Outbound"></i>';

            const waMsg = encodeURIComponent(`Halo Tim ${d.partner_name}, perkenalkan kami dari bagian Legal PT Solusi Mitra Aplikasi. Mengingatkan bahwa dokumen ${d.type} kita dengan nomor ${d.internal_no} akan segera berakhir pada tanggal ${formatDate(d.end_date)}. Mohon arahannya untuk proses perpanjangan dokumen. Terima kasih.`);
            const waLink = d.pic_phone ? `https://api.whatsapp.com/send?phone=${d.pic_phone}&text=${waMsg}` : '#';
            
            let expBadge = '';
            if (isExpiring) expBadge = `<span class="bg-red-500 text-white text-[9px] px-2 py-0.5 rounded-full ml-2 font-bold animate-pulse">Berakhir dlm ${daysRemaining} hr</span>`;
            if (isExpired) expBadge = `<span class="bg-gray-600 text-white text-[9px] px-2 py-0.5 rounded-full ml-2 font-bold">Expired</span>`;

            const tr = document.createElement('tr');
            tr.className = rowClass;
            tr.innerHTML = `
                <td class="p-4 text-center font-bold text-gray-400">${index + 1}</td>
                <td class="p-4">
                    <div class="flex items-start gap-2">
                        <div class="mt-1">${dirIcon}</div>
                        <div>
                            <div class="font-bold text-[#7335B7]">${d.internal_no || '-'}</div>
                            <div class="text-xs text-gray-500 mt-1 font-mono">${d.external_no || '-'}</div>
                            <div class="mt-1 text-xs font-bold text-gray-600">${d.type}</div>
                        </div>
                    </div>
                </td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">${d.partner_name}</div>
                    <div class="text-xs text-gray-500 mt-1"><i class="fa-solid fa-tag mr-1 opacity-50"></i>${d.brand || '-'}</div>
                </td>
                <td class="p-4 text-xs">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fa-regular fa-calendar-check text-green-500 w-4"></i>
                        <span>${formatDate(d.start_date)}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-calendar-xmark text-red-500 w-4"></i>
                        <span>${formatDate(d.end_date)} ${expBadge}</span>
                    </div>
                </td>
                <td class="p-4">
                    <span class="px-3 py-1 rounded-full text-xs font-bold border ${statusColor}">
                        ${d.status}
                    </span>
                    ${d.status === 'Signed & Sealed' && d.file_url ? `
                        <a href="${d.file_url}" target="_blank" class="block mt-2 text-xs text-blue-600 hover:underline"><i class="fa-solid fa-cloud-arrow-down mr-1"></i>Unduh PDF</a>
                    ` : ''}
                </td>
                <td class="p-4 text-center">
                    <div class="flex justify-center gap-2">
                        <button type="button" onclick="openEditModal('${d.id}')" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition border-0" title="Edit Dokumen">
                            <i class="fa-solid fa-pen text-xs"></i>
                        </button>
                        <a href="${waLink}" target="_blank" class="w-8 h-8 rounded-full bg-green-50 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition ${!d.pic_phone ? 'opacity-50 cursor-not-allowed' : ''}" title="Follow Up WA PIC">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                        </a>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    // ── Modal Tambah / Edit Dokumen ──────────────────────────────
    const docModalEl = document.getElementById('docModal');
    const docModal = new bootstrap.Modal(docModalEl);

    window.toggleCategoryFields = function toggleCategoryFields() {
        const isInternal = document.getElementById('catInternal').checked;
        document.getElementById('groupPartnerNo').classList.toggle('d-none', isInternal);
        document.getElementById('groupDirection').classList.toggle('d-none', isInternal);
        document.getElementById('groupPicPhone').classList.toggle('d-none', isInternal);
        document.getElementById('modalDirection').required = !isInternal;
        document.getElementById('labelPartnerName').innerHTML = isInternal
            ? 'Nama / Keterangan Dokumen <span class="text-danger">*</span>'
            : 'Nama Mitra / Perusahaan <span class="text-danger">*</span>';
        document.getElementById('modalPartnerName').placeholder = isInternal
            ? 'Contoh: Akta Pendirian PT Solusi Mitra Aplikasi'
            : 'Nama entitas perusahaan mitra...';
    }

    window.toggleNoExpiry = function toggleNoExpiry() {
        const noExpiry = document.getElementById('modalNoExpiry').checked;
        const endDateInput = document.getElementById('modalEndDate');
        endDateInput.disabled = noExpiry;
        if (noExpiry) endDateInput.value = '';
    }

    document.getElementById('modalDocType').addEventListener('input', (e) => {
        const partnerNoReq = document.getElementById('mitraNoReq');
        partnerNoReq.classList.toggle('d-none', e.target.value !== 'PKS');
    });

    window.openAddModal = function() {
        document.getElementById('docForm').reset();
        document.getElementById('modalEditId').value = '';
        document.getElementById('catMitra').checked = true;
        document.getElementById('modalEndDate').disabled = false;
        document.getElementById('mitraNoReq').classList.add('d-none');
        document.getElementById('docModalTitleText').textContent = 'Tambah Dokumen';
        toggleCategoryFields();
        docModal.show();
    };

    window.openEditModal = function(id) {
        const d = allDocuments.find(doc => doc.id === id);
        if (!d) return;

        document.getElementById('modalEditId').value = d.id;
        document.getElementById('modalDocType').value = d.type || '';
        document.getElementById('modalBrand').value = d.brand || '';
        document.getElementById('modalInternalNo').value = d.internal_no || '';
        document.getElementById('modalPartnerNo').value = d.partner_no || '';
        document.getElementById('modalPartnerName').value = d.partner_name || '';
        document.getElementById('modalStartDate').value = d.start_date || '';
        document.getElementById('modalEndDate').value = d.end_date || '';
        document.getElementById('modalDirection').value = d.direction || '';
        document.getElementById('modalStatus').value = d.status || '';
        document.getElementById('modalPicPhone').value = d.pic_phone || '';
        document.getElementById('modalGdriveLink').value = d.gdrive_link || '';

        const isInternal = d.category === 'internal';
        document.getElementById('catInternal').checked = isInternal;
        document.getElementById('catMitra').checked = !isInternal;

        const noExpiry = !d.end_date;
        document.getElementById('modalNoExpiry').checked = noExpiry;
        document.getElementById('modalEndDate').disabled = noExpiry;

        document.getElementById('mitraNoReq').classList.toggle('d-none', d.type !== 'PKS');
        document.getElementById('docModalTitleText').textContent = 'Edit Dokumen';
        toggleCategoryFields();
        docModal.show();
    };

    window.submitDocForm = async function() {
        const form = document.getElementById('docForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const btnSubmit = document.getElementById('btnSubmitDoc');
        const originalText = btnSubmit.innerHTML;
        btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
        btnSubmit.disabled = true;

        try {
            const editId = document.getElementById('modalEditId').value;
            const isInternal = document.getElementById('catInternal').checked;
            const startDateStr = document.getElementById('modalStartDate').value;
            const endDateStr = document.getElementById('modalNoExpiry').checked ? '' : document.getElementById('modalEndDate').value;
            const yearDoc = new Date(startDateStr).getFullYear();

            const docData = {
                category: isInternal ? 'internal' : 'mitra',
                type: document.getElementById('modalDocType').value,
                brand: document.getElementById('modalBrand').value,
                internal_no: document.getElementById('modalInternalNo').value,
                partner_no: isInternal ? '' : document.getElementById('modalPartnerNo').value,
                partner_name: document.getElementById('modalPartnerName').value,
                start_date: startDateStr,
                end_date: endDateStr,
                year: yearDoc,
                direction: isInternal ? '' : document.getElementById('modalDirection').value,
                status: document.getElementById('modalStatus').value,
                pic_phone: isInternal ? '' : document.getElementById('modalPicPhone').value,
                gdrive_link: document.getElementById('modalGdriveLink').value,
            };

            if (editId) {
                await update(ref(db, 'documents/' + editId), docData);
            } else {
                docData.created_at = serverTimestamp();
                await push(ref(db, 'documents'), docData);
            }

            docModal.hide();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data dokumen berhasil disimpan ke dalam sistem.',
                confirmButtonColor: '#7335B7'
            });
        } catch (error) {
            console.error("Error saving document: ", error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Gagal menyimpan data! ' + error.message,
                confirmButtonColor: '#7335B7'
            });
        } finally {
            btnSubmit.innerHTML = originalText;
            btnSubmit.disabled = false;
        }
    };
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php include '../../includes/footer.php'; ?>
