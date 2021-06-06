<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var array $morePhoto
 * @var string $imgTitle
 * @var string $productTitle
 * @var CatalogSectionComponent $component
 */


	$showProps = !empty($item['DISPLAY_PROPERTIES']);
	$showProductProps = $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($item['PRODUCT_PROPERTIES']);
	$showSkuBlock = false;
?>

<div class="brow-product row m-0">
  <div class="brow-product__img-block col-auto">
		<img class="brow-product__img" src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$productTitle?>" title="<?=$productTitle?>"/>
		<? if ($oldPrice) { ?>
			<div class="brow-product__lable brow-product__lable_sale">АКЦИЯ</div>
		<? } else if ($item['PROPERTIES']['SALELEADER']['VALUE'] == 'да') { ?>
			<div class="brow-product__lable brow-product__lable_featured">ХИТ!</div>
		<? } else if ($item['PROPERTIES']['NEWPRODUCT']['VALUE'] == 'да') { ?>
			<div class="brow-product__lable brow-product__lable_featured">НОВИНКА</div>
		<? } ?>
  </div>
  <div class="brow-product__info col">
    <h3 class="brow-product__name">
      <a class="brow-product__name-link" href="<?=$item['DETAIL_PAGE_URL']?>"><?=$productTitle?></a>
    </h3>
		<? if ($showProps) { ?>
			<div class="brow-product__properties">
				<? foreach ($item['DISPLAY_PROPERTIES'] as $dp_name=>$dp_value) { ?>
					<span class="brow-product__property-name"><?=$dp_name?></span><?=$dp_value?><br/>
				<? } ?>
			</div>
		<? } ?>
  </div>
	
  <div class="brow-product__buy col-12 col-sm-auto row m-0 flex-sm-column align-items-center align-items-sm-stretch js-product-buy">
		<div class="brow-product__price col">
      <div class="brow-product__price_new">от <span class="brow-product__price_bold"><? if (!empty($price)) echo $price['PRINT_RATIO_PRICE']; ?></div>
      <? if ($oldPrice) { ?>
        <div class="brow-product__price_old"><?=$oldPrice?></div>
			<? } ?>
    </div>

		<div class="col-auto"><a class="button button_buy" href="/catalog<?=$item['DETAIL_PAGE_URL']?>">купить</a></div>
  </div>
</div>