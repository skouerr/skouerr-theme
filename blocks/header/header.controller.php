<?php

// Functions file for this block

$menu_object = wp_get_nav_menu_object('Header');
$cta = null;
if ($menu_object) {
    $menu_header = 'term_' . $menu_object->term_id;
    $cta = get_field('cta', $menu_header);
}

// Register Scripts

wp_enqueue_style('components-header-style', get_template_directory_uri() . '/template-parts/components/header/dist/style.css');
wp_enqueue_script('components-header-script', get_template_directory_uri() . '/template-parts/components/header/dist/script.js', false, false, true);

include('header.template.php');
