/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/board.js — Kanban / Project Board View

   LOGIKA MONITORING:
   - boardTargetUid = null → papan sendiri
   - boardTargetUid = uid staf → monitor staf (Tab Delegasi = tugas yang MASUK ke staf tsb)
   - boardTargetUid = uid SPV  → monitor SPV (hanya SuperAdmin/Executive)
                                  (Tab Delegasi = tugas yang didelegasikan OLEH SPV tsb)
   ============================================================ */

// Track tab aktif agar tidak lompat ke Kanban setelah edit task
if (typeof window._activeBoardTab     === 'undefined') window._activeBoardTab     = 'kanban';
if (typeof window._projectListFilter  === 'undefined') window._projectListFilter  = 'all';
if (typeof window._projectListScroll  === 'undefined') window._projectListScroll  = 0;

// ── Bulk Action System ──────────────────────────────────────────
if (typeof window._selectedTaskIds === 'undefined') window._selectedTaskIds = new Set();

window.toggleTaskSelection = function(checkbox, taskId) {
    if (checkbox.checked) {
        window._selectedTaskIds.add(taskId);
    } else {
        window._selectedTaskIds.delete(taskId);
    }
    window.renderBulkActionBar();
};

window.clearBulkSelection = function() {
    window._selectedTaskIds.clear();
    document.querySelectorAll('.task-checkbox').forEach(function(cb) { cb.checked = false; });
    window.renderBulkActionBar();
};

window.renderBulkActionBar = function() {
    var count = window._selectedTaskIds.size;
    var bar   = document.getElementById('bulkActionBar');

    if (!bar) {
        bar = document.createElement('div');
        bar.id = 'bulkActionBar';
        bar.className = 'fixed bottom-0 left-0 right-0 z-[90] transition-transform duration-300 translate-y-full';
        bar.innerHTML = `
        <div class="mx-auto max-w-2xl mb-4 px-4">
            <div class="bg-[#1e1b2e] border border-violet-500/40 rounded-2xl shadow-2xl shadow-violet-900/30 p-4 flex flex-wrap items-center gap-3 backdrop-blur">
                <div class="flex items-center gap-2 shrink-0">
                    <div class="w-7 h-7 rounded-full bg-violet-600 flex items-center justify-center">
                        <i class="fa-solid fa-check text-white text-xs"></i>
                    </div>
                    <span id="bulkCountLabel" class="text-white text-sm font-bold"></span>
                </div>
                <div class="flex flex-wrap gap-2 flex-1">
                    <button onclick="bulkRenameProject()" class="flex items-center gap-1.5 px-3 py-1.5 bg-violet-900/40 border border-violet-500/40 hover:bg-violet-700/40 text-violet-300 rounded-lg text-[11px] font-bold transition">
                        <i class="fa-solid fa-folder-open"></i> Ganti Proyek
                    </button>
                    <button onclick="bulkChangeStatus()" class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-900/40 border border-blue-500/40 hover:bg-blue-700/40 text-blue-300 rounded-lg text-[11px] font-bold transition">
                        <i class="fa-solid fa-arrows-rotate"></i> Ganti Status
                    </button>
                    <button onclick="bulkChangePriority()" class="flex items-center gap-1.5 px-3 py-1.5 bg-orange-900/40 border border-orange-500/40 hover:bg-orange-700/40 text-orange-300 rounded-lg text-[11px] font-bold transition">
                        <i class="fa-solid fa-flag"></i> Ganti Prioritas
                    </button>
                </div>
                <button onclick="window.clearBulkSelection()" class="shrink-0 w-7 h-7 flex items-center justify-center text-gray-400 hover:text-white hover:bg-red-900/30 rounded-lg transition" title="Batal Pilih">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
        </div>`;
        document.body.appendChild(bar);
    }

    var label = bar.querySelector('#bulkCountLabel');
    if (label) label.textContent = count + ' tugas dipilih';

    if (count > 0) {
        bar.classList.remove('translate-y-full');
    } else {
        bar.classList.add('translate-y-full');
    }
};

window.bulkRenameProject = function() {
    var ids = Array.from(window._selectedTaskIds);
    if (ids.length === 0) return;
    var currentProjects = [...new Set(ids.map(function(id) {
        var t = tasks.find(function(t) { return t.id === id; });
        return t ? (t.project || 'Umum') : 'Umum';
    }))];
    var hint = currentProjects.length === 1 ? currentProjects[0] : '(Berbeda-beda)';
    var newName = prompt('Ganti proyek untuk ' + ids.length + ' tugas terpilih menjadi:\n(Saat ini: ' + hint + ')', currentProjects.length === 1 ? currentProjects[0] : '');
    if (!newName || !newName.trim()) return;
    newName = newName.trim();
    var batch = {};
    ids.forEach(function(id) { batch['tasks/' + id + '/project'] = newName; });
    db.ref().update(batch)
        .then(function() {
            showToast('Proyek ' + ids.length + ' tugas diubah ke "' + newName + '"', 'success');
            window.clearBulkSelection();
        })
        .catch(function(e) { showToast('Gagal: ' + e.message, 'error'); });
};

