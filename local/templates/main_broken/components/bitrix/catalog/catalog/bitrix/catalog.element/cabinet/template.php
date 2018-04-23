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
    <div class="wrap">
        <div class="wrap_tab_links">
            <div class="tab_links">
                <span data-tabLinks="products">Готовые изделия</span>
                <?if($arResult["ITEMS"]["complect"]):?>
                    <span data-tabLinks="complect">Комплектующие</span>
                <?endif?>
                <?if($arResult["ITEMS"]["dopoborud"]):?>
                    <span data-tabLinks="dopoborud">Доп. оборудование</span>
                <?endif?>
                <?if($arResult["VARIANTS"]):?>
                    <span data-tabLinks="variants">Расстановки</span>
                <?endif?>
                <?if($arResult["DESCRIPTION"]):?>
                    <span data-tabLinks="description">Описание</span>
                <?endif?>
                <?if($arResult["PROJECTS"]):?>
                    <span data-tabLinks="projects">Проекты</span>
                <?endif?>
            </div>
        </div>
        <div class="tab_blocks">
            <div data-tabContent="products">
                <div class="filterContainer">
                    <div class="category-btns filterBlock">
                        <?foreach($arResult["CATEGORIES"] as $categoryCode=>$arCategory):
                            if(!isset($arResult["CATEGORY_LIST"][$categoryCode]))
                                continue;?>
                            <span class="category-btn" data-category="<?=$arCategory["CODE"]?>">
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
                            <div class="col col_3 category-item <?=$categoryCode?> <?=implode(" ", $arItem["COLOR_LIST"])?>" data-id="<?=$itemId?>">
                                <?=itemCard($arItem)?>
                           </div>
                        <?endforeach;
                    endforeach?>
                </div>

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
                                                </div>
                                            </div>
                                        <?endforeach?>
                                    </div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?endforeach?>
                </div>
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
                                </div>
                            </div>
                        </div>
                    <?endif?>
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
        </div>
    </div>
</section>