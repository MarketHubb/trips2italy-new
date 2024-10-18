<?php
/* Template Name: Packages */
get_header();
?>

<?php
$args = [
	'query_args' => [
		'image_src' => true,
		'excerpt' => true,
		'date' => null,
		'author' => null,
		'author_img_src' => null
	],
	'post_type' => 'package'
];
// get_template_part('template-parts/tw-shared/content', 'post-list', ['post_type' => 'post']); 
get_template_part('template-parts/tw-shared/content', 'post-list', $args);

// get_template_part('template-parts/packages/content');
?>

<?php get_footer(); ?>
