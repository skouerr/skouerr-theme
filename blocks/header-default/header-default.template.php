<header class="section" role="banner">
    <div class="container">

        <nav class="navbar" role="navigation" aria-label="main navigation">

            <div class="site-logo">
                <a href="<?php bloginfo('url'); ?>" title="<?php echo __('Back to homepage', 'theme_utils'); ?>" rel="home">
                    <?php the_site_logo(); ?>
                </a>
            </div>
            <div class="menu">
                <?php
                wp_nav_menu(array(
                    'theme_location'    => 'primary_menu',
                    'depth'             => 0,
                    'container'         => false,
                ));
                ?>
                <div>
                    <!-- wp:buttons -->
                    <div class="wp-block-buttons">
                        <!-- wp:button -->
                        <div class="wp-block-button">
                            <a class="wp-block-button__link wp-element-button" href="https://example.com" target="_blank"  >Click Here</a>
                        </div>
                        <!-- /wp:button -->
                    <!-- /wp:buttons -->
                </div>
            </div>
            <div class="hamburger">
                <div class="hamburger-line"></div>
                <div class="hamburger-line"></div>
                <div class="hamburger-line"></div>
            </div>
        </nav>
    </div>
</header>