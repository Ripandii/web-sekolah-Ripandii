document.addEventListener('DOMContentLoaded', function () {

    // ---- Slideshow hero ----
    const slideWrap = document.getElementById('berandaSlides');
    if (slideWrap) {
        const slides = slideWrap.querySelectorAll('.beranda-slide');
        if (slides.length > 1) {
            let current = 0;
            const DELAY = 5000;
            setInterval(function () {
                slides[current].classList.remove('active');
                current = (current + 1) % slides.length;
                slides[current].classList.add('active');
            }, DELAY);
        }
    }

    // ---- Switch halaman (Beranda, Galeri Foto, Jurusan, Galeri Prestasi, Eskul) ----
    const menuItems = document.querySelectorAll('.menu-item');
    const pages = document.querySelectorAll('.page');

    function showPage(pageName) {
        pages.forEach(function (page) {
            page.classList.toggle('active', page.id === 'page-' + pageName);
        });

        menuItems.forEach(function (item) {
            item.classList.toggle('active', item.dataset.page === pageName);
        });

        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Tutup menu mobile setelah memilih halaman
        const navMenu = document.querySelector('nav ul');
        if (navMenu) navMenu.classList.remove('active');
    }

    menuItems.forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const target = item.dataset.page;
            if (target) showPage(target);
        });
    });
});