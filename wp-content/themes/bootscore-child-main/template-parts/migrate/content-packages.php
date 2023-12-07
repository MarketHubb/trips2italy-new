<?php
$i = 1;

$package_parent_pages = get_posts(array(
   'post_type' => 'page',
   'posts_per_page' => -1,
    'post_parent' => 628
));
$package_parent_ids = [];
$package_post_type_array = [];

foreach($package_parent_pages as $package_parent) {
    $package_parent_ids[] = $package_parent->ID;
}

$package_pages = get_posts(array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_status' => ['draft', 'publish'],
    'post_parent__in' => $package_parent_ids,
    'orderby' => 'rand'
));

foreach ($package_pages as $package_page) {
    // Taxonomy - Page Categories (categories)
    $cats = get_the_terms($package_page->ID, 'categories');
    $cats_id_array = [];

    if (is_array($cats) && count($cats) > 0) {
        foreach ($cats as $cat) {
            $cats_id_array[] = $cat->term_id;
        }
    }

    $package_posts = get_posts(array(
        'post_type' => 'package',
        'posts_per_page' => -1,
        'post_status' => ['draft', 'publish']
    ));

    
    foreach ($package_posts as $package_post) {
        $package_page_title = html_entity_decode(get_the_title($package_page->ID));
        $package_post_title = html_entity_decode(get_the_title($package_post->ID));
        $id_in_array = check_multi_array_for_item($package_post->ID, $package_post_type_array);
        $duplicates_array = [24834,28097,28108,27873,1079];
        
        if (false) {
//        if (!in_array($package_page->ID, $duplicates_array) && !in_array($package_post->ID, $duplicates_array)) {
            if ($package_page_title === $package_post_title) {
                $package_post_type_array[$package_post->ID] = $cats_id_array;
                wp_set_post_terms($package_post->ID, $cats_id_array, 'categories');
                update_field('field_6479cc031513c', $package_page->ID, $package_post->ID);
//                $package_post_type_array[] = [$package_page->ID => $package_post->ID];
            }
        }
    }
    
    // UPDATE PACKAGE POST WITH PAGE ID & PAGE CATEGORIES
    

    
    

    $title = (string)get_the_title($package_page->ID);
    $years = "2021 – 2022";
    $year_position = stripos($title, "2021 – 2022");

    $post_content = [];
    $package_page_shortcodes = get_array_of_shortcodes($package_page->ID);
    $short_code_count = count($package_page_shortcodes);
    $content = get_the_content(null,false,$package_page->ID);
    $content_array = explode("\n", $content);
    $content_clean = remove_embeds_from_content($content);
    $clean_content_array = explode("\n", $content_clean);
    $clean_content_array = array_values(\array_filter($clean_content_array, static function ($element) {
        return $element !== "";
    }));

    $content_array_no_tags = [];

    foreach ($clean_content_array as $text) {
        $content_array_no_tags[] = wp_strip_all_tags($text);
    }

    $tabbed_content_identifier = '[vc_tta_tabs';
    $tabbed_content_position = strpos($content,$tabbed_content_identifier);

    $custom_fields['page_id'] = $package_page->ID;
    $custom_fields['description'] = $content_array_no_tags[0];
    $custom_fields['package_itinerary'] = retrive_paired_content_from_legacy_page_format($content_array_no_tags, 'day');
    $custom_fields['package_includes_list'] = retrive_list_content_from_legacy_page_format($content_array_no_tags, 'package start', 'general condition');
    $custom_fields['package_general_conditions'] = retrive_list_content_from_legacy_page_format($content_array_no_tags, 'general condition', 'related trip');
    $custom_fields['price'] = retrive_price_from_text_block($content_array_no_tags);
    $post_content['taxonomies'] = get_taxonomies_for_package(get_the_title($package_page->ID));

    $custom_fields['image_slider'] =  getLegacyShortcodes($package_page->ID, ['image_slider'])['image_slider'];
    $custom_fields['featured_image'] = get_post_thumbnail_id($package_page->ID);
    $custom_fields['image_gallery_ids'] = getEmbeddedPageBuilderVals($content, '[vc_gallery type="image_grid"', 'images');

//    if ($tabbed_content_position) {
    if (false) {

        $post_core['post_title'] = get_the_title($package_page->ID);
        $post_core['post_status'] = 'draft';
        $post_core['post_type'] = 'package';

        $post_exists = count(check_if_post_exists($post_core['post_type'], $post_core['post_title']));

        if ($post_exists === 0) {
            $post_id = wp_insert_post($post_core);
        }

        // Custom fields if post is created
//        if (isset($post_id) && !is_wp_error($post_id)) {
            if (false) {

            // Taxonomies
            if ($post_content['taxonomies']['topic']) {
                wp_set_post_terms($post_id, $post_content['taxonomies']['topic'], 'topic');
            }
            if ($post_content['taxonomies']['region']) {
                wp_set_post_terms($post_id, $post_content['taxonomies']['region'], 'region');
            }

            // Page ID
            if ($custom_fields['page_id']) {
                update_field('field_6479cc031513c', $custom_fields['page_id'], $post_id);
            }
            // Description
            if ($custom_fields['description']) {
                update_field('field_6479432d387a7', $custom_fields['description'], $post_id);
            }
            // Gallery ID's
            if ($custom_fields['image_gallery_ids']) {
                update_field('field_6479440979560', $custom_fields['image_gallery_ids'], $post_id);
            }
            // Featured Image
            if ($custom_fields['featured_image']) {
                update_field('field_64794347e544a', $custom_fields['featured_image'], $post_id);
            }
            // Slider
            if ($custom_fields['image_slider']) {
                update_field('field_6479441b79561', $custom_fields['image_slider'], $post_id);
            }
            // Price
            if ($custom_fields['price']) {
                update_field('field_6479c8cbf003e', $custom_fields['price'], $post_id);
            }

            // Itinerary
            if ($custom_fields['package_itinerary']) {
                update_field('field_64794464bce7d', $custom_fields['package_itinerary'], $post_id);
            }

            // Includes
            if ($custom_fields['package_includes_list']) {
                $include_rows = [];

                foreach ($custom_fields['package_includes_list'] as $item) {
                    $include_rows[] = ['field_6479c90df0040' => $item];
                }

                update_field('field_6479c8daf003f', $include_rows, $post_id);

            }

            // Conditions
            if ($custom_fields['package_general_conditions']) {
                $condition_rows = [];

                foreach ($custom_fields['package_general_conditions'] as $item) {
                    $condition_rows[] = ['field_6479c932163a7' => $item];
                }

                update_field('field_6479c923163a6', $condition_rows, $post_id);

            }

        }

    } // End if (tabbed)

}
//echo count($package_post_type_array);
/*highlight_string("<?php\n\$package_post_type_array =\n" . var_export($package_post_type_array, true) . ";\n?>");*/
    

?>
