<?php $section_container = ($args['section']) ?: '<section class="pt-3 pb-4 bg-light" id="count-stats">'; ?>

<?php echo $section_container; ?>

<div class="container">

    <?php
    $heading_vals = $args['heading'];

    $heading = get_content_section_heading($heading_vals);
    if ($heading) {
        echo $heading;
    }
    ?>

</div>

<?php $style = ($args['image']) ? 'container-fluid background-image-full py-8" style="background-image: url(' . $args['image'] . ')"' : 'container"'; ?>

<div class="<?php echo $style; ?>>

    <div class="row">
        <div class="col-lg-9 z-index-2 border-radius-xl mx-auto py-3 blur shadow-blur stats-cols">
            <div class="row">

                <?php
                $stats = get_stats($args['content']);
                if ($stats) {
                    echo  $stats;
                }
                ?>

            </div>
        </div>
    </div>
</div>

</section>