/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/users.js — User Management & Data Migration View
   Akses: SuperAdmin saja
   ============================================================ */

function renderUsersView(c) {
    if (!currentUser || currentUser.role !== 'SuperAdmin') {
        c.innerHTML = '<p class="text-center text-red-500 mt-10">Akses Ditolak. Khusus SuperAdmin.</p>';
        return;
    }

    c.innerHTML = '<div class="space-y-6 max-w-3xl mx-auto animate-fadein pb-10">' +

        '<div class="flex items-center gap-3">' +
        '<div class="w-10 h-10 rounded-full bg-blue-900/30 border border-blue-500/30 flex items-center justify-center text-blue-400">' +
        '<i class="fa-solid fa-users-gear"></i></div>' +
        '<div><h2 class="text-xl font-bold text-white">Kelola Pengguna</h2>' +
        '<p class="text-xs text-gray-500">Atur Role dan Departemen karyawan berdasarkan UID Firebase.</p>' +
        '</div></div>' +

        '<div class="card-bg p-5 rounded-xl border border-[#3f3f3f] shadow-lg">' +
        '<p class="text-[10px] font-bold text-gray-400 uppercase mb-4 border-b border-[#2a2a2a] pb-2">' +
        '<i class="fa-solid fa-user-plus text-blue-400 mr-2"></i> Tambah / Perbarui Profil User</p>' +
        '<div class="space-y-4">' +

        '<div><label class="block text-[10px] text-gray-500 mb-1 font-bold uppercase">UID User (dari Firebase Console &rsaquo; Authentication &rsaquo; Users)</label>' +
        '<input type="text" id="manageUid" class="w-full input-bg rounded p-3 text-sm font-mono" placeholder="Contoh: demoUID000001"></div>' +

        '<div><label class="block text-[10px] text-gray-500 mb-1 font-bold uppercase">Nama Lengkap Karyawan</label>' +
        '<input type="text" id="manageName" class="w-full input-bg rounded p-3 text-sm" placeholder="Nama lengkap"></div>' +

                '<div class="grid grid-cols-2 gap-4">' +
        '<div><label class="block text-[10px] text-gray-500 mb-1 font-bold uppercase">Role Akses</label>' +
        '<select id="manageRole" class="w-full input-bg rounded p-3 text-sm" onchange="onRoleChange()">' +
        '<option value="Staff">Staff (Data Sendiri)</option>' +
        '<option value="Supervisor">Supervisor (Pantau Tim Dept)</option>' +
        '<option value="DeptExecutive">Dept Executive (1 Dept, Read-Only)</option>' +
        '<option value="Executive">Executive (Semua Dept, Read-Only)</option>' +
        '<option value="Direktur">Direktur (Global, Setara SuperAdmin tanpa UserMgmt)</option>' +
        '<option value="SuperAdmin">SuperAdmin (Full Akses)</option>' +
        '</select></div>' +
        '<div><label class="block text-[10px] text-gray-500 mb-1 font-bold uppercase">Status Aktif</label>' +
        '<select id="manageStatus" class="w-full input-bg rounded p-3 text-sm">' +
        '<option value="true">Aktif</option>' +
        '<option value="false">Nonaktif (Resign / Cuti Panjang)</option>' +
        '</select></div>' +
        '<div><label class="block text-[10px] text-gray-500 mb-1 font-bold uppercase">Departemen</label>' +
        '<input type="text" id="manageDept" list="deptList" class="w-full input-bg rounded p-3 text-sm" placeholder="Ketik atau pilih departemen">' +
        '<datalist id="deptList">' +
        '<option value="Marketing"></option>' +
        '<option value="IT"></option>' +
        '<option value="Finance"></option>' +
        '<option value="CS"></option>' +
        '<option value="Creative"></option>' +
        '<option value="HR"></option>' +
        '<option value="Magang"></option>' +
        '</datalist></div>' +
        '<div><label class="block text-[10px] text-gray-500 mb-1 font-bold uppercase">Hari Kerja</label>' +
        '<select id="manageWorkDays" class="w-full input-bg rounded p-3 text-sm">' +
        '<option value="5">Senin - Jumat (5 Hari)</option>' +
        '<option value="6">Senin - Sabtu (6 Hari)</option>' +
        '</select></div></div>' +

        '<div id="watchDeptBox" class="hidden">' +
        '<label class="block text-[10px] text-orange-400 mb-1 font-bold uppercase">Dept yang Diawasi (khusus DeptExecutive)</label>' +
        '<input type="text" id="manageWatchDept" list="deptList" class="w-full input-bg rounded p-3 text-sm" placeholder="Ketik atau pilih departemen">' +
        '</div>' +

        '<button onclick="saveUserRole()" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-lg transition shadow-lg">' +
        '<i class="fa-solid fa-floppy-disk mr-2"></i> SIMPAN PENGATURAN USER</button>' +
        '</div></div>' +

        '<div class="card-bg p-5 rounded-xl border border-[#3f3f3f] shadow-lg mt-6 mb-8">' +
        '<p class="text-[10px] font-bold text-gray-400 uppercase mb-4 border-b border-[#2a2a2a] pb-2">' +
        '<i class="fa-solid fa-truck-fast text-orange-400 mr-2"></i> Migrasi Divisi / Departemen (Batch Update)</p>' +
        '<p class="text-xs text-gray-500 mb-4">Gunakan alat ini jika ada pergantian nama divisi atau penggabungan divisi (misal: "Marketing" diganti ke "Bisnis"). Seluruh tugas & profil staf terkait akan otomatis dipindahkan secara masal.</p>' +
        '<div class="grid grid-cols-2 gap-4">' +
        '<div><label class="block text-[10px] text-gray-500 mb-1 font-bold uppercase">Nama Divisi Lama</label>' +
        '<input type="text" id="migrateOldDept" class="w-full input-bg rounded p-3 text-sm" placeholder="Contoh: Marketing"></div>' +
        '<div><label class="block text-[10px] text-gray-500 mb-1 font-bold uppercase">Nama Divisi Baru</label>' +
        '<input type="text" id="migrateNewDept" class="w-full input-bg rounded p-3 text-sm" placeholder="Contoh: Bisnis"></div>' +
        '</div>' +
        '<button onclick="migrateDepartment()" class="w-full bg-orange-600 hover:bg-orange-500 text-white font-bold py-3 mt-4 rounded-lg transition shadow-lg">' +
        '<i class="fa-solid fa-bolt mr-2"></i> MIGRASI DIVISI SEKARANG</button>' +
        '</div>' +


        '<div>' +
        '<h3 class="font-bold text-gray-400 text-[10px] uppercase mb-3 border-b border-[#333] pb-2">' +
        '<i class="fa-solid fa-database text-gray-600 mr-1"></i> Daftar User di Database</h3>' +
        '<div id="usersListDb" class="space-y-2 max-h-72 overflow-y-auto pr-2"></div>' +
        '</div>' +

        '</div></div>';

    loadUsersList();
}

