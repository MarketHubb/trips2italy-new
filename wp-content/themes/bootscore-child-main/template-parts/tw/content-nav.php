<?php
$hide_nav = isset($args) && $args['hide_nav'] ? true : false;
$nav_fields = get_field('primary_nav', 'option');
?>

<?php if (!empty($nav_fields)) { ?>

   <header class="bg-brand-600 fixed top-0 left-0 right-0 w-full z-50 shadow-md" id="tw-nav-primary">
      <nav class="mx-auto flex max-w-7xl items-center justify-between !px-6 lg:px-8" aria-label="Global">
         <div class="flex lg:flex-1">
            <a href="<?php echo get_home_url(); ?>" class="-m-1.5 p-1.5 md:pt-0">
               <span class="sr-only">Trips 2 Italy</span>
               <img class="h-14 md:h-20 drop-shadow-[0_-5px_15px_rgba(255,255,255,1)]  w-auto absolute top-[5px] md:top-[13px]" src="<?php echo home_url() . '/wp-content/uploads/2023/01/Logo-No-Shadow.svg'; ?>" alt="">
            </a>
         </div>

         <?php if ($hide_nav) { ?>

            <div class="flex justify-center items-center sm:h-[63px]">
               <div class="py-3 sm:py-0">
                  <a class="text-sm sm:text-base text-white tracking-wide font-semibold" href="tel:+1-866-464-8259" title="" target="_self">(866) 464-8259</a>
               </div>
            </div>

         <?php } elseif (!$hide_nav) { ?>

            <div class="flex lg:hidden py-2 nav-mobile-btn">
               <button id="nav-mobile-open" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white">
                  <span class="sr-only">Open main menu</span>
                  <svg class="!h-6 !w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                  </svg>
               </button>
               <!-- <button id="nav-mobile-close" type="button" class="hidden rounded-md p-2.5 text-gray-700"> -->
               <button id="nav-mobile-close" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white hidden">
                  <span class="sr-only">Close menu</span>
                  <svg class="!h-6 !w-6" fill="none" viewbox="0 0 24 24" stroke-width="1.5" stroke="currentcolor" aria-hidden="true">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
               </button>
            </div>

            <div class="hidden lg:flex lg:justify-center lg:items-center pt-3 pb-2  lg:gap-x-12">

               <?php
               $nav_fields = get_field('primary_nav', 'option');
               $nav_array = [];

               $desktop_nav_links = '';
               $mobile_nav_links = '';

               foreach ($nav_fields as $nav_field) {
                  $desktop_active_class = get_nav_active_class(get_queried_object(), $nav_field['page']->ID, $nav_field['link_text']) ? ' drop-shadow-[0_-5px_15px_rgba(255,255,255,1)] opacity-100 ' : ' opacity-60 ';
                  $mobile_active_class = get_nav_active_class(get_queried_object(), $nav_field['page']->ID, $nav_field['link_text']) ? ' drop-shadow-[0_-5px_15px_rgba(255,255,255,1)] opacity-100 ' : ' opacity-60 ';
                  $href = get_permalink($nav_field['page']->ID);

                  $base_classes = 'group flex flex-col items-center text-sm font-semibold leading-6 text-white hover:opacity-100 ';
                  $desktop_nav_links .= '<a href="' . $href . '" class="' . $base_classes . $desktop_active_class . '">';
                  $desktop_nav_links .= '<img src="' . $nav_field['icon'] . '" class="max-h-[15px] relative mb-1 invert group-hover:opacity-100" />';
                  $desktop_nav_links .= $nav_field['link_text'] . '</a>';

                  $mobile_nav_links .= '<a href="' . $href . '" class="flex w-full items-center -mx-3 px-3 py-4 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 ' . $active_class . '">';
                  $mobile_nav_links .= '<img src="' . $nav_field['icon'] . '" class="max-w-[15px] h-auto opacity-20 relative inline-block mr-3" />';
                  $mobile_nav_links .= $nav_field['link_text'] . '</a>';
               }

               echo $desktop_nav_links;
               ?>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
               <a href="<?php echo get_permalink(28484); ?>" class="block sm:inline-block rounded-full bg-secondary-500 border border-transparent px-6 py-1 text-[.9rem] font-semibold text-white shadow-sm hover:bg-secondary-600 hover:border hover:border-secondary-600 hover:shadow-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary-500 tracking-normal hover:scale-105 ease-linear duration-150">Plan My Trip</a>
            </div>
      </nav>
      <!-- mobile menu, show/hide based on menu open state. -->
      <div class="hidden" role="dialog" aria-modal="true" id="mobile-nav-container">
         <!-- background backdrop, show/hide based on slide-over state. -->
         <!-- <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white !px-6 !pb-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"> -->
         <div class=" z-10 w-full overflow-y-auto bg-white !px-6 !pb-12 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10 shadow-2xl">
            <div class="flex items-center justify-between">

               <a href="<?php echo get_home_url(); ?>" class="-m-1.5 p-1.5">
                  <span class="sr-only">trips 2 italy</span>
                  <img class="h-14 w-auto absolute top-[5px]" src="<?php echo home_url() . '/wp-content/uploads/2023/01/Logo-No-Shadow.svg'; ?>" alt="">
               </a>
            </div>
            <div class="mt-12 flow-root">
               <div class="-my-6">
                  <div class=" divide-y divide-brand-500/10 !py-6">
                     <?php echo $mobile_nav_links; ?>
                  </div>
                  <div class="!py-6 !border-t-transparent">
                     <a href="<?php echo get_permalink(28484); ?>" class="<?php echo tw_cta_btn_base_classes(); ?> !text-center">Plan My Trip</a>
                  </div>
               </div>
            </div>
         </div>
      </div>

   <?php } ?>

   </header>
<?php } ?>