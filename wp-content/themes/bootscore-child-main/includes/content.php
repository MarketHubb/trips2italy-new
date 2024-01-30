<?php
// region Shared
function galleryLightbox($args = [])
{
    $gallery = '';

    if (isset($args["src"]) && $args["src"]) {
        $gallery .= '<div class="">';
        $gallery .= '<a href="' . $args['src'] . '" ';
        $gallery .= 'data-toggle="lightbox" data-gallery="example-gallery">';
        $gallery .= '<img src="' . $args['src'] . '" class="img-fluid rounded shadow" />';
        $gallery .= '</a>';
    }

    if (isset($args['caption']) && $args['caption']) {
        $gallery .= '<div class="text-center"><p class="small px-4 text-dark pt-2">' . $args['caption'] . '</p></div>';
    }

    $gallery .= '</div>';

    return $gallery;
}
// endregion

// region Content
function get_content_section_heading($heading_array = array(), $row = true, $text_center = true, $light_text = null)
{
    if (is_array($heading_array)) {

        if ($row) {
            $light_text_class = ($light_text) ? "text-light" : '';
            $heading = '<div class="row justify-content-center section-heading mb-5 pb-2 ' . $light_text_class . '">';
        }

        $col_classes = ($text_center) ? "text-center" : '';

        $heading .= '<div class="col-md-8 ' . $col_classes . '">';

        if ($heading_array['heading']) {
            $heading .= '<h2 class="mb-1 mt-2">' . $heading_array['heading'] . '</h2>';
        }
        if ($heading_array['subheading']) {
            $heading .= '<h2 class="text-gradient text-primary stylized">' . $heading_array['subheading'] . '</h2>';
        }
        if ($heading_array['description']) {
            $heading .= '<p class="lead mt-4 fw-600 fs-5 lh-base heading-description">' . $heading_array['description'] . '</p>';
        }

        $heading .= '</div>';

        if ($row) {
            $heading .= '</div>';
        }

        return $heading;
    }
}

function set_url_from_link_type($link_type)
{
    if ($link_type === "Post - Regions") {
        return "region";
    }
}

function get_content_section_links($section = array(), $path, $arrow = null)
{
    // Var Paths
    $style = $path . 'style';
    $text = $path . 'text';
    $type = $path . 'type';
    $url = $path . set_url_from_link_type($section[$type]);

    $classes = ($section[$style] === 'Button') ? 'btn bg-orange btn-lg' : 'text-dark icon-move-right fw-bold fs-5';

    if ($section[$url]) {
        $output = '<a ';
        $output .= 'href="' . $section[$url] . '" ';
        $output .= 'class="' . $classes . '">';
        $output .= $section[$text];

        if ($arrow) {
            $output .= '<i class="fas fa-arrow-right text-sm ms-1"></i>';
        }

        $output .= '</a>';
    }

    return $output ?: null;
}

function get_stats($stats = array())
{
    if (is_array($stats)) {
        $content = '';
        foreach ($stats as $stat) {
            $content .= '<div class="col-md-4 position-relative">';
            $content .= '<div class="p-3 text-center">';
            $content .= '<h1 class="text-gradient text-primary"><span id="state1" countto="">' . $stat['stat'] . '</span></h1>';
            $content .= '<h5 class="mt-3">' . $stat['subheading'] . '</h5>';
            $content .= '<p class="text-sm">' . $stat['description'] . '</p>';
            $content .= '</div><hr class="vertical dark"></div>';
        }
    }

    return ($content) ?: null;
}
// endregion

//region Helpers
function get_parent_term_id($term)
{
    return ($term->parent === 0) ? $term->term_id : $term->parent;
}
function get_post_parent_id($post)
{
    return ($post->post_parent === 0) ? $post->ID : $post->post_parent;
}
function lowercase_no_spaces($string)
{
    return strtolower(str_replace(" ", "", $string));
}
//endregion
function get_formatted_region_page_type($title, $destination = null)
{
    $removal_words = ["Ultimate", "Guide", "For", "Traveling", "Travel", "Vacation", "Italy", "In"];

    if ($destination) {
        $removal_words[] = $destination;
    }

    $title_array = explode(" ", $title);

    foreach ($title_array as $key => $word) {
        if (in_array($word, $removal_words)) {
            unset($title_array[$key]);
        }
    }

    $clean_title = '';

    foreach ($title_array as $words) {
        $clean_title .= $words . ' ';
    }

    return trim($clean_title);
}

