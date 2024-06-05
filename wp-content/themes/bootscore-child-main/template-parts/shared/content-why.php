<!-- <section class="my-5 py-5 bg-po" style="background-image:url(http://t2i-new.test/wp-content/uploads/2023/01/AdobeStock_141760356-copy-scaled.jpg); background-size: cover; background-position: center;"> -->

<section class="my-5 py-5">

    <!-- Section Heading -->
    <div class="container">
        <div class="row">
            <div class="row justify-content-center text-center my-sm-5">
                <div class="col-lg-5">
                    <h2 class="text-dark mb-0">
                        Why lovers of Italian travel
                    </h2>
                    <h2 class="text-primary text-gradient stylized">
                        love Trips 2 Italy
                    </h2>
                    <p class="lead">
                       We don't just plan vacations; we craft once-in-a-lifetime experiences. 
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Content -->
    <div class="container">
        <div class="row align-items-center">

            <!-- Grid (Left) -->

            <?php
            if( have_rows('callouts', 28208) ):
                $callouts = '<div class="col-lg-6 ms-auto">';
                while ( have_rows('callouts', 28208) ) : the_row();
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
                    $callouts .= '<img src="' . get_sub_field('icon', 28208)['url'] . '" class="icon-small svg-orange" />';
                    $callouts .= '</div>';
                    $callouts .= '<h5 class="font-weight-bolder mt-3">' . get_sub_field('heading', 28208) . ' ';
                    $callouts .= get_sub_field('subheading', 28208) . '</h5>';
                    $callouts .= '<p class="pe-5">' . get_sub_field('description', 28208) . '</p>';
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
             if (get_field('callout_image', 28208)) { ?>

                <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4 h-100">
                    <img src="<?php echo get_field('callout_image', 28208)['url']; ?>" class="h-100 rounded shadow" alt="">
                </div>

            <?php } ?>
        </div>
    </div>
</section>
