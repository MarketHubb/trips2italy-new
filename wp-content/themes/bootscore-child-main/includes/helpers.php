<?php
declare(strict_types=1);

/**
 * Parses HTML content, strips out <span> and <strong> tags, and returns an ordered array.
 *
 * @param string $html The HTML content to parse.
 * @return array An ordered array of associative arrays with tag names as keys and text content as values.
 */
function parseContent(string $html): array {
    // Suppress errors due to malformed HTML
    libxml_use_internal_errors(true);

    // Initialize DOMDocument and load the HTML
    $dom = new DOMDocument();
    // Use UTF-8 encoding to handle special characters
    $dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    // Initialize XPath for querying
    $xpath = new DOMXPath($dom);

    // Define the tags you want to extract, maintaining their order
    // Modify this array if you need to include more tags
    $targetTags = ['p', 'h3', 'h4'];

    // Create an XPath query that selects all target tags in document order
    $query = implode(' | ', array_map(function($tag) {
        return "//{$tag}";
    }, $targetTags));

    // Execute the XPath query
    $nodes = $xpath->query($query);

    // Initialize the result array
    $result = [];

    // Iterate through each node in document order
    foreach ($nodes as $node) {
        // Ensure the node is a DOMElement for type hinting
        if ($node instanceof DOMElement) {
            // Remove <span> and <strong> tags within the current node
            removeTags($node, ['span', 'strong']);

            // Get the trimmed text content
            $text = trim($node->textContent);

            // Only add non-empty text
            if (!empty($text)) {
                // Add the element to the result array with tag name as key
                $result[] = [
                    'type' => $node->tagName,
                    'val' => $text
                ];
            }
        }
    }

    // Clear libxml errors
    libxml_clear_errors();

    return $result;
}

/**
 * Removes specified tags from a DOMElement by replacing them with their text content.
 *
 * @param DOMElement $element The element from which to remove tags.
 * @param array $tagsToRemove An array of tag names to remove.
 */
function removeTags(DOMElement $element, array $tagsToRemove): void {
    foreach ($tagsToRemove as $tag) {
        // Get all descendant nodes with the specified tag
        $nodes = $element->getElementsByTagName($tag);

        // Since getElementsByTagName returns a live NodeList, iterate in reverse order to avoid issues
        for ($i = $nodes->length - 1; $i >= 0; $i--) {
            $child = $nodes->item($i);
            if ($child instanceof DOMElement) {
                // Create a text node with the child's text content
                $textNode = $element->ownerDocument->createTextNode($child->textContent);

                // Replace the child with the text node on its actual parent
                if ($child->parentNode) {
                    $child->parentNode->replaceChild($textNode, $child);
                }
            }
        }
    }
}

function get_object_attributes($post_object)
{
    
}

function get_current_url() {
    global $wp;
    return home_url(add_query_arg(array(), $wp->request)) . '/';
}

function get_referring_url() {
    // Check if HTTP_REFERER is set and not empty
    if (!empty($_SERVER['HTTP_REFERER'])) {
        $referrer = filter_var($_SERVER['HTTP_REFERER'], FILTER_SANITIZE_URL);
        
        // Validate the URL
        if (filter_var($referrer, FILTER_VALIDATE_URL)) {
            return $referrer;
        }
    }
    
    // If HTTP_REFERER is not available or invalid, return current page URL
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    
    return "{$protocol}://{$host}{$uri}";
}

function return_portion_of_string($string, $length)
{
    // If the string length is less than or equal to the specified length minus 3 (for the ellipsis),
    // return the original string with the ellipsis
    if (strlen($string) <= $length - 3) {
        return $string . '...';
    }

    // Truncate the string to the specified length minus 3 (to make room for the ellipsis)
    $truncated = substr($string, 0, $length - 3);

    // Find the position of the last space in the truncated string
    $lastSpace = strrpos($truncated, ' ');

    // If a space is found, truncate to that position
    if ($lastSpace !== false) {
        $truncated = substr($truncated, 0, $lastSpace);
    }

    // Add ellipsis
    return $truncated . '...';
}

function change_array_keys($content_fields, $key_map = [])
{
    if (empty($key_map)) return null;

    array_walk($content_fields, function (&$item) use ($key_map) {
        foreach ($key_map as $oldKey => $newKey) {
            if (isset($item[$oldKey])) {
                $item[$newKey] = $item[$oldKey];
                unset($item[$oldKey]);
            }
        }
    });

    return $content_fields;
}
function is_page_and_parent($post_id)
{
    $post = get_post($post_id);

    if (!$post) {
        return false;
    }

    // Check if it's a page and has no parent
    if ($post->post_type === 'page' && $post->post_parent == 0) {
        return true;
    }

    // In all other cases, return false
    return false;
}

