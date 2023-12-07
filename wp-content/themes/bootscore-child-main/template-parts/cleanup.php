<?php

/*
  * Assumptions for cleaning up (parent) page regions
  *
  * 1. If the Great Grandparent === Popular Italian Destinations (176)
  *          Grandparent === Italian Travel Guides (Generic)
  *          Parent === Region
  *          Page === City (Main)
  *
  * 2.  If the Great Grandparent === Italian Travel Guides by Region (530)
  *          Grandparent === Region
  *          Parent === City (Main)
  *          Page === City (Tab)
  *
  * */

//if ($great_grandparent->ID === 176) {
//    if (!in_array(get_the_title($parent->ID), $page_regions) && $parent->ID !== 176 ) {
//        $region = get_the_title($parent->ID);
//    }
//
//}
//
//if ($great_grandparent->ID === 530) {
//    if (!in_array(get_the_title($grandparent->ID), $page_regions) && $grandparent->ID !== 176 ) {
//        $region = get_the_title($grandparent->ID);
//    }
//}
//        if (in_array($grandparent->ID, $ancestor_array) || in_array($great_grandparent->ID, $ancestor_array)) {
/*
 *         // TYPE: City (Parent)
//        if ($grandparent->ID === 530 && str_contains(get_the_title($post->ID), 'Ultimate')) {
            // Make sure it's not a region child
//            if (!str_contains(get_the_title($post->ID), get_the_title($post->post_parent))) {

 *
 * Content we need for each City
 *
 * 1) Featured image (DONE)
 *      Image URL
 *      Previous shortcode from SmartSlider
 *
 * 2) Content (DONE)
 *      Without shortcodes
 *
 * 3) Photos (DONE)
 *      By ID's
 *
 * 4) Links (Done)
 *      Array of URLS --> Link Text
 *
 * 5) Reviews
 *
 *
 * */

function testRegex() {
    $text = 'Renowned for its stunning scenery punctuated by the dramatic peaks of the Alps, Aosta is one of those destinations that lingers in the memories of travelers long after they have departed. For those seeking the perfect winter destination or a place to visit that is outside of the typical traveler routes, Aosta will not disappoint.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][vc_tta_tabs style="flat" shape="square" spacing="4" active_section="1" no_fill_content_area="true" el_class="featured-tabs"][vc_tta_section title="Photos" tab_id="1519935034177-210160bd-774d664b-97b4"][vc_gallery type="image_grid" images="1176,1178,1177,2592,7564,7614,12388,7621,7625,12386,12627,12376,7597,15406"][/vc_tta_section][vc_tta_section title="Inquire" tab_id="1519935034297-2e47de16-bdf0664b-97b4"][vc_cta h2="Planning Your Custom Vacation to Aosta Starts Here:"]';
    preg_match_all('/images="([0-9,]*)"/', $text, $matches);
    return explode(",", $matches[1][0]);
}


function getGalleryImageIds($content) {
    $content_array = explode("\n", $content);

    if (!empty($content_array)) {
        foreach ($content_array as $text) {
            return $content_array;
            if (str_contains('[vc_gallery type="image_grid"', $text)) {
                preg_match_all('/images="([0-9,]*)"/', $text, $matches);
                $images = explode(",", $matches[1][0]);
                return $images;
            }
        }
    }
}

function getSliderImage($post_id) {
    $featured = [];
    $custom_fields = base_get_all_custom_fields($post_id);
    if( !empty($custom_fields) ) {
        foreach ($custom_fields as $key => $val) {
            if ($key === 'image_slider') {
                $featured['shortcode'] = $val[0];
                $raw_array = explode('<', do_shortcode($val[0]));
                foreach ($raw_array as $item) {
                    if (str_contains($item, "img src=")) {
                        $url = str_replace('img src="//', '', $item);
                        $featured['url'] = substr($url, 0, strpos($url, '"'));
                    }
                }
            }
        }
    }

    return $featured;
}

function getAttachedImages($post_id) {
    // Get the image gallery shortcode from the post content
    $pattern = get_shortcode_regex();
    preg_match('/'.$pattern.'/s', get_post_field('post_content', $post_id), $matches);
    $shortcode = $matches[0];

    return $shortcode;

    // Extract the image IDs from the shortcode
    preg_match_all('/ids="([^"]+)/', $shortcode, $matches);
    $image_ids = explode(",", $matches[1][0]);

    // Loop through the image IDs and display the images
    foreach($image_ids as $image_id) {
        $image_url = wp_get_attachment_url($image_id);
        echo '<img src="'.$image_url.'" />';
    }
}




$posts_array = array(
    'post_type' => 'page',
    'p' => 24515
);

$cities = get_posts($posts_array);

foreach ($cities as $city) {
    $shortcodes = get_array_of_shortcodes($city->ID);
/*    highlight_string("<?php\n\ $shortcodes =\n" . var_export( $shortcodes, true) . ";\n?>");*/
/*    highlight_string("<?php\n\$shortcodes =\n" . var_export($shortcodes, true) . ";\n?>");*/

/*    highlight_string("<?php\n\$cf =\n" . var_export($cf, true) . ";\n?>");*/
        $legacy_shortcodes = getLegacyShortcodes($city->ID, ['image_slider', 'custom_permalink']);
            if (!empty($legacy_shortcodes)) {
                if (isset($legacy_shortcodes['custom_permalink'])) {
                    $post_array['permalink'] = get_home_url() . '/' . $legacy_shortcodes['custom_permalink'];
                }
                if (isset($legacy_shortcodes['image_slider'])) {
                    $post_array['featured_image'] = $legacy_shortcodes['image_slider'];
                }

            }
            
/*            highlight_string("<?php\n\$legacy_shortcodes =\n" . var_export($legacy_shortcodes, true) . ";\n?>");*/
    

    // Links
    $links_shortcode = do_shortcode('[wudrelated include="1837"]');
    $links = extractLinks($links_shortcode);
    highlight_string("<?php\n\$links_shortcode =\n" . var_export($links_shortcode, true) . ";\n?>");
/*    highlight_string("<?php\n\$links =\n" . var_export($links, true) . ";\n?>");*/

    // Content
    $content = get_the_content(null,false,$city->ID);
    highlight_string("<?php\n\$content =\n" . var_export($content, true) . ";\n?>");
    $content_clean = remove_embeds_from_content($content);
    $images = testRegex();
/*    highlight_string("<?php\n\$images =\n" . var_export($images, true) . ";\n?>");*/
    
    
    // Gallery Images
    $gallery_images = getEmbeddedPageBuilderVals($content, '[vc_gallery type="image_grid"', 'images');
//    $gallery_string = implode(',',$gallery_images);
/*    highlight_string("<?php\n\$gallery_string =\n" . var_export($gallery_string, true) . ";\n?>");*/
    foreach ($gallery_images as $image) {
        $img_atts = wp_get_attachment_image_src($image, 'full');
//        echo '<img src="' . $img_atts[0] . '" />' . '<br>';
    }
    
    // Reviews
    $reviews = getEmbeddedPageBuilderVals($content, '[ultimate-reviews', 'include_category_ids');
/*    highlight_string("<?php\n\$reviews =\n" . var_export($reviews, true) . ";\n?>");*/

    $reviews_shortcode = do_shortcode('[ultimate-reviews include_category_ids="2791"]');
/*    highlight_string("<?php\n\$reviews_shortcode =\n" . var_export($reviews_shortcode, true) . ";\n?>");*/

}




?>

