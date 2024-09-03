<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$post_count = get_query_var('paginated_post_count');
$packages_query = query_posts_package($paged);
?>

<?php echo tw_section_open(['id' => 'posts-container']); ?>

<?php echo tw_container_open(); ?>

<?php if ($paged >= 1) { ?>

	<div class="flex flex-row justify-between relative bottom-4">
		<div class="">
			<p class="text-gray-700">
				Total Packages: <?php echo $packages_query->found_posts; ?>
			</p>

		</div>
		<div class="">
			<p class="text-gray-700">
				Page <?php echo $paged; ?> of <?php echo $packages_query->max_num_pages; ?>
			</p>

		</div>
	</div>

<?php } ?>

<?php

$content_fields = [
	'badges' => true,
	'classes' => [
		'grid' => ' grid grid-cols-1 gap-x-6 gap-y-12 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-10 divide-y divide-y-gray-50 lg:divide-y-0 pb-10 ',
		'heading' => ' mt-6 mb-4 ',
		'description' => ' line-clamp-3 text-gray-600 group-hover:text-gray-700 text-base ',
	]
];
?>

<?php if ($packages_query->have_posts()) : ?>

	<?php while ($packages_query->have_posts()) : $packages_query->the_post(); ?>

		<?php
		$title_raw = get_the_title();
		$title_raw_array = explode("|", $title_raw);
		$title = count($title_raw_array) === 2 ? trim($title_raw_array[0]) : $title = trim($title_raw);
		$title = explode(" ", $title);
		$title_heading = '<span class="text-brand-700 block font-heading text-lg md:text-xl font-semibold antialiased tracking-normal mb-3">';

		for ($i = 0; $i < 3; ++$i) {
			$title_heading .= $title[$i] . ' ';
		}

		$title_heading .= '</span><span class="text-[1.25rem] sm:text-[1.5rem] md:text-[1.75rem] tracking-wide leading-6 word-spacing-wide wide font-semibold antialiased stylized text-secondary-500">';

		for ($i = 3; $i <= count($title); ++$i) {
			$title_heading .= ' ' . $title[$i];
		}

		$title_heading .= '</span>';

		$package_description = get_field('description');
		$package_description_split = splitParagraph($package_description);
		$description = (isset($package_description_split) && !empty($package_description_split['0'])) ? return_portion_of_string($package_description_split[0], 90) : null;

		$content_fields['content'][] = [
			'link' => get_permalink($post->ID),
			'badges' => get_term_badges_for_package($post->ID),
			'heading' => $title_heading,
			'image' => get_field('featured_image')['url'],
			'description' => $description
		];

		?>

	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>

<?php
if (!empty($content_fields)) {
	echo get_image_grid($content_fields);
}
?>

<!-- </div> -->

<!-- Pagination and Total Packages Info -->
<div class="mt-8 flex flex-col items-center  ">
	<!-- Total Packages Info -->
	<div class="mb-4 text-gray-600">
		``
	</div>

	<!-- Next/Previous Navigation -->
	<div class="flex justify-between w-full max-w-7xl">
		<?php
		// Modify previous and next links
		$prev_link = get_previous_posts_link('← Previous');
		$next_link = get_next_posts_link('Next →', $packages_query->max_num_pages);

		$prev_link = $prev_link ? add_anchor_to_pagination_link($prev_link) : '← Previous';
		$next_link = $next_link ? add_anchor_to_pagination_link($next_link) : 'Next →';
		?>

		<div class="w-1/2 text-left">
			<span class="text-brand-500 hover:underline font-semibold"><?php echo $prev_link; ?></span>
		</div>

		<div class="w-1/2 text-right">
			<span class="text-brand-500 hover:underline font-semibold"><?php echo $next_link; ?></span>
		</div>
	</div>

	<div class="mt-4 text-gray-600">
		<?php
		$pagination_args = array(
			'total' => $packages_query->max_num_pages,
			'current' => max(1, get_query_var('paged')),
			'prev_text' => __('&laquo; Previous'),
			'next_text' => __('Next &raquo;'),
			'type' => 'array'
		);

		$pagination_links = paginate_links($pagination_args);

		if ($pagination_links) {
			echo '<div class="pagination flex justify-center space-x-2">';
			foreach ($pagination_links as $link) {
				// Add #posts-container to the href attribute and custom classes
				$modified_link = preg_replace(
					'/<a (.*?)class="(.*?)"(.*?)>/',
					'<a $1class="$2 bg-blue-500text-white my-2 rounded hover:bg-blue-600"$3>',
					$link
				);

				// If it's not a link (current page), wrap it in a span with custom classes
				if (strpos($modified_link, '<a') === false) {
					$modified_link = '<span class="text-base px-3 py-2 bg-gray-300 text-gray-800 rounded">' . $modified_link . '</span>';
				} else {
					$modified_link = '<span class="text-base px-3 py-2 bg-gray-100 text-gray-500 rounded">' . $modified_link . '</span>';
				}

				// Add #posts-container to the href attribute
				$modified_link = preg_replace('/(href=["\'])(.*?)(["\'])/', '$1$2#posts-container$3', $modified_link);

				echo $modified_link;
			}
			echo '</div>';
		}
		?>
	</div>
	<?php echo tw_container_and_section_close(); ?>