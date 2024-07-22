(function ($) {
    $(document).ready(function () {
        // Hide mobile menu by default
        $('.lg\\:hidden[role="dialog"]').addClass('hidden');

        // Open mobile menu
        $('button:contains("Open main menu")').click(function () {
            $('.lg\\:hidden[role="dialog"]').removeClass('hidden');
            $('body').addClass('overflow-hidden'); // Prevent scrolling when menu is open
        });

        // Close mobile menu
        $('button:contains("Close menu")').click(function () {
            $('.lg\\:hidden[role="dialog"]').addClass('hidden');
            $('body').removeClass('overflow-hidden');
        });

        // Close menu when clicking outside
        $(document).on('click', function (event) {
            if (!$(event.target).closest('.lg\\:hidden[role="dialog"], button:contains("Open main menu")').length) {
                $('.lg\\:hidden[role="dialog"]').addClass('hidden');
                $('body').removeClass('overflow-hidden');
            }
        });

        // Handle window resize
        $(window).resize(function () {
            if ($(window).width() >= 1024) { // 1024px is the default breakpoint for 'lg' in Tailwind
                $('.lg\\:hidden[role="dialog"]').addClass('hidden');
                $('body').removeClass('overflow-hidden');
            }
        });
    });


    //region CONSTANTS
    const pageContainer = $('#page');
    const windowHeight = $(window).height();
    const windowWidth = $(window).width();
    const headerHeight = $('header#masthead > nav.navbar').outerHeight();
    const hero = $('header.hero-container');
    const heroHeight = windowHeight - headerHeight;
    const page3NextBtn = $('#gform_next_button_11_10');
    const formContainer = $('#form-main');
    const formWrapper = $('#gform_wrapper_11');
    const form = $('#gform_11');
    const formSubmitBtn = $('#gform_submit_button_11');
    const footerSubmitBtn = $('#footer-submit');
    const footerNextBtn = $('#form-next');
    //endregion

    //region INITIALIZE
    $('#site').css('padding-top', headerHeight);
    page3NextBtn.prop('disabled', true);
    //endregion

    //region FUNCTIONS
    function showHideForm() {
        pageContainer.toggleClass('d-none')
        formContainer.toggleClass('d-none');
    }

    function formDisplay() {
        let paddingArray = [];

        $('.form-navs').each(function () {
            let placement = $(this).data('placement');
            paddingArray[placement] = $(this).height()
        });

        showHideForm();

        if (Object.keys(paddingArray).length !== 0) {
            formWrapper.css({
                minHeight: '100vh',
                paddingTop: paddingArray.top,
                paddingBottom: paddingArray.bottom
            });
        }

        window.scrollTo(0, 0);
    }

    function triggerFormNextOrSubmit(target, event) {
        if (!target.hasClass('disabled')) {

            let targetId = target.attr('id');

            if (targetId === "form-next") {
                let formNextBtn = $('#gform_11 .gform-body .gform_page.swiper-slide-visible.swiper-slide-active .gform_page_footer input[value="Next"]');
                if (event.target === formNextBtn[0]) return false;
                formNextBtn.trigger('click');
            }

            if (targetId === "footer-submit") {
                if (event.target === formSubmitBtn[0]) return false;
                    
                form.trigger('submit');
                target.addClass('disabled-soft');
                target.prop('disabled', true);
                target.text('Submitting Your Information');
            }

        }
    }

    function removeConditionalRequired() {
        $('#gform_11 .conditionally-required').each(function () {
            $(this).removeClass('gfield_contains_required');
            $(this).find('.gfield_label.gform-field-label span.gfield_required').remove();

            $(this).find('input').each(function () {
                $(this).removeAttr('aria-required');
            });
        });
    }

    function addConditionalRequired(field_id, aria = true) {

        removeConditionalRequired();

        let targetField = $('#field_' + field_id);
        let targetInput = $('#input_' + field_id);
        let requiredSpan = $('<span class="gfield_required"><span class="gfield_required gfield_required_text">(Required)</span></span>');
        let targetLabel = null;

        targetField.addClass("gfield_contains_required");

        if (aria) {
            targetLabel = targetField.find('label.gfield_label.gform-field-label');
            targetInput.attr('aria-required', true);
        } else {
            targetLabel = targetField.find('legend.gfield_label.gform-field-label');
        }

        targetLabel.append(requiredSpan);
    }

    function getCurrentAndNextFormPage() {
        let formPages = $();
        let activeSlider = $('body').find('#gform_11 .gform-body .gform_page.swiper-slide-active');

        if (activeSlider.length === 0) {
            activeSlider = $('#gform_page_11_1');
        }

        formPages['current'] = activeSlider;
        formPages['next'] = activeSlider.next();

        return formPages;
    }

    function getTargetPage(eventEl) {
        let targetPage = null;
        let formPages = getCurrentAndNextFormPage();
        let visiblePage = $('#gform_11 .gform_page.swiper-slide-active');

        if (visiblePage && eventEl.prop('tagName') === 'INPUT') {
            return visiblePage;
        } else {
            if (eventEl.hasClass('gppt-has-page-transitions')) {
                return formPages.current;
            } else if (eventEl.hasClass('form-nav-button')) {
                return formPages.next;
            } else if (eventEl.hasClass('gf_step')) {
                let targetPageId = eventEl.attr('id').replace('gf_step', 'gform_page');
                targetPage = $('#' + targetPageId);
                return targetPage;
            }
        }
    }

    function toggleFooterBtnState(eventEl) {
        let targetPage = null;
        let formPages = getCurrentAndNextFormPage();
        let activePage = $('#gform_11 .gform_page.swiper-slide-active');

        if (eventEl.hasClass('gppt-has-page-transitions')) {
            targetPage = formPages.current;
        } else if (eventEl.hasClass('form-nav-button')) {
            targetPage = formPages.next;
        } else if (eventEl.hasClass('gf_step')) {
            let targetPageId = eventEl.attr('id').replace('gf_step', 'gform_page');
            targetPage = $('#' + targetPageId);
            activePage = targetPage;
        }

        // On final (submit) page
        if (activePage.attr('id') === 'gform_page_11_4') {
            footerSubmitBtn.removeClass('d-none');
            $('#footer-button-submit')
                .removeClass('d-none')
                .addClass('submit-grid-item')
            // .html(formFooter);
            $('#footer-button-next')
                .addClass('d-none')
                .removeClass('order-2')
            // Not on final page
        } else {
            footerSubmitBtn
                .addClass('d-none');
            $('#footer-button-submit')
                .removeClass('submit-grid-item')
            footerNextBtn
                .toggleClass('disabled', targetPage.find('.gform_next_button').prop('disabled'))
            $('#footer-button-next')
                .removeClass('d-none')
                .addClass('order-2')
        }

    }

    function toggleFooterSubmitState(eventEl) {
        let formCompleted = true;
        let targetPage = getTargetPage(eventEl);

        if (targetPage.attr('id') !== 'gform_page_11_4') {
            return false;
        }

        $('#gform_11 #gform_page_11_4 input[type="text"]').each(function () {
            if ($(this).val().length === 0) {
                formCompleted = false;
            }
        });

        if (formCompleted) {
            footerSubmitBtn.removeClass('disabled');
        } else {
            footerSubmitBtn.addClass('disabled');
        }
    }

    //endregion

    //region GRAVITY FORM: Confirmation pae shown
    jQuery(document).on('gform_confirmation_loaded', function () {
        let confirmationWrapper = $('#gform_confirmation_wrapper_11');
        let pageTitle = $('#page').data('title');
        let heroImage = $('.hero-container.hero-mobile').css('background-image');
        heroImage = heroImage.replace('url(', '').replace(')', '').replace(/\"/gi, "");

        if (heroImage.length > 0) {
            confirmationWrapper
                .css('background-image', 'url("' + heroImage + '")')
                .addClass('background-image-full')
        }

        if (pageTitle.length > 0) {
            $('#form-confirmation-title').text(pageTitle);
        }

        $('#form-footer-sticky, #form-main .form-heading').addClass('d-none');
    });
    //endregion

    //region WINDOW LOAD
    $(window).on('load', function () {
        // EVENT: Footer submit
        footerSubmitBtn.on('click', function (event) {
            triggerFormNextOrSubmit($(this), event);
        });
        // EVENT: Show form
        $('body button[data-type="Form"], body button[data-type="Modal"]').on('click', function () {
            formDisplay();
        });

        // EVENT: Hide form
        $('body #form-hide, body #confirmation-back').on('click', function () {
            showHideForm();
        });

        // EVENT: Conditionally require Date or Timetable field
        $('#gform_11 #field_11_7 input[type="radio"]').on("change", function () {
            let fieldId = null;
            let aria = false;
            let attrID = $(this).attr("id");

            // Timetable
            if (attrID !== "choice_11_7_0") {
                fieldId = '11_8';
                // Date
            } else {
                fieldId = '11_9';
                aria = true;
            }

            addConditionalRequired(fieldId, aria);
        });

        //EVENT: Form change (footer button state)
        $('#gform_11').on('change', function (event) {
            let eventEl = $(event.target);
            toggleFooterSubmitState(eventEl);
            toggleFooterBtnState($(this));
            // toggleFooterSubmitState();
        });

        // EVENT: Apply "has-val" class for text inputs with values
        $('#gform_11 input[type="text"]').on('change', function () {
            if ($(this).val().length > 0) {
                $(this).addClass('has-val');
            }
        });

        // EVENT: Form input 16 + 17 change
        $('#input_11_16 input, #input_11_17 input').on('change', function () {
            let importantVals = $('#input_11_16 input:checked').length;
            let regionVals = $('#input_11_17 input:checked').length;

            if (importantVals && regionVals) {
                page3NextBtn.prop('disabled', false);
                footerNextBtn.removeClass('disabled');
            } else {
                page3NextBtn.prop('disabled', true);
                footerNextBtn.addClass('disabled');
            }
        });

        // EVENT: Page transition (footer nav)
        $('body').on('click', '#form-next', function (event) {
            triggerFormNextOrSubmit($(this), event);
            toggleFooterBtnState($(this));
        });

        // EVENT: Page transition (steps)
        $('.gf_page_steps .gf_step').on('click', function () {
            toggleFooterBtnState($(this));
        });

        // FOOTER NAV: After clicking on the steps nav
        $('.gf_page_steps .gf_step').on('click', function () {
            if (!$(this).hasClass('gf_step_active') && !$(this).hasClass('gf_step_pending')) {
                $('#form-next').removeClass('disabled');
            }

        });


        $('a[data-bs-target="#modalppc"]').each(function () {
            $(this)
                .attr({
                    href: '/get-custom-itinerary/',
                    'data-bs-target': '',
                    'data-bs-toggle': '',
                })

        });

        // Locations (Mobile)
        $(function () {
            // bind change event to select
            $('#location_select').on('change', function () {
                let url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location = url; // redirect
                }
                return false;
            });
        });
        
        $('#tabs-package-types li a').on("click", function () {
            let targetLink = $(this);

            $('#tabs-package-types li a').each(function () {
                $(this).removeClass('active')
            });

            targetLink.addClass('active');

            let type = $(this).data('type');
            $('.trip-package-types').each(function () {
                $(this).addClass('d-none');
                if ($(this).attr("id") === type) {
                    $(this).removeClass('d-none');
                }
            });

        });
        // $('#package-type-container .trip-package-types')

        // Clean up custom
        // $('#custom h4 + h4').each(function() {
        //    $(this).hide();
        //    $(this).prev().hide();
        // });
        //
        // $('#custom h4 + p:empty').each(function() {
        //    $(this).closest('.container').hide();
        // });
        //
        // $('#custom p > strong').each(function() {
        //    if ($(this).text() === "Travel Guides") {
        //        $(this).closest('.container').hide();
        //    }
        // });

    });
    //endregion

    //region MOBILE
    if (windowWidth <= 576) {
        let mobileNav = $('#masthead > nav');
        let mobileNavBtn = $('.navbar-toggler');

        mobileNavBtn.on('click', function () {
            mobileNav.toggleClass('shadow-lg-dark')
        });
        // Full height hero background image (less sticky header)
        hero.css({
            minHeight: heroHeight,
        });
    }
    //endregion




})(jQuery); // jQuery End
