/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/modals.js — All Modal & Form Logic
   ============================================================ */

// ── Activity Log Helper ───────────────────────────────────────
function pushLog(action, title, taskId) {
    db.ref('logs').push({
        action:    action,
        taskTitle: title   || 'Tanpa Judul',
        taskId:    taskId  || '-',
        uid:       currentUser ? currentUser.uid : '-',
        dept:      currentUser ? currentUser.department : '-',
        timestamp: firebase.database.ServerValue.TIMESTAMP
    });
}

// ── Task Modal ────────────────────────────────────────────────

function toggleTaskType() {
    var isMeeting = document.querySelector('input[name="taskType"]:checked').value === 'meeting';
    document.getElementById('lblTitle').innerText  = isMeeting ? 'JUDUL MEETING' : 'NAMA TUGAS';
    document.getElementById('divProject').style.display = isMeeting ? 'none' : 'block';
    document.getElementById('divDue').style.display     = isMeeting ? 'none' : 'block';
    document.getElementById('divEnd').style.display     = isMeeting ? 'none' : 'block';
    document.getElementById('lblHours').innerText  = isMeeting ? 'DURASI MEETING (MENIT)' : 'DURASI KERJA (MENIT)';
    document.getElementById('lblStart').innerText  = isMeeting ? 'TANGGAL' : 'MULAI (OTOMATIS JIKA KOSONG)';
    document.getElementById('lblDesc').innerText   = isMeeting ? 'HASIL MEETING / CATATAN' : 'CATATAN LENGKAP / DESKRIPSI';
    
    var lblTimeStart = document.getElementById('lblTimeStart');
    if (lblTimeStart) lblTimeStart.innerText = isMeeting ? 'JAM MULAI MEETING' : 'JAM MULAI (Opsional)';
    
    var lblAssignee = document.getElementById('lblAssignee');
    var hintAssignee = document.getElementById('lblAssigneeHint');
    var selAssignee = document.getElementById('taskAssignee');
    var chkAssigneeList = document.getElementById('meetingAssigneeList');
    var divAssignee = document.getElementById('divAssignee');
    
    if (lblAssignee) lblAssignee.innerHTML = isMeeting ? '<i class="fa-solid fa-share-nodes"></i> Undang Peserta Meeting' : '<i class="fa-solid fa-share-nodes"></i> Tugaskan Ke (Delegasi)';
    
    if (isMeeting) {
        if (selAssignee) selAssignee.classList.add('hidden');
        if (chkAssigneeList) {
            chkAssigneeList.classList.remove('hidden');
            chkAssigneeList.classList.add('flex');
        }
    } else {
        if (selAssignee) selAssignee.classList.remove('hidden');
        if (chkAssigneeList) {
            chkAssigneeList.classList.add('hidden');
            chkAssigneeList.classList.remove('flex');
        }
    }

    if (hintAssignee) {
        if (isMeeting) hintAssignee.classList.remove('hidden');
        else hintAssignee.classList.add('hidden');
    }
    
    // Always show assignee block for meetings so everyone can invite people
    if (divAssignee) {
        if (isMeeting) {
            divAssignee.classList.remove('hidden');
        } else {
            // Re-eval role for regular tasks
            var myRole = currentUser ? currentUser.role : 'Staff';
            var isSpvPlus = ['SuperAdmin', 'Supervisor', 'Direktur'].includes(myRole);
            var isDelegation = window._isDelegationMode || false; // Hack for delegation check
            var id = document.getElementById('taskId').value;
            if (isDelegation || (id && isSpvPlus)) {
                divAssignee.classList.remove('hidden');
            } else {
                divAssignee.classList.add('hidden');
            }
        }
    }
}

function openTaskModal(id, date, forceType, isDelegation) {
    if (id === undefined || id === null) id = null;
    if (!date) date = '';
    if (!forceType) forceType = 'task';

    var assigneeDiv = document.getElementById('divAssignee');
    var assigneeSel = document.getElementById('taskAssignee');
    var chkAssigneeList = document.getElementById('meetingAssigneeList');
    var commentsDiv = document.getElementById('divComments');
    
    // Populate Assignee Select
    if (assigneeSel) {
        var opts = '<option value="">Pilih Karyawan...</option>';
        var chkHtml = '';
        Object.keys(allUsers).forEach(function(uid) {
            var u = allUsers[uid];
            if (u.isActive === false) return; // Hide inactive users
            // Only show staff/supervisors in same department for SPV, or all for SuperAdmin/Executive/IT
            var myRole = currentUser ? currentUser.role : '';
            var myDept = currentUser ? currentUser.department : '';
            var canSeeAll = (myRole === 'SuperAdmin' || myRole === 'Executive' || myDept === 'IT' || myRole === 'Direktur');
            
            var canSee = false;
            if (uid !== currentUser.uid) {
                if (canSeeAll) canSee = true;
                else if (myRole === 'Supervisor' || myRole === 'DeptExecutive' || myRole === 'Staff') {
                    canSee = (u.department === myDept);
                }
            }

            if (canSee) {
                opts += '<option value="' + uid + '">' + (u.name || u.email) + ' (' + (u.department||'-') + ')</option>';
                chkHtml += '<label class="flex items-center gap-2 text-[11px] text-gray-300 cursor-pointer hover:bg-[#2a2a2a] p-1.5 rounded transition">' +
                           '<input type="checkbox" name="meetingParticipants" value="'+uid+'" class="accent-emerald-500 w-3.5 h-3.5">' +
                           (u.name || u.email) + ' <span class="text-[9px] text-gray-500">(' + (u.department||'-') + ')</span></label>';
            }
        });
        assigneeSel.innerHTML = opts;
        if (chkAssigneeList) chkAssigneeList.innerHTML = chkHtml;
    }

    document.getElementById('taskModal').classList.remove('hidden');
    var descArea = document.getElementById('taskDesc');

    if (id) {
        var t = tasks.find(function(x) { return x.id == id; });
        if (!t) return;
        var typeRadio = document.querySelector('input[name="taskType"][value="' + (t.type || 'task') + '"]');
        if (typeRadio) typeRadio.checked = true;
        else document.querySelector('input[name="taskType"][value="task"]').checked = true;
        document.getElementById('taskId').value        = t.id;
        document.getElementById('taskTitle').value     = t.title || '';
        document.getElementById('taskProject').value   = t.project || '';
        document.getElementById('taskPriority').value  = t.priority || 'Medium';
        document.getElementById('taskStart').value     = t.startDate || '';
        document.getElementById('taskDue').value       = t.dueDate   || '';
        document.getElementById('taskEnd').value       = t.endDate   || '';
        document.getElementById('taskHours').value     = t.hours     || 30;
        document.getElementById('taskStatus').value    = t.status    || 'Planning';
        document.getElementById('taskLink').value      = t.link      || '';
        // startTime & endTime — baru di v9
        var startTimeEl = document.getElementById('taskStartTime');
        var endTimeEl   = document.getElementById('taskEndTime');
        if (startTimeEl) startTimeEl.value = t.startTime || '';
        if (endTimeEl)   endTimeEl.value   = t.endTime   || '';
        descArea.innerHTML = t.desc || '';
        document.getElementById('btnDelete').classList.remove('hidden');
        document.getElementById('btnDuplicate').classList.remove('hidden');
        
        
        if (assigneeSel) {
            if (t.type === 'meeting' && t.participants) {
                document.querySelectorAll('input[name="meetingParticipants"]').forEach(chk => {
                    chk.checked = t.participants[chk.value] ? true : false;
                });
            } else {
                assigneeSel.value = t.uid || '';
            }
        }
        
        var rIndicator = document.getElementById('routineIndicator');
        var rText = document.getElementById('routineIndicatorText');
        if (rIndicator) {
            if (t.isRoutine) {
                rIndicator.classList.remove('hidden');
                if (rText) rText.innerText = 'TUGAS RUTINITAS (' + (t.routineType || '').toUpperCase() + ')';
            } else {
                rIndicator.classList.add('hidden');
            }
        }
    } else {
        document.querySelector('input[name="taskType"][value="' + forceType + '"]').checked = true;
        
        var rIndicator2 = document.getElementById('routineIndicator');
        if (rIndicator2) rIndicator2.classList.add('hidden');
        
        document.getElementById('taskId').value        = '';
        document.getElementById('taskTitle').value     = '';
        document.getElementById('taskProject').value   = '';
        document.getElementById('taskStart').value     = '';
        document.getElementById('taskDue').value       = date ? date : (forceType === 'meeting' ? getLocalISODate() : '');
        document.getElementById('taskEnd').value       = '';
        document.getElementById('taskHours').value     = 30;
        document.getElementById('taskStatus').value    = 'Planning';
        document.getElementById('taskLink').value      = '';
        var startTimeEl2 = document.getElementById('taskStartTime');
        var endTimeEl2   = document.getElementById('taskEndTime');
        if (startTimeEl2) startTimeEl2.value = '';
        if (endTimeEl2)   endTimeEl2.value   = '';
        descArea.innerHTML = '';
        document.getElementById('btnDelete').classList.add('hidden');
        document.getElementById('btnDuplicate').classList.add('hidden');
    }
    
    window._isDelegationMode = isDelegation; // Save for toggleTaskType
    
    if (id) {
        if (commentsDiv) commentsDiv.classList.remove('hidden');
        renderTaskComments(id);
    } else {
        if (commentsDiv) commentsDiv.classList.add('hidden');
    }
    
    var myRole = currentUser ? currentUser.role : 'Staff';
    var isViewOnly = (myRole === 'Executive' || myRole === 'DeptExecutive');
    
    var btnSave = document.querySelector('#taskModal button[onclick="saveTask()"]');
    var btnComment = document.querySelector('#taskModal button[onclick="postTaskComment()"]');
    
    if (isViewOnly) {
        if (btnSave) btnSave.classList.add('hidden');
        if (btnComment) btnComment.classList.add('hidden');
        document.getElementById('btnDelete').classList.add('hidden');
        document.getElementById('btnDuplicate').classList.add('hidden');
    } else {
        if (btnSave) btnSave.classList.remove('hidden');
        if (btnComment) btnComment.classList.remove('hidden');
        // Let the existing logic (line 113) handle Delete/Duplicate initially
    }
    
    toggleTaskType();
    document.getElementById('taskTitle').focus();
}

