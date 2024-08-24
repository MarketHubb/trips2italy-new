<?php echo tw_section_open(); ?>

<?php echo tw_container_open(); ?>

<div class="grid grid-cols-3 gap-4">

	<?php $packages = get_posts_package(); ?>

	<?php if (!empty($packages)) { ?>

		<?php foreach ($packages as $package) { ?>

			<div class="grid grid-cols-1 w-full h-full p-4 rounded ring-1 ring-gray-200 shadow">
				<div class="h-72">
					<img src="<?php echo get_field('featured_image', $package->ID)['url']; ?>" alt="" class="h-full w-full rounded object-cover object-center">
				</div>
				<div class="grid grid-cols-1 h-full content-between pt-6 pb-4">
					<div>
						<h4 class="leading-6 text-blueGray text-lg lg:text-2xl mb-4 tracking-normal">
							<?php
							$title_raw = get_the_title($package->ID);
							$title_array = explode("|", $title_raw);

							if (count($title_array) === 2) {
								echo trim($title_array[0]);
							} else {
								echo trim($title_raw);
							}
							?>
						</h4>
					</div>
					<div class="">
						<a class="font-semibold antialiased text-brand hover:underline" href="<?php echo get_permalink($package->ID); ?>">View Package Details <span aria-hidden="true">→</span></a>
					</div>
				</div>
				<!-- </div> -->
			</div>

		<?php } ?>

	<?php } ?>
</div>

<?php echo tw_container_and_section_close(); ?>