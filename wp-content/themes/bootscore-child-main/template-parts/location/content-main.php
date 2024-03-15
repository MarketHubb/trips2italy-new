<?php
$queried_object = get_queried_object();

if ($queried_object->ID) {
    $type = 'post';
    $object_id = $queried_object->ID;
} else {
    $type = 'taxonomy';
    $object_id = $queried_object->term_id;
}
$tab_inputs = location_tabs($queried_object, $type);
ksort($tab_inputs['pages']);

?>

<div class="entry-content single-city">
    <?php get_template_part('template-parts/menu/content', 'button-group', $tab_inputs); ?>

    <?php
    $hero = get_tax_hero_values(get_queried_object());
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
            $related_args['related_locations'] = (isset($object_id) && isset($type)) ? related_locations_in_region($object_id, $type) : null;

            if (isset($related_args) && !empty($related_args['related_locations'])) {
                get_template_part('template-parts/location/content', 'related', $related_args);
            }
            ?>
        </div>
    </section>

    <?php get_template_part('template-parts/location/content', 'cta'); ?>

</div>

<?php get_footer(); ?>