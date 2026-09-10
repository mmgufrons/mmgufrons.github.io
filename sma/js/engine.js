/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/engine.js — Routine Engine & Load Calculator
   Load ORDER: #5
   ============================================================ */

/**
 * Main routine check — runs once per day per browser.
 * Blocked if today is a holiday.
 */
function checkRoutines() {
    try {
        var todayStr = getLocalISODate();

        // 1. Block if today is a holiday
        if (holidays.includes(todayStr)) return;

        var storageKey = 'lastRoutine_sma_v9_' + (currentUser ? currentUser.uid : 'anon');
        if (localStorage.getItem(storageKey) !== todayStr) {
            var now     = new Date();
            var day     = now.getDay();       // 0=Sun, 6=Sat
            var dateNum = now.getDate();
            var month   = now.getMonth();
            var year    = now.getFullYear();

            // Daily routines: workDays sudah dinormalisasi ke integer di auth.js
            var wDays = (currentUser && currentUser.workDays) ? currentUser.workDays : 5;
            if (day !== 0 && (day !== 6 || wDays >= 6)) {
                routines.daily.forEach(function(r) { spawnRoutine(r, todayStr, 'Harian'); });
            }

            // Weekly routines: matching day
            routines.weekly
                .filter(function(r) { return parseInt(r.day || 0) === day; })
                .forEach(function(r) { spawnRoutine(r, todayStr, 'Mingguan'); });

            // Monthly routines: matching date, shifted for weekends/holidays
            routines.monthly.forEach(function(r) {
                var targetDate = parseInt(r.date || 1);
                var targetObj  = new Date(year, month, targetDate);
                var targetDay  = targetObj.getDay();

                // Shift for weekends
                if (targetDay === 6) targetObj.setDate(targetDate + 2);
                else if (targetDay === 0) targetObj.setDate(targetDate + 1);

                // Shift for holidays
                while (holidays.includes(getLocalISODate(targetObj))) {
                    targetObj.setDate(targetObj.getDate() + 1);
                }

                var wDays = (currentUser && currentUser.workDays) ? currentUser.workDays : 5;
                if (
                    dateNum === targetObj.getDate() &&
                    targetObj.getDay() !== 0 &&
                    (targetObj.getDay() !== 6 || wDays === 6)
                ) {
                    spawnRoutine(r, todayStr, 'Bulanan');
                }
            });

            localStorage.setItem(storageKey, todayStr);
        }
    } catch (e) {
        console.error('[engine.js] checkRoutines error:', e);
    }
}

/**
 * Create a routine task in Firebase if it doesn't already exist today.
 * v9.0: Inject uid + department dari currentUser.
 */
function spawnRoutine(r, date, type) {
    var exists = tasks.some(function(t) {
        return t.title === r.title && t.dueDate === date && t.isRoutine;
    });
    if (!exists) {
        var id = genId('rt');
        db.ref('tasks/' + id).set({
            id:          id,
            title:       r.title,
            project:     r.tag || 'Rutin',
            status:      'Planning',
            startDate:   date,
            dueDate:     date,
            endDate:     '',
            startTime:   r.startTime || '',
            endTime:     r.endTime || '',
            hours:       parseFloat(r.hours) || 30,
            priority:    'Medium',
            link:        r.link || '',
            desc:        r.desc || '',
            isRoutine:   true,
            routineType: type,
            type:        'task',
            uid:         currentUser ? currentUser.uid : '',
            department:  currentUser ? currentUser.department : ''
        });
    }
}

/**
 * Calculate workload for a given date — uses startTime/endTime for parallel tracking.
 * Anti-crash: full null/NaN safety.
 *
 * v9.0 Logic:
 * - Jika task punya startTime & endTime (meeting/paralel), hitung interval jam.
 * - Jika tidak, distribusikan hours ke span tanggal start-due.
 */
function calculateLoadForDate(dateStr) {
    var loadMins = 0;
    var intervals = [];
    tasks.forEach(function(t) {
        try {
            // Hanya hitung task milik user ini ATAU jika user diundang ke meeting
            if (currentUser && t.uid) {
                var isMyTask = t.uid === currentUser.uid;
                var isInvited = t.type === 'meeting' && t.participants && t.participants[currentUser.uid];
                if (!isMyTask && !isInvited) return;
            }
            if (t.status === 'Cancelled' || !t.dueDate) return;

            var startStr = t.startDate || t.dueDate;
            var endStr   = t.dueDate;

            var start = new Date(startStr);
            var end   = new Date(endStr);
            var curr  = new Date(dateStr);

            if (isNaN(start.getTime()) || isNaN(end.getTime()) || isNaN(curr.getTime())) return;

            start.setHours(0, 0, 0, 0);
            end.setHours(0, 0, 0, 0);
            curr.setHours(0, 0, 0, 0);

            if (curr >= start && curr <= end) {
                // ── Parallel Load: Gunakan interval untuk menghindari tumpang tindih (Double-counting) ──────
                if (t.startTime && t.endTime && t.dueDate === dateStr) {
                    var parts1 = t.startTime.split(':');
                    var parts2 = t.endTime.split(':');
                    if (parts1.length === 2 && parts2.length === 2) {
                        var startMins = parseInt(parts1[0]) * 60 + parseInt(parts1[1]);
                        var endMins   = parseInt(parts2[0]) * 60 + parseInt(parts2[1]);
                        if (endMins > startMins) {
                            intervals.push([startMins, endMins]);
                            return;
                        }
                    }
                }
                // Fallback: distribusi ke span hari
                var diffTime = Math.abs(end - start);
                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                loadMins += (parseFloat(t.hours) || 0) / diffDays;
            }
        } catch (err) {
            // Jangan biarkan satu task merusak seluruh perhitungan
        }
    });

    // ── Algoritma Merge Intervals ──
    if (intervals.length > 0) {
        intervals.sort(function(a, b) { return a[0] - b[0]; });
        var merged = [intervals[0]];
        for (var i = 1; i < intervals.length; i++) {
            var last = merged[merged.length - 1];
            var current = intervals[i];
            if (current[0] <= last[1]) {
                last[1] = Math.max(last[1], current[1]);
            } else {
                merged.push(current);
            }
        }
        merged.forEach(function(iv) {
            loadMins += (iv[1] - iv[0]);
        });
    }

    return loadMins;
}

/**
 * Auto-reschedule today's non-priority, non-active tasks to tomorrow.
 * Skips weekends.
 */
function magicArrange() {
    var todayStr = getLocalISODate();
    var next = new Date();
    next.setDate(next.getDate() + 1);
    if (next.getDay() === 6) next.setDate(next.getDate() + 2);
    if (next.getDay() === 0) next.setDate(next.getDate() + 1);
    var nextStr = getLocalISODate(next);

    tasks.forEach(function(t) {
        if (
            t.dueDate === todayStr &&
            t.priority !== 'High' &&
            t.status !== 'Done' &&
            t.status !== 'In Progress' &&
            (!t.uid || (currentUser && t.uid === currentUser.uid))
        ) {
            db.ref('tasks/' + t.id).update({ dueDate: nextStr });
        }
    });
    showToast('Jadwal non-prioritas bergeser ke besok!', 'info');
}
