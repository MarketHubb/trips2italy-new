<?php
function output_formatted_review($post_object)
{
	$raw_review = get_field('review', $post_object->ID);
	$title_raw = trim(remove_dashes_from_string(get_the_title($post_object->ID), "before"));
	$location_no_author = str_replace($title_raw, "", get_field('location', $post_object->ID));
	$location_raw = trim(remove_dashes_from_string($location_no_author, "after"));
	$location = str_replace($title_raw, "", $location_raw);
	$review = str_replace($location, "", $raw_review);
	$author_clean = str_replace("-", "", str_replace("&amp;", "&", $title_raw));
	$author = trim(str_replace($location, "", $author_clean));

	$output  = '<div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700">';
    $output .= '<div class="flex-auto p-4 md:p-6 md:pb-[6rem]">';
    $output .= '<p class="line-clamp-4 h-full mt-3 sm:mt-6 text-base text-gray-800 md:text-lg dark:text-white"><em>';
    $output .= $review . '</em></p>';
    $output .= '<span class="testimonial-full hidden">' . $review . '</span>';
    $output .= '</div>';

    $output .= '<div class="p-4 rounded-b-xl md:px-6 bg-gray-100 min-h-[77px]">';
    if ($author) {
    	$output .= '<h3 class="text-sm font-semibold text-gray-800 sm:text-base dark:text-neutral-200">';
    	$output .= $author;
    	$output .= '</h3>';
    }
    if ($location) {
    	$output .= '<p class="text-sm text-gray-500 dark:text-neutral-500">';
    	$output .= $location;
    	$output .= '</p>';
    }
    $output .= '</div>';
    $output .= '</div>';

	return $output;
}

function get_package_description($post_id)
{
	$package_description = get_field('description', $post_id);

	return splitParagraph($package_description);
}
function get_first_sentence($paragraph)
{
	// Regular expression to match the first sentence
	$pattern = '/(.*?[.!?])(\\s|$)/';

	// Use preg_match to find the first sentence
	if (preg_match($pattern, $paragraph, $matches)) {
		return $matches[1];
	}

	// If no sentence-ending punctuation is found, return the entire paragraph
	return $paragraph;
}
// region Packages

function get_term_badges_for_package($post_id)
{
	$terms = [];
	$terms[] = get_the_terms($post_id, 'topic');
	$terms[] = get_the_terms($post_id, 'region');

	$term_badges = '';

	foreach ($terms[0] as $term) {
		$term_badges .= '<span class="inline-flex items-center rounded-full bg-[rgba(25,124,204,.1)] px-2 py-1 text-xs font-medium text-brand ring-1 ring-inset ring-brand/10 relative mr-2">' . $term->name . '</span>';
	}

	return $term_badges;
}

function extractBeforePipe($string)
{
	$string = trim($string);

	if (strpos($string, '|') !== false) {
		return trim(explode('|', $string)[0]);
	} else {
		return $string;
	}
}

function getRandomImageIndex($image_count, $used_indexes)
{
	// Generate an array of all indexes
	$all_indexes = range(0, $image_count - 1);

	// Calculate the array of unused indexes
	$unused_indexes = array_diff($all_indexes, $used_indexes);

	// Check if there is at least 1 unused index
	if (count($unused_indexes) < 1) {
		// Handle the case where there are no unused indexes
		return ['Error: No unused images available'];
	}

	// Randomly pick 1 index from unused indexes
	$randomKey = array_rand($unused_indexes, 1);
	$randomImageIndex = $unused_indexes[$randomKey];

	return $randomImageIndex;
}

