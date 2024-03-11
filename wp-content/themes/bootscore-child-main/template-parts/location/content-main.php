<?php
$queried_object = get_queried_object();

if ($queried_object->ID) {
    $type = 'post';
    $post_obj = get_post($queried_object);
} else {
    $type = 'taxonomy';
}
$inputs = location_tabs($queried_object, $type);
ksort($inputs['pages']);

?>

<div class="entry-content single-city">
    <?php get_template_part('template-parts/menu/content', 'button-group', $inputs); ?>

    <?php
    // $hero = get_tax_hero_values(get_queried_object());
    $output = '<div id="location-region-content" class="py-4 my-5">';
    $location_content = get_field('content_clean', get_queried_object());

    if (!empty($location_content)) {

        if (!checkFirstTwoChars($location_content)) {
            $location_content = '<h3></h3>' . $location_content;
        }

        $location_content_array = splitStringByHeadings($location_content);

        if (is_array($location_content_array) && !empty($location_content_array)) {

            foreach ($location_content_array as $location_content_block) {
                $lowercaseItem = strtolower($location_content_block);

                if (
                    (strpos($lowercaseItem, '<strong>travel guides</strong>') === false) &&
                    (strpos($lowercaseItem, '>&nbsp;</') === false) &&
                    (strpos($lowercaseItem, '<h4>') === false && strpos($lowercaseItem, 'of italy</h4>') === false) &&
                    (strpos($lowercaseItem, '<b>about') === false && strpos($lowercaseItem, '</b>') === false) &&
                    (strpos($lowercaseItem, '<h4>the cities of') === false && strpos($lowercaseItem, 'italy</h4>') === false)
                ) {
                    $output .= '<div class="container location-content-block">';
                    $output .= '<div class="row">';
                    $output .= '<div class="col-12">';
                    $output .= $location_content_block;
                    $output .= '</div></div></div>';
                }
            }
        }
    }

    $output .= '</div>';

    echo $output;

    $tax_content = get_field('content_clean', get_queried_object());

    if ($tax_content) {
        // echo $tax_content;
    } else {
        $legacy_content = get_the_content();
        $content_array = remove_embeds_from_content($legacy_content, true);
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

        // echo $output;
    }
    ?>


    <section id="location-gallery" class="bg-gray-100 py-6">
        <div class="container">
            <?php
            $gallery_ids = explode(',', $hero['gallery_string']);
            get_template_part('template-parts/shared/content', 'gallery', $gallery_ids);
            ?>
        </div>
    </section>

    <section id="location-related" class="py-6">
        <div class="container">
            <?php
            $related_args['type'] = $type;
            $related_args['related_locations'] = related_locations_in_region($post_obj);

            if (isset($related_args) && !empty($related_args['related_locations'])) {
                get_template_part('template-parts/location/content', 'related', $related_args);
            }
            ?>
        </div>
    </section>

    <?php get_template_part('template-parts/location/content', 'cta'); ?>

</div>

<?php get_footer(); ?>