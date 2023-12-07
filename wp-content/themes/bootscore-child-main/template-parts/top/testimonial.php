<?php
$bg_opacity = $hero['page_banner_image_opacity'] > 0 ? $hero['page_banner_image_opacity'] : .5;
$linear_gradient = 'linear-gradient(to bottom, rgba(0,0,0,' .  $bg_opacity . ') 0%,rgba(0,0,0,' . $bg_opacity . ') 100%)';
$image = get_home_url() . '/wp-content/uploads/2021/08/Testimonial.jpg';
?>
<div class="content-section" id="testimonials">
<?php $bg_image = get_home_url() . '/wp-content/uploads/2021/08/Why-Background.jpg'; ?>
    <div class="container">
        <!-- Section Heading -->
        <div class="row">
            <div class="col text-center">
                <?php echo get_section_heading(get_field('testimonial_heading'), get_field('testimonial_subheading')); ?>
            </div>
        </div>
        <!-- Cards -->
        <?php
        if (have_rows('testimonials')):
            $c = '<div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">';
            while (have_rows('testimonials')) : the_row();
                $id = get_sub_field('testimonial');
                $c .= '<div class="col">';
                $c .= '<div class="card card-cover h-100">';
                $c .= '<i class="fa-solid fa-quote-left fa-5x fa-border position-absolute top-0 start-50 translate-middle background-icon quote-icon"></i>';
                $c .= '<div class="d-flex flex-column h-100 p-5 pb-4">';
                $c .= '<p class="mt-4 mb-4  lh-sm fs-5">"' . get_field('testimonial', $id) . '"</p>';

                $c .= '<div class="text-center mt-auto">';
                $c .= '<p class="">';
                $c .= ' <i class="text-orange fa-solid fa-star-sharp"></i><i class="text-orange fa-solid fa-star-sharp"></i><i class="text-orange fa-solid fa-star-sharp"></i><i class="text-orange fa-solid fa-star-sharp"></i><i class="text-orange fa-solid fa-star-sharp"></i>';
                $c .= '</p>';
                $c .= '<p class=""><small class="fw-bold">' . get_the_title($id) . '</small></p>';
                $c .= '<img src="' . get_field('image', $id) . '" class="rounded-circle w-25 p-1" />';
                $c .= '</div></div></div></div>';
            endwhile;
            $c .= '</div>';
            echo $c;
        endif;
        ?>

    </div>
</div>