<?php
//  Theme Functions

//  @package Ritestay

function ritestay_enqueue_scripts(){
    wp_register_style('stylesheet',get_stylesheet_uri(),[], filemtime(get_template_directory().'/style.css'),'all');
    wp_register_script('main-js',get_template_directory(  ).'/assets/main.js',[],filemtime(get_template_directory(  ).'/assets/main.js'),true);

    wp_enqueue_style('stylesheet');
    wp_enqueue_script('main-js');
}

add_action('wp_enqueue_scripts', 'ritestay_enqueue_scripts')
?>