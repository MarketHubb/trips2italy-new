<?php 
function acf_load_trip_type_itineraries( $field ) {
    
    // Reset choices
    $field['choices'] = array();
    
    $itineraries = get_posts(array(
    	'post_type' => 'itinerary',
    	'posts_per_page' => -1,
    ));

    foreach($itineraries as $itinerary) {
    	$field['choices'][$itinerary->ID] = get_the_title( $itinerary->ID );
    }

    // Return the field
    return $field;
    
}

add_filter('acf/load_field/key=field_65b95001b43d2', 'acf_load_trip_type_itineraries');
 ?>