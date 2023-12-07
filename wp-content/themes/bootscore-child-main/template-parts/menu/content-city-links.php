<?php $image_path = get_home_url() . '/wp-content/uploads/2023/01/bg_map.png'; ?>
<section
    class="py-4 my-6 footer-links full-background background-image-contain"
    style="background-image: url(<?php echo $image_path; ?>)">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <?php
//                $city_terms = get_terms(
//                    ['taxonomy' => 'region']
//                );
                $city_terms = get_terms(array(
                        'taxonomy' => 'location_region',
                        'exclude' => [5245]
                    )
                );

                $output = '<div class="">';
                $output = '<ul class="destination-list">';

                foreach ($city_terms as $city_term) {
                    $link_args = array(
                        'post_type' => 'location',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'location_region',
                                'field' => 'term_id',
                                'terms' => $city_term->term_id
                            ),
                        ),
                    );

                    $output .= '<li class="list-group-item">';
                    $output .= '<p class="fw-bold mb-0 mt-1 text-gradient text-primary">';
                    $output .= '<a href="' . get_term_link($city_term) . '" class="fs-6">'. $city_term->name . '</a></p>';
                    $output .= '</li>';

                    $links = get_posts($link_args);

                    foreach ($links as $link) {
                        if (!$link->post_parent) {
                            $title = format_region_title($link->ID);
                            $output .= '<li class="list-group-item">';
                            $output .= '<a href="' . get_the_permalink($link->ID) . '" class="small">';
                            $output .= $title . '</a>';
                            $output .= '</li>';
                        }

                    }
                }

                $output .= '</ul>';
                $output .= '</div>';

                echo $output; ?>

            </div>
        </div>
    </div>
</section>

