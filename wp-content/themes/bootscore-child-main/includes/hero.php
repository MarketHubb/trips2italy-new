<?php
// region HERO - Setup
function get_hero_for_page($queried_object)
{
    $hero = output_hero_banner($queried_object);

    return !empty($hero) ? $hero : null;
}

function get_hero_by_post_type($object)
{

    // Locations (Cities & Regions)
    if ($object->taxonomy === 'location_region' || $object->post_type === 'location') {
        $inputs = location_hero_and_tab_inputs(get_queried_object());
        get_template_part('template-parts/tw-hero/content', 'hero-overlay-wave', $inputs);

        // if ($inputs['hero']) {
        //     get_template_part('template-parts/banner/content', 'full-width-text-overlay', $inputs['hero']);
        // }
    }

    // Trip Types
    if ($object->post_type === 'trip') {
        get_template_part('template-parts/banner/content', 'center-wave');
    }

    // Packages
    if ($object->post_type === 'package') {
        get_template_part('template-parts/tw-hero/content', 'hero-angled');
        // get_template_part('template-parts/packages/content', 'single-hero');
    }
}

function get_shared_hero_banner($object)
{
    $hero_inputs = get_hero_inputs($object);


    if (! empty($hero_inputs) && $hero_inputs['include']) {
        if ($hero_inputs['type'] === "masonry") {
            get_template_part('template-parts/hero/content', $hero_inputs['template'], $hero_inputs);
            get_template_part('template-parts/hero-banner/content', 'main', $hero_inputs);
        } else {
            get_template_part('template-parts/tw-hero/content', 'hero-overlay-wave', $hero_inputs);
        }
    }
}

function output_hero_banner($object)
{
    $include_hero = get_field('include_hero_banner', $object);
    $hero         = null;

    if ($include_hero) {
        return get_shared_hero_banner($object);
    } else {
        return get_hero_by_post_type($object);
    }
}


function form_heading($dynamic = null)
{
    $form_heading = get_desktop_mobile_copy(get_field('form_heading', 'option'), ",", $dynamic);
    $form_subheading = get_desktop_mobile_copy(get_field('form_subheading', 'option'), ",",  $dynamic);
    $form_description = get_desktop_mobile_copy(get_field('form_description', 'option'), "\n", $dynamic);
    $desktop = '<div class="col-8 form-heading-desktop mt-4">';
    $mobile = '<div class="col-12 form-heading-mobile">';

    if (!empty($form_heading)) {
        $mobile_heading = (isset($form_heading['mobile'])) ? $form_heading['mobile'] : $form_heading['desktop'];
        $desktop .= '<h3 class="d-none d-md-inline-block">' . $form_heading['desktop'] . ' ';
        $mobile  .= '<h5 class="d-inline-block fw-700 tracking-tight  d-md-none">' . $mobile_heading . ' ';
    }

    if (!empty($form_subheading)) {
        $mobile_subheading = (isset($form_subheading['mobile'])) ? $form_subheading['mobile'] : $form_subheading['desktop'];
        $desktop .= '<span class=" d-none d-md-inline-block">' . $form_subheading['desktop'] . '</span>';
        $mobile .= '<span class=" d-inline d-md-none">' . $mobile_subheading . '</span>';
    }

    if (!empty($form_heading)) {
        $desktop .= '</h3>';
        $mobile  .= '</h5>';
    }

    if (!empty($form_description)) {
        $desktop .= '<p class="d-none d-md-block mb-0">' . $form_description['desktop'] . '</p></div>';
        $mobile  .= '<p class="d-block d-md-none mb-0">' . $form_description['mobile'] . '</p></div>';
    }

    return $desktop . $mobile;
}

//region Output (Views)
function output_hero_heading($hero)
{
    $heading_1_classes = ($hero['type'] !== "masonry") ? "text-white" : "";
    $heading_2_classes = ($hero['type'] === "masonry") ? "text-primary text-gradient" : " stylized text-secondary-500";

    if (!empty($hero['copy']['heading_1'])) {

        $heading  = '<h1 class="mb-0 ' . $heading_1_classes . '">' .  $hero['copy']['heading_1']['desktop'];

        if (!empty($hero['copy']['heading_2'])) {
            $heading .= '<span class="d-block ' . $heading_2_classes . '">' .  $hero['copy']['heading_2']['desktop'] . '</span>';
        }

        $heading .= '</h1>';
    }

    return $heading;
}

