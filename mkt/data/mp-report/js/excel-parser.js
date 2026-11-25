class ExcelParser {
    static async parse(file, onProgress) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                try {
                    onProgress(20, 'Membaca file Excel...');
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, { type: 'array' });
                    
                    onProgress(40, 'Memproses data sheet...');
                    
                    const result = {
                        penjualan: {
                            shopee_albanistore: {},
                            shopee_bobcare: {},
                            soundbox: {},
                            tiktok_albanie: {}
                        },
                        mutasi_saldo: {
                            bobcare: {}
                        }
                    };

                    // 1. SHOPEE ALBANISTORE
                    if (workbook.SheetNames.includes('SHOPEE ALBANISTORE')) {
                        const sheet = workbook.Sheets['SHOPEE ALBANISTORE'];
                        const jsonData = XLSX.utils.sheet_to_json(sheet);
                        jsonData.forEach(row => {
                            const id = row['No Pesanan'];
                            if (id) {
                                result.penjualan.shopee_albanistore[id] = {
                                    akun: row['Akun'] || '',
                                    tanggal_order: this.formatDate(row['Tanggal Order']),
                                    nama_produk: row['Nama Produk'] || 'Produk Tidak Diketahui',
                                    jumlah: parseInt(row['Jumlah']) || 1,
                                    harga_jual: parseFloat(row['Harga Penjualan']) || 0,
                                    biaya_admin: parseFloat(row['Biaya Admin']) || 0,
                                    pendapatan_bersih: parseFloat(row['Total Penghasilan']) || 0
                                };
                            }
                        });
                    }

                    onProgress(55, 'Memproses Shopee Bobcare...');
                    // 2. SHOPEE BOBCARE
                    if (workbook.SheetNames.includes('SHOPEE BOBCARE')) {
                        const sheet = workbook.Sheets['SHOPEE BOBCARE'];
                        const jsonData = XLSX.utils.sheet_to_json(sheet);
                        jsonData.forEach(row => {
                            // Penjualan
                            const id = row['No Pesanan'];
                            if (id) {
                                result.penjualan.shopee_bobcare[id] = {
                                    akun: row['Akun'] || '',
                                    tanggal_order: this.formatDate(row['Tanggal Order']),
                                    nama_produk: row['Nama Produk'] || 'Produk Tidak Diketahui',
                                    jumlah: parseInt(row['Jumlah']) || 1,
                                    harga_jual: parseFloat(row['Harga Jual']) || 0,
                                    biaya_admin: parseFloat(row['Biaya Admin']) || 0,
                                    pendapatan_bersih: parseFloat(row['Pendapatan Bersih']) || 0
                                };
                            }
                            
                            // Mutasi Saldo
                            const tglMutasi = row['Tanggal Transaksi Saldo'];
                            const nominalMutasi = parseFloat(row['Nominal Transaksi']);
                            const ketMutasi = row['Keterangan'];
                            
                            if (tglMutasi && nominalMutasi && ketMutasi) {
                                // Generate ID mutasi from base64 string
                                const rawString = `${tglMutasi}_${nominalMutasi}_${ketMutasi}`;
                                const hashId = btoa(unescape(encodeURIComponent(rawString))).replace(/[^a-zA-Z0-9]/g, '');
                                
                                result.mutasi_saldo.bobcare[hashId] = {
                                    tanggal_transaksi: this.formatDate(tglMutasi),
                                    nominal: nominalMutasi,
                                    keterangan: ketMutasi
                                };
                            }
                        });
                    }

                    onProgress(70, 'Memproses Soundbox & TikTok...');
                    // 3. SOUNDBOX QRIS
                    if (workbook.SheetNames.includes('SOUNDBOX QRIS')) {
                        const sheet = workbook.Sheets['SOUNDBOX QRIS'];
                        const jsonData = XLSX.utils.sheet_to_json(sheet);
                        jsonData.forEach(row => {
                            const id = row['ID DEVICE'] || row['Id Device'] || row['ID'];
                            if (id) {
                                // Cari kolom tanggal dengan nama yang mungkin
                                const dateKey = Object.keys(row).find(k => k.toLowerCase().includes('tanggal') || k.toLowerCase().includes('date') || k.toLowerCase().includes('waktu'));
                                const dateVal = dateKey ? row[dateKey] : null;

                                result.penjualan.soundbox[id] = {
                                    type: row['TYPE'] || '',
                                    order_by: row['Order By'] || 'Organic',
                                    nama_merchant: row['Nama Merchant'] || '',
                                    nama_produk: row['TYPE'] || 'Soundbox', // Aggregation purpose
                                    tanggal_order: this.formatDate(dateVal),
                                    harga_jual: parseFloat(row['HARGA JUAL']) || 0,
                                    biaya_admin: parseFloat(row['BIAYA ADMIN']) || 0,
                                    pendapatan_bersih: parseFloat(row['PENDAPATAN']) || 0
                                };
                            }
                        });
                    }

                    // 4. TIKTOKSHOP TOKO ALBANIE
                    if (workbook.SheetNames.includes('TIKTOKSHOP TOKO ALBANIE')) {
                        const sheet = workbook.Sheets['TIKTOKSHOP TOKO ALBANIE'];
                        const jsonData = XLSX.utils.sheet_to_json(sheet);
                        jsonData.forEach(row => {
                            const id = row['Order ID'] || row['No Pesanan'];
                            if (id) {
                                result.penjualan.tiktok_albanie[id] = {
                                    tanggal_order: this.formatDate(row['Created Time'] || row['Tanggal Order']),
                                    nama_produk: row['Product Name'] || row['Nama Produk'] || 'TikTok Product',
                                    jumlah: parseInt(row['Jumlah']) || 1,
                                    harga_jual: parseFloat(row['Item Price'] || row['Harga Jual'] || row['Harga Penjualan']) || 0,
                                    biaya_admin: parseFloat(row['Platform Fee'] || row['Biaya Admin']) || 0,
                                    pendapatan_bersih: parseFloat(row['Seller Payout'] || row['Total Penghasilan'] || row['Pendapatan Bersih']) || 0
                                };
                            }
                        });
                    }

                    onProgress(90, 'Data berhasil diparsing, menyiapkan upload...');
                    resolve(result);

                } catch (error) {
                    reject(error);
                }
            };
            reader.onerror = (e) => reject(e);
            reader.readAsArrayBuffer(file);
        });
    }

    static formatDate(excelDate) {
        try {
            if (!excelDate) return null;
            if (typeof excelDate === 'number') {
                const date = new Date((excelDate - (25567 + 2)) * 86400 * 1000);
                return date.toISOString();
            }
            const dateStr = String(excelDate).trim();
            const d = new Date(dateStr);
            if (!isNaN(d.getTime())) return d.toISOString();
            
            // Fallback for DD/MM/YYYY
            if (dateStr.includes('/')) {
                const parts = dateStr.split(' ')[0].split('/');
                if (parts.length === 3) {
                    let [dVal, mVal, yVal] = parts;
                    if (yVal.length === 2) yVal = '20' + yVal;
                    const d2 = new Date(`${yVal}-${mVal}-${dVal}`);
                    if (!isNaN(d2.getTime())) return d2.toISOString();
                }
            }
            return null;
        } catch (e) {
            return null;
        }
    }
}
