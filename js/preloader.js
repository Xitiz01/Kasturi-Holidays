// js/preloader.js
document.addEventListener('DOMContentLoaded', function() {
    var preloader = document.getElementById('site-preloader');
    var preloaderLogo = document.querySelector('.preloader-logo');
    
    if (preloader) {
        // Function to hide preloader
        function hidePreloader() {
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
        
        // Hide preloader when DOM is ready (faster)
        setTimeout(hidePreloader, 1000); // Minimum 1 second display
        
        // Also hide when window fully loads (fallback)
        window.addEventListener('load', function() {
            setTimeout(hidePreloader, 100); // Quick hide if still visible
        });
        
        // Maximum timeout to prevent infinite spinning
        setTimeout(function() {
            if (preloader.style.display !== 'none') {
                hidePreloader();
            }
        }, 5000); // Maximum 5 seconds
    }
});