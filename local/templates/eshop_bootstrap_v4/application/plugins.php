<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$appPath = SITE_TEMPLATE_PATH . '/application/';
$pluginsPath = $appPath . "plugins/";
$bowerPath = $pluginsPath.'bower_components/';

$arTemplateCoreConfig = array(
	"cui" => array(
		"css" => array(
			$appPath . "css/normalize.css",
			$appPath . "css/cui/cui-base.css",
			$appPath . "css/typography.css",
			$appPath . "css/cui/cui-fgrid.css",
			$appPath . "css/cui/cui-form.css",
		),
		"use" => CJSCore::USE_PUBLIC,
	),
	"jquery" => array(
		"js" => $pluginsPath . "jquery-3.3.1.min.js",
		"use" => CJSCore::USE_PUBLIC,
	),
	"jqueryui" => array(
		"js" => $pluginsPath . "jquery-ui.min.js",
		"rel" => array("jquery"),
		"use" => CJSCore::USE_PUBLIC,
	),
	"vue-swiper" => [
		"js" => [
			$pluginsPath . "vue-awesome-swiper/dist/vue-awesome-swiper.js",
		],
		"css" => [],
		"use" => CJSCore::USE_PUBLIC,
		"rel" => ["ui.vue"],
	],
	"swiper" => array(
		"css" => $pluginsPath . "swiper/swiper.css",
		"js" => $pluginsPath . "swiper/swiper.js",
		'rel' => array('jquery'),
		"use" => CJSCore::USE_PUBLIC,
	),
	'magnific' => array(
		'js' => $pluginsPath . 'magnific-popup/magnific-popup.js',
		'css' => $pluginsPath . 'magnific-popup/magnific-popup.css',
		'rel' => array('jquery'),
		'use' => CJSCore::USE_PUBLIC,
	),
	'isotope' => array(
		'js' => $pluginsPath . 'isotope.min.js',
		'rel' => array('jquery'),
		'use' => CJSCore::USE_PUBLIC,
	),
	'headerScroll' => array(
		'js' => $pluginsPath . 'headerScroll.js',
		'rel' => array('jquery'),
		'use' => CJSCore::USE_PUBLIC,
	),
	'equalHeight' => array(
		'js' => $pluginsPath . 'EqualHeight.js',
		'rel' => array('jquery'),
		'use' => CJSCore::USE_PUBLIC,
	),
	'bLazy' => array(
		'js' => $pluginsPath . 'bLazy.js',
		'rel' => array('jquery'),
		'use' => CJSCore::USE_PUBLIC,
	),
	'photoSwipe' => array(
		'js' => array(
			$bowerPath.'/photoswipe/dist/photoswipe.min.js',
			$bowerPath.'/photoswipe/dist/photoswipe-ui-default.min.js',
			$pluginsPath.'/initPhotoSwipe.js',
		),
		'css' => array(
			$bowerPath.'/photoswipe/dist/photoswipe.css',
			$bowerPath.'/photoswipe/dist/default-skin/default-skin.css',
		),
		'rel' => array('jquery'),
		'use' => CJSCore::USE_PUBLIC,
	),
    "lightgallery" => array(
        "js" => array(
            $pluginsPath . "lightgallery/lightgallery.min.js",
            $pluginsPath . "lightgallery/plugins/video/lg-video.min.js",
            $pluginsPath . "lightgallery/plugins/thumbnail/lg-thumbnail.min.js",
        ),
        "css" => array(
            $pluginsPath . "lightgallery/css/lightgallery.css",
            $pluginsPath . "lightgallery/css/lg-video.css",
            $pluginsPath . "lightgallery/css/lg-thumbnail.css",
        ),
        'rel' => array('jquery'),
        "use" => CJSCore::USE_PUBLIC,
    ),
	"app" => array(
		"js" => array(
			$appPath . "js/main.js",
		),
		"css" => array(
			$appPath . "css/header.css",
			$appPath . "css/footer.css",
			$appPath . "css/main.css",
		),
		"rel" => array("jquery", "jqueryui", "cui", "magnific", "citrus_validator", 'equalHeight', 'headerScroll'),
		"use" => CJSCore::USE_PUBLIC,
	),
);

CJsCore::Init();
foreach ($arTemplateCoreConfig as $ext => $arExt)
{
	CJSCore::RegisterExt($ext, $arExt);
}
