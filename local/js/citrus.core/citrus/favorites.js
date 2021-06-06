
;(function () {
	window.favorites = new function () {
		var self = this;
		
		self.items = [];
		self.addedClass = '_in-favorite added';
		self.favoriteCount = '.favorite-count';
		self.linkClass = '.js-add-to-favorites';
		self.countClass = '.js-favorites-count';
		
		//methods
		{
			self.getFromStorage = function () {
				var storageItems = localStorage.getItem('favorites');
				if(storageItems)
					self.items = JSON.parse(storageItems);
			};
			self.saveToStorage = function () {
				localStorage.setItem('favorites', JSON.stringify(self.items));
			};
			self.add = function (id) {
				if (!BX.Citrus.Helpers.isset(id)) return;
				var arId = BX.Citrus.Helpers.makeArray(id);
				
				//filter not uniq and already added
				arId = arId.filter(function (newId, index) {
					return arId.indexOf(newId) === index &&  self.items.indexOf(newId) < 0;
				});
				self.items = self.items.concat(arId);

				self.updateCount();
				self.saveToStorage();
				return self.items;
			};
			self.remove = function (id) {
				if (!BX.Citrus.Helpers.isset(id)) return;
				
				var arId = BX.Citrus.Helpers.makeArray(id);
				self.items = self.items.filter(function (favId) {
					return arId.indexOf(favId) < 0;
				});
				self.updateCount();
				self.saveToStorage();
				return self.items;
			};
			self.updateLink = function ($link, id) {
				var $link = $link || $(self.linkClass);
				$link.each(function () {
					var id = id || +$(this).data('id');
					$(this)[self.isAdded(id) ? 'addClass' : 'removeClass'](self.addedClass);
				});
			};
			self.isAdded = function (id) {
				return self.items.indexOf(id) >= 0;
			};
			self.updateCount = function () {
				$(self.countClass).html(self.items.length).css('visibility', self.items.length > 0 ? 'visible' : 'hidden');
			};
		}
		
		//init
		{
			self.getFromStorage();
			$(function(){
				var $links = $(self.linkClass);
				self.updateLink($links);
				$links.on('click', function(event) {
					event.preventDefault();
					
					var id = +$(this).data('id');
					self[self.isAdded(id) ? 'remove': 'add'](id);
					self.updateLink($(this), id);
				});
			});
		}
	};
})();
