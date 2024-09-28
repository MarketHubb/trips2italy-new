<?php
/* Template Name: Blog */
get_header(); ?>

<div class="container post-list">

    <?php
    $args = [
        'query_args' => [
            'author' => null,
            'author_img_src' => null
        ],
        'post_type' => 'post'
    ];
    // get_template_part('template-parts/tw-shared/content', 'post-list', ['post_type' => 'post']); 
    get_template_part('template-parts/tw-shared/content', 'post-list', $args); 
    ?>

</div>

<?php get_footer(); ?>