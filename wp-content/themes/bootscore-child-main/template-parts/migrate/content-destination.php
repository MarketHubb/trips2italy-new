<?php

$culture = get_posts(array(
    'post_type' => 'page',
    'p' => 4605
));

$footer_array = ["Abruzzo", "Aosta Valley", "Apulia", "Basilicata", "Calabria", "Campania", "Emilia Romagna", "Friuli Venezia Giulia", "Lazio", "Liguria", "Marche", "Molise", "Piedmont", "Lombardy", "Sardinia", "Sicily", "Trentino Alto Adige", "Veneto", "Tuscany", "Umbria"];

$missing_cities = ["L’Aquila", "Alberobello", "Lecce", "Matera", "Reggio", "Calabria", "Capri", "Sorrento", "Amalfi", "Trieste", "Portofino", "Milan", "Casale", "Monferrato", "Vercelli", "Cagliari", "Taomina", "Ragusa", "Florence", "Pisa", "Siena", "Volterra", "Assisi"];



$all_region_parent_pages = get_posts(array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent__in' => [530]
));

foreach ($all_region_parent_pages as $page_parent) {
    // This is what we can query the regions by (15 out of 20 returned)
    $parent_page_title = get_the_title($page_parent->ID);
    $sanitized_parent_page_title = sanitize_title(get_the_title($page_parent->ID));

    echo "<strong>$parent_page_title  ($page_parent->ID)</strong><br>";

    $region_child_pages = array(
        'post_type' => 'page',
        'post_per_page' => -1,
        'post_status' => 'any',
        'post_parent__in' => [$page_parent->ID]
//        'post_parent__in' => [4586]
    );

    $query = new WP_Query($region_child_pages);

    if ($query->have_posts()) :
    	while ($query->have_posts()) : $query->the_post();
            $child_page_title = get_the_title($post->ID);
            $child_page_id = $post->ID;

            // Make sure we can find the region tax by region page name (sanitized)
            $region_terms_by_page_title = get_terms(array(
                'taxonomy' => 'region',
                'name' => $sanitized_parent_page_title
            ));

            // We have the parent region and the child page
            foreach ($region_terms_by_page_title as $region) {
                $term_fields = [];
                $title = get_the_title($child_page_id);
                $title_decoded = htmlspecialchars_decode($title);
                $formatted_title = trim(str_replace(" &#8211;", "",str_replace(trim(get_the_title($post->post_parent)),"", format_region_title($post->ID, $title))));
                $region_title = trim(get_the_title($post->post_parent)) . " " . $formatted_title;
                echo $region_title . "<br>";

                $content = $post->post_content;
                $content_clean = remove_embeds_from_content($content);
                $content_clean_array = explode("\n", trim($content_clean));
                $gallery_images = getEmbeddedPageBuilderVals($content, '[vc_gallery type="image_grid"', 'images');
                $legacy_shortcodes = getLegacyShortcodes($child_page_id, ['image_slider', 'custom_permalink']);

                // Featured Image
                $term_fields['field_63a4ac920c8e2'] = $legacy_shortcodes['image_slider'];
                // Legacy ID
                $term_fields['field_63aba050495fc'] = $child_page_id;
                // Image Slider URL
                $term_fields['field_63bb47817f913'] = $legacy_shortcodes['image_slider'];
                // Image IDs
                $term_fields['field_63c8a880cef99'] = $gallery_images;
                // Legacy Content
                $term_fields['field_63aba02486312'] = $content;
                // Content (Clean)
                $term_fields['field_63ab9e6c2d891'] = $content_clean;
                // Standardized title
                $term_fields['field_64618f2297f4d'] = $formatted_title;

                $term_exists = term_exists($child_page_title, 'region', $region->term_id);

                if (!$term_exists) {

                        $term_exists = wp_insert_term(
                            $region_title,
                            'region',
                            array(
                                'parent'      => $region->term_id,
                            )
                        );

                    }

                if (is_array($term_exists)) {
                        $region_term = get_term($term_exists['term_id']);
                        foreach ($term_fields as $key => $val) {
                            update_field( $key, $val, 'region_' . $term_exists['term_id'] );
                        }

                    }
            }

    	endwhile;
    endif; wp_reset_postdata();


}