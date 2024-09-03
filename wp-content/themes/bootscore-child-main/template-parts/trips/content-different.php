<?php echo tw_section_open(); ?>
<div class="mx-auto container px-6 lg:px-8">
   <div class="mx-auto grid max-w-2xl grid-cols-1 lg:gap-x-8 gap-y-4 lg:gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-12 lg:justify-end">
      <div class="pb-10 text-center lg:col-span-6">
         <?php echo tw_heading(get_the_ID(), 'why', 'text-left'); ?>
         <img src="<?php echo get_home_url() . '/wp-content/uploads/2024/08/Included-Sq-1.webp'; ?>" class="aspect-video w-full rounded-md shadow-md bg-gray-50 object-cover lg:aspect-auto lg:h-[34.5rem]" alt="">
      </div>
      <dl class="lg:col-span-6 grid grid-cols-1 gap-x-8 gap-y-6 text-base leading-7 text-gray-600 lg:items-end lg:h-fit lg:mt-auto lg:pb-10">
         <?php
         $content_array = get_field('why_global_options', get_the_ID()) ? get_field('why_us', 'option') : get_field('why_us', get_the_ID());

         if (!empty($content_array)) {
            $why_us = '';
            $i = 1;
            foreach ($content_array as $content_item) {
               $bg_color_class = $i === 2 ? ' bg-orange-100 ' : '';
               $why_us .= '<div class="relative pl-9 py-6' . $bg_color_class . '">';
               $why_us .= '<dt class="font-semibold text-gray-900 lg:text-xl">';
               $why_us .= '<svg class="hidden absolute left-0 top-1 h-5 w-5 text-secondary-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>';
               $why_us .= '<span class="font-heading text-brand-700 block">' . $content_item['callout'] . '</span>';
               $why_us .= '<span class="stylized inline text-2xl lg:text-3xl  text-secondary-500">' . $content_item['heading'] . '</span>';
               $why_us .= '<dd class=" mt-5 text-gray-600">' . $content_item['description'] . '</dd>';
               $why_us .= '</dt>';
               $why_us .= '</div>';
               $i++;
            }

            echo $why_us;
         }
         ?>
      </dl>
   </div>
</div>
</section>