function get_nav_active_class($current_object, $nav_id, $nav_text)
{
    $is_page_and_parent = ($current_object->ID && is_page_and_parent($current_object->ID)) ? true : null;

    if ($is_page_and_parent && $current_object->ID === $nav_id) return true;

    $post_type = ($current_object->ID) ? get_post_type($current_object->ID) : null;

    if ($current_object->taxonomy === 'location_region' && $nav_text === 'Destinations') {
        return true;
    }

    if ($post_type ===  'location' && $nav_text === 'Destinations') {
        return true;
    }

    if ($post_type ===  'trip' && $nav_text === 'Trip Types') {
        return true;
    }

    if ($post_type ===  'package' && $nav_text === 'Packages') {
        return true;
    }

    if ($post_type ===  'post' && $nav_text === 'Blog') {
        return true;
    }

    return null;
}


function output_order_testimonials()
{
    $posts_array = [];
    $posts_array['order_by'] = (get_field('order_by', 'option') === 'date_published') ? 'date' : 'title';
    $posts_array['order'] = get_field('order', 'option') ? strtoupper(get_field('order', 'option')) : 'DESC';

    return $posts_array;
}

function related_locations_in_region($object_id, $type)
{
    if ($type === 'post') {
        $location_post = get_post($object_id);
        // $post_parent = $location_post->post_parent;
        $post_terms = get_the_terms($location_post->ID, "location_region");
        $posts__not_in = [$object_id];
        $terms = $post_terms[0]->term_id;
    }

    if ($type === 'taxonomy') {
        $posts__not_in = [];
        $tax = get_term($object_id, 'location_region');
        $terms = $tax->term_id;
    }

    $related_locations = get_posts(array(
        'post_type' => 'location',
        'posts_per_page' => -1,
        'post_parent' => 0,
        'post__not_in' => $posts__not_in,
        'tax_query' => array(
            array(
                'taxonomy' => 'location_region',
                'field' => 'term_id',
                'terms' => $terms
            )
        )
    ));

    return (isset($related_locations) && count($related_locations) > 0) ? $related_locations : null;
}
function custom_copy_or_default($string, $matches, $replace)
{
    return str_replace($matches[0], $replace, $string);
}

function replace_variable_in_copy($string, $dynamic = null, $text_transform = null)
{
    preg_match_all('/{(.*?)}/', $string, $matches);

    if (!empty($matches[0])) {

        $replace_text = $dynamic ?: $matches[1][0];
        $replace_text = ($text_transform === "lower") ? strtolower($replace_text) : $replace_text;
        $replace = '<span class="stylized font-bold">' . $replace_text . '</span>';
        $string  = str_replace($matches[0], $replace, $string);
    }

    return $string ?: null;
}

function customize_itinerary_copy($hero, $refer_id = null)
{
    $dynamic = $hero['dynamic'];
    $hero['copy']['heading_2'] = replace_variable_in_copy($hero['copy']['heading_2'], $dynamic);
    $hero['copy']['description'] = replace_variable_in_copy($hero['copy']['description'], $dynamic, "lower");

    return $hero;
}

function get_desktop_mobile_copy($string, $delimiter = ",", $dynamic = null)
{
    $dynamic = ($dynamic) ?: null;
    $copy = [];

    if (str_contains($string, $delimiter)) {
        $string_array = explode($delimiter, $string);

        if (isset($string_array[0])) {
            $copy['desktop'] = replace_variable_in_copy(trim($string_array[0]), $dynamic);
        }
        if (isset($string_array[1])) {
            $copy['mobile'] = replace_variable_in_copy(trim($string_array[1]) ?: trim($string_array[0]), $dynamic);
        }
    } else {
        $copy['desktop'] = replace_variable_in_copy(trim($string), $dynamic);
    }

    return $copy ?: null;
}

function remove_dashes_from_string($string, $position)
{
    $remove_char_array = ['–', '–', '-', '??',  '&#8211;'];

    foreach ($remove_char_array as $remove_char) {
        $dashPosition = strpos($string, $remove_char);

        if ($dashPosition !== false && $position === "before") {
            $string = substr($string, 0, $dashPosition);
        }
        if ($dashPosition !== false && $position === "after") {
            $string = substr($string, $dashPosition + 1);
        }
    }


    return $string;
}

function get_object_type($object)
{
    return ($object->post_type) ?: $object->taxonomy;
}

function get_object_id($object)
{
    return ($object->post_type) ? $object->ID : $object->term_id;
}

function remove_words_from_string($string, $remove = array())
{
    if ($string && is_array($remove)) {
        foreach ($remove as $word) {
            $string = str_replace($word, "", $string);
        }
    }

    return $string;
}

function remove_dash_from_end_of_string($string)
{
    if (substr($string, -1) === '-') {
        return substr($string, 0, -1);
    }
    return $string;
}

