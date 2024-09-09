<!-- <h2>hero-banner/content-main.php</h2> -->
<?php if ($args) { ?>

    <?php
    $text_color = $args['copy']['mobile_text_color'] ?: 'Dark';
    $mobile_image = $args['images']['mobile_image'] ?: $args['images']['background_image'] ?>

    <!-- Mobile -->
    <header class="d-flex d-md-none py-5 hero-container hero-mobile hero-text-<?php echo strtolower($text_color); ?>" style="background-image: url(<?php echo $mobile_image; ?>);">

        <div class="container-fluid">
            <div class="row">
                <div class="col text-3xl mt-8">


                    <?php echo hero_heading($args, "mobile"); ?>

                    <?php echo hero_description($args, "mobile"); ?>

                    <?php echo hero_callouts($args, "mobile"); ?>

                    <div class="mb-12">
                        <a href="<?php echo get_permalink(28484); ?>" data-target="Primary" class="btn font-semibold bg-orange btn-lg mb-0">
                            Start now </a>
                    </div>
                    <?php
                    // $links = output_hero_links($args, "mobile");
                    // echo ($links) ?: null;
                    ?>

                </div>
            </div>
        </div>

    </header>


<?php } ?>