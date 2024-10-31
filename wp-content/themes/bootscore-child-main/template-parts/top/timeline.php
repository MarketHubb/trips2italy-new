<?php if (empty($args)) return; ?>
<?php $post_id = get_field('page_id', $post->ID); ?>

<?php //echo tw_section_open(['px-6 lg:px-0 py-16 md:py-24 relative bg-gray-50']) 
?>
<?php echo tw_section_open($args) ?>

<?php echo tw_container_open(); ?>

<?php
$section_heading = tw_output_heading($args);
if ($section_heading) echo $section_heading;
?>



<div class="container px-0">
    <div class="row">

        <div class="wpex horizontal-timeline wpex-horizontal-5 ex-multi-item  tlml-arrow-top wpex-horizontal-4" data-autoplay="0" data-speed="" data-rtl="" id="horizontal-tl-4785" data-id="horizontal-tl-4785" data-slidesshow="2" data-start_on="" data-infinite="">
            <div class="hor-container">

                <span class="w-[93%] sm:w-[94%] md:w-[95%] lg:w-[96%] xl:w-[98%] !border-b-gray-200 timeline-hr after:content-[none] before:content-[none]"></span>

                <ul class="horizontal-nav">

                    <!-- START: Loop -->
                    <?php
                    $id = get_field('itinerary');

                    if (have_rows('details', $id)) :
                        $d = '';
                        while (have_rows('details', $id)) : the_row();
                            $image = get_sub_field('image') ? get_sub_field('image') : get_the_post_thumbnail(25631);


                            $d .= '<li class="ictl-25612 text-base">';
                            $d .= '<span class="stylized text-[160%] text-brand-700 tl-point wpex_point"><i class="fa fa-circle no-icon"></i>Day ' . get_row_index() . '</span>';
                            $d .= '<div class="wpextt_templates !px-[20px]">';
                            $d .= '<div class="border-radius-lg p-4 pt-5 post-25612 wp-timeline type-wp-timeline status-publish has-post-thumbnail hentry wpex_category-honeymoon" id="wpextt_content-25612" style=" ">';
                            $d .= '<div class="wpex-timeline-label">';
                            $d .= '<div class="timeline-media">';
                            $d .= '<a class="text-xl lg:text-2xl" href="javascript:;" title="Day ' . get_row_index() . '">';

                            $d .= '<img ';
                            $d .= 'src="' . get_sub_field('image') . '" ';
                            $d .= 'class="attachment-wptl-600x450 size-wptl-600x450 !h-[250px] !w-full object-cover object-center wp-post-image shadow rounded" alt="" loading="lazy" ';
                            $d .= 'srcset="' . get_sub_field('image') . ' 600w, ';
                            $d .= add_image_size(get_sub_field('image'), 300, 200) . ' 300w, ';
                            $d .= add_image_size(get_sub_field('image'), 350, 233) . ' 350w" ';
                            $d .= 'sizes="(max-width: 600px) 100vw, 600px">';

                            $d .= '<span class="bg-opacity"></span>';
                            $d .= '</a></div>';
                            $d .= '<div class="timeline-details !text-left mx-auto !px-0 !pt-4">';
                            $d .= '<h3 class="mb-4 stylized text-xl lg:text-2xl text-center text-secondary-500">';
                            $d .= get_sub_field('location') . '</h3>';
                            $d .= '<div class="wptl-more-meta d-none">';
                            $d .= '</div>';

                            $d .= '<div class="wptl-excerpt">';
                            $d .= '<h4 class="font-semibold text-lg lg:text-xl mb-2">' . get_sub_field('heading') . '</h4>';
                            $d .= '<p class="day-description text-sm lg:text-[1.15rem] leading-normal ">' . get_sub_field('description') . '</p>';

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
<div class="max-w-3xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto text-center">
    <?php
    $cta_btn = tw_get_template_cta_btn($args);
    if ($cta_btn) echo $cta_btn;
    ?>
</div>

</div>
<!-- </div> -->
</section>