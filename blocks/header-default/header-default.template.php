<header class="section" role="banner">
    <div class="container">

        <nav class="navbar" role="navigation" aria-label="main navigation">

            <div class="site-logo">
                <a href="<?php bloginfo('url'); ?>" title="<?php echo __('Back to homepage', 'theme_utils'); ?>" rel="home">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/logo.png" alt="Logo <?php bloginfo('name'); ?>" />
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
                    <div class="wp-block-button"><a class="wp-block-button__link" href="https://example.com" target="_blank" rel="noopener noreferrer">Click Here</a></div>
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