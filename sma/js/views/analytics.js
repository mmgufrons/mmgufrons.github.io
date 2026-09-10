/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/analytics.js — Enterprise Analytics Dashboard
   ============================================================ */

// _analyticsScope dideklarasikan di app.js (var global)
// Nilai: 'company' | 'dept' | 'personal'

function renderAnalyticsView(c) {
    const todayStr    = getLocalISODate();
    const role        = currentUser.role;
    const isLightMode = document.body.classList.contains('light-mode');

    window._analyticsFilters = window._analyticsFilters || { startDate: '', endDate: '' };
    window.updateAnalyticsFilter = function(key, val) {
        if (val && val.length > 0 && val.length < 10) return; // Prevent partial date refresh
        window._analyticsFilters[key] = val;
        var c = document.getElementById('viewContainer');
        if (c) renderAnalyticsView(c);
    };

    // ── Resolve scope ────────────────────────────────────────────
    // SuperAdmin bisa pilih sendiri; role lain sudah fixed
    let scopeTasks = [];
    let scopeLabel = '';
    let effectiveScope = _analyticsScope;

    const isSuperAdmin   = (role === 'SuperAdmin' || role === 'Direktur');
    const isSPV          = role === 'Supervisor';
    const isExec         = role === 'Executive';
    const isDeptExec     = role === 'DeptExecutive';
    const isWorker       = role === 'Staff';

    if (isSuperAdmin) {
        if (effectiveScope === 'personal') {
            scopeTasks = tasks.filter(t => t.uid === currentUser.uid);
            scopeLabel = 'Data Pribadi (' + currentUser.department + ')';
        } else if (effectiveScope === 'dept') {
            scopeTasks = tasks.filter(t => t.department === currentUser.department);
            scopeLabel = 'Divisi ' + currentUser.department;
        } else {
            // default 'company' for SuperAdmin
            scopeTasks = tasks;
            scopeLabel = 'Seluruh Perusahaan';
            effectiveScope = 'company';
        }
    } else if (isExec) {
        scopeTasks = tasks;
        scopeLabel = 'Seluruh Perusahaan';
    } else if (isDeptExec) {
        const watchDept = currentUser.watchDepartment || currentUser.department;
        scopeTasks = tasks.filter(t => t.department === watchDept);
        scopeLabel = 'Divisi ' + watchDept;
    } else if (isSPV) {
        scopeTasks = tasks.filter(t => t.department === currentUser.department);
        scopeLabel = 'Divisi ' + currentUser.department;
    } else {
        scopeTasks = tasks.filter(t => t.uid === currentUser.uid);
        scopeLabel = 'Data Pribadi';
    }

    const isEnterprise = !isWorker;

    // Filter by Date
    if (_analyticsFilters.startDate || _analyticsFilters.endDate) {
        scopeTasks = scopeTasks.filter(t => {
            var d = t.dueDate || t.endDate;
            if (_analyticsFilters.startDate && (!d || d < _analyticsFilters.startDate)) return false;
            if (_analyticsFilters.endDate && (!d || d > _analyticsFilters.endDate)) return false;
            return true;
        });
    }

    // ── KPI ──────────────────────────────────────────────────────
    const totalTasks   = scopeTasks.filter(t => !t.isRoutine && t.status !== 'Cancelled');
    const activeTasks  = totalTasks.filter(t => ['Planning','In Progress','On Hold'].includes(t.status));
    const doneTasks    = totalTasks.filter(t => t.status === 'Done');
    const overdueTasks = activeTasks.filter(t => t.dueDate && t.dueDate < todayStr);
    const completionRate = totalTasks.length > 0 ? Math.round((doneTasks.length / totalTasks.length) * 100) : 0;
    const completionColor = completionRate >= 70 ? 'text-emerald-400' : completionRate >= 40 ? 'text-yellow-400' : 'text-red-400';

    // ── Workload 7 hari ──────────────────────────────────────────
    let next7DaysMins = 0;
    for (let i = 0; i < 7; i++) {
        let d = new Date(); d.setDate(d.getDate() + i);
        next7DaysMins += calculateLoadForDate(getLocalISODate(d));
    }
    const next7DaysHours = (next7DaysMins / 60).toFixed(1);

    // ── Base End Date for Trends ─────────────────────────────────
    let baseEndDateObj = new Date();
    if (_analyticsFilters.endDate) {
        baseEndDateObj = new Date(_analyticsFilters.endDate);
    } else if (_analyticsFilters.startDate) {
        let sd = new Date(_analyticsFilters.startDate);
        sd.setDate(sd.getDate() + 6);
        if (sd < baseEndDateObj) baseEndDateObj = sd;
    }

    // ── Tren 7 hari terakhir (atau berdasar filter) ──────────────
    const last7 = [], last7Labels = [];
    for (let i = 6; i >= 0; i--) {
        const d = new Date(baseEndDateObj); d.setDate(d.getDate() - i);
        const ds = getLocalISODate(d);
        last7Labels.push(d.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric' }));
        last7.push(scopeTasks.filter(t => t.status === 'Done' && (t.endDate || '').startsWith(ds)).length);
    }

    // ── Productivity Target + Toggle Rutinitas ──────────────────
    window._analyticsShowRoutine = window._analyticsShowRoutine || false;
    let doneWeekly = 0;
    let isFilterActive = !!(_analyticsFilters.startDate || _analyticsFilters.endDate);
    let prodTarget = isEnterprise ? 50 : 10;
    
    const showRoutineFilter = (t) => window._analyticsShowRoutine ? true : !t.isRoutine;
    
    if (isFilterActive) {
        doneWeekly = scopeTasks.filter(t => t.status === 'Done' && showRoutineFilter(t)).length;
        let endD = _analyticsFilters.endDate ? new Date(_analyticsFilters.endDate) : new Date();
        let startD = _analyticsFilters.startDate ? new Date(_analyticsFilters.startDate) : new Date();
        if (!_analyticsFilters.startDate) { startD = new Date(endD); startD.setDate(startD.getDate() - 30); }
        let daysDiff = Math.max(1, Math.round((endD - startD) / (1000 * 60 * 60 * 24)));
        prodTarget = Math.round((prodTarget / 7) * daysDiff);
        if (prodTarget < 1) prodTarget = 1;
    } else {
        const startWeek = new Date();
        startWeek.setDate(startWeek.getDate() - ((startWeek.getDay() + 6) % 7));
        const startWeekStr = getLocalISODate(startWeek);
        doneWeekly = scopeTasks.filter(t => t.status === 'Done' && showRoutineFilter(t) && (t.endDate || t.dueDate) >= startWeekStr).length;
    }

    // ── Project distribution ─────────────────────────────────────
    const projectCounts = {};
    activeTasks.forEach(t => {
        const p = t.project || 'Umum';
        projectCounts[p] = (projectCounts[p] || 0) + 1;
    });
    const sortedProjects = Object.entries(projectCounts).sort((a, b) => b[1] - a[1]).slice(0, 6);

    const statusCounts = {
        [window.STATUS_LABELS ? window.STATUS_LABELS['Planning'] : 'Rencana']:    totalTasks.filter(t => t.status === 'Planning').length,
        [window.STATUS_LABELS ? window.STATUS_LABELS['In Progress'] : 'Proses (Jalan)']: totalTasks.filter(t => t.status === 'In Progress').length,
        [window.STATUS_LABELS ? window.STATUS_LABELS['On Hold'] : 'Ditunda']:   totalTasks.filter(t => t.status === 'On Hold').length,
        [window.STATUS_LABELS ? window.STATUS_LABELS['Done'] : 'Selesai']:      totalTasks.filter(t => t.status === 'Done').length,
        [window.STATUS_LABELS ? window.STATUS_LABELS['Cancelled'] : 'Batal']: totalTasks.filter(t => t.status === 'Cancelled').length
    };

    // ── Department breakdown (SuperAdmin company scope, Executive) ─
    const deptData = {};
    if ((isSuperAdmin && effectiveScope === 'company') || isExec) {
        // Init with all known departments
        Object.values(allUsers).forEach(u => {
            const dept = u.department || 'Lainnya';
            if (!deptData[dept]) deptData[dept] = { total: 0, done: 0 };
        });
        // Tally by task department
        tasks.filter(t => !t.isRoutine).forEach(t => {
            const dept = t.department || 'Lainnya';
            if (!deptData[dept]) deptData[dept] = { total: 0, done: 0 };
            deptData[dept].total++;
            if (t.status === 'Done') deptData[dept].done++;
        });
    }

    // ── Dept filter for Executive drill-down ─────────────────────
    let deptFilter = typeof _analyticsDeptFilter !== 'undefined' ? _analyticsDeptFilter : null;

    const textCol   = isLightMode ? '#1c1c1e' : '#9ca3af';
    const gridCol   = isLightMode ? 'rgba(0,0,0,0.07)' : 'rgba(255,255,255,0.06)';
    const chartBg   = isLightMode ? '#ffffff' : '#202020';

    // ── SuperAdmin scope toggle HTML ─────────────────────────────
    const scopeToggleHtml = isSuperAdmin ? `
    <div class="flex gap-1 bg-[#1a1a1a] p-1 rounded-lg border border-[#333]">
        <button onclick="_analyticsScope='company'; renderAnalyticsView(document.getElementById('viewContainer'))"
            class="px-3 py-1.5 text-[10px] font-bold rounded transition ${effectiveScope === 'company' ? 'bg-purple-600 text-white' : 'text-gray-400 hover:text-white'}">
            <i class="fa-solid fa-building mr-1"></i>Perusahaan
        </button>
        <button onclick="_analyticsScope='dept'; renderAnalyticsView(document.getElementById('viewContainer'))"
            class="px-3 py-1.5 text-[10px] font-bold rounded transition ${effectiveScope === 'dept' ? 'bg-blue-600 text-white' : 'text-gray-400 hover:text-white'}">
            <i class="fa-solid fa-people-roof mr-1"></i>Divisi Saya
        </button>
        <button onclick="_analyticsScope='personal'; renderAnalyticsView(document.getElementById('viewContainer'))"
            class="px-3 py-1.5 text-[10px] font-bold rounded transition ${effectiveScope === 'personal' ? 'bg-emerald-600 text-white' : 'text-gray-400 hover:text-white'}">
            <i class="fa-solid fa-user mr-1"></i>Pribadi
        </button>
    </div>` : '';

    const dateFilterHtml = `
    <div class="flex gap-2 items-center bg-[#1a1a1a] p-1.5 px-3 rounded-lg border border-[#333] text-xs">
        <span class="text-gray-400">Tgl:</span>
        <input type="date" value="${_analyticsFilters.startDate}" onblur="updateAnalyticsFilter('startDate', this.value)" class="input-bg border border-[#3f3f3f] text-white rounded px-2 py-1">
        <span class="text-gray-500">-</span>
        <input type="date" value="${_analyticsFilters.endDate}" onblur="updateAnalyticsFilter('endDate', this.value)" class="input-bg border border-[#3f3f3f] text-white rounded px-2 py-1">
        ${(_analyticsFilters.startDate || _analyticsFilters.endDate) ? '<button onclick="updateAnalyticsFilter(\'startDate\', \'\'); updateAnalyticsFilter(\'endDate\', \'\');" class="text-red-400 hover:text-red-300 ml-1"><i class="fa-solid fa-xmark"></i></button>' : ''}
    </div>`;

    c.innerHTML = `
    <div class="max-w-6xl mx-auto space-y-6 animate-fadein pb-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-white uppercase tracking-widest flex items-center gap-3">
                    <i class="fa-solid fa-chart-pie text-purple-500"></i> Enterprise Analytics
                </h2>
                <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-wider">
                    Scope: <span class="text-purple-400 font-bold">${scopeLabel}</span>
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                ${dateFilterHtml}
                ${scopeToggleHtml}
                <button onclick="exportDataCSV()" class="bg-[#1a1a1a] hover:bg-[#2a2a2a] text-gray-300 px-3 py-2 rounded-lg text-[10px] font-bold border border-[#3f3f3f] transition flex items-center gap-2 uppercase">
                    <i class="fa-solid fa-file-csv text-green-400"></i> CSV
                </button>
                <button onclick="exportDataPDF()" class="bg-[#1a1a1a] hover:bg-[#2a2a2a] text-gray-300 px-3 py-2 rounded-lg text-[10px] font-bold border border-[#3f3f3f] transition flex items-center gap-2 uppercase">
                    <i class="fa-solid fa-file-pdf text-red-400"></i> PDF
                </button>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <div class="bg-[#202020] rounded-xl p-5 border border-[#2f2f2f] shadow-lg relative overflow-hidden group hover:border-blue-500/40 transition cursor-pointer" onclick="switchView('board')">
                <div class="absolute -right-3 -top-3 text-blue-900 opacity-30 text-6xl group-hover:scale-110 transition-transform"><i class="fa-solid fa-list-check"></i></div>
                <h4 class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mb-1 relative z-10">Tugas Aktif</h4>
                <p class="text-3xl font-black text-blue-400 relative z-10">${activeTasks.length}</p>
                <p class="text-[9px] mt-1 relative z-10">${overdueTasks.length > 0 ? '<span class="text-red-400 font-bold">⚠ ' + overdueTasks.length + ' Overdue</span>' : '<span class="text-emerald-400">On-track ✓</span>'}</p>
            </div>
            <div class="bg-[#202020] rounded-xl p-5 border border-[#2f2f2f] shadow-lg relative overflow-hidden group">
                <div class="absolute -right-3 -top-3 text-emerald-900 opacity-30 text-6xl group-hover:scale-110 transition-transform"><i class="fa-solid fa-circle-check"></i></div>
                <h4 class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mb-1 relative z-10">Total Selesai</h4>
                <p class="text-3xl font-black text-emerald-400 relative z-10">${doneTasks.length}</p>
                <p class="text-[9px] text-gray-500 mt-1 relative z-10">Dari ${totalTasks.length} total</p>
            </div>
            <div class="bg-[#202020] rounded-xl p-5 border border-[#2f2f2f] shadow-lg relative overflow-hidden group">
                <div class="absolute -right-3 -top-3 text-purple-900 opacity-30 text-6xl group-hover:scale-110 transition-transform"><i class="fa-solid fa-percent"></i></div>
                <h4 class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mb-1 relative z-10">Completion Rate</h4>
                <p class="text-3xl font-black ${completionColor} relative z-10">${completionRate}<span class="text-lg">%</span></p>
                <div class="mt-2 w-full bg-gray-800 h-1.5 rounded-full overflow-hidden relative z-10">
                    <div class="h-1.5 rounded-full bg-gradient-to-r from-purple-600 to-emerald-500 transition-all duration-1000" style="width:${completionRate}%"></div>
                </div>
            </div>
            <div class="bg-[#202020] rounded-xl p-5 border border-[#2f2f2f] shadow-lg relative overflow-hidden group">
                <div class="absolute -right-3 -top-3 text-orange-900 opacity-30 text-6xl group-hover:scale-110 transition-transform"><i class="fa-solid fa-clock"></i></div>
                <h4 class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mb-1 relative z-10">Beban 7 Hari (Pribadi)</h4>
                <p class="text-3xl font-black ${next7DaysHours > 40 ? 'text-red-400' : 'text-orange-400'} relative z-10">${next7DaysHours}<span class="text-lg font-bold text-gray-500">j</span></p>
                <p class="text-[9px] mt-1 relative z-10">${parseFloat(next7DaysHours) > 40 ? '<span class="text-red-400 font-bold">Melebihi kapasitas!</span>' : '<span class="text-gray-500">Kapasitas aman</span>'}</p>
            </div>
        </div>

        <!-- Charts row 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-[#202020] rounded-xl p-6 border border-[#2f2f2f] shadow-lg">
                <h3 class="text-xs font-bold text-white uppercase tracking-widest mb-4 border-b border-[#333] pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-chart-line text-purple-400"></i> ${isFilterActive ? 'Tren Harian (Filter)' : 'Produktivitas 7 Hari'}
                </h3>
                <div class="relative h-52"><canvas id="trendLineChart"></canvas></div>
            </div>
            <div class="bg-[#202020] rounded-xl p-6 border border-[#2f2f2f] shadow-lg">
                <h3 class="text-xs font-bold text-white uppercase tracking-widest mb-4 border-b border-[#333] pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-chart-pie text-blue-400"></i> Distribusi Status
                </h3>
                <div class="relative h-52 flex justify-center"><canvas id="statusPieChart"></canvas></div>
            </div>
        </div>

        <!-- Project load -->
        <div class="bg-[#202020] rounded-xl p-6 border border-[#2f2f2f] shadow-lg">
            <h3 class="text-xs font-bold text-white uppercase tracking-widest mb-4 border-b border-[#333] pb-3 flex items-center gap-2">
                <i class="fa-solid fa-bars-progress text-emerald-400"></i> Beban per Proyek / Kampanye
            </h3>
            ${sortedProjects.length === 0
                ? '<p class="text-gray-500 italic text-sm text-center py-6">Belum ada data proyek aktif.</p>'
                : `<div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4">
                    ${sortedProjects.map(([proj, count]) => {
                        const pct = activeTasks.length > 0 ? Math.round((count / activeTasks.length) * 100) : 0;
                        const barColor = pct > 50 ? 'from-red-600 to-orange-500' : pct > 25 ? 'from-yellow-600 to-amber-400' : 'from-blue-600 to-purple-500';
                        return `<div>
                            <div class="flex justify-between text-xs mb-1.5">
                                <span class="font-bold text-gray-300 truncate pr-2">${proj}</span>
                                <span class="text-gray-500 shrink-0">${count} Tugas · ${pct}%</span>
                            </div>
                            <div class="w-full bg-[#1a1a1a] h-2.5 rounded-full overflow-hidden border border-[#333]">
                                <div class="bg-gradient-to-r ${barColor} h-full rounded-full transition-all duration-1000" style="width:${pct}%"></div>
                            </div>
                        </div>`;
                    }).join('')}
                </div>`
            }
        </div>

        ${Object.keys(deptData).length > 0 ? `
        <!-- Department chart (company scope) -->
        <div class="bg-[#202020] rounded-xl p-6 border border-[#2f2f2f] shadow-lg">
            <h3 class="text-xs font-bold text-white uppercase tracking-widest mb-4 border-b border-[#333] pb-3 flex items-center gap-2">
                <i class="fa-solid fa-building text-yellow-400"></i> Performa per Departemen
            </h3>
            <div class="relative h-56"><canvas id="deptBarChart"></canvas></div>
        </div>` : ''}

        <!-- Weekly summary bar -->
        <div class="bg-[#202020] rounded-xl p-5 border border-[#2f2f2f] shadow-lg">
            <div class="flex justify-between items-center mb-3">
                <div>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">${isFilterActive ? 'Produktivitas Rentang Filter' : 'Produktivitas Pekan Ini'}</p>
                    <p class="text-3xl font-black text-purple-400 mt-1">${doneWeekly} <span class="text-sm text-gray-500 font-normal">tugas selesai</span></p>
                </div>
                <div class="text-right">
                    <p class="text-[9px] text-gray-600 uppercase">Target: ${prodTarget}+/periode</p>
                    <p class="text-[10px] font-bold ${doneWeekly >= prodTarget ? 'text-emerald-400' : 'text-yellow-400'} mt-1">
                        ${doneWeekly >= prodTarget ? '✓ Target tercapai!' : 'Terus semangat!'}
                    </p>
                    <button onclick="window._analyticsShowRoutine = !window._analyticsShowRoutine; renderAnalyticsView(document.getElementById('viewContainer'))"
                        class="mt-2 text-[9px] px-2 py-1 rounded border transition font-bold ${window._analyticsShowRoutine ? 'bg-purple-900/30 text-purple-400 border-purple-700/40' : 'text-gray-500 border-[#3f3f3f] hover:text-white'}">
                        <i class="fa-solid fa-rotate-right mr-1"></i>${window._analyticsShowRoutine ? '✓ Rutinitas Tampil' : 'Tampilkan Rutinitas'}
                    </button>
                </div>
            </div>
            <div class="w-full bg-gray-800 h-2 rounded-full overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-violet-400 h-full rounded-full transition-all duration-1000" style="width:${Math.min((doneWeekly / prodTarget) * 100, 100)}%"></div>
            </div>
        </div>
    </div>`;

    // ── Draw charts ───────────────────────────────────────────────
    setTimeout(() => {
        // Trend line
        const ctxLine = document.getElementById('trendLineChart');
        if (ctxLine) {
            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: last7Labels,
                    datasets: [{
                        label: 'Tugas Selesai',
                        data: last7,
                        borderColor: 'rgba(139,92,246,0.9)',
                        backgroundColor: 'rgba(139,92,246,0.1)',
                        fill: true, tension: 0.45,
                        pointBackgroundColor: 'rgba(139,92,246,1)',
                        pointRadius: 5, pointHoverRadius: 7, borderWidth: 2
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { display: false },
                        tooltip: { backgroundColor: '#1a1a1a', borderColor: '#333', borderWidth: 1, titleColor: textCol, bodyColor: textCol }
                    },
                    scales: {
                        x: { ticks: { color: textCol, font: { size: 9 } }, grid: { color: gridCol } },
                        y: { ticks: { color: textCol, font: { size: 9 }, stepSize: 1 }, grid: { color: gridCol }, beginAtZero: true }
                    }
                }
            });
        }

        // Status donut
        const ctxPie = document.getElementById('statusPieChart');
        if (ctxPie) {
            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: [
                        window.STATUS_LABELS ? window.STATUS_LABELS['Planning'] : 'Rencana',
                        window.STATUS_LABELS ? window.STATUS_LABELS['In Progress'] : 'Proses (Jalan)',
                        window.STATUS_LABELS ? window.STATUS_LABELS['On Hold'] : 'Ditunda',
                        window.STATUS_LABELS ? window.STATUS_LABELS['Done'] : 'Selesai'
                    ],
                    datasets: [{
                        data: [
                            statusCounts[window.STATUS_LABELS ? window.STATUS_LABELS['Planning'] : 'Rencana'],
                            statusCounts[window.STATUS_LABELS ? window.STATUS_LABELS['In Progress'] : 'Proses (Jalan)'],
                            statusCounts[window.STATUS_LABELS ? window.STATUS_LABELS['On Hold'] : 'Ditunda'],
                            statusCounts[window.STATUS_LABELS ? window.STATUS_LABELS['Done'] : 'Selesai']
                        ],
                        backgroundColor: ['rgba(156,163,175,0.85)','rgba(59,130,246,0.85)','rgba(245,158,11,0.85)','rgba(16,185,129,0.85)'],
                        borderColor: chartBg, borderWidth: 3, hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '65%',
                    plugins: {
                        legend: { position: 'bottom', labels: { color: textCol, font: { size: 10 }, padding: 14 } },
                        tooltip: { backgroundColor: '#1a1a1a', borderColor: '#333', borderWidth: 1, titleColor: textCol, bodyColor: textCol }
                    }
                }
            });
        }

        // Dept bar chart
        const ctxDept = document.getElementById('deptBarChart');
        if (ctxDept && Object.keys(deptData).length > 0) {
            const depts = Object.keys(deptData).sort();
            new Chart(ctxDept, {
                type: 'bar',
                data: {
                    labels: depts,
                    datasets: [
                        { label: 'Total Tugas', data: depts.map(d => deptData[d].total), backgroundColor: 'rgba(99,102,241,0.6)', borderColor: 'rgba(99,102,241,1)', borderWidth: 1, borderRadius: 4 },
                        { label: 'Selesai',     data: depts.map(d => deptData[d].done),  backgroundColor: 'rgba(16,185,129,0.6)',  borderColor: 'rgba(16,185,129,1)',  borderWidth: 1, borderRadius: 4 }
                    ]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { position: 'bottom', labels: { color: textCol, font: { size: 9 }, padding: 12 } },
                        tooltip: { backgroundColor: '#1a1a1a', borderColor: '#333', borderWidth: 1, titleColor: textCol, bodyColor: textCol }
                    },
                    scales: {
                        x: { ticks: { color: textCol, font: { size: 9 } }, grid: { color: gridCol } },
                        y: { ticks: { color: textCol, font: { size: 9 }, stepSize: 1 }, grid: { color: gridCol }, beginAtZero: true }
                    }
                }
            });
        }
    }, 150);
}
