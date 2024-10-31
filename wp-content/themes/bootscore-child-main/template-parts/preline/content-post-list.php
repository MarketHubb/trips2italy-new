<?php if (empty($args)) return; ?>

<?php
$section_classes = !empty($args['section_classes']) ? $args['section_classes'] : null;
$section_image = !empty($args['section_image']) ? $args['section_image'] : null;
$section_mobile_image = !empty($args['section_mobile_image']) ? $args['section_mobile_image'] : null;
$section_overlay_classes = !empty($args['section_overlay_classes']) ? $args['section_overlay_classes'] : null;

$section_args = [
   'grid_classes' => $section_classes,
   'image' => $section_image,
   'mobile_image' => $section_mobile_image,
   'overlay_classes' => $section_overlay_classes
];
echo tw_output_section_open($args);
?>

<?php //echo tw_section_open(); 
?>

<?php echo tw_container_open(); ?>

<!-- Card Blog -->
<!-- <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto"> -->

<!-- Title -->
<?php
$section_heading = tw_output_heading($args);
if ($section_heading) echo $section_heading;
?>
<!-- End Title -->

<?php if (!empty($args['content'])): ?>

   <!-- Grid -->
   <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8 relative z-30">

      <!-- Card -->
      <?php foreach ($args['content']['fields'] as $content): ?>

         <?php echo $card['heading']; ?>

         <a class="group bg-gray-50 shadow-xl shadow-gray-600 ring-2 ring-brand-100 hover:bg-gray-100 focus:outline-none focus:bg-white rounded-xl transition" href="<?php echo $content['link']; ?>">
            <div class="aspect-w-16 aspect-h-10 h-56 overflow-hidden rounded-t-xl">
               <img class="w-full h-full object-cover object-center rounded-t-xl transition-transform duration-300 ease-in-out group-hover:opacity-90 group-hover:scale-105" src="<?php echo $content['image']; ?>" alt="Blog Image">
            </div>
            <div class="p-5">
               <h3 class="mt-5 text-xl text-brand-700 group-hover:text-brand-500 ">
                  <?php echo $content['heading']; ?>
               </h3>
               <p class="my-3 items-center gap-x-1 line-clamp-3 text-base font-semibold text-gray-600 group-hover:text-gray-800">
                  <?php echo $content['description']; ?>
                  <svg class="shrink-0 size-4 transition ease-in-out group-hover:translate-x-1 group-focus:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                     <path d="m9 18 6-6-6-6" />
                  </svg>
               </p>
            </div>
         </a>

      <?php endforeach ?>
      <!-- End Card -->

   <?php endif ?>
   </div>
   <!-- End Grid -->

   </div>

   </section>