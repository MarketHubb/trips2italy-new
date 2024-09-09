<?php echo tw_section_open(); ?>

<div class="max-w-7xl mx-auto">

    <div class="grid grid-cols-1 lg:grid-cols-12 justify-center md:gap-x-10 lg:gap-x-20 items-center">

        <div class="col-span-5">
            <?php echo tw_heading(get_the_ID(), 'how_section_heading', 'text-left'); ?>
            <div class="text-center lg:mt-8 hidden md:block">
                <?php $image_url = get_field('why_image'); ?>
                <img class="ring-1 ring-gray-200 shadow-md aspect-[2/3] md:h-[20rem] w-full object-cover object-center rounded " src="<?php echo $image_url; ?>" alt="">
            </div>
            <div class="text-center lg:mt-8 block md:hidden mt-6">
                <img class="aspect-[2/3] h-44 w-full object-cover object-center rounded ring-1 ring-gray-200 shadow-md" src="<?php echo $image_url; ?>" alt="">
            </div>
        </div>

        <div class="col-span-7">
            <?php $content_array = get_field('featured', get_the_ID()); ?>

            <?php if (!empty($content_array['sections'])) {
                echo get_vertical_list($content_array['sections']);
            } ?>

        </div>

        <div class="row align-items-center">

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