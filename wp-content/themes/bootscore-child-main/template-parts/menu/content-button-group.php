<?php if (isset($args)) { ?>
    <section class="mt-5 mb-4">
        <div class="container">
            <div class="row ">
                <div class="col-12 mx-auto ">
                    
                    <?php 
                    $obj = get_query_var('postObj');
                    $permalink = ($obj->post_type) ? get_permalink($obj->ID) : get_term_link($obj->term_id);
                    $location = $args['location'];
                    ?>

                    <div class="d-flex region-tabs">

                        <?php
                        $tabs = '';
                        $tabs_mobile  = '<div class="d-block d-md-none col-12 mx-auto">';
                        $tabs_mobile .= '<select class="form-control fw-700" name="choice-button" id="location_select" placeholder="Language">';

                        foreach ($args['pages'] as $tab_input) {
                            $btn_active_class = ($permalink === $tab_input['permalink']) ? "page-active" : "";

                            $tabs .= '<div class="d-none d-md-block flex-equal text-center ' . $btn_active_class . '">';
                            $tabs .= '<img src="' . $tab_input['icon'] . '" alt="" class="region-icons d-block mx-auto">';
                            $tabs .= '<a class="d-flex flex-column justify-content-center align-items-center fw-bold py-3 rounded lh-1" href="' . $tab_input['permalink'] . '">';
                            $tabs .= '<span class="tab-name d-block text-uppercase text-sm ">';
                            $tabs .= $location . '</span>';
                            $tabs .= '<span class="tab-name text-1 fw-bolder">';
                            $tabs .= $tab_input['name'] . '</span></a></div>';

                            $mobile_name = $location . ' ' . $tab_input['name'];

                            $tabs_mobile .= '<option class="text-center" value="' . $tab_input['permalink'] . '">';
                            $tabs_mobile .= $mobile_name . '</option>';
                        }

                        $tabs_mobile .= '</select></div>';

                        echo $tabs;
                        echo $tabs_mobile;
                        ?>


                    </div>

                </div>
            </div>
        </div>
    </section>
<?php } ?>
