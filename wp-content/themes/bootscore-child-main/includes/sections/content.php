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

    $template_val = null;
    $template = sanitize_key($section['template']);

    if (is_array($section['content'])) {
        $template_val = $section['content']['content_' . $template];
    }

    $template_val = $template_val ?? $template;
    $template_path = 'template-parts/render/content-' . $template_val;

    return locate_template($template_path . '.php')
        ? $template_val
        : null;
}
/* endregion */

// region Cards
function output_card_heading(string $heading)
{
    return $heading
        ? '<h2 class="text-lg font-bold text-gray-800">' . esc_html($heading) . '</h2>'
        : '';
}

function output_card_subheading(string $subheading)
{
    return $subheading
        ? '<h3 class="text-xl subpixel-antialiased md:text-2xl tracking-wide stylized">' . esc_html($subheading) . '</h3>'
        : '';
}

function output_card_description(string $description)
{
    return $description
        ? '<p class="mt-1 text-gray-500">' . esc_html($description) . '</p>'
        : '';
}
// endregion

// region FLEXIBLE
function get_grid_container($args)
{
    $mobile_cols = isset($args['grid']['mobile_cols']) ? $args['grid']['mobile_cols'] : '1';
    $desktop_cols = isset($args['grid']['desktop_cols']) ? $args['grid']['desktop_cols'] : '1';

    return sprintf(
        '<div class="grid grid-cols-%s md:grid-cols-%s gap-4 md:gap-6">',
        esc_attr($mobile_cols),
        esc_attr($desktop_cols)
    );
}

function flexible_content(int $post_id)
{
    $post_id = $post_id ?? get_queried_object_id();

    return get_field('content', $post_id);
}
// endregion

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
    if ($section === 'hero') {
        return get_field('hero_content', get_queried_object_id())['content_hero_cta'] ?? null;
    }

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

    $key = $config['key'];

    $content = is_array($content)
        ? $content
        : [$content];

    if (!array_key_exists('key', $config) && !empty($content)) {
        return $content;
    }

    return array_key_exists('key', $config) && !empty($content[$config['key']])
        ? $content
        : null;
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

/* region Content: HERO */
function get_hero_description_desktop_classes()
{

    return 'hidden sm:block text-gray-200 sm:mt-6 sm:text-[1.15rem] sm:leading-[1.75rem] subpixel-antialiased max-w-lg text-left ';
}

function get_hero_description_mobile_classes()
{

    return 'block sm:hidden text-gray-200 mt-0 text-sm  subpixel-antialiased max-w-lg text-left ';
}

function get_hero_description($content)
{
    return $content['description'] ?? null;
}

function get_hero_use_mobile_description($content)
{
    return $content['use_mobile_description'] ?? null;
}

function get_hero_mobile_description($content)
{
    return get_hero_use_mobile_description($content) && !empty($content['mobile_description'])
        ? $content['mobile_description']
        : get_hero_description($content);
}
/* endregion */

/* region Content: CTA */
function get_cta_btn_container_open()
{
    return '<div class="mt-10 mb-4 px-2 sm:px-0 sm:mx-0 flex flex-col sm:flex-row w-full items-center justify-center gap-x-6 z-30 relative">';
}

function get_cta_btn_container_open_hero()
{
    return '<div class="mt-10 mb-4 px-2 sm:px-0 sm:mx-0 flex flex-col sm:flex-row w-full items-center justify-start gap-x-6 z-30 relative">';
}

function get_cta_btn_container_close()
{
    return '</div>';
}

function get_cta_btn_base_classes()
{
    return 'min-w-full sm:min-w-20 md:min-w-32 lg:min-w-44 text-center inline-block px-6 py-2.5 text-sm font-bold rounded-md antialiased ';
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

    return '<span class="relative text-center w-full inline-block">' . $btn_copy . '</span>';
}

function get_cta_btn_callout_el(array $section)
{
    $callout_field = $section['cta']['cta_callout'] ?? null;

    if (!$callout_field) return;

    $text_color = $section['heading']['heading_text_color'] ?? 'Light';
    $text_color_class = get_description_color_class($text_color);

    $callout = '<div class="relative z-30 mx-auto max-w-lg text-center mt-5 ' . $text_color_class . '">';
    $callout .= add_classes_to_p($callout_field, ['font-semibold', '!subpixel-antialiased']);
    $callout .= '</div>';

    return $callout;
}

function get_cta_btn_base_classes_secondary()
{
    return get_cta_btn_base_classes() . ' text-gray-700 hover:text-gray-800 shadow-sm ring-1 ring-inset ring-gray-300 bg-white/90 hover:bg-gray-200 tracking-normal ';
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

function get_cta_btn_secondary_active(array $section)
{
    if (empty($section['cta']['cta_secondary_button'])) return null;

    return $section['cta']['cta_secondary_button'];
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