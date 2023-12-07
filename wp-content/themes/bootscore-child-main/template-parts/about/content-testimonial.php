<section class="py-7">
    <div class="container">


        <!-- Section Heading -->
        <?php $heading = get_field('testimonial_heading'); ?>
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

        <div class="row mt-6">

            <?php if( have_rows('testimonials') ):
                $testimonial = '';
                while ( have_rows('testimonials') ) : the_row();
                    $card_class = (get_row_index() === 2) ? 'bg-gradient-info' : 'card-plain';
                    $text_color = (get_row_index() === 2) ? 'text-white' : '';

                    $testimonial .= '<div class="col-lg-4 col-md-8">
                                        <div class="card ' . $card_class . '">
                                            <div class="card-body">
                                                <div class="author d-block">
                                                    <div class="name">';
                    $testimonial .= '<h6 class="mb-0 font-weight-bolder ' . $text_color . '">' . get_sub_field('author') . '</h6>';
                    $testimonial .= '<div class="d-flex flex-row  stats ' . $text_color . '">' . '<span class="border-end border-light d-inline-block pe-2 me-2 ' . $text_color . '">' . get_sub_field('location'). '</span>';
                    $testimonial .= '<span class="d-inline-flex fw-bold ' . $text_color . '">' . get_sub_field('trip_type') . '</span></div>';
                    $testimonial .= '</div></div>';
                    $testimonial .= '<p class="mt-4 ' . $text_color . '">' . get_sub_field('testimonial') . '</p>';
                    $testimonial .= '<div class="rating mt-3">
                                        <i class="fas fa-star text-orange ' . $text_color . '" aria-hidden="true"></i>
                                        <i class="fas fa-star text-orange ' . $text_color . '" aria-hidden="true"></i>
                                        <i class="fas fa-star text-orange ' . $text_color . '" aria-hidden="true"></i>
                                        <i class="fas fa-star text-orange ' . $text_color . '" aria-hidden="true"></i>
                                        <i class="fas fa-star text-orange ' . $text_color . '" aria-hidden="true"></i>
                                    </div>';
                    $testimonial .= '</div></div></div>';


                endwhile;
                echo $testimonial;
            endif;
            ?>

        </div>

        <hr class="horizontal dark my-5">

        <?php
        if( have_rows('logos') ):
            $logos = '<div class="row">';
            while ( have_rows('logos') ) : the_row();
                $logos .= '<div class="col-lg-2 col-md-4 col-6 ms-auto">';
                $logos .= '<img class="w-100 opacity-8" src="' . get_sub_field('logo')['url'] . '" alt="Logo">';
                $logos .= '</div>';
            endwhile;
            $logos .= '</div>';
            echo $logos;
        endif;
        ?>

    </div>
</section>
