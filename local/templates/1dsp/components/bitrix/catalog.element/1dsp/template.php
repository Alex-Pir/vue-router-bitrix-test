<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

//имя 
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
$price = $arResult['ITEM_PRICES'][$arResult['ITEM_PRICE_SELECTED']];
if (!empty($arResult['PROPERTIES']['OLDPRICE']['VALUE']) && $arResult['PROPERTIES']['OLDPRICE']['VALUE'] > $price['RATIO_PRICE']) {
	$oldPrice = $arResult['PROPERTIES']['OLDPRICE']['VALUE'];
	$percent = round(($oldPrice - $price['RATIO_PRICE'])/$oldPrice*100);
}
if ($arResult['CATALOG_QUANTITY'] > 0) {
	$aviable = true;
}
?>


<? $testItem = $arResult; ?>
<div style="display:none">
	<? print_r($testItem); ?>
</div>
<!--ВЕРХ-->
<div class="row m-0 col-12 p-0">
  <div class="product__share col-12 col-lg-auto order-lg-1">
    <script type="text/javascript" src="https://yastatic.net/share2/share.js"></script>
    <div class="product__share-inner">
      <div class="product__share-block">Поделиться:</div>
      <div class="product__share-block yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter" data-yashareImage="{$product->image->filename|resize:100:100}"></div>
    </div>
  </div>
  <h1 class="product__title col-12 col-lg" data-product="{$product->id}"><?=$name?></h1>
</div>
<!--КОНЕЦ ВЕРХ-->
<!--ЛЕВО-->
<div class="product__img-block col-auto col-xl-4">
	<? if (!empty($arResult['MORE_PHOTO'])) { ?>
		<? foreach ($arResult['MORE_PHOTO'] as $key => $photo) { ?>
  		<a class="product__img-link" data-fancybox href="<?=$photo['SRC']?>"><img class="product__img" src="<?=$photo['SRC']?>"  alt="<?=$name?>" title="<?=$name?>"/></a>
			<? if ($oldPrice) { ?>
				<div class="product__lable product__lable_sale">АКЦИЯ</div>
			<? } else if ($arResult['PROPERTIES']['SALELEADER']['VALUE'] == 'да') { ?>
				<div class="product__lable product__lable_featured">ХИТ!</div>
			<? } else if ($arResult['PROPERTIES']['NEWPRODUCT']['VALUE'] == 'да') { ?>
				<div class="product__lable product__lable_featured">НОВИНКА</div>
			<? } ?>
		<? } ?>
	<? } ?>
</div>
<!--КОНЕЦ ЛЕВО-->
<!--ЦЕНТР-->
<div class="product__info col-12 col-md-6 col-lg-12 col-xl-4 row m-0 order-lg-1">
  <div class="product__aviable col-12 col-sm-7 col-md-12 col-lg-6 col-xl-12">
		<? if($aviable) { ?>
  		<div class="notice notice_green"><strong>Склад:</strong> В наличии</div>
    <? } else { ?>
    	<div class="notice notice_red"><strong>Склад:</strong> Нет в наличии</div>
		<? } ?>
  </div>
  <div class="product__button_raspil col-12 col-sm-7 col-md-12 col-lg-6 col-xl-12 order-md-1">
    <a class="button button_buy" href="/services/raskroj-i-kromlenie/" target="blank">Заказать раскрой/распил</a>
  </div>
  <div class="product__properties col-12 col-sm-8 col-md-12 offset-2 offset-md-0 order-lg-1 order-xl-0">
    <div class="product__properties-name">Характеристики</div>
    <? foreach ($arResult['DISPLAY_PROPERTIES'] as $dp_name=>$dp_value) { ?>
      <div class="product__property row m-0">
        <div class="product__property-name col-6"><?=$dp_name?>:</div>
        <div class="product__property-value col-6">
					<? foreach($dp_value as $i=>$v) { ?>
						<?=$v?><br/>
					<? } ?>
				</div>
      </div>
		<? } ?>
  </div>
</div>
<!--КОНЕЦ ЦЕНТР-->
<!--ПРАВО-->
<div class="product__buy col-12 col-md-6 col-xl-4 row m-0 order-xl-1 align-self-md-start align-self-lg-center align-self-xl-start">
  <div class="product__price col-12 col-sm-5 col-md-12 align-self-center">
    <div class="product__price_new">от <span><?=$price['RATIO_PRICE']?></span> руб./лист</div>
    <? if($oldPrice) { ?>
      <div class="product__price_old"><span class="product__price_percentage">-<?=$percent?>%</span><?=$oldPrice?> руб.</div>
		<? } ?>
  </div>

  <div class="product__separator col-12 d-sm-none d-md-block"></div>
        
  <div class="product__buttons col-12 col-sm-7 col-md-12">
  	<div class="product__button_callback">
      <div class="button button_buy js-modal-open" data-modal="callback">Получить консультацию</div>
    </div>
    <div class="product__separator"><div class="product__separator-text">или</div></div>
    <div class="product__button_buy">
      <div class="button button_buy button_red js-modal-open" data-modal="checkout" data-product-name="<?=$name?>" data-product-id="{$product->variant->id}"  data-name="<?=$name?>">Купить</div>
    </div>
  </div>
</div>
<!--КОНЕЦ ПРАВО-->
<?