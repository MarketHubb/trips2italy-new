<?php 
$hero = get_field('hero_new');
$bg_image = $hero['image']['url'];
$heading = $hero['heading'];
$subheading = $hero['subheading'];
 ?>
<section class="relative overflow-hidden h-[33vh] md:h-[40vh] lg:h-[55vh]">
  <div id="single-trip-cover" 
       class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-all duration-300 ease-in-out" 
       style="background-image: url(<?php echo $bg_image; ?>);">

  </div>
  <h1 class="absolute w-full top-[20%] sm:top-[15%] md:top-[20%] left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center px-4 font-normal md:font-thin text-blueGray text-2xl sm:text-3xl md:text-4xl lg:text-5xl">
    <?php echo $heading; ?> 
    <span class="text-orangeDark stylized font-thin block"><?php echo $subheading; ?></span>
  </h1>
</section>

