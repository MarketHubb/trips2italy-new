<?php
/* region Shared */
function validate_section_content($content, $section_args)
{
    if (isset($content) && array_key_exists('clone_field', $section_args)) {
        $content = $content[$section_args['clone_field']];
    }

    if ($content && !empty($content)) {
        return $content ?? null;
    }
}
/* endregion */

/* region Hero */

function get_hero_data_legacy(int $post_id)
{
    $hero = get_field('hero_banner', $post_id);
    if (empty($hero) || empty($hero['hero_banner_shared'])) {
        return null;
    }

    $shared = $hero['hero_banner_shared'];
    $required_fields = [
        'background_image',
        'mobile_image',
        'hero_heading_2',
        'hero_heading_1',
        'hero_description'
    ];

    foreach ($required_fields as $field) {
        if (empty($shared[$field])) {
            return null;
        }
    }
    $primary_copy = $shared['links_links'][0]['copy'] ?? 'Start my itinerary';
    $primary_link = '/get-custom-itinerary/'; 

    return [
        'image' => $shared['background_image'],
        'mobile_image' => $shared['mobile_image'],
        'heading' => explode(',', $shared['hero_heading_2'])[0],
        'subheading' => explode(',', $shared['hero_heading_1'])[0],
        'description' => preg_split('/\r\n|\r|\n/', $shared['hero_description'])[0],
        'align' => 'center',
        'mobile_align' => 'center',
        'copy_main' => explode(',', $primary_copy)[0],
    ];
}

function get_hero_data(int $post_id)
{
    // $hero = get_field('hero_simple', $post_id);
    $hero = get_field('hero_content', $post_id)['content_hero_content_full'];

    return $hero ?? get_hero_data_legacy($post_id);
}
/* endregion */

/* region review (post) */
function get_reviews_by_image_fields($post_id = null)
{
    // Initialize the meta query array
    $meta_query = array(
        'relation' => 'AND'
    );

    // Add post_trip condition only if post_id is not null
    if ($post_id !== null) {
        $meta_query[] = array(
            'key' => 'post_trip',
            'value' => $post_id,
            'compare' => 'LIKE'
        );
    }

    // Add the rest of the meta query conditions
    $meta_query[] = array(
        'key' => 'background_image',
        'compare' => 'EXISTS',
    );
    $meta_query[] = array(
        'key' => 'background_image',
        'value' => '',
        'compare' => '!='
    );
    $meta_query[] = array(
        'key' => 'square_image',
        'compare' => 'EXISTS',
    );
    $meta_query[] = array(
        'key' => 'square_image',
        'value' => '',
        'compare' => '!='
    );

    // Set up WP_Query arguments
    $args = array(
        'post_type' => 'review',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'orderby' => 'rand',
        'fields' => 'ids',
        'meta_query' => $meta_query
    );

    $query = new WP_Query($args);

    return $query->get_posts();
}
/* endregion */

/* region Trip (Single) */
function get_post_list_section_content($post_type, $post_count, $random = true)
{
    $posts = get_posts([
        'post_type' => $post_type,
        'posts_per_page' => $post_count,
        'orderby' => $random
    ]);

    if ($posts && !empty($posts)) {
        // Transform the posts array to include the 'post_object' key
        return array_map(function ($post) {
            return [
                'post_object' => $post
            ];
        }, $posts);
    }

    return null;
}

function get_post_list_content($section_name)
{
    if (!$section_name) return;

    $content = content_global($section_name)
        ? get_global_section_content($section_name)
        : get_post_section_content($section_name);

    if (!is_array($content) || empty($content['content_post_type'])) return;

    $content_post_type = strtolower($content['content_post_type']);

    $content_key_exists = array_key_exists('content_' . $content_post_type, $content);

    if ($content_key_exists) {
        $content_key = $content_post_type;
    } elseif (!$content_key_exists && array_key_exists('content_' . $content_post_type . 's', $content)) {
        $content_key = $content_post_type . 's';
    }

    if (!$content_key) return null;

    if ($content_key && empty($content['content_' . $content_key]) && post_type_exists($content_post_type)) {
        $post_count = $content['content_post_content'] ?? 6;
        $random = $content['content_random_posts']
            ? 'rand'
            : 'ASC';

        $post_list = get_post_list_section_content($content_post_type, $post_count, $random);
        $content['content_' . $content_key] = $post_list;
    }

    return !empty($content['content_' . $content_key])
        ? $content
        : null;
}

function get_trip_global_section_content($section_args)
{
    $global_section_content = get_field($section_args['content_field'], 'option');

    return validate_section_content($global_section_content, $section_args);
}

function get_trip_post_section_content($section_args)
{
    $post_section_content = get_field($section_args['content_field'], $section_args['post_id']);

    return validate_section_content($post_section_content, $section_args);
}

function get_trip_section_content($section_args)
{
    if (empty($section_args['content_field'])) return;

    $content = get_trip_post_section_content($section_args) ?? get_trip_global_section_content($section_args);

    return $content ?? null;
}
/* endregion */
