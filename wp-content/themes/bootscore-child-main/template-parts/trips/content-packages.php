<section class="my-5">
    <div class="container">

        <div class="row">
            <div class="row justify-content-center text-center my-sm-5">
                <div class="col-lg-6">
                    <?php $type_singular = remove_s_from_end_of_string(get_the_title($post->ID)); ?>
                    <h2 class="text-dark mb-0">
                        <?php echo $type_singular; ?> packages
                    </h2>
                    <h2 class="text-primary text-gradient">
                        We've crafted for clients
                    </h2>
                    <p class="lead">
                        Curious about what a custom itinerary from Trips 2 Italy is like? Explore these <?php echo $type_singular; ?> packages to see what we do.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">

            <?php



            $legacy_package_links = get_field('package_links_legacy');
            $package_links_array = explode("\n", $legacy_package_links);

            $titles_array = [];
            $package_post_ids = [];
            $page_post_ids = [];

            foreach ($package_links_array as $package_title) {
                $slug_from_title = sanitize_title($package_title);

                if (!empty($slug_from_title)) {

                    $package_posts = get_posts(array(
                        'post_type' => 'package',
                        'posts_per_page' => 6,
                        'post_status' => ['published'],
                        'name' => $slug_from_title
                    ));

                    $package_card = '';

                    foreach ($package_posts as $package) {

                        if (get_field('featured_image', $package->ID)) {
                            $package_card .= '<div class="col-lg-4 col-md-6 my-3">
                                <div class="card card-blog card-plain h-100 package-cards">
                                <div class="position-relative">
                                <a class="d-block blur-shadow-image">';
                            $package_card .= '<img src="' . get_field('featured_image', $package->ID)['url'] . '" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">';
                            $package_card .= '</a></div>';
                            $package_card .= '<div class="card-body px-1 pt-3 d-flex flex-column">';
                            $package_card .= '<p class="text-gradient text-dark mb-2 text-sm">';
                            $package_card .= 'Starting at: ' . get_field('price', $package->ID) . '</p>';

                            $package_card .= '<a href="javascript:;">';
                            $package_card .= '<h5>' . get_the_title($package->ID) . '</h5>';
                            $package_card .= '</a>';
                            $package_card .= '<p class="clamp-4">' . get_field('description', $package->ID) . '</p>';
                            $package_card .= '<div class="mt-auto">';

                            // Don't display links on travels (PPC) pages
                            if (!str_contains(get_home_url(), "travels.")) {
                                $package_card .= '<a href="' . get_permalink($package->ID) . '" type="button" class="btn btn-outline-primary btn-sm">View Package Details</a>';
                            }

                            $package_card .= '</div>';
                            $package_card .= '</div></div></div>';
                        }

                        echo $package_card;
                    }
                }
            }

            ?>

        </div>
    </div>
</section>