function splitParagraph($paragraph)
{
	// Use regular expression to match sentences
	$sentencePattern = '/([^.!?]*[.!?])/';

	// Find all sentences in the paragraph
	preg_match_all($sentencePattern, $paragraph, $matches);

	// Extract sentences
	$sentences = $matches[0];

	// Prepare the first part: Join the first two sentences without adding extra spaces
	$firstPart = isset($sentences[0]) ? $sentences[0] : '';
	$firstPart .= isset($sentences[1]) ? $sentences[1] : '';

	// Prepare the second part: Join the remaining sentences without adding extra spaces
	$secondPart = '';
	if (count($sentences) > 2) {
		$secondPart = implode('', array_slice($sentences, 2));
	}

	// Ensure the first part is trimmed of any leading/trailing spaces
	$firstPart = trim($firstPart);

	// Ensure the second part is trimmed of any leading/trailing spaces
	$secondPart = trim($secondPart);

	// Return the parts as an array
	return [$firstPart, $secondPart];
}

function standardized_package_includes($arr)
{
	$result = [];
	foreach ($arr as $item) {
		if (isset($item['item'])) {
			$str = $item['item'];
			if (stripos($str, 'include') === false) {
				$str = ltrim($str, '-');
				$str = rtrim($str, '.;:');
				$str = trim($str);
				if (!empty($str)) {
					$result[] = ['item' => $str];
				}
			}
		}
	}
	return $result;
}
function generateGrid($items)
{
	$output = [];

	foreach ($items as $item) {
		$text = $item['item'];
		$words = explode(' ', $text);
		$totalWords = count($words);
		$headingWords = [];
		$contentWords = [];

		if ($totalWords <= 4) {
			$headingWords[] = $words[0];
			$contentWords = array_slice($words, 1);
		} else {
			$maxHeadingLength = 20; // Adjust this value as needed
			$currentLength = 0;
			$currentHeading = '';

			foreach ($words as $word) {
				$wordLength = strlen($word);
				if ($currentLength + $wordLength <= $maxHeadingLength) {
					$currentHeading .= $word . ' ';
					$currentLength += $wordLength + 1; // +1 for the space
				} else {
					$headingWords = explode(' ', rtrim($currentHeading));
					$contentWords = array_slice($words, count($headingWords));
					break;
				}
			}
		}

		$output[] = [
			'callout' => implode(' ', $headingWords),
			'description' => implode(' ', $contentWords),
		];
	}
	return $output;
}

// region Shared
function galleryLightbox($args = [])
{
	$gallery = '';

	if (isset($args["src"]) && $args["src"]) {
		$gallery .= '<div class="">';
		$gallery .= '<a href="' . $args['src'] . '" ';
		$gallery .= 'data-toggle="lightbox" data-gallery="example-gallery">';
		$gallery .= '<img src="' . $args['src'] . '" class="img-fluid rounded shadow" />';
		$gallery .= '</a>';
	}

	if (isset($args['caption']) && $args['caption']) {
		$gallery .= '<div class="text-center"><p class="small px-4 text-dark pt-2">' . $args['caption'] . '</p></div>';
	}

	$gallery .= '</div>';

	return $gallery;
}

function outputGalleryLightbox($photos)
{
	$output  = '<div class="container">';
	$output .= '<div class="d-grid sm-grid-cols-1 md-grid-cols-2 grid-cols-3 grid-gap-2">';

	foreach ($photos as $photo) {
		$output .= galleryLightbox($photo);
	}

	$output .= '</div>';

	return $output;
}
// endregion

// region Content
function get_section_container_open($custom_classes = null)
{
	$classes = $custom_classes ?: 'overflow-hidden py-14 md:py-32 px-4 md:px-6';

	return '<section class="' . $classes . '">';
}

function get_content_section_heading($heading_array = array(), $row = true, $text_center = true, $light_text = null, $cols = null, $description_classes = null)
{
	if (is_array($heading_array)) {

		$heading = '';

		if ($row) {
			$light_text_class = ($light_text) ? "text-light" : '';
			$heading .= '<div class="row justify-content-center section-heading mb-5 pb-2 ' . $light_text_class . '">';
		}

		$cols_orientation = ($text_center) ? " text-center" : ' ';

		$cols = ($cols) ?: 'col-md-8';

		$column_classes = $cols . $cols_orientation;

		$heading .= '<div class="' . $column_classes . '">';

		if ($heading_array['heading']) {
			$heading .= '<h2 class="mb-1 mt-2">' . $heading_array['heading'] . '</h2>';
		}
		if ($heading_array['subheading']) {
			$heading .= '<h2 class="text-gradient text-primary stylized">' . $heading_array['subheading'] . '</h2>';
		}

		if ($heading_array['description']) {
			$description_classes = ($description_classes) ?: 'lead mt-4 fw-600 fs-5 lh-base heading-description';
			$heading .= '<p class="' . $description_classes . '">' . $heading_array['description'] . '</p>';
		}

		$heading .= '</div>';

		if ($row) {
			$heading .= '</div>';
		}

		return $heading;
	}
}

