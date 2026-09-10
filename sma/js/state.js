/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/state.js — Global State & Firebase Listeners
   Load ORDER: #3 (after firebase-config.js)

   ARSITEKTUR PENTING:
   - Semua listener Firebase TIDAK berjalan di level file.
   - Listener HANYA diaktifkan via initFirebaseListeners()
   - initFirebaseListeners() dipanggil oleh auth.js SETELAH login berhasil
   - Ini mencegah race condition & stuck "Memverifikasi"
   ============================================================ */

// ============================================================
// GLOBAL STATE
// ============================================================
let tasks       = [];
let notes       = [];
let routines    = { daily: [], weekly: [], monthly: [] };
let holidays    = [];
let activityLogs = [];
let allUsers    = {};      // { uid: { name, role, department } } — dipakai Executive/SPV
let sharedNotes = [];      // Pesan masuk ke user ini (toUid = saya)
let sentMessages = [];     // Pesan yang dikirim oleh user ini (fromUid = saya)
let allMessages = [];      // Gabungan masuk + keluar untuk WA-style threading
let inbox       = [];      // Inbox delegasi

// Variables for task merging (Base Tasks + Meeting Tasks)
let _baseTasks = [];
let _meetingTasks = [];
let _meetingListener = null;

// Flag untuk mencegah rutinitas tercetak dobel saat web baru dibuka
let isTasksLoaded    = false;
let isRoutinesLoaded = false;

// Referensi listener agar bisa di-detach saat logout
let _taskListener     = null;
let _routineListener  = null;
let _noteListener     = null;
let _logListener      = null;
let _holidayListener  = null;
let _usersListener    = null;
let _sharedListener   = null;
let _outboxListener   = null;
let _inboxListener    = null;

