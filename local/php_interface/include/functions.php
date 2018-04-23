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
function getDescription($descriptionId) {
    $arDescription = CIBlockElement::GetList(
        Array(),
        Array(
            "IBLOCK_ID"=>IB_DESCRIPTIONS,
            "=ID"=>$descriptionId
        ),
        false,
        Array("nTopCount"=>"1"),
        Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_BLOCKS")
    )->Fetch();
    $arDescriptionsBlocks = CIBlockElement::GetList(
        Array(),
        Array(
            "IBLOCK_ID"=>IB_DESCRIPTIONS_BLOCKS,
            "ID"=>$arDescription["PROPERTY_BLOCKS_VALUE"]
        ),
        false,
        Array("nTopCount"=>"100"),
        Array(
            "ID",
            "NAME",
            "IBLOCK_ID",
            "PREVIEW_PICTURE",
            "DETAIL_PICTURE",
            "DETAIL_TEXT",
            "DETAIL_TEXT_TYPE",
            "PROPERTY_IMAGES",
            "PROPERTY_TYPE",
            "PREVIEW_TEXT",
            "PREVIEW_TEXT_TYPE",
            "PROPERTY_LINE_POSITION",
            "PROPERTY_LINE_HEIGHT",
            "PROPERTY_MATERIALS",
            "PROPERTY_POINTS",
            "PROPERTY_POINTS_CONTENT",
            "PROPERTY_TABLE",
            "PROPERTY_CONTENT_WIDTH"
        )
    );
    $component = new CBitrixComponent;
    while($arDescriptionBlock = $arDescriptionsBlocks->Fetch()):
        $arButtons = CIBlock::GetPanelButtons(
            IB_DESCRIPTIONS_BLOCKS,
            $arDescriptionBlock["ID"],
            0,
            array("SECTION_BUTTONS"=>false, "SESSID"=>false)
        );
        $component->addEditAction(
            $arDescriptionBlock["ID"],
            $arButtons["edit"]["edit_element"]["ACTION_URL"],
            CIBlock::GetArrayByID(IB_DESCRIPTIONS_BLOCKS, "ELEMENT_EDIT")
        );
        $arDescriptionBlock["EDIT_ID"] = $component->getEditAreaId($arDescriptionBlock["ID"]);

        foreach($arDescriptionBlock["PROPERTY_IMAGES_VALUE"] as $key=>$imageId):
            if($key == 0) $arDescriptionBlock["PICTURE"] = getPhoto($imageId);
            $arDescriptionBlock["IMAGES"][] = getPhoto($imageId);
        endforeach;

        $grayLinePosition = intVal($arDescriptionBlock["PROPERTY_LINE_POSITION_VALUE"]);
        $grayLineHeight = intVal($arDescriptionBlock["PROPERTY_LINE_HEIGHT_VALUE"]);
        $grayLineMargin = intVal($grayLineHeight / 2);
        $arTableRows = $arDescriptionBlock["PROPERTY_TABLE_VALUE"];
        if($arDescriptionBlock["PROPERTY_CONTENT_WIDTH_VALUE"]):
            $arDescriptionBlock["CONTENT_MIN_WIDTH"] = (intVal($arDescriptionBlock["PROPERTY_CONTENT_WIDTH_VALUE"]) > 768) ? $arDescriptionBlock["PROPERTY_CONTENT_WIDTH_VALUE"] + 24 . "px" : "768px";
            $arDescriptionBlock["PROPERTY_CONTENT_WIDTH_VALUE"] .= substr_count($arDescriptionBlock["PROPERTY_CONTENT_WIDTH_VALUE"], "%") ? "" : "px";
            $arDescriptionBlock["CONTENT_WIDTH"] = "width: calc({$arDescriptionBlock["PROPERTY_CONTENT_WIDTH_VALUE"]} - 24px)";
            $arDescriptionBlock["CONTENT_OTHER_WIDTH"] = "width: calc(100% - ({$arDescriptionBlock["PROPERTY_CONTENT_WIDTH_VALUE"]} + 24px))";
        endif;

        $blockContent = "";

        if($arDescriptionBlock["PREVIEW_TEXT"]):
            if($arDescriptionBlock["PREVIEW_TEXT_TYPE"] == "text")
                $arDescriptionBlock["PREVIEW_TEXT"] = htmlspecialcharsbx($arDescriptionBlock["PREVIEW_TEXT"]);

            //$arDescriptionBlock["PREVIEW_TEXT"] = TxtToHTML($arDescriptionBlock["PREVIEW_TEXT"]);
            $blockContent .= "<p class=\"text-block__paragraph\">{$arDescriptionBlock["PREVIEW_TEXT"]}</p>";
        endif;

        if($arTableRows):
            $blockContent .= "<ul class=\"text-block__list\">";
            foreach($arTableRows as $row=>$value):
                $blockContent .= '<li>
                    <span class="text-block__list-title">'.$value.'</span>
                    <span class="text-block__list-text">'.$arDescriptionBlock["PROPERTY_TABLE_DESCRIPTION"][$row].'</span>
                </li>';
            endforeach;
            $blockContent .= '</ul>';
        endif;

        if($arDescriptionBlock["PROPERTY_MATERIALS_VALUE"]):
            $arDescriptionBlock["MATERIALS"] = array();
            $obMaterialsBlocks = CIBlockElement::GetList(
                Array(),
                Array(
                    "IBLOCK_ID"=>IB_MATERIALS_BLOCKS,
                    "ID"=>$arDescriptionBlock["PROPERTY_MATERIALS_VALUE"]
                ),
                false,
                Array("nTopCount"=>"100"),
                Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_MATERIALS")
            );
            while($arMaterialBlock = $obMaterialsBlocks->Fetch()):
                $arMaterials = CIBlockElement::GetList(
                    Array(),
                    Array(
                        "IBLOCK_ID"=>IB_MATERIALS,
                        "ID"=>$arMaterialBlock["PROPERTY_MATERIALS_VALUE"]
                    ),
                    false,
                    Array("nTopCount"=>"100"),
                    Array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE")
                );
                $arMaterialBlock["MATERIALS"] = array();
                while($arMaterial = $arMaterials->Fetch()):
                    $arMaterial["PICTURE"] = getPhoto($arMaterial["PREVIEW_PICTURE"], Array(94, 94));
                    $arMaterial["LIST"] = '
                        <div class="line_color open-color-modal" title="'.$arMaterial["NAME"].'" data-material="'.$arMaterial["ID"].'">
                            <div class="img">
                                <img src="'.$arMaterial["PICTURE"]["SRC"].'" alt="'.$arMaterial["NAME"].'">
                            </div>
                            <div class="line_color_name">'.$arMaterial["NAME"].'</div>
                        </div>';
                    $arMaterial["MODAL"] = '
                        <div class="slide"
                            data-material="'.$arMaterial["ID"].'"
                            data-src="background: url('.$arMaterial["PICTURE"]["ORIGINAL"].') no-repeat center / cover"
                            data-title="'.TxtToHTML($arMaterialBlock["NAME"]).'"
                            data-text="'.TxtToHTML($arMaterial["PREVIEW_TEXT"]).'">
                            <div class="img" style="background: url('.$arMaterial["PICTURE"]["SRC"].')no-repeat center center / cover"></div>
                            <p>'.$arMaterial["NAME"].'</p>
                        </div>';

                    $arMaterialBlock["MATERIALS"][array_search($arMaterial["ID"], $arMaterialBlock["PROPERTY_MATERIALS_VALUE"])] = $arMaterial;
                endwhile;
                ksort($arMaterialBlock["MATERIALS"]);

                $arDescriptionBlock["MATERIALS"][array_search($arMaterialBlock["ID"], $arDescriptionBlock["PROPERTY_MATERIALS_VALUE"])] = $arMaterialBlock;
            endwhile;

            ksort($arDescriptionBlock["MATERIALS"]);
            $arDescriptionBlock["MATERIAL_OPTIONS"] = "";
            $arDescriptionBlock["MATERIAL_MODALS"] = "";
            $arDescriptionBlock["MATERIAL_LIST"] = "";

            foreach($arDescriptionBlock["MATERIALS"] as $blockId=>$arBlock):
                $arDescriptionBlock["MATERIAL_OPTIONS"] .= "<option value=\"{$arBlock["ID"]}\">{$arBlock["NAME"]}</option>";
                $arDescriptionBlock["MATERIAL_LIST"] .= '<div class="inner'.($blockId == 0 ? " active" : "").'" data-id="color-modal-'.$arBlock["ID"].'">';
                $arDescriptionBlock["MATERIAL_MODALS"] .= '<div class="color-modal" id="color-modal-'.$arBlock["ID"].'">
                                        <p class="color-modal__main-title">Материалы обивки</p>
                                        <span class="color-modal__close"></span>
                                        <div class="color-modal__bg"></div>
                                        <div class="color-modal__inner-info">
                                            <p class="inner-info__title">'.$arBlock["NAME"].'</p>
                                            <p class="inner-info__text">'.$arBlock["PREVIEW_TEXT"].'</p>
                                            <div class="wrap-color-modal-slider">
                                                <div class="color-modal-slider">';

                foreach($arBlock["MATERIALS"] as $arMaterial):
                    $arDescriptionBlock["MATERIAL_LIST"] .= $arMaterial["LIST"];
                    $arDescriptionBlock["MATERIAL_MODALS"] .= $arMaterial["MODAL"];
                endforeach;

                $arDescriptionBlock["MATERIAL_LIST"] .= '</div>';
                $arDescriptionBlock["MATERIAL_MODALS"] .= '
                                </div>
                            <span class="prev">
                                <img src="'.SITE_TEMPLATE_PATH.'/images/arrow-left-green.png" alt="">
                            </span>
                            <span class="next">
                                <img src="'.SITE_TEMPLATE_PATH.'/images/arrow-right-green.png" alt="">
                            </span>
                        </div>
                    </div>
                </div>';
            endforeach;

            $arDescriptionBlock["MATERIALS_CONTENT"] = '
                    <div class="mini_description wrap_min materials" style="margin-bottom: 20px">
                        <div class="line" style="margin-bottom: 0px">
                            <select>'.$arDescriptionBlock["MATERIAL_OPTIONS"].'</select>
                            '.$arDescriptionBlock["MATERIAL_LIST"].'
                        </div>
                        '.$arDescriptionBlock["MATERIAL_MODALS"].'
                    </div>';
        endif;

        switch($arDescriptionBlock["PROPERTY_TYPE_ENUM_ID"]):
            case 58: //bottom
                $arDescriptionBlock["CONTENT"] = '
                    <style>
                        #gray-line-'.$arDescriptionBlock["ID"].':before {
                            height:'.$grayLineHeight.'px;
                            top:'.$grayLinePosition.'%;
                            margin-top: -'.$grayLineMargin.'px;
                        }
                    </style>
                    <div class="text-block-section" id="' . $arDescriptionBlock["EDIT_ID"] . '">
                        <div class="gray-line" id="gray-line-'.$arDescriptionBlock["ID"].'"></div>
                        <div class="wrap_min">
                            <div class="text-block">
                                <div class="text-block__text">
                                    <p class="text-block__title">'.$arDescriptionBlock["NAME"].'</p>
                                    '.$blockContent.'
                                </div>
                                <div class="text-block__img">
                                    <img src="'.$arDescriptionBlock["PICTURE"]["SRC"].'" alt="">
                                </div>
                            </div>
                        </div>
                    </div>';
                break;
            case 59: //left
                $arDescriptionBlock["CONTENT"] = '
                    <style>
                        #gray-line-'.$arDescriptionBlock["ID"].':before {
                            height:'.$grayLineHeight.'px;
                            top:'.$grayLinePosition.'%;
                            margin-top: -'.$grayLineMargin.'px;
                        }
                        @media only screen and (min-width: '.$arDescriptionBlock["CONTENT_MIN_WIDTH"].') {
                            #gray-line-'.$arDescriptionBlock["ID"].' + .wrap_min .text-block__img {
                                '.$arDescriptionBlock["CONTENT_WIDTH"].'
                            }
                            #gray-line-'.$arDescriptionBlock["ID"].' + .wrap_min .text-block__text {
                                '.$arDescriptionBlock["CONTENT_OTHER_WIDTH"].'
                            }
                        }
                    </style>
                    <div class="text-block-section" id="' . $arDescriptionBlock["EDIT_ID"] . '">
                        <div class="gray-line" id="gray-line-'.$arDescriptionBlock["ID"].'"></div>
                        <div class="wrap_min">
                            <div class="text-block">
                                <div class="text-block__text">
                                    <p class="text-block__title">'.$arDescriptionBlock["NAME"].'</p>
                                </div>
                            </div>
                            <div class="text-block text-block--img-left">
                                <div class="text-block__text">'.$blockContent.'</div>
                                <div class="text-block__img">
                                    <img src="'.$arDescriptionBlock["PICTURE"]["SRC"].'" alt="">
                                </div>
                            </div>
                        </div>
                    </div>';
                break;
            case 60: //right
                $arDescriptionBlock["CONTENT"] = '
                    <style>
                        #gray-line-'.$arDescriptionBlock["ID"].':before {
                            height:'.$grayLineHeight.'px;
                            top:'.$grayLinePosition.'%;
                            margin-top:-'.$grayLineMargin.'px;
                        }
                        @media only screen and (min-width: '.$arDescriptionBlock["CONTENT_MIN_WIDTH"].') {
                            #gray-line-'.$arDescriptionBlock["ID"].' + .wrap_min .text-block__img {
                                '.$arDescriptionBlock["CONTENT_OTHER_WIDTH"].'
                            }
                            #gray-line-'.$arDescriptionBlock["ID"].' + .wrap_min .text-block__text {
                                '.$arDescriptionBlock["CONTENT_WIDTH"].'
                            }
                        }
                    </style>
                    <div class="text-block-section" id="' . $arDescriptionBlock["EDIT_ID"] . '">
                        <div class="gray-line" id="gray-line-'.$arDescriptionBlock["ID"].'"></div>
                        <div class="wrap_min">
                            <div class="text-block">
                                <div class="text-block__text">
                                    <p class="text-block__title">'.$arDescriptionBlock["NAME"].'</p>
                                </div>
                            </div>
                            <div class="text-block text-block--img-right">
                                <div class="text-block__text">'.$blockContent.'</div>
                                <div class="text-block__img">
                                    <img src="'.$arDescriptionBlock["PICTURE"]["SRC"].'" alt="">
                                </div>
                            </div>
                        </div>
                    </div>';
                break;
            case 61: //row
                $imageList = '';
                foreach($arDescriptionBlock["IMAGES"] as $arPicture)
                    $imageList .= '
                        <div class="col col_3">
                            <img src="'.$arPicture["SRC"].'" alt="">
                        </div>';

                $arDescriptionBlock["CONTENT"] = '
                    <style>
                        #gray-line-'.$arDescriptionBlock["ID"].':before {
                            height: '.$grayLineHeight.'px;
                            top: '.$grayLinePosition.'%;
                            margin-top: -'.$grayLineMargin.'px;
                        }
                    </style>
                    <div class="text-block-section" id="' . $arDescriptionBlock["EDIT_ID"] . '">
                        <div class="gray-line" id="gray-line-'.$arDescriptionBlock["ID"].'"></div>
                        <div class="wrap_min">
                            <div class="text-block">
                                <div class="text-block__text">
                                    <p class="text-block__title">'.$arDescriptionBlock["NAME"].'</p>
                                    '.$blockContent.'
                                </div>
                                <div class="text-block__img">
                                    <div class="grid">
                                        ' .$imageList . '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                break;
            case 69: //twin
                $imageList = '';
                foreach($arDescriptionBlock["IMAGES"] as $arPicture)
                    $imageList .= '
                        <div class="col">
                            <img src="'.$arPicture["SRC"].'" alt="">
                        </div>';

                $arDescriptionBlock["CONTENT"] = '
                    <style>
                        #gray-line-'.$arDescriptionBlock["ID"].':before {
                            height: '.$grayLineHeight.'px;
                            top: '.$grayLinePosition.'%;
                            margin-top: -'.$grayLineMargin.'px;
                        }
                        @media only screen and (min-width: '.$arDescriptionBlock["CONTENT_MIN_WIDTH"].') {
                            #gray-line-'.$arDescriptionBlock["ID"].' + .wrap_min .grid .col:not(:first-child)                             {
                                '.$arDescriptionBlock["CONTENT_OTHER_WIDTH"].'
                            }
                            #gray-line-'.$arDescriptionBlock["ID"].' + .wrap_min .grid .col:first-child {
                                '.$arDescriptionBlock["CONTENT_WIDTH"].'
                            }
                        }
                    </style>
                    <div class="text-block-section" id="' . $arDescriptionBlock["EDIT_ID"] . '">
                        <div class="gray-line" id="gray-line-'.$arDescriptionBlock["ID"].'"></div>
                        <div class="wrap_min">
                            <div class="text-block">
                                <div class="text-block__text">
                                    <p class="text-block__title">'.$arDescriptionBlock["NAME"].'</p>
                                    ' .$blockContent. '
                                </div>
                                <div class="text-block__img">
                                    <div class="grid">
                                        ' .$imageList . '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                break;
            case 62: // materials
                $arDescriptionBlock["MATERIALS"] = array();
                $obMaterialsBlocks = CIBlockElement::GetList(
                    Array(),
                    Array(
                        "IBLOCK_ID"=>IB_MATERIALS_BLOCKS,
                        "ID"=>$arDescriptionBlock["PROPERTY_MATERIALS_VALUE"]
                    ),
                    false,
                    Array("nTopCount"=>"100"),
                    Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_MATERIALS")
                );
                while($arMaterialBlock = $obMaterialsBlocks->Fetch()):
                    $arMaterials = CIBlockElement::GetList(
                        Array(),
                        Array(
                            "IBLOCK_ID"=>IB_MATERIALS,
                            "ID"=>$arMaterialBlock["PROPERTY_MATERIALS_VALUE"]
                        ),
                        false,
                        Array("nTopCount"=>"100"),
                        Array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE")
                    );
                    $arMaterialBlock["MATERIALS"] = array();
                    while($arMaterial = $arMaterials->Fetch()):
                        $arMaterial["PICTURE"] = getPhoto($arMaterial["PREVIEW_PICTURE"], Array(94, 94));
                        $arMaterial["LIST"] = '
                            <div class="line_color open-color-modal" title="'.$arMaterial["NAME"].'" data-material="'.$arMaterial["ID"].'">
                                <div class="img">
                                    <img src="'.$arMaterial["PICTURE"]["SRC"].'" alt="'.$arMaterial["NAME"].'">
                                </div>
                                <div class="line_color_name">'.$arMaterial["NAME"].'</div>
                            </div>';
                        $arMaterial["MODAL"] = '
                            <div class="slide"
                                data-material="'.$arMaterial["ID"].'"
                                data-src="background: url('.$arMaterial["PICTURE"]["ORIGINAL"].') no-repeat center / cover"
                                data-title="'.TxtToHTML($arMaterialBlock["NAME"]).'"
                                data-text="'.TxtToHTML($arMaterial["PREVIEW_TEXT"]).'">
                                <div class="img" style="background: url('.$arMaterial["PICTURE"]["SRC"].')no-repeat center center / cover"></div>
                                <p>'.$arMaterial["NAME"].'</p>
                            </div>';

                        $arMaterialBlock["MATERIALS"][array_search($arMaterial["ID"], $arMaterialBlock["PROPERTY_MATERIALS_VALUE"])] = $arMaterial;
                    endwhile;
                    ksort($arMaterialBlock["MATERIALS"]);

                    $arDescriptionBlock["MATERIALS"][array_search($arMaterialBlock["ID"], $arDescriptionBlock["PROPERTY_MATERIALS_VALUE"])] = $arMaterialBlock;
                endwhile;

                ksort($arDescriptionBlock["MATERIALS"]);
                $arDescriptionBlock["MATERIAL_OPTIONS"] = "";
                $arDescriptionBlock["MATERIAL_MODALS"] = "";
                $arDescriptionBlock["MATERIAL_LIST"] = "";

                foreach($arDescriptionBlock["MATERIALS"] as $blockId=>$arBlock):
                    $arDescriptionBlock["MATERIAL_OPTIONS"] .= "<option value=\"{$arBlock["ID"]}\">{$arBlock["NAME"]}</option>";
                    $arDescriptionBlock["MATERIAL_LIST"] .= '<div class="inner'.($blockId == 0 ? " active" : "").'" data-id="color-modal-'.$arBlock["ID"].'">';
                    $arDescriptionBlock["MATERIAL_MODALS"] .= '<div class="color-modal" id="color-modal-'.$arBlock["ID"].'">
                                            <p class="color-modal__main-title">Материалы обивки</p>
                                            <span class="color-modal__close"></span>
                                            <div class="color-modal__bg"></div>
                                            <div class="color-modal__inner-info">
                                                <p class="inner-info__title">'.$arBlock["NAME"].'</p>
                                                <p class="inner-info__text">'.$arBlock["PREVIEW_TEXT"].'</p>
                                                <div class="wrap-color-modal-slider">
                                                    <div class="color-modal-slider">';

                    foreach($arBlock["MATERIALS"] as $arMaterial):
                        $arDescriptionBlock["MATERIAL_LIST"] .= $arMaterial["LIST"];
                        $arDescriptionBlock["MATERIAL_MODALS"] .= $arMaterial["MODAL"];
                    endforeach;

                    $arDescriptionBlock["MATERIAL_LIST"] .= '</div>';
                    $arDescriptionBlock["MATERIAL_MODALS"] .= '
                                    </div>
                                <span class="prev">
                                    <img src="'.SITE_TEMPLATE_PATH.'/images/arrow-left-green.png" alt="">
                                </span>
                                <span class="next">
                                    <img src="'.SITE_TEMPLATE_PATH.'/images/arrow-right-green.png" alt="">
                                </span>
                            </div>
                        </div>
                    </div>';
                endforeach;

                $arDescriptionBlock["CONTENT"] = '
                    <div class="mini_description materials" id="'.$arDescriptionBlock["EDIT_ID"].'">
                        <div class="wrap_min width_full">
                            <div class="line">
                                <div class="text-block__title">'.$arDescriptionBlock["NAME"].'</div>
                                <select>'.$arDescriptionBlock["MATERIAL_OPTIONS"].'</select>
                                '.$arDescriptionBlock["MATERIAL_LIST"].'
                            </div>
                            '.$arDescriptionBlock["MATERIAL_MODALS"].'
                        </div>
                    </div>';
                break;
            case 63: //mechanism
                $tooltipPoints = "";
                foreach($arDescriptionBlock["PROPERTY_POINTS_VALUE"] as $key=>$arPoint):
                    $points = explode(",", $arPoint);
                    $tooltipPoints .= '<span class="simple-tooltip tooltips-item" data-tipped-options="inline: '."'".'inline-tooltip-'.$key."'".'" style="left: '.$points[0].'%; top: '.$points[1].'%"></span>';
                endforeach;

                $tooltipContent = "";
                foreach($arDescriptionBlock["PROPERTY_POINTS_CONTENT_VALUE"] as $key=>$arPointContent):
                    $tooltipContent .= '<div id="inline-tooltip-'.$key.'" style="display:none" class="some-item">'.$arPointContent["TEXT"].'</div>';
                endforeach;
                $arPicture = getPhoto($arDescriptionBlock["PREVIEW_PICTURE"]);
                $arDescriptionBlock["CONTENT"] = '
                    <section class="tooltips-section" id="' . $arDescriptionBlock["EDIT_ID"] . '">
                        <div class="wrap_min">
                            <div class="text-block">
                                <div class="text-block__title">'.$arDescriptionBlock["NAME"].'</div>
                                '.$blockContent.'
                            </div>
                            <div class="tooltips-block">
                                '.$tooltipPoints.'
                                <img src="'.$arPicture["SRC"].'" alt="">
                            </div>
                            <div class="tooltip_templates">
                                '.$tooltipContent.'
                            </div>
                        </div>
                    </section>';
                break;
            case 64: //content
                $arPicture = getPhoto($arDescriptionBlock["DETAIL_PICTURE"]);
                if($arDescriptionBlock["PROPERTY_CONTENT_WIDTH_VALUE"])
                    $arDescriptionBlock["CONTENT"] = '
                        <style>
                            @media only screen and (min-width: '.$arDescriptionBlock["CONTENT_MIN_WIDTH"].') {
                                #'.$arDescriptionBlock["EDIT_ID"].' .left {
                                    '.$arDescriptionBlock["CONTENT_WIDTH"].'
                                }
                                #'.$arDescriptionBlock["EDIT_ID"].' .right {
                                    '.$arDescriptionBlock["CONTENT_OTHER_WIDTH"].'
                                }
                            }
                        </style>';
                    else $arDescriptionBlock["CONTENT"] = '';

                if ($arDescriptionBlock["DETAIL_TEXT_TYPE"] == "text")
                    $arDescriptionBlock["DETAIL_TEXT"] = '<p class="text-block__paragraph">'.TxtToHTML($arDescriptionBlock["DETAIL_TEXT"]).'</p>';

                $arDescriptionBlock["CONTENT"] .= '
                    <div class="first wrap_min" id="'.$arDescriptionBlock["EDIT_ID"].'">
                        <div class="width_full">
                            <div class="text-block">
                                <div class="text-block__text">
                                    <p class="text-block__title">'.$arDescriptionBlock["NAME"].'</p>
                                </div>
                            </div>
                        </div>
                        <div class="left">
                            <div class="img">
                                <img src="'.$arPicture["SRC"].'" alt="">
                            </div>
                        </div>
                        <div class="right">
                            '.$blockContent.'
                            '.$arDescriptionBlock["MATERIALS_CONTENT"].'
                            '.$arDescriptionBlock["DETAIL_TEXT"].'
                        </div>
                    </div>';
                break;
            default: break;
        endswitch;
        $arResult[array_search($arDescriptionBlock["ID"], $arDescription["PROPERTY_BLOCKS_VALUE"])] = $arDescriptionBlock;
    endwhile;
    ksort($arResult);
    _c($arResult);
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
    $component = new CBitrixComponent;
    $arItem["ID"] = $itemId = $arItem["ITEM"]["ID"];
    $singleOffer = count($arItem["OFFERS"]) === 1;
    $first = true;
    $category = $arItem["ITEM"]["PROPERTY_CATEGORY_XML_ID"] ? getCode($arItem["ITEM"]["PROPERTY_CATEGORY_XML_ID"]) : "empty-cat";
    $kreslo = $category == "kreslo";
    $colorCheck = in_array($arItem["MAIN_COLOR"]["CODE"], $arItem["COLOR_LIST"]);
    if($kreslo):
        $colorCheck = false;
    endif;
    $arButtons = CIBlock::GetPanelButtons(
        IB_CATALOG,
        $arItem["ID"],
        0,
        array("SECTION_BUTTONS"=>false, "SESSID"=>false)
    );
    $component->addEditAction($arItem["ID"], $arButtons["edit"]["edit_element"]["ACTION_URL"], CIBlock::GetArrayByID(IB_CATALOG, "ELEMENT_EDIT"));
    $arItem["EDIT_ID"] = $component->getEditAreaId($arItem["ID"]);?>
    <div class="col col_3 prof_catalog_box <?=$arItem["CLASS"]?>" id="<?=$arItem["EDIT_ID"]?>" data-id="<?=$arItem["ID"]?>">
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
            $component->addEditAction($offerId, $arButtons["edit"]["edit_element"]["ACTION_URL"], CIBlock::GetArrayByID(IB_OFFERS, "ELEMENT_EDIT"));
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

                <p class="title">
                    <a name="offer_<?=$offerId?>" id="tooltip_name_<?=$arOffer["ID"]?>" class="number tooltip" title="<?=$arOffer["NAME"]?>
                        &lt;br&gt;&lt;a href='javascript:' class='copy' data-id='tooltip_name_<?=$arOffer["ID"]?>' &gt;скопировать название в буфер обмена&lt;/a&gt;">
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
<?}
