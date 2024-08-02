   <style>
      @keyframes fadeInUp {
         from {
            opacity: 0;
            transform: translateY(20px);
         }

         to {
            opacity: 1;
            transform: translateY(0);
         }
      }

      .animate-fade-in-up {
         animation: fadeInUp 1s ease-out forwards;
      }
   </style>

   <section class="scroll-auto h-screen relative bg-scroll overflow-hidden">
      <!-- Copy container -->
      <div class="bg-scroll h-screen relative z-30 top-auto bottom-0 left-0 right-0">
         <!-- Content Wrapper -->
         <div class="relative h-full z-10 flex-grow flex flex-col justify-end px-4 sm:px-6 lg:px-8">
            <!-- Hero copy -->
            <div class="text-center mb-6 animate-fade-in-up text-white">
               <p class="font-heading text-2xl mb-0">Custom, one-of-a-kind</p>
               <h1 class="text-orangeLight stylized font-thin block text-5xl">Honeymoons to Italy</h1>
               <p class="text-lg opacity-90">Celebrate your love in the most romantic place on earth</p>
            </div>

         </div>
      </div>
      <!-- BG Image -->
      <div class="bg-scroll z-10 absolute top-0 inset-0 ">
         <!-- Filter -->
         <div class="z-20 absolute inset-0 bg-filter">
         </div>
         <!-- Image -->
         <div class="z-10 bg-center bg-no-repeat bg-cover  absolute inset-0 bg-scroll" style="background-image: url(http://t2i-new.test/wp-content/uploads/2024/08/Honeymoon-Trip-Mobile.webp);">
         </div>

      </div>
   </section>
   <!-- Icons -->
   <section class="bg-[#0d0f11]">
      <div class="grid grid-cols-3 justify-center animate-fade-in-up gap-x-6 text-white">
         <?php
         if (have_rows('callout_icons', 'option')) :
            $icons = '';
            while (have_rows('callout_icons', 'option')) : the_row();
               $icons .= '<div class="mx-auto text-center w-full">';
               $icons .= '<div class="min-h-14 flex flex-col justify-center items-center overflow-hidden mb-2">';
               $icons .= '<img class="max-w-12 inline-block" src="' . get_sub_field('icon') . '" />';
               $icons .= '</div>';
               $icons .= '<p class="text-xs mb-0 uppercase opacity-80 tracking-wide">' . get_sub_field('lead_in') . '</p>';
               $icons .= '<p class="text-sm">' . get_sub_field('callout') . '</p>';
               $icons .= '</div>';
            endwhile;
            echo $icons;
         endif;
         ?>
      </div>
   </section>