function standardize_postcard_titles($title)
{
    $removal_words = ["...", "-...", "- ..."];
    $title = remove_words_from_string($title, $removal_words);
    $title = remove_dash_from_end_of_string($title);

    return ucwords(str_replace("&", "and", $title));
}

function replace_var_in_string($string, $replace, $var = "{trip}")
{
    if ($replace) {
        $string_array = explode("\n", $string);
        foreach ($string_array as $key => $word) {
            if ($word === $var) {
                $string_array[$key] = $replace;
            }
        }
    }
    return $string_array;
}

function remove_s_from_end_of_string($str)
{
    if (substr($str, -1) == 's') {
        return substr($str, 0, -1);
    }
}

function check_multi_array_for_item($item, $array)
{
    return preg_match('/"' . preg_quote($item, '/') . '"/i', json_encode($array));
}

function clean_text($text)
{
    $text = str_replace("-", "", $text);
    $text = str_replace(";", "", $text);

    return trim($text);
}

function remove_dev_domain_from_url($url)
{
    $domain = get_bloginfo('url');
    $dev_domain = 't2i-new.test';


    if (!str_contains($domain, $dev_domain) && str_contains($url, $dev_domain)) {
        return str_replace($dev_domain, $domain, $url);
    }

    return $url;
}

function get_hero_values($post_id)
{
    $hero = [];
    $post_type = get_post_type($post_id);

    if ($post_type === 'city') {
        $region = get_post_region($post_id);

        $hero['type'] = 'post';
        $hero['region'] = $region[0]->term_id;
        $hero['heading'] = get_the_title($post_id);
        $bg_image = get_field('image_slider_url', $post_id);
        $bg_image = (!$bg_image) ? get_field('featured_image') : null;
        $hero['background_image'] = remove_dev_domain_from_url($bg_image);
        $hero['gallery_string'] = get_field('image_id', $post_id);
        $gallery_ids = explode(',', $hero['gallery_string']);
        foreach ($gallery_ids as $id) {
            $image_attr = wp_get_attachment_image_src($id, 'full')[0];
            $hero['image_attr'][] = $image_attr;
            $hero['hero_masonry_images'][] = array(
                'hero_masonry_image' => $image_attr
            );
        }
    }

    return $hero;
}

function get_tax_hero_values($term)
{
    $hero = [];
    $region = get_post_region($term);

    $hero['type'] = 'post';
    $hero['region'] = $term->term_id;
    $hero['heading'] = get_the_title($term);
    $bg_image = get_field('image_slider_url', $term);
    $bg_image = (!$bg_image) ? get_field('featured_image', $term)['url'] : null;
    $hero['background_image'] = ($bg_image) ?: null;
    $hero['gallery_string'] = get_field('image_id', $term);
    $gallery_ids = explode(',', $hero['gallery_string']);
    foreach ($gallery_ids as $id) {
        $image_attr = wp_get_attachment_image_src($id, 'full')[0];
        $hero['image_attr'][] = $image_attr;
        $hero['hero_masonry_images'][] = array(
            'hero_masonry_image' => $image_attr
        );
    }

    return $hero;
}

function get_children_posts($parent, $return_type = "count")
{
    $parent_id = $parent->ID;
    $post_type = get_post_type($parent_id);

    $children_args = array(
        'post_type' => $post_type,
        'post_parent' => $parent_id,
        'posts_per_page' => -1
    );

    $children = get_posts($children_args);

    return count($children);
}

//region Format / Clean Content

function get_travel_itinerary($content_array)
{

    foreach ($content_array as $key => $content_line) {
        if (str_contains(strtolower($content_line), 'itinerary')) {
            $words_array = explode(" ", $content_line);
            if ($words_array <= 4) {
                $next_key = $key + 1;
                //                return $content_array($key);
            }
        }
    }
}

function extractLinks($text)
{
    $links = array();
    $regex = '/<a href=\'(.*?)\'>(.*?)<\/a>/';
    preg_match_all($regex, $text, $matches);
    for ($i = 0; $i < count($matches[1]); $i++) {
        $link = array(
            'url' => $matches[1][$i],
            'text' => $matches[2][$i]
        );
        array_push($links, $link);
    }
    return $links;
}

// Get all custom fields attached to a page
if (!function_exists('base_get_all_custom_fields')) {
    function base_get_all_custom_fields($post_id)
    {
        global $post;
        $custom_fields = get_post_custom($post_id);
        $hidden_field = '_';
        foreach ($custom_fields as $key => $value) {
            if (!empty($value)) {
                $pos = strpos($key, $hidden_field);
                if ($pos !== false && $pos == 0) {
                    unset($custom_fields[$key]);
                }
            }
        }
        return $custom_fields;
    }
}

