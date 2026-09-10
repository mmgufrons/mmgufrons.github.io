// PORTOFOLIO DEMO: hash password asli dihapus (kode ini juga sudah tidak dipakai — auth memakai login MKT Hub bersama)
const AUTH_HASH = null;

async function sha256(message) {
    const msgBuffer = new TextEncoder().encode(message);
    const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
}

const dashboardManager = new DashboardManager();
let rawDatabaseData = null;
let currentSort = { column: 'date', dir: 'desc' };

document.addEventListener('DOMContentLoaded', () => {
    initAuth();
    initTabs();
    initUpload();
    initTableFilters();
    
    document.getElementById('btn-refresh').addEventListener('click', () => {
        loadDashboardData();
        showToast('Data diperbarui', 'success');
    });
    
    document.getElementById('btn-refresh-mutasi').addEventListener('click', () => {
        loadDashboardData();
        showToast('Data mutasi diperbarui', 'success');
    });

    // Edit Modal Events
    document.getElementById('btn-cancel-edit').addEventListener('click', () => {
        document.getElementById('edit-modal').classList.add('hidden');
    });
    
    document.getElementById('btn-save-edit').addEventListener('click', async () => {
        const platform = document.getElementById('edit-platform').value;
        const id = document.getElementById('edit-id').value;
        const btn = document.getElementById('btn-save-edit');
        
        const newData = {
            tanggal_order: document.getElementById('edit-tanggal').value ? new Date(document.getElementById('edit-tanggal').value).toISOString() : null,
            nama_produk: document.getElementById('edit-produk').value,
            harga_jual: parseFloat(document.getElementById('edit-harga').value) || 0,
            biaya_admin: parseFloat(document.getElementById('edit-admin').value) || 0,
            pendapatan_bersih: parseFloat(document.getElementById('edit-pendapatan').value) || 0,
        };
        
        btn.disabled = true;
        btn.innerHTML = 'Menyimpan...';
        
        try {
            await FirebaseAPI.patch(`/penjualan/${platform}/${id}`, newData);
            showToast('Data berhasil diperbarui', 'success');
            document.getElementById('edit-modal').classList.add('hidden');
            await loadDashboardData();
        } catch(e) {
            showToast('Gagal menyimpan perubahan', 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = 'Simpan Perubahan';
        }
    });
    document.getElementById('btn-cancel-mutasi-edit').addEventListener('click', () => {
        document.getElementById('edit-mutasi-modal').classList.add('hidden');
    });
    
    document.getElementById('btn-save-mutasi-edit').addEventListener('click', async () => {
        const id = document.getElementById('edit-mutasi-id').value;
        const btn = document.getElementById('btn-save-mutasi-edit');
        
        const newData = {
            tanggal_transaksi: document.getElementById('edit-mutasi-tanggal').value ? new Date(document.getElementById('edit-mutasi-tanggal').value).toISOString() : null,
            keterangan: document.getElementById('edit-mutasi-keterangan').value,
            nominal: parseFloat(document.getElementById('edit-mutasi-nominal').value) || 0,
        };
        
        btn.disabled = true;
        btn.innerHTML = 'Menyimpan...';
        
        try {
            await FirebaseAPI.patch(`/mutasi_saldo/bobcare/${id}`, newData);
            showToast('Data mutasi berhasil diperbarui', 'success');
            document.getElementById('edit-mutasi-modal').classList.add('hidden');
            await loadDashboardData();
        } catch(e) {
            showToast('Gagal menyimpan perubahan mutasi', 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = 'Simpan Perubahan';
        }
    });

    // Modal Shortcuts
    document.addEventListener('keydown', (e) => {
        if(e.key === 'Escape') {
            document.querySelectorAll('.custom-modal-overlay:not(.hidden)').forEach(modal => {
                modal.classList.add('hidden');
            });
        }
    });

    document.querySelectorAll('.custom-modal-overlay').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if(e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
});

window.openEditModal = function(platform, id) {
    if(!rawDatabaseData || !rawDatabaseData.penjualan || !rawDatabaseData.penjualan[platform] || !rawDatabaseData.penjualan[platform][id]) return;
    
    const record = rawDatabaseData.penjualan[platform][id];
    
    document.getElementById('edit-platform').value = platform;
    document.getElementById('edit-id').value = id;
    
    document.getElementById('edit-tanggal').value = record.tanggal_order ? record.tanggal_order.split('T')[0] : '';
    document.getElementById('edit-produk').value = record.nama_produk || record.type || '';
    document.getElementById('edit-harga').value = record.harga_jual || 0;
    document.getElementById('edit-admin').value = record.biaya_admin || 0;
    document.getElementById('edit-pendapatan').value = record.pendapatan_bersih || 0;
    
    document.getElementById('edit-modal').classList.remove('hidden');
}

window.openMutasiEditModal = function(id) {
    if(!rawDatabaseData || !rawDatabaseData.mutasi_saldo || !rawDatabaseData.mutasi_saldo.bobcare || !rawDatabaseData.mutasi_saldo.bobcare[id]) return;
    
    const record = rawDatabaseData.mutasi_saldo.bobcare[id];
    
    document.getElementById('edit-mutasi-id').value = id;
    
    document.getElementById('edit-mutasi-tanggal').value = record.tanggal_transaksi ? record.tanggal_transaksi.split('T')[0] : '';
    document.getElementById('edit-mutasi-keterangan').value = record.keterangan || '';
    document.getElementById('edit-mutasi-nominal').value = record.nominal || 0;
    
    document.getElementById('edit-mutasi-modal').classList.remove('hidden');
}

function initTableFilters() {
    document.getElementById('filter-platform').addEventListener('change', () => renderTable(rawDatabaseData));
    document.getElementById('filter-product').addEventListener('input', () => renderTable(rawDatabaseData));
    
    const startInput = document.getElementById('filter-date-start');
    const endInput = document.getElementById('filter-date-end');
    const presetSelect = document.getElementById('filter-date-preset');
    
    startInput.addEventListener('change', () => { presetSelect.value = ''; renderTable(rawDatabaseData); });
    endInput.addEventListener('change', () => { presetSelect.value = ''; renderTable(rawDatabaseData); });
    
    presetSelect.addEventListener('change', (e) => {
        applyDatePreset(e.target.value);
        renderTable(rawDatabaseData);
    });

    document.querySelectorAll('th[data-sort]').forEach(th => {
        th.addEventListener('click', () => {
            const col = th.getAttribute('data-sort');
            if (currentSort.column === col) {
                currentSort.dir = currentSort.dir === 'asc' ? 'desc' : 'asc';
            } else {
                currentSort.column = col;
                currentSort.dir = 'desc';
            }
            renderTable(rawDatabaseData);
        });
    });
}

function applyDatePreset(preset) {
    const startInput = document.getElementById('filter-date-start');
    const endInput = document.getElementById('filter-date-end');
    if (!preset) {
        startInput.value = '';
        endInput.value = '';
        return;
    }
    
    const end = new Date();
    let start = new Date();
    
    if (preset === 'today') {
        start.setHours(0,0,0,0);
    } else if (preset === 'this_week') {
        const day = start.getDay();
        const diff = start.getDate() - day + (day === 0 ? -6 : 1);
        start = new Date(start.setDate(diff));
        start.setHours(0,0,0,0);
    } else if (preset === 'this_month') {
        start = new Date(start.getFullYear(), start.getMonth(), 1);
    } else if (preset === 'last_1_month') {
        start.setMonth(start.getMonth() - 1);
    } else if (preset === 'last_3_months') {
        start.setMonth(start.getMonth() - 3);
    }

    startInput.value = start.toISOString().split('T')[0];
    endInput.value = end.toISOString().split('T')[0];
}

function initAuth() {
    // Login screen removed in favor of global MKT Hub login
    loadDashboardData();
}

function initTabs() {
    const navLinks = document.querySelectorAll('.nav-links li');
    const tabPanes = document.querySelectorAll('.tab-pane');
    const pageTitle = document.getElementById('page-title');

    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            if (!link.hasAttribute('data-target')) return;
            e.preventDefault();
            
            // Remove active classes
            navLinks.forEach(l => l.classList.remove('active'));
            tabPanes.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked
            link.classList.add('active');
            const targetId = link.getAttribute('data-target');
            document.getElementById(targetId).classList.add('active');
            
            // Update Title
            pageTitle.innerText = link.querySelector('span').innerText;
            
            if(targetId === 'dashboard' && rawDatabaseData) {
                // Short timeout allows tab transition before rendering
                setTimeout(() => dashboardManager.renderCharts(rawDatabaseData), 50);
            }
        });
    });
}

