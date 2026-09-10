/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/executive.js — Executive Dashboard View
   Akses: Executive (semua dept), DeptExecutive (1 dept), SuperAdmin
   ============================================================ */

var execDrillDept = null;
var execDrillUser = null;

window._execFilters = window._execFilters || {
    dept: '',
    startDate: '',
    endDate: '',
    prio: '',
    status: 'Aktif',
    showRoutine: true
};

window.updateExecFilter = function(key, val) {
    if ((key === 'startDate' || key === 'endDate') && val && val.length > 0 && val.length < 10) return; // Prevent partial date refresh
    if (key === 'showRoutine') {
        window._execFilters.showRoutine = (val === 'true');
    } else {
        window._execFilters[key] = val;
    }
    var c = document.getElementById('viewContainer');
    if (c) {
        if (execDrillUser) execDrillToUser(execDrillUser);
        else if (execDrillDept) execDrillToDept(execDrillDept);
        else _renderExecMain(c);
    }
};

function renderExecutiveView(c) {
    var role = currentUser ? currentUser.role : '';
    if (role !== 'Executive' && role !== 'DeptExecutive' && role !== 'SuperAdmin' && role !== 'Direktur') {
        c.innerHTML = '<p class="text-center text-red-500 mt-10">Akses Ditolak.</p>';
        return;
    }
    execDrillDept = null;
    execDrillUser = null;
    _renderExecMain(c);
}

