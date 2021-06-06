
BX.namespace('Citrus.Helpers');

BX.Citrus.Helpers = new function () {
	"use strict";

	var self = this;

	var indexOf = function( list, elem ) {
		var i = 0,
			len = list.length;
		for ( ; i < len; i++ ) {
			if ( list[i] === elem ) {
				return i;
			}
		}
		return -1;
	};

	/**
	 * @param v
	 * @param [warn] - выводит console.warn если переменная не определена
	 * @returns {boolean}
	 */
	self.isset = function (v, warn) {
		var isset = typeof v !== 'undefined';
		if (!isset && typeof warn !== 'undefined') console.warn(warn);
		return isset;
	};

	/**
	 * @param {string|array} v
	 * @returns {array}
	 */
	self.makeArray = function (v) {
		return self.isset(v) ? [].concat(v) : [];
	};

	/**
	 * @param elem
	 * @param arr
	 * @returns {boolean}
	 */
	self.inArray = function( elem, arr ) {
		return arr == null ? false : !!(indexOf.call( arr, elem )+1);
	};
};
