// --- GLOBAL SEARCH ENGINE ---
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput'); // Disesuaikan dengan ID HTML
    if (searchInput) {
        searchInput.addEventListener('input', renderSearchModal);
    }
});

function renderSearchModal() {
    const q = document.getElementById('searchInput').value.toLowerCase().trim();
    const resultsContainer = document.getElementById('searchResults');
    
    if (!q) {
        resultsContainer.innerHTML = `
        <div class="text-center py-10">
            <i class="fa-solid fa-magnifying-glass text-4xl text-gray-700 mb-4 block"></i>
            <p class="text-gray-500 text-sm">Ketik untuk mencari di seluruh Workspace...</p>
        </div>`;
        return;
    }

    // 1. Search Tasks
    const taskResults = tasks.filter(t => {
        // Tampilkan task milik sendiri ATAU meeting yang diundang
        const isOwn = t.uid === currentUser.uid;
        const isInvited = t.type === 'meeting' && t.participants && t.participants[currentUser.uid];
        if (!isOwn && !isInvited) return false;
        return (
            (t.title   && t.title.toLowerCase().includes(q)) ||
            (t.project && t.project.toLowerCase().includes(q)) ||
            (t.desc    && t.desc.toLowerCase().includes(q))
        );
    }).slice(0, 10);

    // 2. Search Notes
    const noteResults = notes.filter(n => 
        n.uid === currentUser.uid && (
        (n.title && n.title.toLowerCase().includes(q)) ||
        (n.content && n.content.toLowerCase().includes(q)))
    ).slice(0, 10);

    if (taskResults.length === 0 && noteResults.length === 0) {
        resultsContainer.innerHTML = `<p class="text-center text-gray-500 py-10 italic">Tidak ditemukan hasil untuk "${q}"</p>`;
        return;
    }

    let html = '';

    if (taskResults.length > 0) {
        html += `<h4 class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3 px-2">Tugas & Meeting</h4>`;
        html += taskResults.map(t => {
            let icon = t.type === 'meeting' ? 'fa-video text-pink-400' : 'fa-check-square text-blue-400';
            return `
            <div onclick="handleSearchResultClick('task', '${t.id}')" 
                 class="flex items-center gap-4 p-3 rounded-xl hover:bg-[#2a2a2a] cursor-pointer transition group border border-transparent hover:border-[#3f3f3f] mb-1">
                <div class="w-8 h-8 rounded-lg bg-[#202020] border border-[#333] flex items-center justify-center shrink-0 group-hover:bg-[#333] transition">
                    <i class="fa-solid ${icon} text-xs"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <h5 class="text-sm font-bold text-white truncate">${t.title}</h5>
                    <p class="text-[10px] text-gray-500 truncate mt-0.5">${t.project || 'Umum'} • ${t.status}</p>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-600 group-hover:text-white text-[10px] opacity-0 group-hover:opacity-100 transition"></i>
            </div>`;
        }).join('');
    }

    if (noteResults.length > 0) {
        html += `<h4 class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3 px-2 mt-6">Catatan Digital</h4>`;
        html += noteResults.map(n => `
            <div onclick="handleSearchResultClick('note', '${n.id}')" 
                 class="flex items-center gap-4 p-3 rounded-xl hover:bg-[#2a2a2a] cursor-pointer transition group border border-transparent hover:border-[#3f3f3f] mb-1">
                <div class="w-8 h-8 rounded-lg bg-[#202020] border border-[#333] flex items-center justify-center shrink-0 group-hover:bg-[#333] transition">
                    <i class="fa-solid fa-book-bookmark text-purple-400 text-xs"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <h5 class="text-sm font-bold text-white truncate">${n.title || 'Tanpa Judul'}</h5>
                    <p class="text-[10px] text-gray-500 truncate mt-0.5">Disimpan di Catatan</p>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-600 group-hover:text-white text-[10px] opacity-0 group-hover:opacity-100 transition"></i>
            </div>`).join('');
    }

    resultsContainer.innerHTML = html;
}

function handleSearchResultClick(type, id) {
    const searchModal = document.getElementById('searchModal');
    if (searchModal) searchModal.classList.add('hidden');
    
    document.getElementById('searchInput').value = '';
    document.getElementById('searchResults').innerHTML = '';

    if (type === 'task') {
        if(typeof openTaskModal === 'function') openTaskModal(id);
    } else if (type === 'note') {
        if(typeof switchView === 'function') switchView('notes', id);
    }
}