function get_array_of_shortcodes($post_id)
{
    $shortcodes = base_get_all_custom_fields($post_id);
    $shortcodes_array = [];

    if (isset($shortcodes)) {
        foreach ($shortcodes as $key => $val) {
            $shortcodes_array[] = array(
                'shortcode_name' => $key,
                'shortcode_value' => $val[0],
            );
        }
    }

    return $shortcodes_array;
}

function pullImageFromShortcode($shortcode_val)
{
    $raw_array = explode('<', do_shortcode($shortcode_val));
    foreach ($raw_array as $item) {
        if (str_contains($item, "img src=")) {
            $url = str_replace('img src="//', '', $item);
            return substr($url, 0, strpos($url, '"'));
        }
    }
}

function getLegacyShortcodes($post_id, $shortcodes = [])
{
    $custom_fields = base_get_all_custom_fields($post_id);
    $legacy_shortcodes_array = [];

    if (is_array($custom_fields) && !empty($custom_fields)) {
        foreach ($custom_fields as $key => $val) {
            if (in_array($key, $shortcodes)) {
                $clean_val = ($key === 'image_slider') ? pullImageFromShortcode($val[0]) : $val[0];
                $legacy_shortcodes_array[$key] = $clean_val;
            }
        }
    }

    return $legacy_shortcodes_array;
}
//endregion

function add_rows_to_acf_repeater($post_id, $field_id, $rows_array)
{
    $existing = get_field($field_id);
    if (!is_array($existing)) $existing = [];

    $updated = $existing + $rows_array;

    update_field($field_id, $updated, $post_id);
}

//region Set Post Taxonomy (Region)
function get_post_region($post_id)
{
    return get_the_terms($post_id, 'region');
}

function simpleRegionTaxList()
{
    $region_list = [];

    $region_terms = get_terms(array(
        'taxonomy' => 'region',
        'hide_empty' => false,
    ));

    foreach ($region_terms as $region) {
        $region_list[$region->name] = $region->term_id;
    }

    return $region_list;
}

function return_region_if_exists($region)
{
    $region_list = simpleRegionTaxList();

    return $region_list[$region] ?? null;
}
//endregion

//region Create / Update Post

function populate_region_location_from_region($location_obj, $region_obj)
{
    $cta_image = get_field('cta_image', $region_obj);
    $callouts = get_field('callouts', $region_obj);
    $featured_image = get_field('featured_image', $region_obj);
    $featured_image_mobile = get_field('featured_image_mobile', $region_obj);
    $region_icon_id = get_field('field_645afaf8e61cf', $region_obj)['ID'];
    $description = $region_obj->description;

    if ($description) {
        wp_update_term($location_obj->term_id, 'location_region', ['description' => $description]);
    }

    if ($region_icon_id) {
        update_field('field_650dd1f8cc003', $region_icon_id, $location_obj);
    }

    if ($cta_image) {
        $post_custom['cta_image'] = array(
            'type' => 'basic',
            'key' => 'field_63cf22c7dc09b',
            'field' => 'cta_image',
            'value' => $cta_image
        );
    }

    if ($callouts) {
        $post_custom['$callouts'] = array(
            'type' => 'basic',
            'key' => 'field_6461148e3fa72',
            'field' => 'callouts',
            'value' => $callouts
        );
    }

    if ($featured_image) {
        $post_custom['$featured_image'] = array(
            'type' => 'basic',
            'key' => 'field_63a4ac920c8e2',
            'field' => 'featured_image',
            'value' => $featured_image
        );
    }

    if ($featured_image_mobile) {
        $post_custom['$featured_image_mobile'] = array(
            'type' => 'basic',
            'key' => 'field_63a4ace50c8e3',
            'field' => 'featured_image_mobile',
            'value' => $featured_image_mobile
        );
    }

    // Populate custom fields
    foreach ($post_custom as $key => $val) {
        update_field($val['key'], $val['value'], $location_obj);
    }
}

