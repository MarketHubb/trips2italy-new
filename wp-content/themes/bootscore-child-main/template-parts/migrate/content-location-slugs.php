<h3>content-location-slugs.php</h3>

<?php

function update_region_tax_slugs()
{
    $tax_array = [];
    $taxonomy = 'location_region';

    $regions = get_terms(
        array(
            'taxonomy' => $taxonomy,
            'posts_per_page' => -1,
        )
    );

    foreach ($regions as $region) {
        $tax_array[] = $region;

        $region_children = get_terms(array(
            'taxonomy' => $taxonomy,
            'posts_per_page' => -1,
            'hide_empty' => false,
            'parent' => $region->term_id
        ));

        foreach ($region_children as $region_child) {
           $tax_array[] = $region_child; 
        }
    }

    foreach ($tax_array as $tax_item) {
        $current_slug = $tax_item->slug;
        $new_slug = str_replace('_', '-', $current_slug);

        if ($current_slug !== $new_slug) {}

        
        $tax_args = [
            'slug' => $new_slug
        ];

        wp_update_term( $tax_item->term_id, $taxonomy, $tax_args);
    }
}

function update_location_slugs()
{
    $args = array(
        'post_type' => 'location',
        'posts_per_page' => -1, // Retrieve all posts
    );

    $location_posts = get_posts($args);

    foreach ($location_posts as $post) {
        $current_slug = $post->post_name;
        $new_slug = str_replace('_', '-', $current_slug);

        if ($current_slug !== $new_slug) {
            wp_update_post(array(
                'ID' => $post->ID,
                'post_name' => $new_slug,
            ));
        }
    }
}

// update_location_slugs();

update_region_tax_slugs();

?>