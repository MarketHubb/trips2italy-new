(function ($) {

	const featured = $('#location-region-content');

	function remove_empty_paragraphs() {

		$('.location-content-block').each(function () {
			let pText = $(this).find('p').text().trim();
			let h3Text = $(this).find('h3').text().trim();
			if (pText.length === 0 && h3Text.length === 0) {
				$(this).remove();
			}
		});
	}


	function insert_location_cta() {
		// Define the locationCta selector
		let locationCta = $('#location-region-cta');
		// Define the entry point
		let ctaEntryPoint = $('.location-content-block:nth-of-type(4)');

		if (ctaEntryPoint.length === 1) {
			// Insert the locationCta after the ctaEntryPoint
			ctaEntryPoint.after(locationCta);

			// Add the closing tags after the locationCta
			locationCta.after('</div></section>');
		}
	}

	
	$(document).ready(function () {

		// Call the function to insert the CTA
		// insert_location_cta();
		// Function to insert the CTA after the fourth location-content-block
		remove_empty_paragraphs();

	});

    
})(jQuery);