window.bulkChangeStatus = function() {
    var ids = Array.from(window._selectedTaskIds);
    if (ids.length === 0) return;
    var opts = ['Planning', 'In Progress', 'On Hold', 'Done', 'Cancelled'];
    var labels = window.STATUS_LABELS || { Planning: 'Rencana', 'In Progress': 'Berjalan', 'On Hold': 'Ditunda', Done: 'Selesai', Cancelled: 'Batal' };
    var choice = prompt('Pilih status baru untuk ' + ids.length + ' tugas:\n' + opts.map(function(o, i) { return (i+1) + '. ' + labels[o]; }).join('\n') + '\n\nKetik angka (1-' + opts.length + '):', '');
    var idx = parseInt(choice) - 1;
    if (isNaN(idx) || idx < 0 || idx >= opts.length) return;
    var newStatus = opts[idx];
    var batch = {};
    ids.forEach(function(id) {
        batch['tasks/' + id + '/status'] = newStatus;
        if (newStatus === 'Done') batch['tasks/' + id + '/endDate'] = getLocalISODate();
    });
    db.ref().update(batch)
        .then(function() {
            showToast(ids.length + ' tugas diubah ke "' + (labels[newStatus] || newStatus) + '"', 'success');
            window.clearBulkSelection();
        })
        .catch(function(e) { showToast('Gagal: ' + e.message, 'error'); });
};

window.bulkChangePriority = function() {
    var ids = Array.from(window._selectedTaskIds);
    if (ids.length === 0) return;
    var opts = ['Critical', 'High', 'Medium', 'Low'];
    var choice = prompt('Pilih prioritas baru untuk ' + ids.length + ' tugas:\n1. Critical\n2. High\n3. Medium\n4. Low\n\nKetik angka (1-4):', '');
    var idx = parseInt(choice) - 1;
    if (isNaN(idx) || idx < 0 || idx >= opts.length) return;
    var newPrio = opts[idx];
    var batch = {};
    ids.forEach(function(id) { batch['tasks/' + id + '/priority'] = newPrio; });
    db.ref().update(batch)
        .then(function() {
            showToast(ids.length + ' tugas diubah ke prioritas "' + newPrio + '"', 'success');
            window.clearBulkSelection();
        })
        .catch(function(e) { showToast('Gagal: ' + e.message, 'error'); });
};


function renderBoardView(c) {
    const targetUid   = (typeof boardTargetUid !== 'undefined' && boardTargetUid) ? boardTargetUid : null;
    const isMonitor   = !!targetUid;
    const targetUser  = isMonitor && allUsers[targetUid] ? allUsers[targetUid] : null;
    const targetName  = targetUser ? (targetUser.name || 'Karyawan') : '';
    const targetRole  = targetUser ? (targetUser.role || 'Staff') : 'Staff';

    const myRole = currentUser.role;
    const canMonitorMgmt = (myRole === 'SuperAdmin' || myRole === 'Executive' || myRole === 'DeptExecutive' || myRole === 'Direktur');

    if (isMonitor && !canMonitorMgmt && (targetRole === 'Supervisor' || targetRole === 'SuperAdmin')) {
        boardTargetUid = null;
        switchView('supervisor');
        return;
    }

    let monitorBanner = '';
    if (isMonitor && targetUser) {
        const isMonitoringStaff = targetRole === 'Staff';
        const monitorType = isMonitoringStaff ? 'Memantau Tugas Staf' : 'Memantau Delegasi SPV';
        monitorBanner = `
        <div class="mb-3 bg-emerald-900/30 border border-emerald-500/30 text-emerald-400 text-[10px] font-bold p-2.5 rounded-lg flex items-center gap-2 justify-between">
            <span><i class="fa-solid fa-eye mr-1"></i> ${monitorType}: <span class="text-white font-bold">${targetName}</span>
            <span class="text-emerald-600 ml-1">(${targetUser.department || '-'} · ${targetRole})</span></span>
            <button onclick="boardTargetUid=null; switchView('supervisor')"
                class="text-[9px] text-gray-400 hover:text-white border border-gray-600 px-2 py-1 rounded transition shrink-0">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </button>
        </div>`;
    }

    if (typeof clearBulkSelection === 'function') clearBulkSelection();

    // Simpan active tab lama sebelum re-render
    const activeTab = window._activeBoardTab || 'kanban';

    c.innerHTML = `
    ${monitorBanner}
    <div class="h-10 border-b border-[#2f2f2f] flex items-center px-2 gap-4 mb-4">
        <button onclick="switchBoardTab('kanban')" id="tabKanban"
            class="text-xs font-bold text-white border-b-2 border-purple-500 py-2 uppercase transition cursor-pointer">
            Papan Kanban
        </button>
        <button onclick="switchBoardTab('list')" id="tabList"
            class="text-xs font-bold text-gray-500 hover:text-gray-300 py-2 uppercase transition cursor-pointer">
            Daftar Proyek
        </button>
        <button onclick="switchBoardTab('delegated')" id="tabDelegated"
            class="text-xs font-bold text-gray-500 hover:text-gray-300 py-2 uppercase transition cursor-pointer">
            ${isMonitor && targetRole !== 'Staff'
                ? 'Delegasi Keluar SPV'
                : isMonitor
                    ? 'Tugas Masuk (Delegasi)'
                    : 'Tugas Delegasi'}
        </button>
    </div>
    <div id="boardContent" class="h-[calc(100%-6rem)] w-full"></div>`;

    // Restore tab yang sedang aktif
    switchBoardTab(activeTab);
}

