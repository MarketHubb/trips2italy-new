/* jQuery (Footer) */
(function($) {

    $(window).load(function() {

        // Button Logic
        const btn_forward = $('button#forward');
        const btn_back = $('button#previous');
        btn_forward.on('click',function() {
            let formInputs = $(this).closest('#form-container').find('#form ul.gform_fields li.gfield');
            formInputs.each(function(el){
                if ($(this).css('display') !== 'none') {
                    console.log($(this).attr('id'));
                }
            });
        });

        function extractNumber(str) {
            const regex = /\d+/g;
            const numbers = str.match(regex);
            if (numbers && numbers.length > 0) {
                const targetNumber = parseInt(numbers[numbers.length - 1], 10);
                return targetNumber;
            }
            return null;
        }

        const inputStr = "field_8_12";
        const result = extractNumber(inputStr);
        console.log(result); // Output: 12

        //region Setup & Global Var
        // let formId = $('div.modal').data('id');
        //
        // if (!formId || formId === 'undefined') {
        //     formId = 4;
        // }
        //
        // const form = '#gform_' + formId;
        // const submit = '#gform_submit_button_' + formId;
        //endregion


        //region Custom Bootstrap / Modal Functions
        // const modal = $('#modalppc');
        //
        // modal.on('show.bs.modal', function (event) {
        //     $('#sticky-footer').hide();
        // });
        //
        // modal.on('hide.bs.modal', function (event) {
        //     $('#sticky-footer').show();
        // });
        //endregion


        //region Custom Functions

        // function showCurrentQuestion(next) {
        //     $('.modal-body-container .question-container').each(function() {
        //         if (!$(this).data['q'] === next) {
        //             $(this).addClass('d-none');
        //         } else {
        //             $(this).removeClass('d-none');
        //         }
        //     });
        // }

        // Logic for form progress indicator
        // function ri_form_progress_meter(nextPage) {
        //     $('#form-icon-container .icon-container').each(function(){
        //         $(this).children().removeClass('active');
        //         if ( $(this).data('meter') <= nextPage ) {
        //             $(this).children().addClass('active');
        //         }
        //     });
        // }

        // Modify modal grid (align form left and add Phone CTA module right) if user is on the last page
        // function ri_show_hide_featured_phone_section(nextPage) {
        //     let formContainer = $('#form-container .form-columns');
        //     let formPhoneFeature = $('.form-phone-columns');
        //     let modalSubheadline = $('#modal-body-subheadline');
        //     let modalHeadline = $('#modal-body-headline');
        //     var formContainerClassFull = "col-md-10";
        //     var formContainerClassHalf = "col-md-6 ps-md-5 order-2 order-md-first";
        //     var callContainerClassHalf = "col-md-6";
        //
        //     if (nextPage === 4) {
        //         $(submit).show();
        //         formPhoneFeature
        //             .show()
        //             .insertAfter(formContainer);
        //         formContainer
        //             .removeClass(formContainerClassFull)
        //             .addClass(formContainerClassHalf);
        //         modalSubheadline.toggle();
        //         modalHeadline.toggle();
        //     } else {
        //         formPhoneFeature.hide()
        //         formContainer
        //             .removeClass(formContainerClassHalf)
        //             .addClass(formContainerClassFull);
        //         modalSubheadline.toggle();
        //         modalHeadline.toggle();
        //     }
        //
        //     ri_form_progress_meter(nextPage);
        // }

        // Show form fields that correspond to the active page
        // function ri_show_form_elements(formElementsArray, nextPage) {
        //     formElementsArray.forEach(function(item, index, array) {
        //         $(item).each(function() {
        //             if ( $(this).hasClass('form-page-' + nextPage )) {
        //                 $(this).show();
        //             }
        //         });
        //     });
        //     ri_show_hide_featured_phone_section(nextPage);
        // }

        // Hide all form elements and use ri_show_form_elements() to control visibility
        // function ri_hide_form_elements(nextPage) {
        //     let formFields =  '#gform_fields_' + formId + ' li.gfield';
        //     let formElementsArray = [
        //         '#form-container .form-continue-button',
        //         formFields,
        //         '.form-features-section .form-features',
        //         '#form-container .form-back-btn',
        //         submit
        //     ];
        //
        //     formElementsArray.forEach(function(item, index, array) {
        //         $(item).each(function() {
        //             $(this).hide();
        //         });
        //     });
        //
        //     ri_show_form_elements(formElementsArray, nextPage);
        // }

        // Get current month
        function get_current_month_name() {
            var month = new Array();
            month[0]  = "January";
            month[1]  = "February";
            month[2]  = "March";
            month[3]  = "April";
            month[4]  = "May";
            month[5]  = "June";
            month[6]  = "July";
            month[7]  = "August";
            month[8]  = "September";
            month[9]  = "October";
            month[10] = "November";
            month[11] = "December";

            var date = new Date();
            var month = month[date.getMonth()];

            return month;
        }
        //endregion


        //region On Page Load (Instantiation)



        //region NEW
        const introContainer = $('#intro');
        const whenContainer = $('#when');
        const buttonContainer = $('#button');
        const warningContainer = $('#warning');
        const forwardButton = $('#forward');
        const formContainer = $('#form');
        const formSubmit = $('#gform_submit_button_8');

        function showFormQuestion(current) {
            $('#gform_8 ul.gform_fields li.gfield').each(function() {
                $(this).hide();

                if ($(this).hasClass('form-page-' + current)) {
                    $(this).show();
                }
            });
        }

        function incrementForm(next,direction) {
            buttonContainer.attr('data-current', next);

            if (next === 0) {
                whenContainer.hide();
                buttonContainer.hide();
                introContainer.show();
            } else if (next === 1) {
                if (direction === 'previous') {
                    forwardButton.prop('disabled', false);
                }
                introContainer.hide();
                whenContainer.show();
                buttonContainer.css('display', 'flex');
                formContainer.hide();
            } else if (next > 1) {
                whenContainer.hide();
                formContainer.show();
                let currentFormQuestion = parseInt(next) - 1;
                showFormQuestion(currentFormQuestion);

                // if (direction === 'forward') {
                //     forwardButton.prop('disabled', true);
                // } else if (direction === 'previous') {
                //     forwardButton.prop('disabled', false);
                // }
            }

            // Enable for "When are you leaving?" (user might not have anything to enter)
            if (next === 4) {
                forwardButton.prop('disabled', false);
                if (direction === 'previous') {
                    formSubmit.hide();
                    forwardButton.show();
                }
            }

            // Final page. Hide continue & show submit
            if (next === 5) {
                forwardButton.hide();
                formSubmit.show();
            }

        }

        function formNavigate(current, direction) {
            current = parseInt(current);
            var next = null;

            if (direction === 'previous') {
                next = current - 1;
            }
            if (direction === 'forward') {
                next = current + 1;
            }

            incrementForm(next,direction)
        }

        function cleanInputsForDynamicInputs(val) {
            let cleanInput = null;

            if (val.includes("Soon")) {
                cleanInput = "Soon (1-6 months)";
            }
            if (val.includes("This")) {
                cleanInput = "This Year (6-12 months)";
            }
            if (val.includes("Next")) {
                cleanInput = "Next Year (13+ months)";
            }
            if (val.includes("Not")) {
                cleanInput = "Not Sure";
            }

            return cleanInput;
        }

        function dynamicallyPopulateForm(val, inputID) {
            let inputId = '#input_8_' + inputID;

            if (inputID === 22) {
                var cleanInput = cleanInputsForDynamicInputs(val);
            }

            $(inputId).val(cleanInput);
        }

        $('#departure-selection .departure-question').on('click touchstart', function() {
            // Container
            $('#departure-selection .departure-question').each(function (){
                $(this).removeClass('active');
            });
            $(this).addClass('active');

            // Icon
            $('#departure-selection .departure-question i').each(function (){
                $(this).removeClass('active');
            });
            $(this).find('i').addClass('active');

            dynamicallyPopulateForm($(this).find('h3').text(), 22)

            forwardButton.prop('disabled', false);
        });

        // $('#gform_8 input').on('change', function() {
        //     let input = $(this).closest('li.gchoice').find('input');
        //     console.log(input.attr('type'));
        //
        //     if ($('#gform_8 input').is(':checked')) {
        //         forwardButton.prop('disabled', false);
        //     } else {
        //         forwardButton.prop('disabled', true);
        //     }
        // });

        $(document).on('click','.form-nav button', function () {
            let current = buttonContainer.attr('data-current');
            var direction = $(this).attr('id');

            console.log(current);
            console.log(direction);

            formNavigate(current, direction);
        });

        $('#start').on('click', function() {
            formNavigate("0", "forward");
        });

        // On page load
        formSubmit.hide();

        // ### REMOVE ###
        var myModal = new bootstrap.Modal(document.getElementById('modalppc'), {
            keyboard: false
        })
        // myModal.show();
        //endregion

        //region Need to be tested BEFORE removal

        // Dynamically set current month on date picker input
        // $(form + ' .gform_body .gform_fields > li.gfield > label').each(function() {
        //     if ($(this).text() === "Month") {
        //         $(this).closest('li.gfield').find('select.gfield_select').val(get_current_month_name())
        //     }
        // });

        // Remove default onclick attribute from Gravity Forms submit input
        // $(submit).removeAttr('onclick');

        // Event: Show date selections *if* user knows when they want to go
        // REPLACE WITH DATE PICKER
        // if (formId === 8) {
        //     $(form + ' .gform_body .gform_fields > li.gfield.when-choice input[name="input_13"]').on('change', function() {
        //         let listItem = $(this).closest('li');
        //         if (listItem.hasClass('gchoice_8_13_0')) {
        //             $(form + ' .gform_body .gform_fields > li.gfield.dates').show();
        //         } else  {
        //             $(form + ' .gform_body .gform_fields > li.gfield.dates').hide();
        //         }
        //     });
        // }

        //endregion



        // Ensure modal launches with only page 1 form elements visible (hide everything else)
        // $(submit).hide();
        // $(form + ' .gform_body .gform_fields > li.gfield:not(.form-page-1)').hide();
        // $('.form-continue-button').each(function() {
        //     if (!$(this).hasClass('form-page-1')) {
        //         $(this).hide();
        //     }
        // });

        //endregion


        //region DOM Events


        // Event: Next page
        // $('.form-continue').on('click', function() {
        //     let nextPage = $(this).data('formbutton') + 1;
        //     ri_hide_form_elements(nextPage);
        // });

        // Event: Previous page
        // $('#form-container .form-back-btn .form-back').on('click', function() {
        //     let nextPage = $(this).data('backbutton') - 1;
        //     ri_hide_form_elements(nextPage);
        // });

        // Modify label for 'When do you want to go?' based on previous answer
        // if (formId === 4) {
        //     $('#form-continue-1').on('click', function() {
        //         var trip_type = $('#input_4_2').val();
        //         $('#field_4_10 .gsection_title').text("When do you want to go on your " + trip_type.toLowerCase() + "?");
        //     });
        // }

        // Custom form validation and error handling
        $('#gform_4').on('submit', function(e) {
            var name = $('#input_4_5');
            var email = $('#input_4_6');

            // Add error styles to empty name and email input fields
            if (name.val().length === 0 || email.val().length === 0) {
                if (name.val().length === 0) {
                    name.attr('style', 'border: 2px solid red !important');
                }

                if (email.val().length === 0) {
                    email.attr('style', 'border: 2px solid red !important');
                }
                return false;

                // If form passes validation, hide marketing/navigation elements and submit
            } else {
                $('#modal-body-headline').addClass('mobile-no-show');
                $('#modal-body-subheadline').addClass('mobile-no-show');
                $('#form-container .form-back-btn').hide();
                $('#gform_4').submit();
            }
        });
        //endregion


        //region Media Queries

        if ($(window).width() >= 980) {
            // Equalize width of logo and CTA button
            var logo = $('.navbar-brand');
            var cta = $('#header-cta-button');
            if (cta.width() > logo.width()) {
                logo.width(cta.width());
            }

            // Vertically align heading text with corresponding content block
            $('.vertical-align-heading').each(function(index, el) {
                var headingHeight = $(this).height();
                var contentHeight = $(this).closest('.vertical-align-container').find('.vertical-align-content').height();
                var offset = (contentHeight - headingHeight) / 2;
                $(this).css('top', offset);
            });

            // Equalize content / image section heights
            $('.height-align-copy-container').each(function(index, el) {
                var contentHeight = $(this).height();
                var image = $(this).closest('.trip-container').find('.height-align-image > img');
                image.css({
                    height: contentHeight,
                    width: 'auto'
                });
            });
        }

        // Change form input text for extra small devices
        if ($(window).width() <= 370) {
            $('#gform_4 input[type="submit"]').val('Get My Itinerary');
        }
        //endregion

    }); // END $(window).load(function()

})( jQuery );