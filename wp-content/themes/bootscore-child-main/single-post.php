<?php get_header(); ?>

<?php //get_template_part('template-parts/shared/content', 'hero-full'); ?>

<div class="entry-content single-city single-post">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php the_content(); ?>
                <?php the_field('content_clean'); ?>
            </div>
        </div>
    </div>

</div>
<?php get_footer(); ?>
