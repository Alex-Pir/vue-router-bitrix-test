"use strict";

/**
 * Класс для геокодирования списка адресов или координат.
 * @class
 * @name MultiGeocoder
 * @param {Object} [options={}] Дефолтные опции мультигеокодера.
 */
function MultiGeocoder(options) {
	this._options = options || {results: 1};
}

/**
 * Функция множественнеого геокодирования.
 * @function
 * @requires ymaps.util.extend
 * @see http://api.yandex.ru/maps/doc/jsapi/2.x/ref/reference/util.extend.xml
 * @requires ymaps.util.Promise
 * @see http://api.yandex.ru/maps/doc/jsapi/2.x/ref/reference/util.Promise.xml
 * @name MultiGeocoder.geocode
 * @param {Array} requests Массив строк-имен топонимов и/или геометрий точек (обратное геокодирование)
 * @returns {Object} Как и в обычном геокодере, вернем объект-обещание.
 */
MultiGeocoder.prototype.geocode = function (requests, options) {
	var self = this,
		size = requests.length,
		geoObjects = new ymaps.GeoObjectCollection({}),
		promise = new ymaps.vow.Promise(function (resolve, reject) {

			requests.forEach(function (request, index) {
				ymaps.geocode(request, ymaps.util.extend({}, self._options, options))
				.then(
					function (response) {
						var geoObject = response.geoObjects.get(0);
						if (!geoObject) {
							--size || resolve({geoObjects: geoObjects});
							return;
						}
						geoObject._idx = index;

						geoObject && geoObjects.add(geoObject);
						--size || resolve({geoObjects: geoObjects});
					},
					function (err) {
						console.error(err);
						reject(err);
					}
				);
			});

		});

	return promise;
};

