<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?php
$index = 0;
foreach ($arResult["BASKET"] as $basket)
{

    $arResult["BASKET_JS"][$index]["count"] = $basket["QUANTITY"];
    $arResult["BASKET_JS"][$index]["name"] = $basket["NAME"];
    $arResult["BASKET_JS"][$index]["price"] = $basket["PRICE"];
    $arResult["BASKET_JS"][$index]["id"] = $basket["ID"];
    $arResult["BASKET_JS"][$index]["sum"] = $basket["QUANTITY"] * $basket["PRICE"];

    $index++;
}
?>
