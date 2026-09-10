/**
 * demo-data.js — Campaign SIMASRIM
 * Data demo representatif untuk menunjukkan semua fitur CRM bekerja
 * (Identik pola dengan /ppob/js/demo-data.js)
 */

function loadDemoData() {
    const now = new Date().toISOString().split('T')[0];

    // ── Demo leads WA ─────────────────────────────────────────────
    const waLeads = {
        '628111222001': { phone:'628111222001', nama_agen:'Wahana Tajur', brand:'Wahana', area:'Bogor', alamat:'Jl. Raya Tajur No. 5', pic_campaign:'Dinda', pic_garap:'Winda', tahap:'PESAN 1', tanggal_kirim:['14/07/2026'], respon:'Mau info lebih lanjut', aksi_lanjutan:'Kirim brosur', keterangan:'Sudah punya toko', tipe_leads:'Warm', created_at:'2026-07-10', updated_at:now },
        '628111222002': { phone:'628111222002', nama_agen:'Koperasi Maju Jaya', brand:'Koperasi', area:'Bogor', alamat:'Jl. Sudirman No. 12', pic_campaign:'Dinda', pic_garap:'Raka', tahap:'PESAN 2', tanggal_kirim:['10/07/2026','14/07/2026'], respon:'Daftar sekarang, mau gabung', aksi_lanjutan:'Proses pendaftaran', keterangan:'', tipe_leads:'Hot', created_at:'2026-07-08', updated_at:now },
        '628111222003': { phone:'628111222003', nama_agen:'Toko Berkah Abadi', brand:'Wahana', area:'Bogor', alamat:'Jl. Pahlawan No. 7', pic_campaign:'Dinda', pic_garap:'Winda', tahap:'PESAN 1', tanggal_kirim:['14/07/2026'], respon:'Tidak tertarik', aksi_lanjutan:'', keterangan:'Sudah mitra kompetitor', tipe_leads:'Cold / Dead', created_at:'2026-07-10', updated_at:now },
        '628111222004': { phone:'628111222004', nama_agen:'Agen Pulsa Sukses', brand:'Wahana', area:'Depok', alamat:'Jl. Margonda No. 45', pic_campaign:'Ratna', pic_garap:'Dewi', tahap:'', tanggal_kirim:[], respon:'', aksi_lanjutan:'', keterangan:'', tipe_leads:'New', created_at:'2026-07-14', updated_at:now },
        '628111222005': { phone:'628111222005', nama_agen:'Warung Pak Soemadi', brand:'Wahana', area:'Depok', alamat:'Jl. Limo No. 3', pic_campaign:'Ratna', pic_garap:'Dewi', tahap:'PESAN 1', tanggal_kirim:['15/07/2026'], respon:'Gimana cara daftarnya?', aksi_lanjutan:'Jelaskan prosedur', keterangan:'', tipe_leads:'Warm', created_at:'2026-07-12', updated_at:now },
        '628111222006': { phone:'628111222006', nama_agen:'Mini Market 86', brand:'Koperasi', area:'Depok', alamat:'Jl. Beji No. 22', pic_campaign:'Ratna', pic_garap:'Raka', tahap:'FOLLOW UP', tanggal_kirim:['12/07/2026','16/07/2026'], respon:'Iya siap gabung bulan depan', aksi_lanjutan:'Reminder H-7', keterangan:'Deal verbal', tipe_leads:'Hot', created_at:'2026-07-09', updated_at:now },
        '628111222007': { phone:'628111222007', nama_agen:'Laundry Kilat', brand:'Wahana', area:'Bekasi', alamat:'Jl. Ahmad Yani No. 11', pic_campaign:'Dinda', pic_garap:'Rina', tahap:'PESAN 1', tanggal_kirim:['14/07/2026'], respon:'Blokir aja', aksi_lanjutan:'', keterangan:'', tipe_leads:'Cold / Dead', created_at:'2026-07-10', updated_at:now },
        '628111222008': { phone:'628111222008', nama_agen:'Apotek Sehat Selalu', brand:'Koperasi', area:'Bekasi', alamat:'Jl. Rawa Lumbu No. 5', pic_campaign:'Ratna', pic_garap:'Rina', tahap:'PESAN 2', tanggal_kirim:['11/07/2026','15/07/2026'], respon:'Brosurnya dikirim ke sini ya', aksi_lanjutan:'Kirim email brosur', keterangan:'Punya 3 cabang', tipe_leads:'Warm', created_at:'2026-07-08', updated_at:now },
        '628111222009': { phone:'628111222009', nama_agen:'Bengkel Motor Jaya', brand:'Wahana', area:'Tangerang', alamat:'Jl. Daan Mogot No. 88', pic_campaign:'Budi', pic_garap:'Sari', tahap:'', tanggal_kirim:[], respon:'', aksi_lanjutan:'', keterangan:'', tipe_leads:'New', created_at:'2026-07-15', updated_at:now },
        '628111222010': { phone:'628111222010', nama_agen:'Salon Cantik Modern', brand:'Wahana', area:'Tangerang', alamat:'Jl. Gajah Mada No. 14', pic_campaign:'Budi', pic_garap:'Sari', tahap:'PESAN 1', tanggal_kirim:['15/07/2026'], respon:'Apa itu program SIMASRIM?', aksi_lanjutan:'Kirim penjelasan', keterangan:'', tipe_leads:'Warm', created_at:'2026-07-13', updated_at:now },
        '628111222011': { phone:'628111222011', nama_agen:'Toko Elektronik Murah', brand:'Koperasi', area:'Jakarta', alamat:'Jl. Hayam Wuruk No. 99', pic_campaign:'Budi', pic_garap:'Dian', tahap:'PESAN 3', tanggal_kirim:['05/07/2026','10/07/2026','15/07/2026'], respon:'Mau daftar, hubungi besok ya', aksi_lanjutan:'Call besok jam 10', keterangan:'Owner langsung', tipe_leads:'Hot', created_at:'2026-07-03', updated_at:now },
        '628111222012': { phone:'628111222012', nama_agen:'Rumah Makan Sederhana', brand:'Wahana', area:'Jakarta', alamat:'Jl. Tebet No. 15', pic_campaign:'Budi', pic_garap:'Dian', tahap:'CLOSING', tanggal_kirim:['01/07/2026','08/07/2026','14/07/2026'], respon:'Deal! Transfer sekarang', aksi_lanjutan:'Konfirmasi admin', keterangan:'Closing berhasil', tipe_leads:'Hot', created_at:'2026-07-01', updated_at:now },
        '628111222013': { phone:'628111222013', nama_agen:'Butik Fashion Terkini', brand:'Wahana', area:'Bandung', alamat:'Jl. Braga No. 20', pic_campaign:'Dinda', pic_garap:'Layla', tahap:'PESAN 1', tanggal_kirim:['16/07/2026'], respon:'', aksi_lanjutan:'', keterangan:'', tipe_leads:'New', created_at:'2026-07-14', updated_at:now },
        '628111222014': { phone:'628111222014', nama_agen:'Percetakan Digital Prima', brand:'Koperasi', area:'Bandung', alamat:'Jl. Asia Afrika No. 55', pic_campaign:'Dinda', pic_garap:'Layla', tahap:'PESAN 1', tanggal_kirim:['16/07/2026'], respon:'Bisa dijelasin keuntungannya?', aksi_lanjutan:'Video call', keterangan:'Tertarik tapi minta demo', tipe_leads:'Warm', created_at:'2026-07-14', updated_at:now },
        '628111222015': { phone:'628111222015', nama_agen:'Travel Agent Nusantara', brand:'Wahana', area:'Surabaya', alamat:'Jl. Basuki Rahmat No. 7', pic_campaign:'Ratna', pic_garap:'Andi', tahap:'PESAN 2', tanggal_kirim:['09/07/2026','14/07/2026'], respon:'Oke, mau coba dulu', aksi_lanjutan:'Onboarding', keterangan:'', tipe_leads:'Hot', created_at:'2026-07-07', updated_at:now },
        '628111222016': { phone:'628111222016', nama_agen:'Klinik Pratama Sehat', brand:'Koperasi', area:'Surabaya', alamat:'Jl. Pemuda No. 33', pic_campaign:'Ratna', pic_garap:'Andi', tahap:'', tanggal_kirim:[], respon:'', aksi_lanjutan:'', keterangan:'', tipe_leads:'New', created_at:'2026-07-15', updated_at:now },
        '628111222017': { phone:'628111222017', nama_agen:'Toko Buku Ilmu', brand:'Wahana', area:'Yogyakarta', alamat:'Jl. Malioboro No. 101', pic_campaign:'Budi', pic_garap:'Sari', tahap:'PESAN 1', tanggal_kirim:['15/07/2026'], respon:'Tolak aja', aksi_lanjutan:'', keterangan:'', tipe_leads:'Cold / Dead', created_at:'2026-07-13', updated_at:now },
        '628111222018': { phone:'628111222018', nama_agen:'Distro Anak Muda', brand:'Wahana', area:'Yogyakarta', alamat:'Jl. Kaliurang No. 5', pic_campaign:'Budi', pic_garap:'Dian', tahap:'FOLLOW UP', tanggal_kirim:['07/07/2026','14/07/2026'], respon:'Gimana cara bayarnya?', aksi_lanjutan:'Jelaskan metode pembayaran', keterangan:'', tipe_leads:'Warm', created_at:'2026-07-05', updated_at:now },
        '628111222019': { phone:'628111222019', nama_agen:'Hotel Melati Indah', brand:'Koperasi', area:'Bali', alamat:'Jl. Legian No. 88', pic_campaign:'Dinda', pic_garap:'Layla', tahap:'PESAN 1', tanggal_kirim:['16/07/2026'], respon:'Harga promo berapa?', aksi_lanjutan:'Kirim penawaran', keterangan:'', tipe_leads:'Warm', created_at:'2026-07-14', updated_at:now },
        '628111222020': { phone:'628111222020', nama_agen:'Cafe Kopi Nusantara', brand:'Wahana', area:'Bali', alamat:'Jl. Seminyak No. 12', pic_campaign:'Dinda', pic_garap:'Layla', tahap:'CLOSING', tanggal_kirim:['01/07/2026','08/07/2026','15/07/2026'], respon:'Siap gabung, langsung proses', aksi_lanjutan:'Admin processing', keterangan:'Referral dari mitra lain', tipe_leads:'Hot', created_at:'2026-06-28', updated_at:now },
    };

    // ── Demo leads Email ──────────────────────────────────────────
    const emailLeads = {
        'info_at_wahana_dot_co_dot_id':   { email:'info@wahana.co.id', nama_agen:'Wahana Head Office', brand:'Wahana', area:'Jakarta', alamat:'Jl. Gatot Subroto Kav 72', pic_campaign:'Budi', pic_garap:'Dian', tahap:'PESAN 1', tanggal_kirim:['14/07/2026'], respon:'', aksi_lanjutan:'', keterangan:'Email korporat', tipe_leads:'New', created_at:'2026-07-10', updated_at:now },
        'kopekss_at_gmail_dot_com':        { email:'kopekss@gmail.com', nama_agen:'Koperasi Eks Senen', brand:'Koperasi', area:'Jakarta', alamat:'Jl. Senen Raya No. 5', pic_campaign:'Budi', pic_garap:'Dian', tahap:'PESAN 2', tanggal_kirim:['10/07/2026','14/07/2026'], respon:'Brosur email diterima, lagi dikaji', aksi_lanjutan:'Follow up 5 hari', keterangan:'', tipe_leads:'Warm', created_at:'2026-07-08', updated_at:now },
        'tokomakmur88_at_yahoo_dot_com':   { email:'tokomakmur88@yahoo.com', nama_agen:'Toko Makmur 88', brand:'Wahana', area:'Bogor', alamat:'Jl. Pajajaran No. 8', pic_campaign:'Dinda', pic_garap:'Winda', tahap:'PESAN 1', tanggal_kirim:['15/07/2026'], respon:'Minat sekali, kapan bisa meeting?', aksi_lanjutan:'Jadwalkan zoom', keterangan:'', tipe_leads:'Hot', created_at:'2026-07-11', updated_at:now },
        'admin_at_kliniksehat_dot_id':     { email:'admin@kliniksehat.id', nama_agen:'Klinik Sehat Plus', brand:'Koperasi', area:'Depok', alamat:'Jl. Raya Sawangan No. 3', pic_campaign:'Ratna', pic_garap:'Raka', tahap:'', tanggal_kirim:[], respon:'', aksi_lanjutan:'', keterangan:'', tipe_leads:'New', created_at:'2026-07-14', updated_at:now },
        'cv_maju_at_outlook_dot_com':      { email:'cv.maju@outlook.com', nama_agen:'CV Maju Bersama', brand:'Wahana', area:'Bekasi', alamat:'Jl. Kalimalang No. 20', pic_campaign:'Ratna', pic_garap:'Rina', tahap:'FOLLOW UP', tanggal_kirim:['08/07/2026','14/07/2026'], respon:'Sudah baca email, mau tanya lebih lanjut', aksi_lanjutan:'Balas email detail', keterangan:'', tipe_leads:'Warm', created_at:'2026-07-06', updated_at:now },
        'restoran_jaya_at_gmail_dot_com':  { email:'restoran.jaya@gmail.com', nama_agen:'Restoran Jaya Raya', brand:'Koperasi', area:'Tangerang', alamat:'Jl. Pasar Lama No. 15', pic_campaign:'Budi', pic_garap:'Sari', tahap:'PESAN 3', tanggal_kirim:['05/07/2026','10/07/2026','15/07/2026'], respon:'Tidak, tutup dulu toko saya', aksi_lanjutan:'', keterangan:'Temporary close', tipe_leads:'Cold / Dead', created_at:'2026-07-03', updated_at:now },
        'agensi_kreatif_at_gmail_dot_com': { email:'agensi.kreatif@gmail.com', nama_agen:'Agensi Kreatif Digital', brand:'Wahana', area:'Bandung', alamat:'Jl. Dago No. 5', pic_campaign:'Dinda', pic_garap:'Layla', tahap:'PESAN 1', tanggal_kirim:['16/07/2026'], respon:'Gimana sistemnya?', aksi_lanjutan:'Kirim deck presentasi', keterangan:'Startup kecil', tipe_leads:'Warm', created_at:'2026-07-14', updated_at:now },
        'hr_at_ptsukses_dot_co_dot_id':   { email:'hr@ptsukses.co.id', nama_agen:'PT Sukses Makmur', brand:'Koperasi', area:'Surabaya', alamat:'Jl. HR Muhammad No. 100', pic_campaign:'Ratna', pic_garap:'Andi', tahap:'CLOSING', tanggal_kirim:['01/07/2026','08/07/2026','15/07/2026'], respon:'Deal! MOU minggu depan', aksi_lanjutan:'Prepare MOU dokumen', keterangan:'Perusahaan besar', tipe_leads:'Hot', created_at:'2026-06-28', updated_at:now },
    };

    // Suntikkan _key (nama properti object ini) ke tiap lead, supaya checkbox/edit/
    // hapus/broadcast/copy per baris bisa membedakan satu leads dengan leads lainnya
    // (lihat catatan yang sama di loadAllData(), js/app.js).
    Object.keys(waLeads).forEach(k => { waLeads[k]._key = k; });
    Object.keys(emailLeads).forEach(k => { emailLeads[k]._key = k; });

    // Populate ke AppState
    AppState.leads_wa    = waLeads;
    AppState.leads_email = emailLeads;

    // Simpan ke sessionStorage agar tidak hilang saat refresh
    sessionStorage.setItem('campaign_demo', 'ok');

    showToast('✅ Data demo berhasil dimuat! (20 WA + 8 Email leads)', 'success');

    // Render (termasuk isi dropdown filter Area/Brand/PIC/Tahap — sebelumnya kelewat
    // di jalur demo, jadi filter dropdown selalu kosong dan tidak bisa dipilih)
    CRMTracker.buildHeader(AppState.mode);
    updateFilterOptions();
    renderDashboard();
    renderLeadsTable();
    updateBadges();
    updateDbStatus('ok');

    // Tampilkan banner demo
    const banner = document.getElementById('demo-banner');
    if (banner) banner.style.display = 'none';
}
