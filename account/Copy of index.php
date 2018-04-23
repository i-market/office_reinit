<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
$userId = $USER->getId();
$arUser = $USER->getById($userId)->fetch();
if($dealerId = $arUser["UF_DEALER"]):
    $arFilters["DEALER"] = Array(
        "IBLOCK_ID" => IB_DEALERS,
        "ID" => $dealerId
    );
    $arSelects["DEALER"] = Array(
        "ID",
        "IBLOCK_ID",
        "NAME",
        "PREVIEW_PICTURE",
        "PROPERTY_COMPANY",
        "PROPERTY_ZIP",
        "PROPERTY_CITY",
        "PROPERTY_ADDRESS",
        "PROPERTY_PHONE",
        "PROPERTY_EMAIL",
        "PROPERTY_WEB",
        "PROPERTY_CONTACT_PERSON",
        "PROPERTY_CAREER",
        "PROPERTY_ESHOP",
        "PROPERTY_CORP",
        "PROPERTY_EXHIBITION",
        "PROPERTY_EXHIBITION_SQUARE",
        "PROPERTY_EXHIBITION_FURNITURE",
        "PROPERTY_SEO",
        "PROPERTY_COMPANY_DAY",
        "PROPERTY_EMPLOYEES",
        "PROPERTY_SUPPLIERS",
        "PROPERTY_INFO",
        "PROPERTY_CODE",
        "PROPERTY_MANAGERS"
    );
    $userIsAdmin = !!($arUser["UF_ACCESS"] == 8);
    $arDealer = CIBlockElement::GetList(Array(), $arFilters["DEALER"], false, Array("nTopCount"=>1), $arSelects["DEALER"])->fetch();
    $arDealer["PICTURE"] = getPhoto($arDealer["PREVIEW_PICTURE"]);
    $arFilters["EMPLOYEES"] = Array(
        "UF_DEALER" => $dealerId
    );
    $arSelects["EMPLOYEES"] = Array(
        "SELECT" => Array(
            "UF_SKYPE",
            "UF_ACCESS"
        ),
        "FIELDS" => Array(
            "ID",
            "NAME",
            "LAST_NAME",
            "EMAIL",
            "PERSONAL_PHOTO",
            "PERSONAL_PHONE",
            "PERSONAL_ICQ",
            "PERSONAL_STREET",
            "PERSONAL_CITY",
        )
    );
    $obEmployees = CUser::GetList(($by = "UF_ACCESS"), ($order = "asc"), $arFilters["EMPLOYEES"], $arSelects["EMPLOYEES"]);
    while($arEmployee = $obEmployees->Fetch()):
        $arEmployee["PICTURE"] = getPhoto($arEmployee["PERSONAL_PHOTO"]);
        $arEmployee["NAME"] = implode(" ", cleanArray(Array($arEmployee["NAME"], $arEmployee["LAST_NAME"])));
        $arEmployee["ADDRESS"] = implode(", ", cleanArray(Array($arEmployee["PERSONAL_CITY"], $arEmployee["PERSONAL_STREET"])));
        $arEmployees[$arEmployee["ID"]] = $arEmployee;
    endwhile;
    $arFilters["MANAGERS"] = Array(
        "ID" => implode(" | ", $arDealer["PROPERTY_MANAGERS_VALUE"])
    );
    $arSelects["MANAGERS"] = Array(
        "SELECT" => Array(
            "UF_SKYPE",
            "UF_ACCESS"
        ),
        "FIELDS" => Array(
            "ID",
            "NAME",
            "LAST_NAME",
            "EMAIL",
            "PERSONAL_PHOTO",
            "PERSONAL_PHONE",
            "PERSONAL_ICQ",
            "PERSONAL_STREET",
            "PERSONAL_CITY",
        )
    );
    $obManagers = CUser::GetList(($by = "ID"), ($order = "asc"), $arFilters["MANAGERS"], $arSelects["MANAGERS"]);
    while($arManager = $obManagers->fetch()):
        $arManager["PICTURE"] = getPhoto($arManager["PERSONAL_PHOTO"]);
        $arManager["NAME"] = implode(" ", cleanArray(Array($arManager["NAME"], $arManager["LAST_NAME"])));
        $arManager["ADDRESS"] = implode(", ", cleanArray(Array($arManager["PERSONAL_CITY"], $arManager["PERSONAL_STREET"])));
        $arManagers[$arManager["ID"]] = $arManager;
    endwhile;
    _c($arSelects);
    _c($arFilters);
    _c($arEmployees);
    _c($arManagers);
    _c($arUser);
    _c($arDealer);
