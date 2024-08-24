<?php
/* Template Name: About Us */
get_header(); ?>

    <section class="mb-5">

        <?php
        $hero = get_hero_inputs(get_queried_object());
        if (isset($hero)) {
            get_template_part('template-parts/hero/content', $hero['type'], $hero);
        }
        ?>

    <?php get_template_part('template-parts/about/content', 'why'); ?>
    
    <?php get_template_part('template-parts/about/content', 'cta'); ?>

    <?php get_template_part('template-parts/about/content', 'testimonial'); ?>

    <?php get_template_part('template-parts/about/content', 'story'); ?>

    </section>

<?php get_footer(); ?>
