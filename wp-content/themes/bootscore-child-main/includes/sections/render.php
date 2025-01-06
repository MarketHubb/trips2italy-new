<?php
/* region:: Containers */
/* endregion */

/* single-trip */
function get_formatted_testominal_vars($review_id)
{
    if (!$review_id || !get_post($review_id)) {
        return null;
    }

    $bg_gradient_field = get_field('image_background_color', $review_id);
    $bg_gradient = $bg_gradient_field !== 'Light' && $bg_gradient_field !== 'Dark'
        ? 'from-' . sanitize_html_class(strtolower($bg_gradient_field)) . '-950'
        : 'from-blue-950';
    $text_color = get_field('image_background_color', $review_id) === 'Light' ? ' text-gray-800 ' : ' text-white ';

    $square_image = get_field('square_image', $review_id);
    $background_image = get_field('background_image', $review_id);

    return [
        'review_id' => absint($review_id),
        'sq_image' => isset($square_image['url']) ? esc_url($square_image['url']) : '',
        'image' => isset($background_image['url']) ? esc_url($background_image['url']) : '',
        'bg_gradient' => sanitize_html_class($bg_gradient),
        'text_color' => sanitize_html_class($text_color),
        'excerpt' => wp_kses_post(get_field('excerpt', $review_id)),
        'author' => esc_html(get_substring_before_dash(get_the_title($review_id))),
        'regions' => get_field('post_location', $review_id)
    ];
}

function render_section_testimonials(array $content)
{
    // $output = render_content_open();
    $output  = '<ul class="flex lg:grid lg:grid-cols-4 lg:justify-center lg:content-center snap-slider snap-x snap-mandatory gap-x-6 lg:gap-x-10 pb-16 overflow-x-auto relative bottom-8">';
    $output .= '<li class="lg:hidden rounded-xl w-0 flex-shrink-0 snap-center opacity-65 transition-all duration-300 ease-in-out"></li>';

    foreach ($content as $review_id) {
        $testimonial_vars = get_formatted_testominal_vars($review_id);
        if (!$testimonial_vars) continue;

        $regions = '';

        $output .= sprintf(
            '<li class="snap-item rounded-xl w-10/12 lg:w-full flex-shrink-0 ring-0 snap-center opacity-65 lg:opacity-100 transition-all duration-300 ease-in-out pt-8 sm:pt-0">
                <div class="flex justify-center -mb-6 z-40 relative">
                    <img src="%1$s" alt="%2$s" class="shadow-lg ring-1 ring-white shadow-white/50 rounded-full max-w-20 max-h-20 relative">
                </div>
                <div class="flex flex-col h-full rounded-xl p-3 transition-all duration-300 ease-in-out transform bg-cover bg-center overflow-hidden lg:shadow-md">
                    <div class="absolute inset-0 bg-cover bg-top lg:bg-bottom" style="background-image: url(%3$s);"></div>
                    <div class="absolute inset-0 h-full w-full bg-gradient-to-b %4$s from-[25%%]"></div>
                    <div class="flex flex-col h-full items-center justify-start px-3 overflow-visible z-10 pt-8">
                        <div class="mt-2 rating mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <div class="text-white pb-[8rem]">
                            <p class="my-4 text-base">"%5$s"</p>
                            <div class="text-left justify-start w-full">
                                <p class="d-inline font-bold text-sm">%6$s</p>',
            esc_url($testimonial_vars['sq_image']),
            esc_attr(sprintf('Testimonial from %s', $testimonial_vars['author'])),
            esc_url($testimonial_vars['image']),
            esc_attr($testimonial_vars['bg_gradient']),
            wp_kses_post($testimonial_vars['excerpt']),
            esc_html($testimonial_vars['author'])
        );

        if (!empty($testimonial_vars['regions'])) {
            $regions .= sprintf(
                '<p class="text-xl stylized mt-2 text-pretty">%s</p>',
                implode(', ', array_map(function ($region) {
                    return sprintf(
                        '<span class="pr-1">%s</span>',
                        esc_html(get_the_title($region))
                    );
                }, $testimonial_vars['regions']))
            );
        }
        $output .= $regions;
        $output .= '</div></div></div></div></li>';
    }

    $output .= '</ul>';
    return $output;
}

