<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinksExt = array();
$arIblock = CIBlock::GetById(IB_COLLECTIONS)->fetch();
if(defined("BX_COMP_MANAGED_CACHE"))
    $GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_".$arIblock["ID"]);

$aMenuLinksExt = $APPLICATION->IncludeComponent("i-market:menu.mix", "", array(
    "IS_SEF" => "Y",
    "SEF_BASE_URL" => "",
    "SECTION_PAGE_URL" => $arIblock['SECTION_PAGE_URL'],
    "DETAIL_PAGE_URL" => $arIblock['DETAIL_PAGE_URL'],
    "IBLOCK_TYPE" => $arIblock['IBLOCK_TYPE_ID'],
    "IBLOCK_ID" => $arIblock['ID'],
    "DEPTH_LEVEL" => "3",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "360000"
), false, Array('HIDE_ICONS' => 'Y'));

if(defined("BX_COMP_MANAGED_CACHE"))
    $GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_new");

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);?>