function set_url_from_link_type($link_type)
{
	if ($link_type === "Post - Regions") {
		return "region";
	}
}

function get_content_section_links($section = array(), $path, $arrow = null)
{
	// Var Paths
	$style = $path . 'style';
	$text = $path . 'text';
	$type = $path . 'type';

	if (isset($section[$type])) {
		$section_type_link = set_url_from_link_type($section[$type]);
		$url = (isset($section_type_link)) ? $path . $section_type_link : $path;

		$classes = (isset($section[$style]) && $section[$style] === 'Button') ? 'btn bg-orange btn-lg' : 'text-dark icon-move-right fw-bold fs-5';

		if (isset($section[$url])) {
			$output = '<a ';
			$output .= 'href="' . $section[$url] . '" ';
			$output .= 'class="' . $classes . '">';
			$output .= $section[$text];

			if ($arrow) {
				$output .= '<i class="fas fa-arrow-right text-sm ms-1"></i>';
			}

			$output .= '</a>';
		}
	}

	return $output ?: null;
}

function get_stats($stats = array())
{
	if (is_array($stats)) {
		$content = '';
		foreach ($stats as $stat) {
			$content .= '<div class="col-md-4 position-relative">';
			$content .= '<div class="p-3 text-center">';
			$content .= '<h3 class="text-brand-500 tracking-wide text-2xl font-semibold font-heeading">' . $stat['stat'] . '</h3>';
			$content .= '<h4 class="mt-3 stylized text-secondary-500 text-xl lg:text-3xl mb-6">' . $stat['subheading'] . '</h4>';
			$content .= '<p class="text-gray-700 text-base lg:text-lg px-4">' . $stat['description'] . '</p>';
			$content .= '</div><hr class="vertical dark"></div>';
		}
	}

	return ($content) ?: null;
}
// endregion

//region Helpers
function get_parent_term_id($term)
{
	return ($term->parent === 0) ? $term->term_id : $term->parent;
}
function get_post_parent_id($post)
{
	return ($post->post_parent === 0) ? $post->ID : $post->post_parent;
}
function lowercase_no_spaces($string)
{
	return strtolower(str_replace(" ", "", $string));
}
//endregion
function get_formatted_region_page_type($title, $destination = null)
{
	$removal_words = ["Ultimate", "Guide", "For", "Traveling", "Travel", "Vacation", "Italy", "In"];

	if ($destination) {
		$removal_words[] = $destination;
	}

	$title_array = explode(" ", $title);

	foreach ($title_array as $key => $word) {
		if (in_array($word, $removal_words)) {
			unset($title_array[$key]);
		}
	}

	$clean_title = '';

	foreach ($title_array as $words) {
		$clean_title .= $words . ' ';
	}

	return trim($clean_title);
}