function render_section_included(array $content)
{
    $output  = '<ul class="flex lg:grid lg:grid-cols-3 lg:justify-center lg:content-center snap-slider snap-x snap-mandatory gap-x-2 lg:gap-x-8 lg:gap-y-8 py-6 lg:px-8 overflow-x-auto relative">';
    $output .= '<li class="rounded-xl w-1/12 flex-shrink-0 lg:hidden snap-center opacity-65 transition-all duration-300 ease-in-out"></li>';

    foreach ($content['content_featured'] as $key => $row) {
        if (empty($row['image']) || empty($row['heading']) || empty($row['subheading']) || empty($row['description'])) {
            continue;
        }

        $output .= sprintf(
            '<li class="snap-item rounded-xl w-9/12 lg:w-full flex-shrink-0 snap-center opacity-65 lg:opacity-100 transition-all duration-300 ease-in-out shadow-xl">
                <div class="bg-white opacity-[98%%] grid grid-cols-1 md:grid-cols-12 lg:gap-x-4 h-full overflow-hidden rounded-xl p-4 lg:px-6 transition-all duration-300 ease-in-out transform">
                    <div class="flex items-center justify-center p-2 md:col-span-3">
                        <div class="grid mt-4 sm:mt-0 relative justify-center w-full max-w-lg aspect-auto">
                            <div class="absolute sm:top-1/2 left-1/2 transform -translate-x-1/2 sm:-translate-y-1/2 w-32 h-32 bg-brand-500/50 opacity-50 rounded-full filter blur-xl"></div>
                            <img src="%1$s" alt="%2$s" class="relative h-32 w-auto z-10 object-contain drop-shadow-sm">
                            <img src="%3$s" alt="Decorative spiral overlay" class="absolute inset-0 w-full h-full object-contain opacity-60">
                        </div>
                    </div>
                    <div class="mt-2 text-center lg:text-left z-10 lg:ml-2 md:col-span-9">
                        <h5 class="d-inline-block fw-bolder text-uppercase mt-3 mb-0 text-xl md:text-2xl">%4$s</h5>
                        <h5 class="text-gradient text-primary stylized mb-3 md:mb-1 text-3xl antialiased-[unset]">%5$s</h5>
                        <div class="mx-auto text-center lg:text-left max-w-[90%%] lg:max-w-full mb-3">
                            <p class="text-gray-800 font-medium text-sm sm:text-base px-3 lg:pl-0 leading-normal md:leading-6 mb-5">%6$s</p>
                        </div>
                    </div>
                </div>
            </li>',
            esc_url($row['image']['url']),
            esc_attr($row['heading']), // Used as alt text for the image
            esc_url('https://t2i-new.test/wp-content/uploads/2024/10/spiral-1.svg'),
            esc_html($row['heading']),
            esc_html($row['subheading']),
            wp_kses_post($row['description'])
        );
    }

    $output .= '</ul>';
    return $output;
}

