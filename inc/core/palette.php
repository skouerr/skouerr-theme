<?php

use Mexitek\PHPColors\Color;

class Skouerr_Palette {

	public array $palette;
	public object $theme_json;

	public function __construct( $theme_json_data_theme ) {
		$this->load_skouerr_palette( $theme_json_data_theme );
	}

	public function get_colors() {
		return $this->palette;
	}

	public function get_theme_json() {
		return $this->theme_json;
	}

	public function load_skouerr_palette( $theme_json ) {
		$data = $theme_json->get_data();

		$colors = $data['settings']['color']['palette']['theme'];
		$this->palette = $colors;

		$this->add_color_system();

		$data['settings']['color']['palette']['theme'] = $this->palette;
		$theme_json->update_with( $data );
		$this->theme_json = $theme_json;
		return $theme_json;
	}

	public function add_color_system() {
		foreach ( $this->palette as $key => $color ) {
			$this->palette = array_merge( $this->palette, $this->make_color_shades( $color ) );
		}
	}

	public function make_color_shades( $color_object ) {
		$shades = array();
		$color = new Color( $color_object['color'] );
		$shades[12] = '#' . $color->darken( 20 );
		$shades[11] = '#' . $color->darken( 10 );
		$shades[10] = $color_object['color'];
		for ( $i = 1; $i < 10; $i += 1 ) {
			$step = 100 - ( $i * 20 );
			$shades[ 10 - $i ] = '#' . $color->mix( '#ffffff', $step );
		}

		$colors_shades = array();
		foreach ( $shades as $key => $shade ) {

			$is_exist = array_search( $color_object['slug'] . '-' . $key, array_column( $this->palette, 'slug' ) );

			if ( $is_exist === false ) {
				$colors_shades[] = array(
					'name' => $color_object['name'] . ' ' . $key . '0%',
					'slug' => $color_object['slug'] . '-' . $key,
					'parent' => $color_object['slug'],
					'color' => $shade,
				);
			}
		}
		return $colors_shades ?? array();
	}
}

add_filter(
	'wp_theme_json_data_theme',
	function ( $theme_json ) {
		$palette = new Skouerr_Palette( $theme_json );
		return $palette->get_theme_json();
	},
	10
);

add_filter(
	'wp_theme_json_data_theme',
	function ( $theme_json ) {
		$GLOBALS['theme_json_data_theme'] = $theme_json;
		return $theme_json;
	},
	11
);
