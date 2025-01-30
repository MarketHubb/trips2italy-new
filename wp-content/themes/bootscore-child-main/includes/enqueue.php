<?php
/**
 * Enqueue all styles and scripts in one place.
 *
 * We hook them all onto wp_enqueue_scripts with separate functions
 * for clarity, but everything is in this one file now.
 */

// SECURITY: Prevent direct access.
if (! defined('ABSPATH')) {
    exit;
}

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('admin', get_stylesheet_directory_uri() . '/css/admin.css');
    wp_enqueue_script('admin-js', get_stylesheet_directory_uri() . '/js/admin.js');
});


/**
 * 1) Load Child Theme Scripts & Styles (formerly bootscore_child_enqueue_styles)
 */
function bootscore_child_enqueue_styles()
{

    // Only load on the front end
    if (! is_admin()) {
        // Nav / general
        wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', [], null, true);
    }

    // Campaign (promotional) pages
    if (is_page_template('page-templates/flexible.php') || is_singular('campaign')) {
        wp_enqueue_script('campaign-js', get_stylesheet_directory_uri() . '/js/campaign.js', [], null, true);
    }

    // Trip Type (Single)
    if (is_singular('trip')) {
        wp_enqueue_script('features-image-top', get_stylesheet_directory_uri() . '/js/features-image-top.js', [], null, true);
    }

    // Locations
    if (is_tax('location_region') || is_singular('location') || is_singular('trip')) {
        wp_enqueue_script('location-region-js', get_stylesheet_directory_uri() . '/js/location-region.js', [], null, true);
        wp_enqueue_script('nav-js', get_stylesheet_directory_uri() . '/js/nav.js', [], null, true);
    }

    // Sliders (exclude the special page 28484)
    if (! is_admin() && ! is_page(28484)) {
        wp_enqueue_script('sliders-js', get_stylesheet_directory_uri() . '/js/sliders.js', [], null, true);
        wp_enqueue_script('scroller-js', get_stylesheet_directory_uri() . '/js/scroller.js', [], null, true);
        wp_enqueue_script('modal-js', get_stylesheet_directory_uri() . '/js/modal.js', [], null, true);
    }

    // Main compiled CSS (with filemtime for cache-busting)
    $modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/css/main.css'));
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', ['parent-style'], $modified_bootscoreChildCss);

    // Destination scripts
    if (is_singular('location') || is_tax('location_region') || is_singular('package') || is_page(30385)) {
        wp_enqueue_script('destinations-js', get_stylesheet_directory_uri() . '/js/destinations.js', [], null, true);
        wp_enqueue_script('bs5-lightbox', get_stylesheet_directory_uri() . '/js/bs5-lightbox.js', ['bootstrap'], null, true);
    }

    // Gravity Form + Modal
    wp_enqueue_script('gravity', get_stylesheet_directory_uri() . '/js/gravity.js', ['jquery'], null, true);
    wp_enqueue_style('gravity_forms_styles', get_stylesheet_directory_uri() . '/css/gf/formsmain.css', [], null);
    wp_enqueue_style('gravity_forms_ready', get_stylesheet_directory_uri() . '/css/gf/readyclass.css', [], null);
    wp_enqueue_style('modal_modal', get_stylesheet_directory_uri() . '/css/modal-legacy.css', [], null);

    // Timeline (Itineraries)
    wp_enqueue_style('wpex-ex_s_lick', get_stylesheet_directory_uri() . '/mh/timeline/wpex-ex_s_lick.css');
    wp_enqueue_style('wpex-ex_s_lick-theme', get_stylesheet_directory_uri() . '/mh/timeline/wpex-ex_s_lick-theme.css');
    wp_enqueue_style('wpex-horiz-css', get_stylesheet_directory_uri() . '/mh/timeline/wpex-horiz-css.css');
    wp_enqueue_style('wpex-timeline-animate-css', get_stylesheet_directory_uri() . '/mh/timeline/wpex-timeline-animate-css.css');
    wp_enqueue_style('wpex-timeline-css', get_stylesheet_directory_uri() . '/mh/timeline/wpex-timeline-css.css');
    wp_enqueue_style('wpex-timeline-sidebyside', get_stylesheet_directory_uri() . '/mh/timeline/wpex-timeline-sidebyside.css');
    wp_enqueue_script('ex_s_lick', get_stylesheet_directory_uri() . '/mh/timeline/ex_s_lick.js', ['jquery'], null, true);
    wp_enqueue_script('template', get_stylesheet_directory_uri() . '/mh/timeline/template.js', ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');

/**
 * 2) Custom Tracking Scripts (user-flow & thank-you analytics)
 */
function enqueue_custom_tracking_scripts()
{
    // Get the current page ID
    $current_page_id = get_queried_object_id();

    // Enqueue user-flow.js on all pages EXCEPT thank you page (ID 32250)
    if ($current_page_id != 32250) {
        wp_enqueue_script(
            'user-flow-tracking',
            get_stylesheet_directory_uri() . '/js/user-flow.js',
            [],
            '1.0.0',
            true
        );
    }

    // Enqueue analytics.js ONLY on thank you page
    if ($current_page_id == 32250) {
        wp_enqueue_script(
            'thank-you-analytics',
            get_stylesheet_directory_uri() . '/js/analytics.js',
            [],
            '1.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_tracking_scripts');

/**
 * 3) MH Conditional Script Loading
 *    (Originally in enqueue.php)
 */
function mh_conditional_script_loading()
{
    if (! is_admin()) {
        wp_enqueue_style('theme-design', get_stylesheet_directory_uri() . '/css/soft-design-system-pro.css');
        wp_enqueue_style('custom-styles', get_stylesheet_directory_uri() . '/css/custom.css', ['tailwind-css']);
        wp_enqueue_style('hero-styles', get_stylesheet_directory_uri() . '/css/hero.css');
    }
}
// Priority 10 by default
add_action('wp_enqueue_scripts', 'mh_conditional_script_loading');

/**
 * 4) Tailwind & Related
 */
function enqueue_tailwind()
{
    // Tailwind CSS
    wp_enqueue_style('tailwind-css', get_stylesheet_directory_uri() . '/css/tailwind.css', [], null);
    wp_enqueue_style('tailwind-overrides', get_stylesheet_directory_uri() . '/css/tailwind-overrides.css', ['tailwind-css'], null);

    // Scripts
    wp_enqueue_script('animations', get_stylesheet_directory_uri() . '/js/animations.js', [], null, false);
    wp_enqueue_script('tailwind-modal', get_stylesheet_directory_uri() . '/js/tw-modal.js', [], null, false);

    // Custom Itinerary
    if (is_page(28484)) {
        wp_enqueue_script('tailwind-form', get_stylesheet_directory_uri() . '/js/tw-form.js', [], null, false);
        // Localize for Ajax
        wp_localize_script('tailwind-form', 'ajax_object', [
            'ajax_url' => admin_url('admin-ajax.php')
        ]);
    }

    // Regions (Parent)
    if (is_page(27712)) {
        wp_enqueue_script('locations', get_stylesheet_directory_uri() . '/js/locations.js', [], null, false);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_tailwind', 999);

/**
 * 5) Enqueue Preline script (check if it exists in node_modules)
 */
function enqueue_preline_script()
{
    // WordPress root
    $website_root = ABSPATH;
    $preline_path = $website_root . 'node_modules/preline/dist/preline.js';

    if (file_exists($preline_path)) {
        // Convert local path to URL
        $preline_url = str_replace(ABSPATH, site_url('/'), $preline_path);
        wp_enqueue_script('preline', $preline_url, [], '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_preline_script');

/**
 * 6) Dequeue unused assets (especially on flexible template)
 */
function dequeue_unused_assets()
{
    // If you wanted to remove some styles/scripts conditionally
    $template_slug = get_page_template_slug();

    if ($template_slug === 'page-templates/flexible.php') {
        // Gravity Forms CSS
        // wp_dequeue_style('gform_basic');
        // wp_dequeue_style('gform_theme_components');
        // wp_dequeue_style('gform_theme');

        // Example of removing a script from a plugin
        wp_dequeue_script('genesis-blocks-dismiss-js');
    }
}
add_action('wp_enqueue_scripts', 'dequeue_unused_assets', 9999);

/**
 * 7) Disable specific Gravity Forms CSS
 */
add_filter('gform_disable_css', function ($disable) {
    if (is_page_template('page-templates/flexible.php')) {
        return true;
    }
    return $disable;
});
add_filter('gform_disable_basic_css', '__return_true');
add_filter('gform_disable_theme_css', '__return_true');

/**
 * 8) Optional: (Commented out) FontAwesome kit
 *
 * add_action('wp_enqueue_scripts', function () {
 *     wp_enqueue_script(
 *         'font-awesome-6',
 *         'https://kit.fontawesome.com/a55bd0b564.js',
 *         array(),
 *         null,
 *         true
 *     );
 * });
 */

// function enqueue_recaptcha_v3_script()
// {

//  if (is_page(28484)) {
//      $site_key = str_contains(get_home_url(), 'test') ? '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe' : '6LeR7DcqAAAAAPttcbdc0H68FhMR5C6Y6Ka8x9B0';

//      // Enqueue the Google reCAPTCHA API script
//      wp_enqueue_script('google-recaptcha-v3', 'https://www.google.com/recaptcha/api.js?render=' . $site_key, array(), null, true);

//      // Add custom inline JavaScript to handle token generation
//      wp_add_inline_script('google-recaptcha-v3', "
//         grecaptcha.ready(function() {
//             grecaptcha.execute('" . esc_js($site_key) . "', { action: 'submit' }).then(function(token) {
//                 document.getElementById('g-recaptcha-response').value = token;
//             });
//         });
//     ");
//  }
// }
// add_action('wp_enqueue_scripts', 'enqueue_recaptcha_v3_script');
