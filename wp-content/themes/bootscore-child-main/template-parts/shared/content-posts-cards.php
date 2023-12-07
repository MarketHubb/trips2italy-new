<section class="py-7 bg-gray-100 post-list">
    <div class="container">
        <div class="row justify-content-center section-heading mb-5">
            <div class="col-md-6 text-center">
                <h2 class="text-gradient text-primary mb-0 mt-2">The latest musings and news</h2>
                <h2>From our blog</h2>
                <p class="lead">We cover regions of Italy and what makes them so special as well as recipes, travel tips and much more. </p>
            </div>
        </div>
        <div class="row">

            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
            );
            $latest_posts = get_posts($args);
            ?>

            <?php if (isset($latest_posts)) { ?>

                <?php foreach ($latest_posts as $latest_post) { ?>

                    <div class="col-lg-4 mb-lg-0 mb-4">
                        <div class="card">
                            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                <a href="javascript:;" class="d-block">
                                    <img src="<?php echo get_the_post_thumbnail_url($latest_post->ID); ?>" class="img-fluid border-radius-lg">
                                </a>
                            </div>
                            <div class="card-body pt-3">
                                <span class="text-gradient text-warning text-uppercase text-xs font-weight-bold my-2">
                                    <?php echo get_the_author(); ?>
                                </span>
                                <a href="<?php echo get_the_permalink($latest_post->ID); ?>" class="card-title h5 d-block text-darker">
                                    <?php echo get_the_title($latest_post->ID); ?>
                                </a>
                                <p class="card-description mb-4">
                                    <?php echo get_excerpt_for_post(get_the_excerpt($latest_post->ID), 150); ?>
                                </p>
                                <div class="author align-items-center">
                                    <img src="<?php echo home_url() . '/wp-content/uploads/2018/06/Italy_Sicily_Food_Tommaso_Eating_Giant_Cannolo_GL01.jpg' ?>" alt="..." class="avatar shadow">
                                    <div class="name ps-3">
                                        <span>Tommaso De Poi</span>
                                        <div class="stats">
                                            <small><?php echo get_the_date(); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            <?php } ?>
<!--            <div class="col-lg-4 mb-lg-0 mb-4">-->
<!--                <div class="card">-->
<!--                    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">-->
<!--                        <a href="javascript:;" class="d-block">-->
<!--                            <img src="../../assets/img/blog7-2.jpg" class="img-fluid border-radius-lg">-->
<!--                        </a>-->
<!--                    </div>-->
<!---->
<!--                    <div class="card-body pt-3">-->
<!--                        <span class="text-gradient text-info text-uppercase text-xs font-weight-bold my-2">Office</span>-->
<!--                        <a href="javascript:;" class="text-darker card-title h5 d-block">-->
<!--                            Really Housekeeping-->
<!--                        </a>-->
<!--                        <p class="card-description mb-4">-->
<!--                            Use border utilities to quickly style the border and border-radius of an element. Great for images, buttons.-->
<!--                        </p>-->
<!--                        <div class="author align-items-center">-->
<!--                            <img src="../../assets/img/ivana-square.jpg" alt="..." class="avatar shadow">-->
<!--                            <div class="name ps-3">-->
<!--                                <span>Chriss Smahos</span>-->
<!--                                <div class="stats">-->
<!--                                    <small>Posted 2 min ago</small>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 mb-lg-0 mb-4">-->
<!--                <div class="card">-->
<!--                    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">-->
<!--                        <a href="javascript:;" class="d-block">-->
<!--                            <img src="../../assets/img/blog7-3.jpg" class="img-fluid border-radius-lg">-->
<!--                        </a>-->
<!--                    </div>-->
<!---->
<!--                    <div class="card-body pt-3">-->
<!--                        <span class="text-gradient text-warning text-uppercase text-xs font-weight-bold my-2">Hub</span>-->
<!--                        <a href="javascript:;" class="text-darker card-title h5 d-block">-->
<!--                            Shared Coworking-->
<!--                        </a>-->
<!--                        <p class="card-description mb-4">-->
<!--                            Use border utilities to quickly style the border and border-radius of an element. Great for images, buttons.-->
<!--                        </p>-->
<!--                        <div class="author align-items-center">-->
<!--                            <img src="../../assets/img/marie.jpg" alt="..." class="avatar shadow">-->
<!--                            <div class="name ps-3">-->
<!--                                <span>Elijah Miller</span>-->
<!--                                <div class="stats">-->
<!--                                    <small>Posted now</small>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</section>