function saveTask() {
    var myRole = currentUser ? currentUser.role : 'Staff';
    if (myRole === 'Executive' || myRole === 'DeptExecutive') {
        showToast('Akses ditolak. Role Anda Read-Only.', 'error');
        return;
    }

    var id    = document.getElementById('taskId').value || genId('tk');
    var type  = document.querySelector('input[name="taskType"]:checked').value;
    var title = document.getElementById('taskTitle').value.trim();
    if (!title) { showToast('Judul wajib diisi!', 'error'); return; }

    var old        = tasks.find(function(x) { return x.id == id; }) || {};
    
    // RBAC: Staff tidak boleh mengedit tugas orang lain
    if (old.uid && old.uid !== currentUser.uid && !['SuperAdmin', 'Supervisor', 'Direktur'].includes(myRole)) {
        showToast('Akses ditolak. Anda tidak bisa mengedit tugas karyawan lain.', 'error');
        return;
    }

    var st         = document.getElementById('taskStatus').value;
    var startDateVal = document.getElementById('taskStart').value;

    // Auto-fill start date when moved to In Progress
    if (st === 'In Progress' && !startDateVal && !old.isRoutine) {
        startDateVal = getLocalISODate();
    }

    // startTime & endTime
    var startTimeEl = document.getElementById('taskStartTime');
    var endTimeEl   = document.getElementById('taskEndTime');
    var startTime   = startTimeEl ? startTimeEl.value : (old.startTime || '');
    var endTime     = endTimeEl   ? endTimeEl.value   : (old.endTime   || '');

    var finalHours = parseFloat(document.getElementById('taskHours').value) || 0;
    if (startTime && endTime) {
        var p1 = startTime.split(':');
        var p2 = endTime.split(':');
        if (p1.length === 2 && p2.length === 2) {
            var sMins = parseInt(p1[0]) * 60 + parseInt(p1[1]);
            var eMins = parseInt(p2[0]) * 60 + parseInt(p2[1]);
            if (eMins > sMins) {
                finalHours = eMins - sMins;
            } else if (eMins < sMins) {
                finalHours = (eMins + 24 * 60) - sMins; // cross midnight
            }
        }
    }

    var data = {
        id:          id,
        type:        type,
        title:       title,
        project:     type === 'meeting' ? 'Internal' : (document.getElementById('taskProject').value || 'Umum'),
        priority:    document.getElementById('taskPriority').value,
        startDate:   startDateVal,
        dueDate:     type === 'meeting' ? startDateVal : document.getElementById('taskDue').value,
        endDate:     document.getElementById('taskEnd').value,
        hours:       finalHours,
        startTime:   startTime,
        endTime:     endTime,
        status:      st,
        link:        document.getElementById('taskLink').value,
        desc:        autoLinkify(document.getElementById('taskDesc').innerHTML),
        isRoutine:   old.isRoutine   || false,
        routineType: old.routineType || '',
        uid:         old.uid         || (currentUser ? currentUser.uid : ''),
        department:  old.department  || (currentUser ? currentUser.department : '')
    };

    // Handle Delegation (Validasi Backend JS)
    var assigneeSel = document.getElementById('taskAssignee');
    var isSpvPlusAction = ['SuperAdmin', 'Supervisor', 'Direktur'].includes(myRole);
    if (isSpvPlusAction && assigneeSel && !assigneeSel.closest('#divAssignee').classList.contains('hidden')) {
        if (type === 'meeting') {
            // Meeting (Multiple) via Checkboxes
            var selectedUids = Array.from(document.querySelectorAll('input[name="meetingParticipants"]:checked')).map(chk => chk.value);
            if (selectedUids.length > 0) {
                data.participants = {};
                // Include creator automatically
                data.participants[currentUser.uid] = true;
                selectedUids.forEach(u => data.participants[u] = true);
                
                // Jika uid utama bukan creator (misal direassign), bisa diset. Tapi defaultnya meeting owner = creator
                // data.uid tetap creator
            } else {
                // Pribadi
                data.participants = {};
                data.participants[currentUser.uid] = true;
            }
        } else if (assigneeSel.value) {
            // Task Biasa (Single)
            data.uid = assigneeSel.value;
            data.department = allUsers[data.uid] ? allUsers[data.uid].department : data.department;
            if (data.uid !== currentUser.uid) {
                data.delegatedBy = old.delegatedBy || currentUser.uid;
            } else {
                data.delegatedBy = null;
            }
        }
    } else if (type === 'meeting' && !isSpvPlusAction) {
        // Staff normal membuat meeting
        if (assigneeSel && !assigneeSel.closest('#divAssignee').classList.contains('hidden')) {
            var selectedUids = Array.from(document.querySelectorAll('input[name="meetingParticipants"]:checked')).map(chk => chk.value);
            data.participants = {};
            data.participants[currentUser.uid] = true;
            selectedUids.forEach(u => data.participants[u] = true);
        } else {
            data.participants = {};
            data.participants[currentUser.uid] = true;
        }
    }

    // ── FIX: Real Completion Date ──────────────────────────────
    if (data.status === 'Done' && !data.endDate) {
        if (type === 'meeting') {
            // Meeting: gunakan tanggal meeting (dueDate) bukan hari ini
            data.endDate = data.dueDate || getLocalISODate();
        } else {
            // Task: gunakan hari ini
            data.endDate = getLocalISODate();
        }
    }

    db.ref('tasks/' + id).update(data);
    
    // Create Inbox Notification if Delegation (Termasuk Task Baru atau Oper Task Lama)
    if (data.uid !== currentUser.uid && data.uid !== old.uid) {
        db.ref('inbox/' + data.uid).push({
            type: 'delegation',
            taskId: id,
            title: title,
            from: currentUser.uid,
            fromName: currentUser.name || currentUser.email,
            date: getLocalISODate(),
            read: false
        });
    }

    var logAction = old.id ? 'Diperbarui' : 'Dibuat';
    if (old.status && old.status !== data.status && data.status === 'Done') logAction = 'Selesai';
    pushLog(logAction, data.title, id);

    closeModal('taskModal');
}