function _renderExecMain(c) {
    var role      = currentUser ? currentUser.role : '';
    var watchDept = (role === 'DeptExecutive') ? (currentUser.watchDepartment || currentUser.department) : null;
    
    var todayObj = new Date();
    var todayStr = getLocalISODate(todayObj);
    
    // Hitung awal dan akhir pekan ini (Senin - Minggu)
    var dayOfWeek = todayObj.getDay() || 7; // 1-7
    var startOfWeek = new Date(todayObj); startOfWeek.setDate(todayObj.getDate() - dayOfWeek + 1);
    var endOfWeek = new Date(startOfWeek); endOfWeek.setDate(startOfWeek.getDate() + 6);
    
    // Pekan depan
    var startOfNextWeek = new Date(endOfWeek); startOfNextWeek.setDate(endOfWeek.getDate() + 1);
    var endOfNextWeek = new Date(startOfNextWeek); endOfNextWeek.setDate(startOfNextWeek.getDate() + 6);
    
    var currentMonth = todayObj.getMonth();
    var currentYear = todayObj.getFullYear();

    var depts = {};
    var deptTimelines = {}; // Group timeline per divisi

    tasks.forEach(function(t) {
        var d = t.department || 'Tidak Diketahui';
        
        // 1. Role-based Department filter
        if (watchDept && d !== watchDept) return;
        
        // 2. UI Filters
        var f = window._execFilters;
        f.status = f.status || 'Aktif';

        if (f.dept && d !== f.dept) return;
        if (!f.showRoutine && t.isRoutine) return;
        if (f.prio && t.priority !== f.prio) return;
        
        // 3. Date Filter (Check both dueDate and endDate against range)
        if (f.startDate) {
            var refDate = t.dueDate || t.endDate;
            if (!refDate || refDate < f.startDate) return;
        }
        if (f.endDate) {
            var refDate2 = t.endDate || t.dueDate;
            if (!refDate2 || refDate2 > f.endDate) return;
        }

        // Metrik Health Score per Departemen (Dihitung sebelum filter status)
        if (!depts[d]) depts[d] = { total: 0, done: 0, overdue: 0, active: 0 };
        depts[d].total++;
        if (t.status === 'Done') depts[d].done++;
        else if (t.status !== 'Cancelled') depts[d].active++;
        
        if (t.dueDate && t.status !== 'Done' && t.status !== 'Cancelled' && t.dueDate < todayStr) {
            depts[d].overdue++;
        }

        var isSpecificStatus = ['Planning', 'In Progress', 'On Hold', 'Done', 'Cancelled'].includes(f.status);
        if (isSpecificStatus && t.status !== f.status) return;
        if (f.status === 'Aktif' && (t.status === 'Done' || t.status === 'Cancelled')) return;
        
        // Timeline grouping
        if (t.dueDate || t.endDate) {
            if (!deptTimelines[d]) deptTimelines[d] = { thisWeek: [], nextWeek: [], thisMonth: [], filteredList: [] };

            var dueObj = new Date(t.dueDate || t.endDate);
            var dueStr = getLocalISODate(dueObj);
            
            var tCopy = Object.assign({}, t);
            tCopy.assignedName = allUsers[t.uid] ? (allUsers[t.uid].name || allUsers[t.uid].email) : 'Sistem';
            
            var isCustomTimeline = (f.status !== 'Aktif' || f.startDate || f.endDate);

            if (isCustomTimeline) {
                deptTimelines[d].filteredList.push(tCopy);
            } else if (t.status !== 'Done' && t.status !== 'Cancelled') {
                if (dueStr >= getLocalISODate(startOfWeek) && dueStr <= getLocalISODate(endOfWeek)) {
                    deptTimelines[d].thisWeek.push(tCopy);
                } else if (dueStr >= getLocalISODate(startOfNextWeek) && dueStr <= getLocalISODate(endOfNextWeek)) {
                    deptTimelines[d].nextWeek.push(tCopy);
                } else if (dueObj.getMonth() === currentMonth && dueObj.getFullYear() === currentYear && dueStr > getLocalISODate(endOfNextWeek)) {
                    deptTimelines[d].thisMonth.push(tCopy);
                }
            }
        }
    });

    var deptKeys = Object.keys(depts).sort();
    // Collapse state — persisted in localStorage
    if (!window._execCollapsed) {
        try { 
            var parsed = JSON.parse(localStorage.getItem('execCollapsed') || '{"score":{},"timeline":{}}'); 
            window._execCollapsed = parsed.score ? parsed : { score: parsed, timeline: {} };
        } catch(e) { window._execCollapsed = { score: {}, timeline: {} }; }
    }
    window.toggleExecDept = function(d, type) {
        if (!type) type = 'score';
        window._execCollapsed[type] = window._execCollapsed[type] || {};
        window._execCollapsed[type][d] = !window._execCollapsed[type][d];
        try { localStorage.setItem('execCollapsed', JSON.stringify(window._execCollapsed)); } catch(e) {}
        
        var safeId = (type === 'timeline' ? 'tl_' : '') + d.replace(/\s+/g,'_');

        var body = document.getElementById('execDeptBody_' + safeId);
        var icon = document.getElementById('execDeptIcon_' + safeId);
        if (body) body.style.display = window._execCollapsed[type][d] ? 'none' : '';
        if (icon) icon.className = window._execCollapsed[type][d] ? 'fa-solid fa-chevron-right text-gray-600 text-xs' : 'fa-solid fa-chevron-down text-gray-400 text-xs';
    };

    // 1. Departemen Health Score
    var deptCards = deptKeys.map(function(d) {
        var info = depts[d];
        var pct  = info.total > 0 ? Math.round((info.done / info.total) * 100) : 0;
        var barColor = pct >= 70 ? 'bg-emerald-500' : pct >= 40 ? 'bg-yellow-500' : 'bg-red-500';
        var overdueTag = info.overdue > 0 
            ? '<span class="text-[9px] bg-red-900/30 text-red-400 border border-red-500/30 px-2 py-0.5 rounded font-bold">' + info.overdue + ' OVERDUE</span>' 
            : '';
        var safeId = d.replace(/\s+/g,'_');
        var isCollapsed = !!(window._execCollapsed.score && window._execCollapsed.score[d]);
        var chevronClass = isCollapsed ? 'fa-solid fa-chevron-right text-gray-600 text-xs' : 'fa-solid fa-chevron-down text-gray-400 text-xs';
        return '<div class="card-bg rounded-xl border border-[#3f3f3f] hover:border-blue-500/60 transition overflow-hidden">' +
            '<div class="flex items-center justify-between p-4 cursor-pointer" onclick="toggleExecDept(\'' + d + '\', \'score\')">' +
            '<div class="flex items-center gap-2">' +
            '<i id="execDeptIcon_' + safeId + '" class="' + chevronClass + '"></i>' +
            '<h4 class="text-white font-bold text-sm uppercase">' + d + '</h4>' + overdueTag +
            '</div>' +
            '<button onclick="execDrillToDept(\'' + d + '\'); event.stopPropagation()" class="text-[9px] text-blue-400 hover:text-blue-300 border border-blue-800/40 px-2 py-0.5 rounded transition"><i class="fa-solid fa-arrow-right mr-1"></i>Detail</button>' +
            '</div>' +
            '<div id="execDeptBody_' + safeId + '" style="' + (isCollapsed ? 'display:none' : '') + '">' +
            '<div class="px-4 pb-4">' +
            '<div class="flex justify-between text-[10px] text-gray-400 mb-1">' +
            '<span>Penyelesaian (' + info.done + '/' + info.total + ')</span><span class="text-white font-bold">' + pct + '%</span>' +
            '</div>' +
            '<div class="w-full bg-gray-800 h-1.5 rounded-full overflow-hidden mb-2">' +
            '<div class="' + barColor + ' h-1.5 rounded-full" style="width:' + pct + '%"></div></div>' +
            '<p class="text-[9px] text-gray-500 text-right">Aktif: ' + info.active + ' | Overdue: ' + info.overdue + '</p>' +
            '</div></div></div>';
    }).join('') || '<p class="text-gray-500 text-xs italic">Tidak ada data proyek aktif (Non-Rutin, Sedang/Tinggi).</p>';


    // 2. Render Timeline Row Helper
    function renderTimelineRow(list) {
        if (!list || list.length === 0) return '';
        return list.sort(function(a,b){return (a.dueDate||'').localeCompare(b.dueDate||'');}).map(function(t) {
            var isOverdue = t.dueDate < todayStr;
            var prioColor = t.priority === 'Critical' ? 'text-red-400' : (t.priority === 'High' ? 'text-orange-400' : 'text-blue-400');
            return '<div onclick="openTaskModal(\'' + t.id + '\')" class="flex items-center gap-3 p-2 bg-[#1a1a1a] rounded border border-[#2a2a2a] mb-1.5 cursor-pointer hover:border-violet-500/40 hover:bg-[#1e1b2e] transition group">' +
                '<div class="w-1 h-full self-stretch rounded-full ' + (isOverdue ? 'bg-red-500' : 'bg-[#3f3f3f]') + '"></div>' +
                '<div class="flex-1 min-w-0">' +
                '<p class="text-white text-[11px] font-semibold truncate group-hover:text-violet-200 transition">' + (t.title||'Tanpa Judul') + '</p>' +
                '<p class="text-[9px] text-gray-500 truncate">' + (t.assignedName || 'Tanpa Nama') + ' <span class="' + prioColor + '">&bull; ' + (window.PRIORITY_LABELS ? window.PRIORITY_LABELS[t.priority] || t.priority : t.priority) + '</span></p>' +
                '</div>' +
                '<div class="text-right shrink-0 flex items-center gap-2">' +
                '<div>' +
                '<p class="text-[10px] font-bold ' + (isOverdue ? 'text-red-400' : 'text-gray-400') + '">' + (t.dueDate||'-') + '</p>' +
                '<p class="text-[8px] uppercase text-gray-500">' + (window.STATUS_LABELS ? window.STATUS_LABELS[t.status] || t.status : t.status || '-') + '</p>' +
                '</div>' +
                '<i class="fa-solid fa-chevron-right text-[9px] text-gray-600 group-hover:text-violet-400 transition"></i>' +
                '</div></div>';
        }).join('');
    }

    // 3. Render Divisi Timelines (collapsible)
    var allDivisionsTimeline = deptKeys.map(function(d) {
        var tData = deptTimelines[d];
        if (!tData) return '';
        var customHtml = renderTimelineRow(tData.filteredList);
        var weekHtml = renderTimelineRow(tData.thisWeek);
        var nextHtml = renderTimelineRow(tData.nextWeek);
        var monthHtml = renderTimelineRow(tData.thisMonth);
        if (!customHtml && !weekHtml && !nextHtml && !monthHtml) return '';
        var safeId = 'tl_' + d.replace(/\s+/g,'_');
        var isCollapsed = !!(window._execCollapsed.timeline && window._execCollapsed.timeline[d]);
        return '<div class="bg-[#151515] rounded-xl border border-[#2a2a2a] mb-4 overflow-hidden">' +
               '<div class="flex items-center justify-between px-4 py-3 cursor-pointer" onclick="toggleExecDept(\'' + d + '\', \'timeline\')">' +
               '<h4 class="text-sm font-bold text-white uppercase tracking-widest">' + d + '</h4>' +
               '<i id="execDeptIcon_' + safeId + '" class="' + (isCollapsed ? 'fa-solid fa-chevron-right text-gray-600' : 'fa-solid fa-chevron-down text-gray-400') + ' text-xs"></i>' +
               '</div>' +
               '<div id="execDeptBody_' + safeId + '" style="' + (isCollapsed ? 'display:none' : '') + '" class="px-4 pb-4">' +
               (customHtml ? '<div class="mb-3"><h5 class="text-[10px] font-bold text-gray-400 mb-1">Daftar Tugas Berdasarkan Filter</h5>' + customHtml + '</div>' : '') +
               (weekHtml ? '<div class="mb-3"><h5 class="text-[10px] font-bold text-emerald-400 mb-1">Pekan Ini</h5>' + weekHtml + '</div>' : '') +
               (nextHtml ? '<div class="mb-3"><h5 class="text-[10px] font-bold text-blue-400 mb-1">Pekan Depan</h5>' + nextHtml + '</div>' : '') +
               (monthHtml ? '<div><h5 class="text-[10px] font-bold text-yellow-400 mb-1">Sisa Bulan Ini</h5>' + monthHtml + '</div>' : '') +
               '</div></div>';
    }).join('') || '<p class="text-gray-500 text-xs italic">Tidak ada proyek yang sesuai dengan kriteria filter.</p>';


    var headerLabel = watchDept ? ('Departemen ' + watchDept) : 'Semua Departemen';

    var filterHtml = '<div class="card-bg p-4 rounded-xl border border-[#3f3f3f] mb-6 flex flex-wrap gap-4 items-center text-xs">' +
        '<div class="flex items-center gap-2"><i class="fa-solid fa-filter text-gray-400"></i><span class="text-white font-bold">Filter:</span></div>' +
        '<select onchange="updateExecFilter(\'dept\', this.value)" class="input-bg border border-[#3f3f3f] text-white rounded px-2 py-1">' +
            '<option value="">Semua Divisi</option>' +
            (watchDept ? '<option value="' + watchDept + '" ' + (_execFilters.dept===watchDept?'selected':'') + '>' + watchDept + '</option>' 
                       : [...new Set(tasks.map(t => t.department).filter(Boolean))].map(d => '<option value="'+d+'" '+(_execFilters.dept===d?'selected':'')+'>'+d+'</option>').join('')) +
        '</select>' +
        '<select onchange="updateExecFilter(\'status\', this.value)" class="input-bg border border-[#3f3f3f] text-white rounded px-2 py-1">' +
            '<option value="Aktif" ' + (_execFilters.status==='Aktif'?'selected':'') + '>Aktif (Proses/Rencana/Ditunda)</option>' +
            '<option value="Planning" ' + (_execFilters.status==='Planning'?'selected':'') + '>Rencana</option>' +
            '<option value="In Progress" ' + (_execFilters.status==='In Progress'?'selected':'') + '>Proses (Jalan)</option>' +
            '<option value="On Hold" ' + (_execFilters.status==='On Hold'?'selected':'') + '>Ditunda</option>' +
            '<option value="Done" ' + (_execFilters.status==='Done'?'selected':'') + '>Selesai</option>' +
            '<option value="Cancelled" ' + (_execFilters.status==='Cancelled'?'selected':'') + '>Batal</option>' +
            '<option value="Semua Status" ' + (_execFilters.status==='Semua Status'?'selected':'') + '>Semua Status</option>' +
        '</select>' +
        '<select onchange="updateExecFilter(\'prio\', this.value)" class="input-bg border border-[#3f3f3f] text-white rounded px-2 py-1">' +
            '<option value="">Semua Prioritas</option>' +
            '<option value="High" ' + (_execFilters.prio==='High'?'selected':'') + '>Tinggi (High) 🔥</option>' +
            '<option value="Medium" ' + (_execFilters.prio==='Medium'?'selected':'') + '>Sedang (Mid) ⚡</option>' +
            '<option value="Low" ' + (_execFilters.prio==='Low'?'selected':'') + '>Rendah (Low) ☕</option>' +
        '</select>' +
        '<select onchange="updateExecFilter(\'showRoutine\', this.value)" class="input-bg border border-[#3f3f3f] text-white rounded px-2 py-1">' +
            '<option value="true" ' + (_execFilters.showRoutine?'selected':'') + '>Termasuk Rutinitas</option>' +
            '<option value="false" ' + (!_execFilters.showRoutine?'selected':'') + '>Sembunyikan Rutinitas</option>' +
        '</select>' +
        '<div class="flex items-center gap-2 border-l border-[#3f3f3f] pl-4">' +
            '<span class="text-gray-400">Tgl:</span>' +
            '<input type="date" value="' + _execFilters.startDate + '" onblur="updateExecFilter(\'startDate\', this.value)" class="input-bg border border-[#3f3f3f] text-white rounded px-2 py-1">' +
            '<span class="text-gray-400">-</span>' +
            '<input type="date" value="' + _execFilters.endDate + '" onblur="updateExecFilter(\'endDate\', this.value)" class="input-bg border border-[#3f3f3f] text-white rounded px-2 py-1">' +
        '</div>' +
    '</div>';

    c.innerHTML = '<div class="space-y-6 max-w-6xl mx-auto animate-fadein pb-10">' +
        // Header
        '<div>' +
        '<h2 class="text-xl font-bold text-white flex items-center gap-2"><i class="fa-solid fa-crown text-yellow-400"></i> Executive Dashboard</h2>' +
        '<p class="text-xs text-gray-500 mt-1">PT Solusi Mitra Aplikasi &mdash; ' + headerLabel + '</p>' +
        '</div>' + filterHtml +

        // Grid Utama (Kiri: Timeline, Kanan: Health Score)
        '<div class="flex flex-col lg:flex-row gap-6">' +
        
        // Kiri: Timeline Proyeksi (Lebar 60%)
        '<div class="flex-[3] space-y-4">' +
        '<div class="card-bg p-5 rounded-xl border border-[#3f3f3f]">' +
        '<h3 class="text-sm font-bold text-white mb-4 uppercase tracking-wider border-b border-[#2f2f2f] pb-2">' +
        '<i class="fa-regular fa-calendar-days text-blue-400 mr-2"></i> Timeline Proyek Aktif (Per Divisi)</h3>' +
        '<div class="max-h-[600px] overflow-y-auto pr-2">' + allDivisionsTimeline + '</div>' +
        '</div>' + // end card-bg
        '</div>' + // end kiri

        // Kanan: Health Score (Lebar 40%)
        '<div class="flex-[2] space-y-4">' +
        '<div class="bg-[#111] p-5 rounded-xl border border-[#2f2f2f]">' +
        '<h3 class="text-sm font-bold text-white mb-4 uppercase tracking-wider border-b border-[#2f2f2f] pb-2">' +
        '<i class="fa-solid fa-heart-pulse text-red-400 mr-2"></i> Health Score Departemen</h3>' +
        '<div class="space-y-3 max-h-[600px] overflow-y-auto pr-2">' + deptCards + '</div>' +
        '</div>' +
        '</div>' + // end kanan

        '</div>' + // end grid flex
        '</div>'; // end container
}

