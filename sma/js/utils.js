/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/utils.js — Global Utility Functions
   Load ORDER: #2
   ============================================================ */

/**
 * Returns ISO date string (YYYY-MM-DD) in LOCAL timezone.
 * Anti-crash: handles invalid dates gracefully.
 */
function getLocalISODate(dateObj = new Date()) {
    try {
        const d = new Date(dateObj);
        if (isNaN(d.getTime())) return new Date().toISOString().split('T')[0];
        d.setMinutes(d.getMinutes() - d.getTimezoneOffset());
        return d.toISOString().split('T')[0];
    } catch (e) {
        return new Date().toISOString().split('T')[0];
    }
}

/**
 * Converts plain-text URLs into clickable <a> links.
 * Skips URLs already wrapped in href.
 */
function autoLinkify(text) {
    if (!text) return '';
    const urlRegex = /(https?:\/\/[^\s<]+)/g;
    return text.replace(urlRegex, function(url) {
        if (text.includes('href="' + url)) return url;
        return '<a href="' + url + '" target="_blank" class="text-blue-400 hover:underline">' + url + '</a>';
    });
}

/**
 * Format a date string for display (Indonesian locale).
 * @param {string} dateStr - ISO date string YYYY-MM-DD
 * @returns {string}
 */
function formatDateID(dateStr) {
    if (!dateStr) return '-';
    try {
        const d = new Date(dateStr + 'T00:00:00');
        return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    } catch (e) {
        return dateStr;
    }
}

/**
 * Generate a unique ID with a given prefix.
 * @param {string} prefix
 * @returns {string}
 */
function genId(prefix = 'id') {
    return prefix + '_' + Date.now() + Math.random().toString(36).substr(2, 5);
}

/**
 * Show a brief toast notification.
 * @param {string} message
 * @param {'success'|'error'|'info'} type
 */
function showToast(message, type = 'success') {
    const existing = document.getElementById('appToast');
    if (existing) existing.remove();

    const colors = {
        success: 'bg-emerald-700 border-emerald-500',
        error:   'bg-red-900 border-red-600',
        info:    'bg-blue-900 border-blue-600'
    };
    const icons = { success: 'fa-check-circle', error: 'fa-circle-xmark', info: 'fa-circle-info' };

    const toast = document.createElement('div');
    toast.id = 'appToast';
    toast.className = `fixed bottom-6 right-6 z-[9999] flex items-center gap-3 px-5 py-3 rounded-xl border shadow-2xl text-white text-sm font-medium animate-fadein ${colors[type]}`;
    toast.innerHTML = `<i class="fa-solid ${icons[type]}"></i> ${message}`;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.transition = 'opacity 0.3s';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