function hero_heading($hero, $size = 'desktop')
{
    $heading = (isset($hero['copy']['heading_1'][$size]) && !empty($hero['copy']['heading_1'][$size])) ? $hero['copy']['heading_1'][$size] : $hero['copy']['heading_1']['desktop'];
    $heading2 = (isset($hero['copy']['heading_2'][$size]) && !empty($hero['copy']['heading_2'][$size])) ? $hero['copy']['heading_2'][$size] : $hero['copy']['heading_2']['desktop'];

    if (isset($heading)) {
        $output  = '<h1 class="">' . $heading;
    }

    if (isset($heading2)) {
        $output .= '<span class="stylized d-block mt-1">' . $heading2 . '</span>';
    }

    if (isset(($output))) {
        $output .= '</h1>';
        return $output;
    }
}

function hero_description($hero, $size = 'desktop')
{
    $description = (isset($hero['copy']['description'][$size]) && !empty($hero['copy']['description'][$size])) ? $hero['copy']['description'][$size] : $hero['copy']['description']['desktop'];

    if (isset($description)) {
        $classes = get_hero_copy_classes($hero);
        $output  = '<div class="mt-4 px-3 px-md-0">';
        $output .= '<p class="text-white/90 text-base mt-6">';
        $output .= $description . '</p>';
        $output .= '</div>';
    }

    return isset($output) ? $output : null;
}

function hero_callouts($hero, $size = "desktop")
{

    if (isset($hero['callouts']) && !empty($hero['callouts'])) {
        $callouts  = '<div class="my-4 py-4 px-2 px-md-0 hero-callouts">';
        $callouts .= '<ul class="list-group border-0">';

        foreach ($hero['callouts'] as $callout) {
            $callout_key = (isset($callout[$size]) && !empty($callouts[$size])) ? $size : 'desktop';
            $callouts .= '<li class="list-group-item bg-transparent text-start ps-0 border-0 py-1 ps-1 pe-0">';
            $callouts .= '<p class="mb-0 pb-0 fw-600 grayscale"><i class="fa-solid fa-check pe-2 pe-md-3"></i>' . $callout[$callout_key] . '</p></li>';
        }

        $callouts .= '</ul>';
        $callouts .= '</div>';
    }

    return (isset($callouts)) ? $callouts : null;
}

function output_hero_description($hero)
{
    if (!empty($hero['copy']['description']['desktop'])) {

        $classes = get_hero_copy_classes($hero);

        $description = '<div class="mt-4">';
        $description .= '<p class="' . $classes['description'] . '">';
        $description .= $hero['copy']['description']['desktop'] . '</p>';
        $description .= '</div>';
    }

    return (isset($description)) ? $description : null;
}

function output_hero_callouts($hero)
{

    if (!empty($hero['callouts']) && strlen($hero['callouts'][0]) > 0) {

        $callouts_array = $hero['callouts'];

        $callouts = '<div class="my-4 py-4 hero-callouts">';

        $callouts  .= '<ul class="list-group border-0">';

        foreach ($callouts_array as $callout_item) {

            $callouts .= '<li class="list-group-item bg-transparent ps-0 border-0 py-1 ps-1 pe-0">';
            $callouts .= '<p class="mb-0 pb-0 fw-600 grayscale"><i class="fa-solid fa-check pe-3"></i>' . $callout_item . '</p></li>';
        }

        $callouts .= '</ul>';

        $callouts .= '</div>';
    }

    return ($callouts) ?: null;
}