function render_section_steps(array $content)
{
    // Define the image URL - consider making this configurable through section_args
    $feature_image_url = esc_url(get_home_url() . '/wp-content/uploads/2024/08/Included-Sq-1.webp');

    $output = sprintf(
        '<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 lg:items-center">
            <div class="aspect-w-16 aspect-h-9 lg:aspect-none">
                <img class="w-full object-cover rounded-xl" src="%s" alt="%s">
            </div>
            <div>
                <div class="mb-4">
                    <h3 class="text-brand-500 text-xs font-bold font-base uppercase">%s</h3>
                </div>',
        $feature_image_url,
        esc_attr('Features Overview'),
        esc_html('We make it easy')
    );

    $i = 1;
    foreach ($content['content_sections'] as $field) {
        if (empty($field)) continue;

        $callout = !empty($field['callout'])
            ? sprintf('<span class="text-brand-700 font-bold">%s</span> ', esc_html($field['callout']))
            : '';

        $heading = !empty($field['heading'])
            ? sprintf('<span class="text-brand-700 font-semibold antialiased">%s</span> ', esc_html($field['heading']))
            : '';

        $description = !empty($field['description'])
            ? sprintf('<span class="text-gray-600 font-medium block text-base">%s</span>', esc_html($field['description']))
            : '';

        $output .= sprintf(
            '<div class="flex gap-x-5 ms-1">
                <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-brand-500">
                    <div class="relative z-10 size-8 flex justify-center items-center">
                        <span class="flex shrink-0 justify-center items-center size-8 border border-brand-500 text-brand-500 font-semibold text-xs uppercase rounded-full">
                            %d
                        </span>
                    </div>
                </div>
                <div class="grow pt-0.5 pb-8 sm:pb-12">
                    <p class="text-base lg:text-lg text-neutral-400">
                        %s
                        %s
                        %s
                    </p>
                </div>
            </div>',
            absint($i),
            $callout,
            $heading,
            $description
        );

        $i++;
    }

    $output .= '</div>';
    return $output;
}

/**
 * Renders a CTA section based on provided arguments.
 *
 * @param array $args {
 *     Array of arguments for rendering the CTA block.
 *
 *     @type string 'name'    Name/key of the block (default: 'cta').
 *     @type string 'heading' Main heading text (e.g., "Your dream honeymoon to Italy").
 *     @type array  'content' {
 *         @type string 'content_text_color'             (e.g., 'Light')
 *         @type string 'content_background_image_overlay' (e.g., 'Dark')
 *         @type string 'content_overlay_direction'       (e.g., 'Bottom Top')
 *         @type string 'content_background_color'        (e.g., 'Dark')
 *         @type string 'content_image'                   (URL to background image)
 *         @type string 'content_mobile_image'            (URL to mobile background image)
 *         @type string 'content_heading'                 (redundant heading; optional if already set at top level)
 *         @type string 'content_subheading'              (e.g., "Starts right here")
 *         @type string 'content_description'             (e.g., "Just tell us your preferences...")
 *         @type string 'content_max_width'               (max width as number or string)
 *         @type string 'content_copy'                    (CTA button text, e.g., "Design our dream honeymoon")
 *         @type string 'content_callout'
 *     }
 *     @type string|NULL 'cta'  (Unused in this example)
 * }
 * @return string HTML output for the CTA block.
 */
