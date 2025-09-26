<?php

namespace RITESTAY\Inc;
use RITESTAY\Inc\Traits\Singleton;

/***
 * @package Ritestay
 * Assets class file
 */

class Assets
{
    use Singleton;

    protected function __construct()
    {
        //load classes
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        //actions and filters
        add_action('wp_enqueue_scripts', [$this, 'register_styles']);
        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
    }

    public function register_styles()
    {
        wp_register_style('stylesheet', get_stylesheet_uri(), [], filemtime(RITESTAY_DIR_PATH . '/style.css'), 'all');
        wp_register_style('bootstrap-css', RITESTAY_DIR_URI . '/assets/src/library/css/bootstrap.min.css', [], false, 'all');

        wp_enqueue_style('stylesheet');
        wp_enqueue_style('bootstrap-css');
    }

    public function register_scripts()
    {
        $site_title = get_bloginfo('name');
        wp_register_script('main-js', RITESTAY_DIR_URI . '/assets/main.js', [], filemtime(RITESTAY_DIR_PATH . '/assets/main.js'), true);
        wp_register_script('bootstrap-js', RITESTAY_DIR_URI . '/assets/src/library/js/bootstrap.bundle.min.js', ['jquery'], false, true);

        wp_enqueue_script('main-js');
        wp_enqueue_script('bootstrap-js');
        wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true );

        // Localize the script, passing the site title to a JS object named 'ritestayData'
    wp_localize_script( 'main-js', 'ritestayData', array(
        // We still need the bookingFormId for the JS logic to work (though it is found dynamically in JS)
        // We can pass the site title here to be theme safe.
        'siteTitle'   => esc_attr( $site_title )
    ));
    }
}
