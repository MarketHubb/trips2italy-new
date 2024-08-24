<h1>content-location-images.php</h1>
<?php
error_log('Debugging started');
if ( ! is_admin() ) {
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
}

$packages_test = get_posts(array(
    'post_type' => 'package',
    'posts_per_page' => -1,
));

foreach ($packages_test as $package) {
    $image_repeater_field = get_field('images', $package->ID);
    $image_ids_list = get_field('gallery_image_ids', $package->ID);
    $image_id_array = explode(',', $image_ids_list);

    if (!$image_repeater_field && count($image_id_array) > 0) {
        $fields = [];

        foreach ($image_id_array as $image_id) {
            $image_id = trim($image_id); // Ensure no whitespace around IDs
            if (is_numeric($image_id)) { // Check if the ID is a valid number
                $image_sub_field = 'field_6481074a9d488';
                $description_sub_field = 'field_648107559d489';
                $image_alt = trim(str_replace('_', ' ', get_post_meta($image_id, '_wp_attachment_image_alt', TRUE)));
                $fields[] = [
                    $image_sub_field => (int) $image_id, // Convert ID to integer
                    $description_sub_field => $image_alt
                ];
            }
        }        
        if (!empty($fields)) { // Ensure there are fields to update
            update_field('field_6481073c9d487', $fields, $package->ID);
        }
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
