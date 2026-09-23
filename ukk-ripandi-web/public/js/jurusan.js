document.addEventListener('DOMContentLoaded', function () {

    // ---- Lightbox untuk foto kepala kompetensi & kegiatan ----
    const lightbox    = document.getElementById('pjLightbox');
    const lightboxImg = document.getElementById('pjLightboxImg');
    const closeBtn    = document.getElementById('pjLightboxClose');

    function openLightbox(src, alt) {
        if (!lightbox || !lightboxImg) return;
        lightboxImg.src = src;
        lightboxImg.alt = alt || '';
        lightbox.classList.add('active');
    }

    function closeLightbox() {
        if (!lightbox) return;
        lightbox.classList.remove('active');
        lightboxImg.src = '';
    }

    document.querySelectorAll('img[data-lightbox]').forEach(function (img) {
        img.addEventListener('click', function () {
            openLightbox(img.src, img.alt);
        });
    });

    if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
    if (lightbox) {
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) closeLightbox();
        });
    }
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLightbox();
    });

    // ---- Highlight tab navigasi sesuai section yang sedang dilihat ----
    const tabLinks = document.querySelectorAll('.pj-tabnav-item');
    const sections = document.querySelectorAll('.pj-jurusan-block');

    function setActiveTab(targetId) {
        tabLinks.forEach(function (link) {
            link.classList.toggle('active', link.dataset.target === targetId);
        });
    }

    if (sections.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    setActiveTab(entry.target.id);
                }
            });
        }, { threshold: 0.4 });

        sections.forEach(function (section) {
            observer.observe(section);
        });
    }

    tabLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            setActiveTab(link.dataset.target);
        });
    });
});