window.execDrillToDept = function(dept) {
    execDrillDept = dept;
    execDrillUser = null;
    var c = document.getElementById('viewContainer');
    if (!c) return;

    var uids = {};
    // Cek dengan filter yg sama
    tasks.filter(function(t) { 
        if (t.department !== dept) return false;
        var f = window._execFilters;
        if (!f.showRoutine && t.isRoutine) return false;
        if (f.prio && t.priority !== f.prio) return false;
        if (f.startDate && (t.dueDate||t.endDate) < f.startDate) return false;
        if (f.endDate && (t.endDate||t.dueDate) > f.endDate) return false;
        return true;
    }).forEach(function(t) {
        if (!t.uid) return;
        if (!uids[t.uid]) uids[t.uid] = { total: 0, done: 0, inProgress: 0 };
        uids[t.uid].total++;
        if (t.status === 'Done')        uids[t.uid].done++;
        if (t.status === 'In Progress') uids[t.uid].inProgress++;
    });

    var userCards = Object.keys(uids).map(function(uid) {
        var info    = uids[uid];
        var profile = allUsers[uid] || {};
        var name    = profile.name || profile.email || uid;
        var pct     = info.total > 0 ? Math.round((info.done / info.total) * 100) : 0;
        return '<div onclick="execDrillToUser(\'' + uid + '\')" class="card-bg p-4 rounded-xl border border-[#3f3f3f] hover:border-violet-500/60 cursor-pointer transition group flex items-center gap-4">' +
            '<div class="w-10 h-10 rounded-full bg-violet-900/30 border border-violet-500/30 flex items-center justify-center text-violet-300 font-bold text-sm shrink-0">' + name.charAt(0).toUpperCase() + '</div>' +
            '<div class="flex-1 min-w-0">' +
            '<p class="text-white font-semibold text-sm group-hover:text-violet-300 transition truncate">' + name + '</p>' +
            '<p class="text-[10px] text-gray-500">' + info.done + ' selesai / ' + info.total + ' proyek &nbsp;&bull;&nbsp; ' + pct + '%</p>' +
            '<div class="w-full bg-gray-800 h-1 rounded-full mt-1 overflow-hidden"><div class="bg-violet-500 h-1 rounded-full" style="width:' + pct + '%"></div></div>' +
            '</div>' +
            '<i class="fa-solid fa-chevron-right text-gray-600 group-hover:text-violet-400 transition"></i>' +
            '</div>';
    }).join('') || '<p class="text-gray-500 italic text-sm text-center py-10">Belum ada staf dengan proyek aktif di departemen ini.</p>';

    c.innerHTML = '<div class="space-y-4 max-w-3xl mx-auto animate-fadein pb-10">' +
        '<div class="flex items-center gap-3">' +
        '<button onclick="renderExecutiveView(document.getElementById(\'viewContainer\'))" class="w-8 h-8 rounded-lg bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-gray-400 hover:text-white transition"><i class="fa-solid fa-arrow-left text-xs"></i></button>' +
        '<div><h2 class="text-lg font-bold text-white">Departemen: ' + dept + '</h2><p class="text-xs text-gray-500">Melihat daftar karyawan dengan tugas prioritas.</p></div>' +
        '</div>' +
        '<div class="space-y-3">' + userCards + '</div></div>';
};

