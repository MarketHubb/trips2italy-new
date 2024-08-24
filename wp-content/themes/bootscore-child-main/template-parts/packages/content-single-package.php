<?php
$used_images = [0];
$first_image_in_gallery = get_field('images', get_the_ID())[0]['image']['url'];
$featured = get_field('featured_includes');
$includes = standardized_package_includes(get_field('includes'));
$featured_includes = (is_array($featured) && count($featured) === 3) ? $featured : generateGrid($includes);
$featured_args = [
	'image' => $first_image_in_gallery,
	'content' => $featured_includes
];
if (count($featured_includes) >= 3) {
	get_template_part('template-parts/packages/content', 'includes-featured', $featured_args);
}
?>

<?php get_template_part('template-parts/packages/content', 'included', standardized_package_includes(get_field('includes'))); ?>