function switchBoardTab(tab) {
    window._activeBoardTab = tab; // Simpan tab aktif
    // Reset scroll proyek saat pindah tab lain
    if (tab !== 'list') window._projectListScroll = 0;
    const klass_active   = 'text-xs font-bold text-white border-b-2 border-purple-500 py-2 uppercase transition cursor-pointer';
    const klass_inactive = 'text-xs font-bold text-gray-500 hover:text-gray-300 py-2 uppercase transition cursor-pointer';
    ['tabKanban','tabList','tabDelegated'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.className = klass_inactive;
    });
    const activeId = { kanban: 'tabKanban', list: 'tabList', delegated: 'tabDelegated' }[tab];
    if (document.getElementById(activeId)) document.getElementById(activeId).className = klass_active;

    const boardContent = document.getElementById('boardContent');
    if (!boardContent) return;
    if (tab === 'kanban')    renderKanban(boardContent);
    else if (tab === 'list') renderProjectList(boardContent);
    else if (tab === 'delegated') renderDelegatedBoard(boardContent);
}

// ── Kanban columns ─────────────────────────────────────────────
const KANBAN_COLUMNS = [
    { id: 'Planning',    title: window.STATUS_LABELS ? window.STATUS_LABELS['Planning'] : 'Rencana',         color: 'border-b-purple-500' },
    { id: 'In Progress', title: window.STATUS_LABELS ? window.STATUS_LABELS['In Progress'] : 'Proses (Jalan)', color: 'border-b-blue-500' },
    { id: 'On Hold',     title: window.STATUS_LABELS ? window.STATUS_LABELS['On Hold'] : 'Ditunda',         color: 'border-b-orange-500' },
    { id: 'Done',        title: window.STATUS_LABELS ? window.STATUS_LABELS['Done'] : 'Selesai',         color: 'border-b-emerald-500' }
];

// Helper: apakah saat ini mode monitor?
function _boardTarget() {
    return (typeof boardTargetUid !== 'undefined' && boardTargetUid) ? boardTargetUid : currentUser.uid;
}
function _isMonitoring() {
    return _boardTarget() !== currentUser.uid;
}
function _targetRole() {
    const uid = _boardTarget();
    return allUsers[uid] ? (allUsers[uid].role || 'Staff') : 'Staff';
}

