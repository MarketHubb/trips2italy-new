<?php if (empty($args)) return ''; ?>

<!-- Features -->
<div class="max-w-screen-2xl px-4 sm:px-6 lg:px-8 mx-auto flex flex-col-reverse gap-y-6">
<!-- <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto flex flex-col-reverse gap-y-6"> -->
    <!-- Tab Nav -->
    <nav class="max-w-6xl mx-auto flex flex-col sm:flex-row gap-y-px sm:gap-y-0 sm:gap-x-4" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
        <?php
        if (!empty($args['content']['content_feature_panels'])) :
            foreach ($args['content']['content_feature_panels'] as $index => $panel) :
                $isActive = $index === 0;
                $tabId = "tabs-with-card-item-" . ($index + 1);
                $panelId = "tabs-with-card-" . ($index + 1);
        ?>
                <button type="button"
                    class="hs-tab-active:bg-gray-100 hs-tab-active:hover:border-transparent w-full flex flex-col text-start hover:bg-gray-100 focus:outline-none focus:bg-gray-100 p-3 md:p-5 rounded-xl <?php echo $isActive ? 'active' : ''; ?>"
                    id="<?php echo esc_attr($tabId); ?>"
                    aria-selected="<?php echo $isActive ? 'true' : 'false'; ?>"
                    data-hs-tab="#<?php echo esc_attr($panelId); ?>"
                    aria-controls="<?php echo esc_attr($panelId); ?>"
                    role="tab">
                    <?php if (!empty($panel['icon']['url'])) : ?>
                        <img src="<?php echo esc_url($panel['icon']['url']); ?>"
                            alt=""
                            class="shrink-0 hidden sm:block size-7 hs-tab-active:text-blue-600 text-gray-800">
                    <?php endif; ?>
                    <span class="mt-5">
                        <?php if (!empty($panel['callout'])) : ?>
                            <span class="hs-tab-active:text-gray-900 block uppercase tracking-widest text-gray-500">
                                <?php echo esc_html($panel['callout']); ?>
                            </span>
                        <?php endif; ?>
                        <span class="hs-tab-active:text-blue-600 block font-semibold text-gray-800">
                            <?php echo esc_html($panel['heading']); ?>
                        </span>
                        <?php if (!empty($panel['description'])) : ?>
                            <span class="hidden lg:block mt-2 text-gray-800">
                                <?php echo esc_html($panel['description']); ?>
                            </span>
                        <?php endif; ?>
                    </span>
                </button>
        <?php
            endforeach;
        endif;
        ?>
    </nav>
    <!-- End Tab Nav -->

    <!-- Tab Content -->
    <div class="">
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

                        <div class="xl:mx-auto max-w-full xl:px-8">
                            <img src="<?php echo $panel['image']['url']; ?>" alt="" class="aspect-[5/2] w-full object-cover xl:rounded-3xl">
                        </div>

                    <?php endif; ?>
                </div>
        <?php
            endforeach;
        endif;
        ?>
    </div>
    <!-- End Tab Content -->
</div>
<!-- End Features -->