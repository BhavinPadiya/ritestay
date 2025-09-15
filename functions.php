<?php
//  Theme Functions

//  @package Ritestay

use RITESTAY\Inc\RITESTAY;

if (! defined('RITESTAY_DIR_PATH')) {
    define('RITESTAY_DIR_PATH', untrailingslashit(get_template_directory()));
}

if (! defined('RITESTAY_DIR_URI')) {
    define('RITESTAY_DIR_URI', untrailingslashit(get_template_directory_uri()));
}

require_once RITESTAY_DIR_PATH . '/inc/helpers/autoloaders.php';
require_once RITESTAY_DIR_PATH . '/inc/helpers/template-tags.php';

function ritestay_get_theme_instance(){
    RITESTAY::get_instance();
}
ritestay_get_theme_instance();