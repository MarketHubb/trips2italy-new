<?php if (empty($args)) return; ?>

<div class="max-w-screen-xl mx-auto">
    <div class="md:flex relative md:gap-x-8">
        <div class="md:sticky md:top-[3vh] md:h-screen md:flex md:flex-col md:justify-center" data-type="heading">
            <!-- <div class="space-y-6 sm:space-y-8" data-type="heading"> -->
            <!-- Title -->
            <div class="space-y-2 md:space-y-4">
                <?php if (!empty($args['heading']['heading_heading'])): ?>
                    <h2 class="font-bold text-3xl lg:text-4xl text-gray-800 dark:text-neutral-200 pt-4">
                        <?php echo $args['heading']['heading_heading']; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($args['heading']['heading_description'])): ?>
                    <p class="text-gray-500 dark:text-neutral-500">
                        <?php echo $args['heading']['heading_description']; ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($args['heading']['header_image'])): ?>
                    <img src="<?php echo $args['heading']['header_image']['url']; ?>" class="hidden aspect-video shadow rounded-lg">
                <?php endif; ?>

            </div>
            <div class="mt-8">
                <?php if (!empty($args['heading']['header_image'])): ?>
                    <img src="<?php echo $args['heading']['header_image']['url']; ?>" class="aspect-video shadow rounded-lg">
                <?php endif; ?>
            </div>
            <!-- End Title -->

            <!-- List -->
            <ul class="space-y-2 sm:space-y-4 hidden">
                <li class="flex gap-x-3">
                    <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-800/30 dark:text-blue-500">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </span>
                    <div class="grow">
                        <span class="text-sm sm:text-base text-gray-500 dark:text-neutral-500">
                            <span class="font-bold">Easy &amp; fast</span> designing
                        </span>
                    </div>
                </li>

                <li class="flex gap-x-3">
                    <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-800/30 dark:text-blue-500">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </span>
                    <div class="grow">
                        <span class="text-sm sm:text-base text-gray-500 dark:text-neutral-500">
                            Powerful <span class="font-bold">features</span>
                        </span>
                    </div>
                </li>

                <li class="flex gap-x-3">
                    <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-800/30 dark:text-blue-500">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </span>
                    <div class="grow">
                        <span class="text-sm sm:text-base text-gray-500 dark:text-neutral-500">
                            User Experience Design
                        </span>
                    </div>
                </li>
            </ul>
            <!-- End List -->
        </div>
        <div class="max-w-2xl mx-auto" data-type="content">
            <div class="-my-6">
                <?php
                if (!empty($args['content'])) {
                    foreach ($args['content'] as $index => $item) {
                ?>
                        <div class="relative pl-8 sm:pl-32 py-6 group">
                            <!-- Purple label -->
                            <div class="font-caveat uppercase font-medium text-sm md:text-base text-brand-500 mb-1 sm:mb-0">
                                <?php echo esc_html($item['heading']); ?>
                            </div>
                            <!-- Vertical line (::before) ~ Date ~ Title ~ Circle marker (::after) -->
                            <div class="flex flex-col sm:flex-row items-start mb-1 group-last:before:hidden before:absolute before:left-2 sm:before:left-0 before:h-full before:px-px before:bg-gray-200 sm:before:ml-[6.5rem] before:self-start before:-translate-x-1/2 before:translate-y-3 after:absolute after:left-2 sm:after:left-0 after:w-2 after:h-2 after:bg-brand-500 after:border-4 after:box-content after:border-brand-100 after:rounded-full sm:after:ml-[6.5rem] after:-translate-x-1/2 after:translate-y-1.5">
                                <time class="sm:absolute left-0 translate-y-0.5 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 text-secondary-500 bg-secondary-100/50 rounded-full">
                                    Day <?php echo $index + 1; ?>
                                </time>
                                <div class="text-lg sm:text-xl md:text-3xl lg:text-3xl font-medium tracking-wider subpixel-antialiased text-slate-800 stylized">
                                    <?php echo esc_html($item['callout']); ?>
                                </div>
                            </div>
                            <!-- Content -->
                            <div class="text-slate-500">
                                <?php echo esc_html($item['description']); ?>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>