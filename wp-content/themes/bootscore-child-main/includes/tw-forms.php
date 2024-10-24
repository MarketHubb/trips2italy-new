<?php
function gravity_form_to_tailwind_exact($form)
{
    $form_id = $form["id"];
    global $form_id;
    $output = '<div class="space-y-10 divide-y divide-gray-900/10">';
    $output .=
        '<form data-form-id="' .
        $form["id"] .
        '" id="gform_' .
        $form["id"] .
        '" class="gform_wrapper gravity-theme px-4 sm:px-8 md:px-10 space-y-10 md:space-y-16 divide-y divide-gray-900/10 bg-transparent" method="post" enctype="multipart/form-data">';

    $output .= '<input type="hidden" name="recaptchaResponse" id="recaptchaResponse" data-sitekey="' . get_recaptcha_site() . '">';

    if (!empty($form["pagination"])) {
        // Paginated form
        foreach ($form["pagination"]["pages"] as $page_index => $page_info) {
            list($title, $description) = explode(" - ", $page_info, 2);

            $output .=
                '<div class="grid grid-cols-1 gap-x-8 gap-y-8 ' .
                ($page_index > 0 ? "pt-10 md:pt-16 " : "") .
                'md:grid-cols-3">';
            $output .= '<div class="px-4 sm:px-0">';

            $title_array = explode(" ", $title);
            $title_array = array_map("trim", $title_array);
            $stylized_word = end($title_array);
            $stylized_formatted =
                '<span class="stylized pl-1 text-[130%] text-brand-600">' .
                $stylized_word .
                "</span>";
            $formatted_title = "";

            foreach ($title_array as $key => $word) {
                if ($word === $stylized_word) {
                    $formatted_title .= $stylized_formatted;
                } else {
                    $formatted_title .= $word . " ";
                }
            }

            // $output .= '<h2 class="text-base sm:text-lg lg:text-xl font-base tracking-normal font-semibold leading-7 text-gray-800 md:pt-6">' . esc_html($title) . '</h2>';
            $output .= '<div class="text-2xl md:text-3xl mb-4">';
            $output .=
                '<h2 class="tracking-tight font-base font-normal leading-7 text-brand-700 md:pt-6">' .
                $formatted_title .
                "</h2>";
            $output .= "</div>";
            $output .=
                '<p class="mt-1 text-base leading-6 text-gray-700 md:pr-12">' .
                esc_html($description) .
                "</p>";
            $output .= "</div>";

            $output .=
                '<div class="p-2 sm:p-6 bg-white shadow-md ring-1 ring-gray-300 rounded-xl md:col-span-2">';
            $output .= '<div class="px-2 sm:px-4 py-6">';
            $output .=
                '<div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">';

            // Render fields for this page
            foreach ($form["fields"] as $field) {
                if ($field["pageNumber"] == $page_index + 1) {
                    $output .= render_field_exact($field, $form);
                }
            }

            $output .= "</div>"; // Close grid
            $output .= "</div>"; // Close px-4 py-6 sm:p-8
            $output .= "</div>"; // Close bg-white container
            $output .= "</div>"; // Close grid grid-cols-1
        }
    } else {
        // Non-paginated form
        $output .=
            '<div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">';
        $output .= '<div class="px-4 sm:px-0">';
        $output .=
            '<h2 class="text-base font-semibold leading-7 text-gray-900">' .
            esc_html($form["title"]) .
            "</h2>";
        $output .=
            '<p class="mt-1 text-sm leading-6 text-gray-600">' .
            esc_html($form["description"]) .
            "</p>";
        $output .= "</div>";

        $output .=
            '<div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">';
        $output .= '<div class="px-4 py-6 sm:p-8">';
        $output .=
            '<div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">';

        foreach ($form["fields"] as $field) {
            $output .= render_field_exact($field, $form);
        }

        $output .= "</div>"; // Close grid
        $output .= "</div>"; // Close px-4 py-6 sm:p-8
        $output .= "</div>"; // Close bg-white container
        $output .= "</div>"; // Close grid grid-cols-1
    }

    // $output .= add_hidden_fields($form);
    $output .= get_form_submit($form);
    $output .= "</form>";
    $output .= "</div>"; // Close space-y-10 divide-y

    return $output;
}

