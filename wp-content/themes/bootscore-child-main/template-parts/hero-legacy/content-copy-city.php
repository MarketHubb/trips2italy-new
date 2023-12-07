<?php
$text_col_count = isset($hero['hero_masonry_images']) ? 5 : 6;
$masonry_col_count = 12 - $text_col_count;
?>
<div class="col-lg-<?php echo $text_col_count; ?> my-auto blur p-5 rounded shadow-lg">
    <?php
    $copy_args = array(
        'hero' => $hero,
        'parent_id' => $parent_id
    );
    ?>
    <?php get_template_part('template-parts/hero/content', 'hero-copy', $copy_args); ?>

</div>
