<?php
/*
* Helper Functions
*/
require_once 'helpers.php';

/*
* Enqueue Styles & Scripts
*/

// Global
if (strpos(get_home_url(), 'test') !== false) {
    wp_enqueue_style('mh_local_styles', get_stylesheet_directory_uri() . '/mh/includes/local_styles.css');
}
// Template: Flexible
if (is_page(24876)) {
    wp_enqueue_style('mh_custom_fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap', false);
    wp_enqueue_style('mh_custom_styles', get_stylesheet_directory_uri() . '/mh/includes/custom_styles.css');
    wp_enqueue_script('mh_custom_scripts', get_stylesheet_directory_uri() . '/mh/includes/custom_scripts.js', array( 'jquery' ) );
}
?>
