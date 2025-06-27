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
        <div class="preloader-content">
            <?php 
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            if (has_custom_logo()) {
                echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="preloader-logo">';
            }
            ?>
            <div class="preloader-spinner"></div>
        </div>
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

// Enqueue custom login styles
function kasturi_custom_login_styles() {
    wp_enqueue_style(
        'kasturi-login-custom',
        get_stylesheet_directory_uri() . '/assets/css/login-custom.css'
    );
    wp_enqueue_style(
        'kasturi-main-style',
        get_stylesheet_directory_uri() . '/style.css'
    );
}
add_action('login_enqueue_scripts', 'kasturi_custom_login_styles');

// Hide the default WordPress login logo
add_action('login_enqueue_scripts', function() {
    echo '<style>body.login div#login h1 { display: none !important; }</style>';
});

// Output custom logo and site title above the login form
add_action('login_header', function() {
    $logo_id = get_theme_mod('custom_logo');
    $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : 'https://yourdomain.com/path/to/logo.png';
    $site_title = get_bloginfo('name');
    ?>
    <div class="kasturi-login-header" style="text-align:center; margin-bottom:0px;">
            <span class="kasturi-login-logo" style="display:inline-block;width:120px;height:120px;background-image:url('<?php echo esc_url($logo_url); ?>');background-size:contain;background-position:center;background-repeat:no-repeat;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.10);vertical-align:middle;"></span>
            <h1 style="color:#000; font-size:2rem; margin:50px 0 0 0;font-weight:700;"><?php echo esc_html($site_title); ?></h1>  
    </div>
    <?php
}); 