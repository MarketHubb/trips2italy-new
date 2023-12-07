<?php $section = ($args['section']) ?: '<section class="pt-3 pb-4" id="count-stats">'; ?>

    <?php echo $section; ?>

    <div class="container">

        <?php
        $heading_vals = $args['heading'];
        
        $heading = get_content_section_heading($heading_vals);
        if ($heading) {
            echo $heading;
        }
        ?>

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

        