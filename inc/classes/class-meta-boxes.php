<?php

namespace RITESTAY\Inc;

use RITESTAY\Inc\Traits\Singleton;

/***
 * @package Ritestay
 * Registering custom meta boxes
 */

class Meta_Boxes
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
        add_action('add_meta_boxes', [$this, 'custom_meta_boxes']);
    }
    public function custom_meta_boxes()
    {
        add_meta_box(
            'custom-meta-box',           // Unique ID
            'Custom Meta Box', // Box title
            [$this, 'custom_meta_box_html'],  // Content callback, must be of type callable
            'post',
            'side'                       // Post type
        );
    }
    public function custom_meta_box_html($post)
    {
        $value = get_post_meta($post->ID, '_hide_meta_title', true);
?>
        <label for="ritestay-field"><?php esc_html_e('Hide post title', 'Ritestay')?></label>
        <select name="ritestay_field" id="ritestay-field" class="postbox">
            <option value=""><?php esc_html_e('Select', 'Ritestay')?></option>
            <option value="yes" <?php selected($value, 'yes'); ?>><?php esc_html_e('Yes', 'Ritestay')?></option>
            <option value="no" <?php selected($value, 'no'); ?>><?php esc_html_e('Yes', 'Ritestay')?></option>
        </select>
<?php
    }
}
