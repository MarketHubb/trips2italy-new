<?php if (empty($args)) return ''; ?>

<div class="max-w-full px-4 sm:px-6 lg:px-8 mx-auto">
    <!-- Grid -->
    <div class="grid sm:grid-cols-2 gap-6">
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
                $date = get_the_date('M d, Y', $post->ID);
        ?>
                <!-- Card -->
                <a class="group relative block rounded-xl focus:outline-none" href="<?php echo esc_url($permalink); ?>">
                    <div class="shrink-0 relative rounded-xl overflow-hidden w-full h-[350px] before:absolute before:inset-x-0 before:z-[1] before:size-full before:bg-gradient-to-t before:from-gray-900/70">
                        <?php if ($image) : ?>
                            <img class="size-full absolute top-0 start-0 object-cover"
                                src="<?php echo esc_url($image); ?>"
                                alt="<?php echo esc_attr($title); ?>">
                        <?php endif; ?>
                    </div>

                    <div class="absolute top-0 inset-x-0 z-10">
                        <div class="p-4 flex flex-col h-full sm:p-6">
                            <?php if ($price) : ?>
                                <!-- Price Tag -->
                                <div class="flex items-center">
                                    <div class="ms-2.5 sm:ms-4">
                                        <h4 class="font-semibold text-white">Starting from <?php echo esc_html($price); ?></h4>
                                    </div>
                                </div>
                                <!-- End Price Tag -->
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="absolute bottom-0 inset-x-0 z-10">
                        <div class="flex flex-col h-full p-4 sm:p-6">
                            <h3 class="text-lg sm:text-3xl font-semibold text-white group-hover:text-white/80 group-focus:text-white/80">
                                <?php echo esc_html($title); ?>
                            </h3>
                            <?php if ($description) : ?>
                                <p class="mt-2 text-white/80">
                                    <?php echo wp_trim_words(esc_html($description), 15); ?>
                                </p>
                            <?php endif; ?>
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