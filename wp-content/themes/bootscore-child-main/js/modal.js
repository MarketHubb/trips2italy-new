document.addEventListener('DOMContentLoaded', function () {
   const modalContainer = document.getElementById('modal-container');
   const modalContent = modalContainer.querySelector('.relative.transform'); // Select the modal content div
   const modalImage = document.getElementById('modal-image');
   const modalDescription = document.getElementById('modal-description');
   const modalAuthor = document.getElementById('modal-author');
   const modalTrip = document.getElementById('modal-trip');
   const modalLocations = document.querySelector('.modal-locations');
   const closeModalButton = document.getElementById('close-modal');
   const openModalButtons = document.querySelectorAll('.open-modal');

   function openModal(button) {
      const hiddenDiv = button.nextElementSibling;

      if (!hiddenDiv || !hiddenDiv.classList.contains('hidden')) {
         console.error('Hidden div not found or invalid');
         return;
      }

      // Set image
      modalImage.src = button.src;
      modalImage.alt = button.alt;

      // Set description
      const descriptionElem = hiddenDiv.querySelector('.modal-description');
      if (descriptionElem) {
         modalDescription.innerHTML = descriptionElem.innerHTML;
      }

      // Set author
      const authorElem = hiddenDiv.querySelector('.modal-author');
      if (authorElem) {
         modalAuthor.textContent = authorElem.textContent;
      }

      // Set trip
      const tripElem = hiddenDiv.querySelector('.modal-trip');
      if (tripElem) {
         modalTrip.textContent = tripElem.textContent;
      }

      // Set locations
      modalLocations.innerHTML = '';
      const citiesElem = hiddenDiv.querySelector('.modal-cities');
      if (citiesElem) {
         const cities = citiesElem.querySelectorAll('li');
         cities.forEach(city => {
            const li = document.createElement('li');
            li.textContent = city.textContent;
            modalLocations.appendChild(li);
         });
      }

      // Show modal
      modalContainer.classList.remove('hidden');
   }

   function closeModal() {
      modalContainer.classList.add('hidden');
   }

   openModalButtons.forEach(button => {
      button.addEventListener('click', function () {
         openModal(this);
      });
   });

   closeModalButton.addEventListener('click', closeModal);

   // Close modal when clicking outside of it
   modalContainer.addEventListener('click', function (event) {
      // Check if the click is outside the modal content
      if (!modalContent.contains(event.target)) {
         closeModal();
      }
   });

   // Prevent clicks inside the modal from closing it
   modalContent.addEventListener('click', function (event) {
      event.stopPropagation();
   });
});
