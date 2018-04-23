<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arResult["NAV"]["RECORD_COUNT"] = $arResult["NavRecordCount"];
$arResult["NAV"]["PAGE_COUNT"] = $arResult["NavPageCount"];
$arResult["NAV"]["PAGE_NUMBER"] = $arResult["NavPageNomer"];
$arResult["NAV"]["PAGE_SIZE"] = $arResult["NavPageSize"];
$arResult["NAV"]["START_PAGE"] = $arResult["nStartPage"];
$arResult["NAV"]["END_PAGE"] = $arResult["nEndPage"];
$arResult["NAV"]["SHOW_ALL_MODE"] = $arResult["NavShowAll"];
$arResult["NAV"]["DO_SHOW_ALL"] = $arResult["bShowAll"];
$arResult["NAV"]["SHOWALL_ID"] = "SHOWALL_".$arResult["NavNum"];

unset($_GET[$arResult["NAV"]["PAGER_ID"] = "PAGEN_".$arResult["NavNum"]]);

$GLOBALS["NAV"]["nav_filename"] = $arResult["sUrlPath"];
$arResult["NavQueryString"] = str_replace('&amp;', '&', $arResult["NavQueryString"]);
parse_str($arResult["NavQueryString"], $GLOBALS["NAV"]["parsed_url"]);
$parsedUrl = array_merge($GLOBALS["NAV"]["parsed_url"], $_GET);

$arResult["NAV"]["URL"]["FIRST_PAGE"] = MakeNewNavUrl(array_merge($parsedUrl, array($arResult["NAV"]["PAGER_ID"]=>"1")));
$arResult["NAV"]["URL"]["PREV_PAGE"] = MakeNewNavUrl(array_merge($parsedUrl, array($arResult["NAV"]["PAGER_ID"]=>$arResult["NAV"]["PAGE_NUMBER"] - 1)));
$arResult["NAV"]["URL"]["LAST_PAGE"] = MakeNewNavUrl(array_merge($parsedUrl, array($arResult["NAV"]["PAGER_ID"]=>$arResult["NAV"]["PAGE_COUNT"])));
$arResult["NAV"]["URL"]["NEXT_PAGE"] = MakeNewNavUrl(array_merge($parsedUrl, array($arResult["NAV"]["PAGER_ID"]=>$arResult["NAV"]["PAGE_NUMBER"] + 1)));
$arResult["NAV"]["URL"]["SHOW_ALL"] = MakeNewNavUrl(array_merge($parsedUrl, array($arResult["NAV"]["SHOWALL_ID"]=>1)));
$arResult["NAV"]["URL"]["SHOW_BY_PAGE"] = MakeNewNavUrl(array_merge($parsedUrl, array($arResult["NAV"]["SHOWALL_ID"]=>0)));

for($i = $arResult["NAV"]["START_PAGE"]; $i <= $arResult["NAV"]["END_PAGE"]; $i++)
    $arResult["NAV"]["URL"]["SOME_PAGE"][$i] = MakeNewNavUrl(array_merge($parsedUrl, array($arResult["NAV"]["PAGER_ID"]=>$i)));