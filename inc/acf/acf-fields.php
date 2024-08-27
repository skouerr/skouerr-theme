<?php

/**
 * ACF Options
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => __('General Settings'),
        'menu_title'    => __('General Settings'),
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}


/**
 * ACF JSON
 */

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path)
{
    $path =  get_stylesheet_directory() . '/inc/acf/json';
    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point($paths)
{
    $paths[] = get_stylesheet_directory() . '/inc/acf/json';
    return $paths;
}
