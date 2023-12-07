<section class="pt-3 pb-4" id="count-stats">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 z-index-2 border-radius-xl mt-n6 mx-auto py-3 blur shadow-blur">
                <div class="row">
                    <div class="col-md-3 position-relative">
                        <div class="p-3 text-center">
                            <h2 class="text-gradient text-primary">
                                <span id="state1" countto="300"><?php echo get_field('days'); ?></span>
                            </h2>
                            <h5 class="mt-3">Days</h5>
                            <p class="text-sm">With your partner in the most scenic & romantic country in the world</p>
                        </div>
                        <hr class="vertical dark">
                    </div>

                    <?php
                    $locations = get_field('locations');
                    $locations_array = explode(",", $locations);
                    $locations_count = count($locations_array);
                    ?>
                    <div class="col-md-3 position-relative">
                        <div class="p-3 text-center">
                            <h2 class="text-gradient text-primary">
                                <span id="state2" countto="100"><?php echo $locations_count; ?></span>
                            </h2>
                            <h5 class="mt-3">Cities</h5>
                            <p class="text-sm">Experience the wonders of <?php echo $locations; ?> like a local</p>
                        </div>
                        <hr class="vertical dark">
                    </div>

                    <div class="col-md-3 position-relative">
                        <div class="p-3 text-center">
                            <h2 class="text-gradient text-primary" id="state3" countto="39">
                                7
                            </h2>
                            <h5 class="mt-3">Excursions</h5>
                            <p class="text-sm">Including a romantic cooking class & a guided tour of the Colosseum</p>
                        </div>
                        <hr class="vertical dark">
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 text-center">
                            <h2 class="text-gradient text-primary" id="state3" countto="39">
                                $<?php echo get_field('price');  ?>
                            </h2>
                            <h5 class="mt-3">Starting at</h5>
                            <p class="text-sm">Including airfare, accommodations at 4-star hotels & guided tours.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
