<?php
/* 
* Block Name : design-system
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

$atoms = array();

$atoms[] = array(
    'name' => 'Heading 1',
    'description' => 'Heading 1 is the most important heading',
    'render' => '<!-- wp:heading {level:1} --> <h1>Heading 1</h1> <!-- /wp:heading -->'
);

$atoms[] = array(
    'name' => 'Heading 2',
    'description' => 'Heading 2 is the second most important heading',
    'render' => '<!-- wp:heading {level:2} --> <h2>Heading 2</h2> <!-- /wp:heading -->'
);

$atoms[] = array(
    'name' => 'Heading 3',
    'description' => 'Heading 3 is the third most important heading',
    'render' => '<!-- wp:heading {level:3} --> <h3>Heading 3</h3> <!-- /wp:heading -->'
);

$skouerr_block->set_data('atoms', $atoms);
/**
 * Render Skouerr Block
 */
$skouerr_block->render('php');
