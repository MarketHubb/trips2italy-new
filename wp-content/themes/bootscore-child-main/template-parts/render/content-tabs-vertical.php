<?php if (empty($args)) return ''; ?>

<!-- Features -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="relative p-6 md:p-16">
        <!-- Grid -->
        <div class="relative z-10 lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center">
            <div class="mb-10 lg:mb-0 lg:col-span-6 lg:col-start-8 lg:order-2">
                <?php if (!empty($args['heading']['heading_heading'])) : ?>
                    <h2 class="text-2xl text-gray-800 font-bold sm:text-3xl">
                        <?php echo esc_html($args['heading']['heading_heading']); ?>
                    </h2>
                <?php endif; ?>

                <!-- Tab Navs -->
                <nav class="grid gap-4 mt-5 md:mt-10" aria-label="Tabs" role="tablist" aria-orientation="vertical">
                    <?php 
                    if (!empty($args['content']['content_feature_panels'])) :
                        foreach ($args['content']['content_feature_panels'] as $index => $panel) :
                            $isActive = $index === 0;
                            $tabId = "tabs-with-card-item-" . ($index + 1);
                            $panelId = "tabs-with-card-" . ($index + 1);
                    ?>
                        <button type="button" 
                                class="hs-tab-active:bg-white hs-tab-active:shadow-md hs-tab-active:hover:border-transparent text-start hover:bg-gray-200 focus:outline-none focus:bg-gray-200 p-4 md:p-5 rounded-xl <?php echo $isActive ? 'active' : ''; ?>" 
                                id="<?php echo esc_attr($tabId); ?>" 
                                aria-selected="<?php echo $isActive ? 'true' : 'false'; ?>" 
                                data-hs-tab="#<?php echo esc_attr($panelId); ?>" 
                                aria-controls="<?php echo esc_attr($panelId); ?>" 
                                role="tab">
                            <span class="flex gap-x-6">
                                <?php if (!empty($panel['icon']['url'])) : ?>
                                    <img src="<?php echo esc_url($panel['icon']['url']); ?>" 
                                         alt="" 
                                         class="shrink-0 mt-2 size-6 md:size-7 hs-tab-active:text-blue-600 text-gray-800">
                                <?php endif; ?>
                                <span class="grow">
                                    <span class="block text-lg font-semibold hs-tab-active:text-blue-600 text-gray-800">
                                        <?php echo esc_html($panel['heading']); ?>
                                    </span>
                                    <?php if (!empty($panel['description'])) : ?>
                                        <span class="block mt-1 text-gray-800">
                                            <?php echo esc_html($panel['description']); ?>
                                        </span>
                                    <?php endif; ?>
                                </span>
                            </span>
                        </button>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </nav>
                <!-- End Tab Navs -->
            </div>
            <!-- End Col -->

            <div class="lg:col-span-6">
                <div class="relative">
                    <!-- Tab Content -->
                    <div>
                        <?php 
                        if (!empty($args['content']['content_feature_panels'])) :
                            foreach ($args['content']['content_feature_panels'] as $index => $panel) :
                                $isActive = $index === 0;
                                $panelId = "tabs-with-card-" . ($index + 1);
                        ?>
                            <div id="<?php echo esc_attr($panelId); ?>" 
                                 role="tabpanel" 
                                 aria-labelledby="<?php echo esc_attr("tabs-with-card-item-" . ($index + 1)); ?>"
                                 <?php echo !$isActive ? 'class="hidden"' : ''; ?>>
                                <?php if (!empty($panel['image']['url'])) : ?>
                                    <img class="shadow-xl shadow-gray-200 rounded-xl" 
                                         src="<?php echo esc_url($panel['image']['url']); ?>" 
                                         alt="<?php echo esc_attr($panel['heading']); ?>">
                                <?php endif; ?>
                            </div>
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </div>
                    <!-- End Tab Content -->

                    <!-- SVG Element -->
                    <div class="hidden absolute top-0 end-0 translate-x-20 md:block lg:translate-x-20">
                        <svg class="w-16 h-auto text-orange-500" width="121" height="135" viewBox="0 0 121 135" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 16.4754C11.7688 27.4499 21.2452 57.3224 5 89.0164" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                            <path d="M33.6761 112.104C44.6984 98.1239 74.2618 57.6776 83.4821 5" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                            <path d="M50.5525 130C68.2064 127.495 110.731 117.541 116 78.0874" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                        </svg>
                    </div>
                    <!-- End SVG Element -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Grid -->

        <!-- Background Color -->
        <div class="absolute inset-0 grid grid-cols-12 size-full">
            <div class="col-span-full lg:col-span-7 lg:col-start-6 bg-gray-100 w-full h-5/6 rounded-xl sm:h-3/4 lg:h-full"></div>
        </div>
        <!-- End Background Color -->
    </div>
</div>
<!-- End Features -->
