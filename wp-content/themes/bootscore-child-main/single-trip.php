<?php
get_header();
$post_id = get_the_ID();
$id = get_field('page_id', $post->ID);
?>

<!-- Testimonials -->
<?php
$review_ids = get_review_posts_for_trip_type($post_id);

if (count($review_ids) > 2) {
	$testimonial_args = [
		'post_id' => $post_id,
		'id' => 'testimonials',
		'content' => $review_ids
	];

	get_template_part('template-parts/tw/content', 'testimonials', $testimonial_args);
}
?>

<!-- What's included (panels) -->
<?php
$section_image = get_field('global_features_bg_image', 'option')['url'];
$section_style = !empty($section_image) ? 'background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4)), url(' . $section_image . ');' : null;

$panel_args = [
	'post_id' => $post_id,
	'id' => 'included',
	'section' => [
		'grid_classes' => ' md:px-6 lg:px-0 py-16 md:py-24 relative ',
		'classes' => ' flex items-center py-16 md:py-32 bg-gradient-overlay bg-bottom bg-cover bg-no-repeat ',
		'overlay_classes' => ' bg-gradient-to-b from-gray-900 from-[1%] h-full w-full ',
		'style' => $section_style
	],
	'heading' => [
		'field_name' => 'included',
		'container_classes' => ' px-8 pb-10 z-10 relative sm:block sm:pb-12 text-2xl md:text-2xl lg:text-3xl ',
		'background_color' => 'dark'
	],
	'content' => [
		'field_name' => 'trip_features',
		'key' => 'featured',
		'output_function' => 'get_why_us_panels'
	],
	'cta' => [
		'copy' => 'Plan our Italy honeymoon',
		'callout' => 'An unforgettable honeymoon, planned entirely for you'
	]
];

get_template_part('template-parts/shared/content', 'panels', $panel_args); ?>

<!-- Why (Trips 2 Italy) -->
<?php
$steps = [
	'post_id' => $post_id,
	'id' => 'why',
	'section' => [],
	'heading' => [
		'field_name' => 'why',
		'align' => 'left',
	],
	'content' =>  [
		'field_name' => 'why_us',
	]
];

get_template_part('template-parts/preline/content', 'features-steps', $steps);
?>

<!-- CTA simple (centered) -->
<?php
$bg_image = get_home_url() . '/wp-content/uploads/2022/12/Lombardo-1.jpg';
$heading  = '<span class="block mb-2">Your Italian ' . format_trip_type_heading(get_the_title(get_the_ID())) . '</span>';
$heading .= '<span class="font-semibold stylized capitalize text-[150%] text-secondary-400">Starts Right Here</span>';
$descripion = "Tell us what you'd like to do and see, and our Italian-born travel experts will handle the rest.";
$content = '<a href="' . get_cta_href() . '" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-brand-600 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Get started today</a>';


$cta_args = [
	'post_id' => $post_id,
	'id' => 'cta',
	'section' => [
		'bg_position' => 'bg-bottom'
	],
	'heading' => [],
	'content' => [
		'field_name' => 'cta',
	],
	'cta' => [
		'copy' => 'Design our dream honeymoon',
	]
];
get_template_part('template-parts/tw-shared/content', 'cta-centered-simple', $cta_args);
?>

<?php //get_template_part('template-parts/trips/content', 'why'); 
?>

<!-- Other trip types -->

<?php
$vertical_tabs_content = [];
$vertical_tabs_field_content = get_field('feature_panels');

foreach ($vertical_tabs_field_content['feature_panels'] as $content) {
	$vertical_tabs_content[] = [
		'heading' => $content['heading'],
		'description' => $content['description'],
		'image' => $content['image']['url'],
		'icon' => $content['icon']['url'],
	];
}

$vertical_tabs = [
	'post_id' => $post_id,
	'id' => 'how',
	'section' => [],
	'heading' => [
		'field_name' => 'trips',
	],
	'content' =>  [
		'fields' =>	$vertical_tabs_content
	],
	'cta' => [
		'copy' => 'Craft our perfect trip',
		'callout' => 'Take a one-of-a-kind, romantic getaway to Italy'
	]
];

// get_template_part('template-parts/preline/content', 'vertical-tabs', $vertical_tabs);

get_template_part('template-parts/tw-shared/content', 'features-image-top', $vertical_tabs);
?>

<!-- Stats -->
<?php
$stat_callouts = [
	'post_id' => $post_id,
	'id' => 'stats',
	'section' => [
		'image' => get_home_url() . '/wp-content/uploads/2023/05/Florence.jpeg',
		'classes' => ' bg-center bg-cover '
	],
	'heading' => [
		'field_name' => 'stats',
		'align' => 'center',
		'background_color' => 'dark'
	],
	'content' =>  [
		'field_name' => 'stat_callouts',
		'key' => 'stats'
	]
];

get_template_part('template-parts/shared/content', 'callouts', $stat_callouts); ?>



<!-- Why more people choose -->
<?php //get_template_part('template-parts/trips/content', 'choose'); 
?>
<?php //get_template_part('template-parts/preline/content', 'features-image-top'); 
?>

<?php
if (get_field('itinerary')) {
	$itinerary = [
		'post_id' => $post_id,
		'id' => 'itinerary',
		'section' => [
			'classes' => ' px-6 lg:px-0 py-16 md:py-24 relative bg-gray-50 ',
		],
		'heading' => [
			'field_name' => 'itineraries',
			'align' => 'center',
		],
		'content' =>  [
			'field_name' => 'itinerary_id'
		],
		'cta' => [
			'copy' => 'Get your custom itinerary',
			'callout' => ''
		]
	];
	get_template_part('template-parts/top/timeline', '', $itinerary);
}
?>

<!-- Packages -->
<?php
$related_packages = get_field('related_packages', get_the_ID());
$package_content = [];
if ($related_packages && !empty($related_packages)) {

	$packages_args =  [
		'heading' => tw_output_section_heading($heading_args),
		'section_classes' => ' px-6 lg:px-0 py-16 md:py-24 relative bg-brand-700 ',
		'section_overlay_classes' => ' absolute inset-0 h-full w-full object-cover bg-no-repeat object-center opacity-20 ',
		'section_image' => get_home_url() . '/wp-content/uploads/2023/01/Naples-desktop-scaled.webp'
	];

	foreach ($related_packages as $related_package) {
		$package_content[] = get_data_for_package_post($related_package->ID);
	}

	if (!empty($content)) {
		$packages_args = [
			'post_id' => $post_id,
			'id' => 'packages',
			'section' => [],
			'heading' => [
				'field_name' => 'package',
				'align' => 'center',
			],
			'content' =>  [
				'fields' => $package_content
			]
		];

		get_template_part('template-parts/preline/content', 'post-list', $packages_args);
	}
}
?>


<?php get_footer(); ?>