function render_section_cta( $args = array() ) {

    // Define reasonable defaults for all expected keys.
    $defaults = array(
        'name'    => 'cta',
        'heading' => '',
        'content' => array(
            'content_text_color'              => '',
            'content_background_image_overlay'=> '',
            'content_overlay_direction'       => '',
            'content_background_color'        => '',
            'content_image'                   => '',
            'content_mobile_image'            => '',
            'content_heading'                 => '',
            'content_subheading'              => '',
            'content_description'             => '',
            'content_max_width'               => '',
            'content_copy'                    => '',
            'content_callout'                 => '',
        ),
        'cta' => null,
    );

    // Merge provided args with defaults.
    $args = wp_parse_args( $args, $defaults );

    // For clarity, pull out the main content fields.
    // The snippet uses top-level 'heading' & subheading/description from 'content'.
    $heading     = ! empty( $args['heading'] ) ? $args['heading'] : '';
    $subheading  = ! empty( $args['content']['content_subheading'] ) ? $args['content']['content_subheading'] : '';
    $description = ! empty( $args['content']['content_description'] ) ? $args['content']['content_description'] : '';
    $cta_copy    = ! empty( $args['content']['content_copy'] ) ? $args['content']['content_copy'] : '';

    // Start building the output buffer for the CTA section.
    $html  = '<div class="mx-auto max-w-3xl text-center text-2xl sm:text-3xl md:text-4xl">' . "\n";

    // Heading.
    if ( $heading ) {
        $html .= '    <h2 class="font-semibold antialiased tracking-tight mb-4 text-white">' 
              . esc_html( $heading ) 
              . '</h2>' . "\n";
    }

    // Subheading.
    if ( $subheading ) {
        $html .= '    <h2 class="stylized font-semibold text-[150%] text-secondary-500">' 
              . esc_html( $subheading ) 
              . '</h2>' . "\n";
    }

    // Description.
    if ( $description ) {
        $html .= '    <p class="mx-auto mt-6 max-w-xl text-lg md:text-xl leading-normal md:leading-8 font-semibold text-white">' 
              . esc_html( $description ) 
              . '</p>' . "\n";
    }

    // CTA Button (if CTA text is provided).
    if ( $cta_copy ) {
        $html .= '    <div class="max-w-3xl px-4 pt-10 sm:px-6 sm:pb-20 lg:px-8 lg:pb-28 mx-auto text-center">' . "\n";
        $html .= '        <a href="' . esc_url( 'https://www.trips2italy.com/get-custom-itinerary/' ) . '" 
                           class="inline-block relative rounded-full border border-transparent px-6 py-1.5 sm:py-2.5 text-base font-semibold antialiased text-white shadow-sm hover:bg-secondary-600 hover:border hover:border-secondary-600 hover:shadow-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary-500 tracking-normal hover:scale-105 ease-linear duration-150 ">' . "\n";
        $html .= '            <span class="absolute top-0 left-0 w-full h-full rounded-full opacity-50 filter blur-sm bg-gradient-to-br from-secondary-600 to-secondary-400"></span>' . "\n";
        $html .= '            <span class="h-full w-full inset-0 absolute mt-0.5 ml-0.5 bg-gradient-to-br filter group-active:opacity-0 rounded-full opacity-50 from-secondary-600 to-secondary-400"></span>' . "\n";
        $html .= '            <span class="absolute inset-0 w-full h-full transition-all duration-200 ease-out rounded-full shadow-xl bg-gradient-to-br filter group-active:opacity-0 from-secondary-600 to-secondary-400"></span>' . "\n";
        $html .= '            <span class="absolute inset-0 w-full h-full transition duration-200 ease-out rounded-full bg-gradient-to-br to-secondary-600 from-secondary-400"></span>' . "\n";
        $html .= '            <span class="relative">' . esc_html( $cta_copy ) . '</span>' . "\n";
        $html .= '        </a>' . "\n";
        $html .= '    </div>' . "\n";
    }

    // Close container div.
    $html .= '</div>' . "\n";

    // Return the constructed HTML.
    return $html;
}


