<?php
/* Template Name: Home */
get_header(); 
?>

<?php get_template_part('template-parts/home/content', 'how-it-works');  ?>

<?php get_template_part('template-parts/home/content', 'callouts');  ?>

<?php get_template_part('template-parts/home/content', 'regions'); ?>

<?php get_template_part('template-parts/home/content', 'trip-types'); ?>

<?php get_template_part('template-parts/home/content', 'testimonials'); ?>

<?php get_template_part('template-parts/home/content', 'posts'); ?>

<?php get_template_part('template-parts/shared/content', 'scroller'); ?>

<?php get_footer(); ?>