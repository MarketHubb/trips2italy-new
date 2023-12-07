<?php
/* Template Name: Form Test */
get_header(); 
$hero = get_query_var("hero");
?>

<?php //get_template_part('template-parts/contact/content', 'split'); ?>

<nav class="navbar fixed-top bg-light d-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Fixed top</a>
    </div>
</nav>

<?php
$hero = ($hero) ?: get_hero_inputs(get_queried_object());
get_template_part('template-parts/hero-banner/content', 'main', $hero);

?>

<section class="my-6 my-md-7 d-none">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="fs-2 text-dark">Your Dream Italian Vacation <span class="text-primary text-gradient">Starts Here</span></h1>
                <p class="lead mb-0">No more scrolling travel sites looking for the perfect fit. Just give us a few details about your ideal vacation, and let our travel experts do the rest</p>
            </div>
        </div>
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
                            <div class="name"><h6 class="mb-0 font-weight-bolder ">Robin &amp; Michael</h6><div class="d-flex flex-row  stats "><span class="border-end border-light fw-bolder d-inline-block pe-2 me-2 ">Rome &amp; Florence</span><span class="d-inline-flex fw-bold ">Honeymoon</span></div></div></div><p class="mt-4 small ">Our trip was fabulous. All the plans were set up perfectly, everything went off like clockwork. We really appreciated the special service we received everywhere we went. Walking out to the canal in Venice and having the water taxi drive up at exactly the scheduled time was perfect. Our favorite tour of all was the food and wine tour in Rome. The food was authentic and locals were unique and memorable.</p><div class="rating mt-3">
                            <i class="fas fa-star text-orange " aria-hidden="true"></i>
                            <i class="fas fa-star text-orange " aria-hidden="true"></i>
                            <i class="fas fa-star text-orange " aria-hidden="true"></i>
                            <i class="fas fa-star text-orange " aria-hidden="true"></i>
                            <i class="fas fa-star text-orange " aria-hidden="true"></i>
                        </div></div></div></div><div class="col-lg-4 col-md-8">
                <div class="card" style="background-color: #195fa4;">
                    <div class="card-body">
                        <div class="author d-block">
                            <div class="name"><h6 class="mb-0 font-weight-bolder text-white">Mary &amp; Greg</h6><div class="d-flex flex-row  stats text-white"><span class="border-end border-light fw-bolder d-inline-block pe-2 me-2 text-white">Venice &amp; Florence</span><span class="d-inline-flex fw-bold text-white">Italian Vacation</span></div></div></div><p class="mt-4 small text-white" style="">We had the most wonderful trip to Italy with Mary and Martin C. and we wanted to thank you personally for putting together such a fabulous itinerary. Too many favorite things to list! Such a beautiful place and we want to go back in a few years and hit Rome and the Amalfi Coast. When the time comes, we will make sure and contact you! Many, many thanks to you again Tommaso!</p><div class="rating mt-3">
                            <i class="fas fa-star text-orange text-white" aria-hidden="true"></i>
                            <i class="fas fa-star text-orange text-white" aria-hidden="true"></i>
                            <i class="fas fa-star text-orange text-white" aria-hidden="true"></i>
                            <i class="fas fa-star text-orange text-white" aria-hidden="true"></i>
                            <i class="fas fa-star text-orange text-white" aria-hidden="true"></i>
                        </div></div></div></div><div class="col-lg-4 col-md-8">
                <div class="card card-plain">
                    <div class="card-body">
                        <div class="author d-block">
                            <div class="name"><h6 class="mb-0 font-weight-bolder ">Irene</h6><div class="d-flex flex-row  stats "><span class="border-end border-light fw-bolder d-inline-block pe-2 me-2 ">Tuscany &amp; Florence</span><span class="d-inline-flex fw-bold ">Food &amp; Wine Tour</span></div></div></div><p class="mt-4 small ">Tomasso promised us a unique, wonderful traveling experience and he exceeded our expectations. We are so grateful for his care to every detail and selection of activities. The cooking class was an especially wonderful. I never dreamed it would be in an outside kitchen surrounded by the beauty of Italy. Making our own pasta was so much fun and topping the meal off with “chocolate salami” was heavenly.</p><div class="rating mt-3">
                            <i class="fas fa-star text-orange " aria-hidden="true"></i>
                            <i class="fas fa-star text-orange " aria-hidden="true"></i>
                            <i class="fas fa-star text-orange " aria-hidden="true"></i>
                            <i class="fas fa-star text-orange " aria-hidden="true"></i>
                            <i class="fas fa-star text-orange " aria-hidden="true"></i>
                        </div></div></div></div>
        </div>

        <hr class="horizontal dark my-5">

        <div class="row"><div class="col-lg-2 col-md-4 col-6 ms-auto"><img class="w-100 opacity-8" src="http://t2i-new.test/wp-content/uploads/2023/06/IATA-Logo.jpg" alt="Logo"></div><div class="col-lg-2 col-md-4 col-6 ms-auto"><img class="w-100 opacity-8" src="http://t2i-new.test/wp-content/uploads/2023/06/NTA-Logo.jpg" alt="Logo"></div><div class="col-lg-2 col-md-4 col-6 ms-auto"><img class="w-100 opacity-8" src="http://t2i-new.test/wp-content/uploads/2023/06/BBB-Logo.jpg" alt="Logo"></div><div class="col-lg-2 col-md-4 col-6 ms-auto"><img class="w-100 opacity-8" src="http://t2i-new.test/wp-content/uploads/2023/06/ENIT-Logo.jpg" alt="Logo"></div><div class="col-lg-2 col-md-4 col-6 ms-auto"><img class="w-100 opacity-8" src="http://t2i-new.test/wp-content/uploads/2023/06/ASTA-Logo.jpg" alt="Logo"></div></div>
    </div>

</section>

<?php get_footer(); ?>

