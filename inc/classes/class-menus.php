<?php

namespace RITESTAY\Inc;

use RITESTAY\Inc\Traits\Singleton;

/***
 * @package Ritestay
 * Registering menus
 */

class Menus
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
        add_action('init', [$this, 'register_menus']);
    }

    public function register_menus()
    {
        register_nav_menus(
            [
                'ritestay-header-menu' => esc_html__('Header Menu', 'ritestay'),
                'ritestay-footer-menu' => esc_html__('Footer Menu', 'ritestay'),
            ]
        );
    }

    public function get_menu_id($location)
    {
        $locations = get_nav_menu_locations();
        $menu_id =  $locations[$location];

        return ! empty($menu_id) ? $menu_id : '';
    }

    public function get_child_menu_items($menu_array, $parent_id)
    {
        $child_menu_items = [];
        if(!empty($menu_array)&&is_array($menu_array)){
            foreach ($menu_array as $menu) {
                if (intval($menu->menu_item_parent) === $parent_id) {
                    array_push($child_menu_items, $menu);
                }
            }
        }
        return $child_menu_items;
    }
}
