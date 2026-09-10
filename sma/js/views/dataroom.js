/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/dataroom.js — Data Room (Lemari Data)
   ============================================================ */

window._dataroomItems = [];
window._dataroomTab = 'bersama'; // 'bersama' atau 'personal'

function initDataRoomListeners() {
    db.ref('dataroom').on('value', snap => {
        const data = snap.val() || {};
        window._dataroomItems = Object.keys(data).map(k => ({ id: k, ...data[k] }));
        if (document.getElementById('viewContainer').innerHTML.includes('Data Room')) {
            renderDataRoomView(document.getElementById('viewContainer'));
        }
    });
}

function renderDataRoomView(container) {
    let items = window._dataroomItems;
    
    // Filter by Tab
    if (window._dataroomTab === 'bersama') {
        items = items.filter(i => !i.isPersonal);
    } else {
        items = items.filter(i => i.isPersonal && i.addedBy === currentUser.uid);
    }

    const folders = ['Legal', 'Keuangan', 'Intangible', 'Marketing', 'IT'];
    
    let html = `
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white uppercase tracking-wider">Data Room</h2>
            <p class="text-gray-400 text-xs">Penyimpanan Terpusat Dokumen Perusahaan</p>
        </div>
        <button onclick="openDataRoomModal()" class="bg-violet-600 hover:bg-violet-500 text-white px-4 py-2 rounded-lg text-xs font-bold transition">
            <i class="fa-solid fa-cloud-arrow-up mr-2"></i>Tambah Data
        </button>
    </div>

    <!-- Tabs -->
    <div class="flex gap-4 mb-6 border-b border-[#333]">
        <button onclick="switchDataRoomTab('bersama')" class="px-4 py-2 text-xs font-bold uppercase transition border-b-2 ${window._dataroomTab==='bersama'?'border-violet-500 text-white':'border-transparent text-gray-500 hover:text-white'}">Bersama</button>
        <button onclick="switchDataRoomTab('personal')" class="px-4 py-2 text-xs font-bold uppercase transition border-b-2 ${window._dataroomTab==='personal'?'border-violet-500 text-white':'border-transparent text-gray-500 hover:text-white'}">Personal</button>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    `;

    folders.forEach(f => {
        const folderItems = items.filter(i => i.folder === f);
        html += `
        <div class="card-bg p-4 rounded-xl border border-white/5">
            <h3 class="text-sm font-bold text-violet-400 mb-3 border-b border-[#333] pb-2 uppercase"><i class="fa-solid fa-folder-open mr-2"></i>${f} (${folderItems.length})</h3>
            <div class="space-y-2 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
        `;
        if (folderItems.length === 0) {
            html += `<p class="text-xs text-gray-500 italic">Folder kosong.</p>`;
        } else {
            folderItems.forEach(item => {
                const icon = item.type === 'link' ? 'fa-link text-blue-400' : 'fa-file text-emerald-400';
                html += `
                <div class="flex items-center justify-between p-2 hover:bg-white/5 rounded border border-transparent hover:border-white/10 transition group">
                    <div class="flex items-center gap-2 overflow-hidden">
                        <i class="fa-solid ${icon} text-xs"></i>
                        <a href="${item.url}" target="_blank" class="text-xs text-gray-300 hover:text-white truncate">${item.title}</a>
                    </div>
                    <button onclick="deleteDataRoomItem('${item.id}')" class="text-gray-600 hover:text-red-400 opacity-0 group-hover:opacity-100 transition"><i class="fa-solid fa-trash text-xs"></i></button>
                </div>
                `;
            });
        }
        html += `
            </div>
        </div>
        `;
    });

    html += `</div>`;
    container.innerHTML = html;
}

window.switchDataRoomTab = function(tab) {
    window._dataroomTab = tab;
    if (document.getElementById('viewContainer')) {
        renderDataRoomView(document.getElementById('viewContainer'));
    }
};

