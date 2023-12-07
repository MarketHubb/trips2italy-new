<?php
$postObj = get_query_var('postObj');

if ($postObj->ID) {
    $type = 'post';

    $query = get_posts(array(
        'post_type' => 'location',
        'posts_per_page' => -1,
        'post__not_in' => array($postObj->ID),
        'post_parent' => 0,
        'tax_query' => array(
            array(
                'taxonomy' => 'location_region',
                'field' => 'term_id',
                'terms' => get_the_terms(get_the_ID(), "location_region")[0]->term_id
            ),
        )
    ));

}

if ($postObj->term_id) {
    $type = 'taxonomy';
    
    $query = get_posts(array(
       'post_type' => 'location',
        'posts_per_page' => -1,
        'post_parent' => 0,
        'tax_query' => array(
            array(
                'taxonomy' => 'location_region',
                'field' => 'term_id',
                'terms' => $postObj->term_id
            ),
        )
    ));
    
}


$output = '<div class="row">';
$output .= '<div class="col-12">';

$heading = ($type === "post") ? "Other cities in  " . get_the_terms(get_the_ID(), "location_region")[0]->name : "Cities & Towns in " . $postObj->name;

$output .= '<h3>' . $heading . '</h3>';
$output .= '</div>';

foreach($query as $obj) {

    $output .= '<div class="col-md-6 mb-5">';
    $city_image = get_field('image_slider_url', $obj->ID);
    $image_url = remove_home_url($city_image);
    $card_args = [];
    $card_args['image_url'] = $image_url;
    $card_args['heading'] = '<h4 class="fs-5 fw-bolder">' . get_the_title($obj->ID) . '</h4>';
    $card_args['body'] = '<ul class="list-group list-group-flush">';
    $card_args['body'] .= list_group_item(array(
        'url' => get_permalink($obj->ID),
        'text' => 'Ultimate Travel Guide'
    ));

    $children_cities = get_posts(array(
        'post_type' => 'city',
        'post_parent' => $obj->ID,
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

$output .= '</div>';

echo $output;



