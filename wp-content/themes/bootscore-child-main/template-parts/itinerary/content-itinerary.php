<section class="alternate py-7">
    <div class="container">
        <div class="row section-heading mb-5 justify-content-center">
            <div class="col-lg-6 text-center">

                <h2 class="mb-0 mt-2">
                    A 14-day Italian honeymoon
                </h2>

                <h2 class="text-gradient text-primary">
                   An experience like no other            </h2>

                <p class="">
                    Curious what a honeymoon with Trips 2 Italy is like? Explore the detailed Itinerary below.</p>


            </div>
        </div>
        <div class="row align-items-center">
            <?php
            if( have_rows('details',get_the_ID()) ):
                $i = 1;
                $content = '';
                $locations = [];

                while ( have_rows('details',get_the_ID()) ) : the_row();
                    $location = get_sub_field('location');

                    if (!in_array($location,$locations)) {
                        $locations[] = $location;
                    }
                
                    $callout = array(
                        'image_mobile' => get_sub_field('image',get_the_ID()),
                        'region' => get_sub_field('heading',get_the_ID()),
                        'callout' => get_sub_field('location',get_the_ID()),
                        'excerpt' => get_sub_field('description',get_the_ID()),
                    );

                    if ($i % 2 === 0) {
                        $content .= get_alternate_content($callout, "right");
                    } else {
                        $content .= get_alternate_content($callout, "left");
                    }
                    $i++;
                endwhile;
                echo $content;
            endif;
            ?>
        </div>
    </div>
</section>