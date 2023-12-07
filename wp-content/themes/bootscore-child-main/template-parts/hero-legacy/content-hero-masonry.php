<?php
if (is_singular('city')) {
    $hero = get_hero_values($post->ID);
    $parent_id = $args;
}
if (is_singular('trip') || is_singular('itinerary')) {
    $hero = get_hero_inputs(get_the_ID());
}
if (is_page_template('page-templates/blog.php') || is_page_template('page-templates/trip-types.php')) {
    $hero['bg_image'] = get_home_url() . '/wp-content/uploads/2023/03/Veneto_Venice_Sigh_Bridge_View_Canale_1920x500_HDS.jpg';
}
?>
<!--<header-->
<!--    id="hero-masonry"-->
<!--    style="background-image: linear-gradient(to right,rgba(255,255,255,0) 40%, rgba(0,0,0,.5) 50%, rgba(0,0,0,.75) 60%),url(--><?php //echo $hero['bg_image']; ?><!--">-->
<header
    id="hero-masonry-single"
    style="background-image:url(<?php echo $hero['bg_image']; ?>">
    <div class="page-header test">
        <div class="container">
            <div class="row py-8">

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



                <div class="col-lg-<?php echo $masonry_col_count; ?> ps-5 pe-0 images">

                    <?php
                    if (isset($hero['hero_masonry_images'])) {
                        $output = '<div class="row">';
                        $i = 1;
                        $start_array = [1,2,4,6];
                        $end_array = [3,5,7];

                        foreach ($hero['hero_masonry_images'] as $image) {

                            if ($i > 7) { break; }

                            if (in_array($i, $start_array)) {
                                $start = '<div class="col-lg-3 col-6">';
                                $end = '';
                            }
                            if (in_array($i, $end_array)) {
                                $start = '';
                                $end = '</div>';
                            }
                            if ($i === 1) {
                                $end = '</div>';
                            }

                            $classes = get_masonry_image_attributes($i);
                            $images  = '<div class="d-inline-block">';
                            $images .= '<img class="' . $classes . '" src="' . $image['hero_masonry_image'] . '" />';
                            $images .= '</div>';

                            $output .= $start . $images . $end;

                            $i++;
                        }
                        $output .= '</div>';
                        echo $output;
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</header>

