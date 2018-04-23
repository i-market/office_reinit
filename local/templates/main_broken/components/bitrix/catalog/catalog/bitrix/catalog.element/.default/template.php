<<<<<<< HEAD
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$arProperties = $arResult["PROPERTIES"];?>
<section class="prof_proizvoditeli prof_proizvoditeli_kabinet">
    <div class="wrap">
        <div class="hidden_slider_box">
            <?$counter = 0;
            foreach($arResult["MAIN_VARIANT"]["ITEMS"] as $offerId=>$arOffer):
                itemCard(Array(
                    "CLASS" => " number-".$counter++,
                    "MODAL" => true,
                    "OFFERS" => Array(
                        $offerId=>$arOffer
                    )
                ));
            endforeach?>
        </div>
        <div class="wrap_prof_slider_kabinet">
            <div class="prof_slider_main_kabinet">
                <?if($arResult["MAIN_VARIANT"]):
                    $arItem = $arResult["MAIN_VARIANT"];?>
                    <div class="slide">
                        <img src="<?=CFile::GetPath($arItem["PROPERTY_PICTURE_VALUE"])?>" alt="<?=$arResult["NAME"]?>">
                        <div class="title_line">
                            <?$fullUrl = "/";
                            foreach($arResult["PATH"] as $url=>$text):
                                $fullUrl .= $url."/"?>
                                <a class="item link" href="<?=$fullUrl?>"><?=$text?></a>
                            <?endforeach?>
                            <span class="item name"><?=$arResult["NAME"]?></span>
                        </div>
                        <div class="kit_includes">
                            <?if($arItem["PROPERTY_COMPLECT_TEXT_VALUE"]):?>
                                <p class="title active">В комплект входят:</p>
                                <p class="text" style="display: block"><?=$arItem["PROPERTY_COMPLECT_TEXT_VALUE"]?></p>
                            <?endif?>
                            <div class="price">
                                <div class="left">
                                    <span class="rouble"><?=$arItem["PRICE"]["RUB"]?> руб.</span>
                                </div>
                                <div class="right">
                                    <span class="euro"><?=intVal($arItem["PRICE"]["EUR"])?></span>
                                </div>
                            </div>
                            <button class="square_button square_button--reverse show-complect" data-complect="<?=$arItem["ID"]?>">
                                <span>в корзину</span>
                            </button>
                        </div>
                        <?foreach($arItem["PROPERTY_POINTS_VALUE"] as $key=>$arItem):
                            $coords = explode(",", $arItem);?>
                            <span class="coordinates" style="left:<?=$coords[0]?>%; top:<?=$coords[1]?>%" data-item="number-<?=$key?>"></span>
                        <?endforeach?>
                    </div>
                <?endif?>
                <?foreach($arResult["IMAGES"] as $arPhoto):?>
                    <div class="slide">
                        <img src="<?=$arPhoto["SRC"]?>" alt="<?=$arResult["NAME"]?>">
                        <div class="title_line">
                            <?$fullUrl = "/";
                            foreach($arResult["PATH"] as $url=>$text):
                                $fullUrl .= $url."/"?>
                                <a class="item link" href="<?=$fullUrl?>"><?=$text?></a>
                            <?endforeach?>
                            <span class="item name"><?=$arResult["NAME"]?></span>
                        </div>
                    </div>
                <?endforeach?>
            </div>
            <?if($arResult["THUMBS"]):?>
                <div class="dots"></div>
                <div class="wrap_prof_slider_thums_kabinet">
                    <span class="arrow prev"></span>
                    <div class="prof_slider_thums_kabinet">
                        <?foreach($arResult["THUMBS"] as $arThumb):?>
                            <div class="slide" style="background: url('<?=$arThumb["SRC"]?>')no-repeat center center / cover"></div>
                        <?endforeach?>
                    </div>
                    <span class="arrow next"></span>
                </div>
            <?endif?>
        </div>
    </div>
</section>

<section class="prof_kabinet_tabs">
=======
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();
$this->setFrameMode(true);
$arProperties = $arResult["PROPERTIES"];?>
<section class="wrap_title wrap_title--pages">
    <div class="wrap_min">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "")?>
    </div>
</section>