function onRoleChange() {
    var role = document.getElementById('manageRole').value;
    var box  = document.getElementById('watchDeptBox');
    if (!box) return;
    if (role === 'DeptExecutive') {
        box.classList.remove('hidden');
    } else {
        box.classList.add('hidden');
    }
}

function saveUserRole() {
    var uid      = (document.getElementById('manageUid').value || '').trim();
    var name     = (document.getElementById('manageName').value || '').trim();
    var role     = document.getElementById('manageRole').value;
    var statusVal = document.getElementById('manageStatus') ? document.getElementById('manageStatus').value : "true";
    var isActive = statusVal === "true";
    var dept     = document.getElementById('manageDept').value;
    var workDays = document.getElementById('manageWorkDays') ? document.getElementById('manageWorkDays').value : '5';
    var watchEl  = document.getElementById('manageWatchDept');
    var watchDept = (role === 'DeptExecutive' && watchEl) ? watchEl.value : dept;

    if (!uid) { showToast('UID tidak boleh kosong!', 'error'); return; }

    var data = {
        role:            role,
        department:      dept,
        workDays:        workDays,
        isActive:        isActive,
        watchDepartment: watchDept,
        updatedAt:       new Date().toISOString()
    };
    if (name) data.name = name;

    db.ref('users/' + uid).update(data).then(function() {
        showToast('Pengaturan User berhasil disimpan!', 'success');
        document.getElementById('manageUid').value  = '';
        document.getElementById('manageName').value = '';
        document.getElementById('manageRole').value = 'Staff';
        if (document.getElementById('manageStatus')) document.getElementById('manageStatus').value = 'true';
        document.getElementById('manageDept').value = '';
        if (document.getElementById('manageWorkDays')) document.getElementById('manageWorkDays').value = '5';
        loadUsersList();
    }).catch(function(e) {
        showToast('Gagal menyimpan: ' + e.message, 'error');
    });
}


