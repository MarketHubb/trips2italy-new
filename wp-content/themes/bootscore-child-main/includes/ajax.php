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

add_action('wp_ajax_submit_custom_gravity_form', 'submit_custom_gravity_form');
add_action('wp_ajax_nopriv_submit_custom_gravity_form', 'submit_custom_gravity_form');

function submit_custom_gravity_form()
{
    // Start output buffering to capture any unexpected output
    ob_start();

    // Verify nonce for security
    if (!check_ajax_referer("submit_custom_gravity_form", "nonce", false)) {
        // Clean the output buffer
        ob_end_clean();
        wp_send_json_error(["error" => "Nonce verification failed."]);
        wp_die();
    }

    // Check if form_id is set
    if (!isset($_POST["form_id"])) {
        ob_end_clean();
        wp_send_json_error(["error" => "Form ID not set."]);
        wp_die();
    }

    $form_id = intval($_POST["form_id"]);
    $input_values = [];
    $input_32_value = ''; // To store the raw 'input_32' value

    // Sanitize and prepare input values
    foreach ($_POST as $key => $val) {
        if (!empty($val) && strpos($key, 'input_') !== false) {
            // Handle specific input fields as needed
            // if ($key == 'input_32') {
            //     $input_32_value = sanitize_text_field($val); // Store raw input_32 value

            //     $name = array_map('trim', explode(" ", $val));

            //     if (!empty($name[0])) {
            //         $input_values["input_12_3"] = sanitize_text_field($name[0]);
            //     }

            //     if (!empty($name[1])) {
            //         $input_values["input_12_6"] = sanitize_text_field($name[1]);
            //     }
            // } else {
                $input_value = is_string($val) ? sanitize_text_field($val) : null;
                $input_name = sanitize_text_field(
                    str_replace("_", ".", substr($key, 6))
                );
                $input_values[$input_name] = $input_value;
            // }
        }
    }

    // Submit the form using GFAPI
    $result = GFAPI::submit_form($form_id, $input_values);

    // Handle potential WP_Error
    if (is_wp_error($result)) {
        $error_message = $result->get_error_message();
        GFCommon::log_debug(__METHOD__ . '(): GFAPI Error Message => ' . $error_message);
        ob_end_clean();
        wp_send_json_error(["error" => $error_message]);
        wp_die();
    }

    // Check if the submission is valid
    if (!rgar($result, 'is_valid')) {
        $error_message = 'Submission is invalid.';
        $field_errors  = rgar($result, 'validation_messages', array());
        GFCommon::log_debug(__METHOD__ . '(): GFAPI Field Errors => ' . print_r($field_errors, true));
        ob_end_clean();
        wp_send_json_error(["error" => $error_message, "field_errors" => $field_errors]);
        wp_die();
    }

    // **Redirection Logic Starts Here**

    // Determine the 'id' parameter
    $id_param = !empty($input_values["input_32"]) ? sanitize_text_field($input_values["input_32"]) : null;
    // Get the URL of the page with ID 32250
    $redirect_page_id = 32250;
    $redirect_url = get_permalink($redirect_page_id);

    if ($redirect_url === false) {
        // Handle case where the page ID is invalid
        GFCommon::log_debug(__METHOD__ . '(): Invalid redirect page ID.');
        ob_end_clean();
        wp_send_json_error(["error" => "Redirect page not found."]);
        wp_die();
    }

    // Append the 'id' query parameter if it's not empty
    if (!empty($id_param)) {
        // Ensure the URL does not already have query parameters
        $redirect_url = add_query_arg('id', $id_param, $redirect_url);
    }

    // **End of Redirection Logic**

    // Clean the output buffer
    ob_end_clean();

    // Send the redirect URL in the JSON response with the key 'redirect' to match JavaScript expectations
    wp_send_json_success(["redirect" => $redirect_url]);
    wp_die();
}