function get_validation_markup($field)
{
    $is_required = isset($field["isRequired"]) && $field["isRequired"];
    $input_class_array = get_input_class_array($field);
    $output = "";

    if ($is_required || in_array("conditional-required", $input_class_array)) {
        // Error icon
        $output .=
            '<div class="pointer-events-none absolute inset-y-0 right-0 flex items-start pt-2 pr-3 hidden">';

        if ($field["type"] !== "date") {
            $output .=
                '<svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
            $output .=
                '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />';
            $output .= "</svg>";
        }

        $output .= "</div>";

        // Error message
        $output .=
            '<p class=" mt-2 text-sm text-red-600 hidden" id="error_' .
            $field["id"] .
            '">This field is required.</p>';
    }

    return $output;
}

function get_css_for_fieldset_title()
{
    return " text-base font-semibold leading-6 text-gray-800 antialiased mb-6 pl-2 sm:pl-0 ";
}

function get_css_for_input_label()
{
    return " block text-sm font-medium leading-6 text-gray-900 ";
}

function get_legend_for_field($label)
{
    return '<legend class="' .
        get_css_for_fieldset_title() .
        '">' .
        esc_html($label) .
        "</legend>";
}

function get_label_for_radio_and_checkbox_input($choice_id, $label)
{
    return '<label for="' .
        esc_attr($choice_id) .
        '" class="ml-3 mb-0 font-medium text-gray-900 text-base peer-checked:text-[#007aff]">' .
        esc_html($label) .
        "</label>";
}

function get_label_for_input($field)
{
    $input_class_array = get_input_class_array($field);
    $label_class = in_array("label-legend", $input_class_array)
        ? get_css_for_fieldset_title()
        : get_css_for_input_label();

    return '<label for="input_' .
        $field["id"] .
        '" class="' .
        $label_class .
        '">' .
        esc_html($field["label"]) .
        "</label>";
}

function get_input_class_array($field)
{
    $input_class_array = explode(" ", $field["cssClass"]);

    return array_map("trim", $input_class_array);
}

