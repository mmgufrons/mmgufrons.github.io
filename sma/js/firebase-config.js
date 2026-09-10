/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/firebase-config.js — Firebase Initialization
   Load ORDER: #1 (must be first)
   ============================================================ */

// PORTOFOLIO DEMO: seluruh config Firebase asli (apiKey, authDomain, databaseURL, dst) DIHAPUS
// TOTAL dan diganti dummy — firebase.initializeApp() di js/firebase-mock.js adalah no-op,
// jadi nilai di bawah ini tidak pernah benar-benar dipakai untuk connect ke server manapun.
const firebaseConfig = {
    apiKey: "DUMMY-SECRET-GANTI-SENDIRI",
    authDomain: "demo-project.firebaseapp.com",
    databaseURL: "https://demo-project-default-rtdb.firebaseio.com",
    projectId: "demo-project",
    storageBucket: "demo-project.firebasestorage.app",
    messagingSenderId: "000000000000",
    appId: "1:000000000000:web:0000000000000000000000",
    measurementId: "G-DUMMY000000"
};

firebase.initializeApp(firebaseConfig);

// Exported globals — used by all other modules
const db   = firebase.database();
const auth = firebase.auth();

// ── Global Current User Profile ───────────────────────────────
// Set after login by auth.js. Contains: uid, email, role, department, name
let currentUser = null;