function populate_region($post_obj,  $term_obj)
{
    $content = $post_obj->post_content;
    $content_clean = trim(remove_travel_guides_from_content(remove_embeds_from_content($content)));

    $gallery_images = getEmbeddedPageBuilderVals($content, '[vc_gallery type="image_grid"', 'images');
    $legacy_shortcodes = getLegacyShortcodes($post_obj->ID, ['image_slider', 'custom_permalink']);

    if (isset($content_clean)) {
        $post_custom['content_clean'] = array(
            'type' => 'basic',
            'key' => 'field_63ab9e6c2d891',
            'field' => 'content_clean',
            'value' => $content_clean
        );
    }

    if (isset($legacy_shortcodes['image_slider'])) {
        $post_custom['image_slider_url'] = array(
            'type' => 'basic',
            'key' => 'field_63bb47817f913',
            'field' => 'image_slider_url',
            'value' => $legacy_shortcodes['image_slider']
        );
    }

    // FIELDS: Custom (ACF)
    $post_custom['legacy_id'] = array(
        'type' => 'basic',
        'key' => 'field_63aba050495fc',
        'field' => 'legacy_id',
        'value' => $post_obj->ID
    );
    $post_custom['legacy_content'] = array(
        'type' => 'basic',
        'key' => 'field_63aba02486312',
        'field' => 'legacy_content',
        'value' => $post_obj->post_content,
    );
    $post_custom['permalink'] = array(
        'type' => 'basic',
        'key' => 'field_63ab9f6a6d949',
        'field' => 'legacy_permalink',
        'value' => get_the_permalink($post_obj->ID),
    );
    $post_custom['gallery_images'] = array(
        'type' => 'basic',
        'key' => 'field_63c8a880cef99',
        'field' => 'image_id',
        'value' => $gallery_images
    );
    $post_custom['tax_page'] = array(
        'type' => 'basic',
        'key' => 'field_6475704842b80',
        'field' => 'tax_page',
        'value' => true
    );
    $post_custom['standardized_title'] = array(
        'type' => 'basic',
        'key' => 'field_64618f2297f4d',
        'field' => 'standardized_title',
        'value' => format_region_child_page_type($post_obj->ID)
    );

    // Populate custom fields
    foreach ($post_custom as $key => $val) {
        update_field($val['key'], $val['value'], $term_obj);
    }
}

function populate_italy_location($post_obj, $title, $parent = false)
{
    //    $content = get_the_content(null,false,$post_obj->ID);
    //    $content_clean = remove_embeds_from_content($content);
    $content = $post_obj->post_content;
    $content_clean = trim(remove_travel_guides_from_content(remove_embeds_from_content($content)));
    $gallery_images = getEmbeddedPageBuilderVals($content, '[vc_gallery type="image_grid"', 'images');
    $legacy_shortcodes = getLegacyShortcodes($post_obj->ID, ['image_slider', 'custom_permalink']);
    $tax_name = "Italy";
    $tax_id = 5245;
    $custom_tax = array(
        'location_region' => array(
            $tax_id
        )
    );

    $post_core['post_title'] = $title;
    $post_core['post_name'] = urlencode(strtolower(str_replace(" ", "_", $title)));
    $post_core['post_content'] = $post_obj->post_content;
    $post_core['post_author'] = $post_obj->post_author;
    $post_core['post_date'] = $post_obj->post_date;
    $post_core['post_status'] = 'publish';
    $post_core['guid'] = $post_obj->guid;
    $post_core['post_type'] = 'location';
    $post_core['tax_input'] = $custom_tax;

    if ($parent) {
        $post_core['post_parent'] = $parent;
    }

    if (isset($content_clean)) {
        $post_custom['content_clean'] = array(
            'type' => 'basic',
            'key' => 'field_63ab9e6c2d891',
            'field' => 'content_clean',
            'value' => $content_clean
        );
    }

    if (isset($legacy_shortcodes['image_slider'])) {
        $post_custom['image_slider_url'] = array(
            'type' => 'basic',
            'key' => 'field_63bb47817f913',
            'field' => 'image_slider_url',
            'value' => $legacy_shortcodes['image_slider']
        );
    }

    // FIELDS: Custom (ACF)
    $post_custom['legacy_id'] = array(
        'type' => 'basic',
        'key' => 'field_63aba050495fc',
        'field' => 'legacy_id',
        'value' => $post_obj->ID
    );
    $post_custom['legacy_content'] = array(
        'type' => 'basic',
        'key' => 'field_63aba02486312',
        'field' => 'legacy_content',
        'value' => $post_obj->post_content,
    );
    $post_custom['permalink'] = array(
        'type' => 'basic',
        'key' => 'field_63ab9f6a6d949',
        'field' => 'legacy_permalink',
        'value' => get_the_permalink($post_obj->ID),
    );
    $post_custom['gallery_images'] = array(
        'type' => 'basic',
        'key' => 'field_63c8a880cef99',
        'field' => 'image_id',
        'value' => $gallery_images
    );
    $post_custom['tax_page'] = array(
        'type' => 'basic',
        'key' => 'field_6475704842b80',
        'field' => 'tax_page',
        'value' => true
    );
    $post_custom['tax_name'] = array(
        'type' => 'basic',
        'key' => 'field_6475e7f4f624f',
        'field' => 'tax_name',
        'value' => $tax_name
    );
    $post_custom['standardized_title'] = array(
        'type' => 'basic',
        'key' => 'field_64618f2297f4d',
        'field' => 'standardized_title',
        'value' => $post_obj->post_title
    );

    if (isset($post_core) && isset($post_custom)) {
        // Create post
        $post_id = wp_insert_post($post_core);
        if (isset($post_id) && !is_wp_error($post_id)) {
            // Tax
            wp_set_object_terms($post_id, array($tax_id), 'location_region');

            // Populate custom fields
            foreach ($post_custom as $key => $val) {
                update_field($val['key'], $val['value'], $post_id);
            }
        }
    }

    return $post_id;
}

