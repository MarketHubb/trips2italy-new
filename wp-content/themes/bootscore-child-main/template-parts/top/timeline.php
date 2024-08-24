<?php $post_id = get_field('page_id', $post->ID); ?>
<!-- <div class="content-section bg-gray-100 py-7"> -->
<section class="py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto">
        <!-- Section Heading -->
        <!-- <div class="row section-heading justify-content-center"> -->
            <!-- <div class="pb-10"> -->
                <?php
                $section_heading = [
                    'heading' => 'Curious what our honeymoons are like?',
                    'subheading' => 'Explore this itinerary'
                ];
                ?>
                <?php echo tw_section_heading($section_heading); ?>
            <!-- </div> -->
        <!-- </div> -->
        <div class="container px-0">
            <div class="row">

                <div class="wpex horizontal-timeline wpex-horizontal-5 ex-multi-item  tlml-arrow-top wpex-horizontal-4" data-autoplay="0" data-speed="" data-rtl="" id="horizontal-tl-4785" data-id="horizontal-tl-4785" data-slidesshow="2" data-start_on="" data-infinite="">
                    <div class="hor-container">

                        <span class="timeline-hr"></span>

                        <ul class="horizontal-nav">

                            <!-- START: Loop -->
                            <?php
                            $id = get_field('itinerary');

                            if (have_rows('details', $id)) :
                                $d = '';
                                while (have_rows('details', $id)) : the_row();
                                    $image = get_sub_field('image') ? get_sub_field('image') : get_the_post_thumbnail(25631);


                                    $d .= '<li class="ictl-25612">';
                                    $d .= '<span class="tl-point wpex_point"><i class="fa fa-circle no-icon"></i>Day ' . get_row_index() . '</span>';
                                    $d .= '<div class="wpextt_templates">';
                                    $d .= '<div class="border-radius-lg p-4 pt-5 shadow-sm post-25612 wp-timeline type-wp-timeline status-publish has-post-thumbnail hentry wpex_category-honeymoon" id="wpextt_content-25612" style=" ">';
                                    $d .= '<div class="wpex-timeline-label">';
                                    $d .= '<div class="timeline-media">';
                                    $d .= '<a class="text-xl lg:text-2xl" href="javascript:;" title="Day ' . get_row_index() . '">';

                                    $d .= '<img width="600" height="400" ';
                                    $d .= 'src="' . get_sub_field('image') . '" ';
                                    $d .= 'class="attachment-wptl-600x450 size-wptl-600x450 wp-post-image shadow rounded" alt="" loading="lazy" ';
                                    $d .= 'srcset="' . get_sub_field('image') . ' 600w, ';
                                    $d .= add_image_size(get_sub_field('image'), 300, 200) . ' 300w, ';
                                    $d .= add_image_size(get_sub_field('image'), 350, 233) . ' 350w" ';
                                    $d .= 'sizes="(max-width: 600px) 100vw, 600px">';

                                    $d .= '<span class="bg-opacity"></span>';
                                    $d .= '</a></div>';
                                    $d .= '<div class="timeline-details">';
                                    //                            $d .= '<h2 class="heading-font d-inline pe-2"><a href="javascript:;" title="Day ' . get_row_index() . '">Day ' . get_row_index() . ':</a></h2>';
                                    $d .= '<h3 class="mb-2 stylized text-2xl lg:text-4xl">';
                                    //                            $d .= '<i class="fa-duotone fa-map-pin me-3 fs-4 transform-347" style="--fa-primary-color: orangered;"></i>';
                                    $d .= get_sub_field('location') . '</h3>';
                                    $d .= '<div class="wptl-more-meta d-none">';
                                    $d .= '</div>';

                                    $d .= '<div class="wptl-excerpt">';
                                    $d .= '<h4 class="font-semibold text-lg lg:text-xl mb-2">' . get_sub_field('heading') . '</h4>';
                                    $d .= '<p class="day-description text-base lg:text-lg ">' . get_sub_field('description') . '</p>';

                                    $d .= '</div></div>';
                                    $d .= ' <div class="exclearfix"></div>';
                                    $d .= '</div></div></div></li>';

                                endwhile;
                                echo $d;
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
</section>