(function ($) {

	$.fn.citrusObjectsMap = function (options) {
		var self = this;
		self.options = $.extend({}, $.fn.citrusObjectsMap.defaults, options);
		self.$map = $('#' + self.options.id);

		if (self.options.height) self.$map.height(self.options.height);

		var updateGeoObjectCurrency = function (o) {
			if (typeof currency === 'undefined') return;
			var $baloonBody = $('<div>'+o.properties.get('balloonContentBody')+'</div>');
			currency.updateHtml($baloonBody);
			o.properties.set('balloonContentBody', $baloonBody[0].outerHTML);
		};

		this.createMap = function (objects) {

			var countObjects = objects.length,
				mapOptions = {
					controls: self.options.controls,
				};
			if (!countObjects) {
				// no items found — hide map container
				self.options.onEmptyObject.call(this);
				return;
			}

			if (countObjects === 1) {
				mapOptions.center = objects[0].geometry.getCoordinates();
				mapOptions.zoom = 16;
			} else {
				var points = [];
				objects.forEach(function (o) {
					points.push(o.geometry.getCoordinates());
				});
				mapOptions.bounds = ymaps.util.bounds.fromPoints(points);
				mapOptions.margin = 50;
			}
			self.yamap = new ymaps.Map(self.options.id, mapOptions, {
				avoidFractionalZoom: false
			});

			// todo проверить работу zoomRange
			{
				var zoom = self.yamap.getZoom();
				var zoomRange = self.yamap.zoomRange.getCurrent();
				if (zoom < zoomRange[0]) self.yamap.setZoom(zoomRange[0]);
				if (zoom > 16) self.yamap.setZoom(16);
				if (zoom > zoomRange[1]) self.yamap.setZoom(zoomRange[1]);
			}

			if (self.options.touchScroll && BX.browser.DetectIeVersion() < 0) {
				ymapsTouchScroll(self.yamap, {
					textScroll: BX.message('YAMAP_TOUCH_SCROLL__TEXT_SCROLL'),
					textTouch: BX.message('YAMAP_TOUCH_SCROLL__TEXT_TOUCH')
				});
			}

			self.yamap.events.add('click', function (e) {
				var map = e.get('target');
				map.balloon && map.balloon.isOpen() ? map.balloon.close() : false;
			});

			if (countObjects > 1) {
				/**
				 * @var {string} citrusTemplateColor - код цвета иконки, по умолчанию '#1e98ff'
				 */

				var clusterer = new ymaps.Clusterer({
					// preset: 'islands#' + self.options.theme + 'ClusterIcons',
					clusterIconColor: (typeof citrusTemplateColor !== 'undefined') ? citrusTemplateColor : '#1e98ff',
					margin: 50,
					clusterDisableClickZoom: false,

					clusterBalloonContentLayout: 'cluster#balloonCarousel',
					clusterBalloonPagerType: 'marker',
					clusterBalloonContentLayoutHeight: 360,
					clusterBalloonContentLayoutWidth: 205
				});
				clusterer.add(objects);

				clusterer.events.add('balloonopen', function (e) {
					var clusterPlacemark = e.get('cluster');
					if (typeof clusterPlacemark === 'undefined') return;

					var objects = clusterPlacemark.getGeoObjects();
					if (objects.length) {
						objects.forEach(function (o) {
							updateGeoObjectCurrency(o);
						});
					}
				});

				/* clusterer.events.once('optionschange', function () {
					 map.setBounds(clusterer.getBounds(), {
							 checkZoomRange: true,
							 useMapMargin: true
						 }
					 ).then(function() {
						 if (map.getZoom() > 15)
							 map.setZoom(15);
					 });
				 });*/
				self.yamap.geoObjects.add(clusterer);
			} else {
				self.yamap.geoObjects.add(objects[0]);
			}

			if ('undefined' !== typeof($().citrusRealtyOfficeMapCheckHash)) {
				window.setTimeout($().citrusRealtyOfficeMapCheckHash, 500);
			}

			BX.addCustomEvent('SCHEME', function () {
				if (typeof clusterer !== 'undefined') clusterer.options.set('clusterIconColor', citrusTemplateColor);
				objects.forEach(function (o) {
					o.options.set('iconImageHref', citrusMapIcon.href);
				});
			});

			self.options.onReady.call(self);
		};

		this.initObject = function (geoObject, info) {
			/**
			 * @var {object} citrusMapIcon - иконка яндекс карты формата { href: 'icon.png', size: [32, 52], offset: [-16, -48]}
			 * @var {string} citrusMapIconColor - цвет иконки карты (например, '#a00' или 'red')
			 */
			if (typeof citrusMapIcon !== 'undefined' && citrusMapIcon.href && citrusMapIcon.href.length) {
				geoObject.options.set('iconLayout', 'default#image');
				geoObject.options.set('iconImageHref', citrusMapIcon.href);
				geoObject.options.set('iconImageSize', citrusMapIcon.size ? citrusMapIcon.size : [32, 52]);
				geoObject.options.set('iconImageOffset', citrusMapIcon.offset ? [-16, -48] : citrusMapIcon.offset);
			} else {
				geoObject.options.set('preset', info.preset || 'islands#dotIcon');
				var color = typeof citrusMapIconColor !== 'undefined' ? citrusMapIconColor : '';
				if (info.color || color) {
					geoObject.options.set('iconColor', info.color || color);
				}
			}
			geoObject.options.set('balloonCloseButton', false);
			if (info.header)
				geoObject.properties.set('balloonContentHeader', info.header);
			if (info.body)
				geoObject.properties.set('balloonContentBody', info.body);
			if (info.footer)
				geoObject.properties.set('balloonContentFooter', info.footer);

			// update currency
			geoObject.events.add('balloonopen', function (event) {
				updateGeoObjectCurrency(geoObject);
			});

			// global storage for external use
			geoObject._info = info;
			if (!('geoObjects' in window)) {
        window.geoObjects = [];
      }
      window.geoObjects.push(geoObject);

			return geoObject;
		};

		ymaps.ready(function () {

			var geoCoderQueue = [],
				geoCoderQueueItem = [],
				objects = [];

			$.each(self.options.items, function (index, item) {
				if (item.coord) {
					var geoObject = new ymaps.Placemark(item.coord);
					objects.push(self.initObject(geoObject, item));
				}
				else {
					geoCoderQueue.push(item.address);
					geoCoderQueueItem.push(item);
				}
			});

			if (geoCoderQueue.length) {
				var geoCoder = new MultiGeocoder({});
				geoCoder.geocode(geoCoderQueue)
				.then(function (res) {
						res.geoObjects.each(function (obj) {
							objects.push(self.initObject(obj, geoCoderQueueItem[obj._idx]));
						});
						self.createMap(objects);
					},
					function (err) {
						self.$map.hide();
						console.error(err);
					});
			} else {
				self.createMap(objects);
			}
		});

		return this;
	};

	$.fn.citrusObjectsMap.defaults = {
		id: '',
		address: '',
		items: [],
		controls: ['smallMapDefaultSet'],
		collapseButton: true,
		height: 0,
		onEmptyObject: function () {
			this.$map.hide();
		},
		onReady: function() {},
		touchScroll: true,
	};

}(jQuery));
