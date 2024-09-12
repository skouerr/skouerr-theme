<?php


class Skouerr_Block {

	public $dir;
	public $name;
	public array $data;

	public function __construct( $dir ) {
		$this->dir = $dir;
		$this->name = basename( $dir );
		$this->data = array();
	}

	public function render( string $type, array $data = array() ) {
		$this->load_main_script();

		if ( $type === 'php' ) {
			$this->render_php();
		}

		if ( $type === 'twig' ) {
			$this->render_twig();
		}

		if ( $type === 'react' ) {
			$this->render_react();
		}

		// var_dump($type, $data);
		// var_dump($block_content, $block);
	}

	public function set_data( string $key, $value ) {
		$this->data[ $key ] = $value;
	}

	public function get_data( string $key ) {
		return $this->data[ $key ];
	}

	public function the_data( string $key ) {
		echo $this->data[ $key ];
	}

	public function dump_data() {
		var_dump( $this->data );
	}

	private function render_php() {
		$skouerr_block = $this;
		require $this->dir . '/' . $this->name . '.template.php';
	}

	private function render_twig() {
		$loader = new \Twig\Loader\FilesystemLoader( $this->dir );
		$twig = new \Twig\Environment( $loader );

		echo $twig->render( $this->name . '.template.twig', $this->data );
	}

	private function render_react() {
		echo '<script>var skouerr_block_' . $this->name . '_data = ' . json_encode( $this->data ) . '</script>';
		echo '<div id="skouerr-block-' . $this->name . '"></div>';
	}

	public function load_main_script( $script = 'dist/script.js' ) {
		wp_enqueue_script( 'skouerr-block-' . $this->name, get_template_directory_uri() . '/blocks/' . $this->name . '/' . $script, array(), '1.0', true );
	}

	public function unload_main_script() {
		wp_dequeue_script( 'skouerr-block-' . $this->name );
	}
}
