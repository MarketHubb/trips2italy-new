<?php
/* region::CONTAINER - CTA */
function get_section_cta_container_classes()
{
    return ' relative max-w-3xl px-4 py-4 sm:px-6 lg:px-8 lg:py-6 mx-auto text-center z-20 ';
}
function render_cta_open()
{
   return '<div class="' . get_section_cta_container_classes() . '">';
}

function render_cta_close()
{
   return '</div>';
}
/* endregion */

/* region::CONTAINER - CONTENT */
function render_content_open()
{
    return '<div class="max-w-screen-2xl mx-auto relative z-[30] py-10 lg:py-14">';
}

function render_content_close()
{
    return '</div>';
}
/* endregion */

/* region::CONTAINER - SECTION */
function get_section_open(array $section_data)
{
    $id =  ! empty($section_data['name'])
        ? 'id="' . $section_data['name'] . '"'
        : '';
    $section = '<section ' . $id . ' class="relative px-4 md:px-0 py-16 md:py-24">';
    $section .= render_section_bg_image_container($section_data);

    return $section;
}

function get_section_container_bg_overlay_classes(array $section)
{
    $parent_key = get_section_container_parent_key($section);
    $opacity_key = $parent_key . '_background_image_overlay_copy';
    $color_key = $parent_key . '_background_color';

    $bg_opacity = 'opacity-' . $section[$parent_key][$opacity_key];

    $bg_color = $section[$parent_key][$color_key] === 'Light'
        ? 'bg-white '
        : 'bg-black ';

    return $bg_color . $bg_opacity;
}

function render_section_bg_image_container_classes(array $section)
{
    $classes = 'absolute inset-0 z-10 ';
    $parent_key = get_section_container_parent_key($section);
    $child_key = $parent_key . '_background_image_overlay_copy';

    if (! empty($section[$parent_key][$child_key])) {
        $classes .= get_section_container_bg_overlay_classes($section);
    }

    return $classes;
}

function render_section_bg_image_container(array $section)
{
    $bg_image_container_classes = '';
    $image_el = '';

    if ($section['name'] === 'cta' && is_array($section['content'])) {
        $bg_image = !empty($section['content']['content_image'])
            ? $section['content']['content_image']
            : null;
    }

    if ($section['name'] !== 'cta' && is_array($section['heading'])) {
        $bg_image = !empty($section['heading']['heading_image'])
            ? $section['heading']['heading_image']
            : null;
    }

    if (isset($bg_image) && !empty($bg_image)) {
        $bg_image_container_classes = render_section_bg_image_container_classes($section);
        $image_el = '<img src="' . $bg_image . '" class="absolute inset-0 -z-10 size-full object-cover" />';
    }

    return '<div class="' . $bg_image_container_classes . '"></div>' . $image_el;
}

function get_post_section_container_args(int $post_id, string $section_name)
{
    return get_field($section_name, $post_id) ?? null;
}

function get_global_section_container_args(string $section_name)
{
    return get_field($section_name, 'option') ?? null;
}

function render_section_end()
{
    return '</section>';
}

function render_section_open(array $section)
{
    $id =  ! empty($section['name'])
        ? 'id="' . $section['name'] . '"'
        : '';

    $section_open = '<section ' . $id . ' class="relative px-4 md:px-0 py-16 md:py-24">';
    $section_open .= render_section_bg_image_container($section);

    return $section_open;
}
/* endregion */