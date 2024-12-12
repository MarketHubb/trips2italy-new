document.addEventListener('DOMContentLoaded', function() {
    // Get the stored previous page URL
    const previousPageUrl = sessionStorage.getItem('previousPageUrl');
    console.log('Retrieved previous page URL:', previousPageUrl);
    
    // Send event to GA4
    if (previousPageUrl && typeof gtag === 'function') {
        gtag('event', 'Thank you page', {
            'previous_page': previousPageUrl,
            'form_name': 'gravity_form',
            'destination_page': 'https://www.trips2italy.com/thank-you/'
        });
        console.log('GA4 event sent with previous page:', previousPageUrl);
    }
    
    // Clear the stored URL
    sessionStorage.removeItem('previousPageUrl');
});