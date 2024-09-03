<?php

/**
 * Utils
 */
function dsm($var)
{
    echo '<pre>';
    if (is_bool($var)) {
        var_dump($var);
    } else {
        print_r($var);
    }
    echo '</pre>';
}

/**
 * Remove <p> but keep <br>
 */
function wpautobr($content)
{
    $content = wpautop($content);
    $content = str_replace('<p>', '', $content);
    $content = str_replace('</p>', '', $content);
    return $content;
}

/**
 * Récupération de l'url d'une page par le nom de son modèle de page
 * 
 * @since 1.0.0
 */
if (!function_exists('get_permalink_by_template_name')) {

    function get_permalink_by_template_name($template_name)
    {
        $pages = get_posts(array(
            'post_type' => 'page',
            'post_status' => 'publish',
            'meta_query' => [
                [
                    'key' => '_wp_page_template',
                    'value' => $template_name . '.php',
                    'compare' => '='
                ]
            ]
        ));
        if (!empty($pages)) {
            foreach ($pages as $page) {
                return get_permalink($page->ID);
            }
        }
        return get_bloginfo('url');
    }
}

function dd()
{
    foreach (func_get_args() as $arg) {
        var_dump($arg);
    }
    die();
}

/**
 * Slugify function
 */

function slugify($string)
{
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}


/**
 * Display Thumbnail function by post id

 */

function the_thumbnail_by_post_id($id, $size = 'full', $class = '', $alt = '')
{
    $thumbnail = get_the_post_thumbnail($id, $size, ['class' => $class, 'alt' => $alt]);
    if ($thumbnail) {
        echo $thumbnail;
    }
}

/**
 * Get permalink by slug
 */

function get_permalink_by_slug($slug, $post_type = 'post')
{
    $post = get_page_by_path($slug, OBJECT, $post_type);
    if ($post) {
        return get_permalink($post->ID);
    }
    return null;
}


/*
* Lipsum function
*/

function wp_sk_lipsum($word_count = 50)
{
    // Le texte "Lorem Ipsum" complet
    $lipsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

    // Découper le texte en mots
    $words = explode(' ', $lipsum);

    // Si le nombre de mots demandé est supérieur au nombre de mots disponibles, utiliser tout le texte
    if ($word_count > count($words)) {
        $word_count = count($words);
    }

    // Sélectionner la partie du texte demandée
    $selected_words = array_slice($words, 0, $word_count);

    // Réassembler les mots en une chaîne de caractères
    $result = implode(' ', $selected_words);

    return $result;
}
