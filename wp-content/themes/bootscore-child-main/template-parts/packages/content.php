<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$packages_query = paginated_post_query('package', $paged);
?>

<?php echo tw_section_open(['id' => 'posts-container', 'grid_classes' => 'px-6 lg:px-0 py-16 md:py-24 relative bg-gray-100']); ?>

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
		'grid' => ' grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8 divide-y divide-y-gray-50 lg:divide-y-0 pb-10 px-6 ',
		'heading' => ' mt-6 mb-4 ',
		'description' => ' line-clamp-3 text-gray-600 group-hover:text-gray-700 text-base ',
		'copy_container' => ' rounded-md px-4 pt-5 pb-8 bg-white ',
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
		// $title_heading = '<span class="text-brand-700 block font-heading text-lg md:text-xl font-semibold antialiased tracking-normal mb-3">';
		$title_heading = '<span class="text-[1.15rem] sm:text-[1.25rem] md:text-[1.6rem] tracking-wide leading-6 word-spacing-wide wide font-semibold antialiased stylized text-secondary-500 mb-2 inline-block">';

		$split_number = count($title) <= 4 ? 2 : 3;

		for ($i = 0; $i < $split_number; ++$i) {
			$title_heading .= $title[$i] . ' ';
		}

		// $title_heading .= '</span><span class="text-[1.25rem] sm:text-[1.5rem] md:text-[1.75rem] tracking-wide leading-6 word-spacing-wide wide font-semibold antialiased stylized text-secondary-500">';
		$title_heading .= '</span><span class="text-brand-700 block font-heading text-lg md:text-xl font-semibold antialiased tracking-tight mb-3">';

		for ($i = $split_number; $i <= count($title); ++$i) {
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

<?php
$current_page = max(1, get_query_var('paged'));
$total_pages = $packages_query->max_num_pages;
$posts_per_page = get_option('posts_per_page');
$total_posts = $packages_query->found_posts;
$start_post = (($current_page - 1) * $posts_per_page) + 1;
$end_post = min($current_page * $posts_per_page, $total_posts);

$prev_link = get_previous_posts_link('Previous');
$next_link = get_next_posts_link('Next', $total_pages);

$prev_link = $prev_link ? add_anchor_to_pagination_link($prev_link) : '';
$next_link = $next_link ? add_anchor_to_pagination_link($next_link) : '';

$pagination_args = array(
	'total' => $total_pages,
	'current' => $current_page,
	'prev_text' => __('&laquo; Previous'),
	'next_text' => __('Next &raquo;'),
	'type' => 'array'
);

$pagination_links = paginate_links($pagination_args);
?>

<div class="flex items-center justify-between border-t border-gray-200 px-4 py-3 sm:px-6">
	<div class="flex flex-1 justify-between sm:hidden">
		<?php if ($prev_link): ?>
			<?php echo str_replace('Previous', '<span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</span>', $prev_link); ?>
		<?php endif; ?>
		<?php if ($next_link): ?>
			<?php echo str_replace('Next', '<span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</span>', $next_link); ?>
		<?php endif; ?>
	</div>
	<div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between mt-4">
		<div>
			<p class="text-sm text-gray-700">
				Showing
				<span class="font-medium"><?php echo $start_post; ?></span>
				to
				<span class="font-medium"><?php echo $end_post; ?></span>
				of
				<span class="font-medium"><?php echo $total_posts; ?></span>
				results
			</p>
		</div>
		<div>
			<nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
				<?php if ($prev_link): ?>
					<?php echo str_replace(
						'Previous',
						'<span class="sr-only">Previous</span><svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" /></svg>',
						preg_replace('/<a /', '<a class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-400 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" ', $prev_link)
					); ?>
				<?php endif; ?>

				<?php
				if ($pagination_links) {
					foreach ($pagination_links as $link) {
						if (strpos($link, 'current') !== false) {
							echo str_replace('class="', 'class="relative z-10 inline-flex items-center bg-brand-500 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-500 ', $link);
						} else {
							echo str_replace('class="', 'class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-400 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 ', $link);
						}
					}
				}
				?>

				<?php if ($next_link): ?>
					<?php echo str_replace(
						'Next',
						'<span class="sr-only">Next</span><svg class="h-5 w-5 fill-gray-400" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>',
						preg_replace('/<a /', '<a class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-400 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" ', $next_link)
					); ?>
				<?php endif; ?>
			</nav>
		</div>
	</div>
</div>



<?php echo tw_container_and_section_close(); ?>