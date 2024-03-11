<?php
get_header();
set_query_var('postObj', get_queried_object());
?>

<?php get_template_part('template-parts/location/content', 'main'); ?>

<?php get_footer(); ?>