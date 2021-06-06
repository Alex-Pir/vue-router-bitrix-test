<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="container">
<div class="row flex_nowrap align-items-start">
	<div class="page__sidebar_left page__sidebar_filter col-12 col-lg-auto">
		<!--ФИЛЬТР-->
		<?$APPLICATION->IncludeComponent(
			"1dsp:catalog.smart.filter", 
			"1dsp", 
			array(
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CONVERT_CURRENCY" => "N",
				"DISPLAY_ELEMENT_COUNT" => "Y",
				"FILTER_NAME" => "arrDecorF",
				"FILTER_VIEW_MODE" => "VERTICAL",
				"HIDE_NOT_AVAILABLE" => "N",
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"], 
				"PAGER_PARAMS_NAME" => "arrPager",
				"PREFILTER_NAME" => "smartPreFilter",
				"PRICE_CODE" => array(
					0 => "BASE",
				),
				"SAVE_IN_SESSION" => "N",
				"SECTION_CODE" => "",
				"SECTION_DESCRIPTION" => "DESCRIPTION",
				"SECTION_ID" => 0,
				"SECTION_TITLE" => "NAME",
				"SEF_MODE" => "Y",
				"SEF_RULE" => "/decors/filter/#SMART_FILTER_PATH#/",
				"SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
				"TEMPLATE_THEME" => "site",
				"XML_EXPORT" => "N",
			),
			false
		);?>
		<!--КОНЕЦ ФИЛЬТР-->
	</div>

	<div class="page__middlebar col">
		<!--ХЛЕБНЫЕ КРОШКИ-->
		<?$APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"1dsp",
			array(
				"START_FROM" => "0",
				"PATH" => "",
				"SITE_ID" => "-"
			),
			false,
			Array('HIDE_ICONS' => 'Y')
		);?>
		<!--КОНЕЦ ХЛЕБНЫЕ КРОШКИ-->

		<!--ЗАГОЛОВОК-->
		<h1><?$APPLICATION->ShowTitle(false);?></h1>
		<!--КОНЕЦ ЗАГОЛОВОК-->

		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"1dsp-decors",
			Array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"NEWS_COUNT" => $arParams["NEWS_COUNT"],

				"SORT_BY1" => $arParams["SORT_BY1"],
				"SORT_ORDER1" => $arParams["SORT_ORDER1"],
				"SORT_BY2" => $arParams["SORT_BY2"],
				"SORT_ORDER2" => $arParams["SORT_ORDER2"],

				"FILTER_NAME" => "arrDecorF",
				"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"CHECK_DATES" => $arParams["CHECK_DATES"],
				"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
				"SEARCH_PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"],

				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

				"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
				"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"SET_BROWSER_TITLE" => "Y",
				"SET_META_KEYWORDS" => "Y",
				"SET_META_DESCRIPTION" => "Y",
				"MESSAGE_404" => $arParams["MESSAGE_404"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404" => $arParams["SHOW_404"],
				"FILE_404" => $arParams["FILE_404"],
				"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
				"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],

				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"INCLUDE_SUBSECTIONS" => "Y",

				"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
				"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
				"MEDIA_PROPERTY" => $arParams["MEDIA_PROPERTY"],
				"SLIDER_PROPERTY" => $arParams["SLIDER_PROPERTY"],

				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
				"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

				"USE_RATING" => $arParams["USE_RATING"],
				"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
				"MAX_VOTE" => $arParams["MAX_VOTE"],
				"VOTE_NAMES" => $arParams["VOTE_NAMES"],

				"USE_SHARE" => $arParams["LIST_USE_SHARE"],
				"SHARE_HIDE" => $arParams["SHARE_HIDE"],
				"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
				"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
				"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
				"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],

				"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
			),
			$component
		);?>
	</div>
</div>
</div>