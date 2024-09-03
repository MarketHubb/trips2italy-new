<?php $hero_inputs = get_hero_inputs(get_queried_object()); ?>

<?php if (!empty($hero_inputs)) { ?>

   <header class="hidden sm:block">
      <div class="min-h-96 relative flex items-center bg-cover bg-center p-0 overflow-hidden" style="background-image: url(<?php echo $hero_inputs['images']['background_image']; ?>);">
         <span class="absolute inset-0 w-full h-full  sm:bg-gradient-to-r sm:from-gray-800 from-[1%]"></span>
         <!-- Copy -->
         <div class="pl-8 max-w-7xl mx-auto w-full z-10 relative py-24 lg:py-44 xl:py-56 ">
            <div class="lg:max-w-[40%] mb-[104px]">
               <h1 class="">
                  <span class="text-xl md:text-3xl xl:text-4xl text-secondary-400 tracking-normal block"><?php echo $hero_inputs['copy']['heading_1']['desktop']; ?></span>
                  <span class="text-2xl md:text-3xl lg:text-4xl xl:text-5xl text-white stylized"><?php echo $hero_inputs['copy']['heading_2']['desktop']; ?></span>
               </h1>
               <p class="text-white text-lg mt-6">
                  <?php echo $hero_inputs['copy']['description']['desktop']; ?>
               </p>
            </div>
         </div>
         <!-- Wave -->
         <div class="position-absolute w-100 z-index-1 bottom-0">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
               <defs>
                  <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
               </defs>
               <g class="moving-waves">
                  <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40"></use>
                  <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                  <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                  <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                  <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                  <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95"></use>
               </g>
            </svg>
         </div>
      </div>
   </header>

<?php } ?>