function renderKanban(target) {
    target.className = 'flex overflow-x-auto gap-4 h-full pb-10 w-full snap-x snap-mandatory scroll-smooth';
    target.innerHTML = '';

    const uid = _boardTarget();

    // Papan Kanban = tugas PRIBADI + tugas delegasi MASUK (dengan badge) + undangan meeting
    const myTasks = tasks.filter(function(t) {
        var isMyTask = t.uid === uid;
        var isInvited = t.type === 'meeting' && t.participants && t.participants[uid];
        return isMyTask || isInvited;
    });

    KANBAN_COLUMNS.forEach(function(col) {
        const items  = myTasks.filter(function(t) { return t.status === col.id; });
        const colEl  = document.createElement('div');
        colEl.className = 'min-w-[280px] w-[280px] flex flex-col h-full glass-panel rounded-xl shadow-lg snap-center p-3';
        colEl.setAttribute('data-status', col.id);

        colEl.addEventListener('dragover', function(e) { e.preventDefault(); colEl.classList.add('drag-over'); });
        colEl.addEventListener('dragleave', function() { colEl.classList.remove('drag-over'); });
        colEl.addEventListener('drop', function(e) {
            e.preventDefault();
            colEl.classList.remove('drag-over');
            if (currentUser && (currentUser.role === 'Executive' || currentUser.role === 'DeptExecutive')) return;
            const taskId = e.dataTransfer.getData('taskId');
            if (!taskId) return;
            const upd = col.id === 'Done'
                ? { status: 'Done', endDate: getLocalISODate() }
                : { status: col.id };
            db.ref('tasks/' + taskId).update(upd);
        });

        // Build items HTML using safe string concat (avoids nested template literal SyntaxError)
        var itemsHtml = '';
        if (items.length === 0) {
            itemsHtml = '<div class="empty-state"><i class="fa-solid fa-box-open"></i><p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Kosong</p></div>';
        } else {
            items.forEach(function(t) {
                var delegBadge = '';
                if (t.delegatedBy && t.delegatedBy !== uid) {
                    var del = allUsers[t.delegatedBy];
                    var dn = del ? (del.name || del.email || 'Atasan') : 'Atasan';
                    delegBadge = '<div class="mt-2 text-[9px] bg-orange-900/30 text-orange-400 border border-orange-500/30 px-1.5 py-0.5 rounded font-bold inline-block">'
                               + '<i class="fa-solid fa-share-nodes mr-1"></i>Dari: ' + dn + '</div>';
                }
                var prioFlag = t.priority === 'High'
                    ? '<div class="absolute top-0 right-0 w-8 h-8 overflow-hidden"><div class="absolute top-[-10px] right-[-10px] w-12 h-4 bg-red-500 rotate-45"></div></div>'
                    : '';
                var routineBadge = t.isRoutine
                    ? '<p class="text-[9px] text-purple-400 mt-2"><i class="fa-solid fa-repeat"></i> ' + t.routineType + '</p>'
                    : '';
                itemsHtml +=
                    '<div draggable="true"'
                    + ' ondragstart="event.dataTransfer.setData(\'taskId\',\'' + t.id + '\')"'
                    + ' onclick="openTaskModal(\'' + t.id + '\')"'
                    + ' class="bg-[#2a2a2a] p-4 rounded-xl border border-[#3f3f3f] hover:border-purple-500 cursor-pointer shadow-sm transition group relative overflow-hidden card-hover">'
                    + prioFlag
                    + '<div class="flex justify-between mb-2 items-center">'
                    + '<div class="flex items-center gap-2">'
                    + '<input type="checkbox" data-task-id="' + t.id + '" onclick="event.stopPropagation(); window.toggleTaskSelection(this,\'' + t.id + '\')" class="task-checkbox appearance-none w-4 h-4 border border-gray-500 rounded bg-[#333] checked:bg-purple-500 checked:border-purple-500 cursor-pointer transition shrink-0">'
                    + '<span class="text-[9px] text-blue-400 font-bold uppercase bg-blue-900/20 px-1.5 py-0.5 rounded border border-blue-900/50">' + (t.project || 'Umum') + '</span>'
                    + '</div>'
                    + '<span class="text-[9px] text-gray-500"><i class="fa-regular fa-clock"></i> ' + (t.dueDate || '').slice(5) + '</span>'
                    + '</div>'
                    + '<p class="text-sm text-gray-200 font-bold line-clamp-2 leading-snug">' + (t.title || '') + '</p>'
                    + routineBadge
                    + delegBadge
                    + '</div>';
            });
        }

        var addBtn = !_isMonitoring()
            ? '<button onclick="openTaskModal(null, null, \'task\')" class="mt-3 w-full py-2 border border-dashed border-[#444] rounded-lg text-gray-500 hover:text-white hover:border-purple-500 text-[10px] font-bold uppercase transition">+ Tambah Tugas</button>'
            : '';

        colEl.innerHTML =
            '<h4 class="font-bold text-gray-300 border-b-2 ' + col.color + ' pb-3 mb-4 uppercase tracking-widest text-[10px] flex justify-between">'
            + col.title + ' <span class="bg-[#333] px-2 rounded text-white">' + items.length + '</span>'
            + '</h4>'
            + '<div class="flex-1 space-y-3 overflow-y-auto pr-2 pb-10">'
            + itemsHtml
            + '</div>'
            + addBtn;

        target.appendChild(colEl);
    });
}


