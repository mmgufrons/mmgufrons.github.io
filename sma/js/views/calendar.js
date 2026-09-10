/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/calendar.js — Smart Calendar View (FullCalendar)
   ============================================================ */

let calInstance = null;

function renderCalendarView(c) {
    c.className = 'flex-1 overflow-y-auto p-4 md:p-6 pb-24 h-full relative w-full scroll-smooth';
    c.innerHTML = `
    <div class="mb-4 flex gap-2 w-full max-w-sm mx-auto">
        <div class="relative flex-1">
            <i class="fa-solid fa-search absolute left-3 top-3 text-gray-500"></i>
            <input type="text" id="calSearch" placeholder="Cari jadwal/meeting..."
                class="w-full input-bg rounded-lg pl-9 p-2.5 text-xs shadow-sm"
                oninput="filterCalendar()">
        </div>
    </div>
    <div id="cal" class="h-full w-full bg-[#1a1a1a] rounded-xl border border-[#333] overflow-hidden" style="min-height: 70vh;"></div>`;

    initCalendar();
}

function initCalendar(searchQuery = '') {
    const calEl = document.getElementById('cal');
    if (!calEl) return;

    const uid = currentUser.uid;
    const myTasks = tasks.filter(t => {
        // Tampilkan task milik sendiri ATAU meeting yang diundang
        const isOwn = t.uid === uid;
        const isInvited = t.type === 'meeting' && t.participants && t.participants[uid];
        return isOwn || isInvited;
    });
    let filteredTasks = myTasks.filter(t => t.startDate || t.dueDate);
    if (searchQuery) {
        const q = searchQuery.toLowerCase();
        filteredTasks = filteredTasks.filter(t =>
            (t.title || '').toLowerCase().includes(q) ||
            (t.desc  || '').toLowerCase().includes(q) ||
            (t.project || '').toLowerCase().includes(q)
        );
    }

    // Save current viewed date to prevent jumping back to current month on refresh
    let savedDate = null;
    if (calInstance) {
        savedDate = calInstance.getDate();
        calInstance.destroy();
    } 

    // Build holiday events
    const holidayEvents = holidays.map(h => ({
        title:     '🏖️ Libur / Cuti',
        start:     h,
        allDay:    true,
        className: 'fc-event-holiday',
        editable:  false,
        extendedProps: { isHoliday: true, holidayDate: h }
    }));

    // Build task events
    const taskEvents = filteredTasks.map(t => {
        let cls = '';
        if (t.type === 'meeting')       cls = 'fc-event-meeting';
        else if (t.status === 'Done')        cls = 'fc-event-done';
        else if (t.status === 'Cancelled')   cls = 'fc-event-cancelled';
        else if (t.status === 'In Progress') cls = 'fc-event-progress';
        else if (t.isRoutine)                cls = 'fc-event-routine';
        else                                 cls = 'fc-event-planning';

        let endD = t.dueDate || t.startDate;
        if (t.startDate && t.dueDate && t.startDate !== t.dueDate) {
            const d = new Date(t.dueDate);
            if (!isNaN(d.getTime())) {
                d.setDate(d.getDate() + 1);
                endD = d.toISOString().split('T')[0];
            }
        }

        return {
            id:        t.id,
            title:     (t.type === 'meeting'
                ? (t.uid !== uid && t.participants && t.participants[uid] ? '📩 ' : '📹 ')
                : '') + (t.title || 'Tanpa Judul'),
            start:     t.startDate || t.dueDate,
            end:       endD,
            className: cls,
            allDay:    true,
            editable:  (!t.isRoutine && t.status !== 'Done' && t.status !== 'Cancelled')
        };
    });

    calInstance = new FullCalendar.Calendar(calEl, {
        initialView:   'dayGridMonth',
        initialDate:   savedDate || new Date(),
        height:        '100%',
        headerToolbar: { left: 'prev,next today', center: 'title', right: 'dayGridMonth,listWeek' },
        events:        [...holidayEvents, ...taskEvents],
        editable:      true,
        droppable:     true,
        eventOrder:    '-type,status',

        // Drag to reschedule
        eventDrop: (info) => {
            if (confirm('Geser jadwal ini? Waktu mulai dan tenggat akan otomatis menyesuaikan.')) {
                const deltaDays = info.delta.days || 0;
                const t = tasks.find(x => x.id === info.event.id);
                if (!t) { info.revert(); return; }

                let newStart = t.startDate;
                if (newStart) {
                    const ds = new Date(newStart);
                    ds.setDate(ds.getDate() + deltaDays);
                    newStart = getLocalISODate(ds);
                }
                let newDue = t.dueDate;
                if (newDue) {
                    const dd = new Date(newDue);
                    dd.setDate(dd.getDate() + deltaDays);
                    newDue = getLocalISODate(dd);
                }
                db.ref('tasks/' + t.id).update({ startDate: newStart, dueDate: newDue });
            } else {
                info.revert();
            }
        },

        // Click event → open task modal / holiday toggle
        eventClick: (info) => {
            if (info.event.extendedProps.isHoliday) {
                if (confirm('Hapus hari libur ' + info.event.extendedProps.holidayDate + '?')) {
                    const h = info.event.extendedProps.holidayDate;
                    holidays = holidays.filter(x => x !== h);
                    db.ref('holidays/' + currentUser.uid).set(holidays).catch(e => {
                        showToast('Gagal menghapus libur: Akses ditolak', 'error');
                        console.error('Firebase Rules Error:', e);
                    });
                }
            } else {
                openTaskModal(info.event.id);
            }
        },

        // Click blank date → open task or toggle holiday
        dateClick: (info) => {
            const dateStr = info.dateStr;
            const isHol   = holidays.includes(dateStr);
            if (isHol) {
                if (confirm('Hapus hari libur pada ' + dateStr + '?')) {
                    holidays = holidays.filter(h => h !== dateStr);
                    db.ref('holidays/' + currentUser.uid).set(holidays).catch(e => {
                        showToast('Gagal menghapus libur: Akses ditolak', 'error');
                    });
                }
            } else {
                // Show custom modal
                const modal = document.getElementById('calendarActionModal');
                if (modal) {
                    document.getElementById('calActionTitle').innerText = 'Tindakan: ' + dateStr;
                    
                    const btnTask = document.getElementById('calActionNewTask');
                    const btnHol = document.getElementById('calActionHoliday');
                    
                    btnTask.onclick = function() {
                        closeModal('calendarActionModal');
                        openTaskModal(null, dateStr);
                    };
                    
                    btnHol.onclick = function() {
                        closeModal('calendarActionModal');
                        if (!holidays.includes(dateStr)) {
                            holidays.push(dateStr);
                            db.ref('holidays/' + currentUser.uid).set(holidays).then(() => {
                                showToast('Tanggal ' + dateStr + ' ditandai sebagai Hari Libur.', 'info');
                            }).catch(e => {
                                showToast('Gagal menyimpan hari libur: ' + e.message, 'error');
                            });
                        }
                    };
                    
                    modal.classList.remove('hidden');
                }
            }
        },

        // Cell decoration: workload indicator + holiday highlight
        dayCellDidMount: (info) => {
            const dateStr = getLocalISODate(info.date);

            // Holiday highlight
            if (holidays.includes(dateStr)) {
                info.el.classList.add('fc-day-holiday');
            }

            // Load indicator
            const loadMins  = calculateLoadForDate(dateStr);
            if (loadMins > 0) {
                const loadHours = (loadMins / 60).toFixed(1);
                const el = document.createElement('div');
                el.className = 'text-[9px] font-bold px-1.5 py-0.5 rounded mr-1 ' +
                    (loadHours > 8 ? 'bg-red-900/80 text-red-300' : 'bg-blue-900/50 text-blue-300');
                el.innerHTML = `<i class="fa-regular fa-clock"></i> ${loadHours}j`;

                const topDiv = info.el.querySelector('.fc-daygrid-day-top');
                if (topDiv) {
                    topDiv.style.display        = 'flex';
                    topDiv.style.flexDirection  = 'row-reverse';
                    topDiv.style.justifyContent = 'space-between';
                    topDiv.appendChild(el);
                }
            }
        }
    });

    setTimeout(() => calInstance.render(), 100);
}

function filterCalendar() {
    const q = document.getElementById('calSearch');
    if (q) initCalendar(q.value);
}
