<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if($_REQUEST["year"]):
    global $arrFilter;
    $year = $_REQUEST["year"];
    $arrFilter = Array(
        ">=DATE_ACTIVE_FROM" => date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), mktime(0,0,0,1,1, intVal($year))),
        "<DATE_ACTIVE_FROM" => date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), mktime(0,0,0,1,1, intVal($year) + 1))
    );
endif;
$APPLICATION->IncludeComponent("bitrix:news.list", "", Array(
    "FILTER_NAME" => "arrFilter",
    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "NEWS_COUNT" => $arParams["NEWS_COUNT"],
    "SORT_BY1" => $arParams["SORT_BY1"],
    "SORT_ORDER1" => $arParams["SORT_ORDER1"],
    "SORT_BY2" => $arParams["SORT_BY2"],
    "SORT_ORDER2" => $arParams["SORT_ORDER2"],
    "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
    "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
    "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
    "SET_TITLE" => $arParams["SET_TITLE"],
    "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
    "MESSAGE_404" => $arParams["MESSAGE_404"],
    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
    "SHOW_404" => $arParams["SHOW_404"],
    "FILE_404" => $arParams["FILE_404"],
    "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
    "CACHE_TIME" => $arParams["CACHE_TIME"],
    "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
    "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
    "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
    "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
    "CHECK_DATES" => $arParams["CHECK_DATES"]
), $component);?>