function get_hero_breadcrumb_links($object, $type)
{

	$breadcrumbs = [];

	$breadcrumbs[] = [
		'text' => 'Regions',
		'link' => get_permalink(27712),
		'icon' => get_home_url() . '/wp-content/uploads/2023/01/Marker.svg',
	];

	if ($object->post_type === 'location') {
		if ($object->post_parent) {
			$current_title = str_replace(get_the_title($object->post_parent), '', $object->post_title);
			$breadcrumbs[] = [
				'text' => get_the_title($object->post_parent),
				'link' => get_permalink($object->post_parent),
				'icon' => null,
			];
			$breadcrumbs[]  = [
				'text' => $current_title,
				'link' => null,
				'icon' => null
			];
		} else {
			$breadcrumbs[]  = [
				'text' => $object->post_title,
				'link' => null,
				'icon' => null
			];
		}
	} else {
		$current_page = ($type === "post") ? get_the_title($object->ID) : get_term($object->term_id)->name;

		$breadcrumbs[] = [
			'text' => str_replace("Ultimate", "", $current_page),
			'link' => null,
			'icon' => get_home_url() . '/wp-content/uploads/2023/07/Map-Pin.svg',
		];
	}

	return $breadcrumbs;
}

function get_post_hero_inputs($object)
{
	$id = $object->ID;
	$parent = get_post_parent($object);
	$initial = ($parent) ? $parent : $object;
	$hero = [];

	if ($object->post_type === 'location') {
		$image = (get_field('featured_image', $id)) ? get_field('featured_image', $id)['url'] : get_field('image_slider_url', $id);

		if ($image) {
			$hero['image'] = remove_dev_domain_from_url($image);
		}

		if (!$object->post_parent) {
			$heading_1 = $object->post_title;
			$heading_2 = 'City Guide';
		} else {
			$parent = get_the_title($object->post_parent);
			if (isset($parent)) {
				$heading_2 = str_replace($parent, '', $object->post_title);
				$heading_1 = str_replace($heading_2, '', $object->post_title);
			}
		}
	}

	$hero_inputs = [
		'images' => [
			'background_image' => $image
		],
		'copy' => [
			'heading_1' => [
				'desktop' => $heading_1
			],
			'heading_2' => [
				'desktop' => $heading_2
			]
		]

	];

	return $hero_inputs;
}

function get_tax_hero_inputs($term)
{
	$image = (get_field('featured_image', $term)) ? get_field('featured_image', $term)['url'] : remove_dev_domain_from_url(get_field('image_slider_url', $term));

	if (!$term->parent) {
		$heading_1 = $term->name;
		$heading_2 = 'Region Guide';
	} else {
		$parent = get_term($term->parent)->name;
		if (isset($parent)) {
			$heading_2 = str_replace($parent, '', $term->name);
			$heading_1 = str_replace($heading_2, '', $term->name);
		}
	}

	$hero_inputs = [
		'images' => [
			'background_image' => $image
		],
		'copy' => [
			'heading_1' => [
				'desktop' => $heading_1
			],
			'heading_2' => [
				'desktop' => $heading_2
			]
		]

	];

	// $hero['image'] = $image;
	// $hero['heading'] = $term->name;
	// $region_name = ($term->parent === 0) ? $term->name : get_term($term->parent)->name;
	// $hero['button_text'] = 'Get My Custom ' . $region_name . ' Itinerary';

	// return $hero;
	return $hero_inputs;
}
function sort_order_locations($child_title)
{
	switch ($child_title) {
		case str_contains($child_title, 'history'):
			$order = 1;
			break;
		case str_contains($child_title, 'food'):
			$order = 2;
			break;
		case str_contains($child_title, 'culture'):
			$order = 3;
			break;
		case str_contains($child_title, 'things'):
			$order = 4;
			break;
	}

	return $order;
}
function location_post_tabs($postObj)
{
	$parent = get_post_parent($postObj);
	$initial = ($parent) ? $parent : $postObj;
	$tabs['location'] = $initial->post_title;

	$tabs['pages'][0] = [
		'name' => "Ultimate Travel Guide",
		'permalink' => get_permalink($initial->ID),
		'icon' => get_home_url() . '/wp-content/uploads/2023/01/Pin-Shadow.svg',
	];

	$children_posts = get_posts(
		array(
			'post_type' => 'location',
			'post_parent' => $initial->ID,
			'posts_per_page' => -1,
		)
	);

	foreach ($children_posts as $child_post) {
		$child_post_title = strtolower($child_post->post_title);
		$order = sort_order_locations($child_post_title);

		if (strpos($child_post_title, "&#8217;s") !== false) {
			$child_post_title = str_replace("&#8217;s", "", $child_post_title);
		}

		$tabs['pages'][$order] = [
			'name' => trim(str_replace($initial->post_title, "", $child_post->post_title)),
			'permalink' => get_permalink($child_post->ID),
			'icon' => get_icon_for_region_page(get_the_title($child_post->ID)),
		];
	}

	return $tabs;
}

