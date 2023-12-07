<!-- -------- START Features w/ title, device and stats -------- -->
<section class="py-3 bg-gray-100 mt-5 mb-4" id="features-image-left">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-3 mx-auto">
                <div class=" position-relative">
                    <?php $region = get_post_region($post->ID); ?>
                    <img class="" src="<?php echo get_field('cta_image', 'term_' . $region[0]->term_id); ?>" alt="">
                    <button type="button" class="btn bg-gradient-warning btn-lg mt-4 mb-0" data-bs-toggle="modal" data-bs-target="#modalppc" role="button">
                        <?php echo  "Get My Custom Itinerary"; ?>
                    </button>
                </div>
            </div>
            <div class="col-lg-7 mx-auto mt-4 pt-2">
                <h2 class="text-gradient text-info mb-0 fw-bolder">Don't just see <?php echo $region[0]->name; ?>, live it.</h2>
                <h2 class="mb-0">With a custom vacation from Trips 2 Italy</h2>

                <div class="row justify-content-between pt-5 pb-4">
                    <?php if( have_rows('Callouts', 'options') ): ?>
                        <?php while ( have_rows('Callouts', 'options') ) : the_row(); ?>
                            <?php $bg_classes = get_row_index() === 1 ? 'bg-white border-radius-lg shadow-lg' : ''; ?>
                            <div class="col-lg-6 col-6 mb-lg-2 p-4 <?php echo $bg_classes; ?>">
                                <h2 class="text-gradient text-info mb-0 fs-1"><?php echo get_sub_field('heading', 'option'); ?></h2>
                                <p class="lead fw-bolder text-dark text-uppercase"><?php echo get_sub_field('subheading', 'option'); ?></p>
                                <p class="mb-0 pe-lg-4"><?php echo get_sub_field('description', 'option'); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- -------- END Features w/ title, device and stats -------- -->
