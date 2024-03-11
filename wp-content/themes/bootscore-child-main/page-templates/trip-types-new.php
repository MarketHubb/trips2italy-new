<?php /* Template Name: Trip Types (New) */
get_header(); ?>

<?php
$hero = get_hero_banner(get_the_ID());
highlight_string("<?php\n\$hero =\n" . var_export($hero, true) . ";\n?>");
if (isset($hero)) {
    get_template_part('template-parts/shared/content', $hero['template-path'], $hero);
}
?>

<?php get_template_part('template-parts/shared/content', 'stats'); ?>

<?php get_template_part('template-parts/shared/content', 'features-1', get_the_ID()); ?>

<?php $regions = get_field('regions'); ?>

<?php get_template_part('template-parts/shared/content', 'alternate', $regions); ?>

<?php get_template_part('template-parts/shared/content', 'posts'); ?>

<?php get_template_part('template-parts/shared/content', 'testimonials-1'); ?>

<?php get_template_part('template-parts/shared/content', 'posts-cards'); ?>


<?php get_footer(); ?>