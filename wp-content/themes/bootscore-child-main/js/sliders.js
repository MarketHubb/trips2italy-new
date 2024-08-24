document.addEventListener('DOMContentLoaded', () => {
   const sliders = document.querySelectorAll('.snap-slider');
   let observers = [];

   function setupObservers() {
      // Clear existing observers
      observers.forEach(observer => observer.disconnect());
      observers = [];

      if (window.innerWidth < 1024) {
         sliders.forEach(slider => {
            if (!slider) return;

            const items = slider.querySelectorAll('.snap-item');

            const observerOptions = {
               root: slider,
               rootMargin: '0px',
               threshold: 0.5
            };

            const observer = new IntersectionObserver((entries) => {
               entries.forEach(entry => {
                  const item = entry.target;
                  const contentDiv = item.querySelector('div');

                  if (entry.isIntersecting) {
                     item.classList.remove('opacity-65');
                     item.classList.add('opacity-100');
            
                     if (contentDiv) {
                        contentDiv.classList.add('scale-110');
                        contentDiv.classList.remove('scale-90');
                     }
                  } else {
                     item.classList.remove('opacity-100');
                     item.classList.add('opacity-65');
            
                     if (contentDiv) {
                        contentDiv.classList.remove('scale-110');
                        contentDiv.classList.add('scale-90');
                     }
                  }
               });
            }, observerOptions);

            items.forEach(item => observer.observe(item));
            observers.push(observer);

            // Update on scroll
            slider.addEventListener('scroll', () => {
               observer.disconnect();
               items.forEach(item => observer.observe(item));
            });
         });
      }
   }

   // Initial setup
   setupObservers();

   // Update on window resize
   let resizeTimer;
   window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(setupObservers, 250);
   });
});
