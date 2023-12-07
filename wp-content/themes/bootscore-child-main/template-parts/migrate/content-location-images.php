<h1>content-location-images.php</h1>
<?php
if ( ! is_admin() ) {
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
}

$image_array = [];

//$terms = get_terms(array(
//    'taxonomy' => 'location_region',
//    'hide_empty' => false,
//));


//$locations_city_test = get_posts(array(
//   'post_type' => 'city',
//    'p' => 27237
//));

//$term_ids = [];
//
//
//
//$locations = get_posts(array(
//    'post_type' => 'location',
//    'posts_per_page' => -1,
//    'p' => 30778,
//));

$location_terms = get_terms(array(
    'taxonomy' => 'location_region',
    'hide_empty' => false,
    'posts_per_page' => -1
));


foreach ($location_terms as $location_term) {
    $image_repeater_field = get_field('images', $location_term);
    $image_field = get_field('image_id', $location_term);
    $image_id_array = explode(',', $image_field);

//    if (count($image_repeater_field) === 0 && $image_id_array > 0) {
    if ($image_repeater_field === false && $image_id_array > 0) {
        $fields = [];

        foreach ($image_id_array as $image_id) {
            $image_sub_field = 'field_63ab9ece2d893';
            $description_sub_field = 'field_63ab9f37ed1e2';
            $image_alt = trim(str_replace('_', ' ', get_post_meta($image_id, '_wp_attachment_image_alt', TRUE)));
            $fields[] = [
                $image_sub_field => $image_id,
                $description_sub_field => $image_alt
            ];
        }
        update_field('field_63ab9e7c2d892', $fields, $location_term);
    }

}


//foreach ($locations as $location) {
//    $image_repeater_field = get_field('images', $location->ID);
//
//    if (count($image_repeater_field) === 1) {
//        $image_field = get_field('image_id', $location->ID);
//        $image_id_array = explode(',', $image_field);
//        $no_images[] = $location->ID;

//    if (count($image_repeater_field) === 0 && $image_id_array > 0) {
//        $fields = [];

//        foreach ($image_id_array as $image_id) {
//            $image_sub_field = 'field_63ab9ece2d893';
//            $description_sub_field = 'field_63ab9f37ed1e2';
//            $image_alt = trim(str_replace('_', ' ', get_post_meta($image_id, '_wp_attachment_image_alt', TRUE)));
//            $fields[] = [
//                $image_sub_field => $image_id,
//                $description_sub_field => $image_alt
//            ];
//        }
//        update_field('field_63ab9e7c2d892', $fields, $location->ID);
//    }

//}
