<?define("NO_AGENT_CHECK", true);
define('STOP_STATISTICS', true);
use \Bitrix\Iblock\ElementTable;
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/csv_data.php");

$file = $_SERVER["DOCUMENT_ROOT"]."/local/scripts/colors.csv";
$csvFile = new CCSVData('R', false);
$arElement = new CIBlockElement;
$csvFile->LoadFile($file);
$csvFile->SetDelimiter(';');

$arItems = Array();
$arOffers = Array();
$arItemsInSet = Array();
$arSets = Array();
$arCollections = Array();

$currentType = null;
while ($arRow = $csvFile->Fetch()):
    $arItem = Array(
        "BRAND"=>$arRow[0],
        "COLLECTION"=>$arRow[1],
        "COLOR"=>$arRow[2],
        "PICTURE"=>"{$_SERVER["DOCUMENT_ROOT"]}/local/scripts/images/{$arRow[3]}.jpg"
    );
    $arBrand = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_BRANDS, "NAME"=>$arItem["BRAND"]), false, Array("nTopCount"=>"1"), Array("ID"))->Fetch();
    if(!$arBrand):
        $arBrand["ID"] = $arElement->Add(Array(
            "IBLOCK_ID"=>IB_BRANDS,
            "NAME" => $arItem["BRAND"],
            "CODE" => getCode($arItem["BRAND"])
        ));
        if(!$arBrand["ID"])
            print_r($arElement->LAST_ERROR);
    endif;
    /*$arCollection = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLLECTIONS, "CODE"=>getCode($arItem["COLLECTION"])), false, Array("nTopCount"=>"1"), Array("ID"))->Fetch();
    $arCollectionFields = Array(
        "IBLOCK_ID"=>IB_COLLECTIONS,
        "NAME" => $arItem["COLLECTION"],
        "CODE" => getCode($arItem["COLLECTION"]),
        "XML_ID" => $arItem["COLLECTION"]
    );
    if(!$arCollection):
        $arCollection["ID"] = $arElement->Add($arCollectionFields);
    else:
        $arElement->Update($arCollection["ID"], $arCollectionFields);
    endif;*/

    $arFields = Array(
        "IBLOCK_ID"=>IB_COLORS,
        "NAME"=>$arItem["COLOR"],
        "PREVIEW_PICTURE" => CFile::MakeFileArray($arItem["PICTURE"]),
        "PROPERTY_VALUES"=>Array("BRAND"=>$arBrand["ID"])
    );
    $arFilter = Array(
        "IBLOCK_ID"=>IB_COLORS,
        "NAME"=>$arItem["COLOR"],
        "PROPERTY_BRAND"=>$arBrand["ID"]
    );
    $rsColor = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount"=>"1"), Array("ID"));
    if($arColor = $rsColor->Fetch()):
        $arElement->Update($arColor["ID"], $arFields);
    else:
        $arColor["ID"] = $arElement->Add($arFields);
        if(!$arColor["ID"])
            _c($arElement->LAST_ERROR);
    endif;
endwhile;



/*
$arResult = Array(
    "ITEMS"=>$arItems,
    "OFFERS"=>$arOffers,
    "ITEMS_IN_SET"=>$arItemsInSet,
    "SETS"=>$arSets,
    "COLLECTIONS"=>$arCollections,
    "ELEMENTS"=>Array()
);
$arElement = new CIBlockElement;
foreach($arResult["OFFERS"] as $itemName=>$arItems):
    $arFields = Array(
        "IBLOCK_ID" => IB_CATALOG,
        "NAME" => $itemName,
        "XML_ID" => $itemName,
        "CODE" => getCode($itemName)
    );
    //_c($arFields);
    $rsProduct = ElementTable::getList(array(
        'filter' => array(
            'IBLOCK_ID'=>IB_CATALOG,
            'XML_ID'=>$itemName
        ),
        'select' => array('ID')
    ));
    if($arProduct = $rsProduct->fetch()):
        $itemId = $arProduct["ID"];
    else:
        if($itemId = $arElement->Add($arFields)):
        else:
            _c($arElement->LAST_ERROR);
        endif;
    endif;

    foreach($arItems as $arItem):
        $arFields = Array(
            "IBLOCK_ID" => IB_OFFERS,
            "NAME" => $itemName . " " . $arItem[4],
            "XML_ID" => $arItem[14],
            "PROPERTY_VALUES" => Array(
                "CML2_LINK" => $itemId,
                "ARTICUL" => $arItem[0],
                "PRODUCT_ID" => $arItem[14],
                "PARENT_ID" => $arItem[15],
                "SIZE"=> $arItem[3]
            )
        );
        //_c($arFields);
        $rsOffer = ElementTable::getList(array(
            'filter' => array(
                'IBLOCK_ID'=>IB_OFFERS,
                'XML_ID'=>$arItem[14]
            ),
            'select' => array('ID')
        ));
        if(!$rsOffer->fetch()):
            if($arElement->Add($arFields)):

            else:
                _c($arElement->LAST_ERROR);
            endif;
        endif;
    endforeach;
endforeach;
//die();
//foreach($arResult["ITEMS"] as $key=>$arItem):

    /*$arFields = Array(
        "IBLOCK_ID" => IB_CATALOG,
        "NAME" => $arItem[1],
        "XML_ID" => $key,
        "CODE" => getCode($key),
        "PREVIEW_TEXT" => $arItem[2],
        "PROPERTY_VALUES" => Array(
            "ARTICUL" => $arItem[0],
            "PRODUCT_ID" => $key,
            "PARENT_ID" => $arItem[15],
            "SIZE"=> $arItem[3]
        )
    );*/


    //$arElement = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_OFFERS, "XML_ID"=>$key), false, Array("nTopCount"=>1), Array("ID"))->fetch();
    //$arResult["ELEMENTS"][$key] = $arElement["ID"];
    //$arElement->Add($arFields, false);
//endforeach;

foreach($arResult["COLLECTIONS"] as $key=>$arItem):
    $arFields = Array(
        "IBLOCK_ID" => IB_COLLECTIONS,
        "NAME" => $key,
        "XML_ID" => $key,
        "CODE" => $key
    );
    $arCollection = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLLECTIONS, "XML_ID"=>$key), false, Array("nTopCount"=>1), Array("ID"))->fetch();
    $itemList = Array();
    foreach($arItem as $itemCode):
        $arElement = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_OFFERS, "XML_ID"=>$itemCode), false, Array("nTopCount"=>1), Array("ID", "IBLOCK_ID", "PROPERTY_CML2_LINK"))->fetch();
        _c($arElement);
        $itemList[$arElement["PROPERTY_CML2_LINK_VALUE"]] = $arElement["PROPERTY_CML2_LINK_VALUE"];
    endforeach;

    CIBlockElement::SetPropertyValuesEx($arCollection["ID"], IB_COLLECTIONS, Array("ITEMS"=>$itemList));
    //$arElement->Add($arFields, false);
endforeach;