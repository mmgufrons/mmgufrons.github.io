

function renderVisualTimeline(todayTasks) {
    let html = '';
    const s = (currentUser && currentUser.settings) || { timeIn: '08:00', timeOut: '17:00', breaks: [{start:'12:00', end:'13:00'}] };
    const tIn = s.timeIn || '08:00';
    const tOut = s.timeOut || '17:00';
    
    const parseMins = (t) => { let p = t.split(':'); return parseInt(p[0])*60 + parseInt(p[1]); };
    const startOfDay = parseMins(tIn);
    const endOfDay = parseMins(tOut);
    const totalDayMins = endOfDay - startOfDay;
    
    if (totalDayMins <= 0) return '';
    
    let blocks = [];
    
    let activeBreaks = s.breaks || [];
    var todayStr = getLocalISODate();
    if (currentUser && currentUser.todayBreak && currentUser.todayBreak[todayStr]) {
        activeBreaks = [currentUser.todayBreak[todayStr]];
    }

    if (activeBreaks.length > 0) {
        activeBreaks.forEach(b => {
            if (b.start && b.end) {
                blocks.push({ start: parseMins(b.start), end: parseMins(b.end), type: 'break', label: 'Istirahat', fixed: true });
            }
        });
    }
    
    let flexibleTasks = [];
    todayTasks.forEach(function(t) {
        var taskDate = t.startDate || (t.type === 'meeting' ? t.dueDate : null);
        var hasStart = t.startTime && taskDate === todayStr;
        var hasEnd   = t.endTime && t.dueDate === todayStr;
        if (hasStart && hasEnd) {
            blocks.push({ id: t.id, start: parseMins(t.startTime), end: parseMins(t.endTime), type: t.type === 'meeting' ? 'meeting' : 'task', label: t.title, fixed: true, status: t.status });
        } else if (hasStart && !hasEnd) {
            var dur = parseFloat(t.hours) || 60;
            blocks.push({ id: t.id, start: parseMins(t.startTime), end: parseMins(t.startTime) + dur, type: t.type === 'meeting' ? 'meeting' : 'task', label: t.title, fixed: true, status: t.status });
        } else {
            flexibleTasks.push(t);
        }
    });
    
    blocks.sort((a, b) => a.start - b.start);
    let cursorMins = startOfDay;
    
    flexibleTasks.forEach(t => {
        let dur = parseFloat(t.hours) || 30;
        let placed = false;
        while (!placed) {
            let nextBlock = blocks.find(b => b.fixed && b.start < cursorMins + dur && b.end > cursorMins);
            if (nextBlock) {
                cursorMins = nextBlock.end;
            } else {
                let endMins = cursorMins + dur;
                blocks.push({ id: t.id, start: cursorMins, end: endMins, type: t.type === 'meeting' ? 'meeting' : 'task', label: t.title + ' (Auto)', fixed: false, status: t.status });
                cursorMins = endMins;
                placed = true;
            }
        }
    });
    
    let dynamicEndOfDay = endOfDay;
    blocks.forEach(b => {
        if (b.end > dynamicEndOfDay) dynamicEndOfDay = b.end;
    });
    
    const dynamicTotalMins = dynamicEndOfDay - startOfDay;
    if (dynamicTotalMins <= 0) return '';
    
    blocks.forEach(b => {
        let sM = Math.max(startOfDay, b.start);
        let eM = Math.min(dynamicEndOfDay, b.end);
        if (eM > sM) {
            let leftPct = ((sM - startOfDay) / dynamicTotalMins) * 100;
            let widthPct = ((eM - sM) / dynamicTotalMins) * 100;
            let color = b.type === 'break' ? 'bg-amber-500/50' : (b.type === 'meeting' ? 'bg-orange-500' : 'bg-blue-500');
            
            if (b.type !== 'break') {
                if (b.status === 'Done') color = 'bg-emerald-500';
                else if (b.status === 'In Progress') color = 'bg-blue-400 shadow-[0_0_10px_rgba(96,165,250,0.8)]';
            }

            let clickAction = (b.type !== 'break' && b.id) ? `onclick="openTaskModal('${b.id}')"` : '';
            let cursor = (b.type !== 'break') ? 'cursor-pointer' : '';
            html += `<div ${clickAction} class="absolute top-0 bottom-0 ${color} rounded-sm opacity-80 hover:opacity-100 transition ${cursor} border-r border-black/20 shadow-sm hover:z-10" style="left: ${leftPct}%; width: ${widthPct}%;" title="${b.label} (${Math.floor((eM-sM)/60)}j ${(eM-sM)%60}m)"></div>`;
        }
    });
    
    let startH = Math.floor(startOfDay / 60).toString().padStart(2, '0');
    let startM = (startOfDay % 60).toString().padStart(2, '0');
    let endH = Math.floor(dynamicEndOfDay / 60);
    let endM = (dynamicEndOfDay % 60).toString().padStart(2, '0');
    let dayOffset = '';
    if (endH >= 24) {
        let days = Math.floor(endH / 24);
        endH = endH % 24;
        dayOffset = ' (+' + days + ' Hari)';
    }
    let endHStr = endH.toString().padStart(2, '0');

    return `
    <div class="mb-6 p-4 card-bg rounded-xl border border-white/5 shadow-md">
        <h4 class="text-[10px] font-bold text-gray-500 mb-3 uppercase tracking-widest flex items-center gap-2"><i class="fa-solid fa-timeline text-violet-400"></i> Visual Timeline</h4>
        <div class="relative h-5 bg-[#121212] rounded overflow-hidden border border-[#2a2a2a] w-full shadow-inner">
            ${html}
        </div>
        <div class="flex justify-between text-[9px] text-gray-500 mt-2 font-bold uppercase tracking-wider">
            <span>Mulai: ${tIn}</span>
            <div class="flex gap-3 text-gray-600">
                <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Rencana</span>
                <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Selesai</span>
                <span class="flex items-center gap-1 cursor-pointer hover:text-amber-400 transition" onclick="openTodayBreakModal()"><span class="w-2 h-2 rounded-full bg-amber-500/50"></span> Istirahat <i class="fa-solid fa-pencil text-[8px] ml-1"></i></span>
            </div>
            <span>Selesai: ${endHStr}:${endM}${dayOffset}</span>
        </div>
    </div>
    `;
}

