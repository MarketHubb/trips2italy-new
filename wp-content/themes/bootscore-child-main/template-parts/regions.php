<h1>Regions.php</h1>
<?php
$footer_array = ["Abruzzo","Aosta Valley","Apulia","Basilicata","Calabria","Campania","Emilia Romagna","Friuli Venezia Giulia","Lazio","Liguria","Marche","Molise","Piedmont","Lombardy","Sardinia","Sicily","Trentino Alto Adige","Veneto","Tuscany","Umbria"];
$missing_cities = ["L’Aquila","Alberobello","Lecce","Matera","Reggio", "Calabria","Capri","Sorrento", "Amalfi","Trieste","Portofino","Milan","Casale", "Monferrato","Vercelli","Cagliari","Taomina","Ragusa","Florence","Pisa","Siena","Volterra","Assisi"];

/*
 * Required fields for wp_insert_post(array);
 *
 * WORDPRESS FIELDS
 * post_title - DONE
 * post_name - DONE
 * post_content - DONE
 * post_author - DONE
 * post_date - DONE
 * post_status - DONE
 * guid - DONE
 * post_type - DONE
 * tax_input (taxonomy)
 * post_parent (Default 0)
 *
 * ACF FIELDS
 * featured_image - DONE
 * content (clean) -
 * images (repeater: image, description) -
 * page_id -
 * permalink - DONE
 * image_slider (SC)
 * ultimate_reviews (SC)
 * wud_category_links (SC)
 * content_embed (raw)
 *
* featured_image -
* content (clean) -
* images (repeater: image, description ** ID's **) -
* legacy_id - DONE
* legacy_content - DONE
* permalink - DONE
* image_slider (SC) - DONE
* ultimate_reviews (SC)
* wud_category_links (SC)
* content_embed (raw)
 *
 * CONSIDERATIONS
 * - When inserting posts
 *
 *      1. Need to account for Region children, before creating city parents
 *      2. City parents must be created first
 *          assigned to region (tax_input)
 *      3. City children must be created second
 *          assigned to parent (post_parent)
 *
 *      if great grandparent === Italian Travel Guides by Region (530)
 *          page === city child
 *
 *      if grandparent === Italian Travel Guides by Region (530)
 *          page === city parent
 *
 *
 * CREATING REGION PAGES / SUB-PAGES
 *
 *
 * */
function find_region_tax_for_page($post_id) {
    $page_name = get_the_title($post_id);

    $tax_regions = get_terms(array(
            'taxonomy' => 'region',
            'hide_empty' => false
        )
    );

    $region_names = [];

    foreach ($tax_regions as $region) {
        $region_names[$region->name] = $region->term_id;
    }

    foreach ($region_names as $key => $val) {
        if (trim($key) === trim($page_name)) {
            return [
                'name' => $key,
                'id' => $val
            ];
        }
    }
}

$page_args = array(
    'post_type' => 'page',
    'posts_per_page' => -1
);

$query = new WP_Query($page_args);

