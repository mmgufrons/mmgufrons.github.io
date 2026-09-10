/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/app.js — Main Application Entry Point & Navigation
   Load ORDER: LAST (after all other scripts)
   ============================================================ */

// ── Current view state ────────────────────────────────────────
let curView      = 'today';
let activeNoteId = null;
let boardTargetUid = null;
// Analytics scope toggle: 'company' | 'dept' | 'personal' (SuperAdmin saja)
var _analyticsScope = 'company';

// ── Navigation ────────────────────────────────────────────────

function switchView(view, payload) {
    if (payload === undefined) payload = null;
    curView = view;

    // Update sidebar active state
    var btnMap = {
        today:      'btn-today',
        meeting:    'btn-meeting',
        board:      'btn-board',
        calendar:   'btn-calendar',
        routines:   'btn-routines',
        notes:      'btn-notes',
        archive:    'btn-archive',
        activity:   'btn-activity',
        analytics:  'btn-analytics',
        executive:  'btn-executive',
        supervisor: 'btn-supervisor',
        users:      'btn-users',
        guide:      'btn-guide',
        groupchat:  'btn-groupchat',
        dataroom:   'btn-dataroom',
        tools:      'btn-tools'
    };
    var active_cls   = 'w-full text-left px-3 py-2.5 rounded transition flex items-center gap-3 menu-active text-[13px]';
    var inactive_cls = 'w-full text-left px-3 py-2.5 rounded transition flex items-center gap-3 menu-inactive text-[13px] hover:bg-[#252525]';

    Object.keys(btnMap).forEach(function(v) {
        var id = btnMap[v];
        var b_list = [];
        if (v === 'analytics') {
            b_list.push(document.getElementById('btn-analytics'));
            b_list.push(document.getElementById('btn-exec-analytics'));
        } else {
            b_list.push(document.getElementById(id));
        }

        b_list.forEach(function(b) {
            if (b) {
                // Kita harus hati-hati agar tidak menghapus class 'hidden' yang di-set oleh RBAC (auth.js)
                var isHidden = b.classList.contains('hidden');
            
                // Preserve extra classes (color overrides) for special buttons
                var extraCls = '';
                if (id === 'btn-supervisor')     extraCls = ' text-emerald-400 hover:text-emerald-300';
                if (id === 'btn-users')          extraCls = ' text-blue-400 hover:text-blue-300';
                if (id === 'btn-guide')          extraCls = ' text-gray-400';
                if (id === 'btn-activity')       extraCls = v === view ? '' : ' text-purple-400 hover:text-purple-300';
                if (id === 'btn-groupchat')      extraCls = v === view ? '' : ' text-emerald-400 hover:text-emerald-300';
                
                var newCls = v === view ? active_cls : inactive_cls;
                if (isHidden) newCls += ' hidden';
                if (extraCls) newCls += extraCls;
                
                b.className = newCls;
            }
        });
    });

    // Page titles
    var titles = {
        today:      'Dasbor Hari Ini',
        meeting:    'Meeting & Hasil',
        board:      'Proyek & Papan Kanban',
        calendar:   'Kalender Pintar',
        routines:   'Automasi & Rutinitas',
        notes:      'Buku Catatan Digital',
        archive:    'Arsip & Riwayat',
        activity:   'Aktivitas & Log Sistem',
        analytics:  'Enterprise Analytics',
        executive:  'Executive Dashboard',
        supervisor: 'Panel Supervisor',
        users:      'Kelola Pengguna',
        guide:      'Buku Panduan SOP',
        groupchat:  'Grup Chat Divisi',
        dataroom:   'Lemari Data Room',
        tools:      'Direktori Tools & Akses'
    };
    var titleEl = document.getElementById('pageTitle');
    if (titleEl) titleEl.textContent = titles[view] || '';


    // Clean URL
    if (view !== 'notes') window.history.replaceState({}, document.title, window.location.pathname);

    // Reset container
    var c = document.getElementById('viewContainer');
    if (!c) return;
    c.className = 'flex-1 overflow-y-auto p-4 md:p-6 pb-24 h-full relative w-full scroll-smooth';

    // Scroll to top
    c.scrollTo({ top: 0, behavior: 'smooth' });

    // Set active note
    if (view === 'notes') activeNoteId = payload;
    if (view === 'board') boardTargetUid = payload;

    // Render
    refreshActiveView();

    // Close sidebar on mobile
    if (window.innerWidth < 768) {
        var sidebar = document.getElementById('sidebar');
        var overlay = document.getElementById('mobileOverlay');
        if (sidebar) sidebar.classList.add('-translate-x-full');
        if (overlay) overlay.classList.add('hidden');
    }
}

