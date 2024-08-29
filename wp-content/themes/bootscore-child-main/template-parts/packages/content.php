<?php echo tw_section_open(); ?>

<?php echo tw_container_open(); ?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">

	<?php $packages = get_posts_package(); ?>

	<?php if (!empty($packages)) { ?>

		<?php foreach ($packages as $package) { ?>

			<div class="grid grid-cols-1 w-full h-full rounded ring-1 ring-gray-200 shadow">
				<div class="">
					<img src="<?php echo get_field('featured_image', $package->ID)['url']; ?>" alt="" class="h-[200px] w-full rounded-t object-cover object-center">
				</div>
				<div class="grid grid-cols-1 h-full px-4 py-6">
					<div>
						<h4 class="leading-6 text-blueGray text-lg md:text-xl mb-4 tracking-normal font-[600] antialiased">
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
						<?php
						$package_description = get_field('description', $package->ID);
						$package_description_split = splitParagraph($package_description);
						$description = (isset($package_description_split) && !empty($package_description_split['0'])) ? return_portion_of_string($package_description_split[0], 80) : null;
						?>
						<?php if (!empty($description)) { ?>
							<p class="text-base mb-6"><?php echo $description; ?></p>
						<?php } ?>
					</div>
					<div class="">
						<a class="font-semibold antialiased text-base text-brand hover:underline" href="<?php echo get_permalink($package->ID); ?>">View Package Details <span aria-hidden="true">→</span></a>
					</div>
				</div>
				<!-- </div> -->
			</div>

		<?php } ?>

	<?php } ?>
</div>

<?php echo tw_container_and_section_close(); ?>