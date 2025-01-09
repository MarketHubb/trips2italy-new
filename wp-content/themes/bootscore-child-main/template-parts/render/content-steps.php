<?php

/**
 * Template part for displaying the steps section
 *
 * @package YourTheme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Early exit if no args
if (empty($args) || empty($args['content']) || empty($args['content']['content_sections'])) {
    return;
}

$content = $args['content'];
$feature_image_url = esc_url(get_home_url() . '/wp-content/uploads/2024/08/Included-Sq-1.webp');
?>
<div class="max-w-7xl mx-auto relative">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 lg:items-center">
        <div class="aspect-w-16 aspect-h-9 lg:aspect-none">
            <img class="w-full object-cover rounded-xl"
                src="<?php echo $feature_image_url; ?>"
                alt="<?php echo esc_attr('Features Overview'); ?>">
        </div>
        <div>
            <div class="mb-4 hidden">
                <h3 class="text-brand-500 text-xs font-bold font-base uppercase">
                    <?php echo esc_html('We make it easy'); ?>
                </h3>
            </div>

            <?php
            if (!empty($content['content_sections'])) :
                $i = 1;
                foreach ($content['content_sections'] as $field) :
                    if (empty($field)) continue;

                    $heading = !empty($field['heading'])
                        ? sprintf('<span class="text-secondary-500 stylized text-xl sm:text-3xl font-normal animate-on-scroll block">%s</span> ', esc_html($field['heading']))
                        : '';

                    $callout = !empty($field['callout'])
                        ? sprintf('<span class="text-brand-800 font-semibold">%s</span> ', esc_html($field['callout']))
                        : '';


                    $description = !empty($field['description'])
                        ? sprintf('<span class="text-gray-600 font-medium block text-base mt-3">%s</span>', esc_html($field['description']))
                        : '';
            ?>
                    <div class="flex gap-x-5 ms-1">
                        <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-brand-500">
                            <div class="relative z-10 size-8 flex justify-center items-center">
                                <span class="flex shrink-0 justify-center items-center size-8 bg-brand-500 border border-brand-400 text-white font-semibold text-xs uppercase rounded-full">
                                    <?php echo absint($i); ?>
                                </span>
                            </div>
                        </div>
                        <div class="grow pb-8 sm:pb-12">
                            <p class="text-base lg:text-lg text-neutral-400">
                                <?php echo $heading . $callout . $description; ?>
                            </p>
                        </div>
                    </div>
            <?php
                    $i++;
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>