<?php
/**
 * MH Custom Functions (Global Helpers)
 */

function get_section_heading($heading, $sub, $section=true, $color=false)
{
    $text_color = (!$color) ? '' : 'text-' . $color;
    $tag = ($section) ? 'h2' : 'h1';

    $section_heading = '<' . $tag . ' class="' . $text_color . '">' . $heading;

    if ($sub) {
        $section_heading .= '<span class="d-block script display-2 text-brand-500 pt-1">' . $sub . '</span></' . $tag . '>';
    }

    return $section_heading;
}
function get_section_subheading($copy, $classes=null) {
    $class = ($classes) ? $classes : '';

    $subheading  = '<p class="lead fs-4 fw-500 ';
    $subheading .= $class . '">' . $copy;
    $subheading .= '</p>';

    return $subheading;
}
function get_repeater_field_row( $repeater_field, $row_index, $sub_field, $post_id ) {
    $rows = get_field( $repeater_field, $post_id );
    $row_index      = $row_index - 1;

    if ( $rows ) {
        $repeater_field_row = $rows[$row_index];
        $repeater_field  = $repeater_field_row[ $sub_field ];
    }

    return $repeater_field;
}

?>
