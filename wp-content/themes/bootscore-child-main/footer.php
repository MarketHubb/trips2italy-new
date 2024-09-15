<?php get_template_part("template-parts/menu/content", "city-links"); ?>

<?php get_template_part("template-parts/shared/content", "footer"); ?>

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
        <div class="max-w-7xl mx-auto relative">

            <!-- Top Footer Widget -->
            <?php if (is_active_sidebar("top-footer")): ?>
                <div>
                    <?php dynamic_sidebar("top footer"); ?>
                </div>
            <?php endif; ?>

            <div class="row">

                <!-- Footer 1 Widget -->
                <div class="col-md-6 col-lg-3">
                    <?php if (is_active_sidebar("footer-1")): ?>
                        <div>
                            <?php dynamic_sidebar("footer-1"); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Footer 2 Widget -->
                <div class="col-md-6 col-lg-3">
                    <?php if (is_active_sidebar("footer-2")): ?>
                        <div>
                            <?php dynamic_sidebar("footer-2"); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Footer 3 Widget -->
                <div class="col-md-6 col-lg-3">
                    <?php if (is_active_sidebar("footer-3")): ?>
                        <div>
                            <?php dynamic_sidebar("footer-3"); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Footer 4 Widget -->
                <div class="col-md-6 col-lg-3">
                    <?php if (is_active_sidebar("footer-4")): ?>
                        <div>
                            <?php dynamic_sidebar("footer-4"); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Footer Widgets End -->

            </div>

            <!-- Bootstrap 5 Nav Walker Footer Menu -->
            <?php wp_nav_menu([
                "theme_location" => "footer-menu",
                "container" => false,
                "menu_class" => "",
                "fallback_cb" => "__return_false",
                "items_wrap" =>
                    '<ul id="footer-menu" class="nav %2$s">%3$s</ul>',
                "depth" => 1,
                "walker" => new bootstrap_5_wp_nav_menu_walker(),
            ]); ?>
            <!-- Bootstrap 5 Nav Walker Footer Menu End -->

        </div>
    </div>

    <div class="bootscore-info bg-light text-muted border-top py-2 text-center">
        <div class="container">
            <small>&copy;&nbsp;<?php echo Date("Y"); ?> - <?php bloginfo(
     "name"
 ); ?></small>
        </div>
    </div>

</footer>

<!-- To top button -->
<!--<a href="#" class="btn btn-primary shadow top-button position-fixed zi-1020"><i class="fa-solid fa-chevron-up"></i><span class="visually-hidden-focusable">To top</span></a>-->

</div> <!-- #site -->

</div><!-- #page -->

<!-- Lead Form -->


<div class="d-none bg-gray-light" id="form-main">

    <nav class="navbar  sticky-top bg-white form-navs px-0 py-0 py-md-2" id="form-header-sticky" data-placement="top">
        <div class="container-lg  g-0 g-md-2">
            <div class="d-grid w-100">
                <div class="d-inline-block pt-1 pb-2">
                    <img class="form-heading-logo" src="<?php echo home_url() .
                        "/wp-content/uploads/2023/01/Logo-No-Shadow.svg"; ?>" alt="">
                </div>
                <div class="d-inline-block">
                    <?php
                    $dynamic = isset($hero["dynamic"])
                        ? $hero["dynamic"]
                        : null;
                    $default_nav_heading = "Italy {Vacation} Itinerary";
                    $nav_heading = replace_variable_in_copy(
                        $default_nav_heading,
                        $dynamic
                    );
                    ?>
                    <p class="mb-0 fw-600 text-dark ps-1"><?php echo $nav_heading; ?></p>
                </div>
                <div class="d-inline-block small pe-3">
                    <button class="form-nav-button border-0 btn-outline-info text-muted fs-5 p-0 lh-1 small" data-state="hide" id="form-hide"><i class="fa-solid fa-square-xmark fa-xl"></i></button>
                    <!-- <span class="form-nav-button small" data-state="hide"  id="form-hide"><i class="fa-solid fa-square-xmark fa-xl"></i></span> -->
                </div>
            </div>
        </div>
    </nav>

    <div class="container-lg px-4">

        <!-- Page Heading -->
        <div class="row pt-0 pb-3 py-md-4 my-md-4 form-heading">
            <?php echo form_heading($dynamic); ?>
        </div>

        <!-- Form -->
        <div class="row justify-content-center" id="form-row">
            <div class="col">
                <?php gravity_form(
                    11,
                    $display_title = false,
                    $display_description = false,
                    $display_inactive = false,
                    $field_values = true,
                    $ajax = true,
                    1
                ); ?>
            </div>
        </div>

    </div>

    <nav class="navbar shadow-none border border-top border-light sticky-bottom bg-white form-navs w-100 px-4" id="form-footer-sticky" data-placement="bottom">

        <div class="container-lg">
            <div id="form-footer-buttons" class="footer-buttons w-100 py-3 d-grid">
                <div class="footer-button order-2 w-100" id="footer-button-next">
                    <a class="w-100 btn btn-lg mb-0 form-nav-button disabled px-4" data-state="hide" href="#" id="form-next" disabled>Next</a>
                </div>
                <div class="footer-button" id="footer-button-submit">
                    <button class="w-100 btn bg-orange btn-lg mb-0 px-4 disabled d-none" id="footer-submit">Get My Free Itinerary</button>
                </div>
            </div>
        </div>

    </nav>

</div>



<?php wp_footer(); ?>

<?php
//get_template_part('template-parts/modal/content', 'modal');
?>

<?php
//get_template_part('template-parts/modal/content', 'full-page');
?>

<script type="text/javascript">
    var $zoho = $zoho || {};
    $zoho.salesiq = $zoho.salesiq || {
        widgetcode: "siq5498c278a23b861117069820a58ff910ca848f22776a3d917e798bedb9a2e627",
        values: {},
        ready: function() {
            $zoho.salesiq.floatbutton.visible('hide');
        }
    };
    var d = document;
    s = d.createElement("script");
    s.type = "text/javascript";
    s.id = "zsiqscript";
    s.defer = true;
    s.src = "https://salesiq.zoho.com/widget";
    t = d.getElementsByTagName("script")[0];
    t.parentNode.insertBefore(s, t);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed');

        const animateOnScrollElements = document.querySelectorAll('.animate-on-scroll');
        console.log('Elements to be animated:', animateOnScrollElements);

        if (animateOnScrollElements.length === 0) {
            console.log('No elements found with the class "animate-on-scroll".');
        }

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    console.log('Element is intersecting:', entry.target);
                    entry.target.classList.add('animate-fade-in-up', 'opacity-100');
                    entry.target.classList.remove('opacity-0');
                    observer.unobserve(entry.target);
                } else {
                    console.log('Element is not intersecting:', entry.target);
                }
            });
        }, {
            rootMargin: '0px 0px 0px 0px', // Adjust as needed
            threshold: 0.1
        });

        animateOnScrollElements.forEach(element => {
            observer.observe(element);
            console.log('Observing element:', element);
        });
    });
</script>

</body>

</html>
