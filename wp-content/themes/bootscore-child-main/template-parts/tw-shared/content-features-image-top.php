<?php if (empty($args)) return; ?>

<?php
$section_open = tw_output_section_open($args);
if ($section_open) echo $section_open;
?>

<?php echo tw_container_open(); ?>

<?php
$section_heading = tw_output_heading($args);
if ($section_heading) echo $section_heading;
?>


<?php $content_fields = tw_get_template_content($args); ?>

<?php if (!empty($content_fields) && !empty($content_fields[0]['image'])): ?>

   <div class="relative overflow-hidden">
      <div class="mx-auto max-w-7xl lg:px-8" id="example-trips-img-main">
         <img src="<?php echo $content_fields[0]['image']; ?>" alt="App screenshot" class="mb-[-12%] rounded-xl object-cover object-center shadow-2xl aspect-[12/7] ring-1 ring-gray-900/10" width="2432" height="1442">
         <div class="relative" aria-hidden="true">
            <div class="absolute -inset-x-20 bottom-0 bg-gradient-to-t from-white pt-[7%]"></div>
         </div>
      </div>
   </div>

   <?php
   $nav .= '<ul role="list" class="flex flex-col h-full justify-center" id="example-trips-nav">';
   $content = '';
   $i = 1;

   foreach ($content_fields as $content_field):
      $id = strtolower(str_replace(' ', '_', $content_field['heading']));
      $active_nav = $i === 1 ? '' : ' opacity-50 ';
      $active_content = $i === 1 ? ' inline-flex ' : ' hidden ';

      $nav .= '<li class="flex-grow flex py-1 sm:py-4 relative items-center ' . $active_nav . ' hover:opacity-100 hover:cursor-pointer" data-img="' . $content_field['image'] . '" data-type="' . $id . '">';
      $nav .= '<h3 class="text-sm sm:text-lg md:text-xl lg:text-2xl pl-2 sm:pl-5 inline-block font-semibold">';

      if (isset($content_field['icon'])) {
         $nav .= '<img src="' . $content_field['icon'] . '" class="inline-block relative right-3  h-4 sm:h-6 w-4 sm:w-6 text-secondary-600" />';
      }

      $nav .= $content_field['heading'] . '</h3></li>';

      $content .= '<div class="w-full h-full inline-flex items-center opacity-0" data-container="' . $id . '">';
      $content .= '<p class="text-base sm:text-lg md:text-xl md:leading-relaxed">';
      $content .= $content_field['description'] . '</p></div>';

      $i++;
   endforeach;

   ?>

   <div class="mx-auto my-8 max-w-7xl px-6 sm:mt-20 md:mt-24 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3">
         <div id="example-trips-nav">
            <?php echo $nav; ?>
         </div>
         <div class="md:col-span-2 py-8" id="example-trips-content">
            <?php echo $content; ?>
         </div>
      </div>
   </div>


   </div>

<?php endif; ?>


<?php if (!empty($args['cta'])): ?>

   <div class="max-w-3xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto text-center">
      <?php
      $cta_btn = tw_get_template_cta_btn($args);
      if ($cta_btn) echo $cta_btn;
      ?>
   </div>

<?php endif ?>

<!-- </div> -->
</section>