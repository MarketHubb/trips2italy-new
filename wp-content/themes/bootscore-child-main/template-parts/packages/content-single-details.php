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

<?php get_template_part('template-parts/packages/content', 'includes-featured'); ?>

<?php $images = get_field('images'); ?>
<section class="py-md-5 mt-md-5">
	<div class="container-fluid px-0">
		<div class="row justify-content-center text-center">
			<div class="col-3 px-md-0"></div>
			<div class="col-12 position-relative">
				<div class="row">
					<div class="col-xl-3"></div>
					<div class="col-xl-5 col-md-8 col-12 ">
						<div class="pb-10 text-start border-radius-lg">
							<h3 class="<?php echo tw_heading_classes(); ?>">What's included</h3>
							<h3 class="<?php echo tw_callout_classes(); ?>">in this package</h3>
						</div>
					</div>
				</div>

				<!-- Included in this package -->
				<?php  ?>
				<div class="row bg-info-soft bottom-0 py-12">
					<!-- Heading -->
					<div class="row">
						<div class="col-xl-3 position-relative">
							<?php
							$used_images = [0];
							$first_image_in_gallery = get_field('images', get_the_ID())[0]['image']['url'];
							?>

							<?php if (!empty($first_image_in_gallery)) { ?>
								<img class="shadow-lg w-100 border-radius-lg border-top-start-radius-0 border-bottom-start-radius-0 start-0 position-absolute max-w-[325px] mt-n8 d-xl-block d-none" src="<?php echo $first_image_in_gallery; ?>" alt="image">
							<?php } ?>

						</div>

						<!-- Featured -->
						<div class="col-xl-9">
							<div class="row">

								<?php
								$featured = get_field('featured_includes');
								$includes = standardized_package_includes(get_field('includes'));
								$featured_includes = (is_array($featured) && count($featured) === 3) ? $featured : generateGrid($includes);

								if (count($featured_includes) >= 3) {
									get_template_part('template-parts/packages/content', 'featured-includes', $featured_includes);
								}

								?>

							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
					<img class="w-10 end-10 position-absolute mt-n6" src="<?php echo get_stylesheet_directory_uri() . '/img/pattern-points.png'; ?>
					" alt="image">

					<?php get_template_part('template-parts/packages/content', 'included', standardized_package_includes(get_field('includes'))); ?>

				</div>

				<?php $standard_includes = get_field('includes', get_the_ID()); ?>
				<!-- Output remain "includes" here -->
				<?php $remaining_includes_index = $featured && count($featured) === 3 ? 0 : 3; ?>

				<?php if (count($includes) > $remaining_includes_index) { ?>

					<div class="container-fluid pt-5 justify-content-center">
						<div class="row">
							<div class="col-xl-3"></div>
							<div class="col-xl-4 col-md-7 col-12 text-start">
							</div>
							<div class="col-xl-2 col-md-5 col-12">
								<?php
								$image_count_max = count($images) - 1;
								$remaining_includes_image = rand(0, $image_count_max);
								$used_images[] = $remaining_includes_index;
								//echo '<img src="' . $images[$remaining_includes_image]['image']['url'] . '" class="rounded-1 shadow" />';
								?>
								<img class="w-100  shadow-lg rounded right-0 position-absolute max-w-[325px] mt-n8 d-xl-block d-none" src="<?php echo $images[$remaining_includes_image]['image']['url']; ?>" alt="image">
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<?php echo tw_section_open(); ?>
<div class="max-w-7xl mx-auto">
	<!-- 	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<h3 class="text-xl lg:text-3xl tracking-normal">
					Your trip itinerary
				</h3>
				<hr class="horizontal dark mb-4">
 -->
	<?php
	$panel_args = [
		'item_div_classes' => ' bg-white shadow-lg flex flex-col lg:gap-x-4 lg:h-full overflow-hidden rounded-xl transition-all duration-300 ease-in-out transform ',
		'item_img_classes' => ' relative h-full w-auto z-10 object-cover rounded shadow-sm ',
		'item_description_classes' => ' text-gray-500 text-base lg:pl-0 pb-4 leading-6 '
	];
	$itinerary = get_field('itinerary');
	$i = 1;

	foreach ($itinerary as $key => $day) {
		$day_description = explode(":", $day['day']);

		if (count($day_description) > 1) {
			$itinerary[$key]['heading'] = 'Day ' . $i;
			$itinerary[$key]['subheading'] = ucfirst(strtolower(trim($day_description[1])));
		}

		if (empty($itinerary[$key]['image'])) {
			$itinerary_image_index = getRandomImageIndex(count($images), $used_images);

			if ($itinerary_image_index && $images[$itinerary_image_index]['image']['url']) {
				$used_images[] = $itinerary_image_index;
			}

			$itinerary[$key]['image']['url'] = $images[$itinerary_image_index]['image']['url'];
		}
		$i++;
	}
	$panel_args['content'] = $itinerary;
	echo get_scroll_panels($panel_args);
	?>

	<?php if (have_rows('itinerary')) : ?>
		<?php while (have_rows('itinerary')) : the_row(); ?>

			<div class="row">
				<div class="col-sm-2 col-3">
					<?php
					$itinerary_image_index = getRandomImageIndex(count($images), $used_images);
					if ($itinerary_image_index && $images[$itinerary_image_index]['image']['url']) {
						$used_images[] = $itinerary_image_index;
						echo '<img class="img w-100 border-radius-lg shadow-lg" src="' . $images[$itinerary_image_index]['image']['url'] . '" alt="curved11">';
					}
					?>
				</div>
				<div class="col-sm-10 col-9 my-auto">
					<h5>
						<a href="javascript:;" class="text-dark font-weight-bold">
							<?php echo get_sub_field('day'); ?>
						</a>
					</h5>
					<p class="text-sm">
						<?php echo get_sub_field('description'); ?>
					</p>
				</div>
				<!-- <hr class="horizontal dark my-4"> -->
			</div>
		<?php endwhile; ?>
	<?php endif; ?>

	<!-- 			</div>
		</div> -->
</div>
</section>