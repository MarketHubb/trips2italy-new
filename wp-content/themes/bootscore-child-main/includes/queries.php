<?php
function get_related_packages_by_trip_type($post_id)
{
	$package_topic_term_id = get_field('related_packages', $post_id);
	$package_count = get_field('package_count', $post_id);

	if (!$package_topic_term_id || !$package_count) return null; 

	$related_packages = get_posts([
		'post_type' => 'package',
		'posts_per_page' => $package_count,
		'orderby' => 'rand',
		'tax_query' => [
			[
				'taxonomy' => 'topic',
				'field' => 'term_id',
				'terms' => $package_topic_term_id,
			],
		],
	]);

	return !empty($related_packages) ? $related_packages : null;
}

function get_posts_package()
{
	return get_posts(array(
		'post_type' => 'package',
		'posts_per_page' => 20,
	));
}

function get_testimonials_by_trip_type($post_id)
{
	$args = array(
		'post_type'      => 'testimonials',
		'posts_per_page' => 4,
		'meta_query'     => array(
			array(
				'key'       => 'trip_types',
				'value'     => $post_id,
				'compare'   => 'LIKE'
			),
		),
	);
	return get_posts($args);
}
function get_location_parents_ids()
{
	return get_posts([
		'post_type' => 'location',
		'posts_per_page' => -1,
		'post_parent' => 0,
		'fields' => 'ids'
	]);
}

function get_location_children_ids()
{
	$location_parents = get_location_parents_ids();

	foreach ($location_parents as $location_parent) {
		return get_posts([
			'post_type' => 'location',
			'posts_per_page' => -1,
			'post_parent' => $location_parent->ID,
			'fields' => 'ids'
		]);
	}
}
