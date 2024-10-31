<?php
// region Packages
function get_related_packages_by_trip_type($post_id)
{
	$package_topic_term_id = get_field('related_packages', $post_id);
	$package_count = get_field('package_count', 'option');

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

function query_args_for_reviews_by_trip_type($post_id = null)
{
	// Initialize the meta query array
	$meta_query = array(
		'relation' => 'AND'
	);

	// Add post_trip condition only if post_id is not null
	if ($post_id !== null) {
		$meta_query[] = array(
			'key' => 'post_trip',
			'value' => $post_id,
			'compare' => 'LIKE'
		);
	}

	// Add the rest of the meta query conditions
	$meta_query[] = array(
		'key' => 'background_image',
		'compare' => 'EXISTS',
	);
	$meta_query[] = array(
		'key' => 'background_image',
		'value' => '',
		'compare' => '!='
	);
	$meta_query[] = array(
		'key' => 'square_image',
		'compare' => 'EXISTS',
	);
	$meta_query[] = array(
		'key' => 'square_image',
		'value' => '',
		'compare' => '!='
	);

	// Set up WP_Query arguments
	$args = array(
		'post_type' => 'review',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'rand',
		'meta_query' => $meta_query
	);

	return new WP_Query($args);
}

function get_review_posts_for_trip_type($post_id)
{
	if (empty($post_id)) return array();

	// Run the query
	$reviews_query_by_trip = query_args_for_reviews_by_trip_type($post_id);
	$reviews_query = isset($reviews_query_by_trip) && $reviews_query_by_trip->post_count > 2 ? $reviews_query_by_trip : query_args_for_reviews_by_trip_type();

	// Initialize array for post IDs
	$matching_post_ids = array();

	// Get all matching post IDs
	if ($reviews_query->have_posts()) {
		while ($reviews_query->have_posts()) {
			$reviews_query->the_post();
			$matching_post_ids[] = get_the_ID();

			// Break the loop if we've reached 4 items
			if (count($matching_post_ids) >= 4) {
				break;
			}
		}
		wp_reset_postdata();
	}

	return $matching_post_ids;
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
