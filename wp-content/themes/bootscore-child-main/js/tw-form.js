document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.gform_wrapper');
    if (!form) return;

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

    // Add event listeners for form field changes
    form.addEventListener('change', handleFieldChange);
    form.addEventListener('input', handleFieldChange);

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

    function handleRadioChange(radio) {
        const fieldset = radio.closest('fieldset');
        const labels = fieldset.querySelectorAll('label.input-card-label');

        labels.forEach(label => {
            const svg = label.querySelector('svg');
            const span = label.querySelector('span.pointer-events-none');
            if (label.contains(radio) && radio.checked) {
                svg.classList.remove('hidden');
                span.classList.add('border-indigo-600');
                span.classList.remove('border-transparent');
            } else {
                svg.classList.add('hidden');
                span.classList.remove('border-indigo-600');
                span.classList.add('border-transparent');
            }
        });
    }

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

    function handleFieldChange() {
        applyConditionalLogicToPages();
        conditionalFields.forEach(field => {
            const conditionalLogic = field.dataset.conditionalLogic;
            if (conditionalLogic) {
                applyConditionalLogic(field, JSON.parse(conditionalLogic));
            }
        });
    }
});