function loadUsersList() {
    db.ref('users').once('value').then(function(snap) {
        var container = document.getElementById('usersListDb');
        if (!container) return;
        var data = snap.val();
        if (!data) {
            container.innerHTML = '<p class="text-xs text-gray-500 italic text-center py-4">Belum ada data user di database.</p>';
            return;
        }
        var roleColors = {
            SuperAdmin:    'text-violet-400 bg-violet-900/30 border-violet-500/30',
            Direktur:      'text-pink-400 bg-pink-900/30 border-pink-500/30',
            Supervisor:    'text-emerald-400 bg-emerald-900/30 border-emerald-500/30',
            DeptExecutive: 'text-orange-400 bg-orange-900/30 border-orange-500/30',
            Executive:     'text-yellow-400 bg-yellow-900/30 border-yellow-500/30',
            Staff:         'text-gray-400 bg-gray-800/30 border-gray-500/30'
        };
        var html = Object.keys(data).map(function(uid) {
            var u   = data[uid];
            var clr = roleColors[u.role] || roleColors['Staff'];
            var watchLabel = (u.role === 'DeptExecutive' && u.watchDepartment)
                ? ' <span class="text-gray-600">&rsaquo; ' + u.watchDepartment + '</span>' : '';
            var activeLabel = (u.isActive === false) ? '<span class="text-red-500 font-bold ml-2">[NONAKTIF]</span>' : '';
            return '<div class="bg-[#1a1a1a] p-3 rounded-lg border border-[#2a2a2a] flex justify-between items-center gap-3">' +
                '<div class="min-w-0 flex-1">' +
                '<p class="text-xs font-bold text-white truncate">' + (u.name || u.email || 'No Name') + activeLabel + '</p>' +
                '<p class="text-[10px] text-gray-500">' + (u.department || '-') + watchLabel + '</p>' +
                '<p class="text-[9px] text-gray-700 font-mono truncate mt-0.5">' + uid + '</p>' +
                '</div>' +
                '<div class="flex items-center gap-2 shrink-0">' +
                '<span class="px-2 py-1 border text-[10px] font-bold rounded uppercase ' + clr + '">' + (u.role || 'Staff') + '</span>' +
                '<button onclick="editUser(\'' + uid + '\')" class="w-8 h-8 rounded bg-blue-900/30 text-blue-400 hover:bg-blue-600 hover:text-white transition" title="Edit Pengguna"><i class="fa-solid fa-pencil"></i></button>' +
                '<button onclick="resetUserPassword(\'' + uid + '\')" class="w-8 h-8 rounded bg-orange-900/30 text-orange-400 hover:bg-orange-600 hover:text-white transition" title="Reset Password"><i class="fa-solid fa-key"></i></button>' +
                '</div>' +
                '</div>';
        }).join('');
        container.innerHTML = html;
    });
}

window.editUser = function(uid) {
    if (!allUsers || !allUsers[uid]) {
        showToast('Data user tidak ditemukan.', 'error');
        return;
    }
    var u = allUsers[uid];
    document.getElementById('manageUid').value = uid;
    document.getElementById('manageName').value = u.name || '';
    document.getElementById('manageRole').value = u.role || 'Staff';
    if (document.getElementById('manageStatus')) {
        document.getElementById('manageStatus').value = (u.isActive === false) ? "false" : "true";
    }
    
    var deptSel = document.getElementById('manageDept');
    if (deptSel) {
        deptSel.value = (u.department !== undefined) ? u.department : '';
    }
    var workDaysSel = document.getElementById('manageWorkDays');
    if (workDaysSel) {
        workDaysSel.value = u.workDays || '5';
    }
    
    onRoleChange();
    var watchSel = document.getElementById('manageWatchDept');
    if (watchSel && u.watchDepartment) watchSel.value = u.watchDepartment;

    window.scrollTo({ top: 0, behavior: 'smooth' });
};

