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
$brandName = GetIBlockElement($arResult["PROPERTIES"]["BRAND"]["VALUE"]);
?>
	<div class="page__sidebar_left col-12 col-lg-auto">
	<div style="display:none"><?print_r($brandName)?></div>
		<h1><?=$arResult["CODE"]?> <?=$arResult["NAME"]?></h1>
		<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="decor__img" title="<?=$arResult["NAME"]?>" alt="<?=$arResult["NAME"]?>"/>
		<div class="decor__param">
			Бренд <b><?=$brandName["NAME"]?></b>
		</div>
	</div>
