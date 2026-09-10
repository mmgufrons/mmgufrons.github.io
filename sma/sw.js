/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   sw.js — Service Worker (PWA)
   Strategy:
     • Static assets  → Cache-First (CSS, JS, fonts, icons)
     • Firebase Auth/RTDB → Network-Only (real-time, no cache)
     • Navigation     → Network-First → Cache Fallback → offline.html
   ============================================================ */

const CACHE_NAME    = 'simasrim-os-v10.3';
const OFFLINE_URL   = 'offline.html';

// Assets to pre-cache on install (paths relative to sw.js location)
const PRECACHE_URLS = [
    './',
    './index.html',
    './offline.html',
    './manifest.json',
    './js/firebase-mock.js',
    './js/vendor/fullcalendar.min.js',
    './js/vendor/chart.umd.min.js',
    './js/vendor/jspdf.umd.min.js',
    './js/vendor/jspdf.plugin.autotable.min.js',
    './js/firebase-config.js',
    './js/utils.js',
    './js/state.js',
    './js/auth.js',
    './js/engine.js',
    './js/modals.js',
    './js/stats.js',
    './js/export.js',
    './js/app.js',
    './js/views/today.js',
    './js/views/meeting.js',
    './js/views/board.js',
    './js/views/calendar.js',
    './js/views/routines.js',
    './js/views/notes.js',
    './js/views/archive.js',
    './js/views/activity.js',
    './js/views/search.js',
    './js/views/analytics.js',
    './js/views/executive.js',
    './js/views/supervisor.js',
    './js/views/users.js',
    './js/views/guide.js',
    // CDN (Font Awesome, Google Fonts) — best-effort
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
    'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
    'https://cdn.tailwindcss.com'
];

// ── INSTALL ──────────────────────────────────────────────────

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            console.log('[SW v10.3] Pre-caching assets...');
            const local = PRECACHE_URLS.filter(u => u.startsWith('.'));
            const cdn   = PRECACHE_URLS.filter(u => !u.startsWith('.'));

            return cache.addAll(local).then(() => {
                return Promise.allSettled(cdn.map(url =>
                    cache.add(new Request(url, { mode: 'no-cors' })).catch(() => {})
                ));
            });
        }).then(() => self.skipWaiting())
    );
});

// ── ACTIVATE ─────────────────────────────────────────────────

self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(keys =>
            Promise.all(keys
                .filter(k => k !== CACHE_NAME)
                .map(k => {
                    console.log('[SW] Deleting old cache:', k);
                    return caches.delete(k);
                })
            )
        ).then(() => self.clients.claim())
    );
});

// ── FETCH ─────────────────────────────────────────────────────

self.addEventListener('fetch', event => {
    const req = event.request;
    const url = new URL(req.url);

    // 1. Firebase RTDB / Auth (not SDK files) → ALWAYS network-only
    if (
        url.hostname.includes('firebasedatabase.app') ||
        url.hostname.includes('firebaseio.com') ||
        url.hostname.includes('identitytoolkit.googleapis.com') ||
        url.hostname.includes('securetoken.googleapis.com')
    ) {
        event.respondWith(fetch(req).catch(() => new Response('', { status: 503 })));
        return;
    }

    // 2. Non-GET → Network only
    if (req.method !== 'GET') {
        event.respondWith(fetch(req));
        return;
    }

    // 3. Navigation (HTML pages) → Network-first → Cache → Offline fallback
    if (req.mode === 'navigate') {
        event.respondWith(
            fetch(req)
                .then(res => {
                    const clone = res.clone();
                    caches.open(CACHE_NAME).then(c => c.put(req, clone));
                    return res;
                })
                .catch(() =>
                    caches.match(req)
                        .then(cached => cached || caches.match(OFFLINE_URL))
                )
        );
        return;
    }

    // 4. Static assets → Cache-first → Network fallback → cache it
    event.respondWith(
        caches.match(req).then(cached => {
            if (cached) return cached;
            return fetch(req).then(res => {
                if (res && res.status === 200) {
                    const clone = res.clone();
                    caches.open(CACHE_NAME).then(c => c.put(req, clone));
                }
                return res;
            }).catch(() => {
                // For images, return a transparent SVG placeholder
                if (req.destination === 'image') {
                    return new Response(
                        '<svg xmlns="http://www.w3.org/2000/svg" width="1" height="1"></svg>',
                        { headers: { 'Content-Type': 'image/svg+xml' } }
                    );
                }
            });
        })
    );
});
