<?php
$post_id = get_query_var('post_id');
$benefits_image = empty(get_field('page_benefits_image')) ? get_field('global_benefits_image', 'option') : get_field('page_benefits_image', $post_id);
?>
<div class="modal fade modal-request" id="modalppc"
     data-id="8"
     tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     data-button="Get My Free Itinerary" data-currentmonth="<?php echo date('M'); ?>">

    <div class="modal-dialog  modal-xl " role="document">
        <!--    <div class="modal-dialog modal-xl" role="document">-->

        <?php
        $modal_bg = get_home_url() . '/wp-content/uploads/2023/05/Modal-Desktop.jpg';
        $modal_mobile_bg = get_home_url() . '/wp-content/uploads/2023/05/Modal-Mobile.jpg';
        ?>

<!--        <div class="modal-content has-background-image" style="background-image: url('--><?php //echo $modal_bg; ?>/*');">*/
        <div class="modal-content has-background-image" style="background-image: url('<?php echo $modal_bg; ?>');">

            <div class="modal-bg-color">

                <div class="modal-content-container">

                    <div class="modal-header">
                        <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="container-fluid">

                            <div class="row justify-content-center">

                                <div class="col-11 col-md-9 col-lg-8" id="form-container">

                                    <?php get_template_part('template-parts/modal/content', 'logo'); ?>

                                    <?php get_template_part('template-parts/modal/content', 'intro'); ?>

                                    <?php get_template_part('template-parts/modal/content', 'tracker'); ?>

                                    <?php get_template_part('template-parts/modal/content', 'question-when'); ?>

                                    <?php get_template_part('template-parts/modal/content', 'form'); ?>

                                    <?php get_template_part('template-parts/modal/content', 'button'); ?>

                                    <?php get_template_part('template-parts/modal/content', 'callouts'); ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

