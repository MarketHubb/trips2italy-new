<?php $bg_image = get_home_url() . '/wp-content/uploads/2021/11/Featured-BG.jpg'; ?>


<section class="py-7 background-image-container" style="background-image: linear-gradient(to right,rgba(255,255,255,.1), rgba(255,255,255,.1) 35%, rgba(255,255,255,.1) 100%),url(<?php echo $bg_image; ?>">
    <div class="container">
        <div class="row">

            <?php $panels = get_field('feature_panels')['feature_panels']; ?>
            <?php foreach ($panels as $panel) { ?>

            <div class="col-md-4">

                <?php
                $card_args = [];
                $card_args['image_url'] = $panel['image']['url'];
                $card_args['heading'] = '<h4 class="fw-bolder">' .  $panel['heading'] . '</h4>';
                $card_args['body'] = '<p>' . $panel['description'] . '</p>';
                $card  = single_card_waves($card_args);

                echo $card;
                ?>

            </div>


            <?php } ?>

        </div>
    </div>
</section>
