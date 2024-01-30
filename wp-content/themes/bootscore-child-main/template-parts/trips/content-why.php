<?php $bg_image = get_home_url() . '/wp-content/uploads/2021/11/Featured-BG.jpg'; ?>

<section class="py-7 background-image-container" style="background-image: linear-gradient(to right,rgba(255,255,255,.1), rgba(255,255,255,.1) 35%, rgba(255,255,255,.1) 100%),url(<?php echo $bg_image; ?>">
    <div class="container">

        <!-- Section Heading -->
        <?php
        if (empty(get_field('why_section_heading'))) {
            $heading_vals['heading'] = get_the_title();
            $heading_vals['subheading'] = "With Trips 2 Italy";
            $heading_vals['description'] = "Just tell us a little bit about where you'd like to go, and what you'd like to do. Our Italy travel experts will do the rest.";
        } else {
            $heading_vals = get_field('why_section_heading');
        }
        echo get_content_section_heading($heading_vals, true, true, true);
        ?>

        <div class="row">
            <?php $panels = get_field('feature_panels')['feature_panels']; ?>

            <?php foreach ($panels as $panel) { ?>

                <div class="col-12 col-md-4 mb-5 mb-md-0">
                    <div class="card card-cover no-border feature-cards h-100 overflow-hidden text-white bg-blue-light rounded shadow-lg" style="background-image: url(<?php echo $panel['image']['url']; ?>)">
                        <div class="d-flex flex-column h-100 py-5 px-4 pb-8 p-md-5 text-white  border border-3 border-white rounded text-shadow-1 panel-copy-container">
                            <h2 class="pt-0 mt-0 mb-3 fs-2 text-white lh-sm fw-bolder"><?php echo $panel['heading']; ?></h2>
                            <p class="text-white mb-5 pb-5"><?php echo $panel['description']; ?></p>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-md-4"> -->

                <?php
                $card_args = [];
                $card_args['image_url'] = $panel['image']['url'];
                $card_args['heading'] = '<h4 class="fw-bolder">' .  $panel['heading'] . '</h4>';
                $card_args['body'] = '<p>' . $panel['description'] . '</p>';
                $card  = single_card_waves($card_args);

                //echo $card;
                ?>

                <!-- </div> -->


            <?php } ?>

        </div>
    </div>
</section>