<section class="catalog_slider_section">
    <div class="wrap">
        <div class="wrap_slider_section wrap_slider_section_main">
            <div class="wrap_thumbs_slider_section wrap_thumbs_slider_section_main">
                <?if($arResult["MEDIA"]):?>
                    <span class="arrows prev"></span>
                    <div class="thumbs_slider_section thumbs_slider_section_main">
                        <?foreach($arResult["MEDIA"] as $arMedia):?>
                            <div class="slide">
                                <div class="img<?=$arMedia["TYPE"] == "video" ? " video" : ""?>">
                                    <img src="<?=$arMedia["THUMB"]?>" alt="<?=$arMedia["DESCRIPTION"]?>">
                                </div>
                            </div>
                        <?endforeach?>
                    </div>
                    <span class="arrows next"></span>
                    <div class="dots"></div>
                <?endif?>
            </div>
            <div class="wrap_main_slider_section">
                <?if($arResult["MEDIA"]):?>
                    <div class="slider_section slider_section_main">
                        <?foreach($arResult["MEDIA"] as $arMedia):?>
                            <div class="slide">
                                <div class="img<?=$arMedia["TYPE"] == "video" ? " video" : ""?>">
                                    <a<?=$arMedia["TYPE"] == "video" ? " data-fancybox" : ' class="gallery"'?> href="<?=$arMedia["ORIGINAL"]?>" title="<?=$arMedia["DESCRIPTION"]?>">
                                        <img src="<?=$arMedia["SRC"]?>" alt="<?=$arMedia["DESCRIPTION"]?>">
                                    </a>
                                </div>
                            </div>
                        <?endforeach?>
                    </div>
                <?endif?>
                <div class="labels">
                    <?foreach($arProperties["LABELS"]["VALUE"] as $fileId):?>
                        <img src="<?=CFile::GetPath($fileId)?>" alt="">
                    <?endforeach?>
                </div>
            </div>
        </div>
        <?if($arItem = $arResult["MAIN_ITEM"]):?>
            <?$first = true;
            $singleOffer = count($arItem["OFFERS"]) === 1;
            foreach($arItem["OFFERS"] as $offerId=>$arOffer):?>
                <div class="info_slider_section offer<?if(!$first):?> hide<?endif; $first = false;?>" data-offer="<?=$offerId?>">
                    <div class="text">
                        <?=$arItem["PREVIEW_TEXT"] ? $arItem["PREVIEW_TEXT"] : $arItem["NAME"]?>
                    </div>
                    <div class="good_info">
                        <div class="left">
                            <p>
                                <span class="name">Артикул</span>
                                <span class="number"><?=$arOffer["PROPERTY_ARTICUL_VALUE"]?></span>
                            </p>
                            <p>
                                <span class="name">Цвет</span>
                                <?if($singleOffer):
                                    $arColor = $arOffer["COLOR"]?>
                                    <button class="color-check <?=$arColor["CODE"]?><?=$arOffer["COLOR"]["CODE"] == $arColor["CODE"] ? " active" : ""?>"
                                           title="<?=$arColor["NAME"]?>"
                                           style="<?=$arColor["PICTURE"] ? "background: url({$arColor["PICTURE"]}) no-repeat" : "background-color: #eee; opacity: 0.3"?>"
                                           data-offer="<?=$offerId?>"
                                    ></button>
                                <?else:
                                    foreach($arItem["COLORS"][$arOffer["SIZE"]] as $colorId=>$arColor):?>
                                        <button class="color-check <?=$arColor["CODE"]?><?=$arOffer["COLOR"]["CODE"] == $arColor["CODE"] ? " active" : ""?>"
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
                                <span><?=$arOffer["PROPERTY_WEIGHT_VALUE"]?> кг</span>
                            </p>
                            <p>
                                <span>Размер</span>
                                <span><?=$arOffer["PROPERTY_SIZE_VALUE"]?></span>
                            </p>
                            <p>
                                <span>Объем</span>
                                <span><?=$arOffer["PROPERTY_DIMENSION_VALUE"]?></span>
                            </p>
                        </div>
                    </div>
                    <div class="how_many">
                        <div class="left">
                            <p>
                                <span>На складе</span>
                                <span><?=intVal($arOffer["PROPERTY_COUNT_STOCK_VALUE"])?></span>
                            </p>
                            <p>
                                <span>Свободно</span>
                                <span><?=intVal($arOffer["PROPERTY_COUNT_FREE_VALUE"])?></span>
                            </p>
                        </div>
                        <div class="right">
                            <p>
                                <span>Можно собрать</span>
                                <span><?=intVal($arOffer["PROPERTY_COUNT_COLLECT_VALUE"])?></span>
                            </p>
                            <p>
                                <span>В пути</span>
                                <span><?=intVal($arOffer["PROPERTY_COUNT_TRANSIT_VALUE"])?></span>
                            </p>
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
            <?endforeach?>
        <?endif?>
    </div>
</section>

<section class="prof_catalog_tabs">
>>>>>>> 2020d39ddc92cf8d659a5119c36dfa42f9fc7adf
    <div class="wrap">
        <div class="wrap_tab_links">
            <div class="tab_links">
                <span data-tabLinks="products">Готовые изделия</span>
<<<<<<< HEAD
                <?if($arResult["ITEMS"]["complect"]):?>
                    <span data-tabLinks="complect">Комплектующие</span>
                <?endif?>
                <?if($arResult["ITEMS"]["dopoborud"]):?>
                    <span data-tabLinks="dopoborud">Доп. оборудование</span>
                <?endif?>
                <?if($arResult["VARIANTS"]):?>
                    <span data-tabLinks="variants">Расстановки</span>
=======
                <span data-tabLinks="configurator">Собрать свой вариант</span>

                <?if($arResult["ITEMS"]["Аксессуары"]):?>
                    <span data-tabLinks="acsess">Аксессуары</span>
                <?endif?>
                <?if($arResult["ITEMS"]["Доп. оборудование"]):?>
                    <span data-tabLinks="extra">Доп. оборудование</span>
>>>>>>> 2020d39ddc92cf8d659a5119c36dfa42f9fc7adf
                <?endif?>
                <?if($arResult["DESCRIPTION"]):?>
                    <span data-tabLinks="description">Описание</span>
                <?endif?>
<<<<<<< HEAD
=======
                <?if(
                    $arProperties["FILE_PHOTOS"]["VALUE"] ||
                    $arProperties["FILE_3D"]["VALUE"] ||
                    $arProperties["FILE_PRESENTATION"]["VALUE"] ||
                    $arProperties["FILE_SCHEME"]["VALUE"] ||
                    $arProperties["FILE_MATERIALS"]["VALUE"]
                ):?>
                    <span data-tabLinks="files">Скачать</span>
                <?endif?>
>>>>>>> 2020d39ddc92cf8d659a5119c36dfa42f9fc7adf
                <?if($arResult["PROJECTS"]):?>
                    <span data-tabLinks="projects">Проекты</span>
                <?endif?>
            </div>
        </div>
        <div class="tab_blocks">
            <div data-tabContent="products">
