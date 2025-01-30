// document.addEventListener('DOMContentLoaded', function () {
//     console.log('DOM loaded. Setting up custom submit logic...');

//     // 1. Grab the custom button by its ID
//     const customSubmitBtn = document.getElementById('form-button-submit');
//     console.log('customSubmitBtn found:', customSubmitBtn);

//     if (!customSubmitBtn) {
//         console.warn('No element with id="form-button-submit" found in DOM.');
//         return;
//     }

//     // 2. On click, try to programmatically click the REAL GF submit button
//     customSubmitBtn.addEventListener('click', function (e) {
//         console.log('Custom submit button was clicked...');
//         e.preventDefault(); // Stop any native form submission

//         // 3. Locate the hidden/original GF submit button in the .gform_footer
//         const gfSubmitBtn = document.querySelector('#gform_14 .gform_footer button[type="submit"]');
//         console.log('Gravity Forms official submit button found:', gfSubmitBtn);

//         if (!gfSubmitBtn) {
//             console.warn('GF submit button not found. Check your DOM or selector.');
//             return;
//         }

//         // 4. Fire click on the real GF button so GF’s normal submission triggers
//         gfSubmitBtn.click();
//         console.log('Triggered click on gfSubmitBtn—Gravity Forms should submit now.');
//     });
// });