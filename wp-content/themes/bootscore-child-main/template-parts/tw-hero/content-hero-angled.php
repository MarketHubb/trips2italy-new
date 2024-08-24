<div class="bg-white">
   <div class="relative">
      <div class="mx-auto max-w-7xl">
         <div class="relative z-10 pt-14 lg:w-full lg:max-w-2xl">
            <svg class="absolute inset-y-0 right-8 hidden h-full w-80 translate-x-1/2 transform fill-white lg:block" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
               <polygon points="0,0 90,0 50,100 0,100" />
            </svg>

            <div class="relative px-6 py-32 sm:py-40 lg:px-8 lg:pb-56 lg:pt-16 lg:pr-0">
               <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
                  <div class="hidden sm:mb-10 sm:flex">
                     <!-- Callout -->
                     <div class="hidden relative rounded-full px-3 py-1 text-sm leading-6 text-gray-500 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                        Anim aute id magna aliqua ad ad non deserunt sunt. <a href="#" class="whitespace-nowrap font-semibold text-indigo-600"><span class="absolute inset-0" aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
                     </div>
                  </div>
                  <?php
                  $terms = [];
                  $terms[] = get_the_terms($post->ID, 'topic');
                  $terms[] = get_the_terms($post->ID, 'region');

                  $t = '';
                  foreach ($terms[0] as $term) {
                     // $t .= '<span class="badge rounded-pill badge-info hero-badge me-3">' . $term->name .  '</span>';
                     $t .= '<span class="inline-flex items-center rounded-full bg-[rgba(25,124,204,.1)] px-2 py-1 text-xs font-medium text-brand ring-1 ring-inset ring-brand/10 relative bottom-8">' . $term->name . '</span>';
                  }

                  echo $t;

                  ?>

                  <h1 class="text-xl lg:text-3xl font-bold tracking-tight text-blueGray">
                     <?php
                     $title_raw = get_the_title(get_the_ID());
                     $title_array = explode("|", $title_raw);
                     ?>
                     <?php if (count($title_array) === 2) { ?>
                        <h2 class="<?php echo tw_heading_classes(); ?>">
                           <?php echo trim($title_array[1]); ?>
                        </h2>
                        <h1 class="<?php echo tw_callout_classes(); ?>">
                           <?php echo trim($title_array[0]); ?>
                        </h1>
                     <?php } else { ?>

                     <?php } ?>
                  </h1>
                  <?php
                  $price_callout = 'Starting at ' . get_field('price', $post->ID);
                  $package_description = get_field('description', get_the_id());
                  $package_description_split = splitParagraph($package_description);
                  $hero_description = isset($package_description_split) && !empty($package_description_split['0']) && !empty($package_description_split['1']) ? $package_description_split[0] : $price_callout;
                  ?>
                  <p class="mt-6 text-lg leading-8 text-gray-600">
                     <?php echo $hero_description; ?>
                  </p>
                  <div class="mt-10 flex items-center gap-x-6">

                     <?php
                     $btn_args = [
                        'copy' => 'Get Your Custom Itinerary',
                        'attributes' => 'data-target="form" data-type="Form" ',
                        'callout' => 'Use this package as starting point for a custom itinerary'
                     ];
                     echo tw_cta_btn($btn_args);
                     ?>

                     <a href="#" class="hidden text-sm font-semibold leading-6 text-gray-900">Learn more <span aria-hidden="true">→</span></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
         <?php $bg_image = get_field('featured_image', get_the_id()); ?>
         <img class="aspect-[3/2] object-cover lg:aspect-auto lg:h-full lg:w-full" src="<?php echo $bg_image['url']; ?>" alt="">
      </div>
   </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 justify-center">
   <div class="grid grid-cols-1 lg:grid-cols-12 lg:col-span-10 lg:col-start-2 rounded-lg bg-gradient-to-l from-blueDark to-blueLight ring-2 ring-white shadow-lg p-10 relative bottom-12 lg:gap-x-24 items-center z-10">
      <div class="col-span-7">
         <h2 class="tracking-normal text-lg md:text-2xl lg:text-3xl text-white mb-5">
            Package Description:
         </h2>
         <p class="text-base lg:text-lg text-white">
            <?php echo $package_description_split[1]; ?>
         </p>
      </div>
      <div class="col-span-5 text-center text-white">
         <h5 class="font-bold text-base lg:text-xl text-white mb-2">Starting at:</h5>
         <h5 class="font-bold text-lg lg:text-2xl text-white mb-6">
            <?php echo get_field('price', get_the_id()); ?>
         </h5>
         <?php
         $price_cta_args = [
            'copy' => 'Talk to Us'
         ];
         echo tw_form_cta_btn($price_cta_args); ?>
      </div>
   </div>
   <div class="absolute inset-x-0 -top-16 -z-10 flex transform-gpu justify-center overflow-hidden blur-3xl" aria-hidden="true">
      <div class="aspect-[1318/752] w-[82.375rem] flex-none bg-gradient-to-r from-[#80caff] to-[#4f46e5] opacity-25" style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)"></div>
   </div>
</div>