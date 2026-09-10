/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/notes.js — Digital Notebook View
   ============================================================ */
// ── Auto-Save State ────────────────────────────────────────────
var _noteAutoSaveTimer  = null;
var _noteDirty          = false;

function _noteStartAutoSave() {
    _noteDirty = true;
    _updateDirtyIndicator(true);
    // Layer 2: localStorage draft (immediate)
    var id      = document.getElementById('noteId').value || '__draft__';
    var title   = document.getElementById('noteTitle').value;
    var content = document.getElementById('noteContent').innerHTML;
    try { localStorage.setItem('note_draft_' + id, JSON.stringify({ title: title, content: content, ts: Date.now() })); } catch(e) {}
    // Layer 1: Firebase save (3s debounce)
    clearTimeout(_noteAutoSaveTimer);
    _noteAutoSaveTimer = setTimeout(function() {
        var noteId = document.getElementById('noteId').value;
        if (!noteId) return; // jangan auto-save note baru yang belum diberi judul
        saveNote(true);
    }, 3000);
}

function _updateDirtyIndicator(dirty) {
    _noteDirty = dirty;
    var btn = document.getElementById('btnSaveNote');
    if (!btn) return;
    var dot = btn.querySelector('.dirty-dot');
    if (dirty) {
        if (!dot) { dot = document.createElement('span'); dot.className = 'dirty-dot w-2 h-2 bg-orange-400 rounded-full inline-block ml-1 animate-pulse'; btn.appendChild(dot); }
    } else {
        if (dot) dot.remove();
    }
}

function _clearNoteDraft(id) {
    try { localStorage.removeItem('note_draft_' + id); } catch(e) {}
    try { localStorage.removeItem('note_draft___draft__'); } catch(e) {}
}

