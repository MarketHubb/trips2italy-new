<?php
const HEADING_SUFFIX = '_heading';
const CONTENT_SUFFIX = '_content';
const CTA_SUFFIX = '_cta';
const GLOBAL_SET_SUFFIX = '_set';
const USE_GLOBAL_CONTENT_SUFFIX = '_global_content';
const USE_GLOBAL_HEADING_SUFFIX = '_global_heading';
const USE_GLOBAL_CTA_SUFFIX = '_global_cta';

/* region Template */
function get_section_layout_template($section)
{
    if (!is_array($section) || empty($section['template'])) return null;

    $template = sanitize_key($section['template']);
    $template_val = $section['content']['content_' . $template];
    $template_val = $template_val ?? $template;
    $template_path = 'template-parts/render/content-' . $template_val;

    return locate_template($template_path . '.php')
        ? $template_val
        : null;
}
/* endregion */

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
    return get_field($section . CTA_SUFFIX, get_queried_object_id()) ?? null;
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

    $content = content_global($section)
        ? get_global_section_content($section)
        : get_post_section_content($section);

    // return $content;

    return is_array($content)
        ? $content
        : [$content];
}

function get_section_field_data($section, $config)
{
    $section_data =  [
        'name' => $section,
        'heading' => get_heading($section),
        'content' => get_content($section, $config),
        'cta' => get_cta($section, $config)
    ];

    if (!empty($config) && !empty($config['template'])) {
        $section_data['template'] = $config['template'];
    }

    if (!empty($config) && !empty($config['key'])) {
        $section_data['key'] = $config['key'];
    }

    return $section_data;
}

function get_section_data(array $section_args)
{
    $section_data = [];

    foreach ($section_args as $section => $config) {
        $section_data[] = get_section_field_data($section, $config);
    }
    return $section_data ?? null;
}

/* region Content: Hero & CTA (Section) */

function get_heading_base_classes()
{
    return 'mt-2 text-3xl font-semibold sm:text-4xl md:text-5xl ';
}

function get_subheading_base_classes()
{
    return 'text-2xl font-medium antialiased sm:text-4xl stylized ';
}

function get_description_base_classes()
{
    return 'mt-4 text-base sm:mt-6 sm:text-[1.15rem] leading-[1.75rem] subpixel-antialiased max-w-lg text-pretty inline-block ';
}

function get_description_color_class(string $text_color = "Light")
{
    return $text_color === 'Light'
        ? ' text-white '
        : ' text-brand-800 ';
}

function get_description_classes(string $text_color = "Light")
{
    return get_description_base_classes() . get_description_color_class($text_color);
}
/* endregion */

/* region Content: CTA (Buttons) */
function get_cta_btn_container_open()
{
    return '<div class="mt-10 flex items-center justify-center gap-x-6">';
}

function get_cta_btn_container_close()
{
    return '</div>';
}

function get_cta_btn_base_classes()
{
    return 'px-3.5 py-2.5 text-sm font-semibold rounded-md subpixel-antialiased ';
}

function get_cta_btn_base_classes_primary()
{
    return get_cta_btn_base_classes() . ' relative border border-transparent text-white hover:bg-secondary-600 hover:border hover:border-secondary-600 shadow-md hover:shadow-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary-500 tracking-normal hover:scale-105 ease-linear duration-150 ';
}

function get_cta_btn_gradient_el()
{

    return '<span class="absolute top-0 left-0 w-full h-full rounded-md opacity-50 filter blur-sm bg-gradient-to-br from-secondary-600 to-secondary-400"></span>
         <span class="h-full w-full inset-0 absolute bg-gradient-to-br filter group-active:opacity-0 rounded-md opacity-50 from-secondary-600 to-secondary-400"></span>
         <span class="absolute inset-0 w-full h-full transition-all duration-200 ease-out rounded-md shadow-md bg-gradient-to-br filter group-active:opacity-0 from-secondary-600 to-secondary-400"></span>
         <span class="absolute inset-0 w-full h-full transition duration-200 ease-out rounded-md bg-gradient-to-br to-secondary-600 from-secondary-400"></span>';
}

function get_cta_btn_copy_el(string $btn_copy)
{

    return '<span class="relative">' . $btn_copy . '</span>';
}

function get_cta_btn_base_classes_secondary()
{
    return get_cta_btn_base_classes() . ' text-gray-700 hover:text-gray-800 shadow-sm ring-1 ring-inset ring-gray-300 bg-white/70 hover:bg-gray-50/90 tracking-normal ';
}

function get_cta_btn_copy_primary(array $section)
{
    return !empty($section['cta']['cta_copy'])
        ? $section['cta']['cta_copy']
        : null;
}

function get_cta_btn_link_primary(array $section)
{
    $id = !empty($section['cta']['cta_primary_link'])
        ? $section['cta']['cta_primary_link']
        : null;

    return get_permalink($id) ?? null;
}

function get_cta_btn_copy_secondary(array $section)
{
    return !empty($section['cta']['cta_secondary_copy'])
        ? $section['cta']['cta_secondary_copy']
        : null;
}

function get_cta_btn_link_secondary(array $section)
{
    return !empty($section['cta']['cta_secondary_link'])
        ? $section['cta']['cta_secondary_link']
        : null;
}
/* endregion */