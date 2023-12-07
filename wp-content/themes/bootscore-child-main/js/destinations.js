(function($) {

    $(window).load(function() {

        // Remove empty "Cities of Region...) section (often h4)
        function removeIfH4(el) {
            if (el[0].tagName === "H4") {
                el.remove();
            }
        }

        // let photos = $('#photos-container');
        // let photosBefore = photos.prev();
        // let photosBefore2 = photosBefore.prev();
        //
        // removeIfH4(photosBefore);
        // removeIfH4(photosBefore2);

        // Remove "empty" Travel Guides headings
        $('#content-container p > strong').each(function() {
            if ($(this).text() === "Travel Guides") {
                $(this).closest('p').remove();
            }
        });

    }); // window.load




})( jQuery ); // jQuery End