function initUpload() {
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    const fileDetails = document.getElementById('file-details');
    const fileNameDisplay = document.getElementById('file-name');
    const uploadPrompt = document.querySelector('.upload-prompt');
    const btnRemove = document.getElementById('btn-remove');
    const btnProcess = document.getElementById('btn-process');
    
    let selectedFile = null;

    dropZone.addEventListener('click', () => {
        if(!selectedFile) fileInput.click();
    });

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        if (e.dataTransfer.files.length) {
            handleFileSelection(e.dataTransfer.files[0]);
        }
    });

    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length) {
            handleFileSelection(e.target.files[0]);
        }
    });

    function handleFileSelection(file) {
        if (!file.name.match(/\.(xlsx|xls)$/)) {
            showToast('Hanya file Excel yang diperbolehkan!', 'error');
            return;
        }
        selectedFile = file;
        fileNameDisplay.innerText = file.name;
        uploadPrompt.classList.add('hidden');
        fileDetails.classList.remove('hidden');
        btnProcess.disabled = false;
    }

    btnRemove.addEventListener('click', (e) => {
        e.stopPropagation();
        selectedFile = null;
        fileInput.value = '';
        fileDetails.classList.add('hidden');
        uploadPrompt.classList.remove('hidden');
        btnProcess.disabled = true;
    });

    btnProcess.addEventListener('click', async () => {
        if (!selectedFile) return;
        
        btnProcess.disabled = true;
        const uploadStatus = document.getElementById('upload-status');
        const progressFill = document.getElementById('progress-fill');
        const statusText = document.getElementById('status-text');
        
        uploadStatus.classList.remove('hidden');
        
        const updateProgress = (pct, text) => {
            progressFill.style.width = `${pct}%`;
            statusText.innerText = text;
        };

        try {
            // 1. Parse Excel
            const parsedData = await ExcelParser.parse(selectedFile, updateProgress);
            
            // 2. Check for duplicates
            let duplicateCount = 0;
            if (rawDatabaseData && rawDatabaseData.penjualan && parsedData && parsedData.penjualan) {
                for(const platform in parsedData.penjualan) {
                    if (rawDatabaseData.penjualan[platform]) {
                        for(const id in parsedData.penjualan[platform]) {
                            if (rawDatabaseData.penjualan[platform][id]) {
                                duplicateCount++;
                            }
                        }
                    }
                }
            }
            if (rawDatabaseData && rawDatabaseData.mutasi_saldo && rawDatabaseData.mutasi_saldo.bobcare && parsedData && parsedData.mutasi_saldo && parsedData.mutasi_saldo.bobcare) {
                for(const id in parsedData.mutasi_saldo.bobcare) {
                    if (rawDatabaseData.mutasi_saldo.bobcare[id]) {
                        duplicateCount++;
                    }
                }
            }
            
            const doUpload = async (dataToUpload) => {
                try {
                    updateProgress(90, 'Menyiapkan data (flattening)...');
                    
                    const flatPayload = {};
                    if (dataToUpload.penjualan) {
                        for (const platform in dataToUpload.penjualan) {
                            for (const id in dataToUpload.penjualan[platform]) {
                                flatPayload[`penjualan/${platform}/${id}`] = dataToUpload.penjualan[platform][id];
                            }
                        }
                    }
                    if (dataToUpload.mutasi_saldo && dataToUpload.mutasi_saldo.bobcare) {
                        for (const id in dataToUpload.mutasi_saldo.bobcare) {
                            flatPayload[`mutasi_saldo/bobcare/${id}`] = dataToUpload.mutasi_saldo.bobcare[id];
                        }
                    }
                    
                    if (Object.keys(flatPayload).length === 0) {
                        updateProgress(100, 'Selesai (Tidak ada data baru)');
                        showToast('Upload selesai (Data sudah ada atau kosong)', 'success');
                        setTimeout(() => {
                            uploadStatus.classList.add('hidden');
                            btnRemove.click(); // Reset state
                        }, 2000);
                        return;
                    }

                    updateProgress(95, 'Mengunggah data ke database...');
                    await FirebaseAPI.patch('/', flatPayload);
                    
                    updateProgress(100, 'Berhasil!');
                    showToast('Upload data berhasil diselesaikan!', 'success');
                    await loadDashboardData();
                    
                    setTimeout(() => {
                        uploadStatus.classList.add('hidden');
                        btnRemove.click(); // Reset state
                        document.querySelector('.nav-links li[data-target="dashboard"]').click();
                    }, 2000);
                } catch (e) {
                    throw e;
                }
            };
            
            if (duplicateCount > 0) {
                document.getElementById('duplicate-count').innerText = duplicateCount;
                const modal = document.getElementById('duplicate-modal');
                modal.classList.remove('hidden');
                
                const btnKeep = document.getElementById('btn-keep-old');
                const btnOverwrite = document.getElementById('btn-overwrite-new');
                
                // Clone to clear listeners
                const newBtnKeep = btnKeep.cloneNode(true);
                const newBtnOverwrite = btnOverwrite.cloneNode(true);
                btnKeep.parentNode.replaceChild(newBtnKeep, btnKeep);
                btnOverwrite.parentNode.replaceChild(newBtnOverwrite, btnOverwrite);
                
                newBtnKeep.addEventListener('click', async () => {
                    modal.classList.add('hidden');
                    // Remove duplicates
                    if (parsedData.penjualan) {
                        for(const platform in parsedData.penjualan) {
                            if (rawDatabaseData.penjualan[platform]) {
                                for(const id in parsedData.penjualan[platform]) {
                                    if (rawDatabaseData.penjualan[platform][id]) {
                                        delete parsedData.penjualan[platform][id];
                                    }
                                }
                            }
                        }
                    }
                    if (parsedData.mutasi_saldo && parsedData.mutasi_saldo.bobcare && rawDatabaseData.mutasi_saldo && rawDatabaseData.mutasi_saldo.bobcare) {
                        for(const id in parsedData.mutasi_saldo.bobcare) {
                            if (rawDatabaseData.mutasi_saldo.bobcare[id]) {
                                delete parsedData.mutasi_saldo.bobcare[id];
                            }
                        }
                    }
                    await doUpload(parsedData).catch(handleUploadError);
                });
                
                newBtnOverwrite.addEventListener('click', async () => {
                    modal.classList.add('hidden');
                    // Overwrite
                    await doUpload(parsedData).catch(handleUploadError);
                });
                
            } else {
                await doUpload(parsedData);
            }
            
        } catch (error) {
            handleUploadError(error);
        }
        
        function handleUploadError(error) {
            console.error(error);
            showToast('Terjadi kesalahan saat memproses data', 'error');
            updateProgress(0, 'Proses Gagal');
            btnProcess.disabled = false;
        }
    });
}

