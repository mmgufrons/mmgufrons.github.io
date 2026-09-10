<footer class="bg-dark text-white py-4 border-top">
    <div class="container text-center">
        <p class="text-white-50 small mb-0">
            © 2026 <b>SIMASRIM</b>. PT Solusi Mitra Aplikasi.<br>
            <?= isset($footer_desc) ? $footer_desc : 'Dokumen Internal Terbatas - B2B & API Partner Portal.'; ?>
        </p>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script> 
    if(typeof AOS !== 'undefined') {
        AOS.init({ duration: 800, once: true }); 
    }

    document.addEventListener("DOMContentLoaded", function(){
        const navbar = document.querySelector('.navbar-glass');
        const logoText = document.getElementById('logoText');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                logoText.style.color = "var(--primary)";
            } else {
                navbar.classList.remove('scrolled');
                logoText.style.color = "white";
            }
        });
    });
</script>
</body>
</html>