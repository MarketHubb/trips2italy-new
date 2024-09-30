<?php 
function enqueue_adobe_fonts() {
    wp_enqueue_style('adobe-fonts', 'https://use.typekit.net/ncd8wmg.css', array(), null);
}
add_action('wp_enqueue_scripts', 'enqueue_adobe_fonts');