async function loadDashboardData() {
    try {
        const data = await FirebaseAPI.get('/');
        rawDatabaseData = data || {};
        
        // Render Charts if on dashboard
        if(document.getElementById('dashboard').classList.contains('active')) {
            dashboardManager.renderCharts(rawDatabaseData);
        }
        
        // Render Table
        renderTable(rawDatabaseData);
        
        // Render Mutasi Table
        renderMutasiTable(rawDatabaseData);
        
    } catch (e) {
        console.error('Error fetching data:', e);
        showToast('Gagal mengambil data dari database', 'error');
    }
}

function renderTable(data) {
    const tbody = document.getElementById('table-body');
    const filterPlatform = document.getElementById('filter-platform').value;
    const filterProduct = document.getElementById('filter-product').value.toLowerCase();
    const startStr = document.getElementById('filter-date-start').value;
    const endStr = document.getElementById('filter-date-end').value;
    
    if (!data || !data.penjualan) {
        tbody.innerHTML = `<tr><td colspan="6" class="text-center">Tidak ada data ditemukan</td></tr>`;
        return;
    }
    
    let startFilter = startStr ? new Date(startStr) : null;
    if(startFilter) startFilter.setHours(0,0,0,0);
    let endFilter = endStr ? new Date(endStr) : null;
    if(endFilter) endFilter.setHours(23,59,59,999);

    const formatRP = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(num);
    const formatDate = (isoString) => new Date(isoString).toLocaleDateString('id-ID');

    let allRows = [];
    
    for (const [platform, records] of Object.entries(data.penjualan)) {
        if (filterPlatform !== 'all' && platform !== filterPlatform) continue;
        
        for (const [id, record] of Object.entries(records)) {
            const productName = record.nama_produk || record.type || '-';
            
            // Product filter
            if (filterProduct) {
                const query = filterProduct.replace(/\s+/g, ' ').toLowerCase();
                if (!productName.replace(/\s+/g, ' ').toLowerCase().includes(query)) continue;
            }
            
            // Date filter (skip if date is null)
            if (startFilter || endFilter) {
                if (!record.tanggal_order) continue; // Not sold yet, skip if filtering by date
                const recDate = new Date(record.tanggal_order);
                if (startFilter && recDate < startFilter) continue;
                if (endFilter && recDate > endFilter) continue;
            }

            allRows.push({
                date: record.tanggal_order,
                id: id,
                platform: platform.replace('_', ' ').toUpperCase(),
                platform_raw: platform,
                product: productName,
                price: record.harga_jual || 0,
                admin_fee: record.biaya_admin || 0,
                income: record.pendapatan_bersih || 0
            });
        }
    }
    
    // Sorting logic
    allRows.sort((a, b) => {
        let valA = a[currentSort.column];
        let valB = b[currentSort.column];
        
        if (currentSort.column === 'date') {
            valA = new Date(valA).getTime() || 0;
            valB = new Date(valB).getTime() || 0;
        } else if (currentSort.column === 'price' || currentSort.column === 'income' || currentSort.column === 'admin_fee') {
            valA = Number(valA);
            valB = Number(valB);
        } else {
            valA = String(valA).toLowerCase();
            valB = String(valB).toLowerCase();
        }
        
        if (valA < valB) return currentSort.dir === 'asc' ? -1 : 1;
        if (valA > valB) return currentSort.dir === 'asc' ? 1 : -1;
        return 0;
    });
    
    // Update header icons
    document.querySelectorAll('th[data-sort] i').forEach(icon => icon.className = 'bx bx-sort');
    const activeHeaderIcon = document.querySelector(`th[data-sort="${currentSort.column}"] i`);
    if (activeHeaderIcon) {
        activeHeaderIcon.className = currentSort.dir === 'asc' ? 'bx bx-sort-up' : 'bx bx-sort-down';
    }
    
    let htmlContent = '';
    
    // Take only top 200 for performance in UI
    allRows.slice(0, 200).forEach(row => {
        const dateDisplay = row.date ? formatDate(row.date) : '<span style="color:var(--text-muted)">- Belum Terjual -</span>';
        htmlContent += `
            <tr onclick="if(!event.target.closest('button')) openEditModal('${row.platform_raw}', '${row.id}')" style="cursor: pointer;" class="clickable-row">
                <td>${dateDisplay}</td>
                <td><strong>${row.id}</strong></td>
                <td><span style="font-size: 0.8rem; padding: 4px 8px; background: var(--primary-light); color: var(--primary-dark); border-radius: 4px;">${row.platform}</span></td>
                <td><span title="${row.product}">${row.product.length > 40 ? row.product.substring(0, 40) + '...' : row.product}</span></td>
                <td>${formatRP(row.price)}</td>
                <td style="color: var(--danger); font-weight: 500;">${formatRP(row.admin_fee)}</td>
                <td style="color: var(--primary-dark); font-weight: 600;">${formatRP(row.income)}</td>
                <td>
                    <button class="btn-icon-sm" title="Edit Pesanan" onclick="openEditModal('${row.platform_raw}', '${row.id}')"><i class='bx bx-edit'></i></button>
                </td>
            </tr>
        `;
    });
    
    if(allRows.length === 0) {
        htmlContent = `<tr><td colspan="8" class="text-center">Tidak ada data untuk filter ini</td></tr>`;
    }
    
    tbody.innerHTML = htmlContent;
}

