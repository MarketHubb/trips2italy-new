<?php if (isset($args) && is_numeric($args)) { ?>
<section class="bg-gray-100 py-9">
    <div class="container">

        <div class="row align-items-center">

            <?php
            $heading_vals = get_field('how_section_heading', $post->ID);
            echo get_content_section_heading($heading_vals, false, false, false, 'col-md-5', 'mt-4 fw-normal heading-description pe-md-3 pe-lg-4');
            ?>

            <?php if (is_singular('package')) {  ?>

                <div class="col-md-7">
                    <h3 class="text-gradient text-primary mb-0 mt-2">Vacationing to Italy</h3>
                    <h3>Has never been easier</h3>
                    <p>For nearly two decades we have been working with brides, grandparents, friends, parents or anyone with an adventurous spirit to plan the ultimate Italian vacation. Unlike internet travel sites or even our competitors, our team consists of first generation Italians who know where to go and what to do. Don't just see Italy. Live it. </p>
                    <a href="javascript:;" class="text-primary icon-move-right">More about us
                        <i class="fas fa-arrow-right text-sm ms-1"></i>
                    </a>
                </div>

            <?php } ?>

            <?php
            if (get_field('featured', $args)) {
                get_template_part('template-parts/features/content', 'features-main', $args);
            }
            ?>

        </div>
    </div>
</section>
<?php } ?>