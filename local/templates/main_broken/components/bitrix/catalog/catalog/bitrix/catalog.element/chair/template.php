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
    <div class="wrap">
        <div class="wrap_tab_links">
            <div class="tab_links">
                <span data-tabLinks="products">Готовые изделия</span>
                <span data-tabLinks="configurator">Собрать свой вариант</span>

                <?if($arResult["ITEMS"]["Аксессуары"]):?>
                    <span data-tabLinks="acsess">Аксессуары</span>
                <?endif?>
                <?if($arResult["ITEMS"]["Доп. оборудование"]):?>
                    <span data-tabLinks="extra">Доп. оборудование</span>
                <?endif?>
                <?if($arResult["DESCRIPTION"]):?>
                    <span data-tabLinks="description">Описание</span>
                <?endif?>
                <?if(
                    $arProperties["FILE_PHOTOS"]["VALUE"] ||
                    $arProperties["FILE_3D"]["VALUE"] ||
                    $arProperties["FILE_PRESENTATION"]["VALUE"] ||
                    $arProperties["FILE_SCHEME"]["VALUE"] ||
                    $arProperties["FILE_MATERIALS"]["VALUE"]
                ):?>
                    <span data-tabLinks="files">Скачать</span>
                <?endif?>
                <?if($arResult["PROJECTS"]):?>
                    <span data-tabLinks="projects">Проекты</span>
                <?endif?>
            </div>
        </div>
        <div class="tab_blocks">
            <div data-tabContent="products">
                <div class="grid">
                    <?foreach($arResult["ITEMS"] as $categoryCode=>$arItems):
                        foreach($arItems as $itemId=>$arItem):?>
                            <div class="col col_3 category-item <?=$categoryCode?> <?=implode(" ", $arItem["COLOR_LIST"])?>" data-id="<?=$itemId?>">
                                <?=itemCard($arItem)?>
                           </div>
                        <?endforeach;
                    endforeach?>
                </div>
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
                                                </div>
                                            </div>
                                        <?endforeach?>
                                    </div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?endforeach?>
                </div>
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
                                </div>
                            </div>
                        </div>
                    <?endif?>
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
        </div>
    </div>
</section>