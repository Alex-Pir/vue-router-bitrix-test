<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
* @global CMain $APPLICATION
* @var CBitrixComponent $component
* @var array $arParams
* @var array $arResult
* @var array $arCurSection
*/

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y') {
	$basketAction = isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '';
} else {
	$basketAction = isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '';
}
?>

<div class="row mb-4 bx-<?=$arParams["TEMPLATE_THEME"]?>">

	<div class="pb-4 <?=(($isFilter || $isSidebar) ? "col-lg-9 col-md-8 col-sm-7" : "col")?>">
		<?
		if (ModuleManager::isModuleInstalled("sale"))
		{
			$arRecomData = array();
			$recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
			$obCache = new CPHPCache();
			if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers"))
			{
				$arRecomData = $obCache->GetVars();
			}
			elseif ($obCache->StartDataCache())
			{
				if (Loader::includeModule("catalog"))
				{
					$arSKU = CCatalogSku::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
					$arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
				}
				$obCache->EndDataCache($arRecomData);
			}
		}

	 	 
		?>
	</div>
</div>