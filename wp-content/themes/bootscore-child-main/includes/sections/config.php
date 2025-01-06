<?php
function get_queried_id()
{
    return get_queried_object_id();
}

function use_heading_global_options($section_args)
{
    if (empty($section_args['section_name'])) return null;

    $global_heading = get_field(
        $section_args['section_name'] . '_global_options',
        $section_args['post_id']
    );

    return $global_heading;
}

function set_mandatory_section_args(array $section_args)
{
    if (empty($section_args)) {
        return null;
    }

    $mandatory = ['section_name'];

    foreach ($mandatory as $key) {
        if (!array_key_exists($key, $section_args) || empty($section_args[$key])) {
            return null;
        }
    }

    return set_section_post_id($section_args);
}

function set_section_post_id(array $section_args)
{
    if (!empty($section_args['post_id'])) return $section_args;

    $post_id = get_queried_id();

    if (! $post_id) return null;

    $section_args['post_id'] = $post_id;

    return $section_args;
}

function get_section_content_data(array $section_args)
{
    if (!empty($section_args['content'])) return $section_args['content'];

    $object = get_queried_object();

    if (! $object) return null;

    if (! empty($object->post_type) && $object->post_type === 'trip') {
        return get_trip_section_content($section_args) ?? null;
    }

    return null;
}

function get_section_cta_data($section_data)
{
    $cta_data = [];

    if (!empty($section_data['header']['copy'])) {
        $cta_data['copy'] = $section_data['header']['copy'];
    }

    if (!empty($section_data['header']['callout'])) {
        $cta_data['callout'] = $section_data['header']['callout'];
    }

    return $cta_data;
}

function get_section_header_data($section_args)
{
    if (empty($section_args['post_id'])) return null;

    return ! use_heading_global_options($section_args)
        ? get_post_section_container_args($section_args['post_id'], $section_args['section_name'])
        : get_global_section_container_args($section_args['section_name']);
}

function set_section_data(array $section_args)
{
    $section_data = set_mandatory_section_args($section_args);

    if (! $section_data) return null;

    $section_data = [
        ...$section_data,
        ...$section_args
    ];

    $section_data['content'] = get_section_content_data($section_data);
    $section_data['header'] = get_section_header_data($section_data);

    if (empty($section_data['content']) && $section_data['section_name'] !== 'cta') return null;

    $section_data['cta'] = get_section_cta_data($section_data);

    return $section_data;
}

function get_section($section_args)
{
    $section_data = set_section_data($section_args);

    if (!$section_data || empty($section_data['content'] && $section_data['section_name'] !== 'cta')) return null;

    $section  = render_section_open($section_data);

    if (!empty($section_data['header'])) {
        $section .= get_section_header($section_data);
    }

    if (!empty($section_data['content'])) {
        $section .= render_section($section_data);
    }

    if (!empty($section_data['cta'])) {
        $section .= render_section_cta($section_data);
    }

    $section .= get_section_close();

    return $section;
}

function content_sections(object $queried_object)
{
    $content_sections = is_object_post($queried_object)
        ? get_template_post($queried_object)
        : get_template_tax($queried_object);

    if (empty($content_sections) || !is_array($content_sections)) return;

   highlight_string("<?php\n\$content_sections =\n" . var_export($content_sections, true) . ";\n?>"); 

    $output = '';

    foreach ($content_sections as $section) {
        // if (empty($section['name']) || empty($section['content'])) return '';

        $output .= render_section($section);
    }

    return $output;
}

function get_template_post(object $queried_object)
{
    switch (get_object_post_type($queried_object)) {
        case 'trip':
            $content_sections = get_single_trip_template_data($queried_object);
            break;
        default:
            $content_sections = null;
            break;
    }

    return $content_sections;
}

function get_single_trip_section_args()
{
    return [
        'testimonials' => [
            'function' => [
                'name' => 'get_review_posts_for_trip_type',
                'args' => [get_queried_object_id()]
            ],
        ],
        'included' => [
            'key' => 'content_featured'
        ],
        'steps' => [
            'key' => 'content_sections'
        ],
        'cta' => [],
        'how' => [],
        'callouts' => [
            'key' => 'content_callouts'
        ],
        'examples' => [
            'key' => 'content_feature_panels'
        ],
        'stats' => [
            'key' => 'content_stats'
        ],
        'itinerary' => [
            'key' => 'content_itinerary'
        ],
        'packages' => [
            'function' => ''
        ],
    ];
}

function get_single_trip_template_data(object $queried_object)
{
    return get_section_data(get_single_trip_section_args());
}

function get_template_tax(object $queried_object) {}