function postTaskComment() {
    var myRole = currentUser ? currentUser.role : 'Staff';
    if (myRole === 'Executive' || myRole === 'DeptExecutive') return;

    var id = document.getElementById('taskId').value;
    if (!id) return;
    var input = document.getElementById('newTaskComment');
    if (!input) return;
    var text  = input.value.trim();
    if (!text) return;
    
    db.ref('comments/' + id).push({
        uid: currentUser.uid,
        name: currentUser.name || currentUser.email,
        text: text,
        timestamp: firebase.database.ServerValue.TIMESTAMP
    });
    
    // Create Inbox Notification for Assignee
    var task = tasks.find(function(t) { return t.id === id; });
    if (task && task.uid && task.uid !== currentUser.uid) {
        db.ref('inbox/' + task.uid).push({
            type: 'comment',
            taskId: id,
            title: task.title,
            from: currentUser.uid,
            fromName: currentUser.name || currentUser.email,
            date: getLocalISODate(),
            read: false
        });
    }

    input.value = '';
}

function renderTaskComments(id) {
    var cList = document.getElementById('taskCommentsList');
    if (!cList) return;
    cList.innerHTML = '<p class="text-gray-500 italic text-[10px] text-center">Memuat komentar...</p>';
    
    db.ref('comments/' + id).on('value', function(snap) {
        if (!snap.exists()) {
            cList.innerHTML = '<p class="text-gray-500 italic text-[10px] text-center">Belum ada diskusi.</p>';
            return;
        }
        var html = '';
        snap.forEach(function(child) {
            var c = child.val();
            var d = new Date(c.timestamp);
            var isMe = c.uid === currentUser.uid;
            var timeStr = isNaN(d) ? '' : d.getHours().toString().padStart(2, '0') + ':' + d.getMinutes().toString().padStart(2, '0');
            var align = isMe ? 'text-right' : 'text-left';
            var bg    = isMe ? 'bg-blue-900/40 border border-blue-500/30' : 'bg-[#2a2a2a] border border-[#3f3f3f]';
            html += '<div class="mb-2 ' + align + '">' +
                    '<div class="inline-block px-3 py-2 rounded-lg text-[11px] ' + bg + ' max-w-[85%] text-left">' +
                    '<p class="font-bold text-[9px] ' + (isMe ? 'text-blue-300' : 'text-gray-400') + ' mb-0.5">' + (isMe ? 'Saya' : c.name) + ' &bull; ' + timeStr + '</p>' +
                    '<p class="text-white whitespace-pre-wrap break-words">' + c.text + '</p>' +
                    '</div></div>';
        });
        cList.innerHTML = html;
        cList.scrollTop = cList.scrollHeight;
    });
}

function renderInbox() {
    var cBadge = document.getElementById('inboxCount');
    var cList  = document.getElementById('inboxList');
    if (!cList) return;
    
    var unread = inbox.filter(function(x) { return !x.read; });
    
    if (cBadge) {
        if (unread.length > 0) {
            cBadge.innerText = unread.length;
            cBadge.classList.remove('hidden');
        } else {
            cBadge.classList.add('hidden');
        }
    }
    
    if (inbox.length === 0) {
        cList.innerHTML = '<p class="text-center text-gray-500 italic text-xs py-10">Tidak ada notifikasi.</p>';
        return;
    }
    
    // Urutkan terbaru di atas
    var sorted = inbox.slice().sort(function(a,b) { return (b.date||'').localeCompare(a.date||''); });
    
    cList.innerHTML = sorted.map(function(item) {
        var bg = item.read ? 'bg-[#1a1a1a] opacity-60' : 'bg-[#2a2a2a] border border-[#3f3f3f]';
        var dot = item.read ? '' : '<div class="w-2 h-2 rounded-full bg-red-500 absolute top-3 right-3"></div>';
        
        var actionText = 'menugaskan Anda';
        if (item.type === 'comment') {
            actionText = 'mengomentari tugas Anda';
        }

        return '<div onclick="readInbox(\'' + item.id + '\', \'' + item.taskId + '\')" class="relative p-3 rounded-xl cursor-pointer hover:border-violet-500 transition ' + bg + '">' +
               dot +
               '<p class="text-xs font-bold text-white mb-1">' + (item.fromName || 'Sistem') + ' ' + actionText + '</p>' +
               '<p class="text-[10px] text-gray-400 truncate max-w-[90%]">' + (item.title || 'Tugas Baru') + '</p>' +
               '<p class="text-[9px] text-gray-500 mt-2">' + (item.date || '') + '</p>' +
               '</div>';
    }).join('');
}

function readInbox(inboxId, taskId) {
    // Tandai sudah dibaca
    if (currentUser) {
        db.ref('inbox/' + currentUser.uid + '/' + inboxId).update({ read: true });
    }
    document.getElementById('inboxModal').classList.add('hidden');
    // Buka task
    if (taskId && typeof openTaskModal === 'function') {
        openTaskModal(taskId);
    }
}


// ── INTERNAL MESSAGING — WA-Style Threading ──────────────────
// State untuk thread yang sedang aktif
window._activeChatPartner = null;

