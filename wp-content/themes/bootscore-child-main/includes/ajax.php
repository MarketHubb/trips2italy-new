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
    $recaptcha_secret = "YOUR_RECAPTCHA_SECRET_KEY"; // Replace with your actual secret key

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
    $test = [];
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

    // Return the entry data for debugging before calling GFAPI::add_entry

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
        // Get the confirmation message
        $confirmation = GFFormDisplay::handle_confirmation($form, $entry);
        $response["confirmation"] = is_array($confirmation)
            ? $confirmation["message"]
            : $confirmation;
        wp_send_json_success($response);
    }

    wp_die();
}
