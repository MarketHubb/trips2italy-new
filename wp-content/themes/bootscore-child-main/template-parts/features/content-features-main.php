<?php if (isset($args) && is_numeric($args)) { ?>

    <?php $features = get_field('featured', $args); ?>

        <?php if (isset($features)) { ?>

            <div class="col-lg-6 mt-lg-0 mt-5 ps-lg-0 ps-0">

                <?php foreach ($features['sections'] as $section) { ?>

                    <div class="p-3 info-horizontal">
                        <div class="icon icon-shape rounded-circle bg-gradient-warning shadow text-center">
                            <i class="<?php echo $section['icon']; ?>"></i>
                        </div>
                        <div class="description ps-3">
                            <p class="lead pb-1 mb-1"><strong><?php echo $section['heading']; ?></strong></p>
                            <p class="mb-0"><?php echo $section['description']; ?></p>
                        </div>
                    </div>

                <?php } ?>

            </div>

        <?php } ?>

<?php } ?>
