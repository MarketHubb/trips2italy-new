<?php echo tw_section_open(); ?>
<div class="max-w-7xl mx-auto">
   <div class="pb-10">
      <?php echo tw_heading(get_the_id(), 'testimonials_heading'); ?>
   </div>
</div>

<?php
$scroller_args = [];
$content_fields = get_field('postcards');

foreach ($content_fields as $field) {
   $scroller_args[] = [
      'image' => get_field('image', $field['postcard']->ID)['url'],
      'description' => get_field('postcard_copy', $field['postcard']->ID),
      'author' => get_field('names', $field['postcard']->ID),
      'cities' => get_field('cities', $field['postcard']->ID),
      'regions' => get_field('regions', $field['postcard']->ID),
      'trip_type' => get_field('trip_type', $field['postcard']->ID)
   ];
}

get_template_part('template-parts/shared/content', 'scroller', $scroller_args);
?>

<div class="max-w-7xl mx-auto">
   <div class="mt-16 flex justify-center">
      <p class="relative text-base rounded-full px-4 py-1.5 leading-6 text-gray-600 ring-1 ring-inset ring-gray-900/10 hover:ring-gray-900/20">
         <span class="hidden md:inline">Over <span class="font-bold"><?php echo wp_count_posts('postcards')->publish; ?></span> wonderful clients have hand-written us thank you notes.</span>
         <a href="<?php echo get_permalink(30385); ?>" class="text-base font-semibold text-brand-500"><span class="absolute inset-0" aria-hidden="true"></span> View all postcards <span aria-hidden="true">&rarr;</span></a>
      </p>
   </div>
</div>


</section>