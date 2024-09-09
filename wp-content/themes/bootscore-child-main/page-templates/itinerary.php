<?php
/* Template Name: Itinerary */
get_header('itinerary');
$form = GFAPI::get_form(11); // Get form with ID 1 
// $bg_image = get_home_url() . '/wp-content/uploads/2024/09/Itinerary-Image.webp';
$bg_image = get_home_url() . '/wp-content/uploads/2024/09/Itinerary-Water.webp';

?>
<!-- <div class="absolute inset-0 h-full w-full bg-fixed bg-center bg-cover" style="background-image: url(http://t2i-new.test/wp-content/uploads/2023/07/Packages-Hero-Image.jpg);"></div> -->
<section class=" sm:mt-6 md:pb-20 bg-fixed bg-cover bg-center" style="background-image: url(<?php echo $bg_image; ?>);">
    <!-- <section class="sm:py-12"> -->
    <div class="max-w-7xl px-6 sm:px-0 sm:mx-auto z-10 relative py-12 sm:pt-0 text-center text-2xl md:text-3xl lg:text-4xl xl:text-[2.75rem]">
        <span class="rounded-full bg-white/80 px-3 py-1 text-xs sm:text-sm font-semibold leading-6 text-brand-700 ring-1 ring-inset ring-brand-700/10">Takes 2 minutes</span>
        <h1 class="text-white tracking-normal sm:leading-normal mt-5 sm:mt-0 mb-2 sm:mb-0">
            Your Custom Itinerary to Italy
        </h1>
        <span class="block sm:inline-block relative bottom-2 sm:bottom-4 stylized text-[130%] sm:text-[130%] text-secondary-500  ">Starts Right Here</span>
        <div class="sm:max-w-lg mx-auto mt-4 lg:mt-0">
            <p class="hidden sm:block text-white font-base md:text-lg leading-normal">
                Tell us what will make your trip to Italy perfect, and we'll make it a reality with a personalized itineray.
            </p>
            <p class="block sm:hidden text-white font-base md:text-lg leading-normal text-center max-w-[90%] mx-auto">
                Tell us what will make your trip perfect & we'll help make it a reality.
            </p>
        </div>
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-gray-950 from-0% h-full w-full"></div>
    <div class="max-w-7xl mx-auto rounded-md bg-gray-50 sm:bs-blur ring-2 ring-white shadow-md shadow-gray-400 py-16 sm:py-24 relative z-10">
        <?php echo gravity_form_to_tailwind_exact($form); ?>
    </div>
</section>



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