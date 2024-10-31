<?php $hero_fields = get_hero_fields(get_queried_object()); ?>

<?php if (!empty($hero_fields)) { ?>

   <?php
   $bg_image = $hero_fields['image'];
   $mobile_bg_image = !empty($hero_fields['mobile_image']) ? $hero_fields['mobile_image'] : $bg_image;
   ?>

   <!-- <section class="relative h-screen -mb-8 lg:-mb-28"> -->
   <section class="relative h-screen">
      <!-- BG Image Container -->
      <div class="absolute inset-0">
         <!-- Desktop Image -->
         <div class="hidden md:block relative w-full h-full">
            <img src="<?php echo $bg_image; ?>" alt="Hero background" class="absolute inset-0 w-full h-full object-cover object-center">
         </div>
         <!-- Mobile Image -->
         <div class="md:hidden relative w-full h-full">
            <img src="<?php echo $mobile_bg_image; ?>" alt="Hero background mobile" class="absolute inset-0 w-full h-full object-cover object-center">
         </div>
         <!-- Filter -->
         <div class="absolute inset-0 bg-filter z-10"></div>
      </div>

      <!-- Content Container -->
      <div class="relative z-20 mobile-full-nav flex flex-col justify-end pb-12 md:pb-16 lg:pb-24 px-4 sm:px-6 lg:px-8">
         <!-- Hero copy -->
         <div class="text-center animate-fade-in-up text-white">
            <?php if ($hero_fields['heading']) { ?>
               <p class="font-heading text-lg font-bold antialiased lg:text-3xl mb-0 tracking-tight">
                  <?php echo $hero_fields['heading']; ?>
               </p>
            <?php } ?>
            <?php if ($hero_fields['subheading']) { ?>
               <h1 class="text-secondary-400 stylized font-thin block text-[2.35rem] lg:text-6xl mb-4 lg:mb-7">
                  <?php echo $hero_fields['subheading']; ?>
               </h1>
            <?php } ?>
            <?php if ($hero_fields['description']) { ?>
               <div class="lg:max-w-lg mx-auto px-4 lg:px-10 text-center max-w-[90%] sm:max-w-full">
                  <p class="text-base font-medium md:text-lg lg:text-xl !leading-normal">
                     <?php echo $hero_fields['description']; ?>
                  </p>
               </div>
            <?php } ?>

         </div>
      </div>
   </section>

   <!-- CTA + Icons -->
   <section class="bg-[#0d0f11] py-6 block mx-auto">
      <div class="lg:max-w-3xl mx-auto pb-6 animate-on-scroll relative z-30 bottom-[4rem] -mb-20 lg:bottom-[7rem] lg:-mb-[7rem]">
         <div class="mx-auto text-center">
            <!-- <button data-type="Form" data-target="form" class="rounded-md px-3.5 py-2.5 text-base font-semibold text-white shadow shadow-gray-500 hover:shadow-none bg-orange hover:bg-secondary-300 border border-orangeLight" role="button"> -->
            <?php
            $btn_args = [
               'heading' => [
                  'background_color' => 'dark'
               ],
               'cta' => [
                  'copy' => $hero_fields['copy_main'],
                  'callout' => $hero_fields['callout']
               ]
            ];
            echo tw_cta_btn_link($btn_args);
            ?>
         </div>

         <?php //if ($hero_fields['callout_icons']) { 
         ?>
         <?php if ($hero_fields['icons'] !== 'None') { ?>
            <div class="grid grid-cols-3 animate-on-scroll justify-center pt-6 gap-x-2 text-white opacity-0 transition-opacity duration-500" id="icons">
               <?php
               $icons = '';
               foreach ($hero_fields['callout_icons'] as $key => $val) {


                  $padding_class = get_row_index() === 1 ? 'px-0' : '';
                  $icons .= '<div class="mx-auto text-center w-full">';
                  $icons .= '<div class="min-h-12 flex flex-col justify-center items-center overflow-hidden my-6 ' . $padding_class . '">';
                  $icons .= '<img class="max-h-12 inline-block opacity-90" src="' . $val['icon'] . '" />';
                  $icons .= '</div>';
                  $icons .= '<p class="text-xs lg:text-base mb-0 uppercase lg:tracking-wide opacity-90 tracking-wide font-heading">' . $val['lead_in'] . '</p>';
                  $icons .= '<p class="text-xl lg:text-2xl text-secondary-400 stylized">' . $val['callout'] . '</p>';
                  $icons .= '</div>';
               }
               echo $icons;
               ?>
            </div>
         <?php } ?>

      </div>
   </section>
<?php } ?>