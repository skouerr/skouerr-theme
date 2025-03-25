<?php

function theme_utils_block_categories($categories, $post)
{
    return array_merge(

        array(
            array(
                'slug' => 'theme_utils-blocks',
                'title' => __('Blocs du thème', 'theme_utils'),
                'icon'  => 'dashicons-welcome-widgets-menus',
            )
        ),
        $categories
    );
}

add_filter('block_categories_all', 'theme_utils_block_categories', 10, 2);

// Blocs autorisés
function set_allowed_block_types($allowed_blocks, $post)
{

    $allowed_blocks = array(
        'core/paragraph',
        'core/heading',
        'core/list',
        'core/list-item',
        'core/columns',
        'core/column',
        'core/button',
        'core/buttons',
        'core/image',
        'core/quote',
        'core/table',
        'core/spacer',
        'core/navigation',
        'core/navigation-link',
        'core/home-link',
        'core/block',
        'core/code',
        'core/file',
        'core/group',
        'core/query',
        'core/post-template',
        'core/buttons',
        'core/button',
        'core/categories',
        'core/post-title',
        'core/post-excerpt',
        'core/post-featured-image',
        'core/post-content',
        'core/post-date',
        'core/post-author',
        'core/post-comment-count',
        'core/post-tags',
        'core/post-categories',
        'core/latest-posts',
        'core/latest-comments',
        'core/spacer',
        'yoast-seo/breadcrumbs',
        'yoast-seo/reading-time',
        'core/read-more',
        'core/post-terms',
        'core/shortcode',
        'core/post-date',
        'core/separator',
        'core/quote',
        'core/cover',
        'core/more',
        'core/embed'
    );

    // uniquement pour les admins
    if (current_user_can('administrator')) {
        $allowed_blocks[] = 'core/html';
    }


    return $allowed_blocks;
}
add_filter('allowed_block_types_all', 'set_allowed_block_types', 10, 2);
//add_filter('allowed_block_types_all', 'set_allowed_block_types', 1000, 2);
