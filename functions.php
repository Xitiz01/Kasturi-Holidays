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
    $widgets_manager->register( new \Kasturi_Packages_Widget() );
}
add_action( 'elementor/widgets/register', 'register_kasturi_package_widget' );

