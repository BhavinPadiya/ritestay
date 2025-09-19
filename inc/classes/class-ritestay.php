<?php

/***
 *  @package Ritesite
 *  
 *  Bootstraps the Theme
 */

namespace RITESTAY\Inc;

use RITESTAY\Inc\Traits\Singleton;

class RITESTAY
{
    use Singleton;

    protected function __construct()
    {
        //load classes
        Assets::get_instance();
        Menus::get_instance();
        Meta_Boxes::get_instance();
        //setup hooks
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        //actions and filters
        add_action('after_setup_theme', [$this, 'setup_theme']);
        add_action('customize_register', [$this,'ritestay_customize_register']);
    }
    public function ritestay_customize_register($wp_customize)
    {

        // Add new panel for the theme options
        $wp_customize->add_section('ritestay_footer_section', array(
            'title'      => __('Footer Options', 'ritestay'),
            'priority'   => 30,
        ));

        // Add a setting for the 'About' text
        $wp_customize->add_setting('ritestay_about_text', array(
            'default'   => 'Welcome to Hotel Haveli, where tradition meets modern comfort. Nestled in the heart of the city, our rooms are designed to provide a serene and luxurious escape. We pride ourselves on our exceptional service and unique hospitality that makes every guest feel at home.',
            'transport' => 'refresh',
        ));

        // Add a control for the 'About' text (a text area)
        $wp_customize->add_control('ritestay_about_text_control', array(
            'label'      => __('About Us Text', 'ritestay'),
            'description' => 'Enter a brief description for the footer.',
            'section'    => 'ritestay_footer_section',
            'settings'   => 'ritestay_about_text',
            'type'       => 'textarea',
        ));

        // Add a setting and control for the 'Contact' info
        $wp_customize->add_setting('ritestay_contact_info', array(
            'default'   => '**Contact:** +91 99999 99999 | **Email:** info@hotelhaveli.com',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('ritestay_contact_info_control', array(
            'label'      => __('Contact Information', 'ritestay'),
            'description' => 'Enter your contact information.',
            'section'    => 'ritestay_footer_section',
            'settings'   => 'ritestay_contact_info',
            'type'       => 'textarea',
        ));
    }


    public function setup_theme()
    {
        add_theme_support('title-tag');

        add_theme_support('custom-logo', [
            'header-text'          => array('site-title', 'site-description'),
            'height'               => 100,
            'width'                => 400,
            'flex-height'          => true,
            'flex-width'           => true,
        ]);

        $args = array(
            'default-color' => '#fff',
            'default-image' => '',
        );
        add_theme_support('custom-background', $args);
        add_theme_support('post-thumbnails');
        add_image_size('featured-thumbnail', 350, 233, true);
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('automatic');
        add_theme_support('automatic-feed-links');
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style',
            ]
        );
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        add_theme_support('editor-styles');
        add_editor_style('');
        remove_theme_support('core-block-patterns');
        add_image_size('room-card-thumb', 400, 300, true);
        global $content_width;
        if (! isset($content_width)) {
            $content_width = 1240;
        }
    }
}
