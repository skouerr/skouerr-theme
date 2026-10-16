<?php
/* 
* Block Name : documentation
*/

/**
 * Loading Skouerr Block
 */
$skouerr_block = new Skouerr_Block(__DIR__);

/**
 * Setters and Getters on Skouerr Block
 * 
 * $skouerr_block->set_data('key', 'value');
 */


// Get Readme
$readme = '';
$type_source = get_field('source');
if ($type_source == 'theme') {
    // Only files of the theme: no "..", no absolute path.
    $url  = ltrim(str_replace('\\', '/', (string) get_field('url')), '/');
    $path = get_template_directory() . '/' . $url;
    if ($url !== '' && !str_contains($url, '..') && is_file($path)) {
        $readme = (string) file_get_contents($path);
    }
}


// Parse readme to HTML

$Parsedown = new Parsedown();
$readme_html = $Parsedown->text($readme);


// Get hierarchy

$dom = new DOMDocument();
$hierarchy = [];
$currentH1 = null;
if ($readme_html !== '') {
    // HTML5 tags are unknown to libxml: keep its warnings out of the page.
    $previous = libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8"?>' . $readme_html);
    libxml_clear_errors();
    libxml_use_internal_errors($previous);
}
foreach ($dom->getElementsByTagName('*') as $element) {
    if ($element->nodeName === 'h1') {
        // Create a new H1 element
        $currentH1 = [
            'title' => $element->textContent,
            'children' => []
        ];
        $hierarchy[] = $currentH1;
    } elseif ($element->nodeName === 'h2' && $currentH1 !== null) {
        // Add an H2 element under the current H1
        $currentH1['children'][] = $element->textContent;
        // Update the last H1 element in the hierarchy
        $hierarchy[count($hierarchy) - 1] = $currentH1;
    }
}

$skouerr_block->set_data('hierarchy', $hierarchy);
$skouerr_block->set_data('readme', $readme_html);
/**
 * Render Skouerr Block
 */
$skouerr_block->render('php');
