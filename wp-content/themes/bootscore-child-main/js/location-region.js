(function ($) {

	const featured = $('#location-region-content');
	const locationCta = $('#location-region-cta');

	function remove_empty_paragraphs() {

		$('.location-content-block').each(function () {
			let pText = $(this).find('p').text().trim();
			let h3Text = $(this).find('h3').text().trim();
			if (pText.length === 0 && h3Text.length === 0) {
				$(this).remove();
			}
		});
	}

	remove_empty_paragraphs();

	// Insert "CTA" after second paragraph
	function insert_location_cta() {
		let ctaEntryPoint = featured.find('div.location-content-block:nth-of-type(4)');
		console.table("ctaEntryPoint", ctaEntryPoint);

		if (ctaEntryPoint.length === 1) {
			ctaEntryPoint.after(locationCta);
		}
	}

	insert_location_cta();
	
	// firstSectionHeading.each(function (event) {
	// 	if (event === 0) {
	// 		const ctaEntryPoint = $(this).closest('.container');
	// 		featured.insertBefore(ctaEntryPoint);
	// 	}
	// });

    
})(jQuery);