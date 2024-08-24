<?php $related_packages = get_related_packages_by_trip_type(get_the_ID()); ?>

<?php if ($related_packages) { ?>

	<?php echo tw_section_open(); ?>

	<?php echo tw_container_open(); ?>

	<!-- 	<section class="py-16 md:py-24">
		<div class="container">

			<div class="row">
				<div class="row justify-content-center text-center my-sm-5">
 -->
	<?php
	$type_singular = remove_s_from_end_of_string(get_the_title($post->ID));

	$section_heading = [
		'heading' => $type_singular . ' packages we\'ve crafted',
		'subheading' => 'for our clients',
		'description' => 'Curious about what a custom itinerary from Trips 2 Italy is like? Explore these ' . $type_singular . ' packages to see what we do.'
	];
	?>
	<?php echo tw_section_heading($section_heading); ?>

	</div>
	</div>
	</div>

	<div class="container">
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-x-8 gap-y-8">

			<?php
			$related_packages = get_related_packages_by_trip_type(get_the_ID());

			if ($related_packages) {
				$related = '';

				foreach ($related_packages as $package) {
					if (get_field('featured_image', $package->ID)) {
						$related .= '<div class="p-6">
                                <div class="card card-blog card-plain h-100 package-cards">
                                <div class="position-relative">
                                <a class="d-block blur-shadow-image">';
						$related .= '<img src="' . get_field('featured_image', $package->ID)['url'] . '" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">';
						$related .= '</a></div>';
						$related .= '<div class="card-body px-1 pt-3 d-flex flex-column">';
						$related .= '<p class="text-gradient text-dark mb-2 text-sm">';
						$related .= 'Starting at: ' . get_field('price', $package->ID) . '</p>';

						$related .= '<a href="javascript:;">';
						$related .= '<h5>' . get_the_title($package->ID) . '</h5>';
						$related .= '</a>';
						$related .= '<p class="clamp-4">' . get_field('description', $package->ID) . '</p>';
						$related .= '<div class="mt-auto">';

						// Don't display links on travels (PPC) pages
						if (!str_contains(get_home_url(), "travels.")) {
							$related .= '<a href="' . get_permalink($package->ID) . '" type="button" class="btn btn-outline-primary btn-sm stretched-link">View Package Details</a>';
						}

						$related .= '</div>';
						$related .= '</div></div></div>';
					}
				}

				echo $related;
			}

			?>

			<?php tw_container_and_section_close(); ?>

		<?php } ?>