// Fungsi utama: tampilkan DAFTAR KONTAK (mirip WA — list percakapan)
function renderMessages() {
    var cList = document.getElementById('messageList');
    if (!cList) return;

    // Jika ada thread yang sedang aktif, tampilkan thread
    if (window._activeChatPartner) {
        renderMessageThread(window._activeChatPartner);
        return;
    }

    // Kumpulkan semua partner unik dari allMessages
    var partners = {};
    allMessages.forEach(function(m) {
        if (!m || !m.toUid || !m.fromUid || m.toUid === 'undefined' || m.fromUid === 'undefined') return;

        // Tentukan siapa lawan bicara kita
        var partnerUid = (m.fromUid === currentUser.uid) ? m.toUid : m.fromUid;
        if (!partnerUid || partnerUid === 'undefined') return;
        if (!partners[partnerUid] || (m.timestamp || 0) > (partners[partnerUid].lastTimestamp || 0)) {
            partners[partnerUid] = {
                uid: partnerUid,
                lastMessage: m.message,
                lastTimestamp: m.timestamp || 0,
                unreadCount: 0
            };
        }
        // Hitung unread: hanya pesan yang MASUK ke saya dan belum dibaca
        if (m.toUid === currentUser.uid && !m.read) {
            partners[partnerUid].unreadCount = (partners[partnerUid].unreadCount || 0) + 1;
        }
    });

    var partnerList = Object.values(partners).sort(function(a,b) {
        return (b.lastTimestamp || 0) - (a.lastTimestamp || 0);
    });

    if (partnerList.length === 0) {
        cList.innerHTML = '<p class="text-center text-gray-500 italic text-xs py-10"><i class="fa-solid fa-comments mr-2"></i>Belum ada percakapan.<br><span class="text-[10px]">Klik "Tulis" untuk memulai.</span></p>';
        return;
    }

    cList.innerHTML = partnerList.map(function(p) {
        var user = allUsers[p.uid] || {};
        var name = user.name || user.email || p.uid || 'Unknown';
        var dept = user.department ? ' · ' + user.department : '';
        var role = user.role || 'Staff';
        var d = new Date(p.lastTimestamp);
        var timeStr = isNaN(d) ? '' : d.toLocaleDateString('id-ID', {day:'numeric', month:'short'}) + ' ' +
            d.getHours().toString().padStart(2,'0') + ':' + d.getMinutes().toString().padStart(2,'0');
        var unreadBadge = p.unreadCount > 0
            ? '<span class="bg-emerald-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center">' + p.unreadCount + '</span>'
            : '';
        var initials = name.split(' ').map(function(w){return w[0]||'';}).join('').toUpperCase().slice(0,2);
        // Color avatar based on role
        var avatarColor = role === 'SuperAdmin' ? 'bg-pink-900/60 text-pink-300' :
                          role === 'Direktur'   ? 'bg-amber-900/60 text-amber-300' :
                          role === 'Supervisor' ? 'bg-violet-900/60 text-violet-300' :
                          role === 'Executive'  ? 'bg-blue-900/60 text-blue-300' : 'bg-gray-800 text-gray-300';
        return '<div onclick="openMessageThread(\'' + p.uid + '\')" class="flex items-center gap-3 p-3 rounded-xl cursor-pointer hover:bg-[#252525] transition border border-transparent hover:border-[#3f3f3f] mb-1">' +
            '<div class="w-9 h-9 rounded-full flex-shrink-0 flex items-center justify-center font-bold text-xs ' + avatarColor + '">' + initials + '</div>' +
            '<div class="flex-1 min-w-0">' +
                '<div class="flex justify-between items-center">' +
                    '<span class="text-xs font-bold text-gray-200 truncate">' + name + '</span>' +
                    unreadBadge +
                '</div>' +
                '<div class="flex justify-between items-center">' +
                    '<span class="text-[10px] text-gray-500 truncate pr-2">' + (p.lastMessage || '').slice(0,40) + (p.lastMessage && p.lastMessage.length > 40 ? '...' : '') + '</span>' +
                    '<span class="text-[9px] text-gray-600 shrink-0">' + timeStr + '</span>' +
                '</div>' +
                '<span class="text-[9px] text-gray-600">' + role + dept + '</span>' +
            '</div>' +
        '</div>';
    }).join('');
}

// Buka thread percakapan dengan satu partner (WA-style bubble)
function openMessageThread(partnerUid) {
    window._activeChatPartner = partnerUid;
    var cList = document.getElementById('messageList');
    if (!cList) return;

    // Tandai semua pesan masuk dari partner ini sebagai sudah dibaca
    allMessages.forEach(function(m) {
        if (m && m.fromUid === partnerUid && m.toUid === currentUser.uid && !m.read) {
            db.ref('shared_notes/' + m.id).update({ read: true });
        }
    });

    renderMessageThread(partnerUid);
}

