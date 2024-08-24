<?php $testimonials = get_testimonials_by_trip_type(get_the_ID()); ?>
<?php if (!empty($testimonials)) { ?>

   <?php
   $bg_image = get_field('global_features_bg_image', 'option')['url'];
   $mobile_bg = get_home_url() . '/wp-content/uploads/2024/07/Trip-Testimonials.webp';
   ?>
   <section class="flex items-center py-12 md:py-32 bg-gradient-overlay">
      <div class="container mx-auto px-0">
         <div class="row section-heading mb-5 justify-content-center">
            <div class="col-12 col-md-8 col-lg-7 text-center">
               <?php
               $section_heading = [
                  'heading' => 'Our clients keep saying',
                  'subheading' => 'The nicest things',
                  'description' => 'Don\'t take our word for it - here\'s what some of our recent honeymoon clients have to say:',
               ];
               ?>
               <?php echo tw_section_heading($section_heading); ?>
            </div>
         </div>
         <h2 class="hidden text-3xl font-semibold text-white">Our Features</h2>
         <ul class="flex lg:grid lg:grid-cols-4 lg:justify-center lg:content-center snap-slider snap-x snap-mandatory gap-x-6 lg:gap-x-10 pb-16 overflow-x-auto relative bottom-8">
            <li class="lg:hidden rounded-xl w-1/12 flex-shrink-0 snap-center opacity-65 transition-all duration-300 ease-in-out">
            </li>

            <?php if (!empty($testimonials)) { ?>

               <?php foreach ($testimonials as $testimonial) { ?>

                  <li class="snap-item rounded-xl w-9/12 lg:w-full flex-shrink-0 ring-0 snap-center opacity-65 lg:opacity-100 transition-all duration-300 ease-in-out pt-16">
                     <div class="flex justify-center -mb-6 z-50 relative">
                        <img src="<?php echo get_field('square_image', $testimonial); ?>" alt="testimonial" class="shadow-md rounded-full max-w-20 max-h-20 relative">
                     </div>
                     <div class="flex flex-col h-full  rounded-xl p-3 transition-all duration-300 ease-in-out transform bg-cover bg-center overflow-hidden lg:shadow-md">
                        <?php $bg_image = get_home_url() . '/wp-content/uploads/2024/08/Testimonials-Rachel.webp'; ?>
                        <div class="absolute inset-0 bg-cover bg-top lg:bg-bottom" style="background-image: url(<?php echo get_field('background_image', $testimonial); ?>);"></div>
                        <div class="flex flex-col items-center justify-center px-3 pb-[10rem] overflow-visible z-10">

                           <div class="mt-10 rating mb-2">
                              <i class="fas fa-star text-warning"></i>
                              <i class="fas fa-star text-warning"></i>
                              <i class="fas fa-star text-warning"></i>
                              <i class="fas fa-star text-warning"></i>
                              <i class="fas fa-star text-warning"></i>
                           </div>
                           <?php $text_color = get_field('background_image_color', $testimonial) === 'Light' ? ' text-gray-800 ' : ' text-white '; ?>
                           <div class="<?php echo $text_color ?>">
                              <p class="my-4 text-base">
                                 "<?php echo get_field('testimonial', $testimonial->ID); ?>"
                              </p>
                              <div class="text-left justify-start w-full">
                                 <p class="d-inline fw-semibold text-sm"><?php echo get_the_title($testimonial->ID) ?></p>
                                 <?php $regions = get_field('regions', $testimonial); ?>

                                 <p class="text-xl stylized mt-2">
                                    <?php if (!empty($regions)) { ?>
                                       <?php foreach ($regions as $region) { ?>
                                          <span class="px-1"><?php echo get_the_title($region); ?></span>
                                       <?php } ?>
                                    <?php } ?>
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>

               <?php } ?>

            <?php } ?>

            </li>
            <li class="lg:hidden rounded-xl w-3/12 flex-shrink-0 snap-center opacity-65 transition-all duration-300 ease-in-out">
            </li>
         </ul>
      </div>
   </section>
<?php } ?>