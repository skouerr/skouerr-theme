<?php

/**
 * Load blocks, patterns and components
 */

$loader = new Skouerr_Loader();
$loader->wp_init();

class Skouerr_Loader
{
    public function __construct() {}

    public function wp_init()
    {
        // Load blocks
        add_action('init', array($this, 'load_blocks'));
        add_filter('allowed_block_types_all', array($this, 'set_allowed_blocks'), 100, 2);

        // Pattern
        add_action('init', array($this, 'load_patterns'));

        // Post types
        $this->load_post_types();

        // Variations
        add_action('enqueue_block_editor_assets', array($this, 'load_variations'));

        // Bindings
        add_action('init', array($this, 'load_bindings'));
    }


    /**
     * Get all blocks with defined in folder blocks
     */
    public function get_blocks()
    {
        $blocks = glob(get_template_directory() . '/blocks/**/*.block.json');
        return $blocks;
    }

    /**
     * Get all blocks names
     */

    public function get_blocks_names(): array
    {
        $blocks = $this->get_blocks();
        $blocks_names = array();
        foreach ($blocks as $block) {
            $block_json = file_get_contents($block);
            $blocks_names[] = json_decode($block_json)->name;
        }
        return $blocks_names;
    }

    /**
     * Set allowed blocks
     */

    public function set_allowed_blocks($allowed_blocks, $post)
    {
        $blocks = $this->get_blocks_names();
        $allowed_blocks = array_merge($allowed_blocks, $blocks);
        return $allowed_blocks;
    }

    /**
     * Load blocks
     */

    public function load_blocks()
    {
        $blocks = $this->get_blocks();
        foreach ($blocks as $block) {;
            register_block_type(
                $block
            );
        }
    }


    // Patterns
    public function get_patterns()
    {
        $patterns = glob(get_template_directory() . '/patterns/*.php');
        return $patterns;
    }

    public function load_patterns()
    {
        $patterns = $this->get_patterns();
        foreach ($patterns as $pattern) {
            $this->load_pattern($pattern);
        }
    }

    public function load_pattern($pattern)
    {
        $data = $this->get_pattern($pattern);
        $status = register_block_pattern($data['slug'], array(
            'title' => __($data['title'], 'skouerr'),
            'content' => $data['content'],
        ));
    }

    public function get_pattern($pattern)
    {
        $data = get_file_data($pattern, array('title' => 'Title', 'slug' => 'Slug'));
        ob_start();
        require $pattern;
        $data['content'] = ob_get_clean();
        return $data;
    }

    // Post types

    public function get_post_types()
    {
        $post_types = glob(get_template_directory() . '/post-types/*/*.functions.php');
        return $post_types;
    }

    public function load_post_types()
    {
        $post_types = $this->get_post_types();
        foreach ($post_types as $post_type) {
            require_once $post_type;
        }
    }

    // Get JS variations

    public function get_variations()
    {
        $variations = glob(get_template_directory() . '/js/admin/variations/*.js');
        return $variations;
    }

    // Load JS Variations

    public function load_variations()
    {
        $variations = $this->get_variations();
        foreach ($variations as $file) {
            $file_name = basename($file, '.js') . '_variations';
            wp_enqueue_script($file_name, get_template_directory_uri() . '/js/admin/variations/' . basename($file), array('wp-blocks'));
        }
    }

    // Get block bindings files

    public function get_bindings()
    {
        $bindings = glob(get_template_directory() . '/bindings/**/*.php');
        $bindings = array_map(function ($binding) {
            $data = get_file_data($binding, array('name' => 'Name', 'slug' => 'Slug'));
            $data['file'] = $binding;
            return $data;
        }, $bindings);
        return $bindings;
    }

    public function load_bindings()
    {
        $bindings = $this->get_bindings();
        foreach ($bindings as $binding) {
            register_block_bindings_source('skouerr/' . $binding['slug'], array(
                'label' => $binding['name'],
                'get_value_callback' => function ($source_args, $block_instance, $attribute_name) use ($binding) {
                    return require $binding['file'];
                },
            ));
        }

        //var_dump($bindings);
    }

}