function get_hero_breadcrumb_links($object, $type)
{

    $breadcrumbs[] = [
        'text' => 'All Destinations',
        'link' => get_permalink(27712),
        'icon' => get_home_url() . '/wp-content/uploads/2023/01/Marker.svg'
    ];

    if ($object->post_type === 'location') {
        $terms = get_the_terms($object->ID, 'location_region');

        foreach ($terms as $term) {
            if ($term->parent === 0) {
                $name = "Region of $term->name";
                $region_name_clean = lowercase_no_spaces($term->name);
                $breadcrumbs[] = [
                    'text' => $name,
                    'link' => get_permalink(27712) . '#' . $region_name_clean,
                    'icon' => get_field('region_icon', $term)
                ];
            }
        }

    }

    $current_page = ($type === "post") ? get_the_title($object->ID) : get_term($object->term_id)->name;

    $breadcrumbs[] = [
        'text' => str_replace("Ultimate", "", $current_page),
        'link' => null,
        'icon' => get_home_url() . '/wp-content/uploads/2023/07/Map-Pin.svg'
    ];

    return $breadcrumbs;
}

function get_post_hero_inputs($postObj)
{
    $id = $postObj->ID;
    $parent = get_post_parent($postObj);
    $initial = ($parent) ? $parent : $postObj;
    $hero = [];

    if ($postObj->post_type === 'location') {
        $image = (get_field('featured_image', $id)) ? get_field('featured_image', $id)['url'] : get_field('image_slider_url', $id);

        if ($image) {
            $hero['image'] = remove_home_url($image);
        }

        $hero['heading'] = ($parent) ? $parent->post_title : $postObj->post_title;

        $hero['heading_2'] = ($parent) ? trim(str_replace($parent->post_title, "", $postObj->post_title)) . " Guide" : "Ultimate Travel Guide";

        $hero['button_text'] = "Get My Custom " . $initial->post_title . " Itinerary";

        $hero['button_text_mobile'] = "Get My Custom Itinerary";
    }

    return $hero;
}

function get_tax_hero_inputs($term)
{
    $image = (get_field('featured_image', $term)) ? get_field('featured_image', $term)['url'] : remove_home_url(get_field('image_slider_url', $term));
    $hero['image'] = $image;
    $hero['heading'] = $term->name;
    $region_name = ($term->parent === 0) ? $term->name : get_term($term->parent)->name;
    $hero['button_text'] = 'Get My Custom ' . $region_name . ' Itinerary';

    return $hero;
}

function location_post_tabs($postObj)
{
    $parent = get_post_parent($postObj);
    $initial = ($parent) ? $parent : $postObj;
    $tabs['location'] = $initial->post_title;

    $tabs['pages'][] = [
        'name' => "Ultimate Travel Guide",
        'permalink' => get_permalink($initial->ID),
        'icon' => get_home_url() . '/wp-content/uploads/2023/01/Pin-Shadow.svg'
    ];

    $children_posts = get_posts(
        array(
            'post_type' => 'location',
            'post_parent' => $initial->ID,
            'posts_per_page' => -1
        )
    );

    foreach ($children_posts as $child_post) {
        $tabs['pages'][] = [
            'name' => trim(str_replace($initial->post_title, "", $child_post->post_title)),
            'permalink' => get_permalink($child_post->ID),
            'icon' => get_icon_for_region_page(get_the_title($child_post->ID))
        ];
    }

    return $tabs;
}

