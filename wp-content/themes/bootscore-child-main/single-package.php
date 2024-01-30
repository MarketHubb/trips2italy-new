<?php get_header(); ?>

<?php

?>

<!-- Hero -->
<?php //get_template_part('template-parts/packages/content', 'single-hero'); ?>
<!-- Content -->
<?php get_template_part('template-parts/packages/content', 'single-main'); ?>
<!-- Why -->
<?php //get_template_part('template-parts/packages/content', 'single-why'); ?>

<section class=" py-9">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6">
                <h3 class="text-gradient text-primary mb-0 mt-2">Vacationing to Italy</h3>
                <h3>Has never been easier</h3>
                <p>For nearly two decades we have been working with brides, grandparents, friends, parents or anyone with an adventurous spirit to plan the ultimate Italian vacation. Unlike internet travel sites or even our competitors, our team consists of first generation Italians who know where to go and what to do. Don't just see Italy. Live it. </p>
                <a href="javascript:;" class="text-primary icon-move-right fw-bold">More about us
                    <i class="fas fa-arrow-right text-sm ms-1"></i>
                </a>
            </div>




            <div class="col-lg-6 mt-lg-0 mt-5 ps-lg-0 ps-0">


                <div class="p-3 info-horizontal">
                    <div class="icon icon-shape rounded-circle bg-gradient-warning shadow text-center">
                        <i class="fas fa-comments fa-lg opacity-10"></i>
                    </div>
                    <div class="description ps-3">
                        <p class="lead pb-1 mb-1"><strong>Describe your dream vacation</strong></p>
                        <p class="mb-0">Talk directly to our Italian-born founder, or fill out a short questionnaire, so we can better understand your interests, preferred locations and ideal activities while in Italy.</p>
                    </div>
                </div>


                <div class="p-3 info-horizontal">
                    <div class="icon icon-shape rounded-circle bg-gradient-warning shadow text-center">
                        <i class="fas fa-atlas fa-lg opacity-10"></i>
                    </div>
                    <div class="description ps-3">
                        <p class="lead pb-1 mb-1"><strong>Get a completely customized itinerary</strong></p>
                        <p class="mb-0">Crafted specifically for you with absolutely everything you'll need for a perfect trips to Italy including travel, accommodations, food &amp; activities and more.</p>
                    </div>
                </div>


                <div class="p-3 info-horizontal">
                    <div class="icon icon-shape rounded-circle bg-gradient-warning shadow text-center">
                        <i class="fas fa-suitcase-rolling fa-lg opacity-10"></i>
                    </div>
                    <div class="description ps-3">
                        <p class="lead pb-1 mb-1"><strong>Take your once in a lifetime trip</strong></p>
                        <p class="mb-0">With every detail in you custom travel itinerary planned to perfection, you'll be on your way to visit only the places you want to see, and do only the things you want to do.</p>
                    </div>
                </div>


            </div>



        </div>
    </div>
</section>

<!-- Testimonial -->
<?php get_template_part('template-parts/packages/content', 'single-testimonial'); ?>

<!--Photo Gallery -->
<?php 
$gallery_args = [
    'repeater_field' => 'image_gallery',
    'sub_field_image' => 'image',
    'sub_field_description' => 'description'
];
get_template_part('template-parts/shared/content', 'gallery-repeater', $gallery_args); 
?>

<!-- Related -->
<?php get_template_part('template-parts/packages/content', 'single-related'); ?>



<?php get_footer(); ?>

