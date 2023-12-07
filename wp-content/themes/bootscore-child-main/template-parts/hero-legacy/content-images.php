<?php $hero = $args; ?>

<div class="ps-5 pe-0 images <?php echo $hero['img_col']; ?>">

    <?php
    if (isset($hero['hero_masonry_images'])) {
        $output = '<div class="row">';
        $i = 1;
        $start_array = [1,2,4,6];
        $end_array = [3,5,7];

        foreach ($hero['hero_masonry_images'] as $image) {

            if ($i > 7) { break; }

            if (in_array($i, $start_array)) {
                $start = '<div class="col-lg-3 col-6">';
                $end = '';
            }
            if (in_array($i, $end_array)) {
                $start = '';
                $end = '</div>';
            }
            if ($i === 1) {
                $end = '</div>';
            }

            $classes = get_masonry_image_attributes($i);
            $images  = '<div class="d-inline-block">';
            $images .= '<img class="' . $classes . '" src="' . $image['hero_masonry_image'] . '" />';
            $images .= '</div>';

            $output .= $start . $images . $end;

            $i++;
        }
        $output .= '</div>';
        echo $output;
    }
//    if ($hero['hero_masonry_images']) {
//        $output = '<div class="row">';
//        $i = 1;
//        $start_array = [1,2,4,6];
//        $end_array = [3,5,7];
//
//        foreach ($hero['hero_masonry_images'] as $image) {
//
//            if (in_array($i, $start_array)) {
//                $start = '<div class="col-lg-3 col-6">';
//                $end = '';
//            }
//            if (in_array($i, $end_array)) {
//                $start = '';
//                $end = '</div>';
//            }
//            if ($i === 1) {
//                $end = '</div>';
//            }
//
//            $classes = get_masonry_image_attributes($i);
//            $images  = '<img class="' . $classes . '" src="' . $image['hero_masonry_image'] . '" />';
//
//            $output .= $start . $images . $end;
//
//            $i++;
//        }
//        $output .= '</div>';
//        echo $output;
//    }
    ?>

</div>