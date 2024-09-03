<?php
function return_url_query_params() {
    $url = $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $components = parse_url($url);
    parse_str($components['query'], $results);

    return $results;
}
function get_truncated_string($str, $chars, $to_space, $replacement="...")
{
    if($chars > strlen($str)) return $str;

    $str = substr($str, 0, $chars);
    $space_pos = strrpos($str, " ");

    if($to_space && $space_pos >= 0)
        $str = substr($str, 0, strrpos($str, " "));

    return($str . $replacement);
}
function return_cta_btn($args) {

    $type = $args['type'] === 'button' ? 'button' : 'a';

    $btn = '<' . $type;

    if (!empty($args['attributes'])) {
        $btn .= ' ' .  trim($args['attributes']) . ' ';
    }

    $btn .= '>' . trim($args['text']) . '</' . $type . '>';

    return $btn;
}
function return_section_heading($heading, $subheading=null)
{
    $section_heading  = '<div class="row section-heading justify-content-center">';
    $section_heading .= '<div class="col-md-10 text-center">';
    $section_heading .= '<h2 class="font-weight-bold text-brand-500 mb-3">' . $heading . '</h2>';

    if ($subheading) {
        $section_heading .= '<p class="mb-0 mb-md-3">' . $subheading. '</p>';
    }

    $section_heading .= '</div></div>';

    return $section_heading;
}


