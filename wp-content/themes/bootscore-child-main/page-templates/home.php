<?php
/* Template Name: Home */
get_header(); 
?>

<?php
$stats_content = get_field('stats')['stats'];
$stats['heading'] = get_field('stats_heading');
$stats['content'] = $stats_content;
$stats['image'] = get_home_url() . '/wp-content/uploads/2023/05/Florence.jpeg';
$stats['section'] = '<section class="pt-7" id="count-stats">';
get_template_part('template-parts/shared/content', 'stats', $stats); 
?>

<?php get_template_part('template-parts/shared/content', 'features-1', get_the_ID()); ?>

<?php
$regions = get_field('regions');
get_template_part('template-parts/shared/content', 'alternate', $regions);
?>

<?php get_template_part('template-parts/shared/content', 'posts'); ?>

<?php get_template_part('template-parts/shared/content', 'testimonials-1'); ?>

<?php get_template_part('template-parts/shared/content', 'posts-cards'); ?>


<?php get_footer(); ?>