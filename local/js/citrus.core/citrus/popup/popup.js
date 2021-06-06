;(function () {
    "use strict";

    /**
     * Get all data parameters data-modal-... to Object
     * @param $item - jquery el
     * @return {{}}
     */
    var getModalParams = function ($item) {
        var sendDataParams = {
            currency: typeof currency !== 'undefined' ? currency.current : ''
        };

        var dataParams = $item.data();
        Object.keys(dataParams).forEach(function (paramName) {
            if (paramName.indexOf('modal') === 0) {
                var modifierParamName = paramName.replace('modal', '');
                modifierParamName = modifierParamName.replace(modifierParamName[0], modifierParamName[0].toLowerCase());
                sendDataParams[modifierParamName] = dataParams[paramName];
            }
        });

        return sendDataParams;
    };

    /**
     * bind magnific-popup links
     *
     * @todo Способ подключения попапов как блоков с содержимым
     * @param {jQuery} $link
     */
    window.bindModalLinks = function ($link) {
        $link = $link || $('[data-toggle="modal"]');

        var loadCss = function (cssList, callback) {
                if (BX.type.isString(cssList)) {
                    cssList = [cssList];
                }

                if (BX.type.isArray(cssList)) {
                    cssList = cssList.map(function (url) {
                        return {url: url, ext: "css"}
                    });

                    BX.load(cssList, callback);

                    if (!cssList.length)
                    {
                        callback();
                    }
                }
            },
            loadJs = function (jsList, rawHtml, success, xhr) {
                if ((BX.type.isArray(jsList) || BX.type.isString(jsList)) && !jsList.length)
                {
                    success();
                }

                BX.addCustomEvent(xhr, 'onAjaxSuccessFinish', success);
                BX.ajax.processRequestData(rawHtml, {
                    dataType: 'html',
                    emulateOnload: true, // allows onAjaxSuccessFinish
                    xhr: xhr
                });
            },
            _removeAjaxCursor = function (mfp) {
                var _ajaxCur = mfp.st.ajax.cursor;
                if (_ajaxCur) {
                    $(document.body).removeClass(_ajaxCur);
                }
            },
            setPopupContent = function (html) {
                var mfp = $.magnificPopup.instance;

                mfp.appendContent($(html), 'ajax');

                _removeAjaxCursor(mfp);

                setTimeout(function () {
                    mfp.wrap.addClass('mfp-ready');
                }, 16);

                mfp.updateStatus('ready');
            };

        $link.each(function () {
            var $linkItem = $(this);
            if ($linkItem.data('href'))
                $linkItem.attr('href', $linkItem.data('href'));

            $linkItem.magnificPopup({
                type: 'ajax',
                preloader: true,
                mainClass: 'mfp-fade',
                focus: 'input[type="text"], textarea, select',
                fixedContentPos: true,
                showCloseBtn: false,
                tLoading: '<svg role="progressbar" viewBox="25 25 50 50" aria-valuemax="100" aria-valuemin="0" class="loading-icon"><circle cx="50" cy="50" fill="none" r="20"' +
                    ' stroke-miterlimit="10" stroke-width="4" class="ui-progress-circular__indeterminate-path"></circle></svg>',
                ajax: {
                    settings: {
                        data: {
                            href: window.location.href,
                            object: $linkItem.data('object') || '',
                            params: $linkItem.data('params') || '',
                            currency: typeof currency !== 'undefined' ? currency.current : ''
                        },
                        success: function (data, textStatus, jqXHR) {

                            var parts = BX.processHTML(data);
                            loadCss(parts.STYLE, function () {
                                setPopupContent(parts.HTML);
                                loadJs(parts.SCRIPT, data, function () {
                                    $.magnificPopup.instance._setFocus();
                                }, jqXHR);
                            });

                        }
                    }
                },
                callbacks: {
                    beforeOpen: function () {
                        this.st.ajax.settings.data = $.extend(
                            this.st.ajax.settings.data,
                            getModalParams($linkItem)
                        );
                        $('html').addClass('mfp-helper');
                    },
                    close: function () {
                        $('html').removeClass('mfp-helper');
                    }
                }
            });
        });
    };

    $(document)
        .on('click', '[data-dismiss="modal"]', function(e) {
            e.preventDefault();
            $.magnificPopup.close();
        });

    $(function () {
        window.bindModalLinks();
    });

})();
