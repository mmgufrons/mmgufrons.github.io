/**
 * firebase-api.js — MP Report (Albani Store Analytics)
 * Mendukung mode live PHP proxy dan mode statis / offline (localStorage + seed JSON)
 */

const MP_STORAGE_KEY = 'porto_mkt_mp_report_v1';

async function getMPStore() {
    try {
        const raw = localStorage.getItem(MP_STORAGE_KEY);
        if (raw) return JSON.parse(raw);
        const res = await fetch('api/data/mp_report_seed.json');
        const seed = await res.json();
        localStorage.setItem(MP_STORAGE_KEY, JSON.stringify(seed));
        return seed;
    } catch(e) {
        console.warn('Fallback to local memory for MP report:', e);
        return { penjualan: {}, mutasi_saldo: {} };
    }
}

function saveMPStore(data) {
    try {
        localStorage.setItem(MP_STORAGE_KEY, JSON.stringify(data));
    } catch(e) {}
}

const FirebaseAPI = {
    async get(path, params = {}) {
        try {
            const queryParams = new URLSearchParams({ path, ...params });
            const res = await fetch(`api/firebase_proxy.php?${queryParams}`);
            if (res.ok) return await res.json();
        } catch(e) {}
        
        // Local fallback (GitHub Pages / Static Host)
        const store = await getMPStore();
        if (!path || path === '/') return store;
        const parts = path.replace(/^\//, '').split('/');
        let cur = store;
        for (const p of parts) {
            if (!cur || typeof cur !== 'object') return null;
            cur = cur[p];
        }
        return cur || {};
    },

    async patch(path, data) {
        try {
            const res = await fetch(`api/firebase_proxy.php?path=${encodeURIComponent(path)}`, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) return await res.json();
        } catch(e) {}

        const store = await getMPStore();
        const parts = path.replace(/^\//, '').split('/');
        let cur = store;
        for (let i = 0; i < parts.length - 1; i++) {
            if (!cur[parts[i]]) cur[parts[i]] = {};
            cur = cur[parts[i]];
        }
        const lastKey = parts[parts.length - 1];
        cur[lastKey] = { ...(cur[lastKey] || {}), ...data };
        saveMPStore(store);
        return data;
    },
    
    async put(path, data) {
        try {
            const res = await fetch(`api/firebase_proxy.php?path=${encodeURIComponent(path)}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) return await res.json();
        } catch(e) {}

        const store = await getMPStore();
        const parts = path.replace(/^\//, '').split('/');
        let cur = store;
        for (let i = 0; i < parts.length - 1; i++) {
            if (!cur[parts[i]]) cur[parts[i]] = {};
            cur = cur[parts[i]];
        }
        cur[parts[parts.length - 1]] = data;
        saveMPStore(store);
        return data;
    }
};
