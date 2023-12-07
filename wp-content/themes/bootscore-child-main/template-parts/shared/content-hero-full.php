<!-- -------- START HEADER 2 w/ waves and typed text ------- -->
<header class="position-relative hero-full">

    <div class="page-header min-vh-33" style="background-image: url(http://<?php echo get_field('image_slider_url'); ?>);">
<!--        <span class="mask bg-gradient-dark"></span>-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <h1 class="d-inline-block w-auto blur px-3 py-2 rounded">
                        <?php echo get_the_title(); ?>
                    </h1>
                    <br>
                    <div class="buttons d-block">
                        <button type="button" class="btn bg-orange btn-lg mt-4 shadow-lg fs-6">
                            Plan My <?php echo format_city_title($post->ID); ?> Vacation
                        </button>
                    </div>

<!--                    <div class="card bg-transparent card-body d-flex justify-content-center shadow-lg  mt-auto">-->
<!--                        <h1 class="blur d-inline border-radius-md p-4">--><?php //echo get_the_title(); ?><!--</h1>-->
<!--                        <h1 class="mb-4"></h1>-->
<!--                        <p class="lead pe-5 me-5"></p>-->
<!--                        <div class="buttons">-->
<!--                            <button type="button" class="btn bg-gradient-primary mt-4"></button>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
<!--                <div class="col-lg-8 text-start">-->
<!--                    <h1 class="text-white">Our company mission is to lead the <span class="text-white" id="typed"></span></h1>-->
<!--                    <div id="typed-strings">-->
<!--                        <h1>web development</h1>-->
<!--                        <h1>mobile development</h1>-->
<!--                        <h1>web design</h1>-->
<!--                    </div>-->
<!--                    <p class="lead text-white text-start pe-5 mt-4">The time is now for it to be okay to be great. People in this world shun people for being great. For being a bright color. </p>-->
<!--                    <br />-->
<!--                    <div class="buttons">-->
<!--                        <button type="button" class="btn btn-lg btn-white">Contact Us</button>-->
<!--                        <button type="button" class="btn btn-lg btn-link text-white">Read More</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
    <div class="position-absolute w-100 z-index-1 bottom-0">
<!--        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"-->
<!--             viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">-->
<!--            <defs>-->
<!--                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />-->
<!--            </defs>-->
<!--            <g class="moving-waves">-->
<!--                <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(251,251,251,0.40" />-->
<!--                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(251,251,251,0.35)" />-->
<!--                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(251,251,251,0.25)" />-->
<!--                <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(251,251,251,0.20)" />-->
<!--                <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(251,251,251,0.15)" />-->
<!--                <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(251,251,251,0.95" />-->
<!--            </g>-->
<!--        </svg>-->
    </div>
</header>
<!-- -------- END HEADER 2 w/ waves and typed text ------- -->


<!-- Mandatory init script -->
<script>
    if (document.getElementById("typed")) {
        var typed = new Typed("#typed", {
            stringsElement: "#typed-strings",
            typeSpeed: 70,
            backSpeed: 50,
            backDelay: 200,
            startDelay: 500,
            loop: true
        });
    }
</script>