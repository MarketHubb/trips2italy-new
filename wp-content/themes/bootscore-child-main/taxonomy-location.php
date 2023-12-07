<?php get_header(); ?>

<?php
//$post_type = get_post_type($post_id);
//$post_id = get_the_ID();
//$post = get_post($post_id);
//$parent_id = ($post->post_parent === 0) ? $post_id : $post->post_parent;
//$tab_ids[] = $parent_id;
$obj = get_queried_object();
?>


<?php
//$hero = get_tax_hero_inputs($obj);
//get_template_part('template-parts/banner/content', 'full-width-text-overlay', $hero);
//get_template_part('template-parts/banner/content', 'center-wave', $hero);
?>

<?php //get_template_part('template-parts/hero/content', 'hero-masonry', $parent_id); ?>

<div class="entry-content single-city">

    <h1>location region</h1>


    <?php
    $region_terms = region_tabs($obj);
    get_template_part('template-parts/menu/content', 'button-group', $region_terms);
    ?>


    <div id="custom" class="py-4">
        <div class="container">
            <div class="row">
                <div class="col">

                    <?php
                    $hero = get_tax_hero_values($obj);

                    $tax_content = get_field('content_clean', get_queried_object());

                    if ($tax_content) {
                        echo $tax_content;
                    } else {
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

                            $i++;
                        }
                        echo $output;

                    }


                    ?>

                    <?php
                    $gallery_ids = explode(',', $hero['gallery_string']);
                    get_template_part('template-parts/shared/content', 'gallery', $gallery_ids);
                    ?>

                </div>
            </div>
        </div>


    </div>

    <?php //get_template_part('template-parts/features/content', 'features-image-left'); ?>

    <?php get_template_part('template-parts/features/content', 'features-6'); ?>

</div>
<?php get_footer(); ?>
