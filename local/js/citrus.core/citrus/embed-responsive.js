;(function () {
    $(function () {
        var $allVideos = $(":not(.embed-responsive) > iframe[src*='//player.vimeo.com'], :not(.embed-responsive) > iframe[src*='//www.youtube.com']");

        $allVideos.each(function () {

            $(this)
                .data('aspectRatio', this.height / this.width)
                .data('originalWidth', this.width)

                .removeAttr('height')
                .removeAttr('width');

        });

        // When the window is resized
        $(window).resize(function () {

            window.setTimeout(function () {
                $allVideos.each(function () {

                    var $el = $(this),
                        width = $el.data('originalWidth')
                            ? Math.min($el.parent().width(), $el.data('originalWidth'))
                            : $el.parentsUntil('html').filter((i,e) => $(e).css('display') === 'block').first().width();

                    $el
                        .width(width)
                        .height(width * $el.data('aspectRatio'));

                });
            }, 1);

        }).resize();
    });
})();