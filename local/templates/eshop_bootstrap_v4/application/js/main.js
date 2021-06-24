//
// ;(function () {
// 	window.clickOff = function ($el, callback) {
// 		if (!$el) return false;
// 		$(document).on('click', function (e) {
// 			if ($el.has(e.target).length === 0 && !$el.is(e.target)) {
// 				callback($el);
// 			}
// 		});
// 	};
//
// 	/* позиционирование "ушей" слайдера по центру element */
// 	window.sliderButtonPosition = function (slider, element) {
// 		var heightElement = $(slider).find(element).outerHeight(),
// 			btnPrev = $(slider).find('.swiper-button-prev'),
// 			btnNext = $(slider).find('.swiper-button-next');
//
// 		btnPrev.css('top', heightElement / 2);
// 		btnNext.css('top', heightElement / 2);
// 	};
//
// 	window.scrollToElement = function (selector, offsetTop) {
// 		if ($(selector).length == 0) return false;
//
// 		var destination = $(selector).offset().top;
// 		$("html ,body").animate({
// 			scrollTop: destination - offsetTop
// 		}, 500);
// 		return false;
// 	};
// }());
//
// $(function () {
// 	/* open menu */
// 	$('[data-toggle="menu"]').on('click', function () {
// 		$('html').toggleClass('menu-open');
// 	});
// 	/* hide menu */
// 	window.clickOff($('.h_menu__wrap'), function () {
// 		if ($('html').hasClass('menu-open')) {
// 			if (!$(event.target).closest('[data-toggle="menu"]').length) {
// 				event.preventDefault();
// 				$('html').removeClass('menu-open');
// 			}
// 		}
// 	});
//
// 	$.fn.headerScroll({
// 		headerHeight: 150,
// 		mobileHeaderHeight: 80,
// 		scrollSpeed: 0.75,
// 		mobileHeader: true /* header add class "fixed" */
// 	});
// });
//
// var bindModalLinks = function ($link) {
// 	var $link = $link || $('[data-toggle="modal"]');
// 	/*magnific-popup*/
// 	$link.magnificPopup({
// 		type: 'ajax',
// 		preloader: true,
// 		modal: true,
// 		mainClass: 'mfp-fade',
// 		focus: 'input[type="text"], textarea, select',
// 		ajax: {
// 			settings: {
// 				data: {
// 					href : window.location.href
// 				}
// 			}
// 		},
// 		fixedContentPos: true,
// 		callbacks: {
// 			beforeOpen: function() { $('html').addClass('mfp-helper'); },
// 			close: function() { $('html').removeClass('mfp-helper'); }
// 		}
// 	});
// };
// $(function () {
// 	//bind magnificPopup on ready
// 	bindModalLinks();
// 	$(document).on('click', '[data-dismiss="modal"]', function(e) {
// 		e.preventDefault();
// 		$.magnificPopup.close();
// 	});
//
// 	if ($('a.gallery-swipe').length) {
// 		$('a.gallery-swipe').initPhotoSwipe({
// 			loop: true,
// 			bgOpacity: .8
// 		});
// 	}
// 	$('[data-toggle="scroll_up"]').on("click", function() {
// 		$('html, body').animate({
// 			scrollTop: 0
// 		}, 400);
// 	});
// });
//