if ($query->have_posts()) :
    $output = '';
    $page_regions = [];
    $post_core = [];
    $post_custom = [];
    $i = 1;

    while ($query->have_posts()) : $query->the_post();
        $parent = get_post_parent($post->ID);
        $grandparent = get_post_parent($post->post_parent);
        $great_grandparent = get_post_parent($grandparent);
        $ancestor_array = [530,176];

        if ($parent->ID === 530) {
            $region = find_region_tax_for_page(get_the_ID());
            echo '<h1>' . $i . ' - ' . get_the_title() . ' (Page ID:' . get_the_ID() . ' | Tax ID: ' . $region['id'] .  ')</h1>';

            $parent_id = get_the_ID();

            $wrongly_assigned = [15401, 25099, 18620, 22396, 22376, 18546, 25063, 15880, 18618, 14613, 25051, 18360, 18431, 21291, 18529, 18376, 15105, 25077, 18451, 25131, 8776, 24917, 24503, 18556, 18403, 14214, 18421, 25007, 24948, 18461, 8796, 24550, 24475, 21250, 15940, 15355, 5032, 18508, 15320, 16022, 12395, 24560, 24531, 15500, 16039, 14125, 18566, 14255, 14160, 18335, 18395, 24964, 18441, 14357, 25026, 24860, 24844, 24622, 15371, 16813, 18597, 14365, 14100, 22406, 1534, 15341];

            $child_posts = get_posts(array(
                'post_type' => 'page',
                'posts_per_page' => -1,
                'post_parent' => $parent_id
            ));

            foreach ($child_posts as $child) {
                if (!in_array($child->ID, $wrongly_assigned)) {
                    echo '<p>' . get_the_title($child->ID) . ' (' . $child->ID . ')' . '</p>';

                    $content = get_the_content(null,false,$child->ID);
                    $content_clean = remove_embeds_from_content($content);
                    $gallery_images = getEmbeddedPageBuilderVals($content, '[vc_gallery type="image_grid"', 'images');

                    // FIELDS: WordPress Core

                    /*
                     * NEED TO DO:
                     * 1. Clean post title
                     * 2. Populate meta custom fields (Tax Page, City Name, Standardized Title)
                     * 3. Set post_parent and taxonomy
                     * 4. Configure / clean legacy content
                     *
                     *
                     */

                    $post_core['post_title'] = get_the_title();
                    $post_core['post_name'] = $post->name;
                    $post_core['post_content'] = $post->post_content;
                    $post_core['post_author'] = $post->post_author;
                    $post_core['post_date'] = $post->post_date;
                    $post_core['post_status'] = $post->post_status;
                    $post_core['guid'] = $post->guid;
                    $post_core['post_type'] = 'city';
                    $post_core['new_parent'] = get_new_post_parent($post->post_parent);
                    $post_core['post_parent'] = $post_core['new_parent'][0]->ID;

                    if (isset($region)) {
                        $post_core['region'] = $region['name'];
                    }

                    if (isset($content_clean)) {
                        $post_custom['content_clean'] = array(
                            'type' => 'basic',
                            'key' => 'field_63ab9e6c2d891',
                            'field' => 'content_clean',
                            'value' => $content_clean
                        );
                    }

                    $legacy_shortcodes = getLegacyShortcodes($post->ID, ['image_slider', 'custom_permalink']);

                    if (isset($legacy_shortcodes['image_slider'])) {
                        $post_custom['image_slider_url'] = array(
                            'type' => 'basic',
                            'key' => 'field_63bb47817f913',
                            'field' => 'image_slider_url',
                            'value' => $legacy_shortcodes['image_slider']
                        );
                    }

                    // FIELDS: Custom (ACF)
                    $post_custom['legacy_id'] = array(
                        'type' => 'basic',
                        'key' => 'field_63aba050495fc',
                        'field' => 'legacy_id',
                        'value' => $post->ID
                    );
                    $post_custom['legacy_content'] = array(
                        'type' => 'basic',
                        'key' => 'field_63aba02486312',
                        'field' => 'legacy_content',
                        'value' => $post->post_content,
                    );
                    $post_custom['permalink'] = array(
                        'type' => 'basic',
                        'key' => 'field_63ab9f6a6d949',
                        'field' => 'legacy_permalink',
                        'value' => get_the_permalink($post->ID),
                    );
                    $post_custom['gallery_images'] = array(
                        'type' => 'basic',
                        'key' => 'field_63c8a880cef99',
                        'field' => 'image_id',
                        'value' => $gallery_images
                    );
                    $post_custom['tax_page'] = array(
                        'type' => 'basic',
                        'key' => 'field_6475704842b80',
                        'field' => 'tax_page',
                        'value' => true
                    );
                     $post_custom['tax_name'] = array(
                        'type' => 'basic',
                        'key' => 'field_6475e7f4f624f',
                        'field' => 'tax_name',
                        'value' => $region['name']
                    );
                     $post_custom['standardized_title'] = array(
                        'type' => 'basic',
                        'key' => 'field_64618f2297f4d',
                        'field' => 'standardized_title',
                        'value' => format_region_child_page_type($child->ID)
                    );
                     
                     highlight_string("<?php\n\$post_custom['standardized_title'] =\n" . var_export($post_custom['standardized_title'], true) . ";\n?>");

                }
            }

            $i++;

        }

        // CITY (CHILD)
//        if ($great_grandparent->ID === 530) {
//            $region = get_the_title($grandparent->ID);

//            // Set Region
//            if ($great_grandparent->ID === 176) {
//                if (!in_array(get_the_title($parent->ID), $page_regions) && $parent->ID !== 176 ) {
//                    $region = get_the_title($parent->ID);
//                }
//            }
//            if ($great_grandparent->ID === 530) {
//                if (!in_array(get_the_title($grandparent->ID), $page_regions) && $grandparent->ID !== 176 ) {
//                    $region = get_the_title($grandparent->ID);
//                }
//            }


//            if (isset($region)) {
//                $post_core['region'] = $region;
//            }
//            if (isset($post->featured_image)) {
//                $post_array['featured_image'] = $post->featured_image;
//            }



//            $content = get_the_content(null, false, $post->ID);
//            $content_clean = remove_embeds_from_content($content);

//            if (isset($content_clean)) {
//                $post_custom['content_clean'] = array(
//                    'type' => 'basic',
//                    'key' => 'field_63ab9e6c2d891',
//                    'field' => 'content_clean',
//                    'value' => $content_clean
//                );
//            }

//            $legacy_shortcodes = getLegacyShortcodes($post->ID, ['image_slider', 'custom_permalink']);
//            if (isset($legacy_shortcodes['image_slider'])) {
//                $post_custom['image_slider_url'] = array(
//                    'type' => 'basic',
//                    'key' => 'field_63bb47817f913',
//                    'field' => 'image_slider_url',
//                    'value' => $legacy_shortcodes['image_slider']
//                );
//            }

            // CREATE Post
             if (isset($post_core) && isset($post_custom)) {
                 if (isset($post_core['post_parent'])) {
                     create_city($post_core, $post_custom);
                 }
             }

//        } // END ($great_grandparent->ID === 530) {

    endwhile;
//    echo $output;
endif; wp_reset_postdata();

?>
