<?php

/**
 * Images formats
 *
 * @warning : utiliser regenerate_thumbnail à chaque modification
 */
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'full', 1920, 1080, true );
	add_image_size( 'large-square', 800, 800, true );
	add_image_size( 'square', 400, 400, true );
	add_image_size( 'medium-square', 400, 400, true );
	add_image_size( 'small-square', 200, 200, true );
}


/**
 *  Modify the path to the icons directory
 */
add_filter( 'acf_icon_path_suffix', 'acf_icon_path_suffix' );

/**
 *  Modify the path to the icons directory
 */
function acf_icon_path_suffix( $path_suffix ) {
	return 'src/icons/';
}