function populate_location($post_obj, $title, $tax_name, $tax_id, $parent = null)
{
    $content = get_the_content(null, false, $post_obj->ID);
    $content_clean = remove_embeds_from_content($content);
    $gallery_images = getEmbeddedPageBuilderVals($content, '[vc_gallery type="image_grid"', 'images');
    $legacy_shortcodes = getLegacyShortcodes($post_obj->ID, ['image_slider', 'custom_permalink']);
    $custom_tax = array(
        'location_region' => array(
            $tax_id
        )
    );

    $post_core['post_title'] = $title;
    $post_core['post_name'] = urlencode(strtolower(str_replace(" ", "_", $title)));
    $post_core['post_content'] = $post_obj->post_content;
    $post_core['post_author'] = $post_obj->post_author;
    $post_core['post_date'] = $post_obj->post_date;
    $post_core['post_status'] = 'publish';
    $post_core['guid'] = $post_obj->guid;
    $post_core['post_type'] = 'location';
    $post_core['tax_input'] = $custom_tax;

    if ($parent) {
        $post_core['post_parent'] = $parent;
    }

    if (isset($content_clean)) {
        $post_custom['content_clean'] = array(
            'type' => 'basic',
            'key' => 'field_63ab9e6c2d891',
            'field' => 'content_clean',
            'value' => $content_clean
        );
    }

    if (isset($legacy_shortcodes['image_slider'])) {
        $post_custom['image_slider_url'] = array(
            'type' => 'basic',
            'key' => 'field_63bb47817f913',
            'field' => 'image_slider_url',
            'value' => $legacy_shortcodes['image_slider']
        );
    }

    // FIELDS: Custom (ACF)
    $post_custom['legacy_id'] = array(
        'type' => 'basic',
        'key' => 'field_63aba050495fc',
        'field' => 'legacy_id',
        'value' => $post_obj->ID
    );
    $post_custom['legacy_content'] = array(
        'type' => 'basic',
        'key' => 'field_63aba02486312',
        'field' => 'legacy_content',
        'value' => $post_obj->post_content,
    );
    $post_custom['permalink'] = array(
        'type' => 'basic',
        'key' => 'field_63ab9f6a6d949',
        'field' => 'legacy_permalink',
        'value' => get_the_permalink($post_obj->ID),
    );
    $post_custom['gallery_images'] = array(
        'type' => 'basic',
        'key' => 'field_63c8a880cef99',
        'field' => 'image_id',
        'value' => $gallery_images
    );
    $post_custom['tax_page'] = array(
        'type' => 'basic',
        'key' => 'field_6475704842b80',
        'field' => 'tax_page',
        'value' => true
    );
    $post_custom['tax_name'] = array(
        'type' => 'basic',
        'key' => 'field_6475e7f4f624f',
        'field' => 'tax_name',
        'value' => $tax_name
    );
    $post_custom['standardized_title'] = array(
        'type' => 'basic',
        'key' => 'field_64618f2297f4d',
        'field' => 'standardized_title',
        'value' => format_region_child_page_type($post_obj->ID)
    );

    //    return $post_custom;

    if (isset($post_core) && isset($post_custom)) {
        // Create post
        $post_id = wp_insert_post($post_core);
        if (isset($post_id) && !is_wp_error($post_id)) {
            // Tax
            wp_set_object_terms($post_id, array($tax_id), 'location_region');

            // Populate custom fields
            foreach ($post_custom as $key => $val) {
                update_field($val['key'], $val['value'], $post_id);
            }
        }
    }

    return $post_id;
}

function insert_term_to_tax($tax, $term, $slug, $parent = null)
{

    if (empty(term_exists($slug, $tax))) {
        if ($parent) {
            wp_insert_term($term, $tax, [
                'slug' => $slug,
                'parent' => $parent
            ]);
        }

        if (!$parent) {
            wp_insert_term($term, $tax, [
                'slug' => $slug,
            ]);
        }
    }
}