// ============================================================
// INIT LISTENERS — Dipanggil oleh auth.js setelah login
// ============================================================
function initFirebaseListeners() {
    if (!currentUser) return;

    const uid  = currentUser.uid;
    const role = currentUser.role || 'Staff';

    // ── Detach listeners lama jika ada (untuk re-login) ──
    detachAllListeners();

    // Flags reset
    isTasksLoaded    = false;
    isRoutinesLoaded = false;

    // ── HOLIDAYS (personal per-user) ──
    const holidayRef = db.ref('holidays/' + uid);
    holidayRef.on('value', function(snap) {
        try {
            holidays = snap.val() ? Object.values(snap.val()) : [];
            var modal = document.getElementById('holidayModal');
            if (modal && !modal.classList.contains('hidden')) {
                if (typeof renderHolidays === 'function') renderHolidays();
            }
            if (typeof curView !== 'undefined' && curView === 'calendar') {
                if (typeof initCalendar === 'function') initCalendar();
            }
        } catch (e) { console.error('[state] holidays error:', e); }
    });
    _holidayListener = holidayRef;

    // ── TASKS — Filter berdasarkan role ──
    var taskRef;
    if (role === 'Executive' || role === 'SuperAdmin' || role === 'Direktur') {
        // Semua task dari semua user
        taskRef = db.ref('tasks');
    } else if (role === 'Supervisor' || role === 'DeptExecutive') {
        // Optimasi & Keamanan: Tarik berdasarkan departemen langsung dari server (mencegah kebocoran data)
        var targetDept = (role === 'Supervisor') ? currentUser.department : (currentUser.watchDepartment || currentUser.department);
        taskRef = db.ref('tasks').orderByChild('department').equalTo(targetDept);
    } else {
        // Staff: hanya task milik uid sendiri
        taskRef = db.ref('tasks').orderByChild('uid').equalTo(uid);
    }

    var mergeAndSetTasks = function() {
        var map = {};
        _baseTasks.forEach(function(t) { map[t.id] = t; });
        _meetingTasks.forEach(function(t) {
            if (role === 'Executive' || role === 'SuperAdmin' || role === 'Direktur') {
                map[t.id] = t;
            } else if (role === 'Supervisor' || role === 'DeptExecutive') {
                var targetDept = (role === 'Supervisor') ? currentUser.department : (currentUser.watchDepartment || currentUser.department);
                if (t.department === targetDept || t.uid === uid || (t.participants && t.participants[uid])) map[t.id] = t;
            } else {
                if (t.uid === uid || (t.participants && t.participants[uid])) map[t.id] = t;
            }
        });
        tasks = Object.values(map);
        
        isTasksLoaded = true;
        if (isRoutinesLoaded && typeof checkRoutines === 'function') checkRoutines();
        if (typeof curView !== 'undefined' && curView !== 'notes' && curView !== 'routines' && curView !== 'users') {
            if (typeof debouncedRefreshActiveView === 'function') debouncedRefreshActiveView();
            else if (typeof refreshActiveView === 'function') refreshActiveView();
        }
        if (typeof updateGlobalStats === 'function') updateGlobalStats();
        if (typeof updateProjectDatalist === 'function') updateProjectDatalist();
    };

    taskRef.on('value', function(snap) {
        try {
            var val = snap.val();
            _baseTasks = val ? Object.values(val).filter(function(t) { return t !== null && typeof t === 'object'; }) : [];
            mergeAndSetTasks();
        } catch (e) { console.error('[state] tasks error:', e); }
    });
    _taskListener = taskRef;

    // ── MEETINGS (GLOBAL FETCH FOR ALL) ──
    var meetingRef = db.ref('tasks').orderByChild('type').equalTo('meeting');
    meetingRef.on('value', function(snap) {
        try {
            var val = snap.val();
            _meetingTasks = val ? Object.values(val).filter(function(t) { return t !== null && typeof t === 'object'; }) : [];
            mergeAndSetTasks();
        } catch (e) { console.error('[state] meetings error:', e); }
    });
    _meetingListener = meetingRef;

    // ── ROUTINES ──
    var routineRef = db.ref('routines/' + uid);
    routineRef.on('value', function(snap) {
        try {
            var val = snap.val();
            if (val) {
                routines = {
                    daily:   val.daily   ? Object.values(val.daily).filter(function(r)   { return r !== null; }) : [],
                    weekly:  val.weekly  ? Object.values(val.weekly).filter(function(r)  { return r !== null; }) : [],
                    monthly: val.monthly ? Object.values(val.monthly).filter(function(r) { return r !== null; }) : []
                };
            } else {
                routines = { daily: [], weekly: [], monthly: [] };
            }
            isRoutinesLoaded = true;
            if (isTasksLoaded && typeof checkRoutines === 'function') {
                checkRoutines();
            }
            if (typeof curView !== 'undefined' && curView === 'routines') {
                if (typeof debouncedRefreshActiveView === 'function') {
                    debouncedRefreshActiveView();
                } else {
                    refreshActiveView();
                }
            }
        } catch (e) { console.error('[state] routines error:', e); }
    });
    _routineListener = routineRef;
    
    // ── INBOX ──
    var inboxRef = db.ref('inbox/' + uid);
    inboxRef.on('value', function(snap) {
        try {
            inbox = snap.val() ? Object.values(snap.val()) : [];
            // tambahkan id ke array objek untuk kebutuhan mark-as-read
            var rawObj = snap.val();
            if (rawObj) {
                inbox = Object.keys(rawObj).map(function(k) {
                    var it = rawObj[k];
                    it.id = k;
                    return it;
                });
            }
            if (typeof renderInbox === 'function') renderInbox();
        } catch(e) { console.error('[state] inbox error:', e); }
    });
    _inboxListener = inboxRef;

    // ── NOTES — hanya milik uid sendiri ──
    var noteRef = db.ref('notes').orderByChild('uid').equalTo(uid);
    noteRef.on('value', function(snap) {
        try {
            var val = snap.val();
            notes = val ? Object.values(val).filter(function(n) { return n !== null; }) : [];
            if (typeof curView !== 'undefined' && curView === 'notes') {
                if (typeof updateNotesListOnly === 'function') updateNotesListOnly();
            }
        } catch (e) { console.error('[state] notes error:', e); }
    });
    _noteListener = noteRef;

    // ── ACTIVITY LOGS ──
    var logRef = db.ref('logs').limitToLast(200);
    logRef.on('value', function(snap) {
        try {
            var val = snap.val();
            activityLogs = val ? Object.values(val).filter(function(l) { return l !== null; }) : [];
            if (typeof curView !== 'undefined' && curView === 'activity') {
                if (typeof renderActivityLogView === 'function') {
                    var c = document.getElementById('viewContainer');
                    if (c) renderActivityLogView(c);
                }
            }
        } catch (e) { console.error('[state] logs error:', e); }
    });
    _logListener = logRef;

    // ── ALL USERS — diload untuk semua role ──
    // Staff butuh ini untuk resolve nama delegator di Tab Delegasi
    // Firebase rules sudah allow read users/ untuk semua auth user
    var usersRef = db.ref('users');
    usersRef.on('value', function(snap) {
        try {
            var val = snap.val();
            allUsers = val || {};
        } catch (e) { console.error('[state] users error:', e); }
    });
    _usersListener = usersRef;

    // ── SHARED NOTES / MESSAGES ──
    // Listener 1: pesan MASUK (toUid = saya)
    var sharedRef = db.ref('shared_notes').orderByChild('toUid').equalTo(uid);
    sharedRef.on('value', function(snap) {
        try {
            var val = snap.val();
            sharedNotes = val ? Object.values(val).filter(function(s) { return s !== null; }) : [];
            _mergeAndUpdateMessages();
        } catch (e) { console.error('[state] shared_notes error:', e); }
    });
    _sharedListener = sharedRef;

    // Listener 2: pesan KELUAR (fromUid = saya) untuk WA-style history
    var outboxRef = db.ref('shared_notes').orderByChild('fromUid').equalTo(uid);
    outboxRef.on('value', function(snap) {
        try {
            var val = snap.val();
            sentMessages = val ? Object.values(val).filter(function(s) { return s !== null; }) : [];
            _mergeAndUpdateMessages();
        } catch (e) { console.error('[state] outbox error:', e); }
    });
    _outboxListener = outboxRef;

    // Listener 3: pesan JAPRI MASUK via node 'messages/' (model baru)
    var japriRef = db.ref('messages').orderByChild('toUid').equalTo(uid);
    japriRef.on('value', function(snap) {
        try {
            var val = snap.val();
            window._japriInbox = val ? Object.values(val).filter(function(m) { return m !== null; }) : [];
            updateSharedBadge();
            // Jika modal pesan sedang terbuka, refresh tampilan
            var modal = document.getElementById('messageModal');
            if (modal && !modal.classList.contains('hidden')) {
                if (typeof renderMessages === 'function') renderMessages();
            }
        } catch (e) { console.error('[state] japri inbox error:', e); }
    });
    window._japriListener = japriRef;

    // Listener 4: Group Chat (global)
    var groupChatRef = db.ref('group_chats');
    groupChatRef.on('value', function(snap) {
        try {
            window._groupChatsData = snap.val() || {};
            updateSharedBadge();
            if (typeof _updateGroupChatBadge === 'function') _updateGroupChatBadge();
        } catch (e) { console.error('[state] group_chats error:', e); }
    });
    window._globalGroupChatListener = groupChatRef;
}

