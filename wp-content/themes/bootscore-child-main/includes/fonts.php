<?php 
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