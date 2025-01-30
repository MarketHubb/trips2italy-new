<?php
// region Styles & scripts
require_once 'includes/enqueue.php';
// endregion

// region Content sections
require_once 'includes/sections/config.php';
require_once 'includes/sections/flexible.php';
require_once 'includes/sections/queries.php';
require_once 'includes/sections/container.php';
require_once 'includes/sections/header.php';
require_once 'includes/sections/content.php';
require_once 'includes/sections/cta.php';
require_once 'includes/sections/helpers.php';
require_once 'includes/sections/render.php';
// endregion

// region Forms
require_once 'includes/forms/hooks.php';
// endregion

// region Shared
require_once 'includes/fonts.php';
require_once 'includes/ajax.php';
require_once 'includes/queries.php';
require_once 'includes/migrate.php';
require_once 'includes/hooks.php';
require_once 'includes/shared.php';
require_once 'includes/content.php';
require_once 'includes/tw-content.php';
require_once 'includes/helpers.php';
require_once 'includes/regions.php';
require_once 'includes/types.php';
require_once 'includes/hero.php';
require_once 'includes/forms.php';
require_once 'includes/tw-forms.php';
// endregion

function meks_which_template_is_loaded()
{
	$domain = get_bloginfo('url');

	if (str_contains($domain, '.test')) {
		global $template;
	}
}
add_action('wp_footer', 'meks_which_template_is_loaded');

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