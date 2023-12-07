<?php
/* Template Name: Cities & Regions */
get_header(); ?>

<!--<div class="container post-list">-->
<?php
$regions = get_terms(array(
        'taxonomy' => 'region',
    )
);

$output = '<div class="content z-index-2" id="destinations">';
$dropdown  = '<div class="container dropdown-container px-md-4 z-index-3">';
$dropdown .= '<div class="row justify-content-between row-cols-2 z-index-2 border-radius-xl mb-n4 mx-auto py-3 blur shadow-blur region-dropdown-container bg-gradient-dark">';

// Dropdown - Region
$dropdown_region  = '<div class="dropdown">';
$dropdown_region .= '<a href="#" class="px-4 btn bg-white dropdown-toggle mb-0 " data-bs-toggle="dropdown" id="navbarDropdownRegion">';
$dropdown_region .= 'Jump to Region</a>';
$dropdown_region .= '<ul class="dropdown-menu bg-white" aria-labelledby="navbarDropdownRegion">';

// Dropdown - City
$dropdown_city_array = [];
$dropdown_city  = '<div class="d-inline-flex justify-content-end">';
$dropdown_city .= '<div class="dropdown">';
$dropdown_city .= '<a href="#" class="px-4 btn bg-white dropdown-toggle mb-0 " data-bs-toggle="dropdown" id="navbarDropdownCity">';
$dropdown_city .= 'Jump to City</a>';
$dropdown_city .= '<ul class="dropdown-menu" aria-labelledby="navbarDropdownCity">';

foreach ($regions as $region) {
    $output .= '<section id="' . lowercase_no_spaces($region->name) . '" class="region-container py-4 my-4" data-region="' . $region->name . '">';
    $output .= '<div class="container">';

    $dropdown_region .= '<li><a class="dropdown-item fs-6 fw-500" href="#' . lowercase_no_spaces($region->name) . '">';
    $dropdown_region .= $region->name . '</a></li>';

    $query_args = array(
        'post_type' => 'city',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'region',
                'field' => 'term_id',
                'terms' => $region->term_id
            ),
        ),
    );

//    $output .= '<div class="region-copy py-5">';

    $query = new WP_Query($query_args);

    if ($query->have_posts()) :
//        $output .= '<div class="d-flex justify-content-end row-cols-2 row gx-md-10 mb-5">';
//        $output .= '<div class="region-copy py-5">';
//        $output .= '<img src="' . get_field('region_icon', $region) . '" class="region-icon d-block" />';
//        $output .= '<h2 class="me-4">' . $region->name . '</h2>';
//        $output .= '<p class="clamp-4">' . $region->description . '</p>';
//        $output .= '<a class="btn bg-orange btn-lg mt-2" href="' . get_term_link($region->term_id) . '">Explore the ' . $region->name . ' Region</a>';
//        $output .= '</div>';
//        $output .= '<div class="region-image py-4">';
//        $output .= '<img src="' . get_field('featured_image', $region)['url'] . '" class="rounded shadow object-fit h-100" />';
//        $output .= '</div></div>';

        $output .= '<div class="row gx-md-10 mb-5">';
        $output .= '<div class="region-image pt-4">';
        $output .= '<img src="' . get_field('featured_image', $region)['url'] . '" class="rounded shadow object-fit h-100" />';
        $output .= '</div>';
        $output .= '<div class="region-copy py-4 pb-1 py-md-5">';
        $output .= '<img src="' . get_field('region_icon', $region) . '" class="region-icon d-inline me-3" />';
        $output .= '<h2 class="d-inline-block">' . $region->name . '</h2>';
        $output .= '<p class="clamp-4">' . $region->description . '</p>';
        $output .= '<a class="btn bg-orange btn-lg mt-2" href="' . get_term_link($region->term_id) . '">Explore the ' . $region->name . ' Region</a>';
        $output .= '</div></div>';

        $output .= '<div class="row justify-content-start py-3">';
        $output .= '<div class="col-md-8">';
        $output .= '<h4 class="fw-bolder">The cities & towns of ' . $region->name . ':</h4>';
        $output .= '</div></div>';

        $output .= '<div class="row justify-content-start">';

        while ($query->have_posts()) : $query->the_post();

            // Set region name (clean)
            if ($post->post_parent === 0) {
                $dropdown_city_array[] = get_field('city_name');
                $output .= '<div id="' . strtolower(str_replace(" ", "",get_field('city_name'))) . '" class="col-12 col-md-4 my-3">';

                // Setup card
                $parent_id = get_the_ID();
                $city_image = get_field('image_slider_url', $post->ID);
                $image_url = remove_home_url($city_image);
                $card_args = [];
                $card_args['image_url'] = $image_url;
                $card_args['heading'] = '<h4 class="fs-5 fw-bolder">' . get_field('city_name') . '</h4>';
                $card_args['body'] = '<ul class="list-group list-group-flush">';
                $card_args['body'] .= list_group_item(array(
                    'url' => get_permalink($post->ID),
                    'text' => 'Ultimate Travel Guide'
                ));

                $children_cities = get_posts(array(
                    'post_type' => 'city',
                    'post_parent' => $parent_id,
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

                    $card_args['body'] .= '</ul>';
                    $card = single_card_waves($card_args);
                    $output .= $card;
                    $output .= '</div>';
                }

            }


        endwhile;
        $output .= '</div>';
    endif;
    $output .= '</div></section>';
    wp_reset_postdata();
}

$output .= '</div>';

sort($dropdown_city_array);
foreach ($dropdown_city_array as $city_name) {
    $dropdown_city .= '<li><a class="dropdown-item fs-6 fw-500" href="#' . strtolower(str_replace(" ", "", $city_name)) . '">';
    $dropdown_city .=  $city_name . '</a></li>';
}

$dropdown_region .= '</ul></div>';
$dropdown_city .= '</ul></div></div>';
$dropdown .= $dropdown_region . $dropdown_city . '</div></div>';
$output = $dropdown . $output;
echo $output;
?>
<!--</div>-->



<?php get_footer(); ?>


