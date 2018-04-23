<?
function getStatus($itemId) {
    $arItem = CIBlockElement::GetList(
        array(),
        array(
            "IBLOCK_ID"=>IB_OFFERS,
            "ID"=>$itemId
        ), false,
        array("nTopCount"=>"1"),
        array(
            "ID",
            "IBLOCK_ID",
            "PROPERTY_COUNT_STOCK",
            "PROPERTY_COUNT_COLLECT",
            "PROPERTY_COUNT_FREE",
            "PROPERTY_COUNT_TRANSIT"
        )
    )->Fetch();

    if($arItem["PROPERTY_COUNT_STOCK_VALUE"] > 0):
        $arResult["На складе"] = $arItem["PROPERTY_COUNT_STOCK_VALUE"];

        if($arItem["PROPERTY_COUNT_FREE_VALUE"] > 0):
            $arResult["Свободно"] = $arItem["PROPERTY_COUNT_FREE_VALUE"];
        endif;
    else:
        if($arItem["PROPERTY_COUNT_FREE_VALUE"] == 0 && $arItem["PROPERTY_COUNT_COLLECT_VALUE"] == 0 && $arItem["PROPERTY_COUNT_TRANSIT_VALUE"] == 0):
            $arResult["Свободно"] = $arItem["PROPERTY_COUNT_FREE_VALUE"];
            $arResult["На складе"] = $arItem["PROPERTY_COUNT_STOCK_VALUE"];
        endif;
    endif;

    if($arItem["PROPERTY_COUNT_COLLECT_VALUE"] > 0)
        $arResult["Можно собрать"] = $arItem["PROPERTY_COUNT_COLLECT_VALUE"];

    if($arItem["PROPERTY_COUNT_TRANSIT_VALUE"] > 0)
        $arResult["В пути"] = $arItem["PROPERTY_COUNT_TRANSIT_VALUE"];
    return $arResult;
}
function MakeNewNavUrl($arAdd) {
   return "?".http_build_query($arAdd, '', '&amp;');
}
function cleanArray(array $array, array $symbols = array(''))
{
    return array_diff($array, $symbols);
}
function productsCount($numberof)
{
    $suffix = array(' товар', ' товара', ' товаров');
    $numberof = abs($numberof);
    $keys = array(2, 0, 1, 1, 1, 2);
    $mod = $numberof % 100;
    $suffix_key = $mod > 4 && $mod < 20 ? 2 : $keys[min($mod%10, 5)];

    return $numberof . $suffix[$suffix_key];
}
function getCartCount($returnString = false){
    $count = intVal(CSaleBasket::GetList(Array(), Array("FUSER_ID"=>CSaleBasket::GetBasketUserID(), "ORDER_ID"=>"NULL"), Array()));
    return $returnString ? productsCount($count) : $count;
}
function getPropValueId($propertyCode, $value) {
    $arElement = new CIBlockElement;
    switch($propertyCode):
        case "BASE":
            $iblockId = IB_CONFIG_BASE;
            break;
        case "PLASTIK":
            $iblockId = IB_CONFIG_PLASTIK;
            break;
        case "ARMREST":
            $iblockId = IB_CONFIG_ARMREST;
            break;
        case "MECHANISM":
            $iblockId = IB_CONFIG_MECHANISM;
            break;
        case "UPHOLSTERY":
            $iblockId = IB_CONFIG_UPHOLSTERY;
            break;
        case "UPHOLSTERY_COLOR":
            $iblockId = IB_CONFIG_UPHOLSTERY_COLOR;
            break;
        case "MESH_COLOR":
            $iblockId = IB_CONFIG_MESH;
            break;
        default:
            break;
    endswitch;
    $arItem = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>$iblockId, "CODE"=>$value), false, Array("nTopCount"=>"1"), Array("ID"))->fetch();

    return $arItem ? $arItem["ID"] : false;
}
function getCode($name, $max = 50) {
    return CUtil::translit($name, "ru", Array(
       "max_len" => 100,
       "change_case" => 'L',
       "replace_space" => '_',
       "replace_other" => '_',
       "delete_repeat_replace" => true
    ));
}
function getPhoto($photoId, $size = Array(), $type = false) {
    if($photoId):
        $photo = array_change_key_case(CFile::ResizeImageGet($photoId,
            array("width" => $size[0], "height" => $size[1]),
            $type == true ? BX_RESIZE_IMAGE_EXACT : BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        ), CASE_UPPER);
        $photo["ORIGINAL"] = CFile::GetPath($photoId);
    else:
        $photo = Array(
            "ORIGINAL" => false,
            "SRC" => LOCK_IMAGE,
            "WIDTH" => "354",
            "HEIGHT" => "234"
        );
    endif;

    return $photo;
}
function getColor($colorName, $brandId, $required = true) {
    if(!$colorName || !$brandId)
        return false;

    $arColor = CIBlockElement::GetList(
        Array(),
        Array(
            "IBLOCK_ID"=>IB_COLORS,
            "NAME"=>$colorName,
            "PROPERTY_BRAND"=>$brandId
        ),
        false,
        Array("nTopCount"=>"1"),
        Array("ID")
    )->Fetch();

    if(!$arColor && $required):
        $arElement = new CIBlockElement;
        $arColor["ID"] = $arElement->Add(Array(
            "IBLOCK_ID" => IB_COLORS,
            "NAME" => $colorName,
            "PROPERTY_VALUES" => Array("BRAND"=>$brandId)
        ));
    endif;

    return $arColor["ID"] ? $arColor["ID"] : false;
}
function getUpholsteryColor($colorName, $upholsteryId) {
    if(!$colorName || !$upholsteryId)
        return false;

    $arColor = CIBlockElement::GetList(
        Array(),
        Array(
            "IBLOCK_ID"=>IB_CONFIG_UPHOLSTERY_COLOR,
            "NAME"=>$colorName,
            "PROPERTY_TYPE"=>$upholsteryId
        ),
        false,
        Array("nTopCount"=>"1"),
        Array("ID")
    )->Fetch();

    if(!$arColor):
        $arElement = new CIBlockElement;
        $arColor["ID"] = $arElement->Add(Array(
            "IBLOCK_ID" => IB_CONFIG_UPHOLSTERY_COLOR,
            "NAME" => $colorName,
            "PROPERTY_VALUES" => Array("TYPE"=>$upholsteryId)
        ), false);
    endif;

    return $arColor["ID"] ? $arColor["ID"] : false;
}
function getOption($propCode) {
    return COption::GetOptionString("askaron.settings", $propCode);
}

