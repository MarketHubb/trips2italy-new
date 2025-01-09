<?php if (empty($args)) return ''; ?>

<!-- Card Blog -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Grid -->
    <div class="grid lg:grid-cols-2 lg:gap-y-16 gap-10">
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
            <a class="group block rounded-xl overflow-hidden focus:outline-none" href="<?php echo esc_url($permalink); ?>">
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-5">
                    <?php if ($image) : ?>
                        <div class="shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
                            <img class="group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl" 
                                 src="<?php echo esc_url($image); ?>" 
                                 alt="<?php echo esc_attr($title); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="grow">
                        <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600">
                            <?php echo esc_html($title); ?>
                        </h3>
                        <?php if ($description) : ?>
                            <p class="mt-3 text-gray-600">
                                <?php echo wp_trim_words(esc_html($description), 20); ?>
                            </p>
                        <?php endif; ?>
                        <p class="mt-4 inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 group-hover:underline group-focus:underline font-medium">
                            Read more
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </p>
                    </div>
                </div>
            </a>
            <!-- End Card -->
        <?php 
            endforeach;
        endif; 
        ?>
    </div>
    <!-- End Grid -->
</div>
<!-- End Card Blog -->
