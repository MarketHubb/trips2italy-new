<?php
get_header();
$id = get_field('page_id', $post->ID);
?>

<!-- Testimonials -->
<?php get_template_part('template-parts/tw/content', 'testimonials'); ?>

<!-- What's included (cards) -->
<?php get_template_part('template-parts/trips/content', 'included'); ?>

<!-- Why (Trips 2 Italy) -->
<?php get_template_part('template-parts/trips/content', 'different'); ?>

<!-- How it works -->
<?php get_template_part('template-parts/trips/content', 'how-it-works'); ?>

<!-- Example trips -->
<?php //get_template_part('template-parts/trips/content', 'example-trips'); ?>

<?php get_template_part('template-parts/trips/content', 'why'); ?>

<!-- Why more people choose -->
<?php get_template_part('template-parts/trips/content', 'choose'); ?>

<?php //get_template_part('template-parts/trips/content', 'why'); ?>

<?php
if (get_field('itinerary')) {
	get_template_part('template-parts/top/timeline');
}
?>

<?php //get_template_part('template-parts/trips/content', 'packages'); ?>



<?php get_footer(); ?>