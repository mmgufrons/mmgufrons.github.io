/**
 * firebase-api.js — PPOB SIMASRIM Dashboard
 * Thin wrapper ke PHP proxy yang konek ke Firebase Realtime Database
 */

const PROXY_URL = 'api/firebase_proxy.php';

const FirebaseAPI = {

    /**
     * GET data dari path tertentu
     * @param {string} path  — Path Firebase, misal "ppob_transactions"
     * @param {object} params — Query params tambahan (orderBy, limitToLast, dll)
     */
    async get(path, params = {}) {
        const qs = new URLSearchParams({ path, ...params });
        const res = await fetch(`${PROXY_URL}?${qs}`);
        if (!res.ok) throw new Error(`Firebase GET Error ${res.status}`);
        return res.json();
    },

    /**
     * PUT data (set/overwrite seluruh node)
     */
    async put(path, data) {
        const res = await fetch(`${PROXY_URL}?path=${encodeURIComponent(path)}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        if (!res.ok) throw new Error(`Firebase PUT Error ${res.status}`);
        return res.json();
    },

    /**
     * PATCH data (update/merge, tidak hapus key yang tidak ada)
     */
    async patch(path, data) {
        const res = await fetch(`${PROXY_URL}?path=${encodeURIComponent(path)}`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        if (!res.ok) throw new Error(`Firebase PATCH Error ${res.status}`);
        return res.json();
    },

    /**
     * DELETE node
     */
    async delete(path) {
        const res = await fetch(`${PROXY_URL}?path=${encodeURIComponent(path)}`, {
            method: 'DELETE'
        });
        if (!res.ok) throw new Error(`Firebase DELETE Error ${res.status}`);
        return true;
    },

    /**
     * Helper: Upload batch object ke satu path pakai PATCH (Upsert).
     * Tiap key di `data` akan menjadi child, tidak akan menghapus child lain.
     * @param {string} basePath — Misal "ppob_transactions"
     * @param {object} data     — { kode_trx_1: {...}, kode_trx_2: {...} }
     */
    async batchUpsert(basePath, data) {
        // Firebase PATCH pada base path = merge, ideal untuk upsert
        return this.patch(basePath, data);
    }
};
