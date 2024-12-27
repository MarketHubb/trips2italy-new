<?php
/* region::Section & Containers */
function get_section_open(array $section_args)
{
    $id =  ! empty($section_args['section_name'])
        ? 'id="' . $section_args['section_name'] . '"'
        : '';

    // $bg_image_section_class = get_section_background_image($section_args)
    //     ? get_section_background_image_class($section_args)
    //     : '';

    $section = '<section ' . $id . ' class="relative px-4 md:px-0 py-16 md:py-24">';
    // $section .= '<div class="' . $bg_image_section_class . '">';
    $section .= get_section_background_image_container($section_args);

    return $section;
}

function get_section_background_image(array $section_args)
{
    $bg_image = $section_args['image']
        ?? get_field($section_args['section_name'], 'option')['image'];

    return $bg_image ?? null;
}

function get_section_background_image_overlay_class(string $overlay)
{
    return match ($overlay) {
        'Light' => 'bg-white opacity-70',
        'Llightest' => 'bg-white opacity-85',
        'Dark' => 'bg-black opacity-70',
        'Darker' => 'bg-black opacity-85',
        default => ''
    };
}

function get_section_background_image_class(array $section_args)
{
    $classes = 'absolute inset-0 z-10 ';

    if ( ! empty($section_args['image_overlay'])) {
        $classes .= get_section_background_image_overlay_class($section_args['image_overlay']);
    }

    return $classes;
}

function get_section_background_image_container(array $section_args)
{
    $bg_image =  ! empty($section_args['image'])
        ? $section_args['image']
        : get_field($section_args['section_name'], 'option')['image'];

    $bg_image_container_class = $bg_image
        ? get_section_background_image_class($section_args)
        : '';

    $container = '<div class="' . $bg_image_container_class . '">';

    if ($bg_image) {
        $container .= '<img src="' . $bg_image . '" class="absolute inset-0 -z-10 size-full object-cover" />';
    }

    return $container;
}

function get_container_open(array $section_args)
{
    $id =  ! empty($section_args['section_name'])
    ? 'id="' . $section_args['section_name'] . '"'
    : '';

    return '<section ' . $id . ' class="relative px-4 md:px-0 py-16 md:py-24">';
}

function get_post_section_args(int $post_id, string $section_name)
{
    return get_field($section_name, $post_id) ?? null;
}

function get_global_section_args(string $section_name)
{
    return get_field($section_name, 'option') ?? null;
}

function get_section_start(int $post_id, string $section_name)
{
    $section_args = get_field($section_name, $post_id)
    ? get_post_section_args($post_id, $section_name)
    : get_global_section_args($section_name);

    if (empty($section_args)) {
        return null;
    }

    $section_args['section_name'] = $section_name;

    return get_section_open($section_args);
    
    // return $section_args;
}

/* endregion */

/* region::Content */

/* endregion */