function renderMessageThread(partnerUid) {
    var cList = document.getElementById('messageList');
    if (!cList) return;
    var partner = allUsers[partnerUid] || {};
    var partnerName = partner.name || partner.email;
    if (!partnerName || partnerName === 'undefined') {
        partnerName = (partnerUid !== 'undefined' ? partnerUid : 'Unknown');
    }
    var partnerRole = partner.role || 'Staff';

    // Filter pesan antara saya dan partner ini
    var thread = allMessages.filter(function(m) {
        if (!m) return false;
        return (m.fromUid === currentUser.uid && m.toUid === partnerUid) ||
               (m.fromUid === partnerUid && m.toUid === currentUser.uid);
    }).sort(function(a,b) { return (a.timestamp || 0) - (b.timestamp || 0); });

    var bubbles = thread.map(function(m) {
        var isMe = (m.fromUid === currentUser.uid);
        var d = new Date(m.timestamp || Date.now());
        var timeStr = d.getHours().toString().padStart(2,'0') + ':' + d.getMinutes().toString().padStart(2,'0');
        var dateStr = d.toLocaleDateString('id-ID', {day:'numeric', month:'short'});
        var msgContent = m.message ? m.message.replace(/\n/g, '<br>') : '';
        if (m.attachment) {
            var attHtml = '<div class="mt-1 p-1.5 bg-black/20 rounded-lg flex items-center gap-2"><i class="fa-solid fa-file text-lg text-emerald-400"></i><a href="'+m.attachment.url+'" target="_blank" class="text-[10px] text-blue-300 hover:underline truncate max-w-[150px]" title="'+m.attachment.name+'">Lampiran: '+m.attachment.name+'</a></div>';
            msgContent = msgContent ? (msgContent + '<br>' + attHtml) : attHtml;
        }

        if (isMe) {
            return '<div class="flex justify-end mb-2">' +
                '<div class="max-w-[80%]">' +
                '<div class="bg-violet-700 text-white text-xs px-3 py-2 rounded-2xl rounded-br-sm shadow">' +
                    msgContent +
                '</div>' +
                '<div class="text-[9px] text-gray-500 text-right mt-0.5">' + timeStr + ' · ' + dateStr + (m.read ? ' ✓✓' : '') + '</div>' +
                '</div></div>';
        } else {
            return '<div class="flex justify-start mb-2">' +
                '<div class="max-w-[80%]">' +
                '<div class="bg-[#2a2a2a] border border-[#3f3f3f] text-gray-200 text-xs px-3 py-2 rounded-2xl rounded-bl-sm shadow">' +
                    msgContent +
                '</div>' +
                '<div class="text-[9px] text-gray-500 mt-0.5">' + timeStr + ' · ' + dateStr + '</div>' +
                '</div></div>';
        }
    }).join('');

    cList.innerHTML =
        '<div class="flex items-center gap-2 p-2 border-b border-[#2f2f2f] mb-2 sticky top-0 bg-[#1a1a1a] z-10">' +
            '<button onclick="window._activeChatPartner=null; renderMessages();" class="text-gray-400 hover:text-white transition p-1">' +
                '<i class="fa-solid fa-arrow-left text-xs"></i>' +
            '</button>' +
            '<div class="font-bold text-sm text-white">' + partnerName + '</div>' +
            '<div class="text-[10px] text-gray-500">' + partnerRole + '</div>' +
        '</div>' +
        '<div id="threadBubbles" class="flex flex-col px-2 pb-16 overflow-y-auto max-h-[50vh]">' +
            (bubbles || '<p class="text-center text-gray-600 italic text-xs py-6">Mulai percakapan...</p>') +
        '</div>' +
        '<div class="absolute bottom-0 left-0 right-0 p-2 bg-[#1a1a1a] border-t border-[#2f2f2f]">' +
            '<div class="flex gap-2 items-end">' +
                '<label class="cursor-pointer text-gray-500 hover:text-emerald-400 transition self-center px-1" title="Lampiran">' +
                    '<i class="fa-solid fa-paperclip"></i>' +
                    '<input type="file" id="japriFileInput" class="hidden" onchange="uploadJapriAttachment(\'' + partnerUid + '\')">' +
                '</label>' +
                '<textarea id="threadMessageInput" rows="1" class="flex-1 input-bg rounded-xl px-3 py-2 text-xs resize-none border border-[#3f3f3f] focus:border-emerald-500 focus:outline-none" placeholder="Ketik pesan..." ' +
                    'onkeydown="if(event.key===\'Enter\'&&!event.shiftKey){event.preventDefault();sendThreadMessage(\'' + partnerUid + '\');}"></textarea>' +
                '<button onclick="sendThreadMessage(\'' + partnerUid + '\')" class="bg-emerald-600 hover:bg-emerald-500 text-white px-3 py-2 rounded-xl transition text-xs font-bold shrink-0 h-[34px]">' +
                    '<i class="fa-solid fa-paper-plane"></i>' +
                '</button>' +
            '</div>' +
        '</div>';

    // Auto-scroll ke bawah
    var bubbleEl = document.getElementById('threadBubbles');
    if (bubbleEl) setTimeout(function() { bubbleEl.scrollTop = bubbleEl.scrollHeight; }, 50);
}

// Kirim pesan dari dalam thread
function sendThreadMessage(toUid) {
    var input = document.getElementById('threadMessageInput');
    if (!input) return;
    var msg = input.value.trim();
    if (!msg) return;

    var ref = db.ref('shared_notes').push();
    ref.set({
        id: ref.key,
        toUid: toUid,
        fromUid: currentUser.uid,
        message: msg,
        read: false,
        timestamp: firebase.database.ServerValue.TIMESTAMP
    }).then(function() {
        input.value = '';
        // Thread akan otomatis refresh via _mergeAndUpdateMessages listener
    }).catch(function(e) { showToast('Gagal: ' + e.message, 'error'); });
}

function uploadJapriAttachment(partnerUid) {
    var fi = document.getElementById('japriFileInput');
    if (!fi || !fi.files[0]) return;
    var file = fi.files[0];
    var formData = new FormData();
    formData.append('file', file);
    showToast('Mengunggah lampiran...', 'info');

    fetch('api/upload.php', {
        method: 'POST',
        body: formData
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        if (data.success) {
            var ref = db.ref('messages').push();
            return ref.set({
                id: ref.key,
                toUid: partnerUid,
                fromUid: currentUser.uid,
                message: '',
                attachment: { url: data.url, name: data.name, type: data.type },
                read: false,
                timestamp: firebase.database.ServerValue.TIMESTAMP
            }).then(function() {
                showToast('Lampiran berhasil dikirim!', 'success');
            });
        } else {
            showToast('Gagal: ' + data.message, 'error');
        }
    })
    .catch(function(e) {
        showToast('Gagal mengunggah: ' + e.message, 'error');
    })
    .finally(function() {
        fi.value = '';
    });
}

function switchMessageTab(tab) {
    var btnJapri = document.getElementById('tabJapri');
    var btnGrup  = document.getElementById('tabGrup');
    var listJapri= document.getElementById('messageList');
    var listGrup = document.getElementById('grupChatContainer');
    var btnTulis = document.getElementById('btnComposeJapri');
    var formJapri= document.getElementById('composeMessageForm');

    if (tab === 'japri') {
        btnJapri.className = 'flex-1 py-2.5 text-xs font-bold text-center border-b-2 border-emerald-500 text-emerald-400';
        btnGrup.className  = 'flex-1 py-2.5 text-xs font-bold text-center border-b-2 border-transparent text-gray-500 hover:text-white';
        listJapri.classList.remove('hidden');
        listJapri.classList.add('block');
        listGrup.classList.add('hidden');
        listGrup.classList.remove('flex');
        btnTulis.classList.remove('hidden');
    } else {
        btnGrup.className  = 'flex-1 py-2.5 text-xs font-bold text-center border-b-2 border-emerald-500 text-emerald-400';
        btnJapri.className = 'flex-1 py-2.5 text-xs font-bold text-center border-b-2 border-transparent text-gray-500 hover:text-white';
        listJapri.classList.add('hidden');
        listJapri.classList.remove('block');
        listGrup.classList.remove('hidden');
        listGrup.classList.add('flex');
        btnTulis.classList.add('hidden');
        if (formJapri) formJapri.classList.add('hidden');
        
        // Render group chat if not rendered
        if (typeof renderGroupChatView === 'function') {
            renderGroupChatView(document.getElementById('grupChatContainer'));
        }
    }
}

function toggleComposeMessage() {
    var form = document.getElementById('composeMessageForm');
    if (form) {
        form.classList.toggle('hidden');
        if (!form.classList.contains('hidden')) {
            window._activeChatPartner = null;
            populateMessageRecipients();
            document.getElementById('messageRecipient').focus();
        }
    }
}

function populateMessageRecipients() {
    var sel = document.getElementById('messageRecipient');
    if (!sel || !currentUser) return;

    while (sel.options.length > 1) { sel.remove(1); }

    var myRole = currentUser.role || 'Staff';
    var myDept = currentUser.department || '';
    var watchDept = currentUser.watchDepartment || '';

    var usersArr = Object.keys(allUsers).map(function(k) {
        var u = Object.assign({}, allUsers[k]); // clone to avoid mutating state directly
        u.uid = k;
        return u;
    }).sort(function(a,b) {
        return (a.name||'').localeCompare(b.name||'');
    });

    usersArr.forEach(function(u) {
        if (!u.uid || u.uid === 'undefined' || u.uid === currentUser.uid) return;

        var allow = false;
        if (myRole === 'SuperAdmin' || myRole === 'Direktur' || myRole === 'Executive') {
            allow = true;
        } else if (u.role === 'SuperAdmin') {
            // Semua bisa chat dengan SuperAdmin
            allow = true;
        } else if (myRole === 'DeptExecutive') {
            if (u.department === watchDept) allow = true;
        } else {
            // Staff / Supervisor → divisi yang sama
            if (u.department === myDept) allow = true;
        }

        if (allow) {
            var opt = document.createElement('option');
            opt.value = u.uid;
            opt.textContent = (u.name || u.email || u.uid || 'Unknown') + ' (' + (u.department || '?') + ') - ' + (u.role || 'Staff');
            sel.appendChild(opt);
        }
    });
}

