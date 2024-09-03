<?php echo tw_section_open(); ?>
<div class="max-w-7xl mx-auto">
   <div class="pb-10">
      <?php echo tw_heading(get_the_ID(), 'regions_heading'); ?>
   </div>

   <?php
   $keyMap = [
      'region_link' => 'link',
      'excerpt' => 'description',
      'region' => 'heading',
   ];
   $content_fields = [];
   $content_fields['content'] = change_array_keys(get_field('regions'), $keyMap);
   ?>

   <?php if (!empty($content_fields)) { ?>
      <?php echo get_image_grid($content_fields); ?>
   <?php } ?>

   <div class="mt-16 flex justify-center">
      <p class="relative text-base rounded-full px-4 py-1.5 leading-6 text-gray-600 ring-1 ring-inset ring-gray-900/10 hover:ring-gray-900/20">
         <span class="hidden md:inline">We've crafted trips to over <span class="font-bold"><?php echo wp_count_terms('location_region'); ?></span> regions in <span class="font-bold"><?php echo wp_count_posts('location')->publish; ?></span> cities and towns.</span>
         <a href="<?php echo get_permalink(27712); ?>" class="text-base font-semibold text-brand-500"><span class="absolute inset-0" aria-hidden="true"></span> View all destinations <span aria-hidden="true">&rarr;</span></a>
      </p>
   </div>

</div>
</section>