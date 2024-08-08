document.addEventListener('DOMContentLoaded', () => {
  // const slider = document.getElementById('feature-slider');
  // const slider = document.querySelector('.snap-slider');
  const sliders = document.querySelectorAll('.snap-slider');

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
        const contentDiv = item.querySelector('div'); // Select the first child div

        if (entry.isIntersecting) {
          // Apply classes to the li element
          item.classList.remove('opacity-65');
          item.classList.add('opacity-100');
        
          // Apply classes to the child div
          if (contentDiv) {
            contentDiv.classList.add('scale-110');
            contentDiv.classList.remove('scale-90');
          }
        } else {
          // Remove classes from the li element
          item.classList.remove('opacity-100');
          item.classList.add('opacity-65');
        
          // Remove classes from the child div
          if (contentDiv) {
            contentDiv.classList.remove('scale-110');
            contentDiv.classList.add('scale-90');
          }
        }
      });
    }, observerOptions);

    items.forEach(item => observer.observe(item));

    // Update on scroll
    slider.addEventListener('scroll', () => {
      observer.disconnect();
      items.forEach(item => observer.observe(item));
    });
  });
});