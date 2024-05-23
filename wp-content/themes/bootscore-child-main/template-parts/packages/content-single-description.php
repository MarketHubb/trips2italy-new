<!-- Package::Description -->
<?php $package_description = get_query_var($package_description_copy); ?>
<section class="pb-md-5">
	<div class="container packages-content">
		<div class="row">
			<div class="card mt-4 border-light shadow-lg text-white bg-gradient-dark">
				<div class="card-body p-lg-5">
					<div class="row align-items-start">
						<div class="col-lg-8">
							<?php if (get_field('description')) { ?>
								<h3 class="text-white">Package Description:</h3>
								<p class="lead"><?php echo $package_description; ?></p>
							<?php } ?>
						</div>
						<div class="col-lg-4">
							<div class="card-body text-white text-center">
								<h6 class="mt-sm-4 mt-0 mb-0 text-white">Starting at just</h6>
								<p class="mt-0 text-white fs-2 fw-semibold">
									<small><?php echo get_field('price', $post->ID) ?></small>
								</p>
								<button data-type="Form" data-target="form" class="btn bg-orange btn-lg mt-2" role="button">Talk to Us
								</button>
								<p class="text-sm">Like to change something?<br>
									<strong>Our packages are 100% customizable</strong>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>