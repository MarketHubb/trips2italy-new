document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('mobile-nav').addEventListener('change', function () {
        var selectedValue = this.value;
        if (selectedValue) {
            window.location.href = selectedValue;
        }
    });

    const header = document.getElementById('tw-nav-primary');
    const sidebarNav = document.getElementById('sidebar-nav');
    const mobileNav = document.getElementById('mobile-nav-container');
    const parentDiv = document.getElementById('location-posts');
    
    if (!header || !sidebarNav || !parentDiv) {
        console.log('Required elements not found. Sidebar functionality will not be initialized.');
        return;
    }

    let headerHeight;
    let ticking = false;
    let sidebarInitialTop;
    let sidebarInitialWidth;
    let mobileNavInitialTop;
    let mobileNavInitialWidth;
    let parentBottom;

    function initializeSidebar() {
        headerHeight = header.offsetHeight;
        sidebarInitialTop = sidebarNav.getBoundingClientRect().top + window.pageYOffset;
        sidebarInitialWidth = sidebarNav.offsetWidth;
        mobileNavInitialTop = mobileNav.getBoundingClientRect().top + window.pageYOffset;
        mobileNavInitialWidth = mobileNav.offsetWidth;
        parentBottom = parentDiv.getBoundingClientRect().bottom + window.pageYOffset;
        sidebarNav.style.width = `${sidebarInitialWidth}px`;
    }

    function updateNavPositions() {
        const scrollY = window.scrollY;
        const viewportHeight = window.innerHeight;
        const sidebarHeight = sidebarNav.offsetHeight;
        const mobileNavHeight = mobileNav.offsetHeight;

        // Sidebar positioning
        const sidebarTopTrigger = sidebarInitialTop - headerHeight - 10;
        const sidebarBottomTrigger = parentBottom - sidebarHeight - headerHeight - 10;

        if (scrollY > sidebarTopTrigger && scrollY < sidebarBottomTrigger) {
            if (!sidebarNav.classList.contains('fixed')) {
                sidebarNav.classList.remove('relative', 'absolute');
                sidebarNav.classList.add('fixed');
                sidebarNav.style.top = `${headerHeight + 10}px`;
                sidebarNav.style.bottom = 'auto';
                sidebarNav.style.maxHeight = `${viewportHeight - headerHeight - 20}px`;
            }
        } else if (scrollY >= sidebarBottomTrigger) {
            if (!sidebarNav.classList.contains('absolute')) {
                sidebarNav.classList.remove('fixed', 'relative');
                sidebarNav.classList.add('absolute');
                sidebarNav.style.top = 'auto';
                sidebarNav.style.bottom = '0';
                sidebarNav.style.maxHeight = 'none';
            }
        } else {
            if (!sidebarNav.classList.contains('relative')) {
                sidebarNav.classList.remove('fixed', 'absolute');
                sidebarNav.classList.add('relative');
                sidebarNav.style.top = 'auto';
                sidebarNav.style.bottom = 'auto';
                sidebarNav.style.maxHeight = 'none';
            }
        }

        // Mobile nav positioning
        const mobileTopTrigger = mobileNavInitialTop - headerHeight;
        const mobileBottomTrigger = parentBottom - mobileNavHeight - headerHeight;

        if (scrollY > mobileTopTrigger && scrollY < mobileBottomTrigger) {
            if (!mobileNav.classList.contains('fixed')) {
                mobileNav.classList.remove('relative', 'absolute');
                mobileNav.classList.add('fixed');
                mobileNav.style.top = `${headerHeight}px`;
                mobileNav.style.bottom = 'auto';
            }
        } else if (scrollY >= mobileBottomTrigger) {
            if (!mobileNav.classList.contains('absolute')) {
                mobileNav.classList.remove('fixed', 'relative');
                mobileNav.classList.add('absolute');
                mobileNav.style.top = 'auto';
                mobileNav.style.bottom = '0';
            }
        } else {
            if (!mobileNav.classList.contains('relative')) {
                mobileNav.classList.remove('fixed', 'absolute');
                mobileNav.classList.add('relative');
                mobileNav.style.top = 'auto';
                mobileNav.style.bottom = 'auto';
            }
        }

        ticking = false;
    }


    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(updateNavPositions);
            ticking = true;
        }
    }

    window.addEventListener('scroll', onScroll);
    window.addEventListener('resize', function () {
        initializeSidebar();
        updateNavPositions();
    });

    initializeSidebar();
    updateNavPositions();
});