// ── Enterprise-Level Auto-Refresh & Focus Protection ───────────
let _refreshTimer = null;
let _pendingRefresh = false;

// Event listener global untuk mengeksekusi refresh yang tertunda setelah user selesai mengetik
document.addEventListener('blur', function(e) {
    if (_pendingRefresh) {
        // Beri sedikit jeda jika user langsung klik ke input lain
        setTimeout(function() {
            var isTyping = document.activeElement && (document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'TEXTAREA' || document.activeElement.tagName === 'SELECT' || document.activeElement.isContentEditable);
            if (!isTyping && _pendingRefresh) {
                _pendingRefresh = false;
                refreshActiveView();
            }
        }, 150);
    }
}, true); // Use capture phase to catch all blurs

function debouncedRefreshActiveView() {
    clearTimeout(_refreshTimer);
    _refreshTimer = setTimeout(function() {
        // Cek apakah user sedang aktif mengetik/memilih di suatu tempat
        var isTyping = document.activeElement && (document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'TEXTAREA' || document.activeElement.tagName === 'SELECT' || document.activeElement.isContentEditable);
        
        // Cek apakah ada Modal yang terbuka (selain alert/toast)
        // Kita tidak block jika modal terbuka, karena refresh hanya menimpa viewContainer, bukan modal.
        // TAPI jika user sedang ngetik di dalam modal, lebih baik refresh viewContainer juga ditahan agar tidak ngelag.
        
        if (isTyping) {
            _pendingRefresh = true;
            // Opsional: Tampilkan indikator kecil "Syncing..." (Enterprise feel)
            // console.log("Refresh ditunda karena sedang mengetik...");
            return;
        }

        _pendingRefresh = false;
        refreshActiveView();
    }, 300); // 300ms debounce (Peredam Kejut)
}

function refreshActiveView() {
    try {
        var c = document.getElementById('viewContainer');
        if (!c) return;
        c.innerHTML = '';

        switch (curView) {
            case 'today':      if (typeof renderTodayView      === 'function') renderTodayView(c);      break;
            case 'meeting':    if (typeof renderMeetingView    === 'function') renderMeetingView(c);    break;
            case 'board':      if (typeof renderBoardView      === 'function') renderBoardView(c);      break;
            case 'calendar':   if (typeof renderCalendarView   === 'function') renderCalendarView(c);   break;
            case 'routines':   if (typeof renderRoutinesView   === 'function') renderRoutinesView(c);   break;
            case 'notes':      if (typeof renderNotesView      === 'function') renderNotesView(c);      break;
            case 'archive':    if (typeof renderArchiveView    === 'function') renderArchiveView(c);    break;
            case 'activity':   if (typeof renderActivityLogView=== 'function') renderActivityLogView(c);break;
            case 'analytics':  if (typeof renderAnalyticsView  === 'function') renderAnalyticsView(c);  break;
            case 'executive':  if (typeof renderExecutiveView  === 'function') renderExecutiveView(c);  break;
            case 'supervisor': if (typeof renderSupervisorView === 'function') renderSupervisorView(c); break;
            case 'users':      if (typeof renderUsersView      === 'function') renderUsersView(c);      break;
            case 'guide':      if (typeof renderGuideView      === 'function') renderGuideView(c);      break;
            case 'groupchat':  if (typeof renderGroupChatView  === 'function') renderGroupChatView(c);  break;
            case 'dataroom':   if (typeof renderDataRoomView   === 'function') renderDataRoomView(c);   break;
            case 'tools':      if (typeof renderToolsView      === 'function') renderToolsView(c);      break;
            default:
                c.innerHTML = '<p class="text-center text-gray-600 mt-10">Halaman tidak ditemukan.</p>';
        }
    } catch (e) {
        console.error('[app.js] refreshActiveView error:', e);
        var c2 = document.getElementById('viewContainer');
        if (c2) c2.innerHTML = '<p class="text-center text-red-500 mt-10 text-xs">Error merender halaman: ' + e.message + '</p>';
    }
}

