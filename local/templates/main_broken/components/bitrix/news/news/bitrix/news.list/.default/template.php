<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);?>
<section class="banner">
    <div class="wrap">
        <img src="<?=SITE_TEMPLATE_PATH?>/images/pic_9.jpg" alt="">
    </div>
</section>
<section class="wrap_title">
    <div class="wrap_min">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "")?>
        <div class="archive">
            <div class="inner">
                <div class="now">
                    <?=$_REQUEST["year"] ? $_REQUEST["year"] . " год" : "Всё"?>
                </div>
                <div class="dd_archive_block">
                    <a class="show_all" href="/about/news/">показать всё</a>
                    <?foreach($arResult["YEARS"] as $year):?>
                        <p class="year">
                            <a href="?year=<?=$year?>"><?=$year?> год</a>
                        </p>
                    <?endforeach?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="news">
    <div class="wrap_min">
        <?if(!$_REQUEST["year"]):
        $arItem = array_shift($arResult["ITEMS"])?>
        <div class="first_news" id="<?=$arItem["EDIT_ID"]?>">
            <div class="img">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <img src="<?=$arItem["PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">
                </a>
            </div>
            <div class="info">
                <p class="date">
                    <?=$arItem["DATE"]?>
                </p>
                <p class="title">
                    <?=$arItem["NAME"]?>
                </p>
                <p class="text">
                    <?=$arItem["PREVIEW_TEXT"] ? $arItem["PREVIEW_TEXT"] : $arItem["DETAIL_TEXT"]?>
                </p>
            </div>
        </div>
        <?endif?>
        <div class="grid">
            <?foreach($arResult["ITEMS" ] as $arItem):?>
                <div class="col col_3 item" id="<?=$arItem["EDIT_ID"]?>">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="img" style="background: url(<?=$arItem["PICTURE"]["SRC"]?>) no-repeat center center / cover"></a>
                    <p class="date"><?=$arItem["DATE"]?></p>
                    <p class="title"><?=$arItem["NAME"]?></p>
                    <a class="link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Посмотреть </a>
                </div>
            <?endforeach?>
        </div>
    </div>
</section>
<?
$navResult = $arResult["NAV_RESULT"];
_c($navResult);
$nav = new \Bitrix\Main\UI\PageNavigation("news");
$nav->allowAllRecords(false)
    ->setPageSize($navResult->NavPageSize)
    ->setRecordCount($navResult->NavRecordCount)
    ->initFromUri();
?>
<?$APPLICATION->IncludeComponent(
   "bitrix:main.pagenavigation",
   "",
   array(
      "NAV_OBJECT" => $nav,
      "SEF_MODE" => "Y",
   ),
   $component
);?>
<?//=$arResult["NAV_STRING"]?>