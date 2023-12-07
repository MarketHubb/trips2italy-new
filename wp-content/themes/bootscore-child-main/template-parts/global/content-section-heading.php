<?php if (isset($args)) { ?>
    <div class="row section-heading mb-5 justify-content-center">
        <div class="col-12 col-md-8 col-lg-7 text-center">

            <?php if (isset($args['heading'])) { ?>
                <?php $heading_classes = (isset($args['heading_classes'])) ? $args['heading_classes'] : 'mb-0'; ?>
                <h2 class="<?php echo $heading_classes ?>">
                    <?php echo $args['heading']; ?>
                </h2>
            <?php } ?>

            <?php if (isset($args['subheading'])) { ?>
                <?php $subheading_classes = (isset($args['subheading_classes'])) ? $args['subheading_classes'] : 'text-gradient text-primary'; ?>
                <h2 class="<?php echo $subheading_classes; ?>">
                    <?php echo $args['subheading']; ?>
                </h2>
            <?php } ?>

            <?php if (isset($args['description'])) { ?>
                <?php $description_classes = (isset($args['description_classes'])) ? $args['description_classes'] : ''; ?>
                <p class="<?php echo $description_classes; ?>">
                    <?php echo $args['description']; ?>
                </p>
            <?php } ?>

        </div>
    </div>
<?php } ?>

