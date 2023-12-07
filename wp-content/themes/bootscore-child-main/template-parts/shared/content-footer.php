<!-- -------- START FOOTER 1 w/ COMPANY DESCRIPTION AND 4 COLS ------- -->
<footer class="footer pt-9 pb-4 bg-gray-100">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 mb-5 mb-lg-0">

                <img src="<?php echo get_home_url() . '/wp-content/uploads/2023/01/Logo-No-Shadow.svg' ?>" class="footer-logo mb-3" alt="">

                <div class="my-4">
                    <h6 class="fw-normal lh-sm  d-block">5701 Woodway Dr. | Suite 220</h6>
                    <h6 class="fw-normal lh-sm  d-block">Houston, TX 77057 USA</h6>
                    <h6 class=""><a class="" href="tel:+1-866-464-8259" title="" target="_self">1-866-464-8259</a></h6>
                </div>

                <a href="https://www.facebook.com/Trips2Italy" target="_blank" class="text-secondary me-xl-4 me-3">
                    <span class="text-lg fab fa-facebook"></span>
                </a>
                <a href="https://twitter.com/Trips2italy" target="_blank" class="text-secondary me-xl-4 me-3">
                    <span class="text-lg fab fa-twitter"></span>
                </a>
                <a href="https://www.instagram.com/trips2italy/" target="_blank" class="text-secondary me-xl-4 me-3">
                    <span class="text-lg fab fa-instagram"></span>
                </a>

            </div>

            <div class="col-md-2 col-6 ms-lg-auto mb-md-0 mb-4">
                <h6 class="text-sm">Company</h6>
                <ul class="flex-column ms-n3 nav">
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(28208); ?>">
                            About Us
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(28484); ?>" >
                            Contact
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(30387); ?>" >
                            Reviews
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(27670); ?>" >
                            Blog
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-2 col-6 mb-md-0 mb-4">
                <h6 class="text-sm">Top Pages</h6>
                <ul class="flex-column ms-n3 nav">
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(27712); ?>" >
                            Destinations
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(25872); ?>" >
                            Trip Types
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(27813); ?>" >
                            Packages
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(30385); ?>">
                            Testimonials
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-2 col-6 mb-md-0 mb-4">
                <h6 class="text-sm">Traveling</h6>
                <ul class="flex-column ms-n3 nav">

                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(12765); ?>" >
                            Terms & Conditions
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(24599); ?>" >
                            FAQs
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(24595); ?>" >
                            Travel Protection
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?php echo get_permalink(24610); ?>" >
                            Memberships & Affiliations
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-2 col-6 mb-md-0 mb-4">
                <h6 class="text-sm">Learn About Italy</h6>
                <ul class="flex-column ms-n3 nav">

                    <?php
                    $id = 30944;
                    $parent = get_post($id);
                    $children = get_posts(array(
                        'post_type' => 'location',
                        'posts_per_page' => -1,
                        'post_parent' => $id
                    ));

                    array_unshift($children, $parent);

                    $italy_pages = '';

                    foreach ($children as $child) {
                        $title = (get_the_title($child->ID) === "Italy") ? "Italy Travel Guide" : trim(str_replace("Italy", "", get_the_title($child->ID)));
                        $italy_pages .= '<li class="nav-item">';
                        $italy_pages .= '<a class="nav-link text-secondary" href="' . get_permalink($child->ID) . '" >';
                        $italy_pages .= $title;
                        $italy_pages .= '</a></li>';
                    }

                    echo $italy_pages;
                    ?>

                </ul>
            </div>

            <div class="d-none col-md-2 col-6 mb-md-0 mb-4">
                <h6 class="text-sm">Contact</h6>
                <ul class="flex-column ms-n3 nav">
                    <li class="nav-item">
                        <span class="nav-link text-secondary d-block">5701 Woodway Dr.</span>
                        <span class="nav-link text-secondary d-block">Suite 220</span>
                        <span class="nav-link text-secondary d-block">Houston, TX 77057 USA</span>
                        <a class="nav-link fw-bold" href="tel:+1-866-464-8259" title="" target="_self">1-866-Go-Italy <span class="d-block fw-normal">1-866-464-8259</span></a>
                    </li>

                </ul>
            </div>

        </div>


        <div class="row mt-5">
            <div class="col text-center">
                <h6 class="mb-0">
                    <span class="fw-700 text-uppercase">Trips 2 Italy</span>
                    <span class="fw-normal">| Custom Italian Vacations | Est. 2003</span></h6>
            </div>
        </div>

        <hr class="horizontal dark mt-2 mb-3">

        <div class="row">
            <div class="col-8 mx-lg-auto text-lg-center">
                <p class="text-sm text-secondary">
                    Copyright © <script>document.write(new Date().getFullYear())</script> Trips 2 Italy LLC.
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- -------- END FOOTER 1 w/ COMPANY DESCRIPTION AND 4 COLS ------- -->