function renderNotesView(c) {
    c.innerHTML = `
    <div id="viewContainer-notes-inner" class="flex flex-col md:flex-row h-full gap-4">
        <div class="w-full md:w-1/3 flex flex-col border-b md:border-b-0 md:border-r border-[#333] pb-4 md:pb-0 md:pr-4">
            <button onclick="newNote()"
                class="w-full bg-[#252526] hover:bg-[#2f2f2f] text-blue-400 font-bold py-3 rounded-xl border border-[#333] mb-4 transition uppercase text-xs tracking-widest shadow-md">
                + Buat Catatan Baru
            </button>
            <div id="notesList" class="flex-1 overflow-y-auto space-y-2 pr-2"></div>
        </div>
        <div class="w-full md:w-2/3 flex flex-col h-[60vh] md:h-full bg-[#202020] p-6 rounded-2xl border border-[#333] shadow-inner">
            <input type="hidden" id="noteId">
            <input type="text" id="noteTitle"
                class="bg-transparent text-xl md:text-2xl font-bold text-white mb-4 outline-none placeholder-gray-600 border-b border-transparent focus:border-[#333] transition"
                placeholder="Judul Catatan...">

            <div class="flex gap-2 mb-4 border-b border-[#333] pb-3 overflow-x-auto">
                <button onclick="document.execCommand('bold',false,null)"      class="w-8 h-8 rounded shrink-0 bg-[#2a2a2a] hover:bg-purple-600 text-gray-300 transition" title="Tebal (Ctrl+B)"><i class="fa-solid fa-bold"></i></button>
                <button onclick="document.execCommand('italic',false,null)"    class="w-8 h-8 rounded shrink-0 bg-[#2a2a2a] hover:bg-purple-600 text-gray-300 transition" title="Miring (Ctrl+I)"><i class="fa-solid fa-italic"></i></button>
                <button onclick="document.execCommand('underline',false,null)" class="w-8 h-8 rounded shrink-0 bg-[#2a2a2a] hover:bg-purple-600 text-gray-300 transition" title="Garis Bawah (Ctrl+U)"><i class="fa-solid fa-underline"></i></button>
                <button onclick="document.execCommand('strikeThrough',false,null)" class="w-8 h-8 rounded shrink-0 bg-[#2a2a2a] hover:bg-purple-600 text-gray-300 transition"><i class="fa-solid fa-strikethrough"></i></button>
                <div class="w-px bg-[#444] mx-1"></div>
                <button onclick="addLinkUniversal()" class="w-8 h-8 rounded shrink-0 bg-[#2a2a2a] hover:bg-blue-600 text-gray-300 transition" title="Tautan (Ctrl+K)"><i class="fa-solid fa-link"></i></button>
                <button onclick="document.execCommand('removeFormat',false,null)" class="w-8 h-8 rounded shrink-0 bg-[#2a2a2a] hover:bg-red-600 text-gray-300 transition ml-auto" title="Hapus Format"><i class="fa-solid fa-eraser"></i></button>
            </div>

            <div id="noteContent" contenteditable="true"
                class="flex-1 bg-transparent text-sm text-gray-300 outline-none leading-relaxed overflow-y-auto"
                placeholder="Ketik catatan di sini (Ctrl+B, Ctrl+I berfungsi). URL http otomatis bisa diklik.">
            </div>

            <div class="mt-4 pt-4 border-t border-[#333] flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <button onclick="deleteNote()" id="btnDelNote"
                        class="text-red-500 text-xs font-bold uppercase hidden hover:text-red-400 transition">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                    <span id="noteAutoSaveStatus" class="text-[10px] text-gray-600 italic hidden">Tersimpan otomatis</span>
                </div>
                <div class="flex gap-3 ml-auto">
                    <button onclick="copyNoteLink()" id="btnCopyNote"
                        class="text-blue-400 hover:text-blue-300 text-xs font-bold uppercase hidden bg-blue-900/20 px-4 py-2 rounded-lg border border-blue-900/50 transition">
                        <i class="fa-solid fa-share-nodes"></i> Salin Tautan
                    </button>
                    <button onclick="saveNote(false)" id="btnSaveNote"
                        class="bg-purple-600 hover:bg-purple-500 text-white px-6 py-2 rounded-lg text-xs font-bold transition shadow-lg shadow-purple-900/20">
                        SIMPAN
                    </button>
                </div>
            </div>
        </div>
    </div>`;


    updateNotesListOnly();
    if (typeof activeNoteId !== 'undefined' && activeNoteId) openNote(activeNoteId);

    // Attach auto-save listeners setelah render
    var contentEl = document.getElementById('noteContent');
    var titleEl   = document.getElementById('noteTitle');

    if (contentEl) contentEl.addEventListener('input', _noteStartAutoSave);
    if (titleEl)   titleEl.addEventListener('input', _noteStartAutoSave);
}

function updateNotesListOnly() {
    const listEl = document.getElementById('notesList');
    if (!listEl) return;
    notes.sort((a, b) => b.updatedAt - a.updatedAt);
    listEl.innerHTML = notes.map(n => {
        let plain = '';
        if (n.content) {
            const temp = document.createElement('div');
            temp.innerHTML = n.content;
            plain = temp.textContent || temp.innerText || '';
        }
        return `
        <div onclick="openNote('${n.id}')"
            class="p-4 rounded-xl cursor-pointer transition shadow-sm ${activeNoteId === n.id ? 'bg-purple-900/30 border border-purple-500/50' : 'bg-[#1a1a1a] border border-[#2f2f2f] hover:bg-[#252526]'}">
            <h4 class="text-sm font-bold text-white truncate mb-1">${n.title || 'Tanpa Judul'}</h4>
            <p class="text-[10px] text-gray-500 truncate">${plain.substring(0, 50) || 'Kosong...'}</p>
        </div>`;
    }).join('') || '<p class="text-center text-gray-600 italic py-4 text-xs">Belum ada catatan tersimpan.</p>';
}