function location_tax_tabs($postObj)
{
	$parent_id = get_parent_term_id($postObj);
	$parent = get_term_by('term_id', $parent_id, 'location_region');
	$tabs['location'] = $parent->name;

	$tabs['pages'][0] = [
		'name' => "Region Guide",
		'permalink' => get_term_link($parent),
		'icon' => get_home_url() . '/wp-content/uploads/2023/01/Pin-Shadow.svg',
	];

	$children_terms = get_terms(
		array(
			'taxonomy' => 'location_region',
			'hide_empty' => false,
			'parent' => $parent_id,
		)
	);

	foreach ($children_terms as $child_term) {
		$child_term_title = strtolower($child_term->name);
		$order = sort_order_locations($child_term_title);

		$tabs['pages'][$order] = [
			'name' => trim(str_replace($parent->name, "", $child_term->name)),
			'permalink' => get_term_link($child_term),
			'icon' => get_icon_for_region_page($child_term->name),
		];
	}

	return $tabs;
}

function location_tabs($postObj, $type)
{
	$tabs = ($type === "post") ? location_post_tabs($postObj) : location_tax_tabs($postObj);

	return $tabs ?: null;
}

function location_hero_and_tab_inputs($postObj)
{
	$inputs = null;

	if ($postObj->ID) {
		$type = 'post';
		$inputs['hero'] = get_post_hero_inputs($postObj);
	}

	if ($postObj->term_id) {
		$type = 'taxonomy';
		$inputs['hero'] = get_tax_hero_inputs($postObj);
	}

	$inputs['hero']['breadcrumbs'] = ($type) ? get_hero_breadcrumb_links($postObj, $type) : null;

	$inputs['tabs'] = location_tabs($postObj, $type);

	return $inputs ?: null;
}

function region_tabs($term)
{
	$parent_term_id = get_parent_term_id($term);
	$parent_region = get_term_by('ID', $parent_term_id, 'location_region');
	$region_terms[] = [
		'name' => $parent_region->name,
		'permalink' => get_term_link($parent_region),
		'icon' => get_home_url() . '/wp-content/uploads/2023/01/Pin-Shadow.svg',
	];

	$children_terms = get_terms(
		array(
			'taxonomy' => 'region',
			'hide_empty' => false,
			'parent' => $parent_term_id,
		)
	);

	foreach ($children_terms as $child_term) {
		$child_term_name = htmlspecialchars($child_term->name);

		if (strpos($child_term_name, "&#8217;s") !== false) {
			$child_term_name = str_replace("&#8217;s", "", $child_term_name);
		}

		$child_term_title = trim(str_replace($parent_region->name, "", format_region_title($child_term->term_id, $child_term_name)));
		$region_terms[] = [
			'name' => $child_term_title,
			'permalink' => get_term_link($child_term),
			'icon' => get_icon_for_region_page($child_term->name),
		];
	}

	return $region_terms;
}

function get_tax_tab_inputs($term)
{
	$parent_term_id = get_parent_term_id($term);
	$parent_region = get_term_by('ID', $parent_term_id, 'region');
	$region_terms[] = [
		'name' => $parent_region->name,
		'permalink' => get_term_link($parent_region),
		'icon' => get_home_url() . '/wp-content/uploads/2023/01/Pin-Shadow.svg',
	];

	$children_terms = get_terms(
		array(
			'taxonomy' => 'region',
			'hide_empty' => false,
			'parent' => $parent_term_id,
		)
	);

	foreach ($children_terms as $child_term) {
		$child_term_name = htmlspecialchars($child_term->name);

		if (strpos($child_term_name, "&#8217;s") !== false) {
			$child_term_name = str_replace("&#8217;s", "", $child_term_name);
		}

		$child_term_title = trim(str_replace($parent_region->name, "", format_region_title($child_term->term_id, $child_term_name)));
		$region_terms[] = [
			'name' => $child_term_title,
			'permalink' => get_term_link($child_term),
			'icon' => get_icon_for_region_page($child_term->name),
		];
	}

	return $region_terms;
}

