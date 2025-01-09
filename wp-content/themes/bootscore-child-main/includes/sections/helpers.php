<?php
/* region Object */
function is_object_post($queried_object)
{
    return $queried_object instanceof WP_Post;
}

function is_object_tax($queried_object)
{
    return $queried_object instanceof WP_Term;
}

function get_object_post_id($queried_object = null)
{
    return $queried_object->ID ?? get_queried_object_id();
}

function get_object_term_id($queried_object)
{
    return $queried_object->term_id ?? null;
}

function get_object_post_type($queried_object)
{
    return $queried_object->post_type ?? null;
}

function get_object_tax_name($queried_object)
{
    return $queried_object->taxonomy ?? null;
}
/* endregion */

/* region Template */
function section_template_set($section)
{
    if (!is_array($section)) return false;

    return !empty($section['template']);
}

function get_section_template($section)
{
    if (!is_array($section)) return null;

    return !empty($section['template'])
        ? $section['template']
        : null;
}
/* endregion */

/* region Sections */
function get_section_container_parent_key(array $section)
{
    if (!is_array($section) || empty($section)) return null;

    return $section['name'] === 'cta'
        ? 'content'
        : 'heading';
}
/* endregion */

/* region Shared */
function add_classes_to_p($content, $classes = []) {
    if (empty($content)) return '';
    
    // Convert array of classes to space-separated string
    $class_string = is_array($classes) 
        ? implode(' ', array_map('esc_attr', $classes)) 
        : esc_attr($classes);
    
    return preg_replace(
        '/<p>/',
        '<p class="' . $class_string . '">',
        $content
    );
}
/* endregion */
