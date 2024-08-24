<?php
$section_args = [
   'image' => get_home_url() . '/wp-content/uploads/2024/08/Background-Posts-1.webp',
   'classes' => ' bg-cover bg-center relative '
];
echo tw_section_open($section_args); ?>

<div class="absolute inset-0 bg-gradient-to-b from-gray-900 from-[1%] h-full w-full"></div>

<div class="max-w-7xl mx-auto relative z-10">
   <div class="pb-10">
      <?php echo tw_heading(get_the_ID(), 'blog_heading'); ?>
   </div>

   <div class="grid grid-cols-1 lg:grid-cols-4 gap-y-6 lg:gap-y-0 lg:gap-x-2">
      <?php $content_fields = get_field('posts'); ?>

      <?php if (!empty($content_fields)) { ?>

         <?php foreach ($content_fields as $field) { ?>
            <div class="rounded shadow-xl bg-white ring-1 ring-gray-300">
               <img class="h-48 lg:h-72 rounded-t w-full border-b border-b-gray-300 object-cover object-center" src="<?php echo get_the_post_thumbnail_url($field['post']->ID); ?>" alt="" />
               <div class="px-6 py-8 flex flex-col justify-between">
                  <a class="hover:text-blue" href="<?php echo get_permalink($field['post']->ID); ?>">
                     <h3 class="text-lg lg:text-xl text-blueGray hover:text-blue tracking-normal mb-3"><?php echo get_the_title($field['post']->ID) ?></h3>
                  </a>
                  <p class=" mt-auto text-base md:text-base text-gray-500 line-clamp-4"><?php echo get_excerpt_for_post(get_the_excerpt($field['post']->ID), 150); ?></p>
               </div>
            </div>
         <?php } ?>

      <?php } ?>
   </div>

</div>
</section>