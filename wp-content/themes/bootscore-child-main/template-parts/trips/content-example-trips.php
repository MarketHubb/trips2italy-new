<?php $content_array = get_field('feature_panels');
?>

<?php if (!empty($content_array['feature_panels'])) { ?>

   <?php //echo tw_get_section_open(); ?>
   <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
         <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">From the blog</h2>
         <p class="mt-2 text-lg leading-8 text-gray-600">Learn how to grow your business with our expert advice.</p>
      </div>
      <div class="mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">

         <?php foreach ($content_array['feature_panels'] as $content) { ?>
            <div>
               <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
                  <img src="<?php echo $content['image']['url']; ?>" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
                  <div class="filter-blur absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                  <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>

                  <h3 class="mt-3 text-lg lg:text-xl tracking-normal font-semibold leading-6 text-white">
                     <span class="absolute inset-0"></span>
                     <?php echo $content['heading']; ?>
                  </h3>
               </article>
               <p class="text-sm text-gray-600"><?php echo $content['description']; ?></p>
            </div>


         <?php } ?>

         <!-- More posts... -->
      </div>
   </div>
   </div>

<?php } ?>