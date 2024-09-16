<?php

/**
 * Enqueue scripts and styles.
 */
function theme_utils_scripts()
{
    // Youhou, no jQuery!
    wp_deregister_script('jquery');

    wp_enqueue_style('theme_utils-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_utils_scripts');





/***********************************************
 * CUSTOM
 **********************************************/

/**
 * Scripts
 */
add_action('wp_enqueue_scripts', function () {
    // Gobal style in main css
    wp_enqueue_style('theme', get_template_directory_uri() . '/dist/main.css');
    wp_enqueue_style('style-default', get_template_directory_uri() . '/style.css');

    // Global js

    wp_enqueue_script('main', get_template_directory_uri() . '/dist/main.js', false, true);

    wp_enqueue_script('wp');
    wp_enqueue_script('wp-blocks');
    wp_enqueue_script('wp-element');
    wp_enqueue_script('wp-editor');
});

add_action('admin_enqueue_scripts', function () {
    // Global style in admin CSS
    wp_enqueue_script('wp');
    wp_enqueue_script('wp-blocks');
    wp_enqueue_script('wp-element');
    wp_enqueue_script('wp-editor');

    wp_enqueue_style('theme-admin', get_template_directory_uri() . '/dist/main.css');
});



function theme_utils_admin_scripts($suffix)
{
    wp_enqueue_style('style-default', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('admin-css', get_template_directory_uri() . '/dist/css/admin.css');
    wp_enqueue_script('admin-js', get_template_directory_uri() . '/dist/js/admin.js', array('wp-block-editor', 'wp-blocks', 'wp-polyfill'), false, true);
}
add_action('admin_enqueue_scripts', 'theme_utils_admin_scripts');

function theme_utils_header()
{
?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="theme-color" content="#ffffff">
<?php
}
add_action('wp_head', 'theme_utils_header');

function wp_login_style()
{ ?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            width: 300px;
            background-size: contain;
            background-image: url(<?php echo get_site_logo_url(); ?>);
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'wp_login_style');