function render_section_examples(array $content)
{
    $featured_image = $content['content_featured_image'];

    if (!empty($featured_image['url'])) {
        $output = sprintf(
            '<div class="relative overflow-hidden">
            <div class="mx-auto max-w-7xl lg:px-8" id="example-trips-img-main">
                <img src="%s" alt="%s" class="mb-[-12%%] rounded-xl object-cover object-center shadow-2xl aspect-[12/7] ring-1 ring-gray-900/10" width="2432" height="1442">
                <div class="relative" aria-hidden="true">
                    <div class="absolute -inset-x-20 bottom-0 bg-gradient-to-t from-white pt-[7%%]"></div>
                </div>
            </div>
        </div>',
            $featured_image['url'],
            esc_attr('Featured Image')
        );
    }
    // Start with the main image section

    // Build navigation and content sections
    $nav_items = [];
    $content_items = [];

    foreach ($content['content_sections'] as $index => $field) {
        if (empty($field['heading'])) continue;

        $id = sanitize_title($field['heading']);
        $is_active = $index === 0;
        $active_nav_class = $is_active ? '' : ' opacity-50 ';
        $active_content_class = $is_active ? ' inline-flex ' : ' hidden ';

        // Build navigation item
        $nav_item = sprintf(
            '<li class="flex-grow flex py-1 sm:py-4 relative items-center %s hover:opacity-100 hover:cursor-pointer" data-img="%s" data-type="%s">
                <h3 class="text-sm sm:text-lg md:text-xl lg:text-2xl pl-2 sm:pl-5 inline-block font-semibold">%s%s</h3>
            </li>',
            esc_attr($active_nav_class),
            esc_url($field['image']['url']),
            esc_attr($id),
            !empty($field['icon']['url'])
                ? sprintf(
                    '<img src="%s" class="inline-block relative right-3 h-4 sm:h-6 w-4 sm:w-6 text-secondary-600" alt="%s" />',
                    esc_url($field['icon']['url']),
                    esc_attr($field['heading'] . ' icon')
                )
                : '',
            esc_html($field['heading'])
        );

        // Build content item
        $content_item = sprintf(
            '<div class="w-full h-full inline-flex items-center opacity-0" data-container="%s">
                <p class="text-base sm:text-lg md:text-xl md:leading-relaxed">%s</p>
            </div>',
            esc_attr($id),
            esc_html($field['description'])
        );

        $nav_items[] = $nav_item;
        $content_items[] = $content_item;
    }

    // Combine navigation and content sections
    $output .= sprintf(
        '<div class="mx-auto my-8 max-w-7xl px-6 sm:mt-20 md:mt-24 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div id="example-trips-nav">
                    <ul role="list" class="flex flex-col h-full justify-center" id="example-trips-nav">%s</ul>
                </div>
                <div class="md:col-span-2 py-8" id="example-trips-content">%s</div>
            </div>
        </div>',
        implode('', $nav_items),
        implode('', $content_items)
    );

    return $output;
}

function render_section_stats(array $content)
{
    $stats_items = [];
    foreach ($content as $stat) {
        if (empty($stat['stat']) || empty($stat['subheading']) || empty($stat['description'])) {
            continue;
        }

        $stats_items[] = sprintf(
            '<div class="text-center px-4 py-6">
                <h3 class="text-brand-600 tracking-wide text-2xl font-semibold font-heading">%s</h3>
                <h4 class="mt-3 stylized text-secondary-500 text-[2rem] md:text-3xl lg:text-4xl mb-6">%s</h4>
                <p class="text-gray-700 text-base lg:text-lg px-4">%s</p>
            </div>',
            esc_html($stat['stat']),
            esc_html($stat['subheading']),
            esc_html($stat['description'])
        );
    }

    return sprintf(
        '<div class="grid grid-cols-1 lg:grid-cols-12 justify-center">
            <div class="lg:col-span-10 lg:col-start-2 rounded-lg bs-blur ring-2 ring-white">
                <div class="flex flex-col lg:flex-row py-6 divide-y-2 divide-y-white lg:divide-y-0 lg:divide-x-2 shadow-xl shadow-black/30">
                    %s
                </div>
            </div>
        </div>',
        implode('', $stats_items)
    );
}