function get_city_post_tab_inputs($post)
{
	$parent_post_id = get_post_parent_id($post);
	$parent_post_title = format_region_title($parent_post_id, get_the_title($parent_post_id));
	$region_posts[] = [
		'name' => $parent_post_title,
		'permalink' => get_permalink($parent_post_id),
		'icon' => get_home_url() . '/wp-content/uploads/2023/01/Pin-Shadow.svg',
	];

	$children_posts = get_posts(
		array(
			'post_type' => get_post_type($post),
			'post_parent' => $parent_post_id,
			'posts_per_page' => -1,
		)
	);

	foreach ($children_posts as $child_post) {
		$child_term_name = get_the_title($child_post->ID);

		if (strpos($child_term_name, "&#8217;s") !== false) {
			$child_term_name = str_replace("&#8217;s", "", $child_term_name);
		}

		$child_post_title = trim(str_replace($parent_post_title, "", format_region_title($child_post->ID, $child_term_name)));
		$region_posts[] = [
			'name' => $child_post_title,
			'permalink' => get_permalink($child_post->ID),
			'icon' => get_icon_for_region_page(get_the_title($child_post->ID)),
		];
	}

	return $region_posts;
}

function format_region_title($post_id)
{
	$title = get_the_title($post_id);

	$removal_words = ["Ultimate", "Guide", "For", "Traveling", "Travel", "Vacation", "Italy", "In", "of", "-", "What to See", "Of", "Travelers", "What to See"];

	$title_array = explode(" ", $title);

	foreach ($title_array as $key => $word) {
		if (in_array($word, $removal_words)) {
			unset($title_array[$key]);
		}
	}

	$clean_title = '';

	foreach ($title_array as $words) {
		$clean_title .= $words . ' ';
	}

	$clean_title = remove_dashes(standardize_to(standardize_ampersands($clean_title)));

	return trim($clean_title);
}

function format_region_child_page_type($post_id, $parent = null)
{
	$city = format_region_title($post_id);
	return $city;
}

function format_region_page_type($post_id, $parent_id = null)
{
	$city = get_post($post_id);
	if ($city->post_parent !== 0 && get_field('standardized_title')) {
		return 'Ultimate ' . get_field('standardized_title');
	} elseif ($city->post_parent === 0 && !get_field('standardized_title')) {
		return 'Ultimate Travel Guide';
	} else {
		$title = get_the_title($post_id);
		$title = str_replace(format_region_title($parent_id), '', $title);
		if ($post_id !== $parent_id) {
			$title = str_replace('Ultimate', '', $title);
		}
		return $title;
	}
}

function get_icon_for_region_page($formatted_title)
{
	$url = get_home_url();
	switch (true) {
		case str_contains($formatted_title, 'History'):
			return $url . '/wp-content/uploads/2023/09/rome-building.svg';
		case str_contains($formatted_title, 'Food'):
			return $url . '/wp-content/uploads/2023/09/wine-glasses.svg';
		case str_contains($formatted_title, 'Culture'):
			return $url . '/wp-content/uploads/2023/01/Culture.svg';
		case str_contains($formatted_title, 'Things'):
			return $url . '/wp-content/uploads/2023/09/cal-2.svg';
	}
}

