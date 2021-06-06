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
?>
	<div class="row">
		<? foreach ($arResult['SECTIONS'] as $arSection) { ?>
			<a class="catalog__category col-6 col-lg-4 col-xl-3" href="<?=$arSection['SECTION_PAGE_URL']?>">
        <img class="catalog__img" src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection['NAME']?>" title="<?=$arSection['NAME']?>"/>
        <div class="catalog__text"><?=$arSection['NAME']?><? if ($arParams["COUNT_ELEMENTS"]) { ?> (<?=$arSection['ELEMENT_CNT']?>)<? } ?></div>
      </a>
		<? } ?>
  </div>
