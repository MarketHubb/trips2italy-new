<section class="pt-7 pb-0">
    <div class="container">
        <div class="row">

            <?php
            $packages = get_posts(array(
                'post_type' => 'package',
                'posts_per_page' => 42,
                'post__not_in' => [27976,27963, 27952, 27946, 27944, 27945, 27939, 27933, 27936],
            ));

            $p = '';
            foreach ($packages as $package) {
                $image = get_field('featured_image', $package->ID);
                if ($image) {
                    $p .= '<div class="col-lg-4 col-md-6 my-3">
                                <div class="card card-blog card-plain h-100 package-cards">
                                    <div class="position-relative">
                                        <a class="d-block blur-shadow-image">';
                    $p .= '<img src="' . $image['url'] . '" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">';
                    $p .= '</a>
                            </div>
                            <div class="card-body px-1 pt-3 d-flex flex-column">';
                    $p .= '<p class="text-gradient text-dark mb-2 text-sm">';
                    $p .= 'Starting at: ' . get_field('price', $package->ID) . '</p>';
                    $p .= '<a href="javascript:;">';
                    $p .= '<h5>' . get_the_title($package->ID) . '</h5></a>';
                    $p .= '<p class="clamp-4">' . get_field('description', $package->ID) . '</p>';
                    $p .= '<div class="mt-auto ">';
                    $p .= '<a href="' . get_permalink($package->ID) . '" type="button" class="btn btn-outline-primary btn-sm">';
                    $p .= 'View Package Details</a>';
                    $p .= '</div></div></div></div>';
                }
                
            }

            echo $p;

            ?>


        </div>
    </div>
</section>
