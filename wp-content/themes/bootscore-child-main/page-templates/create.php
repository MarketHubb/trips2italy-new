<?php
/* Template Name: Create (DEMO) */
get_header(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">

            <h1>Create.php</h1>

            <?php
            function preview_location_child_slugs() {
                $preview_data = array();

                $args = array(
                    'post_type' => 'location',
                    'posts_per_page' => -1,
                    'post_parent__not_in' => array(0)
                );

                $child_posts = get_posts($args);

                foreach ($child_posts as $post) {
                    $parent = get_post($post->post_parent);
                    $new_slug = str_replace($parent->post_name . '-', '', $post->post_name);

                    $preview_data[] = array(
                        'post_id' => $post->ID,
                        'title' => $post->post_title,
                        'current_slug' => $post->post_name,
                        'proposed_slug' => $new_slug,
                        'parent_slug' => $parent->post_name,
                        'current_url' => get_permalink($post->ID),
                        'proposed_url' => home_url("/location/{$parent->post_name}/{$new_slug}/")
                    );
                }

                return $preview_data;
            }

            function update_location_child_slugs() {
                $update_results = array();

                $args = array(
                    'post_type' => 'location',
                    'posts_per_page' => -1,
                    'post_parent__not_in' => array(0)
                );

                $child_posts = get_posts($args);

                foreach ($child_posts as $post) {
                    $parent = get_post($post->post_parent);
                    $new_slug = str_replace($parent->post_name . '-', '', $post->post_name);

                    // Only update if the slug has changed
                    if ($new_slug !== $post->post_name) {
                        $updated_post = wp_update_post(
                            array(
                                'ID' => $post->ID,
                                'post_name' => $new_slug
                            ),
                            true
                        );

                        if (is_wp_error($updated_post)) {
                            $result = 'Error: ' . $updated_post->get_error_message();
                        } else {
                            $result = 'Updated successfully';
                        }
                    } else {
                        $result = 'No update needed';
                    }

                    $update_results[] = array(
                        'post_id' => $post->ID,
                        'title' => $post->post_title,
                        'old_slug' => $post->post_name,
                        'new_slug' => $new_slug,
                        'parent_slug' => $parent->post_name,
                        'result' => $result
                    );
                }

                return $update_results;
            }

            $update_results = update_location_child_slugs(); ?>

            <table>
                <thead>
                    <tr>
                        <th>Post ID</th>
                        <th>Title</th>
                        <th>Old Slug</th>
                        <th>New Slug</th>
                        <th>Parent Slug</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($update_results as $result) { ?>

                        <tr>
                            <td><?php echo esc_html($result['post_id']); ?></td>
                            <td><?php echo esc_html($result['title']); ?></td>
                            <td><?php echo esc_html($result['old_slug']); ?></td>
                            <td><?php echo esc_html($result['new_slug']); ?></td>
                            <td><?php echo esc_html($result['parent_silug']); ?></td>
                            <td><?php echo esc_url($result['result']); ?></td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>

        </div>
    </div>
</div>


<?php get_footer(); ?>