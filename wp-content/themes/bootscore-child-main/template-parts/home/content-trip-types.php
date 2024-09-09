<?php
$section_fields = get_field('trip_types_heading');
$args = [
   'image' => $section_fields['image'],
   'classes' => ' relative bg-cover bg-center hidden md:block '
];
echo tw_section_open($args); ?>
<div class="absolute inset-0 bg-gradient-to-b from-blue lg:bg-gradient-to-r lg:from-gray-950 from-[1%] h-full w-full"></div>
<div class="max-w-7xl mx-auto z-20 relative">

   <div class="grid grid-cols-1 lg:grid-cols-12 items-center sm:gap-x-4 lg:gap-x-12">
      <div class="lg:col-span-4">
         <div class="pb-10 z-10">
            <?php echo tw_heading(get_the_ID(), 'trip_types_heading', 'text-left'); ?>
         </div>
      </div>
      <div class="lg:col-span-8">

         <div class="divide-y divide-gray-200 overflow-hidden rounded-lg  shadow grid grid-cols-2 md:grid-cols-3 gap-y-10 sm:gap-[8px] sm:divide-y-0">

            <?php
            $content_fields = get_field('trip_types');
            $content_array_for_snap_section = [];
            ?>

            <?php if (!empty($content_fields)) { ?>

               <?php foreach ($content_fields as $field) { ?>
                  <?php
                  $content_array_for_snap_section[] = [
                     'link' => get_permalink($field['trip_type']->ID),
                     'image' => [
                        'url' => get_field('featured_image_mobile', $field['trip_type'])
                     ],
                     'heading' => $field['trip_type']->post_title,
                     'description' => return_portion_of_string(get_field('excerpt', $field['trip_type']->ID), 100)
                  ];
                  ?>
                  <div class="group relative rounded lg:rounded-tl-lg lg:rounded-tr-lg  focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 sm:rounded-tr-none">
                     <img class="w-full h-48 rounded object-<?php echo $field['image_position']; ?> object-cover" src="<?php echo get_field('featured_image_mobile', $field['trip_type']->ID); ?>" alt="">
                     <div class="p-6 bs-blur rounded-b lg:rounded-b-none">
                        <div class="mt-3">
                           <h3 class="stylized font-semibold leading-6 text-brand-600">
                              <a href="<?php echo get_permalink($field['trip_type']->ID); ?>" class="font-bold text-[2rem] md:text-2xl lg:text-3xl focus:outline-none">
                                 <!-- Extend touch target to entire panel -->
                                 <span class="absolute inset-0" aria-hidden="true"></span>
                                 <?php echo $field['trip_type']->post_title; ?>
                              </a>
                           </h3>
                           <p class="mt-2 text-sm text-gray-700 line-clamp-2"><?php echo get_field('excerpt', $field['trip_type']->ID); ?></p>
                        </div>
                        <span class=" pointer-events-none absolute right-6 top-6 text-gray-300 group-hover:text-brand-500" aria-hidden="true">
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

   <?php
   $args = [
      'mobile_image' => $section_fields['mobile_image'],
      'classes' => ' relative bg-cover bg-center md:hidden ',
      'grid_classes' => ' flex flex-col items-center py-12 md:py-32  ',
      'overlay_classes' => ' bg-gradient-to-b from-gray-900 '
   ];
   echo tw_section_open($args);
   ?>

         <?php echo tw_heading(get_the_ID(), 'trip_types_heading'); ?>

   <!-- <section class="flex items-center py-12 md:py-32 bg-gradient-overlay"> -->

   <div class="container mx-auto px-0">

      <?php
      $snap_content = [];
      $snap_content['content'] = $content_array_for_snap_section;
      $snap_content['item_div_classes'] = ' bg-white ring-2 ring-white flex flex-col lg:flex-row lg:gap-x-4 h-full overflow-hidden rounded-xl lg:px-6 transition-all duration-300 ease-in-out transform-none ';
      $snap_content['ul_classes'] = ' flex snap-slider snap-x snap-mandatory gap-x-6 py-6 overflow-x-auto relative mt-6  ';
      $snap_content['item_img_classes'] = ' rounded-t h-full w-full object-cover relative ';
      $snap_content['item_img_container_classes'] = ' flex items-center justify-center ';
      echo get_scroll_panels($snap_content);
      ?>

   </div>

   </section>