<<<<<<< HEAD
                <div class="filterContainer">
                    <div class="category-btns filterBlock">
                        <?foreach($arResult["CATEGORIES"] as $categoryCode=>$arCategory):
                            if(!isset($arResult["CATEGORY_LIST"][$categoryCode]))
                                continue;?>
                            <span class="category-btn" data-category="<?=$categoryCode?>">
                                <img src="<?=$arCategory["PICTURE"]?>" alt="<?=$arCategory["NAME"]?>">
                                <span class="text"><?=$arCategory["NAME"]?></span>
                            </span>
                        <?endforeach?>
                        <div class="wrap-clearFilter">
                            <div class="clearFilter cfb">сбросить</div>
                        </div>
                    </div>
                    <div class="category-colors filterBlock" data-clear="true">
                        <?foreach($arResult["COLORS"] as $arColor):?>
                            <span class="category-color <?=implode(" ", $arResult["COLOR_CATEGORIES"][$arColor["ID"]])?>" data-color="<?=$arColor["CODE"]?>">
                                <?if($arColor["PICTURE"]):?>
                                    <img src="<?=$arColor["PICTURE"]?>" alt="<?=$arColor["NAME"]?>" title="<?=$arColor["NAME"]?>">
                                <?else:?>
                                    <i title="<?=$arColor["NAME"]?>"><?=$arColor["NAME"]?></i>
                                <?endif?>
                            </span>
                        <?endforeach?>
                        <div class="wrap-clearColorsFilter">
                            <div class="clearColorsFilter cfb">сбросить</div>
                        </div>
                    </div>
                </div>
                <div class="grid category-items">
                    <?$arAccessories = Array(
                        "akses",
                        "complect",
                        "dopoborud"
                    );
                    foreach($arResult["ITEMS"] as $categoryCode=>$arItems):
                        if(in_array($categoryCode, $arAccessories))
                            continue;
                        foreach($arItems as $itemId=>$arItem):

                            $arItem["MAIN_COLOR"] = $arResult["MAIN_COLOR"];?>
=======
                <div class="grid">
                    <?foreach($arResult["ITEMS"] as $categoryCode=>$arItems):
                        foreach($arItems as $itemId=>$arItem):?>
>>>>>>> 2020d39ddc92cf8d659a5119c36dfa42f9fc7adf
                            <div class="col col_3 category-item <?=$categoryCode?> <?=implode(" ", $arItem["COLOR_LIST"])?>" data-id="<?=$itemId?>">
                                <?=itemCard($arItem)?>
                           </div>
                        <?endforeach;
                    endforeach?>
                </div>
<<<<<<< HEAD

                <?if($arResult["RECOMMENDED"]):?>
                    <div class="gray_section">
                        <div class="wrap">
                            <div class="wrap_min">
                                <h4>список рекомендуемых товаров</h4>
                            </div>
                            <div class="grid">
                                <?foreach($arResult["RECOMMENDED"]["ITEMS"] as $itemId=>$arItem):
                                    $arItem["CLASS"] = " col col_3";
                                    itemCard($arItem);
                                endforeach?>
                           </div>
                        </div>
                    </div>
                <?endif?>

                <?if($arResult["SIMILAR"]):?>
                    <div class="similar_models">
                        <div class="wrap_min">
                            <h4>похожие модели</h4>
                        </div>
                        <div class="grid">;
                            <?foreach($arResult["SIMILAR"] as $arItem):?>
                                <div class="col col_3 actions_box">
                                    <div class="img">
                                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                            <img src="<?=$arItem["PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">
                                        </a>
                                    </div>
                                    <p class="title"><?=$arItem["NAME"]?></p>
                                    <p class="text"><?=$arItem["PROPERTY_MINI_TEXT_VALUE"]?></p>
                                    <div class="price">
                                        <span class="rouble"><?=intVal($arItem["PRICE"]["RUB"])?> руб.</span>
                                        <span class="euro"><?=intVal($arItem["PRICE"]["EUR"])?></span>
                                    </div>
                                </div>
                            <?endforeach?>
                        </div>
                    </div>
                <?endif?>
            </div>

            <?if($arResult["ITEMS"]["complect"]):?>
                <div data-tabContent="complect">
                    <div class="grid">
                        <?foreach($arResult["ITEMS"]["complect"] as $arItem):
                            $arItem["CLASS"] = " col col_3";
                            itemCard($arItem);
                        endforeach?>
                    </div>
                </div>
            <?endif?>

            <?if($arResult["ITEMS"]["dopoborud"]):?>
                <div data-tabContent="dopoborud">
                    <div class="grid">
                        <?foreach($arResult["ITEMS"]["dopoborud"] as $arItem):
                            $arItem["CLASS"] = " col col_3";
                            itemCard($arItem);
                        endforeach?>
                    </div>
                </div>
            <?endif?>

            <?if($arResult["VARIANTS"]):?>
                <div data-tabContent="variants" class="description_block">
                    <div class="grid description_grid">
                        <?foreach($arResult["VARIANTS"] as $key=>$arVariant):?>
                            <div class="col col_3 actions_box actions_box--news">
                                <div class="img hiddenItem" data-hiddenItem="hiddenBox<?=$key?>">
                                    <img src="<?=$arVariant["PICTURE"]["SRC"]?>" alt="<?=$arVariant["NAME"]?>">
                                </div>
                                <p class="title hiddenItem" data-hiddenItem="hiddenBox<?=$key?>"><?=$arVariant["NAME"]?></p>
                                <p class="text"><?=$arVariant["PREVIEW_TEXT"]?></p>
                                <div class="price">
                                    <div class="left">
                                        <span class="rouble"><?=$arVariant["PRICE"]["RUB"]?> руб.</span>
                                        <span class="euro"><?=intVal($arVariant["PRICE"]["EUR"])?></span>
                                    </div>
                                    <div class="right">
                                        <button type="button" class="square_button--reverse square_button">
                                            <span>В корзину</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?endforeach?>
                    </div>

                    <?foreach($arResult["VARIANTS"] as $key=>$arVariant):?>
                        <div class="hidden_box hiddenBox<?=$key?>">
                            <div class="close">×</div>
                            <div class="composition">
                                <div class="img" style="background: url('<?=$arVariant["PICTURE"]["ORIGINAL"]?>')no-repeat center center / cover"></div>
                                <div class="info">
                                    <div class="title"><?=$arVariant["NAME"]?></div>
                                    <div class="text"><?=$arVariant["DETAIL_TEXT"]?></div>
                                    <div class="inner">
                                        <?foreach($arVariant["ITEMS"] as $key=>$arItem):?>
                                            <div class="item">
                                                <div class="left">
                                                    <div class="item_text"><?=$arItem["NAME"]?></div>
                                                    <div class="amount"><?=$arItem["COUNT"]?></div>
                                                </div>
                                                <div class="right">
                                                    <div class="price">
                                                        <p class="euro"><?=$arItem["SUM"]["EUR"]?></p>
                                                        <p class="rouble"><?=$arItem["SUM"]["RUB"]?> руб.</p>
                                                    </div>
