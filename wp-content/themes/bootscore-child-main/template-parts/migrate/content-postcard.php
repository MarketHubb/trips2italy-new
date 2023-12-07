<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>content-postcard</h1>

            <?php
             function check_if_file_exists($filename, $path = null) {
                $filename = ($path) ? $path . $filename : $filename;

                return file_exists($filename);
            }

            function check_if_media_file_exists($image_url) {
                $removal_words = [
                    "https://www.trips2italy.com/images/reviews/",
                    "http://www.trips2italy.com/images/reviews/",
                    "https://trips2italy.com/images/reviews/",
                    "http://trips2italy.com/images/reviews/",
                ];
                $image_filename = remove_words_from_string($image_url,$removal_words);
                $path = "wp-content/uploads/2023/08/";

                return check_if_file_exists($image_filename, $path);
            }
            /**
             * Upload image from URL programmatically
             *
             * @author Misha Rudrastyh
             * @link https://rudrastyh.com/wordpress/how-to-add-images-to-media-library-from-uploaded-files-programmatically.html#upload-image-from-url
             */
            function upload_file_by_url( $image_url ) {

                // Check if media item already exists
                if (check_if_media_file_exists($image_url) === true) {
                    echo "File already exists";
                    return;
                }

                // it allows us to use download_url() and wp_handle_sideload() functions
                require_once( ABSPATH . 'wp-admin/includes/file.php' );

                // download to temp dir
                $temp_file = download_url( $image_url );

                if( is_wp_error( $temp_file ) ) {
                    return $temp_file;
                }

                // move the temp file into the uploads directory
                $file = array(
                    'name'     => basename( $image_url ),
                    'type'     => mime_content_type( $temp_file ),
                    'tmp_name' => $temp_file,
                    'size'     => filesize( $temp_file ),
                );
                $sideload = wp_handle_sideload(
                    $file,
                    array(
                        'test_form'   => false // no needs to check 'action' parameter
                    )
                );

                if( ! empty( $sideload[ 'error' ] ) ) {
                    // you may return error message if you want
                    return $sideload[ 'error' ];
                }

                // it is time to add our uploaded image into WordPress media library
                $attachment_id = wp_insert_attachment(
                    array(
                        'guid'           => $sideload[ 'url' ],
                        'post_mime_type' => $sideload[ 'type' ],
                        'post_title'     => basename( $sideload[ 'file' ] ),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    ),
                    $sideload[ 'file' ]
                );

                if( is_wp_error( $attachment_id ) || ! $attachment_id ) {
                    return $attachment_id;
                }
                

                // update medatata, regenerate image sizes
                require_once( ABSPATH . 'wp-admin/includes/image.php' );

                wp_update_attachment_metadata(
                    $attachment_id,
                    wp_generate_attachment_metadata( $attachment_id, $sideload[ 'file' ] )
                );

                return $attachment_id;

            }
            ?>

            <?php
            $postcards_array = array(

            );

            // Add Media File + Create Postcard Post
            foreach ($postcards_array as $image_url => $title) {
                $attachment_id = upload_file_by_url($image_url);

                if ($attachment_id) {
                    $post_title = standardize_postcard_titles($title);

                    if ($post_title) {
                        $post_core['post_title'] = $post_title;
                        $post_core['post_status'] = 'publish';
                        $post_core['post_type'] = 'postcards';
                    }

                    $post_id = wp_insert_post($post_core);

//                    $post_exists = count(check_if_post_exists($post_core['post_type'], $post_core['post_title']));
//
//                    if ($post_exists === 0) {
//                        $post_id = wp_insert_post($post_core);
//                    }

                     // Postcard post was created. Now we can update custom fields
                    if (isset($post_id) && !is_wp_error($post_id)) {
                        if ($attachment_id) {
                            update_field('field_64d00b39ab052', $attachment_id, $post_id);
                        }
                    }
                }

            }

            ?>

        </div>
    </div>
</div>


<?php get_footer(); ?>
