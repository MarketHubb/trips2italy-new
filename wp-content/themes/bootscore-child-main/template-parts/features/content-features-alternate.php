<div class="row align-items-center">
    <?php
    if( have_rows('cards', $id) ):
        $i = 1;
        $content = '';

        while ( have_rows('cards', $id) ) : the_row();
            $callout = array(
                'image_mobile' => get_sub_field('background_image', $id),
                'region' => get_sub_field('heading', $id),
                'callout' => get_sub_field('subheading', $id),
                'excerpt' => get_sub_field('description', $id),
            );

            if ($i % 2 === 0) {
                $content .= get_alternate_content($callout, "right");
            } else {
                $content .= get_alternate_content($callout, "left");
            }
            $i++;
        endwhile;
        echo $content;
    endif;
    ?>
</div>