=======
            </div>
            <div data-tabContent="configurator">
                <div class="catalog_slider_section configurator">
                    <?$first = 1;
                    foreach($arResult["CONFIGURATOR"] as $offerId=>$arConfig):
                        $arOffer = $arConfig["OFFER"];
                        $arOfferProperties = $arConfig["PROPERTIES"]?>
                        <div class="wrap_small configuration<?if($first): unset($first); echo " active"; endif?>" data-offer="<?=$offerId?>">
                            <div class="wrap_slider_section wrap_slider_section_tabs">
                                <div class="img">
                                    <a class="gallery" href="<?=$arOffer["PICTURE"]["ORIGINAL"] ? $arOffer["PICTURE"]["ORIGINAL"] : $arOffer["PICTURE"]["SRC"]?>">
                                        <img src="<?=$arOffer["PICTURE"]["SRC"]?>" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="info_slider_section info_slider_section_tabs">
                                <div class="line">
                                    <div class="wrap_line_lr">
                                        <div class="line_left">Цвет пластиковых частей</div>
                                        <div class="line_right">
                                            <div class="selected_color <?=$arOfferProperties["PLASTIK"]["VALUE"]["CODE"]?>" title="<?=$arOfferProperties["PLASTIK"]["VALUE"]["VALUE"]?>"></div>
                                        </div>
                                    </div>
                                    <div class="line_hidden_block">
                                        <?foreach($arResult["CONFIG"]["PLASTIK"] as $value=>$valueId):
                                            if(!$arOfferProperties["PLASTIK"]["OTHER"][$valueId])
                                                continue?>
                                            <div class="change-configuration choose-color line_hidden_block_item<?if($arOfferProperties["PLASTIK"]["VALUE"]["ID"] == $valueId):?> selected<?endif?>" data-offer="<?=$arOfferProperties["PLASTIK"]["OTHER"][$valueId]["OFFER_ID"]?>" data-bg="<?=$arOfferProperties["PLASTIK"]["OTHER"][$valueId]["CODE"]?>">
                                                <div class="circle <?=$arOfferProperties["PLASTIK"]["OTHER"][$valueId]["CODE"]?>"></div>
                                                <div class="text"><?=$value?></div>
                                            </div>
                                        <?endforeach?>
                                    </div>
                                </div>

                                <div class="line">
                                    <div class="wrap_line_lr">
                                        <div class="line_left">Подголовник</div>
                                        <div class="line_right">
                                            <div class="selected_text"><?=$arOfferProperties["HEADREST"]["VALUE"]["SELECTED_TEXT"]?></div>
                                        </div>
                                    </div>
                                    <?$hide = count($arOfferProperties["HEADREST"]["OTHER"]) == 1 &&
                                              isset($arOfferProperties["HEADREST"]["OTHER"][$arOfferProperties["HEADREST"]["VALUE"]["ID"]]);
                                    if(!$hide):?>
                                        <div class="line_hidden_block">
                                            <?foreach($arResult["CONFIG"]["HEADREST"] as $value=>$valueId):
                                                if(!$arOfferProperties["HEADREST"]["OTHER"][$valueId] || $arOfferProperties["HEADREST"]["VALUE"]["ID"] == $valueId)
                                                    continue?>
                                                    <div class="change-configuration line_hidden_block_btn line_hidden_block_item<?if($arOfferProperties["HEADREST"]["VALUE"]["ID"] == $valueId):?> selected<?endif?>" data-offer="<?=$arOfferProperties["HEADREST"]["OTHER"][$valueId]["OFFER_ID"]?>">
                                                        <?=$arOfferProperties["HEADREST"]["OTHER"][$valueId]["TEXT"]?>
                                                    </div>
                                            <?endforeach?>
                                        </div>
                                    <?endif?>
                                </div>
                                <div class="line">
                                    <div class="wrap_line_lr">
                                        <div class="line_left">Вешалка</div>
                                        <div class="line_right">
                                            <div class="selected_text"><?=$arOfferProperties["HANGER"]["VALUE"]["SELECTED_TEXT"]?></div>
                                        </div>
                                    </div>
                                    <?$hide = count($arOfferProperties["HANGER"]["OTHER"]) == 1 &&
                                              isset($arOfferProperties["HANGER"]["OTHER"][$arOfferProperties["HANGER"]["VALUE"]["VALUE"]]);
                                    if(!$hide):?>
                                        <div class="line_hidden_block">
                                            <?foreach($arResult["CONFIG"]["HANGER"] as $value=>$valueId):
                                                if(!$arOfferProperties["HANGER"]["OTHER"][$valueId] || $arOfferProperties["HANGER"]["VALUE"]["ID"] == $valueId)
                                                    continue?>
                                                    <div class="change-configuration line_hidden_block_btn line_hidden_block_item<?if($arOfferProperties["HANGER"]["VALUE"]["ID"] == $valueId):?> selected<?endif?>" data-offer="<?=$arOfferProperties["HANGER"]["OTHER"][$valueId]["OFFER_ID"]?>">
                                                        <?=$arOfferProperties["HANGER"]["OTHER"][$valueId]["TEXT"]?>
                                                    </div>
                                            <?endforeach?>
                                        </div>
                                    <?endif?>
                                </div>
                                <div class="line">
                                    <div class="wrap_line_lr">
                                        <div class="line_left">Подлокотники
                                            <?if($arOfferProperties["ARMREST"]["TOOLTIP"]):?>
                                                <span class="tooltip" title="<?=$arOfferProperties["ARMREST"]["TOOLTIP"]?>">i</span>
                                            <?endif?>
                                        </div>
                                        <div class="line_right">
                                            <div class="selected_text"><?=$arOfferProperties["ARMREST"]["VALUE"]["VALUE"]?></div>
                                        </div>
                                    </div>
                                    <div class="line_hidden_block">
                                        <?foreach($arOfferProperties["ARMREST"]["OTHER"] as $valueId=>$value):?>
                                            <div class="change-configuration line_hidden_block_item<?if($arOfferProperties["ARMREST"]["VALUE"]["ID"] == $valueId):?> selected<?endif?>" data-offer="<?=$arOfferProperties["ARMREST"]["OTHER"][$valueId]["OFFER_ID"]?>">
                                                <div class="line_picture_item">
                                                    <div class="img">
                                                        <img src="<?=$value["PICTURE"]["SRC"]?>" alt="">
                                                    </div>
                                                    <div class="text"><?=$value["VALUE"]?></div>
                                                    <?if($value["TOOLTIP"]):?>
                                                        <span class="tooltip" title="<?=$value["TOOLTIP"]?>">i</span>
                                                    <?endif?>
                                                </div>
                                            </div>
                                        <?endforeach?>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="wrap_line_lr">
                                        <div class="line_left">Механизм
                                            <?if($arOfferProperties["MECHANISM"]["TOOLTIP"]):?>
                                                <span class="tooltip" title="<?=$arOfferProperties["MECHANISM"]["TOOLTIP"]?>">i</span>
                                            <?endif?>
                                        </div>
                                        <div class="line_right">
                                            <div class="selected_text"><?=$arOfferProperties["MECHANISM"]["VALUE"]["VALUE"]?></div>
                                        </div>
                                    </div>
                                    <div class="line_hidden_block">
                                        <?foreach($arOfferProperties["MECHANISM"]["OTHER"] as $valueId=>$value):?>
                                            <div class="change-configuration line_hidden_block_item<?if($arOfferProperties["MECHANISM"]["VALUE"]["ID"] == $valueId):?> selected<?endif?>" data-offer="<?=$arOfferProperties["MECHANISM"]["OTHER"][$valueId]["OFFER_ID"]?>">
                                                <div class="line_picture_item">
                                                    <div class="img">
                                                        <img src="<?=$value["PICTURE"]["SRC"]?>" alt="">
                                                    </div>
                                                    <div class="text"><?=$value["VALUE"]?></div>
                                                    <?if($value["TOOLTIP"]):?>
                                                        <span class="tooltip" title="<?=$value["TOOLTIP"]?>">i</span>
                                                    <?endif?>
                                                </div>
                                            </div>
                                        <?endforeach?>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="wrap_line_lr">
                                        <div class="line_left">Обивка
                                            <?if($arOfferProperties["UPHOLSTERY"]["TOOLTIP"]):?>
                                                <span class="tooltip" title="<?=$arOfferProperties["UPHOLSTERY"]["TOOLTIP"]?>">i</span>
                                            <?endif?>
                                        </div>
                                        <div class="line_right">
                                            <div class="selected_text"><?=$arOfferProperties["UPHOLSTERY"]["VALUE"]["VALUE"]?></div>
                                        </div>
                                    </div>
                                    <div class="line_hidden_block">
                                        <?foreach($arOfferProperties["UPHOLSTERY"]["OTHER"] as $valueId=>$value):?>
                                            <div class="change-configuration line_hidden_block_item<?if($arOfferProperties["UPHOLSTERY"]["VALUE"]["ID"] == $valueId):?> selected<?endif?>" data-offer="<?=$arOfferProperties["UPHOLSTERY"]["OTHER"][$valueId]["OFFER_ID"]?>">
                                                <div class="line_picture_item">
                                                    <div class="img">
                                                        <img src="<?=$value["PICTURE"]["SRC"]?>" alt="">
                                                    </div>
                                                    <div class="text"><?=$value["VALUE"]?></div>
