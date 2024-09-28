<?php
$queried_object = get_queried_object();
set_query_var('queried_object', $queried_object,);

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

<?php //get_template_part('template-parts/tw/content', 'hero-background-image', $queried_object); 
?>

<?php echo tw_section_open(['grid_classes' => ' px-6 lg:px-0 py-16 md:py-24 relative bottom-[10rem]']); ?>

<?php echo tw_container_open('max-w-7xl mx-auto'); ?>

<div class="entry-content single-city">
    <?php get_template_part('template-parts/tw-shared/content', 'tab-icons', $tab_inputs); ?>

    <?php
    $content_field = parseContent(get_field('content_clean', get_queried_object()));
    get_template_part('template-parts/tw-shared/content', 'copy-image', $content_field);
    ?>


    <section id="location-gallery" class="hidden bg-gray-100 py-6">
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

    <?php //get_template_part('template-parts/location/content', 'cta'); ?>

</div>

<?php echo tw_container_and_section_close(); ?>

<?php get_footer(); ?>