<?php echo tw_section_open(); ?>
<div class="max-w-7xl mx-auto">
   <div class="pb-10">
      <?php echo tw_heading(get_the_id(), 'testimonials_heading'); ?>
   </div>
</div>

<?php $content_fields = get_field('postcards'); ?>

<?php if (!empty($content_fields)) { ?>
   <div class="px-4">
      <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-x-6 justify-center gap-4 ">

         <?php foreach ($content_fields as $field) { ?>

            <div>
               <img class="h-full w-full object-cover shadow-sm shadow-slate-400 rounded" src="<?php echo get_field('image', $field['postcard']->ID)['url']; ?>" alt="" />
            </div>

         <?php } ?>

      </div>
   </div>

   <div class="max-w-7xl mx-auto">
      <div class="mt-16 flex justify-center">
      <p class="relative text-base rounded-full px-4 py-1.5 leading-6 text-gray-600 ring-1 ring-inset ring-gray-900/10 hover:ring-gray-900/20">
         <span class="hidden md:inline">Over <span class="font-bold"><?php echo wp_count_posts('postcards')->publish; ?></span> wonderful clients have hand-written us thank you notes.</span>
         <a href="<?php echo get_permalink(30385); ?>" class="text-base font-semibold text-blue"><span class="absolute inset-0" aria-hidden="true"></span> View all postcards <span aria-hidden="true">&rarr;</span></a>
      </p>
   </div>
   </div>

<?php } ?>

</section>