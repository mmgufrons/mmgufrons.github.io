/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/tools.js — Direktori Akses & Tools
   ============================================================ */

window._toolsItems = [];
window._toolsIsFallback = false;

const _MASTER_TOOLS = [
    // PORTOFOLIO DEMO: seluruh isi asli (link internal Google Docs/Sheets, Canva,
    // dan bahkan token JWT dashboard payment gateway) SUDAH DIHAPUS TOTAL, diganti
    // daftar tools contoh yang fiktif (tetap merepresentasikan struktur kategori asli).
    { title: 'Contoh Dokumen Aset', category: 'PT SMA', description: 'PT SMA', url: '#', icon: 'fa-table', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh Dokumen Keuangan', category: 'PT SMA', description: 'PT SMA', url: '#', icon: 'fa-file-invoice-dollar', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh Portal TMS', category: 'EDC', description: 'EDC', url: '#', icon: 'fa-laptop-code', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh Sales Deck', category: 'EDC', description: 'EDC', url: '#', icon: 'fa-chalkboard', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh Onboarding Deck', category: 'EDC', description: 'EDC', url: '#', icon: 'fa-chalkboard-user', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh Kit Stiker', category: 'EDC - Topwise Kit', description: 'EDC', url: '#', icon: 'fa-palette', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh Kit Pamflet', category: 'EDC - Centerm Kit', description: 'EDC', url: '#', icon: 'fa-palette', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh Banner 3x1', category: 'Marketing Kit', description: 'Marketing', url: '#', icon: 'fa-palette', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh X-Banner', category: 'Marketing Kit', description: 'Marketing', url: '#', icon: 'fa-palette', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'SQRIS Umum (FAQ)', category: 'Halaman Teknis', description: 'SQRIS', url: 'https://sqris.id/', icon: 'fa-book', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'EDC (FAQ)', category: 'Halaman Teknis', description: 'EDC', url: 'https://www.simasrim.com/edc/', icon: 'fa-book', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh SOP Recall', category: 'CS', description: 'CS', url: '#', icon: 'fa-book', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh Laporan CS', category: 'CS', description: 'CS', url: '#', icon: 'fa-table', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh Report Transaksi', category: 'Marketing', description: 'Marketing', url: '#', icon: 'fa-chart-line', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh Strategi B2B2C', category: 'Marketing', description: 'Marketing', url: '#', icon: 'fa-file-word', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh Folder Omset', category: 'OMSET', description: 'OMSET', url: '#', icon: 'fa-folder', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh CRM Looker', category: 'CRM - All', description: 'CRM', url: '#', icon: 'fa-chart-pie', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh CRM Data', category: 'CRM - All', description: 'CRM', url: '#', icon: 'fa-table', department: ['Semua'], roleRestricted: 'Semua' },
    { title: 'Contoh CRM Ekstrak Data', category: 'CRM - Daftar', description: 'CRM', url: '#', icon: 'fa-database', department: ['Semua'], roleRestricted: 'Semua' }
];

window.initDefaultTools = function() {
    if (currentUser.role !== 'SuperAdmin') return;
    _MASTER_TOOLS.forEach(t => {
        db.ref('tools').push({ ...t, addedBy: currentUser.uid, addedAt: new Date().toISOString() });
    });
    showToast('Data awal berhasil di-sync ke Firebase', 'success');
};

function initToolsListeners() {
    db.ref('tools').on('value', snap => {
        const data = snap.val() || {};
        window._toolsIsFallback = false;
        window._toolsItems = Object.keys(data).map(k => ({ id: k, ...data[k] }));
        if (document.getElementById('viewContainer').innerHTML.includes('Direktori Akses')) {
            renderToolsView(document.getElementById('viewContainer'));
        }
    }, error => {
        console.warn('Gagal membaca tools dari Firebase (mungkin aturan Rules belum diupdate). Menggunakan data lokal sementara.', error);
        window._toolsIsFallback = true;
        // Fallback jika permission denied
        window._toolsItems = _MASTER_TOOLS.map((t, idx) => ({ id: 't' + idx, ...t }));
        if (document.getElementById('viewContainer').innerHTML.includes('Direktori Akses')) {
            renderToolsView(document.getElementById('viewContainer'));
        }
    });
}

function renderToolsView(container) {
    let items = window._toolsItems.filter(t => {
        // SuperAdmin bisa melihat semua
        if (currentUser.role === 'SuperAdmin') return true;
        // Jika alat ini dibatasi departemen (t.department array atau string)
        if (t.department) {
            let deptArr = Array.isArray(t.department) ? t.department : [t.department];
            if (deptArr.length > 0 && !deptArr.includes('Semua')) {
                if (!deptArr.includes(currentUser.department)) return false;
            }
        }
        // Jika dibatasi role
        if (t.roleRestricted && t.roleRestricted !== 'Semua') {
            const roleHierarchy = { 'Magang':1, 'Staff':2, 'Supervisor':3, 'DeptExecutive':4, 'Executive':5, 'Direktur':6, 'SuperAdmin':7 };
            const reqLvl = roleHierarchy[t.roleRestricted] || 0;
            const curLvl = roleHierarchy[currentUser.role] || 0;
            if (curLvl < reqLvl) return false;
        }
        return true;
    });

    const isSuperAdmin = currentUser.role === 'SuperAdmin';
    const showSyncBtn = isSuperAdmin && (items.length === 0 || window._toolsIsFallback);
    
    let html = `
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white uppercase tracking-wider">Direktori Akses</h2>
            <p class="text-gray-400 text-xs">Pusat tautan dan alat operasional perusahaan</p>
        </div>
        ${isSuperAdmin ? `
        <div class="flex gap-2">
            ${showSyncBtn ? `<button onclick="initDefaultTools()" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg text-xs font-bold transition"><i class="fa-solid fa-cloud-arrow-up mr-2"></i>Sync Default</button>` : ''}
            <button onclick="openAddToolModal()" class="bg-violet-600 hover:bg-violet-500 text-white px-4 py-2 rounded-lg text-xs font-bold transition">
                <i class="fa-solid fa-plus mr-2"></i>Tambah Tool
            </button>
        </div>
        ` : ''}
    </div>

    <div class="flex flex-col gap-2">
    `;

    if (items.length === 0) {
        html += `<div class="text-center text-gray-500 text-xs italic py-10">Belum ada tools yang tersedia untuk Anda.</div>`;
    } else {
        var groups = {};
        items.forEach(t => {
            var cat = t.category || 'Umum';
            if (!groups[cat]) groups[cat] = [];
            groups[cat].push(t);
        });

        Object.keys(groups).sort().forEach(cat => {
            html += `<h3 class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-4 mb-1 border-b border-[#333] pb-1">${cat}</h3>`;
            groups[cat].forEach(t => {
                html += `
                <div class="card-bg p-3 rounded-lg border border-white/5 hover:border-violet-500/50 transition flex items-center justify-between group cursor-pointer" onclick="${isSuperAdmin ? `editTool('${t.id}')` : `window.open('${t.url}', '_blank')`}">
                    <div class="flex items-center gap-3 w-full max-w-full overflow-hidden">
                        <div class="w-9 h-9 rounded bg-[#1a1a1a] flex-shrink-0 flex items-center justify-center border border-[#333] group-hover:border-violet-500/50 transition">
                            <i class="fa-solid ${t.icon || 'fa-link'} text-violet-400 text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-bold text-white truncate">${t.title}</h3>
                            <p class="text-[10px] text-gray-400 truncate">${t.description || 'Tidak ada deskripsi'}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 ml-4 flex-shrink-0">
                        <button onclick="event.stopPropagation(); window.open('${t.url}', '_blank')" class="bg-[#1a1a1a] hover:bg-violet-600 text-gray-300 hover:text-white px-3 py-1.5 rounded text-[10px] font-bold transition border border-[#333] group-hover:border-violet-600">
                            BUKA <i class="fa-solid fa-arrow-up-right-from-square ml-1"></i>
                        </button>
                        ${isSuperAdmin ? `
                        <button onclick="event.stopPropagation(); editTool('${t.id}')" class="text-gray-500 hover:text-blue-400 transition p-1.5 opacity-0 group-hover:opacity-100" title="Edit">
                            <i class="fa-solid fa-pen text-xs"></i>
                        </button>
                        <button onclick="event.stopPropagation(); deleteTool('${t.id}')" class="text-gray-500 hover:text-red-400 transition p-1.5 opacity-0 group-hover:opacity-100" title="Hapus">
                            <i class="fa-solid fa-trash text-xs"></i>
                        </button>
                        ` : ''}
                    </div>
                </div>
                `;
            });
        });
    }

    html += `</div>`;
    container.innerHTML = html;
}

window.openAddToolModal = function(editId = null) {
    let t = null;
    if (editId) {
        t = window._toolsItems.find(x => x.id === editId);
    }

    let html = `
    <div id="addToolModal" class="fixed inset-0 bg-black/80 flex items-center justify-center p-4 z-[100]" onclick="closeModal('addToolModal')">
        <div class="card-bg w-full max-w-md rounded-xl border border-[#3f3f3f] overflow-hidden" onclick="event.stopPropagation()">
            <div class="px-5 py-4 border-b border-[#2f2f2f] bg-[#1a1a1a] flex justify-between items-center">
                <h3 class="font-bold text-white text-xs uppercase tracking-widest">${t ? 'Edit' : 'Tambah'} Tool Akses</h3>
                <button onclick="closeModal('addToolModal')" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-3 text-xs">
                <input type="hidden" id="toolId" value="${t ? t.id : ''}">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-gray-400 mb-1 font-bold">Nama / Judul</label>
                        <input type="text" id="toolTitle" class="input-bg rounded p-2 w-full text-white" placeholder="Contoh: Canva Enterprise" value="${t ? t.title : ''}">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-1 font-bold">Kategori (Grup)</label>
                        <input type="text" id="toolCategory" list="toolCatList" class="input-bg rounded p-2 w-full text-white" placeholder="Contoh: Produktivitas" value="${t && t.category ? t.category : 'Umum'}">
                        <datalist id="toolCatList">
                            <option value="Umum">
                            <option value="Artificial Intelligence">
                            <option value="Sistem Utama">
                            <option value="Produktivitas & Desain">
                            <option value="Aset & Logistik">
                            <option value="Keuangan & HR">
                        </datalist>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-400 mb-1 font-bold">Deskripsi</label>
                    <input type="text" id="toolDesc" class="input-bg rounded p-2 w-full text-white" placeholder="Contoh: Alat desain utama divisi marketing" value="${t && t.description ? t.description : ''}">
                </div>
                <div>
                    <label class="block text-gray-400 mb-1 font-bold">URL / Link</label>
                    <input type="text" id="toolUrl" class="input-bg rounded p-2 w-full text-white" placeholder="https://..." value="${t ? t.url : ''}">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-gray-400 mb-1 font-bold">Ikon (FontAwesome)</label>
                        <input type="text" id="toolIcon" class="input-bg rounded p-2 w-full text-white" placeholder="Contoh: fa-palette" value="${t && t.icon ? t.icon : 'fa-link'}">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-1 font-bold">Batas Departemen</label>
                        <div id="toolDeptContainer" class="flex flex-wrap gap-2 text-white">
                            <label class="flex items-center gap-1"><input type="checkbox" value="Semua" onchange="toggleToolDept(this)" ${!t || t.department.includes('Semua') ? 'checked' : ''}> Semua</label>
                            <label class="flex items-center gap-1"><input type="checkbox" value="Marketing" class="tool-dept-cb" ${t && t.department.includes('Marketing') ? 'checked' : ''}> Marketing</label>
                            <label class="flex items-center gap-1"><input type="checkbox" value="Operasional" class="tool-dept-cb" ${t && t.department.includes('Operasional') ? 'checked' : ''}> Operasional</label>
                            <label class="flex items-center gap-1"><input type="checkbox" value="HRD" class="tool-dept-cb" ${t && t.department.includes('HRD') ? 'checked' : ''}> HRD</label>
                            <label class="flex items-center gap-1"><input type="checkbox" value="Keuangan" class="tool-dept-cb" ${t && t.department.includes('Keuangan') ? 'checked' : ''}> Keuangan</label>
                            <label class="flex items-center gap-1"><input type="checkbox" value="IT" class="tool-dept-cb" ${t && t.department.includes('IT') ? 'checked' : ''}> IT</label>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-400 mb-1 font-bold">Batas Minimum Role</label>
                    <select id="toolRole" class="input-bg rounded p-2 w-full text-white">
                        <option value="Semua" ${!t || t.roleRestricted === 'Semua' ? 'selected' : ''}>Semua (Staff & Magang)</option>
                        <option value="Supervisor" ${t && t.roleRestricted === 'Supervisor' ? 'selected' : ''}>Supervisor ke atas</option>
                        <option value="Executive" ${t && t.roleRestricted === 'Executive' ? 'selected' : ''}>Executive ke atas</option>
                        <option value="SuperAdmin" ${t && t.roleRestricted === 'SuperAdmin' ? 'selected' : ''}>Khusus Super Admin</option>
                    </select>
                </div>
                
                <button onclick="submitNewTool()" class="w-full bg-violet-600 hover:bg-violet-500 text-white font-bold py-2.5 rounded-lg transition mt-2">SIMPAN TOOL</button>
            </div>
        </div>
    </div>
    `;
    let container = document.getElementById('tempModalContainer');
    if (!container) {
        container = document.createElement('div');
        container.id = 'tempModalContainer';
        document.body.appendChild(container);
    }
    container.innerHTML = html;
};

window.editTool = function(id) {
    openAddToolModal(id);
};

window.submitNewTool = function() {
    const editId = document.getElementById('toolId').value;
    const title = document.getElementById('toolTitle').value.trim();
    const category = document.getElementById('toolCategory').value.trim() || 'Umum';
    const desc = document.getElementById('toolDesc').value.trim();
    const url = document.getElementById('toolUrl').value.trim();
    const icon = document.getElementById('toolIcon').value.trim() || 'fa-link';
    
    let deptArr = [];
    const cbSemua = document.querySelector('#toolDeptContainer input[value="Semua"]');
    if (cbSemua && cbSemua.checked) {
        deptArr.push('Semua');
    } else {
        document.querySelectorAll('.tool-dept-cb:checked').forEach(cb => {
            deptArr.push(cb.value);
        });
    }
    if (deptArr.length === 0) deptArr.push('Semua');

    const role = document.getElementById('toolRole').value;
    
    if (!title || !url) {
        showToast('Judul dan URL wajib diisi!', 'error');
        return;
    }
    
    let finalUrl = url;
    if (!finalUrl.startsWith('http://') && !finalUrl.startsWith('https://')) {
        finalUrl = 'https://' + finalUrl;
    }
    
    const payload = {
        title: title,
        category: category,
        description: desc,
        url: finalUrl,
        icon: icon,
        department: deptArr,
        roleRestricted: role
    };

    if (editId && !editId.startsWith('t')) { // t1, t2 etc are local fallbacks, can't be edited on server if not present
        db.ref('tools/' + editId).update(payload).then(() => {
            showToast('Tool berhasil diperbarui', 'success');
            closeModal('addToolModal');
        }).catch(err => {
            showToast('Gagal update: ' + err.message, 'error');
        });
    } else {
        payload.addedBy = currentUser.uid;
        payload.addedAt = new Date().toISOString();
        db.ref('tools').push(payload).then(() => {
            showToast('Tool berhasil ditambahkan', 'success');
            closeModal('addToolModal');
        }).catch(err => {
            showToast('Gagal menyimpan: ' + err.message, 'error');
        });
    }
};

window.deleteTool = function(id) {
    if (confirm('Yakin ingin menghapus tool ini dari direktori?')) {
        db.ref('tools/' + id).remove()
        .then(() => showToast('Tool dihapus', 'success'))
        .catch(err => showToast('Gagal menghapus: ' + err.message, 'error'));
    }
};

window.toggleToolDept = function(el) {
    if (el.checked) {
        document.querySelectorAll('.tool-dept-cb').forEach(cb => cb.checked = false);
    }
};

document.addEventListener('change', function(e) {
    if (e.target && e.target.classList.contains('tool-dept-cb')) {
        if (e.target.checked) {
            const cbSemua = document.querySelector('#toolDeptContainer input[value="Semua"]');
            if (cbSemua) cbSemua.checked = false;
        }
    }
});

if (typeof initToolsListeners === 'function') {
    initToolsListeners();
}
