<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$mainPage = ($curPage = $APPLICATION->GetCurPage()) == SITE_DIR;
$userAuth = $USER->isAuthorized();?>
<!doctype html>
<html lang="<?=LANGUAGE_ID?>">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title><?$APPLICATION->ShowTitle()?></title>
        <?$APPLICATION->ShowHead()?>
        <!--[if gte IE 9]>
            <style type="text/css">
                .gradient {filter: none}
            </style>
        <![endif]-->
    </head>
    <body>
        <?$APPLICATION->ShowPanel()?>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <header class="header">
            <div class="header_top">
                <div class="wrap">
                    <div class="left">
                        <div class="top">
                            <div class="choose_city_block">
                            <span class="choose_city">Москва</span>
                            <div class="dd_choose_city">
                                <span class="close"></span>
                                <h4>Выберите свой город</h4>
                                <ul class="dd_choose_city-list">
                                    <li><a href="#">Москва</a>
                                    </li>
                                    <li><a href="#">Уфа</a>
                                    </li>
                                    <li><a href="#">Питер</a>
                                    </li>
                                    <li><a href="#">Москва</a>
                                    </li>
                                    <li><a href="#" class="active">Уфа</a>
                                    </li>
                                    <li><a href="#">Питер</a>
                                    </li>
                                    <li><a href="#">Москва</a>
                                    </li>
                                    <li><a href="#">Уфа</a>
                                    </li>
                                    <li><a href="#">Питер</a>
                                    </li>
                                </ul>
                                <form class="dd_choose_city-bottom">
                                    <h4>Или укажите в поле</h4>
                                    <div class="inner">
                                        <input type="text" placeholder="Введите свой город">
                                        <button type="submit" class="square_button"><span>выбрать</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <span class="date"><?=date("D, j F, H:i")?></span>
                            <span class="euro">65.54</span>
                            </div>
                        </div>

                        <div class="bottom">
                            <a class="tel" href="tel:<?=str_replace(" ", "", getOption("UF_PHONE"))?>"><?=getOption("UF_PHONE")?></a>
                        </div>
                    </div>
                    <div class="middle">
                        <?if($mainPage):?>
                            <div class="logo">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png" alt="Логотип ProfOffice">
                            </div>
                        <?else:?>
                            <a class="logo" href="<?=SITE_DIR?>">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png" alt="Логотип ProfOffice">
                            </a>
                        <?endif?>
                    </div>
                    <div class="right">
                        <?if($userAuth):?>
                            <div class="header-sign-out">
                                <a class="company" href="/account/"><?=$USER->GetFullName()?></a>
                                <a class="header-sign-out-link" href="?logout=yes">Выход</a>
                            </div>
                        <?else:?>
                            <a class="link" href="/partners/">Стать партнером</a>
                            <div class="sign_in_block">
                                <span class="link sign_in" href="javascript:">Вход</span>
                                <form class="sign_in_form ajaxform" data-type="json" data-mode="login">
                                    <strong>вход</strong>
                                    <div class="line">
                                        <span>логин</span>
                                        <input type="text" name="login">
                                    </div>
                                    <div class="line">
                                        <span>пароль</span>
                                        <input type="text" name="password">
                                    </div>
                                    <button type="submit" class="square_button">
                                        <span>Войти</span>
                                    </button>
                                    <div class="bottom">
                                        <a href="/auth/recovery/">Забыли пароль?</a>
                                        <a href="/partners/">РЕГИСТРАЦИЯ</a>
                                    </div>
                                </form>
                            </div>
                        <?endif?>
                        <div class="cart_block">
                        	<a class="cart" href="/cart/"></a>
                            <span class="cart_number"></span>
                        </div>
                        <div class="search_block">
                            <span class="search_btn"></span>
                            <form class="search_form" method="get" action="/search/">
                                <div class="search_form_main">
                                    <button type="submit" class="search_btn"></button>
                                    <input type="text" name="q" value="<?=htmlspecialcharsbx($_REQUEST["q"])?>" placeholder="поиск по сайту">
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
            </div>
            <div class="header_bottom">
                <div class="wrap_hidden_logo">
                    <?if($mainPage):?>
                        <div class="logo_menu">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/logo_w.png" alt="Логотип ProfOffice">
                        </div>
                    <?else:?>
                        <a class="logo_menu" href="<?=SITE_DIR?>">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/logo_w.png" alt="Логотип ProfOffice">
                        </a>
                    <?endif?>
                </div>
                <div class="sign_in">
                    <?if($userAuth):?>
                        <a class="sign_in_btn" href="?logout=yes">Выход</a>
                    <?else:?>
                        <button class="sign_in_btn" type="button">Вход</button>
                        <form class="sign_in_hidden_form ajaxform" data-type="json" data-mode="login">
                            <strong>Вход</strong>
                            <label>
                                <span>логин</span>
                                <input type="text" name="login">
                            </label>
                            <label>
                                <span>пароль</span>
                                <input type="text" name="password">
                            </label>
                            <button class="square_button"><span>войти</span></button>
                            <div class="bottom">
                                <a href="/auth/recovery/">Забыли пароль?</a>
                                <a href="/partners/">РЕГИСТРАЦИЯ</a>
                            </div>
                        </form>
                    <?endif?>
                </div>

                <?$APPLICATION->IncludeComponent("bitrix:menu", "mega", Array(
                    "ROOT_MENU_TYPE" => "catalog",
                    "USE_EXT" => "Y",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "360000",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    //"SHOW_LAST_LEVEL_BUTTONS" => "Y"
                ), false, Array("HIDE_ICONS"=>"N"))?>
            </div>
        </header>
        <main class="content">