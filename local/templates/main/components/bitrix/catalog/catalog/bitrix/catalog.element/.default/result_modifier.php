<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arCollectionSelect = array(
    "ID",
    "NAME",
    "IBLOCK_ID",
    "PREVIEW_PICTURE",
    "DETAIL_PAGE_URL",
    "PROPERTY_MINI_TEXT",
    "PROPERTY_PRICE",
    "PROPERTY_COLORS"
);
$arProductSelect = array(
	"ID",
	"NAME",
	"IBLOCK_ID",
    "PROPERTY_BRAND",
    "PROPERTY_BRAND.NAME",
    "PROPERTY_TYPE",
	"PROPERTY_CATEGORY",
    "PROPERTY_CATEGORY.SORT",
	"PROPERTY_CATEGORY.NAME",
	"PROPERTY_CATEGORY.PREVIEW_PICTURE",
	"PROPERTY_CATEGORY.XML_ID"
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
    "PROPERTY_DIMENSION"
);
$arProperties = $arResult["PROPERTIES"];

$arCategories = \Bitrix\Iblock\ElementTable::getList(array(
    'order'=>array('SORT'=>'ASC'),
    'filter'=>array("IBLOCK_ID"=>IB_CATEGORIES, "ACTIVE"=>"Y"),
    'select'=>array('ID', 'NAME', 'CODE', 'XML_ID', 'PREVIEW_PICTURE')
))->fetchAll();
foreach($arCategories as $arCategory):
    $arResult["CATEGORIES"][getCode($arCategory["XML_ID"])] = array(
        "NAME" => $arCategory["NAME"],
        "XML_ID" => $arCategory["XML_ID"],
        "CODE" => getCode($arItem["XML_ID"]),
        "PICTURE" => CFile::GetPath($arCategory["PREVIEW_PICTURE"])
    );
endforeach;
$arResult["DESCRIPTION"] = getDescription($arProperties["DESCRIPTION"]["VALUE"]);
$arResult["COLORS"] = Array();
$arResult["MAIN_COLOR"] = Array();
$colorSortIndex = 0;
foreach($arResult["PROPERTIES"]["COLORS"]["VALUE"] as $itemId):
    $arColor = CIBlockElement::GetList(
        Array(),
        Array(
            "IBLOCK_ID"=>IB_COLORS,
            "ID"=>$itemId
        ),
        false,
        Array("nTopCount"=>"1"),
        Array("ID", "NAME", "PREVIEW_PICTURE", "IBLOCK_ID", "PROPERTY_COLORS")
    )->Fetch();
    $arColor["CODE"] = getCode($arColor["NAME"]);
    $arResult["COLORS"][$itemId] = Array(
        "ID" => $arColor["ID"],
        "NAME" => $arColor["NAME"],
        "CODE" => getCode($arColor["NAME"]),
        "PICTURE" => CFile::GetPath($arColor["PREVIEW_PICTURE"])
    );
    $arResult["COLORS_SORT"][$itemId] = ++$colorSortIndex;
    foreach($arColor["PROPERTY_COLORS_VALUE"] as $subColorId)
        $arResult["COLORS_SORT"][$subColorId] = ++$colorSortIndex;

    if(!$arResult["MAIN_COLOR"])
        $arResult["MAIN_COLOR"] = $arColor;
endforeach;