function render_field_exact($field, $form)
{
    if ($field["type"] === "page") {
        return;
    }

    $output = "";
    $is_hidden = $field["visibility"] === "hidden";
    $has_conditional_logic =
        !empty($field["conditionalLogic"]) &&
        is_array($field["conditionalLogic"]);
    $conditional_logic = $has_conditional_logic
        ? json_encode($field["conditionalLogic"])
        : "";

    $col_span = !empty($field['layoutGridColumnSpan']) ? $field['layoutGridColumnSpan'] : 12;

    // $wrapper_class = "gfield col-span-full min-w-0";
    $wrapper_class = 'gfield col-span-12 sm:col-span-' . $col_span . ' min-w-0';
    $wrapper_class .= $is_hidden ? " gfield_hidden" : "";
    $wrapper_class .= !empty($field["cssClass"])
        ? " " . $field["cssClass"]
        : "";
    $wrapper_class .= $has_conditional_logic ? " gfield_conditional" : "";

    $output .=
        '<div id="field_' . $field["id"] . '" class="' . $wrapper_class . '" ';
    $output .= 'data-field-id="' . $field["id"] . '" ';
    $output .= 'data-field-type="' . $field["type"] . '" ';
    $output .= 'data-field-type="' . $field["type"] . '" ';

    if ($conditional_logic) {
        $output .=
            'data-conditional-logic="' . esc_attr($conditional_logic) . '" ';
    }
    $output .=
        'style="' .
        ($is_hidden || $has_conditional_logic ? "display:none;" : "") .
        '">';

    if ($is_hidden) {
        $output .= render_hidden_field($form, $field);
    } else {
        $input_class_array = get_input_class_array($field);
        $is_required = isset($field["isRequired"]) && $field["isRequired"];
        $input_class =
            " peer block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-500 text-base font-semibold sm:leading-6 placeholder:italic placeholder:text-slate-400 ";

        switch ($field["type"]) {
            case "text":
            case "name":
            case "phone":
            case "email":
            case "number":

                $output .= '<div class="sm:col-span-full">';
                $output .= get_label_for_input($field);
                $output .= '<div class="relative mt-2">';
                $output .=
                    '<input type="' .
                    $field["type"] .
                    '" name="input_' .
                    $field["id"] .
                    '" id="input_' .
                    $field["id"] .
                    '" class="' .
                    $input_class .
                    '"' .
                    ($is_required ? " required" : "") .
                    ">";
                $output .= get_validation_markup($field);
                $output .= "</div>";
                $output .= "</div>";
                break;

            case "textarea":
                $output .= '<div class="col-span-full">';
                $output .=
                    '<label for="input_' .
                    $field["id"] .
                    '" class="block text-sm font-medium leading-6 text-gray-900">' .
                    esc_html($field["label"]) .
                    "</label>";
                $output .= '<div class="relative mt-2">';
                $output .=
                    '<textarea id="input_' .
                    $field["id"] .
                    '" name="input_' .
                    $field["id"] .
                    '" rows="5" class="' .
                    $input_class .
                    '"' .
                    ($is_required ? " required" : "") .
                    " ;";

                if ($field["placeholder"]) {
                    $output .= ' placeholder="' . $field["placeholder"] . '" ';
                }

                $output .= "></textarea>";
                $output .= get_validation_markup($field);
                $output .= "</div>";
                $output .=
                    '<p class="mt-3 text-sm leading-6 text-gray-600">' .
                    (isset($field["description"])
                        ? esc_html($field["description"])
                        : "") .
                    "</p>";
                $output .= "</div>";
                break;

            case "select":
                $output .= '<div class="sm:col-span-4">';
                $output .= get_label_for_input($field);
                $output .= '<div class="relative">';
                $output .=
                    '<select id="input_' .
                    $field["id"] .
                    '" name="input_' .
                    $field["id"] .
                    '" class="' .
                    $input_class .
                    ' sm:max-w-xs"' .
                    ($is_required ? " required" : "") .
                    ">";
                foreach ($field["choices"] as $choice) {
                    $output .=
                        '<option value="' .
                        esc_attr($choice["value"]) .
                        '">' .
                        esc_html($choice["text"]) .
                        "</option>";
                }
                $output .= "</select>";
                $output .= get_validation_markup($field);
                $output .= "</div>";
                $output .= "</div>";
                break;

            case "checkbox":
            case "radio":
                $output .= get_checkbox_radio_input_open(
                    $field,
                    $input_class_array
                );
                $output .= render_checkbox_input($field, $form);
                $output .= get_checkbox_radio_input_close($field);
                break;

            case "date":
                $output .= '<div class="sm:col-span-4">';
                $output .= get_label_for_input($field);
                $output .= '<div class="relative mt-2">';
                $output .=
                    '<input type="date" name="input_' .
                    $field["id"] .
                    '" id="input_' .
                    $field["id"] .
                    '" class="' .
                    $input_class .
                    '"' .
                    ($is_required ? " required" : "") .
                    ">";
                $output .= get_validation_markup($field);
                $output .= "</div>";
                $output .=
                    '<p class="mt-3 text-sm leading-6 text-gray-600">' .
                    esc_html($field["description"]) .
                    "</p>";
                $output .= "</div>";
                break;

            case "slider":
                $output .= '<div class="sm:col-span-4">';
                $output .= get_label_for_input($field);
                $output .= '<div class="relative mt-2">';
                $output .=
                    '<input type="range" name="input_' .
                    $field["id"] .
                    '" id="input_' .
                    $field["id"] .
                    '" ';
                $output .=
                    'min="' .
                    esc_attr($field["rangeMin"]) .
                    '" max="' .
                    esc_attr($field["rangeMax"]) .
                    '" ';
                $output .=
                    'step="' .
                    esc_attr($field["slider_step"]) .
                    '" value="' .
                    esc_attr($field["defaultValue"]) .
                    '" ';
                $output .=
                    'class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">';
                $output .=
                    '<div class="flex justify-between items-center mt-2">';
                $output .=
                    '<span class="text-sm text-gray-500">' .
                    esc_attr($field["slider_min_value_relation"]) .
                    "</span>";
                $output .=
                    '<span id="input_' .
                    $field["id"] .
                    '_value" class="text-sm text-white font-medium px-2 py-1 rounded-md bg-blue"></span>';
                $output .=
                    '<span class="text-sm text-gray-500">' .
                    esc_attr($field["slider_max_value_relation"]) .
                    "</span>";
                $output .= "</div>";
                $output .= "</div>";
                $output .=
                    '<p class="mt-3 text-sm leading-6 text-gray-600">' .
                    esc_html($field["description"]) .
                    "</p>";
                $output .= "</div>";
                break;

            case "captcha":
                $output .= get_captcha_field($field);
                break;

            default:
                $output .= "Unsupported field type: " . $field["type"];
                break;
        }
    }

    $output .= "</div>"; // Close gfield wrapper

    return $output;
}

