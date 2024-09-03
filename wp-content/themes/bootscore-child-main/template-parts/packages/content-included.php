<!-- Also included -->
<div class="max-w-7xl mx-auto py-12">
	<div class="grid grid-cols-1 w-full">
		<div class="p-8 sm:p-10 lg:flex-auto">
			<div class=" flex items-center gap-x-4">
				<h4 class="flex-none stylized inline-block font-normal text-2xl lg:text-4xl text-secondary-500">Plus:</h4>
				<div class="h-px flex-auto bg-gray-600/10"></div>
			</div>
			<ul role="list" class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm leading-6 text-gray-600 sm:gap-6">

				<?php foreach ($args as $include) { ?>

					<li class="flex gap-x-3">
						<svg class="h-7 w-6 flex-none text-brand-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
						</svg>
						<span class="text-gray-900 text-base lg:text-lg"><?php echo $include['item']; ?></span>
					</li>

				<?php } ?>
			</ul>
		</div>
	</div>
</div>
