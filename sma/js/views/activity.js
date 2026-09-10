/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/activity.js - Centralized Audit Log & Activity History
   ============================================================ */

let _activitySearchQuery = '';
let _activityFilterDept  = '';
let _activityFilterUser  = '';
let _activityScope       = 'self';

function renderActivityLogView(c) {
    var role         = currentUser ? currentUser.role : 'Staff';
    var isSuperAdmin = (role === 'SuperAdmin' || role === 'Direktur');
    var isSPV        = (role === 'Supervisor');

    // Scope yang diizinkan per role:
    // Staff/Executive : Sendiri saja
    // SPV             : Sendiri + Divisi
    // Direktur/SA     : Sendiri + Divisi + All
    var allowedScopes = isSuperAdmin ? ['self','dept','all'] : isSPV ? ['self','dept'] : ['self'];
    if (allowedScopes.indexOf(_activityScope) < 0) _activityScope = 'self';

    var visibleLogs = activityLogs.slice();

    if (visibleLogs.length === 0) {
        c.innerHTML = _buildActivityShell('', _buildEmptyState('loading'), '');
        return;
    }

    if (_activityScope === 'self') {
        visibleLogs = visibleLogs.filter(function(l) { return l.uid === currentUser.uid; });
    } else if (_activityScope === 'dept') {
        var myDept = currentUser.department;
        visibleLogs = visibleLogs.filter(function(l) { return l.dept === myDept || (!l.dept && l.uid === currentUser.uid); });
    }

    if (_activitySearchQuery) {
        var q = _activitySearchQuery.toLowerCase();
        visibleLogs = visibleLogs.filter(function(l) {
            return (l.taskTitle || '').toLowerCase().includes(q) ||
                   (l.action    || '').toLowerCase().includes(q);
        });
    }
    if (_activityFilterDept && _activityScope === 'all') {
        visibleLogs = visibleLogs.filter(function(l) { return l.dept === _activityFilterDept; });
    }
    if (_activityFilterUser && _activityScope === 'all') {
        visibleLogs = visibleLogs.filter(function(l) { return l.uid === _activityFilterUser; });
    }

    visibleLogs.sort(function(a, b) { return (b.timestamp || 0) - (a.timestamp || 0); });

    // Scope Switcher Tabs
    var scopeTabs = '';
    if (allowedScopes.length > 1) {
        var tabLabels = { self: '\uD83D\uDC64 Saya', dept: '\uD83C\uDFE2 Divisi', all: '\uD83C\uDF10 Semua' };
        scopeTabs = '<div class="flex gap-2 mb-4 border-b border-[#333] pb-3">';
        allowedScopes.forEach(function(s) {
            var active = _activityScope === s;
            var cls = active ? 'bg-purple-600 text-white shadow' : 'text-gray-400 hover:text-white hover:bg-[#2a2a2a]';
            scopeTabs += '<button onclick="_activityScope=\'' + s + '\'; _activityFilterDept=\'\'; _activityFilterUser=\'\'; renderActivityLogView(document.getElementById(\'viewContainer\'))" class="px-4 py-1.5 rounded-lg text-[11px] font-bold transition ' + cls + '">' + tabLabels[s] + '</button>';
        });
        scopeTabs += '</div>';
    }

    // Filter bar
    var filterBarHtml = '<div class="flex flex-wrap gap-2 mb-4">'
        + '<div class="relative flex-1 min-w-[160px]"><i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>'
        + '<input type="text" id="activitySearch" value="' + (_activitySearchQuery || '') + '" oninput="_updateActivitySearch()" placeholder="Cari judul, aksi..." class="input-bg w-full pl-8 pr-3 py-2 rounded-lg text-xs border border-[#333]"></div>';

    if (_activityScope === 'all' && isSuperAdmin) {
        var depts2 = [];
        Object.values(allUsers).forEach(function(u) { if (u.department && depts2.indexOf(u.department) < 0) depts2.push(u.department); });
        depts2.sort();
        var userOptions2 = '<option value="">Semua Karyawan</option>';
        Object.keys(allUsers).forEach(function(k) {
            var u = allUsers[k];
            userOptions2 += '<option value="' + k + '" ' + (_activityFilterUser === k ? 'selected' : '') + '>' + (u.name || u.email) + ' (' + (u.department || '-') + ')</option>';
        });
        var deptOpts = '<option value="">Semua Divisi</option>' + depts2.map(function(d) { return '<option value="' + d + '" ' + (_activityFilterDept === d ? 'selected' : '') + '>' + d + '</option>'; }).join('');
        filterBarHtml += '<select onchange="_activityFilterDept=this.value; _activityFilterUser=\'\'; renderActivityLogView(document.getElementById(\'viewContainer\'))" class="input-bg px-3 py-2 rounded-lg text-xs border border-[#333] flex-shrink-0">' + deptOpts + '</select>'
            + '<select onchange="_activityFilterUser=this.value; renderActivityLogView(document.getElementById(\'viewContainer\'))" class="input-bg px-3 py-2 rounded-lg text-xs border border-[#333] flex-shrink-0">' + userOptions2 + '</select>';
    }
    if (_activitySearchQuery || _activityFilterDept || _activityFilterUser) {
        filterBarHtml += '<button onclick="_activitySearchQuery=\'\'; _activityFilterDept=\'\'; _activityFilterUser=\'\'; renderActivityLogView(document.getElementById(\'viewContainer\'))" class="px-3 py-2 text-[10px] font-bold text-red-400 border border-red-500/30 rounded-lg hover:bg-red-900/20 transition"><i class="fa-solid fa-xmark mr-1"></i>Reset</button>';
    }
    filterBarHtml += '</div>';

    // Log entry HTML
    var logHtml = visibleLogs.length === 0 ? _buildEmptyState('empty') : '';
    if (visibleLogs.length > 0) {
        visibleLogs.forEach(function(log) {
            var icon, color, bg;
            switch (log.action) {
                case 'Dibuat':        icon = 'fa-plus';        color = 'text-blue-400';    bg = 'bg-blue-900/30 border-blue-500/30';    break;
                case 'Diperbarui':    icon = 'fa-pen';         color = 'text-yellow-400';  bg = 'bg-yellow-900/30 border-yellow-500/30'; break;
                case 'Selesai':       icon = 'fa-check';       color = 'text-emerald-400'; bg = 'bg-emerald-900/30 border-emerald-500/30'; break;
                case 'Dibatalkan':
                case 'Dihapus':       icon = 'fa-trash';       color = 'text-red-400';     bg = 'bg-red-900/30 border-red-500/30';       break;
                case 'Didelegasikan': icon = 'fa-share-nodes'; color = 'text-orange-400';  bg = 'bg-orange-900/30 border-orange-500/30'; break;
                case 'Komentar':      icon = 'fa-comment';     color = 'text-cyan-400';    bg = 'bg-cyan-900/30 border-cyan-500/30';     break;
                default:              icon = 'fa-bolt';        color = 'text-purple-400';  bg = 'bg-purple-900/30 border-purple-500/30';
            }
            var dateObj = new Date(log.timestamp || 0);
            var timeStr = dateObj.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            var dateStr = dateObj.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: '2-digit' });
            var userInfoStr = '';
            if (_activityScope !== 'self' && log.uid && log.uid !== '-') {
                var u = allUsers[log.uid];
                var uname = u ? (u.name || u.email) : log.uid;
                var udept = log.dept !== '-' ? log.dept : (u ? u.department : 'Sistem');
                var uidBadge = isSuperAdmin ? '<span class="text-gray-700 text-[8px] font-mono ml-1">' + log.uid.slice(0,8) + '...</span>' : '';
                userInfoStr = '<p class="text-[10px] text-gray-400 mt-2 border-t border-[#333] pt-2 flex items-center gap-1">'
                    + '<i class="fa-solid fa-user-shield text-gray-600 text-[9px]"></i>'
                    + '<span class="font-semibold">' + uname + '</span>' + uidBadge
                    + '<span class="text-gray-600"> - ' + udept + '</span></p>';
            }
            logHtml += '<div class="relative pl-6 md:pl-8 group">'
                + '<div class="absolute -left-[17px] top-1 w-8 h-8 rounded-full ' + bg + ' border flex items-center justify-center ' + color + ' text-[10px] shadow-lg group-hover:scale-110 transition-transform">'
                + '<i class="fa-solid ' + icon + '"></i></div>'
                + '<div class="bg-[#202020] p-4 rounded-xl border border-[#2f2f2f] group-hover:border-[#3f3f3f] transition shadow-sm">'
                + '<div class="flex justify-between items-start mb-1.5">'
                + '<span class="text-[10px] font-bold uppercase tracking-widest ' + color + '">' + log.action + '</span>'
                + '<span class="text-[10px] text-gray-500 font-medium shrink-0 ml-2"><i class="fa-regular fa-clock mr-1"></i>' + dateStr + ', ' + timeStr + '</span>'
                + '</div>'
                + '<h4 class="text-sm font-bold text-gray-200 leading-snug">' + (log.taskTitle || 'Tugas Tanpa Judul') + '</h4>'
                + '<p class="text-[9px] text-gray-600 mt-1 font-mono">ID: ' + (log.taskId || '-') + '</p>'
                + userInfoStr + '</div></div>';
        });
    }

    var existingShell = document.getElementById('activityLogListContainer');
    if (existingShell && arguments.length === 0) {
        // Called from search input, only update the list part
        existingShell.innerHTML = logHtml;
        var countEl = document.getElementById('activityLogCount');
        if (countEl) countEl.innerText = visibleLogs.length + ' LOG';
    } else {
        c.innerHTML = _buildActivityShell(scopeTabs + filterBarHtml, logHtml, visibleLogs.length);
    }
}

