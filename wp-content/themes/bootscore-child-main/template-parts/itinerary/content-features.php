<div class="container">
    <div class="row justify-content-center align-items-center">
        
        <?php if (get_field('days')) { ?>
            <div class="col-md-3 text-center">
                <div class="card">
                    <div class="card-body rounded bg-white shadow-lg">
                        <h5>Days:</h5>
                        <h3><?php echo get_field('days'); ?></h3>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (get_field('locations')) { ?>
            <?php 
            $locations = get_field('locations');
            $locations_array = explode(",",$locations);
            $locations_count = count($locations_array);
            ?>
            <div class="col-md-3 text-center">
                <div class="card">
                    <div class="card-body rounded bg-white shadow-lg">
                        <h5>Locations:</h5>
                        <h3><?php echo $locations_count; ?></h3>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (get_field('category')) { ?>
            <div class="col-md-3 text-center">
                <div class="card">
                    <div class="card-body rounded bg-white shadow-lg">
                        <h5>Type:</h5>
                        <h3><?php echo get_field('category')[0]; ?></h3>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (get_field('price')) { ?>
            <div class="col-md-3 text-center">
                <div class="card">
                    <div class="card-body rounded bg-white shadow-lg">
                        <h5>Starting at:</h5>
                        <h3>$<?php echo get_field('price'); ?></h3>
                    </div>
                </div>
            </div>
        <?php } ?>

        
    </div>
</div>
