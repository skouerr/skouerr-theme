<?php

/**
 * Title: Home default
 * Slug: skouerr/home-default
 */
?>
<!-- wp:group {"metadata":{"patternName":"skouerr/hero-home","name":"Hero home"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|3-xl","bottom":"var:preset|spacing|3-xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--3-xl);padding-bottom:var(--wp--preset--spacing--3-xl)"><!-- wp:heading {"textAlign":"center","level":1} -->
    <h1 class="wp-block-heading has-text-align-center"><?php echo get_bloginfo('name'); ?></h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center"} -->
    <p class="has-text-align-center"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum tortor ante, vel ullamcorper nisl aliquam a. Etiam sed placerat elit, quis molestie metus. Cras id facilisis libero.</p>
    <!-- /wp:paragraph -->

    <!-- wp:spacer {"height":"var:preset|spacing|50"} -->
    <div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons"><!-- wp:button -->
        <div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Primary Button</a></div>
        <!-- /wp:button -->

        <!-- wp:button {"className":"is-style-outline"} -->
        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">Secondary Button</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"primary-1","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-primary-1-background-color has-background" style="margin-top:0;margin-bottom:0"><!-- wp:group {"layout":{"type":"constrained"}} -->
    <div class="wp-block-group"><!-- wp:columns {"style":{"spacing":{"padding":{"top":"var:preset|spacing|3-xl","bottom":"var:preset|spacing|3-xl"}}}} -->
        <div class="wp-block-columns" style="padding-top:var(--wp--preset--spacing--3-xl);padding-bottom:var(--wp--preset--spacing--3-xl)"><!-- wp:column {"verticalAlignment":"center","layout":{"type":"constrained","justifyContent":"center"}} -->
            <div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":3} -->
                <h3 class="wp-block-heading">Section Title</h3>
                <!-- /wp:heading -->

                <!-- wp:paragraph -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc leo purus, ullamcorper nec ullamcorper ac, fringilla sed arcu.</p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons -->
                <div class="wp-block-buttons"><!-- wp:button -->
                    <div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Primary Button</a></div>
                    <!-- /wp:button -->

                    <!-- wp:button {"className":"is-style-outline"} -->
                    <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">Secondary Button</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:image {"width":"564px","height":"auto","aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large is-resized"><img src="https://images.pexels.com/photos/13622553/pexels-photo-13622553.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1260&amp;h=750&amp;dpr=2" alt="" style="aspect-ratio:4/3;object-fit:cover;width:564px;height:auto" /></figure>
                <!-- /wp:image -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0"><!-- wp:group {"layout":{"type":"constrained"}} -->
    <div class="wp-block-group"><!-- wp:columns {"style":{"spacing":{"padding":{"top":"var:preset|spacing|3-xl","bottom":"var:preset|spacing|3-xl"}}}} -->
        <div class="wp-block-columns" style="padding-top:var(--wp--preset--spacing--3-xl);padding-bottom:var(--wp--preset--spacing--3-xl)"><!-- wp:column {"verticalAlignment":"center","layout":{"type":"constrained","justifyContent":"center"}} -->
            <div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":3} -->
                <h3 class="wp-block-heading">Section Title</h3>
                <!-- /wp:heading -->

                <!-- wp:paragraph -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc leo purus, ullamcorper nec ullamcorper ac, fringilla sed arcu.</p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons -->
                <div class="wp-block-buttons"><!-- wp:button -->
                    <div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Primary Button</a></div>
                    <!-- /wp:button -->

                    <!-- wp:button {"className":"is-style-outline"} -->
                    <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">Secondary Button</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:image {"width":"564px","height":"auto","aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large is-resized"><img src="https://images.pexels.com/photos/13622553/pexels-photo-13622553.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1260&amp;h=750&amp;dpr=2" alt="" style="aspect-ratio:4/3;object-fit:cover;width:564px;height:auto" /></figure>
                <!-- /wp:image -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->