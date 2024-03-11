<?php
// REMOVE BEFORE GOING TO PRODUCTION
/**
 * Implement the Custom Header feature.
 */
//require get_stylesheet_directory_uri() . '/inc/custom-header.php';
//require get_stylesheet_directory_uri() . '/inc/template-tags.php';
//require get_stylesheet_directory_uri() . '/inc/template-functions.php';
//require get_stylesheet_directory_uri() . '/inc/customizer.php';


// Content
require_once 'includes/hooks.php';
require_once 'includes/shared.php';
require_once 'includes/content.php';
require_once 'includes/helpers.php';
require_once 'includes/helpers_legacy.php';
require_once 'includes/regions.php';
require_once 'includes/types.php';
require_once 'includes/hero.php';
require_once 'includes/forms.php';

// Custom admin styles and scripts
function admin_style()
{
    wp_enqueue_style('admin', get_stylesheet_directory_uri() . '/css/admin.css');
    wp_enqueue_script('admin-js', get_stylesheet_directory_uri() . '/js/admin.js');
}
add_action('admin_enqueue_scripts', 'admin_style');

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init()
{

    // Check function exists.
    if (function_exists('acf_add_options_page')) {

        // Add parent.
        $parent = acf_add_options_page(array(
            'page_title'  => __('Global'),
            'menu_title'  => __('Global'),
            'redirect'    => false,
        ));
        $child = acf_add_options_page(array(
            'page_title'  => __('Navigation'),
            'menu_title'  => __('Navigation'),
            'parent_slug' => $parent['menu_slug'],
        ));
        $child = acf_add_options_page(array(
            'page_title'  => __('Gravity Forms'),
            'menu_title'  => __('Form'),
            'parent_slug' => $parent['menu_slug'],
        ));
        $child = acf_add_options_page(array(
            'page_title'  => __('Postcards'),
            'menu_title'  => __('Postcards'),
            'parent_slug' => $parent['menu_slug'],
        ));
        $child = acf_add_options_page(array(
            'page_title'  => __('Testimonials'),
            'menu_title'  => __('Testimonials'),
            'parent_slug' => $parent['menu_slug'],
        ));
        $child = acf_add_options_page(array(
            'page_title'  => __('Cites & Regions'),
            'menu_title'  => __('Regions'),
            'parent_slug' => $parent['menu_slug'],
        ));
        $child = acf_add_options_page(array(
            'page_title'  => __('Trip Types'),
            'menu_title'  => __('Trips'),
            'parent_slug' => $parent['menu_slug'],
        ));
        $child = acf_add_options_page(array(
            'page_title'  => __('Shared - PPC'),
            'menu_title'  => __('Shared - PPC'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }
}

// style and scripts
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles()
{
    // style.css
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    // custom.js
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', false, '', true);

    // Locations
    if (is_tax('location_region') || is_singular('location')) {
        wp_enqueue_script('location-region-js', get_stylesheet_directory_uri() . '/js/location-region.js', false, '', true);
    }

    // Compiled main.css
    $modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/css/main.css'));
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', array('parent-style'), $modified_bootscoreChildCss);


    if (is_singular('location') || is_tax('location_region') || is_singular('package') || is_page(30385)) {
        wp_enqueue_script('destinations-js', get_stylesheet_directory_uri() . '/js/destinations.js', false, '', true);
        wp_enqueue_script('bs5-lightbox', get_stylesheet_directory_uri() . '/js/bs5-lightbox.js', ['bootstrap'], '', true);
    }

    // Modal + Gravity Form
    wp_enqueue_script('gravity', get_stylesheet_directory_uri() . '/js/gravity.js', array('jquery'));
    //    wp_enqueue_script('mh_modal_new', get_stylesheet_directory_uri() . '/js/modal-form-new.js', array( 'jquery' ) );
    wp_enqueue_style('gravity_forms_styles', get_stylesheet_directory_uri() . '/css/gf/formsmain.css');
    wp_enqueue_style('gravity_forms_ready', get_stylesheet_directory_uri() . '/css/gf/readyclass.css');
    wp_enqueue_style('modal_form', get_stylesheet_directory_uri() . '/css/form-legacy.css');
    wp_enqueue_style('modal_modal', get_stylesheet_directory_uri() . '/css/modal-legacy.css');
    wp_enqueue_style('gravity_forms', get_stylesheet_directory_uri() . '/css/gravity-forms.css');


    // Timeline (Itineraries)
    wp_enqueue_style('wpex-ex_s_lick', get_stylesheet_directory_uri() . '/mh/timeline/wpex-ex_s_lick.css');
    wp_enqueue_style('wpex-ex_s_lick-theme', get_stylesheet_directory_uri() . '/mh/timeline/wpex-ex_s_lick-theme.css');
    wp_enqueue_style('wpex-horiz-css', get_stylesheet_directory_uri() . '/mh/timeline/wpex-horiz-css.css');
    wp_enqueue_style('wpex-timeline-animate-css', get_stylesheet_directory_uri() . '/mh/timeline/wpex-timeline-animate-css.css');
    wp_enqueue_style('wpex-timeline-css', get_stylesheet_directory_uri() . '/mh/timeline/wpex-timeline-css.css');
    wp_enqueue_style('wpex-timeline-sidebyside', get_stylesheet_directory_uri() . '/mh/timeline/wpex-timeline-sidebyside.css');
    wp_enqueue_script('ex_s_lick', get_stylesheet_directory_uri() . '/mh/timeline/ex_s_lick.js', array('jquery'));
    wp_enqueue_script('template', get_stylesheet_directory_uri() . '/mh/timeline/template.js', array('jquery'));
    wp_enqueue_script('mh_custom_scripts', get_stylesheet_directory_uri() . '/mh/includes/custom_scripts.js', array('jquery'));
}

function meks_which_template_is_loaded()
{
    if (is_super_admin()) {
        global $template;
        /*        highlight_string("<?php\n\$template =\n" . var_export($template, true) . ";\n?>");*/
    }
}

add_action('wp_footer', 'meks_which_template_is_loaded');


function mh_conditional_script_loading()
{
    if (!is_admin()) {
        wp_enqueue_style('theme-design', get_stylesheet_directory_uri() . '/css/soft-design-system-pro.css');
        wp_enqueue_style('custom-styles', get_stylesheet_directory_uri() . '/css/custom.css');
        wp_enqueue_style('hero-styles', get_stylesheet_directory_uri() . '/css/hero.css');
        wp_enqueue_style('open-sans-webfonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap');
        wp_enqueue_style('courgette-webfonts', 'https://fonts.googleapis.com/css2?family=Courgette&display=swap');
    }
}
add_action('wp_enqueue_scripts', 'mh_conditional_script_loading');