function sendInternalMessage() {
    var toUid = document.getElementById('messageRecipient').value;
    var msg   = document.getElementById('messageContent').value.trim();

    if (!toUid) { showToast('Pilih penerima pesan!', 'error'); return; }
    if (!msg)   { showToast('Pesan tidak boleh kosong!', 'error'); return; }

    var ref = db.ref('shared_notes').push();
    ref.set({
        id: ref.key,
        toUid: toUid,
        fromUid: currentUser.uid,
        message: msg,
        read: false,
        timestamp: firebase.database.ServerValue.TIMESTAMP
    }).then(function() {
        showToast('Pesan terkirim!', 'success');
        document.getElementById('messageContent').value = '';
        // Tutup form compose, buka thread dengan partner baru
        var form = document.getElementById('composeMessageForm');
        if (form) form.classList.add('hidden');
        window._activeChatPartner = toUid;
        renderMessages();
    }).catch(function(e) {
        showToast('Gagal mengirim pesan: ' + e.message, 'error');
    });
}

function quickDone(id) {
    var myRole = currentUser ? currentUser.role : 'Staff';
    if (myRole === 'Executive' || myRole === 'DeptExecutive') return;

    var t = tasks.find(function(x) { return x.id === id; });
    if (!t) return;

    // FIX: Meeting → endDate = dueDate; Task → endDate = TODAY
    var endDateVal = (t.type === 'meeting')
        ? (t.dueDate || getLocalISODate())
        : getLocalISODate();

    db.ref('tasks/' + id).update({ status: 'Done', endDate: endDateVal });
    pushLog('Selesai', t.title || 'Tanpa Judul', id);
    showToast('Ditandai Selesai! ✅', 'success');
}

function deleteTask() {
    var myRole = currentUser ? currentUser.role : 'Staff';
    if (myRole === 'Executive' || myRole === 'DeptExecutive') return;

    if (confirm('Hapus data ini secara permanen dari server?')) {
        var id = document.getElementById('taskId').value;
        var t  = tasks.find(function(x) { return x.id === id; });
        
        if (t && t.uid !== currentUser.uid && !['SuperAdmin', 'Supervisor', 'Direktur'].includes(myRole)) {
            showToast('Akses ditolak.', 'error');
            return;
        }
        
        db.ref('tasks/' + id).remove();
        pushLog('Dihapus', t ? t.title : 'Tanpa Judul', id);
        closeModal('taskModal');
        showToast('Tugas dihapus.', 'info');
    }
}

function duplicateTask() {
    document.getElementById('taskId').value = '';
    document.getElementById('btnDelete').classList.add('hidden');
    document.getElementById('btnDuplicate').classList.add('hidden');
    showToast('Mode Duplikat Aktif! Edit lalu klik SIMPAN.', 'info');
}

function updateProjectDatalist() {
    var standard = ['Internal'];
    var myTasks  = tasks.filter(function(t) { return t.uid === currentUser.uid; });
    var existing = [].concat.apply([], [myTasks.map(function(t) { return t.project; })])
        .filter(function(p) { return p && p !== 'Internal' && p !== 'Rutin' && p !== 'Umum'; });
    var all      = [];
    var seen     = {};
    [].concat(standard, existing).forEach(function(p) {
        if (p && !seen[p]) { seen[p] = true; all.push(p); }
    });
    var datalist = document.getElementById('projectOptions');
    if (datalist) datalist.innerHTML = all.map(function(p) { return '<option value="' + p + '">'; }).join('');
}

// ── Routine Modal ─────────────────────────────────────────────

function toggleRoutineDay() {
    var type    = document.getElementById('routineType').value;
    var box     = document.getElementById('routineDayBox');
    var daySel  = document.getElementById('routineDay');
    var dateSel = document.getElementById('routineDate');
    box.className = (type === 'weekly' || type === 'monthly') ? 'flex gap-2' : 'hidden';
    if (daySel)  daySel.classList.toggle('hidden',  type !== 'weekly');
    if (dateSel) dateSel.classList.toggle('hidden', type !== 'monthly');
}


function openRoutineModal(type) {
    document.getElementById('routineModal').classList.remove('hidden');
    document.getElementById('routineId').value    = '';
    document.getElementById('routineType').value  = type || 'daily';
    document.getElementById('routineTitle').value = '';
    document.getElementById('routineTag').value   = '';
    document.getElementById('routineStartTime').value = '';
    document.getElementById('routineEndTime').value = '';
    document.getElementById('routineHours').value = 30;
    document.getElementById('routineLink').value  = '';
    document.getElementById('routineDesc').value  = '';
    document.getElementById('btnDelRoutine').classList.add('hidden');
    
    _populateRoutineAssignee('');
    toggleRoutineDay();
}

function _populateRoutineAssignee(currentAssigneeUid) {
    var divAssignee = document.getElementById('divRoutineAssignee');
    var assigneeSel = document.getElementById('routineAssignee');
    if (!assigneeSel || !divAssignee) return;
    
    var isSpvPlus = currentUser && ['SuperAdmin', 'Supervisor', 'Direktur'].includes(currentUser.role);
    if (!isSpvPlus) {
        divAssignee.classList.add('hidden');
        return;
    }
    
    divAssignee.classList.remove('hidden');
    var opts = '<option value="">Untuk Saya Sendiri</option>';
    
    var myRole = currentUser ? currentUser.role : '';
    var myDept = currentUser ? currentUser.department : '';
    var canSeeAll = (myRole === 'SuperAdmin' || myRole === 'Executive' || myDept === 'IT' || myRole === 'Direktur');
    
    Object.keys(allUsers).forEach(function(uid) {
        var u = allUsers[uid];
        if (u.isActive === false || uid === currentUser.uid) return;
        var canSee = false;
        if (canSeeAll) canSee = true;
        else if (myRole === 'Supervisor' || myRole === 'DeptExecutive' || myRole === 'Staff') {
            canSee = (u.department === myDept);
        }
        if (canSee) {
            opts += '<option value="' + uid + '">' + (u.name || u.email) + ' (' + (u.department||'-') + ')</option>';
        }
    });
    assigneeSel.innerHTML = opts;
    if (currentAssigneeUid && currentAssigneeUid !== currentUser.uid) {
        assigneeSel.value = currentAssigneeUid;
    }
}

