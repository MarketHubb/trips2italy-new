<?php
function sanitize_gform_radio_values($form) {
    // Target only form ID 11
    if ($form['id'] == 11) {
        // Loop through each field in the form
        foreach($form['fields'] as &$field) {
            // Check if the field is of type 'radio' and is field ID 8
            if($field->type == 'radio' && $field->id == 8) {
                // Loop through each choice in the radio field
                foreach($field->choices as &$choice) {
                    // Sanitize the choice text and value by stripping HTML tags
                    $choice['text'] = strip_tags($choice['text']);
                    $choice['value'] = strip_tags($choice['value']);
                }
            }
        }
    }

    // Return the sanitized form
    return $form;
}

// Hook the function to gform_pre_submission_filter
add_filter('gform_pre_submission_filter', 'sanitize_gform_radio_values');

function acf_load_trip_type_itineraries($field)
{

    // Reset choices
    $field['choices'] = array();

    $itineraries = get_posts(array(
        'post_type' => 'itinerary',
        'posts_per_page' => -1,
    ));

    foreach ($itineraries as $itinerary) {
        $field['choices'][$itinerary->ID] = get_the_title($itinerary->ID);
    }

    // Return the field
    return $field;
}

add_filter('acf/load_field/key=field_65b95001b43d2', 'acf_load_trip_type_itineraries');

function acf_load_homepage_region_links($field)
{

    // Reset choices
    $field['choices'] = array();

    $region_terms = get_terms(
        array(
            'taxonomy' => 'location_region',
            'posts_per_page' => -1,
            'hide_empty' => false,
            'parent' => 0
        )
    );

    foreach ($region_terms as $region_term) {
        $tax_link = get_term_link( $region_term );
        $field['choices'][$tax_link] = $region_term->name;

        $location_parent_posts = get_posts(array(
            'post_type' => 'location',
            'posts_per_page' => -1,
            'parent' => 0,
            'tax_query' => array(
                array(
                    'taxonomy' => 'location_region',
                    'field' => 'term_id',
                    'terms' => $region_term->term_id
                ),
            ),
        ));

        foreach ($location_parent_posts as $location_parent_post) {
            $post_link = get_permalink( $location_parent_post );
            $field['choices'][$post_link] = get_the_title( $location_parent_post->ID );
        }
    }

    // Return the field
    return $field;
}

add_filter('acf/load_field/key=field_65dfd794bb78f', 'acf_load_homepage_region_links');
