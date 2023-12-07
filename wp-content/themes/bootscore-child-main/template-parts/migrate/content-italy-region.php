<?php
if ( ! is_admin() ) {
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
}

$italy_parent = get_posts(array(
    'post_type' => 'page',
    'p' => '4765'
));

// Top level italy page
foreach ($italy_parent as $italy_page) {

    $italy_title = "Italy";
    $italy_post = get_post($italy_page->ID);

//    populate_italy_location($italy_post, $italy_title);

    $region_child_pages = get_posts(array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'post_status' => 'any',
        'post_parent' => $italy_page->ID,
    ));

    foreach ($region_child_pages as $region_child_page) {
        $italy_child_title = "Italy " . $region_child_page->post_title;
        $italy_child_post = get_post($region_child_page->ID);
        $parent = 30944;

//        populate_italy_location($italy_child_post, $italy_child_title, $parent);
    }


}


