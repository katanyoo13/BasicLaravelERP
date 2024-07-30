// resources/js/sidebar.js

document.addEventListener('DOMContentLoaded', function() {
    var navLinks = document.querySelectorAll('.nav-link[data-bs-toggle="collapse"]');
    navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function() {
            // ปิดเมนูทั้งหมดก่อน
            navLinks.forEach(function(link) {
                var target = document.querySelector(link.getAttribute('href'));
                if (target !== document.querySelector(navLink.getAttribute('href'))) {
                    var collapse = new bootstrap.Collapse(target, {
                        toggle: false
                    });
                    collapse.hide();
                }
            });
            // เปิดเมนูที่ถูกคลิก
            var target = document.querySelector(navLink.getAttribute('href'));
            var collapse = new bootstrap.Collapse(target, {
                toggle: true
            });
        });
    });
});
