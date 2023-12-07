(function($) {

    const formFooter = $('#form-footer-sticky');
    const formNext = $('#form-next');

    function findOpenSlide() {
        let targetNext = null;
        let targetPrev = null;

        $('.gform-body.gform_body.swiper-wrapper .gform_page').each(function() {
           if ($(this).hasClass('swiper-slide-visible')) {
                let targetFooter = $(this).find('.gform_page_footer');
           }
        });
    }

    $(document).on('click', '#clickWay', function() {
        $("#googleLink").click();
    });

    // Do stuff here
    $(window).load(function() {

        const form = $('#gform_11');
        const timetableInput = $('input[name="input_7"]');
        const seasonInput = $('input[name="input_8"]');
        const dateInput = $('input[name="input_9"]');
        var scheduleTypeInputId = 8;

        $('#gform_next_button_11_1').prop('disabled', true);

        function validateFieldset(input, currentNextBtnId, upcomingNextBtnId) {
            let currentNextBtn = $('#gform_next_button_11_' + currentNextBtnId);
            let upcomingNextBtn = $('#gform_next_button_11_' + upcomingNextBtnId);

            if (upcomingNextBtn.length) {
                upcomingNextBtn.prop('disabled', true);
            }

            if (input.val()) {
                currentNextBtn.prop('disabled', false);
            }
        }


        function setScheduleTypeId(el) {
            if (el.val().toLowerCase().indexOf("dates") >= 0) {
                scheduleTypeInputId = 9;
            } else {
                scheduleTypeInputId = 8;
            }

            return scheduleTypeInputId;
        }

        $('#gform_11 input').on("change", function() {
            let input = $(this);
            let currentNextBtnId;
            let upcomingNextBtnId;
            let scheduleTypeInputName = "input_" + scheduleTypeInputId;

            // Timetable
           if (input.attr("name") === "input_7") {
               setScheduleTypeId(input);
               currentNextBtnId = 1;
               upcomingNextBtnId = 5;

           }

           // Dates / season
           if (input.attr("name") === scheduleTypeInputName) {
               currentNextBtnId = 5;
           }

            validateFieldset(input, currentNextBtnId, upcomingNextBtnId);
        });

        $('#gform_next_button_11_5').on("click", function() {
            if (scheduleTypeInputId === 9) {
                let dateVal = $("input_" + scheduleTypeInputId).val();
                console.log(dateVal);
                let currentDate = new Date();
                let departureDate = new Date(dateVal)
                console.log(departureDate);

                let currentMonth = currentDate.getMonth();
                let departureMonth = departureDate.getMonth();

                console.log(currentMonth);
                console.log(departureMonth);
            }
        });

        $('#gform_next_button_11_10').on("click", function(el) {
            setTimeout(function(){
                $(window).scrollTop(0);
            },500);
        });

        $('form .gf_page_steps .gf_step').on("click", function() {
             $('form .gf_page_steps .gf_step').each(function() {
                $(this).removeClass("gpmpn-step-current");
             });

             $(this).addClass("gpmpn-step-current");
        });





    });




})( jQuery ); // jQuery End
