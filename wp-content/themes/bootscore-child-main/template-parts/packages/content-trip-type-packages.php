<section class="my-5">
    <div class="container">
        <div class="row">

            <?php
            $trip_types = get_posts(array(
                'post_type' => 'trip',
                'posts_per_page' => -1,
            ));

            $types = '';
            
            foreach ($trip_types as $trip) {
                if (get_field('featured_image_mobile', $trip->ID)) {
                    $types .= '<div class="col-lg-4 col-md-6 my-3">
                                    <div class="card card-blog card-plain h-100 package-cards">
                                        <div class="position-relative">
                                            <a class="d-block blur-shadow-image">';
                    $types .= '<img src="' . get_field('featured_image_mobile', $trip->ID) . '" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">';
                    $types .= '</a></div>';
                    $types .= '<div class="card-body px-1 pt-3 d-flex flex-column">
                                <p class="text-gradient text-dark mb-2 text-sm">Starting at: $1,128.00</p>
                                <a href="javascript:;">';
                    $types .= '<h5>' . get_the_title($trip->ID) . '</h5>';
                    $types .= '</a>';
                    $types .= '<p class="clamp-4"></p>';
                    $types .= '<div class="mt-auto">';
                    $types .= '<a href="http://t2i-new.test/package/flavors-of-venice-tour-vacation-packages-for-2021-2022/" type="button" class="btn btn-outline-primary btn-sm">View Package Details</a>
                        </div>';
                    $types .= '</div></div></div>';
                }
            }

            echo $types;
            ?>
            


        </div>
    </div>
</section>