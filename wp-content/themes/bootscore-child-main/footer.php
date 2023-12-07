<?php //get_template_part('template-parts/menu/content', 'region-links'); ?>

<?php get_template_part('template-parts/menu/content', 'city-links'); ?>

<?php get_template_part('template-parts/shared/content', 'footer'); ?>

<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 *
 * @version 5.2.0.0
 */
?>

<footer class="d-none">

    <div class="bootscore-footer bg-light pt-5 pb-3">
        <div class="container">

            <!-- Top Footer Widget -->
            <?php if (is_active_sidebar('top-footer')) : ?>
                <div>
                    <?php dynamic_sidebar('top footer'); ?>
                </div>
            <?php endif; ?>

            <div class="row">

                <!-- Footer 1 Widget -->
                <div class="col-md-6 col-lg-3">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <div>
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Footer 2 Widget -->
                <div class="col-md-6 col-lg-3">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <div>
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Footer 3 Widget -->
                <div class="col-md-6 col-lg-3">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <div>
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Footer 4 Widget -->
                <div class="col-md-6 col-lg-3">
                    <?php if (is_active_sidebar('footer-4')) : ?>
                        <div>
                            <?php dynamic_sidebar('footer-4'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Footer Widgets End -->

            </div>

            <!-- Bootstrap 5 Nav Walker Footer Menu -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="footer-menu" class="nav %2$s">%3$s</ul>',
                'depth' => 1,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
            <!-- Bootstrap 5 Nav Walker Footer Menu End -->

        </div>
    </div>

    <div class="bootscore-info bg-light text-muted border-top py-2 text-center">
        <div class="container">
            <small>&copy;&nbsp;<?php echo Date('Y'); ?> - <?php bloginfo('name'); ?></small>
        </div>
    </div>

</footer>

<!-- To top button -->
<!--<a href="#" class="btn btn-primary shadow top-button position-fixed zi-1020"><i class="fa-solid fa-chevron-up"></i><span class="visually-hidden-focusable">To top</span></a>-->

    </div> <!-- #site -->

</div><!-- #page -->

<!-- Lead Form -->


<div class="d-none" id="form-main">

    <nav class="navbar sticky-top bg-light form-navs px-4 py-0 py-md-2" id="form-header-sticky" data-placement="top">
        <div class="container-lg  g-0 g-md-2">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div class="d-inline-block pt-1 pb-2">
                    <img class="form-heading-logo" src="<?php echo home_url() . '/wp-content/uploads/2023/01/Logo-No-Shadow.svg' ?>" alt="">
                </div>
                <div class="d-inline-block">
                    <?php
                    $dynamic = ($hero['dynamic']) ?: null;
                    $default_nav_heading = "Italy {Vacation} Itinerary";
                    $nav_heading = replace_variable_in_copy($default_nav_heading, $dynamic);
                    ?>
                    <p class="mb-0 fw-600 text-dark  small ps-1"><?php echo $nav_heading ?></p>
                </div>
                <div class="d-inline-block small">
                    <span class="form-nav-button small" data-state="hide"  id="form-hide">Back</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-lg px-4">

        <!-- Page Heading -->
        <div class="row pt-0 pt-md-3 pb-3 pb-md-4 mt-2 mb-3 mb-md-4 form-heading">
            <?php echo form_heading($dynamic); ?>
        </div>

        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col">
                <?php gravity_form(11, $display_title = false, $display_description = false, $display_inactive = false, $field_values=true, $ajax = true, 1); ?>
            </div>
        </div>

    </div>

    <nav class="navbar sticky-bottom bg-light form-navs w-100 px-4" id="form-footer-sticky" data-placement="bottom">

        <div class="container-lg">
            <div id="form-footer-buttons" class="footer-buttons w-100 py-3 d-grid">
                <div class="footer-button order-2 w-100" id="footer-button-next">
                    <a class="w-100 btn btn-lg mb-0 form-nav-button disabled px-4" data-state="hide" href="#" id="form-next" disabled>Next</a>
                </div>
                <div class="footer-button" id="footer-button-submit">
                    <button  class="w-100 btn bg-orange btn-lg mb-0 px-4 disabled d-none" id="footer-submit">Get My Free Itinerary</button>
                </div>
            </div>
        </div>

    </nav>

</div>



<?php wp_footer(); ?>

<?php //get_template_part('template-parts/modal/content', 'modal'); ?>

<?php //get_template_part('template-parts/modal/content', 'full-page'); ?>


</body>

</html>