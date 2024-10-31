<?php if (!isset($args) || empty($args)) return; ?>

<?php
$content = tw_get_template_content($args);
$image = $content['image']['url'] ?? null; 
$mobile_image = $content['mobile_image']['url'] ?? $image; 
$heading = $content['heading'] ?? null; 
$callout = $content['callout'] ?? null; 
$description = $content['description'] ?? null; 
$bg_image_color = $content['image_background_color'] ?? 'Dark';
$text_color = $bg_image_color === 'Dark' ? ' text-white' : ' text-brand-800';

?>

   <section class="px-6 lg:px-0 pb-16 md:pb-24 relative  bg-center bg-cover md:aspect-[5/2]" id="section-cta">

      <?php if ($image): ?>
         <?php $bg_position = !empty($args['section']['bg_position']) ? $args['section']['bg_position'] : 'bg-center'; ?>
         <div class="absolute h-full w-full inset-0 bg-cover bg-no-repeat hidden sm:block <?php echo $bg_position; ?>" style="background-image: url(<?php echo $image; ?>);"></div>
      <?php endif ?>

      <?php if ($mobile_image): ?>
         <div class="absolute h-full w-full inset-0 bg-cover bg-center md:hidden" style="background-image: url(<?php echo $mobile_image; ?>);"></div>
      <?php endif ?>

      <div class="absolute inset-0 h-full w-full bg-gradient-to-b from-gray-800"></div>

      <div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8 relative z-20">
         <div class="mx-auto max-w-3xl text-center text-2xl sm:text-3xl md:text-4xl">

            <?php if ($heading): ?>
               <h2 class="font-semibold antialiased tracking-tight mb-4 <?php echo $text_color; ?>">
                  <?php echo $heading; ?>
               </h2>
            <?php endif ?>

            <?php if ($callout): ?>
               <h2 class="stylized font-semibold text-[150%] text-secondary-500">
                  <?php echo $callout; ?>
               </h2>
            <?php endif ?>

            <?php if ($description): ?>
               <p class="mx-auto mt-6 max-w-xl text-lg md:text-xl leading-normal md:leading-8 font-semibold <?php echo $text_color; ?>">
                  <?php echo $description; ?>
               </p>
            <?php endif ?>

            <?php if ($args['cta']): ?>
               <div class="max-w-3xl px-4 pt-10 sm:px-6 sm:pb-20 lg:px-8 lg:pb-28 mx-auto text-center">
                  <?php echo tw_cta_btn_link($args); ?>
               </div>
            <?php endif ?>

         </div>
      </div>

   </section>
