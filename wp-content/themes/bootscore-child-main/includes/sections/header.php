<?php

function heading_color_class(string $text_color = "Light")
{
    return $text_color === 'Light'
        ? ' text-white '
        : ' text-brand-700 ';
}

function subheading_color_class(string $text_color = "Light")
{
    return $text_color === 'Light'
        ? ' text-white '
        : ' text-brand-900 ';
    // return $text_color === 'Light'
    //     ? ' text-secondary-500 '
    //     : ' text-brand-500 ';
}

function header_description_classes(string $text_color = "Light")
{
    return 'font-normal text-pretty text-sm sm:text-base lg:text-lg ' . get_description_color_class($text_color);
}

function header_subheading_classes(string $text_color = "Light")
{
    return 'stylized font-normal text-2xl sm:text-4xl opacity-100 ' . subheading_color_class($text_color);
    // return 'animate-on-scroll stylized font-normal text-2xl sm:text-4xl animate-fade-in-up opacity-100 ' . subheading_color_class($text_color);
    // return 'animate-on-scroll stylized font-normal text-[140%] animate-fade-in-up opacity-100 ' . subheading_color_class($text_color);
}

function header_heading_classes(string $text_color = "Light")
{
    return 'mb-4 text-balance text-2xl font-semibold tracking-tight sm:text-3xl lg:text-4xl col-span-12 ' . heading_color_class($text_color);
    // return 'mb-1 md:leading-normal font-heading font-medium antialiased col-span-12 ' . heading_color_class($text_color);
}

function header_container_text_classes(string $custom_classes = null)
{
    return 'animate-on-scroll';
    // return ' text-2xl md:text-2xl lg:text-3xl ';
}

function header_container_open_center(string $custom_classes = null)
{
    $container_classes = header_container_text_classes() . ' px-8 z-10 relative sm:block text-center';
    return $custom_classes ?? $container_classes;
}

function header_container_open_left(string $custom_classes = null)
{
    $container_classes = header_container_text_classes() . ' max-w-3xl px-8 pb-10 z-10 relative sm:block sm:pb-12 text-left';
    return $custom_classes ?? $container_classes;
}

function section_header_open(string $align = "center")
{
    $header = '<div class="';
    $header .= $align === 'center'
        ? header_container_open_center()
        : header_container_open_left();
    $header .= '">';

    return $header;
}

function section_header_close()
{
    return '</div>';
}

function section_header_description($section, $align = "center")
{
    if (empty($section['heading']['heading_description'])) return '';

    $text_color = $section['heading']['heading_text_color'] ?? 'Light';
    $align_class = $align === 'center'
        ? ' mx-auto'
        : '';

    $header_description = '<div class="mt-5 w-full max-w-xl ' . $align_class . '">';
    $header_description .= '<p class="';
    $header_description .= header_description_classes($text_color) . '">';
    $header_description .= $section['heading']['heading_description'];
    $header_description .= '</div></p>';

    return $header_description;
}

function section_header_subheading($section)
{
    if (empty($section['heading']['heading_subheading'])) return '';

    $text_color = $section['heading']['heading_text_color'] ?? 'Light';

    $header_subheading = '<h2 class="';
    $header_subheading .= header_subheading_classes($text_color) . '">';
    $header_subheading .= $section['heading']['heading_subheading'];
    $header_subheading .= '</h2>';

    return $header_subheading;
}

function section_header_heading($section)
{
    if (!is_array($section['heading']) || empty($section['heading'])) {
       return;
    }

    $text_color = $section['heading']['heading_text_color'] ?? 'Light';

    $header_heading = '<h2 class="';
    $header_heading .= header_heading_classes($text_color) . '">';
    $header_heading .= $section['heading']['heading_heading'];
    $header_heading .= '</h2>';

    return $header_heading;
}

function get_section_header(array $section, string $align = "center")
{
    if (empty($section['heading'])) return null;

    $section_header = section_header_open($align);
    $section_header .= section_header_subheading($section);
    $section_header .= section_header_heading($section);
    $section_header .= section_header_description($section, $align);
    $section_header .= section_header_close();

    return $section_header;
}
