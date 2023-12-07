<?php
// Components
function single_card_waves($args = array()) {
    $card  = '<div class="card h-100 city-card">';
    $card .= '<img class="card-img-top" src="' . $args['image_url'] . '">';
    $card .= '<div class="position-relative overflow-hidden" style="height:50px;margin-top:-50px;">';
    $card .= '<div class="position-absolute w-100 top-0 z-index-1">';
    $card .= '<svg class="waves waves-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">';
    $card .= '<defs>';
    $card .= '<path id="card-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>';
    $card .= '</defs>';
    $card .= '<g class="moving-waves">';
    $card .= '<use xlink:href="#card-wave" x="48" y="-1" fill="rgba(255,255,255,0.30"></use>';
    $card .= '<use xlink:href="#card-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>';
    $card .= '<use xlink:href="#card-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>';
    $card .= '<use xlink:href="#card-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>';
    $card .= '<use xlink:href="#card-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>';
    $card .= '<use xlink:href="#card-wave" x="48" y="16" fill="rgba(255,255,255,0.99)"></use>';
    $card .= '</g>';
    $card .= '</svg>';
    $card .= '</div>';
    $card .= '</div>';
    $card .= '<div class="card-body">';

    if ($args['heading']) {
        $card .= $args['heading'];
    }
    if ($args['body']) {
        $card .= $args['body'];
    }
    $card .= '</div></div>';

    return $card;
}

function list_group_item($args = array()) {
    $list_item  = '<li class="list-group-item ps-0">';
    $list_item .= '<a class="fs-6" href="' . $args['url'] . '" >';
    $list_item .= $args['text'];
    $list_item .= '</a></li>';

    return $list_item;
}

// Text & Formatting
function clean_region_name($region) {
    $words_to_remove = ["Ultimate", "Travel", "Guide", "Italy", "For", "Vacation"];
    $region_words = explode(" ", $region);
    $region_clean = '';

    foreach ($region_words as $key => $val) {
        if (!in_array($val, $words_to_remove)) {
            $region_clean .= $val . ' ';
        }
    }

    return trim($region_clean);
}