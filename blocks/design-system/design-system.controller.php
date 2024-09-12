<?php
/*
* Block Name : design-system
*/

use Mexitek\PHPColors\Color;

/**
 * Loading Skouerr Block
 */


$skouerr_block = new Skouerr_Block( __DIR__ );

/**
 * Setters and Getters on Skouerr Block
 *
 * $skouerr_block->set_data('key', 'value');
 */

$atoms = array();

// H1
$atoms[] = array(
	'name' => 'Heading 1',
	'description' => 'Heading 1 is the most important heading',
	'render' => '<!-- wp:heading {level:1} --> <h1>' . wp_sk_lipsum( 4 ) . '</h1> <!-- /wp:heading -->',
);

// H2
$atoms[] = array(
	'name' => 'Heading 2',
	'description' => 'Heading 2 is the second most important heading',
	'render' => '<!-- wp:heading {level:2} --> <h2>' . wp_sk_lipsum( 4 ) . '</h2> <!-- /wp:heading -->',
);

// H3
$atoms[] = array(
	'name' => 'Heading 3',
	'description' => 'Heading 3 is the third most important heading',
	'render' => '<!-- wp:heading {level:3} --> <h3>' . wp_sk_lipsum( 4 ) . '</h3> <!-- /wp:heading -->',
);

// H4
$atoms[] = array(
	'name' => 'Heading 4',
	'description' => 'Heading 4 is the fourth most important heading',
	'render' => '<!-- wp:heading {level:4} --> <h4>' . wp_sk_lipsum( 4 ) . '</h4> <!-- /wp:heading -->',
);

// H5
$atoms[] = array(
	'name' => 'Heading 5',
	'description' => 'Heading 5 is the fifth most important heading',
	'render' => '<!-- wp:heading {level:5} --> <h5>' . wp_sk_lipsum( 4 ) . '</h5> <!-- /wp:heading -->',
);

// H6
$atoms[] = array(
	'name' => 'Heading 6',
	'description' => 'Heading 6 is the sixth most important heading',
	'render' => '<!-- wp:heading {level:6} --> <h6>' . wp_sk_lipsum( 4 ) . '</h6> <!-- /wp:heading -->',
);

// Paragraph
$atoms[] = array(
	'name' => 'Paragraph',
	'description' => 'Paragraph is a block of text',
	'render' => '<!-- wp:paragraph --> <p>' . wp_sk_lipsum( 100 ) . '</p> <!-- /wp:paragraph -->',
);

// Image
$atoms[] = array(
	'name' => 'Image',
	'description' => 'Image is a block of image',
	'render' => '<!-- wp:image --> <figure class="wp-block-image"><img src="https://picsum.photos/200/300" alt="Image" /></figure> <!-- /wp:image -->',
);

// List
$atoms[] = array(
	'name' => 'List',
	'description' => 'List is a block of list',
	'render' => '<!-- wp:list --> <ul><li>' . wp_sk_lipsum( 4 ) . '</li><li>' . wp_sk_lipsum( 4 ) . '</li><li>' . wp_sk_lipsum( 4 ) . '</li></ul> <!-- /wp:list -->',
);

// Quote
$atoms[] = array(
	'name' => 'Quote',
	'description' => 'Quote is a block of quote',
	'render' => '<!-- wp:quote --> <blockquote class="wp-block-quote"><p>' . wp_sk_lipsum( 4 ) . '</p></blockquote> <!-- /wp:quote -->',
);

// Table

$atoms[] = array(
	'name' => 'Table',
	'description' => 'Table is a block of table',
	'render' => '<!-- wp:table --> <table class="wp-block-table"><tbody><tr><td>' . wp_sk_lipsum( 4 ) . '</td><td>' . wp_sk_lipsum( 4 ) . '</td></tr><tr><td>' . wp_sk_lipsum( 4 ) . '</td><td>' . wp_sk_lipsum( 4 ) . '</td></tr></tbody></table> <!-- /wp:table -->',
);

// Buttons
$atoms[] = array(
	'name' => 'Button',
	'description' => 'Button is a block of button',
	'render' => '<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">' . wp_sk_lipsum( 2 ) . '</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">' . wp_sk_lipsum( 2 ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->',
);




if ( isset( $GLOBALS['theme_json_data_theme'] ) ) {
	$colors = $GLOBALS['theme_json_data_theme']->get_data()['settings']['color']['palette']['theme'] ?? array();
} else {
	$colors = array();
}

$group = array();
foreach ( $colors as $key => $color ) {

	// var_dump($color);
	if ( isset( $color['parent'] ) ) {
		$group[ $color['parent'] ][] = $color;
	}
}

$skouerr_block->set_data( 'color_groups', $group );





$skouerr_block->set_data( 'colors', $colors );

/*
$color_primary = '#0FBCFF';
$colors_primary = array();
$color = new Color($color_primary);


$colors_primary[12] = '#' . $color->darken(20);
$colors_primary[11] = '#' . $color->darken(10);
$colors_primary[10] = $color_primary;
for ($i = 2; $i <= 10; $i += 1) {
	$step = 100 - ($i * 20);
	$colors_primary[10 - $i] = '#'  . $color->mix('#ffffff', $step);
}

var_dump($colors_primary);

*/

// $skouerr_block->set_data('colors_primary', $colors_primary);



/*
$color_80 = $color->lighten(20)->getHex();
$color_70 = $color->lighten(30)->getHex();
$color_60 = $color->lighten(40)->getHex();
$color_50 = $color->lighten(50)->getHex();
$color_40 = $color->lighten(60)->getHex();
$color_30 = $color->lighten(70)->getHex();
$color_20 = $color->lighten(80)->getHex();
$color_10 = $color->lighten(90)->getHex();
$color_0 = $color->lighten(100)->getHex();

var_dump($color_100, $color_90, $color_80, $color_70, $color_60, $color_50, $color_40, $color_30, $color_20, $color_10, $color_0);
*/





$skouerr_block->set_data( 'atoms', $atoms );


// Logos

$logos = array();
$logos[] = array(
	'name' => __( 'Default logo' ),
	'params' => '',
	'code' => 'the_site_logo()',
);

$logos[] = array(
	'name' => __( 'Monochrome light logo' ),
	'params' => 'light',
	'code' => "the_site_logo('light')",
);

$logos[] = array(
	'name' => __( 'Monochrome dark logo' ),
	'params' => 'dark',
	'code' => "the_site_logo('dark')",
);

$skouerr_block->set_data( 'logos', $logos );


/**
 * Render Skouerr Block
 */
$skouerr_block->render( 'php' );
