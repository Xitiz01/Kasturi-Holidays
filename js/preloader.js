// js/preloader.js
document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener('load', function() {
        var preloader = document.getElementById('site-preloader');
        var preloaderLogo = document.querySelector('.preloader-logo');
        
        if (preloader) {
            // Add fade out class to logo first
            if (preloaderLogo) {
                preloaderLogo.classList.add('logo-fade-out');
            }
            
            // Then hide the entire preloader
            setTimeout(function() {
                preloader.classList.add('preloader-hidden');
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 600); // Match the CSS transition
            }, 300); // Small delay to allow logo animation
        }
    });
});