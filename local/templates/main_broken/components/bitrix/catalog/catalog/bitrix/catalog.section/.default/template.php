<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();
if($arResult["DETAIL_PICTURE"]):?>
    <section class="banner">
        <div class="wrap">
            <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
        </div>
    </section>
<?endif?>
<section class="wrap_title">
    <div class="wrap_min">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "")?>
    </div>
</section>
<section class="sub_title_text">
    <div class="wrap_small">
        <p>
            <?=$arResult["DESCRIPTION"]?>
        </p>
    </div>
</section>
<section class="prof_razdel_catalog">
    <div class="wrap_min">
        <div class="grid">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <div class="col col_3 actions_box actions_box--catalog" id="<?=$arItem["EDIT_AREA_ID"]?>">
                    <div class="img">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
                            <img src="<?=$arItem["PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">
                        </a>
                    </div>
                    <div class="info">
                        <div class="left">
                            <p class="title">
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></a>
                            </p>
                            <p class="text">
                                <?=$arItem["PROPERTIES"]["MINI_TEXT"]["VALUE"]?>
                                <?//=$arItem["DISPLAY_PROPERTIES"]["BRAND"]["DISPLAY_VALUE"]?>
                            </p>
                        </div>

                        <div class="right">
                            <div class="price">
                                <?if($arItem["PROPERTIES"]["PRICE"]["VALUE"]):?>
                                    <span class="euro"><?=intVal($arItem["PRICE"]["EUR"])?></span><br>
                                    <span class="rouble"><?=intVal($arItem["PRICE"]["RUB"])?> руб.</span>
                                <?endif?>
                            </div>
                        </div>
                    </div>
                </div>
            <?endforeach?>
        </div>
    </div>
</section>

<?if($arResult["SIMILAR"]):?>
    <section class="some_class_item">
        <div class="wrap_min">
            <div class="grid">
                <?foreach($arResult["SIMILAR"] as $arSection):?>
                    <div class="col col_4 item">
                        <p class="title"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></p>
                        <?if($arSection["PICTURE"]):?>
                            <div class="img">
                                <a href="<?=$arSection["SECTION_PAGE_URL"]?>">
                                    <img src="<?=$arSection["PICTURE"]["SRC"]?>" alt="<?=$arSection["NAME"]?>">
                                </a>
                            </div>
                        <?endif?>
                        <ul>
                            <?foreach($arSection["ITEMS"] as $arItem):?>
                                <li>
                                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></a>
                                </li>
                            <?endforeach?>
                        </ul>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </section>
<?endif?>