/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/auth.js — Firebase Authentication & RBAC
   Load ORDER: #4

   FLOW:
   1. DOMContentLoaded: pasang listener & keyboard handler
   2. onAuthStateChanged: dipanggil oleh Firebase
   3. Jika ada user: ambil profil dari DB → set currentUser
   4. Panggil initFirebaseListeners() → data mulai mengalir
   5. Panggil setupRoleBasedUI() → tampilkan menu sesuai role
   6. Panggil switchView() → render halaman pertama
   ============================================================ */

document.addEventListener('DOMContentLoaded', function() {

    // ── Keyboard Enter di form login ──────────────────────────
    ['loginEmail', 'loginPass'].forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') handleLogin();
        });
    });

    // ── Auth State Listener ───────────────────────────────────
    auth.onAuthStateChanged(function(firebaseUser) {
        if (firebaseUser) {
            // User sudah login (atau sesi tersimpan)
            _onUserLoggedIn(firebaseUser);
        } else {
            // Tidak ada sesi
            _onUserLoggedOut();
        }
    });
});

// ── Internal: Setelah Firebase konfirmasi user login ──────────
function _onUserLoggedIn(firebaseUser) {
    var loginBtn = document.querySelector('#loginOverlay button[onclick="handleLogin()"]');

    // Timeout guard: jika db.ref() tidak merespons dalam 12 detik, reset UI
    var profileFetchTimeout = setTimeout(function() {
        console.warn('[auth] Profile fetch timeout — resetting login UI');
        var overlay = document.getElementById('loginOverlay');
        if (overlay) overlay.classList.remove('hidden');
        var errEl = document.getElementById('loginError');
        if (errEl) {
            errEl.textContent = 'Login berhasil, tapi koneksi ke database lambat. Coba lagi, atau periksa koneksi internet Anda.';
            errEl.classList.remove('hidden');
        }
        if (loginBtn) { loginBtn.disabled = false; loginBtn.textContent = 'MASUK WORKSTATION'; }
    }, 12000);

    // Ambil profil dari database
    db.ref('users/' + firebaseUser.uid).once('value').then(function(snap) {
        clearTimeout(profileFetchTimeout);
        var profile = snap.val() || {};

        // Susun objek currentUser
        // PENTING: workDays bisa ada di root profile (set via panel admin) ATAU di settings.
        // Kita normalisasi ke integer dan simpan di currentUser.workDays agar engine.js bisa baca konsisten.
        var rootWorkDays = profile.workDays ? parseInt(profile.workDays) : 0;
        var settingsWorkDays = (profile.settings && profile.settings.workDays) ? parseInt(profile.settings.workDays) : 5;
        var resolvedWorkDays = rootWorkDays > 0 ? rootWorkDays : settingsWorkDays;

        currentUser = {
            uid:             firebaseUser.uid,
            email:           firebaseUser.email,
            name:            profile.name       || firebaseUser.email.split('@')[0],
            role:            profile.role        || 'Staff',
            department:      profile.department  || 'Umum',
            watchDepartment: profile.watchDepartment || profile.department || 'Umum',
            workDays:        resolvedWorkDays,
            settings:        profile.settings || { workDays: 5, timeIn: '08:00', timeOut: '17:00', breaks: [{start:'12:00', end:'13:00'}] }
        };

        // Selalu update lastLogin setiap login sukses (untuk monitoring aktif di panel admin)
        db.ref('users/' + firebaseUser.uid).update({ lastLogin: new Date().toISOString() }).catch(function(e) {
            console.warn('[auth] Gagal update lastLogin:', e);
        });

        // Simpan profil awal jika baru (belum ada di DB)
        if (!snap.exists()) {
            db.ref('users/' + firebaseUser.uid).set({
                uid:        currentUser.uid,
                email:      currentUser.email,
                name:       currentUser.name,
                role:       currentUser.role,
                department: currentUser.department,
                settings:   currentUser.settings,
                createdAt:  new Date().toISOString()
            });
        }

        // Aktifkan semua Firebase listeners
        initFirebaseListeners();

        // PENTING: Trigger badge update manual setelah listeners siap
        if (typeof updateSharedBadge === 'function') {
            updateSharedBadge();
        }

        // Setup tampilan menu berdasarkan role
        setupRoleBasedUI();

        // Sembunyikan overlay login
        var overlay = document.getElementById('loginOverlay');
        if (overlay) overlay.classList.add('hidden');

        // Update nama user di sidebar
        var nameEl = document.getElementById('sidebarUserName');
        var roleEl = document.getElementById('sidebarUserRole');
        if (nameEl) nameEl.textContent = currentUser.name;
        if (roleEl) roleEl.textContent = currentUser.role + ' — ' + currentUser.department;

        // Navigasi ke halaman pertama berdasarkan role
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('note')) {
            switchView('notes', urlParams.get('note'));
        } else if (currentUser.role === 'Executive' || currentUser.role === 'DeptExecutive' || currentUser.role === 'Direktur') {
            switchView('executive');
        } else {
            switchView('today');
        }

    }).catch(function(err) {
        clearTimeout(profileFetchTimeout);
        // Error ambil profil — tampilkan pesan spesifik
        var overlay = document.getElementById('loginOverlay');
        if (overlay) overlay.classList.remove('hidden');
        var errEl = document.getElementById('loginError');
        if (errEl) {
            errEl.textContent = 'Login berhasil, tapi gagal memuat profil: ' + err.message + '. Cek Rules Firebase Database Anda.';
            errEl.classList.remove('hidden');
        }
        if (loginBtn) { loginBtn.disabled = false; loginBtn.textContent = 'MASUK WORKSTATION'; }
    });
}