function renderMutasiTable(data) {
    const tbody = document.getElementById('mutasi-body');
    if (!data || !data.mutasi_saldo || !data.mutasi_saldo.bobcare) {
        tbody.innerHTML = `<tr><td colspan="3" class="text-center">Tidak ada data mutasi</td></tr>`;
        return;
    }
    
    const formatRP = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(num);
    const formatDate = (isoString) => new Date(isoString).toLocaleDateString('id-ID');
    
    let allRows = Object.entries(data.mutasi_saldo.bobcare).map(([id, row]) => ({ id, ...row }));
    
    // Sort descending by date
    allRows.sort((a, b) => new Date(b.tanggal_transaksi).getTime() - new Date(a.tanggal_transaksi).getTime());
    
    let htmlContent = '';
    allRows.forEach(row => {
        const isMin = row.nominal < 0;
        const color = isMin ? 'var(--danger)' : 'var(--primary-dark)';
        htmlContent += `
            <tr onclick="if(!event.target.closest('button')) openMutasiEditModal('${row.id}')" style="cursor: pointer;" class="clickable-row">
                <td>${formatDate(row.tanggal_transaksi)}</td>
                <td>${row.keterangan}</td>
                <td style="color: ${color}; font-weight: 600;">${formatRP(row.nominal)}</td>
                <td>
                    <button class="btn-icon-sm" title="Edit Mutasi" onclick="openMutasiEditModal('${row.id}')"><i class='bx bx-edit'></i></button>
                </td>
            </tr>
        `;
    });
    
    tbody.innerHTML = htmlContent;
}

function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    const icon = type === 'success' ? 'bx-check-circle' : 'bx-x-circle';
    
    toast.innerHTML = `
        <i class='bx ${icon}'></i>
        <span>${message}</span>
    `;
    
    container.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) forwards';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
