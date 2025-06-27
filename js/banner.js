// Header sticky js to detect mouse scroll 

document.addEventListener("DOMContentLoaded", function() {
    const header = document.querySelector(".header-wrapper");

    window.addEventListener("scroll", function() {
        if (window.scrollY > 80) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });
});

// Ends here 



document.addEventListener('DOMContentLoaded', function() {
    // Initialize all banner sliders
    document.querySelectorAll('.kadence-child-banner-slider').forEach(sliderEl => {
        // Get slider options from data attribute
        const sliderOptions = JSON.parse(sliderEl.dataset.slider || '{}');
        
        // Swiper configuration
        const swiperConfig = {
            // Core parameters
            loop: sliderOptions.loop || false,
            speed: 800,
            effect: sliderOptions.effect || 'slide',
            autoHeight: false,
            centeredSlides: true,
            
            // Navigation
            navigation: {
                nextEl: sliderEl.querySelector('.swiper-button-next'),
                prevEl: sliderEl.querySelector('.swiper-button-prev'),
            },
            
            // Pagination
            pagination: {
                el: sliderEl.querySelector('.swiper-pagination'),
                clickable: true,
                type: 'bullets',
            },
            
            // Autoplay if enabled
            autoplay: sliderOptions.autoplay ? {
                delay: sliderOptions.autoplaySpeed || 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            } : false,
            
            // Responsive breakpoints
            breakpoints: {
                320: { slidesPerView: 1 },
                768: { slidesPerView: 1 },
                1024: { slidesPerView: 1 }
            },
            
            // Event callbacks
            on: {
                init: function() {
                    sliderEl.classList.add('swiper-loaded');
                    console.log('Banner slider initialized');
                },
                slideChange: function() {
                    const activeSlide = this.slides[this.activeIndex];
                    if (activeSlide) activeSlide.classList.add('slide-active');
                },
                slideChangeTransitionStart: function() {
                    this.slides.forEach(slide => slide.classList.remove('slide-active'));
                }
            }
        };

        // Effect-specific configurations
        if (sliderOptions.effect === 'fade') {
            swiperConfig.fadeEffect = { crossFade: true };
        }
        
        if (sliderOptions.effect === 'cube') {
            swiperConfig.cubeEffect = {
                shadow: true,
                slideShadows: true,
                shadowOffset: 20,
                shadowScale: 0.94,
            };
        }

        // Initialize Swiper
        try {
            const swiper = new Swiper(sliderEl, swiperConfig);
            
            // Handle autoplay hover state
            sliderEl.addEventListener('mouseenter', () => {
                if (swiper.autoplay?.running) swiper.autoplay.pause();
            });
            
            sliderEl.addEventListener('mouseleave', () => {
                if (swiper.autoplay?.paused) swiper.autoplay.resume();
            });
            
            // Store instance for future reference
            sliderEl.swiperInstance = swiper;

        } catch (error) {
            console.error('Swiper initialization error:', error);
        }
    });
});

// Handle window resize
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        document.querySelectorAll('.kadence-child-banner-slider').forEach(sliderEl => {
            if (sliderEl.swiperInstance) sliderEl.swiperInstance.update();
        });
    }, 250);
});