function checkCaptcha() {
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/lib/recaptchalib.php");

    if(!$_REQUEST["g-recaptcha-response"])
        return false;

    $response = null;
    $reCaptcha = new ReCaptcha(RECAPTCHA_SECRET);
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_REQUEST["g-recaptcha-response"]
    );
    return $response != null && $response->success;
}
function exitJson($arResult) {
    $GLOBALS["APPLICATION"]->RestartBuffer();
    header('Content-Type: application/json');
    echo Bitrix\Main\Web\Json::encode($arResult);
    die();
}
function getPrice($itemId) {
    $arPrice = CCatalogProduct::GetOptimalPrice($itemId, 1, $GLOBALS["USER"]->GetUserGroupArray(), 'N');
    if(!$arPrice || !isset($arPrice['PRICE']))
        return false;

    return Array(
        "BASE_PRICE" => $arPrice["RESULT_PRICE"]["BASE_PRICE"],
        "PRICE" => $arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"],
        "DISCOUNT" => $arPrice["RESULT_PRICE"]["DISCOUNT"],
        "DISCOUNT_PERCENT" => $arPrice["RESULT_PRICE"]["PERCENT"],
        "REAL_PRICE" => $arPrice["PRICE"]["PRICE"],
        "OPTIMAL_PRICE" => $arPrice
    );
}
function encode($string) {
    return iconv('cp866', 'utf-8', $string);
}
function utf($string) {
    return iconv('cp1251', 'utf-8', $string);
}
function getString($string) {
    return $string;
}
function dump($array) {
    return Bitrix\Main\Diag\Debug::dump($array);
}
function itemCard($arItem) {
    $arItem["ID"] = $itemId = $arItem["ITEM"]["ID"];
    $singleOffer = count($arItem["OFFERS"]) === 1;
    $first = true;
    $category = $arItem["ITEM"]["PROPERTY_CATEGORY_XML_ID"] ? getCode($arItem["ITEM"]["PROPERTY_CATEGORY_XML_ID"]) : "empty-cat";
    $kreslo = $category == "kreslo";
    $colorCheck = in_array($arItem["MAIN_COLOR"]["CODE"], $arItem["COLOR_LIST"]);
    if($kreslo):
        $colorCheck = false;
    endif;
    $component = new CBitrixComponent;
    $arButtons = CIBlock::GetPanelButtons(
        IB_CATALOG,
        $arItem["ID"],
        0,
        array("SECTION_BUTTONS"=>false, "SESSID"=>false)
    );
    $arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
    $arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
    $component->addEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID(IB_CATALOG, "ELEMENT_EDIT"));

    $arItem["EDIT_ID"] = $component->getEditAreaId($arItem["ID"]);
    if ($arItem["CLASS"]):?>
        <div class="<?=" {$arItem["CLASS"]}"?>" data-id="<?=$arItem["ID"]?>">
    <?endif?>
    <div class="prof_catalog_box" id="<?=$arItem["EDIT_ID"]?>">
