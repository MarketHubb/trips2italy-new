<?php
function get_flexible_section_type($fields)
{
    return $fields['acf_fc_layout'] ?? null;
}

function get_flexible_section_id($fields)
{
    return  ! empty($fields['layout_settings']['container']['unique_id'])
    ? $fields['layout_settings']['container']['unique_id']
    : null;
}

function get_flexible_section_name($fields)
{
    return $fields['acf_fc_layout'];
}

function get_flexible_section_layout($fields)
{
    return $fields['content_layout'] ?? '';
}

function get_flexible_section_template($fields)
{
    $type   = get_flexible_section_type($fields);
    $layout = get_flexible_section_layout($fields);

    if (empty($layout)) {
        return $type;
    }

    return $type . '-' . $layout;
}

function get_flexible_section_content($fields)
{
    $type = get_flexible_section_type($fields);
    $key  = 'content_' . $type;

    if ( ! $type || empty($fields[$key])) {
        return null;
    }

    $content = $fields[$key];

    if (get_flexible_section_name($fields) === 'hero') {
        $content['overlay']    = $fields['layout_settings']['container']['overlay'] ?? null;
        $content['opacity']    = $fields['layout_settings']['container']['opacity'] ?? null;
        $content['text_color'] = $fields['layout_settings']['text_color'] ?? null;
    }

    if (get_flexible_section_name($fields) === 'tabs') {
        $content = ['content_feature_panels' => $content];
    }

    return $content;
}

function get_flexible_mobile_cols($fields)
{
    return $fields['content_mobile_cols'] ?? null;
}

function get_flexible_desktop_cols($fields)
{
    return $fields['content_desktop_cols'] ?? null;
}

function get_flexible_section_grid($fields)
{
    return [
        'mobile_cols'  => get_flexible_mobile_cols($fields),
        'desktop_cols' => get_flexible_desktop_cols($fields),
    ];
}

function transform_flexible_fields_heading($fields)
{
    return [
        'heading_text_color'                    => $fields['layout_settings']['heading']['text_color'] ?? '',
        'heading_background_image_overlay'      => $fields['layout_settings']['container']['overlay'] ?? '',
        'heading_background_image_overlay_copy' => $fields['layout_settings']['container']['opacity'] ?? '',
        'heading_overlay_direction'             => 'Bottom Top',
        'heading_background_color'              => $fields['layout_settings']['container']['overlay'] ?? '',
        'header_image'                         => $fields['layout_settings']['heading']['header_image'] ?? '',
        'header_layout'                        => $fields['layout_settings']['heading']['header_layout'] ?? '',
        'heading_mobile_image'                  => $fields['layout_settings']['container']['mobile_image'] ?? '',
        'heading_heading'                       => $fields['layout_settings']['heading']['heading'] ?? '',
        'heading_subheading'                    => $fields['layout_settings']['heading']['subheading'] ?? '',
        'heading_description'                   => $fields['layout_settings']['heading']['description'] ?? '',
    ];
}

function transform_flexible_fields_cta($fields)
{
    return [
        'cta_copy'             => $fields['layout_settings']['cta']['copy'] ?? '',
        'cta_primary_link'     => $fields['layout_settings']['cta']['primary_link'] ?? false,
        'cta_secondary_button' => $fields['layout_settings']['cta']['secondary_button'] ?? false,
        'cta_secondary_copy'   => $fields['layout_settings']['cta']['secondary_copy'] ?? '',
        'cta_secondary_link'   => $fields['layout_settings']['cta']['secondary_link'] ?? false,
        'cta_callout'          => $fields['layout_settings']['cta']['callout'] ?? '',
    ];
}

function get_flexible_section_data($fields)
{
    $type = get_flexible_section_type($fields);

    if ( ! $type) {
        return null;
    }

    return [
        'name'     => get_flexible_section_name($fields),
        'layout'   => get_flexible_section_layout($fields),
        'template' => get_flexible_section_template($fields),
        'heading'  => transform_flexible_fields_heading($fields),
        'cta'      => transform_flexible_fields_cta($fields),
        'content'  => get_flexible_section_content($fields),
        'grid'     => get_flexible_section_grid($fields),
    ];
}
