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
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        //actions and filters
        add_action('after_setup_theme', [$this, 'setup_theme']);
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
        add_image_size( 'featured-thumbnail', 350, 233, true );
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
        global $content_width;
        if (! isset($content_width)) {
            $content_width = 1240;
        }
    }
}
