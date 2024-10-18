<?php if (empty($args)) return; ?>
<div class="bg-white pb-12">
   <div class="mx-auto max-w-7xl px-6 lg:px-0">
      <div class="mx-auto grid max-w-2xl grid-cols-1 items-start gap-x-8 gap-y-16 sm:gap-y-24 lg:mx-0 lg:max-w-none md:grid-cols-12">
         <div class="md:col-span-7">
            <?php
            $content = get_field('content_clean', get_queried_object());
            $new_container = true;
            $output = '';
            $i = 0;
            foreach ($args as $key => $el) {
               $type = $el['type'];
               $val = $el['val'];
               if (str_contains($type, 'h')) {
                  $output .= '<' . $el['type'] . ' class="mt-4 sm:mt-12 mb-6 text-xl md:text-2xl xl:text-4xl font-bold tracking-tight text-gray-900">' . $el['val'] . '</' . $el['type'] . '>';
               }
               if (str_contains($type, 'p')) {
                  $output .= '<' . $el['type'] . ' class="mt-6">' . $el['val'] . '</' . $el['type'] . '>';
               }
            }
            echo $output;
            ?>
         </div>
         <div class="md:col-span-5 mt-16">
            <div class="grid grid-cols-1 w-full gap-y-8">
               <?php
               if (have_rows('images', get_queried_object())):
                  while (have_rows('images', get_queried_object())) : the_row(); ?>
                     <img class="h-[300px] w-full object-cover rounded ring-1 ring-gray-300 shadow-md" src="<?php echo get_sub_field('image')['url']; ?>" alt="">
               <?php
                  endwhile;
               endif;
               ?>

            </div>
         </div>
      </div>
   </div>