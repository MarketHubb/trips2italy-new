<?php if ($args) { ?>

    <?php
    $hero = $args;

    if (!empty($hero['images']['masonry'])) {
        $text_columns = 'col-lg-5';
        $image_columns = 'col-lg-7';
    } else {
        $text_columns = 'col-lg-7';
        $image_columns = 'col-lg-5 d-none';
    }
    ?>

    <!-- Hero (Desktop) -->
    <header class="d-none d-md-block header-hero hero-masonry" id="hero-masonry" style="background-image:url(<?php echo $hero['images']['background_image']; ?>">
        <div class="page-header min-vh-50 pt-5 pt-md-0">

            <div class="container py-8">

                <!-- Heading (Copy) -->
                <div class="row justify-content-start">
                    <div class="col-md-8">
                        <h1>
                            <?php echo $hero['copy']['heading_1']['desktop']; ?>
                            <span class="stylized d-block mt-1">
                                <?php echo $hero['copy']['heading_2']['desktop']; ?>
                            </span>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <!-- Description + Callouts + Button  -->
                    <div class="my-auto d-none d-md-block <?php echo $text_columns; ?>">
                        <div class="position-relative mt-n8">
                            <p class="lead fw-500 text-body-dark">
                                <?php echo $hero['copy']['description']['desktop']; ?>
                            </p>

                            <div class="my-4 py-4 px-2 px-md-0 hero-callouts">
                                <ul class="list-group border-0">
                                    <?php foreach ($hero['callouts'] as $callout) { ?>
                                        <li class="list-group-item bg-transparent text-start ps-0 border-0 py-1 ps-1 pe-0">
                                            <p class="mb-0 pb-0 fw-600 text-wider color-heading stylized">
                                                <i class="fa-solid fa-check pe-2 pe-md-3"></i><?php echo $callout['desktop']; ?>
                                            </p>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="hero-links mt-5 py-2">
                                <div class="d-inline-flex  justify-start">
                                    <button data-target="Primary" class="btn bg-orange btn-lg mb-0" data-type="Modal">
                                        <?php echo $hero['links'][0]['copy']; ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Masonry Images-->
                    <?php
                    $masonry_images = $hero['images']['masonry'];
                    if (!empty($masonry_images)) { ?>
                        <div class="ps-5 pe-0 images <?php echo $image_columns; ?>">
                            <?php echo output_masonry_images($masonry_images); ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </header>

    <!-- Hero (Mobile) -->
    <?php $mobile_bg = ($hero['images']['mobile_image']) ?: $hero['images']['background_image']; ?>
    <header class="position-relative d-none d-block d-md-none header-hero-mobile">
        <div class="page-header min-vh-75 pt-4 pt-md-0 align-items-start" style="background-image: linear-gradient(to right,rgba(255,255,255,.25), rgba(255,255,255,.25) 35%, rgba(255,255,255,.25) 100%),url(<?php echo $mobile_bg; ?>">
            <!--        <span class="mask bg-gradient-secondary"></span>-->
            <div class="container">
                <div class="row pt-4">
                    <!-- Hero - Text (Mobile) -->
                    <div class="col-lg-4">
                        <div class="text-container text-background shadow-sm">
                            <h1 class="mb-4">
                                <span class="text-white d-block">
                                    <?php echo $hero['copy']['heading_1']; ?>
                                </span>
                                <span class="text-gradient text-warning">
                                    <?php echo $hero['copy']['heading_2']; ?>
                                </span>
                            </h1>
                            <p class="fw-bold lead text-white text-start lh-sm">
                                <?php echo $hero['copy']['description']; ?>
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
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
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

<?php } ?>