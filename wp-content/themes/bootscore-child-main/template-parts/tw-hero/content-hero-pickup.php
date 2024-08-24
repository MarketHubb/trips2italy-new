<?php 
$hero = get_field('hero_new');
$bg_image = $hero['image']['url'];
$mobile_bg_image = 'http://t2i-new.test/wp-content/uploads/2024/08/Honeymoon-Trip-Mobile.webp';

// Calculate aspect ratios (you may need to adjust these based on your actual image dimensions)
$desktop_aspect_ratio = 56.25; // Assuming 16:9 ratio (9 / 16 * 100)
$mobile_aspect_ratio = 177.78; // Assuming 16:9 ratio (16 / 9 * 100)
?>

<section class="relative overflow-hidden">
  <!-- BG Image Container -->
  <div class="absolute inset-0">
    <!-- Desktop Image -->
    <div class="hidden md:block relative w-full" style="padding-top: <?php echo $desktop_aspect_ratio; ?>%;">
      <div class="absolute inset-0 bg-center bg-no-repeat bg-cover" style="background-image: url(<?php echo $bg_image; ?>);"></div>
    </div>
    <!-- Mobile Image -->
    <div class="md:hidden relative w-full" style="padding-top: <?php echo $mobile_aspect_ratio; ?>%;">
      <div class="absolute inset-0 bg-center bg-no-repeat bg-cover" style="background-image: url(<?php echo $mobile_bg_image; ?>);"></div>
    </div>
    <!-- Filter -->
    <div class="absolute inset-0 bg-filter z-10"></div>
  </div>

  <!-- Content Container -->
  <div class="relative z-20 min-h-screen flex flex-col justify-end md:pb-6 lg:pb-28 px-4 sm:px-6 lg:px-8">
    <!-- Hero copy -->
    <div class="text-center mb-6 animate-fade-in-up text-white">
      <p class="font-heading text-2xl md:text-3xl lg:text-4xl mb-0">Custom, one-of-a-kind</p>
      <h1 class="text-orangeLight stylized font-thin block text-5xl lg:text-6xl">Honeymoons to Italy</h1>
      <p class="text-lg lg:text-2xl opacity-90">Celebrate your love in the most romantic place on earth</p>
    </div>
  </div>
</section>

<!-- Icons -->
<section class="hidden bg-[#0d0f11] pb-6">
  <div class="grid grid-cols-3 justify-center gap-x-6 text-white opacity-0 animate-on-scroll transition-opacity duration-500" id="icons">
    <?php
    if (have_rows('callout_icons', 'option')) :
      $icons = '';
      while (have_rows('callout_icons', 'option')) : the_row();
        $icons .= '<div class="mx-auto text-center w-full">';
        $icons .= '<div class="min-h-14 flex flex-col justify-center items-center overflow-hidden mb-2">';
        $icons .= '<img class="max-w-12 inline-block opacity-90" src="' . get_sub_field('icon') . '" />';
        $icons .= '</div>';
        $icons .= '<p class="text-xs mb-0 uppercase opacity-70 tracking-wide">' . get_sub_field('lead_in') . '</p>';
        $icons .= '<p class="text-lg text-orangeLight stylized">' . get_sub_field('callout') . '</p>';
        $icons .= '</div>';
      endwhile;
      echo $icons;
    endif;
    ?>
  </div>
</section>