<?php if (empty($args)) return; ?>

<!-- Features -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-24 mx-auto">
   <div class="relative p-6 md:p-16">
      <!-- Grid -->
      <div class="relative z-10 lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center">
         <div class="mb-10 lg:mb-0 lg:col-span-6 lg:col-start-8 lg:order-2">

            <?php
            $section_heading = tw_output_heading($args);
            if ($section_heading) echo $section_heading;
            ?>


            <nav class="grid gap-4 mt-5 md:mt-10 features-vertical-tabs" aria-label="Tabs" role="tablist" aria-orientation="vertical">

               <?php
               $vertical_tabs_content = tw_get_template_content($args);
               $i = 1;
               ?>

               <?php foreach ($vertical_tabs_content as $content):  ?>

                  <?php
                  $aria_selected = $i === 1 ? 'true' : 'false';
                  $active = $i === 1 ? ' active ' : '';
                  ?>

                  <button type="button" class="hs-tab-active:bg-white hs-tab-active:shadow-md hs-tab-active:hover:border-transparent text-start hover:bg-gray-200 focus:outline-none Ifocus:bg-gray-200 p-4 md:p-5 rounded-xl <?php echo $active; ?> " id="tabs-with-card-item-<?php echo $i; ?>" aria-selected="<?php echo $aria_selected; ?>" data-hs-tab="#tabs-with-card-<?php echo $i; ?>" aria-controls="tabs-with-card-<?php echo $i; ?>" role="tab">

                     <span class="flex flex-col md:flex-row gap-x-6">

                        <?php if (!empty($content['icon'])): ?>
                           <img class="hidden md:block shrink-0 mt-2 size-6 md:size-7 lg:size-9 hs-tab-active:text-blue-600 text-gray-800" src="<?php echo $content['icon']; ?>" />
                        <?php endif ?>

                        <span class="grow">

                           <?php if (!empty($content['icon'])): ?>
                              <img class="inline md:hidden align-text-bottom mr-3 shrink-0 mt-2 size-6 md:size-7 lg:size-9 hs-tab-active:text-blue-600 text-gray-800" src="<?php echo $content['icon']; ?>" />
                           <?php endif ?>

                           <?php if (!empty($content['heading'])): ?>
                              <span class="inline-block text-lg font-semibold hs-tab-active:text-brand-500 text-gray-800">
                                 <?php echo $content['heading']; ?>
                              </span>
                           <?php endif ?>

                           <?php if (!empty($content['description'])): ?>
                              <span class="text-sm md:text-base block mt-1 text-gray-800 vertical-tabs-description">
                                 <?php echo $content['description']; ?>
                              </span>
                           <?php endif ?>
                        </span>
                     </span>
                  </button>
                  <?php $i++; ?>
               <?php endforeach; ?>
            </nav>
         </div>

         <!-- Images -->
         <div class="lg:col-span-6">
            <div class="relative">
               <div>
                  <?php
                  $e = 1;
                  foreach ($vertical_tabs_content as $content): ?>

                     <?php $div_class = $e > 1 ? 'hidden' : '';  ?>
                     <div id="tabs-with-card-<?php echo $e; ?>" role="tabpanel" aria-labelledby="tabs-with-card-item-<?php echo $e; ?>" class="<?php echo $div_class; ?>">
                        <img class="shadow-xl shadow-gray-200 rounded-xl" src="<?php echo $content['image']; ?>" alt="Features Image">
                     </div>
                     <?php $e++; ?>
                  <?php endforeach ?>
               </div>
               <!-- End Tab Content -->

               <!-- SVG Element -->
               <div class="hidden absolute top-0 end-0 translate-x-20 md:block lg:translate-x-20">
                  <svg class="w-16 h-auto text-orange-500" width="121" height="135" viewBox="0 0 121 135" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M5 16.4754C11.7688 27.4499 21.2452 57.3224 5 89.0164" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                     <path d="M33.6761 112.104C44.6984 98.1239 74.2618 57.6776 83.4821 5" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                     <path d="M50.5525 130C68.2064 127.495 110.731 117.541 116 78.0874" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                  </svg>
               </div>
               <!-- End SVG Element -->
            </div>
         </div>
         <!-- End Col -->
      </div>
      <!-- End Grid -->

      <!-- Background Color -->
      <div class="absolute inset-0 grid grid-cols-12 size-full">
         <div class="col-span-full lg:col-span-7 lg:col-start-6 bg-gray-100 w-full h-5/6 rounded-xl sm:h-3/4 lg:h-full"></div>
      </div>
      <!-- End Background Color -->
   </div>
</div>
<!-- End Features -->