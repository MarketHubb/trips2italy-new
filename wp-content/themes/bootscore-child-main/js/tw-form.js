document.addEventListener("DOMContentLoaded", function () {
    const formContainer = document.querySelector(".gform_wrapper");
    const submitButton = formContainer.querySelector('input[type="submit"]');
    const siteKey = document.getElementById('recaptchaResponse').dataset.sitekey;
    const recaptchaInput = document.getElementById('recaptchaResponse');

    if (!submitButton || !formContainer) return;

    const sliders = document.querySelectorAll('input[type="range"]');
    const radioInputs = document.querySelectorAll('input[type="radio"].peer');
    const pageContainers = formContainer.querySelectorAll(
        ".grid.grid-cols-1.gap-x-8.gap-y-8.md\\:grid-cols-3",
    );
    const fields = formContainer.querySelectorAll(".gfield");
    const conditionalFields = formContainer.querySelectorAll(
        ".gfield_conditional",
    );

    // Initialize radio buttons
    radioInputs.forEach((radio) => {
        radio.addEventListener("change", function (event) {
            handleRadioChange(this);
            handleFieldChange(event);
        });

        // Initialize the state for pre-selected radios
        if (radio.checked) {
            handleRadioChange(radio);
        }
    });

    // Initialize conditional logic
    initializeConditionalLogic();

    // Add event listeners for form field changes and submit
    formContainer.addEventListener("change", handleFieldChange);
    formContainer.addEventListener("input", handleFieldChange);
    formContainer.addEventListener("submit", handleSubmit);

    // Add event listener for form submission
    submitButton.addEventListener("click", handleSubmit);

    sliders.forEach((slider) => {
        const valueDisplay = document.getElementById(slider.id + "_value");

        function updateSliderValue(value) {
            const days = parseInt(value);
            let displayText = days + " day";
            if (days !== 1) {
                displayText += "s";
            }
            valueDisplay.textContent = displayText;
        }

        // Initialize the display
        updateSliderValue(slider.value);

        slider.addEventListener("input", function () {
            updateSliderValue(this.value);
        });
    });

    function initializeConditionalLogic() {
        applyConditionalLogicToPages();
        conditionalFields.forEach((field) => {
            const conditionalLogic = field.dataset.conditionalLogic;
            if (conditionalLogic) {
                applyConditionalLogic(field, JSON.parse(conditionalLogic));
            }
        });
    }

    function applyConditionalLogicToPages() {
        pageContainers.forEach((container, index) => {
            const fields = container.querySelectorAll(".gfield");
            let shouldShowPage = false;
            fields.forEach((field) => {
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
            container.style.display = shouldShowPage ? "" : "none";
        });
    }

    function applyConditionalLogic(field, logic) {
        if (!logic.enabled) return;
        const shouldShow = evaluateLogic(logic);
        field.style.display = shouldShow ? "" : "none";

        // Toggle required attribute for input fields
        const inputs = field.querySelectorAll("input, select, textarea");
        inputs.forEach((input) => {
            if (shouldShow) {
                input.setAttribute("required", "");
            } else {
                input.removeAttribute("required");
            }
        });
    }

    function evaluateLogic(logic) {
        const rules = logic.rules;
        let result = logic.logicType === "all";

        rules.forEach((rule) => {
            const targetField = document.querySelector(
                `[data-field-id="${rule.fieldId}"]`,
            );
            if (!targetField) return;

            const inputElement = targetField.querySelector(
                "input:checked, select, textarea",
            );
            if (!inputElement) return;

            let ruleMatches = false;

            switch (rule.operator) {
                case "is":
                    ruleMatches = inputElement.value === rule.value;
                    break;
                case "isnot":
                    ruleMatches = inputElement.value !== rule.value;
                    break;
                // Add more operators as needed
            }

            if (logic.logicType === "any") {
                result = result || ruleMatches;
            } else {
                result = result && ruleMatches;
            }
        });

        return result;
    }

    function handleRadioChange(radio) {
        const fieldset = radio.closest("fieldset");
        if (!fieldset) return;

        const labels = fieldset.querySelectorAll("label");

        labels.forEach((label) => {
            const svg = label.querySelector("svg");
            const span = label.querySelector("span.pointer-events-none");
            if (label.contains(radio) && radio.checked) {
                if (svg) svg.classList.remove("hidden");
                if (span) {
                    span.classList.add("border-indigo-600");
                    span.classList.remove("border-transparent");
                }
            } else {
                if (svg) svg.classList.add("hidden");
                if (span) {
                    span.classList.remove("border-indigo-600");
                    span.classList.add("border-transparent");
                }
            }
        });
    }

    function handleFieldChange(event) {
        applyConditionalLogicToPages();
        conditionalFields.forEach((field) => {
            const conditionalLogic = field.dataset.conditionalLogic;
            if (conditionalLogic) {
                applyConditionalLogic(field, JSON.parse(conditionalLogic));
            }
        });

        // Hide error messages when field value changes
        const changedField = event.target.closest(".gfield");
        if (changedField) {
            hideError(changedField, changedField.dataset.fieldType);
        }
    }

    // Add event listeners for blur events on text inputs and selects
    formContainer
        .querySelectorAll(
            'input[type="text"], input[type="email"], input[type="number"], input[type="date"], textarea, select',
        )
        .forEach((input) => {
            input.addEventListener("blur", function () {
                const field = this.closest(".gfield");
                if (field && this.value.trim() !== "") {
                    hideError(field, field.dataset.fieldType);
                }
            });
        });

    // Add event listeners for change events on radio and checkbox inputs
    formContainer
        .querySelectorAll('input[type="radio"], input[type="checkbox"]')
        .forEach((input) => {
            input.addEventListener("change", function () {
                const field = this.closest(".gfield");
                if (field) {
                    const inputs = field.querySelectorAll(`input[type="${this.type}"]`);
                    const isChecked = Array.from(inputs).some((input) => input.checked);
                    if (isChecked) {
                        hideError(field, field.dataset.fieldType);
                    }
                }
            });
        });

    function verifyCaptcha(token) {
        if (!token) {
            console.error("No reCAPTCHA token provided");
            return Promise.resolve(false);
        }

        let formData = new FormData();
        formData.append('action', 'verify_recaptcha');
        formData.append('token', token);

        return fetch(ajax_object.ajax_url, {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("reCAPTCHA verification result:", data);
                if (data.success === true) {
                    return true; // Verification successful
                } else {
                    console.error("reCAPTCHA verification failed:", data.data?.error);
                    return false; // Verification failed
                }
            })
            .catch((error) => {
                console.error("Error verifying reCAPTCHA:", error);
                return false; // Error occurred
            });
    }

    function generateCaptchaToken() {
        return new Promise((resolve, reject) => {
            if (!siteKey || !recaptchaInput) {
                console.error("reCAPTCHA elements not found");
                reject("reCAPTCHA elements not found");
                return;
            }
            console.log("Site key:", siteKey);
            console.log("grecaptcha object:", typeof grecaptcha, grecaptcha);

            grecaptcha.ready(function () {
                grecaptcha.execute(siteKey, { action: 'submit' })
                    .then(function (token) {
                        console.log("reCAPTCHA token generated:", token);
                        recaptchaInput.value = token;
                        console.log("Token set to input field:", recaptchaInput.value);
                        resolve(token);
                    })
                    .catch(function (error) {
                        console.error("Error executing reCAPTCHA:", error);
                        reject(error);
                    });
            });
        });
    }

    async function handleSubmit(event) {
        event.preventDefault();
    
        try {
            // Wait for the token to be generated
            const token = await generateCaptchaToken();

            // Now that we have the token, proceed with the rest of the submission
            let formData = new FormData(formContainer);
            formData.append('g-recaptcha-response', token);  // Add this line

            // Verify the captcha
            const captchaVerified = await verifyCaptcha(token);  // Pass token directly

            if (!captchaVerified) {
                console.error("reCAPTCHA verification failed");
                showFormError("reCAPTCHA verification failed. Please try again.");
                return;
            }

            // Proceed with form validation
            let isValid = validateForm();

            if (isValid) {
                // Proceed with form submission
                await submitForm(formData);
            } else {
                // Scroll to the first error
                const firstError = formContainer.querySelector(
                    ".gfield .text-red-600:not(.hidden)"
                );
                if (firstError) {
                    firstError.scrollIntoView({ behavior: "smooth", block: "center" });
                }
            }

        } catch (error) {
            console.error("Error during form submission:", error);
            showFormError("An error occurred during form submission. Please try again.");
        }
    }


    function validateForm() {
        let isValid = true;
    
        fields.forEach((field) => {
            if (
                field.style.display !== "none" ||
                field.classList.contains("gfield_hidden")
            ) {
                const fieldType = field.dataset.fieldType;

                if (fieldType === "radio" || fieldType === "checkbox") {
                    const inputs = field.querySelectorAll(`input[type="${fieldType}"]`);

                    if (inputs.length > 0) {
                        const isRequired = inputs[0].hasAttribute("required");
                        const isChecked = Array.from(inputs).some((input) => input.checked);

                        if (isRequired && !isChecked) {
                            isValid = false;
                            showError(field, fieldType);
                        } else {
                            hideError(field, fieldType);
                        }
                    }
                } else {
                    const inputs = field.querySelectorAll(
                        'input:not([type="submit"]), select, textarea'
                    );
                    inputs.forEach((input) => {
                        if (input.hasAttribute("required") && !input.value.trim()) {
                            isValid = false;
                            showError(field, fieldType);
                        } else {
                            hideError(field, fieldType);
                        }
                    });
                }
            }
        });

        return isValid;
    }

    async function submitForm(formData) {
        formData.append("action", "submit_custom_gravity_form");
        formData.append("form_id", formContainer.dataset.formId);

        // Ensure nonce is added only once
        if (!formData.has("nonce")) {
            formData.append(
                "nonce",
                formContainer.querySelector('input[name="nonce"]').value
            );
        }

        try {
            const response = await fetch(ajax_object.ajax_url, {
                method: "POST",
                body: formData,
            });
            const data = await response.json();
            console.log("Parsed response data:", data);

            if (data.redirect) {
                console.log("Redirecting to:", data.redirect);
                window.location.href = data.redirect;
            } else if (data.confirmation) {
                showConfirmation(data.confirmation);
            } else {
                console.error("Unexpected response structure:", data);
                showFormError("An unexpected error occurred. Please try again.");
            }
        } catch (error) {
            console.error("Fetch error:", error);
            showFormError("An error occurred. Please try again.");
        }
    }


    function showFormError(message) {
        // Show error message at the top of the form
        const errorDiv = document.createElement("div");
        errorDiv.className = "form-error";
        errorDiv.textContent = message;
        formContainer.prepend(errorDiv);
    }

    function showConfirmation(message) {
        // Replace form with confirmation message
        formContainer.innerHTML = `<div class="confirmation-message">${message}</div>`;
    }

    function showError(field, fieldType) {
        if (typeof field === "string") {
            showFormError(field);
            return;
        }

        if (!field || typeof field.querySelector !== "function") {
            console.error("Invalid field element:", field);
            return;
        }

        if (fieldType === "radio" || fieldType === "checkbox") {
            const fieldset = field.querySelector("fieldset");
            if (fieldset) {
                fieldset.classList.add("error");
            }
        } else {
            const errorIcon = field.querySelector(".pointer-events-none");
            if (errorIcon) errorIcon.classList.remove("hidden");
        }

        const errorMessage = field.querySelector(".text-red-600");
        if (errorMessage) errorMessage.classList.remove("hidden");
    }

    function hideError(field, fieldType) {
        if (fieldType === "radio" || fieldType === "checkbox") {
            const fieldset = field.querySelector("fieldset");
            if (fieldset) {
                fieldset.classList.remove("error");
            }
        } else {
            const errorIcon = field.querySelector(".pointer-events-none");
            if (errorIcon) errorIcon.classList.add("hidden");
        }

        const errorMessage = field.querySelector(".text-red-600");
        if (errorMessage) errorMessage.classList.add("hidden");
    }
});
