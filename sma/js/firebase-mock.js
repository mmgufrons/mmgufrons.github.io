/* ============================================================
   PORTOFOLIO DEMO — firebase-mock.js
   Pengganti Firebase SDK asli (app/database/auth compat) untuk
   versi portofolio publik. Tidak pernah menghubungi server Firebase
   manapun — semua data dibaca/ditulis dari localStorage browser,
   di-seed awal dari data/dummy-seed.json (data fiktif).

   Implementasi ini HANYA mencakup subset API yang dipakai oleh
   aplikasi ini (ref/on/once/set/update/push/remove/child,
   orderByChild/equalTo/limitToLast, auth basic). Cukup untuk demo,
   bukan tiruan lengkap Firebase SDK.
   ============================================================ */
(function (global) {
  "use strict";

  var STORAGE_KEY = "porto_sma_db_v1";
  var AUTH_KEY = "porto_sma_auth_v1";
  var SEED_URL = "data/dummy-seed.json";

  // ---------- Tiny path/tree helpers ----------
  function getAt(tree, path) {
    var parts = path.split("/").filter(Boolean);
    var cur = tree;
    for (var i = 0; i < parts.length; i++) {
      if (cur == null) return null;
      cur = cur[parts[i]];
    }
    return cur === undefined ? null : cur;
  }
  function setAt(tree, path, value) {
    var parts = path.split("/").filter(Boolean);
    if (parts.length === 0) return value;
    var cur = tree;
    for (var i = 0; i < parts.length - 1; i++) {
      var k = parts[i];
      if (cur[k] == null || typeof cur[k] !== "object") cur[k] = {};
      cur = cur[k];
    }
    var lastKey = parts[parts.length - 1];
    if (value === null) {
      delete cur[lastKey];
    } else {
      cur[lastKey] = value;
    }
    return tree;
  }
  function mergeAt(tree, path, patch) {
    var existing = getAt(tree, path);
    if (existing == null || typeof existing !== "object") existing = {};
    Object.keys(patch).forEach(function (k) {
      existing[k] = patch[k];
    });
    setAt(tree, path, existing);
    return tree;
  }
  function clone(v) {
    return v == null ? v : JSON.parse(JSON.stringify(v));
  }
  function genKey() {
    var t = Date.now().toString(36);
    var r = Math.random().toString(36).slice(2, 10);
    return "-M" + t + r;
  }

  // ---------- Penggeser tanggal seed (biar demo selalu kelihatan "hari ini") ----------
  // data/dummy-seed.json ditulis relatif ke tanggal jangkar ANCHOR_DATE (tugas yang jatuh
  // tepat di tanggal ini akan selalu digeser jadi "hari ini" berapa pun sekarang dibuka).
  // holidays sengaja TIDAK digeser (itu tanggal libur nasional asli, bukan data relatif demo).
  var ANCHOR_DATE = "2026-08-31";
  var DATE_ONLY_RE = /^\d{4}-\d{2}-\d{2}$/;
  var DATE_TIME_RE = /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}(\.\d+)?Z?$/;

  function daysBetween(fromISODate, toDate) {
    var from = new Date(fromISODate + "T00:00:00.000Z");
    var toMidnight = new Date(Date.UTC(toDate.getFullYear(), toDate.getMonth(), toDate.getDate()));
    return Math.round((toMidnight - from) / 86400000);
  }
  function shiftDateOnly(str, shiftDays) {
    var d = new Date(str + "T00:00:00.000Z");
    d.setUTCDate(d.getUTCDate() + shiftDays);
    return d.toISOString().slice(0, 10);
  }
  function shiftDateTime(str, shiftDays) {
    var d = new Date(str);
    d.setUTCDate(d.getUTCDate() + shiftDays);
    return d.toISOString();
  }
  function shiftDatesDeep(node, shiftDays) {
    if (Array.isArray(node)) {
      for (var i = 0; i < node.length; i++) {
        if (typeof node[i] === "string") {
          if (DATE_ONLY_RE.test(node[i])) node[i] = shiftDateOnly(node[i], shiftDays);
          else if (DATE_TIME_RE.test(node[i])) node[i] = shiftDateTime(node[i], shiftDays);
        } else if (node[i] && typeof node[i] === "object") {
          shiftDatesDeep(node[i], shiftDays);
        }
      }
    } else if (node && typeof node === "object") {
      Object.keys(node).forEach(function (k) {
        var v = node[k];
        if (typeof v === "string") {
          if (DATE_ONLY_RE.test(v)) node[k] = shiftDateOnly(v, shiftDays);
          else if (DATE_TIME_RE.test(v)) node[k] = shiftDateTime(v, shiftDays);
        } else if (v && typeof v === "object") {
          shiftDatesDeep(v, shiftDays);
        }
      });
    }
  }
  // Geser seluruh isi seed KECUALI node "holidays" (tanggal libur nasional asli).
  function applyDemoDateShift(seed) {
    var shiftDays = daysBetween(ANCHOR_DATE, new Date());
    if (shiftDays === 0) return seed;
    Object.keys(seed || {}).forEach(function (k) {
      if (k === "holidays") return;
      shiftDatesDeep(seed[k], shiftDays);
    });
    return seed;
  }

  // ---------- In-memory tree + persistence ----------
  var TREE = null;
  var listeners = []; // {path, event, cb}

  function persist() {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(TREE));
    } catch (e) {
      console.warn("[firebase-mock] gagal simpan ke localStorage:", e);
    }
  }

  function loadFromStorageOrSeed(cb) {
    try {
      var raw = localStorage.getItem(STORAGE_KEY);
      if (raw) {
        TREE = JSON.parse(raw);
        cb();
        return;
      }
    } catch (e) {
      console.warn("[firebase-mock] localStorage tidak bisa dibaca:", e);
    }
    fetch(SEED_URL)
      .then(function (r) {
        return r.json();
      })
      .then(function (seed) {
        TREE = applyDemoDateShift(seed || {});
        persist();
        cb();
      })
      .catch(function (e) {
        console.warn("[firebase-mock] gagal load seed, pakai tree kosong:", e);
        TREE = {};
        cb();
      });
  }

  function notify(path) {
    // Beritahu listener yang path-nya sama, ancestor, atau descendant dari path yg berubah.
    listeners.forEach(function (l) {
      if (
        l.path === path ||
        path.indexOf(l.path + "/") === 0 ||
        l.path.indexOf(path + "/") === 0 ||
        l.path === "" ||
        path === ""
      ) {
        fireListener(l);
      }
    });
  }

  function makeSnapshot(path, valueOverride) {
    var val = valueOverride !== undefined ? valueOverride : getAt(TREE, path);
    var parts = path.split("/").filter(Boolean);
    return {
      val: function () {
        return clone(val);
      },
      key: parts.length ? parts[parts.length - 1] : null,
      exists: function () {
        return val !== null && val !== undefined;
      },
      forEach: function (fn) {
        if (val && typeof val === "object") {
          Object.keys(val).forEach(function (k) {
            fn(makeSnapshot(path + "/" + k, val[k]));
          });
        }
      },
      child: function (key) {
        return makeSnapshot(path + "/" + key);
      },
    };
  }

  function applyQuery(rawObj, q) {
    if (!q || !rawObj || typeof rawObj !== "object") return rawObj;
    var entries = Object.keys(rawObj).map(function (k) {
      return [k, rawObj[k]];
    });
    if (q.orderByChild) {
      entries.sort(function (a, b) {
        var av = a[1] ? a[1][q.orderByChild] : undefined;
        var bv = b[1] ? b[1][q.orderByChild] : undefined;
        if (av === bv) return 0;
        return av > bv ? 1 : -1;
      });
    }
    if (q.equalTo !== undefined && q.orderByChild) {
      entries = entries.filter(function (e) {
        return e[1] && e[1][q.orderByChild] === q.equalTo;
      });
    }
    if (q.limitToLast) entries = entries.slice(-q.limitToLast);
    if (q.limitToFirst) entries = entries.slice(0, q.limitToFirst);
    var out = {};
    entries.forEach(function (e) {
      out[e[0]] = e[1];
    });
    return out;
  }

  function fireListener(l) {
    var raw = getAt(TREE, l.path);
    var val = applyQuery(raw, l.query);
    if (l.event === "value") {
      l.cb(makeSnapshot(l.path, val));
    } else if (l.event === "child_added") {
      if (val && typeof val === "object") {
        Object.keys(val).forEach(function (k) {
          l.cb(makeSnapshot(l.path + "/" + k, val[k]));
        });
      }
    }
    // child_changed/child_removed: tidak dipakai secara kritikal di app ini untuk demo.
  }

  // ---------- Query/Ref object ----------
  function makeRef(path, query) {
    path = path.replace(/^\/+/, "").replace(/\/+$/, "");
    var ref = {
      key: path.split("/").filter(Boolean).slice(-1)[0] || null,
      child: function (childPath) {
        return makeRef(path + "/" + childPath);
      },
      push: function (data) {
        var newKey = genKey();
        var newPath = path + "/" + newKey;
        if (data !== undefined) {
          setAt(TREE, newPath, clone(data));
          persist();
          notify(path);
        }
        var pushedRef = makeRef(newPath);
        pushedRef.then = function (resolve, reject) {
          return Promise.resolve().then(resolve, reject);
        };
        return pushedRef;
      },
      set: function (data) {
        return new Promise(function (resolve) {
          setAt(TREE, path, clone(data));
          persist();
          notify(path);
          resolve();
        });
      },
      update: function (patch) {
        return new Promise(function (resolve) {
          mergeAt(TREE, path, clone(patch));
          persist();
          notify(path);
          resolve();
        });
      },
      remove: function () {
        return new Promise(function (resolve) {
          setAt(TREE, path, null);
          persist();
          notify(path);
          resolve();
        });
      },
      once: function (event) {
        return new Promise(function (resolve) {
          var raw = getAt(TREE, path);
          var val = applyQuery(raw, query);
          resolve(makeSnapshot(path, val));
        });
      },
      on: function (event, cb) {
        var l = { path: path, event: event, cb: cb, query: query };
        listeners.push(l);
        fireListener(l);
        return cb;
      },
      off: function () {
        listeners = listeners.filter(function (l) {
          return l.path !== path;
        });
      },
      orderByChild: function (field) {
        return makeRef(path, Object.assign({}, query, { orderByChild: field }));
      },
      orderByKey: function () {
        return makeRef(path, query);
      },
      equalTo: function (v) {
        return makeRef(path, Object.assign({}, query, { equalTo: v }));
      },
      limitToLast: function (n) {
        return makeRef(path, Object.assign({}, query, { limitToLast: n }));
      },
      limitToFirst: function (n) {
        return makeRef(path, Object.assign({}, query, { limitToFirst: n }));
      },
      startAt: function () {
        return ref;
      },
      endAt: function () {
        return ref;
      },
    };
    return ref;
  }

  // ---------- Auth mock ----------
  var authListeners = [];
  var currentAuthUser = null;

  function loadAuthUser() {
    try {
      var raw = localStorage.getItem(AUTH_KEY);
      currentAuthUser = raw ? JSON.parse(raw) : null;
    } catch (e) {
      currentAuthUser = null;
    }
  }
  function saveAuthUser(u) {
    currentAuthUser = u;
    try {
      if (u) localStorage.setItem(AUTH_KEY, JSON.stringify(u));
      else localStorage.removeItem(AUTH_KEY);
    } catch (e) {}
  }
  function fireAuthListeners() {
    authListeners.forEach(function (cb) {
      cb(currentAuthUser);
    });
  }
  function findDemoUserByEmail(email) {
    var users = (TREE && TREE.users) || {};
    var uid = Object.keys(users).find(function (k) {
      return users[k] && users[k].email === email;
    });
    if (uid) return { uid: uid, email: users[uid].email };
    // fallback: siapapun yang login dianggap SuperAdmin demo pertama
    var firstUid = Object.keys(users)[0];
    return firstUid ? { uid: firstUid, email: users[firstUid].email } : { uid: "demoUID000001", email: email };
  }

  var authObj = {
    get currentUser() {
      return currentAuthUser;
    },
    onAuthStateChanged: function (cb) {
      authListeners.push(cb);
      // Firebase asli memanggil callback secara async setelah cek sesi.
      setTimeout(function () {
        cb(currentAuthUser);
      }, 50);
    },
    setPersistence: function () {
      return Promise.resolve();
    },
    signInWithEmailAndPassword: function (email) {
      return new Promise(function (resolve) {
        var u = findDemoUserByEmail(email);
        saveAuthUser(u);
        setTimeout(function () {
          fireAuthListeners();
        }, 0);
        resolve({ user: u });
      });
    },
    signInWithPopup: function () {
      return new Promise(function (resolve) {
        var users = (TREE && TREE.users) || {};
        var firstUid = Object.keys(users)[0] || "demoUID000001";
        var u = { uid: firstUid, email: (users[firstUid] && users[firstUid].email) || "demo@contoh-perusahaan.demo" };
        saveAuthUser(u);
        setTimeout(function () {
          fireAuthListeners();
        }, 0);
        resolve({ user: u });
      });
    },
    signInWithCredential: function () {
      return authObj.signInWithPopup();
    },
    sendPasswordResetEmail: function () {
      return Promise.resolve();
    },
    signOut: function () {
      return new Promise(function (resolve) {
        saveAuthUser(null);
        fireAuthListeners();
        resolve();
      });
    },
  };

  // ---------- Public firebase.* API ----------
  var firebase = {
    initializeApp: function () {
      /* no-op: demo tidak pernah connect ke server manapun */
    },
    database: function () {
      return {
        ref: function (path) {
          return makeRef(path || "");
        },
      };
    },
    auth: function () {
      return authObj;
    },
  };
  firebase.auth.Auth = { Persistence: { LOCAL: "local", SESSION: "session", NONE: "none" } };
  firebase.auth.GoogleAuthProvider = function () {};

  global.firebase = firebase;

  // Tombol "Isi Data Dummy" (widget melayang, tampil di layar login maupun
  // setelah masuk) memanggil fungsi ini: ambil ulang data/dummy-seed.json,
  // timpa localStorage, langsung "login-kan" otomatis sebagai user demo
  // pertama (SuperAdmin) supaya sekali klik langsung tampil ke dashboard
  // berisi data — tidak perlu login manual lagi.
  global.portoResetSeedData = function () {
    return fetch(SEED_URL)
      .then(function (r) { return r.json(); })
      .then(function (seed) {
        TREE = applyDemoDateShift(seed || {});
        persist();
        var users = TREE.users || {};
        var firstUid = Object.keys(users)[0];
        var u = firstUid
          ? { uid: firstUid, email: users[firstUid].email }
          : { uid: "demoUID000001", email: "demo@contoh-perusahaan.demo" };
        saveAuthUser(u);
        global.location.reload();
      })
      .catch(function (e) {
        console.warn("[firebase-mock] gagal reset seed:", e);
        alert("Gagal memuat data dummy. Coba lagi.");
      });
  };

  // Muat data (seed/localStorage) sebelum modul lain jalan.
  // Karena script ini synchronous-loaded sebelum firebase-config.js dkk,
  // kita blok pemanggilan db/auth sampai TREE siap dengan cara sederhana:
  // seluruh app baru dipakai setelah DOMContentLoaded, jadi kita muat di sini
  // secara "sync-ish" dengan XMLHttpRequest supaya TREE pasti terisi duluan.
  (function loadSync() {
    try {
      var raw = localStorage.getItem(STORAGE_KEY);
      if (raw) {
        TREE = JSON.parse(raw);
      } else {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", SEED_URL, false); // synchronous, hanya sekali saat pertama kali load
        xhr.send(null);
        TREE = xhr.status === 200 ? applyDemoDateShift(JSON.parse(xhr.responseText)) : {};
        persist();
      }
    } catch (e) {
      console.warn("[firebase-mock] init sync load gagal, fallback async:", e);
      TREE = TREE || {};
    }
    loadAuthUser();
  })();
})(window);
