<?php
// region Reviews
function get_reviews_ordered()
{
	$output_array = output_order_testimonials();

	return get_posts(array(
		'post_type' => 'review',
		'posts_per_page' => -1,
		'order' => $output_array['order'],
		'orderby' => 'modified'
	));
}

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

function paginated_post_query($post_type, $paged = 1)
{
	$post_count = !empty(get_field('post_per_page', 'option')) ? get_field('posts_per_page', 'option') : 12;

	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => $post_count,
		'orderby' => 'date',
		'paged' => $paged,
	);

	return new WP_Query($args);
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

// region Locations
function get_location_region_tax_terms()
{
	return get_terms(
		array(
			'taxonomy' => 'location_region',
			'exclude' => [5245]
		)
	);
}

function get_location_posts_by_location_region_tax($tax_terms = [], $parents_only = null)
{
	$tax_terms = empty($tax_terms) ? get_location_region_tax_terms() : $tax_terms;

	$location_posts = [];

	foreach ($tax_terms as $tax_term) {
		$args = array(
			'post_type' => 'location',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'location_region',
					'field' => 'term_id',
					'terms' => $tax_term->term_id
				),
			),
		);

		// Add the post_parent condition if $parents_only is true
		if ($parents_only === true) {
			$args['post_parent'] = 0;
		}

		$location_posts[] = get_posts($args);
	}

	return $location_posts;
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
