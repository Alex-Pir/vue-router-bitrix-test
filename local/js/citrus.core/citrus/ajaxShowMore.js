
;(function () {
	/**
	 * Кнопка "Показать еще" через постраничную навигацию битрикса
	 * Количество элементов для загрузки считается в селектор $('.js-left-pages')
	 *
	 * @param {object} [params] - параметры:
	 * @param {string} params.COMPONENT_ID - уникальный id компонента
	 * @param {int} params.NavPageCount - количество страниц $arResult['NAV_RESULT']->NavPageCount
	 * @param {string} params.navNum - номер постраничной навигации на странице $arResult['NAV_RESULT']->NavNum
	 * @param {function} [params.onAfterAjax] - callback после добавления элементов
	 * @param {int} [params.NavRecordCount] - количество всех элементов $arResult['NAV_RESULT']->NavRecordCount (для подсчета остатка)
	 * @param {int} [params.NavPageSize] - количество элементов на страницу $arResult['NAV_RESULT']->NavPageSize (для подсчета остатка)
	 * @callback [params.onAjax] - функция после успешного получения аякса (по умолчанию добавляет в блок params.COMPONENT_ID html из ответа)
	 */
	window.ajaxShowMore = function(params) {
		var NavPageCount = params.NavPageCount,
			navNum = params.navNum,
			pageCurrent = 1,
			onAfterAjax = params.onAfterAjax || function () {},
			self = this;
		
		self.COMPONENT_ID = params.COMPONENT_ID;
		self.$wrapper = $('#'+self.COMPONENT_ID);
		self.$btn = $('[data-showmore-id="'+self.COMPONENT_ID+'"]');
		
		self.onAjax = params.onAjax || function (data) {
			var innerHtml = $('#'+self.COMPONENT_ID, data).html();
			self.$wrapper.append(innerHtml);
		};
		
		self.updateShowMoreCount = function () {
			var $showMoreCounter = self.$btn.find('.js-left-pages');
			if (params.NavRecordCount && params.NavPageSize && $showMoreCounter.length) {
				params.NavRecordCount -= params.NavPageSize;
				$showMoreCounter.html(params.NavRecordCount < params.NavPageSize ? params.NavRecordCount : params.NavPageSize);
			}
		};
		self.updateShowMoreCount();
		
		self.$btn.on('click', function(event) {
			event.preventDefault();

			pageCurrent++;
			if(NavPageCount <= pageCurrent) {
				self.$btn.addClass('hidden')
					.parent().addClass('hidden');
			}

			BX.showWait(self.$wrapper.get(0));

			var data = {
				'ajax-pager': self.COMPONENT_ID
			};
			data['PAGEN_'+navNum] = pageCurrent;
			$.ajax({
				url: window.location.pathname,
				type: 'GET',
				dataType: 'html',
				data: data,
			})
			.done(function(data) {
				self.onAjax(data);
				self.updateShowMoreCount();
				onAfterAjax();
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				BX.closeWait(self.$wrapper.get(0));
			});
		});
	};
})();