>>>>>>> 2020d39ddc92cf8d659a5119c36dfa42f9fc7adf
                                                </div>
                                            </div>
                                        <?endforeach?>
                                    </div>
<<<<<<< HEAD
                                    <div class="total">
                                        <button type="button" class="square_button--reverse square_button">
                                            <span>В корзину</span>
                                        </button>
                                        <div class="price">
                                            <span class="euro"><?=$arVariant["PRICE"]["EUR"]?></span>
                                            <span class="rouble"><?=$arVariant["PRICE"]["RUB"]?> руб.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="gray_section">
                                <div class="wrap">
                                    <div class="wrap_min">
                                        <h4>товары входящие в композицию</h4>
                                    </div>
                                    <div class="grid">
                                        <?foreach($arVariant["ITEMS"] as $offerId=>$arOffer):
                                            itemCard(Array(
                                                "CLASS" => " col col_3",
                                                "OFFERS" => Array(
                                                    $offerId=>$arOffer
                                                )
                                            ));
                                        endforeach?>
=======
                                </div>
                                <div class="line">
                                    <div class="wrap_line_lr">
                                        <div class="line_left">Цвет обивки</div>
                                        <div class="line_right">
                                            <div class="selected_color" style="background: url(<?=$arOfferProperties["UPHOLSTERY_COLOR"]["VALUE"]["PICTURE"]["SRC"]?>) no-repeat center center / cover" title="<?=$arOfferProperties["UPHOLSTERY_COLOR"]["VALUE"]["VALUE"]?>"></div>
                                        </div>
                                    </div>
                                    <div class="line_hidden_block">
                                        <div class="grid">
                                            <?foreach($arResult["CONFIG"]["UPHOLSTERY_COLOR"] as $value=>$valueId):
                                                if(!$arOfferProperties["UPHOLSTERY_COLOR"]["OTHER"][$valueId])
                                                    continue;?>
                                                <div class="col col_4 change-configuration choose-color line_hidden_block_item<?if($arOfferProperties["UPHOLSTERY_COLOR"]["VALUE"]["ID"] == $valueId):?> selected<?endif?>" data-offer="<?=$arOfferProperties["UPHOLSTERY_COLOR"]["OTHER"][$valueId]["OFFER_ID"]?>">
                                                    <div class="img zoom">
                                                        <img src="<?=$arOfferProperties["UPHOLSTERY_COLOR"]["OTHER"][$valueId]["PICTURE"]["SRC"]?>" alt="">
                                                        <div class="zoom_img">
                                                            <img src="<?=$arOfferProperties["UPHOLSTERY_COLOR"]["OTHER"][$valueId]["PICTURE"]["SRC"]?>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?endforeach?>
                                        </div>
                                    </div>
                                </div>

                                <div class="line">
                                    <div class="wrap_line_lr">
                                        <div class="line_left">База
                                            <?if($arOfferProperties["BASE"]["TOOLTIP"]):?>
                                                <span class="tooltip" title="<?=$arOfferProperties["BASE"]["TOOLTIP"]?>">i</span>
                                            <?endif?>
                                        </div>
                                        <div class="line_right">
                                            <div class="selected_text"><?=$arOfferProperties["BASE"]["VALUE"]["VALUE"]?></div>
                                        </div>
                                    </div>
                                    <div class="line_hidden_block">
                                        <?foreach($arOfferProperties["BASE"]["OTHER"] as $valueId=>$value):?>
                                            <div class="change-configuration line_hidden_block_item<?if($arOfferProperties["BASE"]["VALUE"]["ID"] == $valueId):?> selected<?endif?>" data-offer="<?=$arOfferProperties["BASE"]["OTHER"][$valueId]["OFFER_ID"]?>">
                                                <div class="line_picture_item">
                                                    <div class="img">
                                                        <img src="<?=$value["PICTURE"]["SRC"]?>" alt="">
                                                    </div>
                                                    <div class="text"><?=$value["VALUE"]?></div>
                                                    <?if($value["TOOLTIP"]):?>
                                                        <span class="tooltip" title="<?=$value["TOOLTIP"]?>">i</span>
                                                    <?endif?>
                                                </div>
                                            </div>
                                        <?endforeach?>
                                    </div>
                                </div>

                                <div class="specification">
                                    <p class="title">Cпецификация</p>
                                    <div class="inner">
                                        <p>
                                            <span>Артикул</span>
                                            <span><?=$arOffer["PROPERTY_ARTICUL_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>Вес</span>
                                            <span><?=$arOffer["PROPERTY_WEIGHT_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>Размер</span>
                                            <span><?=$arOffer["PROPERTY_SIZE_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>Объем</span>
                                            <span><?=$arOffer["PROPERTY_DIMENSION_VALUE"]?></span>
                                        </p>
                                    </div>
                                </div>

                                <div class="manufacturing">Изготовление 5 дней</div>

                                <div class="how_many">
                                    <span>
                                        <span>На складе</span>
                                        <span><?=$arOffer["PROPERTY_COUNT_STOCK_VALUE"]?></span>
                                    </span>
                                    <span>
                                        <span>Можно собрать</span>
                                        <span><?=$arOffer["PROPERTY_COUNT_COLLECT_VALUE"]?></span>
                                    </span>
                                </div>
                                <div class="input-number" min="0" max="100">
                                    <button type="button" class="input-number-decrement" data-decrement></button>
                                    <input type="text" value="0" />
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
>>>>>>> 2020d39ddc92cf8d659a5119c36dfa42f9fc7adf
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?endforeach?>
                </div>
<<<<<<< HEAD
            <?endif?>

            <div data-tabContent="description" class="description_block">
                <div class="wrap_min">
                    <?if($arResult["PREVIEW_TEXT"]):?>
                        <div class="mini_description">
                            <?=$arResult["PREVIEW_TEXT"]?>
                        </div>
                    <?endif?>
                    <?if(
                        $arProperties["FILE_PHOTOS"]["VALUE"] ||
                        $arProperties["FILE_3D"]["VALUE"] ||
                        $arProperties["FILE_PRESENTATION"]["VALUE"] ||
                        $arProperties["FILE_SCHEME"]["VALUE"] ||
                        $arProperties["FILE_MATERIALS"]["VALUE"]
                    ):?>
                        <div class="text-block-section">
                            <div class="download_materials">
                                <h4>скачать материалы</h4>
                                <div class="grid">
                                     <?if($arFile = CFile::GetFileArray($arProperties["FILE_PHOTOS"]["VALUE"])):?>
                                        <div class="col col_5 prof_catalog_download_item">
                                            <div class="ico">
                                                <img src="<?=SITE_TEMPLATE_PATH?>/images/download-ico-1.png" alt="">
                                            </div>
                                            <p class="title">
                                                Фотографии
                                            </p>
                                            <div class="bottom">
                                                <div class="size_block">
                                                    <p>
                                                        <span class="size_number"><?=intVal($arFile["FILE_SIZE"] / 1024 / 1024)?></span>
                                                        <span class="size_name">Mb</span>
                                                        /
                                                        <span class="format"><?=GetFileExtension($_SERVER["DOCUMENT_ROOT"].$arFile["SRC"])?></span>
                                                    </p>
                                                    <a class="square_button square_button--green" href="<?=$arFile["SRC"]?>" download>
                                                        <span>скачать</span
                                                    ></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif;

                                    if($arFile = CFile::GetFileArray($arProperties["FILE_3D"]["VALUE"])):?>
                                        <div class="col col_5 prof_catalog_download_item">
                                            <div class="ico">
                                                <img src="<?=SITE_TEMPLATE_PATH?>/images/download-ico-2.png" alt="">
                                            </div>
                                            <p class="title">
                                                3d модели
                                            </p>
                                            <div class="bottom">
                                                <div class="size_block">
                                                    <p>
                                                        <span class="size_number"><?=intVal($arFile["FILE_SIZE"] / 1024 / 1024)?></span>
                                                        <span class="size_name">Mb</span>
                                                        /
                                                        <span class="format"><?=GetFileExtension($_SERVER["DOCUMENT_ROOT"].$arFile["SRC"])?></span>
                                                    </p>
                                                    <a class="square_button square_button--green" href="<?=$arFile["SRC"]?>" download>
                                                        <span>скачать</span
                                                    ></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif;

                                    if($arFile = CFile::GetFileArray($arProperties["FILE_PRESENTATION"]["VALUE"])):?>
                                        <div class="col col_5 prof_catalog_download_item">
                                            <div class="ico">
                                                <img src="<?=SITE_TEMPLATE_PATH?>/images/download-ico-3.png" alt="">
                                            </div>
                                            <p class="title">
                                                презентация
                                            </p>
                                            <div class="bottom">
                                                <div class="size_block">
                                                    <p>
                                                        <span class="size_number"><?=intVal($arFile["FILE_SIZE"] / 1024 / 1024)?></span>
                                                        <span class="size_name">Mb</span>
                                                        /
                                                        <span class="format"><?=GetFileExtension($_SERVER["DOCUMENT_ROOT"].$arFile["SRC"])?></span>
                                                    </p>
                                                    <a class="square_button square_button--green" href="<?=$arFile["SRC"]?>" download>
                                                        <span>скачать</span
                                                    ></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif;

                                    if($arFile = CFile::GetFileArray($arProperties["FILE_PRESENTATION"]["VALUE"])):?>
                                        <div class="col col_5 prof_catalog_download_item">
                                            <div class="ico">
                                                <img src="<?=SITE_TEMPLATE_PATH?>/images/download-ico-4.png" alt="">
                                            </div>
                                            <p class="title">
                                                Схема сборки
                                            </p>
                                            <div class="bottom">
                                                <div class="size_block">
                                                    <p>
                                                        <span class="size_number"><?=intVal($arFile["FILE_SIZE"] / 1024 / 1024)?></span>
                                                        <span class="size_name">Mb</span>
                                                        /
                                                        <span class="format"><?=GetFileExtension($_SERVER["DOCUMENT_ROOT"].$arFile["SRC"])?></span>
                                                    </p>
                                                    <a class="square_button square_button--green" href="<?=$arFile["SRC"]?>" download>
                                                        <span>скачать</span
                                                    ></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif;

                                    if($arFile = CFile::GetFileArray($arProperties["FILE_MATERIALS"]["VALUE"])):?>
                                        <div class="col col_5 prof_catalog_download_item">
                                            <div class="ico">
                                                <img src="<?=SITE_TEMPLATE_PATH?>/images/download-ico-5.png" alt="">
                                            </div>
                                            <p class="title">
                                                Материалы
                                            </p>
                                            <div class="bottom">
                                                <div class="size_block">
                                                    <p>
                                                        <span class="size_number"><?=intVal($arFile["FILE_SIZE"] / 1024 / 1024)?></span>
                                                        <span class="size_name">Mb</span>
                                                        /
                                                        <span class="format"><?=GetFileExtension($_SERVER["DOCUMENT_ROOT"].$arFile["SRC"])?></span>
                                                    </p>
                                                    <a class="square_button square_button--green" href="<?=$arFile["SRC"]?>" download>
                                                        <span>скачать</span
                                                    ></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif?>
=======
            </div>
            <div data-tabContent="acsess">
                <div class="grid">
                </div>
            </div>
            <div data-tabContent="extra">
                <div class="grid">
                </div>
            </div>
            <div data-tabContent="description">
                <div class="description">
                    <?foreach($arResult["DESCRIPTION"] as $arDescription):?>
                        <?=$arDescription["CONTENT"]?>
                    <?endforeach?>
                </div>
            </div>
            <div data-tabContent="files">
                <div class="grid">
                    <?if($arFile = CFile::GetFileArray($arProperties["FILE_PHOTOS"]["VALUE"])):?>
                        <div class="col col_5 prof_catalog_download_item">
                            <div class="ico">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/download-ico-1.png" alt="">
                            </div>
                            <p class="title">
                                Фотографии
                            </p>
                            <div class="bottom">
                                <div class="size_block">
                                    <p>
                                        <span class="size_number"><?=intVal($arFile["FILE_SIZE"] / 1024 / 1024)?></span>
                                        <span class="size_name">Mb</span>
                                        /
                                        <span class="format"><?=GetFileExtension($_SERVER["DOCUMENT_ROOT"].$arFile["SRC"])?></span>
                                    </p>
                                    <a class="square_button square_button--green" href="<?=$arFile["SRC"]?>" download>
                                        <span>скачать</span
                                    ></a>
                                </div>
                            </div>
                        </div>
                    <?endif;

                    if($arFile = CFile::GetFileArray($arProperties["FILE_3D"]["VALUE"])):?>
                        <div class="col col_5 prof_catalog_download_item">
                            <div class="ico">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/download-ico-2.png" alt="">
                            </div>
                            <p class="title">
                                3d модели
                            </p>
                            <div class="bottom">
                                <div class="size_block">
                                    <p>
                                        <span class="size_number"><?=intVal($arFile["FILE_SIZE"] / 1024 / 1024)?></span>
                                        <span class="size_name">Mb</span>
                                        /
                                        <span class="format"><?=GetFileExtension($_SERVER["DOCUMENT_ROOT"].$arFile["SRC"])?></span>
                                    </p>
                                    <a class="square_button square_button--green" href="<?=$arFile["SRC"]?>" download>
                                        <span>скачать</span
                                    ></a>
                                </div>
                            </div>
                        </div>
                    <?endif;

                    if($arFile = CFile::GetFileArray($arProperties["FILE_PRESENTATION"]["VALUE"])):?>
                        <div class="col col_5 prof_catalog_download_item">
                            <div class="ico">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/download-ico-3.png" alt="">
                            </div>
                            <p class="title">
                                презентация
                            </p>
                            <div class="bottom">
                                <div class="size_block">
                                    <p>
                                        <span class="size_number"><?=intVal($arFile["FILE_SIZE"] / 1024 / 1024)?></span>
                                        <span class="size_name">Mb</span>
                                        /
                                        <span class="format"><?=GetFileExtension($_SERVER["DOCUMENT_ROOT"].$arFile["SRC"])?></span>
                                    </p>
                                    <a class="square_button square_button--green" href="<?=$arFile["SRC"]?>" download>
                                        <span>скачать</span
                                    ></a>
                                </div>
                            </div>
                        </div>
                    <?endif;

                    if($arFile = CFile::GetFileArray($arProperties["FILE_PRESENTATION"]["VALUE"])):?>
                        <div class="col col_5 prof_catalog_download_item">
                            <div class="ico">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/download-ico-4.png" alt="">
                            </div>
                            <p class="title">
                                Схема сборки
                            </p>
                            <div class="bottom">
                                <div class="size_block">
                                    <p>
                                        <span class="size_number"><?=intVal($arFile["FILE_SIZE"] / 1024 / 1024)?></span>
                                        <span class="size_name">Mb</span>
                                        /
                                        <span class="format"><?=GetFileExtension($_SERVER["DOCUMENT_ROOT"].$arFile["SRC"])?></span>
                                    </p>
                                    <a class="square_button square_button--green" href="<?=$arFile["SRC"]?>" download>
                                        <span>скачать</span
                                    ></a>
                                </div>
                            </div>
                        </div>
                    <?endif;

                    if($arFile = CFile::GetFileArray($arProperties["FILE_MATERIALS"]["VALUE"])):?>
                        <div class="col col_5 prof_catalog_download_item">
                            <div class="ico">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/download-ico-5.png" alt="">
                            </div>
                            <p class="title">
                                Материалы
                            </p>
                            <div class="bottom">
                                <div class="size_block">
                                    <p>
                                        <span class="size_number"><?=intVal($arFile["FILE_SIZE"] / 1024 / 1024)?></span>
                                        <span class="size_name">Mb</span>
                                        /
                                        <span class="format"><?=GetFileExtension($_SERVER["DOCUMENT_ROOT"].$arFile["SRC"])?></span>
                                    </p>
                                    <a class="square_button square_button--green" href="<?=$arFile["SRC"]?>" download>
                                        <span>скачать</span
                                    ></a>
>>>>>>> 2020d39ddc92cf8d659a5119c36dfa42f9fc7adf
                                </div>
                            </div>
                        </div>
                    <?endif?>
<<<<<<< HEAD
                    <?foreach($arResult["DESCRIPTION"] as $arDescription):?>
                        <div class="inner_wrap">
                            <?=$arDescription["CONTENT"]?>
                        </div>
                    <?endforeach?>
                </div>
            </div>

            <?if($arResult["PROJECTS"]):?>
                <div data-tabContent="projects">
                    <div class="grid">
                        <?foreach($arResult["PROJECTS"] as $arProject):?>
                            <div class="col col_3 project_box">
                                <div class="img">
                                    <a href="<?=$arProject["DETAIL_PAGE_URL"]?>">
                                        <img src="<?=$arProject["PICTURE"]["SRC"]?>" alt="">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="inner">
                                        <a href="<?=$arProject["DETAIL_PAGE_URL"]?>" class="title"><?=$arProject["NAME"]?></a>
                                        <p class="name">
                                            <a href="<?=$arProject["DETAIL_PAGE_URL"]?>"><?=$arProject["NAME"]?></a>
                                        </p>
                                        <p class="comments">комментарии
                                            <span class="comments_number">0</span>
                                        </p>
                                    </div>
                                    <?/*<div class="rating">4.5</div>*/?>
                                </div>
                            </div>
                        <?endforeach?>
                    </div>
                </div>
            <?endif?>
=======
                </div>
            </div>

            <div data-tabContent="projects">
                <div class="grid">
                    <?foreach($arResult["PROJECTS"] as $arProject):?>
                        <div class="col col_3 project_box">
                            <div class="img">
                                <a href="<?=$arProject["DETAIL_PAGE_URL"]?>">
                                    <img src="<?=$arProject["PICTURE"]["SRC"]?>" alt="">
                                </a>
                            </div>
                            <div class="info">
                                <div class="inner">
                                    <a href="<?=$arProject["DETAIL_PAGE_URL"]?>" class="title"><?=$arProject["NAME"]?></a>
                                    <p class="name">
                                        <a href="<?=$arProject["DETAIL_PAGE_URL"]?>"><?=$arProject["NAME"]?></a>
                                    </p>
                                    <p class="comments">комментарии
                                        <span class="comments_number">0</span>
                                    </p>
                                </div>
                                <?/*<div class="rating">4.5</div>*/?>
                            </div>
                        </div>
                    <?endforeach?>
                </div>
            </div>
>>>>>>> 2020d39ddc92cf8d659a5119c36dfa42f9fc7adf
        </div>
    </div>
</section>