function output_hero_links($hero, $format = "desktop")
{
    $links_array = $hero['links'];
    $links_count = count($hero['links']);
    $container_class = ($format === "mobile") ? 'justify-content-center flex-column' : '';

    $output = '<div class="hero-links my-4 py-2 ' . $container_class . ' " data-count="' . $links_count . '">';

    foreach ($links_array as $link) {
        $copy_array = get_desktop_mobile_copy($link['copy']);

        switch ($link['style']) {
            case "Button":
                $classes = 'class="btn bg-orange btn-lg mb-0" ';
                break;
            case "Text":
                $classes = 'class="text-link" ';
                break;
        }

        switch ($link['type']) {
            case "Page":
                $el_type = 'a';
                $attributes = 'href="' . $link['destination'] . '" ';
                break;
            case "Phone":
                $el_type = 'a';
                $attributes = 'href="tel:+' . $link['destination'] . '" ';
                break;
            case "Anchor":
                $el_type = 'a';
                $attributes = 'href="#' . $link['destination'] . '" ';
                break;
            case "Modal":
            case "Form":
                $el_type = 'button';
                $attributes = 'data-target="' . $link['destination'] . '" ';
                break;
        }

        if ($el_type && $attributes) {
            $link_container_class = ($format === "mobile") ? 'mx-auto text-center' : 'justify-start';
            $refer_post = isset($hero['refer_post']) ? $hero['refer_post'] : null;
            $link_text = (isset($copy_array[$format])) ? $copy_array[$format] : $copy_array['desktop'];
            $link_copy = replace_variable_in_copy($link_text, $refer_post);

            if ($link['type'] === 'Phone') {
                $link_copy = '<span class="d-block lh-1 phone-callout fw-normal small">' . $link_copy . '</span>' . $link['destination'];
            }

            $output .= '<div class="d-inline-flex  ' . $link_container_class . '">';
            $output .= '<' . $el_type . ' ';
            $output .= $attributes . $classes . ' data-type="' . $link['type'] . '">';
            $output .= $link_copy;
            $output .= '</' . $el_type . '>';
            $output .= '</div>';
        }
    }

    $output .= '</div>';

    return ($output) ?: null;
}

function output_itinerary_links($hero, $format = "desktop") {}

function output_masonry_images($image_array)
{
    $output = '<div class="row">';
    $i = 1;
    $start_array = [1, 2, 4, 6];
    $end_array = [3, 5, 7];

    foreach ($image_array as $image) {

        if ($i > 7) {
            break;
        }

        if (in_array($i, $start_array)) {
            $start = '<div class="col-lg-3 col-6">';
            $end = '';
        }
        if (in_array($i, $end_array)) {
            $start = '';
            $end = '</div>';
        }
        if ($i === 1) {
            $end = '</div>';
        }

        $classes = get_masonry_image_attributes($i);
        $images  = '<div class="d-inline-block">';
        $images .= '<img class="' . $classes . '" src="' . $image . '" /></div>';

        $output .= $start . $images . $end;
        $i++;
    }
    $output .= '</div>';

    return $output;
}
//endregion


//region Data (Models)
function get_hero_copy_classes($hero)
{
    $classes = [];

    if ($hero['type'] === 'text-center') {
        $classes['description'] = 'lead text-white mt-3 px-md-5';
    }
    if ($hero['type'] === 'text-left') {
        $classes['description'] = 'mt-3 lead text-white';
    }
    if ($hero['type'] === 'masonry') {
        $classes['description'] = 'lead fw-500 text-body-dark';
    }

    return $classes;
}

function get_hero_callouts_legacy($object)
{
    $object_type = get_object_type($object);
    $hero_callouts = [];

    switch ($object_type) {
        case "page":
        case "trip":
            $inputs = get_field('hero_banner_shared', $object->ID);
            $callouts_array = $inputs['hero_callouts'];

            if (!empty($callouts_array)) {
                $dynamic = $inputs['dynamic_insertion'] ?: null;

                foreach ($callouts_array as $callout) {
                    $hero_callouts[] = get_desktop_mobile_copy($callout['callout'], "\n", $dynamic);
                }
            }
            break;
    }

    return $hero_callouts ?: null;
}

function get_hero_callouts($object)
{
    $hero_callouts = [];
    $inputs = get_field('hero_banner_shared', $object);
    $callouts_array = $inputs['hero_callouts'];

    if (!empty($callouts_array)) {
        $dynamic = $inputs['dynamic_insertion'] ?: null;

        foreach ($callouts_array as $callout) {
            $icon = isset($callout['icon']) ? '<img src="' . $callout['icon'] . '" class="max-w-12 max-h-12 filter-dark object-cover inline pr-4" />' : '<i class="fa-solid fa-check pe-2 pe-md-3"></i>';

            $callout_item = get_desktop_mobile_copy($callout['callout'], "\n", $dynamic);
            $callout_item['icon'] = $icon;

            $hero_callouts[] = $callout_item;
        }
    }

    return $hero_callouts ?: null;
}

