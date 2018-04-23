<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arProperties = &$arResult["PROPERTIES"];
$arCollectionSelect = array(
    "ID",
    "NAME",
    "IBLOCK_ID",
    "PREVIEW_PICTURE",
    "DETAIL_PAGE_URL",
    "PROPERTY_MINI_TEXT",
    "PROPERTY_PRICE",
    "PROPERTY_MAIN"
);
$arProductSelect = array(
    "ID",
    "NAME",
    "IBLOCK_ID",
    "PROPERTY_BRAND",
    "PROPERTY_CATEGORY",
    "PROPERTY_CATEGORY.NAME",
    "PROPERTY_CATEGORY.PREVIEW_PICTURE",
    "PROPERTY_CATEGORY.XML_ID",
    "PROPERTY_TYPE"
);
$arOfferSelect = array(
    "ID",
    "IBLOCK_ID",
    "NAME",
    "PREVIEW_PICTURE",
    "PROPERTY_ARTICUL",
    "PROPERTY_COUNT_STOCK",
    "PROPERTY_COUNT_COLLECT",
    "PROPERTY_COUNT_FREE",
    "PROPERTY_COUNT_TRANSIT",
    "PROPERTY_TITLE",
    "PROPERTY_BRAND",
    "PROPERTY_SIZE",
    "PROPERTY_COLOR",
    "PROPERTY_COLOR.NAME",
    "PROPERTY_COLOR.PREVIEW_PICTURE",
    "PROPERTY_WEIGHT",
    "PROPERTY_SIZE",
    "PROPERTY_DIMENSION",
    "PROPERTY_HEADREST",
    "PROPERTY_HANGER",
    "PROPERTY_PLASTIK",
    "PROPERTY_PLASTIK.NAME",
    "PROPERTY_PLASTIK.PROPERTY_COLOR",
    "PROPERTY_PLASTIK.PREVIEW_PICTURE",
    "PROPERTY_MESH_COLOR",
    "PROPERTY_MESH_COLOR.NAME",
    "PROPERTY_MESH_COLOR.PROPERTY_COLOR",
    "PROPERTY_MESH_COLOR.PREVIEW_PICTURE",
    "PROPERTY_ARMREST",
    "PROPERTY_ARMREST.NAME",
    "PROPERTY_ARMREST.PREVIEW_PICTURE",
    "PROPERTY_ARMREST.PREVIEW_TEXT",
    "PROPERTY_MECHANISM",
    "PROPERTY_MECHANISM.NAME",
    "PROPERTY_MECHANISM.PREVIEW_PICTURE",
    "PROPERTY_MECHANISM.PREVIEW_TEXT",
    "PROPERTY_UPHOLSTERY",
    "PROPERTY_UPHOLSTERY.NAME",
    "PROPERTY_UPHOLSTERY.PREVIEW_PICTURE",
    "PROPERTY_UPHOLSTERY_COLOR",
    "PROPERTY_UPHOLSTERY_COLOR.NAME",
    "PROPERTY_UPHOLSTERY_COLOR.PREVIEW_PICTURE",
    "PROPERTY_BASE",
    "PROPERTY_BASE.NAME",
    "PROPERTY_BASE.PREVIEW_PICTURE",
    "PROPERTY_BASE.PREVIEW_TEXT"
);
$arResult["COLORS"] = Array();
$arResult["PRICE"] = Array(
    "EUR" => $arProperties["PRICE"]["VALUE"],
    "RUB" => CCurrencyRates::ConvertCurrency($arProperties["PRICE"]["VALUE"], "EUR", "RUB")
);
$arIblocks = Array(
    "ARMREST"=>CIBlock::GetById(IB_CONFIG_ARMREST)->Fetch(),
	"BASE"=>CIBlock::GetById(IB_CONFIG_BASE)->Fetch(),
    "MECHANISM"=>CIBlock::GetById(IB_CONFIG_MECHANISM)->Fetch(),
    "MESH_COLOR"=>CIBlock::GetById(IB_CONFIG_MESH)->Fetch(),
    "UPHOLSTERY"=>CIBlock::GetById(IB_CONFIG_UPHOLSTERY)->Fetch(),
);
foreach($arProperties["ITEMS"]["VALUE"] as $itemId):
    $arItem = CIBlockElement::getList(
        array(),
        array(
            "ID"=>$itemId,
            "IBLOCK_ID"=>IB_CATALOG,
            "ACTIVE"=>"Y"
        ),
        false,
        array("nTopCount"=>"1"),
        $arProductSelect
    )->fetch();
    $arItem["CATEGORY"] = $arItem["PROPERTY_CATEGORY_XML_ID"] ? getCode($arItem["PROPERTY_CATEGORY_XML_ID"]) : "empty-cat";

    $arResult["CATEGORY_LIST"][$arItem["CATEGORY"]] = array(
        "NAME" => $arItem["PROPERTY_CATEGORY_NAME"],
        "XML_ID" => $arItem["PROPERTY_CATEGORY_XML_ID"],
        "CODE" => getCode($arItem["PROPERTY_CATEGORY_XML_ID"]),
        "PICTURE" => CFile::GetPath($arItem["PROPERTY_CATEGORY_PREVIEW_PICTURE"])
    );
    $arOffers = CIBlockElement::getList(
        array(),
        array(
            "PROPERTY_CML2_LINK"=>$itemId,
            "IBLOCK_ID"=>IB_OFFERS,
            "ACTIVE"=>"Y"
        ),
        false,
        array("nTopCount"=>"100"),
        $arOfferSelect
    );
    while($arOffer = $arOffers->fetch()):
        $offerId = $arOffer["ID"];
        $arColor = Array(
            "ID" => $arOffer["PROPERTY_COLOR_VALUE"],
            "NAME" => $arOffer["PROPERTY_COLOR_NAME"],
            "CODE" => getCode($arOffer["PROPERTY_COLOR_NAME"]),
            "PICTURE" => CFile::GetPath($arOffer["PROPERTY_COLOR_PREVIEW_PICTURE"])
        );
        $arOffer["COLOR"] = $arOffer["PROPERTY_COLOR_VALUE"] ? Array(
                "ID" => $arOffer["PROPERTY_COLOR_VALUE"],
                "NAME" => $arOffer["PROPERTY_COLOR_NAME"],
                "CODE" => getCode($arOffer["PROPERTY_COLOR_NAME"]),
                "PICTURE" => CFile::GetPath($arOffer["PROPERTY_COLOR_PREVIEW_PICTURE"])
            ) : Array(
                "ID" => "0_{$arOffer["ID"]}",
                "NAME" => "Цвет не задан",
                "CODE" => "blank",
                "PICTURE" => false
            );

        $arOffer["PRICE"] = getPrice($offerId);
        $arOffer["SIZE"] = $arOffer["PROPERTY_SIZE_VALUE"];
        $arOffer["PICTURE"] = getPhoto($arOffer["PREVIEW_PICTURE"], Array(500, 700));
        $arOffer["PRODUCT_NAME"] = $arItem["NAME"];
        $arOffer["STATUS"] = getStatus($offerId);
        if($arOffer["PROPERTY_PLASTIK_VALUE"] && $arItem["PROPERTY_TYPE_VALUE"] == "Целое"):
            $arResult["CONFIGURATOR"][$offerId] = Array(
                "FILTER" => Array(
                    "PROPERTY_ARMREST" => $arOffer["PROPERTY_ARMREST_VALUE"] ? $arOffer["PROPERTY_ARMREST_VALUE"] : false,
                    "PROPERTY_BASE" => $arOffer["PROPERTY_BASE_VALUE"] ? $arOffer["PROPERTY_BASE_VALUE"] : false,
                    "PROPERTY_PLASTIK" => $arOffer["PROPERTY_PLASTIK_VALUE"] ? $arOffer["PROPERTY_PLASTIK_VALUE"] : false,
                    "PROPERTY_HEADREST" => $arOffer["PROPERTY_HEADREST_ENUM_ID"] ? $arOffer["PROPERTY_HEADREST_ENUM_ID"] : false,
                    "PROPERTY_HANGER" => $arOffer["PROPERTY_HANGER_ENUM_ID"] ? $arOffer["PROPERTY_HANGER_ENUM_ID"] : false,
                    "PROPERTY_MECHANISM" => $arOffer["PROPERTY_MECHANISM_VALUE"] ? $arOffer["PROPERTY_MECHANISM_VALUE"] : false,
                    "PROPERTY_MESH_COLOR" => $arOffer["PROPERTY_MESH_COLOR_VALUE"] ? $arOffer["PROPERTY_MESH_COLOR_VALUE"] : false,
                    "PROPERTY_UPHOLSTERY" => $arOffer["PROPERTY_UPHOLSTERY_VALUE"] ? $arOffer["PROPERTY_UPHOLSTERY_VALUE"] : false,
                    "PROPERTY_UPHOLSTERY_COLOR" => $arOffer["PROPERTY_UPHOLSTERY_COLOR_VALUE"] ? $arOffer["PROPERTY_UPHOLSTERY_COLOR_VALUE"] : false
                ),
                "PROPERTIES" => Array(
                    "PLASTIK" => Array(
                        "VALUE"=>Array(
                            "ID"=>$arOffer["PROPERTY_PLASTIK_VALUE"],
                            "VALUE"=>$arOffer["PROPERTY_PLASTIK_NAME"],
                            "CODE"=>$arOffer["PROPERTY_PLASTIK_PROPERTY_COLOR_VALUE"]
                        )
                    ),
                    "MESH_COLOR" => Array(
                        "VALUE"=>Array(
                            "ID"=>$arOffer["PROPERTY_MESH_COLOR_VALUE"],
                            "VALUE"=>$arOffer["PROPERTY_MESH_COLOR_NAME"],
                            "CODE"=>$arOffer["PROPERTY_MESH_COLOR_PROPERTY_COLOR_VALUE"]
                        )
                    ),
                    "HEADREST" => Array(
                        "VALUE"=>Array(
                            "ID"=>$arOffer["PROPERTY_HEADREST_ENUM_ID"] ? $arOffer["PROPERTY_HEADREST_ENUM_ID"] : false,
                            "VALUE"=>$arOffer["PROPERTY_HEADREST_VALUE"] ? $arOffer["PROPERTY_HEADREST_VALUE"] : 0,
                            "TEXT" =>$arOffer["PROPERTY_HEADREST_ENUM_ID"] ? "Убрать" : "Добавить",
                            "SELECTED_TEXT"=>$arOffer["PROPERTY_HEADREST_ENUM_ID"] ? "с подголовником" : "без подголовника"
                        )
                    ),
                    "HANGER" => Array(
                        "VALUE"=>Array(
                            "ID"=>$arOffer["PROPERTY_HANGER_ENUM_ID"] ? $arOffer["PROPERTY_HANGER_ENUM_ID"] : false,
                            "VALUE"=>$arOffer["PROPERTY_HANGER_VALUE"] ? $arOffer["PROPERTY_HANGER_VALUE"] : 0,
                            "TEXT" =>$arOffer["PROPERTY_HANGER_ENUM_ID"] ? "Убрать" : "Добавить",
                            "SELECTED_TEXT"=>$arOffer["PROPERTY_HANGER_ENUM_ID"] ? "с вешалкой" : "без вешалки"
                        )
                    ),
                    "ARMREST" => Array(
                        "VALUE"=>Array(
                            "ID"=>$arOffer["PROPERTY_ARMREST_VALUE"],
                            "VALUE"=>$arOffer["PROPERTY_ARMREST_NAME"],
                            "PICTURE"=>getPhoto($arOffer["PROPERTY_ARMREST_PREVIEW_PICTURE"]),
                            "TOOLTIP"=>$arOffer["PROPERTY_ARMREST_PREVIEW_TEXT"]
                        ),
                        "TOOLTIP"=>$arIblocks["ARMREST"]["DESCRIPTION"]
                    ),
                    "MECHANISM" => Array(
                        "VALUE"=>Array(
                            "ID"=>$arOffer["PROPERTY_MECHANISM_VALUE"],
                            "VALUE"=>$arOffer["PROPERTY_MECHANISM_NAME"],
                            "PICTURE"=>getPhoto($arOffer["PROPERTY_MECHANISM_PREVIEW_PICTURE"]),
                            "TOOLTIP"=>$arOffer["PROPERTY_MECHANISM_PREVIEW_TEXT"]
                        ),
                        "TOOLTIP"=>$arIblocks["MECHANISM"]["DESCRIPTION"]
                    ),
                    "BASE" => Array(
                        "VALUE"=>Array(
                            "ID"=>$arOffer["PROPERTY_BASE_VALUE"],
                            "VALUE"=>$arOffer["PROPERTY_BASE_NAME"],
                            "PICTURE"=>getPhoto($arOffer["PROPERTY_BASE_PREVIEW_PICTURE"]),
                            "TOOLTIP"=>$arOffer["PROPERTY_BASE_PREVIEW_TEXT"]
                        ),
                        "TOOLTIP"=>$arIblocks["BASE"]["DESCRIPTION"]
                    ),
                    "UPHOLSTERY" => Array(
                        "VALUE"=>Array(
                            "ID"=>$arOffer["PROPERTY_UPHOLSTERY_VALUE"],
                            "VALUE"=>$arOffer["PROPERTY_UPHOLSTERY_NAME"],
                            "PICTURE"=>getPhoto($arOffer["PROPERTY_UPHOLSTERY_PREVIEW_PICTURE"])
                        ),
                        "TOOLTIP"=>$arIblocks["UPHOLSTERY"]["DESCRIPTION"]
                    ),
                    "UPHOLSTERY_COLOR" => Array(
                        "VALUE"=>Array(
                            "ID"=>$arOffer["PROPERTY_UPHOLSTERY_COLOR_VALUE"],
                            "VALUE"=>$arOffer["PROPERTY_UPHOLSTERY_COLOR_NAME"],
                            "PICTURE"=>getPhoto($arOffer["PROPERTY_UPHOLSTERY_COLOR_PREVIEW_PICTURE"])
                        )
                    )
                ),
                "OFFER" => $arOffer,
                "ITEM" => $arItem
            );


            if($arOffer["PROPERTY_PLASTIK_VALUE"] && !in_array($arOffer["PROPERTY_PLASTIK_NAME"], $arResult["CONFIG"]["PLASTIK"]))
                $arResult["CONFIG"]["PLASTIK"][$arOffer["PROPERTY_PLASTIK_NAME"]] = $arOffer["PROPERTY_PLASTIK_VALUE"];

            if($arOffer["PROPERTY_MESH_COLOR_VALUE"] && !in_array($arOffer["PROPERTY_MESH_COLOR_NAME"], $arResult["CONFIG"]["MESH_COLOR"]))
                $arResult["CONFIG"]["MESH_COLOR"][$arOffer["PROPERTY_MESH_COLOR_NAME"]] = $arOffer["PROPERTY_MESH_COLOR_VALUE"];

            if($arOffer["PROPERTY_BASE_NAME"] && !in_array($arOffer["PROPERTY_BASE_NAME"], $arResult["CONFIG"]["BASE"]))
                $arResult["CONFIG"]["BASE"][$arOffer["PROPERTY_BASE_NAME"]] = $arOffer["PROPERTY_BASE_VALUE"];

            if($arOffer["PROPERTY_HEADREST_ENUM_ID"] && !in_array($arOffer["PROPERTY_HEADREST_VALUE"], $arResult["CONFIG"]["HEADREST"]))
                $arResult["CONFIG"]["HEADREST"][$arOffer["PROPERTY_HEADREST_VALUE"]] = $arOffer["PROPERTY_HEADREST_ENUM_ID"];

            if($arOffer["PROPERTY_HANGER_ENUM_ID"] && !in_array($arOffer["PROPERTY_HANGER_VALUE"], $arResult["CONFIG"]["HANGER"]))
                $arResult["CONFIG"]["HANGER"][$arOffer["PROPERTY_HANGER_VALUE"]] = $arOffer["PROPERTY_HANGER_ENUM_ID"];

            if($arOffer["PROPERTY_ARMREST_VALUE"] && !in_array($arOffer["PROPERTY_ARMREST_NAME"], $arResult["CONFIG"]["ARMREST"]))
                $arResult["CONFIG"]["ARMREST"][$arOffer["PROPERTY_ARMREST_NAME"]] = $arOffer["PROPERTY_ARMREST_VALUE"];

            if($arOffer["PROPERTY_MECHANISM_VALUE"] && !in_array($arOffer["PROPERTY_MECHANISM_NAME"], $arResult["CONFIG"]["MECHANISM"]))
                $arResult["CONFIG"]["MECHANISM"][$arOffer["PROPERTY_MECHANISM_NAME"]] = $arOffer["PROPERTY_MECHANISM_VALUE"];

            if($arOffer["PROPERTY_UPHOLSTERY_VALUE"] && !in_array($arOffer["PROPERTY_UPHOLSTERY_NAME"], $arResult["CONFIG"]["UPHOLSTERY"]))
                $arResult["CONFIG"]["UPHOLSTERY"][$arOffer["PROPERTY_UPHOLSTERY_NAME"]] = $arOffer["PROPERTY_UPHOLSTERY_VALUE"];

            if($arOffer["PROPERTY_UPHOLSTERY_COLOR_VALUE"] && !in_array($arOffer["PROPERTY_UPHOLSTERY_COLOR_NAME"], $arResult["CONFIG"]["UPHOLSTERY_COLOR"]))
                $arResult["CONFIG"]["UPHOLSTERY_COLOR"][$arOffer["PROPERTY_UPHOLSTERY_COLOR_NAME"]] = $arOffer["PROPERTY_UPHOLSTERY_COLOR_VALUE"];
        endif;

        $arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["SIZES"][$arOffer["SIZE"]][$offerId] = $offerId;
        $arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["COLORS_OFFERS"][$arOffer["SIZE"]][$arOffer["COLOR"]["ID"]] = $offerId;
        $arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["COLORS"][$arOffer["SIZE"]][$arOffer["COLOR"]["ID"]] = $arOffer["COLOR"];
        $arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["COLOR_LIST"][] = $arOffer["COLOR"]["CODE"];
        $arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["OFFERS"][$offerId] = $arOffer;

        /*if(!in_array($arColor["ID"], $arResult["COLORS"]))
            $arResult["COLORS"][$arColor["ID"]] = $arColor;

        if(!in_array($arItem["CATEGORY"], $arResult["COLOR_CATEGORIES"][$arColor["ID"]]))
            $arResult["COLOR_CATEGORIES"][$arColor["ID"]][] = $arItem["CATEGORY"];*/

    endwhile;
    $arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["ITEM"] = $arItem;
    //array_unique($arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["COLOR_LIST"]);
