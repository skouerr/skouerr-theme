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

// Save ACF Json in inc/acf/json folder
add_filter('acf/settings/save_json', 'my_acf_json_save_point', 10);
function my_acf_json_save_point($path)
{
    $path =  get_stylesheet_directory() . '/inc/acf/json';
    return $path;
}

// Load ACF Json in block folder && global folder
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point($paths)
{
    $loader = new Skouerr_Loader();
    $blocks = $loader->get_blocks();

    foreach ($blocks as $block) {
        $dir = dirname($block);
        $acf_dir = $dir . '/acf-json';
        if (is_dir($acf_dir)) {
            $paths[] = $acf_dir;
        }
    }

    $paths[] = get_stylesheet_directory() . '/inc/acf/json';
    return $paths;
}

// Save ACF Json in block folder
function custom_acf_json_save_paths_block($paths, $post)
{
    $locations = $post['location'];
    $is_block = false;
    $block = '';
    $block_name = '';

    foreach ($locations as $location) {
        if ($location[0]['param'] === 'block' && $location[0]['operator'] === '==') {
            $is_block = true;
            $block = $location[0]['value'];
        }
    }

    if (isset($block)) {
        $blocks_names = explode('/', $block);
        $block_name = end($blocks_names);
    }

    if ($is_block && !empty($block_name)) {
        $path = get_stylesheet_directory() . '/blocks/' . $block_name . '/acf-json';
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        $paths = array($path);
    }

    return $paths;
}
add_filter('acf/json/save_paths', 'custom_acf_json_save_paths_block', 10, 2);



function custom_acf_json_filename($filename, $post, $load_path)
{
    $filename = str_replace(
        array(
            ' ',
            '_',
        ),
        array(
            '-',
            '-'
        ),
        $post['title']
    );

    $filename = strtolower($filename) . '.json';

    return $filename;
}
add_filter('acf/json/save_file_name', 'custom_acf_json_filename', 10, 3);
