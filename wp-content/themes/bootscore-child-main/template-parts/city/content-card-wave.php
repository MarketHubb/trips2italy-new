<section class="py-5 py-md-7 bg-gray-100" style="background-image:url(<?php echo get_home_url(); ?>/wp-content/uploads/2023/01/AdobeStock_141760356-copy-scaled.jpg); background-size: cover; background-position: center;">
    <div class="container">

        <?php

        if (empty(get_field('how_section_heading'))) {
            $heading_vals['heading'] = get_the_title();
            $heading_vals['subheading'] = "With Trips 2 Italy";
            $heading_vals['description'] = "Just tell us a little bit about where you'd like to go, and what you'd like to do. Our Italy travel experts will do the rest.";
        } else {
            $heading_vals = get_field('how_section_heading');
        }
        echo get_content_section_heading($heading_vals);
        ?>

    <div class="row mb-0 mb-md-5">

        <!-- Use the post-specific fields if populated -->
        <?php if (get_field('how_content')) { ?>


            <?php if( have_rows('how_content') ):
            $callouts = '';
            while ( have_rows('how_content') ) : the_row();
                $callouts .= '<div class="col-md-4 mb-5 mb-md-0">';
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
                $callouts .= '<div class="card-body pt-0">';

                $heading = str_replace("{", '<span class="stylized text-brand-500">', get_sub_field('heading'));
                $heading = str_replace("}", '</span>', $heading);

                $callouts .= '<h3 class="fs-5 fw-bolder mb-4">' . $heading . '</h3>';
                $callouts .= '<div class="callouts-container">';
                $callouts .= get_sub_field('callouts');
                $callouts .= '</div></div></div></div>';
            endwhile;
            echo $callouts;
            endif;
            ?>

        <?php } else { ?>

        <!-- Use the global fields as fallback -->
        <?php if (have_rows('how_it_works', 'option')): ?>
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