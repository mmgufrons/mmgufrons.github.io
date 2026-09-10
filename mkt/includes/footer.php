    <!-- ======== FOOTER ======== -->
    <footer class="mt-auto py-5 text-center" style="border-top:1px solid rgba(0,0,0,0.05);background:transparent;">
        <p class="text-muted small mb-0">
            &copy; <?= date('Y') ?> <strong style="color:#7335B7;">SIMASRIM</strong> — PT Solusi Mitra Aplikasi.<br>
            <span style="font-size:0.75rem;opacity:0.7;"><?= isset($footer_desc) ? htmlspecialchars($footer_desc) : 'Marketing OS Hub — Dokumen Internal Terbatas.' ?></span>
        </p>
    </footer>

</div><!-- end #mainContent -->

<!-- Bootstrap 5 JS Bundle (Popovers, Dropdowns, Modals) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    if (typeof AOS !== 'undefined') AOS.init({ duration: 700, once: true, offset: 60 });

    // ── Fungsi Copy WA Text (Global) ──────────────────────────────
    function copyWaText(elementId, btnElement) {
        var textElement = document.getElementById(elementId);
        if (!textElement) return;
        var textToCopy = textElement.innerText;
        var tempTextArea = document.createElement('textarea');
        tempTextArea.value = textToCopy;
        document.body.appendChild(tempTextArea);
        tempTextArea.select();
        document.execCommand('copy');
        document.body.removeChild(tempTextArea);

        var originalHTML  = btnElement.innerHTML;
        var originalClass = btnElement.className;
        btnElement.innerHTML = '<i class="fas fa-check"></i> Disalin!';
        btnElement.classList.add('copied');
        setTimeout(function () {
            btnElement.innerHTML = originalHTML;
            btnElement.className = originalClass;
        }, 2000);
    }

    // ── Fungsi Copy Teks Biasa (Non-WA) ──────────────────────────
    function copyText(text, btnElement) {
        navigator.clipboard.writeText(text).then(function() {
            var originalHTML  = btnElement.innerHTML;
            var originalClass = btnElement.className;
            btnElement.innerHTML = '<i class="fas fa-check"></i> Disalin!';
            btnElement.classList.add('copied');
            setTimeout(function () {
                btnElement.innerHTML = originalHTML;
                btnElement.className = originalClass;
            }, 2000);
        });
    }
</script>
</body>
</html>