function newNote() {
    activeNoteId = null;
    document.getElementById('noteId').value      = '';
    document.getElementById('noteTitle').value   = '';
    document.getElementById('noteContent').innerHTML = '';
    document.getElementById('btnDelNote').classList.add('hidden');
    document.getElementById('btnCopyNote').classList.add('hidden');
    updateNotesListOnly();
}

function openNote(id) {
    var n = notes.find(function(x) { return x.id === id; });
    if (!n) return;
    activeNoteId = id;
    document.getElementById('noteId').value = n.id;

    // Check for unsaved draft in localStorage
    var draft = null;
    try { draft = JSON.parse(localStorage.getItem('note_draft_' + id) || 'null'); } catch(e) {}
    if (draft && draft.ts > (n.updatedAt || 0)) {
        // Draft lebih baru dari yang di Firebase — restore draft
        document.getElementById('noteTitle').value   = draft.title || n.title;
        document.getElementById('noteContent').innerHTML = draft.content || n.content || '';
        _noteDirty = true;
        _updateDirtyIndicator(true);
        var sts = document.getElementById('noteAutoSaveStatus');
        if (sts) { sts.textContent = 'Draft lokal dipulihkan'; sts.classList.remove('hidden'); }
    } else {
        document.getElementById('noteTitle').value   = n.title;
        document.getElementById('noteContent').innerHTML = n.content || '';
        _noteDirty = false;
        _updateDirtyIndicator(false);
        var sts2 = document.getElementById('noteAutoSaveStatus');
        if (sts2) sts2.classList.add('hidden');
    }

    document.getElementById('btnDelNote').classList.remove('hidden');
    document.getElementById('btnCopyNote').classList.remove('hidden');
    updateNotesListOnly();
}

function saveNote(silent) {
    var id = document.getElementById('noteId').value || genId('nt');

    // RBAC IDOR Prevention
    if (document.getElementById('noteId').value && !notes.find(function(n) { return n.id === id; })) {
        if (!silent) showToast('Akses ditolak. Anda tidak bisa mengedit catatan milik orang lain.', 'error');
        return;
    }

    var title   = document.getElementById('noteTitle').value || 'Tanpa Judul';
    var content = autoLinkify(document.getElementById('noteContent').innerHTML);
    db.ref('notes/' + id).set({ id: id, title: title, content: content, updatedAt: Date.now(), uid: currentUser.uid });
    activeNoteId = id;
    // Update hidden noteId in case it was a new note
    document.getElementById('noteId').value = id;

    // Clear dirty state & draft
    clearTimeout(_noteAutoSaveTimer);
    _clearNoteDraft(id);
    _updateDirtyIndicator(false);
    var sts = document.getElementById('noteAutoSaveStatus');
    if (sts) { sts.textContent = 'Tersimpan otomatis ' + new Date().toLocaleTimeString('id-ID', {hour:'2-digit',minute:'2-digit'}); sts.classList.remove('hidden'); }

    if (!silent) showToast('Catatan berhasil disimpan!', 'success');
}

function deleteNote() {
    const id = document.getElementById('noteId').value;
    
    if (id && !notes.find(n => n.id === id)) {
        showToast('Akses ditolak. Anda tidak bisa menghapus catatan milik orang lain.', 'error');
        return;
    }

    if (confirm('Hapus catatan ini selamanya?')) {
        db.ref('notes/' + id).remove();
        newNote();
    }
}

function copyNoteLink() {
    const url = window.location.origin + window.location.pathname + '?note=' + document.getElementById('noteId').value;
    navigator.clipboard.writeText(url);
    showToast('Tautan disalin!', 'info');
}

function addLinkUniversal() {
    const url = prompt('Masukkan Tautan (Contoh: https://canva.com/...):', 'https://');
    if (url) {
        document.execCommand('createLink', false, url);
        setTimeout(() => {
            document.querySelectorAll('[contenteditable] a').forEach(l => l.setAttribute('target', '_blank'));
        }, 50);
    }
}
