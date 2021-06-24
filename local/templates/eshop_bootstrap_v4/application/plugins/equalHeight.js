/**
 * Javascript-Equal-Height-Responsive-Rows
 * https://github.com/Sam152/Javascript-Equal-Height-Responsive-Rows
 */
(function ($) {
	'use strict';

	/**
	 * Set all elements within the collection to have the same height.
	 */
	$.fn.equalHeight = function () {
		var heights = [];
		$.each(this, function (i, element) {
			var $element = $(element);
			var elementHeight;
			// Should we include the elements padding in it's height?
			var includePadding = ($element.css('box-sizing') === 'border-box') || ($element.css('-moz-box-sizing') === 'border-box');
			if (includePadding) {
				elementHeight = $element.innerHeight();
			} else {
				elementHeight = $element.height();
			}
			heights.push(elementHeight);
		});
		this.css('height', Math.max.apply(window, heights) + 'px');
		return this;
	};
	// split in rows by bottom position and equal height
	$.fn.equalHeightBot = function ($items) {
		var calc = function ($items) {

			var rows = {};
			$items.each(function () {
				var offsetBot = ($(this).offset().top + $(this).height()).toFixed(2);
				if (!rows[offsetBot]) rows[offsetBot] = $([]);
				rows[offsetBot] = rows[offsetBot].add($(this));
			});

			for (var rowKey in rows) {
				var $rows = rows[rowKey];
				$rows.css('min-height', '0');

				if ($rows.length < 2) return;

				var maxHeight = 0;
				$rows.each(function () {
					if ($(this).height() > maxHeight) maxHeight = $(this).height();
				});
				$rows.css('min-height', maxHeight + 'px');
			}
		};
		calc($items);

		$(window).resize(function () {
			calc($items);
		});
	};

	// split in rows by top position and equal height
	$.fn.equalHeightTop = function ($items) {
		var calc = function ($items) {
			var rows = {};
			$items.each(function () {
				var offsetTop = $(this).offset().top.toFixed(2);
				if (!rows[offsetTop]) rows[offsetTop] = $([]);
				rows[offsetTop] = rows[offsetTop].add($(this));
			});

			for (var rowKey in rows) {
				var $rows = rows[rowKey];
				$rows.css('height', 'auto');

				if ($rows.length < 2) return;

				var maxHeight = 0;
				$rows.each(function () {
					if ($(this).outerHeight() > maxHeight) maxHeight = $(this).outerHeight();
				});
				$rows.css('height', maxHeight + 'px');
			}
		};
		calc($items);

		$(window).resize(function () {
			calc($items);
		});
	};
	/**
	 * Create a grid of equal height elements.
	 */
	$.fn.equalHeightGrid = function (columns) {
		var $tiles = this.filter(':visible');
		$tiles.css('height', 'auto');
		for (var i = 0; i < $tiles.length; i++) {
			if (i % columns === 0) {
				var row = $($tiles[i]);
				for (var n = 1; n < columns; n++) {
					row = row.add($tiles[i + n]);
				}
				row.equalHeight();
			}
		}
		return this;
	};

	/**
	 * Detect how many columns there are in a given layout.
	 */
	$.fn.detectGridColumns = function () {
		var offset = 0,
			cols = 0,
			$tiles = this.filter(':visible');
		$tiles.each(function (i, elem) {
			var elemOffset = $(elem).offset().top;
			if (offset === 0 || elemOffset === offset) {
				cols++;
				offset = elemOffset;
			} else {
				return false;
			}
		});
		return cols;
	};

	/**
	 * Ensure equal heights now, on ready, load and resize.
	 */
	var grids_event_uid = 0;
	$.fn.responsiveEqualHeightGrid = function () {
		var _this = this;
		var event_namespace = '.grids_' + grids_event_uid;
		_this.data('grids-event-namespace', event_namespace);

		function syncHeights() {
			var cols = _this.detectGridColumns();
			_this.equalHeightGrid(cols);
		}

		$(window).bind('resize' + event_namespace + ' load' + event_namespace, syncHeights);
		syncHeights();
		grids_event_uid++;
		return this;
	};

	/**
	 * Unbind created events for a set of elements.
	 */
	$.fn.responsiveEqualHeightGridDestroy = function () {
		var _this = this;
		_this.css('height', 'auto');
		$(window).unbind(_this.data('grids-event-namespace'));
		return this;
	};

})(window.jQuery);