$arResult["PRICE"] = Array(
    "EUR" => $arResult["PROPERTIES"]["PRICE"]["VALUE"],
    "RUB" => CCurrencyRates::ConvertCurrency($arResult["PROPERTIES"]["PRICE"]["VALUE"], "EUR", "RUB")
);
foreach($arResult["PROPERTIES"]["ITEMS"]["VALUE"] as $itemId):
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

    $arAccessories = Array(
        "akses",
        "complect",
        "dopoborud"
    );
    if(in_array($arItem["CATEGORY"], $arAccessories))
        $arItem["CATEGORY"] = "dopoborud";

    if($arItem["PROPERTY_TYPE_VALUE"] == "Части" || $arItem["PROPERTY_TYPE_VALUE"] == "Целое-и-Части")
        $arItem["CATEGORY"] = "complect";

    if(!in_array($arItem["CATEGORY"], $arAccessories))
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
        false,
        $arOfferSelect
    );
    $offerList = Array();
    $offerList = Array();
    $size = false;

    while($arOffer = $arOffers->fetch()):
		$offerId = $arOffer["ID"];

		$arColor = Array(
			"ID" => $arOffer["PROPERTY_COLOR_VALUE"] ? $arOffer["PROPERTY_COLOR_VALUE"] : 0,
			"NAME" => $arOffer["PROPERTY_COLOR_VALUE"] ? $arOffer["PROPERTY_COLOR_NAME"] : "Цвет не указан",
			"CODE" => $arOffer["PROPERTY_COLOR_VALUE"] ? getCode($arOffer["PROPERTY_COLOR_NAME"]) :  "nocolor",
        	"PICTURE" => $arOffer["PROPERTY_COLOR_VALUE"] ? CFile::GetPath($arOffer["PROPERTY_COLOR_PREVIEW_PICTURE"]) : false
		);
        $arOffer["COLOR"] = $arColor;
        $arOffer["PRICE"] = getPrice($offerId);
		$arOffer["SIZE"] = $arOffer["PROPERTY_SIZE_VALUE"];
		$arOffer["PICTURE"] = getPhoto($arOffer["PREVIEW_PICTURE"]);

		$arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["SIZES"][$arOffer["SIZE"]][$offerId] = $offerId;
		$arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["COLORS_OFFERS"][$arOffer["SIZE"]][$arColor["ID"]] = $offerId;
		//$arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["COLORS"][$arOffer["SIZE"]][$arColor["ID"]] = $arColor;

		$arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["COLOR_LIST"][] = $arColor["CODE"];

		$mainColor = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLORS, "ACTIVE"=>"Y", "PROPERTY_COLORS"=>Array($arColor["ID"])), false, Array("nTopCount"=>"1"), Array("ID", "IBLOCK_ID", "NAME"))->Fetch();
    	if($mainColor)
    	    $arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["COLOR_LIST"][] = getCode($mainColor["NAME"]);

    	if(!isset($arResult["COLORS_SORT"][$arColor["ID"]]))
    	    $arResult["COLORS_SORT"][$arColor["ID"]] = ++$colorSortIndex;
    	$arOffer["SORT"] = $arResult["COLORS_SORT"][$arColor["ID"]];
        //$arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["OFFERS"][$offerId] = $arOffer;
        $offerList[$arOffer["SORT"]] = $arOffer;
        $colorList[$arOffer["SORT"]] = $arColor;

        $arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["OFFERS_SORT"][$arOffer["SORT"]] = $arOffer;
        if(!in_array($arItem["CATEGORY"], $arAccessories)):
            /*if(!in_array($arColor["ID"], $arResult["COLORS"]))
                $arResult["COLORS"][$arColor["ID"]] = $arColor;*/

    		if(!in_array($arItem["CATEGORY"], $arResult["COLOR_CATEGORIES"][$arColor["ID"]]))
    			$arResult["COLOR_CATEGORIES"][$arColor["ID"]][] = $arItem["CATEGORY"];
        endif;
        $size = $arOffer["SIZE"];
    endwhile;
    ksort($offerList);
    reset($offerList);
    ksort($colorList);
    reset($colorList);
    foreach($offerList as $arOffer):
        $arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["OFFERS"][$arOffer["ID"]] = $arOffer;
    endforeach;
    foreach($colorList as $arColor):
        $arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["COLORS"][$size][$arColor["ID"]] = $arColor;
    endforeach;

	$obProject = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_PROJECTS, "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "PROPERTY_ITEMS_VALUE"=>Array($arItem["ID"])), false, Array(), Array());
	while($arProject = $obProject->getNext()):
		$arProject["PICTURE"] = getPhoto($arProject["PREVIEW_PICTURE"]);
		$arResult["PROJECTS"][$arProject["ID"]] = $arProject;
	endwhile;

    if($arItem["PROPERTY_BRAND_VALUE"] && !in_array($arItem["PROPERTY_BRAND_VALUE"], $arResult["BRANDS"]))
        $arResult["BRANDS"][$arItem["PROPERTY_BRAND_VALUE"]] = $arItem["PROPERTY_BRAND_NAME"];
    $arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["ITEM"] = $arItem;
	array_unique($arResult["ITEMS"][$arItem["CATEGORY"]][$itemId]["COLOR_LIST"]);
