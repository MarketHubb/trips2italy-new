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

            <!-- <div class="container py-8"> -->
            <div class="max-w-7xl mx-auto">

                <!-- Heading (Copy) -->
                <!-- <div class="row justify-content-start"> -->
                <div class="grid grid-cols-2 lg:grid-cols-12 items-center py-24 lg:py-32 lg:gap-x-8">
                    <!-- <div class="col-md-8"> -->
                    <div class="col-span-1 md:col-span-5">
                        <h1 class="font-heading text-brand-700 mb-2 font-semibold text-xl sm:text-3xl md:text-5xl lg:text-7xl lg:leading-tight">
                            <?php echo $hero['copy']['heading_1']['desktop']; ?>
                            <span class="stylized d-block mt-1 font-normal text-brand-500 text-[130%]">
                                <?php echo $hero['copy']['heading_2']['desktop']; ?>
                            </span>
                        </h1>
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="row"> -->
                        <!-- Description + Callouts + Button  -->
                        <!-- <div class="my-auto d-none d-md-block <?php //echo $text_columns; 
                                                                    ?>"> -->
                        <!-- <div class="position-relative mt-n8"> -->
                        <div class="relative">
                            <p class="text-base font-[500] md:text-lg text-gray-800 mt-8 lg:pr-8">
                                <?php echo $hero['copy']['description']['desktop']; ?>
                            </p>

                            <div class="my-8  px-md-0 hero-callouts">
                                <ul role="list" class="mt-8 grid grid-cols-1 gap-y-4 text-sm leading-6 list-disc list-inside ps-1">

                                    <?php foreach ($hero['callouts'] as $callout) { ?>

                                        <li class="">
                                            <svg class="hidden h-7 w-6 flex-none text-secondary-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-gray-800 tracking-wide text-base font-[500] md:text-lg "><?php echo $callout['desktop']; ?></span>
                                        </li>

                                    <?php } ?>
                                </ul>

                                <ul class="hidden list-group border-0">
                                    <?php foreach ($hero['callouts'] as $callout) { ?>
                                        <li class="list-group-item bg-transparent text-start border-0 py-2.5">
                                            <p class="text-base lg:text-xl text-brand-700 font-bold">
                                                <span class="tracking-wide stylized">
                                                    <?php if (!empty($callout['icon'])) {
                                                        echo $callout['icon'];
                                                    } ?>
                                                    <?php echo $callout['desktop']; ?>
                                                </span>
                                            </p>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="hero-links mt-5 py-2">
                                <div class="d-inline-flex  justify-start">
                                    <a class="<?php echo tw_cta_btn_base_classes(); ?>" href="<?php echo get_permalink(28484); ?>">
                                        <?php echo $hero['links'][0]['copy']; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>

                    <!-- Masonry Images-->
                    <?php
                    $masonry_images = $hero['images']['masonry'];
                    if (!empty($masonry_images)) { ?>
                        <!-- <div class="ps-5 pe-0 images <?php //echo $image_columns; 
                                                            ?>"> -->
                        <div class="col-span-1 md:col-span-7">
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
                                <a class="<?php echo tw_cta_btn_base_classes(); ?>" href="<?php echo get_permalink(28484); ?>">
                                    <?php echo $hero['links'][0]['copy']; ?>
                                </a>

                                <!-- <button type="button" class="btn bg-gradient-warning btn-lg mt-4" data-bs-toggle="modal" data-bs-target="#modalppc">Plan My Dream Trip</button> -->
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