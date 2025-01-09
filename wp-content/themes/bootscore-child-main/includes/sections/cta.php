<?php
function get_section_cta_btn_classes()
{
    return 'inline-block bg-secondary-500 relative rounded-full border border-transparent px-6 py-1.5 sm:py-2.5 text-base font-semibold antialiased text-white shadow-sm hover:bg-secondary-600 hover:border hover:border-secondary-600 hover:shadow-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary-500 tracking-normal hover:scale-105 ease-linear duration-150 ';
}


function render_section_cta_btn(array $section)
{
    if (empty($section) || empty($section['content']['copy_main'])) return null;

    $args = [
        'cta' => [
            'copy' => $section['content']['copy_main']
        ],
    ];

    return tw_cta_btn_link($args); 

    $href = '/get-custom-itinerary/';

    $btn = '<a class="' . get_section_cta_btn_classes() . ' href="' . $href . '">';
    $btn .= '<span class="font-bold antialiased">' . $section['content']['copy_main'] . '</span>';
    $btn .= '</a>';

    return $btn;
}

function output_section_cta(array $section_data)
{
    $cta_args = $section_data['cta'];

    if (empty($cta_args) || empty($cta_args['copy'])) {
        return '';
    }

    $callout_color = $section_data['header']['text_color'] === 'Dark' ? ' text-gray-800 ' : ' text-white ';
    $cta_url = 'https://www.trips2italy.com/get-custom-itinerary/';

    return sprintf(
        '<div class="max-w-3xl px-4 sm:px-6 lg:px-8 mx-auto text-center relative">
            <a href="%1$s" class="inline-block relative rounded-full border border-transparent px-6 py-1.5 sm:py-2.5 text-base font-semibold antialiased text-white shadow-sm hover:bg-secondary-600 hover:border hover:border-secondary-600 hover:shadow-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary-500 tracking-normal hover:scale-105 ease-linear duration-150">
                <span class="absolute top-0 left-0 w-full h-full rounded-full opacity-50 filter blur-sm bg-gradient-to-br from-secondary-600 to-secondary-400"></span>
                <span class="h-full w-full inset-0 absolute mt-0.5 ml-0.5 bg-gradient-to-br filter group-active:opacity-0 rounded-full opacity-50 from-secondary-600 to-secondary-400"></span>
                <span class="absolute inset-0 w-full h-full transition-all duration-200 ease-out rounded-full shadow-xl bg-gradient-to-br filter group-active:opacity-0 from-secondary-600 to-secondary-400"></span>
                <span class="absolute inset-0 w-full h-full transition duration-200 ease-out rounded-full bg-gradient-to-br to-secondary-600 from-secondary-400"></span>
                <span class="relative">%2$s</span>
            </a>
            %3$s
        </div>',
        esc_url($cta_url),
        esc_html($cta_args['copy']),
        !empty($cta_args['callout'])
            ? sprintf(
                '<p class="text-sm sm:text-[.9rem] mt-6 relative font-medium tracking-normal leading-relaxed %s">%s</p>',
                esc_attr($callout_color),
                esc_html($cta_args['callout'])
            )
            : ''
    );
}

function render_cta(array $section_data)
{
    if (empty($section_data['cta'])) return;

    $cta = render_cta_open();
    $cta .= output_section_cta($section_data);
    $cta .= '</div>';

    return $cta;
}
