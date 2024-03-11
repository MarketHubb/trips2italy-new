<?php
/* Template Name: Destinations */
get_header(); ?>

<?php
$regions = get_terms(
    array(
        'taxonomy' => 'location_region',
        'exclude' => [5245]
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
    $output .= '<section id="' . lowercase_no_spaces($region->name) . '" class="region-container py-7" data-region="' . $region->name . '" data-termid="' . $region->term_id . '">';
    $output .= '<div class="container">';

    $dropdown_region .= '<li><a class="dropdown-item fs-6 fw-500" href="#' . lowercase_no_spaces($region->name) . '">';
    $dropdown_region .= $region->name . '</a></li>';

    $query_args = array(
        'post_type' => 'location',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'location_region',
                'field' => 'term_id',
                'terms' => $region->term_id
            ),
        ),
    );

    $query = new WP_Query($query_args);

    if ($query->have_posts()) :
        $output .= '<div class="row align-content-center align-middle gx-md-4 mb-5">';
        $output .= '<div class="col-md-5">';
        $output .= '<img src="' . get_field('region_icon', $region) . '" class="region-icon d-block mb-4" />';
        $output .= '<h2 class="d-inline-block">' . $region->name . '</h2>';
        $output .= '<p class="clamp-4">' . $region->description . '</p>';
        $output .= '<div class="mt-6">';
        $output .= '<a class="btn bg-orange btn-lg mb-0" href="' . get_term_link($region->term_id) . '">Explore the ' . $region->name . ' Region</a>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="col-md-7">';
        $output .= '<img src="' . get_field('featured_image', $region)['url'] . '" class="rounded shadow object-fit h-100" />';
        $output .= '</div>';
        $output .= '<div class="region-image pt-4">';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<hr>';

        $output .= '<div class="row justify-content-start py-3">';
        $output .= '<div class="col-md-8">';
        $output .= '<h5 class="fw-bolder">The cities & towns of ' . $region->name . '</h5>';
        $output .= '</div></div>';

        $output .= '<div class="row justify-content-start">';

        while ($query->have_posts()) : $query->the_post();

            // Set region name (clean)
            if ($post->post_parent === 0) {
                $dropdown_city_array[] = get_field('city_name');
                $output .= '<div id="' . strtolower(str_replace(" ", "", get_field('city_name'))) . '" class="col-12 col-md-4 my-3">';

                // Setup card
                $parent_id = get_the_ID();
                $domain = get_bloginfo('url');
                $location_image = (get_field('featured_image')['sizes']['large']) ?: remove_dev_domain_from_url(get_field('image_slider_url', $post->ID));
                $location_heading = '<h5 class="tracking-none fw-700 icon-move-right">' . get_the_title() . '</h5>';
                $card_args = [];
                $card_args['image_url'] = $location_image;
                $card_args['background'] = 'gray-50';
                $card_args['heading'] = $location_heading;

                // Description
                $body_content = wp_strip_all_tags(get_field('content_clean'));
                $card_args['body']  = '<p class="clamp-3">' . $body_content . '</p>';
                $card_args['body'] .= '<a href="' . get_permalink($post->ID) . '"><p class="tracking-none fw-600 no-anti mb-0 icon-move-right">Explore ' . get_the_title() . '<i class="fas fa-arrow-right text-sm ps-2"></i></h4></a>';


                $card = single_card_waves($card_args);
                $output .= $card . '</div>';
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
 


<?php get_footer(); ?>