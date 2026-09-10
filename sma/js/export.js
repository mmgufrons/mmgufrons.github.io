/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/export.js — Data Export (JSON & CSV)
   ============================================================ */

function exportJSON() {
    const payload  = { tasks, notes, routines, holidays };
    const blob     = new Blob([JSON.stringify(payload, null, 2)], { type: 'application/json' });
    const url      = URL.createObjectURL(blob);
    const a        = document.createElement('a');
    a.href         = url;
    a.download     = `backup_SIMASRIM_${getLocalISODate()}.json`;
    a.click();
    URL.revokeObjectURL(url);
    closeModal('exportModal');
    showToast('Backup JSON berhasil diunduh!', 'success');
}

function exportCSV() {
    let csv = 'ID,Judul,Proyek,Prioritas,Tipe,Mulai,Tenggat,Selesai,Durasi(Menit),Status\n';
    tasks.forEach(t => {
        const esc = v => '"' + String(v || '').replace(/"/g, '""') + '"';
        csv += [esc(t.id), esc(t.title), esc(t.project), esc(t.priority), esc(t.type),
                esc(t.startDate), esc(t.dueDate), esc(t.endDate), esc(t.hours), esc(t.status)
               ].join(',') + '\r\n';
    });
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href     = url;
    a.download = `Laporan_SIMASRIM_${getLocalISODate()}.csv`;
    a.click();
    URL.revokeObjectURL(url);
    closeModal('exportModal');
    showToast('Laporan CSV berhasil diunduh!', 'success');
}

function getEnterpriseTasks() {
    let scopeTasks = [];
    if (currentUser.role === 'SuperAdmin' || currentUser.role === 'Direktur') {
        scopeTasks = tasks;
    } else if (currentUser.role === 'SPV') {
        const deptUids = Object.values(allUsers)
            .filter(u => u.department === currentUser.department)
            .map(u => u.uid);
        scopeTasks = tasks.filter(t => deptUids.includes(t.uid));
    } else {
        scopeTasks = tasks.filter(t => t.uid === currentUser.uid);
    }
    return scopeTasks;
}

function exportDataCSV() {
    const scopeTasks = getEnterpriseTasks();
    let csv = 'ID,Pekerja,Departemen,Judul,Proyek,Status,Durasi(Jam)\n';
    scopeTasks.forEach(t => {
        const u = allUsers[t.uid] || {};
        const userName = u.name || t.uid || 'Unknown';
        const dept = u.department || 'Umum';
        const esc = v => '"' + String(v || '').replace(/"/g, '""') + '"';
        csv += [esc(t.id), esc(userName), esc(dept), esc(t.title), esc(t.project), esc(t.status), esc(t.hours)].join(',') + '\r\n';
    });
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href     = url;
    a.download = `Enterprise_Report_${getLocalISODate()}.csv`;
    a.click();
    URL.revokeObjectURL(url);
    showToast('Laporan Enterprise CSV Berhasil Diunduh', 'success');
}

function exportDataPDF() {
    if (!window.jspdf || !window.jspdf.jsPDF) {
        showToast('Library PDF belum dimuat, silakan muat ulang!', 'error');
        return;
    }
    const doc = new window.jspdf.jsPDF();
    const scopeTasks = getEnterpriseTasks();
    
    doc.setFontSize(14);
    doc.text('Laporan Enterprise Tugas & Produktivitas', 14, 15);
    doc.setFontSize(10);
    doc.text('Tanggal: ' + getLocalISODate(), 14, 22);
    
    const tableData = scopeTasks.map(t => {
        const u = allUsers[t.uid] || {};
        const userName = u.name || 'Sistem';
        return [
            t.title || '-',
            userName,
            t.project || 'Umum',
            t.status || '-',
            t.hours || '0'
        ];
    });

    doc.autoTable({
        startY: 28,
        head: [['Judul Tugas', 'Pekerja', 'Proyek', 'Status', 'Jam']],
        body: tableData,
        theme: 'grid',
        styles: { fontSize: 8 },
        headStyles: { fillColor: [88, 28, 135] } // Tailwind Violet 900
    });

    doc.save(`Enterprise_Report_${getLocalISODate()}.pdf`);
    showToast('Laporan Enterprise PDF Berhasil Diunduh', 'success');
}
