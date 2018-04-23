<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();_c($arResult);
$this->setFrameMode(true);
if($arResult["PICTURE"]):?>
    <section class="banner">
        <div class="wrap">
            <img src="<?=CFile::getPath($arResult["PICTURE"])?>" alt="Проекты" title="Проекты">
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
        <p><?=$arResult["DESCRIPTION"]?></p>
    </div>
</section>
<section class="prolect">
    <div class="wrap">
        <div class="prolect_filters">
            <div class="prolect_filters_wrap">
                <select name="" id="">
                    <option value="">ГОРОД</option>
                    <option value="">Cанкт-Петербург</option>
                    <option value="">Москва</option>
                    <option value="">Cанкт-Петербург</option>
                    <option value="">Cанкт-Петербург</option>
                </select>
                <select name="" id="">
                    <option value="">ПО ЗОНАМ</option>
                    <option value="">Зоны коммуникаций</option>
                    <option value="">Зоны коммуникаций</option>
                    <option value="">Зоны коммуникаций</option>
                </select>
                <select name="" id="">
                    <option value="">ПОСТАВЩИКИ</option>
                    <option value="">alto Mondianollo</option>
                    <option value="">alto Mondianollo</option>
                    <option value="">alto Mondianollo</option>
                </select>
                <select name="" id="">
                    <option value="">ДИЛЛЕР</option>
                    <option value="">Дизайн шайн</option>
                    <option value="">Дизайн шайн</option>
                    <option value="">Дизайн шайн</option>
                </select>
                <select name="" id="">
                    <option value="">ДАТА ДОБАВЛЕНИЯ</option>
                    <option value="">самые новые</option>
                    <option value="">самые новые</option>
                    <option value="">самые новые</option>
                </select>
                <select name="" id="">
                    <option value="">РЕЙТИНГ</option>
                    <option value="">максимальный</option>
                    <option value="">максимальный</option>
                    <option value="">максимальный</option>
                </select>
            </div>
            <div class="wrap_prolect_filters_search_btn">
                <div class="prolect_filters_search_btn search_btn"></div>
                <form class="search_form find_some" method="post">
                    <div class="search_form_main">
                        <button type="submit" class="search_btn"></button>
                        <input type="text" placeholder="поиск по сайту">
                    </div>
                    <div class="search_form_info">
                        <p>
                            кресло Palantin
                        </p>
                        <p>
                            кресло Palantin
                        </p>
                        <p>
                            кресло Palantin
                        </p>
                        <p>
                            кресло Palantin
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="wrap_min">
        <div class="project_items">
            <div class="grid">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <div class="col col_3 project_box">
                        <div class="img">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                <?=CFile::ShowImage($arItem["PREVIEW_PICTURE"]["ID"], 351, 232, "", "", false);?>
                            </a>
                        </div>
                        <div class="info">
                            <div class="inner">
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="title"><?=$arItem["NAME"]?></a>
                                <p class="name">
                                    <a href="javascrtipt:">Дизайн-бюро “<?=$arItem["PROPERTIES"]["COMPANY"]["VALUE"]?>”</a>
                                </p>
                                <p class="comments">
                                    комментарии<span class="comments_number">0</span>
                                </p>
                            </div>
                            <div class="rating">0</div>
                        </div>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </div>
</section>