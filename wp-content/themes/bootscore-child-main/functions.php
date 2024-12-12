<?php
// Content
require_once 'includes/tailwind-content.php';
require_once 'includes/fonts.php';
require_once 'includes/ajax.php';
require_once 'includes/queries.php';
require_once 'includes/migrate.php';
require_once 'includes/hooks.php';
require_once 'includes/shared.php';
require_once 'includes/content.php';
require_once 'includes/tw-content.php';
require_once 'includes/helpers.php';
require_once 'includes/helpers_legacy.php';
require_once 'includes/regions.php';
require_once 'includes/types.php';
require_once 'includes/hero.php';
require_once 'includes/forms.php';
require_once 'includes/tw-forms.php';

// add_filter('gform_field_validation', 'custom_validation_slider', 10, 4);
// function custom_validation_slider($result, $value, $form, $field)
// {
// 	if ($form['id'] === 11 || $form['id'] === 13) {
// 		if ($field['id'] === 12 || $field['id'] === 14) {
// 			$result['is_valid'] = true;
// 			$result['message'] = 'Valid';
// 		}
// 	}
// 	return $result;
// }

// function enqueue_recaptcha_v3_script()
// {

// 	if (is_page(28484)) {
// 		$site_key = str_contains(get_home_url(), 'test') ? '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe' : '6LeR7DcqAAAAAPttcbdc0H68FhMR5C6Y6Ka8x9B0';

// 		// Enqueue the Google reCAPTCHA API script
// 		wp_enqueue_script('google-recaptcha-v3', 'https://www.google.com/recaptcha/api.js?render=' . $site_key, array(), null, true);

// 		// Add custom inline JavaScript to handle token generation
// 		wp_add_inline_script('google-recaptcha-v3', "
//         grecaptcha.ready(function() {
//             grecaptcha.execute('" . esc_js($site_key) . "', { action: 'submit' }).then(function(token) {
//                 document.getElementById('g-recaptcha-response').value = token;
//             });
//         });
//     ");
// 	}
// }
// add_action('wp_enqueue_scripts', 'enqueue_recaptcha_v3_script');


function meks_which_template_is_loaded()
{
	$domain = get_bloginfo('url');

	if (str_contains($domain, '.test')) {
		global $template;
	}
}

add_action('wp_footer', 'meks_which_template_is_loaded');

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
			'page_title' => __('Global'),
			'menu_title' => __('Global'),
			'redirect' => false,
		));
		$child = acf_add_options_page(array(
			'page_title' => __('Navigation'),
			'menu_title' => __('Navigation'),
			'parent_slug' => $parent['menu_slug'],
		));
		$child = acf_add_options_page(array(
			'page_title' => __('Gravity Forms'),
			'menu_title' => __('Form'),
			'parent_slug' => $parent['menu_slug'],
		));
		$child = acf_add_options_page(array(
			'page_title' => __('Packages'),
			'menu_title' => __('Packages'),
			'parent_slug' => $parent['menu_slug'],
		));
		$child = acf_add_options_page(array(
			'page_title' => __('Postcards'),
			'menu_title' => __('Postcards'),
			'parent_slug' => $parent['menu_slug'],
		));
		$child = acf_add_options_page(array(
			'page_title' => __('Testimonials'),
			'menu_title' => __('Testimonials'),
			'parent_slug' => $parent['menu_slug'],
		));
		$child = acf_add_options_page(array(
			'page_title' => __('Cites & Regions'),
			'menu_title' => __('Regions'),
			'parent_slug' => $parent['menu_slug'],
		));
		$child = acf_add_options_page(array(
			'page_title' => __('Trip Types'),
			'menu_title' => __('Trips'),
			'parent_slug' => $parent['menu_slug'],
		));
		$child = acf_add_options_page(array(
			'page_title' => __('Shared - PPC'),
			'menu_title' => __('Shared - PPC'),
			'parent_slug' => $parent['menu_slug'],
		));
	}
}

