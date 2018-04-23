<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
    $mainPage = ($curPage = $APPLICATION->GetCurPage()) == SITE_DIR;
    if(defined("showSubscribe")):?>
        <section class="subscribe">
            <div class="wrap">
                <form class="inner" method="" action="" id="" name="">
                    <div class="left">
                        <div class="text">
                            Присоединяйся
                            <span>к нашей рассылке</span>
                        </div>
                    </div>
                    <div class="middle">
                        <div class="wrap_input">
                            <input type="text" placeholder="имя">
                        </div>
                        <div class="wrap_input">
                            <input type="text" placeholder="e-mail">
                        </div>
                    </div>
                    <div class="right">
                        <button class="square_button square_button--white">
                            <span>Подписаться</span>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    <?endif?>
</main>
<footer class="footer">
    <div class="wrap">
        <div class="top">
            <div class="left">
                <h3>о нас</h3>
                <p class="text">
                    <?$APPLICATION->IncludeFile("/local/include/footer_text.php")?>
                </p>
            </div>
            <div class="right">
                <div class="right_item">
                    <p class="title">
                        <a href="/catalog/">каталог</a>
                    </p>
                    <p class="title">
                        <a href="/partners/">партнерам</a>
                    </p>
                    <p class="title">
                        <a href="/projects/">Проекты</a>
                    </p>
                    <p class="title">
                        <a href="/konkurs/">Конкурс проектов</a>
                    </p>
                    <p class="title">
                        <a href="/about/">О компании</a>
                    </p>
                    <p class="title">
                        <a href="/about/contacts/">Контакты</a>
                    </p>
                </div>
                <div class="right_item">
                    <p class="title">
                        <a href="javascript:">Сервисы</a>
                    </p>
                    <p class="info">
                        <a href="/account/">Личный кабинет</a>
                    </p>
                    <p class="info">
                        <a href="#">Оutline 3D</a>
                    </p>
                    <p class="info">
                        <a href="#">Каталоги pdf</a>
                    </p>
                </div>
                <div class="right_item">
                    <p class="title">
                        <a href="/contacts/">контакты</a>
                    </p>
                    <div class="adress_item">
                        <p class="title">
                            <a href="/contacts/">офис</a>
                        </p>
                        <p class="info">
                            <?$APPLICATION->IncludeFile("/local/include/footer_office.php")?>
                        </p>
                    </div>
                    <div class="adress_item">
                        <p class="title">
                            <a href="/contacts/">склад</a>
                        </p>
                        <p class="info">
                            <?$APPLICATION->IncludeFile("/local/include/footer_store.php")?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <?$APPLICATION->IncludeFile("/local/include/footer_copyright.php")?>
        </div>
    </div>
</footer>

<div class="modal" id="modal" style="display: none">
    <div class="block">
        <span class="close">×</span>
        <strong title="title"></strong>
        <div class="status">
            <div class="allert_text"></div>
        </div>
    </div>
</div>
</body>
</html>
<?$assetInstance = Bitrix\Main\Page\Asset::getInstance();
$arExtScripts = Array(
    "//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js",
    "//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js",
    "//www.google.com/recaptcha/api.js"
);
$arScripts = Array(
    "vendor/core",
    "vendor/jquery.fancybox.min",
    "vendor/jquery.maskedinput.min",
    "vendor/tooltipster.bundle.min",
    "vendor/timer",
    "vendor/tipped",
    "vendor/dropdown",
    "scripts",
    "custom"
);
$arStyles = Array(
    "lib/normalize.min",
    "lib/dropdown",
    "lib/tooltipster.bundle.min",
    "lib/tipped",
    "lib/jquery.fancybox.min",
    "main",
    "override"
);
$arExtStyles = Array(
    "//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"
);
$assetInstance->addString('<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">');
foreach($arExtScripts as $scriptName)
    $assetInstance->addJs($scriptName);
foreach($arScripts as $scriptName)
    $assetInstance->addJs(SITE_TEMPLATE_PATH."/js/{$scriptName}.js");
foreach($arStyles as $styleName)
    $assetInstance->addCss(SITE_TEMPLATE_PATH."/css/{$styleName}.css");
foreach($arExtStyles as $styleName)
    $assetInstance->addCss($styleName);?>