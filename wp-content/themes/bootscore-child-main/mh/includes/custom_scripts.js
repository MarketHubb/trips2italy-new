/* jQuery (Footer) */
(function($) {

    function showHideText(sSelector, options) {
        // Def. options
        var defaults = {
            charQty: 100,
            ellipseText: "...",
            moreText: "Show more",
            lessText: "Show less"
        };

        var settings = $.extend({}, defaults, options);

        var s = this;

        s.container = $(sSelector);
        s.containerH = s.container.height();

        s.container.each(function () {
            var content = $(this).html();

            if (content.length > settings.charQty) {

                var visibleText = content.substr(0, settings.charQty);
                var hiddenText = content.substr(settings.charQty, content.length - settings.charQty);

                var html = visibleText
                    + '<span class="moreellipses">' +
                    settings.ellipseText
                    + '</span><span class="morecontent"><span>' +
                    hiddenText
                    + '</span><a href="" class="morelink fs-5 fw-bold">' +
                    settings.moreText + '<i class="fa-solid fa-caret-down ms-2"></i>'
                    + '</a></span>';

                $(this).html(html);
            }

        });

        s.showHide = function (event) {
            event.preventDefault();
            if ($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(settings.moreText);

                $(this).prev().fadeToggle('fast', function () {
                    $(this).parent().prev().fadeIn();
                });
            } else {
                $(this).addClass("less");
                $(this).html(settings.lessText);

                $(this).parent().prev().hide();
                $(this).prev().fadeToggle('fast');
            }
        }

        $(".morelink").bind('click', s.showHide);
    }

    $(window).load(function() {

        // Resize itinerary first panel
        let firstPanel = $('.wpex .ex_s_lick-list.draggable');
        let initializedHeight = firstPanel.height();
        let newHeight = initializedHeight + 30;
        setTimeout(
            function()
            {
                $('.wpex .ex_s_lick-list.draggable').css('height', newHeight);
            }, 1000);


        const tripType = $('#top-page').data('type');
        const mediaQueryLarge = window.matchMedia('(min-width: 768px)')
        const mediaQuerySmall = window.matchMedia('(max-width: 768px)')

        // Dynamically replace trip "type" in template
        if (tripType !== null) {
            let tripText;
            $('.trip-type').each(function() {
                if ($(this).hasClass('lower-case')) {
                   // tripText = tripType.toLowerCase();
                } else {
                   tripText = tripType
                }
               $(this).text(tripText);
            });
            let formQuestionWhen = "When do you want to go on your custom Italian " + tripType;
            $('.gform_body .when-choice > label').text(formQuestionWhen);
        }

        // Large Devices
        if (mediaQueryLarge.matches) {

            // Replace section background images with mobile optimized versions
            $('.bg-desktop-replace').each(function() {
                let bgDesktopImg = $(this).data('bgimage');
                if (bgDesktopImg !== null && bgDesktopImg.length > 0) {
                    bgDesktopImg = "url(" + bgDesktopImg + ")";
                    $(this).css({
                        'background-image': bgDesktopImg
                    });
                }
            });

            // Fix padding issue below fixed nav
            let fixedHeaderHeight = $('#masthead').css('height');
            $('.custom-content').css('padding-top', fixedHeaderHeight);
        }

        // Small Devices
        if (mediaQuerySmall.matches) {

            // Cut off long text and show 'read more' link
            new showHideText('.myContent', {
                charQty     : 250,
                ellipseText : "...",
                moreText    : "Learn more",
                lessText    : "Show less"
            });
        }

    }); // END $(window).load(function()

})( jQuery );