var scrolInit = false;

var headerOffsetTop = function () {
	var header = $('header, #header, .header'),
		bxPanel = $('#bx-panel'),
		bxPanelHeight = bxPanel.height(),
		scroll = window.pageYOffset,
		mainContainer = $('.main-container');

	if (!header || !bxPanel) return;
	if (header.css('position') == 'fixed') {
		header.css('top', bxPanelHeight);
	}
	if (!scrolInit) {
		window.addEventListener('scroll', function () {
			scroll = window.pageYOffset;
			header.css('top', bxPanelHeight - scroll);
			if (scroll > bxPanelHeight) {
				header.css('top', 0);
			}
		});
	}
	if (mainContainer) {
		mainContainer.css('padding-top', header.height());
	}
};

window.qs = function (q) {
	return document.querySelector(q);
};

(function () {
	$.fn.headerScroll = function (params) {
		var header = $('header, #header, .header'),
			bxPanel = $('#bx-panel'),
			bxPanelHeight = bxPanel.height() || 0,
			lastScroll = 0,
			topH = 0,
			scroll = window.pageYOffset;

		var defaults = {
			headerHeight: 100,
			mobileHeaderHeight: 50,
			scrollSpeed: 0.8, /* from 0 to 1 */
			mobileHeader: false,
		};

		if (params) {
			$.each(defaults, function (param) {
				if (!params.hasOwnProperty(param)) {
					params[param] = defaults[param]
				}
			});
		} else {
			params = defaults
		}

		var heightDiff = params.headerHeight - params.mobileHeaderHeight;
		if (scroll > heightDiff) {
			header.addClass('fixed');
		}
		if (params.scrollSpeed) {
			var scrollSpeed = 1 / params.scrollSpeed;
		}

		window.addEventListener('scroll', function () {
			scroll = window.pageYOffset;

			if (scrollSpeed) {
				topH += ((lastScroll - scroll) / scrollSpeed);
			} else {
				topH = 0;
				if (params.mobileHeader) {
					header.addClass('fixed');
				}
			}
			if (scroll > lastScroll) { // вниз\
				if (topH < -qs('#header').offsetHeight) {
					topH = -qs('#header').offsetHeight;
				}
				if (scroll <= bxPanelHeight) {
					topH = bxPanelHeight - scroll;
				}
				if (topH == -header.height() && params.mobileHeader) {
					header.addClass('fixed');
				}
				$('html').addClass('scroll-bottom');
				$('html').removeClass('scroll-top');
			} else { // вверх
				if (topH > 0) {
					topH = 0;
				}
				if (scroll <= heightDiff + bxPanelHeight) {
					header.removeClass('fixed');
					if (bxPanelHeight && scroll <= bxPanelHeight) {
						topH = bxPanelHeight - scroll;
					}
				}
				$('html').addClass('scroll-top');
				$('html').removeClass('scroll-bottom');
			}
			qs('#header').style.top = topH + 'px';
			lastScroll = scroll;
		});
		$("#bx-panel-expander, #bx-panel-hider").on('click', function () {
			$.fn.headerScroll(params);
		});
		return scrolInit = true;
	}
})();

$(function () {
	headerOffsetTop();
	$("#bx-panel-expander, #bx-panel-hider").on('click', function () {
		headerOffsetTop();
	});
	$(window).resize(function () {
		headerOffsetTop();
	});
});
