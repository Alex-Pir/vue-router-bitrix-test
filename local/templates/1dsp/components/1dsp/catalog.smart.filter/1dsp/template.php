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
<div class="button button_green d-lg-none" onclick="smartFilter.showFilter(this)">ПОКАЗАТЬ ФИЛЬТР ТОВАРОВ</div>

<div id="js-filter" class="filter d-lg-block">
	<div class="filter__title">ФИЛЬТР</div>
	<form class="filter__form">

		<? foreach($arResult["HIDDEN"] as $arItem) { ?>
			<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
		<? } ?>

		<? foreach($arResult["ITEMS"] as $key=>$arItem) { ?>
			<?
				/*
				чтобы убрать ненужные фильтры
				33 - длина плиты
				34 - ширина плиты
				*/
				// if( $arItem["ID"] == "33" || $arItem["ID"] == "34" ) continue;

				if (empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
					continue;
			?>

			<div class="filter__property js-smart-filter-parameters-box <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>bx-active<?endif?>">
				<span class="filter__modef js-smart-filter-container-modef"></span>

				<div class="filter__property-title" onclick="smartFilter.hideFilterProps(this)">
					<?=$arItem["NAME"]?>
					<div class="filter__arrow filter__arrow_<?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>up<?else:?>down<?endif?>" data-role="prop_arrow">
						<svg><title>Показать/скрыть</title><use xlink:href="#icon-slider-arrow"></svg>
					</div>
				</div>

				<?
					$arCur = current($arItem["VALUES"]);
					switch ($arItem["DISPLAY_TYPE"]) {
						// DROPDOWN
						case "P":
						?>
							<? $checkedItemExist = false; ?>
							<div class="filter__block filter__block_dropdown" data-role="bx_filter_block">
								<div class="filter__dropdown-text" data-role="currentOption">
									<? 
										foreach ($arItem["VALUES"] as $val => $ar) {
											if ($ar["CHECKED"]) {
												echo $ar["VALUE"];
												$checkedItemExist = true;
											}
										}
										if (!$checkedItemExist) {
											echo GetMessage("CT_BCSF_FILTER_ALL");
										}
									?>
								</div>
								<div class="filter__dropdown-arrow"><svg><title>Развернуть</title><use xlink:href="#icon-slider-arrow"/></svg></div>
								<input style="display: none"	type="radio" name="<?=$arCur["CONTROL_NAME_ALT"]?>" id="<? echo "all_".$arCur["CONTROL_ID"] ?>" value=""/>
								<? foreach ($arItem["VALUES"] as $val => $ar) { ?>
									<input style="display: none" type="radio" name="<?=$ar["CONTROL_NAME_ALT"]?>" id="<?=$ar["CONTROL_ID"]?>" value="<? echo $ar["HTML_VALUE_ALT"] ?>" <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>/>
								<? } ?>
							</div>
							<div class="filter__dropdown-popup" data-role="dropdownContent" style="display: none;">
								<ul>
									<li>
										<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="filter__label filter__label_dropdown" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')"><?=GetMessage("CT_BCSF_FILTER_ALL")?></label>
									</li>
									<? foreach ($arItem["VALUES"] as $val => $ar) {
										$class = "";
										if ($ar["CHECKED"]) $class.= " filter__label_selected";
										if ($ar["DISABLED"]) $class.= " filter__label_disabled";
									?>
										<li>
											<label for="<?=$ar["CONTROL_ID"]?>" class="filter__label filter__label_dropdown<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
										</li>
									<? } ?>
								</ul>
							</div>
						<?
							break;
							// END DROPDOWN

						// RADIO_BUTTONS
						case "K":
						?>
							<div class="filter__block filter__block_radio" data-role="bx_filter_block">
								<label class="filter__label filter__label_radio">
									<input class="filter__input filter__input_radio" type="radio" value="" name="<? echo $arCur["CONTROL_NAME_ALT"] ?>" id="<? echo "all_".$arCur["CONTROL_ID"] ?>" onclick="smartFilter.click(this)"/>
									<span class="filter__text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
								</label>
								<? foreach($arItem["VALUES"] as $val => $ar) { ?>
									<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="filter__label filter__label_radio">
										<input class="filter__input filter__input_radio" type="radio"	value="<? echo $ar["HTML_VALUE_ALT"] ?>" name="<? echo $ar["CONTROL_NAME_ALT"] ?>"	id="<? echo $ar["CONTROL_ID"] ?>"	<? echo $ar["CHECKED"]? 'checked="checked"': '' ?> <? echo $ar["DISABLED"] ? 'disabled': '' ?> onclick="smartFilter.click(this)"/>
										<span class="filter__text">
											<?=$ar["VALUE"];?>
											<? if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])) { ?>
												&nbsp;(<span class="filter__count" data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)
											<? } ?>
										</span>
									</label>
								<? } ?>
							</div>
						<?
							break;
							// END RADIO_BUTTONS

						// CHECKBOXES +
						default:
						?>
							<div class="filter__block filter__block_checkbox" data-role="bx_filter_block">
								<? foreach($arItem["VALUES"] as $val => $ar) { ?>
									<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="filter__label filter__label_checkbox">
										<input type="checkbox"	value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>"	id="<? echo $ar["CONTROL_ID"] ?>" class="filter__input filter__input_checkbox" <? echo $ar["CHECKED"]? 'checked="checked"': '' ?> <? echo $ar["DISABLED"] ? 'disabled': '' ?>	onclick="smartFilter.click(this)"/>
										<span class="filter__text">
											<?=$ar["VALUE"];?>
											<? if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])) {	?>
												&nbsp;(<span class="filter__count" data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)
											<? } ?>
										</span>
									</label>
								<? } ?>
							</div>
				<?
							// END CHECKBOXES +
					}
				?>
			</div>
		<? } ?>

		<div class="filter__buttons d-flex justify-content-start justify-content-lg-between">
			<input class="button button_buy filter__button_left" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"/>
			<input class="button button_grey" type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"/>
		</div>

		<div class="filter__result" id="modef" style="display:none">
			<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
			<br/>
			<a class="filter__result-link" href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
		</div>
	</form>
</div>

<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>