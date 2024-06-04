<?php
$bg_image = get_field('featured_image', $post->ID);
?>
<header class="">
    <div class="page-header min-vh-75">
        <div class="oblique position-absolute top-0 h-100 d-md-block">
            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url(<?php echo $bg_image['url']; ?>)"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <?php
                    $terms = [];
                    $terms[] = get_the_terms($post->ID, 'topic');
                    $terms[] = get_the_terms($post->ID, 'region');

                    $t = '';
                    foreach ($terms[0] as $term) {
                        $t .= '<span class="badge rounded-pill badge-info hero-badge me-3">' . $term->name .  '</span>';
                    }

                    echo $t;

                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-7 pe-md-5 d-flex justify-content-center text-md-start text-center flex-column mt-sm-0 mt-7">

                    <h1 class="fs-2 mb-4"><?php the_title(); ?></h1>

                    <?php 
                    $price_callout = 'Starting at ' . get_field('price', $post->ID);
                    $package_description = get_field('description', get_the_id());
                    $package_description_split = splitParagraph($package_description);
                    $hero_description = isset($package_description_split) && !empty($package_description_split['0']) && !empty($package_description_split['1']) ? $package_description_split[0] : $price_callout;
                     ?>

                    <p class="lead pe-md-5 me-md-5">
                        <?php echo $hero_description; ?>
                    </p>

                    <div class="buttons">
                        <button type="button" class="btn btn bg-orange  mt-4" data-target="form" data-type="Form">Get a Customized Travel Itinerary</button>
                        <?php if ($hero_description != $price_callout) {
                            set_query_var( 'package_description_copy', $package_description_split[1] );
                            echo '<p class="text-sm ps-4 color-heading fw-semibold">' . $price_callout . '</p>';
                        } else {
                            set_query_var( $package_description_copy, $package_description);
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
