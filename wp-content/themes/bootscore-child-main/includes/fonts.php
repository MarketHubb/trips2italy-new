<?php 
/*
Enqueue custom fonts
*/
function enqueue_custom_fonts() {
    wp_enqueue_style('custom-fonts', get_stylesheet_directory_uri() . '/css/fonts.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_fonts');

function enqueue_project_web_fonts() {
    wp_enqueue_style('adobe-fonts', 'https://use.typekit.net/ncd8wmg.css', array(), null);
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap', array(), null);
    // wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap', array(), null);

}
add_action('wp_enqueue_scripts', 'enqueue_project_web_fonts');