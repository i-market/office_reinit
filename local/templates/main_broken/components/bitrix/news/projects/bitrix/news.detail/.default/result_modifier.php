<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arDate = ParseDateTime($arResult["ACTIVE_FROM"], FORMAT_DATETIME);
$arResult["DATE"] = $arDate["DD"]." ".ToLower(GetMessage("MONTH_".intVal($arDate["MM"])."_S"))." ".$arDate["YYYY"];
$arComments = CIBlockElement::getList(Array("SORT"=>"ASC", "DATE_CREATE"=>"DESC"), Array("IBLOCK_ID"=>IB_NEWS_COMMENTS, "ACTIVE"=>"Y", "PROPERTY_ITEM"=>$arResult["ID"]), false, Array("nTopCount"=>"500"), Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_USER", "PROPERTY_EMAIL", "PREVIEW_TEXT"));
while($arComment = $arComments->fetch())
    $arResult["COMMENTS"][] = $arComment;

foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $imageId):
    $arPicture = getPhoto($imageId);
    $arThumb = getPhoto($imageId, Array(171, 100));
    $arPicture["THUMB"] = $arThumb["SRC"];
    $arResult["IMAGES"][] = $arPicture;
endforeach;

$obCollections = CIBlockElement::GetList(
    Array("IBLOCK_SECTION_ID"=>"ASC"),
    Array(
        "IBLOCK_ID"=>IB_COLLECTIONS,
        "ID"=>$arResult["PROPERTIES"]["COLLECTIONS"]["VALUE"]
    ),
    false,
    Array("nTopCount"=>count($arResult["PROPERTIES"]["COLLECTIONS"]["VALUE"])),
    Array(
        "ID",
        "IBLOCK_ID",
        "IBLOCK_SECTION_ID",
        "NAME",
        "DETAIL_PAGE_URL"
    )
);

while($arCollection = $obCollections->GetNext()):
    $arSection = CIBlockSection::GetList(
        Array(),
        Array("ID"=>$arCollection["IBLOCK_SECTION_ID"]),
        false,
        Array("ID", "NAME", "DEPTH_LEVEL", "IBLOCK_SECTION_ID"),
        Array("nTopCount"=>1)
    )->fetch();
    if($arSection["DEPTH_LEVEL"] > 2)
        $arSection = CIBlockSection::GetList(
            Array(),
            Array("ID"=>$arSection["IBLOCK_SECTION_ID"]),
            false,
            Array("ID", "NAME", "DEPTH_LEVEL", "IBLOCK_SECTION_ID"),
            Array("nTopCount"=>1)
        )->fetch();

    $arResult["COLLECTIONS"][$arSection["NAME"]][$arCollection["ID"]] = $arCollection;
endwhile;

_c($arResult);
