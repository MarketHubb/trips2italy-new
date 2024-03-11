<h1>content-hero-masonry.php</h1>
<?php
$hero = $args;
$bg_image = $args['background_image'];

if (!$args['mobile_background_image'] && is_front_page()) {
    $mobile_bg_image = get_stylesheet_directory_uri() . '/img/hero/hero-home-small.jpeg';
} elseif (!$args['mobile_background_image']) {
    $mobile_bg_image = $bg_image;
} else {
    $mobile_bg_image = $args['mobile_background_image'];
}

if ($hero['hero_masonry_images']) {
    $hero['text_col'] = 'col-lg-4';
    $hero['img_col'] = 'col-lg-8';
}  else {
    $hero['text_col'] = 'col-lg-7';
    $hero['img_col'] = 'col-lg-5 d-none';
}
?>
<!-- Hero (Desktop) -->
<!--style="background-image: linear-gradient(to right,rgba(255,255,255,.25), rgba(255,255,255,.25) 35%, rgba(255,255,255,.25) 100%),url(--><?php //echo $bg_image; ?><!--">-->
<header
    class="d-none d-md-block header-hero"
    id="hero-masonry"
    style="background-image:url(<?php echo $bg_image; ?>">
    <div class="page-header min-vh-50 pt-5 pt-md-0">
        <div class="container">
            <div class="row py-8">

                <!-- Copy -->
                <?php get_template_part('template-parts/hero/content', 'copy-' . $hero['type'], $hero); ?>

                <!-- Image -->
                <?php get_template_part('template-parts/hero/content', 'images', $hero); ?>

            </div>
        </div>
    </div>
</header>

<!-- Hero (Mobile) -->
<header class="position-relative d-block d-md-none header-hero-mobile">
    <div class="page-header min-vh-75 pt-4 pt-md-0 align-items-start" style="background-image: linear-gradient(to right,rgba(255,255,255,.25), rgba(255,255,255,.25) 35%, rgba(255,255,255,.25) 100%),url(<?php echo $mobile_bg_image; ?>">
<!--        <span class="mask bg-gradient-secondary"></span>-->
        <div class="container">
            <div class="row pt-4">
                <!-- Hero - Text (Mobile) -->
                <div class="col-lg-4">
                    <div class="text-container text-background shadow-sm">
                        <h1 class="mb-4">
                            <span class="text-white d-block">
                                <?php echo $hero['hero_heading_1']; ?>
                            </span>
                            <span class="text-gradient text-warning">
                                <?php echo $hero['hero_heading_2']; ?>
                            </span>
                        </h1>
                        <p class="fw-bold lead text-white text-start lh-sm">
                            <?php echo $hero['hero_description']; ?>
                        </p>
                        <div class="buttons mx-auto text-center">
                            <button type="button" class="btn bg-gradient-warning btn-lg mt-4" data-bs-toggle="modal" data-bs-target="#modalppc">Plan My Dream Trip</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-absolute w-100 z-index-1 bottom-0">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="moving-waves">
                <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(251,251,251,0.40" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(251,251,251,0.35)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(251,251,251,0.25)" />
                <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(251,251,251,0.20)" />
                <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(251,251,251,0.15)" />
                <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(251,251,251,0.95" />
            </g>
        </svg>
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
