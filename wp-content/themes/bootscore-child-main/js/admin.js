(function($) {

    const heroToggle = $('body.post-type-location #hero-banner-toggle input[type="checkbox"]');
    const featuredImageFull = $('body.post-type-location div[data-key="field_63a4ac920c8e2"]');
    const featuredImageMobile = $('body.post-type-location div[data-key="field_63a4ace50c8e3"]');

    function showHideLegacyHeroImages(hide = true) {
        if (hide) {
            featuredImageFull.hide();
            featuredImageMobile.hide();
        } else {
            featuredImageFull.show();
            featuredImageMobile.show();
        }
    }

    //region WINDOW LOAD
    $(window).load(function() {

        heroToggle.on("change", function() {
            alert("hello");
            console.log(featuredImageMobile);
            console.log(featuredImageFull);
            var hide = true;
            if (!$(this).is(':checked')) {
                hide = false;
            }
            showHideLegacyHeroImages(hide);
        });

    });
    //endregion

})( jQuery ); // jQuery End
