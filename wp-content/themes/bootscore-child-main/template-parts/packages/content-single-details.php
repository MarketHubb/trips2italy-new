<?php $images = get_field('images'); ?>
<section class="py-md-5 mt-md-5">
	<div class="container-fluid px-0">
		<div class="row justify-content-center text-center">
			<div class="col-3 px-md-0"></div>
			<div class="col-12 position-relative">
				<div class="row">
					<div class="col-xl-3"></div>
					<div class="col-xl-5 col-md-8 col-12 text-start">
						<div class="p-3 text-start border-radius-lg">
							<h3>What's included in this package</h3>
							<p class="text-dark text-lg mt-3">
								<span class="font-weight-bold"></span>
							</p>
						</div>
					</div>
				</div>
				<div class="row bg-info-soft bottom-0">
					<div class="row">
						<div class="col-xl-3 position-relative">
							<?php
							$used_images = [0];
							$first_image_in_gallery = get_field('images', get_the_ID())[0]['image']['url'];

							if (!empty($first_image_in_gallery)) { ?>

								<img class="w-100 border-radius-lg border-top-start-radius-0 border-bottom-start-radius-0 start-0 position-absolute max-width-300 mt-n8 d-xl-block d-none" src="<?php echo $first_image_in_gallery; ?>" alt="image">

							<?php } ?>

						</div>
						<div class="col-xl-9">
							<div class="row">

								<?php
								$featured = get_field('featured_includes');
								$includes = clean_includes_excludes(get_field('includes'));
								$featured_includes = (isset($featured) && count($featured) === 3) ? $featured : generateGrid($includes);

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
				</div>
				<!-- Output remain "includes" here -->
				<?php $remaining_includes_index = $featured && count($featured) === 3 ? 0 : 3; ?>
				<?php if (count($includes) > $remaining_includes_index) { ?>
					<div class="container-fluid pt-5 justify-content-center">
						<div class="row">
							<div class="col-xl-3"></div>
							<div class="col-xl-4 col-md-7 col-12 text-start">
								<h4 class="">Plus:</h4>
								<ul class="mb-4">
									<?php
									$includes_li = '';
									for ($i = $remaining_includes_index; $i < count($includes); $i++) {
										$includes_li .= '<li class="align-items-center py-2 d-flex gap-3">';
										$includes_li .= '<div class="icon remaining-list-check-bg icon-shape rounded-circle bg-gradient-info shadow text-center">';
										$includes_li .= '<i class="fa-solid fa-check"></i>';
										$includes_li .= '</div>';
										$includes_li .= '<p class="mb-0 color-heading fw-semibold">' . $includes[$i]['item'] . '</p></li>';
									}
									echo $includes_li;
									?>
								</ul>
							</div>
							<div class="col-xl-2 col-md-5 col-12">
								<?php
								$image_count_max = count($images) - 1;
								$remaining_includes_image = rand(0, $image_count_max);
								$used_images[] = $remaining_includes_index;
								echo '<img src="' . $images[$remaining_includes_image]['image']['url'] . '" class="rounded-1 shadow" />';
								?>

							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php
		$gallery_photos = [];

		foreach ($images as $image) {
			$gallery_photos[] = [
				'src' => $image['image']['url'],
				'caption' => $image['image']['description']
			];
		}

		// echo outputGalleryLightbox($gallery_photos);


		?>

	</div>
</section>

<section class="py-md-5 pb-5 position-relative">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<h3 class="fw-bolder">
					Your trip itinerary
				</h3>
				<hr class="horizontal dark mb-4">

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
								<div class="buttons justify-content-center d-none">
									<a href="javascript:;" class="btn btn-sm btn-rounded btn-dark btn-icon-only pt-1 mb-0" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Play episode" data-bs-original-title="Play episode">
										<i class="fa fa-play" aria-hidden="true"></i>
									</a>
									<span class="font-weight-bold text-sm ms-2">2h 13min</span>
								</div>
							</div>
							<hr class="horizontal dark my-4">
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

			</div>
			<div class="col-lg-3 align-content-start">
				<!-- <div class="position-sticky top-2"> -->
				<div class="top-2">
					<div class="d-none">
						<h4>
							About
						</h4>
						<p>
							There’s nothing I really wanted to do in life that I wasn’t able to
							get good at. That’s my skill.
						</p>
						<div class="d-flex">
							<span class="badge badge-primary me-2">UI/UX</span>
							<span class="badge badge-primary">Design</span>
						</div>
						<div class="bg-light p-2 border-radius-lg mt-4 w-lg-100 w-sm-50">
							<div class="row">
								<div class="col-3">
									<div class="position-relative">
										<img class="img w-100 border-radius-md shadow-lg" src="../assets/img/podcast/episode-3.jpeg" alt="curved11">
										<span class="mask bg-gradient-dark border-radius-md position-absolute top-0 start-0 d-flex align-items-center justify-content-center">
											<i class="fa fa-play text-white" aria-hidden="true"></i>
										</span>
									</div>
								</div>
								<div class="col-9 ps-0 my-auto">
									<h6 class="text-sm mb-0">Enter the UI/UX Design World.</h6>
									<span class="badge badge-sm badge-dark">Trailer</span>
								</div>
							</div>
						</div>
					</div>
					<div class="d-flex flex-column">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>