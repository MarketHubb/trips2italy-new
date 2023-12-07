<?php $bg_image = get_field('features_background_image'); ?>

<div class="bg-blue-light content-section bg-dark background-image-container"
     style="background-image: linear-gradient(to right,rgba(255,255,255,.1), rgba(255,255,255,.1) 35%, rgba(255,255,255,.1) 100%),url(<?php echo $bg_image; ?>">
    <!--<div class="bg-blue-light content-section bg-dark background-image-container">-->
    <div class="container px-md-4 py-0 py-lg-4" id="custom-cards">

        <!-- Section Heading -->
        <div class="row justify-content-center">
            <div class="col-md-9 text-center px-2 px-md-3 px-lg-4 pb-4 text-white">
                <?php echo get_section_heading(get_field('features_heading'), get_field('features_subheading')); ?>
                <p class="lead text-white fs-4 fw-500 mb-0"><?php echo get_field('features_description') ?></p>
            </div>
        </div>

        <!--        <div class="container">-->
        <?php
        if( have_rows('features') ):
            $f = '<div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-md-4">';
            while ( have_rows('features') ) : the_row();
                $f .= '<div class="col">';
                $f .= '<div class="card card-cover no-border feature-cards h-100 overflow-hidden text-white bg-blue-light rounded-5 shadow" ';
                $f .= 'style="background-image: url(' . get_sub_field('image') . ')">';
                $f .= '<div class="d-flex flex-column h-100 py-5 px-4 pb-5 p-md-5 text-white  border border-white border-3 text-shadow-1 panel-copy-container">';
                $f .= '<h2 class="pt-0 mt-0 mb-3 display-6 lh-sm fw-bold">' . get_sub_field('heading') . '</h2>';
                $f .= '<p class="text-white mb-5 pb-5">' . get_sub_field('description') . '</p>';
                $f .= '</div></div></div>';
            endwhile;
            $f .= '</div>';
            echo $f;
        endif;
        ?>
        <!--        </div>-->

    </div>
</div>