function render_section_itinerary(array $content)
{
    $itinerary_id = $content['content_itinerary'];

    // Start with the container structure
    $output = '<div class="wpex horizontal-timeline wpex-horizontal-5 ex-multi-item tlml-arrow-top wpex-horizontal-4" data-autoplay="0" data-speed="" data-rtl="" id="horizontal-tl-4785" data-id="horizontal-tl-4785" data-slidesshow="2" data-start_on="" data-infinite="">
        <div class="hor-container">
            <span class="w-[93%] sm:w-[94%] md:w-[95%] lg:w-[96%] xl:w-[98%] !border-b-gray-200 timeline-hr after:content-[none] before:content-[none]"></span>
            <ul class="horizontal-nav">';

    if (have_rows('details', $itinerary_id)) :
        // Initialize the details string
        $itinerary_items = '';

        // Build timeline items
        while (have_rows('details', $itinerary_id)) : the_row();

            $image_url = get_sub_field('image', $itinerary_id);
            if (!$image_url) {
                $image_url = get_the_post_thumbnail_url(25631);
            }

            $itinerary_items .= '<li class="ictl-25612 text-base">';
            $itinerary_items .= '<span class="stylized text-[160%] text-brand-700 tl-point wpex_point"><i class="fa fa-circle no-icon"></i>Day ' . esc_html(get_row_index()) . '</span>';
            $itinerary_items .= '<div class="wpextt_templates !px-[20px]">';
            $itinerary_items .= '<div class="border-radius-lg p-4 pt-5 post-25612 wp-timeline type-wp-timeline status-publish has-post-thumbnail hentry wpex_category-honeymoon" id="wpextt_content-25612" style=" ">';
            $itinerary_items .= '<div class="wpex-timeline-label">';
            $itinerary_items .= '<div class="timeline-media">';
            $itinerary_items .= '<a class="text-xl lg:text-2xl" href="javascript:;" title="Day ' . esc_attr(get_row_index()) . '">';

            $itinerary_items .= '<img ';
            $itinerary_items .= 'src="' . esc_url($image_url) . '" ';
            $itinerary_items .= 'class="attachment-wptl-600x450 size-wptl-600x450 !h-[250px] !w-full object-cover object-center wp-post-image shadow rounded" alt="" loading="lazy" ';
            $itinerary_items .= 'srcset="' . esc_url($image_url) . ' 600w, ';
            $itinerary_items .= esc_url(add_image_size($image_url, 300, 200)) . ' 300w, ';
            $itinerary_items .= esc_url(add_image_size($image_url, 350, 233)) . ' 350w" ';
            $itinerary_items .= 'sizes="(max-width: 600px) 100vw, 600px">';

            $itinerary_items .= '<span class="bg-opacity"></span>';
            $itinerary_items .= '</a></div>';
            $itinerary_items .= '<div class="timeline-details !text-left mx-auto !px-0 !pt-4">';
            $itinerary_items .= '<h3 class="mb-4 stylized text-xl lg:text-2xl text-center text-secondary-500">';
            $itinerary_items .= esc_html(get_sub_field('location', $itinerary_id)) . '</h3>';
            $itinerary_items .= '<div class="wptl-more-meta d-none">';
            $itinerary_items .= '</div>';

            $itinerary_items .= '<div class="wptl-excerpt">';
            $itinerary_items .= '<h4 class="font-semibold text-lg lg:text-xl mb-2">' . esc_html(get_sub_field('heading', $itinerary_id)) . '</h4>';
            $itinerary_items .= '<p class="day-description text-sm lg:text-[1.15rem] leading-normal ">' . wp_kses_post(get_sub_field('description', $itinerary_id)) . '</p>';

            $itinerary_items .= '</div></div>';
            $itinerary_items .= ' <div class="exclearfix"></div>';
            $itinerary_items .= '</div></div></div></li>';
        endwhile;
    endif;

    // Add the details content and close containers
    $output .= $itinerary_items;
    $output .= '</ul></div></div>';

    return $output;
}
/* endregion */

/* region init */
function render_section(array $section)
{
    if (empty($section) || empty($section['content'])) {
        return null;
    }

    $section_name = sanitize_key($section['name']);
    $section_output_function = 'render_section_' . $section_name;

    if (function_exists($section_output_function)) {
        $content = $section_output_function($section['content']);

        if ($content) {
            $output = render_section_open($section);
            $output .= render_content_open();
            $output .= $content;
            $output .= render_content_close();
            $output .= render_section_close();
            return $output;
        }
    }

    return null;
}
/* endregion */