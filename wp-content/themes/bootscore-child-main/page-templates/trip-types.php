<?php
/* Template Name: Trips Types */
get_header(); ?>

<?php $hero_inputs = get_hero_inputs(get_queried_object()); ?>

<!-- Featured trips -->
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

            $content_fields['content'][] = [
                'heading' => get_the_title($trip->ID),
                'link' => get_permalink($trip->ID),
                'description' => get_field('excerpt', $trip->ID),
                'image' => get_field('featured_image_mobile', $trip->ID),
            ];
        }
    }
    ?>

    <?php
    if (!empty($content_fields)) {
        $content = $content_fields['content'];
        $featured_content = array_slice($content, 0, 3);
        $remaining_content = array_slice($content, 3);

        $featured_collection = [
            'classes' => [
                'grid' => ' grid grid-cols-1 gap-x-6 gap-y-12 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-10 divide-y divide-y-gray-50 lg:divide-y-0 pb-10 ',
                'heading' => ' stylized text-[2rem] md:text-4xl lg:text-5xl text-secondary-500 ',
                'description' => ' line-clamp-3 text-gray-600 group-hover:text-gray-700 text-base ',
                'image' => ' h-72 w-full object-cover object-center group-hover:opacity-75 ',
            ],
            'content' => $content
        ];

        echo get_image_grid($featured_collection);
    }
    ?>

</div>

</section>

<!-- Remaining trip types -->
<?php echo tw_section_open(); ?>


</section>

<?php get_footer(); ?>