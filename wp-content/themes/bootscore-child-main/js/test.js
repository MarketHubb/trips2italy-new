(function($) {

    function toggleFooterBtnState(eventEl) {
        console.log(eventEl[0]);
    }

    $('body').on('click', '#form-next', function(event) {
        toggleFooterBtnState($(this));
    });

})( jQuery );
