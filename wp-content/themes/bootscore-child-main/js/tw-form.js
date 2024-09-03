document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.gform_wrapper');
    const submitButton = form.querySelector('input[type="submit"]');

    if (!submitButton || !form) return;

    const sliders = document.querySelectorAll('input[type="range"]');
    const radioInputs = document.querySelectorAll('input[type="radio"].peer');
    const pageContainers = form.querySelectorAll('.grid.grid-cols-1.gap-x-8.gap-y-8.md\\:grid-cols-3');
    const fields = form.querySelectorAll('.gfield');
    const conditionalFields = form.querySelectorAll('.gfield_conditional');

    // Initialize radio buttons
    radioInputs.forEach(radio => {
        radio.addEventListener('change', function () {
            handleRadioChange(this);
            handleFieldChange();
        });

        // Initialize the state for pre-selected radios
        if (radio.checked) {
            handleRadioChange(radio);
        }
    });

    // Initialize conditional logic
    initializeConditionalLogic();

    // Add event listeners for form field changes and submit
    form.addEventListener('change', handleFieldChange);
    form.addEventListener('input', handleFieldChange);
    form.addEventListener('submit', handleSubmit);

    // Add event listener for form submission
    submitButton.addEventListener('click', handleSubmit);

    sliders.forEach(slider => {
        const valueDisplay = document.getElementById(slider.id + '_value');
        
        function updateSliderValue(value) {
            const days = parseInt(value);
            let displayText = days + ' day';
            if (days !== 1) {
                displayText += 's';
            }
            valueDisplay.textContent = displayText;
        }
        
        // Initialize the display
        updateSliderValue(slider.value);
        
        slider.addEventListener('input', function () {
            updateSliderValue(this.value);
        });
    }); 

    function initializeConditionalLogic() {
        applyConditionalLogicToPages();
        conditionalFields.forEach(field => {
            const conditionalLogic = field.dataset.conditionalLogic;
            if (conditionalLogic) {
                applyConditionalLogic(field, JSON.parse(conditionalLogic));
            }
        });
    }

    function applyConditionalLogicToPages() {
        pageContainers.forEach((container, index) => {
            const fields = container.querySelectorAll('.gfield');
            let shouldShowPage = false;
            fields.forEach(field => {
                const conditionalLogic = field.dataset.conditionalLogic;
                if (conditionalLogic) {
                    const logic = JSON.parse(conditionalLogic);
                    if (evaluateLogic(logic)) {
                        shouldShowPage = true;
                    }
                } else {
                    shouldShowPage = true; // Show page if any field doesn't have conditional logic
                }
            });
            container.style.display = shouldShowPage ? '' : 'none';
        });
    }

    function applyConditionalLogic(field, logic) {
        if (!logic.enabled) return;
        const shouldShow = evaluateLogic(logic);
        field.style.display = shouldShow ? '' : 'none';
        
        // Toggle required attribute for input fields
        const inputs = field.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            if (shouldShow) {
                input.setAttribute('required', '');
            } else {
                input.removeAttribute('required');
            }
        });
    }

    function evaluateLogic(logic) {
        const rules = logic.rules;
        let result = logic.logicType === 'all';

        rules.forEach(rule => {
            const targetField = document.querySelector(`[data-field-id="${rule.fieldId}"]`);
            if (!targetField) return;

            const inputElement = targetField.querySelector('input:checked, select, textarea');
            if (!inputElement) return;

            let ruleMatches = false;

            switch (rule.operator) {
                case 'is':
                    ruleMatches = inputElement.value === rule.value;
                    break;
                case 'isnot':
                    ruleMatches = inputElement.value !== rule.value;
                    break;
                // Add more operators as needed
            }

            if (logic.logicType === 'any') {
                result = result || ruleMatches;
            } else {
                result = result && ruleMatches;
            }
        });

        return result;
    }

    function handleRadioChange(radio) {
        const fieldset = radio.closest('fieldset');
        if (!fieldset) return;

        const labels = fieldset.querySelectorAll('label');

        labels.forEach(label => {
            const svg = label.querySelector('svg');
            const span = label.querySelector('span.pointer-events-none');
            if (label.contains(radio) && radio.checked) {
                if (svg) svg.classList.remove('hidden');
                if (span) {
                    span.classList.add('border-indigo-600');
                    span.classList.remove('border-transparent');
                }
            } else {
                if (svg) svg.classList.add('hidden');
                if (span) {
                    span.classList.remove('border-indigo-600');
                    span.classList.add('border-transparent');
                }
            }
        });
    }

    function handleFieldChange() {
        applyConditionalLogicToPages();
        conditionalFields.forEach(field => {
            const conditionalLogic = field.dataset.conditionalLogic;
            if (conditionalLogic) {
                applyConditionalLogic(field, JSON.parse(conditionalLogic));
            }
        });

        // Hide error messages when field value changes
        const changedField = event.target.closest('.gfield');
        if (changedField) {
            hideError(changedField, changedField.dataset.fieldType);
        }
    }

    // Add event listeners for blur events on text inputs and selects
    form.querySelectorAll('input[type="text"], input[type="email"], input[type="number"], input[type="date"], textarea, select').forEach(input => {
        input.addEventListener('blur', function () {
            const field = this.closest('.gfield');
            if (field && this.value.trim() !== '') {
                hideError(field, field.dataset.fieldType);
            }
        });
    });

    // Add event listeners for change events on radio and checkbox inputs
    form.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(input => {
        input.addEventListener('change', function () {
            const field = this.closest('.gfield');
            if (field) {
                const inputs = field.querySelectorAll(`input[type="${this.type}"]`);
                const isChecked = Array.from(inputs).some(input => input.checked);
                if (isChecked) {
                    hideError(field, field.dataset.fieldType);
                }
            }
        });
    });

    function handleSubmit(event) {
        event.preventDefault();
    
        let isValid = true;
        
        fields.forEach(field => {
            if (field.style.display !== 'none' || field.classList.contains('gfield_hidden')) {
                const fieldType = field.dataset.fieldType;
            
                if (fieldType === 'radio' || fieldType === 'checkbox') {
                    const inputs = field.querySelectorAll(`input[type="${fieldType}"]`);
                
                    if (inputs.length > 0) {
                        const isRequired = inputs[0].hasAttribute('required');
                        const isChecked = Array.from(inputs).some(input => input.checked);
                    
                        if (isRequired && !isChecked) {
                            isValid = false;
                            showError(field, fieldType);
                        } else {
                            hideError(field, fieldType);
                        }
                    }

                    // For hidden checkbox fields, add all values to formData
                    if (field.classList.contains('gfield_hidden')) {
                        inputs.forEach(input => {
                            formData.append(input.name, input.value);
                        });
                    }
                } else {
                    const inputs = field.querySelectorAll('input:not([type="submit"]), select, textarea');
                    inputs.forEach(input => {
                        if (input.hasAttribute('required') && !input.value.trim()) {
                            isValid = false;
                            showError(field, fieldType);
                        } else {
                            hideError(field, fieldType);
                        }

                        // For hidden fields, add value to formData
                        if (field.classList.contains('gfield_hidden')) {
                            formData.append(input.name, input.value);
                        }
                    });
                }
            }
        });
        
        if (isValid) {
            const formData = new FormData(form);
            formData.append('action', 'submit_custom_gravity_form');
            formData.append('form_id', form.dataset.formId);

            
            // Handle hidden fields
            document.querySelectorAll('.gfield_hidden input[type="hidden"]').forEach(hiddenInput => {
                formData.append(hiddenInput.name, hiddenInput.value);
            });

            // Log the form data being sent
            console.log('Submitting form data:', Object.fromEntries(formData));

            fetch(ajax_object.ajax_url, {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    console.log('Raw response:', response);
                    return response.text(); // Change this to text() instead of json()
                })
                .then(data => {
                    console.log('Raw response data:', data);
                    try {
                        const jsonData = JSON.parse(data);
                        if (jsonData.success) {
                            showConfirmation(jsonData.data.confirmation);
                        } else {
                            showError(jsonData.data.error || 'An unknown error occurred');
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                        // If it's not JSON, it might be the HTML response we saw earlier
                        if (data.includes('GF_AJAX_POSTBACK')) {
                            const parser = new DOMParser();
                            const htmlDoc = parser.parseFromString(data, 'text/html');
                            const message = htmlDoc.body.textContent.trim();
                            showConfirmation(message);
                        } else {
                            showError('An error occurred while processing the response. Please try again.');
                        }
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    showError('An error occurred. Please try again.');
                });
        } 
        else {
            // Scroll to the first error
            const firstError = form.querySelector('.gfield .text-red-600:not(.hidden)');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    }

    function showFormError(message) {
        // Show error message at the top of the form
        const errorDiv = document.createElement('div');
        errorDiv.className = 'form-error';
        errorDiv.textContent = message;
        form.prepend(errorDiv);
    }



    // Add these functions if they don't already exist
    function showConfirmation(message) {
        // Replace form with confirmation message
        form.innerHTML = `<div class="confirmation-message">${message}</div>`;
    }

    function showError(field, fieldType) {
        if (typeof field === 'string') {
            showFormError(field);
            return;
        }

        if (!field || typeof field.querySelector !== 'function') {
            console.error('Invalid field element:', field);
            return;
        }

        if (fieldType === 'radio' || fieldType === 'checkbox') {
            const fieldset = field.querySelector('fieldset');
            if (fieldset) {
                fieldset.classList.add('error');
            }
        } else {
            const errorIcon = field.querySelector('.pointer-events-none');
            if (errorIcon) errorIcon.classList.remove('hidden');
        }

        const errorMessage = field.querySelector('.text-red-600');
        if (errorMessage) errorMessage.classList.remove('hidden');
    }

    
    // function showError(field, fieldType) {
    //     if (fieldType === 'radio' || fieldType === 'checkbox') {
    //         const fieldset = field.querySelector('fieldset');
    //         if (fieldset) {
    //             fieldset.classList.add('error');
    //         }
    //     } else {
    //         const errorIcon = field.querySelector('.pointer-events-none');
    //         if (errorIcon) errorIcon.classList.remove('hidden');
    //     }

    //     const errorMessage = field.querySelector('.text-red-600');
    //     if (errorMessage) errorMessage.classList.remove('hidden');
    // }

    function hideError(field, fieldType) {
        if (fieldType === 'radio' || fieldType === 'checkbox') {
            const fieldset = field.querySelector('fieldset');
            if (fieldset) {
                fieldset.classList.remove('error');
            }
        } else {
            const errorIcon = field.querySelector('.pointer-events-none');
            if (errorIcon) errorIcon.classList.add('hidden');
        }

        const errorMessage = field.querySelector('.text-red-600');
        if (errorMessage) errorMessage.classList.add('hidden');
    }

});
