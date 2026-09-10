/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/supervisor.js — Supervisor Panel View

   AKSES:
   - Supervisor: hanya lihat Staf di dept-nya sendiri
   - SuperAdmin / Executive / DeptExecutive: lihat semua user
     (Staff dan SPV lain), bisa monitor SPV juga

   MONITOR RULES:
   - SPV → bisa monitor Staff di dept-nya (Tab Delegasi = tugas MASUK ke staf)
   - SuperAdmin/Executive → bisa monitor siapapun
     * Monitor Staff  → tugas MASUK ke staf
     * Monitor SPV    → tugas yang SPV itu DELEGASIKAN keluar
   ============================================================ */

function renderSupervisorView(c) {
    const role    = currentUser ? currentUser.role : '';
    const canView = ['Supervisor', 'SuperAdmin', 'Direktur'];
    if (!canView.includes(role)) {
        c.innerHTML = '<p class="text-center text-red-500 mt-10">Akses Ditolak. Khusus Supervisor dan manajemen.</p>';
        return;
    }

    const myDept  = currentUser.department;
    const isGlobal = (role === 'SuperAdmin' || role === 'Executive' || role === 'Direktur');
    const isDeptExec = role === 'DeptExecutive';
    const watchDept = isDeptExec ? (currentUser.watchDepartment || myDept) : null;

    const isSPV = role === 'Supervisor';

    // ── Kumpulkan semua member berdasarkan scope ─────────────────
    const staffMembers = [];
    const spvMembers   = [];

    Object.keys(allUsers).forEach(uid => {
        if (uid === currentUser.uid) return;
        const u = allUsers[uid];
        const uRole = u.role || 'Staff';
        const uDept = u.department || '-';

        // Filter scope
        if (isSPV && uDept !== myDept) return;               // SPV: hanya dept-nya
        if (isDeptExec && uDept !== watchDept) return;        // DeptExec: hanya watchDept
        // SuperAdmin/Executive/Direktur: semua

        // SPV hanya bisa pantau Staff (bukan SPV lain)
        if (isSPV && (uRole === 'Supervisor' || uRole === 'SuperAdmin' || uRole === 'Executive' || uRole === 'DeptExecutive' || uRole === 'Direktur')) return;

        const uTasks      = tasks.filter(t => t.uid === uid);
        const delegatedIn = tasks.filter(t => t.uid === uid && t.delegatedBy && t.delegatedBy !== uid);
        const delegatedOut = tasks.filter(t => t.delegatedBy === uid && t.uid !== uid);

        const memberObj = {
            uid, name: u.name || u.email || uid,
            department: uDept, role: uRole,
            total:      uTasks.length,
            done:       uTasks.filter(t => t.status === 'Done').length,
            inProgress: uTasks.filter(t => t.status === 'In Progress').length,
            overdue:    uTasks.filter(t => t.dueDate && t.status !== 'Done' && t.status !== 'Cancelled' && t.dueDate < getLocalISODate()).length,
            delegatedIn:  delegatedIn.length,
            delegatedOut: delegatedOut.length
        };

        if (['Supervisor', 'SuperAdmin', 'Executive', 'DeptExecutive', 'Direktur'].includes(uRole)) {
            spvMembers.push(memberObj);
        } else {
            staffMembers.push(memberObj);
        }
    });

    // ── Inbox ────────────────────────────────────────────────────
    const inboxItems   = sharedNotes.slice().sort((a, b) => (b.timestamp || 0) - (a.timestamp || 0));
    const unreadCount  = inboxItems.filter(s => !s.read).length;
    inboxItems.forEach(s => {
        if (!s.read && s.id) db.ref('shared_notes/' + s.id).update({ read: true });
    });

    // ── Build member card ────────────────────────────────────────
    function buildMemberCard(m, isSPVCard) {
        const pct       = m.total > 0 ? Math.round((m.done / m.total) * 100) : 0;
        const safeName  = m.name.replace(/'/g, '').replace(/"/g, '');
        const overdueTag = m.overdue > 0
            ? `<span class="text-[9px] bg-red-900/30 text-red-400 border border-red-500/30 px-1.5 py-0.5 rounded font-bold shrink-0">${m.overdue} OD</span>`
            : '';

        const monitorBtnLabel = isSPVCard
            ? '<i class="fa-solid fa-magnifying-glass"></i> Pantau SPV'
            : '<i class="fa-solid fa-table-columns"></i> Cek Papan';
        const monitorBtnClass = isSPVCard
            ? 'flex-1 py-1.5 border border-purple-500/30 rounded text-purple-400 text-[10px] font-bold hover:bg-purple-900/20 transition'
            : 'flex-1 py-1.5 border border-blue-500/30 rounded text-blue-400 text-[10px] font-bold hover:bg-blue-900/20 transition';

        const delegationInfo = isSPVCard
            ? `<div class="text-[9px] text-purple-400 bg-purple-900/20 px-2 py-1 rounded mb-2 font-bold"><i class="fa-solid fa-share-nodes mr-1"></i> Delegasi Keluar: ${m.delegatedOut} tugas</div>`
            : m.delegatedIn > 0
                ? `<div class="text-[9px] text-orange-400 bg-orange-900/20 px-2 py-1 rounded mb-2 font-bold"><i class="fa-solid fa-inbox mr-1"></i> Delegasi Masuk: ${m.delegatedIn} tugas</div>`
                : '';

        return `<div class="card-bg p-4 rounded-xl border border-[#3f3f3f] hover:border-${isSPVCard ? 'purple' : 'emerald'}-500/40 transition">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-9 h-9 rounded-full ${isSPVCard ? 'bg-purple-900/30 border-purple-500/30 text-purple-300' : 'bg-emerald-900/30 border-emerald-500/30 text-emerald-300'} border flex items-center justify-center font-bold text-xs shrink-0">
                    ${m.name.charAt(0).toUpperCase()}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white font-semibold text-xs truncate">${m.name}</p>
                    <p class="text-[9px] text-gray-500">${m.department} &mdash; ${m.role}</p>
                </div>
                ${overdueTag}
            </div>
            ${delegationInfo}
            <div class="grid grid-cols-3 gap-1.5 text-center mb-2">
                <div class="bg-[#1a1a1a] rounded p-1"><p class="text-white text-xs font-bold">${m.total}</p><p class="text-[8px] text-gray-500">Total</p></div>
                <div class="bg-[#1a1a1a] rounded p-1"><p class="text-emerald-400 text-xs font-bold">${m.done}</p><p class="text-[8px] text-gray-500">Selesai</p></div>
                <div class="bg-[#1a1a1a] rounded p-1"><p class="text-blue-400 text-xs font-bold">${m.inProgress}</p><p class="text-[8px] text-gray-500">Jalan</p></div>
            </div>
            <div class="w-full bg-gray-800 h-1 rounded-full overflow-hidden mb-3">
                <div class="bg-emerald-500 h-1 rounded-full transition-all" style="width:${pct}%"></div>
            </div>
            <div class="flex gap-1.5">
                <button onclick="switchView('board', '${m.uid}')" class="${monitorBtnClass}">${monitorBtnLabel}</button>
                <button onclick="openStaffRoutineModal('${m.uid}', '${safeName}')" class="flex-1 py-1.5 border border-indigo-500/30 rounded text-indigo-400 text-[10px] font-bold hover:bg-indigo-900/20 transition">
                    <i class="fa-solid fa-repeat"></i> Rutinitas
                </button>
                <button onclick="spvSendReminder('${m.uid}', '${safeName}')" class="flex-1 py-1.5 border border-emerald-500/30 rounded text-emerald-400 text-[10px] font-bold hover:bg-emerald-900/20 transition">
                    <i class="fa-solid fa-paper-plane"></i> Reminder
                </button>
            </div>
        </div>`;
    }

    // ── Staff section HTML ───────────────────────────────────────
    const staffHtml = staffMembers.length > 0
        ? staffMembers.map(m => buildMemberCard(m, false)).join('')
        : '<p class="text-gray-600 italic text-xs py-4 text-center">Tidak ada staf di scope ini.</p>';

    // ── SPV section (only for SuperAdmin/Executive) ──────────────
    const spvSectionHtml = (!isSPV && spvMembers.length > 0) ? `
    <div class="mt-6">
        <h3 class="text-[10px] font-bold text-gray-400 uppercase mb-3 flex items-center gap-2">
            <i class="fa-solid fa-user-tie text-purple-400"></i> Supervisor & Manajemen (${spvMembers.length})
            <span class="text-[9px] text-gray-600 normal-case font-normal">— Anda dapat memantau delegasi mereka</span>
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            ${spvMembers.map(m => buildMemberCard(m, true)).join('')}
        </div>
    </div>` : '';


    // ── Scope description ─────────────────────────────────────────
    const scopeDesc = isSPV
        ? `Departemen: ${myDept}`
        : isDeptExec
            ? `Divisi: ${watchDept}`
            : 'Semua Departemen';

    c.innerHTML = `
    <div class="space-y-5 max-w-4xl mx-auto animate-fadein pb-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-900/30 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                <i class="fa-solid fa-people-roof"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">${isSPV ? 'Panel Supervisor' : 'Panel Manajemen'}</h2>
                <p class="text-xs text-gray-500">${scopeDesc}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <h3 class="text-[10px] font-bold text-gray-400 uppercase mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-users text-emerald-500"></i>
                    Tim Staf (${staffMembers.length} orang)
                </h3>
                <div class="space-y-3">${staffHtml}</div>
            </div>
            <div>
                ${spvSectionHtml}
            </div>
        </div>
    </div>`;
}

window.spvSendReminder = function(toUid, toName) {
    document.getElementById('messageModal').classList.remove('hidden');
    if (typeof renderMessages === 'function') renderMessages();
    
    // Automatically open compose form and set recipient
    var form = document.getElementById('composeMessageForm');
    if (form) {
        form.classList.remove('hidden');
        setTimeout(function() {
            var sel = document.getElementById('messageRecipient');
            if (sel) sel.value = toUid;
            document.getElementById('messageContent').focus();
        }, 100);
    }
};

window.staffRoutinesCache = null;
window.currentStaffRoutineUid = null;
window.currentStaffRoutineName = null;

window.openStaffRoutineModal = function(uid, name) {
    document.getElementById('staffRoutineModal').classList.remove('hidden');
    document.getElementById('staffRoutineModalTitle').innerText = 'Rutinitas: ' + name;
    
    window.currentStaffRoutineUid = uid;
    window.currentStaffRoutineName = name;
    
    ['Daily', 'Weekly', 'Monthly'].forEach(function(type) {
        document.getElementById('staffRoutines' + type).innerHTML = '<p class="text-xs text-gray-500 italic">Memuat...</p>';
    });

    var btn = document.getElementById('btnNewStaffRoutine');
    btn.onclick = function() {
        openRoutineModal('daily');
        setTimeout(function() {
            var sel = document.getElementById('routineAssignee');
            if(sel) sel.value = uid;
        }, 100);
    };

    loadStaffRoutines(uid);
};

window.loadStaffRoutines = function(uid) {
    db.ref('routines/' + uid).once('value').then(function(snap) {
        var data = snap.val() || { daily: [], weekly: [], monthly: [] };
        window.staffRoutinesCache = data;
        renderStaffRoutines(data);
    }).catch(function(e) {
        console.error('Error loadStaffRoutines:', e);
        ['Daily', 'Weekly', 'Monthly'].forEach(function(type) {
            document.getElementById('staffRoutines' + type).innerHTML = '<p class="text-xs text-red-500 italic">Gagal memuat data.</p>';
        });
    });
};

window.renderStaffRoutines = function(data) {
    const dayNames = ['Ming', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
    
    function renderList(list, type, containerId) {
        var html = '';
        if (!list || list.length === 0) {
            html = '<p class="text-xs text-gray-600 italic">Tidak ada rutinitas.</p>';
        } else {
            html = list.map(function(r) {
                var dayBadge = r.day ? `<span class="text-[9px] bg-blue-900 text-blue-300 px-1.5 py-0.5 rounded font-bold mr-2">${dayNames[r.day]}</span>` : '';
                var dateBadge = r.date ? `<span class="text-[9px] bg-orange-900 text-orange-300 px-1.5 py-0.5 rounded font-bold mr-2">Tgl ${r.date}</span>` : '';
                var timeBadge = (r.startTime && r.endTime) ? `<span class="text-[9px] bg-slate-800 text-slate-300 px-1.5 py-0.5 rounded font-bold mr-2"><i class="fa-regular fa-clock mr-1"></i>${r.startTime} - ${r.endTime}</span>` : '';
                var delegBadge = r.delegatedBy ? `<span class="text-[9px] bg-orange-900/30 text-orange-400 border border-orange-500/30 px-1.5 py-0.5 rounded font-bold mr-2 whitespace-nowrap"><i class="fa-solid fa-share-nodes mr-1"></i>Dari: ${r.delegatedByName || 'Atasan'}</span>` : '';
                
                return `<div class="bg-[#252526] p-3 rounded-lg border border-[#3f3f3f] flex justify-between items-center mb-2">
                    <div class="truncate pr-2">
                        ${dayBadge}${dateBadge}${timeBadge}${delegBadge}
                        <span class="text-xs font-bold text-gray-200">${r.title}</span>
                    </div>
                    <button onclick="editStaffRoutine('${type}', '${r.id}')" class="text-blue-400 hover:text-blue-300 text-[10px] uppercase font-bold tracking-wider px-2 py-1 rounded bg-blue-900/30 transition">Edit</button>
                </div>`;
            }).join('');
        }
        document.getElementById(containerId).innerHTML = html;
    }
    
    function sortRoutines(list) {
        return (list || []).slice().sort(function(a, b) {
            var timeA = a.startTime || '24:00';
            var timeB = b.startTime || '24:00';
            return timeA.localeCompare(timeB);
        });
    }
    
    renderList(sortRoutines(data.daily), 'daily', 'staffRoutinesDaily');
    renderList(sortRoutines(data.weekly), 'weekly', 'staffRoutinesWeekly');
    renderList(sortRoutines(data.monthly), 'monthly', 'staffRoutinesMonthly');
};

window.editStaffRoutine = function(type, id) {
    if (!window.staffRoutinesCache || !window.staffRoutinesCache[type]) return;
    var r = window.staffRoutinesCache[type].find(function(x) { return x.id == id; });
    if (!r) return;
    
    document.getElementById('routineModal').classList.remove('hidden');
    document.getElementById('btnDelRoutine').classList.remove('hidden');
    document.getElementById('routineId').value    = r.id;
    document.getElementById('routineType').value  = type;
    document.getElementById('routineTitle').value = r.title;
    document.getElementById('routineTag').value   = r.tag   || '';
    document.getElementById('routineStartTime').value = r.startTime || '';
    document.getElementById('routineEndTime').value = r.endTime || '';
    document.getElementById('routineHours').value = r.hours || 30;
    document.getElementById('routineLink').value  = r.link  || '';
    document.getElementById('routineDesc').value  = r.desc  || '';
    if (type === 'weekly')  document.getElementById('routineDay').value = r.day;
    if (type === 'monthly') setTimeout(function() {
        var el = document.getElementById('routineDate');
        if (el) el.value = r.date || 1;
    }, 50);
    
    _populateRoutineAssignee(window.currentStaffRoutineUid);
    toggleRoutineDay();
};

