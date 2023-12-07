<?php
/* Template Name: Trips Types */
get_header(); ?>

<div class="container trip-list">
    <div class="row mt-5 mb-2">
        <div class="col-12">
            <h3>No matter the trip type, we can help make it unforgettable.</h3>
        </div>
    </div>
    <?php
    $posts = get_posts(array(
        'post_type' => 'trip',
        'order' => 'ASC',
        'posts_per_page' => -1,
    ));
    $cards = '<div class="row">';

    foreach ($posts as $trip) {
        if (get_field('excerpt', $trip->ID)) {
            $cards .= '<div class="col-12 col-md-3 my-3">';
            $card_args = [];
            $card_args['image_url'] = get_field('featured_image_mobile', $trip->ID);
            $card_args['heading'] = '<h4 class="fw-bolder"><a class="fs-4 lh-sm" href="' . get_permalink($trip->ID) . '">' . get_the_title($trip->ID) . '</a></h4>';
            $card_args['body'] = '<p>' .  get_field('excerpt',$trip->ID) . '</p>';
            $cards  .= single_card_waves($card_args);
            $cards .= '</div>';
        }


        $output .= '<div class="col-lg-4 my-3">';
        $output .= '<div class="card h-100">';
        $output .= '<div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">';
        $output .= '<a href="' . get_permalink($trip->ID) . '" class="d-block">';
        $output .= get_field('featured_image_mobile', $trip->ID);
        $output .= '</a></div>';
        $output .= '<div class="card-body">';
        $output .= '<h3><a href="' . get_the_permalink($trip->ID) . '">' . get_the_title($trip->ID) . '</a></h3>';
        $output .= get_field('excerpt',$trip->ID);
        $output .= '</div></div></div>';
    }
    $cards .= '</div>';
    echo $cards;
    ?>
</div>



<?php get_footer(); ?>
