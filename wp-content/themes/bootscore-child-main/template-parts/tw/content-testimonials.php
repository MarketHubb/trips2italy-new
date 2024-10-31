<?php if (empty($args) || empty($args['content'])) return; ?>

<?php echo tw_section_open($args) ?>

<?php echo tw_container_open(); ?>

<div class="mx-auto max-w-7xl relative z-10">

   <!-- Section heading -->
   <div class="pb-10 text-center animate-fade-in-up">
      <?php echo tw_heading(get_the_ID(), 'testimonials'); ?>
   </div>


   <ul class="flex lg:grid lg:grid-cols-4 lg:justify-center lg:content-center snap-slider snap-x snap-mandatory gap-x-6 lg:gap-x-10 pb-16 overflow-x-auto relative bottom-8">
      <li class="lg:hidden rounded-xl w-0 flex-shrink-0 snap-center opacity-65 transition-all duration-300 ease-in-out"></li>

      <?php if (!empty($args['content'])) { ?>

         <?php foreach ($args['content'] as $review_id) { ?>

            <li class="snap-item rounded-xl w-10/12 lg:w-full flex-shrink-0 ring-0 snap-center opacity-65 lg:opacity-100 transition-all duration-300 ease-in-out pt-8 sm:pt-0">
               <div class="flex justify-center -mb-6 z-50 relative">
                  <img src="<?php echo get_field('square_image', $review_id)['url']; ?>" alt="testimonial" class="shadow-lg ring-1 ring-white shadow-white/50 rounded-full max-w-20 max-h-20 relative">
               </div>
               <div class="flex flex-col h-full  rounded-xl p-3 transition-all duration-300 ease-in-out transform bg-cover bg-center overflow-hidden lg:shadow-md">
                  <div class="absolute inset-0 bg-cover bg-top lg:bg-bottom" style="background-image: url(<?php echo get_field('background_image', $review_id)['url']; ?>);"></div>
                  <?php
                  $bg_gradient_field = get_field('image_background_color', $review_id);
                  $bg_gradient = $bg_gradient_field !== 'Light' && $bg_gradient_field !== 'Dark' ? 'from-' . strtolower($bg_gradient_field) . '-950' : 'from-blue-950';

                  ?>
                  <div class="absolute inset-0 h-full w-full bg-gradient-to-b <?php echo $bg_gradient; ?> from-[25%]"></div>
                  <div class="flex flex-col h-full items-center justify-center px-3 overflow-visible z-10">

                     <div class="mt-2 rating mb-2">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                     </div>

                     <?php $text_color = get_field('image_background_color', $review_id) === 'Light' ? ' text-gray-800 ' : ' text-white '; ?>

                     <div class="text-white pb-[10rem]">
                        <p class="my-4 text-base">
                           "<?php echo get_field('excerpt', $review_id); ?>"
                        </p>
                        <div class="text-left justify-start w-full">

                           <p class="d-inline fw-semibold text-sm">
                              <?php echo get_substring_before_dash(get_the_title($review_id)); ?>
                           </p>

                           <?php $regions = get_field('post_location', $review_id); ?>

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