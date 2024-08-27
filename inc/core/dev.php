<?php

add_action('wp_enqueue_scripts', 'wp_sk_scripts_widget');
function wp_sk_scripts_widget()
{

    $port = apply_filters('wp_sk_scripts_port', 4000);
    $reload_url = 'http://localhost:' . $port . '/script.js';
    $reload_url = apply_filters('wp_sk_scripts_reload_url', $reload_url);

    $widget_data = array();

    $settings = array();
    $settings['port'] = $port;
    $settings['reload_url'] = $reload_url;
    $settings['is_logged_in'] = is_user_logged_in();
    $settings['wp_env'] = wp_get_environment_type();
    $settings['display'] = apply_filters('wp_sk_scripts_widget_display', true);

    $widget_data['settings'] = apply_filters('wp_sk_scripts_widget_settings', $settings);

    $server_infos = array();
    $server_infos['php_version'] = phpversion();
    $server_infos['wp_version'] = get_bloginfo('version');
    $server_infos['wp_env'] = wp_get_environment_type();
    $server_infos['wp_debug'] = WP_DEBUG;
    $server_infos['wp_debug_log'] = WP_DEBUG_LOG;

    $widget_data['server_infos'] = apply_filters('wp_sk_scripts_widget_server_infos', $server_infos);

    $page_infos = array();
    $page_infos['page_id'] = get_the_ID();
    $page_infos['page_template'] = get_page_template_slug();
    $page_infos['page_title'] = get_the_title();
    $page_infos['page_type'] = get_post_type();
    $page_infos['page_url'] = get_permalink();
    $page_infos['page_template'] = get_page_template_slug();

    $widget_data['page_infos'] = apply_filters('wp_sk_scripts_widget_page_infos', $page_infos);

    $wp_sk_scripts_widget_active = wp_get_environment_type() === 'development';
    $wp_sk_scripts_widget_active = apply_filters('wp_sk_scripts_widget_active', $wp_sk_scripts_widget_active);

    if ($wp_sk_scripts_widget_active) {
        wp_enqueue_script('sk-scripts-widget', $reload_url, array(), false, array('in_footer' => false));
        // Add data to the script
        wp_localize_script('sk-scripts-widget', 'sk_scripts_widget', $widget_data);
    }
}


add_filter('wp_sk_scripts_port', function () {
    return 4002;
});
