<div class="mt-5">
<?php

//$links = get_field('package_links_legacy', $package_parent->ID);
//$links_array = explode("\n", $links);
//
//if (is_array($links_array)) {
//    $page_id_array = [];
//
//    foreach ($links_array as $link) {
//        $link_page = get_posts(array(
//            'post_type' => 'page',
//            'name' => $link
//        ));
//
//        foreach ($link_page as $page) {
//            $page_id_array[] = $page->ID;
//        }
//    }
//}
//
/*highlight_string("<?php\n\$page_id_array =\n" . var_export($page_id_array, true) . ";\n?>");*/

$parent_ids = [817,54, 41, 89,6,56,152,145,98,58,189,163,4613];
$test_id = [817];

$package_parent_pages = get_posts(array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_status' => ['draft', 'publish'],
    'post__in' => $parent_ids,
    'orderby' => 'rand'
));

//$package_parent_pages = get_posts(array(
//    'post_type' => 'trip',
//    'posts_per_page' => -1,
//    'post_status' => ['draft', 'publish'],
//    'post__in' => [26644],
//    'orderby' => 'rand'
//));

foreach ($package_parent_pages as $package_parent) {
    echo get_the_title($package_parent->ID) . ' (' . $package_parent->ID . ')<br>';
//    $content = get_the_content(null,false,$package_parent->ID);
//    $content_clean = remove_embeds_from_content($content);
//    $featured_image = getLegacyShortcodes($package_parent->ID, ['image_slider']);
//    $package_page_shortcodes = get_array_of_shortcodes($package_parent->ID);
//    $featured_image_id = attachment_url_to_postid($featured_image['image_slider']);
//
//    $custom_fields = [];
//    $custom_fields['image_slider'] = $featured_image['image_slider'];
//    $custom_fields['image_slider_id'] = $featured_image_id;
//    $custom_fields['legacy_page_id'] = $package_parent->ID;
//    $custom_fields['content'] = $content;
//    $custom_fields['content_clean'] = $content_clean;
    

} ?>
</div>