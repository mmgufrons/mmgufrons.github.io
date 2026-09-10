/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/stats.js — Dashboard Stats & Report Generator
   ============================================================ */

/**
 * Update the header load bar and weekly progress widget.
 * Anti-crash: all DOM element checks included.
 */
function updateGlobalStats() {
    try {
        const todayStr  = getLocalISODate();
        const loadMins  = calculateLoadForDate(todayStr);
        const loadHours = (loadMins / 60).toFixed(1);

        let maxHours = 8;
        if (currentUser && currentUser.settings) {
            const s = currentUser.settings;
            if (s.timeIn && s.timeOut) {
                const tIn = s.timeIn.split(':');
                const tOut = s.timeOut.split(':');
                let totalMins = (parseInt(tOut[0])*60 + parseInt(tOut[1])) - (parseInt(tIn[0])*60 + parseInt(tIn[1]));
                let activeBreaks = s.breaks || [];
                const todayStr = getLocalISODate();
                if (currentUser.todayBreak && currentUser.todayBreak[todayStr]) {
                    activeBreaks = [currentUser.todayBreak[todayStr]];
                }
                
                if (activeBreaks && activeBreaks.length > 0) {
                    activeBreaks.forEach(b => {
                        if (b.start && b.end) {
                            const bIn = b.start.split(':');
                            const bOut = b.end.split(':');
                            totalMins -= ((parseInt(bOut[0])*60 + parseInt(bOut[1])) - (parseInt(bIn[0])*60 + parseInt(bIn[1])));
                        }
                    });
                }
                if (totalMins > 0) maxHours = (totalMins / 60);
            }
        }
        maxHours = parseFloat(maxHours.toFixed(1));

        const loadBarText = document.getElementById('loadBarText');
        const loadBar     = document.getElementById('loadBar');
        const overload    = document.getElementById('overloadAlert');

        if (loadBarText) loadBarText.innerText = `${loadHours} / ${maxHours} Jam`;
        if (loadBar) {
            loadBar.style.width     = Math.min((loadHours / maxHours) * 100, 100) + '%';
            loadBar.className       = loadHours > maxHours
                ? 'bg-red-500 h-1.5 rounded-full shadow-[0_0_10px_rgba(239,68,68,0.5)] transition-all'
                : 'bg-blue-500 h-1.5 rounded-full transition-all';
        }
        if (overload) overload.classList.toggle('hidden', parseFloat(loadHours) <= maxHours);

        // Weekly done count
        const startWeek = new Date();
        startWeek.setDate(startWeek.getDate() - ((startWeek.getDay() + 6) % 7)); // Monday
        const startWeekStr = getLocalISODate(startWeek);
        const doneWeek = tasks.filter(t =>
            t.uid === currentUser.uid &&
            t.status === 'Done' &&
            !t.isRoutine &&
            (t.endDate || t.dueDate) >= startWeekStr
        ).length;

        const weeklyCount = document.getElementById('weeklyDoneCount');
        const weeklyBar   = document.getElementById('weeklyProgressBar');
        if (weeklyCount) weeklyCount.innerText = doneWeek;
        if (weeklyBar)   weeklyBar.style.width = Math.min((doneWeek / 20) * 100, 100) + '%';

    } catch (e) {
        console.error('[stats.js] updateGlobalStats error:', e);
    }
}

/**
 * Update the 3 stat cards on the Today dashboard.
 * Anti-crash: all isNaN checks included.
 */
function updateDashboardNumbers() {
    try {
        const todayStr = getLocalISODate();
        // Sertakan task milik sendiri PLUS meeting yang diundang
        const myTasks = tasks.filter(function(t) {
            if (t.uid === currentUser.uid) return true;
            return t.type === 'meeting' && t.participants && t.participants[currentUser.uid];
        });

        // Count tasks active today
        const activeToday = myTasks.filter(t => {
            if (!t.dueDate) return false;
            try {
                const start = new Date(t.startDate || t.dueDate);
                const end   = new Date(t.dueDate);
                const curr  = new Date(todayStr);
                if (isNaN(start.getTime()) || isNaN(end.getTime()) || isNaN(curr.getTime())) return false;
                start.setHours(0, 0, 0, 0);
                end.setHours(0, 0, 0, 0);
                curr.setHours(0, 0, 0, 0);
                return curr >= start && curr <= end;
            } catch (e) { return false; }
        });

        const statTodo = document.getElementById('statTodo');
        const statProg = document.getElementById('statProgress');
        const statDone = document.getElementById('statDone');

        if (statTodo) statTodo.innerText = activeToday.filter(t => t.status === 'Planning').length;
        if (statProg) statProg.innerText = myTasks.filter(t => t.status === 'In Progress').length;
        if (statDone) statDone.innerText = myTasks.filter(t =>
            t.status === 'Done' && (t.endDate || t.dueDate) === todayStr
        ).length;

    } catch (e) {
        console.error('[stats.js] updateDashboardNumbers error:', e);
    }
}

/**
 * Show a stat detail popup modal.
 */