// ============================================================
// DETACH — Dipanggil saat logout agar tidak leak memory
// ============================================================
function detachAllListeners() {
    try {
        if (_holidayListener)  { db.ref('holidays/' + currentUser.uid).off('value', _holidayListener); _holidayListener = null; }
        if (_taskListener)    _taskListener.off('value');
        if (_routineListener) _routineListener.off('value');
        if (_noteListener)    _noteListener.off('value');
        if (_logListener)     _logListener.off('value');
        if (_usersListener)    { db.ref('users').off('value', _usersListener); _usersListener = null; }
        if (_sharedListener)   { db.ref('shared_notes').orderByChild('toUid').equalTo(currentUser.uid).off('value', _sharedListener); _sharedListener = null; }
        if (_outboxListener)   { db.ref('shared_notes').orderByChild('fromUid').equalTo(currentUser.uid).off('value', _outboxListener); _outboxListener = null; }
        if (_inboxListener)    { db.ref('tasks').orderByChild('delegatedBy').equalTo(currentUser.uid).off('value', _inboxListener); _inboxListener = null; }
        if (_meetingListener)  { db.ref('tasks').orderByChild('type').equalTo('meeting').off('value', _meetingListener); _meetingListener = null; }
        if (window._japriListener) { db.ref('messages').orderByChild('toUid').equalTo(currentUser.uid).off('value', window._japriListener); window._japriListener = null; }
        if (window._globalGroupChatListener) { 
            db.ref('group_chats').off('value'); 
            window._globalGroupChatListener = null; 
        }
    } catch (e) {}

    // Reset state
    tasks = []; notes = []; routines = { daily: [], weekly: [], monthly: [] };
    holidays = []; activityLogs = []; allUsers = {};
    sharedNotes = []; sentMessages = []; allMessages = []; inbox = [];
    isTasksLoaded = false; isRoutinesLoaded = false;
    _baseTasks = []; _meetingTasks = [];
}

