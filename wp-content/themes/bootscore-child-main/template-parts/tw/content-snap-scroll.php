<!-- https://www.shaunchander.me/build-simple-sliders-with-scroll-snapping-in-tailwindcss/ -->
<?php
$bg_image = get_field('global_features_bg_image', 'option')['url'];
$mobile_bg_image_field = get_field('global_features_mobile_bg_image', 'option');
$mobile_bg = isset($mobile_bg_image_field) && !empty($mobile_bg_image_field) ? $mobile_bg_image_field['url'] : $bg_image_field;
?>

<section class="flex md:hidden items-center py-16 md:py-32 bg-gradient-overlay" style="background-image: 
    linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.3)), 
    url(<?php echo $mobile_bg; ?>); 
    background-repeat: no-repeat; 
    background-size: cover; 
    background-position: bottom;">
   <div class="container mx-auto space-y-6 px-0">
      <h2 class="text-3xl font-semibold text-white">Our Features</h2>
      <ul id="feature-slider" class="flex snap-x snap-mandatory gap-x-6 py-6 overflow-x-auto">
         <li class="rounded-xl w-1 flex-shrink-0 snap-center opacity-65 transition-all duration-300 ease-in-out">
         </li>
         <?php
         $i = 1;
         if (isset($args['featured'])) {
            foreach ($args['featured'] as $featured) { ?>
               <li class="snap-item rounded-xl w-9/12 flex-shrink-0 snap-center opacity-65 transition-all duration-300 ease-in-out">
                  <div class="flex flex-col h-full bg-white rounded-xl p-3 transition-all duration-300 ease-in-out transform">
                     <div class="flex items-center justify-center p-2">
                        <!-- container for stacked elements -->
                        <div class="relative w-full max-w-lg aspect-auto">
                           <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32  bg-brand opacity-50 rounded-full filter blur-xl"></div>
                           <img src="<?php echo $featured['image']['url']; ?>" alt="base image" class="relative h-32  z-10 w-full object-contain">
                           <img src="<?php echo get_home_url() . '/wp-content/uploads/2024/07/spiral.svg'; ?>" alt="overlay image" class="absolute inset-0 w-full h-full object-contain opacity-20">
                        </div>
                     </div>
                     <div class="md:pl-2 mt-2 text-center px-3">
                        <h5 class="d-inline-block fw-bolder text-uppercase mt-3 mb-1 text-xl md:text-2xl"><?php echo $featured['heading']; ?></h5>
                        <h5 class="text-gradient text-primary stylized mb-4 text-2xl"><?php echo $featured['subheading']; ?></h5>
                        <p class="text-gray-900 tracking-tight text-sm leading-tight"><?php echo $featured['description']; ?></p>
                     </div>
                  </div>
               </li>
         <?php
               $i++;
            }
         }
         ?>
         </li>
         <li class="rounded-xl w-3/12 flex-shrink-0 snap-center opacity-65 transition-all duration-300 ease-in-out">
         </li>
      </ul>
   </div>
</section>