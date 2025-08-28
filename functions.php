<?php
//  Theme Functions

//  @package Ritestay

//use RITESTAY\Inc\RITESTAY;

if (! defined('RITESTAY_DIR_PATH')) {
    define('RITESTAY_DIR_PATH', untrailingslashit(get_template_directory()));
}

require_once RITESTAY_DIR_PATH . '/inc/helpers/autoloaders.php';

add_action( 'after_setup_theme', function () {
    if ( class_exists( \RITESTAY\Inc\RITESTAY::class ) ) {
        \RITESTAY\Inc\RITESTAY::get_instance();
        error_log('RITESTAY booted');
    } else {
        error_log('RITESTAY class NOT found. Autoloader/path issue.');
    }
});

function ritestay_enqueue_scripts()
{
    // Registering styles
    wp_register_style('stylesheet', get_stylesheet_uri(), [], filemtime(get_template_directory() . '/style.css'), 'all');
    wp_register_style('bootstrap-css', get_template_directory_uri(  ) . '/assets/src/library/css/bootstrap.min.css', [], false, 'all');

    // Registering scripts
    wp_register_script('main-js', get_template_directory_uri(  ) . '/assets/main.js', [], filemtime(get_template_directory() . '/assets/main.js'), true);
    wp_register_script('bootstrap-js', get_template_directory_uri(  ). '/assets/src/library/js/bootstrap.min.js', ['jquery'], false, true);

    // Enqueuing styles
    wp_enqueue_style('stylesheet');
    wp_enqueue_style('bootstrap-css');

    // Enqueuing scripts
    wp_enqueue_script('main-js');
    wp_enqueue_script('bootstrap-js'); 
}

add_action('wp_enqueue_scripts', 'ritestay_enqueue_scripts');