<div class="content-section">
    <div class="container">
        <!-- Section Heading -->
        <div class="row">
            <div class="col text-center">
                <?php echo get_section_heading(get_field('faq_heading'), get_field('faq_subheading')); ?>
            </div>
        </div>
        <!-- Cards -->
        <?php
        if (have_rows('faqs')):
            $c = '<div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">';
            while (have_rows('faqs')) : the_row();
                $id = get_sub_field('testimonial');
                $c .= '<div class="col">';
                $c .= '<div class="card card-cover h-100">';
                $c .= '<i class="fa-solid fa-quote-left fa-5x fa-border position-absolute top-0 start-50 translate-middle background-icon quote-icon"></i>';
                $c .= '<div class="d-flex flex-column h-100 p-5 pb-4">';
                $c .= '<p class="mt-4 mb-4  lh-sm fs-5">"' . get_field('testimonial', $id) . '"</p>';

                $c .= '<div class="text-center mt-auto">';
                $c .= '<p class="">';
                $c .= ' <i class="text-secondary-500 fa-solid fa-star-sharp"></i><i class="text-secondary-500 fa-solid fa-star-sharp"></i><i class="text-secondary-500 fa-solid fa-star-sharp"></i><i class="text-secondary-500 fa-solid fa-star-sharp"></i><i class="text-secondary-500 fa-solid fa-star-sharp"></i>';
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
