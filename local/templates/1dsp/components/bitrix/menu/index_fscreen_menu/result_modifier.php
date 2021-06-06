<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult as $itemIndex => $arItem) {
	if($arItem["TEXT"] == "Мебельные щиты") unset($arResult[$itemIndex]);
}