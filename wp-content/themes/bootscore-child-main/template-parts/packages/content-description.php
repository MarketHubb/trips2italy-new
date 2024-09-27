<section>
	<div class="max-w-7xl rounded-3xl relative bottom-24 mx-auto bg-gradient-to-r from-brand-800 to-brand-600 py-32 z-30 shadow-xl">
		<div class="grid grid-cols-1 md:grid-cols-3 px-6 sm:px-12">
			<div class="md:col-span-2">
				<h3 class="text-white font-semibold text-xl sm:text-2xl">Package Overview</h3>
			</div>
			<div class="md:col-span-1">
				<p>Starting at just:</p>
				<p><?php echo get_field('price', get_the_ID()); ?></p>

			</div>
		</div>
	</div>
</section>