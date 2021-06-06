<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
 * @var array $arResult
 * @var array $arParam
 * @var CBitrixComponentTemplate $this
 */

$this->setFrameMode(true);

if(!$arResult["NavShowAlways"]) {
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?>
<div class="pagination">
	<?
		$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
		$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
	?>

	<? if($arResult["bDescPageNumbering"] === true) { ?>

		<?//КНОПКА НАЗАД?>
		<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
			<? if($arResult["bSavePage"]) { ?>
				<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><</a>
			<? } else { ?>
				<? if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ) { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><</a>
				<? } else { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><</a>
				<? } ?>
			<? } ?>
		<? } ?>
		<?//КОНЕЦ КНОПКА НАЗАД?>

		<?//ЦИФРЫ?>
		<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
			<? if ($arResult["nStartPage"] < $arResult["NavPageCount"]) { ?>
				<? if($arResult["bSavePage"]) { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>">1</a>
				<? } else { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a>
				<? } ?>
				<? if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)) { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=intVal($arResult["nStartPage"] + ($arResult["NavPageCount"] - $arResult["nStartPage"]) / 2)?>">...</a>
				<? } ?>
			<? } ?>
		<? } ?>

		<? do { ?>
			<? $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1; ?>
			<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) { ?>
				<span class="pagination__link pagination__link_active"><?=$NavRecordGroupPrint?></span>
			<? } elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false) { ?>
				<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>
			<? } else { ?>
				<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
			<? } ?>
			<? $arResult["nStartPage"]--; ?>
		<? } while($arResult["nStartPage"] >= $arResult["nEndPage"]); ?>

		<? if ($arResult["NavPageNomer"] > 1) { ?>
			<? if ($arResult["nEndPage"] > 1) { ?>
				<? if ($arResult["nEndPage"] > 2) { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nEndPage"] / 2)?>">...</a>
				<? } ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=$arResult["NavPageCount"]?></a>
			<? } ?>
		<? } ?>
		<?//КОНЕЦ ЦИФРЫ?>

		<?//КНОПКА ВПЕРЕД?>
		<? if ($arResult["NavPageNomer"] > 1) { ?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">></a>
		<? } ?>
		<?//КОНЕЦ КНОПКА ВПЕРЕД?>

	<? } else { ?>

		<?//КНОПКА НАЗАД?>
		<? if ($arResult["NavPageNomer"] > 1) { ?>
			<? if($arResult["bSavePage"]) { ?>
				<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><</a>
			<? } else { ?>
				<? if ($arResult["NavPageNomer"] > 2) { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><</a>
				<? } else { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><</a>
				<? } ?>
			<? } ?>
		<? } ?>
		<?//КОНЕЦ КНОПКА НАЗАД?>

		<?//ЦИФРЫ?>
		<? if ($arResult["NavPageNomer"] > 1) { ?>
			<? if ($arResult["nStartPage"] > 1) { ?>
				<? if($arResult["bSavePage"]) { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">1</a>
				<? } else { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a>
				<? } ?>
				<? if ($arResult["nStartPage"] > 2) { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nStartPage"] / 2)?>">...</a>
				<? } ?>
			<? } ?>
		<? } ?>

		<? do { ?>
			<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) { ?>
				<span class="pagination__link pagination__link_active"><?=$arResult["nStartPage"]?></span>
			<? } elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false) { ?>
				<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
			<? } else { ?>
				<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
			<? } ?>
			<? $arResult["nStartPage"]++; ?>
		<? } while($arResult["nStartPage"] <= $arResult["nEndPage"]); ?>

		<? if($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
			<? if ($arResult["nEndPage"] < $arResult["NavPageCount"]) { ?>
				<? if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)) { ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nEndPage"] + ($arResult["NavPageCount"] - $arResult["nEndPage"]) / 2)?>">...</a>
				<? } ?>
					<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a>
			<? } ?>
		<? } ?>
		<?//КОНЕЦ ЦИФРЫ?>

		<?//КНОПКА ВПЕРЕД?>
		<? if($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">></a>
		<? } ?>
		<?//КОНЕЦ КНОПКА ВПЕРЕД?>

	<? } ?>
</div>