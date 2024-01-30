<!-- -------- START Features w/ 6 cols w/ company logos & title & text -------- -->

<?php $bg_image = get_home_url() . '/wp-content/uploads/2021/12/Icons-Desktop-min.jpg'; ?>
<div
        class="bg-gradient-info position-relative py-4 border-radius-xl"
        style="background-image: url(<?php echo $bg_image; ?>); background-repeat: no-repeat; background-size: cover; background-position: bottom;">
    <span class="mask bg-gradient-dark opacity-8"></span>
    <img src="<?php echo get_stylesheet_directory_uri() . '/img/waves-white.svg'; ?>" alt="pattern-lines" class="d-none position-absolute start-0 top-md-0 w-100 opacity-6">
    <div class="container pb-5 pt-5 postion-relative z-index-2 position-relative single-trip-cta">

        <div class="row section-heading mb-5 justify-content-center">
            <div class="col-12 col-md-8 col-lg-7 text-center">

                <h2 class="mb-0">
                    We take care of every detail                </h2>

                <h2 class="text-gradient text-warning">
                    You get the perfect trip                </h2>

                <p class="">
                </p>

            </div>
        </div>

        <div class="row mt-5 features">
            <?php
            $i = 1;
            if (isset($args['featured'])) {
                foreach ($args['featured'] as $featured) { ?>

                    <div class="col-6 col-lg-<?php echo $args['cols']; ?> mt-lg-0 mt-5 text-center">
                        <div class="p-3 text-center bg-white border-radius-lg shadow-lg blur shadow-blur">
                            <div class="icon icon-shape icon-md bg-gradient-warning shadow-sm mx-auto">
                                <i class="<?php echo $featured['icon']; ?> fa-xl opacity-10 fs-3"></i>
                            </div>
                            <h5 class="d-inline-block fw-bolder text-uppercase"><?php echo $featured['heading']; ?></h5>
                            <h5 class="d-none d-md-block text-gradient text-primary mb-4"><?php echo $featured['subheading']; ?></h5>
                            <h5 class="d-block d-md-none fs-6 fw-bold text-gradient text-primary mb-4"><?php echo $featured['subheading']; ?></h5>
                            <p class="text-sm"></p>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
            }
            ?>
        </div>

    </div>
</div>


    <section
        class="background-image-container d-none"
        style="background-image: url(<?php echo get_home_url() . '/wp-content/uploads/2021/12/Icons-Desktop-min.jpg'; ?>)">
        <span class="mask bg-gradient-dark opacity-9"></span>
        <div class="bg-dark-gradient py-7">
    <div class="container">

        <?php get_template_part('template-parts/global/content', 'section-heading', $args['section_heading']); ?>

        <div class="row mt-5 features">
            <?php
            $i = 1;
            if (isset($args['featured'])) {
                foreach ($args['featured'] as $featured) { ?>

                    <div class="col-6 col-lg-<?php echo $args['cols']; ?> mt-lg-0 mt-5 text-center">
                        <div class="p-3 text-center bg-white border-radius-lg shadow-lg blur shadow-blur">
                            <div class="icon icon-shape icon-md bg-gradient-warning shadow mx-auto">
                                <i class="<?php echo $featured['icon']; ?> fa-lg"></i>
                            </div>
                            <h5 class="d-inline-block fw-bolder text-uppercase"><?php echo $featured['heading']; ?></h5>
                            <h5 class="text-gradient text-primary mb-4"><?php echo $featured['subheading']; ?></h5>
                            <p class="text-sm"></p>
                        </div>
                    </div>
            <?php
                $i++;
                }
            }
            ?>
        </div>
    </div>
    </div>
</section>

<!-- -------- END Features w/ 6 cols w/ company logos & title & text -------- -->