function get_checkbox_radio_input_open($field, $input_class_array)
{
    $output = '<div class="col-span-full">';
    $output .= '<fieldset class="relative">';
    $output .= get_legend_for_field($field["label"]);

    if (in_array("row-cards", $input_class_array)) {
        $input_count = count($field["choices"]);
        $sm_grid_cols = $input_count < 4 ? " grid-cols-1 " : " grid-cols-2 ";
        $output .=
            '<div class="mt-6 grid ' .
            $sm_grid_cols .
            ' sm:grid-cols-3 gap-4 auto-rows-fr fieldset-cols">';
    } elseif (in_array("col-cards", $input_class_array)) {
        $output .= '<div class="space-y-4">';
    } else {
        $output .= '<div class="mt-6 space-y-6">';
    }
    return $output;
}

function get_checkbox_radio_input_close($field)
{
    $output = "</div>";
    $output .= "</fieldset>";
    $output .= get_validation_markup($field);
    $output .= "</div>";

    return $output;
}

function get_attributes_for_radio_and_checkboxes($form, $field, $index)
{
    $input_index = $field["type"] === "radio" ? $index : $index + 1;
    $required = $index === 1 && $field["isRequired"] ? " required " : "";

    return [
        "value" => esc_attr($field["choices"][$index]["value"]),
        "selected" => $field["choices"][$index]["isSelected"],
        "name" =>
        $field["type"] === "radio"
            ? "input_" . $field["id"]
            : "input_" . $field["inputs"][$index]["id"],
        "input_index" => $field["type"] === "radio" ? $index : $index + 1,
        "id" => $form["id"] . "_" . $field["id"] . "_" . $input_index,
        "label_parts" => explode(" - ", $field["choices"][$index]["text"], 2),
        "required" => $required,
    ];
}

function render_checkbox_input($field, $form)
{
    $field_key = $field["type"] === "radio" ? "choices" : "inputs";
    $output = "";
    foreach ($field[$field_key] as $index => $input) {
        $input_attributes = get_attributes_for_radio_and_checkboxes(
            $form,
            $field,
            $index
        );

        $output .= '<div class="relative">'; // Wrapper to maintain layout
        $output .=
            '<input type="' .
            $field["type"] .
            '" name="' .
            $input_attributes["name"] .
            '" id="choice_' .
            $input_attributes["id"] .
            '" value="' .
            $input_attributes["value"];
        $output .=
            '" class="sr-only peer" data-index="' .
            $index .
            '" ' .
            $input_attributes["required"] .
            ">";
        $output .=
            '<label for="choice_' .
            $input_attributes["id"] .
            '" class="flex cursor-pointer rounded-lg border text-gray-600 font-semibold  bg-white px-4 py-2 sm:p-4 shadow-sm focus:outline-none peer-checked:ring-2 peer-checked:ring-brand-500 peer-checked:bg-brand-100/30 peer-checked:text-gray-900">';
        $output .= '<span class="flex flex-1 items-center sm:items-start">';
        $output .= '<span class="flex flex-col">';
        $output .=
            '<span class="block text-sm lg:text-base tracking-tight leading-normal pr-5">' .
            $input_attributes["label_parts"][0] .
            "</span>";
        if (isset($input_attributes["label_parts"][1])) {
            $output .=
                '<span class="mt-1 flex font-normal items-center text-sm text-gray-500">' .
                $input_attributes["label_parts"][1] .
                "</span>";
        }
        $output .= "</span>";
        $output .= "</span>";
        $output .= "</label>";
        $output .=
            '<svg class="absolute right-[10px] top-[25%] sm:top-[18px] h-5 w-5 text-brand-500 hidden peer-checked:block pointer-events-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
        $output .=
            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />';
        $output .= "</svg>";
        $output .= "</div>";
    }
    return $output;
}

