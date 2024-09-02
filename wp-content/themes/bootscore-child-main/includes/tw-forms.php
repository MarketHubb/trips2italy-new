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
            $output .= '<h2 class="text-base md:text-lg font-base tracking-normal font-semibold leading-7 text-gray-900 md:pt-6">' . esc_html($title) . '</h2>';
            $output .= '<p class="mt-1 text-sm leading-6 text-gray-600">' . esc_html($description) . '</p>';
            $output .= '</div>';

            $output .= '<div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">';
            $output .= '<div class="px-4 py-6 sm:p-8">';
            $output .= '<div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">';

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
        $output .= '<div class="pointer-events-none absolute inset-y-0 right-0 flex items-start pt-2 pr-3 hidden">';
        $output .= '<svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
        $output .= '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />';
        $output .= '</svg>';
        $output .= '</div>';

        // Error message
        $output .= '<p class=" mt-2 text-sm text-red-600 hidden" id="error_' . $field['id'] . '">' . esc_html($field['label']) . ' is required.</p>';
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

function get_css_for_fieldset_title()
{
    return ' text-base font-semibold leading-6 text-gray-800 antialiased mb-6 ';
}

function get_css_for_input_label()
{
    return ' block text-sm font-medium leading-6 text-gray-900 ';
}

function get_legend_for_field($label)
{
    return '<legend class="' . get_css_for_fieldset_title() . '">' . esc_html($label) . '</legend>';
}

function get_label_for_radio_and_checkbox_input($choice_id, $label)
{
    return '<label for="' . esc_attr($choice_id) . '" class="ml-3 mb-0 font-medium text-gray-900 text-base peer-checked:text-[#007aff]">' . esc_html($label) . '</label>';
}

function get_label_for_input($field)
{
    $input_class_array = get_input_class_array($field);
    $label_class =  (in_array('label-legend', $input_class_array)) ? get_css_for_fieldset_title() : get_css_for_input_label();

    return '<label for="input_' . $field['id'] . '" class="' . $label_class . '">' . esc_html($field['label']) . '</label>';
}

function get_input_class_array($field)
{
    $input_class_array = explode(" ", $field['cssClass']);

    return array_map('trim', $input_class_array);
}

