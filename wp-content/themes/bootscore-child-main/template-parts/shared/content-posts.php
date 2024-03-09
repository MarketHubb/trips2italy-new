<section class="py-7 bg-gray-100">
    <div class="container">

        <?php
        $heading_vals = get_field('trip_types_heading', $post->ID);
        echo get_content_section_heading($heading_vals);
        ?>

        <?php
        $args = array(
            'post_type' => 'trip',
            'posts_per_page' => -1,
            'order' => 'ASC'
        );
        $trip_types = get_posts($args);
        ?>

        <?php if (isset($trip_types)) { ?>

            <div class="row mt-5">

                <?php foreach ($trip_types as $trip) { ?>
                        
                        <?php if (get_field('excerpt', $trip->ID)) { ?>

                            <div class="col-lg-4 mb-5">
                                <a href="<?php echo get_the_permalink($trip->ID); ?>">
                                    <div class="card card-background h-100 move-on-hover ">
                                        <div
                                            class="full-background"
                                            style="background-image: url(<?php echo get_field('featured_image_mobile',$trip->ID); ?>)">
                                        </div>
                                        <div class="card-body border-radius-md pt-12 pb-0 h-100">
                                            <div class="mt-auto">
                                                <h3 class="text-white fw-bolder"><?php echo get_the_title($trip->ID); ?></h3>
                                                <p class="fw-500 lh-base clamp-3 mb-5"><?php echo get_field('excerpt', $trip->ID); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        <?php } ?>

                <?php } ?>

        <?php } ?>


        </div>
    </div>
</section>
