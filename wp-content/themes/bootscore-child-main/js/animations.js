document.addEventListener('DOMContentLoaded', function() {
  function updateObserver() {
    const vh = window.innerHeight;
    const rootMargin = `0px 0px -${vh * 0.5}px 0px`; // 50% of viewport height

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // Use requestAnimationFrame to ensure the class is added in the next paint cycle
          requestAnimationFrame(() => {
            entry.target.classList.add('in-view');
          });
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: rootMargin
    });

    document.querySelectorAll('.animate-on-scroll').forEach((el) => {
      observer.observe(el);
    });

    return observer;
  }

  let observer = updateObserver();

  // Update observer on window resize
  window.addEventListener('resize', () => {
    observer.disconnect(); // Disconnect the old observer
    observer = updateObserver(); // Create a new observer with updated rootMargin
  });
});
