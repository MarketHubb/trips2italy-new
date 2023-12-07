<?php $trip_type = get_query_var('trip_type'); ?>
<div class="question-container" id="when" data-q="1">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-7">
            <h4 class="roboto fw-700 text-start text-white form-question-label">When would you like to go on your Italy <span class="text-lowercase"><?php echo $trip_type; ?></span>?
            </h4>
        </div>
    </div>
    <div class="row justify-content-center mt-4" id="departure-selection">
        <div class="col-md-6">
            <?php
            $trip_times = [];
            $trip_times[] = array(
                'text' => 'Very Soon',
                'callout' => 'In next 6 months',
                'desc' => date('F') . ' - ' . date('F, Y', strtotime("+6 months"))
            );
            $trip_times[] = array(
                'text' => 'This year',
                'callout' => '6-12 months from now',
                'desc' => date('F', strtotime("+7 months")) . ' - ' . date('F, Y', strtotime("+12 months")),
            );
            $trip_times[] = array(
                'text' => 'Next year',
                'callout' => '12 months or more from now',
                'desc' => date('F, Y', strtotime("+13 months")) . ' or later'
            );
            $trip_times[] = array(
                'text' => 'Not sure',
                'callout' => 'Still exploring my options',
                'desc' => 'No firm dates yet'
            );

            $trip_btns = '';
            foreach ($trip_times as $trip_time) {
                $trip_btns .= '<div class="text-center departure-question position-relative">';
                $trip_btns .= '<i class="fa-solid fa-circle-check fa-lg"></i>';
                $trip_btns .= '<div class="my-4">';
                $trip_btns .= '<h3 class=" text-uppercase fw-800 roboto">';
                $trip_btns .= $trip_time['text'];
                $trip_btns .= '</h3>';
                $trip_btns .= '<p class="mb-0 pb-0 fw-bolder lh-1">' . $trip_time['callout'] . '</p>';
                $trip_btns .= '<p class="mb-3"><small>' . $trip_time['desc'] . '</small></p>';
                $trip_btns .= '</div></div>';
            }
            echo $trip_btns;
            ?>

<!--            <button type="button" id="continue-1"-->
<!--                    class="btn btn-primary modal-cta w-100 fw-bolder" disabled>Continue-->
<!--            </button>-->

        </div>
    </div>
</div>
