/**
 * firebase-api.js — Campaign SIMASRIM
 * Thin wrapper ke PHP proxy → Firebase Realtime Database (campaign-smsrm)
 * Identik pola dengan /ppob/js/firebase-api.js
 */

const PROXY_URL = 'api/firebase_proxy.php';

function sleep(ms) { return new Promise(resolve => setTimeout(resolve, ms)); }

const FirebaseAPI = {

    async get(path, params = {}) {
        const qs = new URLSearchParams({ path, ...params });
        const res = await fetch(`${PROXY_URL}?${qs}`);
        if (!res.ok) throw new Error(`Firebase GET Error ${res.status}`);
        return res.json();
    },

    async put(path, data) {
        const res = await fetch(`${PROXY_URL}?path=${encodeURIComponent(path)}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        if (!res.ok) throw new Error(`Firebase PUT Error ${res.status}`);
        return res.json();
    },

    // Retry otomatis 2x (jeda 1.5s) kalau gagal karena jaringan/server — database
    // sudah cukup besar (puluhan ribu leads), upload besar makin rawan gagal
    // sebagian di tengah jalan kalau tidak ada retry.
    async patch(path, data, _attempt = 1) {
        try {
            const res = await fetch(`${PROXY_URL}?path=${encodeURIComponent(path)}`, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (!res.ok) throw new Error(`Firebase PATCH Error ${res.status}`);
            return res.json();
        } catch (err) {
            if (_attempt < 3) {
                await sleep(1500);
                return this.patch(path, data, _attempt + 1);
            }
            throw err;
        }
    },

    async delete(path) {
        const res = await fetch(`${PROXY_URL}?path=${encodeURIComponent(path)}`, {
            method: 'DELETE'
        });
        if (!res.ok) throw new Error(`Firebase DELETE Error ${res.status}`);
        return true;
    },

    /** Upsert batch: PATCH node dengan object { key: data } */
    async batchUpsert(basePath, data) {
        return this.patch(basePath, data);
    },

    /** Upsert bertahap per-chunk supaya progress bisa dilaporkan (onProgress(done, total)) */
    async chunkedUpsert(basePath, data, chunkSize = 150, onProgress) {
        const entries = Object.entries(data);
        const total = entries.length;
        let done = 0;
        for (let i = 0; i < entries.length; i += chunkSize) {
            const slice = entries.slice(i, i + chunkSize);
            await this.patch(basePath, Object.fromEntries(slice));
            done += slice.length;
            if (onProgress) onProgress(done, total);
        }
        return { total };
    }
};
