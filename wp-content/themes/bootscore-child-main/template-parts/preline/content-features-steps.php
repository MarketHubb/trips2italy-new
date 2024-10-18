<!-- Approach -->
<?php if (empty($args)) return; ?>

<?php
$section_open = tw_output_section_open($args['section']);
if ($section_open) echo $section_open;
?>

<!-- Approach -->
<div class="max-w-7xl px-4 xl:px-0 mx-auto">
   <!-- Title -->
   <div class="max-w-3xl">
      <?php
      $section_heading = tw_output_heading($args);
      if ($section_heading) echo $section_heading;
      ?>

   </div>
   <!-- End Title -->

   <!-- Grid -->
   <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 lg:items-center">
      <div class="aspect-w-16 aspect-h-9 lg:aspect-none">
         <img class="w-full object-cover rounded-xl" src="<?php echo get_home_url() . '/wp-content/uploads/2024/08/Included-Sq-1.webp'; ?>" alt="Features Image">
      </div>
      <!-- End Col -->

      <!-- Timeline -->
      <div>
         <!-- Heading -->
         <div class="mb-4">
            <h3 class="text-brand-500 text-xs font-bold font-base uppercase">
               We make it easy
            </h3>
         </div>
         <!-- End Heading -->

         <?php 
         $content_fields = tw_get_template_content($args); 
         $i = 1;
         if (!empty($content_fields)) {
            foreach ($content_fields as $field) {
         ?>

               <!-- Item -->
               <div class="flex gap-x-5 ms-1">
                  <!-- Icon -->
                  <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-brand-500">
                     <div class="relative z-10 size-8 flex justify-center items-center">
                        <span class="flex shrink-0 justify-center items-center size-8 border border-brand-500 text-brand-500 font-semibold text-xs uppercase rounded-full">
                           <?php echo $i; ?>
                        </span>
                     </div>
                  </div>
                  <!-- End Icon -->

                  <!-- Right Content -->
                  <div class="grow pt-0.5 pb-8 sm:pb-12">
                     <p class="text-base lg:text-lg text-neutral-400">


                        <?php if ($field['callout']): ?>
                           <span class="text-brand-700 font-bold">
                              <?php echo $field['callout']; ?>
                           </span>
                        <?php endif; ?>

                        <?php if ($field['heading']): ?>
                           <span class="text-brand-700 font-semibold antialiased">
                              <?php echo $field['heading']; ?>
                           </span>
                        <?php endif; ?>

                        <?php if ($field['description']): ?>
                           <span class="text-gray-600 font-medium block text-base">
                              <?php echo $field['description']; ?>
                           </span>
                        <?php endif; ?>

                     </p>
                  </div>
                  <!-- End Right Content -->
               </div>

               <?php $i++ ?>
            <?php } ?>
         <?php } ?>

         <a class="group inline-flex items-center gap-x-2 py-2 px-3 bg-secondary-500 font-semibold text-base text-white rounded-full focus:outline-none hover:bg-secondary-400" href="<?php echo get_form_link(); ?>">
            <img src="<?php echo get_home_url() . '/wp-content/uploads/2024/07/Travel-Details-1.svg'; ?>" class="shrink-0 size-6 inline" />
            Get started today
         </a>
      </div>
      <!-- End Timeline -->
   </div>
   <!-- End Grid -->
</div>
</div>
<!-- End Approach -->