function showStatDetails(type) {
    const todayStr = getLocalISODate();
    const modal    = document.getElementById('statModal');
    const content  = document.getElementById('statModalContent');
    const title    = document.getElementById('statModalTitle');
    // Sertakan task milik sendiri PLUS meeting yang diundang
    const myTasks = tasks.filter(function(t) {
        if (t.uid === currentUser.uid) return true;
        return t.type === 'meeting' && t.participants && t.participants[currentUser.uid];
    });

    let filtered = [];
    if (type === 'todo') {
        title.innerText = 'Daftar Tugas Belum Mulai';
        filtered = myTasks.filter(t => {
            if (!t.dueDate) return false;
            try {
                const start = new Date(t.startDate || t.dueDate);
                const end   = new Date(t.dueDate);
                const curr  = new Date(todayStr);
                if (isNaN(start.getTime()) || isNaN(end.getTime()) || isNaN(curr.getTime())) return false;
                start.setHours(0, 0, 0, 0); end.setHours(0, 0, 0, 0); curr.setHours(0, 0, 0, 0);
                return t.status === 'Planning' && curr >= start && curr <= end;
            } catch (e) { return false; }
        });
    } else if (type === 'progress') {
        title.innerText = 'Daftar Sedang Dikerjakan';
        filtered = myTasks.filter(t => t.status === 'In Progress');
    } else if (type === 'done') {
        title.innerText = 'Daftar Selesai Hari Ini';
        filtered = myTasks.filter(t => t.status === 'Done' && (t.endDate || t.dueDate) === todayStr);
    }

    content.innerHTML = filtered.map(t => `
    <div onclick="openTaskModal('${t.id}'); closeModal('statModal')"
        class="bg-[#2a2a2a] p-4 rounded-xl border border-[#3f3f3f] cursor-pointer hover:border-purple-500 transition mb-3 shadow-md">
        <div class="flex justify-between items-center mb-1.5 uppercase font-bold">
            <span class="text-[9px] text-blue-500 bg-blue-900/20 px-1.5 py-0.5 rounded border border-blue-900/50">
                ${t.type === 'meeting' ? 'MEETING' : (t.project || 'Umum')}
            </span>
            <span class="text-[9px] text-gray-500"><i class="fa-regular fa-clock"></i> ${t.dueDate || '-'}</span>
        </div>
        <p class="text-sm text-white font-bold truncate">${t.title}</p>
    </div>`).join('') || '<p class="text-center text-gray-600 py-10 italic">Data Kosong.</p>';

    modal.classList.remove('hidden');
}

// ── Weekly Report ─────────────────────────────────────────────

function showWeeklyReportModal() {
    document.getElementById('reportModal').classList.remove('hidden');
    const today      = new Date();
    const diff       = (today.getDay() + 6) % 7 + 7;
    const lastMonday = new Date(today);
    lastMonday.setDate(today.getDate() - diff);
    const lastSunday = new Date(lastMonday);
    lastSunday.setDate(lastMonday.getDate() + 6);
    document.getElementById('reportStart').value = getLocalISODate(lastMonday);
    document.getElementById('reportEnd').value   = getLocalISODate(lastSunday);
    generateReport();
}

function generateReport() {
    const s = document.getElementById('reportStart').value;
    const e = document.getElementById('reportEnd').value;
    if (!s || !e) return;

    const list = tasks.filter(t =>
        t.uid === currentUser.uid &&
        t.status === 'Done' &&
        (window._statsShowRoutine ? true : !t.isRoutine) &&
        (t.endDate || t.dueDate) >= s &&
        (t.endDate || t.dueDate) <= e
    );

    const btn = document.getElementById('btnStatsRoutine');
    if (btn) {
        if (window._statsShowRoutine) {
            btn.className = "ml-auto text-xs px-3 py-2 rounded-lg border transition font-bold bg-purple-900/30 text-purple-400 border-purple-700/40";
            btn.innerHTML = '<i class="fa-solid fa-rotate-right mr-1"></i>✓ Rutinitas Tampil';
        } else {
            btn.className = "ml-auto text-xs px-3 py-2 rounded-lg border transition font-bold text-gray-500 border-[#3f3f3f] hover:text-white";
            btn.innerHTML = '<i class="fa-solid fa-rotate-right mr-1"></i>Tampilkan Rutinitas';
        }
    }

    document.getElementById('reportContent').innerHTML = `
    <div class="bg-blue-600/10 p-4 border border-blue-500/20 rounded-xl mb-6 text-center uppercase tracking-tighter font-bold shadow-inner">
        <p class="text-blue-400 text-xs mb-1">Total Pencapaian${window._statsShowRoutine ? ' (Termasuk Rutin)' : ' (Non-Rutin)'}</p>
        <p class="text-white text-2xl">${list.length} Pekerjaan</p>
    </div>
    <h4 class="text-red-400 font-bold uppercase text-[10px] mb-2 tracking-widest border-b border-[#333] pb-1">🔥 Prioritas Tinggi Selesai</h4>
    <ul class="list-disc pl-5 mb-6 text-gray-300 space-y-1">
        ${list.filter(t => t.priority === 'High').map(t =>
            `<li>${t.title} <span class="text-gray-500 text-[10px]">(${t.type === 'meeting' ? 'Meeting' : t.project})</span></li>`
        ).join('') || '<li class="italic text-gray-600">Tidak ada.</li>'}
    </ul>
    <h4 class="text-blue-400 font-bold uppercase text-[10px] mb-2 tracking-widest border-b border-[#333] pb-1">✅ Tugas Lainnya Selesai</h4>
    <ul class="list-disc pl-5 text-gray-300 space-y-1">
        ${list.filter(t => t.priority !== 'High').map(t =>
            `<li>${t.title} <span class="text-gray-500 text-[10px]">(${t.type === 'meeting' ? 'Meeting' : t.project})</span></li>`
        ).join('') || '<li class="italic text-gray-600">Tidak ada.</li>'}
    </ul>`;
}

function copyReport() {
    navigator.clipboard.writeText(document.getElementById('reportContent').innerText);
    showToast('Teks laporan berhasil disalin!', 'success');
}
