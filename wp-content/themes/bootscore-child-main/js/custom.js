(function ($) {
    
    $(document).ready(function () {

        //region CONSTANTS
        const windowHeight = $(window).height();
        const windowWidth = $(window).width();
        const headerHeight = $('header#masthead > nav.navbar').outerHeight();
        const hero = $('header.hero-container');
        const heroHeight = windowHeight - headerHeight;


        // region Functions

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

    });


})(jQuery); // jQuery End
