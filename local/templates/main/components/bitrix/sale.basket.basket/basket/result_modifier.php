<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

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
    "PROPERTY_BASE.PREVIEW_TEXT",
    "PROPERTY_CML2_LINK"
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
foreach($arResult["ITEMS"] as $type=>&$arItems):
    foreach($arItems as &$arItem):
        if($type == "AnDelCanBuy"):
            $arOffer = CIBlockElement::GetList(array(), Array("IBLOCK_ID"=>IB_OFFERS, "ID"=>$arItem["PRODUCT_ID"]), false, Array("nTopCount"=>"1"), $arOfferSelect)->Fetch();
            $arItem["ITEM"] = CIBlockElement::GetList(array(), Array("IBLOCK_ID"=>IB_CATALOG, "ID"=>$arOffer["PROPERTY_CML2_LINK_VALUE"]), false, Array("nTopCount"=>"1"), $arProductSelect)->Fetch();
            if($arItem["ITEM"]["PROPERTY_CATEGORY_NAME"] == "Кресло"):
                if($arOffer["PROPERTY_PLASTIK_VALUE"])
                    $arItem["SPECIFICATION"][] = Array(
                        "NAME" => "Цвет пластиковых деталей",
                        "VALUE" => "<div class=\"color\" title=\"{$arOffer["PROPERTY_PLASTIK_NAME"]}\"><span class=\"circle black\"></span></div>"
                    );

                if($arOffer["PROPERTY_MESH_COLOR_VALUE"])
                    $arItem["SPECIFICATION"][] = Array(
                        "NAME" => "Цвет сетки",
                        "VALUE" => "<div class=\"color\" title=\"{$arOffer["PROPERTY_MESH_COLOR_NAME"]}\"><span class=\"circle black\"></span></div>"
                    );

                if($arOffer["PROPERTY_UPHOLSTERY_NAME"])
                    $arItem["SPECIFICATION"][] = Array(
                        "NAME" => "Обшивка",
                        "VALUE" => $arOffer["PROPERTY_UPHOLSTERY_NAME"]
                    );

                if($arOffer["PROPERTY_UPHOLSTERY_COLOR_NAME"])
                    $arItem["SPECIFICATION"][] = Array(
                        "NAME" => "Цвет обшвки",
                        "VALUE" => "<div class=\"color\" title=\"{$arOffer["PROPERTY_UPHOLSTERY_COLOR_NAME"]}\"><span class=\"circle black\"></span></div>"
                    );

                if($arOffer["PROPERTY_ARMREST_VALUE"])
                    $arItem["SPECIFICATION"][] = Array(
                        "NAME" => "Подлокотник",
                        "VALUE" => $arOffer["PROPERTY_ARMREST_NAME"]
                    );

                if($arOffer["PROPERTY_MECHANISM_VALUE"])
                    $arItem["SPECIFICATION"][] = Array(
                        "NAME" => "Механизм",
                        "VALUE" => $arOffer["PROPERTY_MECHANISM_NAME"]
                    );

                if($arOffer["PROPERTY_HANGER_ENUM_ID"])
                    $arItem["SPECIFICATION"][] = Array(
                        "NAME" => "Вешалка",
                        "VALUE" => $arOffer["PROPERTY_HANGER_VALUE"]
                    );

                if($arOffer["PROPERTY_HEADREST_ENUM_ID"])
                    $arItem["SPECIFICATION"][] = Array(
                        "NAME" => "Подголовник",
                        "VALUE" => $arOffer["PROPERTY_HEADREST_VALUE"]
                    );

            endif;
            $arItem["PICTURE"] = getPhoto($arItem["PREVIEW_PICTURE"]);
            $arColor = CIBlockElement::GetList(
                Array(),
                Array(
                    "IBLOCK_ID"=>IB_COLORS,
                    "ID" => $arItem["PROPERTY_COLOR_VALUE"]
                ),
                false,
                Array("nTopCount"=>"1"),
                Array("ID", "NAME", "PREVIEW_PICTURE")
            )->Fetch();
            $arColor["PICTURE"] = getPhoto($arColor["PREVIEW_PICTURE"]);
            $arItem["COLOR"] = $arColor;
            $arItem["OFFER"] = $arOffer;
        else:
            CSaleBasket::Delete($arItem["ID"]);
        endif;
    endforeach;
endforeach;
_c($arResult);
