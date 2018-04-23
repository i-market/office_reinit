<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
foreach($arResult["ITEMS" ] as &$arItem):
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $arItem["EDIT_ID"] = $this->GetEditAreaId($arItem['ID']);
    $arDate = ParseDateTime($arItem["ACTIVE_FROM"], FORMAT_DATETIME);
    $arItem["DATE"] = $arDate["DD"]." ".ToLower(GetMessage("MONTH_".intVal($arDate["MM"])."_S"))." ".$arDate["YYYY"];
    $arItem["PICTURE"] = getPhoto($arItem["PREVIEW_PICTURE"]);
endforeach;
$arResult["YEARS"] = Array(
    2017, 2016, 2015, 2014, 2013
);
