(function($) {

    //region CONSTANTS
    const form = $('#gform_11');
    const formSubmitBtn = $('#gform_submit_button_11');
    const footerSubmitBtn = $('#footer-submit');
    //endregion

    //region FUNCTIONS
    function triggerFormNextOrSubmit(target, event) {
        if (!target.hasClass('disabled')) {

            let targetId = target.attr('id');
            console.log(targetId);

            if (targetId === "form-next") {
                let formNextBtn = $('#gform_11 .gform-body .gform_page.swiper-slide-visible.swiper-slide-active .gform_page_footer input[value="Next"]');
                if (event.target === formNextBtn[0]) return false;
                formNextBtn.trigger('click');
            }

            if (targetId === "footer-submit") {
                if (event.target === formSubmitBtn[0]) return false;
                formSubmitBtn.trigger('click');
                form.submit();
            }

        }
    }
    //endregion

    //region WINDOW LOAD
    $(window).load(function() {

        // EVENT: Footer submit
        footerSubmitBtn.on('click', function(event) {
            triggerFormNextOrSubmit($(this), event);
        });

    });
    //endregion

})( jQuery ); // jQuery End
