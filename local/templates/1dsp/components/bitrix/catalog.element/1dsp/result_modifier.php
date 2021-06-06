<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// свойства
$validPropertyIDS = array(
	"5",		// Бренд
  "32",   // Формат
	"35",   // Тольщина
  "36",		// Декор
  "37",   // Структура декора
	"38",		// Тип фанеры
	"39",		// Сорт фанеры
	"40",		// Поверхность фанеры
	"41",		// Свойства фанеры
	"42",		// Древесина
);
$arResult["DISPLAY_PROPERTIES"] = array();
foreach ($arResult["PROPERTIES"] as $pid => $arProp){
  if(in_array($arProp["ID"], $validPropertyIDS)) {
    if(is_array($arProp["VALUE"])) {
      foreach($arProp["VALUE"] as $i=>$v) {
        $val = CIBlockElement::GetByID($v);
        if($ar_val = $val->GetNext()) $arResult["DISPLAY_PROPERTIES"][$arProp["NAME"]][] = $ar_val["NAME"];
      }
    } else {
      $val = CIBlockElement::GetByID($arProp["VALUE"]);
      if($ar_val = $val->GetNext()) $arResult["DISPLAY_PROPERTIES"][$arProp["NAME"]][] = $ar_val["NAME"];
    }
  }
}