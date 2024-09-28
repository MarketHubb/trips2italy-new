<?php 
/*
Preload and enqueue custom "Merriweather" fonts
*/
$merriweather_fonts_to_preload = array(
    'Merriweather-Regular.woff2',
    'Merriweather-Bold.woff2'
);

foreach ($merriweather_fonts_to_preload as $font) {
    $font_url = get_template_directory_uri() . '/fonts/' . $font;
    echo "<link rel='preload' href='{$font_url}' as='font' type='font/woff2' crossorigin>\n";
}

/*
Preload and enqueue custom "Geist" fonts
*/

$fonts_to_preload = array(
    'Geist-Regular.woff2',
    'Geist-SemiBold.woff2',
    'Geist-Bold.woff2'
);

foreach ($fonts_to_preload as $font) {
    $font_url = get_stylesheet_directory_uri() . '/fonts/' . $font;
    echo "<link rel='preload' href='{$font_url}' as='font' type='font/woff2' crossorigin>\n";
}

/*
Enqueue custom fonts
*/
function enqueue_custom_fonts() {
    wp_enqueue_style('custom-fonts', get_stylesheet_directory_uri() . '/css/fonts.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_fonts');

function enqueue_adobe_fonts() {
    wp_enqueue_style('adobe-fonts', 'https://use.typekit.net/ncd8wmg.css', array(), null);
}
add_action('wp_enqueue_scripts', 'enqueue_adobe_fonts');