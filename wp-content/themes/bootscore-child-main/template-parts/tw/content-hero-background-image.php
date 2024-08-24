<?php
$hero = location_hero_and_tab_inputs($args)['hero'];
highlight_string("<?php\n\$hero  =\n" . var_export($hero , true) . ";\n?>");
$bg_image = get_field('featured_image', $args);

?>
<div class="tw-bg-gray-900">
   <div class="tw-relative tw-isolate tw-overflow-hidden tw-pt-14">
      <img src="<?php echo $bg_image['url']; ?>" alt="" class="tw-absolute tw-inset-0 tw--z-10 tw-h-full tw-w-full tw-object-cover">
      <!-- <div class="tw-absolute tw-inset-x-0 tw--top-40 tw--z-10 tw-transform-gpu tw-overflow-hidden tw-blur-3xl sm:tw--top-80" aria-hidden="true"> -->
      <div class="tw-absolute tw-inset-x-0 tw-top-0 tw-bottom-0 tw--z-10 tw-overflow-hidden" aria-hidden="true">
      <!-- <div class="tw-absolute tw-inset-x-0 tw-top-0 tw-bottom-0 tw--z-10 tw-overflow-hidden tw-bg-gradient-to-r tw-from-primary tw-from-15% tw-via-primaryLight-500 tw-via-30% tw-to-transparent tw-to-40%" aria-hidden="true"> -->
         <div class="tw-hidden tw-relative tw-left-[calc(50%-11rem)] tw-aspect-[1155/678] tw-w-[36.125rem] tw--translate-x-1/2 tw-rotate-[30deg] tw-bg-gradient-to-tr tw-from-[#ff80b5] tw-to-[#9089fc] tw-opacity-20 sm:tw-left-[calc(50%-30rem)] sm:tw-w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
      <!-- <div class="tw-mx-auto tw-max-w-2xl tw-py-32 sm:tw-py-48 lg:tw-py-56"> -->
      <div class="tw-container tw-mx-auto tw-py-32 sm:tw-py-48 lg:tw-py-56">
         <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 sm:tw-gap-x-8">
            <div class="tw-px-6 tw-py-4 tw-bg-primary tw-rounded-lg tw-shadow-lg tw-bg-opacity-80">
               <div class="tw-hidden sm:tw-mb-8 sm:tw-flex ">
                  <!-- <div class="tw-relative tw-rounded-full tw-bg-black tw-bg-opacity-40 tw-px-3 tw-pt-1.5 tw-pb-1 tw-text-base tw-leading-6 tw-text-white tw-font-semibold tw-tracking-tight tw-ring-1 tw-ring-white/20 hover:tw-ring-white/20" id="breadcrumbs"> -->
                  <div class="tw-relative tw-pt-1.5 tw-pb-1 tw-text-base tw-leading-6 tw-text-white tw-font-semibold tw-tracking-tight" id="breadcrumbs">
                     <?php
                     if ($hero['breadcrumbs']) {
                        $breadcrumbs = '';
                        foreach ($hero['breadcrumbs'] as $breadcrumb) {
                           $breadcrumbs .= '<p class="tw-text-base tw-text-white d-inline-flex align-items-center tw-px-3 mb-0 first:tw-pl-0  ">';
                           $breadcrumbs .= '<a href="' . $breadcrumb['link'] . '" class="tw-text-white hover:tw-text-indigo-400 hover:tw-underline tw-font-semibold d-inline-flex align-items-center fs-6">';

                           if ($breadcrumb['icon']) {
                              $breadcrumbs .= '<img src="' . $breadcrumb['icon'] . '" class="breadcrumb-icon tw-mr-2 tw-mb-0 tw-opacity-90"/>';
                           }

                           $breadcrumbs .= $breadcrumb['text'];
                           $breadcrumbs .= '</a></p><span class="align-text-bottom breadcrumb-divider">&#x2215;</span>';
                        }

                        $breadcrumbs .= '';
                     }

                     if ($breadcrumbs) {
                        echo $breadcrumbs;
                     }
                     ?>
                  </div>
               </div>
               <div class="">
                  <h1 class="tw-text-4xl tw-font-bold tw-tracking-tight tw-text-white sm:tw-text-6xl">Data to enrich your online business</h1>
                  <p class="tw-mt-6 tw-text-lg tw-leading-8 tw-text-gray-300">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p>
                  <div class="tw-mt-10 tw-flex tw-items-center tw-justify-center tw-gap-x-6">
                     <a href="#" class="tw-rounded-md tw-bg-indigo-500 tw-px-3.5 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-shadow-sm hover:tw-bg-indigo-400 focus-visible:tw-outline focus-visible:tw-outline-2 focus-visible:tw-outline-offset-2 focus-visible:tw-outline-indigo-400">Get started</a>
                     <a href="#" class="tw-text-sm tw-font-semibold tw-leading-6 tw-text-white">Learn more <span aria-hidden="true">→</span></a>
                  </div>
               </div>
            </div>
            <div class="tw-hidden">
               <img class="tw-w-full tw-h-auto tw-rounded tw-shadow-lg" src="<?php echo $bg_image['url']; ?>" alt="">
            </div>
         </div>
         <div class="tw-absolute tw-inset-x-0 tw-top-[calc(100%-13rem)] tw--z-10 tw-transform-gpu tw-overflow-hidden tw-blur-3xl sm:tw-top-[calc(100%-30rem)]" aria-hidden="true">
            <div class="tw-relative tw-left-[calc(50%+3rem)] tw-aspect-[1155/678] tw-w-[36.125rem] tw--translate-x-1/2 tw-bg-gradient-to-tr tw-from-[#ff80b5] tw-to-[#9089fc] tw-opacity-20 sm:tw-left-[calc(50%+36rem)] sm:tw-w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
         </div>
      </div>
   </div>
</div>