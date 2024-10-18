<?php if (!isset($args) || empty($args)) return; ?>

<?php
$post_id = !empty($args['post_id']) ? $args['post_id'] : null;
$field_name = !empty($args['content']['field_name']) ? $args['content']['field_name'] : null;
$fields = $post_id && $field_name ? get_field($field_name, $post_id) : null;
$fields = $fields ? $fields : get_field($field_name, 'option');

if (!empty($fields)):

   $image = !empty($fields['image']['url']) ? $fields['image']['url'] : null;
   $mobile_image = !empty($fields['mobile_image']['url']) ? $fields['mobile_image']['url'] : $image;
?>

   <section class="px-6 lg:px-0 py-16 md:py-24 relative  bg-center bg-cover">

      <?php if ($image): ?>
         <div class="absolute h-full w-full inset-0 bg-cover bg-no-repeat bg-center hidden sm:block" style="background-image: url(<?php echo $image; ?>);"></div>
      <?php endif ?>

      <?php if ($mobile_image): ?>
         <div class="absolute h-full w-full inset-0 bg-cover bg-center md:hidden" style="background-image: url(<?php echo $mobile_image; ?>);"></div>
      <?php endif ?>

      <div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8 relative z-20">
         <div class="mx-auto max-w-2xl text-center text-2xl sm:text-3xl md:text-4xl">

            <?php if (!empty($fields['heading'])): ?>
               <h2 class="font-semibold antialiased tracking-tight text-white mb-2">
                  <?php echo $fields['heading']; ?>
               </h2>
            <?php endif ?>

            <?php if (!empty($fields['callout'])): ?>
               <h2 class="stylized font-bold text-[180%] text-secondary-500">
                  <?php echo $fields['callout']; ?>
               </h2>
            <?php endif ?>

            <?php if (!empty($fields['description'])): ?>
               <p class="mx-auto mt-6 max-w-xl text-lg md:text-xl leading-normal md:leading-8 font-semibold text-white">
                  <?php echo $fields['description']; ?>
               </p>
            <?php endif ?>

            <?php if (!empty($fields['content'])): ?>
               <div class="mt-10 flex items-center justify-center gap-x-6">
                  <?php echo $fields['content']; ?>
               </div>
            <?php endif ?>

         </div>
      </div>

      <svg viewBox="0 0 1024 1024" class="hidden absolute left-1/2 bottom-[92%] z-10 h-[64rem] w-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]" aria-hidden="true">
         <circle cx="512" cy="512" r="512" fill="url(#8d958450-c69f-4251-94bc-4e091a323369)" fill-opacity="0.7" />
         <defs>
            <radialGradient id="8d958450-c69f-4251-94bc-4e091a323369">
               <stop stop-color="#0B2846" />
               <stop offset="1" stop-color="#0C2F52" />
            </radialGradient>
         </defs>
      </svg>

   </section>



<?php endif ?>