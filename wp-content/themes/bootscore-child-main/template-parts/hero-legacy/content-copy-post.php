<!-- Hero - Text (Desktop) -->
<?php
$hero = $args;
$text_col_count = isset($hero['hero_masonry_images']) ? 5 : 6;
$masonry_col_count = 12 - $text_col_count;
?>

<div class="my-auto blur p-4 rounded shadow-lg <?php echo $hero['text_col']; ?>">
    <?php
    $copy_args = array(
        'hero' => $hero,
        'parent_id' => $post->post_parent,
    );
    ?>
    <?php get_template_part('template-parts/hero/content', 'hero-copy', $copy_args); ?>

</div>

