<!-- <h2>hero-banner/content-main.php</h2> -->
<?php if ($args) { ?>

    <?php
    $text_color = $args['copy']['mobile_text_color'] ?: 'Dark';
    $mobile_image = $args['images']['mobile_image'] ?: $args['images']['background_image'] ?>

    <!-- Mobile -->
    <header class="d-flex d-md-none py-5 hero-container hero-mobile hero-text-<?php echo strtolower($text_color); ?>" style="background-image: url(<?php echo $mobile_image; ?>);">

        <div class="container-fluid">
            <div class="row">
                <div class="col">


                    <?php echo hero_heading($args, "mobile"); ?>

                    <?php echo hero_description($args, "mobile"); ?>

                    <?php echo hero_callouts($args, "mobile"); ?>

                    <?php
                    $links = output_hero_links($args, "mobile");
                    echo ($links) ?: null;
                    ?>

                </div>
            </div>
        </div>

    </header>


<?php } ?>