function get_hero_links_legacy($object)
{
    $object_type = get_object_type($object);
    $hero_links = [];

    switch ($object_type) {
        case "page":
        case "trip":
            $inputs = get_field('hero_banner_shared', $object->ID);

            if ($inputs['links_links']) {

                foreach ($inputs['links_links'] as $link) {

                    $link_array = [];

                    switch ($link['type']) {
                        case "Page":
                            $link_array['destination'] = $link['link'];
                            break;
                        case "Anchor":
                            $link_array['destination'] = $link['anchor'];
                            break;
                        case "Modal":
                            $link_array['destination'] = $link['modal'];
                            break;
                        case "Phone":
                            $link_array['destination'] = $link['phone'];
                            break;
                        case "Form":
                            $link_array['destination'] = "form";
                            break;
                    }

                    $link_array['type'] = $link['type'];
                    $link_array['style'] = $link['style'];
                    $link_array['copy'] = $link['copy'];

                    $hero_links[] = $link_array;
                }
            }
    }

    return $hero_links;
}

function get_hero_links($object)
{
    $inputs = get_field('hero_banner_shared', $object);

    if ($inputs['links_links']) {

        foreach ($inputs['links_links'] as $link) {

            $link_array = [];

            switch ($link['type']) {
                case "Page":
                    $link_array['destination'] = $link['link'];
                    break;
                case "Anchor":
                    $link_array['destination'] = $link['anchor'];
                    break;
                case "Modal":
                    $link_array['destination'] = $link['modal'];
                    break;
                case "Phone":
                    $link_array['destination'] = $link['phone'];
                    break;
                case "Form":
                    $link_array['destination'] = "form";
                    break;
            }

            $link_array['type'] = $link['type'];
            $link_array['style'] = $link['style'];
            $link_array['copy'] = $link['copy'];

            $hero_links[] = $link_array;
        }
    }

    return $hero_links;
}

function get_masonry_image_attributes($count)
{
    switch ($count) {
        case 1:
            return "w-full rounded-lg shadow-lg mt-0 lg:mt-24 aspect-[7/12]";
            // return "w-100 border-radius-lg shadow mt-0 mt-lg-7";
        case 2:
            return "w-full rounded-lg shadow-lg aspect-[7/12]";
            // return "w-100 border-radius-lg shadow";
        case 3:
        case 5:
        case 7:
            return "w-full rounded-lg shadow-lg mt-0 lg:mt-6 aspect-[7/12]";
            // return "w-100 border-radius-lg shadow mt-4";
        case 4:
            return "w-full rounded-lg shadow-lg mt-0 lg:mt-12 aspect-[7/12]";
            // return "w-100 border-radius-lg shadow mt-0 mt-lg-5";
        case 6:
            return "w-full rounded-lg shadow-lg mt-0 lg:mt-4 aspect-[7/12]";
            // return "w-100 border-radius-lg shadow mt-3";
    }
}

function get_hero_masonry_images_legacy($object, $object_type = null)
{
    $object_type = ($object_type) ?: get_object_type($object);
    $hero_masonry = [];

    switch ($object_type) {
        case "page":
            $inputs = get_field('hero_banner_shared', $object->ID);

            if ($inputs['hero_masonry_images']) {
                foreach ($inputs['hero_masonry_images'] as $image) {
                    $hero_masonry[] = $image['hero_masonry_image'];
                }
            }
    }

    return $hero_masonry;
}

function get_hero_masonry_images($object, $object_type = null)
{
    $hero_masonry = [];
    $inputs = get_field('hero_banner_shared', $object);

    if ($inputs['hero_masonry_images']) {
        foreach ($inputs['hero_masonry_images'] as $image) {
            $hero_masonry[] = $image['hero_masonry_image'];
        }
    }

    return $hero_masonry;
}

function get_hero_images_legacy($object, $hero_type = null)
{
    $object_type = get_object_type($object);
    $hero_images = [];

    switch ($object_type) {
        case "page":
        case "trip":
            $inputs = get_field('hero_banner_shared', $object->ID);
            if ($inputs) {
                $hero_images['background_image'] = $inputs['background_image'];
                $hero_images['mobile_image'] = $inputs['mobile_image'];
            }
            if ($hero_type === "masonry") {
                $hero_images['masonry'] = get_hero_masonry_images($object);
            }
    }

    return $hero_images;
}

