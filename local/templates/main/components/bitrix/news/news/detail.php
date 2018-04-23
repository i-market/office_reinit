<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$itemId = $APPLICATION->IncludeComponent("bitrix:news.detail", "", Array(
    "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
    "DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
    "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
    "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
    "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
    "META_KEYWORDS" => $arParams["META_KEYWORDS"],
    "META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
    "BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
    "SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
    "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
    "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
    "SET_TITLE" => $arParams["SET_TITLE"],
    "MESSAGE_404" => $arParams["MESSAGE_404"],
    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
    "SHOW_404" => $arParams["SHOW_404"],
    "FILE_404" => $arParams["FILE_404"],
    "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
    "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
    "ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
    "CACHE_TIME" => $arParams["CACHE_TIME"],
    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
    "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
    "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
    "DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
    "DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
    "PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
    "PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
    "CHECK_DATES" => $arParams["CHECK_DATES"],
    "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
    "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
    "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
    "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
    "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
    "USE_SHARE" => $arParams["USE_SHARE"],
    "SHARE_HIDE" => $arParams["SHARE_HIDE"],
    "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
    "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
    "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
    "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
    "ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
    'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
), $component);
$APPLICATION->IncludeComponent("bitrix:news.list", "news_index", Array(
    "IBLOCK_TYPE" => "content",
    "IBLOCK_ID" => "1",
    "NEWS_COUNT" => "3",
    "SORT_BY1" => "ACTIVE_FROM",
    "SORT_ORDER1" => "DESC",
    "CHECK_DATES" => "Y",
    "AJAX_MODE" => "N",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "36000000",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "SET_TITLE" => "N"
), false, Array("HIDE_ICONS"=>"Y"));?>
<div class="modal" id="leave_comment">
    <div class="block">
        <span class="close">×</span>
        <strong>оставьте свой комментарий</strong>
        <form class="ajaxform" data-type="json">
            <input type="hidden" name="mode" value="commentNews">
            <input type="hidden" name="id" value="<?=$itemId?>">
            <div class="line">
                <span class="text">Имя<sup>*</sup></span>
                <label>
                    <input type="text" name="name" value="<?=$USER->GetFullName()?>" required>
                    <span class="allert_text">заполните поле</span>
                </label>
            </div>
            <div class="line">
                <span class="text">E-Mail<sup>*</sup></span>
                <label>
                    <input type="text" name="email" value="<?=$USER->GetEmail()?>" required>
                    <span class="allert_text">заполните поле</span>
                </label>
            </div>
            <div class="line">
                <textarea placeholder="СООБЩЕНИЕ" name="message" required></textarea>
            </div>
            <div class="text-align_center">
                <div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_KEY?>"></div>
            </div>
            <div class="line status">
                <div class="allert">
                    <span class="allert_text"></span>
                </div>
            </div>
            <button class="square_button">
                <span>Поделиться</span>
            </button>
        </form>
    </div>
</div>