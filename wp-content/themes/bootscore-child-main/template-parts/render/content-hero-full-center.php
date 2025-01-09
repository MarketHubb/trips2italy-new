<?php
if (empty($args) || empty($args['content'])) return;
/**
 * Template part for displaying the homepage hero section
 * 
 * @package YourTheme
 * @since 1.0.0
 */

$content = $args['content'];
?>

<section
    class="relative h-screen w-full bg-cover bg-top bg-no-repeat"
    <?php if ($content['align']) : ?>
    style="background-position: <?php echo esc_attr($content['align']); ?>;"
    <?php endif; ?>>
    <?php if ($content['image'] || $content['mobile_image']) : ?>
        <picture>
            <?php if ($content['mobile_image']) : ?>
                <source
                    media="(max-width: 767px)"
                    srcset="<?php echo esc_url($content['mobile_image']['url']); ?>">
            <?php endif; ?>
            <?php if ($content['image']) : ?>
                <source
                    media="(min-width: 768px)"
                    srcset="<?php echo esc_url($content['image']['url']); ?>">
                <img
                    src="<?php echo esc_url($content['image']['url']); ?>"
                    alt="<?php echo esc_attr($content['image']['alt']); ?>"
                    class="absolute inset-0 h-full w-full object-cover"
                    width="<?php echo esc_attr($content['image']['width']); ?>"
                    height="<?php echo esc_attr($content['image']['height']); ?>">
            <?php endif; ?>
        </picture>
    <?php endif; ?>

    <!-- Semi-transparent overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-[rgb(30,30,30)] to-transparent"></div>

    <!-- Main hero content -->
    <div class="relative max-w-screen-2xl mx-auto z-10 flex h-full flex-col items-start justify-end pt-0 pb-8 sm:pb-12 px-4 text-center sm:px-6 lg:px-8 animate-on-scroll animate-fade-in-up">
        <?php if ($content['heading'] || $content['subheading']) : ?>
            <!-- Headline and subheadline -->
            <?php if ($content['heading']) : ?>
                <h1 class="text-2xl font-medium antialiased sm:text-4xl stylized text-white">
                    <?php echo esc_html($content['heading']); ?>
                </h1>
            <?php endif; ?>

            <?php if ($content['subheading']) : ?>
                <h2 class="mt-2 text-3xl font-semibold text-white sm:text-4xl md:text-5xl">
                    <?php echo esc_html($content['subheading']); ?>
                </h2>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($content['description']) : ?>
            <p class="mt-4 text-base text-gray-100 sm:mt-6 sm:text-lg md:text-xl md:hidden">
                <?php echo esc_html($content['mobile_description']); ?>
            </p>
            <p class="mt-4 hidden text-base text-gray-200 sm:mt-6 sm:text-[1.15rem] leading-[1.75rem] subpixel-antialiased md:block max-w-lg text-left">
                <?php echo esc_html($content['description']); ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($content['copy_main'])) : ?>
            <!-- Call-to-Action button -->
            <div class="inline-block mt-10">
                <?php
                $btn = render_section_cta_btn($args);
                echo $btn ?? '';
                ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($content['callout']) : ?>
        <!-- Callout text -->
        <div class="absolute bottom-0 left-0 z-10 p-4 text-white hidden">
            <p class="text-sm">
                <?php echo esc_html($content['callout']); ?>
            </p>
            <?php if ($content['callout_secondary']) : ?>
                <p class="mt-1 text-xs">
                    <?php echo esc_html($content['callout_secondary']); ?>
                </p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($content['hero_global_icons'] && $content['icons'] !== 'None') : ?>
        <!-- Icons section -->
        <div class="absolute bottom-0 right-0 z-10 p-4">
            <!-- Add your icons implementation here -->
        </div>
    <?php endif; ?>
</section>