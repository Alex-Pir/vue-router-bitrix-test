<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if (empty($arResult))
	return;
?>

<div class="header__catalog-button d-lg-none js-toggler" data-toggle-target="catalog" data-toggle-group="menu">
  Каталог
  <div class="header__catalog-button-arrow"><svg><title>Открыть каталог</title><use xlink:href="#icon-catalog-arrow"/></svg></div>
</div>
<div class="header__catalog header__catalog_main menu menu_catalog-header d-lg-flex align-items-lg-center justify-content-lg-center" data-toggle-block="catalog">
  <?foreach($arResult as $itemIdex => $arItem):?>
    <a class="menu__link menu__link_catalog-header" href="<?=htmlspecialcharsbx($arItem["LINK"])?>"><?=htmlspecialcharsbx($arItem["TEXT"])?></a>
  <?endforeach;?>
</div> 