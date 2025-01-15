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
    <?php //if ($content['image'] || $content['mobile_image']) : 
    ?>
    <?php if ($content['image_desktop'] || $content['image_mobile']) : ?>
        <picture>
            <?php if ($content['image_mobile']) : ?>
                <source
                    media="(max-width: 767px)"
                    srcset="<?php echo esc_url($content['image_mobile']['url']); ?>">
            <?php endif; ?>
            <?php if ($content['image_desktop']) : ?>
                <source
                    media="(min-width: 768px)"
                    srcset="<?php echo esc_url($content['image_desktop']['url']); ?>">
                <img
                    src="<?php echo esc_url($content['image_desktop']['url']); ?>"
                    alt="<?php echo esc_attr($content['image_desktop']['alt']); ?>"
                    class="absolute inset-0 h-full w-full object-cover"
                    width="<?php echo esc_attr($content['image_desktop']['width']); ?>"
                    height="<?php echo esc_attr($content['image_desktop']['height']); ?>">
            <?php endif; ?>
        </picture>
    <?php endif; ?>

    <!-- Semi-transparent overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-[rgb(30,30,30)] to-transparent"></div>

    <!-- Main hero content -->
    <div class="relative max-w-screen-2xl mx-auto z-10 flex h-full flex-col items-start justify-end pt-0 pb-10 sm:pb-12 px-4 sm:px-6 lg:px-8 animate-on-scroll animate-fade-in-up">
        <div class="pl-1 sm:pl-0">
            <?php if ($content['heading'] || $content['callout']) : ?>
                <!-- Headline and subheadline -->
                <?php if ($content['callout']) : ?>
                    <h2 class="text-2xl font-medium antialiased sm:text-4xl stylized text-white">
                        <?php echo esc_html($content['callout']); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($content['heading']) : ?>
                    <h1 class="mt-0 sm:mt-2 text-2xl font-semibold text-white sm:text-4xl md:text-5xl text-pretty">
                        <?php echo esc_html($content['heading']); ?>
                    </h1>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <?php
        if ($content['description']) :
            echo render_hero_description($content);
        endif;
        ?>

        <?php
        if (!empty($args['cta'])) :
            $cta = render_section_cta($args);
            echo $cta ?? '';
        endif;
        ?>
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