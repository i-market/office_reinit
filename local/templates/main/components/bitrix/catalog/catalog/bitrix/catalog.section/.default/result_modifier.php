<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

foreach($arResult["ITEMS"] as &$arItem):
    $this->AddEditAction($arItem["ID"], $arItem['EDIT_LINK'], $elementEdit);
    $this->AddDeleteAction($arItem["ID"], $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
    $arItem["EDIT_AREA_ID"] = $this->GetEditAreaId($arItem["ID"]);
    $arItem["PRICE"] = Array(
        "EUR" => $arItem["PROPERTIES"]["PRICE"]["VALUE"],
        "RUB" => CCurrencyRates::ConvertCurrency($arItem["PROPERTIES"]["PRICE"]["VALUE"], "EUR", "RUB")
    );
    $arItem["PICTURE"] = getPhoto($arItem["PREVIEW_PICTURE"]["ID"], Array(351, 232), true);
endforeach;

$arResult["SIMILAR"] = Array();
$arOrder = Array("SORT"=>"ASC", "NAME"=>"ASC");
$arSections = CIBlockSection::getList(
    $arOrder,
    Array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ACTIVE" => "Y",
        "GLOBAL_ACTIVE" => "Y",
        "DEPTH_LEVEL" => "2",
        "SECTION_ID" => $arResult["PATH"][0]["ID"]
    ),
    false,
    Array(
        "ID",
        "NAME",
        "SECTION_PAGE_URL",
        "PICTURE"
    )
);
while($arSection = $arSections->getNext()):
    if($arSection["PICTURE"])
        $arSection["PICTURE"] = Array(
            "ID" => $arSection["PICTURE"],
            "SRC" => CFile::getPath($arSection["PICTURE"])
        );

    $arItems = CIBlockElement::getList(
        $arOrder,
        Array(
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ACTIVE" => "Y",
            "GLOBAL_ACTIVE" => "Y",
            "SECTION_ID" => $arSection["ID"]
        ),
        false,
        false,
        Array(
            "ID",
            "NAME",
            "DETAIL_PAGE_URL"
        )
    );
    while($arElement = $arItems->getNext())
        $arSection["ITEMS"][] = $arElement;
    $arResult["SIMILAR"][] = $arSection;
endwhile;