<?php

/**
 * Load blocks, patterns and components
 */

$loader = new Skouerr_Loader();
$loader->wp_init();

class Skouerr_Loader {

	public function __construct() {}

	public function wp_init() {
		// Load blocks
		add_action( 'init', array( $this, 'load_blocks' ) );
		add_filter( 'allowed_block_types_all', array( $this, 'set_allowed_blocks' ), 100, 2 );

		// Pattern
		add_action( 'init', array( $this, 'load_patterns' ) );

		// Post types
		$this->load_post_types();
	}


	/**
	 * Get all blocks with defined in folder blocks
	 */
	public function get_blocks() {
		$blocks = glob( get_template_directory() . '/blocks/**/*.block.json' );
		return $blocks;
	}

	/**
	 * Get all blocks names
	 */
	public function get_blocks_names(): array {
		$blocks = $this->get_blocks();
		$blocks_names = array();
		foreach ( $blocks as $block ) {
			$block_json = file_get_contents( $block );
			$blocks_names[] = json_decode( $block_json )->name;
		}
		return $blocks_names;
	}

	/**
	 * Set allowed blocks
	 */
	public function set_allowed_blocks( $allowed_blocks, $post ) {
		$blocks = $this->get_blocks_names();
		$allowed_blocks = array_merge( $allowed_blocks, $blocks );
		return $allowed_blocks;
	}

	/**
	 * Load blocks
	 */
	public function load_blocks() {
		$blocks = $this->get_blocks();
		foreach ( $blocks as $block ) {
			;
			register_block_type(
				$block
			);
		}
	}


	// Patterns
	public function get_patterns() {
		$patterns = glob( get_template_directory() . '/patterns/*.php' );
		return $patterns;
	}

	public function load_patterns() {
		$patterns = $this->get_patterns();
		foreach ( $patterns as $pattern ) {
			$this->load_pattern( $pattern );
		}
	}

	public function load_pattern( $pattern ) {
		$data = $this->get_pattern( $pattern );
		$status = register_block_pattern(
			$data['slug'],
			array(
				'title' => __( $data['title'], 'skouerr' ),
				'content' => $data['content'],
			)
		);
	}

	public function get_pattern( $pattern ) {
		$data = get_file_data(
			$pattern,
			array(
				'title' => 'Title',
				'slug' => 'Slug',
			)
		);
		ob_start();
		require $pattern;
		$data['content'] = ob_get_clean();
		return $data;
	}

	// Post typzes

	public function get_post_types() {
		$post_types = glob( get_template_directory() . '/post-types/*/*.functions.php' );
		return $post_types;
	}

	public function load_post_types() {
		$post_types = $this->get_post_types();
		foreach ( $post_types as $post_type ) {
			require_once $post_type;
		}
	}
}