endif;

if($dealerId):?>
    <section class="wrap_title wrap_title--pages">
        <div class="wrap_min">
            <div class="main_title">
                <h2>личный кабинет</h2>
            </div>
        </div>
    </section>
    <section class="lk-about-company">
        <div class="wrap">
            <div class="left">
                <div class="top">
                    <div class="img">
                        <img src="<?=$arDealer["PICTURE"]["SRC"]?>" alt="<?=$arDealer["NAME"]?>">
                    </div>
                    <div class="info">
                        <p class="title"><?=$arDealer["NAME"]?></p>
                        <p class="gray"><?=$arDealer["PROPERTY_WEB_VALUE"]?></p>
                        <p class="adress"><?=$arDealer["PROPERTY_ADDRESS_VALUE"]?></p>
                    </div>
                </div>
                <a class="square_button" href="/account/settings/"><span>настроить аккаунт</span></a>
            </div>
            <div class="middle">
                <p class="title">ваша скидка</p>
                <p class="percent">0%</p>
                <p class="gray">Последнее обновление: только что</p>
                <span class="lk-open-table">Таблица расчета скидки</span>
            </div>
            <div class="right">
                <p class="title">Ваш оборот </p>
                <p class="price">0
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/euro_2.png" alt="">
                </p>
                <p class="gray">Последнее обновление: только что</p>
            </div>
            <div class="lk-hidden-table">
                <span class="close"></span>
                <p class="title">табдица расчета скидки</p>
                <p class="city">г. москва</p>
                <div class="inner">
                    <table>
                        <thead>
                            <tr>
                                <td rowspan="2">Обороты за год
                                    <br>(в тыс. евро)</td>
                                <td rowspan="2">Базовая скидка,
                                    <br>%</td>
                                <td colspan="6">Специальные скидки при заказе от (в розничных ценах)</td>
                            </tr>
                            <tr>
                                <td>10 000
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/euro_2.png" alt="">
                                </td>
                                <td>20 000
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/euro_2.png" alt="">
                                </td>
                                <td>30 000
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/euro_2.png" alt="">
                                </td>
                                <td>50 000
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/euro_2.png" alt="">
                                </td>
                                <td>70 000
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/euro_2.png" alt="">
                                </td>
                                <td>100 000
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/euro_2.png" alt="">
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>до 25 000</td>
                                <td>20</td>
                                <td>30%</td>
                                <td>31%</td>
                                <td>32%</td>
                                <td>34%</td>
                                <td>35%</td>
                                <td>37%</td>
                            </tr>
                            <tr>
                                <td>то 25 000</td>
                                <td>20</td>
                                <td>30%</td>
                                <td>31%</td>
                                <td>32%</td>
                                <td>34%</td>
                                <td>35%</td>
                                <td>37%</td>
                            </tr>
                            <tr>
                                <td>от 50 000</td>
                                <td>20</td>
                                <td>30%</td>
                                <td>31%</td>
                                <td>32%</td>
                                <td>34%</td>
                                <td>35%</td>
                                <td>37%</td>
                            </tr>
                            <tr>
                                <td>от 100 000</td>
                                <td>20</td>
                                <td>30%</td>
                                <td>31%</td>
                                <td>32%</td>
                                <td>34%</td>
                                <td>35%</td>
                                <td>37%</td>
                            </tr>
                            <tr>
                                <td>от 175 000</td>
                                <td>20</td>
                                <td>30%</td>
                                <td>31%</td>
                                <td>32%</td>
                                <td>34%</td>
                                <td>35%</td>
                                <td>37%</td>
                            </tr>
                            <tr>
                                <td>от 200 000</td>
                                <td>20</td>
                                <td>30%</td>
                                <td>31%</td>
                                <td>32%</td>
                                <td>34%</td>
                                <td>35%</td>
                                <td>37%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="lk-wrap-links">
        <div class="wrap">
            <div class="inner">
                <div class="inner-links">
                    <a href="/cart/">корзина <br> <span><?=getCartCount(true)?></span></a>
                    <a href="/account/orders/">история<br>заказов</a>
                    <a href="#">сохраненные<br>заказы</a>
                    <a href="#">сохраненные<br>спецификации</a>
                    <a href="#">юридические<br>лица</a>
                    <a href="#">каталоги<br>и прайс-листы</a>
                    <a href="#">рекламации</a>
                </div>
            </div>
        </div>
    </section>
    <section class="lk-employees">
        <div class="wrap">
            <p class="lk-title">
                <span class="lk-title-text">сотрудники компании</span>
            </p>
            <div class="grid">
                <?foreach($arEmployees as $arEmployee):?>
                    <div class="col col_4 contacts_managers_item label">
                        <?if($arEmployee["UF_ACCESS"] == 8):?>
                            <span class="label">администратор</span>
                        <?endif?>
                        <div class="img">
                            <img src="<?=$arEmployee["PICTURE"]["SRC"]?>" alt="<?=$arEmployee["NAME"]?>">
                        </div>
                        <p class="name"><?=$arEmployee["NAME"]?></p>
                        <p class="city"><?=$arEmployee["ADDRESS"]?></p>
                        <p class="mail">
                            <a href="mailto:<?=$arEmployee["EMAIL"]?>"><?=$arEmployee["EMAIL"]?></a>
                        </p>
                        <ul class="info">
                            <?if($arEmployee["PERSONAL_PHONE"]):?>
                                <li>
                                    <span>Tel</span>
                                    <span><?=$arEmployee["PERSONAL_PHONE"]?></span>
                                </li>
                            <?endif;
                            if($arEmployee["PERSONAL_ICQ"]):?>
                                <li>
                                    <span>ICQ</span>
                                    <span><?=$arEmployee["PERSONAL_ICQ"]?></span>
                                </li>
                            <?endif;
                            if($arEmployee["UF_SKYPE"]):?>
                                <li>
                                    <span>Skype</span>
                                    <span><?=$arEmployee["UF_SKYPE"]?></span>
                                </li>
                            <?endif;?>
                        </ul>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </section>
    <section class="lk-employees">
        <div class="wrap">
            <p class="lk-title">
                <span class="lk-title-text">Консультанты</span>
            </p>
            <div class="grid">
                <?foreach($arManagers as $arManager):?>
                    <div class="col col_3 contacts_managers_item consultant">
                        <div class="wrap-inner">
                            <div class="img">
                                <img src="<?=$arManager["PICTURE"]["SRC"]?>" alt="">
                            </div>
                            <div class="inner">
                                <p class="name"><?=$arManager["NAME"]?></p>
                                <p class="city"><?=$arManager["ADDRESS"]?></p>
                                <p class="mail">
                                    <a href="mailto:<?=$arManager["EMAIL"]?>"><?=$arManager["EMAIL"]?></a>
                                </p>
                                <ul class="info">
                                    <?if($arManager["PERSONAL_PHONE"]):?>
                                        <li>
                                            <span>Tel</span>
                                            <span><?=$arManager["PERSONAL_PHONE"]?></span>
                                        </li>
                                    <?endif;
                                    if($arManager["PERSONAL_ICQ"]):?>
                                        <li>
                                            <span>ICQ</span>
                                            <span><?=$arManager["PERSONAL_ICQ"]?></span>
                                        </li>
                                    <?endif;
                                    if($arManager["UF_SKYPE"]):?>
                                        <li>
                                            <span>Skype</span>
                                            <span><?=$arManager["UF_SKYPE"]?></span>
                                        </li>
                                    <?endif;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </section>
    <?/*
    <section class="wrap_title wrap_title--cabinet">
        <div class="wrap">
            <div class="lk-title">новости</div>
            <div class="archive">
                <div class="inner">
                    <div class="now">2017 год</div>
                    <div class="dd_archive_block">
                        <a class="show_all" href="#">показать весь</a>
                        <p class="year"><a href="#">2016 год</a>
                        </p>
                        <p class="year"><a href="#">2015 год</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>*/?>
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "news_index", Array(
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
    ), false, Array("HIDE_ICONS"=>"Y"));
else:?>
    <section class="wrap_title wrap_title--pages">
        <div class="wrap_min">
            <div class="main_title">
                <h2>За пользователем не закреплен дилер</h2>
            </div>
        </div>
    </section>
<?endif?>

<section class="timezone timezone--cabinet">
    <div class="inner">
        <div class="grid">
            <div class="col col_4 item">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/ico_4.png" alt="">
                </div>
                <p class="title">москва</p>
            </div>
            <div class="col col_4 item">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/ico_5.png" alt="">
                </div>
                <p class="title">екатеринбург</p>
            </div>
            <div class="col col_4 item">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/ico_6.png" alt="">
                </div>
                <p class="title">красноярск</p>
            </div>
            <div class="col col_4 item">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/ico_7.png" alt="">
                </div>
                <p class="title">владивосток</p>
            </div>
        </div>
    </div>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>