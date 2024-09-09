<?php if (!empty($args)) { ?>

	<div class="overflow-hidden bg-white py-24">
		<div class="mx-auto max-w-7xl px-6 lg:px-8">
			<div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
				<div class="lg:pr-8 lg:pt-4">
					<div class="lg:max-w-lg">

						<div class="pb-10 text-center lg:col-span-6">
							<div class="pb-12 text-left">
								<h2 class=" mb-0 md:leading-normal font-heading tracking-none text-2xl md:text-2xl lg:text-3xl  text-brand-500-700 ">What's included in</h2>
								<h2 class=" stylized font-normal text-4xl lg:text-6xl  text-brand-500 ">this package</h2>
								<div class="mt-6 md:max-w-xl  lg:max-w-[40rem]  ">
									<p class="hidden font-normal text-base sm:text-lg md:text-xl  text-gray-600 ">Say goodbye to generic trips for the masses; Experience Italy like a local with our personalized honeymoons tailored just for you.</p>
								</div>
							</div>
						</div>

						<dl class="mt-10 max-w-xl space-y-14 text-base leading-7 text-gray-600 lg:max-w-none">

							<?php foreach ($args['content'] as $fields) { ?>

								<div class="relative pl-9">
									<dt class="font-semibold text-gray-900 inline-flex items-center">
										<div class="absolute left-1 top-1 h-5 w-5 text-brand-500">
											<i class="<?php echo $fields['icon']; ?> fa-lg object-contain w-full h-auto "></i>
										</div>
										<h3 class="pl-2 stylized inline-block font-normal text-2xl lg:text-4xl  text-secondary-500 "><?php echo $fields['callout'] ?></h3>
									</dt>
									<dd class="block pl-2 mt-1">
										<p class="text-gray-700 text-base md:text-lg lg:text-lg"><?php echo $fields['description']; ?></p>
									</dd>
								</div>

							<?php } ?>

						</dl>
					</div>
				</div>
				<?php if (!empty($args['image'])) { ?>
					<img src="<?php echo $args['image']; ?>" alt="Product screenshot" class="w-full max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10  md:-ml-4 lg:-ml-0">
				<?php } ?>
			</div>
		</div>
	</div>

<?php } ?>