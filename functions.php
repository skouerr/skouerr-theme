<?php

/**
 * skouerr_dev_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package skouerr_dev_theme
 */


require __DIR__ . '/vendor/autoload.php';

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}


require_once get_template_directory() . '/inc/utils.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function theme_utils_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on skouerr_dev_theme, use a find and replace
		* to change 'skouerr_dev_theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('theme_utils', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'theme_utils_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function theme_utils_content_width()
{
	$GLOBALS['content_width'] = apply_filters('theme_utils_content_width', 640);
}
add_action('after_setup_theme', 'theme_utils_content_width', 0);

/**
 * Add loader for Skouerr blocks, templates or patterns.
 */

require_once get_template_directory() . '/inc/core/loader.php';
require_once get_template_directory() . '/inc/core/block.php';
require_once get_template_directory() . '/inc/core/dev.php';
require_once get_template_directory() . '/inc/core/palette.php';
require_once get_template_directory() . '/inc/core/setup.php';


/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/native/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/native/template-functions.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/native/customizer.php';


/**
 * Custom incs
 */

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/hook.php';
require get_template_directory() . '/inc/html.php';
require get_template_directory() . '/inc/media.php';
require get_template_directory() . '/inc/nav.php';
require get_template_directory() . '/inc/widget.php';
require get_template_directory() . '/inc/ajax.php';

/**
 * Load ACF specific files
 */

require get_template_directory() . '/inc/acf/acf-fields.php';
require get_template_directory() . '/inc/acf/acf-blocks.php';

/**
 * Disable inline styles
 */

add_action('init', function () {
	add_filter('styles_inline_size_limit', '__return_zero');
});