function location_tax_tabs($postObj)
{
    $parent_id = get_parent_term_id($postObj);
    $parent = get_term_by('ID', $parent_id, 'location_region');
    $tabs['location'] = $parent->name;

    $tabs['pages'][] = [
        'name' => "Region Guide",
        'permalink' => get_term_link($parent),
        'icon' => get_home_url() . '/wp-content/uploads/2023/01/Pin-Shadow.svg'
    ];

    $children_terms = get_terms(
        array(
            'taxonomy' => 'location_region',
            'hide_empty' => false,
            'parent' => $parent_id
        )
    );

    foreach ($children_terms as $child_term) {
        $tabs['pages'][] = [
            'name' => trim(str_replace($parent->name, "", $child_term->name)),
            'permalink' => get_term_link($child_term),
            'icon' => get_icon_for_region_page($child_term->name)
        ];
    }

    return $tabs;
}

function location_tabs($postObj, $type)
{
    $tabs = ($type === "post") ? location_post_tabs($postObj) : location_tax_tabs($postObj);

    return $tabs ?: null;
}

function location_hero_and_tab_inputs($postObj)
{
    $inputs = null;

    if ($postObj->ID) {
        $type = 'post';
        $inputs['hero'] = get_post_hero_inputs($postObj);
    }

    if ($postObj->term_id) {
        $type = 'taxonomy';
        $inputs['hero'] = get_tax_hero_inputs($postObj);
    }

    $inputs['hero']['breadcrumbs'] = ($type) ? get_hero_breadcrumb_links($postObj, $type) : null;

    $inputs['tabs'] = location_tabs($postObj, $type);

    return $inputs ?: null;
}

function region_tabs($term)
{
    $parent_term_id = get_parent_term_id($term);
    $parent_region = get_term_by('ID', $parent_term_id, 'location_region');
    $region_terms[] = [
        'name' => $parent_region->name,
        'permalink' => get_term_link($parent_region),
        'icon' => get_home_url() . '/wp-content/uploads/2023/01/Pin-Shadow.svg'
    ];

    $children_terms = get_terms(
        array(
            'taxonomy' => 'region',
            'hide_empty' => false,
            'parent' => $parent_term_id
        )
    );

    foreach ($children_terms as $child_term) {
        $child_term_name = htmlspecialchars($child_term->name);

        if (strpos($child_term_name, "&#8217;s") !== false) {
            $child_term_name = str_replace("&#8217;s", "", $child_term_name);
        }

        $child_term_title = trim(str_replace($parent_region->name, "", format_region_title($child_term->term_id, $child_term_name)));
        $region_terms[] = [
            'name' => $child_term_title,
            'permalink' => get_term_link($child_term),
            'icon' => get_icon_for_region_page($child_term->name)
        ];
    }

    return $region_terms;
}

function get_tax_tab_inputs($term)
{
    $parent_term_id = get_parent_term_id($term);
    $parent_region = get_term_by('ID', $parent_term_id, 'region');
    $region_terms[] = [
        'name' => $parent_region->name,
        'permalink' => get_term_link($parent_region),
        'icon' => get_home_url() . '/wp-content/uploads/2023/01/Pin-Shadow.svg'
    ];

    $children_terms = get_terms(
        array(
            'taxonomy' => 'region',
            'hide_empty' => false,
            'parent' => $parent_term_id
        )
    );

    foreach ($children_terms as $child_term) {
        $child_term_name = htmlspecialchars($child_term->name);

        if (strpos($child_term_name, "&#8217;s") !== false) {
            $child_term_name = str_replace("&#8217;s", "", $child_term_name);
        }

        $child_term_title = trim(str_replace($parent_region->name, "", format_region_title($child_term->term_id, $child_term_name)));
        $region_terms[] = [
            'name' => $child_term_title,
            'permalink' => get_term_link($child_term),
            'icon' => get_icon_for_region_page($child_term->name)
        ];
    }

    return $region_terms;
}

