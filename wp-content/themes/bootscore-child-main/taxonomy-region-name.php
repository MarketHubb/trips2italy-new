<?php get_header(); ?>

<?php
$post_type = get_post_type($post_id);
$post_id = get_the_ID();
$post = get_post($post_id);
$parent_id = ($post->post_parent === 0) ? $post_id : $post->post_parent;
$tab_ids[] = $parent_id;
?>

<?php
$hero = get_hero_banner(get_the_ID());
if (isset($hero)) {
    get_template_part('template-parts/shared/content', 'hero-masonry', $hero);
}
?>

<?php //get_template_part('template-parts/hero/content', 'hero-masonry', $parent_id); ?>

<div class="entry-content single-city">


    <?php

    $children_args = array(
        'post_type' => $post_type,
        'post_parent' => $parent_id,
        'posts_per_page' => -1
    );

    $children = get_posts($children_args);
    foreach ($children as $child) {
        $tab_ids[] = $child->ID;
//                    $title = format_city_title($child->ID);
//                    $topic = city_child_topic($child->ID);
//
    }

    get_template_part('template-parts/menu/content', 'button-group', $tab_ids);

    ?>


    <div id="custom" class="py-4">
        <?php

        $hero = get_hero_values($post->ID);

        $legacy_content = get_the_content();
        $content_array = remove_embeds_from_content($legacy_content,true);
        $i = 0;
        $output = '';
        foreach ($content_array as $block) {
            $p_classes = $i === 0 ? '' : '';
            $output .= '<div class="container">';
            $output .= '<div class="row">';
            $output .= '<div class="col-12">';
            $output .= '<p class="' . $p_classes . '">' . $block . '</p>';
            $output .= '</div></div></div>';

//            if (isset($hero['hero_masonry_images'][$i]['hero_masonry_image'])) {
//                $output .= '<div class="col-8">';
//                $output .= '<p>' . $block . '</p>';
//                $output .= '</div><div class="col-4">';
//                $output .= '<img src="' . $hero['hero_masonry_images'][$i]['hero_masonry_image'] . '" />';
//                $output .= '</div></div></div>';
//            } else {
//                $output .= '<div class="col-12">';
//                $output .= '<p>' . $block . '</p>';
//                $output .= '</div></div></div>';
//            }

            $i++;
        }
        echo $output;

        ?>

        <?php
        $gallery_ids = explode(',', $hero['gallery_string']);
        get_template_part('template-parts/shared/content', 'gallery', $gallery_ids);
        ?>

    </div>

    <?php //get_template_part('template-parts/features/content', 'features-image-left'); ?>

    <?php get_template_part('template-parts/features/content', 'features-6'); ?>

</div>
<?php get_footer(); ?>

