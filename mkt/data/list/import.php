<?php
require_once 'config.php';

if (!$is_logged_in) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if ($data && isset($data['type'])) {
        try {
            $db_data = getDB();
            $inserted_count = 0;
            
            if ($data['type'] === 'accounts') {
                foreach ($data['rows'] as $raw_row) {
                    $row = [];
                    foreach ($raw_row as $k => $v) {
                        $row[strtolower(trim($k))] = trim((string)$v);
                    }
                    
                    $platform = $row['platform'] ?? '';
                    if (!$platform) continue;
                    
                    $db_data['accounts'][] = [
                        'id' => generateId(),
                        'kategori' => $row['kategori'] ?? '',
                        'platform' => $platform,
                        'email' => $row['email'] ?? '',
                        'account_key' => $row['key'] ?? '',
                        'keterangan' => $row['keterangan'] ?? ''
                    ];
                    $inserted_count++;
                }
                saveDB($db_data);
                addLog("Berhasil Mengimpor $inserted_count data Akun");
            } 
            else if ($data['type'] === 'whatsapp') {
                foreach ($data['rows'] as $raw_row) {
                    $row = [];
                    foreach ($raw_row as $k => $v) {
                        $clean_k = preg_replace('/\s+/', ' ', strtolower(trim($k)));
                        $row[$clean_k] = trim((string)$v);
                    }

                    $nomor = $row['nomor'] ?? '';
                    if (!$nomor) continue;
                    
                    $db_data['whatsapp_numbers'][] = [
                        'id' => generateId(),
                        'kategori' => $row['kategori'] ?? '',
                        'status' => $row['status'] ?? 'Aktif',
                        'pic' => $row['pic'] ?? '',
                        'nama' => $row['nama'] ?? '',
                        'email' => $row['email'] ?? '',
                        'provider' => $row['provider'] ?? '',
                        'nomor' => $nomor,
                        'slot_wa' => $row['slot wa'] ?? '',
                        'devices' => $row['devices'] ?? '',
                        'slot_kartu' => $row['slot kartu'] ?? '',
                        'pulsa' => $row['pulsa'] ?? '',
                        'kuota' => $row['kuota'] ?? '',
                        'aktif' => $row['aktif'] ?? '',
                        'brand' => $row['brand'] ?? '',
                        'area' => $row['area'] ?? '',
                        'keterangan' => $row['keterangan'] ?? ''
                    ];
                    $inserted_count++;
                }
                saveDB($db_data);
                addLog("Berhasil Mengimpor $inserted_count data WhatsApp");
            }
            
            echo json_encode(['success' => true, 'inserted' => $inserted_count]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php renderHead('Impor Data Excel'); ?>
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
</head>
<body>

<?php renderNavbar('import'); ?>

<main class="container py-5">
    <div class="mb-4">
        <h2 class="fw-bold text-primary mb-2"><i class="fas fa-file-excel me-2"></i> Migrasi Data dari Excel</h2>
        <p class="text-muted">Unggah file rekap aset atau nomor WhatsApp. Sistem akan secara otomatis mendeteksi kategori (dari baris judul), mencocokkan kolom, dan mengimpor semuanya ke database.</p>
    </div>

    <div class="card card-glass border-0 shadow-sm p-4">
        <div class="border border-2 border-dashed rounded-3 p-5 text-center cursor-pointer" id="dropzone" style="border-color: #cbd5e1; transition: all 0.3s;" onclick="document.getElementById('fileInput').click()">
            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                <i class="fas fa-cloud-upload-alt fs-1 text-primary"></i>
            </div>
            <h4 class="fw-bold text-dark">Klik atau Tarik File .xlsx ke Sini</h4>
            <p class="text-muted small mb-0">Mendukung format .xlsx dan .xls</p>
            <input type="file" id="fileInput" class="d-none" accept=".xlsx, .xls, .csv">
        </div>

        <div id="statusArea" class="mt-4 d-none">
            <div class="card bg-light border-0">
                <div class="card-body">
                    <h5 class="fw-bold text-primary mb-3"><i class="fas fa-search me-2"></i> Hasil Pindaian Cerdas</h5>
                    <div id="statusMessages" class="small" style="font-family: monospace;"></div>
                    
                    <button id="btnImport" onclick="processImport()" class="btn btn-primary w-100 rounded-pill fw-bold py-3 mt-4 shadow-sm d-none">
                        Eksekusi Impor ke Database
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let parsedData = { accounts: [], whatsapp: [] };

    document.getElementById('fileInput').addEventListener('change', function(e) { handleFile(e.target.files[0]); });
    const dropzone = document.getElementById('dropzone');
    dropzone.addEventListener('dragover', (e) => { e.preventDefault(); dropzone.style.borderColor = 'var(--primary)'; dropzone.style.backgroundColor = 'var(--bg-soft-purple)'; });
    dropzone.addEventListener('dragleave', (e) => { e.preventDefault(); dropzone.style.borderColor = '#cbd5e1'; dropzone.style.backgroundColor = 'transparent'; });
    dropzone.addEventListener('drop', (e) => { 
        e.preventDefault(); 
        dropzone.style.borderColor = '#cbd5e1'; dropzone.style.backgroundColor = 'transparent';
        if(e.dataTransfer.files.length) handleFile(e.dataTransfer.files[0]);
    });

    function logStatus(msg, isSuccess=true) {
        const div = document.createElement('div');
        div.className = `p-2 mb-2 rounded ${isSuccess ? 'bg-white text-dark border-start border-4 border-primary shadow-sm' : 'bg-danger text-white'}`;
        div.innerHTML = msg;
        document.getElementById('statusMessages').appendChild(div);
        document.getElementById('statusArea').classList.remove('d-none');
    }

    function extractAccountsData(worksheet) {
        const rawRows = XLSX.utils.sheet_to_json(worksheet, {header: 1, defval: ''});
        let headerRowIdx = -1;
        let headers = [];

        // 1. Temukan baris header utama
        for (let i = 0; i < Math.min(20, rawRows.length); i++) {
            const rowStr = (rawRows[i] || []).map(c => String(c).toLowerCase()).join(' ');
            if (rowStr.includes('platform') || rowStr.includes('email') || rowStr.includes('key')) {
                headerRowIdx = i;
                headers = rawRows[i].map(h => String(h).trim());
                break;
            }
        }

        if (headerRowIdx === -1) return { headers: [], rows: [] };

        const dataRows = [];
        let currentCategory = 'Lainnya'; // Default kategori

        // 2. Loop semua baris dari awal
        for (let i = 0; i < rawRows.length; i++) {
            if (i === headerRowIdx) continue;
            const rowData = rawRows[i] || [];
            
            // Hitung sel yang terisi
            const filledCells = rowData.filter(cell => String(cell).trim() !== '');
            
            // Deteksi Kategori (Baris yang hanya punya 1 nilai)
            if (filledCells.length === 1) {
                const val = String(filledCells[0]).trim();
                if (val.length < 50 && !val.toLowerCase().includes('menyesuaikan')) {
                    currentCategory = val;
                }
                continue;
            }

            // Ekstrak Data
            let rowObj = {};
            let hasData = false;
            for (let j = 0; j < headers.length; j++) {
                if (headers[j]) {
                    rowObj[headers[j]] = rowData[j];
                    if (String(rowData[j]).trim() !== '') hasData = true;
                }
            }
            if (hasData) {
                rowObj['Kategori'] = currentCategory; // Sisipkan kategori
                dataRows.push(rowObj);
            }
        }
        return { headers, rows: dataRows };
    }

    function extractWhatsappData(worksheet) {
        const rawRows = XLSX.utils.sheet_to_json(worksheet, {header: 1, defval: ''});
        let headerRowIdx = -1;
        let headers = [];

        for (let i = 0; i < Math.min(20, rawRows.length); i++) {
            const rowStr = (rawRows[i] || []).map(c => String(c).toLowerCase()).join(' ');
            if (rowStr.includes('nomor') || rowStr.includes('pic') || rowStr.includes('status')) {
                headerRowIdx = i;
                headers = rawRows[i].map(h => String(h).trim());
                break;
            }
        }

        if (headerRowIdx === -1) return { headers: [], rows: [] };

        const dataRows = [];
        for (let i = headerRowIdx + 1; i < rawRows.length; i++) {
            const rowData = rawRows[i];
            let rowObj = {};
            let hasData = false;
            // Konversi khusus jika nilai terlihat seperti serial tanggal Excel
            for (let j = 0; j < headers.length; j++) {
                if (headers[j]) {
                    let val = rowData[j];
                    if (val instanceof Date) {
                        // Konversi JS Date ke YYYY-MM-DD
                        val = new Date(val.getTime() - (val.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
                    }
                    rowObj[headers[j]] = val;
                    if (String(val).trim() !== '') hasData = true;
                }
            }
            if (hasData) dataRows.push(rowObj);
        }
        return { headers, rows: dataRows };
    }

    function handleFile(file) {
        if (!file) return;
        document.getElementById('statusMessages').innerHTML = '';
        document.getElementById('btnImport').classList.add('d-none');
        parsedData = { accounts: [], whatsapp: [] };

        logStatus(`Memproses file <strong>${file.name}</strong>...`);
        
        const reader = new FileReader();
        reader.onload = function(e) {
            try {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, {type: 'array', cellDates: true});
                
                let accountSheetName = workbook.SheetNames.find(n => n.toLowerCase().includes('akun')) || workbook.SheetNames[0];
                let waSheetName = workbook.SheetNames.find(n => n.toLowerCase().includes('wa') || n.toLowerCase().includes('whatsapp')) || (workbook.SheetNames.length > 1 ? workbook.SheetNames[1] : null);

                let totalFound = 0;

                if (accountSheetName) {
                    const result = extractAccountsData(workbook.Sheets[accountSheetName]);
                    if (result.rows.length > 0) {
                        parsedData.accounts = result.rows;
                        totalFound += result.rows.length;
                        logStatus(`✅ <strong>Sheet Akun</strong>: Menemukan ${result.rows.length} baris data.<br><span class="text-muted">Kategori berhasil terdeteksi dari struktur file!</span>`);
                    }
                }

                if (waSheetName) {
                    const result = extractWhatsappData(workbook.Sheets[waSheetName]);
                    if (result.rows.length > 0) {
                        parsedData.whatsapp = result.rows;
                        totalFound += result.rows.length;
                        logStatus(`✅ <strong>Sheet WhatsApp</strong>: Menemukan ${result.rows.length} baris data.`);
                    }
                }

                if (totalFound > 0) {
                    document.getElementById('btnImport').classList.remove('d-none');
                } else {
                    logStatus(`Gagal menemukan struktur tabel yang cocok.`, false);
                }
            } catch (err) {
                logStatus(`Error: ${err.message}`, false);
            }
        };
        reader.readAsArrayBuffer(file);
    }

    async function sendData(type, rows) {
        if (rows.length === 0) return 0;
        const res = await fetch('import.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ type, rows })
        });
        const data = await res.json();
        if (!data.success) throw new Error(data.error || "Unknown error");
        return data.inserted || 0;
    }

    async function processImport() {
        const btn = document.getElementById('btnImport');
        btn.innerHTML = `<i class="fas fa-spinner fa-spin me-2"></i> Sedang Menyimpan...`;
        btn.disabled = true;
        
        try {
            let accCount = 0, waCount = 0;
            if (parsedData.accounts.length > 0) {
                accCount = await sendData('accounts', parsedData.accounts);
            }
            if (parsedData.whatsapp.length > 0) {
                waCount = await sendData('whatsapp', parsedData.whatsapp);
            }
            logStatus(`🎉 <strong>Sukses!</strong> ${accCount} data Akun (lengkap dengan Kategori) dan ${waCount} data WA berhasil disimpan.`);
            
            btn.innerHTML = `<i class="fas fa-check me-2"></i> Kembali ke Dashboard`;
            btn.classList.replace('btn-primary', 'btn-success');
            btn.disabled = false;
            btn.onclick = () => window.location.href = 'index.php';
        } catch (err) {
            logStatus(`Gagal menyimpan: ${err.message}`, false);
            btn.innerText = "Coba Lagi";
            btn.disabled = false;
        }
    }
</script>
</body>
</html>