window.resetUserPassword = function(uid) {
    if (!allUsers || !allUsers[uid]) return;
    var u = allUsers[uid];
    var email = u.email;
    if (!email) {
        showToast('Tidak ada email untuk user ini.', 'error');
        return;
    }
    
    if (confirm('Kirim email reset password ke ' + email + '?')) {
        firebase.auth().sendPasswordResetEmail(email)
            .then(function() {
                showToast('Email reset password berhasil dikirim ke ' + email, 'success');
            })
            .catch(function(error) {
                showToast('Gagal mengirim email reset: ' + error.message, 'error');
            });
    }
};

window.migrateOldData = function() {
    if (!currentUser || currentUser.role !== 'SuperAdmin') return;
    if (!confirm(
        'Konfirmasi Migrasi Data:\n\n' +
        '1. Semua TUGAS tanpa UID → akan di-assign ke akun Anda (' + currentUser.email + ')\n' +
        '2. Semua CATATAN tanpa UID → akan di-assign ke akun Anda\n' +
        '3. RUTINITAS lama → akan dipindah ke path baru agar muncul kembali\n\n' +
        'Lanjutkan?'
    )) return;

    var report = { tasks: 0, notes: 0, routinesMoved: false };
    var batch  = {};

    // ── STEP 1: Migrate Tasks ─────────────────────────────────
    tasks.forEach(function(t) {
        var dirty = false;
        var patch = {};
        if (!t.uid)        { patch.uid        = currentUser.uid;                      dirty = true; }
        if (!t.department) { patch.department  = currentUser.department || 'Marketing'; dirty = true; }
        if (t.startTime === undefined) { patch.startTime = ''; dirty = true; }
        if (t.endTime   === undefined) { patch.endTime   = ''; dirty = true; }
        if (dirty && t.id) {
            batch['tasks/' + t.id] = Object.assign({}, t, patch);
            report.tasks++;
        }
    });

    // ── STEP 2: Migrate Notes ─────────────────────────────────
    // Notes tanpa uid tidak muncul karena listener filter by uid
    db.ref('notes').once('value').then(function(notesSnap) {
        var notesVal = notesSnap.val() || {};
        Object.keys(notesVal).forEach(function(noteKey) {
            var n = notesVal[noteKey];
            if (!n || !n.id) return;
            if (!n.uid) {
                batch['notes/' + noteKey] = Object.assign({}, n, { uid: currentUser.uid });
                report.notes++;
            }
        });

        // ── STEP 3: Migrate Routines ──────────────────────────
        // Old path: routines/daily, routines/weekly, routines/monthly (global)
        // New path: routines/${uid}/daily, etc.
        db.ref('routines').once('value').then(function(routSnap) {
            var routVal = routSnap.val() || {};

            // Deteksi apakah ini struktur lama (ada key 'daily'/'weekly'/'monthly' langsung di root routines)
            var hasOldStructure = routVal.daily !== undefined || routVal.weekly !== undefined || routVal.monthly !== undefined;

            if (hasOldStructure) {
                // Pindahkan ke path per-uid
                var newRoutines = {
                    daily:   routVal.daily   || [],
                    weekly:  routVal.weekly  || [],
                    monthly: routVal.monthly || []
                };
                batch['routines/' + currentUser.uid] = newRoutines;

                // Hapus keys lama di root routines (bukan uid-based)
                if (routVal.daily   !== undefined) batch['routines/daily']   = null;
                if (routVal.weekly  !== undefined) batch['routines/weekly']  = null;
                if (routVal.monthly !== undefined) batch['routines/monthly'] = null;

                report.routinesMoved = true;
            }

            // ── COMMIT semua perubahan sekaligus ──────────────
            if (Object.keys(batch).length === 0) {
                showToast('Tidak ada data yang perlu dimigrasi.', 'info');
                return;
            }

            db.ref().update(batch).then(function() {
                var lines = [];
                if (report.tasks > 0)       lines.push('✅ ' + report.tasks + ' tugas berhasil diberi UID');
                if (report.notes > 0)       lines.push('✅ ' + report.notes + ' catatan berhasil diberi UID');
                if (report.routinesMoved)   lines.push('✅ Rutinitas dipindah ke path baru — Atur Rutinitas akan muncul kembali setelah refresh');
                if (lines.length === 0)     lines.push('ℹ️ Semua data sudah up-to-date, tidak ada perubahan.');

                var resultEl = document.getElementById('migrateResult');
                if (resultEl) {
                    resultEl.innerHTML = lines.join('<br>');
                    resultEl.classList.remove('hidden');
                }
                showToast('Migrasi selesai! Silakan refresh halaman.', 'success');
            }).catch(function(e) {
                showToast('Migrasi gagal: ' + e.message, 'error');
            });

        }).catch(function(e) {
            showToast('Gagal baca rutinitas: ' + e.message, 'error');
        });

    }).catch(function(e) {
        showToast('Gagal baca catatan: ' + e.message, 'error');
    });
};

