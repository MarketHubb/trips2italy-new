<?php
add_action("wp_ajax_verify_recaptcha", "verify_recaptcha");
add_action("wp_ajax_nopriv_verify_recaptcha", "verify_recaptcha");

function verify_recaptcha()
{
    // Verify that the required parameters are set
    if (!isset($_POST["recaptcha_response"])) {
        wp_send_json_error(["error" => "reCAPTCHA response not set."]);
        wp_die();
    }

    $recaptcha_response = sanitize_text_field($_POST["recaptcha_response"]);
    $recaptcha_secret = "6LeR7DcqAAAAAPhlWk2Oz_LRO3BkGtrepU_1x7Mb";

    // Make a POST request to the reCAPTCHA API
    $verify_response = wp_remote_post(
        "https://www.google.com/recaptcha/api/siteverify",
        [
            "body" => [
                "secret" => $recaptcha_secret,
                "response" => $recaptcha_response,
            ],
        ]
    );

    if (is_wp_error($verify_response)) {
        wp_send_json_error(["error" => "Failed to verify reCAPTCHA."]);
        wp_die();
    }

    $response_body = wp_remote_retrieve_body($verify_response);
    $response_data = json_decode($response_body, true);

    if ($response_data["success"]) {
        wp_send_json_success([
            "message" => "reCAPTCHA verification successful.",
        ]);
    } else {
        wp_send_json_error(["error" => "reCAPTCHA verification failed."]);
    }

    wp_die();
}

add_action("wp_ajax_submit_custom_gravity_form", "submit_custom_gravity_form");
add_action(
    "wp_ajax_nopriv_submit_custom_gravity_form",
    "submit_custom_gravity_form"
);

function submit_custom_gravity_form()
{
    // Enable error reporting
    ini_set("display_errors", 1);
    ini_set("log_errors", 1);
    error_reporting(E_ALL);

    // Initialize an array to capture debug messages
    $debug_messages = [];

    // Verify nonce for security
    if (!check_ajax_referer("submit_custom_gravity_form", "nonce", false)) {
        wp_send_json_error(["error" => "Nonce verification failed."]);
        wp_die();
    }

    // Check if form_id is set
    if (!isset($_POST["form_id"])) {
        wp_send_json_error(["error" => "Form ID not set."]);
        wp_die();
    }

    $form_id = intval($_POST["form_id"]);

    // Load Gravity Forms if not already loaded
    if (!class_exists("GFAPI")) {
        require_once GFCommon::get_base_path() . "/gravityforms.php";
    }

    // Get the form
    $form = GFAPI::get_form($form_id);
    if (!$form) {
        wp_send_json_error(["error" => "Form not found."]);
        wp_die();
    }

    // Prepare the entry data
    $entry = [];

    if (isset($_POST["input_12"])) {
        $name = explode(" ", sanitize_text_field($_POST["input_12"]));
        if (isset($name[0])) {
            $entry["12.3"] = $name[0];
        }
        if (isset($name[1])) {
            $entry["12.6"] = $name[1];
        }
    }

    foreach ($_POST as $key => $val) {
        if (strpos($key, "input_") === 0) {
            $input_name = sanitize_text_field(
                str_replace("_", ".", substr($key, 6))
            );
            $input_value = sanitize_text_field($val);
            $entry[$input_name] = $input_value;
        }
    }

    // Add additional Gravity Forms data
    $entry["form_id"] = $form_id;
    $entry["ip"] = GFFormsModel::get_ip();
    $entry["source_url"] = esc_url_raw(wp_get_referer());
    $entry["user_agent"] = sanitize_text_field($_SERVER["HTTP_USER_AGENT"]);

    // Add the entry to Gravity Forms
    $result = GFAPI::add_entry($entry);

    $response = [
        "entry" => $entry,
        "result" => $result,
        "post" => $_POST,
    ];

    if (is_wp_error($result)) {
        $response["error"] = $result->get_error_message();
        wp_send_json_error($response);
    } else {
        // Add the entry ID to the entry array
        $entry['id'] = $result;

        // Capture feed execution and errors
        add_action('gform_after_feed_execution', function($feed, $entry, $form) use (&$debug_messages) {
            $debug_messages[] = "Feed executed: " . $feed['addon_slug'];
        }, 10, 3);

        add_action('gform_feed_error', function($feed, $entry, $form, $error) use (&$debug_messages) {
            $debug_messages[] = "Feed error in " . $feed['addon_slug'] . ": " . $error->getMessage();
        }, 10, 4);

        // Trigger the gform_after_submission action to process feeds
        do_action('gform_after_submission', $entry, $form);

        // Existing code to send notifications and handle confirmation
        GFAPI::send_notifications($form, $entry);
        $confirmation_id = key($form['confirmations']);
        $confirmation = $form['confirmations'][$confirmation_id];

        // Prepare the confirmation response
        if ($confirmation['type'] == 'page') {
            $pageId = $confirmation['pageId'];
            $queryString = $confirmation['queryString'];

            // Replace merge tags in queryString
            $queryString = GFCommon::replace_variables($queryString, $form, $entry, false, false, false, 'text');

            $redirectUrl = get_permalink($pageId);
            if ($queryString) {
                $redirectUrl .= (strpos($redirectUrl, '?') === false) ? '?' : '&';
                $redirectUrl .= $queryString;
            }

            // $response['redirect'] = $redirectUrl;
        } else {
            $response['confirmation'] = $confirmation['message'];
        }

        // Include debug messages in the response
        $response['debug'] = $debug_messages;

        wp_send_json_success($response);
    }
    wp_die();
}

