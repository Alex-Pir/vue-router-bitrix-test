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
<div class="page__content decory row justify-content-around align-items-start">
	<? foreach($arResult["ITEMS"] as $arItem) { ?>
    <a class="decory__block" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
      <div class="decory__img-block"><img class="decory__img" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="Декор <?=$arItem["NAME"]?>" title="Декор <?=$arItem["NAME"]?>"/></div>
      <div class="decory__name"><?=$arItem["CODE"]?> <?=$arItem["NAME"]?></div>
    </a>
	<? } ?>
</div>
</div>