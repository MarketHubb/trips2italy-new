<?php
// Custom logging function
function custom_error_log($message) {
    $log_file = WP_CONTENT_DIR . '/custom-debug.log';
    error_log(date('[Y-m-d H:i:s] ') . $message . "\n", 3, $log_file);
}

// 1. Rewrite URLs for single-location posts
function custom_location_post_link($post_link, $post) {
    if (is_object($post) && $post->post_type == 'location') {
        $terms = wp_get_object_terms($post->ID, 'region');
        if ($terms) {
            $region_slug = $terms[0]->slug;
            return home_url($region_slug . '/' . $post->post_name . '/');
        }
    }
    return $post_link;
}
add_filter('post_type_link', 'custom_location_post_link', 10, 2);

// 2. Rewrite URLs for region taxonomy pages
function custom_region_term_link($termlink, $term, $taxonomy) {
    if ($taxonomy == 'region') {
        return home_url($term->slug . '/');
    }
    return $termlink;
}
add_filter('term_link', 'custom_region_term_link', 10, 3);

// 3. Add rewrite rules
function custom_rewrite_rules() {
    custom_log('Adding custom rewrite rules');
    add_rewrite_rule('^([^/]+)/([^/]+)/?$', 'index.php?location=$matches[2]', 'top');
    add_rewrite_rule('^([^/]+)/([^/]+)/([^/]+)/?$', 'index.php?location=$matches[2]&name=$matches[3]', 'top');
    add_rewrite_rule('^([^/]+)/?$', 'index.php?region=$matches[1]', 'top');
    custom_log('Custom rewrite rules added');
}
add_action('init', 'custom_rewrite_rules', 10);

// 4. Flush rewrite rules (called from functions.php)
function custom_flush_rewrite_rules() {
    custom_rewrite_rules();
    flush_rewrite_rules();
}

// 5. Setup 301 redirects using the Redirection plugin's REST API
function custom_add_redirects($post_id = null, $process_all = false) {
    custom_error_log("Starting custom_add_redirects function");

    // If processing all (manual trigger or theme activation)
    if ($process_all) {
        custom_error_log("Processing all locations and regions");

        // Process all locations
        $locations = get_posts(array('post_type' => 'location', 'numberposts' => -1));
        custom_error_log("Found " . count($locations) . " locations");
        foreach ($locations as $location) {
            custom_error_log("Processing location: " . $location->post_title);
            process_location_redirect($location);
        }

        // Process all regions
        $regions = get_terms(array('taxonomy' => 'region', 'hide_empty' => false));
        custom_error_log("Found " . count($regions) . " regions");
        foreach ($regions as $region) {
            custom_error_log("Processing region: " . $region->name);
            process_region_redirect($region);
        }
        custom_error_log("Finished processing all locations and regions");
        return;
    }

    // If a post ID is provided, only process that specific post
    if ($post_id) {
        $post = get_post($post_id);
        if ($post && $post->post_type === 'location') {
            custom_error_log("Processing single location: " . $post->post_title);
            process_location_redirect($post);
        }
        return;
    }

    custom_error_log("Finished custom_add_redirects function");
}

function process_location_redirect($location) {
    $old_url = 'location/' . $location->post_name;
    $terms = wp_get_object_terms($location->ID, 'region');
    if ($terms) {
        $region_slug = $terms[0]->slug;
        $new_url = $region_slug . '/' . $location->post_name;
        create_redirect_if_not_exists($old_url, $new_url);
    }
}

function process_region_redirect($region) {
    $old_url = 'region/' . $region->slug;
    $new_url = $region->slug;
    create_redirect_if_not_exists($old_url, $new_url);
}

function create_redirect_if_not_exists($old_url, $new_url) {
    custom_log("Attempting to create redirect: $old_url -> $new_url");
    
    $api_url = rest_url('redirection/v1/redirect');
    $nonce = wp_create_nonce('wp_rest');

    custom_log("API URL: $api_url");
    custom_log("Nonce: $nonce");

    // Check if redirect already exists
    $existing_redirects = wp_remote_get($api_url . '?url=' . urlencode($old_url), array(
        'headers' => array(
            'X-WP-Nonce' => $nonce
        )
    ));

    if (is_wp_error($existing_redirects)) {
        custom_log('Error checking existing redirects: ' . $existing_redirects->get_error_message());
        return;
    }

    $response_code = wp_remote_retrieve_response_code($existing_redirects);
    $response_body = wp_remote_retrieve_body($existing_redirects);

    custom_log('Response code: ' . $response_code);
    custom_log('Response body: ' . $response_body);

    if ($response_code !== 200) {
        custom_log('Error checking existing redirects. Response code: ' . $response_code);
        custom_log('Response: ' . $response_body);
        return;
    }

    $redirects = json_decode($response_body, true);

    if (empty($redirects['items'])) {
        custom_log("No existing redirect found. Creating new redirect.");
        // Create new redirect
        $response = wp_remote_post($api_url, array(
            'headers' => array(
                'X-WP-Nonce' => $nonce,
                'Content-Type' => 'application/json'
            ),
            'body' => json_encode(array(
                'url' => $old_url,
                'action_data' => array('url' => $new_url),
                'action_type' => 'url',
                'action_code' => 301,
                'group_id' => 1,
                'position' => -1
            ))
        ));

        if (is_wp_error($response)) {
            custom_log('Error creating redirect: ' . $response->get_error_message());
        } else {
            $response_code = wp_remote_retrieve_response_code($response);
            $response_body = wp_remote_retrieve_body($response);
            custom_log('Create redirect response code: ' . $response_code);
            custom_log('Create redirect response body: ' . $response_body);
            
            if ($response_code !== 200) {
                custom_log('Error creating redirect. Response code: ' . $response_code);
                custom_log('Response: ' . $response_body);
            } else {
                custom_log("Redirect created successfully.");
            }
        }
    } else {
        custom_log("Existing redirect found. Skipping creation.");
    }

    usleep(250000); // 0.25 seconds
}

// Hook for when a location post is saved
add_action('save_post_location', 'custom_add_redirects');

// Hook for when a region term is created or edited
add_action('created_region', 'custom_add_region_redirect');
add_action('edited_region', 'custom_add_region_redirect');

function custom_add_region_redirect($term_id) {
    $term = get_term($term_id, 'region');
    if ($term && !is_wp_error($term)) {
        process_region_redirect($term);
    }
}