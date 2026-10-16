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

        // Patterns: after WordPress registers the patterns/ files itself (init, 10).
        add_action('init', array($this, 'load_patterns'), 20);

        // Post types and taxonomies
        $this->load_post_types();
        $this->load_taxonomies();

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
        $blocks = glob(get_template_directory() . '/blocks/**/*.block.json') ?: array();
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
            $metadata = json_decode((string) file_get_contents($block), true);
            if (is_array($metadata) && !empty($metadata['name'])) {
                $blocks_names[] = $metadata['name'];
            }
        }
        return $blocks_names;
    }

    /**
     * Set allowed blocks
     */

    public function set_allowed_blocks($allowed_blocks, $post)
    {
        // true means every block is allowed: nothing to add (array_merge() would throw a TypeError).
        if (!is_array($allowed_blocks)) {
            return $allowed_blocks;
        }

        /**
         * Theme blocks added to the allowed blocks.
         *
         * @param string[]                $blocks Block names.
         * @param WP_Block_Editor_Context $post   Editor context.
         */
        $blocks = apply_filters('skouerr_allowed_blocks', $this->get_blocks_names(), $post);

        return array_values(array_unique(array_merge($allowed_blocks, (array) $blocks)));
    }

    /**
     * Load blocks
     */

    public function load_blocks()
    {
        $blocks = $this->get_blocks();
        foreach ($blocks as $block) {
            register_block_type(
                $block
            );
        }
    }


    // Patterns
    public function get_patterns()
    {
        $patterns = glob(get_template_directory() . '/patterns/*.php') ?: array();
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
        $headers = get_file_data($pattern, array('title' => 'Title', 'slug' => 'Slug'));
        if (empty($headers['slug'])) {
            return;
        }

        // WordPress already registers the patterns/ files of block themes with all their
        // headers (Inserter, Categories, Block Types…): registering them again would lose those.
        if (WP_Block_Patterns_Registry::get_instance()->is_registered($headers['slug'])) {
            return;
        }

        $data = $this->get_pattern($pattern);
        register_block_pattern($data['slug'], array(
            'title' => $data['title'],
            'content' => $data['content'],
        ));
    }

    public function get_pattern($pattern)
    {
        $data = get_file_data($pattern, array('title' => 'Title', 'slug' => 'Slug'));
        $data['content'] = '';
        if (!is_file($pattern)) {
            return $data;
        }
        ob_start();
        require $pattern;
        $data['content'] = (string) ob_get_clean();
        return $data;
    }

    // Post types

    public function get_post_types()
    {
        $post_types = glob(get_template_directory() . '/post-types/*/*.functions.php') ?: array();
        return $post_types;
    }

    public function load_post_types()
    {
        $post_types = $this->get_post_types();
        foreach ($post_types as $post_type) {
            require_once $post_type;
        }
    }

    // Taxonomies

    public function get_taxonomies()
    {
        $taxonomies = glob(get_template_directory() . '/taxonomies/*/*.functions.php') ?: array();
        return $taxonomies;
    }

    public function load_taxonomies()
    {
        $taxonomies = $this->get_taxonomies();
        foreach ($taxonomies as $taxonomy) {
            require_once $taxonomy;
        }
    }

    // Get JS variations

    public function get_variations()
    {
        $variations = glob(get_template_directory() . '/js/admin/variations/*.js') ?: array();
        return $variations;
    }

    // Load JS Variations

    public function load_variations()
    {
        $variations = $this->get_variations();
        foreach ($variations as $file) {
            $file_name = basename($file, '.js') . '_variations';
            wp_enqueue_script($file_name, get_template_directory_uri() . '/js/admin/variations/' . basename($file), array('wp-blocks', 'wp-dom-ready'), (string) filemtime($file), true);
        }
    }

    // Get block bindings files

    public function get_bindings()
    {
        $bindings = glob(get_template_directory() . '/bindings/**/*.php') ?: array();
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
            if (empty($binding['slug'])) {
                continue;
            }
            register_block_bindings_source('skouerr/' . $binding['slug'], array(
                'label' => $binding['name'],
                // Gives bound blocks the current post of a Query Loop.
                'uses_context' => array('postId', 'postType'),
                'get_value_callback' => function ($source_args, $block_instance, $attribute_name) use ($binding) {
                    return require $binding['file'];
                },
            ));
        }
    }

}
