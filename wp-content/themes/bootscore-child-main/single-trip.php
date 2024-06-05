<?php
get_header();
$id = get_field('page_id', $post->ID);
?>

 <?php get_template_part('template-parts/shared/content', 'why'); ?>

<?php get_template_part('template-parts/city/content', 'card-wave'); ?>

<?php
$type_singular = remove_s_from_end_of_string(get_the_title($post->ID));
$sub_heading = "You get the perfect trip";
$string_array = replace_var_in_string("You get the perfect {trip}", $type_singular);


// Easy As - Content (Shared)
$featured = get_field('trip_features', 'option');
$why_args['global'] = true;
$why_args['cols'] = 2;
$why_args['section_heading'] = get_field('trips_section_heading', 'option');
$why_args['featured'] = $featured['featured'];
get_template_part('template-parts/features/content', 'features-7', $why_args);
?>


<?php get_template_part('template-parts/city/content', 'explore');?>

<?php get_template_part('template-parts/trips/content', 'why'); ?>

<?php 
if (get_field('itinerary')) {
	get_template_part('template-parts/top/timeline'); 
}
?>

<?php get_template_part('template-parts/trips/content', 'packages'); ?>



<?php get_footer(); ?>
