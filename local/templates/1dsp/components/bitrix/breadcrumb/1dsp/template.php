<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

// Должна быть возвращена строка $strReturn, тк мы внутри функции GetNavChain()
if(empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '<div class="breadcrumbs">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if($index == 0) {
		$strReturn .=  '
			<div class="breadcrumbs__block">
    		<a class="breadcrumbs__link breadcrumbs__link_main" href="'.$arResult[$index]["LINK"].'" title="'.$title.'">
      		<div class="breadcrumbs__icon"><svg><title>'.$title.'</title><use xlink:href="#icon-home"/></svg></div>
      		<span>'.$title.'</span>
    		</a>
  		</div>';
	} elseif($arResult[$index]["LINK"] <> "" && $index != $itemSize-1) {
		$strReturn .=  '
			<div class="breadcrumbs__block">
				<a class="breadcrumbs__link breadcrumbs__link" href="'.$arResult[$index]["LINK"].'" title="'.$title.'">
					<span>'.$title.'</span>
				</a>
			</div>';
	} else {
		$strReturn .= '
			<div class="breadcrumbs__block">
				<span class="breadcrumbs__link breadcrumbs__link_last">
					<span>'.$title.'</span>
				</span>
			</div>';
	}
}

$strReturn .= '</div>';

return $strReturn;
