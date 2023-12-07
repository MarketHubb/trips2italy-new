<section class="features-3 mt-n10 py-7">
    <div class="container">
        <div class="row text-center justify-content-center pt-10">
            <div class="col-lg-6">
                <span class="badge rounded-pill badge-primary mb-2">Related Packages</span>
                <h2>Check out these other amazing, fully-customizable packages</h2>
                <p>
                    Discover customizable Italian travel packages that cater to your unique preferences, allowing you to create a personalized journey through Italy's diverse regions, iconic landmarks, and authentic culinary experiences. Immerse yourself in the beauty of Italy, tailored to your individual desires.
                </p>
            </div>
        </div>
        <div class="row mt-5">

            <?php
            $packages = get_posts(array(
                'post_type' => 'package',
                'posts_per_page' => 6,
                'post__not_in' => [27976,27963, 27952, 27946, 27944, 27945, 27939, 27933, 27936, $post->ID],
            ));

            $p = '';
            foreach ($packages as $package) {
                $image = get_field('featured_image', $package->ID);
                if ($image) {
                    $p .= '<div class="col-lg-4 mb-lg-0 mb-4">
                                <a href="javascript:;">
                                    <div class="card card-background move-on-hover mb-4">';
                    $p .= '<div class="full-background" style="background-image: url(' . $image['url'] . ')"></div>';
                    $p .= '<div class="card-body pt-12">
                            <h4 class="text-white">' . get_the_title($package->ID) . '</h4>
                            <p class="clamp-2">' . get_field('description', $package->ID) . '</p></div></div></div></a>';
                }
            }

            echo $p;
            ?>






                <!-- End Card Blog Fullbackground - text centered -->


                <!-- Start Card Blog Fullbackground - text centered -->

            </div>
        </div>
</section>
