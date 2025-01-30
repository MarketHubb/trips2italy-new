<?php

/**
 * Gravity Forms: Tailwind Floating Labels & Submit Button (No extra leading space in labels)
 */

/**
 * (Optional) Add an extra class to the <form> tag (e.g., space-y-6).
 * This preserves all default form actions/attributes.
 */
add_filter('gform_form_tag', 'my_gf_form_tag_14', 10, 2);
function my_gf_form_tag_14($form_tag, $form)
{
    if ((int) $form['id'] !== 14) {
        return $form_tag;
    }

    $campaign = get_field('campaign', get_queried_object_id()) ?? false;
    $region = get_field('region', get_queried_object_id()) ?? false;

    $class_to_add = ' class="space-y-6" data-campaign="' . $campaign . '" data-region="' . $region . '"';
    $form_tag     = str_replace('>', $class_to_add . '>', $form_tag);

    return $form_tag;
}

/**
 * Convert text/email fields into floating labels for form ID 14
 * WITHOUT extra leading space in the label text.
 */
add_filter('gform_field_content', 'my_gf_field_content_14', 10, 5);
function my_gf_field_content_14($content, $field, $value, $lead_id, $form_id)
{
    if ((int) $form_id !== 14) {
        return $content;
    }

    // Only apply to text or email fields
    if (in_array($field->type, ['text', 'email'], true)) {
        $field_id = $field->id;
        $input_id = "input_{$form_id}_{$field_id}";

        // Trim label text to remove leading/trailing spaces
        $label_text       = trim($field->label);
        $placeholder_text = trim($field->placeholder) ?: $label_text;
        $escaped_value    = esc_attr($value);

        // Ensure no extra indentation/newlines before %5$s:
        $custom_markup = sprintf(
            '<div class="relative">
                <input
                    type="%1$s"
                    name="input_%2$d"
                    id="%3$s"
                    value="%6$s"
                    class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent
                           focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                           focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2
                           autofill:pt-6 autofill:pb-2"
                    placeholder="%4$s"
                    required
                />
                <label for="%3$s"
                    class="absolute top-0 left-0 p-4 h-full font-medium text-sm truncate pointer-events-none
                           transition ease-in-out duration-100 border border-transparent origin-[0_0]
                           peer-disabled:opacity-50 peer-disabled:pointer-events-none
                           peer-focus:scale-90 peer-focus:translate-x-0.5 peer-focus:-translate-y-1.5 peer-focus:text-gray-500
                           peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:translate-x-0.5
                           peer-[&:not(:placeholder-shown)]:-translate-y-1.5 peer-[&:not(:placeholder-shown)]:text-gray-500">%5$s</label>
            </div>',
            esc_attr($field->type),      // %1$s: text or email
            $field_id,                     // %2$d
            esc_attr($input_id),         // %3$s
            esc_attr($placeholder_text), // %4$s
            esc_html($label_text),       // %5$s: trimmed label
            $escaped_value                 // %6$s
        );

        return $custom_markup;
    }

    return $content; // For other fields, keep default markup
}

/**
 * Style the Submit Button with Tailwind for form ID 14, preserving the gform_footer.
 */
add_filter('gform_submit_button', 'my_gf_submit_button_14', 10, 2);
function my_gf_submit_button_14($button_html, $form)
{
    if ((int) $form['id'] !== 14) {
        return $button_html;
    }

    return '
    <button type="submit"
        class="hidden w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium
               rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700
               focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
        Get Started
    </button>';
}

/**
 * Dynamically populate fields for form ID #14.
 */
add_filter('gform_pre_render_14', 'my_form_14_dynamic_population');
function my_form_14_dynamic_population($form)
{

    // Figure out your three hidden fields by ID (the GF "field ID" from the editor)
    // e.g., if "URL" is field #7, "region" is #8, "campaign" is #9, etc.

    $current_url = home_url(add_query_arg(null, null)); // A rough approach to get current URL server-side
    $campaign = sanitize_text_field(get_field('campaign', get_queried_object_id())) ?? false;
    $region = sanitize_text_field(get_field('region', get_queried_object_id())) ?? false;


    // Optionally read region/campaign from query params, or from anywhere else:
    // $region   = isset($_GET['region']) ? sanitize_text_field($_GET['region']) : '';
    // $campaign = isset($_GET['campaign']) ? sanitize_text_field($_GET['campaign']) : '';
    // Or if you have your own logic, set them here.

    // Loop over each field in the form to find and update your hidden fields:
    foreach ($form['fields'] as &$field) {
        switch ($field->id) {
            case '7': // The "URL" hidden field
                $field->defaultValue = $current_url;
                break;

            case '8': // The "region" hidden field
                $field->defaultValue = $region; // or your custom logic for region
                break;

            case '9': // The "campaign" hidden field
                $field->defaultValue = $campaign; // or your custom logic for campaign
                break;
        }
    }

    return $form;
}
