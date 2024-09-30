<?php
function get_recaptcha_secret()
{
    if (str_contains(get_home_url(), '.test')) {
        return '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';
    }

    return '6LeR7DcqAAAAAPhlWk2Oz_LRO3BkGtrepU_1x7Mb';
}

function get_recaptcha_site()
{
    if (str_contains(get_home_url(), '.test')) {
        return '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
    }

    return '6LeR7DcqAAAAAPttcbdc0H68FhMR5C6Y6Ka8x9B0';
}

add_action("wp_ajax_verify_recaptcha", "verify_recaptcha");
add_action("wp_ajax_nopriv_verify_recaptcha", "verify_recaptcha");

function verify_recaptcha()
{
    // Verify that the required parameters are set
    if (!isset($_POST["token"])) {
        wp_send_json_error(["error" => "reCAPTCHA token not set."]);
        wp_die();
    }

    $recaptcha_response = sanitize_text_field($_POST["token"]);
    $recaptcha_secret = get_recaptcha_secret();

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
    $input_values = [];

    foreach ($_POST as $key => $val) {
        if (!empty($val) && str_contains($key, 'input_')) {
            // Split name input
            if ($key == 'input_32') {
                $name = array_map('trim', explode(" ", $val));

                if (!empty($name[0])) {
                    $input_values["12.3"] = sanitize_text_field($name[0]);
                }

                if (!empty($name[1])) {
                    $input_values["12.6"] = sanitize_text_field($name[1]);
                }
            } else {
                $input_value = is_string($val) ? sanitize_text_field($val) : null;
                $input_name = sanitize_text_field(
                    str_replace("_", ".", substr($key, 6))
                );
                $input_values[$input_name] = $input_value;
            }
        }
    }

    $input_values["form_id"] = $form_id;
    // $input_values["ip"] = GFFormsModel::get_ip();
    // $input_values["source_url"] = esc_url_raw(wp_get_referer());
    // $input_values["user_agent"] = sanitize_text_field($_SERVER["HTTP_USER_AGENT"]);

    // $entry = GFAPI::add_entry($input_values);

    // wp_send_json([
    //     'input_values' => $input_values,
    //     'entry' => $entry
    // ]);

    // Submit the form
    $result = GFAPI::submit_form($form_id, $input_values);
    $json_response = [
        'inputs_values' => $input_values,
        'result' => $result
    ];

    if (is_wp_error($result)) {
        $json_response['error_message'] = $result->get_error_message();
    }
    if (! rgar($result, 'is_valid')) {
        $json_response['error_message'] = 'Submission is invalid.';
        $json_response['field_errors']  = rgar($result, 'validation_messages', array());
    }

    if (rgar($result, 'confirmation_type') === 'redirect') {
        $redirect_url = !empty($input_values['12.3']) ? rgar($result, 'confirmation_redirect') . $input_values['12.3'] : rgar($result, 'confirmation_redirect');
        $json_response['redirect'] = $redirect_url;
    }

    // $response = [];
    wp_send_json($json_response);

    wp_die();
}
