/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/meeting.js — Meeting View with Search & Filter
   ============================================================ */

var meetingFilterParams = { search: '', sort: 'date_asc', status: 'all' };

function renderMeetingView(c) {
    var selAll      = meetingFilterParams.status === 'all'      ? 'selected' : '';
    var selUpcoming = meetingFilterParams.status === 'upcoming' ? 'selected' : '';
    var selDone     = meetingFilterParams.status === 'done'     ? 'selected' : '';
    var sortAsc     = meetingFilterParams.sort   === 'date_asc' ? 'selected' : '';
    var sortDesc    = meetingFilterParams.sort   === 'date_desc'? 'selected' : '';

    c.innerHTML = '<div class="space-y-4 max-w-4xl mx-auto animate-fadein">' +

        '<div class="flex flex-col sm:flex-row gap-3 items-center bg-[#1a1a1a] p-3 rounded-xl border border-[#333]">' +
        '<input type="text" id="meetSearch" placeholder="Cari judul atau catatan meeting..." ' +
        'class="flex-1 w-full input-bg rounded p-2 text-xs" ' +
        'value="' + meetingFilterParams.search + '" ' +
        'oninput="meetingFilterParams.search = this.value; updateMeetingList()">' +
        '<div class="flex gap-2 w-full sm:w-auto shrink-0">' +
        '<select class="flex-1 input-bg rounded p-2 text-xs" onchange="meetingFilterParams.status = this.value; updateMeetingList()">' +
        '<option value="all" ' + selAll + '>Semua Status</option>' +
        '<option value="upcoming" ' + selUpcoming + '>Upcoming</option>' +
        '<option value="done" ' + selDone + '>Selesai</option>' +
        '</select>' +
        '<select class="flex-1 input-bg rounded p-2 text-xs" onchange="meetingFilterParams.sort = this.value; updateMeetingList()">' +
        '<option value="date_asc" ' + sortAsc + '>Tgl Terdekat</option>' +
        '<option value="date_desc" ' + sortDesc + '>Tgl Terjauh</option>' +
        '</select>' +
        '</div></div>' +

        '<button onclick="openTaskModal(null, null, \'meeting\')" ' +
        'class="w-full py-4 border-2 border-dashed border-pink-600/30 rounded-xl text-pink-500 text-xs font-bold uppercase hover:bg-pink-900/10 transition flex items-center justify-center gap-2">' +
        '<i class="fa-solid fa-plus"></i> JADWALKAN MEETING BARU</button>' +

        '<div id="meetingListContainer" class="grid grid-cols-1 gap-4"></div>' +
        '</div>';

    updateMeetingList();
}

