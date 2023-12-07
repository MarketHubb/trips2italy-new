<!-- Section: How it Works -->
<div class="content-section d-none">
    <div class="container" id="how">
        <!-- Section Heading -->
        <div class="row justify-content-center mb-3">
            <div class="col-md-9 text-center px-4 px-md-2 pb-4">
                <?php echo get_section_heading(get_field('how_heading'), get_field('how_subheading')); ?>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-lg-3 g-1">

            <?php
            if (have_rows('how')):
                $how = '';
                while (have_rows('how')) : the_row();
                    $how .= '<div class="col h-100 how-container">';
//                    $how .= '<div class=" py-4 py-lg-5">';
                    $how .= '<div class="d-flex align-items-center">';
                    $how .= '<div class="flex-shrink-0">';
                    $how .= '<i class="' . get_sub_field('icon') . ' text-blue fa-xl"></i>';
                    $how .= '</div>';
                    $how .= '<div class="flex-grow-1 ms-3">';
                    $how .= '<p class="lead mb-1 pb-0 fw-bold text-dark roboto">';
                    $how .= get_row_index() . ') ';
                    $how .= get_sub_field('title') . '</p>';
                    $how .= '</div></div>';
                    $how .= '<div class=" pb-4 pb-lg-5">';
                    $how .= '<p class="mb-0">' . get_sub_field('description') . '</p>';
                    $how .= '</div></div>';
                endwhile;
               // echo $how;
            endif;
            ?>

        </div>
    </div>
</div>

<div class="content-section">
    <div class="container my-4">
        <!-- Section Heading -->
        <div class="row justify-content-center mb-3">
            <div class="col-md-9 text-center px-4 px-md-2 pb-4">
                <?php echo get_section_heading(get_field('how_heading', 'option'), get_field('how_subheading', 'option')); ?>
                <p class="lead fs-4 fw-500 mb-0 mb-md-4"><?php the_field('how_description', 'option'); ?></p>
            </div>
        </div>

        <?php 
        if( have_rows('how_it_works', 'option') ):
            $h = '<div class="row row-cols-1 row-cols-lg-3 g-1 mb-0 mb-md-5">';
            while ( have_rows('how_it_works', 'option') ) : the_row();
                $h .= '<div class="col mb-4 mb-lg-0">';
                $h .= '<div class="card h-100 mx-md-2 shadow">';
                $h .= '<img src="' . get_sub_field('image') . '" class="card-img-top" alt="...">';
                $h .= '<div class="card-body p-4">';
                $h .= '<h3 class="card-title">' . get_sub_field('heading', 'option') . '</h3>';
                $h .= '<p class="card-title fst-italic mb-4">' . get_sub_field('description', 'option') . '</p>';

                if (get_sub_field('list_items', 'option')) {
                    $list = explode("\n", get_sub_field('list_items', 'option'));
                    $list = array_map('trim', $list);
                    if (is_array($list)) {
                        $h .= '<ul class="list-group list-group-flush flush ps-0 ms-0">';
                        foreach ($list as $item) {
                            $h .= '<li class="list-group-item ps-0 py-3"><p class="mb-0">' . $item . '</p></li>';
                        }
                    }
                    $h .= '</ul>';
                }

                $h .= '</div></div></div>';
            endwhile;
            $h .= '</div>';
            echo $h;
        endif;
        ?>
    </div>
</div>
