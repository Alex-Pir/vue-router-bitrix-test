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
<div class="row align-items-start">
	<? foreach($arResult["ITEMS"] as $arItem) { ?>
		<div class="brands__block col-12 col-sm-6 col-xl-4">
    	<a class="brands__link_img" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="brands__img" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="Плиты <?=$arItem["~NAME"]?>" title="Плиты <?=$arItem["~NAME"]?>"/></a>
			<div class="brands__info row m-0 justify-content-center">
      	<div class="col-12"><a class="brands__link brands__link_name" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["~NAME"]?></a></div>
			</div>
		</div>
	<? } ?>
</div>
</div>