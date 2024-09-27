<div class="py-24 sm:py-32 ">
	<div class="mx-auto max-w-7xl px-6 lg:px-8">
		<div class="mx-auto max-w-2xl lg:text-center">
			<h2 class="stylized text-xl sm:text-2xl lg:text-3xl font-semibold leading-7 text-brand-500">What's included</h2>
			<?php
			$day_count_field = get_field('itinerary');
			$day_count = !empty($day_count_field) ? count($day_count_field) . '-day ' : '';
			?>
			<p class="mt-2 text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">
				In this <?php echo $day_count; ?> package
			</p>
			<p class="mt-6 text-lg leading-8 text-gray-600">
				<?php
				$package_description_split = get_package_description(get_the_ID());
				if (!empty($package_description_split) && !empty($package_description_split[1])) {
					// echo $package_description_split[1];
				}
				?>
			</p>
		</div>
		<div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
			<dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">

				<?php if (have_rows('featured_includes')): ?>
					<?php while (have_rows('featured_includes')) : the_row(); ?>


						<div class="flex flex-col justify-center mx-auto">
							<dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900 relative">
								<?php if (get_sub_field('icon')) { ?>
									<div class="inline md:absolute md:-left-10 text-brand-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
										<i class="<?php echo get_sub_field('icon'); ?> fa-xl fa-light"></i>
									</div>
								<?php } ?>

								<span class="text-brand-700 tracking-tight text-xl md:text-2xl"><?php echo ucwords(get_sub_field('callout')); ?></span>
							</dt>
							<dd class="mt-4 flex flex-auto flex-col text-lg leading-7 text-gray-600">
								<p class="flex-auto text-xl"><?php echo ucfirst(get_sub_field('description')); ?></p>
							</dd>
						</div>

					<?php endwhile; ?>
				<?php endif; ?>

			</dl>
		</div>
	</div>
</div>

<div class="bg-white py-24 sm:py-32 hidden">
	<div class="mx-auto max-w-7xl px-6 lg:px-8">
		<div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
			<div>
				<h2 class="text-base font-semibold leading-7 text-indigo-600">Everything you need</h2>
				<p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">All-in-one platform</p>
				<p class="mt-6 text-base leading-7 text-gray-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.</p>
			</div>
			
			<dl class="col-span-2 grid grid-cols-1 gap-x-8 gap-y-10 text-base leading-7 text-gray-600 lg:gap-y-16">

				<?php if (have_rows('featured_includes')): ?>
					<?php while (have_rows('featured_includes')) : the_row(); ?>

						<div class="relative pl-9">
							<dt class="font-semibold text-gray-900">
								<svg class="absolute left-0 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
								</svg>
								<?php echo get_sub_field('callout'); ?>
							</dt>
							<dd class="mt-2"><?php echo get_sub_field('description'); ?></dd>
						</div>

					<?php endwhile; ?>
				<?php endif; ?>

				<div class="relative pl-9">
					<dt class="font-semibold text-gray-900">
						<svg class="absolute left-0 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
						</svg>
						Invite team members
					</dt>
					<dd class="mt-2">Rerum repellat labore necessitatibus reprehenderit molestiae praesentium.</dd>
				</div>
				<div class="relative pl-9">
					<dt class="font-semibold text-gray-900">
						<svg class="absolute left-0 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
						</svg>
						List view
					</dt>
					<dd class="mt-2">Corporis asperiores ea nulla temporibus asperiores non tempore assumenda aut.</dd>
				</div>
				<div class="relative pl-9">
					<dt class="font-semibold text-gray-900">
						<svg class="absolute left-0 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
						</svg>
						Keyboard shortcuts
					</dt>
					<dd class="mt-2">In sit qui aliquid deleniti et. Ad nobis sunt omnis. Quo sapiente dicta laboriosam.</dd>
				</div>
				<div class="relative pl-9">
					<dt class="font-semibold text-gray-900">
						<svg class="absolute left-0 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
						</svg>
						Calendars
					</dt>
					<dd class="mt-2">Sed rerum sunt dignissimos ullam. Iusto iure occaecati voluptate eligendi fugiat sequi.</dd>
				</div>
				<div class="relative pl-9">
					<dt class="font-semibold text-gray-900">
						<svg class="absolute left-0 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
						</svg>
						Notifications
					</dt>
					<dd class="mt-2">Quos inventore harum enim nesciunt. Aut repellat rerum omnis adipisci.</dd>
				</div>
				<div class="relative pl-9">
					<dt class="font-semibold text-gray-900">
						<svg class="absolute left-0 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
						</svg>
						Boards
					</dt>
					<dd class="mt-2">Quae sit sunt excepturi fugit veniam voluptatem ipsum commodi.</dd>
				</div>
				<div class="relative pl-9">
					<dt class="font-semibold text-gray-900">
						<svg class="absolute left-0 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
						</svg>
						Reporting
					</dt>
					<dd class="mt-2">Eos laudantium repellat sed architecto earum unde incidunt. Illum sit dolores voluptatem.</dd>
				</div>
				<div class="relative pl-9">
					<dt class="font-semibold text-gray-900">
						<svg class="absolute left-0 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
						</svg>
						Mobile app
					</dt>
					<dd class="mt-2">Nulla est saepe accusamus nostrum est est. Fugit voluptatum omnis quidem voluptatem.</dd>
				</div>
			</dl>
		</div>
	</div>
</div>