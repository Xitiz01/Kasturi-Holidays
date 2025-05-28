// js/preloader.js
document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener('load', function() {
        var preloader = document.getElementById('site-preloader');
        if (preloader) {
            preloader.classList.add('preloader-hidden');
            setTimeout(function() {
                preloader.style.display = 'none';
            }, 600); // Match the CSS transition
        }
    });
})