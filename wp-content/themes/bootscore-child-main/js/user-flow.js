window.addEventListener('beforeunload', function() {
    if (!window.location.pathname.includes('/thank-you/') && !window.location.pathname.includes('/lead-form/')) {
        sessionStorage.setItem('previousPageUrl', window.location.href);
        console.log('Storing previous page URL:', window.location.href);
    }
});
