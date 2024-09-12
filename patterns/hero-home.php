<?php

/**
 * Title: Hero home
 * Slug: skouerr/hero-home
 */
?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1} -->
	<h1 class="wp-block-heading has-text-align-center"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
	<div class="wp-block-group"><!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum tortor ante, vel ullamcorper nisl aliquam a. Etiam sed placerat elit, quis molestie metus. Cras id facilisis libero.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

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

	<!-- wp:spacer {"height":"var:preset|spacing|l"} -->
	<div style="height:var(--wp--preset--spacing--l)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->
</div>
<!-- /wp:group -->