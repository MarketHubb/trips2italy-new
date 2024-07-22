<?php
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
