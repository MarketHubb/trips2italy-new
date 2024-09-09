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
        const hiddenDiv = document.getElementById('modal-container');

        if (!hiddenDiv || !hiddenDiv.classList.contains('hidden')) {
            console.error('Hidden div not found or invalid');
            return;
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
