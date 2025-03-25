<?php
/**
 * Name: Example
 * Slug: example
*/

/**
 * This is a block binding file that allows adding dynamic data to a WordPress block.
 * 
 * To add data to a block, insert the following into the WordPress block's code editor:
 * 
 * "metadata":{"bindings":{"content":{"source":"skouerr/example"}}}
 * 
 * Additional Information:
 * - This method enables dynamic content injection for blocks, making them more flexible.
 * - Ensure that the source identifier ("skouerr/example") matches the registered binding in your code.
 */


$value = 'Example';


// This file must return a value.
return $value;