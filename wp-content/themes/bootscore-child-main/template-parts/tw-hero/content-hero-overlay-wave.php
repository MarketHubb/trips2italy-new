<?php
if (isset($args)) {
    if (empty($args['hero'])) {
        $hero_inputs = $args;
    } else {
        $hero_inputs = $args['hero'];
    }
} else {
    $hero_inputs = get_hero_inputs(get_queried_object());
}

?>

<?php if (isset($hero_inputs) && !empty($hero_inputs)) { ?>

   <header class="block">
      <div class="min-h-96 relative flex items-center bg-cover bg-center p-0 overflow-hidden" style="background-image: url(<?php echo $hero_inputs['images']['background_image']['url']; ?>);">
         <span class="absolute inset-0 w-full h-full  bg-gradient-to-r from-[#121821] from-[100%] opacity-60 sm:opacity-100 sm:from-[#0d1117] sm:from-[1%] "></span>
         <!-- Copy -->
         <div class="md:pl-8 max-w-7xl mx-auto w-full z-10 relative px-6 md:px-0 py-24 lg:py-44 xl:py-56 ">
            <div class="lg:max-w-[62%]">
               <?php if (!empty($hero_inputs['breadcrumbs'])) { ?>

                  <?php get_template_part( 'template-parts/tw-hero/content', 'breadcrumbs', $hero_inputs['breadcrumbs'] ); ?>
                  
               <?php  } ?>
               <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl leading-normal sm:leading-none">
                  <span class="text-secondary-500 tracking-tight md:tracking-normal font-bold block leading-none pb-4 "><?php echo $hero_inputs['copy']['heading_1']['desktop']; ?></span>
                  <span class="text-[115%] text-white stylized leading-[1]"><?php echo $hero_inputs['copy']['heading_2']['desktop']; ?></span>
               </h1>
               <p class="text-white !leading-relaxed text-base md:text-[1.2rem] font-semibold antialiased mt-8 lg:max-w-[60%]">
                  <?php echo $hero_inputs['copy']['description']['desktop']; ?>
               </p>
            </div>
         </div>
         <!-- Wave -->
         <div class="hidden position-absolute w-100 z-index-1 bottom-0">
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