// ── Internal: Saat logout / tidak ada sesi ───────────────────
function _onUserLoggedOut() {
    currentUser = null;
    detachAllListeners();
    var overlay = document.getElementById('loginOverlay');
    if (overlay) overlay.classList.remove('hidden');
}

// ── Helper: cek apakah role ini termasuk "management" (bisa pantau orang lain) ──
function isMgmtRole(role) {
    return role === 'SuperAdmin' || role === 'Supervisor' || role === 'Executive' || role === 'DeptExecutive' || role === 'Direktur';
}

// ── Setup UI berdasarkan Role ─────────────────────────────────
function setupRoleBasedUI() {
    var role = currentUser ? currentUser.role : 'Staff';

    // ── RBAC Matrix ────────────────────────────────────────────
    // Format: 'element-id': ['allowed', 'roles']
    var WORKER_ROLES   = ['Staff', 'Supervisor', 'SuperAdmin', 'Direktur'];
    var SPV_ROLES      = ['Supervisor', 'SuperAdmin', 'Direktur'];
    var ADMIN_ROLES    = ['SuperAdmin'];
    var EXEC_ROLES     = ['Executive', 'DeptExecutive', 'SuperAdmin', 'Direktur'];
    var ALL_AUTH_ROLES = ['Staff', 'Supervisor', 'SuperAdmin', 'Executive', 'DeptExecutive', 'Direktur'];

    var menuConfig = {
        // ── Workspace (Staff, SPV, SuperAdmin, Direktur) ──
        'nav-section-staff':     WORKER_ROLES,
        'nav-section-workspace': WORKER_ROLES,
        'nav-section-tools':     WORKER_ROLES,
        'btn-today':             WORKER_ROLES,
        'btn-board':             WORKER_ROLES,
        'btn-calendar':          WORKER_ROLES,
        'btn-meeting':           WORKER_ROLES,
        'btn-notes':             WORKER_ROLES,
        'btn-routines':          WORKER_ROLES,
        'btn-delegate-task':     SPV_ROLES,
        'btn-archive':           WORKER_ROLES,
        'sidebar-workload':      WORKER_ROLES,
        'topbar-workload':       WORKER_ROLES,
        'btn-new-task':          WORKER_ROLES,

        // ── Analytics & Audit (semua role) ──
        'btn-analytics':         ['Staff', 'Supervisor'],
        'btn-activity':          ALL_AUTH_ROLES,
        'btn-guide':             ALL_AUTH_ROLES,
        'sidebar-export-btn':    WORKER_ROLES,

        // ── SPV+ ──
        'btn-supervisor':        SPV_ROLES,
        'btn-delegate-task':     SPV_ROLES,

        // ── Admin (SuperAdmin only) ──
        'btn-users':             ADMIN_ROLES,

        // ── Executive section (Exec, DeptExec, SuperAdmin) ──
        'nav-section-executive': EXEC_ROLES,
        'btn-executive':         EXEC_ROLES,
        'btn-exec-analytics':    EXEC_ROLES,
    };

    Object.keys(menuConfig).forEach(function(elemId) {
        var el = document.getElementById(elemId);
        if (!el) return;
        var allowed = menuConfig[elemId];
        if (allowed.indexOf(role) !== -1) {
            el.classList.remove('hidden');
            if (el.className.indexOf('flex') !== -1) el.style.display = '';
        } else {
            el.classList.add('hidden');
        }
    });

    // ── Sidebar label: tampilkan nama divisi untuk konteks ──────
    var roleEl = document.getElementById('sidebarUserRole');
    var roleLabels = {
        'SuperAdmin':    '⚡ SuperAdmin · ' + (currentUser.department || ''),
        'Supervisor':    '🔷 SPV · ' + (currentUser.department || ''),
        'Executive':     '👑 Direksi',
        'DeptExecutive': '👑 Direksi · ' + (currentUser.watchDepartment || currentUser.department || ''),
        'Staff':         '🔹 Staff · ' + (currentUser.department || '')
    };
    if (roleEl) roleEl.textContent = roleLabels[role] || (role + ' — ' + (currentUser.department || ''));
}


