<h1>content-packages.php</h1>
<?php
if (!is_admin()) {
    require_once(ABSPATH . 'wp-admin/includes/post.php');
}

$image_array = [];

$packages = get_posts(array(
    'post_type' => 'package',
    'post_status' => 'any',
    'posts_per_page' => -1
));

foreach ($packages as $package) {
    $image_repeater_field = get_field('image_gallery', $package->ID);
    $image_ids_field = get_field('gallery_image_ids', $package->ID);
    $image_id_array = explode(',', $image_ids_field);

    if ($image_id_array > 0) {
        $fields = [];

        foreach ($image_id_array as $image_id) {

            if ($image_id) {
                $image_sub_field = 'field_6596f5f406c18';
                $description_sub_field = 'field_6596f64806c19';
                $image_alt = trim(str_replace('_', ' ', get_post_meta($image_id, '_wp_attachment_image_alt', TRUE)));
                $fields[] = [
                    $image_sub_field => $image_id,
                    $description_sub_field => $image_alt
                ];
            }
        }

        if (count($fields) > 0 && !$image_repeater_field) {
            update_field('field_6596f5a606c17', $fields, $package->ID);    
        }
        
    }
}
