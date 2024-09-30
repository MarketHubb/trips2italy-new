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
add_action("wp_ajax_nopriv_submit_custom_gravity_form", "submit_custom_gravity_form");

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

    $result = GFAPI::submit_form($form_id, $input_values);

    if (is_wp_error($result)) {
        $error_message = $result->get_error_message();
        GFCommon::log_debug(__METHOD__ . '(): GFAPI Error Message => ' . $error_message);
        wp_send_json_error(["error" => $error_message]);
        wp_die();
    }

    if (!rgar($result, 'is_valid')) {
        $error_message = 'Submission is invalid.';
        $field_errors = rgar($result, 'validation_messages', array());
        GFCommon::log_debug(__METHOD__ . '(): GFAPI Field Errors => ' . print_r($field_errors, true));
        wp_send_json_error(["error" => $error_message, "field_errors" => $field_errors]);
        wp_die();
    }

    $confirmation_type = rgar($result, 'confirmation_type');
    $first_name = isset($input_values['12.3']) ? $input_values['12.3'] : '';

    if ($confirmation_type === 'redirect' || $confirmation_type === 'page') {
        $redirect_url = rgar($result, 'confirmation_redirect');
        // Add the first name as a query parameter
        $redirect_url = add_query_arg('id', $first_name, $redirect_url);
        GFCommon::log_debug(__METHOD__ . '(): GFAPI Redirect URL => ' . $redirect_url);

        if (wp_redirect($redirect_url)) {
            exit;
        }
    } else {
        $confirmation_message = rgar($result, 'confirmation_message');
        GFCommon::log_debug(__METHOD__ . '(): GFAPI Confirmation Message => ' . $confirmation_message);
        wp_send_json_success(["confirmation" => $confirmation_message]);
    }

    wp_die();
}