function saveRoutine() {
    var type = document.getElementById('routineType').value;
    var id   = document.getElementById('routineId').value || genId('rtn');
    var obj  = {
        id:    id,
        title: document.getElementById('routineTitle').value,
        tag:   document.getElementById('routineTag').value,
        startTime: document.getElementById('routineStartTime').value,
        endTime: document.getElementById('routineEndTime').value,
        hours: document.getElementById('routineHours').value,
        link:  document.getElementById('routineLink').value,
        desc:  document.getElementById('routineDesc').value
    };
    if (type === 'weekly')  obj.day  = document.getElementById('routineDay').value;
    if (type === 'monthly') obj.date = document.getElementById('routineDate').value || 1;

    var myRole = currentUser ? currentUser.role : 'Staff';
    if (myRole === 'Executive' || myRole === 'DeptExecutive') return;

    var myUid = currentUser ? currentUser.uid : null;
    if (!myUid) { showToast('Harus login untuk menyimpan rutinitas.', 'error'); return; }

    var assigneeSel = document.getElementById('routineAssignee');
    var isSpvPlusAction = ['SuperAdmin', 'Supervisor', 'Direktur'].includes(myRole);
    var targetUid = (isSpvPlusAction && assigneeSel && !assigneeSel.closest('#divRoutineAssignee').classList.contains('hidden') && assigneeSel.value) ? assigneeSel.value : myUid;

    if (targetUid === myUid) {
        // Save to my own routines
        Object.keys(routines).forEach(function(k) {
            routines[k] = routines[k].filter(function(x) { return x.id != id; });
        });
        routines[type].push(obj);
        db.ref('routines/' + myUid).set(routines);
        closeModal('routineModal');
        showToast('Rutinitas disimpan!', 'success');
        
        // Pemicu real-time agar rutinitas ini langsung spawn hari ini (jika jadwal cocok)
        var storageKey = 'lastRoutine_sma_v9_' + myUid;
        localStorage.removeItem(storageKey);
        if (typeof checkRoutines === 'function') checkRoutines();
    } else {
        // Delegate to target user
        db.ref('routines/' + targetUid).once('value').then(function(snap) {
            var targetRoutines = snap.val() || { daily: [], weekly: [], monthly: [] };
            if (!targetRoutines.daily) targetRoutines.daily = [];
            if (!targetRoutines.weekly) targetRoutines.weekly = [];
            if (!targetRoutines.monthly) targetRoutines.monthly = [];
            
            // Remove if existing in target
            Object.keys(targetRoutines).forEach(function(k) {
                targetRoutines[k] = targetRoutines[k].filter(function(x) { return x.id != id; });
            });
            
            // Tambahkan metadata delegasi
            var delegatedObj = Object.assign({}, obj);
            delegatedObj.delegatedBy = myUid;
            delegatedObj.delegatedByName = currentUser.name || currentUser.email || myUid;
            
            targetRoutines[type].push(delegatedObj);
            
            db.ref('routines/' + targetUid).set(targetRoutines).then(function() {
                // Remove from my own if I'm passing it away
                var removedFromMe = false;
                Object.keys(routines).forEach(function(k) {
                    var initialLen = routines[k].length;
                    routines[k] = routines[k].filter(function(x) { return x.id != id; });
                    if (routines[k].length < initialLen) removedFromMe = true;
                });
                if (removedFromMe) db.ref('routines/' + myUid).set(routines);

                // Notify target user
                db.ref('inbox/' + targetUid).push({
                    type: 'delegation_routine',
                    taskId: id,
                    title: 'Rutinitas Baru: ' + obj.title,
                    from: myUid,
                    fromName: currentUser.name || currentUser.email,
                    date: getLocalISODate(),
                    read: false
                });

                closeModal('routineModal');
                showToast('Rutinitas disimpan/didelegasikan!', 'success');
                if (typeof loadStaffRoutines === 'function' && !document.getElementById('staffRoutineModal').classList.contains('hidden')) {
                    loadStaffRoutines(targetUid);
                }
            });
        });
    }
}

function editRoutine(type, id) {
    var r = routines[type].find(function(x) { return x.id == id; });
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
    
    _populateRoutineAssignee(currentUser ? currentUser.uid : '');
    toggleRoutineDay();
}

function deleteRoutine() {
    var myRole = currentUser ? currentUser.role : 'Staff';
    if (myRole === 'Executive' || myRole === 'DeptExecutive') return;
    
    if (!confirm('Hapus rutinitas ini secara permanen?')) return;

    var id  = document.getElementById('routineId').value;
    var uid = currentUser ? currentUser.uid : null;
    var assigneeSel = document.getElementById('routineAssignee');
    var isSpvPlusAction = ['SuperAdmin', 'Supervisor', 'Direktur'].includes(myRole);
    var targetUid = (isSpvPlusAction && assigneeSel && !assigneeSel.closest('#divRoutineAssignee').classList.contains('hidden') && assigneeSel.value) ? assigneeSel.value : uid;

    if (targetUid === uid) {
        Object.keys(routines).forEach(function(k) {
            routines[k] = routines[k].filter(function(x) { return x.id != id; });
        });
        if (uid) db.ref('routines/' + uid).set(routines);
        closeModal('routineModal');
        showToast('Rutinitas dihapus.', 'info');
    } else {
        db.ref('routines/' + targetUid).once('value').then(function(snap) {
            var targetRoutines = snap.val() || { daily: [], weekly: [], monthly: [] };
            Object.keys(targetRoutines).forEach(function(k) {
                if (targetRoutines[k]) targetRoutines[k] = targetRoutines[k].filter(function(x) { return x.id != id; });
            });
            db.ref('routines/' + targetUid).set(targetRoutines).then(function() {
                closeModal('routineModal');
                showToast('Rutinitas dihapus dari staf.', 'info');
                if (typeof loadStaffRoutines === 'function' && !document.getElementById('staffRoutineModal').classList.contains('hidden')) {
                    loadStaffRoutines(targetUid);
                }
            });
        });
    }
}

// ── Holiday Modal ─────────────────────────────────────────────

function renderHolidays() {
    var list = document.getElementById('holidayList');
    if (!list) return;
    // Pastikan hanya string tanggal valid yang ditampilkan (filter data corrupt)
    var validHolidays = holidays.filter(function(h) {
        return typeof h === 'string' && h.match(/^\d{4}-\d{2}-\d{2}$/);
    });
    // Update state jika ada yang invalid
    if (validHolidays.length !== holidays.length) {
        holidays = validHolidays;
    }
    holidays.sort();

    var isSuperAdmin = currentUser && currentUser.role === 'SuperAdmin';
    var cleanupBtn = isSuperAdmin
        ? '<button onclick="cleanupGlobalHolidays()" class="text-[9px] text-orange-400 hover:text-orange-300 border border-orange-500/30 px-2 py-1 rounded transition"><i class="fa-solid fa-broom mr-1"></i>Hapus Data Lama Global</button>'
        : '';

    list.innerHTML = (holidays.length
        ? holidays.map(function(h) {
            return '<div class="flex justify-between items-center bg-[#252526] p-2 rounded border border-[#3f3f3f]">' +
                '<span class="text-xs text-gray-300"><i class="fa-regular fa-calendar text-red-400 mr-2"></i>' + h + '</span>' +
                '<button onclick="deleteHoliday(\'' + h + '\')" class="text-red-500 hover:text-red-300 transition">' +
                '<i class="fa-solid fa-trash text-[10px]"></i></button>' +
                '</div>';
        }).join('')
        : '<p class="text-gray-600 italic text-[10px]">Belum ada jadwal libur.</p>'
    ) + (isSuperAdmin ? '<div class="mt-3 pt-2 border-t border-[#3f3f3f]">' + cleanupBtn + '</div>' : '');
}

