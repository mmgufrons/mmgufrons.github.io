/* ============================================================
   PORTOFOLIO DEMO — firebase-modular-mock.js
   Pengganti Firebase SDK modular (v9+) asli untuk halaman-halaman
   mitra/partnership (info.php, tracker.php). Tidak pernah connect
   ke server Firebase manapun — data dibaca dari file JSON dummy di
   folder porto ini dan perubahan (set/push/update/remove) disimpan
   ke localStorage saja. Hanya subset API yang dipakai halaman-
   halaman ini yang diimplementasikan (bukan tiruan lengkap SDK).
   ============================================================ */

const STORE_KEY = "porto_mkt_mitra_db_v1";
const listeners = {}; // path -> [cb, ...]

function loadStore() {
  try {
    const raw = localStorage.getItem(STORE_KEY);
    return raw ? JSON.parse(raw) : {};
  } catch (e) {
    return {};
  }
}
function saveStore(store) {
  try {
    localStorage.setItem(STORE_KEY, JSON.stringify(store));
  } catch (e) {
    console.warn("[firebase-modular-mock] gagal simpan localStorage:", e);
  }
}
function genKey() {
  return "-M" + Date.now().toString(36) + Math.random().toString(36).slice(2, 10);
}

async function seedIfEmpty(path) {
  const store = loadStore();
  if (store[path] !== undefined && store[path] !== null) return store[path];

  let seedUrl = null;
  if (path === "b2b_info_mitra_data") seedUrl = "../pitching/mitra/json/info_mitra_data.json";
  if (path === "mitra_tracker") seedUrl = "json/mitra_tracker_dummy.json";

  let value = null;
  if (seedUrl) {
    try {
      const r = await fetch(seedUrl);
      if (r.ok) value = await r.json();
    } catch (e) {
      console.warn("[firebase-modular-mock] gagal load seed untuk", path, e);
    }
  }
  if (!value && path === "mitra_tracker") {
    value = {
      "demo_t_1": {
        "name": "Area Demo Selatan",
        "notes": "Sudah presentasi & onboarding, tinggal finalisasi materi campaign.",
        "assets": [],
        "progress": {
          "present": true, "grup": true, "nda": true, "penunjukan": true, "adendum": true,
          "akun": true, "looker": true, "am_brand": true, "am_area": true, "am_panduan": true,
          "am_flyer": false, "am_story": false, "am_presentasi": false, "am_sop": false, "am_banner": false,
          "plan": false, "jalan": false
        }
      },
      "demo_t_2": {
        "name": "Area Demo Utara",
        "notes": "Baru tahap presentasi awal & pembuatan grup WA.",
        "assets": [],
        "progress": {
          "present": true, "grup": true, "nda": false, "penunjukan": false, "adendum": false,
          "akun": false, "looker": false, "am_brand": false, "am_area": false, "am_panduan": false,
          "am_flyer": false, "am_story": false, "am_presentasi": false, "am_sop": false, "am_banner": false,
          "plan": false, "jalan": false
        }
      },
      "demo_t_3": {
        "name": "Area Demo Timur",
        "notes": "Sudah operasional penuh — jadi contoh mitra paling matang.",
        "assets": [],
        "progress": {
          "present": true, "grup": true, "nda": true, "penunjukan": true, "adendum": true,
          "akun": true, "looker": true, "am_brand": true, "am_area": true, "am_panduan": true,
          "am_flyer": true, "am_story": true, "am_presentasi": true, "am_sop": true, "am_banner": true,
          "plan": true, "jalan": true
        }
      }
    };
  }
  store[path] = value;
  saveStore(store);
  return value;
}

export function initializeApp() {
  return {};
}
export function getAuth() {
  return {};
}
export function signInAnonymously() {
  return Promise.resolve({ user: { uid: "demo-anon-user" } });
}
export function getDatabase() {
  return {};
}
export function ref(_db, path) {
  return { __path: path };
}
export function child(refObj, sub) {
  return { __path: refObj.__path + "/" + sub };
}

export function onValue(refObj, cb) {
  const path = refObj.__path;
  if (!listeners[path]) listeners[path] = [];
  listeners[path].push(cb);

  seedIfEmpty(path).then((value) => {
    cb(makeSnapshot(value));
  });

  // Kembalikan fungsi unsubscribe (kompatibel dengan Firebase modular SDK)
  return function unsubscribe() {
    listeners[path] = (listeners[path] || []).filter((f) => f !== cb);
  };
}

export async function get(refObj) {
  const value = await seedIfEmpty(refObj.__path);
  return makeSnapshot(value);
}

function notify(path) {
  const store = loadStore();
  (listeners[path] || []).forEach((cb) => cb(makeSnapshot(store[path])));
}

export function set(refObj, data) {
  const store = loadStore();
  store[refObj.__path] = data;
  saveStore(store);
  notify(refObj.__path);
  return Promise.resolve();
}

export function update(refObj, patch) {
  const store = loadStore();
  const existing = store[refObj.__path] && typeof store[refObj.__path] === "object" ? store[refObj.__path] : {};
  store[refObj.__path] = Object.assign({}, existing, patch);
  saveStore(store);
  notify(refObj.__path);
  return Promise.resolve();
}

export function remove(refObj) {
  const store = loadStore();
  delete store[refObj.__path];
  saveStore(store);
  notify(refObj.__path);
  return Promise.resolve();
}

export function push(refObj, data) {
  const key = genKey();
  const childPath = refObj.__path + "/" + key;
  if (data !== undefined) {
    const store = loadStore();
    const existing = store[refObj.__path] && typeof store[refObj.__path] === "object" ? store[refObj.__path] : {};
    existing[key] = data;
    store[refObj.__path] = existing;
    saveStore(store);
    notify(refObj.__path);
  }
  return { __path: childPath, key, then: (fn) => Promise.resolve().then(fn) };
}

function makeSnapshot(value) {
  return {
    exists: () => value !== null && value !== undefined,
    val: () => value,
    key: null,
    forEach: (fn) => {
      if (value && typeof value === "object") {
        Object.keys(value).forEach((k) => fn(makeSnapshotWithKey(k, value[k])));
      }
    },
  };
}
function makeSnapshotWithKey(key, value) {
  return {
    exists: () => value !== null && value !== undefined,
    val: () => value,
    key,
    forEach: (fn) => {
      if (value && typeof value === "object") {
        Object.keys(value).forEach((k) => fn(makeSnapshotWithKey(k, value[k])));
      }
    },
  };
}