function get_hero_images($object, $hero_type = null)
{
    $hero_images = [];
    $inputs = get_field('hero_banner_shared', $object);

    if ($inputs) {
        $hero_images['background_image'] = $inputs['background_image'];
        $hero_images['mobile_image'] = $inputs['mobile_image'];
    }
    if ($hero_type === "masonry") {
        $hero_images['masonry'] = get_hero_masonry_images($object);
    }

    return $hero_images;
}

function get_hero_stats_legacy($object)
{
    $inputs = get_field('hero_banner_shared', $object->ID);

    if ($inputs && $inputs['stats_include_stats']) {
        return $inputs['stats_stats'];
    }
}

function get_hero_stats($object)
{
    $inputs = get_field('hero_banner_shared');

    if ($inputs && $inputs['stats_include_stats']) {
        return $inputs['stats_stats'];
    }
}

function get_hero_copy_legacy($object)
{
    $object_type = get_object_type($object);
    $hero_copy = [];

    switch ($object_type) {
        case "page":
        case "trip":
            $inputs = get_field('hero_banner_shared', $object->ID);
            if ($inputs) {
                $hero_copy['text_color'] = $inputs['text_color'];
                $hero_copy['mobile_text_color'] = $inputs['mobile_text_color'];
                $hero_copy['heading_1'] = get_desktop_mobile_copy($inputs['hero_heading_1']);
                $hero_copy['heading_2'] = get_desktop_mobile_copy($inputs['hero_heading_2']);
                $hero_copy['description'] = get_desktop_mobile_copy($inputs['hero_description'], "\n");
            }
    }

    return $hero_copy;
}

function get_hero_copy($object)
{
    $inputs = get_field('hero_banner_shared', $object);

    if ($inputs) {
        $hero_copy['text_color'] = $inputs['text_color'];
        $hero_copy['mobile_text_color'] = $inputs['mobile_text_color'];
        $hero_copy['heading_1'] = get_desktop_mobile_copy($inputs['hero_heading_1']);
        $hero_copy['heading_2'] = get_desktop_mobile_copy($inputs['hero_heading_2']);
        $hero_copy['description'] = get_desktop_mobile_copy($inputs['hero_description'], "\n");
    }

    return $hero_copy;
}

function get_hero_wave_legacy($object)
{
    $object_type = get_object_type($object);

    switch ($object_type) {
        case "page":
        case "trip":
            $inputs = get_field('hero_banner_shared', $object->ID);
            return strtolower(str_replace(" ", "-", $inputs['motion']));
    }
}

function get_hero_wave($object)
{
    $inputs = get_field('hero_banner_shared', $object->ID);

    return strtolower(str_replace(" ", "-", $inputs['motion']));
}

function get_hero_type_legacy($object)
{
    $object_type = get_object_type($object);

    switch ($object_type) {
        case "page":
        case "trip":
            $inputs = get_field('hero_banner_shared', $object->ID);
            return strtolower(str_replace(" ", "-", $inputs['hero_type']));
    }
}

function get_hero_type($object)
{
    $inputs = get_field('hero_banner_shared', $object);

    return strtolower(str_replace(" ", "-", $inputs['hero_type']));
}

function get_hero_dynamic_text($object)
{
    $object_format = ($object->ID) ? "post" : "taxonomy";

    switch ($object_format) {
        case "post":
            $inputs = get_field('hero_banner_shared', $object->ID);
            return $inputs['dynamic_insertion'];
        case "taxonomy":
            $inputs = get_field('hero_banner_shared', $object->term_id);
            return $inputs['dynamic_insertion'];
    }
}

function get_hero_include_legacy($object)
{
    $object_type = get_object_type($object);

    switch ($object_type) {
        case "page":
        case "trip":
            return  get_field('include_hero_banner', $object->ID);
    }
}

function get_hero_include($object)
{
    return  get_field('include_hero_banner', $object);
}

function get_hero_inputs($object)
{
    $hero = [];
    $hero['include'] = get_hero_include($object);
    $hero['type'] = get_hero_type($object);
    $hero['dynamic'] = get_hero_dynamic_text($object);
    $hero['template'] = ($hero['type'] === 'masonry') ? 'masonry' : 'text-overlay';
    $hero['wave'] = get_hero_wave($object);
    $hero['images'] = get_hero_images($object, $hero['type']);
    $hero['copy'] = get_hero_copy($object);
    $hero['callouts'] = get_hero_callouts($object);
    $hero['links'] = get_hero_links($object);
    $hero['stats'] = get_hero_stats($object);


    return $hero;
}

//endregion