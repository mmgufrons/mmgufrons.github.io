document.addEventListener('DOMContentLoaded', () => {
    // Initialize tooltips using Tippy.js
    const iconCards = document.querySelectorAll('.icon-card');
    
    iconCards.forEach(card => {
        const dataEl = card.querySelector('.tooltip-data');
        if (!dataEl) return;
        
        const title = dataEl.dataset.title || '';
        const desc = dataEl.dataset.desc || '';
        const id = dataEl.dataset.id || '';
        const pw = dataEl.dataset.pw || '';
        const hasCreds = id !== '' || pw !== '';

        let contentHtml = `
            <div class="tt-title">${title}</div>
            ${desc ? `<div class="tt-desc">${desc}</div>` : ''}
        `;

        if (hasCreds) {
            contentHtml += `<div class="tt-cred">`;
            if (id) {
                contentHtml += `
                    <div class="tt-cred-row">
                        <span class="tt-label">ID/Email:</span>
                        <span class="tt-val">${id}</span>
                    </div>
                `;
            }
            if (pw) {
                contentHtml += `
                    <div class="tt-cred-row">
                        <span class="tt-label">Password:</span>
                        <span class="tt-val">${pw}</span>
                    </div>
                `;
            }
            contentHtml += `</div>`;
            contentHtml += `<div class="tt-instruction"><i class="ph-bold ph-cursor-click"></i> Klik icon untuk copy otomatis & buka link</div>`;
        } else {
            contentHtml += `<div class="tt-instruction" style="color: var(--accent-hover);"><i class="ph-bold ph-cursor-click"></i> Klik icon untuk buka link</div>`;
        }

        tippy(card, {
            content: contentHtml,
            allowHTML: true,
            theme: 'glass',
            placement: 'top',
            animation: 'scale',
            delay: [100, 0],
            maxWidth: 300,
        });

        // Click handler for copying and opening
        card.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default link behavior initially
            const targetUrl = card.getAttribute('href');

            if (hasCreds) {
                // Copy logic: if there is a password, copy it. If only ID, copy ID. If both, copy PW usually is more helpful, or format it. Let's copy PW if exists, else ID.
                let textToCopy = pw ? pw : id;
                
                navigator.clipboard.writeText(textToCopy).then(() => {
                    showToast(`Tersalin: ${textToCopy}`);
                    // Open link after short delay to allow toast to be seen
                    setTimeout(() => {
                        window.open(targetUrl, '_blank');
                    }, 300);
                }).catch(err => {
                    console.error('Failed to copy', err);
                    window.open(targetUrl, '_blank');
                });
            } else {
                // Just open the link
                window.open(targetUrl, '_blank');
            }
        });
    });
});

// Toast notification system
function showToast(message) {
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `<i class="ph-fill ph-check-circle"></i> ${message}`;
    
    container.appendChild(toast);
    
    // Trigger animation
    setTimeout(() => toast.classList.add('show'), 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