function render_field_exact($field)
{
    if ($field['type'] === 'page') return;

    $output = '';
    $is_hidden = $field['visibility'] === 'hidden';
    $has_conditional_logic = !empty($field['conditionalLogic']) && is_array($field['conditionalLogic']);
    $conditional_logic = $has_conditional_logic ? json_encode($field['conditionalLogic']) : '';

    $wrapper_class = 'gfield py-3';
    $wrapper_class .= $is_hidden ? ' gfield_hidden' : '';
    $wrapper_class .= !empty($field['cssClass']) ? ' ' . $field['cssClass'] : '';
    $wrapper_class .= $has_conditional_logic ? ' gfield_conditional' : '';

    $output .= '<div id="field_' . $field['id'] . '" class="' . $wrapper_class . '" ';
    $output .= 'data-field-id="' . $field['id'] . '" ';
    $output .= 'data-field-type="' . $field['type'] . '" ';
    if ($conditional_logic) {
        $output .= 'data-conditional-logic="' . esc_attr($conditional_logic) . '" ';
    }
    $output .= 'style="' . ($is_hidden || $has_conditional_logic ? 'display:none;' : '') . '">';

    if ($is_hidden) {
        $output .= render_hidden_field($field);
    } else {
        $is_required = isset($field['isRequired']) && $field['isRequired'];
        $input_class = 'peer block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-base sm:leading-6';
        // $input_class_array = explode(' ', $field['cssClass']);
        $input_class_array = get_input_class_array($field);

        switch ($field['type']) {
            case 'text':
            case 'name':
            case 'phone':
            case 'email':
            case 'number':
                $output .= '<div class="sm:col-span-4">';
                // $output .= '<label for="input_' . $field['id'] . '" class="block text-sm font-medium leading-6 text-gray-900">' . esc_html($field['label']) . '</label>';
                $output .= get_label_for_input($field);
                $output .= '<div class="relative mt-2">';
                $output .= '<input type="' . $field['type'] . '" name="input_' . $field['id'] . '" id="input_' . $field['id'] . '" class="' . $input_class . '"' . ($is_required ? ' required' : '') . '>';
                $output .= get_validation_markup($field);
                $output .= '</div>';
                $output .= '</div>';
                break;

            case 'textarea':
                $output .= '<div class="col-span-full">';
                $output .= '<label for="input_' . $field['id'] . '" class="block text-sm font-medium leading-6 text-gray-900">' . esc_html($field['label']) . '</label>';
                $output .= '<div class="relative mt-2">';
                $output .= '<textarea id="input_' . $field['id'] . '" name="input_' . $field['id'] . '" rows="3" class="' . $input_class . '"' . ($is_required ? ' required' : '') . '></textarea>';
                $output .= get_validation_markup($field);
                $output .= '</div>';
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
                $output .= get_validation_markup($field);
                $output .= '</div>';
                $output .= '</div>';
                break;

            case 'checkbox':
            case 'radio':
                $output .= '<div class="col-span-full">';
                $output .= '<fieldset>';
                $output .= get_legend_for_field($field['label']);

                if (in_array('row-cards', $input_class_array)) {
                    // $output .= '<div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">';
                    $output .= '<div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4 auto-rows-fr">';
                } elseif (in_array('col-cards', $input_class_array)) {
                    $output .= '<div class="space-y-4">';
                } else {
                    $output .= '<div class="mt-6 space-y-6">';
                }

                foreach ($field['choices'] as $index => $choice) {
                    $choice_id = 'choice_' . $field['id'] . '_' . $index;
                    $label_parts = explode(' - ', $choice['text'], 2);

                    if (in_array('row-cards', $input_class_array) || in_array('col-cards', $input_class_array)) {
                        $output .= render_card_input($field, $choice, $choice_id, $index, $label_parts);
                    } else {
                        $output .= render_standard_input($field, $choice, $choice_id, $index, $label_parts);
                    }
                }

                $output .= '</div>';
                $output .= get_validation_markup($field);
                $output .= '</fieldset>';
                $output .= '</div>';
                break;

            case 'date':
                $output .= '<div class="sm:col-span-4">';
                // $output .= '<label for="input_' . $field['id'] . '" class="block font-medium leading-6 text-gray-900">' . esc_html($field['label']) . '</label>';
                $output .= get_label_for_input($field);
                $output .= '<div class="relative mt-2">';
                $output .= '<input type="date" name="input_' . $field['id'] . '" id="input_' . $field['id'] . '" class="' . $input_class . '"' . ($is_required ? ' required' : '') . '>';
                $output .= get_validation_markup($field);
                $output .= '</div>';
                $output .= '<p class="mt-3 text-sm leading-6 text-gray-600">' . esc_html($field['description']) . '</p>';
                $output .= '</div>';
                break;

            case 'slider':
                $output .= '<div class="sm:col-span-4">';
                // $output .= '<label for="input_' . $field['id'] . '" class="block text-sm font-medium leading-6 text-gray-900">' . esc_html($field['label']) . '</label>';
                $output .= get_label_for_input($field);
                $output .= '<div class="relative mt-2">';
                $output .= '<input type="range" name="input_' . $field['id'] . '" id="input_' . $field['id'] . '" ';
                $output .= 'min="' . esc_attr($field['rangeMin']) . '" max="' . esc_attr($field['rangeMax']) . '" ';
                $output .= 'step="' . esc_attr($field['slider_step']) . '" value="' . esc_attr($field['defaultValue']) . '" ';
                $output .= 'class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">';
                $output .= '<div class="flex justify-between items-center mt-2">';
                $output .= '<span class="text-sm text-gray-500">' . esc_attr($field['slider_min_value_relation']) . '</span>';
                $output .= '<span id="input_' . $field['id'] . '_value" class="text-sm text-white font-medium px-2 py-1 rounded-md bg-blue"></span>';
                $output .= '<span class="text-sm text-gray-500">' . esc_attr($field['slider_max_value_relation']) . '</span>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '<p class="mt-3 text-sm leading-6 text-gray-600">' . esc_html($field['description']) . '</p>';
                $output .= '</div>';
                break;


            default:
                $output .= 'Unsupported field type: ' . $field['type'];
                break;
        }
    }

    $output .= '</div>'; // Close gfield wrapper

    return $output;
}


