<?php global $paged; ?>

<section class="relative h-24 md:h-40 lg:h-52 overflow-hidden">
   <div class="absolute inset-0">
      <img
         class="w-full h-full object-cover object-center"
         src="<?php echo $args['image']; ?>"
         alt=""
         style="object-position: center 30%;">
      <div class="absolute inset-0 bg-black opacity-70"></div>
   </div>
   <div class="relative z-10 h-full flex items-center px-4 mx-auto max-w-7xl">
      <div class="">
         <h1 class="text-white text-2xl font-bold">Customizable &amp; unique</h1>
      </div>
   </div>
</section>



<div class="hidden bg-white px-6 py-16 lg:px-8">
   <div class="mx-auto max-w-2xl text-center">
      <?php $packages_query = paginated_post_query($paged); ?>

      <?php if (isset($packages_query) && isset($paged)) { ?>

         <p class="mt-6 text-lg leading-8">
            Page <?php echo $paged; ?> of <?php echo $packages_query->max_num_pages; ?>
         </p>

      <?php } ?>

      <h2 class="mt-2 text-secondary-500 font-[2rem] md:text-4xl stylized">Italy vacation packages</h2>

   </div>
</div>