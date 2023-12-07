<div class="content-section pb-md-0 mb-md-0">
    <div class="container">
        <!-- Section Heading -->
        <div class="row justify-content-center">
            <div class="col-md-10 text-center px-2 px-md-3 px-lg-4 px-md-2 pb-lg-4">
                <?php echo get_section_heading(get_field('why_heading'), get_field('why_subheading')); ?>
                <?php echo get_section_subheading(get_field('why_content'), 'mb-0 mb-md-4'); ?>
            </div>
        </div>
    </div>
</div>
    <?php
    if( have_rows('cards') ):
        $why = '';
        $i = 1;
        while ( have_rows('cards') ) : the_row();
            $heading_order_class = ($i % 2 == 0) ? 'order-md-last' : '';
            $color_class = ($i % 2 == 0) ? 'bg-blue-light-large' : '';
            $translate_class = ($i % 2 == 0) ? '358' : '2';
            $vertical_margin_class = get_row_index() === 1 ? "mb-5" : "my-5";

            $why .= '<div class="pt-0 pt-md-4 mx-4 py-md-5 shadow-mobile ' . $vertical_margin_class . ' ' . $color_class . '">';
            $why .= '<div class="container">';
            $why .= '<div class="row justify-content-evenly">';
            $why .= '<div class="col-md-5 p-0 p-md-2 ' . $heading_order_class . '">';
            // Mobile card images
            $why .= '<div class="d-block d-md-none">';
            $why .= '<img src="' . get_sub_field('background_image') . '" class="mobile-card-header-images w-100"/>';
            $why .= '</div>';
            // Text Container
            $why .= '<div class="p-4 p-md-0">';
            $why .= '<div class="my-2 mb-md-0">';
            $why .= get_section_heading(get_sub_field('heading'), get_sub_field('subheading'));
            $why .= '</div>';
            $why .= '<p class="lead fs-5 myContent">' . get_sub_field('description') . '</p>';
            $why .= '</div></div>';
            $why .= '<div class="col-md-5">';
            $why .= '<img src="' . get_sub_field('background_image') . '" class="mt-4 mt-md-0 d-none d-md-inline-block shadow rounded transform-' . $translate_class . '" />';
            $why .= '</div></div></div></div>';
            $i++;
        endwhile;
        echo $why;
    endif;
    ?>

