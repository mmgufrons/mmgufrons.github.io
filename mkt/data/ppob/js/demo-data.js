/**
 * demo-data.js — PPOB SIMASRIM Dashboard
 * Data dummy untuk demonstrasi dashboard saat belum ada data di Firebase.
 * Ini TIDAK diupload ke Firebase — hanya digunakan lokal untuk preview.
 *
 * Berdasarkan struktur kolom sesuai Master Plan:
 *   - Master User: EMAIL, ID USER, NAMA USER, NO WA, KATEGORI USER, ORIGIN
 *   - PPOB: EMAIL, KODE TRANSAKSI, TANGGAL BELI, KATEGORI, NAMA PRODUK,
 *            TAGIHAN USER, CASHBACK USER, BAYAR MITRA, STATUS
 *   - Logistik: ID USER, NAMA USER, AWB/RESI, EKSPEDISI
 */

const DEMO_DATA = {

    // ================================================================
    // DATA MASTER USER — Preview kolom dari file XLSX
    // ================================================================
    users: {
        "imelda@simasrim,com": {
            email: "imelda@simasrim.com",
            id_user: "USR-001",
            nama: "Imelda Susanti",
            no_wa: "628112345001",
            kategori: "MITRA PLATINUM",
            origin: "Jakarta",
            updated_at: "2025-07-01T00:00:00.000Z"
        },
        "budi@gmail,com": {
            email: "budi@gmail.com",
            id_user: "USR-002",
            nama: "Budi Santoso",
            no_wa: "628112345002",
            kategori: "MITRA GOLD",
            origin: "Surabaya",
            updated_at: "2025-07-01T00:00:00.000Z"
        },
        "sari,dewi@yahoo,com": {
            email: "sari.dewi@yahoo.com",
            id_user: "USR-003",
            nama: "Sari Dewi",
            no_wa: "628112345003",
            kategori: "MITRA SILVER",
            origin: "Bandung",
            updated_at: "2025-07-01T00:00:00.000Z"
        },
        "ahmad@hotmail,com": {
            email: "ahmad@hotmail.com",
            id_user: "USR-004",
            nama: "Ahmad Fauzi",
            no_wa: "628112345004",
            kategori: "MITRA SILVER",
            origin: "Medan",
            updated_at: "2025-07-01T00:00:00.000Z"
        },
        "rini@gmail,com": {
            email: "rini@gmail.com",
            id_user: "USR-005",
            nama: "Rini Wulandari",
            no_wa: "628112345005",
            kategori: "MITRA BRONZE",
            origin: "Yogyakarta",
            updated_at: "2025-07-01T00:00:00.000Z"
        },
        "dedi@simasrim,com": {
            email: "dedi@simasrim.com",
            id_user: "USR-006",
            nama: "Dedi Kurniawan",
            no_wa: "628112345006",
            kategori: "MITRA GOLD",
            origin: "Semarang",
            updated_at: "2025-07-01T00:00:00.000Z"
        },
        "putri@gmail,com": {
            email: "putri@gmail.com",
            id_user: "USR-007",
            nama: "Putri Anggraini",
            no_wa: "628112345007",
            kategori: "MITRA BRONZE",
            origin: "Makassar",
            updated_at: "2025-07-01T00:00:00.000Z"
        },
        "hendra@yahoo,com": {
            email: "hendra@yahoo.com",
            id_user: "USR-008",
            nama: "Hendra Wijaya",
            no_wa: "",
            kategori: "MITRA SILVER",
            origin: "Palembang",
            updated_at: "2025-07-01T00:00:00.000Z"
        }
    },

    // ================================================================
    // DATA TRANSAKSI PPOB — Preview kolom dari file XLSX
    // PROFIT = (TAGIHAN USER - CASHBACK USER) - BAYAR MITRA
    // ================================================================
    ppob_transactions: {
        "TRX-2025-001": {
            kode_transaksi: "TRX-2025-001",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-01",
            kategori: "PLN",
            nama_produk: "PLN Token 100.000",
            tagihan_user: 102000,
            cashback_user: 1000,
            bayar_mitra: 99000,
            profit: 2000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-002": {
            kode_transaksi: "TRX-2025-002",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-02",
            kategori: "PULSA",
            nama_produk: "Telkomsel 50.000",
            tagihan_user: 52000,
            cashback_user: 500,
            bayar_mitra: 50000,
            profit: 1500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-003": {
            kode_transaksi: "TRX-2025-003",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-03",
            kategori: "E-WALLET",
            nama_produk: "GoPay 200.000",
            tagihan_user: 202000,
            cashback_user: 2000,
            bayar_mitra: 199000,
            profit: 1000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-004": {
            kode_transaksi: "TRX-2025-004",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-05",
            kategori: "PLN",
            nama_produk: "PLN Token 200.000",
            tagihan_user: 203000,
            cashback_user: 2000,
            bayar_mitra: 199500,
            profit: 1500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-005": {
            kode_transaksi: "TRX-2025-005",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-10",
            kategori: "PULSA",
            nama_produk: "Indosat 100.000",
            tagihan_user: 105000,
            cashback_user: 1000,
            bayar_mitra: 102000,
            profit: 2000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-006": {
            kode_transaksi: "TRX-2025-006",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-12",
            kategori: "E-WALLET",
            nama_produk: "OVO 100.000",
            tagihan_user: 101000,
            cashback_user: 1000,
            bayar_mitra: 99500,
            profit: 500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-007": {
            kode_transaksi: "TRX-2025-007",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-15",
            kategori: "BPJS",
            nama_produk: "BPJS Kesehatan",
            tagihan_user: 55000,
            cashback_user: 500,
            bayar_mitra: 53000,
            profit: 1500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-008": {
            kode_transaksi: "TRX-2025-008",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-18",
            kategori: "PULSA",
            nama_produk: "XL Axiata 50.000",
            tagihan_user: 53000,
            cashback_user: 500,
            bayar_mitra: 51000,
            profit: 1500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-009": {
            kode_transaksi: "TRX-2025-009",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-20",
            kategori: "PLN",
            nama_produk: "PLN Token 50.000",
            tagihan_user: 52000,
            cashback_user: 500,
            bayar_mitra: 50500,
            profit: 1000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-010": {
            kode_transaksi: "TRX-2025-010",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-22",
            kategori: "INTERNET",
            nama_produk: "Telkomsel LOOP 30GB",
            tagihan_user: 135000,
            cashback_user: 1500,
            bayar_mitra: 131000,
            profit: 2500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-011": {
            kode_transaksi: "TRX-2025-011",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-25",
            kategori: "E-WALLET",
            nama_produk: "Dana 500.000",
            tagihan_user: 503000,
            cashback_user: 3000,
            bayar_mitra: 499000,
            profit: 1000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-012": {
            kode_transaksi: "TRX-2025-012",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-28",
            kategori: "PULSA",
            nama_produk: "Telkomsel 100.000",
            tagihan_user: 104000,
            cashback_user: 1000,
            bayar_mitra: 101000,
            profit: 2000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-013": {
            kode_transaksi: "TRX-2025-013",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-30",
            kategori: "PLN",
            nama_produk: "PLN Token 500.000",
            tagihan_user: 506000,
            cashback_user: 5000,
            bayar_mitra: 499000,
            profit: 2000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-014": {
            kode_transaksi: "TRX-2025-014",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-07-31",
            kategori: "BPJS",
            nama_produk: "BPJS Ketenagakerjaan",
            tagihan_user: 82000,
            cashback_user: 800,
            bayar_mitra: 80000,
            profit: 1200,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-015": {
            kode_transaksi: "TRX-2025-015",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-08-01",
            kategori: "PLN",
            nama_produk: "PLN Token 200.000",
            tagihan_user: 203000,
            cashback_user: 2000,
            bayar_mitra: 199500,
            profit: 1500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-016": {
            kode_transaksi: "TRX-2025-016",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-08-02",
            kategori: "PULSA",
            nama_produk: "Telkomsel 200.000",
            tagihan_user: 206000,
            cashback_user: 2000,
            bayar_mitra: 202000,
            profit: 2000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-017": {
            kode_transaksi: "TRX-2025-017",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-08-05",
            kategori: "E-WALLET",
            nama_produk: "ShopeePay 300.000",
            tagihan_user: 303000,
            cashback_user: 3000,
            bayar_mitra: 299000,
            profit: 1000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-018": {
            kode_transaksi: "TRX-2025-018",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-08-08",
            kategori: "PLN",
            nama_produk: "PLN Token 100.000",
            tagihan_user: 102000,
            cashback_user: 1000,
            bayar_mitra: 99000,
            profit: 2000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-019": {
            kode_transaksi: "TRX-2025-019",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-08-10",
            kategori: "INTERNET",
            nama_produk: "Indosat Freedom 20GB",
            tagihan_user: 85000,
            cashback_user: 800,
            bayar_mitra: 82000,
            profit: 2200,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-020": {
            kode_transaksi: "TRX-2025-020",
            email: "imelda@simasrim.com",
            email_key: "imelda@simasrim,com",
            tanggal_beli: "2025-08-12",
            kategori: "PLN",
            nama_produk: "PLN Token 50.000",
            tagihan_user: 52000,
            cashback_user: 500,
            bayar_mitra: 50500,
            profit: 1000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        // Budi - Active Micro
        "TRX-2025-021": {
            kode_transaksi: "TRX-2025-021",
            email: "budi@gmail.com",
            email_key: "budi@gmail,com",
            tanggal_beli: "2025-07-05",
            kategori: "PULSA",
            nama_produk: "Telkomsel 5.000",
            tagihan_user: 6000,
            cashback_user: 0,
            bayar_mitra: 5500,
            profit: 500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-022": {
            kode_transaksi: "TRX-2025-022",
            email: "budi@gmail.com",
            email_key: "budi@gmail,com",
            tanggal_beli: "2025-07-10",
            kategori: "PULSA",
            nama_produk: "Telkomsel 10.000",
            tagihan_user: 11500,
            cashback_user: 0,
            bayar_mitra: 11000,
            profit: 500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-023": {
            kode_transaksi: "TRX-2025-023",
            email: "budi@gmail.com",
            email_key: "budi@gmail,com",
            tanggal_beli: "2025-07-15",
            kategori: "PULSA",
            nama_produk: "XL Axiata 5.000",
            tagihan_user: 6000,
            cashback_user: 0,
            bayar_mitra: 5500,
            profit: 500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-024": {
            kode_transaksi: "TRX-2025-024",
            email: "budi@gmail.com",
            email_key: "budi@gmail,com",
            tanggal_beli: "2025-07-20",
            kategori: "PULSA",
            nama_produk: "Indosat 5.000",
            tagihan_user: 6000,
            cashback_user: 0,
            bayar_mitra: 5500,
            profit: 500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-025": {
            kode_transaksi: "TRX-2025-025",
            email: "budi@gmail.com",
            email_key: "budi@gmail,com",
            tanggal_beli: "2025-07-25",
            kategori: "PULSA",
            nama_produk: "Telkomsel 10.000",
            tagihan_user: 11500,
            cashback_user: 0,
            bayar_mitra: 11000,
            profit: 500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-026": {
            kode_transaksi: "TRX-2025-026",
            email: "budi@gmail.com",
            email_key: "budi@gmail,com",
            tanggal_beli: "2025-08-01",
            kategori: "PULSA",
            nama_produk: "Telkomsel 5.000",
            tagihan_user: 6000,
            cashback_user: 0,
            bayar_mitra: 5500,
            profit: 500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-027": {
            kode_transaksi: "TRX-2025-027",
            email: "budi@gmail.com",
            email_key: "budi@gmail,com",
            tanggal_beli: "2025-08-05",
            kategori: "PULSA",
            nama_produk: "Telkomsel 5.000",
            tagihan_user: 6000,
            cashback_user: 0,
            bayar_mitra: 5500,
            profit: 500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        // Sari Dewi - Cross-Sell Target (hanya PPOB, tidak ada logistik)
        "TRX-2025-028": {
            kode_transaksi: "TRX-2025-028",
            email: "sari.dewi@yahoo.com",
            email_key: "sari,dewi@yahoo,com",
            tanggal_beli: "2025-07-08",
            kategori: "PLN",
            nama_produk: "PLN Token 100.000",
            tagihan_user: 102000,
            cashback_user: 1000,
            bayar_mitra: 99500,
            profit: 1500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-029": {
            kode_transaksi: "TRX-2025-029",
            email: "sari.dewi@yahoo.com",
            email_key: "sari,dewi@yahoo,com",
            tanggal_beli: "2025-07-18",
            kategori: "E-WALLET",
            nama_produk: "GoPay 100.000",
            tagihan_user: 101000,
            cashback_user: 1000,
            bayar_mitra: 99000,
            profit: 1000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-030": {
            kode_transaksi: "TRX-2025-030",
            email: "sari.dewi@yahoo.com",
            email_key: "sari,dewi@yahoo,com",
            tanggal_beli: "2025-07-28",
            kategori: "BPJS",
            nama_produk: "BPJS Kesehatan",
            tagihan_user: 55000,
            cashback_user: 500,
            bayar_mitra: 53000,
            profit: 1500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        // Dedi - At Risk (terakhir transaksi > 30 hari lalu)
        "TRX-2025-031": {
            kode_transaksi: "TRX-2025-031",
            email: "dedi@simasrim.com",
            email_key: "dedi@simasrim,com",
            tanggal_beli: "2025-05-10",
            kategori: "PULSA",
            nama_produk: "Telkomsel 50.000",
            tagihan_user: 52000,
            cashback_user: 500,
            bayar_mitra: 50000,
            profit: 1500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-032": {
            kode_transaksi: "TRX-2025-032",
            email: "dedi@simasrim.com",
            email_key: "dedi@simasrim,com",
            tanggal_beli: "2025-05-20",
            kategori: "PLN",
            nama_produk: "PLN Token 100.000",
            tagihan_user: 102000,
            cashback_user: 1000,
            bayar_mitra: 99000,
            profit: 2000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-033": {
            kode_transaksi: "TRX-2025-033",
            email: "dedi@simasrim.com",
            email_key: "dedi@simasrim,com",
            tanggal_beli: "2025-06-01",
            kategori: "BPJS",
            nama_produk: "BPJS Kesehatan",
            tagihan_user: 55000,
            cashback_user: 500,
            bayar_mitra: 53000,
            profit: 1500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        // Ahmad - Transaksi minimal
        "TRX-2025-034": {
            kode_transaksi: "TRX-2025-034",
            email: "ahmad@hotmail.com",
            email_key: "ahmad@hotmail,com",
            tanggal_beli: "2025-08-01",
            kategori: "PULSA",
            nama_produk: "Telkomsel 50.000",
            tagihan_user: 52000,
            cashback_user: 500,
            bayar_mitra: 50000,
            profit: 1500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-035": {
            kode_transaksi: "TRX-2025-035",
            email: "ahmad@hotmail.com",
            email_key: "ahmad@hotmail,com",
            tanggal_beli: "2025-08-05",
            kategori: "PLN",
            nama_produk: "PLN Token 50.000",
            tagihan_user: 52000,
            cashback_user: 500,
            bayar_mitra: 50500,
            profit: 1000,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        // Rini - Gagal transaksi
        "TRX-2025-036": {
            kode_transaksi: "TRX-2025-036",
            email: "rini@gmail.com",
            email_key: "rini@gmail,com",
            tanggal_beli: "2025-08-03",
            kategori: "E-WALLET",
            nama_produk: "OVO 50.000",
            tagihan_user: 51000,
            cashback_user: 0,
            bayar_mitra: 50000,
            profit: 1000,
            status: "GAGAL",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "TRX-2025-037": {
            kode_transaksi: "TRX-2025-037",
            email: "rini@gmail.com",
            email_key: "rini@gmail,com",
            tanggal_beli: "2025-08-07",
            kategori: "PULSA",
            nama_produk: "XL Axiata 25.000",
            tagihan_user: 26500,
            cashback_user: 200,
            bayar_mitra: 25800,
            profit: 500,
            status: "SUCCESS",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        }
    },

    // ================================================================
    // DATA LOGISTIK — Preview kolom dari file XLSX
    // ================================================================
    logistics: {
        "JNE-20250701-001": {
            resi: "JNE-20250701-001",
            id_user: "USR-007",
            nama_user: "Putri Anggraini",
            email: "putri@gmail.com",
            email_key: "putri@gmail,com",
            ekspedisi: "JNE",
            status: "TERKIRIM",
            tanggal: "2025-07-01",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "JNT-20250705-002": {
            resi: "JNT-20250705-002",
            id_user: "USR-007",
            nama_user: "Putri Anggraini",
            email: "putri@gmail.com",
            email_key: "putri@gmail,com",
            ekspedisi: "J&T EXPRESS",
            status: "TERKIRIM",
            tanggal: "2025-07-05",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        },
        "SIC-20250708-003": {
            resi: "SIC-20250708-003",
            id_user: "USR-008",
            nama_user: "Hendra Wijaya",
            email: "hendra@yahoo.com",
            email_key: "hendra@yahoo,com",
            ekspedisi: "SICEPAT",
            status: "DALAM PENGIRIMAN",
            tanggal: "2025-08-08",
            uploaded_at: "2025-07-01T10:00:00.000Z"
        }
    }
};

/**
 * Load demo data ke AppState untuk preview dashboard
 * Dipanggil dari app.js jika Firebase kosong (totalTrx === 0)
 */
function loadDemoData() {
    AppState.users        = DEMO_DATA.users;
    AppState.logistics    = DEMO_DATA.logistics;
    AppState.transactions = Object.values(DEMO_DATA.ppob_transactions);
    AppState.loaded       = true;
    processAndRender();
    showToast('📊 Mode Demo aktif — data contoh berhasil dimuat', 'info');
}