function get_taxonomies_for_package($input)
{
    // Normalize input to lowercase and split into words
    $input = strtolower($input);
    $words = explode(' ', $input);

    // Define word categories
    $topics = [
        'Active' => ["active", "excursions", "walking", "trekking", "hiking", "biking", "bike", "horseback", "riding", "ski", "snowboarding"],
        'Art & History' => ["art", "museum", "cultural", "palace", "museums", "gallery", "architectural", "historical", "classical", "poets", "ancient", "old", "colosseum"],
        'Exploration' => ["lake", "shore", "beach", "water", "island", "lakes"],
        'Festivals & Holidays' => ["holidays", "festivals"],
        'Family' => ["family"],
        'Group' => ["group"],
        'Historical' => ["castles"],
        'Premium' => ["deluxe"],
        'Culinary' => ["taste", "wine", "culinary", "cooking", "gourmet", "tasting"],
        'Honeymoon' => ["honeymoon", "honeymoons", "anniversary", "romantic"],
        'Tours' => ["tour", "private", "guided"],
        'Weather' => ["sun", "summer", "winter"],
    ];
    $regions = ["abruzzo", "aosta valley", "apulia", "basilicata", "calabria", "campania", "emilia romagna", "friuli venezia giulia", "lazio", "liguria", "lombardy", "marche", "molise", "piedmont", "sardinia", "sicily", "trentino alto adige", "tuscany", "umbria", "veneto"];

    $matches = [];

    // Iterate over each word in the input
    foreach ($words as $word) {
        // Check each category
        foreach ($topics as $topic => $keywords) {
            if (in_array($word, $keywords) && !in_array($topic, $matches['topics'])) {
                $matches['topic'][] = $topic;
            }
        }
        if (in_array($word, $regions) && !in_array($word, $matches['regions'])) {
            $matches['region'][] = $word;
        }
    }

    return array_unique($matches);
}

function retrive_list_content_from_legacy_page_format($arr, $searchStart, $searchEnd)
{
    $results = array();
    $collect = false;
    $return = [];

    foreach ($arr as $value) {
        if (stripos($value, $searchStart) !== false) {
            $return['start'] = $value;
            $collect = true;
            continue;
        }

        if ($collect && stripos($value, $searchEnd) !== false) {
            $return['end'] = $value;
            $collect = false;
            continue;
        }

        if ($collect) {
            $results[] = $value;
        }
    }

    //    return $return;
    return $results;
}

function does_post_have_children($post_id)
{
    $parent_args = [
        'post_parent' => $post_id
    ];

    $children = get_children($parent_args);
    $children_no_images = [];

    foreach ($children as $child) {
        $mime_type = $child->post_mime_type;

        // Ensure the child post isn't an attached image
        if (!str_contains($mime_type, "image")) {
            $children_no_images[] = $child;
        }
    }

    return (!empty($children_no_images)) ? true : null;
}

function format_post_region($region_id)
{
    $region_post = get_post($region_id);
    $has_children = does_post_have_children($region_post->ID);
    $parent = $region_post->post_parent;
    $grandparent = get_post_parent($region_post->post_parent)->ID;
    $great_grandparent = get_post_parent($parent->ID)->ID;
    $type = null;

    if ($parent === 530) {
        $type = 'region_parent';
    }

    if (!$has_children && $grandparent === 530) {
        $type = "region_child";
    }

    if ($has_children && $grandparent === 530) {
        $type = "city_parent";
    }

    if ($has_children && $great_grandparent === 530) {
        $type = "city_child";
    }

    return $type;
}

function remove_substring($mainString, $subString)
{
    // Remove parent (make sure we're passing a "clean" parent
    return trim(str_replace($subString, '', $mainString));
}

function standardize_ampersands($string)
{
    $string = str_replace("And", "and", $string);
    $string = str_replace("#038;", "and", $string);
    return str_replace("&and", "and", $string);
}

function standardize_to($string)
{
    return preg_replace('/\bTo\b/', 'to', $string);
}

function remove_dashes($string)
{
    $removal_dashes = ['–', '–', '-', '??',  '&#8211;'];

    $string_array = explode(" ", $string);

    foreach ($string_array as $key => $word) {
        if (in_array($word, $removal_dashes)) {
            unset($string_array[$key]);
        }
    }

    $clean_string = '';

    foreach ($string_array as $words) {
        $clean_string .= $words . ' ';
    }

    return trim($clean_string);
}

function standardized_region_titles($city_or_topic, $region)
{
    $city_or_topic = str_replace($region, "", $city_or_topic);
    $city_or_topic = str_replace("#038;", "and", $city_or_topic);
    $city_or_topic = str_replace("&and", "and", $city_or_topic);
    $removal_dashes = ['–', '–', '-', '??',  '&#8211;'];

    $city_or_topic_array = explode(" ", $city_or_topic);

    foreach ($city_or_topic_array as $key => $word) {
        if (in_array($word, $removal_dashes)) {
            unset($city_or_topic_array[$key]);
        }
    }

    $clean_string = '';

    foreach ($city_or_topic_array as $words) {
        $clean_string .= $words . ' ';
    }

    //    return trim($clean_string);
    return trim(htmlspecialchars($clean_string));
}

