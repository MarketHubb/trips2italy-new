<?php
if (isset($args)) {
    $output = '<div class="row py-24">';
    $output .= '<div class="col-12">';

    $heading_modifier = ($args['type'] === 'post') ? 'other ' : '';
    $heading = 'Explore these ' . $heading_modifier . ' cities and towns in the ' . get_the_terms(get_the_ID(), "location_region")[0]->name . ' region of Italy';
    $heading = 'Explore the ' . get_the_terms(get_the_ID(), "location_region")[0]->name . ' region of Italy';

    $output .= '<h3 class="mb-6 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">' . $heading . '</h3>';
    $output .= '</div>';

    foreach ($args['related_locations'] as $location) {
        $object_id = $args['type'] === 'post' ? $location->ID : $location->term_id;

        if (isset($object_id)) {
            $city_image = (get_field('featured_image', $location->ID)['sizes']['large']) ?: remove_dev_domain_from_url(get_field('image_slider_url', $location->ID));

            $output .= '<div class="col-md-4 mb-5">';

            $card_args = [];

            $card_args['image_url'] = $city_image;
            $card_args['heading'] = '<h4 class="fs-5 fw-bolder">' . get_the_title($location->ID) . '</h4>';
            $card_args['body'] = '<ul class="list-group list-group-flush">';
            $card_args['body'] .= list_group_item(array(
                'url' => get_permalink($location->ID),
                'text' => 'Ultimate Travel Guide &#8594;'
            ));

            $children_cities = get_posts(
                array(
                    'post_type' => 'city',
                    'post_parent' => $location->ID,
                    'posts_per_page' => -1,
                    'meta_key' => 'standardized_title',
                    'orderby' => 'meta_value',
                ),
            );

            if (count($children_cities) > 0) {

                foreach ($children_cities as $child) {
                    $card_args['body'] .= list_group_item(array(
                        'url' => get_permalink($child->ID),
                        'text' => get_field('standardized_title', $child->ID)
                    ));
                }
            }

            $card_args['body'] .= '</ul>';
            $card = single_card_waves($card_args);
            $output .= $card;
            $output .= '</div>';
        }
    }

    $output .= '</div>';

    echo $output;
}
