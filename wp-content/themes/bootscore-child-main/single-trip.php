<?php
get_header();
$content = content_sections(get_queried_object());
echo $content ?? '';
?>


<?php get_footer(); ?>