endforeach;

$arResult["CONFIG"]["HEADREST"][0] = false;
$arResult["CONFIG"]["HANGER"][0] = false;


foreach($arResult["CONFIGURATOR"] as $offerId=>&$arConfig):
    foreach($arResult["CONFIG"] as $propertyName=>$arProperty):
        foreach($arProperty as $value=>$valueId):
            $tempFilter = $arConfig["FILTER"];
            $tempFilter["PROPERTY_{$propertyName}"] = $valueId;

            foreach($arResult["CONFIGURATOR"] as $subOfferId=>$arSubConfig):
                if($arSubConfig["FILTER"] == $tempFilter/* &&
                    $arConfig["PROPERTIES"][$propertyName]["VALUE"]["ID"] != $valueId*/
                ):
                    $arConfig["PROPERTIES"][$propertyName]["OTHER"][$valueId] = Array(
                        "ID" => $valueId,
                        "VALUE" => $value,
                        "OFFER_ID" => $subOfferId,
                        "OFFER" => $arSubConfig["OFFER"],
                        "PICTURE" => getPhoto($arSubConfig["OFFER"]["PROPERTY_{$propertyName}_PREVIEW_PICTURE"], Array(500, 700)),
                        "TOOLTIP" => $arSubConfig["OFFER"]["PROPERTY_{$propertyName}_PREVIEW_TEXT"]
                    );

                    switch($propertyName):
                        case "PLASTIK":
                            $arConfig["PROPERTIES"][$propertyName]["OTHER"][$valueId]["CODE"] = $arSubConfig["OFFER"]["PROPERTY_PLASTIK_PROPERTY_COLOR_VALUE"];
                            break;
                        case "MESH_COLOR":
                            $arConfig["PROPERTIES"][$propertyName]["OTHER"][$valueId]["CODE"] = $arSubConfig["OFFER"]["PROPERTY_MESH_COLOR_PROPERTY_COLOR_VALUE"];
                            break;
                        case "HEADREST":
                        case "HANGER":
                            $text = $value === "Y" ? "Добавить" : "Убрать";
                            $arConfig["PROPERTIES"][$propertyName]["OTHER"][$valueId]["TEXT"] = $text;
                        break;
                        default:
                            break;
                    endswitch;

                endif;
            endforeach;
        endforeach;
    endforeach;
