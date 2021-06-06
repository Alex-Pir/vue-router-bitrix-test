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

<div class="button_header-topbar-menu button_hamburger d-lg-none js-toggler" data-toggle-target="main-menu" data-toggle-group="menu">
  <span></span>
  <span></span>
  <span></span>
</div>
<div class="header__menu header__menu_not-main menu menu_main-header d-lg-flex align-items-lg-center" data-toggle-block="main-menu">
  <?foreach($arResult as $itemIdex => $arItem):?>
		<a class="menu__link menu__link_main-header col-auto" href="<?=htmlspecialcharsbx($arItem["LINK"])?>"><?=htmlspecialcharsbx($arItem["TEXT"])?></a>
	<?endforeach;?>
</div>