function get_city_post_tab_inputs($post)
{
    $parent_post_id = get_post_parent_id($post);
    $parent_post_title = format_region_title($parent_post_id, get_the_title($parent_post_id));
    $region_posts[] = [
        'name' => $parent_post_title,
        'permalink' => get_permalink($parent_post_id),
        'icon' => get_home_url() . '/wp-content/uploads/2023/01/Pin-Shadow.svg'
    ];

    $children_posts = get_posts(
        array(
            'post_type' => get_post_type($post),
            'post_parent' => $parent_post_id,
            'posts_per_page' => -1
        )
    );

    foreach ($children_posts as $child_post) {
        $child_term_name = get_the_title($child_post->ID);

        if (strpos($child_term_name, "&#8217;s") !== false) {
            $child_term_name = str_replace("&#8217;s", "", $child_term_name);
        }


        $child_post_title = trim(str_replace($parent_post_title, "", format_region_title($child_post->ID, $child_term_name)));
        $region_posts[] = [
            'name' => $child_post_title,
            'permalink' => get_permalink($child_post->ID),
            'icon' => get_icon_for_region_page(get_the_title($child_post->ID))
        ];
    }

    return $region_posts;
}

function format_region_title($post_id)
{
    $title = get_the_title($post_id);

    $removal_words = ["Ultimate", "Guide", "For", "Traveling", "Travel", "Vacation", "Italy", "In", "of", "-", "What to See", "Of", "Travelers", "What to See"];

    $title_array = explode(" ", $title);

    foreach ($title_array as $key => $word) {
        if (in_array($word, $removal_words)) {
            unset($title_array[$key]);
        }
    }

    $clean_title = '';

    foreach ($title_array as $words) {
        $clean_title .= $words . ' ';
    }

    $clean_title = remove_dashes(standardize_to(standardize_ampersands($clean_title)));

    return trim($clean_title);
}

function format_region_child_page_type($post_id, $parent = null)
{
    $city = format_region_title($post_id);
    return $city;

}

function format_region_page_type($post_id, $parent_id = null)
{
    $city = get_post($post_id);
    if ($city->post_parent !== 0 && get_field('standardized_title')) {
        return 'Ultimate ' . get_field('standardized_title');
    } elseif ($city->post_parent === 0 && !get_field('standardized_title')) {
        return 'Ultimate Travel Guide';
    } else {
        $title = get_the_title($post_id);
        $title = str_replace(format_region_title($parent_id), '', $title);
        if ($post_id !== $parent_id) {
            $title = str_replace('Ultimate', '', $title);
        }
        return $title;
    }

}

function get_icon_for_region_page($formatted_title)
{
    $url = get_home_url();
    switch (true) {
        case str_contains($formatted_title, 'History'):
            return $url . '/wp-content/uploads/2023/09/rome-building.svg';
        case str_contains($formatted_title, 'Food'):
            return $url . '/wp-content/uploads/2023/09/wine-glasses.svg';
        case str_contains($formatted_title, 'Culture'):
            return $url . '/wp-content/uploads/2023/01/Culture.svg';
        case str_contains($formatted_title, 'Things'):
            return $url . '/wp-content/uploads/2023/09/cal-2.svg';
    }
}

function get_excerpt_for_post($text, $length = 10)
{
    $length = abs((int) $length);
    if (strlen($text) > $length) {
        $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
    }
    return ($text);
}

//region Hero

//endregion

function remove_travel_guides_from_content($string)
{
    $string = str_replace('<strong>Travel Guides</strong>', '', $string);

    return str_replace('<b></b><b></b>', '', $string);
}

function remove_embeds_from_content($content, $return_type = null)
{
    $content = explode("\n", $content);
    $clean_array = [];
    $clean_content = '';

    foreach ($content as $key => $val) {
        $line = trim(preg_replace("/\[.*?\]/", "", $val));
        if (strlen($line) > 0) {
            $clean_content .= "\n" . $line . "\n";
            $clean_array[] = $line;
        }

    }
    return (!$return_type) ? $clean_content : $clean_array;
}

function get_alternate_text($section, $side)
{
    $column_classes = $side === "left" ? '' : 'order-1 order-md-1 order-lg-1';
    $link = get_content_section_links($section, "link_link_", true);

    $text = '<div class="col-lg-6 col-md-12 me-auto ' . $column_classes . '">
                <div class="p-3 pt-0">
                    <h2 class="text-gradient text-warning mb-0 font-weight-bolder">' . $section['region'] . '</h2>
                    <h4 class="mb-4">' . $section['callout'] . '</h4>
                    <p class="region-description lead">' . $section['excerpt'] . '</p>';

    if ($link) {
        $text .= $link;
    }

    //                    <a href="javascript:;" class="text-dark icon-move-right fw-bold fs-5">Discover ' . $section['region'] . '
//                        <i class="fas fa-arrow-right text-sm ms-1"></i>
//                    </a>
    $text .= '</div></div>';

    return $text;
}