function remove_substring_from_string($string, $substring)
{
    $position = strpos($string, $substring);
    if ($position !== false) {
        $string = substr($string, 0, $position);
    }
    return trim($string);
}

function retrive_paired_content_from_legacy_page_format($content, $needle)
{
    $results = array();
    $prevKey = null;
    $pattern = '/(?i)Day.*:/';

    foreach ($content as $key => $value) {
        $prevKey = $key;

        if (preg_match($pattern, $value) && strlen($value) <= 100) {
            $day = $value;
            $description = remove_substring_from_string($content[$key + 1], "PACKAGE START");
            $results[] = array('field_6479c0bd47b64' => $value, 'field_6479c0cc47b65' => $description);
        }
    }

    return $results;
}

function retrive_price_from_text_block($content_array = array())
{
    $price = null;

    foreach ($content_array as $text) {
        // Regular expression to find a price
        $pattern = '/\$[0-9,]*(\.[0-9]{2})?/';

        // Use preg_match() function to search the text using the pattern
        preg_match($pattern, $text, $matches);

        // If there is at least one match
        if (!empty($matches)) {
            // Return the first match
            $price = $matches[0];
        }
    }

    return (isset($price)) ? $price : "N/A";
}

function retrive_dollar_amount_from_text_block($content_array = array())
{
    $price = null;
    $pattern = '/\$\S+/';

    foreach ($content_array as $line) {
        preg_match($pattern, $line, $matches);
        $price = $matches[1] ?? "";
    }

    return $price;
}

function pull_content_from_package_pages($content, $type = false)
{
    $package = [];

    if (is_array($content)) {

        // Tabbed content (newer)
        if ($type) {
            $package['description'] = $content[0];
            foreach ($content as $key => $line) {
            }
        }

        // Wildcard content (older)
        elseif (!$type) {
            return "old";
        }
    }
}

function find_city_from_page($post_id)
{
    $posts = get_posts(array(
        'numberposts'   => -1,
        'post_type'     => 'city',
        'meta_key'      => 'legacy_id',
        'meta_value'    => $post_id
    ));

    return $posts;
}

function populateACFCustomField($field_key, $field_name,  $field_val, $post_id)
{
    if (!get_field($field_name, $post_id)) {
        return update_field($field_key, $field_val, $post_id);
    }
}

function check_if_post_exists($post_type, $post_title)
{
    $query_args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1
    );
    return get_posts($query_args);
}

function get_new_post_parent($legacy_parent)
{
    $new_parent = check_if_post_exists('city', get_the_title($legacy_parent));
    if (isset($new_parent) && count($new_parent) === 1) {
        return $new_parent;
    }
}

function create_city($post_core, $post_custom, $needs_parent = false)
{
    // Skip if exists
    $post_exists = count(check_if_post_exists($post_core['post_type'], $post_core['post_title']));
    $parent_count = count($post_core['new_parent']);

    if (!$needs_parent) {
        if ($post_exists === 0) {
            $post_id = wp_insert_post($post_core);
        }
    } else {
        if ($post_exists === 0 && $parent_count === 1) {
            $post_id = wp_insert_post($post_core);
        }
    }



    // If post creation successful, populate region and custom fields
    if (isset($post_id) && !is_wp_error($post_id)) {
        // Region
        $region_id = return_region_if_exists($post_core['region']);
        if (isset($region_id)) {
            wp_set_post_terms($post_id, array($region_id), 'region');
        }
        // Custom
        foreach ($post_custom as $key => $val) {
            if ($val['type'] === "basic") {
                update_field($val['key'], $val['value'], $post_id);
            }
        }
    } else if (is_wp_error($post_id)) {
        echo $post_id->get_error_message();
    }
}
//endregion

function output_readable_post_data($post, $grandparent, $great_grandparent, $i)
{
    $output  = '<p class="mb-0"><span class="fw-bold">Page: </span>' . $i . ') ' . get_the_title() . '(' . $post->ID . ')</p>';
    $output .= '<p class="mb-0"><span class="fw-bold">Parent: </span>' . get_the_title($post->post_parent) . '</p>';

    if ($grandparent) {
        $output .= '<p class="mb-0"><span class="fw-bold">Grandparent: </span>';
        $output .= '<a href="' . get_permalink($grandparent) . '">' . get_the_title($grandparent);
        $output .= '</a> (' . $grandparent->ID . ')</p>';
    }

    if ($great_grandparent) {
        $output .= '<p class="mb-5"><span class="fw-bold">Great Grandparent: </span>';
        $output .= '<a href="' . get_permalink($great_grandparent) . '">' . get_the_title($great_grandparent);
        $output .= '</a> (' . $great_grandparent->ID . ')</p>';
    }

    return $output;
}