endforeach;

$arPathLinks = explode("/", $arResult["SECTION"]["SECTION_PAGE_URL"]);
$arPathText = explode("/", "/Каталог/".$arResult["CATEGORY_PATH"]);

foreach($arPathLinks as $key=>$pathCode)
    if($pathCode)
        $arResult["PATH"][$pathCode] = $arPathText[$key];

foreach($arProperties["MORE_PHOTO"]["VALUE"] as $key=>$imageId):
    $arThumb = getPhoto($imageId, Array(180, 100));
    $arPhoto = getPhoto($imageId, Array(350, 560), true);
    $arResult["MEDIA"][] = Array(
       "THUMB" => $arThumb["SRC"],
       "SRC" => $arPhoto["SRC"],
       "ORIGINAL" => $arPhoto["ORIGINAL"],
       "DESCRIPTION" => $arProperties["MORE_PHOTO"]["DESCRIPTION"][$key],
       "TYPE" => "image"
    );
endforeach;
$arPorjectSelect = Array(
    "ID",
    "IBLOCK_ID",
    "NAME",
    "PREVIEW_PICTURE",
    "DETAIL_PAGE_URL"
);
$obProjects = CIBlockElement::GetList(
    Array(),
    Array(
        "IBLOCK_ID"=>IB_PROJECTS,
        "ACTIVE"=>"Y",
        "GLOBAL_ACTIVE"=>"Y",
        "PROPERTY_COLLECTIONS_VALUE"=>Array($arResult["ID"])
    ),
    false,
    Array("nTopCount"=>100),
    $arPorjectSelect
);
while($arProject = $obProjects->getNext()):
    $arProject["PICTURE"] = getPhoto($arProject["PREVIEW_PICTURE"]);
    $arResult["PROJECTS"][$arProject["ID"]] = $arProject;