window.openDataRoomModal = function() {
    let html = `
    <div id="dataRoomModal" class="fixed inset-0 bg-black/80 flex items-center justify-center p-4 z-[100]" onclick="closeModal('dataRoomModal')">
        <div class="card-bg w-full max-w-md rounded-xl border border-[#3f3f3f] overflow-hidden" onclick="event.stopPropagation()">
            <div class="px-5 py-4 border-b border-[#2f2f2f] bg-[#1a1a1a] flex justify-between items-center">
                <h3 class="font-bold text-white text-xs uppercase tracking-widest">Tambah Data Room</h3>
                <button onclick="closeModal('dataRoomModal')" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-4 text-xs">
                <div>
                    <label class="block text-gray-400 mb-1 font-bold">Judul/Nama File</label>
                    <input type="text" id="drTitle" class="input-bg rounded p-2 w-full text-white" placeholder="Contoh: Akta Perusahaan">
                </div>
                <div>
                    <label class="block text-gray-400 mb-1 font-bold">Folder</label>
                    <input type="text" id="drFolder" list="drFoldersList" class="input-bg rounded p-2 w-full text-white" placeholder="Contoh: Legal">
                    <datalist id="drFoldersList">
                        <option value="Legal">
                        <option value="Keuangan">
                        <option value="Intangible">
                        <option value="Marketing">
                        <option value="IT">
                    </datalist>
                </div>
                <div>
                    <label class="block text-gray-400 mb-1 font-bold">Akses</label>
                    <select id="drAccess" class="input-bg rounded p-2 w-full text-white">
                        <option value="bersama">Bersama (Semua orang dapat melihat)</option>
                        <option value="personal">Personal (Hanya saya)</option>
                    </select>
                </div>
                
                <div class="border-t border-[#333] pt-4 mt-4">
                    <label class="block text-gray-400 mb-2 font-bold">Pilih Metode (Link atau Upload)</label>
                    <div class="mb-3">
                        <input type="text" id="drLink" class="input-bg rounded p-2 w-full text-white mb-1" placeholder="Tempel Link (GDrive dll)">
                        <span class="text-[9px] text-gray-500">Atau upload file dari komputer:</span>
                    </div>
                    <div>
                        <input type="file" id="drFile" class="text-gray-300 w-full text-xs">
                    </div>
                </div>
                
                <button onclick="submitDataRoom()" class="w-full bg-violet-600 hover:bg-violet-500 text-white font-bold py-2 rounded-lg transition mt-4">SIMPAN DATA</button>
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

window.submitDataRoom = function() {
    const title = document.getElementById('drTitle').value.trim();
    const folder = document.getElementById('drFolder').value;
    const access = document.getElementById('drAccess').value;
    const link = document.getElementById('drLink').value.trim();
    const fileInput = document.getElementById('drFile');
    
    if (!title) {
        showToast('Judul harus diisi!', 'error');
        return;
    }
    
    if (!link && (!fileInput.files || fileInput.files.length === 0)) {
        showToast('Pilih file atau masukkan link!', 'error');
        return;
    }
    
    const isPersonal = (access === 'personal');
    const dbRef = db.ref('dataroom').push();
    
    if (fileInput.files && fileInput.files.length > 0) {
        // Upload File
        const fd = new FormData();
        fd.append('file', fileInput.files[0]);
        
        // Show loading toast (mock)
        const toast = showToast('Mengunggah file...', 'info');
        
        fetch('api/upload.php', {
            method: 'POST',
            body: fd
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                dbRef.set({
                    title: title,
                    folder: folder,
                    url: res.url,
                    type: 'file',
                    isPersonal: isPersonal,
                    addedBy: currentUser.uid,
                    addedAt: new Date().toISOString()
                }).then(() => {
                    showToast('Berhasil menambahkan file ke Data Room', 'success');
                    closeModal('dataRoomModal');
                });
            } else {
                showToast('Gagal upload: ' + res.message, 'error');
            }
        })
        .catch(err => {
            showToast('Terjadi kesalahan saat upload.', 'error');
        });
    } else {
        // Just link
        let finalLink = link;
        if (!finalLink.startsWith('http://') && !finalLink.startsWith('https://')) {
            finalLink = 'https://' + finalLink;
        }
        dbRef.set({
            title: title,
            folder: folder,
            url: finalLink,
            type: 'link',
            isPersonal: isPersonal,
            addedBy: currentUser.uid,
            addedAt: new Date().toISOString()
        }).then(() => {
            showToast('Berhasil menambahkan link ke Data Room', 'success');
            closeModal('dataRoomModal');
        });
    }
};

window.deleteDataRoomItem = function(id) {
    if (confirm('Yakin ingin menghapus data ini?')) {
        db.ref('dataroom/' + id).remove()
        .then(() => showToast('Data dihapus', 'success'))
        .catch(() => showToast('Gagal menghapus', 'error'));
    }
};

// Initialize listener when script loads
if (typeof initDataRoomListeners === 'function') {
    initDataRoomListeners();
}
