$(function () {
	$('.map-link, .js-map-link').on('click', function () {
		var $this = $(this);
		
		var mapItem = {
			address: $this.data('address'),
			coord: $this.data('coords'),
			body: $this.data('body') || $this.data('address'),
			header: $this.data('header'),
			footer: $this.data('footer'),
		};
		
		if (mapItem.coord || mapItem.address.length)
			$.magnificPopup.open({
				items: {
					src: '<div class="citrus-objects-map" id="magnificPopupMap" style="width: 100%;height: 100%;"></div>',
				},
				mainClass: 'full-screen-map mfp-with-zoom',
				alignTop: false,
				closeOnContentClick: false,
				callbacks: {
					open: function () {
						$().citrusObjectsMap({
							id: 'magnificPopupMap',
							items: [mapItem],
							controls: ['largeMapDefaultSet'],
							collapseButton: false,
							onError: function () {
								console.log('map error');
								$.magnificPopup.close();
							},
							onEmptyObject: function () {
								$('#magnificPopupMap').html('No item');
								setTimeout($.magnificPopup.close, 400);
							}
						})
					}
				}
			});
	});
});