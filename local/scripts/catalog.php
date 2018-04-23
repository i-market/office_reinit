<?define("NO_AGENT_CHECK", true);
define('STOP_STATISTICS', true);
use \Bitrix\Iblock\ElementTable;
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/csv_data.php");

$file = $_SERVER["DOCUMENT_ROOT"]."/local/scripts/solosite.csv";
$csvFile = new CCSVData('R', false);
$csvFile->LoadFile($file);
$csvFile->SetDelimiter(';');
$arItems = Array();
$arOffers = Array();
$arItemsInSet = Array();
$arSets = array();
$arCollections = array();
$currentType = null;
$arElement = new CIBlockElement;
$itemsTypes = array(
    "ТОВАРЫ",
    "ТОВАРЫ В СОСТАВАХ",
    "СОСТАВЫ",
    "КОЛЛЕКЦИИ"
);
while ($arRow = $csvFile->Fetch()):
    //$arRow = array_map("encode", $arRow);

    if(in_array($arRow[0], $itemsTypes)):
        $currentType = $arRow[0];
        continue;
    endif;

    switch($currentType):
        case "ТОВАРЫ":
            //$arRow[1] = htmlspecialcharsbx($arRow[1]);
            //$arItems[$arRow[1]][$arRow[3]][$arRow[14]] = $arRow;
            //$arItems[$arRow[1]]["ITEMS"][$arRow[14]] = $arRow;
            $arItems[$arRow[1]][$arRow[3] ? $arRow[3] : "no_size"][$arRow[14]] = $arRow;

            if(count($arItems[$arRow[1]]) > 1)
                $arItemDouble[$arRow[1]] = $arItems[$arRow[1]];
            /*if($arRow[3])
                $arRow[1] .= "_{$arRow[3]}";*/
            //$arOffers[$arRow[14]] = $arRow;
            //$arItems[$arRow[1]][$arRow[14]] = $arRow;
            break;
        case "ТОВАРЫ В СОСТАВАХ":
            $arItemsInSet[$arRow[14]] = $arRow;
            break;
        case "СОСТАВЫ":
            $arSets[$arRow[0]][$arRow[1]] = $arRow;
            break;
        case "КОЛЛЕКЦИИ":
            if( strlen($arRow[1]) > 0 && strlen($arRow[0]) > 0)
                $arCollections[$arRow[1]][$arRow[0]] = $arRow[0];
            break;
        default:
            break;
    endswitch;
endwhile;
_c($arItemDouble);
$arResult = Array(
    "ITEMS"=>$arItems,
    //"OFFERS"=>$arOffers,
    "ITEMS_IN_SET"=>$arItemsInSet,
    "SETS"=>$arSets,
    "COLLECTIONS"=>$arCollections
);
_c($arResult);
if(!$_REQUEST["run"])
    die();