// ── Smart Dropdown Positioning — popup muncul tepat di bawah tombol ──────────
function closeAllDropdowns(exceptId) {
    ['messageModal', 'inboxModal'].forEach(function(id) {
        if (id !== exceptId) {
            var el = document.getElementById(id);
            if (el) el.classList.add('hidden');
        }
    });
}

function toggleDropdown(modalId) {
    var modal = document.getElementById(modalId);
    if (!modal) return;
    var isHidden = modal.classList.contains('hidden');
    closeAllDropdowns(modalId);
    if (!isHidden) { modal.classList.add('hidden'); return; }

    var btnWrapId = modalId === 'messageModal' ? 'msgBtnWrap' : 'inboxBtnWrap';
    var btnWrap   = document.getElementById(btnWrapId);
    if (btnWrap) {
        var rect       = btnWrap.getBoundingClientRect();
        var POPUP_W    = modalId === 'messageModal' ? 384 : 320;
        var left       = rect.left + rect.width / 2 - POPUP_W / 2;
        left           = Math.max(8, Math.min(left, window.innerWidth - POPUP_W - 8));
        var top        = rect.bottom + 8;
        modal.style.top      = top + 'px';
        modal.style.left     = left + 'px';
        modal.style.width    = POPUP_W + 'px';
        modal.style.maxWidth = '95vw';
    }
    modal.classList.remove('hidden');

    // Klik di luar → tutup
    setTimeout(function() {
        function outsideHandler(e) {
            var wrap = document.getElementById(btnWrapId);
            if (!modal.contains(e.target) && !(wrap && wrap.contains(e.target))) {
                modal.classList.add('hidden');
                document.removeEventListener('mousedown', outsideHandler);
            }
        }
        document.addEventListener('mousedown', outsideHandler);
    }, 10);
}

// ── Sidebar Toggle ────────────────────────────────────────────

function toggleSidebar() {
    var s = document.getElementById('sidebar');
    var o = document.getElementById('mobileOverlay');
    if (s) s.classList.toggle('-translate-x-full');
    if (o) o.classList.toggle('hidden');
}

// ── Global Keyboard Shortcuts ─────────────────────────────────
document.addEventListener('keydown', function(e) {
    var isInputFocused = e.target.closest('input, textarea, [contenteditable="true"]');

    if (e.key === 'Escape') {
        document.querySelectorAll('[id$="Modal"]').forEach(function(el) { el.classList.add('hidden'); });
        var si = document.getElementById('searchInput');
        if (si) si.value = '';
        return;
    }

    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
        if (isInputFocused && e.target.closest('[contenteditable="true"]')) {
            e.preventDefault();
            if (typeof addLinkUniversal === 'function') addLinkUniversal();
        }
        return;
    }

    // Guard: e.key bisa undefined pada beberapa browser/OS keys
    if (!e.key) return;

    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'f') {
        e.preventDefault();
        var sm = document.getElementById('searchModal');
        if (sm) {
            sm.classList.remove('hidden');
            setTimeout(function() { document.getElementById('searchInput').focus(); }, 100);
        }
        return;
    }

    if (e.key.toLowerCase() === 'n' && !e.ctrlKey && !e.metaKey && !isInputFocused) {
        if (currentUser && (currentUser.role === 'Executive' || currentUser.role === 'DeptExecutive' || currentUser.role === 'Direktur')) return;
        e.preventDefault();
        if (typeof openTaskModal === 'function') openTaskModal();
    }
});

// ── Content-editable link passthrough ────────────────────────
document.addEventListener('click', function(e) {
    if (e.target.tagName === 'A' && e.target.closest('[contenteditable]')) {
        e.preventDefault();
        window.open(e.target.href, '_blank');
    }
});

// ── PWA Service Worker ────────────────────────────────────────
// PORTOFOLIO DEMO: registrasi service worker dimatikan — path aslinya absolut
// ('/smsrm/sma/sw.js') dan tidak relevan untuk versi demo, sekalian menghindari
// cache offline yang bisa bikin data dummy kelihatan "nyangkut"/tidak update.
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.getRegistrations().then(function (regs) {
        regs.forEach(function (r) { r.unregister(); });
    });
}

