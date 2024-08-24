<?php
/* Template Name: Trips Types */
get_header(); ?>

<?php echo tw_section_open(); ?>
<div class="max-w-7xl mx-auto">
    <?php
    $trips = get_posts(array(
        'post_type' => 'trip',
        'order' => 'ASC',
        'posts_per_page' => -1,
    ));
    $content_fields = [];

    foreach ($trips as $trip) {
        if (get_field('excerpt', $trip->ID)) {

            $content_fields[] = [
                'heading' => get_the_title($trip->ID),
                'link' => get_permalink($trip->ID),
                'description' => get_field('excerpt', $trip->ID),
                'image' => get_field('featured_image_mobile', $trip->ID),
            ];
        }
    }
    ?>

    <?php if (!empty($content_fields)) { ?>
        <?php echo get_image_grid($content_fields, 5, 96); ?>
    <?php } ?>

</div>
</section>

<?php get_footer(); ?>