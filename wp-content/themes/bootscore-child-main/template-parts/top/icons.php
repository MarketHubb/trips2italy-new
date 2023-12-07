<?php
$bg_image = get_field('icons_desktop_image', 'option');
$bg_image_mobile = get_field('icons_mobile_image', 'option');
?>

<div id="icons" class="content-section bg-blue-light bg-dark background-image-container bg-desktop-replace pb-5" data-bgimage="<?php echo $bg_image; ?>" data-bgmobile="<?php echo $bg_image_mobile; ?>"
     style="background-image: url(<?php echo $bg_image_mobile; ?>">

    <!-- Section: Icon Features -->
    <div class="container">
        <!-- Section Heading -->
        <div class="row justify-content-center mb-3">
            <div class="col-md-9 text-center px-4 px-md-2 pb-4 text-white">
                <?php echo get_section_heading(get_field('icon_heading'), get_field('icon_subheading')); ?>
            </div>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4">

            <?php
            if( have_rows('icon_features') ):
                $if = '';
                while ( have_rows('icon_features') ) : the_row();
                    $if .= '<div class="col h-100 icon-container">';
                    $if .= '<div class="text-center shadow bg-opacity-white-dark shadow rounded py-4 py-lg-5 bt-orange">';
                    $if .= '<i class="' . get_sub_field('icon') . ' text-blue fa-xl mb-2 mb-md-4"></i>';
                    $if .= '<p class="mb-0 pb-0 mt-3 text-uppercase fw-bold text-dark icons-first roboto">' . trim(get_sub_field('first_word')) . '</p>';
                    $if .= '<p class="mb-0 script text-blue">' . get_sub_field('description') . '</p>';
                    $if .= '</div></div>';
                endwhile;
                echo $if;
            endif;
            ?>
        </div>
    </div>
</div>