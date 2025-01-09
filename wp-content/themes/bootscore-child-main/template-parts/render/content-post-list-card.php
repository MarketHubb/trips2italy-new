<?php if (empty($args)) return ''; ?>

<!-- Card Blog -->
<div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">

    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        if (!empty($args['content']['content_packages'])) :
            foreach ($args['content']['content_packages'] as $package) :
                if (empty($package['post_object'])) continue;

                $post = $package['post_object'];
                $title_raw = get_the_title($post->ID);
                $title_array = explode("|", $title_raw);
                $title = count($title_array) === 2 ? $title_array[0] : $title_raw;
                $price = get_field('price', $post->ID);
                $image = get_field('featured_image', $post->ID)['sizes']['large'];
                $description = get_field('description', $post->ID);
                $permalink = get_permalink($post->ID);
        ?>
                <!-- Card -->
                <a class="group flex flex-col h-full border border-gray-200 bg-white/90 hover:border-transparent hover:shadow-lg focus:outline-none focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-5"
                    href="<?php echo esc_url($permalink); ?>">
                    <?php if ($image) : ?>
                        <div class="aspect-w-16 aspect-h-11">
                            <img class="w-full object-cover rounded-xl"
                                src="<?php echo esc_url($image); ?>"
                                alt="<?php echo esc_attr($title); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="my-6">
                        <h3 class="text-xl font-semibold text-gray-800">
                            <?php echo esc_html($title); ?>
                        </h3>
                        <?php if ($description) : ?>
                            <p class="mt-5 text-gray-600">
                                <?php echo wp_trim_words(esc_html($description), 20); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <?php if ($price) : ?>
                        <div class="mt-auto flex items-center gap-x-3">
                            <div>
                                <h5 class="text-sm text-gray-800">Starting from <?php echo esc_html($price); ?></h5>
                            </div>
                        </div>
                    <?php endif; ?>
                </a>
                <!-- End Card -->
        <?php
            endforeach;
        endif;
        ?>
    </div>
    <!-- End Grid -->

    <!-- Card -->
    <div class="mt-12 text-center">
        <a class="py-3 px-4 inline-flex items-center gap-x-1 text-sm font-medium rounded-full border border-gray-200 bg-white text-blue-600 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
            href="<?php echo esc_url(get_post_type_archive_link('package')); ?>">
            View all packages
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </a>
    </div>
    <!-- End Card -->
</div>
<!-- End Card Blog -->