function get_alternate_img($section, $side)
{
    $column_classes = $side === "left" ? '' : ' order-2 order-md-2 order-lg-1';
    $img_classes = $side === "right" ? ' transform-355' : ' transform-1';

    //    <div class="position-relative ms-md-5 mb-0 mb-md-7 mb-lg-0 d-none d-md-block d-lg-block d-xl-block h-75">
//    <div class="w-100 h-100 bg-gradient-warning border-radius-xl position-absolute background-shape" alt=""></div>
    return '<div class="col-lg-6 col-md-8' . $column_classes . '">
                <div class="position-relative text-center">
                    <img src="' . $section['image_mobile'] . '" class="w-100 border-radius-xl mt-4  shadow ' . $img_classes . '" alt="">
                </div>
            </div>';
}

function get_alternate_content($section, $side)
{
    $text = get_alternate_text($section, $side);
    $img = get_alternate_img($section, $side);

    $content = '<div class="row py-5 py-md-7">';

    if ($side === "left") {
        $content .= $text . $img . '</div>';
    } else {
        $content .= $img . $text . '</div>';
    }

    //    $content .=  $side === "left" ? get_alternate_text($section, $side) : get_alternate_img($section, $side);
//    $content .=  $side === "right" ? get_alternate_img($section, $side) : get_alternate_text($section, $side);
//    $content .= '</div>';

    return $content;
}

function get_left_alternate($section)
{
    return '<div class="row py-7">
            <div class="col-lg-6 col-md-12 me-auto">
                <div class="p-3 pt-0">
                    <div class="icon icon-shape bg-gradient-warning rounded-circle shadow text-center mb-4">
                    </div>
                    <h2 class="text-gradient text-warning mb-0 font-weight-bolder">' . $section['region'] . '</h2>
                    <h4 class="mb-4">' . $section['callout'] . '</h4>
                    <p class="region-description lead">' . $section['excerpt'] . '</p>
                    <a href="javascript:;" class="text-dark icon-move-right  fw-bold fs-5">Discover ' . $section['region'] . '
                        <i class="fas fa-arrow-right text-sm ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-8">
                <div class="position-relative ms-md-5 d-none d-md-block d-lg-block d-xl-block h-75">
                    <div class="w-100 h-100 bg-gradient-warning border-radius-xl position-absolute background-shape" alt=""></div>
                    <img src="' . $section['image_mobile'] . '" class="w-100 border-radius-xl mt-4 ms-n4 position-absolute shadow" alt="">
                </div>
            </div>
        </div>';
}

function get_right_alternate($section)
{
    return '<div class="row py-7">
            <div class="col-lg-6 col-md-8 order-2 order-md-2 order-lg-1">
                <div class="position-relative ms-md-5 mb-0 mb-md-7 mb-lg-0 d-none d-md-block d-lg-block d-xl-block h-75">
                    <div class="bg-gradient-info w-100 h-100 border-radius-xl position-absolute background-shape" alt=""></div>
                    <img src="' . $section['image_mobile'] . '" class="w-100 border-radius-xl mt-3 ms-3 position-absolute" alt="">
                </div>
            </div>
            <div class="col-lg-5 col-md-12 ms-auto order-1 order-md-1 order-lg-1">
                <div class="p-3 pt-0">
                    <div class="icon icon-shape bg-gradient-info rounded-circle shadow text-center mb-4">
                    </div>
                    <h3 class="text-gradient text-info mb-0">' . $section['region'] . '</h3>
                    <h4 class="mb-4">' . $section['callout'] . '</h4>
                    <p class="region-description lead">' . $section['excerpt'] . '</p>
                    <a href="javascript:;" class="text-dark icon-move-right fw-bold fs-5">Discover ' . $section['region'] . '
                        <i class="fas fa-arrow-right text-sm ms-1"></i>
                    </a>
                </div>
            </div>
        </div>';
}

?>