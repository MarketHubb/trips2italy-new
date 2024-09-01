document.addEventListener('DOMContentLoaded', () => {
  const carousel = document.querySelector('.flex.w-full.overflow-x-scroll');
  const cards = Array.from(carousel.querySelectorAll('.last\\:pr-\\[5\\%\\].md\\:last\\:pr-\\[33\\%\\]'));
  const leftButton = document.querySelector('.flex.justify-end.gap-2.mr-10 button:first-child');
  const rightButton = document.querySelector('.flex.justify-end.gap-2.mr-10 button:last-child');

  let currentIndex = 0;

  function updateCarousel() {
    cards.forEach((card, index) => {
      const offset = index - currentIndex;
      card.style.transform = `translateX(${offset * 100}%)`;
      card.style.opacity = index === currentIndex ? '1' : '0.5';
    });

    leftButton.disabled = currentIndex === 0;
    rightButton.disabled = currentIndex === cards.length - 1;
  }

  function moveCarousel(direction) {
    currentIndex = Math.max(0, Math.min(currentIndex + direction, cards.length - 1));
    updateCarousel();
  }

  leftButton.addEventListener('click', () => moveCarousel(-1));
  rightButton.addEventListener('click', () => moveCarousel(1));

  // Initialize carousel
  updateCarousel();

  // Optional: Add touch swipe functionality
  let touchStartX = 0;
  carousel.addEventListener('touchstart', (e) => {
    touchStartX = e.touches[0].clientX;
  });

  carousel.addEventListener('touchend', (e) => {
    const touchEndX = e.changedTouches[0].clientX;
    const diff = touchStartX - touchEndX;
    if (Math.abs(diff) > 50) { // Threshold of 50px
      moveCarousel(diff > 0 ? 1 : -1);
    }
  });
});