foreach($arResult["ITEMS"] as $itemName=>$arSize):
    foreach($arSize as $size=>$arItems):

        $arFields = Array(
            "IBLOCK_ID" => IB_CATALOG,
            "CODE" => getCode($itemName)
        );
        //$arRow[3] == "no_size" ? $arFields["PROPERTY_SIZE"]
        /*$rsProduct = ElementTable::getList(array(
            'filter' => array(
                'IBLOCK_ID'=>IB_CATALOG,
                'CODE'=>getCode($itemName)
            ),
            'select' => array('ID')
        ));*/
        $rsProduct = CIBlockElement::GetList(
            array(),
            array(
                "IBLOCK_ID" => IB_CATALOG,
                "CODE" => getCode($itemName),
                "PROPERTY_SIZE" => $size == "no_size" ? false : $size
            ),
            false,
            array("nTopCount"=>1),
            array("ID")
        );

        if($arProduct = $rsProduct->fetch()):
            $itemId = $arProduct["ID"];
        else:
            $arFields["NAME"] = $itemName;
            if($itemId = $arElement->Add($arFields)):
            else:
                __($arElement->LAST_ERROR);
            endif;
        endif;
        CIBlockElement::SetPropertyValuesEx($itemId, IB_CATALOG, Array("SIZE"=>$size == "no_size" ? false : $size));
        $brandId = false;
        foreach($arItems as $arItem):
            if($arItem[20]):
                $arItemCategory = CIBlockElement::GetList(
                    array(),
                    array("IBLOCK_ID"=>IB_CATEGORIES, "ACTIVE"=>"Y", "XML_ID"=>$arItem[20]),
                    false,
                    array("nTopCount"=>"1"),
                    array("ID")
                )->fetch();

                if(!$arItemCategory)
                    $arItemCategory["ID"] = $arElement->Add(array(
                        "IBLOCK_ID" => IB_CATEGORIES,
                        "XML_ID" => $arItem[20],
                        "NAME" => $arItem[20]
                    ));

                CIBlockElement::SetPropertyValuesEx($itemId, IB_CATALOG, Array("CATEGORY"=>$arItemCategory["ID"]));
            endif;
            switch($arItem[19]):
                case "Целое":
                    $itemType = 53;
                    break;
                case "Части":
                    $itemType = 54;
                    break;
                case "Целое-и-Части":
                    $itemType = 55;
                    break;
                default:
                    unset($itemType);
                    break;
            endswitch;

            if($itemType)
                CIBlockElement::SetPropertyValuesEx($itemId, IB_CATALOG, Array("TYPE"=>$itemType));

            if(!$brandId):
                $arBrandFields = Array(
                    "IBLOCK_ID" => IB_BRANDS,
                    "NAME" => $arItem[32],
                    "CODE" => getCode($arItem[32])
                );
                $arBrand = ElementTable::getList(array(
                    'filter' => $arBrandFields,
                    'select' => array('ID')
                ))->fetch();
                if(!$arBrand)
                    $arBrand["ID"] = $arElement->Add($arBrandFields);

                $brandId = $arBrand["ID"];
                CIBlockElement::SetPropertyValuesEx($itemId, IB_CATALOG, Array("BRAND"=>$brandId));
            endif;

            $arColor = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLORS, "NAME"=>$arItem[4], "PROPERTY_BRAND"=>$brandId, "ACTIVE"=>"Y"), false, Array("nTopCount"=>"1"), Array("ID"))->Fetch();
            if(!$arColor)
                $arColor["ID"] = $arElement->Add(Array(
                    "IBLOCK_ID" => IB_COLORS,
                    "NAME" => $arItem[4],
                    "PROPERTY_VALUES" => Array("BRAND"=>$brandId)
                ));

            $arFields = Array(
                "IBLOCK_ID" => IB_OFFERS,
                "NAME" => $itemName . " " . $arItem[4],
                "XML_ID" => $arItem[14]
            );
            $rsOffer = ElementTable::getList(array(
                'filter' => array(
                    'IBLOCK_ID'=>IB_OFFERS,
                    'XML_ID'=>$arItem[14]
                ),
                'select' => array('ID')
            ));
            if($arOffer = $rsOffer->fetch()):
                $offerId = $arOffer["ID"];
            else:
                $offerId = $arElement->Add($arFields);
            endif;

            $priceEuro = str_replace(" ", "", $arItem[6]);

            $arCatalog = CCatalogProduct::GetList(Array(), Array("ID"=>$offerId), false, Array("nTopCount"=>"1"), Array("ID"))->Fetch();

            if(!$arCatalog)
                CCatalogProduct::Add(Array("ID"=>$offerId), false);

            CPrice::SetBasePrice($offerId, $priceEuro, "EUR");

            $plastikId = getPropValueId("PLASTIK", $arItem[23]);
            $armRestId = getPropValueId("ARMREST", $arItem[27]);
            $mechanismId = getPropValueId("MECHANISM", $arItem[28]);
            $upholsteryId = getPropValueId("UPHOLSTERY", $arItem[29]);
            $baseId = getPropValueId("BASE", $arItem[33]);
            $meshId = getPropValueId("MESH_COLOR", $arItem[36]);
            if($arItem[30])
                $colorUpholsteryId = getUpholsteryColor($arItem[30], $upholsteryId);
            elseif($arItem[31])
                $colorUpholsteryId = getUpholsteryColor($arItem[31], $upholsteryId);
            else
                unset($colorUpholsteryId);

            $arOfferProperties = Array(
                "CML2_LINK" => $itemId,
                "ARTICUL" => $arItem[0],
                "PRODUCT_ID" => $arItem[14],
                "PARENT_ID" => $arItem[15],
                "SIZE"=> $arItem[3],
                "BRAND" => $brandId,
                "COLOR" => $arColor["ID"],
                "WEIGHT" => $arItem[11],
                "DIMENSION" => $arItem[12],
                "COUNT_STOCK" => $arItem[8],
                "COUNT_COLLECT" => $arItem[18],
                "COUNT_TRANSIT" => $arItem[17],
                "COUNT_FREE" => $arItem[9],
                "PLASTIK" => $plastikId,
                "BASE" => $baseId,
                "MESH_COLOR" => $meshId,
                "HEADREST" => ($arItem[24] == "Да" || $arItem[26] == "Да") ? 56 : false,
                "HANGER" => ($arItem[25] == "Да" || $arItem[26] == "Да") ? 57 : false,
                "ARMREST" => $armRestId,
                "MECHANISM" => $mechanismId,
                "UPHOLSTERY" => $upholsteryId,
                "UPHOLSTERY_COLOR" => $colorUpholsteryId
            );

            $arProps[$arItem[14]] = $arOfferProperties;
            CIBlockElement::SetPropertyValuesEx($offerId, IB_OFFERS, $arOfferProperties);
        endforeach;
    endforeach;
endforeach;

foreach($arResult["COLLECTIONS"] as $key=>$arItem):
    $arFields = Array(
        "IBLOCK_ID" => IB_COLLECTIONS,
        "CODE" => getCode($key)
    );
    $arCollection = CIBlockElement::GetList(Array(), $arFields, false, Array("nTopCount"=>1), Array("ID", "NAME", "IBLOCK_ID", "CODE"))->fetch();
    if($arCollection):
        //$arElement->Update($arCollection["ID"], $arFields);
    else:
        $arFields["NAME"] = $key;
        if(!($arCollection["ID"] = $arElement->Add($arFields, false)))
            _c($arElement->LAST_ERROR);
    endif;
    $itemList = Array();
    foreach($arItem as $itemCode):
        $arOffer = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_OFFERS, "XML_ID"=>$itemCode, "!PROPERTY_CML2_LINK"=>false), false, Array("nTopCount"=>1), Array("ID", "IBLOCK_ID", "PROPERTY_CML2_LINK"))->fetch();
        if(!$arOffer["PROPERTY_CML2_LINK_VALUE"])
            continue;
        $itemList[$arOffer["PROPERTY_CML2_LINK_VALUE"]] = $arOffer["PROPERTY_CML2_LINK_VALUE"];
        $cols[$arCollection["CODE"]][$arOffer["PROPERTY_CML2_LINK_VALUE"]][$arOffer["ID"]] = $arOffer;
    endforeach;

    CIBlockElement::SetPropertyValuesEx($arCollection["ID"], IB_COLLECTIONS, Array("ITEMS"=>$itemList));
endforeach;
_c($cols);
