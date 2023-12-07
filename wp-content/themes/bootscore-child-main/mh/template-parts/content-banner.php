<?php
$heading_color_class = get_field('banner_heading_color') ? ' text-' . strtolower(get_field('banner_heading_color')) : '';
$image_url =  get_field('banner_image');
?>

<div class="jumbotron hero" id="banner-main"
     style="background-image: linear-gradient(to right,rgba(0,0,0,.95) 0%,rgba(0, 0, 0,.9) 15%,rgba(0, 0, 0,.85) 30%, rgba(0, 0, 0,.75) 35%, rgba(0, 0, 0,0) 60%),
         url(<?php echo $image_url; ?>)">

    <div class="container-fluid">
        <div class="wrapper">
            <div class="row justify-content-start">
                <div class="col-md-6 col-lg-4 pb-5 pb-md-0">
                    <h1 class="font-weight-bold text-white mb-3 mb-md-5 mt-4">
                        <?php the_field('banner_heading'); ?>
                    </h1>

                    <?php if (get_field('banner_description')) { ?>
                        <p class="text-white my-md-5 pb-5 pb-md-0"><?php echo get_field('banner_description'); ?></p>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>