endforeach;

foreach($arResult["PROPERTIES"]["SIMILAR"]["VALUE"] as $itemId):
    $arItem = CIBlockElement::getList(
        array(),
        array("ID"=>$itemId, "IBLOCK_ID"=>IB_COLLECTIONS, "ACTIVE"=>"Y"),
        false,
        array("nTopCount"=>"1"),
        $arCollectionSelect
    )->getNext();
    $arItem["PICTURE"] = getPhoto($arItem["PREVIEW_PICTURE"]);

    $arItem["PRICE"] = Array(
        "EUR" => $arItem["PROPERTY_PRICE_VALUE"],
        "RUB" => CCurrencyRates::ConvertCurrency($arItem["PROPERTY_PRICE_VALUE"], "EUR", "RUB")
    );
	$arResult["SIMILAR"][$itemId] = $arItem;
endforeach;

foreach($arResult["PROPERTIES"]["RECOMMENDED"]["VALUE"] as $itemId):
    $arItem = CIBlockElement::getList(
        array(),
        array("ID"=>$itemId, "IBLOCK_ID"=>IB_CATALOG, "ACTIVE"=>"Y"),
        false,
        array("nTopCount"=>"1"),
        $arProductSelect
    )->fetch();
	$arItem["CATEGORY"] = $arItem["PROPERTY_CATEGORY_NAME"] ? $arItem["PROPERTY_CATEGORY_NAME"] : "Без категории";
    $arOffers = CIBlockElement::getList(
        array(),
        array("PROPERTY_CML2_LINK"=>$itemId, "IBLOCK_ID"=>IB_OFFERS, "ACTIVE"=>"Y"),
        false,
        array("nTopCount"=>"100"),
        $arOfferSelect
    );
    $offerList = Array();

    while($arOffer = $arOffers->fetch()):
        $arOffer["PRICE"] = getPrice($arOffer["ID"]);
		$arOffer["PICTURE"] = getPhoto($arOffer["PREVIEW_PICTURE"]);
        $arColor = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLORS, "ID"=>$arOffer["PROPERTY_COLOR_VALUE"]), false, Array("nTopCount"=>"1"), Array("ID", "NAME", "PREVIEW_PICTURE"))->fetch();
        $arColor["PICTURE"] = CFile::GetPath($arColor["PREVIEW_PICTURE"]);
		$arColor["CODE"] = getCode($arColor["NAME"]);
        $arOffer["COLOR"] = $arColor;
        if(!isset($arResult["COLORS_SORT"][$arColor["ID"]]))
            $arResult["COLORS_SORT"][$arColor["ID"]] = ++$colorSortIndex;

		$arOffer["SIZE"] = $arOffer["PROPERTY_SIZE_VALUE"];

		$arResult["RECOMMENDED"]["ITEMS"][$itemId]["SIZES"][$arOffer["PROPERTY_SIZE_VALUE"]][$arOffer["ID"]] = $arOffer["ID"];
		$arResult["RECOMMENDED"]["ITEMS"][$itemId]["COLORS"][$arOffer["PROPERTY_SIZE_VALUE"]][$arColor["ID"]] = $arColor["CODE"];
		if(!in_array($arOffer["PROPERTY_COLOR_VALUE"], $arResult["RECOMMENED"]["COLORS"]))
            $arResult["RECOMMENDED"]["COLORS"][$arOffer["PROPERTY_COLOR_VALUE"]] = $arColor;
	    $arOffer["SORT"] = $arResult["COLORS_SORT"][$arColor["ID"]];
        //$arResult["RECOMMENDED"]["ITEMS"][$itemId]["OFFERS"][$arOffer["ID"]] = $arOffer;
        $offerList[$arResult["COLORS_SORT"][$arColor["ID"]]] = $arOffer;
    endwhile;
    ksort($offerList);
    foreach($offerList as $arOffer)
        $arResult["RECOMMENDED"]["ITEMS"][$itemId]["OFFERS"][$arOffer["ID"]] = $arOffer;

