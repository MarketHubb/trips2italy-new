<?php
function gravity_form_to_tailwind_exact($form)
{
    $output = '<div class="space-y-10 divide-y divide-gray-900/10">';
    $output .= '<form id="gform_' . $form['id'] . '" class="gform_wrapper gravity-theme space-y-10 md:space-y-16 divide-y divide-gray-900/10 bg-transparent" method="post" enctype="multipart/form-data">';

    if (!empty($form['pagination'])) {
        // Paginated form
        foreach ($form['pagination']['pages'] as $page_index => $page_info) {
            list($title, $description) = explode(' - ', $page_info, 2);

            $output .= '<div class="grid grid-cols-1 gap-x-8 gap-y-8 ' . ($page_index > 0 ? 'pt-10 md:pt-16 ' : '') . 'md:grid-cols-3">';
            $output .= '<div class="px-4 sm:px-0">';
            $output .= '<h2 class="text-base md:text-lg font-base tracking-normal font-semibold leading-7 text-gray-900">' . esc_html($title) . '</h2>';
            $output .= '<p class="mt-1 text-sm leading-6 text-gray-600">' . esc_html($description) . '</p>';
            $output .= '</div>';

            $output .= '<div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">';
            $output .= '<div class="px-4 py-6 sm:p-8">';
            $output .= '<div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">';

            // Render fields for this page
            foreach ($form['fields'] as $field) {
                if ($field['pageNumber'] == $page_index + 1) {
                    $output .= render_field_exact($field);
                }
            }

            $output .= '</div>'; // Close grid
            $output .= '</div>'; // Close px-4 py-6 sm:p-8
            $output .= '</div>'; // Close bg-white container
            $output .= '</div>'; // Close grid grid-cols-1
        }
    } else {
        // Non-paginated form
        $output .= '<div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">';
        $output .= '<div class="px-4 sm:px-0">';
        $output .= '<h2 class="text-base font-semibold leading-7 text-gray-900">' . esc_html($form['title']) . '</h2>';
        $output .= '<p class="mt-1 text-sm leading-6 text-gray-600">' . esc_html($form['description']) . '</p>';
        $output .= '</div>';

        $output .= '<div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">';
        $output .= '<div class="px-4 py-6 sm:p-8">';
        $output .= '<div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">';

        foreach ($form['fields'] as $field) {
            $output .= render_field_exact($field);
        }

        $output .= '</div>'; // Close grid
        $output .= '</div>'; // Close px-4 py-6 sm:p-8
        $output .= '</div>'; // Close bg-white container
        $output .= '</div>'; // Close grid grid-cols-1
    }

    // Add submit button and hidden fields
    $output .= '<div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">';
    $output .= '<button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>';
    $output .= '<input type="submit" id="gform_submit_button_' . $form['id'] . '" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" value="Save">';
    $output .= '</div>';

    $output .= add_hidden_fields($form);
    $output .= '</form>';
    $output .= '</div>'; // Close space-y-10 divide-y

    return $output;
}



function get_validation_markup($field)
{
    $is_required = isset($field['isRequired']) && $field['isRequired'];
    $output = '';

    if ($is_required) {
        // Error icon
        $output .= '<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">';
        $output .= '<svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
        $output .= '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />';
        $output .= '</svg>';
        $output .= '</div>';

        // Error message
        $output .= '<p class="mt-2 text-sm text-red-600" id="error_' . $field['id'] . '">' . esc_html($field['label']) . ' is required.</p>';
    }

    return $output;
}

function render_hidden_field($field)
{
    $output = '';
    if ($field['type'] === 'checkbox' && !empty($field['inputs'])) {
        foreach ($field['inputs'] as $input) {
            $output .= '<input type="hidden" name="input_' . $input['id'] . '" id="input_' . $input['id'] . '" value="' . esc_attr($field['choices'][0]['value']) . '">';
        }
    } else {
        $output .= '<input type="hidden" name="input_' . $field['id'] . '" id="input_' . $field['id'] . '" value="' . esc_attr($field['defaultValue']) . '">';
    }
    return $output;
}