// Helper to trigger list-only update
function _updateActivitySearch() {
    _activitySearchQuery = document.getElementById('activitySearch').value;
    renderActivityLogView(); // Call without container param to trigger list-only update
}

function _buildEmptyState(type) {
    if (type === 'loading') {
        return '<div class="text-center py-16">'
            + '<div class="w-12 h-12 border-2 border-purple-500 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>'
            + '<p class="text-gray-500 text-sm font-bold">Memuat riwayat aktivitas...</p>'
            + '<p class="text-gray-600 text-[10px] mt-1">Jika lama, coba refresh atau periksa koneksi internet</p></div>';
    }
    return '<div class="text-center py-16">'
        + '<i class="fa-solid fa-list-check text-4xl text-gray-700 mb-4 block"></i>'
        + '<p class="text-gray-500 text-sm font-bold">Belum ada aktivitas tercatat</p>'
        + '<p class="text-gray-600 text-[10px] mt-1">Aktivitas muncul saat kamu membuat atau mengubah tugas</p></div>';
}

function _buildActivityShell(filterArea, logContent, count) {
    return '<div class="max-w-3xl mx-auto w-full animate-fadein">'
        + '<div class="bg-[#1a1a1a] rounded-xl border border-[#333] p-4 shadow-inner mb-4 flex justify-between items-center">'
        + '<div><h3 class="text-white font-bold text-sm flex items-center gap-2"><i class="fa-solid fa-list-check text-purple-400"></i> Riwayat Aktivitas &amp; Audit Log</h3>'
        + '<p class="text-[10px] text-gray-500 mt-1">Tersimpan otomatis di Cloud - Real-time</p></div>'
        + (count !== '' ? '<div id="activityLogCount" class="bg-purple-900/20 text-purple-400 px-3 py-1.5 rounded-lg border border-purple-900/30 text-[10px] font-bold shrink-0">' + count + ' LOG</div>' : '')
        + '</div>'
        + filterArea
        + '<div id="activityLogListContainer" class="relative border-l-2 border-[#333] ml-3 md:ml-6 space-y-5 pb-10">' + logContent + '</div>'
        + '</div>';
}