endforeach;

$obVariants = CIBlockElement::GetList(
	Array(),
	Array("IBLOCK_ID"=>IB_CABINET_VARIANTS, "PROPERTY_CABINET"=>$arResult["ID"]),
	false,
	Array("nTopCount"=>"100"),
	Array(
		"ID",
		"IBLOCK_ID",
		"NAME",
		"PREVIEW_PICTURE",
		"DETAIL_PICTURE",
		"PREVIEW_TEXT",
		"DETAIL_TEXT",
		"PROPERTY_ITEMS",
		"PROPERTY_ITEMS_COUNT",
		"PROPERTY_COMPLECT_TEXT",
		"PROPERTY_MAIN",
		"PROPERTY_ITEMS",
		"PROPERTY_POINTS",
		"PROPERTY_PICTURE"
	)
);
while($arVariant = $obVariants->Fetch()):
	$arVariant["PICTURE"] = getPhoto($arVariant["PREVIEW_PICTURE"], Array(374, 247), true);
	$obOffer = CIBlockElement::getList(
		Array(),
		Array("ID"=>$arVariant["PROPERTY_ITEMS_VALUE"], "IBLOCK_ID"=>IB_OFFERS, "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y"),
		false,
		Array(),
		$arOfferSelect
	);
	$counter = 0;
	while($arOffer = $obOffer->fetch()):
		$arColor = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLORS, "ID"=>$arOffer["PROPERTY_COLOR_VALUE"]), false, Array("nTopCount"=>"1"), Array("ID", "NAME", "PREVIEW_PICTURE"))->fetch();
        $arColor["PICTURE"] = CFile::GetPath($arColor["PREVIEW_PICTURE"]);
        $arOffer["COLOR"] = $arColor;
		$arOffer["SIZE"] = $arOffer["PROPERTY_SIZE_VALUE"];
		$arOffer["PRICE"] = getPrice($arOffer["ID"]);
		$arOffer["PICTURE"] = getPhoto($arOffer["PREVIEW_PICTURE"]);
		$arOffer["COUNT"] = $arVariant["PROPERTY_ITEMS_COUNT_VALUE"][$counter];
		$arOffer["SUM"]["EUR"] = $arVariant["PROPERTY_ITEMS_COUNT_VALUE"][$counter] * $arOffer["PRICE"]["REAL_PRICE"];
		$arOffer["SUM"]["RUB"] = $arVariant["PROPERTY_ITEMS_COUNT_VALUE"][$counter] * $arOffer["PRICE"]["PRICE"];


		$arVariant["ITEMS"][$arOffer["ID"]] = $arOffer;
		$arVariant["PRICE"]["EUR"] += $arOffer["SUM"]["EUR"];
		$arVariant["PRICE"]["RUB"] += $arOffer["SUM"]["RUB"];
        $counter++;
	endwhile;

	if($arVariant["PROPERTY_MAIN_VALUE"]):
		$arResult["MAIN_VARIANT"] = $arVariant;
		$arResult["THUMBS"][] = getPhoto($arVariant["PROPERTY_PICTURE_VALUE"], Array(171, 100));
	endif;

	$arResult["VARIANTS"][$arVariant["ID"]] = $arVariant;
endwhile;

$arPathLinks = explode("/", $arResult["SECTION"]["SECTION_PAGE_URL"]);
$arPathText = explode("/", "/Каталог/".$arResult["CATEGORY_PATH"]);

foreach($arPathLinks as $key=>$pathCode)
	if($pathCode)
		$arResult["PATH"][$pathCode] = $arPathText[$key];

foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $imageId):
	$arResult["IMAGES"][] = getPhoto($imageId);
	$arResult["THUMBS"][] = getPhoto($imageId, Array(171, 100));
endforeach;
_c($arResult);