window.execDrillToUser = function(uid) {
    execDrillUser = uid;
    var c = document.getElementById('viewContainer');
    if (!c) return;

    var profile   = allUsers[uid] || {};
    var name      = profile.name || profile.email || uid;
    var userTasks = tasks.filter(function(t) { 
        if (t.uid !== uid) return false;
        var f = window._execFilters;
        if (!f.showRoutine && t.isRoutine) return false;
        if (f.prio && t.priority !== f.prio) return false;
        if (f.startDate && (t.dueDate||t.endDate) < f.startDate) return false;
        if (f.endDate && (t.endDate||t.dueDate) > f.endDate) return false;
        return true;
    });
    var active    = userTasks.filter(function(t) { return t.status !== 'Done' && t.status !== 'Cancelled'; });
    var done      = userTasks.filter(function(t) { return t.status === 'Done'; });

    function taskRow(t) {
        var colors  = { Planning: 'text-gray-400', 'In Progress': 'text-blue-400', 'On Hold': 'text-orange-400', Done: 'text-emerald-400', Cancelled: 'text-red-400' };
        var col     = colors[t.status] || 'text-gray-400';
        var isOverdue = t.dueDate && t.status !== 'Done' && t.status !== 'Cancelled' && t.dueDate < getLocalISODate();
        var prioColor = t.priority === 'Critical' ? 'text-red-400' : (t.priority === 'High' ? 'text-orange-400' : 'text-blue-400');
        return '<div onclick="openTaskModal(\'' + t.id + '\')" class="bg-[#1a1a1a] p-3 rounded-lg border border-[#2a2a2a] flex items-center gap-3 cursor-pointer hover:border-violet-500/30 hover:bg-[#1e1e2e] transition group">' +
            '<div class="shrink-0 w-1 rounded-full self-stretch ' + (isOverdue ? 'bg-red-500' : 'bg-[#333]') + '"></div>' +
            '<div class="flex-1 min-w-0">' +
            '<p class="text-white text-xs font-semibold truncate group-hover:text-violet-200 transition">' + (t.title || 'Tanpa Judul') + '</p>' +
            '<p class="text-[10px] text-gray-500 mt-0.5">' + (t.project || '-') + ' <span class="' + prioColor + '">&bull; ' + t.priority + '</span> &bull; Tenggat: ' + (t.dueDate || '-') + (isOverdue ? ' <span class="text-red-400 font-bold">OVERDUE</span>' : '') + '</p>' +
            '</div>' +
            '<div class="flex items-center gap-2 shrink-0">' +
            '<span class="text-[9px] font-bold uppercase ' + col + '">' + (t.status || '-') + '</span>' +
            '<i class="fa-solid fa-chevron-right text-[9px] text-gray-600 group-hover:text-violet-400 transition"></i>' +
            '</div>' +
            '</div>';
    }

    c.innerHTML = '<div class="space-y-5 max-w-3xl mx-auto animate-fadein pb-10">' +
        '<div class="flex items-center gap-3">' +
        '<button onclick="execDrillToDept(\'' + execDrillDept + '\')" class="w-8 h-8 rounded-lg bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-gray-400 hover:text-white transition"><i class="fa-solid fa-arrow-left text-xs"></i></button>' +
        '<div class="flex items-center gap-3">' +
        '<div class="w-10 h-10 rounded-full bg-violet-900/30 border border-violet-500/30 flex items-center justify-center text-violet-300 font-bold">' + name.charAt(0).toUpperCase() + '</div>' +
        '<div><h2 class="text-base font-bold text-white">' + name + '</h2>' +
        '<p class="text-[10px] text-gray-500">' + (profile.department || execDrillDept) + ' &mdash; Proyek Aktif</p></div>' +
        '</div></div>' +
        '<div><h3 class="text-xs font-bold text-blue-400 uppercase mb-2 border-b border-[#2a2a2a] pb-1">Aktif / Berlangsung (' + active.length + ')</h3>' +
        '<div class="space-y-2">' + (active.length ? active.map(taskRow).join('') : '<p class="text-gray-600 italic text-xs py-4 text-center">Tidak ada proyek aktif.</p>') + '</div></div>' +
        '<div><h3 class="text-xs font-bold text-emerald-400 uppercase mb-2 border-b border-[#2a2a2a] pb-1">Selesai (' + done.length + ')</h3>' +
        '<div class="space-y-2 max-h-60 overflow-y-auto pr-1">' + (done.length ? done.map(taskRow).join('') : '<p class="text-gray-600 italic text-xs py-4 text-center">Belum ada proyek selesai.</p>') + '</div></div>' +
        '</div>';
};
