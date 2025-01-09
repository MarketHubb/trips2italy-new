<?php if (empty($args)) return ''; ?>

<?php $text_color = $args['content']['content_text_color'] ?? 'Dark'; ?>

<div class="">
    <div class="px-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">

            <?php
            if (!empty($args['content']['content_subheading'])):
                $subheading_classes = get_subheading_base_classes() . subheading_color_class($text_color);
            ?>
                <span class="<?php echo $subheading_classes; ?>">
                    <?php echo $args['content']['content_subheading']; ?>
                </span>
            <?php endif; ?>

            <?php
            if (!empty($args['content']['content_heading'])) {
                $heading_classes = get_heading_base_classes() . heading_color_class($text_color);
                $heading = $args['content']['content_heading'];
            ?>
                <h2 class="<?php echo $heading_classes; ?>">
                    <?php echo $heading; ?>
                </h2>
            <?php } ?>

            <?php if (!empty($args['content']['content_description'])) {  ?>
                <div class="mx-auto">
                    <p class="<?php echo get_description_classes($text_color); ?>">
                        <?php echo $args['content']['content_description']; ?>
                    </p>
                <?php } ?>

                <div class="hidden mt-10 flex items-center justify-center gap-x-6">
                    <?php
                    $cta_btn = render_section_cta($args);

                    echo $cta_btn
                        ? $cta_btn
                        : '';

                    ?>
                </div>
            </div>
        </div>
    </div>