function renderProjectList(target) {
    target.className = 'flex flex-col gap-3 overflow-y-auto h-full pb-10 w-full';

    // Simpan scroll sebelum di-render ulang
    var savedScroll = window._projectListScroll || 0;

    var uid = _boardTarget();
    var myTasks = tasks.filter(function(t) {
        var isMyTask = t.uid === uid;
        var isInvited = t.type === 'meeting' && t.participants && t.participants[uid];
        return isMyTask || isInvited;
    });
    var projects = [];
    myTasks.forEach(function(t) {
        var p = t.project || 'Umum';
        if (projects.indexOf(p) === -1) projects.push(p);
    });

    if (projects.length === 0) {
        target.innerHTML = '<div class="text-center text-gray-500 py-10 text-sm">Belum ada data proyek.</div>';
        return;
    }

    var STATUS_CONFIG = {
        'Planning':    { label: window.STATUS_LABELS ? window.STATUS_LABELS['Planning'] : 'Rencana',  color: 'text-gray-400',    bg: 'bg-gray-800',       border: 'border-gray-600' },
        'In Progress': { label: window.STATUS_LABELS ? window.STATUS_LABELS['In Progress'] : 'Berjalan', color: 'text-blue-400',    bg: 'bg-blue-900/20',    border: 'border-blue-600/50' },
        'On Hold':     { label: window.STATUS_LABELS ? window.STATUS_LABELS['On Hold'] : 'Ditunda',  color: 'text-orange-400',  bg: 'bg-orange-900/20',  border: 'border-orange-600/50' },
        'Done':        { label: window.STATUS_LABELS ? window.STATUS_LABELS['Done'] : 'Selesai',  color: 'text-emerald-400', bg: 'bg-emerald-900/20', border: 'border-emerald-600/50' },
        'Cancelled':   { label: window.STATUS_LABELS ? window.STATUS_LABELS['Cancelled'] : 'Batal',    color: 'text-red-400',     bg: 'bg-red-900/20',     border: 'border-red-600/50' },
    };
    var FILTER_CONFIG = [
        { key: 'all',         label: 'Semua',    icon: 'fa-layer-group',   cls: 'text-gray-300  border-gray-600' },
        { key: 'active',      label: 'Aktif',    icon: 'fa-spinner',       cls: 'text-blue-400  border-blue-600' },
        { key: 'Planning',    label: window.STATUS_LABELS ? window.STATUS_LABELS['Planning'] : 'Rencana',  icon: 'fa-clock',         cls: 'text-gray-400  border-gray-600' },
        { key: 'In Progress', label: window.STATUS_LABELS ? window.STATUS_LABELS['In Progress'] : 'Berjalan', icon: 'fa-bolt',          cls: 'text-blue-400  border-blue-600' },
        { key: 'On Hold',     label: window.STATUS_LABELS ? window.STATUS_LABELS['On Hold'] : 'Ditunda',  icon: 'fa-pause',         cls: 'text-orange-400 border-orange-600' },
        { key: 'Done',        label: window.STATUS_LABELS ? window.STATUS_LABELS['Done'] : 'Selesai', icon: 'fa-check',         cls: 'text-emerald-400 border-emerald-600' },
        { key: 'Cancelled',   label: window.STATUS_LABELS ? window.STATUS_LABELS['Cancelled'] : 'Batal',    icon: 'fa-ban',           cls: 'text-red-400   border-red-600' },
    ];

    var curFilter = window._projectListFilter || 'all';
    var canEdit   = !_isMonitoring();

    // Hitung jumlah per filter untuk badge
    function countByFilter(fkey) {
        if (fkey === 'all') return myTasks.length;
        if (fkey === 'active') return myTasks.filter(function(t) { return t.status === 'In Progress' || t.status === 'Planning'; }).length;
        return myTasks.filter(function(t) { return t.status === fkey; }).length;
    }

    // Filter bar
    var filterBar = '<div class="flex flex-wrap gap-1.5 mb-4 sticky top-0 z-10 bg-[#111111]/90 backdrop-blur py-2 px-1 -mx-1 rounded-lg">' +
        FILTER_CONFIG.map(function(f) {
            var isActive = (curFilter === f.key);
            var count = countByFilter(f.key);
            var activeBase = 'px-3 py-1.5 rounded-lg text-[10px] font-bold transition border cursor-pointer select-none flex items-center gap-1.5 ';
            var cls = isActive
                ? activeBase + f.cls + ' bg-white/5'
                : activeBase + 'text-gray-600 border-gray-800 hover:text-gray-400 hover:border-gray-600';
            return '<button onclick="setProjectFilter(\'' + f.key + '\')" class="' + cls + '">'
                + '<i class="fa-solid ' + f.icon + ' text-[9px]"></i>' + f.label
                + '<span class="text-[9px] opacity-60">' + count + '</span>'
                + '</button>';
        }).join('') + '</div>';

    // Build project cards
    var cards = projects.map(function(proj) {
        var allPTasks = myTasks.filter(function(t) { return (t.project || 'Umum') === proj; });

        // Apply filter to tasks inside this project
        var pTasks;
        if (curFilter === 'all') {
            pTasks = allPTasks;
        } else if (curFilter === 'active') {
            pTasks = allPTasks.filter(function(t) { return t.status === 'In Progress' || t.status === 'Planning'; });
        } else {
            pTasks = allPTasks.filter(function(t) { return t.status === curFilter; });
        }

        if (pTasks.length === 0) return ''; // Sembunyikan project yang kosong setelah filter

        var doneCount   = allPTasks.filter(function(t) { return t.status === 'Done'; }).length;
        var activeCount = allPTasks.filter(function(t) { return t.status === 'In Progress'; }).length;
        var totalCount  = allPTasks.length;
        var donePercent = totalCount > 0 ? Math.round((doneCount / totalCount) * 100) : 0;

        var safeProj = proj.replace(/'/g, "\\'");
        var editBtn = canEdit
            ? '<button onclick="renameProject(\'' + safeProj + '\')" class="text-[9px] text-gray-500 hover:text-violet-400 border border-gray-700 hover:border-violet-500 px-2 py-0.5 rounded transition"><i class="fa-solid fa-pen-to-square mr-1"></i>Ganti Nama</button>'
            : '';

        var taskCards = pTasks.map(function(t) {
            var cfg = STATUS_CONFIG[t.status] || STATUS_CONFIG['Planning'];
            return '<div onclick="openTaskModal(\'' + t.id + '\')"'
                + ' id="proj-task-' + t.id + '"'
                + ' class="flex justify-between items-center bg-[#252526] p-3 rounded-lg cursor-pointer hover:bg-[#2f2f2f] border border-[#3f3f3f] transition group">'
                + '<div class="flex items-center gap-3 truncate">'
                + '<input type="checkbox" data-task-id="' + t.id + '" onclick="event.stopPropagation(); window.toggleTaskSelection(this, \'' + t.id + '\')" class="task-checkbox appearance-none w-4 h-4 border border-gray-500 rounded bg-[#333] checked:bg-purple-500 checked:border-purple-500 cursor-pointer transition shrink-0 relative after:content-[\'\'] after:absolute after:hidden checked:after:block after:left-[4px] after:top-[1px] after:w-[5px] after:h-[10px] after:border-r-2 after:border-b-2 after:border-white after:rotate-45">'
                + '<span class="text-xs font-bold text-gray-300 truncate pr-2 group-hover:text-white">' + t.title + '</span>'
                + '</div>'
                + '<span class="text-[9px] font-bold px-2 py-0.5 rounded border ' + cfg.color + ' ' + cfg.bg + ' ' + cfg.border + ' uppercase shrink-0">' + cfg.label + '</span>'
                + '</div>';
        }).join('');

        return '<div class="bg-[#202020] rounded-xl p-5 border border-[#2f2f2f] shadow-md animate-fadein">'
            + '<div class="flex items-center justify-between border-b border-[#333] pb-3 mb-4">'
            + '<h3 class="text-sm font-bold text-purple-400 uppercase tracking-widest"><i class="fa-solid fa-folder-open mr-2"></i>' + proj + '</h3>'
            + '<div class="flex items-center gap-3">'
            + '<span class="text-[9px] text-gray-500">' + totalCount + ' tugas · ' + doneCount + ' selesai · ' + activeCount + ' berjalan</span>'
            + editBtn
            + '</div></div>'
            + '<div class="w-full bg-[#333] rounded-full h-1 mb-3">'
            + '<div class="bg-violet-500 h-1 rounded-full transition-all" style="width:' + donePercent + '%"></div>'
            + '</div>'
            + '<div class="grid grid-cols-1 md:grid-cols-2 gap-3">' + taskCards + '</div>'
            + '</div>';
    }).join('');

    target.innerHTML = filterBar + (cards.trim() || '<div class="text-center text-gray-600 italic text-sm py-10">Tidak ada tugas dengan filter ini.</div>');

    // Restore posisi scroll setelah render
    setTimeout(function() {
        target.scrollTop = savedScroll;
    }, 0);

    // Pasang event scroll saver
    target.onscroll = function() {
        window._projectListScroll = target.scrollTop;
    };
}

// Set filter proyek — reset scroll ke atas karena filter berubah
function setProjectFilter(filter) {
    window._projectListFilter = filter;
    window._projectListScroll = 0; // Reset scroll saat filter ganti
    var bc = document.getElementById('boardContent');
    if (bc) renderProjectList(bc);
}

// Ganti nama proyek — update semua task sekaligus
function renameProject(oldName) {
    var newName = prompt('Ganti nama proyek "' + oldName + '" menjadi:', oldName);
    if (!newName || !newName.trim() || newName.trim() === oldName) return;
    newName = newName.trim();

    var uid = _boardTarget();
    var toUpdate = tasks.filter(function(t) {
        return t.uid === uid && (t.project || 'Umum') === oldName;
    });

    if (toUpdate.length === 0) { showToast('Tidak ada tugas ditemukan.', 'error'); return; }

    var batch = {};
    toUpdate.forEach(function(t) { batch['tasks/' + t.id + '/project'] = newName; });
    db.ref().update(batch)
        .then(function() { showToast('Proyek "' + oldName + '" → "' + newName + '" (' + toUpdate.length + ' tugas diperbarui)', 'success'); })
        .catch(function(e) { showToast('Gagal: ' + e.message, 'error'); });
}

function renderDelegatedBoard(target) {
    target.className = 'flex flex-col gap-4 overflow-y-auto h-full pb-10 w-full';
    target.innerHTML = '';

    const uid          = _boardTarget();
    const isMonitoring = _isMonitoring();
    const tRole        = _targetRole();
    const targetName   = allUsers[uid] ? (allUsers[uid].name || 'Karyawan') : 'Karyawan';

    // Staff only gets 'inbound'. Management can toggle.
    const showToggle = (tRole !== 'Staff');
    
    if (typeof window._delegationViewMode === 'undefined') {
        window._delegationViewMode = showToggle ? 'outbound' : 'inbound'; // Default for SPV is outbound (what they gave out)
    }
    // Force inbound if looking at a Staff
    if (!showToggle) window._delegationViewMode = 'inbound';

    let delegatedTasks = [];
    let headerMsg      = '';

    if (window._delegationViewMode === 'inbound') {
        delegatedTasks = tasks.filter(t => t.uid === uid && t.delegatedBy && t.delegatedBy !== uid);
        const titleText = isMonitoring ? `Tugas Masuk ke: <span class="text-white">${targetName}</span>` : 'Tugas yang Didelegasikan kepada Anda';
        const bgClass = isMonitoring ? 'bg-blue-900/20 border-blue-500/30 text-blue-400' : 'bg-orange-900/20 border-orange-500/30 text-orange-400';
        headerMsg = `<div class="${bgClass} border p-2.5 rounded-lg text-[10px] font-bold uppercase flex justify-between items-center w-full">
            <span class="flex items-center gap-2"><i class="fa-solid fa-inbox"></i> ${titleText}</span>
        </div>`;
    } else {
        delegatedTasks = tasks.filter(t => t.delegatedBy === uid && t.uid !== uid);
        const titleText = isMonitoring ? `Delegasi Keluar dari: <span class="text-white">${targetName}</span>` : 'Tugas yang Anda Delegasikan Keluar';
        headerMsg = `<div class="bg-purple-900/20 border border-purple-500/30 text-purple-400 p-2.5 rounded-lg text-[10px] font-bold uppercase flex justify-between items-center w-full">
            <span class="flex items-center gap-2"><i class="fa-solid fa-share-nodes"></i> ${titleText}</span>
        </div>`;
    }

    const headerEl = document.createElement('div');
    headerEl.innerHTML = headerMsg;

    if (showToggle) {
        const toggleHtml = `
            <div class="flex bg-[#1a1a1a] border border-[#333] rounded overflow-hidden shadow">
                <button onclick="window._delegationViewMode='inbound'; renderDelegatedBoard(document.getElementById('boardContent'))" class="px-3 py-1 transition ${window._delegationViewMode==='inbound' ? 'bg-orange-600 text-white':'text-gray-500 hover:text-white'}">Inbound</button>
                <button onclick="window._delegationViewMode='outbound'; renderDelegatedBoard(document.getElementById('boardContent'))" class="px-3 py-1 transition ${window._delegationViewMode==='outbound' ? 'bg-purple-600 text-white':'text-gray-500 hover:text-white'}">Outbound</button>
            </div>
        `;
        headerEl.firstChild.innerHTML += toggleHtml;
    }

    target.appendChild(headerEl);

    // Kanban columns wrapper
    const columnsWrapper = document.createElement('div');
    columnsWrapper.className = 'flex overflow-x-auto gap-4 flex-1 snap-x snap-mandatory scroll-smooth pb-4';
    target.appendChild(columnsWrapper);

    KANBAN_COLUMNS.forEach(col => {
        const items = delegatedTasks.filter(t => t.status === col.id);
        const colEl = document.createElement('div');
        colEl.className = 'min-w-[280px] w-[280px] flex flex-col h-full glass-panel rounded-xl shadow-lg snap-center p-3 opacity-95';

        // Allow drag-drop (so assigned person can move their cards)
        colEl.setAttribute('data-status', col.id);
        colEl.addEventListener('dragover', e => { e.preventDefault(); colEl.classList.add('drag-over'); });
        colEl.addEventListener('dragleave', () => colEl.classList.remove('drag-over'));
        colEl.addEventListener('drop', e => {
            e.preventDefault();
            colEl.classList.remove('drag-over');
            if (currentUser && (currentUser.role === 'Executive' || currentUser.role === 'DeptExecutive')) return;
            const taskId = e.dataTransfer.getData('taskId');
            if (!taskId) return;
            const upd = col.id === 'Done' ? { status: 'Done', endDate: getLocalISODate() } : { status: col.id };
            db.ref('tasks/' + taskId).update(upd);
        });

        colEl.innerHTML = `
        <h4 class="font-bold text-gray-300 border-b-2 ${col.color} pb-3 mb-4 uppercase tracking-widest text-[10px] flex justify-between">
            ${col.title} <span class="bg-[#333] px-2 rounded text-white">${items.length}</span>
        </h4>
        <div class="flex-1 space-y-3 overflow-y-auto pr-2 pb-10">
            ${items.length === 0
                ? `<div class="empty-state"><i class="fa-solid fa-wind"></i><p class="text-xs text-gray-500 font-bold uppercase">Kosong</p></div>`
                : items.map(t => {
                    // Determine the "from" and "to" label based on mode
                    let badge = '';
                    if (!isMonitoring || tRole === 'Staff') {
                        // Show who delegated it
                        const fromUser = allUsers[t.delegatedBy];
                        const fromName = fromUser ? (fromUser.name || 'Atasan') : 'Atasan';
                        badge = `<div class="mt-2 text-[9px] text-orange-400 bg-orange-900/20 px-1.5 py-0.5 rounded inline-block border border-orange-900/50 font-bold">
                            <i class="fa-solid fa-share-nodes"></i> Dari: ${fromName}
                        </div>`;
                    } else {
                        // Show who is assigned
                        const toUser = allUsers[t.uid];
                        const toName = toUser ? (toUser.name || 'Seseorang') : 'Seseorang';
                        badge = `<div class="mt-2 text-[9px] text-emerald-400 bg-emerald-900/20 px-1.5 py-0.5 rounded inline-block border border-emerald-900/50 font-bold">
                            <i class="fa-solid fa-user-arrow-right"></i> Dikerjakan: ${toName}
                        </div>`;
                    }
                    return `
                    <div draggable="true"
                         ondragstart="event.dataTransfer.setData('taskId','${t.id}')"
                         onclick="openTaskModal('${t.id}')"
                         class="bg-[#202020] p-4 rounded-xl border border-[#3f3f3f] hover:border-purple-500 cursor-pointer shadow-sm transition group relative overflow-hidden card-hover">
                        ${t.priority === 'High' ? `<div class="absolute top-0 right-0 w-8 h-8 overflow-hidden"><div class="absolute top-[-10px] right-[-10px] w-12 h-4 bg-red-500 rotate-45"></div></div>` : ''}
                        <div class="flex justify-between mb-2 items-center">
                            <span class="text-[9px] text-blue-400 font-bold uppercase bg-blue-900/20 px-1.5 py-0.5 rounded border border-blue-900/50">${t.project || 'Umum'}</span>
                            <span class="text-[9px] text-gray-500"><i class="fa-regular fa-clock"></i> ${(t.dueDate || '').slice(5)}</span>
                        </div>
                        <p class="text-sm text-gray-200 font-bold line-clamp-2 leading-snug">${t.title}</p>
                        ${badge}
                    </div>`;
                }).join('')}
        </div>
        ${col.id === 'Planning' && !isMonitoring ? `
        <button onclick="openTaskModal(null, null, 'task', true)"
            class="mt-3 w-full py-2 border border-dashed border-purple-500/50 rounded-lg text-purple-400 hover:bg-purple-900/20 text-[10px] font-bold uppercase transition">
            <i class="fa-solid fa-share-nodes"></i> Delegasikan Tugas Baru
        </button>` : ''}`;
        columnsWrapper.appendChild(colEl);
    });
}
