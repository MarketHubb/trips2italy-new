<?php
/* Template Name: Postcards */

get_header(); ?>

<?php
$order_by = (get_field('order_by', 'option') === 'date_published') ? 'date' : 'title';
$order = get_field('order', 'option') ? strtoupper(get_field('order', 'option')) : 'DESC';
?>


<section class="my-5">

    <?php

    $output_array = output_order_testimonials();

    $postcard_posts = get_posts(array(
        'post_type' => 'postcards',
        'posts_per_page' => -1,
        'order' => $output_array['order'],
        'orderby' => $output_array['order_by']
    ));

    $postcards  = '<div class="container">';
    // $postcards .= '<div class="row">';
    $postcards .= '<div class="d-grid sm-grid-cols-1 md-grid-cols-2 grid-cols-3 grid-gap-2">';

    foreach ($postcard_posts as $postcard_post) {
        $postcard_img = get_field('image', $postcard_post->ID)['url'];

        if ($postcard_img) {
            $postcard_gallery['src'] = get_field('image', $postcard_post->ID)['url'];
            $postcard_gallery['caption'] = get_the_title($postcard_post->ID);
            $postcards .= galleryLightbox($postcard_gallery);
        }

    }

    $postcards .= '</div>';
    $postcards .= '</div>';

    echo $postcards;
    ?>


</section>

<?php get_footer(); ?>


