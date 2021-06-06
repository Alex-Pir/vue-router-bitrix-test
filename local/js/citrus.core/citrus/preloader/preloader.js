
;(function () {
	window.Preloader = function (parentNode, params) {
		var self = this;
		self.overlay = '';
		self.loadingIcon = '';
		self.loadingIconHtml = '<svg role="progressbar" viewBox="25 25 50 50" aria-valuemax="100" aria-valuemin="0" ' +
							'class="loading-icon">' +
								'<circle cx="50" cy="50" fill="none" r="20"\n' +
								'stroke-miterlimit="10"' +
								'stroke-width="4"' +
								'class="ui-progress-circular__indeterminate-path">' +
								'</circle>' +
							'</svg>';
		
		
		//init
		{
			var params = params || {};
			if (arguments.length < 2 && !(parentNode instanceof Element)) {
				self.params = parentNode || {};
				self.parentNode = document.body;
			} else {
				self.parentNode = parentNode;
			}
			
			self.params = {
				'overlay': true,
				'iconStyles' : {
					position: 'absolute',
					top: 0,
					bottom: 0,
					left: 0,
					right: 0,
					color: '#0099ff'
				}
			};
			
			var isObject = function(item) {
				return (item && typeof item === 'object' && !Array.isArray(item));
			};
			for (var paramName in params) {
				if (isObject(self.params[paramName])) {
					self.params[paramName] = $.extend(self.params[paramName], params[paramName]);
				} else {
					self.params[paramName] = params[paramName];
				}
			}
			
			if (self.parentNode && getComputedStyle(self.parentNode)['position'] === 'static') {
				self.parentNode.style.position = 'relative';
			}
		}
		
		self.events = {
			overlayClick: function () {
				self.hideOverlay();
				self.hideLoading();
			}
		};
		
		self.getOverlay = function () {
			if (self.overlay) return self.overlay;
			
			self.overlay = document.createElement('div');
			self.overlay.className = 'loading-overlay';
			self.overlay.style.position = self.params.position;
			
			self.overlay.addEventListener('click', self.events.overlayClick);
			
			self.parentNode.appendChild(self.overlay);
			return self.overlay;
		};
		self.createIcon = function () {
			if(self.loadingIcon) return self.loadingIcon;
			
			var parser = new DOMParser();
			var dom = parser.parseFromString(self.loadingIconHtml, "text/html");
			self.loadingIcon = dom.body.childNodes[0];
			self.loadingIcon.style.position = self.params.position;
			
			for (var styleName in self.params.iconStyles) {
				self.loadingIcon.style[styleName] = self.params.iconStyles[styleName];
			}
			
			if(self.params.overlay && self.overlay) {
				self.overlay.appendChild(self.loadingIcon);
			} else {
				self.parentNode.appendChild(self.loadingIcon);
			}
			return self.loadingIcon;
		};
		
		//methods
		{
			self.showOverlay = function () {
				self.getOverlay().style.display = 'block';
			};
			self.hideOverlay = function () {
				self.getOverlay().style.display = 'none';
			};
			self.showLoading = function () {
				if (self.params.overlay) self.showOverlay();
				self.createIcon().style.display = 'block';
			};
			self.hideLoading = function () {
				self.hideOverlay();
				if(self.loadingIcon) self.loadingIcon.style.display = 'none';
			};
		}
	};
}());