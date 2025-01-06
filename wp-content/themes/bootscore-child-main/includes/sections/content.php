<?php
const HEADING_SUFFIX = '_heading';
const CONTENT_SUFFIX = '_content';
const CTA_SUFFIX = '_cta';
const GLOBAL_SET_SUFFIX = '_set';
const USE_GLOBAL_CONTENT_SUFFIX = '_global_content';
const USE_GLOBAL_HEADING_SUFFIX = '_global_heading';
const USE_GLOBAL_CTA_SUFFIX = '_global_cta';

/* region Section Content */
function heading_global($section)
{
    return get_field($section . USE_GLOBAL_HEADING_SUFFIX, get_object_post_id()) ?? null;
}

function content_global($section)
{
    return get_field($section . USE_GLOBAL_CONTENT_SUFFIX, get_object_post_id()) ?? null;
}

function cta_global($section)
{
    return get_field($section . USE_GLOBAL_CTA_SUFFIX, get_object_post_id()) ?? null;
}

function global_content_set($section)
{
    return get_field($section . GLOBAL_SET_SUFFIX, 'option') ?? null;
}

function get_post_section_heading($section)
{
    return get_field($section . HEADING_SUFFIX, get_queried_object_id()) ?? null;
}

function get_post_section_content($section)
{
    return get_field($section . CONTENT_SUFFIX, get_queried_object_id()) ?? null;
}

function get_post_section_cta($section)
{
    $cta_data = get_field($section . CTA_SUFFIX, get_queried_object_id()) ?? null;

    return (!empty($cta_data) && !empty($cta_data['copy']) && !empty($cta_data['link']))
        ? $cta_data
        : null;
}

function get_global_section_heading($section)
{
    return get_field($section . HEADING_SUFFIX, 'option') ?? null;
}

function get_global_section_content($section)
{
    return get_field($section . CONTENT_SUFFIX, 'option') ?? null;
}

function get_global_section_cta($section)
{
    $cta_data = get_field($section . CTA_SUFFIX, 'option') ?? null;
    return $cta_data;

    return (!empty($cta_data) && !empty($cta_data['copy']) && !empty($cta_data['link']))
        ? $cta_data
        : null;
}

function get_cta($section)
{
    if (cta_global($section) && !global_content_set($section)) return null;

    return !cta_global($section)
        ? get_post_section_cta($section)
        : get_global_section_cta($section);
}

function get_heading($section)
{
    if (heading_global($section) && !global_content_set($section)) return null;

    return !heading_global($section)
        ? get_post_section_heading($section)
        : get_global_section_heading($section);
}

function get_content_function($section, $config)
{
    $content_function = $config['function']['name'] ?? null;

    if (isset($content_function) && function_exists($content_function)) {
        $function_args = is_array($config['function']['args']) && !empty($config['function']['args'])
            ? implode(',', $config['function']['args'])
            : '';
        $content = $content_function($function_args);
    }

    return $content ?? null;
}

function get_content($section, $config)
{
    if (content_global($section) && !global_content_set($section)) return null;

    if (!empty($config['function']['name'])) {
        return get_content_function($section, $config);
    }

    // if (!empty($config['key'])) {
    //     return content_global($section)
    //         ? get_global_section_content($section)[$config['key']]
    //         : get_post_section_content($section)[$config['key']];
    // }

    $content = content_global($section)
        ? get_global_section_content($section)
        : get_post_section_content($section);

    return $content;

    return is_array($content)
        ? $content
        : [$content];
}

function get_section_field_data($section, $config)
{
    return
        [
            'name' => $section,
            'heading' => get_heading($section),
            'content' => get_content($section, $config),
            'cta' => get_cta($section, $config)
        ];
}

function get_section_data(array $section_args)
{
    $section_data = [];

    foreach ($section_args as $section => $config) {
        $section_data[] = get_section_field_data($section, $config);
    }

    return $section_data ?? null;
}
