<?php if (isset($args)) { ?>

<section class="py-7 alternate">
    <div class="container">

        <?php
        $heading_vals = get_field('regions_heading', $post->ID);
        echo get_content_section_heading($heading_vals);
        ?>


            <?php
            $i = 1;
            $content = '';

            foreach ($args as $region) {
                
                if ($i % 2 === 0) {
                    $content .= get_alternate_content($region, "right");
                } else {
                    $content .= get_alternate_content($region, "left");
                }
                $i++;
            }
            echo $content;

                ?>

    </div>
</section>
<?php } ?>
