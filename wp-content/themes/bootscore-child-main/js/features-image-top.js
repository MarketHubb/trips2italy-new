document.addEventListener('DOMContentLoaded', function() {
    const nav = document.querySelector('#example-trips-nav');
    const contentContainers = document.querySelectorAll('#example-trips-content > [data-container]');
    const mainImage = document.querySelector('#example-trips-img-main > img');
    
    // Initialize - ensure first content is visible and others are hidden
    contentContainers.forEach((container, index) => {
        if (index === 0) {
            container.style.display = 'inline-flex';
            container.classList.remove('hidden', 'opacity-0');
            container.classList.add('opacity-100');
        } else {
            container.classList.add('opacity-0');
            container.classList.add('hidden');
            container.style.display = 'none';
        }
    });
    
    nav?.addEventListener('click', function(e) {
        const listItem = e.target.closest('li');
        
        if (listItem) {
            const type = listItem.dataset.type;
            const imgSrc = listItem.dataset.img;
            
            // Update the main image
            if (mainImage && imgSrc) {
                mainImage.style.transition = 'opacity 300ms ease-in-out';
                mainImage.style.opacity = '0';
                setTimeout(() => {
                    mainImage.src = imgSrc;
                    mainImage.style.opacity = '1';
                }, 300);
            }
            
            // First, start fade out animation for all containers
            contentContainers.forEach(container => {
                container.classList.remove('opacity-100');
                container.classList.add('opacity-0');
            });
            
            // After fade out, update visibility
            setTimeout(() => {
                contentContainers.forEach(container => {
                    if (container.dataset.container === type) {
                        // First set display
                        container.style.display = 'inline-flex';
                        container.classList.remove('hidden');
                        
                        // Force browser reflow
                        container.offsetHeight;
                        
                        // Then trigger fade in
                        container.classList.remove('opacity-0');
                        container.classList.add('opacity-100');
                    } else {
                        container.classList.add('hidden');
                        container.style.display = 'none';
                    }
                });
            }, 300);
            
            // Update active state of list items
            nav.querySelectorAll('li').forEach(item => {
                if (item === listItem) {
                    item.classList.remove('opacity-50');
                } else {
                    item.classList.add('opacity-50');
                }
            });
        }
    });
});
