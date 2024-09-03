<section class="overflow-hidden py-16 md:py-24 px-4 md:px-6 bg-cover bg-center" style="background-image:url(<?php echo get_home_url(); ?>/wp-content/uploads/2023/01/AdobeStock_141760356-copy-scaled.jpg);">
   <div class="container mx-auto">
      <div class="">
         <div class="pb-10">
            <?php echo tw_heading(get_the_ID(), 'how', null); ?>
         </div>
      </div>

      <div class="ol grid grid-cols-1 lg:grid-cols-3 mb-0 mb-md-5 gap-y-8 lg:gap-y-0 lg:gap-x-8">

         <?php
         $content_array = get_field('how_global_options', get_the_ID()) ? get_field('how', 'option') : get_field('how_content', get_the_ID());

         if (!empty($content_array)) {
            $how = '';
            $i = 1;
            foreach ($content_array as $content_item) {
               $callout = !empty($content_item['heading_2']) ? $content_item['heading_2'] : $content_item['callout'];
               $descripion = !empty($content_item['callouts']) ? $content_item['callouts'] : $content_item['description'];
               $how .= '<div class="w-full h-full rounded-md shadow bg-white">';
               $how .= '<img class="min-h-[200px] w-full max-w-full h-auto rounded-t-md" src="' . $content_item['image']['url'] . '">';
               $how .= '<div class="relative overflow-hidden h-[80px] -mt-[40px]">';
               $how .= '<div class="absolute z-10 w-full top-0">';
               $how .= '<svg class="waves waves-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                            <defs>
                                <path id="card-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                            </defs>
                            <g class="moving-waves">
                                <use xlink:href="#card-wave" x="48" y="-1" fill="rgba(255,255,255,0.30"></use>
                                <use xlink:href="#card-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                                <use xlink:href="#card-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                                <use xlink:href="#card-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                                <use xlink:href="#card-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                                <use xlink:href="#card-wave" x="48" y="16" fill="rgba(255,255,255,0.99)"></use>
                            </g>
                        </svg>';
               $how .= '</div>';
               $how .= '</div>';
               $how .= '<div class="flex flex-col flex-auto px-8 pb-8">';
               $how .= '<h3 class="stylized text-secondary-400 text-xl md:text-2xl mb-1 pl-4">' . $callout . '</h3>';
               $how .= '<h3 class="font-heading text-lg md:text-xl font-semibold antialiased text-brand-700 tracking-normal mb-4">';
               $how .= $i . '. ' .  $content_item['heading'] . '</h3>';
               $how .= '<p>' . $descripion . '</p>';
               $how .= '</div></div>';
               $i++;
            }

            echo $how;
         }

         ?>
         <!-- Use the post-specific fields if populated -->
         <?php if (get_field('how_content')) { ?>


            <?php if (have_rows('how_content')) :
               $callouts = '';
               while (have_rows('how_content')) : the_row();
                  // $callouts .= '<div class="col-md-4 mb-5 mb-md-0">';
                  $callouts .= '<div class="w-full mb-6 lg:mb-0">';
                  $callouts .= '<div class="card h-100">';
                  $callouts .= '<img class="card-img-top" src="' . get_sub_field('image')['url'] . '" style="min-height: 150px;">';
                  $callouts .= '<div class="position-relative overflow-hidden" style="height:90px;margin-top:-40px;">';
                  $callouts .= '<div class="position-absolute w-100 top-0 z-index-1">
                        <svg class="waves waves-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                            <defs>
                                <path id="card-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                            </defs>
                            <g class="moving-waves">
                                <use xlink:href="#card-wave" x="48" y="-1" fill="rgba(255,255,255,0.30"></use>
                                <use xlink:href="#card-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                                <use xlink:href="#card-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                                <use xlink:href="#card-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                                <use xlink:href="#card-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                                <use xlink:href="#card-wave" x="48" y="16" fill="rgba(255,255,255,0.99)"></use>
                            </g>
                        </svg>
                    </div>';
                  $callouts .= '</div>';
                  $callouts .= '<div class="card-body pt-0 pb-12 lg:px-16">';

                  $heading = str_replace("{", '<span class="stylized text-brand-500">', get_sub_field('heading'));
                  $heading = str_replace("}", '</span>', $heading);

                  $callouts .= '<p class="text-base lg:text-xl tracking-normal text-gray-900 font-semibold mb-4">' . $heading . '</p>';
                  $callouts .= '<div class="callouts-container">';
                  $callouts .= get_sub_field('callouts');
                  $callouts .= '</div></div></div></div>';
               endwhile;
               // echo $callouts;
            endif;
            ?>

         <?php } else { ?>

            <!-- Use the global fields as fallback -->
            <?php if (have_rows('how_it_works', 'option')) : ?>
               <?php while (have_rows('how_it_works', 'option')) : the_row(); ?>

                  <div class="col-12 col-md-4">
                     <div class="card">
                        <img class="card-img-top" src="<?php echo get_sub_field('image', 'option'); ?>">
                        <div class="position-relative overflow-hidden" style="height:70px;margin-top:-40px;">
                           <div class="position-absolute w-100 top-0 z-index-1">
                              <svg class="waves waves-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                                 <defs>
                                    <path id="card-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                                 </defs>
                                 <g class="moving-waves">
                                    <use xlink:href="#card-wave" x="48" y="-1" fill="rgba(255,255,255,0.30"></use>
                                    <use xlink:href="#card-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                                    <use xlink:href="#card-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                                    <use xlink:href="#card-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                                    <use xlink:href="#card-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                                    <use xlink:href="#card-wave" x="48" y="16" fill="rgba(255,255,255,0.99)"></use>
                                 </g>
                              </svg>
                           </div>
                        </div>
                        <div class="card-body">
                           <h4 class="fw-bolder mb-1"><?php echo get_sub_field('heading', 'option') ?></h4>
                           <span class="text-primary stylized"><?php echo get_sub_field('description', 'option') ?></span>
                           <?php
                           if (get_sub_field('list_items', 'option')) {
                              $list = explode("\n", get_sub_field('list_items', 'option'));
                              $list = array_map('trim', $list);
                              if (is_array($list)) {
                                 echo '<ul class="list-group list-group-flush flush ps-0 ms-0">';
                                 foreach ($list as $item) {
                                    echo '<li class="list-group-item ps-0 py-3"><p class="mb-0">' . $item . '</p></li>';
                                 }
                              }
                              echo  '</ul>';
                           }

                           ?>

                        </div>
                     </div>
                  </div>

               <?php endwhile; ?>
            <?php endif; ?>

         <?php } ?>

      </div>
   </div>
</section>