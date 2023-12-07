<?php
/* Template Name: Postcards */

get_header(); ?>

<section class="my-5">

    <?php

    $postcard_posts = get_posts(array(
        'post_type' => 'postcards',
        'posts_per_page' => -1,
    ));

    $postcards  = '<div class="container">';
    $postcards .= '<div class="row">';

    foreach ($postcard_posts as $postcard_post) {
        $postcard_img = get_field('image', $postcard_post->ID)['url'];

        if ($postcard_img) {
            $postcards .= '<div class="col-md-4 my-4">';
            $postcards .= '<div class="card">';
            $postcards .= '<div class="mx-auto blur shadow-blur">';
            $postcards .= '<img class="" src="' . get_field('image', $postcard_post->ID)['url'] . '" />';
            $postcards .= '<p class="clamp-1 p-3 fw-bold text-gradient text-primary mb-0">' . get_the_title($postcard_post->ID) . '</p>';

            $postcards .= '</div></div></div>';

        }

    }

    $postcards .= '</div>';
    $postcards .= '</div>';

    echo $postcards;
    ?>


</section>

<?php get_footer(); ?>