// function submit_custom_gravity_form()
// {
//     // Enable error reporting
//     ini_set("display_errors", 1);
//     ini_set("log_errors", 1);
//     error_reporting(E_ALL);

//     // Verify nonce for security
//     if (!check_ajax_referer("submit_custom_gravity_form", "nonce", false)) {
//         wp_send_json_error(["error" => "Nonce verification failed."]);
//         wp_die();
//     }

//     // Check if form_id is set
//     if (!isset($_POST["form_id"])) {
//         wp_send_json_error(["error" => "Form ID not set."]);
//         wp_die();
//     }

//     $form_id = intval($_POST["form_id"]);

//     // Load Gravity Forms if not already loaded
//     if (!class_exists("GFAPI")) {
//         require_once GFCommon::get_base_path() . "/gravityforms.php";
//     }

//     // Get the form
//     $form = GFAPI::get_form($form_id);
//     if (!$form) {
//         wp_send_json_error(["error" => "Form not found."]);
//         wp_die();
//     }

//     // Prepare the entry data
//     $entry = [];

//     if (isset($_POST["input_12"])) {
//         $name = explode(" ", sanitize_text_field($_POST["input_12"]));
//         if (isset($name[0])) {
//             $entry["12.3"] = $name[0];
//         }
//         if (isset($name[1])) {
//             $entry["12.6"] = $name[1];
//         }
//     }

//     foreach ($_POST as $key => $val) {
//         if (strpos($key, "input_") === 0) {
//             $input_name = sanitize_text_field(
//                 str_replace("_", ".", substr($key, 6))
//             );
//             $input_value = sanitize_text_field($val);
//             $entry[$input_name] = $input_value;
//         }
//     }

//     // Add additional Gravity Forms data
//     $entry["form_id"] = $form_id;
//     $entry["ip"] = GFFormsModel::get_ip();
//     $entry["source_url"] = esc_url_raw(wp_get_referer());
//     $entry["user_agent"] = sanitize_text_field($_SERVER["HTTP_USER_AGENT"]);

//     // Return the entry data for debugging before calling GFAPI::add_entry

//     // Add the entry to Gravity Forms
//     $result = GFAPI::add_entry($entry);

//     $response = [
//         "entry" => $entry,
//         "result" => $result,
//         "post" => $_POST,
//     ];

//     if (is_wp_error($result)) {
//         $response["error"] = $result->get_error_message();
//         wp_send_json_error($response);
//     } else {
//         // Add the entry ID to the entry array
//         $entry['id'] = $result;

//         // Trigger the gform_after_submission action to process feeds
//         do_action('gform_after_submission', $entry, $form);

//         // Existing code to send notifications and handle confirmation
//         GFAPI::send_notifications($form, $entry);
//         $confirmation_id = key($form['confirmations']);
//         $confirmation = $form['confirmations'][$confirmation_id];

//         // Prepare the confirmation response
//         if ($confirmation['type'] == 'page') {
//             $pageId = $confirmation['pageId'];
//             $queryString = $confirmation['queryString'];

//             // Replace merge tags in queryString
//             $queryString = GFCommon::replace_variables($queryString, $form, $entry, false, false, false, 'text');

//             $redirectUrl = get_permalink($pageId);
//             if ($queryString) {
//                 $redirectUrl .= (strpos($redirectUrl, '?') === false) ? '?' : '&';
//                 $redirectUrl .= $queryString;
//             }

//             $response['redirect'] = $redirectUrl;
//         } else {
//             $response['confirmation'] = $confirmation['message'];
//         }

//         wp_send_json_success($response);
//     }
//     wp_die();
// }
