<?php
//  Theme Functions

//  @package Ritestay

function ritestay_enqueue_scripts(){
    wp_enqueue_style('Stylesheet',get_stylesheet_uri(),[], filemtime(get_template_directory().'/style.css'),'all');
}

add_action('wp_enqueue_scripts', 'ritestay_enqueue_scripts')
?>