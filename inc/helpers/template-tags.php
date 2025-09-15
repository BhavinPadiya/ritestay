<?php

/*******************************************
 * Template for custom functions
 * 
 * @package RiteStay
 *******************************************/



function get_post_custom_thumbnail($post_id, $size = 'featured-image', $attr = '')
{
    $custom_thumbnail = '';

    if (null === $post_id) {
        $post_id = get_the_ID();
    }

    if (has_post_thumbnail($post_id)) {
        $default_attr = [
            
        ];
        if (is_array($attr)) {
            $attr = array_merge($default_attr, $attr);
        } else {
            $attr = $default_attr;
        }
        $custom_thumbnail = wp_get_attachment_image(get_post_thumbnail_id($post_id), $size, false, $attr);
    }
    return $custom_thumbnail;
}


function the_post_custom_thumbnail($post_id, $size = 'featured-image', $attr = '')
{
    echo get_post_custom_thumbnail($post_id, $size, $attr);
}