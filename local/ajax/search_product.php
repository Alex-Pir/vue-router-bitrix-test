<?
  require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); // --- подключаем пролог ядра

  CModule::IncludeModule("iblock"); // --- подключаем модуль инфоблоков 

  $search = $_REQUEST["s"];  // --- входящий запрос

  /* --- поиск и определение количества по всей базе --- */

  /* --- товары --- */
  $resultProducts = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>2, "ACTIVE"=>"Y", "%NAME"=>$search), false, false, Array("ID", "NAME", "DETAIL_PICTURE", "DETAIL_PAGE_URL"));
  while($product = $resultProducts->GetNext()){
    $productIMG = CFile::GetPath($product["DETAIL_PICTURE"]);
    ?><a class="search__result-line" href="/catalog<?=$product["DETAIL_PAGE_URL"]?>"><img class="search__result-img" src="<?=$productIMG?>"/><?=$product["NAME"]?></a><?
  }
?>