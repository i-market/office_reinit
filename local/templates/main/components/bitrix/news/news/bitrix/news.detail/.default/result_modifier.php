<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arDate = ParseDateTime($arResult["ACTIVE_FROM"], FORMAT_DATETIME);
$arResult["DATE"] = $arDate["DD"]." ".ToLower(GetMessage("MONTH_".intVal($arDate["MM"])."_S"))." ".$arDate["YYYY"];
$arComments = CIBlockElement::getList(Array("SORT"=>"ASC", "DATE_CREATE"=>"DESC"), Array("IBLOCK_ID"=>IB_NEWS_COMMENTS, "ACTIVE"=>"Y", "PROPERTY_ITEM"=>$arResult["ID"]), false, Array("nTopCount"=>"500"), Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_USER", "PROPERTY_EMAIL", "PREVIEW_TEXT"));
while($arComment = $arComments->fetch())
    $arResult["COMMENTS"][] = $arComment;