window.cleanupDuplicates = function() {
    if (!currentUser || currentUser.role !== 'SuperAdmin') return;
    if (!confirm('Peringatan: Script ini akan memindai seluruh tugas dan menghapus data ganda (duplikat) yang disebabkan oleh sisa import JSON lama.\n\nLanjutkan?')) return;

    db.ref('tasks').once('value').then(function(snap) {
        var tasksVal = snap.val() || {};
        var batch = {};
        var deletedCount = 0;

        Object.keys(tasksVal).forEach(function(key) {
            var t = tasksVal[key];
            if (!t) return;

            // Jika key Firebase (misal "0", "1") tidak sama dengan t.id (misal "task-123")
            // kita hapus key Firebase yang salah tersebut karena versi t.id sudah dibuat oleh migrasi
            if (t.id && key !== t.id) {
                batch['tasks/' + key] = null;
                deletedCount++;
            }
        });

        if (deletedCount === 0) {
            showToast('Tidak ditemukan data ganda.', 'info');
            return;
        }

        db.ref().update(batch).then(function() {
            showToast('Berhasil! ' + deletedCount + ' data ganda telah dihapus. Silakan refresh halaman.', 'success');
        }).catch(function(e) {
            showToast('Gagal menghapus duplikat: ' + e.message, 'error');
        });
    }).catch(function(e) {
        showToast('Gagal baca tugas: ' + e.message, 'error');
    });
};

function migrateDepartment() {
    var oldD = (document.getElementById('migrateOldDept').value || '').trim();
    var newD = (document.getElementById('migrateNewDept').value || '').trim();
    
    if (!oldD || !newD) {
        showToast('Isi kedua kolom divisi!', 'error');
        return;
    }
    
    if (oldD === newD) {
        showToast('Divisi sama, tidak ada yang diubah.', 'warning');
        return;
    }
    
    if (!confirm('PENTING: Anda yakin ingin memigrasi divisi "' + oldD + '" menjadi "' + newD + '"?\nSeluruh profil user dan tugas terkait akan otomatis berubah.')) return;
    
    var batch = {};
    var count = 0;
    
    // 1. Update di tasks
    tasks.forEach(function(t) {
        var d = t.department || 'Tidak Diketahui';
        if (d === oldD) {
            batch['tasks/' + t.id + '/department'] = newD;
            count++;
        }
    });
    
    // 2. Update di profiles pengguna
    Object.keys(allUsers).forEach(function(uid) {
        var u = allUsers[uid];
        if (u.department === oldD) {
            batch['users/' + uid + '/department'] = newD;
            count++;
        }
        if (u.watchDepartment === oldD) {
            batch['users/' + uid + '/watchDepartment'] = newD;
            count++;
        }
    });
    
    if (count === 0) {
        showToast('Tidak ada data divisi "' + oldD + '" yang ditemukan.', 'error');
        return;
    }
    
    db.ref().update(batch)
        .then(function() {
            showToast('Berhasil memigrasi ' + count + ' baris data dari "' + oldD + '" ke "' + newD + '".', 'success');
            document.getElementById('migrateOldDept').value = '';
            document.getElementById('migrateNewDept').value = '';
            // Render ulang user list
            setTimeout(function() {
                var c = document.getElementById('viewContainer');
                if (c) renderUsersView(c);
            }, 1000);
        })
        .catch(function(e) {
            showToast('Gagal memigrasi: ' + e.message, 'error');
        });
}