function return_portion_of_text($text, $length = 150)
{
	// Convert $length to a positive integer
	$length = abs((int)$length);

	// Strip HTML tags and decode HTML entities
	$text = wp_strip_all_tags(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));

	// Remove extra whitespace
	$text = preg_replace('/\s+/', ' ', trim($text));

	// If the text is longer than the desired length
	if (mb_strlen($text) > $length) {
		// Find the position of the 150th character (ignoring spaces)
		$char_count = 0;
		$truncate_pos = 0;
		for ($i = 0; $i < mb_strlen($text); $i++) {
			if (mb_substr($text, $i, 1) !== ' ') {
				$char_count++;
			}
			if ($char_count == $length) {
				$truncate_pos = $i + 1;
				break;
			}
		}

		// Truncate the text
		$text = mb_substr($text, 0, $truncate_pos);

		// Remove partial words at the end
		$text = preg_replace('/\s+?(\S+)?$/', '', $text);

		// Add ellipsis
		$text .= '...';
	}

	return $text;
}

function get_excerpt_for_post($text, $length = 10)
{
	$length = abs((int) $length);
	if (strlen($text) > $length) {
		$text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
	}
	return ($text);
}

//region Hero

//endregion

function remove_travel_guides_from_content($string)
{
	$string = str_replace('<strong>Travel Guides</strong>', '', $string);

	return str_replace('<b></b><b></b>', '', $string);
}

function remove_embeds_from_content($content, $return_type = null)
{
	$content = explode("\n", $content);
	$clean_array = [];
	$clean_content = '';

	foreach ($content as $key => $val) {
		$line = trim(preg_replace("/\[.*?\]/", "", $val));
		if (strlen($line) > 0) {
			$clean_content .= "\n" . $line . "\n";
			$clean_array[] = $line;
		}
	}
	return (!$return_type) ? $clean_content : $clean_array;
}

function get_alternate_text($section, $side)
{
	$column_classes = $side === "left" ? '' : 'order-1 order-md-1 order-lg-1';
	$link = get_content_section_links($section, "link_link_", true);

	$text = '<div class="col-lg-6 col-md-12 me-auto ' . $column_classes . '">
                <div class="p-3 pt-0">
                    <h2 class=" tracking-normal fw-bolder mt-3 mb-0 text-xl md:text-2xl">' . $section['region'] . '</h2>
                    <h4 class="mb-4 stylized text-2xl md:text-3xl text-secondary-500">' . $section['callout'] . '</h4>
                    <p class="region-description text-gray-600 text-lg lg:text-xl mb-4">' . $section['excerpt'] . '</p>';

	// $text .= '<a href="' . $section['region_link'] . '" class="text-dark icon-move-right fw-bold fs-5">Discover ' . $section['region'];
	// $text .= '<i class="fas fa-arrow-right text-sm ms-1"></i></a>';
	$text .= '</div></div>';

	return $text;
}

function get_alternate_img($section, $side)
{
	$column_classes = $side === "left" ? '' : ' order-2 order-md-2 order-lg-1';
	$img_classes = $side === "right" ? ' transform-355' : ' transform-1';

	//    <div class="position-relative ms-md-5 mb-0 mb-md-7 mb-lg-0 d-none d-md-block d-lg-block d-xl-block h-75">
	//    <div class="w-100 h-100 bg-gradient-warning border-radius-xl position-absolute background-shape" alt=""></div>
	return '<div class="col-lg-6 col-md-8' . $column_classes . '">
                <div class="position-relative text-center">
                    <img src="' . $section['image_mobile'] . '" class="w-100 border-radius-xl mt-4  shadow ' . $img_classes . '" alt="">
                </div>
            </div>';
}

function get_alternate_content($section, $side)
{
	$text = get_alternate_text($section, $side);
	$img = get_alternate_img($section, $side);

	$content = '<div class="row gap-y-10">';

	if ($side === "left") {
		$content .= $text . $img . '</div>';
	} else {
		$content .= $img . $text . '</div>';
	}

	//    $content .=  $side === "left" ? get_alternate_text($section, $side) : get_alternate_img($section, $side);
	//    $content .=  $side === "right" ? get_alternate_img($section, $side) : get_alternate_text($section, $side);
	//    $content .= '</div>';

	return $content;
}