// style and scripts
function enqueue_tailwind()
{
	// Custom Itinerary
	if (is_page(28484)) {
		wp_enqueue_script('tailwind-form', get_stylesheet_directory_uri() . '/js/tw-form.js', [], null, false);
	}
	wp_enqueue_style('tailwind-css', get_stylesheet_directory_uri() . '/css/tailwind.css', array(), null, 'all');
	wp_enqueue_style('tailwind-overrides', get_stylesheet_directory_uri() . '/css/tailwind-overrides.css', array('tailwind-css'), null, 'all');
	wp_enqueue_script('animations', get_stylesheet_directory_uri() . '/js/animations.js', [], null, false);
	wp_enqueue_script('tailwind-modal', get_stylesheet_directory_uri() . '/js/tw-modal.js', [], null, false);
	wp_localize_script('tailwind-form', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

	// Regions (Parent)
	if (is_page(27712)) {
		wp_enqueue_script('locations', get_stylesheet_directory_uri() . '/js/locations.js', [], null, false);
	}
}
add_action('wp_enqueue_scripts', 'enqueue_tailwind', 999);

function enqueue_preline_script()
{
	// Get the website root path
	$website_root = ABSPATH;

	// Construct the path to the Preline script
	$preline_path = $website_root . 'node_modules/preline/dist/preline.js';

	// Check if the file exists
	if (file_exists($preline_path)) {
		// Convert the file path to a URL
		$preline_url = str_replace(ABSPATH, site_url('/'), $preline_path);

		// Enqueue the script
		wp_enqueue_script('preline', $preline_url, array(), '1.0.0', true);
	}
}
add_action('wp_enqueue_scripts', 'enqueue_preline_script');


add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles()
{
	// Navbar
	if (!is_admin()) {
		wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', false, '', true);
	}
	// Trip Type (Singular)
	if (is_singular('trip')) {
		wp_enqueue_script('features-image-top', get_stylesheet_directory_uri() . '/js/features-image-top.js', false, '', true);
	}
	// Locations
	if (is_tax('location_region') || is_singular('location') || is_singular('trip')) {
		wp_enqueue_script('location-region-js', get_stylesheet_directory_uri() . '/js/location-region.js', false, '', true);
		wp_enqueue_script('nav-js', get_stylesheet_directory_uri() . '/js/nav.js', false, '', true);
	}
	// Sliders
	if (!is_admin() && !is_page(28484)) {
		wp_enqueue_script('sliders-js', get_stylesheet_directory_uri() . '/js/sliders.js', false, '', true);
		wp_enqueue_script('scroller-js', get_stylesheet_directory_uri() . '/js/scroller.js', false, '', true);
		wp_enqueue_script('modal-js', get_stylesheet_directory_uri() . '/js/modal.js', false, '', true);
		// wp_enqueue_script('card-carousel-js', get_stylesheet_directory_uri() . '/js/card-carousel.js', false, '', true);
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

function mh_conditional_script_loading()
{
	if (!is_admin()) {
		wp_enqueue_style('theme-design', get_stylesheet_directory_uri() . '/css/soft-design-system-pro.css');
		wp_enqueue_style('custom-styles', get_stylesheet_directory_uri() . '/css/custom.css', ['tailwind-css']);
		wp_enqueue_style('hero-styles', get_stylesheet_directory_uri() . '/css/hero.css');
	}
}
add_action('wp_enqueue_scripts', 'mh_conditional_script_loading');


function enqueue_custom_tracking_scripts() {
    // Get the current page ID
    $current_page_id = get_queried_object_id();
    
    // Enqueue user-flow.js on all pages EXCEPT thank you page
    if ($current_page_id != 32250) {
        wp_enqueue_script(
            'user-flow-tracking',
            get_template_directory_uri() . '/js/user-flow.js',
            array(), // no dependencies
            '1.0.0', // version number
            true // load in footer
        );
    }
    
    // Enqueue analytics.js ONLY on thank you page
    if ($current_page_id == 32250) {
        wp_enqueue_script(
            'thank-you-analytics',
            get_template_directory_uri() . '/js/analytics.js',
            array(), // no dependencies
            '1.0.0', // version number
            true // load in footer
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_tracking_scripts');

