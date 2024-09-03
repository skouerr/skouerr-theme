<?php
/* 
* Block Name : Template
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

$skouerr_block->set_data('title', 'BAHHH');
/**
 * Render Skouerr Block
 */
$skouerr_block->render('react');
