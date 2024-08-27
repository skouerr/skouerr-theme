<?php

/**
 * Delete Wordpress version (sécurity hack)
 */
remove_action('wp_head', 'wp_generator');

/**
 * Hide connexion errors
 */
add_filter('login_errors', function () {
    return '';
});

/**
 * Retire les messages d'erreurs de configuration contact form 7 - permet de virer le message "Sender email address does not belong to the site domain."
 */
add_filter('wpcf7_validate_configuration', '__return_false');

/**
 * Add wpautop only for classic editor blocks
 */
add_filter('the_content', function ($content) {
    if (has_blocks()) {
        return $content;
    }

    return wpautop($content);
});

/**
 * Remove Categories and Tags
 */
add_action('init', 'myprefix_remove_tax');
function myprefix_remove_tax()
{
    register_taxonomy('category', array());
    register_taxonomy('post_tag', array());
}

/**
 * ACF WYSIWYG BASIC
 */
function my_toolbars($toolbars)
{
    $toolbars['Basic'] = array();
    $toolbars['Basic'][1] = array('bold', 'italic', 'underline', 'bullist', 'link');
    $toolbars['OnlyBold'] = array();
    $toolbars['OnlyBold'][1] = array('bold');

    // return $toolbars - IMPORTANT!
    return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars', 'my_toolbars');

/**
 * Disable comments
 */
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
    remove_menu_page('options-discussion.php');
});
// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

/**
 * Disable Gutenberg options
 */
/*
add_theme_support('editor-color-palette', array());
add_theme_support('disable-custom-colors');
add_theme_support('disable-custom-font-sizes');
add_theme_support('disable-custom-gradients');
add_theme_support('editor-font-sizes', []);
*/


/**
 * Limitation de la profondeur du menu dans le BO
 * 
 * @since 1.0.0
 */
function _bacore_limit_nav_menu_depth($hook)
{
    if ($hook != 'nav-menus.php') {
        return;
    }
    wp_add_inline_script('nav-menu', 'wpNavMenu.options.globalMaxDepth = 1;', 'after');
}
add_action('admin_enqueue_scripts', '_bacore_limit_nav_menu_depth');

/**
 * Suppression du message de mise à jour de WordPress
 * (Ils seront affichés uniquement pour les administrateurs)
 *
 * @since 1.0
 */
function theme_utils_hide_updates_notice()
{
    if (!current_user_can('administrator')) {
        remove_action('admin_notices', 'update_nag', 3);
    }
}
add_action('admin_head', 'theme_utils_hide_updates_notice', 1);


/**
 * Suppression de certains éléments de la barre d'outil de WordPress
 *
 * Valeurs possibles :
 *  - wp-logo        : Logo WordPress
 *  - about          : Lien "À propos de WordPress"
 *  - wporg          : Url vers le site WordPress
 *  - documentation  : Url vers la documentation
 *  - support-forums : Url vers le forum d'entraide
 *  - feedback       : Url vers la page de remarque
 *  - customize      : Lien vers le customizer
 *  - site-name      : Nom du site et menu situé en dessous
 *  - view-site      : Lien "Aller sur le site"
 *  - view           : Lien pour voir le contenu du post courant
 *  - comments       : Compteur et lien vers les commentaires
 *  - new-content    : "Créer" un nouveau contenu
 *  - w3tc           : Suppression du lien de performance dans le cas où le plugin W3 Total Cache est utilisé
 *  - my-account     : Utilisateur courant et son sous-menu
 *  - updates        : Notification de mise à jour
 *  - search         : Moteur de recherche (côté FO)
 *
 * @since 1.0
 */
function theme_utils_remove_admin_bar_links()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('customize');
    $wp_admin_bar->remove_menu('view-site');
    //$wp_admin_bar->remove_menu( 'view' );
    $wp_admin_bar->remove_menu('new-content');
    if (!current_user_can('administrator')) {
        $wp_admin_bar->remove_menu('updates');
    }
    if (!is_admin()) {
        $wp_admin_bar->remove_menu('wp-logo');
        $wp_admin_bar->remove_menu('search');
    }
}
add_action('wp_before_admin_bar_render', 'theme_utils_remove_admin_bar_links');

