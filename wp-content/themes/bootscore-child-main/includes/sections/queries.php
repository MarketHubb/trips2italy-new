<?php
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

/* region trip (post) */
// function get_section_header_data($section_args)
// {
//     if (empty($section_args['post_id'])) return null;

//     return ! use_heading_global_options($section_args)
//         ? get_post_section_container_args($section_args['post_id'], $section_args['section_name'])
//         : get_global_section_container_args($section_args['section_name']);
// }

function validate_section_content($content, $section_args)
{
     if (isset($content) && array_key_exists('clone_field', $section_args)) {
        $content = $content[$section_args['clone_field']];
    } 

    if ($content && !empty($content)) {
        return $content ?? null;
    }
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
