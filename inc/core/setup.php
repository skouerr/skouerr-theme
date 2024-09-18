<?php

if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::add_command('skouerr-theme setup', 'skouerr_setup');
}


function skouerr_setup($args, $assoc_args)
{
    do_action('skouerr_theme_setup_before');

    WP_CLI::line('Setting up Skouerr theme...');
    // Create Doc Page
    $doc_page = get_post_by_post_name('documentation', 'page');
    if (!$doc_page) {
        $doc_page = array(
            'post_title' => 'Documentation',
            'post_name' => 'documentation',
            'post_type' => 'page',
            'post_author' => 1,
            'post_status' => 'publish',
            'post_content' => '<!-- wp:skouerr/documentation {"name":"skouerr/documentation","data":{"source":"theme","_source":"field_66d6d19589b24","url":"doc.MD","_url":"field_66d6d1e78f670"},"mode":"edit"} /-->',
        );
        $doc_page_id = wp_insert_post($doc_page);
        WP_CLI::line('Documentation page created');
    } else {
        WP_CLI::line('Documentation page already exists');
    }

    $design_system_page = get_post_by_post_name('design-system', 'page');
    if (!$design_system_page) {
        $design_system_page = array(
            'post_title' => 'Design System',
            'post_name' => 'design-system',
            'post_type' => 'page',
            'post_author' => 1,
            'post_status' => 'publish',
            'post_content' => '<!-- wp:skouerr/design-system /-->',
        );
        $design_system_page_id = wp_insert_post($design_system_page);
        WP_CLI::line('Design System page created');
    } else {
        WP_CLI::line('Design System page already exists');
    }

    $home = get_post_by_post_name('home', 'page');
    if (!$home) {

        $loader = new Skouerr_Loader();
        $pattern = $loader->get_pattern(get_template_directory() . '/patterns/home-default.php');

        $home = array(
            'post_title' => 'Home',
            'post_name' => 'home',
            'post_type' => 'page',
            'post_author' => 1,
            'post_status' => 'publish',
            'post_content' => $pattern['content'],
        );

        $home_id = wp_insert_post($home);
        WP_CLI::line('Home page created');

        // Set Home page as front page
        update_option('page_on_front', $home_id);
        update_option('show_on_front', 'page');

        WP_CLI::line('Home page set as front page');
    } else {
        WP_CLI::line('Home page already exists');
    }



    // Create Header Menu
    $menu = wp_get_nav_menu_object('Header');
    if (!$menu) {
        $menu_id = wp_create_nav_menu('Header');
        $menu = wp_get_nav_menu_object('Header');
        WP_CLI::line('Header menu created');
    } else {
        WP_CLI::line('Header menu already exists');
    }

    // Create Footer Menu
    $menu = wp_get_nav_menu_object('Footer');
    if (!$menu) {
        $menu_id = wp_create_nav_menu('Footer');
        $menu = wp_get_nav_menu_object('Footer');
        WP_CLI::line('Footer menu created');
    } else {
        WP_CLI::line('Footer menu already exists');
    }

    flush_rewrite_rules();

    do_action('skouerr_theme_setup_after');
}
