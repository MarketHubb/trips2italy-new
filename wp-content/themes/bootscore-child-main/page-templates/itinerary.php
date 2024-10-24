<?php
/* Template Name: Itinerary */
get_header('itinerary');
$form = GFAPI::get_form(11);
$bg_image = get_home_url() . '/wp-content/uploads/2024/09/Itinerary-Water.webp';
$mobile_bg_image = get_home_url() . '/wp-content/uploads/2024/10/Itinerary-BG-Mobile.webp';
?>
<div class="h-full bg-fixed bg-cover" style="background-image: url(<?php echo $bg_image; ?>);">
    <div class="hidden md:block absolute z-20 w-full h-full inset-0 bg-gradient-to-b from-gray-900 from-0%"></div>
    <section class=" md:py-16 mb-8">
        <div class="max-w-7xl px-6 sm:px-0 sm:mx-auto z-30 relative py-12 sm:pt-0 text-center text-2xl md:text-3xl lg:text-4xl xl:text-[2.75rem]">
            <div class="block md:hidden absolute z-10 inset-0 h-full w-full bg-cover bg-center" style="background-image: url(<?php echo $mobile_bg_image; ?>);"></div>
            <div class="block md:hidden absolute z-20 w-full h-full inset-0 bg-gradient-to-b from-gray-900 from-0%"></div>
            <div class="relative z-30">
                <span class="rounded-full bg-white/90 px-3 py-1 text-xs sm:text-sm font-semibold leading-6 text-brand-700 ring-1 ring-inset ring-brand-700/10">Takes 2 minutes</span>
                <h1 class="text-white tracking-tight leading-tight mt-5 sm:my-4 mb-2 sm:mb-0 text-2xl md:text-3xl lg:text-4xl">
                    Your Custom Trip to Italy
                </h1>
                <span class="block font-semibold sm:inline-block relative sm:leading-normal stylized text-[130%] sm:text-[130%] text-secondary-500  ">Starts Right Here</span>
                <div class="sm:max-w-lg mx-auto mt-4 lg:mt-0">
                    <p class="hidden sm:block text-white font-semibold text-lg md:text-xl leading-normal tracking-tight mb-6">
                        Tell us how <span class="stylized text-[150%] pr-1">you</span> want to see Italy, and we'll help make it a reality with a personalized itineray.
                    </p>
                    <p class="block sm:hidden text-white font-base text-lg tracking-tight font-medium leading-tighter text-center max-w-[90%] mx-auto mb-20">
                        Tell us how <span class="stylized text-[150%] pr-1 leading-[0]">you</span> want to see Italy, and we'll make it a reality.
                    </p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto rounded-md bg-gray-50 sm:bs-blur ring-2 ring-white shadow-md shadow-gray-400 pt-0 pb-16 sm:py-24 relative z-40">
            <?php echo gravity_form_to_tailwind_exact($form); ?>
        </div>
    </section>
</div>



    <!-- Testimonials -->
    <section class="py-7">

        <div class="container">

            <!-- Section Heading -->
            <div class="container">

                <div class="row mt-6">

                    <div class="col-lg-4 col-md-8">
                        <div class="card card-plain">
                            <div class="card-body">
                                <div class="author d-block">
                                    <div class="name">
                                        <h6 class="mb-0 font-weight-bolder ">Robin &amp; Michael</h6>
                                        <div class="d-flex flex-row  stats "><span class="border-end border-light fw-bolder d-inline-block pe-2 me-2 ">Rome &amp; Florence</span><span class="d-inline-flex fw-bold ">Honeymoon</span></div>
                                    </div>
                                </div>
                                <p class="mt-4 small ">Our trip was fabulous. All the plans were set up perfectly, everything went off like clockwork. We really appreciated the special service we received everywhere we went. Walking out to the canal in Venice and having the water taxi drive up at exactly the scheduled time was perfect. Our favorite tour of all was the food and wine tour in Rome. The food was authentic and locals were unique and memorable.</p>
                                <div class="rating mt-3">
                                    <i class="fas fa-star text-secondary-500 " aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 " aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 " aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 " aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 " aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8">
                        <div class="card" style="background-color: #195fa4;">
                            <div class="card-body">
                                <div class="author d-block">
                                    <div class="name">
                                        <h6 class="mb-0 font-weight-bolder text-white">Mary &amp; Greg</h6>
                                        <div class="d-flex flex-row  stats text-white"><span class="border-end border-light fw-bolder d-inline-block pe-2 me-2 text-white">Venice &amp; Florence</span><span class="d-inline-flex fw-bold text-white">Italian Vacation</span></div>
                                    </div>
                                </div>
                                <p class="mt-4 small text-white" style="">We had the most wonderful trip to Italy with Mary and Martin C. and we wanted to thank you personally for putting together such a fabulous itinerary. Too many favorite things to list! Such a beautiful place and we want to go back in a few years and hit Rome and the Amalfi Coast. When the time comes, we will make sure and contact you! Many, many thanks to you again Tommaso!</p>
                                <div class="rating mt-3">
                                    <i class="fas fa-star text-secondary-500 text-white" aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 text-white" aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 text-white" aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 text-white" aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 text-white" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8">
                        <div class="card card-plain">
                            <div class="card-body">
                                <div class="author d-block">
                                    <div class="name">
                                        <h6 class="mb-0 font-weight-bolder ">Irene</h6>
                                        <div class="d-flex flex-row  stats "><span class="border-end border-light fw-bolder d-inline-block pe-2 me-2 ">Tuscany &amp; Florence</span><span class="d-inline-flex fw-bold ">Food &amp; Wine Tour</span></div>
                                    </div>
                                </div>
                                <p class="mt-4 small ">Tomasso promised us a unique, wonderful traveling experience and he exceeded our expectations. We are so grateful for his care to every detail and selection of activities. The cooking class was an especially wonderful. I never dreamed it would be in an outside kitchen surrounded by the beauty of Italy. Making our own pasta was so much fun and topping the meal off with “chocolate salami” was heavenly.</p>
                                <div class="rating mt-3">
                                    <i class="fas fa-star text-secondary-500 " aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 " aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 " aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 " aria-hidden="true"></i>
                                    <i class="fas fa-star text-secondary-500 " aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="horizontal dark my-5">

                <div class="row">
                    <?php
                    if (have_rows('logos')) :
                        $logos = '<div class="row">';
                        while (have_rows('logos')) : the_row();
                            $logos .= '<div class="col-lg-2 col-md-4 col-6 ms-auto">';
                            $logos .= '<img class="w-100 opacity-8" src="' . get_sub_field('logo')['url'] . '" alt="Logo">';
                            $logos .= '</div>';
                        endwhile;
                        $logos .= '</div>';
                        echo $logos;
                    endif;
                    ?>

                </div>
            </div>

    </section>

<?php get_footer(); ?>