// ── Update badge notifikasi di sidebar ─────────────────────────────────
function _mergeAndUpdateMessages() {
    // Gabungkan pesan masuk + keluar, hapus duplikat berdasarkan id
    var merged = {};
    sharedNotes.forEach(function(m) { if (m && m.id) merged[m.id] = m; });
    sentMessages.forEach(function(m) { if (m && m.id) merged[m.id] = m; });
    allMessages = Object.values(merged);
    // Update badge: hanya hitung pesan MASUK yang belum dibaca
    updateSharedBadge();
    // Jika modal pesan sedang terbuka, refresh tampilan
    var modal = document.getElementById('messageModal');
    if (modal && !modal.classList.contains('hidden')) {
        if (typeof renderMessages === 'function') renderMessages();
    }
}

function updateSharedBadge() {
    var badge = document.getElementById('messageBadge');
    if (!badge) return;
    if (!window.currentUser || !window.currentUser.uid) return; // tunggu sampai auth siap

    // Hitung dari shared_notes (lama) yang belum dibaca
    var unreadLegacy = window.sharedNotes ? window.sharedNotes.filter(function(s) { return !s.read; }).length : 0;
    // Hitung dari messages/ (baru/Japri) yang belum dibaca
    var japriInbox = window._japriInbox || [];
    var unreadJapri = japriInbox.filter(function(m) { return !m.read; }).length;
    // Hitung dari group chat
    var totalGrupUnread = 0;
    
    if (window._groupChatsData) {
        var allowedDepts = (typeof _chatGetAllowedDepts === 'function') ? _chatGetAllowedDepts() : [currentUser.department];
        
        Object.keys(window._groupChatsData).forEach(function(safeKey) {
            var msgs = window._groupChatsData[safeKey] || {};
            var count = 0;
            
            // Cek lastSeen
            var lastSeen = 0;
            if (window._chatLastSeen) {
                var originalName = Object.keys(window._chatLastSeen).find(function(k) {
                    return (typeof _chatSafeKey === 'function' ? _chatSafeKey(k) : k.replace(/[^a-zA-Z0-9]/g, '_')) === safeKey;
                });
                if (originalName) {
                    lastSeen = window._chatLastSeen[originalName];
                }
            }
            
            Object.values(msgs).forEach(function(m) {
                if (m && m.timestamp > lastSeen && m.uid !== currentUser.uid) {
                    count++;
                }
            });
            
            if (currentUser.role === 'SuperAdmin' || currentUser.role === 'Direktur' || currentUser.role === 'Executive') {
                totalGrupUnread += count;
            } else {
                // Pastikan key ini masuk allowedDepts
                var isAllowed = allowedDepts.some(function(d) {
                    var dSafe = (typeof _chatSafeKey === 'function') ? _chatSafeKey(d) : d.replace(/[^a-zA-Z0-9]/g, '_');
                    return dSafe === safeKey;
                });
                if (isAllowed) {
                    totalGrupUnread += count;
                }
            }
        });
    }

    var unread = unreadLegacy + unreadJapri + totalGrupUnread;
    if (unread > 0) {
        badge.textContent = unread;
        badge.classList.remove('hidden');
    } else {
        badge.classList.add('hidden');
    }
}