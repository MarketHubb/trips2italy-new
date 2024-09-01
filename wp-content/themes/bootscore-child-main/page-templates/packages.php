<?php
/* Template Name: Packages */
get_header();

// Set up the global $paged variable
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

<?php get_template_part('template-parts/packages/content'); ?>

<?php get_footer(); ?>
