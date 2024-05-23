<section class="pt-md-4 pb-5 position-relative">
   <div class="container">
      <div class="row">
         <div class="col-lg-9">
            <h4>
               Your trip itinerary
            </h4>
            <hr class="horizontal dark mb-4">

            <?php if (have_rows('itinerary')) : ?>
               <?php while (have_rows('itinerary')) : the_row(); ?>

                  <div class="row">
                     <div class="col-sm-2 col-3">
                        <img class="img w-100 border-radius-lg shadow-lg" src="../assets/img/podcast/episode-1.jpeg" alt="curved11">
                     </div>
                     <div class="col-sm-10 col-9 my-auto">
                        <h5>
                           <a href="javascript:;" class="text-dark font-weight-bold">
                              <?php echo get_sub_field('day'); ?>
                           </a>
                        </h5>
                        <p class="text-sm">
                           <?php echo get_sub_field('description'); ?>
                        </p>
                        <div class="buttons justify-content-center d-none">
                           <a href="javascript:;" class="btn btn-sm btn-rounded btn-dark btn-icon-only pt-1 mb-0" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Play episode" data-bs-original-title="Play episode">
                              <i class="fa fa-play" aria-hidden="true"></i>
                           </a>
                           <span class="font-weight-bold text-sm ms-2">2h 13min</span>
                        </div>
                     </div>
                     <hr class="horizontal dark my-4">
                  </div>
               <?php endwhile; ?>
            <?php endif; ?>
            
         </div>
      </div>
   </div>
</section>