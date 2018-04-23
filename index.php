<?require ($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Главная");?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "slider_index", Array(
    "IBLOCK_TYPE" => "content",
    "IBLOCK_ID" => "2",
    "NEWS_COUNT" => "6",
    "SORT_BY1" => "SORT",
    "SORT_ORDER1" => "ASC",
    "CHECK_DATES" => "N",
    "AJAX_MODE" => "N",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "36000000",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "SET_TITLE" => "N"
), false, Array("HIDE_ICONS"=>"Y"))?>
<section class="novelties">
    <div class="wrap_min">
        <h2>новинки</h2>
        <div class="novelties_wrap">
            <div class="novelties_wrap_slider">
                <p class="title">
                    диван для комнаты отдыха <a href="#" class="green">LESIK</a>
                </p>
                <div class="novelties_slider">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/pic_11.jpg" alt="">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/pic_11.jpg" alt="">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/pic_11.jpg" alt="">
                </div>
                <div class="dots"></div>
            </div>
            <div class="novelties_wrap_item">
                <div class="item">
                    <p class="title">
                        стул <span class="bold">PLAY</span>
                    </p>
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/pic_12.jpg" alt="">
                </div>
                <div class="item">
                    <p class="title">
                        офисное кресло <span class="bold">LIGHT</span>
                    </p>
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/pic_13.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="competition_projects">
    <div class="wrap">
        <h2>конкурс проектов</h2>
        <div class="inner">
            <h3>Открыт прием заявок</h3>
            <h4>на участие в конкурсе «Лучший проект Profoffice 2017»!</h4>
            <div class="timer">
                <p class="title">до окончания приема работ</p>
                <div class="countdown">
                    <div class="item">
                        <span class="numbers days"></span>
                        <p class="text timeRefDays"></p>
                    </div>
                    <div class="item">
                        <span class="numbers hours"></span>
                        <p class="text timeRefHours"></p>
                    </div>
                    <div class="item">
                        <span class="numbers minutes"></span>
                        <p class="text timeRefMinutes"></p>
                    </div>
                    <div class="item">
                        <span class="numbers seconds"></span>
                        <p class="text timeRefSeconds"></p>
                    </div>
                </div>
            </div>
            <div class="btns_wrap">
                <div class="item">
                    <a class="round_btn" href="#">загрузить проект</a>
                </div>
                <div class="item">
                    <a class="round_btn" href="#">посмотреть проекты</a>
                </div>
            </div>
        </div>
    </div>
</section>
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
), false, Array("HIDE_ICONS"=>"Y"))?>
<section class="designer_3d">
    <div class="wrap_min">
        <h2><span class="light">outline 3d</span> проектировщик</h2>
        <div class="grid">
            <div class="col col_3 item">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/ico_1.png" alt="">
                </div>
                <p class="title">
                    Создавайте дизайн-проекты
                </p>
                <p class="text">
                    с использованием мебели складского ассортимента Profoffice
                </p>
            </div>
            <div class="col col_3 item">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/ico_2.png" alt="">
                </div>
                <p class="title">
                    Получайте визуализацию
                </p>
                <p class="text">
                    расстановок с разных ракурсов, сохранять изображения
                </p>
            </div>
            <div class="col col_3 item">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/ico_3.png" alt="">
                </div>
                <p class="title">
                    Рассчитывайте стоимость
                </p>
                <p class="text">
                    дизайн-проекта с формированием спецификации в Excel, отправляйте ее в личный кабинет
                </p>
            </div>
        </div>
        <div class="btns_wrap">
            <div class="item">
                <a class="round_btn" href="#">запустить онлайн версию</a>
            </div>
            <div class="item">
                <a class="round_btn" href="#">скачать офлайн версию</a>
            </div>
        </div>
    </div>
</section>
<section class="timezone">
    <div class="inner">
        <div class="grid">
            <div class="col col_4 item">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/ico_4.png" alt="">
                </div>
                <p class="title">
                    москва
                </p>
            </div>
            <div class="col col_4 item">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/ico_5.png" alt="">
                </div>
                <p class="title">
                    екатеринбург
                </p>
            </div>
            <div class="col col_4 item">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/ico_6.png" alt="">
                </div>
                <p class="title">
                    красноярск
                </p>
            </div>
            <div class="col col_4 item">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/ico_7.png" alt="">
                </div>
                <p class="title">
                    владивосток
                </p>
            </div>
        </div>
    </div>
</section>
<?require ($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>