function addHoliday() {
    var val = document.getElementById('holidayInput').value;
    if (!val) return;
    if (!holidays.includes(val)) {
        holidays.push(val);
        // Selalu simpan ke path per-UID, bukan global
        db.ref('holidays/' + currentUser.uid).set(holidays).catch(e => {
            showToast('Gagal menyimpan hari libur: Akses ditolak', 'error');
        });
    }
    document.getElementById('holidayInput').value = '';
    renderHolidays();
}

function deleteHoliday(val) {
    if (!confirm('Hapus tanggal libur ini?')) return;
    holidays = holidays.filter(function(h) { return h !== val; });
    db.ref('holidays/' + currentUser.uid).set(holidays).catch(e => {
        showToast('Gagal menghapus libur: Akses ditolak', 'error');
    });
    renderHolidays();
}

// Hapus data libur dari path GLOBAL (tanpa UID) — untuk bersihkan data lama
function cleanupGlobalHolidays() {
    if (!confirm('Ini akan menghapus data libur dari path global (tanpa UID) yang mungkin terlihat oleh semua pengguna. Lanjutkan?')) return;
    // Hapus path /holidays langsung (bukan /holidays/{uid})
    db.ref('holidays').once('value', function(snap) {
        var val = snap.val();
        if (!val) { showToast('Tidak ada data global ditemukan.', 'info'); return; }
        // Jika /holidays adalah array langsung (format lama), hapus semua
        // Jika /holidays/{uid} sudah benar, tidak sentuh apa-apa
        var isOldFormat = Array.isArray(val) || (typeof val === 'object' && Object.values(val).some(function(v) { return typeof v === 'string'; }));
        if (isOldFormat) {
            db.ref('holidays').remove();
            showToast('Data libur global berhasil dibersihkan!', 'success');
        } else {
            showToast('Data sudah dalam format per-user. Tidak ada yang dihapus.', 'info');
        }
    });
}

// ── Generic Modal Utils ───────────────────────────────────────

function closeModal(id) {
    var el = document.getElementById(id);
    if (el) el.classList.add('hidden');
}

function handleModalClick(e) {
    if (e.target.id && e.target.id.endsWith('Modal')) closeModal(e.target.id);
}

function openExportModal() {
    document.getElementById('exportModal').classList.remove('hidden');
    var isSuperAdmin = currentUser && currentUser.role === 'SuperAdmin';
    var restoreContainer = document.getElementById('restoreJsonContainer');
    if (restoreContainer) {
        if (isSuperAdmin) restoreContainer.classList.remove('hidden');
        else restoreContainer.classList.add('hidden');
    }
}


// ── Settings Modal ─────────────────────────────────────────────

function openSettingsModal() {
    document.getElementById('settingsModal').classList.remove('hidden');
    
    var s = (currentUser && currentUser.settings) || {
        timeIn: '08:00',
        timeOut: '17:00',
        breaks: [{start: '12:00', end: '13:00'}]
    };
    
    document.getElementById('settingTimeIn').value = s.timeIn || '08:00';
    document.getElementById('settingTimeOut').value = s.timeOut || '17:00';
    
    var blist = document.getElementById('breakList');
    blist.innerHTML = '';
    var breaks = s.breaks || [];
    if(breaks.length === 0) breaks = [{start:'', end:''}];
    
    breaks.forEach(function(b) {
        _addBreakRowHtml(b.start, b.end);
    });
}

function _addBreakRowHtml(start, end) {
    var blist = document.getElementById('breakList');
    var div = document.createElement('div');
    div.className = 'flex items-center gap-2 break-row';
    div.innerHTML = 
        '<input type="time" class="flex-1 input-bg rounded p-2 text-xs break-start" value="' + (start||'') + '">' +
        '<span class="text-gray-500">-</span>' +
        '<input type="time" class="flex-1 input-bg rounded p-2 text-xs break-end" value="' + (end||'') + '">' +
        '<button onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-300 p-2"><i class="fa-solid fa-trash"></i></button>';
    blist.appendChild(div);
}

function addBreakRow() {
    _addBreakRowHtml('', '');
}

function saveSettings() {
    if (!currentUser) return;
    
    var existingWorkDays = (currentUser.settings && currentUser.settings.workDays) ? currentUser.settings.workDays : 5;
    
    var s = {
        workDays: existingWorkDays, // Keep existing setting from SuperAdmin
        timeIn: document.getElementById('settingTimeIn').value || '08:00',
        timeOut: document.getElementById('settingTimeOut').value || '17:00',
        breaks: []
    };
    
    var rows = document.querySelectorAll('.break-row');
    rows.forEach(function(row) {
        var start = row.querySelector('.break-start').value;
        var end = row.querySelector('.break-end').value;
        if(start && end) {
            s.breaks.push({start: start, end: end});
        }
    });
    
    db.ref('users/' + currentUser.uid + '/settings').set(s).then(function(){
        currentUser.settings = s;
        closeModal('settingsModal');
        showToast('Pengaturan disimpan', 'success');
        if(typeof updateGlobalStats === 'function') updateGlobalStats();
    });
}


function checkConflict() {
    var warningDiv = document.getElementById('conflictWarning');
    var warningText = document.getElementById('conflictWarningText');
    if (!warningDiv || !warningText) return;
    
    var assigneeSel = document.getElementById('taskAssignee');
    var targetUid = (assigneeSel && !assigneeSel.closest('#divAssignee').classList.contains('hidden') && assigneeSel.value) ? assigneeSel.value : (currentUser ? currentUser.uid : null);
    
    var sStart = document.getElementById('taskStartTime').value;
    var sEnd = document.getElementById('taskEndTime').value;
    
    if (!targetUid || !sStart || !sEnd) {
        warningDiv.classList.add('hidden');
        return;
    }
    
    var u = allUsers[targetUid];
    if (!u) return;
    
    var settings = u.settings || {
        breaks: [{start: '12:00', end: '13:00'}]
    };
    
    var p1 = sStart.split(':'); var p2 = sEnd.split(':');
    if(p1.length!==2 || p2.length!==2) return;
    var sMins = parseInt(p1[0])*60 + parseInt(p1[1]);
    var eMins = parseInt(p2[0])*60 + parseInt(p2[1]);
    
    var hasConflict = false;
    if (settings.breaks && settings.breaks.length > 0) {
        settings.breaks.forEach(function(b) {
            if (b.start && b.end) {
                var b1 = b.start.split(':'); var b2 = b.end.split(':');
                var bsMins = parseInt(b1[0])*60 + parseInt(b1[1]);
                var beMins = parseInt(b2[0])*60 + parseInt(b2[1]);
                
                // Overlap condition: start < breakEnd AND end > breakStart
                if (sMins < beMins && eMins > bsMins) {
                    hasConflict = true;
                }
            }
        });
    }
    
    if (hasConflict) {
        warningText.innerText = "Perhatian: Waktu ini beririsan dengan jadwal istirahat target staf (" + (u.name||'') + ").";
        warningDiv.classList.remove('hidden');
    } else {
        warningDiv.classList.add('hidden');
    }
}
