<?php
$bg_image = get_field('featured_image', $post->ID);
?>
<header>
    <div class="page-header min-vh-75">
        <div class="oblique position-absolute top-0 h-100 d-md-block d-none">
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

                    <h1 class="fs-2"><?php the_title(); ?></h1>
                    <p class="lead pe-md-5 me-md-5">Fully customizable and starting at <?php echo get_field('price', $post->ID); ?></p>
                    <div class="buttons">
                        <button type="button" class="btn btn bg-orange  mt-4" data-bs-toggle="modal" data-bs-target="#modalppc">Get a Customized Travel Itinerary</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