function render_hidden_field($form, $field)
{
    $output = "";

    if ($field["id"] === 27) {
        $referring_url = get_referring_url();
        $output .=
            '<input type="' .
            $field["type"] .
            '" name="input_' .
            $field["id"] .
            '" value="' .
            $referring_url .
            '">';
    } else {
        if (
            $field["type"] === "checkbox" ||
            ($field["type"] === "radio" && !empty($field["choices"]))
        ) {
            foreach ($field["choices"] as $index => $input) {
                $input_attributes = get_attributes_for_radio_and_checkboxes(
                    $form,
                    $field,
                    $index
                );
                $checked = $input_attributes["selected"] ? " checked" : "";
                $output .=
                    '<input class="hidden" type="' .
                    $field["type"] .
                    '" name="' .
                    $input_attributes["name"] .
                    '" id="choice_' .
                    $input_attributes["id"] .
                    '" value="' .
                    $input_attributes["value"] .
                    '"' .
                    $checked .
                    ">";
            }
        } elseif ($field["type"] === "radio" && !empty($field["choices"])) {
            $output .=
                '<input type="hidden" name="input_' .
                $field["id"] .
                '" id="input_' .
                $field["id"] .
                '" value="' .
                esc_attr($field["defaultValue"]) .
                '">';
        }
    }

    return $output;
}

function render_standard_input(
    $field,
    $choice,
    $choice_id,
    $index,
    $label_parts
) {
    $output = '<div class="relative flex items-start">';
    $output .= '<div class="flex h-6 items-center">';
    $output .=
        '<input id="' .
        $choice_id .
        '" name="input_' .
        $field["id"] .
        '" type="' .
        $field["type"] .
        '" value="' .
        esc_attr($choice["value"]) .
        '" class="h-4 w-4 border-gray-300 text-brand-500 focus:ring-brand-500">';
    $output .= "</div>";
    $output .= '<div class="ml-3 text-sm leading-6">';
    $output .= get_label_for_radio_and_checkbox_input(
        $choice_id,
        $label_parts[0]
    );
    if (isset($label_parts[1])) {
        $output .=
            '<p id="' .
            $choice_id .
            '-description" class="text-gray-500">' .
            esc_html($label_parts[1]) .
            "</p>";
    }
    $output .= "</div>";
    $output .= "</div>";
    return $output;
}

function get_recaptcha_field()
{
    $site_key = get_recaptcha_site();
    $field_id = 'input_recaptcha_response';

    $output  = '<div class="ginput_container ginput_recaptcha_v3" data-sitekey="' . esc_attr($site_key) . '">';
    $output .= '<input type="hidden" id="' . $field_id . '" name="' . $field_id . '" class="gfield_recaptcha_response">';
    $output .= '</div>';

    return $output;
}



function get_recaptcha_field1()
{
    $output  = ' <div class="gf_invisible ginput_recaptchav3" data-sitekey="' . get_recaptcha_site() . '" ';
    $output .= 'data-tabindex="0">';
    $output .= '<input id="input_f0f979ac39cfb1adbcbbd07077fac107" class="gfield_recaptcha_response" ';
    $output .= 'type="hidden" name="input_f0f979ac39cfb1adbcbbd07077fac107" value=""></div>';

    return $output;

    // return '<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">';
}

function get_captcha_field2($field)
{
    $site_key = "6LeR7DcqAAAAAPttcbdc0H68FhMR5C6Y6Ka8x9B0";

    $output = '<div class="flex flex-col">';
    $output .=
        '<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">';
    $output .= "</div>";

    // Add the reCAPTCHA v3 script
    $output .=
        '<script src="https://www.google.com/recaptcha/api.js?render=' .
        $site_key .
        '"></script>';

    // Add the JavaScript to execute reCAPTCHA
    $output .=
        '<script>
    grecaptcha.ready(function() {
        grecaptcha.execute("' .
        $site_key .
        '", {action: "submit"}).then(function(token) {
            document.getElementById("g-recaptcha-response").value = token;
        });
    });
</script>';

    return $output;
}

function get_form_submit($form)
{
    if (empty($form["button"])) {
        return null;
    }

    $output = '<div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">';
    $output .= '<div class="md:col-start-2 col-span-2">';
    $output .=
        '<input type="hidden" name="action" value="submit_custom_gravity_form">';
    $output .=
        '<input type="hidden" name="nonce" value="' .
        esc_attr(wp_create_nonce("submit_custom_gravity_form")) .
        '">';
    $output .=
        '<input type="submit" id="gform_submit_button_' .
        $form["id"] .
        '" class="w-full rounded-md border border-transparent bg-secondary-500 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-secondary-600 focus:outline-none focus:ring-2 focus:ring-secondary-500 focus:ring-offset-2 focus:ring-offset-gray-50" value="' .
        $form["button"]["text"] .
        '">';
    $output .= "</div></div>";
    return $output;
}
