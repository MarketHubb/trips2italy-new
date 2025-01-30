<?php
/* Template Name: Flexible */

get_header();

$flexible_sections = get_field('flexible_content', get_the_ID());

if (!empty($flexible_sections)) {
    foreach ($flexible_sections as $section) {
        if ($section['acf_fc_layout'] === 'included') {
        }
        $section_data = get_flexible_section_data($section);
        if ($section_data['name'] === 'included') {
        }

        if (!empty($section_data) && !empty($section_data['content'])) {
            echo render_section($section_data);
        }
    }
}

get_footer();