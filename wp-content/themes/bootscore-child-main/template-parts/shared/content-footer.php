<!-- -------- START FOOTER 1 w/ COMPANY DESCRIPTION AND 4 COLS ------- -->
<?php
$section_args = [
    'classes' => ' bg-gray-50 '
];
echo tw_section_open($section_args);
?>
<!-- <div class="col-span-1 lg:col-span-full">
                <img src="<?php //echo get_home_url() . '/wp-content/uploads/2023/01/Logo-No-Shadow.svg' 
                            ?>" class="hidden footer-logo mb-3" alt="">
            </div> -->
<div class="max-w-7xl mx-auto relative">
    <div class="grid lg:grid-cols-6">
        <!-- Logo + Address -->
        <div class="grid grid-cols-1 lg:flex lg:col-span-2 items-center mb-12 lg:mb-0">
            <div class="flex flex-row lg:flex-col gap-x-5 divide-x divide-gray-100 w-full">
                <div>
                    <h5 class="text-xl font-bold tracking-wide text-brand-500">Trips 2 Italy</h5>
                    <p class="py-2"><a class="text-base text-gray-800 font-semibold" href="tel:+1-866-464-8259" title="" target="_self">1-866-464-8259</a></p>

                    <ul class="flex flex-row justify-between lg:justify-normal lg:mb-6">
                        <a href="https://www.facebook.com/Trips2Italy" target="_blank" class="text-secondary ">
                            <span class="text-lg fab fa-facebook text-gray-600 lg:pr-3 "></span>
                        </a>
                        <a href="https://twitter.com/Trips2italy" target="_blank" class="text-secondary ">
                            <span class="text-lg fab fa-twitter text-gray-600 lg:pr-3"></span>
                        </a>
                        <a href="https://www.instagram.com/trips2italy/" target="_blank" class="text-secondary ">
                            <span class="text-lg fab fa-instagram text-gray-600 lg:pr-3"></span>
                        </a>
                    </ul>
                </div>
                <div class="pl-5 lg:pl-0">
                    <p class="text-sm">
                        5701 Woodway Dr.<br>
                        Suite 220<br>
                        Houston, TX 77057 USA</br>
                    </p>
                </div>
            </div>
        </div>

        <!-- Links: Company -->
        <div class="grid grid-cols-2 gap-x-6 lg:gap-x-0 lg:grid-cols-4 lg:col-span-4">
            <div class="mb-4 lg:mb-0">
                <h6 class="text-sm font-semibold mb-2">Company</h6>
                <ul class="flex-column nav">
                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(28208); ?>">
                            About Us
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(28484); ?>">
                            Contact
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(30387); ?>">
                            Reviews
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(27670); ?>">
                            Blog
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Links: Top Pages -->
            <div class="mb-4 lg:mb-0">
                <h6 class="text-sm font-semibold mb-2">Top Pages</h6>
                <ul class="flex-column nav">
                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(27712); ?>">
                            Destinations
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(25872); ?>">
                            Trip Types
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(27813); ?>">
                            Packages
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(30385); ?>">
                            Testimonials
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Links: Traveling -->
            <div class="mb-4 lg:mb-0">
                <h6 class="text-sm font-semibold mb-2">Traveling</h6>
                <ul class="flex-column nav">

                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(12765); ?>">
                            Terms & Conditions
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(24599); ?>">
                            FAQs
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(24595); ?>">
                            Travel Protection
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="<?php echo get_permalink(24610); ?>">
                            Memberships & Affiliations
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Links: Italy -->
            <div class="mb-4 lg:mb-0">
                <h6 class="text-sm font-semibold mb-2">Learn About Italy</h6>
                <ul class="flex-column nav">

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
                        $italy_pages .= '<a class="text-sm text-gray-500 py-1 inline-block  hover:underline" href="' . get_permalink($child->ID) . '" >';
                        $italy_pages .= $title;
                        $italy_pages .= '</a></li>';
                    }

                    echo $italy_pages;
                    ?>

                </ul>
            </div>
        </div>
    </div>


    <div class="mx-auto text-center mt-6 lg:mt-12">
        <h6 class="mb-0 text-xs md:text-sm lg:text-lg">
            <span class="fw-700 text-uppercase">Trips 2 Italy</span>
            <span class="fw-normal">| Custom Italian Vacations | Est. 2003</span>
        </h6>
    </div>

    <hr class="horizontal dark mt-2 mb-3">

    <div class="mx-auto text-center">
        <p class="text-xs md:text-sm lg:text-base text-secondary">
            Copyright © <script>
                document.write(new Date().getFullYear())
            </script> Trips 2 Italy LLC.
        </p>

    </div>
</div>
</div>
</section>
<!-- -------- END FOOTER 1 w/ COMPANY DESCRIPTION AND 4 COLS ------- -->