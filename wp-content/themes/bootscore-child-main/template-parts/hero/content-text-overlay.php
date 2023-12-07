<?php if ($args) { ?>

    <?php
    $hero = $args;
    $bg_image = $hero['images']['background_image'];

    if ($hero['type'] === "text-left") {
        get_template_part('template-parts/hero/content', 'hero-start-left', $args);
    }

    if ($hero['type'] === "text-center") {
        get_template_part('template-parts/hero/content', 'hero-start-center', $bg_image);
    }
    ?>

    <?php get_template_part('template-parts/hero/content', 'hero-copy', $hero); ?>

    <?php get_template_part('template-parts/hero/content', 'hero-close', $hero); ?>


<?php } ?>