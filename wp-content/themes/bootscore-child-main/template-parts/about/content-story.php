<section class="my-5">

    <!-- Section Heading -->
    <?php $heading = get_field('story_heading'); ?>
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

    <section>
        
        <?php 
        if( have_rows('story') ):
            while ( have_rows('story') ) : the_row();
            $first_col_class = (get_row_index() % 2 === 0) ? 'col-lg-5 col-md-8 order-2 order-md-2 order-lg-1' : 'col-md-7 col-12 my-auto';
            $second_col_class = (get_row_index() % 2 === 0) ? 'col-md-5 col-12 my-auto' : 'col-lg-5 col-md-12 ms-auto order-1 order-md-1 order-lg-1';
        ?>
            <div class="container pt-lg-7 pt-5">
                <div class="row justify-content-between">
                    <div class="<?php echo $first_col_class; ?>">
                        <h3 class="text-gradient text-primary mb-0"><?php echo get_sub_field('heading'); ?></h3>
                        <h3><?php echo get_sub_field('subheading'); ?></h3>
                        <p class="pe-md-5 mb-4">
                            <?php echo get_sub_field('description'); ?>
                        </p>
                    </div>
                    <div class="<?php echo $second_col_class; ?>">
                        <img class="w-100 border-radius-lg shadow-lg" src="<?php echo get_sub_field('image')['url']; ?>" alt="Product Image">
                    </div>
                </div>
            </div>

        <?php
            endwhile;
        endif;
        ?>

    </section>
</section>