=======
    $arItem["EDIT_ID"] = $component->getEditAreaId($arItem["ID"]);?>
    <div class="prof_catalog_box<?=" {$arItem["CLASS"]}"?>" id="<?=$arItem["EDIT_ID"]?>">
>>>>>>> 2020d39ddc92cf8d659a5119c36dfa42f9fc7adf
        <?if($arItem["MODAL"]):?>
            <span class="close">×</span>
        <?endif;

        foreach($arItem["OFFERS"] as $offerId=>$arOffer):
            $arStatus = getStatus($offerId);
            $arButtons = CIBlock::GetPanelButtons(
                IB_OFFERS,
                $offerId,
                0,
                array("SECTION_BUTTONS"=>false, "SESSID"=>false)
            );
            $arOffer["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
            $arOffer["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
            $component->addEditAction($offerId, $arOffer["EDIT_LINK"], CIBlock::GetArrayByID(IB_OFFERS, "ELEMENT_EDIT"));
            $arOffer["EDIT_ID"] = $component->getEditAreaId($offerId);

            $mainColors = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLORS, "PROPERTY_COLORS"=>Array($arOffer["COLOR"]["ID"])), false, false, Array("ID", "IBLOCK_ID", "NAME"));
            $offerColorCode = $arOffer["COLOR"]["CODE"];
            while($mainColor = $mainColors->Fetch())
                 $offerColorCode .= " ".getCode($mainColor["NAME"]);

            if($colorCheck)
                $first = $arItem["MAIN_COLOR"]["CODE"] == $arOffer["COLOR"]["CODE"] || in_array($arOffer["COLOR"]["ID"], $arItem["MAIN_COLOR"]["PROPERTY_COLORS_VALUE"]);?>
            <div id="<?=$arOffer["EDIT_ID"]?>" class="offer <?=$offerColorCode?><?if(!$first):?> hide<?endif?>" data-offer="<?=$offerId?>">
                <div class="img">
                    <?if($arOffer["PICTURE"]["ORIGINAL"]):?>
                        <a href="<?=$arOffer["PICTURE"]["ORIGINAL"]?>" class="fancy">
                            <img src="<?=$arOffer["PICTURE"]["SRC"]?>" alt="<?=$arOffer["NAME"]?>">
                        </a>
                    <?else:?>
                        <img src="<?=$arOffer["PICTURE"]["SRC"]?>" alt="<?=$arOffer["NAME"]?>">
                    <?endif?>
                </div>

                <p class="title"  style="position: relative">
                    <a name="offer_<?=$offerId?>" class="tooltip number" title="<?=$arOffer["NAME"]?>">
                        <?=$arOffer["NAME"]?>
                    </a>
                </p>

                <div class="good_info">
                    <div class="left">
                        <p>
                            <span class="name">Артикул</span>
                            <span id="tooltip_<?=$arOffer["ID"]?>" class="number tooltip" title="<?=$arOffer["PROPERTY_ARTICUL_VALUE"]?>&lt;br&gt;&lt;a href='javascript:' class='copy' data-id='tooltip_<?=$arOffer["ID"]?>' &gt;скопировать артикул в буфер обмена&lt;/a&gt;"><?=$arOffer["PROPERTY_ARTICUL_VALUE"]?></span>
                        </p>
                        <?if(!$kreslo):?>
                            <div class="the_size">
                                <span class="size_text">Размер</span>
                                <div class="description">
                                    <select class="offer_size"<?if($singleOffer || count($arItem["SIZES"]) === 1 ):?> disabled<?endif?>>
                                        <?if($singleOffer):?>
                                            <option value="<?=$arOffer["SIZE"]?>" selected><?=$arOffer["SIZE"]?></option>
                                        <?else:
                                            foreach($arItem["SIZES"] as $size=>$arOffers):
                                                $offer_id = "";
                                                foreach($arOffers as $offer_Id=>$arOfferId)
                                                    $offer_id = $arOfferId;?>
                                                 <option value="<?=$offer_id?>"<?if(in_array($offerId, $arOffers)):?> selected<?endif?>><?=$size?></option>
                                            <?endforeach;
                                        endif?>
                                    </select>
                                </div>
                            </div>
                        <?endif?>
                        <p>
                            <span class="name">Цвет</span>
                            <?if($singleOffer):
                                $mainColors = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLORS, "PROPERTY_COLORS"=>Array($arOffer["COLOR"]["ID"])), false, false, Array("ID", "IBLOCK_ID", "NAME"));
                                $offerColorCode = $arOffer["COLOR"]["CODE"];
                                while($mainColor = $mainColors->Fetch())
                                    $offerColorCode .= " ".getCode($mainColor["NAME"]);

                                $arColor = $arOffer["COLOR"]?>
                                <button class="color-check <?=$offerColorCode?><?=$arOffer["COLOR"]["ID"] == $arColor["ID"] ? " active" : ""?>"
                                       title="<?=$arColor["NAME"]?>"
                                       style="<?=$arColor["PICTURE"] ? "background: url({$arColor["PICTURE"]}) no-repeat" : "background-color: #eee; opacity: 0.3"?>"
                                       data-offer="<?=$arOffer["ID"]?>"
                                ></button>
                            <?else:
                                foreach($arItem["COLORS"] as $size=>$arSize)
                                    foreach($arSize as $colorId=>$arColor):
                                        if(!$arItem["COLORS_OFFERS"][$size][$colorId])
                                            continue;
                                        $mainColors = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLORS, "PROPERTY_COLORS"=>Array($arColor["ID"])), false, false, Array("ID", "IBLOCK_ID", "NAME"));
                                        $offerColorCode = $arColor["CODE"];
                                        while($mainColor = $mainColors->Fetch())
                                            $offerColorCode .= " ".getCode($mainColor["NAME"]);?>
                                        <button class="color-check <?=$offerColorCode?><?=$arOffer["COLOR"]["ID"] == $arColor["ID"] ? " active" : ""?>"
                                               title="<?=$arColor["NAME"]?>"
                                               style="<?=$arColor["PICTURE"] ? "background: url({$arColor["PICTURE"]}) no-repeat" : "background-color: #eee; opacity: 0.3"?>"
                                               data-offer="<?=$arItem["COLORS_OFFERS"][$arOffer["SIZE"]][$colorId]?>"
                                        ></button>
                                    <?endforeach;
                            endif?>
                        </p>
                    </div>
                    <div class="right">
                        <p>
                            <span>Вес</span>
                            <span><?=$arOffer["PROPERTY_WEIGHT_VALUE"]?></span>
                        </p>
                        <?if($kreslo):?>
                            <p>
                                <span>Размер</span>
                                <span><?=$arOffer["PROPERTY_SIZE_VALUE"]?></span>
                            </p>
                        <?endif?>
                        <p>
                            <span>Объем</span>
                            <span><?=$arOffer["PROPERTY_DIMENSION_VALUE"]?></span>
                        </p>
                    </div>
                </div>

                <div class="how_many">
                    <div class="left">
                    <?$statusCount = 0;
                    foreach($arStatus as $statusText=>$statusValue):
                        if(++$statusCount == 3):?>
                            </div>
                            <div class="right">
                        <?endif;?>
                        <p>
                            <span><?=$statusText?></span>
                            <span><?=intVal($statusValue)?></span>
                        </p>
                    <?endforeach?>
                    </div>
                </div>

                <div class="input-number" min="0" max="100">
                    <button type="button" class="input-number-decrement" data-decrement></button>
                    <input type="text" value="0" class="quantity" data-id="<?=$offerId?>">
                    <button type="button" class="input-number-increment" data-increment></button>
                </div>

                <div class="price">
                    <div class="left">
                        <p class="euro"><?=intVal($arOffer["PRICE"]["REAL_PRICE"])?></p>
                        <p class="rouble"><?=$arOffer["PRICE"]["PRICE"]?> руб.</p>
                    </div>
                    <div class="right">
                        <button class="square_button square_button--green buy" data-id="<?=$offerId?>">
                            <span>Заказать</span>
                        </button>
                    </div>
                </div>
            </div>
            <?$first = false;
        endforeach?>
    </div>
    <?if($arItem["CLASS"]):?>
        </div>
    <?endif?>
<?}