// ── Handle Login Form ─────────────────────────────────────────
function handleLogin() {
    var email  = document.getElementById('loginEmail').value.trim();
    var pass   = document.getElementById('loginPass').value;
    var errEl  = document.getElementById('loginError');
    var btn    = document.querySelector('#loginOverlay button[onclick="handleLogin()"]');

    errEl.classList.add('hidden');
    if (!email || !pass) {
        errEl.textContent = 'Email dan password wajib diisi.';
        errEl.classList.remove('hidden');
        return;
    }

    if (btn) { btn.disabled = true; btn.textContent = 'Memverifikasi...'; }

    // Safety timeout: jika Firebase tidak merespons dalam 15 detik, reset tombol
    var loginTimeout = setTimeout(function() {
        if (btn && btn.disabled) {
            btn.disabled = false;
            btn.textContent = 'MASUK WORKSTATION';
            errEl.textContent = 'Koneksi timeout. Pastikan Anda terhubung ke internet, lalu coba lagi.';
            errEl.classList.remove('hidden');
        }
    }, 15000);

    function resetBtn(errMsg) {
        clearTimeout(loginTimeout);
        if (errMsg) {
            errEl.textContent = errMsg;
            errEl.classList.remove('hidden');
        }
        if (btn) { btn.disabled = false; btn.textContent = 'MASUK WORKSTATION'; }
    }

    // Guard: jika Firebase belum siap
    if (typeof auth === 'undefined' || !auth) {
        resetBtn('Firebase belum termuat. Pastikan koneksi internet Anda aktif lalu refresh halaman.');
        return;
    }

    auth.setPersistence(firebase.auth.Auth.Persistence.LOCAL).then(function() {
        return auth.signInWithEmailAndPassword(email, pass);
    }).then(function() {
        // Autentikasi sukses — update tombol ke status 'memuat profil'
        clearTimeout(loginTimeout);
        if (btn) btn.textContent = 'Memuat profil...';
        // _onUserLoggedIn dipanggil via onAuthStateChanged (lihat di bawah),
        // yang memiliki timeout sendiri (12 detik) untuk fetch database
    }).catch(function(err) {
        var msg = err.message || 'Terjadi kesalahan.';
        if (err.code === 'auth/user-not-found' || err.code === 'auth/wrong-password' || err.code === 'auth/invalid-credential' || err.code === 'auth/invalid-login-credentials') {
            msg = 'Email atau password salah. Silakan periksa kembali.';
        } else if (err.code === 'auth/too-many-requests') {
            msg = 'Terlalu banyak percobaan. Coba lagi dalam beberapa menit.';
        } else if (err.code === 'auth/network-request-failed') {
            msg = 'Koneksi gagal. Pastikan Anda terhubung ke internet.';
        }
        resetBtn(msg);
    });
}

// ── Handle Logout ─────────────────────────────────────────────
function handleLogout() {
    auth.signOut().catch(function(e) { console.error('Logout error:', e); });
}

// ── Handle Google Login ────────────────────────────────────────
function handleGoogleLogin() {
    var errEl  = document.getElementById('loginError');
    var gBtn   = document.querySelector('#loginOverlay button[onclick="handleGoogleLogin()"]');
    if (errEl) errEl.classList.add('hidden');
    if (gBtn) { gBtn.disabled = true; gBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i>Menghubungkan...'; }

    if (typeof auth === 'undefined' || !auth) {
        if (errEl) { errEl.textContent = 'Firebase belum termuat.'; errEl.classList.remove('hidden'); }
        if (gBtn) { gBtn.disabled = false; gBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg> Masuk dengan Google'; }
        return;
    }

    var provider = new firebase.auth.GoogleAuthProvider();
    auth.setPersistence(firebase.auth.Auth.Persistence.LOCAL).then(function() {
        return auth.signInWithPopup(provider);
    }).then(function(result) {
        // Cek apakah email Google terdaftar sebagai karyawan di DB
        var email = result.user.email;
        if (gBtn) gBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i>Memverifikasi akun...';
        return db.ref('users').orderByChild('email').equalTo(email).once('value').then(function(snap) {
            if (!snap.exists()) {
                // Email Google tidak terdaftar sbg karyawan — logout dan tampilkan error
                auth.signOut();
                if (errEl) { errEl.textContent = 'Akun Google (' + email + ') tidak terdaftar sebagai karyawan. Hubungi Administrator.'; errEl.classList.remove('hidden'); }
                if (gBtn) { gBtn.disabled = false; gBtn.innerHTML = 'Masuk dengan Google'; }
            }
            // Jika terdaftar: onAuthStateChanged akan handle sisanya secara otomatis
        });
    }).catch(function(err) {
        var msg = 'Login Google gagal.';
        if (err.code === 'auth/popup-closed-by-user')     msg = 'Login dibatalkan.';
        else if (err.code === 'auth/popup-blocked')       msg = 'Popup diblokir browser. Izinkan popup dari situs ini.';
        else if (err.code === 'auth/network-request-failed') msg = 'Koneksi gagal. Pastikan terhubung ke internet.';
        if (errEl) { errEl.textContent = msg; errEl.classList.remove('hidden'); }
        if (gBtn) { gBtn.disabled = false; gBtn.innerHTML = 'Masuk dengan Google'; }
    });
}
