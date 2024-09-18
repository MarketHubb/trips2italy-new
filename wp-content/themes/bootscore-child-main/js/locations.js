document.addEventListener('DOMContentLoaded', function () {
    const header = document.getElementById('tw-nav-primary');
    const sidebarNav = document.getElementById('sidebar-nav');
    const parentDiv = document.getElementById('location-posts');
    
    if (!header || !sidebarNav || !parentDiv) {
        console.log('Required elements not found. Sidebar functionality will not be initialized.');
        return;
    }

    let headerHeight;
    let ticking = false;
    let sidebarInitialTop;
    let sidebarInitialWidth;
    let parentBottom;

    function initializeSidebar() {
        headerHeight = header.offsetHeight;
        sidebarInitialTop = sidebarNav.getBoundingClientRect().top + window.pageYOffset;
        sidebarInitialWidth = sidebarNav.offsetWidth;
        parentBottom = parentDiv.getBoundingClientRect().bottom + window.pageYOffset;
        sidebarNav.style.width = `${sidebarInitialWidth}px`;
    }

    function updateSidebarPosition() {
        const scrollY = window.scrollY;
        const viewportHeight = window.innerHeight;
        const sidebarHeight = sidebarNav.offsetHeight;
        const topTriggerPoint = sidebarInitialTop - headerHeight - 10;
        const bottomTriggerPoint = parentBottom - sidebarHeight - headerHeight - 10;

        if (scrollY > topTriggerPoint && scrollY < bottomTriggerPoint) {
            // Fix the sidebar
            if (!sidebarNav.classList.contains('fixed')) {
                sidebarNav.classList.remove('relative', 'absolute');
                sidebarNav.classList.add('fixed');
                sidebarNav.style.top = `${headerHeight + 25}px`;
                sidebarNav.style.bottom = 'auto';
                sidebarNav.style.maxHeight = `${viewportHeight - headerHeight - 20}px`;
            }
        } else if (scrollY >= bottomTriggerPoint) {
            // Stick to the bottom of the parent
            if (!sidebarNav.classList.contains('absolute')) {
                sidebarNav.classList.remove('fixed', 'relative');
                sidebarNav.classList.add('absolute');
                sidebarNav.style.top = 'auto';
                sidebarNav.style.bottom = '0';
                sidebarNav.style.maxHeight = 'none';
            }
        } else {
            // Return to original position
            if (!sidebarNav.classList.contains('relative')) {
                sidebarNav.classList.remove('fixed', 'absolute');
                sidebarNav.classList.add('relative');
                sidebarNav.style.top = 'auto';
                sidebarNav.style.bottom = 'auto';
                sidebarNav.style.maxHeight = 'none';
            }
        }

        ticking = false;
    }

    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(updateSidebarPosition);
            ticking = true;
        }
    }

    window.addEventListener('scroll', onScroll);
    window.addEventListener('resize', function () {
        initializeSidebar();
        updateSidebarPosition();
    });

    initializeSidebar();
    updateSidebarPosition();
});
