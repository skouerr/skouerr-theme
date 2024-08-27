<?php

/**
 * Add new menus
 */
add_action('init', function () {
    if (function_exists('register_nav_menus')) {
        register_nav_menus(array(
            'primary_menu' => esc_html__('Header', 'theme_utils'),
            'footer_menu' => esc_html__('Footer', 'theme_utils'),
        ));
    }
    if (function_exists('wp_create_nav_menu')) {
        wp_create_nav_menu('Header', array('slug' => 'header', 'theme_location' => 'primary_menu'));
        wp_create_nav_menu('Footer', array('slug' => 'footer', 'theme_location' => 'footer_menu'));
    }
});
