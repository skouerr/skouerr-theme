<?php

// Functions file for this block

$menu_object = wp_get_nav_menu_object('Header');
$cta = null;
if ($menu_object) {
    $menu_header = 'term_' . $menu_object->term_id;
    $cta = get_field('cta', $menu_header);
}

include('header.template.php');
