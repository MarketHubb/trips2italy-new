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

<?php
set_query_var('paginated_post_count', 18);
global $paged;

if (!isset($paged) || !$paged) {
    $paged = 1;
}
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

    <?php
    //Set up the global $paged variable
    global $paged;

    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }
    set_query_var('paged', $paged);
    ?>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KBB6BZNM"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <?php wp_body_open(); ?>

    <div id="page" class="site" data-title="<?php echo get_the_title(); ?>">

        <span class="mask mask-light opacity-100 d-none" id="form-mask"></span>

        <?php get_template_part('template-parts/tw/content', 'nav'); ?>
        <?php //get_template_part('template-parts/shared/content', 'nav'); 
        ?>

        <div id="site" class="pt-[40px] lg:pt-[63px]">

            <?php
            $new_hero_layout = get_field('use_new_layout');

            if ($new_hero_layout) {
                get_template_part('template-parts/tw-hero/content', 'hero-new');
            } else {
                output_hero_banner(get_queried_object());
            }


            // if (isset($paged) && $paged > 1) {
            //     $hero = get_hero_fields(get_queried_object());
            //     get_template_part('template-parts/tw-hero/content', 'pagination', $hero);
            // } else {
            //     if ($new_hero_layout) {
            //         get_template_part('template-parts/tw-hero/content', 'hero-new');
            //     } else {
            //         output_hero_banner(get_queried_object());
            //     }
            // }
            ?>