endwhile;

if($itemId = $arResult["PROPERTIES"]["MAIN"]["VALUE"]):
    $arItem = CIBlockElement::getList(
        array(),
        array(
            "ID"=>$itemId,
            "IBLOCK_ID"=>IB_CATALOG,
            "ACTIVE"=>"Y"
        ),
        false,
        array("nTopCount"=>"1"),
        $arProductSelect
    )->fetch();
    $arOffers = CIBlockElement::getList(
        array(),
        array(
            "PROPERTY_CML2_LINK"=>$itemId,
            "IBLOCK_ID"=>IB_OFFERS,
            "ACTIVE"=>"Y"
        ),
        false,
        array("nTopCount"=>"100"),
        $arOfferSelect
    );
    while($arOffer = $arOffers->fetch()):
        $offerId = $arOffer["ID"];
        $arColor = Array(
            "ID" => $arOffer["PROPERTY_COLOR_VALUE"],
            "NAME" => $arOffer["PROPERTY_COLOR_NAME"],
            "CODE" => getCode($arOffer["PROPERTY_COLOR_NAME"]),
            "PICTURE" => CFile::GetPath($arOffer["PROPERTY_COLOR_PREVIEW_PICTURE"])
        );
        $arOffer["COLOR"] = $arColor;
        $arOffer["PRICE"] = getPrice($offerId);
        $arOffer["STATUS"] = getStatus($offerId);
        $arOffer["SIZE"] = $arOffer["PROPERTY_SIZE_VALUE"];
        if($arOffer["PREVIEW_PICTURE"]):
            $arThumb = getPhoto($arOffer["PREVIEW_PICTURE"], Array(180, 100));
            $arOffer["PICTURE"] = getPhoto($arOffer["PREVIEW_PICTURE"], Array(350, 560), true);
            $arResult["MEDIA"][] = Array(
               "THUMB" => $arThumb["SRC"],
               "SRC" => $arOffer["PICTURE"]["SRC"],
               "ORIGINAL" => $arPhoto["ORIGINAL"],
               "DESCRIPTION" => $arOffer["NAME"],
               "TYPE" => "image"
            );
        endif;
        $arOffer["PRODUCT_NAME"] = $arItem["NAME"];

        $arItem["SIZES"][$arOffer["SIZE"]][$offerId] = $offerId;
        $arItem["COLORS_OFFERS"][$arOffer["SIZE"]][$arColor["ID"]] = $offerId;
        $arItem["COLORS"][$arOffer["SIZE"]][$arColor["ID"]] = $arColor;
        $arItem["COLOR_LIST"][] = $arColor["CODE"];
        $arItem["OFFERS"][$offerId] = $arOffer;
    endwhile;

    $arResult["MAIN_ITEM"] = $arItem;
endif;
$arResult["DESCRIPTION"] = getDescription($arProperties["DESCRIPTION"]["VALUE"]);