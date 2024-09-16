<?php $image_path = get_home_url() . '/wp-content/uploads/2023/01/bg_map.png'; ?>
<?php
$section_args = [
    'image' => get_home_url() . '/wp-content/uploads/2023/01/bg_map.png',
    'classes' => ' footer-links bg-contain bg-center bg-no-repeat py-12 '
];
echo tw_section_open($section_args); ?>
<div class="max-w-7xl mx-auto relative">
    <div class="flex flex-col w-full">
        <?php
        //                $city_terms = get_terms(
        //                    ['taxonomy' => 'region']
        //                );
        $city_terms = get_terms(
            array(
                'taxonomy' => 'location_region',
                'exclude' => [5245]
            )
        );

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
            $output .= '<a href="' . get_term_link($city_term) . '" class="">' . $city_term->name . '</a></p>';
            $output .= '</li>';

            $links = get_posts($link_args);

            foreach ($links as $link) {
                if (!$link->post_parent) {
                    $title = format_region_title($link->ID);
                    $output .= '<li class="list-group-item">';
                    $output .= '<a href="' . get_the_permalink($link->ID) . '" class="text-sm text-gray-700">';
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
</section>