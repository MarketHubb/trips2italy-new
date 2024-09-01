// region State 
document.addEventListener('DOMContentLoaded', function () {
    const radioInputs = document.querySelectorAll('input[type="radio"].peer');

    radioInputs.forEach(radio => {
        radio.addEventListener('change', function () {
            handleRadioChange(this);
        });

        // Initialize the state for pre-selected radios
        if (radio.checked) {
            handleRadioChange(radio);
        }
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
