<section class="pt-3 pb-4" id="count-stats">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 z-index-2 border-radius-xl mt-n10 mx-auto py-3 blur shadow-blur">
                <div class="row">

                    <?php
                    if( have_rows('stats', $post->ID) ):
                        $stats = '';
                        while ( have_rows('stats', $post->ID) ) : the_row();
                            $stats .= '<div class="col-md-4 position-relative">';
                            $stats .= '<div class="p-3 text-center">';
                            $stats .= '<h1 class="text-gradient text-primary"><span id="state1" countto="">' . get_sub_field('heading', $post->ID) . '</span></h1>';
                            $stats .= '<h5 class="mt-3">' . get_sub_field('subheading', $post->ID) . '</h5>';
                            $stats .= '<p class="text-sm">' . get_sub_field('description', $post->ID) . '</p>';
                            $stats .= '</div><hr class="vertical dark"></div>';
                        endwhile;
                        echo $stats;
                    endif;
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>