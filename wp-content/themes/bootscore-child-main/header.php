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

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KBB6BZNM');
    </script>
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

        <?php get_template_part('template-parts/tw/content', 'nav'); ?>
        <?php //get_template_part('template-parts/shared/content', 'nav'); ?>

        <div id="site" class="pt-[40px] lg:pt-[63px]">

            <?php
            $new_hero_layout = get_field('use_new_layout');
            if (isset($new_hero_layout) && $new_hero_layout) {
                get_template_part( 'template-parts/tw-hero/content', 'hero-new' );
                //get_template_part( 'template-parts/tw-hero/content', 'image-full' );
            } else {
                function get_hero_by_post_type($object)
                {

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
                        get_template_part( 'template-parts/tw-hero/content', 'hero-angled' );
                        // get_template_part('template-parts/packages/content', 'single-hero');
                    }
                }

                function get_shared_hero_banner($object)
                {
                    $hero_inputs = get_hero_inputs($object);

                    if (! empty($hero_inputs) && $hero_inputs['include']) {
                        get_template_part('template-parts/hero/content', $hero_inputs['template'], $hero_inputs);
                        get_template_part('template-parts/hero-banner/content', 'main', $hero_inputs);
                    }
                }

                function output_hero_banner($object)
                {
                    $include_hero = get_field('include_hero_banner', $object);
                    $hero         = null;

                    if ($include_hero) {
                        get_shared_hero_banner($object);
                    } else {
                        get_hero_by_post_type($object);
                    }
                }

                output_hero_banner(get_queried_object());
            }
            ?>