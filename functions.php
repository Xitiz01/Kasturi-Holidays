<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */  

add_action( 'wp_enqueue_scripts', 'kadence_child_style' );
				function kadence_child_style() {
					wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
					wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
				}

/**
 * registering the package widget here 
 */


function register_kasturi_package_widget( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/widget/kasturi-package-widget.php';
    require_once get_stylesheet_directory() . '/widget/kasturi-banner-widget.php';

    $widgets_manager->register( new \Kasturi_Packages_Widget() );
    $widgets_manager->register( new \Kasturi_Banner_Widget() );

}
add_action( 'elementor/widgets/register', 'register_kasturi_package_widget' );

// Function For Preloader
function kadence_child_preloader_markup() {
    ?>
    <div id="site-preloader">
        <div class="preloader-spinner"></div>
    </div>
    <?php
}
add_action('wp_body_open', 'kadence_child_preloader_markup');

function kadence_child_enqueue_preloader_script() {
    wp_enqueue_script(
        'kadence-child-preloader',
        get_stylesheet_directory_uri() . '/js/preloader.js',
        array(),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'kadence_child_enqueue_preloader_script');



//  enqueue Swiper in your functions.php:

add_action('wp_enqueue_scripts', function() {
    
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', [], null, true);
    wp_enqueue_script('kadence-child-banner', get_stylesheet_directory_uri() . '/js/banner.js', ['swiper-js'], '1.0', true);
});