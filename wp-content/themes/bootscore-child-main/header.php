<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 *
 * @version 5.2.0.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/safari-pinned-tab.svg" color="#0d6efd">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">


    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KBB6BZNM');</script>
    <!-- End Google Tag Manager -->


    <?php wp_head(); ?>

    <?php $_SERVER['REFERER_ID'] = (get_the_ID() !== 28484) ? get_the_ID() : null; ?>

</head>

<body <?php body_class(); ?>>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KBB6BZNM"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

<?php wp_body_open(); ?>

<div id="page" class="site" data-title="<?php echo get_the_title(); ?>">

    <span class="mask mask-light opacity-100 d-none" id="form-mask"></span>

    <header id="masthead" class="site-header">

        <?php get_template_part('template-parts/shared/content', 'nav'); ?>

        <div class="fixed-top bg-light d-none">

            <nav id="nav-main" class="navbar navbar-expand-lg">

                <div class="container">

                    <!-- Navbar Brand -->
                    <a class="navbar-brand xs d-md-none" href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/logo/logo-sm.svg" alt="logo" class="logo xs"></a>
                    <a class="navbar-brand md d-none d-md-block" href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/logo/logo.svg" alt="logo" class="logo md"></a>

                    <!-- Offcanvas Navbar -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-navbar">
                        <div class="offcanvas-header bg-light">
                            <span class="h5 mb-0"><?php esc_html_e('Menu', 'bootscore'); ?></span>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <!-- Bootstrap 5 Nav Walker Main Menu -->
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'main-menu',
                                'container' => false,
                                'menu_class' => '',
                                'fallback_cb' => '__return_false',
                                'items_wrap' => '<ul id="bootscore-navbar" class="navbar-nav ms-auto %2$s">%3$s</ul>',
                                'depth' => 2,
                                'walker' => new bootstrap_5_wp_nav_menu_walker()
                            ));
                            ?>
                            <!-- Bootstrap 5 Nav Walker Main Menu End -->
                        </div>
                    </div>


                    <div class="header-actions d-flex align-items-center">

                        <!-- Top Nav Widget -->
                        <div class="top-nav-widget">
                            <?php if (is_active_sidebar('top-nav')) : ?>
                                <div>
                                    <?php dynamic_sidebar('top-nav'); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Searchform Large -->
                        <div class="d-none d-lg-block ms-1 ms-md-2 top-nav-search-lg">
                            <?php if (is_active_sidebar('top-nav-search')) : ?>
                                <div>
                                    <?php dynamic_sidebar('top-nav-search'); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Search Toggler Mobile -->
                        <button class="btn btn-outline-secondary d-lg-none ms-1 ms-md-2 top-nav-search-md" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-search" aria-expanded="false" aria-controls="collapse-search">
                            <i class="fa-solid fa-magnifying-glass"></i><span class="visually-hidden-focusable">Search</span>
                        </button>

                        <!-- Navbar Toggler -->
                        <button class="btn btn-outline-secondary d-lg-none ms-1 ms-md-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar" aria-controls="offcanvas-navbar">
                            <i class="fa-solid fa-bars"></i><span class="visually-hidden-focusable">Menu</span>
                        </button>

                    </div><!-- .header-actions -->

                </div><!-- .container -->

            </nav><!-- .navbar -->

            <!-- Top Nav Search Mobile Collapse -->
            <div class="collapse container d-lg-none" id="collapse-search">
                <?php if (is_active_sidebar('top-nav-search')) : ?>
                    <div class="mb-2">
                        <?php dynamic_sidebar('top-nav-search'); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div><!-- .fixed-top .bg-light -->

    </header><!-- #masthead -->

    <div id="site">

        <?php

        function get_hero_by_post_type($object) {

            // Locations (Cities & Regions)
            if ($object->taxonomy === 'location_region' || $object->post_type === 'location') {
                $inputs = location_hero_and_tab_inputs(get_queried_object());
                set_query_var('inputs', $inputs);

                if ($inputs['hero']) {
                    get_template_part('template-parts/banner/content', 'full-width-text-overlay', $inputs['hero']);
                }
            }

            // Trip Types
            if ($object->post_type === 'trip') {
                get_template_part('template-parts/banner/content', 'center-wave');
            }

            // Packages
            if ($object->post_type === 'package') {
                get_template_part('template-parts/packages/content', 'single-hero');
            }
        }

        function get_shared_hero_banner($object) {
            $hero_inputs = get_hero_inputs($object);

            if (!empty($hero_inputs) && $hero_inputs['include']) {
                get_template_part('template-parts/hero/content', $hero_inputs['template'], $hero_inputs);
                get_template_part('template-parts/hero-banner/content', 'main', $hero_inputs);
            }
        }

        function output_hero_banner($object) {
            $include_hero = get_field('include_hero_banner', $object);
            $hero = null;

            if ($include_hero) {
                get_shared_hero_banner($object);
            } else {
                get_hero_by_post_type($object);
            }
        }

         output_hero_banner(get_queried_object());
/*        highlight_string("<?php\n\$hero =\n" . var_export($hero, true) . ";\n?>");*/

//        if ($object->post_type === 'page' && $hero['include'] && get_the_ID() !== 28484) {
//            get_template_part('template-parts/hero/content', $hero['template'], $hero);
//        }

        ?>