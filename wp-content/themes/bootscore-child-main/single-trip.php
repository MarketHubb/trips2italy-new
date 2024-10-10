<?php
get_header();
$id = get_field('page_id', $post->ID);
?>

<!-- Testimonials -->
<?php get_template_part('template-parts/tw/content', 'testimonials'); ?>

<!-- What's included (cards) -->
<?php get_template_part('template-parts/trips/content', 'included'); ?>

<!-- CTA simple (centered) -->
<?php
$heading  = '<span class="block mb-2">Your Italian ' . format_trip_type_heading(get_the_title(get_the_ID())) . '</span>';
$heading .= '<span class="font-semibold stylized capitalize text-[150%] text-secondary-400">Starts Right Here</span>';
$descripion = "Tell us what you'd like to do and see, and our Italian-born travel experts will handle the rest.";


$cta_args = [
	'heading' => $heading,
	'description' => $descripion
];
get_template_part('template-parts/tw-shared/content', 'cta-centered-simple', $cta_args);
?>

<!-- Why (Trips 2 Italy) -->
<?php get_template_part('template-parts/trips/content', 'different'); ?>

<!-- How it works -->
<?php get_template_part('template-parts/trips/content', 'how-it-works'); ?>

<!-- Example trips -->
<?php //get_template_part('template-parts/trips/content', 'example-trips'); 
?>

<?php get_template_part('template-parts/trips/content', 'why'); ?>

<!-- Why more people choose -->
<?php get_template_part('template-parts/trips/content', 'choose'); ?>

<?php //get_template_part('template-parts/trips/content', 'why'); 
?>

<?php
if (get_field('itinerary')) {
	get_template_part('template-parts/top/timeline');
}
?>

<?php //get_template_part('template-parts/trips/content', 'packages'); 
?>



<?php get_footer(); ?>