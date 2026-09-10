const API_URL = 'api/firebase_proxy.php';

const FirebaseAPI = {
    async get(path, params = {}) {
        const queryParams = new URLSearchParams({ path, ...params });
        const res = await fetch(`${API_URL}?${queryParams}`);
        if (!res.ok) throw new Error(`HTTP Error ${res.status}`);
        return res.json();
    },

    async patch(path, data) {
        const res = await fetch(`${API_URL}?path=${encodeURIComponent(path)}`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        if (!res.ok) throw new Error(`HTTP Error ${res.status}`);
        return res.json();
    },
    
    async put(path, data) {
        const res = await fetch(`${API_URL}?path=${encodeURIComponent(path)}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        if (!res.ok) throw new Error(`HTTP Error ${res.status}`);
        return res.json();
    }
};
