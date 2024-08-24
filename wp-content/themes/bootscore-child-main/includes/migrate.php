<?php 
// region Package
function update_package_urls_and_title() {
    $packages = get_posts(array(
        'post_type' => 'package',
        'numberposts' => -1,
        'post_status' => 'any',
    ));

    $current_year = date('Y');
    $next_year = $current_year + 1;
    $old_year_patterns = array('2021 &#8211; 2022', '2021 – 2022');
    $new_year_string = "$current_year – $next_year";

    foreach ($packages as $package) {
        $title = $package->post_title;
        $needs_update = false;

        foreach ($old_year_patterns as $pattern) {
            if (strpos($title, $pattern) !== false) {
                $needs_update = true;
                break;
            }
        }

        if ($needs_update) {
            // Add current title and permalink to the 'urls' repeater field
            $urls = get_field('urls', $package->ID);
            $urls[] = array(
                'post_title' => $title,
                'permalink' => get_permalink($package->ID)
            );
            update_field('urls', $urls, $package->ID);

            // Update the post title
            $new_title = str_replace($old_year_patterns, $new_year_string, $title);
            
            // Update the post slug
            $new_slug = sanitize_title($new_title);

            // Update the post
            $updated_post = wp_update_post(array(
                'ID' => $package->ID,
                'post_title' => $new_title,
                'post_name' => $new_slug
            ), true);

            if (is_wp_error($updated_post)) {
                error_log("Failed to update package: {$package->ID} - " . $updated_post->get_error_message());
            } else {
                // Log the update (optional)
                error_log("Updated package: {$package->ID} - Old title: {$title}, New title: {$new_title}, New slug: {$new_slug}");
            }
        }
    }
}

function update_package_years() {
    $packages = get_posts(array(
        'post_type' => 'package',
        'numberposts' => -1,
        'post_status' => 'any',
    ));

    $updated_packages = array();
    $current_year = date('Y');
    $next_year = $current_year + 1;
    $old_year_patterns = array('2020 -2021', '2021 – 2022', '2022 – 2023', '2023 – 2024');
    $new_year_string = "$current_year – $next_year";

    foreach ($packages as $package) {
        $old_title = $package->post_title;
        $new_title = $old_title;

        foreach ($old_year_patterns as $pattern) {
            if (strpos($old_title, $pattern) !== false) {
                $new_title = str_replace($pattern, $new_year_string, $old_title);
                break;
            }
        }

        if ($new_title !== $old_title) {
            $new_slug = sanitize_title($new_title);
            
            wp_update_post(array(
                'ID' => $package->ID,
                'post_title' => $new_title,
                'post_name' => $new_slug
            ));

            $updated_packages[] = array(
                'ID' => $package->ID,
                'old_title' => $old_title,
                'new_title' => $new_title,
                'new_slug' => $new_slug
            );
        }
    }

    // Dump updated packages
    echo '<pre>';
    var_dump($updated_packages);
    echo '</pre>';
}

function update_packages_without_2024() {
    $packages = get_posts(array(
        'post_type' => 'package',
        'numberposts' => -1,
        'post_status' => 'any',
    ));

    $updated_packages = array();
    $failed_updates = array();

    foreach ($packages as $package) {
        if (strpos($package->post_title, '2024') === false) {
            $old_title = $package->post_title;
            $old_slug = $package->post_name;

            // Update title
            $new_title = $old_title . ' | Vacation Packages for 2024 - 2025';
            
            // Update slug
            $new_slug = $old_slug . '-vacation-packages-for-2024-2025';

            // Update the post
            $updated_post = wp_update_post(array(
                'ID' => $package->ID,
                'post_title' => $new_title,
                'post_name' => $new_slug
            ), true);

            if (!is_wp_error($updated_post)) {
                $updated_packages[] = array(
                    'ID' => $package->ID,
                    'old_title' => $old_title,
                    'new_title' => $new_title,
                    'old_slug' => $old_slug,
                    'new_slug' => $new_slug
                );
            } else {
                $failed_updates[] = array(
                    'ID' => $package->ID,
                    'old_title' => $old_title,
                    'error' => $updated_post->get_error_message()
                );
            }
        }
    }

    // Pretty print the updated packages
    echo '<h2>Updated Packages:</h2>';
    echo '<pre>';
    print_r($updated_packages);
    echo '</pre>';

    // Pretty print the failed updates
    echo '<h2>Failed Updates:</h2>';
    echo '<pre>';
    print_r($failed_updates);
    echo '</pre>';

    // Output the counts
    echo '<p>Total updated packages: ' . count($updated_packages) . '</p>';
    echo '<p>Total failed updates: ' . count($failed_updates) . '</p>';

    // Flush rewrite rules
    flush_rewrite_rules();
}

function dump_packages_without_2024() {
    $packages = get_posts(array(
        'post_type' => 'package',
        'numberposts' => -1,
        'post_status' => 'any',
    ));

    $outdated_packages = array();

    foreach ($packages as $package) {
        if (strpos($package->post_title, '2024') === false) {
            $outdated_packages[] = array(
                'ID' => $package->ID,
                'post_title' => $package->post_title,
                'post_name' => $package->post_name,
                'post_status' => $package->post_status
            );
        }
    }

    // Pretty print the outdated packages
    echo '<pre>';
    print_r($outdated_packages);
    echo '</pre>';

    // Output the count of outdated packages
    echo '<p>Total outdated packages: ' . count($outdated_packages) . '</p>';
}
// endregion