/**
 * Suppression du "Salutations, ..." dans la barre d'outil de WordPress
 *
 * @link http://www.wpbeginner.com/wp-tutorials/how-to-change-the-howdy-text-in-wordpress-3-3-admin-bar/
 * @since 1.0
 */
function theme_utils_remove_howdy($wp_admin_bar)
{
    $user_id = get_current_user_id();
    $current_user = wp_get_current_user();
    $profile_url = get_edit_profile_url($user_id);

    if (0 != $user_id) {
        $avatar = get_avatar($user_id, 28);
        $class = empty($avatar) ? '' : 'with-avatar';

        $wp_admin_bar->add_menu(array(
            'id' => 'my-account',
            'parent' => 'top-secondary',
            'title' => $current_user->display_name . $avatar,
            'href' => $profile_url,
            'meta' => array(
                'class' => $class,
            ),
        ));
    }
}
add_filter('admin_bar_menu', 'theme_utils_remove_howdy', 11);

/**
 * Masquage du logo WordPress sur la page de login
 *
 * @since 1.0
 */

/*
function theme_utils_hide_login_logo() {
    echo '<style tyle="text/css">#login h1 { display: none; }</style>';
}
add_action( 'login_head', 'theme_utils_hide_login_logo' );
*/

/**
 * Nettoyage des noms de fichiers à l'upload
 *
 * @since 1.0
 */
function theme_utils_sanitize_filename($filename)
{
    // Suppression des accents
    $filename = remove_accents($filename);
    // Remplacement de tous les accents par des tirets
    $filename = str_replace(' ', '-', $filename);
    // Suppression des caractères spéciaux
    $filename = preg_replace('/[^A-Za-z0-9\-\_\.]/', '', $filename);
    // Remplacement des tirets multiples par un seul
    $filename = preg_replace('/-+/', '-', $filename);
    // En minuscule
    $filename = strtolower($filename);

    /**
     * Possibilité de modifier le nom de fichier après nettoyage
     *
     * @since 1.0
     */
    return apply_filters('sc/after_sanitize_file_name', $filename);
}
add_filter('sanitize_file_name', 'theme_utils_sanitize_filename');


/**
 * Suppression du numéro de version de WordPress dans le footer
 *
 * @since 1.0
 */
function theme_utils_version_footer_admin()
{
    remove_filter('update_footer', 'core_update_footer');
}
add_filter('admin_menu', 'theme_utils_version_footer_admin');


/**
 * Suppression des crédits de WordPress dans le footer
 *
 * @since 1.0
 */
add_filter('admin_footer_text', '__return_empty_string');


/**
 * Suppresion des widgets inutiles du dashboard
 * (utiliser 'dashboard-network' en second paramètre pour supprimer des widgets d'un WordPress MU)
 * @
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 * @link https://codex.wordpress.org/Function_Reference/remove_meta_box
 * @since 1.0
 */
function theme_utils_remove_dashboard_widgets()
{
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');  // Recent Comments
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');   // Incoming Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');          // Plugins
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');        // Brouillon rapide (Quick Press)
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');      // Recent Drafts
    remove_meta_box('dashboard_primary', 'dashboard', 'side');            // Évènements et nouveautés WordPress (WordPress blog)
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');          // Other WordPress News
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');         // Activity
    if (!current_user_can('administrator')) {
        remove_meta_box('dashboard_site_health', 'dashboard', 'normal');        // Santé du site
    }
}
add_action('admin_init', 'theme_utils_remove_dashboard_widgets');


