<section class="my-5 py-5">

    <!-- Section Heading -->
    <?php $heading = get_field('callouts_heading'); ?>
    <?php if ($heading) { ?>
    <div class="container">
        <div class="row">
            <div class="row justify-content-center text-center my-sm-5">
                <div class="col-lg-6">
                    <h2 class="text-dark mb-0"><?php echo $heading['heading']; ?></h2>
                    <h2 class="text-primary text-gradient"><?php echo $heading['subheading']; ?></h2>
                    <p class="lead"><?php echo $heading['description']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Section Content -->
    <div class="container">
        <div class="row align-items-center">

            <!-- Grid (Left) -->

            <?php
            if( have_rows('callouts') ):
                $callouts = '<div class="col-lg-6 ms-auto">';
                while ( have_rows('callouts') ) : the_row();
                    if (get_row_index() === 1) {
                        $callouts .= '<div class="row justify-content-start">';
                    }
                    if (get_row_index() === 3) {
                        $callouts .= '</div>';
                        $callouts .= '<div class="row justify-content-start mt-5">';
                    }

                    $callouts .= '<div class="col-md-6">';
                    $callouts .= '<div class="info">';
                    $callouts .= '<div class="icon icon-sm">';
                    $callouts .= '<img src="' . get_sub_field('icon')['url'] . '" class="icon-small svg-orange" />';
                    $callouts .= '</div>';
                    $callouts .= '<h5 class="font-weight-bolder mt-3">' . get_sub_field('heading') . ' ';
                    $callouts .= get_sub_field('subheading') . '</h5>';
                    $callouts .= '<p class="pe-5">' . get_sub_field('description') . '</p>';
                    $callouts .= '</div></div>';



                    if (get_row_index() === 4) {
                        $callouts .= '</div>';
                    }

                endwhile;

                $callouts .= '</div>';
                echo $callouts;
            endif;
            ?>

            <!-- Image (Right) -->
            <?php 
             if (get_field('callout_image')) { ?>

                <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4 h-100">
                    <img src="<?php echo get_field('callout_image')['url']; ?>" class="h-100 rounded shadow" alt="">
                </div>

            <?php } ?>
        </div>
    </div>
</section>