// ── PWA Install Prompt ────────────────────────────────────────
var deferredInstallPrompt = null;
window.addEventListener('beforeinstallprompt', function(e) {
    e.preventDefault();
    deferredInstallPrompt = e;
    // Hanya tampilkan banner jika belum pernah di-dismiss DAN belum terinstall
    var wasDismissed = localStorage.getItem('pwa_dismissed');
    var wasInstalled = localStorage.getItem('pwa_installed');
    var sidebarBtn = document.getElementById('btn-install-pwa');
    if (!wasDismissed && !wasInstalled) {
        var banner = document.getElementById('pwaInstallBanner');
        if (banner) banner.classList.remove('hidden');
    }
    // Sidebar button selalu tampil jika belum terinstall
    if (!wasInstalled && sidebarBtn) sidebarBtn.classList.remove('hidden');
});

function dismissPWABanner() {
    localStorage.setItem('pwa_dismissed', '1');
    var banner = document.getElementById('pwaInstallBanner');
    if (banner) banner.classList.add('hidden');
}

function installPWA() {
    if (!deferredInstallPrompt) {
        alert('Untuk menginstal: klik ikon Install di address bar browser atau pilih "Add to Homescreen".');
        return;
    }
    deferredInstallPrompt.prompt();
    deferredInstallPrompt.userChoice.then(function(choice) {
        deferredInstallPrompt = null;
        var banner = document.getElementById('pwaInstallBanner');
        if (banner) banner.classList.add('hidden');
        if (choice.outcome === 'accepted') {
            localStorage.setItem('pwa_installed', '1');
            var sidebarBtn = document.getElementById('btn-install-pwa');
            if (sidebarBtn) sidebarBtn.classList.add('hidden');
        }
    });
}

// ── Offline Detection ─────────────────────────────────────────
function updateOnlineStatus() {
    var bar = document.getElementById('offlineBar');
    if (!bar) return;
    if (navigator.onLine) {
        bar.classList.add('hidden');
    } else {
        bar.classList.remove('hidden');
    }
}
window.addEventListener('online',  updateOnlineStatus);
window.addEventListener('offline', updateOnlineStatus);

// ── Initialize ────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    var el = document.getElementById('currentDateDisplay');
    if (el) el.textContent = new Date().toLocaleDateString('id-ID', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
    updateOnlineStatus();

    // Update avatar initial
    var avatarEl = document.getElementById('sidebarAvatar');
    if (avatarEl && currentUser && currentUser.name) {
        avatarEl.textContent = currentUser.name.charAt(0).toUpperCase();
    }
});


// Auto-Refresh
setInterval(function() {
    var titleEl = document.getElementById('pageTitle');
    if (titleEl && titleEl.textContent === 'Dasbor Hari Ini') debouncedRefreshActiveView();
}, 60000); // 1 menit

// ── Theme Management ──────────────────────────────────────────
window.toggleTheme = function() {
    var body = document.body;
    var btn  = document.getElementById('themeToggleBtn');
    var icon = document.getElementById('themeIcon');

    if (body.classList.contains('light-mode')) {
        // Switch to Dark
        body.classList.remove('light-mode');
        if (icon) { icon.className = 'fa-solid fa-sun'; }
        if (btn)  { btn.title = 'Mode Terang'; }
        localStorage.setItem('theme', 'dark');
    } else {
        // Switch to Light
        body.classList.add('light-mode');
        if (icon) { icon.className = 'fa-solid fa-moon'; }
        if (btn)  { btn.title = 'Mode Gelap'; }
        localStorage.setItem('theme', 'light');
    }

    // Re-render analytics if currently active (charts need color refresh)
    if (typeof curView !== 'undefined' && curView === 'analytics') {
        setTimeout(function() {
            if (typeof renderAnalyticsView === 'function') {
                var c = document.getElementById('viewContainer');
                if (c) renderAnalyticsView(c);
            }
        }, 50);
    }
};

// Load Theme on Start
document.addEventListener('DOMContentLoaded', function() {
    var saved = localStorage.getItem('theme');
    var btn  = document.getElementById('themeToggleBtn');
    var icon = document.getElementById('themeIcon');
    if (saved === 'light') {
        document.body.classList.add('light-mode');
        if (icon) icon.className = 'fa-solid fa-moon';
        if (btn)  btn.title = 'Mode Gelap';
    } else {
        if (icon) icon.className = 'fa-solid fa-sun';
        if (btn)  btn.title = 'Mode Terang';
    }
});

