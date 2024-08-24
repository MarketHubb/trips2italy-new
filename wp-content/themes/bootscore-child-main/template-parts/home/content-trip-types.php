<?php
$args = [
   'image' => get_home_url() . '/wp-content/uploads/2023/07/Packages-Hero-Image.jpg',
   'classes' => ' relative bg-cover bg-center '
];
echo tw_section_open($args); ?>
<div class="absolute inset-0 bg-gradient-to-b from-blue lg:bg-gradient-to-r lg:from-gray-950 from-[1%] h-full w-full"></div>
<div class="max-w-7xl mx-auto z-20 relative">

   <div class="grid grid-cols-1 lg:grid-cols-12 items-center">
      <div class="lg:col-span-5">
         <div class="pb-10 z-10">
            <?php echo tw_heading(get_the_ID(), 'trip_types_heading', 'text-left'); ?>
         </div>
      </div>
      <div class="lg:col-span-7">

         <div class="divide-y divide-gray-200 overflow-hidden rounded-lg  shadow sm:grid sm:grid-cols-2 md:grid-cols-3 gap-y-10 flex flex-col sm:gap-[8px] sm:divide-y-0">

            <?php $content_fields = get_field('trip_types'); ?>

            <?php if (!empty($content_fields)) { ?>

               <?php foreach ($content_fields as $field) { ?>
                  <div class="group relative rounded lg:rounded-tl-lg lg:rounded-tr-lg  focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 sm:rounded-tr-none">
                     <img class="w-full h-48 rounded object-<?php echo $field['image_position']; ?> object-cover" src="<?php echo get_field('featured_image_mobile', $field['trip_type']->ID); ?>" alt="">
                     <div class="p-6 bs-blur rounded-b lg:rounded-b-none">
                        <div class="mt-3">
                           <h3 class="stylized font-semibold leading-6 text-blueDark">
                              <a href="<?php echo get_permalink($field['trip_type']->ID); ?>" class="font-bold text-2xl lg:text-2xl xl:text-2xl focus:outline-none">
                                 <!-- Extend touch target to entire panel -->
                                 <span class="absolute inset-0" aria-hidden="true"></span>
                                 <?php echo $field['trip_type']->post_title; ?>
                              </a>
                           </h3>
                           <p class="mt-2 text-sm text-gray-700 line-clamp-2"><?php echo get_field('excerpt', $field['trip_type']->ID); ?></p>
                        </div>
                        <span class="pointer-events-none absolute right-6 top-6 text-gray-300 group-hover:text-blue" aria-hidden="true">
                           <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z" />
                           </svg>
                        </span>
                     </div>
                  </div>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
   </div>
   </section>