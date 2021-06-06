<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$validPropertyIDS = array(
  "32",   // Формат
  "35",   // Тольщина
);
$arResult['ITEM']["DISPLAY_PROPERTIES"] = array();
foreach ($arResult['ITEM']["PROPERTIES"] as $pid => $arProp){
  if(in_array($arProp["ID"], $validPropertyIDS)) {
    $val = CIBlockElement::GetByID($arProp["VALUE"]);
    if($ar_val = $val->GetNext()) $arResult['ITEM']["DISPLAY_PROPERTIES"][$arProp["NAME"]] = $ar_val["NAME"];
  }
}