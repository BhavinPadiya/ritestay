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
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        //actions and filters
        add_action('after_setup_theme', [$this, 'setup_theme']);
    }

    public function setup_theme(){
        add_theme_support('title-tag');
    }

}