// function render_card_input($field, $choice, $choice_id, $index, $label_parts)
// {
//     $output = '<label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none">';
//     $output .= '<input type="' . $field['type'] . '" name="input_' . $field['id'] . '" id="' . $choice_id . '" value="' . esc_attr($choice['value']) . '" class="sr-only peer">';
//     $output .= '<span class="flex flex-1">';
//     $output .= '<span class="flex flex-col">';
//     $output .= '<span class="block text-base font-medium text-gray-900 pr-5 leading-6">' . esc_html($label_parts[0]) . '</span>';
//     if (isset($label_parts[1])) {
//         $output .= '<span class="mt-1 flex font-normal items-center text-sm text-gray-500">' . esc_html($label_parts[1]) . '</span>';
//     }
//     $output .= '</span>';
//     $output .= '</span>';
//     $output .= '<svg class="absolute right-[10px] h-5 w-5 text-indigo-600 hidden peer-checked:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
//     $output .= '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />';
//     $output .= '</svg>';
//     $output .= '<span class="pointer-events-none absolute -inset-px rounded-lg border-2 border-transparent peer-checked:border-indigo-600" aria-hidden="true"></span>';
//     $output .= '</label>';
//     return $output;
// }
function render_card_input($field, $choice, $choice_id, $index, $label_parts)
{
    $output = '<div class="relative">'; // Wrapper to maintain layout
    $output .= '<input type="' . $field['type'] . '" name="input_' . $field['id'] . '" id="' . $choice_id . '" value="' . esc_attr($choice['value']) . '" class="sr-only peer">';
    $output .= '<label for="' . $choice_id . '" class="flex cursor-pointer h-full rounded-lg border text-gray-600 font-medium bg-white p-4 shadow-sm focus:outline-none peer-checked:ring-2 peer-checked:ring-blue peer-checked:text-gray-900">';
    $output .= '<span class="flex flex-1">';
    $output .= '<span class="flex flex-col">';
    $output .= '<span class="block text-base pr-5 leading-6">' . esc_html($label_parts[0]) . '</span>';
    if (isset($label_parts[1])) {
        $output .= '<span class="mt-1 flex font-normal items-center text-sm text-gray-500">' . esc_html($label_parts[1]) . '</span>';
    }
    $output .= '</span>';
    $output .= '</span>';
    $output .= '</label>';
    $output .= '<svg class="absolute right-[10px] top-[18px] h-5 w-5 text-blue hidden peer-checked:block pointer-events-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
    $output .= '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />';
    $output .= '</svg>';
    $output .= '</div>';
    return $output;
}

function render_standard_input($field, $choice, $choice_id, $index, $label_parts)
{
    $output = '<div class="relative flex items-start">';
    $output .= '<div class="flex h-6 items-center">';
    $output .= '<input id="' . $choice_id . '" name="input_' . $field['id'] . '" type="' . $field['type'] . '" value="' . esc_attr($choice['value']) . '" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">';
    $output .= '</div>';
    $output .= '<div class="ml-3 text-sm leading-6">';
    $output .= get_label_for_radio_and_checkbox_input($choice_id, $label_parts[0]);
    if (isset($label_parts[1])) {
        $output .= '<p id="' . $choice_id . '-description" class="text-gray-500">' . esc_html($label_parts[1]) . '</p>';
    }
    $output .= '</div>';
    $output .= '</div>';
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
