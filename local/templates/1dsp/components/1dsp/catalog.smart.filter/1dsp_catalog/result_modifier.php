<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// Функция для сортировки многомерных массивов
function array_sort($array, $on, $order=SORT_ASC) {
  $new_array = array();
  $sortable_array = array();

  if (count($array) > 0) {
    foreach ($array as $k => $v) {
      if (is_array($v)) {
        foreach ($v as $k2 => $v2) {
          if ($k2 == $on) $sortable_array[$k] = $v2;
        }
      } else {
        $sortable_array[$k] = $v;
      }
    }

    switch ($order) {
			case SORT_ASC:
        asort($sortable_array);
        break;
      case SORT_DESC:
        arsort($sortable_array);
        break;
    }

    foreach ($sortable_array as $k => $v) {
      $new_array[$k] = $array[$k];
    }
  }

  return $new_array;
}

// ПРАВИЛЬНАЯ СОРТИРОВКА ЗНАЧЕНИЙ СВОЙСТВ
foreach($arResult["ITEMS"] as $key=>$arItem) {
	/*
		35 - толщина плиты
	*/
	if( $arItem["ID"] == "35") {
		foreach($arItem["VALUES"] as $val => $ar) {
			$tempVal = substr($ar["VALUE"],0,-2);
			$arItem["VALUES"][$val]["SORTIROVKA"] = (int)$tempVal;
		}
		$arResult["ITEMS"][$key]["VALUES"] = array_sort($arItem["VALUES"], 'SORTIROVKA', SORT_ASC);
	}
}
