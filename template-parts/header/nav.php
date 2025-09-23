<?php
// @package Ritestay

// Header Navigation template

use RITESTAY\Inc\Menus;

$menu_class =  Menus::get_instance();
$header_menu_id = $menu_class->get_menu_id('ritestay-header-menu');
$header_menus = wp_get_nav_menu_items($header_menu_id);
$grandchildren = $menu_class->get_grandchild_menu_items($header_menus);

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <?php
    if (function_exists('the_custom_logo')) {
      the_custom_logo();
    }
    ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php
      if (!empty($header_menus) && is_array($header_menus)) {

      ?>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php
          foreach ($header_menus as $menu_item) {
            if (!$menu_item->menu_item_parent) {
              $child_menus = $menu_class->get_child_menu_items($header_menus, $menu_item->ID);
              $has_children = !empty($child_menus) && is_array($child_menus);

              if (!$has_children) {
          ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo esc_url($menu_item->url) ?>"><?php echo esc_html($menu_item->title) ?></a>
                </li>
              <?php
              } else {
              ?>
                <li class="nav-item dropdown d-flex align-items-center">
                    <a class="nav-link" href="<?php echo esc_url($menu_item->url) ?>">
                      <?php echo esc_html($menu_item->title) ?>
                    </a>
                    <a class="nav-link dropdown-toggle" href="<?php echo esc_url($menu_item->url) ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding-left: 0;">
                      <span class="d-none d-lg-inline-block"></span>
                    </a>

                  <ul class="dropdown-menu">
                    <?php
                    foreach ($child_menus as $child_menu) {
                      $grandchildren = $menu_class->get_child_menu_items($header_menus, $child_menu->ID);
                      $has_grandchildren = !empty($grandchildren) && is_array($grandchildren);
                    ?>
                      <li class="<?php echo $has_grandchildren ? 'dropdown-submenu' : ''; ?>">
                        <a class="dropdown-item <?php echo $has_grandchildren ? 'dropdown-toggle' : ''; ?>" href="<?php echo esc_url($child_menu->url) ?>"
                          <?php if ($has_grandchildren): ?> data-bs-toggle="dropdown" <?php endif; ?>>
                          <?php echo esc_html($child_menu->title) ?>
                        </a>
                        <?php if ($has_grandchildren): ?>
                          <ul class="dropdown-menu">
                            <?php foreach ($grandchildren as $grandchild) : ?>
                              <li>
                                <a class="dropdown-item" href="<?php echo esc_url($grandchild->url); ?>">
                                  <?php echo esc_html($grandchild->title); ?>
                                </a>
                              </li>
                            <?php endforeach; ?>
                          </ul>
                          <!-- This nested <ul> is where the grandchildren live -->
                        <?php endif; ?>
                      </li>
                    <?php
                    }
                    ?>
                  </ul>

                </li>
            <?php

              }
            }
            ?>
        <?php
          }
          echo "</ul>";
        }
        ?>
        <!-- <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
    </div>
  </div>
</nav>