<?php
/* Template Name: Regions (Parent) */
get_header(); ?>

<?php
$hero = get_hero_banner(get_the_ID());
if (isset($hero)) {
    get_template_part('template-parts/shared/content', 'hero-masonry', $hero);
}
?>

    <?php
//    $parent_tax_items = get_terms(array('taxonomy' => 'region'));
//    $child_tax_items = array(
//        'Ultimate Travel Guide',
//        'Things To Do Travel Guide',
//        'History Travel Guide',
//        'Food & Wine Travel Guide',
//        'Culture Travel Guide'
//    );
//    if (is_array($parent_tax_items) && is_array($child_tax_items)) {
//        foreach ($child_tax_items as $child_tax) {
//
//        }
//    }


    ?>


<!--<div class="container post-list">-->

        <?php
        function test($url, $home_url) {
            $position = strpos($url, 't2i-new.test');

            if ($position === 0) {
                $url = str_replace('t2i-new.test', '', $url);
            }

            return get_home_url() . $url;

//            $urls = [$home_url, $home_domain];
//
//            foreach ($urls as $url) {
//                $url = str_replace($url,"",$url);
//            }

            // On the staging site...

        }



        $regions = get_terms(array(
            'taxonomy' => 'region',
            )
        );

        $output = '';

        foreach ($regions as $region) {
            $output .= '<section class="region-container py-3 my-3" data-region="' . $region->name . '">';
            $output .= '<div class="container">';

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
            
            $query = new WP_Query($query_args);
            
            if ($query->have_posts()) :
//                $output .= '<div class="row region-heading align-items-center row-eq">';
//                $output .= '<div class="col-md-6 ">';
//                $output .= '<div class="region-copy ">';
//                $output .= '<img src="' . get_field('region_icon', $region) . '" class="region-icon d-block" />';
//                $output .= '<h2 class="me-4">' . $region->name . '</h2>';
//                $output .= '<p class="">' . $region->description . '</p>';
//                $output .= '</div></div>';
//                $output .= '<div class="col-md-6 ">';
//                $output .= '<div class="region-image ">';
//                $output .= '<img src="' . get_field('featured_image', $region)['url'] . '" class="rounded shadow " />';
//                $output .= '</div></div></div>';

                $output .= '<div class="d-flex justify-content-end row-cols-2 row gx-md-8 mb-5">';
//                $output .= '<div class="col-md-6 ">';
                $output .= '<div class="region-copy ">';
                $output .= '<img src="' . get_field('region_icon', $region) . '" class="region-icon d-block" />';
                $output .= '<h2 class="me-4">' . $region->name . '</h2>';
                $output .= '<p class="">' . $region->description . '</p>';
                $output .= '</div>';
                $output .= '<div class="region-image pt-8 pb-2">';
                $output .= '<img src="' . get_field('featured_image', $region)['url'] . '" class="rounded shadow object-fit h-100" />';
                $output .= '</div></div>';

                $output .= '<div class="row justify-content-start">';

                while ($query->have_posts()) : $query->the_post();

                    // Set region name (clean)
                    if ($post->post_parent === 0) {
                        $output .= '<div class="col-12 col-md-4 my-3">';

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
        echo $output;
        ?>
<!--</div>-->



<?php get_footer(); ?>
