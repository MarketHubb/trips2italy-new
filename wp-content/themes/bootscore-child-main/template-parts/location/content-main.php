<?php
$postObj = get_queried_object();

if ($postObj->ID) {
    $type = 'post';
} else {
    $type = 'taxonomy';
}
$inputs = location_tabs($postObj, $type);
ksort($inputs['pages']);

?>

<div class="entry-content single-city">
    <?php get_template_part('template-parts/menu/content', 'button-group', $inputs); ?>


    <div id="custom" class="py-4">
        <div class="container">

            <div class="row" id="content-container">
                <div class="col-12">

                    <?php
                    $hero = get_tax_hero_values(get_queried_object());

                    $tax_content = get_field('content_clean', get_queried_object());

                    if ($tax_content) {
                        echo $tax_content;
                    } else {
                        $legacy_content = get_the_content();
                        $content_array = remove_embeds_from_content($legacy_content,true);
                        $i = 0;
                        $output = '';
                        foreach ($content_array as $block) {
                            $p_classes = $i === 0 ? '' : '';
                            $output .= '<div class="container">';
                            $output .= '<div class="row">';
                            $output .= '<div class="col-12">';
                            $output .= '<p class="' . $p_classes . '">' . $block . '</p>';
                            $output .= '</div></div></div>';

                            $i++;
                        }

                        echo $output;

                    }
                    ?>

                </div>

            </div>

            <?php
            $gallery_ids = explode(',', $hero['gallery_string']);
            get_template_part('template-parts/shared/content', 'gallery', $gallery_ids);
            ?>

            <?php
            get_template_part('template-parts/location/content', 'related');
            ?>

        </div>

    </div>

    <?php //get_template_part('template-parts/features/content', 'features-image-left'); ?>

    <?php //get_template_part('template-parts/features/content', 'features-6'); ?>

</div>
<?php get_footer(); ?>
