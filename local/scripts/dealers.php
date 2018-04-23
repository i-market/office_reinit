<?define("NO_AGENT_CHECK", true);
define('STOP_STATISTICS', true);
use \Bitrix\Iblock\ElementTable;
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/csv_data.php");

$file = $_SERVER["DOCUMENT_ROOT"]."/local/scripts/dealers.csv";
$csvFile = new CCSVData('R', false);
$csvFile->LoadFile($file);
$csvFile->SetDelimiter(';');
$arItems = Array();
$arOffers = Array();
$arItemsInSet = Array();
$arSets = array();
$arCollections = array();
$currentType = null;
$itemsTypes = array(
    "---СОТРУДНИКИ",//=>"SOTRUDNIKI",
    "---ДИЛЕРЫ",//=>"DEALERS",
    "---ЮРЛИЦА"//=>"JURFACES"
);
while ($arRow = $csvFile->Fetch()):
    $arRow = array_map("utf", $arRow);
    if(in_array($arRow[0], $itemsTypes) || !$currentType):
        $currentType = str_replace("---", "", $arRow[0]);
        continue;
    endif;

    /*switch($currentType):
        case "ТОВАРЫ":
            //$arOffers[$arRow[14]] = $arRow;

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
    endswitch;*/
    $arResult[$currentType][] = $arRow;
endwhile;

/*$arResult = Array(
    "ITEMS"=>$arItems,
    //"OFFERS"=>$arOffers,
    "ITEMS_IN_SET"=>$arItemsInSet,
    "SETS"=>$arSets,
    "COLLECTIONS"=>$arCollections
);*/

$arElement = new CIBlockElement;
foreach($arResult["СОТРУДНИКИ"] as $arUser):
    $userName = explode(" ", $arUser[1]);
    $arFields = Array(
        "NAME" => $userName[1],
        "LAST_NAME" => $userName[0],
        "LOGIN" => getCode($arUser[0]),
        "ACTIVE" => "Y",
        "PASSWORD" => $arUser[0],
        "EMAIL" => $arUser[3] ? $arUser[3] : getCode($arUser[0])."@profoffice.ru",
        "WORK_POSITION" => $arUser[2],
        "UF_SKYPE" => $arUser[4],
        "PERSONAL_ICQ" => $arUser[5],
        "GROUPS_ID" => Array(8)
    );
    $arUser = CUser::GetByLogin($arFields["LOGIN"])->Fetch();

    if(!$arUser)
        if(!$arUser["ID"] = $USER->Add($arFields))
            _c( $USER->LAST_ERROR );
    else
        ;
        //$USER->Update($arUser["ID"], $arFields);



    $arUsers[$arUser["ID"]] = $arFields;
endforeach;

foreach($arResult["ДИЛЕРЫ"] as $arFields):
    $arNewFields = Array(
        "NAME" => $arFields[1],
        "IBLOCK_ID" => IB_DEALERS,
        "CODE" => getCode($arFields[0]),
        "PROPERTY_VALUES" => Array(
            "CODE" => $arFields[0],
            "COMPANY" => $arFields[1],
            "ADDRESS" => $arFields[2],
            "CITY" => trim(str_replace("г.", $arFields[3])),
            "COUNTRY" => $arFields[4],
            "ZIP" => $arFields[5],
            "EMAIL" => $arFields[6],
            "PHONE" => $arFields[7],
            "WEB" => $arFields[8]
        )
    );
    $rsProduct = ElementTable::getList(array(
     'filter' => array(
         'IBLOCK_ID'=>IB_DEALERS,
         '=CODE'=>getCode($arFields[0])
     ),
        'select' => array('ID')
    ));
    if($arProduct = $rsProduct->fetch()):
        $itemId = $arProduct["ID"];
    else:
        if($itemId = $arElement->Add($arNewFields)):

        else:
            __($arElement->LAST_ERROR);
        endif;
    endif;
    $arDealers[$itemId] = $arNewFields;
