document.addEventListener('DOMContentLoaded', function () {
    const mobileSelect = document.getElementById('tabs');
    if (mobileSelect) {
        mobileSelect.addEventListener('change', function () {
            const selectedValue = mobileSelect.value;
            if (selectedValue) {
                window.location.href = selectedValue;
            }
        });
    }
});
