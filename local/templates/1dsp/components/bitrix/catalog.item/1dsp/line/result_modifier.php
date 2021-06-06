<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$validPropertyIDS = array(
  "32",   // Формат
  "35",   // Тольщина
);
$arResult["DISPLAY_PROPERTIES"] = array();
foreach ($arResult["PROPERTIES"] as $pid => &$arProp){
  if(in_array($pid, $validPropertyIDS)) continue;

  if((is_array($arProp["VALUE"]) && count($arProp["VALUE"])>0) || (!is_array($arProp["VALUE"]) && strlen($arProp["VALUE"])>0)){
    $arResult["DISPLAY_PROPERTIES"][$pid] = CIBlockFormatProperties::GetDisplayValue($arResult, $arProp);
  }
}