function get_legend_for_field($label)
{
    return '<legend class="text-lg font-semibold leading-6 text-gray-800 antialiased mb-6">' . esc_html($label) . '</legend>';
}

function get_label_for_radio_and_checkbox_input($choice_id, $label)
{
    return '<label for="' . esc_attr($choice_id) . '" class="ml-3 mb-0 font-medium text-gray-900 text-base peer-checked:text-[#007aff]">' . esc_html($label) . '</label>';
}

function render_field_exact($field)
{
    if ($field['type'] === 'hidden') {
        return '<input type="hidden" name="input_' . $field['id'] . '" id="input_' . $field['id'] . '" value="' . esc_attr($field['defaultValue']) . '">';
    }

    $output = '';

    $is_required = isset($field['isRequired']) && $field['isRequired'];
    $input_class = 'peer block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6';

    switch ($field['type']) {
        case 'text':
        case 'email':
        case 'number':
            $output .= '<div class="sm:col-span-4">';
            $output .= '<label for="input_' . $field['id'] . '" class="block text-sm font-medium leading-6 text-gray-900">' . esc_html($field['label']) . '</label>';
            $output .= '<div class="relative mt-2">';
            $output .= '<input type="' . $field['type'] . '" name="input_' . $field['id'] . '" id="input_' . $field['id'] . '" class="' . $input_class . '"' . ($is_required ? ' required' : '') . '>';
            $output .= '<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 peer-invalid:visible invisible">';
            $output .= '<svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
            $output .= '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />';
            $output .= '</svg>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<p class="mt-2 text-sm text-red-600 invisible peer-invalid:visible" id="error_' . $field['id'] . '">' . esc_html($field['label']) . ' is required.</p>';
            $output .= '</div>';
            break;

        case 'textarea':
            $output .= '<div class="col-span-full">';
            $output .= '<label for="input_' . $field['id'] . '" class="block text-sm font-medium leading-6 text-gray-900">' . esc_html($field['label']) . '</label>';
            $output .= '<div class="relative mt-2">';
            $output .= '<textarea id="input_' . $field['id'] . '" name="input_' . $field['id'] . '" rows="3" class="' . $input_class . '"' . ($is_required ? ' required' : '') . '></textarea>';
            $output .= '<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 peer-invalid:visible invisible">';
            $output .= '<svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
            $output .= '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />';
            $output .= '</svg>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<p class="mt-2 text-sm text-red-600 invisible peer-invalid:visible" id="error_' . $field['id'] . '">' . esc_html($field['label']) . ' is required.</p>';
            $output .= '<p class="mt-3 text-sm leading-6 text-gray-600">' . (isset($field['description']) ? esc_html($field['description']) : '') . '</p>';
            $output .= '</div>';
            break;

        case 'select':
            $output .= '<div class="sm:col-span-4">';
            $output .= '<label for="input_' . $field['id'] . '" class="block text-sm font-medium leading-6 text-gray-900">' . esc_html($field['label']) . '</label>';
            $output .= '<div class="relative mt-2">';
            $output .= '<select id="input_' . $field['id'] . '" name="input_' . $field['id'] . '" class="' . $input_class . ' sm:max-w-xs"' . ($is_required ? ' required' : '') . '>';
            foreach ($field['choices'] as $choice) {
                $output .= '<option value="' . esc_attr($choice['value']) . '">' . esc_html($choice['text']) . '</option>';
            }
            $output .= '</select>';
            $output .= '<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 peer-invalid:visible invisible">';
            $output .= '<svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
            $output .= '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />';
            $output .= '</svg>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<p class="mt-2 text-sm text-red-600 invisible peer-invalid:visible" id="error_' . $field['id'] . '">' . esc_html($field['label']) . ' is required.</p>';
            $output .= '</div>';
            break;

        case 'checkbox':
            $output .= '<div class="col-span-full">';
            $output .= '<fieldset>';
            $output .= get_legend_for_field($field['label']);
            $output .= '<div class="mt-6 space-y-6">';
            foreach ($field['choices'] as $index => $choice) {
                $choice_id = 'choice_' . $field['id'] . '_' . $index;
                $label_parts = explode(' - ', $choice['text'], 2);
                $output .= '<div class="relative flex items-start">';
                $output .= '<div class="flex h-6 items-center">';
                $output .= '<input id="' . esc_attr($choice_id) . '" name="input_' . $field['id'] . '.' . ($index + 1) . '" type="checkbox" value="' . esc_attr($choice['value']) . '" class="peer/' . esc_attr($choice_id) . ' h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"' . ($is_required ? ' required' : '') . '>';
                $output .= '</div>';
                $output .= '<div class="ml-3 text-sm leading-6">';
                // $output .= '<label for="' . esc_attr($choice_id) . '" class="ml-0 mb-0 font-medium text-base text-gray-900 peer-checked/' . esc_attr($choice_id) . ':text-indigo-600">' . esc_html($label_parts[0]) . '</label>';
                $output .= get_label_for_radio_and_checkbox_input($choice_id, $label_parts[0]);
                if (isset($label_parts[1])) {
                    $output .= '<p id="' . esc_attr($choice_id) . '-description" class="text-base text-gray-500 peer-checked/' . esc_attr($choice_id) . ':text-indigo-500">' . esc_html($label_parts[1]) . '</p>';
                }
                $output .= '</div>';
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '<p class="mt-2 invisible peer-invalid:visible text-sm text-red-600" id="error_' . $field['id'] . '">' . esc_html($field['label']) . ' is required.</p>';
            $output .= '</fieldset>';
            $output .= '</div>';
            break;



        case 'radio':
            $output .= '<div class="col-span-full">';
            $output .= '<fieldset>';
            $output .= get_legend_for_field($field['label']);

            if ($field['cssClass'] === 'input-cards') {
                $output .= '<div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">';
            } elseif ($field['cssClass'] === 'input-cards-stacked') {
                $output .= '<div class="space-y-4">';
            } else {
                $output .= '<div class="mt-6">';
            }

            foreach ($field['choices'] as $index => $choice) {
                $choice_id = 'choice_' . $field['id'] . '_' . $index;
                $label_parts = explode('-', $choice['text']);

                if ($field['cssClass'] === 'input-cards') {
                    $output .= '<label aria-label="' . esc_attr($label_parts[0]) . '" aria-description="' . (isset($label_parts[1]) ? esc_attr($label_parts[1]) : '') . '" class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none">';
                    $output .= '<input type="radio" name="input_' . $field['id'] . '" value="' . esc_attr($choice['value']) . '" class="sr-only peer">';
                    $output .= '<span class="flex flex-1">';
                    $output .= '<span class="flex flex-col">';
                    $output .= '<span class="block text-sm font-medium text-gray-900">' . esc_html($label_parts[0]) . '</span>';
                    if (!empty($label_parts[1])) {
                        $output .= '<span class="mt-1 flex items-center text-sm text-gray-500">' . esc_html($label_parts[1]) . '</span>';
                    }
                    if (!empty($label_parts[2])) {
                        $output .= '<span class="mt-6 text-sm font-medium text-gray-900">' . esc_html($label_parts[2]) . '</span>';
                    }
                    $output .= '</span>';
                    $output .= '</span>';
                    $output .= '<svg class="h-5 w-5 text-indigo-600 hidden peer-checked:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
                    $output .= '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />';
                    $output .= '</svg>';
                    $output .= '<span class="pointer-events-none absolute -inset-px rounded-lg border-2 border-transparent peer-checked:border-indigo-600" aria-hidden="true"></span>';
                    $output .= '</label>';
                } elseif ($field['cssClass'] === 'input-cards-stacked') {
                    $output .= '<label aria-label="' . esc_attr($label_parts[0]) . '" aria-description="' . (isset($label_parts[1]) ? esc_attr($label_parts[1]) : '') . '" class="relative block cursor-pointer rounded-lg border bg-white px-6 py-4 shadow-sm focus:outline-none sm:flex sm:justify-between">';
                    $output .= '<input type="radio" name="input_' . $field['id'] . '" value="' . esc_attr($choice['value']) . '" class="sr-only peer">';
                    $output .= '<span class="flex items-center">';
                    $output .= '<span class="flex flex-col text-sm">';
                    $output .= '<span class="font-medium text-gray-900">' . esc_html($label_parts[0]) . '</span>';
                    if (!empty($label_parts[1])) {
                        $output .= '<span class="text-gray-500">';
                        $output .= '<span class="block sm:inline">' . esc_html($label_parts[1]) . '</span>';
                        if (!empty($label_parts[2])) {
                            $output .= '<span class="hidden sm:mx-1 sm:inline" aria-hidden="true">&middot;</span>';
                            $output .= '<span class="block sm:inline">' . esc_html($label_parts[2]) . '</span>';
                        }
                        $output .= '</span>';
                    }
                    $output .= '</span>';
                    $output .= '</span>';
                    if (!empty($label_parts[3])) {
                        $output .= '<span class="mt-2 flex text-sm sm:ml-4 sm:mt-0 sm:flex-col sm:text-right">';
                        $output .= '<span class="font-medium text-gray-900">' . esc_html($label_parts[3]) . '</span>';
                        $output .= '<span class="ml-1 text-gray-500 sm:ml-0">/mo</span>';
                        $output .= '</span>';
                    }
                    $output .= '<svg class="h-5 w-5 text-indigo-600 hidden peer-checked:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
                    $output .= '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />';
                    $output .= '</svg>';
                    $output .= '<span class="pointer-events-none absolute -inset-px rounded-lg border-2 border-transparent peer-checked:border-indigo-600" aria-hidden="true"></span>';
                    $output .= '</label>';
                } else {
                    $output .= '<div class="relative flex items-start">';
                    $output .= '<div class="flex h-6 items-center">';
                    $output .= '<input id="' . esc_attr($choice_id) . '" name="input_' . $field['id'] . '" type="radio" value="' . esc_attr($choice['value']) . '" class="peer h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"' . ($is_required ? ' required' : '') . '>';
                    $output .= get_label_for_radio_and_checkbox_input($choice_id, $label_parts[0]);
                    $output .= '</div>';
                    if (isset($label_parts[1])) {
                        $output .= '<p id="' . esc_attr($choice_id) . '-description" class="text-gray-500 text-base peer-checked:text-indigo-500">' . esc_html($label_parts[1]) . '</p>';
                    }
                    $output .= '</div>';
                }
            }
            $output .= '</div>';
            $output .= '<p class="mt-2 invisible peer-invalid:visible text-sm text-red-600" id="error_' . $field['id'] . '">' . esc_html($field['label']) . ' is required.</p>';
            $output .= '</fieldset>';
            $output .= '</div>';
            break;
















            // Add more field types as needed
    }
    return $output;
}

function add_hidden_fields($form)
{
    $output = '<input type="hidden" name="gform_ajax" value="form_id=' . $form['id'] . '&amp;title=' . urlencode($form['title']) . '&amp;description=' . urlencode($form['description']) . '&amp;tabindex=0">';
    $output .= '<input type="hidden" class="gform_hidden" name="is_submit_' . $form['id'] . '" value="1">';
    $output .= '<input type="hidden" class="gform_hidden" name="gform_submit" value="' . $form['id'] . '">';
    $output .= '<input type="hidden" class="gform_hidden" name="gform_unique_id" value="">';
    $output .= '<input type="hidden" class="gform_hidden" name="state_' . $form['id'] . '" value="WyJbXSIsImU5MjYyMWVmOWYzYWVkZjQxZDM0OTRmYmU4NTMzNGQ4Il0=">';
    $output .= '<input type="hidden" class="gform_hidden" name="gform_target_page_number_' . $form['id'] . '" id="gform_target_page_number_' . $form['id'] . '" value="0">';
    $output .= '<input type="hidden" class="gform_hidden" name="gform_source_page_number_' . $form['id'] . '" id="gform_source_page_number_' . $form['id'] . '" value="1">';
    $output .= '<input type="hidden" name="gform_field_values" value="">';

    return $output;
}
