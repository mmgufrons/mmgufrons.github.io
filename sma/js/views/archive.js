/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/archive.js — Archive & History View
   ============================================================ */

// Sort state
var _archiveSortBy  = 'endDate';
var _archiveSortDir = 'desc';
var _archiveFilter  = 'Done';

function renderArchiveView(c, filter) {
    if (filter !== undefined) _archiveFilter = filter;

    var list = tasks
        .filter(function(t) { return t.uid === currentUser.uid && t.status === _archiveFilter; })
        .sort(function(a, b) {
            var va, vb;
            if (_archiveSortBy === 'title') {
                va = (a.title || '').toLowerCase();
                vb = (b.title || '').toLowerCase();
            } else if (_archiveSortBy === 'project') {
                va = (a.project || 'umum').toLowerCase();
                vb = (b.project || 'umum').toLowerCase();
            } else if (_archiveSortBy === 'status') {
                va = a.status || '';
                vb = b.status || '';
            } else {
                va = new Date(a.endDate || a.dueDate || 0).getTime();
                vb = new Date(b.endDate || b.dueDate || 0).getTime();
            }
            if (va < vb) return _archiveSortDir === 'asc' ? -1 : 1;
            if (va > vb) return _archiveSortDir === 'asc' ? 1 : -1;
            return 0;
        });

    function sortIcon(col) {
        if (_archiveSortBy !== col) return '<i class="fa-solid fa-sort text-gray-600 ml-1 text-[9px]"></i>';
        return _archiveSortDir === 'asc'
            ? '<i class="fa-solid fa-sort-up text-violet-400 ml-1 text-[9px]"></i>'
            : '<i class="fa-solid fa-sort-down text-violet-400 ml-1 text-[9px]"></i>';
    }

    function thClass(col) {
        var base = 'px-6 py-4 cursor-pointer hover:text-violet-400 transition select-none whitespace-nowrap';
        return _archiveSortBy === col ? base + ' text-violet-400' : base;
    }

    var doneCount      = tasks.filter(function(t) { return t.uid === currentUser.uid && t.status === 'Done'; }).length;
    var cancelledCount = tasks.filter(function(t) { return t.uid === currentUser.uid && t.status === 'Cancelled'; }).length;

    c.innerHTML = `
    <div class="mb-5 flex flex-wrap gap-2 items-center justify-between animate-fadein">
        <div class="flex gap-2">
            <button onclick="renderArchiveView(document.getElementById('viewContainer'), 'Done')"
                class="px-4 py-2 rounded-lg ${_archiveFilter === 'Done' ? 'bg-emerald-600/20 text-emerald-400 border border-emerald-500/50' : 'bg-[#252526] text-gray-500 border border-transparent'} text-[10px] font-bold uppercase transition">
                <i class="fa-solid fa-check mr-1"></i> Selesai (${doneCount})
            </button>
            <button onclick="renderArchiveView(document.getElementById('viewContainer'), 'Cancelled')"
                class="px-4 py-2 rounded-lg ${_archiveFilter === 'Cancelled' ? 'bg-red-600/20 text-red-400 border border-red-500/50' : 'bg-[#252526] text-gray-500 border border-transparent'} text-[10px] font-bold uppercase transition">
                <i class="fa-solid fa-ban mr-1"></i> Dibatalkan (${cancelledCount})
            </button>
        </div>
        <div class="flex flex-col sm:flex-row items-center gap-3">
            <input type="text" placeholder="Cari tugas atau proyek..." oninput="searchArchiveUI(this.value)" class="bg-[#1a1a1a] border border-[#333] rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-violet-500 transition w-full sm:w-64 placeholder-gray-600">
            <span class="text-[10px] text-gray-600 italic whitespace-nowrap">${list.length} data · Klik kolom u/ sortir</span>
        </div>
    </div>
    <div class="card-bg rounded-xl overflow-hidden overflow-x-auto shadow-xl">
        <table class="w-full text-left text-xs text-gray-400">
            <thead class="bg-[#202020] text-gray-400 font-bold uppercase text-[9px] border-b border-[#333]">
                <tr>
                    <th onclick="sortArchive('title')" class="${thClass('title')}">Tugas / Meeting ${sortIcon('title')}</th>
                    <th onclick="sortArchive('project')" class="${thClass('project')}">Proyek ${sortIcon('project')}</th>
                    <th onclick="sortArchive('endDate')" class="${thClass('endDate')}">Tgl Selesai ${sortIcon('endDate')}</th>
                    <th onclick="sortArchive('status')" class="${thClass('status')}">Status ${sortIcon('status')}</th>
                </tr>
            </thead>
            <tbody id="archiveTbody" class="divide-y divide-[#333]">
                ${list.length === 0
                    ? '<tr><td colspan="4" class="px-6 py-10 text-center italic text-gray-600">Tidak ada data.</td></tr>'
                    : list.map(t => `
                <tr class="hover:bg-[#2a2a2a] cursor-pointer archive-row" onclick="openTaskModal('${t.id}')">
                    <td class="px-6 py-3 text-white font-bold truncate max-w-[300px]">
                        ${t.isRoutine ? `<span class="text-purple-400 mr-1" title="Rutinitas"><i class="fa-solid fa-repeat"></i></span>` : ''}
                        ${t.type === 'meeting' ? `<span class="text-pink-500 mr-1" title="Meeting"><i class="fa-solid fa-users"></i></span>` : ''}
                        ${t.title}
                    </td>
                    <td class="px-6 py-3">
                        <span class="bg-[#333] px-2 py-0.5 rounded text-[10px]">
                            ${t.type === 'meeting' ? 'MEETING' : (t.project || 'Umum')}
                        </span>
                    </td>
                    <td class="px-6 py-3">${t.endDate || t.dueDate || '-'}</td>
                    <td class="px-6 py-3 font-black ${t.status === 'Done' ? 'text-emerald-500' : 'text-red-500'} uppercase">${window.STATUS_LABELS ? window.STATUS_LABELS[t.status] || t.status : t.status}</td>
                </tr>`).join('')}
            </tbody>
        </table>
    </div>`;
}

function sortArchive(col) {
    if (_archiveSortBy === col) {
        _archiveSortDir = (_archiveSortDir === 'asc') ? 'desc' : 'asc';
    } else {
        _archiveSortBy  = col;
        _archiveSortDir = (col === 'endDate') ? 'desc' : 'asc';
    }
    renderArchiveView(document.getElementById('viewContainer'));
}

function switchArchive(filter) {
    renderArchiveView(document.getElementById('viewContainer'), filter);
}

window.searchArchiveUI = function(val) {
    val = val.toLowerCase();
    var rows = document.querySelectorAll('#archiveTbody tr.archive-row');
    rows.forEach(r => {
        if (r.innerText.toLowerCase().indexOf(val) > -1) {
            r.style.display = '';
        } else {
            r.style.display = 'none';
        }
    });
};
