<?php
/**
 * Plugin Name: Austin Alpine Nav Helpers
 * Description: Adds the Service Areas link to the primary menu when it is missing.
 */

add_filter('wp_get_nav_menu_items', function ($items, $menu, $args) {
    if (empty($items) || empty($menu)) {
        return $items;
    }

    $menu_name = '';

    if (is_object($menu)) {
        $menu_name = isset($menu->name) ? $menu->name : '';
        if (!$menu_name && isset($menu->slug)) {
            $menu_name = $menu->slug;
        }
    } elseif (is_string($menu)) {
        $menu_name = $menu;
    }

    if (!in_array($menu_name, array('Primary Menu', 'primary-menu'), true)) {
        return $items;
    }

    foreach ($items as $item) {
        if (
            (!empty($item->url) && untrailingslashit($item->url) === untrailingslashit(home_url('/service-areas/')))
            || (!empty($item->title) && strtolower(trim(wp_strip_all_tags($item->title))) === 'service areas')
        ) {
            return $items;
        }
    }

    $new_item = (object) array(
        'ID' => 999999,
        'db_id' => 999999,
        'menu_item_parent' => 0,
        'object_id' => 0,
        'object' => 'custom',
        'type' => 'custom',
        'type_label' => 'Custom Link',
        'title' => 'Service Areas',
        'url' => home_url('/service-areas/'),
        'target' => '',
        'attr_title' => '',
        'description' => '',
        'classes' => array(),
        'xfn' => '',
        'status' => 'publish',
        'menu_order' => count($items) + 1,
    );

    $items[] = $new_item;

    return $items;
}, 10, 3);
