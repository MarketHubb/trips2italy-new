<?php
if (get_the_ID() === 26613) {
   $id = 25780;
} else {
   $id = get_field('page_id', $post->ID);
}
?>
<section class="alternate py-16 md:py-24">
   <div class="container">

      <?php
      $heading_vals['heading'] = 'More people travel';
      $heading_vals['subheading'] = 'With Trips 2 Italy';
      $heading_vals['description'] = 'We know you have options when booking your trip. Find out what truly sets Trips2Italy apart from the rest.';

      // echo get_content_section_heading($heading_vals);

      ?>
      <div class="pb-10">
         <?php
         $section_heading = [
            'heading' => 'More couples honeymoon with',
            'subheading' => 'Trips 2 Italy'
         ];
         ?>
         <?php echo tw_section_heading($section_heading); ?>
      </div>


      <div class="row align-items-center lg:gap-y-10">

         <?php
         $trip_type_callouts = get_field('callouts', $post->ID)['callouts'];
         $e = 1;
         $content_alt = '';

         foreach ($trip_type_callouts as $trip_type_callout) {
            $card = array(
               'image_mobile' => $trip_type_callout['image'],
               'region' => $trip_type_callout['heading'],
               'callout' => $trip_type_callout['subheading'],
               'excerpt' => $trip_type_callout['description']
            );

            if ($e % 2 === 0) {
               $content_alt .= get_alternate_content($card, "right");
            } else {
               $content_alt .= get_alternate_content($card, "left");
            }
            $e++;
         }

         echo $content_alt;

         ?>


         <?php
         if (have_rows('cards', $id)) :
            $i = 1;
            $content = '';

            while (have_rows('cards', $id)) : the_row();
               $callout = array(
                  'image_mobile' => get_sub_field('background_image', $id),
                  'region' => get_sub_field('heading', $id),
                  'callout' => get_sub_field('subheading', $id),
                  'excerpt' => get_sub_field('description', $id),
               );

               if ($i % 2 === 0) {
                  $content .= get_alternate_content($callout, "right");
               } else {
                  $content .= get_alternate_content($callout, "left");
               }
               $i++;
            endwhile;
         //                echo $content;
         endif;
         ?>
      </div>
   </div>
</section>