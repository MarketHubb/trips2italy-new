<section class="py-7">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center">
                <h2 class="text-gradient text-primary mb-0">Our clients have been saying</h2>
                <h2 class="mb-3">The nicest things</h2>
                <p class="lead">Don't take our word for it, read what families, couples, seniors and solo adventurers who travel with us have to say.</p>
                <p></p>
            </div>
        </div>
        <div class="row mt-6">

            <?php
            $args = array(
                'post_type' => 'testimonials',
                'posts_per_page' => 3,
            );
            $testimonials = get_posts($args);
            ?>

            <?php if (isset($testimonials)) { ?>

                <?php foreach ($testimonials as $testimonial) { ?>

                    <div class="col-lg-4 col-md-8">
                        <div class="card card-plain">
                            <div class="card-body">
                                <div class="author">
                                    <img src="<?php echo get_field('image', $testimonial->ID); ?>" alt="testimonial" class="avatar shadow pe-1">
                                    <div class="name ps-2">
                                        <p class="d-inline fw-bold"><?php echo get_the_title($testimonial->ID)?></p>
                                        <div class="stats">
                                            <small class="fw-bold"><i class="fas fa-map-pin pe-2"></i><?php echo get_field('location', $testimonial->ID); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-4">
                                    "<?php echo get_field('testimonial', $testimonial->ID); ?>"
                                </p>
                                <div class="rating mt-3">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php } ?>

        <?php } ?>

        </div>
    </div>
</section>