endforeach;
/*
foreach($arResult["ЮРЛИЦА"] as $arFields):
    $arNewFields = Array(
        "NAME" => $arFields[0],
        "IBLOCK_ID" => IB_LEGAL,
        "PROPERTY_VALUES" => Array(
            "CODE" => $arFields[0],
            "COMPANY" => $arFields[1],
            "ADDRESS" => $arFields[2],
            "CITY" => trim(str_replace("г.", $arFields[3])),
            "COUNTRY" => $arFields[4],
            "ZIP" => $arFields[5],
            "LEGAL_ADDRESS" => $arFields[6],
            "LEGAL_CITY" => trim(str_replace("г.", $arFields[7])),
            "LEGAL_COUNTRY" => $arFields[8],
            "LEGAL_ZIP" => $arFields[9],
            "INN" => $arFields[10],
            "KPP" => $arFields[11],
            "OKATO" => $arFields[12],
            "BIK" => $arFields[14],
            "BANK" => $arFields[15],
            "ACCOUNT" => $arFields[16],
            "CORRESPONDENT_ACCOUNT" => $arFields[17]
        )
    );
    $rsProduct = ElementTable::getList(array(
     'filter' => array(
         'IBLOCK_ID'=>IB_LEGAL,
         '=NAME'=>$arFields[0]
     ),
        'select' => array('ID')
    ));
    if($arProduct = $rsProduct->fetch()):
        $itemId = $arProduct["ID"];
    else:
        if($itemId = $arElement->Add($arNewFields)):

        else:
            __($arElement->LAST_ERROR);
        endif;
    endif;
    $arLegals[$itemId] = $arNewFields;
endforeach;
*/
_c($arUsers);
_c($arLegals);
_c($arDealers);

/*if(!$_REQUEST["run"]):
    _c($arResult);
    die();
endif;*/


/*
    foreach()
    $arFields = Array(
        "IBLOCK_ID" => IB_CATALOG,
        "NAME" => $itemName,
        "CODE" => getCode($itemName),
    );
    $rsProduct = ElementTable::getList(array(
        'filter' => array(
            'IBLOCK_ID'=>IB_CATALOG,
            'NAME'=>$itemName
        ),
        'select' => array('ID')
    ));
    if($arProduct = $rsProduct->fetch()):
        $itemId = $arProduct["ID"];
    else:
        if($itemId = $arElement->Add($arFields)):
        else:
            __($arElement->LAST_ERROR);
        endif;
    endif;

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

        $arColor = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLORS, "NAME"=>$arItem[4], "PROPERTY_BRAND"=>$brandId), false, Array("nTopCount"=>"1"), Array("ID"))->Fetch();
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

        $priceEuro = $arItem[6];

        $arCatalog = CCatalogProduct::GetList(Array(), Array("ID"=>$offerId), false, Array("nTopCount"=>"1"), Array("ID"))->Fetch();

        if(!$arCatalog)
            CCatalogProduct::Add(Array("ID"=>$offerId), false);

        CPrice::SetBasePrice($offerId, $priceEuro, "EUR");

        $plastikId = getPropValueId("PLASTIK", $arItem[23]);
        $armRestId = getPropValueId("ARMREST", $arItem[27]);
        $mechanismId = getPropValueId("MECHANISM", $arItem[28]);
        $upholsteryId = getPropValueId("UPHOLSTERY", $arItem[29]);
        $baseId = getPropValueId("BASE", $arItem[33]);
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
_c($arProps);
foreach($arResult["COLLECTIONS"] as $key=>$arItem):
    $arFields = Array(
        "IBLOCK_ID" => IB_COLLECTIONS,
        "NAME" => $key,
        "CODE" => getCode($key)
    );
    $arCollection = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLLECTIONS, "NAME"=>$key, "ACTIVE"=>"Y"), false, Array("nTopCount"=>1), Array("ID"))->fetch();
    if($arCollection)
        $arElement->Update($arCollection["ID"], $arFields);
    else
        $arCollection["ID"] = $arElement->Add($arFields, false);

    $itemList = Array();
    foreach($arItem as $itemCode):
        $arOffer = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_OFFERS, "XML_ID"=>$itemCode), false, Array("nTopCount"=>1), Array("ID", "IBLOCK_ID", "PROPERTY_CML2_LINK"))->fetch();
        $itemList[$arOffer["PROPERTY_CML2_LINK_VALUE"]] = $arOffer["PROPERTY_CML2_LINK_VALUE"];
    endforeach;

    CIBlockElement::SetPropertyValuesEx($arCollection["ID"], IB_COLLECTIONS, Array("ITEMS"=>$itemList));
endforeach;*/