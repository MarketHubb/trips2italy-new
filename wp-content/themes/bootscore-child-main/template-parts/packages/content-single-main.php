<div class="container packages-content">
    <div class="row">
        <div class="card mt-4 border-light">

                    <div class="card-body p-lg-5">

                        <div class="row align-items-start">
                            <div class="col-lg-8">

                        <?php if (get_field('description')) { ?>
                            <h3 class="text-gradient text-info">Package Description:</h3>
                            <span class=""><?php echo get_field('description'); ?></span>
                        <?php } ?>

                            </div>

                                <div class="col-lg-4">
                                    <div class="card-body text-center">
                                        <h6 class="mt-sm-4 mt-0 mb-0">Starting at just</h6>
                                        <h1 class="mt-0">
                                            <small><?php echo get_field('price', $post->ID) ?></small>
                                        </h1>
                                        <button type="button" class="btn bg-orange btn-lg mt-2" data-bs-toggle="modal" data-bs-target="#modalppc">Talk to Us</button>
                                        <p class="text-sm">Like to change something?<br><strong>Our packages
                                                are 100% customizable</strong></p>
                                    </div>
                                </div>

                        <?php if( have_rows('includes') ): ?>
                            <div class="row mt-5 mb-2">
                                <div class="col-lg-3 col-12">
                                    <h6 class="text-dark tet-uppercase">What's included</h6>
                                </div>
                                <div class="col-6">
                                    <hr class="horizontal dark">
                                </div>
                            </div>

                            <?php
                                $i = '<ul class="lst-none ps-0">';
                                while ( have_rows('includes') ) : the_row();
                                    $i .= '<li class="py-2 d-flex"><div class="d-inline-block me-4 icon icon-shape icon-xs rounded-circle   bg-gradient-warning opacity-6 shadow text-center">';
                                    $i .= '<i class="fas fa-check opacity-10"></i>';
                                    $i .= '</div>';
                                    $i .= '<span class="">' . clean_text(get_sub_field('item')) .'</span></li>';
                                endwhile;
                                $i .= '</ul>';
                                echo $i;
                        endif; ?>

                        <?php if( have_rows('itinerary') ): ?>
                            <div class="row mt-5 mb-2">
                                <div class="col-lg-3 col-12">
                                    <h6 class="text-dark tet-uppercase">Itinerary</h6>
                                </div>
                                <div class="col-6">
                                    <hr class="horizontal dark">
                                </div>
                            </div>

                            <?php
                                $i = '<div class="row">';
                                while ( have_rows('itinerary') ) : the_row();
                                    $i .= '<div class="col-md-11  p-4">';
                                    $i .= '<h6 class="">' . get_sub_field('day') .'</h6>';
                                    $i .= '<span class="">' . get_sub_field('description') .'</span>';
                                    $i .= '</div>';

                                endwhile;
                                $i .= '</div>';
                                echo $i;
                        endif; ?>
                     </div>
                </div>


    </div>
</div>
</div>
