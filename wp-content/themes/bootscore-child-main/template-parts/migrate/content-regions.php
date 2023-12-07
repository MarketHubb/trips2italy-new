<?php
if ( ! is_admin() ) {
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
}

//$region_terms_array = [];
//$region_location_terms_array = [];
//
//$region_terms = get_terms(array(
//    'taxonomy' => 'region',
//    'hide_empty' => false,
//));
//
//$region_location_terms = get_terms(array(
//    'taxonomy' => 'location_region',
//    'hide_empty' => false,
//));
//
//
//foreach ($region_terms as $region_term) {
//    $region_terms_array[$region_term->name] = $region_term->term_id;
//}
//
//foreach ($region_location_terms as $region_location_term) {
//
//    if ($region_location_term->parent === 0 && $region_terms_array[$region_location_term->name]) {
//        $region_location_terms_array[$region_location_term->term_id] = $region_terms_array[$region_location_term->name];
//    }
//
//}
//
//foreach ($region_location_terms_array as $location_id => $region_id) {
//    $region_term_obj = get_term($region_id);
//    $location_term_obj = get_term($location_id);
//    populate_region_location_from_region($location_term_obj, $region_term_obj);
//}

$region_array = [];

$region_parent_args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent' => 530,
    'orderby' => 'title',
    'order' => 'ASC',
);

$region_parent_pages = get_posts($region_parent_args);



$terms = get_terms(array(
   'taxonomy' => 'location_region',
    'hide_empty' => false,
));

$parent_terms = [];
$region_child_terms = [];

foreach ($terms as $term) {
    $name = $term->name;
    $region_child_terms[$name] = $term->term_id;
}



// Top level regions
foreach ($region_parent_pages as $region_parent_page) {

    $region_parent_title = format_region_title($region_parent_page->ID);

//    foreach ($terms as $term) {
//        if ($term->name === $region_parent_title) {
//            $term_parent_obj = $term;
//            $term_parent_id = $term->term_id;
//            break;
//        }
//    }

//    $region_page = get_post($region_parent_page->ID);
//    
//
//    if ($term_parent_obj && $region_page) {
//        $region_post_content = populate_region($region_page, $region_parent_title, $term_parent_obj);
//    }

    $region_child_pages = get_posts(array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'post_status' => 'any',
        'post_parent' => $region_parent_page->ID,
    ));

    // Region children *AND* City parents
    foreach ($region_child_pages as $region_child_page) {
        $region_child_title = format_region_title($region_child_page->ID);
        $region_format = format_post_region($region_child_page->ID);

        if ($region_format === "city_parent") {
            $city_parent_title = remove_substring($region_child_title, $region_parent_title);

//            $city_parent_page = get_post($region_child_page->ID);

//            $city_parent_post = post_exists($city_parent_title,'','','location');

//            if (!$city_parent_post) {
//                $city_parent = populate_location($city_parent_page, $city_parent_title, $region_parent_title, $term_parent_id);
//            }

        }
        
/*        highlight_string("<?php\n\$region_child_title =\n" . var_export($region_child_title, true) . ";\n?>");*/

        if ($region_format === "region_child") {
            
            $region_child_title = $region_parent_title . ' ' . remove_substring($region_child_title, $region_parent_title);
/*            highlight_string("<?php\n\$region_child_title =\n" . var_export($region_child_title, true) . ";\n?>");*/

            $region_child_page = get_post($region_child_page->ID);
            
            $region_child_page_id = $region_child_page->ID;
            
            if ($region_child_terms[$region_child_title]) {
                $region_child_term_obj = get_term($region_child_terms[$region_child_title]);
                $region_child_page = get_post($region_child_page->ID);
//                populate_region($region_child_page, $region_child_term_obj);
            }

           

//            $region_child_post = post_exists($city_parent_title,'','','location');

//            $region_array[$region_parent_title]['region_children'][] = [
//                'name' => $region_parent_title . " " . $region_child_title,
//                'id' => $region_child_page->ID,
//            ];

//            $region_child_slug = $region_slug . '_' . strtolower(str_replace(" ", "_", $region_child_title));
//            $region_child_term = $region_parent_title . ' ' . $region_child_title;
//
//            $parent_terms[$region_child_slug] = $term_parent_id;
            

//            insert_term_to_tax("location_region", $region_child_term, $region_child_slug, $term_parent_id);
        }







        // City children
        if ($region_format === "city_parent") {

            $city_children = get_posts(array(
                'post_type' => 'page',
                'posts_per_page' => -1,
                'post_status' => 'any',
                'post_parent' => $region_child_page->ID,
            ));

            foreach ($city_children as $city_child) {
                $city_child_id = $city_child->ID;

                $city_child_title = $city_parent_title . ' ' . remove_substring(format_region_title($city_child->ID), $region_child_title);

//                $city_child_page = get_post($city_child->ID);
//
//                $city_child_post = post_exists($city_child_title,'','','location');
//
//                if (!$city_child_post && $city_parent_post) {
//                    $city_child = populate_location($city_child_page, $city_child_title, $region_parent_title, $term_parent_id, $city_parent_post);
//                }


            }



        }


    }

}



/*highlight_string("<?php\n\$region_child_terms =\n" . var_export($region_child_terms, true) . ";\n?>");*/
