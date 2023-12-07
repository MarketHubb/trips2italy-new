<?php if (isset($args)) { ?>
    

    <div class="row" id="photos-container">
        <div class="col-12">
            <h3>PHOTOS</h3>
        </div>
    </div>
    <div class="d-grid grid-cols-3 grid-gap-2">

        <?php
        $images = get_field('images', get_queried_object());
        $gallery = '';

        if( have_rows('images', get_queried_object()) ):
            $gallery = '';
            while ( have_rows('images', get_queried_object()) ) : the_row();

                $src = get_sub_field('image', get_queried_object())['url'];
                $caption = get_sub_field('description', get_queried_object());

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
        else:
            echo "ids";
            foreach ($args as $id) {
                $src = wp_get_attachment_image_src($id, 'full')[0];
                $caption = str_replace('_', ' ', get_post($id)->post_content);

                $gallery .= '<div class="col-sm-4 p-2">';
                $gallery .= '<a href="' . $src . '" ';
                $gallery .= 'data-toggle="lightbox" data-gallery="example-gallery">';
                $gallery .= '<img src="' . $src . '" class="img-fluid" />';
                $gallery .= '</a>';

                if ($caption) {
                    $gallery .= '<div class="text-center"><p class="small px-4 text-dark pt-2">' . $caption . '</p></div>';
                }

                $gallery .= '</div>';
            }

        endif;

        echo $gallery;
        ?>



<!--            </a>-->


<!--            <div class="col-3">-->
<!--                    <figure class="figure">-->
<!--                        <img src="--><?php //echo $src ?><!--" alt="--><?php //echo $caption ?><!--" class="figure-img img-fluid img-thumbnail rounded">-->
<!--                        <figcaption class="figure-caption text-center">--><?php //echo $caption; ?><!--</figcaption>-->
<!--                    </figure>-->
<!--                </div>-->

        <?php //} ?>

    </div>

<?php } ?>
