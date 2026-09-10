/* ============================================================
   PORTOFOLIO DEMO — firebase-modular-mock.js (Legal Document Mgmt)
   Pengganti Firebase SDK modular (v9+) asli untuk tools/legal.
   Tidak pernah connect ke server Firebase manapun — data dibaca
   dari file JSON dummy (data/documents_seed.json) dan perubahan
   (set/push/update) disimpan ke localStorage saja.
   ============================================================ */

const STORE_KEY = "porto_mkt_legal_db_v1";
const listeners = {};

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
  if (path === "documents") seedUrl = "data/documents_seed.json";

  let value = null;
  if (seedUrl) {
    try {
      const r = await fetch(seedUrl);
      value = await r.json();
    } catch (e) {
      console.warn("[firebase-modular-mock] gagal load seed untuk", path, e);
    }
  }
  store[path] = value;
  saveStore(store);
  return value;
}

export function initializeApp() { return {}; }
export function getAuth() { return {}; }
export function signInAnonymously() { return Promise.resolve({ user: { uid: "demo-anon-user" } }); }
export function getDatabase() { return {}; }
export function serverTimestamp() { return Date.now(); }
export function ref(_db, path) { return { __path: path }; }
export function child(refObj, sub) { return { __path: refObj.__path + "/" + sub }; }

export function onValue(refObj, cb) {
  const path = refObj.__path;
  if (!listeners[path]) listeners[path] = [];
  listeners[path].push(cb);
  seedIfEmpty(path).then((value) => cb(makeSnapshot(value)));
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