/**
 * Nettoyage de wp_head()
 *
 * Suppression des tags <link> non nécessaire
 * Suppression du CSS et JS du support de WP emoji
 * Suppression du CSS et JS utilisé par le widget des récents commentaires
 * Suppression du CSS et JS utilisé par les posts avec une galerie
 * Suppression des self-closing tags et changement des guillemets simples en doubles dans la fonction rel_canonical()
 *
 * @since 1.0.0
 */
function theme_utils_head_cleanup()
{
    // Original : http://wpengineer.com/1438/wordpress-header/
    remove_action('wp_head', 'feed_links_extra', 3);
    // add_action( 'wp_head', 'ob_start', 1, 0 );
    // add_action( 'wp_head', function() {
    //     $pattern = '/.*' . preg_quote(esc_url(get_feed_link('comments_' . get_default_feed())), '/') . '.*[\r\n]+/';
    //     echo preg_replace($pattern, '', ob_get_clean());
    // }, 3, 0 );

    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('use_default_gallery_style', '__return_false');
    add_filter('emoji_svg_url', '__return_false');
    add_filter('show_recent_comments_widget_style', '__return_false');
}
add_action('init', 'theme_utils_head_cleanup');


/**
 * Suppression du numéro de version dans l'url des fichiers de styles et de scripts
 *
 * @since 1.0
 */
function theme_utils_remove_version_css_js($src)
{
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
        $src = add_query_arg(array(
            'v' => date('ynjG')
        ), $src);
    }
    return $src;
}
add_filter('script_loader_src', 'theme_utils_remove_version_css_js', 15, 1);
add_filter('style_loader_src', 'theme_utils_remove_version_css_js', 15, 1);


/**
 * Suppression du numéro de version de WordPress dans le flux RSS
 *
 * @since 1.0
 */
add_filter('the_generator', '__return_false');

/**
 * Nettoyage du rendu des tags <link> des feuilles de styles
 *
 * @since 1.0
 */
function theme_utils_clean_style_tag($html, $handle, $href, $media)
{
    if (empty($href)) {
        return $html;
    }
    //Affiche uniquement les médias si cela est significatif
    $media = ($media !== '' && $media !== 'all') ? ' media="' . $media . '"' : '';
    return '<link rel="stylesheet" href="' . $href . '"' . $media . '>' . "\n";
}
add_filter('style_loader_tag', 'theme_utils_clean_style_tag', 10, 4);

/**
 * Suppression des fermetures automatiques de tags non nécessaire
 *
 * @since 1.0
 */
function theme_utils_remove_self_closing_tags($input)
{
    return str_replace(' />', '>', $input);
}
add_filter('get_avatar', 'theme_utils_remove_self_closing_tags'); // <img />
add_filter('comment_id_fields', 'theme_utils_remove_self_closing_tags'); // <input />
add_filter('post_thumbnail_html', 'theme_utils_remove_self_closing_tags'); // <img />

/**
 * Add wrapper to iframe (pour tarteaucitron)
 */
function wporg_block_wrapper($block_content, $block)
{
    if ($block['blockName'] === 'core/html') {
        $content = '<div class="tac_iframe" data-content="' . htmlspecialchars($block_content) . '"';
        if (str_contains($block_content, 'height="')) {
            preg_match('/(?<=height=")(.*?)(?=")/', $block_content, $height);
            $content .= 'height="' . $height[0] . '"';
        }
        $content .= '>';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    }
    return $block_content;
}
add_filter('render_block', 'wporg_block_wrapper', 10, 2);

/**
 * Remove Gutenberg Block Library CSS from loading on the frontend
 */
function wp_remove_wp_block_library_css()
{
    //wp_dequeue_style('wp-block-library');
    //wp_dequeue_style('wp-block-library-theme');
    //wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
    // wp_dequeue_style('global-styles');
    //wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'wp_remove_wp_block_library_css', 100);

add_action('wp_footer', function () {
    wp_dequeue_style('core-block-supports');
});

/** 
 * Remove WP default styles in theme.json
 */

add_filter('wp_theme_json_data_default', function ($data) {
    return $data;
});
