/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/guide.js — User Guide & SOP View
   Akses: Semua role
   ============================================================ */

function renderGuideView(c) {
    var role = currentUser ? currentUser.role : 'Staff';

    var sections = [
        {
            color: 'teal', icon: 'fa-gears', title: 'Pengaturan Akun & Jam Kerja',
            items: [
                'Klik tombol <b>Pengaturan Akun</b> di menu profil (kiri bawah) untuk mengatur <b>Jam Masuk, Jam Pulang, dan Jadwal Istirahat</b> Anda.',
                '<b>Jam Istirahat Dinamis:</b> Jika suatu hari Anda istirahat jam 14:30 (bukan jam 12:00), tidak perlu khawatir. Beban kerja dihitung dari <i>total menit tugas murni</i>, bukan patokan jam kaku.',
                '<b>Smart Conflict Warning:</b> Sistem akan mencegah/memberi peringatan jika atasan mendelegasikan tugas di jam istirahat yang Anda atur.',
                '<b>Visual Timeline:</b> Di layar <b>Hari Ini</b>, ada garis waktu visual berwarna untuk melihat sebaran tugas, meeting, dan jam istirahat secara intuitif!'
            ]
        },
        {
            color: 'violet', icon: 'fa-bolt', title: 'Pekerjaan Harian & Tunggakan',
            items: [
                'Setiap pagi, buka menu <b>Hari Ini</b> untuk melihat apa saja yang harus dikerjakan hari ini.',
                'Untuk menambahkan tugas baru, klik tombol ungu <b>INPUT BARU</b> di kanan atas.',
                'Jika tugas sudah selesai, cukup klik ikon centang hijau di tugas tersebut.',
                '<b>Tunggakan (Terlambat):</b> Tugas yang tenggat waktunya sudah lewat namun belum selesai akan muncul di bagian bawah halaman dengan latar merah sebagai pengingat. Klik untuk segera menyelesaikannya.'
            ]
        },
        {
            color: 'blue', icon: 'fa-message', title: 'Pesan Internal & Grup Chat',
            items: [
                'Di pojok kanan atas, ada ikon <b>Amplop</b> dan ikon <b>Lonceng (Kotak Masuk)</b>.',
                '<b>Ikon Amplop (Pesan Internal):</b> Klik ini untuk membuka jendela pesan. Di dalamnya ada dua tab:<br>&bull; <b>[Japri]</b> — Chat langsung 2 arah (seperti WhatsApp) dengan rekan/atasan.<br>&bull; <b>[Grup Divisi]</b> — Chat ramai dengan seluruh anggota divisi. Untuk SuperAdmin/Direktur, tersedia dropdown untuk berpindah antar divisi.',
                '<b>Lampiran:</b> Di kedua jenis chat (Japri & Grup), Anda bisa mengirim file/gambar dengan mengklik ikon <b>Klip Kertas</b>. File akan tersimpan di server lokal secara otomatis.',
                '<b>Ikon Lonceng:</b> Notifikasi otomatis dari sistem (misalnya: ada tugas delegasi baru). Sifatnya informasi satu arah.',
                'Angka merah di ikon Amplop menunjukkan total pesan belum terbaca dari Japri dan Grup Chat.'
            ]
        },
        {
            color: 'orange', icon: 'fa-folder-tree', title: 'Mengelola Proyek & Tugas',
            items: [
                'Buka menu <b>Proyek & Papan Kanban</b> untuk melihat semua tugas Anda yang dikelompokkan berdasarkan nama proyek.',
                'Gunakan tombol <b>Filter Status</b> di bagian atas (Semua, Aktif, Selesai, dll) agar tampilan tidak terlalu penuh.',
                'Untuk mengganti nama proyek secara masal pada semua tugasnya, cukup klik tombol <b>Ganti Nama</b> di sebelah nama proyek.',
                'Jangan khawatir, setelah Anda menyimpan perubahan pada sebuah tugas, layar tidak akan lompat kembali ke atas (posisi akan tetap pada tempatnya).'
            ]
        },
        {
            color: 'emerald', icon: 'fa-clock-rotate-left', title: 'Mencari Data & Arsip',
            items: [
                'Semua tugas Anda yang sudah lalu tersimpan rapi di menu <b>Arsip & Riwayat</b>.',
                'Anda dapat <b>mengurutkan data</b> (seperti A-Z atau dari yang terbaru) hanya dengan mengklik judul kolom di tabel (contoh: klik tulisan "Proyek" atau "Status").',
                'Untuk mencari kata kunci tertentu di seluruh aplikasi, cukup tekan tombol <kbd>Ctrl+F</kbd> (Windows) atau <kbd>Cmd+F</kbd> (Mac).'
            ]
        },
        {
            color: 'pink', icon: 'fa-users-rectangle', title: 'Mencatat Rapat',
            items: [
                'Saat membuat tugas baru, pilih tipe <b>Meeting / Jadwal</b>.',
                'Pastikan mengisi <b>Jam Mulai</b> dan <b>Jam Selesai</b> dengan benar agar sistem tahu kapan Anda sedang sibuk rapat.',
                'Tulis ringkasan hasil rapat (atau link Google Docs) di kolom Deskripsi agar mudah dicari nanti.'
            ]
        },
        {
            color: 'yellow', icon: 'fa-repeat', title: 'Tugas Berulang (Rutinitas)',
            items: [
                'Jika Anda punya pekerjaan yang harus dilakukan tiap hari, minggu, atau bulan, buatlah di menu <b>Automasi & Rutinitas</b>.',
                'Tugas harian akan dilewati sesuai <b>Pengaturan Hari Kerja</b> Anda (Misal: Senin-Jumat) dan Hari Libur nasional. <br><i class="fa-solid fa-share-nodes text-emerald-400 mt-2"></i> <b>Bagi Rutinitas:</b> Anda kini dapat menugaskan/mendelegasikan Rutinitas kepada staf lain. Target staf akan mendapat notifikasi Lonceng otomatis!',
                'Hari Libur dapat diatur dengan mengklik tombol <b>Libur & Cuti</b> di halaman tersebut.'
            ]
        },
        {
            color: 'emerald', icon: 'fa-share-nodes', title: 'Memberi Tugas ke Bawahan (Khusus Atasan)',
            items: [
                'Gunakan tombol hijau <b>BAGI TASK</b> di kanan atas untuk mendelegasikan tugas ke tim Anda.',
                'Pilih nama anggota tim di kolom <b>Tugaskan Ke</b>.',
                'Atasan (Supervisor) dapat memantau perkembangan tugas timnya di menu <b>Panel Supervisor</b>.',
                'Jika bawahan sudah menyelesaikan tugasnya, sistem otomatis akan memberi Anda laporan.',
                '<b>Laporan Kinerja (Analytics):</b> Gunakan tombol <b>Tampilkan Rutinitas</b> di kartu Produktivitas Mingguan untuk menyertakan tugas rutin dalam perhitungan kinerja — sangat berguna untuk tim yang kerjanya berbasis rutinitas.'
            ]
        },
        {
            color: 'blue', icon: 'fa-shield-halved', title: 'Batasan Hak Akses',
            items: [
                '<b>Magang & Staff</b>: Mengurus pekerjaannya sendiri.',
                '<b>Supervisor</b>: Memantau dan memberi tugas kepada staf di divisinya.',
                '<b>Dept Executive</b>: Memantau laporan seluruh staf dalam satu divisi.',
                '<b>Executive</b>: Memantau laporan kinerja seluruh perusahaan.',
                '<b>SuperAdmin</b>: Memiliki akses penuh ke seluruh pengaturan.'
            ]
        }
    ];

    // Sembunyikan section Notifikasi & Komunikasi untuk Executive & DeptExecutive (karena mereka read-only)
    if (role === 'Executive' || role === 'DeptExecutive') {
        sections = sections.filter(function(s) { return s.icon !== 'fa-bell'; });
    }

    // Sembunyikan section Delegasi (Pendelegasian Tugas) jika bukan SPV/SuperAdmin
    if (role !== 'SuperAdmin' && role !== 'Supervisor') {
        sections = sections.filter(function(s) { return s.icon !== 'fa-share-nodes'; });
    }

    // Sembunyikan section Panel SPV jika bukan SPV/SuperAdmin
    if (role !== 'SuperAdmin' && role !== 'Supervisor') {
        sections = sections.filter(function(s) { return s.icon !== 'fa-people-roof'; });
    }
    
    // Sembunyikan Hirarki Akses jika bukan SuperAdmin
    if (role !== 'SuperAdmin') {
        sections = sections.filter(function(s) { return s.icon !== 'fa-shield-halved'; });
    }

    var colorMap = {
        violet:  { border: 'border-violet-500/30',  text: 'text-violet-400'  },
        pink:    { border: 'border-pink-500/30',    text: 'text-pink-400'    },
        emerald: { border: 'border-emerald-500/30', text: 'text-emerald-400' },
        blue:    { border: 'border-blue-500/30',    text: 'text-blue-400'    },
        orange:  { border: 'border-orange-500/30',  text: 'text-orange-400'  },
        yellow:  { border: 'border-yellow-500/30',  text: 'text-yellow-400'  },
        teal:    { border: 'border-teal-500/30',    text: 'text-teal-400'    }
    };

    var sectionHtml = sections.map(function(s, index) {
        var clr   = colorMap[s.color] || colorMap.violet;
        var items = s.items.map(function(item) {
            return '<li class="leading-relaxed">' + item + '</li>';
        }).join('');
        return '<div class="card-bg p-5 rounded-xl border ' + clr.border + '">' +
            '<h3 class="text-sm font-bold ' + clr.text + ' mb-3 flex items-center gap-2">' +
            '<i class="fa-solid ' + s.icon + '"></i> ' + (index + 1) + '. ' + s.title + '</h3>' +
            '<ul class="list-disc list-inside text-xs text-gray-300 space-y-2">' + items + '</ul>' +
            '</div>';
    }).join('');

    var myTaskCount = tasks.filter(function(t) { return t.uid === currentUser.uid; }).length;
    var myDoneCount = tasks.filter(function(t) { return t.uid === currentUser.uid && t.status === 'Done'; }).length;

    c.innerHTML = '<div class="max-w-3xl mx-auto space-y-5 animate-fadein pb-10">' +

        '<div class="bg-gradient-to-r from-violet-900/30 to-transparent p-6 rounded-xl border border-violet-500/20">' +
        '<h2 class="text-2xl font-bold text-white mb-2 flex items-center gap-3">' +
        '<i class="fa-solid fa-book-open-reader text-violet-400"></i> Buku Panduan PT SMA Enterprise OS CLOUD v10.3</h2>' +
        '<p class="text-sm text-gray-400">Panduan cara menggunakan sistem untuk mempermudah pekerjaan sehari-hari seluruh karyawan.</p>' +
        '<p class="text-[10px] text-gray-600 mt-1">Terakhir diperbarui: <span class="text-violet-400 font-bold">Juli 2026</span> (Fase 3.7–3.9 + Batch Update)</p>' +
        '<div class="flex gap-6 mt-4">' +
        '<div class="text-center"><p class="text-lg font-bold text-white">' + myTaskCount + '</p><p class="text-[10px] text-gray-500">Tugas Anda</p></div>' +
        '<div class="text-center"><p class="text-lg font-bold text-emerald-400">' + myDoneCount + '</p><p class="text-[10px] text-gray-500">Selesai</p></div>' +
        '<div class="text-center"><p class="text-xs font-bold text-violet-300 mt-1">' + role + '</p><p class="text-[10px] text-gray-500">Role Anda</p></div>' +
        '</div></div>' +

        '<div class="space-y-4">' + sectionHtml + '</div>' +

        (function(){
            var currentSA = Object.values(allUsers).find(function(u){return u.role==='SuperAdmin'});
            var saLabel = (currentSA && currentSA.name ? currentSA.name : 'SuperAdmin') + ' (SuperAdmin)';
            return '<div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-4 text-center">' +
            '<p class="text-xs text-gray-500">Ada masalah atau pertanyaan? Hubungi ' +
            '<span onclick="var sa=Object.values(allUsers).find(function(u){return u.role===\'SuperAdmin\'}); if(sa){ document.getElementById(\'messageModal\').classList.remove(\'hidden\'); if(typeof renderMessages===\'function\') renderMessages(); setTimeout(function(){openMessageThread(sa.uid);}, 100); } else { showToast(\'SuperAdmin tidak ditemukan\', \'error\'); }" class="text-violet-400 font-semibold cursor-pointer hover:text-violet-300 hover:underline transition">' + saLabel + '</span>.</p>' +
            '</div></div>';
        })();
}