/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/today.js — Daily Dashboard View
   ============================================================ */


function renderTodayView(c) {
    const todayStr = getLocalISODate();
    
    let allTodayTasks = tasks.filter(t => {
        // Meeting: tampilkan jika user adalah pembuat ATAU peserta yang diundang
        const isMyTask = t.uid === currentUser.uid;
        const isInvited = t.type === 'meeting' && t.participants && t.participants[currentUser.uid];
        if (!isMyTask && !isInvited) return false;
        if (t.status === 'Cancelled') return false;
        if (t.status === 'Done') return t.endDate === todayStr;
        if (t.status === 'In Progress') return true;
        let start = t.startDate || t.dueDate || todayStr;
        let end = t.dueDate || todayStr;
        return (start <= todayStr && end >= todayStr);
    });

    // Tugas OVERDUE: dueDate sudah lewat, bukan Done/Cancelled
    let overdueTasks = tasks.filter(t => {
        const isMyTask = t.uid === currentUser.uid;
        const isInvited = t.type === 'meeting' && t.participants && t.participants[currentUser.uid];
        if (!isMyTask && !isInvited) return false;
        if (t.status === 'Done' || t.status === 'Cancelled') return false;
        const end = t.dueDate || '';
        return end && end < todayStr;
    });

    let list = allTodayTasks.filter(t => t.status !== 'Done' && t.status !== 'Cancelled');

    // Sort: In Progress → Priority → Date
    list.sort((a, b) => {
        if (a.status === 'In Progress' && b.status !== 'In Progress') return -1;
        if (b.status === 'In Progress' && a.status !== 'In Progress') return 1;
        const pMap = { High: 1, Medium: 2, Low: 3 };
        const pA = pMap[a.priority] || 4;
        const pB = pMap[b.priority] || 4;
        const dateA = String(a.startDate || a.dueDate || '9999-12-31');
        const dateB = String(b.startDate || b.dueDate || '9999-12-31');
        return (pA - pB) || dateA.localeCompare(dateB);
    });

    c.innerHTML = `
    ${renderVisualTimeline(allTodayTasks)}
    <div class="grid grid-cols-3 gap-3 mb-6">

        <div onclick="showStatDetails('todo')" class="card-bg p-4 rounded-xl flex items-center justify-between cursor-pointer hover:bg-[#252526] transition shadow-sm border-t-2 border-t-gray-500 card-hover">
            <div><p class="text-[9px] text-gray-500 uppercase font-bold">Akan Dikerjakan</p><h3 class="text-2xl font-bold text-white mt-1" id="statTodo">0</h3></div>
            <i class="fa-solid fa-list-ul text-gray-700 text-xl"></i>
        </div>
        <div onclick="showStatDetails('progress')" class="card-bg p-4 rounded-xl flex items-center justify-between cursor-pointer hover:bg-[#252526] transition shadow-sm border-t-2 border-t-blue-500 card-hover">
            <div><p class="text-[9px] text-gray-500 uppercase font-bold">Sedang Proses</p><h3 class="text-2xl font-bold text-blue-400 mt-1" id="statProgress">0</h3></div>
            <i class="fa-solid fa-spinner text-blue-900 text-xl"></i>
        </div>
        <div onclick="showStatDetails('done')" class="card-bg p-4 rounded-xl flex items-center justify-between cursor-pointer hover:bg-[#252526] transition shadow-sm border-t-2 border-t-emerald-500 card-hover">
            <div><p class="text-[9px] text-gray-500 uppercase font-bold">Selesai Hari Ini</p><h3 class="text-2xl font-bold text-emerald-400 mt-1" id="statDone">0</h3></div>
            <i class="fa-solid fa-check-double text-emerald-900 text-xl"></i>
        </div>
    </div>
    <div class="space-y-3 animate-fadein">
        ${list.length === 0 ?
            '<div class="text-center bg-[#1a1a1a] rounded-xl border border-dashed border-[#333] py-16"><i class="fa-solid fa-mug-hot text-gray-700 text-3xl mb-3 block"></i><p class="text-gray-500 italic text-sm">Aman terkendali, tidak ada tugas aktif.</p></div>' : ''}
        ${list.map(t => {
            let borderCol = t.type === 'meeting'
                ? 'border-l-meeting'
                : (t.status === 'In Progress'
                    ? 'border-l-[3px] border-l-blue-400'
                    : (t.isRoutine ? 'border-l-routine' : 'border-l-' + (t.priority || 'Low').toLowerCase()));
            return `
            <div onclick="openTaskModal('${t.id}')" class="card-bg p-4 rounded-xl flex items-center gap-4 transition hover:bg-[#2a2a2a] cursor-pointer ${borderCol} card-hover">
                <button onclick="quickDone('${t.id}'); event.stopPropagation()"
                    class="w-7 h-7 border border-gray-600 rounded-full hover:border-emerald-500 text-transparent hover:text-emerald-500 flex items-center justify-center transition shrink-0">
                    <i class="fa-solid fa-check text-xs"></i>
                </button>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 text-[10px] font-bold text-gray-500 mb-1 uppercase flex-wrap">
                        ${t.type === 'meeting'
                            ? `<span class="bg-pink-900/20 text-pink-500 px-2 py-0.5 rounded border border-pink-900/30">MEETING</span>`
                            : `<span class="bg-[#333] px-2 py-0.5 rounded text-gray-400">${t.project || 'Umum'}</span>`}
                        <span class="${t.status === 'In Progress' ? 'text-blue-400' : 'text-gray-400'}">
                            <i class="fa-solid fa-spinner ${t.status === 'In Progress' ? 'fa-spin' : ''}"></i> ${window.STATUS_LABELS ? window.STATUS_LABELS[t.status] || t.status : t.status}
                        </span>
                        <span class="text-blue-400 ml-1"><i class="fa-regular fa-clock"></i> ${t.hours || 0} Mnt</span>
                        ${t.isRoutine ? `<span class="text-purple-400 ml-1">🔄 ${t.routineType}</span>` : ''}
                        ${(function() {
                            var myUid = currentUser.uid;
                            if (t.type === 'meeting' && t.uid !== myUid && t.participants && t.participants[myUid]) {
                                var org = allUsers[t.uid]; var orgName = org ? (org.name || org.email || 'Seseorang') : 'Seseorang';
                                return '<span class="text-[9px] bg-rose-900/30 text-rose-400 border border-rose-500/30 px-1.5 py-0.5 rounded font-bold normal-case"><i class="fa-solid fa-envelope mr-1"></i>Undangan: ' + orgName + '</span>';
                            }
                            if (t.delegatedBy && t.delegatedBy !== myUid) {
                                var del = allUsers[t.delegatedBy]; var delName = del ? (del.name || del.email || 'Atasan') : 'Atasan';
                                return '<span class="text-[9px] bg-orange-900/30 text-orange-400 border border-orange-500/30 px-1.5 py-0.5 rounded font-bold normal-case"><i class="fa-solid fa-share-nodes mr-1"></i>Dari: ' + delName + '</span>';
                            }
                            return '';
                        })()}
                        <span class="text-gray-600 ml-auto hidden md:inline">TENGGAT: ${t.dueDate || '-'}</span>
                    </div>
                    <h4 class="text-sm font-bold text-gray-200 truncate">
                        ${t.title}
                        ${t.link ? `<a href="${t.link}" target="_blank" class="text-blue-500 ml-1" onclick="event.stopPropagation()"><i class="fa-solid fa-link"></i></a>` : ''}
                    </h4>
                </div>
            </div>`;
        }).join('')}
    </div>
    ${overdueTasks.length > 0 ? `
    <div class="mt-6 animate-fadein">
        <div class="flex items-center gap-2 mb-3">
            <i class="fa-solid fa-triangle-exclamation text-red-400 text-sm"></i>
            <h4 class="text-[10px] font-bold text-red-400 uppercase tracking-widest">Tunggakan — Belum Selesai (${overdueTasks.length})</h4>
        </div>
        <div class="space-y-2">
        ${overdueTasks.map(t => `
            <div onclick="openTaskModal('${t.id}')" class="bg-red-950/20 border border-red-800/30 p-3 rounded-xl flex items-center gap-3 cursor-pointer hover:bg-red-900/20 transition">
                <i class="fa-solid fa-clock-rotate-left text-red-500 shrink-0"></i>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-200 truncate">${t.title}</p>
                    <p class="text-[9px] text-red-400 mt-0.5">Tenggat: ${t.dueDate} &bull; ${t.project || 'Umum'} &bull; ${window.STATUS_LABELS ? window.STATUS_LABELS[t.status] || t.status : t.status}</p>
                </div>
                <span class="text-[9px] bg-red-900/40 text-red-400 border border-red-700/40 px-2 py-0.5 rounded font-bold shrink-0">TERLAMBAT</span>
            </div>`).join('')}
        </div>
    </div>` : ''}`;

    updateDashboardNumbers();
}