function updateMeetingList() {
    var container = document.getElementById('meetingListContainer');
    if (!container) return;

    var list = tasks.filter(function(t) {
        if (t.type !== 'meeting' || t.status === 'Cancelled') return false;
        // Tampilkan jika user adalah pembuat ATAU peserta yang diundang
        return t.uid === currentUser.uid || (t.participants && t.participants[currentUser.uid]);
    });

    // Filter status
    if (meetingFilterParams.status === 'upcoming') {
        list = list.filter(function(t) { return t.status !== 'Done'; });
    } else if (meetingFilterParams.status === 'done') {
        list = list.filter(function(t) { return t.status === 'Done'; });
    }

    // Filter search
    if (meetingFilterParams.search.trim()) {
        var s = meetingFilterParams.search.toLowerCase();
        list = list.filter(function(t) {
            return (t.title || '').toLowerCase().indexOf(s) !== -1 ||
                   (t.desc  || '').toLowerCase().indexOf(s) !== -1;
        });
    }

    // Sort
    list.sort(function(a, b) {
        var dA = new Date(a.dueDate || 0).getTime();
        var dB = new Date(b.dueDate || 0).getTime();
        if (meetingFilterParams.sort === 'date_asc') {
            if (a.status === 'Done' && b.status !== 'Done') return 1;
            if (b.status === 'Done' && a.status !== 'Done') return -1;
            return dA - dB;
        }
        return dB - dA;
    });

    if (list.length === 0) {
        container.innerHTML = '<p class="text-center text-gray-600 py-10 italic text-sm">Tidak ada meeting yang sesuai filter.</p>';
        return;
    }

    container.innerHTML = list.map(function(t) {
        var plain = '';
        if (t.desc) {
            var temp = document.createElement('div');
            temp.innerHTML = t.desc;
            plain = temp.innerText || temp.textContent || '';
        }
        var isDone   = t.status === 'Done';
        var opacity  = isDone ? 'opacity-60' : '';
        var timeRange = (t.startTime && t.endTime) ? (t.startTime + ' — ' + t.endTime) : (t.hours ? (t.hours + ' Menit') : '-');
        var linkBtn  = t.link
            ? '<a href="' + t.link + '" target="_blank" class="w-8 h-8 rounded bg-blue-600 hover:bg-blue-500 flex items-center justify-center text-white shadow-lg transition shrink-0" onclick="event.stopPropagation()" title="Buka Tautan"><i class="fa-solid fa-arrow-up-right-from-square text-xs"></i></a>'
            : '';
        var doneBtn = !isDone
            ? '<button onclick="event.stopPropagation(); quickDone(\'' + t.id + '\')" class="w-8 h-8 rounded bg-emerald-600 hover:bg-emerald-500 flex items-center justify-center text-white shadow-lg transition shrink-0" title="Tandai Selesai"><i class="fa-solid fa-check text-xs"></i></button>'
            : '';

        var isInvited = (t.uid !== currentUser.uid && t.participants && t.participants[currentUser.uid]);
        var invitedBadge = '';
        if (isInvited) {
            var org2 = allUsers[t.uid];
            var orgName2 = org2 ? (org2.name || org2.email || 'Seseorang') : 'Seseorang';
            invitedBadge = '<span class="text-[9px] bg-rose-900/30 text-rose-400 border border-rose-500/30 px-1.5 py-0.5 rounded font-bold whitespace-nowrap"><i class="fa-solid fa-envelope mr-1"></i>Undangan: ' + orgName2 + '</span>';
        }

        return '<div onclick="openTaskModal(\'' + t.id + '\')" class="bg-[#202020] rounded-xl border border-[#3f3f3f] hover:border-pink-500/60 flex flex-col cursor-pointer transition shadow-lg ' + opacity + ' overflow-hidden group">' +

            '<div class="p-4 border-b border-[#2a2a2a] flex justify-between items-center bg-[#252526]">' +
            '<div class="flex items-center gap-3 min-w-0">' +
            '<div class="w-9 h-9 rounded-full bg-pink-900/20 text-pink-500 flex items-center justify-center border border-pink-500/20 shrink-0"><i class="fa-solid fa-video text-sm"></i></div>' +
            '<div class="min-w-0">' +
            '<div class="flex items-center gap-2 flex-wrap mb-0.5">' +
            '<h4 class="text-white font-bold text-sm group-hover:text-pink-400 transition truncate">' + (t.title || 'Tanpa Judul') + '</h4>' +
            invitedBadge +
            '</div>' +
            '<p class="text-[10px] text-gray-500 flex items-center gap-2"><i class="fa-regular fa-clock text-pink-500/60"></i> ' + (t.dueDate || '-') + ' &nbsp;&bull;&nbsp; ' + timeRange + '</p>' +
            '</div></div>' +

            '<div class="flex items-center gap-2 shrink-0">' +
            doneBtn + linkBtn +
            '</div></div>' +

            '<div class="p-4 bg-[#1a1a1a] border-t border-[#3f3f3f] flex justify-between items-center">' +
            '<div class="text-[10px] font-bold uppercase ' + (isDone ? 'text-emerald-500' : 'text-purple-400') + '"><i class="fa-solid fa-flag mr-1"></i> ' + (window.STATUS_LABELS ? window.STATUS_LABELS[t.status] || t.status : t.status) + '</div>' +
            '<div class="flex items-center gap-2">' +
            '<p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest mb-2">Hasil / Catatan Meeting:</p>' +
            (plain
                ? '<div class="text-gray-300 text-xs leading-relaxed line-clamp-3">' + autoLinkify(plain) + '</div>'
                : '<p class="text-gray-600 text-xs italic">Belum ada catatan untuk meeting ini.</p>'
            ) +
            '</div></div></div>';
    }).join('');
}