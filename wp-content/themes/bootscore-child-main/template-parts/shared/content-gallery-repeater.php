<?php if (isset($args)) { ?>
    
<div class="container py-8">
<!--     <div class="row" id="photos-container">
        <div class="col-12">
            <h3>PHOTOS</h3>
        </div>
    </div>
 -->    
    <div class="d-grid grid-cols-3 grid-gap-2">

        <?php
        $images = get_field($args['repeater_field'], get_queried_object());
        $gallery = '';

        if( have_rows($args['repeater_field'], get_queried_object()) ):
            $gallery = '';
            while ( have_rows($args['repeater_field'], get_queried_object()) ) : the_row();

                $src = get_sub_field($args['sub_field_image'], get_queried_object())['url'];
                $caption = get_sub_field($args['sub_field_description'], get_queried_object());

                $gallery .= '<div class="">';
                $gallery .= '<a href="' . $src . '" ';
                $gallery .= 'data-toggle="lightbox" data-gallery="example-gallery">';
                $gallery .= '<img src="' . $src . '" class="img-fluid rounded" />';
                $gallery .= '</a>';

                if ($caption) {
                    $gallery .= '<div class="text-center"><p class="small px-4 text-dark pt-2">' . $caption . '</p></div>';
                }

                $gallery .= '</div>';

            endwhile;

        endif;

        echo $gallery;
        ?>

    </div>
</div>

<?php } ?>