// --- Break Override Logic ---
window.openTodayBreakModal = function() {
    var s = (currentUser && currentUser.settings) || {};
    var defaultBreak = (s.breaks && s.breaks[0]) ? s.breaks[0] : {start: '12:00', end: '13:00'};
    var todayStr = getLocalISODate();
    var currBreak = (currentUser && currentUser.todayBreak && currentUser.todayBreak[todayStr]) ? currentUser.todayBreak[todayStr] : defaultBreak;
    
    document.getElementById('todayBreakStart').value = currBreak.start;
    document.getElementById('todayBreakEnd').value = currBreak.end;
    document.getElementById('todayBreakModal').classList.remove('hidden');
};

window.saveTodayBreak = function() {
    var start = document.getElementById('todayBreakStart').value;
    var end = document.getElementById('todayBreakEnd').value;
    if (!start || !end) {
        showToast('Jam istirahat harus diisi lengkap!', 'error');
        return;
    }
    
    var todayStr = getLocalISODate();
    db.ref('users/' + currentUser.uid + '/todayBreak/' + todayStr).set({
        start: start,
        end: end
    }).then(function() {
        if (!currentUser.todayBreak) currentUser.todayBreak = {};
        currentUser.todayBreak[todayStr] = {start: start, end: end};
        closeModal('todayBreakModal');
        showToast('Waktu istirahat hari ini berhasil diubah.', 'success');
        updateGlobalStats();
        if (typeof renderTodayView === 'function') {
            var vc = document.getElementById('viewContainer');
            if (vc) renderTodayView(vc);
        }
    }).catch(function(e) {
        showToast('Gagal menyimpan: ' + e.message, 'error');
    });
};

window.resetTodayBreak = function() {
    var todayStr = getLocalISODate();
    db.ref('users/' + currentUser.uid + '/todayBreak/' + todayStr).remove().then(function() {
        if (currentUser.todayBreak) delete currentUser.todayBreak[todayStr];
        closeModal('todayBreakModal');
        showToast('Waktu istirahat dikembalikan ke default.', 'success');
        updateGlobalStats();
        if (typeof renderTodayView === 'function') {
            var vc = document.getElementById('viewContainer');
            if (vc) renderTodayView(vc);
        }
    });
};

