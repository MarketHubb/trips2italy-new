<?php
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
