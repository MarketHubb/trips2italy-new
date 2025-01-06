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
    return '<div class="max-w-7xl mx-auto relative z-[30]">';
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

function get_section_container_bg_overlay_classes(string $overlay_field)
{
    return match ($overlay_field) {
        'Light' => 'bg-white opacity-70',
        'Llightest' => 'bg-white opacity-85',
        'Dark' => 'bg-black opacity-70',
        'Darker' => 'bg-black opacity-85',
        default => ''
    };
}

function render_section_bg_image_container_classes(array $section_data)
{
    $classes = 'absolute inset-0 z-10 ';

    if (! empty($section_data['heading']['heading_background_image_overlay'])) {
        $classes .= get_section_container_bg_overlay_classes(
            $section_data['heading']['heading_background_image_overlay']
        );
    }

    return $classes;
}

function render_section_bg_image_container(array $section_data)
{
    $bg_image_container_classes = '';
    $bg_image = '';

    if (!empty($section_data['heading']['heading_image'])) {
        $bg_image_container_classes = render_section_bg_image_container_classes($section_data);
        $bg_image = '<img src="' . $section_data['heading']['heading_image'] . '" class="absolute inset-0 -z-10 size-full object-cover" />';
    }

    return '<div class="' . $bg_image_container_classes . '"></div>' . $bg_image;
}

function get_post_section_container_args(int $post_id, string $section_name)
{
    return get_field($section_name, $post_id) ?? null;
}

function get_global_section_container_args(string $section_name)
{
    return get_field($section_name, 'option') ?? null;
}

function render_section_close()
{
    return '</section>';
}

function render_section_open(array $section_data)
{
    $id =  ! empty($section_data['name'])
        ? 'id="' . $section_data['name'] . '"'
        : '';
    $section = '<section ' . $id . ' class="relative px-4 md:px-0 py-16 md:py-24">';
    $section .= render_section_bg_image_container($section_data);

    return $section;
}
/* endregion */